<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_model extends MY_Model
{
    public function createReportSettings($settings)
    {
        $this->db->select('report_type_id');
        $this->db->from('accounting_reports_settings');
        $this->db->where('company_id', $settings['company_id']);
        $this->db->where('report_type_id', $settings['report_type_id']);
        $data = $this->db->get();

        // If the row exists, update it
        if ($data->num_rows() == 1) {
            $this->db->where('company_id', $settings['company_id']);
            $this->db->where('report_type_id', $settings['report_type_id']);
            $result = $this->db->update('accounting_reports_settings', $settings);
        } else {
            // Otherwise, insert a new row
            $result = $this->db->insert('accounting_reports_settings', $settings);
        }

        return $result;
    }

    public function getReportSettings($reportTypeId)
    {
        $company_id = logged('company_id');
        $this->db->select('report_type_id, company_name, title, notes, show_logo, show_company_name, show_title, header_align, footer_align, sort_by, sort_asc_desc, page_size, report_date_from_text, report_date_to_text');
        $this->db->from('accounting_reports_settings');
        $this->db->where('company_id', $company_id);
        $this->db->where('report_type_id', $reportTypeId);
        $data = $this->db->get();

        return $data->row();
    }

    public function fetchReportData($reportType, $reportConfig = [])
    {
        $loggedInUser = logged('id');
        $companyID = logged('company_id');

        // Get Sales Tax Liability Report data in Database
        if ($reportType == 'sales_tax_liability') {
        }

        // Get Customer Contact List Report data in Database
        if ($reportType == 'customer_contact_list') {
            $this->db->select('prof_id, CONCAT(first_name  , " ", last_name) AS customer, phone_h AS phoneNumber, email, CONCAT(mail_add, " ", city, ", ", state, " ", zip_code) AS billingAddress, CONCAT(mail_add, " ", city, ", ", state, " ", zip_code) AS shippingAddress');
            $this->db->from('acs_profile');
            $this->db->where('company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Vendor Contact List data in Database
        if ($reportType == 'vendor_contact_list') {
            $this->db->select('id, display_name AS vendor, CONCAT(phone, "  ",  mobile) AS phone_numbers, email, display_name AS fullname, CONCAT(street, " ", city, ", ", state, " ", zip, " ", country) AS address, account_number');
            $this->db->from('accounting_vendors');
            $this->db->where('company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'balance_sheet_details') {
            $this->db->select('payment_date, payee_type, check_no, memo, total_amount');
            $this->db->from('accounting_check');
            $this->db->where('company_id', $companyID);
            if (!empty($reportConfig['date_from']) && !empty($reportConfig['date_to'])) {
                $this->db->where("accounting_check.payment_date >= '$reportConfig[date_from]'");
                $this->db->where("accounting_check.payment_date <= '$reportConfig[date_to]'");
            }

            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $checkData = $this->db->get()->result();

            $this->db->select('payment_date AS arp_payment_date, payment_method, ref_no, amount_received, amount_to_credit, amount_to_apply, memo AS arp_memo');
            $this->db->from('accounting_receive_payment');
            $this->db->where('company_id', $companyID);
            if (!empty($reportConfig['date_from']) && !empty($reportConfig['date_to'])) {
                $this->db->where("accounting_receive_payment.payment_date >= '$reportConfig[date_from]'");
                $this->db->where("accounting_receive_payment.payment_date <= '$reportConfig[date_to]'");
            }

            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $receivePaymentData = $this->db->get()->result();

            return [
                'accounting_check' => $checkData,
                'accounting_receive_payment' => $receivePaymentData,
            ];
        }

        if ($reportType == 'transaction_list_with_splits') {
            $this->db->select('a.transaction_type, a.transaction_date, a.amount, a.transaction_id, c.name as name');
            $this->db->from('accounting_account_transactions a');
            $this->db->join('accounting_chart_of_accounts c', 'a.id = c.id');
            $this->db->where('a.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Expenses by Vendor Summary data in Database
        if ($reportType == 'expenses_by_vendor_summary') {
            $this->db->select('accounting_vendors.display_name AS vendor, accounting_bill.remaining_balance AS balance, accounting_bill.total_amount AS expense, accounting_bill.created_at AS date');
            $this->db->from('accounting_vendors');
            $this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where("DATE_FORMAT(accounting_vendors.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_vendors.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Audit log list data in Database
        // if ($reportType == "audit_log_list") {
        //     $this->db->select('customer_audit_logs.date_created AS date_changed, users.user_type, customer_audit_logs.id AS id, customer_audit_logs.user_id AS user, customer_audit_logs.prof_id AS prof_id, customer_audit_logs.obj_id AS obj_id, customer_audit_logs.module AS module, customer_audit_logs.remarks AS event, CONCAT(users.FName, " ", users.LName) AS name, customer_audit_logs.date_created AS date, work_orders.date_updated AS workorder_datechanged, work_orders.grand_total AS workorder_amount, invoices.date_updated AS invoice_datechanged, invoices.grand_total AS invoice_amount, tasks.date_created AS taskhub_datechanged, customer_audit_logs.date_created AS customer_datechanged, estimates.updated_at AS estimate_datechanged, estimates.grand_total AS estimate_amount, events.date_updated AS event_datechanged, appointments.created AS appointment_datechanged, jobs.date_updated AS job_datechanged, jobs.amount_collected AS job_amount');
        //     $this->db->from('customer_audit_logs');
        //     $this->db->join('users', 'users.id = customer_audit_logs.user_id', 'left');
        //     $this->db->join('work_orders', 'work_orders.id = customer_audit_logs.obj_id', 'left');
        //     $this->db->join('invoices', 'invoices.id = customer_audit_logs.obj_id', 'left');
        //     $this->db->join('tasks', 'tasks.task_id = customer_audit_logs.obj_id', 'left');
        //     $this->db->join('estimates', 'estimates.id = customer_audit_logs.obj_id', 'left');
        //     $this->db->join('events', 'events.id = customer_audit_logs.obj_id', 'left');
        //     $this->db->join('appointments', 'appointments.id = customer_audit_logs.obj_id', 'left');
        //     $this->db->join('jobs', 'jobs.id = customer_audit_logs.obj_id', 'left');
        //     // $this->db->where('company_id', $companyID); not applicable
        //     $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
        //     $this->db->limit($reportConfig['page_size']);
        //     $data = $this->db->get();
        //     $auditLogsData = $data->result();

        //     // re assign objects
        //     $arrayStdObject = array();
        //     for ($i = 0; $i < count($auditLogsData); $i++) {
        //         $output = new stdClass();
        //         $output->id = $auditLogsData[$i]->id;
        //         $output->obj_id = $auditLogsData[$i]->obj_id;
        //         $output->user = $auditLogsData[$i]->user_type;
        //         $output->module = $auditLogsData[$i]->module;
        //         $output->event = $auditLogsData[$i]->event;
        //         $output->name = $auditLogsData[$i]->name;
        //         $output->date = $auditLogsData[$i]->date;

        //         // get Date Change and Amount data from other table based on the module type
        //         if ($auditLogsData[$i]->module == "Workorder") {
        //             $output->date_changed = $auditLogsData[$i]->workorder_datechanged;
        //             $output->amount = $auditLogsData[$i]->workorder_amount;
        //         }
        //         if ($auditLogsData[$i]->module == "Invoice") {
        //             $output->date_changed = $auditLogsData[$i]->invoice_datechanged;
        //             $output->amount = $auditLogsData[$i]->invoice_amount;
        //         }
        //         if ($auditLogsData[$i]->module == "Taskhub") {
        //             $output->date_changed = $auditLogsData[$i]->taskhub_datechanged;
        //             $output->amount = "";
        //         }
        //         if ($auditLogsData[$i]->module == "Customer") {
        //             $output->date_changed = $auditLogsData[$i]->customer_datechanged;
        //             $output->amount = "";
        //         }
        //         if ($auditLogsData[$i]->module == "Estimate") {
        //             $output->date_changed = $auditLogsData[$i]->estimate_datechanged;
        //             $output->amount = $auditLogsData[$i]->estimate_amount;
        //         }
        //         if ($auditLogsData[$i]->module == "Event" || $auditLogsData[$i]->module == "Events") {
        //             $output->date_changed = $auditLogsData[$i]->event_datechanged;
        //             $output->amount = "";
        //         }
        //         if ($auditLogsData[$i]->module == "Appointment") {
        //             $output->date_changed = $auditLogsData[$i]->appointment_datechanged;
        //             $output->amount = "";
        //         }
        //         if ($auditLogsData[$i]->module == "Jobs") {
        //             $output->date_changed = $auditLogsData[$i]->job_datechanged;
        //             $output->amount = $auditLogsData[$i]->job_amount;
        //         }

        //         $arrayStdObject[$i] = $output;
        //     }

        //     return $arrayStdObject;
        // }

        if ($reportType == 'audit_log_list') {
            $this->db->select('cal.date_created AS date_changed, u.user_type, cal.id AS id, cal.user_id AS user, cal.prof_id AS prof_id, cal.obj_id AS obj_id, cal.module AS module, cal.remarks AS event, CONCAT(u.FName, " ", u.LName) AS name, cal.date_created AS date, wo.date_updated AS workorder_datechanged, wo.grand_total AS workorder_amount, inv.date_updated AS invoice_datechanged, inv.grand_total AS invoice_amount, t.date_created AS taskhub_datechanged, cal.date_created AS customer_datechanged, est.updated_at AS estimate_datechanged, est.grand_total AS estimate_amount, e.date_updated AS event_datechanged, a.created AS appointment_datechanged, j.date_updated AS job_datechanged, j.amount_collected AS job_amount');
            $this->db->from('customer_audit_logs AS cal');
            $this->db->join('users AS u', 'u.id = cal.user_id', 'left');
            $this->db->join('work_orders AS wo', 'wo.id = cal.obj_id', 'left');
            $this->db->join('invoices AS inv', 'inv.id = cal.obj_id', 'left');
            $this->db->join('tasks AS t', 't.task_id = cal.obj_id', 'left');
            $this->db->join('estimates AS est', 'est.id = cal.obj_id', 'left');
            $this->db->join('events AS e', 'e.id = cal.obj_id', 'left');
            $this->db->join('appointments AS a', 'a.id = cal.obj_id', 'left');
            $this->db->join('jobs AS j', 'j.id = cal.obj_id', 'left');
            $this->db->where('u.company_id', $companyID);
            $this->db->where("DATE_FORMAT(cal.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(cal.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            $auditLogsData = $data->result();

            // reassign objects
            $arrayStdObject = [];
            foreach ($auditLogsData as $auditLog) {
                $output = new stdClass();
                $output->id = $auditLog->id;
                $output->obj_id = $auditLog->obj_id;
                $output->user = $auditLog->user_type;
                $output->module = $auditLog->module;
                $output->event = $auditLog->event;
                $output->name = $auditLog->name;
                $output->date = $auditLog->date;

                // get Date Change and Amount data from other table based on the module type
                switch ($auditLog->module) {
                    case 'Workorder':
                        $output->date_changed = $auditLog->workorder_datechanged;
                        $output->amount = $auditLog->workorder_amount;
                        break;
                    case 'Invoice':
                        $output->date_changed = $auditLog->invoice_datechanged;
                        $output->amount = $auditLog->invoice_amount;
                        break;
                    case 'Estimate':
                        $output->date_changed = $auditLog->estimate_datechanged;
                        $output->amount = $auditLog->estimate_amount;
                        break;
                    case 'Jobs':
                        $output->date_changed = $auditLog->job_datechanged;
                        $output->amount = $auditLog->job_amount;
                        break;
                    default:
                        $output->date_changed = null;
                        $output->amount = null;
                        break;
                }

                $arrayStdObject[] = $output;
            }

            return $arrayStdObject;
        }

        // Get Inventory Valuation Summary data in Database
        if ($reportType == 'inventory_valuation_summary') {
            $this->db->select('items.id AS id, SUBSTRING(MD5(items.id), 1, 10) AS product_sku, items.title AS product_name, items.type AS product_type, (items_has_storage_loc.qty + items_has_storage_loc.initial_qty) AS product_quantity, (items.price * (items_has_storage_loc.qty + items_has_storage_loc.initial_qty)) AS product_asset_value, items.price AS product_calculated_average');
            $this->db->from('items');
            $this->db->join('items_has_storage_loc', 'items_has_storage_loc.item_id = items.id', 'left');
            $this->db->where('items.type', 'Product');
            $this->db->where('(items_has_storage_loc.qty + items_has_storage_loc.initial_qty) >', 0);
            $this->db->where('items.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Customer Balance Summary data in Database
        if ($reportType == 'customer_balance_summary') {
            // $this->db->select('acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, COALESCE(SUM(invoices.total_due),0) AS balance');
            // $this->db->from('invoices');
            // $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id');
            // $this->db->where('invoices.status !=', "Paid");
            // $this->db->where('invoices.status !=', "Draft");
            // $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            // $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            // $this->db->where('acs_profile.company_id', $companyID);
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            // $this->db->limit($reportConfig['page_size']);

            $query = $this->db->query('
                SELECT 
                    acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, (
                        SELECT COALESCE(SUM(invoices.grand_total),0) AS balance
                        FROM invoices 
                        WHERE invoices.customer_id = acs_profile.prof_id 
                            AND invoices.status != "Paid"
                            AND invoices.status != "Draft"
                            AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") >= "'.$reportConfig['date_from'].'"
                            AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") <= "'.$reportConfig['date_to'].'"
                    ) AS balance
                FROM acs_profile
                WHERE acs_profile.company_id = '.$companyID.'
                ORDER BY '.$reportConfig['sort_by'].' '.$reportConfig['sort_order'].' 
                LIMIT '.$reportConfig['page_size'].'
            ');

            return $query->result();
        }

        // Get Physical Inventory Worksheet data in Database
        if ($reportType == 'physical_inventory_worksheet') {
            $this->db->select('items.id AS id, items.title AS product, items.description AS description, items_has_storage_loc.qty AS qty_on_hand, items.re_order_points AS reorder_points, items.qty_order AS qty_on_po, items_has_storage_loc.initial_qty AS physical_count');
            $this->db->from('items');
            $this->db->join('items_has_storage_loc', 'items_has_storage_loc.item_id = items.id ', 'left');
            $this->db->where('items.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Customer Balance Detail data in Database
        if ($reportType == 'customer_balance_detail') {
            $this->db->select('invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, invoices.due_date AS due_date, invoices.grand_total AS amount, accounting_receive_payment_invoices.open_balance AS open_balance, invoices.total_due AS balance');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
            // $this->db->where('invoices.status', "Unpaid");
            $this->db->where('invoices.status !=', 'Draft');
            $this->db->where('invoices.status !=', 'Paid');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id, customer');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Sales by Customer Summary data in Database
        if ($reportType == 'sales_by_customer_summary') {
            $this->db->select('invoices.id AS invoice_id, acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, SUM(invoices_items.total) AS total');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->having('SUM(invoices_items.total) >', 0);
            $this->db->group_by('acs_profile.prof_id, customer_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Sales by Customer Detail data in Database
        if ($reportType == 'sales_by_customer_detail') {
            $this->db->select('invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, items.type AS product_service, items.title AS memo_description, invoices_items.qty AS qty, items.price AS sales_price, (((invoices_items.qty * items.price) - invoices_items.discount) + invoices_items.tax), invoices.total_due AS balance');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id, customer');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Sales by Customer Type Detail data in Database
        if ($reportType == 'sales_by_customer_type_detail') {
            $this->db->select('invoices.customer_id AS customer_id, acs_profile.customer_type AS customer_type, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, items.type AS product_service, items.title AS memo_description, invoices_items.qty AS qty, items.price AS sales_price, (((invoices_items.qty * items.price) - invoices_items.discount) + invoices_items.tax), invoices.total_due AS balance');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('acs_profile.customer_type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Sales by Product/Service Detail data in Database
        if ($reportType == 'sales_by_product_service_detail') {
            $this->db->select('invoices.customer_id AS customer_id, items.type AS product_service, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, items.title AS memo_description, invoices_items.qty AS qty, items.price AS sales_price, (((invoices_items.qty * items.price) - invoices_items.discount) + invoices_items.tax) AS amount, invoices.total_due AS balance');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Vendor Balance Summary data in Database
        if ($reportType == 'vendor_balance_summary') {
            $this->db->select('accounting_vendors.id AS vendor_id, accounting_vendors.display_name AS vendor, accounting_bill.remaining_balance AS balance, accounting_bill.created_at AS date');
            $this->db->from('accounting_vendors');
            $this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where('accounting_vendors.f_name !=', '');
            $this->db->where('accounting_vendors.l_name !=', '');
            $this->db->where('accounting_bill.remaining_balance !=', '');
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Vendor Balance Detail data in Database
        if ($reportType == 'vendor_balance_detail') {
            $this->db->select('accounting_vendors.id AS vendor_id, accounting_vendors.display_name AS vendor, accounting_bill.bill_date AS date, "Invoice" AS transaction_type, accounting_bill.id AS num, accounting_bill.due_date AS due_date, accounting_bill.total_amount AS amount, accounting_bill.remaining_balance AS open_balance,accounting_bill.remaining_balance AS balance');
            $this->db->from('accounting_vendors');
            $this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where('accounting_vendors.f_name !=', '');
            $this->db->where('accounting_vendors.l_name !=', '');
            $this->db->where('accounting_bill.remaining_balance !=', '');
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Purchases by Vendor Detail data in Database
        if ($reportType == 'purchases_by_vendor_detail') {
            $this->db->select('accounting_vendor_transaction.vendor_id AS vendor_id, accounting_vendors.display_name AS vendor, accounting_vendor_transaction.transaction_date AS date, accounting_vendor_transaction.transaction_type AS transaction_type, accounting_vendor_transaction.transaction_number AS num, items.type AS item_type, items.title AS description, accounting_vendor_transaction.quantity AS quantity, items.price AS rate, (accounting_vendor_transaction.quantity * items.price) AS amount, accounting_vendor_transaction.balance AS balance');
            $this->db->from('accounting_vendor_transaction');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_vendor_transaction.vendor_id', 'left');
            $this->db->join('items', 'items.id = accounting_vendor_transaction.item_id', 'left');
            $this->db->where('accounting_vendors.f_name !=', '');
            $this->db->where('accounting_vendors.l_name !=', '');
            $this->db->where("DATE_FORMAT(accounting_vendor_transaction.transaction_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_vendor_transaction.transaction_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Purchases by Product/Service Detail data in Database
        if ($reportType == 'purchases_by_product_service_detail') {
            $this->db->select('accounting_vendor_transaction.vendor_id AS vendor_id, items.type AS product_service, accounting_vendor_transaction.transaction_date AS date, accounting_vendor_transaction.transaction_type AS transaction_type, accounting_vendor_transaction.transaction_number AS num, accounting_vendors.display_name AS vendor, items.title AS memo_description, accounting_vendor_transaction.quantity AS qty, items.price AS rate, (accounting_vendor_transaction.quantity * items.price) AS amount, accounting_vendor_transaction.balance AS balance');
            $this->db->from('accounting_vendor_transaction');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_vendor_transaction.vendor_id', 'left');
            $this->db->join('items', 'items.id = accounting_vendor_transaction.item_id', 'left');
            $this->db->where('accounting_vendors.f_name !=', '');
            $this->db->where('accounting_vendors.l_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(accounting_vendor_transaction.transaction_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_vendor_transaction.transaction_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Inventory Valuation Detail data in Database
        if ($reportType == 'inventory_valuation_detail') {
            $this->db->select('invoices_items.invoice_id AS invoice_id, items.type AS product_service, DATE_FORMAT(invoices_items.date_created,"%Y-%m-%d") AS date, "Purchase" AS transaction_type, invoices_items.id AS num, items.title AS name, invoices_items.qty AS qty, items.price AS rate, invoices_items.cost AS fifo_cost, items_has_storage_loc.qty AS qty_on_hand, (invoices_items.qty * items.price) AS asset_value');
            $this->db->from('invoices_items');
            $this->db->join('invoices', 'invoices.id = invoices_items.invoice_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->join('items_has_storage_loc', 'items_has_storage_loc.item_id = items.id', 'left');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices_items.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices_items.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Estimates by Customer data in Database
        if ($reportType == 'estimates_by_customer') {
            $this->db->select('estimates.id AS estimates_id, acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(estimates.created_at,"%Y-%m-%d") AS date, estimates.estimate_number AS num, estimates.status AS status, estimates.accepted_date AS accepted_date, estimates.expiry_date AS expiration_date, ((items.price * estimates_items.qty) + estimates_items.tax) AS amount');
            $this->db->from('estimates');
            $this->db->join('estimates_items', 'estimates_items.estimates_id = estimates.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = estimates.customer_id', 'left');
            $this->db->join('items', 'items.id = estimates_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('estimates.estimate_date !=', '');
            $this->db->where('estimates.estimate_number !=', '');
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('estimates.company_id', $companyID);
            $this->db->group_by('acs_profile.prof_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Invoice List by Date data in Database
        if ($reportType == 'invoice_list_by_date') {
            $this->db->select('invoices.id AS invoices_id, invoices.customer_id AS customer_id, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.invoice_number AS num, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS name, "" AS memo_description, invoices.due_date AS due_date, IFNULL(SUM((items.price * invoices_items.qty) + invoices_items.tax), 0) AS amount');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();

            return $query->result();
        }

        if ($reportType == 'time_activities_by_customer_details') {
            $this->db->select('CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name , accounting_single_time_activity.*');
            $this->db->from('accounting_single_time_activity');
            $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_single_time_activity.customer_id', 'left');
            $this->db->where('accounting_single_time_activity.status !=', 0);
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(accounting_single_time_activity.date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_single_time_activity.date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_single_time_activity.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('acs_profile.prof_id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'payroll_deductions_contributions_details') {
            $this->db->select('CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name , accounting_single_time_activity.*');
            $this->db->from('accounting_single_time_activity');
            $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_single_time_activity.customer_id', 'left');
            $this->db->where('accounting_single_time_activity.status !=', 0);
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(accounting_single_time_activity.date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_single_time_activity.date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_single_time_activity.company_id', $companyID);
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('acs_profile.prof_id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'retirements_detail') {
            $this->db->select('CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name , accounting_single_time_activity.*');
            $this->db->from('accounting_single_time_activity');
            $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_single_time_activity.customer_id', 'left');
            $this->db->where('accounting_single_time_activity.status !=', 0);
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(accounting_single_time_activity.date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_single_time_activity.date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_single_time_activity.company_id', $companyID);
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('acs_profile.prof_id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'general_ledger_details') {
            $this->db->select('accounting_account_transactions.*');
            $this->db->from('accounting_chart_of_accounts');
            $this->db->join('accounting_account_transactions', 'accounting_account_transactions.account_id = accounting_chart_of_accounts.id', 'left');
            $this->db->where("DATE_FORMAT(accounting_account_transactions.transaction_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_account_transactions.transaction_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_chart_of_accounts.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_account_transactions.transaction_type');
            $data = $this->db->get();

            return $data->result();
        }

        // Get Payment Method List data in Database
        if ($reportType == 'payment_method_list') {
            $this->db->select('accounting_payment_methods.id AS payment_id, accounting_payment_methods.name AS payment_method');
            $this->db->from('accounting_payment_methods');
            $this->db->where('accounting_payment_methods.status =', 1);
            $this->db->where('accounting_payment_methods.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();

            return $query->result();
        }

        // Get Open Invoices Date data in Database
        if ($reportType == 'open_invoices') {
            $this->db->select('invoices.id AS invoices_id, invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS name, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.invoice_number AS num, "" AS terms, invoices.due_date AS due_date, IFNULL(SUM((items.price * invoices_items.qty) + invoices_items.tax), 0) AS open_balance');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();

            return $query->result();
        }

        // Get Product/Service list data in Database
        if ($reportType == 'product_service_list') {
            $this->db->select('items.id AS item_id, items.title AS product_service, items.type AS type, items.description AS description, items.price AS price, items.cost AS cost, items_has_storage_loc.qty AS qty_on_hand');
            $this->db->from('items');
            $this->db->join('items_has_storage_loc', 'items_has_storage_loc.item_id = items.id', 'left');
            $this->db->where('items.title !=', '');
            $this->db->where('items.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();

            return $query->result();
        }

        // Get Sales by Product/Service Summary data in Database
        if ($reportType == 'sales_by_product_service_summary') {
            $this->db->select('invoices.id AS invoice_id, items.title AS product_service, invoices_items.qty AS quantity, SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) AS amount, ((SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) / (SELECT SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) FROM invoices LEFT JOIN invoices_items ON invoices_items.invoice_id = invoices.id LEFT JOIN items ON items.id = invoices_items.items_id WHERE invoices.company_id = '.$companyID.')) * 100) AS sales_percentage, (SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) / invoices_items.qty) AS average_price, SUM(items.COGS * invoices_items.qty) AS COGS, (SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) - SUM(items.COGS * invoices_items.qty)) AS gross_margin, (((SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) - SUM(items.COGS * invoices_items.qty)) / SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax)) * 100) AS gross_margin_percentage');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('items.title !=', '');
            $this->db->where('items.price !=', 0);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('items.id, items.title');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Taxable Sales Detail data in Database
        if ($reportType == 'taxable_sales_detail') {
            $this->db->select('invoices.customer_id AS customer_id, items.type AS product_service, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, items.title AS memo_description, invoices_items.qty AS qty, items.price AS sales_price, (((invoices_items.qty * items.price) - invoices_items.discount) + invoices_items.tax) AS amount, invoices.total_due AS balance');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Taxable Sales Summary data in Database
        if ($reportType == 'taxable_sales_summary') {
            $this->db->select('items.type AS product_type, SUM((((invoices_items.qty * items.price) - invoices_items.discount) + invoices_items.tax)) AS total');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'yearly_closeout_lists') {
            $this->db->select('invoices.*, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer,  SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) AS amount');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'yearly_closeout_lists') {
            $this->db->select('');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Income by Customer Summary data in Database
        if ($reportType == 'income_by_customer_summary') {
            $this->db->select('acs_profile.prof_id AS customer_id, invoices.id AS invoice_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, SUM((items.price * invoices_items.qty - invoices_items.discount)) AS income, SUM(invoices_items.tax) AS expense, SUM((items.price * invoices_items.qty - invoices_items.discount) - invoices_items.tax) AS net_income');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('acs_profile.prof_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Estimates & Progress Invoicing Summary by Customer data in Database
        if ($reportType == 'estimate_progress_invoicing') {
            $this->db->select('estimates.id AS estimate_id, acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(estimates.created_at,"%Y-%m-%d") AS date, estimates.estimate_number AS num, estimates.status AS status, SUM(((items.price * estimates_items.qty) + estimates_items.tax) - estimates_items.discount) AS amount, 0 AS balance, 0 AS invoiced_amount, 0 AS percent_amount, SUM(((items.price * estimates_items.qty) + estimates_items.tax) - estimates_items.discount) AS remaining_amount');
            $this->db->from('estimates');
            $this->db->join('acs_profile', 'acs_profile.prof_id = estimates.customer_id', 'left');
            $this->db->join('estimates_items', 'estimates_items.estimates_id = estimates.id', 'left');
            $this->db->join('items', 'items.id = estimates_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('estimates.company_id', $companyID);
            $this->db->group_by('acs_profile.prof_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Terms Lists data in Database
        if ($reportType == 'terms_list') {
            $this->db->select('accounting_terms.id AS term_id, accounting_terms.name AS term, accounting_terms.type AS type, accounting_terms.net_due_days AS net_due_days, accounting_terms.day_of_month_due AS day_of_month_due, accounting_terms.discount_percentage AS discount_percentage, accounting_terms.discount_days AS discount_days, accounting_terms.discount_on_day_of_month AS discount_on_day_of_month, accounting_terms.minimum_days_to_pay AS minimum_days_to_pay');
            $this->db->from('accounting_terms');
            $this->db->where('accounting_terms.name !=', '');
            $this->db->where("DATE_FORMAT(accounting_terms.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_terms.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_terms.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Statement List data in Database
        if ($reportType == 'statement_list') {
            $this->db->select('accounting_statements.id AS statement_id, accounting_statements.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, accounting_statements.statement_date AS statement_date');
            $this->db->from('accounting_statements');
            $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_statements.customer_id', 'left');
            $this->db->where("DATE_FORMAT(accounting_statements.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_statements.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_statements.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Bill Payment List data in Database
        if ($reportType == 'bill_payment_list') {
            $this->db->select('accounting_bill.id AS bill_id, accounting_vendors.id AS vendor_id, accounting_bill.bill_date AS bill_date, accounting_bill.id AS num, accounting_vendors.display_name AS vendor, accounting_bill.total_amount AS amount');
            $this->db->from('accounting_bill');
            // $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_bill.qbid', 'left'); -- Temporary Removed
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_bill.vendor_id', 'left');
            $this->db->where("DATE_FORMAT(accounting_bill.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_bill.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_bill.company_id', $companyID);
            // $this->db->where('accounting_vendors.display_name !=', "");
            $this->db->where('accounting_vendors.f_name !=', '');
            $this->db->where('accounting_vendors.l_name !=', '');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Collections Report data in Database
        if ($reportType == 'collections_report') {
            $this->db->select('invoices.id AS invoice_id, invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, invoices.due_date AS due_date, CONCAT(DATEDIFF(CURDATE(), invoices.due_date), " days") AS past_due, (((invoices_items.qty * items.price) - invoices_items.discount) + invoices_items.tax) AS amount, invoices.total_due AS open_balance');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where('items.type !=', '');
            $this->db->where('items.price !=', '');
            $this->db->where('items.title !=', '');
            $this->db->where('invoices.total_due !=', '');
            $this->db->where('DATEDIFF(CURDATE(), invoices.due_date) >', 0);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('acs_profile.prof_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Invoices and Received Payments data in Database
        if ($reportType == 'invoices_and_payments') {
            $this->db->select('invoices.id AS invoice_id, invoice_payments.id AS invoice_payment_id, invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created, "%Y-%m-%d") AS date, "" AS transaction_type, "" AS memo_description, invoices.grand_total AS invoice_grand_total, invoices.id AS num, invoice_payments.amount AS payment_amount, DATE_FORMAT(invoices.date_created, "%Y-%m-%d") AS invoice_date, DATE_FORMAT(invoice_payments.date_created, "%Y-%m-%d") AS invoice_payment_date');
            $this->db->from('invoices');
            $this->db->join('invoice_payments', 'invoice_payments.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('acs_profile.prof_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Account List data in Database
        if ($reportType == 'account_list') {
            $this->db->select('accounting_chart_of_accounts.id AS account_id, accounting_chart_of_accounts.name AS account, accounting_chart_of_accounts.description AS type, account_detail.acc_detail_name AS detail_type, "" AS description, accounting_chart_of_accounts.balance AS balance');
            $this->db->from('accounting_chart_of_accounts');
            $this->db->join('account', 'account.id = accounting_chart_of_accounts.account_id', 'left');
            $this->db->join('account_detail', 'account_detail.acc_detail_id = accounting_chart_of_accounts.acc_detail_id', 'left');
            $this->db->where('accounting_chart_of_accounts.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Employee Details data in Database
        if ($reportType == 'employee_details') {
            $this->db->select('users.id AS user_id, CONCAT(users.FName, " ", users.LName) AS name, users.birthdate AS birthdate, TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) AS age, CONCAT(users.address, " ", users.city, ", ", users.state, ", ", users.postal_code) AS address, users.phone AS phone_number, users.mobile AS mobile_number, users.date_hired AS date_hired, users.email, roles.title AS role, users.pay_rate AS pay_rate');
            $this->db->from('users');
            $this->db->join('roles', 'roles.id = users.role', 'left');
            $this->db->where('users.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Account Receivable Againg Summary Data in Database
        if ($reportType == 'accounts_receivable_aging_summary') {
            $this->db->select('
                invoices.customer_id AS customer_id, 
                CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, 
                invoices.id AS invoice_id, 
                invoices.grand_total AS amount
            ');
            $this->db->from('invoices');
            $this->db->join('invoice_payments', 'invoice_payments.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where('acs_profile.first_name !=', '');
            // $this->db->group_by('invoice_payments.invoice_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'profit_and_loss_percentage_income_backup') {
            $this->db->select('
                invoices.customer_id AS customer_id, 
                CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, 
                invoices.id AS invoice_id, 
                invoices.grand_total AS amount
            ');
            $this->db->from('invoices');
            $this->db->join('invoice_payments', 'invoice_payments.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where('acs_profile.first_name !=', '');
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'profit_and_loss_percentage_income') {
            $this->db->select('
                invoices.customer_id AS customer_id, 
                CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, 
                invoices.date_issued, 
                invoices.grand_total AS amount
            ');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_issued,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_issued,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->group_by('invoices.customer_id');
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Balance Sheet Data in Database
        if ($reportType == 'balance_sheet') {
            $this->db->select('SUM(total_amount) AS total_amount');
            $this->db->from('accounting_check');
            $this->db->where('company_id', $companyID);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'balance_sheet_summary') {
            $this->db->select('SUM(total_amount) AS total_amount');
            $this->db->from('accounting_check');
            $this->db->where('company_id', $companyID);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Balance Sheet Data in Database
        if ($reportType == 'statement_of_cash_flows') {
            $this->db->select('COALESCE(SUM(grand_total), 0) AS total_amount');
            $this->db->from('invoices');
            $this->db->where('company_id', $companyID);
            if (!empty($reportConfig['date_from']) && !empty($reportConfig['date_to'])) {
                $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
                $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            }
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $checkData = $this->db->get()->result();

            $this->db->select('COALESCE(SUM(amount_received), 0) AS total_amount');
            $this->db->from('accounting_receive_payment');
            $this->db->where('company_id', $companyID);
            if (!empty($reportConfig['date_from']) && !empty($reportConfig['date_to'])) {
                $this->db->where("accounting_receive_payment.payment_date >= '$reportConfig[date_from]'");
                $this->db->where("accounting_receive_payment.payment_date <= '$reportConfig[date_to]'");
            }
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $receivePaymentData = $this->db->get()->result();

            $totalAmountFromCheckData = !empty($checkData) ? $checkData[0]->total_amount : 0;
            $totalAmountFromReceivePaymentData = !empty($receivePaymentData) ? $receivePaymentData[0]->total_amount : 0;

            $totalAccountsReceivable = $totalAmountFromCheckData + $totalAmountFromReceivePaymentData;

            // Bank Accounts
            $dateFrom = $reportConfig['date_from'];
            $dateTo = $reportConfig['date_to'];

            $this->db->select('COALESCE(SUM(balance), 0) AS total_amount');
            $this->db->from('accounting_chart_of_accounts');
            $this->db->where('company_id', $companyID);

            if (!empty($dateFrom) && !empty($dateTo)) {
                $this->db->where('DATE(created_at) >=', $dateFrom);
                $this->db->where('DATE(created_at) <=', $dateTo);
            }

            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);

            $query = $this->db->get();
            $result = $query->row();

            $chartOfAccountData = !empty($result) ? $result->total_amount : 0;

            return [
                'accounting_chart_of_accounts' => $chartOfAccountData,
                'totalAccountsReceivable' => $totalAccountsReceivable,
            ];
        }

        if ($reportType == 'accounts_payable_aging_summary') {
            return [];
        }

        // Get Deposit Details data in Database
        // Info: Deposit Detail Report is a report that shows all the deposits made into your bank accounts over a specified period (this includes paid invoices). This report helps you track and review the details of each deposit transaction, providing a clear overview of your cash inflows.
        if ($reportType == 'deposit_detail') {
            $this->db->select('invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Payment" AS transaction_type, invoices.id AS num, "" AS vendor, invoices.message_on_invoice AS memo_description, "" AS clr, invoices.grand_total AS amount');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
            $this->db->where('invoices.status =', 'Paid');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Check Details data in Database
        // Info: Check Detail Report provides detailed information about all the checks written by your business over a specified period.
        if ($reportType == 'check_detail') {
            $this->db->select('accounting_check.payee_id AS payee_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name, accounting_vendors.display_name AS vendor_name, accounting_check.payment_date AS date, "Check" AS transaction_type, accounting_check.check_no AS num, accounting_check.memo AS memo_description, "" AS clr, accounting_check.total_amount AS amount');
            $this->db->from('accounting_check');
            $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_check.payee_id', 'left');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_check.payee_id', 'left');
            $this->db->where('accounting_check.check_no !=', '');
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_check.company_id', $companyID);
            $this->db->group_by('accounting_check.payee_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Vendor unpaid bills in Database
        if ($reportType == 'unpaid_bills_summary') {
            $this->db->select('accounting_bill.*, CONCAT(accounting_vendors.f_name, " ", accounting_vendors.l_name) AS vendor');
            $this->db->from('accounting_bill');
            $this->db->join('accounting_vendors', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where('accounting_vendors.f_name !=', '');
            $this->db->where('accounting_vendors.l_name !=', '');
            $this->db->where('accounting_bill.status', 1);
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);

            $data = $this->db->get();

            return $data->result();
        }

        // Get 1099 Contractor Balance Detaill data in Database
        // Info: 1099 Contractor Balance Detail Report is a report that provides detailed information about payments made to independent contractors or vendors.
        // Data is temporarily fetch on vendors only bcoz the contractor data is not yet implemented.
        if ($reportType == 'contractor_balance_detail') {
            $this->db->select('accounting_vendors.id AS vendor_id, accounting_vendors.display_name AS vendor, accounting_bill.bill_date AS date, "Invoice" AS transaction_type, accounting_bill.id AS num, accounting_bill.due_date AS due_date, accounting_bill.total_amount AS amount, accounting_bill.remaining_balance AS open_balance,accounting_bill.remaining_balance AS balance');
            $this->db->from('accounting_vendors');
            $this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where('accounting_vendors.display_name !=', '');
            $this->db->where('accounting_bill.remaining_balance !=', '');
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get 1099 Contractor Balance Detaill data in Database
        // Info: 1099 Contractor Balance Summary Report is a report that provides summarized information about payments made to independent contractors or vendors.
        // Data is temporarily fetch on vendors only bcoz the contractor data is not yet implemented.
        if ($reportType == 'contractor_balance_summary') {
            $this->db->select('accounting_vendors.id AS vendor_id, accounting_vendors.display_name AS vendor, accounting_bill.remaining_balance AS balance, accounting_bill.created_at AS date');
            $this->db->from('accounting_vendors');
            $this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where('accounting_vendors.display_name !=', '');
            $this->db->where('accounting_bill.remaining_balance !=', '');
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_bill.bill_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'recent_edited_time_activities') {
            $this->db->select('accounting_single_time_activity.*, accounting_single_time_activity.date AS activity_date, CONCAT(acs_profile.first_name  , " ", acs_profile.last_name) AS customer, items.title AS product_service');
            $this->db->from('accounting_single_time_activity');
            $this->db->join('acs_profile', 'accounting_single_time_activity.customer_id = acs_profile.prof_id', 'left');
            $this->db->join('items', 'accounting_single_time_activity.service_id = items.id', 'left');
            $this->db->where('accounting_single_time_activity.name_key !=', '');
            $this->db->where("accounting_single_time_activity.date >= '$reportConfig[date_from]'");
            $this->db->where("accounting_single_time_activity.date <= '$reportConfig[date_to]'");
            $this->db->where('accounting_single_time_activity.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Transaction List by Vendor data in Database
        // Info: Transaction List by Vendor report is a detailed report that provides a comprehensive list of all transactions associated with each vendor over a specific period.
        if ($reportType == 'transaction_list_by_vendor') {
            $this->db->select('accounting_check.id AS transaction_id, accounting_check.payee_id AS vendor_id, accounting_vendors.display_name AS vendor, accounting_check.payment_date AS date, accounting_account_transactions.transaction_type AS transaction_type, accounting_check.id AS num, accounting_check.status AS posting, accounting_check.memo AS memo_description, accounting_chart_of_accounts.name AS account, accounting_check.total_amount AS amount');
            $this->db->from('accounting_check');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_check.payee_id', 'left');
            $this->db->join('accounting_account_transactions', 'accounting_account_transactions.account_id = accounting_check.bank_account_id', 'left');
            $this->db->join('accounting_chart_of_accounts', 'accounting_chart_of_accounts.id = accounting_account_transactions.account_id', 'left');
            $this->db->where('accounting_vendors.display_name !=', '');
            $this->db->where('accounting_check.payee_type =', 'vendor');
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_check.payee_id');
            $data = $this->db->get();

            return $data->result();
        }

        // Get 1099 Transaction Detail Report data in Database
        // Info: 1099 Transaction Detail Report is a report that provides detailed information about payments made to vendors (or contractor) who require a 1099 form.
        if ($reportType == '1099_transaction_detail') {
            $this->db->select('accounting_check.id AS transaction_id,  accounting_check.payee_id AS vendor_id,  accounting_vendors.display_name AS vendor,  accounting_check.payment_date AS date,  accounting_account_transactions.transaction_type AS transaction_type,  accounting_check.id AS num,  accounting_check.memo AS memo_description,  "" AS _1099_box, accounting_chart_of_accounts.name AS account, "" AS split, accounting_check.total_amount AS amount, accounting_check.total_amount AS balance, "" AS tax_id');
            $this->db->from('accounting_check');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_check.payee_id', 'left');
            $this->db->join('accounting_account_transactions', 'accounting_account_transactions.account_id = accounting_check.bank_account_id', 'left');
            $this->db->join('accounting_chart_of_accounts', 'accounting_chart_of_accounts.id = accounting_account_transactions.account_id', 'left');
            $this->db->where('accounting_vendors.display_name !=', '');
            $this->db->where('accounting_check.payee_type =', 'vendor');
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_check.payee_id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'bills_and_applied_payments') {
            $this->db->select('accounting_bill.*, accounting_vendors.display_name as vendor_name');
            $this->db->from('accounting_bill');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_bill.vendor_id', 'left');
            $this->db->where('accounting_bill.company_id', $companyID);
            $this->db->where("accounting_bill.bill_date >= '$reportConfig[date_from]'");
            $this->db->where("accounting_bill.bill_date <= '$reportConfig[date_to]'");
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            // $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Employee Directory data in Database
        if ($reportType == 'employee_directory') {
            $this->db->select('users.id AS user_id, CONCAT(users.FName, " ", users.LName) AS name, users.birthdate AS birthdate, TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) AS age, CONCAT(users.address, " ", users.city, ", ", users.state, ", ", users.postal_code) AS address, users.phone AS phone_number, users.mobile AS mobile_number, users.date_hired AS date_hired, users.email');
            $this->db->from('users');
            $this->db->where('users.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Journal Report data in Database
        // Info: Journal Report is a detailed report that shows the individual accounting entries (journal entries) that make up a transaction.
        if ($reportType == 'journal') {
            $this->db->select('journal_view.name_id AS name_id, journal_view.name AS name, journal_view.transaction_id AS transaction_id, journal_view.date AS date, journal_view.transaction_type AS transaction_type, journal_view.num AS num, journal_view.memo_description AS memo_description, journal_view.account AS account, journal_view.entry_type AS entry_type, journal_view.amount AS amount');
            $this->db->from('journal_view');
            $this->db->where('journal_view.company_id', $companyID);
            $this->db->where("journal_view.date >= '$reportConfig[date_from]'");
            $this->db->where("journal_view.date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('journal_view.name_id');
            $data = $this->db->get();

            return $data->result();
        }

        // Get Recent Automatic Transactions data in Database
        // Info: Recent Automatic Transactions Report is a that shows you a list of transactions that have been automatically recorded in your accounting.
        if ($reportType == 'recent_automatic_transactions') {
            $this->db->select('journal_view.name_id AS name_id, journal_view.name AS name, journal_view.date AS date, journal_view.transaction_type AS transaction_type, journal_view.num AS num, "Yes" AS posting, journal_view.memo_description AS memo_description, journal_view.account AS account, "" AS split, "" AS paid_by_mas, journal_view.amount AS amount');
            $this->db->from('journal_view');
            $this->db->where('journal_view.company_id', $companyID);
            $this->db->where("journal_view.date >= '$reportConfig[date_from]'");
            $this->db->where("journal_view.date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('journal_view.name_id');
            $data = $this->db->get();

            return $data->result();
        }

        // Get Payroll Billing Summary in Database
        if ($reportType == 'payroll_billing_summary') {
            $this->db->select('*');
            $this->db->from('accounting_paychecks');
            $this->db->where('company_id', $companyID);
            $this->db->where("pay_date >= '$reportConfig[date_from]'");
            $this->db->where("pay_date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Payroll Summary in Database
        if ($reportType == 'payroll_summary') {
            $this->db->select('*');
            $this->db->from('accounting_payroll');
            $this->db->where('company_id', $companyID);
            $this->db->where("pay_period_start >= '$reportConfig[date_from]'");
            $this->db->where("pay_period_end <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Total Pay in Database
        if ($reportType == 'total_pay') {
            $this->db->select('*');
            $this->db->from('accounting_payroll');
            $this->db->where('company_id', $companyID);
            $this->db->where("pay_date >= '$reportConfig[date_from]'");
            $this->db->where("pay_date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Paycheck History in Database
        if ($reportType == 'paycheck_history') {
            $this->db->select('accounting_paychecks.*, CONCAT(users.FName, " ", users.LName)AS employee');
            $this->db->from('accounting_paychecks');
            $this->db->join('users', 'accounting_paychecks.employee_id = users.id', 'left');
            $this->db->where('accounting_paychecks.company_id', $companyID);
            $this->db->where("accounting_paychecks.pay_date >= '$reportConfig[date_from]'");
            $this->db->where("accounting_paychecks.pay_date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Payroll Details data in Database
        // Info: Payroll Details is a report that shows you all the details of your employees' pay for a specific period of time.
        if ($reportType == 'payroll_details') {
            $this->db->select('accounting_paychecks.id AS payroll_id, accounting_paychecks.employee_id AS employee_id, CONCAT(users.FName, " ", users.LName) AS employee, accounting_paychecks.pay_date AS pay_date, accounting_payroll_employees.employee_hours AS hrs, accounting_payroll_employees.employee_total_pay AS gross_pay, accounting_payroll_employees.employee_bonus AS other_pay, ((accounting_payroll_employees.employee_total_pay / 100) * 6.2) AS social_security, ((accounting_payroll_employees.employee_total_pay / 100) * 1.45) AS medicare, accounting_payroll_employees.employee_net_pay AS net_pay, accounting_payroll_employees.employee_total_pay AS total_payroll_cost');
            $this->db->from('accounting_paychecks');
            $this->db->join('accounting_payroll_employees', 'accounting_payroll_employees.payroll_id = accounting_paychecks.payroll_id', 'left');
            $this->db->join('users', 'users.id = accounting_paychecks.employee_id', 'left');
            $this->db->where('users.company_id', $companyID);
            $this->db->where("accounting_paychecks.pay_date >= '$reportConfig[date_from]'");
            $this->db->where("accounting_paychecks.pay_date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_paychecks.id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'sales_tax_liability_reports') {
            $this->db->select('invoices.id AS invoice_id,
                items.title AS product_service,
                (SELECT SUM((items.price - invoices_items.discount) * invoices_items.qty + invoices_items.tax) 
                    FROM invoices 
                    LEFT JOIN invoices_items ON invoices_items.invoice_id = invoices.id 
                        LEFT JOIN items ON items.id = invoices_items.items_id 
                    WHERE invoices.company_id = '.$companyID.' 
                        AND DATE_FORMAT(invoices.date_created, "%Y-%m-%d") >= "'.$reportConfig['date_from'].'" 
                        AND DATE_FORMAT(invoices.date_created, "%Y-%m-%d") <= "'.$reportConfig['date_to'].'"
                ) AS gross_total,
                (SELECT SUM((items.price - invoices_items.discount) * invoices_items.qty) 
                    FROM invoices 
                    LEFT JOIN invoices_items ON invoices_items.invoice_id = invoices.id 
                    LEFT JOIN items ON items.id = invoices_items.items_id 
                    WHERE invoices.company_id = '.$companyID.' 
                        AND invoices_items.tax > 0 
                        AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") >= "'.$reportConfig['date_from'].'" 
                        AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") <= "'.$reportConfig['date_to'].'"
                ) AS taxable_amount,
                (SELECT SUM((items.price - invoices_items.discount) * invoices_items.qty) 
                    FROM invoices 
                    LEFT JOIN invoices_items ON invoices_items.invoice_id = invoices.id 
                    LEFT JOIN items ON items.id = invoices_items.items_id 
                    WHERE invoices.company_id = '.$companyID.' 
                    AND invoices_items.tax <= 0 
                    AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") >= "'.$reportConfig['date_from'].'" 
                    AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") <= "'.$reportConfig['date_to'].'"
                ) AS non_taxable_amount,
                SUM(invoices_items.tax) AS tax_amount
            ');
            $this->db->from('invoices');
            $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
            $this->db->where('items.title !=', '');
            $this->db->where('items.price !=', 0);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('items.id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Vacation and Sick Leave data in Database
        if ($reportType == 'vacation_and_sick_leave') {
            $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee, timesheet_pto.name AS leave_type,timesheet_leave_date.date AS leave_date,timesheet_leave_date.date_time AS date_filed');
            $this->db->from('timesheet_leave');
            $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
            $this->db->join('timesheet_leave_date', 'timesheet_leave.id = timesheet_leave_date.leave_id', 'left');
            $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');
            $this->db->where('users.company_id', $companyID);
            $this->db->where("timesheet_leave_date.date >= '$reportConfig[date_from]'");
            $this->db->where("timesheet_leave_date.date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Workers Compensation data in Database
        if ($reportType == 'workers_compensation') {
            $this->db->select('accounting_paychecks.*, CONCAT(users.FName, " ", users.LName) AS employee, users.state AS state, COALESCE(accounting_payroll_employees.employee_total_pay,0) AS gross_pay, COALESCE(accounting_payroll_employees.employee_bonus,0) AS bonus_pay, COALESCE(accounting_payroll_employees.employee_taxes,0)AS employee_tax');
            $this->db->from('accounting_paychecks');
            $this->db->join('accounting_payroll_employees', 'accounting_payroll_employees.payroll_id = accounting_paychecks.payroll_id', 'left');
            $this->db->join('users', 'users.id = accounting_paychecks.employee_id', 'left');
            $this->db->where('users.company_id', $companyID);
            $this->db->where("accounting_paychecks.pay_date >= '$reportConfig[date_from]'");
            $this->db->where("accounting_paychecks.pay_date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_paychecks.id');
            $data = $this->db->get();

            return $data->result();
        }

        // Get Payroll Tax Payments data in Database
        if ($reportType == 'payroll_tax_payments') {
            $this->db->select('accounting_paychecks.*, CONCAT(users.FName, " ", users.LName) AS employee, users.state AS state, COALESCE(accounting_payroll_employees.employee_total_pay,0) AS gross_pay, COALESCE(accounting_payroll_employees.employee_bonus,0) AS bonus_pay, COALESCE(accounting_payroll_employees.employee_taxes,0)AS employee_tax');
            $this->db->from('accounting_paychecks');
            $this->db->join('accounting_payroll_employees', 'accounting_payroll_employees.payroll_id = accounting_paychecks.payroll_id', 'left');
            $this->db->join('users', 'users.id = accounting_paychecks.employee_id', 'left');
            $this->db->where('users.company_id', $companyID);
            $this->db->where("accounting_paychecks.pay_date >= '$reportConfig[date_from]'");
            $this->db->where("accounting_paychecks.pay_date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_paychecks.id');
            $data = $this->db->get();

            return $data->result();
        }

        // Get Unbilled Time in Database
        if ($reportType == 'unbilled_time') {
            $this->db->select('accounting_single_time_activity.*, accounting_single_time_activity.date AS unbilled_date, CONCAT(users.FName, " ", users.LName) AS employee, CONCAT(acs_profile.first_name, " ",acs_profile.last_name)AS customer, items.title AS product_service');
            $this->db->from('accounting_single_time_activity');
            $this->db->join('users', 'accounting_single_time_activity.name_id = users.id', 'left');
            $this->db->join('acs_profile', 'accounting_single_time_activity.customer_id = acs_profile.prof_id', 'left');
            $this->db->join('items', 'accounting_single_time_activity.service_id = items.id', 'left');
            $this->db->where('accounting_single_time_activity.company_id', $companyID);
            $this->db->where("accounting_single_time_activity.date >= '$reportConfig[date_from]'");
            $this->db->where("accounting_single_time_activity.date <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Unbilled Charges data in Database
        // Info: Unbilled Charges Report are transactions that have been recorded but not yet invoiced to customers.
        if ($reportType == 'unbilled_charges') {
            $this->db->select('invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, "No" AS posting, invoices.message_to_customer AS memo_description, invoices.grand_total AS amount, invoices.total_due AS balance');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
            $this->db->where('invoices.status !=', 'Paid');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id, customer');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Invoices by Date data in Database
        if ($reportType == "invoice_by_date") {
            $this->db->select('invoices.id AS invoices_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.date_issued AS invoice_date, invoices.invoice_number AS num, invoices.due_date AS due_date, invoices.balance AS invoice_balance, invoices.grand_total AS invoice_total');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            //$this->db->where('acs_profile.first_name !=', '');
            //$this->db->where('acs_profile.last_name !=', '');
            $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();
            return $query->result();
        }

        // Get Expenses by Workorder in Database
        if ($reportType == "expenses_by_workorder") {
            $this->db->select('work_orders.work_order_number AS num, work_orders.date_issued, work_orders.grand_total AS total_amount, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer');
            $this->db->from('work_orders');
            $this->db->join('acs_profile', 'work_orders.customer_id = acs_profile.prof_id', 'left');
            //$this->db->where('acs_profile.first_name !=', '');
            //$this->db->where('acs_profile.last_name !=', '');
            $this->db->where("work_orders.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("work_orders.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('work_orders.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();
            return $query->result();
        }

        // Get Sales Summary by Customer in Database
        if ($reportType == "sales_summary_by_customer") {
            $this->db->select('COALESCE(SUM(invoices.grand_total),0) AS total_amount, COUNT(invoices.id)AS total_invoices, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'left');
            //$this->db->where('acs_profile.first_name !=', '');
            //$this->db->where('acs_profile.last_name !=', '');
            $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->group_by('invoices.customer_id');
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();
            return $query->result();
        }

        // Get Customer Source in Database
        if ($reportType == "customer_source") {
            $query = $this->db->query('
                SELECT ac_leadsource.*, 
                (
                    SELECT COUNT(acs_office.off_id)AS total
                    FROM acs_office 
                    JOIN acs_profile ON acs_office.fk_prof_id = acs_profile.prof_id 
                    WHERE acs_profile.customer_type = "Residential"                        
                        AND acs_office.lead_source = ac_leadsource.ls_name
                )AS total_residential,
                (
                    SELECT COUNT(acs_office.off_id)AS total
                    FROM acs_office 
                    JOIN acs_profile ON acs_office.fk_prof_id = acs_profile.prof_id 
                    WHERE acs_profile.customer_type = "Commercial"                        
                        AND acs_office.lead_source = ac_leadsource.ls_name
                )AS total_commercial
                FROM ac_leadsource
                WHERE ac_leadsource.fk_company_id = ' . $companyID . '
                ORDER BY ' . $reportConfig['sort_by'] . ' ' . $reportConfig['sort_order'] . ' 
                LIMIT ' . $reportConfig['page_size'] . '
            ');
            return $query->result();
        }

        // Get Workorder Status Database
        if ($reportType == "workorder_status") {
            $this->db->select('work_orders.work_order_number AS num, work_orders.date_issued, work_orders.status AS workorder_status, COALESCE(work_orders.grand_total,0) AS total_amount, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer');
            $this->db->from('work_orders');
            $this->db->join('acs_profile', 'work_orders.customer_id = acs_profile.prof_id', 'left');
            //$this->db->where('acs_profile.first_name !=', '');
            //$this->db->where('acs_profile.last_name !=', '');
            $this->db->where("work_orders.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("work_orders.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('work_orders.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();
            return $query->result();
        }

        // Get Activities Payroll Summary in Database
        if ($reportType == 'activities_payroll_summary') {
            $this->db->select('*');
            $this->db->from('accounting_payroll');
            $this->db->where('company_id', $companyID);
            $this->db->where("pay_period_start >= '$reportConfig[date_from]'");
            $this->db->where("pay_period_end <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Activities Timelog Summary in Database
        if ($reportType == 'timelog_summary') {
            $query = $this->db->query("
                SELECT timesheet_attendance.id,timesheet_attendance.user_id,timesheet_attendance.date_created AS attendance_date,timesheet_attendance.shift_duration, timesheet_attendance.break_duration, timesheet_attendance.overtime, timesheet_attendance.overtime_status,timesheet_attendance.status,timesheet_attendance.notes,
                CONCAT(users.FName, ' ', users.LName)AS employee_name, roles.title AS employee_role
                FROM timesheet_attendance 
                    JOIN users ON timesheet_attendance.user_id = users.id 
                    JOIN roles ON users.role = roles.id 
                WHERE timesheet_attendance.date_created >='" . $reportConfig['date_from'] . "' 
                    AND timesheet_attendance.date_created <='" . $reportConfig['date_to'] . "' 
                    AND users.company_id = " . $companyID . " 
                ORDER BY " . $reportConfig['sort_by'] . " " . $reportConfig['sort_order'] . " 
                LIMIT " . $reportConfig['page_size'] . "
            ");

            return $query->result();
        }

        // Get Activities Payroll Logs Database
        if ($reportType == 'payroll_log_details') {
            $this->db->select('*');
            $this->db->from('accounting_payroll');
            $this->db->where('company_id', $companyID);
            $this->db->where("pay_period_start >= '$reportConfig[date_from]'");
            $this->db->where("pay_period_end <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }
    }
}
