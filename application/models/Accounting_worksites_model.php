<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_worksites_model extends MY_Model {

	public $table = 'accounting_worksites';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function get_by_ids($ids)
    {
        $this->db->where_in('id', $ids);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_company_worksites($companyId)
    {
        $this->db->where('company_id', $companyId);
        $query = $this->db->get($this->table);
        return $query->result();
    }

	public function get_worksite_by_id($id)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $id);
		return $this->db->get($this->table)->row();
	}    

	public function update($worksiteId, $data)
	{
		$this->db->where('company_id', logged('company_id'));
		$this->db->where('id', $worksiteId);
		$update = $this->db->update($this->table, $data);

		return $update;
	}    

    public function delete($id)
    {
        $qry = $this->db->delete($this->table, array('id' => $id));
        return $qry;
    }

}