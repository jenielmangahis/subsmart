<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingInquiry_model extends MY_Model
{
    public $table = 'booking_info';
    
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

    public function findAllByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc");
        $query = $this->db->get();
        return $query->result();
    }
} 

/* End of file BookingSetting_model.php */
/* Location: ./application/models/BookingSetting_model.php */
