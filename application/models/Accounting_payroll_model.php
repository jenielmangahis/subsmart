<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_payroll_model extends MY_Model {

    public $table = 'accounting_payroll';    
	
	public function __construct()
	{
		parent::__construct();
	}
	
	function getCompanyLastPayrollNo($company_id)
	{
		$this->db->where('company_id', $company_id);
		$this->db->order_by('payroll_no', 'desc');
		$query = $this->db->get($this->table);
		return $query->row()->payroll_no;
	}

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	function insertPayrollEmployees($data)
	{
		$this->db->insert_batch('accounting_payroll_employees', $data);
		return $this->db->insert_id();
	}

	public function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function get_payroll_item($payrollItemId)
	{
		$this->db->where('id', $payrollItemId);
		$query = $this->db->get('accounting_payroll_employees');
		return $query->row();
	}
}