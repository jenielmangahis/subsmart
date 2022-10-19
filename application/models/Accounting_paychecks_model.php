<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_paychecks_model extends MY_Model {

    public $table = 'accounting_paychecks';    
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function insert_by_batch($data)
	{
        $this->db->insert_batch($this->table, $data);
        return $this->db->insert_id();
	}
}