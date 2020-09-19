<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscription extends MY_Controller {
    
    public function  __construct(){
        parent::__construct();
        
        // Load Paypal SDK
        include APPPATH . 'libraries/paypal-php-sdk/vendor/autoload.php';

    }

    public function index() {
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
     
}

/* End of file Subscription.php */
/* Location: ./application/controllers/Subscription.php */