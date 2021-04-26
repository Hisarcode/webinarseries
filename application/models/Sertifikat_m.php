<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat_m extends CI_Model
{
    private $_table = 'sertifikat';

    public $sertifikat_id;
    public $webinar_id;
    public $tanggal_keluar;
    public $gambar_sertifikat;




    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }

    public function hasSertifikat($webinarId)
    {
        $this->db->select('*');

        $this->db->from('sertifikat');
        $this->db->where('webinar_id', $webinarId);
        $query = $this->db->get()->row();

        if ($query !== null) {
            return true;
        }
        return false;
    }

    public function getListSertifikat()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('webinar', 'webinar.webinar_id = sertifikat.webinar_id');

        return $this->db->get()->result_array();
    }

    public function getSertifikatById($idSertifikat)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('webinar', 'webinar.webinar_id = sertifikat.webinar_id');
        $this->db->where('sertifikat_id', $idSertifikat);
        return $this->db->get()->row_array();
    }

    public function getSertifikatByWebinarId($idWebinar)
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('webinar', 'webinar.webinar_id = sertifikat.webinar_id');
        $this->db->where('sertifikat.webinar_id', $idWebinar);
        return $this->db->get()->row_array();
    }

    private function _generateSertifikatID()
    {

        $this->db->select('RIGHT(sertifikat.sertifikat_id,5) as kode', FALSE);
        $this->db->order_by('sertifikat_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->_table);      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = "2475" . $kodemax;    // hasilnya ODJ-9921-0001 dst.
        return $kodejadi;
    }

    public function rules()
    {
        return [
            [
                'field' => 'webinar_id',
                'label' => 'Nama Webinar',
                'rules' => 'required'
            ]

        ];
    }


    private function _uploadGambarSertifikat($filename)
    {
        $config['upload_path'] = './upload/sertifikat/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['file_name'] = $filename;
        $config['overwrite'] = true;

        $config['max_size'] = 3072;
        $this->upload->initialize($config);
        if ($this->upload->do_upload('gambar_sertifikat')) {

            return $this->upload->data("file_name");
        }

        return "default.jpg";
    }

    public function addDataSertifikat()
    {
        $post = $this->input->post();
        $this->sertifikat_id = $this->_generateSertifikatID();
        $this->webinar_id = $post['webinar_id'];
        $this->tanggal_keluar = $post['tanggal_keluar'];
        $this->updated_at = date('Y-m-d H:i:s');
        $this->created_at = date('Y-m-d H:i:s');

        $this->gambar_sertifikat = $this->_uploadGambarSertifikat($this->sertifikat_id);


        return $this->db->insert($this->_table, $this);
    }

    public function updateDataSertifikat()
    {
        $post = $this->input->post();
        $this->sertifikat_id = $post['sertifikat_id'];
        $this->webinar_id = $post['webinar_id'];
        $this->tanggal_keluar = $post['tanggal_keluar'];
        $this->updated_at = date('Y-m-d H:i:s');


        if (!empty($_FILES["gambar_sertifikat"]["name"])) {
            $this->gambar_sertifikat = $this->_uploadGambarSertifikat($this->sertifikat_id);
        } else {
            $this->gambar_sertifikat  = $post["old_gambar_sertifikat"];
        }

        return $this->db->update($this->_table, $this, array('sertifikat_id' => $this->sertifikat_id));
    }

    public function updateDataSertikat()
    {
        $post = $this->input->post();
        $this->sertifikat_id = $post['sertifikat_id'];
        $this->webinar_id = $post['webinar_id'];
        $this->tanggal_keluar = $post['tanggal_keluar'];
        $this->gambar_sertifikat = $post['gambar_sertifikat'];



        if (!empty($_FILES["gambar_sertifikat"]["name"])) {
            $this->gambar_sertifikat = $this->_uploadGambarSertifikat($this->sertifikat_id);
        } else {
            $this->gambar_sertifikat = $post["old_image"];
        }

        return $this->db->update($this->_table, $this, array('sertifikat_id' => $this->sertifikat_id));
    }

    private function _deleteGambarSertifikat($idSertifikat)
    {
        $sertifikat = $this->getSertifikatById($idSertifikat);
        if ($sertifikat['gambar_sertifikat'] != "default.jpg") {
            $filename = explode(".", $sertifikat['gambar_sertifikat'])[0];
            return array_map('unlink', glob(FCPATH . "upload/poster/$filename.*"));
        }
    }

    public function deleteDataSertifikat($idSertifikat)
    {
        $this->_deleteGambarSertifikat($idSertifikat);
        return $this->db->delete($this->_table, array("sertifikat_id" => $idSertifikat));
    }
}
