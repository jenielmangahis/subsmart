<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_print_checks_settings_model extends MY_Model {

	public $table = 'accounting_print_checks_settings';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_by_company_id($companyId)
    {
        $this->db->where('company_id', $companyId);
        $query = $this->db->get($this->table);
        return $query->row();
    }

	public function update_by_company_id($companyId, $data)
	{
		$this->db->where('company_id', $companyId);
		$update = $this->db->update($this->table, $data);
		return $update;
	}
}