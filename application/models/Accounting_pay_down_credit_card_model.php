<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_pay_down_credit_card_model extends MY_Model {

    public $table = 'accounting_pay_down_credit_card';    
	
	public function __construct()
	{
		parent::__construct();
    }

	function create($data)
	{
        $this->db->insert($this->table, $data);
	    return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$query = $this->db->update($this->table, $data);
		return $query;
	}

	public function get_by_id($id)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function get_company_cc_payments($filters = [])
	{
		$this->db->where('company_id', $filters['company_id']);
		$this->db->where('status !=', 0);
		$query = $this->db->get($this->table);
		return $query->result();
	}
}