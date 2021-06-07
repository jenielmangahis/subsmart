<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Payment extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
	}

    public function nsmart_recurring_subscription(){
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

                echo $card_number;exit;

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
        
    public function customer_recurring_subscription(){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        ini_set('max_execution_time', 0);
        
        $this->load->model('General_model', 'general');
        $date = date("n/j/Y");
        $get_billing = array(
            'where' => array(
                //'recurring_start_date <=' => $date,
                //'recurring_end_date <=' => $date,
                'next_billing_date' => $date,
                'last_payment_date <>' => $date, 
                //'credit_card_num !=' => null
            ),
            'table' => 'acs_billing',
            'select' => 'acs_billing.*',
            'limit' => 50
        );
        $data = $this->general->get_data_with_param($get_billing, true);

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $total_updated = 0;
        foreach( $data as $d ){
            if( $d->transaction_amount > 0 ){
                $exp_date = str_replace("/", "", $d->credit_card_exp);
                $createSale = $converge->request('ccsale', [
                    'ssl_card_number' => $d->credit_card_num,
                    'ssl_exp_date' => $exp_date,
                    'ssl_cvv2cvc2' => $d->credit_card_exp_mm_yyyy,
                    'ssl_first_name' => $d->card_fname,
                    'ssl_last_name' => $d->card_lname,
                    'ssl_amount' => $d->transaction_amount,
                    'ssl_avs_address' => $d->card_address,
                    'ssl_avs_zip' => $d->zip,
                ]);
                if( $createSale['success'] == 1 ){
                    //Update billing
                    $transaction_data = array();
                    $transaction_data['total_payments']    = $d->total_payments + 1;
                    $transaction_data['last_payment_date'] = date('n/j/Y');
                    $transaction_data['next_billing_date'] = date("n/j/Y",strtotime("+" . $d->frequency . " months"));
                    $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');

                    //Add to payments table
                    $transaction_details = array();
                    $transaction_details['customer_id'] = $d->fk_prof_id;
                    $transaction_details['subtotal'] = $d->transaction_amount;
                    $transaction_details['tax'] = 0;
                    $transaction_details['category'] = $d->transaction_category;
                    $transaction_details['method'] = 'CC';
                    $transaction_details['transaction_type'] = 'Recurring';
                    $transaction_details['frequency'] = $d->frequency;
                    $transaction_details['notes'] = 'Payment for ' .$d->transaction_category. ' for the month of ' . date("M/Y");
                    $transaction_details['status'] = 'Approved';
                    $transaction_details['datetime'] = date("m-d-Y h:i A");
                    $this->general->add_($transaction_details, 'acs_transaction_history');

                    $total_updated++;
                }
            }
            
        }
        
        echo "Total updated " . $total_updated . " record(s)";
        exit;
    }

    public function customer_recurring_billing(){
        include APPPATH . 'libraries/Converge/src/Converge.php';
        $this->load->model('General_model', 'general');
        $date = date("M/d/Y");
        $get_employee = array(
            'where' => array(
                'recurring_start_date <=' => $date,
                'total_payments < frequency' => '',
                'credit_card_num !=' => null
            ),
            'table' => 'acs_billing',
            'select' => 'acs_billing.*',
        );
        $data = $this->general->get_data_with_param($get_employee);

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $total_updated = 0;
        foreach( $data as $d ){
            if( $d->transaction_amount > 0 ){
                $exp_date = str_replace("/", "", $d->credit_card_exp);
                $createSale = $converge->request('ccsale', [
                    'ssl_card_number' => $d->credit_card_num,
                    'ssl_exp_date' => $exp_date,
                    'ssl_cvv2cvc2' => $d->credit_card_exp_mm_yyyy,
                    'ssl_first_name' => $d->card_fname,
                    'ssl_last_name' => $d->card_lname,
                    'ssl_amount' => $d->transaction_amount,
                    'ssl_avs_address' => $d->card_address,
                    'ssl_avs_zip' => $d->zip,
                ]);

                if( $createSale['success'] == 1 ){
                    //Update total payments made
                    $transaction_data = array();
                    $transaction_data['total_payments'] = $d->total_payments + 1;
                    $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');

                    //Add to payments table
                    $transaction_details = array();
                    $transaction_details['customer_id'] = $d->fk_prof_id;
                    $transaction_details['subtotal'] = $d->transaction_amount;
                    $transaction_details['tax'] = 0;
                    $transaction_details['category'] = $d->transaction_category;
                    $transaction_details['method'] = 'CC';
                    $transaction_details['transaction_type'] = 'Recurring';
                    $transaction_details['frequency'] = $d->frequency;
                    $transaction_details['notes'] = 'Payment for ' .$d->transaction_category. ' for the month of ' . date("M/Y");
                    $transaction_details['status'] = 'Approved';
                    $transaction_details['datetime'] = date("m-d-Y h:i A");
                    $this->general->add_($transaction_details, 'acs_transaction_history');

                    $total_updated++;
                }
            }
            
        }
        
        echo "Total updated " . $total_updated . " record(s)";
        exit;
    }
}

