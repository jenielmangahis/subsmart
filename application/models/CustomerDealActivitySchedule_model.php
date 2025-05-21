<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDealActivitySchedule_model extends MY_Model
{
    public $table = 'customer_deal_activity_schedules';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCompanyId($company_id, $sort = [])
    {
        $this->db->select('customer_deal_activity_schedules.*, users.FName as owner_firstname, users.LName as owner_lastname');
        $this->db->from($this->table);
        $this->db->join('users', 'customer_deal_activity_schedules.owner_id = users.id', 'left');
        $this->db->where('customer_deal_activity_schedules.company_id', $company_id);
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('customer_deal_activity_schedules.id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getAllByCustomerDealId($customer_deal_id, $sort = [], $filters = [])
    {
        $this->db->select('customer_deal_activity_schedules.*, users.FName as owner_firstname, users.LName as owner_lastname');
        $this->db->from($this->table);
        $this->db->join('users', 'customer_deal_activity_schedules.owner_id = users.id', 'left');
        $this->db->where('customer_deal_activity_schedules.customer_deal_id', $customer_deal_id);

        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }  
        }
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('customer_deal_activity_schedules.id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getById($id)
    {
        $this->db->select('customer_deal_activity_schedules.*, users.FName as owner_firstname, users.LName as owner_lastname,customer_deals.company_id, customer_deals.deal_title');
        $this->db->from($this->table);
        $this->db->join('customer_deals', 'customer_deal_activity_schedules.customer_deal_id = customer_deals.id', 'left');
        $this->db->join('users', 'customer_deal_activity_schedules.owner_id = users.id', 'left');
        $this->db->where('customer_deal_activity_schedules.id', $id);        

        $query = $this->db->get();
        return $query->row();
    }  
    
    public function getByActivityName($activity_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('activity_name', $activity_name);        

        $query = $this->db->get();
        return $query->row();
    }   

    public function getOverdueActivitiesByCustomerDealId($customer_deal_id)
    {
        $this->db->select('customer_deal_activity_schedules.*, users.FName as owner_firstname, users.LName as owner_lastname');
        $this->db->from($this->table);
        $this->db->join('users', 'customer_deal_activity_schedules.owner_id = users.id', 'left');
        $this->db->where('customer_deal_activity_schedules.customer_deal_id', $customer_deal_id);
        $this->db->where('customer_deal_activity_schedules.date_from <', date("Y-m-d"));

        return $this->db->get()->result();
    }

    public function optionsActivityType($key = '')
    {
        $options = [
            'Meeting' => ['name' => 'Meeting', 'icon' => 'bx bx-phone-call'],
            'Task' => ['name' => 'Task', 'icon' => 'bx bx-alarm'],
            'Deadline' => ['name' => 'Deadline', 'icon' => 'bx bx-flag'],
            'Email' => ['name' => 'Email', 'icon' => 'bx bx-envelope-open'],
            'Lunch' => ['name' => 'Lunch', 'icon' => 'bx bx-bowl-rice'],
        ];

        if( $key != '' ){
            return $options[$key];
        }else{
            return $options;
        }
    }

    public function optionsPriority($key = '')
    {
        $options = [
            'None' => ['name' => 'None', 'icon' => 'bx bx-minus-circle', 'color' => ''],
            'High' => ['name' => 'High', 'icon' => 'bx bx-chevrons-up', 'color' => '#d63033'],
            'Medium' => ['name' => 'Medium', 'icon' => 'bx bx-radio-circle', 'color' => '#fae021'],
            'Low' => ['name' => 'Low', 'icon' => 'bx bx-chevrons-down', 'color' => '#4164d4'],
        ]; 

        if( $key != '' ){
            return $options[$key];
        }else{
            return $options;
        }
    }

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
}
