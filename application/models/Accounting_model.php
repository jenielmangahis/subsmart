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


    public function fetchReportData($reportType, $reportConfig = array())
    {
        $loggedInUser = logged('id');
        $companyID = logged('company_id');

        // Get Sales Tax Liability Report data in Database
        if ($reportType == "sales_tax_liability") {
        }

        // Get Customer Contact List Report data in Database
        if ($reportType == "customer_contact_list") {
            $this->db->select('prof_id, CONCAT(first_name  , " ", last_name) AS customer, phone_h AS phoneNumber, email, CONCAT(mail_add, " ", city, ", ", state, " ", zip_code) AS billingAddress, CONCAT(mail_add, " ", city, ", ", state, " ", zip_code) AS shippingAddress');
            $this->db->from('acs_profile');
            $this->db->where('company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Vendor Contact List data in Database
        if ($reportType == "vendor_contact_list") {
            $this->db->select('id, display_name AS vendor, CONCAT(phone, "  ",  mobile) AS phone_numbers, email, display_name AS fullname, CONCAT(street, " ", city, ", ", state, " ", zip, " ", country) AS address, account_number');
            $this->db->from('accounting_vendors');
            $this->db->where('company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Expenses by Vendor Summary data in Database
        if ($reportType == "expenses_by_vendor_summary") {
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

        if ($reportType == "audit_log_list") {
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
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            // $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            $auditLogsData = $data->result();

            // reassign objects
            $arrayStdObject = array();
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
                    case "Workorder":
                        $output->date_changed = $auditLog->workorder_datechanged;
                        $output->amount = $auditLog->workorder_amount;
                        break;
                    case "Invoice":
                        $output->date_changed = $auditLog->invoice_datechanged;
                        $output->amount = $auditLog->invoice_amount;
                        break;
                    case "Estimate":
                        $output->date_changed = $auditLog->estimate_datechanged;
                        $output->amount = $auditLog->estimate_amount;
                        break;
                    case "Jobs":
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
        if ($reportType == "inventory_valuation_summary") {
            $this->db->select('items.id AS id, SUBSTRING(MD5(items.id), 1, 10) AS product_sku, items.title AS product_name, items.type AS product_type, (items_has_storage_loc.qty + items_has_storage_loc.initial_qty) AS product_quantity, (items.price * (items_has_storage_loc.qty + items_has_storage_loc.initial_qty)) AS product_asset_value, items.price AS product_calculated_average');
            $this->db->from('items');
            $this->db->join('items_has_storage_loc', 'items_has_storage_loc.item_id = items.id', 'left');
            $this->db->where('items.type', "Product");
            $this->db->where('(items_has_storage_loc.qty + items_has_storage_loc.initial_qty) >', 0);
            $this->db->where('items.company_id', $companyID);
            $this->db->group_by('items.type');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Customer Balance Summary data in Database
        if ($reportType == "customer_balance_summary") {
            // $this->db->select('acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, COALESCE(SUM(invoices.total_due),0) AS balance');
            // $this->db->from('invoices');
            // $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id');
            // $this->db->where('invoices.status !=', "Paid");
            // $this->db->where('invoices.status !=', "Draft");
            // $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            // $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            // $this->db->where('acs_profile.company_id', $companyID);
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            //$this->db->limit($reportConfig['page_size']);

            $query = $this->db->query('
                SELECT 
                    acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, (
                        SELECT COALESCE(SUM(invoices.grand_total),0) AS balance
                        FROM invoices 
                        WHERE invoices.customer_id = acs_profile.prof_id 
                            AND invoices.status != "Paid"
                            AND invoices.status != "Draft"
                            AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") >= "' . $reportConfig['date_from'] . '"
                            AND DATE_FORMAT(invoices.date_created,"%Y-%m-%d") <= "' . $reportConfig['date_to'] . '"
                    ) AS balance
                FROM acs_profile
                WHERE acs_profile.company_id = ' . $companyID . '
                ORDER BY ' . $reportConfig['sort_by'] . ' ' . $reportConfig['sort_order'] . ' 
                LIMIT ' .$reportConfig['page_size'].'
            ');
            return $query->result();
        }

        // Get Physical Inventory Worksheet data in Database
        if ($reportType == "physical_inventory_worksheet") {
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
        if ($reportType == "customer_balance_detail") {
            $this->db->select('invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.id AS num, invoices.due_date AS due_date, invoices.grand_total AS amount, accounting_receive_payment_invoices.open_balance AS open_balance, invoices.total_due AS balance');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
            //$this->db->where('invoices.status', "Unpaid");
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "Paid");
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
        if ($reportType == "sales_by_customer_summary") {
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
        if ($reportType == "sales_by_customer_detail") {
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
        if ($reportType == "sales_by_customer_type_detail") {
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
        if ($reportType == "sales_by_product_service_detail") {
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
        if ($reportType == "vendor_balance_summary") {
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
        if ($reportType == "vendor_balance_detail") {
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
        if ($reportType == "purchases_by_vendor_detail") {
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
        if ($reportType == "purchases_by_product_service_detail") {
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
        if ($reportType == "inventory_valuation_detail") {
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
        if ($reportType == "estimates_by_customer") {
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
        if ($reportType == "invoice_list_by_date") {
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

        // Get Payment Method List data in Database
        if ($reportType == "payment_method_list") {
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
        if ($reportType == "open_invoices") {
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
        if ($reportType == "product_service_list") {
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
        if ($reportType == "sales_by_product_service_summary") {
            $this->db->select('invoices.id AS invoice_id, items.title AS product_service, invoices_items.qty AS quantity, SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) AS amount, ((SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) / (SELECT SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) FROM invoices LEFT JOIN invoices_items ON invoices_items.invoice_id = invoices.id LEFT JOIN items ON items.id = invoices_items.items_id WHERE invoices.company_id = ' . $companyID . ')) * 100) AS sales_percentage, (SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) / invoices_items.qty) AS average_price, SUM(items.COGS * invoices_items.qty) AS COGS, (SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) - SUM(items.COGS * invoices_items.qty)) AS gross_margin, (((SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax) - SUM(items.COGS * invoices_items.qty)) / SUM(((items.price - invoices_items.discount) * invoices_items.qty) + invoices_items.tax)) * 100) AS gross_margin_percentage');
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
        if ($reportType == "taxable_sales_detail") {
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
        if ($reportType == "taxable_sales_summary") {
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

        // Get Income by Customer Summary data in Database
        if ($reportType == "income_by_customer_summary") {
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
        if ($reportType == "estimate_progress_invoicing") {
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
        if ($reportType == "terms_list") {
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
        if ($reportType == "statement_list") {
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
        if ($reportType == "bill_payment_list") {
            $this->db->select('accounting_bill.id AS bill_id, accounting_vendors.id AS vendor_id, accounting_bill.bill_date AS bill_date, accounting_bill.id AS num, accounting_vendors.display_name AS vendor, accounting_bill.total_amount AS amount');
            $this->db->from('accounting_bill');
            // $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_bill.qbid', 'left'); -- Temporary Removed
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_bill.vendor_id', 'left');
            $this->db->where("DATE_FORMAT(accounting_bill.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_bill.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_bill.company_id', $companyID);
            $this->db->where('accounting_vendors.display_name !=', "");
            $this->db->where('accounting_vendors.f_name !=', "");
            $this->db->where('accounting_vendors.l_name !=', "");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Collections Report data in Database
        if ($reportType == "collections_report") {
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
        if ($reportType == "invoices_and_payments") {
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
        if ($reportType == "account_list") {
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
        if ($reportType == "employee_details") {
            $this->db->select('users.id AS user_id, CONCAT(users.FName, " ", users.LName) AS name, users.birthdate AS birthdate, TIMESTAMPDIFF(YEAR, users.birthdate, CURDATE()) AS age, CONCAT(users.address, " ", users.city, ", ", users.state, ", ", users.postal_code) AS address, users.phone AS phone_number, users.mobile AS mobile_number, users.date_hired AS date_hired, roles.title AS role, users.pay_rate AS pay_rate');
            $this->db->from('users');
            $this->db->join('roles', 'roles.id = users.role', 'left');
            $this->db->where('users.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Account Receivable Againg Summary Data in Database
        if ($reportType == "accounts_receivable_aging_summary") {
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
            //$this->db->group_by('invoice_payments.invoice_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        if ($reportType == "profit_and_loss_percentage_income_backup") {
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
            //$this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }          

        if ($reportType == "profit_and_loss_percentage_income") {
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
            //$this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->group_by('invoices.customer_id');
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        } 

        // Get Balance Sheet Data in Database
        if ($reportType == "balance_sheet") {
            $this->db->select('SUM(total_amount) AS total_amount');
            $this->db->from('accounting_check');
            $this->db->where('company_id', $companyID);
            $data = $this->db->get();
            return $data->result();
        }

        if ($reportType == "accounts_payable_aging_summary") {
            return array();
        }

        // Get Deposit Details data in Database
        // Info: The Deposit Detail Report is a report that shows all the deposits made into your bank accounts over a specified period (this includes paid invoices). This report helps you track and review the details of each deposit transaction, providing a clear overview of your cash inflows.
        if ($reportType == "deposit_detail") {
            $this->db->select('invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Payment" AS transaction_type, invoices.id AS num, "" AS vendor, invoices.message_on_invoice AS memo_description, "" AS clr, invoices.grand_total AS amount');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
            $this->db->where('invoices.status =', "Paid");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        //Get Check Details data in Database
        // Info: The Check Detail Report provides detailed information about all the checks written by your business over a specified period.
        if ($reportType == "check_detail") {
            $this->db->select('accounting_check.payee_id AS payee_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name, accounting_vendors.display_name AS vendor_name, accounting_check.payment_date AS date, "Check" AS transaction_type, accounting_check.check_no AS num, accounting_check.memo AS memo_description, "" AS clr, accounting_check.total_amount AS amount');
            $this->db->from('accounting_check');
            $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_check.payee_id', 'left');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_check.payee_id', 'left');
            $this->db->where('accounting_check.check_no !=', "");
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_check.payment_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_check.company_id', $companyID);
            $this->db->group_by('accounting_check.payee_id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }
    }
}