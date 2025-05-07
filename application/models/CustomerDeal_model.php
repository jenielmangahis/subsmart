<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDeal_model extends MY_Model
{
    public $table = 'customer_deals';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->order_by('created_at', 'DESC');

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
