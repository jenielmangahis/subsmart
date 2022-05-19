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

	function getById($id) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);
		$this->db->where('status', 1);

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
}