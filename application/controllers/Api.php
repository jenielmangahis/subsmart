<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends MYF_Controller
{
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
        $user_id = logged('id');
        $check_stripe_id= array(
            'table' => 'accounting_bank_accounts',
            'where' => array('stripe_user_id !=' => NULL,'user_id' => $user_id,),
            'select' => 'id',
        );
        $is_exist = $this->general_model->get_data_with_param($check_stripe_id);
        echo json_encode($is_exist);
    }

    public function paypal_response()
    {
        echo 'paypal response';
    }
}