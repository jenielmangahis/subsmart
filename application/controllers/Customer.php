<?php


defined('BASEPATH') or exit('No direct script access allowed');

// add services
include_once 'application/services/CustomerGroup.php';
include_once 'application/services/CustomerSource.php';
include_once 'application/services/CustomerTypes.php';
include_once 'application/services/CustomerTicket.php';

class Customer extends MY_Controller

{

    public function __construct()

    {

        parent::__construct();

        $this->page_data['page']->title = 'My Customers';
        $this->page_data['page']->menu = 'customers';
        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('CustomerAddress_model', 'customeraddress_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->checkLogin();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('functions');

        $user_id = getLoggedUserID();
        // concept
        $uid = $this->session->userdata('uid');
        if (empty($uid)) {
            $this->page_data['uid'] = md5(time());
            $this->session->set_userdata(['uid' => $this->page_data['uid']]);
        } else {
            $uid = $this->session->userdata('uid');
            $this->page_data['uid'] = $uid;
        }
        // CSS to add only Customer module
        add_css(array(
            'assets/css/jquery.signaturepad.css',
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'assets/css/accounting/sales.css',
        ));

        // JS to add only Customer module
        add_footer_js(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
           // 'assets/frontend/js/creditcard.js',
           // 'assets/frontend/js/customer/add.js',
        ));
    }

    public function leads()
    {
        $user_id = logged('id');
        $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('customer/leads', $this->page_data);
    }

    public function ac_module_sort(){
        //$user_id = logged('id');
        $input = $this->input->post();
        if($this->customer_ad_model->update_data($input,"ac_module_sort","ams_id")){
            echo "Module Sort Updated!";
        }else{
            echo "Error";
        }
    }


    public function qrcodeGenerator($profile_id){
        $this->load->library('qrcode/ciqrcode');
        $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/assets/img/customer/qr/'.$profile_id.'.png';

        $params['data'] = 'https://nsmartrac.com/customer/index/tab2/'.$profile_id;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = $SERVERFILEPATH;
        $this->ciqrcode->generate($params);
        //echo '<img src="'.base_url().'assets/img/customer/qr/names.png" />';
    }

    public function add_data_sheet(){

        $user_id = logged('id');
        $input = $this->input->post();

        $input_profile = array();
        $input_billing = array();
        $input_alarm = array();
        $input_office = array();
        $input_access = array();
        $input_profile['fk_user_id'] = logged('id');
        $input_profile['fk_sa_id'] = $input['fk_sa_id'];
        $input_profile['first_name'] = $input['first_name'];
        $input_profile['last_name'] = $input['last_name'];
        $input_profile['middle_name'] = $input['middle_name'];
        $input_profile['prefix'] = $input['prefix'];
        $input_profile['prefix'] = $input['prefix'];
        $input_profile['business_name'] = $input['business_name'];
        $input_profile['email'] = $input['email'];

        if(is_array($input['ssn']) && !empty($input['ssn'])){
           // echo $input['ssn'];
            if(empty($input['ssn'][0])){
                $input_profile['ssn'] = '';
            }else{
                $input_profile['ssn'] = $input['ssn'][0].'-'.$input['ssn'][1].'-'.$input['ssn'][2];
            }
        }else{
            $input_profile['ssn'] = '';
        }
        $input_profile['date_of_birth'] = $input['date_of_birth'];
        $input_profile['phone_h'] = $input['phone_h'];
        $input_profile['phone_w'] = $input['phone_w'];
        $input_profile['phone_m'] = $input['phone_m'];
        $input_profile['fax'] = $input['fax'];
        $input_profile['mail_add'] = $input['mail_add'];
        $input_profile['city'] = $input['city'];
        $input_profile['state'] = $input['state'];
        $input_profile['country'] = $input['country'];
        $input_profile['zip_code'] = $input['zip_code'];
        $input_profile['cross_street'] = $input['cross_street'];
        $input_profile['subdivision'] = $input['subdivision'];
       // $input_profile['img_path'] = $input['img_path'];
        $input_profile['pay_history'] = $input['pay_history'];
        $input_profile['notes'] = $input['notes'];
        $input_profile['status'] = $input['status'];
       // $input_profile['assign'] = $input['assign'];

        // billing data
        $input_billing['card_fname'] = $input['card_fname'];
        $input_billing['card_lname'] = $input['card_lname'];
        $input_billing['card_address'] = $input['card_address'];
        $input_billing['city'] = $input['billing_city'];
        $input_billing['state'] = $input['billing_state'];
        $input_billing['zip'] = $input['billing_zip'];
        $input_billing['mmr'] = $input['mmr'];
        $input_billing['bill_freq'] = $input['bill_freq'];
        $input_billing['bill_day'] = $input['bill_day'];
        $input_billing['contract_term'] = $input['contract_term'];
        $input_billing['bill_method'] = $input['bill_method'];
        $input_billing['bill_start_date'] = $input['bill_start_date'];
        $input_billing['bill_end_date'] = $input['bill_end_date'];
        $input_billing['check_num'] = $input['check_num'];
        $input_billing['routing_num'] = $input['routing_num'];
        $input_billing['acct_num'] = $input['acct_num'];
        $input_billing['credit_card_num'] = $input['credit_card_num'];
        $input_billing['credit_card_exp'] = $input['credit_card_exp'];
        $input_billing['credit_card_exp_mm_yyyy'] = $input['credit_card_exp_mm_yyyy'];

        // alarm data
        $input_alarm['monitor_comp'] = $input['monitor_comp'];
        $input_alarm['monitor_id'] = $input['monitor_id'];
        $input_alarm['install_date'] = $input['install_date'];
        $input_alarm['credit_score_alarm'] = $input['credit_score_alarm'];
        $input_alarm['acct_type'] = $input['acct_type'];
        $input_alarm['acct_info'] = $input['acct_info'];
        $input_alarm['passcode'] = $input['passcode'];
        $input_alarm['install_code'] = $input['install_code'];
        $input_alarm['mcn'] = $input['mcn'];
        $input_alarm['scn'] = $input['scn'];
        $input_alarm['contact1'] = $input['contact1'];
        $input_alarm['contact2'] = $input['contact2'];
        $input_alarm['contact3'] = $input['contact3'];
        $input_alarm['contact_name1'] = $input['contact_name1'];
        $input_alarm['contact_name2'] = $input['contact_name2'];
        $input_alarm['contact_name3'] = $input['contact_name3'];
        $input_alarm['panel_type'] = $input['panel_type'];
        $input_alarm['system_type'] = $input['system_type'];
        $input_alarm['mon_waived'] = $input['mon_waived'];

        // office data
        if(isset($input['welcome_sent'])){
            $input_office['welcome_sent'] = $input['welcome_sent'];
        }else{
            $input_office['welcome_sent'] = 0;
        }

        if(isset($input['rebate'])){
            $input_office['rebate'] = $input['rebate'][0];
        }else{
            $input_office['rebate'] = 2;
        }

        if(isset($input['commision_scheme'])){
            $input_office['commision_scheme'] = $input['commision_scheme'][0];
        }else{
            $input_office['commision_scheme'] = 2;
        }

        $input_office['rep_comm'] = $input['rep_comm'];
        $input_office['rep_upfront_pay'] = $input['rep_upfront_pay'];
        $input_office['tech_comm'] = $input['tech_comm'];
        $input_office['tech_upfront_pay'] = $input['tech_upfront_pay'];
        $input_office['rep_charge_back'] = $input['rep_charge_back'];
        $input_office['rep_payroll_charge_back'] = $input['rep_payroll_charge_back'];

        if(isset($input['pso'])){
            $input_office['pso'] = $input['pso'][0];
        }else{
            $input_office['pso'] = 2;
        }

        $input_office['assign_to'] = $input['assign_to'];
        $input_office['points_include'] = $input['points_include'];
        $input_office['price_per_point'] = $input['price_per_point'];
        $input_office['purchase_price'] = $input['purchase_price'];
        $input_office['purchase_multiple'] = $input['purchase_multiple'];
        $input_office['purchase_discount'] = $input['purchase_discount'];
        $input_office['entered_by'] = $input['entered_by'];
        $input_office['time_entered'] = $input['time_entered'];
        $input_office['sales_date'] = $input['sales_date'];
        $input_office['credit_score'] = $input['credit_score'];
        $input_office['language'] = $input['language'];
        $input_office['fk_sales_rep_office'] = $input['fk_sales_rep_office'];
        $input_office['technician'] = $input['technician'];
        $input_office['save_date'] = $input['save_date'];
        $input_office['save_by'] = $input['save_by'];
        $input_office['cancel_date'] = $input['cancel_date'];
        $input_office['cancel_reason'] = $input['cancel_reason'];

        if(isset($input['sched_conflict'])){
            $input_office['sched_conflict'] = $input['sched_conflict'];
        }else{
            $input_office['sched_conflict'] = 0;
        }

        $input_office['install_date'] = $input['install_date'];
        $input_office['tech_arrive_time'] = $input['tech_arrive_time'];
        $input_office['tech_depart_time'] = $input['tech_depart_time'];
        $input_office['pre_install_survey'] = $input['pre_install_survey'];
        $input_office['post_install_survey	'] = $input['post_install_survey'];

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

        $input_office['lead_source'] = $input['lead_source'];
        $input_office['url'] = $input['url'];
        $input_office['verification'] = $input['verification'];
        $input_office['warranty_type'] = $input['warranty_type'];
        $input_office['office_custom_field1'] = $input['office_custom_field1'];

        //access data
        if(isset($input['portal_status'])){
            $input_access['portal_status'] = $input['portal_status'];
        }else{
            $input_access['portal_status'] = 2;
        }
        $input_access['reset_password'] = $input['reset_password'];
        $input_access['login'] = $input['login'];
        $input_access['password'] = $input['password'];
        $input_access['acs_custom_field1'] = $input['acs_custom_field1'];
        $input_access['acs_custom_field2'] = $input['acs_custom_field2'];
        $input_access['acs_cancel_date'] = $input['acs_cancel_date'];
        $input_access['acs_collect_date'] = $input['acs_collect_date'];
        $input_access['acs_cancel_reason'] = $input['acs_cancel_reason'];
        $input_access['collect_amount'] = $input['collect_amount'];

        $fk_prod_id = $input['prof_id'];
        if(empty($fk_prod_id)){
            $fk_prod_id = $this->customer_ad_model->add($input_profile,"acs_profile");

            $input_access['fk_prof_id'] = $fk_prod_id;
            $input_office['fk_prof_id'] = $fk_prod_id;
            $input_alarm['fk_prof_id'] = $fk_prod_id;
            $input_billing['fk_prof_id'] = $fk_prod_id;

            $this->customer_ad_model->add($input_access,"acs_access");
            $this->customer_ad_model->add($input_office,"acs_office");
            $this->customer_ad_model->add($input_alarm,"acs_alarm");
            $this->customer_ad_model->add($input_billing,"acs_billing");

            $this->qrcodeGenerator($fk_prod_id);

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

    public function add_advance()
    {
        $userid = $this->uri->segment(3);
        $user_id = logged('id');
        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
            $this->page_data['device_info'] = $this->customer_ad_model->get_all_by_id('fk_prof_id',$userid,"acs_devices");
        }
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_salesarea","sa_id");
        $this->page_data['employees'] = $this->customer_ad_model->get_all(FALSE,"","ASC","users","id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->load->view('customer/add_advance', $this->page_data);
    }

    public function add_lead($lead_id=0)
    {
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

    public function add_task_ajax(){
        $input = $this->input->post();
        // customer_ad_model
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

    public function index($status_index = 0)
    {

       //echo  $this->uri->segment(3);
      // echo  $this->uri->segment(4);
        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('status' => $status_index), $company_id));
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('search' => get('search')), $company_id));
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id));
                    } else {
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type')), $company_id));
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id));
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')), $company_id);
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->getAllByCompany($company_id));
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id);
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount($company_id);

        }

        if ($role == 4) {

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('status' => $status_index)));
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('search' => get('search'))));
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order'))));
                    } else {
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type'))));
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order'))));
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')));
                        $this->page_data['customers'] = $this->categorizeNameAlphabetically($this->customer_model->getAllByUserId());
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByUserId();
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount();
        }

        $this->page_data['customers'] = $this->customer_model->getAllByUserId();

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
            }
        }else{
            $this->qrcodeGenerator($userid);
        }

        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
            $this->page_data['audit_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_audit_import");
           // print_r($this->page_data['alarm_info']);
        }
        $this->page_data['task_info'] = $this->customer_ad_model->get_all_by_id("fk_prof_id",$userid,"acs_tasks");
        $this->page_data['module_sort'] = $this->customer_ad_model->get_data_by_id('fk_user_id',$user_id,"ac_module_sort");
        $this->page_data['cust_tab'] = $this->uri->segment(3);
        $this->page_data['minitab'] = $this->uri->segment(5);
        $this->page_data['affiliates'] = $this->customer_ad_model->get_all(FALSE,"","","affiliates","id");
        $this->page_data['lead_types'] = $this->customer_ad_model->get_all(FALSE,"","","ac_leadtypes","lead_id");
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","","ac_salesarea","sa_id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['profiles'] = $this->customer_ad_model->get_customer_data($user_id);
        $this->load->view('customer/list', $this->page_data);
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


    public function json_get_address_services()
    {
        $get = $this->input->get();
        if (!empty($get['customer_id'])) {

            $cid = $get['customer_id'];

        } else {

            $cid = $this->session->userdata('customer_id');

        }


        if (!empty($cid)) {


            $this->page_data['customer_id'] = $cid;

            $this->page_data['serviceAddresses'] = $this->customer_model->getServiceAddress(array('id' => $cid));

            // echo '<pre>'; print_r($serviceAddresses); die;

        }


        die($this->load->view('customer/service_address_list', $this->page_data, true));

    }


    public function add()
    {

        $user_id = logged('id');

        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();


        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//

        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);

        // } else {

        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);

        // }


        //


        $company_id = logged('company_id');

       // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        //$this->page_data['groups'] = get_customer_groups();


        $this->load->view('customer/add', $this->page_data);

    }


    public function remove_address_services()

    {


        $post = $this->input->post();


        if ($this->customer_model->removeServiceAddress($post['customer_id'], $post['index'])) {


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


    public function additional_contact_form()

    {

        $get = $this->input->get();


        if (!empty($get)) {


            $this->page_data['action'] = $get['action'];

            $this->page_data['data_index'] = $get['index'];

            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);

            $this->page_data['additional_contacts'] = $this->customer_model->getAdditionalContacts(array('id' => $get['customer_id']), $get['index']);

            // print_r($this->page_data['service_address']); die;

        }


        die($this->load->view('customer/additional_contact_form', $this->page_data, true));

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


    public function tab($index)
    {

        $this->index($index);
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


    /**
     * used a concept of Service here
     * If we need the Priority module on other controller, we have to write same code
     * like add, edit, delete route on that controller again. If we need a change, we have to do on all controller.
     * Also, it has multiple level of route, so put all together in one controller, code become hard to read.
     * So, to get rid of these issues, the service class every time whenever we need this module.
     *
     */
    public function group()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerGroup = new CustomerGroup($this);
    }


    /**
     *
     */
    public function source()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerSource = new CustomerSource($this);
    }

    public function types()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerTypes = new CustomerTypes($this);
    }

    /**
     *
     */
    public function ticket()
    {
        // pass the $this so that we can use it to load view, model, library or helper classes
        $customerTicket = new CustomerTicket($this);
    }


    public function group_form()
    {
        $get = $this->input->get();
        if (!empty($get)) {
            $this->page_data['action'] = $get['action'];
            $this->page_data['data_index'] = $get['index'];
            $this->page_data['customer'] = $this->customer_model->getCustomer($get['customer_id']);
            $this->page_data['group'] = $this->customer_model->getServiceAddress(array('id' => $get['customer_id']), $get['index']);
        }
        die($this->load->view('customer/group_form', $this->page_data, true));
    }


    public function print($status_index = 0)
    {

        $role = logged('role');

        if ($role == 2 || $role == 3) {

            $company_id = logged('company_id');

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->customer_model->filterBy(array('status' => $status_index), $company_id);
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->customer_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id);
                    } else {
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')), $company_id);
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')), $company_id);
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')), $company_id);
                        $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id);
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByCompany($company_id);
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount($company_id);

        }

        if ($role == 4) {

            if (!empty($status_index)) {

                $this->page_data['tab_index'] = $status_index;
                $this->page_data['customers'] = $this->customer_model->filterBy(array('status' => $status_index));
            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['customers'] = $this->customer_model->filterBy(array('search' => get('search')));
                } elseif (!empty(get('type'))) {

                    $this->page_data['type'] = get('type');

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')));
                    } else {
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')));
                    }
                } else {

                    if (!empty(get('order'))) {
                        $this->page_data['order'] = get('order');
                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type', 'order'), 'order' => get('order')));
                    } else {
//                        $this->page_data['customers'] = $this->customer_model->filterBy(array('type' => get('type')));
                        $this->page_data['customers'] = $this->customer_model->getAllByUserId();
                    }

//                    $this->page_data['customers'] = $this->customer_model->getAllByUserId();
                }
            }

            $this->page_data['statusCount'] = $this->customer_model->getStatusWithCount();
        }

//        print_r($this->page_data['statusCount']); die;

        $this->load->view('customer/print/list', $this->page_data);

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

    public function exportItems()
    {
        $items = $this->customer_model->getByCompanyId(logged('company_id'));
        $delimiter = ",";
        $filename = getLoggedName()."_customer.csv";

        $f = fopen('php://memory', 'w');

        $fields = array('Customer Type', 'Company Name', 'Contact Name', 'Contact Email', 'Mobile', 'Phone', 'Birthday', 'Suite Unit', 'Street Address', 'City', 'State', 'Postal Code');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $item) {
                $csvData = array($item->customer_type, $item->company_name, $item->contact_name, $item->contact_email, $item->mobile, $item->phone, $item->birthday, $item->suite_unit, $item->street_address, $item->city, $item->state, $item->postal_code);
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

    public function importItems () {
        $data = array();
        $itemData = array();

        if ($this->input->post('importSubmit')) {
            $this->form_validation->set_rules('file', 'CSV file', 'callback_file_check');

            if ($this->form_validation->run() == true) {
                $insertCount = $updateCount = $rowCount = $notAddCount = 0;

                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->load->library('CSVReader');

                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                            $rowCount++;

                            $itemData = array(
                                'company_id' => logged('company_id'),
                                'customer_type' => $row['Customer Type'],
                                'company_name' => $row['Company Name'],
                                'contact_name' => $row['Contact Name'],
                                'contact_email' => $row['Contact Email'],
                                'mobile' => $row['Mobile'],
                                'phone' => $row['Phone'],
                                'birthday' => $row['Birthday'],
                                'suite_unit' => $row['Suite Unit'],
                                'street_address' => $row['Street Address'],
                                'city' => $row['City'],
                                'state' => $row['State'],
                                'postal_code' => $row['Postal Code']
                            );

                            $con = array(
                                'where' => array(
                                    'contact_name' => $row['Contact Name']
                                ),
                                'returnType' => 'count'
                            );
                            $prevCount = $this->customer_model->getRows($con);

                            if ($prevCount > 0) {
                                $condition = array('contact_name' => $row['Contact Name']);
                                $update = $this->customer_model->update($itemData, $condition);

                                if ($update) {
                                    $updateCount++;
                                }
                            } else {
                                $insert = $this->customer_model->insert($itemData);

                                if ($insert) {
                                    $insertCount++;
                                }
                            }
                        }

                        $notAddCount = ($rowCount - ($insertCount + $updateCount));
                        $successMsg = 'Customer imported successfully. Total Rows ('.$rowCount.') | Inserted ('.$insertCount.') | Updated ('.$updateCount.') | Not Inserted ('.$notAddCount.')';
                        $this->session->set_userdata('success_msg', $successMsg);

                        $this->activity_model->add($successMsg);
                        $this->session->set_flashdata('alert-type', 'success');
                        $this->session->set_flashdata('alert', $successMsg);
                    }
                } else {
                    $this->session->set_userdata('error_msg', 'Error on file upload, please try again.');
                }
            } else {
                $this->session->set_userdata('error_msg', 'Invalid file, please select only CSV file.');
            }
        }
        redirect('customer');
    }

        /*
     * Callback function to check file value and type during validation
     */
    public function file_check($str){
        $allowed_mime_types = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != ""){
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if(($ext == 'csv') && in_array($mime, $allowed_mime_types)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only CSV file to upload.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please select a CSV file to upload.');
            return false;
        }
    }
}


/* End of file Customer.php */


/* Location: ./application/controllers/Customer.php */

