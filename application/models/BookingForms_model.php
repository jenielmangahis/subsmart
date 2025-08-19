<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingForms_model extends MY_Model
{
    public $table = 'booking_forms';
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

    public function getAllCustom($filters=array())
    {
        $user_id = logged('id');
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('is_default', 0);
        $this->db->order_by('sort', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }   

    public function getAllCustomByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('is_default', 0);
        $this->db->order_by('sort', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }  

    public function getAllByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        $this->db->order_by('sort', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }     

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('sort', 'ASC');
        
        $query = $this->db->get();
        return $query->result();
    }   
    
    public function getLastSortNumberByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('sort', 'DESC');

        $query = $this->db->get()->row();
        return $query;
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

    public function getByFieldName($field_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('field_name', $field_name);

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

    public function deleteByUserId($user_id){

        $this->db->delete($this->table, array('user_id' => $user_id));

    }

    public function deleteAllByCompanyId($company_id){

        $this->db->delete($this->table, array('company_id' => $company_id));

    }

    public function isCouponCodeExists($coupon_code)
    {
        $is_exists = false;
        $user_id   = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('coupon_code', $coupon_code);

        $query = $this->db->get()->row();
        if( $query ){
            $is_exists = true;
        }

        return $is_exists;
    }

    public function deleteUserCoupon($id){
        $user_id = logged('id');

        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    }

    public function getAllActive($filters=array())
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

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);
        $this->db->where('status', $this->status_closed);

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function totalActive()
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where($this->table . '.user_id', $id);
        $this->db->where($this->table . '.status', $this->status_active);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }

    public function totalClosed()
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where($this->table . '.user_id', $id);
        $this->db->where($this->table . '.status', $this->status_closed);

        $num_rows = $this->db->count_all_results();
        return $num_rows;
    }

    public function isActive(){
        return $this->status_active;
    }

    public function isClosed(){
        return $this->status_closed;
    }

    public function createFieldName($label){
        $field_name = str_replace(" ", "_", $label);
        $field_name = str_replace("-", "", $field_name);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $field_name);
    }

    public function defaultFormFields()
    {
        $default_form_fields = array(
			'Full Name' => 'full_name',
			'Contact Number' => 'contact_number',
			'Email' => 'email',
			'Address' => 'address',
			'Message' => 'message',
			'Preferred Time To Contact' => 'preferred_time_to_contact',
			'How Did You Hear About Us' => 'how_did_you_hear_about_us',
		);

        return $default_form_fields;
    }
}

/* End of file BookingCoupon_model.php */
/* Location: ./application/models/BookingCoupon_model.php */
