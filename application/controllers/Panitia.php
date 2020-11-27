<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panitia extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m', 'user');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard Panitia';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('panitia/index', $data);
    }

    public function listWebinar()
    {
        $data['title'] = 'Dashboard Panitia';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('pantia/listwebinar', $data);
    }
}
