<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        //$this->load->library('paypal_lib');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('JobType_model');
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
        $is_allowed = true; //$this->isAllowedModuleAccess(15);
        if( !$is_allowed ){
            $this->page_data['module'] = 'job';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $this->page_data['jobs'] = $this->jobs_model->get_all_jobs();
        $this->page_data['title'] = 'Jobs';
        $this->load->view('job/list', $this->page_data);
    }

    public function new_job1($id=null) {
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

        // check if settings has been set
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => 'id',
        );
        $event_settings = $this->general->get_data_with_param($get_job_settings);
        // add default event settings if not set
        if(empty($event_settings)){
            $event_settings_data = array(
                'job_num_prefix' => 'JOB',
                'job_num_next' => 1,
                'company_id' => $comp_id,
            );
            $this->general->add_($event_settings_data, 'job_settings');
        }


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
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_tags',
            'select' => 'id,name',
        );
        $this->page_data['tags'] = $this->general->get_data_with_param($get_job_tags);

        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_types',
            'select' => 'id,title',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);

        // get color settings
        $get_color_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'color_settings',
            'select' => '*',
        );
        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);


        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);

        // get items
        $get_items = array(
            'where' => array(
                'items.company_id' => logged('company_id'),
                'is_active' => 1,
            ),
            'table' => 'items',
//            'join' => array(
//                'table' => 'items_has_storage_loc',
//                'statement' => 'items.id=items_has_storage_loc.item_id',
//                'join_as' => 'left',
//            ),
            'select' => 'items.id,title,price,type',
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

        $get_settings= array(
            'table' => 'job_tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_settings);

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

//        $get_customer = array(
//            'table' => 'acs_profile',
//            'select' => 'prof_id,first_name,last_name,middle_name',
//            'order' => array(
//                'order_by' => 'first_name',
//                'ordering' => 'ASC',
//            ),
//        );
//        $this->page_data['customers']  = $this->general->get_data_with_param($get_customer);

        if(!$id==NULL){
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }

        add_css([
            'assets/css/esign/fill-and-sign/fill-and-sign.css',
        ]);

        add_footer_js([
            'assets/js/esign/fill-and-sign/step1.js',
            'assets/js/esign/fill-and-sign/step2.js',
            'assets/js/esign/fill-and-sign/job/script.js',

            'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.0/jspdf.umd.min.js',
            'https://html2canvas.hertzen.com/dist/html2canvas.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js',

            'assets/js/esign/libs/pdf.js',
            'assets/js/esign/libs/pdf.worker.js',
            'assets/js/esign/fill-and-sign/step2.js',
        ]);

        $this->load->view('job/job_new', $this->page_data);
    }

    public function job_preview($id=null) {
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

        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);

        if(!$id==NULL){
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }
        $this->load->view('job/job_preview', $this->page_data);
    }

    public function billing($id=null) {
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        if(!$id==NULL){
            $jobs_data = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
            $get_customer_info = array(
                'where' => array(
                    'prof_id' => $jobs_data->customer_id,
                ),
                'table' => 'acs_profile',
                'select' => 'prof_id,first_name,last_name,mail_add,city,state,city,zip_code,email,phone_m',
            );
            $this->page_data['profile_info'] = $this->general->get_data_with_param($get_customer_info,FALSE);

            print_r($this->page_data['jobs_data']);
            $this->page_data['jobs_data'] = $jobs_data;
        }
        $this->load->view('job/job_billing', $this->page_data);
    }

    public function update_payment_details(){
        $input = $this->input->post();
        $updated=0;
        // customer_ad_model
        if($input){
            $payment_data = array();
            if($input['pay_method'] == 'CASH'){
                $payment_data['method'] = $input['pay_method'];
                $payment_data['is_collected'] = isset($input['is_collected']) ? 1 : 0;
                $payment_data['is_paid'] = 1;
            }
            $payment_data['paid_datetime'] =date("m-d-Y h:i:s");;
            $check = array(
                'where' => array(
                    'jobs_id' => $input['jobs_id']
                ),
                'table' => 'jobs_pay_details'
            );
            $exist = $this->general->get_data_with_param($check,FALSE);
            if($exist){
                $updated =  $this->general->update_with_key_field($payment_data, $input['jobs_id'], 'jobs_pay_details','jobs_id');
            }else{
                $updated =  $this->general->add_($payment_data, 'jobs_pay_details');
            }
        }

        if($updated){
            $jobs_data = array();
            $jobs_data['status'] = 'Completed';
            echo $this->general->update_with_key_field($jobs_data, $input['jobs_id'], 'jobs','id');
        }else{
            echo '0';
        }
    }

    public function update_payment_details_cc(){
        $input   = $this->input->post();
        $updated = 0;

        $is_success = false;
        $msg = 'Invalid form entry';
        // customer_ad_model
        if($input){
            $this->load->model('AcsProfile_model');

            $job = $this->jobs_model->get_specific_job($input['jobs_id']);
            $customer = $this->AcsProfile_model->getByProfId($job->customer_id);
            
            $converge_data = [
                'company_id' => $job->company_id,
                'card_number' => $input['card_number'],
                'exp_month' => $input['exp_month'],
                'exp_year' => $input['exp_year'],
                'card_cvc' => $input['card_cvc'],
                'address' => $customer->mail_add,
                'zip' => $customer->zip_code
            ];
            $result = $this->converge_send_sale($converge_data);
            if( $result['is_success'] ){
                $payment_data = array();
                $payment_data['method'] = $input['pay_method'];
                $payment_data['is_paid'] = 1;
                $payment_data['paid_datetime'] =date("m-d-Y h:i:s");;
                $check = array(
                    'where' => array(
                        'jobs_id' => $input['jobs_id']
                    ),
                    'table' => 'jobs_pay_details'
                );
                $exist = $this->general->get_data_with_param($check,FALSE);
                if($exist){
                    $updated =  $this->general->update_with_key_field($payment_data, $input['jobs_id'], 'jobs_pay_details','jobs_id');
                }else{
                    $updated =  $this->general->add_($payment_data, 'jobs_pay_details');
                }

                if($updated){
                    $jobs_data = array();
                    $jobs_data['status'] = 'Completed';
                    $this->general->update_with_key_field($jobs_data, $input['jobs_id'], 'jobs','id');
                }

                $is_success = true;
            }else{
                $msg = $result['msg'];
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function converge_send_sale($data){
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $this->load->model('CompanyOnlinePaymentAccount_model');

        $is_success = false;
        $msg = '';

        $convergeCred = $this->CompanyOnlinePaymentAccount_model->getByCompanyId();
        if( $convergeCred ){
            $exp_date = $data['exp_month'] . date("y",strtotime($data['exp_year']));
            $converge = new \wwwroth\Converge\Converge([
                'merchant_id' => $convergeCred->converge_merchant_id,
                'user_id' => $convergeCred->converge_merchant_user_id,
                'pin' => $convergeCred->converge_merchant_pin,
                'demo' => false,
            ]);
            $createSale = $converge->request('ccsale', [
                'ssl_card_number' => $data['card_number'],
                'ssl_exp_date' => $exp_date,
                'ssl_cvv2cvc2' => $data['card_cvc'],
                'ssl_amount' => $data['amount'],
                'ssl_avs_address' => $data['address'],
                'ssl_avs_zip' => $data['zip'],
            ]);

            if( $createSale['success'] == 1 ){
                $is_success = true;
                $msg = '';
            }else{
                $is_success = false;
                $msg = $createSale['errorMessage'];
            }
        }else{
            $msg = 'Converge account not found';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    public function send_invoice_preview($id=null) {
        //$this->load->helper('functions');
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


        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name,business_logo,business_email,street,city,postal_code,state',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);


        if(!$id==NULL){
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }
        $this->load->view('job/email_template/invoice', $this->page_data);
    }


    public function send_invoice($id=null)
    {
//        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//            echo json_encode(['success' => false]);
//            return;
//        }
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;
        $subject = 'nSmarTrac: Jobs';

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        //get job data
        $comp_id = logged('company_id');
        $user_id = logged('id');
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);

        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name,business_logo,business_email,street,city,postal_code,state',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);


        if(!$id==NULL){
            $this->page_data['jobs_data'] = $this->jobs_model->get_specific_job($id);
            $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($id);
        }

        $content = $this->load->view('job/email_template/invoice', $this->page_data , TRUE);
        $mail->Body = 'Lez go';
        $mail->MsgHTML($content);
        $mail->addAddress('welyelfhisula@gmail.com');
        $mail->send();
        $mail->ClearAllRecipients();
        echo json_encode(['success' => true]);
    }

    public function new_job_edit($id) {
        $this->load->helper('functions');
        $comp_id = logged('company_id');
        $user_id = logged('id');

        // get all job tags
        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );
        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);

        // get all employees
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

        // get company info
        $get_company_info = array(
            'where' => array(
                'id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'business_phone,business_name',
        );
        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info,FALSE);

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

        $this->page_data['color_settings'] = $this->general->get_data_with_param($get_color_settings);

        $this->load->view('job/job_new', $this->page_data);
    }

    public function update_jobs_status(){
        $input = $this->input->post();
        // customer_ad_model
        if($input){
            $id = $input['id'];
            unset($input['id']);
            $input['company_id'] = logged('company_id'); ;
            if ($this->general->update_with_key($input,$id ,"jobs")) {
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
            'table' => 'job_tags',
            'select' => 'name',
        );
        echo json_encode($this->general->get_data_with_param($get_template,FALSE),TRUE);
    }

    public function save_esign() {
        $input = $this->input->post();
            // customer_ad_model
        if($input){
            $id = $input['id'];
            unset($input['id']);
            if ($this->general->update_with_key($input,$id ,"jobs_approval")) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
        echo date("d-m-Y h:i A");
    }

    public function get_item_storage_location(){
        $id = $_POST['id'];
        $get_item_location = array(
            'where' => array(
                'item_id' => $id,
                'qty !=' => NULL,
            ),
            'table' => 'items_has_storage_loc',
            'select' => 'id,name,qty',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        echo json_encode($this->general->get_data_with_param($get_item_location),TRUE);
    }

    public function get_selected_item(){
        $id = $_POST['id'];
        $get_item = array(
            'where' => array(
                'id' => $id,
            ),
            'table' => 'items',
            'select' => 'brand,description',
        );
        echo json_encode($this->general->get_data_with_param($get_item,FALSE),TRUE);
    }

    public function get_customers(){
        $get_customer = array(
            'table' => 'acs_profile',
            'select' => 'prof_id,first_name,last_name,middle_name',
            'order' => array(
                'order_by' => 'first_name',
                'ordering' => 'ASC',
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

    public function job_tags() {
        $get_job_settings = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'job_tags',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_tags'] = $this->general->get_data_with_param($get_job_settings);
        $this->load->view('job/job_settings/job_tags', $this->page_data);
    }

    public function job_types() {
        $get_job_types = array(
            'where' => array(
                'company_id' => logged('company_id'),
                'status' => 1
            ),
            'table' => 'job_types',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->page_data['job_types'] = $this->general->get_data_with_param($get_job_types);
        $this->load->view('job/job_settings/job_types', $this->page_data);
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
            'table' => 'job_tags'
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
            'table' => 'job_types'
        );
        if($this->general->delete_($remove_jobtype)){
            echo '1';
        }
    }

    public function delete_tax_rate() {
        $remove_tax_rate = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'job_tax_rates'
        );
        if($this->general->delete_($remove_tax_rate)){
            echo '1';
        }
    }

    public function delete_job() {
        $remove_job = array(
            'where' => array(
                'id' => $_POST['job_id']
            ),
            'table' => 'jobs'
        );
        if($this->general->delete_($remove_job)){
            echo '1';
        }
    }

    public function add_tag()
    {
        $input = $this->input->post();
        $input['company_id'] =  logged('company_id');
        if($this->general->add_($input,"job_tags")){
            echo "1";
        } else{
            echo "0";
        }
    }

    public function add_job_type()
    {
        $input = $this->input->post();
        $input['company_id'] =  logged('company_id');
        $input['status'] =  1;
        $input['user_id'] =  logged('id');
        if($this->general->add_($input,"job_types")){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function add_tax_rate()
    {
        $input = $this->input->post();
        $input['datetime'] =  date('Y-m-d H:i:s');
        if($this->general->add_($input,"job_tax_rates")){
            echo "1";
        }else{
            echo "0";
        }
    }

    public function add_job_attachments()
    {
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        } else {
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

         $comp_id = logged('company_id');
        //$this->page_data['invoices'] = $this->invoice_model->getByWhere(['company_id' => $comp_id]);
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => '*',
        );
        $this->page_data['job_settings'] = $this->general->get_data_with_param($get_job_settings);

        $get_job_tax = array(
            'table' => 'job_tax_rates',
            'select' => '*',
        );
        $this->page_data['tax_rates'] = $this->general->get_data_with_param($get_job_tax);

        $this->load->view('job/settings', $this->page_data);
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

    public function save_job() {
        $input = $this->input->post();
        $comp_id = logged('company_id');
        $get_job_settings = array(
            'where' => array(
                'company_id' => $comp_id
            ),
            'table' => 'job_settings',
            'select' => '*',
        );
        $job_settings = $this->general->get_data_with_param($get_job_settings);
        $job_number = $job_settings[0]->job_num_prefix.' - #000000'.$job_settings[0]->job_num_next;

        $jobs_data = array(
            'job_number' => $job_number,
            'customer_id' => $input['customer_id'],
            'employee_id' => $input['employee_id'],
            'employee2_id' => $input['employee2_id'],
            'employee3_id' => $input['employee3_id'],
            'employee4_id' => $input['employee4_id'],
            'job_name' => $input['job_name'],
            'job_description' => $input['job_description'],
            'start_date' => $input['start_date'],
            'start_time' => $input['start_time'],
            'end_date' => $input['end_date'],
            'end_time' => $input['end_time'],
            'event_color' => $input['event_color'],
            'customer_reminder_notification' => $input['customer_reminder_notification'],
            //'job_type' => $this->input->post('job_type'),
            'priority' => 'Standard',//$this->input->post('job_priority'),
            'tags' => $input['tags'],//$this->input->post('job_priority'),
            'status' => 'Scheduled',//$this->input->post('job_status'),
            'message' => $input['message'],
            'company_id' => $comp_id,
            'date_created' => date('Y-m-d H:i:s'),
            //'notes' => $input['notes'],
            'attachment' => $input['attachment'],
            'tax_rate' => $input['tax_rate'],
            'job_type' => $input['job_type'],
            'date_issued' => $input['start_date'],
        );
        $jobs_id = $this->general->add_return_id($jobs_data, 'jobs');

        if(isset($input['item_id'])){
            $devices = count($input['item_id']);
            for($xx=0;$xx<$devices;$xx++){
                $job_items_data = array();
                $job_items_data['job_id'] = $jobs_id;
                $job_items_data['items_id'] = $input['item_id'][$xx];
                $job_items_data['qty'] = $input['item_qty'][$xx];
                $this->general->add_($job_items_data, 'job_items');
                unset($job_items_data);
            }
        }

        $jobs_links_data = array(
            'link' => $input['link'],
            'job_id' => $jobs_id,
        );
        $this->general->add_($jobs_links_data, 'job_url_links');

        $jobs_approval_data = array(
            'authorize_name' => $input['authorize_name'],
            'signature_link' => $input['signature_link'],
            'datetime_signed' => $input['datetime_signed'],
            'jobs_id' => $jobs_id,
        );
        $this->general->add_($jobs_approval_data, 'jobs_approval');

        $method = $input['method'];
        $jobs_payments_data = array();
        $jobs_payments_data['jobs_id'] =  $jobs_id;
        $jobs_payments_data['method'] =  $method;
        $jobs_payments_data['amount'] =  $input['total_amount'];

        if($method == 'CHECK'){
            $jobs_payments_data['route_num'] = $input['route_number'];
            $jobs_payments_data['account_num'] = $input['account_number'];
        }else if($method == 'CC'|| $method == 'OCCP'){
            $jobs_payments_data['account_name'] = $input['account_holder_name'];
            $jobs_payments_data['card_number'] = $input['card_number'];
            $jobs_payments_data['card_mmyy'] = $input['card_expiry'];
            $jobs_payments_data['card_cvc'] = $input['card_cvc'];
            $jobs_payments_data['is_save_file'] = $input['onoffswitch'];
        }else if($method === 'CASH'){
            $jobs_payments_data['is_collected'] = $input['is_collected'];
        }else if($method === 'ACH'){
            $jobs_payments_data['route_num'] = $input['route_number'];
            $jobs_payments_data['account_num'] = $input['account_number'];
            $jobs_payments_data['day_of_month'] = $input['day_of_month'];
        }else if($method === 'OPT' || $method === 'WW'){
            $jobs_payments_data['acct_credential'] = $input['acct_credential'];
            $jobs_payments_data['acct_note'] = $input['acct_note'];
            $jobs_payments_data['is_signed'] = $input['is_signed'];
        }else if($method === 'SQ' || $method === 'PP' || $method === 'VENMO'){
            $jobs_payments_data['acct_credential'] = $input['acct_credential'];
            $jobs_payments_data['acct_note'] = $input['acct_note'];
            $jobs_payments_data['acct_confirm'] = $input['acct_confirm'];
        }else{

        }
        $this->general->add_($jobs_payments_data, 'jobs_pay_details');
        $jobs_settings_data = array(
            'job_num_next' => $job_settings[0]->job_num_next + 1
        );
        $this->general->update_with_key($jobs_settings_data,$job_settings[0]->id, 'job_settings');
        echo $jobs_id;
    }

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

        $settings = $this->settings_model->getValueByKey(DB_SETTINGS_TABLE_KEY_SCHEDULE);
        $this->page_data['settings'] = unserialize($settings);

        if( $role == 1 || $role == 2 ){
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobs();
        }else{
            $upcomingJobs = $this->jobs_model->getAllUpcomingJobsByCompanyId($comp_id);
        }

        $this->page_data['upcomingJobs'] = $upcomingJobs;
        $this->load->view('job/ajax_load_upcoming_jobs', $this->page_data);

    }

    public function add_new_job_type()
    {
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->load->view('job/job_settings/add_new_job_type', $this->page_data);
    }

    public function create_job_type()
    {
        postAllowed();

        $this->load->model('Icons_model');

        $comp_id = logged('company_id');
        $user_id = logged('id');
        $post    = $this->input->post();

        if( $post['job_type_name'] != ''){
            if( isset($post['is_default_icon']) ){
                $icon = $this->Icons_model->getById($post['default_icon_id']);
                $marker_icon = $icon->image;
                $data_job_type = [
                    'user_id' => $user_id,
                    'company_id' => $comp_id,
                    'title' => $post['job_type_name'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => 1,
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s")
                ];

                $job_type_id = $this->JobType_model->create($data_job_type);
                if( $job_type_id > 0 ){

                    $this->session->set_flashdata('message', 'Add new job type was successful');
                    $this->session->set_flashdata('alert_class', 'alert-success');

                    redirect('job/job_types');

                }else{
                    $this->session->set_flashdata('message', 'Cannot save data.');
                    $this->session->set_flashdata('alert_class', 'alert-danger');

                    redirect('job/add_new_job_type');
                }
            }else{
                if( !empty($_FILES['image']['name']) ){

                    $marker_icon = $this->moveUploadedFile();
                    $data_job_type = [
                        'user_id' => $user_id,
                        'company_id' => $comp_id,
                        'title' => $post['job_type_name'],
                        'icon_marker' => $marker_icon,
                        'is_marker_icon_default_list' => 0,
                        'status' => 1,
                        'created_at' => date("Y-m-d H:i:s")
                    ];

                    $job_type_id = $this->JobType_model->create($data_job_type);
                    if( $job_type_id > 0 ){

                        $this->session->set_flashdata('message', 'Add new job type was successful');
                        $this->session->set_flashdata('alert_class', 'alert-success');

                        redirect('job/job_types');

                    }else{
                        $this->session->set_flashdata('message', 'Cannot save data.');
                        $this->session->set_flashdata('alert_class', 'alert-danger');

                        redirect('job/add_new_job_type');
                    }
                }else{
                    $this->session->set_flashdata('message', 'Please specify job type icon / marker image');
                    $this->session->set_flashdata('alert_class', 'alert-danger');

                    redirect('job/add_new_job_type');
                }
            }
        }else{
            $this->session->set_flashdata('message', 'Please specify job type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('job/add_new_job_type');
        }
    }

    public function edit_job_type( $job_type_id ){
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $jobType = $this->JobType_model->getById($job_type_id);
        $icons   = $this->Icons_model->getAll();

        $this->page_data['jobType'] = $jobType;
        $this->page_data['icons'] = $icons;
        $this->load->view('job/job_settings/edit_job_type', $this->page_data);
    }

    public function update_job_type() {
        postAllowed();

        $this->load->model('Icons_model');

        $post    = $this->input->post();

        if( $post['job_type_name'] != '' ){

            $jobType = $this->JobType_model->getById($post['eid']);
            if( $jobType ){
                $marker_icon = $jobType->icon_marker;
                $is_marker_icon_default_list = $jobType->is_marker_icon_default_list;
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

                $data_job_type = [
                    'title' => $post['job_type_name'],
                    'icon_marker' => $marker_icon,
                    'is_marker_icon_default_list' => $is_marker_icon_default_list
                ];

                $this->JobType_model->updateJobTypeById($post['eid'], $data_job_type);

                $this->session->set_flashdata('message', 'Job Type was successful updated');
                $this->session->set_flashdata('alert_class', 'alert-success');

                redirect('job/job_types');

            }else{
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');

                redirect('job/job_types');
            }

        }else{
            $this->session->set_flashdata('message', 'Please specify job type name');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('job/edit_job_type/'.$post['eid']);

        }
    }

    public function moveUploadedFile() {
        if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
            $company_id = logged('company_id');
            $target_dir = "./uploads/job_types/" . $company_id . "/";
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

    public function jobTagMoveUploadedFile() {
        if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
            $company_id = logged('company_id');
            $target_dir = "./uploads/job_tags/" . $company_id . "/";
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

    public function job_settings(){
        $this->load->model('JobSettings_model');

        $company_id = logged('company_id');
        $setting = $this->JobSettings_model->getJobSettingByCompanyId($company_id);

        $this->page_data['setting'] = $setting;
        $this->load->view('job/settings', $this->page_data);
    }

    public function save_setting($id = null)
    {
        $this->load->model('JobSettings_model');

        postAllowed();
        $user = (object)$this->session->userdata('logged');
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "2048000",
            'max_height' => "768",
            'max_width' => "1024"
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload()) {
            $draftlogo = array('upload_data' => $this->upload->data());
            $logo = $draftlogo['upload_data']['file_name'];
        } else {
            if ($id) {
                $logo = post('img_setting');
            } else {
                $logo = '';
            }
        }

        $payment_methods = array(
            'cc' => post('payment_cc'),
            'check' => post('payment_check'),
            'cash' => post('payment_cash'),
            'deposit' => post('payment_deposit')
        );

        $invoice_number = array(
            'prefix' => post('prefix'),
            'base' => post('base'),
        );

        $residential = array(
            'default_msg' => post('message'),
            'default_terms' => post('terms'),
        );

        $commercial = array(
            'default_msg' => post('message_commercial'),
            'default_terms' => post('terms_commercial'),
        );

        $payment_fee = array(
            'percent' => post('payment_fee_percent'),
            'amount' => post('payment_fee_amount'),
        );

        $invoice_template = array(
            'item_price' => post('hide_item_price'),
            'item_qty' => post('hide_item_qty'),
            'item_tax' => post('hide_item_tax'),
            'item_discount' => post('hide_item_discount'),
            'item_total' => post('hide_item_total'),
            'from_email' => post('hide_from_email'),
            'item_subtotal' => post('show_item_type_subtotal')
        );

        $invoice_from = array(
            'business_phone' => post('from_phone_show'),
            'office_phone' => post('from_office_phone_show'),
        );

        $comp_id = logged('company_id');
        if (!$id) {
            $this->JobSettings_model->create([
                'user_id' => $user->id,
                'company_id' => $comp_id,
                'invoice_number' => serialize($invoice_number),
                'residential' => serialize($residential),
                'commercial' => serialize($commercial),
                'logo' => $logo,
                'payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'invoice_type' => post('invoice_type'),
                'payment_fee' => serialize($payment_fee),
                'invoice_template' => serialize($invoice_template),
                'invoice_from' => serialize($invoice_from),
                'recurring' => post('recurring_on_add_child'),
                'payment_method' => serialize($payment_methods),
                'mobile_payment' => post('payment_mobile_status'),
                'invoice_tip' => post('tip_status'),
                'autoconvert_work_order' => post('autoconvert_work_order')
            ]);
        } else {
            $this->JobSettings_model->update($id, [
                'user_id' => $user->id,
                'company_id' => $comp_id,
                'invoice_number' => serialize($invoice_number),
                'residential' => serialize($residential),
                'commercial' => serialize($commercial),
                'logo' => $logo,
                'payable_to' => post('payment_to'),
                'due_terms' => post('due_terms'),
                'invoice_type' => post('invoice_type'),
                'payment_fee' => serialize($payment_fee),
                'invoice_template' => serialize($invoice_template),
                'invoice_from' => serialize($invoice_from),
                'recurring' => post('recurring_on_add_child'),
                'payment_method' => serialize($payment_methods),
                'mobile_payment' => post('payment_mobile_status'),
                'invoice_tip' => post('tip_status'),
                'autoconvert_work_order' => post('autoconvert_work_order')
            ]);
        }

        $this->activity_model->add('Update Invoice Settings $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Invoice Settings Saved Successfully');

        redirect('invoice/settings');
    }

    public function add_new_job_tag()
    {
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->load->view('job/add_new_job_tag', $this->page_data);
    }

    public function edit_job_tag($id)
    {
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');

        add_css(array(
            'assets/css/hover.css'
        ));

        $jobTag = $this->JobTags_model->getById($id);
        $icons = $this->Icons_model->getAll();

        $this->page_data['icons'] = $icons;
        $this->page_data['jobTag'] = $jobTag;
        $this->load->view('job/edit_job_tag', $this->page_data);
    }

    public function create_new_job_tag()
    {
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        if( isset($post['is_default_icon']) ){
            $icon = $this->Icons_model->getById($post['default_icon_id']);
            $marker_icon = $icon->image;
            $data = [
                'name' => $post['job_tag_name'],
                'company_id' => $company_id,
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => 1
            ];

            $this->JobTags_model->create($data);
        }else{
            $marker_icon = $this->jobTagsMoveUploadedFile();
            if( $marker_icon != '' ){
                $data = [
                    'name' => $post['job_tag_name'],
                    'company_id' => $company_id,
                    'marker_icon' => $marker_icon,
                    'is_marker_icon_default_list' => 0
                ];

                $this->JobTags_model->create($data);
            }else{
                $this->session->set_flashdata('message', 'Cannot update job tag');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }

        }

        $this->session->set_flashdata('message', 'Add new job tag was successful');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('job/job_tags');
    }

    public function update_job_tag(){
        $this->load->model('JobTags_model');
        $this->load->model('Icons_model');

        $post = $this->input->post();
        $company_id = logged('company_id');

        $jobTag = $this->JobTags_model->getById($post['jid']);
        if( $jobTag ){
            $marker_icon = $jobTag->marker_icon;
            $is_marker_icon_default_list = $jobTag->is_marker_icon_default_list;
            if( isset($post['is_default_icon']) ){
                if( $post['default_icon_id'] > 0 ){
                    $icon = $this->Icons_model->getById($post['default_icon_id']);
                    $marker_icon = $icon->image;
                    $is_marker_icon_default_list = 1;
                }

            }else{
                if( $_FILES['image']['size'] > 0 ){
                    $marker_icon = $this->jobTagMoveUploadedFile();
                    $is_marker_icon_default_list = 0;
                }
            }

            $data = [
                'name' => $post['job_tag_name'],
                'marker_icon' => $marker_icon,
                'is_marker_icon_default_list' => $is_marker_icon_default_list
            ];

            $this->JobTags_model->update($post['jid'],$data);

            $this->session->set_flashdata('message', 'Update job tag was successful');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }else{
            $this->session->set_flashdata('message', 'Record not found');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('job/job_tags');
    }

    public function jobTagsMoveUploadedFile() {
        if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
            $company_id = logged('company_id');
            $target_dir = "./uploads/job_tags/" . $company_id . "/";
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


    public function createOrUpdateSignature()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $isCreated = false;

        $this->db->where('jobs_id', $payload['jobs_id']);
        $record = $this->db->get('jobs_approval')->row();

        if (is_null($record)) {
            $isCreated = true;
            $this->db->insert('jobs_approval', $payload);
        } else {
            $this->db->where('id', $record->id);
            $this->db->update('jobs_approval', $payload);
        }

        $id = $isCreated ? $this->db->insert_id() : $record->id;
        $this->db->where('id', $id);
        $record = $this->db->get('jobs_approval')->row();

        header('content-type: application/json');
        echo json_encode(['jobs_approval' => $record, 'is_created' => $isCreated]);
    }

    public function send_customer_invoice_email($id){
        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
        $this->load->helper(array('url', 'hashids_helper'));
        $this->load->model('general_model');
        $this->load->model('AcsProfile_model');

        $job = $this->jobs_model->get_specific_job($id);
        if( $job ){
            $eid      = hashids_encrypt($job->job_unique_id, '', 15);
            $job_id   = hashids_decrypt($eid, '', 15);
            $url = base_url('/job_invoice_view/' . $eid);
            $customer = $this->AcsProfile_model->getByProfId($job->customer_id);

             $get_company_info = array(
                'where' => array(
                    'company_id' => $job->company_id,
                ),
                'table' => 'business_profile',
                'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
            );

            $company   = $this->general_model->get_data_with_param($get_company_info,FALSE);
            $jobs_data_items = $this->jobs_model->get_specific_job_items($job_id);                                    
            $group_items = array();
            foreach($jobs_data_items as $ji){
                $type = 'product';
                if($ji->type != 'product'){
                    $type = 'service';
                }
                $group_items[$type][] = [
                    'item_name' => $ji->title,
                    'item_price' => $ji->price,
                    'item_qty' => $ji->qty
                ];
            }
            $subject = "NsmarTrac : Job Invoice";
            $img_source = base_url('/uploads/users/business_profile/'.$company->id.'/'.$company->business_image);
            $msg .= "<img style='width: 300px;margin-top:41px;margin-bottom:24px;' alt='Logo' src='".$img_source."' /><br />";
            $msg .= "<h1>Your Invoice from ". $company->business_name ."</h1><br />";
            $msg .= "<p>Hi " . $customer->first_name . ",</p>";
            $msg .= "<p>Attached please find invoice <b>#" . $job->job_number . "</b> for your service</p>";
            $msg .= "<p>Thank you,</p><br />";

            $msg .= "<table>";
                $msg .= "<tr><td><b>Invoice Number</b></td><td>: ".$job->job_number."</td></tr>";
                $msg .= "<tr><td><b>Service Date</b></td><td>: ".date('m/d/Y', strtotime($job->start_date))."</td></tr>";
                $msg .= "<tr><td colspan='2'><br /></td></tr>";
                $msg .= "<tr><td><b>Customer Name</b></td><td>: ".$job->first_name.' '.$job->last_name."</td></tr>";
                $msg .= "<tr><td><b>Service Address</b></td><td>: ".$jobs_data->cust_city.' '.$jobs_data->cust_state.' '.$jobs_data->cust_zip_code."</td></tr>";
            $msg .= "</table>";
            
            $grand_total = 0;
            foreach($group_items as $type => $items){
                $subtotal = 0;

                $msg .= "<h2>".ucfirst($type)."</h2>";
                $msg .= "<table>";
                foreach($items as $i){
                    $total = $i['item_price'] * $i['item_qty'];
                    //$msg  .= "<tr><td>".$item->title."</td><td>".$item->qty."x".$item->price."</td><td>".number_format((float)$total,2,'.',',')."</td></tr>";
                    $msg  .= "<tr><td width='300'>".$i['item_name']."</td><td>".number_format((float)$total,2,'.',',')."</td></tr>";
                    $subtotal = $subtotal + $total;                    
                }
                $msg .= "<tr><td colspan='2'><hr /></td></tr>";
                $msg .= "<tr><td width='300'>Subtotal</td><td>".number_format((float)$subtotal,2,'.',',')."</td></tr>";
                $msg .= "</table>";

                $grand_total += $subtotal;

            }

            $nsmart_logo  = base_url("assets/dashboard/images/logo.png");
            $refer_friend = base_url("assets/img/refer_friend.jpg");
            $refer_friend_url = base_url('refer_friend');

            $msg .= "<br /><br />";
            $msg .= "<table>";
                $msg .= "<tr><td width='300'><h3>Amount Due</h3></td><td><h2>".number_format((float)$grand_total,2,'.',',')."</h2></td></tr>";
                $msg .= "<tr><td colspan='2'><br><br></td></tr>";
                $msg .= "<tr><td colspan='2' style='text-align:center;'><a href='".$url."' style='background-color:#32243d;color:#fff;padding:10px 25px;border:1px solid transparent;border-radius:2px;font-size:22px;text-decoration:none;'>PAY NOW</a></td></tr>";
            $msg .= "</table>";

            if( $job->invoice_term != '' ){
                $msg .= $job->invoice_term;
            }else{
                $msg .= "<p style='margin-top:43px;width:23%;color:#222;font-size:16px;text-align:left;padding:19px;'>Delinquent Account are subject to Property Liens. Interest will be charged to delinquent accounts at the rate of 1.5% (18% Annum) per month. In the event of default, the customer agrees to pay all cost of collection, including attorney's fees, whether suit is brought or not.</p>";
            }
            
            $msg .= "<p style='width:24%;color:#222;font-size:16px;text-align:center;padding:1px;'><a href='tel:".$company->business_phone."'>".$company->business_phone."</a> | <a href='mailto:".$company->business_email."'>".$company->business_email."</a></p>";
            $msg .= "<a href='".$refer_friend_url."' style='margin-left:156px;'><img src='".$refer_friend."' style='width:122px;' /></a>";

            $msg .= "<br><br><br><br><br>";
            
            $msg .= "<table style='margin-left:48px;'>";
                $msg .= "<tr><td colspan='2' style='text-align:center;'><span style='display:inline-block;'>Powered By</span> <br><br> <img style='width:328px;margin-bottom:40px;' src='".$nsmart_logo."' /></td></tr>";
            $msg .= "</table>";
            
            //Email Sending
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $recipient = $customer->email;
            //$recipient = 'bryann.revina03@gmail.com';
            $attachment = $this->create_job_invoice_pdf($job->job_unique_id);
            
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
            $mail->Body    = $msg;
            $mail->addAttachment($attachment);  

            if(!$mail->Send()) {
                $this->session->set_flashdata('alert-type', 'danger');
                $this->session->set_flashdata('alert', 'Cannot send email.');
            }else{
                $this->session->set_flashdata('alert-type', 'success');
                $this->session->set_flashdata('alert', 'Your invoice was successfully sent');
            }

        }else{
            $this->session->set_flashdata('message', 'Cannot find data.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }
        redirect('job');
    }

    public function create_job_invoice_pdf($job_id){
        // load models
        $this->load->model('general_model');
        $this->load->model('jobs_model');
        $this->load->model('CompanyOnlinePaymentAccount_model');

        // load helpers
        $this->load->helper('functions');

        $job = $this->jobs_model->get_specific_job($job_id);
        $get_company_info = array(
            'where' => array(
                'company_id' => $job->company_id,
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_logo,business_email,street,city,postal_code,state,business_image',
        );
        $onlinePaymentAccount = $this->CompanyOnlinePaymentAccount_model->getByCompanyId($job->company_id);
        $this->page_data['onlinePaymentAccount'] = $onlinePaymentAccount;
        $this->page_data['company_info'] = $this->general_model->get_data_with_param($get_company_info,FALSE);
        $this->page_data['jobs_data_items'] = $this->jobs_model->get_specific_job_items($job_id);
        $this->page_data['jobs_data'] = $job;
        //$content = $this->load->view('job/job_customer_invoice_pdf', $this->page_data, TRUE);
        $content = $this->load->view('job/job_customer_invoice_pdf_template_b', $this->page_data, TRUE);
        //echo $content;exit;

        $this->load->library('Reportpdf');
        $title = 'jobinvoice';

        $obj_pdf = new Reportpdf('P', 'mm', 'A4', true, 'UTF-8', false);
        $obj_pdf->SetTitle($title);
        $obj_pdf->setPrintHeader(false);
        $obj_pdf->setPrintFooter(false);
        //$obj_pdf->SetDefaultMonospacedFont('helvetica');
        $obj_pdf->SetMargins(10, 5, 10, 0, true);
        $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        //$obj_pdf->SetFont('courierI', '', 9);
        $obj_pdf->setFontSubsetting(false);
        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $obj_pdf->AddPage('P');
        $html = '';
        $obj_pdf->writeHTML($html . $content, true, false, true, false, '');
        ob_clean();
        $obj_pdf->lastPage();
        // $obj_pdf->Output($title, 'I');
        $filename = strtolower($job->job_number) . ".pdf";
        $file     = dirname(__DIR__, 2) . '/uploads/job_invoce_pdf/' . $filename;
        $obj_pdf->Output($file, 'F');        
        //$obj_pdf->Output($file, 'F');
        return $file;
    }

    public function save_cc_payment(){
        $comp_id = logged('company_id');
        $user_id = logged('id');
        $post    = $this->input->post();

        echo "<pre>";
        print_r($post);
        exit;
    }
}

/* End of file Job.php */

/* Location: ./application/controllers/job.php */
