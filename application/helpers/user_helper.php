<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$this->CI->load->helper('date');

function validateUserAccessModule($module_id){
    $ci = &get_instance();
    $ci->load->library('session');

    $is_allowed = false;

    $allowed_modules = $ci->session->userdata('userAccessModules');
    if( in_array($module_id, $allowed_modules) ){
        $is_allowed = true;
    }
    
    return $is_allowed;
}
?>