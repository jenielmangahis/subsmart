<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingWorkOrder_model extends MY_Model
{
    public $table = 'booking_work_orders';
    public $status_active = 1;
    public $status_closed = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);
        $this->db->order_by('sort', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function deleteById($id){

        $this->db->delete($this->table, array('id' => $id));

    }

  
}

/* End of file BookingCoupon_model.php */
/* Location: ./application/models/BookingCoupon_model.php */
