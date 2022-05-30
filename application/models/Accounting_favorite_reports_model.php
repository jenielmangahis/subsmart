<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_favorite_reports_model extends MY_Model {

	public $table = 'accounting_favorite_reports';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function add_to_favorites($reportTypeId, $companyId)
    {
        $this->db->insert($this->table, ['report_type_id' => $reportTypeId, 'company_id' => $companyId]);
        return $this->db->insert_id();
    }

    public function remove_from_favorites($reportTypeId, $companyId)
    {
        $this->db->where('report_type_id', $reportTypeId);
        $this->db->where('company_id', $companyId);
        $delete = $this->db->delete($this->table);
        return $delete ? true : false;
    }
}