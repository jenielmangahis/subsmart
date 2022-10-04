<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PlaidErrorLogs_model extends MY_Model
{    
    public $table = 'plaid_error_logs';


    public function getAll($filters=array())
    {
        $this->db->select('plaid_error_logs.*, business_profile.business_name');
        $this->db->from($this->table); 
        $this->db->join('users', 'plaid_error_logs.user_id = users.id', 'left');
        $this->db->join('business_profile', 'users.company_id = business_profile.company_id', 'left');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {                
                $this->db->like('business_profile.business_name', $filters['search'], 'left');
                $this->db->or_like('plaid_error_logs.log_msg', $filters['search'], 'left');
            }
        }

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
}

/* End of file PlaidErrorLogs_model.php */
/* Location: ./application/models/PlaidErrorLogs_model.php */
