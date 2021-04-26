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

	public function get_contractor_types()
	{
		return $this->db->get('accounting_contractor_types')->result();
	}

	public function get_contractor_details($contractorId)
	{
		$this->db->where('contractor_id', $contractorId);
		$query = $this->db->get('accounting_contractor_details');
		return $query->row();
	}

	public function update_basic_contractor_details($contractorId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $contractorId);
		$update = $this->db->update($this->table, $data);

		return $update;
	}

	public function update_contractor_details($contractorId, $data)
	{
		$this->db->where('contractor_id', $contractorId);
		$update = $this->db->update('accounting_contractor_details', $data);

		return $update;
	}

	public function create_contractor_details($data)
	{
		$this->db->insert('accounting_contractor_details', $data);
		return $this->db->insert_id();
	}

	public function update_contractor_status($contractorId, $status)
	{
		$this->db->where('id', $contractorId);
		$update = $this->db->update($this->table, ['status' => $status, 'updated_at' => date("Y-m-d H:i:s")]);

		return $update;
	}
}