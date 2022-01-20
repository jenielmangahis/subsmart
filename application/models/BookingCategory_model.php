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

    public function countTotalByCompanyId($company_id)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }       

    public function deleteCategory($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    }  

    public function getAllCategoryProducts()
    {
        $id = logged('id');

        $this->db->select('booking_category.id as bcid, booking_category.name AS category_name,booking_service_items.*');
        $this->db->from($this->table);
        $this->db->join('booking_service_items', 'booking_category.id = booking_service_items.category_id', 'left');
        $this->db->order_by('booking_category.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }   

    public function getAllCategories( $filters = array() )
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            } 
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file BookingCoupon_modal.php */
/* Location: ./application/models/BookingCoupon_modal.php */
