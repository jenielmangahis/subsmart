<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanySms_model extends MY_Model
{
    public $table = 'company_sms';
    public $api_twilio = 'twilio';
    public $api_ringcentral = 'ringcentral';
    public $api_default = 'no_sms';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('company_sms.*, CONCAT(users.FName, " ", users.LName)AS sender_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_sms.user_id = users.id', 'left');

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
        $this->db->select('company_sms.*, CONCAT(users.FName, " ", users.LName)AS sender_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_sms.user_id = users.id', 'left');
        $this->db->where('company_sms.company_id', $company_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('company_sms.to_number', $filters['search'], 'both');
                $this->db->or_like('company_sms.txt_message', $filters['search'], 'both');
            }
        }

        $this->db->order_by('company_sms.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByProfId($prof_id, $filters=array())
    {
        $this->db->select('company_sms.*, users.FName, users.LName, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_sms.user_id = users.id', 'left');
        $this->db->join('acs_profile', 'company_sms.prof_id = acs_profile.prof_id', 'left');
        $this->db->where('company_sms.prof_id', $prof_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('company_sms.to_number', $filters['search'], 'both');
                $this->db->or_like('company_sms.txt_message', $filters['search'], 'both');
            }
        }

        $this->db->order_by('company_sms.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByProfIdAndUserId($prof_id, $user_id, $filters=array())
    {
        $this->db->select('company_sms.*, users.FName, users.LName, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('users', 'company_sms.user_id = users.id', 'left');
        $this->db->join('acs_profile', 'company_sms.prof_id = acs_profile.prof_id', 'left');
        $this->db->where('company_sms.prof_id', $prof_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('company_sms.to_number', $filters['search'], 'both');
                $this->db->or_like('company_sms.txt_message', $filters['search'], 'both');
            }
        }

        $this->db->order_by('company_sms.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllUniqueSenderByProfId($prof_id, $filters=array())
    {
        $this->db->select('company_sms.*, users.FName, users.LName, acs_profile.first_name, acs_profile.last_name, users.email AS user_email, users.mobile');
        $this->db->from($this->table);
        $this->db->join('users', 'company_sms.user_id = users.id', 'left');
        $this->db->join('acs_profile', 'company_sms.prof_id = acs_profile.prof_id', 'left');
        $this->db->where('company_sms.prof_id', $prof_id);
        $this->db->where('company_sms.user_id >', 0);
        $this->db->group_by('company_sms.user_id');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {                
                $this->db->like('users.FName', $filters['search'], 'both');
                $this->db->or_like('users.LName', $filters['search'], 'both');
                $this->db->or_like('users.mobile', $filters['search'], 'both');
            }
        }

        $this->db->order_by('company_sms.id', 'DESC');

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

    public function ringCentralCompanyIds()
    {
        $cid = [1,28,52];

        return $cid;
    }

    public function getCustomerLastMessageByUserIdAndProfId($user_id, $prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('user_id', $user_id);
        $this->db->where('prof_id', $prof_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getCustomerLastMessageByProfId($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table); 
        $this->db->where('prof_id', $prof_id);
        $this->db->order_by('id', 'DESC');

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

    public function apiDefault()
    {
        return $this->api_default;
    }
}

/* End of file CompanySms_model.php */
/* Location: ./application/models/CompanySms_model.php */
