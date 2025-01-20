<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Job extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->helper('google_calendar_helper');
        $this->page_data['page']->title = 'Jobs';
        $this->page_data['page']->parent = 'Sales';
        //$this->load->library('paypal_lib');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('JobType_model');
        //$this->load->model('Invoice_model', 'invoice_model');
        //$this->load->model('Roles_model', 'roles_model');
        $this->load->model('General_model', 'general');
        $this->load->model('Items_model', 'items_model');
        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Users_model', 'users_model');
        $this->load->model('PointRatingSystem_model', 'PointRatingSystemModel');
    }

    public function loadStreetView($address = null)
    {
        $this->load->library('wizardlib');
        $addr = ($address == null ? post('address') : $address);
        return $this->wizardlib->getStreetView($addr);
    }

    public function index()
    {
        $this->isAllowedModuleAccess(15);
        $userId = get('user_id');
        $leaderBoardType = get('leader_board_type');

        if (get('job_tag')) {
            $tag_id = get('job_tag');
            $jobs = $this->jobs_model->get_all_jobs_by_tag($tag_id, $userId, $leaderBoardType);
        } else {
            $jobs = $this->jobs_model->get_all_jobs($userId, $leaderBoardType);
        }

        $companyId = logged('company_id');
        $user_id   = logged('id');
        $user_type = logged('user_type');

        $this->db->select('id,name,marker_icon');
        $this->db->where('company_id', $companyId);
        $tagsQuery = $this->db->get('job_tags');
        $this->page_data['tags'] = $tagsQuery->result_array();

        $this->db->select('id, FName, LName');
        $this->db->where('company_id', $companyId);
        $employeesQuery = $this->db->get('users');
        $employees = $employeesQuery->result_array();
        $employees = array_map(function ($employee) {
            $employee['avatar'] = userProfileImage((int) $employee['id']);
            return $employee;
        }, $employees);

        $scheduledJobs  = $this->jobs_model->getAllByCompanyIdAndStatus($companyId, 'Scheduled');
        $pendingJobs   = $this->jobs_model->getAllPendingByCompanyId($companyId);
        $completedJobs = $this->jobs_model->getAllByCompanyIdAndStatus($companyId, 'Completed');
        
        $this->page_data['user_type'] = $user_type;
        $this->page_data['employees'] = $employees;
        $this->page_data['jobs'] = $jobs;
        $this->page_data['title'] = 'Jobs';
        $this->page_data['scheduledJobs'] = $scheduledJobs;
        $this->page_data['pendingJobs'] = $pendingJobs;
        $this->page_data['completedJobs'] = $completedJobs;
        
        $this->load->view('v2/pages/job/list', $this->page_data);
    }

    public function new_job1($id = null)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('CalendarSettings_model');
        $this->load->model('Tickets_model');
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // get all employees
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
        $this->page_data['table'] = 'job';

        // check if settings has been set
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => '*',
        );
        $job_settings = $this->general->get_data_with_param($get_job_settings, false);
        if ($job_settings) {        
            $job_account_next_num = str_pad($job_settings->job_account_next_num, 5, '0', STR_PAD_LEFT);
        } else {
            $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            $job_account_next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            $lastId = $this->jobs_model->getlastInsert($comp_id);
            if ($lastId) {
                $next_num = str_pad($lastId->id, 5, '0', STR_PAD_LEFT);
                $job_account_next_num = str_pad($lastId->id, 5, '0', STR_PAD_LEFT);
            }
        }  

        $default_job_account_number = $comp_id . '-' . $job_account_next_num;
        $this->page_data['default_job_account_number'] = $default_job_account_number;

        $get_sales_rep = array(
            'where' => array(
                'users.company_id' => $comp_id
            ),
            'table' => 'users',
            'distinct' => true,
            'select' => 'users.id, users.FName, users.LName',
            'join' => array(
                'table' => 'acs_office',
                'statement' => 'users.id = acs_office.fk_sales_rep_office',
                'join_as' => 'left',
            ),
        );
        $this->page_data['sales_rep'] = $this->general->get_data_with_param($get_sales_rep);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_tags',
            'select' => 'id,name,marker_icon',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);

        $get_job_types = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_types',
            'select' => 'id,title,icon_marker',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        //default tax
        $default_tax_id = 0;
        $get_job_tax = array(
            'where' => array(
                'company_id' => $comp_id,
                'is_default' => 1
            ),            
            'table' => 'tax_rates',
            'select' => '*',
        );

        $defaultTaxRate = $this->general->get_data_with_param($get_job_tax);                
        if( $defaultTaxRate ){
            $default_tax_id = $defaultTaxRate[0]->id;
        } 
        $this->page_data['default_tax_id'] = $default_tax_id;

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_company_info = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);

        // get items
        // $get_items = array(
        //     'where' => array(
        //         'items.company_id' => $comp_id,
        //         //'is_active' => 1,
        //     ),
        //     'table' => 'items',
        //     'select' => 'items.id,title,price,type',
        // );
        // $items = $this->items_model->getAllItemWithLocation();
        // echo "<pre>";
        // print_r($items);
        // exit;
        $this->page_data['items'] = $this->items_model->getAllItemWithLocation();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
      
        $get_estimates = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'estimates',
            'select' => 'id,estimate_number,estimate_date,job_name,customer_id',
        );
        $this->page_data['estimates'] = $this->general->get_data_with_param($get_estimates);

        // get workorder
        $get_workorder = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'work_orders',
            'select' => 'id,work_order_number,job_name,customer_id,date_created',
        );
        $this->page_data['workorders'] = $this->general->get_data_with_param($get_workorder);

        // get invoices
        $get_invoices = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'invoices',
            'select' => 'id,job_id, job_number,invoice_number,date_issued,job_name,customer_id',
        );
        $this->page_data['invoices'] = $this->general->get_data_with_param($get_invoices);

        $get_settings = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_settings);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $calendarSettings = $this->CalendarSettings_model->getByCompanyId($comp_id);      
        $time_interval = 1;
        if( $calendarSettings && $calendarSettings->time_interval != ''){
            $settingsTime  = explode(" ", $calendarSettings->time_interval);
            $time_interval = $settingsTime[0];
        }   
        $this->page_data['settings'] = unserialize($settings);        
        $this->page_data['time_interval'] = $time_interval;

        $estimate_dp_amount = 0;     
        $default_user_docfile_template_id = 0;   
        if (!$id == null) {
            $jobs_data = $this->jobs_model->get_specific_job($id);

            if( $jobs_data->ticket_id > 0 ){                
                $ticket = $this->Tickets_model->get_tickets_data_one($jobs_data->ticket_id);
                if( $ticket && $ticket->user_docfile_template_id > 0 ){
                    $default_user_docfile_template_id = $ticket->user_docfile_template_id;
                }
            }

            if ($jobs_data->estimate_id > 0) {
                $get_estimate_query = array(
                    'where' => array(
                        'id' => $jobs_data->estimate_id
                    ),
                    'table' => 'estimates',
                    'select' => '*'
                );

                $estimate_data = $this->general->get_data_with_param($get_estimate_query, false);
                if ($estimate_data) {
                    if ($estimate_data->deposit_request == 2) {
                        $estimate_dp_amount = $estimate_data->grand_total * ($estimate_data->deposit_amount / 100);
                    } else {
                        $estimate_dp_amount = $estimate_data->deposit_amount;
                    }
                }
            }

            // get all employees
            $query = array(
                'where' => array(
                    'id' => $jobs_data->created_by
                ),
                'table' => 'users',
                'select' => 'id,FName,LName',
            );
            $created_by = $this->general->get_data_with_param($query, false);            
            $items = $this->jobs_model->get_specific_job_items($id);
            
            $job = $this->jobs_model->get_specific_job($id);
            $defaultJobType = $this->JobType_model->getByTitle($job->job_type);
            $this->page_data['jobs_data'] = $job;
            $this->page_data['jobs_data_items'] = $items;
            $this->page_data['defaultJobType'] = $defaultJobType;

            $this->db->select('id');
            $this->db->where('job_id', $id);
            $jobInvoice = $this->db->get('invoices')->row();
            $this->page_data['job_invoice'] = $jobInvoice;

            if ($this->page_data['jobs_data']) {
                $this->db->select('installation_cost,otp_setup,monthly_monitoring');
                $this->db->where('id', $this->page_data['jobs_data']->work_order_id);
                $workorderQuery = $this->db->get('work_orders');
                $this->page_data['workorder'] = $workorderQuery->row();
            }

            $job_latest_payment = $this->jobs_model->get_latest_job_payment_by_job_id($id);
            $this->page_data['job_latest_payment'] = $job_latest_payment;
        }

        $this->page_data['job_created_by'] = $created_by;

        $default_customer_id = 0;
        $default_customer_name = '';

        if ($this->input->get('cus_id')) {            
            $customer = $this->AcsProfile_model->getByProfId($this->input->get('cus_id'));
            if ($customer) {
                $default_customer_id = $customer->prof_id;
                $default_customer_name = $customer->first_name . ' ' . $customer->last_name;                
            }
            $default_customer_id = $this->input->get('cus_id');
        }

        $this->page_data['title'] = 'Job New';
        $this->page_data['default_customer_id'] = $default_customer_id;
        $this->page_data['default_customer_name'] = $default_customer_name;
        $this->page_data['estimate_dp_amount'] = $estimate_dp_amount;

        add_css([
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        ]);

        add_footer_js([
            'assets/js/esign/fill-and-sign/job/approve.js',
            'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js',
            'https://html2canvas.hertzen.com/dist/html2canvas.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
        ]);

        $default_start_date = date("Y-m-d");
        $default_start_time = '';
        $default_user = 0;
        $redirect_calendar = 0;
        if ($this->input->get('start_date')) {
            $default_start_date = $this->input->get('start_date');
            $redirect_calendar = 1;
        }

        if ($this->input->get('start_time')) {
            $default_start_time = $this->input->get('start_time');
            $redirect_calendar = 1;
        }

        if ($this->input->get('user')) {
            $default_user = $this->input->get('user');
            $redirect_calendar = 1;
        }

        $this->page_data['cid'] = $comp_id;        
        $this->page_data['default_user'] = $default_user;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->page_data['default_start_time'] = $default_start_time;
        $this->page_data['redirect_calendar']  = $redirect_calendar;
        $this->page_data['default_user_docfile_template_id'] = $default_user_docfile_template_id;
        // $this->page_data['TEST_JOB_INFO'] = $this->jobs_model->GET_JOB_INFO($id);
        $this->page_data['getAllLocation'] = $this->items_model->getAllLocation();
        $this->load->view('v2/pages/job/job_new', $this->page_data);
    }

    public function new_job2($id = null)
    {
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // get all employees
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

        // check if settings has been set
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_job_settings);

        // add default event settings if not set
        if (empty($event_settings)) {
            $event_settings_data = array(
                'job_num_prefix' => 'JOB',
                'job_num_next' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'job_settings');
        }

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );

        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);

        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);

        // get items
        $get_items = array(
            'where' => array(
                'is_active' => 1
            ),
            'table' => 'items',
            'select' => 'items.id,title,price,type',
        );
        $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        // get estimates
        $get_estimates = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'estimates',
            'select' => 'id,estimate_number,estimate_date,job_name,customer_id',
        );
        $this->page_data['estimates'] = $this->general->get_data_with_param($get_estimates);

        // get workorder
        $get_workorder = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'work_orders',
            'select' => 'id,work_order_number,job_name,customer_id,date_created',
        );
        $this->page_data['workorders'] = $this->general->get_data_with_param($get_workorder);

        // get invoices
        $get_invoices = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'invoices',
            'select' => 'id,invoice_number,date_issued,job_name,customer_id',
        );
        $this->page_data['invoices'] = $this->general->get_data_with_param($get_invoices);

        $get_settings = array(
            'table' => 'job_tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_settings);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        if (!$id == null) {
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }

        $default_customer_id = 0;
        $default_customer_name = '';

        if ($this->input->get('cus_id')) {
            $this->load->model('AcsProfile_model');
            $customer = $this->AcsProfile_model->getByProfId($this->input->get('cus_id'));
            if ($customer) {
                $default_customer_id = $customer->prof_id;
                $default_customer_name = $customer->first_name . ' ' . $customer->last_name;
            }
            $default_customer_id = $this->input->get('cus_id');
        }
        $this->page_data['title'] = 'Job New';
        $this->page_data['default_customer_id'] = $default_customer_id;
        $this->page_data['default_customer_name'] = $default_customer_name;

        add_css([
            'assets/css/esign/fill-and-sign/fill-and-sign.css',
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        ]);

        add_footer_js([
            'assets/js/esign/fill-and-sign/step1.js',
            'assets/js/esign/fill-and-sign/step2.js',
            'assets/js/esign/fill-and-sign/job/script.js',

            'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js',
            'https://html2canvas.hertzen.com/dist/html2canvas.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',

            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'assets/js/esign/fill-and-sign/step2.js',
        ]);

        //$this->load->view('v2/pages/job/job_new', $this->page_data);
        $this->load->view('job/job_new', $this->page_data);
    }

    public function work_order_job($id = null)
    {
        $this->load->helper('functions');
        $this->load->model('AcsProfile_model');
        $this->load->model('CalendarSettings_model');
        
        $comp_id = logged('company_id');
        $user_id = logged('id');
        
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

        // check if settings has been set
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_job_settings);
        // add default event settings if not set
        if (empty($event_settings)) {
            $event_settings_data = array(
                'job_num_prefix' => 'JOB',
                'job_num_next' => 1,
                'job_account_next_num' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'job_settings');

            $job_account_next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            $lastId = $this->jobs_model->getlastInsert($comp_id);
            if ($lastId) {
                $job_account_next_num = str_pad($lastId->id, 5, '0', STR_PAD_LEFT);
            }
        }else{
            $job_account_next_num = str_pad($event_settings->job_account_next_num, 5, '0', STR_PAD_LEFT);
        }

        $default_job_account_number = $comp_id . '-' . $job_account_next_num;
        $this->page_data['default_job_account_number'] = $default_job_account_number;

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);
        $get_job_types = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);


        $get_company_info = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);

        $get_sales_rep = array(
            'where' => array(
                'users.company_id' => $comp_id
            ),
            'table' => 'users',
            'distinct' => true,
            'select' => 'users.id, users.FName, users.LName',
            'join' => array(
                'table' => 'acs_office',
                'statement' => 'users.id = acs_office.fk_sales_rep_office',
                'join_as' => 'left',
            ),
        );
        $this->page_data['sales_rep'] = $this->general->get_data_with_param($get_sales_rep);

        $get_job_tax = array(
            'where' => array(
                'company_id' => $comp_id                
            ),            
            'table' => 'tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_job_tax);

        // lead source data
        $get_leadsource = array(
            'table' => 'ac_leadsource',
            'select' => '*',
        );
        $this->page_data['lead_source'] = $this->general->get_data_with_param($get_leadsource);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        $this->page_data['items'] = $this->items_model->getAllItemWithLocation();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $calendarSettings = $this->CalendarSettings_model->getByCompanyId($comp_id);      
        $time_interval = 1;
        if( $calendarSettings && $calendarSettings->time_interval != ''){
            $settingsTime  = explode(" ", $calendarSettings->time_interval);
            $time_interval = $settingsTime[0];
        }   
        $this->page_data['settings'] = unserialize($settings);        
        $this->page_data['time_interval'] = $time_interval;

        $this->load->model('workorder_model');
        if ($id != null) {
            $workorder = $this->workorder_model->get_workorder_details($id);
            $this->page_data['workorder'] = $workorder;
            if ($workorder && $workorder->install_time && preg_match("/^([0-9]+)-([0-9]+)$/", trim($workorder->install_time))) {
                $getMeridiem = function ($hour) {
                    $isAM = $hour == '8' || $hour == '10';
                    return $isAM ? 'am' : 'pm';
                };

                $installTimeArray = explode('-', $workorder->install_time);
                $startTime = ($installTimeArray[0] . ':00 ') . $getMeridiem($installTimeArray[0]);
                $endTime = ($installTimeArray[1] . ':00 ') . $getMeridiem($installTimeArray[1]);
                //$this->page_data['jobs_data']->start_time = $startTime;
                //$this->page_data['jobs_data']->end_time = $endTime;
            }

            if ($workorder && !is_numeric($workorder->job_tags)) {
                foreach ($this->page_data['tags'] as $tag) {
                    if ($tag->name == $workorder->job_tags) {
                        $this->page_data['workorder']->tags = $tag->id;
                        break;
                    }
                }
            }

            if (is_numeric($workorder->taxes)) {
                $this->page_data['workorder']->tax_rate = $workorder->taxes;
            }
            
            $items = $this->jobs_model->get_specific_workorder_items($id);
            $this->page_data['workorder_items'] = $items;

            $customer = $this->AcsProfile_model->getByProfId($workorder->customer_id);
            $this->page_data['customer'] = $customer;
            if ($customer) {
                $default_customer_id = $customer->prof_id;
                $default_customer_name = $customer->first_name . ' ' . $customer->last_name;                
            }
            $default_customer_id = $this->input->get('cus_id');
        }
        
        $this->page_data['cid'] = $comp_id;
        $this->page_data['getAllLocation'] = $this->items_model->getAllLocation();
        $this->load->view('v2/pages/job/job_workorder', $this->page_data);
    }

    public function apiGetWorkorderJobItems($id)
    {
        $items = $this->jobs_model->get_specific_workorder_items($id);
        header('content-type: application/json');
        exit(json_encode(['data' => $items]));
    }

    public function estimate_job($id = null)
    {
        $this->load->model('AcsProfile_model');
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // get all employees
        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

        // check if settings has been set
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_job_settings);
        // add default event settings if not set
        if (empty($event_settings)) {
            $event_settings_data = array(
                'job_num_prefix' => 'JOB',
                'job_num_next' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'job_settings');
        }

        $get_sales_rep = array(
            'where' => array(
                'users.company_id' => $comp_id
            ),
            'table' => 'users',
            'distinct' => true,
            'select' => 'users.id, users.FName, users.LName',
            'join' => array(
                'table' => 'acs_office',
                'statement' => 'users.id = acs_office.fk_sales_rep_office',
                'join_as' => 'left',
            ),
        );
        $this->page_data['sales_rep'] = $this->general->get_data_with_param($get_sales_rep);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);
        $get_job_types = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        $get_estimates_item = array(
            'where' => array(
                'company_id' => $comp_id,
                'estimates_id'
            ),
            'table' => 'job_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);


        $get_company_info = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);

        // get items
        $get_items = array(
            'where' => array(
                'items.company_id' => $comp_id,
                //'is_active' => 1,
            ),
            'table' => 'items',
            'select' => 'items.id,title,price,type',
        );
        $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        $get_settings = array(
            'table' => 'job_tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_settings);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        $this->load->model('workorder_model');
        if ($id != null) {
            $get_estimate_query = array(
                'where' => array(
                    'id' => $id
                ),
                'table' => 'estimates',
                'select' => '*'
            );

            $jobs_data = $this->general->get_data_with_param($get_estimate_query, false);

            if ($jobs_data->status != 'Accepted') {
                $this->session->set_flashdata('message', 'Only Accepted estimates can be converted into a job.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
                return redirect('/estimate');
            }


            $default_customer_id = 0;
            $default_customer_name = '';

            $customer = $this->AcsProfile_model->getByProfId($jobs_data->customer_id);
            if ($customer) {
                $default_customer_id   = $customer->prof_id;
                $default_customer_name = $customer->first_name . ' ' . $customer->last_name;
            }

            $jobItems  = $this->jobs_model->get_specific_estimate_items($id);
            $estimate_items = array();
            foreach ($jobItems as $ji) {
                if (isset($estimate_items[$ji->id])) {
                    $estimate_items[$ji->id]->qty = $estimate_items[$ji->id]->qty + $ji->qty;
                } else {
                    $estimate_items[$ji->id] = $ji;
                }
            }

            $this->page_data['estimate_items'] = $estimate_items;
            $this->page_data['default_customer_id'] = $default_customer_id;
            $this->page_data['default_customer_name'] = $default_customer_name;
            $this->page_data['jobs_data'] = $jobs_data;
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_estimate_items($id);
        }


        $this->page_data['table'] = 'estimates';
        add_css([
            'assets/css/esign/fill-and-sign/fill-and-sign.css',
        ]);

        add_footer_js([
            'assets/js/esign/fill-and-sign/step1.js',
            'assets/js/esign/fill-and-sign/step2.js',
            'assets/js/esign/fill-and-sign/job/script.js',

            'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js',
            'https://html2canvas.hertzen.com/dist/html2canvas.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',

            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'assets/js/esign/fill-and-sign/step2.js',
        ]);
        $this->page_data['page']->title = 'Estimates';
        $this->page_data['idd'] = $id;
        $this->load->view('v2/pages/job/job_estimates', $this->page_data);
    }

    public function job_preview($id = null)
    {
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // get all employees
        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_email,street,city,postal_code,state,business_image',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);

        if (!$id == null) {
            $this->page_data['cid'] = $comp_id;
            $this->page_data['latest_job_payment'] = $this->jobs_model->get_latest_job_payment_by_job_id($id);  
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }
        $this->load->view('v2/pages/job/job_preview', $this->page_data);
    }

    public function billing($id = null)
    {
        include APPPATH . 'libraries/braintree/lib/Braintree.php'; 

        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->config->load('api_credentials');

        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        if (!$id == null) {

            $companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($comp_id);
            $braintree_token = '';
            if( $companyOnlinePaymentAccount && ($companyOnlinePaymentAccount->braintree_merchant_id != '' && $companyOnlinePaymentAccount->braintree_public_key != '' && $companyOnlinePaymentAccount->braintree_private_key != '') ){
                $gateway = new Braintree\Gateway([
                    'environment' => BRAINTREE_ENVIRONMENT,
                    'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
                    'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
                    'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
                ]);

                try {
                    $braintree_token = $gateway->ClientToken()->generate();    
                } catch (Exception $e) {
                    $braintree_token = '';   
                }
                
            }

            $this->page_data['braintree_token'] = $braintree_token;

            $jobs_data = $this->jobs_model->get_specific_job($id);
            $jobItems  = $this->jobs_model->get_specific_job_items($id);

            //Deposit Amount
            $deposit_amount = 0;
            if ($jobs_data->estimate_id > 0) {
                $get_estimate_query = array(
                    'where' => array(
                        'id' => $jobs_data->estimate_id
                    ),
                    'table' => 'estimates',
                    'select' => '*'
                );

                $estimate_data = $this->general->get_data_with_param($get_estimate_query, false);
                if ($estimate_data) {
                    if ($estimate_data->deposit_request == 2) {
                        $deposit_amount = $estimate_data->grand_total * ($estimate_data->deposit_amount / 100);
                    } else {
                        $deposit_amount = $estimate_data->deposit_amount;
                    }
                }
            }

            $job_total_amount = 0;
            foreach ($jobItems as $item) {
                $job_total_amount += (((float) $item->cost) * (float) $item->qty);
            }

            $job_total_amount = ($job_total_amount + $jobs_data->tax_rate) - $deposit_amount;

            $get_customer_info = array(
                'where' => array(
                    'prof_id' => $jobs_data->customer_id,
                ),
                'table' => 'acs_profile',
                'select' => 'prof_id,first_name,last_name,mail_add,city,state,city,zip_code,email,phone_m',
            );

            $get_company_info = array(
                'where' => array(
                    'id' => logged('company_id'),
                ),
                'table' => 'business_profile',
                'select' => 'business_phone,business_name,business_email,street,city,postal_code,state,business_image,id',
            );            

            $this->page_data['square_client_id'] = $this->config->item('square_client_id');
            $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);
            $this->page_data['job_total_amount'] = $job_total_amount;
            $this->page_data['profile_info'] = $this->general->get_data_with_param($get_customer_info, false);
            $this->page_data['jobs_data'] = $jobs_data;
            $this->page_data['companyOnlinePaymentAccount'] = $companyOnlinePaymentAccount;
            $this->page_data['page']->title = 'Jobs Billing';
            $this->load->view('v2/pages/job/job_billing', $this->page_data);
            //$this->load->view('job/job_billing_v2', $this->page_data);
        } else {
            redirect('job');
        }
    }

    public function update_payment_details()
    {
        $this->load->helper('user_helper');

        $input   = $this->input->post();
        $updated = 0;

        $is_success = 1;
        $msg = 'Cannot process payment';

        /*echo "<pre>";
        print_r($input);
        exit;*/

        if ($input) {
            $job = $this->jobs_model->get_specific_job($input['jobs_id']);

            $payment_data = array();
            $payment_data['payment_method'] = $input['pay_method'];
            $payment_data['amount']         = $input['job_total_amount'];
            if ($input['pay_method'] == 'CASH') {
                $payment_data['is_collected'] = isset($input['is_collected']) ? 1 : 0;
                $payment_data['is_paid'] = 1;
            } elseif ($input['pay_method'] == 'CHECK') {
                $payment_data['check_number']   = $input['chk_check_number'];
                $payment_data['routing_number'] = $input['chk_routing_number'];
                $payment_data['account_number'] = $input['chk_account_number'];
                $payment_data['is_collected'] = 1;
                $payment_data['is_paid'] = 1;
            } elseif ($input['pay_method'] == 'ACH') {
                $payment_data['check_number']      = $input['chk_check_number'];
                $payment_data['routing_number']    = $input['routing_number'];
                $payment_data['account_number']    = $input['account_number'];
                $payment_data['ach_date_of_month'] = $input['day_of_month'];
                $payment_data['is_collected'] = 1;
                $payment_data['is_paid']      = 1;
            } elseif ($input['pay_method'] == 'VENMO') {
                $payment_data['account_credentials'] = $input['account_credentials'];
                $payment_data['account_note'] = $input['account_note'];
                $payment_data['confirmation'] = $input['confirmation'];
                //$payment_data['ach_date_of_month'] = 0;
                $payment_data['is_collected'] = 1;
                $payment_data['is_paid']      = 1;
            } elseif ($input['pay_method'] == 'HOME_OWNER_FINANCING') {
                $payment_data['account_credentials'] = $input['account_credential'];
                $payment_data['account_note'] = $input['account_note'];
                $payment_data['is_document_signed'] = $input['is_document_signed'];
                //$payment_data['ach_date_of_month'] = 0;
                $payment_data['is_collected'] = 1;
                $payment_data['is_paid']      = 1;
            } elseif ($input['pay_method'] == 'BRAINTREE') {                
                $result = $this->braintree_send_sale($input['job_total_amount'], $input['payment_method_nonce']);
                if ($result['is_success'] == 1) {
                    $payment_data['is_paid'] = 1;
                } else {
                    $is_success = 0;
                    $msg = $result['msg'];
                }
            } elseif ($input['pay_method'] == 'CREDIT_CARD') {
                $converge_data = [
                    'company_id' => $job->company_id,
                    'amount' => $input['job_total_amount'],
                    'card_number' => $input['card_number'],
                    'exp_month' => $input['card_mmyy'],
                    'exp_year' => $input['exp_year'],
                    'card_cvc' => $input['card_cvc'],
                    'address' => $input['mail_add'],
                    'zip' => $input['zip']
                ];
                $result = $this->converge_send_sale($converge_data);
                if ($result['is_success'] == 1) {
                    $payment_data['credit_number']  = $input['card_number'];
                    $payment_data['credit_expiry']  = $input['card_mmyy'] . '/' . $input['exp_year'];
                    $payment_data['credit_cvc']     = $input['card_cvc'];
                    $payment_data['mail_address']   = $input['mail_add'];
                    $payment_data['mail_locality']  = $input['city'];
                    $payment_data['mail_state']     = $input['state'];
                    $payment_data['mail_postcode']  = $input['zip'];
                    $payment_data['is_collected'] = 1;
                    $payment_data['is_paid']      = 1;
                } else {
                    $is_success = 0;
                    $msg = $result['msg'];
                }
            } elseif ($input['pay_method'] == 'INVOICING') {
                $payment_data['invoice_date'] = date('Y-m-d', strtotime($input['invoice_date']));
                $payment_data['invoice_term'] = $input['invoice_term'];
                $payment_data['invoice_due_date'] = date('Y-m-d', strtotime($input['invoice_due_date']));
                $payment_data['is_collected'] = 1;
                $payment_data['is_paid'] = 1;
            } elseif ($input['pay_method'] == 'WARRANTY_WORK') {
                $payment_data['account_credentials'] = $input['account_credential'];
                $payment_data['account_note'] = $input['account_note'];
                $payment_data['is_document_signed'] = $input['is_document_signed'];
                $payment_data['is_collected'] = 1;
                $payment_data['is_paid']      = 1;
            } else {
                $payment_data['is_collected'] = 1;
                $payment_data['is_paid'] = 1;
            }

            if ($is_success == 1) {

                $payment_data['job_id'] = $input['jobs_id'];
                $msg = '';
                $check = array(
                    'where' => array(
                        'job_id' => $input['jobs_id'],
                        'payment_method' => NULL
                    ),
                    'table' => 'job_payments'
                );

                //$updated =  $this->general->add_($payment_data, 'job_payments');

                $exist = $this->general->get_data_with_param($check, false);
                if ($exist) {
                    $updated =  $this->general->update_with_key_field($payment_data, $input['jobs_id'], 'job_payments', 'job_id');
                } else {
                    $updated =  $this->general->add_($payment_data, 'job_payments');
                }

                //Update invoice
                $invoiceCheck = array(
                    'where' => array(
                        'job_id' => $input['jobs_id']
                    ),
                    'table' => 'invoices'
                );
                $invoiceExists = $this->general->get_data_with_param($invoiceCheck,FALSE);
                if( $invoiceExists ){
                    $invoice_data = [
                        'status' => 'Paid'              
                    ];
                    $this->general->update_with_key_field($invoice_data, $input['jobs_id'], 'invoices','job_id');

                    //Update invoice payments
                    $invoicePaymentCheck = array(
                        'where' => array(
                            'invoice_id' => $invoiceExists->id
                        ),
                        'table' => 'invoice_payments'
                    );
                    $invoicePaymentExists = $this->general->get_data_with_param($invoicePaymentCheck,FALSE);
                    if( $invoicePaymentExists ){
                        $invoice_payment_data = [
                            'payment_method' => $payment_data['method'],
                            'is_paid' => 1              
                        ];
                        $this->general->update_with_key_field($invoice_payment_data, $invoicePaymentExists->id, 'invoice_payments','invoice_id');               
                    }

                }
            }
        }

        if ($updated) {
            //SMS Notification
            $comp_id = logged('company_id');
            $job = $this->jobs_model->get_specific_job($input['jobs_id']);
            createCronAutoSmsNotification($comp_id, $input['jobs_id'], 'workorder', 'Completed', $job->employee_id);

            $jobs_data = array();
            $jobs_data['status'] = 'Completed';
            $this->general->update_with_key_field($jobs_data, $input['jobs_id'], 'jobs', 'id');

            //Create Commission
		    createEmployeeCommission($input['jobs_id'], 'job');
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function update_payment_details_cc()
    {
        $input   = $this->input->post();
        $updated = 0;

        $is_success = false;
        $msg = 'Invalid form entry';
        // customer_ad_model
        if ($input) {
            $this->load->model('AcsProfile_model');

            $job = $this->jobs_model->get_specific_job($input['jobs_id']);
            $customer = $this->AcsProfile_model->getByProfId($job->customer_id);

            $converge_data = [
                'company_id' => $job->company_id,
                'amount' => $input['amount'],
                'card_number' => $input['card_number'],
                'exp_month' => $input['card_mmyy'],
                'exp_year' => $input['exp_year'],
                'card_cvc' => $input['card_cvc'],
                'address' => $customer->mail_add,
                'zip' => $customer->zip_code
            ];
            $result = $this->converge_send_sale($converge_data);
            if ($result['is_success']) {
                $payment_data = array();
                $payment_data['payment_method'] = $input['pay_method'];
                $payment_data['is_paid'] = 1;
                    // $payment_data['paid_datetime'] =date("m-d-Y h:i:s");
                ;
                $check = array(
                    'where' => array(
                        'job_id' => $input['jobs_id']
                    ),
                    'table' => 'job_payments'
                );
                $exist = $this->general->get_data_with_param($check, false);
                if ($exist) {
                    $updated =  $this->general->update_with_key_field($payment_data, $input['jobs_id'], 'job_payments', 'job_id');
                } else {
                    $updated =  $this->general->add_($payment_data, 'job_payments');
                }

                if ($updated) {
                    $jobs_data = array();
                    $jobs_data['status'] = 'Completed';
                    $this->general->update_with_key_field($jobs_data, $input['jobs_id'], 'jobs', 'id');

                    //SMS Notification
                    createCronAutoSmsNotification($job->company_id, $input['jobs_id'], 'job', 'Completed', $job->employee_id);
                }

                $is_success = true;
            } else {
                $msg = $result['msg'];
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function converge_send_sale($data)
    {
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = 0;
        $msg = '';

        $comp_id = logged('company_id');
        $convergeCred = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($comp_id);
        if ($convergeCred) {
            $exp_year = date("m/d/" . $data['exp_year']);
            $exp_date = $data['exp_month'] . date("y", strtotime($exp_year));
            $converge = new \wwwroth\Converge\Converge([
                'merchant_id' => $convergeCred->converge_merchant_id,
                'user_id' => $convergeCred->converge_merchant_user_id,
                'pin' => $convergeCred->converge_merchant_pin,
                'demo' => true,
            ]);
            $createSale = $converge->request('ccsale', [
                'ssl_card_number' => $data['card_number'],
                'ssl_exp_date' => $exp_date,
                'ssl_cvv2cvc2' => $data['card_cvc'],
                'ssl_amount' => floatval($data['amount']),
                'ssl_avs_address' => $data['address'],
                'ssl_avs_zip' => $data['zip'],
            ]);

            if ($createSale['success'] == 1) {
                $is_success = 1;
                $msg = '';
            } else {
                $is_success = 0;
                $msg = $createSale['errorMessage'];
            }
        } else {
            $msg = 'Converge account not found';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function send_invoice_preview($id = null)
    {
        //$this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // get all employees
        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);


        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name,business_logo,business_email,street,city,postal_code,state',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);


        if (!$id == null) {
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }
        $this->load->view('job/email_template/invoice', $this->page_data);
    }


    public function send_invoice($id = null)
    {
        //        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        //            echo json_encode(['success' => false]);
        //            return;
        //        }
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: Jobs';

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        //get job data
        $comp_id = logged('company_id');
        $user_id = logged('id');
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name,business_logo,business_email,street,city,postal_code,state',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);


        if (!$id == null) {
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }

        $content = $this->load->view('job/email_template/invoice', $this->page_data, true);
        $mail->Body = 'Lez go';
        $mail->MsgHTML($content);
        $mail->addAddress('welyelfhisula@gmail.com');
        $mail->send();
        $mail->ClearAllRecipients();
        echo json_encode(['success' => true]);
    }

    public function new_job_edit($id)
    {
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

        // get all employees
        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'table' => 'job_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);
        //echo logged('company_id');

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );

        // get company info
        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);

        // get estimates
        $get_estimates = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'estimates',
            'select' => 'id,estimate_number,estimate_date,job_name,customer_id',
        );
        $this->page_data['estimates'] = $this->general->get_data_with_param($get_estimates);

        // get workorder
        $get_workorder = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'work_orders',
            'select' => 'id,work_order_number,start_date,job_name,customer_id',
        );
        $this->page_data['workorders'] = $this->general->get_data_with_param($get_workorder);

        // get invoices
        $get_invoices = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'invoices',
            'select' => 'id,invoice_number,date_issued,job_name,customer_id',
        );
        $this->page_data['invoices'] = $this->general->get_data_with_param($get_invoices);

        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $this->load->view('job/job_new', $this->page_data);
    }

    public function update_jobs_status()
    {
        $input = $this->input->post();

        // customer_ad_model
        if ($input) {
            $id = $input['id'];
            $input['company_id'] = logged('company_id');
            $status = $input['status'];
            if ($input['status'] == "Arrival") {
                $input['omw_date'] = date("Y-m-d");
                $input['omw_time'] = date("H:i A");
            }

            $send_sms = 1;
            if( $input['status'] == 'Approved' ){
                unset($input['status']);
                $send_sms = 0;
            }

            unset($input['id']);
            unset($input['action']);
            $up = $this->general->update_with_key($input, $id, "jobs");

            $input['ticket_status'] = $input['status'];
            if ($input['ticket_status'] == "Started") {
                $input['started_time'] = $input['job_start_time'];
                $input['started_date'] = $input['job_start_date'];
                
                unset($input['job_start_time']);
                unset($input['job_start_date']);
            }

            $ticket_data = array(
                'where' => array(
                    'id' => $id
                ),
                'select' => 'ticket_id',
                'table' => 'jobs'
            );
            unset($input['status']);

            $ticket_id = $this->general->get_data_with_param($ticket_data, FALSE);

            $this->general->update_with_key($input, $ticket_id->ticket_id, "tickets");

            if ($up) {
                //Log audit trail

                $job = $this->jobs_model->get_specific_job($id);
                customerAuditLog(logged('id'), $job->customer_id, $job->id, 'Jobs', 'Updated status of Job #' . $job->job_number . ' to ' . $status);

                if( $send_sms == 1 ){
                    //SMS Notification
                    createCronAutoSmsNotification($job->company_id, $job->id, 'job', $status, $job->employee_id);    
                }
                
                $data_arr = array("success" => true, "message" => "Updated Successfully", "input" => $input);
            } else {
                $data_arr = array("success" => false, "message" => "Something went wrong");
            }
            die(json_encode($data_arr));
        }
    }

    public function on_update_status()
    {
        $id = $_POST['id'];
        $status = $_POST['stat'];

        $input = array();
        $input['status'] = $status;

        if ($this->general->update_with_key($input, $id, "jobs")) {
            echo "Success";
        } else {
            echo "Error";
        }
    }

    public function ajax_create_job_payment()
    {
        $post = $this->input->post();
        $is_success = 0;
        $msg = 'Cannot update data';

        $job = $this->jobs_model->get_specific_job($post['jobid']);
        if ($job) {
            $jobItems  = $this->jobs_model->get_specific_job_items($id);
            $job_total_amount = 0;
            foreach ($jobItems as $item) {
                $job_total_amount += (((float) $item->price) * (float) $item->qty);
            }

            if ($post['payment_method'] == 'PAYPAL') {
                $payment_data['is_collected'] = isset($input['is_collected']) ? 1 : 0;
                $payment_data['is_paid'] = 1;
            }

            $payment_data['payment_method'] = $post['payment_method'];
            $payment_data['amount']         = $job_total_amount;
            $payment_data['job_id']         = $job->id;
            $msg = '';
            $check = array(
                'where' => array(
                    'job_id' => $job->id,
                    'payment_method' => NULL
                ),
                'table' => 'job_payments'
            );

            $exist = $this->general->get_data_with_param($check, false);
            if ($exist) {
                $updated =  $this->general->update_with_key_field($payment_data, $job->id, 'job_payments', 'job_id');
            } else {
                $updated =  $this->general->add_($payment_data, 'job_payments');
            }

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function get_customer_selected()
    {
        $this->load->model('Contacts_model');
        $this->load->model('Customer_advance_model');

        $input = $this->input->post();
        $id = $input['id'];
        $get_customer = array(
            'where' => array(
                'prof_id' => $id
            ),
            'table' => 'acs_profile',
            'select' => 'prof_id,first_name,last_name,middle_name,email,phone_h,phone_m,city,state,mail_add,cross_street,zip_code,mail_add,country,business_name',
        );
        $data = $this->general->get_data_with_param($get_customer, false);

        $contacts = $this->Contacts_model->getAllByCustomerId($id,3);

        $emergency_contact_a = ['firstname' => '', 'lastname' => '', 'relationship' => 'Father', 'phone' => ''];
        $emergency_contact_b = ['firstname' => '', 'lastname' => '', 'relationship' => 'Father', 'phone' => ''];
        $emergency_contact_c = ['firstname' => '', 'lastname' => '', 'relationship' => 'Father', 'phone' => ''];
        $rows = 1;
        foreach( $contacts as $c ){
            if( $rows == 1 ){
                $emergency_contact_a = [
                    'firstname' => $c->first_name,
                    'lastname' => $c->last_name,
                    'relationship' => $c->relation,
                    'phone' => $c->phone
                ];
            }elseif( $rows == 2 ){
                $emergency_contact_b = [
                    'firstname' => $c->first_name,
                    'lastname' => $c->last_name,
                    'relationship' => $c->relation,
                    'phone' => $c->phone
                ];
            }elseif( $rows == 3 ){
                $emergency_contact_c = [
                    'firstname' => $c->first_name,
                    'lastname' => $c->last_name,
                    'relationship' => $c->relation,
                    'phone' => $c->phone
                ];
            }
            $rows++;
        }

        $acsAlarm = $this->Customer_advance_model->getCustomerAlarmData($id);
        if( $acsAlarm ){
            $alarmInfo = ['panel_type' => $acsAlarm->panel_type, 'acct_type' => $acsAlarm->acct_type, 'passcode' => $acsAlarm->passcode];
        }else{
            $alarmInfo = ['panel_type' => '', 'acct_type' => '', 'passcode' => ''];
        }  

        $data_arr = array("success" => true, "data" => $data, 'emergency_contact_a' => $emergency_contact_a, 'emergency_contact_b' => $emergency_contact_b, 'emergency_contact_c' => $emergency_contact_c, 'alarmInfo' => $alarmInfo);
        die(json_encode($data_arr));
        //echo json_encode($this->general->get_data_with_param($get_customer, false), true);
    }

    public function getCustomerInfo($id) {
        echo json_encode($this->jobs_model->getSelectedCustomerInfo($id));
    }

    public function get_esign_selected()
    {
        $id = $_POST['id'];
        $get_template = array(
            'where' => array(
                'esignLibraryTemplateId' => $id
            ),
            'table' => 'esign_library_template',
            'select' => 'content',
        );
        echo json_encode($this->general->get_data_with_param($get_template, false), true);
    }

    public function get_tag_selected()
    {
        $id = $_POST['id'];
        $get_template = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'job_tags',
            'select' => 'name',
        );
        echo json_encode($this->general->get_data_with_param($get_template, false), true);
    }

    public function get_type_selected()
    {
        $id = $_POST['id'];
        $get_template = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'job_types',
            'select' => 'title',
        );
        echo json_encode($this->general->get_data_with_param($get_template, false), true);
    }

    public function save_esign()
    {
        $input = $this->input->post();
        // customer_ad_model
        if ($input) {
            $id = $input['id'];
            unset($input['id']);
            if ($this->general->update_with_key($input, $id, "jobs_approval")) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
        echo date("d-m-Y h:i A");
    }

    public function get_item_storage_location()
    {
        $id = $_POST['id'];
        $get_item_location = array(
            'where' => array(
                'item_id' => $id,
                'qty !=' => null,
            ),
            'table' => 'items_has_storage_loc',
            'select' => 'id,name,qty',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        echo json_encode($this->general->get_data_with_param($get_item_location), true);
    }

    public function get_selected_item()
    {
        $id = $_POST['id'];
        $get_item = array(
            'where' => array(
                'id' => $id,
            ),
            'table' => 'items',
            'select' => 'brand,description',
        );
        echo json_encode($this->general->get_data_with_param($get_item, false), true);
    }

    public function get_customers()
    {
        $comp_id = logged('company_id');

        $get_customer = array(
            'table' => 'acs_profile',
            'select' => 'prof_id,first_name,last_name,middle_name',
            'where'  => array(
                'company_id' => $comp_id
            ),
            'order' => array(
                'order_by' => 'first_name',
                'ordering' => 'ASC',
            ),
        );
        $data = $this->general->get_data_with_param($get_customer);
        $data_arr = array("data" => $data, "message" => "success");
        echo json_encode($data_arr);
    }

    public function get_esign_template()
    {
        $get_esign_template = array(
            'where' => array(
                'category_id' => 26, // 26 = category id of Jobs template in esign_library_category table
                'isActive' => 1
            ),
            'table' => 'esign_library_template',
            'select' => 'esignLibraryTemplateId,title,content',
        );
        echo json_encode($this->general->get_data_with_param($get_esign_template), true);
    }

    public function job_tags()
    {
        $this->load->model('Icons_model');
        
        $this->page_data['page']->title = 'Job Tags';
        $this->page_data['page']->parent = 'Sales';

        $get_job_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_tags',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );

        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->page_data['job_tags'] = $this->general->get_data_with_param($get_job_settings);
        $this->load->view('v2/pages/job/job_tags', $this->page_data);
    }

    public function job_types()
    {
        $this->load->model('Icons_model');

        $this->hasAccessModule(26);
        $this->page_data['page']->title = 'Job Types';
        $this->page_data['page']->parent = 'Sales';

        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id'),
                'status' => 1
            ),
            'table' => 'job_types',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );

        $icons = $this->Icons_model->getAll();
        $this->page_data['icons'] = $icons;
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);
        $this->load->view('v2/pages/job/job_types', $this->page_data);
    }

    public function bird_eye_view()
    {
        $this->page_data['title'] = 'Bird Eye View';
        $this->load->view('job/job_settings/bird_eye_view', $this->page_data);
    }

    public function delete_tag()
    {
        $this->load->model('JobTags_model');
        $company_id = logged('company_id');

        $remove_tag = array(
            'where' => array(
                'id' => $_POST['tag_id']
            ),
            'table' => 'job_tags'
        );

        $jobTag = $this->JobTags_model->getByIdAndCompanyId($_POST['tag_id'], $company_id);
        if ($this->general->delete_($remove_tag)) {
            
            //Activity Logs
            $activity_name = 'Deleted Job Tag '.$jobTag->name; 
            createActivityLog($activity_name);
            echo '1';
        }
    }

    public function delete_job_type()
    {
        $remove_jobtype = array(
            'where' => array(
                'id' => $_POST['type_id']
            ),
            'table' => 'job_types'
        );

        $jobType = $this->JobType_model->getById($_POST['type_id']);

        if ($this->general->delete_($remove_jobtype)) {
            //Activity Logs
            $activity_name = 'Deleted Job Type '.$jobType->title; 
            createActivityLog($activity_name);

            echo '1';
        }
    }

    public function delete_tax_rate()
    {
        $remove_tax_rate = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'tax_rates'
        );
        if ($this->general->delete_($remove_tax_rate)) {
            echo '1';
        }
    }

    public function delete_job()
    {
        $user_login = logged('FName') . ' ' . logged('LName');
        $remove_job = array(
            'where' => array(
                'id' => $_POST['job_id'],
            ),
            'table' => 'jobs'
        );
        //Get Job
        $cid = logged('company_id');
        $job = $this->jobs_model->get_specific_job($_POST['job_id']);
        if ($job && $job->company_id == $cid) {
            //if ($this->general->delete_($remove_job)) {
                $data = ['is_archived' => 1, 'archived_date' => date("Y-m-d H:i:s")];
                $this->jobs_model->update($job->id, $data);

                // Point Rating System delete / set status = 0 data action
                $this->PointRatingSystemModel->deletePointRating($cid, $job->id, "job");

                // Record Job delete to Customer Activities Module in Customer Dashboard
                $action = "$user_login deleted a job. $job->job_number";

                $customerLogPayload = array(
                    'date' => date('m/d/Y')."<br>".date('h:i A'),
                    'customer_id' => $job->customer_id,
                    'user_id' => logged('id'),
                    'logs' => "$action"
                );

                $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogPayload);

                //Activity Logs
                $activity_name = 'Jobs : Deleted Job Number ' . $job->job_number; 
                createActivityLog($activity_name);

                customerAuditLog(logged('id'), $job->customer_id, $job->id, 'Jobs', 'Deleted Job #' . $job->job_number);
                echo '1';
            //}
        }
    }

    public function add_tag()
    {
        $input = $this->input->post();
        $input['company_id'] =  logged('company_id');
        if ($this->general->add_($input, "job_tags")) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function add_job_type()
    {
        $input = $this->input->post();
        $input['company_id'] =  logged('company_id');
        $input['status'] =  1;
        $input['user_id'] =  logged('id');
        if ($this->general->add_($input, "job_types")) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function add_tax_rate()
    {
        $input = $this->input->post();
        $input['company_id'] =  logged('company_id');
        $input['is_default'] = ($input['DEFAULT_TAXRATE'] == "true") ? 1 : 0;
        $data = array(
            'name' =>  $input['name'],
            'rate' =>  $input['rate'],
            'is_default' =>  $input['is_default'],
            'company_id' =>  $input['company_id'],
        );

        $INSERT = $this->jobs_model->recordTaxRate("add", $data);
        if ($INSERT) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function update_tax_rate()
    {
        $is_success = 0;
        $msg = "";
        $input = $this->input->post();
        $input['company_id'] =  logged('company_id');
        $input['is_default'] = ($input['UPDATE_DEFAULT_TAXRATE'] == "true") ? 1 : 0;
        $data = array(
            'id' =>  $input['tid'],
            'name' =>  $input['tax_name'],
            'rate' =>  $input['tax_rate'],
            'is_default' =>  $input['is_default'],
            'company_id' =>  $input['company_id'],
        );

        $UPDATE = $this->jobs_model->recordTaxRate("update", $data);
        // if ($UPDATE) {
        //     echo "1";
        // } else {
        //     echo "0";
        // }

        // $get_tax_rate = array(
        //     'where' => array(
        //         'id' => $input['tid']
        //     ),
        //     'table' => 'tax_rates',
        //     'select' => '*',
        // );
        // $taxRate = $this->general->get_data_with_param($get_tax_rate, false);
        // if ($taxRate) {
        //     $data = ['name' => $input['tax_name'], 'rate' => $input['tax_rate'], 'is_default' => 0];
        //     $this->general->update_with_key_field($data, $input['tid'], 'tax_rates', 'id');

        //     $is_success = 1;
        // } else {
        //     $msg = 'Cannot find data';
        // }

        $json_data = ['is_success' => 1, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function add_job_attachments()
    {
        if (0 < $_FILES['file']['error']) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            $uniquesavename = time() . uniqid(rand());
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $destination = 'uploads/jobs/attachment/' . $uniquesavename . '.' . $ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);
            $sourceFile = $_SERVER['DOCUMENT_ROOT'] . '/' . $destination;
            //$content = file_get_contents($sourceFile,FILE_USE_INCLUDE_PATH);
            echo $destination;
        }
    }

    public function settings()
    {
        $this->page_data['page']->title = 'Job Settings';
        $this->page_data['page']->parent = 'Sales';

        $comp_id = logged('company_id');
        //$this->page_data['invoices'] = $this->invoice_model->getByWhere(['company_id' => $comp_id]);
        $input = $this->input->post();
        if ($input) {
            strtoupper($input['job_num_prefix']);
            $this->general->update_with_key_field($input, $comp_id, 'job_settings', 'company_id');
        }

        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => '*',
        );

        $job_settings = $this->general->get_data_with_param($get_job_settings, false);
        if ($job_settings) {
            $prefix   = $job_settings->job_num_prefix;
            $next_num = str_pad($job_settings->job_num_next, 5, '0', STR_PAD_LEFT);
            $job_account_next_num = str_pad($job_settings->job_account_next_num, 5, '0', STR_PAD_LEFT);
        } else {
            $prefix   = 'JOB-';
            $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            $job_account_next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            $lastId = $this->jobs_model->getlastInsert($comp_id);
            if ($lastId) {
                $next_num = str_pad($lastId->id, 5, '0', STR_PAD_LEFT);
                $job_account_next_num = str_pad($lastId->id, 5, '0', STR_PAD_LEFT);
            }
        }      

        $this->page_data['settings_prefix'] = $prefix;
        $this->page_data['settings_next_num'] = $next_num;
        $this->page_data['comp_id'] = $comp_id;
        $this->page_data['settings_job_account_next_num'] = $job_account_next_num;
        $this->page_data['job_settings'] = $this->general->get_data_with_param($get_job_settings, false);

        $get_job_tax = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            // 'or_where' => ['is_default' => 1],
            'table' => 'tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_job_tax);
        $this->page_data['active_tab'] = $this->uri->segment(3);

        $this->load->view('v2/pages/job/settings', $this->page_data);
    }

    public function job_time_settings()
    {
        $get_job_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_tags',
            'select' => '*',
        );
        $this->page_data['title'] = 'Job Time Settings';
        $this->load->view('job/job_settings/job_time_settings', $this->page_data);
    }


    // public function testController() {
    //      $getEmployeePayscalePayload = array(
    //         'select' => 'jobtypebase_amount',
    //         'table' => 'jobs',
    //         'where' => array(
    //             'id' => 1058,
    //         )
    //     );
    //     $getEmployeePayscaleInfo = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
    //     $jobtypebase_amount = json_decode($getEmployeePayscaleInfo->jobtypebase_amount, true);

    //     echo "<pre>";
    //     print_r ($jobtypebase_amount);
    //     echo "</pre>";
    // }


    public function save_job()
    {
        $this->load->helper(array('hashids_helper'));
        $this->load->model('JobTags_model');
        $this->load->model('JobSettings_model');
        $user_login = logged('FName') . ' ' . logged('LName');
        $is_success = 1;
        $msg = '';

        $input = $this->input->post();
        $comp_id = logged('company_id');

        // Point Rating System set data into variables
        $point = 1;
        $employee_type = "tech_rep";
        $module = "job";
        $employee_ids = [
            $input['employee2_id'],
            $input['employee3_id'],
            $input['employee4_id'],
            $input['employee5_id'],
            $input['employee6_id'],
        ]; 

        if ($input['item_name'] == null) {
            $is_success = 0;
            $msg = 'Please select an item';
        }

        if ($input['total_amount'] <= 0) {
            $is_success = 0;
            $msg = 'Cannot accept job having 0 amount';
        }

        $is_update = 0;

        if ($is_success == 1) {
            $check_job = array(
                'where' => array(
                    'hash_id' => $input['job_hash']
                ),
                'table' => 'jobs',
                'select' => 'job_number, id, work_order_id'
            );
            $isJob = $this->general->get_data_with_param($check_job, false);

            if (!empty($isJob)) {
                $job_number = $isJob->job_number;
                $job_workorder_id = $isJob->work_order_id;
                $job_account_number = $isJob->job_account_number;
                $is_update = 1;
            } else {
                $get_job_settings = array(
                    'where' => array(
                        'company_id' => $comp_id
                    ),
                    'table' => 'job_settings',
                    'select' => '*',
                );
                $job_settings = $this->JobSettings_model->getJobSettingByCompanyId($comp_id);
                if ($job_settings) {
                    $prefix   = $job_settings->job_num_prefix;
                    $next_num = $job_settings->job_num_next;
                    $account_next_num = $job_settings->job_account_next_num;
                } else {
                    $prefix = 'JOB-';
                    $lastId = $this->jobs_model->getLastInsertByCompanyId($comp_id);                    
                    if ($lastId) {
                        $next_num = $lastId->id + 1;
                        $account_next_num = $lastId->id + 1;
                    } else {
                        $next_num = 1;
                        $account_next_num = 1;
                    }
                }
                
                $job_number       = $prefix . str_pad($next_num, 5, '0', STR_PAD_LEFT);
                $job_account_number = $comp_id . '-' . $account_next_num;
                $job_workorder_id = $input['work_order_id'] != NULL ? $input['work_order_id'] : 0;
            }

            $jobTag = $this->JobTags_model->getById($input['job_tag']);
            $estimate_id = 0;
            if ($input['estimate_id'] > 0) {
                $estimate_id = $input['estimate_id'];
            }

            $get_customer_info = array(
                'where' => array(
                    'prof_id' => $input['customer_id'],
                ),
                'table' => 'acs_profile',
                'select' => 'prof_id,first_name,last_name,mail_add,city,state,city,zip_code,email,phone_m',
            );
            $customer = $this->general->get_data_with_param($get_customer_info, false);

            $job_location = $customer->mail_add;


            // Job Type Base Amount Implementation
            $jobtypebase_amount;
            if ($input['job_type'] == "Install" || $input['job_type'] == "Service") {
                $jobtypebase_amount = array();
                if ($input['employee_id'] !== 0 || $input['employee_id'] !== "") {
                    $getEmployeePayscalePayload = array(
                        'select' => 'users.id, users.payscale_id, payscale.payscale_name, users.jobtypebase_amount',
                        'table' => 'users',
                        'join' => array(
                            'table' => 'payscale',
                            'statement' => 'users.payscale_id = payscale.id',
                            'join_as' => 'left'
                        ),
                        'where' => array(
                            'users.id' => $input['employee_id'],
                            'payscale.payscale_name' => "Job Type Base (Install/Service)"
                        )
                    );
                    $getEmployeePayscaleInfo    = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                    
                    if ($getEmployeePayscaleInfo) {
                        $jobtypebase_amount[$input['employee_id']] = $getEmployeePayscaleInfo->jobtypebase_amount;
                    }
                }
                if ($input['employee2_id'] !== 0 || $input['employee2_id'] !== "") {
                    $getEmployeePayscalePayload = array(
                        'select' => 'users.id, users.payscale_id, payscale.payscale_name, users.jobtypebase_amount',
                        'table' => 'users',
                        'join' => array(
                            'table' => 'payscale',
                            'statement' => 'users.payscale_id = payscale.id',
                            'join_as' => 'left'
                        ),
                        'where' => array(
                            'users.id' => $input['employee2_id'],
                            'payscale.payscale_name' => "Job Type Base (Install/Service)"
                        )
                    );
                    $getEmployeePayscaleInfo    = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                    
                    if ($getEmployeePayscaleInfo) {
                        $jobtypebase_amount[$input['employee2_id']] = $getEmployeePayscaleInfo->jobtypebase_amount;
                    }
                }
                if ($input['employee3_id'] !== 0 || $input['employee3_id'] !== "") {
                    $getEmployeePayscalePayload = array(
                        'select' => 'users.id, users.payscale_id, payscale.payscale_name, users.jobtypebase_amount',
                        'table' => 'users',
                        'join' => array(
                            'table' => 'payscale',
                            'statement' => 'users.payscale_id = payscale.id',
                            'join_as' => 'left'
                        ),
                        'where' => array(
                            'users.id' => $input['employee3_id'],
                            'payscale.payscale_name' => "Job Type Base (Install/Service)"
                        )
                    );
                    $getEmployeePayscaleInfo    = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                    
                    if ($getEmployeePayscaleInfo) {
                        $jobtypebase_amount[$input['employee3_id']] = $getEmployeePayscaleInfo->jobtypebase_amount;
                    }
                }
                if ($input['employee4_id'] !== 0 || $input['employee4_id'] !== "") {
                    $getEmployeePayscalePayload = array(
                        'select' => 'users.id, users.payscale_id, payscale.payscale_name, users.jobtypebase_amount',
                        'table' => 'users',
                        'join' => array(
                            'table' => 'payscale',
                            'statement' => 'users.payscale_id = payscale.id',
                            'join_as' => 'left'
                        ),
                        'where' => array(
                            'users.id' => $input['employee4_id'],
                            'payscale.payscale_name' => "Job Type Base (Install/Service)"
                        )
                    );
                    $getEmployeePayscaleInfo    = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                    
                    if ($getEmployeePayscaleInfo) {
                        $jobtypebase_amount[$input['employee4_id']] = $getEmployeePayscaleInfo->jobtypebase_amount;
                    }
                }
                if ($input['employee5_id'] !== 0 || $input['employee5_id'] !== "") {
                    $getEmployeePayscalePayload = array(
                        'select' => 'users.id, users.payscale_id, payscale.payscale_name, users.jobtypebase_amount',
                        'table' => 'users',
                        'join' => array(
                            'table' => 'payscale',
                            'statement' => 'users.payscale_id = payscale.id',
                            'join_as' => 'left'
                        ),
                        'where' => array(
                            'users.id' => $input['employee5_id'],
                            'payscale.payscale_name' => "Job Type Base (Install/Service)"
                        )
                    );
                    $getEmployeePayscaleInfo    = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                    
                    if ($getEmployeePayscaleInfo) {
                        $jobtypebase_amount[$input['employee5_id']] = $getEmployeePayscaleInfo->jobtypebase_amount;
                    }
                }
                if ($input['employee6_id'] !== 0 || $input['employee6_id'] !== "") {
                    $getEmployeePayscalePayload = array(
                        'select' => 'users.id, users.payscale_id, payscale.payscale_name, users.jobtypebase_amount',
                        'table' => 'users',
                        'join' => array(
                            'table' => 'payscale',
                            'statement' => 'users.payscale_id = payscale.id',
                            'join_as' => 'left'
                        ),
                        'where' => array(
                            'users.id' => $input['employee6_id'],
                            'payscale.payscale_name' => "Job Type Base (Install/Service)"
                        )
                    );
                    $getEmployeePayscaleInfo    = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                    
                    if ($getEmployeePayscaleInfo) {
                        $jobtypebase_amount[$input['employee6_id']] = $getEmployeePayscaleInfo->jobtypebase_amount;
                    }
                }
            }
            // End of Job Type Base Amount Implementation

            // Commission Feature for Tech Rep
            $jobTechCommission_amount = array();
            $techcommission_total = 0.0;
            if ($input['employee2_id'] !== 0 || $input['employee2_id'] !== "") {
                $getEmployeePayscalePayload = array(
                    'select' => 'users.id, users.commission_id, users.commission_percentage',
                    'table' => 'users',
                    'where' => array(
                        'users.id' => $input['employee2_id'],
                    )
                );
                $getEmployeePayscaleInfo = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                if ($getEmployeePayscaleInfo->commission_id == 0) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += (($input['item_price'][$i] - $input['item_cost'][$i]) * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee2_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                } 
                if ($getEmployeePayscaleInfo->commission_id == 1) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += ($input['item_price'][$i] * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee2_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                }
            }
            if ($input['employee3_id'] !== 0 || $input['employee3_id'] !== "") {
                $getEmployeePayscalePayload = array(
                    'select' => 'users.id, users.commission_id, users.commission_percentage',
                    'table' => 'users',
                    'where' => array(
                        'users.id' => $input['employee3_id'],
                    )
                );
                $getEmployeePayscaleInfo = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                if ($getEmployeePayscaleInfo->commission_id == 0) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += (($input['item_price'][$i] - $input['item_cost'][$i]) * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee3_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                } 
                if ($getEmployeePayscaleInfo->commission_id == 1) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += ($input['item_price'][$i] * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee3_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                }
            }
            if ($input['employee4_id'] !== 0 || $input['employee4_id'] !== "") {
                $getEmployeePayscalePayload = array(
                    'select' => 'users.id, users.commission_id, users.commission_percentage',
                    'table' => 'users',
                    'where' => array(
                        'users.id' => $input['employee4_id'],
                    )
                );
                $getEmployeePayscaleInfo = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                if ($getEmployeePayscaleInfo->commission_id == 0) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += (($input['item_price'][$i] - $input['item_cost'][$i]) * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee4_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                } 
                if ($getEmployeePayscaleInfo->commission_id == 1) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += ($input['item_price'][$i] * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee4_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                }
            }
            if ($input['employee5_id'] !== 0 || $input['employee5_id'] !== "") {
                $getEmployeePayscalePayload = array(
                    'select' => 'users.id, users.commission_id, users.commission_percentage',
                    'table' => 'users',
                    'where' => array(
                        'users.id' => $input['employee5_id'],
                    )
                );
                $getEmployeePayscaleInfo = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                if ($getEmployeePayscaleInfo->commission_id == 0) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += (($input['item_price'][$i] - $input['item_cost'][$i]) * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee5_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                } 
                if ($getEmployeePayscaleInfo->commission_id == 1) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += ($input['item_price'][$i] * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee5_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                }
            }
            if ($input['employee6_id'] !== 0 || $input['employee6_id'] !== "") {
                $getEmployeePayscalePayload = array(
                    'select' => 'users.id, users.commission_id, users.commission_percentage',
                    'table' => 'users',
                    'where' => array(
                        'users.id' => $input['employee6_id'],
                    )
                );
                $getEmployeePayscaleInfo = $this->general->get_data_with_param($getEmployeePayscalePayload, false);
                if ($getEmployeePayscaleInfo->commission_id == 0) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += (($input['item_price'][$i] - $input['item_cost'][$i]) * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee6_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                } 
                if ($getEmployeePayscaleInfo->commission_id == 1) {
                    $commissionAmount = 0.0;
                    for ($i = 0; $i < count($input['item_id']); $i++) {
                        $commissionAmount += ($input['item_price'][$i] * $getEmployeePayscaleInfo->commission_percentage) * $input['item_qty'][$i];
                    }
                    $jobTechCommission_amount[$input['employee6_id']] = $commissionAmount;
                    $techcommission_total += $commissionAmount;
                }
            }
            // End of Commission Feature for Tech Rep
            $job_type = '';
            $jobType = $this->JobType_model->getById($input['job_type']);
            if( $jobType ){
                $job_type = $jobType->title;
            }
            $jobs_data = array(
                'job_number' => $job_number,
                'estimate_id' => $estimate_id,
                'customer_id' => $input['customer_id'],
                'employee_id' => $input['employee_id'],
                'employee2_id' => $input['employee2_id'],
                'employee3_id' => $input['employee3_id'],
                'employee4_id' => $input['employee4_id'],
                'employee5_id' => $input['employee5_id'],
                'employee6_id' => $input['employee6_id'],
                'jobtypebase_amount' => json_encode($jobtypebase_amount),
                'job_name' => $job_number . ' - ' . $job_type,
                'job_location' => $job_location,
                'job_description' => $input['job_description'],
                'start_date' => $input['start_date'],
                'start_time' => $input['start_time'],
                'end_date' => $input['end_date'],
                'end_time' => $input['end_time'],
                'event_color' => $input['event_color'],
                'customer_reminder_notification' => $input['customer_reminder_notification'],
                'priority' => $input['priority'], //$this->input->post('job_priority'),
                'tags' => $jobTag->name, //$this->input->post('job_priority'),
                'status' => 'Scheduled', //$this->input->post('job_status'),
                // 'message' => $input['message'],
                'company_id' => $comp_id,
                'date_created' => date('Y-m-d H:i:s'),
                //'created_by' => $input['created_by'],
                'created_by' => logged('id'),
                //'notes' => $input['notes'],
                'attachment' => $input['attachment'],
                'tax_percentage' => $input['tax_percentage'],
                'tax_rate' => $input['tax'],
                'job_type' => $job_type,
                'date_issued' => $input['start_date'],
                'work_order_id' => $job_workorder_id,
                'commission' => $input['commission_amount'],
                'tech_commission' => json_encode($jobTechCommission_amount),
                'tech_commission_total' => $techcommission_total,
                //'fix_cost' => $input['input_totalFixCost'],
                //'margin' => $input['input_totalEquipmentMargin'],
                //'amount_collected' => $input['input_totalAmountCollected'],
                //'gross_profit' => $input['input_totalJobGrossProfit'],
                'job_account_number' => $job_account_number                
            );

            $commission_history_payload = [
                'datetime' => date("M d, Y")."<br>".date("h:i a"), 
                'user_id' => $input['employee_id'], 
                'customer_id' => $input['customer_id'], 
                'location' => "Job<br><small class='text-muted'>($job_number)</small>", 
                'type' => $input['commission_type'], 
                'percentage' => $input['commission_percentage'], 
                'commission' => $input['commission_amount']
            ];

            if (!empty($input['customer_message'])) {
                $jobs_data['message'] = $input['customer_message'];
            }
            if (!empty($input['message'])) {
                $jobs_data['message'] = $input['message'];
            }
            $location = $input['location'];
            $item_id = $input['item_id1'];

            $location_qty = $input['location_qty'];

            if (isset($location)) {
                for ($x = 0; $x < count($item_id); $x++) {
                    $update_location_qty = array(
                        'set' => array(
                            'qty' => $location_qty[$x]
                        ),
                        'where' => array(
                            'item_id' => $item_id[$x],
                            'id' => $location[$x]
                        )
                    );

                    $this->items_model->_updateLocationQty($update_location_qty);
                }
            }
            
            $total_equipment_cost = 0;
            foreach( $input['item_name'] as $key => $value ){
                $total = floatval($input['item_price'][$key]) * floatval($input['item_qty'][$key]);
                $total_equipment_cost += $total;
            }

            if (empty($isJob)) {
                // INSERT DATA TO JOBS TABLE
                $jobs_id = $this->general->add_return_id($jobs_data, 'jobs');
                $commission_history_returnID = $this->general->add_return_id($commission_history_payload, 'employee_commission_history');

                // Point Rating System insert action
                $this->PointRatingSystemModel->addPointRating($comp_id, $employee_type, $employee_ids, $module, $jobs_id, $point);

                //Create hash_id
                $job_hash_id = hashids_encrypt($jobs_id, '', 15);
                $this->jobs_model->update($jobs_id, ['hash_id' => $job_hash_id]);

                //Create payments data
                if( $job_workorder_id > 0 ){
                    $payment_data = [
                        'amount' =>  $input['total_amount'],
                        'program_setup' => $input['otps'],
                        'monthly_monitoring' => $input['monthly_monitoring'],
                        'installation_cost' => $input['installation_cost'],
                        'equipment_cost' => $total_equipment_cost,
                        'tax' => $input['tax'],
                        'deposit_collected' => 0,
                        'job_id' => $jobs_id,
                        'date_created' => date("Y-m-d h:i:s")
                    ];
                    $this->general->add_($payment_data, 'job_payments');
                }else{
                    // insert data to job payments table
                    $job_payment_query = array(
                        'amount' => $input['total_amount'],
                        'program_setup' => $input['otps'],
                        'monthly_monitoring' => $input['monthly_monitoring'],
                        'installation_cost' => $input['installation_cost'],
                        'equipment_cost' => $total_equipment_cost,
                        'tax' => $input['tax'],
                        'job_id' => $jobs_id,
                    );
                    $this->general->add_($job_payment_query, 'job_payments');
                }

                customerAuditLog(logged('id'), $input['customer_id'], $jobs_id, 'Jobs', 'Added New Job #' . $job_number);

                //Activity Logs
                $this->load->model('Activity_model');
                $user_id = logged('id');
                $activity_name = 'Created Job Number ' . $job_number; 
                $this->Activity_model->add($activity_name,$user_id);

                //Google Calendar
                createSyncToCalendar($jobs_id, 'job', $comp_id);

                // insert data to job items table (items_id, qty, jobs_id)
                //
                if (isset($input['item_id'])) {
                    $devices = count($input['item_id']);
                    for ($xx = 0; $xx < $devices; $xx++) {
                        $job_items_data = array();
                        $job_items_data['job_id'] = $jobs_id; //from jobs table
                        $job_items_data['items_id'] = $input['item_id'][$xx];
                        $job_items_data['commission'] = $input['item_commission'][$xx];
                        $job_items_data['margin'] = $input['item_margin'][$xx];
                        $job_items_data['qty']  = $input['item_qty'][$xx];
                        $job_items_data['cost'] = $input['item_price'][$xx];
                        $job_items_data['tax']      = 0;
                        $job_items_data['total']    = $input['item_price'][$xx] * $input['item_qty'][$xx];
                        $job_items_data['location'] = $input['location'][$xx];
                        $job_items_data['item_name'] = $input['item_name'][$xx];
                        $this->general->add_($job_items_data, 'job_items');
                        $this->items_model->recordItemTransaction($input['item_id'][$xx], $input['item_qty'][$xx], $input['location'][$xx], "deduct", $user_login, "USER");
                        $this->items_model->recordItemTransaction($input['item_id'][$xx], $input['item_qty'][$xx], $input['location'][$xx], "deduct", $customer->first_name.' '.$customer->last_name, "CUSTOMER");
                        unset($job_items_data);
                    }
                }

                // insert data to job url links table
                $link = isset($input['link']) ? $input['link'] : 'none';
                $jobs_links_data = array(
                    'link' => $link,
                    'job_id' => $jobs_id,
                );
                $this->general->add_($jobs_links_data, 'job_url_links');

                // insert data to jobs approval table
                $jobs_approval_data = array(
                    'authorize_name' => $input['authorize_name'],
                    'signature_link' => $input['signature_link'],
                    'datetime_signed' => $input['datetime_signed'],
                    'jobs_id' => $jobs_id,
                );
                $this->general->add_($jobs_approval_data, 'jobs_approval');                
                

                // insert / update job settings 
                if( $job_settings ){
                    $jobs_settings_data = ['job_num_next' =>  $next_num + 1, 'job_account_next_num' => $account_next_num + 1];
                    $this->JobSettings_model->update($job_settings->id, $jobs_settings_data);                    
                }else{
                    $job_settings_data = [
                        'job_num_prefix' => $prefix,
                        'job_num_next' => $next_num + 1,
                        'job_account_next_num' => $account_next_num + 1,
                        'company_id' => $comp_id
                    ];

                    $this->JobSettings_model->create($job_settings_data);
                }

                //Create invoice
                $invoice_id = $this->createInitialInvoice($jobs_id);

            } else {
                $jobs_id = $isJob->id;
                $this->jobs_model->deleteJobItemsByJobId($jobs_id);
                if (isset($input['item_id'])) {
                    $devices = count($input['item_id']);
                    for ($xx = 0; $xx < $devices; $xx++) {
                        $job_items_data = array();
                        $job_items_data['job_id'] = $jobs_id; //from jobs table
                        $job_items_data['items_id'] = $input['item_id'][$xx];
                        $job_items_data['qty']  = $input['item_qty'][$xx];
                        $job_items_data['commission'] = $input['item_commission'][$xx];
                        $job_items_data['margin'] = $input['item_margin'][$xx];
                        $job_items_data['cost'] = $input['item_price'][$xx] * $input['item_qty'][$xx];
                        $job_items_data['tax']      = 0;
                        $job_items_data['total']    = $input['item_price'][$xx] * $input['item_qty'][$xx];
                        $job_items_data['location'] = $input['location'][$xx];
                        $job_items_data['item_name'] = $input['item_name'][$xx];
                        $this->general->add_($job_items_data, 'job_items');
                        $this->items_model->recordItemTransaction($input['item_id'][$xx], $input['item_qty'][$xx], $input['location'][$xx], "deduct", $user_login, "USER");
                        $this->items_model->recordItemTransaction($input['item_id'][$xx], $input['item_qty'][$xx], $input['location'][$xx], "deduct", $customer->first_name.' '.$customer->last_name, "CUSTOMER");
                        unset($job_items_data);
                    }
                }                

                // update data to job url links table
                $jobs_links_data = array(
                    'link' => $input['link'],
                );
                $this->general->update_with_key_field($jobs_links_data, $isJob->id, 'job_url_links', 'job_id');

                // insert data to jobs approval table
                $jobs_approval_data = array(
                    'authorize_name' => $input['authorize_name'],
                    'signature_link' => $input['signature_link'],
                    'datetime_signed' => $input['datetime_signed'],
                );
                $this->general->update_with_key_field($jobs_approval_data, $isJob->id, 'jobs_approval', 'jobs_id');

                //Activity Logs
                $this->load->model('Activity_model');
                $user_id = logged('id');
                $activity_name = 'Updated Job Number ' . $job_number; 
                $this->Activity_model->add($activity_name,$user_id);
                
                // Update payments
                $job_payment_query = [
                    'amount' =>  $input['total_amount'],
                    'program_setup' => $input['otps'],
                    'monthly_monitoring' => $input['monthly_monitoring'],
                    'installation_cost' => $input['installation_cost'],
                    'equipment_cost' => $total_equipment_cost,
                    'tax' => $input['tax'],
                ];
                
                $isset = $this->general->update_with_key_field($job_payment_query, $isJob->id, 'job_payments', 'job_id');
                $this->general->update_with_key_field($jobs_data, $isJob->id, 'jobs', 'id');

                // Point Rating System update action
                $this->PointRatingSystemModel->updatePointRating($comp_id, $employee_type, $employee_ids, $module, $jobs_id, $point);
            }

            //Update customer otp equipment cost and monthly monitoring fields
            if( in_array($comp_id, adi_company_ids()) ){
                $data_acs_office = [
                    'monthly_monitoring' => $input['monthly_monitoring'],
                    'equipment_cost' => $total_equipment_cost                     
                ];

                $this->general->update_with_key_field($data_acs_office, $input['customer_id'], 'acs_office', 'fk_prof_id');
            }

            if (isset($input['wo_id'])) {
                $get_work_order_data = array(
                    'where' => array(
                        'id' => $input['wo_id']
                    ),
                    'table' => 'work_orders',
                    'select' => '*',
                );
                $workorder_data = $this->general->get_data_with_param($get_work_order_data);

                $check_exist = array(
                    'where' => array('fk_prof_id' => $input['customer_id']),
                    'table' => 'acs_alarm'
                );
                $is_exist = $this->general->get_data_with_param($check_exist);

                $customer_data = array();
                $customer_data['passcode'] = $workorder_data->password;
                $customer_data['panel_type'] = $workorder_data->panel_type;
                $customer_data['system_type'] = $workorder_data->plan_type;
                if (empty($is_exist)) {
                    $customer_data['fk_prof_id'] = $input['customer_id'];
                    $this->general->add_($customer_data, 'acs_alarm');
                } else {
                    $this->general->update_with_key_field($customer_data, $input['customer_id'], 'acs_alarm', 'fk_prof_id');
                }

                $customer_data_office = array();
            }

            //SMS Notification
            createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', $input['employee_id'], $input['employee_id'], 0);

            if ($input['employee2_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee2_id'], 0);
            }
            if ($input['employee3_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee3_id'], 0);
            }
            if ($input['employee4_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee4_id'], 0);
            }
            if ($input['employee5_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee5_id'], 0);
            }
            if ($input['employee6_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee6_id'], 0);
            }
        }

        /*if (!is_null($this->input->get('json', TRUE))) {
                // Returns json data, when ?json is set on URL query string.
                header('content-type: application/json');
                exit(json_encode(['id' => $job_number]));
            } else {
                $data_arr = array("data" => "Success", "qty" => $input['item_qty']);
                exit(json_encode($data_arr));
            }*/


        // Record Job save and Update to Customer Activities Module in Customer Dashboard
        if ($is_update == 0) {
            $action = "$user_login scheduled a job with you. <a href='#' onclick='window.open(`".base_url('job/new_job1/').$jobs_id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>$job_number</a>";
        } else {
            $action = "$user_login updated a job. <a href='#' onclick='window.open(`".base_url('job/new_job1/').$jobs_id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>$job_number</a>";
        }

        $customerLogPayload = array(
            'date' => date('m/d/Y')."<br>".date('h:i A'),
            'customer_id' => $input['customer_id'],
            'user_id' => logged('id'),
            'logs' => "$action"
        );
        $customerLogsRecording = $this->customer_model->recordActivityLogs($customerLogPayload);

        $itemsOffice = array(
            'fk_prof_id'                => $input['customer_id'],
            'fk_sales_rep_office'       => $input['employee_id'],
            'technician'                => $input['EMPLOYEE_SELECT_2'],
        );

        $solarItemsOffices = $this->workorder_model->update_office_job($itemsOffice);

        $alarmInfoData = array(
            'fk_prof_id'                => $input['customer_id'],
            'monitor_id'                => $input['JOB_ACCOUNT_NUMBER'],
        );

        $alarmInfoDatas = $this->workorder_model->update_alarm_adi_job($alarmInfoData);


        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'location' => $location,
            'items_id' => $item_id,
            'qty' => $location_qty,
            'job_id' => $jobs_id,
            'estimate_id' => $jobs_data->estimate_id,
            'is_update' => $is_update,
            'work_order_id' => $input['work_order_id']
        ];
        echo json_encode($return);
    }

    public function testController() {

    }

    public function delete()
    {
        $get = $this->input->get();
        $this->jobs_model->deleteJob($get['id']);
        redirect('job');
    }

    public function getItems()
    {
        $get = $this->input->get();

        $result = $this->jobs_model->getItems($get['index']);

        echo json_encode($result);
    }

    public function saveInvoice()
    {
        postAllowed();

        $comp_id = logged('company_id');
        $date_created = date_format(date_create($this->input->post('createdDate')), "Y-m-d H:i:s");
        $invoice_number = $this->invoice_model->getInvoiceNumber($this->input->post('jobId'), $this->input->post('jobNumber'));

        $data = array(
            'company_id' => $comp_id,
            'customer_id' => $this->input->post('customer_id'),
            'created_date' => $date_created,
            'total_due' => $this->input->post('totalDue'),
            'balance' => $this->input->post('balance'),
            'due_date' => date('Y-m-d H:i:s'),
            'billing_type' => $this->input->post('billingType'),
            'job_id' => $this->input->post('jobId'),
            'created_by' => logged('id'),
            'status' => $this->input->post('status'),
            'invoice_number' => $invoice_number
        );
        $this->db->insert($this->invoice_model->table, $data);
        echo json_encode($data);
    }

    public function saveInvoiceItems()
    {
        postAllowed();
        $comp_id = logged('company_id');

        $data = array(
            'company_id' => $comp_id,
            'job_id' => $this->input->post('job_id'),
            'item_id' => $this->input->post('item_id'),
            'qty' => 1,
            'locations' => '',
            'total_value' => $this->input->post('total_value'),
            'discount' => 0,
            'discount_type' => ""
        );
        $this->db->insert($this->invoice_model->table_item, $data);
        $result = $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'));

        echo json_encode($result);
    }

    public function updateJobItemQty()
    {
        postAllowed();

        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $qty = $this->input->post('qty');

        $this->jobs_model->updateJobItemQty($id, $qty, $type);
        $result = $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'));

        echo json_encode($result);
    }

    public function buy($id)
    {
        // Set variables for paypal form
        $returnURL = base_url() . 'paypal/success';
        $cancelURL = base_url() . 'paypal/cancel';
        $notifyURL = base_url() . 'paypal/ipn';

        // Get product data from the database
        $product = $this->invoice_model->getRows($id);

        // Get current user ID from the session
        $userID = logged('id');

        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['title']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number', $product['invoice_id']);
        $this->paypal_lib->add_field('amount', $product['total_value']);

        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    public function saveCreditCard()
    {
        if ($this->input->post('billingExpDate') != '' && $this->input->post('cardNumber') != '') {
            $exp_date = explode("/", $this->input->post('billingExpDate'));

            $data = array(
                'card_number' => $this->input->post('cardNumber'),
                'exp_day' => $exp_date[1],
                'exp_yr' => $exp_date[0],
                'CVV' => $this->input->post('cvv'),
                'card_type' => $this->input->post('cardType'),
                'user_id' => logged('id'),
                'company_id' => logged('company_id'),
                'payment_method_id' => 0,
                'added' => date('Y-m-d H:i:s')
            );

            $this->db->insert($this->jobs_model->table_credit_cards, $data);
        }
    }

    public function sendEstimateEmail()
    {
        postAllowed();
        $from_email = $this->input->post('from_email');
        $company = $this->input->post('company');
        $to_email = $this->input->post('email');

        //Load email library
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'nsmartrac@gmail.com',
            'smtp_pass' => 'nSmarTrac2020',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($from_email, $company);
        $this->email->to($to_email);
        $this->email->subject('Review Estimate');
        $data = array(
            'customer' => getLoggedFullName($this->input->post('customer_id')),
            "items" => $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'))
        );
        $message = $this->load->view('email_campaigns/estimate.php', $data, true);
        $this->email->message($message);
        //Send mail

        if ($this->email->send()) {
            echo json_encode("Congratulation Email Send Successfully.");
        } else {
            echo json_encode($this->email->send());
        }
    }

    public function saveEstimate()
    {
        postAllowed();
        $estimate_number = $this->jobs_model->getEstimateNumber($this->input->post('job_id'), $this->input->post('jobNumber'));


        $data = array(
            'estimate_date' => date("Y-m-d", strtotime($this->input->post('estimate_date'))),
            'expiry_date' => date("Y-m-d", strtotime($this->input->post('expiry_date'))),
            'description' => $this->input->post('description'),
            'employee_ids' => $this->input->post('employee_id'),
            'status' => $this->input->post('status'),
            'job_id' => $this->input->post('job_id'),
            'estimate_value' => $this->input->post('estimate_value'),
            'deposit_request' => $this->input->post('deposit_request'),
            'estimate_number' => $estimate_number
        );

        $this->db->insert($this->jobs_model->table_estimates, $data);

        echo json_encode($data);
    }

    public function deleteJobForm()
    {
        $get = $this->input->get();

        switch ($get['type']) {
            case "estimate":
                $this->jobs_model->deleteEstimate($get['id']);
                break;

            case "work_order":
                $this->jobs_model->deleteWorkOrder($get['id']);
                break;

            case "invoice":
                $this->invoice_model->deleteInvoice($get['id']);
                break;
        }

        redirect('job/new_job?job_num=' . $get['job_num']);
    }

    public function deleteMultiple()
    {
        postAllowed();
        $ids = explode(",", $this->input->post('ids'));

        foreach ($ids as $id) {
            $this->jobs_model->deleteJob($id);
        }

        echo json_encode(true);
    }

    public function getEmpByRole()
    {
        postAllowed();
        $id = $this->input->post('id');
        $result = $this->db->get_where($this->jobs_model->table_employees, array('role_id' => $id))->result_array();

        echo json_encode($result);
    }

    public function getCustomerLocations()
    {
        postAllowed();
        $id = $this->input->post('id');
        $result = $this->db->get_where($this->jobs_model->table_address, array('user_id' => $id))->result_array();

        echo json_encode($result);
    }

    public function saveAssignEmp()
    {
        postAllowed();
        $id = $this->input->post('role_id');
        $role = $this->page_data['emp_roles'] = $this->roles_model->getRolesById($this->input->post('role_id'));

        $data = array(
            'jobs_id' => $this->input->post('job_id'),
            'employees_id' => $this->input->post('emp_id'),
            'emp_role' => $role->title
        );

        $this->db->insert($this->jobs_model->table_jobs_has_employees, $data);
        $data = $this->jobs_model->getAssignEmp($this->input->post('job_id'));

        echo json_encode($data);
    }

    public function saveNewCustomerLocation()
    {
        postAllowed();

        $data = array(
            'user_id' => $this->input->post('user_id'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postal_code' => $this->input->post('postal_code')
        );

        $this->db->insert($this->jobs_model->table_address, $data);
        $data = $this->db->get_where($this->jobs_model->table_address, array('user_id' => $this->input->post('user_id')))->result_array();

        echo json_encode($data);
    }

    public function details($id)
    {
        $this->load->model('Estimate_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Customer_model');

        $estimate = $this->Estimate_model->getEstimate($id);

        if ($estimate) {
            $customer      = $this->Customer_model->getCustomer($estimate->customer_id);
            $estimateItems = $this->EstimateItem_model->getAllByEstimateId($estimate->id);

            $this->page_data['estimate'] = $estimate;
            $this->page_data['customer'] = $customer;
            $this->page_data['estimateItems'] = $estimateItems;
            $this->load->view('job/details', $this->page_data);
        } else {
            redirect('dashboard');
        }
    }

    public function ajax_load_upcoming_jobs()
    {
        $role    = logged('role');
        $user_id = getLoggedUserID();
        $comp_id = logged('company_id');

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        /*if ($role == 1 || $role == 2) {
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobs();
        } else {
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobsByCompanyId($comp_id);
        }*/
        $upcomingJobs = $this->jobs_model->getAllUpcomingJobsByCompanyId($comp_id);

        $jobs_total_amount = array();
        foreach ($upcomingJobs as $j) {
            $jobItems = $this->jobs_model->get_specific_job_items($j->id);
            $total_price = 0;
            foreach ($jobItems as $item) {
                $total_price += ($item->price * $item->qty);
            }

            $jobs_total_amount[$j->id] = $total_price;
        }

        $this->page_data['jobs_total_amount'] = $jobs_total_amount;
        $this->page_data['upcomingJobs'] = $upcomingJobs;
        // $this->load->view('job/ajax_load_upcoming_jobs', $this->page_data);
        $this->load->view('v2/pages/job/ajax_load_upcoming_jobs', $this->page_data);
    }

    public function add_new_job_type()
    {
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $this->page_data['page']->title = "Job Types";
        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->load->view('v2/pages/job/job_settings/add_new_job_type', $this->page_data);
    }

    public function create_job_type()
    {
        postAllowed();

        $this->load->model('Icons_model');

        $comp_id = logged('company_id');
        $user_id = logged('id');
        $post    = $this->input->post();

        if ($post['job_type_name'] != '') {
            if (isset($post['is_default_icon'])) {
                $icon = $this->Icons_model->getById($post['default_icon_id']);
                $marker_icon = $icon->image;
                $data_job_type = [
                    'user_id' => $user_id,
                    'company_id' => $comp_id,
                    'title' => $post['job_type_name'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => 1,
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $job_type_id = $this->JobType_model->create($data_job_type);
                if ($job_type_id > 0) {
                    //Activity Logs
                    $activity_name = 'Created Job Type'; 
                    createActivityLog($activity_name);

                    $this->session->set_flashdata('message', 'Add new job type was successful');
                    $this->session->set_flashdata('alert_class', 'alert-success');

                    redirect('job/job_types');
                } else {
                    $this->session->set_flashdata('message', 'Cannot save data.');
                    $this->session->set_flashdata('alert_class', 'alert-danger');

                    redirect('job/add_new_job_type');
                }
            } else {
                if (!empty($_FILES['image']['name'])) {
                    $marker_icon = $this->moveUploadedFile();
                    $data_job_type = [
                        'user_id' => $user_id,
                        'company_id' => $comp_id,
                        'title' => $post['job_type_name'],
                        'icon_marker' => $marker_icon,
                        'is_marker_icon_default_list' => 0,
                        'status' => 1,
                        'created_at' => date("Y-m-d H:i:s")
                    ];

                    $job_type_id = $this->JobType_model->create($data_job_type);
                    if ($job_type_id > 0) {
                        //Activity Logs
                        $activity_name = 'Created Job Type'; 
                        createActivityLog($activity_name);

                        $this->session->set_flashdata('message', 'Add new job type was successful');
                        $this->session->set_flashdata('alert_class', 'alert-success');

                        redirect('job/job_types');
                    } else {
                        $this->session->set_flashdata('message', 'Cannot save data.');
                        $this->session->set_flashdata('alert_class', 'alert-danger');

                        redirect('job/add_new_job_type');
                    }
                } else {
                    $this->session->set_flashdata('message', 'Please specify job type icon / marker image');
                    $this->session->set_flashdata('alert_class', 'alert-danger');

                    redirect('job/add_new_job_type');
                }
            }
        } else {
            $this->session->set_flashdata('message', 'Please specify job type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('job/add_new_job_type');
        }
    }

    public function edit_job_type($job_type_id)
    {
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $jobType = $this->JobType_model->getById($job_type_id);
        $icons   = $this->Icons_model->getAll();
        $this->page_data['page']->title = "Job Types";
        $this->page_data['jobType'] = $jobType;
        $this->page_data['icons'] = $icons;
        $this->load->view('v2/pages/job/job_settings/edit_job_type', $this->page_data);
    }

    public function update_job_type()
    {
        postAllowed();

        $this->load->model('Icons_model');

        $post    = $this->input->post();

        if ($post['job_type_name'] != '') {
            $jobType = $this->JobType_model->getById($post['eid']);
            if ($jobType) {
                $marker_icon = $jobType->icon_marker;
                $is_marker_icon_default_list = $jobType->is_marker_icon_default_list;
                if (isset($post['is_default_icon'])) {
                    if ($post['default_icon_id'] > 0) {
                        $icon = $this->Icons_model->getById($post['default_icon_id']);
                        $marker_icon = $icon->image;
                        $is_marker_icon_default_list = 1;
                    }
                } else {
                    if ($_FILES['image']['size'] > 0) {
                        $marker_icon = $this->moveUploadedFile();
                        $is_marker_icon_default_list = 0;
                    }
                }

                $data_job_type = [
                    'title' => $post['job_type_name'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => $is_marker_icon_default_list
                ];

                $this->JobType_model->updateJobTypeById($post['eid'], $data_job_type);

                //Activity Logs
                $activity_name = 'Updated Job Type '.$post['job_type_name']; 
                createActivityLog($activity_name);

                $this->session->set_flashdata('message', 'Job Type was successful updated');
                $this->session->set_flashdata('alert_class', 'alert-success');

                redirect('job/job_types');
            } else {
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');

                redirect('job/job_types');
            }
        } else {
            $this->session->set_flashdata('message', 'Please specify job type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('job/edit_job_type/' . $post['eid']);
        }
    }

    public function moveUploadedFile()
    {
        if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
            $company_id = logged('company_id');
            $target_dir = "./uploads/job_types/" . $company_id . "/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['image']['tmp_name'];
            $extension = strtolower(end(explode('.', $_FILES['image']['name'])));
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = basename($_FILES["image"]["name"]);
            move_uploaded_file($tmp_name, $target_dir . $name);

            return $name;
        }
    }

    public function jobTagMoveUploadedFile()
    {
        if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
            $tag_file         = $_FILES["image"]["name"];
            $extension        = substr($tag_file,strlen($tag_file)-4,strlen($tag_file));
            $valid_tag_extn   = array(".jpg","jpeg",".png",".gif");
            
            if(!in_array($extension,$valid_tag_extn)) {
                return 'invalid_extension';
                exit;
            } else {
                $company_id = logged('company_id');
                $target_dir = "./uploads/job_tags/" . $company_id . "/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
    
                $tmp_name = $_FILES['image']['tmp_name'];
                $extension = strtolower(end(explode('.', $_FILES['image']['name'])));
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = basename($_FILES["image"]["name"]);
                move_uploaded_file($tmp_name, $target_dir . $name);
    
                return $name;                
            }
        }
    }

    public function job_settings()
    {
        $this->load->model('JobSettings_model');

        $company_id = logged('company_id');
        $setting = $this->JobSettings_model->getJobSettingByCompanyId($company_id);

        $this->page_data['setting'] = $setting;
        $this->load->view('job/settings', $this->page_data);
    }

    public function save_setting($id = null)
    {
        $this->load->model('JobSettings_model');

        postAllowed();
        $user = (object)$this->session->userdata('logged');
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => true,
            'max_size' => "2048000",
            'max_height' => "768",
            'max_width' => "1024"
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload()) {
            $draftlogo = array('upload_data' => $this->upload->data());
            $logo = $draftlogo['upload_data']['file_name'];
        } else {
            if ($id) {
                $logo = post('img_setting');
            } else {
                $logo = '';
            }
        }

        $payment_methods = array(
            'cc' => post('payment_cc'),
            'check' => post('payment_check'),
            'cash' => post('payment_cash'),
            'deposit' => post('payment_deposit')
        );

        $invoice_number = array(
            'prefix' => post('prefix'),
            'base' => post('base'),
        );

        $residential = array(
            'default_msg' => post('message'),
            'default_terms' => post('terms'),
        );

        $commercial = array(
            'default_msg' => post('message_commercial'),
            'default_terms' => post('terms_commercial'),
        );

        $payment_fee = array(
            'percent' => post('payment_fee_percent'),
            'amount' => post('payment_fee_amount'),
        );

        $invoice_template = array(
            'item_price' => post('hide_item_price'),
            'item_qty' => post('hide_item_qty'),
            'item_tax' => post('hide_item_tax'),
            'item_discount' => post('hide_item_discount'),
            'item_total' => post('hide_item_total'),
            'from_email' => post('hide_from_email'),
            'item_subtotal' => post('show_item_type_subtotal')
        );

        $invoice_from = array(
            'business_phone' => post('from_phone_show'),
            'office_phone' => post('from_office_phone_show'),
        );

        $comp_id = logged('company_id');
        if (!$id) {
            $this->JobSettings_model->create([
                'user_id' => $user->id,
                'company_id' => $comp_id,
                'invoice_number' => serialize($invoice_number),
                'residential' => serialize($residential),
                'commercial' => serialize($commercial),
                'logo' => $logo,
                'payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'invoice_type' => post('invoice_type'),
                'payment_fee' => serialize($payment_fee),
                'invoice_template' => serialize($invoice_template),
                'invoice_from' => serialize($invoice_from),
                'recurring' => post('recurring_on_add_child'),
                'payment_method' => serialize($payment_methods),
                'mobile_payment' => post('payment_mobile_status'),
                'invoice_tip' => post('tip_status'),
                'autoconvert_work_order' => post('autoconvert_work_order')
            ]);
        } else {
            $this->JobSettings_model->update($id, [
                'user_id' => $user->id,
                'company_id' => $comp_id,
                'invoice_number' => serialize($invoice_number),
                'residential' => serialize($residential),
                'commercial' => serialize($commercial),
                'logo' => $logo,
                'payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'invoice_type' => post('invoice_type'),
                'payment_fee' => serialize($payment_fee),
                'invoice_template' => serialize($invoice_template),
                'invoice_from' => serialize($invoice_from),
                'recurring' => post('recurring_on_add_child'),
                'payment_method' => serialize($payment_methods),
                'mobile_payment' => post('payment_mobile_status'),
                'invoice_tip' => post('tip_status'),
                'autoconvert_work_order' => post('autoconvert_work_order')
            ]);
        }

        $this->activity_model->add('Update Invoice Settings $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Invoice Settings Saved Successfully');

        redirect('invoice/settings');
    }

    public function add_new_job_tag()
    {
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->page_data['page']->title = 'Job Tags';
        $this->load->view('v2/pages/job/job_settings/add_new_job_tag', $this->page_data);
    }

    public function edit_job_tag($id)
    {
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $jobTag = $this->JobTags_model->getById($id);
        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->page_data['jobTag'] = $jobTag;
        $this->page_data['page']->title = 'Job Tags';
        $this->load->view('v2/pages/job/job_settings/edit_job_tag', $this->page_data);
    }

    public function create_new_job_tag()
    {
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        if (isset($post['is_default_icon'])) {
            $icon = $this->Icons_model->getById($post['default_icon_id']);
            $marker_icon = $icon->image;
            $data = [
                'name' => $post['job_tag_name'],
                'company_id' => $company_id,
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => 1
            ];

            $this->JobTags_model->create($data);

            //Activity Logs
            $activity_name = 'Created Job Tag '.$post['job_tag_name']; 
            createActivityLog($activity_name);

        } else {
            $marker_icon = $this->jobTagsMoveUploadedFile();
            if ($marker_icon != '') {
                $data = [
                    'name' => $post['job_tag_name'],
                    'company_id' => $company_id,
                    'marker_icon' => $marker_icon,
                    'is_marker_icon_default_list' => 0
                ];

                $this->JobTags_model->create($data);

                //Activity Logs
                $activity_name = 'Created Job Tag '.$post['job_tag_name']; 
                createActivityLog($activity_name);

            } else {
                $this->session->set_flashdata('message', 'Cannot update job tag');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }
        }

        $this->session->set_flashdata('message', 'Add new job tag was successful');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('job/job_tags');
    }

    public function ajax_create_new_job_tag() 
    {
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        if( $post['job_tag_name'] != ''){
            $isJobTagExists = $this->JobTags_model->getByNameAndCompanyId($post['job_tag_name'], $company_id);
            if( $isJobTagExists ){
                $return = [
                    'data' => null,
                    'success' => false,
                    'message' => 'Job tag already exist'
                ]; 
                echo json_encode($return);     
                exit; 
            }
        }        

        if (isset($post['is_default_icon'])) {
            $icon = $this->Icons_model->getById($post['default_icon_id']);
            $marker_icon = $icon->image;
            $data = [
                'name' => $post['job_tag_name'],
                'company_id' => $company_id,
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => 1
            ];

            $this->JobTags_model->create($data);

            //Activity Logs
            $activity_name = 'Created Job Tag '.$post['job_tag_name']; 
            createActivityLog($activity_name);

        } else {
            $marker_icon = $this->jobTagsMoveUploadedFile();
            if ($marker_icon != '') {
                if($marker_icon == 'invalid_extension') {
                    $return = [
                        'data' => null,
                        'success' => false,
                        'message' => 'Cannot update job tag, invalid file extension'
                    ];                     
                    echo json_encode($return);        
                    exit;
                } else {
                    $data = [
                        'name' => $post['job_tag_name'],
                        'company_id' => $company_id,
                        'marker_icon' => $marker_icon,
                        'is_marker_icon_default_list' => 0
                    ];
    
                    $this->JobTags_model->create($data);
    
                    //Activity Logs
                    $activity_name = 'Created Job Tag '.$post['job_tag_name']; 
                    createActivityLog($activity_name);
                }
            } else {
                $return = [
                    'data' => null,
                    'success' => false,
                    'message' => 'Cannot update job tag'
                ]; 
                echo json_encode($return);     
                exit;               
            }
        }

        $return = [
            'data' => null,
            'success' => true,
            'message' => 'Add new job tag was successful'
        ];

        echo json_encode($return);        

    }

    public function ajax_update_job_tag()
    {
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');
    
        $post = $this->input->post();
        $company_id = logged('company_id');         
    
        $jobTag = $this->JobTags_model->getById($post['jid']);
        if ($jobTag) {

            if( $post['job_tag_name'] != '' && $jobTag->name != $post['job_tag_name']){
                $isJobTagExists = $this->JobTags_model->getByNameAndCompanyId($post['job_tag_name'], $company_id);
                if( $isJobTagExists ){
                    $return = [
                        'data' => null,
                        'success' => false,
                        'message' => 'Job tag already exist'
                    ]; 
                    echo json_encode($return);     
                    exit; 
                }
            }

            $marker_icon = $jobTag->marker_icon;
            $is_marker_icon_default_list = $jobTag->is_marker_icon_default_list;
            if (isset($post['is_default_icon'])) {
                if ($post['default_icon_id'] > 0) {
                    $icon = $this->Icons_model->getById($post['default_icon_id']);
                    $marker_icon = $icon->image;
                    $is_marker_icon_default_list = 1;
                }
            } else {
                if ($_FILES['image']['size'] > 0) {
                    $marker_icon = $this->jobTagMoveUploadedFile();
                    if($marker_icon == 'invalid_extension') {
                        $return = [
                            'data' => null,
                            'success' => false,
                            'message' => 'Cannot update job tag, invalid file extension'
                        ];                     
                        echo json_encode($return);        
                        exit;
                    }                    
                    $is_marker_icon_default_list = 0;
                }
            }
    
            $data = [
                'name' => $post['job_tag_name'],
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => $is_marker_icon_default_list
            ];
    
            $this->JobTags_model->update($post['jid'], $data);
    
            //Activity Logs
            $activity_name = 'Updated Job Tag '.$post['job_tag_name']; 
            createActivityLog($activity_name);
    
            $this->session->set_flashdata('message', 'Update job tag was successful');
            $this->session->set_flashdata('alert_class', 'alert-success');

            $return = [
                'data' => null,
                'success' => true,
                'message' => 'Update job tag was successful'
            ];
    
            echo json_encode($return);   

        } else {
            $return = [
                'data' => null,
                'success' => false,
                'message' => 'Record not found'
            ]; 
            echo json_encode($return);     
            exit;               
        }
    }

    public function update_job_tag()
    {
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        $jobTag = $this->JobTags_model->getById($post['jid']);
        if ($jobTag) {
            $marker_icon = $jobTag->marker_icon;
            $is_marker_icon_default_list = $jobTag->is_marker_icon_default_list;
            if (isset($post['is_default_icon'])) {
                if ($post['default_icon_id'] > 0) {
                    $icon = $this->Icons_model->getById($post['default_icon_id']);
                    $marker_icon = $icon->image;
                    $is_marker_icon_default_list = 1;
                }
            } else {
                if ($_FILES['image']['size'] > 0) {
                    $marker_icon = $this->jobTagMoveUploadedFile();
                    $is_marker_icon_default_list = 0;
                }
            }

            $data = [
                'name' => $post['job_tag_name'],
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => $is_marker_icon_default_list
            ];

            $this->JobTags_model->update($post['jid'], $data);

            //Activity Logs
            $activity_name = 'Updated Job Tag '.$post['job_tag_name']; 
            createActivityLog($activity_name);

            $this->session->set_flashdata('message', 'Update job tag was successful');
            $this->session->set_flashdata('alert_class', 'alert-success');
        } else {
            $this->session->set_flashdata('message', 'Record not found');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('job/job_tags');
    }

    public function jobTagsMoveUploadedFile()
    {
        if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {

            $tag_file         = $_FILES["image"]["name"];
            $extension        = substr($tag_file,strlen($tag_file)-4,strlen($tag_file));
            $valid_tag_extn   = array(".jpg","jpeg",".png",".gif");

            if(!in_array($extension,$valid_tag_extn)) {
                return 'invalid_extension';
                exit;
            } else {
                $company_id = logged('company_id');
                $target_dir = "./uploads/job_tags/" . $company_id . "/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
    
                $tmp_name = $_FILES['image']['tmp_name'];
                $extension = strtolower(end(explode('.', $_FILES['image']['name'])));
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = basename($_FILES["image"]["name"]);
                move_uploaded_file($tmp_name, $target_dir . $name);
    
                return $name;                
            }
        }
    }

    public function createOrUpdateSignature()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $isCreated = false;

        $this->db->where('jobs_id', $payload['jobs_id']);
        $record = $this->db->get('jobs_approval')->row();

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert('jobs_approval', $payload);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update('jobs_approval', $payload);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get('jobs_approval')->row();

        header('content-type: application/json');
        echo json_encode(['jobs_approval' => $record, 'is_created' => $isCreated]);
    }

    public function invoicePreview($jobId)
    {
        echo $this->generateJobInvoiceHTML($jobId, true);
    }

    public function generateJobInvoiceHTML($jobId)
    {
        $this->load->model('jobs_model');
        $job = $this->jobs_model->get_specific_job($jobId);

        if (!$job) {
            $this->session->set_flashdata('message', 'Cannot find data.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            return;
        }

        $this->load->model('general_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->helper(['url', 'hashids_helper', 'functions']);

        $get_company_info = array(
            'where' => array(
                'company_id' => $job->company_id,
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );
        $onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($job->company_id);
        $this->page_data['onlinePaymentAccount'] = $onlinePaymentAccount;
        $this->page_data['company_info'] = $this->general_model->get_data_with_param($get_company_info, false);
        $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($jobId);
        $this->page_data['jobs_data'] = $job;

        $encryptedId = hashids_encrypt($job->job_unique_id, '', 15);
        $paymentLink = base_url('/job_invoice_view/' . $encryptedId);
        $this->page_data['payment_link'] = $paymentLink;

        return $this->load->view('job/email_template/invoice-new', $this->page_data, true);
    }

    public function send_customer_invoice_email($id)
    {
        $this->load->helper(array('url', 'hashids_helper'));
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');

        $job = $this->jobs_model->get_specific_job($id);
        if ($job) {
            //Update hashid
            if ($job->hash_id == '') {
                $eid      = hashids_encrypt($job->job_unique_id, '', 15);
                $job_id   = hashids_decrypt($eid, '', 15);
                $this->jobs_model->update($job->id, ['hash_id' => $eid]);
            } else {
                $eid      = $job->hash_id;
                $job_id   = hashids_decrypt($eid, '', 15);
            }

            $url = base_url('/job_invoice_view/' . $eid);
            $customer = $this->AcsProfile_model->getByProfId($job->customer_id);

            $get_company_info = array(
                'where' => array(
                    'company_id' => $job->company_id,
                ),
                'table' => 'business_profile',
                'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
            );

            $company   = $this->general_model->get_data_with_param($get_company_info, false);
            $jobs_data_items = $this->jobs_model->get_specific_job_items($job_id);
            $group_items = array();
            foreach ($jobs_data_items as $ji) {
                $type = 'product';
                if ($ji->type != 'product') {
                    $type = 'service';
                }
                $group_items[$type][] = [
                    'item_name' => $ji->title,
                    'item_price' => $ji->price,
                    'item_qty' => $ji->qty,
                    'item_tax' => $ji->tax
                ];
            }
            $msg = "";
            $subject = "nSmartrac: {$job->job_number} Invoice";
            $img_source = base_url('/uploads/users/business_profile/' . $company->id . '/' . $company->business_image);
            $msg .= "<img style='width: 300px;margin-top:41px;margin-bottom:24px;' alt='Logo' src='" . $img_source . "' /><br />";
            $msg .= "<h1>Your Invoice from " . $company->business_name . "</h1><br />";
            $msg .= "<p>Hi " . $customer->first_name . ",</p>";
            $msg .= "<p>Attached please find invoice <b>#" . $job->job_number . "</b> for your service</p>";
            $msg .= "<p>Thank you,</p><br />";

            $msg .= "<table>";
            $msg .= "<tr><td><b>Invoice Number</b></td><td>: " . $job->job_number . "</td></tr>";
            $msg .= "<tr><td><b>Service Date</b></td><td>: " . date('m/d/Y', strtotime($job->start_date)) . "</td></tr>";
            $msg .= "<tr><td colspan='2'><br /></td></tr>";
            $msg .= "<tr><td><b>Customer Name</b></td><td>: " . $job->first_name . ' ' . $job->last_name . "</td></tr>";
            $msg .= "<tr><td><b>Service Address</b></td><td>: " . $job->cust_city . ' ' . $job->cust_state . ' ' . $job->cust_zip_code . "</td></tr>";
            $msg .= "</table>";

            $grand_total = 0;
            foreach ($group_items as $type => $items) {
                $subtotal = 0;

                $msg .= "<h2>" . ucfirst($type) . "</h2>";
                $msg .= "<table>";
                foreach ($items as $i) {
                    $total = $i['item_price'] * $i['item_qty'];
                    $total_tax = $total_tax + $i['tax'];
                    //$msg  .= "<tr><td>".$item->title."</td><td>".$item->qty."x".$item->price."</td><td>".number_format((float)$total,2,'.',',')."</td></tr>";
                    $msg  .= "<tr><td width='300'>" . $i['item_name'] . "</td><td>" . number_format((float)$total, 2, '.', ',') . "</td></tr>";
                    $subtotal = $subtotal + $total;
                }
                $msg .= "<tr><td colspan='2'><hr /></td></tr>";
                $msg .= "<tr><td width='300'>Subtotal</td><td>" . number_format((float)$subtotal, 2, '.', ',') . "</td></tr>";
                $msg .= "</table>";

                $grand_total += $subtotal;
            }

            $nsmart_logo  = base_url("assets/dashboard/images/logo.png");
            $refer_friend = base_url("assets/img/refer_friend.jpg");
            $refer_friend_url = base_url('refer_friend');

            $msg .= "<br /><br />";
            $msg .= "<table>";
            //$msg .= "<tr><td width='300'><h3>Amount Due</h3></td><td><h2>".number_format((float)$grand_total, 2, '.', ',')."</h2></td></tr>";
            $msg .= "<tr><td width='300'><h3>Amount Due</h3></td><td><h2>" . number_format((float)$job->total_amount, 2, '.', ',') . "</h2></td></tr>";
            $msg .= "<tr><td colspan='2'><br><br></td></tr>";
            $msg .= "<tr><td colspan='2' style='text-align:center;'><a href='" . $url . "' style='background-color:#32243d;color:#fff;padding:10px 25px;border:1px solid transparent;border-radius:2px;font-size:22px;text-decoration:none;'>PAY NOW</a></td></tr>";
            $msg .= "</table>";

            if ($job->invoice_term != '') {
                $msg .= $job->invoice_term;
            } else {
                $msg .= "<p style='margin-top:43px;width:23%;color:#222;font-size:16px;text-align:left;padding:19px;'>Delinquent Account are subject to Property Liens. Interest will be charged to delinquent accounts at the rate of 1.5% (18% Annum) per month. In the event of default, the customer agrees to pay all cost of collection, including attorney's fees, whether suit is brought or not.</p>";
            }

            $msg .= "<p style='width:24%;color:#222;font-size:16px;text-align:center;padding:1px;'><a href='tel:" . $company->business_phone . "'>" . $company->business_phone . "</a> | <a href='mailto:" . $company->business_email . "'>" . $company->business_email . "</a></p>";
            $msg .= "<a href='" . $refer_friend_url . "' style='margin-left:156px;'><img src='" . $refer_friend . "' style='width:122px;' /></a>";

            $msg .= "<br><br><br><br><br>";

            $msg .= "<table style='margin-left:48px;'>";
            $msg .= "<tr><td colspan='2' style='text-align:center;'><span style='display:inline-block;'>Powered By</span> <br><br> <img style='width:328px;margin-bottom:40px;' src='" . $nsmart_logo . "' /></td></tr>";
            $msg .= "</table>";

            $recipient = $customer->email;
            $attachment = $this->create_job_invoice_pdf($job->job_unique_id);

            $mail = email__getInstance(['subject' => $subject]);
            $mail->FromName = 'NsmarTrac';
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $this->generateJobInvoiceHTML($job->job_unique_id);
            // $mail->addAttachment($attachment);
            $sendEmail = $mail->Send();
            if (!$sendEmail) {
                $this->session->set_flashdata('alert-type', 'danger');
                $this->session->set_flashdata('alert', 'Cannot send email.');
            } else {
                // START: SEND DATA TO `invoices` TABLE WHEN CLICK ON "SEND INVOICE" BUTTON
                // START: INCREMENT THE LAST `invoice_number` INSERTED TO CREATE NEW INVOICE NUMBER;
                $INVOICE_NUMBER_LAST = $this->invoice_model->getlastInsert()[0]->invoice_number;
                $INVOICE_NUMBER_LAST = str_replace("INV-", "", $INVOICE_NUMBER_LAST);
                $INVOICE_NUMBER_LAST = "INV-" . str_pad($INVOICE_NUMBER_LAST + 1, 9, "0", STR_PAD_LEFT);
                // END: INCREMENT THE LAST `invoice_number` INSERTED TO CREATE NEW INVOICE NUMBER;
                $JOB_INFO = $this->jobs_model->GET_JOB_INFO($job->id);
                $JOB_INFO_ARRAY = array(
                    "job_id" => $JOB_INFO->id,
                    "customer_id" => $JOB_INFO->customer_id,
                    "job_location" => $JOB_INFO->job_location,
                    "job_name" => $JOB_INFO->job_type,
                    "job_number" => $JOB_INFO->job_number,
                    "date_issued" => $JOB_INFO->date_issued,
                    "status" => $JOB_INFO->status,
                    "tags" => $JOB_INFO->tags,
                    "signature" => $JOB_INFO->signature,
                    "date_created" => $JOB_INFO->date_created,
                    "date_updated" => $JOB_INFO->date_updated,
                    "company_id" => $JOB_INFO->company_id,
                    "invoice_number" => $INVOICE_NUMBER_LAST,
                    "grand_total" => $JOB_INFO->amount,
                    "status" => "Submitted",
                );
                $this->jobs_model->INSERT_JOB_INFO($JOB_INFO_ARRAY);
                // END: SEND DATA TO `invoices` TABLE WHEN CLICK ON "SEND INVOICE" BUTTON
                $this->general->update_with_key(['status' => 'Invoiced'], $job->id, 'jobs');
                $this->session->set_flashdata('alert-type', 'success');
                $this->session->set_flashdata('alert', 'Your invoice was successfully sent');
            }
        } else {
            $this->session->set_flashdata('message', 'Cannot find data.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }
        // redirect('job/new_job1/'.$job->id);
    }

    public function sendCustomerInvoiceToEmail($id) {
        $this->load->helper(['url', 'hashids_helper']);
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');

        $job = $this->jobs_model->get_specific_job($id);
        if ($job) {
            //Update hashid
            if ($job->hash_id == '') {
                $eid = hashids_encrypt($job->job_unique_id, '', 15);
                $job_id = hashids_decrypt($eid, '', 15);
                $this->jobs_model->update($job->id, ['hash_id' => $eid]);
            } else {
                $eid = $job->hash_id;
                $job_id = hashids_decrypt($eid, '', 15);
            }

            $url = base_url('/job_invoice_view/' . $eid);
            $customer = $this->AcsProfile_model->getByProfId($job->customer_id);

            $get_company_info = [
                'where' => [
                    'company_id' => $job->company_id,
                ],
                'table' => 'business_profile',
                'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
            ];

            $company = $this->general_model->get_data_with_param($get_company_info, false);
            $jobs_data_items = $this->jobs_model->get_specific_job_items($job_id);
            $group_items = [];
            foreach ($jobs_data_items as $ji) {
                $type = 'product';
                if ($ji->type != 'product') {
                    $type = 'service';
                }
                $group_items[$type][] = [
                    'item_name' => $ji->title,
                    'item_price' => $ji->price,
                    'item_qty' => $ji->qty,
                    'item_tax' => $ji->tax,
                ];
            }
            $msg = "";
            $subject = "nSmartrac: {$job->job_number} Invoice";
            $img_source = base_url('/uploads/users/business_profile/' . $company->id . '/' . $company->business_image);
            $msg .= "<img style='width: 300px;margin-top:41px;margin-bottom:24px;' alt='Logo' src='" . $img_source . "' /><br />";
            $msg .= "<h1>Your Invoice from " . $company->business_name . "</h1><br />";
            $msg .= "<p>Hi " . $customer->first_name . ",</p>";
            $msg .= "<p>Attached please find invoice <b>#" . $job->job_number . "</b> for your service</p>";
            $msg .= "<p>Thank you,</p><br />";

            $msg .= "<table>";
            $msg .= "<tr><td><b>Invoice Number</b></td><td>: " . $job->job_number . "</td></tr>";
            $msg .= "<tr><td><b>Service Date</b></td><td>: " . date('m/d/Y', strtotime($job->start_date)) . "</td></tr>";
            $msg .= "<tr><td colspan='2'><br /></td></tr>";
            $msg .= "<tr><td><b>Customer Name</b></td><td>: " . $job->first_name . ' ' . $job->last_name . "</td></tr>";
            $msg .= "<tr><td><b>Service Address</b></td><td>: " . $job->cust_city . ' ' . $job->cust_state . ' ' . $job->cust_zip_code . "</td></tr>";
            $msg .= "</table>";

            $grand_total = 0;
            foreach ($group_items as $type => $items) {
                $subtotal = 0;

                $msg .= "<h2>" . ucfirst($type) . "</h2>";
                $msg .= "<table>";
                foreach ($items as $i) {
                    $total = $i['item_price'] * $i['item_qty'];
                    $total_tax = $total_tax + $i['tax'];
                    //$msg  .= "<tr><td>".$item->title."</td><td>".$item->qty."x".$item->price."</td><td>".number_format((float)$total,2,'.',',')."</td></tr>";
                    $msg .= "<tr><td width='300'>" . $i['item_name'] . "</td><td>" . number_format((float) $total, 2, '.', ',') . "</td></tr>";
                    $subtotal = $subtotal + $total;
                }
                $msg .= "<tr><td colspan='2'><hr /></td></tr>";
                $msg .= "<tr><td width='300'>Subtotal</td><td>" . number_format((float) $subtotal, 2, '.', ',') . "</td></tr>";
                $msg .= "</table>";

                $grand_total += $subtotal;
            }

            $nsmart_logo = base_url("assets/dashboard/images/logo.png");
            $refer_friend = base_url("assets/img/refer_friend.jpg");
            $refer_friend_url = base_url('refer_friend');

            $msg .= "<br /><br />";
            $msg .= "<table>";
            //$msg .= "<tr><td width='300'><h3>Amount Due</h3></td><td><h2>".number_format((float)$grand_total, 2, '.', ',')."</h2></td></tr>";
            $msg .= "<tr><td width='300'><h3>Amount Due</h3></td><td><h2>" . number_format((float) $job->total_amount, 2, '.', ',') . "</h2></td></tr>";
            $msg .= "<tr><td colspan='2'><br><br></td></tr>";
            $msg .=
                "<tr><td colspan='2' style='text-align:center;'><a href='" .
                $url .
                "' style='background-color:#32243d;color:#fff;padding:10px 25px;border:1px solid transparent;border-radius:2px;font-size:22px;text-decoration:none;'>PAY NOW</a></td></tr>";
            $msg .= "</table>";

            if ($job->invoice_term != '') {
                $msg .= $job->invoice_term;
            } else {
                $msg .=
                    "<p style='margin-top:43px;width:23%;color:#222;font-size:16px;text-align:left;padding:19px;'>Delinquent Account are subject to Property Liens. Interest will be charged to delinquent accounts at the rate of 1.5% (18% Annum) per month. In the event of default, the customer agrees to pay all cost of collection, including attorney's fees, whether suit is brought or not.</p>";
            }

            $msg .=
                "<p style='width:24%;color:#222;font-size:16px;text-align:center;padding:1px;'><a href='tel:" .
                $company->business_phone .
                "'>" .
                $company->business_phone .
                "</a> | <a href='mailto:" .
                $company->business_email .
                "'>" .
                $company->business_email .
                "</a></p>";
            $msg .= "<a href='" . $refer_friend_url . "' style='margin-left:156px;'><img src='" . $refer_friend . "' style='width:122px;' /></a>";

            $msg .= "<br><br><br><br><br>";

            $msg .= "<table style='margin-left:48px;'>";
            $msg .= "<tr><td colspan='2' style='text-align:center;'><span style='display:inline-block;'>Powered By</span> <br><br> <img style='width:328px;margin-bottom:40px;' src='" . $nsmart_logo . "' /></td></tr>";
            $msg .= "</table>";

            $recipient = $customer->email;
            $attachment = $this->create_job_invoice_pdf($job->job_unique_id);

            $mail = email__getInstance(['subject' => $subject]);
            $mail->FromName = 'NsmarTrac';
            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $this->generateJobInvoiceHTML($job->job_unique_id);
            // $mail->addAttachment($attachment);
            $mail->Send();
        }
    }

    public function sendCustomerJobScheduled($id) {
        $this->load->helper(['url', 'hashids_helper']);
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $JOB_INFO = $this->jobs_model->get_specific_job($id);
        $COMPANY_INFO = [
            'where' => [
                'company_id' => $JOB_INFO->company_id,
            ],
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        ];
        $COMPANY_INFO = $this->general_model->get_data_with_param($COMPANY_INFO, false);
        $CUSTOMER_INFO = $this->AcsProfile_model->getByProfId($JOB_INFO->customer_id);
        // ===========================================================
        $COMPANY_LOGO = base_url("/uploads/users/business_profile/$COMPANY_INFO->id/$COMPANY_INFO->business_image");
        $COMPANY_NUMBER = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '($1) $2-$3', $COMPANY_INFO->business_phone);
        $COMPANY_EMAIL = $COMPANY_INFO->business_email;
        $EMAIL_CONTENT = "";
        $EMAIL_SUBJECT = "$COMPANY_INFO->business_name: $JOB_INFO->job_number";
        // ===========================================================
        $EMAIL_CONTENT .= "<div style='width: 450px;margin: 25px;'>";
        $EMAIL_CONTENT .= "<div><center><img style='height: auto; width: 150px; margin-bottom: 10px;' src='$COMPANY_LOGO'></center></div>";
        $EMAIL_CONTENT .= "<div><center><h2 class='SEGOE_UI_FONT'>Your Job with $COMPANY_INFO->business_name ($JOB_INFO->job_number) has been scheduled</h2></center></div>";
        $EMAIL_CONTENT .= "<div><h4 class='SEGOE_UI_FONT' style='margin-bottom: 5px;'>WHEN</h4></div>";
        $EMAIL_CONTENT .= "<div><span class='SEGOE_UI_FONT'>".date_format(date_create($JOB_INFO->job_start_date), 'l, M d, Y')." at $JOB_INFO->job_start_time"."</span></div>";
        $EMAIL_CONTENT .= "<div><h4 class='SEGOE_UI_FONT' style='margin-bottom: 5px;'>ADDRESS</h4></div>";
        $EMAIL_CONTENT .= "<div><span class='SEGOE_UI_FONT'>$JOB_INFO->mail_add, $JOB_INFO->cust_city, $JOB_INFO->cust_state $JOB_INFO->cust_zip_code</span></div>";
        $EMAIL_CONTENT .= "<div><iframe height='250' width='100%' style='border:0;margin-top:10px;margin-bottom: 5px;' src='http://maps.google.com/maps?q=$JOB_INFO->mail_add, $JOB_INFO->cust_city, $JOB_INFO->cust_state $JOB_INFO->cust_zip_code&amp;output=embed'></iframe></div>";
        $EMAIL_CONTENT .= "<div><h4 class='SEGOE_UI_FONT' style='margin-bottom: 5px;'>JOB DESCRIPTION</h4></div>";
        $EMAIL_CONTENT .= "<div style='margin-bottom: 3px;'><span class='SEGOE_UI_FONT'>$JOB_INFO->job_type - $JOB_INFO->tags</span></div>";
        $EMAIL_CONTENT .= "<div><span class='SEGOE_UI_FONT' style='color: gray;'>$JOB_INFO->job_description</span></div>";
        $EMAIL_CONTENT .= "<br>";
        $EMAIL_CONTENT .= "<br>";
        $EMAIL_CONTENT .= "<br>";
        $EMAIL_CONTENT .= "<div><center class='SEGOE_UI_FONT' style='margin-bottom: 8px;'>$COMPANY_NUMBER | $COMPANY_EMAIL</center></div>";
        $EMAIL_CONTENT .= "<div><center class='SEGOE_UI_FONT' style='text-decoration-line: underline;'>$COMPANY_INFO->street, $COMPANY_INFO->city, $COMPANY_INFO->state $COMPANY_INFO->postal_code</center></div>";
        $EMAIL_CONTENT .= "</div>";
        $EMAIL_CONTENT .= "<style>.SEGOE_UI_FONT {font-family: segoe UI;}</style>";
        $RECIPIENT = $CUSTOMER_INFO->email;
        $EMAILER = email__getInstance(['subject' => $EMAIL_SUBJECT]);
        $EMAILER->FromName = "$COMPANY_INFO->business_name";
        $EMAILER->addAddress($RECIPIENT, $RECIPIENT);
        $EMAILER->isHTML(true);
        $EMAILER->Subject = $EMAIL_SUBJECT;
        $EMAILER->Body = $EMAIL_CONTENT;
        $EMAILER->Send();
        // echo "<pre>";
        // print_r ($JOB_INFO);
        // echo "</pre>";
        // echo "<pre>";
        // print_r ($COMPANY_INFO);
        // echo "</pre>";
        // echo "<pre>";
        // print_r ($CUSTOMER_INFO);
        // echo "</pre>";
    }

    public function create_job_invoice_pdf($job_id)
    {
        // load models
        $this->load->model('general_model');
        $this->load->model('jobs_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');

        // load helpers
        $this->load->helper('functions');

        $job = $this->jobs_model->get_specific_job($job_id);
        $get_company_info = array(
            'where' => array(
                'company_id' => $job->company_id,
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );
        $onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($job->company_id);
        $this->page_data['onlinePaymentAccount'] = $onlinePaymentAccount;
        $this->page_data['company_info'] = $this->general_model->get_data_with_param($get_company_info, false);
        $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($job_id);
        $this->page_data['jobs_data'] = $job;
        //$content = $this->load->view('job/job_customer_invoice_pdf', $this->page_data, TRUE);
        $content = $this->load->view('job/job_customer_invoice_pdf_template_b', $this->page_data, true);
        //echo $content;exit;

        $this->load->library('Reportpdf');
        $title = 'jobinvoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        //$obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetMargins(10, 5, 10, 0, true);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        //$obj_pdf->SetFont('courierI', '', 9);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $obj_pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        ob_clean();
        $obj_pdf->lastPage();
        // $obj_pdf->Output($title, 'I');
        $filename = strtolower($job->job_number) . ".pdf";
        $file     = dirname(__DIR__, 2) . '/uploads/job_invoce_pdf/' . $filename;
        $obj_pdf->Output($file, 'F');
        //$obj_pdf->Output($file, 'F');
        return $file;
    }

    public function save_cc_payment()
    {
        $comp_id = logged('company_id');
        $user_id = logged('id');
        $post    = $this->input->post();

        echo "<pre>";
        print_r($post);
        exit;
    }

    public function update_settings()
    {
        $cid  = logged('company_id');
        $post = $this->input->post();
        $settings = $this->jobs_model->getJobSettingsByCompanyId($cid);

        $data = [
            'company_id' => $cid,
            'job_num_prefix' => $post['job_settings_prefix'],
            'job_num_next' => $post['job_settings_next_number'],
            'job_account_next_num' => (int)$post['job_settings_account_number_next_number']
        ];

        if ($settings) {
            $this->jobs_model->updateJobSettingsByCompanyId($cid, $data);
        } else {
            $this->general->add_($data, 'job_settings');
        }

        echo 1;
        exit;
    }


    public function apiGetJobTypes()
    {
        $query = [
            'where' => [
                'company_id' => logged('company_id')
            ],
            'table' => 'job_types',
            'select' => 'id,title,icon_marker',
            'order' => [
                'order_by' => 'id',
                'ordering' => 'DESC',
            ],
        ];

        $result = $this->general->get_data_with_param($query);

        $search = strtolower($this->input->get('search'));
        if (!empty($search)) {
            $result = array_filter($result, function ($item) use ($search) {
                return strpos(strtolower($item->title), $search) !== false;
            });
        }

        header('content-type: application/json');
        exit(json_encode(['data' => array_values($result)]));
    }

    public function apiGetJobTags()
    {
        $query = [
            'where' => [
                'company_id' => logged('company_id')
            ],
            'table' => 'job_tags',
            'select' => 'id,name,marker_icon',
        ];

        $result = $this->general->get_data_with_param($query);

        $search = strtolower($this->input->get('search'));
        if (!empty($search)) {
            $result = array_filter($result, function ($item) use ($search) {
                return strpos(strtolower($item->name), $search) !== false;
            });
        }

        header('content-type: application/json');
        exit(json_encode(['data' => array_values($result)]));
    }

    public function apiGetJobTaxRates()
    {
        $get_settings = [
            'where' => [
                'company_id' => logged('company_id')
            ],
            'or_where' => ['is_default' => 1],
            'table' => 'tax_rates',
            'select' => '*',
        ];

        $result = $this->general->get_data_with_param($get_settings);

        $search = strtolower($this->input->get('search'));
        if (!empty($search)) {
            $result = array_filter($result, function ($item) use ($search) {
                return strpos(strtolower($item->name), $search) !== false;
            });
        }

        header('content-type: application/json');
        exit(json_encode(['data' => array_values($result)]));
    }

    public function ajax_quick_view_details()
    {
        $this->load->helper('functions');

        $post    = $this->input->post();
        $comp_id = logged('company_id');
        $user_id = logged('id');
        $id      = $post['appointment_id'];

        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_email,street,city,postal_code,state,business_image',
        );

        $this->page_data['cid'] = $comp_id;
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);
        $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
        $this->page_data['latest_job_payment'] = $this->jobs_model->get_latest_job_payment_by_job_id($id);        
        $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        $this->load->view('v2/pages/job/ajax_quick_view_details', $this->page_data);
    }

    public function ajax_quick_add_job_form()
    {
        $this->load->model('CalendarSettings_model');
        $this->load->model('User_docflies_model');
        $this->load->model('Contacts_model');

        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // get all employees
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
        $this->page_data['table'] = 'job';

        // check if settings has been set
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_job_settings);

        $settings = $this->CalendarSettings_model->getByCompanyId($comp_id);
        $this->page_data['settings'] = $settings;

        // add default event settings if not set
        if (empty($event_settings)) {
            $event_settings_data = array(
                'job_num_prefix' => 'JOB',
                'job_num_next' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'job_settings');
        }

        $get_sales_rep = array(
            'where' => array(
                'users.company_id' => $comp_id
            ),
            'table' => 'users',
            'distinct' => true,
            'select' => 'users.id, users.FName, users.LName',
            'join' => array(
                'table' => 'acs_office',
                'statement' => 'users.id = acs_office.fk_sales_rep_office',
                'join_as' => 'left',
            ),
        );
        $this->page_data['sales_rep'] = $this->general->get_data_with_param($get_sales_rep);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_tags',
            'select' => 'id,name,marker_icon',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);

        $get_job_types = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_types',
            'select' => 'id,title,icon_marker',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_company_info = array(
            'where' => array(
                'company_id' => $comp_id,
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);

        // get items
        $get_items = array(
            'where' => array(
                'is_active' => 1,
                'company_id' => $comp_id
            ),
            'table' => 'items',
            'select' => 'items.id,title,price,type',
        );
        $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        $get_settings = array(
            'table' => 'job_tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_settings);

        add_css([
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        ]);

        add_footer_js([
            'https://html2canvas.hertzen.com/dist/html2canvas.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
        ]);

        $default_start_date = date("Y-m-d");
        if ($this->input->get('date_selected')) {
            $default_start_date = $this->input->get('date_selected');
        }

        //esign templates
        $esignTemplates  = $this->User_docflies_model->getAllDocfileTemplatesByCompanyId($comp_id);
        $defaultTemplate = $this->User_docflies_model->getDefaultTemplateByCompanyId($comp_id);
        if( $defaultTemplate ){
            foreach($esignTemplates as $record){
                $record->is_default = $defaultTemplate->template_id == $record->id ? 1 : 0;
            }
        }

        $contactRelationshipOptions = $this->Contacts_model->optionRelations();

        $this->page_data['contactRelationshipOptions'] = $contactRelationshipOptions;      
        $this->page_data['esignTemplates'] = $esignTemplates;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->load->view('v2/pages/job/ajax_quick_add_job_form', $this->page_data);
    }

    public function ajax_create_job()
    {
        $this->load->helper(array('hashids_helper'));

        $is_valid = 1;
        $msg = '';
        $esign_id = 0; 
        $card_type = '';   

        $comp_id = logged('company_id');
        $user_id = logged('id');
        $input   = $this->input->post();

        // Point Rating System set data into variables
        $point = 1;
        $employee_type = "tech_rep";
        $module = "job";
        $employee_ids = [
            $input['employee2_id'],
            $input['employee3_id'],
            $input['employee4_id'],
            $input['employee5_id'],
            $input['employee6_id'],
        ]; 

        if ($input['event_color'] == '') {
            $msg = 'Please select event color';
            $is_valid = 0;
        }

        if ($input['customer_id'] == 0 || $input['customer_id'] == '') {
            $msg = 'Please select customer';
            $is_valid = 0;
        }

        if( $this->input->post('is_with_esign') && $this->input->post('bill_method') == 'CC' ){
            $card_details = [
                'card_number' => $this->input->post('customer_cc_num'),
                'card_month' => $this->input->post('customer_cc_expiry_date_month'),
                'card_year' => $this->input->post('customer_cc_expiry_date_year'),
                'card_cvc' => $this->input->post('customer_cc_cvc')
            ];
            $helper = new Stripe;
            $result = $helper->validateCardDetails($card_details);
            if( !$result['is_valid'] ){
                $msg = $result['error_mesasge'];
                $is_valid = 0;
            }else{
                $card_type = $result['card']['brand'];
            }
        }

        $payment_method = '';
        if( $this->input->post('is_with_esign') ){
            $payment_method = $this->input->post('bill_method');
        }

        if ($is_valid != 0) {
            $get_job_settings = array(
                'where' => array(
                    'company_id' => $comp_id
                ),
                'table' => 'job_settings',
                'select' => '*',
            );

            $job_settings = $this->general->get_data_with_param($get_job_settings);
            if ($job_settings) {
                $prefix   = $job_settings[0]->job_num_prefix;
                $next_num = str_pad($job_settings[0]->job_num_next, 5, '0', STR_PAD_LEFT);
            } else {
                $prefix = 'JOB-';
                $lastId = $this->jobs_model->getlastInsert($comp_id);
                if ($lastId) {
                    $next_num = $lastId->id + 1;
                    $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
                } else {
                    $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
                }
            }

            $job_number = $prefix . $next_num;

            $monthly_monitoring_cost = 0;
            $update_customer_mmr     = 0;
            $update_customer_billing = 0;
            $installation_cost = 0;
            $otp_cost = 0;
            $user_docfile_template_id = 0;
            if( $this->input->post('is_with_esign') ){
                $otp_cost = $this->input->post('otp');
                $installation_cost = $this->input->post('installation_cost');
                $monthly_monitoring_cost = $this->input->post('monthly_monitoring_rate_value');
                $esign_id = $this->input->post('esign_template');
                $update_customer_mmr = 1;
                $update_customer_billing = 1;
                $user_docfile_template_id = $this->input->post('esign_template');
            }

            $jobs_data = array(
                'job_number' => $job_number,
                'customer_id' => $input['customer_id'],
                'employee_id' => $input['employee_id'],
                'employee2_id' => $input['employee2_id'],
                'employee3_id' => $input['employee3_id'],
                'employee4_id' => $input['employee4_id'],
                'employee5_id' => $input['employee5_id'],
                'employee6_id' => $input['employee6_id'],
                'job_name' => $input['job_name'],
                'job_description' => $input['job_description'],
                'start_date' => $input['start_date'],
                'start_time' => $input['start_time'],
                'end_date' => $input['end_date'],
                'end_time' => $input['end_time'],
                'event_color' => $input['event_color'],
                'customer_reminder_notification' => $input['customer_reminder_notification'],
                'priority' => $input['priority'], //$this->input->post('job_priority'),
                'tags' => $input['tags'], //$this->input->post('job_priority'),
                'status' => 'Scheduled', //$this->input->post('job_status'),
                'message' => $input['job_notes'],
                'company_id' => $comp_id,
                'date_created' => date('Y-m-d H:i:s'),
                //'notes' => $input['notes'],
                'attachment' => '',
                'tax_rate' => '0',
                'job_type' => $input['job_type'],
                'date_issued' => $input['start_date'],
                'user_docfile_template_id' => $user_docfile_template_id,
                'installation_cost' => $installation_cost,
                'monthly_monitoring' => $monthly_monitoring_cost,
                'program_setup' => $otp_cost
            );

            // INSERT DATA TO JOBS TABLE
            $jobs_id = $this->general->add_return_id($jobs_data, 'jobs');

            // Point Rating System insert action
            $this->PointRatingSystemModel->addPointRating($comp_id, $employee_type, $employee_ids, $module, $jobs_id, $point);

            //Create hash_id
            $job_hash_id = hashids_encrypt($jobs_id, '', 15);
            $this->jobs_model->update($jobs_id, ['hash_id' => $job_hash_id]);
            customerAuditLog(logged('id'), $input['customer_id'], $jobs_id, 'Jobs', 'Added New Job #' . $job_number);

            //Create invoice
            $this->createInitialInvoice($jobs_id);

            //Google Calendar
            createSyncToCalendar($jobs_id, 'job', $comp_id);

            // insert data to job items table (items_id, qty, jobs_id)
            $total_amount = 0;
            if (isset($input['item_id'])) {
                $devices = count($input['item_id']);                
                for ($xx = 0; $xx < $devices; $xx++) {
                    $total_amount = $total_amount + ($input['item_qty'][$xx] * $input['item_price'][$xx]);
                    $job_items_data = array();
                    $job_items_data['job_id'] = $jobs_id; //from jobs table
                    $job_items_data['items_id'] = $input['item_id'][$xx];
                    $job_items_data['qty'] = $input['item_qty'][$xx];
                    $job_items_data['cost'] = $input['item_price'][$xx];
                    $this->general->add_($job_items_data, 'job_items');
                    unset($job_items_data);
                }
            }

            // insert data to job settings table
            $jobs_settings_data = array(
                'job_num_next' => $job_settings[0]->job_num_next + 1
            );
            $this->general->update_with_key($jobs_settings_data, $job_settings[0]->id, 'job_settings');

            // insert data to job payments table
            $job_payment_query = array(
                'amount' => $total_amount,
                'job_id' => $jobs_id,
            );
            $this->general->add_($job_payment_query, 'job_payments');

            //SMS Notification
            createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', $input['employee_id'], $input['employee_id'], 0);

            if ($input['employee2_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee2_id'], 0);
            }
            if ($input['employee3_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee3_id'], 0);
            }
            if ($input['employee4_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee4_id'], 0);
            }
            if ($input['employee5_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee5_id'], 0);
            }
            if ($input['employee6_id'] > 0) {
                createCronAutoSmsNotification($comp_id, $jobs_id, 'job', 'Scheduled', 0, $input['employee6_id'], 0);
            }

            //Activity Logs
            $activity_name = 'Created Caledar Schedule ' . $job_number; 
            createActivityLog($activity_name);

            if( $this->input->post('is_with_esign') ){
                //Emergency Contacts
                $payload    = [];
                $postData   = $this->input->post();
                $customerId = $this->input->post('customer_id');
                $saveToPayload = function ($customerNumber) use (&$payload, $postData, $customerId) {
                    if (empty(trim($postData['contact_first_name'.$customerNumber]))) {
                        return; // ignore empty contact with empty name
                    }
        
                    $name = trim($postData['contact_first_name'.$customerNumber]) . ' ' . trim($postData['contact_last_name'.$customerNumber]);
                    array_push($payload, [
                        'first_name' => trim($postData['contact_first_name'.$customerNumber]),
                        'last_name' => trim($postData['contact_last_name'.$customerNumber]),
                        'relation' => $postData['contact_relationship'.$customerNumber],
                        'phone' => $postData['contact_phone'.$customerNumber],
                        'customer_id' => $customerId,
                        'phone_type' => 'mobile',
                        'name' => $name
                    ]);
                };
        
                $saveToPayload(1);
                $saveToPayload(2);
                $saveToPayload(3);

                if (!empty($payload)) {
                    $this->db->where('customer_id', $customerId);
                    $this->db->delete('contacts');

                    $this->db->insert_batch('contacts', $payload);
                }
                //End Emergency Contacts
            }

            //Update customer mmr
            if( $update_customer_mmr == 1 ){
                $check = [
                    'where' => [
                        'fk_prof_id' => $this->input->post('customer_id'),
                    ],
                    'table' => 'acs_alarm',
                ];
                $exist = $this->general->get_data_with_param($check, false);
                if ($exist) {
                    $input_alarm['monthly_monitoring'] = $monthly_monitoring_cost;
                    $input_alarm['otps'] = $otp_cost;   
                    $input_alarm['monitor_id'] = $this->input->post('customer_monitoring_id');
                    $input_alarm['alarm_cs_account'] = $this->input->post('customer_monitoring_id');
                    $this->general->update_with_key_field($input_alarm, $this->input->post('customer_id'), 'acs_alarm', 'fk_prof_id');
                }else{
                    $input_alarm['fk_prof_id'] = $this->input->post('customer_id');
                    $input_alarm['monitor_comp'] = '';                    
                    $input_alarm['acct_type'] = '';
                    $input_alarm['online'] = 'Yes';
                    $input_alarm['in_service'] = 'Yes';
                    $input_alarm['equipment'] = '';
                    $input_alarm['collections'] = '';
                    $input_alarm['credit_score_alarm'] = '';
                    $input_alarm['passcode'] = '';
                    $input_alarm['install_code'] = '';
                    $input_alarm['mcn'] = 0;
                    $input_alarm['scn'] = 0;
                    $input_alarm['panel_type'] = '';
                    $input_alarm['plan_type']  = '';
                    $input_alarm['system_type'] = '';
                    $input_alarm['warranty_type'] = '';
                    $input_alarm['dealer'] = '';
                    $input_alarm['alarm_login'] = '';
                    $input_alarm['alarm_customer_id'] = '';                    
                    $input_alarm['comm_type'] = '';
                    $input_alarm['account_cost'] = 0;
                    $input_alarm['pass_thru_cost'] = 0;
                    $input_alarm['monthly_monitoring'] = $monthly_monitoring_cost;
                    $input_alarm['otps'] = $otp_cost;   
                    $input_alarm['monitor_id'] = $this->input->post('customer_monitoring_id');
                    $input_alarm['alarm_cs_account'] = $this->input->post('customer_monitoring_id');
                    $this->general->add_($input_alarm, 'acs_alarm');
                }
            }else{
                $check = [
                    'where' => [
                        'fk_prof_id' => $this->input->post('customer_id'),
                    ],
                    'table' => 'acs_alarm',
                ];
                $exist = $this->general->get_data_with_param($check, false);
                if ($exist) {
                    $input_alarm['panel_type'] = $this->input->post('panel_type');
                    $this->general->update_with_key_field($input_alarm, $this->input->post('customer_id'), 'acs_alarm', 'fk_prof_id');
                }else{
                    $input_alarm['fk_prof_id'] = $this->input->post('customer_id');
                    $input_alarm['monitor_comp'] = '';                    
                    $input_alarm['acct_type'] = '';
                    $input_alarm['online'] = 'Yes';
                    $input_alarm['in_service'] = 'Yes';
                    $input_alarm['equipment'] = '';
                    $input_alarm['collections'] = '';
                    $input_alarm['credit_score_alarm'] = '';
                    $input_alarm['passcode'] = '';
                    $input_alarm['install_code'] = '';
                    $input_alarm['mcn'] = 0;
                    $input_alarm['scn'] = 0;
                    $input_alarm['panel_type'] = $this->input->post('panel_type');
                    $input_alarm['system_type'] = '';
                    $input_alarm['warranty_type'] = $this->input->post('warranty_type');
                    $input_alarm['dealer'] = '';
                    $input_alarm['alarm_login'] = '';
                    $input_alarm['alarm_customer_id'] = '';                    
                    $input_alarm['comm_type'] = '';
                    $input_alarm['account_cost'] = 0;
                    $input_alarm['pass_thru_cost'] = 0;
                    $input_alarm['monthly_monitoring'] = $monthly_monitoring_cost;
                    $input_alarm['otps'] = $otp_cost;   
                    $input_alarm['monitor_id'] = '';
                    $input_alarm['alarm_cs_account'] = '';
                    $this->general->add_($input_alarm, 'acs_alarm');
                }
            }
        }

        $json_data = ['is_success' => $is_valid, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_quick_delete_job()
    {
        $post = $this->input->post();
        $cid  = logged('company_id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $job = $this->jobs_model->get_specific_job($post['schedule_id']);
        if ($job) {

            $remove_job = array(
                'where' => array(
                    'id' => $post['schedule_id'],
                    'company_id' => $cid
                ),
                'table' => 'jobs'
            );

            if ($this->general->delete_($remove_job)) {
                $remove_job_items = array(
                    'where' => array(
                        'job_id' => $job->id,
                    ),
                    'table' => 'job_items'
                );
                $this->general->delete_($remove_job_items);

                customerAuditLog(logged('id'), $job->customer_id, $job->id, 'Jobs', 'Deleted Job #' . $job->job_number);

                $is_success = 1;
                $msg = '';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_load_job_payments()
    {
        $post = $this->input->post();
        $jobPayments = $this->jobs_model->get_all_job_payments_by_job_id($post['jobid']);

        $this->page_data['jobPayments'] = $jobPayments;
        $this->load->view('v2/pages/job/ajax_load_job_payments', $this->page_data);
    }

    public function edit_job_item($id = null)
    {
        $this->load->model('AcsProfile_model');
        $this->load->helper('functions');

        add_css([
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
        ]);

        add_footer_js([
            'assets/js/esign/fill-and-sign/job/approve.js',
            'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js',
            'https://html2canvas.hertzen.com/dist/html2canvas.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
        ]);

        $comp_id = logged('company_id');
        $user_id = logged('id');

        $jobs_data = $this->jobs_model->get_specific_job($id);
        $jobs_data_items = $this->jobs_model->get_specific_job_items($id);

        $get_sales_rep = array(
            'where' => array(
                'users.company_id' => $comp_id,
                'users.id' => $jobs_data->employee_id
            ),
            'table' => 'users',
            'distinct' => true,
            'select' => 'users.id, users.FName, users.LName'
        );
        $salesRep = $this->general->get_data_with_param($get_sales_rep);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id,
                'id' => $jobs_data->employee2_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $assignedEmployee2 = $this->general->get_data_with_param($get_employee);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id,
                'id' => $jobs_data->employee3_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $assignedEmployee3 = $this->general->get_data_with_param($get_employee);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id,
                'id' => $jobs_data->employee4_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $assignedEmployee4 = $this->general->get_data_with_param($get_employee);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id,
                'id' => $jobs_data->employee5_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $assignedEmployee5 = $this->general->get_data_with_param($get_employee);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id,
                'id' => $jobs_data->employee6_id
            ),
            'table' => 'users',
            'select' => 'id, FName, LName',
        );
        $assignedEmployee6 = $this->general->get_data_with_param($get_employee);

        $assignedEmployees = array();
        if ($assignedEmployee2) {
            $assignedEmployees[] = $assignedEmployee2[0]->FName . ' ' . $assignedEmployee2[0]->LName;
        }

        if ($assignedEmployee3) {
            $assignedEmployees[] = $assignedEmployee3[0]->FName . ' ' . $assignedEmployee3[0]->LName;
        }

        if ($assignedEmployee4) {
            $assignedEmployees[] = $assignedEmployee4[0]->FName . ' ' . $assignedEmployee4[0]->LName;
        }

        if ($assignedEmployee5) {
            $assignedEmployees[] = $assignedEmployee5[0]->FName . ' ' . $assignedEmployee5[0]->LName;
        }

        // get items
        $get_items = array(
            'where' => array(
                'items.company_id' => $comp_id,
                //'is_active' => 1,
            ),
            'table' => 'items',
            'select' => 'items.id,title,price,type',
        );
        $items = $this->general->get_data_with_param($get_items);

        if ($jobs_data->estimate_id > 0) {
            $get_estimate_query = array(
                'where' => array(
                    'id' => $jobs_data->estimate_id
                ),
                'table' => 'estimates',
                'select' => '*'
            );

            $estimate_data = $this->general->get_data_with_param($get_estimate_query, false);
            if ($estimate_data) {
                if ($estimate_data->deposit_request == 2) {
                    $estimate_dp_amount = $estimate_data->grand_total * ($estimate_data->deposit_amount / 100);
                } else {
                    $estimate_dp_amount = $estimate_data->deposit_amount;
                }
            }
        }


        $customer = $this->AcsProfile_model->getByProfId($jobs_data->customer_id);
        if ($customer) {
            $default_customer_id = $customer->prof_id;
            $default_customer_name = $customer->first_name . ' ' . $customer->last_name;
        }
        $default_customer_id = $this->input->get('cus_id');

        $this->page_data['salesRep']  = $salesRep;
        $this->page_data['jobs_data'] = $jobs_data;
        $this->page_data['jobs_data_items'] = $jobs_data_items;
        $this->page_data['items']     = $items;
        $this->page_data['customer']  = $customer;
        $this->page_data['assignedEmployee2'] = $assignedEmployee2;
        $this->page_data['assignedEmployees'] = $assignedEmployees;
        $this->page_data['default_customer_id'] = $default_customer_id;
        $this->page_data['default_customer_name'] = $default_customer_name;
        $this->page_data['estimate_dp_amount'] = $estimate_dp_amount;

        $this->load->view('v2/pages/job/edit_job_item', $this->page_data);
    }

    public function api_edit_job_items($id)
    {
        $postIds = array_filter($_POST['item_id'], function ($id) {
            return $id != 0;
        });

        $this->db->where_not_in('items_id', $postIds);
        $this->db->where('job_id', $id);
        $this->db->delete('job_items');

        foreach ($_POST['item_id'] as $key => $itemId) {
            if ($itemId != 0) {
                $this->db->where('items_id', $itemId);
                $this->db->update('job_items', ['qty' => $_POST['item_qty'][$key]]);
                continue;
            }

            if ($_POST['fk_item_id'][$key] == 0) {
                continue;
            }

            $this->db->where('job_id', $id);
            $this->db->where('items_id', $_POST['fk_item_id'][$key]);
            $existingItem = $this->db->get('job_items')->row();

            if ($existingItem) {
                $this->db->where('job_id', $existingItem->job_id);
                $this->db->where('items_id', $existingItem->items_id);
                $this->db->update('job_items', ['qty' => (int) $_POST['item_qty'][$key] + (int) $existingItem->qty]);
            } else {
                $this->db->insert('job_items', [
                    'job_id' => $id,
                    'items_id' => $_POST['fk_item_id'][$key],
                    'qty' => $_POST['item_qty'][$key],
                ]);
            }
        }

        exit(json_encode(['success' => $_POST]));
    }


    public function viewInvoice($id)
    {
        $this->db->select('id');
        $this->db->where('job_id', $id);
        $jobInvoice = $this->db->get('invoices')->row();

        if (!$jobInvoice) {
            return redirect('/job/new_job1/' . $id);
        }

        // if invoice exists, redirect to genview page
        redirect('/invoice/genview/' . $jobInvoice->id . '?from=job');
    }

    public function createInitialInvoice($job_id)
    {
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_settings_model');

        $company_id = logged('company_id');
        
        $this->db->where('id', $job_id);
        $job = $this->db->get('jobs')->row();

        $this->db->where('prof_id', $job->customer_id);
        $customer = $this->db->get('acs_profile')->row();

        $workorder = array();
        if( $job->work_order_id > 0 ){
            $this->db->where('id', $job->work_order_id);
            $workorder = $this->db->get('work_orders')->row();
        }
        
        $this->db->where('job_id', $job->id);
        $jobPayments = $this->db->get('job_payments')->row();

        $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($company_id);
        if( $invoiceSettings ){            
            $next_number = (int) $invoiceSettings->invoice_num_next;     
            $prefix      = $invoiceSettings->invoice_num_prefix;        
        }else{
            $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($company_id);
            $prefix     = 'INV-';
            if( $lastInsert ){
                $next_number   = $lastInsert->id + 1;
            }else{
                $next_number   = 1;
            }
        }

        $invoiceNumber = formatInvoiceNumberV2($prefix, $next_number);        

        $monthly_monitoring = $jobPayments->monthly_monitoring;
        $program_setup      = $jobPayments->program_setup;
        $installation_cost = $jobPayments->installation_cost;

        $grand_total = $jobPayments->amount;
        $sub_total   = $jobPayments->equipment_cost;
        $tax         = $jobPayments->tax;

        // $monthly_monitoring = 0;
        // $program_setup = 0;
        // $installation_cost = 0;
        // $grand_total = 0;
        // $sub_total   = 0;
        // $tax = 0;
        // if( $job->work_order_id > 0 && !empty($workorder) ){
        //     $monthly_monitoring = $workorder->monthly_monitoring;
        //     $program_setup = $workorder->otp_setup;
        //     $installation_cost = $workorder->installation_cost;

        //     $grand_total = $workorder->grand_total;
        //     $sub_total   = $workorder->subtotal;
        //     $tax         = $workorder->taxes;
        // }elseif( !empty($jobPayments) ){
        //     $monthly_monitoring = $jobPayments->monthly_monitoring;
        //     $program_setup = $jobPayments->program_setup;
        //     $installation_cost = $jobPayments->installation_cost;

        //     $grand_total = $jobPayments->amount;
        //     $sub_total   = $jobPayments->equipment_cost;
        //     $tax         = $jobPayments->tax;
        // }

        $new_data = array(
            'customer_id'               => $job->customer_id,
            'job_location'              => $job->job_location,
            'job_name'                  => $job->job_name,
            'job_id'                    => $job->id,
            'job_number'                => $job->job_number,
            'business_name'             => $customer->business_name,
            'tags'                      => $job->tags,
            'invoice_type'              => 'Total Due',
            'work_order_number'         => !empty($workorder) ? $workorder->work_order_number : '',
            'purchase_order'            => '',
            'invoice_number'            => $invoiceNumber,
            'date_issued'               => date("Y-m-d"),
            'customer_email'            => $customer->email,
            'online_payments'           => '',
            'billing_address'           => $customer->mail_add,
            'shipping_to_address'       => $customer->mail_add,
            'ship_via'                  => '',
            'shipping_date'             => '',
            'tracking_number'           => '',
            'terms'                     => 0,     
            'tip'                       => 0,       
            'due_date'                  => date("Y-m-d", strtotime("+5 days")),
            'location_scale'            => '',
            'message_to_customer'       => '',
            'terms_and_conditions'      => !empty($workorder) ? $workorder->terms_and_conditions : '',            
            'attachments'               => $job->attachment,
            'status'                    => 'Unpaid',
            'company_id'                => $company_id,
            'deposit_request_type'      => '$',
            'deposit_request'           => '0',
            'monthly_monitoring'        => $monthly_monitoring,
            'program_setup'             => $program_setup,
            'installation_cost'         => $installation_cost,
            'payment_methods'           => $job->BILLING_METHOD,
            'sub_total'                 => $sub_total,
            'taxes'                     => $tax,
            'adjustment_name'           => !empty($workorder) ? $workorder->adjustment_name : '',
            'adjustment_value'          => !empty($workorder) ? $workorder->adjustment_value : '',
            'grand_total'               => $grand_total,
            'user_id'                   => logged('id'),
            'date_created'              => date("Y-m-d H:i:s"),
            'date_updated'              => date("Y-m-d H:i:s")
        );

        $invoice_id = $this->Invoice_model->createInvoice($new_data);

        //Update invoice settings
        if( $invoiceSettings ){
            $invoice_settings_data = ['invoice_num_next' => $next_number + 1];
            $this->Invoice_settings_model->update($invoiceSettings->id, $invoice_settings_data);
        }else{
            $invoice_settings_data = [
                'invoice_num_prefix' => $prefix,
                'invoice_num_next' => $next_number,
                'check_payable_to' => '',
                'accept_credit_card' => 1,
                'accept_check' => 0,
                'accept_cash'  => 1,
                'accept_direct_deposit' => 0,
                'accept_credit' => 0,
                'mobile_payment' => 1,
                'capture_customer_signature' => 1,
                'hide_item_price' => 0,
                'hide_item_qty' => 0,
                'hide_item_tax' => 0,
                'hide_item_discount' => 0,
                'hide_item_total' => 0,
                'hide_from_email' => 0,
                'hide_item_subtotal' => 0,
                'hide_business_phone' => 0,
                'hide_office_phone' => 0,
                'accept_tip' => 0,
                'due_terms' => '',
                'auto_convert_completed_work_order' => 0,
                'message' => 'Thank you for your business.',
                'terms_and_conditions' => 'Thank you for your business.',
                'company_id' => $company_id,
                'commercial_message' => 'Thank you for your business.',
                'commercial_terms_and_conditions' => 'Thank you for your business.',
                'logo' => '',
                'payment_fee_percent' => '',
                'payment_fee_amount' => '',
                'recurring' => ''
            ];

            $this->Invoice_settings_model->create($invoice_settings_data);
        }

        //Job Items
        $jobItems = $this->jobs_model->get_specific_job_items($job->id);
        foreach( $jobItems as $item ){
            $invoice_item_data = [
                'invoice_id' => $invoice_id,
                'items_id' => $item->fk_item_id,
                'qty' => $item->qty,
                'cost' => $item->cost,
                'tax' => $item->tax,
                'discount' => $item->discount,
                'total' => $item->total
            ];

            $this->Invoice_model->add_invoice_details($invoice_item_data);
        }

        return $invoice_id;
    }


    public function createInvoice($id)
    {
        $this->db->where('id', $id);
        $job = $this->db->get('jobs')->row();

        if (!$job) {
            return show_404();
        }       

        $this->db->select('*');
        $this->db->where('job_id', $job->id);
        $jobInvoice = $this->db->get('invoices')->row();
        
        if( empty($jobInvoice) ){
            $invoice_id = $this->createInitialInvoice($job->id);
            $this->db->select('*');
            $this->db->where('job_id', $job->id);
            $jobInvoice = $this->db->get('invoices')->row();
        }else{
            $invoice_id = $jobInvoice->id;
        }
 
        // if (!is_null($jobInvoice)) {
        //     return redirect('job/new_job1/' . $job->id);
        // }

        if ($job->work_order_id) {
            $this->db->select('installation_cost,otp_setup,monthly_monitoring');
            $this->db->where('id', $job->work_order_id);
            $workorderQuery = $this->db->get('work_orders');
            $workorder = $workorderQuery->row();
            if ($workorder) {
                $this->page_data['workorder'] = $workorder;
            }
        }

        $this->db->select('*');
        $this->db->where('job_id', $job->id);
        $jobPayments = $this->db->get('job_payments')->row();
        $this->page_data['jobPayments'] = $jobPayments;
        
        $this->db->where('prof_id', $job->customer_id);
        $customer = $this->db->get('acs_profile')->row();

        $companyId = logged('company_id');

        $tagsQuery = [
            'where' => [
                'company_id' => $companyId
            ],
            'table' => 'job_tags',
            'select' => 'id,name,marker_icon',
        ];
        $this->page_data['tags'] = $this->general->get_data_with_param($tagsQuery);

        $this->load->model('Invoice_model', 'invoice_model');
        $lastinvoice =  $this->invoice_model->getlastInsert()[0];
        if( $lastinvoice ){
            $invoiceNumberParts = explode('-', $lastinvoice->invoice_number);
            $nextInvoiceNumber = ((int) $invoiceNumberParts[1]) + 1;
            $invoiceNumber = formatInvoiceNumber('INV-' . $nextInvoiceNumber);
        }else{
            $next_number = str_pad(1, 5, '0', STR_PAD_LEFT);
            $invoiceNumber = formatInvoiceNumber('INV-' . $next_number);
        }        

        $this->page_data['job'] = $job;
        $this->page_data['customer'] = $customer;
        $this->page_data['jobInvoice'] = $jobInvoice;
        $this->page_data['invoiceNumber'] = $invoiceNumber;
        $this->page_data['invoice_id']    = $invoice_id;
        if( $jobInvoice ){
            $this->page_data['page']->title   = 'View Invoice';
        }else{
            $this->page_data['page']->title   = 'Create Invoice';
        }
        
        $this->load->view('v2/pages/job/create_invoice', $this->page_data);
    }

    public function apiGetJobItems($id)
    {
        $items = $this->jobs_model->get_specific_job_items($id);
        header('content-type: application/json');
        exit(json_encode(['data' => $items]));
    }

    public function apiGetItems()
    {
        $companyId = logged('company_id');
        $query = [
            'where' => [
                'items.company_id' => $companyId,
            ],
            'table' => 'items',
            'select' => 'items.id,title,price,type',
        ];
        $items = $this->general->get_data_with_param($query);
        header('content-type: application/json');
        exit(json_encode(['data' => $items]));
    }

    public function getItemLocation()
    {
        $comp_id = logged('company_id');
        $input = $this->input->post();

        $getLocation = array(
            'where' => array(
                'company_id' => $comp_id,
                'item_id' => $input['id'],
                'qty >=' => $input['qty'],
                'qty >' => '0'

            ),
            'table' => 'items_has_storage_loc',
            'select' => 'id,loc_id'
        );
        $location = $this->general->get_data_with_param($getLocation);

        $data_arr = array("locations" => $location);
        echo json_encode($data_arr, JSON_UNESCAPED_UNICODE);
    }

    public function braintree_send_sale($amount, $nonce)
    {
        include APPPATH . 'libraries/braintree/lib/Braintree.php'; 

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = 0;
        $msg = '';

        $comp_id = logged('company_id');
        $companyOnlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($comp_id);

        if( $companyOnlinePaymentAccount ){
            $gateway = new Braintree\Gateway([
                'environment' => BRAINTREE_ENVIRONMENT,
                'merchantId' => $companyOnlinePaymentAccount->braintree_merchant_id,
                'publicKey' => $companyOnlinePaymentAccount->braintree_public_key,
                'privateKey' => $companyOnlinePaymentAccount->braintree_private_key
            ]);
            $result = $gateway->transaction()->sale([
                'amount' => floatval($amount),
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => true
                ]
            ]);

            if($result->success || !is_null($result->transaction)) {
                $is_success = 1;
            }else{
                $errorString = "";
                foreach($result->errors->deepAll() as $error) {
                    $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
                }
                $msg = $errorString;                
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function ajax_quick_add_job_type()
    {
        $is_success = 0;
        $msg = 'Cannot save data';
        $job_type_name = '';
        $job_type_id   = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');
        $uid  = get('user_id');       

        if( $post['job_type_name'] != '' ){
            $data = [
                'user_id' =>  $uid,
                'company_id' => $cid,
                'title' => $post['job_type_name'],
                'icon_marker' => 'wrench_64px.png',
                'is_marker_icon_default_list' => 1,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];

            $job_type_id   = $this->JobType_model->createJobType($data);
            $job_type_name = $post['job_type_name'];
            
            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'Please enter job type name';
        }
        
        $json_data = [
            'is_success' => $is_success, 
            'msg' => $msg, 
            'job_type' => ['name' => $job_type_name, 'id' => $job_type_id, 'icon_marker' => 'wrench_64px.png']
        ];

        echo json_encode($json_data);
    }

    public function ajax_quick_add_job_tag()
    {
        $this->load->model('JobTags_model');

        $is_success = 0;
        $msg = 'Cannot save data';
        $job_tag_name = '';
        $job_tag_id   = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');       

        if( $post['job_tag_name'] != '' ){
            $data = [
                'name' =>  $post['job_tag_name'],
                'company_id' => $cid,
                'group_tag_id' => 0,
                'marker_icon' => 'administrative_tools_48px.png',
                'is_marker_icon_default_list' => 1,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $job_tag_id   = $this->JobTags_model->createJobTag($data);
            $job_tag_name = $post['job_tag_name'];
            
            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'Please enter job tag name';
        }
        
        $json_data = [
            'is_success' => $is_success, 
            'msg' => $msg, 
            'job_tag' => ['name' => $job_tag_name, 'id' => $job_tag_id, 'marker_icon' => 'administrative_tools_48px.png']
        ];

        echo json_encode($json_data);
    }

    public function ajax_quick_add_lead_source()
    {
        $this->load->model('LeadSource_model');

        $is_success = 0;
        $msg = 'Cannot save data';
        $lead_source_name = '';
        $lead_source_id   = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');       

        if( $post['lead_source_name'] != '' ){
            $data = [
                'fk_company_id' =>  $cid,
                'ls_name' => $post['lead_source_name'],
                'date_created' => date("Y-m-d H:i:s")
            ];

            $lead_source_id   = $this->LeadSource_model->createLeadSource($data);
            $lead_source_name = $post['lead_source_name'];
            
            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'Please enter lead source name';
        }
        
        $json_data = [
            'is_success' => $is_success, 
            'msg' => $msg, 
            'lead_source' => ['name' => $lead_source_name, 'id' => $lead_source_id]
        ];

        echo json_encode($json_data);
    }

    public function ajax_quick_add_tax_rate()
    {
        $is_success = 0;
        $msg = 'Cannot save data';
        $tax_rate_name = '';
        $tax_rate_id   = 0;
        $tax_rate_percentage = 0;

        $post = $this->input->post();
        $cid  = logged('company_id');       

        if( $post['tax_name'] != '' ){
            $data = array(
                'name' =>  $post['tax_name'],
                'rate' =>  $post['tax_rate'],
                'is_default' =>  0,
                'company_id' =>  $cid,
            );

            $tax_rate_id = $this->jobs_model->recordTaxRate("add", $data);
            $tax_rate_name = $post['tax_name'];
            $tax_rate_percentage = $post['tax_rate'];
            
            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'Please enter tax name';
        }
        
        $json_data = [
            'is_success' => $is_success, 
            'msg' => $msg, 
            'tax_rate' => ['name' => $tax_rate_name, 'rate' => $tax_rate_percentage, 'id' => $tax_rate_id]
        ];

        echo json_encode($json_data);
    }

    public function ajax_create_job_type()
    {
        $this->load->model('Icons_model');

        $is_success = 1;
        $msg = '';

        $comp_id = logged('company_id');
        $user_id = logged('id');
        $post    = $this->input->post();

        if ($post['job_type_name'] == '') {
            $is_success = 0;
            $msg = 'Please enter job type name';
        }

        if( $post['job_type_name'] != '' ){
            $isJobTypeExists = $this->JobType_model->getByTitleAndCompanyId($post['job_type_name'], $comp_id);
            if( $isJobTypeExists ){
                $is_success = 0;
                $msg = 'Job type already exists';
            }
        }

        if( $is_success == 1 ){
            if (isset($post['is_default_icon'])) {
                $icon = $this->Icons_model->getById($post['default_icon_id']);
                $marker_icon = $icon->image;
                $data_job_type = [
                    'user_id' => $user_id,
                    'company_id' => $comp_id,
                    'title' => $post['job_type_name'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => 1,
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $job_type_id = $this->JobType_model->create($data_job_type);
                if ($job_type_id > 0) {
                    //Activity Logs
                    $activity_name = 'Job Type : Created Job Type '. $post['job_type_name']; 
                    createActivityLog($activity_name);

                    $msg = '';
                }
            } else {
                if (!empty($_FILES['image']['name'])) {
                    $marker_icon = $this->moveUploadedFile();
                    $data_job_type = [
                        'user_id' => $user_id,
                        'company_id' => $comp_id,
                        'title' => $post['job_type_name'],
                        'icon_marker' => $marker_icon,
                        'is_marker_icon_default_list' => 0,
                        'status' => 1,
                        'created_at' => date("Y-m-d H:i:s")
                    ];

                    $job_type_id = $this->JobType_model->create($data_job_type);
                    if ($job_type_id > 0) {
                        //Activity Logs
                        $activity_name = 'Job Type : Created Job Type '. $post['job_type_name']; 
                        createActivityLog($activity_name);

                        $msg = '';
                    } 
                } else {
                    $is_success = 0;
                    $msg = 'Please specify job type icon / marker image';
                }
            }
        }
        
        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_update_job_type()
    {
        $this->load->model('Icons_model');

        $is_success = 1;
        $msg = '';

        $comp_id = logged('company_id');
        $post    = $this->input->post();

        if ($post['job_type_name'] == '') {
            $is_success = 0;
            $msg = 'Please enter job type name';
        }

        if( $is_success == 1 ){
            $jobType = $this->JobType_model->getById($post['jtid']);
            if ($jobType) {
                $marker_icon = $jobType->icon_marker;
                $is_marker_icon_default_list = $jobType->is_marker_icon_default_list;
                if (isset($post['is_default_icon'])) {
                    if ($post['default_icon_id'] > 0) {
                        $icon = $this->Icons_model->getById($post['default_icon_id']);
                        $marker_icon = $icon->image;
                        $is_marker_icon_default_list = 1;
                    }
                } else {
                    if ($_FILES['image']['size'] > 0) {
                        $marker_icon = $this->moveUploadedFile();
                        $is_marker_icon_default_list = 0;
                    }
                }

                $data_job_type = [
                    'title' => $post['job_type_name'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => $is_marker_icon_default_list
                ];

                $this->JobType_model->updateJobTypeById($post['jtid'], $data_job_type);

                //Activity Logs
                $activity_name = 'Job Type : Updated Job Type '.$post['job_type_name']; 
                createActivityLog($activity_name);
                
            } else {
                $is_success = 0;
                $msg = 'Record not found';
            }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_job_type()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        $jobType = $this->JobType_model->getById($post['jtid']);
        if( $jobType && $jobType->company_id == $cid ){
            //Activity Logs
            $activity_name = 'Job Type : Deleted Job Type '.$jobType->title; 
            createActivityLog($activity_name);

            $this->JobType_model->delete($post['jtid']);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_job_tag()
    {
        $is_success = 0;
        $msg        = 'Cannot find data';

        $this->load->model('JobTags_model');
        $company_id = logged('company_id');

        $remove_tag = array(
            'where' => array(
                'id' => $_POST['tag_id']
            ),
            'table' => 'job_tags'
        );

        $jobTag = $this->JobTags_model->getByIdAndCompanyId($_POST['tag_id'], $company_id);

        if( $jobTag && $jobTag->company_id == $company_id ) {
    
            if ($this->general->delete_($remove_tag)) {
                //Activity Logs
                $activity_name = 'Deleted Job Tag '.$jobTag->name; 
                createActivityLog($activity_name);
                $is_success = 1;
                $msg = '';
            }            

        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);        
    }    

    public function ajax_quick_create_job_type()
    {
        $this->load->model('Icons_model');

        $is_success = 1;
        $msg        = '';
        $job_type_name = '';

        $cid = logged('company_id');
        $uid = logged('id');
        $post = $this->input->post();
        
        if ($post['job_type_name'] == '') {
            $is_success = 0;
            $msg = 'Please enter job type name';
        }

        if( $post['job_type_name'] != '' ){
            $isJobTypeExists = $this->JobType_model->getByTitleAndCompanyId($post['job_type_name'], $cid);
            if( $isJobTypeExists ){
                $is_success = 0;
                $msg = 'Job type already exists';
            }
        }

        if( $is_success == 1 ){
            $data_job_type = [
                'user_id' => $uid,
                'company_id' => $cid,
                'title' => $post['job_type_name'],
                'icon_marker' => 'settings_48px.png',
                'is_marker_icon_default_list' => 1,
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ];

            $job_type_id = $this->JobType_model->create($data_job_type);
            if ($job_type_id > 0) {
                //Activity Logs
                $activity_name = 'Job Type : Created Job Type '. $post['job_type_name']; 
                createActivityLog($activity_name);

                $job_type_name = $post['job_type_name'];
            }

        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'job_type_name' => $job_type_name
        ];

        echo json_encode($return);        
    }

    public function ajax_quick_create_job_tag()
    {
        $this->load->model('JobTags_model');

        $is_success = 1;
        $msg        = '';
        $job_tag_name = '';

        $cid = logged('company_id');
        $uid = logged('id');
        $post = $this->input->post();
        
        if ($post['job_tag_name'] == '') {
            $is_success = 0;
            $msg = 'Please enter job tag name';
        }

        if( $post['job_tag_name'] != '' ){
            $isJobTagExists = $this->JobTags_model->getByNameAndCompanyId($post['job_tag_name'], $cid);
            if( $isJobTagExists ){
                $is_success = 0;
                $msg = 'Job tag already exists';
            }
        }

        if( $is_success == 1 ){
            $data = [
                'name' => $post['job_tag_name'],
                'company_id' => $cid,
                'marker_icon' => 'settings_48px.png',
                'is_marker_icon_default_list' => 1
            ];

            $this->JobTags_model->create($data);

            //Activity Logs
            $activity_name = 'Created Job Tag '.$post['job_tag_name']; 
            createActivityLog($activity_name);

            $job_tag_name = $post['job_tag_name'];

        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'job_tag_name' => $job_tag_name
        ];

        echo json_encode($return);        
    }

    public function ajax_archived_list()
    {
        $this->load->model('estimate_model');

        $post = $this->input->post();
        $cid  = logged('company_id');

        $jobs = $this->jobs_model->getAllIsArchiveByCompanyId($cid);

        $this->page_data['jobs'] = $jobs;
        $this->load->view("v2/pages/job/ajax_archived_list", $this->page_data);
    }

    public function ajax_restore_archived()
    {

        $is_success = 0;
        $msg = 'Cannot find job data';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        $job = $this->jobs_model->getByIdAndCompanyId($post['job_id'], $company_id);
        if ($job) {                        
            $this->jobs_model->restoreJob($job->id);

            //Activity Logs
            $activity_name = 'Jobs : Restore Job Number ' . $job->job_number; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }
}

/* End of file Job.php */

/* Location: ./application/controllers/job.php */
