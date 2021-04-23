<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'My Customers';
        $this->page_data['page']->menu = 'customers';
        //$this->load->model('Customer_model', 'customer_model');
        //$this->load->model('CustomerAddress_model', 'customeraddress_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Esign_model', 'Esign_model');
        $this->load->model('Activity_model','activity');

        $this->load->model('General_model', 'general');

        $this->checkLogin();
        $this->load->library('session');
        $this->load->helper('functions');
        // concept
        $uid = $this->session->userdata('uid');
        if (empty($uid)) {
            $this->page_data['uid'] = md5(time());
            $this->session->set_userdata(['uid' => $this->page_data['uid']]);
        } else {
            $uid = $this->session->userdata('uid');
            $this->page_data['uid'] = $uid;
        }

        //error_reporting(0);
    }


    public function getModulesList()
    {
        $user_id = logged('id');
        $this->load->library('wizardlib');

        $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_module_sort");
        $this->page_data['widgets'] = $this->customer_ad_model->getModulesList();
        $this->load->view('customer/adv_cust_modules/add_module_details', $this->page_data);
    }

    public function index()
    {
        $this->load->library('wizardlib');
        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $input = $this->input->post();
        if($input){
            $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data($input);
        }
//      $this->page_data['library_templates'] = $this->Esign_model->get_library_template_by_category($user_id);
//      $this->page_data['library_categories'] = $this->Esign_model->get_library_categories();
        $this->page_data['cust_tab'] = $this->uri->segment(3);
//       $this->page_data['affiliates'] = $this->customer_ad_model->get_all(FALSE,"","","affiliates","id");
//       $this->page_data['furnishers'] = $this->customer_ad_model->get_all(FALSE,"","","acs_furnisher","furn_id");
//       $this->page_data['reasons'] = $this->customer_ad_model->get_all(FALSE,"","","acs_reasons","reason_id");
//       $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE,"","","ac_leadtypes","lead_id");
//       $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","","ac_salesarea","sa_id");
        //$this->page_data['users'] = $this->users_model->getUsers();
        // $this->load->model('Activity_model','activity');
        //$this->page_data['activity_list'] = $this->activity->getActivity($user_id, [], 0);
        //$this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6,0], 1);
        $this->load->view('customer/list', $this->page_data);
    }

    public function preview($id=null){

        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $userid = $id;
        $user_id = logged('id');
        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
            $get_customer_notes = array(
                'where' => array(
                    'fk_prof_id' => $userid
                ),
                'table' => 'acs_notes',
                'select' => '*',
            );
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);

            $get_login_user = array(
                'where' => array(
                    'id' => $user_id
                ),
                'table' => 'users',
                'select' => 'id,FName,LName',
            );
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);
        }
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_salesarea","sa_id");
        $this->page_data['employees'] = $this->customer_ad_model->get_all(FALSE,"","ASC","users","id");
        $this->page_data['users'] = $this->users_model->getUsers();

        $this->load->view('customer/preview', $this->page_data);
    }

    public function billing($id=null){
        // check if customer is allowed to view this page
        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $userid = $id;
        $user_id = logged('id');
        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");

            $get_login_user = array(
                'where' => array(
                    'id' => $user_id
                ),
                'table' => 'users',
                'select' => 'id,FName,LName',
            );
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);
        }

        $this->load->view('customer/billing', $this->page_data);
    }

    public function subscription($id=null){
        // check if customer is allowed to view this page
        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $userid = $id;
        $user_id = logged('id');
        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");

            $get_login_user = array(
                'where' => array(
                    'id' => $user_id
                ),
                'table' => 'users',
                'select' => 'id,FName,LName',
            );
            $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);
        }

        $this->load->view('customer/subscription', $this->page_data);

    }

    public function index2()
    {
        $this->load->library('wizardlib');
        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $user_id = logged('id');
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id',$user_id,"ac_module_sort");
//        if(!$check_if_exist){
//            $input = array();
//            $input['fk_user_id'] = $user_id ;
//            $input['ams_values'] = "profile,score,tech,access,admin,office,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute" ;
//            $this->customer_ad_model->add($input,"ac_module_sort");
//        }
        $userid = $this->uri->segment(4);
//        if(!isset($userid) || empty($userid)){
//            $get_id = $this->customer_ad_model->get_all(1,"","DESC","acs_profile","prof_id");
//            if(!empty($get_id)){
//                $userid =  $get_id[0]->prof_id;
//            }else{
//                $userid = 0;
//            }
//        }else{
//            $this->qrcodeGenerator($userid);
//        }

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $userid;

        //$this->session->set_userdata('customer_data_session', 233);
        //$this->session->unset_userdata('customer_data_session');

        if(isset($userid) || !empty($userid)){
            //$this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
//            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
//            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
//            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
//            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
//            $this->page_data['audit_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_audit_import");
//            $this->page_data['minitab'] = $this->uri->segment(5);
//            $this->page_data['task_info'] = $this->customer_ad_model->get_all_by_id("fk_prof_id",$userid,"acs_tasks");
           // $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_module_sort");
            //$this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();

//            if($this->uri->segment(5) == "mt3-cdl"){
//                $template_id = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : '';
//                $this->page_data['letter_id'] = $template_id;
//                $this->page_data['letter_template'] = $this->Esign_model->get_template_by_id($template_id);
//            }
            // print_r($this->page_data['alarm_info']);
        }
//        $this->page_data['library_templates'] = $this->Esign_model->get_library_template_by_category($user_id);
//        $this->page_data['library_categories'] = $this->Esign_model->get_library_categories();
        $this->page_data['cust_tab'] = $this->uri->segment(3);
//        $this->page_data['affiliates'] = $this->customer_ad_model->get_all(FALSE,"","","affiliates","id");
//        $this->page_data['furnishers'] = $this->customer_ad_model->get_all(FALSE,"","","acs_furnisher","furn_id");
//        $this->page_data['reasons'] = $this->customer_ad_model->get_all(FALSE,"","","acs_reasons","reason_id");
//        $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE,"","","ac_leadtypes","lead_id");
//        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","","ac_salesarea","sa_id");
        //$this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data($user_id);
       // $this->load->model('Activity_model','activity');
        //$this->page_data['activity_list'] = $this->activity->getActivity($user_id, [], 0);
        //$this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6,0], 1);
        $this->load->view('customer/list', $this->page_data);
    }

    public function settings()
    {
        $this->load->library('wizardlib');
        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $user_id = logged('id');
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id',$user_id,"ac_module_sort");
        if(!$check_if_exist){
            $input = array();
            $input['fk_user_id'] = $user_id ;
            $input['ams_values'] = "profile,score,tech,access,admin,office,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute" ;
            $this->customer_ad_model->add($input,"ac_module_sort");
        }
        $userid = $this->uri->segment(4);
        if(!isset($userid) || empty($userid)){
            $get_id = $this->customer_ad_model->get_all(1,"","DESC","acs_profile","prof_id");
            if(!empty($get_id)){
                $userid =  $get_id[0]->prof_id;
            }else{
                $userid = 0;
            }
        }else{
            $this->qrcodeGenerator($userid);
        }

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $userid;

        //$this->session->set_userdata('customer_data_session', 233);
        //$this->session->unset_userdata('customer_data_session');

        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
//            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
//            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
//            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
//            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
//            $this->page_data['audit_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_audit_import");
//            $this->page_data['minitab'] = $this->uri->segment(5);
//            $this->page_data['task_info'] = $this->customer_ad_model->get_all_by_id("fk_prof_id",$userid,"acs_tasks");
            $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_module_sort");
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();

            if($this->uri->segment(5) == "mt3-cdl"){
                $template_id = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : '';
                $this->page_data['letter_id'] = $template_id;
                $this->page_data['letter_template'] = $this->Esign_model->get_template_by_id($template_id);
            }
            // print_r($this->page_data['alarm_info']);
        }
//        $this->page_data['library_templates'] = $this->Esign_model->get_library_template_by_category($user_id);
//        $this->page_data['library_categories'] = $this->Esign_model->get_library_categories();
        $this->page_data['cust_tab'] = $this->uri->segment(3);
//        $this->page_data['affiliates'] = $this->customer_ad_model->get_all(FALSE,"","","affiliates","id");
//        $this->page_data['furnishers'] = $this->customer_ad_model->get_all(FALSE,"","","acs_furnisher","furn_id");
//        $this->page_data['reasons'] = $this->customer_ad_model->get_all(FALSE,"","","acs_reasons","reason_id");
//        $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE,"","","ac_leadtypes","lead_id");
//        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","","ac_salesarea","sa_id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data($user_id);
        $this->load->model('Activity_model','activity');
        $this->page_data['activity_list'] = $this->activity->getActivity($user_id, [], 0);
        $this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6,0], 1);
        $this->load->view('customer/settings', $this->page_data);
    }

    public function module()
    {
        $this->load->library('wizardlib');
        $is_allowed = $this->isAllowedModuleAccess(9);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $user_id = logged('id');
        $check_if_exist = $this->customer_ad_model->if_exist('fk_user_id',$user_id,"ac_module_sort");
        if(!$check_if_exist){
            $input = array();
            $input['fk_user_id'] = $user_id ;
            $input['ams_values'] = "profile,score,tech,access,admin,office,owner,docu,tasks,memo,invoice,assign,cim,billing,alarm,dispute" ;
            $this->customer_ad_model->add($input,"ac_module_sort");
        }
        $userid = $this->uri->segment(4);
        if(!isset($userid) || empty($userid)){
            $get_id = $this->customer_ad_model->get_all(1,"","DESC","acs_profile","prof_id");
            if(!empty($get_id)){
                $userid =  $get_id[0]->prof_id;
            }else{
                $userid = 0;
            }
        }else{
            $this->qrcodeGenerator($userid);
        }

        // set a global data for customer profile id
        $this->page_data['customer_profile_id'] = $userid;

        //$this->session->set_userdata('customer_data_session', 233);
        //$this->session->unset_userdata('customer_data_session');

        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
//            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
//            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
//            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
//            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
//            $this->page_data['audit_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_audit_import");
//            $this->page_data['minitab'] = $this->uri->segment(5);
//            $this->page_data['task_info'] = $this->customer_ad_model->get_all_by_id("fk_prof_id",$userid,"acs_tasks");
            $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_module_sort");
            $this->page_data['cust_modules'] = $this->customer_ad_model->getModulesList();

            if($this->uri->segment(5) == "mt3-cdl"){
                $template_id = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : '';
                $this->page_data['letter_id'] = $template_id;
                $this->page_data['letter_template'] = $this->Esign_model->get_template_by_id($template_id);
            }
            // print_r($this->page_data['alarm_info']);
        }
//        $this->page_data['library_templates'] = $this->Esign_model->get_library_template_by_category($user_id);
//        $this->page_data['library_categories'] = $this->Esign_model->get_library_categories();
        $this->page_data['cust_tab'] = $this->uri->segment(3);
//        $this->page_data['affiliates'] = $this->customer_ad_model->get_all(FALSE,"","","affiliates","id");
//        $this->page_data['furnishers'] = $this->customer_ad_model->get_all(FALSE,"","","acs_furnisher","furn_id");
//        $this->page_data['reasons'] = $this->customer_ad_model->get_all(FALSE,"","","acs_reasons","reason_id");
//        $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE,"","","ac_leadtypes","lead_id");
//        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","","ac_salesarea","sa_id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['history_activity_list'] = $this->activity->getActivity($user_id, [6,0], 1);
        $this->load->view('customer/module', $this->page_data);
    }

    public function add_advance($id=null)
    {
        $userid = $id;
        $user_id = logged('id');
        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");

            $get_customer_notes = array(
                'where' => array(
                    'fk_prof_id' => $userid
                ),
                'table' => 'acs_notes',
                'select' => '*',
            );
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);
            //$this->page_data['device_info'] = $this->customer_ad_model->get_all_by_id('fk_prof_id',$userid,"acs_devices");
        }
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_salesarea","sa_id");
        $this->page_data['employees'] = $this->customer_ad_model->get_all(FALSE,"","ASC","users","id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->load->view('customer/add_advance', $this->page_data);
    }

    public function leads()
    {   $is_allowed = $this->isAllowedModuleAccess(14);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer_leads';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $user_id = logged('id');
        $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('customer/leads', $this->page_data);
    }

    public function ac_module_sort($id=NULL){
        //$user_id = logged('id');
        $this->load->library('wizardlib');
        $input = $this->input->post();
        if($this->customer_ad_model->update_data($input,"ac_module_sort","ams_id")){
            $view = $this->wizardlib->getModuleById($id);
            $data['id'] = $id;
            $this->load->view($view->ac_view_link, $data);
        }else{
            echo "Error";
        }
    }

    private function removeItemString($string, $item)
    {
        $parts = explode(',', $string);
        while(($i = array_search($item, $parts)) !== false){
            unset($parts[$i]);
        }

        return implode(',', $parts);
    }

    public function remove_module(){
        $user_id = logged('id');
        $this->load->library('wizardlib');
        $details = post('ams_values');
        $ams_id = post('ams_id');
        $id = post('id');

        $mod_ids = $this->removeItemString($details, $id);
        $input = array('ams_id'=>$ams_id,'ams_values' => $mod_ids);
        if($this->customer_ad_model->update_data($input,"ac_module_sort","ams_id")){
            $details = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_module_sort");
            echo $details->ams_values;
        }else{
            echo "Error";
        }
    }

    public function qrcodeGenerator($profile_id){
        $this->load->library('qrcode/ciqrcode');
        $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/assets/img/customer/qr/'.$profile_id.'.png';

        $params['data'] = 'https://nsmartrac.com/customer/preview/'.$profile_id;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $SERVERFILEPATH;
        $this->ciqrcode->generate($params);
        //echo '<img src="'.base_url().'assets/img/customer/qr/names.png" />';
    }

    public function save_customer_profile(){
        $input = $this->input->post();
        if(isset($input['customer_id'])){
            $check_customer='';
        }else{
            $check_customer= $this->customer_ad_model->check_customer($input);
        }
        if(empty($check_customer)){
            // customer profile info
            $input_profile = array();
            $input_profile['fk_user_id'] = logged('id');
            $input_profile['fk_sa_id'] = $input['fk_sa_id'];
            $input_profile['company_id'] = logged('company_id');
            $input_profile['status'] = $input['status'];
            $input_profile['customer_type'] = $input['customer_type'];
            $input_profile['business_name'] = $input['business_name'];
            $input_profile['first_name'] = $input['first_name'];
            $input_profile['last_name'] = $input['last_name'];
            $input_profile['middle_name'] = $input['middle_name'];
            $input_profile['prefix'] = $input['prefix'];
            $input_profile['suffix'] = $input['suffix'];
            $input_profile['mail_add'] = $input['mail_add'];
            $input_profile['city'] = $input['city'];
            $input_profile['state'] = $input['state'];
            $input_profile['country'] = $input['country'];
            $input_profile['zip_code'] = $input['zip_code'];
            $input_profile['cross_street'] = $input['cross_street'];
            $input_profile['subdivision'] = $input['subdivision'];
            $input_profile['email'] = $input['email'];
            $input_profile['ssn'] = $input['ssn'];
            $input_profile['date_of_birth'] = $input['date_of_birth'];
            $input_profile['phone_h'] = $input['phone_h'];
            $input_profile['phone_m'] = $input['phone_m'];
            $input_profile['contact_name1'] = $input['contact_name1'];
            $input_profile['contact_name2'] = $input['contact_name2'];
            $input_profile['contact_name3'] = $input['contact_name3'];
            $input_profile['contact_phone1'] = $input['contact_phone1'];
            $input_profile['contact_phone2'] = $input['contact_phone2'];
            $input_profile['contact_phone3'] = $input['contact_phone3'];
            //$input_profile['notes'] = $input['notes'];
            if(isset($input['customer_id'])){
                $profile_id = $this->general->update_with_key_field($input_profile, $input['customer_id'],'acs_profile','prof_id');
            }else{
                $profile_id = $this->general->add_return_id($input_profile, 'acs_profile');
            }

            $save_billing = $this->save_billing_information($input,$profile_id);
            $save_office = $this->save_office_information($input,$profile_id);
            $save_alarm = $this->save_alarm_information($input,$profile_id);
            $save_access = $this->save_access_information($input,$profile_id);
            if($save_billing == 0){
                echo 'Error Occured on Saving Billing Information';
            }else if($save_office == 0){
                echo 'Error Occured on Saving Office Information';
            }else if($save_alarm == 0){
                echo 'Error Occured on Saving Alarm Information';
            }else if($save_access == 0){
                echo 'Error Occured on Saving Access Information';
            }else{
                $this->save_notes($input,$profile_id);
                $this->qrcodeGenerator($profile_id);
                if(isset($input['customer_id'])){
                    echo $input['customer_id'];
                }else{
                    echo $profile_id;
                }

            }
        }else {
            echo 'Customer Already Exist!';
        }
    }

    public function save_billing_information($input,$id){
        $input_billing = array();
        // billing data
        if(!isset($input['customer_id'])){
            $input_billing['fk_prof_id'] = $id;
        }
        $input_billing['card_fname'] = $input['card_fname'];
        $input_billing['card_lname'] = $input['card_lname'];
        $input_billing['card_address'] = $input['card_address'];
        $input_billing['city'] = $input['billing_city'];
        $input_billing['state'] = $input['billing_state'];
        $input_billing['zip'] = $input['billing_zip'];
        $input_billing['equipment'] = $input['equipment'];
        $input_billing['initial_dep'] = $input['initial_dep'];
        $input_billing['mmr'] = $input['mmr'];
        $input_billing['bill_freq'] = $input['bill_freq'];
        $input_billing['bill_day'] = $input['bill_day'];
        $input_billing['contract_term'] = $input['contract_term'];
        $input_billing['bill_start_date'] = $input['bill_start_date'];
        $input_billing['bill_end_date'] = $input['bill_end_date'];

        $input_billing['bill_method'] = $input['bill_method'];
        $input_billing['check_num'] = $input['check_num'];
        $input_billing['routing_num'] = $input['routing_num'];
        $input_billing['acct_num'] = $input['acct_num'];
        $input_billing['credit_card_num'] = $input['credit_card_num'];
        $input_billing['credit_card_exp'] = $input['credit_card_exp'];
        $input_billing['credit_card_exp_mm_yyyy'] = $input['credit_card_exp_mm_yyyy'];
        $input_billing['account_credential'] = $input['account_credential'];
        $input_billing['account_note'] = $input['account_note'];
        $input_billing['confirmation'] = $input['confirmation'];

        $input_billing['finance_amount'] = $input['finance_amount'];
        $input_billing['recurring_start_date'] = $input['recurring_start_date'];
        $input_billing['recurring_end_date'] = $input['recurring_end_date'];
        $input_billing['transaction_amount'] = $input['transaction_amount'];
        $input_billing['transaction_category'] = $input['transaction_category'];
        $input_billing['frequency'] = $input['frequency'];

        if(isset($input['customer_id'])){
            return $this->general->update_with_key_field($input_billing, $input['customer_id'], 'acs_billing','fk_prof_id');
        }else{
            return $this->general->add_($input_billing, 'acs_billing');
        }

    }

    public function save_office_information($input,$id){
        $input_office = array();

        // office data
        if(!isset($input['customer_id'])){
            $input_office['fk_prof_id'] = $id;
        }
        $input_office['welcome_sent'] = 0;
        $input_office['entered_by'] = $input['entered_by'];
        $input_office['time_entered'] = $input['time_entered'];
        $input_office['sales_date'] = $input['sales_date'];
        $input_office['credit_score'] = $input['credit_score'];
        $input_office['pay_history'] = $input['pay_history'];
        $input_office['fk_sales_rep_office'] = $input['fk_sales_rep_office'];
        $input_office['technician'] = $input['technician'];
        $input_office['install_date'] = $input['install_date'];
        $input_office['tech_arrive_time'] = $input['tech_arrive_time'];
        $input_office['tech_depart_time'] = $input['tech_depart_time'];
        $input_office['lead_source'] = $input['lead_source'];
        $input_office['verification'] = $input['verification'];
        $input_office['cancel_date'] = $input['cancel_date'];
        $input_office['cancel_reason'] = $input['cancel_reason'];
        $input_office['collect_date'] = $input['collect_date'];
        $input_office['collect_amount'] = $input['collect_amount'];
        $input_office['language'] = $input['language'];
        $input_office['pre_install_survey'] = $input['pre_install_survey'];
        $input_office['post_install_survey'] = $input['post_install_survey'];
        $input_office['monitoring_waived'] = $input['monitoring_waived'];

        if(isset($input['rebate_offer'])){
            $input_office['rebate_offer'] = $input['rebate_offer'];
        }else{
            $input_office['rebate_offer'] = 0;
        }

        $input_office['rebate_check1'] = $input['rebate_check1'];
        $input_office['rebate_check1_amt'] = $input['rebate_check1_amt'];
        $input_office['rebate_check2'] = $input['rebate_check2'];
        $input_office['rebate_check2_amt'] = $input['rebate_check2_amt'];
        $input_office['activation_fee'] = $input['activation_fee'];
        $input_office['way_of_pay'] = $input['way_of_pay'];

        if(isset($input['commision_scheme'])){
            $input_office['commision_scheme'] = $input['commision_scheme'][0];
        }else{
            $input_office['commision_scheme'] = 2;
        }

        $input_office['rep_comm'] = $input['rep_comm'];
        $input_office['rep_upfront_pay'] = $input['rep_upfront_pay'];
        $input_office['rep_tiered_bonus'] = $input['rep_tiered_bonus'];
        $input_office['rep_holdfund_bonus'] = $input['rep_holdfund_bonus'];
        $input_office['rep_deduction'] = $input['rep_deduction'];
        $input_office['tech_comm'] = $input['tech_comm'];
        $input_office['tech_upfront_pay'] = $input['tech_upfront_pay'];
        $input_office['tech_deduction'] = $input['tech_deduction'];
        $input_office['rep_charge_back'] = $input['rep_charge_back'];
        $input_office['rep_payroll_charge_back'] = $input['rep_payroll_charge_back'];

        if(isset($input['pso'])){
            $input_office['pso'] = $input['pso'][0];
        }else{
            $input_office['pso'] = 2;
        }

        $input_office['points_include'] = $input['points_include'];
        $input_office['price_per_point'] = $input['price_per_point'];
        $input_office['purchase_price'] = $input['purchase_price'];
        $input_office['purchase_multiple'] = $input['purchase_multiple'];
        $input_office['purchase_discount'] = $input['purchase_discount'];
        $input_office['equipment_cost'] = $input['equipment_cost'];
        $input_office['labor_cost'] = $input['labor_cost'];
        $input_office['job_profit'] = $input['job_profit'];
        $input_office['url'] = $input['url'];

        if(isset($input['customer_id'])){
            return $this->general->update_with_key_field($input_office, $input['customer_id'], 'acs_office','fk_prof_id');
        }else{
            return $this->general->add_($input_office, 'acs_office');
        }
    }

    public function save_alarm_information($input,$id){
        $input_alarm = array();

        // alarm data
        if(!isset($input['customer_id'])){
            $input_alarm['fk_prof_id'] = $id;
        }
        $input_alarm['monitor_comp'] = $input['monitor_comp'];
        $input_alarm['monitor_id'] = $input['monitor_id'];
        //$input_alarm['install_date'] = $input['install_date'];
        $input_alarm['acct_type'] = $input['acct_type'];
        $input_alarm['online'] = $input['online'];
        $input_alarm['in_service'] = $input['in_service'];
        $input_alarm['equipment'] = $input['equipment'];
        $input_alarm['collections'] = $input['collections'];
        $input_alarm['credit_score_alarm'] = '';
        $input_alarm['passcode'] = $input['passcode'];
        $input_alarm['install_code'] = $input['install_code'];
        $input_alarm['mcn'] = $input['mcn'];
        $input_alarm['scn'] = $input['scn'];
        $input_alarm['panel_type'] = $input['panel_type'];
        $input_alarm['system_type'] = $input['system_type'];
        $input_alarm['warranty_type'] = $input['warranty_type'];
        $input_alarm['dealer'] = $input['dealer'];
        $input_alarm['alarm_login'] = $input['alarm_login'];
        $input_alarm['alarm_customer_id'] = $input['alarm_customer_id'];
        $input_alarm['alarm_cs_account'] = $input['alarm_cs_account'];

        if(isset($input['customer_id'])){
            return $this->general->update_with_key_field($input_alarm, $input['customer_id'], 'acs_alarm','fk_prof_id');
        }else{
            return $this->general->add_($input_alarm, 'acs_alarm');
        }
    }

    public function save_access_information($input,$id){
        $input_access = array();

        //access data
        if(!isset($input['customer_id'])){
            $input_access['fk_prof_id'] = $id;
        }
        if(isset($input['portal_status'])){
            $input_access['portal_status'] = $input['portal_status'];
        }else{
            $input_access['portal_status'] = 2;
        }

        $input_access['reset_password'] ='';
        $input_access['access_login'] = $input['access_login'];
        $input_access['access_password'] = $input['access_password'];

        if(isset($input['customer_id'])){
            return $this->general->update_with_key_field($input_access, $input['customer_id'], 'acs_access','fk_prof_id');
        }else{
            return $this->general->add_($input_access, 'acs_access');
        }
    }

    public function save_notes($input,$id){
        if(!empty($input_notes['note'])){
            $input_notes = array();
            // notes data
            $input_notes['fk_prof_id'] = $id;
            $input_notes['note'] = $input['notes'];
            $input_notes['datetime'] = date("m-d-Y h:i A");
            $this->general->add_($input_notes, 'acs_notes');
        }
    }

    public function add_data_sheet(){

        $user_id = logged('id');
        $cid = logged('company_id');
        $input = $this->input->post();

        $fk_prod_id = $input['prof_id'];
        if(empty($fk_prod_id)){
            $fk_prod_id = $this->customer_ad_model->add($input,"acs_profile");

            $input_access['fk_prof_id'] = $fk_prod_id;
            $input_office['fk_prof_id'] = $fk_prod_id;
            $input_alarm['fk_prof_id'] = $fk_prod_id;
            $input_billing['fk_prof_id'] = $fk_prod_id;

            $this->customer_ad_model->add($input_access,"acs_access");
            $this->customer_ad_model->add($input_office,"acs_office");
            $this->customer_ad_model->add($input_alarm,"acs_alarm");
            $this->customer_ad_model->add($input_billing,"acs_billing");
            echo "Added";
        }else{
            $input_profile['prof_id'] = $fk_prod_id;
            $this->customer_ad_model->update_data($input_profile,"acs_profile","prof_id");

            $input_access['fk_prof_id'] = $fk_prod_id;
            $input_office['fk_prof_id'] = $fk_prod_id;
            $input_alarm['fk_prof_id'] = $fk_prod_id;
            $input_billing['fk_prof_id'] = $fk_prod_id;

            $this->customer_ad_model->update_data($input_access,"acs_access","fk_prof_id");
            $this->customer_ad_model->update_data($input_office,"acs_office","fk_prof_id");
            $this->customer_ad_model->update_data($input_alarm,"acs_alarm","fk_prof_id");
            $this->customer_ad_model->update_data($input_billing,"acs_billing","fk_prof_id");

            if(isset($input['device_name'])){
                $devices = count($input['device_name']);
                for($xx=0;$xx<$devices;$xx++){
                    $device_data = array();
                    $device_data['fk_prof_id'] = $fk_prod_id;
                    $device_data['device_name'] = $input['device_name'][$xx];
                    $device_data['sold_by'] = $input['sold_by'][$xx];
                    $device_data['device_points'] = $input['device_points'][$xx];
                    $device_data['retail_cost'] = $input['retail_cost'][$xx];
                    $device_data['purch_price'] = $input['purch_price'][$xx];
                    $device_data['device_qty'] = $input['device_qty'][$xx];
                    $device_data['total_points'] = $input['total_points'][$xx];
                    $device_data['total_cost'] = $input['total_cost'][$xx];
                    $device_data['total_purch_price'] = $input['total_purch_price'][$xx];
                    $device_data['device_net'] = $input['device_net'][$xx];
                    $this->customer_ad_model->add($device_data,"acs_devices");
                    unset($device_data);
                }
            }
            echo "Updated";
        }
    }

    public function remove_customer(){
        $input = array();
        $input['field_name'] = "prof_id";
        $input['id'] = $_POST['prof_id'];
        $input['tablename'] = "acs_profile";
        $modules = array('acs_access','acs_office','acs_alarm','acs_billing');
        if ($this->customer_ad_model->delete($input)) {
            for($x=0;$x<count($modules);$x++){
                $input_mod = array();
                $input_mod['field_name'] = "fk_prof_id";
                $input_mod['id'] = $_POST['prof_id'];
                $input_mod['tablename'] = $modules[$x];
                $this->customer_ad_model->delete($input_mod);
            }
            echo "Done";
        }
    }

    public function remove_lead(){
        $input = array();
        $input['field_name'] = "leads_id";
        $input['id'] = $_POST['lead_id'];
        $input['tablename'] = "ac_leads";
        $this->customer_ad_model->delete($input);
        echo "Done";
    }

    public function remove_devices(){
        $input = array();
        $input['field_name'] = "dev_id";
        $input['id'] = $_POST['id'];
        $input['tablename'] = "acs_devices";
        $this->customer_ad_model->delete($input);
        echo "Done";
    }

    public function remove_task(){
        $input = array();
        $input['field_name'] = "task_id";
        $input['id'] = $_POST['id'];
        $input['tablename'] = "acs_tasks";
        $this->customer_ad_model->delete($input);
        echo "Done";
    }

    public function update_custom_fields(){
        $input = $this->input->post();
        $file_array = array();
        //print_r($input);
        for($x=0;$x<count($input['fieldname']);$x++){
            $file_array[$x]['field_name'] = $input['fieldname'][$x];
            $file_array[$x]['field_value'] = $input['fieldvalue'][$x];
        }
        unset($input['fieldname']);
        unset($input['fieldvalue']);
        $input['custom_fields'] = json_encode($file_array);
        if($this->customer_ad_model->update_data($input,"acs_profile","prof_id")){
            echo "Success";
        }else{
            echo "Done";
        }
    }


    public function import_customer()
    {
        $user_id = logged('id');
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->load->view('customer/import_customer', $this->page_data);
    }

    public function add_lead($lead_id=0)
    {
        $is_allowed = $this->isAllowedModuleAccess(43);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer_add_leads';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        if(isset($lead_id)){
            $this->page_data['leads_data'] = $this->customer_ad_model->get_data_by_id('leads_id',$lead_id,"ac_leads");
        }
        $input = $this->input->post();
        $convert_lead = $this->input->post('convert_customer');
        if(isset($convert_lead)){
            if (!isset($input['leads_id'])) {
                unset($input['credit_report']);
                unset($input['report_history']);
                unset($input['convert_customer']);
                $this->customer_ad_model->add($input, "ac_leads");
            }

            $input_profile = array();
            $input_profile['fk_user_id'] = logged('id');
            //$input_profile['fk_sa_id'] = $input['fk_sa_id'];
            $input_profile['first_name'] = $input['firstname'];
            $input_profile['middle_name'] = strtoupper($input['middle_initial']);
            $input_profile['last_name'] = $input['lastname'];
            $input_profile['suffix'] = $input['suffix'];
            $input_profile['country'] = $input['country'];
            $input_profile['zip_code'] = $input['zip'];
            $input_profile['state'] = $input['state'];
            $input_profile['city'] = $input['city'];
            $input_profile['email'] = $input['email_add'];

            $profile_id = $this->customer_ad_model->add($input_profile,"acs_profile");

            if(isset($profile_id)){
                redirect(base_url('customer/add_advance/'.$profile_id));
            }
            //print_r($input);
            //echo "Convert na";
        }else {
            if ($input) {
                unset($input['credit_report']);
                unset($input['report_history']);
                print_r($input);

                if (isset($input['leads_id'])) {
                    if ($this->customer_ad_model->update_data($input, "ac_leads", "leads_id")) {
                        redirect(base_url('customer/leads'));
                    } else {
                        echo "Error";
                    }
                } else {
                    if ($this->customer_ad_model->add($input, "ac_leads")) {
                        redirect(base_url('customer/leads'));
                    } else {
                        echo "Error";

                    }
                }
            } else {
                $user_id = logged('id');
                $cid=logged('company_id');
                $this->page_data['company_id'] = $cid;
                $this->page_data['plans'] = "";
                $this->page_data['users'] = $this->users_model->getUsers();
                $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE, "", "ASC", "ac_leadtypes", "lead_id");
                $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE, "", "ASC", "ac_salesarea", "sa_id");
                $this->load->view('customer/add_lead', $this->page_data);
            }
        }
    }

    public function add_audit_import_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if(empty($input['ai_id'])){
            unset($input['ai_id']);
            if($this->customer_ad_model->add($input,"acs_audit_import")){
                echo "Success";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"acs_audit_import","ai_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }

    public function add_new_customer_from_jobs(){
        $input = $this->input->post();
        // customer_ad_model
        if($input){
            $input['company_id'] = logged('company_id'); ;
            if ($this->customer_ad_model->add($input, "acs_profile")) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }

    public function add_furnisher_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if($this->customer_ad_model->add($input,"acs_furnisher")){
            echo "Success";
        }else{
            echo "Error";
        }
//        else{
//            if($this->customer_ad_model->update_data($input,"acs_audit_import","ai_id")){
//                echo "Updated";
//            }else{
//                echo "Error";
//            }
//        }
    }

    public function add_reasons_ajax(){
        $input = $this->input->post();
        if($this->customer_ad_model->add($input,"acs_reasons")){
            echo "Success";
        }else{
            echo "Error";
        }
    }

    public function fetch_reasons_data()
    {
        $reasons = $this->customer_ad_model->get_all(1, "", "DESC", "acs_reasons", "reason_id");
        echo json_encode($reasons);
    }

    public function fetch_all_reasons_data()
    {
        $reasons = $this->customer_ad_model->get_all(FALSE, "", "ASC", "acs_reasons", "reason_id");
        echo json_encode($reasons);
    }

    public function delete_reason(){
        $input = array();
        $input['field_name'] = "reason_id";
        $input['id'] = $_POST['reason_id'];
        $input['tablename'] = "acs_reasons";
        if ($this->customer_ad_model->delete($input)) {
            echo  "Done";
        }
    }

    public function add_task_ajax(){
        $input = $this->input->post();
        if(empty($input['task_id'])){
            unset($input['task_id']);
            if($this->customer_ad_model->add($input,"acs_tasks")){
                echo "Success";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"acs_tasks","task_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }

    // for addling of Lead Type (ac_leadtypes table)
    public function add_leadtype_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if(empty($input['lead_id'])){
            unset($input['lead_id']);
            if($this->customer_ad_model->add($input,"ac_leadtypes")){
                echo "Success";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"ac_leadtypes","lead_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }

    public function add_salesarea_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if(empty($input['sa_id'])){
            unset($input['sa_id']);
            if($this->customer_ad_model->add($input,"ac_salesarea")){
                echo "Sales Area Added!";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"ac_salesarea","sa_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }

    public function add_leadsource_ajax(){
        $input = $this->input->post();
        // customer_ad_model
        if(empty($input['ls_id'])){
            unset($input['ls_id']);
            if($this->customer_ad_model->add($input,"ac_leadsource")){
                echo "Lead Source Added!";
            }else{
                echo "Error";
            }
        }else{
            if($this->customer_ad_model->update_data($input,"ac_leadsource","ls_id")){
                echo "Updated";
            }else{
                echo "Error";
            }
        }
    }

    public function update_customer_profile(){
        $input = array();
        $input['notes'] = $_POST['notes'];
        $input['prof_id'] = $_POST['id'];
        if($this->customer_ad_model->update_data($input,"acs_profile","prof_id")){
            echo "Success";
        }else{
            echo "Error";
        }
    }

    public function fetch_leadtype_data()
    {
        $lead_types = $this->customer_ad_model->get_all(FALSE, "", "DESC", "ac_leadtypes", "lead_id");
        echo json_encode($lead_types);
    }

    public function fetch_leadsource_data(){
        $lead_source = $this->customer_ad_model->get_all(FALSE,"","DESC","ac_leadsource","ls_id");
        echo json_encode($lead_source);
    }

    public function fetch_salesarea_data(){
        $lead_types = $this->customer_ad_model->get_all(FALSE,"","DESC","ac_salesarea","sa_id");
        echo json_encode($lead_types);
    }

    public function delete_data(){
        $tbl = $_POST['table'];
        $input = array();
        switch($tbl){
            case "sa":
                $input['field_name'] = "sa_id";
                $input['id'] = $_POST['id'];
                $input['tablename'] = "ac_salesarea";
                break;
            case "lt":
                $input['field_name'] = "lead_id";
                $input['id'] = $_POST['id'];
                $input['tablename'] = "ac_leadtypes";
                break;
            case "ls":
                $input['field_name'] = "ls_id";
                $input['id'] = $_POST['id'];
                $input['tablename'] = "ac_leadsource";
                break;
            default;
        }
        if ($this->customer_ad_model->delete($input)) {
            echo  "nice";
        }
    }

    public function send_qr($id=null)
    {
        $info = $this->customer_ad_model->get_data_by_id('prof_id',$id,"acs_profile");
        $to = $info->email;
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'nsmartrac@gmail.com',
            'smtp_pass' => 'nSmarTrac2020',
            'mailtype' => 'html',
            'charset' => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@nsmartrac.com', 'nSmarTrac');
        $this->email->to($to);
        $this->email->subject('QR Details');
        $this->email->message('This is customer QR.');
        $this->email->attach($_SERVER['DOCUMENT_ROOT'] . '/assets/img/customer/qr/'.$id.'.png');

        if ($this->email->send()) {
            echo json_encode("Congratulation Email Sent Successfully.");
        } else {
            echo json_encode($this->email->send());
        }
    }

    public function sendqr(){
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'welyelfhisula@gmail.com',
            'smtp_pass' => 'wrhisula1123',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'starttls'  => true,
            'smtp_timeout' =>'60',
            'crlf'     => "\n",
            'validation'  => TRUE,
            'wordwrap' => TRUE,
    );
        $this->load->library('email',$config);
        //$this->email->initialize($config);
       // $this->email->set_mailtype("html");
        //Email content
        $this->email->set_newline("\r\n");
        $this->email->to('wrhisula1123@gmail.com');
        $this->email->from('welyelfhisula@gmail.com','MyWebsite');
        $this->email->subject('QR Details');
        $this->email->message('Testing the email class.');
        //Send email
       $this->email->send();
       show_error($this->email->print_debugger());
    }

    public function get_customer_import_header(){

            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->load->library('CSVReader');
                $csvData = $this->csvreader->get_header($_FILES['file']['tmp_name']);

                if (!empty($csvData)) {
                    foreach ($csvData as $row) {
                        //echo $row['MonitoringID'];
                    }
                    //print_r($csvData);
                    echo json_encode($csvData,true);
                }else{
                    echo 'error';
                }
            }

    }

    public function import_customer_data() {
        $data = array();
        $input_profile = array();
        $input = $this->input->post();
        if ($input) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->load->library('CSVReader');
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);
                     /*
                         ALTER TABLE acs_profile MODIFY `business_name` varchar(255) null;
                         ALTER TABLE acs_profile MODIFY `prefix` varchar(20) null;
                         ALTER TABLE acs_profile MODIFY `suffix` varchar(20) null;
                         ALTER TABLE acs_profile MODIFY `middle_name` varchar(50) null;
                         ALTER TABLE acs_profile MODIFY `date_of_birth` varchar(50) null;
                         ALTER TABLE acs_profile MODIFY `ssn` varchar(50) null;
                     */
                     //print_r($csvData);
                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            //print_r($row);
                            $rowCount++;
                            $input_profile = array(
                                'fk_user_id' => logged('id'),
                                'fk_sa_id' => 0,
                                'first_name' => $row['FirstName'],
                                'last_name' => $row['LastName'],
                                'business_name' => $row['Company'],
                                'status' => $row['Status'],
                                'mail_add' => $row['Address'],
                                'city' => $row['City'],
                                'email' => $row['Email'],
                                'state' => $row['State'],
                                'zip_code' => $row['Zip'],
                                'country' => 'USA',
                                'company_id' => logged('company_id'),
                            );
                            if(!empty( $row['FirstName']) && !empty( $row['LastName'])) {
                                $check_user = array(
                                    'where' => array(
                                        'first_name' => $row['FirstName'],
                                        'last_name' => $row['LastName'],
                                        'company_id' => logged('company_id'),
                                    ),
                                    'returnType' => 'count'
                                );
                                $prevCount = $this->customer_ad_model->check_if_user_exist($check_user, 'acs_profile');

                                if ($prevCount > 0) {
                                    echo $row['FirstName'].' '. $row['LastName'].' exist!'; echo "<br>";
//                                $condition = array('contact_name' => $row['Contact Name']);
//                                $update = $this->customer_model->update($itemData, $condition);
//                                if ($update) {
//                                    $updateCount++;
//                                }
                                } else {
                                    $cs2 = $row['CreditScore2'];
                                    $score2 = 0;
                                    switch ($cs2){
                                        case 'A':
                                            $score2 = 700;
                                            break;
                                        case 'B':
                                            $score2 = 650;
                                            break;
                                        case 'C':
                                            $score2 = 625;
                                            break;
                                        case 'D':
                                            $score2 = 600;
                                            break;
                                        case 'F':
                                            $score2 = 599;
                                            break;
                                        default:
                                            $score2 = 0;
                                    }
                                    //$insert = $this->customer_ad_model->insert($itemData);
                                    $fk_prod_id = $this->customer_ad_model->add($input_profile,"acs_profile");
                                    if ($fk_prod_id) {
                                        $insertCount++;
                                        $input_alarm = array(
                                            'fk_prof_id' => $fk_prod_id,
                                            'panel_type' => $row['PanelType'],
                                            'passcode' => $row['AbortCode'],
                                            'credit_score_alarm' => $row['CreditScore'],
                                            'monitor_comp' => $row['MonitoringCompany'],
                                            'install_date' => $row['InstallDate'],
                                            'monitor_id' => $row['MonitoringID'],
                                            'acct_type' => $row['AccountType'],
                                        );

                                        $input_office = array(
                                            'fk_prof_id' => $fk_prod_id,
                                            'sales_date' => $row['SaleDate'],
                                            'fk_sales_rep_office' => 1,//$row['SalesRep'],
                                            'technician' => $row['Technician'],
                                            'credit_score' => $score2,
                                        );

                                        if(logged('company_id') == 2){
                                            $input_billing = array(
                                                'fk_prof_id' => $fk_prod_id,
                                                'mmr' => $row['MonthlyMonitoringRate'],
                                                'contract_term' => $row['ContractTerm'],
                                                'routing_num' => $row['Routing#'],
                                                'acct_num' => $row['Acct#'],
                                                'credit_card_num' => $row['CC#'],
                                                'credit_card_exp' => $row['Exp date'],
                                                'ach_date' => $row['Ach date'],
                                            );
                                        }else{
                                            $input_billing = array(
                                                'fk_prof_id' => $fk_prod_id,
                                                'mmr' => $row['MonthlyMonitoringRate'],
                                                'contract_term' => $row['ContractTerm'],
                                            );
                                        }

                                        $this->customer_ad_model->add($input_alarm,"acs_alarm");
                                        $this->customer_ad_model->add($input_office,"acs_office");
                                        $this->customer_ad_model->add($input_billing,"acs_billing");
                                    }
                                    echo $row['FirstName'].' '. $row['LastName'].' has been added!'; echo "<br>";
                                }
                            }
                        }
                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        //$successMsg = 'Customer imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                       // $this->session->set_userdata('success_msg', $successMsg);

                        //$this->activity_model->add($successMsg);
                        //$this->session->set_flashdata('alert-type', 'success');
                        //$this->session->set_flashdata('alert', $successMsg);
                    }
                    redirect(base_url('customer'));
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                }
        }
        //redirect('customer');
    }

    public function customer_export()
    {

        $user_id = logged('id');
        //$items = $this->customer_model->getByCompanyId(logged('company_id'));
        //$items =  $this->customer_ad_model->get_customer_data('fk_user_id',$user_id,"acs_profile");
        $items =  $this->customer_ad_model->get_customer_data($user_id);

        $delimiter = ",";
        $filename = getLoggedName()."_customers.csv";

        $f = fopen('php://memory', 'w');

        $fields = array('MonitoringID', 'LastName', 'FirstName', 'Company', 'PanelType', 'AccountType', 'InstallDate', 'SaleDate', 'MonthlyMonitoringRate', 'SalesRep', 'Status', 'EquipmentStatus',
                        'AbortCode','Address','Address1','Area','City','State','Zip','ContractTerm','CreditScore','CreditScore2','Email','MonitoringCompany','StatusID','Technician');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $item) {
                $csvData = array(
                    $item->monitor_id,
                    $item->last_name,
                    $item->first_name,
                    $item->business_name,
                    $item->panel_type,
                    $item->acct_type,
                    $item->install_date,
                    $item->sales_date,
                    $item->mmr,
                    $item->fk_sales_rep_office,
                    $item->status,
                    $item->status,
                    $item->passcode,
                    $item->mail_add,
                    $item->mail_add,
                    'COR',
                    $item->city,
                    $item->state,
                    $item->zip_code,
                    $item->contract_term,
                    $item->credit_score,
                    $item->credit_score,
                    $item->email,
                    $item->monitor_comp,
                    3,
                    $item->technician,
                );
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');

        fpassthru($f);
    }

    public function customer_signature_upload(){
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
            $uniquesavename=time().uniqid(rand());
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $destination = 'uploads/customer/' .$uniquesavename.'.'.$ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);

            $sourceFile = $_SERVER['DOCUMENT_ROOT'].'/'.$destination;
            $content = file_get_contents($sourceFile,FILE_USE_INCLUDE_PATH);
            $input =  array();

            $input = array();
            $input['prof_sign_img'] = '/'.$destination;
            $input['prof_id'] = $_POST['id'];
            if($this->customer_ad_model->update_data($input,"acs_profile","prof_id")){
                echo '/'.$destination;
            }else{
                echo "Error";
            }


        }
    }

    public function view($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {

            foreach ($customer as $key => $value) {

                if (is_serialized($value)) {

                    $customer->{$key} = unserialize($value);
                }
            }

            $customer->company = get_company_by_user_id();

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/mixedview', $this->page_data);
    }
    /**
     * @param $id
     */
    public function genview($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {

            foreach ($customer as $key => $value) {

                if (is_serialized($value)) {

                    $customer->{$key} = unserialize($value);
                }
            }

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/genview', $this->page_data);
    }
    /**
     * @param $id
     */
    public function mixedview($id)
    {
        $customer = get_customer_by_id($id);

        if (!empty($customer)) {

            foreach ($customer as $key => $value) {

                if (is_serialized($value)) {

                    $customer->{$key} = unserialize($value);
                }
            }

            $this->page_data['customer'] = $customer;
        }

        $this->load->view('customer/mixedview', $this->page_data);
    }

    public function edit($id)
    {
        $company_id = logged('company_id');

        $user_id = logged('id');

        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();


        $this->load->model('Users_model', 'users_model');


        if ($parent_id->parent_id == 1) {

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);

        } else {

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);

        }

        $this->page_data['customer'] = $this->customer_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['customer'] = $this->customer_model->getById($id);

        //$this->page_data['customer']->service_address = unserialize($this->page_data['customer']->service_address);

        $this->page_data['customer']->additional_contacts = unserialize($this->page_data['customer']->additional_contacts);

        $this->page_data['customer']->additional_info = unserialize($this->page_data['customer']->additional_info);

        $this->page_data['customer']->card_info = unserialize($this->page_data['customer']->card_info);

        if (is_serialized($this->page_data['customer']->phone)) {
            $this->page_data['customer']->phone = unserialize($this->page_data['customer']->phone)['number'];
        }
        $this->page_data['customer']->customer_group = unserialize($this->page_data['customer']->customer_group);

        $this->page_data['groups'] = get_customer_groups();


        $this->load->model('Source_model', 'source_model');

        $this->page_data['customer']->service_address = $this->customeraddress_model->getByModelAndType($id,'customer','service_address');

        $this->page_data['customer']->source = $this->source_model->getSource($this->page_data['customer']->source_id);


        $this->load->view('customer/edit', $this->page_data);

    }

    public function save()
    {
        $user = (object)$this->session->userdata('logged');
        $company_id = logged('company_id');
        $data = array(
            'customer_type' => post('customer_type'),
            'contact_name' => post('contact_name'),
            'contact_email' => post('contact_email'),
            'mobile' => post('contact_mobile'),
            'phone' => post('contact_phone'),
            'notification_method' => post('notify_by'),
            'street_address' => post('street_address'),
            'suite_unit' => post('suite_unit'),
            'city	' => post('city'),
            'postal_code' => post('zip'),
            'state' => post('state'),
            'birthday' => post('birthday'),
            'source_id' => post('customer_source_id'),
            'comments' => post('notes'),
            'user_id' => $user->id,
            'additional_info' => (!empty(post('additional'))) ? serialize(post('additional')) : NULL,
            'card_info' => (!empty(post('card'))) ? serialize(post('card')) : NULL,
            'company_id' => $company_id,
            'customer_group' => (!empty(post('customer_group'))) ? serialize(post('customer_group')) : serialize(array()),
        );

        // previously generated customer id
        // this id will be present on session if addition contact or service address has been added
        $cid = $this->session->userdata('customer_id');
        // if no addition contact or service address has been added
        // create() will be called insted of update()
        // if (!empty($cid)) {
        //     $id = $this->customer_model->update($cid, $data);
        // } else {
            $id = $this->customer_model->create($data);
            if(!empty($this->input->post('service_address')))
            {
                foreach($this->input->post('service_address') as $key => $value)
                {
                    $temp_data = $value;
                    $temp_data['customer_id'] = $id;
                    $temp_data['module'] = 'customer';
                    $temp_data['type'] = 'service_address';
                    $this->customeraddress_model->create($temp_data);
                }
            }

        // }

        // $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'New Customer Created Successfully');


        // clear sessions

        $this->session->unset_userdata('uid');

        $this->session->unset_userdata('customer_id');
        redirect('customer');

    }

    public function update($id)

    {

        $user = (object)$this->session->userdata('logged');

        $company_id = logged('company_id');

        $data = array(


            'customer_type' => post('customer_type'),

            'contact_name' => post('contact_name'),

            'contact_email' => post('contact_email'),

            'mobile' => post('contact_mobile'),

            'phone' => post('contact_phone'),

            'notification_method' => post('notify_by'),

            'street_address' => post('street_address'),

            'suite_unit' => post('suite_unit'),

            'city	' => post('city'),

            'postal_code' => post('zip'),

            'state' => post('state'),

            'birthday' => date('Y-m-d', strtotime(post('birthday'))),

            'source_id' => post('customer_source_id'),

            'comments' => post('notes'),

            'user_id' => $user->id,

            'additional_info' => (!empty(post('additional'))) ? serialize(post('additional')) : NULL,

            'card_info' => (!empty(post('card'))) ? serialize(post('card')) : NULL,

            'company_id' => $company_id,

            'customer_group' => (!empty(post('customer_group'))) ? serialize(post('customer_group')) : serialize(array()),

        );


        $id = $this->customer_model->update($id, $data);


        if(!empty($this->input->post('service_address'))>0)
        {
            foreach($this->input->post('service_address') as $key => $value)
            {
                $temp_data = $value;
                unset($temp_data['id']);

                if(isset($value['id']) && $value['id'] != '' && $value['id'] > 0)
                {
                  // $this->customeraddress_model->update($temp_data)->where('id',$value->id);
                   // $this->db->where('id', $id);
                   //  $this->db->update('user', $data);
                   $this->db->where('id', $value['id']);
                    $this->db->update($this->customeraddress_model->table, $temp_data);
                } else {
                    $temp_data['customer_id'] = $id;
                    $temp_data['module'] = 'customer';
                    $temp_data['type'] = 'service_address';
                    $this->customeraddress_model->create($temp_data);
                }
            }
        }


        if($this->input->post('service_address_container_deleted_addresses') !='')
        {
            $delete_list = explode(",", $this->input->post('service_address_container_deleted_addresses'));
            $this->db->from($this->customeraddress_model->table);
            $this->db->where('customer_id ', $id);
            $this->db->where_in('id', $delete_list);
            $this->db->delete();
        }

        $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));

        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Customer has been Updated Successfully');


        die(json_encode(

            array(

                'url' => base_url('customer')

            )

        ));

    }

    public function service_address_form()
    {

        $get = $this->input->get();
        if (!empty($get)) {


            $this->page_data['action'] = $get['action'];

            $this->page_data['data_index'] = $get['index'];

            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);

            $this->page_data['service_address'] = $this->customer_model->getServiceAddress(array('id' => $get['customer_id']), $get['index']);

            // print_r($this->page_data['service_address']); die;

        }


        die($this->load->view('customer/service_address_form', $this->page_data, true));

    }


    public function save_service_address()
    {

        $post = $this->input->post();


        // save service address to db

        if (!empty($post['customer_id'])) {

            $cid = $post['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (empty($cid))

            $customer_id = $this->customer_model->saveServiceAddress($post);

        else {

            $this->customer_model->saveServiceAddress($post, $cid);

        }


        if (empty($cid)) {

            $this->session->set_userdata(['customer_id' => $customer_id]);

        } else {

            $customer_id = $cid;

        }


        die(json_encode(

            array(

                'customer_id' => $customer_id

            )

        ));

    }

    public function json_get_additional_contacts()

    {

        $get = $this->input->get();


        if (!empty($get['customer_id'])) {

            $cid = $get['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (!empty($cid)) {


            $this->page_data['customer_id'] = $cid;

            $this->page_data['additionalContacts'] = $this->customer_model->getAdditionalContacts(array('id' => $cid));

            // echo '<pre>'; print_r($serviceAddresses); die;

        }


        die($this->load->view('customer/additional_contact_list', $this->page_data, true));

    }


    public function save_additional_contact()

    {


        $post = $this->input->post();


        // clear sessions

        // $this->session->unset_userdata('uid');

        // $this->session->unset_userdata('customer_id');


        // save service address to db

        if (!empty($post['customer_id'])) {

            $cid = $post['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (empty($cid))

            $customer_id = $this->customer_model->saveAdditionalContact($post);

        else {

            $this->customer_model->saveAdditionalContact($post, $cid);

        }


        if (empty($cid)) {

            $this->session->set_userdata(['customer_id' => $customer_id]);

        } else {

            $customer_id = $cid;

        }


        die(json_encode(

            array(

                'customer_id' => $customer_id

            )

        ));

    }


    public function remove_additional_contact()

    {


        $post = $this->input->post();


        if ($this->customer_model->removeAdditionalContact($post['customer_id'], $post['index'])) {


            die(json_encode(

                array(

                    'status' => 'success'

                )
            ));

        } else {


            die(json_encode(

                array(

                    'status' => 'error'

                )

            ));

        }

    }


    public function json_dropdown_customer_list()
    {


        $get = $this->input->get();

        $company_id = logged('company_id');

        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id, $get);

        }

        if ($role == 4) {

            $this->page_data['customers'] = $this->customer_model->getAllByUserId('', '', 0, 0, $get);

        }

        $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id, $get);

        die(json_encode($this->page_data['customers']));

    }



    /**
     * @param $id
     */
    public function delete($id)

    {

        if ($id !== 1 && $id != logged($id)) {
        } else {

            redirect('/', 'refresh');

            return;
        }


        $id = $this->customer_model->delete($id);


        $this->activity_model->add("Customer #$id Deleted by User:" . logged('name'));


        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Customer has been Deleted Successfully');


        redirect('customer');
    }


    public function group()
    {
        $is_allowed = $this->isAllowedModuleAccess(11);
        if( !$is_allowed ){
            $this->page_data['module'] = 'customer_group';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        // pass the $this so that we can use it to load view, model, library or helper classes
       // $customerGroup = new CustomerGroup($this);
        $this->page_data['customerGroups'] =  $this->customer_ad_model->get_all_by_id('user_id',logged('id'),'customer_groups');
        $this->load->view('customer/group/list', $this->page_data);
    }

    public function group_add()
    {
        $is_allowed = $this->isAllowedModuleAccess(11);
        if (!$is_allowed) {
            $this->page_data['module'] = 'customer_group';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        // pass the $this so that we can use it to load view, model, library or helper classes
        //$customerGroup = new CustomerGroup($this);
        $input = $this->input->post();
        if ($input) {
            $input['user_id'] = logged('id');
            $input['date_added'] = date("d-m-Y h:i A");
            $input['company_id'] = logged('company_id');
            if ($this->customer_ad_model->add($input, "customer_groups")) {
                redirect(base_url('customer/group'));
            }
        }
        $this->page_data['page_title'] = 'Customer Group Add';
        $this->load->view('customer/group/add', $this->page_data);
    }

    public function categorizeNameAlphabetically($items) {
        $result = array();

        $cat = array(
            '#' => array(),
            'A' => array(),
            'B' => array(),
            'C' => array(),
            'D' => array(),
            'E' => array(),
            'F' => array(),
            'G' => array(),
            'H' => array(),
            'I' => array(),
            'J' => array(),
            'K' => array(),
            'L' => array(),
            'M' => array(),
            'N' => array(),
            'O' => array(),
            'P' => array(),
            'Q' => array(),
            'R' => array(),
            'S' => array(),
            'T' => array(),
            'U' => array(),
            'V' => array(),
            'W' => array(),
            'X' => array(),
            'Y' => array(),
            'Z' => array()
        );

        foreach($items as $item) {
            $letter = ucfirst(substr($item->contact_name,0,1));
            foreach($cat as $key => $c) {
                if ($letter == $key) {
                    array_push($cat[$key], $item);
                } else if (is_numeric($letter)) {
                    if (!in_array($item, $cat["#"]))
                        array_push($cat["#"], $item);
                }
            }
        }

        foreach($cat as $key => $c) {
            if(!empty($c)) {
                $header = array($key, "header", "", "");
                array_push($result,$header);

                foreach($c as $v) {
                    $value = array($v->id, $v->contact_name, $v->contact_email, $v->phone);
                    array_push($result,$value);
                }
            }
        }

        return $result;
    }

    public function ticketslist(){
        // $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('tickets/list', $this->page_data);
    }

    public function addTicket()
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('tickets/add', $this->page_data);
    }

    public function merchant(){
        $this->load->model('Users_model');
        $this->load->model('Clients_model');
        $this->load->model('ConvergeMerchant_model');

        $user_id = logged('id');
        $company_id = logged('company_id');

        $user     = $this->Users_model->getUser($user_id);
        $company  = $this->Clients_model->getById($company_id);
        $merchant = $this->ConvergeMerchant_model->getByCompanyId($company_id);

        $this->page_data['merchant'] = $merchant;
        $this->page_data['user'] = $user;
        $this->page_data['company'] = $company;
        $this->load->view('customer/merchant', $this->page_data);
    }

    public function send_merchant_details(){
        $this->load->model('ConvergeMerchant_model');

        $post = $this->input->post();

        $company_id = logged('company_id');
        $merchant   = $this->ConvergeMerchant_model->getByCompanyId($company_id);

        $is_mailing = 0;
        if( isset($post['is_mailing']) ){
            $is_mailing = 1;
        }

        $is_shipping = 0;
        if( isset($post['is_shipping']) ){
            $is_shipping = 1;
        }

        $is_see_special_instructions = 0;
        if( isset($post['is_see_special_instructions']) ){
            $is_see_special_instructions = 1;
        }

        $is_beneficial_owner = 0;
        if( isset($post['is_beneficial_owner']) ){
            $is_beneficial_owner = 1;
        }

        $is_authorized_signer = 0;
        if( isset($post['is_authorized_signer']) ){
            $is_authorized_signer = 1;
        }

        $is_sole_proprietor = 0;
        if( isset($post['is_sole_proprietor']) ){
            $is_sole_proprietor = 1;
        }

        $is_principal_llc = 0;
        if( isset($post['principal_llc']) ){
            $is_sole_proprietor = 1;
        }

        $is_principal_corporation = 0;
        if( isset($post['principal_corporation']) ){
            $is_principal_corporation = 1;
        }

        $is_principal_others = 0;
        if( isset($post['principal_others']) ){
            $is_principal_others = 1;
        }

        $post['is_mailing']  = $is_mailing;
        $post['is_shipping'] = $is_shipping;
        $post['is_see_special_instructions'] = $is_see_special_instructions;
        $post['is_beneficial_owner']  = $is_beneficial_owner;
        $post['is_authorized_signer'] = $is_authorized_signer;
        $post['is_sole_proprietor']   = $is_sole_proprietor;
        $post['principal_llc'] = $is_principal_llc;
        $post['principal_corporation'] = $is_principal_corporation;
        $post['principal_others'] = $is_principal_others;

        if( $merchant ){
            $this->ConvergeMerchant_model->update($merchant->id, $post);
        }else{
            $post['company_id'] = $company_id;
            $this->ConvergeMerchant_model->create($post);
        }

        //Send Email
        $message = "<p>Below is the user merchant details.</p><br />";
        $message .= "<table>";
            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>COMPANY INFORMATION</h5></td></tr>";
            $message .= "<tr><td>DBA NAME</td><td>".$post['dba_name']."</td></tr>";
            $message .= "<tr><td>LEGAL BUSINESS NAME</td><td>".$post['legal_business_name']."</td></tr>";
            $message .= "<tr><td>CONTANCT NAME</td><td>".$post['contact_name']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS TYPE</td><td>".$post['dba_address_type']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 1 (NO PO BOX)</td><td>".$post['dba_address_1']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 2</td><td>".$post['dba_address_2']."</td></tr>";
            $message .= "<tr><td>CITY</td><td>".$post['city']."</td></tr>";
            $message .= "<tr><td>STATE</td><td>".$post['state']."</td></tr>";
            $message .= "<tr><td>ZIP CODE</td><td>".$post['zip_code']."</td></tr>";
            $message .= "<tr><td>DBA PHONE NO.</td><td>".$post['dba_phone_no']."</td></tr>";
            $message .= "<tr><td>EMAIL ADDRESS</td><td>".$post['email_address']."</td></tr>";
            $message .= "<tr><td>MOBILE PHONE NO.</td><td>".$post['mobile_phone_no']."</td></tr>";
            $message .= "<tr><td>YEAR ESTABLISHED</td><td>".$post['years_established']."</td></tr>";
            $message .= "<tr><td>LENGTH OF CURRENT OWNERSHIP</td><td>".$post['length_ownership']."</td></tr>";
            $message .= "<tr><td>YEARS</td><td>".$post['ownership_years']."</td></tr>";
            $message .= "<tr><td>MONTHS</td><td>".$post['ownership_months']."</td></tr>";

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>OTHER ADDRESS (IF DIFFERENT FROM ABOVE)</h5></td></tr>";
            $message .= "<tr><td>IS MAILING</td><td>".($post['is_mailing'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>IS SHIPPING</td><td>".($post['is_shipping'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>IS SEE ALSO SPECIAL INSTRUCTIONS</td><td>".($post['is_see_special_instructions'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>LOCATION NAME</td><td>".$post['other_address_location_name']."</td></tr>";
            $message .= "<tr><td>PHONE NO.</td><td>".$post['other_address_phone_no']."</td></tr>";
            $message .= "<tr><td>CONTACT NO.</td><td>".$post['other_address_contact_no']."</td></tr>";
            $message .= "<tr><td>BEST CONTACT NO.</td><td>".$post['other_address_best_contact_no']."</td></tr>";
            $message .= "<tr><td>BEST TIME TO CALL</td><td>".$post['other_address_best_time_call_from']."-".$post['other_address_best_time_call_to']."</td></tr>";
            $message .= "<tr><td>FAX NO.</td><td>".$post['other_address_fax_no']."</td></tr>";
            $message .= "<tr><td>ADDRESS</td><td>".$post['other_address_address']."</td></tr>";
            $message .= "<tr><td>CITY</td><td>".$post['other_address_city']."</td></tr>";
            $message .= "<tr><td>STATE</td><td>".$post['other_address_state']."</td></tr>";
            $message .= "<tr><td>ZIP CODE</td><td>".$post['other_address_zipcode']."</td></tr>";

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BUSINESS STRUCTURES</h5></td></tr>";
            $message .= "<tr><td>IS LLC</td><td>".($post['principal_llc'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>IS CORPORATION</td><td>".($post['principal_corporation'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>IS SOLE PROPRIETORSHIP</td><td>".($post['is_sole_proprietor'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>OTHER</td><td>".($post['principal_others'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>FEDERAL ID NUMBER</td><td>".$post['federal_id_number']."</td></tr>";

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PRINCIPAL 1 INFORMATION (Include all additional owners with 25% or greater ownership (Individual or Intermediary Business) on the Addl ownership ownership form)</h5></td></tr>";
            $message .= "<tr><td>IS BENEFICIAL OWNER</td><td>".($post['is_beneficial_owner'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>PERCENTAGE OWNERSHIP</td><td>".$post['percentage_ownership']."</td></tr>";
            $message .= "<tr><td>IS AUTHORIZED SIGNER</td><td>".($post['is_authorized_signer'] == 1 ? 'YES' : 'NO')."</td></tr>";
            $message .= "<tr><td>FIRST NAME</td><td>".$post['principal_firstname']."</td></tr>";
            $message .= "<tr><td>MIDDLE NAME</td><td>".$post['principal_middlename']."</td></tr>";
            $message .= "<tr><td>LAST NAME</td><td>".$post['principal_lastname']."</td></tr>";
            $message .= "<tr><td>ADDRESS (NO PO BOX)</td><td>".$post['principal_address']."</td></tr>";
            $message .= "<tr><td>PHONE NO</td><td>".$post['principal_phone_no']."</td></tr>";
            $message .= "<tr><td>CITY</td><td>".$post['principal_city']."</td></tr>";
            $message .= "<tr><td>STATE/PROVINCE</td><td>".$post['principal_state_province']."</td></tr>";
            $message .= "<tr><td>ZIP/POSTAL CODE</td><td>".$post['principal_zip_postal_code']."</td></tr>";
            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PREVIOUS ADDRESS IF CURRENT ADDRESS IS LESS THAN 2 YEARS</h5></td></tr>";
            $message .= "<tr><td>HOME ADDRESS</td><td>".$post['principal_home_address']."</td></tr>";
            $message .= "<tr><td>CITY</td><td>".$post['principal_city_1']."</td></tr>";
            $message .= "<tr><td>STATE</td><td>".$post['principal_state_1']."</td></tr>";
            $message .= "<tr><td>ZIP CODE</td><td>".$post['principal_zip_code_1']."</td></tr>";

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>CREDIT CARD TRANSACTIONS</h5></td></tr>";
            $message .= "<tr><td>ANNUAL REVENUE (ACH, CHECK, CREDIT CARDS)</td><td>".$post['annual_revenue']."</td></tr>";
            $message .= "<tr><td>MONTHLY CREDIT CARD SALES</td><td>".$post['monthly_cc_sales']."</td></tr>";
            $message .= "<tr><td>AVERAGE CREDIT CARD TRANSACTIONS</td><td>".$post['average_cc_transcations']."</td></tr>";
            $message .= "<tr><td>HIGHEST CREDIT CARD TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>".$post['highest_cc_transction_years']."</td></tr>";
            $message .= "<tr><td>CARD NOT PRESENT TRANSACTION</td><td>".$post['card_not_present_transaction']."</td></tr>";

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>ACH CHECKS</h5></td></tr>";
            $message .= "<tr><td>ANNUAL CHECK VOLUME</td><td>".$post['annual_check_volume']."</td></tr>";
            $message .= "<tr><td>AVERAGE CHECK TRANSACTION</td><td>".$post['average_check_transaction']."</td></tr>";
            $message .= "<tr><td>HIGHEST CHECK TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>".$post['highest_check_transaction_years']."</td></tr>";

            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BANK ACCOUNT</h5></td></tr>";
            $message .= "<tr><td>BANK ACCOUNT</td><td>".$post['bank_account']."</td></tr>";
            $message .= "<tr><td>ROUTING NUMBER</td><td>".$post['routing_number']."</td></tr>";
            $message .= "<tr><td>BANK ACCOUNT NUMBER</td><td>".$post['bank_account_number']."</td></tr>";


        $message .= "</table>";
        $message .= "<br /><p>Confidentiality Statement</p>
    <p>This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake, and delete this e-mail from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing, or taking any action in reliance on the contents of this information is strictly prohibited.</p>";

        //Email Sending
        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $server    = MAIL_SERVER;
        $port      = MAIL_PORT ;
        $username  = MAIL_USERNAME;
        $password  = MAIL_PASSWORD;
        $from      = MAIL_FROM;
        $subject   = 'nSmarTrac: Merchant Data Application';
        $mail = new PHPMailer;
        //$mail->SMTPDebug = 4;
        $mail->isSMTP();
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username   = $username;
        $mail->Password   = $password;
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout    =   10; // set the timeout (seconds)
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';

        //$mail->addAddress('moresecureadi@gmail.com', 'moresecureadi@gmail.com');
        $mail->addAddress('joyce.reynolds@elavon.com', 'joyce.reynolds@elavon.com');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;


        $json_data['is_success'] = 1;
        $json_data['error']      = '';

        if(!$mail->Send()) {
            /*echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            exit;*/
            $json_data['is_success'] = 0;
            $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Customer Merchant has been successfully updated');

        echo json_encode($json_data);
        //redirect('customer/merchant');

    }

    public function share_merchant_data()
    {
        $this->load->model('ConvergeMerchant_model');

        $post       = $this->input->post();
        $recipient  = $post['share_email'];
        $user_id    = logged('id');
        $company_id = logged('company_id');

        $merchant = $this->ConvergeMerchant_model->getByCompanyId($company_id);
        if( $merchant ){
            $post = (array)$merchant;
            //Send Email
            $message = "<p>Below is the user merchant details.</p><br />";
            $message .= "<table>";
                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>COMPANY INFORMATION</h5></td></tr>";
                $message .= "<tr><td>DBA NAME</td><td>".$post['dba_name']."</td></tr>";
                $message .= "<tr><td>LEGAL BUSINESS NAME</td><td>".$post['legal_business_name']."</td></tr>";
                $message .= "<tr><td>CONTANCT NAME</td><td>".$post['contact_name']."</td></tr>";
                $message .= "<tr><td>DBA ADDRESS TYPE</td><td>".$post['dba_address_type']."</td></tr>";
                $message .= "<tr><td>DBA ADDRESS 1 (NO PO BOX)</td><td>".$post['dba_address_1']."</td></tr>";
                $message .= "<tr><td>DBA ADDRESS 2</td><td>".$post['dba_address_2']."</td></tr>";
                $message .= "<tr><td>CITY</td><td>".$post['city']."</td></tr>";
                $message .= "<tr><td>STATE</td><td>".$post['state']."</td></tr>";
                $message .= "<tr><td>ZIP CODE</td><td>".$post['zip_code']."</td></tr>";
                $message .= "<tr><td>DBA PHONE NO.</td><td>".$post['dba_phone_no']."</td></tr>";
                $message .= "<tr><td>EMAIL ADDRESS</td><td>".$post['email_address']."</td></tr>";
                $message .= "<tr><td>MOBILE PHONE NO.</td><td>".$post['mobile_phone_no']."</td></tr>";
                $message .= "<tr><td>YEAR ESTABLISHED</td><td>".$post['years_established']."</td></tr>";
                $message .= "<tr><td>LENGTH OF CURRENT OWNERSHIP</td><td>".$post['length_ownership']."</td></tr>";
                $message .= "<tr><td>YEARS</td><td>".$post['ownership_years']."</td></tr>";
                $message .= "<tr><td>MONTHS</td><td>".$post['ownership_months']."</td></tr>";

                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>OTHER ADDRESS (IF DIFFERENT FROM ABOVE)</h5></td></tr>";
                $message .= "<tr><td>IS MAILING</td><td>".($post['is_mailing'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>IS SHIPPING</td><td>".($post['is_shipping'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>IS SEE ALSO SPECIAL INSTRUCTIONS</td><td>".($post['is_see_special_instructions'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>LOCATION NAME</td><td>".$post['other_address_location_name']."</td></tr>";
                $message .= "<tr><td>PHONE NO.</td><td>".$post['other_address_phone_no']."</td></tr>";
                $message .= "<tr><td>CONTACT NO.</td><td>".$post['other_address_contact_no']."</td></tr>";
                $message .= "<tr><td>BEST CONTACT NO.</td><td>".$post['other_address_best_contact_no']."</td></tr>";
                $message .= "<tr><td>BEST TIME TO CALL</td><td>".$post['other_address_best_time_call_from']."-".$post['other_address_best_time_call_to']."</td></tr>";
                $message .= "<tr><td>FAX NO.</td><td>".$post['other_address_fax_no']."</td></tr>";
                $message .= "<tr><td>ADDRESS</td><td>".$post['other_address_address']."</td></tr>";
                $message .= "<tr><td>CITY</td><td>".$post['other_address_city']."</td></tr>";
                $message .= "<tr><td>STATE</td><td>".$post['other_address_state']."</td></tr>";
                $message .= "<tr><td>ZIP CODE</td><td>".$post['other_address_zipcode']."</td></tr>";

                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BUSINESS STRUCTURES</h5></td></tr>";
                $message .= "<tr><td>IS LLC</td><td>".($post['principal_llc'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>IS CORPORATION</td><td>".($post['principal_corporation'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>IS SOLE PROPRIETORSHIP</td><td>".($post['is_sole_proprietor'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>OTHER</td><td>".($post['principal_others'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>FEDERAL ID NUMBER</td><td>".$post['federal_id_number']."</td></tr>";

                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PRINCIPAL 1 INFORMATION (Include all additional owners with 25% or greater ownership (Individual or Intermediary Business) on the Addl ownership ownership form)</h5></td></tr>";
                $message .= "<tr><td>IS BENEFICIAL OWNER</td><td>".($post['is_beneficial_owner'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>PERCENTAGE OWNERSHIP</td><td>".$post['percentage_ownership']."</td></tr>";
                $message .= "<tr><td>IS AUTHORIZED SIGNER</td><td>".($post['is_authorized_signer'] == 1 ? 'YES' : 'NO')."</td></tr>";
                $message .= "<tr><td>FIRST NAME</td><td>".$post['principal_firstname']."</td></tr>";
                $message .= "<tr><td>MIDDLE NAME</td><td>".$post['principal_middlename']."</td></tr>";
                $message .= "<tr><td>LAST NAME</td><td>".$post['principal_lastname']."</td></tr>";
                $message .= "<tr><td>ADDRESS (NO PO BOX)</td><td>".$post['principal_address']."</td></tr>";
                $message .= "<tr><td>PHONE NO</td><td>".$post['principal_phone_no']."</td></tr>";
                $message .= "<tr><td>CITY</td><td>".$post['principal_city']."</td></tr>";
                $message .= "<tr><td>STATE/PROVINCE</td><td>".$post['principal_state_province']."</td></tr>";
                $message .= "<tr><td>ZIP/POSTAL CODE</td><td>".$post['principal_zip_postal_code']."</td></tr>";
                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>PREVIOUS ADDRESS IF CURRENT ADDRESS IS LESS THAN 2 YEARS</h5></td></tr>";
                $message .= "<tr><td>HOME ADDRESS</td><td>".$post['principal_home_address']."</td></tr>";
                $message .= "<tr><td>CITY</td><td>".$post['principal_city_1']."</td></tr>";
                $message .= "<tr><td>STATE</td><td>".$post['principal_state_1']."</td></tr>";
                $message .= "<tr><td>ZIP CODE</td><td>".$post['principal_zip_code_1']."</td></tr>";

                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>CREDIT CARD TRANSACTIONS</h5></td></tr>";
                $message .= "<tr><td>ANNUAL REVENUE (ACH, CHECK, CREDIT CARDS)</td><td>".$post['annual_revenue']."</td></tr>";
                $message .= "<tr><td>MONTHLY CREDIT CARD SALES</td><td>".$post['monthly_cc_sales']."</td></tr>";
                $message .= "<tr><td>AVERAGE CREDIT CARD TRANSACTIONS</td><td>".$post['average_cc_transcations']."</td></tr>";
                $message .= "<tr><td>HIGHEST CREDIT CARD TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>".$post['highest_cc_transction_years']."</td></tr>";
                $message .= "<tr><td>CARD NOT PRESENT TRANSACTION</td><td>".$post['card_not_present_transaction']."</td></tr>";

                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>ACH CHECKS</h5></td></tr>";
                $message .= "<tr><td>ANNUAL CHECK VOLUME</td><td>".$post['annual_check_volume']."</td></tr>";
                $message .= "<tr><td>AVERAGE CHECK TRANSACTION</td><td>".$post['average_check_transaction']."</td></tr>";
                $message .= "<tr><td>HIGHEST CHECK TRANSACTION AND HOW MANY TIMES A YEAR WILL HAVE</td><td>".$post['highest_check_transaction_years']."</td></tr>";

                $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>BANK ACCOUNT</h5></td></tr>";
                $message .= "<tr><td>BANK ACCOUNT</td><td>".$post['bank_account']."</td></tr>";
                $message .= "<tr><td>ROUTING NUMBER</td><td>".$post['routing_number']."</td></tr>";
                $message .= "<tr><td>BANK ACCOUNT NUMBER</td><td>".$post['bank_account_number']."</td></tr>";

            $message .= "</table>";
            $message .= "<br /><p>Confidentiality Statement</p>
    <p>This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake, and delete this e-mail from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing, or taking any action in reliance on the contents of this information is strictly prohibited.</p>";

            //Email Sending
            include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $subject   = 'nSmarTrac: Merchant Data Application';
            $mail = new PHPMailer;
            //$mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout    =   10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';

            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;


            $json_data['is_success'] = 1;
            $json_data['error']      = '';

            if(!$mail->Send()) {
                /*echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;*/
                $json_data['is_success'] = 0;
                $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }else{
            $json_data['is_success'] = 0;
            $json_data['message']    = '';
        }

        echo json_encode($json_data);
    }

}
