<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_Automation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();

        $this->load->model('MarketingEmailAutomation_model');
        $this->load->model('MarketingEmailAutomationTemplate_model');
        $this->load->model('CustomerGroup_model');

		$this->page_data['page']->title = 'Email Automation';
		$this->page_data['page']->menu = '';	
	}

	public function index(){	
		$email_automation_list = $this->MarketingEmailAutomation_model->getAll();
        $email_automation_templates_list = $this->MarketingEmailAutomationTemplate_model->getAll();

        $this->page_data['email_automation_templates_list'] = $email_automation_templates_list;
		$this->page_data['email_automation_list'] = $email_automation_list;
		$this->load->view('email_automation/index', $this->page_data);
	}

    public function add_email_automation(){
        $cid  = logged('company_id');

        $optionRuleEvent = $this->MarketingEmailAutomation_model->optionsRuleEvent();
        $optionCustomerType = $this->MarketingEmailAutomation_model->optionCustomerType();
        $optionRuleNotifyAt = $this->MarketingEmailAutomation_model->optionRuleNotifyAt();
        $optionCustomerGroup = $this->CustomerGroup_model->getAllByCompany($cid);
        $emailAutomationTemplates = $this->MarketingEmailAutomationTemplate_model->getAllByCompanyId($cid);

        $this->page_data['selectedGroups'] = array();
        $this->page_data['customerGroups']  = $optionCustomerGroup;
        $this->page_data['optionRuleEvent'] = $optionRuleEvent;
        $this->page_data['optionCustomerType'] = $optionCustomerType;
        $this->page_data['optionRuleNotifyAt'] = $optionRuleNotifyAt;
        $this->page_data['emailAutomationTemplates'] = $emailAutomationTemplates;
        $this->load->view('email_automation/add_email_automation', $this->page_data);
    }

    public function ajax_get_template_message(){
        $post = $this->input->post();
        $emailTemplate = $this->MarketingEmailAutomationTemplate_model->getById($post['tid']);
        if( $emailTemplate ){
            $message = $emailTemplate->email_body;
        }else{
            $message = '';
        }
        $json_data = [
            'message' => $message
        ];

        echo json_encode($json_data);
    }

	public function templates(){

        $cid  = logged('company_id');
		$emailAutomationTemplates = $this->MarketingEmailAutomationTemplate_model->getAllByCompanyId($cid);

		$this->page_data['emailAutomationTemplates'] = $emailAutomationTemplates;
		$this->load->view('email_automation/templates', $this->page_data);
	}

    public function add_template(){
        $this->load->view('email_automation/add_template', $this->page_data);
    }

    public function edit_template($id){
        $cid  = logged('company_id');
        $emailTemplate = $this->MarketingEmailAutomationTemplate_model->getById($id);
        if( $emailTemplate->company_id == $cid ){

            $this->page_data['emailTemplate'] = $emailTemplate;
            $this->load->view('email_automation/edit_template', $this->page_data);
        }else{
            $this->session->set_flashdata('message', 'Record not found');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('email_automation/templates');
        }
    }

    public function save_template(){
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ){
        	$data = array(
        		'user_id' => $user['id'],
        		'name' => post('name'),
        		'email_subject' => post('email_subject'),
        		'email_body' => post('email_body'),
        		'is_active' => $this->MarketingEmailAutomationTemplate_model->isActive(),
        		'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
        	);
        	$bookingServiceItem = $this->MarketingEmailAutomationTemplate_model->create($data);

        	$this->session->set_flashdata('message', 'Add New Template Successful');
        	$this->session->set_flashdata('alert_class', 'alert-success');
        }

        redirect('email_automation/templates');
    }

    public function update_template(){

        $user = $this->session->userdata('logged');
        $cid  = logged('company_id');
        $post = $this->input->post();

        if( !empty($post) ){

            $emailTemplate = $this->MarketingEmailAutomationTemplate_model->getById($post['tid']);
            if( $emailTemplate->company_id == $cid ){
                $data = array(
                    'name' => post('name'),
                    'email_subject' => post('email_subject'),
                    'email_body' => post('email_body'),
                    'date_modified' => date("Y-m-d H:i:s")
                );
                $bookingServiceItem = $this->MarketingEmailAutomationTemplate_model->update($emailTemplate->id, $data);

                $this->session->set_flashdata('message', 'Email Template was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            }else{
                $this->session->set_flashdata('message', 'Record not found');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }
        }else{
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('email_automation/templates');
    }	

    public function delete_template(){
        $cid  = logged('company_id');
        $post = $this->input->post();
        $template = $this->MarketingEmailAutomationTemplate_model->getById(post('tid'));
        if($template->company_id == $cid){
            $id = $this->MarketingEmailAutomationTemplate_model->deleteById(post('tid'));
            $this->session->set_flashdata('message', 'Email Automation Template has been Deleted Successfully');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }else{
            $this->session->set_flashdata('message', 'Record not found');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        

        redirect('email_automation/templates');
    }

    public function save_email_automation(){
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ){
            $this->load->model('MarketingEmailAutomation_model');

            $data = array(
                'user_id' => $user['id'],
                'rule_event' => post('rule_event'),
                'rule_notify_at' => post('rule_notify_at'),
                'rule_notify_op' => post('rule_notify_op'),
                'name' => post('name'),
                'email_subject' => post('email_subject'),
                'email_body' => post('email_body'),
                'exclude_customer_group' => post('exclude_customer_group'),
                'customer_type_service' => post('business_customer_type_service'),
                'email_automation_template_id' => post('template_id'),
                'is_active' => 1,
                'date_created' => date("Y-m-d H:i:s")
            );
            $bookingServiceItem = $this->MarketingEmailAutomation_model->create($data);

            $this->session->set_flashdata('message', 'Add Email Automation Successful');
            $this->session->set_flashdata('alert_class', 'alert-success');
        }

        redirect('email_automation');
    }    

    public function edit_automation($id){
        $company_id  = logged('company_id');
        $emailAutomation = $this->MarketingEmailAutomation_model->getById($id);
        if( $emailAutomation ){            
            if( $emailAutomation->company_id == $company_id  ){                
                $optionRuleEvent = $this->MarketingEmailAutomation_model->optionsRuleEvent();
                $optionCustomerType = $this->MarketingEmailAutomation_model->optionCustomerType();
                $optionRuleNotifyAt = $this->MarketingEmailAutomation_model->optionRuleNotifyAt();
                $optionCustomerGroup = $this->CustomerGroup_model->getAllByCompany($cid);
                $emailAutomationTemplates = $this->MarketingEmailAutomationTemplate_model->getAllByCompanyId($cid);

                $this->page_data['emailAutomation'] = $emailAutomation;
                $this->page_data['selectedGroups'] = array();
                $this->page_data['customerGroups']  = $optionCustomerGroup;
                $this->page_data['optionRuleEvent'] = $optionRuleEvent;
                $this->page_data['optionCustomerType'] = $optionCustomerType;
                $this->page_data['optionRuleNotifyAt'] = $optionRuleNotifyAt;
                $this->page_data['emailAutomationTemplates'] = $emailAutomationTemplates;
                $this->load->view('email_automation/edit_email_automation', $this->page_data);
            }else{
                $this->session->set_flashdata('message', 'Email Automation not found');
                $this->session->set_flashdata('alert_class', 'alert-danger');
                redirect('email_automation');
            }
        }else{
            $this->session->set_flashdata('message', 'Email Automation not found');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('email_automation');
        }
    }

    public function ajax_update_email_automation(){
        $is_success = false;
        $msg = 'Cannot save data. Please check your entries.';

        $post = $this->input->post();

        if( !empty($post) ) {
            $emailAutomation = $this->MarketingEmailAutomation_model->getById($post['automationid']);
            if( $emailAutomation ){
                $exclude_customer_group = array();
                if( isset($post['exclude_customer_group']) ){
                    foreach($post['exclude_customer_group'] as $value){
                        $exclude_customer_group[] = $value;
                    }
                }
                $data = array(
                    'rule_event' => $post['rule_event'],
                    'rule_notify_at' => $post['rule_notify_at'],
                    'rule_notify_op' => $post['rule_notify_op'],
                    'name' => $post['automation_name'],
                    'email_subject' => $post['email_subject'],
                    'email_body' => $post['email_body'],
                    'exclude_customer_group' => serialize($exclude_customer_group),
                    'customer_type_service' => $post['business_customer_type_service'],
                    'date_modified' => date("Y-m-d H:i:s")
                );

                $this->MarketingEmailAutomation_model->update($emailAutomation->id, $to_update);

                $is_success = true;
                $msg = 'Add Email Automation Successful';
            }else{
                $msg = 'Cannot find record';
            }
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
    } 

    public function ajax_edit_template(){
    	$id = post('tid');
    	$template = $this->MarketingEmailAutomationTemplate_model->getById($id);

    	$this->page_data['template'] = $template;
    	$this->page_data['template_id'] = $id;
		$this->load->view('email_automation/ajax_edit_template', $this->page_data);
    } 

    public function ajax_edit_email_template(){
        $id = post('tid');

        $email_automation = $this->MarketingEmailAutomation_model->getById($id);

        $email_automation_templates_list = $this->MarketingEmailAutomationTemplate_model->getAll();

        $this->page_data['email_automation_templates_list'] = $email_automation_templates_list;        
        $this->page_data['email_automation'] = $email_automation;
        $this->page_data['template_automation_id'] = $id;
        $this->load->view('email_automation/ajax_edit_email_automation', $this->page_data);        
    } 

    public function ajax_set_default_template(){
        $id = post('tid');
        $email_automation = $this->MarketingEmailAutomationTemplate_model->getById($id);

        $this->page_data['email_automation'] = $email_automation;
        $this->load->view('email_automation/ajax_set_default_template', $this->page_data); 
    }    

    public function ajax_set_default_template_edit(){
        $id = post('tid');
        $email_automation = $this->MarketingEmailAutomationTemplate_model->getById($id);

        $this->page_data['email_automation'] = $email_automation;
        $this->load->view('email_automation/ajax_set_default_template_edit', $this->page_data); 
    } 

    public function ajax_set_place_holder(){
        $post = $this->input->post();

        $this->page_data['post_data'] = $post;
        $this->load->view('email_automation/ajax_set_place_holder', $this->page_data); 
    }  

    public function ajax_set_place_holder_edit(){
        $post = $this->input->post();

        $this->page_data['post_data'] = $post;
        $this->load->view('email_automation/ajax_set_place_holder_edit', $this->page_data); 
    }

    public function update_email_automation(){
        postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ) {
            $email_auth_id = $post['template_automation_id'];
            $template = $this->MarketingEmailAutomation_model->getById($email_auth_id);

            $to_update = array(
                'name' => post('name'),
                'rule_event' => post('rule_event'),
                'rule_notify_at' => post('rule_notify_at'),
                'rule_notify_op' => post('rule_notify_op'),
                'name' => post('name'),
                'customer_type_service' => post('business_customer_type_service'),
                'exclude_customer_group' => post('exclude_customer_group'),
                'email_subject' => post('email_subject'),
                'email_body' => post('email_body'),
                'date_modified' => date("Y-m-d H:i:s")
            );

            if($template) {
                $this->MarketingEmailAutomation_model->update($template->id, $to_update);

                $this->session->set_flashdata('message', 'Email automation was successfully updated');
                $this->session->set_flashdata('alert_class', 'alert-success');
            } else {
                $this->session->set_flashdata('message', 'Email Automation not found');
                $this->session->set_flashdata('alert_class', 'alert-danger');
            }
        } else {
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('email_automation');
    }    

    public function ajax_save_visible_status(){
        postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ) {
            $id = $post['email_automation_id'];
            $is_active = $post['is_active'];
            $siid = $this->MarketingEmailAutomation_model->getById($id);

            $to_update = array(
                'is_active' => $is_active
            );

            if($siid) {
                $this->MarketingEmailAutomation_model->update($siid->id, $to_update);
                $is_success = true;
            } else {
                $is_success = false;
            }
        }

        $json_data = array('is_success' => $is_success);

        echo json_encode($json_data);
    }   

    public function delete_email_automation(){
        $post = $this->input->post();

        $id = $this->MarketingEmailAutomation_model->delete(post('ea_id'));

        $this->activity_model->add("Email Automation #$id Deleted by User:".logged('name'));

        $this->session->set_flashdata('message', 'Template has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('email_automation');
    }  

    public function ajax_create_email_automation(){
        $is_success = false;
        $msg = '';

        $post = $this->input->post();
        if( !empty($post) ){
            $user = $this->session->userdata('logged');
            $exclude_customer_group = array();
            if( isset($post['exclude_customer_group']) ){
                foreach($post['exclude_customer_group'] as $value){
                    $exclude_customer_group[] = $value;
                }
            }
            $data = array(
                'user_id' => $user['id'],
                'rule_event' => $post['rule_event'],
                'rule_notify_at' => $post['rule_notify_at'],
                'rule_notify_op' => $post['rule_notify_op'],
                'name' => $post['automation_name'],
                'email_subject' => $post['email_subject'],
                'email_body' => $post['email_body'],
                'exclude_customer_group' => serialize($exclude_customer_group),
                'customer_type_service' => $post['business_customer_type_service'],
                'is_active' => $this->MarketingEmailAutomation_model->isActive(),
                'date_created' => date("Y-m-d H:i:s"),
                'date_modified' => date("Y-m-d H:i:s")
            );
            
            $bookingServiceItem = $this->MarketingEmailAutomation_model->create($data);
            $this->session->set_flashdata('message', 'Email Automation was successfully saved.');
            $this->session->set_flashdata('alert_class', 'alert-success');

            $is_success = true;
            $msg = 'Add Email Automation Successful';
        }

        $json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ]; 

        echo json_encode($json_data);
    }

    public function generate_preview(){
        $this->load->model('Clients_model');

        $post = $this->input->post(); 
        $cid  = logged('company_id');

        $subject = $post['email_subject'];
        $message = $post['email_body'];
        $company = $this->Clients_model->getById($cid);

        $this->page_data['message'] = replaceSmartTags($message);
        $this->page_data['subject'] = $subject;
        $this->page_data['company'] = $company;
        $this->load->view('email_automation/preview_email', $this->page_data);
    }

    public function ajax_load_automation_list(){
        $company_id = logged('company_id');
        
        $emailAutomation = $this->MarketingEmailAutomation_model->getAllByCompanyId($company_id);
        $optionRuleEvent = $this->MarketingEmailAutomation_model->optionsRuleEvent();
        $optionRuleNotifyAt = $this->MarketingEmailAutomation_model->optionRuleNotifyAt();
        $optionIsActive = $this->MarketingEmailAutomation_model->optionsIsActive();

        $this->page_data['optionRuleNotifyAt'] = $optionRuleNotifyAt;
        $this->page_data['optionRuleEvent']    = $optionRuleEvent;
        $this->page_data['optionIsActive']     = $optoptionIsActiveionStatus;
        $this->page_data['emailAutomation']    = $emailAutomation;
        $this->load->view('email_automation/ajax_load_automation_list', $this->page_data);
    }

    public function ajax_update_automation_is_active(){
        $post = $this->input->post(); 
        
        $company_id = logged('company_id');
        $automation = $this->MarketingEmailAutomation_model->getById($post['automation_id']);
        if( $automation ){
            if( $company_id == $automation->company_id ){
                $data = array(
                    'is_active' => $post['is_active'],
                    'date_modified' => date("Y-m-d H:i:s")
                );
                $emailAutomation = $this->MarketingEmailAutomation_model->update($automation->id, $data);
            }
        } 
    }

    public function ajax_delete_automation(){
        $company_id = logged('company_id');
        $is_success = 0;
        $msg    = '';

        $post = $this->input->post(); 
        $emailAutomation = $this->MarketingEmailAutomation_model->getById($post['automationid']);
        if( $emailAutomation ){
            if( $emailAutomation->company_id == $company_id  ){
                $this->MarketingEmailAutomation_model->deleteEmailAutomationById($emailAutomation->id);
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
}



/* End of file Email_Automation.php */

/* Location: ./application/controllers/Email_Automation.php */