<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_statements_model extends MY_Model {

    public $table = 'accounting_statements';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
    }

    function insertCustomers($data)
    {
        $this->db->insert_batch('accounting_statement_customers', $data);
	    return $this->db->insert_id();
    }
}