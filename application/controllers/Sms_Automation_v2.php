<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sms_Automation_v2 extends MY_Controller {



	public function __construct()
	{
		parent::__construct();

        $this->load->model('SmsAutomation_model');
        $this->load->model('Users_model');    
        $this->load->model('Clients_model');             
        $this->load->model('Customer_model');
        $this->load->model('CustomerGroup_model');

        $this->page_data['page']->title = 'SMS Automation';
        $this->page_data['page']->menu = '';    

        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/plugins/timepicker/bootstrap-timepicker.css',
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/plugins/timepicker/bootstrap-timepicker.js'
        ));

	}

	public function index()
	{	

		$this->load->view('sms_automation/index', $this->page_data);

	}

	public function ajax_load_automation_list($status){
        $company_id = logged('company_id');
        if( $status > 0 ){
            $conditions[] = ['field' => 'sms_automation.status','value' => $status];    
        }else{
            $conditions = array();
        }
        
        $smsAutomation = $this->SmsAutomation_model->getAllByCompanyId($company_id, array(), $conditions);
        $optionRuleEvent = $this->SmsAutomation_model->optionRuleNotify();
        $optionRuleNotifyAt = $this->SmsAutomation_model->optionRuleNotifyAt();
        $optionStatus = $this->SmsAutomation_model->optionStatus();

        $this->page_data['optionRuleNotifyAt'] = $optionRuleNotifyAt;
        $this->page_data['optionRuleEvent'] = $optionRuleEvent;
        $this->page_data['optionStatus'] = $optionStatus;
        $this->page_data['smsAutomation'] = $smsAutomation;
        $this->load->view('sms_automation/ajax_load_automation_list', $this->page_data);
    }

    public function add_sms_automation(){
        $this->session->unset_userdata('smsAutomationId');

        $user = $this->session->userdata('logged');
        $cid  = logged('company_id');

        $this->page_data['selectedGroups'] = array();
        $this->page_data['customerGroups'] = $this->CustomerGroup_model->getAllByCompany($cid);
        $this->page_data['optionRuleNotify'] = $this->SmsAutomation_model->optionRuleNotify();
        $this->page_data['optionRuleNotifyAt'] = $this->SmsAutomation_model->optionRuleNotifyAt();
        $this->page_data['optionCustomerTypeService'] = $this->SmsAutomation_model->optionCustomerTypeService();
        $this->load->view('sms_automation/add_sms_automation', $this->page_data);
    }

    public function create_draft_automation(){    
    	$is_success = false;
    	$msg = '';

    	$user = $this->session->userdata('logged');
        $post = $this->input->post();
        if($this->session->userdata('smsAutomationId')){
        	$sms_automation_id = $this->session->userdata('smsAutomationId');

        	$excludeGroups = array();
	        if( isset($post['excludeGroups']) ){
	        	foreach($post['excludeGroups'] as $value){
	        		$excludeGroups[$value] = $value;
	        	}
	        }
	        unset($post['excludeGroups']);
	        $post['exclude_customer_groups'] = serialize($excludeGroups);
	        $smsAutomation = $this->SmsAutomation_model->updateSmsAutomation($sms_automation_id,$post);
	        $is_success = true;

        }else{
        	$excludeGroups = array();
	        if( isset($post['excludeGroups']) ){
	        	foreach($post['excludeGroups'] as $value){
	        		$excludeGroups[$value] = $value;
	        	}
	        }
	        unset($post['excludeGroups']);
	        $post['exclude_customer_groups'] = serialize($excludeGroups);
	        $post['user_id'] = $user['id'];
	        $post['status']  = $this->SmsAutomation_model->isDraft();
	        $post['total_cost']     = 0;
            $post['price_per_sms']  = 0;
	        $post['sms_text'] = '';
	        $post['is_paid']  = 0;
	        $post['created']  = date("Y-m-d H:i:s");

	        $sms_automation_id = $this->SmsAutomation_model->create($post);
	        if( $sms_automation_id > 0 ){
	        	$is_success = true;
	        	$this->session->set_userdata('smsAutomationId', $sms_automation_id);
	        }else{
	        	$msg = 'Cannot save data';
	        }
        }
	        

        $json_data = [
        	'is_success' => $is_success,
        	'err_msg' => $msg
        ];
        echo json_encode($json_data);
    }

    public function build_sms(){
    	$user = $this->session->userdata('logged');
        $cid  = logged('company_id');
        $sms_automation_id = $this->session->userdata('smsAutomationId');
        $smsAutomation = $this->SmsAutomation_model->getById($sms_automation_id);

        $company = $this->Clients_model->getById($cid);

        $this->page_data['company'] = $company;
        $this->page_data['smsAutomation'] = $smsAutomation;
        $this->load->view('sms_automation/build_sms', $this->page_data);
    }

    public function create_sms_message(){
    	$is_success = false;
    	$msg = '';


        $post = $this->input->post(); 
        $sms_automation_id = $this->session->userdata('smsAutomationId');

        $data = ['sms_text' => $post['sms_text']];
        $smsAutomation = $this->SmsAutomation_model->updateSmsAutomation($sms_automation_id,$data);
        $is_success = true;

        $json_data = [
                'is_success' => $is_success,
                'err_msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function preview_sms_message(){
        $sms_automation_id = $this->session->userdata('smsAutomationId');

        $smsAutomation = $this->SmsAutomation_model->getById($sms_automation_id);
        $sms_text = $smsAutomation->sms_text;

        $price_per_sms = $this->SmsAutomation_model->getPricePerSms();
        $total_sms_price = $price_per_sms;
        $grand_total     = $total_sms_price;

        $this->page_data['smsAutomation'] = $smsAutomation;
        $this->page_data['grand_total'] = $grand_total;
        $this->page_data['total_sms_price'] = $total_sms_price;
        $this->page_data['price_per_sms'] = $price_per_sms;
        $this->page_data['sms_text'] = $sms_text;
        $this->load->view('sms_automation/preview_sms', $this->page_data);
    }

    public function payment(){
        $this->load->model('CardsFile_model');

        $company_id = logged('company_id');
    	$sms_automation_id = $this->session->userdata('smsAutomationId');

        $smsAutomation = $this->SmsAutomation_model->getById($sms_automation_id);
        $primaryCard   = $this->CardsFile_model->getCompanyPrimaryCard($company_id);

        $this->page_data['primaryCard'] = $primaryCard;
        $this->page_data['smsAutomation'] = $smsAutomation;
        $this->load->view('sms_automation/payment', $this->page_data);
    }

    public function activate_automation(){
    	$is_success = false;
    	$msg = '';

    	$sms_automation_id = $this->session->userdata('smsAutomationId');

    	$smsAutomation = $this->SmsAutomation_model->getById($sms_automation_id);
    	if( $smsAutomation ){
    		$price_per_sms = $this->SmsAutomation_model->getPricePerSms();

    		$data = ['status' => $this->SmsAutomation_model->isActive(), 'price_per_sms' => $price_per_sms, 'total_cost' => 0, 'is_paid' => 1];
	        $smsAutomation = $this->SmsAutomation_model->updateSmsAutomation($sms_automation_id,$data);

	        $is_success = true;
	        $msg = 'Sms automation was successfully updated.';
    	}else{
    		$msg = 'Cannot find data';
    	}

    	$json_data = ['is_success' => $is_success, 'msg' => $msg];
    	echo json_encode($json_data);
    	
    }

    public function edit_sms_automation($id){
        $company_id = logged('company_id');
        $smsAutomation = $this->SmsAutomation_model->getById($id);
        $this->session->unset_userdata('smsAutomationId');
        if( $smsAutomation ){
            if( $smsAutomation->company_id == $company_id ){
                $customer_groups = unserialize($smsAutomation->exclude_customer_groups);
                
                $this->session->set_userdata('smsAutomationId', $smsAutomation->id);
                $this->page_data['smsAutomation'] = $smsAutomation;
                $this->page_data['selectedGroups'] = $customer_groups;
		        $this->page_data['customerGroups'] = $this->CustomerGroup_model->getAllByCompany($company_id);
		        $this->page_data['optionRuleNotify'] = $this->SmsAutomation_model->optionRuleNotify();
		        $this->page_data['optionRuleNotifyAt'] = $this->SmsAutomation_model->optionRuleNotifyAt();
		        $this->page_data['optionCustomerTypeService'] = $this->SmsAutomation_model->optionCustomerTypeService();
                $this->load->view('sms_automation/edit_sms_automation', $this->page_data);
            }else{
                $this->session->set_flashdata('message', 'Record not found.');
                $this->session->set_flashdata('alert_class', 'alert-danger');
                redirect('credit_notes');
            }
        }else{
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('sms_automation');
        }
    }

    public function ajax_delete_automation(){
        $company_id = logged('company_id');
        $is_success = 0;
        $msg    = '';

        $post = $this->input->post(); 
        $smsAutomation = $this->SmsAutomation_model->getById($post['automationid']);
        if( $smsAutomation ){
            if( $smsAutomation->company_id == $company_id  ){
                $this->SmsAutomation_model->deleteSmsAutomation($smsAutomation->id);
                $is_success = 1;
                $msg = 'Record deleted';
            }else{
                $msg = 'Cannot find record';    
            }
        }else{
            $msg = 'Cannot find record';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function view_automation($id){
        $this->load->model('MarketingOrderPayments_model');
        
        $smsAutomation = $this->SmsAutomation_model->getById($id);
        $statusOptions = $this->SmsAutomation_model->optionStatus();
        $customerTypeOptions = $this->SmsAutomation_model->optionCustomerTypeService();
        $ruleNotifyAtOptions = $this->SmsAutomation_model->optionRuleNotifyAt();
        $ruleNotifyOptions   = $this->SmsAutomation_model->optionRuleNotify();  

        $this->page_data['statusOptions'] = $statusOptions;
        $this->page_data['smsAutomation']   = $smsAutomation;
        $this->page_data['ruleNotifyAtOptions'] = $ruleNotifyAtOptions;
        $this->page_data['ruleNotifyOptions']   = $ruleNotifyOptions;
        $this->page_data['customerTypeOptions'] = $customerTypeOptions;
        $this->load->view('sms_automation/view_automation', $this->page_data);    
    }

    public function view_logs($id){
        $this->load->model('SmsLogs_model');
        
        $smsAutomation = $this->SmsAutomation_model->getById($id);
        $smsLogs       = $this->SmsLogs_model->getAllAutomationBySmsId($smsAutomation->id);

        $this->page_data['smsAutomation'] = $smsAutomation;
        $this->page_data['smsLogs'] = $smsLogs;
        $this->load->view('sms_automation/view_logs', $this->page_data);    
    }
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */