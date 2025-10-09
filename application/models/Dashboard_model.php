<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends MY_Model
{
    public function fetchThumbnailWidgetData($category, $dateFrom, $dateTo, $filter3 = null)
    {
        $company_id = logged('company_id');
        switch ($category) {
            case 'subscription_revenue':
                $this->db->select('acs_billing.mmr AS mmr, acs_billing.bill_start_date AS date');
                $this->db->from('acs_profile');
                $this->db->join('acs_billing', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where("DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') <=", $dateTo);
                if ($filter3 == "all_status") {
                    $this->db->where_in('acs_profile.status', ['Active w/RAR', 'Active w/RMR', 'Active w/RQR', 'Active w/RYR', 'Inactive w/RMM']);
                }
                else {
                    $this->db->where('acs_profile.status', $filter3);
                }
                $this->db->order_by('acs_billing.bill_start_date', 'ASC');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'sales':
                $this->db->select('invoices.id AS id, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where_not_in('invoices.status', ['Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'unpaid_invoices':
                $this->db->select('invoices.id AS id, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where_not_in('invoices.status', ['Paid', 'Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.grand_total !=', 0.0);
                $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-90 days')));
                $this->db->where('invoices.due_date <=', date('Y-m-d'));
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'past_due_invoices':
                $this->db->select('invoices.id AS id, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where_not_in('invoices.status', ['Paid', 'Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.grand_total !=', 0.0);
                $this->db->where('invoices.due_date <=', date('Y-m-d'));
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'open_invoices':
                $this->db->select('invoices.id AS id, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where_not_in('invoices.status', ['Paid', 'Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.grand_total !=', 0.0);
                $this->db->where('invoices.due_date <=', date('Y-m-d'));
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'job':
                $this->db->select('jobs.id AS id, jobs.date_created AS date');
                $this->db->from('jobs');
                $this->db->where('jobs.status !=', "Draft");
                $this->db->where('jobs.company_id', $company_id);
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'income':
                $this->db->select('invoices.id AS id, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where('invoices.status =', "Paid");
                $this->db->where('invoices.view_flag', 0);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'collections':
                $this->db->select('invoices.id AS id, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where_not_in('invoices.status', ['Paid', 'Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-90 days')));
                $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-5 years')));
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'estimates':
                $currentDate = date('Y-m-d');

                $this->db->select("
                            estimates.id AS id, 
                            estimates.created_at AS date, 
                            estimates.expiry_date AS expiry_date, 
                            estimates.grand_total AS total,
                            COUNT(CASE 
                                    WHEN estimates.expiry_date >= '{$currentDate}' THEN 1
                                    ELSE NULL
                                END) AS total_open,
                            COUNT(CASE 
                                    WHEN estimates.expiry_date < '{$currentDate}' THEN 1
                                    ELSE NULL
                                END) AS total_expired
                        ");
                $this->db->from('estimates');
                $this->db->where('estimates.company_id', $company_id);
                $this->db->where('estimates.status !=', "Lost");
                $this->db->where('estimates.status !=', "Declined By Customer");
                $this->db->where('estimates.status !=', "Invoiced");
                $this->db->where('estimates.view_flag', 0);
                $this->db->where("DATE_FORMAT(estimates.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(estimates.created_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('estimates.id, estimates.created_at, estimates.expiry_date, estimates.grand_total');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'leads':
                $this->db->select('ac_leads.leads_id AS id, ac_leads.date_created AS date');
                $this->db->from('ac_leads');
                $this->db->where('ac_leads.company_id', $company_id);
                $this->db->where("DATE_FORMAT(ac_leads.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(ac_leads.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'contact':
                $this->db->select('contacts.id AS id, acs_profile.created_at AS date');
                $this->db->from('contacts');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('contacts.phone !=', "");
                $this->db->where("DATE_FORMAT(acs_profile.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(acs_profile.created_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->join('acs_profile', 'acs_profile.prof_id = contacts.customer_id', 'left');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'customer_groups':
                $this->db->select('acs_profile.prof_id AS id, acs_profile.`status` AS status, customer_groups.title AS title, acs_profile.created_at AS date');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                if ($filter3 == "active_only") {
                    $this->db->where_in('acs_profile.status', ['Active w/RAR', 'Active w/RMR', 'Active w/RQR', 'Active w/RYR', 'Inactive w/RMM']);
                }
                $this->db->where('customer_groups.title !=', "");
                $this->db->where("DATE_FORMAT(acs_profile.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(acs_profile.created_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->join('customer_groups', 'customer_groups.id = acs_profile.customer_group_id', 'left');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'esign':
                $this->db->select('user_docfile.id AS id,user_docfile.company_id AS company_id,user_docfile.status AS status,COUNT(user_docfile.id) AS total,user_docfile.created_at AS date');
                $this->db->from('user_docfile');
                $this->db->where('user_docfile.company_id', $company_id);
                $this->db->where("DATE_FORMAT(user_docfile.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(user_docfile.created_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('user_docfile.status');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'accounting_expense':
                $this->db->select('
                    accounting_vendor_transaction_categories.id AS id, 
                    accounting_check.company_id AS company_id, 
                    accounting_chart_of_accounts.name AS account_name, 
                    account.account_name AS account_type, 
                    (
                        COALESCE(SUM(accounting_check.total_amount), 0) +
                        COALESCE(SUM(CASE WHEN accounting_vendor_transaction_categories.transaction_type = "Expense" THEN accounting_vendor_transaction_categories.amount ELSE 0 END), 0) +
                        COALESCE(SUM(accounting_bill.total_amount), 0) +
                        COALESCE(SUM(po.total_amount), 0) +
                        COALESCE(SUM(vendor_credit.total_amount), 0) +
                        COALESCE(SUM(credit_card.amount), 0)
                    ) AS total,
                    accounting_vendor_transaction_categories.created_at AS date
                ');
                $this->db->from('accounting_vendor_transaction_categories');
                $this->db->where('accounting_check.company_id', $company_id);
                $this->db->where("DATE_FORMAT(accounting_vendor_transaction_categories.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(accounting_vendor_transaction_categories.created_at, '%Y-%m-%d') <=", $dateTo);
            
                $this->db->join('accounting_chart_of_accounts', 'accounting_chart_of_accounts.id = accounting_vendor_transaction_categories.expense_account_id', 'left');
                $this->db->join('account', 'account.id = accounting_chart_of_accounts.account_id', 'left');
            
                $this->db->join('accounting_check', 'accounting_check.id = accounting_vendor_transaction_categories.transaction_id', 'left');
                $this->db->join('accounting_expense', 'accounting_expense.id = accounting_vendor_transaction_categories.transaction_id', 'left');
                $this->db->join('accounting_bill', 'accounting_bill.id = accounting_vendor_transaction_categories.transaction_id', 'left');
                $this->db->join('accounting_purchase_order AS po', 'po.id = accounting_vendor_transaction_categories.transaction_id', 'left');
                $this->db->join('accounting_vendor_credit AS vendor_credit', 'vendor_credit.id = accounting_vendor_transaction_categories.transaction_id', 'left');
                $this->db->join('accounting_pay_down_credit_card AS credit_card', 'credit_card.id = accounting_vendor_transaction_categories.transaction_id', 'left');
                $this->db->group_by('accounting_chart_of_accounts.name');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'payment_types':
                $this->db->select('payment_records.id AS id,payment_records.company_id AS company_id,payment_records.payment_method AS payment_method,SUM(payment_records.invoice_amount) AS total,payment_records.payment_date AS date');
                $this->db->from('payment_records');
                $this->db->where('payment_records.company_id ', $company_id);
                $this->db->where("DATE_FORMAT(payment_records.payment_date, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(payment_records.payment_date, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('payment_records.payment_method');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'service_tickets':
                $this->db->select('tickets.id AS id, tickets.company_id AS company_id, tickets.created_at AS date, tickets.grandtotal AS total');
                $this->db->from('tickets');
                $this->db->where('tickets.company_id ', $company_id);
                $this->db->where("DATE_FORMAT(tickets.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(tickets.created_at, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'lead_source':
                $this->db->select('acs_profile.prof_id AS id, acs_profile.company_id AS company_id, acs_office.lead_source AS lead_source, COUNT(acs_office.lead_source) AS total');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('acs_office.lead_source !=', "");
                $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
                $this->db->group_by('acs_office.lead_source');
                $query = $this->db->get();
                return $query->result();
            break;  
            case 'job_status':
                $this->db->select('jobs.id AS id, jobs.company_id AS company_id, jobs.status AS status, COUNT(jobs.id) AS total, jobs.date_created AS date');
                $this->db->from('jobs');
                $this->db->where('jobs.company_id', $company_id);
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('jobs.status');
                $query = $this->db->get();
                return $query->result();
            break;  
            case 'customer_status':
                $this->db->select('acs_profile.prof_id AS id, acs_profile.company_id AS company_id, acs_profile.status AS status,COUNT(acs_profile.prof_id) AS total, acs_profile.updated_at AS date');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('acs_profile.status !=', "");
                $this->db->where("DATE_FORMAT(acs_profile.updated_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(acs_profile.updated_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('acs_profile.status');
                $query = $this->db->get();
                return $query->result();
            break; 
            case 'job_tags':
                $this->db->select('jobs.id AS id, jobs.company_id AS company_id, jobs.tags AS tags, COUNT(jobs.id) AS total, jobs.date_created AS date');
                $this->db->from('jobs');
                $this->db->where('jobs.company_id', $company_id);
                $this->db->where('jobs.tags !=', "");
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('jobs.tags');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'taskhub':
                $query = $this->db->query("
                    SELECT 
                        tasks.task_id AS id,
                        tasks.company_id AS company_id,
                        tasks.assigned_employee_ids AS assigned_employees,
                        JSON_LENGTH(tasks.assigned_employee_ids) AS shared_tasks,
                        COALESCE(activity_counts.activities, 0) AS activities,
                        tasks.status AS status,
                        tasks.priority AS priority,
                        latest_updates.date_updated AS date
                    FROM tasks
            
                    LEFT JOIN (
                        SELECT task_id, COUNT(*) AS activities
                        FROM tasks_updates
                        GROUP BY task_id
                    ) AS activity_counts ON activity_counts.task_id = tasks.task_id
            
                    LEFT JOIN (
                        SELECT task_id, MAX(date_updated) AS date_updated
                        FROM tasks_updates
                        GROUP BY task_id
                    ) AS latest_updates ON latest_updates.task_id = tasks.task_id
            
                    WHERE tasks.company_id = {$company_id}
                    AND DATE_FORMAT(latest_updates.date_updated, '%Y-%m-%d') >= '{$dateFrom}'
                    AND DATE_FORMAT(latest_updates.date_updated, '%Y-%m-%d') <= '{$dateTo}'
                    ORDER BY latest_updates.date_updated DESC
                ");
                $data = $query->result();
                return $data;
            break;
            case 'activity_logs':
                $this->db->select('activity_logs.id AS id, users.id AS user_id, users.company_id AS company_id, CONCAT(users.FName, " ", users.LName) AS user, activity_logs.activity_name AS activity, activity_logs.created_at AS date');
                $this->db->from('activity_logs');
                $this->db->where('users.company_id', $company_id);
                $this->db->join('users', 'users.id = activity_logs.user_id', 'left');
                $this->db->order_by('activity_logs.created_at', 'DESC');
                $this->db->limit(50);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'recent_customers':
                $this->db->select('acs_profile.prof_id AS id, acs_profile.company_id AS company_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, acs_profile.customer_type AS customer_type, CONCAT(acs_profile.city, ", ", acs_profile.state, " ", acs_profile.zip_code) AS address, acs_profile.created_at AS date');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->order_by('acs_profile.created_at', 'DESC');
                $this->db->limit(10);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'unpaid_invoices_list':
                $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where_not_in('invoices.status', ['Paid', 'Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.grand_total !=', 0.0);
                $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-90 days')));
                $this->db->where('invoices.due_date <=', date('Y-m-d'));            
                $this->db->where('invoices.company_id', $company_id);
                $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                $this->db->order_by('invoices.date_created', 'DESC');
                $this->db->limit(100);
                $data = $this->db->get();
                return $data->result();
            break;
            case 'overdue_invoices_list':
                $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where_not_in('invoices.status', ['Paid', 'Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.grand_total !=', 0.0);
                $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-14 days')));          
                $this->db->where('invoices.company_id', $company_id);
                $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                $this->db->order_by('invoices.date_created', 'DESC');
                $this->db->limit(100);
                $data = $this->db->get();
                return $data->result();
            break;
            case 'paid_invoices':
                $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where('invoices.status =', "Paid");
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.grand_total !=', 0.0);
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                $this->db->order_by('invoices.date_created', 'DESC');
                $data = $this->db->get();
                return $data->result();
            break;
            case 'open_invoices_list':
                $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date, invoices.grand_total AS total');
                $this->db->from('invoices');
                $this->db->where_not_in('invoices.status', ['Paid', 'Draft', '']);
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.grand_total !=', 0.0);
                $this->db->where('invoices.due_date <=', date('Y-m-d'));      
                $this->db->where('invoices.company_id', $company_id);
                $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
                $this->db->order_by('invoices.date_created', 'DESC');
                $this->db->limit(100);
                $data = $this->db->get();
                return $data->result();
            break;
            case 'open_estimates_list':
                $this->db->select('estimates.id AS id, estimates.company_id AS company_id, estimates.estimate_number AS number, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, estimates.status AS status, estimates.created_at AS date, estimates.grand_total AS total');
                $this->db->from('estimates');
                $this->db->where('estimates.status !=', "Draft");
                $this->db->where('estimates.status !=', "Invoiced");
                $this->db->where('estimates.status !=', "Lost");
                $this->db->where('estimates.status !=', "Declined by Customer");
                $this->db->where('estimates.status !=', "Cancelled");
                $this->db->where('estimates.view_flag', 0);
                $this->db->where('estimates.company_id', $company_id);
                $this->db->where("DATE_FORMAT(estimates.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(estimates.created_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->join('acs_profile', 'acs_profile.prof_id = estimates.customer_id', 'left');
                $this->db->order_by('estimates.created_at', 'DESC');
                $this->db->limit(100);
                $data = $this->db->get();
                return $data->result();
            break;
            case 'job_activities':
                $query = $this->db->query("
                    SELECT
                        jobs.id AS id, 
                        jobs.company_id AS company_id, 
                        jobs.customer_id AS customer_id, 
                        CONCAT(acs_profile.first_name, ' ', acs_profile.last_name) AS customer, 
                        CONCAT(acs_profile.city, ', ', acs_profile.state, ' ', acs_profile.zip_code) AS customer_address, 
                        jobs.job_number AS job_number, 
                        jobs.status AS status, 
                        jobs.job_location AS job_location, 
                        CONCAT(u1.FName, ' ', u1.LName) AS sales_rep, 

                        CONCAT(
                            '[',
                            IF(jobs.employee2_id != 0 AND u2.id IS NOT NULL, CONCAT('\"', u2.FName, ' ', u2.LName, '\"'), ''),
                            IF(jobs.employee3_id != 0 AND u3.id IS NOT NULL, CONCAT(', \"', u3.FName, ' ', u3.LName, '\"'), ''),
                            IF(jobs.employee4_id != 0 AND u4.id IS NOT NULL, CONCAT(', \"', u4.FName, ' ', u4.LName, '\"'), ''),
                            IF(jobs.employee5_id != 0 AND u5.id IS NOT NULL, CONCAT(', \"', u5.FName, ' ', u5.LName, '\"'), ''),
                            IF(jobs.employee6_id != 0 AND u6.id IS NOT NULL, CONCAT(', \"', u6.FName, ' ', u6.LName, '\"'), ''),
                            ']'
                        ) AS technicians,

                        SUM(job_items.total) AS job_total, 
                        jobs.date_created AS date_created, 
                        jobs.date_updated AS date_updated

                    FROM jobs
                    LEFT JOIN acs_profile ON acs_profile.prof_id = jobs.customer_id
                    LEFT JOIN job_items ON job_items.job_id = jobs.id

                    LEFT JOIN users u1 ON u1.id = jobs.employee_id
                    LEFT JOIN users u2 ON u2.id = jobs.employee2_id
                    LEFT JOIN users u3 ON u3.id = jobs.employee3_id
                    LEFT JOIN users u4 ON u4.id = jobs.employee4_id
                    LEFT JOIN users u5 ON u5.id = jobs.employee5_id
                    LEFT JOIN users u6 ON u6.id = jobs.employee6_id

                    WHERE jobs.company_id = {$company_id}
                    AND jobs.status IN ('Finished', 'Completed')
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    GROUP BY jobs.id
                    ORDER BY jobs.date_created DESC;
                ");
                $data = $query->result();
                return $data;
            break;
            case 'ytd_stats':
                $query = $this->db->query("
                    SELECT
                    invoices.company_id AS company_id, 
                    'earned' AS category, 
                    SUM(invoices.grand_total) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status = 'Paid'
                        AND invoices.view_flag = 0
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                    invoices.company_id AS company_id, 
                    'invoice_amount' AS category, 
                    SUM(invoices.grand_total) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status NOT IN ('Draft', '')
                        AND invoices.view_flag = 0
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                    jobs_completed_view.company_id AS company_id, 
                    'jobs_completed' AS category, 
                    COUNT(jobs_completed_view.id) AS total
                    FROM jobs_completed_view
                    WHERE jobs_completed_view.company_id = '{$company_id}'
                        AND jobs_completed_view.status IN ('Finished', 'Completed')
                        AND DATE_FORMAT(jobs_completed_view.date, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(jobs_completed_view.date, '%Y-%m-%d') <= '{$dateTo}'
                    UNION 
                    SELECT
                    jobs.company_id AS company_id, 
                    'new_jobs' AS category, 
                    COUNT(jobs.id) AS total
                    FROM jobs
                    WHERE jobs.company_id = '{$company_id}'
                        AND jobs.status = 'Scheduled'
                        AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                    acs_profile.company_id AS company_id, 
                    'lost_accounts' AS category, 
                    COUNT(acs_profile.prof_id) AS total
                    FROM acs_profile
                    WHERE acs_profile.company_id = '{$company_id}'
                        AND acs_profile.status = 'Cancelled'
                        AND DATE_FORMAT(acs_profile.updated_at, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(acs_profile.updated_at, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                    invoices.company_id AS company_id, 
                    'service_projective_income' AS category, 
                    SUM(invoices.grand_total) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status NOT IN ('Paid', 'Draft', '')
                        AND invoices.view_flag = 0
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$dateTo}';
                ");
                $data = $query->result();
                return $data;
            break;
            case 'today_stats':
                $currentMonthFirstDay = date('Y-m-01');
                $currentMonthLastDay = date('Y-m-t');
                
                $query = $this->db->query("
                    SELECT
                        invoices.company_id AS company_id, 
                        'sales' AS category, 
                        SUM(invoices.grand_total) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status NOT IN ('Draft', '')
                        AND invoices.view_flag = 0
                    AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$currentMonthFirstDay}'
                    AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$currentMonthLastDay}'
                    UNION
                    SELECT
                        jobs.company_id AS company_id, 
                        'jobs_created' AS category, 
                        COUNT(jobs.id) AS total
                    FROM jobs
                    WHERE jobs.company_id = '{$company_id}' 
                        AND jobs.status = 'Scheduled'
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                        jobs.company_id AS company_id, 
                        'jobs_done' AS category, 
                        COUNT(jobs.id) AS total
                    FROM jobs
                    WHERE jobs.company_id = '{$company_id}' 
                        AND jobs.status IN ('Finished', 'Completed')
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                        invoices.company_id AS company_id, 
                        'collected' AS category, 
                        SUM(invoices.grand_total) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status = 'Paid'
                        AND invoices.view_flag = 0
                    AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$currentMonthFirstDay}'
                    AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$currentMonthLastDay}'
                    UNION
                    SELECT
                        jobs.company_id AS company_id, 
                        'jobs_cancelled' AS category, 
                        COUNT(jobs.id) AS total
                    FROM jobs
                    WHERE jobs.company_id = '{$company_id}' 
                        AND jobs.status = 'Cancelled'
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '{$currentMonthFirstDay}'
                    AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '{$currentMonthLastDay}'
                    UNION
                    SELECT
                        tickets.company_id AS company_id, 
                        'service_scheduled' AS category, 
                        COUNT(tickets.id) AS total
                    FROM tickets
                    WHERE tickets.company_id = '{$company_id}' 
                        AND tickets.ticket_status = 'Scheduled'
                    AND DATE_FORMAT(tickets.created_at, '%Y-%m-%d') >= '{$dateFrom}'
                    AND DATE_FORMAT(tickets.created_at, '%Y-%m-%d') <= '{$dateTo}'
                ");
                $data = $query->result();
                return $data;
            break;
            case 'earnings':       
                $overdueDate = date('Y-m-d', strtotime('-14 days'));
                
                $query = $this->db->query("
                    SELECT
                        invoices.company_id AS company_id, 
                        'open_invoices' AS category, 
                        COUNT(invoices.id) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status NOT IN ('Paid', 'Draft', '')
                        AND invoices.view_flag = 0
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                        invoices.company_id AS company_id, 
                        'overdue_invoices' AS category, 
                        COUNT(invoices.id) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status NOT IN ('Paid', 'Draft', '')
                        AND invoices.due_date < '{$overdueDate}'
                        AND invoices.view_flag = 0
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                        invoices.company_id AS company_id, 
                        'paid_invoices' AS category, 
                        SUM(invoices.grand_total) AS total
                    FROM invoices
                    WHERE invoices.company_id = '{$company_id}' 
                        AND invoices.status = 'Paid'
                        AND invoices.view_flag = 0
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                        acs_profile.company_id AS company_id, 
                        'subscription' AS category, 
                        SUM(acs_billing.mmr) AS total
                    FROM acs_profile
                    LEFT JOIN acs_billing ON acs_billing.fk_prof_id = acs_profile.prof_id
                    WHERE acs_profile.company_id = '{$company_id}' 
                        AND acs_profile.status IN ('Active w/RAR', 'Active w/RQR','Active w/RMR', 'Active w/RYR', 'Inactive w/RMM')
                        AND DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') <= '{$dateTo}'
                ");
                $data = $query->result();
                return $data;
            break;
            case 'recurring_service_plans':
                $currentDate = date('Y-m-d');
                $next30Days = date('Y-m-d', strtotime('+30 days'));           
                $firstDayOfThisWeek = date('Y-m-d', strtotime('monday this week'));
                $lastDayOfThisWeek  = date('Y-m-d', strtotime('sunday this week'));

                $query = $this->db->query("
                    SELECT
                        acs_profile.company_id AS company_id,
                        'active_subscribers' AS category, 
                        COUNT(acs_profile.prof_id) AS total
                    FROM acs_profile
                    LEFT JOIN acs_billing ON acs_billing.fk_prof_id = acs_profile.prof_id
                    WHERE acs_profile.company_id = '{$company_id}' 
                        AND acs_profile.status IN ('Active w/RAR', 'Active w/RQR','Active w/RMR', 'Active w/RYR', 'Inactive w/RMM')
                        AND DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') <= '{$dateTo}'
                    UNION
                    SELECT
                        acs_profile.company_id AS company_id,
                        'agreements_expire_30days' AS category, 
                        COUNT(acs_profile.prof_id) AS total
                    FROM acs_profile
                    LEFT JOIN acs_billing ON acs_billing.fk_prof_id = acs_profile.prof_id
                    WHERE acs_profile.company_id = '{$company_id}' 
                        AND acs_profile.status IN ('Active w/RAR', 'Active w/RQR','Active w/RMR', 'Active w/RYR', 'Inactive w/RMM')
                        AND DATE(acs_billing.bill_end_date) BETWEEN '{$currentDate}' AND '{$next30Days}'
                    UNION
                    SELECT
                        acs_profile.company_id AS company_id, 
                        'total_recurring_payment' AS category, 
                        SUM(acs_billing.mmr) AS total
                    FROM acs_profile
                    LEFT JOIN acs_billing ON acs_billing.fk_prof_id = acs_profile.prof_id
                    WHERE acs_profile.company_id = '{$company_id}' 
                        AND acs_profile.status IN ('Active w/RAR', 'Active w/RQR','Active w/RMR', 'Active w/RYR', 'Inactive w/RMM')
                        AND DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') >= '{$dateFrom}'
                        AND DATE_FORMAT(acs_billing.bill_start_date, '%Y-%m-%d') <= '{$dateTo}'
                ");
                $data = $query->result();
                return $data;
            break;
            case 'customer_list':
                $this->db->select('acs_profile.prof_id AS id, acs_profile.company_id AS company_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, CONCAT(acs_profile.city, ", ", acs_profile.state, " ", acs_profile.zip_code) AS address,acs_profile.phone_h AS phone, acs_profile.email AS email, COUNT(invoices.id) AS invoice_records');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('invoices.view_flag', 0);
                $this->db->join('invoices', 'invoices.customer_id = acs_profile.prof_id', 'left');
                $this->db->group_by('acs_profile.prof_id, invoices.customer_id');
                $this->db->order_by('acs_profile.first_name', 'ASC');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'ledger_lookup':
                $query = $this->db->query("
                    SELECT 
                        invoices.id AS invoice_id, 
                        invoices.company_id AS company_id, 
                        jobs.id AS job_id, 
                        invoices.customer_id AS customer_id, 
                        CONCAT(acs_profile.mail_add, ' ', acs_profile.state, ', ', acs_profile.city, ' ', acs_profile.zip_code) AS customer_address,
                        CASE 
                            WHEN invoices.job_id IS NOT NULL AND invoices.job_id != '' THEN CONCAT('Issued job no. ', jobs.job_number) 
                            ELSE CONCAT('Issued invoice no. ', invoices.invoice_number)
                        END AS description,
                        invoices.date_created AS invoice_date, 
                        CASE 
                            WHEN invoices.job_id IS NOT NULL AND invoices.job_id != '' THEN 
                                (SELECT SUM(job_items.total) FROM job_items WHERE job_items.job_id = jobs.id)
                            ELSE invoices.grand_total
                        END AS invoice_total,
                        payment_records.payment_method AS payment_method,
                        SUM(payment_records.invoice_amount) AS payment_amount,
                        MAX(payment_records.date_created) AS payment_date,
                        CONCAT(users.FName, ' ', users.LName) AS entry_by
                    FROM invoices
                    LEFT JOIN payment_records ON payment_records.invoice_id = invoices.id
                    LEFT JOIN users ON users.id = invoices.user_id
                    LEFT JOIN jobs ON jobs.id = invoices.job_id
                    LEFT JOIN acs_profile ON acs_profile.prof_id = invoices.customer_id
                    WHERE invoices.company_id = '{$company_id}'
                    AND invoices.customer_id = {$filter3}
                    AND invoices.view_flag = 0
                    GROUP BY invoices.id
                    ORDER BY invoices.date_created DESC;
                ");
                $data = $query->result();
                return $data;
            break;
            case 'sales_leaderboard':
                $query = $this->db->query("
                    SELECT
                        users.id AS id,
                        users.company_id AS company_id,
                        CONCAT(users.FName, ' ', users.LName) AS sales_rep,
                        COALESCE(invoices.status, '') AS invoice_status,
                        COUNT(jobs.id) AS total_jobs,
                        SUM(invoices.grand_total) AS total_sales,
                        MAX(invoices.date_created) AS date_created
                    FROM users
                    LEFT JOIN jobs ON jobs.employee_id = users.id
                    LEFT JOIN invoices ON invoices.job_id = jobs.id
                    WHERE invoices.view_flag = 0
                    AND invoices.status != 'Draft'
                    AND DATE(invoices.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                    AND users.company_id = '{$company_id}'
                    GROUP BY users.id
                ");
                $data = $query->result();
                return $data;
            break;
            case 'tech_leaderboard':
                $query = $this->db->query("
                    SELECT 
                        company_id,
                        tech_rep_id,
                        tech_rep_name,
                        SUM(job_count) AS job_count,
                        SUM(job_amount) AS job_amount,
                        SUM(ticket_count) AS ticket_count,
                        SUM(ticket_amount) AS ticket_amount,
                        MIN(date_created) AS date_created,
                        MAX(date_updated) AS date_updated
                    FROM (
                        SELECT 
                            jobs.company_id AS company_id,
                            jobs.employee2_id AS tech_rep_id,
                            CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                            COUNT(jobs.id) AS job_count,
                            SUM(invoices.grand_total) AS job_amount,
                            0 AS ticket_count,
                            0 AS ticket_amount,
                            MIN(jobs.date_created) AS date_created,
                            MAX(jobs.date_updated) AS date_updated
                        FROM jobs
                        LEFT JOIN invoices ON invoices.job_id = jobs.id
                        LEFT JOIN users ON users.id = jobs.employee2_id
                        WHERE 
                            jobs.company_id = {$company_id}
                            AND users.company_id = {$company_id}
                            AND jobs.employee2_id != 0
                            AND jobs.status IN ('Approved', 'Finished', 'Invoiced', 'Completed')
                            AND DATE(jobs.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                        GROUP BY jobs.employee2_id
                        UNION ALL
                        SELECT 
                            jobs.company_id AS company_id,
                            jobs.employee3_id AS tech_rep_id,
                            CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                            COUNT(jobs.id) AS job_count,
                            SUM(invoices.grand_total) AS job_amount,
                            0 AS ticket_count,
                            0 AS ticket_amount,
                            MIN(jobs.date_created) AS date_created,
                            MAX(jobs.date_updated) AS date_updated
                        FROM jobs
                        LEFT JOIN invoices ON invoices.job_id = jobs.id
                        LEFT JOIN users ON users.id = jobs.employee3_id
                        WHERE 
                            jobs.company_id = {$company_id}
                            AND users.company_id = {$company_id}
                            AND jobs.employee3_id != 0
                            AND jobs.status IN ('Approved', 'Finished', 'Invoiced', 'Completed')
                            AND DATE(jobs.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                        GROUP BY jobs.employee3_id
                        UNION ALL
                        SELECT 
                            jobs.company_id AS company_id,
                            jobs.employee4_id AS tech_rep_id,
                            CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                            COUNT(jobs.id) AS job_count,
                            SUM(invoices.grand_total) AS job_amount,
                            0 AS ticket_count,
                            0 AS ticket_amount,
                            MIN(jobs.date_created) AS date_created,
                            MAX(jobs.date_updated) AS date_updated
                        FROM jobs
                        LEFT JOIN invoices ON invoices.job_id = jobs.id
                        LEFT JOIN users ON users.id = jobs.employee4_id
                        WHERE 
                            jobs.company_id = {$company_id}
                            AND users.company_id = {$company_id}
                            AND jobs.employee4_id != 0
                            AND jobs.status IN ('Approved', 'Finished', 'Invoiced', 'Completed')
                            AND DATE(jobs.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                        GROUP BY jobs.employee4_id
                        UNION ALL
                        SELECT 
                            jobs.company_id AS company_id,
                            jobs.employee5_id AS tech_rep_id,
                            CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                            COUNT(jobs.id) AS job_count,
                            SUM(invoices.grand_total) AS job_amount,
                            0 AS ticket_count,
                            0 AS ticket_amount,
                            MIN(jobs.date_created) AS date_created,
                            MAX(jobs.date_updated) AS date_updated
                        FROM jobs
                        LEFT JOIN invoices ON invoices.job_id = jobs.id
                        LEFT JOIN users ON users.id = jobs.employee5_id
                        WHERE 
                            jobs.company_id = {$company_id}
                            AND users.company_id = {$company_id}
                            AND jobs.employee5_id != 0
                            AND jobs.status IN ('Approved', 'Finished', 'Invoiced', 'Completed')
                            AND DATE(jobs.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                        GROUP BY jobs.employee5_id
                        UNION ALL
                        SELECT 
                            jobs.company_id AS company_id,
                            jobs.employee6_id AS tech_rep_id,
                            CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                            COUNT(jobs.id) AS job_count,
                            SUM(invoices.grand_total) AS job_amount,
                            0 AS ticket_count,
                            0 AS ticket_amount,
                            MIN(jobs.date_created) AS date_created,
                            MAX(jobs.date_updated) AS date_updated
                        FROM jobs
                        LEFT JOIN invoices ON invoices.job_id = jobs.id
                        LEFT JOIN users ON users.id = jobs.employee6_id
                        WHERE 
                            jobs.company_id = {$company_id}
                            AND users.company_id = {$company_id}
                            AND jobs.employee6_id != 0
                            AND jobs.status IN ('Approved', 'Finished', 'Invoiced', 'Completed')
                            AND DATE(jobs.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                        GROUP BY jobs.employee6_id
                        UNION ALL
                        SELECT 
                            users.company_id AS company_id,
                            users.id AS tech_rep_id,
                            CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                            0 AS job_count,
                            0 AS job_amount,
                            COUNT(tickets.id) AS ticket_count,
                            SUM(tickets.grandtotal) AS ticket_amount,
                            MIN(tickets.created_at) AS date_created,
                            MAX(tickets.updated_at) AS date_updated
                        FROM users
                        LEFT JOIN tickets ON 
                            tickets.technicians LIKE CONCAT('%s:', LENGTH(users.id), ':\"', users.id, '\";%')
                        WHERE 
                            tickets.company_id = {$company_id}
                            AND tickets.ticket_status IN ('Approved', 'Finished', 'Invoiced', 'Completed')
                            AND DATE(tickets.created_at) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                        GROUP BY users.company_id, users.id, users.FName, users.LName

                    ) AS combined_data
                    GROUP BY tech_rep_id
                    ORDER BY ticket_count DESC;
                ");
                $data = $query->result();
                return $data;
            break;
            case 'weekly_subscription_amount':
                $firstDayOfThisWeek = date('Y-m-d', strtotime('monday this week'));
                $lastDayOfThisWeek  = date('Y-m-d', strtotime('sunday this week'));
            
                $query = $this->db->query("
                    SELECT
                        acs_profile.prof_id AS prof_id, 
                        acs_profile.company_id AS company_id, 
                        CONCAT(acs_profile.first_name, ' ', acs_profile.last_name) AS customer,
                        acs_profile.customer_type AS customer_type,
                        acs_profile.created_at AS customer_date_created,
                        'weekly_subscription_amount' AS category, 
                        acs_billing.bill_start_date AS bill_date,
                        acs_billing.mmr AS total, 
                        acs_profile.prof_id AS weekly_subscribers
                    FROM acs_profile
                    LEFT JOIN acs_billing ON acs_billing.fk_prof_id = acs_profile.prof_id
                    WHERE acs_profile.company_id = '{$company_id}' 
                        AND acs_profile.status IN ('Active w/RAR', 'Active w/RQR','Active w/RMR', 'Active w/RYR', 'Inactive w/RMM')
                        AND (
                            DATE(acs_billing.bill_start_date) BETWEEN '{$firstDayOfThisWeek}' AND '{$lastDayOfThisWeek}'
                            OR DATE(acs_profile.created_at) BETWEEN '{$firstDayOfThisWeek}' AND '{$lastDayOfThisWeek}'
                        )
                ");
                $data = $query->result();
                return $data;
            break;
            case 'scorecard_lookup':
                $query = $this->db->query("
                    SELECT 
                        users.id AS employee_id,
                        users.company_id AS company_id, 
                        users.role AS role_id, 
                        users.user_type AS usertype_id, 
                        CONCAT(users.FName, ' ', users.LName) AS employee_name,
                        SUM(point_rating_system.points) AS total_points,
                        SUM(CASE WHEN point_rating_system.module = 'job' THEN 1 ELSE 0 END) AS job_count,
                        SUM(CASE WHEN point_rating_system.module = 'service_ticket' THEN 1 ELSE 0 END) AS ticket_count,
                        -- ROUND((IFNULL(attendance_summary.attendance_count, 0) / DAY(NOW())) * 100, 2) AS attendance_percentage,
                        '100' AS attendance_percentage,
                        '98' AS overall_performance,
                        users.profile_img AS profile_img, 
                        users.created_at AS date_created
                    FROM users
                    LEFT JOIN point_rating_system ON JSON_CONTAINS(point_rating_system.employee_id, JSON_QUOTE(CAST(users.id AS CHAR)))
                    LEFT JOIN (
                        SELECT 
                            user_id, 
                            COUNT(DISTINCT DATE(date_created)) AS attendance_count
                        FROM timesheet_attendance
                        WHERE MONTH(date_created) = MONTH(NOW())
                        AND YEAR(date_created) = YEAR(NOW())
                        GROUP BY user_id
                    ) AS attendance_summary 
                        ON attendance_summary.user_id = users.id
                        AND point_rating_system.company_id = {$company_id}
                        AND point_rating_system.status = 1
                    WHERE users.company_id = {$company_id}
                --        AND DATE(point_rating_system.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                        AND users.id = {$filter3}
                    GROUP BY users.id
                    ORDER BY total_points DESC
                ");
                $data = $query->result();
                return $data;
            break;
            case 'tech_employees':
                $query = $this->db->query("
                    SELECT 
                        users.id AS employee_id,
                        users.company_id AS company_id, 
                        users.role AS role_id, 
                        users.user_type AS usertype_id, 
                        CONCAT(users.FName, ' ', users.LName) AS employee,
                        SUM(point_rating_system.points) AS total_points,
                        users.mobile AS phone_m, 
                        users.email AS email, 
                        users.profile_img AS profile_img, 
                        users.created_at AS date_created
                    FROM users
                    LEFT JOIN point_rating_system ON JSON_CONTAINS(point_rating_system.employee_id, JSON_QUOTE(CAST(users.id AS CHAR)))
                    LEFT JOIN (
                        SELECT 
                            user_id, 
                            COUNT(DISTINCT DATE(date_created)) AS attendance_count
                        FROM timesheet_attendance
                        WHERE MONTH(date_created) = MONTH(NOW())
                        AND YEAR(date_created) = YEAR(NOW())
                        GROUP BY user_id
                    ) AS attendance_summary 
                        ON attendance_summary.user_id = users.id
                        AND point_rating_system.company_id = {$company_id}
                        AND point_rating_system.status = 1
                    WHERE users.company_id = {$company_id}
                --        AND DATE(point_rating_system.date_created) BETWEEN '{$dateFrom}' AND '{$dateTo}'
                    GROUP BY users.id
                    ORDER BY total_points DESC
                ");
                $data = $query->result();
                return $data;
            break;
            case 'payment_methods':
                $this->db->select('payment_records.id AS id,payment_records.company_id AS company_id,payment_records.payment_method AS payment_method,COUNT(payment_records.payment_method) AS total,payment_records.payment_date AS date');
                $this->db->from('payment_records');
                $this->db->where('payment_records.company_id ', $company_id);
                $this->db->where("DATE_FORMAT(payment_records.payment_date, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(payment_records.payment_date, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('payment_records.payment_method');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'customer_states':
                $this->db->select('acs_profile.prof_id AS id, acs_profile.state AS state, COUNT(acs_profile.prof_id) AS total, acs_profile.created_at AS date');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('acs_profile.state !=', "");
                $this->db->where("DATE_FORMAT(acs_profile.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(acs_profile.created_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->group_by('acs_profile.state');
                $query = $this->db->get();
                return $query->result();
            break;
            case 'job_install':
                $this->db->select('jobs.id AS id, jobs.company_id AS company_id, jobs.job_type AS job_type, jobs.tags AS tags, jobs.date_created AS date');
                $this->db->from('jobs');
                $this->db->where('jobs.company_id', $company_id);
                $this->db->where('jobs.job_type =', "Install");
                $this->db->where('jobs.tags !=', "");
                $this->db->where('jobs.status NOT IN ("Draft", "Cancelled")');
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
        }
    }
}
