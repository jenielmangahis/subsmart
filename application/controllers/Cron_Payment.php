<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Payment extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
	}

    public function recurring_subscription(){
        include APPPATH . 'libraries/Converge/src/Converge.php';
        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('General_model', 'general');


        $date = date("Y-m-d");
        $clients = $this->Clients_model->getAllExpiredSubscription($date);
        
        foreach($clients as $c){
            $nsmartPlan = $this->NsmartPlan_model->getById($c->nsmart_plan_id);
            if( $nsmartPlan ){
                $ssl_amount     = $nsmartPlan->price;
                $ssl_first_name = $c->first_name;
                $ssl_last_name  = $c->last_name;
                $card_number = '';
                $exp_date    = $exp_month . date("y",strtotime($exp_year));

                $converge = new \wwwroth\Converge\Converge([
                    'merchant_id' => CONVERGE_MERCHANTID,
                    'user_id' => CONVERGE_MERCHANTUSERID,
                    'pin' => CONVERGE_MERCHANTPIN,
                    'demo' => false,
                ]);

                $createSale = $converge->request('ccsale', [
                    'ssl_card_number' => $card_number,
                    'ssl_exp_date' => $exp_date,
                    'ssl_cvv2cvc2' => $cvc,
                    'ssl_first_name' => $ssl_first_name,
                    'ssl_last_name' => $ssl_last_name,
                    'ssl_amount' => $ssl_amount,
                    'ssl_avs_address' => $ssl_address,
                    'ssl_avs_zip' => $ssl_zip,
                ]);

                if( $createSale['success'] == 1 ){
                    //Update registration
                    $next_expiration = date("Y-m-d", strtotime("+30 days"));
                    $this->Clients->updateClient($c->id, ['plan_date_expiration' => $next_expiration]);

                    //Add to payments table
                    $transaction_details = array();
                    $transaction_details['customer_id'] = $c->id;
                    $transaction_details['subtotal'] = $ssl_amount;
                    $transaction_details['tax'] = 0;
                    $transaction_details['category'] = 'MS';
                    $transaction_details['method'] = 'CC';
                    $transaction_details['transaction_type'] = 'Recurring';
                    $transaction_details['frequency'] = '';
                    $transaction_details['notes'] = 'Renewed subscription for the month of ' . date("M/Y");
                    $transaction_details['status'] = 'Approved';
                    $transaction_details['datetime'] = date("m-d-Y h:i A");
                    $this->general->add_($transaction_details, 'acs_transaction_history');
                }    
            }
        }
    }
}

