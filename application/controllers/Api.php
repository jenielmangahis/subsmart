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
    public function if_paypalAcc_of_company_exist(){
        $company_id = logged('company_id');
        $query = $this->db->get_where('accounting_bank_accounts', array('company_id'=> $company_id));
        $result = $query->result();

            $data = $this->input->post();
            $str = $this->db->update('accounting_bank_accounts', $data, array("company_id" => $company_id));
       
    }

    public function on_save_stripe_crendetials()
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
                echo "0";
            }else{
                $this->general_model->update_with_key($input,$is_exist->id, 'accounting_bank_accounts');
                echo "1";
            }
        }
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