<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingOnlinePayment_model extends MY_Model
{

    public $table = 'setting_online_payments';

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
}

/* End of file SettingOnlinePayment_model.php */
/* Location: ./application/models/SettingOnlinePayment_model.php */
