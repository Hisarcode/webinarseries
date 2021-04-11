<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landingpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Webinar_m', 'webinar');
        $this->load->model('Webinar_Peserta_m', 'webinar_peserta');
    }

    public function index()
    {
        $data['title'] = 'Informatics Webinar Series';
        $data['acara'] = $this->webinar->getJumlahWebinar();
        $data['peserta'] = $this->webinar_peserta->getJumlahPeserta();
        $data['sertifikat'] = 20;
        $data['webinar'] = $this->webinar->getListWebinarObj();

        $this->template->view('pages/landingpage', $data);
    }

    public function webinar($idWebinarEnc)
    {

        $idWebinar = base64_decode(strtr($idWebinarEnc, '._-', '+/='));
        $data['webinar'] = $this->webinar->getWebinarById($idWebinar);

        $this->load->view('pages/detail_webinar', $data);
    }
}
