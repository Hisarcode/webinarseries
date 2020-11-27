<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m', 'user');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard Peserta';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('peserta/index', $data);
    }

    public function listWebinar()
    {
        $data['title'] = 'Dashboard Peserta';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('peserta/listwebinar', $data);
    }
}
