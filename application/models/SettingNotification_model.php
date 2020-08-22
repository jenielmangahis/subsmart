<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingNotification_model extends MY_Model
{

    public $table = 'setting_notifications';

    public function getAllByUserId($user_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function findByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function deleteByUserId($user_id){
        $this->db->delete($this->table, array('user_id' => $user_id));
    }    
}

/* End of file SettingEmailBranding_model.php */
/* Location: ./application/models/SettingEmailBranding_model.php */
