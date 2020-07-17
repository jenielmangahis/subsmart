<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingCategory_model extends MY_Model
{
    public $table = 'booking_category';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file BookingCoupon_modal.php */
/* Location: ./application/models/BookingCoupon_modal.php */
