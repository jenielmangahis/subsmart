<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_management_reports extends MY_Model
{
    public $table = 'accounting_management_reports';
    
    public function __construct()
    {
        parent::__construct();
    }
    public function get_management_reports_by_company($company_id)
    {
        $sql="SELECT accounting_management_reports.*, business_profile.business_name
        FROM accounting_management_reports 
        JOIN business_profile ON business_profile.company_id = accounting_management_reports.company_id 
        WHERE accounting_management_reports.company_id = ".$company_id."  ORDER BY accounting_management_reports.id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }   
    public function get_management_reports_by_id($management_report_id)
    {
        $sql="SELECT accounting_management_reports.*, business_profile.business_name
        FROM accounting_management_reports 
        JOIN business_profile ON business_profile.company_id = accounting_management_reports.company_id 
        WHERE accounting_management_reports.id = ".$management_report_id;
        $query = $this->db->query($sql);
        return $query->row();
    }
    public function get_management_reports_preliminary_pages_by_id($management_report_id)
    {
        $sql="SELECT *
        FROM accounting_management_reports_preliminary_pages 
        WHERE management_report_id = ".$management_report_id;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_report_pages_by_maagement_report_id($management_report_id)
    {
        $sql="SELECT *
        FROM accounting_management_reports_reports_pages 
        WHERE management_report_id = ".$management_report_id;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function get_reports_by_management_report_id($management_report_id)
    {
        $sql="SELECT *
        FROM accounting_management_reports_reports_pages 
        WHERE management_report_id = ".$management_report_id;
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function update_management_report($data,$id)
    {
        $this->db->where('id', $id);
        $vendor = $this->db->update('accounting_management_reports', $data);
        if ($vendor) {
            return true;
        } else {
            return false;
        }
    }
    public function update_preliminary_page($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('accounting_management_reports_preliminary_pages', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function insert_preliminary_page($data)
    {
        $this->db->insert('accounting_management_reports_preliminary_pages', $data);
        $insert_id = $this->db->insert_id();
    }
    public function delete_preliminary_page($id)
    {
        $this->db->delete('accounting_management_reports_preliminary_pages', array('id' => $id));
    }

    public function delete_report_page($management_report_id, $report_id)
    {
        $this->db->delete('accounting_management_reports_reports_pages', array('id' => $report_id, 'management_report_id' => $management_report_id));
    }
    public function update_reports($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('accounting_management_reports_reports_pages', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function insert_report($data)
    {
        $this->db->insert('accounting_management_reports_reports_pages', $data);
        $insert_id = $this->db->insert_id();
    }
}
