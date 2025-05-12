<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDeal_model extends MY_Model
{
    public $table = 'customer_deal_activity_schedules';

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

    public function optionsActivityType()
    {
        $options = [
            'Meeting' => 'Meeting',
            'Task' => 'Task',
            'Deadline' => 'Deadline',
            'Email' => 'Email',
            'Lunch' => 'Lunch'
        ];

        return $options;
    }

    public function optionsPriority()
    {
        $options = [
            'None' => 'None',
            'High' => 'High',
            'Medium' => 'Medium',
            'Low' => 'Low'
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
