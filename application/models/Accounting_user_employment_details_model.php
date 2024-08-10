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
        $this->db->select('accounting_user_employment_details.*,accounting_worksites.name AS worksite_name, accounting_worksites.street AS worksite_address, accounting_worksites.city AS worksite_city, accounting_worksites.state AS worksite_state, accounting_worksites.zip_code AS worksite_zipcode');
        $this->db->from($this->table);
        $this->db->join('accounting_worksites', 'accounting_user_employment_details.work_location_id = accounting_worksites.id', 'left');
        $this->db->where('accounting_user_employment_details.user_id', $userId);

        $query = $this->db->get();
        return $query->row();
    }

    public function update_employment_details($userId, $data)
    {
        $this->db->where('user_id', $userId);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    public function get_all_employment_details($userId)
    {
        $this->db->select('accounting_user_employment_details.*,accounting_worksites.name AS worksite_name, accounting_worksites.street AS worksite_address, accounting_worksites.city AS worksite_city, accounting_worksites.state AS worksite_state, accounting_worksites.zip_code AS worksite_zipcode');
        $this->db->from($this->table);
        $this->db->join('accounting_worksites', 'accounting_user_employment_details.work_location_id = accounting_worksites.id', 'left');
        $this->db->where('accounting_user_employment_details.user_id', $userId);

        $query = $this->db->get();
        return $query->result();
    }
}