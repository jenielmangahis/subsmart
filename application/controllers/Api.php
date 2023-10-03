<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MYF_Controller
{
    const PAYPAL_CLIENT_ID = "AQxD9RzngFo48GkmU9jX2iOo-rcM7xK-dacDXigsFurFpLbsRFPf0pH3Cr8zzdO8hMRNVEe6FGsklZp5";
    const PAYPAL_SECRET = "EOEdA6HCU4Czmjsn8lMIu7E2HAfTu-aQfdG60SUc2DLr_kUBla6uVzuFWnLhCdGlEkWSbsZSrcSY7EeA";

    public function __construct()
    {
        parent::__construct();
        //$this->load->library('stripe');
        $this->load->model('general_model');
    }

    public function addJSONResponseHeader() {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type: application/json");
    }

    public function fetchCategorizerForm()
    {
        return $this->load->view('accounting/banking/categorizer-form', '');
    }

    public function fetchVendors()
    {
        self::addJSONResponseHeader();
        $get_vendors = array(
            //'where' => array('company_id' => logged('company_id')),
            'table' => 'vendor',
            'select' => 'vendor_name,vendor_id',
        );
        $vendors = $this->general_model->get_data_with_param($get_vendors);
        $data_arr = array("success" => TRUE,"vendors" => $vendors);
        die(json_encode($data_arr));
    }

    public function fetchCustomers()
    {
        self::addJSONResponseHeader();
        $get_vendors = array(
            'where' => array('company_id' => logged('company_id')),
            'table' => 'acs_profile',
            'select' => 'first_name,last_name,prof_id',
        );
        $customers = $this->general_model->get_data_with_param($get_vendors);
        $data_arr = array("success" => TRUE,"customers" => $customers);
        die(json_encode($data_arr));
    }

    public function fetchCategories()
    {
        self::addJSONResponseHeader();
        $get_vendors = array(
            'table' => 'accounting_chart_of_accounts',
            'select' => 'name,id',
        );
        $customers = $this->general_model->get_data_with_param($get_vendors);
        $data_arr = array("success" => TRUE,"categories" => $customers);
        die(json_encode($data_arr));
    }

    public function stripe_response()
    {
        $code =  $_GET['code'];
        $customer =  json_decode($this->stripe->check_user_token($code));

        $user_id = logged('id');
        if(!isset($customer->error)){
            // check if account exist
            $check_stripe_id= array(
                'table' => 'accounting_bank_accounts',
                'where' => array('stripe_user_id' => $customer->stripe_user_id,'user_id' => $user_id,),
                'select' => 'id',
            );
            $is_exist = $this->general_model->get_data_with_param($check_stripe_id);

            if(empty($is_exist)){
                $stripe_data = array();
                $stripe_data['user_id'] = $user_id;
                $stripe_data['stripe_user_id'] = $customer->stripe_user_id;
                $stripe_data['stripe_publish_key'] = $customer->stripe_publishable_key;
                $this->general_model->add_($stripe_data, 'accounting_bank_accounts');
                echo "<script>window.close();</script>";
            }
        }
    }

    public function check_stripe_api_connected()
    {
        $comp_id = logged('company_id');
        $check_stripe_id= array(
            'table' => 'accounting_bank_accounts',
            'where' => array('stripe_user_id !=' => NULL,'company_id' => $comp_id,),
            'select' => 'id',
        );
        $is_exist = $this->general_model->get_data_with_param($check_stripe_id);
        echo json_encode($is_exist);
    }

    public function on_save_paypal_credentials()
    {
        $comp_id = logged('company_id');
        $check_user= array(
            'table' => 'accounting_bank_accounts',
            'where' => array('company_id' => $comp_id,),
            'select' => 'id',
        );
        $is_exist = $this->general_model->get_data_with_param($check_user);

        $input = $this->input->post();
        if($input){
            if(empty($is_exist)){
                $input['company_id'] = $comp_id;
                $this->general_model->add_($input, 'accounting_bank_accounts');
                echo "1";
            }
        }
    }
    public function on_save_bankOfAmerica_credentials()
    {
        $comp_id = logged('company_id');
        $check_user= array(
            'table' => 'accounting_bank_accounts',
            'where' => array('company_id' => $comp_id,),
            'select' => 'id',
        );
        $is_exist = $this->general_model->get_data_with_param($check_user);

        $input = $this->input->post();
        if($input){
            if(empty($is_exist)){
                $input['company_id'] = $comp_id;
                $this->general_model->add_($input, 'accounting_bank_accounts');
                echo "1";
            }
        }
    }
    public function on_save_usBank_credentials()
    {
        $comp_id = logged('company_id');
        $check_user= array(
            'table' => 'accounting_bank_accounts',
            'where' => array('company_id' => $comp_id,),
            'select' => 'id',
        );
        $is_exist = $this->general_model->get_data_with_param($check_user);

        $input = $this->input->post();
        if($input){
            if(empty($is_exist)){
                $input['company_id'] = $comp_id;
                $this->general_model->add_($input, 'accounting_bank_accounts');
                echo "1";
            }else{
                $this->general_model->update_with_key($input,$is_exist->id, 'accounting_bank_accounts');
                echo "1";
            }
        }
    }   
    public function get_paypal_acc(){
        $company_id = logged('company_id');
        $query = $this->db->get_where('accounting_bank_accounts', array('company_id'=> $company_id));

        $data = new stdClass();
        $data->paypalAcc = $query->result();
        echo json_encode($data);
    }
    public function get_paypal_acc_cond(){
        $id = $this->input->post("id");
        $query = $this->db->get_where('accounting_bank_accounts', array('id' => $id)); 

        $data = new stdClass();
        $data->paypalAcc = $query->result();
        echo json_encode($data);
    }

    public function get_capital_one_acc(){
        $company_id = logged('company_id');
        $query = $this->db->get_where('accounting_bank_accounts', array('company_id'=> $company_id));
        

        $data = new stdClass();
        $data->capital_one = $query->result();
        echo json_encode($data);
    }

    public function get_stripe_acc(){
        
        $company_id = logged('company_id');
        $query = $this->db->get_where('accounting_bank_accounts', array('company_id'=> $company_id));
        

        $data = new stdClass();
        $data->stripeAcc = $query->result();
        echo json_encode($data);
    }
    public function get_stripe_acc_cond(){
        $id = $this->input->post("id");
        $query = $this->db->get_where('accounting_bank_accounts', array('id' => $id)); 

        $data = new stdClass();
        $data->account = $query->result();
        echo json_encode($data);
    }
    public function get_capital_one_acc_cond(){
        $id = $this->input->post("id");
        $query = $this->db->get_where('accounting_bank_accounts', array('id' => $id)); 

        $data = new stdClass();
        $data->capital_one_Acc = $query->result();
        echo json_encode($data);
    }
    public function update_capital_one(){
        $data = $this->input->post();
        var_dump($data);
        echo json_encode($data['id']);
        $id = $data['id'];
        $update = $this->db->update('accounting_bank_accounts', $data, array("id" => $id));
    }
    public function delete_paypal_acc(){
        $id = $this->input->post("id");
        $getId = $this->db->where('id', $id);
        $data = array(
            'paypal_client_id' => "",
            'paypal_secret_key' => ""
        );
		$removeID = $this->db->update('accounting_bank_accounts', $data);	
    }
    public function delete_paypal1_acc(){
        $id = $this->input->post("id");
        $getId = $this->db->where('id', $id);
		$removeID = $this->db->delete('accounting_bank_accounts');	
    }

    public function delete_capital_acc(){
        $id = $this->input->post("id");
        $getId = $this->db->where('id', $id);
        $data = array(
            'capital_one_client_id' => "",
            'capital_one_secret_key' => ""
        );
		$removeID = $this->db->update('accounting_bank_accounts', $data);	
    }
    public function delete_cOne_acc(){
        $id = $this->input->post("id");
        $getId = $this->db->where('id', $id);
		$removeID = $this->db->delete('accounting_bank_accounts');	
    }

    public function delete_stripe_credential(){
        $id = $this->input->post("id");
        $getId = $this->db->where('id', $id);
        $data = array(
            'stripe_publish_key' => "",
            'stripe_secret_key' => ""
        );
		$removeID = $this->db->update('accounting_bank_accounts', $data);	
    }

    public function delete_stripe_acc(){
        $id = $this->input->post("id");
        $getId = $this->db->where('id', $id);
		$removeID = $this->db->delete('accounting_bank_accounts');	
    }

    public function update_stripe_acc(){
        $data = $this->input->post();
        echo json_encode($data['id']);
        $id = $data['id'];
        $update = $this->db->update('accounting_bank_accounts', $data, array("id" => $id));

    }
    public function update_paypal_acc(){
        $data = $this->input->post();
        echo json_encode($data);
        $id = $data['id'];
        $update = $this->db->update('accounting_bank_accounts', $data, array("id" => $id));

    }

    public function if_stripeAcc_of_company_exist(){
        $company_id = logged('company_id');
        $query = $this->db->get_where('accounting_bank_accounts', array('company_id'=> $company_id));
        $result = $query->result();
            
           
            $data = $this->input->post();
            $str = $this->db->insert("accounting_bank_accounts", $data);
            $id = $this->db->insert_id();
            $data2 = array('company_id'=>$company_id);
            $update = $this->db->update('accounting_bank_accounts', $data2, array("id" => $id));
        
    }

    public function if_capitalone_of_company_exist(){
        $company_id = logged('company_id');
        $query = $this->db->get_where('accounting_bank_accounts', array('company_id'=> $company_id));
        $result = $query->result();
            
           
            $data = $this->input->post();
            $str = $this->db->insert("accounting_bank_accounts", $data);
            $id = $this->db->insert_id();
            $data2 = array('company_id'=>$company_id);
            $update = $this->db->update('accounting_bank_accounts', $data2, array("id" => $id));
        
    }


    public function if_paypalAcc_of_company_exist(){
        $company_id = logged('company_id');
        $query = $this->db->get_where('accounting_bank_accounts', array('company_id'=> $company_id));
        $result = $query->result();
            
           
            $data = $this->input->post();
            $str = $this->db->insert("accounting_bank_accounts", $data);
            $id = $this->db->insert_id();
            $data2 = array('company_id'=>$company_id);
            $update = $this->db->update('accounting_bank_accounts', $data2, array("id" => $id));    
       
    }

    

    public function get_paypal_access_token($auth_code)
    {
        $data = array(
            'grant_type'=>'authorization_code',
            'code'=>'{'.$auth_code.'}'
        );
        $json_data = json_encode($data);
        $auth = base64_encode( 'ClientID:'. self::PAYPAL_CLIENT_ID );
        $headers = array(
            'Authorization: Basic '.base64_encode(self::PAYPAL_CLIENT_ID).":".base64_encode(self::PAYPAL_SECRET)
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api-m.sandbox.paypal.com/v1/oauth2/token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Basic '.base64_encode(self::PAYPAL_CLIENT_ID).":".base64_encode(self::PAYPAL_SECRET)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        $result = curl_exec($ch);
        $json = json_decode($result);
        print_r($result);
        return $json;
    }

    public function create_auto_sms_notification()
    {
        $is_success = 0;
        $msg = 'Empty POST data';

        $data  = $this->input->post();
        if( $data['company_id'] > 0 ){
            $is_success = createCronAutoSmsNotification($data['company_id'], $data['object_id'], $data['module_name'], $data['status'], $data['user_id'], $data['assigned_user_id'], $data['agent_id']);
            if( $is_success == 1 ){
                $msg = '';
            }else{
                $msg = 'Cannot find auto sms setting';
            }
        }
        
        $result = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($result);
        
        exit;   
    }

    public function create_hash_id()
    {
        $this->load->helper(array('hashids_helper'));

        $data  = $this->input->post();
        $hash_id = 0;

        if( $data['id'] > 0 ){
            $hash_id = hashids_encrypt($data['id'], '', 15);
        }

        $result = ['hash_id' => $hash_id];
        echo json_encode($result);
    }

    public function unserializeData()
    {
        $data  = $this->input->post();
        $unserialize = '';

        if( $data['serialize_data'] != '' ){
            $unserialize = unserialize($data['serialize_data']);
        }

        $result = ['unserialize' => $unserialize];
        echo json_encode($result);
    }

    public function createGoogleCalendarEvent()
    {
        $this->load->helper('google_calendar_helper');
        
        $is_success = 0;
        $msg = 'Empty POST data';

        $data  = $this->input->post();
        /*$testData  = [
            'object_id' => 1,
            'module' => 'appointment',
            'company_id' => 1
        ];*/

        if( $data['object_id'] > 0 ){
            $result = createSyncToCalendar($data['object_id'], $data['module'], $data['company_id']);
            if( $result['is_valid'] == 1 ){
                $msg = 'Success';
                $is_success = 1;
            }else{
                $msg = $result['msg'];
            }
        }
        
        $result = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($result);
        exit;   
    }

    public function fetchCompanyMultiAccountList()
    {
        $this->load->model('CompanyMultiAccount_model');

        $is_success = 0;
        $msg  = 'Cannot find company';
        $data = array();

        $post  = $this->input->post();        
        if( $post['company_id'] > 0 ){
            $conditions[]  = ['field' => 'company_multi_accounts.status', 'value' => $this->CompanyMultiAccount_model->statusVerified()];
            $multiAccounts = $this->CompanyMultiAccount_model->apiGetByAllByCompanyParentId($post['company_id'], $conditions);
            if( $multiAccounts ){
                $data = $multiAccounts; 
                $msg  = '';
                $is_success = 1;
            }else{
                $msg = 'Empty record';
            }
        }

        $return = ['msg' => $msg, 'is_valid' => $is_success, 'data' => $data];
        echo json_encode($return);
        exit;
    }

    public function resendActivationLink()
    {
        $this->load->model('CompanyMultiAccount_model');

        $is_success = 0;
        $msg  = 'Cannot find company';

        $post = $this->input->post();
        $data = array();

        $multiAccount = $this->CompanyMultiAccount_model->getByParentCompanyIdAndLinkUserId($post['company_id'], $post['user_id']);
        if( $multiAccount ){
            if( $multiAccount->status == $this->CompanyMultiAccount_model->statusNotVerified() ){
                $isSent = $this->sendMultiAccountActivationEmail($multiAccount->hash_id, $multiAccount->user_email);
                if( $isSent == 1 ){
                    $is_success = 1;
                    $msg = '';
                }else{
                    $msg = 'Cannot send email. Please contact system administrator.';
                }   
            }else{
                $msg = 'Account already verified. Cannot resend activation email.';
            }
        }

        $return = ['msg' => $msg, 'is_valid' => $is_success];
        echo json_encode($return);
        exit;
    }

    public function createCompanyMultiAccount()
    {
        $this->load->helper(array('hashids_helper'));

        $this->load->model('Users_model');
        $this->load->model('CompanyMultiAccount_model');
        $this->load->model('Business_model');

        $is_success = 0;
        $msg = '';
        $email = '';

        $post = $this->input->post();
        $company_id = $post['company_id'];

        $login_data = ['username' => $post['multi_email'], 'password' => $post['multi_password']];
        $isValid = $this->Users_model->attempt($login_data);
        if( $isValid == 'valid' ){          
            //Create data
            $user = $this->Users_model->getUserByEmail($post['multi_email']);    
            if( $user->company_id != $company_id ){
                //Check if company id already in the list. Can only accept 1 company user 
                $isExists = $this->CompanyMultiAccount_model->getByParentCompanyIdAndLinkCompanyId($company_id, $user->company_id);
                if( $isExists ){
                    $msg = 'An account under company <b>' . $isExists->company_name . '</b> already exists. Cannot accept more than 1 account under same company';
                }else{
                    if( $user->status == 1 ){
                        $data_multi = [
                            'parent_company_id' => $company_id,
                            'link_company_id' => $user->company_id,
                            'link_user_id' => $user->id,
                            'status' => $this->CompanyMultiAccount_model->statusNotVerified(),
                            'created' => date("Y-m-d H:i:s")
                        ];

                        $lastId  = $this->CompanyMultiAccount_model->create($data_multi);
                        $hash_id = hashids_encrypt($lastId, '', 15);
                        $this->CompanyMultiAccount_model->update($lastId, ['hash_id' => $hash_id]);

                        //Send activation link
                        $is_sent = $this->sendMultiAccountActivationEmail($hash_id, $user->email);

                        $email = $user->email;
                        $is_success = 1;
                    }else{
                        $msg = 'Email <b>' . $post['multi_email'] . '</b> is currently inactive. Cannot login email.';
                    }                   
                }
            }else{
                $business = $this->Business_model->getByCompanyId($company_id);
                $msg = 'Email <b>' . $post['multi_email'] . '</b> belongs to current logged company <b>'.$business->business_name.'</b>. Cannot link company data.';
            }   
        }else{
            $msg = 'Invalid email / password';
        }

        $return = ['msg' => $msg, 'is_valid' => $is_success];
        echo json_encode($return);
        exit;
    }

    public function deleteCompanyMultiAccount()
    {
        $this->load->model('CompanyMultiAccount_model');

        $is_success = 0;
        $msg  = 'Cannot find data';

        $post = $this->input->post();
        $multiAccount = $this->CompanyMultiAccount_model->getByParentCompanyIdAndHashId($post['company_id'], $post['hash_id']);
        if( $multiAccount ){            
            $this->CompanyMultiAccount_model->delete($multiAccount->id);
            $is_success = 1;
            $msg = '';
        }

        $return = ['msg' => $msg, 'is_valid' => $is_success];
        echo json_encode($return);
        exit;
    }

    public function sendMultiAccountActivationEmail($hash_id, $recipient_email)
    {
        $is_sent = 1;

        $subject = "nSmarTrac: Multi Account Activation";
        
        $activation_link = base_url('activate_multi_account/'.$hash_id);
        $msg  = "<p>To activate your multi account click the link below.</p><br />";
        $msg .= "<a href='".$activation_link."'>Activate Multi Account</a>";
        $msg .= "<br /><br />From <br />nSmartrac Team";

        $mail = email__getInstance(['subject' => $subject]);
        $mail->FromName = 'nSmarTrac';
        $mail->addAddress($recipient_email, $recipient_email);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        if (!$mail->Send()) {
            $is_sent = 0;
        }

        return $is_sent;
    }

    public function vonageInboundSms()
    {
        $this->load->model('VonageSms_model');

        $post = $this->input->post();
        if( !empty($post) ){
            $data = json_decode($post);        
            if(  isset($data->messageId) && $data->messageId != '' ){
                $data = [
                    'company_id' => 1,
                    'messageId' => $data->messageId,
                    'channel' => 'sms',
                    'from' => $data->msisdn,
                    'to' => $data->to,
                    'sms_message' => $data->text,
                    'status' => 'Sent'
                ];

                $this->VonageSms_model->create($data);            
            }   
        }        

        http_response_code(200);
    }

    public function emailCustomerEstimate()
    {
        $this->load->helper(array('url', 'hashids_helper'));
        $this->load->model('Estimate_model', 'estimate_model');

        $is_sent = 0;
        $msg = '';

        $post = $this->input->post();
        if( $post['estimate_id'] > 0 ){
            $estimate_id = $post['estimate_id'];            
            $estimateData = $this->estimate_model->getEstimate($estimate_id);
            if( $estimateData ){
                $eid  = hashids_encrypt($estimateData->id, '', 15);
                $c_id = $estimateData->company_id;
                $p_id = $estimateData->customer_id;

                $customerData = $this->estimate_model->get_customerData_data($p_id);

                $items_dataOP1 = $this->estimate_model->getItemlistByIDOption1($estimate_id);
                $items_dataOP2 = $this->estimate_model->getItemlistByIDOption2($estimate_id);

                $items_dataBD1 = $this->estimate_model->getItemlistByIDBundle1($estimate_id);
                $items_dataBD2 = $this->estimate_model->getItemlistByIDBundle2($estimate_id);
                $items = $this->estimate_model->getEstimatesItems($estimate_id);

                
                $urlApprove = base_url('share_Link/approveEstimate/' . $eid);
                $urlDecline = base_url('share_Link/declineEstimate/' . $eid);

                $business = $this->business_model->getByCompanyId($c_id);
                $imageUrl = getCompanyBusinessProfileImage();

                $data = array(
                    // 'workorder'             => $workorder,
                    'imageUrl'                      => $urlLogo,
                    'estimateID'                    => $estimateData->id,
                    'urlApprove'                    => $urlApprove,
                    'urlDecline'                    => $urlDecline,
                    'company'                       => $business->business_name,
                    'business_address'              => "$business->address, $business->city $business->postal_code",
                    'phone_number'                  => $business->business_phone,
                    'email_address'                 => $business->business_email,

                    'acs_name'                      => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
                    'acsemail'                      => $customerData->email,
                    'acsaddress'                    => $customerData->mail_add,
                    'phone_m'                       => $customerData->phone_m,

                    'items_dataOP1'                 => $items_dataOP1,
                    'items_dataOP2'                 => $items_dataOP2,
                    'items_dataBD1'                 => $items_dataBD1,
                    'items_dataBD2'                 => $items_dataBD2,

                    'estimate_number'               => $estimateData->estimate_number,
                    'job_location'                  => $estimateData->job_location,
                    'job_name'                      => $estimateData->job_name,
                    'estimate_date'                 => $estimateData->estimate_date,
                    'expiry_date'                   => $estimateData->expiry_date,
                    'purchase_order_number'         => $estimateData->purchase_order_number,
                    'status'                        => $estimateData->status,
                    'estimate_type'                 => $estimateData->estimate_type,
                    'type'                          => $estimateData->type,
                    'deposit_request'               => $estimateData->deposit_request,
                    'deposit_amount'                => $estimateData->deposit_amount,
                    'customer_message'              => $estimateData->customer_message,
                    'terms_conditions'              => $estimateData->terms_conditions,
                    'instructions'                  => $estimateData->instructions,
                    'email'                         => $estimateData->email,
                    'phone'                         => $estimateData->phone_number,
                    'mobile'                        => $estimateData->mobile_number,
                    'terms_and_conditions'          => $estimateData->terms_and_conditions,
                    'terms_of_use'                  => $estimateData->terms_of_use,
                    'job_description'               => $estimateData->job_description,
                    'instructions'                  => $estimateData->instructions,
                    'bundle1_message'               => $estimateData->bundle1_message,
                    'bundle2_message'               => $estimateData->bundle2_message,

                    'items'                         => $items,

                    'bundle_discount'               => $estimateData->bundle_discount,
                    // 'deposit_amount'                => $estimateData->deposit_amount,
                    'bundle1_total'                 => $estimateData->bundle1_total,
                    'bundle2_total'                 => $estimateData->bundle2_total,

                    'option_message'                => $estimateData->option_message,
                    'option2_message'               => $estimateData->option2_message,
                    'option1_total'                 => $estimateData->option1_total,
                    'option2_total'                 => $estimateData->option2_total,

                    'sub_total'                     => $estimateData->sub_total,
                    'sub_total2'                    => $estimateData->sub_total2,
                    'tax1_total'                    => $estimateData->tax1_total,
                    'tax2_total'                    => $estimateData->tax2_total,

                    'grand_total'                   => $estimateData->grand_total,
                    'adjustment_name'               => $estimateData->adjustment_name,
                    'adjustment_value'              => $estimateData->adjustment_value,
                    'markup_type'                   => $estimateData->markup_type,
                    'markup_amount'                 => $estimateData->markup_amount,
                    'eid'                           => $eid
                    // 'source' => $source
                );

                $recipient  = $customerData->email;               
                $mail = email__getInstance(['subject' => 'Estimate Details']);
                $mail->addAddress($recipient, $recipient);
                $mail->isHTML(true);
                $mail->Body = $this->load->view('estimate/send_email_acs_v2', $data, true);

                if(!$mail->Send()) {                    
                    $msg = 'Mailer Error: ' . $mail->ErrorInfo;
                }else{
                    $msg = '';
                    $is_sent = 1;
                }
            }else{
                $msg = 'Cannot find estimate data';
            }
        }

        $return = ['msg' => $msg, 'is_sent' => $is_sent];
        echo json_encode($return);
        exit;
    }

    public function convergeSendSale()
    {
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');
        $this->load->model('Jobs_model');      
        $this->load->model('Invoice_model');  

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();                
        if( $post['invoice_id'] > 0 ){
            $invoice = $this->Invoice_model->getinvoice($post['invoice_id']);
            if( $invoice ){
                $company_id   = $invoice->company_id;
                if( $post['card_number'] != '' && $post['card_cvc'] != '' &&  $post['exp_month'] != '' && $post['exp_year'] != '' ){
                    $convergeCred = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($company_id);
                    if( $convergeCred ){                                            
                        $exp_date = $post['exp_month'] . date("y", strtotime($post['exp_year']));
                        $converge = new \wwwroth\Converge\Converge([
                            'merchant_id' => $convergeCred->converge_merchant_id,
                            'user_id' => $convergeCred->converge_merchant_user_id,
                            'pin' => $convergeCred->converge_merchant_pin,
                            'demo' => true,
                        ]);
                        $createSale = $converge->request('ccsale', [
                            'ssl_card_number' => $post['card_number'],
                            'ssl_exp_date' => $exp_date,
                            'ssl_cvv2cvc2' => $post['card_cvc'],
                            'ssl_amount' => floatval($post['amount']),
                            'ssl_avs_address' => $post['address'],
                            'ssl_avs_zip' => $post['zip'],
                        ]);

                        if ($createSale['success'] == 1) {                            
                            $is_success = 1;
                            $msg = '';
                        } else {
                            $msg = $createSale['errorMessage'];
                        }
                    }else{
                        $msg = 'Invalid Company Converge Account';
                    }
                }else{
                    $msg = 'Invalid card details';
                }                
            }
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function sendEmail()
    {
        $is_sent  = 1;
        $err_msg  = '';

        $post = $this->input->post();
        if( isset($post['email_subject']) && isset($post['email_recipient']) ){            
            $mail = email__getInstance(['subject' => $post['email_subject']]);
            $mail->FromName = 'nSmarTrac';
            $mail->addAddress($post['email_recipient'], $post['email_recipient']);
            $mail->isHTML(true);
            $mail->Subject = $post['email_subject'];
            $mail->Body    = $post['email_message'];
            if (!$mail->Send()) {
                $is_sent = 0;
                $err_msg = 'Cannot send email';
            }
        }else{
            $is_sent = 0;
            $err_msg = 'Email subject and recipient are required';
        }

        $return = ['is_sent' => $is_sent, 'err_msg' => $err_msg];
        echo json_encode($return);
    }

    public function createEmployeeJobCommission()
    {
        $this->load->helper('user_helper');
        
        $is_success  = 1;
        $err_msg  = '';

        $post = $this->input->post();
        if( isset($post['job_id']) ){            
            //Create Commission
		    createEmployeeCommission($post['job_id'], 'job');
            $err_msg = '';
        }else{
            $is_success = 0;
            $err_msg    = 'Cannot find job data';
        }

        $return = ['is_success' => $is_success, 'err_msg' => $err_msg];
        echo json_encode($return);
    }
}