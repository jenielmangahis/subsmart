<?php


/**
 * Function to create custom url
 * uses site_url() function
 *
 * @param string $url any slug
 *
 * @return string site_url
 *

 */

if (!function_exists('url')) {


    function url($url = '')

    {

        return site_url($url);
    }
}


/**
 * Function to get url of assets folder
 *
 * @param string $url any slug
 *
 * @return string url
 *

 */

if (!function_exists('assets_url')) {


    function assets_url($url = '')

    {

        return base_url('assets/' . $url);
    }
}


/**
 * Function to get url of upload folder
 *
 * @param string $url any slug
 *
 * @return string url
 *

 */

if (!function_exists('urlUpload')) {


    function urlUpload($url = '', $time = false)

    {

        return base_url('uploads/' . $url) . ($time ? '?' . time() : '');
    }
}


/**
 * Function for user profile url
 *
 * @param string $id - user id of the user
 *
 * @return string profile url
 *

 */

if (!function_exists('userProfile')) {

    function userProfile($id)
    {
        $CI = &get_instance();
        $url = urlUpload('users/' . $id . '.png?' . time());

        if ($id != 'default')
            $url = urlUpload('users/' . $id . '.' . $CI->users_model->getRowById($id, 'profile_img') . '?' . time());
        // $url = 'http://nsmartrac.com/uploads/users/'.$id.'.'.$CI->users_model->getRowById($id, 'img_type').'?'.time();

        return $url;
    }
}


if (!function_exists('userProfileImage')) {

    function userProfileImage($id)
    {

        $CI = &get_instance();
        $url = urlUpload('users/user-profile/p_' . $id . '.png?' . time());

        if ($id != 'default')
            $url = urlUpload('users/user-profile/p_' . $id . '.' . $CI->users_model->getRowById($id, 'img_type') . '?' . time());

        return $url;
    }
}

if (!function_exists('companyProfileImage')) {

    function companyProfileImage($id)
    {

        $CI = &get_instance();
        $url = urlUpload('users/' . $id . '.png?' . time());

        // $res= $CI->business_model->getRowByWhere(['user_id'=>$id], ['b_image']);
        // echo "<pre>fhdfhdfh"; print_r($res); die;

        if ($id != 'default')
            $url = urlUpload('users/businessimg_' . $CI->business_model->getRowByWhere(['id' => $id], 'user_id') . '.' . $CI->business_model->getRowByWhere(['id' => $id], 'b_image') . '?' . time());

        return $url;
    }
}


/**
 * Function to check and get 'post' request
 *
 * @param string $key - key to check in 'post' request
 *
 * @return string value - uses codeigniter Input library
 *

 */

if (!function_exists('post')) {


    function post($key)

    {

        $CI = &get_instance();

        return !empty($CI->input->post($key, true)) ? $CI->input->post($key, true) : false;
    }
}


/**
 * Function to check and get 'get' request
 *
 * @param string $key - key to check in 'get' request
 *
 * @return string value - uses codeigniter Input library
 *

 */

if (!function_exists('get')) {


    function get($key)

    {

        $CI = &get_instance();

        return !empty($CI->input->get($key, true)) ? $CI->input->get($key, true) : false;
    }
}


/**
 * Die/Stops the request if its not a 'post' request type
 *
 * @return boolean
 *

 */

if (!function_exists('postAllowed')) {


    function postAllowed()

    {

        $CI = &get_instance();

        if (count($CI->input->post()) <= 0)

            die('Invalid Request');


        return true;
    }
}


/**
 * Function to dump the passed data
 * Die & Dumps the whole data passed
 *
 * uses - var_dump & die together
 *
 * @param all $key - All Accepted - string,int,boolean,etc
 *
 * @return boolean
 *

 */

if (!function_exists('dd')) {


    function dd($key)

    {

        die(var_dump($key));

        return true;
    }
}


/**
 * Function to check if the user is loggedIn
 *
 * @return boolean
 *

 */

if (!function_exists('is_logged')) {


    function is_logged()

    {

        $CI = &get_instance();


        $login_token_match = false;


        $isLogged = !empty($CI->session->userdata('login')) && !empty($CI->session->userdata('logged')) ? (object)$CI->session->userdata('logged') : false;

        $_token = $isLogged && !empty($CI->session->userdata('login_token')) ? $CI->session->userdata('login_token') : false;


        if (!$isLogged) {

            $isLogged = get_cookie('login') && !empty(get_cookie('logged')) ? json_decode(get_cookie('logged')) : false;

            $_token = $isLogged && !empty(get_cookie('login_token')) ? get_cookie('login_token') : false;
        }


        if ($isLogged) {

            $user = $CI->users_model->getById($CI->db->escape((int)$isLogged->id));

            // verify login_token

            $login_token_match = (sha1($user->id . $user->password . $isLogged->time) == $_token);
        }


        return $isLogged && $login_token_match;
    }
}


/**
 * Function that returns the data of loggedIn user
 *
 * @param string $key Any key/Column name that exists in users table
 *
 * @return boolean
 *

 */

if (!function_exists('logged')) {


    function logged($key = false)

    {

        $CI = &get_instance();


        if (!is_logged())

            return false;


        $logged = !empty($CI->session->userdata('login')) ? $CI->users_model->getById($CI->session->userdata('logged')['id']) : false;


        if (!$logged) {

            $logged = $CI->users_model->getById(json_decode(get_cookie('logged'))->id);
        }

        //print_r($logged);die;

        return (!$key) ? $logged : $logged->{$key};
    }
}


/**
 * Returns Path of view
 *
 * @param string $path - path/file info
 *
 * @return boolean
 *

 */

if (!function_exists('viewPath')) {


    function viewPath($path)

    {

        return VIEWPATH . '/' . $path . '.php';
    }
}


/**
 * Returns Path of view
 *
 * @param string $date any format
 *
 * @return string date format Y-m-d that most mysql db supports
 *

 */

if (!function_exists('DateFormatDb')) {


    function DateFormatDb($date)

    {

        return date('Y-m-d', strtotime($date));
    }
}


/**
 * Currency formatting
 *
 * @param int/float/string $amount
 *
 * @return string $amount formatted amount with currency symbol
 *

 */

if (!function_exists('currency')) {


    function currency($amount)

    {

        return '$ ' . $amount;
    }
}


/**
 * Find & returns the value if exists in db
 *
 * @param string $key key which is used to check in db - Reference: settings table - key column
 *
 * @return string/boolean $value if exists value else false
 *

 */

if (!function_exists('setting')) {


    function setting($key = '')

    {

        $CI = &get_instance();

        return !empty($value = $CI->settings_model->getValueByKey($key)) ? $value : false;
    }
}


/**
 * Generates teh html for breadcrumb - Supports AdminLte
 *
 * @param array $args Array of values
 *

 */

if (!function_exists('breadcrumb')) {


    function breadcrumb($args = '')

    {

        $html = '<ol class="breadcrumb">';

        $i = 0;

        foreach ($args as $key => $value) {

            if (count($args) < $i)

                $html .= '<li><a href="' . url($key) . '">' . $value . '</a></li>';

            else

                $html .= '<li class="active">' . $value . '</li>';

            $i++;
        }


        $html .= '</ol>';

        echo $html;
    }
}


/**
 * Finds and return the ipaddress of client user
 *
 * @param array $ipaddress IpAddress
 *

 */

if (!function_exists('ip_address')) {


    function ip_address()
    {

        $ip_address = '';

        if (isset($_SERVER['HTTP_CLIENT_IP']))

            $ip_address = $_SERVER['HTTP_CLIENT_IP'];

        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))

            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];

        else if (isset($_SERVER['HTTP_X_FORWARDED']))

            $ip_address = $_SERVER['HTTP_X_FORWARDED'];

        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))

            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];

        else if (isset($_SERVER['HTTP_FORWARDED']))

            $ip_address = $_SERVER['HTTP_FORWARDED'];

        else if (isset($_SERVER['REMOTE_ADDR']))

            $ip_address = $_SERVER['REMOTE_ADDR'];

        else

            $ip_address = 'UNKNOWN';

        return $ip_address;
    }
}


/**
 * Provides the shortcodes which are available in any email template
 *
 * @return array $data Array of shortcodes
 *

 */

if (!function_exists('getEmailShortCodes')) {


    function getEmailShortCodes()
    {


        $data = [

            'site_url' => site_url(),

            'company_name' => setting('company_name'),

        ];


        return $data;
    }
}


/**
 * Redirects with error if user doesn't have the permission to passed key/module
 *
 * @param string $code Code permissions
 *
 * @return boolean true/false
 *

 */

if (!function_exists('ifPermissions')) {


    function ifPermissions($code = '')
    {


        $CI = &get_instance();


        if (hasPermissions($code)) {

            return true;
        }


        // $CI->session->set_flashdata('alert-type', 'danger');

        // $CI->session->set_flashdata('alert', 'You dont have permissions to this Section !');


        // redirect('/', 'refresh');


        $CI->load->view('errors/html/error_403_permission');


        return false;
    }
}


/**
 * Check and return boolean if user have the permission to passed key or not
 *
 * @param string $code Code permissions
 *
 * @return boolean true/false
 *

 */

if (!function_exists('hasPermissions')) {


    function hasPermissions($code = '')
    {


        $CI = &get_instance();

        $user = (object)$CI->session->userdata('logged');

        if ($user->id == 1) {

            return true;
            exit();
        }

        //echo '<pre>';print_r(logged('role'));print_r($code);die;

        //if (!empty($CI->role_permissions_model->getByWhere(['role' => logged('role'), 'permission' => $code]))) {
        $role = logged('role');
        if (!empty($CI->role_permissions_model->getByPermissionCode($role, $code))) {


            return true;
        }

        return false;
    }
}

if (!function_exists('getLoggedFullName')) {

    function getLoggedFullName($userId)
    {
        $finalUserId = ($userId) ? $userId : logged('id');
        $CI =& get_instance();
        $CI->load->model('Users_model', 'user_model');
        $result = $CI->user_model->getByWhere(array('id' => $finalUserId));

        return ucwords($result[0]->FName) . ' ' . ucwords($result[0]->LName);
    }
}

if (!function_exists('getJobAddress')) {

    function getJobAddress($addressId)
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('address');
        $CI->db->where('address_id', $addressId);
        $address = $CI->db->get()->row();

        return ucwords($address->address1) . ' ' .ucwords($address->address2) . ' ' . ucwords($address->city . ' ' . ucwords($address->state));
    }
}

if (!function_exists('getLoggedUserID')) {


    function getLoggedUserID()
    {

        $CI = &get_instance();
        $user = (object)$CI->session->userdata('logged');
        return $user->id;
    }
}

if (!function_exists('getLoggedCompanyID')) {


    function getLoggedCompanyID()
    {

        $CI = &get_instance();
        $company_id = logged('company_id');
        return $company_id;
    }
}


/**
 * Redirects with error if user doesnt have the permission to passed key/module
 *
 * @param string $code Code permissions
 *
 * @return boolean true/false
 *

 */

if (!function_exists('notAllowedDemo')) {


    function notAllowedDemo($url = '')
    {


        $CI = &get_instance();


        $CI->session->set_flashdata('alert-type', 'danger');

        $CI->session->set_flashdata('alert', 'This action is disabled in <strong>Demo</strong> !');


        redirect($url);


        return false;
    }
}


/**
 * Hides Some Characters in Email. Basically Used in Forget Password System
 *
 * @param string $email Email
 *
 * @return string
 *

 */

if (!function_exists('obfuscate_email')) {


    function obfuscate_email($email)
    {


        $em = explode("@", $email);

        $name = implode(array_slice($em, 0, count($em) - 1), '@');

        $len = floor(strlen($name) / 2);


        return substr($name, 0, $len) . str_repeat('*', $len) . "@" . end($em);
    }
}

if (!function_exists('getCompany')){
    function getCompany(){
        $CI = &get_instance();
        $company_id = logged('id');

        return $CI->business_model->getById($company_id);
    }
}

if (!function_exists('getCompanyFolder')){
    function getCompanyFolder(){
        $CI = &get_instance();
        $company = getCompany();
        $company_folder = '';

        if(!file_exists('./uploads/')){
            mkdir('./uploads/');
        }

        if(empty($company->folder_name)){
            $folder_name = generateRandomString();
            while(file_exists('./uploads/' . $folder_name . '/')){
                $folder_name = generateRandomString();  
            }

            $data = array('folder_name' => $folder_name);

            if($CI->business_model->trans_update($data, array('id' => $company->id))){
                mkdir('./uploads/' . $folder_name . '/');

                $company_folder = $folder_name;
            }
        } else {
            $company_folder = $company->folder_name;
        }

        return $company_folder;
    }
}

if (!function_exists('getFolders')) {

    function getFolders($getallparent = false, $getallchild = false)
    {
        $CI = &get_instance();
        $uid = logged('id');
        $role_id = logged('role');
        $company_id = logged('company_id');

        $parent_filter = '';
        if($getallparent){
            $parent_filter = 'and (a.parent_id = 0 or a.parent_id is null) ';
        } else if($getallchild){
            $parent_filter = 'and (a.parent_id <> 0 and a.parent_id is not null) ';
        }

        $sql = 'select ' . 

               'a.* '.

               'from file_folders a '.

               'where a.company_id = ' . $company_id . ' ' . $parent_filter . 

               'order by create_date ASC';

        return $CI->db->query($sql);
    }

}

function getFolderManagerView($isMain = true){
    $CI = &get_instance();

    return $CI->load->view('modals/folder_manager', array('isMain' => $isMain), TRUE);
}

function get_event_color($work_status)
{
    $CI =& get_instance();
    $CI->load->model('Workstatus_model', 'workstatus');

    return $CI->workstatus->getWorkStatus($work_status);
}


/**
 * All Users
 */
function all_users()
{
    $CI =& get_instance();
    $CI->load->model('Users_model', 'user');

    return $CI->user->getByWhere(['company_id' => logged('company_id')]);
}


/**
 * return user details based on ID
 */
function get_user_by_id($user_id)
{
    $CI =& get_instance();
    $CI->load->model('Users_model', 'user');

    return $CI->user->getUser($user_id);
}


/**
 * return customer details based on ID
 */
function get_customer_by_id($customer_id, $key = '')
{
    $CI =& get_instance();
    $CI->load->model('Customer_model', 'customer');

    if (!empty($key)) {
        return $CI->customer->getCustomer($customer_id)->$key;
    }

    return $CI->customer->getCustomer($customer_id);
}


/**
 * all customers based on company or user id
 */
function get_all_customers()
{
    $CI =& get_instance();
    $CI->load->model('Customer_model', 'customer');

    return $CI->customer->getAll();
}


/* helper functions to load css and js on a page */
//Dynamically add Javascript files to header page
if (!function_exists('add_footer_js')) {
    function add_footer_js($file = '')
    {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('footer_js');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file as $item) {
                $footer_js[] = $item;
            }
            $ci->config->set_item('footer_js', $footer_js);
        } else {
            $str = $file;
            $footer_js[] = $str;
            $ci->config->set_item('footer_js', $footer_js);
        }
    }
}

if (!function_exists('add_header_js')) {
    function add_header_js($file = '')
    {
        $str = '';
        $ci = &get_instance();
        $header_js = $ci->config->item('header_js');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file as $item) {
                $header_js[] = $item;
            }
            $ci->config->set_item('header_js', $header_js);
        } else {
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js', $header_js);
        }
    }
}

//Dynamically add CSS files to header page
if (!function_exists('add_css')) {
    function add_css($file = '')
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');

        if (empty($file)) {
            return;
        }

        if (is_array($file)) {
            if (!is_array($file) && count($file) <= 0) {
                return;
            }
            foreach ($file as $item) {
                $header_css[] = $item;
            }
            $ci->config->set_item('header_css', $header_css);
        } else {
            $str = $file;
            $header_css[] = $str;
            $ci->config->set_item('header_css', $header_css);
        }
    }
}

if (!function_exists('put_header_assets')) {
    function put_header_assets()
    {
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        $header_js = $ci->config->item('header_js');

        foreach ($header_css as $item) {

            if (strpos($item, 'https://') !== FALSE) {

                $str .= '<link rel="stylesheet" href="' . $item . '" type="text/css" />' . "\n";
            } else {

                $str .= '<link rel="stylesheet" href="' . base_url() . $item . '" type="text/css" />' . "\n";
            }
        }

        foreach ($header_js as $item) {

            if (strpos($item, 'https://') !== FALSE) {

                $str .= '<script type="text/javascript" src="' . $item . '"></script>' . "\n";

            } else {

                $str .= '<script type="text/javascript" src="' . base_url() . $item . '"></script>' . "\n";
            }
        }

        return $str;
    }
}


if (!function_exists('put_footer_assets')) {
    function put_footer_assets()
    {
        $str = '';
        $ci = &get_instance();
        $footer_js = $ci->config->item('footer_js');

        foreach ($footer_js as $item) {

            if (strpos($item, 'https://') !== FALSE) {

                $str .= '<script type="text/javascript" src="' . $item . '"></script>' . "\n";
            } else {

                $str .= '<script type="text/javascript" src="' . base_url() . $item . '"></script>' . "\n";
            }
        }

        return $str;
    }
}


/**
 * @param $item_name
 * @return mixed
 */
function get_config_item($item_name)
{

    $ci = get_instance(); // CI_Loader instance
    return $ci->config->item($item_name);
}


function get_notification_details($id = null)
{

    $notification_methods = array(
        '0' => 'None',
        'PT5M' => '5 minutes before',
        'PT15M' => '15 minutes before',
        'PT30M' => '30 minutes before',
        'PT1H' => '1 hour before',
        'PT2H' => '2 hours before',
        'PT4H' => '4 hours before',
        'PT6H' => '6 hours before',
        'PT8H' => '8 hours before',
        'PT12H' => '12 hours before',
        'PT16H' => '16 hours before',
        'P1D' => '1 day before',
        'P2D' => '2 days before',
        'PT0M' => 'On date of event',
    );

    if ($id)
        return $notification_methods[$id];

    return $notification_methods;
}


/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://sam.zoy.org/wtfpl/COPYING for more details.
 */

/**
 * Tests if an input is valid PHP serialized string.
 *
 * Checks if a string is serialized using quick string manipulation
 * to throw out obviously incorrect strings. Unserialize is then run
 * on the string to perform the final verification.
 *
 * Valid serialized forms are the following:
 * <ul>
 * <li>boolean: <code>b:1;</code></li>
 * <li>integer: <code>i:1;</code></li>
 * <li>double: <code>d:0.2;</code></li>
 * <li>string: <code>s:4:"test";</code></li>
 * <li>array: <code>a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}</code></li>
 * <li>object: <code>O:8:"stdClass":0:{}</code></li>
 * <li>null: <code>N;</code></li>
 * </ul>
 *
 * @param string $value Value to test for serialized form
 * @param mixed $result Result of unserialize() of the $value
 * @return        boolean            True if $value is serialized data, otherwise false
 * @author        Chris Smith <code+php@chris.cs278.org>
 * @copyright    Copyright (c) 2009 Chris Smith (http://www.cs278.org/)
 * @license        http://sam.zoy.org/wtfpl/ WTFPL
 */
function is_serialized($value, &$result = null)
{
    // Bit of a give away this one
    if (!is_string($value)) {
        return false;
    }

    // Serialized false, return true. unserialize() returns false on an
    // invalid string or it could return false if the string is serialized
    // false, eliminate that possibility.
    if ($value === 'b:0;') {
        $result = false;
        return true;
    }

    $length = strlen($value);
    $end = '';

    switch ($value[0]) {
        case 's':
            if ($value[$length - 2] !== '"') {
                return false;
            }
        case 'b':
        case 'i':
        case 'd':
            // This looks odd but it is quicker than isset()ing
            $end .= ';';
        case 'a':
        case 'O':
            $end .= '}';

            if ($value[1] !== ':') {
                return false;
            }

            switch ($value[2]) {
                case 0:
                case 1:
                case 2:
                case 3:
                case 4:
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                    break;

                default:
                    return false;
            }
        case 'N':
            $end .= ';';

            if ($value[$length - 1] !== $end[0]) {
                return false;
            }
            break;

        default:
            return false;
    }

    if (($result = @unserialize($value)) === false) {
        $result = null;
        return false;
    }
    return true;
}


/**
 * return the array from the serialize data
 *
 * @param $data
 * @return bool|mixed
 */
function serialize_to_array($data)
{
    foreach ($data as $k => $d) {

        if (is_serialized($d)) {

            $data->$k = unserialize($d);
        }
    }

    return $data;
}


/**
 * @param $key
 * @return mixed
 */
function get_setting($key)
{
    $CI =& get_instance();
    $CI->load->model('Settings_model', 'settings_model');

    return $CI->settings_model->getValueByKey($key);
}

/**
 * @param $settings
 * @param $event
 * @param $customer
 * @return string
 */
function make_calender_event_label($settings, $event, $customer)
{
    $settings = unserialize($settings);
    $date = date('a', strtotime($event->start_time));
    $date = substr($date, -2, 1);
    $title = date('g', strtotime($event->start_time)) . $date;

    if (!empty($settings['work_order_show_customer'])) {
        $title .= ' ' . $customer->contact_name . ', ' . $customer->mobile;
    }

    if (!empty($settings['work_order_show_details'])) {
        $title .= ', ' . $event->description;
    }

    if (!empty($settings['work_order_show_price'])) {
        $title .= ', $0.00';
    }

    return $title;
}


/**
 * @param $settings
 * @param $workorder
 * @param $customer
 * @return string
 */
function make_calender_wordorder_label($settings, $workorder)
{
    $settings = unserialize($settings);

    $date = date('a', strtotime($workorder->date_issued));
    $date = substr($date, -2, 1);
    $title = date('g', strtotime($workorder->date_issued)) . $date;

    if (!empty($settings['work_order_show_customer'])) {
        $title .= ' ' . $workorder->customer['first_name'] . ' ' . $workorder->customer['last_name'] . ', ';
        $title .= $workorder->customer['contact_mobile'];
    }

    if (!empty($settings['work_order_show_details'])) {
        $title .= ', ' . $workorder->customer['monitored_location'];
    }

    if (!empty($settings['work_order_show_price'])) {
        $title .= ', $' . $workorder->total['eqpt_cost'];
    }

    return $title;
}


/**
 * @return mixed
 */
function get_job_types()
{
    $CI =& get_instance();
    $CI->load->model('JobType_model', 'jobType_model');

    return $CI->jobType_model->getByWhere(['user_id' => logged('id')]);
}


/**
 * @return mixed
 */
function get_priority_list()
{
    $CI =& get_instance();
    $CI->load->model('PriorityList_model', 'priorityList_model');

    return $CI->priorityList_model->getByWhere(['user_id' => logged('id')]);
}


/**
 * @param $id
 * @return mixed
 */
function get_company_by_id($id)
{
    $CI =& get_instance();
    $CI->load->model('Business_model', 'business_model');

    return $CI->business_model->getById($id);
}


/**
 * @return mixed
 */
function get_company_by_user_id()
{
    $CI =& get_instance();
    $CI->load->model('Business_model', 'business_model');

    return $CI->business_model->getByWhere(['user_id' => logged('id')]);
}


/**
 * @param $id
 * @return mixed
 */
function get_priority_by_id($id)
{
    $CI =& get_instance();
    $CI->load->model('PriorityList_model', 'priorityList_model');

    return $CI->priorityList_model->getById($id);
}


/**
 * @param $id
 * @return mixed
 */
function get_status_by_id($id)
{
    $CI =& get_instance();
    $CI->load->model('Workstatus_model', 'workstatus_model');

    return $CI->workstatus_model->getById($id);
}


/**
 * @param $id
 * @return mixed
 */
function get_status_by_name($name)
{
    $CI =& get_instance();
    $CI->load->model('Workstatus_model', 'workstatus_model');

    $status = $CI->workstatus_model->filter(['title' => $name]);
    if (!empty($status)) {

        return current($status);
    }

    return null;
}


/**
 * @return mixed
 */
function get_workorder_count()
{
    $CI =& get_instance();
    $CI->load->model('Workorder_model', 'workorder_model');

    return count($CI->workorder_model->getByWhere(array('user_id' => logged('id'))));
}


/**
 * @return mixed
 */
function get_customer_count()
{
    $CI =& get_instance();
    $CI->load->model('Customer_model', 'customer_model');

    return count($CI->customer_model->getByWhere(array('user_id' => logged('id'))));
}


/**
 * @return mixed
 */
function get_customer_groups()
{
    $CI =& get_instance();
    $CI->load->model('CustomerGroup_model', 'customerGroup_model');

    return $CI->customerGroup_model->getByWhere(array('user_id' => logged('id')));
}


/**
 * @return mixed
 */
function get_customer_source($id)
{
    $CI =& get_instance();
    $CI->load->model('CustomerSource_model', 'customerSource_model');

    return $CI->customerSource_model->getById($id);
}

/**
 * @return mixed
 */
function get_source()
{
    $CI =& get_instance();
    $CI->load->model('Source_model', 'source_model');

    return $CI->source_model->get();
}


/**
 * @param int $status
 * @param bool $count_only
 * @return mixed
 */
function get_estimate_status_total($status = 0, $count_only = false)
{
    $CI =& get_instance();
    $CI->load->model('Estimate_model', 'estimate_model');

    if (!empty($status)) {

        if ($count_only) {

            return count($CI->estimate_model->getByWhere(array('status' => $status)));
        } else {
            return $CI->estimate_model->getByWhere(array('status' => $status));
        }
    }

    if ($count_only) {
        return count($CI->estimate_model->getByWhere(array('user_id' => logged('id'))));
    }

    return $CI->estimate_model->getByWhere(array('user_id' => logged('id')));;
}


/**
 * @param $value
 * @return string
 */
function dollar_format($value) {
    if ($value<0) return "-".asDollars(-$value);
    return '$' . number_format($value, 2);
}


/**
 * @return mixed
 */
function get_services() {

    $CI =& get_instance();
    $CI->load->model('Service_model', 'service_model');

    return $CI->service_model->getAll();
}


/**
 * @param $equipment_id
 * @return mixed
 */
function get_equipments() {

    $CI =& get_instance();
    $CI->load->model('Equipment_model', 'equipment_model');

    return $CI->equipment_model->getByWhere(['user_id' => logged('id')]);
}


/**
 * @param $equipment_id
 * @return mixed
 */
function get_equipment_items($equipment_id) {

    $CI =& get_instance();
    $CI->load->model('EquipmentItem_model', 'equipmentItem_model');

    return $CI->equipmentItem_model->getByWhere(['equipment_id' => $equipment_id]);
}


/**
 * @param $equipment_id
 * @return mixed
 */
function count_equipment_items($equipment_id) {

    $CI =& get_instance();
    $CI->load->model('EquipmentItem_model', 'equipmentItem_model');

    return $CI->equipmentItem_model->countItems($equipment_id);
}

/**
 * @return mixed
 */
function get_inquiries_count()
{
    $CI =& get_instance();
    // $CI->load->model('Inquiry_model', 'inquiry_model');
    $today = date("Y-m-d");

    // return count($CI->inquiry_model->getByWhere(array('user_id' => logged('id'), 'created_at' => $today)));
    return 0;
}

/**
 * @return mixed
 */
function get_format_date($date)
{
    $new_date=date_create($date);
    return date_format($new_date,"M d, Y");
}

/**
 * @return mixed
 */
function get_invoice_count($id)
{
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $today = date("Y-m-d");

    switch($id) {
        case 2:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'due_date' => $today, 'is_recurring' => 0)));

        case 3:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'due_date <' => $today, 'is_recurring' => 0)));

        case 4:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'status' => "Partial Paid", 'is_recurring' => 0)));

        case 5:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'status' => "Paid", 'is_recurring' => 0)));

        case 6:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'status' => "Draft", 'is_recurring' => 0)));

        default:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'user_id' => logged('id'), 'is_recurring' => 0)));
    }
}

/**
 * @return mixed
 */
function get_recurring_count($id)
{
    $CI =& get_instance();
    $company_id = logged('company_id');
    $CI->load->model('Invoice_model', 'invoice_model');

    switch($id) {
        case 2:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'status' => "Active", "is_recurring" => 1)));

        case 3:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'status' => "Stopped", "is_recurring" => 1)));

        default:
            return count($CI->invoice_model->getByWhere(array('company_id' => $company_id, 'user_id' => logged('id'), "is_recurring" => 1)));
    }
}

/**
 * @return mixed
 */
function get_invoice_amount($type)
{
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $result = 0;
    $start_date = date("Y") . "-01-01";
    $end_date = date("Y") . "-12-31";

    switch ($type) {
        case "year":
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date));
            return total_invoice_amount($result); 

        case "pending":
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Draft'));
            return total_invoice_amount($result);

        default:
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status !=' => 'Draft'));
            return total_invoice_amount($result);
    }
}

/**
 * @return mixed
 */
function total_invoice_amount($invoices)
{
    $grand_total = 0;
    foreach ($invoices as $invoice) {
        $totals = unserialize($invoice->invoice_totals);
        $grand_total += floatval($totals['grand_total']);
    }

    return number_format($grand_total, 2, '.', ',');
}

/**
 * return invoice details based on ID
 */
function get_invoice_by_id($invoice_id, $key = '')
{
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice');

    if (!empty($key)) {
        return $CI->invoice->getinvoice($invoice_id)->$key;
    }

    return $CI->invoice->getinvoice($invoice_id);
}

/**
 * return invoice details based on ID
 */
function get_reports_by_date($start_date, $end_date, $month, $action)
{
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $CI->load->model('Estimate_model', 'estimate_model');
    $company_id = logged('company_id');
    $final_res = 0;

    switch ($action) {
        case 'num_estimate':
            $result = $CI->estimate_model->getByWhere(array('company_id' => $company_id, 'estimate_date >=' => $start_date, 'estimate_date <=' => $end_date));
            $final_res = report_totals_by_month($result, $month, $action);
            break;
        
        case 'estimate_amount':
            $result = $CI->estimate_model->getByWhere(array('company_id' => $company_id, 'estimate_date >=' => $start_date, 'estimate_date <=' => $end_date));
            $final_res = report_totals_by_month($result, $month, $action);
            break;

        case 'num_invoice':
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date));
            $final_res = report_totals_by_month($result, $month, 'num_invoice');
            break;
        
        case 'invoice_amount':
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date));
            $final_res = report_totals_by_month($result, $month, "invoice_amount");
            break;

        case 'paid_invoice':
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid'));
            $final_res = report_totals_by_month($result, $month, "invoice_amount");
            break;

        case 'due_invoice':
            $today = date("Y-m-d");
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'due_date <=' => $today, 'status !=' => 'Paid'));
            $final_res = report_totals_by_month($result, $month, "invoice_amount");
            break;
    }

    return $final_res;
}

/**
 * @return mixed
 */
function get_invoice_amount_by_date($type, $start_date, $end_date)
{
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $result = 0;

    switch ($type) {
        case "paid":
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid'));
            return total_invoice_amount($result);
    }
}

/**
 * @return mixed
 */
function report_totals_by_month($results, $month, $action)
{
    $grand_total = 0;
    switch ($action) {
        case 'num_estimate':
            foreach ($results as $result) {
                $date = explode("-",$result->estimate_date);
                if ($date[1] == $month) {
                    $grand_total += 1;
                }
            }
            break;

        case 'estimate_amount':
            foreach ($results as $result) {
                $date = explode("-",$result->estimate_date);
                $totals = unserialize($result->estimate_eqpt_cost);
                if ($date[1] == $month) {
                    $grand_total += (floatval($totals['eqpt_cost']) + floatval($totals['sales_tax']) + floatval($totals['inst_cost']) + floatval($totals['one_time']) + floatval($totals['m_monitoring']));
                }
            }
            break;

        case 'num_invoice':
            foreach ($results as $result) {
                $date = explode("-",$result->date_issued);
                if ($date[1] == $month) {
                    $grand_total += 1;
                }
            }
            break;

        case 'invoice_amount':
            foreach ($results as $result) {
                $totals = unserialize($result->invoice_totals);
                $date = explode("-",$result->date_issued);
                if ($date[1] == $month) {
                    $grand_total += floatval($totals['grand_total']);
                }
            }
            break;
    }

    return $grand_total;
}

/**
 * @return mixed
 */
function setPageName($type) {
    $title = '';
    
    switch($type) {
        case "monthly-closeout":
            $title = "Monthly Closeout";
            break;

        case "yearly-closeout":
            $title = "Yearly Closeout";
            break;

        case "profit-loss":
            $title = "Profit and Loss";
            break;

        case "work-order-by-employee":
            $title = "Sales Leaderboard";
            break;

        case "payment-by-method":
            $title = "Payments Type Summary";
            break;

        case "payment-by-month":
            $title = "Payments Received";
            break;

        case "payment-by-item":
            $title = "Sales By Items";
            break;

        case "payment-by-material-item":
            $title = "Material Sales Report";
            break;

        case "payment-by-product-item":
            $title = "Product Sales Report";
            break;

        case "payment-repeated-by-customer":
            $title = "Repeated Business";
            break;

        case "sales-demographics":
            $title = "Sales Demographics";
            break;

        case "account-receivable":
            $title = "Account Receivable";
            break;

        case "invoice-by-date":
            $title = "Invoice by Date";
            break;

        case "invoice-aging-summary":
            $title = "Aging Summary";
            break;

        case "account-receivable-com-vs-res":
            $title = "Commercial vs Residential";
            break;

        case "expense-by-category":
            $title = "Expenses By Category Summary";
            break;

        case "expense-by-month-by-category":
            $title = "Expenses By Category";
            break;

        case "expense-by-month-by-customer":
            $title = "Expenses By Customer";
            break;

        case "expense-by-month-by-work-order":
            $title = "Expenses By Work Order";
            break;

        case "expense-by-month-by-work-vendor":
            $title = "Expenses By Work Vendor";
            break;

        case "estimate-status-by-month":
            $title = "Estimates Summary";
            break;

        case "payment-by-customer":
            $title = "Sales Summary By Customer";
            break;
        
        case "customer-sales":
            $title = "Sales By Customer";
            break;
                
        case "payment-by-customer-group":
            $title = "Sales By Customer Groups";
            break;
                
        case "customer-source":
            $title = "Sales By Customer Source";
            break;
                        
        case "customer-tax-by-month":
            $title = "Tax Paid by Customers";
            break;
                                    
        case "customer-by-city-state":
            $title = "Customer Demographics";
            break;
                                                
        case "customer-by-source":
            $title = "Customer Source";
            break;
        
        case "employee-payroll-summary":
            $title = "Payroll Summary";
            break;
                    
        case "employee-payroll-by-employee":
            $title = "Payroll By Employee";
            break;
                                
        case "employee-payroll-log":
            $title = "Payroll Log Details";
            break;
                                            
        case "employee-payroll-percent-commission":
            $title = "Percent Sales Commission Report";
            break;
                                                        
        case "summary-by-period":
            $title = "Time Log Summary";
            break;
                                                                    
        case "timesheet-entries":
            $title = "Time Log Details";
            break;
                                                                            
        case "work-order-status":
            $title = "Work Order Status";
            break;
                                                                                        
        case "sales-tax":
            $title = "Sales Tax";
            break;
                                                                                        
        case "invoice-items-no-tax":
            $title = "Non Taxable Sales";
            break;
    }

    return $title;
}

function getLoggedName() {
    $CI =& get_instance();
    $CI->load->model('Users_model', 'user_model');
    $result = $CI->user_model->getByWhere(array('id' => logged('id')));

    //return ucwords($result[0]->name);
    return ucwords($result[0]->FName);
}

function getUserEmail($id) {
    $CI =& get_instance();
    $CI->load->model('Users_model', 'user_model');
    $result = $CI->user_model->getByWhere(array('id' => $id));

    //return ucwords($result[0]->name);
    return ucwords($result[0]->email);
}

function getItemCategoryName($categories, $id) {

    $name = $id;
    foreach ($categories as $category) {
        if ($category->item_categories_id == $id) {
            $name = $category->name;
        }
    }

    return ucwords($name);
}

function getPaymentByMethod($start_date, $end_date, $month) {
    $CI =& get_instance();
    $CI->load->model('Payment_records_model', 'payment_records_model');
    $company_id = logged('company_id');
    $results = $CI->payment_records_model->getByWhere(array('company_id' => $company_id, 'payment_date >=' => $start_date, 'payment_date <=' => $end_date));
    $fn = [];
    $total = 0;
    $cc = 0;
    $cash = 0;
    $check = 0;
    $grand_total = 0;

    foreach ($results as $result) {
        $date = explode("-",$result->payment_date);
        if ($date[1] == $month) {
            $total += floatval($result->invoice_amount);
            switch (strtolower($result->payment_method)) {
                case "cc":
                    $cc += floatval($result->invoice_amount);
                    break;

                case "cash":
                    $cash += floatval($result->invoice_amount);
                    break;
                
                case "check":
                    $check += floatval($result->invoice_amount);
                    break;
            }
        }

        $grand_total += floatval($result->invoice_amount);
    }

    ($total > 0) ? array_push($fn, array($total)) : $total = 0;
    ($cc > 0) ? array_push($fn, array("Credit Card", dollar_format($cc))) : $cc = 0;
    ($cash > 0) ? array_push($fn, array("Cash", dollar_format($cash))) : $cash = 0;
    ($check > 0) ? array_push($fn, array("Check", dollar_format($check))) : $check = 0;

    return $fn;
}

function getPaymentByMonth($start_date, $end_date, $month) {
    $CI =& get_instance();
    $CI->load->model('Payment_records_model', 'payment_records_model');
    $company_id = logged('company_id');
    $results = $CI->payment_records_model->getByWhere(array('company_id' => $company_id,'payment_date >=' => $start_date, 'payment_date <=' => $end_date));
    $fn = [];
    $company_id = [];
    $total = 0;

    foreach ($results as $result) {
        $date = explode("-",$result->payment_date);
        if ($date[1] == $month) {
            $total += floatval($result->invoice_amount);
            if (!in_array($result->customer_id, $company_id)) {
                array_push($company_id, $result->customer_id);
                array_push($fn, array(get_customer_by_id($result->customer_id)->contact_name, '', '', ''));
                array_push($fn, array('', $result->payment_date, $result->invoice_number, getPaymentType($result->payment_method), dollar_format($result->invoice_amount)));
            } else {
                array_push($fn, array('', $result->payment_date, $result->invoice_number, getPaymentType($result->payment_method), dollar_format($result->invoice_amount)));
            }
        }
    }
    if (count($fn) > 0) {
        $fn[0] = array_merge($fn[0], array(dollar_format($total), $total));
    }

    return $fn;
}

function getAccountReceivable($start_date, $end_date, $month) {
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $CI->load->model('Payment_records_model', 'payment_records_model');
    $company_id = logged('company_id');
    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status !=' => 'Draft', 'is_recurring' => 0));
    $fn = [array('0')];
    $num_invoice = 0;
    $total_invoice = 0;
    $paid_invoice = 0;
    $due_invoice = 0;
    $tip_invoice = 0;
    $fees_invoice = 0;

    foreach ($results as $result) {
        $date = explode("-",$result->date_issued);
        if ($date[1] == $month && $result->status != "Paid") {
            $monthly_paid = 0;
            $monthly_tip = 0;
            $monthly_fees = 0;
            $num_invoice += 1;
            $totals = unserialize($result->invoice_totals);
            $total_invoice += floatval($totals['grand_total']);
            $invoices = $CI->payment_records_model->getByWhere(array("invoice_number" => $result->invoice_number));
            foreach ($invoices as $inv) {
                $tip_invoice += $inv->invoice_tip;
                $monthly_tip += $inv->invoice_tip;
                $paid_invoice += $inv->invoice_amount;
                $monthly_paid += $inv->invoice_amount;
            }
            $monthly_due = floatval(floatval($totals['grand_total']) - floatval($monthly_paid));
            $due_invoice += $monthly_due;
            $new_date=date_format(date_create($result->date_issued),"d-M-Y");
            array_push($fn, array($new_date,"Invoice #".$result->invoice_number. "(".$result->status.")", get_customer_by_id($result->customer_id)->contact_name, dollar_format(floatval($totals['grand_total'])), dollar_format($monthly_paid), dollar_format($monthly_due), dollar_format($monthly_tip), dollar_format($monthly_fees)));
        }
    }
    if (count($results) > 0 && count($fn) > 1) {
        $fn[0] = array_merge($fn[0], array($num_invoice, dollar_format($total_invoice), dollar_format($paid_invoice), dollar_format($due_invoice), dollar_format($tip_invoice), dollar_format($fees_invoice)));
        unset($fn[0][0]);
        return $fn;
    } else {
        $fn = [];
    }

    return $fn;
}

function getAccountReceivableResCom($start_date, $end_date, $month) {
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $CI->load->model('Payment_records_model', 'payment_records_model');
    $company_id = logged('company_id');
    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status !=' => 'Draft', 'is_recurring' => 0));
    $fn = [array('0')];
    $res_num_invoice = 0;
    $res_total_invoice = 0;
    $res_paid_invoice = 0;
    $res_due_invoice = 0;
    $res_tip_invoice = 0;
    $res_fees_invoice = 0;
    $com_num_invoice = 0;
    $com_total_invoice = 0;
    $com_paid_invoice = 0;
    $com_due_invoice = 0;
    $com_tip_invoice = 0;
    $com_fees_invoice = 0;

    foreach ($results as $result) {
        $date = explode("-",$result->date_issued);
        if ($date[1] == $month) {
            $monthly_paid = 0;
            $monthly_tip = 0;
            $monthly_fees = 0;
            $totals = unserialize($result->invoice_totals);
            if (get_customer_by_id($result->customer_id)->customer_type == "Residential") {
                $res_num_invoice += 1;
                $res_total_invoice += floatval($totals['grand_total']);
            } else {
                $com_num_invoice += 1;
                $com_total_invoice += floatval($totals['grand_total']);
            }
            $invoices = $CI->payment_records_model->getByWhere(array("invoice_number" => $result->invoice_number));
            foreach ($invoices as $inv) {
                if (get_customer_by_id($result->customer_id)->customer_type == "Residential") {
                    $res_tip_invoice += $inv->invoice_tip;
                    $res_paid_invoice += $inv->invoice_amount;
                } else {
                    $com_tip_invoice += $inv->invoice_tip;
                    $com_paid_invoice += $inv->invoice_amount;
                }
                $monthly_tip += $inv->invoice_tip;
                $monthly_paid += $inv->invoice_amount;
            }
            $monthly_due = floatval(floatval($totals['grand_total']) - floatval($monthly_paid));
            if (get_customer_by_id($result->customer_id)->customer_type == "Residential") {
                $res_due_invoice += $monthly_due;
            } else {
                $com_due_invoice += $monthly_due;
            }
            $new_date=date_format(date_create($result->date_issued),"d-M-Y");
            if (get_customer_by_id($result->customer_id)->customer_type == "Residential") {
                array_push($fn, array($new_date,"Invoice #".$result->invoice_number. "(".$result->status.")", get_customer_by_id($result->customer_id)->contact_name, '', '', '', '', '', '', '', dollar_format(floatval($totals['grand_total'])), dollar_format($monthly_paid), dollar_format($monthly_due), dollar_format($monthly_tip), dollar_format($monthly_fees)));
            } else {
                array_push($fn, array($new_date,"Invoice #".$result->invoice_number. "(".$result->status.")", get_customer_by_id($result->customer_id)->contact_name, '', dollar_format(floatval($totals['grand_total'])), dollar_format($monthly_paid), dollar_format($monthly_due), dollar_format($monthly_tip), dollar_format($monthly_fees), '', '', '', '', '', '',));
            }
        }
    }
    if (count($results) > 0 && count($fn) > 1) {
        $fn[0] = array_merge($fn[0], array($com_num_invoice, dollar_format($com_total_invoice), dollar_format($com_paid_invoice), dollar_format($com_due_invoice), dollar_format($com_tip_invoice), dollar_format($com_fees_invoice), $res_num_invoice, dollar_format($res_total_invoice), dollar_format($res_paid_invoice), dollar_format($res_due_invoice), dollar_format($res_tip_invoice), dollar_format($res_fees_invoice)));
        unset($fn[0][0]);
        return $fn;
    } else {
        $fn = [];
    }

    return $fn;
}

function getInvoiceByDate($start_date, $end_date, $month) {
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $CI->load->model('Payment_records_model', 'payment_records_model');
    $company_id = logged('company_id');
    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status !=' => 'Draft', 'is_recurring' => 0));
    $fn = [];
    $day = [];
    $num_invoice = 0;
    $total_invoice = 0;
    $paid_invoice = 0;
    $due_invoice = 0;
    $tip_invoice = 0;
    $fees_invoice = 0;

    foreach ($results as $result) {
        $date = explode("-",$result->date_issued);
        if ($date[1] == $month) {
            if (!in_array($result->date_issued, $day)) {
                array_push($day, $result->date_issued);
                $counter = 0;
                array_push($fn, array(date_format(date_create($result->date_issued),"d-M-Y")));
                foreach ($results as $result1) {
                    if ($result->date_issued == $result1->date_issued) {
                        $monthly_paid = 0;
                        $monthly_tip = 0;
                        $monthly_fees = 0;
                        $num_invoice += 1;
                        $counter += 1;
                        $totals = unserialize($result1->invoice_totals);
                        $total_invoice += floatval($totals['grand_total']);
                        $invoices = $CI->payment_records_model->getByWhere(array("invoice_number" => $result1->invoice_number));
                        foreach ($invoices as $inv) {
                            $tip_invoice += $inv->invoice_tip;
                            $monthly_tip += $inv->invoice_tip;
                            $paid_invoice += $inv->invoice_amount;
                            $monthly_paid += $inv->invoice_amount;
                        }
                        $monthly_due = floatval(floatval($totals['grand_total']) - floatval($monthly_paid));
                        $due_invoice += $monthly_due;
                        $new_date=date_format(date_create($result1->date_issued),"d-M-Y");
                        array_push($fn, array($new_date,"Invoice #".$result1->invoice_number. "(".$result1->status.")", get_customer_by_id($result1->customer_id)->contact_name, dollar_format(floatval($totals['grand_total'])), dollar_format($monthly_paid), dollar_format($monthly_due), dollar_format($monthly_tip), dollar_format($monthly_fees)));
                    }
                }
                $fn[count($fn) - ($counter + 1)] = array_merge($fn[count($fn) - ($counter + 1)], array($num_invoice, "", dollar_format($total_invoice), dollar_format($paid_invoice), dollar_format($due_invoice), dollar_format($tip_invoice), dollar_format($fees_invoice)));
            }
        }
    }

    return $fn;
}

function getPaymentByCustomer($start_date, $end_date) {
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid', 'is_recurring' => 0));
    $fn = [];
    $comp_user = [];
    $grand_total = 0;
    $grand_num_invoice = 0;
    $grand_paid_invoice = 0;

    foreach ($results as $result) {
        if (!in_array($result->customer_id, $comp_user)) {
            array_push($comp_user, $result->customer_id);
            $num_invoice = 0;
            $total_invoice = 0;
            $paid_invoice = 0;

            foreach ($results as $result2) {
                if ($result2->customer_id === $result->customer_id) {
                    $num_invoice += 1;
                    $paid_invoice += 1;
                    $grand_num_invoice += 1;
                    $grand_paid_invoice += 1;

                    $totals1 = unserialize($result2->invoice_totals);
                    $total_invoice += floatval($totals1['grand_total']);
                    $grand_total += floatval($totals1['grand_total']);
                }
            }
            array_push($fn, array(get_customer_by_id($result->customer_id)->contact_name, substr(get_customer_by_id($result->customer_id)->customer_type,0,1), $num_invoice, $paid_invoice, dollar_format($total_invoice)));
        }
    }

    array_push($fn, array("Total", "", $grand_num_invoice, $grand_paid_invoice, dollar_format($grand_total)));
    return $fn;
}

function getPaymentByItem($start_date, $end_date) {
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid', 'is_recurring' => 0));
    $fn = [];
    $comp_user = [];
    $grand_total = 0;
    $grand_num_invoice = 0;
    $grand_paid_invoice = 0;

    foreach ($results as $result) {
        $items = unserialize($result2->invoice_items);

        if (!in_array($result->customer_id, $comp_user)) {
            array_push($comp_user, $result->customer_id);
            $num_invoice = 0;
            $total_invoice = 0;
            $paid_invoice = 0;

            foreach ($results as $result2) {
                if ($result2->customer_id === $result->customer_id) {
                    $num_invoice += 1;
                    $paid_invoice += 1;
                    $grand_num_invoice += 1;
                    $grand_paid_invoice += 1;

                    $totals1 = unserialize($result2->invoice_totals);
                    $total_invoice += floatval($totals1['grand_total']);
                    $grand_total += floatval($totals1['grand_total']);
                }
            }
            array_push($fn, array(get_customer_by_id($result->customer_id)->contact_name, substr(get_customer_by_id($result->customer_id)->customer_type,0,1), $num_invoice, $paid_invoice, dollar_format($total_invoice)));
        }
    }

    array_push($fn, array("Total", "", $grand_num_invoice, $grand_paid_invoice, dollar_format($grand_total)));
    return $fn;
}

function getPaymentByCustomerGroup($start_date, $end_date) {
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $cusGroups = get_customer_groups();
    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid', 'is_recurring' => 0));
    $fn = [];
    $grand_count = 0;
    $grand_total = 0;

    foreach ($cusGroups as $cusGroup) {
        $count = 0;
        $total_sales = 0;
        foreach ($results as $result) {
            if (get_customer_by_id($result->customer_id)->customer_group) {
                $groups = unserialize(get_customer_by_id($result->customer_id)->customer_group);
                foreach ($groups as $group) {
                    if ($group === $cusGroup->title) {
                        $count += 1;
                        $grand_count += 1;
                        $totals1 = unserialize($result2->invoice_totals);
                        $total_invoice += floatval($totals1['grand_total']);
                        $total_sales += floatval($totals1['grand_total']);
                        $grand_total += floatval($totals1['grand_total']);
                    }
                }
            }
        }
        array_push($fn, array($cusGroup->title, $count, dollar_format($total_sales)));
    }


    array_push($fn, array("Total", $grand_count, dollar_format($grand_total)));
    return $fn;
}

function getCustomerSource($start_date, $end_date) {
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $cusSources = get_source();
    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid', 'is_recurring' => 0));
    $fn = [];
    $res_total = 0;
    $res_invoice_total = 0;
    $com_total = 0;
    $com_invoice_total = 0;

    foreach ($cusSources as $cusSource) {
        $res = 0;
        $res_invoice = 0;
        $com = 0;
        $com_invoice = 0;
        foreach ($results as $result) {
            if (get_customer_by_id($result->customer_id)->source_id === $cusSource->id) {
                if (get_customer_by_id($result->customer_id)->customer_type == "Residential") {
                    $res_total += 1;
                    $res += 1;
                    $totals1 = unserialize($result->invoice_totals);
                    $res_invoice += floatval($totals1['grand_total']);
                    $res_invoice_total += floatval($totals1['grand_total']);
                } else if (get_customer_by_id($result->customer_id)->customer_type == "Commercial") {
                    $com_total += 1;
                    $com += 1;
                    $totals1 = unserialize($result->invoice_totals);
                    $com_invoice += floatval($totals1['grand_total']);
                    $com_invoice_total += floatval($totals1['grand_total']);
                }
            }
        }
        array_push($fn, array($cusSource->source_name, $res, dollar_format($res_invoice), $com, dollar_format($com_invoice)));
    }

    array_push($fn, array("Total", $res_total, dollar_format($res_invoice_total), $com_total, dollar_format($com_invoice_total)));
    
    return $fn;
}

function getCustomerBySource() {
    $CI =& get_instance();
    $CI->load->model('Customer_model', 'customer_model');
    $company_id = logged('company_id');
    $cusSources = get_source();
    $customers = $CI->customer_model->getByWhere(array('company_id' => $company_id));
    $fn = [];
    $res_total = 0;
    $com_total = 0;
    $cus_total = 0;

    foreach ($cusSources as $cusSource) {
        $res = 0;
        $com = 0;
        $cus = 0;
        foreach ($customers as $customer) {
            if ($customer->source_id === $cusSource->id) {
                if ($customer->customer_type == "Residential") {
                    $res_total += 1;
                    $res += 1;
                    $cus += 1;
                    $cus_total += 1;
                } else if ($customer->customer_type == "Commercial") {
                    $com_total += 1;
                    $com += 1;
                    $cus += 1;
                    $cus_total += 1;
                }
            }
        }
        array_push($fn, array($cusSource->source_name, $cus, $res, $com));
    }

    array_push($fn, array("Total", $cus_total, $res_total, $com_total));
    
    return $fn;
}

function getPaymentType($type) {
    switch($type) {
        case "cc":
            return "Credit Card";
        
        case "check":
            return "Check";
            
        case "cash":
            return "Cash";
    }
}

function getIndustryBusiness(){
    $business = [
        'Building Contractors' => [
            'Cabinetry' => 'Cabinetry',
            'Chimney / Fireplace' => 'Chimney / Fireplace',
            'Concrete & Asphalt' => 'Concrete & Asphalt',
            'Deck & Patio' => 'Deck & Patio',
            'Demolition' => 'Demolition',
            'Doors & Windows' => 'Doors & Windows',
            'Drywall' => 'Drywall',
            'Fencing' => 'Fencing',
            'Flooring' => 'Flooring',
            'Framer' => 'Framer',
            'General Contractor' => 'General Contractor',
            'Handy Man' => 'Handy Man',
            'Home Inspection' => 'Home Inspection',
            'HVAC' => 'HVAC',
            'Landscaper' => 'Landscaper',
            'Lawn Care' => 'Lawn Care',
            'Lighting' => 'Lighting',
            'Painter' => 'Painter',
            'Plumber' => 'Plumber',
            'Pool & Spa' => 'Pool & Spa',
            'Roofers' => 'Roofers',
            'Sewer & Septic' => 'Sewer & Septic',
            'Snow Removal' => 'Snow Removal',
            'Solar & Energy' => 'Solar & Energy',
            'Tile & Grout' => 'Tile & Grout',
            'Tree Services' => 'Tree Services'
        ],
        'Financial Services' => [
            'Accounting' => 'Accounting',
            'Appraisal' => 'Appraisal',
            'Credit Counselor' => 'Credit Counselor',
            'Financial Planner' => 'Financial Planner',
            'Insurance' => 'Insurance',
            'Lender' => 'Lender',
            'Tax Planner' => 'Tax Planner'
        ],
        'Technical Services' => [
            'Computer Services' => 'Computer Services',
            'Document Storage & Destruction' => 'Document Storage & Destruction',
            'IT & Networking' => 'IT & Networking',
            'Security Systems' => 'Security Systems'
        ],
        'Health And Beauty' => [
            'Massage' => 'Massage',
            'Barber / Stylist' => 'Barber / Stylist',
            'Make-up artist' => 'Make-up artist',
            'Costume Designer' => 'Costume Designer',
            'Fitness Instructors' => 'Fitness Instructors'
        ],
        'Transportation' => [
            'Auto Repair' => 'Auto Repair',
            'Boat Repair' => 'Boat Repair',
            'Detailing' => 'Detailing',
            'Marine Services' => 'Marine Services',
            'Pilot for hire' => 'Pilot for hire',
            'Professional Driving' => 'Professional Driving',
            'Repossession' => 'Repossession',
            'Towing' => 'Towing'
        ],
        'Organization / Cleaning' => [
            'Commercial cleaning' => 'Commercial cleaning',
            'Disaster recovery' => 'Disaster recovery',
            'Junk Removal' => 'Junk Removal',
            'Restoration' => 'Restoration',
            'Upholstery Cleaners' => 'Upholstery Cleaners'
        ],
        'Entertainment Services' => [
            'A/V Service' => 'A/V Service',
            'Booking Agent' => 'Booking Agent',
            'Catering' => 'Catering',
            'Event Planner' => 'Event Planner',
            'Music & Singing' => 'Music & Singing',
            'Party Entertainer' => 'Party Entertainer'
        ],
        'Design Services' => [
            'Interior Design' => 'Interior Design',
            'Architecture' => 'Architecture',
            'Event Photography / Videography' => 'Event Photography / Videography',
            'Graphics & Printing' => 'Graphics & Printing'
        ],
        'Other' => [
            'Arts/Antiques' => 'Arts/Antiques',
            'Athletics/GYM' => 'Athletics/GYM',
            'Childcare' => 'Childcare',
            'Car Washes' => 'Car Washes',
            'Environmental Services' => 'Environmental Services',
            'Locksmith' => 'Locksmith',
            'Movers' => 'Movers',
            'Multi level marketing' => 'Multi level marketing',
            'Pet Grooming' => 'Pet Grooming',
            'Private Security' => 'Private Security',
            'Property Manager' => 'Property Manager',
            'Real Estate' => 'Real Estate',
            'Sales' => 'Sales',
            'Tutoring' => 'Tutoring',
            'Notary' => 'Notary',
            'Laundry' => 'Laundry',
            'Install & Assemble' => 'Install & Assemble',
            'Travel Agent' => 'Travel Agent',
        ]
    ];

    return $business;
}

function getRegistrationRoles(){
    $roles = [
        'Aerospace Industry' => 'Aerospace Industry',
        'Transport Industry' => 'Transport Industry',
        'Computer Industry' => 'Computer Industry',
        'Telecommunication industry' => 'Telecommunication industry',
        'Agriculture industry' => 'Agriculture industry',
        'Construction Industry' => 'Construction Industry',
        'Education Industry' => 'Education Industry'
    ];

    return $roles;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}