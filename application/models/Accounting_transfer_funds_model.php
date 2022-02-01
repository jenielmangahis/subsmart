<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_transfer_funds_model extends MY_Model {

    public $table = 'accounting_transfer_funds_transaction';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	function getById($id, $companyId = null) {
		if($companyId) {
			$this->db->where('company_id', $companyId);
		}
		$this->db->where('id', $id);

		$query = $this->db->get($this->table);
		return $query->row();
	}

	function update($id, $data) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);
		if($update) {
			return true;
		} else {
			return false;
		}
	}

	public function get_company_transfers($filters = [])
    {
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('status !=', 0);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}