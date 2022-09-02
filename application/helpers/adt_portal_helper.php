<?php
function portalValidateLogin($username, $password)
{   
    $is_valid = 0;
    $msg = 'Invalid account';
    $portal_username = '';

    $post = [
        'portal_username' => $username,
        'portal_password' => $password,
    ];

    $url = 'https://portal.urpowerpro.com/api/v1/user/validate_login';
    $ch = curl_init();        
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);            
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
    
    $response = curl_exec($ch);
    $data     = json_decode($response);

    if( $data->is_success == 1 ){
        $is_valid = 1;
        $portal_username = $data->portal_username;
        $msg = '';
    }

    $result = ['is_valid' => $is_valid, 'msg' => $msg, 'portal_username' => $portal_username];
    return $result;

}