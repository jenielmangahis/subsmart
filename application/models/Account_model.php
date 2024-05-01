<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends MY_Model {

	public $table = 'account';
	
	public function __construct()
	{
		parent::__construct();
	}
	function getAccounts()
	{
		$this->db->where('status', 1);
        $query = $this->db->get($this->table);
	    return $query->result();
	}
	function getName($account_id)
	{
		$this->db->select('account_name');
	    $this->db->from('account');
	    $this->db->where('id', $account_id);
	    return $this->db->get()->row()->account_name;
	}

	function getemployee(){
	    $employee = $this->db->get('acs_profile');
	    return $employee->result();
	}

	public function getById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function getAccTypeByName($types)
	{
		$this->db->where('status', 1);
		if(is_array($types)) {
			$this->db->where_in('account_name', $types);
		} else {
			$this->db->where('account_name', $types);
		}
		$this->db->order_by('account_name', 'asc');
		$query = $this->db->get($this->table);
		if(is_array($types)) {
			return $query->result();
		} else {
			return $query->row();
		}
	}

	public function createQuoteBusiness($data)
	{
		$vendor = $this->db->insert('quote_business', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function createQuoteManagement($data)
	{
		$vendor = $this->db->insert('quote_management', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function createQuoteEmployees($data)
	{
		$vendor = $this->db->insert('quote_employees', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function createQuoteContacts($data)
	{
		$vendor = $this->db->insert('quote_contacts', $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function get_by_name($name)
	{
		$this->db->where('LOWER(account_name)', strtolower($name));
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function getLastCheckAccount($company_id) {
		$this->db->select('accounting_chart_of_accounts.id AS account_id, accounting_chart_of_accounts.name AS account_name');
		$this->db->from('accounting_check');
		$this->db->join('accounting_chart_of_accounts', 'accounting_chart_of_accounts.id = accounting_check.bank_account_id');
		$this->db->where('accounting_check.company_id', $company_id);
		$this->db->order_by('accounting_check.created_at', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}

	public function getLastCheckNo($company_id) {
		$this->db->select('accounting_assigned_checks.check_no as check_no');
		$this->db->from('accounting_assigned_checks');
		$this->db->order_by('accounting_assigned_checks.created_at', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}