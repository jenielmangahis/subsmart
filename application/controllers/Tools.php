<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
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
        $this->load->model('SettingOnlinePayment_model');
        $this->load->model('users_model');

        $user = $this->session->userdata('logged');

        $settingOnlinePayment = $this->SettingOnlinePayment_model->findByUserId($user['id']);

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

        $this->page_data['setting'] = $setting;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('tools/api_connectors', $this->page_data);
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
        $is_allowed = $this->isAllowedModuleAccess(48);

        $this->page_data['sidebar'] = $this->api_sidebars();
        if (!$is_allowed) {
            $this->page_data['module'] = 'business_tools';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('tools/business_tools', $this->page_data);
    }

    public function google_contacts() {

        $this->load->library('GoogleApi');

        $this->page_data['sidebar'] = $this->api_sidebars();
        $user_id = getLoggedUserID();
        $this->page_data['google_client_id'] = '30029411767-vjhs0kkitoj3fqun84qrrn7jllohffef.apps.googleusercontent.com';
        $this->page_data['google_client_secret'] = 'mF_M9MamoAmTWwxvYOYLJm4w';
        $this->page_data['google_redirect_uri'] = 'http://localhost/projects/nsmartrac/tools/google_contacts';

        // remove comment for live production s
        //if ($this->user_details->check_if_exist($user_id)) {
            $this->page_data['api_enabled'] = false;
       // }
       // $this->page_data['contacts'] = $this->api_gc->get_all();
        $this->load->view('tools/google_contacts', $this->page_data);
    }

    public function quickbooks() {
        $this->load->library('quickbooksapi');
        $this->page_data['sidebar'] = $this->api_sidebars();
        $user_id = getLoggedUserID();

        if (isset($_GET['code']) && isset($_GET['state']) && isset($_GET['realmId'])) {
            if ($_SESSION['sessionAccessToken'] == null || $_SESSION['sessionAccessToken'] == "") {
                $this->quickbooksapi->create_session($_SERVER['QUERY_STRING']);
            } else {
                $this->quickbooksapi->create_session($_SERVER['QUERY_STRING']);
                $company_info = $this->quickbooksapi->get_qb_company_info();
                $this->page_data['qb_info'] = $company_info;
                $this->page_data['qb_customers'] = $this->quickbooksapi->get_customers();
            }
        } else {
            $this->page_data['authurl'] = $this->quickbooksapi->initialize_auth();
        }

        $this->load->view('tools/quickbooks', $this->page_data);
    }

    public function nicejob() {
        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('tools/nicejob', $this->page_data);
    }

    public function zapier() {
        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('tools/zapier', $this->page_data);
    }

    public function mailchimp() {
        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('tools/mailchimp', $this->page_data);
    }

    public function active_campaign() {
        $this->load->view('tools/active_campaign', $this->page_data);
    }

    public function api_integration()
    {
        $this->page_data['sidebar'] = $this->api_sidebars();
        $this->load->view('tools/api_integration', $this->page_data);
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
        $this->load->library('quickbooksapi');
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
        $this->load->view('tools/ajax_company_converge_form', $this->page_data);
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
            $post['modified'] = date("Y-m-d H:i:s");
            $convergeAccount  = $this->CompanyOnlinePaymentAccount_model->updateCompanyAccount($company_id,$post);
        }else{
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
        $this->load->view('tools/ajax_company_stripe_form', $this->page_data);
    }

    public function ajax_load_company_paypal_form(){
        $this->load->model('CompanyOnlinePaymentAccount_model');
        $company_id = logged('company_id');    

        $paypal = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);

        $this->page_data['paypal'] = $paypal;
        $this->load->view('tools/ajax_company_paypal_form', $this->page_data);
    }

}
