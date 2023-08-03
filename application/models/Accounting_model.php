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
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Vendor Contact List data in Database
        if ($reportType == "vendor_contact_list") {
            $this->db->select('id, company AS vendor, CONCAT(phone, "  ",  mobile) AS phone_numbers, email, CONCAT(f_name, " ", m_name, " ", l_name, " ", suffix) AS fullname, CONCAT(street, ", ", city, ", ", state, " ", zip, " ", country) AS address, account_number');
            $this->db->from('accounting_vendors');
            $this->db->where('company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Vendor Contact List data in Database
        if ($reportType == "vendor_contact_list") {
            $this->db->select('id, company AS vendor, CONCAT(phone, "  ",  mobile) AS phone_numbers, email, CONCAT(f_name, " ", m_name, " ", l_name, " ", suffix) AS fullname, CONCAT(street, ", ", city, ", ", state, " ", zip, " ", country) AS address, account_number');
            $this->db->from('accounting_vendors');
            $this->db->where('company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Audit log list data in Database
        if ($reportType == "audit_log_list") {
            $this->db->select('customer_audit_logs.id, customer_audit_logs.date_created AS date_changed, users.user_type AS user, customer_audit_logs.module AS module, customer_audit_logs.remarks AS event, CONCAT(users.FName, " ", users.LName) AS name, customer_audit_logs.date_created AS date, "$0.00" AS amount, "" AS history');
            $this->db->from('customer_audit_logs');
            $this->db->join('users', 'users.id = customer_audit_logs.user_id', 'left');
            // $this->db->where('company_id', $companyID); not applicable
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

    }

}