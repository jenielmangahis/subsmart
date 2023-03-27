<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_custom_reports_model extends MY_Model {

	public $table = 'accounting_custom_reports';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function add_custom_report_group($name)
	{
		$this->db->insert('accounting_custom_report_groups', ['name' => $name]);
		return $this->db->insert_id();
	}

	public function add_custom_report($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
}