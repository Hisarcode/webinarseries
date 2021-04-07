<?php
defined('BASEPATH') or exit('No direct script access allowed');
/* 
    1. Edit Webinar  
    2. Input Design Sertifikat Webinar
    3. Atur Absensi webinar
    4. Lihat Detail Webinar
*/
class Panitia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m', 'user');
        $this->load->model('Webinar_m', 'webinar');
        $this->load->model('Webinar_Peserta_m', 'webinar_peserta');
        $this->load->model('Sertifikat_m', 'sertifikat');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard Panitia';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('panitia/index', $data);
    }

    public function profil()
    {
        $data['title'] = 'Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('panitia/profil', $data);
    }


    public function inputsertifikat()
    {
        $data['title'] = 'Input Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['sertifikat'] = $this->sertifikat->getListSertifikat();
        $this->load->view('panitia/inputsertifikat', $data);
    }

    public function webinar()
    {
        $data['title'] = 'Webinar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['webinar'] = $this->webinar->getListWebinar();
        $this->load->view('panitia/webinar', $data);
    }

    public function tambah_webinar()
    {
        $data['title'] = 'Tambah Webinar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['media'] = $this->webinar->getMedia();

        $webinar = $this->webinar;
        $validation = $this->form_validation;
        $validation->set_rules($webinar->rules());

        if ($validation->run()) {
            $webinar->addDataWebinar();
            $this->session->set_flashdata('category_succes', 'Data berhasil ditambahkan');
            redirect('panitia/webinar');
        }

        $this->load->view('panitia/tambah_webinar', $data);
    }

    public function edit_webinar($id = null)
    {
        if (!isset($id)) redirect('panitia/webinar');
        $webinar = $this->webinar;
        $validation = $this->form_validation;
        $validation->set_rules($webinar->rules());

        $data['media'] = $this->webinar->getMedia();

        if ($validation->run()) {
            $webinar->updateDataWebinar();
            $this->session->set_flashdata('category_success', 'Data Berhasil Diubah');
            redirect('panitia/webinar');
        }
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["title"] = "Edit Webinar";
        $data["webinar"] = $webinar->getWebinarById($id);

        $this->load->view('panitia/edit_webinar', $data);
    }

    public function detail_webinar($idWebinar)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail Webinar';
        $data['webinar'] = $this->webinar->getWebinarById($idWebinar);
        $this->load->view('panitia/detail_webinar', $data);
    }

    public function hapus_webinar($id = null)
    {
        if (!isset($id)) show_404();
        if ($this->webinar->deleteDataWebinar($id) > 0) {
            $this->session->set_flashdata('category_success', 'Data Berhasil Dihapus');
            redirect('panitia/webinar');
        } else {
            $this->session->set_flashdata('category_error', 'Data Gagal Dihapus');
            redirect('panitia/webinar');
        }
    }

    public function tambah_inputsertifikat()
    {
        $data['title'] = 'Input Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $webinarD = $this->webinar->getListWebinarObj();
        $i = 0;
        $webinar_new = [];
        foreach ($webinarD as $wb) {
            $is_sertifikat = $this->sertifikat->hasSertifikat($wb['webinar_id']);
            if (!$is_sertifikat) {
                $webinar_new[$i] = array('webinar_id' => $wb['webinar_id'], 'webinar_nama' =>  $wb['webinar_nama']);
                $i++;
            };
        }

        $data['daftarwebinar'] = $webinar_new;


        $sertifikat = $this->sertifikat;
        $validation = $this->form_validation;
        $validation->set_rules($sertifikat->rules());

        if ($validation->run()) {
            $sertifikat->addDataSertifikat();
            $this->session->set_flashdata('category_succes', 'Data berhasil ditambahkan');
            redirect('panitia/inputsertifikat');
        }

        $this->load->view('panitia/tambah_inputsertifikat', $data);
    }

    public function detail_sertifikat($idSertifikat)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail Sertifikat';
        $data['sertifikat'] = $this->sertifikat->getSertifikatById($idSertifikat);
        $this->load->view('panitia/detail_sertifikat', $data);
    }

    public function unduh_contoh_sertifikat($idSertifikat)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['sertifikat'] = $this->sertifikat->getSertifikatById($idSertifikat);
        $this->load->view('panitia/unduh_contoh_sertifikat', $data);
    }

    //test nanti diganti webinar_id
    public function kirim_sertifikat($idUser)
    {
        $data['sertifikat'] = $this->webinar_peserta->sendSertifikat($idUser);
        redirect('panitia/inputsertifikat');
    }

    public function daftar_peserta()
    {
        $data['title'] = 'Daftar Peserta Webinar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['webinar'] = $this->webinar->getListWebinar();
        $this->form_validation->set_rules('webinar_id', 'Pilih Webinar', 'required');


        if ($this->form_validation->run()) {
            $this->list_daftar_peserta($this->input->post('webinar_id'));
        } else {
            $this->load->view('panitia/daftar_peserta', $data);
        }
    }

    public function list_daftar_peserta($webinar_id)
    {
        $data['title'] = 'Daftar Peserta Webinar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $webinar = $this->webinar->getWebinarById($webinar_id);
        $data['nama_webinar'] = $webinar['webinar_nama'];


        $data['webinar_peserta'] = $this->webinar_peserta->getListByWebinarId($webinar_id);
        $data['total_peserta'] = count($data['webinar_peserta']);
        $this->load->view('panitia/list_daftar_peserta', $data);
    }

    public function presensi()
    {
        $data['title'] = 'Presensi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['webinar'] = $this->webinar->getListWebinar();

        $this->load->view('panitia/presensi', $data);
    }

    public function aktifkan_presensi($webinar_id)
    {
        if (!isset($webinar_id)) show_404();
        if ($this->webinar->activeWebinarPresent($webinar_id) > 0) {
            $this->session->set_flashdata('category_success', 'Absensi Diaktifkan');
            $this->presensi();
        } else {
            $this->session->set_flashdata('category_error', 'Absensi Gagal Diaktifkan');
            redirect('panitia/presensi');
        }
    }

    public function nonaktifkan_presensi($webinar_id)
    {
        if (!isset($webinar_id)) show_404();
        if ($this->webinar->nonactiveWebinarPresent($webinar_id) > 0) {
            $this->session->set_flashdata('category_success', 'Absensi Dinonaktifkan');
            redirect('panitia/presensi');
        } else {
            $this->session->set_flashdata('category_error', 'Absensi Gagal Dinonaktifkan');
            redirect('panitia/presensi');
        }
    }

    public function getEditLink()
    {

        echo json_encode($this->webinar->getWebinarById($_POST['id']));
    }

    public function editLink()
    {
        if ($this->webinar->editDataLink($_POST) > 0) {
            $this->session->set_flashdata('category_success', 'Link Telah Diedit');
            redirect('panitia/webinar');
            exit;
        } else {
            $this->session->set_flashdata('category_error', 'Link Gagal Diedit');
            redirect('panitia/webinar');
            exit;
        }
    }
}
