<?php defined('BASEPATH') OR exit('No direct script access allowed');

function custom($col){
    if($col === "first_name, last_name"){
        $colName = "Customer";
    }

    return $colName;
}