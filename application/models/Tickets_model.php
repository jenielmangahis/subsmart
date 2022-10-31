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
            'company_id' => $company_id,
        );

        $this->db->select('*');
        $this->db->from($this->table);
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

    public function get_ticket_items($id)
    {
        $where = array(
            'ticket_id' => $id,
        );

        $this->db->select('*');
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
}

?>