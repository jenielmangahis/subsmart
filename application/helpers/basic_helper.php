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
            //$url = urlUpload('users/' . $id . '.' . $CI->users_model->getRowById($id, 'profile_img') . '?' . time());
            $image_image = $CI->users_model->getRowById($id, 'profile_img');
            if( !file_exists(FCPATH."uploads/users/user-profile/" . $image_image) ){
                $url = base_url('uploads/users/default.png');
            }else{
                $url = urlUpload('users/user-profile/' . $CI->users_model->getRowById($id, 'profile_img') . '?' . time());
            }
        // $url = 'http://nsmartrac.com/uploads/users/'.$id.'.'.$CI->users_model->getRowById($id, 'img_type').'?'.time();

        return $url;
    }
}

if (!function_exists('userSignature')) {

    function userSignature($uid)
    {
        $CI  = &get_instance();
        $url = base_url('uploads/image/noimage.jpg');        
        if ($uid > 0){            
            $signature_image = $CI->users_model->getRowById($uid, 'img_signature');
            if( file_exists(FCPATH."uploads/signatures/user/$uid/" . $signature_image) ){
                $url = base_url('uploads/signatures/user/'.$uid.'/'.$signature_image);
            }
        }

        return $url;
    }
}



if (!function_exists('userProfileImage')) {

    function userProfileImage($id)
    {

        $CI = &get_instance();
        $url = urlUpload('users/user-profile/p_' . $id . '.png?' . time());
        $user = $CI->users_model->getUser($id);
        $img_ext = 'png';

        if ($user->profile_img) {
            $url = urlUpload('users/user-profile/' . $user->profile_img);
            if( !file_exists(FCPATH."uploads/users/user-profile/" . $user->profile_img) ){
                $url = urlUpload('users/default.png');
            }
        } else {
            $url = urlUpload('users/default.png');
        }

        return $url;
    }
}

if (!function_exists('userProfilePicture')) {

    function userProfilePicture($id)
    {

        $CI = &get_instance();
        $url = urlUpload('users/user-profile/p_' . $id . '.png?' . time());
        $user = $CI->users_model->getUser($id);
        $img_ext = 'png';

        if ($user->profile_img) {
            $url = urlUpload('users/user-profile/' . $user->profile_img);
            if( !file_exists(FCPATH."uploads/users/user-profile/" . $user->profile_img) ){
                $url = urlUpload('users/default.png');
            }
            return $url;
        } 
        
        return NULL;
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
            $url = urlUpload('users/businessimg_' . $CI->business_model->getRowByWhere(['id' => $id], 'user_id') . '.' . $CI->business_model->getRowByWhere(['id' => $id], 'business_image') . '?' . time());

        return $url;
    }
}

if (!function_exists('getCompanyCoverPhoto')) {

    function getCompanyCoverPhoto($company_id)
    {

        $CI         = &get_instance();
        $res = $CI->business_model->getByCompanyCoverPhoto($company_id);
        if( $res ){
            $url = urlUpload('company_cover_photo/' . $res->company_id . '/' . $res->business_cover_photo . '?' . time());
        }else{
            $url = urlUpload('company_cover_photo/default.png');
        }

        return $url;
    }
}

if (!function_exists('businessProfileImage')) {

    function businessProfileImage($id)
    {

        $CI = &get_instance();

        if( !file_exists(FCPATH.'uploads/users/business_profile/' . $id . '/' . $CI->business_model->getRowByWhere(['id' => $id], 'business_image')) ){
            $url = base_url('assets/img/onboarding/profile-avatar.png');
        }else{
            $url = base_url('uploads/users/business_profile/' . $id . '/' . $CI->business_model->getRowByWhere(['id' => $id], 'business_image') . '?' . time());
        }

        return $url;
    }
}

if (!function_exists('getCompanyBusinessProfileImage')) {

    function getCompanyBusinessProfileImage()
    {

        $CI         = &get_instance();
        $company_id = logged('company_id');
        $res = $CI->business_model->getByCompanyProfileImage($company_id);
        if( $res ){
            $url = urlUpload('users/business_profile/' . $res->id . '/' . $res->business_image . '?' . time());
        }else{
            $url = urlUpload('users/business_profile/default.png');
        }

        return $url;
    }
}

if (!function_exists('licenseImage')) {

    function licenseImage($id)
    {

        $CI = &get_instance();
        // $url = urlUpload('users/business_profile/' . $id . '.png?' . time());

        // $res= $CI->business_model->getRowByWhere(['user_id'=>$id], ['b_image']);
        // echo "<pre>fhdfhdfh"; print_r($res); die;

        if ($id != 'default'){
            $image =  $CI->business_model->getRowByWhere(['id' => $id], 'license_image');
            if( $image != '' ){
                $url = urlUpload('users/business_profile/' . $id . '/' . $image . '?' . time());
            }else{
                $url = urlUpload('users/business_profile/img_default.png');
            }
        }

        return $url;
    }
}

if (!function_exists('bondImage')) {

    function bondImage($id)
    {

        $CI = &get_instance();
        // $url = urlUpload('users/business_profile/' . $id . '.png?' . time());

        // $res= $CI->business_model->getRowByWhere(['user_id'=>$id], ['b_image']);
        // echo "<pre>fhdfhdfh"; print_r($res); die;

        if ($id != 'default'){
            $image =  $CI->business_model->getRowByWhere(['id' => $id], 'bond_image');
            if( $image != '' ){
                $url = urlUpload('users/business_profile/' . $id . '/' . $image . '?' . time());
            }else{
                $url = urlUpload('users/business_profile/img_default.png');
            }
        }

        return $url;
    }
}

if (!function_exists('insuranceImage')) {

    function insuranceImage($id)
    {

        $CI = &get_instance();
        // $url = urlUpload('users/business_profile/' . $id . '.png?' . time());

        // $res= $CI->business_model->getRowByWhere(['user_id'=>$id], ['b_image']);
        // echo "<pre>fhdfhdfh"; print_r($res); die;

        if ($id != 'default'){
            $image =  $CI->business_model->getRowByWhere(['id' => $id], 'insurance_image');
            if( $image != '' ){
                $url = urlUpload('users/business_profile/' . $id . '/' . $image . '?' . time());
            }else{
                $url = urlUpload('users/business_profile/img_default.png');
            }
        }

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

if (!function_exists('adminLogged')) {


    function adminLogged($key = false)

    {

        $CI = &get_instance();
        
        $logged = !empty($CI->session->userdata('admin_login')) ? $CI->users_model->getById($CI->session->userdata('admin_logged')['id']) : false;


        if (!$logged) {

            $logged = $CI->users_model->getById(json_decode(get_cookie('admin_logged'))->id);
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

function getValidIpAddress(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
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

if (!function_exists('getLoggedNameInitials')) {

    function getLoggedNameInitials($userId)
    {
        $finalUserId = ($userId) ? $userId : logged('id');
        $CI =& get_instance();
        $CI->load->model('Users_model', 'user_model');
        $result = $CI->user_model->getByWhere(array('id' => $finalUserId));

        return ucwords($result[0]->FName[0]).ucwords($result[0]->LName[0]);
    }
}

if (!function_exists('getCustomerFullName')) {

    function getCustomerFullName($customerId)
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('customers');
        $CI->db->where('id', $customerId);
        $customer = $CI->db->get()->row();

        if ($customer) {
            return ucwords($customer->contact_name);
        }
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

        if ($address) {
            return ucwords($address->address1) . ' ' .ucwords($address->address2) . ' ' . ucwords($address->city . ' ' . ucwords($address->state));
        }
    }
}

if (!function_exists('getLoggedUserID')) {


    function getLoggedUserID()
    {

        $CI = &get_instance();
        $user = (object)$CI->session->userdata('logged');
        return $user->id ?? null;
    }
}

if (!function_exists('getLoggedIsPlanActive')) {


    function getLoggedIsPlanActive()
    {

        $CI = &get_instance();
        $user = $CI->session->userdata('logged');

        if (!is_null($user)) {
            return ((object) $user)->is_plan_active;
        }
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

if (!function_exists('isCompanyPlanActive')) {


    function isCompanyPlanActive()
    {

        $ci = &get_instance();
        $ci->load->library('session');
        $is_plan_active = $ci->session->userdata('is_plan_active');
        return $is_plan_active;
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
        $company_id = logged('company_id');

        return $CI->db->query('select * from business_profile where id = ' . $company_id);
    }
}
if (!function_exists('convertDecimal_to_Time')){
    function convertDecimal_to_Time($dec,$requet){
        $CI = &get_instance();

        return $CI->timesheet_model->convertDecimal_to_Time($dec,$requet);
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

        if($company->num_rows() > 0) {
            $company = $company->row();
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
                if(!file_exists('./uploads/' . $company->folder_name . '/')){
                    mkdir('./uploads/' . $company->folder_name . '/');
                }

                $company_folder = $company->folder_name;
            }
        }

        return $company_folder;
    }
}

if (!function_exists('getFolders')) {

    function getFolders($parent_id = -1,
                        $getallparent = false,
                        $getallchild = false,
                        $asArray = false,
                        $trashed = false,
                        $ofUser = false,
                        $ofCategorized = false)
    {
        $CI = &get_instance();
        $uid = logged('id');
        $company_id = logged('company_id');

        $parent_filter = '';
        $softdelete = '';
        $user_filter = '';
        $category_filter = '';

        if($parent_id >= 0){
            $parent_filter = 'and a.parent_id = ' . $parent_id . ' ';
        } else if($getallparent){
            $parent_filter = 'and (a.parent_id = 0 or a.parent_id is null) ';
        } else if($getallchild){
            $parent_filter = 'and (a.parent_id <> 0 and a.parent_id is not null) ';
        }

        if(!$trashed){
            $softdelete = '<= 0';
        } else {
            $softdelete = '>= 1';
        }

        if($ofUser){
            $user_filter = 'and a.created_by = '. $uid . ' ';
        }

        if($ofCategorized){
            $category_filter = 'and (a.category_id is not null and a.category_id > 0) ';
        } else {
            $category_filter = 'and (a.category_id is null or a.category_id <= 0) ';
        }

        $sql = 'select ' .

               'a.*, '.
               'b.FName as FCreatedBy, b.LName as LCreatedBy, '.
               'c.folder_name as c_folder, '.
               '(ifnull(d.total_sub_folders,0) + ifnull(e.total_files,0)) as `total_contents`, '.
               'f.category_name, '.
               'f.category_desc '.

               'from file_folders a '.
               'left join users b on b.id = a.created_by '.
               'left join business_profile c on c.id = a.company_id '.
               'left join('.

                 'select parent_id, sum(if(softdelete = 1,0,1)) as `total_sub_folders` from file_folders group by parent_id'.

               ') d on d.parent_id = a.folder_id '.
               'left join('.

                 'select folder_id, sum(if(softdelete = 1,0,1)) as `total_files` from filevault group by folder_id'.
               ') e on e.folder_id = a.folder_id '.

               'left join file_folders_categories f on f.category_id = a.category_id '.

               'where a.company_id = ' . $company_id . ' and a.softdelete '. $softdelete . ' ' . $parent_filter . $user_filter . $category_filter .

               'order by create_date ASC';

        if($asArray){
            $return = $CI->db->query($sql)->result_array();
        } else {
            $return = $CI->db->query($sql);
        }

        return $return;
    }

}

if (!function_exists('getFiles')) {

    function getFiles($folder_id, $asArray = false, $trashed = false, $ofUser = false, $ofCategorized = false){
        $CI = &get_instance();
        $uid = logged('id');
        $company_id = logged('company_id');

        $softdelete = '';
        $user_filter = '';
        $category_filter = '';

        if(!$trashed){
            $softdelete = '<= 0 and a.folder_id = ' . $folder_id . ' ';
        } else {
            $softdelete = '>= 1 ';
        }

        if($ofUser){
            $user_filter = 'and a.user_id = '. $uid . ' ';
        }

        if($ofCategorized){
            $category_filter = 'and (a.category_id is not null and a.category_id > 0) ';
        } else {
            $category_filter = 'and (a.category_id is null or a.category_id <= 0) ';
        }

        $sql = 'select ' .

               'a.*, '.
               'b.FName as FCreatedBy, b.LName as LCreatedBy, '.
               'c.folder_name, '.
               'd.category_name, '.
               'd.category_desc '.

               'from filevault a '.
               'left join users b on b.id = a.user_id '.
               'left join business_profile c on c.id = a.company_id '.
               'left join file_folders_categories d on d.category_id = a.category_id '.

               'where a.company_id = ' . $company_id . ' and a.softdelete '. $softdelete . $user_filter . $category_filter .

               'order by created ASC';

        if($asArray){
            $return = $CI->db->query($sql)->result_array();
        } else {
            $return = $CI->db->query($sql);
        }

        return $return;
    }

}

if (!function_exists('searchFilesOrFolders')) {

    function searchFilesOrFolders($keyword, $findfolders = 0, $findfiles = 0, $ofUser = false){
        $CI = &get_instance();
        $uid = logged('id');
        $company_id = logged('company_id');

        $user_filter_folder = '';
        $user_filter_file = '';

        if($ofUser){
            $user_filter_folder = 'and created_by = ' . $uid . ' ';
            $user_filter_file = 'and user_id = '. $uid . ' ';
        }

        $sql_folders = 'select '.

                       'parent_id as in_folder, '.
                       'concat("/root",path) as `full_path`, '.
                       'folder_name as searched_title '.

                       'from file_folders '.

                       'where company_id = ' . $company_id . ' and softdelete <= 0 '. $user_filter_folder .
                          'and (lower(folder_name) like "%'. $keyword .'%" '.
                          'or lower(description) like "%'. $keyword .'%" '.
                          'or lower(path) like "%'. $keyword .'%" '.
                          'or create_date like "%'. $keyword .'%")';

        $sql_files = 'select '.

                     'folder_id as in_folder, '.
                     'concat("/root",file_path) as `full_path`, '.
                     'title as searched_title '.

                     'from filevault '.

                     'where company_id = ' . $company_id . ' and softdelete <= 0 '. $user_filter_file .
                        'and (lower(title) like "%'. $keyword .'%" '.
                        'or lower(description) like "%'. $keyword .'%" '.
                        'or lower(file_path) like "%'. $keyword .'%" '.
                        'or created like "%'. $keyword .'%")';

        $files_and_folders = array(
            'folders' => array(),
            'files' => array()
        );

        if($findfolders > 0){
            $files_and_folders['folders'] = $CI->db->query($sql_folders)->result_array();
        }

        if($findfiles > 0){
            $files_and_folders['files'] = $CI->db->query($sql_files)->result_array();
        }

        return $files_and_folders;

    }

}
if (!function_exists('getTimesheetNotification')){

    function getTimesheetNotification(){
        $CI = &get_instance();
        return $CI->timesheet_model->getTSNotification();
    }
}
if (!function_exists('getNotificationCount')){

    function getNotificationCount(){
        $CI = &get_instance();
        return $CI->timesheet_model->getNotifyCount();
    }
}
if (!function_exists('getClockInSession')){
    function getClockInSession(){
        $CI = &get_instance();
        return $CI->timesheet_model->getClockInSession();
    }
}
if (!function_exists('getEmployeeLogs')){
    function getEmployeeLogs($attendance_id){
        $CI = &get_instance();
//        return $CI->timesheet_model->getTSLogsByUser();
        return $CI->timesheet_model->getUserLogs($attendance_id);
    }
}
if (!function_exists('getUserLogs')){
    function getUserLogs($attendance_id){
        $CI = &get_instance();
//        return $CI->timesheet_model->getTSLogsByUser();
        return $CI->timesheet_model->getUserLogs($attendance_id);
    }
}
if (!function_exists('getEmployeeAttendance')){
    function getEmployeeAttendance(){
        $CI = &get_instance();
        return $CI->timesheet_model->getUserAttendance();
    }
}
if (!function_exists('getEmpTSsettings')){
    function getEmpTSsettings(){
        $CI = &get_instance();
        return $CI->timesheet_model->getTimeSettingsByUser();
    }
}
if (!function_exists('getNotification')){
    function getNotification($user_id){
        $CI = &get_instance();
        return $CI->timesheet_model->getNotification($user_id);
    }
}
if (!function_exists('getEmpSched')){
    function getEmpSched(){
        $CI = &get_instance();
        return $CI->timesheet_model->getTimesheetDayByUser();
    }
}
if (!function_exists('getNewTasks')){

    function getNewTasks(){
        $CI = &get_instance();
        $uid = logged('id');
        $company_id = logged('company_id');

        $sql = 'select '.

               'a.task_id, '.
               'a.subject, '.
               'a.date_created '.

               'from tasks a '.
               'left join tasks_participants b on b.task_id = a.task_id '.

               'where a.company_id = ' . $company_id . ' ' .
                 'and b.user_id = ' . $uid . ' ' .
                 'and b.is_assigned = 1 ' .
                 'and a.view_count <= 0';

        return $CI->db->query($sql)->result_array();
    }
}
if (!function_exists('getTasks')){

    function getTasks(){
        $CI = &get_instance();
        $uid = logged('id');

        $sql = 'select '.
               'a.task_id, '.
               'a.subject, '.
               'a.date_created, '.
               //'DATE_FORMAT(a.estimated_date_complete,"%b %d, %Y %h:%i:%s") as estimated_date_complete_formatted, '.
               //'DATE_FORMAT(a.date_created,"%b %d, %Y %h:%i:%s") as date_created_formatted, '.
               'DATE_FORMAT(a.estimated_date_complete,"%b %d, %Y") as estimated_date_complete_formatted, '.
               'DATE_FORMAT(a.date_created,"%b %d, %Y") as date_created_formatted, '.
               'b.status_color, '.
               'b.status_text '.
               'from tasks a '.
               'left join tasks_status b on b.status_id = a.status_id '.
               'left join tasks_participants c on c.task_id = a.task_id '.

               'where a.created_by = '. $uid . ' ' .
                  'or c.user_id = '. $uid . ' ' .

               'group by a.task_id '.

               'order by date_created desc';

        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('getCompanyNewTasks')){

    function getCompanyNewTasks(){
        $CI = &get_instance();
        $company_id = logged('company_id');
        $date_today = date("Y-m-d");

        $sql = 'select '.
               'a.task_id, '.
               'a.subject, '.
               'a.date_created, '.
               //'DATE_FORMAT(a.estimated_date_complete,"%b %d, %Y %h:%i:%s") as estimated_date_complete_formatted, '.
               //'DATE_FORMAT(a.date_created,"%b %d, %Y %h:%i:%s") as date_created_formatted, '.
               'DATE_FORMAT(a.estimated_date_complete,"%b %d, %Y") as estimated_date_complete_formatted, '.
               'DATE_FORMAT(a.date_created,"%b %d, %Y") as date_created_formatted '.
               'from tasks a '.
               ' where a.company_id = '. $company_id . 
               ' AND DATE_FORMAT(a.date_created,"%Y-%m-%d")="' . $date_today . '"' .
               ' AND a.status_id <> 6' .
               ' order by a.date_created desc';

        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('getAllTasks')){

    function getAllTasks(){
        $CI = &get_instance();
        $uid = logged('id');

        $sql = 'select '.

               'a.task_id, '.
               'a.subject, '.
               'a.date_created, '.
               'DATE_FORMAT(a.date_created,"%b %d, %Y %h:%i:%s") as date_created_formatted, '.

               'b.status_text '.

               'from tasks a '.
               'left join tasks_status b on b.status_id = a.status_id '.
               'left join tasks_participants c on c.task_id = a.task_id '.
               'group by a.task_id '.

               'order by date_created desc';

        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('getAllCompanyTasks')){

    function getAllCompanyTasks($company_id){
        $CI = &get_instance();
        $uid = logged('id');
        $sql = 'select '.

               'a.task_id, '.
               'a.subject, '.
               'a.date_created, '.
               'DATE_FORMAT(a.date_created,"%b %d, %Y %h:%i:%s") as date_created_formatted, '.

               'b.status_text '.

               'from tasks a '.
               'left join tasks_status b on b.status_id = a.status_id '.
               'left join tasks_participants c on c.task_id = a.task_id '.

               'where a.company_id = '. $company_id . ' ' .

               'group by a.task_id '.

               'order by date_created desc';

        return $CI->db->query($sql)->result();
    }

}

if (!function_exists('getUserFileVaultPermissions')){

    function getUserFileVaultPermissions(){
        $CI = &get_instance();

        $company_id = logged('company_id');
        $uid = logged('id');
        $role_id = logged('role');

        $user_permissions = $CI->file_folders_permissions_users_model->getRowByWhere(array('user_id' => $uid), 0, true);
        $role_permissions = $CI->file_folders_permissions_roles_model->getRowByWhere(array('role_id' => $role_id), 0, true);
        if(!empty($user_permissions)){
            $consider_no_user_permission = (($user_permissions['create_folder'] == 0) &&
                                            ($user_permissions['add_file'] == 0) &&
                                            ($user_permissions['edit_folder_file'] == 0) &&
                                            ($user_permissions['move_folder_file'] == 0) &&
                                            ($user_permissions['trash_folder_file'] == 0) &&
                                            ($user_permissions['remove_folder_file'] == 0));
            if(!$consider_no_user_permission){
                $user_permissions['role_id'] = $role_id;
                return $user_permissions;
            } else if(!empty($role_permissions)){
                $role_permissions['user_id'] = $uid;
                return $role_permissions;
            } else {
                return array(
                    'create_folder' => 0,
                    'add_file' => 0,
                    'edit_folder_file' => 0,
                    'move_folder_file' => 0,
                    'trash_folder_file' => 0,
                    'remove_folder_file' => 0,
                    'user_id' => $uid,
                    'role_id' => $role_id
                );
            }
        } else if(!empty($role_permissions)){
            $role_permissions['user_id'] = $uid;
            return $role_permissions;
        } else {
            return array(
                'create_folder' => 0,
                'add_file' => 0,
                'edit_folder_file' => 0,
                'move_folder_file' => 0,
                'trash_folder_file' => 0,
                'remove_folder_file' => 0,
                'user_id' => $uid,
                'role_id' => $role_id
            );
        }
    }

}

function getFolderManagerView($isMain = true, $isMyLibrary = false, $isBusinessFormTemplates = false){
    $CI = &get_instance();

    $company_id = logged('company_id');
    $user_fname = logged('FName');
    $user_lname = logged('LName');

    $company = getCompany()->row();

    $params = array(
        'isMain' => $isMain,
        'isMyLibrary' => $isMyLibrary,
        'isBusinessFormTemplates' => $isBusinessFormTemplates,
        'company_name' => $company->business_name,
        'user_fname' => $user_fname,
        'user_lname' => $user_lname,
        'categories' => $CI->file_folders_categories_model->getByWhere(array('company_id' => $company_id)),
        'permissions' => getUserFileVaultPermissions()
    );

    return $CI->load->view('modals/folder_manager', $params, TRUE);
}
function getFolderManagerView_v2($isMain = true, $isMyLibrary = false, $isBusinessFormTemplates = false){
    $CI = &get_instance();

    $company_id = logged('company_id');
    $user_fname = logged('FName');
    $user_lname = logged('LName');

    $company = getCompany()->row();

    $params = array(
        'isMain' => $isMain,
        'isMyLibrary' => $isMyLibrary,
        'isBusinessFormTemplates' => $isBusinessFormTemplates,
        'company_name' => $company->business_name,
        'user_fname' => $user_fname,
        'user_lname' => $user_lname,
        'categories' => $CI->file_folders_categories_model->getByWhere(array('company_id' => $company_id)),
        'permissions' => getUserFileVaultPermissions()
    );

    return $CI->load->view('modals/v2/folder_manager', $params, TRUE);
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
    $customer = $CI->customer->getCustomer($customer_id);
    return $customer;
}

function get_users_by_id($user_id, $key = '')
{
    $CI =& get_instance();
    $CI->load->model('Users_model', 'user');

    if (!empty($key)) {
        return $CI->user->getUser($user_id)->$key;
    }

    return $CI->user->getUser($user_id);
}

/**
 * return customer acs_profile details based on ID
 */
function acs_prof_get_customer_by_prof_id($customer_id)
{
    //Get Customer data
    $CI =& get_instance();
    $CI->load->model('AcsProfile_model');
    return $CI->AcsProfile_model->getByProfId($customer_id);
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

    if ($value) {
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
 * @param $event
 * @param $customer
 * @return string
 */
function acs_prof_make_calender_event_label($settings, $event, $customer)
{
    $settings = unserialize($settings);
    $date = date('a', strtotime($event->start_time));
    $date = substr($date, -2, 1);
    $title = date('g', strtotime($event->start_time)) . $date;

    if (!empty($settings['work_order_show_customer'])) {
        $title .= ' ' . $customer->first_name . " " . $customer->last_name . ', ' . $customer->phone_m;
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
    $role = logged('role');
    $company_id = logged('company_id');

    $CI =& get_instance();
    $CI->load->model('Estimate_model', 'estimate_model');

    if( $role == 1 || $role == 2){
        if (!empty($status)) {
            if ($count_only) {

                return count($CI->estimate_model->getByWhere(array('company_id' => $company_id, 'status' => $status)));
            } else {
                return $CI->estimate_model->getByWhere(array('company_id' => $company_id, 'status' => $status));
            }
        }

        if ($count_only) {
            return count($CI->estimate_model->getByWhere(array()));
        }else{
            return $CI->estimate_model->getByWhere(array());
        }
    }else{
        if (!empty($status)) {
            if ($count_only) {

                return count($CI->estimate_model->getByWhere(array('company_id' => $company_id, 'status' => $status)));
            } else {
                return $CI->estimate_model->getByWhere(array('company_id' => $company_id, 'status' => $status));
            }
        }

        if ($count_only) {
            return count($CI->estimate_model->getByWhere(array('company_id' => $company_id)));
        }else{
            return $CI->estimate_model->getByWhere(array('company_id' => $company_id));
        }
    }

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

function get_format_date_with_day($date)
{
    $new_date=date_create($date);
    return date_format($new_date,"D M d, Y");
}

function get_format_time($date)
{
    $new_date=date_create($date);
    return date_format($new_date,"g:i a");

    $effectiveDate = strtotime("+40 minutes", strtotime($idate));
}

function get_format_time_plus_hours($date)
{
    $effectiveDate = strtotime("+120 minutes", strtotime($date));
    return date("g:i a",$effectiveDate);
}

function check_upcoming_date($date)
{
    $tomorrow = date('Y-m-d', strtotime(' +1 day'));
    $new_date = date_format(date_create($date),"Y-m-d");

    $dateTimestamp1 = strtotime($tomorrow);
    $dateTimestamp2 = strtotime($new_date);

    // dd($tomorrow . " " . $new_date);
    if ($dateTimestamp1 == $dateTimestamp2)
        return true;
    else
        return false;
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
function get_customer_invoice_amount($type, $customer_id)
{
    $CI =& get_instance();
    $CI->load->model('Invoice_model', 'invoice_model');
    $company_id = logged('company_id');
    $result = 0;
    $start_date = date("Y") . "-01-01";
    $end_date = date("Y") . "-12-31";

    switch ($type) {
        case "year":
            $result = $CI->invoice_model->getByWhere(array('customer_id' => $customer_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date));
            return total_invoice_amount($result);

        case "pending":
            $result = $CI->invoice_model->getByWhere(array('customer_id' => $customer_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Draft'));
            return total_invoice_amount($result);

        default:
            $result = $CI->invoice_model->getByWhere(array('customer_id' => $customer_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status !=' => 'Draft'));
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
        // if ($invoice->invoice_totals) {
            // $totals = unserialize($invoice->invoice_totals);
            // $grand_total += floatval($totals['grand_total']);
            $grand_total += $invoice->grand_total;
        // }
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

    // switch ($type) {
    //     case "Paid":
            $result = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid'));
            return total_invoice_amount($result);
    // }
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

        case "expense-by-month-by-vendor":
            $title = "Expense by Vendor";
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

    if ($result) {
        return ucwords($result[0]->email);
    }
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
                    
                case "paypal":
                    $paypal += floatval($result->invoice_amount);
                    break;
            }
        }

        $grand_total += floatval($result->invoice_amount);
    }

    ($total > 0) ? array_push($fn, array($total)) : $total = 0;
    ($cc > 0) ? array_push($fn, array("Credit Card", dollar_format($cc))) : $cc = 0;
    ($cash > 0) ? array_push($fn, array("Cash", dollar_format($cash))) : $cash = 0;
    ($check > 0) ? array_push($fn, array("Check", dollar_format($check))) : $check = 0;
    ($paypal > 0) ? array_push($fn, array("Paypal", dollar_format($paypal))) : $paypal = 0;

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
            // if (!in_array($result->customer_id, $company_id)) {
            //     array_push($company_id, $result->customer_id);
            //     array_push($fn, array(get_customer_by_id($result->customer_id)->contact_name, '', '', ''));
            //     array_push($fn, array('', $result->payment_date, $result->invoice_number, getPaymentType($result->payment_method), dollar_format($result->invoice_amount)));
            // } else {
                array_push($fn, array('', $result->payment_date, $result->invoice_number, getPaymentType($result->payment_method), dollar_format($result->invoice_amount)));
            // }
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
            $total_invoice += floatval($result->grand_total);
            $invoices = $CI->payment_records_model->getByWhere(array("invoice_number" => $result->invoice_number));
            foreach ($invoices as $inv) {
                $tip_invoice += $inv->invoice_tip;
                $monthly_tip += $inv->invoice_tip;
                $paid_invoice += $inv->invoice_amount;
                $monthly_paid += $inv->invoice_amount;
            }
            $monthly_due = floatval(floatval($result->grand_total) - floatval($monthly_paid));
            $due_invoice += $monthly_due;
            $new_date=date_format(date_create($result->date_issued),"d-M-Y");
            array_push($fn, array($new_date,"Invoice #".$result->invoice_number. "(".$result->status.")", get_customer_by_id($result->customer_id)->first_name .' '.get_customer_by_id($result->customer_id)->last_name, dollar_format(floatval($result->grand_total)), dollar_format($monthly_paid), dollar_format($monthly_due), dollar_format($monthly_tip), dollar_format($monthly_fees)));
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

function getInvoiceByDate_($start_date, $end_date, $month) {
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
                    // $total_invoice += floatval($totals1['grand_total']);
                    $total_invoice += floatval($result->grand_total);
                    // $grand_total += floatval($totals1['grand_total']);
                    $grand_total += floatval($result->grand_total);
                }
            }
            array_push($fn, array(get_customer_by_id($result->customer_id)->first_name .' '.get_customer_by_id($result->customer_id)->last_name, substr(get_customer_by_id($result->customer_id)->customer_type,0,1), $num_invoice, $paid_invoice, dollar_format($total_invoice)));
        }
    }

    array_push($fn, array("Total", "", $grand_num_invoice, $grand_paid_invoice, dollar_format($grand_total)));
    return $fn;
}

function getPaymentByItem_old($start_date, $end_date) {
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

function getPaymentByItem($start_date, $end_date) {
    $CI =& get_instance();
    // $CI->load->database();
    $CI->load->model('Invoice_model', 'invoice_model');
    $CI->load->model('Invoice_items_model', 'invoice_items_model');
    $CI->load->model('Items_model', 'items_model');
    $company_id = logged('company_id');

    // $CI->db->where('company_id', $company_id);
    // $CI->db->where('date_issued >', $start_date);
    // $CI->db->where('date_issued <', $end_date);
    // $CI->db->where('status', 'Paid');
    // $CI->db->where('is_recurring', 0);
    // $results = $CI->db->get('invoices');
    

    $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid', 'is_recurring' => 0));
    $fn = [];
    $comp_user = [];
    $grand_total = 0;
    $grand_num_invoice = 0;
    $grand_paid_invoice = 0;
    $item = 0;
    

    foreach ($results as $result) {
        $items = unserialize($result2->invoice_items);


        if (!in_array($result->customer_id, $comp_user)) {
            array_push($comp_user, $result->customer_id);
            $num_invoice = 0;
            $total_invoice = 0;
            $paid_invoice = 0;

            foreach ($results as $result2) {
                if ($result2->customer_id === $result->customer_id) {
                    $item += 1;
                    $num_invoice += 1;
                    $paid_invoice += 1;
                    $grand_num_invoice += 1;
                    // $grand_paid_invoice += 1;

                    $totals1 = unserialize($result2->invoice_totals);
                    $total_invoice += floatval($totals1['grand_total']);
                    // $grand_total += floatval($result2->grand_total);
                }
            }
            // array_push($fn, array(get_customer_by_id($result->customer_id)->contact_name, substr(get_customer_by_id($result->customer_id)->first_name,0), $num_invoice, $paid_invoice, dollar_format($total_invoice)));
            
        
        $items = $CI->invoice_items_model->getByWhere(array('invoice_id' => $result->id));
        foreach($items as $itemDet)
        {
            $itemsName = $CI->items_model->getByWhere(array('id' => $itemDet->items_id));
            foreach($itemsName as $name)
            {
                $title = $name->title;
                $grand_total += floatval($itemDet->total);
                $grand_paid_invoice += $itemDet->qty;
                
                array_push($fn, array($title, $result->invoice_number, $result->date_issued, $itemDet->qty, dollar_format($itemDet->total)));
            }
        }

            // array_push($fn, array(get_customer_by_id($result->customer_id)->first_name, $result->invoice_number, $result->date_issued, $paid_invoice, dollar_format($result->grand_total)));
            // array_push($fn, array($title, $result->invoice_number, $result->date_issued, $paid_invoice, dollar_format($result->grand_total)));
        }
    }

    array_push($fn, array("Total", "", "", $grand_paid_invoice, dollar_format($grand_total)));
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
                        $totals = unserialize($result1->grand_total);
                        $total_invoice += floatval($result1->grand_total);
                        $invoices = $CI->payment_records_model->getByWhere(array("invoice_number" => $result1->invoice_number));
                        foreach ($invoices as $inv) {
                            $tip_invoice += $inv->invoice_tip;
                            $monthly_tip += $inv->invoice_tip;
                            $paid_invoice += $inv->grand_total;
                            $monthly_paid += $inv->grand_total;
                        }
                        $monthly_due = floatval(floatval($totals['grand_total']) - floatval($monthly_paid));
                        $due_invoice += $monthly_due;
                        $new_date=date_format(date_create($result1->date_issued),"d-M-Y");
                        array_push($fn, array($new_date,"Invoice #".$result1->invoice_number. "(".$result1->status.")", get_customer_by_id($result1->customer_id)->first_name, dollar_format(floatval($result1->grand_total)), dollar_format($monthly_paid), dollar_format($monthly_due), dollar_format($monthly_tip), dollar_format($monthly_fees)));
                    }
                }
                $fn[count($fn) - ($counter + 1)] = array_merge($fn[count($fn) - ($counter + 1)], array($num_invoice, "", dollar_format($total_invoice), dollar_format($paid_invoice), dollar_format($due_invoice), dollar_format($tip_invoice), dollar_format($fees_invoice)));
            }
        }
    }

    return $fn;
}

function getworkOrderByEmployee($start_date, $end_date) 
{
    $CI =& get_instance();
    // $CI->load->database();
    $CI->load->model('Invoice_model', 'invoice_model');
    // $CI->load->model('Invoice_items_model', 'invoice_items_model');
    // $CI->load->model('Items_model', 'items_model');
    $CI->load->model('Jobs_model', 'jobs_model'); //jobs
    $CI->load->model('Users_model', 'user_model');

    $company_id = logged('company_id');
    // $results = $CI->user_model->getByWhere(array('company_id' => $company_id, 'date_hired >=' => $start_date, 'date_hired <=' => $end_date, 'status' => '1'));
    $results = $CI->user_model->getByWhere(array('company_id' => $company_id));

    // $CI->db->where('company_id', $company_id);
    // $CI->db->where('date_issued >', $start_date);
    // $CI->db->where('date_issued <', $end_date);
    // $CI->db->where('status', 'Paid');
    // $CI->db->where('is_recurring', 0);
    // $results = $CI->db->get('invoices');
    

    $resultsJobs = $CI->jobs_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Completed'));
    $fn = [];
    // $comp_user = [];
    // $grand_total = 0;
    // $grand_num_invoice = 0;
    // $grand_paid_invoice = 0;
    // $item = 0;
    

    foreach ($results as $result) {
        // $items = unserialize($result2->invoice_items);


        // if (!in_array($result->id, $comp_user)) {
        //     array_push($comp_user, $result->employee_id);
        //     $num_invoice = 0;
        //     $total_invoice = 0;
        //     $paid_invoice = 0;

            // foreach ($results as $result2) {
            //     if ($result2->customer_id === $result->customer_id) {
            //         $item += 1;
            //         $num_invoice += 1;
            //         $paid_invoice += 1;
            //         $grand_num_invoice += 1;
            //         // $grand_paid_invoice += 1;

            //         $totals1 = unserialize($result2->invoice_totals);
            //         $total_invoice += floatval($totals1['grand_total']);
            //         // $grand_total += floatval($result2->grand_total);
            //     }
            // }
            // array_push($fn, array(get_customer_by_id($result->customer_id)->contact_name, substr(get_customer_by_id($result->customer_id)->first_name,0), $num_invoice, $paid_invoice, dollar_format($total_invoice)));
            
        
        $jobs = $CI->jobs_model->getByWhere(array('employee_id' => $result->id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date));
        foreach($jobs as $job)
        {
            $invoices = $CI->invoice_model->getByWhere(array('job_number' => $job->job_number, 'status' => 'Paid'));
            foreach($invoices as $inv)
            {
                array_push($fn, array($result->FName.' '.$result->LName, $job->job_number, dollar_format($inv->grand_total), dollar_format($inv->grand_total)));
            }
            // array_push($fn, array($result->FName.' '.$result->LName, "", dollar_format($itemDet->grand_total), dollar_format($itemDet->grand_total)));
            // array_push($fn, array($result->FName.' '.$result->LName, $job->job_number, "", ""));
        }

        // array_push($fn, array($result->FName.' '.$result->LName, $result->job_number, "", ""));

            // array_push($fn, array(get_users_by_id($result->employee_id)->FName.' '.get_users_by_id($result->employee_id)->LName , $result->job_number, "", $paid_invoice, dollar_format($result->grand_total)));
            // array_push($fn, array($title, $result->invoice_number, $result->date_issued, $paid_invoice, dollar_format($result->grand_total)));
        // }
        // array_push($fn, array(get_users_by_id($result->employee_id)->FName.' '.get_users_by_id($result->employee_id)->LName , $result->job_number, "", $paid_invoice, dollar_format($result->grand_total)));
    }

    // array_push($fn, array(get_users_by_id($result->employee_id)->FName.' '.get_users_by_id($result->employee_id)->LName, "", $grand_paid_invoice, dollar_format($grand_total)));
    // array_push($fn, array($result->job_number, "", "", $grand_paid_invoice, dollar_format($grand_total)));
    return $fn;
}

function getworkOrderByStatus($start_date, $end_date)
{
    $CI =& get_instance();
    // $CI->load->database();
    $CI->load->model('Invoice_model', 'invoice_model');
    // $CI->load->model('Invoice_items_model', 'invoice_items_model');
    // $CI->load->model('Items_model', 'items_model');
    $CI->load->model('Jobs_model', 'jobs_model'); //jobs
    $CI->load->model('Workorder_model', 'workorder_model');

    $company_id = logged('company_id');
    $results = $CI->workorder_model->getByWhere(array('company_id' => $company_id));

    $resultsJobs = $CI->jobs_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Completed'));
    $fn = [];
    // $comp_user = [];
    // $grand_total = 0;
    // $grand_num_invoice = 0;
    // $grand_paid_invoice = 0;
    // $item = 0;
    

    foreach ($results as $result) {
        
        // $jobs = $CI->jobs_model->getByWhere(array('employee_id' => $result->id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date));
        // foreach($jobs as $job)
        // {
        //     $invoices = $CI->invoice_model->getByWhere(array('job_number' => $job->job_number, 'status' => 'Paid'));
        //     foreach($invoices as $inv)
        //     {
                array_push($fn, array($result->work_order_number, $result->date_issued, get_customer_by_id($result->customer_id)->first_name .' '. get_customer_by_id($result->customer_id)->last_name, $result->status));
            // }
            // array_push($fn, array($result->FName.' '.$result->LName, "", dollar_format($itemDet->grand_total), dollar_format($itemDet->grand_total)));
            // array_push($fn, array($result->FName.' '.$result->LName, $job->job_number, "", ""));
        // }

    }
    return $fn;
}

function getcustomerTaxByMonth($start_date, $end_date, $month) {
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

function getworkOrderByEmployee_old($start_date, $end_date, $month) 
{
    $CI =& get_instance();
    // $CI->load->database();
    $CI->load->model('Invoice_model', 'invoice_model');
    // $CI->load->model('Invoice_items_model', 'invoice_items_model');
    // $CI->load->model('Items_model', 'items_model');
    $CI->load->model('Jobs_model', 'jobs_model'); //jobs
    $CI->load->model('Users_model', 'user_model');

    $company_id = logged('company_id');
    $results = $CI->user_model->getByWhere(array('company_id' => $company_id));

    // $CI->db->where('company_id', $company_id);
    // $CI->db->where('date_issued >', $start_date);
    // $CI->db->where('date_issued <', $end_date);
    // $CI->db->where('status', 'Paid');
    // $CI->db->where('is_recurring', 0);
    // $results = $CI->db->get('invoices');
    

    $resultsJobs = $CI->jobs_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Completed'));
    $fn = [];
    $comp_user = [];
    $grand_total = 0;
    $grand_num_invoice = 0;
    $grand_paid_invoice = 0;
    $item = 0;
    

    foreach ($results as $result) {
        // $items = unserialize($result2->invoice_items);


        if (!in_array($result->employee_id, $comp_user)) {
            array_push($comp_user, $result->employee_id);
            $num_invoice = 0;
            $total_invoice = 0;
            $paid_invoice = 0;

            // foreach ($results as $result2) {
            //     if ($result2->customer_id === $result->customer_id) {
            //         $item += 1;
            //         $num_invoice += 1;
            //         $paid_invoice += 1;
            //         $grand_num_invoice += 1;
            //         // $grand_paid_invoice += 1;

            //         $totals1 = unserialize($result2->invoice_totals);
            //         $total_invoice += floatval($totals1['grand_total']);
            //         // $grand_total += floatval($result2->grand_total);
            //     }
            // }
            // array_push($fn, array(get_customer_by_id($result->customer_id)->contact_name, substr(get_customer_by_id($result->customer_id)->first_name,0), $num_invoice, $paid_invoice, dollar_format($total_invoice)));
            
        
        $items = $CI->invoice_model->getByWhere(array('job_number' => $result->job_number));
        foreach($items as $itemDet)
        {
            // $itemsName = $CI->items_model->getByWhere(array('id' => $itemDet->items_id));
            // foreach($itemsName as $name)
            // {
            //     $title = $name->title;
            //     $grand_total += floatval($itemDet->total);
            //     $grand_paid_invoice += $itemDet->qty;
                
            //     // array_push($fn, array($title, $result->invoice_number, $result->date_issued, $itemDet->qty));
            // }
            array_push($fn, array($result->FName.' '.$result->LName, $result->job_number, dollar_format($itemDet->grand_total), dollar_format($itemDet->grand_total)));
        }

            // array_push($fn, array(get_users_by_id($result->employee_id)->FName.' '.get_users_by_id($result->employee_id)->LName , $result->job_number, "", $paid_invoice, dollar_format($result->grand_total)));
            // array_push($fn, array($title, $result->invoice_number, $result->date_issued, $paid_invoice, dollar_format($result->grand_total)));
        }
        // array_push($fn, array(get_users_by_id($result->employee_id)->FName.' '.get_users_by_id($result->employee_id)->LName , $result->job_number, "", $paid_invoice, dollar_format($result->grand_total)));
    }

    // array_push($fn, array(get_users_by_id($result->employee_id)->FName.' '.get_users_by_id($result->employee_id)->LName, "", $grand_paid_invoice, dollar_format($grand_total)));
    // array_push($fn, array($result->job_number, "", "", $grand_paid_invoice, dollar_format($grand_total)));
    return $fn;
}

function getInvoiceEmployee($start_date, $end_date, $month) {
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
                        $totals = unserialize($result1->grand_total);
                        $total_invoice += floatval($result1->grand_total);
                        $invoices = $CI->payment_records_model->getByWhere(array("invoice_number" => $result1->invoice_number));
                        foreach ($invoices as $inv) {
                            $tip_invoice += $inv->invoice_tip;
                            $monthly_tip += $inv->invoice_tip;
                            $paid_invoice += $inv->grand_total;
                            $monthly_paid += $inv->grand_total;
                        }
                        $monthly_due = floatval(floatval($totals['grand_total']) - floatval($monthly_paid));
                        $due_invoice += $monthly_due;
                        $new_date=date_format(date_create($result1->date_issued),"d-M-Y");
                        array_push($fn, array($new_date,"Invoice #".$result1->invoice_number. "(".$result1->status.")", get_customer_by_id($result1->customer_id)->first_name, dollar_format(floatval($result1->grand_total)), dollar_format($monthly_paid), dollar_format($monthly_due), dollar_format($monthly_tip), dollar_format($monthly_fees)));
                    }
                }
                $fn[count($fn) - ($counter + 1)] = array_merge($fn[count($fn) - ($counter + 1)], array($num_invoice, "", dollar_format($total_invoice), dollar_format($paid_invoice), dollar_format($due_invoice), dollar_format($tip_invoice), dollar_format($fees_invoice)));
            }
        }
    }

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

//A
function getExpenseCategory($start_date, $end_date) {
    // $CI =& get_instance();
    // $CI->load->model('Invoice_model', 'invoice_model');
    // $company_id = logged('company_id');
    // $cusGroups = get_customer_groups();
    // $results = $CI->invoice_model->getByWhere(array('company_id' => $company_id, 'date_issued >=' => $start_date, 'date_issued <=' => $end_date, 'status' => 'Paid', 'is_recurring' => 0));
    // $fn = [];
    // $grand_count = 0;
    // $grand_total = 0;

    // foreach ($cusGroups as $cusGroup) {
    //     $count = 0;
    //     $total_sales = 0;
    //     foreach ($results as $result) {
    //         if (get_customer_by_id($result->customer_id)->customer_group) {
    //             $groups = unserialize(get_customer_by_id($result->customer_id)->customer_group);
    //             foreach ($groups as $group) {
    //                 if ($group === $cusGroup->title) {
    //                     $count += 1;
    //                     $grand_count += 1;
    //                     $totals1 = unserialize($result2->invoice_totals);
    //                     $total_invoice += floatval($totals1['grand_total']);
    //                     $total_sales += floatval($totals1['grand_total']);
    //                     $grand_total += floatval($totals1['grand_total']);
    //                 }
    //             }
    //         }
    //     }
    //     array_push($fn, array($cusGroup->title, $count, dollar_format($total_sales)));
    // }


    // array_push($fn, array("Total", $grand_count, dollar_format($grand_total)));
    // return $fn;

    $CI =& get_instance();
    $CI->load->model('Accounting_expense', 'accounting_expense');
    $CI->load->model('Accounting_expense_category', 'accounting_expense_category');
    $CI->load->model('Accounting_list_category', 'accounting_list_category');
    $CI->load->model('AccountingVendors_model', 'accountingVendors_model');
    $company_id = logged('company_id');
    $results = $CI->accounting_expense->getByWhere(array('company_id' => $company_id, 'payment_date >=' => $start_date, 'payment_date <=' => $end_date));
    $fn = [];
    $comp_user = [];
    $grand_total = 0;
    $grand_num_invoice = 0;
    $grand_paid_invoice = 0;

    
        
        // $vendors = $CI->accountingVendors_model->getByWhere(array('vendor_id' => $result->vendor_id));
        // foreach($vendors as $vendor) 
        // {
        //     array_push($fn, array($vendor->f_name. ' ' .$vendor->l_name, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
        // }


        $lists = $CI->accounting_list_category->get();
        foreach($lists as $list) 
        {
            array_push($fn, array("-",$list->category_name, "", "", "", "", ""));
            
            foreach ($results as $result) {
                $categories = $CI->accounting_expense_category->getByWhere(array('category_id' => $list->id,'expenses_id' => $result->vendor_id));
                foreach($categories as $category) 
                {

                //array_push($fn, array($vendor->f_name. ' ' .$vendor->l_name, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
                // $lists = $CI->accounting_list_category->getByWhere(array('id' => $category->category_id));
                // foreach($lists as $list) 
                // {
                    //array_push($fn, array($vendor->f_name. ' ' .$vendor->l_name, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
                    $vendors = $CI->accountingVendors_model->getByWhere(array('vendor_id' => $result->vendor_id));
                    foreach($vendors as $vendor) 
                    {
                        array_push($fn, array(" "," ", $vendor->f_name. ' ' .$vendor->l_name, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
                    }
                }
        }

    }

    // array_push($fn, array("Total", "", "", "", ""));
    return $fn;
}

function getExpense($start_date, $end_date) {
    $CI =& get_instance();
    $CI->load->model('Accounting_expense', 'accounting_expense');
    $CI->load->model('AccountingVendors_model', 'accountingVendors_model');
    $company_id = logged('company_id');
    $results = $CI->accounting_expense->getByWhere(array('company_id' => $company_id, 'payment_date >=' => $start_date, 'payment_date <=' => $end_date));
    $fn = [];
    $comp_user = [];
    $grand_total = 0;
    $grand_num_invoice = 0;
    $grand_paid_invoice = 0;

    foreach ($results as $result) {
        // if (!in_array($result->customer_id, $comp_user)) {
        //     array_push($comp_user, $result->customer_id);
        //     $num_invoice = 0;
        //     $total_invoice = 0;
        //     $paid_invoice = 0;

        //     foreach ($results as $result2) {
        //         if ($result2->customer_id === $result->customer_id) {
        //             $num_invoice += 1;
        //             $paid_invoice += 1;
        //             $grand_num_invoice += 1;
        //             $grand_paid_invoice += 1;

        //             $totals1 = unserialize($result2->invoice_totals);
        //             // $total_invoice += floatval($totals1['grand_total']);
        //             $total_invoice += floatval($result->grand_total);
        //             // $grand_total += floatval($totals1['grand_total']);
        //             $grand_total += floatval($result->grand_total);
        //         }
        //     }
        $vendors = $CI->accountingVendors_model->getByWhere(array('vendor_id' => $result->vendor_id));
        foreach($vendors as $vendor) 
        {
            array_push($fn, array($vendor->f_name. ' ' .$vendor->l_name, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
        }

            // array_push($fn, array($result->vendor_id, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
        // }
    }

    // array_push($fn, array("Total", "", "", "", ""));
    return $fn;
}

function getExpenseVendor($start_date, $end_date) {
    $CI =& get_instance();
    $CI->load->model('Accounting_expense', 'accounting_expense');
    $CI->load->model('AccountingVendors_model', 'accountingVendors_model');
    $company_id = logged('company_id');
    $results = $CI->accounting_expense->getByWhere(array('company_id' => $company_id, 'payment_date >=' => $start_date, 'payment_date <=' => $end_date));
    $fn = [];
    $comp_user = [];
    $grand_total = 0;
    $grand_num_invoice = 0;
    $grand_paid_invoice = 0;

    foreach ($results as $result) {
        // if (!in_array($result->customer_id, $comp_user)) {
        //     array_push($comp_user, $result->customer_id);
        //     $num_invoice = 0;
        //     $total_invoice = 0;
        //     $paid_invoice = 0;

        //     foreach ($results as $result2) {
        //         if ($result2->customer_id === $result->customer_id) {
        //             $num_invoice += 1;
        //             $paid_invoice += 1;
        //             $grand_num_invoice += 1;
        //             $grand_paid_invoice += 1;

        //             $totals1 = unserialize($result2->invoice_totals);
        //             // $total_invoice += floatval($totals1['grand_total']);
        //             $total_invoice += floatval($result->grand_total);
        //             // $grand_total += floatval($totals1['grand_total']);
        //             $grand_total += floatval($result->grand_total);
        //         }
        //     }
        $vendors = $CI->accountingVendors_model->getByWhere(array('vendor_id' => $result->vendor_id));
        foreach($vendors as $vendor) 
        {
            array_push($fn, array($vendor->f_name. ' ' .$vendor->l_name, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
        }

            // array_push($fn, array($result->vendor_id, $result->payment_date, $result->payment_method, $result->ref_number, dollar_format($result->amount)));
        // }
    }

    // array_push($fn, array("Total", "", "", "", ""));
    return $fn;
}

function getSalesTax($start_date, $end_date, $month) {
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

        case "paypal":
            return "Paypal";
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

function getItemQtyOH($item_id) {
    $CI =& get_instance();
    $CI->load->model('Items_model', 'items_model');
    $qty = $CI->items_model->countQty($item_id);

    return $qty;
}

function google_get_oauth2_token($code, $googleClientId, $googleSecretId) {

    $redirect_uri = "postmessage";
    $scope = "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://mail.google.com/"; //google scope to access
    $state = "profile"; //optional


    $oauth2token_url = "https://accounts.google.com/o/oauth2/token";
    $clienttoken_post = array(
        "code" => $code,
        "client_id" => $googleClientId,
        "client_secret" => $googleSecretId,
        "redirect_uri" => $redirect_uri,
        'scope' => $scope,
        'access_type' => "offline",
        'prompt' => 'consent',
        "grant_type" => "authorization_code"
    );

    $curl = curl_init($oauth2token_url);

    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $json_response = curl_exec($curl);
    error_log($json_response);
    curl_close($curl);
    $refreshToken = '';
    $authObj = json_decode($json_response);
    if (isset($authObj->refresh_token)){
        //refresh token only granted on first authorization for offline access
        //save to db for future use (db saving not included in example)
        $refreshToken = $authObj->refresh_token;
    }

    $accessToken = $authObj->access_token;
    $accessUserProfile = "https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=" . $accessToken;
    $curl = curl_init($accessUserProfile);


    curl_setopt($curl, CURLOPT_POST, false);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $json_response = curl_exec($curl);
    error_log($json_response);
    curl_close($curl);
    $googleUser = json_decode($json_response);
    $gData['user'] = $googleUser;
    $gData['access_token'] = $accessToken;
    $gData['refreshToken'] = $refreshToken;
    return $gData;
}

function google_credentials(){
    $credentials = [
        'client_id' => '646859198620-ll9trm7obk2olgaoigae4s2hshpf3sle.apps.googleusercontent.com',
        'client_secret' => '-plXDxYZRwx6c1ttmNXE5L2p',
        'api_key' => 'AIzaSyAXhOG7zvDz1l8tOrdMnmyrhCOL4Uc-Ink'
    ];

    return $credentials;
}

if (!function_exists('getReorderItemsCount')){

    function getReorderItemsCount(){
        $CI = &get_instance();
        $uid = logged('id');
        $company_id = logged('company_id');

        $sql = 'SELECT * ,(SELECT SUM(qty) AS total FROM `items_has_storage_loc` WHERE `item_id` = items.id ) AS total_count FROM items WHERE items.company_id = ' . $company_id . ' AND items.reorder_point != 0 ORDER BY `items`.`id` ASC';

        $sql1 =  'select * , (select sum(qty) as total from `items_has_storage_loc` WHERE `item_id` = items.id ) as total_count from items where company_id = ' . $company_id .' order by `id` asc' ;


        return   $CI->db->query($sql1)->result_array();

    }
}

function statesList(){
    $states = [
        'AK' => 'Alaska',
        'AL' => 'Alabama',
        'AR' => 'Arkansas',
        'AZ' => 'Arizona',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'DC' => 'District of Columbia',
        'DE' => 'Delaware',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'IA' => 'Iowa',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'MA' => 'Massachusetts',
        'MD' => 'Maryland',
        'ME' => 'Maine',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MO' => 'Missouri',
        'MS' => 'Mississippi',
        'MT' => 'Montana',
        'NC' => 'North Carolina',
        'ND' => 'North Dakota',
        'NE' => 'Nebraska',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NM' => 'New Mexico',
        'NV' => 'Nevada',
        'NY' => 'New York',
        'OH' => 'Ohio',
        'OK' => 'Oklahoma',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'RI' => 'Rhode Island',
        'SC' => 'South Carolina',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VA' => 'Virginia',
        'VT' => 'Vermont',
        'WA' => 'Washington',
        'WI' => 'Wisconsin',
        'WV' => 'West Virginia',
        'WY' => 'Wyoming'
    ];

    return $states;
}

function getUserType($id){
    $types = userTypes();
    if( isset($types[$id]) ){
        $type = $types[$id];
    }else{
        $type = 'Standard User';
    }

    return $type;
}

function userTypes(){
    $types = [
        1 => 'Office Manager',
        2 => 'Partner',
        3 => 'Team Leader',
        4 => 'Standard User',
        5 => 'Field Sales',
        6 => 'Field Tech',
        7 => 'Admin'
    ];

    return $types;
}

function maskCreditCardNumber($cc, $maskFrom = 0, $maskTo = 4, $maskChar = 'X', $maskSpacer = '-')
{
    // Clean out
    $cc       = str_replace(array('-', ' '), '', $cc);
    $ccLength = strlen($cc);

    // Mask CC number
    if (empty($maskFrom) && $maskTo == $ccLength) {
        $cc = str_repeat($maskChar, $ccLength);
    } else {
        $cc = substr($cc, 0, $maskFrom) . str_repeat($maskChar, $ccLength - $maskFrom - $maskTo) . substr($cc, -1 * $maskTo);
    }

    // Format
    if ($ccLength > 4) {
        $newCreditCard = substr($cc, -4);
        for ($i = $ccLength - 5; $i >= 0; $i--) {
            // If on the fourth character add the mask char
            if ((($i + 1) - $ccLength) % 4 == 0) {
                $newCreditCard = $maskSpacer . $newCreditCard;
            }

            // Add the current character to the new credit card
            $newCreditCard = $cc[$i] . $newCreditCard;
        }
    } else {
        $newCreditCard = $cc;
    }

    return $newCreditCard;
}

function createSlug($str, $delimiter = '-'){

    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

} 

function replaceSmartTags($message){
    $cid  = logged('company_id');

    $CI =& get_instance();
    $CI->load->model('Clients_model');
    $CI->load->model('Payment_records_model', 'payment_records_model');
    $company_id = logged('company_id');
    $company = $CI->Clients_model->getById($cid);

    $message = str_replace("{{customer.name}}", 'John Doe', $message);
    $message = str_replace("{{customer.first_name}}", 'John', $message);
    $message = str_replace("{{customer.last_name}}", 'Doe', $message);
    $message = str_replace("{{business.email}}", $company->email_address, $message);
    $message = str_replace("{{business.phone}}", $company->phone_number, $message);
    $message = str_replace("{{business.name}}", $company->business_name, $message);

    return $message;
}

/**
 * Function to check if the user is loggedIn
 *
 * @return boolean
 *

 */

if (!function_exists('is_admin_logged')) {


    function is_admin_logged()

    {

        $CI = &get_instance();


        $login_token_match = false;


        $isLogged = !empty($CI->session->userdata('admin_login')) && !empty($CI->session->userdata('admin_logged')) ? (object)$CI->session->userdata('admin_logged') : false;

        $_token = $isLogged && !empty($CI->session->userdata('admin_login_token')) ? $CI->session->userdata('login_token') : false;


        if (!$isLogged) {

            $isLogged = get_cookie('admin_login') && !empty(get_cookie('admin_logged')) ? json_decode(get_cookie('admin_logged')) : false;

            $_token = $isLogged && !empty(get_cookie('admin_login_token')) ? get_cookie('admin_login_token') : false;
        }


        if ($isLogged) {

            $user = $CI->users_model->getById($CI->db->escape((int)$isLogged->id));

            // verify login_token

            $login_token_match = (sha1($user->id . $user->password . $isLogged->time) == $_token);
        }

        return $isLogged && $login_token_match;
    }

    function isAdminBypass(){
        $CI = &get_instance();

        $bypass = false;
        if( $CI->session->userdata('admin_bypass') ){
            $bypass = true;
        }

        return $bypass;
    }

    function customerQrCode($profile_id){
        $CI =& get_instance();
        $CI->load->model('AcsProfile_model');
        $customer = $CI->AcsProfile_model->getByProfId($profile_id);
        $qr_image = base_url('uploads/customer_qr/' . $customer->qr_img);
        if( !file_exists($qr_image) ){
            return $qr_image;
        }else{
            return false;
        }
    }

    function check_cc_type($cc, $extra_check = false){
        $cards = array(
            "visa" => "(4\d{12}(?:\d{3})?)",
            "amex" => "(3[47]\d{13})",
            "jcb" => "(35[2-8][89]\d\d\d{10})",
            "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
            "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
            "mastercard" => "(5[1-5]\d{14})",
            "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)",
            "diners" =>  "(^3(?:0[0-5]|[68][0-9])[0-9]{4,}$)",
            "discover" => "(^6(?:011|5[0-9]{2})[0-9]{3,}$)"
        );
        $names = array("Visa", "American Express", "JCB", "Maestro", "Solo", "Mastercard", "Switch", "Diners", "Discover");
        $matches = array();
        $pattern = "#^(?:".implode("|", $cards).")$#";
        $result = preg_match($pattern, str_replace(" ", "", $cc), $matches);
        if($extra_check && $result > 0){
            $result = (validatecard($cc))?1:0;
        }
        return ($result>0)?$names[sizeof($matches)-2]:false;
    }

    function customer_list_headers(){
        $headers = [
            'name' => 'Name',
            'industry' => 'Industry',
            'city' => 'City',
            'state' => 'State',
            'source' => 'Source',
            'email' => 'Email',
            'added' => 'Added',
            'sales_rep' => 'Sales Rep',
            'tech' => 'Tech',
            'plan_type' => 'Plan Type',
            'subscription_amount' => 'Subscription Amount',
            'phone' => 'Phone',
            'status' => 'Status'
        ];

        return $headers;
    }

    function plan_default_features(){
        $plan = [
            'simple-start' => ['Management', 'Finances', 'Insights', 'Marketing'],
            'essential' => ['Management', 'Finances', 'Insights', 'Marketing', 'Time Sheets', 'Reports', 'Accounting', 'Taskhub'],
            'plus' => ['Management', 'Finances', 'Insights', 'Marketing', 'Time Sheets', 'Reports', 'Accounting', 'Taskhub', 'API Connectors', 'Campaign Builder', 'Trac 360'],
            'premier-pro' => ['Management', 'Finances', 'Insights', 'Marketing', 'Time Sheets', 'Reports', 'Accounting', 'Taskhub', 'API Connectors', 'Campaign Builder', 'Trac 360', 'Mobile Tools', 'Survery Builder', 'Inventory Management'],
            'enterprise' => ['Management', 'Finances', 'Insights', 'Marketing', 'Time Sheets', 'Reports', 'Accounting', 'Taskhub', 'API Connectors', 'Campaign Builder', 'Trac 360', 'Mobile Tools', 'Survery Builder', 'Inventory Management', 'Credit Score', 'Form Builder', 'Accounting', 'eSign', 'Campaign Blast'],
            'industry-specific' => ['Management', 'Finances', 'Insights', 'Marketing', 'Time Sheets', 'Reports', 'Accounting', 'Taskhub', 'API Connectors', 'Campaign Builder', 'Trac 360', 'Mobile Tools', 'Survery Builder', 'Inventory Management', 'Credit Score', 'Form Builder', 'Accounting', 'eSign', 'Wizard', 'Branding']
        ];

        return $plan;
    }

    function sendEmail( $data ){
        $is_valid = true;

        $CI =& get_instance();
        $CI->load->model('MailSendTo_model');

        if( $data['subject'] == '' ){            
            $is_valid = false;
            $err_msg  = 'Please specify email subject';
        }

        if( isset($data['honeypot']) && $data['honeypot'] != '' ){
            $is_valid = false; 
            $err_msg = 'Invalid form data';           
        }

        if( $data['to'] == '' && $data['bcc'] == '' && $data['cc'] == '' ){
            $is_valid = false; 
            $err_msg = 'Please specify recipient';           
        }

        if( $data['body'] == '' ){
            $is_valid == false;
            $err_msg = 'Please specify email body';
        }

        $to = '';
        if( isset($data['to']) && $data['to'] != '' ){
            $to = $data['to'];
        }

        $bcc = '';
        if( isset($data['bcc']) && $data['bcc'] != '' ){
            $bcc = $data['bcc'];
        }

        $cc = '';
        if( isset($data['cc']) && $data['cc'] != '' ){
            $cc = $data['cc'];
        }

        $attachment = '';
        if( isset($data['attachment']) && $data['attachment'] != '' ){
            $attachment = $data['attachment'];
        }

        if( $is_valid ){
            $data_mail_send = [
                'email_subject' => $data['subject'],
                'email_to' => $to,
                'email_bcc' => $bcc,          
                'email_cc' => $cc,
                'email_body' => $data['body'],
                'is_sent' => 0,
                'is_with_error' => 0,
                'err_note' => '',
                'email_attachment' => $attachment,
                'date_created' => date('Y-m-d H:i:s'),
            ];

            $CI->MailSendTo_model->create($data_mail_send);
        } 

        $return = ['is_valid' => $is_valid, 'err_msg' => $err_msg];
        return $return;
    }

    /*Exempted to account renewal*/
    function exempted_company_ids(){
        $exempted_company_ids = [1,24,31,58,52];
        return $exempted_company_ids;
    }

    function customerAuditLog($user_id, $prof_id, $obj_id, $module, $remarks){
        $CI =& get_instance();
        $CI->load->model('CustomerAuditLog_model');

        $data_log = [
            'user_id' => $user_id,
            'prof_id' => $prof_id,
            'obj_id' => $obj_id,
            'module' => $module,
            'remarks' => $remarks,
            'date_created' => date('Y-m-d H:i:s')
        ];

        $CI->CustomerAuditLog_model->create($data_log);
    }
}

if (!function_exists('getTaskAssignedUser')) {

    function getTaskAssignedUser($task_id)
    {
        $CI =& get_instance();
        $CI->db->select('tasks_participants.*, CONCAT(users.FName, " ", users.LName)AS assigned_user');
        $CI->db->from('tasks_participants');
        $CI->db->join('users','tasks_participants.user_id = users.id','left');
        $CI->db->where('task_id', $task_id);
        $CI->db->where('is_assigned', 1);
        $taskAssigned = $CI->db->get()->row();

        if ($taskAssigned) {
            return ucwords($taskAssigned->assigned_user);
        }
    }
}

if(!function_exists('set_bank_widget_data')) {
    function set_bank_widget_data($data)
    {
        $CI =& get_instance();
        $CI->load->model('chart_of_accounts_model');

        $accountTypes = [
            'Bank',
            'Credit Card'
        ];

        $accounts = [];
        foreach($accountTypes as $accountType) {
            $accType = $CI->account_model->getAccTypeByName($accountType);

            $accountTypeAccs = $CI->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

            foreach($accountTypeAccs as $account) {
                $accounts[] = $account;
            }
        }

        $data['accounts'] = $accounts;

        return $data;
    }
}

if(!function_exists('set_expense_graph_data')) {
    
    function set_expense_graph_data($data)
    {
        $CI =& get_instance();
        $CI->load->model('chart_of_accounts_model');
        $CI->load->model('expenses_model');
        $CI->load->model('vendors_model');

        $accounts = $CI->chart_of_accounts_model->get_company_active_accounts(logged('company_id'));
        $endDate = date("m/d/Y");
        $startDate = date("m/d/Y", strtotime("$endDate -30 days"));

        foreach($accounts as $key => $account) {
            $categories = $CI->expenses_model->get_categories_by_expense_account($account->id);

            $expenseAmount = 0.00;
            foreach($categories as $category) {
                switch($category->transaction_type) {
                    case 'Expense' :
                        $transaction = $CI->vendors_model->get_expense_by_id($category->transaction_id);
                        $date = date("m/d/Y", strtotime($transaction->payment_date));
                    break;
                    case 'Check' :
                        $transaction = $CI->vendors_model->get_check_by_id($category->transaction_id);
                        $date = date("m/d/Y", strtotime($transaction->payment_date));
                    break;
                    case 'Bill' :
                        $transaction = $CI->vendors_model->get_bill_by_id($category->transaction_id);
                        $date = date("m/d/Y", strtotime($transaction->bill_date));
                    break;
                    case 'Purchase Order' :
                        $transaction = $CI->vendors_model->get_purchase_order_by_id($category->transaction_id);
                        $date = date("m/d/Y", strtotime($transaction->purchase_order_date));
                    break;
                    case 'Vendor Credit' :
                        $transaction = $CI->vendors_model->get_vendor_credit_by_id($category->transaction_id);
                        $date = date("m/d/Y", strtotime($transaction->payment_date));
                    break;
                    case 'Credit Card Credit' :
                        $transaction = $CI->vendors_model->get_credit_card_credit_by_id($category->transaction_id);
                        $date = date("m/d/Y", strtotime($transaction->payment_date));
                    break;
                }

                if($transaction->recurring !== '1' && $transaction->status !== "0") {
                    if(strtotime($date) >= strtotime($startDate) && strtotime($date) <= strtotime($endDate)) {
                        switch($category->transaction_type) {
                            case 'Expense' :
                                $expenseAmount += floatval($category->amount);
                            break;
                            case 'Check' :
                                $expenseAmount += floatval($category->amount);
                            break;
                            case 'Bill' :
                                $expenseAmount += floatval($category->amount);
                            break;
                            case 'Vendor Credit' :
                                $expenseAmount -= floatval($category->amount);
                            break;
                            case 'Credit Card Credit' :
                                $expenseAmount -= floatval($category->amount);
                            break;
                        }
                    }
                }
            }

            $accounts[$key]->expense_amount = $expenseAmount;
        }

        usort($accounts, function ($a, $b) {
            return floatval($a->expense_amount) < floatval($b->expense_amount);
        });

        $accounts = array_slice($accounts, 0, 10);

        $accountNames = array_column($accounts, 'name');
        $accountExpenses = array_column($accounts, 'expense_amount');

        $tempNames = array_map(function($value) {
            return '"' . addcslashes($value, "\0..\37\"\\") . '"';
        }, $accountNames);

        $tempExpenses = array_map(function($value) {
            return '"' . addcslashes($value, "\0..\37\"\\") . '"';
        }, $accountExpenses);

        $data['account_names'] = '[' . implode(',', $tempNames) . ']';
        $data['account_expenses'] = '[' . implode(',', $tempExpenses) . ']';

        return $data;
    }

    function timeLapsedString($datetime, $full = false) {        
        $now = new \DateTime;
        $ago = new \DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    /**
     * @param $user_id int
     * @param $prof_id int
     * @return object
     */
    function getCustomerLastMessage($user_id, $prof_id)
    {
        $CI =& get_instance();
        $CI->load->model('CompanySms_model');
        
        if( $user_id > 0 ){
            $lastMessage = $CI->CompanySms_model->getCustomerLastMessageByUserIdAndProfId($user_id, $prof_id);
        }else{
            $lastMessage = $CI->CompanySms_model->getCustomerLastMessageByProfId($prof_id);
        }

        return $lastMessage;
    }

    function getUserName($user_id) {
        $CI =& get_instance();
        $CI->load->model('Users_model');
        $user = $CI->Users_model->getUser($user_id);

        $name = '-';
        $id   = '';
        if( $user ){
            $name = $user->FName . ' ' . $user->LName;
            $id = $user->id;
        }

        $user_data = ['id' => $id, 'name' => $name];
        return $user_data;
    }

    function createCronAutoSmsNotification( $company_id, $object_id, $module_name, $module_status, $user_id = 0, $assigned_to_user_id = 0, $agent_id = 0 ){
        $CI =& get_instance();
        $CI->load->model('CompanyAutoSmsSettings_model');
        $CI->load->model('CronAutoSmsNotification_model');
        $CI->load->model('Users_model');

        $sent_numbers = array();
        $filter[] = ['field' => 'module_name', 'value' => strtolower($module_name)];
        $filter[] = ['field' => 'module_status', 'value' => $module_status];
        $filter[] = ['field' => 'is_enabled', 'value' => 1];
        $autoSms  = $CI->CompanyAutoSmsSettings_model->getByCompanyId($company_id, $filter);
        if( $autoSms ){

            $cronFilter[] = ['field' => 'company_id', 'value' => $company_id];
            $cronFilter[] = ['field' => 'module_name', 'value' => $module_name];
            //$cronFilter[] = ['field' => 'is_sent', 'value' => 0];
            $cronFilter[] = ['field' => 'company_auto_sms_id', 'value' => $autoSms->id];
            $isExists = $CI->CronAutoSmsNotification_model->getByObjectId($object_id, $cronFilter);

            if( !$isExists ){
                if( $autoSms->send_to_creator == 1 ){
                    if( $user_id > 0 ){
                        $itemCreator = $CI->Users_model->getUserByID($user_id);
                        if( $itemCreator ){
                            if( $itemCreator->mobile != '' ){
                                if( !array_key_exists($itemCreator->mobile, $sent_numbers) ){
                                    $cron_data = [
                                        'company_auto_sms_id' => $autoSms->id,
                                        'obj_id' => $object_id,
                                        'mobile_number' => $itemCreator->mobile,
                                        'sms_message' => $autoSms->sms_text,
                                        'is_sent' => 0,
                                        'module_name' => $module_name,
                                        'created' => date("Y-m-d H:i:s")
                                    ];

                                    $CI->Users_model->CronAutoSmsNotification_model->create($cron_data);

                                    $sent_numbers[$itemCreator->mobile] = $itemCreator->mobile;
                                }                               
                            }  
                        }                    
                    }
                }

                if( $autoSms->module_name == 'taskhub' || $autoSms->module_name == 'lead' ){
                    if( $autoSms->send_to_assigned_user == 1 && $assigned_to_user_id > 0 ){
                        $assignedUser = $CI->Users_model->getUserByID($assigned_to_user_id);
                        if( $assignedUser->mobile != '' ){
                            if( !array_key_exists($assignedUser->mobile, $sent_numbers) ){                        
                                $cron_data = [
                                    'company_auto_sms_id' => $autoSms->id,
                                    'obj_id' => $object_id,
                                    'mobile_number' => $assignedUser->mobile,
                                    'sms_message' => $autoSms->sms_text,
                                    'is_sent' => 0,
                                    'module_name' => $module_name,
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $CI->Users_model->CronAutoSmsNotification_model->create($cron_data);

                                $sent_numbers[$assignedUser->mobile] = $assignedUser->mobile;
                            }
                        }  
                    }

                    if( $autoSms->send_to_assigned_agent == 1 && $agent_id > 0 ){
                        $assignedAgent = $CI->Users_model->getUserByID($agent_id);
                        if( $assignedAgent->mobile != '' ){
                            if( !array_key_exists($assignedAgent->mobile, $sent_numbers) ){   
                                $cron_data = [
                                    'company_auto_sms_id' => $autoSms->id,
                                    'obj_id' => $object_id,
                                    'mobile_number' => $assignedAgent->mobile,
                                    'sms_message' => $autoSms->sms_text,
                                    'is_sent' => 0,
                                    'module_name' => $module_name,
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $CI->Users_model->CronAutoSmsNotification_model->create($cron_data);

                                $sent_numbers[$assignedAgent->mobile] = $assignedAgent->mobile;
                            }
                        }  
                    }
                }

                if( $autoSms->send_to_company_admin == 1 ){
                    $companyAdminUsers = $CI->Users_model->getAllAdminByCompanyID($company_id);
                    foreach($companyAdminUsers as $u){
                        if( $u->mobile != '' ){
                            if( !array_key_exists($u->mobile, $sent_numbers) ){   
                                $cron_data = [
                                    'company_auto_sms_id' => $autoSms->id,
                                    'obj_id' => $object_id,
                                    'mobile_number' => $u->mobile,
                                    'sms_message' => $autoSms->sms_text,    
                                    'is_sent' => 0,  
                                    'module_name' => $module_name,                      
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $CI->Users_model->CronAutoSmsNotification_model->create($cron_data);

                                $sent_numbers[$u->mobile] = $u->mobile;
                            }                        
                        }                    
                    }
                }

                if( $autoSms->send_to == 'all' ){
                    $users = $CI->Users_model->getAllUsersByCompanyID($company_id);
                    foreach($users as $u){
                        if( $u->mobile != '' ){
                            if( !array_key_exists($u->mobile, $sent_numbers) ){  
                                $cron_data = [
                                    'company_auto_sms_id' => $autoSms->id,
                                    'obj_id' => $object_id,
                                    'mobile_number' => $u->mobile,
                                    'sms_message' => $autoSms->sms_text,   
                                    'is_sent' => 0,  
                                    'module_name' => $module_name,                              
                                    'created' => date("Y-m-d H:i:s")
                                ];

                                $CI->Users_model->CronAutoSmsNotification_model->create($cron_data);

                                $sent_numbers[$u->mobile] = $u->mobile;
                            }                        
                        }                    
                    }
                }else{
                    if( $autoSms->send_to != '' ){
                        $a_send_to = unserialize($autoSms->send_to);
                        foreach($a_send_to as $uid){
                            $user = $CI->Users_model->getUserByID($uid);
                            if( $user ){
                                if( $user->mobile != '' ){
                                    if( !array_key_exists($user->mobile, $sent_numbers) ){                                  
                                        $cron_data = [
                                            'company_auto_sms_id' => $autoSms->id,
                                            'obj_id' => $object_id,
                                            'mobile_number' => $user->mobile,
                                            'sms_message' => $autoSms->sms_text,
                                            'is_sent' => 0,
                                            'module_name' => $module_name, 
                                            'created' => date("Y-m-d H:i:s")
                                        ];

                                        $CI->Users_model->CronAutoSmsNotification_model->create($cron_data);

                                        $sent_numbers[$user->mobile] = $user->mobile;
                                    }                            
                                } 
                            }                         
                        }
                    }                
                }
            }
        }
    }

    function maskString($string, $length = 5){
        $mask_string =  str_repeat("*", strlen($string)-$length) . substr($string, -$length);
        
        return $mask_string;
    }
}