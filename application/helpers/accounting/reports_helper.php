<?php defined('BASEPATH') OR exit('No direct script access allowed');

function custom($col){
    if($col === "first_name, last_name"){
        $colName = "Customer";
    }elseif($col === 'email'){
        $colName = 'Email';
    }elseif($col == 'city, state, zip_code, cross_street, subdivision'){
        $colName = 'Address';
    }elseif($col === 'phone_h'){
        $colName = 'Phone';
    }elseif($col === 'status'){
        $colName = 'Status';
    }elseif($col === 'notes'){
        $colName = 'Notes';
    }elseif($col === 'bill_start_date'){
        $colName = 'Bill Start Date';
    }elseif($col === 'bill_end_date'){
        $colName = 'Bill End Date';
    }elseif($col === 'recurring_start_date'){
        $colName = 'Recurring Start Dtae';
    }elseif($col === 'recurring_end_date'){
        $colName = 'Recurring End Date';
    }elseif($col === 'last_payment_date'){
        $colName = 'Last Payment Date';
    }elseif($col === 'next_billing_date'){
        $colName = 'Next Billing Date';
    }

    return $colName;
}
if(!function_exists('filter')){
    function filter($cust, $stat, $type){
        if($stat != null && $cust == null && $type == null){
            return "`status` IN ('".$stat."')";
        }elseif($stat == null && $cust != null && $type == null){
            return "prof_id IN ('".$cust."')";
        }elseif($stat == null && $cust == null && $type != null){
            return "`customer_type` IN ('".$type."')";
        }
    }
}
if(!function_exists('customCols')){
    function customCols(){
        $customCols = array(
            array(
                'name' => 'Customer',
                'description' => 'first_name, last_name',
            ),array(
                'name' => 'Last Name',
                'description' => 'last_name',
            ),array(
                'name' => 'First Name',
                'description' => 'first_name',
            ),array(
                'name' => 'Address',
                'description' => 'city, state, zip_code, cross_street, subdivision',
            ),array(
                'name' => 'Phone Number',
                'description' => 'phone_h',
            ),array(
                'name' => 'Email',
                'description' => 'email',
            ),array(
                'name' => 'Status',
                'description' => 'status',
            ),array(
                'name' => 'Notes',
                'description' => 'notes',
            ),array(
                'name' => 'Billing Address',
                'description' => 'city, state, zip',
            ),array(
                'name' => 'Billing Start Date',
                'description' => 'bill_start_date',
            ),array(
                'name' => 'Billing End Date',
                'description' => 'bill_end_date',
            ),array(
                'name' => 'Recurring Start Date',
                'description' => 'recurring_start_date',
            ),array(
                'name' => 'Recurring End Date',
                'description' => 'recurring_end_date',
            ),array(
                'name' => 'Last Billing Date',
                'description' => 'last_payment_date',
            ),array(
                'name' => 'Next Billing Date',
                'description' => 'next_billing_date',
            ),
        );
        return $customCols;
    }

}

if(!function_exists('billPro')){
    function billPro($billPro){
        $array1 = array();
        foreach($billPro as $bp) :
            $trim = str_replace(' ','',$bp);
            if($trim == 'state' || $trim == 'city'){
                $city = 'acs_billing.'.$trim;
                array_push($array1, $city);
            }else{
                array_push($array1, $trim);
            }
        endforeach;
        return $array1;
    }
}

if(!function_exists('tblCustom')){
    function tblCustom($tblCustom){

    }
}