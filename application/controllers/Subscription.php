<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends MY_Controller {
    
    public function  __construct(){
        parent::__construct();
        
        // Load Paypal SDK
        include APPPATH . 'libraries/paypal-php-sdk/vendor/autoload.php';

    }

    public function test_subscription()
    {
    	$client_id     = "Aez8D4HQA5lVwwkJ2Qw_48nnQgnS5A6HAh94VSHmJFQ6JU6hI8vuPDS0b-a-nNQ8g6WQyTP0etlyE-7z"; 
        $client_secret = "EAqn8WY2sWEzIaQ3R3DwCqgJv4eigbiKW_eMjW50GccL5_nVSUHZc49HQaQKUDdSHFhjydiOEARQYIQT"; 

        $payment_success_url = "http://localhost/nguyen/subsmart/subscription/activate_plan";
        $payment_cancel_url  = "https://nsmartrac.com/payment_cancel";

        $datetime = new DateTime('2020-12-30 23:21:46');
        $subscription_date = $datetime->format(DateTime::ATOM);
        $plan_id = 'P-3SU40258FM212761AV56BOUI';


        //Add paypal client id & secret
        $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    $client_id,  
                    $client_secret
                )
        );

        $agreement = new \PayPal\Api\Agreement();
		$agreement->setName('Base Agreement')
		  ->setDescription('Basic Agreement')
		  ->setStartDate($subscription_date);

		// Set plan id
		$plan = new \PayPal\Api\Plan();
		$plan->setId($plan_id);
		$agreement->setPlan($plan);

		// Add payer type
		$payer = new \PayPal\Api\Payer();
		$payer->setPaymentMethod('paypal');
		$agreement->setPayer($payer);

		try {
		  // Create agreement
		  $agreement = $agreement->create($apiContext);

		  // Extract approval URL to redirect user
		  $approvalUrl = $agreement->getApprovalLink();
		  echo "<pre>";
		  print_r($agreement);
		  exit;
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
			echo 4;
		  echo "<pre>";
		  print_r($ex);
		  echo $ex->getCode();
		  echo $ex->getData();
		  die($ex);
		} catch (Exception $ex) {
			echo 6;
		  die($ex);
		}

		exit;

    }

    public function index2() {
        echo '<h2>Subscription Test</h2><hr />';

        $client_id     = "AY25WV2YZlLiW3h23bmArrKKcKFl9rwo7WpibqSz1UYbKac5oHx6BgzXOXDSlWO57H4eJ0NaKyVxBQ8R";
        $client_secret = "EIPYJtmSOBR0jiesGfIqxmG_nV9sWJB4ZHeiraZuRYOq9ryJIjrj4_7mSirslPT_azcpOW8ZZ7vbfJiw";

        $payment_success_url = "https://nsmartrac.com/payment_success";
        $payment_cancel_url  = "https://nsmartrac.com/payment_cancel";

        //Add paypal client id & secret
        $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    $client_id,  
                    $client_secret
                )
        );

        /*
         * To do: setup paypal subscription
        */

        //Setup paypal payment 
        
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal('1.00');
        $amount->setCurrency('USD');

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        //Add here success and cancel url link
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl($payment_success_url)
            ->setCancelUrl($payment_cancel_url);

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);


        // After Step 3
        try {
            $payment->create($apiContext);

            /*echo $payment;
            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";*/
            
            header("Location: " . $payment->getApprovalLink());
        }
        catch (\PayPal\Exception\PayPalConnectionException $ex) {

            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }            

    }

    public function create_payment() {
    	$client_id     = "Aez8D4HQA5lVwwkJ2Qw_48nnQgnS5A6HAh94VSHmJFQ6JU6hI8vuPDS0b-a-nNQ8g6WQyTP0etlyE-7z"; 
        $client_secret = "EAqn8WY2sWEzIaQ3R3DwCqgJv4eigbiKW_eMjW50GccL5_nVSUHZc49HQaQKUDdSHFhjydiOEARQYIQT"; 

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
		        $agreement->execute($token, $apiContext);
		        echo "success";
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
		    echo "end";
		}      

    }

    public function create_plan() {

    	echo '<h2>Subscription Test</h2><hr />';

        $client_id     = "Aez8D4HQA5lVwwkJ2Qw_48nnQgnS5A6HAh94VSHmJFQ6JU6hI8vuPDS0b-a-nNQ8g6WQyTP0etlyE-7z"; 
        $client_secret = "EAqn8WY2sWEzIaQ3R3DwCqgJv4eigbiKW_eMjW50GccL5_nVSUHZc49HQaQKUDdSHFhjydiOEARQYIQT"; 

        //$payment_success_url = base_url().'registration?status=success'; //"https://nsmartrac.com/payment_success";
        $payment_success_url = "http://localhost/nguyen/subsmart/subscription/activate_plan";
        $payment_cancel_url  = "https://nsmartrac.com/payment_cancel";

        //Add paypal client id & secret
        $apiContext = new \PayPal\Rest\ApiContext(
                new \PayPal\Auth\OAuthTokenCredential(
                    $client_id,  
                    $client_secret
                )
        );


    	// Create a new billing plan
		$plan = new \PayPal\Api\Plan();
		$plan->setName('T-Shirt of the Month Club Plan')
		  ->setDescription('Template creation.')
		  ->setType('fixed');

		// Set billing plan definitions
		$paymentDefinition = new \PayPal\Api\PaymentDefinition();
		$paymentDefinition->setName('Regular Payments')
		  ->setType('REGULAR')
		  ->setFrequency('Month')
		  ->setFrequencyInterval('2')
		  ->setCycles('12')
		  ->setAmount(new \PayPal\Api\Currency(array('value' => 100, 'currency' => 'USD')));

		// Set charge models
		$chargeModel = new \PayPal\Api\ChargeModel();
		$chargeModel->setType('SHIPPING')
		  ->setAmount(new \PayPal\Api\Currency(array('value' => 10, 'currency' => 'USD')));
		$paymentDefinition->setChargeModels(array($chargeModel));

		// Set merchant preferences
		$merchantPreferences = new \PayPal\Api\MerchantPreferences();
		$merchantPreferences->setReturnUrl('http://localhost/subsmart/subscription/index')
		  ->setCancelUrl('http://localhost:3000/cancel')
		  ->setAutoBillAmount('yes')
		  ->setInitialFailAmountAction('CONTINUE')
		  ->setMaxFailAttempts('0')
		  ->setSetupFee(new \PayPal\Api\Currency(array('value' => 1, 'currency' => 'USD')));

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

		    // Output plan id
		    echo $plan->getId();
		  } catch (PayPal\Exception\PayPalConnectionException $ex) {
		    echo $ex->getCode();
		    echo $ex->getData();
		    die($ex);
		  } catch (Exception $ex) {
		    die($ex);
		  }
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
		  echo $ex->getCode();
		  echo $ex->getData();
		  die($ex);
		} catch (Exception $ex) {
		  die($ex);
		}
	}

	public function activate_plan(){
		if (!empty($_GET['success'])) {
		    $token = $_GET['token'];
		    $agreement = new \PayPal\Api\Agreement();

		    try {
		        $agreement->execute($token, $apiContext);
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
	}

	public function subscribe(){
		$client_id     = "Aez8D4HQA5lVwwkJ2Qw_48nnQgnS5A6HAh94VSHmJFQ6JU6hI8vuPDS0b-a-nNQ8g6WQyTP0etlyE-7z"; 
	    $client_secret = "EAqn8WY2sWEzIaQ3R3DwCqgJv4eigbiKW_eMjW50GccL5_nVSUHZc49HQaQKUDdSHFhjydiOEARQYIQT"; 

	    //Add paypal client id & secret
	    $apiContext = new \PayPal\Rest\ApiContext(
	            new \PayPal\Auth\OAuthTokenCredential(
	                $client_id,  
	                $client_secret
	            )
	    );

	    // Create a new billing plan
		$plan = new \PayPal\Api\Plan();
		$plan->setName('T-Shirt of the Month Club Plan')
		  ->setDescription('Template creation.')
		  ->setType('fixed');

		// Set billing plan definitions
		$paymentDefinition = new \PayPal\Api\PaymentDefinition();
		$paymentDefinition->setName('Regular Payments')
		  ->setType('REGULAR')
		  ->setFrequency('Month')
		  ->setFrequencyInterval('2')
		  ->setCycles('12')
		  ->setAmount(new \PayPal\Api\Currency(array('value' => 100, 'currency' => 'USD')));

		// Set charge models
		$chargeModel = new \PayPal\Api\ChargeModel();
		$chargeModel->setType('SHIPPING')
		  ->setAmount(new \PayPal\Api\Currency(array('value' => 10, 'currency' => 'USD')));
		$paymentDefinition->setChargeModels(array($chargeModel));

		// Set merchant preferences
		$return_url = 'http://localhost/nguyen/nsmartrac_web/subscription/create_payment';
		$cancel_url = 'http://localhost/nguyen/nsmartrac_web/subscription/cancel_subscription';
		$merchantPreferences = new \PayPal\Api\MerchantPreferences();
		$merchantPreferences->setReturnUrl($return_url)
		  ->setCancelUrl($cancel_url)
		  ->setAutoBillAmount('yes')
		  ->setInitialFailAmountAction('CONTINUE')
		  ->setMaxFailAttempts('0')
		  ->setSetupFee(new \PayPal\Api\Currency(array('value' => 1, 'currency' => 'USD')));

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

		//set agreement
		//$datetime = new DateTime('2020-12-30 23:21:46');
	    //$subscription_date = $datetime->format(DateTime::ATOM);

        $datetime = new DateTime( date('Y-m-d H:i:s', strtotime("+1 day")) );
        $subscription_date = $datetime->format(DateTime::ATOM);	 

		//$date = date('Y-m-d H:i:s', strtotime("+1 day"));           

		//$agreement = new Agreement();
		$agreement = new \PayPal\Api\Agreement();

		$agreement->setName('Base Agreement')
		    ->setDescription('Basic Agreement')
		    ->setStartDate($subscription_date);

		//$plan = new Plan();
		$plan = new \PayPal\Api\Plan();

		$plan->setId($plan_id);
		$agreement->setPlan($plan);

		//$payer = new Payer();
		$payer = new \PayPal\Api\Payer();

		$payer->setPaymentMethod('paypal');
		$agreement->setPayer($payer);

		try {
		    $agreement = $agreement->create($apiContext);

		    $approvalUrl = $agreement->getApprovalLink();

		} catch (Exception $ex) {
		    echo "Failed to get activate";
		    echo '<pre>';
		    var_dump($ex);
		    echo '</pre>';
		    exit();
		}

		header("Location:" . $approvalUrl);
	}
     
}

/* End of file Subscription.php */
/* Location: ./application/controllers/Subscription.php */