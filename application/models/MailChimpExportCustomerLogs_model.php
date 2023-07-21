
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MailChimpExportCustomerLogs_model extends MY_Model
{
    public $table = 'mailchimp_export_customer_logs';

    public function getAll($filters=array(), $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);        

        if ( !empty($filters['search']) ){
            $this->db->group_start();
            foreach($filters['search'] as $f){                
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
            $this->db->group_end();
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotSync($limit = 0)
    {
        $this->db->select('*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_last_name');
        $this->db->from($this->table);   
        $this->db->join('acs_profile', 'mailchimp_export_customer_logs.customer_id  = acs_profile.prof_id', 'left');     
        $this->db->where('mailchimp_export_customer_logs.is_sync', 0);
        $this->db->where('mailchimp_export_customer_logs.is_with_error', 0);
        
        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('mailchimp_export_customer_logs.id', 'ASC');

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

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('company_id', $company_id); 

        if ( !empty($filters['search']) ){
            $this->db->group_start();
            foreach($filters['search'] as $f){                
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
            $this->db->group_end();
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByListId($mailchimp_list_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('mailchimp_list_id', $mailchimp_list_id);    
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByListIdAndCompanyId($mailchimp_list_id, $company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('mailchimp_list_id', $mailchimp_list_id);    
        $this->db->where('company_id', $company_id);    
        
        if ( !empty($filters) ){            
            foreach($filters as $f){               
                $this->db->where($f['field'], $f['value']);            
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByCustomerId($customer_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCustomerIdAndListId($customer_id, $mailchimp_list_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        $this->db->where('mailchimp_list_id', $mailchimp_list_id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCustomerEmailAndListId($customer_email, $mailchimp_list_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_email', $customer_email);
        $this->db->where('mailchimp_list_id', $mailchimp_list_id);
        
        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file MailChimpExportCustomerLogs_model.php */
/* Location: ./application/models/MailChimpExportCustomerLogs_model.php */
