<?php

/*Create public token*/
function linkTokenCreate($client_id, $client_secret, $client_user_id, $client_name)
{   
    $is_valid = false;
    $token    = '';
    $err_msg  = '';

    $post = [
        'client_id' => $client_id,
        'secret' => $client_secret,
        'client_name' => $client_name,
        'user' => ['client_user_id' => $client_user_id],
        'products' => ["auth"],
        'country_codes' => ["US"],
        'language' => 'en',
        'webhook' => PLAID_API_WEBHOOK_URL,
        'redirect_uri' => PLAID_API_REDIRECT_URL,

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