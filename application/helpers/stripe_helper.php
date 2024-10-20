<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

class Stripe {

    public function __construct()
    {

    }

    function check_user_token($code)
    {
        \Stripe\Stripe::setApiKey('sk_test_51JX2xkGRdNchmJyrLQtU7SgGPRRLzH8NH75qiafa9g5ktUE4XCU6NEAimvJxBhuP2wB7vbY3w9JR3eDDw3IRuR2w00ertYgUmM');

        $response = \Stripe\OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $code,
        ]);

        //Access the connected account id in the response
        print_r($response);
    }

    function validateCardDetails($card_details)
    {
        $tokenKey = 'pk_live_51JzxZ0BffKnivrEfPgDmBaGsGTRX9pW75EtMDl4Nw5MJJvbBkPo6yfpZjpQ0Q6WBBmee2iIFAyfMqWksLIvwQiKB00pWAkB9od';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/tokens");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]={$card_details['card_number']}&card[exp_month]={$card_details['card_month']}&card[exp_year]={$card_details['card_year']}&card[cvc]={$card_details['card_cvc']}");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $tokenKey . ":");

        $response = json_decode(curl_exec($ch),true);

        if( isset($response['error']) ){
            $return = [
                'is_valid' => false,
                'error_mesasge' => $response['error']['message']
            ];
        }else{
            $return = [
                'is_valid' => true,
                'error_mesasge' => '',
                'card' => $response['card']
            ];
        }

        return $return;
    }
}