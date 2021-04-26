<?php
class Google_login_m extends CI_Model
{
    function Is_already_register($id)
    {
        $this->db->where('password', $id); // login_oauth_uid
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function Update_user_data($data, $id)
    {
        $this->db->where('password', $id);
        $this->db->update('user', $data);
    }

    function Insert_user_data($data)
    {
        $this->db->insert('user', $data);
    }
}
