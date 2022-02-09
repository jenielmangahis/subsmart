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

	public function add_timesheet_activity($data = [])
	{
		$this->db->insert('accounting_weekly_time_activities', $data);
		return $this->db->insert_id();
	}

	public function get_timesheet_activities($data)
	{
		$this->db->where('name_key', $data['name_key']);
		$this->db->where('name_id', $data['name_id']);
		$this->db->where('date >=', $data['start_date']);
		$this->db->where('date <=', $data['end_date']);
		$this->db->where('status', 1);
		$query = $this->db->get('accounting_single_time_activity');

		return $query->result();
	}

	public function get_timesheet($data)
	{
		if(isset($data['name_type'])) {
			$this->db->where('name_type', $data['name_type']);
		}

		if(isset($data['name_id'])) {
			$this->db->where('name_id', $data['name_id']);
		}

		if(isset($data['week_start_date'])) {
			$this->db->where('week_start_date', $data['week_start_date']);
		}

		if(isset($data['week_end_date'])) {
			$this->db->where('week_end_date', $data['week_end_date']);
		}

		$this->db->where('status', 1);
		$query = $this->db->get($this->table);

		return $query->row();
	}

	public function delete_timesheet($timesheetData = [])
	{
		$this->db->where('name_type', $timesheetData['name_key']);
		$this->db->where('name_id', $timesheetData['name_id']);
		$this->db->where('week_start_date', $timesheetData['start_date']);
		$this->db->where('week_end_date', $timesheetData['end_date']);
		$update = $this->db->update($this->table, ['status' => 0]);
		return $update ? true : false;
	}
}