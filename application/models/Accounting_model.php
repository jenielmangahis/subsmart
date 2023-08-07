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

        // Get Expenses by Vendor Summary data in Database
        if ($reportType == "expenses_by_vendor_summary") {
            $this->db->select('CONCAT(accounting_vendors.f_name, " ", accounting_vendors.l_name) AS vendor, accounting_bill.remaining_balance AS balance, accounting_bill.total_amount AS expense, accounting_bill.created_at AS date');
            $this->db->from('accounting_vendors');
            $this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            // $this->db->limit($reportConfig['page_size']); // Not Applicable
            $data = $this->db->get();
            return $data->result();
        }

        // Get Audit log list data in Database
        if ($reportType == "audit_log_list") {
            $this->db->select('customer_audit_logs.date_created AS date_changed, users.user_type, customer_audit_logs.id AS id, customer_audit_logs.user_id AS user, customer_audit_logs.prof_id AS prof_id, customer_audit_logs.obj_id AS obj_id, customer_audit_logs.module AS module, customer_audit_logs.remarks AS event, CONCAT(users.FName, " ", users.LName) AS name, customer_audit_logs.date_created AS date, work_orders.date_updated AS workorder_datechanged, work_orders.grand_total AS workorder_amount, invoices.date_updated AS invoice_datechanged, invoices.grand_total AS invoice_amount, tasks.date_created AS taskhub_datechanged, customer_audit_logs.date_created AS customer_datechanged, estimates.updated_at AS estimate_datechanged, estimates.grand_total AS estimate_amount, events.date_updated AS event_datechanged, appointments.created AS appointment_datechanged, jobs.date_updated AS job_datechanged, jobs.amount_collected AS job_amount');
            $this->db->from('customer_audit_logs');
            $this->db->join('users', 'users.id = customer_audit_logs.user_id', 'left');
            $this->db->join('work_orders', 'work_orders.id = customer_audit_logs.obj_id', 'left');
            $this->db->join('invoices', 'invoices.id = customer_audit_logs.obj_id', 'left');
            $this->db->join('tasks', 'tasks.task_id = customer_audit_logs.obj_id', 'left');
            $this->db->join('estimates', 'estimates.id = customer_audit_logs.obj_id', 'left');
            $this->db->join('events', 'events.id = customer_audit_logs.obj_id', 'left');
            $this->db->join('appointments', 'appointments.id = customer_audit_logs.obj_id', 'left');
            $this->db->join('jobs', 'jobs.id = customer_audit_logs.obj_id', 'left');
            // $this->db->where('company_id', $companyID); not applicable
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            $auditLogsData = $data->result();



            // re assign objects
            $arrayStdObject = array();
            for ($i = 0; $i < count($auditLogsData); $i++) { 
                $output = new stdClass();
                $output->id = $auditLogsData[$i]->id;
                $output->obj_id = $auditLogsData[$i]->obj_id;
                $output->user = $auditLogsData[$i]->user_type;
                $output->module = $auditLogsData[$i]->module;
                $output->event = $auditLogsData[$i]->event;
                $output->name = $auditLogsData[$i]->name;
                $output->date = $auditLogsData[$i]->date;

                // get Date Change and Amount data from other table based on the module type
                if ($auditLogsData[$i]->module == "Workorder") {
                    $output->date_changed = $auditLogsData[$i]->workorder_datechanged;
                    $output->amount = $auditLogsData[$i]->workorder_amount;
                }
                if ($auditLogsData[$i]->module == "Invoice") {
                    $output->date_changed = $auditLogsData[$i]->invoice_datechanged;
                    $output->amount = $auditLogsData[$i]->invoice_amount;
                }
                if ($auditLogsData[$i]->module == "Taskhub") {
                    $output->date_changed = $auditLogsData[$i]->taskhub_datechanged;
                    $output->amount = "";
                }
                if ($auditLogsData[$i]->module == "Customer") {
                    $output->date_changed = $auditLogsData[$i]->customer_datechanged;
                    $output->amount = "";
                }
                if ($auditLogsData[$i]->module == "Estimate") {
                    $output->date_changed = $auditLogsData[$i]->estimate_datechanged;
                    $output->amount = $auditLogsData[$i]->estimate_amount;
                }
                if ($auditLogsData[$i]->module == "Event" || $auditLogsData[$i]->module == "Events") {
                    $output->date_changed = $auditLogsData[$i]->event_datechanged;
                    $output->amount = "";
                }
                if ($auditLogsData[$i]->module == "Appointment") {
                    $output->date_changed = $auditLogsData[$i]->appointment_datechanged;
                    $output->amount = "";
                }
                if ($auditLogsData[$i]->module == "Jobs") {
                    $output->date_changed = $auditLogsData[$i]->job_datechanged;
                    $output->amount = $auditLogsData[$i]->job_amount;
                }

                $arrayStdObject[$i] = $output;
            }

            return $arrayStdObject;
        }

    }

}