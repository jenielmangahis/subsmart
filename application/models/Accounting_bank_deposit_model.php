<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_bank_deposit_model extends MY_Model {

    public $table = 'accounting_bank_deposit';
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	function insertFunds($data)
	{
		$this->db->insert_batch('accounting_bank_deposit_funds', $data);
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

	function getFunds($deposit_id) {
		return $this->db->where('bank_deposit_id', $deposit_id)->get('accounting_bank_deposit_funds')->result();
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

	public function delete_deposit($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	function deleteFunds($deposit_id) {
		return $this->db->where('bank_deposit_id', $deposit_id)->delete('accounting_bank_deposit_funds');
	}

	public function update_fund($id, $depositId, $data)
	{
		$this->db->where('id', $id);
		$this->db->where('bank_deposit_id', $depositId);
		$update = $this->db->update('accounting_bank_deposit_funds', $data);
		return $update ? true : false;
	}

	public function insert_fund($data)
	{
        $this->db->insert('accounting_bank_deposit_funds', $data);
	    return $this->db->insert_id();
	}

	public function get_fund($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('accounting_bank_deposit_funds');
		return $query->row();
	}

	public function get_company_deposits($filters = [])
    {
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('status !=', 0);
		$this->db->where('recurring', null);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}