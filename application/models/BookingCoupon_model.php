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

    public function getByName($name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('coupon_name', $name);

        $query = $this->db->get()->row();
        return $query;
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
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('coupon_code', $coupon_code);
        //$this->db->where('status', 1);
        
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

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllActive($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

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
        $this->db->select('*');
        $this->db->from($this->table);

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
        $this->db->select('COALESCE(COUNT(id),0) AS total');
        $this->db->from($this->table);
        $this->db->where('status', $this->status_active);

        if( !empty($filter) ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }
        
        $query = $this->db->get();
        return $query->row();
    }

    public function totalClosed( $filters = array() )
    {
        $this->db->select('COALESCE(COUNT(id),0) AS total');
        $this->db->from($this->table);
        $this->db->where('status', $this->status_closed);

        if( !empty($filter) ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function isActive(){
        return $this->status_active;
    }

    public function isClosed(){
        return $this->status_closed;
    }

    public function isCompanyCouponCodeExists($coupon_code, $company_id)
    {
        $is_exists = false;
        $user_id   = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->where('coupon_code', $coupon_code);
        $this->db->where('status', $this->status_active);

        $query = $this->db->get()->row();
        if( $query ){
            $is_exists = true;
        }

        return $is_exists;
    }
}


/* End of file BookingCoupon_model.php */
/* Location: ./application/models/BookingCoupon_model.php */
