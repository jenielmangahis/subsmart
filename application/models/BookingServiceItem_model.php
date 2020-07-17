<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingServiceItem_model extends MY_Model
{
    public $table = 'booking_service_items';

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

    public function getAllItemsGroupByCategoryArray() {

        $result_group_array = array();
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
        $results = $query->result();    

        if($results) {
            foreach($results as $result) {
                $result_group_array[$result->category_id][] = $result;
            }
        }

        return $result_group_array;     
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

    public function deleteServiceItem($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    }    

}

/* End of file BookingCoupon_modal.php */
/* Location: ./application/models/BookingCoupon_modal.php */
