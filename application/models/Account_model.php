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

	public function getLastCheckNo($company_id) 
	{
		$this->db->select('accounting_check.check_no as check_no');
		$this->db->from('accounting_check');
		$this->db->where('accounting_check.company_id', $company_id);
		$this->db->order_by('accounting_check.check_no', 'DESC');
		$query = $this->db->get();
	
		foreach ($query->result() as $row) {
			if (!is_null($row->check_no) && $row->check_no !== '0' && $row->check_no !== 0 && trim($row->check_no) !== '') {
				return $row;
			}
		}
	
		return null;
	}

	public function getOwnerDetails($company_id) 
	{
		$role = 3; // Owner
		$userType = 7; //Admin, all access

		$this->db->select('users.id, users.company_id AS company_id, CONCAT(users.FName, " ", users.LName) AS name, users.address AS address, users.city AS city, users.state AS state, users.postal_code AS postal_code');
		$this->db->from('users');
		$this->db->where('users.company_id', $company_id);
		$this->db->where('users.role', $role);
		$this->db->where('users.user_type', $userType);
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->row();
		
		return $result;
	}

	public function getCheckDetails($id, $company_id) 
	{
		$this->db->select('accounting_check.id AS id, accounting_check.company_id AS company_id, accounting_check.payee_type AS payee_type, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name, accounting_vendors.title AS vendor_name, CONCAT(users.FName, " ", users.LName) AS employee_name, accounting_check.payee_id AS payee_id, accounting_check.bank_account_id AS bank_account_id, accounting_chart_of_accounts.name AS bank_account_name, accounting_check.payment_date AS payment_date, accounting_check.check_no AS check_no, accounting_check.to_print AS to_print, accounting_check.memo AS memo, accounting_check.total_amount AS total_amount');
		$this->db->from('accounting_check');
        $this->db->join('accounting_chart_of_accounts', 'accounting_chart_of_accounts.id = accounting_check.bank_account_id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_check.payee_id', 'left');
        $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_check.payee_id', 'left');
        $this->db->join('users', 'users.id = accounting_check.payee_id', 'left');
		$this->db->where('accounting_check.company_id', $company_id);
		$this->db->where('accounting_check.id', $id);
		$this->db->order_by('accounting_check.check_no', 'DESC');
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
}