<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_report_groups_model extends MY_Model {

	public $table = 'accounting_report_groups';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function get_report_groups()
    {
        return $this->db->get($this->table)->result();
    }

	public function get_report_groups_by_type($type)
    {
		$this->db->where('type', $type);
        return $this->db->get($this->table)->result();
    }
}