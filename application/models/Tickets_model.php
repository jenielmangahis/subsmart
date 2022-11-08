<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends MY_Model
{

    public $table = 'tickets';

    public function save_tickets($data)
    {
        $custom = $this->db->insert($this->table, $data);
        $insert = $this->db->insert_id();
		return  $insert;
    }

    public function get_tickets_data()
    {
        $company_id = logged('company_id');
        
        $where = array(
            'tickets.company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'tickets.customer_id  = acs_profile.prof_id');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    
    public function add_ticket_items($data)
    {
        $vendor = $this->db->insert('tickets_items', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function saveServiceType($data)
    {
        $data = $this->db->insert('service_type', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }
    
    public function save_payment($data)
    {
        $vendor = $this->db->insert('tickets_payments', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function get_tickets_data_one($id)
    {
        $company_id = logged('company_id');
        
        $where = array(
            'id' => $id,
        );

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'tickets.customer_id  = acs_profile.prof_id');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function  getServiceType($company_id)
    {
        $where = array(
            'company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from('service_type');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_tickets_company($id)
    {

        $where = array(
            'id' => $id,
        );

        $this->db->select('*');
        $this->db->from('clients');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ticket_representative($ticket_rep)
    {
        $where = array(
            'id' => $ticket_rep,
        );

        $this->db->select('*');
        $this->db->from('users');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_ticket_items($id)
    {
        $where = array(
            'ticket_id' => $id,
        );

        $this->db->select('*, tickets_items.cost AS costing');
        $this->db->from('tickets_items');
        $this->db->join('items', 'tickets_items.items_id  = items.id');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ticket_payments($id)
    {
        $where = array(
            'ticket_id' => $id,
        );

        $this->db->select('*');
        $this->db->from('tickets_payments');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUserDetails($id)
    {
        $where = array(
            'id' => $id,
        );

        $this->db->select('*');
        $this->db->from('users');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_tickets_by_company_id($company_id = 0)
    {
        $this->db->select('tickets.*, acs_profile.first_name,acs_profile.last_name, users.FName, users.LName');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = tickets.customer_id', 'left');        
        $this->db->join('users', 'users.id = tickets.sales_rep', 'left');        
        $this->db->where('tickets.company_id', $company_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_upcoming_tickets_by_company_id($company_id = 0)
    {
        $start_date = date('m/d/Y');

        $this->db->select('tickets.*, acs_profile.first_name,acs_profile.last_name,acs_profile.phone_m');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = tickets.customer_id', 'left');        
        $this->db->where('tickets.company_id', $company_id);
        $this->db->where('tickets.ticket_date >=',$start_date);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
}

?>