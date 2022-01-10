<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_management_reports extends MY_Model
{
    public $table = 'accounting_management_reports';
    
    public function __construct()
    {
        parent::__construct();
    }
    public function get_management_reports($company_id)
    {
        $sql="SELECT accounting_management_reports.*, business_profile.business_name
        FROM accounting_management_reports 
        JOIN business_profile ON business_profile.company_id = accounting_management_reports.company_id 
        WHERE accounting_management_reports.company_id = ".$company_id."  ORDER BY accounting_management_reports.id ASC";
        $query = $this->db->query($sql);
        return $query->result();
    }   
}
