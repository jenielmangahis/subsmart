<?php

defined('BASEPATH') or exit('No direct script access allowed');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
class Customer extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'My Customers';
        $this->page_data['page']->menu = 'customers';

        // load Models
        $this->load->model('Customer_model','company'); 
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Esign_model', 'Esign_model');
        $this->load->model('Activity_model', 'activity');
        $this->load->model('General_model', 'general');
        $this->load->model('Tickets_model', 'tickets_model');
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('RatePlan_model');
        $this->load->model('Serversidetable_model', 'serverside_table');

        $this->load->helper(array('hashids_helper'));

        // load library
        $this->load->library('session');
        // load helper
        $this->load->helper('functions');
        // concept
        $uid = $this->session->userdata('uid');
        if (empty($uid)) {
            $this->page_data['uid'] = md5(time());
            $this->session->set_userdata(['uid' => $this->page_data['uid']]);
        } else {
            $uid = $this->session->userdata('uid');
            $this->page_data['uid'] = $uid;
        }
    }

    public function addJSONResponseHeader()
    {
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
        header('Content-Type: application/json');
    }

    public function getModulesList()
    {
        $user_id = logged('id');
        $this->load->library('wizardlib');

        $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id', $user_id, 'ac_module_sort');
        $this->page_data['widgets'] = $this->customer_ad_model->getModulesList();
        $this->load->view('v2/pages/customer/adv_cust_modules/add_module_details', $this->page_data);
    }

    public function index()
    {
        $this->load->model('AcsProfile_model');

        if(!checkRoleCanAccessModule('customers', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $this->page_data['page']->title = 'Customers';
        $this->page_data['page']->parent = 'Customers';

        $this->hasAccessModule(9);

        $this->load->library('wizardlib');
        $input = $this->input->post();
        $this->page_data['affiliates'] = $this->customer_ad_model->get_all(false, '', '', 'affiliates', 'id');

        $customerGroups = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId(logged('company_id'));

        $statusCounts = array();
        foreach($customerGroups as $g){
            $statusCounts[$g->name] = 0;
        }

        $statusCounts['Active Subscription'] = 0;

        $customers = $this->AcsProfile_model->getAllByCompanyIdIsNotArchived($company_id);
        foreach ($customers as $c) {
            $status = trim($c->status);
            if (array_key_exists($status, $statusCounts)) {
                $statusCounts[$status]++;
            }

            $active_sub_status= ['Active w/RAR','Active w/RMR','Active w/RQR','Active w/RYR','Inactive w/RMM'];

            if (in_array($status, $active_sub_status)) {
                $statusCounts['Active Subscription']++;
            }
        }

        $this->page_data['statusCounts'] = $statusCounts;

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }

        add_footer_js([
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',
        ]);
        
        $getCustomerStatus = [
            'select' => '*',
            'table' => 'acs_cust_status',
            'where' => ['company_id' => $company_id],
        ];

        $getCustomerGroup = [
            'select' => '*',
            'table' => 'customer_groups',
            'where' => ['company_id' => $company_id],
        ];

        $getSalesArea = [
            'select' => '*',
            'table' => 'ac_salesarea',
            'where' => ['fk_comp_id' => $company_id],
        ];

        $getRatePlanData = [
            'select' => '*',
            'table' => 'ac_rateplan',
            'where' => ['company_id' => $company_id],
        ];

        $getCustomerStatusData = [
            'select' => '*',
            'table' => 'acs_cust_status',
            'where' => ['company_id' => $company_id],
        ];

        $getSalesRepData = [
            'select' => '*',
            'table' => 'users',
            'where' => ['company_id' => $company_id,],
        ];

        $getTechnicianData = [
            'select' => '*',
            'table' => 'users',
            'where' => ['company_id' => $company_id,],
        ];

        $this->page_data['rate_plan'] = $this->general->get_data_with_param($getRatePlanData);
        $this->page_data['customer_status'] = $this->general->get_data_with_param($getCustomerStatus);
        $this->page_data['customer_group'] = $this->general->get_data_with_param($getCustomerGroup);
        $this->page_data['sales_area'] = $this->general->get_data_with_param($getSalesArea);
        $this->page_data['customer_status'] = $this->general->get_data_with_param($getCustomerStatusData);
        $this->page_data['salesRep'] = $this->general->get_data_with_param($getSalesRepData);
        $this->page_data['technician'] = $this->general->get_data_with_param($getTechnicianData);
        $this->page_data['companyId'] = logged('company_id');
        $this->page_data['enabled_table_headers'] = $enabled_table_headers;
        $this->load->view('v2/pages/customer/list', $this->page_data);
    }

    public function CompanyList(){
        $company_id = logged('company_id');

        if(!checkRoleCanAccessModule('customers', 'read')){
			show403Error();
			return false;
		}

        $get_customer_groups = [
            'where' => [
                    'company_id' => $company_id,
            ],
            'table' => 'customer_groups',
            'select' => '*',
        ];
        $commercials = $this->company->getAllCommercialCustomersIsNotArchived('',$company_id, 'Commercial','');

        $customerGroups = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId($company_id);
        $statusCounts   = array();
        foreach($customerGroups as $g){
            $statusCounts[$g->name] = 0;
        }

        $statusCounts['Active Subscription'] = 0;
        
        foreach ($commercials as $commercial) {
            $status = trim($commercial->status);
            if (array_key_exists($status, $statusCounts)) {
                $statusCounts[$status]++;
            }
            $active_sub_status= ['Active w/RAR','Active w/RMR','Active w/RQR','Active w/RYR','Inactive w/RMM'];

            if (in_array($status, $active_sub_status)) {
                $statusCounts['Active Subscription']++;
            }
        }

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }

        $default_status_ids = defaultCompanyCustomerStatusIds();
        $this->page_data['statusCounts']= $statusCounts;
        $this->page_data['customer_status'] = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId(logged('company_id'), []);
        $this->page_data['customerGroups'] = $this->general->get_data_with_param($get_customer_groups);
        $this->page_data['enabled_table_headers'] = $enabled_table_headers;
        $this->page_data['page']->title = 'Commercial';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['salesAreaSelected']= $this->customer_ad_model->getAllSettingsSalesAreaByCompanyId(logged('company_id'));
        $this->load->view('v2/pages/customer/company', $this->page_data);
    }

    public function getCompanyList(){

        $request = $_REQUEST;
        $draw = isset($request['draw']) ? intval($request['draw']) : 0;
        $start = isset($request['start']) ? intval($request['start']) : 0;
        $length = isset($request['length']) ? intval($request['length']) : 10;
        $search = isset($request['search']['value']) ? $request['search']['value'] : '';
        $filter_status = isset($request['filter_status']) ? $request['filter_status'] : '';
     
      
        $persons = $this->company->getAllCustomerByCustomerType($search,logged('company_id'), 'Commercial',$filter_status == 'All Status' ? '' :$filter_status);
        $filteredPersons = array_slice($persons, $start, $length);

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }
    
        $totalRecords = count($persons);
        $filteredRecords = count($persons);

        $data = [];
        foreach ($filteredPersons as $customer) {
            $data_arr  = [];
            if( $customer->is_favorite == 1 ){
                $labelName   = "<i class='bx bxs-heart customer-favorite'></i> " . $customer->first_name.' '.$customer->last_name;
            }else{
                $labelName   = $customer->first_name.' '.$customer->last_name;
            }
            
            $checkbox = "<input class='form-check-input row-select table-select' name='customers[]' type='checkbox' value='".$customer->prof_id."' />";
            array_push($data_arr, $checkbox);
            
            if (!empty($enabled_table_headers)) {
                if (in_array('name', $enabled_table_headers)) {                    
                    $n = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]);
                    $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                    array_push($data_arr, $data_name);

                    $customer_email = 'Email Not Specified';
                    if( $customer->email != '' ){
                        $customer_email = $customer->email;
                    }
                    $name = "
                        <label class='nsm-link default d-block fw-bold' onclick='location.href=\"".base_url('customer/module/'.$customer->prof_id.'')."\"'>".$labelName."</label><small style='font-size: 12px;' class='text-muted content-subtitle d-block mt-1'>$customer->customer_no</small><small class='text-muted'>".$customer_email.'</small>';
                    if ($customer->adt_sales_project_id > 0) {
                        $name .= '<span class="badge badge-primary">ADT SALES PORTAL DATA</label>';
                    }
                    array_push($data_arr, $name);
                }
                if (in_array('email', $enabled_table_headers)) {
                    $email = 'Not Specified';
                    if( $customer->email != '' ){
                        $email = $customer->email;
                    }
                    array_push($data_arr, $email);
                }
                if (in_array('industry', $enabled_table_headers)) {
                    if ($customer->industry_type_id > 0 && $customer->industry_type != '') {
                        array_push($data_arr, $customer->industry_type);
                    } else {
                        array_push($data_arr, 'Not Specified');
                    }
                }
                if (in_array('city', $enabled_table_headers)) {
                    $city = trim($customer->city) != '' ? '' .$customer->city : '---';
                    array_push($data_arr, $city);
                }
                if (in_array('state', $enabled_table_headers)) {
                    $state = 'Not Specified';
                    if( $customer->state != '' ){
                        $state = $customer->state;
                    }
                    array_push($data_arr, $state);
                }

                if (in_array('source', $enabled_table_headers)) {
                    $lead = 'Door';
                    array_push($data_arr, $lead);
                }
                if (in_array('added', $enabled_table_headers)) {
                    array_push($data_arr, $customer->entered_by2);
                }
                if (in_array('sales_rep', $enabled_table_headers)) {
                    $sales_rep = get_sales_rep_name($customer->fk_sales_rep_office);
                    if( trim($sales_rep) == '' ){
                        $sales_rep = '---';
                    }
                    array_push($data_arr, $sales_rep);
                }
                if (in_array('tech', $enabled_table_headers)) {
                    $techician = !empty($customer->technician) ? get_employee_name($customer->technician) : 'Not Assigned';
                    array_push($data_arr, $techician);
                }
                if (in_array('plan_type', $enabled_table_headers)) {                    
                    $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($customer->mmr, logged('company_id'));
                    
                    $plan_type= 'Not Specified';
                    if( $ratePlan ){
                        $plan_type = $ratePlan->plan_name;
                    }
                    // if( $customer->system_type != '' ){
                    //     $plan_type= $customer->system_type;
                    // }
                    array_push($data_arr, $plan_type);
                }
                if (in_array('rate_plan', $enabled_table_headers)) {
                    array_push($data_arr, ($customer->mmr) ? "$$customer->mmr" : '$0.00');
                }
                if (in_array('subscription_amount', $enabled_table_headers)) {
                    //$subs_amt = $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',');
                    $subs_amt = $customer->mmr > 0 ? number_format(floatval($customer->mmr), 2, '.', ',') : '0.00';
                    array_push($data_arr, '$'.$subs_amt);
                }
                if (in_array('job_amount', $enabled_table_headers)) {
                    $this->db->select('SUM(job_items.qty * job_items.cost) AS total_amount');
                    $this->db->from('job_items');
                    $this->db->join('jobs', 'job_items.job_id = jobs.id', 'left');
                    $this->db->where('jobs.customer_id', $customer->prof_id);
                    $totalJobItems = $this->db->get()->row();
                    $job_amount = '0.00';
                    if ($totalJobItems->total_amount > 0) {
                        $job_amount = number_format(floatval($totalJobItems->total_amount), 2, '.', ',');
                    }
                    array_push($data_arr, '$'.$job_amount);
                }
                if (in_array('phone', $enabled_table_headers)) {
                    $phone_m = 'Not Specified';
                    if( $customer->phone_m != '' ){
                        $phone_m = formatPhoneNumber($customer->phone_m);
                    }
                    array_push($data_arr, $phone_m);
                }

                if (in_array('status', $enabled_table_headers)) {
                    $status = 'Status not specified';
                    if( trim($customer->status) != '' ){
                        $status = $customer->status;
                    }
                    $stat = '<span class="nsm-badge">'.$status.'</span>';
                    array_push($data_arr, $stat);
                }
            } else {
                $n = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]);
                $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                array_push($data_arr, $data_name);
                
                $name = "<label class='nsm-link default d-block fw-bold' onclick='location.href=\"".base_url('customer/preview_/'.$customer->prof_id.'')."\"'>".$labelName."</label>
                    <label class='nsm-link default content-subtitle fst-italic d-block'>".$customer->email.'</label>';
                if ($customer->adt_sales_project_id > 0) {
                    $name .= '<span class="badge badge-primary">ADT SALES PORTAL DATA</label>';
                }
                array_push($data_arr, $name);
                if (logged('company_id') == 1) {
                    if ($customer->industry_type_id > 0) {
                        array_push($data_arr, $customer->industry_type);
                    } else {
                        array_push($data_arr, 'Not Specified');
                    }
                }

                $city = trim($customer->city) != '' ? '' .$customer->city : '---';
                array_push($data_arr, $city);
                
                $state = trim($customer->state) != '' ? '' .$customer->state : '---';
                array_push($data_arr, $state);

                $lead = $customer->lead_source != '' ? $customer->lead_source : 'Door';
                array_push($data_arr, $lead);

                $added_by = trim($customer->entered_by2) != '' ? $customer->entered_by2 : '---';
                array_push($data_arr, $added_by);

                $sales_rep = trim(get_sales_rep_name($customer->fk_sales_rep_office));
                if ($sales_rep == '') {
                    $sales_rep = '---';
                }
                array_push($data_arr, $sales_rep);

                $techician = !empty($customer->technician) ? get_employee_name($customer->technician) : 'Not Assigned';
                array_push($data_arr, $techician);

                $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($customer->mmr, logged('company_id'));
                $plan_type= 'Not Specified';
                if( $ratePlan ){
                    $plan_type = $ratePlan->plan_name;
                }    
                //$plan_type = trim($customer->system_type) != '' ? $customer->system_type : '---';
                array_push($data_arr, $plan_type);

                $subs_amt = $customer->mmr > 0 ? number_format(floatval($customer->mmr), 2, '.', ',') : '0.00';       
                //$subs_amt = $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',');
                array_push($data_arr, '$'.$subs_amt);

                $this->db->select('SUM(job_items.qty * job_items.cost) AS total_amount');
                $this->db->from('job_items');
                $this->db->join('jobs', 'job_items.job_id = jobs.id', 'left');
                $this->db->where('jobs.customer_id', $customer->prof_id);
                $totalJobItems = $this->db->get()->row();
                $job_amount = 0;
                if ($totalJobItems->total_amount > 0) {
                    $job_amount = number_format(floatval($totalJobItems->total_amount), 2, '.', ',');
                }
                array_push($data_arr, '$'.$job_amount);
                $phone = trim($customer->phone_m) != '' ? $customer->phone_m : '---';
                array_push($data_arr, formatPhoneNumber($phone));

                $status = 'Status not specified';
                if( trim($customer->status) != '' ){
                    $status = $customer->status;
                }
                $stat = '<span class="nsm-badge">'.$status.'</span>';
                array_push($data_arr, $stat);
            }

            $edit_action     = '';
            $favorite_action = '';
            $call_action     = '';
            $schedule_action = '';
            $email_action    = '';
            $send_esign_action = '';
            if( checkRoleCanAccessModule('customers', 'write') ){
                $edit_action = "<li><a class='dropdown-item' href='".base_url('customer/add_advance/'.$customer->prof_id)."'>Edit</a></li>";
                $favorite_action = " <li><a class='dropdown-item favorite-customer' data-favorite='".$customer->is_favorite."' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Add to Favorites</a></li>";
                $call_action = "<li><a class='dropdown-item call-item' href='javascript:void(0);' data-id='".$customer->phone_m."'>Call</a></li>";
                $schedule_action = "<li><a class='dropdown-item' href='".base_url('job/new_job1?cus_id='.$customer->prof_id)."'>Schedule</a></li>";
                $email_action = "<li><a class='dropdown-item send-email' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' data-email='".$customer->email."' href='javascript:void(0);'>Email</a></li>";
                $send_esign_action = " <li><a class='dropdown-item send-esign' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Send eSign</a></li>";
            }
            
            $delete_action = '';
            if( checkRoleCanAccessModule('customers', 'delete') ){
                $delete_action = "<li><a class='dropdown-item delete-customer' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Delete</a></li>";
            }

            $actionColumn = "<div class='dropdown table-management'>
                <a href='javascript:void(0);' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item' href='".base_url('customer/module/'.$customer->prof_id)."'>Dashboard</a>
                    </li>
                    <li>
                        <a class='dropdown-item' href='".base_url('customer/preview_/'.$customer->prof_id)."'>View</a>
                    </li>
                    ".$edit_action."                                        
                    ".$schedule_action."
                    ".$favorite_action."
                    ".$delete_action."
                </ul>
            </div>";

            array_push($data_arr, $actionColumn);
            $data[] = $data_arr;
     
        }
    
        $response = array(
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
            'filter_status' => $filter_status
        );

        echo json_encode($response);
    }

    public function getPersonList()
    {
        $request = $_REQUEST;
        $draw = isset($request['draw']) ? intval($request['draw']) : 0;
        $start = isset($request['start']) ? intval($request['start']) : 0;
        $length = isset($request['length']) ? intval($request['length']) : 10;
        $search = isset($request['search']['value']) ? $request['search']['value'] : '';
        $filter_status = isset($request['filter_status']) ? $request['filter_status'] : '';

        $persons = $this->company->getAllCustomerByCustomerType($search,logged('company_id'), 'Residential',$filter_status == 'All Status' ? '' :$filter_status);
        $filteredPersons = array_slice($persons, $start, $length);
    
        $totalRecords = count($persons);
        $filteredRecords = count($persons);

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }    

        $data = [];
        foreach ($filteredPersons as $customer) {
            $data_arr  = [];
            if( $customer->is_favorite == 1 ){
                $labelName   = "<i class='bx bxs-heart customer-favorite'></i> " . $customer->first_name.' '.$customer->last_name;
            }else{
                $labelName   = $customer->first_name.' '.$customer->last_name;
            }
            
            $checkbox = "<input class='form-check-input row-select table-select' name='customers[]' type='checkbox' value='".$customer->prof_id."' />";
            array_push($data_arr, $checkbox);

            if (!empty($enabled_table_headers)) {
                if (in_array('name', $enabled_table_headers)) {                    
                    $n = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]);
                    $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                    array_push($data_arr, $data_name);

                    $customer_email = 'Email Not Specified';
                    if( $customer->email != '' ){
                        $customer_email = $customer->email;
                    }
                    $name = "
                        <label class='nsm-link default d-block fw-bold' onclick='location.href=\"".base_url('customer/module/'.$customer->prof_id.'')."\"'>".$labelName."</label><small style='font-size: 12px;' class='text-muted content-subtitle d-block mt-1'>$customer->customer_no</small><small class='text-muted'>".$customer_email.'</small>';
                    if ($customer->adt_sales_project_id > 0) {
                        $name .= '<span class="badge badge-primary">ADT SALES PORTAL DATA</label>';
                    }
                    array_push($data_arr, $name);
                }
                if (in_array('email', $enabled_table_headers)) {
                    $email = 'Not Specified';
                    if( $customer->email != '' ){
                        $email = $customer->email;
                    }
                    array_push($data_arr, $email);
                }
                if (in_array('industry', $enabled_table_headers)) {
                    if ($customer->industry_type_id > 0 && $customer->industry_type != '') {
                        array_push($data_arr, $customer->industry_type);
                    } else {
                        array_push($data_arr, 'Not Specified');
                    }
                }
                if (in_array('city', $enabled_table_headers)) {
                    $city = trim($customer->city) != '' ? '' .$customer->city : '---';
                    array_push($data_arr, $city);
                }
                if (in_array('state', $enabled_table_headers)) {
                    $state = 'Not Specified';
                    if( $customer->state != '' ){
                        $state = $customer->state;
                    }
                    array_push($data_arr, $state);
                }

                if (in_array('source', $enabled_table_headers)) {
                    $lead =  ($customer->lead_source != "") ? $customer->lead_source : 'Door';
                    // $lead = 'Door';
                    // $lead = 'Not Specified';
                    array_push($data_arr, $lead);
                }
                if (in_array('added', $enabled_table_headers)) {
                    array_push($data_arr, $customer->entered_by2);
                }
                if (in_array('sales_rep', $enabled_table_headers)) {
                    $sales_rep = get_sales_rep_name($customer->fk_sales_rep_office);
                    if( trim($sales_rep) == '' ){
                        $sales_rep = '---';
                    }
                    array_push($data_arr, $sales_rep);
                }
                if (in_array('tech', $enabled_table_headers)) {
                    $techician = !empty($customer->technician) ? get_employee_name($customer->technician) : 'Not Assigned';
                    array_push($data_arr, $techician);
                }
                if (in_array('plan_type', $enabled_table_headers)) {
                    $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($customer->mmr, logged('company_id'));
                    
                    $plan_type= 'Not Specified';
                    if( $ratePlan ){
                        $plan_type = $ratePlan->plan_name;
                    }
                    // if( $customer->system_type != '' ){
                    //     $plan_type= $customer->system_type;
                    // }
                    array_push($data_arr, $plan_type);
                }
                if (in_array('rate_plan', $enabled_table_headers)) {
                    array_push($data_arr, ($customer->mmr) ? "$$customer->mmr" : '$0.00');
                }
                if (in_array('subscription_amount', $enabled_table_headers)) {
                    //$subs_amt = $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',');
                    $subs_amt = $customer->mmr > 0 ? number_format(floatval($customer->mmr), 2, '.', ',') : '0.00';
                    array_push($data_arr, '$'.$subs_amt);
                }
                if (in_array('job_amount', $enabled_table_headers)) {
                    $this->db->select('SUM(job_items.qty * job_items.cost) AS total_amount');
                    $this->db->from('job_items');
                    $this->db->join('jobs', 'job_items.job_id = jobs.id', 'left');
                    $this->db->where('jobs.customer_id', $customer->prof_id);
                    $totalJobItems = $this->db->get()->row();
                    $job_amount = 0;
                    if ($totalJobItems->total_amount > 0) {
                        $job_amount = number_format(floatval($totalJobItems->total_amount), 2, '.', ',');
                    }
                    array_push($data_arr, '$'.$job_amount);
                }
                if (in_array('phone', $enabled_table_headers)) {
                    $phone_m = 'Not Specified';
                    if( $customer->phone_m != '' ){
                        $phone_m = formatPhoneNumber($customer->phone_m);
                    }
                    array_push($data_arr, $phone_m);
                }
                if (in_array('status', $enabled_table_headers)) {
                    $status = 'Status not specified';
                    if( trim($customer->status) != '' ){
                        $status = $customer->status;
                    }
                    $stat = '<span class="nsm-badge">'.$status.'</span>';
                    array_push($data_arr, $stat);
                }
            } else {
                $n = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]);
                $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                array_push($data_arr, $data_name);
                
                $name = "<label class='nsm-link default d-block fw-bold' onclick='location.href=\"".base_url('customer/preview_/'.$customer->prof_id.'')."\"'>".$labelName."</label>
                    <label class='nsm-link default content-subtitle fst-italic d-block'>".$customer->email.'</label>';
                if ($customer->adt_sales_project_id > 0) {
                    $name .= '<span class="badge badge-primary">ADT SALES PORTAL DATA</label>';
                }
                array_push($data_arr, $name);
                if (logged('company_id') == 1) {
                    if ($customer->industry_type_id > 0) {
                        array_push($data_arr, $customer->industry_type);
                    } else {
                        array_push($data_arr, 'Not Specified');
                    }
                }
                $city = $customer->city != '' ? $customer->city : '---';
                array_push($data_arr, $city);

                $state = $customer->state != '' ? $customer->state : '---';
                array_push($data_arr, $customer->state);

                $lead = $customer->lead_source != '' ? $customer->lead_source : '---';
                array_push($data_arr, $lead);

                $added_by = trim($customer->entered_by2) != '' ? $customer->entered_by2 : '---';
                array_push($data_arr, $added_by);

                $sales_rep = trim(get_sales_rep_name($customer->fk_sales_rep_office));
                if ($sales_rep == '') {
                    $sales_rep = '---';
                }
                array_push($data_arr, $sales_rep);

                $techician = !empty($customer->technician) ? get_employee_name($customer->technician) : 'Not Assigned';
                array_push($data_arr, $techician);

                $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($customer->mmr, logged('company_id'));
                $plan_type= 'Not Specified';
                if( $ratePlan ){
                    $plan_type = $ratePlan->plan_name;
                }                
                //$plan_type = trim($customer->system_type) != '' ? $customer->system_type : '---';
                array_push($data_arr, $plan_type);

                $subs_amt = $customer->mmr > 0 ? number_format(floatval($customer->mmr), 2, '.', ',') : '0.00';       
                //subs_amt = $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',');
                array_push($data_arr, '$'.$subs_amt);
                
                $this->db->select('SUM(job_items.qty * job_items.cost) AS total_amount');
                $this->db->from('job_items');
                $this->db->join('jobs', 'job_items.job_id = jobs.id', 'left');
                $this->db->where('jobs.customer_id', $customer->prof_id);
                $totalJobItems = $this->db->get()->row();
                $job_amount = '0.00';
                if ($totalJobItems->total_amount > 0) {
                    $job_amount = number_format(floatval($totalJobItems->total_amount), 2, '.', ',');
                }
                array_push($data_arr, '$'.$job_amount);

                $phone = trim($customer->phone_m) != '' ? $customer->phone_m : '---';
                array_push($data_arr, formatPhoneNumber($phone));

                $status = 'Status not specified';
                if( trim($customer->status) != '' ){
                    $status = $customer->status;
                }
                $stat = '<span class="nsm-badge">'.$status.'</span>';
                array_push($data_arr, $stat);
            }

            $edit_action     = '';
            $favorite_action = '';
            $call_action     = '';
            $schedule_action = '';
            $email_action    = '';
            $send_esign_action = '';
            if( checkRoleCanAccessModule('customers', 'write') ){
                $edit_action = "<li><a class='dropdown-item' href='".base_url('customer/add_advance/'.$customer->prof_id)."'>Edit</a></li>";
                $favorite_action = " <li><a class='dropdown-item favorite-customer' data-favorite='".$customer->is_favorite."' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Add to Favorites</a></li>";
                $call_action = "<li><a class='dropdown-item call-item' href='javascript:void(0);' data-id='".$customer->phone_m."'>Call</a></li>";
                $schedule_action = "<li><a class='dropdown-item' href='".base_url('job/new_job1?cus_id='.$customer->prof_id)."'>Schedule</a></li>";
                $email_action = "<li><a class='dropdown-item send-email' data-id='".$customer->prof_id."' data-email='".$customer->email."' href='javascript:void(0);'>Email</a></li>";
                $send_esign_action = " <li><a class='dropdown-item send-esign' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Send eSign</a></li>";
            }
            
            $delete_action = '';
            if( checkRoleCanAccessModule('customers', 'delete') ){
                $delete_action = "<li><a class='dropdown-item delete-customer' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Delete</a></li>";
            }

            $actionColumn = "<div class='dropdown table-management'>
                <a href='javascript:void(0);' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item' href='".base_url('customer/module/'.$customer->prof_id)."'>Dashboard</a>
                    </li>
                    <li>
                        <a class='dropdown-item' href='".base_url('customer/preview_/'.$customer->prof_id)."'>View</a>
                    </li>
                    ".$edit_action."                    
                    ".$schedule_action."
                    ".$favorite_action."
                    ".$delete_action."
                </ul>
            </div>";

            array_push($data_arr, $actionColumn);
            $data[] = $data_arr;
     
        }
    
        $response = array(
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data,
            'filter_status' => $filter_status
        );
    
        echo json_encode($response);
    }

    public function PersonList(){
        $company_id = logged('company_id');

        if(!checkRoleCanAccessModule('customers', 'read')){
			show403Error();
			return false;
		}

        $get_customer_groups = [
            'where' => [
                    'company_id' => $company_id,
            ],
            'table' => 'customer_groups',
            'select' => '*',
        ];
        $persons = $this->company->getAllCommercialCustomersIsNotArchived('',$company_id, 'Residential','');
        $customerGroups = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId($company_id);

        $statusCounts = array();
        foreach($customerGroups as $g){
            $statusCounts[$g->name] = 0;
        }

        $statusCounts['Active Subscription'] = 0;
        
        foreach ($persons as $person) {
            $status = trim($person->status);
            if (array_key_exists($status, $statusCounts)) {
                $statusCounts[$status]++;
            }
            $active_sub_status= ['Active w/RAR','Active w/RMR','Active w/RQR','Active w/RYR','Inactive w/RMM'];

            if (in_array($status, $active_sub_status)) {
                $statusCounts['Active Subscription']++;
            }
        }

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }

        $default_status_ids = defaultCompanyCustomerStatusIds();
        $this->page_data['statusCounts']= $statusCounts;
        $this->page_data['customer_status'] = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId(logged('company_id'), []);
        $this->page_data['customerGroups'] = $this->general->get_data_with_param($get_customer_groups);
        $this->page_data['page']->title = 'Residential';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['enabled_table_headers'] = $enabled_table_headers;
        $this->page_data['salesAreaSelected']= $this->customer_ad_model->getAllSettingsSalesAreaByCompanyId(logged('company_id'));
        $this->load->view('v2/pages/customer/person', $this->page_data);
    }
  
    public function delete_company_or_person($id)
    {
        // Check if the ID is provided
        if (!$id) {
            $this->session->set_flashdata('error', 'Invalid customer ID.');
            redirect('customer/index');
        }

        // Call the deleteCustomer method from your model
        $result = $this->company->deleteCustomer($id);

        if ($result) {
            // Deletion successful
            $this->session->set_flashdata('success', 'Customer deleted successfully.');
        } else {
            // Deletion failed
            $this->session->set_flashdata('error', 'Failed to delete customer.');
        }

    }

    public function ajax_customer_lists()
    {
        $post = $this->input->post();
        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];

        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }

        if( $post['type'] ){
            $customers = $this->customer_ad_model->getCustomerLists($search, 0, 0, 0, [], $post['type']);
        }else{
            $customers = $this->customer_ad_model->getCustomerLists($search, 0, 0);
        }

        foreach($customers as $c){
            $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($c->mmr, logged('company_id'));
                    
            $plan_type= 'Not Specified';
            if( $ratePlan ){
                $plan_type = $ratePlan->plan_name;
            }

            $c->plan_type = $plan_type;
        }

        $search = ['search' => ''];
        $this->page_data['profiles'] = $customers;
        $this->page_data['enabled_table_headers'] = $enabled_table_headers;
        $this->load->view('v2/pages/customer/ajax_customer_lists', $this->page_data);
    }

    /**
     * This function will fetch customer list from post request of datatable server side processing.
     *
     * @return json Customer list json format
     */
    public function getCustomerLists()
    {
        $request = $_REQUEST;
        $draw = isset($request['draw']) ? intval($request['draw']) : 0;
        $start = isset($request['start']) ? intval($request['start']) : 0;
        $length = isset($request['length']) ? intval($request['length']) : 10;
        $search = isset($request['search']['value']) ? $request['search']['value'] : '';
        $filter_status = isset($request['filter_status']) ? $request['filter_status'] : '';

        $param['search'] = $search;
        $customers = $this->customer_ad_model->getCustomerLists($param, $start, $length,null,$filter_status == 'All Status' ? '' :$filter_status);
        $allCustomers = $this->customer_ad_model->getCustomerLists($param, 0, 0,null,$filter_status == 'All Status' ? '' :$filter_status);
        $all_customer_ids = [];
        
        foreach ($allCustomers as $c) {
            if (!in_array($c->prof_id, $all_customer_ids)) {
                $all_customer_ids[] = $c->prof_id;
            }
        }

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }
        $data = [];
        $customer_ids = [];
        foreach ($customers as $customer) {
            // if( !in_array($customer->prof_id, $customer_ids) ){
            $customer_ids[] = $customer->prof_id;
            $techician = !empty($customer->technician) ? get_employee_name($customer->technician)->FName : $customer->technician.'Not Assigned';
            $companyId = logged('company_id');
            $salesRep = get_sales_rep_name($customer->fk_sales_rep_office);
            //$labelName = $customer->customer_type === 'Business' ? $customer->business_name : $customer->first_name.' '.$customer->last_name;

            $customerName = ($customer->business_name != "" && $customer->business_name != "Not Specified") ? $customer->business_name : "{$customer->first_name} {$customer->last_name}";

            if( $customer->is_favorite == 1 ){
                $labelName   = "<i class='bx bxs-heart customer-favorite'></i> {$customerName}";
            }else{
                $labelName   = $customerName;
            }
            
            $data_arr = [];
            
            $checkbox = "<input class='form-check-input row-select table-select' name='customers[]' type='checkbox' value='".$customer->prof_id."' />";
            array_push($data_arr, $checkbox);

            if (!empty($enabled_table_headers)) {
                if (in_array('name', $enabled_table_headers)) {
                    // if ($customer->customer_type === 'Business') {
                    //     $parts = explode(' ', strtoupper(trim($customer->business_name)));
                    //     $n = count($parts) > 1 ? $parts[0][0].end($parts)[0] : $parts[0][0];
                    //     $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                    //     array_push($data_arr, $data_name);
                    // } else {
                    //     $n = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]);
                    //     $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                    //     array_push($data_arr, $data_name);
                    // }

                    $n = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]);
                    $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                    array_push($data_arr, $data_name);
                    // $name = "<label class='nsm-link default d-block fw-bold' onclick='location.href=\"".base_url('customer/module/'.$customer->prof_id.'')."\"'>".$labelName."</label>
                    //     <label class='nsm-link default content-subtitle fst-italic d-block'>".$customer->email.'</label>';

                    $customer_email = 'Email Not Specified';
                    if( $customer->email != '' ){
                        $customer_email = $customer->email;
                    }
                    $name = "
                        <label class='nsm-link default d-block fw-bold' onclick='location.href=\"".base_url('customer/module/'.$customer->prof_id.'')."\"'>".$labelName."</label><small style='font-size: 12px;' class='text-muted content-subtitle d-block mt-1'>$customer->customer_no</small><small class='text-muted'>".$customer_email.'</small>';
                    if ($customer->adt_sales_project_id > 0) {
                        $name .= '<span class="badge badge-primary">ADT SALES PORTAL DATA</label>';
                    }
                    array_push($data_arr, $name);
                }
                if (in_array('email', $enabled_table_headers)) {
                    $email = 'Not Specified';
                    if( $customer->email != '' ){
                        $email = $customer->email;
                    }
                    array_push($data_arr, $email);
                }
                if (in_array('industry', $enabled_table_headers)) {
                    if ($customer->industry_type_id > 0) {
                        array_push($data_arr, $customer->industry_type);
                    } else {
                        array_push($data_arr, 'Not Specified');
                    }
                }
                if (in_array('city', $enabled_table_headers)) {
                    array_push($data_arr, $customer->city);
                }
                if (in_array('state', $enabled_table_headers)) {
                    $state = 'Not Specified';
                    if( $customer->state != '' ){
                        $state = $customer->state;
                    }
                    array_push($data_arr, $state);
                }

                if (in_array('source', $enabled_table_headers)) {
                    $lead =  ($customer->lead_source != "") ? $customer->lead_source : 'Door';
                    // $lead = 'Door';
                    array_push($data_arr, $lead);
                }
                if (in_array('added', $enabled_table_headers)) {
                    array_push($data_arr, $customer->entered_by2);
                }
                if (in_array('sales_rep', $enabled_table_headers)) {
                    $sales_rep = get_sales_rep_name($customer->fk_sales_rep_office);
                    if( trim($sales_rep) == '' ){
                        $sales_rep = '---';
                    }
                    array_push($data_arr, $sales_rep);
                }
                if (in_array('tech', $enabled_table_headers)) {
                    $techician = !empty($customer->technician) ? get_employee_name($customer->technician) : 'Not Assigned';
                    array_push($data_arr, $techician);
                }
                if (in_array('plan_type', $enabled_table_headers)) {
                    $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($customer->mmr, logged('company_id'));
                    
                    $plan_type= 'Not Specified';
                    if( $customer->comm_type != '' ){
                        $plan_type = $customer->comm_type;
                    }else{
                        if( $ratePlan ){
                            $plan_type = $ratePlan->plan_name;
                        }
                    }
                        
                    array_push($data_arr, $plan_type);
                }
                if (in_array('rate_plan', $enabled_table_headers)) {
                    array_push($data_arr, ($customer->mmr) ? "$$customer->mmr" : '$0.00');
                }
                if (in_array('subscription_amount', $enabled_table_headers)) {
                    //$subs_amt = $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',');
                    $subs_amt = $customer->mmr > 0 ? number_format(floatval($customer->mmr), 2, '.', ',') : '0.00';
                    array_push($data_arr, '$'.$subs_amt);
                }
                if (in_array('job_amount', $enabled_table_headers)) {
                    $this->db->select('SUM(job_items.qty * job_items.cost) AS total_amount');
                    $this->db->from('job_items');
                    $this->db->join('jobs', 'job_items.job_id = jobs.id', 'left');
                    $this->db->where('jobs.customer_id', $customer->prof_id);
                    $totalJobItems = $this->db->get()->row();
                    $job_amount = 0;
                    if ($totalJobItems->total_amount > 0) {
                        $job_amount = number_format(floatval($totalJobItems->total_amount), 2, '.', ',');
                    }
                    array_push($data_arr, '$'.$job_amount);
                }
                if (in_array('phone', $enabled_table_headers)) {
                    $phone_m = 'Not Specified';
                    if( $customer->phone_m != '' ){
                        $phone_m = formatPhoneNumber($customer->phone_m);
                    }
                    array_push($data_arr, $phone_m);
                }
                if (in_array('status', $enabled_table_headers)) {
                    $status = 'Status not specified';
                    if( trim($customer->status) != '' ){
                        $status = $customer->status;
                    }
                    $stat = '<span class="nsm-badge">'.$status.'</span>';
                    array_push($data_arr, $stat);
                }
            } else {
                // name
                if ($customer->customer_type === 'Business') {
                    $parts = explode(' ', strtoupper(trim($customer->business_name)));
                    $n = count($parts) > 1 ? $parts[0][0].end($parts)[0] : $parts[0][0];
                    $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                    array_push($data_arr, $data_name);
                } else {
                    $n = ucwords($customer->first_name[0]).ucwords($customer->last_name[0]);
                    $data_name = "<div class='nsm-profile'><span>".$n.'</span></div>';
                    array_push($data_arr, $data_name);
                }
                $name = "<label class='nsm-link default d-block fw-bold' onclick='location.href=\"".base_url('customer/preview_/'.$customer->prof_id.'')."\"'>".$labelName."</label>
                    <label class='nsm-link default content-subtitle fst-italic d-block'>".$customer->email.'</label>';
                if ($customer->adt_sales_project_id > 0) {
                    $name .= '<span class="badge badge-primary">ADT SALES PORTAL DATA</label>';
                }
                array_push($data_arr, $name);
                // email
                // array_push($data_arr, $customer->email);
                // industry
                if (logged('company_id') == 1) {
                    if ($customer->industry_type_id > 0) {
                        array_push($data_arr, $customer->industry_type);
                    } else {
                        array_push($data_arr, 'Not Specified');
                    }
                }

                // city
                array_push($data_arr, $customer->city);
                // state
                array_push($data_arr, $customer->state);
                // source
                $lead = $customer->lead_source != '' ? $customer->lead_source : 'Door';
                array_push($data_arr, $lead);
                // added
                $added_by = trim($customer->entered_by2) != '' ? $customer->entered_by2 : '---';
                array_push($data_arr, $added_by);
                // sales rep
                $sales_rep = trim(get_sales_rep_name($customer->fk_sales_rep_office));
                if ($sales_rep == '') {
                    $sales_rep = '---';
                }
                array_push($data_arr, $sales_rep);
                // tech
                $techician = !empty($customer->technician) ? get_employee_name($customer->technician) : 'Not Assigned';
                array_push($data_arr, $techician);
                // plan type
                $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($customer->mmr, logged('company_id'));
                $plan_type= 'Not Specified';
                if( $ratePlan ){
                    $plan_type = $ratePlan->plan_name;
                }
                //$plan_type = trim($customer->system_type) != '' ? $customer->system_type : '---';
                array_push($data_arr, $plan_type);
                // sub amount
                $subs_amt = $customer->mmr > 0 ? number_format(floatval($customer->mmr), 2, '.', ',') : '0.00';         
                //$subs_amt = $companyId == 58 ? number_format(floatval($customer->proposed_payment), 2, '.', ',') : number_format(floatval($customer->total_amount), 2, '.', ',');
                array_push($data_arr, '$'.$subs_amt);
                // job amount
                $this->db->select('SUM(job_items.qty * job_items.cost) AS total_amount');
                $this->db->from('job_items');
                $this->db->join('jobs', 'job_items.job_id = jobs.id', 'left');
                $this->db->where('jobs.customer_id', $customer->prof_id);
                $totalJobItems = $this->db->get()->row();
                $job_amount = 0;
                if ($totalJobItems->total_amount > 0) {
                    $job_amount = number_format(floatval($totalJobItems->total_amount), 2, '.', ',');
                }
                array_push($data_arr, '$'.$job_amount);
                // phone
                $phone = trim($customer->phone_m) != '' ? $customer->phone_m : '---';
                array_push($data_arr, formatPhoneNumber($phone));

                $status = 'Status not specified';
                if( trim($customer->status) != '' ){
                    $status = $customer->status;
                }
                // status
                $stat = '<span class="nsm-badge">'.$status.'</span>';
                array_push($data_arr, $stat);
            }

            $edit_action     = '';
            $favorite_action = '';
            $call_action     = '';
            $schedule_action = '';
            $email_action    = '';
            $send_esign_action = '';
            if( checkRoleCanAccessModule('customers', 'write') ){
                $edit_action = "<li><a class='dropdown-item' href='".base_url('customer/add_advance/'.$customer->prof_id)."'>Edit</a></li>";
                $favorite_action = " <li><a class='dropdown-item favorite-customer' data-favorite='".$customer->is_favorite."' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Add to Favorites</a></li>";
                $call_action = "<li><a class='dropdown-item call-item' href='javascript:void(0);' data-id='".$customer->phone_m."'>Call</a></li>";
                $schedule_action = "<li><a class='dropdown-item' href='".base_url('job/new_job1?cus_id='.$customer->prof_id)."'>Schedule</a></li>";
                $email_action = "<li><a class='dropdown-item send-email' data-id='".$customer->prof_id."' data-email='".$customer->email."' href='javascript:void(0);'>Email</a></li>";
                $send_esign_action = " <li><a class='dropdown-item send-esign' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Send eSign</a></li>";
            }
            
            $delete_action = '';
            if( checkRoleCanAccessModule('customers', 'delete') ){
                $delete_action = "<li><a class='dropdown-item delete-customer' data-name='".$customer->first_name.' '.$customer->last_name."' data-id='".$customer->prof_id."' href='javascript:void(0);'>Delete</a></li>";
            }

            $dropdown = "<div class='dropdown table-management'>
                    <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                    </a>
                    <ul class='dropdown-menu dropdown-menu-end'>
                        <li>
                            <a class='dropdown-item' href='".base_url('customer/module/'.$customer->prof_id)."'>Dashboard</a>
                        </li>
                        <li>
                            <a class='dropdown-item' href='".('customer/preview_/'.$customer->prof_id)."'>View</a>
                        </li>
                        ".$edit_action."         
                        ".$schedule_action."
                        ".$favorite_action."
                        ".$delete_action."
                    </ul>
                </div>";
            array_push($data_arr, $dropdown);

            // $is_adt_project = 'no';
            // if( $customer->adt_sales_project_id > 0 ){
            //     $is_adt_project = 'yes';
            // }
            // array_push($data_arr, $is_adt_project);

            $data[] = $data_arr;

            ++$start;
            // }
        }
        $output = [
            'draw' => $draw,
            // "recordsTotal" => count($allCustomers),
            // "recordsFiltered" => count($allCustomers),
            'recordsTotal' => count($all_customer_ids),
            'recordsFiltered' => count($all_customer_ids),
            'data' => $data,
        ];
        echo json_encode($output);
    }

    public function getDuplicatedEntry()
    {
        $company_id = logged('company_id');
        $result = $this->customer_ad_model->getTotalDuplicatedEntry($company_id);
        echo $result;
    }

    public function getCustomerList()
    {
        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $enabled_table_headers = [];
        if (isset($customer_settings[0])) {
            $enabled_table_headers = unserialize($customer_settings[0]->headers);
        }
        $customers = $this->customer_ad_model->getCustomerLists();

        $data_arr = ['customer' => $customers, 'headers' => $enabled_table_headers];
        exit(json_encode($data_arr));
    }

    public function customerServersideLoad() 
    {
        $company_id = logged('company_id');
        $postData = $this->input->post('statusFilter');
        // ===============
        $getSalesArea = ['where' => ['fk_comp_id' => logged('company_id')], 'table' => 'ac_salesarea', 'select' => 'sa_id, sa_name'];
        $getSalesAreaData = $this->general->get_data_with_param($getSalesArea);
        // ===============
        $getSalesRep = ['where' => ['company_id' => logged('company_id'),], 'table' => 'users', 'select' => 'id, FName, LName,'];
        $getSalesRepData = $this->general->get_data_with_param($getSalesRep);
        // ===============
        $getTechnician = ['where' => ['company_id' => logged('company_id'),], 'table' => 'users', 'select' => 'id, FName, LName,'];
        $getTechnicianData = $this->general->get_data_with_param($getTechnician);
        // ===============
        $getMonitoringCompany =  array('ADT', 'CMS', 'COPS', 'FrontPoint', 'ProtectionOne', 'Stanley', 'Guardian', 'Vector', 'Central', 'Brinks', 'Equipment Funding', 'Other',);
        // ===============
        $getAccountType = array('In-House', 'Purchase', 'Commercial', 'Rental', 'Residential',);
        // ===============
        $getPanelType = ['where' => ['company_id' => logged('company_id')], 'table' => 'panel_types', 'select' => 'id, name'];
        $getPanelTypeData = $this->general->get_data_with_param($getPanelType);
        // ===============
        $getSystemType = ['where' => ['company_id' => logged('company_id')], 'table' => 'ac_system_package_type', 'select' => 'id, name'];
        $getSystemTypeData = $this->general->get_data_with_param($getSystemType);
        // ===============
        $getConnectionTypeData = array('GSM', 'Digi', 'Wireless');
        // ===============
        $getWarrantyType = array('None', 'Limited. 90 Days', '1 Year', '$25 Trip', '$50 Trip and $65 Deductible', 'Extended',);
        // ===============
        $getRatePlan = ['where' => ['company_id' => logged('company_id')],'table' => 'ac_rateplan','select' => 'id, plan_name, amount,'];
        $getRatePlanData = $this->general->get_data_with_param($getRatePlan);
        // ===============
        $getCustomerStatus = ['where' => ['company_id' => logged('company_id')],'table' => 'acs_cust_status','select' => 'id, name,'];
        $getCustomerStatusData = $this->general->get_data_with_param($getCustomerStatus);
        // ===============
        $getBillingFrequencyData = array('One Time Only', 'Every 1 Month', 'Every 3 Months', 'Every 6 Months', 'Every 1 Year');
        // ===============
        $getBillingDayData = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
        // ===============
        $getContractTermData = array('0', '1', '6', '12', '18', '24', '36', '42', '48', '60', '72');
        // ===============
        $getBillingMethod = array('CC', 'DC', 'CHECK', 'CASH', 'ACH', 'VENMO', 'PP', 'SQ', 'WW', 'HOF', 'eT', 'Invoicing', 'OCCP', 'OPT',);
        // ===============

        $where = array('company_id' => $company_id);
        if (!empty($postData) && $postData === 'active_only') {
            $where['profile_status'] = [
                'Active w/RAR',
                'Active w/RMR',
                'Active w/RQR',
                'Active w/RYR',
                'Inactive w/RMM',
                'Inactive w/RAR',
            ];
        }

        // Initialize Table Information
        $initializeTable = $this->serverside_table->initializeTable(
            "customer_list_view", 
            array('profile_first_name',  'profile_last_name',  'profile_business_name',  'profile_customer_type',  'profile_fk_sa_id',  'profile_mail_add',  'profile_city',  'profile_state',  'profile_zip_code',  'profile_ssn',  'profile_date_of_birth',  'profile_email',  'profile_phone_m',  'profile_status', 'office_sales_rep', 'office_install_date', 'alarm_monitor_comp', 'alarm_monitor_id', 'alarm_acct_type', 'alarm_passcode', 'alarm_panel_type', 'alarm_system_type', 'alarm_warranty_type', 'alarm_comm_type', 'alarm_monthly_monitoring', 'alarm_account_cost', 'alarm_pass_thru_cost', 'billing_mmr',  'billing_bill_freq',  'billing_bill_day', 'billing_contract_term',  'billing_bill_start_date',  'billing_bill_end_date',  'billing_bill_method', 'billing_check_num', 'billing_routing_num', 'billing_acct_number', 'billing_credit_card_num', 'billing_credit_card_exp', 'profile_customer_group_id', 'office_technician',),
            array('profile_first_name',  'profile_last_name',  'profile_business_name',  'profile_customer_type',  'profile_fk_sa_id',  'profile_mail_add',  'profile_city',  'profile_state',  'profile_zip_code',  'profile_ssn',  'profile_date_of_birth',  'profile_email',  'profile_phone_m', 'profile_status', 'office_sales_rep', 'office_install_date', 'alarm_monitor_comp', 'alarm_monitor_id', 'alarm_acct_type', 'alarm_passcode', 'alarm_panel_type', 'alarm_system_type', 'alarm_warranty_type', 'alarm_comm_type', 'alarm_monthly_monitoring', 'alarm_account_cost', 'alarm_pass_thru_cost', 'billing_mmr',  'billing_bill_freq',  'billing_bill_day', 'billing_contract_term',  'billing_bill_start_date',  'billing_bill_end_date',  'billing_bill_method', 'billing_check_num', 'billing_routing_num', 'billing_acct_number', 'billing_credit_card_num', 'billing_credit_card_exp', 'profile_customer_group_id', 'office_technician',),
            null,  
            $where
        );

        // Define the where condition
        $whereCondition = array('company_id' => $company_id);
        $getData = $this->serverside_table->getRows($this->input->post(), $whereCondition);

        $data = $row = array();
        $i = $this->input->post('start');

        foreach($getData as $getDatas){
            if ($getDatas->company_id == $company_id) {
                // ===============
                $firstName = (!empty($getDatas->profile_first_name)) ? $getDatas->profile_first_name : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $lastName = (!empty($getDatas->profile_last_name)) ? $getDatas->profile_last_name : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $businessName = (!empty($getDatas->profile_business_name)) ? $getDatas->profile_business_name : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $customerType = (!empty($getDatas->profile_customer_type)) ? $getDatas->profile_customer_type : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $customerTypeDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='customer_type'>";
                $customerTypeDropdown .= "<option value=''>None</option>";
                if ($getDatas->profile_customer_type == "Residential") {
                    $customerTypeDropdown .= "<option selected value='Residential'>Residential</option>";
                    $customerTypeDropdown .= "<option value='Commercial'>Commercial</option>";
                } else {
                    $customerTypeDropdown .= "<option value='Residential'>Residential</option>";
                    $customerTypeDropdown .= "<option selected value='Commercial'>Commercial</option>";
                }
                $customerTypeDropdown .= "</select>";
                // ===============
                $salesArea = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $salesAreaDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='fk_sa_id'>";
                $salesAreaDropdown .= "<option value=''>None</option>";
                foreach ($getSalesAreaData as $getSalesAreaDatas) {
                    if ($getDatas->profile_fk_sa_id == $getSalesAreaDatas->sa_id) {
                        $salesArea = $getSalesAreaDatas->sa_name;
                        $salesAreaDropdown .= "<option selected value='$getSalesAreaDatas->sa_id'>$getSalesAreaDatas->sa_name</option>";
                    } else {
                        $salesAreaDropdown .= "<option value='$getSalesAreaDatas->sa_id'>$getSalesAreaDatas->sa_name</option>";
                    }
                }
                $salesAreaDropdown .= "</select>";
                // ===============
                $address = (!empty($getDatas->profile_mail_add)) ? $getDatas->profile_mail_add : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $city = (!empty($getDatas->profile_city)) ? $getDatas->profile_city : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $state = (!empty($getDatas->profile_state)) ? $getDatas->profile_state : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $zip_code = (!empty($getDatas->profile_zip_code)) ? $getDatas->profile_zip_code : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $ssn = (!empty($getDatas->profile_ssn)) ? $getDatas->profile_ssn : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $birthdate = (!empty($getDatas->profile_date_of_birth)) ? date('m/d/Y', strtotime($getDatas->profile_date_of_birth)) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $email = (!empty($getDatas->profile_email)) ? $getDatas->profile_email : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $phone_m = (!empty($getDatas->profile_phone_m)) ? $getDatas->profile_phone_m : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $customerStatus = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $customerStatusDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='status'>";
                $customerStatusDropdown .= "<option value=''>None</option>";
                foreach ($getCustomerStatusData as $getCustomerStatusDatas) {
                    if ($getDatas->profile_status == $getCustomerStatusDatas->name) {
                        $customerStatus = $getCustomerStatusDatas->name;
                        $customerStatusDropdown .= "<option selected value='$getCustomerStatusDatas->name'>$getCustomerStatusDatas->name</option>";
                    } else {
                        $customerStatusDropdown .= "<option value='$getCustomerStatusDatas->name'>$getCustomerStatusDatas->name</option>";
                    }
                }
                $customerStatusDropdown .= "</select>";
                // ===============
                $salesRep = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $salesRepDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='office' data-column='fk_sales_rep_office'>";
                $salesRepDropdown .= "<option selected value=''>None</option>";
                foreach ($getSalesRepData as $getSalesRepDatas) {
                    if ($getDatas->office_sales_rep == $getSalesRepDatas->id) {
                        $salesRep = "$getSalesRepDatas->FName $getSalesRepDatas->LName";
                        $salesRepDropdown .= "<option selected value='$getSalesRepDatas->id'>$getSalesRepDatas->FName $getSalesRepDatas->LName</option>";
                    } else {
                        $salesRepDropdown .= "<option value='$getSalesRepDatas->id'>$getSalesRepDatas->FName $getSalesRepDatas->LName</option>";
                    }
                }
                $salesRepDropdown .= "</select>";
                // ===============
                $technician = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $technicianDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='office' data-column='technician'>";
                $technicianDropdown .= "<option value=''>None</option>";
                foreach ($getTechnicianData as $getTechnicianDatas) {
                    if ($getDatas->office_technician == $getTechnicianDatas->id) {
                        $technician = "$getTechnicianDatas->FName $getTechnicianDatas->LName";
                        $technicianDropdown .= "<option selected value='$getTechnicianDatas->id'>$getTechnicianDatas->FName $getTechnicianDatas->LName</option>";
                    } else {
                        $technicianDropdown .= "<option value='$getTechnicianDatas->id'>$getTechnicianDatas->FName $getTechnicianDatas->LName</option>";
                    }
                }
                $technicianDropdown .= "</select>";
                // ===============
                $install_date = (!empty($getDatas->office_install_date)) ? date('m/d/Y', strtotime($getDatas->office_install_date)) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $monitoringCompany = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $monitoringCompanyDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='monitor_comp'>";
                $monitoringCompanyDropdown .= "<option value=''>None</option>";
                for ($i = 0; $i < count($getMonitoringCompany); $i++) {
                    if ($getDatas->alarm_monitor_comp == $getMonitoringCompany[$i]) {
                        $monitoringCompany = "$getMonitoringCompany[$i]";
                        $monitoringCompanyDropdown .= "<option selected value='$getMonitoringCompany[$i]'>$getMonitoringCompany[$i]</option>";
                    } else {
                        $monitoringCompanyDropdown .= "<option value='$getMonitoringCompany[$i]'>$getMonitoringCompany[$i]</option>";
                    }
                }
                $monitoringCompanyDropdown .= "</select>";
                // ===============
                $monitoringID = (!empty($getDatas->alarm_monitor_id)) ? $getDatas->alarm_monitor_id : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $accountType = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $accountTypeDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='acct_type'>";
                $accountTypeDropdown .= "<option value=''>None</option>";
                $accountTypeDropdown .= "<option value=''>Not Specified</option>";
                for ($i = 0; $i < count($getAccountType); $i++) {
                    if ($getDatas->alarm_acct_type == $getAccountType[$i]) {
                        $accountType = "$getAccountType[$i]";
                        $accountTypeDropdown .= "<option selected value='$getAccountType[$i]'>$getAccountType[$i]</option>";
                    } else {
                        $accountTypeDropdown .= "<option value='$getAccountType[$i]'>$getAccountType[$i]</option>";
                    }
                }
                $accountTypeDropdown .= "</select>";
                // ===============
                $abortCodePassword = (!empty($getDatas->alarm_passcode)) ? $getDatas->alarm_passcode : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $panelType = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $panelTypeDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='panel_type'>";
                $panelTypeDropdown .= "<option value=''>None</option>";
                foreach ($getPanelTypeData as $getPanelTypeDatas) {
                    if ($getDatas->alarm_panel_type == $getPanelTypeDatas->name) {
                        $panelType = "$getPanelTypeDatas->name";
                        $panelTypeDropdown .= "<option selected value='$getPanelTypeDatas->name'>$getPanelTypeDatas->name</option>";
                    } else {
                        $panelTypeDropdown .= "<option value='$getPanelTypeDatas->name'>$getPanelTypeDatas->name</option>";
                    }
                }
                $panelTypeDropdown .= "</select>";
                // ===============
                $systemType = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $systemTypeDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='system_type'>";
                $systemTypeDropdown .= "<option value=''>None</option>";
                foreach ($getSystemTypeData as $getSystemTypeDatas) {
                    if ($getDatas->alarm_system_type == $getSystemTypeDatas->name) {
                        $systemType = $getSystemTypeDatas->name;
                        $systemTypeDropdown .= "<option selected value='$getSystemTypeDatas->name'>$getSystemTypeDatas->name</option>";
                    } else {
                        $systemTypeDropdown .= "<option value='$getSystemTypeDatas->name'>$getSystemTypeDatas->name</option>";
                    }
                }
                $systemTypeDropdown .= "</select>";
                // ===============
                $warrantyType = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $warrantyTypeDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='warranty_type'>";
                $warrantyTypeDropdown .= "<option value=''>None</option>";
                for ($i = 0; $i < count($getWarrantyType); $i++) {
                    if ($getDatas->alarm_warranty_type == $getWarrantyType[$i]) {
                        $warrantyType = "$getWarrantyType[$i]";
                        $warrantyTypeDropdown .= "<option selected value='$getWarrantyType[$i]'>$getWarrantyType[$i]</option>";
                    } else {
                        $warrantyTypeDropdown .= "<option value='$getWarrantyType[$i]'>$getWarrantyType[$i]</option>";
                    }
                }
                $warrantyTypeDropdown .= "</select>";
                // ===============
                $connectionType = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $connectionTypeDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='connection_type'>";
                $connectionTypeDropdown .= "<option value=''>None</option>";
                for ($i = 0; $i < count($getConnectionTypeData); $i++) {
                    if ($getDatas->alarm_connection_type == $getConnectionTypeData[$i]) {
                        $connectionType = $getConnectionTypeData[$i];
                        $connectionTypeDropdown .= "<option selected value='$getConnectionTypeData[$i]'>$getConnectionTypeData[$i]</option>";
                    } else {
                        $connectionTypeDropdown .= "<option value='$getConnectionTypeData[$i]'>$getConnectionTypeData[$i]</option>";
                    }
                }
                $connectionTypeDropdown .= "</select>";
                // ===============
                $monthlyMonitoringRate = (!empty($getDatas->billing_mmr)) ? '$' . number_format($getDatas->billing_mmr, 2) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $grossMonitoringRate = (!empty($getDatas->alarm_monthly_monitoring)) ? '$' . number_format($getDatas->alarm_monthly_monitoring, 2) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $addonFeatureCost = (!empty($getDatas->alarm_feature_cost)) ? '$' . number_format($getDatas->alarm_feature_cost, 2) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $accountCost = (!empty($getDatas->alarm_account_cost)) ? '$' . number_format($getDatas->alarm_account_cost, 2) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $passThruCost = (!empty($getDatas->alarm_pass_thru_cost)) ? '$' . number_format($getDatas->alarm_pass_thru_cost, 2) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                // ===============
                $ratePlan = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $ratePlanDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='mmr'>";
                $ratePlanDropdown .= "<option value=''>None</option>";
                foreach ($getRatePlanData as $getRatePlanDatas) {
                    if ($getDatas->billing_mmr == $getRatePlanDatas->amount) {
                        $ratePlan =  "$getRatePlanDatas->plan_name - $$getRatePlanDatas->amount";
                        $ratePlanDropdown .= "<option selected value='$getRatePlanDatas->amount'>$getRatePlanDatas->plan_name - $$getRatePlanDatas->amount</option>";
                    } else {
                        $ratePlanDropdown .= "<option value='$getRatePlanDatas->amount'>$getRatePlanDatas->plan_name - $$getRatePlanDatas->amount</option>";
                    }
                }
                $ratePlanDropdown .= "</select>";
                // ===============
                $card_billingFrequency = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $card_billingFrequencyDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='bill_freq'>";
                $card_billingFrequencyDropdown .= "<option value=''>None</option>";
                for ($i = 0; $i < count($getBillingFrequencyData); $i++) {
                    if ($getDatas->billing_bill_freq == $getBillingFrequencyData[$i]) {
                        $card_billingFrequency = $getBillingFrequencyData[$i];
                        $card_billingFrequencyDropdown .= "<option selected value='$getBillingFrequencyData[$i]'>$getBillingFrequencyData[$i]</option>";
                    } else {
                        $card_billingFrequencyDropdown .= "<option value='$getBillingFrequencyData[$i]'>$getBillingFrequencyData[$i]</option>";
                    }
                }
                $card_billingFrequencyDropdown .= "</select>";
                // ===============
                $card_billingDay = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $card_billingDayDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='bill_day'>";
                $card_billingDayDropdown .= "<option value=''>None</option>";
                for ($i = 0; $i < count($getBillingDayData); $i++) {
                    if ($getDatas->billing_bill_day == $getBillingDayData[$i]) {
                        $card_billingDay = "$getBillingDayData[$i]";
                        $card_billingDayDropdown .= "<option selected value='$getBillingDayData[$i]'>$getBillingDayData[$i]</option>";
                    } else {
                        $card_billingDayDropdown .= "<option value='$getBillingDayData[$i]'>$getBillingDayData[$i]</option>";
                    }
                }
                $card_billingDayDropdown .= "</select>";
                // ===============
                $card_contractTerm = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $card_contractTermDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='contract_term'>";
                $card_contractTermDropdown .= "<option value=''>None</option>";
                for ($i = 0; $i < count($getContractTermData); $i++) {
                    if ($getDatas->billing_contract_term == $getContractTermData[$i]) {
                        $card_contractTerm = "$getContractTermData[$i] months";
                        $card_contractTermDropdown .= "<option selected value='$getContractTermData[$i]'>$getContractTermData[$i] months</option>";
                    } else {
                        $card_contractTermDropdown .= "<option value='$getContractTermData[$i]'>$getContractTermData[$i] months</option>";
                    }
                }
                $card_contractTermDropdown .= "</select>";
                // ===============
                $card_billingStartDate = (!empty($getDatas->billing_bill_start_date)) ? date('m/d/Y', strtotime($getDatas->billing_bill_start_date)) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $card_billingEndDate = (!empty($getDatas->billing_bill_end_date)) ? date('m/d/Y', strtotime($getDatas->billing_bill_end_date)) : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $billingMethod = "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $billingMethodDropdown = "<select class='form-select form-select-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='bill_method'>";
                $billingMethodDropdown .= "<option value=''>None</option>";
                for ($i = 0; $i < count($getBillingMethod); $i++) {
                    if ($getDatas->billing_bill_method == $getBillingMethod[$i]) {
                        if ($getDatas->billing_bill_method == "eT") {
                            $billingMethod = "e-Transfer";
                        } else {
                            $billingMethod = "$getBillingMethod[$i]";
                        }
                        $billingMethodDropdown .= "<option selected value='$getBillingMethod[$i]'>$getBillingMethod[$i]</option>";
                    } else {
                        if ($getBillingMethod[$i] == "eT") {
                            $billingMethodDropdown .= "<option value='$getBillingMethod[$i]'>e-Transfer</option>";
                        } else {
                            $billingMethodDropdown .= "<option value='$getBillingMethod[$i]'>$getBillingMethod[$i]</option>";
                        }
                    }
                }
                $billingMethodDropdown .= "</select>";
                // ===============
                $checkNumber = (!empty($getDatas->billing_check_num)) ? $getDatas->billing_check_num : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $routingNumber = (!empty($getDatas->billing_routing_num)) ? $getDatas->billing_routing_num : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $accountNumber = (!empty($getDatas->billing_acct_number)) ? $getDatas->billing_acct_number : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $creditCardNumber = (!empty($getDatas->billing_credit_card_num)) ? $getDatas->billing_credit_card_num : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $creditCardExpiration = (!empty($getDatas->billing_credit_card_exp)) ? $getDatas->billing_credit_card_exp : "<small class='text-muted'><i>Not Specified</i></small>";
                // ===============
                $mmr_profit = number_format((floatval($getDatas->alarm_monthly_monitoring) - floatval($getDatas->alarm_feature_cost) - floatval($getDatas->alarm_pass_thru_cost)), 2);

                if ($mmr_profit < 0) {
                    $mmr_profit = '-$' . number_format(abs($mmr_profit), 2);
                } else {
                    $mmr_profit = '$' . number_format($mmr_profit, 2);
                }

                $is_verified = ($getDatas->profile_is_verified == 1) ? "checked" : "";

                $data[] = array(
                    "<div class='text-nowrap'><input class='form-check-input verifyActiveCustomer' style='width: 16px; height: 16px;' customer_id='$getDatas->prof_id' type='checkbox' $is_verified></div>",
                    "<div class='drag_handle'></div><span class='textPreview namePreviewEdit'>$firstName</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='first_name' type='text' value='$getDatas->profile_first_name'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview namePreviewEdit'>$lastName</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='last_name' type='text' value='$getDatas->profile_last_name'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview namePreviewEdit'>$businessName</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='business_name' type='text' value='$getDatas->profile_business_name'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$customerType</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$customerTypeDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$salesArea</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$salesAreaDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$address</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='mail_add' type='text' value='$getDatas->profile_mail_add'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$city</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='city' type='text' value='$getDatas->profile_city'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$state</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='state' type='text' value='$getDatas->profile_state'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$zip_code</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='zip_code' type='text' value='$getDatas->profile_zip_code'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$ssn</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='ssn' type='text' value='$getDatas->profile_ssn'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$birthdate</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='date_of_birth' type='date' value='".date('Y-m-d', strtotime($getDatas->profile_date_of_birth))."'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$email</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='email' type='text' value='$getDatas->profile_email'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$phone_m</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='profile' data-column='phone_m' type='text' value='$getDatas->profile_phone_m'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$customerStatus</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$customerStatusDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$salesRep</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$salesRepDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$technician</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$technicianDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$install_date</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='office' data-column='install_date' type='date' value='".date('Y-m-d', strtotime($getDatas->office_install_date))."'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$monitoringCompany</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$monitoringCompanyDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$monitoringID</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='monitor_id' type='text' value='$getDatas->alarm_monitor_id'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$accountType</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$accountTypeDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$abortCodePassword</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='passcode' type='text' value='$getDatas->alarm_passcode'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$panelType</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$panelTypeDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$connectionType</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$connectionTypeDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$warrantyType</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$warrantyTypeDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                   "<div class='drag_handle'></div><span class='textPreview'>$systemType</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$systemTypeDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$monthlyMonitoringRate</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input oninput='validateDecimal(this)' class='form-control form-control-sm updateInputValue moneyInput' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='mmr' type='number' value='$getDatas->billing_mmr'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$grossMonitoringRate</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input oninput='validateDecimal(this)' class='form-control form-control-sm updateInputValue moneyInput' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='monthly_monitoring' type='number' value='$getDatas->alarm_monthly_monitoring'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$addonFeatureCost</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input oninput='validateDecimal(this)' class='form-control form-control-sm updateInputValue moneyInput' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='addon_feature_cost' type='number' value='$getDatas->alarm_feature_cost'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$accountCost</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input oninput='validateDecimal(this)' class='form-control form-control-sm updateInputValue moneyInput' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='account_cost' type='number' value='$getDatas->alarm_account_cost'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$passThruCost</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input oninput='validateDecimal(this)' class='form-control form-control-sm updateInputValue moneyInput' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='alarm' data-column='pass_thru_cost' type='number' value='$getDatas->alarm_pass_thru_cost'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$ratePlan</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$ratePlanDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$card_billingFrequency</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$card_billingFrequencyDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$card_billingDay</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$card_billingDayDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>", 
                    "<div class='drag_handle'></div><span class='textPreview'>$card_contractTerm</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$card_contractTermDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$card_billingStartDate</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='bill_start_date' type='date' value='".date('Y-m-d', strtotime($getDatas->billing_bill_start_date))."'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$card_billingEndDate</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='bill_end_date' type='date' value='".date('Y-m-d', strtotime($getDatas->billing_bill_end_date))."'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$billingMethod</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'>$billingMethodDropdown<span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$checkNumber</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='check_num' type='text' value='$getDatas->billing_check_num'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$routingNumber</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='routing_num' type='text' value='$getDatas->billing_routing_num'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$accountNumber</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='acct_num' type='text' value='$getDatas->billing_acct_number'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<div class='drag_handle'></div><span class='textPreview'>$creditCardNumber</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='credit_card_num' type='text' value='$getDatas->billing_credit_card_num'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    
                    "<div class='drag_handle'></div><span class='textPreview'>$creditCardExpiration</span> <div class='input-group input-group-sm inputMode' style='width: 250px; display: none;'> <input  class='form-control form-control-sm updateInputValue creditCardExpiryInput' data-customername='$firstName $lastName' data-id='$getDatas->prof_id' data-category='billing' data-column='credit_card_exp' type='text' value='$getDatas->billing_credit_card_exp' placeholder='MM/YY'> <span class='input-group-text actionButton saveChanges'><i class='fas fa-check text-success'></i></span> <span class='input-group-text actionButton cancelEdit'><i class='fas fa-times text-danger'></i></span> </div>",
                    "<span class='fw-bold'>$mmr_profit</span>",
                );
                $i++;
            }
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);

    }

    public function customerUpdateHistoryServersideLoad() 
    {
        $company_id = logged('company_id');

         $initializeTable = $this->serverside_table->initializeTable(
            "customer_update_history_view", 
            array('displaycustomername', 'displayColumnName', 'displayValueOnText', 'displayUpdatedBy', 'date_created'),
            array('displaycustomername', 'displayColumnName', 'displayValueOnText', 'displayUpdatedBy', 'date_created'),
            null,  
            array('company_id' => $company_id,),
        );

        $whereCondition = array('company_id' => $company_id);
        $getData = $this->serverside_table->getRows($this->input->post(), $whereCondition);

        $data = $row = array();
        $i = $this->input->post('start');
        
        $formattedDate = (new DateTime($getDatas->date_created))->format('m/d/Y h:i A');

        foreach($getData as $getDatas){
            if ($getDatas->company_id == $company_id) {
                
                $data[] = array(
                    $getDatas->displayCustomerName,
                    $getDatas->displayColumnName,
                    $getDatas->displayValueOnText,
                    $getDatas->displayUpdatedBy,
                    $formattedDate,
                    "<button class='btn btn-sm applyRevert' type='button' data-displaycustomername='$getDatas->displayCustomerName' data-displaycolumnname='$getDatas->displayColumnName' data-displayvalueontext='$getDatas->displayValueOnText' data-id='$getDatas->customer_id' data-category='$getDatas->data_category' data-column='$getDatas->column_name' data-value='$getDatas->value'><i class='fas fa-history'></i> Revert</button>",
                );
                $i++;
            }
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->serverside_table->countAll(),
            "recordsFiltered" => $this->serverside_table->countFiltered($this->input->post()),
            "data" => $data,
        );
        
        echo json_encode($output);
    }

    public function customerServersideLoadSave() 
    {
        $company_id = logged('company_id');
        $postData = $this->input->post();

        $updateData = array (
            $postData['column'] => trim($postData['value']),
        );

        if (isset($postData['bill_end_date']) && is_array($postData['bill_end_date']) && !empty($postData['bill_end_date'])) {
            $updateData['bill_end_date'] = array_map('trim', $postData['bill_end_date']);
        }
        
        switch ($postData['category']) {
            case 'profile':
                $updateProcess = $this->company->updateCustomerSpecificData('prof_id', $postData['id'], 'acs_profile', $updateData, 'specific_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['category']);
                break;
            case 'office':
                $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', $postData['id'], 'acs_office', $updateData, 'specific_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['category']);
                break;
            case 'alarm':
                $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', $postData['id'], 'acs_alarm', $updateData, 'specific_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['category']);
                break;
            case 'billing':
                $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', $postData['id'], 'acs_billing', $updateData, 'specific_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['category']);
                break;
            case 'all_rows':
                $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', $postData['id'], 'acs_alarm', $updateData, 'all_rows', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['category']);
                break;
            case 'ten_rows':
                $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', json_encode($postData['id']), 'acs_alarm', $updateData, 'ten_rows', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['category']);
                break;
            case 'cell_grid_update':
                if ($postData['dataCategory'] == "profile") {
                    $updateProcess = $this->company->updateCustomerSpecificData('prof_id', json_encode($postData['id']), 'acs_profile', $updateData, 'cell_grid_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['dataCategory']);
                } else if ($postData['dataCategory'] == "office") {
                    $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', json_encode($postData['id']), 'acs_office', $updateData, 'cell_grid_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['dataCategory']);
                } else if ($postData['dataCategory'] == "alarm") {
                    $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', json_encode($postData['id']), 'acs_alarm', $updateData, 'cell_grid_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['dataCategory']);
                } else if ($postData['dataCategory'] == "billing") {
                    $updateProcess = $this->company->updateCustomerSpecificData('fk_prof_id', json_encode($postData['id']), 'acs_billing', $updateData, 'cell_grid_update', $postData['displayColumnName'], $postData['displayValueOnText'], $postData['dataCategory']);
                }
                break;
        }

        echo json_encode($updateProcess);
    }

    public function preview_($id = null)
    {
        redirect('customer/preview/'.$id);

        $this->load->model('IndustryType_model');

        $this->page_data['page']->title = 'Customer Preview';
        $this->page_data['page']->parent = 'Customers';

        $this->load->model('jobs_model');
        $is_allowed = $this->isAllowedModuleAccess(9);
        if (!$is_allowed) {
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            exit;
        }
        $userid = $id;
        $user_id = logged('id');
        $companyId = logged('company_id');
        if (isset($userid) || !empty($userid)) {
            $customer = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['industryType'] = $this->IndustryType_model->getById($customer->industry_type_id);
            $this->page_data['profile_info'] = $customer;
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_access');
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_office');
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_billing');
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_alarm');
            if ($companyId == 58) {
                $this->page_data['solar_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_info_solar');
            }

            $get_customer_notes = [
                'where' => [
                    'fk_prof_id' => $userid,
                    'note !=' => ''
                ],
                'table' => 'acs_notes',
                'select' => '*',
            ];
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);

            $get_login_user = [
                'where' => [
                    'id' => $user_id,
                ],
                'table' => 'users',
                'select' => 'id,FName,LName',
            ];
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_customer_job_items($id);

            $customer_papers_query = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'acs_papers',
                'select' => '*',
            ];
            $this->page_data['papers'] = $this->general->get_data_with_param($customer_papers_query);
            if (count($this->page_data['papers'])) {
                $this->page_data['papers'] = $this->page_data['papers'][0];
            }

            $customer_contacts = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'contacts',
                'select' => '*',
                'order' => [
                    'order_by' => 'id',
                    'ordering' => 'asc',
                ],
            ];
            $emergency_contacts = $this->general->get_data_with_param($customer_contacts);
            $this->page_data['contacts'] = $this->general->get_data_with_param($customer_contacts);
        }
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'ac_salesarea', 'sa_id');
        $this->page_data['employees'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'users', 'id');
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['companyId'] = logged('company_id');

        $this->load->view('v2/pages/customer/preview', $this->page_data);
    }

    public function print_customer_details($id = null)
    {
        $this->load->model('jobs_model');
        $is_allowed = $this->isAllowedModuleAccess(9);
        if (!$is_allowed) {
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            exit;
        }
        $userid = $id;
        $user_id = logged('id');
        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_access');
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_office');
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_billing');
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_alarm');
            $get_customer_notes = [
                'where' => [
                    'fk_prof_id' => $userid,
                ],
                'table' => 'acs_notes',
                'select' => '*',
            ];
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);

            $get_login_user = [
                'where' => [
                    'id' => $user_id,
                ],
                'table' => 'users',
                'select' => 'id,FName,LName',
            ];
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_customer_job_items($id);

            $customer_papers_query = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'acs_papers',
                'select' => '*',
            ];
            $this->page_data['papers'] = $this->general->get_data_with_param($customer_papers_query);

            $customer_contacts = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'contacts',
                'select' => '*',
            ];
            $this->page_data['contacts'] = $this->general->get_data_with_param($customer_contacts);
        }
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'ac_salesarea', 'sa_id');
        $this->page_data['employees'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'users', 'id');
        $this->page_data['users'] = $this->users_model->getUsers();

        $this->load->view('customer/print/customer_details', $this->page_data);
    }

    public function preview($id = null)
    {
        $this->load->helper(array('sms_helper', 'paypal_helper'));
        $this->load->model('jobs_model');
        $this->load->model('AcsProperties_model');
        $this->load->model('Workorder_model');
        $this->load->model('Jobs_model');
        $this->load->model('UserCustomerDocfile_model');

        $is_allowed = $this->isAllowedModuleAccess(9);
        if (!$is_allowed) {
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            exit;
        }
        $userid   = $id;
        $user_id  = logged('id');
        $cid      = logged('company_id');
        $customer = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');

        if( $customer->is_archived == 1 || $customer->company_id != $cid){
            redirect('customer');
        }

        if (isset($userid) || !empty($userid)) {
            $customerProperty = $this->AcsProperties_model->getByCustomerId($id);

            $this->page_data['commission']   = $this->customer_ad_model->getTotalCommission($userid);
            $this->page_data['profile_info'] = $customer;
            $this->page_data['access_info']  = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_access');
            $this->page_data['office_info']  = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_office');
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_billing');
            $this->page_data['alarm_info']   = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_alarm');   
            $this->page_data['customerProperty'] = $customerProperty;
                     
            $get_customer_notes = [
                'where' => [
                    'fk_prof_id' => $userid,
                ],
                'table' => 'acs_notes',
                'select' => '*',
            ];
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);

            $get_login_user = [
                'where' => [
                    'id' => $user_id,
                ],
                'table' => 'users',
                'select' => 'id,FName,LName',
            ];
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_customer_job_items($id);

            $customer_papers_query = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'acs_papers',
                'select' => '*',
            ];
            $this->page_data['papers'] = $this->general->get_data_with_param($customer_papers_query);

            $customer_contacts = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'contacts',
                'select' => '*',
            ];
            $this->page_data['contacts'] = $this->general->get_data_with_param($customer_contacts);
        }

        $woSubmittedLatest = [];
        $jobFinishedLatest = [];
        $recentDocfile = [];
        $default_login_value = '';
        if( $customer ){
            $woSubmittedLatest = $this->Workorder_model->getRecentByCustomerIdAndStatus($customer->prof_id, 'Submitted');
            $jobFinishedLatest = $this->Jobs_model->getRecentByCustomerIdAndStatus($customer->prof_id, 'Finished');
            $jobLatest         = $this->Jobs_model->getRecentByCustomerIdAndStatus($customer->prof_id, '');
            $recentDocfile     = $this->UserCustomerDocfile_model->getRecentDocfileByCustomerId($customer->prof_id);
            

            $comb1 = strtoupper(substr(trim($customer->first_name),0,1));
            $comb2 = strtolower($customer->last_name);
            $address_number = extractCustomerAddressNumber($customer->mail_add);
            if( $address_number ){
                $comb3 = $address_number;
            }else{
                if( $customer->customer_no != '' ){
                    $comb3 = str_replace("-","",$customer->customer_no);
                    $comb3 = substr(trim($comb3),0,3);
                }else{
                    $comb3 = substr(trim($customer->prof_id),0,3);
                }
            }

            $default_login_value = $comb1 . $comb2 . $comb3;

        }
        
        // search Alarm.com customer
        $this->load->helper(array('alarm_api_helper'));    
        $alarmApi = new AlarmApi();
        if (
            strpos($customer->status, 'Active w/RAR') !== false ||
            strpos($customer->status, 'Active w/RMR') !== false ||
            strpos($customer->status, 'Active w/RQR') !== false ||
            strpos($customer->status, 'Active w/RYR') !== false ||
            strpos($customer->status, 'Inactive w/RMM') !== false ||
            strpos($customer->status, 'Inactive w/RMR') !== false
        ) {
            $alarmCustomerDetails = $alarmApi->alarmApiRequest("getCustomerById", $customer->prof_id, null, null, null);
        }
        $this->page_data['alarmcom_info'] = $alarmCustomerDetails;


        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'ac_salesarea', 'sa_id');
        $this->page_data['employees'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'users', 'id');
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['woSubmittedLatest'] = $woSubmittedLatest;
        $this->page_data['jobFinishedLatest'] = $jobFinishedLatest;
        $this->page_data['jobLatest'] = $jobLatest;
        $this->page_data['recentDocfile'] = $recentDocfile;
        $this->page_data['default_login_value'] = $default_login_value;
        $this->load->view('v2/pages/customer/preview', $this->page_data);
    }

    public function billing($id = null)
    {
        $this->hasAccessModule(9);

        $userid = $id;
        $user_id = logged('id');
        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_billing');

            // get customer transaction details
            $transaction_details_query = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'acs_transaction_history',
                'select' => '*',
            ];
            $this->page_data['transaction_details'] = $this->general->get_data_with_param($transaction_details_query);

            $get_login_user = [
                'where' => [
                    'id' => $user_id,
                ],
                'table' => 'users',
                'select' => 'id,FName,LName',
            ];
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
        }
        // print_r($this->page_data['transaction_details']);
        $this->page_data['transaction_details'];
        $this->load->view('customer/billing', $this->page_data);
    }

    public function deleteCustomer($id = null)
    {
        $customerId = $id;
        $dataToDelete = [
            'where' => [
                'prof_id' => $customerId,
            ],
            'table' => 'acs_profile',
        ];
        $deleteExceute = $this->general->delete_($dataToDelete);
        echo $deleteExceute ? 'deleted' : 'Theres an issue';
    }

    public function save_billing()
    {
        $input = $this->input->post();
        if ($input) {
            $is_valid = true;
            $err_msg = '';
            if ($input['method'] == 'CC') {
                $customer = $this->customer_ad_model->get_data_by_id('prof_id', $input['customer_id'], 'acs_profile');
                $converge_data = [
                    'amount' => $input['transaction_amount'],
                    'card_number' => $input['card_number'],
                    'exp_month' => $input['exp_month'],
                    'exp_year' => $input['exp_year'],
                    'card_cvc' => $input['cvc'],
                    'address' => $customer->mail_add,
                    'zip' => $customer->zip_code,
                ];
                $result = $this->converge_send_sale($converge_data);
                $is_valid = $result['is_success'];
                $err_msg = $result['msg'];
            }

            if ($input['method'] == 'NMI') {
                $customer = $this->customer_ad_model->get_data_by_id('prof_id', $input['customer_id'], 'acs_profile');
                $nmi_data = [
                    'customer_id' => $customer->prof_id,
                    'frequency' => $input['frequency'],
                    'bill_day' => $input['bill_day'],
                    'amount' => $input['transaction_amount'],
                    'card_number' => $input['card_number'],
                    'exp_month' => $input['exp_month'],
                    'exp_year' => $input['exp_year'],
                    'card_cvc' => $input['cvc'],
                    'address' => $customer->mail_add,
                    'zip' => $customer->zip_code,
                ];
                $result = $this->nmi_send_sale($nmi_data);
                $is_valid = $result['is_success'];
                $err_msg = $result['msg'];
            }

            if ($is_valid) {
                $transaction_details = [];
                $transaction_details['customer_id'] = $input['customer_id'];
                $transaction_details['subtotal'] = $input['subtotal'];
                $transaction_details['tax'] = $input['tax'];
                $transaction_details['category'] = $input['transaction_category'];
                $transaction_details['method'] = $input['method'];
                $transaction_details['transaction_type'] = 'Pre-Auth and Capture';
                $transaction_details['frequency'] = $input['frequency'];
                $transaction_details['notes'] = $input['notes'];
                $transaction_details['status'] = 'Approved';
                $transaction_details['datetime'] = date('m-d-Y h:i A');

                if ($this->general->add_($transaction_details, 'acs_transaction_history')) {
                    echo '0';
                } else {
                    echo 'Database Error!';
                }
            } else {
                echo $err_msg;
            }
        }
    }

    public function ajax_update_sub_payment_customer_info()
    {
        $this->load->model('AcsProfile_model');
        $input = $this->input->post();

        $prof_id  = $input['prof_id'];
        $customer = $this->AcsProfile_model->getByProfId($prof_id);        
        if($customer) {
            $customer_data = [
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'mail_add' => $input['mail_add'],
                'city' => $input['city'],
                'state' => $input['state'],
                'zip_code' => $input['zip_code'],
                'email' => $input['email'],
                'phone_h' => $input['phone']
            ];
            $this->AcsProfile_model->updateCustomerByProfId($prof_id, $customer_data);
            echo 'true';
        } else {
            echo 'Customer information not found.';
        }
    }

    public function save_subscription()
    {
        $is_success = 0;
        $msg = 'Cannot create payment.';
        
        $this->load->model('AcsProfile_model');
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_settings_model');
        $this->load->model('AcsCustomerSubscriptionBilling_model');

        $input = $this->input->post();
        if ($input) {
            $is_valid = true;
            if ($input['method'] == 'CC') {
                $customer = $this->customer_ad_model->get_data_by_id('prof_id', $input['customer_id'], 'acs_profile');
                $converge_data = [
                    'amount' => $input['transaction_amount'],
                    'card_number' => $input['card_number'],
                    'exp_month' => $input['exp_month'],
                    'exp_year' => $input['exp_year'],
                    'card_cvc' => $input['cvc'],
                    'address' => $customer->mail_add,
                    'zip' => $customer->zip_code,
                ];
                $result = $this->converge_send_sale($converge_data);
                $is_valid = $result['is_success'];
                $msg = $result['msg'];
            }

            if ($input['method'] == 'NMI') {
                $customer = $this->customer_ad_model->get_data_by_id('prof_id', $input['customer_id'], 'acs_profile');
                $nmi_data = [
                    'customer_id' => $customer->id,
                    'frequency' => $input['frequency'],
                    'bill_day' => $input['bill_day'],
                    'amount' => $input['transaction_amount'],
                    'card_number' => $input['card_number'],
                    'exp_month' => $input['exp_month'],
                    'exp_year' => $input['exp_year'],
                    'card_cvc' => $input['cvc'],
                    'address' => $customer->mail_add,
                    'zip' => $customer->zip_code,
                ];
                $result = $this->nmi_send_sale($nmi_data);
                $is_valid = $result['is_success'];
                $msg = $result['msg'];
            }

            /**
             * Todo: create invoice? 
             */        
            if($input['method'] == 'Invoicing') {

                $customer           = $this->AcsProfile_model->getByProfId($input['customer_id']);   
                $activeSubscription = $this->customer_ad_model->getActiveSubscriptionsByCustomerId($input['customer_id']);
                
                if($activeSubscription) {

                    $filter['recurring_date']  = $input['invoice_date'];
                    $filter['billing_id']      = $activeSubscription->bill_id;
                    $filter['customer_id']     = $customer->prof_id;
                    $filter['company_id']      = $customer->company_id;
                    $isCustomerSubscriptionBillingDuplicate = $this->AcsCustomerSubscriptionBilling_model->getCustomerSubscriptionBillingByFilter($filter);	
                    if(!$isCustomerSubscriptionBillingDuplicate) {

                        $invoiceSettings =  $this->Invoice_settings_model->getByCompanyId($customer->company_id);
                        if( $invoiceSettings ){            
                            $next_number = (int) $invoiceSettings->invoice_num_next;     
                            $prefix      = $invoiceSettings->invoice_num_prefix;  
                        }else{
                            $lastInsert = $this->Invoice_model->getLastInsertByCompanyId($customer->company_id);
                            $prefix     = 'INV-';
                            if( $lastInsert ){
                                $next_number   = $lastInsert->id + 1;
                            }else{
                                $next_number   = 1;
                            }
                        }
        
                        $invoice_number = formatInvoiceNumberV2($prefix, $next_number);
                        $total_amount   = $input['transaction_amount'];
                        $payment_fee    = 0;
                        $late_fee       = 0;
        
                        //Create invoice
                        $address = $customer->mail_add . ' ' . $customer->city . ', ' . $customer->state . ' ' . $customer->zip_code; 
                        $data_invoice = [
                            'job_id' => 0,
                            'ticket_id' => 0,
                            'customer_id' => $customer->prof_id,
                            'job_location' => $address,
                            'billing_address' => $address,
                            'location_scale' => $address,
                            'business_name' => '',
                            'job_name' => '',
                            'job_number' => '',
                            'estimate_id' => 0,
                            'invoice_type' => 'Total Due',
                            'work_order_number' => '',
                            'invoice_number' => $invoice_number, 
                            'date_issued' => isset($input['invoice_date']) ? $input['invoice_date'] : date("Y-m-d"),
                            'due_date' => isset($input['invoice_due_date']) ? $input['invoice_due_date'] : date("Y-m-d"),
                            'status' => 'Due',
                            'customer_email' => $customer->email,
                            'total_due' => $total_amount,
                            'balance' => $total_amount,
                            'date_created' => date("Y-m-d H:i:s"),
                            'date_updated' => date("Y-m-d H:i:s"),
                            'company_id' => $customer->company_id,
                            'is_recurring' => 1,
                            'invoice_totals' => $total_amount,
                            'user_id' => 0,
                            'adjustment_name' => 'Customer Subscription',
                            'adjustment_value' => $total_amount,
                            'sub_total' => $total_amount,
                            'taxes' => 0,
                            'grand_total' => $total_amount,
                            'view_flag' => 0,
                            'no_tax' => 0,
                            'late_fee' => $late_fee,
                            'payment_fee' => $payment_fee,
                            'terms' => isset($input['invoice_term']) ? $input['invoice_term'] : 0,
                        ];
        
                        $invoice_id = $this->Invoice_model->create($data_invoice);
        
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
                                'payment_fee_percent' => 0,
                                'payment_fee_amount' => 0,
                                'recurring' => '',
                                'invoice_template' => 1,
                                'residential_message' => 'Thank you for your business.',
                                'residential_terms_and_conditions' => 'Thank you for your business.',
                                'invoice_template' => 0,
                                'late_fee_amount_per_day' => 0,
                                'num_days_activate_late_fee' => 0,
                            ];
        
                            $this->Invoice_settings_model->create($invoice_settings_data);
                        }  
                        
                        $recurring_date = isset($input['invoice_date']) ? $input['invoice_date'] : date("Y-m-d");
                        $data_subscription_billing = [
                            'company_id'  	 => $customer->company_id,
                            'customer_id' 	 => $customer->prof_id,
                            'billing_id'  	 => $activeSubscription->bill_id,
                            'invoice_id'  	 => $invoice_id,
                            'recurring_date' => $recurring_date ? $recurring_date : date("Y-m-d"),
                            'subscription_amount' => $total_amount,
                            'late_fee_amount' => $late_fee,
                            'total_amount' => $total_amount,
                            'status'         => 'Unpaid',
                            'date_created'   => date("Y-m-d H:i:s")
                        ];
        
                        $this->AcsCustomerSubscriptionBilling_model->create($data_subscription_billing);	                    
                        
                        $is_valid = true;                    
                    } else {
                        $is_valid = false;
                        $msg      = "Invoice already exist";
                    }

                } else {
                    $is_valid = false;
                    $msg = "No active subscriptions.";
                }

            }

            if ($is_valid) {
                $subscription_details = [];
                $subscription_details['customer_id'] = $input['customer_id'];
                $subscription_details['category'] = $input['transaction_category'];
                $subscription_details['total_amount'] = $input['transaction_amount'];
                $subscription_details['method'] = $input['method'];
                $subscription_details['transaction_type'] = 'Pre-Auth and Capture';
                $subscription_details['frequency'] = $input['frequency'];
                // $subscription_details['num_frequency'] = $input['num_frequency'];
                $subscription_details['notes'] = $input['notes'];
                $subscription_details['status'] = 'Approved';

                if ($this->general->add_($subscription_details, 'acs_subscriptions')) {
                    $is_success = 1;
                    $msg = 'Subscription payment was created successfully.';
                } 
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function converge_send_sale($data)
    {
        include APPPATH.'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = '';

        $companyApiSetting = $this->CompanyOnlinePaymentAccount_model->getByCompanyId(logged('company_id'));

        if ($companyApiSetting) {
            if ($companyApiSetting->converge_merchant_id != '' && $companyApiSetting->converge_merchant_user_id != '' && $companyApiSetting->converge_merchant_pin != '') {
                if ($data['exp_month'] < 10) {
                    $data['exp_month'] = 0 .$data['exp_month'];
                }
                $year = date('d-m-'.$data['exp_year']);
                $exp_date = $data['exp_month'].date('y', strtotime($year));
                $converge = new \wwwroth\Converge\Converge([
                    'merchant_id' => $companyApiSetting->converge_merchant_id,
                    'user_id' => $companyApiSetting->converge_merchant_user_id,
                    'pin' => $companyApiSetting->converge_merchant_pin,
                    'demo' => false,
                ]);

                $createSale = $converge->request('ccsale', [
                    'ssl_card_number' => $data['card_number'],
                    'ssl_exp_date' => $exp_date,
                    'ssl_cvv2cvc2' => $data['card_cvc'],
                    'ssl_amount' => $data['amount'],
                    'ssl_avs_address' => $data['address'],
                    'ssl_avs_zip' => $data['zip'],
                ]);

                if ($createSale['success'] == 1) {
                    $is_success = true;
                    $msg = '';
                } else {
                    $is_success = false;
                    $msg = $createSale['errorMessage'];
                }
            } else {
                $msg = 'Please setup your converge api credentials in API Connectors';
            }
        } else {
            $msg = 'Please setup your converge api credentials in API Connectors';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];

        return $return;
    }

    public function nmi_send_sale($data)
    {
        $is_success = 0;
        $msg = '';
        $is_with_error = false;

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = '';

        $companyApiSetting = $this->CompanyOnlinePaymentAccount_model->getByCompanyId(logged('company_id'));

        if ($companyApiSetting) {
            if ($companyApiSetting->nmi_transaction_key != '' && $companyApiSetting->nmi_terminal_id != '') {
                // include APPPATH . 'libraries/nmi/examples/common.php';
                include_once APPPATH.'libraries/nmi/src/Client.php';

                if ($data['exp_month'] < 10) {
                    $data['exp_month'] = 0 .$data['exp_month'];
                }
                $year = date('d-m-'.$data['exp_year']);
                $exp_date = date('y', strtotime($year)).$data['exp_month'];

                // Setup the request.
                $request = new Request();
                $request->setSoftwareName(NMI_SOFTWARE_NAME);
                $request->setSoftwareVersion(NMI_SOFTWARE_VERSION);
                $request->setTerminalID($companyApiSetting->nmi_terminal_id);
                $request->setTransactionKey($companyApiSetting->nmi_transaction_key);

                $billing = $this->customer_ad_model->get_data_by_id('fk_prof_id', $data['customer_id'], 'acs_billing');
                if ($data['frequency'] != '') {
                    switch ($data['frequency']) {
                        case 'One Time Only':
                            $frequency = Frequency_Empty;
                            break;
                        case 'Every 1 Month':
                            $frequency = Frequency_Monthly;
                            break;
                        case 'Every 3 Months':
                            $frequency = Frequency_Quarterly;
                            break;
                        case 'Every 6 Months':
                            $frequency = Frequency_HalfYearly;
                            break;
                        case 'Every 1 Year':
                            $frequency = Frequency_Yearly;
                            break;
                        default:
                            $frequency = Frequency_Monthly;
                            break;
                    }

                    $start_date = strtotime($billing->bill_start_date);
                    $end_date = strtotime($billing->bill_end_date);
                    $datediff = $end_date - $start_date;
                    $total_payments = round($datediff / (60 * 60 * 24));

                    if ($total_payments <= 0) {
                        $is_with_error = true;
                    }
                    // Setup the request detail.
                    $final_amount = $data['amount'];
                    $request->setRequestType(RequestType_Recurring);
                    $request->setSubType(SubType_RecurringSetup);

                    $request->setRecurringInitialAmount($data['amount']);
                    $request->setRecurringRegularAmount($data['amount']);
                    $request->setRecurringRegularFrequency($frequency);
                    $request->setRecurringRegularMaximumPayments($total_payments);
                    $request->setRecurringFinalAmount($final_amount);
                    $request->setPAN($data['card_number']);
                    $request->setExpiryDate($exp_date);
                    $request->setUserReference(rand());
                } else {
                    // Setup the request detail.
                    $request->setRequestType(RequestType_Auth);
                    $request->setAmount($data['amount']);
                    $request->setPAN($data['card_number']);
                    $request->setExpiryDate($exp_date);
                }

                if (!$is_with_error) {
                    // Setup the client.
                    $client = new Client();
                    $client->addServerURL(NMI_TEST_SERVER_URL, 45000);
                    $client->setRequest($request);

                    // Process the request.
                    $client->processRequest();

                    // Get the response.
                    $response = $client->getResponse();
                    $errors = $response->getErrors();
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            $msg .= $error->getMessage().'<br />';
                        }
                    } else {
                        $is_success = true;
                        $msg = '';
                    }
                } else {
                    $is_success = false;
                    $msg = 'Invalid billing start and end date';
                }
            } else {
                $msg = 'Please setup your NMI api credentials in API Connectors';
            }
        } else {
            $msg = 'Please setup your NMI api credentials in API Connectors';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];

        return $return;
    }

    public function subscription($customer_id = null)
    {        
        $this->load->model('AccountingTerm_model');
        $this->load->model('FinancingPaymentCategory_model');
        $this->load->model('AcsCustomerSubscriptionBilling_model');
        $this->load->model('AcsBilling_model');

        $this->hasAccessModule(9);

        $company_id = logged('company_id');
        $user_id = logged('id');
        
        if (isset($customer_id) || !empty($customer_id)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $customer_id, 'acs_profile');
            $this->page_data['billing_info'] = $bill_info = $this->customer_ad_model->get_data_by_id('fk_prof_id', $customer_id, 'acs_billing');

            $get_login_user = [
                'where' => [
                    'id' => $user_id,
                ],
                'table' => 'users',
                'select' => 'id,FName,LName',
            ];
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);

            // get customer subscription history
            $subscriptions_query = [
                'where' => [
                    'customer_id' => $customer_id,
                ],
                'table' => 'acs_subscriptions',
                'select' => '*',
            ];
            $this->page_data['subscriptions'] = $this->general->get_data_with_param($subscriptions_query);
        }
        
        $accountingTerms = $this->AccountingTerm_model->getAllByCompanyId($company_id);

        $financingCategories = $this->FinancingPaymentCategory_model->getAllNonEquipmentByCompanyId($company_id);
        $this->page_data['financingCategories'] = $financingCategories; 
        
		$keyword = '';
        if(!empty(get('search'))) {
			$keyword = get('search');
            $this->page_data['search'] = $keyword;
            $payment_subscrition_history = $this->AcsCustomerSubscriptionBilling_model->getPaymentSubscriptionHistoryByCustomerId($customer_id,$keyword);
        } else {
            $payment_subscrition_history = $this->AcsCustomerSubscriptionBilling_model->getPaymentSubscriptionHistoryByCustomerId($customer_id,$keyword);
        }

        $this->page_data['payment_subscrition_history'] = $payment_subscrition_history;
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['page']->title = 'Subscription Payment';
        $this->page_data['accountingTerms'] = $accountingTerms;
        $this->load->view('v2/pages/customer/subscription', $this->page_data);
    }

    public function subscription_new($id = null)
    {
        $this->load->model('FinancingPaymentCategory_model');
        $this->load->model('AccountingTerm_model');

        $this->page_data['page']->parent = 'Customers';
        $this->page_data['page']->title = 'New Subscription Plan';
        $userid          = $id;
        $user_id         = logged('id');
        $company_id      = logged('company_id');
        $accountingTerms = $this->AccountingTerm_model->getAllByCompanyId($company_id);
        $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
        $get_login_user = [
            'where' => ['id' => $user_id],
            'table' => 'users',
            'select' => 'id,FName,LName',
        ];
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
        $financingCategories = $this->FinancingPaymentCategory_model->getAllNonEquipmentByCompanyId($company_id);
        $this->page_data['financingCategories'] = $financingCategories;   
        $this->page_data['accountingTerms']     = $accountingTerms;
        $this->load->view('v2/pages/customer/subscription_new', $this->page_data);
    }

    public function subscription_details($id = null)
    {
        $subscriptions_query = [
            'where' => [
                'id' => $id,
            ],
            'table' => 'acs_subscriptions',
            'select' => '*',
        ];
        $subscription = $this->general->get_data_with_param($subscriptions_query, false);
        $this->page_data['subscription_details'] = $subscription;

        $userid = $subscription->customer_id;

        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_billing');

            $alarm_details_query = [
                'where' => [
                    'fk_prof_id' => $userid,
                ],
                'table' => 'acs_alarm',
                'select' => 'monitor_id',
            ];
            $this->page_data['alarm_data'] = $this->general->get_data_with_param($alarm_details_query, false);

            $get_login_user = [
                'where' => [
                    'id' => logged('id'),
                ],
                'table' => 'users',
                'select' => 'id,FName,LName',
            ];
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
        }
        $this->load->view('customer/subscription_details', $this->page_data);
    }

    public function settingStatus()
    {
        
        $this->hasAccessModule(9);
        
        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $user_id = logged('id');
        $company_id = logged('company_id');

		$keyword         = '';
        $param['search'] = '';
        if(!empty(get('search'))) {
			$keyword = get('search');
            $param['search'] = $keyword;
            $this->page_data['customerStatus'] = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId($company_id, [], $param);
        } else {
            $this->page_data['customerStatus'] = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId($company_id);
        }          
        
        $this->page_data['search'] = $keyword;
        $this->page_data['customer_profile_id'] = $user_id;
        $this->page_data['page']->title = 'Customer Status';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['page']->title = 'Customer Status';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/customer/settings_customer_status', $this->page_data);
    }

    public function settings()
    {
        $this->page_data['page']->title = 'Customer Settings';
        $this->page_data['page']->parent = 'Sales';

        $this->load->library('wizardlib');
        $this->hasAccessModule(9);
        /*$is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }*/

        $user_id = logged('id');

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $user_id;

        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

        $this->page_data['active_tab'] = $this->uri->segment(3);
        //        $this->page_data['affiliates'] = $this->customer_ad_model->get_all(FALSE,"","","affiliates","id");
        //        $this->page_data['furnishers'] = $this->customer_ad_model->get_all(FALSE,"","","acs_furnisher","furn_id");
        //        $this->page_data['reasons'] = $this->customer_ad_model->get_all(FALSE,"","","acs_reasons","reason_id");
        $this->page_data['lead_source'] = $this->customer_ad_model->get_all(false, '', '', 'ac_leadsource', 'ls_id');
        $this->page_data['lead_types'] = $this->customer_ad_model->get_all(false, '', '', 'ac_leadtypes', 'lead_id');
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(false, '', '', 'ac_salesarea', 'sa_id');
        $this->page_data['rate_plans'] = $this->customer_ad_model->get_all(false, '', '', 'ac_rateplan', 'id');
        $this->page_data['customer_status'] = $this->customer_ad_model->get_all(false, '', '', 'acs_cust_status', 'id');

        // get activation fee
        $activation_fee_query = [
            'table' => 'ac_activationfee',
            'order' => [
                'order_by' => 'id',
            ],
            'select' => '*',
        ];
        $this->page_data['activation_fee'] = $this->general->get_data_with_param($activation_fee_query);

        // get system package type
        $spt_query = [
            'table' => 'ac_system_package_type',
            'order' => [
                'order_by' => 'id',
            ],
            'select' => '*',
        ];
        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);
        $this->page_data['customer_list_headers'] = customer_list_headers();
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data_settings($user_id);

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $headers = unserialize($customer_settings[0]->headers);
        $this->page_data['customer_tbl_headers'] = $headers;
        // $this->load->model('Activity_model','activity');
        // $this->page_data['activity_list'] = $this->activity->getActivity($user_id, [], 0);
        // $this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6,0], 1);

        $this->load->view('v2/pages/customer/settings', $this->page_data);
    }

    public function module($id = null)
    {   
        $this->load->helper(array('sms_helper', 'paypal_helper'));            
        $this->load->model('Clients_model');
        $this->load->model('taskhub_model');
        $this->load->model('CustomerStatementClaim_model');
        $this->load->model('Business_model');
        $this->load->model('CustomerGroup_model');
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('CustomerSignature_model');
        $this->load->model('Workorder_model');
        $this->load->model('Users_model');
        $this->load->model('AcsAlarmSiteType_model');
        $this->load->model('AcsAlarmInstallerCode_model');
        $this->load->model('Customer_model');
        $this->load->library('wizardlib');                        

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
			'assets/js/jquery.signaturepad.js'
        ]);
       
        $cid = logged('company_id');
        $customer = $this->customer_ad_model->get_data_by_id('prof_id', $id, 'acs_profile');
        if( $customer && $customer->company_id == $cid ){
            $is_allowed = $this->isAllowedModuleAccess(9);
            if (!$is_allowed) {
                $this->page_data['module'] = 'customer';
                echo $this->load->view('no_access_module', $this->page_data, true);
                exit;
            }

            $user_id = logged('id');
            $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id', $user_id, 'ac_module_sort');
            if (!$check_if_exist) {
                $input = [];
                $input['fk_user_id'] = $user_id;
                $input['ams_values'] = 'profile,score,tech,access,admin,office,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute';
                $this->customer_ad_model->add($input, 'ac_module_sort');
            }
            $userid = $id;
            if (!isset($userid) || empty($userid)) {
                $get_id = $this->customer_ad_model->get_all(1, '', 'DESC', 'acs_profile', 'prof_id');
                if (!empty($get_id)) {
                    $userid = $get_id[0]->prof_id;
                } else {
                    $userid = 0;
                }
            } else {
                $this->qrcodeGenerator($userid);
            }

            // set a global data for customer profile id
            $this->page_data['customer_profile_id'] = $userid;
            if ($id != null) {
                $office_info = $this->customer_ad_model->get_data_by_id('fk_prof_id', $id, 'acs_office');
                $assignedUser = [];
                if( $office_info ){
                    $assignedUser = $this->Users_model->getUserByID($office_info->technician);
                }

                $profile_info = $this->customer_ad_model->get_data_by_id('prof_id', $id, 'acs_profile');
                $customerGroup = $this->CustomerGroup_model->getById($profile_info->customer_group_id);
                $alarm_info    = $this->customer_ad_model->get_data_by_id('fk_prof_id', $id, 'acs_alarm');
                $this->page_data['assignedUser'] = $assignedUser;
                $this->page_data['commission'] = $this->customer_ad_model->getTotalCommission($id);
                $this->page_data['cust_invoices'] = $this->invoice_model->getAllByCustomerId($id);
                $this->page_data['profile_info'] = $profile_info;
                $this->page_data['customerGroup'] = $customerGroup;
                $this->page_data['log_info'] = $this->customer_ad_model->getCustomerActivityLogs($id);
                $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $id, 'acs_access');
                $this->page_data['office_info'] = $office_info;
                $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $id, 'acs_billing');
                $this->page_data['alarm_info'] = $alarm_info;
                $this->page_data['audit_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $id, 'acs_audit_import');
                // $this->page_data['minitab'] = $this->uri->segment(5);
                //$this->page_data['task_info'] = $this->taskhub_model->getAllNotCompletedTasksByCustomerId($id);
                $this->page_data['task_info'] = [];
                $this->page_data['item_details'] = $this->customer_ad_model->get_customer_item_details($id);
                // $this->page_data['task_info'] = $this->customer_ad_model->get_all_by_id("fk_prof_id",$id,"acs_tasks");
                $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id', $user_id, 'ac_module_sort');
                //$this->page_data['tasks'] = $this->customer_ad_model->get_data_by_id('prof_id', $user_id, 'tasks');
                $this->page_data['tasks'] = [];
                $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
                $this->page_data['cus_id'] = $id;

                if ($this->uri->segment(5) == 'mt3-cdl') {
                    $template_id = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : '';
                    $this->page_data['letter_id'] = $template_id;
                    $this->page_data['letter_template'] = $this->Esign_model->get_template_by_id($template_id);
                }
                
                $this->page_data['customer_id'] = $id;

                $this->db->where('is_active', 1);
                $this->db->where('customer_id', $id);
                $customerDocuments = $this->db->get('acs_customer_documents')->result_array();               
                            
                $customer_client_agreements = array_filter($customerDocuments, function($doc){
                    if( $doc['document_type'] == 'client_agreement' ){
                        return $doc;
                    }
                });

                $customer_site_photos = array_filter($customerDocuments, function($doc){
                    if( $doc['document_type'] == 'site_photos' ){
                        return $doc;
                    }
                });

                $customer_certificates = array_filter($customerDocuments, function($doc){
                    if( $doc['document_type'] == 'client_certificate' ){
                        return $doc;
                    }
                });

                $customer_photo_id_copy = array_filter($customerDocuments, function($doc){
                    if( $doc['document_type'] == 'photo_id_copy' ){
                        return $doc;
                    }
                });
                
                $customerSignature = $this->CustomerSignature_model->getByCustomerId($id);
                $total_customer_documents = count($customerDocuments);
                if( $customerSignature ){
                    $total_customer_documents += 1;
                }    

                $this->page_data['customer_client_agreements'] = $customer_client_agreements;
                $this->page_data['total_customer_documents'] = $total_customer_documents;
                $this->page_data['customer_site_photos'] = $customer_site_photos;
                $this->page_data['customer_certificates'] = $customer_certificates;
                $this->page_data['customer_photo_id_copy'] = $customer_photo_id_copy;
                $this->page_data['customer_documents'] = $customerDocuments;
                $this->page_data['customerSignature'] = $customerSignature;
                
                // search Alarm.com customer
                $this->load->helper(array('alarm_api_helper'));    
                $alarmApi = new AlarmApi();
                if (
                    strpos($profile_info->status, 'Active w/RAR') !== false ||
                    strpos($profile_info->status, 'Active w/RMR') !== false ||
                    strpos($profile_info->status, 'Active w/RQR') !== false ||
                    strpos($profile_info->status, 'Active w/RYR') !== false ||
                    strpos($profile_info->status, 'Inactive w/RMM') !== false ||
                    strpos($profile_info->status, 'Inactive w/RMR') !== false
                ) {
                    $alarmCustomerDetails = $alarmApi->alarmApiRequest("getCustomerById", $profile_info->prof_id, null, null, null);
                }
                $this->page_data['alarmcom_info'] = $alarmCustomerDetails;

                // $this->page_data['esign_documents'] = $this->getCustomerGeneratedEsigns$id);
            } else {
                redirect(base_url('customer/'));
            }
            // load job checlist model
            $this->load->model('JobChecklist_model');
            $jobChecklists = $this->JobChecklist_model->getAllByCompanyId(logged('company_id'));
            $this->page_data['job_check_lists'] = $jobChecklists;

            // Sms
            $cid = logged('company_id');
            $default_sms = '';
            $enable_twilio_call = false;
            $enable_ringcentral_call = false;

            $client = $this->Clients_model->getById($cid);
            if ($client->default_sms_api != '') {
                $default_sms = $client->default_sms_api;
                if ($client->default_sms_api == 'twilio') {
                    $enable_twilio_call = true;
                } elseif ($client->default_sms_api == 'ring_central') {
                    $enable_ringcentral_call = true;
                }
            }
            // Sms Template
            $this->load->model('SmsTemplate_model');
            $smsTemplates = $this->SmsTemplate_model->getAllByCompanyId($cid);

            // Calls
            $this->load->model('RingCentralAccounts_model');
            $this->load->model('TwilioAccounts_model');

            //Alarm
            $alarm_customer_info = [];
            // if( $customer->alarm_id > 0 ){
            //     $alarmApi  = new AlarmApi();
            //     $token     = $alarmApi->generateToken();    
            //     if( $token['token'] ){
            //         $customerAlarm = $alarmApi->getCustomerInformation($customer->alarm_id, [], $token['token']);
            //         if( $customerAlarm['customer'] ){                        
            //             $alarm_customer_info['dealer']     = $alarmApi->getDealerInformation($customerAlarm['customer']->dealerId, $token['token']);                    
            //             $alarm_customer_info['customer']   = $customerAlarm['customer'];
            //             $alarm_customer_info['equipments'] = $alarmApi->getCustomerEquipmentList($customer->alarm_id, $token['token']);
            //         }                    
            //     }                
            // }

            $ringCentralAccount = $this->RingCentralAccounts_model->getByCompanyId($cid);
            $twilioAccount  = $this->TwilioAccounts_model->getByCompanyId($cid);
            $statementClaim = $this->CustomerStatementClaim_model->getByCustomerId($id);
            $customerSignature = $this->CustomerSignature_model->getByCustomerId($id);

            $this->session->set_userdata('module_customer_id', $id);

            $companyInfo = $this->Business_model->getByCompanyId($cid);
            $woLatest = $this->Workorder_model->getRecentByCustomerIdAndStatus($customer->prof_id, 'Submitted');
            $wo_created_by = '---';
            if( $woLatest ){
                $createdBy = $this->Users_model->getUserByID($woLatest->created_by);
                if( $createdBy ){
                    $wo_created_by = $createdBy->FName . ' ' . $createdBy->LName;
                }
            }

            //Alarm Settings : Default Value
            $defaultAlarmSiteType = $this->AcsAlarmSiteType_model->getCompanyDefaultValue($cid);
            $defaultInstallerCode = $this->AcsAlarmInstallerCode_model->getCompanyDefaultValue($cid);

            $lastCustomer = $this->Customer_model->getLastCustomerByCompanyId($cid);
            $business     = $this->Business_model->getByCompanyId($cid);
            $customer_id  = $customer->prof_id;
            $default_dealer_number = $this->Customer_model->createDealerNumber($customer_id, $business->business_name);

            $this->page_data['companyInfo']   = $companyInfo;
            $this->page_data['twilioAccount'] = $twilioAccount;
            $this->page_data['ringCentralAccount'] = $ringCentralAccount;
            $this->page_data['enable_twilio_call'] = $enable_twilio_call;
            $this->page_data['enable_ringcentral_call'] = $enable_ringcentral_call;
            $this->page_data['page']->title = 'Customer Dashboard';
            $this->page_data['page']->parent = 'Customers';
            $this->page_data['smsTemplates'] = $smsTemplates;
            $this->page_data['default_sms'] = $default_sms;
            $this->page_data['cust_tab'] = $this->uri->segment(3);
            $this->page_data['cust_active_tab'] = 'dashboard';
            $this->page_data['users'] = $this->users_model->getUsers();
            $this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6, 0], 1);
            $this->page_data['ringCentralAccount'] = $ringCentralAccount;
            $this->page_data['twilioAccount'] = $twilioAccount;
            $this->page_data['alarm_customer_info'] = $alarm_customer_info;
            $this->page_data['statementClaim'] = $statementClaim;
            $this->page_data['customerSignature'] = $customerSignature;
            $this->page_data['woLatest'] = $woLatest;
            $this->page_data['wo_created_by'] = $wo_created_by;
            $this->page_data['defaultAlarmSiteType'] = $defaultAlarmSiteType;
            $this->page_data['defaultInstallerCode'] = $defaultInstallerCode;
            $this->page_data['default_dealer_number'] = $default_dealer_number;
            $this->load->view('v2/pages/customer/module', $this->page_data);
        }else{
            redirect('customer');
        }     
    }

    public function jobs_list($cid)
    {
        $this->load->model('Jobs_model');
        $this->load->model('AcsProfile_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        $jobs = $this->Jobs_model->getAllJobsByCustomerId($cid);
        $customer = $this->AcsProfile_model->getByProfId($cid);
        if( $customer && $customer->company_id == $company_id ){
            $this->page_data['cust_active_tab'] = 'jobs';
            $this->page_data['cus_id'] = $cid;
            $this->page_data['jobs'] = $jobs;
            $this->page_data['customer'] = $customer;

            $this->load->view('customer/jobs_list', $this->page_data);
        }else{
            redirect('customer');
        }
    }

    public function estimates_list_old($cid)
    {
        $this->load->model('Estimate_model');
        $this->load->model('AcsProfile_model');

        $estimates = $this->Estimate_model->getAllEstimatesByCustomerId($cid);
        $customer = $this->AcsProfile_model->getByProfId($cid);

        $this->page_data['cust_active_tab'] = 'estimates';
        $this->page_data['cus_id'] = $cid;
        $this->page_data['estimates'] = $estimates;
        $this->page_data['customer'] = $customer;

        $this->load->view('customer/estimate_list', $this->page_data);
    }

    public function activities($cid)
    {
        $this->page_data['page']->title = 'Customer Activity';
        $this->page_data['page']->parent = 'Customers';

        $this->load->model('CustomerAuditLog_model');
        $this->load->model('AcsProfile_model');

        $activities = $this->CustomerAuditLog_model->getAllByCustomerId($cid);
        $customer = $this->AcsProfile_model->getByProfId($cid);

        $this->page_data['cust_active_tab'] = 'activites';
        $this->page_data['cus_id'] = $cid;
        $this->page_data['activities'] = $activities;
        $this->page_data['customer'] = $customer;

        $this->load->view('customer/activities', $this->page_data);
    }

    public function invoice_list($cid)
    {
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $invoices = $this->Invoice_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $customer = $this->AcsProfile_model->getByProfId($cid);
        if( $customer && $customer->company_id == $company_id ){
            $this->page_data['page']->title = 'Customer Invoice List';
            $this->page_data['page']->parent = 'Customers';
            $this->page_data['cust_active_tab'] = 'invoices';
            $this->page_data['cus_id'] = $cid;
            $this->page_data['invoices'] = $invoices;
            $this->page_data['customer'] = $customer;

            $this->load->view('v2/pages/customer/dashboard/invoice_list', $this->page_data);
        }else{
            redirect('customer');
        }
    }

    public function job_list($cid)
    {
        $this->load->model('Jobs_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Users_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $jobs     = $this->Jobs_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $customer = $this->AcsProfile_model->getByProfId($cid);

        $employees = $this->Users_model->getCompanyUsers($company_id);
        $employees = array_map(function ($employee) {
            $employee->avatar = userProfileImage((int) $employee->id);
            return $employee;
        }, $employees);
        
        $this->page_data['page']->title = 'Customer Job List';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['cus_id'] = $cid;
        $this->page_data['employees'] = $employees;
        $this->page_data['jobs'] = $jobs;
        $this->page_data['customer'] = $customer;

        $this->load->view('v2/pages/customer/dashboard/job_list', $this->page_data);
    }

    public function payment_list($cid)
    {
        $this->load->model('Payment_records_model');
        $this->load->model('AcsProfile_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $customer   = $this->AcsProfile_model->getByProfId($cid);
        
        $this->page_data['page']->title = 'Customer Payment List';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['cus_id']    = $cid;
        $this->page_data['payments']  = $payments;
        $this->page_data['customer']  = $customer;

        $this->load->view('v2/pages/customer/dashboard/payment_list', $this->page_data);
    }

    public function ledger($cid)
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $invoices   = $this->Invoice_model->getAllByCustomerIdAndCompanyId($cid, $company_id);

        $ledger = [];
        foreach( $invoices as $invoice ){
            $date = date("m/d/Y", strtotime($invoice->date_issued));
            $ledger[$date][] = [
                'id' => $invoice->id,
                'type' => 'income',                
                'date' => $date,
                'description' => 'Issued invoice number ' . $invoice->invoice_number,
                'amount' => $invoice->grand_total
            ];

            $payments = $this->Payment_records_model->getAllByInvoiceId($invoice->id);            
            foreach( $payments as $p ){
                $date = date("m/d/Y", strtotime($p->payment_date));
                $ledger[$date][] = [
                    'id' => $p->id,
                    'type' => 'payment',          
                    'date' => $date,      
                    'description' => 'Payment for invoice number ' . $invoice->invoice_number,
                    'amount' => $p->invoice_amount
                ];
            }
        }
        
        $customer   = $this->AcsProfile_model->getByProfId($cid);
        
        $this->page_data['page']->title = 'Customer Ledger';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['cus_id']    = $cid;
        $this->page_data['ledger']    = $ledger;
        $this->page_data['customer']  = $customer;

        $this->load->view('v2/pages/customer/dashboard/ledger', $this->page_data);
    }

    public function service_ticket_list($cid)
    {
        $this->load->model('Tickets_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Users_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}
        
        $company_id  = logged('company_id');
        $filters[]   = ['field' => 'tickets.is_archived', 'value' => 0];
        $filters[]   = ['field' => 'tickets.customer_id', 'value' => $cid];
        $tickets     = $this->Tickets_model->getAllByCompanyId($company_id, $filters);
        $customer    = $this->AcsProfile_model->getByProfId($cid);
        
        if( $customer && $customer->company_id == $company_id ){
            foreach($tickets as $t){            
                $tech = unserialize($t->technicians);
                $assigned_tech = [];
                if( $tech ){
                    foreach($tech as $eid){
                        $user = $this->Users_model->getUserByID($eid);
                        if( $user ){
                            $assigned_tech[] = ['id' => $user->id, 'first_name' => $user->FName, 'last_name' => $user->LName, 'image' => $user->profile_img];
                        }
                    }
                }      
                $t->assigned_tech = $assigned_tech;
            }
            
            $this->page_data['page']->title = 'Customer Service Ticket List';
            $this->page_data['page']->parent = 'Customers';
            $this->page_data['cus_id'] = $cid;
            $this->page_data['tickets'] = $tickets;
            $this->page_data['customer'] = $customer;
            $this->load->view('v2/pages/customer/dashboard/service_ticket_list', $this->page_data);
        }else{
            redirect('customer');
        }
    }

    public function estimate_list($cid)
    {
        $this->load->model('Estimate_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Users_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}
        
        $company_id = logged('company_id');
        $estimates  = $this->Estimate_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $customer   = $this->AcsProfile_model->getByProfId($cid);
        if( $customer && $customer->company_id == $company_id ){
            $this->page_data['page']->title  = 'Customer Estimate List';
            $this->page_data['page']->parent = 'Customers';
            $this->page_data['cus_id']      = $cid;
            $this->page_data['estimates']   = $estimates;
            $this->page_data['customer']    = $customer;
            $this->load->view('v2/pages/customer/dashboard/estimate_list', $this->page_data);
        }else{
            redirect('customer');
        }
    }

    public function esign_list($cid)
    {        
        $this->load->model('UserDocfile_model');
        $this->load->model('AcsProfile_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $docfiles   = $this->UserDocfile_model->getByCustomerIdAndCompanyId($cid, $company_id);
        $customer   = $this->AcsProfile_model->getByProfId($cid);

        $this->page_data['page']->title  = 'Customer eSign List';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['cus_id']      = $cid;
        $this->page_data['docfiles']    = $docfiles;
        $this->page_data['customer']    = $customer;
        $this->load->view('v2/pages/customer/dashboard/esign_list', $this->page_data);
    }

    public function messages_list($cid)
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('QuickNote_model');
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');

        $messages = $this->CustomerMessages_model->getAllByProfId($cid);
        $customer = $this->AcsProfile_model->getByProfId($cid);
        $quickNotes = $this->QuickNote_model->getAllByCompanyId($company_id);

        $this->page_data['cust_active_tab'] = 'messages';
        $this->page_data['cus_id'] = $cid;
        $this->page_data['messages'] = $messages;
        $this->page_data['quickNotes'] = $quickNotes;
        $this->page_data['customer'] = $customer;

        $this->load->view('customer/messages_list', $this->page_data);
    }

    public function inventory_list($cid)
    {
        $this->page_data['page']->title = 'Customer Inventory List';
        $this->page_data['page']->parent = 'Customers';

        $this->load->model('Jobs_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Tickets_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $customer   = $this->AcsProfile_model->getByProfId($cid);
        if( $customer && $customer->company_id == $company_id ){
            $filter = 'all';
            if ($this->input->get('filter')) {
                $filter = $this->input->get('filter');
                if ($filter == 'jobs') {
                    $jobs = $this->Jobs_model->getAllJobsByCustomerId($cid);
                    $inventory = [];
                    foreach ($jobs as $j) {
                        $jobItems = $this->Jobs_model->get_specific_job_items($j->id);
                        $inventory[$j->id]['job'] = $j;
                        $inventory[$j->id]['type'] = 'job';
                        if ($jobItems) {
                            $inventory[$j->id]['items'] = $jobItems;
                        }
                    }
                } elseif ($filter == 'services') {
                    $tickets = $this->Tickets_model->get_tickets_by_customer_id($cid);
                    foreach ($tickets as $t) {
                        $ticketItems = $this->Tickets_model->get_ticket_items_by_ticket_id($t->id);
                        $inventory[$t->id]['ticket'] = $t;
                        $inventory[$t->id]['type'] = 'ticket';
                        if ($ticketItems) {
                            $inventory[$t->id]['items'] = $ticketItems;
                        }
                    }
                } else {
                    $inventory = [];
                }
            } else {
                $jobs = $this->Jobs_model->getAllJobsByCustomerId($cid);
                $inventory = [];
                foreach ($jobs as $j) {
                    $jobItems = $this->Jobs_model->get_specific_job_items($j->id);
                    $inventory[$j->id]['job'] = $j;
                    $inventory[$j->id]['type'] = 'job';
                    if ($jobItems) {
                        $inventory[$j->id]['items'] = $jobItems;
                    }
                }

                $tickets = $this->Tickets_model->get_tickets_by_customer_id($cid);
                foreach ($tickets as $t) {
                    $ticketItems = $this->Tickets_model->get_ticket_items_by_ticket_id($t->id);
                    $inventory[$t->id]['ticket'] = $t;
                    $inventory[$t->id]['type'] = 'ticket';
                    if ($ticketItems) {
                        $inventory[$t->id]['items'] = $ticketItems;
                    }
                }
            }

            $this->page_data['cust_active_tab'] = 'inventory';
            $this->page_data['cus_id'] = $cid;
            $this->page_data['filter'] = $filter;
            $this->page_data['inventory'] = $inventory;
            $this->page_data['customer'] = $customer;

            $this->load->view('v2/pages/customer/dashboard/inventory_list', $this->page_data);
        }else{
            redirect('customer');
        }
    }

    public function workorders_list($cid)
    {
        $this->load->model('Workorder_model');
        $this->load->model('AcsProfile_model');

        $workorders = $this->Workorder_model->getAllByCustomerId($cid);
        $customer = $this->AcsProfile_model->getByProfId($cid);

        $this->page_data['cust_active_tab'] = 'workorders';
        $this->page_data['cus_id'] = $cid;
        $this->page_data['workorders'] = $workorders;
        $this->page_data['customer'] = $customer;

        $this->load->view('customer/workorders_list', $this->page_data);
    }

    public function internal_notes($cid)
    {
        $this->page_data['page']->title = 'Customer Internal Notes';
        $this->page_data['page']->parent = 'Customers';

        $this->load->model('CustomerInternalNotes_model');
        $this->load->model('AcsProfile_model');

        $internalNotes = $this->CustomerInternalNotes_model->getAllByProfId($cid);
        $customer = $this->AcsProfile_model->getByProfId($cid);

        $this->page_data['cust_active_tab'] = 'internal_notes';
        $this->page_data['cus_id'] = $cid;
        $this->page_data['internalNotes'] = $internalNotes;
        $this->page_data['customer'] = $customer;

        $this->load->view('customer/internal_notes', $this->page_data);
    }

    public function credit_industry($cid)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('CustomerDispute_model');
        $this->load->model('CreditBureau_model');
        $this->load->model('CustomerDisputeItem_model');

        if(!checkRoleCanAccessModule('customer-dashboard', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $customer = $this->AcsProfile_model->getByProfId($cid);

        $companyDispute = $this->CustomerDispute_model->getAllByCustomerId($cid);
        $cbStatus = [];

        foreach ($companyDispute as $cd) {
            $disputeItems = $this->CustomerDisputeItem_model->getAllByCustomerDisputeId($cd->id);
            $cd->disputeItems = $disputeItems;
            foreach ($disputeItems as $di) {
                $cbStatus[$cd->id][$di->credit_bureau_id] = ['status' => $di->status, 'icon' => $this->CustomerDisputeItem_model->optionOtherInfoStatus($di->status)];
            }
        }

        $creditBureaus = $this->CreditBureau_model->getAll();

        $this->page_data['companyDispute'] = $companyDispute;
        $this->page_data['creditBureaus'] = $creditBureaus;
        $this->page_data['cbStatus'] = $cbStatus;
        $this->page_data['cust_active_tab'] = 'credit_industry';
        $this->page_data['cus_id'] = $cid;
        $this->page_data['customer'] = $customer;
        $this->page_data['page']->title = 'Credit Industry';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/dashboard/credit_industry', $this->page_data);
    }

    public function add_new_dispute_item($cid)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('CreditBureau_model');
        $this->load->model('Furnisher_model');
        $this->load->model('CompanyReason_model');
        $this->load->model('CustomerDispute_model');
        $this->load->model('CustomerDisputeItem_model');

        $company_id = logged('company_id');
        $customer = $this->AcsProfile_model->getByProfId($cid);
        $reasons = $this->CompanyReason_model->getAllDefaultAndByCompanyId($company_id);

        $creditBureaus = $this->CreditBureau_model->getAll();
        $furnishers = $this->Furnisher_model->getAllByCompanyId($company_id);

        $this->page_data['optionOtherInfoStatus'] = $this->CustomerDisputeItem_model->optionOtherInfoStatus();
        $this->page_data['customer'] = $customer;
        $this->page_data['cid'] = $cid;
        $this->page_data['creditBureaus'] = $creditBureaus;
        $this->page_data['furnishers'] = $furnishers;
        $this->page_data['reasons'] = $reasons;

        $this->page_data['page']->title = 'Credit Industry';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['cus_id'] = $cid;

        $this->load->view('v2/pages/customer/add_new_dispute_item', $this->page_data);
    }

    public function ajax_load_company_reason_list()
    {
        $this->load->model('CompanyReason_model');

        $company_id = logged('company_id');
        $reasons = $this->CompanyReason_model->getAllDefaultAndByCompanyId($company_id);

        $this->page_data['reasons'] = $reasons;
        $this->load->view('customer/ajax_load_company_reason_list', $this->page_data);
    }

    public function ajax_create_company_reason()
    {
        $this->load->model('CompanyReason_model');

        $is_success = false;
        $msg = 'Cannot save data';
        $rid = 0;
        $reason = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        if ($post['company_reason'] != '') {
            $data = [
                'company_id' => $company_id,
                'reason' => $post['company_reason'],
                'date_created' => date('Y-m-d H:i:s'),
                'date_modified' => date('Y-m-d H:i:s'),
            ];

            $rid = $this->CompanyReason_model->createReason($data);
            $reason = $post['company_reason'];

            //Activity Logs
            $activity_name = 'Company Reason : Created company reason ' . $post['company_reason']; 
            createActivityLog($activity_name);

            $is_success = true;
            $msg = '';

        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg, 'rid' => $rid, 'reason' => $reason];
        echo json_encode($json_data);
    }

    public function ajax_create_dispute_item()
    {
        $this->load->model('CustomerDispute_model');
        $this->load->model('CompanyReason_model');
        $this->load->model('CompanyDisputeInstruction_model');
        $this->load->model('CustomerDisputeItem_model');

        $is_success = false;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        if (!empty($post['creditedBureau'])) {
            if ($post['cus_id'] > 0) {
                $instruction = '';
                if ($post['new_instruction'] != '') {
                    $instruction = $post['new_instruction'];

                    // Save instruction
                    $data_new_instruction = [
                        'company_id' => $company_id,
                        'instructions' => $instruction,
                        'date_created' => date('Y-m-d H:i:s'),
                    ];

                    $this->CompanyDisputeInstruction_model->create($data_new_instruction);
                } else {
                    $companyInstruction = $this->CompanyDisputeInstruction_model->getById($post['list_instruction']);
                    if ($companyInstruction) {
                        $instruction = $companyInstruction->instructions;
                    }
                }

                $data_dispute = [
                    'company_id' => $company_id,
                    'prof_id' => $post['cus_id'],
                    'furnisher_id' => $post['furnisher_id'],
                    'date_dispute' => date('Y-m-d'),
                    'company_reason_id' => $post['dispute_reason'],
                    'instruction' => $instruction,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s'),
                ];

                $customer_dispute_id = $this->CustomerDispute_model->saveDispute($data_dispute);

                if ($customer_dispute_id > 0) {
                    foreach ($post['creditedBureau'] as $key => $bureauId) {
                        $account_number = '';
                        if ($post['account_number_opt'] == 'acc_num_same') {
                            $account_number = $post['account_number_all'];
                        } else {
                            if (isset($post['cb_account_number'][$bureauId])) {
                                $account_number = $post['cb_account_number'][$bureauId];
                            }
                        }

                        // Other fields
                        $status = '';
                        $other_fields = [];
                        if ($post['other_fields_type'] == 'same') {
                            foreach ($post['otherInfo']['group'] as $field => $value) {
                                if ($field == 'status') {
                                    $status = $value;
                                }
                                $other_fields[$field] = ['field' => $field, 'value' => $value];
                            }
                        } else {
                            foreach ($post['otherInfo']['individual'][$bureauId] as $field => $value) {
                                if ($field == 'status') {
                                    $status = $value;
                                }
                                $other_fields[$field] = ['field' => $field, 'value' => $value];
                            }
                        }

                        $other_fields = serialize($other_fields);

                        $data_dispute_item = [
                            'customer_dispute_id' => $customer_dispute_id,
                            'credit_bureau_id' => $bureauId,
                            'account_number`' => $account_number,
                            'status' => $status,
                            'other_fields' => $other_fields,
                            'date_created' => date('Y-m-d H:i:s'),
                            'date_modified' => date('Y-m-d H:i:s'),
                        ];

                        $companyDisputeItems = $this->CustomerDisputeItem_model->create($data_dispute_item);
                    }

                    $is_success = true;

                    //Activity Logs
                    $activity_name = 'Dispute Item : Created dispute item.'; 
                    createActivityLog($activity_name);

                } else {
                    $msg = 'Cannot save dispute data';
                }
            } else {
                $msg = 'Customer not found';
            }
        } else {
            $msg = 'Please select credit bureau';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_edit_dispute_item()
    {
        $this->load->model('CustomerDispute_model');
        $this->load->model('CustomerDisputeItem_model');
        $this->load->model('CreditBureau_model');

        $cid = logged('company_id');
        $post = $this->input->post();

        $dispute = $this->CustomerDispute_model->getById($post['did']);
        $disputeItems = $this->CustomerDisputeItem_model->getAllByCustomerDisputeId($post['did']);
        $creditBureaus = $this->CreditBureau_model->getAll();

        $aDisputeItems = [];
        foreach ($disputeItems as $di) {
            $aDisputeItems[$di->credit_bureau_id] = $di;
        }

        $this->page_data['dispute'] = $dispute;
        $this->page_data['aDisputeItems'] = $aDisputeItems;
        $this->page_data['creditBureaus'] = $creditBureaus;
        $this->page_data['optionOtherInfoStatus'] = $this->CustomerDisputeItem_model->optionOtherInfoStatus();
        $this->load->view('customer/ajax_edit_dispute_item', $this->page_data);
    }

    public function ajax_delete_customer_dispute()
    {
        $this->load->model('CustomerDispute_model');
        $this->load->model('CustomerDisputeItem_model');

        $is_success = 0;
        $msg = '';

        $cid = logged('company_id');
        $post = $this->input->post();

        $customerDispute = $this->CustomerDispute_model->getByIdAndCustomerId($post['did'], $post['cdid']);
        if ($customerDispute) {
            $this->CustomerDisputeItem_model->deleteByCustomerDisputeId($customerDispute->id);
            $this->CustomerDispute_model->deleteById($customerDispute->id);

            $is_success = 1;

            //Activity Logs
            $activity_name = 'Dispute Item : Deleted dispute item.'; 
            createActivityLog($activity_name);

        } else {
            $msg = 'Cannot find data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_create_internal_notes()
    {
        $this->load->model('CustomerInternalNotes_model');
        $this->load->model('AcsProfile_model');

        $is_success = false;
        $msg = '';

        $user_id = logged('id');
        $post = $this->input->post();

        if ($post['interal_notes'] != '' && $post['customer_id'] > 0) {
            $customer = $this->AcsProfile_model->getByProfId($post['customer_id']);
            if ($customer) {
                $data = [
                    'prof_id' => $customer->prof_id,
                    'user_id' => $user_id,
                    'note_date' => date('Y-m-d', strtotime($post['note_date'])),
                    'notes' => $post['interal_notes'],
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s'),
                ];

                $internal_note = $this->CustomerInternalNotes_model->create($data);

                $is_success = true;
            } else {
                $msg = 'Cannot find customer';
            }
        } else {
            $msg = 'Cannot save data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_update_internal_notes()
    {
        $this->load->model('CustomerInternalNotes_model');
        $this->load->model('AcsProfile_model');

        $is_success = false;
        $msg = '';

        $user_id = logged('id');
        $post = $this->input->post();
        $internalNote = $this->CustomerInternalNotes_model->getById($post['nid']);

        if ($internalNote) {
            $data = [
                'note_date' => date('Y-m-d', strtotime($post['note_date'])),
                'notes' => $post['interal_notes'],
            ];

            $this->CustomerInternalNotes_model->update($internalNote->id, $data);

            $is_success = 1;
        } else {
            $msg = 'Cannot find data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_internal_notes()
    {
        $this->load->model('CustomerInternalNotes_model');

        $is_success = 0;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();
        $internalNote = $this->CustomerInternalNotes_model->getById($post['nid']);
        if ($internalNote) {
            if ($internalNote->company_id == $company_id) {
                $this->CustomerInternalNotes_model->deleteById($internalNote->id);
                $is_success = 1;
                $msg = 'Record deleted';
            } else {
                $msg = 'Cannot find record';
            }
        } else {
            $msg = 'Cannot find record';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function ajax_edit_internal_note()
    {
        $this->load->model('CustomerInternalNotes_model');

        $post = $this->input->post();

        $internalNote = $this->CustomerInternalNotes_model->getById($post['nid']);

        $this->page_data['internalNote'] = $internalNote;
        $this->load->view('customer/ajax_edit_internal_note', $this->page_data);
    }

    public function add_advance($id = null)
    {
        $this->load->helper(array('sms_helper', 'paypal_helper'));
        $this->load->model('FinancingPaymentCategory_model');
        $this->load->model('IndustryType_model');
        $this->load->model('CompanyCustomerFormSetting_model');
        $this->load->model('AcsProperties_model');
        $this->load->model('AcsSolarInfoProposedInverter_model');
        $this->load->model('AcsSolarInfoProposedModule_model');
        $this->load->model('AcsSolarInfoSystemSize_model');
        $this->load->model('AcsSolarInfoLenderType_model');
        $this->load->model('Clients_model');
        $this->load->model('CustomerAddress_model');
        $this->load->model('Workorder_model');
        $this->load->model('Jobs_model');
        $this->load->model('UserCustomerDocfile_model');
        $this->load->model('Payment_records_model');
        $this->load->model('AcsAlarmInstallerCode_model');
        $this->load->model('AcsAlarmSiteType_model');
        $this->load->model('Business_model');
        $this->load->model('Customer_model');
        $this->load->model('PanelType_model');
        $this->load->model('AcsAccountType_model');
        $this->load->model('AcsAlarmMonitoringCompany_model');
        $this->load->model('AcsAlarmReceiverPhoneNumber_model');

        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customers', 'write')){
			show403Error();
			return false;
		}

        $userid = $id;
        $user_id = logged('id');
        $company_id = logged('company_id');

        if (isset($userid) || !empty($userid)) {
            $billing = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_billing');
            $customer = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            if( $customer->company_id != $company_id) {
                redirect('customer');
            }

            $bilinfo = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_billing');

            $this->page_data['commission'] = $this->customer_ad_model->getTotalCommission($userid);
            $this->page_data['profile_info'] = $customer;
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_access');
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_office');
            $this->page_data['billing_info'] = $bilinfo;
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id', $userid, 'acs_alarm');
            $this->page_data['panel_type'] = $this->customer_ad_model->get_select_options('acs_alarm', 'panel_type');

            $salesAreaSelected = [];
            if ($customer) {
                $salesAreaSelected = $this->customer_ad_model->getASalesAreaById($customer->fk_sa_id);
            }

            $get_customer_notes = [
                'where' => [
                    'fk_prof_id' => $userid,
                ],
                'table' => 'acs_notes',
                'select' => '*',
                'order' => [
                    'order_by' => 'id',
                    'ordering' => 'desc',
                ],
            ];
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);
            // $this->page_data['device_info'] = $this->customer_ad_model->get_all_by_id('fk_prof_id',$userid,"acs_devices");

            $customer_contacts = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'contacts',
                'select' => '*',
                'order' => [
                    'order_by' => 'id',
                    'ordering' => 'asc',
                ],
            ];
            $this->page_data['contacts'] = $this->general->get_data_with_param($customer_contacts);

            $customer_papers_query = [
                'where' => [
                    'customer_id' => $userid,
                ],
                'table' => 'acs_papers',
                'select' => '*',
            ];
            $this->page_data['papers'] = $this->general->get_data_with_param($customer_papers_query);
            if (count($this->page_data['papers'])) {
                $this->page_data['papers'] = $this->page_data['papers'][0];
            }

            if (logged('company_id') == 58 || logged('company_id') == 1) {
                $solar_info_query = [
                    'where' => [
                        'fk_prof_id' => $userid,
                    ],
                    'table' => 'acs_info_solar',
                    'select' => '*',
                ];

                $acs_info_solar = $this->general->get_data_with_param($solar_info_query, false);
                $this->page_data['acs_info_solar'] = $acs_info_solar;
            }
        }

        $get_customer_groups = [
            'where' => [
                    'company_id' => logged('company_id'),
            ],
            'table' => 'customer_groups',
            'select' => '*',
        ];

        $get_login_user = [
            'where' => [
                'id' => $user_id,
            ],
            'table' => 'users',
            'select' => 'id,FName,LName',
        ];

        $rate_plan_query = [
            // 'where' => array(
            //     'id' => $user_id
            // ),
            'table' => 'ac_rateplan',
            'select' => 'id,amount',
        ];

        $spt_query = [
            'table' => 'ac_system_package_type',
            'select' => 'id,name',
        ];

        $activation_fee_query = [
            'table' => 'ac_activationfee',
            'select' => 'id,amount',
        ];

        $spt_query = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'ac_system_package_type',
            'select' => '*',
        ];

        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);

        if (logged('company_id') == 58 || logged('company_id') == 1) {
            $solar_info_settings_query = [
                'table' => 'acs_solar_info_settings',
                'select' => '*',
            ];
            $this->page_data['solar_info_settings'] = $this->general->get_data_with_param($solar_info_settings_query);
        }

        $solarProposedInverters = $this->AcsSolarInfoProposedInverter_model->getAllByCompanyId(logged('company_id'));
        $solarProposedModules   = $this->AcsSolarInfoProposedModule_model->getAllByCompanyId(logged('company_id'));
        $solarSystemSizes       = $this->AcsSolarInfoSystemSize_model->getAllByCompanyId(logged('company_id'));
        $solarLenderTypes       = $this->AcsSolarInfoLenderType_model->getAllByCompanyId(logged('company_id'));

        $this->page_data['solarProposedInverters'] = $solarProposedInverters;
        $this->page_data['solarProposedModules']   = $solarProposedModules;
        $this->page_data['solarSystemSizes'] = $solarSystemSizes;
        $this->page_data['solarLenderTypes'] = $solarLenderTypes;


        //Customer setting : form fields
        $companyCustomerFormSettings = $this->CompanyCustomerFormSetting_model->getByCompanyId(logged('company_id'));
        $companyFormSetting = [];
        $formGroups = [];

        if( $companyCustomerFormSettings ){
            $fieldSettings = json_decode($companyCustomerFormSettings->field_settings);
            foreach( $fieldSettings as $setting ){
                $companyFormSetting[$setting->field_group][$setting->field_name] = ['value' => $setting->field_value, 'is_enabled' => $setting->is_enabled];
                
                if( !$formGroups[$setting->field_group]['total_enabled'] ){
                    $formGroups[$setting->field_group]['total_enabled'] = 0;
                }

                if( !$formGroups[$setting->field_group]['total_disabled'] ){
                    $formGroups[$setting->field_group]['total_disabled'] = 0;
                }

                if( $setting->is_enabled == 1 ){
                    if( $formGroups[$setting->field_group]['total_enabled'] ){
                        $formGroups[$setting->field_group]['total_enabled'] += 1;   
                    }else{
                        $formGroups[$setting->field_group]['total_enabled'] = 1;
                    }
                }else{
                    if( $formGroups[$setting->field_group]['total_disabled'] ){
                        $formGroups[$setting->field_group]['total_disabled'] += 1;   
                    }else{
                        $formGroups[$setting->field_group]['total_disabled'] = 1;
                    }
                }         
            }
        }  

        $installerCodes =  $this->AcsAlarmInstallerCode_model->getAllByCompanyId(logged('company_id'));

        $this->page_data['customerGroups'] = $this->general->get_data_with_param($get_customer_groups);
        $this->page_data['rate_plans'] = $this->general->get_data_with_param($rate_plan_query);
        $this->page_data['system_package_types'] = $this->general->get_data_with_param($spt_query);
        $this->page_data['activation_fees'] = $this->general->get_data_with_param($activation_fee_query);

        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user, false);
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'ac_salesarea', 'sa_id');
        $this->page_data['employees'] = $this->customer_ad_model->get_all(false, '', 'ASC', 'users', 'id');
        $this->page_data['users'] = $this->users_model->getUsers();
        // $this->page_data['technicians'] = $this->users_model->getUsersByRole([7]);
        $this->page_data['technicians'] = $this->users_model->getUsersByRole();
        $this->page_data['sales_reps'] = $this->users_model->getUsersByRole([8, 28]);
        $this->page_data['salesAreaSelected'] = $salesAreaSelected;
        // fetch customer statuses
        // $this->page_data['customer_status'] = $this->customer_ad_model->get_all(FALSE,"","","acs_cust_status","id");
        $default_status_ids = defaultCompanyCustomerStatusIds();
        $this->page_data['customer_status'] = $this->customer_ad_model->getAllSettingsCustomerStatusByCompanyId(logged('company_id'), []);

        if (isset($this->page_data['profile_info']->fk_sa_id)) {
            foreach ($this->page_data['sales_area'] as $area) {
                if ($area->sa_id == $this->page_data['profile_info']->fk_sa_id) {
                    $this->page_data['profile_info']->fk_sa_text = $area->sa_name;
                }
            }
        }

        $financingCategories = $this->FinancingPaymentCategory_model->getAllEquipmentByCompanyId($company_id);

        add_footer_js([
            'assets/js/customer/add_advance/add_advance.js',
            'assets/js/customer/lib/bday-picker.js',
        ]);

        add_css([
            'assets/css/customer/add_advance/add_advance.css',
        ]);

        $customerProperty = $this->AcsProperties_model->getByCustomerId($id);
        $client           = $this->Clients_model->getById($company_id);
        $company_industry = $client->industry_template_name;
        
        $customerAddress  = $this->CustomerAddress_model->getAllByCustomerId($id);

        $woSubmittedLatest = [];
        $jobFinishedLatest = [];
        $recentDocfile = [];
        $default_login_value = '';
        if( $customer ){
            $woSubmittedLatest = $this->Workorder_model->getRecentByCustomerIdAndStatus($customer->prof_id, 'Submitted');
            $jobFinishedLatest = $this->Jobs_model->getRecentByCustomerIdAndStatus($customer->prof_id, 'Finished');
            $recentDocfile     = $this->UserCustomerDocfile_model->getRecentDocfileByCustomerId($customer->prof_id);
            

            $comb1 = strtoupper(substr(trim($customer->first_name),0,1));
            $comb2 = strtolower($customer->last_name);
            $address_number = extractCustomerAddressNumber($customer->mail_add);
            if( $address_number ){
                $comb3 = $address_number;
            }else{
                if( $customer->customer_no != '' ){
                    $comb3 = str_replace("-","",$customer->customer_no);
                    $comb3 = substr(trim($comb3),0,3);
                }else{
                    $comb3 = substr(trim($customer->prof_id),0,3);
                }
            }

            $default_login_value = $comb1 . $comb2 . $comb3;

        }

        $default_total_pr = $this->Payment_records_model->getTotalRecurringPaymentsByCustomerId($userid);
        $default_total_payment_recorded = 0;

        if($default_total_pr && $default_total_pr->total_amount != '') {
            $default_total_payment_recorded = $default_total_pr->total_amount;
        }

        $siteTypes = $this->AcsAlarmSiteType_model->getAllByCompanyId($company_id);

        //Alarm Settings : Default Value
        $lastCustomer = $this->Customer_model->getLastCustomerByCompanyId($company_id);
        $business     = $this->Business_model->getByCompanyId($company_id);
        $customer_id  = $customer->prof_id ?? $lastCustomer->prof_id + 1;
        $default_dealer_number = $this->Customer_model->createDealerNumber($customer_id, $business->business_name);
        $defaultAlarmSiteType  = $this->AcsAlarmSiteType_model->getCompanyDefaultValue($company_id);
        $defaultInstallerCode  = $this->AcsAlarmInstallerCode_model->getCompanyDefaultValue($company_id);
        $panelTypes = $this->PanelType_model->getAllByCompanyId($company_id);
        $accountTypes = $this->AcsAccountType_model->getAllByCompanyId($company_id);
        $defaultAccountType  = $this->AcsAccountType_model->getCompanyDefaultValue($company_id);
        $monitoringCompanies = $this->AcsAlarmMonitoringCompany_model->getAllByCompanyId($company_id);
        $defaultMonitoringCompany = $this->AcsAlarmMonitoringCompany_model->getCompanyDefaultValue($company_id);
        $receiverPhoneNumbers = $this->AcsAlarmReceiverPhoneNumber_model->getAllByCompanyId($company_id);
        $defaultReceiverPhoneNumber = $this->AcsAlarmReceiverPhoneNumber_model->getCompanyDefaultValue($company_id);

        // search Alarm.com customer
        $this->load->helper(array('alarm_api_helper'));    
        $alarmApi = new AlarmApi();
        if (
            strpos($customer->status, 'Active w/RAR') !== false ||
            strpos($customer->status, 'Active w/RMR') !== false ||
            strpos($customer->status, 'Active w/RQR') !== false ||
            strpos($customer->status, 'Active w/RYR') !== false ||
            strpos($customer->status, 'Inactive w/RMM') !== false ||
            strpos($customer->status, 'Inactive w/RMR') !== false
        ) {
            $alarmCustomerDetails = $alarmApi->alarmApiRequest("getCustomerById", $customer->prof_id, null, null, null);
        }
        $this->page_data['alarmcom_info'] = $alarmCustomerDetails;

        $filter['is_active'] = 1;
        $filter['document_type'] = 'payment_details';
        $customer_attachments = $this->workorder_model->getCustomerAttachmentList($customer_id, $filter);

        $this->page_data['customer_attachments'] = $customer_attachments;

        $this->page_data['page']->title = 'Customers';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['customerAddress'] = $customerAddress;
        $this->page_data['companyFormSetting'] = $companyFormSetting;
        $this->page_data['formGroups'] = $formGroups;
        $this->page_data['customerProperty'] = $customerProperty;
        $this->page_data['financingCategories'] = $financingCategories;
        $this->page_data['sales_tech_paid'] = $this->customer_ad_model->getJobSalesTechPaid($id);
        $this->page_data['sales_tech_commission'] = $this->customer_ad_model->getJobSalesTechCommission($id)[0];
        $this->page_data['industryTypes'] = $this->IndustryType_model->getAll();
        $this->page_data['company_id'] = logged('company_id'); // Company ID of the logged in USER
        $this->page_data['LEAD_SOURCE_OPTION'] = $this->customer_ad_model->getAllSettingsLeadSourceByCompanyId(logged('company_id'));
        $this->page_data['company_industry']   = $company_industry;
        $this->page_data['is_with_customer_subscription'] = $client->is_with_customer_subscription;        
        $this->page_data['is_with_property_rental']       = $client->is_with_property_rental;
        $this->page_data['woSubmittedLatest'] = $woSubmittedLatest;
        $this->page_data['jobFinishedLatest'] = $jobFinishedLatest;
        $this->page_data['recentDocfile'] = $recentDocfile;
        $this->page_data['default_login_value'] = $default_login_value;
        $this->page_data['default_total_payment_recorded'] = $default_total_payment_recorded;
        $this->page_data['installerCodes'] = $installerCodes;
        $this->page_data['siteTypes'] = $siteTypes;
        $this->page_data['default_dealer_number'] = $default_dealer_number;
        $this->page_data['panelTypes'] = $panelTypes;
        $this->page_data['defaultAlarmSiteType'] = $defaultAlarmSiteType;
        $this->page_data['defaultInstallerCode'] = $defaultInstallerCode;
        $this->page_data['accountTypes'] = $accountTypes;
        $this->page_data['defaultAccountType'] = $defaultAccountType;
        $this->page_data['monitoringCompanies'] = $monitoringCompanies;
        $this->page_data['defaultMonitoringCompany'] = $defaultMonitoringCompany;
        $this->page_data['receiverPhoneNumbers'] = $receiverPhoneNumbers;
        $this->page_data['defaultReceiverPhoneNumber'] = $defaultReceiverPhoneNumber;
        //$this->load->view('v2/pages/customer/add', $this->page_data);
        $this->load->view('v2/pages/customer/add_dynamic_fields', $this->page_data);
    }

    public function cancellation_request($id = null)
    {
        $this->load->model('AcsCustomerCancellationRequest');
        $this->load->model('CustomerGroup_model');

        $this->hasAccessModule(9);
        
        if(!checkRoleCanAccessModule('customers', 'write')){
			show403Error();
			return false;
		}

        $customer_id = $id;
        $user_id     = logged('id');
        $company_id  = logged('company_id');        

        $cancel_request_data = $this->AcsCustomerCancellationRequest->getByCustomerId($customer_id);
        $profile_info   = $this->customer_ad_model->get_data_by_id('prof_id', $id, 'acs_profile');
        $customerGroup  = $this->CustomerGroup_model->getById($profile_info->customer_group_id);
        $alarm_info     = $this->customer_ad_model->get_data_by_id('fk_prof_id', $id, 'acs_alarm');  
        
        $this->page_data['profile_info']   = $profile_info;
        $this->page_data['cancel_request_data'] = $cancel_request_data;
        $this->page_data['sales_area']     = $this->customer_ad_model->get_all(false, '', 'ASC', 'ac_salesarea', 'sa_id');
        $this->page_data['customer_group'] = $customerGroup;
        $this->page_data['alarm_info']     = $alarm_info;

        $this->page_data['page']->title  = 'Customers';
        $this->page_data['page']->parent = 'Customers';        
        $this->load->view('v2/pages/customer/cancellation_request', $this->page_data);        

    }    

    public function leads()
    {
        $this->load->model('Lead_model');

        $this->hasAccessModule(14);

        if(!checkRoleCanAccessModule('leads', 'write')){
			show403Error();
			return false;
		}

        $cid = logged('company_id');
        $filter = 'All';
        if( $this->input->get('status') && $this->input->get('status') != 'all' ){
            $filter = $this->input->get('status');
            if( $filter == 'follow_up' ){
                $filter = 'follow up';
            }

            $filter = ucwords($filter);
            $filters[] = ['field_name' => 'ac_leads.status', 'field_value' => $filter];
            $filters[] = ['field_name' => 'ac_leads.is_archive', 'field_value' => 'No'];
            $leads = $this->Lead_model->getAllByCompanyId($cid, $filters);

        }else{
            $filters[] = ['field_name' => 'ac_leads.is_archive', 'field_value' => 'No'];
            $leads = $this->Lead_model->getAllByCompanyId($cid, $filters);
        }

        $this->page_data['filter'] = $filter;
        $this->page_data['page']->title = 'Leads';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['leads'] = $leads;
        $this->load->view('v2/pages/customer/leads', $this->page_data);
    }

    public function ac_module_sort($id = null)
    {
        // $user_id = logged('id');
        $this->load->library('wizardlib');
        $input = $this->input->post();
        if ($this->customer_ad_model->update_data($input, 'ac_module_sort', 'ams_id')) {
            $view = $this->wizardlib->getModuleById($id);
            $data['id'] = $id;
            $page = 'v2/pages/'.$view->ac_view_link;
            $this->load->view($page, $data);
        } else {
            echo 'Error';
        }
    }

    private function removeItemString($string, $item)
    {
        $parts = explode(',', $string);
        while (($i = array_search($item, $parts)) !== false) {
            unset($parts[$i]);
        }

        return implode(',', $parts);
    }

    public function remove_module()
    {
        $user_id = logged('id');
        $this->load->library('wizardlib');
        $details = post('ams_values');
        $ams_id = post('ams_id');
        $id = post('id');

        $mod_ids = $this->removeItemString($details, $id);
        $input = ['ams_id' => $ams_id, 'ams_values' => $mod_ids];
        if ($this->customer_ad_model->update_data($input, 'ac_module_sort', 'ams_id')) {
            $details = $this->customer_ad_model->get_data_by_id('fk_user_id', $user_id, 'ac_module_sort');
            echo $details->ams_values;
        } else {
            echo 'Error';
        }
    }

    public function qrcodeGenerator($profile_id)
    {
        $this->load->model('Business_model');
        $this->load->library('qrcode/ciqrcode');

        $company_id = logged('company_id');
        $company = $this->Business_model->getByCompanyId($company_id);
        if( $company ){
            $qr_data = base_url('customer_view/'.$company->profile_slug.'/'.$profile_id);
        }else{
            $qr_data = base_url('/');
        }   

        $SERVERFILEPATH = FCPATH .'assets/img/customer/qr/'.$profile_id.'.png';
        $params['data'] = $qr_data;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $SERVERFILEPATH;
        $this->ciqrcode->generate($params);
        // echo '<img src="'.base_url().'assets/img/customer/qr/names.png" />';
    }

    public function save_customer_profile()
    {
        $this->load->model('AcsNote_model');

        self::addJSONResponseHeader();

        $input = $this->input->post();
        if (isset($input['customer_id']) and !empty($input['customer_id'])) {
            $check_customer = '';
        } else {
            // $check_customer = $this->customer_ad_model->check_customer($input);

            // duplicate checking is implemented on Customer_Form apiCheckDuplicate
            $check_customer = [];
        }

        $is_favorite = 0;
        if( isset($input['is_favorite']) ){
            $is_favorite = 1;
        }

        $custom_fields_array = [];
        if (array_key_exists('custom_name', $input) && array_key_exists('custom_value', $input)) {
            foreach ($input['custom_name'] as $key => $name) {
                $cleanName = trim($name);
                $cleanValue = trim($input['custom_value'][$key]);

                if (!empty($cleanName) && !empty($cleanValue)) {
                    array_push($custom_fields_array, ['name' => $cleanName, 'value' => $cleanValue]);
                }
            }
        }

        if (empty($check_customer)) {
            // customer profile info
            $input_profile = [];
            $input_profile['fk_user_id'] = logged('id');
            $input_profile['fk_sa_id'] = $input['fk_sa_id'];
            $input_profile['company_id'] = logged('company_id');
            $input_profile['status'] = $input['status'];
            $input_profile['customer_type'] = $input['customer_type'];
            $input_profile['customer_group_id'] = $input['customer_group'];
            $input_profile['business_name'] = $input['business_name'];
            $input_profile['first_name'] = $input['first_name'];
            $input_profile['last_name'] = $input['last_name'];
            $input_profile['middle_name'] = $input['middle_name'];
            $input_profile['prefix'] = $input['prefix'];
            $input_profile['suffix'] = $input['suffix'];
            $input_profile['mail_add'] = $input['mail_add'];
            $input_profile['city'] = $input['city'];
            $input_profile['county'] = $input['county'];
            $input_profile['state'] = $input['state'];
            $input_profile['country'] = $input['country'];
            $input_profile['industry_type_id'] = $input['industry_type'];
            $input_profile['zip_code'] = $input['zip_code'];
            $input_profile['cross_street'] = $input['cross_street'];
            $input_profile['subdivision'] = $input['subdivision'];
            $input_profile['email'] = $input['email'];
            $input_profile['ssn'] = $input['ssn'];
            $input_profile['date_of_birth'] = $input['date_of_birth'];
            $input_profile['phone_h'] = $input['phone_h'];
            $input_profile['phone_m'] = $input['phone_m'];
            $input_profile['notes'] = trim($input['notes']);
            $input_profile['custom_fields'] = json_encode($custom_fields_array);
            $input_profile['is_favorite'] = $is_favorite;
            $input_profile['is_sync'] = 0;
            if ($input['bill_method'] == 'CC') {
                // Check cc if valid using converge
                $a_exp_date = explode('/', $input['credit_card_exp']);
                $exp_date = $a_exp_date[0].date('y', strtotime($a_exp_date[1].'-01-01'));
                $data_cc = [
                    'card_number' => $input['credit_card_num'],
                    'exp_date' => $exp_date,
                    'cvc' => $input['credit_card_exp_mm_yyyy'],
                    'ssl_amount' => 0,
                    'ssl_first_name' => $input['first_name'],
                    'ssl_last_name' => $input['last_name'],
                    'ssl_address' => $input['mail_add'].' '.$input['city'].' '.$input['state'],
                    'ssl_zip' => $input['zip_code'],
                ];
                $is_valid = $this->converge_check_cc_details_valid($data_cc);

                // echo $is_valid;
                if ($is_valid['is_success'] == 1) {
                    $proceed = 1;
                } else {
                    // $proceed = 0;
                    $proceed = 1;
                }
            } else {
                $proceed = 1;
            }

            if ($proceed == 1) {
                $prev_notes_value = '';
                if (isset($input['customer_id'])) {
                    $customer = $this->customer_ad_model->get_customer_data_settings($input['customer_id']);
                    $prev_notes_value = $customer[0]->notes;
                    if ($customer->adt_sales_project_id > 0) {
                        $input_profile['is_sync'] = 0;
                    }
                    $input_profile['customer_no'] = $input['customer_no'];
                    
                    $this->general->update_with_key_field($input_profile, $input['customer_id'], 'acs_profile', 'prof_id');
                    $profile_id = $input['customer_id'];
                    customerAuditLog(logged('id'), $profile_id, $profile_id, 'Customer', 'Updated customer '.$input['first_name'].' '.$input['last_name']);

                    $activity_action = 'Customer : Updated';
                } else {
                    $profile_id = $this->general->add_return_id($input_profile, 'acs_profile');

                    customerAuditLog(logged('id'), $profile_id, $profile_id, 'Customer', 'Created customer '.$input['first_name'].' '.$input['last_name']);
                    $activity_action = 'Customer : Created';
                }

                $companyId     = logged('company_id');
                $save_billing  = $this->save_billing_information($input, $profile_id);
                $save_office   = $this->save_office_information($input, $profile_id);
                $save_alarm    = $this->save_alarm_information($input, $profile_id);
                $save_access   = $this->save_access_information($input, $profile_id);
                $save_papers   = $this->save_papers_information($input, $profile_id);
                $save_contacts = $this->save_contacts($input, $profile_id);
                $save_property = $this->save_property_information($input, $profile_id);
                $save_other_address = $this->save_other_address($input, $profile_id);
                $save_notes = $this->save_notes($prev_notes_value, $input['notes'], $profile_id);

                if(isset($input['customer_id']) and !empty($input['customer_id'])) {

                    $customerDocFolderPath = "./uploads/customerdocuments/".$input['customer_id']."/";   
                    if (!file_exists($customerDocFolderPath)) {
                        mkdir($customerDocFolderPath, 0777, true);
                    }      

                    $customerDocFolderPath2 = "./uploads/CompanyPhoto/".$input['customer_id']."/"; 
                    if (!file_exists($customerDocFolderPath2)) {
                        mkdir($customerDocFolderPath2, 0777, true);
                    }      
                    
                    if(isset($_FILES['payment_attachments'])) {
                        $attachments = $_FILES['payment_attachments'];
                        foreach($attachments['name'] as $key => $attachment_name) {
                            $filename = $attachment_name;
                            if(isset($attachments['tmp_name'][$key]) && $attachments['tmp_name'][$key] != '') {
                                $tmp_name  = $attachments['tmp_name'][$key];
                                $extension = strtolower(end(explode('.',$filename)));
                                $attachment_photo = $input['customer_id'] . "_payment_photo_".basename($filename);

                                if(move_uploaded_file($tmp_name, $customerDocFolderPath.$attachment_photo)) {
                                    if (copy($customerDocFolderPath.$attachment_photo, $customerDocFolderPath2.$attachment_photo)) {
                                    }
                                }                              

                                $acsc_data2 = array(
                                    'customer_id'      => $input['customer_id'],
                                    'file_name'        => $attachment_photo,
                                    'document_type'    => 'payment_details',
                                    'document_label'   => 'Payment Details',
                                    'is_predefined'    => 0,
                                    'is_active'        => 1,
                                    'date_created'     => date("Y-m-d H:i:s")
                                );
                                $acs_cust_docs = $this->workorder_model->save_acs_customer_document($acsc_data2);  
                                if($acs_cust_docs) {} 
                            }
                        }
                    }
                }

                if(isset($input['customer_id']) and !empty($input['customer_id'])) {

                    $customerDocFolderPath = "./uploads/customerdocuments/".$input['customer_id']."/";   
                    if (!file_exists($customerDocFolderPath)) {
                        mkdir($customerDocFolderPath, 0777, true);
                    }      

                    $customerDocFolderPath2 = "./uploads/CompanyPhoto/".$input['customer_id']."/"; 
                    if (!file_exists($customerDocFolderPath2)) {
                        mkdir($customerDocFolderPath2, 0777, true);
                    }      
                    
                    if(isset($_FILES['payment_attachments'])) {
                        $attachments = $_FILES['payment_attachments'];
                        foreach($attachments['name'] as $key => $attachment_name) {
                            $filename = $attachment_name;
                            if(isset($attachments['tmp_name'][$key]) && $attachments['tmp_name'][$key] != '') {
                                $tmp_name  = $attachments['tmp_name'][$key];
                                $extension = strtolower(end(explode('.',$filename)));
                                $attachment_photo = $input['customer_id'] . "_payment_photo_".basename($filename);

                                if(move_uploaded_file($tmp_name, $customerDocFolderPath.$attachment_photo)) {
                                    if (copy($customerDocFolderPath.$attachment_photo, $customerDocFolderPath2.$attachment_photo)) {
                                    }
                                }                              

                                $acsc_data2 = array(
                                    'customer_id'      => $input['customer_id'],
                                    'file_name'        => $attachment_photo,
                                    'document_type'    => 'payment_details',
                                    'document_label'   => 'Payment Details',
                                    'is_predefined'    => 0,
                                    'is_active'        => 1,
                                    'date_created'     => date("Y-m-d H:i:s")
                                );
                                $acs_cust_docs = $this->workorder_model->save_acs_customer_document($acsc_data2);  
                                if($acs_cust_docs) {} 
                            }
                        }
                    }
                }

                if ($companyId == 58 || $companyId == 1) {
                    $this->save_solar_info($input, $profile_id);
                }

                if ($save_office == 0 || $save_alarm == 0 || $save_access == 0 || $save_papers == 0) {
                //if ($save_billing == 0 || $save_office == 0 || $save_alarm == 0 || $save_access == 0 || $save_papers == 0) {
                    echo 'Error Occured on Saving Billing Information';
                    $data_arr = ['success' => false, 'message' => 'Error on saving information'];
                } else {
                    // if ($input['notes'] != '' && $input['notes'] != null && !empty($input['notes'])) {
                    //     $this->save_notes($prev_notes_value, $input, $profile_id);
                    // }
                    // $this->generate_qr_image($profile_id);
                    if (isset($input['customer_id'])) {
                        $data_arr = ['success' => true, 'profile_id' => $input['customer_id']];
                    } else {
                        $data_arr = ['success' => true, 'profile_id' => $profile_id];
                    }
                }

                //Activity Logs
                $activity_name = $activity_action . ' customer record - ' . $input_profile['first_name'] . ' ' . $input_profile['last_name']; 
                createActivityLog($activity_name);
            }
        } else {
            $data_arr = ['success' => false, 'message' => 'Customer Already Exist!'];
        }
        exit(json_encode($data_arr));
    }

    public function save_other_address($input, $prof_id)
    {
        $this->load->model('CustomerAddress_model');

        $total_save = 0;
        if( $input['otherMailingAddress'] ){
            $this->CustomerAddress_model->deleteAllByCustomerId($prof_id);
            foreach($input['otherMailingAddress'] as $key => $value){
                $data = [
                    'customer_id' => $prof_id,
                    'mail_add' => $input['otherMailingAddress'][$key],
                    'city' => $input['otherCity'][$key],
                    'state' => $input['otherState'][$key],
                    'zip' => $input['otherZip'][$key],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s")
                ];

                $this->CustomerAddress_model->create($data);
                $$total_records++;
            }
        }

        return $total_records;
    }

    public function save_property_information($input, $prof_id)
    {
        $this->load->model('AcsProperties_model');

        $customerProperty = $this->AcsProperties_model->getByCustomerId($prof_id);
        if( $customerProperty ){
            $data = [
                'inventory' => $input['prop_inventory'] ? $input['prop_inventory'] : '',
                'plan_type' => $input['prop_plan_type'] ? $input['prop_plan_type'] : '',
                'deductible' => $input['prop_deductible'] ? $input['prop_deductible'] : '',
                'revenue' => $input['prop_revenue'] ? $input['prop_revenue'] : '',
                'territory' => $input['prop_territory'] ? $input['prop_territory'] : '',
                'property_tax' => $input['prop_property_tax'] ?  $input['prop_property_tax'] : 0,
                'add_on' => $input['prop_add_on'] ? $input['prop_add_on'] : '',
                'ac_type' => $input['prop_ac_type'] ? $input['prop_ac_type'] : '',
                'payment_history' => $input['prop_payment_history'] ? $input['prop_payment_history'] : '',
                'late_fee_collected' => $input['prop_late_fee_collected'] ? $input['prop_late_fee_collected'] : '',
                'alarm_system' => $input['prop_alarm_system'] ? $input['prop_alarm_system'] : '',
                'key_code' => $input['prop_key_code'] ? $input['prop_key_code'] : '',
                'source' => $input['prop_source'],
                'ownership' => $input['prop_ownership'],
                'date_modified' => date("Y-m-d H:i:s")
            ];
            $this->AcsProperties_model->update($customerProperty->id, $data);            

        }else{
            $data = [
                'customer_id' => $prof_id,
                'inventory' => $input['prop_inventory'] ? $input['prop_inventory'] : '',
                'plan_type' => $input['prop_plan_type'] ? $input['prop_plan_type'] : '',
                'deductible' => $input['prop_deductible'] ? $input['prop_deductible'] : '',
                'revenue' => $input['prop_revenue'] ? $input['prop_revenue'] : '',
                'territory' => $input['prop_territory'] ? $input['prop_territory'] : '',
                'property_tax' => $input['prop_property_tax'] ? $input['prop_property_tax'] : '',
                'add_on' => $input['prop_add_on'] ? $input['prop_add_on'] : '',
                'ac_type' => $input['prop_ac_type'] ? $input['prop_ac_type'] : '',
                'payment_history' => $input['prop_payment_history'] ? $input['prop_payment_history'] : '',
                'late_fee_collected' => $input['prop_late_fee_collected'] ? $input['prop_late_fee_collected'] : '',
                'alarm_system' => $input['prop_alarm_system'] ? $input['prop_alarm_system'] : '',
                'key_code' => $input['prop_key_code'] ? $input['prop_key_code'] : '',
                'source' => $input['prop_source'] ? $input['prop_source'] : '',
                'ownership' => $input['prop_ownership'] ? $input['prop_ownership'] : '',
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];
            $this->AcsProperties_model->create($data);
        }

        return true;
    }

    public function save_person_profile()
    {
        try {

            self::addJSONResponseHeader();
            $this->load->model('Customer_model', 'company');
            $input = $this->input->post();
      
            $input_profile = [
                'fk_user_id' => logged('id'),
                'fk_sa_id' => $input['fk_sa_id'],
                'company_id' => logged('company_id'),
                'status' => $input['status'],
                'customer_type' => $input['customer_type'],
                'customer_group_id' => $input['customer_group'],
                'business_name' => $input['business_name'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'middle_name' => $input['middle_name'],
                'prefix' => $input['prefix'],
                'suffix' => $input['suffix'],
                'mail_add' => $input['mail_add'],
                'city' => $input['city'],
                'county' => $input['county'],
                'state' => $input['state'],
                //'country' => $input['country'],
                'industry_type_id' => $input['industry_type'],
                'zip_code' => $input['zip_code'],
                'cross_street' => $input['cross_street'],
                //'subdivision' => $input['subdivision'],
                'email' => $input['email'],
                'ssn' => $input['ssn'],
                'date_of_birth' => $input['date_of_birth'],
                'phone_h' => $input['phone_h'],
                'phone_m' => $input['phone_m'],
                'notes' => trim($input['notes']),
                'is_sync' => 0
            ];

            if ($input['prof_id'] == "") {
                $insert_result = $this->company->insert_data($input_profile);
                $response['success'] = $insert_result;
                $response['message'] = $insert_result ? 'Data inserted successfully' : 'Failed to insert data';
            } else {
                $update_result = $this->company->update_data($input['prof_id'], $input_profile);
                $response['success'] = $update_result;
                $response['message'] = $update_result ? 'Data updated successfully' : 'Failed to update data';
            }

            //Activity Logs
            if( $input['customer_type'] == 'Residential' ){
                $activity_name = 'Created New Residential Customer ' . $input['first_name'] . ' ' . $input['last_name']; 
            }else{
                $activity_name = 'Created New Commercial Customer ' . $input['first_name'] . ' ' . $input['last_name']; 
            }
            
            createActivityLog($activity_name);
            
            // Return the response as JSON
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
            
         } catch (Exception $e) {
            // Handle any unexpected exceptions here
            
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    
    }

    public function getDuplicateList($customerType)
    {
        $company_id = logged('company_id');
        if ($customerType == 'Residential') {
            $customerWithCount = $this->customer_ad_model->getDuplicateListData($company_id, 'customer_with_count', false, 'Residential', null, null, null);
            $allDuplicatedCustomer = $this->customer_ad_model->getDuplicateListData($company_id, 'all_duplicated_customer', false, null, null, null, null);
            $html = '';
            foreach ($customerWithCount as $customerWithCountData) {
                $i = 0;
                $customerUniqueID = md5($customerWithCountData->prof_id);
                $customerName1 = trim($customerWithCountData->first_name).' '.trim($customerWithCountData->last_name);
                $businessName1 = trim($customerWithCountData->business_name);
                $total = trim($customerWithCountData->total);

                if (trim($customerWithCountData->customer_type) == 'Residential') {
                    $html .= "<tr data-selector='row_$customerUniqueID' onclick='$(`.row_$customerUniqueID`).toggle()'>";
                    $html .= "<td><i class='fas fa-caret-right'></i>&emsp;<strong>$customerName1 ($total)</strong></td>";
                    $html .= '<td>&emsp;</td>';
                    $html .= '<td>&emsp;</td>';
                    $html .= '<td>&emsp;</td>';
                    $html .= "<td><button class='nsm-button primary small openCompareUI' data-selector='row_$customerUniqueID' data-firstname='".htmlspecialchars(trim($customerWithCountData->first_name), ENT_QUOTES)."' data-lastname='".htmlspecialchars(trim($customerWithCountData->last_name), ENT_QUOTES)."' data-customer-type='Residential'><i class='fas fa-copy'></i> Compare</button></td>";
                    $html .= '</tr>';
                    foreach ($allDuplicatedCustomer as $allDuplicatedCustomerData) {
                        $customerName2 = trim($allDuplicatedCustomerData->first_name).' '.trim($allDuplicatedCustomerData->last_name);
                        $activityLogs = ($allDuplicatedCustomerData->customer_logs != 0) ? "<strong>$allDuplicatedCustomerData->customer_logs</strong> activity logs!" : '0 activity logs';
                        if ($customerName1 == $customerName2 && trim($allDuplicatedCustomerData->customer_type) == 'Residential') {
                            ++$i;
                            $html .= "<tr data-selector='row_$customerUniqueID' class='row_$customerUniqueID' style='display: none;'>";
                            $html .= "<td>&emsp; └╴<span>$customerName2 <small class='text-muted'>(#$i)</small></span></td>";
                            $html .= '<td>Residential</td>';
                            $html .= '<td>'.trim($allDuplicatedCustomerData->address).'</td>';
                            $html .= "<td>$activityLogs</td>";
                            $html .= "<td><button class='nsm-button small border-0' onclick='viewEntry($allDuplicatedCustomerData->prof_id)'><i class='fas fa-search'></i> View</button><button class='nsm-button small border-0 removeDuplicatedEntry' data-selector='row_$customerUniqueID' data-prof_id='".$allDuplicatedCustomerData->prof_id."' data-entry-name='".$customerName2."' data-number='".$i."' data-customer-type='".$allDuplicatedCustomerData->customer_type."'><i class='fas fa-trash'></i> Remove</button></td>";
                            $html .= '</tr>';
                        }
                    }
                }
            }
            echo $html;
        } elseif ($customerType == 'Commercial') {
            $customerWithCount = $this->customer_ad_model->getDuplicateListData($company_id, 'customer_with_count', false, 'Commercial', null, null, null);
            $allDuplicatedCustomer = $this->customer_ad_model->getDuplicateListData($company_id, 'all_duplicated_customer', false, null, null, null, null);
            $html = '';
            foreach ($customerWithCount as $customerWithCountData) {
                $i = 0;
                $customerUniqueID = md5($customerWithCountData->prof_id);
                $customerName1 = trim($customerWithCountData->first_name).' '.trim($customerWithCountData->last_name);
                $businessName1 = trim($customerWithCountData->business_name);
                $total = trim($customerWithCountData->total);

                if (trim($customerWithCountData->customer_type) == 'Commercial') {
                    $html .= "<tr data-selector='row_$customerUniqueID' onclick='$(`.row_$customerUniqueID`).toggle()'>";
                    $html .= "<td><i class='fas fa-caret-right'></i>&emsp;<strong>$businessName1 ($total)</strong></td>";
                    $html .= '<td>&emsp;</td>';
                    $html .= '<td>&emsp;</td>';
                    $html .= '<td>&emsp;</td>';
                    $html .= "<td><button class='nsm-button primary small openCompareUI' data-selector='row_$customerUniqueID' data-business-name='".htmlspecialchars(trim($businessName1), ENT_QUOTES)."' data-customer-type='Commercial'><i class='fas fa-copy'></i> Compare</button></td>";
                    $html .= '</tr>';

                    foreach ($allDuplicatedCustomer as $allDuplicatedCustomerData) {
                        $businessName2 = trim($allDuplicatedCustomerData->business_name);
                        $activityLogs = ($allDuplicatedCustomerData->customer_logs != 0) ? "<strong>$allDuplicatedCustomerData->customer_logs activity logs!</strong>" : '0 activity logs';
                        if ($businessName1 == $businessName2 && trim($allDuplicatedCustomerData->customer_type) != 'Residential') {
                            ++$i;
                            $html .= "<tr data-selector='row_$customerUniqueID' class='row_$customerUniqueID' style='display: none;'>";
                            $html .= "<td>&emsp; └╴<span>$businessName2 <small class='text-muted'>(#$i)</small></span></td>";
                            $html .= '<td>Commercial</td>';
                            $html .= '<td>'.trim($allDuplicatedCustomerData->address).'</td>';
                            $html .= "<td>$activityLogs</td>";
                            $html .= "<td><button class='nsm-button small border-0' onclick='viewEntry($allDuplicatedCustomerData->prof_id)'><i class='fas fa-search'></i> View</button><button class='nsm-button small border-0 removeDuplicatedEntry' data-selector='row_$customerUniqueID' data-prof_id='".$allDuplicatedCustomerData->prof_id."' data-entry-name='".$businessName2."' data-number='".$i."' data-customer-type='".$allDuplicatedCustomerData->customer_type."'><i class='fas fa-trash'></i> Remove</button></td>";
                            $html .= '</tr>';
                        }
                    }
                }
            }
            echo $html;
        }
    }

    public function getSpecificDuplicatesToMerge()
    {
        $company_id = logged('company_id');
        $data = $this->input->post();

        $html = '';
        if ($data['entryType'] == 'Residential') {
            $fetchData = $this->customer_ad_model->getDuplicateListData($company_id, 'all_duplicated_customer', true, 'Residential', null, $data['entryFName'], $data['entryLName']);
            foreach ($fetchData as $fetchDatas) {
                $customer_logs = ($fetchDatas->customer_logs == 0) ? 0 : $fetchDatas->customer_logs;
                $status = (!empty(trim($fetchDatas->status))) ? trim($fetchDatas->status) : '—';
                $customer_type = (!empty(trim($fetchDatas->customer_type))) ? trim($fetchDatas->customer_type) : '—';
                $business_name = (!empty(trim($fetchDatas->business_name))) ? trim($fetchDatas->business_name) : '—';
                $title = (!empty(trim($fetchDatas->title))) ? trim($fetchDatas->title) : '—';
                $sa_name = (!empty(trim($fetchDatas->sa_name))) ? trim($fetchDatas->sa_name) : '—';
                $first_name = (!empty(trim($fetchDatas->first_name))) ? trim($fetchDatas->first_name) : '—';
                $middle_name = (!empty(trim($fetchDatas->middle_name))) ? trim($fetchDatas->middle_name) : '—';
                $last_name = (!empty(trim($fetchDatas->last_name))) ? trim($fetchDatas->last_name) : '—';
                $prefix = (!empty(trim($fetchDatas->prefix))) ? trim($fetchDatas->prefix) : 'None';
                $suffix = (!empty(trim($fetchDatas->suffix))) ? trim($fetchDatas->suffix) : 'None';
                $country = (!empty(trim($fetchDatas->country))) ? trim($fetchDatas->country) : '—';
                $mail_add = (!empty(trim($fetchDatas->mail_add))) ? trim($fetchDatas->mail_add) : '—';
                $city = (!empty(trim($fetchDatas->city))) ? trim($fetchDatas->city) : '—';
                $county = (!empty(trim($fetchDatas->county))) ? trim($fetchDatas->county) : '—';
                $state = (!empty(trim($fetchDatas->state))) ? trim($fetchDatas->state) : '—';
                $zip_code = (!empty(trim($fetchDatas->zip_code))) ? trim($fetchDatas->zip_code) : '—';
                $cross_street = (!empty(trim($fetchDatas->cross_street))) ? trim($fetchDatas->cross_street) : '—';
                $subdivision = (!empty(trim($fetchDatas->subdivision))) ? trim($fetchDatas->subdivision) : '—';
                $ssn = (!empty(trim($fetchDatas->ssn))) ? trim($fetchDatas->ssn) : '000-00-0000';
                $date_of_birth = (!empty(trim($fetchDatas->date_of_birth))) ? trim($fetchDatas->date_of_birth) : '—';
                $email = (!empty(trim($fetchDatas->email))) ? trim($fetchDatas->email) : '—';
                $phone_h = (!empty(trim($fetchDatas->phone_h))) ? trim($fetchDatas->phone_h) : '000-000-0000';
                $phone_m = (!empty(trim($fetchDatas->phone_m))) ? trim($fetchDatas->phone_m) : '000-000-0000';

                $html .= "
                <div class='col-lg-1 w-auto entryDuplicateData'>
                    <table class='table table-hover data_$fetchDatas->prof_id'>
                        <tbody>
                            <tr><td class='align-middle fw-xnormal'><small class='logsCount'>$customer_logs activity logs</small><button class='btn btn-outline-danger btn-sm border-0 float-end removeDuplicatedEntry2' data-prof_id='$fetchDatas->prof_id' data-entry-name='$first_name $last_name' style='margin: -2px;'><i class='fas fa-trash'></i></button><button class='btn btn-outline-secondary copyColumnEntry btn-sm border-0 float-end' data-prof_id='$fetchDatas->prof_id' style='margin: -2px; margin-right: 5px;'><i class='fas fa-copy'></i></button></td></tr>
                            <tr><td class='align-middle profileData' data-logscount='$customer_logs activity logs'>
                                    <div class='float-start'>
                                        <div class='nsm-profile'><span class='entryDuplicateInitials'>".$first_name[0].' '.$last_name[0]."</span></div>
                                    </div>
                                    <div class='mergeProfile'>
                                        <label class='nsm-link default d-block fw-bold'><span class='entryDuplicateName'>$first_name $last_name</span><small class='text-muted float-end entryDuplicateID'>#$fetchDatas->prof_id</small></label>
                                        <label class='nsm-link default content-subtitle fst-italic d-block'><span class='entryDuplicateEmail'>$email</span></label>
                                    </div>
                                </td>
                            </tr>
                            <tr><td class='align-middle fw-xnormal statusField'><span>$status</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal customerTypeField'><span>$customer_type</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal businessNameField'><span>$business_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal customerGroupField'><span>$title</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal salesAreaField'><span>$sa_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal firstNameField'><span>$first_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal middleNameField'><span>$middle_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal lastNameField'><span>$last_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal namePrefixField'><span>$prefix</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal suffixField'><span>$suffix</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal countryField'><span>$country</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal addressField'><span>$mail_add</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal cityField'><span>$city</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal countyField'><span>$county</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal stateField'><span>$state</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal zipCodeField'><span>$zip_code</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal crossStreetField'><span>$cross_street</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal subDivisionField'><span>$subdivision</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal socialSecurityNoField'><span>$ssn</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal birthDateField'><span>$date_of_birth</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal emailField'><span>$email</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal phoneField'><span>$phone_h</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal mobileField'><span>$phone_m</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                        </tbody>
                    </table>
                </div>
                ";
            }
        } elseif ($data['entryType'] == 'Commercial' || $data['entryType'] == 'Business') {
            $fetchData = $this->customer_ad_model->getDuplicateListData($company_id, 'all_duplicated_customer', true, 'Commercial', $data['entryBusinessName'], null, null);
            foreach ($fetchData as $fetchDatas) {
                $customer_logs = ($fetchDatas->customer_logs == 0) ? 0 : $fetchDatas->customer_logs;
                $status = (!empty(trim($fetchDatas->status))) ? trim($fetchDatas->status) : '—';
                $customer_type = (!empty(trim($fetchDatas->customer_type))) ? trim($fetchDatas->customer_type) : '—';
                $business_name = (!empty(trim($fetchDatas->business_name))) ? trim($fetchDatas->business_name) : '—';
                $title = (!empty(trim($fetchDatas->title))) ? trim($fetchDatas->title) : '—';
                $sa_name = (!empty(trim($fetchDatas->sa_name))) ? trim($fetchDatas->sa_name) : '—';
                $first_name = (!empty(trim($fetchDatas->first_name))) ? trim($fetchDatas->first_name) : '—';
                $middle_name = (!empty(trim($fetchDatas->middle_name))) ? trim($fetchDatas->middle_name) : '—';
                $last_name = (!empty(trim($fetchDatas->last_name))) ? trim($fetchDatas->last_name) : '—';
                $prefix = (!empty(trim($fetchDatas->prefix))) ? trim($fetchDatas->prefix) : 'None';
                $suffix = (!empty(trim($fetchDatas->suffix))) ? trim($fetchDatas->suffix) : 'None';
                $country = (!empty(trim($fetchDatas->country))) ? trim($fetchDatas->country) : '—';
                $mail_add = (!empty(trim($fetchDatas->mail_add))) ? trim($fetchDatas->mail_add) : '—';
                $city = (!empty(trim($fetchDatas->city))) ? trim($fetchDatas->city) : '—';
                $county = (!empty(trim($fetchDatas->county))) ? trim($fetchDatas->county) : '—';
                $state = (!empty(trim($fetchDatas->state))) ? trim($fetchDatas->state) : '—';
                $zip_code = (!empty(trim($fetchDatas->zip_code))) ? trim($fetchDatas->zip_code) : '—';
                $cross_street = (!empty(trim($fetchDatas->cross_street))) ? trim($fetchDatas->cross_street) : '—';
                $subdivision = (!empty(trim($fetchDatas->subdivision))) ? trim($fetchDatas->subdivision) : '—';
                $ssn = (!empty(trim($fetchDatas->ssn))) ? trim($fetchDatas->ssn) : '000-00-0000';
                $date_of_birth = (!empty(trim($fetchDatas->date_of_birth))) ? trim($fetchDatas->date_of_birth) : '—';
                $email = (!empty(trim($fetchDatas->email))) ? trim($fetchDatas->email) : '—';
                $phone_h = (!empty(trim($fetchDatas->phone_h))) ? trim($fetchDatas->phone_h) : '000-000-0000';
                $phone_m = (!empty(trim($fetchDatas->phone_m))) ? trim($fetchDatas->phone_m) : '000-000-0000';

                $html .= "
                <div class='col-lg-1 w-auto entryDuplicateData'>
                    <table class='table table-hover data_$fetchDatas->prof_id'>
                        <tbody>
                            <tr><td class='align-middle fw-xnormal'><small class='logsCount'>$customer_logs activity logs</small><button class='btn btn-outline-danger btn-sm border-0 float-end removeDuplicatedEntry2' data-prof_id='$fetchDatas->prof_id' data-entry-name='$first_name $last_name' style='margin: -2px;'><i class='fas fa-trash'></i></button><button class='btn btn-outline-secondary copyColumnEntry btn-sm border-0 float-end' data-prof_id='$fetchDatas->prof_id' style='margin: -2px; margin-right: 5px;'><i class='fas fa-copy'></i></button></td></tr>
                            <tr><td class='align-middle profileData' data-logscount='$customer_logs activity logs'>
                                    <div class='float-start'>
                                        <div class='nsm-profile'><span class='entryDuplicateInitials'>".$first_name[0].' '.$last_name[0]."</span></div>
                                    </div>
                                    <div class='mergeProfile'>
                                        <label class='nsm-link default d-block fw-bold'><span class='entryDuplicateName'>$first_name $last_name</span><small class='text-muted float-end entryDuplicateID'>#$fetchDatas->prof_id</small></label>
                                        <label class='nsm-link default content-subtitle fst-italic d-block'><span class='entryDuplicateEmail'>$email</span></label>
                                    </div>
                                </td>
                            </tr>
                            <tr><td class='align-middle fw-xnormal statusField'><span>$status</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal customerTypeField'><span>$customer_type</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal businessNameField'><span>$business_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal customerGroupField'><span>$title</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal salesAreaField'><span>$sa_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal firstNameField'><span>$first_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal middleNameField'><span>$middle_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal lastNameField'><span>$last_name</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal namePrefixField'><span>$prefix</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal suffixField'><span>$suffix</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal countryField'><span>$country</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal addressField'><span>$mail_add</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal cityField'><span>$city</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal countyField'><span>$county</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal stateField'><span>$state</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal zipCodeField'><span>$zip_code</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal crossStreetField'><span>$cross_street</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal subDivisionField'><span>$subdivision</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal socialSecurityNoField'><span>$ssn</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal birthDateField'><span>$date_of_birth</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal emailField'><span>$email</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal phoneField'><span>$phone_h</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                            <tr><td class='align-middle fw-xnormal mobileField'><span>$phone_m</span><i class='fas fa-check checkSize align-middle float-end'></i></td></tr>
                        </tbody>
                    </table>
                </div>
                ";
            }
        }
        echo $html;
    }

    public function entryMergeProcess()
    {
        $post = $this->input->post();

        $updateData = [
            'status' => $post['destinationStatus'],
            'customer_type' => $post['destinationCustomerType'],
            'business_name' => $post['destinationBusinessName'],
            'customer_group_id' => $post['destinationCustomerGroup'],
            'fk_sa_id' => $post['destinationSalesArea'],
            'first_name' => $post['destinationFirstName'],
            'middle_name' => $post['destinationMiddleName'],
            'last_name' => $post['destinationLastName'],
            'prefix' => $post['destinationNamePrefix'],
            'suffix' => $post['destinationSuffix'],
            'country' => $post['destinationCountry'],
            'mail_add' => $post['destinationAddress'],
            'city' => $post['destinationCity'],
            'county' => $post['destinationCounty'],
            'state' => $post['destinationState'],
            'zip_code' => $post['destinationZipCode'],
            'subdivision' => $post['destinationCrossStreet'],
            'cross_street' => $post['destinationSubdivision'],
            'ssn' => $post['destinationSocialSecurityNo'],
            'date_of_birth' => $post['destinationBirthdate'],
            'email' => $post['destinationEmail'],
            'phone_h' => $post['destinationPhone'],
            'phone_m' => $post['destinationMobile'],
            'activated' => 1,
        ];

        $mergeProcess = $this->customer_ad_model->mergeEntryUpdater(
            $updateData,
            $post['destinationCustomerID'],
            $post['originFirstname'],
            $post['originLastname'],
            $post['originBusinessName']
        );

        echo $mergeProcess;
    }

    public function checkCustomerDuplicate()
    {
        $company_id = logged('company_id');

        $data = [
            'company_id' => $company_id,
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'customer_type' => $this->input->post('customer_type'),
            'business_name' => $this->input->post('business_name'),
        ];

        $getData = $this->customer_ad_model->customerDuplicateLookup($data);

        $html = '';

        if ($data['customer_type'] == 'Residential') {
            $html .= "<table class='table table-bordered table-hover'>";
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Customer</th>';
            $html .= '<th>Type</th>';
            $html .= "<th width='175px'>Action</th>";
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($getData as $customer) {
                if ($customer->customer_type == 'Residential') {
                    $html .= '<tr>';
                    $html .= "<td>$customer->first_name $customer->last_name</td>";
                    $html .= "<td>$customer->customer_type</td>";
                    $html .= "<td><button class='nsm-button small' onclick='viewCustomer($customer->prof_id)'><i class='fas fa-search'></i> View</button><button class='nsm-button small' onclick='removeCustomer($customer->prof_id)'><i class='fas fa-trash'></i> Remove</button></td>";
                    $html .= '</tr>';
                }
            }
            $html .= '</tbody>';
            $html .= '</table>';
        } elseif ($data['customer_type'] == 'Commercial' || $data['customer_type'] == 'Business') {
            $html .= "<table class='table table-bordered'>";
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Customer</th>';
            $html .= '<th>Type</th>';
            $html .= '<th>Business Name</th>';
            $html .= '<th>Action</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($getData as $customer) {
                if ($customer->customer_type == 'Commercial' || $customer->customer_type == 'Business') {
                    $html .= '<tr>';
                    $html .= "<td>$customer->first_name $customer->last_name</td>";
                    $html .= "<td>$customer->customer_type</td>";
                    $html .= "<td>$customer->business_name</td>";
                    $html .= "<td><button class='nsm-button small' onclick='viewCustomer($customer->prof_id)'><i class='fas fa-search'></i> View</button><button class='nsm-button small' onclick='removeCustomer($customer->prof_id)'><i class='fas fa-trash'></i> Remove</button></td>";
                    $html .= '</tr>';
                }
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }

        echo $html;
    }

    public function converge_check_cc_details_valid($data)
    {
        include APPPATH.'libraries/Converge/src/Converge.php';

        $msg = '';
        $is_success = 0;

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $verify = $converge->request('ccverify', [
            'ssl_card_number' => $data['card_number'],
            'ssl_exp_date' => $data['exp_date'],
            'ssl_cvv2cvc2' => $data['cvc'],
            'ssl_first_name' => $data['ssl_first_name'],
            'ssl_last_name' => $data['ssl_last_name'],
            'ssl_amount' => $data['ssl_amount'],
            'ssl_avs_address' => $data['ssl_address'],
            'ssl_avs_zip' => $data['ssl_zip'],
        ]);
        if ($verify['success'] == 1) {
            if ($verify['ssl_result_message'] == 'DECLINED') {
                $is_success = 0;
            } else {
                $is_success = 1;
            }
        } else {
            $msg = $verify['errorMessage'];
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];

        return $return;
    }

    /**
     * This function will save/update solar information of the customer.
     *
     * * @param input Input data from customer form
     * * @param id ID of the customer
     *
     * @return bool return TRUE if successfull transaction
     */
    public function save_solar_info($input, $id)
    {
        $solarInfo = [];
        $solarInfo['fk_prof_id']  = $id;
        $solarInfo['project_id']  = $input['project_id'] ? $input['project_id'] : 0;
        $solarInfo['lender_type'] = $input['lender_type'] ? $input['lender_type'] : '';
        $solarInfo['proposed_system_size'] = $input['proposed_system_size'] ? $input['proposed_system_size'] : '';
        $solarInfo['proposed_modules']  = $input['proposed_modules'] ? $input['proposed_modules'] : '';
        $solarInfo['proposed_inverter'] = $input['proposed_inverter'] ? $input['proposed_inverter'] : '';
        $solarInfo['proposed_offset']   = $input['proposed_offset'] ? $input['proposed_offset'] : '';
        $solarInfo['proposed_solar']    = $input['proposed_solar'] ? $input['proposed_solar'] : '';
        $solarInfo['proposed_utility']  = $input['proposed_utility'] ? $input['proposed_utility'] : '';
        $solarInfo['proposed_payment']  = $input['proposed_payment'] ? $input['proposed_payment'] : '';
        $solarInfo['annual_income']     = $input['annual_income'] ? $input['annual_income'] : '';
        $solarInfo['tree_estimate']     = $input['tree_estimate'] ? $input['tree_estimate'] : '';
        $solarInfo['roof_estimate']     = $input['roof_estimate'] ? $input['roof_estimate'] : '';
        $solarInfo['utility_account']   = $input['utility_account'] ? $input['utility_account'] : '';
        $solarInfo['utility_login']     = $input['utility_login'] ? $input['utility_login'] : '';
        $solarInfo['utility_pass']      = $input['utility_pass'] ? $input['utility_pass'] : '';
        $solarInfo['meter_number']      = $input['meter_number'] ? $input['meter_number'] : '';
        $solarInfo['insurance_name']    = $input['insurance_name'] ? $input['insurance_name'] : '';
        $solarInfo['insurance_number']  = $input['insurance_number'] ? $input['insurance_number'] : '';
        $solarInfo['policy_number']     = $input['policy_number'] ? $input['policy_number'] : '';
        $solarInfo['kw_dc']             = $input['kw_dc'] ? $input['kw_dc'] : '';
        $solarInfo['solar_system_size'] = $input['solar_system_size'] ? $input['solar_system_size'] : '';

        $check = [
            'where' => ['fk_prof_id' => $id],
            'table' => 'acs_info_solar',
        ];
        $exist = $this->general->get_data_with_param($check, false);
        if ($exist) {
            return $this->general->update_with_key_field($solarInfo, $input['customer_id'], 'acs_info_solar', 'fk_prof_id');
        } else {
            return $this->general->add_($solarInfo, 'acs_info_solar');
        }
    }

    public function save_billing_information($input, $id)
    {
        if( ($input['bill_method'] && $input['bill_method'] != '') ){
            $rate_plan_id = 0;
            $mmr_amount   = 0;
            if( $input['mmr'] > 0 ){
                $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($input['mmr'], logged('company_id'));
                $rate_plan_id = $ratePlan->id;
                $mmr_amount   = $ratePlan->amount;
            }

            $input_billing = [];
            // billing data
            switch ($input['bill_freq']) {
                case 'One Time Only':
                    $billing_frequency = 0;
                    break;
                case 'Every 1 Month':
                    $billing_frequency = 1;
                    break;
                case 'Every 3 Months':
                    $billing_frequency = 3;
                    break;
                case 'Every 6 Months':
                    $billing_frequency = 6;
                    break;
                case 'Every 1 Year':
                    $billing_frequency = 12;
                    break;
                default:
                    $billing_frequency = 1;
                    break;
            }

            $next_billing_date  = date('m/'.$input['bill_day'].'/Y', strtotime('+'.$billing_frequency.' months', strtotime($input['bill_start_date'])));
            $next_billing_date  = date('Y-m-d', strtotime($next_billing_date));

            $input_billing['fk_prof_id'] = $id;
            $input_billing['ac_rate_plan_id'] = $rate_plan_id;
            $input_billing['card_fname'] = $input['card_fname'];
            $input_billing['card_lname'] = $input['card_lname'];
            $input_billing['card_address'] = $input['card_address'];
            $input_billing['city'] = $input['billing_city'];
            $input_billing['state'] = $input['billing_state'];
            $input_billing['zip'] = $input['billing_zip'];
            $input_billing['equipment'] = $input['equipment'];
            $input_billing['initial_dep'] = $input['initial_dep'];
            $input_billing['mmr'] = $mmr_amount;
            $input_billing['bill_freq'] = $input['bill_freq'];
            $input_billing['bill_day'] = $input['bill_day'];
            $input_billing['contract_term'] = $input['contract_term'];
            $input_billing['bill_start_date'] = date("Y-m-d",strtotime($input['bill_start_date']));
            $input_billing['bill_end_date'] = date("Y-m-d",strtotime($input['bill_end_date']));
            $input_billing['late_fee'] = $input['late_fee'];
            $input_billing['payment_fee'] = $input['payment_fee'];
            $input_billing['bill_method'] = $input['bill_method'];
            $input_billing['check_num'] = $input['check_num'];
            $input_billing['bank_name'] = $input['bank_name'];
            $input_billing['routing_num'] = $input['routing_num'];
            $input_billing['acct_num'] = $input['acct_num'];
            $input_billing['credit_card_num'] = $input['credit_card_num'];
            $input_billing['credit_card_exp'] = $input['credit_card_exp'];
            $input_billing['credit_card_exp_mm_yyyy'] = $input['credit_card_exp_mm_yyyy'];
            $input_billing['account_credential'] = $input['account_credential'];
            $input_billing['account_note'] = $input['account_note'];
            $input_billing['confirmation'] = $input['confirmation'];
            $input_billing['finance_amount'] = $input['finance_amount'];
            $input_billing['number_payment'] = $input['number_payment'] && $input['number_payment'] > 0 ? $input['number_payment'] : 0;
            $input_billing['recurring_start_date'] = $input['recurring_start_date'];
            $input_billing['recurring_end_date'] = $input['recurring_end_date'];
            $input_billing['transaction_amount'] = $input['transaction_amount'];
            $input_billing['transaction_category'] = $input['transaction_category'];
            $input_billing['frequency'] = $input['frequency']; // Subscription
            $input_billing['billing_frequency'] = $input['bill_freq'] ? $input['bill_freq'] : ''; // Billing   
            $input_billing['payment_recorded'] = $input['payment_recorded'];
            $input_billing['unpaid_amount'] = $input['unpaid_amount'] && $input['unpaid_amount'] > 0 ? $input['unpaid_amount'] : 0;

            $check = [
                'where' => [
                    'fk_prof_id' => $id,
                ],
                'table' => 'acs_billing',
            ];

            $exist = $this->general->get_data_with_param($check, false);
            if ($exist) {
                if($exist->next_billing_date == null || $exist->next_billing_date == "") {
                    $input_billing['next_billing_date'] = $next_billing_date;
                    $input_billing['next_subscription_billing_date'] = $next_billing_date;                       
                } else {      
                    if(strtotime($exist->next_billing_date) < strtotime(date('Y-m-d'))) {

                        if($input['bill_start_date'] != '' && $input['bill_end_date'] != '') {
                            $bill_start_month = date("m",strtotime($input['bill_start_date']));
                            $bill_start_day   = $input['bill_day'];
                            $bill_start_year  = date("Y",strtotime($input['bill_start_date']));
                            //$next_billing_date  = date('Y-m-d', strtotime($bill_start_year . "-" . $bill_start_month . "-" . $bill_start_day));

                            $input_billing['next_billing_date'] = $next_billing_date;
                            $input_billing['next_subscription_billing_date'] = $next_billing_date;                        
                        }                          

                    } else {
                        $input_billing['next_billing_date'] = $exist->next_billing_date;
                        $input_billing['next_subscription_billing_date'] = $exist->next_subscription_billing_date;
                    }                  
                }
                return $this->general->update_with_key_field($input_billing, $input['customer_id'], 'acs_billing', 'fk_prof_id');
            } else {
                $input_billing['next_billing_date'] = $next_billing_date;
                $input_billing['next_subscription_billing_date'] = $next_billing_date;
                return $this->general->add_($input_billing, 'acs_billing');
            }
        }else{
            return 0;
        }
        
    }

    public function save_contacts($postData, $customerId)
    {
        $payload = [];
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

        $this->db->where('customer_id', $customerId);
        $contacts = $this->db->get('contacts')->result();

        return $contacts;
    }

    public function save_office_information($input, $id)
    {
        $input_office = [];

        // office data
        $input_office['fk_prof_id'] = $id;
        $input_office['welcome_sent'] = 0;
        $input_office['entered_by']   = $input['entered_by'] ? $input['entered_by'] : '';
        $input_office['time_entered'] = $input['time_entered'] ? $input['time_entered'] : '';
        $input_office['sales_date']   = $input['sales_date'] ? $input['sales_date'] : '';
        $input_office['credit_score'] = $input['credit_score'] ? $input['credit_score'] : '';
        $input_office['pay_history']  = $input['pay_history'] ? $input['pay_history'] : '';
        $input_office['fk_sales_rep_office'] = $input['fk_sales_rep_office'];
        $input_office['technician']   = $input['technician'] ? $input['technician'] : '';
        $input_office['install_date'] = $input['install_date'] ? $input['install_date'] : '';
        $input_office['tech_arrive_time'] = $input['tech_arrive_time'] ? $input['tech_arrive_time'] : '';
        $input_office['tech_depart_time'] = $input['tech_depart_time'] ? $input['tech_depart_time'] : '';
        $input_office['lead_source']      = $input['lead_source'] ? $input['lead_source'] : '';
        $input_office['verification']     = $input['verification'] ? $input['verification'] : '';
        $input_office['cancel_date']      = $input['cancel_date'] ? $input['cancel_date'] : '';
        $input_office['cancel_reason']    = $input['cancel_reason'] ? $input['cancel_reason'] : ''; 
        $input_office['collect_date']     = $input['collect_date'] ? $input['collect_date'] : '';
        $input_office['collect_amount']   = $input['collect_amount'] ? $input['collect_amount'] : '';
        $input_office['language']         = $input['language'] ? $input['language'] : '';
        $input_office['pre_install_survey']  = $input['pre_install_survey'] ? $input['pre_install_survey'] : ''; 
        $input_office['post_install_survey'] = $input['post_install_survey'] ? $input['post_install_survey'] : '';
        $input_office['monitoring_waived']   = $input['monitoring_waived'] ? $input['monitoring_waived'] : '';

        if (isset($input['rebate_offer'])) {
            $input_office['rebate_offer'] = $input['rebate_offer'];
        } else {
            $input_office['rebate_offer'] = 0;
        }

        $input_office['rebate_check1']     = $input['rebate_check1'] ? $input['rebate_check1'] : '';
        $input_office['rebate_check1_amt'] = $input['rebate_check1_amt'] ? $input['rebate_check1_amt'] : 0;
        $input_office['rebate_check2']     = $input['rebate_check2'] ? $input['rebate_check2'] : '';
        $input_office['rebate_check2_amt'] = $input['rebate_check2_amt'] ? $input['rebate_check2_amt'] : 0;
        $input_office['activation_fee']    = $input['activation_fee'] ? $input['activation_fee'] : 0;
        $input_office['way_of_pay']        = $input['way_of_pay'] ? $input['way_of_pay'] : '';

        if (isset($input['commision_scheme'])) {
            $input_office['commision_scheme'] = $input['commision_scheme'][0];
        } else {
            $input_office['commision_scheme'] = 2;
        }

        $input_office['rep_comm']           = $input['rep_comm'] ? $input['rep_comm'] : 0;
        $input_office['rep_upfront_pay']    = $input['rep_upfront_pay'] ? $input['rep_upfront_pay'] : 0;
        $input_office['rep_tiered_bonus']   = $input['rep_tiered_bonus'] ? $input['rep_tiered_bonus'] : 0;
        $input_office['rep_holdfund_bonus'] = $input['rep_holdfund_bonus'] ? $input['rep_holdfund_bonus'] : 0;
        $input_office['rep_deduction']      = $input['rep_deduction'] ? $input['rep_deduction'] : 0;
        $input_office['tech_comm']          = $input['tech_comm'] ? $input['tech_comm'] : 0;
        $input_office['tech_upfront_pay']   = $input['tech_upfront_pay'] ? $input['tech_upfront_pay'] : 0;
        $input_office['tech_deduction']     = $input['tech_deduction'] ? $input['tech_deduction'] : 0;
        $input_office['rep_charge_back']    = $input['rep_charge_back'] ? $input['rep_charge_back'] : 0;
        $input_office['rep_payroll_charge_back'] = $input['rep_payroll_charge_back'] ? $input['rep_payroll_charge_back'] : 0;

        if (isset($input['pso'])) {
            $input_office['pso'] = $input['pso'][0];
        } else {
            $input_office['pso'] = 2;
        }

        $input_office['points_include']  = $input['points_include'] ? $input['points_include'] : 0;
        $input_office['price_per_point'] = $input['price_per_point'] ? $input['price_per_point'] : 0;
        $input_office['purchase_price']  = $input['purchase_price'] ? $input['purchase_price'] : 0;
        $input_office['purchase_multiple'] = $input['purchase_multiple'] ? $input['purchase_multiple'] : '';
        $input_office['purchase_discount'] = $input['purchase_discount'] ? $input['purchase_discount'] : 0;
        $input_office['equipment_cost']    = $input['equipment_cost'] ? $input['equipment_cost'] : 0;
        $input_office['labor_cost'] = $input['labor_cost'] ? $input['labor_cost'] : 0;
        $input_office['job_profit'] = $input['job_profit'] ? $input['job_profit'] : 0;
        $input_office['url'] = $input['url'] ? $input['url'] : '';

        $check = [
            'where' => [
                'fk_prof_id' => $id,
            ],
            'table' => 'acs_office',
        ];
        $exist = $this->general->get_data_with_param($check, false);
        if ($exist) {
            return $this->general->update_with_key_field($input_office, $input['customer_id'], 'acs_office', 'fk_prof_id');
        } else {
            return $this->general->add_($input_office, 'acs_office');
        }
    }

    public function save_alarm_information($input, $id)
    {
        $input_alarm = [];

        // alarm data
        $input_alarm['fk_prof_id']   = $id;
        $input_alarm['monitor_comp'] = $input['monitor_comp'] ? $input['monitor_comp'] : '';
        $input_alarm['monitor_id']   = $input['monitor_id'] ? $input['monitor_id'] : 0;
        // $input_alarm['install_date'] = $input['install_date'];
        $input_alarm['acct_type']    = $input['acct_type'] ? $input['acct_type'] : '';
        $input_alarm['online']       = $input['online'] ? $input['online'] : '';
        $input_alarm['in_service']   = $input['in_service'] ? $input['in_service'] : '';
        $input_alarm['equipment']    = $input['equipment'] ? $input['equipment'] : '';
        $input_alarm['collections']  = $input['collections'] ? $input['collections'] : '';
        $input_alarm['credit_score_alarm'] = $input['credit_score_alarm'] ? $input['credit_score_alarm'] : '';
        $input_alarm['passcode']     = $input['passcode'] ? $input['passcode'] : '';
        $input_alarm['install_code'] = $input['install_code'] ? $input['install_code'] : '';
        $input_alarm['mcn'] = $input['mcn'] ? $input['mcn'] : '';
        $input_alarm['scn'] = $input['scn'] ? $input['scn'] : '';
        $input_alarm['panel_type']    = $input['panel_type'] ? $input['panel_type'] : '';
        $input_alarm['system_type']   = $input['system_type'] ? $input['system_type'] : '';
        $input_alarm['warranty_type'] = $input['warranty_type'] ? $input['warranty_type'] : '';
        $input_alarm['dealer']        = $input['dealer'] ? $input['dealer'] : '';
        $input_alarm['alarm_login']   = $input['alarm_login'] ? $input['alarm_login']: '';
        $input_alarm['alarm_customer_id']  = $input['alarm_customer_id'] ? $input['alarm_customer_id'] : 0;
        $input_alarm['alarm_cs_account']   = $input['alarm_cs_account'] ? $input['alarm_cs_account'] : '';
        $input_alarm['comm_type']          = $input['comm_type'] ? $input['comm_type'] : '';
        $input_alarm['account_cost']       = $input['account_cost'] ? $input['account_cost'] : 0;
        $input_alarm['pass_thru_cost']     = $input['pass_thru_cost'] ? $input['pass_thru_cost'] : '';
        $input_alarm['monthly_monitoring'] = $input['monthly_monitoring'] ? $input['monthly_monitoring'] : 0;
        $input_alarm['otps'] = $input['otps'] ? $input['otps'] : 0;        
        $input_alarm['secondary_system_type']     = $input['secondary_system_type'] ? $input['secondary_system_type'] : '';
        $input_alarm['radio_serial_number']     = $input['radio_serial_number'] ? $input['radio_serial_number'] : '';
        $input_alarm['panel_location']     = $input['panel_location'] ? $input['panel_location'] : '';
        $input_alarm['transformer_location']     = $input['transformer_location'] ? $input['transformer_location'] : '';
        $input_alarm['dealer_number']     = $input['dealer_number'] ? $input['dealer_number'] : '';
        $input_alarm['install_type']     = $input['install_type'] ? $input['install_type'] : '';
        $input_alarm['service_provider']     = $input['service_provider'] ? $input['service_provider'] : '';
        $input_alarm['dsl_voip']     = $input['dsl_voip'] ? $input['dsl_voip'] : '';
        $input_alarm['contract_status']     = $input['contract_status'] ? $input['contract_status'] : '';
        $input_alarm['csid_number']     = $input['csid_number'] ? $input['csid_number'] : '';
        $input_alarm['panel_phone_number']     = $input['panel_phone_number'] ? $input['panel_phone_number'] : '';
        $input_alarm['connection_type']     = $input['connection_type'] ? $input['connection_type'] : '';
        $input_alarm['report_format']     = $input['report_format'] ? $input['report_format'] : '';
        $input_alarm['receiver_phone_number']     = $input['receiver_phone_number'] ? $input['receiver_phone_number'] : '';
        $input_alarm['master_code']     = $input['master_code'] ? $input['master_code'] : '';
        $input_alarm['site_type']     = $input['site_type'] ? $input['site_type'] : '';
        $input_alarm['addon_feature_cost'] = $input['addon_feature_cost'] ? $input['addon_feature_cost'] : '0';

        $check = [
            'where' => [
                'fk_prof_id' => $id,
            ],
            'table' => 'acs_alarm',
        ];
        $exist = $this->general->get_data_with_param($check, false);
        if ($exist) {
            return $this->general->update_with_key_field($input_alarm, $input['customer_id'], 'acs_alarm', 'fk_prof_id');
        } else {
            return $this->general->add_($input_alarm, 'acs_alarm');
        }
    }

    public function save_access_information($input, $id)
    {
        $input_access = [];
        // access data
        $input_access['fk_prof_id'] = $id;
        if (isset($input['portal_status'])) {
            $input_access['portal_status'] = $input['portal_status'];
        } else {
            $input_access['portal_status'] = 2;
        }

        $input_access['reset_password'] = '';
        $input_access['access_login'] = $input['access_login'];
        $input_access['access_password'] = $input['access_password'];
        $check = [
            'where' => [
                'fk_prof_id' => $id,
            ],
            'table' => 'acs_access',
        ];
        $exist = $this->general->get_data_with_param($check, false);
        if ($exist) {
            return $this->general->update_with_key_field($input_access, $input['customer_id'], 'acs_access', 'fk_prof_id');
        } else {
            return $this->general->add_($input_access, 'acs_access');
        }
    }

    public function save_papers_information($input, $id)
    {
        $input_papers = [];
        $input_papers['customer_id'] = $id;
        $input_papers['rep_paper_date'] = $input['rep_paper_date'];
        $input_papers['tech_paper_date'] = $input['tech_paper_date'];
        $input_papers['scanned_date'] = $input['scanned_date'];
        $input_papers['paperwork'] = $input['paperwork'];
        $input_papers['submitted'] = $input['submitted'];
        $input_papers['funded'] = $input['funded'];
        $input_papers['charged_back'] = $input['charged_back'];
        // $input_papers['paperwork'] = $input['paperwork'];
        $check = [
            'where' => [
                'customer_id' => $id,
            ],
            'table' => 'acs_papers',
        ];
        $exist = $this->general->get_data_with_param($check, false);
        if ($exist) {
            return $this->general->update_with_key_field($input_papers, $input['customer_id'], 'acs_papers', 'customer_id');
        } else {
            return $this->general->add_($input_papers, 'acs_papers');
        }
    }

    public function save_notes($prev_notes_value, $notes, $prof_id)
    {
        $this->load->model('AcsNote_model');
        
        if ((trim($prev_notes_value) != trim($notes)) && trim($notes) != '') {
            $data = [
                'fk_prof_id' => $prof_id,
                'note' => $notes,
                'datetime' => date('Y-m-d h:i A')
            ];
            $this->AcsNote_model->create($data);
        }
    }

    public function add_data_sheet()
    {
        $user_id = logged('id');
        $cid = logged('company_id');
        $input = $this->input->post();

        $fk_prod_id = $input['prof_id'];
        if (empty($fk_prod_id)) {
            $fk_prod_id = $this->customer_ad_model->add($input, 'acs_profile');

            $input_access['fk_prof_id'] = $fk_prod_id;
            $input_office['fk_prof_id'] = $fk_prod_id;
            $input_alarm['fk_prof_id'] = $fk_prod_id;
            $input_billing['fk_prof_id'] = $fk_prod_id;

            $this->customer_ad_model->add($input_access, 'acs_access');
            $this->customer_ad_model->add($input_office, 'acs_office');
            $this->customer_ad_model->add($input_alarm, 'acs_alarm');
            $this->customer_ad_model->add($input_billing, 'acs_billing');
            echo 'Added';
        } else {
            $input_profile['prof_id'] = $fk_prod_id;
            $this->customer_ad_model->update_data($input_profile, 'acs_profile', 'prof_id');

            $input_access['fk_prof_id'] = $fk_prod_id;
            $input_office['fk_prof_id'] = $fk_prod_id;
            $input_alarm['fk_prof_id'] = $fk_prod_id;
            $input_billing['fk_prof_id'] = $fk_prod_id;

            $this->customer_ad_model->update_data($input_access, 'acs_access', 'fk_prof_id');
            $this->customer_ad_model->update_data($input_office, 'acs_office', 'fk_prof_id');
            $this->customer_ad_model->update_data($input_alarm, 'acs_alarm', 'fk_prof_id');
            $this->customer_ad_model->update_data($input_billing, 'acs_billing', 'fk_prof_id');

            if (isset($input['device_name'])) {
                $devices = count($input['device_name']);
                for ($xx = 0; $xx < $devices; ++$xx) {
                    $device_data = [];
                    $device_data['fk_prof_id'] = $fk_prod_id;
                    $device_data['device_name'] = $input['device_name'][$xx];
                    $device_data['sold_by'] = $input['sold_by'][$xx];
                    $device_data['device_points'] = $input['device_points'][$xx];
                    $device_data['retail_cost'] = $input['retail_cost'][$xx];
                    $device_data['purch_price'] = $input['purch_price'][$xx];
                    $device_data['device_qty'] = $input['device_qty'][$xx];
                    $device_data['total_points'] = $input['total_points'][$xx];
                    $device_data['total_cost'] = $input['total_cost'][$xx];
                    $device_data['total_purch_price'] = $input['total_purch_price'][$xx];
                    $device_data['device_net'] = $input['device_net'][$xx];
                    $this->customer_ad_model->add($device_data, 'acs_devices');
                    unset($device_data);
                }
            }
            echo 'Updated';
        }
    }

    public function remove_customer()
    {
        $input = [];
        $input['field_name'] = 'prof_id';
        $input['id'] = $_POST['prof_id'];
        $input['tablename'] = 'acs_profile';
        $modules = ['acs_access', 'acs_office', 'acs_alarm', 'acs_billing'];
        if ($this->customer_ad_model->delete($input)) {
            for ($x = 0; $x < count($modules); ++$x) {
                $input_mod = [];
                $input_mod['field_name'] = 'fk_prof_id';
                $input_mod['id'] = $_POST['prof_id'];
                $input_mod['tablename'] = $modules[$x];
                $this->customer_ad_model->delete($input_mod);
            }
            echo 'Done';
        }
    }

    public function remove_lead()
    {
        $input = [];
        $input['field_name'] = 'leads_id';
        $input['id'] = $_POST['lead_id'];
        $input['tablename'] = 'ac_leads';

        $lead = $this->customer_ad_model->get_data_by_id('leads_id', $_POST['lead_id'], 'ac_leads');
        if( $lead ){
            $this->customer_ad_model->delete($input);

            //Activity Logs
            $activity_name = 'Leads : Deleted lead ' . $lead->firstname . ' ' . $lead->lastname; 
            createActivityLog($activity_name);
            
            echo 'Done';
        }
    }

    public function remove_devices()
    {
        $input = [];
        $input['field_name'] = 'dev_id';
        $input['id'] = $_POST['id'];
        $input['tablename'] = 'acs_devices';
        $this->customer_ad_model->delete($input);
        echo 'Done';
    }

    public function remove_task()
    {
        $input = [];
        $input['field_name'] = 'task_id';
        $input['id'] = $_POST['id'];
        $input['tablename'] = 'acs_tasks';
        $this->customer_ad_model->delete($input);
        echo 'Done';
    }

    public function update_custom_fields()
    {
        $input = $this->input->post();
        $file_array = [];
        // print_r($input);
        for ($x = 0; $x < count($input['fieldname']); ++$x) {
            $file_array[$x]['field_name'] = $input['fieldname'][$x];
            $file_array[$x]['field_value'] = $input['fieldvalue'][$x];
        }
        unset($input['fieldname']);
        unset($input['fieldvalue']);
        $input['custom_fields'] = json_encode($file_array);
        if ($this->customer_ad_model->update_data($input, 'acs_profile', 'prof_id')) {
            echo 'Success';
        } else {
            echo 'Done';
        }
    }

    public function import_customer()
    {
        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'import',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];
        $importSettings = $this->general->get_data_with_param($get_company_settings, false);
        if( $importSettings->value == '' ){
            $importSettings->value = '1,2,5,6,7,8,9,10,12,13,14,15,16,61';
        }

        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];

        $this->page_data['importFieldsList'] = $this->general->get_data_with_param($getImportFields);
        $this->page_data['import_settings'] = $importSettings;
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['page']->title = 'Customer Import';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/import', $this->page_data);
    }

    public function add_lead($lead_id = null)
    {
        // $this->hasAccessModule(9);
        $this->hasAccessModule(43);

        if(!checkRoleCanAccessModule('leads', 'write')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'New Lead Form';

        if (isset($lead_id)) {
            $this->page_data['leads_data'] = $this->customer_ad_model->get_data_by_id('leads_id', $lead_id, 'ac_leads');
        }
        $leadId = $this->page_data['leads_data']->fk_sa_id;

        $input = $this->input->post();
        $convert_lead = $this->input->post('convert_customer');
        if (isset($convert_lead)) {
            if (!isset($input['leads_id'])) {
                unset($input['credit_report']);
                unset($input['report_history']);
                unset($input['convert_customer']);
                $this->customer_ad_model->add($input, 'ac_leads');
            }

            $input_profile = [];
            $input_profile['fk_user_id'] = logged('id');
            // $input_profile['fk_sa_id'] = $input['fk_sa_id'];
            $input_profile['first_name'] = $input['firstname'];
            $input_profile['middle_name'] = strtoupper($input['middle_initial']);
            $input_profile['last_name'] = $input['lastname'];
            $input_profile['suffix'] = $input['suffix'];
            $input_profile['country'] = $input['country'];
            $input_profile['zip_code'] = $input['zip'];
            $input_profile['state'] = $input['state'];
            $input_profile['city'] = $input['city'];
            $input_profile['email'] = $input['email_add'];

            $profile_id = $this->customer_ad_model->add($input_profile, 'acs_profile');

            if (isset($profile_id)) {
                redirect(base_url('customer/add_advance/'.$profile_id));
            }
        } else {
            if ($input) {
                unset($input['credit_report']);
                unset($input['report_history']);
                print_r($input);

                if (isset($input['leads_id'])) {
                    if ($this->customer_ad_model->update_data($input, 'ac_leads', 'leads_id')) {
                        redirect(base_url('customer/leads'));
                    } else {
                        echo 'Error';
                    }
                }
            } else {
                $user_id = logged('id');
                $cid = logged('company_id');
                $this->page_data['company_id'] = $cid;
                $this->page_data['plans'] = '';
                $this->page_data['users'] = $this->users_model->getUsers();
                $this->page_data['lead_types']  = $this->customer_ad_model->getAllSettingsLeadTypesByCompanyId($cid);
                $this->page_data['sales_area']  = $this->customer_ad_model->getAllSettingsSalesAreaByCompanyId($cid);
                $this->page_data['page']->title = 'Leads Manager List';
                $this->load->view('customer/add_lead', $this->page_data);
            }
        }
    }

    public function save_new_lead()
    {
        $input      = $this->input->post();
        $uid        = logged('id');
        $company_id = logged('company_id');

        $is_automation_activated  = enableAutomationActivated();

        if ($input) {
            unset($input['credit_report']);
            unset($input['report_history']);
            $input['country'] = ucwords($input['country']);
            $input['state'] = ucwords($input['state']);
            $input['city'] = ucwords($input['city']);
            $input['address'] = ucwords($input['address']);
            $input['phone_home'] = formatPhoneNumber($input['phone_home']);
            $input['phone_cell'] = formatPhoneNumber($input['phone_cell']);
            if ($input['leads_id'] != null) {
                if ($this->customer_ad_model->update_data($input, 'ac_leads', 'leads_id')) {
                    //Activity Logs
                    $activity_name = 'Leads : Updated lead ' . $input['firstname'] . ' ' . $input['lastname']; 
                    createActivityLog($activity_name);

                    // SMS Notification
                    createCronAutoSmsNotification($company_id, $input['leads_id'], 'lead', $input['status'], $uid, $input['fk_assign_id']);

                    //Add automation queue - start
                    if($is_automation_activated) {
                        createAutomationQueueV2('send_email', 'lead', 'has_status', $input['status'], $input['leads_id']);
                    }
                    //Add automation queue - end

                    echo 'Saved';
                } else {
                    echo 'Error';
                }
            } else {
            
                $input['company_id'] = logged('company_id');
                if ($lastid = $this->customer_ad_model->add($input, 'ac_leads')) {
                    //Activity Logs
                    $activity_name = 'Leads : Created new lead ' . $input['firstname'] . ' ' . $input['lastname']; 
                    createActivityLog($activity_name);

                    // SMS Notification
                    createCronAutoSmsNotification($company_id, $lastid, 'lead', $input['status'], $uid, $input['fk_assign_id']);

                    //Add automation queue - start
                    if($is_automation_activated) {
                        createAutomationQueueV2('send_email', 'lead', 'created', '', $lastid);  
                        createAutomationQueueV2('send_email', 'lead', 'has_status', $input['status'], $lastid);
                    }
                    //Add automation queue - end

                    echo 'Saved';
                } else {
                    echo 'Error';
                }
            }
        }
    }

    public function convert_to_customer()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $input = $this->input->post();
        if ($input) {
            $customer_data = [
                'company_id' => logged('company_id'),
                'fk_user_id' => logged('id'),
                'fk_sa_id' => $input['fk_sa_id'],
                'contact_name' => '',
                'status' => 'New',
                'customer_type' => 'Residential',
                'first_name' => $input['firstname'],
                'middle_name' => $input['middle_initial'],
                'last_name' => $input['lastname'],
                'suffix' => $input['suffix'],
                'mail_add' => $input['address'],
                'city' => $input['city'],
                'state' => $input['state'],
                'zip_code' => $input['zip'],
                'country' => $input['country'],
                'county' => $input['county'],
                'date_of_birth' => date('m/d/Y', strtotime($input['date_of_birth'])),
                'email' => $input['email_add'],
                'ssn' => $input['sss_num'],
                'phone_h' => $input['phone_home'],
                'phone_m' => $input['phone_cell'],
            ];
            if ($lastid = $this->customer_ad_model->add($customer_data, 'acs_profile')) {
                $customerOfficePayload = [
                    'fk_prof_id' => $lastid,
                    'sales_date' => date('m/d/Y'),
                    'fk_sales_rep_office' => $input['fk_sr_id'],
                ];
                $this->customer_ad_model->add($customerOfficePayload, 'acs_office');

                $lead = $this->customer_ad_model->get_data_by_id('leads_id', $this->input->post('leads_id'), 'ac_leads');
                // SMS Notification
                createCronAutoSmsNotification(logged('company_id'), $lead->leads_id, 'lead', 'Converted', 0, $lead->fk_assign_id);

                $is_success = 1;
            } else {
                $msg = 'Required field is missing. Cannot convert to customer.';
            }
        }

        $json = ['is_success' => $is_success, 'msg' => $msg, 'last_id' => $lastid];
        echo json_encode($json);
    }

    public function add_audit_import_ajax()
    {
        $input = $this->input->post();
        // customer_ad_model
        if (empty($input['ai_id'])) {
            unset($input['ai_id']);
            if ($this->customer_ad_model->add($input, 'acs_audit_import')) {
                echo 'Success';
            } else {
                echo 'Error';
            }
        } else {
            if ($this->customer_ad_model->update_data($input, 'acs_audit_import', 'ai_id')) {
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    public function add_new_customer_from_jobs()
    {
        $input = $this->input->post();
        // customer_ad_model
        if ($input) {
            $input['company_id'] = logged('company_id');
            $input['status'] = 'New';
            if ($this->customer_ad_model->add($input, 'acs_profile')) {
                //Activity Logs
                $activity_name = 'Created customer record - ' . $input['first_name'] . ' ' . $input['last_name']; 
                createActivityLog($activity_name);

                echo 'Success';
            } else {
                echo 'Error';
            }
        }
    }

    public function ajax_quick_save_customer_v2()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('AcsBilling_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $uid  = logged('id');
        $cid  = logged('company_id');
        
        $isNameExists = $this->AcsProfile_model->getByCustomerNameAndCompanyId($post['first_name'], $post['last_name'], $cid);
        if( $isNameExists ){
            $msg = 'Customer name ' . $customer_name . ' already exists';
        }else{
            $data = [
                'fk_user_id' => $uid,
                'company_id' => $cid,
                'first_name' => $post['first_name'],
                'middle_name' => $post['middle_name'],
                'last_name' => $post['last_name'],
                'customer_type' => $post['customer_type'],
                'email' => $post['email'],
                'ssn' => $post['ssn'],
                'status' => $post['status'],
                'business_name' => $post['customer_type'] == 'Commercial' ? $post['customer_type'] : '',
                'phone_m' => formatPhoneNumber($post['phone_m']),
                'phone_h' => formatPhoneNumber($post['phone_h']),
                'mail_add' => $post['mail_add'],
                'city' => $post['city'],
                'state' => $post['state'],
                'zip_code' => $post['zip_code'],
            ];
    
            $prof_id = $this->AcsProfile_model->saveData($data);

            $customer_name = $post['first_name'] . ' ' . $post['last_name'];
            $activity_name = 'Customer : Created customer ' . $customer_name; 
            createActivityLog($activity_name);

            if( $post['customer_add_emergency_contacts_information'] ){
                $saveToPayload = function ($index) use (&$payload, $post, $prof_id) {
                    if (empty(trim($post['contact_first_name'.$index]))) {
                        return; 
                    }
        
                    $name = trim($post['contact_first_name'.$index]) . ' ' . trim($post['contact_last_name'.$index]);
                    array_push($payload, [
                        'first_name' => trim($post['contact_first_name'.$index]),
                        'last_name' => trim($post['contact_last_name'.$index]),
                        'relation' => $post['contact_relationship'.$index],
                        'phone' => $post['contact_phone'.$index],
                        'customer_id' => $prof_id,
                        'phone_type' => 'mobile',
                        'name' => $name
                    ]);
                };
        
                $saveToPayload(1);
                $saveToPayload(2);
                $saveToPayload(3);

                if (!empty($payload)) {
                    $this->db->insert_batch('contacts', $payload);

                    $activity_name = 'Customer : Created customer emergency contacts data for ' . $customer_name; 
                    createActivityLog($activity_name);
                }
        
            }
    
            if( $post['customer_add_billing_information'] ){
                $ratePlan = $this->RatePlan_model->getByAmountAndCompanyId($post['mmr'], $cid);
    
                switch ($post['bill_freq']) {
                    case 'One Time Only':
                        $billing_frequency = 1;
                        break;
                    case 'Every 1 Month':
                        $billing_frequency = 1;
                        break;
                    case 'Every 3 Months':
                        $billing_frequency = 3;
                        break;
                    case 'Every 6 Months':
                        $billing_frequency = 6;
                        break;
                    case 'Every 1 Year':
                        $billing_frequency = 12;
                        break;
                    default:
                        $billing_frequency = 0;
                        break;
                }
    
                $data_billing['fk_prof_id'] = $prof_id;
                $data_billing['ac_rate_plan_id'] = $ratePlan->id;
                $data_billing['card_fname'] = $post['card_fname'];
                $data_billing['card_lname'] = $post['card_lname'];
                $data_billing['card_address'] = $post['card_address'];
                $data_billing['city'] = $post['billing_city'];
                $data_billing['state'] = $post['billing_state'];
                $data_billing['zip'] = $post['billing_zip'];
                $data_billing['equipment'] = $post['equipment'];
                $data_billing['initial_dep'] = $post['initial_dep'];
                $data_billing['mmr'] = $ratePlan->amount;
                $data_billing['bill_freq'] = $post['bill_freq'];
                $data_billing['bill_day'] = $post['bill_day'];
                $data_billing['contract_term'] = $post['contract_term'];
                $data_billing['bill_start_date'] = date("Y-m-d",strtotime($post['bill_start_date']));
                $data_billing['bill_end_date'] = date("Y-m-d",strtotime($post['bill_end_date']));
                $data_billing['late_fee'] = $post['late_fee'];
                $data_billing['payment_fee'] = $post['payment_fee'];
                $data_billing['billing_frequency'] = $billing_frequency;
                $data_billing['next_billing_date'] = date('n/j/Y', strtotime('+'.$billing_frequency.' months', strtotime($post['bill_start_date'])));
    
                $exist = $this->AcsBilling_model->getByProfId($prof_id);
                if ($exist) {
                    $this->AcsBilling_model->updateRecord($exist->bill_id, $data_billing);

                    $activity_name = 'Customer : Updated customer billing record for ' . $customer_name; 
                    createActivityLog($activity_name);
    
                } else {
                    $this->AcsBilling_model->saveData($data_billing);

                    $activity_name = 'Customer : Created customer billing data for ' . $customer_name; 
                    createActivityLog($activity_name);
                }
            }
    
            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,            
            'customer_id' => $prof_id,
            'customer_name' => $customer_name
        ];

        echo json_encode($return);
    }

    public function ajax_quick_save_customer()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $input = $this->input->post();
        $input['company_id'] = logged('company_id');
        $input['status']     = 'New';

        $customer_id   = $this->customer_ad_model->add($input, 'acs_profile');
        $customer_name = $input['first_name'] . ' ' . $input['last_name'];
        $activity_name = 'Customer : Created customer ' . $customer_name; 
        createActivityLog($activity_name);

        $is_success = 1;
        $msg = '';

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'customer_id' => $customer_id,
            'customer_name' => $customer_name
        ];

        echo json_encode($return);
    }

    public function add_furnisher_ajax()
    {
        $input = $this->input->post();
        // customer_ad_model
        if ($this->customer_ad_model->add($input, 'acs_furnisher')) {
            echo 'Success';
        } else {
            echo 'Error';
        }
        //        else{
        //            if($this->customer_ad_model->update_data($input,"acs_audit_import","ai_id")){
        //                echo "Updated";
        //            }else{
        //                echo "Error";
        //            }
        //        }
    }

    public function add_reasons_ajax()
    {
        $input = $this->input->post();
        if ($this->customer_ad_model->add($input, 'acs_reasons')) {
            echo 'Success';
        } else {
            echo 'Error';
        }
    }

    public function fetch_reasons_data()
    {
        $reasons = $this->customer_ad_model->get_all(1, '', 'DESC', 'acs_reasons', 'reason_id');
        echo json_encode($reasons);
    }

    public function fetch_all_reasons_data()
    {
        $reasons = $this->customer_ad_model->get_all(false, '', 'ASC', 'acs_reasons', 'reason_id');
        echo json_encode($reasons);
    }

    public function delete_reason()
    {
        $input = [];
        $input['field_name'] = 'reason_id';
        $input['id'] = $_POST['reason_id'];
        $input['tablename'] = 'acs_reasons';
        if ($this->customer_ad_model->delete($input)) {
            echo 'Done';
        }
    }

    public function add_task_ajax()
    {
        $input = $this->input->post();
        if (empty($input['task_id'])) {
            unset($input['task_id']);
            if ($this->customer_ad_model->add($input, 'acs_tasks')) {
                echo 'Success';
            } else {
                echo 'Error';
            }
        } else {
            if ($this->customer_ad_model->update_data($input, 'acs_tasks', 'task_id')) {
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    // for addling of Lead Type (ac_leadtypes table)
    public function add_leadtype_ajax()
    {
        $input = $this->input->post();
        // customer_ad_model
        if (empty($input['lead_id'])) {
            unset($input['lead_id']);
            $input['company_id'] = logged('company_id');
            if ($this->customer_ad_model->add($input, 'ac_leadtypes')) {
                //Activity Logs
                $activity_name = 'Created Lead Type : ' . $input['lead_name']; 
                createActivityLog($activity_name);

                echo 'Success';
            } else {
                echo 'Error';
            }
        } else {
            if ($this->customer_ad_model->update_data($input, 'ac_leadtypes', 'lead_id')) {
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    public function update_lead_type_ajax()
    {
        $input = $this->input->post();
        $data = ['lead_id' => $input['lead_id'], 'lead_name' => $input['lead_name']];
        if ($this->customer_ad_model->update_data($data, 'ac_leadtypes', 'lead_id')) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_rate_plan_ajax()
    {
        $input = $this->input->post();
        // customer_ad_model
        if (empty($input['id'])) {
            unset($input['id']);
            $input['company_id'] = logged('company_id');
            if ($this->customer_ad_model->add($input, 'ac_rateplan')) {

                //Activity Logs
                $activity_name = 'Created Rate Plan : ' . $input['plan_name']; 
                createActivityLog($activity_name);

                echo 1;
            } else {
                echo 0;
            }
        } else {
            if ($this->customer_ad_model->update_data($input, 'ac_rateplan', 'id')) {
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    public function update_rate_plan_ajax()
    {
        $input = $this->input->post();
        $data = ['id' => $input['rate-plan-id'], 'amount' => $input['amount'], 'plan_name' => $input['plan_name']];
        if ($this->customer_ad_model->update_data($data, 'ac_rateplan', 'id')) {

            //Activity Logs
            $activity_name = 'Updated Rate Plan : ' . $input['plan_name']; 
            createActivityLog($activity_name);

            echo 1;
        } else {
            echo 0;
        }
    }

    public function customer_settings_ajax_process()
    {
        $input = $this->input->post();
        // customer_ad_model
        if (empty($input['id'])) {
            unset($input['id']);
            if ($this->customer_ad_model->add($input, 'acs_cust_status')) {
                echo true;
            } else {
                echo 'Error';
            }
        } else {
            if ($this->customer_ad_model->update_data($input, 'acs_cust_status', 'id')) {
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    public function customer_settings_delete()
    {
        $deletion_query = [
            'where' => [
                'id' => $_POST['id'],
            ],
            'table' => 'acs_cust_status',
        ];
        if ($this->general->delete_($deletion_query)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_salesarea_ajax()
    {
        $input = $this->input->post();
        // customer_ad_model
        if (empty($input['sa_id'])) {
            unset($input['sa_id']);
            $input['fk_comp_id'] = logged('company_id');
            if ($this->customer_ad_model->add($input, 'ac_salesarea')) {
                //Activity Logs
                $activity_name = 'Created New Sales Area : ' . $input['sa_name']; 
                createActivityLog($activity_name);

                echo 'Sales Area Added!';
            } else {
                echo 'Error';
            }
        } else {
            if ($this->customer_ad_model->update_data($input, 'ac_salesarea', 'sa_id')) {
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    public function update_sales_area_ajax()
    {
        $input = $this->input->post();
        $data = ['sa_id' => $input['sa_id'], 'sa_name' => $input['sa_name']];
        if ($this->customer_ad_model->update_data($data, 'ac_salesarea', 'sa_id')) {
            //Activity Logs
            $activity_name = 'Updated Sales Area : ' . $input['sa_name']; 
            createActivityLog($activity_name);

            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_leadsource_ajax()
    {
        if(!checkRoleCanAccessModule('customer-settings', 'write')){
            show403Error();
            return false;
        }

        $is_success = 1;
        $msg = '';

        $cid = logged('company_id');
        $input = $this->input->post();

        $isNameExists = $this->customer_ad_model->getLeadSourceByNameAndCompanyId(trim($input['ls_name']), $cid);
        if( $isNameExists ){
            $is_success = 0;
            $msg = 'Lead source ' . $input['ls_name'] . ' already exists.';
        }

        if( $is_success == 1 ){
            // customer_ad_model
            if (empty($input['ls_id'])) {
                unset($input['ls_id']);
                $input['fk_company_id'] = $cid;
                $result = $this->customer_ad_model->add($input, 'ac_leadsource');

                //Activity Logs
                $activity_name = 'Created Lead Source : ' . $input['ls_name']; 
                createActivityLog($activity_name);
                
            } 
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function update_leadsource_ajax()
    {
        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 1;
        $msg = '';

        $cid = logged('company_id');
        $input = $this->input->post();

        $isNameExists = $this->customer_ad_model->getLeadSourceByNameAndCompanyId(trim($input['ls_name']), $cid);        
        if( $isNameExists && ($isNameExists->ls_id !=  $input['ls_id']) ){
            $is_success = 0;
            $msg = 'Lead source ' . $input['ls_name'] . ' already exists.';
        }

        $isDefaultExists = $this->customer_ad_model->getDEfaultLeadSourceByName(trim($input['ls_name']));
        if( $isDefaultExists ){
            $is_success = 0;
            $msg = 'Lead source ' . $input['ls_name'] . ' already exists.';
        }

        if( $is_success == 1 ){
            $data = ['ls_id' => $input['ls_id'], 'ls_name' => $input['ls_name']];
            $this->customer_ad_model->update_data($data, 'ac_leadsource', 'ls_id');

            //Activity Logs
            $activity_name = 'Updated Lead Source : ' . $input['ls_name']; 
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function add_activation_fee_ajax()
    {
        $input = $this->input->post();
        // customer_ad_model
        if (empty($input['id'])) {            
            unset($input['id']);
            $input['company_id'] = logged('company_id');
            if ($this->customer_ad_model->add($input, 'ac_activationfee')) {

                //Activity Logs
                $activity_name = 'Added Activation Fee : ' . $input['amount']; 
                createActivityLog($activity_name);

                echo 1;
            } else {
                echo 0;
            }
        } else {
            $activationFee = $this->customer_ad_model->getActivationFeeById($input['id']);
            if ($this->customer_ad_model->update_data($input, 'ac_activationfee', 'id')) {
                //Activity Logs
                $activity_name = 'Changed Activation Fee from ' . $activationFee->amount . ' to ' . $input['amount']; 
                createActivityLog($activity_name);
                
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    public function update_activation_fee_ajax()
    {
        $input = $this->input->post();
        $data = ['id' => $input['id'], 'amount' => $input['amount']];

        $activationFee = $this->customer_ad_model->getActivationFeeById($input['id']);
        if ($this->customer_ad_model->update_data($data, 'ac_activationfee', 'id')) {

            //Activity Logs
            $activity_name = 'Changed Activation Fee from ' . number_format($activationFee->amount,2,'.','') . ' to ' . number_format($input['amount'],2,'.',''); 
            createActivityLog($activity_name);

            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_spt_ajax()
    {
        $input = $this->input->post();
        // customer_ad_model
        if (empty($input['id'])) {
            unset($input['id']);
            $input['company_id'] = logged('company_id');
            if ($this->customer_ad_model->add($input, 'ac_system_package_type')) {
                //Activity Logs
                $activity_name = 'Created System Package : ' . $input['name']; 
                createActivityLog($activity_name);

                echo 1;
            } else {
                echo 0;
            }
        } else {
            if ($this->customer_ad_model->update_data($input, 'ac_system_package_type', 'id')) {
                echo 'Updated';
            } else {
                echo 'Error';
            }
        }
    }

    public function update_spt_ajax()
    {
        $input = $this->input->post();
        $data = ['id' => $input['id'], 'name' => $input['name']];

        $packageType = $this->customer_ad_model->getPackageTypeById($input['id']);
        if ($this->customer_ad_model->update_data($data, 'ac_system_package_type', 'id')) {
            //Activity Logs
            $activity_name = 'Updated System Package : ' . $packageType->name; 
            createActivityLog($activity_name);

            echo 1;
        } else {
            echo 0;
        }
    }

    public function update_customer_profile()
    {
        $this->load->model('CustomerInternalNotes_model');

        $input = [];
        $input['notes'] = $_POST['notes'];
        $input['prof_id'] = $_POST['id'];
        if ($this->customer_ad_model->update_data($input, 'acs_profile', 'prof_id')) {
            // Insert to internal notes
            if (trim($input['notes']) != '' && $input['notes'] != $_POST['memo_note']) {
                $data_memo = [
                    'prof_id' => $input['prof_id'],
                    'user_id' => logged('id'),
                    'note_date' => date('Y-m-d'),
                    'notes' => trim($input['notes']),
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s'),
                ];

                $this->CustomerInternalNotes_model->create($data_memo);
            }
            echo 'Success';
        } else {
            echo 'Error';
        }
    }

    public function fetch_leadtype_data()
    {
        $lead_types = $this->customer_ad_model->get_all(false, '', 'DESC', 'ac_leadtypes', 'lead_id');
        echo json_encode($lead_types);
    }

    public function fetch_leadsource_data()
    {
        $lead_source = $this->customer_ad_model->get_all(false, '', 'DESC', 'ac_leadsource', 'ls_id');
        echo json_encode($lead_source);
    }

    public function fetch_salesarea_data()
    {
        $lead_types = $this->customer_ad_model->get_all(false, '', 'DESC', 'ac_salesarea', 'sa_id');
        echo json_encode($lead_types);
    }

    public function delete_data()
    {
        $tbl = $_POST['table'];
        $input = [];
        switch ($tbl) {
            case 'sa':
                $input['field_name'] = 'sa_id';
                $input['id'] = $_POST['id'];
                $input['tablename'] = 'ac_salesarea';
                break;
            case 'lt':
                $input['field_name'] = 'lead_id';
                $input['id'] = $_POST['id'];
                $input['tablename'] = 'ac_leadtypes';
                break;
            case 'ls':
                $input['field_name'] = 'ls_id';
                $input['id'] = $_POST['id'];
                $input['tablename'] = 'ac_leadsource';
                break;
            default:
        }
        if ($this->customer_ad_model->delete($input)) {
            echo 'nice';
        }
    }

    public function ajax_delete_sales_area()
    {
        $this->load->model('SalesArea_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');
        $salesArea = $this->SalesArea_model->getByIdAndCompanyId($post['id'], $cid);
        if( $salesArea ){
            $name = $salesArea->sa_name;
            $this->SalesArea_model->deleteSalesArea($post['id']);
            
            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Sales Area : Deleted sales area ' . $name; 
            createActivityLog($activity_name);

        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function delete_lead_source()
    {
        $this->load->model('LeadSource_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        $leadSource = $this->LeadSource_model->getByIdAndCompanyId($post['id'], $cid);
        if( $leadSource ){
            $name = $leadSource->ls_name;
            $this->LeadSource_model->deleteById($post['id']);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Lead Source : Deleted lead source ' . $name; 
            createActivityLog($activity_name);
            
        } 
        
        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_lead_type()
    {
        $this->load->model('LeadType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        $leadType = $this->LeadType_model->getByIdAndCompanyId($post['ltid'], $cid);
        if( $leadType ){
            $name = $leadType->lead_name;
            $this->LeadType_model->deleteById($leadType->lead_id);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Lead Type : Deleted lead type ' . $name; 
            createActivityLog($activity_name);
            
        } 
        
        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function delete_lead_type()
    {
        $deletion_query = [
            'where' => [
                'lead_id' => $_POST['id'],
            ],
            'table' => 'ac_leadtypes',
        ];
        if ($this->general->delete_($deletion_query)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function ajax_delete_rate_plan()
    {
        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');

        $ratePlan = $this->RatePlan_model->getByIdAndCompanyId($post['id'], $cid);
        if( $ratePlan ){
            $name = $ratePlan->plan_name;
            $this->RatePlan_model->delete($post['id']);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Rate Plan : Deleted ' . $name; 
            createActivityLog($activity_name);
            
        } 
        
        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function delete_rate_plan()
    {
        $deletion_query = [
            'where' => [
                'id' => $_POST['id'],
            ],
            'table' => 'ac_rateplan',
        ];

        $ratePlan = $this->customer_ad_model->getRatePlanById($_POST['id']);
        if ($this->general->delete_($deletion_query)) {
            //Activity Logs
            $activity_name = 'Deleted Rate Plan : ' . $ratePlan->plan_name; 
            createActivityLog($activity_name);

            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete_activation_fee()
    {
        $deletion_query = [
            'where' => [
                'id' => $_POST['id'],
            ],
            'table' => 'ac_activationfee',
        ];
    
        $activationFee = $this->customer_ad_model->getActivationFeeById($_POST['id']);
        if ($this->general->delete_($deletion_query)) {
    
            //Activity Logs
            $activity_name = 'Deleted Activation Fee amounting of ' . number_format($activationFee->amount,2,'.',''); 
            createActivityLog($activity_name);
    
            echo 1;
        } else {
            echo 0;
        }
    }

    public function delete_spt()
    {
        $deletion_query = [
            'where' => [
                'id' => $_POST['id'],
            ],
            'table' => 'ac_system_package_type',
        ];

        $packageType = $this->customer_ad_model->getPackageTypeById($_POST['id']);
        if ($this->general->delete_($deletion_query)) {
            //Activity Logs
            $activity_name = 'Deleted Package Type ' . $packageType->name; 
            createActivityLog($activity_name);

            echo 1;
        } else {
            echo 0;
        }
    }

    public function send_qr2($id = null)
    {
        $info = $this->customer_ad_model->get_data_by_id('prof_id', $id, 'acs_profile');
        $to = $info->email;
        $this->load->library('email');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'nsmartrac@gmail.com',
            'smtp_pass' => 'nSmarTrac2020',
            'mailtype' => 'html',
            'charset' => 'utf-8',
        ];
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@nsmartrac.com', 'nSmarTrac');
        $this->email->to($to);
        $this->email->subject('QR Details');
        $this->email->message('This is customer QR.');
        $this->email->attach($_SERVER['DOCUMENT_ROOT'].'/assets/img/customer/qr/'.$id.'.png');

        if ($this->email->send()) {
            echo json_encode('Congratulation Email Sent Successfully.');
        } else {
            echo json_encode($this->email->send());
        }
    }

    public function send_qr()
    {
        $id = $_POST['custId'];

        $customer = $this->customer_ad_model->get_data_by_id('prof_id', $id, 'acs_profile');
        // Email Sending
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $recipient = 'welyelfhisula@gmail.com';
        $subject = 'nSmarTrac : Customer QR';
        $this->page_data['customer_id'] = $id.'.png';

        $params = [];
        $params['customer_id'] = ['id' => $id, 'firstname' => $customer->first_name, 'lastname' => $customer->last_name];

        include APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
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
        $mail->Body = 'This is customer QR.';
        // $mail->addAttachment($attachment);

        $content = $this->load->view('customer/email_template/customer_qr_template', $params, true);

        $mail->MsgHTML($content);
        $mail->addAddress($recipient);
        if ($mail->send()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        $mail->ClearAllRecipients();
    }

    public function send_welcome_email()
    {
        $payload = json_decode(file_get_contents('php://input'), true);
        ['customer_email' => $customerEmail, 'letter_id' => $letterId] = $payload;

        // Email Sending
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $recipient = $customerEmail;
        $subject = 'Welcome to nSmaTrac';

        $params = [];

        include APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
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
        $mail->Body = 'Welcome to nSmaTrac';
        // $mail->addAttachment($attachment);

        // $content = $this->load->view('customer/email_template/customer_qr_template', $params, true);
        $content = '<h1>Welcome to nSmarTrac!</h1>';

        $mail->MsgHTML($content);
        $mail->addAddress($recipient);
        if ($mail->send()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
        $mail->ClearAllRecipients();
    }

    public function get_customer_import_header()
    {
        addJSONResponseHeader();

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csv = array_map('str_getcsv', file($_FILES['file']['tmp_name'], FILE_SKIP_EMPTY_LINES));
            $csvHeader = array_shift($csv);
            if (!empty($csvHeader)) {
                $data_arr = ['success' => true, 'data' => $csvHeader];
            } else {
                $data_arr = ['success' => false, 'message' => 'Unable to fetch CSV headers.'];
            }
        }
        exit(json_encode($data_arr));
    }

    public function getImportData()
    {
        addJSONResponseHeader();

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $csv = array_map('str_getcsv', file($_FILES['file']['tmp_name'], FILE_SKIP_EMPTY_LINES));
            $csvHeader = array_shift($csv);

            $this->load->library('CSVReader');
            $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

            $customerArray = []; // initialize array for storing import data

            if (!empty($csvData)) {
                foreach ($csvData as $row) {
                    $customerElement = [];
                    for ($x = 0; $x < count($csvHeader); ++$x) {
                        $trimmedData = str_replace(')', '', str_replace('(', '', str_replace('Phone:', '', str_replace('$', '', $row[$csvHeader[$x]]))));
                        // $data = preg_replace('/\s+/', '', $trimmedData);
                        $customerElement[$csvHeader[$x]] = $trimmedData;
                        // echo $csvHeader[$x]. PHP_EOL;
                        // echo $row[$csvHeader[$x]]. PHP_EOL;
                    }
                    // print_r(json_encode($customerElement)) . PHP_EOL;
                    // echo 'fasdf' . PHP_EOL;
                    $customerArray[] = $customerElement;
                }
                $data_arr = ['success' => true, 'data' => $customerArray, 'headers' => $csvHeader, 'csvData' => $csvData];
            } else {
                $data_arr = ['success' => false, 'message' => 'Something is wrong with your CSV file.'];
            }
        } else {
            // echo 'No upload' . PHP_EOL;
        }

        exit(json_encode($data_arr));
    }

    public function importCustomerDataBackup()
    {
        addJSONResponseHeader();
        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];
        $importFieldsList = $this->general->get_data_with_param($getImportFields);

        $getCompanyImportSettings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'import',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];
        // 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,62,17,18,19,20,21,22,23,24,25,26,27,28,29,
        // 30,31,32,33,34,35,36,37,38,40,41,42,43,44,45,46,47,48,49,50,51,52,63,64,53,54,55,56,57,58,59,60,61
        $importFieldSettings = $this->general->get_data_with_param($getCompanyImportSettings, false);

        $input = $this->input->post();

        if ($input) {
            $customers = json_decode($input['customers']); // data CSV
            $mappingSelected = json_decode($input['mapHeaders'], true); // selected Headers
            $csvHeaders = json_decode($input['csvHeaders'], true); // CSV Headers

            // intialize array
            $acsProfileData = [];
            $acsAlarmData = [];
            $acsOfficeData = [];
            $acsBillingData = [];
            $dataVal = [];

            $settingsValue = explode(',', $importFieldSettings->value); // convert values from database to array
            sort($settingsValue);
            $fieldCompanyValue = implode(',', $settingsValue);
            $fieldCompanyValues = explode(',', $fieldCompanyValue);
            $exist = $insert = 0;

            foreach ($customers as $data) {
                $counter = 0;
                foreach ($fieldCompanyValues as $field) {
                    $fieldname = '';
                    $category = '';

                    foreach ($importFieldsList as $importSetting) { // values from acs_import_fields database
                        if ($field == $importSetting->id) {
                            $fieldname = $importSetting->field_name; // name of the header such as Status, First name Sale Date
                            $category = $importSetting->field_category; // category no. where the header belong, usefull for inserting in diff tables

                            $dataValue = $csvHeaders[$mappingSelected[$counter]]; // name of the selected header in the csv fle eg. "Sales Date"
                            array_push($dataVal, $dataValue);
                            switch ($category) {
                                case 1:
                                    $acsProfileData[$fieldname] = $data->$dataValue;
                                    break;
                                case 2:
                                    $acsBillingData[$fieldname] = $data->$dataValue;
                                    break;
                                case 3:
                                    if ($fieldname == 'technician' || $fieldname == 'fk_sales_rep_office') {
                                        $acsOfficeData[$fieldname] = getOfficeId($data->$dataValue);
                                    } else {
                                        $acsOfficeData[$fieldname] = $data->$dataValue;
                                    }
                                    break;
                                case 4:
                                    $acsAlarmData[$fieldname] = $data->$dataValue;
                                    break;
                                case 5:
                                    $acsProfileData[$fieldname] = $data->$dataValue;
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                    ++$counter;
                }
                $check_user = [
                'where' => [
                    'first_name' => $data->FirstName,
                    'last_name' => $data->LastName,
                    'company_id' => logged('company_id'),
                ],
                'returnType' => 'count',
                ];
                $isExist = $this->customer_ad_model->check_if_user_exist($check_user, 'acs_profile');
                if ($isExist > 0) {
                    ++$exist;
                } else {
                    $acsProfileData['company_id'] = logged('company_id');
                    $fk_prod_id = $this->customer_ad_model->add($acsProfileData, 'acs_profile');
                    ++$insert;

                    if ($fk_prod_id) {
                        $acsAlarmData['fk_prof_id'] = $fk_prod_id;
                        $acsBillingData['fk_prof_id'] = $fk_prod_id;
                        $acsOfficeData['fk_prof_id'] = $fk_prod_id;

                        $this->customer_ad_model->add($acsAlarmData, 'acs_alarm');
                        $this->customer_ad_model->add($acsBillingData, 'acs_billing');
                        $this->customer_ad_model->add($acsOfficeData, 'acs_office');
                    }
                }
            }

            $data_arr = ['success' => true, 'message' => 'Successfully imported '.$insert.' users!', 'alarm' => $acsAlarmData, 'profile' => $acsProfileData, 'billing' => $acsBillingData, 'office' => $acsOfficeData, 'Mapping' => $mappingSelected, 'CSV' => $csvHeaders, 'customers' => $customers];
            // $data_arr = array("success" => TRUE, "alarm" => $acsAlarmData, "profile" => $acsProfileData, "billing" => $acsBillingData, "office" => $acsOfficeData, "Mapping" => $mappingSelected, "CSV"=> $csvHeaders, "customers" => $customers);
        } else {
            $data_arr = ['success' => false, 'message' => 'Something goes wrong.'];
        }
        exit(json_encode($data_arr));
    }

     public function importCustomerData()
    {
        addJSONResponseHeader();
        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];
        $importFieldsList = $this->general->get_data_with_param($getImportFields);

        $getCompanyImportSettings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'import',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];

        $importFieldSettings = $this->general->get_data_with_param($getCompanyImportSettings, false);

        $post_data = $this->input->post();
        if ($post_data) {
            $customers       = $post_data['customerData'];
            $mappingSelected = $post_data['settingHeaders']; // selected Headers

            // intialize array
            $acsProfileData = [];
            $acsAlarmData   = [];
            $acsOfficeData  = [];
            $acsBillingData = [];
            $dataVal        = [];

            $settingsValue = explode(',', $importFieldSettings->value); // convert values from database to array
            sort($settingsValue);
            $fieldCompanyValue  = implode(',', $settingsValue);
            $fieldCompanyValues = explode(',', $fieldCompanyValue);
            $exist = $insert = 0;

            foreach ($customers as $customer) {

                $counter = 0;
                foreach ($fieldCompanyValues as $field) {
                    $fieldname = '';
                    $category  = '';

                    foreach ($importFieldsList as $importSetting) { // values from acs_import_fields database
                        if ($field == $importSetting->id) {
                            $fieldname = $importSetting->field_name; 
                            $category  = $importSetting->field_category;                            

                            switch ($category) {
                                case 1:
                                    $acsProfileData[$fieldname] = $customer[$importSetting->id];
                                    break;
                                case 2:
                                    $acsBillingData[$fieldname] = $customer[$importSetting->id];
                                    break;
                                case 3:
                                    if ($fieldname == 'technician' || $fieldname == 'fk_sales_rep_office') {
                                        $acsOfficeData[$fieldname] = getOfficeId($data->$dataValue);
                                    } else {
                                        $acsOfficeData[$fieldname] = $customer[$importSetting->id];
                                    }
                                    break;
                                case 4:
                                    $acsAlarmData[$fieldname] = $customer[$importSetting->id];
                                    break;
                                case 5:
                                    $acsContacts[$fieldname] = $customer[$importSetting->id];
                                    break;
                                default:
                                    break;
                            }

                        }
                    }
                    ++$counter;
                }

                $check_user = [
                'where' => [
                    'first_name' => $customer[5],
                    'last_name'  => $customer[6],
                    'company_id' => logged('company_id'),
                ],
                'returnType' => 'count',
                ];
                $isExist = $this->customer_ad_model->check_if_user_exist($check_user, 'acs_profile');
                if ($isExist > 0) {
                    ++$exist;
                } else {
                    $acsProfileData['company_id'] = logged('company_id');
                    $fk_prod_id = $this->customer_ad_model->add($acsProfileData, 'acs_profile');
                    ++$insert;

                    if ($fk_prod_id) {
                        $acsAlarmData['fk_prof_id']   = $fk_prod_id;
                        $acsBillingData['fk_prof_id'] = $fk_prod_id;
                        $acsOfficeData['fk_prof_id']  = $fk_prod_id;
                        $acsContacts['customer_id']  = $fk_prod_id;

                        $this->customer_ad_model->add($acsAlarmData, 'acs_alarm');
                        $this->customer_ad_model->add($acsBillingData, 'acs_billing');
                        $this->customer_ad_model->add($acsOfficeData, 'acs_office');
                        $this->customer_ad_model->add($acsContacts, 'contacts');
                    }
                   
                }

            }

            $data_arr = ['success' => true, 'message' => 'Successfully imported '.$insert.' users!', 'alarm' => $acsAlarmData, 'profile' => $acsProfileData, 'billing' => $acsBillingData, 'office' => $acsOfficeData, 'Mapping' => $mappingSelected, 'CSV' => $csvHeaders, 'customers' => $customers];
        } else {
            $data_arr = ['success' => false, 'message' => 'Something goes wrong.'];
        }

        exit(json_encode($data_arr));
    }    

    public function import_customer_data()
    {
        $is_success = 0;

        $data = [];
        addJSONResponseHeader();
        $input = $this->input->post();

        if ($input) {
            $insertCount = $updateCount = $rowCount = $notAddCount = 0;
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->load->library('CSVReader');
                $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                if (!empty($csvData)) {
                    foreach ($csvData as $row) {
                        // print_r($row);
                        $company = '';
                        if (in_array('Company', $input['headers'])) {
                            $company = $row['Company'];
                        }

                        $status = '';
                        if (in_array('Status', $input['headers'])) {
                            $status = $row['Status'];
                        }

                        $address = '';
                        if (in_array('Address', $input['headers'])) {
                            $address = $row['Address'];
                        }

                        $city = '';
                        if (in_array('City', $input['headers'])) {
                            $city = $row['City'];
                        }

                        $city = '';
                        if (in_array('City', $input['headers'])) {
                            $city = $row['City'];
                        }

                        $state = '';
                        if (in_array('State', $input['headers'])) {
                            $state = $row['State'];
                        }

                        $email = '';
                        if (in_array('Email', $input['headers'])) {
                            $email = $row['Email'];
                        }

                        $zip = '';
                        if (in_array('Zip', $input['headers'])) {
                            $city = $row['Zip'];
                        }

                        $country = '';
                        if (in_array('Country', $input['headers'])) {
                            $city = $row['Country'];
                        }

                        $input_profile = [
                            'fk_user_id' => logged('id'),
                            'fk_sa_id' => 0,
                            'first_name' => $row['FirstName'],
                            'last_name' => $row['LastName'],
                            'business_name' => $company,
                            'status' => $status,
                            'mail_add' => $address,
                            'city' => $city,
                            'email' => $email,
                            'state' => $state,
                            'zip_code' => $zip,
                            'country' => $country,
                            'company_id' => logged('company_id'),
                        ];
                        if (!empty($row['FirstName']) && !empty($row['LastName'])) {
                            $check_user = [
                                'where' => [
                                    'first_name' => $row['FirstName'],
                                    'last_name' => $row['LastName'],
                                    'company_id' => logged('company_id'),
                                ],
                                'returnType' => 'count',
                            ];
                            $prevCount = $this->customer_ad_model->check_if_user_exist($check_user, 'acs_profile');

                            if ($prevCount > 0) {
                                //                                $condition = array('contact_name' => $row['Contact Name']);
                                //                                $update = $this->customer_model->update($itemData, $condition);
                                //                                if ($update) {
                                //                                    $updateCount++;
                                //                                }
                            } else {
                                $cs2 = $row['CreditScore2'];
                                $score2 = 0;
                                switch ($cs2) {
                                    case 'A':
                                        $score2 = 700;
                                        break;
                                    case 'B':
                                        $score2 = 650;
                                        break;
                                    case 'C':
                                        $score2 = 625;
                                        break;
                                    case 'D':
                                        $score2 = 600;
                                        break;
                                    case 'F':
                                        $score2 = 599;
                                        break;
                                    default:
                                        $score2 = 0;
                                }
                                // $insert = $this->customer_ad_model->insert($itemData);
                                $fk_prod_id = $this->customer_ad_model->add($input_profile, 'acs_profile');

                                if ($fk_prod_id) {
                                    ++$insertCount;
                                    $input_alarm = [
                                        'fk_prof_id' => $fk_prod_id,
                                        'panel_type' => $row['PanelType'],
                                        'passcode' => $row['AbortCode'],
                                        'credit_score_alarm' => $row['CreditScore'],
                                        'monitor_comp' => $row['MonitoringCompany'],
                                        'install_date' => $row['InstallDate'],
                                        'monitor_id' => $row['MonitoringID'],
                                        'acct_type' => $row['AccountType'],
                                    ];
                                    $input_office = [
                                        'fk_prof_id' => $fk_prod_id,
                                        'sales_date' => $row['SaleDate'],
                                        'fk_sales_rep_office' => 1, // $row['SalesRep'],
                                        'technician' => $row['Technician'],
                                        'credit_score' => $score2,
                                    ];
                                    if (logged('company_id') == 2) {
                                        $input_billing = [
                                            'fk_prof_id' => $fk_prod_id,
                                            'mmr' => $row['MonthlyMonitoringRate'],
                                            'contract_term' => $row['ContractTerm'],
                                            'routing_num' => $row['Routing#'],
                                            'acct_num' => $row['Acct#'],
                                            'credit_card_num' => $row['CC#'],
                                            'credit_card_exp' => $row['Exp date'],
                                            'ach_date' => $row['Ach date'],
                                        ];
                                    } else {
                                        $input_billing = [
                                            'fk_prof_id' => $fk_prod_id,
                                            'mmr' => $row['MonthlyMonitoringRate'],
                                            'contract_term' => $row['ContractTerm'],
                                        ];
                                    }
                                    // $this->customer_ad_model->add($input_alarm,"acs_alarm");
                                    // $this->customer_ad_model->add($input_office,"acs_office");
                                    // $this->customer_ad_model->add($input_billing,"acs_billing");
                                }
                                $data[$rowCount]['firstname'] = $row['FirstName'];
                                $data[$rowCount]['lastname'] = $row['LastName'];
                                $data[$rowCount]['email'] = $row['Email'];
                                $data[$rowCount]['monitoring_company'] = $row['MonitoringCompany'];
                                $data[$rowCount]['state'] = $row['State'];
                                $data[$rowCount]['sales_rep'] = $row['Technician'];
                                $data[$rowCount]['status'] = $row['Status'];
                                ++$rowCount;
                            }
                        }
                    }
                    // $successMsg = 'Customer imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                    // $this->session->set_userdata('success_msg', $successMsg);

                    // $this->activity_model->add($successMsg);
                    // $this->session->set_flashdata('alert-type', 'success');
                    // $this->session->set_flashdata('alert', $successMsg);
                }
                // echo json_encode($data);
                $is_success = 1;
                // redirect(base_url('customer'));
            } else {
                // $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                // redirect($_SERVER['HTTP_REFERER'], 'refresh');
                $is_success = 2;
            }
        } else {
            $is_success = 0;
        }

        $json_data = ['is_success' => $is_success];
        echo json_encode($json_data);
    }

    public function customer_export()
    {
        $this->load->model('Users_model');

        $user_id = logged('id');
        $items = $this->customer_ad_model->getExportData();

        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];
        $importFieldsList = $this->general->get_data_with_param($getImportFields);
        $emergency_contacts_fields = ['contact_name1', 'first_relation', 'contact_phone1', 'contact_name2', 'second_relation', 'contact_phone2', 'contact_name3', 'third_relation', 'contact_phone3'];

        $getCompanyImportSettings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'export',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];
        $importFieldSettings = $this->general->get_data_with_param($getCompanyImportSettings, false);
        if ($importFieldSettings->value != '') {
            $fieldCompanyValues = explode(',', $importFieldSettings->value);
        } else {
            $fieldCompanyValues = ['5', '6', '7', '8', '9', '10', '11'];
        }

        $fields = [];
        $fieldNames = [];
        $is_with_emergency_contacts = 0;
        foreach ($fieldCompanyValues as $field) {
            foreach ($importFieldsList as $importSetting) {
                if ($field == $importSetting->id) {
                    array_push($fields, $importSetting->field_description);
                    array_push($fieldNames, $importSetting->field_name);
                    if (in_array($importSetting->field_name, $emergency_contacts_fields)) {
                        $is_with_emergency_contacts = 0;
                    }
                }
            }
        }

        $delimiter = ',';
        $time = time();
        $filename = 'customers_list_'.$time.'.csv';
        $f = fopen('php://memory', 'w');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $item) {
                if ($is_with_emergency_contacts == 1) {
                    $eContacts = [];
                    $emergencyContacts = $this->customer_ad_model->getAllCustomerEmergencyContactsByCustomerId($item->prof_id);
                    foreach ($emergencyContacts as $e) {
                        $eContacts[] = $e;
                    }
                }

                // if( $item->prof_id == 4898 ){
                //     echo "<pre>";
                //     print_r($fieldNames);
                //     print_r($eContacts);
                //     exit;
                // }
                $csvData = [];
                foreach ($fieldNames as $fieldName) {
                    $is_custom_field = 0;
                    if ($fieldName == 'customer_group_id') {
                        $customerGroup = $this->customer_ad_model->getCustomerGroupById($item->$fieldName);
                        if ($customerGroup) {
                            array_push($csvData, $customerGroup->name);
                        } else {
                            array_push($csvData, '---');
                        }

                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'fk_sa_id') {
                        $salesArea = $this->customer_ad_model->getASalesAreaById($item->$fieldName);
                        if ($salesArea) {
                            array_push($csvData, $salesArea->sa_name);
                        } else {
                            array_push($csvData, '---');
                        }

                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'fk_sales_rep_office' || $fieldName == 'technician') {
                        $user = $this->Users_model->getUserByID($item->$fieldName);
                        if ($user) {
                            $name = $user->FName.' '.$user->LName;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name1') {
                        if (isset($eContacts[0])) {
                            $name = $eContacts[0]->first_name.' '.$eContacts[0]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'first_relation') {
                        if (isset($eContacts[0])) {
                            array_push($csvData, $eContacts[0]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone1') {
                        if (isset($eContacts[0])) {
                            array_push($csvData, $eContacts[0]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name2') {
                        if (isset($eContacts[1])) {
                            $name = $eContacts[1]->first_name.' '.$eContacts[1]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'second_relation') {
                        if (isset($eContacts[1])) {
                            array_push($csvData, $eContacts[1]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone2') {
                        if (isset($eContacts[1])) {
                            array_push($csvData, $eContacts[1]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name3') {
                        if (isset($eContacts[2])) {
                            $name = $eContacts[2]->first_name.' '.$eContacts[2]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'third_relation') {
                        if (isset($eContacts[2])) {
                            array_push($csvData, $eContacts[2]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone3') {
                        if (isset($eContacts[2])) {
                            array_push($csvData, $eContacts[2]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($is_custom_field == 0) {
                        
                        if( $fieldName == 'bill_start_date' || $fieldName == 'bill_end_date' || $fieldName == 'date_of_birth' ){
                            $date = '---';
                            if( strtotime($item->$fieldName) > 0 ){
                                $date = date("m/d/Y", strtotime($item->$fieldName));                                
                            }
                            array_push($csvData, $date);
                        }else{
                            if (trim($item->$fieldName) != '') {
                                array_push($csvData, $item->$fieldName);
                            } else {
                                array_push($csvData, '---');
                            }
                        }
                    
                        
                    }
                }
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = [''];
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fpassthru($f);
    }

    public function customer_signature_upload()
    {
        if (0 < $_FILES['file']['error']) {
            echo 'Error: '.$_FILES['file']['error'].'<br>';
        } else {
            $uniquesavename = time().uniqid(rand());
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $destination = 'uploads/customer/'.$uniquesavename.'.'.$ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);

            $sourceFile = $_SERVER['DOCUMENT_ROOT'].'/'.$destination;
            $content = file_get_contents($sourceFile, FILE_USE_INCLUDE_PATH);
            $input = [];

            $input = [];
            $input['prof_sign_img'] = '/'.$destination;
            $input['prof_id'] = $_POST['id'];
            if ($this->customer_ad_model->update_data($input, 'acs_profile', 'prof_id')) {
                echo '/'.$destination;
            } else {
                echo 'Error';
            }
        }
    }

    public function view($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {
            foreach ($customer as $key => $value) {
                if (is_serialized($value)) {
                    $customer->{$key} = unserialize($value);
                }
            }

            $customer->company = get_company_by_user_id();

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/mixedview', $this->page_data);
    }

    public function genview($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {
            foreach ($customer as $key => $value) {
                if (is_serialized($value)) {
                    $customer->{$key} = unserialize($value);
                }
            }

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/genview', $this->page_data);
    }

    public function mixedview($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {
            foreach ($customer as $key => $value) {
                if (is_serialized($value)) {
                    $customer->{$key} = unserialize($value);
                }
            }

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/mixedview', $this->page_data);
    }

    public function edit($id)
    {
        $company_id = logged('company_id');

        $user_id = logged('id');

        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        $this->load->model('Users_model', 'users_model');

        if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }

        $this->page_data['customer'] = $this->customer_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['customer'] = $this->customer_model->getById($id);

        // $this->page_data['customer']->service_address = unserialize($this->page_data['customer']->service_address);

        $this->page_data['customer']->additional_contacts = unserialize($this->page_data['customer']->additional_contacts);

        $this->page_data['customer']->additional_info = unserialize($this->page_data['customer']->additional_info);

        $this->page_data['customer']->card_info = unserialize($this->page_data['customer']->card_info);

        if (is_serialized($this->page_data['customer']->phone)) {
            $this->page_data['customer']->phone = unserialize($this->page_data['customer']->phone)['number'];
        }
        $this->page_data['customer']->customer_group = unserialize($this->page_data['customer']->customer_group);

        $this->page_data['groups'] = get_customer_groups();

        $this->load->model('Source_model', 'source_model');

        $this->page_data['customer']->service_address = $this->customeraddress_model->getByModelAndType($id, 'customer', 'service_address');

        $this->page_data['customer']->source = $this->source_model->getSource($this->page_data['customer']->source_id);

        $this->load->view('customer/edit', $this->page_data);
    }

    public function save()
    {
        $user = (object) $this->session->userdata('logged');
        $company_id = logged('company_id');
        $data = [
            'customer_type' => post('customer_type'),
            'contact_name' => post('contact_name'),
            'contact_email' => post('contact_email'),
            'mobile' => post('contact_mobile'),
            'phone' => post('contact_phone'),
            'notification_method' => post('notify_by'),
            'street_address' => post('street_address'),
            'suite_unit' => post('suite_unit'),
            'city   ' => post('city'),
            'postal_code' => post('zip'),
            'state' => post('state'),
            'birthday' => post('birthday'),
            'source_id' => post('customer_source_id'),
            'comments' => post('notes'),
            'user_id' => $user->id,
            'additional_info' => (!empty(post('additional'))) ? serialize(post('additional')) : null,
            'card_info' => (!empty(post('card'))) ? serialize(post('card')) : null,
            'company_id' => $company_id,
            'customer_group' => (!empty(post('customer_group'))) ? serialize(post('customer_group')) : serialize([]),
        ];

        // previously generated customer id
        // this id will be present on session if addition contact or service address has been added
        $cid = $this->session->userdata('customer_id');
        // if no addition contact or service address has been added
        // create() will be called insted of update()
        // if (!empty($cid)) {
        //     $id = $this->customer_model->update($cid, $data);
        // } else {
        $id = $this->customer_model->create($data);
        if (!empty($this->input->post('service_address'))) {
            foreach ($this->input->post('service_address') as $key => $value) {
                $temp_data = $value;
                $temp_data['customer_id'] = $id;
                $temp_data['module'] = 'customer';
                $temp_data['type'] = 'service_address';
                $this->customeraddress_model->create($temp_data);
            }
        }

        // }

        // $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'New Customer Created Successfully');

        // clear sessions

        $this->session->unset_userdata('uid');

        $this->session->unset_userdata('customer_id');
        redirect('customer');
    }

    public function update($id)
    {
        $user = (object) $this->session->userdata('logged');

        $company_id = logged('company_id');

        $data = [
            'customer_type' => post('customer_type'),

            'contact_name' => post('contact_name'),

            'contact_email' => post('contact_email'),

            'mobile' => post('contact_mobile'),

            'phone' => post('contact_phone'),

            'notification_method' => post('notify_by'),

            'street_address' => post('street_address'),

            'suite_unit' => post('suite_unit'),

            'city   ' => post('city'),

            'postal_code' => post('zip'),

            'state' => post('state'),

            'birthday' => date('Y-m-d', strtotime(post('birthday'))),

            'source_id' => post('customer_source_id'),

            'comments' => post('notes'),

            'user_id' => $user->id,

            'additional_info' => (!empty(post('additional'))) ? serialize(post('additional')) : null,

            'card_info' => (!empty(post('card'))) ? serialize(post('card')) : null,

            'company_id' => $company_id,

            'customer_group' => (!empty(post('customer_group'))) ? serialize(post('customer_group')) : serialize([]),
        ];

        $id = $this->customer_model->update($id, $data);

        if (!empty($this->input->post('service_address')) > 0) {
            foreach ($this->input->post('service_address') as $key => $value) {
                $temp_data = $value;
                unset($temp_data['id']);

                if (isset($value['id']) && $value['id'] != '' && $value['id'] > 0) {
                    // $this->customeraddress_model->update($temp_data)->where('id',$value->id);
                    // $this->db->where('id', $id);
                    //  $this->db->update('user', $data);
                    $this->db->where('id', $value['id']);
                    $this->db->update($this->customeraddress_model->table, $temp_data);
                } else {
                    $temp_data['customer_id'] = $id;
                    $temp_data['module'] = 'customer';
                    $temp_data['type'] = 'service_address';
                    $this->customeraddress_model->create($temp_data);
                }
            }
        }

        if ($this->input->post('service_address_container_deleted_addresses') != '') {
            $delete_list = explode(',', $this->input->post('service_address_container_deleted_addresses'));
            $this->db->from($this->customeraddress_model->table);
            $this->db->where('customer_id ', $id);
            $this->db->where_in('id', $delete_list);
            $this->db->delete();
        }

        $this->activity_model->add("User #$user->id Updated by User:".logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Customer has been Updated Successfully');

        exit(json_encode(
            [
                'url' => base_url('customer'),
            ]
        ));
    }

    public function service_address_form()
    {
        $get = $this->input->get();
        if (!empty($get)) {
            $this->page_data['action'] = $get['action'];

            $this->page_data['data_index'] = $get['index'];

            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);

            $this->page_data['service_address'] = $this->customer_model->getServiceAddress(['id' => $get['customer_id']], $get['index']);

            // print_r($this->page_data['service_address']); die;
        }

        exit($this->load->view('customer/service_address_form', $this->page_data, true));
    }

    public function save_service_address()
    {
        $post = $this->input->post();

        // save service address to db

        if (!empty($post['customer_id'])) {
            $cid = $post['customer_id'];
        } else {
            $cid = $this->session->userdata('customer_id');
        }

        if (empty($cid)) {
            $customer_id = $this->customer_model->saveServiceAddress($post);
        } else {
            $this->customer_model->saveServiceAddress($post, $cid);
        }

        if (empty($cid)) {
            $this->session->set_userdata(['customer_id' => $customer_id]);
        } else {
            $customer_id = $cid;
        }

        exit(json_encode(
            [
                'customer_id' => $customer_id,
            ]
        ));
    }

    public function json_get_additional_contacts()
    {
        $get = $this->input->get();

        if (!empty($get['customer_id'])) {
            $cid = $get['customer_id'];
        } else {
            $cid = $this->session->userdata('customer_id');
        }

        if (!empty($cid)) {
            $this->page_data['customer_id'] = $cid;

            $this->page_data['additionalContacts'] = $this->customer_model->getAdditionalContacts(['id' => $cid]);

            // echo '<pre>'; print_r($serviceAddresses); die;
        }

        exit($this->load->view('customer/additional_contact_list', $this->page_data, true));
    }

    public function save_additional_contact()
    {
        $post = $this->input->post();

        // clear sessions

        // $this->session->unset_userdata('uid');

        // $this->session->unset_userdata('customer_id');

        // save service address to db

        if (!empty($post['customer_id'])) {
            $cid = $post['customer_id'];
        } else {
            $cid = $this->session->userdata('customer_id');
        }

        if (empty($cid)) {
            $customer_id = $this->customer_model->saveAdditionalContact($post);
        } else {
            $this->customer_model->saveAdditionalContact($post, $cid);
        }

        if (empty($cid)) {
            $this->session->set_userdata(['customer_id' => $customer_id]);
        } else {
            $customer_id = $cid;
        }

        exit(json_encode(
            [
                'customer_id' => $customer_id,
            ]
        ));
    }

    public function remove_additional_contact()
    {
        $post = $this->input->post();

        if ($this->customer_model->removeAdditionalContact($post['customer_id'], $post['index'])) {
            exit(json_encode(
                [
                    'status' => 'success',
                ]
            ));
        } else {
            exit(json_encode(
                [
                    'status' => 'error',
                ]
            ));
        }
    }

    public function json_dropdown_customer_list()
    {
        $get = $this->input->get();

        $company_id = logged('company_id');

        $role = logged('role');

        if ($role == 2 || $role == 3) {
            $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id, $get);
        }

        if ($role == 4) {
            $this->page_data['customers'] = $this->customer_model->getAllByUserId('', '', 0, 0, $get);
        }

        $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id, $get);

        exit(json_encode($this->page_data['customers']));
    }

    public function delete($id)
    {
        if ($id !== 1 && $id != logged($id)) {
        } else {
            redirect('/', 'refresh');

            return;
        }

        $id = $this->customer_model->delete($id);

        $this->activity_model->add("Customer #$id Deleted by User:".logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Customer has been Deleted Successfully');

        redirect('customer');
    }

    public function group()
    {
        $this->load->helper('customer_helper');

        if(!checkRoleCanAccessModule('customer-groups', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Customer Groups';
        $this->page_data['page']->parent = 'Customers';
        
        $this->hasAccessModule(9);
        $company_id = logged('company_id');
        // pass the $this so that we can use it to load view, model, library or helper classes
        // $customerGroup = new CustomerGroup($this);
        // $this->page_data['customerGroups'] =  $this->customer_ad_model->get_all_by_id('user_id',logged('id'),'customer_groups');

		$keyword         = '';
        $param['search'] = '';
        if(!empty(get('search'))) {
			$keyword = get('search');
            $this->page_data['search'] = $keyword;
            $param['search'] = $keyword;
            $this->page_data['customerGroups'] = $this->customer_ad_model->getAllSettingsCustomerGroupByCompanyId($company_id, $param);
        } else {
            $this->page_data['customerGroups'] = $this->customer_ad_model->getAllSettingsCustomerGroupByCompanyId($company_id);
        }  
        
        // $this->load->view('customer/group/list', $this->page_data);
        $this->load->view('v2/pages/customer/group/list', $this->page_data);
    }

    public function group_edit($id = null)
    {
        $this->page_data['page']->title = 'Edit Group';

        $is_allowed = $this->isAllowedModuleAccess(11);
        if (!$is_allowed) {
            $this->page_data['module'] = 'customer_group';
            echo $this->load->view('no_access_module', $this->page_data, true);
            exit;
        }

        if (!$id == null) {
            // save new updated group data
            $input = $this->input->post();
            unset($input['name-button']);
            if ($input) {
                $input['date_added'] = date('d-m-Y h:i A');
                if ($this->general->update_with_key($input, $id, 'customer_groups')) {

                    //Activity Logs
                    $activity_name = 'Updated Customer Group  ' . $input['title']; 
                    createActivityLog($activity_name);

                    redirect(base_url('customer/group'));
                }
            }
            $get_company_info = [
                'where' => [
                    'id' => $id,
                ],
                'table' => 'customer_groups',
                'select' => '*',
            ];
            $this->page_data['customerGroup'] = $this->general->get_data_with_param($get_company_info, false);
        } else {
            redirect(base_url('customer/group'));
        }
        // $this->load->view('customer/group/edit', $this->page_data);
        $this->load->view('v2/pages/customer/group/edit', $this->page_data);
    }

    public function group_add()
    {
        $this->page_data['page']->title = 'Add Group';

        $is_allowed = $this->isAllowedModuleAccess(11);
        if (!$is_allowed) {
            $this->page_data['module'] = 'customer_group';
            echo $this->load->view('no_access_module', $this->page_data, true);
            exit;
        }
        // pass the $this so that we can use it to load view, model, library or helper classes
        // $customerGroup = new CustomerGroup($this);
        $input = $this->input->post();
        if ($input) {
            unset($input['name-button']);
            $input['user_id'] = logged('id');
            $input['date_added'] = date('d-m-Y h:i A');
            $input['company_id'] = logged('company_id');
            if ($this->customer_ad_model->add($input, 'customer_groups')) {

                //Activity Logs
                $activity_name = 'Created Customer Group  ' . $input['title']; 
                createActivityLog($activity_name);

                redirect(base_url('customer/group'));
            }
        }
        $this->page_data['page_title'] = 'Customer Group Add';
        $this->load->view('customer/group/add', $this->page_data);
    }

    public function group_delete()
    {
        $this->load->model('CustomerGroup_model');

        $post = $this->input->post();

        $group_delete = [
            'where' => [
                'id' => $post['id'],
            ],
            'table' => 'customer_groups',
        ];

        $customerGroup = $this->CustomerGroup_model->getById($post['id']);
        if( $customerGroup ){
            if ($this->general->delete_($group_delete)) {
                //Activity Logs
                $activity_name = 'Deleted Customer Group  ' . $customerGroup->title; 
                createActivityLog($activity_name);
    
                echo true;
            } else {
                echo false;
            }
        }else{
            echo false;
        }
        
    }
    
    public function ajax_delete_customer_group()
    {
        $this->load->model('CustomerGroup_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();
        
        $customerGroup = $this->CustomerGroup_model->getById($post['id']);
        if( $customerGroup && $customerGroup->company_id == $cid ){
            $this->CustomerGroup_model->delete($customerGroup->id);
            
            //Activity Logs
            $activity_name = 'Customer Group : Deleted customer group  ' . $customerGroup->title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
        
    }

    public function categorizeNameAlphabetically($items)
    {
        $result = [];

        $cat = [
            '#' => [],
            'A' => [],
            'B' => [],
            'C' => [],
            'D' => [],
            'E' => [],
            'F' => [],
            'G' => [],
            'H' => [],
            'I' => [],
            'J' => [],
            'K' => [],
            'L' => [],
            'M' => [],
            'N' => [],
            'O' => [],
            'P' => [],
            'Q' => [],
            'R' => [],
            'S' => [],
            'T' => [],
            'U' => [],
            'V' => [],
            'W' => [],
            'X' => [],
            'Y' => [],
            'Z' => [],
        ];

        foreach ($items as $item) {
            $letter = ucfirst(substr($item->contact_name, 0, 1));
            foreach ($cat as $key => $c) {
                if ($letter == $key) {
                    array_push($cat[$key], $item);
                } elseif (is_numeric($letter)) {
                    if (!in_array($item, $cat['#'])) {
                        array_push($cat['#'], $item);
                    }
                }
            }
        }

        foreach ($cat as $key => $c) {
            if (!empty($c)) {
                $header = [$key, 'header', '', ''];
                array_push($result, $header);

                foreach ($c as $v) {
                    $value = [$v->id, $v->contact_name, $v->contact_email, $v->phone];
                    array_push($result, $value);
                }
            }
        }

        return $result;
    }

    public function ticketslist()
    {   
        $this->load->model('Users_model');
        $this->hasAccessModule(39);

        if(!checkRoleCanAccessModule('service-tickets', 'read')){
            show403Error();
            return false;
        }

        $cid = logged('company_id');
        $filters[]   = ['field' => 'tickets.is_archived', 'value' => 0];
        $tickets     = $this->tickets_model->getAllByCompanyId($cid, $filters);
        foreach($tickets as $t){
            $tech = unserialize($t->technicians);
            $assigned_tech = [];
            if( $tech ){
                foreach($tech as $eid){
                    $user = $this->Users_model->getUserByID($eid);
                    if( $user ){
                        $assigned_tech[] = ['id' => $user->id, 'first_name' => $user->FName, 'last_name' => $user->LName, 'image' => $user->profile_img];
                    }
                }
            }      
            $t->assigned_tech = $assigned_tech;
        }

        $openTickets = $this->tickets_model->getCompanyOpenServiceTickets($cid,[],$filters);
        $ticketTotalAmount = $this->tickets_model->getCompanyTotalAmountServiceTickets($cid,[],$filters);

        $this->page_data['tickets'] = $tickets;
        $this->page_data['openTickets'] = $openTickets;
        $this->page_data['ticketTotalAmount'] = $ticketTotalAmount;        
        $this->page_data['page']->title = 'Service Tickets';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/tickets/list', $this->page_data);
    }

    public function addTicket()
    {
        $this->hasAccessModule(39);
        $this->load->model('AcsProfile_model');
        $this->load->model('Job_tags_model');
        $this->load->model('SettingsPlanType_model');
        $this->load->model('PanelType_model');
        $this->load->model('Customer_advance_model');

        $this->page_data['page']->title = 'Tickets';

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        $company_id = logged('company_id');
        $role = logged('role');
        
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);

        $default_customer_id = 0;
        if ($this->input->get('cus_id')) {
            $default_customer_id = $this->input->get('cus_id');
        }

        $this->page_data['default_customer_id'] = $default_customer_id;

        $default_start_date = date('Y-m-d');
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

        // Settings
        $prefix = 'SERVICE-';
        $lastInserted = $this->tickets_model->getlastInsert($company_id);
        if ($lastInserted) {
            $next = $lastInserted->ticket_no;
            $arr = explode('-', $next);
            $val = $arr[1];

            $next_num = $val + 1;
        } else {
            $next_num = 1;
        }

        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

        $settingsPlanTypes = $this->SettingsPlanType_model->getAllByCompanyId($company_id);
        $settingPanelTypes = $this->PanelType_model->getAllByCompanyId($company_id);
        $ratePlans = $this->Customer_advance_model->getAllSettingsRatePlansByCompanyId($company_id);
        $type = $this->input->get('type');

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;
        $this->page_data['settingsPlanTypes'] = $settingsPlanTypes;
        $this->page_data['settingPanelTypes'] = $settingPanelTypes;
        $this->page_data['redirect_calendar'] = $redirect_calendar;
        $this->page_data['default_user'] = $default_user;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->page_data['default_start_time'] = $default_start_time;
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['items'] = $this->items_model->getItemlist();        
        $this->page_data['tags'] = $this->Job_tags_model->getJobTagsByCompany($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['serviceType'] = $this->tickets_model->getServiceType($company_id);
        $this->page_data['headers'] = $this->tickets_model->getHeaders($company_id);
        $this->page_data['companyName'] = $this->tickets_model->getCompany($company_id);
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['time_interval'] = 2;
        $this->load->view('tickets/add', $this->page_data);
    }

    public function merchant()
    {
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('ConvergeMerchant_model');

        $user_id = logged('id');
        $company_id = logged('company_id');

        $user = $this->Users_model->getUser($user_id);
        $company = $this->Clients_model->getById($company_id);
        $merchant = $this->ConvergeMerchant_model->getByCompanyId($company_id);

        $this->page_data['merchant'] = $merchant;
        $this->page_data['user'] = $user;
        $this->page_data['company'] = $company;
        $this->load->view('customer/merchant', $this->page_data);
    }

    public function send_merchant_details()
    {
        $this->load->model('ConvergeMerchant_model');

        $post = $this->input->post();

        $company_id = logged('company_id');
        $merchant = $this->ConvergeMerchant_model->getByCompanyId($company_id);

        $is_mailing = 0;
        if (isset($post['is_mailing'])) {
            $is_mailing = 1;
        }

        $is_shipping = 0;
        if (isset($post['is_shipping'])) {
            $is_shipping = 1;
        }

        $is_see_special_instructions = 0;
        if (isset($post['is_see_special_instructions'])) {
            $is_see_special_instructions = 1;
        }

        $is_beneficial_owner = 0;
        if (isset($post['is_beneficial_owner'])) {
            $is_beneficial_owner = 1;
        }

        $is_authorized_signer = 0;
        if (isset($post['is_authorized_signer'])) {
            $is_authorized_signer = 1;
        }

        $is_sole_proprietor = 0;
        if (isset($post['is_sole_proprietor'])) {
            $is_sole_proprietor = 1;
        }

        $is_principal_llc = 0;
        if (isset($post['principal_llc'])) {
            $is_sole_proprietor = 1;
        }

        $is_principal_corporation = 0;
        if (isset($post['principal_corporation'])) {
            $is_principal_corporation = 1;
        }

        $is_principal_others = 0;
        if (isset($post['principal_others'])) {
            $is_principal_others = 1;
        }

        $post['is_mailing'] = $is_mailing;
        $post['is_shipping'] = $is_shipping;
        $post['is_see_special_instructions'] = $is_see_special_instructions;
        $post['is_beneficial_owner'] = $is_beneficial_owner;
        $post['is_authorized_signer'] = $is_authorized_signer;
        $post['is_sole_proprietor'] = $is_sole_proprietor;
        $post['principal_llc'] = $is_principal_llc;
        $post['principal_corporation'] = $is_principal_corporation;
        $post['principal_others'] = $is_principal_others;

        if ($merchant) {
            $this->ConvergeMerchant_model->update($merchant->id, $post);
        } else {
            $post['company_id'] = $company_id;
            $this->ConvergeMerchant_model->create($post);
        }

        // Send Email
        $message = '<p>Below is the user merchant details.</p><br />';
        $message .= '<table>';
        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>COMPANY INFORMATION</h5></td></tr>";
        $message .= '<tr><td>DBA NAME</td><td>'.$post['dba_name'].'</td></tr>';
        $message .= '<tr><td>LEGAL BUSINESS NAME</td><td>'.$post['legal_business_name'].'</td></tr>';
        $message .= '<tr><td>CONTANCT NAME</td><td>'.$post['contact_name'].'</td></tr>';
        $message .= '<tr><td>DBA ADDRESS TYPE</td><td>'.$post['dba_address_type'].'</td></tr>';
        $message .= '<tr><td>DBA ADDRESS 1 (NO PO BOX)</td><td>'.$post['dba_address_1'].'</td></tr>';
        $message .= '<tr><td>DBA ADDRESS 2</td><td>'.$post['dba_address_2'].'</td></tr>';
        $message .= '<tr><td>CITY</td><td>'.$post['city'].'</td></tr>';
        $message .= '<tr><td>STATE</td><td>'.$post['state'].'</td></tr>';
        $message .= '<tr><td>ZIP CODE</td><td>'.$post['zip_code'].'</td></tr>';
        $message .= '<tr><td>DBA PHONE NO.</td><td>'.$post['dba_phone_no'].'</td></tr>';
        $message .= '<tr><td>EMAIL ADDRESS</td><td>'.$post['email_address'].'</td></tr>';
        $message .= '<tr><td>MOBILE PHONE NO.</td><td>'.$post['mobile_phone_no'].'</td></tr>';
        $message .= '<tr><td>YEAR ESTABLISHED</td><td>'.$post['years_established'].'</td></tr>';
        $message .= '<tr><td>LENGTH OF CURRENT OWNERSHIP</td><td>'.$post['length_ownership'].'</td></tr>';
        $message .= '<tr><td>YEARS</td><td>'.$post['ownership_years'].'</td></tr>';
        $message .= '<tr><td>MONTHS</td><td>'.$post['ownership_months'].'</td></tr>';

        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>OTHER ADDRESS (IF DIFFERENT FROM ABOVE)</h5></td></tr>";
        $message .= '<tr><td>IS MAILING</td><td>'.($post['is_mailing'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>IS SHIPPING</td><td>'.($post['is_shipping'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>IS SEE ALSO SPECIAL INSTRUCTIONS</td><td>'.($post['is_see_special_instructions'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>LOCATION NAME</td><td>'.$post['other_address_location_name'].'</td></tr>';
        $message .= '<tr><td>PHONE NO.</td><td>'.$post['other_address_phone_no'].'</td></tr>';
        $message .= '<tr><td>CONTACT NO.</td><td>'.$post['other_address_contact_no'].'</td></tr>';
        $message .= '<tr><td>BEST CONTACT NO.</td><td>'.$post['other_address_best_contact_no'].'</td></tr>';
        $message .= '<tr><td>BEST TIME TO CALL</td><td>'.$post['other_address_best_time_call_from'].'-'.$post['other_address_best_time_call_to'].'</td></tr>';
        $message .= '<tr><td>FAX NO.</td><td>'.$post['other_address_fax_no'].'</td></tr>';
        $message .= '<tr><td>ADDRESS</td><td>'.$post['other_address_address'].'</td></tr>';
        $message .= '<tr><td>CITY</td><td>'.$post['other_address_city'].'</td></tr>';
        $message .= '<tr><td>STATE</td><td>'.$post['other_address_state'].'</td></tr>';
        $message .= '<tr><td>ZIP CODE</td><td>'.$post['other_address_zipcode'].'</td></tr>';

        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BUSINESS STRUCTURES</h5></td></tr>";
        $message .= '<tr><td>IS LLC</td><td>'.($post['principal_llc'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>IS CORPORATION</td><td>'.($post['principal_corporation'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>IS SOLE PROPRIETORSHIP</td><td>'.($post['is_sole_proprietor'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>OTHER</td><td>'.($post['principal_others'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>FEDERAL ID NUMBER</td><td>'.$post['federal_id_number'].'</td></tr>';

        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PRINCIPAL 1 INFORMATION (Include all additional owners with 25% or greater ownership (Individual or Intermediary Business) on the Addl ownership ownership form)</h5></td></tr>";
        $message .= '<tr><td>IS BENEFICIAL OWNER</td><td>'.($post['is_beneficial_owner'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>PERCENTAGE OWNERSHIP</td><td>'.$post['percentage_ownership'].'</td></tr>';
        $message .= '<tr><td>IS AUTHORIZED SIGNER</td><td>'.($post['is_authorized_signer'] == 1 ? 'YES' : 'NO').'</td></tr>';
        $message .= '<tr><td>FIRST NAME</td><td>'.$post['principal_firstname'].'</td></tr>';
        $message .= '<tr><td>MIDDLE NAME</td><td>'.$post['principal_middlename'].'</td></tr>';
        $message .= '<tr><td>LAST NAME</td><td>'.$post['principal_lastname'].'</td></tr>';
        $message .= '<tr><td>ADDRESS (NO PO BOX)</td><td>'.$post['principal_address'].'</td></tr>';
        $message .= '<tr><td>PHONE NO</td><td>'.$post['principal_phone_no'].'</td></tr>';
        $message .= '<tr><td>CITY</td><td>'.$post['principal_city'].'</td></tr>';
        $message .= '<tr><td>STATE/PROVINCE</td><td>'.$post['principal_state_province'].'</td></tr>';
        $message .= '<tr><td>ZIP/POSTAL CODE</td><td>'.$post['principal_zip_postal_code'].'</td></tr>';
        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PREVIOUS ADDRESS IF CURRENT ADDRESS IS LESS THAN 2 YEARS</h5></td></tr>";
        $message .= '<tr><td>HOME ADDRESS</td><td>'.$post['principal_home_address'].'</td></tr>';
        $message .= '<tr><td>CITY</td><td>'.$post['principal_city_1'].'</td></tr>';
        $message .= '<tr><td>STATE</td><td>'.$post['principal_state_1'].'</td></tr>';
        $message .= '<tr><td>ZIP CODE</td><td>'.$post['principal_zip_code_1'].'</td></tr>';

        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>CREDIT CARD TRANSACTIONS</h5></td></tr>";
        $message .= '<tr><td>ANNUAL REVENUE (ACH, CHECK, CREDIT CARDS)</td><td>'.$post['annual_revenue'].'</td></tr>';
        $message .= '<tr><td>MONTHLY CREDIT CARD SALES</td><td>'.$post['monthly_cc_sales'].'</td></tr>';
        $message .= '<tr><td>AVERAGE CREDIT CARD TRANSACTIONS</td><td>'.$post['average_cc_transcations'].'</td></tr>';
        $message .= '<tr><td>HIGHEST CREDIT CARD TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>'.$post['highest_cc_transction_years'].'</td></tr>';
        $message .= '<tr><td>CARD NOT PRESENT TRANSACTION</td><td>'.$post['card_not_present_transaction'].'</td></tr>';

        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>ACH CHECKS</h5></td></tr>";
        $message .= '<tr><td>ANNUAL CHECK VOLUME</td><td>'.$post['annual_check_volume'].'</td></tr>';
        $message .= '<tr><td>AVERAGE CHECK TRANSACTION</td><td>'.$post['average_check_transaction'].'</td></tr>';
        $message .= '<tr><td>HIGHEST CHECK TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>'.$post['highest_check_transaction_years'].'</td></tr>';

        $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BANK ACCOUNT</h5></td></tr>";
        $message .= '<tr><td>BANK ACCOUNT</td><td>'.$post['bank_account'].'</td></tr>';
        $message .= '<tr><td>ROUTING NUMBER</td><td>'.$post['routing_number'].'</td></tr>';
        $message .= '<tr><td>BANK ACCOUNT NUMBER</td><td>'.$post['bank_account_number'].'</td></tr>';

        $message .= '</table>';
        $message .= '<br /><p>Confidentiality Statement</p>
    <p>This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake, and delete this e-mail from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing, or taking any action in reliance on the contents of this information is strictly prohibited.</p>';

        // Email Sending
        include APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: Merchant Data Application';
        $mail = new PHPMailer();
        // $mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // set the timeout (seconds)
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';

        // $mail->addAddress('moresecureadi@gmail.com', 'moresecureadi@gmail.com');
        $mail->addAddress('joyce.reynolds@elavon.com', 'joyce.reynolds@elavon.com');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $json_data['is_success'] = 1;
        $json_data['error'] = '';

        if (!$mail->Send()) {
            /*echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;*/
            $json_data['is_success'] = 0;
            $json_data['error'] = 'Mailer Error: '.$mail->ErrorInfo;
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Customer Merchant has been successfully updated');

        echo json_encode($json_data);
        // redirect('customer/merchant');
    }

    public function share_merchant_data()
    {
        $this->load->model('ConvergeMerchant_model');

        $post = $this->input->post();
        $recipient = $post['share_email'];
        $user_id = logged('id');
        $company_id = logged('company_id');

        $merchant = $this->ConvergeMerchant_model->getByCompanyId($company_id);
        if ($merchant) {
            $post = (array) $merchant;
            // Send Email
            $message = '<p>Below is the user merchant details.</p><br />';
            $message .= '<table>';
            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>COMPANY INFORMATION</h5></td></tr>";
            $message .= '<tr><td>DBA NAME</td><td>'.$post['dba_name'].'</td></tr>';
            $message .= '<tr><td>LEGAL BUSINESS NAME</td><td>'.$post['legal_business_name'].'</td></tr>';
            $message .= '<tr><td>CONTANCT NAME</td><td>'.$post['contact_name'].'</td></tr>';
            $message .= '<tr><td>DBA ADDRESS TYPE</td><td>'.$post['dba_address_type'].'</td></tr>';
            $message .= '<tr><td>DBA ADDRESS 1 (NO PO BOX)</td><td>'.$post['dba_address_1'].'</td></tr>';
            $message .= '<tr><td>DBA ADDRESS 2</td><td>'.$post['dba_address_2'].'</td></tr>';
            $message .= '<tr><td>CITY</td><td>'.$post['city'].'</td></tr>';
            $message .= '<tr><td>STATE</td><td>'.$post['state'].'</td></tr>';
            $message .= '<tr><td>ZIP CODE</td><td>'.$post['zip_code'].'</td></tr>';
            $message .= '<tr><td>DBA PHONE NO.</td><td>'.$post['dba_phone_no'].'</td></tr>';
            $message .= '<tr><td>EMAIL ADDRESS</td><td>'.$post['email_address'].'</td></tr>';
            $message .= '<tr><td>MOBILE PHONE NO.</td><td>'.$post['mobile_phone_no'].'</td></tr>';
            $message .= '<tr><td>YEAR ESTABLISHED</td><td>'.$post['years_established'].'</td></tr>';
            $message .= '<tr><td>LENGTH OF CURRENT OWNERSHIP</td><td>'.$post['length_ownership'].'</td></tr>';
            $message .= '<tr><td>YEARS</td><td>'.$post['ownership_years'].'</td></tr>';
            $message .= '<tr><td>MONTHS</td><td>'.$post['ownership_months'].'</td></tr>';

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>OTHER ADDRESS (IF DIFFERENT FROM ABOVE)</h5></td></tr>";
            $message .= '<tr><td>IS MAILING</td><td>'.($post['is_mailing'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>IS SHIPPING</td><td>'.($post['is_shipping'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>IS SEE ALSO SPECIAL INSTRUCTIONS</td><td>'.($post['is_see_special_instructions'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>LOCATION NAME</td><td>'.$post['other_address_location_name'].'</td></tr>';
            $message .= '<tr><td>PHONE NO.</td><td>'.$post['other_address_phone_no'].'</td></tr>';
            $message .= '<tr><td>CONTACT NO.</td><td>'.$post['other_address_contact_no'].'</td></tr>';
            $message .= '<tr><td>BEST CONTACT NO.</td><td>'.$post['other_address_best_contact_no'].'</td></tr>';
            $message .= '<tr><td>BEST TIME TO CALL</td><td>'.$post['other_address_best_time_call_from'].'-'.$post['other_address_best_time_call_to'].'</td></tr>';
            $message .= '<tr><td>FAX NO.</td><td>'.$post['other_address_fax_no'].'</td></tr>';
            $message .= '<tr><td>ADDRESS</td><td>'.$post['other_address_address'].'</td></tr>';
            $message .= '<tr><td>CITY</td><td>'.$post['other_address_city'].'</td></tr>';
            $message .= '<tr><td>STATE</td><td>'.$post['other_address_state'].'</td></tr>';
            $message .= '<tr><td>ZIP CODE</td><td>'.$post['other_address_zipcode'].'</td></tr>';

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BUSINESS STRUCTURES</h5></td></tr>";
            $message .= '<tr><td>IS LLC</td><td>'.($post['principal_llc'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>IS CORPORATION</td><td>'.($post['principal_corporation'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>IS SOLE PROPRIETORSHIP</td><td>'.($post['is_sole_proprietor'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>OTHER</td><td>'.($post['principal_others'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>FEDERAL ID NUMBER</td><td>'.$post['federal_id_number'].'</td></tr>';

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PRINCIPAL 1 INFORMATION (Include all additional owners with 25% or greater ownership (Individual or Intermediary Business) on the Addl ownership ownership form)</h5></td></tr>";
            $message .= '<tr><td>IS BENEFICIAL OWNER</td><td>'.($post['is_beneficial_owner'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>PERCENTAGE OWNERSHIP</td><td>'.$post['percentage_ownership'].'</td></tr>';
            $message .= '<tr><td>IS AUTHORIZED SIGNER</td><td>'.($post['is_authorized_signer'] == 1 ? 'YES' : 'NO').'</td></tr>';
            $message .= '<tr><td>FIRST NAME</td><td>'.$post['principal_firstname'].'</td></tr>';
            $message .= '<tr><td>MIDDLE NAME</td><td>'.$post['principal_middlename'].'</td></tr>';
            $message .= '<tr><td>LAST NAME</td><td>'.$post['principal_lastname'].'</td></tr>';
            $message .= '<tr><td>ADDRESS (NO PO BOX)</td><td>'.$post['principal_address'].'</td></tr>';
            $message .= '<tr><td>PHONE NO</td><td>'.$post['principal_phone_no'].'</td></tr>';
            $message .= '<tr><td>CITY</td><td>'.$post['principal_city'].'</td></tr>';
            $message .= '<tr><td>STATE/PROVINCE</td><td>'.$post['principal_state_province'].'</td></tr>';
            $message .= '<tr><td>ZIP/POSTAL CODE</td><td>'.$post['principal_zip_postal_code'].'</td></tr>';
            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PREVIOUS ADDRESS IF CURRENT ADDRESS IS LESS THAN 2 YEARS</h5></td></tr>";
            $message .= '<tr><td>HOME ADDRESS</td><td>'.$post['principal_home_address'].'</td></tr>';
            $message .= '<tr><td>CITY</td><td>'.$post['principal_city_1'].'</td></tr>';
            $message .= '<tr><td>STATE</td><td>'.$post['principal_state_1'].'</td></tr>';
            $message .= '<tr><td>ZIP CODE</td><td>'.$post['principal_zip_code_1'].'</td></tr>';

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>CREDIT CARD TRANSACTIONS</h5></td></tr>";
            $message .= '<tr><td>ANNUAL REVENUE (ACH, CHECK, CREDIT CARDS)</td><td>'.$post['annual_revenue'].'</td></tr>';
            $message .= '<tr><td>MONTHLY CREDIT CARD SALES</td><td>'.$post['monthly_cc_sales'].'</td></tr>';
            $message .= '<tr><td>AVERAGE CREDIT CARD TRANSACTIONS</td><td>'.$post['average_cc_transcations'].'</td></tr>';
            $message .= '<tr><td>HIGHEST CREDIT CARD TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>'.$post['highest_cc_transction_years'].'</td></tr>';
            $message .= '<tr><td>CARD NOT PRESENT TRANSACTION</td><td>'.$post['card_not_present_transaction'].'</td></tr>';

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>ACH CHECKS</h5></td></tr>";
            $message .= '<tr><td>ANNUAL CHECK VOLUME</td><td>'.$post['annual_check_volume'].'</td></tr>';
            $message .= '<tr><td>AVERAGE CHECK TRANSACTION</td><td>'.$post['average_check_transaction'].'</td></tr>';
            $message .= '<tr><td>HIGHEST CHECK TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>'.$post['highest_check_transaction_years'].'</td></tr>';

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BANK ACCOUNT</h5></td></tr>";
            $message .= '<tr><td>BANK ACCOUNT</td><td>'.$post['bank_account'].'</td></tr>';
            $message .= '<tr><td>ROUTING NUMBER</td><td>'.$post['routing_number'].'</td></tr>';
            $message .= '<tr><td>BANK ACCOUNT NUMBER</td><td>'.$post['bank_account_number'].'</td></tr>';

            $message .= '</table>';
            $message .= '<br /><p>Confidentiality Statement</p>
    <p>This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake, and delete this e-mail from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing, or taking any action in reliance on the contents of this information is strictly prohibited.</p>';

            // Email Sending
            include APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            $from = MAIL_FROM;
            $subject = 'nSmarTrac: Merchant Data Application';
            $mail = new PHPMailer();
            // $mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';

            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $json_data['is_success'] = 1;
            $json_data['error'] = '';

            if (!$mail->Send()) {
                /*echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;*/
                $json_data['is_success'] = 0;
                $json_data['error'] = 'Mailer Error: '.$mail->ErrorInfo;
            }
        } else {
            $json_data['is_success'] = 0;
            $json_data['message'] = '';
        }

        echo json_encode($json_data);
    }

    public function generate_qr_image($profile_id)
    {
        require_once APPPATH.'libraries/qr_generator/QrCode.php';

        $target_dir = './uploads/customer_qr/';

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $qr_data = base_url('/customer/preview/'.$profile_id);
        $ecc = 'M';
        $size = 3;
        $filename = 'qr'.md5($qr_data.'|'.$ecc.'|'.$size).'.png';

        $qrApi = new \Qr\QrCode();
        $qrApi->setFileName($target_dir.$filename);
        $qrApi->setErrorCorrectionLevel($ecc);
        $qrApi->setMatrixPointSize($size);
        $qrApi->setQrData($qr_data);
        $qr_data = $qrApi->generateQR();

        $profile_data = ['qr_img' => $filename];
        $this->general->update_with_key_field($profile_data, $profile_id, 'acs_profile', 'prof_id');
    }

    public function save_customer_headers()
    {
        $input = $this->input->post();
        $headers = [];
        if (isset($input['headers'])) {
            foreach ($input['headers'] as $key => $value) {
                $headers[] = $key;
            }
        }

        if (logged('company_id') == 58) {
            foreach ($input['solarHeader'] as $key => $value) {
                $headers[] = $key;
            }
        }

        if (logged('company_id') == 31) {
            if (isset($input['alarmHeader'])) {
                foreach ($input['alarmHeader'] as $key => $value) {
                    $headers[] = $key;
                }
            }
        }

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        if ($customer_settings) {
            $data = ['headers' => serialize($headers)];
            $this->general->update_with_key_field($data, logged('company_id'), 'customer_settings_headers', 'company_id');
        } else {
            $data = [
                'company_id' => logged('company_id'),
                'headers' => serialize($headers),
            ];
            $this->general->add_($data, 'customer_settings_headers');
        }

        $json_data = ['is_success' => 1];
        echo json_encode($json_data);
    }

    public function billing_errors()
    {
        $billingErrors = $this->customer_ad_model->get_customer_billing_errors(logged('company_id'));
        $this->page_data['billingErrors'] = $billingErrors;

        $this->page_data['page']->title = 'Billing Errors';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/billing_error/list', $this->page_data);
        // $this->load->view('customer/billing_error/list', $this->page_data);
    }

    public function ajax_load_company_billing_credit_card_details()
    {
        $post = $this->input->post();
        $billing_id = $post['billing_id'];
        $billing = $this->customer_ad_model->get_company_billing_error(logged('company_id'), $billing_id);
        // if( $billing ){
        //     $date_year = explode("/", $billing->credit_card_exp);

        //     $this->page_data['cc_date_year'] = $date_year;
        //     $this->page_data['billing'] = $billing;
        //     $this->load->view('customer/billing_error/ajax_credit_card_details', $this->page_data);

        // }else{
        //     echo "<div class='alert alert-danger'>Cannot find record</div>";
        // }

        $date_year = explode('/', $billing->credit_card_exp);

        $this->page_data['cc_date_year'] = $date_year;
        $this->page_data['billing'] = $billing;
        $this->load->view('v2/pages/customer/load_credit_card_details', $this->page_data);
    }

    public function ajax_update_billing_credit_card_details()
    {
        $is_success = 0;
        $msg = '';
        $post = $this->input->post();

        $billing = $this->customer_ad_model->get_company_billing_error(logged('company_id'), $post['bid']);
        $cc_exp_date = $post['exp_month'].date('y', strtotime('01-01-'.$post['exp_year']));

        $data_cc = [
            'card_number' => $post['card_number'],
            'exp_date' => $cc_exp_date,
            'cvc' => $post['cvc'],
            'ssl_amount' => 0,
            'ssl_first_name' => $billing->card_fname,
            'ssl_last_name' => $billing->card_lname,
            'ssl_address' => $billing->card_address.' '.$billing->city.' '.$billing->state,
            'ssl_zip' => $billing->zip,
        ];
        $is_valid = $this->converge_check_cc_details_valid($data_cc);
        if ($is_valid['is_success'] > 0) {
            $is_success = 1;
            // Update cc
            $billing_data = [
                'credit_card_num' => $post['card_number'],
                'credit_card_exp' => $post['exp_month'].'/'.$post['exp_year'],
                'credit_card_exp_mm_yyyy' => $post['cvc'],
                'is_with_error' => 0,
                'error_message' => '',
                'error_type' => '',
                'error_date' => '',
            ];
            $this->general->update_with_key_field($billing_data, $billing->bill_id, 'acs_billing', 'bill_id');
        } else {
            $msg = $is_valid['msg'];
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function customer_subscriptions()
    {   
        $this->load->model('Customer_advance_model');

        $company_id = logged('company_id');
        $activeSubscriptions    = $this->Customer_advance_model->getTotalActiveSubscriptionsByCompanyId($company_id);
        $completedSubscriptions = $this->Customer_advance_model->getTotalCompletedSubscriptionsByCompanyId($company_id);
        $totalSubscriptions     = $this->Customer_advance_model->getTotalSubscriptionsByCompanyId($company_id);

        $this->page_data['page']->title = 'Customer Subscriptions';
        $this->page_data['page']->parent = 'Customers';
        $this->page_data['activeSubscriptions'] = $activeSubscriptions;
        $this->page_data['completedSubscriptions'] = $completedSubscriptions;
        $this->page_data['totalSubscriptions'] = $totalSubscriptions;
        $this->load->view('v2/pages/customer/subscription_list', $this->page_data);
    }

    public function getActiveCustomerListByFilter()
    {
        $company_id = logged('company_id');

        $status = $this->input->post('status');
        $type = $this->input->post('type');

        switch ($status) {
            case 'all':
                $statusFilter = "";
                break;
            case 'active':
                $statusFilter = "AND customer_list_view.profile_status IN ('Active', 'Active w/RAR', 'Active w/RQR', 'Active w/RMR', 'Active w/RYR', 'Inactive w/RMM')";
                break;
        }

        switch ($type) {
            case 'all':
                $typeFilter = "";
            break;
            case 'residential':
                $typeFilter = "AND customer_list_view.profile_customer_type = 'Residential'";
            break;
            case 'commercial':
                $typeFilter = "AND customer_list_view.profile_customer_type = 'Commercial'";
            break;
        }

        $query = $this->db->query("
            SELECT 
                customer_list_view.prof_id AS `id`,
                customer_list_view.company_id AS `company_id`,
                customer_list_view.customer_no AS `customer_no`,
                CASE 
                    WHEN customer_list_view.profile_business_name IS NOT NULL 
                        AND customer_list_view.profile_business_name != '' 
                        AND customer_list_view.profile_business_name != 'Not Specified' 
                    THEN customer_list_view.profile_business_name
                    ELSE customer_list_view.customer_name
                END AS `name`,
                customer_list_view.customer_group_name AS `customer_group`,
                customer_list_view.profile_customer_group_id AS `customer_group_id`,
                customer_list_view.profile_status AS `status`,
                customer_list_view.profile_customer_type AS `type`,
                customer_list_view.profile_full_address AS `address`,
                customer_list_view.profile_email AS `email`,
                customer_list_view.profile_phone_m AS `phone_m`,
                customer_list_view.profile_is_verified AS `is_verified`,
                customer_list_view.office_lead_source AS `source`,
                customer_list_view.office_sales_rep_name AS `sales_rep_name`,
                customer_list_view.office_technician_name AS `tech_rep_name`,
                customer_list_view.alarm_monitor_id AS `monitor_id`,
                customer_list_view.alarm_panel_type AS `panel_type`,
                customer_list_view.alarm_pass_thru_cost AS `pass_thru_cost`,
                customer_list_view.alarm_account_cost AS `account_cost`,
                customer_list_view.alarm_comm_type AS `service_package`,
                customer_list_view.alarm_monthly_monitoring AS `alarm_bill_mmr`,
                customer_list_view.alarm_feature_cost AS `feature_cost`,
                customer_list_view.billing_bill_start_date AS `bill_start`,
                customer_list_view.billing_bill_end_date AS `bill_end`,
                customer_list_view.billing_mmr AS `bill_mmr`,
                customer_list_view.billing_bill_method AS `payment_method`
            FROM customer_list_view
            WHERE customer_list_view.company_id = {$company_id}
                {$statusFilter}
                {$typeFilter}
            ORDER BY customer_list_view.customer_name ASC;
        ");


        $data = $query->result();

        echo json_encode($data);
    }

    public function ajax_load_active_subscriptions()
    {
        $this->load->model('Customer_advance_model');

        $company_id = logged('company_id');
        $activeSubscriptions = $this->Customer_advance_model->get_all_active_subscription_by_company_id($company_id);
        $this->page_data['activeSubscriptions'] = $activeSubscriptions;
        // $this->load->view('customer/ajax_load_active_subscriptions', $this->page_data);
        $this->load->view('v2/pages/customer/load_active_subscriptions', $this->page_data);
    }

    public function ajax_load_all_subscriptions()
    {
        $this->load->model('Customer_advance_model');

        $company_id = logged('company_id');
        $subscriptions = $this->Customer_advance_model->get_all_subscription_by_company_id($company_id);
        $this->page_data['subscriptions'] = $subscriptions;
        $this->load->view('v2/pages/customer/load_all_subscriptions', $this->page_data);
    }

    public function ajax_load_completed_subscriptions()
    {
        $this->load->model('Customer_advance_model');

        $company_id = logged('company_id');
        $completedSubscriptions = $this->Customer_advance_model->get_all_completed_subscription_by_company_id($company_id);
        $this->page_data['completedSubscriptions'] = $completedSubscriptions;
        // $this->load->view('customer/ajax_load_completed_subscriptions', $this->page_data);
        $this->load->view('v2/pages/customer/load_completed_subscriptions', $this->page_data);
    }

    public function ajax_load_billing_error_subscriptions()
    {
        $this->load->model('Customer_advance_model');

        $company_id = logged('company_id');
        $errorSubscriptions = $this->Customer_advance_model->get_all_billing_errors_by_company_id($company_id);
        $this->page_data['errorSubscriptions'] = $errorSubscriptions;
        // $this->load->view('customer/ajax_load_billing_error_subscriptions', $this->page_data);
        $this->load->view('v2/pages/customer/load_biller_error_subscriptions', $this->page_data);
    }

    public function ajax_load_subscription_list_counter()
    {
        $this->load->model('Customer_advance_model');

        $company_id = logged('company_id');
        $activeSubscriptions = $this->Customer_advance_model->get_all_active_subscription_by_company_id($company_id);
        $completedSubscriptions = $this->Customer_advance_model->get_all_completed_subscription_by_company_id($company_id);
        $errorSubscriptions = $this->Customer_advance_model->get_all_billing_errors_by_company_id($company_id);

        $json_data = [
            'total_active' => count($activeSubscriptions),
            'total_completed' => count($completedSubscriptions),
            'total_billing_errors' => count($errorSubscriptions),
        ];

        echo json_encode($json_data);
    }

    public function ajax_load_subscription_payment_history()
    {
        $this->load->model('Customer_advance_model');

        $post = $this->input->post();

        $paymentHistory = $this->Customer_advance_model->get_all_subscription_payments($post['customer_id']);
        $totalSubscriptionPayment = $this->Customer_advance_model->getCustomerTotalSubscriptionPayments($post['customer_id']);

        $this->page_data['paymentHistory'] = $paymentHistory;
        $this->page_data['totalSubscriptionPayment'] = $totalSubscriptionPayment;
        // $this->load->view('customer/ajax_load_subscription_payment_history', $this->page_data);
        $this->load->view('v2/pages/customer/load_subscription_payment_history', $this->page_data);
    }

    public function settings_sales_area()
    {
        $this->page_data['page']->title = 'Sales Area';
        $this->page_data['page']->parent = 'Customers';

        $this->load->library('wizardlib');
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $user_id = logged('id');
        $company_id = logged('company_id');

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $user_id;

        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

		$keyword         = '';
        $param['search'] = '';
        if(!empty(get('search'))) {
			$keyword = get('search');
            $this->page_data['search'] = $keyword;
            $param['search'] = $keyword;
            $this->page_data['sales_area'] = $this->customer_ad_model->getAllSettingsSalesAreaByCompanyId($company_id, $param);
        } else {
            $this->page_data['sales_area'] = $this->customer_ad_model->getAllSettingsSalesAreaByCompanyId($company_id);
        }        

        $this->load->view('v2/pages/customer/settings_sales_area', $this->page_data);
    }

    public function settings_lead_source()
    {
        $this->load->library('wizardlib');
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $user_id = logged('id');
        $company_id = logged('company_id');

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $user_id;

        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

		$keyword         = '';
        $param['search'] = '';
        if(!empty(get('search'))) {
			$keyword = get('search');
            $this->page_data['search'] = $keyword;
            $param['search'] = $keyword;
            $this->page_data['lead_source'] = $this->customer_ad_model->getAllSettingsLeadSourceByCompanyId($company_id, $param);
        } else {
            $this->page_data['lead_source'] = $this->customer_ad_model->getAllSettingsLeadSourceByCompanyId($company_id);
        }        

        $this->page_data['page']->title = 'Lead Source';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/customer/settings_lead_source', $this->page_data);
    }

    public function settings_lead_types()
    {
        $this->load->library('wizardlib');
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $user_id = logged('id');
        $company_id = logged('company_id');

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $user_id;

        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

		$keyword         = '';
        $param['search'] = '';
        if(!empty(get('search'))) {
			$keyword = get('search');
            $this->page_data['search'] = $keyword;
            $param['search'] = $keyword;
            $this->page_data['lead_types'] = $this->customer_ad_model->getAllSettingsLeadTypesByCompanyId($company_id, $param);
        } else {
            $this->page_data['lead_types'] = $this->customer_ad_model->getAllSettingsLeadTypesByCompanyId($company_id);
        }          

        $this->page_data['page']->title = 'Lead Types';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/customer/settings_lead_types', $this->page_data);
    }

    public function settings_rate_plans()
    {
        $this->load->library('wizardlib');
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $user_id = logged('id');
        $company_id = logged('company_id');

        $this->page_data['customer_profile_id'] = $user_id;
        $this->page_data['page']->title = 'Rate Plans';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['rate_plans'] = $this->customer_ad_model->getAllSettingsRatePlansByCompanyId($company_id);
        $this->load->view('v2/pages/customer/settings_rate_plans', $this->page_data);
    }

    public function settings_activation_fee()
    {
        $this->load->library('wizardlib');
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $user_id = logged('id');
        $company_id = logged('company_id');
        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

        $this->page_data['customer_profile_id'] = $user_id;
        $this->page_data['page']->title = 'Activation Fee';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['activation_fee'] = $this->customer_ad_model->getAllSettingsActivationFeeByCompanyId($company_id);
        $this->load->view('v2/pages/customer/settings_activation_fee', $this->page_data);
    }

    public function settings_system_package()
    {
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $user_id = logged('id');
        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

        $spt_query = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'ac_system_package_type',
            'order' => [
                'order_by' => 'id',
                'ordering' => 'DESC',
            ],
            'select' => '*',
        ];

        $this->page_data['customer_profile_id'] = $user_id;
        $this->page_data['page']->title = 'Service Packages';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);
        $this->load->view('v2/pages/customer/settings_system_package', $this->page_data);
    }

    public function settings_headers()
    {
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        }        

        $user_id = logged('id');
        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
            ],
            'table' => 'customer_settings_headers',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings);
        $headers = unserialize($customer_settings[0]->headers);

        $this->page_data['customer_profile_id'] = $user_id;
        $this->page_data['customer_list_headers'] = customer_list_headers();
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data_settings($user_id);
        $this->page_data['page']->title = 'Headers';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['customer_tbl_headers'] = $headers;
        $this->page_data['company_id'] = logged('company_id');

        $this->load->view('v2/pages/customer/settings_headers', $this->page_data);
    }

    /**
     * This function will serve as view of customer settings import, each company has their own import settings.
     */
    public function settings_import()
    {
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        }  

        $user_id = logged('id');

        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'import',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];
        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];

        $this->page_data['customer_list_headers'] = customer_list_headers();
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data_settings($user_id);
        $this->page_data['customer_profile_id'] = $user_id;
        $this->page_data['page']->title = 'Customer Import Settings';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['importFieldsList'] = $this->general->get_data_with_param($getImportFields);
        $this->page_data['importFields'] = $this->general->get_data_with_param($get_company_settings, false);
        $this->page_data['company_id'] = logged('company_id');
        $this->page_data['page']->title = 'Import Settings';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/customer/settings_import', $this->page_data);
    }

    /**
     * This function will serve as view of customer settings import, each company has their own import settings.
     */
    public function settings_export()
    {
        $this->hasAccessModule(9);

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        } 
        
        $user_id = logged('id');
        $get_company_settings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'export',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];
        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];
        $customer_settings = $this->general->get_data_with_param($get_company_settings, false);

        if (isset($userid) || !empty($userid)) {
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id', $userid, 'acs_profile');
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();
        }

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $user_id;
        $this->page_data['customer_list_headers'] = customer_list_headers();
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data_settings($user_id);
        $this->page_data['importFieldsList'] = $this->general->get_data_with_param($getImportFields);
        $this->page_data['page']->title = 'Customer Export Settings';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['importFields'] = $customer_settings;
        $this->page_data['company_id'] = logged('company_id');
        $this->page_data['page']->title = 'Export Settings';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/customer/settings_export', $this->page_data);
    }

    /**
     * This function will serve Add or Update of Customer Import Settings.
     */
    public function addOrUpdateImportFields()
    {
        if(!checkRoleCanAccessModule('customer-settings', 'write')){
            show403Error();
            return false;
        }    

        addJSONResponseHeader();
        $input = $this->input->post();
        $is_updated = 0;
        if ($input) {
            $importFields = json_decode($input['importFields']);

            $table = 'customer_settings'; // database table to use
            // check if there is already save import settings
            $checkIfHasExistingData = [
                'where' => [
                    'company_id' => logged('company_id'),
                    'setting_type' => $input['type'],
                ],
                'table' => $table,
                'select' => 'customer_settings_id',
            ];
            $customer_settings = $this->general->get_data_with_param($checkIfHasExistingData, false);

            if ($customer_settings) {
                $data = [];
                $data['value'] = implode(',', $importFields);
                if ($this->general->update_with_key_field($data, $customer_settings->customer_settings_id, $table, 'customer_settings_id')) {
                    $data_arr = ['success' => true, 'message' => 'Customer Settings Export updated.'];
                    $is_updated = 1;
                } else {
                    $data_arr = ['success' => false, 'message' => 'Something goes wrong.'];
                }
            } else {
                $customer_setting = [];
                $customer_setting['setting_type'] = $input['type'];
                $customer_setting['value'] = implode(',', $importFields);
                $customer_setting['status'] = 1;
                $customer_setting['company_id'] = logged('company_id');
                $customer_settings['created_at'] = date("Y-m-d H:i:s");
                if ($this->general->add_($customer_setting, $table)) {
                    $data_arr = ['success' => true, 'message' => 'Customer Settings Export added.'];
                    $is_updated = 1;
                } else {
                    $data_arr = ['success' => false, 'message' => 'Something goes wrong.'];
                }
            }

            if( $is_updated == 1 ){
                //Activity Logs
                if( $input['type'] == 'export' ){
                    $activity_name = 'Export Settings : Updated customer export settings'; 
                }else{
                    $activity_name = 'Import Settings : Updated customer import settings'; 
                }
                
                createActivityLog($activity_name);
            }
        } else {
            $data_arr = ['success' => false, 'message' => 'Something goes wrong.'];
        }
        exit(json_encode($data_arr));
    }

    /**
     * This function will serve as view of solar lender type page.
     */
    public function settings_solar_lender_type()
    {
        $this->load->model('AcsSolarInfoLenderType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        }   

        $cid = logged('company_id');
        $lender_types = $this->AcsSolarInfoLenderType_model->getAllByCompanyId($cid);

        $this->page_data['page']->title = 'Solar Lender Types';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['lender_types'] = $lender_types;
        $this->load->view('v2/pages/customer/solar/settings_lender_type', $this->page_data);
    }

    /**
     * This function will serve as view of solar lender type page.
     */
    public function settings_solar_system_size()
    {
        $this->load->model('AcsSolarInfoSystemSize_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        }   

        $cid = logged('company_id');
        $systemSizes = $this->AcsSolarInfoSystemSize_model->getAllByCompanyId($cid);

        $this->page_data['page']->title  = 'Solar System Size';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['systemSizes']  = $systemSizes;
        $this->load->view('v2/pages/customer/solar/settings_system_size', $this->page_data);
    }

    /**
     * This function will serve as view of solar lender type page.
     */
    public function settings_solar_modules()
    {
        $this->load->model('AcsSolarInfoProposedModule_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        }   

        $cid = logged('company_id');
        $proposedModules = $this->AcsSolarInfoProposedModule_model->getAllByCompanyId($cid);

        $this->page_data['page']->title = 'Solar Proposed Modules';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['proposedModules']  = $proposedModules;
        $this->load->view('v2/pages/customer/solar/settings_proposed_modules', $this->page_data);
    }

    /**
     * This function will serve as view of solar lender type page.
     */
    public function settings_solar_inverter()
    {
        $this->load->model('AcsSolarInfoProposedInverter_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
            show403Error();
            return false;
        }   

        $cid = logged('company_id');
        $proposedInverters = $this->AcsSolarInfoProposedInverter_model->getAllByCompanyId($cid);

        $this->page_data['page']->title = 'Solar Proposed Inverter';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['proposedInverters']  = $proposedInverters;
        $this->load->view('v2/pages/customer/solar/settings_proposed_inverter', $this->page_data);
    }

    public function ajax_use_quick_note()
    {
        $this->load->model('QuickNote_model');

        $company_id = logged('company_id');
        $post = $this->input->post();

        $quickNote = $this->QuickNote_model->getById($post['qnid']);
        $quickNotes = $this->QuickNote_model->getAllByCompanyId($company_id);

        $this->page_data['quickNote'] = $quickNote;
        $this->page_data['quickNotes'] = $quickNotes;
        $this->load->view('customer/ajax_load_quick_note', $this->page_data);
    }

    public function ajax_send_message_old()
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $msg = '';

        $user_id = logged('id');
        $post = $this->input->post();

        if ($post['message_subject'] != '' && $post['message_body'] != '' && $post['cid'] > 0) {
            $customer = $this->AcsProfile_model->getByProfId($post['cid']);
            if ($customer) {
                $data = [
                    'prof_id' => $customer->prof_id,
                    'customer_email' => $customer->email,
                    'date_sent' => date('Y-m-d'),
                    'subject' => $post['message_subject'],
                    'message' => $post['message_body'],
                    'is_sent' => 0,
                    'date_created' => date('Y-m-d H:i:s'),
                ];

                $last_id = $this->CustomerMessages_model->create($data);

                // Send mail
                $body = $post['message_body'];
                $attachment = '';

                $subject = 'nSmarTrac: '.$post['message_subject'];
                $to = $customer->email;

                $data_email = [
                    'subject' => $subject,
                    'body' => $body,
                    'to' => $to,
                    'cc' => '',
                    'bcc' => '',
                    'attachment' => $attachment,
                ];

                $isSent = sendEmail($data_email);
                if ($isSent['is_valid']) {
                    $cus_data = ['is_sent' => 1];
                    $this->CustomerMessages_model->update($last_id, $cus_data);

                    $is_success = 1;
                } else {
                    $msg = $isSent['err_msg'];
                }
            } else {
                $msg = 'Cannot find customer';
            }
        } else {
            $msg = 'Cannot save data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_delete_customer_message()
    {
        $this->load->model('CustomerMessages_model');

        $is_success = 0;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $customerMessage = $this->CustomerMessages_model->getById($post['mid']);
        if ($customerMessage) {
            if ($customerMessage->company_id == $company_id) {
                $this->CustomerMessages_model->deleteById($customerMessage->id);
                $is_success = 1;
                $msg = 'Record deleted';
            } else {
                $msg = 'Cannot find record';
            }
        } else {
            $msg = 'Cannot find record';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function ajax_welcome_email_form()
    {
        $post = $this->input->post();

        $customer = $this->customer_ad_model->get_data_by_id('prof_id', $post['cid'], 'acs_profile');
        $this->page_data['customer'] = $customer;
        $this->load->view('customer/ajax_welcome_email_form', $this->page_data);
    }

    public function ajax_send_welcome_email()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $msg = '';

        $user_id = logged('id');
        $post = $this->input->post();

        if ($post['message_subject'] != '' && $post['message_body'] != '' && $post['cid'] > 0) {
            $customer = $this->AcsProfile_model->getByProfId($post['cid']);
            if ($customer) {
                // Send mail
                $body = $post['message_body'];
                $attachment = '';

                $subject = 'nSmarTrac: '.$post['message_subject'];
                $to = $customer->email;

                $data_email = [
                    'subject' => $subject,
                    'body' => $body,
                    'to' => $to,
                    'cc' => '',
                    'bcc' => '',
                    'attachment' => $attachment,
                ];

                $isSent = sendEmail($data_email);
                if ($isSent['is_valid']) {
                    customerAuditLog(logged('id'), $customer->prof_id, $customer->prof_id, 'Customer', 'Sent welcome email to '.$customer->email);
                    $is_success = 1;
                } else {
                    $msg = $isSent['err_msg'];
                }
            } else {
                $msg = 'Cannot find customer';
            }
        } else {
            $msg = 'Cannot save data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_update_customer_dispute()
    {
        $this->load->model('CustomerDispute_model');
        $this->load->model('CompanyReason_model');
        $this->load->model('CompanyDisputeInstruction_model');
        $this->load->model('CustomerDisputeItem_model');

        $is_success = false;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $dispute = $this->CustomerDispute_model->getById($post['did']);

        if ($dispute && $dispute->company_id == $company_id) {
            if (!empty($post['creditedBureau'])) {
                $data_dispute = [
                    'furnisher_id' => $post['furnisher_id'],
                    'date_dispute' => $post['dispute_date'],
                    'company_reason_id' => $post['dispute_reason'],
                    'instruction' => $post['dispute_instruction'],
                    'date_modified' => date('Y-m-d H:i:s'),
                ];

                $this->CustomerDispute_model->update($dispute->id, $data_dispute);
                $this->CustomerDisputeItem_model->deleteByCustomerDisputeId($dispute->id);

                foreach ($post['creditedBureau'] as $key => $bureauId) {
                    $account_number = '';
                    if (isset($post['cb_account_number'][$bureauId])) {
                        $account_number = $post['cb_account_number'][$bureauId];
                    }

                    // Other fields
                    $status = '';
                    $other_fields = [];
                    foreach ($post['otherInfo']['individual'][$bureauId] as $field => $value) {
                        if ($field == 'status') {
                            $status = $value;
                        }
                        $other_fields[$field] = ['field' => $field, 'value' => $value];
                    }

                    $other_fields = serialize($other_fields);

                    $data_dispute_item = [
                        'customer_dispute_id' => $dispute->id,
                        'credit_bureau_id' => $bureauId,
                        'account_number`' => $account_number,
                        'status' => $status,
                        'other_fields' => $other_fields,
                        'date_created' => date('Y-m-d H:i:s'),
                        'date_modified' => date('Y-m-d H:i:s'),
                    ];

                    $companyDisputeItems = $this->CustomerDisputeItem_model->create($data_dispute_item);
                }

                $is_success = true;
            } else {
                $msg = 'Please select credit bureau';
            }
        } else {
            $msg = 'Cannot find data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_update_customer_mobile_number()
    {
        $this->load->model('Customer_advance_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $cid = logged('company_id');
        $post = $this->input->post();

        $customer = $this->Customer_advance_model->get_data_by_id('prof_id', $post['cid'], 'acs_profile');
        if ($post['customer_phone'] != '') {
            if ($customer && $customer->company_id == $cid) {
                $data = [
                    'prof_id' => $post['cid'],
                    'phone_m' => $post['customer_phone'],
                ];
                $this->Customer_advance_model->update_data($data, 'acs_profile', 'prof_id');

                $msg = '';
                $is_success = 1;
            } else {
                $msg = 'Cannot find customer data';
            }
        } else {
            $msg = 'Please specify customer mobile number';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_get_messages()
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('Business_model');

        $post = $this->input->post();
        $cid = logged('company_id');
        $profid = $post['profid'];

        $business = $this->Business_model->getByCompanyId($cid);
        $customerMessages = $this->CustomerMessages_model->getAllByProfIdAndCompanyId($profid, $cid);

        $this->page_data['business'] = $business;
        $this->page_data['customerMessages'] = $customerMessages;
        $this->page_data['profid'] = $profid;
        $this->load->view('v2/pages/customer/ajax_get_messages', $this->page_data);
    }

    public function ajax_send_message()
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Business_model');
        $this->load->helper('customer_helper');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $post = $this->input->post();
        $cid = logged('company_id');
        $uid = logged('id');

        if ($post['customer_message'] != '') {
            $customer = $this->AcsProfile_model->getByProfId($post['profid']);
            if ($customer) {
                $data = [
                    'prof_id' => $post['profid'],
                    'user_id' => $uid,
                    'message_date' => date('Y-m-d H:i:s'),
                    'message' => $post['customer_message'],
                    'status' => $this->CustomerMessages_model->statusNew(),
                ];

                $this->CustomerMessages_model->create($data);

                if ($customer->email != '') {
                    // Send mail
                    $customer_login_url = base_url('login/customer');
                    $business = $this->Business_model->getByCompanyId($cid);

                    $subject = 'nSmarTrac : Customer Message';
                    $body = '<p>Hi '.$customer->first_name.',</p><br /><p><b>'.$business->business_name."</b> have sent you a message. To view this message, please login to your account and go to messages.<br /><br />To login, <a href='".$customer_login_url."' target='_blank'>Click here</a></p>";
                    $to = $customer->email;
                    $attachment = '';

                    $data_email = [
                        'subject' => $subject,
                        'body' => $body,
                        'to' => $to,
                        'cc' => '',
                        'bcc' => '',
                        'attachment' => $attachment,
                    ];

                    $isSent = sendEmail($data_email);
                }

                createNotification($post['profid'], 'Messages', 'New Message from '.$business->business_name);

                $msg = '';
                $is_success = 1;
            } else {
                $msg = 'Cannot find customer';
            }
        } else {
            $msg = 'Please enter your message to customer';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_send_login_details()
    {
        $this->load->model('CustomerMessages_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Business_model');

        $is_success = 0;
        $msg = 'Cannot find data.';

        $post = $this->input->post();

        $check = [
            'where' => [
                'fk_prof_id' => $post['cid'],
            ],
            'table' => 'acs_access',
        ];
        $customerAccess = $this->general->get_data_with_param($check, false);

        if ($customerAccess) {
            $customer = $this->AcsProfile_model->getByProfId($post['cid']);
            if ($customer && $customer->email != '') {
                // Send mail
                $customer_login_url = base_url('login/customer');
                // $business = $this->Business_model->getByCompanyId($cid);

                $subject = 'nSmarTrac : Customer Login Details';
                $body = '<p>Hi '.$customer->first_name.',</p><br /><p>Below is your login details.</p><br /><p>Username : '.$customerAccess->access_login.'<br /> Password : '.$customerAccess->access_password.'</p><br />';
                $body .= "<p>To login to your account, click <a href='".$customer_login_url."'>here</a></p>";
                $to = $customer->email;
                $attachment = '';

                $data_email = [
                    'subject' => $subject,
                    'body' => $body,
                    'to' => $to,
                    'cc' => '',
                    'bcc' => '',
                    'attachment' => $attachment,
                ];

                $isSent = sendEmail($data_email);

                $is_success = 1;
                $msg = '';
            } else {
                $msg = 'Cannot find customer data';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_adt_sales_sync_setting()
    {
        $this->load->model('CustomerSettings_model');

        $cid = logged('company_id');
        $filter[] = ['field' => 'setting_type', 'value' => $this->CustomerSettings_model->settingAdtSalesSync()];
        $setting = $this->CustomerSettings_model->getByCompanyId($cid, $filter);

        $this->page_data['setting'] = $setting;
        $this->load->view('v2/pages/customer/ajax_adt_sales_sync_setting', $this->page_data);
    }

    public function ajax_update_adt_sales_sync_setting()
    {
        $this->load->model('CustomerSettings_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $post = $this->input->post();
        $cid = logged('company_id');
        $filter[] = ['field' => 'setting_type', 'value' => 'adt_sales_sync'];
        $setting = $this->CustomerSettings_model->getByCompanyId($cid, $filter);

        if (isSolarCompany() == 0) {
            if ($setting) {
                $data = ['setting_type' => $this->CustomerSettings_model->settingAdtSalesSync(), 'value' => $post['adt_sales_sync']];
                $this->CustomerSettings_model->updateByCustomerSettingId($setting->customer_settings_id, $data);
            } else {
                $data = [
                    'company_id' => $cid,
                    'setting_type' => $this->CustomerSettings_model->settingAdtSalesSync(),
                    'value' => $post['adt_sales_sync'],
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                $this->CustomerSettings_model->create($data);
            }

            $msg = '';
            $is_success = 1;
        } else {
            $msg = 'Cannot upate setting. Only solar industry company can update this feature';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_load_customer_address()
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $post = $this->input->post();

        $filter[] = ['field' => 'company_id', 'value' => $company_id];
        $customer = $this->AcsProfile_model->getByProfId($post['prof_id'], $filter);

        $this->page_data['customer'] = $customer;
        $this->load->view('v2/pages/customer/ajax_load_customer_address', $this->page_data);
    }

    public function ajax_update_address_mobile()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $company_id = logged('company_id');
        $post = $this->input->post();

        $customer = $this->AcsProfile_model->getByProfId($post['cus_prof']);
        if ($customer) {
            $data = [
                'mail_add' => $post['cus_address'],
                'city' => $post['cus_city'],
                'state' => $post['cus_state'],
                'zip_code' => $post['cus_zip'],
                'phone_m' => $post['cus_mobile'],
                'phone_h' => $post['cus_phone'],
            ];

            $this->general->update_with_key_field($data, $post['cus_prof'], 'acs_profile', 'prof_id');
            $is_success = 1;
        }

        $json_data = ['is_success' => $is_success];
        echo json_encode($json_data);
    }

    private function getCustomerGeneratedEsigns($customerId)
    {
        $this->db->where('customer_id', $customerId);
        $attachedGeneratedPDFEntries = $this->db->get('user_docfile_customer_attached_generated_pdfs')->result();

        $attachedGeneratedPDFs = [];
        if (count($attachedGeneratedPDFEntries)) {
            $generatedPDFIds = array_map(function ($entry) {
                return $entry->generated_pdf_id;
            }, $attachedGeneratedPDFEntries);

            $this->db->where_in('id', $generatedPDFIds);
            $attachedGeneratedPDFs = $this->db->get('user_docfile_generated_pdfs')->result_array();

            // mark as imported
            $attachedGeneratedPDFs = array_map(function ($attachedGeneratedPDF) use ($attachedGeneratedPDFEntries) {
                foreach ($attachedGeneratedPDFEntries as $entry) {
                    if ($entry->generated_pdf_id == $attachedGeneratedPDF['id']) {
                        $attachedGeneratedPDF['attached_generated_pdf_entry'] = $entry;
                    }
                }

                return $attachedGeneratedPDF;
            }, $attachedGeneratedPDFs);
        }

        $this->db->select(['id']);
        $this->db->where('customer_id', $customerId);
        $customerJobs = $this->db->get('jobs')->result();
        $jobIds = array_map(function ($item) { return $item->id; }, $customerJobs);

        if (empty($jobIds)) {
            return $attachedGeneratedPDFs;
        }

        $this->db->select(['user_docfile_recipient_id']);
        $this->db->where_in('job_id', $jobIds);
        $docfileRecipients = $this->db->get('user_docfile_job_recipients')->result();
        $recipientIds = array_map(function ($item) { return $item->user_docfile_recipient_id; }, $docfileRecipients);

        if (empty($recipientIds)) {
            return $attachedGeneratedPDFs;
        }

        $this->db->select(['docfile_id']);
        $this->db->where_in('id', $recipientIds);
        $docfiles = $this->db->get('user_docfile_recipients')->result();
        $docfileIds = array_map(function ($item) { return $item->docfile_id; }, $docfiles);

        if (empty($docfileIds)) {
            return $attachedGeneratedPDFs;
        }

        $this->db->where_in('docfile_id', $docfileIds);
        $generatedPDFs = $this->db->get('user_docfile_generated_pdfs')->result_array();
        $generatedPDFs = array_merge($generatedPDFs, $attachedGeneratedPDFs);

        // remove duplicates
        return array_reduce($generatedPDFs, function ($carry, $generatedPDF) {
            foreach ($carry as $existing) {
                if ($existing['id'] === $generatedPDF['id']) {
                    return $carry;
                }
            }

            array_push($carry, $generatedPDF);

            return $carry;
        }, []);
    }

    public function apiAttachGeneratedEsign()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            exit(json_encode(['success' => false]));
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $documentId = $payload['esign_id'] ?? null;
        $customerId = $payload['customer_id'] ?? null;

        $customerGeneratedEsigns = $this->getCustomerGeneratedEsigns($customerId);

        foreach ($customerGeneratedEsigns as $esign) {
            if ($esign['docfile_id'] == $documentId) {
                // makes sure esign is not owned by the customer
                exit(json_encode(['success' => true]));
            }
        }

        $this->db->where('docfile_id', $documentId);
        $generatedPDF = $this->db->get('user_docfile_generated_pdfs')->row();

        $attachedGeneratedPDFId = null;
        if ($generatedPDF) {
            $this->db->where('customer_id', $customerId);
            $this->db->where('generated_pdf_id', $generatedPDF->id);
            $attachedPDF = $this->db->get('user_docfile_customer_attached_generated_pdfs')->row();

            if (!$attachedPDF) {
                $this->db->insert('user_docfile_customer_attached_generated_pdfs', [
                    'customer_id' => $customerId,
                    'generated_pdf_id' => $generatedPDF->id,
                ]);
                $attachedGeneratedPDFId = $this->db->insert_id();
            }
        }

        $generatedPDF = null;
        if ($attachedGeneratedPDFId) {
            $this->db->where('docfile_id', $documentId);
            $generatedPDF = $this->db->get('user_docfile_generated_pdfs')->row();

            $this->db->where('id', $attachedGeneratedPDFId);
            $generatedPDF->attached_generated_pdf_entry = $this->db->get('user_docfile_customer_attached_generated_pdfs')->row();
        }

        exit(json_encode(['success' => true, 'data' => $generatedPDF]));
    }

    public function apiDeleteAttachedGeneratedEsign()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            exit(json_encode(['success' => false]));
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->where('id', $payload['id']);
        $this->db->delete('user_docfile_customer_attached_generated_pdfs');
        exit(json_encode(['success' => true]));
    }

    public function ajax_get_phone_number()
    {
        $this->load->model('Customer_advance_model');

        $customer_name = '';
        $customer_phone = '';

        $post = $this->input->post();
        $customer = $this->Customer_advance_model->get_data_by_id('prof_id', $post['profid'], 'acs_profile');
        if ($customer) {
            $customer_name = $customer->first_name.' '.$customer->last_name;
            if ($customer->phone_m != '') {
                $customer_phone = $customer->phone_m;
            }
        }

        $return = ['name' => $customer_name, 'phone' => $customer_phone];
        echo json_encode($return);
    }

    public function editCustomerStatus()
    {
        $input = $this->input->post();
        $data = [
            'id' => $input['statusID'],
            'name' => $input['statusName'],
        ];
        $updateStatus = $this->customer_ad_model->update_data($data, 'acs_cust_status', 'id');
        if ($updateStatus) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function ajax_load_esign_doc()
    {
        $this->load->model('UserCustomerDocfile_model');

        $post = $this->input->post();

        $search_query = '';
        if (isset($post['search_query']) && $post['search_query'] != '') {
            $search_query = $post['search_query'];
        }

        $esignDoc = $this->UserCustomerDocfile_model->getAllNotCompletedByCustomerId($post['cid'], $search_query);
        $this->page_data['esignDoc'] = $esignDoc;
        $this->load->view('v2/pages/customer/ajax_load_esign_doc', $this->page_data);
    }

    public function ajax_check_customer_esign_pdf()
    {
        $this->load->model('UserCustomerDocfile_model');

        $msg = 'Cannot find data';
        $is_valid = 0;
        $path = '';

        $cid = logged('company_id');
        $post = $this->input->post();

        $esignPDF = $this->UserCustomerDocfile_model->getByUserDocfileGeneratedPdfId($post['pid']);
        if ($esignPDF && $esignPDF->company_id == $cid) {
            $path = ltrim($esignPDF->path, '/');
            $is_valid = 1;
            $msg = '';
        }

        $json = ['is_valid' => $is_valid, 'msg' => $msg, 'path' => $path];
        echo json_encode($json);
        exit;
    }

    public function downloadEsignDoc()
    {
        $this->load->model('UserCustomerDocfile_model');

        $post = $this->input->post();
        $esignFiles = [];

        foreach ($post['esignPdf'] as $pdfid) {
            $esignPdf = $this->UserCustomerDocfile_model->getEsignPdfById($pdfid);
            if ($esignPdf) {
                $a_file = explode('/', $esignPdf->path);
                $esignFiles[] = $a_file[3];
            }
        }
        $filesPath = 'uploads/docusigngeneratedpdfs';
        $zipName = 'esign.zip';

        echo $this->createZipAndDownload($esignFiles, $filesPath, $zipName);
        exit;
    }

    public function createZipAndDownload($files, $filesPath, $zipFileName)
    {
        // Create instance of ZipArchive. and open the zip folder.
        $zip_file = './uploads/'.$zipFileName;
        touch($zip_file); // just create a zip file

        $zip = new \ZipArchive();
        if ($zip->open($zip_file, \ZipArchive::CREATE) !== true) {
            exit("cannot open <$zipFileName>\n");
        }

        foreach ($files as $file) {
            $zip->addFile($filesPath.'/'.$file, $file);
        }
        $zip->close();

        // Download the created zip file
        header('Content-Type: application/force-download');
        header('Content-type: application/zip');
        header("Content-Disposition: attachment; filename = $zipFileName");
        header('Content-length: '.filesize($zip_file));
        header('Pragma: no-cache');
        header('Expires: 0');
        ob_clean();
        flush();
        readfile("$zip_file");
        unlink($zip_file);
    }

    public function ajax_delete_esign_documents()
    {
        $this->load->model('UserCustomerDocfile_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $total_deleted = 0;
        foreach ($post['esignPdf'] as $eid) {
            $isExists = $this->UserCustomerDocfile_model->getById($eid);
            if ($isExists) {
                $this->UserCustomerDocfile_model->delete($eid);
                ++$total_deleted;
            }
        }

        if ($total_deleted > 0) {
            $is_success = 1;
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function ajax_load_customer_sms_messages()
    {
        $this->load->model('CompanySms_model');

        $post = $this->input->post();
        $customerSentSms = $this->CompanySms_model->getAllByProfId($post['cid']);
        $this->page_data['customerSentSms'] = $customerSentSms;
        $this->load->view('v2/pages/customer/ajax_load_customer_sms_messages', $this->page_data);
    }

    public function ajax_send_email()
    {
        $this->load->model('AcsSentEmail_model');
        $this->load->model('AcsProfile_model');

        $is_success = 1;
        $msg = 'Cannot find customer data';

        $post = $this->input->post();
        if ($post['customer_email_suject'] == '') {
            $msg = 'Please enter email subject';
            $is_success = 0;
        }

        if ($post['customer_email'] == '') {
            $msg = 'Please enter customer email';
            $is_success = 0;
        }

        if ($post['customer_email_message'] == '') {
            $msg = 'Please enter email message';
            $is_success = 0;
        }

        $customer = $this->AcsProfile_model->getByProfId($post['cid']);
        if ($customer && $is_success == 1) {
            $cid = logged('company_id');
            $uid = logged('id');
            $data_acs_emails = [
                'company_id' => $cid,
                'user_id' => $uid,
                'customer_id' => $customer->prof_id,
                'to_email' => $post['customer_email'],
                'subject' => $post['customer_email_suject'],
                'message' => $post['customer_email_message'],
                'is_sent' => 1,
                'date_created' => date('Y-m-d H:i:s'),
            ];

            $this->AcsSentEmail_model->create($data_acs_emails);

            // Send Email
            $mail = email__getInstance();
            $mail->FromName = 'nSmarTrac';
            $mail->addAddress($post['customer_email'], $post['customer_email']);
            $mail->isHTML(true);
            $mail->Subject = $post['customer_email_suject'];
            $mail->Body = $post['customer_email_message'];
            $sendEmail = $mail->Send();

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function ajax_lead_send_email()
    {
        $is_success = 1;
        $msg = 'Cannot send email';

        $post = $this->input->post();
        if ($post['lead_email_suject'] == '') {
            $msg = 'Please enter email subject';
            $is_success = 0;
        }

        if ($post['lead_email'] == '') {
            $msg = 'Please enter customer email';
            $is_success = 0;
        }

        if ($post['lead_email_message'] == '') {
            $msg = 'Please enter email message';
            $is_success = 0;
        }

        if ($is_success == 1) {
            // Send Email
            $mail = email__getInstance();
            $mail->FromName = 'nSmarTrac';
            $mail->addAddress($post['lead_email'], $post['lead_email']);
            $mail->isHTML(true);
            $mail->Subject = $post['lead_email_suject'];
            $mail->Body = $post['lead_email_message'];
            $sendEmail = $mail->Send();

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function ajax_delete_customer()
    {
        $this->load->model('Customer_model');
        $is_success = 0;
        $msg = 'Cannot find customer data';

        $company_id = logged('company_id');
        $post = $this->input->post();
        $customer = $this->Customer_model->getCustomer($post['cid']);
        if ($customer && $customer->company_id == $company_id) {
            $customer_name = $customer->first_name . ' ' . $customer->last_name;
            $this->Customer_model->deleteCustomer($post['cid']);

            //Activity Logs
            $activity_name = 'Customer : Deleted customer  ' . $customer_name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function ajax_add_customer_status()
    {
        $is_success = 0;
        $msg = 'Cannot save data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        if ($post['name'] != '') {
            $post['company_id'] = logged('company_id');
            if ($this->customer_ad_model->add($post, 'acs_cust_status')) {
                $is_success = 1;
                $msg = '';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function ajax_update_customer_status()
    {
        $this->load->model('CustomerStatus_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg  = 'Cannot find data';
        $post = $this->input->post();
        $cid  = logged('company_id');

        if ($post['name'] != '') {
            $customerStatus = $this->CustomerStatus_model->getByIdAndCompanyId($post['cs_id'], $cid);
            $isExists       = $this->CustomerStatus_model->getByNameAndCompanyId($post['name'], $cid);
            if( $isExists && $isExists->id != $post['cs_id'] ){
                $msg = 'Status name ' . $post['name'] . ' already exists.';
            }else{
                if( $customerStatus ){
                    $data = ['name' => $post['name']];
                    $this->CustomerStatus_model->update($customerStatus->id, $data);
                    
                    //Activity Logs
                    $activity_name = 'Customer Status : Updated status  ' . $isExists->name . ' changed to ' . $post['name']; 
                    createActivityLog($activity_name);

                    $is_success = 1;
                    $msg = '';
                }                
            }               
        }else{
            $msg  = 'Please enter status name';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function ajax_delete_customer_status()
    {
        $this->load->model('CustomerStatus_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $cid  = logged('company_id');
        $customerStatus = $this->CustomerStatus_model->getByIdAndCompanyId($post['csid'], $cid);
        if( $customerStatus ){
            //Activity Logs
            $activity_name = 'Customer Status : Deleted status  ' . $customerStatus->name; 
            createActivityLog($activity_name);

            $this->CustomerStatus_model->delete($customerStatus->id);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($return);
        exit;
    }

    public function ajax_get_customer_data()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('AcsAccess_model');

        $customer_id = $this->input->post('customer_id');
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getdataAjax($customer_id);
        if ($customer->phone_m != '') {
            $customer->phone_m = formatPhoneNumber($customer->phone_m);
        } else {
            $customer->phone_m = 'Not Specified';
        }

        if ($customer->phone_h != '') {
            $customer->phone_h = formatPhoneNumber($customer->phone_h);
        } else {
            $customer->phone_h = 'Not Specified';
        }

        if ($customer->business_name == '' || $customer->business_name == null) {
            $customer->business_name = 'Not Specified';
        }

        if ($customer->date_of_birth == '' || $customer->date_of_birth == null) {
            $customer->date_of_birth = date('m/d/Y');
        }

        if ($customer->ssn == '' || $customer->ssn == null) {
            $customer->ssn = 'Not Specified';
        }

        if ($customer->state == '' || $customer->state == null) {
            $customer->state = '';
        }

        if ($customer->country == '' || $customer->country == null) {
            $customer->country = 'Not Specified';
        }

        if ($customer->country == '' || $customer->country == null) {
            $customer->country = 'Not Specified';
        }

        if ($customer->cross_street == '' || $customer->cross_street == null) {
            $customer->cross_street = '';
        }

        if ($customer->cross_street == '' || $customer->cross_street == null) {
            $customer->cross_street = '';
        }

        $acsAccess = $this->AcsAccess_model->getByProfId($customer_id);
        if ($acsAccess) {
            $customer->access_password = $acsAccess->access_password;
        } else {
            $customer->access_password = 'Not Specified';
        }

        echo json_encode($customer);
    }

    public function ajax_quick_add_customer()
    {
        $is_valid = 1;
        $msg = '';
        $customer = [];

        $cid = logged('company_id');
        $post = $this->input->post();

        if ($post['first_name'] == '' || $post['last_name'] == '') {
            $is_valid = 0;
            $msg = 'Please enter customer name';
        }

        if ($post['email'] == '') {
            $is_valid = 0;
            $msg = 'Please enter customer email';
        }

        if ($post['customer_type'] == '') {
            $is_valid = 0;
            $msg = 'Please select customer type';
        }

        if ($is_valid == 1) {
            $post['company_id'] = $cid;
            $post['status'] = 'New';

            $prof_id = $this->customer_ad_model->add($post, 'acs_profile');

            $customer = [
                'id' => $prof_id,
                'name' => $post['first_name'].' '.$post['last_name'],
            ];
        }

        $json_data = ['is_success' => $is_valid, 'msg' => $msg, 'customer' => $customer];
        echo json_encode($json_data);
    }

    public function ajax_get_lead_data()
    {
        $this->load->model('Customer_advance_model');

        $lead_id = $this->input->post('lead_id');
        $company_id = logged('company_id');

        $lead = $this->Customer_advance_model->getLeadByLeadId($lead_id);
        if ($lead->phome_cell != '' && $lead->phone_cell != 'NULL') {
            $lead->phome_cell = formatPhoneNumber($lead->phome_cell);
        } else {
            $lead->phone_m = 'Not Specified';
        }

        if ($lead->phone_home != '' && $lead->phone_home != 'NULL') {
            $lead->phone_home = formatPhoneNumber($lead->phone_home);
        } else {
            $lead->phone_home = 'Not Specified';
        }

        if ($lead->date_of_birth == '' || $lead->date_of_birth == 'NULL') {
            $lead->date_of_birth = date('m/d/Y');
        }

        if ($lead->sss_num == '' || $lead->sss_num == 'NULL') {
            $lead->sss_num = 'Not Specified';
        }

        if ($lead->state == '' || $lead->state == 'NULL') {
            $lead->state = '';
        }

        if ($lead->country == '' || $lead->country == 'NULL') {
            $lead->country = 'Not Specified';
        }

        if ($lead->county == '' || $customleader->county == 'NULL') {
            $lead->county = 'Not Specified';
        }

        if ($lead->address == '' || $lead->address == 'NULL') {
            $lead->lead = '';
        }

        echo json_encode($lead);
    }

    public function ajax_quick_add_lead()
    {
        $is_valid = 1;
        $msg      = '';      
        $customer = [];  

        $is_automation_activated  = enableAutomationActivated();

        $cid  = logged('company_id');
        $post = $this->input->post();

        if( $post['first_name'] == '' || $post['last_name'] == ''){
            $is_valid = 0;
            $msg = 'Please enter lead name';
        }

        if( $post['email'] == '' ){
            $is_valid = 0;
            $msg = 'Please enter lead email';
        }

        if( $is_valid == 1 ){
            $lead_data = [
                'company_id' => $cid,
                'firstname' => $post['first_name'],
                'middlename' => $post['middle_name'],
                'lastname' => $post['last_name'],
                'address' => $post['address'],
                'city' => $post['city'],
                'state' => $post['state'],
                'zip' => $post['zip_code'],
                'phone_home' => $post['phone_home'],
                'phone_cell' => $post['phone_cell'],
                'email_add' => $post['email'],
                'sss_num' => $post['sss_num'],
                'status' => 'New',
                'date_created' => date("Y-m-d H:i:s")
            ];

            $lead_id = $this->customer_ad_model->createLead($lead_data);

            $customer = [
                'id' => $lead_id,
                'name' => $post['first_name'] . ' ' . $post['last_name']
            ];

            //Add automation queue - start
            if($is_automation_activated) {
                createAutomationQueueV2('send_email', 'lead', 'created', '', $lead_id);  
                createAutomationQueueV2('send_email', 'lead', 'scheduled', '', $lead_id);  
            }
            //Add automation queue - end

        }

        $json_data = ['is_success' => $is_valid, 'msg' => $msg, 'customer' => $customer];
        echo json_encode($json_data);
    }

    public function ajax_convert_lead_to_customer()
    {
        $is_success = 0;
        $msg        = 'Cannot find data';
        $prof_id    = 0;

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $lead = $this->customer_ad_model->getByLeadId($post['lead_id']);
        if( $lead ){
            $result = $this->customer_ad_model->convertLeadToCustomer($post['lead_id'], $cid, $uid);
            
            if( $result['is_converted'] == 1 ){

                //Activity Logs
                $activity_name = 'Converted Lead ' . $lead->firstname . ' ' . $lead->lastname . ' to Customer'; 
                createActivityLog($activity_name);

                $prof_id = $result['prof_id'];
                $is_success = 1;
                $msg = '';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg, 'prof_id' => $prof_id];
        echo json_encode($json_data);
    }

    public function export_residential_list()
    {
        $this->load->model('Users_model');

        $user_id = logged('id');
        $items = $this->customer_ad_model->getResidentialExportData();

        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];
        $importFieldsList = $this->general->get_data_with_param($getImportFields);
        $emergency_contacts_fields = ['contact_name1', 'first_relation', 'contact_phone1', 'contact_name2', 'second_relation', 'contact_phone2', 'contact_name3', 'third_relation', 'contact_phone3'];

        $getCompanyImportSettings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'export',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];
        $importFieldSettings = $this->general->get_data_with_param($getCompanyImportSettings, false);
        if ($importFieldSettings->value != '') {
            $fieldCompanyValues = explode(',', $importFieldSettings->value);
        } else {
            $fieldCompanyValues = ['5', '6', '7', '8', '9', '10', '11'];
        }

        $fields = [];
        $fieldNames = [];
        $is_with_emergency_contacts = 0;
        foreach ($fieldCompanyValues as $field) {
            foreach ($importFieldsList as $importSetting) {
                if ($field == $importSetting->id) {
                    array_push($fields, $importSetting->field_description);
                    array_push($fieldNames, $importSetting->field_name);
                    if (in_array($importSetting->field_name, $emergency_contacts_fields)) {
                        $is_with_emergency_contacts = 0;
                    }
                }
            }
        }

        $delimiter = ',';
        $time = time();
        $filename = 'residential_customers_list_'.$time.'.csv';
        $f = fopen('php://memory', 'w');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $item) {
                if ($is_with_emergency_contacts == 1) {
                    $eContacts = [];
                    $emergencyContacts = $this->customer_ad_model->getAllCustomerEmergencyContactsByCustomerId($item->prof_id);
                    foreach ($emergencyContacts as $e) {
                        $eContacts[] = $e;
                    }
                }

                // if( $item->prof_id == 4898 ){
                //     echo "<pre>";
                //     print_r($fieldNames);
                //     print_r($eContacts);
                //     exit;
                // }
                $csvData = [];
                foreach ($fieldNames as $fieldName) {
                    $is_custom_field = 0;
                    if ($fieldName == 'customer_group_id') {
                        $customerGroup = $this->customer_ad_model->getCustomerGroupById($item->$fieldName);
                        if ($customerGroup) {
                            array_push($csvData, $customerGroup->name);
                        } else {
                            array_push($csvData, '---');
                        }

                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'fk_sa_id') {
                        $salesArea = $this->customer_ad_model->getASalesAreaById($item->$fieldName);
                        if ($salesArea) {
                            array_push($csvData, $salesArea->sa_name);
                        } else {
                            array_push($csvData, '---');
                        }

                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'fk_sales_rep_office' || $fieldName == 'technician') {
                        $user = $this->Users_model->getUserByID($item->$fieldName);
                        if ($user) {
                            $name = $user->FName.' '.$user->LName;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name1') {
                        if (isset($eContacts[0])) {
                            $name = $eContacts[0]->first_name.' '.$eContacts[0]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'first_relation') {
                        if (isset($eContacts[0])) {
                            array_push($csvData, $eContacts[0]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone1') {
                        if (isset($eContacts[0])) {
                            array_push($csvData, $eContacts[0]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name2') {
                        if (isset($eContacts[1])) {
                            $name = $eContacts[1]->first_name.' '.$eContacts[1]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'second_relation') {
                        if (isset($eContacts[1])) {
                            array_push($csvData, $eContacts[1]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone2') {
                        if (isset($eContacts[1])) {
                            array_push($csvData, $eContacts[1]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name3') {
                        if (isset($eContacts[2])) {
                            $name = $eContacts[2]->first_name.' '.$eContacts[2]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'third_relation') {
                        if (isset($eContacts[2])) {
                            array_push($csvData, $eContacts[2]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone3') {
                        if (isset($eContacts[2])) {
                            array_push($csvData, $eContacts[2]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($is_custom_field == 0) {
                        
                        if( $fieldName == 'bill_start_date' || $fieldName == 'bill_end_date' || $fieldName == 'date_of_birth' ){
                            $date = '---';
                            if( strtotime($item->$fieldName) > 0 ){
                                $date = date("m/d/Y", strtotime($item->$fieldName));                                
                            }

                            array_push($csvData, $date);
                        }else{
                            if (trim($item->$fieldName) != '') {
                                array_push($csvData, $item->$fieldName);
                            } else {
                                array_push($csvData, '---');
                            }
                        }

                        
                    }
                }
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = [''];
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fpassthru($f);
    }

    public function export_commercial_list()
    {
        $this->load->model('Users_model');

        $user_id = logged('id');
        $items = $this->customer_ad_model->getCommercialExportData();

        $getImportFields = [
            'table' => 'acs_import_fields',
            'select' => '*',
        ];
        $importFieldsList = $this->general->get_data_with_param($getImportFields);
        $emergency_contacts_fields = ['contact_name1', 'first_relation', 'contact_phone1', 'contact_name2', 'second_relation', 'contact_phone2', 'contact_name3', 'third_relation', 'contact_phone3'];

        $getCompanyImportSettings = [
            'where' => [
                'company_id' => logged('company_id'),
                'setting_type' => 'export',
            ],
            'table' => 'customer_settings',
            'select' => '*',
        ];
        $importFieldSettings = $this->general->get_data_with_param($getCompanyImportSettings, false);
        if ($importFieldSettings->value != '') {
            $fieldCompanyValues = explode(',', $importFieldSettings->value);
        } else {
            $fieldCompanyValues = ['5', '6', '7', '8', '9', '10', '11'];
        }

        $fields = [];
        $fieldNames = [];
        $is_with_emergency_contacts = 0;
        foreach ($fieldCompanyValues as $field) {
            foreach ($importFieldsList as $importSetting) {
                if ($field == $importSetting->id) {
                    array_push($fields, $importSetting->field_description);
                    array_push($fieldNames, $importSetting->field_name);
                    if (in_array($importSetting->field_name, $emergency_contacts_fields)) {
                        $is_with_emergency_contacts = 0;
                    }
                }
            }
        }

        $delimiter = ',';
        $time = time();
        $filename = 'commercial_customers_list_'.$time.'.csv';
        $f = fopen('php://memory', 'w');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $item) {
                if ($is_with_emergency_contacts == 1) {
                    $eContacts = [];
                    $emergencyContacts = $this->customer_ad_model->getAllCustomerEmergencyContactsByCustomerId($item->prof_id);
                    foreach ($emergencyContacts as $e) {
                        $eContacts[] = $e;
                    }
                }

                // if( $item->prof_id == 4898 ){
                //     echo "<pre>";
                //     print_r($fieldNames);
                //     print_r($eContacts);
                //     exit;
                // }
                $csvData = [];
                foreach ($fieldNames as $fieldName) {
                    $is_custom_field = 0;
                    if ($fieldName == 'customer_group_id') {
                        $customerGroup = $this->customer_ad_model->getCustomerGroupById($item->$fieldName);
                        if ($customerGroup) {
                            array_push($csvData, $customerGroup->name);
                        } else {
                            array_push($csvData, '---');
                        }

                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'fk_sa_id') {
                        $salesArea = $this->customer_ad_model->getASalesAreaById($item->$fieldName);
                        if ($salesArea) {
                            array_push($csvData, $salesArea->sa_name);
                        } else {
                            array_push($csvData, '---');
                        }

                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'fk_sales_rep_office' || $fieldName == 'technician') {
                        $user = $this->Users_model->getUserByID($item->$fieldName);
                        if ($user) {
                            $name = $user->FName.' '.$user->LName;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name1') {
                        if (isset($eContacts[0])) {
                            $name = $eContacts[0]->first_name.' '.$eContacts[0]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'first_relation') {
                        if (isset($eContacts[0])) {
                            array_push($csvData, $eContacts[0]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone1') {
                        if (isset($eContacts[0])) {
                            array_push($csvData, $eContacts[0]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name2') {
                        if (isset($eContacts[1])) {
                            $name = $eContacts[1]->first_name.' '.$eContacts[1]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'second_relation') {
                        if (isset($eContacts[1])) {
                            array_push($csvData, $eContacts[1]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone2') {
                        if (isset($eContacts[1])) {
                            array_push($csvData, $eContacts[1]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_name3') {
                        if (isset($eContacts[2])) {
                            $name = $eContacts[2]->first_name.' '.$eContacts[2]->last_name;
                            array_push($csvData, $name);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'third_relation') {
                        if (isset($eContacts[2])) {
                            array_push($csvData, $eContacts[2]->relation);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($fieldName == 'contact_phone3') {
                        if (isset($eContacts[2])) {
                            array_push($csvData, $eContacts[2]->phone);
                        } else {
                            array_push($csvData, '---');
                        }
                        $is_custom_field = 1;
                    }

                    if ($is_custom_field == 0) {
                        
                        if( $fieldName == 'bill_start_date' || $fieldName == 'bill_end_date' || $fieldName == 'date_of_birth' ){
                            $date = '---';
                            if( strtotime($item->$fieldName) > 0 ){
                                $date = date("m/d/Y", strtotime($item->$fieldName));                                
                            }
                            array_push($csvData, $date);
                        }else{
                            if (trim($item->$fieldName) != '') {
                                array_push($csvData, $item->$fieldName);
                            } else {
                                array_push($csvData, '---');
                            }
                        }
                        
                    }

                    if ($is_custom_field == 0) {
                        if (trim($item->$fieldName) != '') {
                            array_push($csvData, $item->$fieldName);
                        } else {
                            array_push($csvData, '---');
                        }
                    }
                }
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = [''];
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fpassthru($f);
    }

    public function toolContent($tool)
    {
        $company_id = logged('company_id');
        $postData = $this->input->post('statusFilter');
        $page = "";

        $getMonitoringIds = [
            'select' => 'acs_alarm.monitor_id',
            'table' => 'acs_alarm',
            'join' => [
                [
                    'table' => 'acs_profile',
                    'statement' => 'acs_profile.prof_id = acs_alarm.fk_prof_id',
                    'join_as' => 'left'
                ]
            ],
            'where' => [
                'acs_profile.company_id' => $company_id,
                'acs_alarm.monitor_id !=' => '',
            ],
            'order' => [
                'order_by' => 'acs_alarm.monitor_id',
                'ordering' => 'ASC'
            ],
            'groupBy' => 'acs_alarm.monitor_id'
        ];

        $getCustomerStatus = [
            'select' => '*',
            'table' => 'acs_cust_status',
            'where' => ['company_id' => $company_id],
        ];

        $getCustomerGroup = [
            'select' => '*',
            'table' => 'customer_groups',
            'where' => ['company_id' => $company_id],
        ];

        $getSalesArea = [
            'select' => '*',
            'table' => 'ac_salesarea',
            'where' => ['fk_comp_id' => $company_id],
        ];

        $getRatePlanData = [
            'select' => '*',
            'table' => 'ac_rateplan',
            'where' => ['company_id' => $company_id],
        ];

        $getCustomerStatusData = [
            'select' => '*',
            'table' => 'acs_cust_status',
            'where' => ['company_id' => $company_id],
        ];

        $getSalesRepData = [
            'select' => '*',
            'table' => 'users',
            'where' => ['company_id' => $company_id,],
        ];

        $getTechnicianData = [
            'select' => '*',
            'table' => 'users',
            'where' => ['company_id' => $company_id,],
        ];

        switch ($tool) {
            case 'batchUpdater':
                $page = "batch_updater_tool";
                break;
            case 'duplicateManagement':
                $page = "duplicate_management_tool";
                break;
        }

        
        if ($postData === 'active_only') {
            $getMonitoringIds['where_in'] = [
                'acs_profile.status' => [
                    'Active w/RAR',
                    'Active w/RMR',
                    'Active w/RQR',
                    'Active w/RYR',
                    'Inactive w/RMM',
                    'Inactive w/RMR'
                ]
            ];

            $getCustomerStatusData['where_in'] = [
                'acs_cust_status.name' => [
                    'Active w/RAR',
                    'Active w/RMR',
                    'Active w/RQR',
                    'Active w/RYR',
                    'Inactive w/RMM',
                    'Inactive w/RMR'
                ]
            ];
        }

        $this->page_data['status_filter'] = $postData;
        $this->page_data['rate_plan'] = $this->general->get_data_with_param($getRatePlanData);
        $this->page_data['customer_status'] = $this->general->get_data_with_param($getCustomerStatus);
        $this->page_data['customer_group'] = $this->general->get_data_with_param($getCustomerGroup);
        $this->page_data['sales_area'] = $this->general->get_data_with_param($getSalesArea);
        $this->page_data['customer_status'] = $this->general->get_data_with_param($getCustomerStatusData);
        $this->page_data['salesRep'] = $this->general->get_data_with_param($getSalesRepData);
        $this->page_data['technician'] = $this->general->get_data_with_param($getTechnicianData);
        $this->page_data['monitoring_ids'] = $this->general->get_data_with_param($getMonitoringIds);
        $this->load->view("v2/pages/customer/$page", $this->page_data);
    }

    public function ajax_quick_search()
    {
        $post = trim($this->input->post('customer_query'));
        $company_id = logged('company_id');
    
        $nameFilter = "";
        if (!empty($post)) {
            $nameFilter = " AND ( customer_list_view.profile_business_name LIKE '%{$post}%' OR customer_list_view.customer_name LIKE '%{$post}%' )";
        }
    
        $query = $this->db->query("
            SELECT 
                customer_list_view.prof_id AS prof_id,
                customer_list_view.company_id AS company_id,
                customer_list_view.customer_no AS customer_no,
                CASE 
                    WHEN customer_list_view.profile_business_name IS NOT NULL 
                        AND customer_list_view.profile_business_name != '' 
                        AND customer_list_view.profile_business_name != 'Not Specified' 
                    THEN customer_list_view.profile_business_name
                    ELSE customer_list_view.customer_name
                END AS name,
                customer_list_view.profile_email AS email
            FROM customer_list_view
            WHERE customer_list_view.company_id = {$company_id}
            {$nameFilter}
            ORDER BY customer_list_view.prof_id DESC;
        ");
    
        $customers = $query->result();
        $this->page_data['customers'] = $customers;
        $this->load->view("v2/pages/customer/ajax_quick_search_result", $this->page_data);
    }
    
    public function ajax_archived_list()
    {
        $this->load->model('Customer_model');

        if(!checkRoleCanAccessModule('customers', 'delete')){
			show403Error();
			return false;
		}

        $post = $this->input->post();
        $cid  = logged('company_id');

        $customers = $this->Customer_model->getAllArchivedByCompany($cid,[]);

        $this->page_data['customers'] = $customers;
        $this->load->view("v2/pages/customer/ajax_archived_list", $this->page_data);
    }

    public function ajax_restore_archived()
    {
        $this->load->model('Customer_model');

        $is_success = 0;
        $msg = 'Cannot find customer data';

        $company_id = logged('company_id');
        $post = $this->input->post();
        $customer = $this->Customer_model->getCustomer($post['cid']);
        if ($customer && $customer->company_id == $company_id) {                        
            $this->Customer_model->restoreCustomer($post['cid']);

            //Activity Logs
            $customer_name = $customer->first_name . ' ' . $customer->last_name;
            $activity_name = 'Customer : Restore customer data  ' . $customer_name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_add_to_favorites()
    {
        $this->load->model('Customer_model');

        $is_success = 0;
        $msg = 'Cannot find customer data';

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $customer = $this->Customer_model->getCustomer($post['cid']);
        if ($customer && $customer->company_id == $company_id) {                        
            $this->Customer_model->addToFavorite($post['cid']);

            //Activity Logs
            $customer_name = $customer->first_name . ' ' . $customer->last_name;
            $activity_name = 'Customer : Added customer ' . $customer_name . ' to favorite list'; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_favorite_list()
    {
        $this->load->model('Customer_model');

        $post = $this->input->post();
        $cid  = logged('company_id');

        $customers = $this->Customer_model->getAllFavoritesByCompanyId($cid,[]);

        $this->page_data['customers'] = $customers;
        $this->load->view("v2/pages/customer/ajax_favorite_list", $this->page_data);
    }

    public function ajax_remove_favorite()
    {
        $this->load->model('Customer_model');

        $is_success = 0;
        $msg = 'Cannot find customer data';

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $customer = $this->Customer_model->getCustomer($post['cid']);
        if ($customer && $customer->company_id == $company_id) {                        
            $this->Customer_model->removeToFavorite($post['cid']);

            //Activity Logs
            $customer_name = $customer->first_name . ' ' . $customer->last_name;
            $activity_name = 'Customer : Removed customer ' . $customer_name . ' from favorite list'; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_financing_category()
    {
        $this->load->model('FinancingPaymentCategory_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg   = 'Cannot save data';
        $name  = '';
        $value = '';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        $isExists = $this->FinancingPaymentCategory_model->getByNameAndCompanyId($post['category_name'], $company_id);
        if( $isExists ){
            $msg   = 'Category name ' . $post['category_name'] . ' already exists.';
        }else{
            $data = [
                'company_id' => $company_id,
                'name' => $post['category_name'],
                'value' => $post['category_value'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
    
            $this->FinancingPaymentCategory_model->create($data);
            $name  = $post['category_name'];
            $value = $post['category_value'];
    
            //Activity Logs
            $activity_name = 'Financing Payment Category : Created ' . $post['category_name']; 
            createActivityLog($activity_name);
    
            $is_success = 1;
            $msg = '';
        }        

        $return = ['is_success' => $is_success, 'msg' => $msg, 'name' => $name, 'value' => $value];
        echo json_encode($return);
    }

    public function settings_financing_categories()
    {
        $this->load->model('FinancingPaymentCategory_model');

        if(!checkRoleCanAccessModule('customers', 'read')){
			show403Error();
			return false;
		}

        $cid = logged('company_id');
        $financingCategories = $this->FinancingPaymentCategory_model->getAllByCompanyId($cid);

        $this->page_data['financingCategories'] = $financingCategories;
        $this->page_data['page']->title  = 'Financing Payment Categories';
        $this->page_data['page']->parent = 'Financing Payment Categories';
        $this->load->view('v2/pages/customer/settings_financing_categories', $this->page_data);
    }

    public function ajax_update_financing_category()
    {
        $this->load->model('FinancingPaymentCategory_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg   = 'Cannot save data';
        $name  = '';
        $value = '';

        $company_id = logged('company_id');
        $post       = $this->input->post();        

        $financingCategory = $this->FinancingPaymentCategory_model->getByIdAndCompanyId($post['catid'], $company_id);
        $isExists          = $this->FinancingPaymentCategory_model->getByNameAndCompanyId($post['category_name'], $company_id);
        if( $isExists && $isExists->id != $financingCategory->id ){
            $msg = 'Category name ' . $post['category_name'] . ' already exists';
        }else{
            if( $financingCategory ){
                $data = [
                    'name' => $post['category_name'],
                    'value' => $post['category_value'],
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                $this->FinancingPaymentCategory_model->update($financingCategory->id, $data);
    
                $name  = $post['category_name'];
                $value = $post['category_value'];
    
                //Activity Logs
                $activity_name = 'Financing Payment Category : Updated ' . $financingCategory->name; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            }
        }        

        $return = ['is_success' => $is_success, 'msg' => $msg, 'name' => $name, 'value' => $value];
        echo json_encode($return);
    }

    public function ajax_delete_financing_category()
    {
        $this->load->model('FinancingPaymentCategory_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg   = 'Cannot save data';

        $company_id = logged('company_id');
        $post       = $this->input->post();        

        $financingCategory = $this->FinancingPaymentCategory_model->getByIdAndCompanyId($post['catid'], $company_id);
        if( $financingCategory ){
            //Activity Logs
            $activity_name = 'Financing Payment Category : Deleted ' . $financingCategory->name; 
            createActivityLog($activity_name);

            $this->FinancingPaymentCategory_model->delete($financingCategory->id);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_customer_status()
    {
        $this->load->model('CustomerStatus_model');
        
        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $status_name = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->CustomerStatus_model->getByNameAndCompanyId($post['status_name'], $company_id);
        if( $isExists ){
            $msg = 'Status name ' . $post['status_name'] . ' already exists.';
        }else{
            if ($post['status_name'] != '') {
                $data = [
                    'company_id' => $company_id,
                    'name' => $post['status_name'],
                    'date_created' => date("Y-m-d H:i:s")
                ];
    
                $this->CustomerStatus_model->create($data);
    
                //Activity Logs
                $activity_name = 'Customer Status : Created ' . $post['status_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
    
                $status_name = $post['status_name'];
                
            }else{
                $msg = 'Please enter status name.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'status_name' => $status_name];
        echo json_encode($return);
    }

    public function ajax_create_customer_group()
    {
        $this->load->model('CustomerGroup_model');

        $is_success = 0;
        $msg = 'Cannot save data';
        $group_name = '';
        $group_id   = 0;

        $company_id = logged('company_id');
        $user_id    = logged('id');
        $post = $this->input->post();

        $isExists = $this->CustomerGroup_model->getByNameAndCompanyId($post['group_name'], $company_id);
        if( $isExists ){
            $msg = 'Group name ' . $post['group_name'] . ' already exists.';
        }else{
            if ($post['group_name'] != '') {
                $data = [
                    'company_id' => $company_id,
                    'user_id' => $user_id,
                    'name' => $post['group_name'],
                    'title' => $post['group_name'],
                    'description' => $post['group_description'],
                    'date_added' => date("Y-m-d H:i:s")
                ];
    
                $group_id = $this->CustomerGroup_model->create($data);
    
                //Activity Logs
                $activity_name = 'Customer Group : Created ' . $post['group_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
    
                $group_name = $post['group_name'];
                
            }else{
                $msg = 'Please enter group name.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'group_id' => $group_id, 'group_name' => $group_name];
        echo json_encode($return);
    }

    public function ajax_update_customer_group()
    {
        $this->load->model('CustomerGroup_model');

        $is_success = 0;
        $msg = 'Cannot find data';
        $group_name = '';
        $group_id   = 0;

        $company_id = logged('company_id');
        $user_id    = logged('id');
        $post = $this->input->post();

        $customerGroup = $this->CustomerGroup_model->getById($post['gid']);
        if( $customerGroup ){
            $isExists = $this->CustomerGroup_model->getByNameAndCompanyId($post['group_name'], $company_id);
            if( $isExists && $isExists->id != $post['gid'] ){
                $msg = 'Group name ' . $post['group_name'] . ' already exists.';
            }else{
                if ($post['group_name'] != '') {
                    $data = [
                        'name' => $post['group_name'],
                        'title' => $post['group_name'],
                        'description' => $post['group_description'],
                    ];
        
                    $this->CustomerGroup_model->update($customerGroup->id, $data);
        
                    //Activity Logs
                    $activity_name = 'Customer Group : Updated customer group ' . $customerGroup->group_name; 
                    createActivityLog($activity_name);
        
                    $is_success = 1;
                    $msg = '';
                    
                }else{
                    $msg = 'Please enter group name.';
                }
            }
        }        

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_sales_area()
    {
        $this->load->model('SalesArea_model');

        if(!checkRoleCanAccessModule('customers', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $sa_name = '';
        $sa_id   = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->SalesArea_model->getByNameAndCompanyId($post['sa_name'], $company_id);
        if( $isExists ){
            $msg = 'Sales area ' . $post['sa_name'] . ' already exists.';
        }else{
            if ($post['sa_name'] != '') {
                $data = [
                    'fk_comp_id' => $company_id,
                    'sa_name' => $post['sa_name'],
                    'date_created' => date("Y-m-d H:i:s")
                ];
    
                $sa_id = $this->SalesArea_model->createSalesArea($data);
    
                //Activity Logs
                $activity_name = 'Sales Area : Created ' . $post['sa_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
    
                $sa_name = $post['sa_name'];
                
            }else{
                $msg = 'Please enter sales area name.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'sa_id' => $sa_id, 'sa_name' => $sa_name];
        echo json_encode($return);
    }

    public function ajax_update_sales_area()
    {
        $this->load->model('SalesArea_model');

        if(!checkRoleCanAccessModule('customers', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $salesArea = $this->SalesArea_model->getByIdAndCompanyId($post['sa_id'], $company_id);
        $isExists  = $this->SalesArea_model->getByNameAndCompanyId($post['sa_name'], $company_id);
        if( $isExists && $isExists->id != $post['sa_id'] ){
            $msg = 'Sales area ' . $post['sa_name'] . ' already exists.';
        }else{
            if( $salesArea ){
                if ($post['sa_name'] != '') {
                    $data = [
                        'fk_comp_id' => $company_id,
                        'sa_name' => $post['sa_name'],
                        'date_created' => date("Y-m-d H:i:s")
                    ];
        
                    $this->SalesArea_model->updateSalesArea($post['sa_id'], $data);
        
                    //Activity Logs
                    $activity_name = 'Sales Area : Created ' . $post['sa_name']; 
                    createActivityLog($activity_name);
        
                    $is_success = 1;
                    $msg = '';
                    
                }else{
                    $msg = 'Please enter sales area name.';
                }
            }           
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_accounting_terms()
    {
        $this->load->model('AccountingTerm_model');

        $is_success = 0;
        $msg = 'Cannot save data';
        $term_name     = '';
        $term_due_days = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AccountingTerm_model->getByNameAndCompanyId($post['term_name'], $company_id);
        if( $isExists ){
            $msg = 'Accounting term ' . $post['term_name'] . ' already exists.';
        }else{
            if ($post['term_name'] != '') {
                $data = [
                    'company_id' => $company_id,
                    'qbid' => NULL,
                    'name' => $post['term_name'],
                    'type' => 1,
                    'net_due_days' => $post['term_number_days_due'],
                    'day_of_month_due' => 0,
                    'discount_percentage' => 0,
                    'discount_days' => 0,
                    'discount_on_day_of_month' => 0,
                    'minimum_days_to_pay' => $post['term_number_days_due'],
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                $this->AccountingTerm_model->create($data);
    
                //Activity Logs
                $activity_name = 'Accounting Term : Created ' . $post['term_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
    
                $term_name     = $post['term_name'];
                $term_due_days = $post['term_number_days_due'];
                
            }else{
                $msg = 'Please enter accounting term name.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'term_name' => $term_name, 'term_due_days' => $term_due_days];
        echo json_encode($return);
    }

    public function ajax_create_rate_plan()
    {
        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $plan_id = 0;
        $plan_amount = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->RatePlan_model->getByNameAndCompanyId($post['plan_name'], $company_id);
        if( $isExists ){
            $msg = 'Plan name ' . $post['plan_name'] . ' already exists.';
        }else{
            if ($post['plan_name'] != '') {
                $data = [
                    'company_id' => $company_id,
                    'plan_name' => $post['plan_name'],
                    'amount' => $post['plan_amount'],
                    'date_created' => date("Y-m-d H:i:s")
                ];
    
                $plan_id = $this->RatePlan_model->create($data);
                $plan_amount = number_format($post['plan_amount'],2,".","");
    
                //Activity Logs
                $activity_name = 'Rate Plan : Created ' . $post['plan_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
                
            }else{
                $msg = 'Please enter plan name.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'plan_id' => $plan_id, 'plan_amount' => $plan_amount];
        echo json_encode($return);
    }

    public function ajax_update_rate_plan()
    {
        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $ratePlan = $this->RatePlan_model->getByIdAndCompanyId($post['rate_plan_id'], $company_id);
        $isExists  = $this->RatePlan_model->getByNameAndCompanyId($post['plan_name'], $company_id);
        if( $isExists && $isExists->id != $post['rate_plan_id'] ){
            $msg = 'Plan name ' . $post['plan_name'] . ' already exists.';
        }else{
            if( $ratePlan ){
                if ( $post['plan_name'] != '') {
                    $data = [
                        'plan_name' => $post['plan_name'],
                        'amount' => $post['plan_amount']
                    ];
        
                    $this->RatePlan_model->update($ratePlan->id, $data);
        
                    //Activity Logs
                    $activity_name = 'Rate Plan : Updated ' . $post['plan_name']; 
                    createActivityLog($activity_name);
        
                    $is_success = 1;
                    $msg = '';
                    
                }else{
                    $msg = 'Please enter plan name.';
                }
            }            
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_system_package_type()
    {
        $this->load->model('SystemPackageType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg = 'Cannot save data';
        $package_name = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->SystemPackageType_model->getByNameAndCompanyId($post['package_name'], $company_id);
        if( $isExists ){
            $msg = 'System package ' . $post['package_name'] . ' already exists.';
        }else{
            if ($post['package_name'] != '') {
                $data = [
                    'company_id' => $company_id,
                    'name' => $post['package_name'],
                    'alarmcom_cost' => $post['alarmcom_cost'] > 0 ? $post['alarmcom_cost'] : 0,
                    'alarmnet_cost' => $post['alarmnet_cost'] > 0 ? $post['alarmnet_cost'] : 0,
                    'acct_cost' => $post['acct_cost'] > 0 ? $post['acct_cost'] : 0,
                    'date_created' => date("Y-m-d H:i:s")
                ];
    
                $this->SystemPackageType_model->create($data);
                $package_name = $post['package_name'];
    
                //Activity Logs
                $activity_name = 'System Package : Created ' . $post['package_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
                
            }else{
                $msg = 'Please enter package name.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'package_name' => $package_name];
        echo json_encode($return);
    }

    public function ajax_update_system_package_type()
    {
        $this->load->model('SystemPackageType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->SystemPackageType_model->getByNameAndCompanyId($post['package_name'], $company_id);
        if( $isExists && $isExists->id != $post['id'] ){
            $msg = 'System package ' . $post['package_name'] . ' already exists.';
        }else{
            if ($post['package_name'] != '') {
                $data = [
                    'name' => $post['package_name'],
                    'alarmcom_cost' => $post['alarmcom_cost'] > 0 ? $post['alarmcom_cost'] : 0,
                    'alarmnet_cost' => $post['alarmnet_cost'] > 0 ? $post['alarmnet_cost'] : 0,
                    'acct_cost' => $post['acct_cost'] > 0 ? $post['acct_cost'] : 0,
                ];
                
                $this->SystemPackageType_model->update($isExists->id, $data);
    
                //Activity Logs
                $activity_name = 'System Package : Updated ' . $isExists->name . ' changed to ' . $post['package_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
                
            }else{
                $msg = 'Please enter package name.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_activation_fee()
    {
        $this->load->model('ActivationFee_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $amount = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        if ($post['amount'] >= 0 ) {
            $data = [
                'company_id' => $company_id,
                'amount' => $post['amount'],
                'date_created' => date("Y-m-d H:i:s")
            ];

            $this->ActivationFee_model->create($data);
            $amount = number_format($post['amount'],2,".","");

            //Activity Logs
            $activity_name = 'Activation Fee : Created amount ' . $post['amount']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
            
        }else{
            $msg = 'Please enter amount.';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'amount' => $amount];
        echo json_encode($return);
    }

    public function ajax_update_activation_fee()
    {
        $this->load->model('ActivationFee_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg = 'Cannot find data';
        $amount = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $activationFee = $this->ActivationFee_model->getByIdAndCompanyId($post['id'], $company_id);
        if( $activationFee ){
            if ($post['amount'] >= 0 ) {
                $data = ['amount' => $post['amount']];
    
                $this->ActivationFee_model->update($post['id'], $data);
                $amount = number_format($post['amount'],2,".","");
    
                //Activity Logs
                $activity_name = 'Activation Fee : Updated amount from ' . $activationFee->amount . ' to ' . $post['amount']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
                
            }else{
                $msg = 'Please enter amount.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'amount' => $amount];
        echo json_encode($return);
    }

    public function ajax_delete_activation_fee()
    {
        $this->load->model('ActivationFee_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg = 'Cannot find data';
        $amount = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $activationFee = $this->ActivationFee_model->getByIdAndCompanyId($post['id'], $company_id);
        if( $activationFee ){
            $this->ActivationFee_model->delete($activationFee->id);

            //Activity Logs
            $activity_name = 'Activation Fee : Deleted ' . $activationFee->amount; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }
        
        $return = ['is_success' => $is_success, 'msg' => $msg, 'amount' => $amount];
        echo json_encode($return);
    }

    public function ajax_delete_system_package_type()
    {
        $this->load->model('SystemPackageType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
            show403Error();
            return false;
        }

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $systemPackageType = $this->SystemPackageType_model->getByIdAndCompanyId($post['id'], $company_id);
        if( $systemPackageType ){
            $this->SystemPackageType_model->delete($systemPackageType->id);

            //Activity Logs
            $activity_name = 'System Package Type : Deleted ' . $systemPackageType->name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }
        
        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_send_esign_form()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('User_docflies_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        $esignTemplates  = $this->User_docflies_model->getAllDocfileTemplatesByCompanyId($company_id);
        $defaultTemplate = $this->User_docflies_model->getDefaultTemplateByCompanyId($company_id);
        if( $defaultTemplate ){
            foreach($esignTemplates as $record){
                $record->is_default = $defaultTemplate->template_id == $record->id ? 1 : 0;
            }
        }
        
        $this->page_data['esignTemplates'] = $esignTemplates;
        $this->load->view('v2/pages/customer/ajax_send_esign_form', $this->page_data);
    }

    public function ajax_import_preview()
    {
        $this->load->library('CSVReader');

        $post = $this->input->post();
        $csv  = array_map('str_getcsv', file($_FILES['file']['tmp_name'], FILE_SKIP_EMPTY_LINES));
        $csvHeader = array_shift($csv);           
        $csvData   = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

        $preview_headers  = [];
        $selected_headers = [];        
        foreach( $post['headers'] as $key => $value ){
            if( $value >= 0 && $csvHeader[$value] && $post['settingHeaders'][$value] ){
                $selected_headers[$csvHeader[$value]] = ['name' => $csvHeader[$value], 'setting_header' => $post['settingHeaders'][$key]]; 
            }
        }

        $preview_data = [];
        $row = 0;
        foreach( $csvData as $value ){
            foreach( $value as $subKey => $subValue ){
                if( $selected_headers[$subKey]['name'] ){
                    $preview_data[$row][$selected_headers[$subKey]['name']] = $subValue;
                }
            }
            $row++;
        }
        
        $this->page_data['preview_headers'] = $selected_headers;
        $this->page_data['preview_data']    = $preview_data;
        $this->load->view('v2/pages/customer/ajax_preview_import', $this->page_data);
    }

    public function ajax_customer_add_basic_information()
    {
        $this->load->model('CustomerStatus_model');

        $cid = logged('company_id');
        $customerStatus = $this->CustomerStatus_model->getAllByCompanyId($cid);

        $this->page_data['customerStatus'] = $customerStatus;
        $this->load->view('v2/pages/customer/advance_customer_forms/modal_forms/_basic_infromation', $this->page_data);
    }

    public function ajax_customer_add_billing_information()
    {
        $this->load->model('RatePlan_model');

        $cid = logged('company_id');

        $ratePlans = $this->RatePlan_model->getAllByCompanyId($cid);

        $this->page_data['ratePlans'] = $ratePlans;
        $this->load->view('v2/pages/customer/advance_customer_forms/modal_forms/_billing_infromation', $this->page_data);
    }

    public function ajax_customer_add_emergency_contacts_information()
    {
        $this->load->model('Contacts_model');

        $optionRelations = $this->Contacts_model->optionRelations();

        $this->page_data['optionRelations'] = $optionRelations;
        $this->load->view('v2/pages/customer/advance_customer_forms/modal_forms/_emergency_contacts_infromation', $this->page_data);
    }

    public function customer_advance_form_settings()
    {
        $this->load->model('CompanyCustomerFormSetting_model');

        $cid = logged('company_id');

        $formFields = $this->CompanyCustomerFormSetting_model->formFields();
        $companyCustomerFormSettings = $this->CompanyCustomerFormSetting_model->getByCompanyId($cid);

        $companyFormSetting = [];
        $formGroups = [];

        if( $companyCustomerFormSettings ){
            $fieldSettings = json_decode($companyCustomerFormSettings->field_settings);
            foreach( $fieldSettings as $setting ){
                $companyFormSetting[$setting->field_group][$setting->field_name] = ['value' => $setting->field_value, 'is_enabled' => $setting->is_enabled];
                
                if( $setting->is_enabled == 1 ){
                    if( $formGroups[$setting->field_group]['total_enabled'] ){
                        $formGroups[$setting->field_group]['total_enabled'] += 1;   
                    }else{
                        $formGroups[$setting->field_group]['total_enabled'] = 1;
                    }
                }else{
                    if( $formGroups[$setting->field_group]['total_disabled'] ){
                        $formGroups[$setting->field_group]['total_disabled'] += 1;   
                    }else{
                        $formGroups[$setting->field_group]['total_disabled'] = 1;
                    }
                }         
            }
        }        
        
        $this->page_data['formFields'] = $formFields;
        $this->page_data['companyFormSetting'] = $companyFormSetting;
        $this->page_data['formGroups'] = $formGroups;
        $this->page_data['page']->title = 'Form Settings';
        $this->page_data['page']->parent = 'Form Settings';
        $this->load->view('v2/pages/customer/customer_advance_form_settings', $this->page_data);
    }

    public function ajax_save_customer_form_settings()
    {
        $this->load->model('CompanyCustomerFormSetting_model');

        $is_success = 0;
        $msg = 'Cannot save data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        foreach( $post['fieldName'] as $field_group => $fields ){
            foreach( $fields as $key => $value ){                
                $is_enabled = 1;
                if( $post['isHiddenField'][$field_group][$key] ){
                    $is_enabled = 0;
                }

                $settings_data[] = [
                    'field_name' => $key,
                    'field_value' => $value,
                    'field_group' => $field_group,
                    'is_enabled' => $is_enabled,
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                ];
            }
        }
        
        $companyCustomerFormSetting = $this->CompanyCustomerFormSetting_model->getByCompanyId($cid);
        if( $companyCustomerFormSetting ){
            $data = [
                'field_settings' => json_encode($settings_data), 
                'date_modified' => date("Y-m-d H:i:s")
            ];
            $this->CompanyCustomerFormSetting_model->update($companyCustomerFormSetting->id, $data);
        }else{
            $data = [
                'company_id' => $cid,
                'field_settings' => json_encode($settings_data),
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];

            $this->CompanyCustomerFormSetting_model->create($data);
        }

        $is_success = 1;
        $msg = '';

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_lender_type()
    {
        $this->load->model('AcsSolarInfoLenderType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        
        if ($post['lender_type_name'] != '' ) {
            $isExists = $this->AcsSolarInfoLenderType_model->getByNameAndCompanyId($post['lender_type_name'], $cid);
            if( !$isExists ){
                $data = [
                    'company_id' => $cid,
                    'name' => $post['lender_type_name'],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoLenderType_model->create($data);
    
                //Activity Logs
                $activity_name = 'Solar Lender Type : Created lender type ' . $post['lender_type_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            }else{
                $msg = 'Lender type ' . $post['lender_type_name'] . ' already exists';
            }    
        }else{
            $msg = 'Please enter name.';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'name' => $post['lender_type_name']];
        echo json_encode($return);
    }

    public function ajax_update_lender_type()
    {
        $this->load->model('AcsSolarInfoLenderType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        $lenderType = $this->AcsSolarInfoLenderType_model->getByIdAndCompanyId($post['lender_type_id'], $cid);
        if ($lenderType) {            
            $isExists   = $this->AcsSolarInfoLenderType_model->getByNameAndCompanyId($post['lender_type_name'], $cid);
            if( $isExists && $lenderType->id != $isExists->id ){
                $msg = 'Lender type ' . $post['lender_type_name'] . ' already exists';
            }else{
                $data = [
                    'name' => $post['lender_type_name'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoLenderType_model->update($lenderType->id, $data);
    
                //Activity Logs
                $activity_name = 'Solar Lender Type : Updated lender type ' . $post['lender_type_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            } 
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_lender_type()
    {
        $this->load->model('AcsSolarInfoLenderType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $lenderType = $this->AcsSolarInfoLenderType_model->getByIdAndCompanyId($post['lid'], $cid);
        if ($lenderType) {    
            $name = $lenderType->name;                    
            $this->AcsSolarInfoLenderType_model->delete($lenderType->id);

            //Activity Logs
            $activity_name = 'Solar Lender Type : Deleted lender type ' . $name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_system_size()
    {
        $this->load->model('AcsSolarInfoSystemSize_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        
        if ($post['system_size_name'] != '' ) {
            $isExists = $this->AcsSolarInfoSystemSize_model->getByNameAndCompanyId($post['system_size_name'], $cid);
            if( !$isExists ){
                $data = [
                    'company_id' => $cid,
                    'name' => $post['system_size_name'],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoSystemSize_model->create($data);
    
                //Activity Logs
                $activity_name = 'Solar System Size : Created system size ' . $post['system_size_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            }else{
                $msg = 'System size ' . $post['system_size_name'] . ' already exists';
            }    
        }else{
            $msg = 'Please enter name.';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'name' => $post['system_size_name']];
        echo json_encode($return);
    }

    public function ajax_update_system_size()
    {
        $this->load->model('AcsSolarInfoSystemSize_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        $systemSize = $this->AcsSolarInfoSystemSize_model->getByIdAndCompanyId($post['system_size_id'], $cid);
        if ($systemSize) {            
            $isExists   = $this->AcsSolarInfoSystemSize_model->getByNameAndCompanyId($post['system_size_name'], $cid);
            if( $isExists && $systemSize->id != $isExists->id ){
                $msg = 'System size ' . $post['system_size_name'] . ' already exists';
            }else{
                $data = [
                    'name' => $post['system_size_name'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoSystemSize_model->update($systemSize->id, $data);
    
                //Activity Logs
                $activity_name = 'Solar System Size : Updated system size ' . $post['system_size_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            } 
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_system_size()
    {
        $this->load->model('AcsSolarInfoSystemSize_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $systemSize = $this->AcsSolarInfoSystemSize_model->getByIdAndCompanyId($post['sid'], $cid);
        if ($systemSize) {    
            $name = $systemSize->name;                    
            $this->AcsSolarInfoSystemSize_model->delete($systemSize->id);

            //Activity Logs
            $activity_name = 'Solar System Size : Deleted system size ' . $name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_proposed_module()
    {
        $this->load->model('AcsSolarInfoProposedModule_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        
        if ($post['proposed_module_name'] != '' ) {
            $isExists = $this->AcsSolarInfoProposedModule_model->getByNameAndCompanyId($post['proposed_module_name'], $cid);
            if( !$isExists ){
                $data = [
                    'company_id' => $cid,
                    'name' => $post['proposed_module_name'],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoProposedModule_model->create($data);
    
                //Activity Logs
                $activity_name = 'Solar Proposed Module : Created proposed module ' . $post['proposed_module_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            }else{
                $msg = 'Proposed module ' . $post['proposed_module_name'] . ' already exists';
            }    
        }else{
            $msg = 'Please enter name.';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'name' => $post['proposed_module_name']];
        echo json_encode($return);
    }

    public function ajax_update_proposed_module()
    {
        $this->load->model('AcsSolarInfoProposedModule_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        $proposedModule = $this->AcsSolarInfoProposedModule_model->getByIdAndCompanyId($post['proposed_module_id'], $cid);
        if ($proposedModule) {            
            $isExists   = $this->AcsSolarInfoProposedModule_model->getByNameAndCompanyId($post['proposed_module_name'], $cid);
            if( $isExists && $proposedModule->id != $isExists->id ){
                $msg = 'Proposed module ' . $post['proposed_module_name'] . ' already exists';
            }else{
                $data = [
                    'name' => $post['proposed_module_name'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoProposedModule_model->update($proposedModule->id, $data);
    
                //Activity Logs
                $activity_name = 'Solar Proposed Module : Updated proposed module ' . $post['proposed_module_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            } 
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_proposed_module()
    {
        $this->load->model('AcsSolarInfoProposedModule_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $proposedModule = $this->AcsSolarInfoProposedModule_model->getByIdAndCompanyId($post['pid'], $cid);
        if ($proposedModule) {    
            $name = $proposedModule->name;                    
            $this->AcsSolarInfoProposedModule_model->delete($proposedModule->id);

            //Activity Logs
            $activity_name = 'Solar Proposed Module : Deleted proposed module ' . $name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_create_proposed_inverter()
    {
        $this->load->model('AcsSolarInfoProposedInverter_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        
        if ($post['proposed_inverter_name'] != '' ) {
            $isExists = $this->AcsSolarInfoProposedInverter_model->getByNameAndCompanyId($post['proposed_inverter_name'], $cid);
            if( !$isExists ){
                $data = [
                    'company_id' => $cid,
                    'name' => $post['proposed_inverter_name'],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoProposedInverter_model->create($data);
    
                //Activity Logs
                $activity_name = 'Solar Proposed Inverter : Created proposed inverter ' . $post['proposed_inverter_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            }else{
                $msg = 'Proposed inverter ' . $post['proposed_inverter_name'] . ' already exists';
            }    
        }else{
            $msg = 'Please enter name.';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'name' => $post['proposed_inverter_name']];
        echo json_encode($return);
    }

    public function ajax_update_proposed_inverter()
    {
        $this->load->model('AcsSolarInfoProposedInverter_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';
        $amount = 0;

        $cid  = logged('company_id');
        $post = $this->input->post();

        $proposedInverter = $this->AcsSolarInfoProposedInverter_model->getByIdAndCompanyId($post['proposed_inverter_id'], $cid);
        if ($proposedInverter) {            
            $isExists   = $this->AcsSolarInfoProposedInverter_model->getByNameAndCompanyId($post['proposed_inverter_name'], $cid);
            if( $isExists && $proposedInverter->id != $isExists->id ){
                $msg = 'Proposed inverter ' . $post['proposed_inverter_name'] . ' already exists';
            }else{
                $data = [
                    'name' => $post['proposed_inverter_name'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];
    
                $this->AcsSolarInfoProposedInverter_model->update($proposedInverter->id, $data);
    
                //Activity Logs
                $activity_name = 'Solar Proposed Inverter : Updated proposed inverter ' . $post['proposed_inverter_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;
                $msg = '';
            } 
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_proposed_inverter()
    {
        $this->load->model('AcsSolarInfoProposedInverter_model');

        if(!checkRoleCanAccessModule('customer-settings', 'delete')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $proposedInverter = $this->AcsSolarInfoProposedInverter_model->getByIdAndCompanyId($post['iid'], $cid);
        if ($proposedInverter) {    
            $name = $proposedInverter->name;                    
            $this->AcsSolarInfoProposedInverter_model->delete($proposedInverter->id);

            //Activity Logs
            $activity_name = 'Solar Proposed Inverter : Deleted proposed inverter ' . $name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_customer_ledger()
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');    
        $this->load->model('Users_model');    
        $this->load->model('Jobs_model');

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $cid        = isset($post['customer_id']) && $post['customer_id'] > 0 ? $post['customer_id'] : $this->session->userdata('module_customer_id');
        //$payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $invoices   = $this->Invoice_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $customer   = $this->AcsProfile_model->getByProfId($cid);
        $customer_address = $customer->mail_add . ' ' . $customer->state . ', ' . $customer->city . ' ' . $customer->zip_code;
        $ledger = [];
        $g_total_payment = 0;
        $g_total_income  = 0;
        foreach( $invoices as $invoice ){
            $date = date("m/d/y", strtotime($invoice->date_issued));
            $user = $this->Users_model->getUserByID($invoice->user_id);            
            if( $company_id == 139 || $company_id == 1 ){
                $description =  date('F', strtotime($invoice->due_date)) . ' rent';
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }                
            }else{
                $description = 'Issued invoice number ' . $invoice->invoice_number;
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }
            }

            $payments = $this->Payment_records_model->getAllByInvoiceId($invoice->id);            
            $total_payment = 0;
            $payment_method = '---';
            foreach( $payments as $p ){
                $total_payment += $p->invoice_amount;
                $payment_method = $p->payment_method == 'cc' ? 'Credit Card' : ucwords($p->payment_method); 
            }

            $g_total_income += $invoice->grand_total;
            $g_total_payment += $total_payment;

            $ledger[$date][] = [
                'id' => $invoice->id,
                'user' => $user ? $user->FName . ' ' . $user->LName : '---',
                'payment_method' => $payment_method,                
                'type' => 'income',                
                'date' => $date,
                'description' => $description,
                'amount' => $invoice->grand_total,
                'payment' => $total_payment,
                'late_fee' => $invoice->late_fee,
                'date_created' => $invoice->date_created
            ];
        }
        
        $balance = $g_total_income - $g_total_payment;

        $this->page_data['customer_address'] = $customer_address;
        $this->page_data['total_income']  = $g_total_income;
        $this->page_data['total_payment'] = $g_total_payment;
        $this->page_data['balance'] = $balance;
        $this->page_data['default_email'] = logged('email');
        $this->page_data['ledger']    = $ledger;
        $this->load->view('v2/pages/customer/dashboard/ajax_customer_ledger', $this->page_data);
    }

    public function ajax_customer_ledger_invoice()
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');    
        $this->load->model('Users_model');    
        $this->load->model('Jobs_model');

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $cid        = isset($post['customer_id']) && $post['customer_id'] > 0 ? $post['customer_id'] : $this->session->userdata('module_customer_id');
        $invoices   = $this->Invoice_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $customer   = $this->AcsProfile_model->getByProfId($cid);
        $customer_address = $customer->mail_add . ' <br />' . $customer->city . ', ' . $customer->state . ' ' . $customer->zip_code;
        $ledger = [];
        $g_total_payment = 0;
        $g_total_income  = 0;
        foreach( $invoices as $invoice ){
            $date = date("m/d/y", strtotime($invoice->date_issued));
            $user = $this->Users_model->getUserByID($invoice->user_id);            
            if( $company_id == 139 || $company_id == 1 ){
                $description =  date('F', strtotime($invoice->due_date)) . ' rent';
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }                
            }else{
                $description = 'Issued invoice number ' . $invoice->invoice_number;
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }
            }

            $payments = $this->Payment_records_model->getAllByInvoiceId($invoice->id);            
            $total_payment = 0;
            $payment_method = '---';
            foreach( $payments as $p ){
                $total_payment += $p->invoice_amount;
                $payment_method = $p->payment_method == 'cc' ? 'Credit Card' : ucwords($p->payment_method); 
            }

            $g_total_income += $invoice->grand_total;
            $g_total_payment += $total_payment;

            $ledger[$date][] = [
                'id' => $invoice->id,
                'user' => $user ? $user->FName . ' ' . $user->LName : '---',
                'payment_method' => $payment_method,                
                'type' => 'income',                
                'date' => $date,
                'description' => $description,
                'amount' => $invoice->grand_total,
                'payment' => $total_payment,
                'late_fee' => $invoice->late_fee,
                'date_created' => $invoice->date_created
            ];
        }
        
        $balance = $g_total_income - $g_total_payment;

        $this->page_data['customer_address'] = $customer_address;
        $this->page_data['total_income']  = $g_total_income;
        $this->page_data['total_payment'] = $g_total_payment;
        $this->page_data['balance'] = $balance;
        $this->page_data['default_email'] = logged('email');
        $this->page_data['ledger']    = $ledger;
        $this->load->view('v2/pages/customer/dashboard/ajax_customer_invoice_ledger', $this->page_data);
    }

    public function ajax_delete_company_reason()
    {
        $this->load->model('CompanyReason_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $companyReason = $this->CompanyReason_model->getById($post['rid']);
        if ($companyReason && $companyReason->company_id == $cid && $companyReason->company_id > 0 ) {
            $this->CompanyReason_model->delete($companyReason->id);

            //Activity Logs
            $activity_name = 'Company Reason : Deleted company reason ' . $companyReason->reason; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function download_statement_of_claims()
    {
        $this->load->model('CustomerStatementClaim_model');
        $this->load->model('AcsProfile_model');

        $this->load->library('pdf');

        $company_id = logged('company_id');
        $post = $this->input->post();   
        
        $customer = $this->AcsProfile_model->getByProfId($post['cid']);          
        if( $customer && $customer->company_id == $company_id ){
            $statementClaim = $this->CustomerStatementClaim_model->getByCustomerId($post['cid']);      
            if( $statementClaim ){
                $data = [
                    'plaintiff_name' => $post['plaintiff_name'],
                    'plaintiff_address' => $post['plaintiff_adress'],
                    'plaintiff_city_state_zip' => $post['plaintiff_city_state_zip'],
                    'plaintiff_phone' => $post['plaintiff_phone'],
                    'defendant_name' => $post['defendant_name'],
                    'defendant_street_address' => $post['defendant_adress'],
                    'defendant_city_state_zip' => $post['defendant_city_state_zip'],
                    'case_number' => $post['soc_case_number'],
                    'division' => $post['soc_division'],
                    'damage_amount' => $post['soc_damage_amount'],
                    'court_costs' => $post['soc_court_costs'],
                    'sheriff_fee' => $post['soc_sheriff_fees'],
                    'plaintiff_agent' => $post['soc_plaintiff_agent'],
                    'deputy_clerk' => $post['soc_deputy_clerk'],
                    'commission_expires' => $post['commission_expires'],
                    'statement_claim' => $post['statement_claim'],
                    'date_updated' =>  date("Y-m-d H:i:s"),
                ];
                $this->CustomerStatementClaim_model->update($statementClaim->id, $data);
            }else{
                $data = [
                    'customer_id' => $post['cid'],
                    'plaintiff_name' => $post['plaintiff_name'],
                    'plaintiff_address' => $post['plaintiff_adress'],
                    'plaintiff_city_state_zip' => $post['plaintiff_city_state_zip'],
                    'plaintiff_phone' => $post['plaintiff_phone'],
                    'defendant_name' => $post['defendant_name'],
                    'defendant_street_address' => $post['defendant_adress'],
                    'defendant_city_state_zip' => $post['defendant_city_state_zip'],
                    'case_number' => $post['soc_case_number'],
                    'division' => $post['soc_division'],
                    'damage_amount' => $post['soc_damage_amount'],
                    'court_costs' => $post['soc_court_costs'],
                    'sheriff_fee' => $post['soc_sheriff_fees'],
                    'plaintiff_agent' => $post['soc_plaintiff_agent'],
                    'deputy_clerk' => $post['soc_deputy_clerk'],
                    'commission_expires' => $post['commission_expires'],
                    'statement_claim' => $post['statement_claim'],
                    'date_created' =>  date("Y-m-d H:i:s"),
                    'date_updated' =>  date("Y-m-d H:i:s"),
                ];
                $this->CustomerStatementClaim_model->create($data);
            }
    
            $filename = 'statement_of_claims';
            $this->page_data['post'] = $post;     
            //$this->load->view('v2/pages/customer/pdf/statement_of_claims', $this->page_data);   
            $this->pdf->load_view('v2/pages/customer/pdf/statement_of_claims', $this->page_data, $filename, "P");
        }
    }

    public function ajax_save_signature()
    {
        $this->load->model('CustomerSignature_model');
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $msg  = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();
        
        $customer = $this->AcsProfile_model->getByProfId($post['customer_id']);
        if( $customer ){
            $customerSignature = $this->CustomerSignature_model->getByCustomerId($post['customer_id']);
            if( $customerSignature ){
                $data = ['value' => $post['signature_value'],'date_updated' => date("Y-m-d H:i:s")];
                $this->CustomerSignature_model->update($customerSignature->id, $data);
            }else{
                $data = [
                    'company_id' => $cid,
                    'customer_id' => $customer->prof_id,              
                    'customer_name' => $customer->first_name . ' ' . $customer->last_name,
                    'date' => date("Y-m-d"),
                    'time' => date("h:i A"),
                    'value' => $post['signature_value'],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $this->CustomerSignature_model->create($data);
            }

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function export_customer_ledger()
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');    
        $this->load->model('Users_model');    
        $this->load->model('Jobs_model');

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $cid        = $this->session->userdata('module_customer_id');
        $payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $invoices   = $this->Invoice_model->getAllByCustomerIdAndCompanyId($cid, $company_id);

        $fields = ['#', 'Date', 'Description', 'Method', 'Recorded Date', 'Entered By', 'Invoice', 'Payment'];
        $ledger = [];
        $row    = 1;

        $delimiter = ',';
        $time      = time();
        $filename  = 'customer_ledger_'.$time.'.csv';
        
        $f = fopen('php://memory', 'w');
        fputcsv($f, $fields, $delimiter);

        $total_income  = 0;
        $total_payment = 0;
        foreach( $invoices as $invoice ){
            $date = date("m/d/Y", strtotime($invoice->date_issued));
            $user = $this->Users_model->getUserByID($invoice->user_id);
            if( $company_id == 139 || $company_id == 1 ){
                $description =  date('F', strtotime($invoice->due_date)) . ' rent';
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }  
            }else{
                $description = 'Issued invoice number ' . $invoice->invoice_number;
                if( $invoice->job_id > 0 ){
                    $job = $this->Jobs_model->getByIdAndCompanyId($invoice->job_id, $invoice->company_id);
                    if( $job ){
                        $description = 'Issued invoice for job number ' . $job->job_number;
                    }
                }
            }

            $payments = $this->Payment_records_model->getAllByInvoiceId($invoice->id);            
            $total_payment = 0;
            $payment_method = '---';
            foreach( $payments as $p ){
                $total_payment += $p->invoice_amount;
                $payment_method = $p->payment_method == 'cc' ? 'Credit Card' : ucwords($p->payment_method); 
            }

            $g_total_income += $invoice->grand_total;
            $g_total_payment += $total_payment;

            $encoder  = $user ? $user->FName . ' ' . $user->LName : '---';
            $amount   = $invoice->grand_total;
            $payment  = 0;
            $ledger   = [$row, $date, $description, $payment_method, $invoice->date_created, $encoder, $amount, $total_payment];
            fputcsv($f, $ledger, $delimiter);

            $row++;
        }

        $ledger = ['Total', '', '', '', '', '', $g_total_income, $g_total_payment];
        fputcsv($f, $ledger, $delimiter);

        $total_balance = $g_total_income - $g_total_payment;
        $ledger = ['Balance', '', '', '', '', '', '', $total_balance];
        fputcsv($f, $ledger, $delimiter);
        
        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fpassthru($f);
    }

    public function ajax_print_customer_ledger()
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');    
        $this->load->model('Users_model');    

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $cid        = isset($post['customer_id']) && $post['customer_id'] > 0 ? $post['customer_id'] : $this->session->userdata('module_customer_id');
        $payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $company_id);
        $invoices   = $this->Invoice_model->getAllByCustomerIdAndCompanyId($cid, $company_id);

        $ledger = [];
        foreach( $invoices as $invoice ){
            $date = date("m/d/Y", strtotime($invoice->date_issued));
            $user = $this->Users_model->getUserByID($invoice->user_id);

            if( $company_id == 139 || $company_id == 1 ){
                $description =  date('F', strtotime($invoice->due_date)) . ' rent';
            }else{
                $description = 'Issued invoice number ' . $invoice->invoice_number;
            }

            $ledger[$date][] = [
                'id' => $invoice->id,
                'user' => $user ? $user->FName . ' ' . $user->LName : '---',
                'payment_method' => '---',                
                'type' => 'income',                
                'date' => $date,
                'description' => $description,
                'amount' => $invoice->grand_total,
                'late_fee' => $invoice->late_fee,
                'date_created' => $invoice->date_created
            ];

            $payments = $this->Payment_records_model->getAllByInvoiceId($invoice->id);            
            foreach( $payments as $p ){
                $date = date("m/d/Y", strtotime($p->payment_date));
                $user = $this->Users_model->getUserByID($p->user_id);
                $payment_method = $p->payment_method == 'cc' ? 'Credit Card' : ucwords($p->payment_method); 

                $ledger[$date][] = [
                    'id' => $p->id,
                    'user' => $user ? $user->FName . ' ' . $user->LName : '---',
                    'type' => 'payment',          
                    'payment_method' => $payment_method,
                    'date' => $date,      
                    'description' => $description,
                    'amount' => $p->invoice_amount,
                    'date_created' => $p->date_created
                ];
            }
        }

        $this->page_data['ledger']    = $ledger;
        $this->load->view('v2/pages/customer/dashboard/ajax_print_customer_ledger', $this->page_data);
    }

    public function ajax_send_email_ledger()
    {
        $this->load->model('Invoice_model');
        $this->load->model('AcsProfile_model');    
        $this->load->model('Users_model');   
        $this->load->model('Payment_records_model');

        $is_success = 0;
        $msg = 'Cannot send email';
        $post = $this->input->post();

        $company_id = logged('company_id');
        $post       = $this->input->post();
        $cid        = $this->session->userdata('module_customer_id');
        $payments   = $this->Payment_records_model->getAllByCustomerIdAndCompanyId($cid, $company_id);

        $invoices   = $this->Invoice_model->getAllByCustomerIdAndCompanyId($cid, $company_id);

        $fields = ['#', 'Date', 'Description', 'Method', 'Recorded Date', 'Entered By', 'Invoice', 'Payment'];
        $ledger = [];
        $row    = 1;
        
        $delimiter  = ',';
        $time       = time();
        $filename   = 'customer_ledger_'.$time.'.csv';
        $target_dir = "./uploads/customer_ledger_csv/" . $company_id . "/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $filepath  = $target_dir . $filename;
        $f = fopen($filepath, 'w');

        fputcsv($f, $fields, $delimiter);

        $total_income  = 0;
        $total_payment = 0;
        foreach( $invoices as $invoice ){

            if( $company_id == 139 || $company_id == 1 ){
                $description = 'Month rent ' . date('M Y', strtotime($invoice->due_date));
            }else{
                $description = 'Issued invoice number ' . $invoice->invoice_number;
            }

            $date = date("m/d/Y", strtotime($invoice->date_issued));
            $user = $this->Users_model->getUserByID($invoice->user_id);
            $encoder  = $user ? $user->FName . ' ' . $user->LName : '---';
            $amount   = $invoice->grand_total;
            $payment  = 0;
            $ledger   = [$row, $date, $description, '---', $invoice->date_created, $encoder, $amount, $payment];
            fputcsv($f, $ledger, $delimiter);

            $total_income += $amount;
            $row++;

            $payments = $this->Payment_records_model->getAllByInvoiceId($invoice->id);            
            foreach( $payments as $p ){
                $date = date("m/d/Y", strtotime($p->payment_date));
                $user = $this->Users_model->getUserByID($p->user_id);
                $encoder  = $user ? $user->FName . ' ' . $user->LName : '---';
                $amount   = 0;
                $payment  = $p->invoice_amount;
                $payment_method = $p->payment_method == 'cc' ? 'Credit Card' : ucwords($p->payment_method); 
                $ledger   = [$row, $date, $description, $payment_method, $invoice->date_created, $encoder, $amount, $payment];
                fputcsv($f, $ledger, $delimiter);

                $total_payment += $payment;
                $row++;
            }
        }

        $ledger = ['Total', '', '', '', '', '', $total_income, $total_payment];
        fputcsv($f, $ledger, $delimiter);

        $total_balance = $total_income - $total_payment;
        $ledger = ['Balance', '', '', '', '', '', '', $total_balance];
        fputcsv($f, $ledger, $delimiter);
        
        rewind($f);
        fclose($f);

        $subject = 'Customer Ledger';
        if( $post['email_subject'] != '' ){
            $subject = $post['email_subject'];
        }

        // Send Email
        $mail = email__getInstance();
        $mail->FromName = 'nSmarTrac';
        $mail->addAddress($post['recipient_email'], $post['recipient_email']);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $post['email_body'];

        $mail->addStringAttachment($target_dir, $filename);

        if( $mail->Send() ){
            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function ajax_other_address()
    {
        $this->load->model('CustomerAddress_model');
        $this->load->model('AcsProfile_model');

        $post = $this->input->post();
        $otherAddress = $this->CustomerAddress_model->getAllByCustomerId($post['prof_id']);
        $customer = $this->AcsProfile_model->getByProfId($post['prof_id']);

        $primary_address = [
            'prof_id' => $customer->prof_id,
            'mail_add' => $customer->mail_add,
            'city' => $customer->city,
            'state' => $customer->state,
            'zip' => $customer->zip_code
        ];

        $this->page_data['prof_id'] = $post['prof_id'];
        $this->page_data['otherAddress'] = $otherAddress;
        $this->page_data['primary_address'] = $primary_address;
        $this->load->view('v2/pages/customer/ajax_other_address', $this->page_data);
    }

    public function ajax_quick_add_other_address()
    {
        $this->load->model('CustomerAddress_model');
        
        $is_success = 0;
        $msg = 'Cannot save data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $data = [
            'customer_id' => $post['prof_id'],
            'mail_add' => $post['mail_add'],
            'city' => $post['city'],
            'state' => $post['state'],
            'zip' => $post['zip'],
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        ];

        $this->CustomerAddress_model->create($data);

        $is_success = 1;
        $msg = '';

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
        exit;
    }

    public function settings_lost_reasons()
    {
        $this->load->model('CustomerDealLostReason_model');

        $this->hasAccessModule(8); 

        $company_id = logged('company_id');
        $lostReasons = $this->CustomerDealLostReason_model->getAllByCompanyId($company_id);

        $this->page_data['lostReasons'] = $lostReasons;
        $this->page_data['page']->title = 'Lost Reasons';
        $this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/customer/settings_lost_reasons', $this->page_data);
    }

    public function ajax_archive_selected_leads()
    {
        $this->load->model('Lead_model');

        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['leads'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archive' => 'Yes', 'date_updated' => date("Y-m-d H:i:s")];
            $this->Lead_model->bulkUpdate($post['leads'], $data, $filter);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_archive_lead()
    {
        $this->load->model('Lead_model');

        $is_success = 0;
        $msg    = 'Cannot find data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['lead_id'] > 0 ){
            $filter[] = ['field_name' => 'company_id', 'field_value' => $company_id];
            $lead     = $this->Lead_model->getById($post['lead_id'], $filter);
            if( $lead ){
                $data = ['is_archive' => 'Yes', 'date_updated' => date("Y-m-d H:i:s")];
                $this->Lead_model->updateLead($lead->leads_id, $data, []);

                $is_success = 1;
                $msg    = '';

                //Activity Logs
                $activity_name = 'Leads : Deleted lead ' . $lead->firstname . ' ' . $lead->lastname; 
                createActivityLog($activity_name);
            }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function archived_leads()
    {
        $this->load->model('Lead_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        $filters[] = ['field_name' => 'is_archive', 'field_value' => 'Yes'];
        $leads   = $this->Lead_model->getAllByCompanyId($company_id,$filters);
        $this->page_data['leads'] = $leads;
        $this->load->view('v2/pages/customer/ajax_archive_leads', $this->page_data);
    }

    public function ajax_restore_selected_leads()
    {
        $this->load->model('Lead_model');

        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['leads'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archive' => 'No', 'date_updated' => date("Y-m-d H:i:s")];
            $this->Lead_model->bulkUpdate($post['leads'], $data, $filter);

			//Activity Logs
			$activity_name = 'Leads : Restored ' . count($post['leads']). ' lead(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_permanently_delete_selected_leads()
	{
		$this->load->model('Lead_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['leads'] ){

			$total_archived = count($post['leads']);

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
			$filters[] = ['field' => 'is_archive', 'value' => 'Yes'];
            $this->Lead_model->bulkDelete($post['leads'], $filters);

			//Activity Logs
			$activity_name = 'Leads : Permanently deleted ' .$total_archived. ' leads(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_restore_leads()
	{
        $this->load->model('Lead_model');

        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $lead = $this->Lead_model->getById($post['lead_id']);
		if( $lead && $lead->company_id == $company_id ){
			$data     = ['is_archive' => 'No', 'date_updated' => date("Y-m-d H:i:s")];
			$this->Lead_model->updateLead($lead->id, $data);

			//Activity Logs
			$name = $lead->firstname . ' ' . $lead->lastname;
			$activity_name = 'Leads : Restored user ' . $name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_restore_selected_customers()
	{
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['customers'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archived' => 0, 'updated_at' => date("Y-m-d H:i:s"), 'deleted_at' => NULL];
            $total_updated = $this->AcsProfile_model->bulkUpdate($post['customers'], $data, $filter);

			//Activity Logs
			$activity_name = 'Customers : Restored ' . $total_updated . ' customer(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_permanently_delete_selected_customers()
	{
		$this->load->model('AcsProfile_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['customers'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
			$filters[] = ['field' => 'is_archived', 'value' => 1];
            $total_deleted = $this->AcsProfile_model->bulkDelete($post['customers'], $filters);

			//Activity Logs
			$activity_name = 'Customers : Permanently deleted ' .$total_deleted. ' customer(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_permanently_delete_archived_customer()
    {
        $this->load->model('AcsProfile_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

		$customer = $this->AcsProfile_model->getByProfId($post['customer_id']);
        if( $customer && $customer->company_id == $company_id ){			
			$this->AcsProfile_model->deleteCustomer($customer->prof_id);

			//Activity Logs
			$activity_name = 'Customers : Permanently deleted customer ' . $customer->first_name . ' ' . $customer->last_name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_archive_selected_customers()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['customers'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archived' => 1, 'deleted_at' => date("Y-m-d H:i:s")];
            $total_updated = $this->AcsProfile_model->bulkUpdate($post['customers'], $data, $filter);

            //Activity Logs
			$activity_name = 'Customers : Deleted ' . $total_updated . ' customer(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_with_selected_add_to_favorites()
    {
        $this->load->model('AcsProfile_model');

        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['customers'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_favorite' => 1, 'updated_at' => date("Y-m-d H:i:s")];
            $total_updated = $this->AcsProfile_model->bulkUpdate($post['customers'], $data, $filter);

            //Activity Logs
			$activity_name = 'Customers : Added ' . $total_updated . ' customer(s) to favorite list'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_all_archived_customers()
	{
		$this->load->model('AcsProfile_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();
		
        $filter[] = ['field' => 'company_id', 'value' => $company_id];
		$total_deleted = $this->AcsProfile_model->deleteAllArchived($filter);

		//Activity Logs
		$activity_name = 'Customers : Permanently deleted ' .$total_deleted. ' customer(s)'; 
		createActivityLog($activity_name);

		$is_success = 1;
		$msg    = '';

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_delete_archived_lead()
	{
		$this->load->model('Lead_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

		$lead = $this->Lead_model->getById($post['lead_id']);
        if( $lead && $lead->company_id == $company_id ){
			$this->Lead_model->deleteLead($lead->leads_id);

			//Activity Logs
			$name = $lead->firstname . ' ' . $lead->lastname;
			$activity_name = 'Leads : Permanently deleted lead ' . $name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_delete_all_archived_leads()
	{
		$this->load->model('Lead_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

		
        $filter[] = ['field' => 'company_id', 'value' => $company_id];
		$total_deleted = $this->Lead_model->deleteAllArchived($filter);

		//Activity Logs
		$activity_name = 'Leads : Permanently deleted ' .$total_deleted. ' lead(s)'; 
		createActivityLog($activity_name);

		$is_success = 1;
		$msg    = '';

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_change_status_selected_leads()
    {
        $this->load->model('Lead_model');

        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['leads'] ){                                    
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['status' => $post['status'], 'date_updated' => date("Y-m-d H:i:s")];
            $this->Lead_model->bulkUpdate($post['leads'], $data, $filter);

            //Activity Logs
            $activity_name = 'Leads : Changed ' .$total_deleted. ' lead(s) status to ' . $post['status']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function customer_leads_export()
	{
        $this->load->model('Lead_model');

		$cid     = logged('company_id');
		$leads = $this->Lead_model->getAllByCompanyId($cid);

		$delimiter = ",";
		$time      = time();
		$filename  = "leads_list_" . $time . ".csv";

		$f = fopen('php://memory', 'w');

		$fields = array('Name', 'Address', 'City', 'State', 'Zip', 'Lead Type', 'Source', 'Status', 'Is Archived', 'Date Created');
		fputcsv($f, $fields, $delimiter);

		if (!empty($leads)) {
			foreach ($leads as $l) {
				$name = $l->firstname . ' ' . $l->lastname;
				$csvData = array(
                    $name,
                    $l->address != '' ? $l->address : '---',
                    $l->city != '' ? $l->city : '---',
                    $l->state != '' ? $l->state : '---',
                    $l->zip != '' ? $l->zip : '---',
                    $l->lead_name != '' ? $l->lead_name : '---',
                    $l->source != '' ? $l->source : '---',
                    $l->status,
                    $l->is_archive == 1 ? 'Yes' : 'No',
                    date("m/d/Y",strtotime($l->date_created))
				);
				fputcsv($f, $csvData, $delimiter);
			}
		} else {
			$csvData = array('');
			fputcsv($f, $csvData, $delimiter);
		}

		fseek($f, 0);

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');

		fpassthru($f);
	}

    public function ajax_load_item_details()
    {
        $post = $this->input->post();
        $this->page_data['item_details'] = $this->customer_ad_model->get_customer_item_details($post['customer_id']);
        $this->load->view('v2/pages/customer/ajax_load_item_details', $this->page_data);
    }

    public function ajax_payment_method_images()
    {
        $this->load->model('AcsCustomerDocument_model');

        $post = $this->input->post();
        if( $post['customer_id'] > 0 ){
            $documents = $this->AcsCustomerDocument_model->getAllByCustomerIdAndDocumentType($post['customer_id'], 'payment_details');
            $this->page_data['documents'] = $documents;
            $this->load->view('v2/pages/customer/ajax_payment_method_images', $this->page_data);
        }
    }    

    public function ajax_ledger_balance_amount()
    {
        $this->load->model('Payment_records_model');
        $this->load->model('Invoice_model');
        
        $post = $this->input->post();
        
        $invoices   = $this->Invoice_model->getAllByCustomerIdAndCompanyId($post['customer_id'], $company_id);
        $g_total_payment = 0;
        $g_total_income  = 0;
        foreach( $invoices as $invoice ){
            $payments = $this->Payment_records_model->getAllByInvoiceId($invoice->id);            
            $total_payment = 0;
            $payment_method = '---';
            foreach( $payments as $p ){
                $total_payment += $p->invoice_amount;
            }

            $g_total_income += $invoice->grand_total;
            $g_total_payment += $total_payment;
        }
        
        $balance = $g_total_income - $g_total_payment;

        if($balance < 0) {
            $balance = 0;
        }

        $return = ['balance' => $balance];
        echo json_encode($return);
    }    

    public function ajax_upload_payment_method_image()
    {
        $this->load->model('AcsCustomerDocument_model');

        $is_success = 1;
        $msg = 'Cannot save data';

        $post = $this->input->post();
        $document = $_FILES['admin_image'];        

        $filePath = FCPATH . (implode(DIRECTORY_SEPARATOR, ['uploads', 'customerdocuments', $post['customer_id']]) . DIRECTORY_SEPARATOR);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }

        // $maxSizeInMB = 8;
        // if ($document['size'] > self::ONE_MB * $maxSizeInMB) {
        //     $msg = "Maximum file size is less than {$maxSizeInMB}MB";   
        //     $is_success = 0;         
        // }

        if( $is_success ){
            $tempName = $document['tmp_name'];
            $fileName = $document['name'];
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileName = uniqid($post['customer_id']) . str_replace('.tmp', '', basename($tempName)) . '.' . $fileExtension;
            $data = [
                'file_name' => $fileName,
                'customer_id' => $post['customer_id'],
                'document_type' => 'payment_details',
                'document_label' => 'Payment Details',
                'is_predefined' => 1,
                'date_created' => date("Y-m-d H:i:s")
            ];

            $this->AcsCustomerDocument_model->create($data);

            move_uploaded_file($tempName, $filePath . $fileName);

            $is_success = 1;
            $msg = '';

            //Activity Logs
            $activity_name = 'Customer : Uploaded payment details ' . $fileName; 
            createActivityLog($activity_name);
        }
 
        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }    

    public function ajax_capture_payment_form()
    {        
        // Stripe SDK
        include APPPATH . 'libraries/stripe/init.php';  

        $post = $this->input->post();
        $total_cost = $post['processing_fee'] + $post['payment_amount'];
        $stripe_amount  = number_format(($total_cost*100) , 0, '', '');

        $stripe = new Stripe\StripeClient(STRIPE_SECRET_KEY);
        $result = $stripe->paymentIntents->create([
            'amount' => $stripe_amount,
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
        ]);

        $stripe_client_secret = $result->client_secret;
        $this->page_data['total_cost'] = $total_cost;
        $this->page_data['processing_fee'] = $post['processing_fee'];
        $this->page_data['payment_amount'] = $post['payment_amount'];
        $this->page_data['stripe_client_secret']    = $stripe_client_secret;
        $this->load->view('v2/pages/customer/ajax_capture_payment_form', $this->page_data);
    }

    public function ajax_financing_equipment_details()
    {        
        $post = $this->input->post();

        $billing_info = $this->customer_ad_model->get_data_by_id('fk_prof_id', $post['customer_id'], 'acs_billing');
        
        $this->page_data['billing_info'] = $billing_info;
        $this->load->view('v2/pages/customer/ajax_financing_equipment_details', $this->page_data);
    }

    public function ajax_create_installer_code()
    {
        $this->load->model('AcsAlarmInstallerCode_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $installer_code_id = 0;
        $installer_code = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AcsAlarmInstallerCode_model->getByCodeAndCompanyId($post['installer_code'], $company_id);
        if( $isExists ){
            $msg = 'Installer code ' . $post['installer_code'] . ' already exists.';
        }elseif( $post['installer_code'] == '' ){
            $msg = 'Please enter installer code';
        }else{
            $data = [
                'company_id' => $company_id,
                'installer_code' => $post['installer_code'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $installer_code_id = $this->AcsAlarmInstallerCode_model->create($data);
            $installer_code = $post['installer_code'];

            //Activity Logs
            $activity_name = 'Installer Code : Created installer code ' . $post['installer_code']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'installer_code_id' => $installer_code_id, 'installer_code' => $installer_code];
        echo json_encode($return);
    }

    public function ajax_update_installer_code()
    {
        $this->load->model('AcsAlarmInstallerCode_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isCodeExists = $this->AcsAlarmInstallerCode_model->getByCodeAndCompanyId($post['installer_code'], $company_id);
        if( $isCodeExists && $post['installer_code_id'] != $isCodeExists->id ){
            $msg = 'Installer code ' . $post['installer_code'] . ' already exists.';
        }elseif( $post['installer_code'] == '' ){
            $msg = 'Please enter installer code';
        }else{
            $installerCode = $this->AcsAlarmInstallerCode_model->getByIdAndCompanyId($post['installer_code_id'], $company_id);
            if( $installerCode ){
                $data = [
                    'installer_code' => $post['installer_code'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                $this->AcsAlarmInstallerCode_model->update($installerCode->id, $data);

                //Activity Logs
                $activity_name = 'Installer Code : Updated installer code ' . $post['installer_code']; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
            }
            
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_installer_code()
    {
        $this->load->model('AcsAlarmInstallerCode_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $installerCode = $this->AcsAlarmInstallerCode_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($installerCode) {
            $this->AcsAlarmInstallerCode_model->delete($installerCode->id);

            //Activity Logs
            $activity_name = 'Installer Code : Deleted installer code ' . $installerCode->installer_code; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_selected_installer_codes()
	{
		$this->load->model('AcsAlarmInstallerCode_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['installerCodes'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->AcsAlarmInstallerCode_model->bulkDelete($post['installerCodes'], $filters);

			//Activity Logs
			$activity_name = 'Installer Code : Deleted ' .$total_deleted. ' installer code(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function settings_alarm_installer_codes()
    {
        $this->load->model('AcsAlarmInstallerCode_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $installerCodes = $this->AcsAlarmInstallerCode_model->getAllByCompanyId($company_id);

        $this->page_data['installerCodes'] = $installerCodes;
        $this->page_data['page']->title = 'Alarm Installer Codes';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/settings_alarm_installer_codes', $this->page_data);
    }

    public function ajax_alarm_customer_zones()
    {
        $this->load->model('AcsAlarmZone_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $alarmZones = $this->AcsAlarmZone_model->getAllByCustomerId($post['customer_id']);

        $this->page_data['alarmZones'] = $alarmZones;
        $this->page_data['customer_id'] = $post['customer_id'];
        $this->load->view('v2/pages/customer/ajax_alarm_customer_zones', $this->page_data);
    }

    public function ajax_create_alarm_zones()
    {
        $this->load->model('AcsAlarmZone_model');
        $this->load->model('AcsProfile_model');

		$is_success = 0;
        $msg    = 'Cannot save data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $customer = $this->AcsProfile_model->getByProfId($post['customer_id']);
        if( $customer && $customer->company_id == $company_id ){
            $total_created = 0;
            foreach($post['zone_id'] as $key => $value){
                if( $value != '' ){
                    $data = [
                        'docfile_id' => 0,
                        'company_id' => $company_id,
                        'customer_id' => $customer->prof_id,
                        'zone_id' => $value ?? '',
                        'type' => $post['zone_type'][$key] ?? '',
                        'event_code' => $post['zone_event_code'][$key] ?? '',
                        'location' => $post['zone_location'][$key] ?? '',
                        'date_created' => date("Y-m-d H:i:s"),
                        'date_updated' => date("Y-m-d H:i:s"),
                    ];

                    $this->AcsAlarmZone_model->create($data);

                    $total_created++;
                }
                
            }
        }

        if( $total_created > 0 ){
            //Activity Logs
            if( $total_created > 1 ){
                $activity_name = 'Customer : Created ' . $total_created . ' zones for customer ' . $customer->first_name . ' ' . $customer->last_name;
            }else{
                $activity_name = 'Customer : Created ' . $total_created . ' zone for customer ' . $customer->first_name . ' ' . $customer->last_name;
            }

            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'No data created.';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_alarm_zone()
    {
        $this->load->model('AcsAlarmZone_model');

		$is_success = 0;
        $msg    = 'Cannot find data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $alarmZone = $this->AcsAlarmZone_model->getById($post['id']);
        if( $alarmZone && $alarmZone->company_id == $company_id ){

            $this->AcsAlarmZone_model->delete($alarmZone->id);

            //Activity Logs
            $activity_name = 'Customer : Deleted zone id ' . $alarmZone->zone_id; 

            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_edit_alarm_zone()
    {
        $this->load->model('AcsAlarmZone_model');

		$is_success = 0;
        $msg    = 'Cannot find data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $alarmZone = $this->AcsAlarmZone_model->getById($post['zone_id']);
        if( $alarmZone && $alarmZone->company_id == $company_id ){
            $this->page_data['alarmZone'] = $alarmZone;
            $this->load->view('v2/pages/customer/ajax_edit_alarm_zone', $this->page_data);
        }
    }

    public function ajax_update_alarm_zones()
    {
        $this->load->model('AcsAlarmZone_model');

		$is_success = 0;
        $msg    = 'Cannot save data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $alarmZone = $this->AcsAlarmZone_model->getById($post['zid']);
        if( $alarmZone && $alarmZone->company_id == $company_id ){
            $data = [
                'zone_id' => $post['zone_id'],
                'type' => $post['zone_type'],
                'event_code' => $post['zone_event_code'],
                'location' => $post['zone_location'],
                'date_updated' => date("Y-m-d H:i:s"),
            ];

            $this->AcsAlarmZone_model->update($alarmZone->id, $data);

            //Activity Logs
            $activity_name = 'Customer : Updated zone id ' . $post['zone_id'] . ' for customer ' . $alarmZone->first_name . ' ' . $alarmZone->last_name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_selected_zones()
    {
        $this->load->model('AcsAlarmZone_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['alarmZones'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->AcsAlarmZone_model->bulkDelete($post['alarmZones'], $filter);

            //Activity Logs
            if( $total_deleted > 1 ){
                $activity_name = 'Customer : Permanently deleted ' .$total_deleted. ' zones'; 
            }else{
                $activity_name = 'Customer : Permanently deleted ' .$total_deleted. ' zone'; 
            }
            
            createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function export_zones_list($customer_id)
    {
        $this->load->model('AcsAlarmZone_model');
		
		$cid     = logged('company_id');
		$zones = $this->AcsAlarmZone_model->getAllByCustomerId($customer_id);

		$delimiter = ",";
		$time      = time();
		$filename  = "customer_zones_list_" . $time . ".csv";

		$f = fopen('php://memory', 'w');

		$fields = array('Name', 'Zone ID', 'Type', 'Event Code', 'Location');
		fputcsv($f, $fields, $delimiter);

		if (!empty($zones)) {
			foreach ($zones as $z) {
				$csvData = array(
					$z->first_name . ' ' . $z->last_name,
					$z->zone_id,
					$z->type,
                    $z->event_code,
                    $z->location
				);
				fputcsv($f, $csvData, $delimiter);
			}
		} else {
			$csvData = array('');
			fputcsv($f, $csvData, $delimiter);
		}

		fseek($f, 0);

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');

		fpassthru($f);
    }

    public function ajax_customer_emergency_agencies()
    {
        $this->load->model('AcsCustomerEmergencyAgency_model');

		$is_success = 0;
        $msg    = 'Cannot find data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $emergencyAgencies = $this->AcsCustomerEmergencyAgency_model->getAllByCustomerId($post['customer_id']);
        $this->page_data['customer_id'] = $post['customer_id'];
        $this->page_data['emergencyAgencies'] = $emergencyAgencies;
        $this->load->view('v2/pages/customer/ajax_customer_emergency_agencies', $this->page_data);
    }

    public function ajax_create_emergency_agencies()
    {
        $this->load->model('AcsCustomerEmergencyAgency_model');
        $this->load->model('AcsProfile_model');

		$is_success = 0;
        $msg    = 'Cannot save data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $customer = $this->AcsProfile_model->getByProfId($post['customer_id']);
        if( $customer && $customer->company_id == $company_id ){
            $total_created = 0;
            foreach($post['agency'] as $key => $value){
                if( $value != '' ){
                    $data = [
                        'company_id' => $company_id,
                        'customer_id' => $customer->prof_id,
                        'agency' => $value ?? '',
                        'agency_phone' => $post['agency_phone'][$key] ?? '',
                        'agency_name' => $post['agency_name'][$key] ?? '',
                        'permit_number' => $post['permit_number'][$key] ?? '',
                        'permit_exp' => $post['permit_exp'][$key] ?? '',
                        'effective_date' => $post['effective_date'][$key] ?? '',
                        'date_created' => date("Y-m-d H:i:s"),
                        'date_updated' => date("Y-m-d H:i:s"),
                    ];

                    $this->AcsCustomerEmergencyAgency_model->create($data);
                    $total_created++;
                }
            }
        }

        if( $total_created > 0 ){
            //Activity Logs
            if( $total_created > 1 ){
                $activity_name = 'Customer : Created ' . $total_created . ' emergency agencies for customer ' . $customer->first_name . ' ' . $customer->last_name;
            }else{
                $activity_name = 'Customer : Created ' . $total_created . ' emergency agencies for customer ' . $customer->first_name . ' ' . $customer->last_name;
            }

            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }else{
            $msg = 'No data created.';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_emergency_agency()
    {
        $this->load->model('AcsCustomerEmergencyAgency_model');

		$is_success = 0;
        $msg    = 'Cannot find data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $emergencyAgency = $this->AcsCustomerEmergencyAgency_model->getById($post['id']);
        if( $emergencyAgency && $emergencyAgency->company_id == $company_id ){

            $this->AcsCustomerEmergencyAgency_model->delete($emergencyAgency->id);

            //Activity Logs
            $activity_name = 'Customer : Deleted emergency agency ' . $emergencyAgency->agency_name; 

            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_edit_emergency_agency()
    {
        $this->load->model('AcsCustomerEmergencyAgency_model');

		$is_success = 0;
        $msg    = 'Cannot find data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $emergencyAgency = $this->AcsCustomerEmergencyAgency_model->getById($post['agency_id']);
        if( $emergencyAgency && $emergencyAgency->company_id == $company_id ){
            $this->page_data['emergencyAgency'] = $emergencyAgency;
            $this->load->view('v2/pages/customer/ajax_edit_emergency_agency', $this->page_data);
        }
    }

    public function ajax_update_emergency_agency()
    {
        $this->load->model('AcsCustomerEmergencyAgency_model');

		$is_success = 0;
        $msg    = 'Cannot save data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $emergencyAgency = $this->AcsCustomerEmergencyAgency_model->getById($post['eaid']);
        if( $emergencyAgency && $emergencyAgency->company_id == $company_id ){
            $data = [
                'agency' => $post['agency_code'],
                'agency_phone' => $post['agency_phone'],
                'agency_name' => $post['agency_name'],
                'permit_number' => $post['permit_number'],
                'permit_exp' => $post['permit_exp'],
                'effective_date' => $post['effective_date'],
                'date_updated' => date("Y-m-d H:i:s"),
            ];

            $this->AcsCustomerEmergencyAgency_model->update($emergencyAgency->id, $data);

            //Activity Logs
            $activity_name = 'Customer : Updated emegency agency name ' . $post['agency_name'] . ' for customer ' . $emergencyAgency->first_name . ' ' . $emergencyAgency->last_name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_selected_emergency_agencies()
    {
        $this->load->model('AcsCustomerEmergencyAgency_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['emergencyAgencies'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->AcsCustomerEmergencyAgency_model->bulkDelete($post['emergencyAgencies'], $filter);

            //Activity Logs
            if( $total_deleted > 1 ){
                $activity_name = 'Customer : Permanently deleted ' .$total_deleted. ' emergency agencies'; 
            }else{
                $activity_name = 'Customer : Permanently deleted ' .$total_deleted. ' emergency agency'; 
            }
            
            createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function export_emergency_agency_list($customer_id)
    {
        $this->load->model('AcsCustomerEmergencyAgency_model');
		
		$cid     = logged('company_id');
		$emergencyAgencies = $this->AcsCustomerEmergencyAgency_model->getAllByCustomerId($customer_id);

		$delimiter = ",";
		$time      = time();
		$filename  = "customer_emergency_agencies_list_" . $time . ".csv";

		$f = fopen('php://memory', 'w');

		$fields = array('Name', 'Agency', 'Agency Phone', 'Agency Name', 'Permit Number', 'Permit EXP', 'Effective Date');
		fputcsv($f, $fields, $delimiter);

		if (!empty($emergencyAgencies)) {
			foreach ($emergencyAgencies as $ea) {
				$csvData = array(
					$ea->first_name . ' ' . $ea->last_name,
					$ea->agency,
					$ea->agency_phone,
                    $ea->agency_name,
                    $ea->permit_number,
                    date("m/d/Y",strtotime($ea->permit_exp)),
                    date("m/d/Y",strtotime($ea->effective_date)),
				);
				fputcsv($f, $csvData, $delimiter);
			}
		} else {
			$csvData = array('');
			fputcsv($f, $csvData, $delimiter);
		}

		fseek($f, 0);

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');

		fpassthru($f);
    }

    public function settings_alarm_site_types()
    {
        $this->load->model('AcsAlarmSiteType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $alarmSiteTypes = $this->AcsAlarmSiteType_model->getAllByCompanyId($company_id);

        $this->page_data['alarmSiteTypes'] = $alarmSiteTypes;
        $this->page_data['page']->title = 'Alarm Site Types';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/settings_alarm_site_types', $this->page_data);
    }

    public function ajax_create_site_type()
    {
        $this->load->model('AcsAlarmSiteType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $site_type_id   = 0;
        $site_type_name = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AcsAlarmSiteType_model->getByNameAndCompanyId($post['site_type'], $company_id);
        if( $isExists ){
            $msg = 'Site type ' . $post['site_type'] . ' already exists.';
        }elseif( $post['site_type'] == '' ){
            $msg = 'Please enter site type name';
        }else{
            $data = [
                'company_id' => $company_id,
                'name' => $post['site_type'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $site_type_id = $this->AcsAlarmSiteType_model->create($data);
            $site_type_name = $post['site_type'];

            //Activity Logs
            $activity_name = 'Site Type : Created site type ' . $post['site_type']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'site_type_id' => $site_type_id, 'site_type_name' => $site_type_name];
        echo json_encode($return);
    }

    public function ajax_delete_site_type()
    {
        $this->load->model('AcsAlarmSiteType_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $siteType = $this->AcsAlarmSiteType_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($siteType) {
            $this->AcsAlarmSiteType_model->delete($siteType->id);

            //Activity Logs
            $activity_name = 'Site Type : Deleted site type ' . $siteType->name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function ajax_update_site_type()
    {
        $this->load->model('AcsAlarmSiteType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isSiteTypeExists = $this->AcsAlarmSiteType_model->getByNameAndCompanyId($post['site_type'], $company_id);
        if( $isSiteTypeExists && $post['site_type_id'] != $isSiteTypeExists->id ){
            $msg = 'Site type ' . $post['site_type'] . ' already exists.';
        }elseif( $post['site_type'] == '' ){
            $msg = 'Please enter site type';
        }else{
            $siteType = $this->AcsAlarmSiteType_model->getByIdAndCompanyId($post['site_type_id'], $company_id);
            if( $siteType ){
                $data = [
                    'name' => $post['site_type'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                $this->AcsAlarmSiteType_model->update($siteType->id, $data);

                //Activity Logs
                $activity_name = 'Site Type : Updated site type ' . $post['site_type']; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
            }
            
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_selected_site_types()
	{
		$this->load->model('AcsAlarmSiteType_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['siteTypes'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->AcsAlarmSiteType_model->bulkDelete($post['siteTypes'], $filters);

			//Activity Logs
            if( $total_delete > 1 ){
                $activity_name = 'Site Types : Deleted ' .$total_deleted. ' site types'; 
            }else{
                $activity_name = 'Site Types : Deleted ' .$total_deleted. ' site type'; 
            }
			
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_set_default_site_type()
    {
        $this->load->model('AcsAlarmSiteType_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $siteType = $this->AcsAlarmSiteType_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($siteType) {
            $this->AcsAlarmSiteType_model->resetDefaultByCompanyId($company_id);
            $this->AcsAlarmSiteType_model->update($siteType->id, ['is_default' => 'Yes']);

            //Activity Logs
            $activity_name = 'Site Type : Set default value to ' . $siteType->name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }
    
    public function ajax_set_default_installer_code()
    {
        $this->load->model('AcsAlarmInstallerCode_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $installerCode = $this->AcsAlarmInstallerCode_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($installerCode) {
            $this->AcsAlarmInstallerCode_model->resetDefaultByCompanyId($company_id);
            $this->AcsAlarmInstallerCode_model->update($installerCode->id, ['is_default' => 'Yes']);

            //Activity Logs
            $activity_name = 'Installer Code : Set default value to ' . $installerCode->installer_code; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function settings_account_types()
    {
        $this->load->model('AcsAccountType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $accountTypes = $this->AcsAccountType_model->getAllByCompanyId($company_id);

        $this->page_data['accountTypes'] = $accountTypes;
        $this->page_data['page']->title = 'Account Types';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/settings_account_types', $this->page_data);
    }

    public function ajax_create_account_type()
    {
        $this->load->model('AcsAccountType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $account_type_id = 0;
        $account_type = 0;

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AcsAccountType_model->getByAccountTypeAndCompanyId($post['account_type'], $company_id);
        if( $isExists ){
            $msg = 'Account type ' . $post['account_type'] . ' already exists.';
        }elseif( $post['account_type'] == '' ){
            $msg = 'Please enter account type';
        }else{
            $data = [
                'company_id' => $company_id,
                'account_type' => $post['account_type'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            ];

            $account_type_id = $this->AcsAccountType_model->create($data);
            $account_type = $post['account_type'];

            //Activity Logs
            $activity_name = 'Account Types : Created account type ' . $post['account_type']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'account_type_id' => $account_type_id, 'account_type' => $account_type];
        echo json_encode($return);
    }

    public function ajax_update_account_type()
    {
        $this->load->model('AcsAccountType_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isAccountTypeExists = $this->AcsAccountType_model->getByAccountTypeAndCompanyId($post['account_type'], $company_id);
        if( $isAccountTypeExists && $post['account_type_id'] != $isAccountTypeExists->id ){
            $msg = 'Account type ' . $post['account_type'] . ' already exists.';
        }elseif( $post['account_type'] == '' ){
            $msg = 'Please enter account type';
        }else{
            $accountType = $this->AcsAccountType_model->getByIdAndCompanyId($post['account_type_id'], $company_id);
            if( $accountType ){
                $data = [
                    'account_type' => $post['account_type'],
                    'date_modified' => date("Y-m-d H:i:s")
                ];

                $this->AcsAccountType_model->update($accountType->id, $data);

                //Activity Logs
                $activity_name = 'Account Types : Updated account type ' . $post['account_type']; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
            }
            
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_account_type()
    {
        $this->load->model('AcsAccountType_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $accountType = $this->AcsAccountType_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($accountType) {
            $this->AcsAccountType_model->delete($accountType->id);

            //Activity Logs
            $activity_name = 'Account Types : Deleted account type ' . $accountType->account_type; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function ajax_set_default_account_type()
    {
        $this->load->model('AcsAccountType_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $accountType = $this->AcsAccountType_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($accountType) {
            $this->AcsAccountType_model->resetDefaultByCompanyId($company_id);
            $this->AcsAccountType_model->update($accountType->id, ['is_default' => 'Yes']);

            //Activity Logs
            $activity_name = 'Account Types : Set default value to ' . $accountType->account_type; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_selected_account_types()
	{
		$this->load->model('AcsAccountType_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['accountTypes'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->AcsAccountType_model->bulkDelete($post['accountTypes'], $filters);

			//Activity Logs
            if( $total_deleted > 1 ){
                $activity_name = 'Account Types : Deleted ' .$total_deleted. ' account types'; 
            }else{
                $activity_name = 'Account Types : Deleted ' .$total_deleted. ' account type'; 
            }
			
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function settings_alarm_monitoring_companies()
    {
        $this->load->model('AcsAlarmMonitoringCompany_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $monitoringCompanies = $this->AcsAlarmMonitoringCompany_model->getAllByCompanyId($company_id);

        $this->page_data['monitoringCompanies'] = $monitoringCompanies;
        $this->page_data['page']->title = 'Alarm Monitoring Companies';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/settings_alarm_monitoring_companies', $this->page_data);
    }

    public function ajax_create_monitoring_company()
    {
        $this->load->model('AcsAlarmMonitoringCompany_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $monitoring_company_id   = 0;
        $monitoring_company_name = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AcsAlarmMonitoringCompany_model->getByNameAndCompanyId($post['monitoring_company'], $company_id);
        if( $isExists ){
            $msg = 'Monitoring company name ' . $post['monitoring_company'] . ' already exists.';
        }elseif( $post['monitoring_company'] == '' ){
            $msg = 'Please enter monitoring company name';
        }else{
            $data = [
                'company_id' => $company_id,
                'name' => $post['monitoring_company'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $monitoring_company_id = $this->AcsAlarmMonitoringCompany_model->create($data);
            $monitoring_company_name = $post['monitoring_company'];

            //Activity Logs
            $activity_name = 'Monitoring Companies : Created monitoring company ' . $post['monitoring_company']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'monitoring_company_id' => $monitoring_company_id, 'monitoring_company_name' => $monitoring_company_name];
        echo json_encode($return);
    }

    public function ajax_update_monitoring_company()
    {
        $this->load->model('AcsAlarmMonitoringCompany_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AcsAlarmMonitoringCompany_model->getByNameAndCompanyId($post['monitoring_company'], $company_id);
        if( $isExists && $post['monitoring_company_id'] != $isExists->id ){
            $msg = 'Monitoring company name ' . $post['monitoring_company'] . ' already exists.';
        }elseif( $post['monitoring_company'] == '' ){
            $msg = 'Please enter monitoring company name';
        }else{
            $monitoringCompany = $this->AcsAlarmMonitoringCompany_model->getByIdAndCompanyId($post['monitoring_company_id'], $company_id);
            if( $monitoringCompany ){
                $data = [
                    'name' => $post['monitoring_company'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                $this->AcsAlarmMonitoringCompany_model->update($monitoringCompany->id, $data);

                //Activity Logs
                $activity_name = 'Monitoring Companies : Updated monitoring company ' . $post['monitoring_company']; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    
    public function ajax_permanently_delete_selected_attachment()
    {
		$is_success = 0;
        $msg    = 'Please select data';

        $post = $this->input->post();
        $id   = $post['id'];

        if($id) {
            $is_delete = $this->workorder_model->deleteAcsCustomerDocument($id);
            if($is_delete) {
                $is_success = 1;
                $msg    = '';
            }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];
        echo json_encode($return);

    }  
    
    public function ajax_get_account_cost()
    {
        $this->load->model('SystemPackageType_model');

        $account_cost   = 0;
        $pass_thru_cost = 0;
        $company_id   = logged('company_id');
        $post         = $this->input->post();

        $systemPackage = $this->SystemPackageType_model->getByNameAndCompanyId($post['service_package_type'], $company_id);
        if( $systemPackage ){
            if( $post['service_provider'] == 'Alarm.com' ){
                $pass_thru_cost = $systemPackage->alarmcom_cost > 0 ? $systemPackage->alarmcom_cost : 0;                
            }elseif( $post['service_provider'] == 'AlarmNet' ){
                $pass_thru_cost = $systemPackage->alarmnet_cost > 0 ? $systemPackage->alarmnet_cost : 0;
            }

            $account_cost = $systemPackage->acct_cost;
        }

        $return = ['account_cost' => $account_cost, 'pass_thru_cost' => $pass_thru_cost];
        echo json_encode($return);
    }

    public function ajax_send_customer_cancellation_request()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('AcsCustomerCancellationRequest');
        $this->load->model('Users_model');

        $is_live_mail_credentials = false;
        $is_success = 0;
        $msg    = 'Cannot find customer data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $cancellationRequest = $this->AcsCustomerCancellationRequest->getByCustomerId($post['customer_id']);
        $customer = $this->AcsProfile_model->getByProfId($post['customer_id']);
        if( $customer && $customer->company_id == $company_id ){
            if( $cancellationRequest ){
                $data = [
                    'request_date' => date("Y-m-d",strtotime($post['date_request_received'])),
                    'reason' => $post['reason'],
                    'boc_amount' => $post['boc_amount'],
                    'boc_received_date' => date("Y-m-d",strtotime($post['boc_received_date'])),
                    'cs_close_date' => date("Y-m-d",strtotime($post['cs_closed_ate'])),
                    'equipment_return_date' => date("Y-m-d",strtotime($post['equipment_return_date'])),
                    'next_action' => $post['next_step'],
                    'date_modified' => date("Y-m-d H:i:s"),
                ];
                $this->AcsCustomerCancellationRequest->update($cancellationRequest->id, $data);      
            }else{
                $data = [
                    'customer_id' => $customer->prof_id,
                    'request_date' => date("Y-m-d",strtotime($post['date_request_received'])),
                    'reason' => $post['reason'],
                    'boc_amount' => $post['boc_amount'],
                    'boc_received_date' => date("Y-m-d",strtotime($post['boc_received_date'])),
                    'cs_close_date' => date("Y-m-d",strtotime($post['cs_closed_ate'])),
                    'equipment_return_date' => date("Y-m-d",strtotime($post['equipment_return_date'])),
                    'next_action' => $post['next_step'],
                    'date_created' => date("Y-m-d H:i:s"),
                    'date_modified' => date("Y-m-d H:i:s"),
                ];

                $this->AcsCustomerCancellationRequest->create($data);    
            }

            $attachment = '';

            //Send email
            $companyAdmin = $this->Users_model->getCompanyAdmin($company_id);
            if( $companyAdmin && $companyAdmin->email != '' ){
                $email_data['name'] = $companyAdmin->FName;
                $email_data['customer_name'] = $customer->first_name . ' ' . $customer->last_name;
                $cancellation_url = base_url('customer/cancellation_request/'.$customer->prof_id);
                $email_data['cancellation_url'] = $cancellation_url;
                $body = $this->load->view('v2/emails/customer_cancellation_request', $email_data, true);

                $to_send = 'bryann.revina03@gmail.com'; //$companyAdmin->email;

                if($is_live_mail_credentials) {
                    $mail = email__getInstance();
                    $mail->FromName = 'nSmarTrac';
                    $recipient_name = $companyAdmin->FName . ' ' . $companyAdmin->LName;
                    $mail->addAddress($to_send, $recipient_name);
                    $mail->isHTML(true);
                    $mail->Subject = "Customer Request for Cancellation";
                    $mail->Body = $body;
                    if($attachment) {
                        $mail->addAttachment($attachment);
                    }
                    $mail->Send();                    
                } else {
                    $host     = 'smtp.mailtrap.io';
                    $port     = 2525;
                    $username = 'd7c92e3b5e901d';
                    $password = '203aafda110ab7';
                    $from     = 'noreply@nsmartrac.com';       
                    
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->Host = $host;
                    $mail->SMTPAuth = true;
                    $mail->Username = $username;
                    $mail->Password = $password;
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = $port;            
                                                                                          
                    $mail->FromName = 'nSmarTrac';  
                    $recipient_name = $companyAdmin->FName . ' ' . $companyAdmin->LName;
                    $mail->setFrom('noreply@nsmartrac.com', 'nSmartrac');
                    $mail->addAddress($companyAdmin->email, $recipient_name);
                    $mail->isHTML(true);
                    $mail->Subject = "Customer Request for Cancellation";
                    $mail->Body = $body;
                    $mail->addAttachment($attachment);
                    $mail->Send();   
                } 
            }

            $is_success = 1;
            $msg = '';
        }
        
        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];
        echo json_encode($return);
    }

    public function ajax_update_customer_collection_request()
    {
        $this->load->model('AcsCustomerCancellationRequest');
        $this->load->model('Customer_advance_model');

        $company_id = logged('company_id');
        $is_success = 0;
        $msg = 'Cannot find customer data';

        $post = $this->input->post();
        if($post) {
            $post_data['id'] = $post['id'];
            $post_data['send_to_collection'] = $post['send_to_collection'];
            $post_data['statement_of_claim'] = $post['statement_of_claim'];
            $post_data['court_date'] = $post['court_date'];
            $post_data['claim_amount'] = $post['claim_amount'];
            $post_data['award_amount'] = $post['award_amount'];
            $update_collection = $this->Customer_advance_model->update_data($post_data, 'acs_customer_cancellation_requests', 'id');
            if($update_collection) {
                $is_success = 1;
                $msg = 'Customer collection has been updated successfully.';
            }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];
        echo json_encode($return);
    }    

    public function ajax_set_default_monitoring_company()
    {
        $this->load->model('AcsAlarmMonitoringCompany_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $monitoringCompany = $this->AcsAlarmMonitoringCompany_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($monitoringCompany) {
            $this->AcsAlarmMonitoringCompany_model->resetDefaultByCompanyId($company_id);
            $this->AcsAlarmMonitoringCompany_model->update($monitoringCompany->id, ['is_default' => 'Yes']);

            //Activity Logs
            $activity_name = 'Monitoring Company : Set default value to ' . $monitoringCompany->name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_selected_monitoring_companies()
	{
		$this->load->model('AcsAlarmMonitoringCompany_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['monitoringCompanies'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->AcsAlarmMonitoringCompany_model->bulkDelete($post['monitoringCompanies'], $filters);

			//Activity Logs
            if( $total_deleted > 1 ){
                $activity_name = 'Monitoring Company : Deleted ' .$total_deleted. ' monitoring companies'; 
            }else{
                $activity_name = 'Monitoring Company : Deleted ' .$total_deleted. ' monitoring company'; 
            }
			
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function verifyCustomer()
    {
        $company_id  = logged('company_id');
        $customer_id = $this->input->post('customer_id');
        $state       = $this->input->post('state') === 'true' ? 1 : 0;

        $this->db->where('prof_id', $customer_id);
        $this->db->where('company_id', $company_id);
        $execute = $this->db->update('acs_profile', ['is_verified' => $state]);

        echo $execute;
    }

    public function settings_alarm_receiver_phone_numbers()
    {
        $this->load->model('AcsAlarmReceiverPhoneNumber_model');

        if(!checkRoleCanAccessModule('customer-settings', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');
        $receiverPhoneNumbers = $this->AcsAlarmReceiverPhoneNumber_model->getAllByCompanyId($company_id);

        $this->page_data['receiverPhoneNumbers'] = $receiverPhoneNumbers;
        $this->page_data['page']->title = 'Alarm Receiver Phone Numbers';
        $this->page_data['page']->parent = 'Customers';
        $this->load->view('v2/pages/customer/settings_alarm_receiver_phone_numbers', $this->page_data);
    }

    public function ajax_create_receiver_phone_number()
    {
        $this->load->model('AcsAlarmReceiverPhoneNumber_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot save data';
        $receiver_number_id   = 0;
        $receiver_number = '';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AcsAlarmReceiverPhoneNumber_model->getByReceiverNumberAndCompanyId($post['receiver_number'], $company_id);
        if( $isExists ){
            $msg = 'Receiver phone number ' . $post['receiver_number'] . ' already exists.';
        }elseif( $post['receiver_number'] == '' ){
            $msg = 'Please enter receiver phone number';
        }else{
            $data = [
                'company_id' => $company_id,
                'receiver_number' => $post['receiver_number'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $receiver_number_id = $this->AcsAlarmReceiverPhoneNumber_model->create($data);
            $receiver_number    = $post['receiver_number'];

            //Activity Logs
            $activity_name = 'Receiver Phone Number : Created receiver phone number ' . $post['receiver_number']; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg, 'receiver_number_id' => $receiver_number_id, 'receiver_number' => $receiver_number];
        echo json_encode($return);
    }

    public function ajax_update_receiver_phone_number()
    {
        $this->load->model('AcsAlarmReceiverPhoneNumber_model');

        if(!checkRoleCanAccessModule('customer-settings', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $isExists = $this->AcsAlarmReceiverPhoneNumber_model->getByReceiverNumberAndCompanyId($post['receiver_number'], $company_id);
        if( $isExists && $post['receiver_phone_number_id'] != $isExists->id ){
            $msg = 'Receiver phone number ' . $post['receiver_number'] . ' already exists.';
        }elseif( $post['receiver_number'] == '' ){
            $msg = 'Please enter receiver phone number';
        }else{
            $receiverPhoneNumber = $this->AcsAlarmReceiverPhoneNumber_model->getByIdAndCompanyId($post['receiver_phone_number_id'], $company_id);
            if( $receiverPhoneNumber ){
                $data = [
                    'receiver_number' => $post['receiver_number'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                $this->AcsAlarmReceiverPhoneNumber_model->update($receiverPhoneNumber->id, $data);

                //Activity Logs
                $activity_name = 'Receiver Phone Number : Updated receiver phone number ' . $post['receiver_number']; 
                createActivityLog($activity_name);

                $is_success = 1;
                $msg = '';
            }
            
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_delete_monitoring_company()
	{
		$this->load->model('AcsAlarmMonitoringCompany_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $monitoringCompany = $this->AcsAlarmMonitoringCompany_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($monitoringCompany) {
            $this->AcsAlarmMonitoringCompany_model->delete($monitoringCompany->id);

            //Activity Logs
            $activity_name = 'Monitoring Companies : Deleted monitoring company ' . $monitoringCompany->name; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
	}

    public function ajax_delete_receiver_number()
	{
		$this->load->model('AcsAlarmReceiverPhoneNumber_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $receiverPhoneNumber = $this->AcsAlarmReceiverPhoneNumber_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($receiverPhoneNumber) {
            $this->AcsAlarmReceiverPhoneNumber_model->delete($receiverPhoneNumber->id);

            //Activity Logs
            $activity_name = 'Receiver Phone Number : Deleted receiver phone number ' . $receiverPhoneNumber->receiver_number; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];
        

        echo json_encode($return);
	}

    public function ajax_delete_selected_receiver_numbers()
	{
		$this->load->model('AcsAlarmReceiverPhoneNumber_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['receiverPhoneNumbers'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->AcsAlarmReceiverPhoneNumber_model->bulkDelete($post['receiverPhoneNumbers'], $filters);

			//Activity Logs
            if( $total_delete > 1 ){
                $activity_name = 'Receiver Phone Number : Deleted ' .$total_deleted. ' phone numbers'; 
            }else{
                $activity_name = 'Receiver Phone Number : Deleted ' .$total_deleted. ' phone number'; 
            }
			
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_set_default_receiver_phone_number()
    {
        $this->load->model('AcsAlarmReceiverPhoneNumber_model');

        $is_success = 0;
        $msg = 'Cannot find record';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $receiverPhoneNumber = $this->AcsAlarmReceiverPhoneNumber_model->getByIdAndCompanyId($post['id'], $company_id);
        if ($receiverPhoneNumber) {
            $this->AcsAlarmReceiverPhoneNumber_model->resetDefaultByCompanyId($company_id);
            $this->AcsAlarmReceiverPhoneNumber_model->update($receiverPhoneNumber->id, ['is_default' => 'Yes']);

            //Activity Logs
            $activity_name = 'Receiver Phone Number : Set default value to ' . $receiverPhoneNumber->receiver_number; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
    }
}
