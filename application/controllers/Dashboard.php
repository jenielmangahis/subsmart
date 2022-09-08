<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Dashboard extends Widgets {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
		$this->page_data['page']->title = 'Dashboard';
        $this->page_data['page']->parent = 'Dashboard';
        $this->load->library('wizardlib');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Users_model', 'user_model');
        $this->load->model('Feeds_model', 'feeds_model');
        $this->load->model('timesheet_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('users_model');
        $this->load->model('jobs_model');
        $this->load->model('event_model');
        $this->load->model('estimate_model');
        $this->load->model('invoice_model');
        $this->load->model('Crud', 'crud');
        $this->load->model('taskhub_status_model');
        $this->load->model('Activity_model', 'activity');
        $this->load->model('General_model', 'general');
        $this->load->model('Accounting_bank_accounts', 'accounting_bank_accounts');

        add_css(array(
           // 'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            "assets/css/accounting/accounting.css",
            'assets/css/dashboard.css',
            'assets/barcharts/css/chart.min.css',
            'assets/barcharts/css/chart.min.css',
            'assets/fa-5/css/fontawesome.min.css',
            "assets/plugins/dropzone/dist/dropzone.css",
            'assets/fa-5/css/all.min.css',
        ));
        add_header_js(array(
            'assets/barcharts/js/chart.min.js',
            'assets/barcharts/js/utils.js',
            'assets/barcharts/js/chartjs-plugin-labels.js',
            'assets/js/timeago/dist/timeago.min.js',
            
        ));
        add_footer_js(array(
            //'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/dashboard/main.js',
            'assets/ringcentral/config.js',
            'assets/ringcentral/es6-promise.auto.js',
            'assets/ringcentral/fetch.umd.js',
            'assets/ringcentral/pubnub.4.20.1.js',
            'assets/ringcentral/ringcentral.js',
            'assets/ringcentral/rc_authentication.js',
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/modal-forms.js",
            "assets/js/accounting/modal-forms1.js",
        ));
    }
    
    public function sendTestNotify()
    {
        
        $this->load->library('notify');
        $this->load->model('users_model');
        
        $ios_tokens = array();
        //$user_id = logged('id');
        $userDetails = $this->users_model->getUser(62);
        //print_r($userDetails);
        
        $ios_tokens[] = $userDetails->device_token;
        $result = $this->notify->send_ios_push($ios_tokens, 'Feeds - Test', 'This is a sample test notify');
        
        print_r($result);
    }
    
    public function sendFeed()
    {
        $this->load->library('notify');
        $this->load->model('Feeds_model');
        $this->load->model('users_model');
        
        $subject = post('subject');
        $feedMessage = post('message');
        $company_id = logged('company_id');
        $user_id = logged('id');
        $userDetails = $this->users_model->getUser($user_id);
        
        $registrationIds[] = $userDetails->device_token;
        
        $feedDetails = array(
            'sender_id' => $user_id,
            'sender_name' => getLoggedName(),
            'title'         => $subject,
            'message'       => $feedMessage,
            'company_id'    => $company_id
        );
        
        if($this->Feeds_model->saveFeeds($feedDetails)):
            if($userDetails->device_token!="")
                $notifyResult = $this->notify->send_ios_push($registrationIds, 'Feeds - '.$subject, $feedMessage);
            
            $json_response = array('success' => true, 'msg' => 'Successfully Sent');
            array_push($json_response, json_decode($notifyResult));
            
            echo json_encode($json_response);
        endif;
    }
    
    public function sendSMS()
    {
        $this->load->library('Ringcentral');
        $this->ringcentral->sample();
        
    }
    
    
    public function getWidgetList(){
        $this->load->model('widgets_model');
        $user_id = logged('id');
        $this->page_data['widgets'] = $this->widgets_model->getWidgetsList($user_id);
        $this->load->view('v2/widgets/add_widgets_details', $this->page_data);
    }

    public function index() {        
        // load necessary model and functions
        $this->load->model('widgets_model');
        $this->load->helper('functions');
        $this->load->helper('functions_helper');

        $user_id = logged('id');
        $this->page_data['activity_list'] = $this->activity->getActivity($user_id, [6, 0], 0);
        // echo $this->db->last_query(); 
        // echo "<br>";
        $this->page_data['activity_list_count'] = sizeof($this->page_data['activity_list']);
        if ($this->page_data['activity_list_count'] > 5) {
            array_pop($this->page_data['activity_list']);
        }
        $this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6, 0], 1);
        // echo $this->db->last_query();
        $this->page_data['history_activity_list_count'] = sizeof($this->page_data['history_activity_list']);
        if ($this->page_data['history_activity_list_count'] > 5) {
            array_pop($this->page_data['history_activity_list']);
        }
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id', $user_id, "ac_dashboard_sort");
        if (!$check_if_exist) {
            $input = array();
            $input['fk_user_id'] = $user_id;
            $input['ds_values'] = "bulletin,open_estimates,upcoming_job,jobs,sales_leaderbord,tech_leaderbord,tags,lead_source,activities,history,today_stats,taskhub_stats,tasks,income,
                                   expenses,bank_accounts,sales,messages,paid_invoices,lead_stats,overdue_invoices,invoicing,task_stats,plan_setup,discover_more";
            $this->customer_ad_model->add($input, "ac_dashboard_sort");
        }

        $status_arr = array();
        $status_selection = $this->taskhub_status_model->get();
        foreach ($status_selection as $status_selec) {
            $task_status = $this->crud->total_record("tasks", "status_id='" . $status_selec->status_id . "'");
            $status_arr[] = $status_selec->status_text . "@#@" . $task_status;
        }
        
        $companyId = logged('company_id');
        $this->page_data['estimate'] = $this->estimate_model->getAllByCompany(logged('company_id'));

        // if($companyId == 1){
        //     $this->page_data['companies'] = $this->event_model->getCompanies();
        // }else{
        //     $this->page_data['upcomingJobs'] = $this->event_model->getRecentCustomer();
        // }

        $this->page_data['events'] = $this->event_model->get_all_events(5);
        $this->page_data['upcomingEvents'] = $this->event_model->getAllUpComingEventsByCompanyId(logged('company_id'));
        //$this->page_data['jobsStatus']=$this->event_model->getAllJobsByCompanyId(logged('company_id'));
        $this->page_data['upcomingInvoice']=$this->event_model->getAllInvoices();
        $this->page_data['subs']=$this->event_model->getAllsubs();
        //$this->page_data['payment']=$this->event_model->getTodayStats(); // fetch current data sales on jobs , amount is on job_payments.amount
        //$this->page_data['paymentInvoice']=$this->event_model->getAllPInvoices();
        //$this->page_data['paymentInvoices']=$this->event_model->getCollected(); // fetch current data sales on jobs , amount is on job_payments.amount
        //$this->page_data['lostAccounts']=$this->event_model->getAccountSituation('cancel_date'); // lost account count, if Cancel Date Office Info is set
        
        //$this->page_data['collectedAccounts']=$this->event_model->getAccountSituation(); // collection account count, if Collection Date Office Info is set
        //$this->page_data['techLeaderboards']=$this->event_model->getTechLeaderboards(); // fetch Technicians and customer they are assigned to
        //$this->page_data['salesLeaderboards']=$this->event_model->getSalesLeaderboards(); // fetch Sales Rep and customer they are assigned to
        $this->page_data['leadSources']=$this->event_model->getLeadSourceWithCount(); // fetch Lead Sources
        $this->page_data['jobsStatus']=$this->event_model->getJobStatusWithCount(); // fetch Sales Rep and customer they are assigned to\

        $this->page_data['latestJobs']=$this->event_model->getLatestJobs(); // fetch Sales Rep and customer they are assigned to
        //$this->page_data['customerStatus']=$this->event_model->getCustomerStatusWithCount(); // fetch Sales Rep and customer they are assigned to
        $this->page_data['company_id'] = $companyId; // Company ID of the logged in USER

        $this->page_data['jobsDone']= $this->event_model->getAllJobs();
        $this->page_data['salesLeaderboard']=$this->event_model->getSalesLeaderboard();
        $this->page_data['sales']=$this->event_model->getAllSales();
        $this->page_data['mmr']=$this->AcsProfile_model->getCustomerMMR(logged('company_id'));
        $mmr = $this->AcsProfile_model->getCustomerMMR(logged('company_id'));
        $this->page_data['acct_banks']=$this->accounting_bank_accounts->getAllBanks();
        $this->page_data['widgets'] = $this->widgets_model->getWidgetListPerUser($user_id);
        $this->page_data['main_widgets'] = array_filter($this->page_data['widgets'], function($widget){
            return $widget->wu_is_main == true;
        });
        $this->page_data['status_arr'] = $status_arr;

        $datenow = array();
            $sales = array();
            foreach($mmr as $mmrs){
                if(empty($mmrs->bill_start_date)){
                    $start_date = getInstalledDate($mmrs->prof_id, 'acs_office');
                    if(!empty($start_date)){
                    array_push($datenow, $start_date);}
                }else{
                    $start_date = $mmrs->bill_start_date;
                    array_push($datenow, $start_date);
                }
                array_push($sales, $mmrs->mmr);
            }
        $salee = implode(', ', $sales);
        $dt = implode(', ', $datenow);

        // fetch open estimates
        $open_estimate_query = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Submitted','view_flag' => '0'),
            'table' => 'estimates',
            'select' => '*',
        );
        $this->page_data['open_estimates'] = $this->general->get_data_with_param($open_estimate_query);

        // fetch open estimates
        $plans_query = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 1),
            'table' => 'plan_type',
            'select' => 'count(*) as totalPlan',
        );
        $this->page_data['plan_type'] = $this->general->get_data_with_param($plans_query);

        // fetch open estimates
        $estimate_draft_query = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'estimates',
            'select' => 'id,status',
        );
        $this->page_data['estimate_draft'] = $this->general->get_data_with_param($estimate_draft_query);


        // fetch open estimates
        $invoice_draft = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Draft'),
            'table' => 'invoices',
            'select' => 'count(*) as total',
        );
        $this->page_data['invoice_draft'] = $this->general->get_data_with_param($invoice_draft,FALSE);

        // fetch open estimates
        $invoice_due = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Due'),
            'table' => 'invoices',
            'select' => 'count(*) as total',
        );
        $this->page_data['invoice_due'] = $this->general->get_data_with_param($invoice_due,FALSE);


        $invoice_paid_last_30days = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Paid','due_date ' => 'Paid'),
            'table' => 'invoices',
            'select' => 'count(*) as total',
        );
        $this->page_data['invoice_paid_last_30days'] = $this->general->get_data_with_param($invoice_paid_last_30days,FALSE);

        // fetch open estimates
        $total_amount_invoice = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Paid'),
            'table' => 'invoices',
            'select' => 'SUM(grand_total) as total',
        );
        $this->page_data['total_amount_invoice'] = $this->general->get_data_with_param($total_amount_invoice,FALSE);

        // fetch open estimates
        $total_invoice_paid = array(
            'where' => array('company_id' => logged('company_id'), 'status' => 'Paid'),
            'table' => 'invoices',
            'select' => 'count(*) as total',
        );
        $this->page_data['total_invoice_paid'] = $this->general->get_data_with_param($total_invoice_paid,FALSE);

        // get customer subscription history
        $feeds_query = array(
            //'where' => array('company_id' => logged('company_id')),
            'table' => 'feed',
            'select' => '*',
        );
        $this->page_data['feeds'] = $this->general->get_data_with_param($feeds_query);

        // get customer newsletter
        $news_query = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'news',
            'select' => '*',
        );
        $this->page_data['news'] = $this->general->get_data_with_param($news_query);

        $this->page_data['total_recurring_payment'] = $this->getTotalRecurringPayment();    
        $this->page_data['total_agreements_to_expire_in_30_days'] = $this->getAgreementsToExpireIn30Days();

        //Plaid
        $this->load->model('PlaidAccount_model');
        $plaid_handler_open = 0;
        $plaid_token = '';
        $client_name = '';
        $get = $this->input->get();
        if( isset($get['oauth_state_id']) ){
            $plaid_handler_open = 1;                     
            $plaid_token        = $this->session->userdata('plaid_token');

            $plaidAccount = $this->PlaidAccount_model->getByCompanyId($companyId);
            $client_name  = $plaidAccount->client_name;
        }

        $this->page_data['client_name'] = $plaid_token;
        $this->page_data['plaid_token'] = $plaid_token;
        $this->page_data['plaid_handler_open'] = $plaid_handler_open;

        // $this->load->view('dashboard', $this->page_data);
        $this->load->view('dashboard_v2', $this->page_data);
    }

    private function getActiveCustomerStatuses()
    {
        return [
            'draft',
            'installed',
            'active',
            'lead',
            'scheduled',
            'service customer',
        ];
    }

    private function getTotalRecurringPayment()
    {
        $companyId = logged('company_id');
        $this->db->select('SUM(billing.transaction_amount + 0) AS total', false);
        $this->db->from('acs_billing billing');
        $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        $this->db->where('profile.company_id', $companyId);
        $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        $query = $this->db->get();
        $result = $query->row();
        return '$' . number_format($result->total, 2);
    }

    private function getAgreementsToExpireIn30Days()
    {
        $companyId = logged('company_id');
        $this->db->select('COUNT(billing.recurring_end_date) AS total', false);
        $this->db->from('acs_billing billing');
        $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        $this->db->where('profile.company_id', $companyId);
        $this->db->where("STR_TO_DATE(billing.recurring_end_date, '%m/%d/%Y') BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)");
        $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        $query = $this->db->get();
        $result = $query->row();
        return $result->total;
    }

    public function apiGetRecurringPaymentCustomers()
    {
        $companyId = logged('company_id');
        $this->db->select('profile.prof_id, profile.customer_type, profile.business_name, profile.first_name, profile.last_name, profile.email, billing.transaction_amount AS info, profile.phone_m', false);
        $this->db->from('acs_billing billing');
        $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        $this->db->where('profile.company_id', $companyId);
        $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        $query = $this->db->get();
        $results = $query->result();

        foreach ($results as $result) {
            $result->info = '$' . number_format($result->info, 2);
        }

        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }

    public function apiGetAgreementsToExpireIn30DaysCustomers()
    {
        $companyId = logged('company_id');
        $this->db->select('profile.prof_id, profile.customer_type, profile.business_name, profile.first_name, profile.last_name, profile.email, billing.recurring_end_date AS info, profile.phone_m', false);
        $this->db->from('acs_billing billing');
        $this->db->join('acs_profile profile', 'profile.prof_id = billing.fk_prof_id', 'left');
        $this->db->where('profile.company_id', $companyId);
        $this->db->where("STR_TO_DATE(billing.recurring_end_date, '%m/%d/%Y') BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 30 DAY)");
        $this->db->where_in('LOWER(profile.status)', $this->getActiveCustomerStatuses());
        $query = $this->db->get();
        $results = $query->result();

        foreach ($results as $result) {
            $dateTime = DateTime::createFromFormat('m/d/Y', $result->info);
            $dateTimeStr = $dateTime->format('M d, Y');
            $result->info = $dateTimeStr;
        }

        header('content-type: application/json');
        echo json_encode(['data' => $results]);
    }

    public function apiRenameWidget()
    {
        header('content-type: application/json');
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['id' => $widgetId, 'name' => $widgetName] = $payload;
        $companyId = logged('company_id');

        $this->db->where('company_id', $companyId);
        $this->db->where('widget_id', $widgetId);
        $name = $this->db->get('widget_custom_names')->row();

        if ($name) {
            $this->db->where('id', $name->id);
            $this->db->update('widget_custom_names', [
                'name' => $widgetName,
            ]);

        } else {
            $this->db->insert('widget_custom_names', [
                'company_id' => $companyId,
                'widget_id' => $widgetId,
                'name' => $widgetName,
            ]);
        }

        $this->db->where('id', $name ? $name->id : $this->db->insert_id());
        $name = $this->db->get('widget_custom_names')->row();
        echo json_encode(['data' => $name]);
    }

    public function apiGetWidgetNames()
    {


        $widgets = $this->db->get('widgets')->result();

        $companyId = logged('company_id');
        $this->db->where('company_id', $companyId);
        $customNames = $this->db->get('widget_custom_names')->result();

        $customNamesMap = [];
        foreach ($customNames as $customName) {
            $customNamesMap[$customName->widget_id] = $customName;
        }

        foreach ($widgets as $widget) {
            if (array_key_exists($widget->w_id, $customNamesMap)) {
                $widget->custom = $customNamesMap[$widget->w_id];
            }
        }

        header('content-type: application/json');
        echo json_encode(['data' => $widgets]);
    }
    
    public function getInbox(){
        $this->load->view('dashboard/inbox');
    }
    
    public function getSMS(){
        $this->load->view('dashboard/sms');
    }
    
    public function getPhoneCalls(){
        $this->load->view('dashboard/calls');
    }
    
    public function ac_dashboard_sort() {
        //$user_id = logged('id');
        $input = $this->input->post();
        if ($this->customer_ad_model->update_data($input, "ac_dashboard_sort", "acds_id")) {
            echo "Module Sort Updated!";
        } else {
            echo "Error";
        }
    }

    public function blank() {
        $get = $this->input->get();
        $this->page_data['page_name'] = $get['page'];
        $this->load->view('blank', $this->page_data);
    }

    public function saveFeed() {
        postAllowed();

        $comp_id = logged('company_id');

        $id = $this->feeds_model->create([
            'company_id' => $comp_id,
            'customer_id' => post('recipient_id'),
            'subject' => post('feed_subject'),
            'description' => post('feed_description')
        ]);

        $this->activity_model->add('New Feeds Added Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Feed Added Successfully');

        redirect('dashboard');
    }

    public function todays_stats(){
        $payment=$this->event_model->getTodayStats(); // fetch current data sales on jobs , amount is on job_payments.amount
        $paymentInvoices=$this->event_model->getCollected(); // fetch current data sales on jobs , amount is on job_payments.amount
        $jobsDone = $this->event_model->getAllJobs();
        $collectedAccounts =$this->event_model->getAccountSituation(); // collection account count, if Collection Date Office Info is set
        $lostAccounts =$this->event_model->getAccountSituation('cancel_date'); // lost account count, if Cancel Date Office Info is set
        
        $data_arr = array("success" => true,"data" => $payment, "paymentInvoice" => $paymentInvoices, "jobsCompleted" => $jobsDone, "lostAccount" => $lostAccounts, "collectedAccounts" => $collectedAccounts);
        die(json_encode($data_arr));

    }

    public function upcoming_jobs(){
        $companyId = logged('company_id');

        if($companyId == 1){
            $companies = $this->event_model->getCompanies();
        }else{
            $upcomingJobs = $this->event_model->getRecentCustomer();
        }
        $data_arr = array("success" => true, "companies" => $companies, "upcomingJobs" => $upcomingJobs);
        die(json_encode($data_arr));

    }

    public function customer_status(){
        $customerStatus =$this->event_model->getCustomerStatusWithCount(); // fetch Sales Rep and customer they are assigned to
        $data_arr = array("success" => true, "status" => $customerStatus);
        die(json_encode($data_arr));
    }

    public function sales_leaderboard(){
        $salesLeaderboard=$this->event_model->getSalesLeaderboards(); // fetch Sales Rep and customer they are assigned to
        $revenue = [];
        foreach($salesLeaderboard as $sl){
            if(logged('company_id') == 58){
                array_push($revenue, $this->event_model->getSalesRepRevenueSolar($sl->id));
            }else{
                array_push($revenue, $this->event_model->getSalesRepRevenue($sl->id));
            }
        }
        $data_arr = array("success" => true, "salesLeaderboard" => $salesLeaderboard, "revenue" => $revenue);
        die(json_encode($data_arr));
    }

    public function tech_leaderboard(){
        $techLeaderboards=$this->event_model->getTechLeaderboards(); // fetch Technicians and customer they are assigned to
        $revenue = [];
        $customerCount = [];
        foreach($techLeaderboards as $tl){
            if(logged('company_id') == 58){
                array_push($revenue, $this->event_model->getTechRevenueSolar($tl->id));
                array_push($customerCount, $this->event_model->getCustomerCountPerId($tl->id, 'technician'));
            }else{
                array_push($revenue, $this->event_model->getTechRevenue($tl->id));
                array_push($customerCount, $this->event_model->getCustomerCountPerId($tl->id, 'technician'));
            }
        }
        $data_arr = array("success" => true, "techLeaderboard" => $techLeaderboards, "revenue" => $revenue, "customerCount" => $customerCount);
        die(json_encode($data_arr));
    }

    public function jobs_status(){
        //$jobsStatus=$this->event_model->getAllJobsByCompanyId(logged('company_id'));
        $jobsStatus=$this->event_model->getJobStatusWithCount(); // fetch Sales Rep and customer they are assigned to\

        $data_arr = array("success" => true, "jobsStatus" => $jobsStatus);
        die(json_encode($data_arr));
    }
    
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */