<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_report_type_notes_model extends MY_Model {

	public $table = 'accounting_report_type_notes';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function get_note($companyId, $reportTypeId)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('report_type_id', $reportTypeId);
        return $this->db->get($this->table)->row();
    }

    public function add_note($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_note($companyId, $reportTypeId, $note)
    {
        $this->db->where('company_id', $companyId);
        $this->db->where('report_type_id', $reportTypeId);
        $update = $this->db->update($this->table, ['notes' => $note]);
        return $update;
    }
}