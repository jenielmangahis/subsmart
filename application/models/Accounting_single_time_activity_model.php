<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_single_time_activity_model extends MY_Model {

    public $table = 'accounting_single_time_activity';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
    }
    
    function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function update($id, $data)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $id);
        $update = $this->db->update($this->table, $data);

		return $update;
    }

    public function delete_multiple_by_id($ids)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where_in('id', $ids);
        $delete = $this->db->delete($this->table);

        return $delete;
    }

    public function get_by_id($id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        
        return $query->row();
    }

    public function get_company_time_activities($filters = [])
    {
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('status !=', 0);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_company_time_charges($companyId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('status !=', 0);
        $this->db->where('billable', 1);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_customer_time_charges($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $this->db->where('status !=', 0);
        $this->db->where('billable', 1);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}