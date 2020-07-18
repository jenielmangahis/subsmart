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

    public function countTotal()
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where($this->table . '.user_id', $id);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }    

    public function deleteCategory($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    }     

}

/* End of file BookingCoupon_modal.php */
/* Location: ./application/models/BookingCoupon_modal.php */
