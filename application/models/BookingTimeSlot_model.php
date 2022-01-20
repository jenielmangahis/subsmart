<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingTimeSlot_model extends MY_Model
{
    public $table = 'booking_time_slots';
    
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
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function findAllByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function findAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function countTotal()
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where($this->table . '.user_id', $id);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    } 

    public function countTotalByCompanyId($company_id)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }         

    public function deleteAllUserTimeSlots($user_id){
        $this->db->delete($this->table, array('user_id' => $user_id));
    }

    public function deleteUserTimeSlot($id){
        $user_id = logged('id');

        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    }
}

/* End of file BookingTimeSlot_model.php */
/* Location: ./application/models/BookingTimeSlot_model.php */
