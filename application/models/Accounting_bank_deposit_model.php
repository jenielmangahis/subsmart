<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_bank_deposit_model extends MY_Model {

    public $table = 'accounting_bank_deposit';
	
	public function __construct()
	{
		parent::__construct();
    }

	function insertBatch($data)
	{
        $this->db->insert_batch($this->table, $data);
	    return $this->db->insert_id();
	}
}