<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDealStage_model extends MY_Model
{
    public $table = 'customer_deal_stages';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCompanyId($company_id, $sort = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('id', 'DESC');
        }

        return $this->db->get()->result();

    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }  
    
    public function getByName($name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('name', $name);

        $query = $this->db->get();
        return $query->row();
    }  

     public function searchAutomations($query) {
        $this->db->like('title', $query);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('automations'); 

        return $query->result();
    }
}
