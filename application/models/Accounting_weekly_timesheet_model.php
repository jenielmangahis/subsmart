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

	public function get_by_id($id)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);

		return $query->row();
	}

	public function update($id, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);

		return $update;
	}

	public function get_last_timesheet($nameType, $nameId)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('name_type', $nameType);
		$this->db->where('name_id', $nameId);
		$this->db->order_by('created_at', 'desc');
		$query = $this->db->get($this->table);

		return $query->row();
	}
}