<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_terms_model extends MY_Model {

    public $table = 'accounting_terms';
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

    function getCompanyTerms($order, $status)
	{
		return $this->db->where('company_id', getLoggedCompanyID())->where_in('status', $status)->order_by('name', $order)->get($this->table)->result_array();
	}

	public function inactive($id, $name) {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])
                ->update($this->table, ['status' => 0, 'name' => $name]);
    }

	public function activate($id, $name) {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'id' => $id])
                ->update($this->table, ['status' => 1, 'name' => $name]);
    }

	public function updateTerm($id, $data) {
		$this->db->where('company_id', getLoggedCompanyID());
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $data);
		if($update) {
			return true;
		} else {
			return false;
		}
	}

	public function updateTermStatus($id, $status, $company_id) {
		$dataTerm = ['status' => $status];

		$this->db->where('company_id', $company_id);
		$this->db->where('id', $id);
		$update = $this->db->update($this->table, $dataTerm);
		if($update) {
			return true;
		} else {
			return false;
		}
	}	

	public function get_by_id($id, $companyId)
	{
		return $this->db->where(['company_id' => $companyId, 'id' => $id])->get($this->table)->row();
	}

	public function getActiveCompanyTerms($companyId)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('status', 1);
		$this->db->order_by('name', 'asc');
		return $this->db->get($this->table)->result();
	}

	function getCompanyTerms_a($company_id)
	{
		$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
	}

	public function check_name($companyId, $name, $status)
	{
		$this->db->where('company_id', $companyId);
		$this->db->where('name', $name);
		$this->db->where('status', $status);
		$query = $this->db->get($this->table);
		return $query->row();
	}
}