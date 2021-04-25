<?php

class Template {
    private $ci;

    function __construct()
    {
        $this->ci =& get_instance();
    }

    function view($view, $data = null)
    {
        $data['content'] = $this->ci->load->view($view, $data, TRUE);
        $this->ci->load->view('layouts/landingpage', $data);
    }
}