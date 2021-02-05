<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_weekly_timesheet_model extends MY_Model {

    public $table = 'accounting_weekly_timesheet';
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	function insertEmployeeTimesheet($data)
	{
		$this->db->insert_batch('accounting_weekly_timesheet_items', $data);
		return $this->db->insert_id();
	}
}