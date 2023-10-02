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

	public function insertPayrollEmployee($data)
	{
		$this->db->insert('accounting_payroll_employees', $data);
		return $this->db->insert_id();
	}

	public function check_if_time_log_paid($date, $empId)
	{
		$this->db->select('accounting_payroll.*');
		$this->db->from('accounting_payroll');
		$this->db->where('accounting_payroll.pay_period_start <=', $date);
		$this->db->where('accounting_payroll.pay_period_end >=', $date);
		$this->db->where('accounting_payroll_employees.employee_id', $empId);
		$this->db->join('accounting_payroll_employees', 'accounting_payroll_employees.payroll_id = accounting_payroll.id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_employee_commissions($empId, $startDate, $endDate)
	{
		$this->db->where('user_id', $empId);
		$this->db->where('DATE(commission_date) >=', $startDate);
		$this->db->where('DATE(commission_date) <=', $endDate);
		$this->db->where('is_paid', 0);
		$query = $this->db->get('employee_commissions');
		return $query->result();
	}

	public function mark_commission_paid($commissionId)
	{
		$this->db->where('id', $commissionId);
		$query = $this->db->update('employee_commissions', ['is_paid' => 1]);
		return $query;
	}
}