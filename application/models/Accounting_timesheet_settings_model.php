<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_timesheet_settings_model extends MY_Model {

    public $table = 'accounting_timesheet_settings';
	
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

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($companyId, $data)
    {
        $this->db->where('company_id', $companyId);
        $update = $this->db->update($this->table, $data);
        return $update;
    }
}