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
        $techs = $this->Users_model->getCompanyUsersByUserType($cid, $tech_field_user_type);
        
        //Service Tickets
        $tickets = $this->Tickets_model->get_tickets_by_company_id($cid);
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

        $techLeaderBoards = [];
        $date_range       = ['from' => $date_from, 'to' => $date_to];
        foreach( $techs as $t ){
            $tech_name  = $t->FName . ' ' . $t->LName;
            $jobs = $this->Jobs_model->countAssignedJobsByUserId($t->id , $date_range);    
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

    public function loadV2SalesLeaderboard()
    {        
        $this->load->model('widgets_model');
        $this->load->model('Users_model');
        $this->load->model('Jobs_model');

        $cid       = getLoggedCompanyID();
        $date_from = post('sales_leaderboard_date_from') . ' 00:00:00';
        $date_to   = post('sales_leaderboard_date_to') . ' 23:59:59';

        // $sales_field_user_type = 5;
        // $sales     = $this->Users_model->getCompanyUsersByUserType($cid, $sales_field_user_type);
        $users = $this->Users_model->getCompanyUsers($cid);

        $salesLeaderBoards = [];
        $date_range        = ['from' => $date_from, 'to' => $date_to];
        foreach( $users as $u ){
            $sales = $this->Jobs_model->getTotalSalesBySalesRepresentative($u->id, $date_range);
            if( $sales->total_sales > 0 ){
                $sales_name = $u->FName . ' ' . $u->LName;                
                $salesLeaderBoards[] = ['uid' => $u->id, 'name' => $sales_name, 'email' => $u->email, 'total_sales' => $sales->total_sales];
            }            
        }

        usort($salesLeaderBoards, function($a, $b) {
            return $b["total_sales"] - $a["total_sales"];
        });

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
        $GET_TAGS_COUNT = $this->widgets_model->rawGetTagsWithCount($comp_id);
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
        $user_limit = 7;
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
<div class="col-12">
    <div class="widget-item timesheet-item">
        <div class="nsm-profile">
            <span><?php echo getLoggedNameInitials($user->id); ?></span>
        </div>
        <div class="content">
            <div class="details">
                <span class="content-title"><?php echo $user->FName; ?> <?php echo $user->LName; ?></span>
                <span class="content-subtitle d-block"><?php echo $u_role; ?></span>
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
        $unpaidInvoices    = $this->Invoice_model->getCompanyUnpaidInvoices($cid, $date_range);
        $overDueInvoices   = $this->Invoice_model->getCompanyOverDueInvoices($cid, $date_range);
        $totalPaidInvoices = $this->Invoice_model->getCompanyTotalAmountPaidInvoices($cid, $date_range);
        $subscriptions     = $this->AcsProfile_model->getCompanyTotalSubscriptions($cid, $date_range);

        $totalUnpaidInvoices  = count($unpaidInvoices);
        $totalOverdueInvoices = count($overDueInvoices);

        $return = [
            'total_unpaid_invoices' => $totalUnpaidInvoices,
            'total_overdue_invoices' => $totalOverdueInvoices,
            'total_amount_paid_invoices' => number_format($totalPaidInvoices->total_paid,2,'.',''),
            'total_amount_subscriptions' => number_format($subscriptions->total_subscription,2,'.','')
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
        for( $start = $start_month[0]; $start <= $end_month[0]; $start++ ){
            $start_date = $year . '-' . $start . '-' . 1;
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date   = date("Y-m-t", strtotime($start_date));

            //$date_range    = ['from' => $start_date, 'to' => $end_date];
            //$totalPaidInvoices = $this->Invoice_model->getCompanyTotalAmountPaidInvoices($cid, $date_range);            
            //$sales_data[]  = number_format($totalPaidInvoices->total_paid, 2, '.', '');

            $date_range    = ['from' => $start_date, 'to' => $end_date];
            $totalInvoices = $this->Invoice_model->getCompanyTotalAmountInvoices($cid, $date_range);
            $totalEstimate = $this->Estimate_model->getCompanyTotalAmountEstimates($cid, $date_range);
            $total_sales   = $totalInvoices->total_amount + $totalEstimate->total_amount;
            $sales_data[]  = number_format($total_sales, 2, '.', '');

            //Jobs
            $jobs = $this->Jobs_model->getAllJobsByCompanyIdAndDateRange($cid, $date_range);
            $total_amount_jobs = 0;
            foreach( $jobs as $j ){
                $total_amount_jobs += (float) $j->amount;
            }
            $jobs_data[] = $total_amount_jobs;

            //Service Tickets
            $serviceTickets = $this->Tickets_model->getAllTicketsByCompanyIdAndDateRange($cid, $date_range);
            $total_amount_services = 0;
            foreach($serviceTickets as $st){
                $total_amount_services += (float) $st->grandtotal;
            }
            $services_data[] = $total_amount_services;
            
            
            $chart_month    = date('F', strtotime($start_date));
            $chart_end_day  = date("t", strtotime($start_date));
            //$chart_labels[] = $chart_month . ' 01-'.$chart_end_day;
            $chart_labels[] = $chart_month;
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
        $accepted = 0;
        $invoiced = 0;
        $other = 0;
        $sent  = 0;
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
                    case 'Accepted';
                        $accepted++;
                        break;
                    case 'Invoiced';
                        $invoiced++;
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
        $accepted_percent = $accepted;
        $invoiced_percent = $invoiced;
        $other_percent    = $other;
        $sent_percent     = $sent;

        $chart_labels = [
            'Draft',
            'Accepted',
            'Invoiced',
            'Sent',
            'Others'
        ];

        $estimates_data = [
            $draft_percent,$accepted_percent,$invoiced_percent,$sent_percent,$other_percent
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
            $start_date = date("Y-m-d", strtotime($start_date));
            $end_date   = date("Y-m-t", strtotime($start_date));

            //$date_range    = ['from' => $start_date, 'to' => $end_date];
            //$totalPaidInvoices = $this->Invoice_model->getCompanyTotalAmountPaidInvoices($cid, $date_range);            
            //$sales_data[]  = number_format($totalPaidInvoices->total_paid, 2, '.', '');
            $total_jobs = 0;
            $total_jobs_amount = 0;
            $date_range    = ['from' => $start_date, 'to' => $end_date];
            $jobs = $this->Jobs_model->getAllJobsByCompanyIdAndDateRange($cid, $date_range);
            if( $jobs ){
                foreach($jobs as $j){
                    $total_jobs_amount += (float) $j->amount;
                    $total_jobs++;
                }
            }

            $total_jobs_amount_data[] = number_format($total_jobs_amount,2, '.', '');
            $total_jobs_number_data[] = $total_jobs;                        
            $chart_month    = date('F', strtotime($start_date));
            $chart_end_day  = date("t", strtotime($start_date));
            $chart_labels[] = $chart_month;
        } 

        $return = ['chart_labels' => $chart_labels, 'total_jobs_amount_data' => $total_jobs_amount_data, 'total_jobs_number_data' => $total_jobs_number_data];
        echo json_encode($return);
    }

    public function ajax_load_taskhub_summary()
    {
        $this->load->model('Taskhub_model');

        $cid  = logged('company_id');
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

    public function ajax_load_customer_group_chart()
    {
        $this->load->model('Customer_advance_model');

        $cid  = logged('company_id');
        $customerGroups = $this->Customer_advance_model->getAllSettingsCustomerGroupByCompanyId($cid);

        $chart_data   = [];
        $chart_labels = [];

        foreach($customerGroups as $group){
            $customers = $this->Customer_advance_model->getAllCustomerByCustomerGroupIdAndCompanyId($group->id, $cid);

            $chart_labels[] = $group->title . ' ('. count($customers) .')';
            $chart_data[]   = count($customers); 
            $chart_colors[] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        }

        $return = ['chart_labels' => $chart_labels, 'chart_data' => $chart_data, 'chart_colors' => $chart_colors];
        echo json_encode($return);
    }
}
