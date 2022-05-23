<?php defined('BASEPATH') OR exit('No direct script access allowed');

function paypal_credential($type = ""){
    $return = "";

    $client_id     = "Aez8D4HQA5lVwwkJ2Qw_48nnQgnS5A6HAh94VSHmJFQ6JU6hI8vuPDS0b-a-nNQ8g6WQyTP0etlyE-7z";
    $client_secret = "EAqn8WY2sWEzIaQ3R3DwCqgJv4eigbiKW_eMjW50GccL5_nVSUHZc49HQaQKUDdSHFhjydiOEARQYIQT";

    if($type == 'client_id') {
        $return = $client_id;
    }elseif($type == 'client_secret') {
        $return = $client_secret;
    }

    return $return;
}