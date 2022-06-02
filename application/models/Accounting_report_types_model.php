<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_report_types_model extends MY_Model {

	public $table = 'accounting_report_types';
	
	public function __construct()
	{
		parent::__construct();
	}

    public function get_favorite_reports($companyId)
    {
        $this->db->select('accounting_report_types.*');
        $this->db->where('accounting_favorite_reports.company_id', $companyId);
        $this->db->from($this->table);
        $this->db->join('accounting_favorite_reports', 'accounting_favorite_reports.report_type_id = accounting_report_types.id');
        $this->db->order_by('accounting_report_types.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_group($groupId)
    {
        $this->db->select('accounting_report_types.*');
        $this->db->where('accounting_report_group_types.group_id', $groupId);
        $this->db->from($this->table);
        $this->db->join('accounting_report_group_types', 'accounting_report_group_types.report_type_id = accounting_report_types.id');
        $this->db->order_by('accounting_report_types.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_favorite_report_by_report_type_id($reportTypeId, $companyId)
    {
        $this->db->select('accounting_report_types.*');
        $this->db->where('accounting_favorite_reports.company_id', $companyId);
        $this->db->where('accounting_favorite_reports.report_type_id', $reportTypeId);
        $this->db->from($this->table);
        $this->db->join('accounting_favorite_reports', 'accounting_favorite_reports.report_type_id = accounting_report_types.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_id($reportTypeId)
    {
        $this->db->where('id', $reportTypeId);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}