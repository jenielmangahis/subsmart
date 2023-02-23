<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MYF_Controller {

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

        $default_plan = '';
        $default_type = '';
        if( $this->input->get('plan') ){
            $default_plan = $this->input->get('plan');
        }

        if( $this->input->get('type') ){
            $default_type = $this->input->get('type');
        }

        $this->page_data['default_plan'] = $default_plan;
        $this->page_data['default_type'] = $default_type;

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

        //$ip_exist = false;

        $industryTypes = $this->IndustryType_model->getAll();
        $paypal_client_id     = paypal_credential('client_id');
        $paypal_client_secret = paypal_credential('client_secret');     

        $this->page_data['paypal_client_id']     = $paypal_client_id;
        $this->page_data['paypal_client_secret'] = $paypal_client_secret;
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

                \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);      
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

                $stripe = new \Stripe\StripeClient(STRIPE_SECRET_KEY);
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
            $plan_name = strtolower($plan->plan_name);
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

            $ssl_description = $plan_name;
            $ssl_firstname = $post['firstname'];
            $ssl_lastname  = $post['lastname'];
            $ssl_email = $post['email'];
            $ssl_phone = $post['phone'];

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
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        
        $is_valid = false;
        $msg      = '';

        //postAllowed();
        $post = $this->input->post(); 

        //Check if offer code is valid
        $offerCode = $this->OfferCodes_model->getByOfferCodes($post['offer_code']);
        //$startup_checklist = generateClientChecklist();

        if( $offerCode && $offerCode->status == 0 ){
            $num_days_trial = $offerCode->trial_days;
            $next_billing_date = date("Y-m-d", strtotime("+".$num_days_trial." day"));
            $today = strtotime(date("Y-m-d"));
            $cid   = $this->Clients_model->create([
                'first_name' => $post['firstname'],
                'last_name'  => $post['lastname'],
                'email_address' => $post['email'],
                'phone_number'  => $post['phone'],
                'business_name' => $post['business_name'],
                'business_address' => $post['business_address'],
                'zip_code' => $post['zip_code'],
                'number_of_employee' => $post['number_of_employee'],
                'industry_type_id' => $post['industry_type_id'],
                'password' => $post['password'],
                'ip_address' => getValidIpAddress(),
                'plan_date_registered' => date("Y-m-d"),
                'plan_date_expiration' => date("Y-m-d", strtotime("+".$num_days_trial." day")),
                'date_created'  => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'is_plan_active' => 1,
                'nsmart_plan_id' => $post['plan_id'],
                'is_trial' => 1,
                'is_startup' => 1,
                'payment_method' => 'offer code',
                'is_auto_renew' => 0,  
                'next_billing_date' => $next_billing_date,
                'num_months_discounted' => 0,
                'recurring_payment_type' => 'monthly',
                'checklist' => '',
                'is_checklist' => 1
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

            //Create customer
            $customer_data = array(
                'company_id'      => 1,
                'fk_user_id'      => 5,
                'fk_sa_id'        => 0,
                'contact_name'    => $post['firstname'] . ' ' . $post['lastname'],
                'status'          => '',
                'customer_type'   => 'Business',
                'business_name'   => $post['business_name'],
                'first_name'      => $post['firstname'],
                'middle_name'     => '',
                'industry_type_id' => $post['industry_type_id'],
                'last_name'       => $post['lastname'],
                'mail_add'        => $post['business_address'],
                'city'            => '',
                'state'           => '',
                'zip_code'        => $post['zip_code'],
                'phone_h'         => '',
                'phone_m'         => $post['phone']
            );
            $fk_prod_id = $this->customer_ad_model->add($customer_data,"acs_profile");
            
            $is_valid = true;
            $msg      = 'Registration completed. Redirecting to login page.';

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Registration Sucessful. You can login to your account.'); 

        }elseif( $post['offer_code'] == 'CPNSMART2023' ){
            $num_days_trial = 30;
            $next_billing_date = date("Y-m-d", strtotime("+".$num_days_trial." day"));
            $today = strtotime(date("Y-m-d"));
            $cid   = $this->Clients_model->create([
                'first_name' => $post['firstname'],
                'last_name'  => $post['lastname'],
                'email_address' => $post['email'],
                'phone_number'  => $post['phone'],
                'business_name' => $post['business_name'],
                'business_address' => $post['business_address'],
                'zip_code' => $post['zip_code'],
                'number_of_employee' => $post['number_of_employee'],
                'industry_type_id' => $post['industry_type_id'],
                'password' => $post['password'],
                'ip_address' => getValidIpAddress(),
                'plan_date_registered' => date("Y-m-d"),
                'plan_date_expiration' => date("Y-m-d", strtotime("+".$num_days_trial." day")),
                'date_created'  => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'is_plan_active' => 1,
                'nsmart_plan_id' => $post['plan_id'],
                'is_trial' => 1,
                'is_startup' => 1,
                'payment_method' => 'offer code',
                'is_auto_renew' => 0,  
                'next_billing_date' => $next_billing_date,
                'num_months_discounted' => 0,
                'recurring_payment_type' => 'monthly',
                'checklist' => '',
                'is_checklist' => 1
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

            //Create customer
            $customer_data = array(
                'company_id'      => 1,
                'fk_user_id'      => 5,
                'fk_sa_id'        => 0,
                'contact_name'    => $post['firstname'] . ' ' . $post['lastname'],
                'status'          => '',
                'customer_type'   => 'Business',
                'business_name'   => $post['business_name'],
                'first_name'      => $post['firstname'],
                'middle_name'     => '',
                'industry_type_id' => $post['industry_type_id'],
                'last_name'       => $post['lastname'],
                'mail_add'        => $post['business_address'],
                'city'            => '',
                'state'           => '',
                'zip_code'        => $post['zip_code'],
                'phone_h'         => '',
                'phone_m'         => $post['phone']
            );
            $fk_prod_id = $this->customer_ad_model->add($customer_data,"acs_profile");
            
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

    public function converge_payment_redirect()
    {
        echo "<pre>";
        print_r($_POST);
        exit;
    }

    public function ajax_create_registration()
    {
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('NsmartPlan_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('CardsFile_model');

        $is_success = true;
        $is_valid   = false;

        $post = $this->input->post(); 
        if( $post['subscription_type'] != 'trial' ){
            if( $post['payment_method'] == 'paypal' ){
                if( $post['payment_method_status'] == 'COMPLETED' ){
                    $is_valid = true;   
                }
            }elseif( $post['payment_method'] == 'stripe' ){
                if( $post['payment_method_status'] == 'COMPLETED' ){
                    $is_valid = true;   
                }
            }elseif( $post['payment_method'] == 'converge' ){
                $is_valid = true;
            }
            
            $payment_method = $post['payment_method'];
        }else{
            $is_valid = true;
            $payment_method = 'trial';
        }        

        if( $is_valid ){
            $is_trial = 0;
            $plan_amount = 0;
            $num_months_discounted = 0;
            if( $post['subscription_type'] == 'trial' ){
                $is_trial = 1;
            }else{
                $num_months_discounted = REGISTRATION_MONTHS_DISCOUNTED - 1;
                $plan_amount = $post['plan_price_discounted'];
            }

            $plan = $this->NsmartPlan_model->getById($post['plan_id']);
            $next_billing_date = date("Y-m-d", strtotime("+1 month"));
            $today = strtotime(date("Y-m-d"));
            //$startup_checklist = generateClientChecklist();

            $cid   = $this->Clients_model->create([
                'first_name' => $post['firstname'],
                'last_name'  => $post['lastname'],
                'email_address' => $post['email'],
                'phone_number'  => $post['phone'],
                'business_name' => $post['business_name'],                
                'business_address' => $post['business_address'],
                'zip_code' => $post['zip_code'],
                'number_of_employee' => $post['number_of_employee'],
                'industry_type_id' => $post['industry_type_id'],
                'password' => $post['password'],
                'ip_address' => getValidIpAddress(),
                'date_created'  => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s"),
                'is_plan_active' => 1,
                'nsmart_plan_id' => $post['plan_id'],
                'payment_method' => $payment_method,
                'plan_date_registered' => date("Y-m-d", $today),
                'plan_date_expiration' => date("Y-m-d", strtotime("+1 month", $today)),
                'is_trial' => $is_trial,
                'is_startup' => 1,              
                'is_auto_renew' => 0,  
                'number_of_license' => $plan->num_license,
                'next_billing_date' => $next_billing_date,
                'num_months_discounted' => $num_months_discounted,
                'recurring_payment_type' => 'monthly',
                'checklist' => '',
                'is_checklist' => 1
            ]);

            $uid = $this->users_model->create([
                'role' => 3,
                'FName' => $post['firstname'],
                'LName' => $post['lastname'],
                'username' => $post['email'],
                'email' => $post['email'],
                'company_id' => $cid,
                'status' => 1,
                'user_type' => 4,
                'password_plain' =>  $post['password'],
                'password' => hash( "sha256", $post['password'] ),
            ]); 

            //Update cards file                        
            if( $this->session->has_userdata('cfid') ) {
                $cfid = $this->session->userdata('cfid');
                $data = ['company_id' => $cid];
                $this->CardsFile_model->updateCardsFile($cfid, $data);
                $this->session->unset_userdata('cfid');
            }

            if( $is_trial == 0 ){
                $or_amount = $plan_amount;
                $or_description = 'Paid Membership, Monthly';
            }else{
                $or_amount = 0;
                $or_description = 'Trial Membership';
            }

            //Record payment
            $data_payment = [
                'company_id' => $cid,
                'description' => $or_description,
                'payment_date' => date("Y-m-d"),
                'total_amount' => $or_amount,
                'date_created' => date("Y-m-d H:i:s")
            ];

            $sid = $this->CompanySubscriptionPayments_model->create($data_payment);                
            $order_number = $this->CompanySubscriptionPayments_model->generateORNumber($sid);

            $or_data = ['order_number' => $order_number];
            $this->CompanySubscriptionPayments_model->update($sid, $or_data);

            //Send invoice
            $this->send_invoice_email($cid, $sid);

            //Create customer
            $customer_data = array(
                'company_id'      => 1,
                'fk_user_id'      => 5,
                'fk_sa_id'        => 0,
                'contact_name'    => $post['firstname'] . ' ' . $post['lastname'],
                'status'          => '',
                'customer_type'   => 'Business',
                'industry_type_id' => $post['industry_type_id'],
                'business_name'   => $post['business_name'],
                'first_name'      => $post['firstname'],
                'middle_name'     => '',
                'last_name'       => $post['lastname'],
                'mail_add'        => $post['business_address'],
                'city'            => '',
                'state'           => '',
                'zip_code'        => $post['zip_code'],
                'phone_h'         => '',
                'phone_m'         => $post['phone']
            );
            $fk_prod_id = $this->customer_ad_model->add($customer_data,"acs_profile");

            //Create leads
            $leads_input = array(
                'company_id'    => 1,
                'firstname'     => $post['firstname'],
                'lastname'      => $post['lastname'],
                'phone_cell'    => $post['phone'],
                'email_add'     => $post['email'],
                'address'       => $post['business_address'],
            );
            $this->Customer_advance_model->add($leads_input, "ac_leads");
        }

        $json_data = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function send_invoice_email($cid, $payment_id){
        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');
        $this->load->model('Clients_model');

        $company_id = $cid;        
        $payment    = $this->CompanySubscriptionPayments_model->getById($payment_id);
        $company    = $this->Business_model->getByCompanyId($payment->company_id);
        $client     = $this->Clients_model->getById($cid);

        $this->page_data['payment'] = $payment;     
        $this->page_data['client']  = $client; 
        $body    = $this->load->view('mycrm/email_template/registration_invoice', $this->page_data, true);
        $attachment = $this->create_attachment_invoice($payment_id);

        $subject = 'nSmarTrac: Registration';
        $to   = 'webtestcustomer@nsmartrac.com';

        $data = [
            'to' => 'webtestcustomer@nsmartrac.com', 
            'subject' => $subject, 
            'body' => $body,
            'cc' => '',
            'bcc' => '',
            'attachment' => $attachment
        ];

        $isSent = sendEmail($data);
        return true;
    }

    public function create_attachment_invoice($payment_id){

        $this->load->model('CompanySubscriptionPayments_model');
        $this->load->model('Business_model');
        $this->load->model('Clients_model');
        
        $payment    = $this->CompanySubscriptionPayments_model->getById($payment_id);
        $company    = $this->Clients_model->getById($payment->company_id);
        $this->page_data['payment']   = $payment;
        $this->page_data['company'] = $company;
        $content = $this->load->view('mycrm/registration_subscription_invoice_pdf_template_a', $this->page_data, TRUE);  

        $this->load->library('Reportpdf');
        $title = 'subscription_invoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        //$obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetMargins(10, 5, 10, 0, true);
        $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        //$obj_pdf->SetFont('courierI', '', 9);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $obj_pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        ob_clean();
        $obj_pdf->lastPage();
        // $obj_pdf->Output($title, 'I');
        $filename = strtolower($payment->order_number) . ".pdf";
        $file     = dirname(__DIR__, 2) . '/uploads/subscription_invoice/' . $filename;
        $obj_pdf->Output($file, 'F');
        //$obj_pdf->Output($file, 'F');
        return $file;
    }

    public function ajax_converge_token_request(){
        // Set variables
        //Production
        /*$merchantID = "2159250"; //Converge 6 or 7-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
        $merchantUserID = "nsmartapi"; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
        $merchantPinCode = "UJN5ASLON7DJGDET68VF4JQGJILOZ8SDAWXG7SQRDEON0YY8ARXFXS6E19UA1E2X"; //Converge PIN (64 CHAR A/N)*/

        //Demo
        $merchantID = CONVERGE_MERCHANTID; //Converge 6 or 7-Digit Account ID *Not the 10-Digit Elavon Merchant ID*
        $merchantUserID = CONVERGE_MERCHANTUSERID; //Converge User ID *MUST FLAG AS HOSTED API USER IN CONVERGE UI*
        $merchantPinCode = CONVERGE_MERCHANTPIN; //Converge PIN (64 CHAR A/N)

        //$url = "https://api.demo.convergepay.com/hosted-payments/transaction_token"; // URL to Converge demo session token server
        $url = "https://api.convergepay.com/hosted-payments/transaction_token"; // URL to Converge production session token server

        $post = $this->input->post();
        /*Payment Field Variables*/
        // In this section, we set variables to be captured by the PHP file and passed to Converge in the curl request.
        $firstname = $post['firstname']; //Post first name
        $lastname  = $post['lastname']; //Post first name
        $address   = $post['business_address'];
        $zipcode   = $post['zip_code'];
        $amount    = $post['total_amount']; //Post Tran Amount
        //$amount    = 1;
        //$merchanttxnid = $_POST['ssl_merchant_txn_id']; //Capture user-defined ssl_merchant_txn_id as POST data
        //$invoicenumber = $_POST['ssl_invoice_number']; //Capture user-defined ssl_invoice_number as POST data

        //Follow the above pattern to add additional fields to be sent in curl request below.

        $ch = curl_init();    // initialize curl handle
        curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
        curl_setopt($ch,CURLOPT_POST, true); // set POST method
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // Set up the post fields. If you want to add custom fields, you would add them in Converge, and add the field name in the curlopt_postfields string.
        curl_setopt($ch,CURLOPT_POSTFIELDS,
        "ssl_merchant_id=$merchantID".
        "&ssl_user_id=$merchantUserID".
        "&ssl_pin=$merchantPinCode".
        "&ssl_transaction_type=CCSALE".
        "&ssl_first_name=$firstname".
        "&ssl_last_name=$lastname".
        "&ssl_avs_address=$address".
        "&ssl_avs_zip=$zipcode".
        "&ssl_get_token=Y".
        "&ssl_add_token=Y".
        "&ssl_amount=$amount"
        );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result = curl_exec($ch); // run the curl procss
        curl_close($ch); // Close cURL

        //session tokens need to be URL encoded
        //$token = urlencode($result);
        $token = $result;
        $is_success = true;

        $json_data = ['is_success' => $is_success, 'token' => $token];

        echo json_encode($json_data);
        //echo $sessiontoken;  //shows the session token.
    }

    public function ajax_converge_payment(){
        $this->load->model('CardsFile_model');

        $is_success = 0;        
        $message    = '';

        $post   = $this->input->post();
        $plan   = $this->NsmartPlan_model->getById($post['plan_id']);
        $amount = $plan->discount;
        $converge_data = [
            'amount' => $amount,
            'card_number' => $post['ccnumber'],
            'exp_month' => $post['expmonth'],
            'exp_year' => $post['expyear'],
            'card_cvc' => $post['cvc'],
            'address' => $post['address'],
            'zip' => $post['zipcode']
        ];
        $result = $this->converge_send_sale($converge_data);
        if ($result['is_success']) {
            $is_success = 1;
            //Capture card
            $data_cc = [
                'card_owner_first_name' => $post['firstname'],
                'card_owner_last_name' => $post['lastname'],
                'card_number' => $post['ccnumber'],
                'expiration_month' => $post['expmonth'],
                'expiration_year' => $post['expyear'],
                'card_cvv' => $post['cvc'],
                'cc_type' => check_cc_type($post['ccnumber']),
                'is_primary' => 1,
                'created' => date("Y-m-d H:i:s"),
                'modified' => date("Y-m-d H:i:s"),
            ];

            $card_file_id  = $this->CardsFile_model->create($data_cc);
            $this->session->set_userdata('cfid', $card_file_id);
            $is_success = 1;

        }else{
            $message = $result['msg'];
        }

        echo json_encode(['is_success' => $is_success, 'message' => $message]);
        exit;
    }

    public function converge_send_sale($data)
    {
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = '';

        $exp_year = date("m/d/" . $data['exp_year']);
        $exp_date = $data['exp_month'] . date("y", strtotime($exp_year));
        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);
        $createSale = $converge->request('ccsale', [
            'ssl_card_number' => $data['card_number'],
            'ssl_exp_date' => $exp_date,
            'ssl_cvv2cvc2' => $data['card_cvc'],
            'ssl_amount' => $data['amount'],
            'ssl_avs_address' => $data['address'],
            'ssl_avs_zip' => $data['zip'],
        ]);

        if ($createSale['success'] == 1) {
            $is_success = true;
            $msg = '';
        } else {
            $is_success = false;
            $msg = $createSale['errorMessage'];
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }
}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */