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

    public function get_company_worksites($companyId)
    {
        $this->db->where('company_id', $companyId);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}