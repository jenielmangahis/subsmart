<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingCoupon_model extends MY_Model
{
    public $table = 'booking_coupons';
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
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByIdAndCompanyId($id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function isCouponCodeExists($coupon_code)
    {
        $is_exists = false;
        $user_id   = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('coupon_code', $coupon_code);
        $this->db->where('status', 1);

        $query = $this->db->get()->row();
        if( $query ){
            $is_exists = true;
        }

        return $is_exists;
    }

    public function getByCouponCode($coupon_code)
    {
        $user_id   = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('coupon_code', $coupon_code);
        $this->db->where('status', 1);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function deleteUserCoupon($id){
        $user_id = logged('id');

        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    }

    public function deleteCouponByIdAndCompanyId($id, $company_id){
        $this->db->delete($this->table, array('company_id' => $company_id, 'id' => $id));
    }

    public function getAllActive($filters=array())
    {
        $id = logged('id');
        $company_id = logged('company_id');
        $role_id = logged('role');

        $this->db->select('*');
        $this->db->from($this->table);

        /*if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }*/

        if( !empty($filter) ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $this->db->where('status', $this->status_active);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllClosed($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        /*if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }*/

        if( !empty($filter) ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $this->db->where('status', $this->status_closed);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalActive( $filters = array() )
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if( !empty($filter) ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }
        
        $this->db->where('status', $this->status_active);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }

    public function totalClosed( $filters = array() )
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if( !empty($filter) ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $this->db->where('status', $this->status_closed);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }

    public function isActive(){
        return $this->status_active;
    }

    public function isClosed(){
        return $this->status_closed;
    }
}

/* End of file BookingCoupon_model.php */
/* Location: ./application/models/BookingCoupon_model.php */
