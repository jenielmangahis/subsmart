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
            $url = urlUpload('users/' . $id . '.' . $CI->users_model->getRowById($id, 'img_type') . '?' . time());
        // $url = 'http://oscuz.com/nsmart/uploads/users/'.$id.'.'.$CI->users_model->getRowById($id, 'img_type').'?'.time();

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
 * Die/Stops the request if its not a 'post' requetst type
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

if (!function_exists('DateFomatDb')) {


    function DateFomatDb($date)

    {

        return date('Y-m-d', strtotime($date));
    }
}


/**
 * Currency formating
 *
 * @param int/float/string $amount
 *
 * @return string $amount formated amount with currency symbol
 *

 */

if (!function_exists('currency')) {


    function currency($amount)

    {

        return '$ ' . $amount;
    }
}


/**
 * Find & returns the vlaue if exists in db
 *
 * @param string $key key which is used to check in db - Refrence: settings table - key column
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
 * Finds and return the ipaddres of client user
 *
 * @param array $ipaddress IpAddress
 *

 */

if (!function_exists('ip_address')) {


    function ip_address()
    {

        $ipaddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP']))

            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];

        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))

            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];

        else if (isset($_SERVER['HTTP_X_FORWARDED']))

            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];

        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))

            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];

        else if (isset($_SERVER['HTTP_FORWARDED']))

            $ipaddress = $_SERVER['HTTP_FORWARDED'];

        else if (isset($_SERVER['REMOTE_ADDR']))

            $ipaddress = $_SERVER['REMOTE_ADDR'];

        else

            $ipaddress = 'UNKNOWN';

        return $ipaddress;
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
 * Redirects with error if user doesnt have the permission to passed key/module
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

        //echo '<pre>';print_r($code);die;

        if (!empty($CI->role_permissions_model->getByWhere(['role' => logged('role'), 'permission' => $code]))) {


            return true;
        }

        return false;
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

    return $CI->user->getByWhere(['comp_id' => logged('comp_id')]);
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