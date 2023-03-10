<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->helper('google_calendar_helper');
		$this->page_data['page']->title = 'Events';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab = 'Events';
        $this->hasAccessModule(4);
        //$this->load->library('paypal_lib');
        $this->load->model('Event_model', 'event_model');
        $this->load->model('EventType_model', 'event_type_model');
        //$this->load->model('Invoice_model', 'invoice_model');
        //$this->load->model('Roles_model', 'roles_model');
        $this->load->model('General_model', 'general');

    }

    public function loadStreetView($address = NULL)
    {
        $this->load->library('wizardlib');
        $addr = ($address==NULL?post('address'):$address);
        return $this->wizardlib->getStreetView($addr);
    }

    public function index() {
        $get = $this->input->get();
        $filter_status = '';

        if( isset($get['status']) ){
            $filter_status = $get['status'];
            $condition[]   = ['field' => 'events.status', 'value' => ucfirst($get['status'])];
            $this->page_data['events'] = $this->event_model->get_all_events(0, $condition);
        }else{
            $this->page_data['events'] = $this->event_model->get_all_events();
        }

        $this->page_data['filter_status'] = $filter_status;
        $this->page_data['title'] = 'Events';
        $this->load->view('v2/pages/events/list', $this->page_data);
    }

    public function event_types() {
        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'event_types',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['page']->title = 'Event Types';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab = 'Event Types';
        $test =  $this->page_data['event_types'] = $this->general->get_data_with_param($get_job_types);
        $this->load->view('v2/pages/events/event_types', $this->page_data);
    }

    public function event_types_add () {
        $this->load->model('Icons_model');
        add_css(array('assets/css/hover.css'));
        $icons = $this->Icons_model->getAll();

        $this->page_data['page']->title = 'Event Types';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab = 'Event Types';
        $this->page_data['icons'] = $icons;
        $this->load->view('v2/pages/events/action/event_types_add', $this->page_data);
    }

    public function event_types_edit ($event_type_id) {
        $this->load->model('Icons_model');
        add_css(array('assets/css/hover.css'));
        $eventType = $this->event_type_model->getById($event_type_id);
        $icons    = $this->Icons_model->getAll();

        $this->page_data['eventType'] = $eventType;
        $this->page_data['page']->title = 'Event Types';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab = 'Event Types';
        $this->page_data['icons'] = $icons;
        $this->load->view('v2/pages/events/action/event_types_edit', $this->page_data);
    }

     public function event_tags_add () {
        $this->load->model('Icons_model');
        add_css(array('assets/css/hover.css'));
        $icons = $this->Icons_model->getAll();
        $this->page_data['page']->title = 'Event Tags';
        $this->page_data['page']->tab   = 'Event Tags';
        $this->page_data['icons'] = $icons;
        $this->load->view('v2/pages/events/action/event_tags_add', $this->page_data);
    }

    public function event_tags_edit ($id) {
        $this->load->model('Icons_model');
        $this->load->model('EventTags_model');
        add_css(array('assets/css/hover.css'));
        $eventTag = $this->EventTags_model->getById($id);
        $icons    = $this->Icons_model->getAll();
        $this->page_data['eventTag'] = $eventTag;
        $this->page_data['page']->title = 'Event Tags';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab   = 'Event Tags';
        $this->page_data['icons'] = $icons;
        $this->load->view('v2/pages/events/action/event_tags_edit', $this->page_data);
    }

    public function test_get_icon () {
        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'event_types',
            'select' => 'id,title,icon_marker',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $test = $this->general->get_data_with_param($get_job_types);
        echo json_encode($test);
    } 

    public function event_add($id=null) {
        $this->load->model('Users_model');

		$this->page_data['page']->title = 'Event Scheduler Tool';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab = 'Events';
        
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // check if settings has been set
        $get_event_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'event_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_event_settings);
        // add default event settings if not set
        if(empty($event_settings)){
            $event_settings_data = array(
                'event_prefix' => 'EVENT',
                'event_next_num' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'event_settings');
        }

        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);


        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'table' => 'event_tags',
            'select' => 'id,name,marker_icon',
        );
        $this->page_data['job_tags'] = $this->general->get_data_with_param($get_job_tags);
        //echo logged('company_id');

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'event_types',
            'select' => 'id,title,icon_marker',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);

        // get items
        $get_items = array(
            'where' => array(
                'company_id' => logged('company_id'),
                'is_active' => 1,
            ),
            'table' => 'items',
            'select' => 'id,title,price',
        );
        $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        $attendees   = array();
        $page_action = 'add';
        if(!$id==NULL){
            $page_action = 'edit';
            $event = $this->event_model->get_specific_event($id);

            $a_attendees = json_decode($event->employee_id);
            foreach($a_attendees as $uid){
                $user = $this->Users_model->getUserByID($uid);
                if( $user ){
                    $attendees[$user->id] = $user->FName . ' ' . $user->LName;
                }
            }  

            $this->page_data['jobs_data'] = $event;
            $this->page_data['event_items'] = $this->event_model->get_specific_event_items($id);
            //print_r($this->page_data['jobs_data_items'] );
        }

        $default_start_date = date("Y-m-d");
        $default_start_time = '';
        $default_user = 0;
        $redirect_calendar = 0;

        if( $this->input->get('start_date') ){
            $redirect_calendar = 1;
            $default_start_date = $this->input->get('start_date');
        }

        if( $this->input->get('start_time') ){
            $redirect_calendar = 1;
            $default_start_time = $this->input->get('start_time');
        }

        if( $this->input->get('user') ){
            $redirect_calendar = 1;
            $user = $this->Users_model->getUserByID($this->input->get('user'));
            if( $user ){
                $attendees[$user->id] = $user->FName . ' ' . $user->LName;
            }
        }

        $this->page_data['attendees'] = $attendees;
        $this->page_data['redirect_calendar']  = $redirect_calendar;
        $this->page_data['default_start_date'] = $default_start_date;
        $this->page_data['default_start_time'] = $default_start_time;

        $this->page_data['page_action'] = $page_action;
        // $this->load->view('events/event_new', $this->page_data);
        $this->load->view('v2/pages/events/action/event_add', $this->page_data);
    }

    public function event_preview($id=null) {
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // get all employees
        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);

        $get_employee = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['employees'] = $this->general->get_data_with_param($get_employee);

        // get all job tags
        $get_job_tags = array(
            'table' => 'job_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);
        //echo logged('company_id');

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_job_types = array(
            'table' => 'job_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_email,street,city,postal_code,state,business_image',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);

        echo logged('company_id');

        // get items
        $get_items = array(
            'where' => array(
                'company_id' => logged('company_id'),
                'is_active' => 1,
            ),
            'table' => 'items',
            'select' => 'id,title,price',
        );
        $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        // get estimates
        $get_estimates = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'estimates',
            'select' => 'id,estimate_number,estimate_date,job_name,customer_id',
        );
        $this->page_data['estimates'] = $this->general->get_data_with_param($get_estimates);

        // get workorder
        $get_workorder = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'work_orders',
            'select' => 'id,work_order_number,start_date,job_name,customer_id',
        );
        $this->page_data['workorders'] = $this->general->get_data_with_param($get_workorder);

        // get invoices
        $get_invoices = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'invoices',
            'select' => 'id,invoice_number,date_issued,job_name,customer_id',
        );
        $this->page_data['invoices'] = $this->general->get_data_with_param($get_invoices);
        if($id!=NULL){
            $this->page_data['jobs_data'] = $this->event_model->get_specific_event($id);
            $this->page_data['event_items'] = $this->event_model->get_specific_event_items($id);
            print_r($this->page_data['event_items']);
        }
        $this->load->view('events/event_preview', $this->page_data);
    }

    public function update_event_status(){
        $input = $this->input->post();
        // customer_ad_model
        if($input){
            $id = $input['id'];
            unset($input['id']);
            if ($this->general->update_with_key($input,$id ,"events")) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }

    public function get_customer_selected(){
        $id = $_POST['id'];
        $get_customer = array(
            'where' => array(
                'prof_id' => $id
            ),
            'table' => 'acs_profile',
            'select' => 'prof_id,first_name,last_name,middle_name,email,phone_h,city,state,mail_add,zip_code',
        );
        echo json_encode($this->general->get_data_with_param($get_customer,FALSE),TRUE);
    }

    public function get_employee_selected(){
        $id = $_POST['id'];
        $get_employee = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
       echo json_encode($this->general->get_data_with_param($get_employee,FALSE),TRUE);
    }

    public function get_esign_selected(){
        $id = $_POST['id'];
        $get_template = array(
            'where' => array(
                'esignLibraryTemplateId' => $id
            ),
            'table' => 'esign_library_template',
            'select' => 'content',
        );
        echo json_encode($this->general->get_data_with_param($get_template,FALSE),TRUE);
    }

    public function get_tag_selected(){
        $id = $_POST['id'];
        $get_template = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'event_tags',
            'select' => 'name',
        );
        echo json_encode($this->general->get_data_with_param($get_template,FALSE),TRUE);
    }

    public function save_esign() {
       // echo json_encode($_POST);
        echo date("d-m-Y h:i A");
    }

    public function get_customers(){
        $get_customer = array(
            'table' => 'acs_profile',
            'select' => 'prof_id,first_name,last_name,middle_name',
            'order' => array(
                'order_by' => 'prof_id',
                'ordering' => 'DESC',
            ),
        );
        echo json_encode($this->general->get_data_with_param($get_customer),TRUE);
    }

    public function get_esign_template(){
        $get_esign_template = array(
            'where' => array(
                'category_id' => 26, // 26 = category id of Jobs template in esign_library_category table
                'isActive' => 1
            ),
            'table' => 'esign_library_template',
            'select' => 'esignLibraryTemplateId,title,content',
        );
        echo json_encode($this->general->get_data_with_param($get_esign_template),TRUE);
    }

    public function event_tags() {
        $get_job_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'event_tags',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );        
		$this->page_data['page']->title = 'Event Tags';
        $this->page_data['page']->parent = 'Sales';
        $this->page_data['page']->tab = 'Event Tags';
        $this->page_data['event_tags'] = $this->general->get_data_with_param($get_job_settings);
        $this->load->view('v2/pages/events/event_tags', $this->page_data);
    }

    public function bird_eye_view() {

        $this->page_data['title'] = 'Bird Eye View';
        $this->load->view('job/job_settings/bird_eye_view', $this->page_data);
    }

    public function delete_tag() {
        $remove_tag = array(
            'where' => array(
                'id' => $_POST['tag_id']
            ),
            'table' => 'event_tags'
        );
        if($this->general->delete_($remove_tag)){
            echo '1';
        }
    }

    public function delete_job_type() {
        $remove_jobtype = array(
            'where' => array(
                'id' => $_POST['type_id']
            ),
            'table' => 'event_types'
        );
        if($this->general->delete_($remove_jobtype)){
            echo '1';
        }
    }

    public function delete_event() {
        $remove_event = array(
            'where' => array(
                'id' => $_POST['job_id']
            ),
            'table' => 'events'
        );

        $event = $this->event_model->get_specific_event($_POST['job_id']);
        if( $event ){
            if($this->general->delete_($remove_event)){
                customerAuditLog(logged('id'), $event->customer_id, $event->id, 'Event', 'Deleted event #'.$event->event_number);
                echo '1';
            }
        }
    }

    public function add_tag() {
        $input = $this->input->post();
        $input['company_id'] =  logged('company_id');
        if($this->general->add_($input,"event_tags")){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function add_job_type() {
        $input = $this->input->post();
        $input['company_id'] = logged('company_id');
        $input['created_at'] = date('Y-m-d H:i:s');
        if($this->general->add_($input,"event_types")) {
            echo "1";
        }else {
            echo "0";
        }
    }

    public function add_job_attachments(){

        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            $uniquesavename=time().uniqid(rand());
            $path = $_FILES['file']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $destination = 'uploads/jobs/attachment/' .$uniquesavename.'.'.$ext;
            move_uploaded_file($_FILES['file']['tmp_name'], $destination);
            $sourceFile = $_SERVER['DOCUMENT_ROOT'].'/'.$destination;
            //$content = file_get_contents($sourceFile,FILE_USE_INCLUDE_PATH);
            echo $destination;
        }

    }

    public function settings() {
        $get = $this->input->get();
        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');
        $this->page_data['invoices'] = $this->invoice_model->getByWhere(['company_id' => $comp_id]);

        if (empty($get['job_num'])) {
            $comp = array(
                'company_id' => $comp_id
            );
        } else {
            $comp = array(
                'company_id' => $comp_id,
                'job_number' => $get['job_num']
            );
        }
        $this->page_data['job_settings'] = $this->db->get_where($this->jobs_model->table_job_settings, array('company_id' => $comp_id))->result();
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, array('company_id' => $comp_id))->result();
        $job_num_query = $this->db->order_by("jobs_id", "desc")->get_where($this->jobs_model->table, $comp)->row();
        if ($job_num_query && empty($get['job_num'])) {
            $this->page_data['job_number'] = intval($this->db->order_by("jobs_id", "desc")->get_where($this->jobs_model->table, array('company_id' => $comp_id))->row()->job_number) + 1;
        } else {
           $this->page_data['job_other_info'] = (!empty($get['job_num'])) ? $this->jobs_model->getJobDetails($get['job_num']) : null;
           $this->page_data['job_number'] = (!empty($get['job_num'])) ? $get['job_num'] : 1000;
           $this->page_data['job_data'] = $job_num_query;
        }
        $this->load->view('job/job_settings/prefix', $this->page_data);
    }

    public function job_time_settings() {
        $get_job_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_tags',
            'select' => '*',
        );
        $this->page_data['title'] ='Job Time Settings';
        $this->load->view('job/job_settings/job_time_settings', $this->page_data);
    }

    public function event_save () {
        $USER_ID = logged('id');
        $COMPANY_ID = logged('company_id');

        $GET_EVENT_SETTINGS = array(
            'where' => array( 'company_id' => $COMPANY_ID ),
            'table' => 'event_settings',
            'select' => '*',
        );
        $EVENT_SETTINGS = $this->general->get_data_with_param($GET_EVENT_SETTINGS);
        $EVENT_NUMBER = $EVENT_SETTINGS[0]->event_prefix.' - #000000'.$EVENT_SETTINGS[0]->event_next_num;
        $employee_ids = json_encode($_POST['EMPLOYEE_ID']);
        $DATA = array(
            'employee_id' => $employee_ids,
            'start_date' => $_POST['FROM_DATE'],
            'start_time' => $_POST['FROM_TIME'],
            'end_date' => $_POST['TO_DATE'],
            'end_time' => $_POST['TO_TIME'],
            'event_type' => $_POST['EVENT_TYPE'],
            'event_color' => $_POST['EVENT_COLOR'],
            'url_link' => $_POST['URL_LINK'],
            'customer_reminder_notification' => $_POST['CUSTOMER_REMINDER'],
            'created_by' => $USER_ID,
            'company_id' => $COMPANY_ID,
            'description' => $_POST['EVENT_DESCRIPTION'],
            'event_description' => $_POST['EVENT_DESCRIPTION'],
            'status' => "Scheduled",
            'event_address' => $_POST['LOCATION'],
            'event_number' => $EVENT_NUMBER,
            'event_tag' => $_POST['EVENT_TAG'],
            'notes' => $_POST['PRIVATE_NOTES'],
            'amount' => 0,
            'timezone' => $_POST['TIMEZONE'],
        );

        $EVENT_ID = $this->general->add_return_id($DATA, 'events');

        //SMS Notification
        createCronAutoSmsNotification($COMPANY_ID, $EVENT_ID, 'event', 'Scheduled', $_POST['EMPLOYEE_ID']);

        //Google Calendar
        createSyncToCalendar($EVENT_ID, 'event', $COMPANY_ID);
   
        $EVENT_SETTINGS_data = array( 'event_next_num' => $EVENT_SETTINGS[0]->event_next_num + 1,);
        $this->general->update_with_key($EVENT_SETTINGS_data,$EVENT_SETTINGS[0]->id, 'event_settings');
        customerAuditLog(logged('id'), 0, $EVENT_ID, 'Events', 'Created an event #'.$EVENT_NUMBER);

        // if(isset($input['item_id'])){
        //     $devices = count($input['item_id']);
        //     for($xx=0;$xx<$devices;$xx++){
        //         $events_items_data = array();
        //         $events_items_data['EVENT_ID'] = $EVENT_ID;
        //         $events_items_data['items_id'] = $input['item_id'][$xx];
        //         $events_items_data['qty'] = $input['item_qty'][$xx];
        //         $events_items_data['item_price'] = $input['item_price'][$xx];
        //         $this->general->add_($events_items_data, 'event_items');
        //         unset($events_items_data);
        //     }
        // }
    }




    // public function save_event() {
    //     $input = $this->input->post();
    //     $user_id = logged('id');
    //     $comp_id = logged('company_id');
    //     $get_event_settings = array(
    //         'where' => array(
    //             'company_id' => $comp_id
    //         ),
    //         'table' => 'event_settings',
    //         'select' => '*',
    //     );
    //     $event_settings = $this->general->get_data_with_param($get_event_settings);
    //     $event_number = $event_settings[0]->event_prefix.' - #000000'.$event_settings[0]->event_next_num;

    //     $events_data = array(
    //         'event_number' => $event_number,
    //         'customer_id' => $input['customer_id'],
    //         'employee_id' => $input['employee_id'],
    //         'event_description' => $input['event_description'],

    //         'start_date' => $input['start_date'],
    //         'start_time' => $input['start_time'],
    //         'end_date' => $input['end_date'],
    //         'end_time' => $input['end_time'],
    //         'event_type' => $input['event_types'],
    //         'event_tag' => $input['event_tags'],
    //         'event_color' => $input['event_color'],
    //         'customer_reminder_notification' => $input['customer_reminder_notification'],
    //         'url_link' => $input['link'],
    //         'event_address' => $input['event_address'],
    //         'status' => 'Scheduled',//$this->input->post('job_status'),
    //         'description' => $input['description'],
    //         'timezone' => $input['timezone'],
    //         'created_by' => $user_id,
    //         'company_id' => $comp_id,
    //         //'date_issued' => date('Y-m-d'),
    //         'notes' => $input['message'],
    //         'amount' => $input['total_event_amount'],
    //         //'tax_rate' => $input['tax_rate'],
    //     );
    //     $event_id = $this->general->add_return_id($events_data, 'events');

    //     //SMS Notification
    //     createCronAutoSmsNotification($comp_id, $event_id, 'event', 'Scheduled', $input['employee_id']);

    //     //Google Calendar
    //     createSyncToCalendar($event_id, 'event', $comp_id);

    //     if(isset($input['item_id'])){
    //         $devices = count($input['item_id']);
    //         for($xx=0;$xx<$devices;$xx++){
    //             $events_items_data = array();
    //             $events_items_data['event_id'] = $event_id;
    //             $events_items_data['items_id'] = $input['item_id'][$xx];
    //             $events_items_data['qty'] = $input['item_qty'][$xx];
    //             $events_items_data['item_price'] = $input['item_price'][$xx];
    //             $this->general->add_($events_items_data, 'event_items');
    //             unset($events_items_data);
    //         }
    //     }   
    //     $event_settings_data = array(
    //         'event_next_num' => $event_settings[0]->event_next_num + 1,
    //     );
    //     $this->general->update_with_key($event_settings_data,$event_settings[0]->id, 'event_settings');

    //     //customerAuditLog(logged('id'), $input['customer_id'], $event_id, 'Events', 'Created an event #'.$event_number);
    //     customerAuditLog(logged('id'), 0, $event_id, 'Events', 'Created an event #'.$event_number);

    //     echo $event_id;
    // }

    public function delete () {
        $get = $this->input->get();
        $this->jobs_model->deleteJob($get['id']);
        redirect('job');
    }

    public function getItems() {
        $get = $this->input->get();

        $result = $this->jobs_model->getItems($get['index']);

        echo json_encode($result);
    }

    public function saveInvoice() {
        postAllowed();

        $comp_id = logged('company_id');
        $date_created = date_format(date_create($this->input->post('createdDate')),"Y-m-d H:i:s");
        $invoice_number = $this->invoice_model->getInvoiceNumber($this->input->post('jobId'), $this->input->post('jobNumber'));

        $data = array(
            'company_id' => $comp_id,
            'customer_id' => $this->input->post('customer_id'),
            'created_date' => $date_created,
            'total_due' => $this->input->post('totalDue'),
            'balance' => $this->input->post('balance'),
            'due_date' => date('Y-m-d H:i:s'),
            'billing_type' => $this->input->post('billingType'),
            'job_id' => $this->input->post('jobId'),
            'created_by' => logged('id'),
            'status' => $this->input->post('status'),
            'invoice_number' => $invoice_number
        );
        $this->db->insert($this->invoice_model->table, $data);
        echo json_encode($data);
    }

    public function saveInvoiceItems() {
        postAllowed();
        $comp_id = logged('company_id');

        $data = array(
            'company_id' => $comp_id,
            'job_id' => $this->input->post('job_id'),
            'item_id' => $this->input->post('item_id'),
            'qty' => 1,
            'locations' => '',
            'total_value' => $this->input->post('total_value'),
            'discount' => 0,
            'discount_type' => ""
        );
        $this->db->insert($this->invoice_model->table_item, $data);
        $result = $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'));

        echo json_encode($result);
    }

    public function updateJobItemQty() {
        postAllowed();

        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $qty = $this->input->post('qty');

        $this->jobs_model->updateJobItemQty($id, $qty, $type);
        $result = $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'));

        echo json_encode($result);
    }

    public function buy($id) {
        // Set variables for paypal form
        $returnURL = base_url().'paypal/success';
        $cancelURL = base_url().'paypal/cancel';
        $notifyURL = base_url().'paypal/ipn';

        // Get product data from the database
        $product = $this->invoice_model->getRows($id);

        // Get current user ID from the session
        $userID = logged('id');

        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['title']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product['invoice_id']);
        $this->paypal_lib->add_field('amount',  $product['total_value']);

        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    public function saveCreditCard() {
        if ($this->input->post('billingExpDate') != '' && $this->input->post('cardNumber') != '') {
            $exp_date = explode("/",$this->input->post('billingExpDate'));

            $data = array(
                'card_number' => $this->input->post('cardNumber'),
                'exp_day' => $exp_date[1],
                'exp_yr' => $exp_date[0],
                'CVV' => $this->input->post('cvv'),
                'card_type' => $this->input->post('cardType'),
                'user_id' => logged('id'),
                'company_id' => logged('company_id'),
                'payment_method_id' => 0,
                'added' => date('Y-m-d H:i:s')
            );

            $this->db->insert($this->jobs_model->table_credit_cards, $data);
        }
    }

    public function sendEstimateEmail() {
        postAllowed();
        $from_email = $this->input->post('from_email');
        $company = $this->input->post('company');
        $to_email = $this->input->post('email');

        //Load email library
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'nsmartrac@gmail.com',
            'smtp_pass' => 'nSmarTrac2020',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($from_email, $company);
        $this->email->to($to_email);
        $this->email->subject('Review Estimate');
        $data = array(
            'customer' => getLoggedFullName($this->input->post('customer_id')),
            "items" => $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'))
        );
        $message = $this->load->view('email_campaigns/estimate.php',$data,TRUE);
        $this->email->message($message);
        //Send mail

        if($this->email->send())
            echo json_encode("Congratulation Email Send Successfully.");
        else
            echo json_encode($this->email->send());
    }

    public function saveEstimate() {
        postAllowed();
        $estimate_number = $this->jobs_model->getEstimateNumber($this->input->post('job_id'), $this->input->post('jobNumber'));


        $data = array(
            'estimate_date' => date("Y-m-d", strtotime($this->input->post('estimate_date'))),
            'expiry_date' => date("Y-m-d", strtotime($this->input->post('expiry_date'))),
            'description' => $this->input->post('description'),
            'employee_ids' => $this->input->post('employee_id'),
            'status' => $this->input->post('status'),
            'job_id' => $this->input->post('job_id'),
            'estimate_value' => $this->input->post('estimate_value'),
            'deposit_request' => $this->input->post('deposit_request'),
            'estimate_number' => $estimate_number
        );

        $this->db->insert($this->jobs_model->table_estimates, $data);

        echo json_encode($data);
    }

    public function deleteJobForm() {
        $get = $this->input->get();

        switch ($get['type']) {
            case "estimate":
                $this->jobs_model->deleteEstimate($get['id']);
            break;

            case "work_order":
                $this->jobs_model->deleteWorkOrder($get['id']);
            break;

            case "invoice":
                $this->invoice_model->deleteInvoice($get['id']);
            break;
        }

        redirect('job/new_job?job_num=' . $get['job_num']);
    }

    function deleteMultiple() {
        postAllowed();
        $ids = explode(",",$this->input->post('ids'));

        foreach($ids as $id) {
            $this->jobs_model->deleteJob($id);
        }

        echo json_encode(true);
    }

    function getEmpByRole() {
        postAllowed();
        $id = $this->input->post('id');
        $result = $this->db->get_where($this->jobs_model->table_employees, array('role_id' => $id))->result_array();

        echo json_encode($result);
    }

    function getCustomerLocations() {
        postAllowed();
        $id = $this->input->post('id');
        $result = $this->db->get_where($this->jobs_model->table_address, array('user_id' => $id))->result_array();

        echo json_encode($result);
    }

    function saveAssignEmp() {
        postAllowed();
        $id = $this->input->post('role_id');
        $role = $this->page_data['emp_roles'] = $this->roles_model->getRolesById($this->input->post('role_id'));

        $data = array(
            'jobs_id' => $this->input->post('job_id'),
            'employees_id' => $this->input->post('emp_id'),
            'emp_role' => $role->title
        );

        $this->db->insert($this->jobs_model->table_jobs_has_employees, $data);
        $data = $this->jobs_model->getAssignEmp($this->input->post('job_id'));

        echo json_encode($data);
    }

    function saveNewCustomerLocation() {
        postAllowed();

        $data = array(
            'user_id' => $this->input->post('user_id'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postal_code' => $this->input->post('postal_code')
        );

        $this->db->insert($this->jobs_model->table_address, $data);
        $data = $this->db->get_where($this->jobs_model->table_address, array('user_id' => $this->input->post('user_id')))->result_array();

        echo json_encode($data);
    }

    function details($id){
        $this->load->model('Estimate_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Customer_model');

        $estimate = $this->Estimate_model->getEstimate($id);

        if( $estimate ){
            $customer      = $this->Customer_model->getCustomer($estimate->customer_id);
            $estimateItems = $this->EstimateItem_model->getAllByEstimateId($estimate->id);

            $this->page_data['estimate'] = $estimate;
            $this->page_data['customer'] = $customer;
            $this->page_data['estimateItems'] = $estimateItems;
            $this->load->view('job/details', $this->page_data);

        }else{
           redirect('dashboard');
        }
    }

    public function ajax_load_upcoming_jobs()
    {
        $role    = logged('role');
        $user_id = getLoggedUserID();
        $comp_id = logged('company_id');

        if( $role == 1 || $role == 2 ){
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobs();
        }else{
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobsByCompanyId($comp_id);
        }

        $this->page_data['upcomingJobs'] = $upcomingJobs;
        $this->load->view('job/ajax_load_upcoming_jobs', $this->page_data);

    }

    public function create_new_event_tag()
    {
        $this->load->model('EventTags_model');
        $this->load->model('Icons_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        if( isset($post['is_default_icon']) ){
            $icon = $this->Icons_model->getById($post['default_icon_id']);
            $marker_icon = $icon->image;
            $data = [
                'name' => $post['event_tag_name'],
                'company_id' => $company_id,
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => 1
            ];

            $this->EventTags_model->create($data);
        }else{
            $marker_icon = $this->moveUploadedFile();
            if( $marker_icon != '' ){
                $data = [
                    'name' => $post['event_tag_name'],
                    'company_id' => $company_id,
                    'marker_icon' => $marker_icon,
                    'is_marker_icon_default_list' => 0
                ];

                $this->EventTags_model->create($data);
            }else{
                $this->session->set_flashdata('message', 'Cannot update event tag');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

        }

        $this->session->set_flashdata('message', 'Add new event tag was successful');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('events/event_tags');
    }

    public function update_event_tag(){
        $this->load->model('EventTags_model');
        $this->load->model('Icons_model');

        $post = $this->input->post();
        $company_id = logged('company_id');
        $eventTag = $this->EventTags_model->getById($post['tid']);
        if( $eventTag ){
            $marker_icon = $eventTag->marker_icon;
            $is_marker_icon_default_list = $eventTag->is_marker_icon_default_list;
            if( isset($post['is_default_icon']) ){
                if( $post['default_icon_id'] > 0 ){
                    $icon = $this->Icons_model->getById($post['default_icon_id']);
                    $marker_icon = $icon->image;
                    $is_marker_icon_default_list = 1;
                }
            }else{
                if( $_FILES['image']['size'] > 0 ){
                    $marker_icon = $this->moveUploadedFile();
                    $is_marker_icon_default_list = 0;
                }
            }

            $data = [
                'name' => $post['event_tag_name'],
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => $is_marker_icon_default_list
            ];
            $this->EventTags_model->update($post['tid'],$data);

            $this->session->set_flashdata('message', 'Update event tag was successful');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');

        }

        redirect('events/event_tags');
    }

    public function moveUploadedFile() {
        if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
            $company_id = logged('company_id');
            $target_dir = "./uploads/event_tags/" . $company_id . "/";
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['image']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['image']['name'])));
            // basename() may prevent filesystem traversal attacks;
            // further validation/sanitation of the filename may be appropriate
            $name = basename($_FILES["image"]["name"]);
            move_uploaded_file($tmp_name, $target_dir . $name);

            return $name;
        }
    }

    public function ajax_quick_view_event() {

        $post = $this->input->post();

        $event = $this->event_model->getEvent($post['appointment_id']);

        $this->page_data['event'] = $event;
        $this->load->view('v2/pages/events/ajax_quick_view_event', $this->page_data);
    }

    public function ajax_quick_add_event_form(){
        $this->load->model('Users_model');        
        $this->load->helper('functions');

        $comp_id = logged('company_id');
        $user_id = logged('id');

        // check if settings has been set
        $get_event_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'event_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_event_settings);
        // add default event settings if not set
        if(empty($event_settings)){
            $event_settings_data = array(
                'event_prefix' => 'EVENT',
                'event_next_num' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'event_settings');
        }

        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);

        // get all job tags
        $get_job_tags = array(
            'table' => 'event_tags',
            'select' => 'id,name,marker_icon',
        );
        $this->page_data['job_tags'] = $this->general->get_data_with_param($get_job_tags);

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'event_types',
            'select' => 'id,title,icon_marker',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $default_date = date("Y-m-d", strtotime($this->input->get('date_selected')));
        $this->page_data['settings'] = unserialize($settings);
        $this->page_data['default_date']  = $default_date;        
        $this->load->view('v2/pages/events/action/ajax_quick_add_event_form', $this->page_data);
    }

    public function ajax_create_event(){
        $USER_ID = logged('id');
        $COMPANY_ID = logged('company_id');

        $GET_EVENT_SETTINGS = array(
            'where' => array( 'company_id' => $COMPANY_ID ),
            'table' => 'EVENT_SETTINGS',
            'select' => '*',
        );
        $EVENT_SETTINGS = $this->general->get_data_with_param($GET_EVENT_SETTINGS);
        $EVENT_NUMBER = $EVENT_SETTINGS[0]->event_prefix.' - #000000'.$EVENT_SETTINGS[0]->event_next_num;
        $employee_ids = json_encode($_POST['EMPLOYEE_ID']);
        $DATA = array(
            'employee_id' => $employee_ids,
            'start_date' => $_POST['FROM_DATE'],
            'start_time' => $_POST['FROM_TIME'],
            'end_date' => $_POST['TO_DATE'],
            'end_time' => $_POST['TO_TIME'],
            'event_type' => $_POST['EVENT_TYPE'],
            'event_color' => $_POST['EVENT_COLOR'],
            'url_link' => $_POST['URL_LINK'],
            'customer_reminder_notification' => $_POST['CUSTOMER_REMINDER'],
            'created_by' => $USER_ID,
            'company_id' => $COMPANY_ID,
            'description' => $_POST['EVENT_DESCRIPTION'],
            'event_description' => $_POST['EVENT_DESCRIPTION'],
            'status' => "Scheduled",
            'event_address' => $_POST['LOCATION'],
            'event_number' => $EVENT_NUMBER,
            'event_tag' => $_POST['EVENT_TAG'],
            'notes' => $_POST['PRIVATE_NOTES'],
            'amount' => 0,
            'timezone' => $_POST['TIMEZONE'],
        );

        $EVENT_ID = $this->general->add_return_id($DATA, 'events');

        //SMS Notification
        createCronAutoSmsNotification($COMPANY_ID, $EVENT_ID, 'event', 'Scheduled', $_POST['EMPLOYEE_ID']);

        //Google Calendar
        createSyncToCalendar($EVENT_ID, 'event', $COMPANY_ID);
   
        $EVENT_SETTINGS_data = array( 'event_next_num' => $EVENT_SETTINGS[0]->event_next_num + 1,);
        $this->general->update_with_key($EVENT_SETTINGS_data,$EVENT_SETTINGS[0]->id, 'event_settings');
        customerAuditLog(logged('id'), 0, $EVENT_ID, 'Events', 'Created an event #'.$EVENT_NUMBER);
    }
}

/* End of file Job.php */

/* Location: ./application/controllers/job.php */
