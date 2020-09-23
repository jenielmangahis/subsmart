<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct(){
		parent::__construct();

        $this->load->model('NsmartPlan_model');
        $this->load->model('Clients_model');
        $this->load->model('Users_model');

        $this->load->helper(array('paypal_helper'));

        // Load Paypal SDK
        include APPPATH . 'libraries/paypal-php-sdk/vendor/autoload.php';        

		$this->page_data['page']->title = 'nSmart - Registration';
	}

	public function index(){

        $get_data = $this->input->get();  

        $payment_status = "";

        /*if($get_data && isset($get_data['status'])) {
            $payment_status = $get_data['status'];
        }*/

        //Paypal subscription process after success - Start
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
                } catch (Exception $ex) {
                    echo "Failed to get activate";
                    var_dump($ex);
                    exit();
                }

                $agreement = \PayPal\Api\Agreement::get($agreement->getId(), $apiContext);
                $details = $agreement->getAgreementDetails();
                $payer = $agreement->getPayer();
                $payerInfo = $payer->getPayerInfo();
                $plan = $agreement->getPlan();
                $payment = $plan->getPaymentDefinitions()[0];
            }      

        }elseif( ($get_data && isset($get_data['status'])) && $get_data['status'] == 'cancel' ) {
            //Add cancel paypal here
        }
        //Paypal subscription process after success - End

		$ns_plans = $this->NsmartPlan_model->getAll();      

        $this->page_data['payment_status'] = $payment_status;
		$this->page_data['ns_plans'] = $ns_plans;
		$this->page_data['business'] = getIndustryBusiness();
		$this->page_data['roles']    = getRegistrationRoles();
		$this->load->view('registration', $this->page_data);
	}

    function subscribe(){

        postAllowed();
        $post = $this->input->post();  

        echo '<pre>';
        print_r($post);
        echo '</pre>';

        //exit;

        $data = [
            'first_name' => $post['firstname'],
            'last_name'  => $post['lastname'],
            'email_address' => $post['email'],
            'phone_number'  => $post['phone'],
            'business_name' => $post['business_name'],
            'business_address' => $post['business_address'],
            'number_of_employee' => $post['number_of_employee'],
            'industry' => $post['industry'],
            'password' => $post['password'],
            'date_created'  => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        ];

        $client = $this->Clients_model->create($data);

        $id = $this->users_model->create([
            'role' => 0,
            'FName' => $post['firstname'],
            'LName' => $post['lastname'],
            'username' => $post['email'],
            'email' => $post['email'],
            'company_id' => $client,
            'status' => 1,
            'password_plain' =>  $post['password'],
            'password' => hash( "sha256", $post['password'] ),
        ]);

        //Get subscription data
        $subscription_id    = $post['plan_id'];
        $subscription_name  = $post['plan_name'];
        $subscription_price = $post['plan_price'];
        $subscription_price_discounted = $post['plan_price_discounted'];
        $subscription_type  = $post['subscription_type'];

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
            $chargeModel->setType('SHIPPING')
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

            header("Location:" . $approvalUrl);

        /*
         *  Paypal Process Here - End
        */        
        
    }

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */