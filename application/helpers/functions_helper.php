<?php defined('BASEPATH') OR exit('No direct script access allowed');
//$this->CI->load->helper('date');

function prefix_name($index=0){
    $name_prefix = array('','Captain', 'Cnl.', 'Colonel', 'Dr.', 'Gen.', 'Judge','Lady','Lieutenant','Lord','Lt.','Madam','Major','Master','Miss','Mister','Mr.','Maj.','Mrs.','Ms.','Pastor','Private','Prof.','Pvt.','Rev.','Sergeant','Sgt','Sir');
    if($index<0 || $index>=count($name_prefix)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $name_prefix[$index];
}

function suffix_name($index=0){
    $name_suffix = array('','DS','Esq.', 'II', 'III','IV.','Jr.','MA','MBA','MD','MS','PhD','RN','Sr.');
    if($index<0 || $index>=count($name_suffix)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $name_suffix[$index];
}

function mmr($index=0){
    $mmrate = array('0.00','20.00','24.99', 'II', 'III','IV.','Jr.','MA','MBA','MD','MS','PhD','RN','Sr.');
    if($index<0 || $index>=count($mmrate)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $mmrate[$index];
}

function days_of_month($index=0){
    $days = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');
    if($index<0 || $index>=count($days)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $days[$index];
}

function string_max_length($string, $max_length) {
    if (!is_string($string)) {
       return "";
    }
    if (!is_int($max_length) || $max_length < 3) {
        $max_length = 50;
    }
    if (strlen($string) > $max_length) {
        return mb_strimwidth($string, 0, $max_length - 2, '...');
    } else {
        return $string;
    }
}

function time_selector($index=0){

}

function time_availability($index=0,$count=FALSE){
    $time = array('5:00 am','5:30 am','6:00 am', '6:30 am', '7:00 am','7:30 am','8:00 am','8:30 am','9:00 am','9:30 am','10:00 am','10:30 am','11:00 am','11:30 am','12:00 pm','12:30 pm','1:00 pm','1:30 pm','2:00 pm','2:30 pm','3:00 pm','3:30 pm','4:00 pm','4:30 pm');
    if($index<0 || $index>=count($time)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }

    if($count){
        return count($time);
    }
    return $time[$index];
}

function event_status($index=0){
    $time = array('Draft','Scheduled','On My Way','Started','Finished','Convert To Job');
    return $time[$index];
}

if (!function_exists('get_employee_name')){
    function get_employee_name($id=null){
        $CI = &get_instance();
        $CI->load->model('General_model', 'general');
        $get_employee = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
        return $CI->general->get_data_with_param($get_employee,FALSE);
    }
}

if (!function_exists('get_tech_revenue')){
    function get_tech_revenue($id){
        $CI = &get_instance();
        $CI->load->model('event_model');
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
        
        if(logged('company_id') == 58){
            return $CI->event_model->getTechRevenueSolar($id);
        }else{
            return $CI->event_model->getTechRevenue($id);
        }
    }
}

if (!function_exists('get_sales_rep_revenue')){
    function get_sales_rep_revenue($id){
        $CI = &get_instance();
        $CI->load->model('event_model');
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
        if(logged('company_id') == 58){
            return $CI->event_model->getSalesRepRevenueSolar($id);
        }else{
            return $CI->event_model->getSalesRepRevenue($id);
        }
    }
}

if (!function_exists('get_sales_rep_name')){
    function get_sales_rep_name($id){
        $CI = &get_instance();
        $CI->load->model('users_model');
        $user = $CI->users_model->getUserByID($id);
        return $user->FName . ' '. $user->LName;
    }
}

if (!function_exists('get_customer_count_widget')){
    function get_customer_count_widget($id,$field){
        $CI = &get_instance();
        $CI->load->model('event_model');
        return $CI->event_model->getCustomerCountPerId($id,$field);
    }
}

if (!function_exists('get_total_item_qty')){
    function get_total_item_qty($id=null){
        $CI = &get_instance();
        $CI->load->model('General_model', 'general');
        $get_item_qty_total = array(
            'where' => array(
                'item_id' => $id
            ),
            'group_by' => 'item_id',
            'table' => 'items_has_storage_loc',
            'select' => 'SUM(qty) as total_qty',
        );
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
        return $CI->general->get_column_sum($get_item_qty_total);
    }
}
if (!function_exists('bill_methods')){
    function bill_methods($name=null){
        $bill_methods = array(
            array(
                'name' => 'CC',
                'description' => 'Credit Card',
            ),array(
                'name' => 'DC',
                'description' => 'Debit Card',
            ),array(
                'name' => 'CHECK',
                'description' => 'CHECK',
            ),array(
                'name' => 'CASH',
                'description' => 'CASH',
            ),array(
                'name' => 'ACH',
                'description' => 'ACH',
            ),array(
                'name' => 'VENMO',
                'description' => 'VENMO',
            ),array(
                'name' => 'PP',
                'description' => 'Paypal',
            ),array(
                'name' => 'SQ',
                'description' => 'Square',
            ),array(
                'name' => 'WW',
                'description' => 'Warranty Work',
            ),array(
                'name' => 'HOF',
                'description' => 'Home Owner Financing',
            ),array(
                'name' => 'eT',
                'description' => 'e-Transfer',
            ),array(
                'name' => 'OCCP',
                'description' => 'Other Credit Card Processor',
            ),array(
                'name' => 'OPT',
                'description' => 'Other Payment Type',
            ),
        );
        if(isset($name)){
            for($x=0;$x<count($bill_methods);$x++){
                if($bill_methods[$x]['name'] == $name){
                    return $bill_methods[$x];
                }
            }
        }
        return $bill_methods;
    }
}

if (!function_exists('pay_history')){
    function pay_history($id=null){
        $status = array('','Excellent','Good','Fair','Poor','Very Poor');
        if($id==null){
            $id=1;
        }
        return $status[$id];
    }
}

if (!function_exists('transaction_categories')){
    function transaction_categories($name=null){
        $categories = array(
            array(
                'name' => 'E',
                'description' => 'Equipment',
            ),array(
                'name' => 'MMR',
                'description' => 'Monthly Monitoring',
            ),array(
                'name' => 'RMR',
                'description' => 'RMR',
            ),array(
                'name' => 'MS',
                'description' => 'Monthly Subscription',
            ),array(
                'name' => 'AF',
                'description' => 'Activation Fee',
            ),array(
                'name' => 'FM',
                'description' => 'First Month',
            ),array(
                'name' => 'AFM',
                'description' => 'Activation + First Month',
            ),array(
                'name' => 'D',
                'description' => 'Deposit',
            ),array(
                'name' => 'O',
                'description' => 'Other',
            )
        );
        if(isset($name)){
            for($x=0;$x<count($categories);$x++){
                if($categories[$x]['name'] == $name){
                    return $categories[$x];
                }
            }
        }
        return $categories;
    }
}

function solar_info_header($name=null) {
    $solar_info = array(
        array(
            'id' => 'project_id',
            'description' => 'Project Id',
        ),array(
            'name' => 'lender_type',
            'description' => 'Lender Type',
        ),array(
            'name' => 'proposed_system_size',
            'description' => 'Proposed System Size',
        ),array(
            'name' => 'proposed_modules',
            'description' => 'Proposed Modules',
        ),array(
            'name' => 'proposed_inverter',
            'description' => 'Proposed Inverter',
        ),array(
            'name' => 'proposed_offset',
            'description' => 'Proposed Offset',
        ),array(
            'name' => 'proposed_solar',
            'description' => 'Proposed Solar',
        ),array(
            'name' => 'proposed_utility',
            'description' => 'Proposed Utility',
        ),array(
            'name' => 'proposed_payment',
            'description' => 'Proposed Payment',
        ),array(
            'name' => 'annual_income',
            'description' => 'Annual Income',
        ),array(
            'name' => 'tree_estimate',
            'description' => 'Tree Estimate',
        ),array(
            'name' => 'roof_estimate',
            'description' => 'Roof Estimate',
        ),array(
            'name' => 'utility_account',
            'description' => 'Utility Account',
        ),array(
            'name' => 'utility_login',
            'description' => 'Utility Login',
        ),array(
            'name' => 'utility_pass',
            'description' => 'Utility Pass',
        ),array(
            'name' => 'meter_number',
            'description' => 'Meter Number',
        ),array(
            'name' => 'insurance_name',
            'description' => 'Insurance Name',
        ),array(
            'name' => 'insurance_number',
            'description' => 'Insurance Number',
        ),array(
            'name' => 'policy_number',
            'description' => 'Policy Number',
        )
    );
    if(isset($name)){
        for($x=0;$x<count($solar_info);$x++){
            if($solar_info[$x]['name'] == $name){
                return $solar_info[$x];
            }
        }
    }
    return $solar_info;
}


function alarm_info_header($name=null) {
    $alarm_fields = array(
        array(
            'id' => 'monitor_comp',
            'description' => 'Monitoring Company',
        ),array(
            'name' => 'monitor_id',
            'description' => 'Monitoring ID',
        ),array(
            'name' => 'acct_type',
            'description' => 'Account Type',
        ),array(
            'name' => 'online',
            'description' => 'Online',
        ),array(
            'name' => 'in_service',
            'description' => 'In Service',
        ),array(
            'name' => 'equipment',
            'description' => 'Equipment',
        ),array(
            'name' => 'mcn',
            'description' => 'Monitoring Confirm#',
        ),array(
            'name' => 'scn',
            'description' => 'Signal Confirm#',
        ),array(
            'name' => 'install_code',
            'description' => 'Installer Code',
        ),array(
            'name' => 'panel_type',
            'description' => 'Panel Type',
        ),array(
            'name' => 'warranty_type',
            'description' => 'Warranty Type',
        ),array(
            'name' => 'dealer',
            'description' => 'Dealer',
        ),array(
            'name' => 'alarm_login',
            'description' => 'Login',
        ),array(
            'name' => 'alarm_customer_id',
            'description' => 'Customer ID',
        ),array(
            'name' => 'alarm_cs_account',
            'description' => 'CS Account',
        )
    );
    if(isset($name)){
        for($x=0;$x<count($alarm_fields);$x++){
            if($alarm_fields[$x]['name'] == $name){
                return $alarm_fields[$x];
            }
        }
    }
    return $alarm_fields;
}

function addJSONResponseHeader() {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Content-Type: application/json");
}

function csvHeaderToMap($start , $end){
    $headers = array (
        'Status',
        'Customer Type',
        'Customer Group',
        'Sales Area',
        'First Name',
        'Last Name',
        'Address',
        'City',
        'State',
        'Zip Code',
        'County',
        'Social Security Number',
        'Date Of Birth',
        'Email',
        'Phone (H)',
        'Phone (M)', // customer information end here
        'Equipment',
        'Initial Dep',
        'Rate Plan',                                                                                                                                                                            
        'Billing Frequency',
        'Contract Term',
        'Billing Start Date',
        'Billing End Date',
        'Billing Day of Month',
        'Billing Method',
        'Subscription Pay',
        'Credit Card Number', // billing info ends here
        'Entered By',
        'Time Entered',
        'Sales Date',
        'Credit Score',
        'Pay History',
        'Sales Rep',
        'Technician',
        'Install Date',
        'Lead Source',
        'Verification',
        'Language',
        'System Package Type', // office info ends here
        'Monitoring Company',
        'Monitoring ID',
        'Online',
        'In Service',
        'Equipment',
        'Abort Code',
        'Installer Code',
        'Monitoring Confirm #',
        'Signal Confirm#',
        'Panel Type',
        'Warranty Type',
        'Communication Type', // alarm info ends here
        'Contact Name 1',
        'Relationship 1',
        'Phone Number 1',
        'Contact Name 2',
        'Relationship 2',
        'Phone Number 2',
        'Contact Name 3',
        'Relationship 3',
        'Phone Number 3',
    );
    return array_slice($headers, $start, $end);
}	

if (!function_exists('getOfficeId')){
    function getOfficeId($name){
        $CI = &get_instance();
        $CI->load->model('users_model');

        $tech = explode(' ', $name);

        $user = $CI->users_model->getByOfficeId($tech[0], $tech[1]);
        return $user->id;
    }
}

if (!function_exists('getUser')){
    function getUser($id){
        $CI = &get_instance();
        $CI->load->model('users_model');

        $user = $CI->users_model->get_user_name($id);
        return $user->FName." ".$user->LName;
    }
}	
if (!function_exists('getDataByHeader')){
    function getDataByHeader($arr){
        $CI = &get_instance();
        $CI->load->model('users_model');

        $user = $CI->users_model->get_user_name($arr);
        return $user->FName." ".$user->LName;
    }
}
if (!function_exists('getCustomerName')){
    function getCustomerName($id){
        $CI = &get_instance();
        $CI->load->model('users_model');

        $user = $CI->users_model->get_user_name($id);
        return $user->FName." ".$user->LName;
    }
}									
?>