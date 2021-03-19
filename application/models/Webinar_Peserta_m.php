<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Webinar_Peserta_m extends CI_Model
{
    private $_table = 'webinar_peserta';

    public $webinar_id;
    public $user_id;
    public $is_register = 1;
    public $is_presence = 0;
    public $is_certificate = 0;


    public function __construct()
    {
        parent::__construct();
    }

    public function hasRegistered($webinarId, $userId)
    {
        $this->db->select('is_register');

        $this->db->from($this->_table);
        $this->db->where('webinar_id', $webinarId);
        $this->db->where('user_id', $userId);
        return $this->db->get()->row();
    }

    public function registerWebinar($webinarId, $userId)
    {
        // $this->webinar_peserta_id = $this->_generateWebinarID();
        $this->webinar_id =  $webinarId;
        $this->user_id =  $userId;
        $this->is_register = 1;
        $this->is_presence = 0;
        $this->is_certificate = 0;
        $this->created_at;
        $this->updated_at;

        return $this->db->insert($this->_table, $this);
    }

    public function getWebinarPesertaById($idWebinarPeserta)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        //example of join 3 table 
        $this->db->join('webinar', 'webinar.webinar_id = webinar_peserta.webinar_id');
        $this->db->where('webinar_peserta_id', $idWebinarPeserta);
        return $this->db->get()->row_array();
    }


    public function getListByUserId($userId)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('user_id', $userId);
        $this->db->join('webinar', 'webinar.webinar_id = webinar_peserta.webinar_id');

        return $this->db->get()->result_array();
    }

    public function getListByUserIdPresence($userId)
    {
        $this->db->select('*');

        $this->db->from($this->_table);
        $this->db->join('webinar', 'webinar.webinar_id = webinar_peserta.webinar_id');
        $this->db->where('user_id', $userId);
        $this->db->where('webinar.presence', 1);

        return $this->db->get()->result_array();
    }

    public function getListByWebinarId($idWebinar)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('webinar_peserta.webinar_id', $idWebinar);
        $this->db->join('webinar', 'webinar.webinar_id = webinar_peserta.webinar_id');
        $this->db->join('user', 'user.id = webinar_peserta.user_id');

        return $this->db->get()->result_array();
    }

    public function cancelWebinar($idWebinar, $userId)
    {
        return $this->db->delete($this->_table, array("webinar_id" => $idWebinar, "user_id" => $userId));
    }

    public function sendSertifikat($webinarId)
    {
        $data = array(
            'is_certificate' => 1
        );
        $this->db->where('webinar_id', $webinarId);
        return $this->db->update('webinar_peserta', $data);
    }
    public function presence($idWebinarPeserta)
    {
        $data = array(
            'is_presence' => 1
        );
        $this->db->where('webinar_peserta_id', $idWebinarPeserta);
        return $this->db->update('webinar_peserta', $data);
    }
}
