<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_user_employment_details_model extends MY_Model {

	public $table = 'accounting_user_employment_details';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function get_employment_details_by_worksite($worksiteId)
    {
        $this->db->where('work_location_id', $worksiteId);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_employment_details($userId)
    {
        $this->db->where('user_id', $userId);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function update_employment_details($userId, $data)
    {
        $this->db->where('user_id', $userId);
        $update = $this->db->update($this->table, $data);
        return $update;
    }
}