<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

    public function __construct(){
        parent::__construct();

        $this->load->model('NsmartPlan_model');
        $this->load->model('Clients_model');
        $this->load->model('Users_model');
        $this->load->model('IndustryType_model');
        $this->load->model('OfferCodes_model');
        $this->load->helper(array('paypal_helper'));
        $this->load->model('Customer_advance_model');

        // Load Paypal SDK
        include APPPATH . 'libraries/paypal-php-sdk/vendor/autoload.php';        

        // Stripe SDK
        include APPPATH . 'libraries/stripe/init.php';   

        $this->page_data['page']->title = 'nSmart - Registration';
    }

    public function index(){

        $get_data = $this->input->get();  

        $payment_status = "";

        /*if($get_data && isset($get_data['status'])) {
            $payment_status = $get_data['status'];
        }*/

        //Paypal subscription process after success - Start
        $payment_complete = false;
        $payment_message  = '';
        if( ($get_data && isset($get_data['status'])) && $get_data['status'] == 'success' ) {

            $client_id     = paypal_credential('client_id');
            $client_secret = paypal_credential('client_secret');             

            //Add paypal client id & secret
            $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        $client_id,  
                        $client_secret
                    )
            );

            if (!empty($_GET['token'])) {
                $token = $_GET['token'];
                $agreement = new \PayPal\Api\Agreement();

                try {
                    //Success
                    $agreement->execute($token, $apiContext);
                    $payment_status = $get_data['status'];
                    $is_success = true;
                } catch (Exception $ex) {
                    $is_success = false;
                    $payment_message = 'Cannot process payment';
                    /*
                    var_dump($ex);
                    exit();*/
                }

                $agreement = \PayPal\Api\Agreement::get($agreement->getId(), $apiContext);
                $details = $agreement->getAgreementDetails();
                $payer = $agreement->getPayer();
                $payerInfo = $payer->getPayerInfo();
                $plan = $agreement->getPlan();
                $payment = $plan->getPaymentDefinitions()[0];

                if( $is_success ){
                    $cid = $this->session->userdata('regiserClientId');
                    $uid = $this->session->userdata('regiserUserId');

                    $this->Clients_model->update($cid, array(
                        'is_plan_active' => 1,
                        'is_startup' => 1,
                        'plan_date_registered' => date("Y-m-d H:i:s")
                    ));

                    $this->users_model->update($uid,[
                        'status' => 1
                    ]);

                    $reg_temp_user_id = $this->session->userdata('reg_temp_user_id');
                    if(isset($reg_temp_user_id) && $reg_temp_user_id > 0)
                    {
                        $leads_input['tablename']   = "ac_leads";
                        $leads_input['field_name']  = "leads_id";
                        $leads_input['id']          = $reg_temp_user_id;
                        $this->Customer_advance_model->delete($leads_input);

                        $this->session->unset_userdata('reg_temp_user_id');
                    }

                    $payment_complete = true;
                    $payment_message  = 'Registration Complete. You can start using Nsmart Trac by logging to your account.';

                    $this->session->set_flashdata('alert-type', 'success');
                    $this->session->set_flashdata('alert', 'Registration Sucessful. You can login to your account.'); 

                    redirect('login');
                }
            }      

        }elseif( ($get_data && isset($get_data['status'])) && $get_data['status'] == 'cancel' ) {
            //Add cancel paypal here
            $cid = $this->session->userdata('regiserClientId');
            $uid = $this->session->userdata('regiserUserId');

            //Delete data
            $this->Clients_model->deleteClient($cid);
            $this->Users_model->deleteUser($uid);

            $payment_complete = false;
            $payment_message  = 'Registration cancelled.';

        }
        //Paypal subscription process after success - End

        $ns_plans = $this->NsmartPlan_model->getAll();      


        $ip_address = getValidIpAddress();
        $ip_adds = $this->Clients_model->getByIPAddress($ip_address);
        
        $ip_count = 0;
        if($ip_adds){
            foreach ($ip_adds as $ip_add) {
                $ip_count ++;
            }
        }    

        if ($ip_count > 0) {
            $ip_exist = true;
        }else{
            $ip_exist = false;
        }

        $industryTypes = $this->IndustryType_model->getAll();

        $this->page_data['industryTypes'] = $industryTypes; 
        $this->page_data['ip_exist'] = $ip_exist; 
        $this->page_data['payment_complete'] = $payment_complete; 
        $this->page_data['payment_message']  = $payment_message;
        $this->page_data['payment_status']   = $payment_status;
        $this->page_data['ns_plans'] = $ns_plans;
        $this->page_data['business'] = getIndustryBusiness();
        $this->page_data['roles']    = getRegistrationRoles();
        $this->load->view('registration', $this->page_data);
    }

    
    public function authenticating_registrationBackup()
    {
        /*
         * To do: 
        *   - Done : Authenticate via email
        *   - Done : Authenticate via business name
        *   - Done : Authenticate via ip address
        */

        $post = $this->input->post();
        $count_exist_email = 0;
        $count_exist_business_name = 0;
        $count_exist_ip_address = 0;

        $is_authentic = 1;

        if(!empty($post)) {
            $aemail = $post['a_email'];
            $abname = $post['a_bname'];
            $client_ip_address = getValidIpAddress();

            $edata = $this->Clients_model->getByEmail($aemail); 
            $edata_business = $this->Clients_model->getByBusinessName($abname); 
            $edata_ip = $this->Clients_model->getByIPAddress($client_ip_address);

            $count_exist_email = count($edata);
            if($count_exist_email > 0) {
                $is_authentic = 0;
            }

            $count_exist_business_name = count($edata_business);
            if($count_exist_business_name > 0) {
                $is_authentic = 0;
            }

            $count_exist_ip_address = count($edata_ip);
            if($count_exist_ip_address > 0) {
                $is_authentic = 0;
            }

        }

        echo $is_authentic;
    }

    public function authenticating_registration()
    {
        /*
         * To do: 
        *   - Done : Authenticate via email
        *   - Done : Authenticate via business name
        *   - Done : Authenticate via ip address
        */

        $post = $this->input->post();
        $count_exist_email = 0;
        $count_exist_business_name = 0;
        $count_exist_ip_address = 0;

        $is_authentic = 1;

        if(!empty($post)) {
            $aemail = $post['a_email'];
            $abname = $post['a_bname'];
            $client_ip_address = getValidIpAddress();

            $edata = $this->Clients_model->getByEmail($aemail); 
            $udata = $this->Users_model->getUserByUsernname($aemail);
            $edata_business = $this->Clients_model->getByBusinessName($abname); 
            $edata_ip = $this->Clients_model->getByIPAddress($client_ip_address);

          
            $count_exist_email = 0;
            if($edata){ 
                foreach ($edata as $edata_val) {
                    $count_exist_email++;
                }
            }

            if($count_exist_email > 0) {
                $is_authentic = 0;
            }

            if( $udata ){
                $is_authentic = 0;
            }

            $count_exist_business_name = 0;
            if($edata_business){ 
                foreach ($edata_business as $edata_business_val) {
                    $count_exist_business_name++;
                }
            }
            if($count_exist_business_name > 0) {
                $is_authentic = 0;
            }


            $count_exist_ip_address = 0;
            if($edata_ip){ 
                foreach ($edata_ip as $edata_ip_val) {
                    $count_exist_ip_address++;
                }
            }
            if($count_exist_ip_address > 0) {
                $is_authentic = 0;
            }

        }

        //echo $is_authentic;
        $leads_input = array(
                        'firstname'     => $post['firstname'],
                        'lastname'      => $post['lastname'],
                        'phone_cell'    => $post['phone'],
                        'email_add'     => $post['a_email'],
                        'address'       => $post['business_address'],
                    );

        $reg_temp_user_id = $this->session->userdata('reg_temp_user_id');
        if(isset($reg_temp_user_id) && $reg_temp_user_id > 0)
        {
            $leads_input['leads_id'] = $reg_temp_user_id;
            $this->Customer_advance_model->update_data($leads_input, "ac_leads", "leads_id");
        }
        else
        {
            $reg_temp_user_id = $this->Customer_advance_model->add($leads_input, "ac_leads");

            $this->session->set_userdata('reg_temp_user_id', $reg_temp_user_id);
        }

        //$is_authentic = 1;
        $json_data = array('is_authentic' => $is_authentic);
        echo json_encode($json_data);        
    }

    function test_stripe(){
        include APPPATH . 'libraries/stripe/init.php';    
        \Stripe\Stripe::setApiKey("sk_test_51Hzgs3IDqnMOqOtppC8BX169Po3GOnczNSNqhneK3rjKzpyGbgzoeSD7ns1qEVkAoPvc3dtyBMh0MRbls0PSvBkq00Dm8c28GY");         
        $plan = $this->NsmartPlan_model->getById(1);
        $stripePlan = \Stripe\Plan::retrieve('test7--');
        echo "<pre>";
        print_r($stripePlan);
        exit;
        if($plan->stripe_plan_id == ''){
            //create new plan
            $plan_name = strtolower($plan->plan_name);
            $plan_name = str_replace(" ", "-", $plan_name);
            $plan_id   = "test-" . $plan_name . "-" . $plan->id;
            $plan = \Stripe\Plan::create(array(
              "amount" => round($plan->price,2)*100,
              "interval" => "month",
              "product" => array(
                "name" => $plan->plan_name
              ),
              "currency" => "usd",
              "id" => $plan_id
            ));
            echo 5;
            echo "<pre>";
            print_r($plan);
        }        
        exit;
        include APPPATH . 'libraries/stripe/init.php';    
        $stripe = new \Stripe\StripeClient('sk_test_51Hzgs3IDqnMOqOtppC8BX169Po3GOnczNSNqhneK3rjKzpyGbgzoeSD7ns1qEVkAoPvc3dtyBMh0MRbls0PSvBkq00Dm8c28GY');
        $customer = $stripe->customers->create([
            'description' => 'bryann customer',
            'email' => 'bryannrr@gmail.com',
            'payment_method' => 'pm_card_visa',
        ]);
        print_r($customer);
        exit;
    }

    function subscribe(){

        postAllowed();
        $post = $this->input->post(); 
       
        $cid = $this->Clients_model->create([
            'first_name' => $post['firstname'],
            'last_name'  => $post['lastname'],
            'email_address' => $post['email'],
            'phone_number'  => $post['phone'],
            'business_name' => $post['business_name'],
            'business_address' => $post['business_address'],
            'number_of_employee' => $post['number_of_employee'],
            'industry_type_id' => $post['industry_type_id'],
            'password' => $post['password'],
            'ip_address' => getValidIpAddress(),
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
            'is_trial' => 0,
            'is_startup' => 1
        ]);

        $uid = $this->users_model->create([
            'role' => 3,
            'FName' => $post['firstname'],
            'LName' => $post['lastname'],
            'username' => $post['email'],
            'email' => $post['email'],
            'company_id' => $cid,
            'status' => 0,
            'password_plain' =>  $post['password'],
            'password' => hash( "sha256", $post['password'] ),
        ]);

        //Get subscription data
        $subscription_id    = $post['plan_id'];
        $subscription_name  = $post['plan_name'];
        $subscription_price = $post['plan_price'];
        $subscription_price_discounted = $post['plan_price_discounted'];
        $subscription_type  = $post['subscription_type'];
        
        if( $post['payment_method'] == 'stripe' ){
            if( isset($post['stripeToken']) ){
                //Stripe

                \Stripe\Stripe::setApiKey("sk_test_51Hzgs3IDqnMOqOtppC8BX169Po3GOnczNSNqhneK3rjKzpyGbgzoeSD7ns1qEVkAoPvc3dtyBMh0MRbls0PSvBkq00Dm8c28GY");      
                $plan      = $this->NsmartPlan_model->getById($subscription_id);
                $plan_name = strtolower($plan->plan_name);
                $plan_name = str_replace(" ", "_", $plan_name);
                $plan_id   = "price_test2_" . $plan_name . "_" . $plan->id;

                if( $post['subscription_type'] == 'prospect' ){
                    $stripe_coupon = 'w1sqO9YX';
                }else{
                    $stripe_coupon = 'xlglClNy';
                }

                if($plan->stripe_price_id != ''){
                    $stripePlan = \Stripe\Plan::retrieve($plan->stripe_price_id);
                    if( !$stripePlan ){
                         //create new plan
                        $stripePlan = \Stripe\Plan::create(array(
                          //"amount" => round($plan->price,2)*100,
                            "amount" => round($plan->price,2),
                          "interval" => "month",
                          "product" => array(
                            "name" => $plan->plan_name
                          ),
                          "currency" => "usd",
                          "id" => $plan_id
                        ));

                        $this->NsmartPlan_model->updatePlan($plan->nsmart_plans_id,array(
                            'stripe_plan_id' => $stripePlan->product,
                            'stripe_price_id' => $plan_id
                        ));
                    }
                }else{
                     //create new plan
                    $stripePlan = \Stripe\Plan::create(array(
                      "amount" => round($plan->price,2)*100,
                      "interval" => "month",
                      "product" => array(
                        "name" => $plan->plan_name
                      ),
                      "currency" => "usd",
                      "id" => $plan_id
                    ));

                    $this->NsmartPlan_model->updatePlan($plan->nsmart_plans_id,array(
                        'stripe_plan_id' => $stripePlan->product,
                        'stripe_price_id' => $plan_id
                    ));
                }

                $stripe = new \Stripe\StripeClient('sk_test_51Hzgs3IDqnMOqOtppC8BX169Po3GOnczNSNqhneK3rjKzpyGbgzoeSD7ns1qEVkAoPvc3dtyBMh0MRbls0PSvBkq00Dm8c28GY');
                $customer = $stripe->customers->create([
                    'description' => $post['firstname'] . " " . $post['lastname'],
                    'email' => $post['email'],
                    'source' => $post['stripeToken'],
                ]);

                $subscription = \Stripe\Subscription::create(array(
                    'customer' => $customer->id,
                    'items' => array(array('plan' => $stripePlan->id)),
                    'coupon' => $stripe_coupon
                ));

                $this->Clients_model->update($cid, array(
                    'paypal_plan_id' => $plan_id,
                    'nsmart_plan_id' => $post['plan_id'],
                    'stripe_token' => $post['stripeToken'],
                    'is_plan_active' => 1
                ));

                $this->users_model->update($uid, array('status' => 1));

                $reg_temp_user_id = $this->session->userdata('reg_temp_user_id');
                if(isset($reg_temp_user_id) && $reg_temp_user_id > 0)
                {
                    $leads_input['tablename'] = "ac_leads";
                    $leads_input['field_name'] = "leads_id";
                    $leads_input['id'] = $reg_temp_user_id;
                    $this->Customer_advance_model->delete($leads_input);

                    $this->session->unset_userdata('reg_temp_user_id');
                }

                $this->session->set_flashdata('alert-type', 'success');
                $this->session->set_flashdata('alert', 'Registration Sucessful. You can login to your account.'); 

                redirect('login');
            }else{
                $this->session->set_flashdata('alert-type', 'danger');
                $this->session->set_flashdata('alert', 'Cannot process payment.'); 
                redirect('registration');
            }
        }elseif( $post['payment_method'] == 'paypal' ){
            //Add custom data such as item/subscription id etc.
            //$userID = 123456;        

            /*
             * Paypal Process Here - Start
            */

            $client_id     = paypal_credential('client_id');
            $client_secret = paypal_credential('client_secret');           

            $return_url = base_url().'registration?status=success';
            $cancel_url = base_url().'registration?status=cancel';          

            //Add paypal client id & secret
            $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        $client_id,  
                        $client_secret
                    )
            );

            // Create a new billing plan
            $plan = new \PayPal\Api\Plan();
            $plan->setName($subscription_name)
              ->setDescription($subscription_name)
              ->setType('fixed');

            // Set billing plan definitions

            if($subscription_type == 'prospect') {

                $paymentDefinition = new \PayPal\Api\PaymentDefinition();
                $paymentDefinition->setName($subscription_name . ' Regular Payments (Discounted)')
                  ->setType('REGULAR')
                  ->setFrequency('Month')
                  ->setFrequencyInterval('3')
                  ->setCycles('1')
                  ->setAmount(new \PayPal\Api\Currency(array('value' => $subscription_price_discounted, 'currency' => 'USD')));

                $paymentDefinition = new \PayPal\Api\PaymentDefinition();
                $paymentDefinition->setName($subscription_name . ' Regular Payments')
                  ->setType('REGULAR')
                  ->setFrequency('Month')
                  ->setFrequencyInterval('1')
                  ->setCycles('12')
                  ->setAmount(new \PayPal\Api\Currency(array('value' => $subscription_price, 'currency' => 'USD')));

            }elseif($subscription_type == 'trial') {

                $paymentDefinition = new \PayPal\Api\PaymentDefinition();
                $paymentDefinition->setName($subscription_name . " (Free Trial)")
                  ->setType('TRIAL')
                  ->setFrequency('Month')
                  ->setFrequencyInterval('1')
                  ->setCycles('1')
                  ->setAmount(new \PayPal\Api\Currency(array('value' => 0, 'currency' => 'USD')));

                $paymentDefinition = new \PayPal\Api\PaymentDefinition();
                $paymentDefinition->setName($subscription_name . " (Regular Payment)")
                  ->setType('REGULAR')
                  ->setFrequency('Month')
                  ->setFrequencyInterval('1')
                  ->setCycles('12')
                  ->setAmount(new \PayPal\Api\Currency(array('value' => $subscription_price, 'currency' => 'USD')));                 

            }

            // Set charge models
            $chargeModel = new \PayPal\Api\ChargeModel();
            $chargeModel->setType('TAX')
              ->setAmount(new \PayPal\Api\Currency(array('value' => 0, 'currency' => 'USD')));
            $paymentDefinition->setChargeModels(array($chargeModel));

            // Set merchant preferences    
            $merchantPreferences = new \PayPal\Api\MerchantPreferences();
            $merchantPreferences->setReturnUrl($return_url)
              ->setCancelUrl($cancel_url)
              ->setAutoBillAmount('yes')
              ->setInitialFailAmountAction('CONTINUE')
              ->setMaxFailAttempts('0');
              //->setSetupFee(new \PayPal\Api\Currency(array('value' => 1, 'currency' => 'USD')));

            $plan->setPaymentDefinitions(array($paymentDefinition));
            $plan->setMerchantPreferences($merchantPreferences);

            //create plan
            try {

              $createdPlan = $plan->create($apiContext);

              try {

                    $patch = new \PayPal\Api\Patch();
                    $value = new \PayPal\Common\PayPalModel('{"state":"ACTIVE"}');
                    $patch->setOp('replace')
                      ->setPath('/')
                      ->setValue($value);
                    $patchRequest = new \PayPal\Api\PatchRequest();
                    $patchRequest->addPatch($patch);
                    $createdPlan->update($patchRequest, $apiContext);
                    $plan = \PayPal\Api\Plan::get($createdPlan->getId(), $apiContext);
                    $plan_id = $plan->getId();

                } catch (PayPal\Exception\PayPalConnectionException $ex) {        
                    die($ex);
                } catch (Exception $ex) {
                    die($ex);
                }
            } catch (PayPal\Exception\PayPalConnectionException $ex) {    
                die($ex);
            } catch (Exception $ex) {
                die($ex);
            }

            //Set agreement

            //$datetime = new DateTime('2020-12-30 23:21:46');

            $datetime = new DateTime( date('Y-m-d H:i:s', strtotime("+1 day")) );
            $subscription_date = $datetime->format(DateTime::ATOM);

            $agreement = new \PayPal\Api\Agreement();

            $plan_name = $subscription_name; //change this to plan name

            $agreement->setName($plan_name)
                ->setDescription($plan_name)
                ->setStartDate($subscription_date);

            $plan = new \PayPal\Api\Plan();

            $plan->setId($plan_id);
            $agreement->setPlan($plan);

            $payer = new \PayPal\Api\Payer();

            $payer->setPaymentMethod('paypal');
            $agreement->setPayer($payer);

            try {

                $agreement   = $agreement->create($apiContext);
                $approvalUrl = $agreement->getApprovalLink();

            } catch (Exception $ex) {

                echo "Paypal subscription failed. Please contact your system admin.";
                var_dump($ex);
                exit();

            } 

            $this->Clients_model->update($cid, array(
                'paypal_plan_id' => $plan_id,
                'nsmart_plan_id' => $post['plan_id'],
                'is_plan_active' => 0
            ));

            $this->session->set_userdata('regiserUserId', $uid);
            $this->session->set_userdata('regiserClientId', $cid);

            header("Location:" . $approvalUrl);

            /*
             *  Paypal Process Here - End
            */ 
        }else{
            $plan      = $this->NsmartPlan_model->getById($subscription_id);
            //Converge
            // Provide Converge Credentials
            $merchantID =  CONVERGE_MERCHANTID; // "2159250"; //Converge 6-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
            $merchantUserID = CONVERGE_MERCHANTUSERID; // "nsmartapi"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
            $merchantPIN = CONVERGE_MERCHANTPIN; // "UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X"; //Converge PIN (64 CHAR A/N)

            //$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
            $url    = CONVERGE_TOKENURL; // URL to Converge production session token server
            $hppurl = CONVERGE_HPPURL; // URL to the demo Hosted Payments Page            

            /*Payment Field Variables*/

            // In this section, we set variables to be captured by the PHP file and passed to Converge in the curl request.

            //$amount = $post['plan_price']; //Hard-coded transaction amount for testing.
            $amount = $plan->discount; //Hard-coded transaction amount for testing.

            //$amount  = $_POST['ssl_amount'];   //Capture ssl_amount as POST data
            //$firstname  = $_POST['ssl_first_name'];   //Capture ssl_first_name as POST data
            //$lastname  = $_POST['ssl_last_name'];   //Capture ssl_last_name as POST data
            //$merchanttxnid = $_POST['ssl_merchant_txn_id']; //Capture ssl_merchant_txn_id as POST data
            //$invoicenumber = $_POST['ssl_invoice_number']; //Capture ssl_invoice_number as POST data

            if( $post['subscription_type'] == 'prospect' ){
                $next_billing = date("m/d/Y",strtotime("+60 days"));
            }else{
                $next_billing = date("m/d/Y",strtotime("+30 days"));
            }

            $ssl_description = $plan->plan_name . " / " . $plan->price;
            $ssl_firstname = $post['firstname'];
            $ssl_lastname  = $post['lastname'];
            $ssl_email = $post['email'];
            $ssl_phone = $post['phone'];
            $ssl_companyname = $post['business_name'];

            //Follow the above pattern to add additional fields to be sent in curl request below.
            //$merchanttxnid = "3234342343";
            $ch = curl_init();    // initialize curl handle
            curl_setopt($ch, CURLOPT_URL,$url); // set POST target URL
            curl_setopt($ch,CURLOPT_POST, true); // set POST method
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //Build the request for the session id. Make sure all payment field variables created above get included in the CURLOPT_POSTFIELDS section below.  ccsale

            curl_setopt($ch,CURLOPT_POSTFIELDS,
            "ssl_merchant_id=$merchantID".
            "&ssl_user_id=$merchantUserID".
            "&ssl_pin=$merchantPIN".
            "&ssl_transaction_type=ccaddrecurring".
            "&ssl_billing_cycle=MONTHLY".
            "&ssl_next_payment_date=$next_billing".
            "&ssl_description=$ssl_description".
            "&ssl_phone=$ssl_phone".
            "&ssl_company=$ssl_companyname".
            "&ssl_first_name=$ssl_firstname".
            "&ssl_last_name=$ssl_lastname".
            "&ssl_email=$ssl_email".
            //"&ssl_test_mode=TRUE".
            //"&ssl_txn_id=$merchanttxnid".
            "&ssl_amount=$amount"
            );

            $result = curl_exec($ch); // run the curl to post to Converge
            curl_close($ch); // Close cURL

            $sessiontoken= urlencode($result);

            $this->session->set_userdata('regiserUserId', $uid);
            $this->session->set_userdata('regiserClientId', $cid);

            /*echo "<pre>";
            print_r($sessiontoken);
            exit;*/
            /* Now we redirect to the HPP */
            //header("Location: https://api.demo.convergepay.com/hosted-payments?ssl_txn_auth_token=$sessiontoken");  //Demo Redirect
            header("Location: https://api.demo.convergepay.com/hosted-payments?ssl_txn_auth_token=$sessiontoken"); //Prod Redirect 
        }
    }

    public function registration_use_code()
    {
        $is_valid = false;
        $msg      = '';

        postAllowed();
        $post = $this->input->post(); 

        //Check if offer code is valid
        $offerCode = $this->OfferCodes_model->getByOfferCodes($post['offer_code']);

        if( $offerCode && $offerCode->status == 0 ){
            $cid = $this->Clients_model->create([
                'first_name' => $post['firstname'],
                'last_name'  => $post['lastname'],
                'email_address' => $post['email'],
                'phone_number'  => $post['phone'],
                'business_name' => $post['business_name'],
                'business_address' => $post['business_address'],
                'number_of_employee' => $post['number_of_employee'],
                'industry_type_id' => $post['industry_type_id'],
                'password' => $post['password'],
                'ip_address' => getValidIpAddress(),
                'date_created'  => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'is_plan_active' => 1,
                'nsmart_plan_id' => $post['plan_id'],
                'is_trial' => 1,
                'is_startup' => 1
            ]);

            $uid = $this->users_model->create([
                'role' => 3,
                'FName' => $post['firstname'],
                'LName' => $post['lastname'],
                'username' => $post['email'],
                'email' => $post['email'],
                'company_id' => $cid,
                'status' => 1,
                'password_plain' =>  $post['password'],
                'password' => hash( "sha256", $post['password'] ),
            ]);

            $this->OfferCodes_model->update($offerCode->id, array(
                'client_id' => $cid,
                'status' => 1
            ));

            $reg_temp_user_id = $this->session->userdata('reg_temp_user_id');
            if(isset($reg_temp_user_id) && $reg_temp_user_id > 0)
            {
                $leads_input['tablename'] = "ac_leads";
                $leads_input['field_name'] = "leads_id";
                $leads_input['id'] = $reg_temp_user_id;
                $this->Customer_advance_model->delete($leads_input);

                $this->session->unset_userdata('reg_temp_user_id');
            }
            
            $is_valid = true;
            $msg      = 'Registration completed. Redirecting to login page.';

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Registration Sucessful. You can login to your account.'); 

        }else{
            $msg = 'Invalid offer code';
        }

        $json_data = ['is_valid' => $is_valid, 'msg' => $msg];

        echo json_encode($json_data);
    }
    
    public function converge_payment()
    {
         // Provide Converge Credentials
          $merchantID =  "0019127"; // "2159250"; //Converge 6-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
          $merchantUserID = "webpage"; // "nsmartapi"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
          $merchantPIN = "IJFZ3DQUK9MPLHGUS618ZJ9KWH7EI3G0QTQ5IGI6NY3701LZ1E5SHMBE1MEMG7UA"; // "UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X"; //Converge PIN (64 CHAR A/N)

          //$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
          $url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge production session token server

          //$hppurl = "https://demo.api.convergepay.com/hosted-payments"; // URL to the demo Hosted Payments Page
          $hppurl = "https://api.demo.convergepay.com/hosted-payments"; // URL to the production Hosted Payments Page

          /*Payment Field Variables*/

          // In this section, we set variables to be captured by the PHP file and passed to Converge in the curl request.

          $amount= '19.00'; //Hard-coded transaction amount for testing.

          //$amount  = $_POST['ssl_amount'];   //Capture ssl_amount as POST data
          //$firstname  = $_POST['ssl_first_name'];   //Capture ssl_first_name as POST data
          //$lastname  = $_POST['ssl_last_name'];   //Capture ssl_last_name as POST data
          //$merchanttxnid = $_POST['ssl_merchant_txn_id']; //Capture ssl_merchant_txn_id as POST data
          //$invoicenumber = $_POST['ssl_invoice_number']; //Capture ssl_invoice_number as POST data

          //Follow the above pattern to add additional fields to be sent in curl request below.
          //$merchanttxnid = "3234342343";
          $ch = curl_init();    // initialize curl handle
          curl_setopt($ch, CURLOPT_URL,$url); // set POST target URL
          curl_setopt($ch,CURLOPT_POST, true); // set POST method
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

          //Build the request for the session id. Make sure all payment field variables created above get included in the CURLOPT_POSTFIELDS section below.  ccsale

          curl_setopt($ch,CURLOPT_POSTFIELDS,
          "ssl_merchant_id=$merchantID".
          "&ssl_user_id=$merchantUserID".
          "&ssl_pin=$merchantPIN".
          "&ssl_transaction_type=ccaddrecurring".
          "&ssl_billing_cycle=MONTHLY".
          "&ssl_next_payment_date=03/25/2021".
          "&ssl_amount=$amount"
          );

          $result = curl_exec($ch); // run the curl to post to Converge
          curl_close($ch); // Close cURL

          $sessiontoken= urlencode($result);
          /*echo "<pre>";
          print_r($sessiontoken);
          exit;*/
          /* Now we redirect to the HPP */
          //header("Location: https://api.demo.convergepay.com/hosted-payments?ssl_txn_auth_token=$sessiontoken");  //Demo Redirect
          header("Location: https://api.demo.convergepay.com/hosted-payments?ssl_txn_auth_token=$sessiontoken"); //Prod Redirect

    }

    public function converge_payment_test()
    {

        $cURLConnection = curl_init();
         
        curl_setopt($cURLConnection, CURLOPT_URL, 'https://demo.convergepay.com/hosted-payments/myip');
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
         
        $response = curl_exec($cURLConnection);
        curl_close($cURLConnection);
         
        echo $response;

    }

    public function converge_success_payment()
    {
        $cid = $this->session->userdata('regiserClientId');
        $uid = $this->session->userdata('regiserUserId');

        $this->Clients_model->update($cid, array(
            'converge_ssl_transaction_type' => $_GET['ssl_transaction_type'],
            'converge_ssl_recurring_id' => $_GET['ssl_recurring_id'],
            'is_plan_active' => 1,
            'is_startup' => 1,
            'plan_date_registered' => date("Y-m-d H:i:s")
        ));

        $this->users_model->update($uid,[
            'status' => 1
        ]);

        $reg_temp_user_id = $this->session->userdata('reg_temp_user_id');
        if(isset($reg_temp_user_id) && $reg_temp_user_id > 0)
        {
            $leads_input['tablename']   = "ac_leads";
            $leads_input['field_name']  = "leads_id";
            $leads_input['id']          = $reg_temp_user_id;
            $this->Customer_advance_model->delete($leads_input);

            $this->session->unset_userdata('reg_temp_user_id');
        }

        $payment_complete = true;
        $payment_message  = 'Registration Complete. You can start using Nsmart Trac by logging to your account.';

        $this->session->set_flashdata('message_type', 'success');
        $this->session->set_flashdata('message', 'Registration Sucessful. You can login to your account.'); 

        redirect('login');
    }

    public function cancel_converge_payment()
    {
        $cid = $this->session->userdata('regiserClientId');
        $uid = $this->session->userdata('regiserUserId');

        //Delete data
        $this->Clients_model->deleteClient($cid);
        $this->Users_model->deleteUser($uid);

        $this->session->set_flashdata('message_type', 'danger');
        $this->session->set_flashdata('message', 'Registration cancelled.');

        redirect('login');
    }
}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */