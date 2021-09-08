<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

class Stripe {

    public function __construct()
    {

    }

    public function check_user_token($code)
    {
        \Stripe\Stripe::setApiKey('sk_test_51JX2xkGRdNchmJyrLQtU7SgGPRRLzH8NH75qiafa9g5ktUE4XCU6NEAimvJxBhuP2wB7vbY3w9JR3eDDw3IRuR2w00ertYgUmM');

        $response = \Stripe\OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $code,
        ]);

        //Access the connected account id in the response
        print_r($response);
    }
}