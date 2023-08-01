<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_model extends MY_Model {

	public function fetchReportData($reportType, $reportConfig = array()) {
        $loggedInUser = logged('id');
		$companyID = logged('company_id');

        // Get Sales Tax Liability Report data in Database
        if ($reportType == "sales_tax_liability") {
        
        }

        // Get Taxable Sales Detail Report data in Database
        if ($reportType == "taxable_sales_detail") {
            
        }

        // Get Taxable Sales Summary Report data in Database
        if ($reportType == "taxable_sales_summary") {
            
        }

        // Get Customer Contact List Report data in Database
        if ($reportType == "customer_contact_list") {
            $this->db->select('prof_id, CONCAT(first_name  , " ", last_name) AS customer, phone_h AS phoneNumber, email, mail_add AS billingAddress, CONCAT(city, " ", state, " ", zip_code) AS shippingAddress');
            $this->db->from('acs_profile');
            $this->db->where('company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $data = $this->db->get();
            return $data->result();
        }

    }

}