<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    /* Semua Belum 
        1. Lihat Webinar
        2. Registrasi Webinar
        3. Unregistrasi
        4. Cetak Sertifikat
        5. 
    */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m', 'user');
        $this->load->model('Webinar_m', 'webinar');
        $this->load->model('Sertifikat_m', 'sertifikat');
        $this->load->model('Webinar_peserta_m', 'webinar_peserta');

        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard Peserta';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('peserta', 'peserta.id_user = user.id');
        $this->db->where('email', $this->session->userdata('email'));
        $data['peserta'] = $this->db->get()->row_array();
        $data['list_webinar_next'] = $this->webinar->getListWebinarNext();
        $this->load->view('peserta/index', $data);
    }

    public function listWebinar()
    {
        $data['title'] = 'List Webinar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $webinarD = $this->webinar->getListWebinarObj();
        $i = 0;
        foreach ($webinarD as $wb) {
            $is_register = $this->webinar_peserta->hasRegistered($wb['webinar_id'], $data['user']['id']);
            if (empty($is_register)) {
                $is_register = 0;
            } else {
                $is_register = 1;
            }
            $webinar_new[$i] = array('webinar_id' => $wb['webinar_id'], 'webinar_nama' =>  $wb['webinar_nama'], 'tanggal' => $wb['tanggal'], 'jam' => $wb['jam'], 'media_nama' => $wb['media_nama'], 'narasumber' => $wb['narasumber'], 'deskripsi' => $wb['deskripsi'], 'poster' => $wb['poster'], 'is_register' => $is_register);
            $i++;
        }

        $data['webinar'] = $webinar_new;
        $this->load->view('peserta/listwebinar', $data);
    }


    public function detail_webinar($idWebinar)
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail Webinar';
        $data['webinar'] = $this->webinar->getWebinarById($idWebinar);
        $is_register = $this->webinar_peserta->hasRegistered($idWebinar, $data['user']['id']);
        if (empty($is_register)) {
            $data['is_register'] = 0;
        } else {
            $data['is_register'] =  1;
        }

        $this->load->view('peserta/detail_webinar', $data);
    }

    public function registrasi_webinar($webinar_id = 0, $user_id = 0)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Detail Webinar';

        if ($webinar_id == 0) {
            $data['webinar_id'] = $this->input->post('webinar_id');
        } else {
            $data['webinar_id'] = $webinar_id;
        }
        if ($user_id == 0) {
            $data['user_id'] = $this->input->post('user_id');
        } else {
            $data['user_id'] = $user_id;
        }
        var_dump($webinar_id);
        $webinar_peserta = $this->webinar_peserta;


        if ($webinar_peserta->registerWebinar($data['webinar_id'], $data['user_id'])) {
            $this->session->set_flashdata('category_success', 'Berhasil mendaftar Webinar');
            redirect('peserta/listwebinar');
        } else {
            $this->session->set_flashdata('category_error', 'Gagal mendafatar Webinar');
            redirect('peserta/listwebinar');
        }
    }

    public function batal_webinar($idWebinar, $idUser)
    {
        if (!isset($idUser)) show_404();
        if ($this->webinar_peserta->cancelWebinar($idWebinar, $idUser) > 0) {
            $this->session->set_flashdata('category_success', 'Berhasil membatalkan webinar');
            redirect('peserta/webinar_saya');
        } else {
            $this->session->set_flashdata('category_error', 'Gagal membatalkan webinar');
            redirect('peserta/webinar_saya');
        }
    }

    public function webinar_saya()
    {
        $data['title'] = 'Webinar Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['webinar_peserta'] = $this->webinar_peserta->getListByUserId($data['user']['id']);
        $this->load->view('peserta/webinar_saya', $data);
    }

    public function presensi()
    {
        $data['title'] = 'Presensi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['webinar_peserta'] = $this->webinar_peserta->getListByUserIdPresence($data['user']['id']);
        $this->load->view('peserta/presensi', $data);
    }

    public function presensi_peserta($idWebinarPeserta)
    {
        if (!isset($idWebinarPeserta)) show_404();
        if ($this->webinar_peserta->presence($idWebinarPeserta) > 0) {
            $this->session->set_flashdata('category_success', 'Presensi Berhasil , Sertifikat Webinar akan dibagikan maksimal 2 minggu setelah webinar');
            redirect('peserta/presensi');
        } else {
            $this->session->set_flashdata('category_error', 'Presensi Gagal');
            redirect('peserta/presensi');
        }
    }

    public function sertifikat($idWebinarPeserta)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['webinar_peserta'] = $this->webinar_peserta->getWebinarPesertaById($idWebinarPeserta);


        $data['sertifikat'] = $this->sertifikat->getSertifikatByWebinarId($data['webinar_peserta']['webinar_id']);


        if (empty($data['sertifikat']) || $data['sertifikat']['gambar_sertifikat'] == 'default.jpg') {
            $this->session->set_flashdata('category_error', 'Mohon maaf, Sertifikat Belum Keluar');
            redirect('peserta/webinar_saya');
        } else if ($data['webinar_peserta']['is_presence'] == 0) {
            $this->session->set_flashdata('category_error', 'Maaf Anda tidak mendapatkan sertifikat karena tidak menghadiri webinar');
            redirect('peserta/webinar_saya');
        } else {
            // var_dump($data['webinar_peserta']);
            // var_dump($data['sertifikat']);
            // var_dump($data['user']);
            $this->load->view('peserta/unduh_sertifikat', $data);
        }
    }

    public function profil()
    {
        $data['title'] = 'Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('peserta', 'peserta.id_user = user.id');
        $this->db->where('email', $this->session->userdata('email'));
        $data['peserta'] = $this->db->get()->row_array();
        $this->load->view('peserta/profil', $data);
    }
}
