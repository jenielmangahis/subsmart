<?php

/*Create link token*/
function linkTokenCreate($client_id, $client_secret, $client_user_id, $client_name, $return_url = '')
{   
    $is_valid = false;
    $token    = '';
    $err_msg  = '';

    if( $return_url == '' ){
        $return_url = PLAID_API_REDIRECT_URL;
    }

    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'client_name' => $client_name,
        'user' => ['client_user_id' => $client_user_id],
        'products' => ["auth","transactions"],
        'country_codes' => ["US"],
        'language' => 'en',
        'webhook' => PLAID_API_WEBHOOK_URL,
        'redirect_uri' => $return_url,

    ];

    $url = PLAID_API_URL . '/link/token/create';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    
    $response = curl_exec($ch);
    $data = json_decode($response);
    $link_token = $data->link_token;

    if( isset($data->error_type) ){
        $err_msg = $data->error_message;
    }else{
        $is_valid = true;
        $token = $data->link_token;
    }

    $return = ['is_valid' => $is_valid, 'err_msg' => $err_msg, 'token' => $token];
    return $return;
}

/*Create public token*/
function publicTokenCreate($client_id, $client_secret, $institution_id)
{   
    $is_valid = false;
    $token    = '';
    $err_msg  = '';

    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'institution_id' => $institution_id,
        'initial_products' => ["auth","transactions"],
        //'options' => []

    ];

    $url = PLAID_API_URL . '/sandbox/public_token/create';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    
    $response = curl_exec($ch);
    $data = json_decode($response);

    if( isset($data->error_type) ){
        $err_msg = $data->error_message;
    }else{
        $is_valid = true;
        $public_token = $data->public_token;
    }

    $return = ['is_valid' => $is_valid, 'err_msg' => $err_msg, 'public_token' => $public_token];
    return $return;
}

/*Retrieve bank account*/
function authGet($client_id, $client_secret, $access_token, $account_id)
{
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'access_token' => $access_token,
        'options' => ['account_ids' => [$account_id]]
    ];

    $url = PLAID_API_URL . '/auth/get';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Generate access token*/
function exchangeToken($client_id, $client_secret, $public_token)
{
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'public_token' => $public_token,
    ];

    $url = PLAID_API_URL . '/item/public_token/exchange';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Generate access token*/
function processorToken($client_id, $client_secret, $access_token, $account_id)
{
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'access_token' => $access_token,
        'account_id' => $account_id,
        'processor' => "achq"
    ];

    $url = PLAID_API_URL . '/processor/token/create';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Get processor auth account*/
function processorAuthGet($client_id, $client_secret, $processor_token){
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'processor_token' => $processor_token,        
    ];

    $url = PLAID_API_URL . '/processor/auth/get';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Get account  holder information*/
function identityGet($client_id, $client_secret, $access_token){
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'access_token' => $access_token,        
    ];

    $url = PLAID_API_URL . '/identity/get';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Get transactions*/
function transactionGet($client_id, $client_secret, $access_token, $start_date, $end_date, $account_id){
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'access_token' => $access_token,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'options' => ['account_ids' => [$account_id],'count' => 50, 'offset' => 0]    
    ];

    $url = PLAID_API_URL . '/transactions/get';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Get balance*/
function balanceGet($client_id, $client_secret, $access_token, $account_id){
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'access_token' => $access_token,
        'options' => ['account_ids' => [$account_id]]    
    ];

    $url = PLAID_API_URL . '/accounts/balance/get';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Get recurring transactions*/
function recurringTransactionsGet($client_id, $client_secret, $access_token, $account_id){
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'access_token' => $access_token,
        'account_ids' => [$account_id],
        'options' => ['include_personal_finance_category' => true]    
    ];

    $url = PLAID_API_URL . '/transactions/recurring/get';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Stripe bank token*/
function stripeBankAccountTokenCreate($client_id, $client_secret, $access_token, $account_id){
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'access_token' => $access_token,
        'account_id' => $account_id
    ];

    $url = PLAID_API_URL . '/processor/stripe/bank_account_token/create';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Processing Payment : Recipient List*/
function recipientList($client_id, $client_secret){
    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
    ];

    $url = PLAID_API_URL . '/payment_initiation/recipient/list';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}

/*Get Institution*/
function institutionGetById($institution_id, $client_id, $client_secret){
    $post = [
        'institution_id' => $institution_id,
        'client_id' => $client_id,
        'secret' => $client_secret,
        'country_codes' => ['US']
    ];

    $url = PLAID_API_URL . '/institutions/get_by_id';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

    $response = curl_exec($ch);
    $data = json_decode($response);

    return $data;
}