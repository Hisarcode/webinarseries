<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_m', 'user');


        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

    public function index()
    {
        $data['title'] = "Dashboard Admin";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('admin/index', $data);
    }

    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();


        $this->load->view('admin/role', $data);
    }

    public function roleAccess($role_id)
    {
        $data['title'] = "Role Access";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('admin/roleaccess', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('category_success', 'Akses Berhasil Diubah');
    }

    public function manajemenuser()
    {
        $data['title'] = "Manajemen User";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['manajemenuser'] = $this->db->get('user')->result_array();

        //bisa hubungkan ke model
        // $data['menu'] = $this->db->get('user_menu')->result_array();

        // $this->form_validation->set_rules('menu', 'Menu', 'required');

        // if ($this->form_validation->run() == false) {

        $this->load->view('admin/manajemenuser', $data);
        /* } else {
            $this->db->insert('user_menu',  ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('category_success', 'Menu Telah Ditambahkan');
            redirect('menu');
        } */
    }

    public function lihat_user()
    {
        $data['title'] = "Lihat User";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['lihat_user'] = $this->db->get('user')->result_array();

        $this->load->view('admin/lihat_user', $data);
    }

    public function tambah_user()
    {

        $data['title'] = 'Tambah User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $user = $this->user;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->insertDataUser();

            $this->session->set_flashdata('category_success', 'Data User Berhasil Ditambahkan');
            redirect('admin/manajemenuser');
        }

        $this->load->view('admin/tambah_user', $data);
    }

    public function getEditUser()
    {
        $this->load->model('User_m', 'user');
        echo json_encode($this->user->getUserById($_POST['id']));
    }

    public function edit_user($id)
    {
        if (!isset($id)) redirect('admin/manajemenuser');
        $user = $this->user;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->editDataUser();
            $this->session->set_flashdata('category_success', 'Data Berhasil Diubah');
            redirect('admin/manajemenuser');
        }
        $data["title"] = "Edit Data";
        $data["user"] = $user->getUserById($id);

        $this->load->view('admin/edit_user');
    }

    public function delete_user($id)
    {
        if (!isset($id)) show_404();
        if ($this->user->deleteUser($id) > 0) {
            $this->session->set_flashdata('category_success', 'Data User Berhasil Dihapus');
            redirect('admin/manajemenuser');
        } else {
            $this->session->set_flashdata('category_error', 'Data User Gagal Dihapus');
            redirect('admin/manajemenuser');
        }
    }

    public function konfigurasi()
    {
        $data['title'] = "Konfigurasi";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['delete_user'] = $this->db->get('user')->result_array();

        $this->load->view('admin/konfigurasi', $data);
    }
}
