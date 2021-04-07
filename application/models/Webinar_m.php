<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Webinar_m extends CI_Model
{
    private $_table = 'webinar';
    public $webinar_id;
    public $webinar_nama;
    public $tanggal;
    public $jam;
    public $webinar_media_id;
    public $narasumber;
    public $poster;
    public $created_at;
    public $is_active = 1;
    public $deskripsi;
    public $link_media;


    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }

    public function getJumlahWebinar()
    {
        return $this->db->count_all($this->_table);
    }

    private function _generateWebinarID()
    {

        $this->db->select('RIGHT(webinar.webinar_id,6) as kode', FALSE);
        $this->db->order_by('webinar_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('webinar');      //cek dulu apakah ada sudah ada kode di tabel.    
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

    public function rules()
    {
        return [
            [
                'field' => 'webinar_nama',
                'label' => 'Nama Webinar',
                'rules' => 'required'
            ],

            [
                'field' => 'tanggal',
                'label' => 'Tanggal',
                'rules' => 'required|max_length[10]'
            ],

            [
                'field' => 'jam',
                'label' => 'Jam',
                'rules' => 'required|max_length[8]'
            ],

            [
                'field' => 'media_id',
                'label' => 'Media',
                'rules' => 'required'
            ],
            [
                'field' => 'narasumber',
                'label' => 'Narasumber',
                'rules' => 'required'
            ]
        ];
    }

    public function getMedia()
    {
        return $this->db->get('media')->result_array();
    }

    public function getListWebinar()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('media', 'media_id = webinar_media_id');
        $this->db->order_by('tanggal', 'DESC');


        return $this->db->get()->result_array();
    }

    public function getListWebinarObj()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('media', 'media_id = webinar_media_id');
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

    public function getWebinarById($idWebinar)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        //example of join 3 table 
        $this->db->join('media', 'media_id = webinar_media_id');
        $this->db->where('webinar_id', $idWebinar);
        return $this->db->get()->row_array();
    }

    private function _uploadPoster($filename)
    {
        $config['upload_path'] = './upload/webinar/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['file_name'] = $filename;
        $config['overwrite'] = true;

        $config['max_size'] = 3072;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('poster')) {

            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    public function addDataWebinar()
    {
        $post = $this->input->post();
        $this->webinar_id = $this->_generateWebinarID();
        $this->webinar_nama =  htmlspecialchars($post['webinar_nama']);
        $strTanggal = date("Y-m-d", strtotime($post['tanggal']));
        $this->tanggal =  $strTanggal;

        $this->jam =  $post['jam'];
        $this->webinar_media_id = $post['media_id'];
        $this->deskripsi = nl2br($post['deskripsi']);
        $this->link_media = $post['link_media'];
        $this->narasumber = $post['narasumber'];
        $this->created_at = date('Y-m-d H:i:s');

        $this->poster = $this->_uploadPoster($this->webinar_id);


        return $this->db->insert($this->_table, $this);
    }

    public function updateDataWebinar()
    {
        $post = $this->input->post();
        $this->webinar_id = $post["webinar_id"];
        $this->webinar_nama =  htmlspecialchars($post['webinar_nama']);
        $this->tanggal =  $post['tanggal'];
        $this->jam =  $post['jam'];
        $this->webinar_media_id = $post['media_id'];
        $this->deskripsi = nl2br($post['deskripsi']);
        $this->narasumber = $post['narasumber'];


        if (!empty($_FILES["poster"]["name"])) {
            $this->poster = $this->_uploadPoster($this->webinar_id);
        } else {
            $this->poster = $post["old_poster"];
        }

        return $this->db->update($this->_table, $this, array('webinar_id' => $post["webinar_id"]));
    }

    private function _deletePoster($idWebinar)
    {
        $webinar = $this->getWebinarById($idWebinar);
        if ($webinar['poster'] != "default.jpg") {
            $filename = explode(".", $webinar['poster'])[0];
            return array_map('unlink', glob(FCPATH . "upload/poster/$filename.*"));
        }
    }

    public function deleteDataWebinar($idWebinar)
    {
        $this->_deletePoster($idWebinar);
        return $this->db->delete($this->_table, array("webinar_id" => $idWebinar));
    }

    public function deactiveWebinar($idWebinar)
    {
        $data = array(
            'is_active' => 0,
            'created_at' => date('Y-m-d H:i:s')

        );
        $this->db->where('webinar_id', $idWebinar);
        return $this->db->update('webinar', $data);
    }

    public function activeWebinar($idWebinar)
    {
        $data = array(
            'is_active' => 1
        );
        $this->db->where('webinar_id', $idWebinar);
        return $this->db->update('webinar', $data);
    }

    public function activeWebinarPresent($idWebinar)
    {
        $data = array(
            'presence' => 1
        );
        $this->db->where('webinar_id', $idWebinar);
        return $this->db->update('webinar', $data);
    }

    public function nonactiveWebinarPresent($idWebinar)
    {
        $data = array(
            'presence' => 0
        );
        $this->db->where('webinar_id', $idWebinar);
        return $this->db->update('webinar', $data);
    }

    public function editDataLink($data)
    {
        $this->db->where('webinar_id', $data['id']);
        $this->db->update('webinar', array(
            'link_media' => $data['link_media']
        ));
        return $this->db->affected_rows();
    }
}
