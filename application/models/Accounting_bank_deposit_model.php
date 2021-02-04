<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_bank_deposit_model extends MY_Model {

    public $table = 'accounting_bank_deposit';
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	function insertFunds($data)
	{
		$this->db->insert_batch('accounting_bank_deposit_funds', $data);
		return $this->db->insert_id();
	}
}