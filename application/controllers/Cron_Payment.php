<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Payment extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
	}

    public function company_recurring_nsmart_subscription(){
        include APPPATH . 'libraries/Converge/src/Converge.php';
        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('General_model', 'general');
        $this->load->model('CardsFile_model');
        $this->load->model('Business_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('SubscriberNsmartUpgrade_model');

        ini_set('max_execution_time', 0);

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $date = date("Y-m-d");
        $get_subscription = array(
            'where' => array(
                'next_billing_date' => $date,
                'is_auto_renew' => 1,
                'is_with_payment_error' => 0
            ),
            'table' => 'clients',
            'select' => 'clients.*',
            'limit' => 50
        );
        $clients = $this->general->get_data_with_param($get_subscription, true);
        foreach( $clients as $client ){
            $primaryCard = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
            if( $primaryCard ){
                $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
                if( $plan ){

                    $addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
                    $total_addon_price = 0;
                    foreach($addons as $a){
                        $total_addon_price += $a->service_fee;
                    }

                    if( $client->num_months_discounted > 0 ){
                        $amount   = $plan->price;
                    }else{
                        $amount   = $plan->discount;    
                    }

                    $amount = $amount + $total_addon_price;

                    $businessProfile  = $this->Business_model->getByCompanyId($client->id);
                    $address  = $businessProfile->street . " " . $businessProfile->city . " " . $businessProfile->state;
                    $zip_code = $businessProfile->postal_code;
                    if( $primaryCard->expiration_month < 10 ){
                        $exp_month = 0 . $primaryCard->expiration_month;
                    }else{
                        $exp_month = $primaryCard->expiration_month;
                    }
                    $exp_date = $exp_month . $primaryCard->expiration_year;
                    $createSale = $converge->request('ccsale', [
                        'ssl_card_number' => $primaryCard->card_number,
                        'ssl_exp_date' => $exp_date,
                        'ssl_cvv2cvc2' => $primaryCard->card_cvv,
                        'ssl_first_name' => $primaryCard->card_owner_first_name,
                        'ssl_last_name' => $primaryCard->card_owner_last_name,
                        'ssl_amount' => $amount,
                        'ssl_avs_address' => $address,
                        'ssl_avs_zip' => $zip_code,
                    ]);
                    if( $createSale['success'] == 1 ){
                        $num_months_discounted = 0;
                        if( $client->num_months_discounted > 0 ){
                            $num_months_discounted = $client->num_months_discounted - 1;    
                        }

                        $next_billing_date = date("Y-m-d", strtotime("+1 month", strtotime($client->next_billing_date)));
                        $data = [           
                            'payment_method' => 'converge',     
                            //'plan_date_registered' => date("Y-m-d"),
                            //'plan_date_expiration' => date("Y-m-d", strtotime("+1 month")),                
                            'date_modified' => date("Y-m-d H:i:s"),
                            'is_plan_active' => 1,
                            'nsmart_plan_id' => $plan->nsmart_plans_id,
                            'is_trial' => 0,
                            'next_billing_date' => $next_billing_date,
                            'num_months_discounted' => $num_months_discounted
                        ];
                        $this->Clients_model->update($client->id, $data);

                        //Record payment
                        $data_payment = [
                            'company_id' => $client->id,
                            'description' => 'Paid Membership, Monthly',
                            'payment_date' => date("Y-m-d"),
                            'total_amount' => $amount,
                            'date_created' => date("Y-m-d H:i:s")
                        ];
                        
                        $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                        $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);
                                
                        $data = ['order_number' => $order_number];
                        $this->CompanySubscriptionPayments_model->update($id, $data);

                        //Request remove addon
                        $this->SubscriberNsmartUpgrade_model->deleteAllRequestRemovalByClientId($client->id);

                    }else{
                        $data = [           
                            //'payment_method' => 'converge',     
                            //'plan_date_registered' => date("Y-m-d"),
                            //'plan_date_expiration' => date("Y-m-d", strtotime("+1 month")),
                            'recurring_subscription_payment_error' =>  $createSale['errorMessage'],               
                            'date_modified' => date("Y-m-d H:i:s"),
                            'is_plan_active' => 0,
                            'is_with_payment_error' => 1
                        ];
                        $this->Clients_model->update($client->id, $data);
                    }
                }
            }
        }

        //echo "Done";
    }

    //For checking recurring payments with error - need to set in cron once a day checking
    public function company_recurring_nsmart_subscription_with_payment_errors(){
        include APPPATH . 'libraries/Converge/src/Converge.php';
        $this->load->model('Clients_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('General_model', 'general');
        $this->load->model('CardsFile_model');
        $this->load->model('Business_model');
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('SubscriberNsmartUpgrade_model');

        ini_set('max_execution_time', 0);

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $date = date("Y-m-d");
        $get_subscription = array(
            'where' => array(
                'is_auto_renew' => 1,
                'is_with_payment_error' => 1
            ),
            'table' => 'clients',
            'select' => 'clients.*',
            'limit' => 50
        );
        $clients = $this->general->get_data_with_param($get_subscription, true);
        foreach( $clients as $client ){
            $primaryCard = $this->CardsFile_model->getCompanyPrimaryCard($client->id);
            if( $primaryCard ){
                $plan = $this->NsmartPlan_model->getById($client->nsmart_plan_id);
                if( $plan ){

                    $addons = $this->SubscriberNsmartUpgrade_model->getAllByClientId($client->id);
                    $total_addon_price = 0;
                    foreach($addons as $a){
                        $total_addon_price += $a->service_fee;
                    }

                    if( $client->num_months_discounted > 0 ){
                        $amount   = $plan->price;
                    }else{
                        $amount   = $plan->discount;    
                    }

                    $amount = $amount + $total_addon_price;

                    $businessProfile  = $this->Business_model->getByCompanyId($client->id);
                    $address  = $businessProfile->street . " " . $businessProfile->city . " " . $businessProfile->state;
                    $zip_code = $businessProfile->postal_code;
                    if( $primaryCard->expiration_month < 10 ){
                        $exp_month = 0 . $primaryCard->expiration_month;
                    }else{
                        $exp_month = $primaryCard->expiration_month;
                    }
                    $exp_date = $exp_month . $primaryCard->expiration_year;
                    $createSale = $converge->request('ccsale', [
                        'ssl_card_number' => $primaryCard->card_number,
                        'ssl_exp_date' => $exp_date,
                        'ssl_cvv2cvc2' => $primaryCard->card_cvv,
                        'ssl_first_name' => $primaryCard->card_owner_first_name,
                        'ssl_last_name' => $primaryCard->card_owner_last_name,
                        'ssl_amount' => $amount,
                        'ssl_avs_address' => $address,
                        'ssl_avs_zip' => $zip_code,
                    ]);
                    if( $createSale['success'] == 1 ){
                        $num_months_discounted = 0;
                        if( $client->num_months_discounted > 0 ){
                            $num_months_discounted = $client->num_months_discounted - 1;    
                        }

                        $next_billing_date = date("Y-m-d", strtotime("+1 month", strtotime($client->next_billing_date)));
                        $data = [           
                            'payment_method' => 'converge',     
                            //'plan_date_registered' => date("Y-m-d"),
                            //'plan_date_expiration' => date("Y-m-d", strtotime("+1 month")),                
                            'date_modified' => date("Y-m-d H:i:s"),
                            'is_plan_active' => 1,
                            'nsmart_plan_id' => $plan->nsmart_plans_id,
                            'is_trial' => 0,
                            'next_billing_date' => $next_billing_date,
                            'num_months_discounted' => $num_months_discounted,
                            'recurring_subscription_payment_error' => '',
                            'is_with_payment_error' => 0
                        ];
                        $this->Clients_model->update($client->id, $data);

                        //Record payment
                        $data_payment = [
                            'company_id' => $client->id,
                            'description' => 'Paid Membership, Monthly',
                            'payment_date' => date("Y-m-d"),
                            'total_amount' => $amount,
                            'date_created' => date("Y-m-d H:i:s")
                        ];

                        $id = $this->CompanySubscriptionPayments_model->create($data_payment);
                        $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($id);
                                
                        $data = ['order_number' => $order_number];
                        $this->CompanySubscriptionPayments_model->update($id, $data);

                        //Request remove addon
                        $this->SubscriberNsmartUpgrade_model->deleteAllRequestRemovalByClientId($client->id);
                    }
                }
            }
        }

        echo "Done";
    }

    //Disable account if not auto recurring and subscription is already expired
    public function company_deactivate_expired_unpaid_plan(){
        $this->load->model('Clients_model');

        $this->Clients_model->deactivateExpiredUnpaidSubscription();
        echo "Done";
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
            $total_amount = $d->equipment + $d->mmr;
            if( $total_amount > 0 ){
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
        
        //echo "Total updated " . $total_updated . " record(s)";
        exit;
    }

    public function test(){
    	echo 45;exit;
    }

    public function acs_subscription_method_cc(){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        ini_set('max_execution_time', 0);
        
        $this->load->model('General_model', 'general');
        $date = date("n/j/Y");
        $get_billing = array(
            'where' => array(
                //'recurring_start_date <=' => $date,
                'next_subscription_billing_date' => $date,
                'recurring_end_date >=' => $date,
                'bill_method' => 'CC',
                'is_with_error' => 0
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
                    $transaction_data['next_subscription_billing_date'] = date("n/j/Y",strtotime("+" . $d->frequency . " months"));
                    $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');

                    //Add to payments table
                    $transaction_details = array();
                    $transaction_details['customer_id'] = $d->fk_prof_id;
                    $transaction_details['subtotal'] = $d->transaction_amount;
                    $transaction_details['tax'] = 0;
                    $transaction_details['category'] = $d->transaction_category;
                    $transaction_details['method'] = 'CC';
                    $transaction_details['transaction_type'] = 'Recurring';
                    $transaction_details['frequency'] = 'Every '.$d->frequency.' Month(s)';
                    $transaction_details['notes'] = 'Payment for subscription ' . $d->transaction_category . ' for the month of ' . date("M/Y");
                    $transaction_details['status'] = 'Approved';
                    $transaction_details['datetime'] = date("m-d-Y h:i A");
                    $this->general->add_($transaction_details, 'acs_transaction_history');

                    //Add to subscriptions table
                    $subscription_details = array();
                    $subscription_details['customer_id'] = $d->fk_prof_id;
                    $subscription_details['category'] = $d->transaction_category;
                    $subscription_details['total_amount'] = $d->transaction_amount;
                    $subscription_details['method'] = 'CC';
                    $subscription_details['transaction_type'] = 'Recurring';
                    //$subscription_details['frequency'] = 'Every '.$d->frequency.' Month(s)';
                    $subscription_details['frequency'] = $d->frequency;
                    //$subscription_details['num_frequency'] = $d->frequency;
                    $subscription_details['notes'] = 'Payment for subscription ' . $d->transaction_category . ' for the month of ' . date("M/Y");
                    $subscription_details['status'] = 'Approved';
                    $this->general->add_($subscription_details, 'acs_subscriptions');

                    $total_updated++;
                }else{
                    $transaction_data['is_with_error'] = 1;
                    $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');
                }
            }
            
        }
        
        //echo "Total updated " . $total_updated . " record(s)";
        exit;
    }

    public function acs_billing_method_cc(){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        ini_set('max_execution_time', 0);
        
        $this->load->model('General_model', 'general');
        $date = date("n/j/Y");
        $get_billing = array(
            'where' => array(
                'next_billing_date' => $date,
                'recurring_end_date >= ' . $date, 
                'bill_method' => 'CC',
                'is_with_error' => 0
                //'credit_card_num !=' => null
            ),
            'table' => 'acs_billing',
            'select' => 'acs_billing.*',
            'limit' => 50
        );
        /*$get_billing = array(
            'where' => array(
                'bill_id' => 2465
            ),
            'table' => 'acs_billing',
            'select' => 'acs_billing.*',
            'limit' => 50
        );*/
        $data = $this->general->get_data_with_param($get_billing, true);

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $total_updated = 0;
        foreach( $data as $d ){
            $total_amount = 0;
            if( $d->equipment > 0 ){
                $total_amount += $d->equipment;
            }
            if( $d->mmr > 0 ){
                $total_amount += $d->mmr;
            }
            
            if( $d->transaction_amount > 0 ){
                $total_amount += $d->transaction_amount;
            }
            
            if( $total_amount > 0 ){                
                $a_exp_date = explode("/", $d->credit_card_exp);
                $exp_date   = $a_exp_date[0] . date("y",strtotime($a_exp_date[1] . "-01-01"));
                $createSale = $converge->request('ccsale', [
                    'ssl_card_number' => $d->credit_card_num,
                    'ssl_exp_date' => $exp_date,
                    'ssl_cvv2cvc2' => $d->credit_card_exp_mm_yyyy,
                    'ssl_first_name' => $d->card_fname,
                    'ssl_last_name' => $d->card_lname,
                    'ssl_amount' => $total_amount,
                    'ssl_avs_address' => $d->card_address,
                    'ssl_avs_zip' => $d->zip,
                ]);
                if( $createSale['success'] == 1 ){
                    //Update billing
                    $transaction_data = array();
                    $transaction_data['is_with_error']     = 0;
                    $transaction_data['error_type']        = '';
                    $transaction_data['error_date']        = '';
                    $transaction_data['error_message']     = '';
                    $transaction_data['next_billing_date'] = date("n/j/Y",strtotime("+" . $d->billing_frequency . " months"));
                    $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');

                    //Add to payments table
                    if( $d->billing_frequency == 1 ){
                        $frequency = 'One Time Only';
                    }elseif( $d->billing_frequency == '12' ){
                        $frequency = 'Every 1 Year';
                    }else{
                        $frequency = 'Every '.$d->billing_frequency.' Month(s)';
                    }
                    $transaction_details = array();
                    $transaction_details['customer_id'] = $d->fk_prof_id;
                    $transaction_details['subtotal'] = $total_amount;
                    $transaction_details['tax'] = 0;
                    $transaction_details['category'] = $d->transaction_category;
                    $transaction_details['method'] = 'CC';
                    $transaction_details['transaction_type'] = 'Recurring';
                    $transaction_details['frequency'] = $frequency;
                    $transaction_details['notes'] = 'Payment for equipment/plan for the month of ' . date("M/Y");
                    $transaction_details['status'] = 'Approved';
                    $transaction_details['datetime'] = date("m-d-Y h:i A");
                    $this->general->add_($transaction_details, 'acs_transaction_history');

                    $total_updated++;
                }else{
                    $transaction_data['error_message'] = $createSale['errorMessage'];
                    $transaction_data['is_with_error'] = 1;
                    $transaction_data['error_type']    = 'CC';
                    $transaction_data['error_date']    = date("Y-m-d");
                    $transaction_data['unpaid_amount'] = $d->unpaid_amount + $total_amount;
                    $transaction_data['next_billing_date'] = date("n/j/Y",strtotime("+" . $d->billing_frequency . " months"));
                    $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');
                }
            }
            
        }
        
        //echo "Total updated " . $total_updated . " record(s)";
        exit;
    }

    public function acs_billing_method_cc_unpaid_amount(){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        ini_set('max_execution_time', 0);
        
        $this->load->model('General_model', 'general');
        $date = date("n/j/Y");
        $get_billing = array(
            'where' => array(
                'unpaid_amount >' => 0,
                'is_with_error' => 0
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
            $total_amount = $d->unpaid_amount;
            $a_exp_date = explode("/", $d->credit_card_exp);
            $exp_date   = $a_exp_date[0] . date("y",strtotime($a_exp_date[1] . "-01-01"));
            $createSale = $converge->request('ccsale', [
                'ssl_card_number' => $d->credit_card_num,
                'ssl_exp_date' => $exp_date,
                'ssl_cvv2cvc2' => $d->credit_card_exp_mm_yyyy,
                'ssl_first_name' => $d->card_fname,
                'ssl_last_name' => $d->card_lname,
                'ssl_amount' => $total_amount,
                'ssl_avs_address' => $d->card_address,
                'ssl_avs_zip' => $d->zip,
            ]);
            if( $createSale['success'] == 1 ){
                //Update billing
                $transaction_data = array();
                $transaction_data['unpaid_amount']     = 0;
                $transaction_data['error_type']        = '';
                $transaction_data['error_date']        = '';
                $transaction_data['error_message']     = '';
                $transaction_data['next_billing_date'] = date("n/j/Y",strtotime("+" . $d->billing_frequency . " months"));
                $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');

                //Add to payments table
                if( $d->billing_frequency == 1 ){
                    $frequency = 'One Time Only';
                }elseif( $d->billing_frequency == '12' ){
                    $frequency = 'Every 1 Year';
                }else{
                    $frequency = 'Every '.$d->billing_frequency.' Month(s)';
                }
                $transaction_details = array();
                $transaction_details['customer_id'] = $d->fk_prof_id;
                $transaction_details['subtotal'] = $total_amount;
                $transaction_details['tax'] = 0;
                $transaction_details['category'] = $d->transaction_category;
                $transaction_details['method'] = 'CC';
                $transaction_details['transaction_type'] = 'Recurring';
                $transaction_details['frequency'] = $frequency;
                $transaction_details['notes'] = 'Payment for unpaid amount of $' . number($total_amount,2);
                $transaction_details['status'] = 'Approved';
                $transaction_details['datetime'] = date("m-d-Y h:i A");
                $this->general->add_($transaction_details, 'acs_transaction_history');

                $total_updated++;
            }else{
                $transaction_data['error_message'] = $createSale['errorMessage'];
                $transaction_data['is_with_error'] = 1;
                $transaction_data['error_type']    = 'CC';
                $transaction_data['error_date']    = date("Y-m-d");
                $this->general->update_with_key_field($transaction_data, $d->bill_id, 'acs_billing', 'bill_id');
            }
        }
        //echo "Total updated " . $total_updated . " record(s)";
        exit;
    }
}

