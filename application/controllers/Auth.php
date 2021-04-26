<?php
defined('BASEPATH') or exit('No direct script access allowed');
/* 
    1. Lupa Password
    2. Verifikasi
    3. 
*/
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('google_login_m');
    }
    public function index()
    {
        $data['title'] = 'Webinar Informatika Login';

        // google auth

        include_once FCPATH . "vendor/autoload.php";

        // end google auth


        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            // google auth
            $google_client = new Google_Client();

            $google_client->setClientId('134942420751-jh6sbr41ee9s4t9iftujtj1dursi1b0k.apps.googleusercontent.com'); //Define your ClientID

            $google_client->setClientSecret('eIVCWOdKECvLgAKLhy3Pmf9A'); //Define your Client Secret Key

            $google_client->setRedirectUri(base_url() . 'auth/'); //Define your Redirect Uri

            $google_client->addScope('email');

            $google_client->addScope('profile');
            // $this->session->unset_userdata('access_token');
            // $data['token'] =  $this->session->userdata('access_token');


            if (isset($_GET["code"])) {
                $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
                //oke
                $this->load->view('auth/login', $data);
                if (!isset($token["error"])) {
                    $google_client->setAccessToken($token['access_token']);

                    $this->session->set_userdata('access_token', $token['access_token']);

                    $google_service = new Google_Service_Oauth2($google_client);

                    $data = $google_service->userinfo->get();

                    $current_datetime = date('Y-m-d H:i:s');

                    if ($this->google_login_m->Is_already_register($data['id'])) {
                        //update data
                        $user_data = array(
                            'nama' => $data['given_name'] . " " . $data['family_name'],
                            'email' => $data['email'],
                            'image' => $data['picture'],
                            'role_id' => 3,
                            'is_active' => 1,
                            'updated_at' => $current_datetime,
                        );

                        $this->google_login_m->Update_user_data($user_data, $data['id']);
                    } else {
                        //insert data
                        $user_data = array(
                            'password' => $data['id'],
                            'nama' => $data['given_name'] . $data['family_name'],
                            'email'  => $data['email'],
                            'image' => $data['picture'],
                            'role_id' => 3,
                            'is_active' => 1,
                            'created_at'  => $current_datetime,
                            'updated_at' => $current_datetime,

                        );

                        $this->google_login_m->Insert_user_data($user_data);
                    }
                    $this->session->set_userdata('user_data', $user_data);
                    $this->_google_login($data['email']);
                }
            }

            $login_button = '';
            if (!$this->session->userdata('access_token')) {
                $login_button = $google_client->createAuthUrl();
                $data['login_button'] = $login_button;
                //end google auth

                $this->load->view('auth/login', $data);
            } else {
                $this->session->unset_userdata('access_token');
                redirect('auth');
            }
        } else {
            $this->_login();
        }
    }


    private function _google_login($email)
    {

        $data = [
            'email' => $email,
            'role_id' => 3
        ];
        $this->session->unset_userdata('access_token');

        $this->session->unset_userdata('user_data');

        $this->session->set_userdata($data);
        redirect('peserta');
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('panitia');
                    } else if ($user['role_id'] == 3) {
                        redirect('peserta');
                    }
                } else {
                    $this->session->set_flashdata('category_error', 'Password Salah');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('category_error', 'Akun belum di Verifikasi');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('category_error', 'Email Salah');
            redirect('auth');
        }
    }

    private function _generateUserID()
    {

        $this->db->select('RIGHT(user.id,6) as kode', FALSE);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('user');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "247" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }




    public function registrasi()
    {

        $rules = [
            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama Belum  Diisi'
                ]
            ],
            [
                'field' => 'instansi',
                'label' => 'Instansi',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Instansi Belum  Diisi'
                ]
            ],
            [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|trim|valid_email|is_unique[user.email]',
                'errors' => [
                    'is_unique' => 'E-mail ini telah terdaftar sebelumnya',
                    'required' => 'E-mail Belum  Diisi',
                    'numeric' => 'E-mail harus berisi angka',
                    'valid_email' => 'E-mail tidak valid'
                ]
            ],
            [
                'field' => 'password1',
                'label' => 'Password',
                'rules' => 'required|trim|min_length[3]|matches[password2]',
                'errors' => [
                    'required' => 'Password Belum  Diisi',
                    'matches' => 'Password Tidak Sama',
                    'min_length' => 'Password tidak aman!'
                ]
            ],
            [
                'field' => 'password2',
                'label' => 'Password',
                'rules' => 'required|trim|matches[password1]',
                'errors' => [
                    'required' => 'Password Belum  Diisi',
                    'matches' => 'Password Tidak Sama'
                ]
            ]
        ];

        $userId = $this->_generateUserID();

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi Peserta';
            $this->load->view('auth/registration', $data);
        } else {
            $email = $this->input->post('email', true);
            // siapkan data untuk dimasukkan ke dalam array , urutkan sesuai posisi tabel
            $data = [
                'id' => $userId,
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token
            ];

            $this->db->insert('user', $data);
            $this->db->insert('peserta', [
                'id_user' => $userId,
                'instansi' => $this->input->post('instansi', true)
            ]);
            $this->db->insert('user_token', $user_token);

            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('category_success', 'Akun telah dibuat , Silahkan Verifikasi Akun di Email');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'hisarcode@gmail.com',
            'smtp_pass' => 'akh04011991',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);


        $this->email->from('hisarcode@gmail.com', 'Webinar Informatika');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Verifikasi Webinar Informatika');
            $this->email->message('Silahkan klik link berikut untuk memverifikasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Verifikasi</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->db->set('is_active', 1);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->db->delete('user_token', ['email' => $email]);


                $this->session->set_flashdata('category_success', 'Akun ' . $user['email'] . ' berhasil di verifikasi. Silahkan login.');
                redirect('auth');
            } else {
                $this->session->set_flashdata('category_error', 'Verifikasi Akun Gagal:Token Salah');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('category_error', 'Verifikasi Akun Gagal:Email Salah');
            redirect('auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('category_success', 'Anda Berhasil Logout');
        redirect('auth');
    }

    public function blocked()
    {
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 1) {
            $backTo = 'admin';
        } else if ($role_id == 2) {
            $backTo = 'panitia';
        } else {
            $backTo = 'peserta';
        }

        $data['backTo'] = $backTo;

        $this->load->view('auth/blocked', $data);
    }

    public function ubahPassword()
    {
        $data['title'] = "Ubah Password";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $rules = [
            [
                'field' => 'passwordlama',
                'label' => 'Password Lama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Password Lama Belum  Diisi'
                ]
            ],
            [
                'field' => 'passwordbaru1',
                'label' => 'Password Baru',
                'rules' => 'required|trim|matches[passwordbaru2]',
                'errors' => [
                    'required' => 'Password Baru Belum  Diisi',
                    'matches' => 'Password Baru Tidak Sama'
                ]
            ],
            [
                'field' => 'passwordbaru2',
                'label' => 'Ulangi Password Baru',
                'rules' => 'required|trim|matches[passwordbaru1]',
                'errors' => [
                    'required' => 'Password Baru Belum  Diisi',
                    'matches' => 'Password Baru Tidak Sama'
                ]
            ],
        ];
        $this->form_validation->set_rules($rules);


        if ($this->form_validation->run() == false) {

            $this->load->view('auth/ubahpassword', $data);
        } else {
            $passwordlama = $this->input->post('passwordlama');
            $passwordbaru = $this->input->post('passwordbaru1');
            if (!password_verify($passwordlama, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                redirect('auth/ubahpassword');
            } else {
                if ($passwordlama == $passwordbaru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama!</div>');
                    redirect('auth/ubahpassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($passwordbaru, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil dirubah!</div>');
                    redirect('auth/ubahpassword');
                }
            }
        }
    }
}
