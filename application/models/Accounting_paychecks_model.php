<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_paychecks_model extends MY_Model {

    public $table = 'accounting_paychecks';    
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert_by_batch($data)
	{
        $this->db->insert_batch($this->table, $data);
        return $this->db->insert_id();
	}

	public function get_company_paychecks($companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('status', 1);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function update_check_no($id, $checkNumber)
	{
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, ['check_no' => $checkNumber]);
		return $update ? true : false;
	}

	public function void_paycheck($paycheckId)
	{
		$this->db->where('id', $paycheckId);
		$update = $this->db->update($this->table, ['status' => 4]);
		return $update ? true : false;
	}
}