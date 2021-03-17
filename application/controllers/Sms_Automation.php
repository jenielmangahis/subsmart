<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sms_Automation extends MY_Controller {



	public function __construct()
	{
		parent::__construct();

        $this->load->model('SmsAutomation_model');
        $this->load->model('Users_model');              
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
        	
        $this->page_data['optionRuleEvent'] = $optionRuleEvent;
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
        $post['total_cost']  = 0;
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
    	$sms_automation_id = $this->session->userdata('smsAutomationId');

        $smsAutomation = $this->SmsAutomation_model->getById($sms_automation_id);

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
	        $total_sms_price = $price_per_sms;
	        $grand_total     = $total_sms_price;

    		$data = ['status' => $this->SmsAutomation_model->isActive(), 'total_cost' => $grand_total, 'is_paid' => 1];
	        $smsAutomation = $this->SmsAutomation_model->updateSmsAutomation($sms_automation_id,$data);

	        $is_success = true;
	        $msg = 'Sms automation was successfully updated.';
    	}else{
    		$msg = 'Cannot find data';
    	}

    	$json_data = ['is_success' => $is_success, 'msg' => $msg];
    	echo json_encode($json_data);
    	
    }
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */