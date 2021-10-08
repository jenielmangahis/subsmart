<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MYF_Controller
{
    const PAYPAL_CLIENT_ID = "AQxD9RzngFo48GkmU9jX2iOo-rcM7xK-dacDXigsFurFpLbsRFPf0pH3Cr8zzdO8hMRNVEe6FGsklZp5";
    const PAYPAL_SECRET = "EOEdA6HCU4Czmjsn8lMIu7E2HAfTu-aQfdG60SUc2DLr_kUBla6uVzuFWnLhCdGlEkWSbsZSrcSY7EeA";

    public function __construct()
    {
        parent::__construct();
        $this->load->library('stripe');
        $this->load->model('general_model');
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
            $input['user_id'] = logged('id');
            if(empty($is_exist)){
                $this->general_model->add_($input, 'accounting_bank_accounts');
                echo "1";
            }
        }
    }

    public function paypal_response()
    {
        $code = $_GET['code'];
        $access_token = self::get_paypal_access_token($code);
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
}