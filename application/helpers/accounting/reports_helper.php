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
                'description' => 'customer',
                'name_in' => 'customer'
            ),array(
                'name' => 'Last Name',
                'description' => 'acs_profile.last_name',
                'name_in' => 'customer'
            ),array(
                'name' => 'First Name',
                'description' => 'acs_profile.first_name',
                'name_in' => 'customer'
            ),array(
                'name' => 'Address',
                'description' => 'acs_profile.mail_add',
                'name_in' => 'customer'
            ),array(
                'name' => 'Phone Number',
                'description' => 'acs_profile.phone_h',
                'name_in' => 'customer'
            ),array(
                'name' => 'Email',
                'description' => 'acs_profile.email',
                'name_in' => 'customer'
            ),array(
                'name' => 'Status',
                'description' => 'acs_profile.status',
                'name_in' => 'customer'
            ),array(
                'name' => 'Notes',
                'description' => 'acs_profile.notes',
                'name_in' => 'customer'
            ),array(
                'name' => 'Billing Address',
                'description' => 'acs_billing.card_address',
                'name_in' => 'billing'
            ),array(
                'name' => 'Billing Start Date',
                'description' => 'acs_billing.bill_start_date',
                'name_in' => 'billing'
            ),array(
                'name' => 'Billing End Date',
                'description' => 'acs_billing.bill_end_date',
                'name_in' => 'billing'
            ),array(
                'name' => 'Recurring Start Date',
                'description' => 'acs_billing.recurring_start_date',
                'name_in' => 'billing'
            ),array(
                'name' => 'Recurring End Date',
                'description' => 'acs_billing.recurring_end_date',
                'name_in' => 'billing'
            ),array(
                'name' => 'Last Billing Date',
                'description' => 'acs_billing.last_payment_date',
                'name_in' => 'billing'
            ),array(
                'name' => 'Next Billing Date',
                'description' => 'acs_billing.next_billing_date',
                'name_in' => 'billing'
            ),
        );
        return $customCols;
    }

}
if(!function_exists('estimateCols')){
    function estimateCols(){
        $estimateCols = array(
            array(
                'name' => 'AMOUNT',
                'description' => 'estimates.grand_total',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'ACCEPTED DATE',
                'description' => 'estimates.accepted_date',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'BILLING ADDRESS',
                'description' => 'estimates.billing_address',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'CREATED BY',
                'description' => 'estimates.estimate_number',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'CUSTOMER MESSAGE',
                'description' => 'estimates.customer_message',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'DATE',
                'description' => 'estimates.estimate_date',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'EMAIL',
                'description' => 'acs_profile.email',
                'name_in' => 'customer'
            ),
            array(
                'name' => 'EXPIRATION DATE',
                'description' => 'estimates.expiry_date',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'INVOICE #',
                'description' => 'estimates.status',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'LAST MODIFIED',
                'description' => 'estimates.updated_at',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'NAME',
                'description' => 'acs_profile.first_name',
                'name_in' => 'customer'
            ),
            array(
                'name' => 'NUM',
                'description' => 'estimates.estimate_number',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'PHONE NUMBER',
                'description' => 'acs_profile.phone_h',
                'name_in' => 'customer'
            ),
            array(
                'name' => 'SHIP DATE',
                'description' => 'estimates.hip_date',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'SHIP VIA',
                'description' => 'estimates.ship_via',
                'name_in' => 'estimate'

            ),
            array(
                'name' => 'SHIPPING ADDRESS',
                'description' => 'estimates.billing_address',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'TAX AMOUNT',
                'description' => 'estimates.tax1_total',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'TRANSACTION TYPE',
                'description' => 'estimates.estimate_type',
                'name_in' => 'estimate'
            ),
        );
        return $estimateCols;
    }

}

if(!function_exists('estimateInvoice')){
    function estimateInvoice(){
        $estimateCols = array(
            array(
                'name' => 'NUM',
                'description' => 'estimates.estimate_number',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'STATUS',
                'description' => 'estimates.status',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'AMOUNT',
                'description' => 'estimates.grand_total',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'ACCEPTED DATE',
                'description' => 'estimates.accepted_date',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'EXPIRATION DATE',
                'description' => 'estimates.expiry_date',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'BALANCE',
                'description' => 'invoices.balance',
                'name_in' => 'invoice'
            ),
            array(
                'name' => 'INVOICED AMOUNT',
                'description' => 'invoices.invoice_totals',
                'name_in' => 'invoice'
            ),
            array(
                'name' => '% AMOUNT',
                'description' => 'estimates.grand_total',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'REMAINING AMOUNT',
                'description' => 'estimates.grand_total',
                'name_in' => 'estimate'
            ),
            array(
                'name' => 'MEMO',
                'description' => 'estimates.customer_message',
                'name_in' => 'estimate'
            ),
        );

        return $estimateCols;
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

if(!function_exists('selectCustomerEstimate')){
    function selectCustomerEstimate($key, $table){
        $data_arr = array();
        foreach($key as $k) :
            if($table == 'customer'){
                $field = 'acs_profile.'.$k;
                array_push($data_arr, $field);
            }else{
                $field = 'estimates.'.$k;
                array_push($data_arr, $field);
            }
        endforeach;
        return $data_arr;
    }
}

