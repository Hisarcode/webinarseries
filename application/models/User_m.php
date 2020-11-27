<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    //untuk data pasien
    public function tampilDataPasien($limit, $start = '0', $cari = null)
    {
        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->join('user', 'user.id = pasien.user_id');
        $this->db->limit($limit, $start);
        if ($cari) {
            $this->db->like('user.nama', $cari);
        }
        return $this->db->get()->result_array();
    }

    public function countSemuaPasien()
    {
        return $this->db->get('pasien')->num_rows();
    }

    public function tampilDataPasienCari($cari, $limit, $start = '0')
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
        FROM `pasien` JOIN `user`
        ON `pasien`.`user_id` = `user`.`id` WHERE `user`.`username` OR `user`.`nama`  LIKE '%" . $cari . "%' ORDER BY `pasien`.`user_id` ASC LIMIT " . $start . "," . $limit;

        return $this->db->query($query)->result_array();
    }

    public function countPasienCari($cari)
    {
        $query = "SELECT `pasien`.*, `user`.`username`, `user`.`nama`, `user`.`alamat`
        FROM `pasien` JOIN `user`
        ON `pasien`.`user_id` = `user`.`id` WHERE `user`.`username` OR `user`.`nama`  LIKE '%" . $cari . "%' ORDER BY `pasien`.`user_id` ASC";

        return $this->db->query($query)->num_rows();
    }

    public function getPasienId($userId)
    {
        return $this->db->get_where('pasien', array('user_id' => $userId))->row()->id;
    }

    //untuk data antrian
    public function tampilDataAntrian($limit, $start = '0')
    {
        $query = "SELECT *
                FROM `antrian` 
                JOIN `dokter` ON `antrian`.`dokter_id` = `dokter`.`id` 
                ORDER BY `antrian`.`tanggal` ASC LIMIT " . $start . "," . $limit;

        return $this->db->query($query)->result_array();
    }

    public function countSemuaAntrian()
    {
        return $this->db->get('antrian')->num_rows();
    }

    public function tampilDataAntrianCari($cari)
    {
        $query = "SELECT `antrian`.*, `antrian`.`jam`, `dokter`.`nama_gelar`, `dokter`.`jenis_dokter`,
        FROM `antrian` JOIN `dokter`
        ON `antrian`.`dokter_id` = `dokter`.`id` WHERE `antrian`.`tanggal` LIKE '%" . $cari . "%' ORDER BY `antrian`.`dokter_id` ASC";

        return $this->db->query($query)->result_array();
    }


    //untuk data resep
    public function tampilDataResep($limit, $start = '0', $idPasien)
    {
        $query = "SELECT *
                FROM `resep` 
                JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
                WHERE `pasien_id` ='" . $idPasien . "' 
                GROUP BY `resep`.`date_created` ORDER BY `resep`.`id` ASC LIMIT " . $start . "," . $limit;

        //return $this->db->query('user', ['username' => $this->session->userdata('username')])->row_array();
        return $this->db->query($query)->result_array();
        //$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function countSemuaResep()
    {
        return $this->db->get('resep')->num_rows();
    }

    public function detail_resep($hari)
    {

        $query = "SELECT *
        FROM `resep` 
        JOIN `dokter`ON `resep`.`dokter_id` = `dokter`.`id` 
        JOIN `user` ON `dokter`.`user_id` = `user`.`id`
        JOIN `obat` ON `resep`.`obat_id` = `obat`.`id`
        WHERE `resep`.`date_created` LIKE '%" . $hari . "%' 
        ORDER BY `resep`.`date_created` ASC";

        return $this->db->query($query)->result_array();
    }

    //untuk data surat rujukan
    public function tampilDataRujukan($limit, $start = '0', $idPasien)
    {
        $query = "SELECT *
                FROM `surat_rujukan` 
                JOIN `dokter`ON `surat_rujukan`.`dokter_id` = `dokter`.`id` 
                WHERE `pasien_id` ='" . $idPasien . "' 
                ORDER BY `surat_rujukan`.`id` ASC LIMIT " . $start . "," . $limit;

        //return $this->db->query('user', ['username' => $this->session->userdata('username')])->row_array();
        return $this->db->query($query)->result_array();
        //$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function countSemuaRujukan()
    {
        return $this->db->get('surat_rujukan')->num_rows();
    }

    public function detail_pasien($id = NULL)
    {
        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->join('user', 'user.id = pasien.user_id');
        $this->db->where('pasien.user_id', $id);
        return $this->db->get()->row_array();
    }

    public function register($enc_password)
    {
        // User data array
        $data = array(
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $enc_password,
        );

        // Insert user
        return $this->db->insert('user', $data);
    }

    // Log user in
    public function login($username, $password)
    {
        // Validate
        $this->db->where('username', $username);
        $this->db->where('password', $password);

        $result = $this->db->get('user');

        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    // Check username exists
    public function check_username_exists($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    // Check email exists
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('user', array('email' => $email));
        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    public function getListPasien()
    {
        //harusnya menggunakan db pasien bukan user
        $this->db->select('pasien.*,user.nama');
        $this->db->from('pasien');
        $this->db->join('user', '`user`.`id` = `pasien`.`user_id`');
        //join rekam medik setelah ini
        return $this->db->get()->result_array();
    }

    public function getDokterId($userId)
    {
        return $this->db->get_where('dokter', array('user_id' => $userId))->row()->id;
    }

    public function getUserById($id)
    {
        return $this->db->get_where('user', array('id' => $id))->row_array();
    }

    private $_table = 'user';
    public $user_id;
    public $nama;
    public $email;
    public $nomor_telepon;
    public $image = "default.jpg";
    public $namapengguna;
    public $katasandi;
    public $nik;
    public $tanggallahir;
    public $alamat;
    public $role_id;
    public $is_active;


    public function rules()
    {

        return [

            [
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Nama Belum  Diisi'
                ]
            ],
            [
                'field' => 'role_id',
                'label' => 'Role',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Role Belum  Diisi'
                ]
            ],
            [
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|trim|valid_email|is_unique[user.email]',
                'errors' => [
                    'required' => 'E-mail Belum  Diisi',
                    'numeric' => 'E-mail harus berisi angka',
                    'valid_email' => 'E-mail tidak valid',
                    'is_unique' => 'E-mail telah didaftarkan'
                ]
            ],
            [
                'field' => 'nomor_telepon',
                'label' => 'Nomor Telepon',
                'rules' => 'required|trim|numeric|min_length[10]|max_length[13]',
                'errors' => [
                    'required' => 'Nomor Telepon Belum  Diisi',
                    'numeric' => 'Nomor Telepon harus berisi angka',
                    'min_length' => 'Panjang Nomor Telepon tidak sesuai',
                    'max_length' => 'Panjang Nomor Telepon tidak sesuai'
                ]
            ],
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|trim|alpha_numeric|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username Belum  Diisi',
                    'alpha_numeric' => 'Username hanya dap[at berisi angka/huruf',
                    'is_unique' => 'Username telah didaftarkan'
                ]
            ],
            [
                'field' => 'nik',
                'label' => 'NIK',
                'rules' => 'required|trim|numeric|is_unique[user.nik]|exact_length[16]',
                'errors' => [
                    'required' => 'NIK Belum  Diisi',
                    'numeric' => 'NIK harus berisi angka',
                    'exact_length' => 'Panjang NIK tidak sesuai',
                    'is_unique' => 'NIK telah didaftarkan'
                ]
            ],
            [
                'field' => 'tanggallahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Tanggal Lahir Belum  Diisi'
                ]
            ],
            [
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => 'Alamat Belum  Diisi'
                ]
            ],
            [
                'field' => 'password1',
                'label' => 'Password',
                'rules' => 'required|trim|min_length[6]|matches[password2]',
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
            ],

        ];
    }

    public function insertDataUser()
    {
        $post = $this->input->post();
        $data = [
            'nama' => $post['nama'],
            'email'  => $post['email'],
            'nomor_telepon' =>  $post['nomor_telepon'],
            'image' => "default.jpg",
            'username'  => $post['username'],
            'password'  => $post['password1'],
            'nik'  => $post['nik'],
            'tanggallahir'  => $post['tanggallahir'],
            'alamat'  => $post['alamat'],
            'role_id'  => $post['role_id'],
            'is_active' => 1
        ];
        $id_user = $this->db->count_all('user') + 1;

        if ($post['role_id'] == '3') {
            $this->db->insert('pasien', ['user_id' => $id_user, 'pekerjaan' => '', 'gol_darah' => '', 'rekam_medik_id' => '']);
        } else if ($post['role_id'] == '2') {
            $this->db->insert('dokter', ['user_id' => $id_user, 'nama_gelar' => '', 'jenis_dokter' => '']);
        }

        return $this->db->insert($this->_table, $data);
    }

    public function editDataUser($data)
    {
        $post = $this->input->post();

        $data = [
            'nama' => $post['nama'],
            'email'  => $post['email'],
            'nomor_telepon' =>  $post['nomor_telepon'],
            'image' => "default.jpg",
            'username'  => $post['username'],
            'password'  => $post['password1'],
            'nik'  => $post['nik'],
            'tanggallahir'  => $post['tanggallahir'],
            'alamat'  => $post['alamat'],
            'role_id'  => $post['role_id'],
            'is_active' => 1
        ];

        return $this->db->update($this->_table, $data, array('id' => $post["id"]));
    }
    public function deleteUser($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}
