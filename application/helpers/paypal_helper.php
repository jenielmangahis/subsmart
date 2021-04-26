<?php defined('BASEPATH') OR exit('No direct script access allowed');

function paypal_credential($type = ""){
    $return = "";

    $client_id     = "AbhNwKUnlEE3b1mikrpZ5ITkyF41KQId9UmlIAy5Mo_MTqRPhoLVWk5QSn_Jjw2NdkNbm0WoKYrOGkY7";
    $client_secret = "EDohbd_-p_O15FFpDEUxZVRVkG_xTIWfncBBVYoKIbD6MPhSkXqz46rm92emzZK8ZEnHkmQymjwLdI1H";

    if($type == 'client_id') {
        $return = $client_id;
    }elseif($type == 'client_secret') {
        $return = $client_secret;
    }

    return $return;
}