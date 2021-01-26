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

	function insertBatch($data)
	{
        $this->db->insert_batch($this->table, $data);
	    return $this->db->insert_id();
	}
}