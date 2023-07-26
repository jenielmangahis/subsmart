<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
        $this->hasAccessModule(53);
        $this->load->model('ApiGoogleContact_model', 'api_gc');
        $this->load->model('UserDetails_model', 'user_details');
        $this->load->config('api_credentials');        
    }

    /* public function index()
      {
      $this->page_data['users'] = $this->users_model->getUser(logged('id'));
      $this->load->view('tools/business_tools', $this->page_data);
      } */

    public function api_connectors() {
        $this->page_data['page']->title = 'API Connectors';
        $this->page_data['page']->parent = 'Tools';

        $this->load->model('SettingOnlinePayment_model');
        $this->load->model('users_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('Clients_model');
        $this->load->model('CompanyApiConnector_model');
        
        $company_id = logged('company_id');    
        $user   = $this->session->userdata('logged');
        $client = $this->Clients_model->getById($company_id);
        $companyApiConnectors = $this->CompanyApiConnector_model->getAllEnabledByCompanyId($company_id);

        $enabledApiConnectors = array();
        foreach($companyApiConnectors as $ac){
            $enabledApiConnectors[$ac->api_name] = $ac->api_name;
        }

        $default_sms_api = $client->default_sms_api;

        $settingOnlinePayment = $this->SettingOnlinePayment_model->findByUserId($user['id']);
        $onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        if( $settingOnlinePayment ){
            $setting = [
                'paypal_email' => $settingOnlinePayment->paypal_email_address,
                'is_active' => $settingOnlinePayment->paypal_is_active
            ];
        }else{
            $setting = [
                'paypal_email' => '',
                'is_active' => 0
            ];
        }

        $this->page_data['enabledApiConnectors'] = $enabledApiConnectors;
        $this->page_data['onlinePaymentAccount'] = $onlinePaymentAccount;
        $this->page_data['setting'] = $setting;
        $this->page_data['default_sms_api'] = $default_sms_api;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('v2/pages/tools/api_connectors', $this->page_data);
    }

    public function api_sidebars()
    {
        $this->load->model('api_connectors_model');
        $sidebars = $this->api_connectors_model->getApiSidebars();

        return $sidebars;
    }

     public function saveGoogleAcount()
    {
        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $this->load->model('GoogleAccounts_model');

        $profile = google_get_oauth2_token($this->input->post('token'), $this->input->post('client_id'), $this->input->post('client_secret'));

        $user = $this->session->userdata('logged');
        $data = [
            'user_id' => $user['id'],
            'google_email' => $profile['user']->email,
            'google_access_token' => $profile['access_token'],
            'google_refresh_token' => $profile['refreshToken'],
            'date_created' => date("Y-m-d H:i:s")
        ];
        $googleAccount = $this->GoogleAccounts_model->create($data);


    }

    public function createGoogleContact()
    {
        session_start();
//        $temp = json_decode($_SESSION['token'], true);
//        $access = $temp['access_token'];

        $access =

        $contactXML = '<?xml version="1.0" encoding="utf-8"?>
        <atom:entry xmlns:atom="http://www.w3.org/2005/Atom" xmlns:gd="http://schemas.google.com/g/2005">
        <atom:category scheme="http://schemas.google.com/g/2005#kind" term="http://schemas.google.com/contact/2008#contact"/>
        <gd:name>
        <gd:givenName>Jackie</gd:givenName>
        <gd:fullName>Jackie Frost</gd:fullName>
        <gd:familyName>Frost</gd:familyName>
        </gd:name>
        <gd:email rel="http://schemas.google.com/g/2005#home" address="jackfrost@gmail.com"/>
        <gd:phoneNumber rel="http://schemas.google.com/g/2005#home" primary="true">1111111111</gd:phoneNumber>
        </atom:entry>';

        $headers = array(
            'Host: www.google.com',
            'Gdata-version: 3.0',
            'Content-length: '.strlen($contactXML),
            'Content-type: application/atom+xml',
            'Authorization: OAuth '.$access
        );

        $contactQuery = 'https://www.google.com/m8/feeds/contacts/default/full/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $contactQuery );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $contactXML);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        echo 'HTTP code: '. $httpcode;
    }

    public function zillow()
    {
        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('tools/zillow', $this->page_data);
    }

    public function business_tools() {
        $this->page_data['page']->title = 'Business Tools';
        $this->page_data['page']->parent = 'Tools';

        $is_allowed = $this->isAllowedModuleAccess(48);

        $this->page_data['sidebar'] = $this->api_sidebars();
        if (!$is_allowed) {
            $this->page_data['module'] = 'business_tools';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('v2/pages/tools/business_tools', $this->page_data);
    }

    public function google_contacts() {        
        $this->load->library('GoogleApi');
        $this->load->model('CompanyApiConnector_model');
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $companyGoogleContactsApi = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'google_contacts');
        $customers = $this->AcsProfile_model->getCustomerBasicInfoByCompanyId($company_id);

        $this->page_data['page']->title = 'Google Contacts';
        $this->page_data['page']->parent = 'Tools';
        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->page_data['total_customers'] = count($customers);        
        $this->page_data['google_credentials'] = google_credentials();        
        $this->page_data['api_enabled'] = false;       
        $this->page_data['companyGoogleContactsApi'] = $companyGoogleContactsApi;
        $this->load->view('v2/pages/tools/google_contacts', $this->page_data);
    }
    

    public function quickbooks() {
        $this->load->library('QuickbooksApi');
        $this->load->model('CompanyApiConnector_model');

        $company_id = logged('company_id');
        $companyQuickBooksPayroll = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'quickbooks_payroll');        
        if( $companyQuickBooksPayroll && $companyQuickBooksPayroll->status == 1 ){                  
            $token = $this->quickbooksapi->refresh_token($companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id);             
            $companyInfo = $this->quickbooksapi->get_qb_company_info_v2($token->getAccessToken(), $companyQuickBooksPayroll->qb_payroll_refresh_token, $companyQuickBooksPayroll->qb_payroll_realm_id);            
            //Update company refresh token
            $data_quickbooks['qb_payroll_refresh_token'] = $token->getRefreshToken();
            $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_quickbooks);

            $date_from = date("Y-m-d");
            $date_to   = date("Y-m-d");          
            $attendance_logs = $this->attendance_logs($date_from, $date_to);   
            $this->page_data['companyInfo'] = $companyInfo;
            $this->page_data['attendance_logs'] = $attendance_logs;
        }else{
            $qbAuth = $this->quickbooksapi->initialize_auth();
            $this->page_data['qbAuth_url'] = $qbAuth;
        }

        $this->page_data['companyQuickBooksPayroll'] = $companyQuickBooksPayroll;
        $this->page_data['page']->title = 'Quickbooks Payroll';
        $this->page_data['page']->parent = 'Tools';     
        $this->load->view('v2/pages/tools/quickbooks', $this->page_data);
    }

    public function quickbooks_connect(){
        $this->load->library('QuickbooksApi');
        $this->load->model('CompanyApiConnector_model');

        if( $this->input->get('code') != '' && $this->input->get('realmId') != '' ){
            $tokens     = $this->quickbooksapi->get_access_token($_SERVER['QUERY_STRING']);
            $company_id = logged('company_id');
            $companyQuickBooksPayroll = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'quickbooks_payroll');
            if( $companyQuickBooksPayroll ){
                $data_quickbooks = [
                    'qb_total_employee' => 0,
                    'qb_total_employee_synced' => 0, 
                    'qb_total_employee_failed_synced' => 0,                       
                    'status' => 1,
                    'qb_payroll_refresh_token' => $tokens->getRefreshToken(),                    
                    'qb_payroll_realm_id' => $this->input->get('realmId'),
                    'created' => date("Y-m-d H:i:s")
                ];
                $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_quickbooks);
            }else{
                $data_quickbooks = [
                    'company_id' => $company_id,
                    'qb_total_employee' => 0,
                    'qb_total_employee_synced' => 0, 
                    'qb_total_employee_failed_synced' => 0,
                    'api_name' => 'quickbooks_payroll',
                    'status' => 1,
                    'qb_payroll_refresh_token' => $tokens->getRefreshToken(),                    
                    'qb_payroll_realm_id' => $this->input->get('realmId'),
                    'created' => date("Y-m-d H:i:s")
                ];    

                $this->CompanyApiConnector_model->create($data_quickbooks);
            }

            redirect('tools/quickbooks');
        }else{
            redirect('tools/quickbooks?err=1');
        }
    }

    public function mailchimp() {
        $this->load->library('MailChimpApi');
        $this->load->model('MailChimpExportCustomerLogs_model');
        $this->load->model('CompanyApiConnector_model');

        $company_id    = logged('company_id');
        $mailchimpList = array();
        $companyMailChimp = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'mailchimp'); 
        $logs_summary     = array();
        if( $companyMailChimp && $companyMailChimp->status == 1 && $companyMailChimp->mailchimp_access_token != '' && $companyMailChimp->mailchimp_server_prefix != '' ){
            $mailChimp = new MailChimpApi;
            $mailchimpList = $mailChimp->getAllLists($companyMailChimp->mailchimp_access_token, $companyMailChimp->mailchimp_server_prefix);            
            foreach($mailchimpList->lists as $list){                     
                $query_filter      = array();
                $query_filter[]    = ['field' => 'is_sync', 'value' => 1];
                $exportSuccessLogs = $this->MailChimpExportCustomerLogs_model->getAllByListIdAndCompanyId($list->id, $company_id, $query_filter);                

                $query_filter      = array();
                $query_filter[]    = ['field' => 'is_with_error', 'value' => 1];
                $exportFailedLogs  = $this->MailChimpExportCustomerLogs_model->getAllByListIdAndCompanyId($list->id, $company_id, $query_filter);                

                $logs_summary[$list->id] = ['total_success' => count($exportSuccessLogs), 'total_failed' => count($exportFailedLogs)];
            }
        }       

        $is_with_error = 0;
        if( !empty($this->input->get('error')) && $this->input->get('error') == 1 ){
            $is_with_error = 1;            
        }

        $mailchimpStatusOptions = $this->MailChimpExportCustomerLogs_model->mailchimpStatusOptions();

        $this->page_data['companyMailChimp'] = $companyMailChimp;
        $this->page_data['mailchimpStatusOptions'] = $mailchimpStatusOptions;
        $this->page_data['mailchimpList'] = $mailchimpList;
        $this->page_data['logs_summary']  = $logs_summary;
        $this->page_data['is_with_error'] = $is_with_error;
        $this->page_data['page']->title = 'MailChimp';
        $this->page_data['page']->parent = 'Tools';
        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('v2/pages/tools/mailchimp', $this->page_data);
    }

    public function nicejob() {
        $this->page_data['page']->title = 'Nice Job';
        $this->page_data['page']->parent = 'Tools';

        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('v2/pages/tools/nicejob', $this->page_data);
    }

    public function zapier() {
        $this->load->model('CompanyApiConnector_model');

        $company_id   = logged('company_id');
        $apiConnector = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'zapier');

        $this->page_data['page']->title = 'Zapier';
        $this->page_data['page']->parent = 'Tools';
        $this->page_data['apiConnector'] = $apiConnector;

        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('v2/pages/tools/zapier', $this->page_data);
    }    

    public function active_campaign() {
        $this->page_data['page']->title = 'Active Campaign';
        $this->page_data['page']->parent = 'Tools';

        $this->load->view('v2/pages/tools/active_campaign', $this->page_data);
    }

    public function api_integration()
    {
        $this->page_data['page']->title = 'API Integration';
        $this->page_data['page']->parent = 'Tools';

        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('v2/pages/tools/api_integration', $this->page_data);
    }

    public function zapier_api_connect() {

    }

    public function google_contact_disable() {
        $input = array();
        $input['api_gc_enable'] = 0;
        if ($this->user_details->update($input, getLoggedUserID())) {
            redirect(base_url('tools/google_contacts'));
        }
    }

    public function api_quickbooks_callback() {
        $this->load->library('QuickbooksApi');
        $this->quickbooksapi->create_session($_SERVER['QUERY_STRING']);
        redirect(base_url('tools/quickbooks'));
    }

    public function api_google_contacts() {
        $Google_api_client_id = $this->config->item('google_contact_client_id');
        $Google_client_secret = $this->config->item('google_contact_client_secret');
        $Google_redirect_url = $this->config->item('google_contact_redirect_url'); // redirect url mentioned in aapi console
        $Google_contact_max_result = "10"; // integer value
        $authcode = $_GET['code'];
        $clientid = $Google_api_client_id;
        $clientsecret = $Google_client_secret;
        $redirecturi = $Google_redirect_url;
        $fields = array(
            'code' => urlencode($authcode),
            'client_id' => urlencode($clientid),
            'client_secret' => urlencode($clientsecret),
            'redirect_uri' => urlencode($redirecturi),
            'grant_type' => urlencode('authorization_code')
        );
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = rtrim($fields_string, '&');
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
        curl_setopt($ch, CURLOPT_POST, 5);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        // Set so curl_exec returns the result instead of outputting it.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //to trust any ssl certificates
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        //extracting access_token from response string
        $response = json_decode($result);


        //print_r($response);

        $accesstoken = $response->access_token;
        if ($accesstoken != "")
            $_SESSION['token'] = $accesstoken;
        //passing accesstoken to obtain contact details
        $xmlresponse = file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?&max-results=' . $Google_contact_max_result . '.&oauth_token=' . urlencode($_SESSION['token']));
        //reading xml using SimpleXML
        $xml = new SimpleXMLElement($xmlresponse);
        $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2008');
        $result = $xml->xpath('//gd:email');
        $count = 0;

        $input = array();
        foreach ($result as $title) {
            if ($this->api_gc->check_if_exist($title->attributes()->address)) {
                echo $title->attributes()->address . ' Exist ' . '<br>';
            } else {
                $input['contact_email'] = $title->attributes()->address;
                $input['user_id'] = getLoggedUserID();
                $this->api_gc->add($input);
            }
        }
       // redirect(base_url('tools/google_contacts'));
    }

    public function ajax_load_company_converge_form(){
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $company_id = logged('company_id');    

        $converge = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $this->page_data['converge'] = $converge;
        $this->load->view('v2/pages/tools/ajax_company_converge_form', $this->page_data);
    }

    public function ajax_load_company_ring_central(){
        $this->load->model('RingCentralAccounts_model');

        $company_id = logged('company_id');    

        $ringCentral = $this->RingCentralAccounts_model->getByCompanyId($company_id);

        $this->page_data['ringCentral'] = $ringCentral;
        $this->load->view('v2/pages/tools/ajax_load_company_ring_central', $this->page_data);
    }

    public function ajax_load_company_vonage(){
        $this->load->model('VonageAccounts_model');

        $company_id = logged('company_id');    

        $vonage = $this->VonageAccounts_model->getByCompanyId($company_id);

        $this->page_data['vonage'] = $vonage;
        $this->load->view('v2/pages/tools/ajax_load_company_vonage', $this->page_data);
    }

    public function ajax_load_company_twilio(){
        $this->load->model('TwilioAccounts_model');

        $company_id = logged('company_id');    

        $twilio = $this->TwilioAccounts_model->getByCompanyId($company_id);

        $this->page_data['twilio'] = $twilio;
        $this->load->view('v2/pages/tools/ajax_load_company_twilio', $this->page_data);
    }

    public function ajax_activate_company_ring_central(){
        $this->load->helper('sms_helper');
        $this->load->model('RingCentralAccounts_model');

        $is_success = false;
        $msg = 'Invalid ring central account';

        $post = $this->input->post();
        $company_id = logged('company_id');  

        $ringCentral = validateRingCentralAccount($post['client_id'], $post['client_secret'], $post['rc_username'], $post['rc_password'], $post['rc_ext']);
        if( $ringCentral['is_valid'] ){
            $companyRingCentral = $this->RingCentralAccounts_model->getByCompanyId($company_id);
            if( $companyRingCentral ){
                $ring_central_data = [
                    'client_id' => base64_encode($post['client_id']),
                    'client_secret' => base64_encode($post['client_secret']),
                    'rc_username' => $post['rc_username'],
                    'rc_password' => $post['rc_password'],
                    'rc_from_number' => $post['rc_from_number'],
                    'rc_ext' => $post['rc_ext']
                ];

                $this->RingCentralAccounts_model->update($companyRingCentral->id, $ring_central_data);
            }else{
                $ring_central_data = [
                    'company_id' => $company_id,
                    'client_id' => base64_encode($post['client_id']),
                    'client_secret' => base64_encode($post['client_secret']),
                    'rc_username' => $post['rc_username'],
                    'rc_password' => $post['rc_password'],
                    'rc_from_number' => $post['rc_from_number'],
                    'rc_ext' => $post['rc_ext'],
                    'created' => date("Y-m-d H:i:s")
                ];

                $this->RingCentralAccounts_model->create($ring_central_data);
            }            

            $msg = '';
            $is_success = true;
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_activate_company_vonage(){
        $this->load->helper('sms_helper');
        $this->load->model('VonageAccounts_model');

        $is_success = true;
        $msg = 'Invalid ring central account';

        $post = $this->input->post();
        $company_id = logged('company_id');  

        if( $post['vn_api_key'] == '' ){
            $is_success = false;
            $msg = 'Please enter your Vonage API key';
        } 

        if( $post['vn_api_secret'] == '' ){
            $is_success = false;
            $msg = 'Please enter your Vonage API secrey';
        }

        if( $post['vn_branding'] == '' ){
            $is_success = false;
            $msg = 'Please enter your Vonage Branding';
        }

        if( $post['vn_from_number'] == '' ){
            $is_success = false;
            $msg = 'Vonage Virtual Number is required';
        }

        if( $is_success ){  
            $vonageAccount = $this->VonageAccounts_model->getByCompanyId($company_id);
            if( $vonageAccount ){
                $vonage_data = [                    
                    'vn_api_key' => base64_encode($post['vn_api_key']),
                    'vn_api_secret' => base64_encode($post['vn_api_secret']),
                    'vn_branding' => $post['vn_branding'],
                    'vn_from_number' => $post['vn_from_number']
                ];
                $this->VonageAccounts_model->update($vonageAccount->id, $vonage_data);
            }else{
                $vonage_data = [
                    'company_id' => $company_id,
                    'vn_api_key' => base64_encode($post['vn_api_key']),
                    'vn_api_secret' => base64_encode($post['vn_api_secret']),
                    'vn_branding' => $post['vn_branding'],
                    'vn_from_number' => $post['vn_from_number']
                ];

                $this->VonageAccounts_model->create($vonage_data);
            }

            $msg = '';
            
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_activate_company_twilio(){
        $this->load->helper('sms_helper');
        $this->load->model('TwilioAccounts_model');

        $is_success = false;
        $msg = 'Invalid twilio account';

        $post = $this->input->post();
        $company_id = logged('company_id');  

        $twilio = validateTwilioAccount($post['tw_sid'], $post['tw_token']);        
        if( $twilio['is_valid'] ){
            $twilioAccount = $this->TwilioAccounts_model->getByCompanyId($company_id);
            if( $twilioAccount ){
                $twilio_data = [
                    'tw_sid' => base64_encode($post['tw_sid']),
                    'tw_token' => base64_encode($post['tw_token']),
                    'tw_number' => $post['tw_number'],   
                    'tw_capability_token_url' => $post['tw_capability_token_url'],                 
                    'created' => date("Y-m-d H:i:s")
                ];

                $this->TwilioAccounts_model->update($twilioAccount->id, $twilio_data);
            }else{
                $twilio_data = [
                    'company_id' => $company_id,
                    'tw_sid' => base64_encode($post['tw_sid']),
                    'tw_token' => base64_encode($post['tw_token']),
                    'tw_number' => $post['tw_number'], 
                    'tw_capability_token_url' => $post['tw_capability_token_url'],                   
                    'created' => date("Y-m-d H:i:s")
                ];

                $this->TwilioAccounts_model->create($twilio_data);
            }            

            $msg = '';
            $is_success = true;
        }else{
            $msg = $twilio['err_msg'];
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_update_company_default_sms_api(){
        $this->load->model('Clients_model');
        $this->load->model('RingCentralAccounts_model');
        $this->load->model('TwilioAccounts_model');
        $this->load->model('VonageAccounts_model');

        $is_success = false;
        $msg = 'Cannot update settings';

        $post = $this->input->post();
        $company_id = logged('company_id');  
        $client = $this->Clients_model->getById($company_id);

        if( $post['default_sms'] == 'ring_central' ){
            $companyRingCentral = $this->RingCentralAccounts_model->getByCompanyId($company_id);
            if( !empty($companyRingCentral) ){
                $data = ['default_sms_api' => 'ring_central'];
                $this->Clients_model->update($client->id, $data);

                $msg = '';
                $is_success = true;
            }else{
                $msg = 'You do not have a valid ring central account.';
            }
        }elseif( $post['default_sms'] == 'twilio' ){
            $companyTwilio = $this->TwilioAccounts_model->getByCompanyId($company_id);
            if( !empty($companyTwilio) ){
                $data = ['default_sms_api' => 'twilio'];
                $this->Clients_model->update($client->id, $data);

                $msg = '';
                $is_success = true;
            }else{
                $msg = 'You do not have a valid twilio account.';
            }
        }elseif( $post['default_sms'] == 'vonage' ){
            $vonage = $this->VonageAccounts_model->getByCompanyId($company_id);
            if( !empty($vonage) ){
                $data = ['default_sms_api' => 'vonage'];
                $this->Clients_model->update($client->id, $data);

                $msg = '';
                $is_success = true;
            }else{
                $msg = 'You do not have a valid vonage account.';
            }
        }else{
            $data = ['default_sms_api' => ''];
            $this->Clients_model->update($client->id, $data);

            $msg = '';
            $is_success = true;
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_activate_company_converge_account(){
        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = 'Invalid converge credentials';

        $post = $this->input->post();
        $company_id = logged('company_id');  

        $post['company_id'] = $company_id;
        $converge = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        if( $converge ){
            //$post['converge_merchant_id'] = base64_encode($post['converge_merchant_id']);
            //$post['converge_merchant_pin'] = base64_encode($post['converge_merchant_pin']);
            $post['modified'] = date("Y-m-d H:i:s");
            $convergeAccount  = $this->CompanyOnlinePaymentAccount_model->updateCompanyAccount($company_id,$post);
        }else{
            //$post['converge_merchant_id'] = base64_encode($post['converge_merchant_id']);
            //$post['converge_merchant_pin'] = base64_encode($post['converge_merchant_pin']);
            $post['created']  = date("Y-m-d H:i:s");
            $post['modified'] = date("Y-m-d H:i:s");
            $convergeAccount = $this->CompanyOnlinePaymentAccount_model->create($post);    
        }

        $is_success = true;
        $msg = '';

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_activate_company_online_payment_account(){
        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = 'Invalid credentials';

        $post = $this->input->post();
        $company_id = logged('company_id');  

        $post['company_id'] = $company_id;
        $paymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        /*if( isset($post['api_name'])){
            if( $post['api_name'] == 'converge' ){
                $post['converge_merchant_id'] = base64_encode($post['converge_merchant_id']);
                $post['converge_merchant_pin'] = base64_encode($post['converge_merchant_pin']);
            }elseif( $post['api_name'] == 'nmi' ){
                $post['nmi_transaction_key'] = base64_encode($post['nmi_transaction_key']);
            }elseif( $post['api_name'] == 'stripe' ){
                $post['stripe_secret_key'] = base64_encode($post['stripe_secret_key']);
                $post['stripe_publish_key'] = base64_encode($post['stripe_publish_key']);
            }elseif( $post['api_name'] == 'paypal' ){
                $post['paypal_client_id'] = base64_encode($post['paypal_client_id']);
                $post['paypal_client_secret'] = base64_encode($post['paypal_client_secret']);
            }

            unset($post['api_name']);
        }*/

        if( $paymentAccount ){
            $post['modified'] = date("Y-m-d H:i:s");
            $paymentAccount  = $this->CompanyOnlinePaymentAccount_model->updateCompanyAccount($company_id,$post);
        }else{
            $post['created']  = date("Y-m-d H:i:s");
            $post['modified'] = date("Y-m-d H:i:s");
            $paymentAccount = $this->CompanyOnlinePaymentAccount_model->create($post);    
        }

        $is_success = true;
        $msg = '';

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_load_company_stripe_form(){
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $company_id = logged('company_id');    

        $stripe = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $this->page_data['stripe'] = $stripe;
        $this->load->view('v2/pages/tools/ajax_company_stripe_form', $this->page_data);
    }

    public function ajax_load_company_braintree_form(){
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $company_id = logged('company_id');    

        $brainTree = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $this->page_data['brainTree'] = $brainTree;
        $this->load->view('v2/pages/tools/ajax_company_braintree_form', $this->page_data);
    }

    public function ajax_load_company_paypal_form(){
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $company_id = logged('company_id');    

        $paypal = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $this->page_data['paypal'] = $paypal;
        $this->load->view('v2/pages/tools/ajax_company_paypal_form', $this->page_data);
    }

    public function ajax_load_company_plaid_form(){
        $this->load->model('PlaidAccount_model');
        $company_id = logged('company_id');    

        $plaid = $this->PlaidAccount_model->getByCompanyId($company_id);

        $this->page_data['plaid'] = $plaid;
        $this->load->view('v2/pages/tools/ajax_company_plaid_form', $this->page_data);
    }

    public function ajax_load_company_nmi_form(){
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $company_id = logged('company_id');    

        $nmi = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $this->page_data['nmi'] = $nmi;
        $this->load->view('v2/pages/tools/ajax_company_nmi_form', $this->page_data);
    }

    public function ajax_send_auth_key(){
        $this->load->model('Users_model');

        $is_success = 0;
        $msg = 'Cannot find user';
        $user_email = '';

        $user_id = getLoggedUserID();
        $key     = generateRandomString(10) . $user_id;

        $user = $this->Users_model->getUserByID($user_id);

        if( $user ){
            if( $user->email != '' ){
                $data = ['auth_key' => $key];
                $this->Users_model->update($user->id, $data);

                $user_email = preg_replace("/(?!^).(?=[^@]+@)/", "*", $user->email);
                //$user_email = $user->email;

                $subject = 'nSmarTrac : Authentication Key';
                $to   = $user->email;
                $body = "Your nSmarTrac authentication key is <b>" .$key. "</b>";

                $data = [
                    'to' => $to, 
                    'subject' => $subject, 
                    'body' => $body,
                    'cc' => '',
                    'bcc' => '',
                    'attachment' => ''
                ];

                $isSent = sendEmail($data);

                $is_success = 1;
                $msg = '';

            }else{
                $msg = 'Email not valid';
            }
            
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg, 'user_email' => $user_email];
        echo json_encode($json_data);
        
    }

    public function ajax_validate_auth_key(){
        $this->load->model('Users_model');

        $is_success = 0;
        $msg = 'Invalid authentication key';

        $post = $this->input->post();

        $user_id = getLoggedUserID();
        $user    = $this->Users_model->getUserByID($user_id);
        if( $user ){
            if( $user->auth_key == $post['auth_key'] ){
                $is_success = 1;
                $msg = '';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

    }

    public function ajax_activate_company_plaid(){
        $this->load->model('PlaidAccount_model');
        $this->load->helper(array('plaid_helper'));

        $is_success = false;
        $msg = 'Invalid plaid account';

        $post = $this->input->post();
        $company_id = logged('company_id');  

        $plaid = $this->PlaidAccount_model->getByCompanyId($company_id);

        //Check if plaid account is valid
        $plaidToken = linkTokenCreate($post['client_id'], $post['client_secret'], $post['client_user_id'], $post['client_name']);
        if( $plaid ){            
            if( $plaidToken['is_valid'] == true ){
                $plaid_data = [
                    'client_name' => $post['client_name'],
                    'client_user_id' => $post['client_user_id'],
                    'client_id' => $post['client_id'],
                    'client_secret' => $post['client_secret'],              
                    'modified' => date("Y-m-d H:i:s"),
                ];

                $this->PlaidAccount_model->update($plaid->id, $plaid_data);

                $is_success = true;
                $msg = '';

            }else{
                $msg = 'Invalid Account';
            }            
        }else{
            if( $plaidToken['is_valid'] == true ){
                $plaid_data = [
                    'company_id' => $company_id,
                    'client_name' => $post['client_name'],
                    'client_user_id' => $post['client_user_id'],
                    'client_id' => $post['client_id'],
                    'client_secret' => $post['client_secret'],              
                    'created' => date("Y-m-d H:i:s"),
                ];

                $this->PlaidAccount_model->create($plaid_data);

                $is_success = true;
                $msg = '';

            }else{
                $msg = 'Invalid Account';
            }            
        }            

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_enable_disable_confirmation_api()
    {
        $this->load->model('CompanyApiConnector_model');

        $post = $this->input->post();
        $company_id = logged('company_id');  

        $apiConnector = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, $post['api_name']);

        $this->page_data['apiConnector'] = $apiConnector;
        $this->page_data['is_enable'] = $post['is_enabled'];
        $this->page_data['api_name']  = $post['api_name'];
        $this->load->view('v2/pages/tools/ajax_enable_disable_api', $this->page_data);
    }

    public function ajax_enable_api()
    {
        $this->load->model('CompanyApiConnector_model');

        $is_success = false;
        $msg = 'Invalid API name';

        $post = $this->input->post();
        $company_id = logged('company_id'); 

        if( $post['api_name'] == 'zapier' ){            
            $apiConnector = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, $post['api_name']);
            if( $apiConnector ){
                $data_api = ['status' => 1];
                $this->CompanyApiConnector_model->update($apiConnector->id, $data_api);      
            }else{
                $api_key  = $this->generateApiKey(30, $company_id);
                $data_api = [
                    'company_id' => $company_id,
                    'api_name' => 'zapier',
                    'status' => 1,
                    'zapier_api_key' => $api_key,
                    'created' => date("Y-m-d H:i:s")
                ];   

                $this->CompanyApiConnector_model->create($data_api);                
            }

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_disable_api()
    {
        $this->load->model('CompanyApiConnector_model');

        $is_success = false;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $apiConnector = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, $post['api_name']);
        if( $apiConnector ){
            $data_api = ['status' => 0];
            $this->CompanyApiConnector_model->update($apiConnector->id, $data_api);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data); 
    }

    public function generateApiKey($length = 30, $company_id) {
        $api_key = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
        $api_key = $api_key . $company_id;
        return $api_key;
    }

    public function ajax_zapier_regenerate_key(){
        $this->load->model('CompanyApiConnector_model');

        $is_success = false;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $apiConnector = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'zapier');
        if( $apiConnector ){
            $api_key  = $this->generateApiKey(30, $company_id);
            $data_api = ['zapier_api_key' => $api_key];
            $this->CompanyApiConnector_model->update($apiConnector->id, $data_api);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data); 
    }

    public function ajax_google_contact_account_bind(){
        $this->load->model('CompanyApiConnector_model');

        $is_success = 0;
        $msg = 'Failed to connect. Please try again.';

        $company_id = logged('company_id');
        $post = $this->input->post();
        if( $post['token'] != '' ){
            $company_id = logged('company_id');
            $google_credentials = google_credentials();
            $profile = google_get_oauth2_token($post['token'], $google_credentials['client_id'], $google_credentials['client_secret']);            
            if( $profile && $profile['access_token'] != '' ){
                $companyGoogleContactsApi = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'google_contacts');
                if( $companyGoogleContactsApi ){
                    $data_google_contacts = [                        
                        'status' => 1,
                        'google_email' => $profile['user']->email,
                        'google_access_token' => $profile['access_token'],
                        'google_refresh_token' => $profile['refreshToken'],
                        'google_contacts_total_imported' => 0,
                        'google_contacts_total_failed' => 0,
                        'google_last_sync' => NULL,
                        'created' => date("Y-m-d H:i:s")
                    ];
                    $this->CompanyApiConnector_model->update($companyGoogleContactsApi->id, $data_google_contacts);
                }else{
                    $data_google_contacts = [
                        'company_id' => $company_id,
                        'api_name' => 'google_contacts',
                        'status' => 1,
                        'google_email' => $profile['user']->email,
                        'google_access_token' => $profile['access_token'],
                        'google_refresh_token' => $profile['refreshToken'],
                        'google_contacts_total_imported' => 0,
                        'google_contacts_total_failed' => 0,
                        'created' => date("Y-m-d H:i:s")
                    ];    

                    $this->CompanyApiConnector_model->create($data_google_contacts);
                }

                $is_success = 1;
                $msg = '';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_import_customer_data_to_google_contacts(){

        include APPPATH . 'libraries/google-api-php-client/Google/vendor/autoload.php';

        $this->load->model('CompanyApiConnector_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('GoogleContactLogs_model');

        $is_success = 0;
        $msg = 'Failed to connect to Google.';

        $total_imported = 0;

        $company_id = logged('company_id');        
        $companyGoogleContactsApi = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'google_contacts');
        if( $companyGoogleContactsApi && $companyGoogleContactsApi->google_access_token != '' ){            
            $customers = $this->AcsProfile_model->getCustomerBasicInfoByCompanyId($company_id);
            foreach($customers as $customer){         
                //Check if customer id is already in logs                
                $isCustomerExists = $this->GoogleContactLogs_model->getByCompanyIdAndObjectId($company_id, $customer->prof_id);
                if( !$isCustomerExists ){
                    $data_logs = [
                        'company_id' => $company_id,
                        'company_api_connector_id' => $companyGoogleContactsApi->id,
                        'object_id' => $customer->prof_id,
                        'google_contact_id' => '',
                        'resource_type' => 'customer',
                        'action' => 'export',
                        'action_date' => '',
                        'is_with_error' => 0,
                        'is_sync' => 0,
                        'error_message' => ''
                    ];

                    $this->GoogleContactLogs_model->create($data_logs);

                }else{
                    $data_logs = [                        
                        'is_with_error' => 0,
                        'is_sync' => 0,
                        'error_message' => ''
                    ];

                    $this->GoogleContactLogs_model->update($isCustomerExists->id, $data_logs);
                }   

                $total_imported++;                 
            }

            $data_google_contacts = [                        
                'google_contacts_total_imported' => $total_imported,
                'google_contacts_total_failed' => 0,                        
                'google_last_sync' => date("Y-m-d H:i:s"),                
            ];

            $this->CompanyApiConnector_model->update($companyGoogleContactsApi->id, $data_google_contacts);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_disconnect_google_contacts(){
        $this->load->model('CompanyApiConnector_model');

        $is_success = 0;
        $msg = 'Cannot find Google Account.';

        $company_id = logged('company_id');
        $companyGoogleContactsApi = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'google_contacts');
        if( $companyGoogleContactsApi ){
            $this->CompanyApiConnector_model->update($companyGoogleContactsApi->id, ['status' => 0]);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function google_contacts_logs(){
        $this->load->model('GoogleContactLogs_model');

        $company_id = logged('company_id');
        $filter     = 'all';
        if( get('filter') ){
            $filter = get('filter');
            if( get('filter') == 'exported' ){
                $search['search'][] = ['field' => 'is_with_error', 'value' => 0];
            }else{
                $search['search'][] = ['field' => 'is_with_error', 'value' => 1];
            }
            $googleContactsLogs = $this->GoogleContactLogs_model->getAllByCompanyId($company_id, $search);    
        }else{
            $googleContactsLogs = $this->GoogleContactLogs_model->getAllByCompanyId($company_id);    
        }
            
        $this->page_data['googleContactsLogs'] = $googleContactsLogs;
        $this->page_data['filter'] = $filter;
        $this->page_data['page']->title = 'Google Contacts';
        $this->page_data['page']->parent = 'Tools';        
        $this->load->view('v2/pages/tools/google_contacts_logs', $this->page_data);       
    }

    public function attendance_logs($date_from, $date_to)
    {
        $date_from = $date_from;
        $date_to = $date_to;
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_from . " 00:00:00");
        date_default_timezone_set("UTC");
        $date_from = date("Y-m-d", $the_date);

        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_to . " 24:59:00");
        date_default_timezone_set("UTC");
        $date_to = date("Y-m-d H:i:s", $the_date);
        $company_id = logged('company_id');
        $attendances = $this->timesheet_model->get_all_attendance($date_from, $date_to, $company_id);
        
        $data_attendance_logs = array();
        $logs_index = 0;
        foreach ($attendances as $attendance) {
            $shift_date = $attendance->date_created;
            date_default_timezone_set("UTC");
            $the_date = strtotime($shift_date);
            date_default_timezone_set($this->session->userdata('usertimezone'));
            $shift_date = date("m/d/Y", $the_date);

            date_default_timezone_set("UTC");
            $shift_schedules = $this->timesheet_model->get_schedule_in_shift_date(date("Y-m-d", strtotime($attendance->date_created)), $attendance->user_id);
            $shift_start = '';
            $shift_end = '';
            $expected_hours = '';
            $expected_break = '';
            $expected_work_hours = '';
            foreach ($shift_schedules as $sched) {
                $olddate_start = $sched->shift_start;
                $olddate_end = $sched->shift_end;
                date_default_timezone_set("UTC");
                $the_date1 = strtotime($olddate_start);
                $the_date2 = strtotime($olddate_end);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate_start = date("m/d/Y h:i A", $the_date1);
                $newdate_end = date("m/d/Y h:i A", $the_date2);
                $shift_start = $newdate_start;
                $shift_end = $newdate_end;
                $expected_hours = $sched->duration;
                $expected_break = 0;
                if ($expected_hours > 4) {
                    $expected_break = 30;
                }
                if ($expected_hours > 6) {
                    $expected_break += 15;
                }
                if ($expected_hours >= 8) {
                    $expected_break = 60;
                }
                $expected_work_hours = round((($expected_hours * 60) - $expected_break) / 60, 2);
            }

            $auxes = $this->timesheet_model->get_logs_of_attendance($attendance->id);
            $checkin = '';
            $checkout = '';
            $breakin = '';
            $breakout = '';

            foreach ($auxes as $aux) {
                $olddate = $aux->date_created;
                date_default_timezone_set("UTC");
                $the_date = strtotime($olddate);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate = date("m/d/Y h:i A", $the_date);
                if ($aux->action == "Check in") {
                    $checkin = $newdate;
                } elseif ($aux->action == "Check out") {
                    $checkout = $newdate;
                } elseif ($aux->action == "Break in") {
                    $breakin = $newdate;
                } elseif ($aux->action == "Break out") {
                    $breakout = $newdate;
                }
            }
            
            $minutes_late = "";
            if ($shift_start != '') {
                $minutes_late = $this->get_differenct_of_dates($shift_start, $checkin) * 60;
            }
            
            $overtime = 0;
            if ($expected_hours != '') {
                if ($expected_work_hours < ($attendance->shift_duration + $attendance->overtime)) {
                    $overtime = round(($attendance->shift_duration + $attendance->overtime) - $expected_work_hours, 2);
                } elseif ($attendance->shift_duration == 0) {
                    $overtime = 0;
                } else {
                    $overtime = $expected_work_hours;
                }
            } else {
                $overtime = $attendance->overtime;
            }
            
            if ($attendance->overtime_status == 1) {
                $ot_status = "Pending";
            } elseif ($attendance->overtime_status == 0) {
                $ot_status = "Denied";
            } else {
                $ot_status = "Approved";
            }
            
            $payable_hours = $attendance->shift_duration;
            if ($expected_hours != '') {
                if ($payable_hours > $expected_work_hours) {
                    $payable_hours = $expected_work_hours;
                }
            }
            if ($ot_status === "Approved") {
                $payable_hours = $payable_hours + $attendance->overtime;
            }

            $data_attendance_logs[$logs_index]['user_id']   = $attendance->user_id;
            $data_attendance_logs[$logs_index]['name']      = $attendance->FName . ' ' .   $attendance->LName;
            $data_attendance_logs[$logs_index]['checkin']   = $checkin;
            $data_attendance_logs[$logs_index]['checkout']  = $checkout;
            $data_attendance_logs[$logs_index]['total_hrs'] = $attendance->shift_duration + $attendance->overtime;

            $logs_index++;
        }

        return $data_attendance_logs;
        
    }

    public function datetime_zone_converter($olddate, $from_timezone, $to_timezone)
    {
        date_default_timezone_set($from_timezone);
        $the_date = strtotime($olddate);
        date_default_timezone_set($to_timezone);
        $newdate = date("Y-m-d H:i:s", $the_date);
        return $newdate;
    }

    public function ajax_load_attendance_list()
    {
        $post = $this->input->post();
        $date_from = date("Y-m-d", strtotime($post['date_from']));
        $date_to   = date("Y-m-d", strtotime($post['date_to']));          
        $attendance_logs = $this->attendance_logs($date_from, $date_to);  

        $this->page_data['attendance_logs'] = $attendance_logs;
        $this->load->view('v2/pages/tools/ajax_load_attendance_list', $this->page_data);       
    }

    public function ajax_export_qb_timesheet()
    {
        $this->load->library('QuickbooksApi');
        $this->load->model('CompanyApiConnector_model');
        $this->load->model('QbImportEmployeeLogs_model');
        $this->load->model('QbImportTimesheetLogs_model');
        $this->load->model('Users_model');

        $is_success = 0;
        $msg = '';

        $company_id = logged('company_id');
        $post = $this->input->post();
        $date_from = date("Y-m-d", strtotime($post['date_from']));
        $date_to   = date("Y-m-d", strtotime($post['date_to']));  
        $attendance_logs = $this->attendance_logs($date_from, $date_to);  
        $total_employee   = 0;
        $total_attendance = 0;
        if( $attendance_logs ){
            $companyQuickBooksPayroll = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'quickbooks_payroll');
            foreach($attendance_logs as $logs){
                $importEmployeeLog = $this->QbImportEmployeeLogs_model->getByUserId($logs['user_id']);

                //Create employee
                if( !$importEmployeeLog ){
                    $qb_employee_import = [
                        'company_id' => $company_id,
                        'user_id' => $logs['user_id'],
                        'qb_user_id' => 0,
                        'is_sync' => 0,
                        'is_with_error' => 0,
                        'error_message' => ''
                    ];                  

                    $this->QbImportEmployeeLogs_model->create($qb_employee_import);                    
                }else{
                    $qb_employee_import = [
                        'qb_user_id' => 0,
                        'is_sync' => 0,
                        'is_with_error' => 0,
                        'error_message' => ''
                    ];                  

                    $this->QbImportEmployeeLogs_model->update($importEmployeeLog->id, $qb_employee_import);
                }
                $total_employee++;

                //Create timesheet
                $qb_timesheet_import = [
                    'company_id' => $company_id,
                    'user_id' => $logs['user_id'],
                    'qb_user_id' => 0,
                    'qb_employee_name' => '',
                    'qb_timesheet_id' => 0,
                    'start_date' => date("Y-m-d", strtotime($logs['checkin'])),
                    'start_time' => date('H:i:s', strtotime($logs['checkin'])),
                    'end_date' => date("Y-m-d", strtotime($logs['checkout'])),
                    'end_time' => date('H:i:s', strtotime($logs['checkout'])),
                    'billable_status' => 'NotBillable',
                    'taxable' => 0,
                    'hourly_rate' => 0,
                    'description' => 'Timesheet Attendance',
                    'is_sync' => 0,
                    'is_with_error' => 0,
                    'error_message' => '',
                    'date_created' => date("Y-m-d H:i:s")
                ];
                $this->QbImportTimesheetLogs_model->create($qb_timesheet_import);  
                $total_attendance++;
            }

            //Update qb api summary
            $data_qb_summary = [
                'qb_total_employee' => $total_employee,
                'qb_total_employee_synced' => 0,
                'qb_total_employee_failed_synced' => 0,
                'qb_total_attendance' => $total_attendance,
                'qb_total_attendance_synced' => 0,
                'qb_total_attendance_failed_synced' => 0
            ];

            $this->CompanyApiConnector_model->update($companyQuickBooksPayroll->id, $data_qb_summary);
        }

        if( $total_employee > 0 ){
            $is_success = 1;
        }else{
            $msg = 'Nothing to import';
        }
  
        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }  

    public function quickbooks_payroll_employee_logs()
    {
        $this->load->model('QbImportEmployeeLogs_model');

        $company_id = logged('company_id');    
        $filter     = 'all';

        if( get('filter') ){
            $filter = get('filter');
            if( get('filter') == 'errors' ){                
                $search['search'][] = ['field' => 'qb_import_employee_logs.is_with_error', 'value' => 1];
            }
            $employeeLogs = $this->QbImportEmployeeLogs_model->getAllByCompanyId($company_id, $search);            
        }else{
            $employeeLogs = $this->QbImportEmployeeLogs_model->getAllByCompanyId($company_id);
        }

        $this->page_data['filter'] = $filter;
        $this->page_data['page']->title = 'Quickbooks Payroll';
        $this->page_data['employeeLogs'] = $employeeLogs;
        $this->load->view('v2/pages/tools/quickbooks_payroll_employee_logs', $this->page_data);
    }  

    public function quickbooks_payroll_timesheet_logs()
    {
        $this->load->model('QbImportTimesheetLogs_model');

        $company_id = logged('company_id');    
        $filter     = 'all';

        if( get('filter') ){
            $filter = get('filter');
            if( get('filter') == 'errors' ){                
                $search['search'][] = ['field' => 'qb_import_timesheet_logs.is_with_error', 'value' => 1];
            }
            $timesheetLogs = $this->QbImportTimesheetLogs_model->getAllByCompanyId($company_id, $search);            
        }else{
            $timesheetLogs = $this->QbImportTimesheetLogs_model->getAllByCompanyId($company_id);
        }

        $this->page_data['filter'] = $filter;
        $this->page_data['page']->title = 'Quickbooks Payroll';
        $this->page_data['timesheetLogs'] = $timesheetLogs;
        $this->load->view('v2/pages/tools/quickbooks_payroll_timesheet_logs', $this->page_data);
    }  

    public function ajax_disconnect_quickbook_payroll_account()
    {
        $this->load->model('CompanyApiConnector_model');

        $is_success = 0;
        $msg = 'Cannot find Quickbook Payroll Account.';

        $company_id = logged('company_id');
        $companyQuickBookPayrollApi = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'quickbooks_payroll');
        if( $companyQuickBookPayrollApi ){
            $this->CompanyApiConnector_model->update($companyQuickBookPayrollApi->id, ['status' => 0]);
            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function mailchimpConnect()
    {
        $this->config->load('api_credentials');
        header('Location: https://login.mailchimp.com/oauth2/authorize?'.http_build_query([
            'response_type' => 'code',
            'client_id' => $this->config->item('mailchimp_client_id'),
            'redirect_uri' => $this->config->item('mailchimp_redirect_uri'),
        ]));
    }

    public function mailchimpApiSave()
    {
        $this->load->model('CompanyApiConnector_model');
        $this->load->library('MailChimpApi');

        if( !empty($this->input->get('code')) ){
            $mailchimpApi = new MailChimpApi;
            $access_token = $mailchimpApi->createAccessToken($this->input->get('code'));
            if( $access_token != '' ){
                $accountDetails = $mailchimpApi->getAccountDetails($access_token);                
                if( isset($accountDetails->login) ){

                    $account_info = [
                        'user_id' => $accountDetails->user_id,
                        'accountname' => $accountDetails->accountname,
                        'email' => $accountDetails->login->email,
                        'login_id' => $accountDetails->login->login_id

                    ];

                    $company_id = logged('company_id');
                    $companyMailChimp = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'mailchimp');
                    if( $companyMailChimp ){
                        $data_mailchimp = [                            
                            'mailchimp_access_token' => $access_token,
                            'mailchimp_server_prefix' => $accountDetails->dc, 
                            'mailchimp_account_info' => serialize($account_info),
                            'api_name' => 'mailchimp',
                            'status' => 1,
                            'created' => date("Y-m-d H:i:s")
                        ];    
                        $this->CompanyApiConnector_model->update($companyMailChimp->id, $data_mailchimp);
                    }else{
                        $data_mailchimp = [
                            'company_id' => $company_id,
                            'mailchimp_access_token' => $access_token,
                            'mailchimp_server_prefix' => $accountDetails->dc, 
                            'mailchimp_account_info' => serialize($account_info),
                            'api_name' => 'mailchimp',
                            'status' => 1,
                            'created' => date("Y-m-d H:i:s")
                        ];     
                        $this->CompanyApiConnector_model->create($data_mailchimp);
                    }
                    
                    redirect('tools/mailchimp');     
                }else{
                    redirect('tools/mailchimp?error=1');     
                }
            }else{
                redirect('tools/mailchimp?error=1'); 
            }
        }else{
           redirect('tools/maigetListByIdlchimp?error=1'); 
        }
    }

    public function ajax_create_mailchimp_customer_export()
    {
        $this->load->model('CompanyApiConnector_model');
        $this->load->model('MailChimpExportCustomerLogs_model');
        $this->load->model('AcsProfile_model');
        $this->load->library('MailChimpApi');


        $is_success = false;
        $is_valid   = true;
        $msg = 'Invalid ring central account';

        $post = $this->input->post();
        $company_id = logged('company_id');  

        if( empty($post['mailchimp_list']) ){
            $is_valid = false;
            $msg = 'Please select Mailchimp list.';
        }

        if( empty($post['mailchimp_customer']) ){
            $is_valid = false;
            $msg = 'Please customer to export to Mailchimp.';
        }

        $companyMailChimp = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id,'mailchimp'); 
        if( empty($companyMailChimp) ){
            $is_valid = false;
            $msg = 'Cannot find company Mailchimp account.';
        }

        if( $is_valid ){

            $mailchimpApi = new MailChimpApi;
            $mailChimpList = $mailchimpApi->getListById($post['mailchimp_list'], $companyMailChimp->mailchimp_access_token, $companyMailChimp->mailchimp_server_prefix);
            if( $mailChimpList ){
                $total_exported = 0;
                foreach( $post['mailchimp_customer'] as $cid ){    
                    $customer = $this->AcsProfile_model->getByProfId($cid);
                    if( $customer && $customer->email != '' ){
                        $customer_address = [
                            'address' => $customer->mail_add,
                            'city' => $customer->city,
                            'state' => $customer->state,
                            'zip' => $customer->zip_code
                        ];
                        $mailChimpLog = $this->MailChimpExportCustomerLogs_model->getByCustomerEmailAndListId($customer->email, $post['mailchimp_list']);
                        if( $mailChimpLog ){
                            if( $mailChimpLog->is_sync == 0 ){                                     
                                $data_mailchimp_export = [                            
                                    'mailchimp_list_id' => $post['mailchimp_list'],
                                    'mailchimp_list_name' => $mailChimpList->name,
                                    'mailchimp_status' => 'subscribed',
                                    'customer_id' => $customer->prof_id,
                                    'customer_email' => $customer->email,
                                    'customer_firstname' => $customer->first_name,
                                    'customer_lastname' => $customer->last_name,
                                    'customer_address' => serialize($customer_address),
                                    'customer_phone' => formatPhoneNumber($customer->phone_m),
                                    'is_sync' => 0,
                                    'is_with_error' => 0,
                                    'error_message' => '',
                                    'date_created' => date("Y-m-d H:i:s")
                                ];

                                $this->MailChimpExportCustomerLogs_model->update($mailChimpLog->id, $data_mailchimp_export);

                                $total_exported++;
                            }
                        }else{
                            $data_mailchimp_export = [
                                'company_id' => $company_id,
                                'mailchimp_list_id' => $post['mailchimp_list'],
                                'mailchimp_list_name' => $mailChimpList->name,
                                'mailchimp_status' => 'subscribed',
                                'customer_id' => $customer->prof_id,
                                'customer_email' => $customer->email,
                                'customer_firstname' => $customer->first_name,
                                'customer_lastname' => $customer->last_name,
                                'customer_address' => serialize($customer_address),
                                'customer_phone' => formatPhoneNumber($customer->phone_m),
                                'is_sync' => 0,
                                'is_with_error' => 0,
                                'error_message' => '',
                                'date_created' => date("Y-m-d H:i:s")
                            ];

                            $this->MailChimpExportCustomerLogs_model->create($data_mailchimp_export);

                            $total_exported++;
                        } 
                    }            
                }

                if( $total_exported > 0 ){
                    $is_success = true;
                    $msg = '';
                }else{
                    $msg = 'Nothing to export';
                }
            }else{
                $is_success = false;
                $msg = 'Invalid Mailchimp list id.';
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_disconnect_mailchimp_account()
    {
        $this->load->model('CompanyApiConnector_model');

        $is_success = 0;
        $msg = 'Cannot find MailChimp Account.';

        $company_id = logged('company_id');
        $companyMailChimpApi = $this->CompanyApiConnector_model->getByCompanyIdAndApiName($company_id, 'mailchimp');
        if( $companyMailChimpApi ){
            $this->CompanyApiConnector_model->update($companyMailChimpApi->id, ['status' => 0]);
            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function mailchimp_logs()
    {
        $this->load->model('MailChimpExportCustomerLogs_model');

        $company_id = logged('company_id');
        $filter     = 'all';
        if( get('filter') ){
            $filter = get('filter');
            if( get('filter') == 'errors' ){                
                $search['search'][] = ['field' => 'is_with_error', 'value' => 1];
            }else{
                $search['search'][] = ['field' => 'is_with_error', 'value' => 0];
            }                     
            $mailchimpLogs = $this->MailChimpExportCustomerLogs_model->getAllByCompanyId($company_id, $search);
        }else{
            $mailchimpLogs = $this->MailChimpExportCustomerLogs_model->getAllByCompanyId($company_id);
        }        

        $this->page_data['filter'] = $filter;
        $this->page_data['page']->title   = 'MailChimp';
        $this->page_data['page']->parent  = 'Tools';
        $this->page_data['mailchimpLogs'] = $mailchimpLogs;
        $this->load->view('v2/pages/tools/mailchimp_export_logs', $this->page_data);
    }
}
