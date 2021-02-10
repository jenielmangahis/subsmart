<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends MY_Model {

	public $table = 'account';
	
	public function __construct()
	{
		parent::__construct();
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
}