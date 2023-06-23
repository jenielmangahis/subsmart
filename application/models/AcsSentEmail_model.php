<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsSentEmail_model extends MY_Model
{
    public $table = 'acs_sent_emails';
    
    public function getAll($filters=array())
    {

        $this->db->select('*');
        $this->db->from($this->table);        
        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {                
                $this->db->like('from_number', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotSent($limit)
    {

        $this->db->select('*');
        $this->db->from($this->table);  
        $this->db->where('is_sent', 0);
        $this->db->where('is_with_error', 0);

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('company_id', $company_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->group_start();
                $this->db->like('subject', $filters['search'], 'both');
                $this->db->or_like('message', $filters['search'], 'both');
                $this->db->group_end();
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCustomerId($customer_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->group_start();
                $this->db->like('subject', $filters['search'], 'both');
                $this->db->or_like('message', $filters['search'], 'both');
                $this->db->group_end();
            }
        }

        $this->db->order_by('company_sms.date_created', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file AcsSentEmail_model.php */
/* Location: ./application/models/AcsSentEmail_model.php */
