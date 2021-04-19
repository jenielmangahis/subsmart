<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_contractors_model extends MY_Model {

	public $table = 'accounting_contractors';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_company_contractors($status)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where_in('status', $status);
		$this->db->order_by('name', 'asc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function add_company_contractor($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_contractor($contractorId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $contractorId);
		$query = $this->db->get($this->table);
		return $query->row();
	}
}