<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_single_time_activity_model extends MY_Model {

    public $table = 'accounting_single_time_activity';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
    }
    
    function getAll()
    {
        return $this->db->get($this->table)->result();
    }
}