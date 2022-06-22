<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyCallLogs_model extends MY_Model
{
    public $table = 'company_call_logs';
    public $api_twilio = 'twilio';
    public $api_ringcentral = 'ringcentral';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('company_call_logs.*, CONCAT(users.FName, " ", users.LName)AS sender_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_call_logs.user_id = users.id', 'left');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('from_number', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('company_call_logs.*, CONCAT(users.FName, " ", users.LName)AS sender_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_call_logs.user_id = users.id', 'left');
        $this->db->where('company_call_logs.company_id', $company_id);

        if ( !empty($filters['search']) ){
            $this->db->like('company_call_logs.to_number', $filters['search'], 'both');        
        }

        $this->db->order_by('company_call_logs.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByProfId($prof_id, $filters=array())
    {
        $this->db->select('company_call_logs.*, users.FName, users.LName, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_call_logs.user_id = users.id', 'left');
        $this->db->join('acs_profile', 'company_call_logs.prof_id = acs_profile.prof_id', 'left');
        $this->db->where('company_call_logs.prof_id', $prof_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('company_call_logs.to_number', $filters['search'], 'both');
                $this->db->or_like('company_call_logs.txt_message', $filters['search'], 'both');
            }
        }

        $this->db->order_by('company_call_logs.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByProfIdAndUserId($prof_id, $user_id, $filters=array())
    {
        $this->db->select('company_call_logs.*, users.FName, users.LName, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_call_logs.user_id = users.id', 'left');
        $this->db->join('acs_profile', 'company_call_logs.prof_id = acs_profile.prof_id', 'left');
        $this->db->where('company_call_logs.prof_id', $prof_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('company_call_logs.to_number', $filters['search'], 'both');
                $this->db->or_like('company_call_logs.txt_message', $filters['search'], 'both');
            }
        }

        $this->db->order_by('company_call_logs.id', 'ASC');

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

    public function getByProfId($prof_id)
    {
        $this->db->select('company_call_logs.*, users.FName, users.LName, acs_profile.first_name, acs_profile.last_name');    
        $this->db->from($this->table);
        $this->db->join('users', 'company_call_logs.user_id = users.id', 'left');
        $this->db->join('acs_profile', 'company_call_logs.prof_id = acs_profile.prof_id', 'left');
        $this->db->where('company_call_logs.prof_id', $prof_id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function apiTwilio()
    {
        return $this->api_twilio;
    }

    public function apiRingCentral()
    {
        return $this->api_ringcentral;
    }
}

/* End of file CompanyCallLogs_model.php */
/* Location: ./application/models/CompanyCallLogs_model.php */
