<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_transfer_funds_model extends MY_Model {

    public $table = 'accounting_transfer_funds_transaction';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}
}