<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_bank_accounts extends MY_Model {

	public $table = 'accounting_bank_accounts';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getAllBanks()
	{
		$company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
	}

	
}