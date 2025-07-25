<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_Payment extends MYF_Controller {

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

        $total_renewed = 0;
        $total_deactivated = 0;

        $exempted_company_ids = exempted_company_ids();
        $clients = $this->Clients_model->getAllAutoRenewSubscriptions($exempted_company_ids, [], 50);

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

                    $amount = 0;
                    $num_months_discounted = 0;
                    if( $client->num_months_discounted > 0 ){
                        $amount   = $plan->discount;
                    }else{
                        $amount   = $plan->price;    
                    }

                    if( $client->recurring_payment_type == 'monthly' ){
                        $amount = $amount + $total_addon_price;
                        $next_billing_date = date("Y-m-d", strtotime("+1 month", strtotime($client->next_billing_date)));
                        $num_months_discounted = $client->num_months_discounted - 1; 
                    }else{
                        $amount = ($amount + $total_addon_price) * 12;
                        $next_billing_date = date("Y-m-d", strtotime("+1 year", strtotime($client->next_billing_date)));
                        $num_months_discounted = max($client->num_months_discounted - 12,0); 
                    }

                    $businessProfile  = $this->Business_model->getByCompanyId($client->id);
                    $address  = $businessProfile->street . " " . $businessProfile->city . " " . $businessProfile->state;
                    $zip_code = $businessProfile->postal_code;
                    if( $primaryCard->expiration_month < 10 ){
                        $exp_month = 0 . $primaryCard->expiration_month;
                    }else{
                        $exp_month = $primaryCard->expiration_month;
                    }
                    $exp_year = date('m/d/'.$primaryCard->expiration_year);
                    $exp_date = $exp_month . date('y', strtotime($exp_year));

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
                        $data = [           
                            'payment_method' => 'converge',     
                            //'plan_date_registered' => date("Y-m-d"),
                            'plan_date_expiration' => $next_billing_date,                
                            'date_modified' => date("Y-m-d H:i:s"),
                            'is_plan_active' => 1,
                            'nsmart_plan_id' => $plan->nsmart_plans_id,
                            'is_trial' => 0,
                            'next_billing_date' => $next_billing_date,
                            'num_months_discounted' => $num_months_discounted,
                            'renewal_date' => date("Y-m-d")
                        ];
                        $this->Clients_model->update($client->id, $data);

                        //Record payment
                        $data_payment = [
                            'company_id' => $client->id,
                            'description' => 'Paid Membership - ' . ucwords($client->recurring_payment_type),
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

                        $total_renewed++;

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

                        $total_deactivated++;
                    }
                }else{
                    $data = [     
                        'recurring_subscription_payment_error' => 'No plan detected',               
                        'date_modified' => date("Y-m-d H:i:s"),
                        'is_auto_renew' => 0,
                        'is_plan_active' => 0,
                        'is_with_payment_error' => 1
                    ];
                    $this->Clients_model->update($client->id, $data);

                    $options = array('cluster' => PUSHER_CLUSTER, 'useTLS' => true);
                    $pusher = new Pusher\Pusher(PUSHER_KEY, PUSHER_SECRET, PUSHER_APPID, $options);
                    $pusher->trigger('nsmart-company', 'force-logout', ['company_id' => $client->id]);

                    $total_deactivated++;
                }
            }else{
                $data = [     
                    'recurring_subscription_payment_error' => 'No primary card detected',               
                    'date_modified' => date("Y-m-d H:i:s"),
                    'is_auto_renew' => 0,
                    'is_plan_active' => 0,
                    'is_with_payment_error' => 1
                ];
                $this->Clients_model->update($client->id, $data);

                $options = array('cluster' => PUSHER_CLUSTER, 'useTLS' => true);
                $pusher = new Pusher\Pusher(PUSHER_KEY, PUSHER_SECRET, PUSHER_APPID, $options);
                $pusher->trigger('nsmart-company', 'force-logout', ['company_id' => $client->id]);

                $total_deactivated++;
            }
        }

        if( $total_deactivated > 0 || $total_renewed > 0 ){
            //Send email notification
            $subject = 'nSmarTrac: Cron Daily Subscription Renewal';
            $to      = 'bryannrevina@nsmartrac.com';
            $body    = "Today's Total deactivated subscription is " . $total_deactivated . " and total renewed subscription is " . $total_renewed;

            $data = [
                'to' => $to, 
                'subject' => $subject, 
                'body' => $body,
                'cc' => '',
                'bcc' => '',
                'attachment' => ''
            ];
            sendEmail($data);
        }
        

        echo "Today's Total deactivated subscription is " . $total_deactivated . " and total renewed subscription is " . $total_renewed;
    }

    // Deactivate expired nsmart subcription
    public function deactivate_unpaid_nsmart_subscription()
    {
        $this->load->model('Clients_model');

        ini_set('max_execution_time', 0);

        $exempted_company_ids = exempted_company_ids();
        $clients = $this->Clients_model->getAllExpiredSubscriptions($exempted_company_ids,[],50);

        $total_deactivated = 0;
        foreach( $clients as $client ){            
            $data = ['is_plan_active' => 0, 'date_modified' => date("Y-m-d H:i:s")];
            $this->Clients_model->update($client->id, $data);

            $options = array('cluster' => PUSHER_CLUSTER, 'useTLS' => true);
            $pusher = new Pusher\Pusher(PUSHER_KEY, PUSHER_SECRET, PUSHER_APPID, $options);
            $pusher->trigger('nsmart-company', 'force-logout', ['company_id' => $client->id]);

            $total_deactivated++;
        }

        if( $total_deactivated > 0 ){
            //Send email notification
            $subject = 'nSmarTrac: Cron Daily Deactivated Subscriptions';
            $to      = 'bryannrevina@nsmartrac.com';
            $body    = "Today's Total deactivated subscription is " . $total_deactivated;

            $data = [
                'to' => $to, 
                'subject' => $subject, 
                'body' => $body,
                'cc' => '',
                'bcc' => '',
                'attachment' => ''
            ];
            sendEmail($data);
        }

        echo "Today's Total deactivated subscription is " . $total_deactivated;
        exit;
    }

    //For checking recurring payments with error - need to set in cron once a day checking
    //Needs update. Removed from cpanel cron jobs.
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

                    if( $client->recurring_payment_type == 'monthly' ){
                        $amount = $amount + $total_addon_price;
                        $next_billing_date = date("Y-m-d", strtotime("+1 month", strtotime($client->next_billing_date)));
                    }else{
                        $amount = ($amount + $total_addon_price) * 12;
                        $next_billing_date = date("Y-m-d", strtotime("+1 year", strtotime($client->next_billing_date)));
                    }

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
                            'is_with_payment_error' => 0,
                            'renewal_date' => date("Y-m-d")
                        ];
                        $this->Clients_model->update($client->id, $data);

                        //Record payment
                        $data_payment = [
                            'company_id' => $client->id,
                            'description' => 'Paid Membership - ' . ucwords($client->recurring_payment_type),
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
                            'recurring_subscription_payment_error' => 'Payment error',               
                            'date_modified' => date("Y-m-d H:i:s"),
                            'is_auto_renew' => 0,
                            'is_plan_active' => 0,
                            'is_with_payment_error' => 1
                        ];
                        $this->Clients_model->update($client->id, $data);
                    }
                }else{
                    $data = [     
                        'recurring_subscription_payment_error' => 'No plan detected',               
                        'date_modified' => date("Y-m-d H:i:s"),
                        'is_auto_renew' => 0,
                        'is_plan_active' => 0,
                        'is_with_payment_error' => 1
                    ];
                    $this->Clients_model->update($client->id, $data);
                }
            }else{
                $data = [     
                    'recurring_subscription_payment_error' => 'No primary card detected',               
                    'date_modified' => date("Y-m-d H:i:s"),
                    'is_auto_renew' => 0,
                    'is_plan_active' => 0,
                    'is_with_payment_error' => 1
                ];
                $this->Clients_model->update($client->id, $data);
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

    public function process_accounting_recurring_transaction_payment()
    {
        $this->load->model('Accounting_recurring_transactions_model');
        $this->load->model('AccountingRecurringTransactionPayment_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');

        $total_data = 0;
        $date = date("Y-m-d");
        $transactions = $this->Accounting_recurring_transactions_model->getAllByNextDateAndStatus($date, 1);
        if( $transactions ){
            foreach($transactions as $transaction) {
                $total = 0;
                $recurring_payee_id = 0;
                switch($transaction['txn_type']) {
                    case 'expense' :
                        //$expense = $this->vendors_model->get_expense_by_id($transaction['txn_id']);
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id, payee_id AS recurring_payee_id
                            FROM accounting_expense                         
                            WHERE id ='.$transaction['txn_id'].'
                        ');                        
                    break;
                    case 'check' :
                        //$check = $this->vendors_model->get_check_by_id($transaction['txn_id'], logged('company_id'));
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,payee_id AS recurring_payee_id
                            FROM accounting_check                         
                            WHERE id ='.$transaction['txn_id'].'
                        ');    
                    break;
                    case 'bill' :
                        //$bill = $this->vendors_model->get_bill_by_id($transaction['txn_id'], logged('company_id'));
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,vendor_id AS recurring_payee_id
                            FROM accounting_bill                         
                            WHERE id ='.$transaction['txn_id'].'
                        ');   
                    break;
                    case 'purchase order' :
                        //$purchaseOrder = $this->vendors_model->get_purchase_order_by_id($transaction['txn_id'], logged('company_id'));
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,vendor_id AS recurring_payee_id
                            FROM accounting_purchase_order                         
                            WHERE id ='.$transaction['txn_id'].'
                        ');  
                    break;
                    case 'vendor credit' :
                        //$vCredit = $this->vendors_model->get_vendor_credit_by_id($transaction['txn_id'], logged('company_id'));
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,vendor_id AS recurring_payee_id
                            FROM accounting_vendor_credit                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 
                    break;
                    case 'credit card credit' :
                        //$ccCredit = $this->vendors_model->get_credit_card_credit_by_id($transaction['txn_id'], logged('company_id'));
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,payee_id AS recurring_payee_id
                            FROM accounting_credit_card_credits                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 
                    break;
                    case 'deposit' :
                        //$deposit = $this->accounting_bank_deposit_model->getById($transaction['txn_id'], logged('company_id'));
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id
                            FROM accounting_bank_deposit                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 
                    break;
                    case 'transfer' :
                        //$transfer = $this->accounting_transfer_funds_model->getById($transaction['txn_id'], logged('company_id'));
                        $query = $this->db->query('
                            SELECT COALESCE(transfer_amount,0) AS total_amount,company_id
                            FROM accounting_transfer_funds_transaction                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 
                    break;
                    case 'journal entry' :
                        $query = '';
                    break;
                    case 'npcharge' :
                        //$charge = $this->accounting_delayed_charge_model->getDelayedChargeDetails($transaction['txn_id']);
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,customer_id AS recurring_payee_id
                            FROM accounting_delayed_charge                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 
                    break;
                    case 'npcredit' :
                        //$credit = $this->accounting_delayed_credit_model->getDelayedCreditDetails($transaction['txn_id']);
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,customer_id AS recurring_payee_id
                            FROM accounting_delayed_credit                         
                            WHERE id ='.$transaction['txn_id'].'
                        ');                         
                    break;
                    case 'credit memo' :
                        //$creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($transaction['txn_id']);
                        $query = $this->db->query('
                            SELECT COALESCE(total_amount,0) AS total_amount,company_id,customer_id AS recurring_payee_id
                            FROM accounting_credit_memo                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 

                    break;
                    case 'invoice' :
                        //$invoice = $this->invoice_model->getinvoice($transaction['txn_id']);
                        $query = $this->db->query('
                            SELECT COALESCE(grand_total,0) AS total_amount,company_id,customer_id AS recurring_payee_id
                            FROM accounting_credit_memo                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 
                    break;
                    case 'refund' :
                        //$refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($transaction['txn_id']);
                        $query = $this->db->query('
                            SELECT COALESCE(grand_total,0) AS total_amount,company_id,customer_id AS recurring_payee_id
                            FROM accounting_refund_receipt                         
                            WHERE id ='.$transaction['txn_id'].'
                        '); 
                    break;
                    case 'sales receipt' :
                        //$salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($transaction['txn_id']);
                        $query = $this->db->query('
                            SELECT COALESCE(grand_total,0) AS total_amount,company_id,customer_id AS recurring_payee_id
                            FROM accounting_sales_receipt                         
                            WHERE id ='.$transaction['txn_id'].'
                        ');
                        $total = number_format($salesReceipt->total_amount, 2, '.', ',');
                        $company_id = $salesReceipt->company_id;
                    break;
                }

                $result = $query->row();

                if( $result ){
                    $start_date = date("Y-m-d", strtotime($transaction['start_date']));
                    $previous   = !is_null($transaction['previous_date']) && $transaction['previous_date'] !== '' ? date("Y-m-d", strtotime($transaction['previous_date'])) : null;
                    $next       = date("Y-m-d", strtotime($transaction['next_date']));

                    $every = $transaction['recurr_every'];
                    switch ($transaction['recurring_interval']) {
                        case 'daily' :
                            $interval = 'days';
                        break;
                        case 'weekly' :
                            $interval = 'weeks';
                        break;
                        case 'monthly' :
                            $interval = 'months';
                        break;
                        case 'yearly' :
                            $interval = 'years';
                        break;
                        default :
                            $interval = 'days';
                        break;
                    }

                    if(intval($every) > 1) {
                        if( $previous == null ){
                            $bill_date = date("Y-m-d", strtotime($start_date . " +".$every." ".$interval));
                        }else{
                            $bill_date = date("Y-m-d", strtotime($previous . " +".$every." ".$interval));
                        }
                    }else{
                        if( $previous == null ){
                            $bill_date = date("Y-m-d", strtotime($start_date . " +1 ".$interval));
                        }else{
                            $bill_date = date("Y-m-d", strtotime($previous . " +1 ".$interval));
                        }
                    }

                    $customer_credit_card = null;
                    $recurring_payee_id = isset($result->recurring_payee_id) ? $result->recurring_payee_id : null;
                    if(isset($recurring_payee_id) && $recurring_payee_id > 0) {
                        $bill_info = $this->customer_ad_model->get_data_by_id('fk_prof_id', $recurring_payee_id, 'acs_billing');
                        if($bill_info) {
                            if($billing_info->credit_card_num != null && $billing_info->credit_card_num != 0) {
                                $customer_credit_card = $billing_info->credit_card_num;
                            }
                        }
                    }

                    //Add stripe payment here..
                    if($customer_credit_card != null) {

                    }

                    //Process Payment
                    $new_current_occurence = $transaction['current_occurrence'] + 1;
                    $previous_date = $date;
                    $next_date     = $date;
                    $status = 1;
                    if( $new_current_occurence < $transaction['max_occurrences'] ){
                        $next_date = $bill_date;
                    }else{
                        $status = 3;
                    }   

                    $data_update = [
                        'current_occurrence' => $new_current_occurence,
                        'previous_date' => $previous_date,
                        'next_date' => $next_date,
                        'status' => $status,
                        'updated_at' => date("Y-m-d H:i:s")
                    ];

                    $this->Accounting_recurring_transactions_model->update($transaction['id'], $data_update);

                    //Create payment
                    $data_payment = [
                        'company_id' => $result->company_id,
                        'accounting_recurring_transaction_id' => $transaction['id'],
                        'payment_date' => $previous_date,
                        'amount' => $result->total_amount,
                        'date_created' => date("Y-m-d H:i:s")
                    ];

                    $this->AccountingRecurringTransactionPayment_model->create($data_payment);

                    $total_data++;
                }                
            }
        }

        echo 'Total updated ' . $total_data;
    }
}

