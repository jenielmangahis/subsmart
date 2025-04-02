<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends MY_Model
{
    public function fetchThumbnailWidgetData($category, $dateFrom, $dateTo, $filter2 = null)
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
                if ($filter2 == "all_status") {
                    $this->db->where_in('acs_profile.status', ['Active w/RAR', 'Active w/RMR', 'Active w/RQR', 'Active w/RYR', 'Inactive w/RMM']);
                } else {
                    $this->db->where('acs_profile.status', $filter2);
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
        }
    }
}