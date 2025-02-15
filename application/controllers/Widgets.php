<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Widgets
 *
 * @author genesisrufino
 */
class Widgets extends MY_Controller
{

    //put your code here

    public function loadTechLeaderboard()
    {
        $comp_id = getLoggedCompanyID();
        $this->load->model('widgets_model');
        $data['tech_leaderboard'] = $this->widgets_model->loadTechLeaderboard($comp_id);
        $this->load->view('widgets/tech_leaderboard_details', $data);
    }

    public function loadV2TechLeaderboard()
    {        
        $this->load->model('widgets_model');
        $this->load->model('Users_model');
        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');

        $cid       = getLoggedCompanyID();
        $date_from = post('tech_leaderboard_date_from');
        $date_to   = post('tech_leaderboard_date_to');

        $tech_field_user_type = 6;
        $techs = $this->Users_model->getCompanyUsersByUserType($cid, '');
        
        //Service Tickets
        //$tickets = $this->Tickets_model->get_tickets_by_company_id($cid);
        $techLeaderBoards = [];
        $date_range       = ['from' => $date_from, 'to' => $date_to];
        $status  = ['Finished', 'Completed'];

        $tickets = $this->Tickets_model->getAllTicketsByCompanyIdAndDateRange($cid,$date_range,$status);
        $user_tickets = [];
        foreach( $tickets as $t ){
            $ticketTechs = unserialize($t->technicians);
            if( !empty($ticketTechs) ){
                foreach($ticketTechs as $uid){
                    if( $user_tickets[$uid] ){
                        $user_tickets[$uid] = $user_tickets[$uid] + 1;
                    }else{
                        $user_tickets[$uid] = 1;
                    }
                }
            }
        }

        foreach( $techs as $t ){
            $tech_name  = $t->FName . ' ' . $t->LName;

            $jobs = $this->Jobs_model->countAssignedJobsByUserId($t->id , $date_range, $status);    
            if( $user_tickets[$t->id] ){
                $total_jobs_assigned = $jobs->total_jobs_assigned + $user_tickets[$t->id];
            }else{
                $total_jobs_assigned = $jobs->total_jobs_assigned;
            }
            $techLeaderBoards[] = ['uid' => $t->id, 'name' => $tech_name, 'email' => $t->email, 'total_jobs' => $total_jobs_assigned];
        }

        usort($techLeaderBoards, function($a, $b) {
            return $b["total_jobs"] - $a["total_jobs"];
        });

        $data['techLeaderBoards'] = $techLeaderBoards;
        $this->load->view('v2/widgets/tech_leaderboard_details', $data);
    }

    public function loadV4TechLeaderboard()
    {
        $companyID = logged('company_id');
        $date_from = post('tech_leaderboard_date_from');
        $date_to   = post('tech_leaderboard_date_to');
        $filter_by = post('filter_by');

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
        $this->db->where("DATE_FORMAT(point_rating_system.date_created,'%Y-%m-%d') >= '{$date_from}'");
        $this->db->where("DATE_FORMAT(point_rating_system.date_created,'%Y-%m-%d') <= '{$date_to}'");
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
                            'employee_number' => $entry->employee_number,
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
                    'employee_number' => $entry->employee_number,
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

        $data['techLeaderBoards'] = $prs_processed_data;
        $this->load->view('v2/widgets/tech_leaderboard_details', $data);
    }

    public function loadV3TechLeaderboard()
    {        
        $this->load->model('widgets_model');
        $this->load->model('Users_model');
        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');

        $companyID = logged('company_id');
        $date_from = post('tech_leaderboard_date_from');
        $date_to   = post('tech_leaderboard_date_to');
        $filter_by = post('filter_by');

        $filter_by1 = "";
        $filter_by2 = "";
        
        if($filter_by == 'today') {
            $filter_by1 = "AND ((DATE(jobs2.date_updated) = CURDATE()) 
                            OR (DATE(jobs3.date_updated) = CURDATE()) 
                            OR (DATE(jobs4.date_updated) = CURDATE()) 
                            OR (DATE(jobs5.date_updated) = CURDATE()) 
                            OR (DATE(jobs6.date_updated) = CURDATE()))";
            $filter_by2 = "AND DATE(tickets.updated_at) = CURDATE()";
        }elseif($filter_by == 'this-week') {
            $filter_by1 = "AND ((YEARWEEK(jobs2.date_updated, 1) = YEARWEEK(CURDATE(), 1)) 
                            OR (YEARWEEK(jobs3.date_updated, 1) = YEARWEEK(CURDATE(), 1)) 
                            OR (YEARWEEK(jobs4.date_updated, 1) = YEARWEEK(CURDATE(), 1)) 
                            OR (YEARWEEK(jobs5.date_updated, 1) = YEARWEEK(CURDATE(), 1)) 
                            OR (YEARWEEK(jobs6.date_updated, 1) = YEARWEEK(CURDATE(), 1)))";
            $filter_by2 = "AND YEARWEEK(tickets.updated_at, 1) = YEARWEEK(CURDATE(), 1)";
        }elseif($filter_by == 'this-month') {
            $filter_by1 = "AND ((YEAR(jobs2.date_updated) = YEAR(CURDATE()) AND MONTH(jobs2.date_updated) = MONTH(CURDATE())) 
                            OR (YEAR(jobs3.date_updated) = YEAR(CURDATE()) AND MONTH(jobs3.date_updated) = MONTH(CURDATE())) 
                            OR (YEAR(jobs4.date_updated) = YEAR(CURDATE()) AND MONTH(jobs4.date_updated) = MONTH(CURDATE())) 
                            OR (YEAR(jobs5.date_updated) = YEAR(CURDATE()) AND MONTH(jobs5.date_updated) = MONTH(CURDATE())) 
                            OR (YEAR(jobs6.date_updated) = YEAR(CURDATE()) AND MONTH(jobs6.date_updated) = MONTH(CURDATE())))";
            $filter_by2 = "AND YEAR(tickets.updated_at) = YEAR(CURDATE()) AND MONTH(tickets.updated_at) = MONTH(CURDATE())";
        }elseif($filter_by == 'this-quarter') {
            $filter_by1 = "AND ((YEAR(jobs2.date_updated) = YEAR(CURDATE()) AND QUARTER(jobs2.date_updated) = QUARTER(CURDATE())) 
                            OR (YEAR(jobs3.date_updated) = YEAR(CURDATE()) AND QUARTER(jobs3.date_updated) = QUARTER(CURDATE())) 
                            OR (YEAR(jobs4.date_updated) = YEAR(CURDATE()) AND QUARTER(jobs4.date_updated) = QUARTER(CURDATE())) 
                            OR (YEAR(jobs5.date_updated) = YEAR(CURDATE()) AND QUARTER(jobs5.date_updated) = QUARTER(CURDATE())) 
                            OR (YEAR(jobs6.date_updated) = YEAR(CURDATE()) AND QUARTER(jobs6.date_updated) = QUARTER(CURDATE())))";
            $filter_by2 = "AND YEAR(tickets.updated_at) = YEAR(CURDATE()) AND QUARTER(tickets.updated_at) = QUARTER(CURDATE())";
        }elseif($filter_by == 'this-year') {
            $filter_by1 = "AND ((YEAR(jobs2.date_updated) = YEAR(CURDATE())) 
                            OR (YEAR(jobs3.date_updated) = YEAR(CURDATE())) 
                            OR (YEAR(jobs4.date_updated) = YEAR(CURDATE())) 
                            OR (YEAR(jobs5.date_updated) = YEAR(CURDATE())) 
                            OR (YEAR(jobs6.date_updated) = YEAR(CURDATE())))";
            $filter_by2 = "AND YEAR(tickets.updated_at) = YEAR(CURDATE())";
        }

        $orderBy = "ORDER BY total_jobs DESC";
        $limit = "LIMIT 9999";

        $query = $this->db->query("
            SELECT 
                combined.id AS id,
                combined.company_id AS company_id,
                combined.tech_rep AS tech_rep,
                combined.employee_number AS employee_number,
                combined.email AS email,
                SUM(combined.jobs) AS total_jobs,
                SUM(combined.total) AS total_amount
            FROM (
                SELECT 
                    users.id AS id,
                    users.company_id AS company_id,
                    users.employee_number AS employee_number,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep,
                    users.email as email,
                    COUNT(DISTINCT COALESCE(jobs2.id, jobs3.id, jobs4.id, jobs5.id, jobs6.id)) AS jobs,
                    SUM(COALESCE(job_payments.amount, 0)) AS total
                FROM 
                    users
                    LEFT JOIN jobs jobs2 ON jobs2.employee2_id = users.id 
                    LEFT JOIN jobs jobs3 ON jobs3.employee3_id = users.id
                    LEFT JOIN jobs jobs4 ON jobs4.employee4_id = users.id
                    LEFT JOIN jobs jobs5 ON jobs5.employee5_id = users.id
                    LEFT JOIN jobs jobs6 ON jobs6.employee6_id = users.id
                    LEFT JOIN job_payments ON job_payments.job_id = COALESCE(jobs2.id, jobs3.id, jobs4.id, jobs5.id, jobs6.id)
                WHERE 
                    users.company_id = $companyID AND (
                        (jobs2.status = 'Finished' OR jobs2.status = 'Completed')
                        OR (jobs3.status = 'Finished' OR jobs3.status = 'Completed')
                        OR (jobs4.status = 'Finished' OR jobs4.status = 'Completed')
                        OR (jobs5.status = 'Finished' OR jobs5.status = 'Completed')
                        OR (jobs6.status = 'Finished' OR jobs6.status = 'Completed')
                    ) $filter_by1
                GROUP BY users.id

                UNION ALL

                SELECT 
                    users.id AS id,
                    users.company_id AS company_id,
                    users.employee_number AS employee_number,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep,
                    users.email as email,
                    COUNT(DISTINCT tickets.ticket_no) AS jobs,
                    SUM(COALESCE(tickets.grandtotal, 0)) AS total
                FROM 
                    users
                        LEFT JOIN tickets ON (
                    users.id = SUBSTRING_INDEX(SUBSTRING_INDEX(tickets.technicians, ':\"', -5), '\"', 1) OR
                    users.id = SUBSTRING_INDEX(SUBSTRING_INDEX(tickets.technicians, ':\"', -4), '\"', 1) OR
                    users.id = SUBSTRING_INDEX(SUBSTRING_INDEX(tickets.technicians, ':\"', -3), '\"', 1) OR
                    users.id = SUBSTRING_INDEX(SUBSTRING_INDEX(tickets.technicians, ':\"', -2), '\"', 1) OR
                    users.id = SUBSTRING_INDEX(SUBSTRING_INDEX(tickets.technicians, ':\"', -1), '\"', 1)
                )
                WHERE 
                    users.company_id = $companyID AND (tickets.ticket_status = 'Finished' OR tickets.ticket_status = 'Completed') $filter_by2
                GROUP BY users.id
            ) AS combined
            GROUP BY combined.id
            $orderBy
            $limit
        ");

        $techLeaderBoards = $query->result();    

        $date_range = ['from' => $date_from, 'to' => $date_to];
        $status     = ['Finished', 'Completed'];
        $cid        = logged('company_id');
        $user_tickets = [];
        $tickets = $this->Tickets_model->getAllTicketsByCompanyIdAndDateRange($cid,$date_range,[]);
        foreach( $tickets as $t ){
            $ticketTechs = unserialize($t->technicians);
            if( !empty($ticketTechs) ){
                foreach($ticketTechs as $uid){
                    if( $user_tickets[$uid] ){
                        $user_tickets[$uid]['total_tickets'] = $user_tickets[$uid]['total_tickets'] + 1;
                        $user_tickets[$uid]['total_tickets_sales'] = $user_tickets[$uid]['total_tickets_sales'] + $t->grandtotal;
                    }else{
                        $user_tickets[$uid] = ['total_tickets' => 1, 'total_tickets_sales' => $t->grandtotal];
                    }
                }
            }
        }

        foreach( $techLeaderBoards as $value ){
            if( isset($user_tickets[$value->id]) ){
                $value->total_tickets = $user_tickets[$value->id]['total_tickets'];
                $value->total_amount  = $user_tickets[$value->id]['total_tickets_sales'];
            }else{
                $value->total_tickets = 0;
            }
        }

        $data['techLeaderBoards'] = $techLeaderBoards;
        $this->load->view('v2/widgets/tech_leaderboard_details', $data);
    }

    public function loadTechScorecard()
    {        
        $this->load->model('widgets_model');
        $this->load->model('Users_model');
        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');
        $companyID = logged('company_id');

        $technician = post('filter_by_technician');
        $companyID = logged('company_id');


        $query = $this->db->query("
            SELECT 
                combined.id AS id,
                combined.company_id AS company_id,
                combined.tech_rep AS tech_rep,
                combined.email AS email,
                SUM(combined.jobs) AS total_jobs,
                SUM(combined.total) AS total_amount
            FROM (
                SELECT 
                    users.id AS id,
                    users.company_id AS company_id,
                    CONCAT(users.FName, ' ', users.LName) AS tech_rep,
                    users.email as email,
                    COUNT(DISTINCT COALESCE(jobs2.id, jobs3.id, jobs4.id, jobs5.id, jobs6.id)) AS jobs,
                    SUM(COALESCE(job_payments.amount, 0)) AS total
                FROM 
                    users
                    LEFT JOIN jobs jobs2 ON jobs2.employee2_id = users.id 
                    LEFT JOIN jobs jobs3 ON jobs3.employee3_id = users.id
                    LEFT JOIN jobs jobs4 ON jobs4.employee4_id = users.id
                    LEFT JOIN jobs jobs5 ON jobs5.employee5_id = users.id
                    LEFT JOIN jobs jobs6 ON jobs6.employee6_id = users.id
                    LEFT JOIN job_payments ON job_payments.job_id = COALESCE(jobs2.id, jobs3.id, jobs4.id, jobs5.id, jobs6.id)
                WHERE 
                    users.id = $technician AND (
                        (jobs2.status = 'Finished' OR jobs2.status = 'Completed')
                        OR (jobs3.status = 'Finished' OR jobs3.status = 'Completed')
                        OR (jobs4.status = 'Finished' OR jobs4.status = 'Completed')
                        OR (jobs5.status = 'Finished' OR jobs5.status = 'Completed')
                        OR (jobs6.status = 'Finished' OR jobs6.status = 'Completed')
                    ) 
                GROUP BY users.id
            ) AS combined
            GROUP BY combined.id
        ");

        $techLeaderBoards = $query->result();    

        // var_dump($techLeaderBoards);

        // return;

    

        $data['techLeaderBoards'] = $techLeaderBoards;
        $this->load->view('v2/widgets/tech_scorecard_details', $data);
    }


    public function loadV2SalesLeaderboard()
    {        
        $this->load->model('widgets_model');
        $this->load->model('Users_model');
        $this->load->model('Jobs_model');

        $cid       = logged('company_id');
        $date_from = post('sales_leaderboard_date_from') . ' 00:00:00';
        $date_to   = post('sales_leaderboard_date_to') . ' 23:59:59';

        // $sales_field_user_type = 5;
        // $sales     = $this->Users_model->getCompanyUsersByUserType($cid, $sales_field_user_type);
        $date_range        = ['from' => $date_from, 'to' => $date_to];
        $salesLeaderBoards = $this->Jobs_model->getTotalSalesBySalesRepresentativeV2($cid,$date_range);

        $data['salesLeaderBoards'] = $salesLeaderBoards;   
        $this->load->view('v2/widgets/sales_leaderboard_details', $data);
    }

    public function getOverdueInvoices()
    {
        $this->load->model('widgets_model');
        $comp_id = getLoggedCompanyID();

        $data['invoices'] = $this->widgets_model->getOverdueInvoices($comp_id);
        $this->load->view('widgets/accounting/overdue_invoices_details', $data);
    }

    public function getV2OverdueInvoices()
    {
        $this->load->model('widgets_model');

        $data['invoices'] = $this->widgets_model->getCurrentCompanyOverdueInvoices();
        $this->load->view('v2/widgets/accounting/overdue_invoices_details', $data);
    }

    public function apiGetOverdueInvoices()
    {
        $this->load->model('widgets_model');

        $invoices = $this->widgets_model->getCurrentCompanyOverdueInvoices();
        exit(json_encode(['data' => $invoices]));
    }

    public function getJobTags()
    {
        $this->load->model('widgets_model');
        $data['tags'] = $this->widgets_model->getTags();
        $this->load->view('widgets/tags_details', $data);
    }

    public function getV2JobTags()
    {
        $this->load->model('widgets_model');
        $comp_id = getLoggedCompanyID();
        $GET_TAGS_COUNT = $this->widgets_model->getTagsWithCount($comp_id);
        $REMOVE_ZERO_TAGCOUNT = array();
        for ($i=0; $i < count($GET_TAGS_COUNT); $i++) {
            if ($GET_TAGS_COUNT[$i]->total_job_tags > 0) {
                array_push($REMOVE_ZERO_TAGCOUNT, $GET_TAGS_COUNT[$i]);
            }
        }
        $data['tags'] = $REMOVE_ZERO_TAGCOUNT;
        $this->load->view('v2/widgets/tags_details', $data);
    }

    public function getLeadSource()
    {
        $this->load->model('widgets_model');
        $this->load->model('Event_model');
        $comp_id = logged('company_id');

        $leadSource =$this->Event_model->getCompanyLeadSourceWithCount($comp_id);
        $total_door_knocking = 0;
        foreach( $leadSource as $key => $l ){
            if( $l->lead_source == 'Door Knocking' ){
                $total_door_knocking += $l->leadSourceCount;
            }
        }

        foreach( $leadSource as $key => $l ){
            if( $l->lead_source == 'Door' ){
                $l->leadSourceCount = $l->leadSourceCount + $total_door_knocking;
            }
        }   

        foreach ($leadSource as $ld) :
            $leadNames[] = $ld->lead_name;
            $leadSrc[] = $ld->leadSource;
        endforeach;
        echo json_encode($leadSource);
    }

    /**
     * This function will fetch jobs status with count
     * 
     * @return object List of JOB STATUS with number of count
    */
    public function getLeadSourceCustomer()
    {

    }

    public function removeWidget()
    {
        $this->load->model('widgets_model');
        $id  = post('id');
        $cid = logged('company_id');
        echo $this->widgets_model->removeCompanyWidget($id, $cid);
    }

    public function changeOrder()
    {
        $this->load->model('widgets_model');
        $order = explode(',', post('ids'));
        $isMain = post('isMain');
        $user_id = logged('id');

        $orderCount = 0;
        foreach ($order as $wids) :
            $orderCount++;
            $details = array('wu_order' => $orderCount);
            //print_r($details);
            $this->widgets_model->changeOrder($wids, $user_id, $isMain, $details);
        endforeach;
    }

    public function addToMain()
    {

        $this->load->library('wizardlib');
        $this->load->model('widgets_model');
        $id = post('id');
        $user_id = logged('id');

        if (!$this->wizardlib->isWidgetGlobal($id)) :
            if ($this->widgets_model->addToMain($user_id, $id)) :
                $widget = $this->widgets_model->getWidgetByID($id);
                $data['id'] = $id;
                $data['class'] = 'col-lg-3 col-md-6 col-sm-12';
                $data['height'] = 'height: 310px;';
                if ($wids->w_name === 'Expense') {
                    $data = set_expense_graph_data($data);
                } else if ($wids->w_name === 'Bank') {
                    $data = set_bank_widget_data($data);
                }
                $view = $this->load->view($widget->w_view_link, $data);

                return $view;
            endif;
        endif;
    }

    public function addWidget()
    {

        $this->load->library('wizardlib');
        $this->load->model('widgets_model');

        $id = post('id');
        $isGlobal = post('isGlobal');
        $isMain = post('isMain');
        $user_id = logged('id');

        $idCount = count($this->widgets_model->getWidgetListPerUser($user_id));


        $details = array(
            'wu_user_id' => $user_id,
            'wu_widget_id' => $id,
            'wu_company_id' => $isGlobal,
            'wu_order' => $idCount + 1,
            'wu_is_main' => $isMain
        );
        if (!$this->wizardlib->isWidgetUsed($id)) :
            if (!$this->wizardlib->isWidgetGlobal($id)) :
                if ($this->widgets_model->addWidgets($details, $user_id, $id)) :
                    $widget = $this->widgets_model->getWidgetByID($id);
                    $data['id'] = $id;
                    $data['class'] = 'col-lg-3 col-md-6 col-sm-12';
                    $data['height'] = 'height: 310px;';
                    if ($wids->w_name === 'Expense') {
                        $data = set_expense_graph_data($data);
                    } else if ($wids->w_name === 'Bank') {
                        $data = set_bank_widget_data($data);
                    }
                    $view = $this->load->view($widget->w_view_link, $data);
                    return $view;
                endif;
            endif;
        endif;
    }

    public function addV2Widget()
    {
        $this->load->library('wizardlib');
        $this->load->model('widgets_model');

        $id = post('id');
        $isGlobal = post('isGlobal');
        $isMain   = post('isMain');
        $user_id  = logged('id');
        $cid = logged('company_id');

        $idCount = count($this->widgets_model->getWidgetsByCompanyId($cid));



        $details = array(
            'wu_user_id' => $user_id,
            'wu_widget_id' => $id,
            'wu_company_id' => $cid,
            'wu_order' => $idCount + 1,
            'wu_is_main' => 0
        );

        $isExists = $this->wizardlib->isWidgetUsedByCompany($id, $cid);        
        if (!$isExists) :
            if ($this->widgets_model->addWidgets($details, $user_id, $id)) :
                $widget = $this->widgets_model->getWidgetByID($id);
                $data['class'] = 'nsm-card nsm-grid';
                $data['id'] = $id;
                $data['dynamic_load'] = true;

                if ($widget->w_name === 'Expense') {
                    $data = set_expense_graph_data($data);
                }

                return $this->load->view("v2/" . $widget->w_view_link, $data);
            endif;
        endif;
    }


    public function addV2Thumbnail()
    {
        $this->load->library('wizardlib');
        $this->load->model('widgets_model');
        $this->load->model('General_model', 'general');
        $this->load->model('Demo_model');
        $this->load->model('event_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('invoice_model');
        $this->load->model('Tickets_model', 'tickets_model');
        $this->load->model('estimate_model');

        $id = post('id');
        $isGlobal = post('isGlobal');
        $isMain   = post('isMain');
        $user_id  = logged('id');
        $cid = logged('company_id');

        $idCount = count($this->widgets_model->getWidgetsByCompanyId($cid));


        $details = array(
            'wu_user_id' => $user_id,
            'wu_widget_id' => $id,
            'wu_company_id' => $cid,
            'wu_order' => $idCount + 1,
            'wu_is_main' => 0
        );

        $isExists = $this->wizardlib->isWidgetUsedByCompany($id, $cid);        
        if (!$isExists) :
            if ($this->widgets_model->addWidgets($details, $user_id, $id)) :
                $widget = $this->widgets_model->getWidgetByID($id);

                $data['class'] = 'nsm-card nsm-grid main-widget-container';
                $data['id'] = $id;
                $data['dynamic_load'] = true;
                $data['isMain'] = false;
                $data['subs'] = $this->event_model->getAllsubsByCompanyId($cid);
                $data['leads'] = count($this->customer_ad_model->get_leads_data());
                $data['total_recurring_payment'] = $this->getTotalRecurringPayment();
                $data['companyName'] = $this->tickets_model->getCompany(logged('company_id'));
                $data['expired_estimates'] = $this->estimate_model->getExpiredEstimatesByCompanyId(logged('company_id'));
                $data['estimates'] = $this->estimate_model->getAllOpenEstimatesByCompanyId(logged('company_id'));
                $past_due = $this->widgets_model->getCurrentCompanyOverdueInvoices();

                $nsmart_sales_count = $this->widgets_model->getNsmartSales();
                $nsmart_sales_total = $this->widgets_model->getNsmartSalesTotal();
        
                $data['nsmart_sales_count'] = count($nsmart_sales_count);
                $data['nsmart_sales_total'] = $nsmart_sales_total->total;
           
                $invoices = $this->invoice_model->get_all_company_invoice(logged('company_id'));
                $openInvoices = array_filter($invoices, function ($v, $k) {
                    return !in_array($v->status, ['Draft', 'Declined', 'Paid']);
                }, ARRAY_FILTER_USE_BOTH);
        
                $data['open_invoices'] = $openInvoices;
                $invoices_total_due = 0;
                foreach($past_due as $total_due){
                    $invoices_total_due +=  $total_due->balance;
                }
               $data['invoices_count'] = count($past_due);
               $data['invoices_total_due'] = $invoices_total_due;
               $esign_query = [
                    'where' => ['user_docfile.company_id' => logged('company_id'), 'user_docfile.status !=' => 'Deleted',
                        'user_docfile.unique_key <>' => '', 'user_docfile.company_id >' => 0],
                    'join' => [
                        [
                            'table' => 'acs_profile',
                            'statement' => 'user_docfile.customer_id = acs_profile.prof_id',
                            'join_as' => 'left',
                        ],
                    ],
                    'groupBy' => ['user_docfile.status'],
                    'table' => 'user_docfile',
                    'select' => 'user_docfile.status AS status, COUNT(user_docfile.status) as status_count',
                ];
    
                $data['esign'] = $this->general->get_data_with_param($esign_query);
                $estimate_draft_query = [
                    'where' => ['company_id' => logged('company_id')],
                    'table' => 'estimates',
                    'select' => 'id,status',
                ];
                $data['estimate_draft'] = $this->general->get_data_with_param($estimate_draft_query);
                $collection_query = [
                    'where' => ['company_id' => logged('company_id'), 'status =' => 'Collections'],
                    'table' => 'acs_profile',
                    'select' => 'COUNT(*) as total',
                ];
                $data['collection'] = $this->general->get_data_with_param($collection_query);
                if ($widget->w_name === 'Expense') {
                    $data = set_expense_graph_data($data);
                }

                $payments = $this->invoice_model->get_company_payments(logged('company_id'));
                $deposits = 0;
                foreach ($payments as $payment) {
                    $deposits += floatval($payment->invoice_amount);
                }
                $data['deposits'] = $deposits;

                $demo_schedule_count = $this->Demo_model->getlist();
                $data['demo_schedule_count'] = count($demo_schedule_count);

                return $this->load->view("v2/" . $widget->w_view_link, $data);
            endif;
        endif;
    }

    private function getTotalRecurringPayment()
    {
        $companyId = logged('company_id');
        $this->db->select('SUM(acs_billing.mmr) AS SUM_RECURRING_PAYMENT');
        $this->db->from('acs_billing');
        $this->db->join('acs_alarm', 'acs_billing.fk_prof_id = acs_alarm.fk_prof_id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = acs_alarm.fk_prof_id', 'left');
        $this->db->where("acs_profile.status = 'Installed'");
        $query = $this->db->get();
        $result = $query->row();

        return $result;
 
    }


    public function addV2Widget_old()
    {

        $this->load->library('wizardlib');
        $this->load->model('widgets_model');

        $id = post('id');
        $isGlobal = post('isGlobal');
        $isMain   = post('isMain');
        $user_id  = logged('id');

        $idCount = count($this->widgets_model->getWidgetListPerUser($user_id));


        $details = array(
            'wu_user_id' => $user_id,
            'wu_widget_id' => $id,
            'wu_company_id' => $isGlobal,
            'wu_order' => $idCount + 1,
            'wu_is_main' => $isMain
        );
        if (!$this->wizardlib->isWidgetUsed($id)) :
            if (!$this->wizardlib->isWidgetGlobal($id)) :
                if ($this->widgets_model->addWidgets($details, $user_id, $id)) :
                    $widget = $this->widgets_model->getWidgetByID($id);

                    $data['class'] = 'nsm-card nsm-grid';
                    $data['id'] = $id;
                    $data['dynamic_load'] = true;

                    if ($widget->w_name === 'Expense') {
                        $data = set_expense_graph_data($data);
                    }

                    return $this->load->view("v2/" . $widget->w_view_link, $data);
                endif;
            endif;
        endif;
    }

    public function loadTimesheet()
    {
        $this->load->model('Users_model', 'user_model');
        $this->load->model('timesheet_model');

        $attendance = $this->timesheet_model->getEmployeeAttendance();
        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();
        $logs = $this->timesheet_model->getTimesheetLogs();

        $u_role = null;
        $status = 'fa-times-circle';
        $tooltip_status = 'Not logged in';
        $time_in = null;
        $time_out = null;
        $btn_action = 'employeeCheckIn';
        $disabled = null;
        $break = 'disabled="disabled"';
        $break_id = null;
        $break_in = null;
        $break_out = null;
        $indicator_in = 'display:none';
        $indicator_out = 'display:none';
        $indicator_in_break = 'display:none';
        $indicator_out_break = 'display:none';
        $week_id = null;
        $attn_id = null;
        $yesterday_in = null;
        $yesterday_out = null;
        $clock_in_2nd = 0;
        $out_count = 0;
        $in_count = 0;
        $company_id = 0;
        $counter = 0;
        foreach ($users as $cnt => $user) :
            $counter += 1;

            $user_photo = userProfileImage($user->id);
            $company_id = $user->company_id;
            foreach ($user_roles as $role) {
                if ($role->id == $user->role) {
                    $u_role = $role->title;
                }
            }
            foreach ($attendance as $attn) {
                foreach ($logs as $log) {
                    if ($user->id == $attn->user_id) {
                        $attn_id = $attn->id;
                        if ($attn_id == $log->attendance_id) {
                            if ($log->action == 'Check in') {
                                if (date('Y-m-d', strtotime($log->date_created)) == date('Y-m-d', strtotime('yesterday'))) {
                                    $yesterday_in = "(Yesterday)";
                                } else {
                                    $yesterday_in = null;
                                }
                                $time_in = date('h:i A', strtotime($log->date_created));
                                $time_out = null;
                                $break_in = null;
                                $break_out = null;
                                $btn_action = 'employeeCheckOut';
                                $status = 'fa-check';
                                $break = null;
                                $disabled = null;
                                $break_id = 'employeeBreakIn';
                                $indicator_in = 'display:block';
                                $indicator_out = 'display:none';
                                $indicator_in_break = 'display:none';
                                $indicator_out_break = 'display:none';
                                $tooltip_status = 'Logged in';
                            }
                            if ($log->action == 'Break in') {
                                $break_id = 'employeeBreakOut';
                                $status = 'fa-mug-hot';
                                $break_in = date('h:i A', strtotime($log->date_created));
                                $indicator_in = 'display:none';
                                $indicator_out = 'display:none';
                                $indicator_in_break = 'display:block';
                                $indicator_out_break = 'display:none';
                                $tooltip_status = 'On break';
                                $break_out = null;
                            }
                            if ($log->action == 'Break out') {
                                $status = 'fa-check';
                                $break_out = date('h:i A', strtotime($log->date_created));
                                //                                                                    $break = 'disabled="disabled"';
                                $break_id = 'employeeBreakIn';
                                $indicator_in = 'display:none';
                                $indicator_out = 'display:none';
                                $indicator_in_break = 'display:none';
                                $indicator_out_break = 'display:block';
                                $tooltip_status = 'Back to work';
                            }
                            if ($log->action == 'Check out') {
                                $status = 'fa-times-circle';
                                $btn_action = 'employeeCheckIn';
                                $time_out = date('h:i A', strtotime($log->date_created));
                                $disabled = null;
                                $break = 'disabled="disabled"';
                                $break_id = null;
                                $indicator_in = 'display:none';
                                $indicator_out = 'display:block';
                                $indicator_in_break = 'display:none';
                                $indicator_out_break = 'display:none';
                                $tooltip_status = 'Logged out';
                            }
                        }
                    }
                }
            }
            if ($indicator_in == 'display:block' || $indicator_in_break == 'display:block' || $indicator_out_break == 'display:block') {
                $in_count++;
            }
            if ($indicator_out == 'display:block') {
                $out_count++;
            }
?>
<tr>
    <td>
        <span class="tbl-employee-name"><?php echo $user->FName; ?></span> <span
            class="tbl-employee-name"><?php echo $user->LName; ?></span>
        <span class="tbl-emp-role"><?php echo $u_role; ?></span>
    </td>
    <td class="tbl-chk-in" data-count="<?php echo $in_count ?>">
        <div class="red-indicator" style="<?php echo $indicator_in ?>"></div> <span
            class="clock-in-time"><?php echo $time_in ?></span> <span class="clock-in-yesterday"
            style="display: block;"><?php echo $yesterday_in; ?></span>
    </td>
    <td class="tbl-chk-out" data-count="<?php echo $time_out ?>">
        <div class="red-indicator" style="<?php echo $indicator_out ?>"></div> <span
            class="clock-out-time"><?php echo $time_out ?></span>
    </td>
    <td class="tbl-lunch-in">
        <div class="red-indicator" style="<?php echo $indicator_in_break ?>"></div> <span
            class="break-in-time"><?php echo $break_in; ?></span>
    </td>
    <td class="tbl-lunch-out">
        <div class="red-indicator" style="<?php echo $indicator_out_break ?>"></div> <span
            class="break-out-time"><?php echo $break_out; ?></span>
    </td>
    <!-- <td class="tbl-emp-action">
                    <a href="javascript:void(0)" title="Lunch in/out" data-toggle="tooltip" class="employee-break" id="<?php echo $break_id ?>" <?php echo $break; ?> data-id="<?php echo $user->id ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>"><i class="fa fa-coffee fa-lg"></i></a>
                    <a href="javascript:void(0)" title="Clock in/out" data-toggle="tooltip" class="employee-in-out" <?php echo $disabled ?> id="<?php echo $btn_action; ?>" data-attn="<?php echo $attn_id; ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-id="<?php echo $user->id; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>"><i class="fa fa-user-clock fa-lg"></i></a>
                    <i class="fa <?php echo $status; ?> status" title="<?php echo $tooltip_status; ?>" data-toggle="tooltip"></i>
                </td>
                <td></td> -->
</tr>
<?php
            $u_role = null;
            $status = 'fa-times-circle';
            $tooltip_status = 'Not logged in';
            $time_in = null;
            $time_out = null;
            $btn_action = 'employeeCheckIn';
            $disabled = null;
            $break = 'disabled="disabled"';
            $break_id = null;
            $break_in = null;
            $break_out = null;
            $indicator_in = 'display:none';
            $indicator_out = 'display:none';
            $indicator_in_break = 'display:none';
            $indicator_out_break = 'display:none';
            $week_id = null;
            $attn_id = null;
            $yesterday_in = null;
            $yesterday_out = null;
            ?>
<?php
        endforeach;
    }

    public function loadV2Timesheet()
    {
        $this->load->model('Users_model', 'user_model');
        $this->load->model('timesheet_model');

        $attendance = $this->timesheet_model->getEmployeeAttendance();
        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();
        $logs = $this->timesheet_model->getTimesheetLogs();

        $u_role = null;
        $status = 'fa-times-circle';
        $tooltip_status = 'Not logged in';
        $time_in = null;
        $time_out = null;
        $btn_action = 'employeeCheckIn';
        $disabled = null;
        $break = 'disabled="disabled"';
        $break_id = null;
        $break_in = null;
        $break_out = null;
        $indicator_in = 'display:none';
        $indicator_out = 'display:none';
        $indicator_in_break = 'display:none';
        $indicator_out_break = 'display:none';
        $week_id = null;
        $attn_id = null;
        $yesterday_in = null;
        $yesterday_out = null;
        $clock_in_2nd = 0;
        $out_count = 0;
        $in_count = 0;
        $company_id = 0;
        $counter = 0;
        $user_limit = 20;
        foreach ($users as $cnt => $user) :
            $counter += 1;
            if ($user->status == 1) :
                if ($counter <= $user_limit) :
                    $user_photo = userProfileImage($user->id);
                    $company_id = $user->company_id;
                    foreach ($user_roles as $role) {
                        if ($role->id == $user->role) {
                            $u_role = $role->title;
                        }
                    }
                    foreach ($attendance as $attn) {
                        $logs = $this->timesheet_model->getUserTimesheetLogs($attn->user_id);
                        foreach ($logs as $log) {
                            if ($user->id == $attn->user_id) {
                                $attn_id = $attn->id;
                                if ($attn_id == $log->attendance_id) {
                                    if ($log->action == 'Check in') {
                                        $date_in_logs = $this->timesheet_model->datetime_zone_converter(date('Y-m-d h:i A', strtotime($log->date_created)), "UTC", $this->session->userdata('usertimezone'));
                                        if (date('Y-m-d', strtotime($date_in_logs)) == date('Y-m-d', strtotime('yesterday'))) {
                                            $yesterday_in = "(Yesterday)";
                                        } else {
                                            $yesterday_in = null;
                                        }
                                        $time_in = date('h:i A', strtotime($date_in_logs));
                                        $time_out = null;
                                        $break_in = null;
                                        $break_out = null;
                                        $btn_action = 'employeeCheckOut';
                                        $status = 'fa-check';
                                        $break = null;
                                        $disabled = null;
                                        $break_id = 'employeeBreakIn';
                                        $indicator_in = 'display:block';
                                        $indicator_out = 'display:none';
                                        $indicator_in_break = 'display:none';
                                        $indicator_out_break = 'display:none';
                                        $tooltip_status = 'Logged in';
                                    }
                                    if ($log->action == 'Break in') {
                                        $date_in_logs = $this->timesheet_model->datetime_zone_converter(date('Y-m-d h:i A', strtotime($log->date_created)), "UTC", $this->session->userdata('usertimezone'));
                                        $break_id = 'employeeBreakOut';
                                        $status = 'fa-mug-hot';
                                        $break_in = date('h:i A', strtotime($date_in_logs));
                                        $indicator_in = 'display:none';
                                        $indicator_out = 'display:none';
                                        $indicator_in_break = 'display:block';
                                        $indicator_out_break = 'display:none';
                                        $tooltip_status = 'On break';
                                        $break_out = null;
                                    }
                                    if ($log->action == 'Break out') {
                                        $date_in_logs = $this->timesheet_model->datetime_zone_converter(date('Y-m-d h:i A', strtotime($log->date_created)), "UTC", $this->session->userdata('usertimezone'));
                                        $status = 'fa-check';
                                        $break_out = date('h:i A', strtotime($date_in_logs));
                                        //                                                                    $break = 'disabled="disabled"';
                                        $break_id = 'employeeBreakIn';
                                        $indicator_in = 'display:none';
                                        $indicator_out = 'display:none';
                                        $indicator_in_break = 'display:none';
                                        $indicator_out_break = 'display:block';
                                        $tooltip_status = 'Back to work';
                                    }
                                    if ($log->action == 'Check out') {
                                        $date_in_logs = $this->timesheet_model->datetime_zone_converter(date('Y-m-d h:i A', strtotime($log->date_created)), "UTC", $this->session->userdata('usertimezone'));
                                        $status = 'fa-times-circle';
                                        $btn_action = 'employeeCheckIn';
                                        $time_out = date('h:i A', strtotime($date_in_logs));
                                        $disabled = null;
                                        $break = 'disabled="disabled"';
                                        $break_id = null;
                                        $indicator_in = 'display:none';
                                        $indicator_out = 'display:block';
                                        $indicator_in_break = 'display:none';
                                        $indicator_out_break = 'display:none';
                                        $tooltip_status = 'Logged out';
                                    }
                                }
                            }
                        }
                    }
                    if ($indicator_in == 'display:block' || $indicator_in_break == 'display:block' || $indicator_out_break == 'display:block') {
                        $in_count++;
                    }
                    if ($indicator_out == 'display:block') {
                        $out_count++;
                    }
            ?>
<div class="col-12 mb-2">
    <div class="widget-item timesheet-item">
        <div class="profile-wrapper">
            <div class="profile">
                <span><?php echo getLoggedNameInitials($user->id); ?></span>
            </div>
        </div>
        <div class="content">
            <div class="details">
                <span class="content-title"><?php echo $user->FName; ?> <?php echo $user->LName; ?></span>
                <span class="content-subtitle badge-item"><?php echo $u_role != '' ? $u_role : "---"; ?></span>
            </div>
            <div class="controls">
                <div class="timesheet-group">
                    <div class="timesheet-time" data-count="<?php echo $in_count ?>">
                        <span class="content-subtitle d-block"><span class="timesheet-label">In:
                            </span><?php echo is_null($time_in) ? '--:-- --' : $time_in; ?></span>
                        <span class="content-subtitle d-block"><?php echo $yesterday_in; ?></span>
                    </div>
                    <div class="timesheet-time" data-count="<?php echo $time_out ?>">
                        <span class="content-subtitle d-block"><span class="timesheet-label">Out:
                            </span><?php echo is_null($time_out) ? '--:-- --' : $time_out; ?></span>
                    </div>
                </div>
                <div class="timesheet-group">
                    <div class="timesheet-time">
                        <span class="content-subtitle d-block"><span class="timesheet-label">Lunch In:
                            </span><?php echo is_null($break_in) ? '--:-- --' : $break_in; ?></span>
                    </div>
                    <div class="timesheet-time">
                        <span class="content-subtitle d-block"><span class="timesheet-label">Lunch Out:
                            </span><?php echo is_null($break_out) ? '--:-- --' : $break_out; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
                    $u_role = null;
                    $status = 'fa-times-circle';
                    $tooltip_status = 'Not logged in';
                    $time_in = null;
                    $time_out = null;
                    $btn_action = 'employeeCheckIn';
                    $disabled = null;
                    $break = 'disabled="disabled"';
                    $break_id = null;
                    $break_in = null;
                    $break_out = null;
                    $indicator_in = 'display:none';
                    $indicator_out = 'display:none';
                    $indicator_in_break = 'display:none';
                    $indicator_out_break = 'display:none';
                    $week_id = null;
                    $attn_id = null;
                    $yesterday_in = null;
                    $yesterday_out = null;
                    ?>
<?php
                endif;
            endif;
        endforeach;
    }

    public function quick_start_data()
    {
        $this->page_data['hey'] = 'Test';
        return $this->page_data;
    }

    public function getUpcomingCalendar()
    {
        $this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Estimate_model');
        $this->load->model('Tickets_model');
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');
        $this->load->model('General_model');

        $cid = logged('company_id');
        
        $upcomingJobs   = $this->Jobs_model->getAllUpcomingJobsByCompanyId($cid);       
        $upcomingEvents = $this->Event_model->getAllUpComingEventsByCompanyId($cid);
        $upcomingServiceTickets = $this->Tickets_model->get_upcoming_tickets_by_company_id($cid);
        $scheduledEstimates = $this->Estimate_model->getAllPendingEstimatesByCompanyId($cid);    
        $upcomingAppointments = $this->Appointment_model->getAllUpcomingAppointmentsByCompany($cid);    

        $upcomingSchedules = array();
        foreach( $upcomingJobs as $job ){
            $date_index = date("Y-m-d", strtotime($job->start_date));
            $jobItems = $this->Jobs_model->get_specific_job_items($job->id);
            $total_amount = 0;
            foreach($jobItems as $jt){
                $total_amount += $jt->cost * $jt->qty;
            }

            $get_estimate_query = array(
                'where' => array(
                    'id' => $job->estimate_id
                ),
                'table' => 'estimates',
                'select' => '*'
            );

            $estimate_data = $this->General_model->get_data_with_param($get_estimate_query, false);
            if ($estimate_data) {
                if ($estimate_data->deposit_request == 2) {
                    $deposit_amount = $estimate_data->grand_total * ($estimate_data->deposit_amount / 100);
                } else {
                    $deposit_amount = $estimate_data->deposit_amount;
                }
            }

            $job_total_amount    = ($total_amount + $job->tax_rate) - $deposit_amount;
            $job->invoice_amount = $job_total_amount;
            $upcomingSchedules[$date_index][] = [
                'type' => 'job',
                'data' => $job
            ];
        }

        foreach( $upcomingEvents as $event ){
            $date_index = date("Y-m-d", strtotime($event->start_date));
            $upcomingSchedules[$date_index][] = [
                'type' => 'event',
                'data' => $event
            ];
        }

        foreach( $scheduledEstimates as $estimate ){
            $date_index = date("Y-m-d", strtotime($estimate->estimate_date));

            $total_amount = $estimate->grand_total;
            $estimate->invoice_amount = $total_amount;
            
            $upcomingSchedules[$date_index][] = [
                'type' => 'estimate',
                'data' => $estimate
            ];
        }

        foreach( $upcomingServiceTickets as $ticket ){
            $date_index = date("Y-m-d", strtotime($ticket->ticket_date));
            $upcomingSchedules[$date_index][] = [
                'type' => 'ticket',
                'data' => $ticket
            ];
        }

        foreach( $upcomingAppointments as $appointment ){
            $date_index = date("Y-m-d", strtotime($appointment->appointment_date));
            $appointment_tags = explode(",", $appointment->tag_ids);
            //$appointmentTags = $this->EventTags_model->getAllByIds($appointment_tags);
            $appointmentTags   = $this->Job_tags_model->getAllByIds($appointment_tags);

            $appointment_tags = '';
            $aTags = array();
            foreach($appointmentTags as $tags){
                $aTags[] = $tags->name;
            }

            if( !empty($aTags) ){
                $appointment_tags = implode(",", $aTags);
            }
            
            $appointment->appt_tags = $appointment_tags;
            $upcomingSchedules[$date_index][] = [
                'type' => 'appointment',
                'data' => $appointment
            ];
        }

        ksort($upcomingSchedules);

        $this->page_data['upcomingSchedules'] = $upcomingSchedules;
        $this->load->view('v2/widgets/ajax_load_upcoming_schedules', $this->page_data);
    }

    public function ajax_load_income_stat()
    {
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');

        $cid = logged('company_id');
        $date_from = date("Y-m-d", strtotime(post('sales_leaderboard_date_from')));
        $date_to   = date("Y-m-d", strtotime(post('sales_leaderboard_date_to')));

        $date_range = ['from' => post('filter_date_from'), 'to' => post('filter_date_to')];
        $openInvoices    = $this->Invoice_model->getCompanyOpenInvoices($cid, $date_range);
        $overDueInvoices   = $this->Invoice_model->getCompanyOverDueInvoices($cid, $date_range);
        $totalPaidInvoices = $this->Invoice_model->widgetCompanyTotalAmountPaidInvoices($cid, $date_range);
        
        $subscriptions     = $this->AcsProfile_model->widgetCompanyTotalSubscriptions($cid, $date_range);


        $return = [
            'total_open_invoices' =>  number_format($openInvoices->total, 0, ".", ","),
            'total_overdue_invoices' => number_format($overDueInvoices->total, 0, ".", ","),
            'total_amount_paid_invoices' => number_format($totalPaidInvoices->total_paid, 2, ".", ",") ,
            'total_amount_subscriptions' => number_format($subscriptions->total_subscription, 2, ".", ",")
        ];

        echo json_encode($return);
    }

    public function ajax_load_sales_chart()
    {   
        $this->load->model('Invoice_model');
        $this->load->model('Jobs_model');
        $this->load->model('Tickets_model');
        $this->load->model('Estimate_model');

        $cid  = logged('company_id');
        $year = date("Y");
        $sales_data    = [];
        $jobs_data     = [];
        $services_data = [];
        $chart_labels  = [];
        $start_month   = explode("/", post('filter_date_from'));
        $end_month     = explode("/", post('filter_date_to'));  
        $start = 0;
        $prev_amount = 0;
        for( $start = $start_month[0]; $start <= $end_month[0]; $start++ ){
            $start_date = $year . '-' . $start . '-' . 1;
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date   = date("Y-m-t", strtotime($start_date));

            //$date_range    = ['from' => $start_date, 'to' => $end_date];
            //$totalPaidInvoices = $this->Invoice_model->getCompanyTotalAmountPaidInvoices($cid, $date_range);            
            //$sales_data[]  = number_format($totalPaidInvoices->total_paid, 2, '.', '');

            $date_range    = ['from' => $start_date, 'to' => $end_date];
            $totalInvoices = $this->Invoice_model->getCompanyTotalAmountInvoicesSales($cid, $date_range);
            $totalEstimate = $this->Estimate_model->getCompanyTotalAmountEstimates($cid, $date_range);
            

            if( $start > 0 ){
                $total_sales   = $totalInvoices->total_amount + $totalEstimate->total_amount + $prev_amount;
            }else{
                $total_sales   = $totalInvoices->total_amount + $totalEstimate->total_amount;
            }

            $sales_data[]  = $total_sales;
            $prev_amount   = $total_sales;

            //Jobs
            $jobs = $this->Jobs_model->getAllJobsByCompanyIdAndDateRange($cid, $date_range);
            $total_amount_jobs = 0;
            foreach( $jobs as $j ){
                $total_amount_jobs += (float) $j->amount;
            }
            $jobs_data[] = $total_amount_jobs;

            //Service Tickets
            $serviceTickets = $this->Tickets_model->getAllTicketsByCompanyIdAndDateRange($cid, $date_range, []);
            $total_amount_services = 0;
            foreach($serviceTickets as $st){
                $total_amount_services += (float) $st->grandtotal;
            }
            $services_data[] = $total_amount_services;
            
            
            $chart_month    = date('F', strtotime($start_date));
            $chart_end_day  = date("t", strtotime($start_date));
            //$chart_labels[] = $chart_month . ' 01-'.$chart_end_day;
            $chart_labels[] = $chart_month;

            $start++;
        } 

        $return = ['chart_labels' => $chart_labels, 'chart_data_sales' => $sales_data, 'chart_data_jobs' => $jobs_data, 'chart_data_services' => $services_data];
        echo json_encode($return);
    }

    public function ajax_load_open_estimates_chart()
    {
        $this->load->model('Estimate_model');

        $cid  = logged('company_id');
        $year = date("Y");
        $sales_data   = [];
        $chart_labels = [];
        $start_month  = explode("/", post('filter_date_from'));
        $end_month    = explode("/", post('filter_date_to'));  

        $draft = 0;
        $submitted = 0;
        $accepted = 0;
        $invoiced = 0;
        $lost = 0;
        $declined = 0;
        $cancelled = 0;
        $pending = 0;
        $total_estimates = 0;

        for( $start = $start_month[0]; $start <= $end_month[0]; $start++ ){
            $start_date = $year . '-' . $start . '-' . 1;
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date   = date("Y-m-t", strtotime($start_date));
            $date_range = ['from' => $start_date, 'to' => $end_date];

        

            $estimates  = $this->Estimate_model->getAllByCompanyIdAndDateRange($cid, $date_range);
            foreach($estimates as $estimate){
                switch ($estimate->status){
                    case 'Draft';
                        $draft++;
                        break;
                    case 'Submitted';
                        $submitted++;
                        break;
                    case 'Accepted';
                        $accepted++;
                        break;
                    case 'Invoiced';
                        $invoiced++;
                        break;
                    case 'Lost';
                        $lost++;
                        break;
                    case 'Declined By Customer';
                        $declined++;
                        break;
                    case 'Cancelled';
                        $cancelled++;
                        break;
                    case 'Pending';
                        $pending++;
                        break;
                    default;
                        $other++;
                        break;
                }

                if( $estimate->is_sent == 1 ){
                    $sent++;
                }

                $total_estimates++;
            }
        }

        // $draft_percent = number_format((float)$draft/ (count($total_estimates) ?: 1) ,2,'.','') * 100;
        // $accepted_percent = number_format((float)$accepted/ (count($total_estimates) ?: 1) ,2,'.','') * 100;
        // $invoiced_percent = number_format((float)$invoiced/ (count($total_estimates) ?: 1) ,2,'.','') * 100;
        // $other_percent = number_format((float)$other/ (count($total_estimates) ?: 1) ,2,'.','') * 100;
        // $sent_percent = number_format((float)$sent/ (count($total_estimates) ?: 1) ,2,'.','') * 100;
        
        $draft_percent    = $draft;
        $submitted_precent = $submitted;
        $accepted_percent = $accepted;
        $invoiced_percent = $invoiced;
        $lost_precent = $lost;
        $declined_percent = $declined;
        $cancelled_percent = $cancelled;
        $pending_percent = $pending;
     

        $chart_labels = [
            'Draft',
            'Submitted',
            'Accepted',
            'Invoiced',
            'Lost',
            'Declined By Customer',
            'Cancelled',
            'Pending',
        ];

        $estimates_data = [
            $draft_percent,$submitted_precent,$accepted_percent,$invoiced_percent,$lost_precent,
            $declined_percent,$cancelled_percent,$pending_percent
        ];

        $return = ['chart_labels' => $chart_labels, 'chart_data' => $estimates_data, 'total_estimates' => $total_estimates];
        echo json_encode($return);
    }

    public function ajax_load_paid_invoices_summary()
    {
        $this->load->model('Invoice_model');

        $cid       = getLoggedCompanyID();
        $date_from = post('filter_date_from');
        $date_to   = post('filter_date_to');

        $date_range = ['from' => $date_from, 'to' => $date_to];
        $paidInvoices = $this->Invoice_model->getCompanyPaidInvoices($cid, $date_range);

        $paid_invoices_total_amount = 0;
        $paid_invoices_total_number = 0;
        if( $paidInvoices ){
            foreach($paidInvoices as $inv){
                $paid_invoices_total_amount += (float)$inv->grand_total;
                $paid_invoices_total_number++;
            }
        }

        $return = [
            'paid_invoices_total_amount' => number_format($paid_invoices_total_amount,2,'.',''),
            'paid_invoices_total_number' => $paid_invoices_total_number
        ];

        echo json_encode($return);
    }

    public function ajax_load_service_ticket_chart_data()
    {
        $this->load->model('Tickets_model');

        $cid  = logged('company_id');
        $year = date("Y");

        $total_tickets_amount_data = [];
        $total_tickets_number_data = [];
        $chart_labels = [];

        $start_month  = explode("/", post('filter_date_from'));
        $end_month    = explode("/", post('filter_date_to'));  
        for( $start = $start_month[0]; $start <= $end_month[0]; $start++ ){
            $start_date = $year . '-' . $start . '-' . 1;
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date   = date("Y-m-t", strtotime($start_date));

            //$date_range    = ['from' => $start_date, 'to' => $end_date];
            //$totalPaidInvoices = $this->Invoice_model->getCompanyTotalAmountPaidInvoices($cid, $date_range);            
            //$sales_data[]  = number_format($totalPaidInvoices->total_paid, 2, '.', '');
            $total_service_tickets = 0;
            $total_service_ticket_amount = 0;
            $date_range    = ['from' => $start_date, 'to' => $end_date];
            $serviceTickets = $this->Tickets_model->getAllTicketsByCompanyIdAndDateRange($cid, $date_range);
            if( $serviceTickets ){
                foreach($serviceTickets as $st){
                    $total_service_ticket_amount += (float) $st->grandtotal;
                    $total_service_tickets++;
                }
            }

            $total_tickets_amount_data[] = number_format($total_service_ticket_amount,2, '.', '');
            $total_tickets_number_data[] = $total_service_tickets;                        
            $chart_month    = date('F', strtotime($start_date));
            $chart_end_day  = date("t", strtotime($start_date));
            $chart_labels[] = $chart_month;
        } 

        $return = ['chart_labels' => $chart_labels, 'total_tickets_amount_data' => $total_tickets_amount_data, 'total_tickets_number_data' => $total_tickets_number_data];
        echo json_encode($return);
    }

    public function ajax_load_job_chart_data()
    {
        $this->load->model('Jobs_model');

        $cid  = logged('company_id');
        $year = date("Y");

        $total_jobs_amount_data = [];
        $total_jobs_number_data = [];
        $chart_labels = [];

        $start_month  = explode("/", post('filter_date_from'));
        $end_month    = explode("/", post('filter_date_to'));
        for( $start = $start_month[0]; $start <= $end_month[0]; $start++ ){
            $start_date = $year . '-' . $start . '-' . 1;
            
            //$date_range    = ['from' => $start_date, 'to' => $end_date];
            //$totalPaidInvoices = $this->Invoice_model->getCompanyTotalAmountPaidInvoices($cid, $date_range);            
            //$sales_data[]  = number_format($totalPaidInvoices->total_paid, 2, '.', '');

            $total_jobs = 0;
            $total_jobs_amount = 0;

            $start_date = date($start_month[1] . "-m-d", strtotime($start_date));
            $end_date   = date($end_month[1] . "-m-t", strtotime($start_date));
            $date_range = ['from' => $start_date, 'to' => $end_date];

            //$jobs = $this->Jobs_model->getAllJobsByCompanyIdAndDateRange($cid, $date_range);
            $jobs = $this->Jobs_model->getAllJobsByCompanyIdAndDateRangeV2($cid, $date_range);

            if( $jobs ){
                foreach($jobs as $j){
                    $total_jobs_amount += (float) $j->job_amount;
                    $total_jobs++;
                }
            }

            $total_jobs_amount_data[] = $total_jobs_amount;
            $total_jobs_number_data[] = $total_jobs;                        
            $chart_month    = date('F', strtotime($start_date));
            $chart_end_day  = date("t", strtotime($start_date));
            $chart_labels[] = $chart_month;
        } 

        $return = ['chart_labels' => $chart_labels, 'total_jobs_amount_data' => $total_jobs_amount_data, 'total_jobs_number_data' => $total_jobs_number_data];
        echo json_encode($return);
    }

    public function ajax_load_taskhub_summaryBackup()
    {
        $this->load->model('Taskhub_model');

        $cid     = logged('company_id');
        $user_id = logged('id');

        $date_range['from'] = date("Y-m-d");
        $date_range['to'] = date("Y-m-d");
        $todaysTask   = $this->Taskhub_model->getAllOngoingTasksByCompanyId($cid, $date_range);
        $ongoingTasks = $this->Taskhub_model->getAllOngoingTasksByCompanyId($cid);
        $sharedTasks  = $this->Taskhub_model->getAllOngoingTasksByCompanyId($cid);
        $flaggedTasks = $this->Taskhub_model->getAllByCompanyIdAndPriority($cid, 'Urgent');
        $completedTasks = $this->Taskhub_model->getAllByCompanyIdAndStatus($cid, 'Done');
        $activitiesTasks = $this->Taskhub_model->getAllByCompanyId($cid);

        $totalAssignedTasks = 0;
        foreach($ongoingTasks as $task){
            $assigned_users = json_decode($task->assigned_employee_ids);
            foreach($assigned_users as $uid){
                if( $uid == $user_id ){
                    $totalAssignedTasks++;
                }
            }
        }

        $taskhubSummary = [
            'todaysTask' => count($todaysTask), 
            'sharedTasks' => count($sharedTasks), 
            'flaggedTasks' => count($flaggedTasks),
            'completedTasks' => count($completedTasks),
            'totalAssignedTasks' => $totalAssignedTasks,
            'activitiesTasks' => count($activitiesTasks)
        ];

        echo json_encode($taskhubSummary);
    }    

    public function ajax_load_taskhub_summary()
    {
        $this->load->model('taskhub_model');
        $this->load->model('taskhub_participants_model');
        $this->load->model('taskhub_updates_model');
        //$this->load->model('Taskhub_model');

        /**
         * Todo
         * - total today - ok
         * - total shared - ok
         * - total activities - ok
         * - total flagged - ok
         * - total done - ok
         * - total my task - ok
         */

        $cid     = logged('company_id');
        $user_id = logged('id');

        $date_range['from'] = date("Y-m-d");
        $date_range['to']   = date("Y-m-d");        

		$total_backlog    = $this->taskhub_model->getAllTasksByCompanyIdAndStatus($cid, 'Backlog');
		$total_task_doing = $this->taskhub_model->getAllTasksByCompanyIdAndStatus($cid, 'Doing');
		$total_task_review_fail = $this->taskhub_model->getAllTasksByCompanyIdAndStatus($cid, 'Review Fail');
		$total_task_on_testing  = $this->taskhub_model->getAllTasksByCompanyIdAndStatus($cid, 'On Testing');
		$total_task_review = $this->taskhub_model->getAllTasksByCompanyIdAndStatus($cid, 'Review');
		$total_task_done   = $this->taskhub_model->getAllTasksByCompanyIdAndStatus($cid, 'Done');
		$total_task_closed = $this->taskhub_model->getAllTasksByCompanyIdAndStatus($cid, 'Closed');
        $total_today_task  = $this->taskhub_model->getAllTodayTasksByCompanyId($cid, $date_range);

        $ongoingTasks      = $this->taskhub_model->getAllOngoingUsersTasksByCompanyId($cid);
        $allTasksByCompId  = $this->taskhub_model->getAllTasksByCompanyId($cid);
        $total_urgent_priority_task = $this->taskhub_model->getAllTasksByCompanyIdAndByPriority($cid, 'Urgent');

        $total_my_tasks = 0;
        $total_shared_task = 0;
        $task_ids = array();

        /*$assigned_users = null;
        if($ongoingTasks) {
            foreach($ongoingTasks as $task){
                $array_count    = 0;
                $assigned_users = json_decode($task->assigned_employee_ids);
                if($assigned_users && is_array($assigned_users)) {
                    $array_count = count($assigned_users);
                    foreach($assigned_users as $uid){
                        if( $uid == $user_id ){
                            if($array_count > 1) {
                                $total_shared_task++;
                            }                            
                            $total_my_tasks++;
                        }
                    }
                }
                $task_ids[] = $all_task->task_id;
            }
        }*/
        
        $assigned_users = null;
        if($allTasksByCompId) {
            foreach($allTasksByCompId as $all_task){
                $array_count    = 0;
                $assigned_users = json_decode($all_task->assigned_employee_ids);
                if($assigned_users && is_array($assigned_users)) {
                    $array_count = count($assigned_users);
                    if($array_count > 0) {
                        $total_shared_task++;
                    }                     
                    foreach($assigned_users as $uid){
                        if( $uid == $user_id ){
                            $total_my_tasks++;
                        }
                    }
                }
                $task_ids[] = $all_task->task_id;
            }
        }

        //$task_activities = $this->taskhub_participants_model->getAllByTaskIds($task_ids);  
        $task_activities = $this->taskhub_updates_model->getAllActivityByCompanyId($cid);
        $taskhubSummary = [
            'total_backlog' => count($total_backlog), 
            'total_task_doing' => count($total_task_doing), 
            'total_task_review_fail' => count($total_task_review_fail),
            'total_task_on_testing' => count($total_task_on_testing),
            'total_task_review' => count($total_task_review),
            'total_task_done' => count($total_task_done),
            'total_task_closed' => count($total_task_closed),
            'total_today_task' => count($total_today_task),
            'total_my_tasks' => $total_my_tasks,
            'total_task_flagged' => count($total_urgent_priority_task),
            'total_shared_task' => $total_shared_task,
            'total_task_activities' => count($task_activities)
        ];

        echo json_encode($taskhubSummary);
    }

    public function ajax_load_customer_group_chart()
    {
        $this->load->model('Customer_advance_model');

        $cid  = logged('company_id');
        $this->db->select('customer_groups.id AS id, customer_groups.company_id AS company_id, customer_groups.title AS title_group, COUNT(acs_profile.customer_group_id) AS customer_count, CONCAT(users.FName, " ", users.LName) AS added_by, customer_groups.date_added AS date ');
        $this->db->from('customer_groups');
        $this->db->where('customer_groups.company_id', $cid);
        // $this->db->where_in('acs_profile.status', [
        //     'Active w/RAR',
        //     'Active w/RMR',
        //     'Active w/RQR',
        //     'Active w/RYR',
        //     'Inactive w/RMM'
        // ]);
        $this->db->join('users', 'users.id = customer_groups.user_id', 'left');
        $this->db->join('acs_profile', 'acs_profile.customer_group_id = customer_groups.id', 'left');
        $this->db->group_by('customer_groups.id');
        $data = $this->db->get();
        $customerGroups = $data->result();
        //$customerGroups = $this->Customer_advance_model->widgetCustomerGroupByCompanyId($cid);

        $chart_data   = [];
        $chart_labels = [];

        foreach($customerGroups as $group){
            ///$customers = $this->Customer_advance_model->getAllCustomerByCustomerGroupIdAndCompanyId($group->id, $cid);
            $total     = $group->customer_count;
            $chart_labels[] = $group->title_group . ' ('. number_format($total) .')';
            $chart_data[]   = $total;
            $chart_colors[] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        $return = ['chart_labels' => $chart_labels, 'chart_data' => $chart_data, 'chart_colors' => $chart_colors];
        echo json_encode($return);
    }

    public function ajax_update_sort()
    {
        $this->load->model('Widgets_model');

        $cid   = logged('company_id');
        $post  = $this->input->post();  
        $order = 1;
        foreach( $post['widget'] as $wid ){
            $widgetUser = $this->Widgets_model->getWidgetByCompanyIdAndWidgetId($cid, $wid);
            if( $widgetUser ){
                $data = ['wu_order' => $order];
                $this->Widgets_model->updateUserWidget($widgetUser->wu_id, $data);
                $order++;
            }
        }
    }
}
