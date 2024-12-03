<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends MY_Model
{
    public $table = 'events';
    public $table_items = 'event_items';

    public function get_all_events($limit = 0, $conditions = [])
    {
        $cid = logged('company_id');
        $this->db->from($this->table);
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->where('events.company_id', $cid);
        if (!empty($conditions)) {
            foreach ($conditions as $key => $value) {
                $this->db->where($value['field'], $value['value']);
            }
        }
        $this->db->order_by('id', 'DESC');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllEventsAdmin($filters = [], $limit = 0)
    {
        $this->db->from($this->table);
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img,business_profile.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = events.company_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->order_by('id', 'DESC');

        if (!empty($filters)) {
            if (!empty($filters['search'])) {
                $this->db->like('event_number', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByStatus($status)
    {
        $this->db->from($this->table);
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img,business_profile.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('business_profile', 'business_profile.company_id = events.company_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->order_by('id', 'DESC');
        $this->db->where('events.status', $status);

        if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        return $query->result();
    }

    public function get_specific_event($id)
    {
        $this->db->from($this->table);
        $this->db->select('events.*,events.id as job_unique_id,LName,FName,
        acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email,business_profile.business_name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->join('business_profile', 'events.company_id = business_profile.id', 'left');
        $this->db->where('events.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_specific_event_items($id)
    {
        $this->db->select('items.title,items.price,event_items.qty,event_items.event_id,event_items.items_id,event_items.item_price');
        $this->db->from('event_items');
        $this->db->join('items', 'items.id = event_items.items_id', 'left');
        $this->db->where('event_items.event_id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByCompany($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();

        return $query->result();
    }

    public function getAllEvents()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByUserId($type = '', $status = '', $emp_id = 0, $uid = 0)
    {
        $user_id = getLoggedUserID();

        $this->db->select('events.id, company_id, customer_id, employee_id, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        if ($uid) {
            $this->db->join('user_events', 'user_events.event_id = events.id');
            $this->db->where('user_events.user_id', $uid);
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();die;

        if ($query) {
            return $query->result();
        }

        return false;
    }

    public function getAllUpComingEvents($user_id = 0)
    {
        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');

        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($start_date.' +5 day'));

        $this->db->where('start_date BETWEEN "'.$start_date.'" and "'.$end_date.'"');

        $this->db->order_by('id', 'DESC');

        $query = $this->db->limit(5);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllUpComingEventsByCompanyId($company_id = 0)
    {
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime($start_date.' +7 day'));

        /* $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img'); */
        $this->db->select('*');
        /* $this->db->join('acs_profile', 'acs_profile.prof_id = `events.customer_id', 'left'); */
        /* $this->db->join('users', 'users.id = events.employee_id', 'left'); */
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('start_date >=', $start_date);
        $this->db->order_by('start_date', 'ASC');

        // $query = $this->db->limit(5);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllEventsByCompanyIdAndDate($company_id = 0, $date)
    {
        $date = date('Y-m-d', strtotime($date));

        $this->db->select('events.*,LName,FName,acs_profile.first_name,acs_profile.last_name,users.profile_img');
        $this->db->join('acs_profile', 'acs_profile.prof_id = `events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'left');
        $this->db->from($this->table);
        $this->db->where('events.company_id', $company_id);
        $this->db->where('events.start_date', $date);
        $this->db->order_by('events.start_date', 'ASC');

        // $query = $this->db->limit(5);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllInvoices()
    {
        $company_id = logged('company_id');
        $query = $this->db->get_where('invoices', ['company_id' => $company_id]);

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getUnpaidInvoices($limit = 5)
    {
        $company_id = logged('company_id');
        $this->db->from('invoices');
        $this->db->select('
            invoices.id,
            invoices.invoice_number,
            invoices.due_date,
            invoices.status,
            acs_profile.email AS customer_email,
            acs_profile.first_name, 
            acs_profile.last_name,
            acs_profile.fk_user_id as user_id,
            invoices.grand_total,
            invoices.grand_total - COALESCE(SUM(accounting_receive_payment_invoices.payment_amount), 0) as balance,
            invoices.date_updated
        ');
        $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.company_id', $company_id);

        //$this->db->where('invoices.grand_total >', 0);
        //$this->db->where_in('invoices.status', ['Submitted', 'Partially Paid', 'Due', 'Overdue', 'Approved', 'Schedule']);
        //$this->db->where('invoices.status', 'Unpaid');          

        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");

        $this->db->where('invoices.due_date >=', date('Y-m-d', strtotime('-90 days')));
        $this->db->where('invoices.due_date <=', date('Y-m-d'));        

        $this->db->group_by('invoices.id');
        $this->db->order_by('balance', 'DESC');
        //$this->db->limit($limit);
        $query = $this->db->get();
        $results = $query->result();

        return array_filter($results, function ($result) {
            return $result->balance > 0;
        });
    }

    public function getTodayStats()
    {
        $company_id = logged('company_id');
        $this->db->from('jobs');
        $this->db->select('job_payments.amount,jobs.date_issued,jobs.status');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id', 'left');
        $this->db->where('jobs.company_id', $company_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTodayStatsSales($companyID)
    {
        $this->db->select('SUM(invoices.grand_total) AS total');
        $this->db->from('invoices');
        $this->db->where('invoices.company_id', $companyID);
        $this->db->where('invoices.status != ', "Draft");
        $this->db->where('invoices.status != ', "");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.date_created >=', date('Y-m-d'));
        $data = $this->db->get();
        return $data->row();
      
    }

    public function getTodayStatsJobsCreated($companyID)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('jobs');
        $this->db->where('jobs.status', "Scheduled");
        $this->db->where('jobs.date_created >=', date('Y-m-d'));
        $this->db->where('jobs.company_id', $companyID);
        $data = $this->db->get();
        return $data->row();
      
    }

    public function getTodayJobsDone($companyID)
    {
        $this->db->select('COUNT(*) As total');
        $this->db->from('jobs_completed_view');
        $this->db->where_in('status', [
            'Finished',
            'Completed',
        ]);
        $this->db->where('date >=', date('Y-m-d'));
        $this->db->where('company_id', $companyID);
        $data = $this->db->get();
        return $data->row();
      
    }

    public function getTodayCollected($companyID)
    {
        $total = 0;
    
        // Collect total from jobs
       $this->db->select('COALESCE(SUM(invoices.grand_total), 0) AS total');
        $this->db->from('jobs');
        $this->db->join('invoices', 'invoices.job_id = jobs.id', 'left');
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.date_created >=', date('Y-m-d'));
        $this->db->where('invoices.company_id', $companyID);
        $jobsTotal = $this->db->get()->row()->total ?? 0;
    
        // Collect total from tickets
       $this->db->select('COALESCE(SUM(invoices.grand_total), 0) AS total');
        $this->db->from('tickets');
        $this->db->join('invoices', 'invoices.ticket_id = tickets.id', 'left');
        $this->db->where('invoices.status', "Paid");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.date_created >=', date('Y-m-d'));
        $this->db->where('invoices.company_id', $companyID);
        $ticketsTotal = $this->db->get()->row()->total ?? 0;
    
        // Calculate total
        $total = $jobsTotal + $ticketsTotal;
    
        return $total;
    }
    

    public function getTodayStatsJobsCanceled($companyID)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('jobs');
        $this->db->where('jobs.status', "Cancelled");
        $this->db->where('jobs.date_created >=', date('Y-m-d'));
        $this->db->where('jobs.company_id', $companyID);
        $data = $this->db->get();
        return $data->row();
      
    }

    public function getTotalServiceScheduled($companyID)
    {
        $this->db->select('COUNT(*) AS total');
        $this->db->from('tickets');
        $this->db->where('ticket_status', "Scheduled");
        $this->db->where('created_at >=', date('Y-m-d'));
        $this->db->where('company_id', $companyID);
        $data = $this->db->get();
        return $data->row();
    }
 
 

    public function getCollected()
    {
        $company_id = logged('company_id');
        $this->db->from('jobs');
        $this->db->select('job_payments.amount,jobs.date_issued,jobs.status');
        $this->db->join('job_payments', 'job_payments.job_id = jobs.id');
        $this->db->where('jobs.company_id', $company_id);
        $this->db->where('jobs.status', 'Completed');
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getLeadSource($source)
    {
        $this->db->select('COUNT(*) as total');
        $this->db->from('acs_office');
        $this->db->where('lead_source', $source);
        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAccountSituation($status)
    {
        // $company_id = logged('company_id');
        // $this->db->select('COUNT(*) as total');
        // $this->db->from('acs_office');
        // $this->db->join('acs_profile', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        // $this->db->where("acs_profile.company_id", $company_id);
        // $this->db->where("acs_office.".$toCheck, date('m/d/Y'));
        // $this->db->group_by('acs_profile.prof_id');
        // $query = $this->db->get();
        // dd($this->db->last_query());

        $this->db->select('COUNT(*) as total');
        $this->db->from('acs_profile');
        $this->db->where('status', $status);
        if ($status === 'Cancelled') {
            $this->db->join('acs_office', 'acs_profile.prof_id = acs_office.fk_prof_id', 'left');
            $this->db->where('acs_office.cancel_date', date('m/d/Y'));
        }
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTechLeaderboards()
    {
        $cid = logged('company_id');
        $this->db->select('users.id, users.FName, users.LName, COUNT(acs_office.technician) as totalCount');
        $this->db->from('users');
        $this->db->join('acs_office', 'users.id = acs_office.technician');
        $this->db->where('users.company_id', $cid);
        $this->db->where('users.role', 7);
        $this->db->group_by('technician');
        $this->db->order_by('totalCount', 'desc');
        $query = $this->db->get();

        return $query->result();
    }

    public function getCustomerCountPerId($id, $field = 'technician')
    {
        $this->db->select('count('.$field.') as totalCount');
        $this->db->from('acs_office');
        $this->db->where($field.'=', $id);
        $this->db->group_by($field);
        $this->db->order_by('totalCount', 'desc');
        $query = $this->db->get();

        return $query->result();
    }

    public function getJobCountPerId($id)
    {
        $this->db->select('count(jobs.id) as totalCount');
        $this->db->from('job_payments');
        $this->db->join('jobs', ' job_payments.job_id = jobs.id', 'left');
        $this->db->join('invoices', ' invoices.job_id = jobs.id');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $id);
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(jobs.date_issued, "%Y")');
        $this->db->group_by('jobs.customer_id'); // unique by customer ?
        $query = $this->db->get();

        return $query->result();
    }

    public function getSalesLeaderboards()
    {
        $cid = logged('company_id');
        $this->db->select('users.id,FName,LName, count(fk_sales_rep_office) as customerCount');
        $this->db->from('users');
        $this->db->join('acs_office', 'acs_office.fk_sales_rep_office = users.id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = acs_office.fk_prof_id', 'left');
        $this->db->where('acs_profile.company_id', $cid);
        $this->db->where('acs_office.fk_sales_rep_office !=', null);
        $this->db->group_by('users.id');
        $this->db->order_by('customerCount', 'desc');
        $query = $this->db->get();

        return $query->result();
    }

    // SELECT users.id, FName, LName, COUNT(acs_office.fk_sales_rep_office) AS customerCount FROM users LEFT JOIN acs_office ON acs_office.fk_sales_rep_office = users.id LEFT JOIN acs_profile ON acs_profile.prof_id = acs_office.fk_prof_id WHERE acs_profile.company_id = 31;

    /**
     * This function will fetch lead source data with count of customer connected to it.
     *
     * @return object List of Lead Source per company ID with count on customer
     */
    public function getLeadSourceWithCount()
    {
        $this->db->select('acs_office.lead_source, count(acs_office.lead_source) as leadSourceCount');
        $this->db->from('acs_profile');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.lead_source !=', '');
        $this->db->group_by('acs_office.lead_source');
        $query = $this->db->get();

        return $query->result();
    }

    public function getCompanyLeadSourceWithCount($cid)
    {
        $this->db->select('acs_office.lead_source, count(acs_office.lead_source) as leadSourceCount');
        $this->db->from('acs_profile');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.lead_source !=', '');
        $this->db->where('company_id =', $cid);
        $this->db->group_by('acs_office.lead_source');
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function will fetch jobs status with count.
     *
     * @return object List of JOB STATUS with number of count
     */
    // public function getJobStatusWithCount()
    // {
    //     $cid=logged('company_id');
    //     $this->db->select('status, count(status) as statusCount');
    //     $this->db->from('jobs');
    //     $this->db->group_by('status');
    //     $this->db->order_by('statusCount');
    //     $this->db->where('company_id', $cid);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

  public function getStatusCount()
    {
        $CURRENT_MONTH_COUNT = [];
        $CURRENT_YEAR_COUNT = [];
        $COMPANY_ID = logged('company_id');

        // Define status types to query
        $statusTypes = ["Draft","Scheduled", "Arrival", "Started", "Approved", "Finished","Cancelled", "Invoiced", "Completed"];
        
        foreach ($statusTypes as $status) {
            // Prepare base SQL template for each status
            $sqlTemplateMonth = "
                '$status' AS STATUS, (
                    (SELECT COUNT(*) FROM jobs WHERE jobs.status = '$status'  AND DATE_FORMAT(jobs.date_created, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') AND jobs.company_id = '$COMPANY_ID')
                ) AS TOTAL";

            $sqlTemplateYear = "
                '$status' AS STATUS, (
                    (SELECT COUNT(*) FROM jobs WHERE jobs.status = '$status' AND DATE_FORMAT(jobs.date_created, '%Y') = DATE_FORMAT(CURDATE(), '%Y') AND jobs.company_id = '$COMPANY_ID')
                ) AS TOTAL";
            
            // Execute monthly query for each status
            $this->db->select($sqlTemplateMonth);
            $queryMonth = $this->db->get();
            array_push($CURRENT_MONTH_COUNT, $queryMonth->row());

            // Execute yearly query for each status
            $this->db->select($sqlTemplateYear);
            $queryYear = $this->db->get();
            array_push($CURRENT_YEAR_COUNT, $queryYear->row());
        }

        return [
            'CURRENT_MONTH_COUNT' => $CURRENT_MONTH_COUNT,
            'CURRENT_YEAR_COUNT' => $CURRENT_YEAR_COUNT,
        ];
    }


    /**
     * This function will fetch latest jobs of each company.
     *
     * @return object List of LATEST JOB limit 10
     */
    public function getLatestJobs()
    {
        $cid = logged('company_id');

        //Old Query - Nov 14, 2024
        /*
            $this->db->select(
                    'acs_profile.first_name, 
                    acs_profile.last_name, 
                    acs_profile.city, 
                    acs_profile.state, 
                    acs_profile.zip_code, 
                    jobs.id, jobs.status, 
                    jobs.job_number, jobs.job_type, 
                    jobs.date_updated, jobs.start_date, 
                    job_payments.amount, 
                    (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee_id) AS TECH_1, 
                    (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee2_id) AS TECH_2, 
                    (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee3_id) AS TECH_3, 
                    (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee4_id) AS TECH_4, 
                    (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee5_id) AS TECH_5, 
                    (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee6_id) AS TECH_6'
                );

            $this->db->from('jobs');
            $this->db->join('job_payments', 'job_payments.job_id = jobs.id', 'left');
            $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
            $this->db->order_by('jobs.id', 'desc');
            $this->db->where('jobs.company_id', $cid);
            if ($cid == 58) {
                $this->db->limit(25); // for SOLAR COMPANY it needs to be 25
            } else {
                $this->db->limit(10);
            }

            $query = $this->db->get();
        */

        $this->db->select(
                'acs_profile.first_name, 
                acs_profile.last_name, 
                acs_profile.city, 
                acs_profile.state, 
                acs_profile.zip_code, 
                jobs.id, jobs.status, 
                jobs.job_number, jobs.job_type, 
                jobs.date_updated, jobs.start_date, 
                SUM(job_items.cost) AS amount,
                (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee_id) AS TECH_1, 
                (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee2_id) AS TECH_2, 
                (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee3_id) AS TECH_3, 
                (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee4_id) AS TECH_4, 
                (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee5_id) AS TECH_5, 
                (SELECT CONCAT(users.FName, " ", users.LName) FROM users WHERE users.id = jobs.employee6_id) AS TECH_6'
            );

        $this->db->from('jobs');
        $this->db->join('job_items', 'job_items.job_id = jobs.id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id', 'left');
        $this->db->group_by('jobs.id');
        $this->db->order_by('jobs.id', 'desc');
        $this->db->where('jobs.company_id', $cid);
        if ($cid == 58) {
            $this->db->limit(25); // for SOLAR COMPANY it needs to be 25
        } else {
            $this->db->limit(10);
        }

        $query = $this->db->get();        

        return $query->result();
    }

    /**
     * This function will fetch jobs status with count.
     *
     * @return object List of JOB STATUS with number of count
     */
    public function getCustomerStatusWithCount()
    {
        $cid = logged('company_id');
        $this->db->select('status, count(status) as statusCount');
        $this->db->from('acs_profile');
        $this->db->group_by('status');
        $this->db->order_by('statusCount', 'desc');
        $this->db->where('company_id', $cid);
        $this->db->where('status !=', null);
        $this->db->where('status !=', '');
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function will fetch recent customers per company id.
     *
     * @return object List of RECENT CUSTOMER added
     */
    public function getRecentCustomer()
    {
        $company_id = logged('company_id');
        $this->db->from('acs_profile');
        $this->db->where('company_id', $company_id);
        $this->db->order_by('prof_id', 'desc');
        $this->db->limit(10);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * This function will fetch companies.
     *
     * @return object List of companies
     */
    public function getCompanies()
    {
        $this->db->from('business_profile');
        $this->db->order_by('id', 'asc');
        $this->db->limit(10);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getTechRevenue($techId)
    {
        $this->db->select('SUM(job_payments.amount) as techRev');
        $this->db->from('job_payments');
        $this->db->join('jobs', ' job_payments.job_id = jobs.id', 'left');
        $this->db->join('invoices', ' invoices.job_id = jobs.id');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $techId);
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(jobs.date_issued, "%Y")');
        // $this->db->group_by('jobs.customer_id');
        $query = $this->db->get();

        return $query->result();
    }

    public function getTechRevenueSolar($salesRepId)
    {
        $this->db->select('SUM(acs_info_solar.proposed_payment) as techRev');
        $this->db->from('acs_info_solar');
        $this->db->join('acs_profile', ' acs_profile.prof_id = acs_info_solar.fk_prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $salesRepId);
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(acs_info_solar.date_created, "%Y")'); // get only revenue for this year?
        $this->db->group_by('acs_office.technician');
        $query = $this->db->get();

        return $query->result();
    }

    public function getSalesRepRevenue($salesRepId)
    {
        $COMPANY_ID = logged('company_id');
        $this->db->select('SUM(acs_billing.mmr) as salesRepRev');
        $this->db->from('acs_billing');
        $this->db->join('acs_office', 'acs_billing.fk_prof_id = acs_office.fk_prof_id', 'left');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.fk_sales_rep_office', $salesRepId);
        $this->db->where(' acs_profile.company_id', $COMPANY_ID);
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = SUBSTRING(acs_billing.bill_start_date, -4)'); // get only sales for this year?
        $this->db->group_by('acs_profile.company_id');
        $query = $this->db->get();

        return $query->result();
    }

    // SELECT SUM(acs_billing.mmr) FROM acs_billing LEFT JOIN acs_office ON acs_billing.fk_prof_id = acs_office.fk_prof_id LEFT JOIN acs_profile ON acs_billing.fk_prof_id = acs_profile.prof_id WHERE acs_office.fk_sales_rep_office = 5 AND acs_profile.company_id = 31 GROUP BY acs_profile.company_id;

    public function getSalesRepRevenueSolar($salesRepId)
    {
        $this->db->select('SUM(acs_info_solar.proposed_solar) as salesRepRev');
        $this->db->from('acs_info_solar');
        $this->db->join('acs_profile', ' acs_profile.prof_id = acs_info_solar.fk_prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('fk_sales_rep_office', $salesRepId);
        $this->db->where('DATE_FORMAT(CURDATE(), "%Y") = DATE_FORMAT(acs_info_solar.date_created, "%Y")'); // get only sales for this year?
        $this->db->group_by('fk_sales_rep_office');
        $query = $this->db->get();

        return $query->result();
    }

    public function getTechCustomerCount($techId)
    {
        $this->db->select('SUM(job_payments.amount) as techRev');
        $this->db->from('job_payments');
        $this->db->join('jobs', ' job_payments.job_id = jobs.id', 'left');
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_office.technician', $techId);
        $this->db->group_by('jobs.customer_id');
        $query = $this->db->get();

        return $query->result();
    }

    public function getSalesLeaderboardItems($company_id)
    {
        $this->db->select('*');
        $this->db->from('acs_profile');
        $this->db->where('company_id =', $company_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getSalesinOffice($prof_id)
    {
        $this->db->select('*');
        $this->db->from('acs_office');
        $this->db->where('fk_prof_id =', $prof_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getUser($user)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id =', $user);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getRoles($roles)
    {
        $this->db->select('*');
        $this->db->from('roles');
        $this->db->where('id =', $roles);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
        // $data = new stdClass();
        // // $data->class = $qu
    }

    public function getSalesLeaderboard()
    {
        $sales[][] = '';
        $salesItems = $this->getSalesLeaderboardItems(logged('company_id'));

        $z = 1;
        // var_dump($salesItems[0]->prof_id);

        for ($k = 0; $k < count($salesItems); ++$k) {
            $salesOffice = $this->getSalesinOffice($salesItems[$k]->prof_id);
            if (isset($salesOffice[$k])) {
                $userName = $this->getUser($salesOffice[$k]->fk_sales_rep_office);
                $roles = $this->getRoles($userName[$k]->role);
                $x = 0;

                if ($sales[0][0] == '') {
                    $sales[$x][0] = $userName[$k]->FName[0].$userName[$k]->LName[0];
                    $sales[$x][1] = $userName[$k]->FName.' '.$userName[$k]->LName;
                    $sales[$x][2] = $roles[$k]->title;
                    $sales[$x][3] = 1;
                } else {
                    $name = $userName[$k]->FName.' '.$userName[$k]->LName;
                    for ($y = 0; $y < count($sales); ++$y) {
                        if ($sales[$y][1] == $name) {
                            ++$sales[$y][3];
                        } else {
                            if ($y == 0) {
                                ++$y;
                            }
                            $sales[$y][0] = $userName[$k]->FName[0].$userName[$k]->LName[0];
                            $sales[$y][1] = $userName[$k]->FName.' '.$userName[$k]->LName;
                            $sales[$y][2] = $roles[$k]->title;
                            $sales[$y][3] = 1;
                        }
                    }
                }
            }
        }

        return $sales;
    }

    public function getAllJobs()
    {
        $company_id = logged('company_id');
        $this->db->select('jobs.*, job_payments.amount');
        $this->db->from('jobs');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id');
        $this->db->where('jobs.company_id', $company_id);
        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllJobsByCompanyIdAndDateIssued($company_id, $date_range = [])
    {
        $this->db->select('jobs.*, COALESCE(job_payments.amount,0)AS payment_amount');
        $this->db->from('jobs');
        $this->db->join('job_payments', 'jobs.id = job_payments.job_id');
        $this->db->where('jobs.company_id', $company_id);
        $this->db->where('jobs.date_issued >=', $date_range['from']);
        $this->db->where('jobs.date_issued <=', $date_range['to']);

        $query = $this->db->get();

        return $query->result();
    }

    public function getAllSales()
    {
        $query = $this->db->get_where('invoices', ['company_id' => logged('company_id'), 'status' => 'Paid']);

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllPInvoices()
    {
        $query = $this->db->get('accounting_receive_payment_invoices');

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllsubs()
    {
        $this->db->select('SUM(acs_billing.mmr) AS TOTAL_MMR');
        $this->db->from('acs_billing');
        $this->db->join('acs_alarm', 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
        // $this->db->where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "IN-HOUSE"');
        // $this->db->or_where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "PURCHASE"');
        // $this->db->where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_profile.status = "Installed"');
        $this->db->where('acs_profile.status', 'Installed');

        $query = $this->db->get();

        return $query->row();
        // SELECT SUM(acs_billing.mmr) TOTAL_MMR FROM acs_billing JOIN acs_alarm ON acs_billing.fk_prof_id = acs_alarm.fk_prof_id WHERE MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "PURCHASE" OR MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "IN-HOUSE";
    }

    public function getAllsubsByCompanyId($company_id)
    {
        $current_date = date('Y-m-d');
        $this->db->select('SUM(acs_billing.mmr) AS TOTAL_MMR');
        $this->db->from('acs_billing');
        $this->db->join('acs_alarm', 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
        // $this->db->where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "IN-HOUSE"');
        // $this->db->or_where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "PURCHASE"');
        // $this->db->where('MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_profile.status = "Installed"');
        $this->db->where('acs_profile.status', 'Installed');
        $this->db->where("STR_TO_DATE(acs_billing.bill_start_date, '%m/%d/%Y') >=", date('Y-m-d', strtotime('01-01-2000')));
        $this->db->where('STR_TO_DATE(acs_billing.bill_end_date, "%m/%d/%Y") >=', date('Y-m-d', strtotime($current_date)));
        $this->db->where('acs_profile.company_id', $company_id);

        $query = $this->db->get();

        return $query->row();
        // SELECT SUM(acs_billing.mmr) TOTAL_MMR FROM acs_billing JOIN acs_alarm ON acs_billing.fk_prof_id = acs_alarm.fk_prof_id WHERE MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "PURCHASE" OR MONTH(STR_TO_DATE(acs_billing.next_billing_date, "%m/%d/%Y")) = MONTH(CURDATE()) AND acs_alarm.acct_type = "IN-HOUSE";
    }

    public function getAllJobsByCompanyId($company_id)
    {
        $query = $this->db->get_where('jobs', ['company_id' => $company_id]);

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getEvent($event_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $event_id);

        $query = $this->db->get();

        return $query->row();
    }

    public function getEventByGoogleEventId($google_event_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('gevent_id', $google_event_id);

        $query = $this->db->get();

        return $query->row();
    }

    public function getAllEventsWithAddress()
    {
        $this->db->select('events.id, company_id, customer_id, employee_id, workorder_id, description, event_description, event_address, event_zip_code, event_state, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, status');
        $this->db->from($this->table);

        $this->db->where('events.event_address !=', '');

        $query = $this->db->get();

        return $query->result();
    }

    public function getAllCompanyEventsWithAddress($company_id)
    {
        $this->db->select('events.id, events.company_id, events.event_number, customer_id, employee_id, event_type, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, events.status, LName,FName, acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'right');

        $this->db->where('events.event_address !=', '');
        $this->db->where('events.company_id', $company_id);

        $query = $this->db->get();

        return $query->result();
    }

    public function getAllUserEventsWithAddress($employee_id, $date_range = [], $filter = [])
    {
        $this->db->select('events.id, events.event_number, events.company_id, customer_id, employee_id, event_address, event_state, event_zip_code, event_type, workorder_id, description, event_description, start_date, start_time, end_date, end_time, event_color, notify_at, instructions, is_recurring, events.status, LName,FName, acs_profile.first_name,acs_profile.last_name,acs_profile.mail_add,acs_profile.city as cust_city,acs_profile.state as cust_state,
        acs_profile.zip_code as cust_zip_code,acs_profile.phone_h,acs_profile.phone_m,acs_profile.email as cust_email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'acs_profile.prof_id = events.customer_id', 'left');
        $this->db->join('users', 'users.id = events.employee_id', 'right');

        $this->db->where('events.event_address !=', '');
        if (!empty($date_range)) {
            $start_date = $date_range['date_from'];
            $end_date = $date_range['date_to'];
            $this->db->where('start_date BETWEEN "'.$start_date.'" and "'.$end_date.'"');
        }

        if (!empty($filter)) {
            foreach ($filter as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        $this->db->where('events.employee_id', $employee_id);

        $query = $this->db->get();

        return $query->result();
    }

    public function getlastInsert($company_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        return $query->row();
    }
}
