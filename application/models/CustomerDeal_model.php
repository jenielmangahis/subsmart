<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDeal_model extends MY_Model
{
    public $table = 'customer_deals';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCompanyId($company_id, $sort = [], $filters = [])
    {
        $this->db->select('customer_deals.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname, acs_profile.business_name AS customer_business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_deals.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_deals.company_id', $company_id);
        
        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('customer_deals.id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getAllArchivedByCompanyId($company_id, $sort = [])
    {
        $this->db->select('customer_deals.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname, acs_profile.business_name AS customer_business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_deals.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_deals.company_id', $company_id);
        $this->db->where('is_archive', 'Yes');
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('customer_deals.id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getAllByCustomerDealStageId($customer_deal_stage_id, $sort = [], $filters = [])
    {
        $this->db->select('customer_deals.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname, acs_profile.business_name AS customer_business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_deals.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_deals.customer_deal_stage_id', $customer_deal_stage_id);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('customer_deals.id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getAllByExpectedCloseDate($date_range = [], $sort = [], $filters = [])
    {
        $this->db->select('customer_deals.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname, acs_profile.business_name AS customer_business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_deals.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_deals.expected_close_date >=', $date_range['from']);
        $this->db->where('customer_deals.expected_close_date <=', $date_range['to']);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('customer_deals.id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getSumValueByCustomerDealStageId($customer_deal_stage_id, $filters = [])
    {
        $this->db->select('COALESCE(SUM(value),0) AS total_value');
        $this->db->from($this->table);
        $this->db->where('customer_deals.customer_deal_stage_id', $customer_deal_stage_id);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getSumValueByDateRange($date_range, $filters = [])
    {
        $this->db->select('COALESCE(SUM(value),0) AS total_value');
        $this->db->from($this->table);
        $this->db->where('customer_deals.expected_close_date >=', $date_range['from']);
        $this->db->where('customer_deals.expected_close_date <=', $date_range['to']);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getSumValueByStatus($status, $filters = [])
    {
        $this->db->select('COALESCE(SUM(value),0) AS total_value');
        $this->db->from($this->table);
        $this->db->where('customer_deals.status', $status);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getSumValueByCompanyId($company_id, $filters = [])
    {
        $this->db->select('COALESCE(SUM(value),0) AS total_value');
        $this->db->from($this->table);
        $this->db->where('customer_deals.company_id', $company_id);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $query = $this->db->get();
        return $query->row();
    }

    public function getById($id)
    {
        $this->db->select('customer_deals.*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname, acs_profile.business_name AS customer_business_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_deals.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_deals.id', $id);        

        $query = $this->db->get();
        return $query->row();
    }  

    public function optionSourceChannel()
    {
        $options = [
            'None' => 'None',
            'Messaging Inbox' => 'Messaging Inbox',
            'Marketplace' => 'Marketplace',
            'Campaigns' => 'Campaigns',
            'Web visitors' => 'Web visitors',
            'Live chat' => 'Live chat',
            'Chatbot' => 'Chatbot',
            'Web forms' => 'Web forms',
            'Lead Suggestions' => 'Lead Suggestions',
            'Inspector' => 'Inspector'
        ];

        return $options;
    }

    public function optionVisibleTo()
    {
        $options = [
            'Item Owner' => 'Item Owner',
            'All Users' => 'All Users'
        ];

        return $options;
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
}
