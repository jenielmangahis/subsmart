<?php

function generateToken($code_authorize)
{   
    $ci = get_instance();
    $ci->config->load('api_credentials');
    
    $post = [
        'client_id' => $ci->config->item('square_client_id'),
        'client_secret' => $ci->config->item('square_client_secret'),
        'code' => $code_authorize,
        'grant_type' => 'authorization_code',
        'redirect_uri' => $ci->config->item('square_redirect_uri')
    ];

    $url = $ci->config->item('square_connect_url') .'/oauth2/token';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Square-Version: 2023-09-25',
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    $response = curl_exec($ch);
    $data = json_decode($response);

    curl_close($ch);

    return $data;
}

function getMerchantDetails($access_token)
{
    $ci = get_instance();
    $ci->config->load('api_credentials');
    
    $url = $ci->config->item('square_connect_url') .'/v2/merchants';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Square-Version: 2023-09-25',
        'Authorization: Bearer '.$access_token,
        'Content-Type: application/json',
    ]);

    $response = curl_exec($ch);
    $data     = json_decode($response);

    curl_close($ch);

    if( isset($data->errors) ){
        $data = [
            'is_with_error' => 1,
            'msg' => $data->errors[0]->detail
        ];
        return $data;
    }else{
        if( isset($data->merchant[0]) ){
            $data = [
                'is_with_error' => 0,
                'msg' => '',
                'merchant' => $data->merchant[0]
            ];
            return $data;
        }else{
            return array();
        }
    }
}

function getConnectUrl()
{
    $ci = get_instance();
    $ci->config->load('api_credentials');
    
    $url = $ci->config->item('square_connect_url').'/oauth2/authorize?client_id='.$ci->config->item('square_client_id').'&scope=PAYMENTS_READ+PAYMENTS_WRITE+MERCHANT_PROFILE_READ&redirect_uri='.$ci->config->item('square_redirect_uri');
    return $url;
}

function accessTokenStatus($access_token)
{
    $ci = get_instance();
    $ci->config->load('api_credentials');
    
    $url = $ci->config->item('square_connect_url') .'/oauth2/token/status';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Square-Version: 2023-09-25',
        'Authorization: Bearer '.$access_token,
        'Content-Type: application/json',
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function revokeToken($access_token)
{
    $ci = get_instance();
    $ci->config->load('api_credentials');
    
    $post = [
        'access_token' => $access_token,
        'client_id' => $ci->config->item('square_client_id'),
        'revoke_only_access_token' => false
    ];

    $url = $ci->config->item('square_connect_url') .'/oauth2/revoke';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Square-Version: 2023-09-25',
        'Authorization: Client '.$ci->config->item('square_client_secret'),
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));    

    $response = curl_exec($ch);
    $data     = json_decode($response);
    curl_close($ch);

    return $data;
}

function createPayment($access_token)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://connect.squareupsandbox.com/v2/payments');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Square-Version: 2023-09-25',
        'Authorization: Bearer '.$access_token,
        'Content-Type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"source_id\": \"cnon:card-nonce-ok\",\n    \"accept_partial_authorization\": true,\n    \"amount_money\": {\n      \"amount\": 100,\n      \"currency\": \"USD\"\n    },\n    \"idempotency_key\": \"495f9d1d-f01f-41af-b62b-1b0560610fdb\"\n  }");

    $response = curl_exec($ch);

    curl_close($ch);
}