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
		$this->db->insert('accounting_custom_report_groups', ['name' => $name, 'company_id' => logged('company_id')]);
		return $this->db->insert_id();
	}

	public function add_custom_report($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function check_name($name, $companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('name', $name);
		return $this->db->get($this->table)->row();
	}

	public function update_custom_report($customReportId, $data)
	{
		$this->db->where('id', $customReportId);
		return $this->db->update($this->table, $data);
	}

	public function get_custom_report_groups($companyId)
	{
		$this->db->where('company_id', $companyId);
		$query = $this->db->get('accounting_custom_report_groups');
		return $query->result();
	}
}