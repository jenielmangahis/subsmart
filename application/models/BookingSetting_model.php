<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingSetting_model extends MY_Model
{
    public $table = 'booking_settings';
    
    public function findById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function findByUserId($user_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function createSetting($data){
        $this->db->insert($this->table,$data);
        
        $last_id = $this->db->insert_id();
        return  $last_id;
    }
} 

/* End of file BookingSetting_model.php */
/* Location: ./application/models/BookingSetting_model.php */
