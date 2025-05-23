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

        // Get All Acitve Subscriptions Report data in Database
        if ($reportType == 'active_subscriptions') {
            $this->db->select('acs_profile.prof_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, acs_profile.status AS status, acs_billing.bill_start_date AS bill_start_date, acs_billing.bill_end_date AS bill_end_date, acs_billing.mmr AS mmr');
            $this->db->from('acs_profile');
            $this->db->join('acs_billing', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
            $this->db->where('acs_profile.company_id', $companyID);
            $this->db->where("DATE_FORMAT(acs_billing.bill_start_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(acs_billing.bill_start_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where_in('acs_profile.status', [
                'Active w/RAR',
                'Active w/RMR',
                'Active w/RQR',
                'Active w/RYR',
                'Inactive w/RMM'
            ]);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            switch ($reportConfig['subscription_period']) {
                case 'last_7_days':
                    $startDate = (new DateTime())->modify('-7 days')->format('Y-m-d');
                    $this->db->where('acs_billing.bill_start_date >=', $startDate);
                    break;
                case 'last_14_days':
                    $startDate = (new DateTime())->modify('-14 days')->format('Y-m-d');
                    $this->db->where('acs_billing.bill_start_date >=', $startDate);
                    break;
                case 'last_30_days':
                    $startDate = (new DateTime())->modify('-30 days')->format('Y-m-d');
                    $this->db->where('acs_billing.bill_start_date >=', $startDate);
                    break;
                case 'last_60_days':
                    $startDate = (new DateTime())->modify('-60 days')->format('Y-m-d');
                    $this->db->where('acs_billing.bill_start_date >=', $startDate);
                    break;
            }
            
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Earned data for Today's Widget Report in Database
        if ($reportType == 'earned') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id,invoices.invoice_number AS number, invoices.job_name AS description, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status', "Paid");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Invoice Amount data for Today's Widget Report in Database
        if ($reportType == 'invoice_amount') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id,invoices.invoice_number AS number, invoices.job_name AS description, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

         // Get Jobs Completed data for Today's Widget Report in Database
         if ($reportType == 'jobs_completed') {
            $this->db->select('id, company_id, number, type, description, customer, status, date');
            $this->db->from('jobs_completed_view');
            $this->db->where_in('status', [
                'Finished',
                'Completed',
            ]);
            $this->db->where('company_id', $companyID);
            $this->db->where("DATE_FORMAT(date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get New Jobs data for Today's Widget Report in Database
        if ($reportType == 'new_jobs') {
            $this->db->select('jobs.id AS id,jobs.company_id AS company_id,jobs.job_number AS number,jobs.job_type AS type,jobs.job_description AS description,CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer,jobs.status AS status, jobs.date_issued AS date, jobs.date_created AS date_created');
            $this->db->from('jobs');
            $this->db->where('jobs.status', "Scheduled");
            $this->db->where('jobs.company_id', $companyID);
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Lost Accounts data for Today's Widget Report in Database
        if ($reportType == 'lost_accounts') {
            $this->db->select('acs_profile.prof_id AS id,acs_profile.company_id AS company_id,CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer,acs_profile.customer_type AS customer_type,acs_profile.status AS status,acs_profile.email AS email,acs_profile.phone_h AS phone,acs_profile.phone_m AS mobile,acs_office.cancel_date AS cancel_date,acs_office.cancel_reason AS cancel_reason, acs_profile.updated_at AS updated_at');
            $this->db->from('acs_profile');
            $this->db->where('acs_profile.status', "Cancelled");
            $this->db->where('acs_profile.company_id', $companyID);
            $this->db->where("DATE_FORMAT(acs_profile.updated_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(acs_profile.updated_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Service Projective Income data for Today's Widget Report in Database
        if ($reportType == 'service_projective_income') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status !=', "Paid");
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "Paid");
            $this->db->where('invoices.status !=', "");
            $this->db->where('invoices.view_flag', 0);
            // $this->db->where('invoices.date_created >=', date('Y-m-d'));.
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Customer Groups data in Database
        if ($reportType == 'customer_groups') {
            $this->db->select('customer_groups.id AS id, customer_groups.company_id AS company_id, customer_groups.title AS title_group, COUNT(acs_profile.customer_group_id) AS customer_count, CONCAT(users.FName, " ", users.LName) AS added_by, customer_groups.date_added AS date ');
            $this->db->from('customer_groups');
            $this->db->where('customer_groups.company_id', $companyID);
            $this->db->where("DATE_FORMAT(acs_profile.updated_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(acs_profile.updated_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");

            switch ($reportConfig['status_filter']) {
                case 'active_customer_group':
                    $this->db->where_in('acs_profile.status', [
                        'Active w/RAR',
                        'Active w/RMR',
                        'Active w/RQR',
                        'Active w/RYR',
                        'Inactive w/RMM'
                    ]);
                    break;
                case 'all_customer_group':
                    // Do nothing...
                    break;
            }

            // switch ($reportConfig['subscription_period']) {
            //     case 'last_7_days':
            //         $startDate = (new DateTime())->modify('-7 days')->format('Y-m-d');
            //         $this->db->where('acs_profile.updated_at >=', $startDate);
            //         break;
            //     case 'last_14_days':
            //         $startDate = (new DateTime())->modify('-14 days')->format('Y-m-d');
            //         $this->db->where('acs_profile.updated_at >=', $startDate);
            //         break;
            //     case 'last_30_days':
            //         $startDate = (new DateTime())->modify('-30 days')->format('Y-m-d');
            //         $this->db->where('acs_profile.updated_at >=', $startDate);
            //         break;
            //     case 'last_60_days':
            //         $startDate = (new DateTime())->modify('-60 days')->format('Y-m-d');
            //         $this->db->where('acs_profile.updated_at >=', $startDate);
            //         break;
            // }

            $this->db->join('users', 'users.id = customer_groups.user_id', 'left');
            $this->db->join('acs_profile', 'acs_profile.customer_group_id = customer_groups.id', 'left');
            $this->db->group_by('customer_groups.id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }
    
        // Get Job Status data in Database
        if ($reportType == 'job_status') {
            $this->db->select('jobs.id AS id, jobs.company_id AS company_id, jobs.job_number AS number, jobs.job_description AS description, jobs.status AS status, jobs.date_created AS date');
            $this->db->from('jobs');
            $this->db->where('jobs.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");

            if (!empty($reportConfig['status_filter'])) {
                $this->db->where('jobs.status', $reportConfig['status_filter']);
            }
            
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Estimates data in Database
        if ($reportType == 'estimates') {
            $this->db->select('estimates.id AS id, estimates.company_id AS company_id, estimates.estimate_number AS number, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, estimates.job_name AS job, estimates.job_location AS location, estimates.status AS status, estimates.created_at AS date, estimates.grand_total AS total');
            $this->db->from('estimates');
            $this->db->where('estimates.company_id', $companyID);
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");

            if (!empty($reportConfig['status_filter'])) {
                $this->db->where('estimates.status', $reportConfig['status_filter']);
            }

            $this->db->join('acs_profile', 'acs_profile.prof_id = estimates.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Job Tags data in Database
        if ($reportType == 'job_tags') {
            $this->db->select('job_tags.id AS id, job_tags.company_id AS company_id, job_tags.name AS tag, COUNT(jobs.tags) AS job_count, job_tags.created_at AS date');
            $this->db->from('job_tags');
            $this->db->where('job_tags.company_id', $companyID);
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('jobs', 'jobs.tags = job_tags.name', 'left');
            $this->db->group_by('job_tags.name');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Lead Source data in Database
        if ($reportType == 'lead_source') {
            $this->db->select('ac_leadsource.ls_id AS id, ac_leadsource.fk_company_id AS company_id, ac_leadsource.ls_name AS lead_source, ac_leadsource.date_created AS date');
            $this->db->from('ac_leadsource');
            $this->db->where('ac_leadsource.fk_company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }
        
        // Get Paid Invoices data in Database
        if ($reportType == 'paid_invoices') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status', "Paid");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Open Invoices data in Database
        if ($reportType == 'open_invoices') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status !=', "Paid");
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Past Due Invoices data in Database
        if ($reportType == 'past_due_invoices') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status !=', "Paid");
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "");
            $this->db->where('invoices.due_date < CURDATE()');
            $this->db->where('invoices.view_flag', 0);
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");

            // switch ($reportConfig['subscription_period']) {
            //     case 'last_7_days':
            //         $startDate = (new DateTime())->modify('-7 days')->format('Y-m-d');
            //         $this->db->where('invoices.date_created >=', $startDate);
            //         break;
            //     case 'last_14_days':
            //         $startDate = (new DateTime())->modify('-14 days')->format('Y-m-d');
            //         $this->db->where('invoices.date_created >=', $startDate);
            //         break;
            //     case 'last_30_days':
            //         $startDate = (new DateTime())->modify('-30 days')->format('Y-m-d');
            //         $this->db->where('invoices.date_created >=', $startDate);
            //         break;
            //     case 'last_60_days':
            //         $startDate = (new DateTime())->modify('-60 days')->format('Y-m-d');
            //         $this->db->where('invoices.date_created >=', $startDate);
            //         break;
            // }

            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Overdue Invoices data in Database
        if ($reportType == 'overdue_invoices') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status !=', "Paid");
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-14 days')));
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Unpaid Invoices data in Database
        if ($reportType == 'unpaid_invoices') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status !=', "Paid");
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-90 days')));
            $this->db->where('invoices.due_date <=', date('Y-m-d'));            
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }
  
        // Get Collections data in Database
        if ($reportType == 'collections') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id, invoices.invoice_number AS number, invoices.job_name AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created, invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.status !=', "Paid");
            $this->db->where('invoices.status !=', "Draft");
            $this->db->where('invoices.status !=', "");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-90 days')));
            $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-5 years')));
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Taskhub data in Database
        if ($reportType == 'taskhub') {
            $this->db->select('tasks.task_id AS id, tasks.company_id AS company_id, tasks.title AS task, tasks.status AS status, tasks.priority AS priority, tasks.date_due AS date_due, tasks.date_created AS date_created');
            $this->db->from('tasks');
            $this->db->where('tasks.company_id', $companyID);
            $this->db->where("DATE_FORMAT(tasks.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(tasks.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Open Estimates data in Database
        if ($reportType == 'open_estimates') {
            $this->db->select('estimates.id AS id, estimates.company_id AS company_id, estimates.estimate_number AS number, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, estimates.job_name AS job, estimates.job_location AS location, estimates.status AS status, estimates.created_at AS date_created, estimates.grand_total AS total');
            $this->db->from('estimates');
            $this->db->where('estimates.status !=', "Draft");
            $this->db->where('estimates.status !=', "Pending");
            $this->db->where('estimates.view_flag', 0);
            $this->db->where('estimates.company_id', $companyID);
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(estimates.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('acs_profile', 'acs_profile.prof_id = estimates.customer_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

         // Get Timesheet data in Database
         if ($reportType == 'timesheet') {
            $this->db->select('timesheet_attendance.id AS id, users.company_id AS company_id, CONCAT(users.FName, " ", users.LName) AS employee, timesheet_attendance.shift_duration AS shift_duration, timesheet_attendance.break_duration AS break_duration, timesheet_attendance.overtime AS overtime_duration, timesheet_attendance.overtime_status AS overtime_status, timesheet_attendance.date_created AS date_created');
            $this->db->from('timesheet_attendance');
            $this->db->where('users.company_id', $companyID);
            $this->db->where("DATE_FORMAT(timesheet_attendance.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(timesheet_attendance.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('users', 'users.id = timesheet_attendance.user_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Recent Leads data in Database
        if ($reportType == 'recent_leads') {
            $this->db->select('ac_leads.leads_id AS id, ac_leads.company_id AS company_id, CONCAT(ac_leads.firstname, " ", ac_leads.lastname) AS lead, ac_leadtypes.lead_name AS lead_type, ac_leads.status AS status, ac_leads.date_created AS date_created');
            $this->db->from('ac_leads');
            $this->db->where('ac_leads.company_id', $companyID);
            $this->db->where("DATE_FORMAT(ac_leads.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(ac_leads.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('ac_leadtypes', 'ac_leadtypes.lead_id = ac_leads.fk_lead_type_id', 'left');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Customer Status data in Database
        if ($reportType == 'customer_status') {
            $this->db->select('acs_profile.prof_id AS id, acs_profile.company_id AS company_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, acs_profile.customer_type AS customer_type, acs_profile.status AS status, acs_profile.updated_at AS updated_at');
            $this->db->from('acs_profile');
            $this->db->where('acs_profile.company_id', $companyID);
            $this->db->where('acs_profile.status != ', "");
            // $this->db->where("DATE_FORMAT(acs_profile.updated_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            // $this->db->where("DATE_FORMAT(acs_profile.updated_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");

            if (!empty($reportConfig['status_filter'])) {
                $this->db->where('acs_profile.status', $reportConfig['status_filter']);
            }

            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Service Tickets data in Database
        if ($reportType == 'service_tickets') {
            $this->db->select('id, company_id, number, tag, service_type, status, customer, date_created, total');
            $this->db->from('service_tickets_view');
            $this->db->where('company_id', $companyID);
            $this->db->where("DATE_FORMAT(date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");

            if (!empty($reportConfig['status_filter'])) {
                $this->db->where('status', $reportConfig['status_filter']);
            }

            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Bank Accounts data in Database
        if ($reportType == 'bank_accounts') {
            $this->db->select('accounting_check.id AS id, accounting_check.company_id AS company_id, accounting_check.check_no AS number, accounting_check.payee_type AS payee_type, accounting_check.payment_date AS payment_date, accounting_check.created_at AS date_created, accounting_check.total_amount AS total');
            $this->db->from('accounting_check');
            $this->db->where('accounting_check.company_id', $companyID);
            $this->db->where("DATE_FORMAT(accounting_check.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_check.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Sales Leaderboard data in Database
        if ($reportType == 'sales_leaderboard') {
            $this->db->select('users.id AS id, users.company_id AS company_id, CONCAT(users.FName, " ", users.LName) AS sales_rep, COALESCE(invoices.status, "") AS invoice_status, COUNT(jobs.id) AS total_jobs, SUM(invoices.grand_total) AS total_sales, invoices.date_created AS date_created');
            $this->db->from('users');
            $this->db->where('users.company_id', $companyID);
            $this->db->where('invoices.status !=', 'Draft');
            $this->db->where('invoices.view_flag', 0);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->join('jobs', 'jobs.employee_id = users.id', 'left');
            $this->db->join('invoices', 'invoices.job_id = jobs.id', 'left');
            $this->db->group_by('users.id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Tech Leaderboard data in Database
        if ($reportType == 'tech_leaderboard') {

            $query = $this->db->query("
                SELECT 
                    jobs.company_id AS company_id,
                    jobs.employee2_id AS tech_rep_id,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                    COUNT(jobs.id) AS job_count,
                    SUM(invoices.grand_total) AS job_amount,
                    '' AS ticket_count,
                    '' AS ticket_amount,
                    jobs.date_created AS date_created,
                    jobs.date_updated AS date_updated
                FROM 
                    jobs
                LEFT JOIN invoices ON invoices.job_id = jobs.id
                LEFT JOIN users ON users.id = jobs.employee2_id
                WHERE 
                    jobs.company_id = $companyID
                AND jobs.employee2_id != 0
                AND (jobs.status = 'Approved' OR jobs.status = 'Finished' OR jobs.status = 'Invoiced' OR jobs.status = 'Completed')
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '$reportConfig[date_from]'
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '$reportConfig[date_to]'
                GROUP BY jobs.employee2_id
                UNION
                SELECT 
                    jobs.company_id AS company_id,
                    jobs.employee3_id AS tech_rep_id,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                    COUNT(jobs.id) AS job_count,
                    SUM(invoices.grand_total) AS job_amount,
                    '' AS ticket_count,
                    '' AS ticket_amount,
                    jobs.date_created AS date_created,
                    jobs.date_updated AS date_updated
                FROM 
                    jobs
                LEFT JOIN invoices ON invoices.job_id = jobs.id
                LEFT JOIN users ON users.id = jobs.employee3_id
                WHERE 
                    jobs.company_id = $companyID
                AND jobs.employee3_id != 0
                AND (jobs.status = 'Approved' OR jobs.status = 'Finished' OR jobs.status = 'Invoiced' OR jobs.status = 'Completed')
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '$reportConfig[date_from]'
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '$reportConfig[date_to]'
                GROUP BY jobs.employee3_id
                UNION
                SELECT 
                    jobs.company_id AS company_id,
                    jobs.employee4_id AS tech_rep_id,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                    COUNT(jobs.id) AS job_count,
                    SUM(invoices.grand_total) AS job_amount,
                    '' AS ticket_count,
                    '' AS ticket_amount,
                    jobs.date_created AS date_created,
                    jobs.date_updated AS date_updated
                FROM 
                    jobs
                LEFT JOIN invoices ON invoices.job_id = jobs.id
                LEFT JOIN users ON users.id = jobs.employee4_id
                WHERE 
                    jobs.company_id = $companyID
                AND jobs.employee4_id != 0
                AND (jobs.status = 'Approved' OR jobs.status = 'Finished' OR jobs.status = 'Invoiced' OR jobs.status = 'Completed')
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '$reportConfig[date_from]'
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '$reportConfig[date_to]'
                GROUP BY jobs.employee4_id
                UNION
                SELECT 
                    jobs.company_id AS company_id,
                    jobs.employee5_id AS tech_rep_id,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                    COUNT(jobs.id) AS job_count,
                    SUM(invoices.grand_total) AS job_amount,
                    '' AS ticket_count,
                    '' AS ticket_amount,
                    jobs.date_created AS date_created,
                    jobs.date_updated AS date_updated
                FROM 
                    jobs
                LEFT JOIN invoices ON invoices.job_id = jobs.id
                LEFT JOIN users ON users.id = jobs.employee5_id
                WHERE 
                    jobs.company_id = $companyID
                AND jobs.employee5_id != 0
                AND (jobs.status = 'Approved' OR jobs.status = 'Finished' OR jobs.status = 'Invoiced' OR jobs.status = 'Completed')
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '$reportConfig[date_from]'
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '$reportConfig[date_to]'
                GROUP BY jobs.employee5_id
                UNION
                SELECT 
                    jobs.company_id AS company_id,
                    jobs.employee6_id AS tech_rep_id,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                    COUNT(jobs.id) AS job_count,
                    SUM(invoices.grand_total) AS job_amount,
                    '' AS ticket_count,
                    '' AS ticket_amount,
                    jobs.date_created AS date_created,
                    jobs.date_updated AS date_updated
                FROM 
                    jobs
                LEFT JOIN invoices ON invoices.job_id = jobs.id
                LEFT JOIN users ON users.id = jobs.employee6_id
                WHERE 
                    jobs.company_id = $companyID
                AND jobs.employee6_id != 0
                AND (jobs.status = 'Approved' OR jobs.status = 'Finished' OR jobs.status = 'Invoiced' OR jobs.status = 'Completed')
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') >= '$reportConfig[date_from]'
                AND DATE_FORMAT(jobs.date_created, '%Y-%m-%d') <= '$reportConfig[date_to]'
                GROUP BY jobs.employee6_id
                UNION
                SELECT 
                    users.company_id AS company_id,
                    users.id AS tech_rep_id,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep_name,
                    '' AS job_count,
                    '' AS job_amount,
                    COUNT(tickets.id) AS ticket_count,
                    SUM(tickets.grandtotal) AS ticket_amount,
                    MIN(tickets.created_at) AS date_created,
                    MAX(tickets.updated_at) AS date_updated
                FROM users
                LEFT JOIN tickets ON 
                    tickets.technicians LIKE CONCAT('%s:', LENGTH(users.id), ':\"', users.id, '\";%')
                WHERE 
                    tickets.company_id = $companyID
                    AND (tickets.ticket_status = 'Approved' OR tickets.ticket_status = 'Finished' OR tickets.ticket_status = 'Invoiced' OR tickets.ticket_status = 'Completed')
                    AND DATE_FORMAT(tickets.created_at, '%Y-%m-%d') >= '$reportConfig[date_from]'
                    AND DATE_FORMAT(tickets.created_at, '%Y-%m-%d') <= '$reportConfig[date_to]'
                GROUP BY 
                    users.company_id, users.id, users.FName, users.LName
            ");

            $data = $query->result();
            $arrayStdObject = array();
            $aggregatedData = array();

            foreach ($data as $record) {
                $key = $record->tech_rep_id;

                if (!isset($aggregatedData[$key])) {
                    $aggregatedData[$key] = (object) [
                        'id' => $record->id, 
                        'company_id' => $record->company_id,
                        'tech_rep_id' => $record->tech_rep_id,
                        'tech_rep_name' => $record->tech_rep_name,
                        'job_count' => $record->job_count,
                        'job_amount' => $record->job_amount,
                        'ticket_count' => $record->ticket_count,
                        'ticket_amount' => $record->ticket_amount,
                        'date_created' => $record->date_created,
                        'date_updated' => $record->date_updated,
                    ];
                } else {
                    $aggregatedData[$key]->job_count += $record->job_count;
                    $aggregatedData[$key]->job_amount += $record->job_amount;
                    $aggregatedData[$key]->ticket_count += $record->ticket_count;
                    $aggregatedData[$key]->ticket_amount += $record->ticket_amount;

                    $aggregatedData[$key]->date_updated = max($aggregatedData[$key]->date_updated, $record->date_updated);
                }
            }

            $arrayStdObject = array_values($aggregatedData);

            usort($arrayStdObject, function($a, $b) use ($reportConfig) {
                $sortBy = $reportConfig['sort_by'];
                $sortOrder = $reportConfig['sort_order'] == 'DESC' ? -1 : 1;

                if ($a->$sortBy == $b->$sortBy) {
                    return 0;
                }
                return ($a->$sortBy < $b->$sortBy ? -1 : 1) * $sortOrder;
            });

            return $arrayStdObject;
        }
        
        if ($reportType == 'employee_performance_rating') {
            $this->db->select('
                point_rating_system.id AS id, 
                point_rating_system.company_id AS company_id, 
                point_rating_system.employee_type AS employee_type, 
                point_rating_system.employee_id AS employee_id, 
                point_rating_system.module AS module, 
                point_rating_system.module_id AS module_id, 
                point_rating_system.points AS points, 
                invoices_a.grand_total AS job_amount,
                invoices_b.grand_total AS ticket_amount,
                point_rating_system.status AS status, 
                point_rating_system.date_created AS date_created,
                point_rating_system.date_updated AS date_updated
            ');
            $this->db->from('point_rating_system');
            $this->db->where('point_rating_system.company_id', $companyID);
            $this->db->where('point_rating_system.status', 1);
            $this->db->join('invoices AS invoices_a', 'invoices_a.job_id = point_rating_system.module_id', 'left');
            $this->db->join('invoices AS invoices_b', 'invoices_b.ticket_id = point_rating_system.module_id', 'left');
            $this->db->where("DATE_FORMAT(point_rating_system.date_created,'%Y-%m-%d') >= '{$reportConfig['date_from']}'");
            $this->db->where("DATE_FORMAT(point_rating_system.date_created,'%Y-%m-%d') <= '{$reportConfig['date_to']}'");
            $query = $this->db->get();
            $prs_data = $query->result();
        
            $this->db->select('
                users.id AS id,
                CONCAT(users.FName, " ", users.LName) AS employee_name
            ');
            $this->db->from('users');
            $this->db->where('users.company_id', $companyID);
            $query = $this->db->get();
            $employee_data = $query->result();
        
            // Map employee IDs to names
            $employee_map = [];
            foreach ($employee_data as $employee) {
                $employee_map[$employee->id] = $employee->employee_name;
            }
        
            // Process data into individual records
            $processed_data = [];
            foreach ($prs_data as $entry) {
                $employee_ids = json_decode($entry->employee_id, true);
                if (is_array($employee_ids)) {
                    foreach ($employee_ids as $employee_id) {
                        if (isset($employee_map[$employee_id])) {
                            $processed_data[] = (object)[
                                'id' => $entry->id,
                                'company_id' => $entry->company_id,
                                'employee_id' => $employee_id,
                                'employee_name' => $employee_map[$employee_id],
                                'employee_type' => $entry->employee_type,
                                'module' => $entry->module,
                                'module_id' => $entry->module_id,
                                'points' => $entry->points,
                                'job_amount' => $entry->module === 'job' ? $entry->job_amount : 0,
                                'ticket_amount' => $entry->module === 'service_ticket' ? $entry->ticket_amount : 0,
                            ];
                        }
                    }
                }
            }
        
            // Aggregate data by employee
            $prs_processed_data = [];
            foreach ($processed_data as $entry) {
                $key = $entry->employee_id;
                if (!isset($prs_processed_data[$key])) {
                    $prs_processed_data[$key] = (object)[
                        'id' => $entry->id,
                        'company_id' => $entry->company_id,
                        'employee_id' => $entry->employee_id,
                        'employee_name' => $entry->employee_name,
                        'employee_type' => $entry->employee_type,
                        'job_count' => 0,
                        'job_amount' => 0,
                        'ticket_count' => 0,
                        'ticket_amount' => 0,
                        'total_points' => 0,
                        'distinct_jobs' => [],
                        'distinct_tickets' => [],
                    ];
                }
        
                $prs_processed_data[$key]->total_points += $entry->points;
        
                if ($entry->module === 'job') {
                    if (!in_array($entry->module_id, $prs_processed_data[$key]->distinct_jobs)) {
                        $prs_processed_data[$key]->job_count++;
                        $prs_processed_data[$key]->distinct_jobs[] = $entry->module_id;
                    }
                    $prs_processed_data[$key]->job_amount += $entry->job_amount;
                }
        
                if ($entry->module === 'service_ticket') {
                    if (!in_array($entry->module_id, $prs_processed_data[$key]->distinct_tickets)) {
                        $prs_processed_data[$key]->ticket_count++;
                        $prs_processed_data[$key]->distinct_tickets[] = $entry->module_id;
                    }
                    $prs_processed_data[$key]->ticket_amount += $entry->ticket_amount;
                }
            }
        
            foreach ($prs_processed_data as &$entry) {
                unset($entry->distinct_jobs);
                unset($entry->distinct_tickets);
            }
        
            // Apply sorting
            $sort_by = $reportConfig['sort_by'];
            $sort_order = strtolower($reportConfig['sort_order']) === 'asc' ? SORT_ASC : SORT_DESC;
        
            if (!empty($prs_processed_data)) {
                usort($prs_processed_data, function ($a, $b) use ($sort_by, $sort_order) {
                    if (!property_exists($a, $sort_by) || !property_exists($b, $sort_by)) {
                        return 0; // Skip sorting if the property doesn't exist
                    }
                    if ($sort_order === SORT_ASC) {
                        return $a->$sort_by <=> $b->$sort_by; // Numeric and string safe
                    } else {
                        return $b->$sort_by <=> $a->$sort_by;
                    }
                });
            }
        
            return $prs_processed_data;
        }
        
        // Get Recent Customers data in Database
        if ($reportType == 'recent_customers') {
            $this->db->select('acs_profile.prof_id AS id, acs_profile.company_id AS company_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, acs_profile.customer_type AS customer_type, acs_profile.status AS status, acs_profile.email AS email, acs_profile.phone_h AS phone, acs_profile.phone_m AS mobile, acs_profile.created_at AS date_created');
            $this->db->from('acs_profile');
            $this->db->where('acs_profile.company_id', $companyID);
            $this->db->where("DATE_FORMAT(acs_profile.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(acs_profile.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->order_by('acs_profile.created_at', 'DESC');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit(10);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Job Activies data in Database
        if ($reportType == 'job_activities') {
            $this->db->select('jobs.id AS id, jobs.company_id AS company_id, jobs.job_number AS number, jobs.job_type AS type, jobs.job_description AS description, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, jobs.status AS status, jobs.date_created AS date_created, SUM(job_items.cost) AS job_amount');
            $this->db->from('jobs');
            $this->db->where('jobs.company_id', $companyID);

            if (!empty($reportConfig['status_filter'])) {
                $this->db->where('jobs.status', $reportConfig['status_filter']);
            }

            $this->db->join('job_items', 'job_items.job_id = jobs.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(jobs.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->group_by('jobs.id');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }

        // Get Sales data in Database
        if ($reportType == 'sales') {
            $this->db->select('invoices.id AS id, invoices.company_id AS company_id,invoices.invoice_number AS number, invoices.job_name AS description, invoices.status AS status, invoices.due_date AS due_date, invoices.date_created AS date_created,  invoices.grand_total AS total');
            $this->db->from('invoices');
            $this->db->where('invoices.company_id', $companyID);
            $this->db->where('invoices.status != ', "Draft");
            $this->db->where('invoices.status != ', "");
            $this->db->where('invoices.view_flag', 0);
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");

            $today = new DateTime();
            switch ($reportConfig['filter_by']) {
                case 'current_month':
                    $startDate = $today->format('Y-m-01');
                    $endDate = $today->format('Y-m-t');
                    $this->db->where('invoices.date_created >=', $startDate);
                    $this->db->where('invoices.date_created <=', $endDate);
                    break;

                case 'current_year':
                    $startDate = $today->format('Y-01-01');
                    $endDate = $today->format('Y-12-31');
                    $this->db->where('invoices.date_created >=', $startDate);
                    $this->db->where('invoices.date_created <=', $endDate);
                    break;

                case 'current_quarter':
                    $month = (int)$today->format('m');
                    $year = $today->format('Y');
                    $quarterStartMonth = floor(($month - 1) / 3) * 3 + 1;
                    $startDate = (new DateTime("$year-$quarterStartMonth-01"))->format('Y-m-d');
                    $endDate = (new DateTime("$year-$quarterStartMonth-01"))->modify('+2 months')->format('Y-m-t');
                    $this->db->where('invoices.date_created >=', $startDate);
                    $this->db->where('invoices.date_created <=', $endDate);
                    break;

                case 'current_week':
                    $startDate = (new DateTime())->modify('monday this week')->format('Y-m-d');
                    $endDate = (new DateTime())->modify('sunday this week')->format('Y-m-d');
                    $this->db->where('invoices.date_created >=', $startDate);
                    $this->db->where('invoices.date_created <=', $endDate);
                    break;

                case 'current_day':
                    $startDate = $today->format('Y-m-d');
                    $this->db->where('invoices.date_created >=', $startDate);
                    $this->db->where('invoices.date_created <', $today->modify('+1 day')->format('Y-m-d'));
                    break;

                default:
                    $monthMapping = [
                        'jan' => 1, 'feb' => 2, 'mar' => 3, 'apr' => 4,
                        'may' => 5, 'jun' => 6, 'jul' => 7, 'aug' => 8,
                        'sep' => 9, 'oct' => 10, 'nov' => 11, 'dec' => 12,
                    ];

                    if (isset($monthMapping[$reportConfig['filter_by']])) {
                        $month = $monthMapping[$reportConfig['filter_by']];
                        $year = $today->format('Y');
                        $startDate = (new DateTime("$year-$month-01"))->format('Y-m-d');
                        $endDate = (new DateTime("$year-$month-01"))->format('Y-m-t');
                        $this->db->where('invoices.date_created >=', $startDate);
                        $this->db->where('invoices.date_created <=', $endDate);
                    }
                    break;
            }


            if (!empty($reportConfig['status_filter'])) {
                $this->db->where('invoices.status', $reportConfig['status_filter']);
            }

            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();
            return $data->result();
        }




        // Get Sales Tax Liability Report data in Database
        if ($reportType == 'sales_tax_liability') {
        }

        // Get Customer Contact List Report data in Database
        if ($reportType == 'customer_contact_list') {
            $this->db->select('prof_id, CONCAT(first_name  , " ", last_name) AS customer, phone_h AS phoneNumber, email, CONCAT(mail_add, " ", city, ", ", state, " ", zip_code) AS billingAddress, CONCAT(mail_add, " ", city, ", ", state, " ", zip_code) AS shippingAddress');
            $this->db->from('acs_profile');
            $this->db->where('company_id', $companyID);
            $this->db->where("DATE_FORMAT(acs_profile.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(acs_profile.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
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

        if ($reportType == 'profit_and_loss_by_customer_list') {
            $this->db->select('invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer');
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

        if ($reportType == 'customer_demographics_list') {
            $this->db->select('*');
            $this->db->from('customer_sources');
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('company_id', $companyID);
            $this->db->group_by('title');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'percent_sales_commission_list') {
            $this->db->select(' CONCAT(users.FName  , " ", users.LName) AS employee_name, accounting_payroll_employees.employee_commission AS comission_amount, accounting_payroll.* ');
            $this->db->from('users');
            $this->db->join('accounting_payroll_employees', 'accounting_payroll_employees.employee_id = users.id', 'left');
            $this->db->join('accounting_payroll', 'accounting_payroll.id = accounting_payroll_employees.payroll_id', 'left');
            $this->db->where("DATE_FORMAT(accounting_payroll.pay_period_start,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_payroll.pay_period_end,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('users.company_id', $companyID);
            // $this->db->group_by('title');
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
            $this->db->select('users.id AS user_id, CONCAT(users.FName, " ", users.LName) AS name');
            $this->db->from('users');
            $this->db->join('accounting_deductions_and_contributions', 'accounting_deductions_and_contributions.employee_id = users.id', 'left');
            $this->db->where('users.FName !=', '');
            $this->db->where('users.LName !=', '');
            $this->db->where("DATE_FORMAT(accounting_deductions_and_contributions.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_deductions_and_contributions.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_deductions_and_contributions.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_deductions_and_contributions.employee_id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'state_mandated_retirement_plans') {
            $this->db->select('users.id AS user_id, CONCAT(users.FName, " ", users.LName) AS name');
            $this->db->from('users');
            $this->db->join('accounting_deductions_and_contributions', 'accounting_deductions_and_contributions.employee_id = users.id', 'left');
            $this->db->join('accounting_payroll_employees', 'users.id = accounting_payroll_employees.employee_id', 'left');
            $this->db->join('accounting_payroll', 'accounting_payroll.id = accounting_payroll_employees.payroll_id', 'left');
            $this->db->where('users.FName !=', '');
            $this->db->where('users.LName !=', '');
            $this->db->where("pay_period_start >= '$reportConfig[date_from]'");
            $this->db->where("pay_period_end <= '$reportConfig[date_to]'");
            $this->db->where('users.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('users.id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'retirements_detail') {
            $this->db->select('users.id AS user_id, CONCAT(users.FName, " ", users.LName) AS name');
            $this->db->from('users');
            $this->db->join('accounting_deductions_and_contributions', 'accounting_deductions_and_contributions.employee_id = users.id', 'left');
            $this->db->where('users.FName !=', '');
            $this->db->where('users.LName !=', '');
            $this->db->where("DATE_FORMAT(accounting_deductions_and_contributions.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_deductions_and_contributions.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_deductions_and_contributions.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('accounting_deductions_and_contributions.employee_id');
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

        if ($reportType == 'open_purchase_order_details') {
            $this->db->select('CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer_name , accounting_purchase_order.*, acs_profile.prof_id');
            $this->db->from('accounting_purchase_order');
            $this->db->join('accounting_vendors', 'accounting_vendors.id = accounting_purchase_order.vendor_id', 'left');
            $this->db->join('accounting_vendor_transaction_categories', 'accounting_vendor_transaction_categories.transaction_id = accounting_purchase_order.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = accounting_vendor_transaction_categories.customer_id', 'left');
            $this->db->join('accounting_vendor_transaction_items', 'accounting_vendor_transaction_items.transaction_id = accounting_purchase_order.id', 'left');
            $this->db->join('items', 'items.id = accounting_vendor_transaction_items.item_id', 'left');
            $this->db->where('accounting_vendor_transaction_categories.transaction_type =', 'Purchase Order');
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(accounting_purchase_order.purchase_order_date,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_purchase_order.purchase_order_date,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_purchase_order.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('acs_profile.prof_id');
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'activities_payroll_by_employee') {
            $this->db->select('users.id AS employee_id, CONCAT(users.FName, " ", users.LName) AS employee, CONCAT(DATE_FORMAT(accounting_payroll.pay_period_start, "%m/%d/%Y"), " — ", DATE_FORMAT(accounting_payroll.pay_period_end, "%m/%d/%Y")) AS pay_period, accounting_payroll_employees.employee_total_pay AS gross_pay, accounting_payroll_employees.employee_commission AS commission, accounting_payroll_employees.employee_bonus AS bonus, accounting_payroll_employees.employee_taxes AS taxes, accounting_payroll_employees.employee_net_pay AS net_pay');
            $this->db->from('accounting_payroll_employees');
            $this->db->join('users', 'users.id = accounting_payroll_employees.employee_id', 'left');
            $this->db->join('accounting_payroll', 'accounting_payroll.id = accounting_payroll_employees.payroll_id', 'left');
            $this->db->where('users.id !=', '');
            $this->db->where("accounting_payroll.created_at >= '$reportConfig[date_from]'");
            $this->db->where("accounting_payroll.created_at <= '$reportConfig[date_to]'");
            $this->db->where('users.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('users.id');
            $query = $this->db->get();
            return $query->result();
        }    

        if ($reportType == 'recurring_template_list_details') {
            $this->db->select("*");
            $this->db->from('accounting_recurring_transactions');
            $this->db->where("DATE_FORMAT(created_at ,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(created_at ,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('status !=', 0);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('recurring_type');
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

        // // Get Open Invoices Date data in Database
        // if ($reportType == 'open_invoices') {
        //     $this->db->select('invoices.id AS invoices_id, invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS name, DATE_FORMAT(invoices.date_created,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.invoice_number AS num, "" AS terms, invoices.due_date AS due_date, IFNULL(SUM((items.price * invoices_items.qty) + invoices_items.tax), 0) AS open_balance');
        //     $this->db->from('invoices');
        //     $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        //     $this->db->join('invoices_items', 'invoices_items.invoice_id = invoices.id', 'left');
        //     $this->db->join('items', 'items.id = invoices_items.items_id', 'left');
        //     $this->db->where('acs_profile.first_name !=', '');
        //     $this->db->where('acs_profile.last_name !=', '');
        //     $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
        //     $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
        //     $this->db->where('invoices.company_id', $companyID);
        //     $this->db->group_by('invoices.customer_id');
        //     $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
        //     $this->db->limit($reportConfig['page_size']);
        //     $query = $this->db->get();

        //     return $query->result();
        // }

        // Get Product/Service list data in Database
        if ($reportType == 'product_service_list') {
            $this->db->select('items.id AS item_id, items.title AS product_service, items.type AS type, items.description AS description, items.price AS price, items.cost AS cost, items_has_storage_loc.qty AS qty_on_hand');
            $this->db->from('items');
            $this->db->join('items_has_storage_loc', 'items_has_storage_loc.item_id = items.id', 'left');
            $this->db->where('items.title !=', '');
            $this->db->where('items.company_id', $companyID);
            $this->db->where("DATE_FORMAT(items.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(items.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
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

        if ($reportType == 'payments_type_summary') {
            $this->db->select('date_issued, invoice_number, payment_methods, status, grand_total');
            $this->db->from('invoices');
            $this->db->where('company_id', $companyID);
            $this->db->where('status', 'paid');
            $this->db->group_by('payment_methods');
            if (!empty($reportConfig['date_from']) && !empty($reportConfig['date_to'])) {
                $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
                $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            }
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'sales_demographics') {
            $this->db->select('date_issued, invoice_number, payment_methods, status, grand_total');
            $this->db->from('invoices');
            $this->db->where('company_id', $companyID);
            $this->db->group_by('payment_methods');
            if (!empty($reportConfig['date_from']) && !empty($reportConfig['date_to'])) {
                $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
                $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            }
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

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
            // $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee, timesheet_pto.name AS leave_type,timesheet_leave_date.date AS leave_date,timesheet_leave_date.date_time AS date_filed');
            // $this->db->from('timesheet_leave');
            // $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');
            // $this->db->join('timesheet_leave_date', 'timesheet_leave.id = timesheet_leave_date.leave_id', 'left');
            // $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');
            // $this->db->where('users.company_id', $companyID);
            // $this->db->where("timesheet_leave_date.date >= '$reportConfig[date_from]'");
            // $this->db->where("timesheet_leave_date.date <= '$reportConfig[date_to]'");
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            // $this->db->limit($reportConfig['page_size']);
            // $data = $this->db->get();

            $this->db->select('timesheet_leave.*,CONCAT(users.FName, " ", users.LName)AS employee, timesheet_pto.name AS leave_type,timesheet_leave.date_created AS date_filed');
            $this->db->from('timesheet_leave');
            $this->db->join('users', 'timesheet_leave.user_id = users.id', 'left');            
            $this->db->join('timesheet_pto', 'timesheet_leave.pto_id = timesheet_pto.id', 'left');
            $this->db->where('users.company_id', $companyID);
            $this->db->where("timesheet_leave.date_from >= '$reportConfig[date_from]'");
            $this->db->where("timesheet_leave.date_to <= '$reportConfig[date_to]'");
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
        if ($reportType == 'invoice_by_date') {
            $this->db->select('invoices.id AS invoices_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.date_issued AS invoice_date, invoices.invoice_number AS num, invoices.due_date AS due_date, invoices.balance AS invoice_balance, invoices.grand_total AS invoice_total');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            // $this->db->where('acs_profile.first_name !=', '');
            // $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();

            return $query->result();
        }

        // Get Expenses by Workorder in Database
        if ($reportType == 'expenses_by_workorder') {
            $this->db->select('work_orders.work_order_number AS num, work_orders.date_issued, work_orders.grand_total AS total_amount, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer');
            $this->db->from('work_orders');
            $this->db->join('acs_profile', 'work_orders.customer_id = acs_profile.prof_id', 'left');
            // $this->db->where('acs_profile.first_name !=', '');
            // $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("work_orders.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("work_orders.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('work_orders.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $query = $this->db->get();

            return $query->result();
        }

        // Get Sales Summary by Customer in Database
        if ($reportType == 'sales_summary_by_customer') {
            $this->db->select('COALESCE(SUM(invoices.grand_total),0) AS total_amount, COUNT(invoices.id)AS total_invoices, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'left');
            // $this->db->where('acs_profile.first_name !=', '');
            // $this->db->where('acs_profile.last_name !=', '');
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
        if ($reportType == 'customer_source') {
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
                WHERE ac_leadsource.fk_company_id = '.$companyID.'
                ORDER BY '.$reportConfig['sort_by'].' '.$reportConfig['sort_order'].' 
                LIMIT '.$reportConfig['page_size'].'
            ');

            return $query->result();
        }

        // Get Workorder Status Database
        if ($reportType == 'workorder_status') {
            $this->db->select('work_orders.work_order_number AS num, work_orders.date_issued, work_orders.status AS workorder_status, COALESCE(work_orders.grand_total,0) AS total_amount, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer');
            $this->db->from('work_orders');
            $this->db->join('acs_profile', 'work_orders.customer_id = acs_profile.prof_id', 'left');
            // $this->db->where('acs_profile.first_name !=', '');
            // $this->db->where('acs_profile.last_name !=', '');
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
                WHERE timesheet_attendance.date_created >='".$reportConfig['date_from']."' 
                    AND timesheet_attendance.date_created <='".$reportConfig['date_to']."' 
                    AND users.company_id = ".$companyID.' 
                ORDER BY '.$reportConfig['sort_by'].' '.$reportConfig['sort_order'].' 
                LIMIT '.$reportConfig['page_size'].'
            ');

            return $query->result();
        }

        // Get Activities Timelog Details in Database
        if ($reportType == 'timelog_details') {
            $query = $this->db->query("
                SELECT timesheet_attendance.id,timesheet_attendance.user_id,timesheet_attendance.date_created AS attendance_date,timesheet_attendance.shift_duration, timesheet_attendance.break_duration, timesheet_attendance.overtime, timesheet_attendance.overtime_status,timesheet_attendance.status,timesheet_attendance.notes,
                CONCAT(users.FName, ' ', users.LName)AS employee_name, roles.title AS employee_role
                FROM timesheet_attendance 
                    JOIN users ON timesheet_attendance.user_id = users.id 
                    JOIN roles ON users.role = roles.id 
                WHERE timesheet_attendance.date_created >='".$reportConfig['date_from']."' 
                    AND timesheet_attendance.date_created <='".$reportConfig['date_to']."' 
                    AND users.company_id = ".$companyID.' 
                ORDER BY '.$reportConfig['sort_by'].' '.$reportConfig['sort_order'].' 
                LIMIT '.$reportConfig['page_size'].'
            ');

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

        // Get Activities Expense by Vendor
        if ($reportType == 'expenses_by_vendor') {
            $this->db->select('accounting_vendors.display_name AS vendor, accounting_bill.remaining_balance AS balance, accounting_bill.total_amount AS expense, accounting_bill.created_at AS payment_date, accounting_vendors.status as accounting_vendor_status');
            $this->db->from('accounting_vendors');
            $this->db->join('accounting_bill', 'accounting_bill.vendor_id = accounting_vendors.id', 'left');
            $this->db->where("DATE_FORMAT(accounting_vendors.created_at,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(accounting_vendors.created_at,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('accounting_vendors.company_id', $companyID);
            // $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        if ($reportType == 'sales_tax') {
            $this->db->select('invoices_items.*, items.type AS item_type, items.title AS item_name, invoices.invoice_number AS num, invoices.date_issued, CONCAT(first_name  , " ", last_name) AS customer, invoices_items.total AS total_amount');
            $this->db->from('invoices_items');
            $this->db->join('items', 'invoices_items.items_id = items.id', 'left');
            $this->db->join('invoices', 'invoices_items.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'left');
            $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('items.type !=', '');
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();
        }

        // Get Account Receivable in Database
        if ($reportType == 'account_receivable') {
            $this->db->select('DATE_FORMAT(invoices.date_issued, "%M %Y") AS month, COUNT(invoices.id) AS total_invoices, SUM(invoices.grand_total) AS invoiced, SUM(CASE WHEN invoices.status = "Paid" THEN invoices.grand_total ELSE 0 END) AS paid, SUM(invoices.total_due) AS due, SUM(invoices.tip) AS tip, SUM(invoices.late_fee) AS fee');
            $this->db->from('invoices');
            $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('DATE_FORMAT(invoices.date_issued, "%M %Y")');
            $query = $this->db->get();

            return $query->result();
        }

        // Get Sales by Customer Groups in Database
        if ($reportType == 'sales_by_customer_groups') {
            $this->db->select('customer_groups.title AS customer_group, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.invoice_number AS transaction, accounting_receive_payment_invoices.id AS payment_no, invoices.grand_total AS total_sales');
            $this->db->from('invoices');
            $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->join('customer_groups', 'customer_groups.id = acs_profile.customer_group_id', 'left');
            $this->db->where('customer_groups.title !=', '');
            $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('acs_profile.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('customer_groups.title');
            $query = $this->db->get();

            return $query->result();
        }

        // Get Sales by Customer Source in Database
        if ($reportType == 'sales_by_customer_source') {
            $this->db->select('sales_by_customer_source_view.company_id AS company_id, sales_by_customer_source_view.customer_source AS customer_source, sales_by_customer_source_view.customer AS customer, sales_by_customer_source_view.transaction AS transaction, sales_by_customer_source_view.payment_no AS payment_no, sales_by_customer_source_view.total_sales AS total_sales');
            $this->db->from('sales_by_customer_source_view');
            $this->db->where("sales_by_customer_source_view.date >= '$reportConfig[date_from]'");
            $this->db->where("sales_by_customer_source_view.date <= '$reportConfig[date_to]'");
            $this->db->where('sales_by_customer_source_view.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('sales_by_customer_source_view.customer_source');
            $query = $this->db->get();

            return $query->result();
        }

        if ($reportType == 'expenses_by_customer') {
            $this->db->select('invoices.id AS invoices_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, invoices.date_issued AS invoice_date, invoices.invoice_number AS num, invoices.invoice_type as inv_type, invoices.due_date AS due_date, invoices.balance AS invoice_balance, invoices.grand_total AS invoice_total');
            $this->db->from('invoices');
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
            $this->db->where("invoices.date_issued >= '$reportConfig[date_from]'");
            $this->db->where("invoices.date_issued <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $this->db->group_by('invoices.invoice_number');
            $query = $this->db->get();

            return $query->result();


            
        }  
        
        if ($reportType == 'tax_paid_by_customers') {
            $this->db->select('invoices.id, invoices.customer_id AS customer_id, CONCAT(acs_profile.first_name, " ", acs_profile.last_name) AS customer, DATE_FORMAT(invoices.date_issued,"%Y-%m-%d") AS date, "Invoice" AS transaction_type, invoices.invoice_number AS num, invoices.total_due AS balance');
            $this->db->from('invoices');            
            $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');            
            $this->db->where('acs_profile.first_name !=', '');
            $this->db->where('acs_profile.last_name !=', '');
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') >= '$reportConfig[date_from]'");
            $this->db->where("DATE_FORMAT(invoices.date_created,'%Y-%m-%d') <= '$reportConfig[date_to]'");
            $this->db->where('invoices.company_id', $companyID);
            $this->db->group_by('invoices.customer_id, customer');
            $this->db->order_by($reportConfig['sort_by'], $reportConfig['sort_order']);
            $this->db->limit($reportConfig['page_size']);
            $data = $this->db->get();

            return $data->result();

        }
    }
}
