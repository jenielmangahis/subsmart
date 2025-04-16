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
                $this->db->where('invoices.status != ', "Draft");
                $this->db->where('invoices.status != ', "");
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
                $this->db->where('invoices.status !=', "Paid");
                $this->db->where('invoices.status !=', "Draft");
                $this->db->where('invoices.status !=', "");
                $this->db->where('invoices.view_flag', 0);
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
                $this->db->where('invoices.status !=', "Paid");
                $this->db->where('invoices.status !=', "Draft");
                $this->db->where('invoices.status !=', "");
                $this->db->where('invoices.view_flag', 0);
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
                $this->db->where('invoices.status !=', "Paid");
                $this->db->where('invoices.status !=', "Draft");
                $this->db->where('invoices.status !=', "");
                $this->db->where('invoices.view_flag', 0);
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
                $this->db->where('invoices.status !=', "Paid");
                $this->db->where('invoices.status !=', "Draft");
                $this->db->where('invoices.status !=', "");
                $this->db->where('invoices.view_flag', 0);
                $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-90 days')));
                $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-5 years')));
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(invoices.date_created, '%Y-%m-%d') <=", $dateTo);
                $query = $this->db->get();
                return $query->result();
            break;
            case 'estimates':
                $this->db->select('
                            estimates.id AS id, 
                            estimates.created_at AS date, 
                            estimates.expiry_date AS expiry_date, 
                            estimates.grand_total AS total,
                            COUNT(CASE 
                                    WHEN estimates.expiry_date >= CURDATE() THEN 1
                                    ELSE NULL
                                END) AS total_open,
                            COUNT(CASE 
                                    WHEN estimates.expiry_date < CURDATE() THEN 1
                                    ELSE NULL
                                END) AS total_expired
                        ');
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
                $this->db->select('accounting_vendor_transaction_categories.id AS id, accounting_check.company_id AS company_id, accounting_chart_of_accounts.name AS account_name, account.account_name AS account_type, SUM(accounting_check.total_amount) AS total, accounting_vendor_transaction_categories.created_at AS date');
                $this->db->from('accounting_vendor_transaction_categories');
                $this->db->where('accounting_check.company_id ', $company_id);
                $this->db->where("DATE_FORMAT(accounting_vendor_transaction_categories.created_at, '%Y-%m-%d') >=", $dateFrom);
                $this->db->where("DATE_FORMAT(accounting_vendor_transaction_categories.created_at, '%Y-%m-%d') <=", $dateTo);
                $this->db->join('accounting_chart_of_accounts', 'accounting_chart_of_accounts.id = accounting_vendor_transaction_categories.expense_account_id', 'left');
                $this->db->join('accounting_check', 'accounting_check.id = accounting_vendor_transaction_categories.transaction_id', 'left');
                $this->db->join('account', 'account.id = accounting_chart_of_accounts.account_id', 'left');
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
        }
    }
}