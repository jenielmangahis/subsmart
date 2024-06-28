<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingReportSetting_model extends MY_Model
{
    public $table = 'accounting_reports_settings';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getByReportTypeIdAndCompanyId($id, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('report_type_id', $id);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function updateByReportTypeId($report_type_id, $data)
    {
        $this->db->where('report_type_id', $report_type_id);
        return $this->db->update($this->table, $data);        
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // public function getAllByCompanyId()
    // {
    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     $this->db->where('company_id', $company_id);

    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function getByReportTypeIdAndCompanyId($id, $cid)
    // {

    //     $this->db->select('*');
    //     $this->db->from($this->table);
    //     $this->db->where('report_type_id', $id);
    //     $this->db->where('company_id', $cid);

    //     $query = $this->db->get();
    //     return $query->row();
    // }
}

/* End of file AccountingReportSetting_model.php */
/* Location: ./application/models/AccountingReportSetting_model.php */
