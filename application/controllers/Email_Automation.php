<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_Automation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();

        $this->load->model('MarketingEmailAutomation_model');
        $this->load->model('MarketingEmailAutomationTemplate_model');

		$this->page_data['page']->title = 'Email Automation';
		$this->page_data['page']->menu = '';	
	}

	public function index()
	{	
		$email_automation_list = $this->MarketingEmailAutomation_model->getAll();

		$this->page_data['email_automation_list'] = $email_automation_list;
		$this->load->view('email_automation/index', $this->page_data);
	}

	public function templates() 
	{
		$email_automation_templates_list = $this->MarketingEmailAutomationTemplate_model->getAll();

		$this->page_data['email_automation_templates_list'] = $email_automation_templates_list;
		$this->load->view('email_automation/templates', $this->page_data);
	}

    public function save_template()
    {
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ){
        	$this->load->model('MarketingEmailAutomationTemplate_model');

        	$data = array(
        		'user_id' => $user['id'],
        		'name' => post('name'),
        		'email_subject' => post('email_subject'),
        		'email_body' => post('email_body'),
        		'is_active' => 1,
        		'date_created' => date("Y-m-d H:i:s")
        	);
        	$bookingServiceItem = $this->MarketingEmailAutomationTemplate_model->create($data);

        	$this->session->set_flashdata('message', 'Add New Template Successful');
        	$this->session->set_flashdata('alert_class', 'alert-success');
        }

        redirect('email_automation/templates');
    }	

    public function ajax_edit_template()
    {
    	$id = post('tid');
    	$template = $this->MarketingEmailAutomationTemplate_model->getById($id);

    	$this->page_data['template'] = $template;
    	$this->page_data['template_id'] = $id;
		$this->load->view('email_automation/ajax_edit_template', $this->page_data);
    }    

    public function update_template()
    {
    	postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ) {
        	$template_id = $post['template_id'];
        	$template = $this->MarketingEmailAutomationTemplate_model->getById($template_id);

    		$to_update = array(
            	'name' => post('name'),
                'email_subject' => post('email_subject'),
                'email_body' => post('email_body'),
                'date_modified' => date("Y-m-d H:i:s")
            );

        	if($template) {
	            $this->MarketingEmailAutomationTemplate_model->update($template->id, $to_update);

	            $this->session->set_flashdata('message', 'Template was successfully updated');
	            $this->session->set_flashdata('alert_class', 'alert-success');
        	} else {
	            $this->session->set_flashdata('message', 'Template not found');
	            $this->session->set_flashdata('alert_class', 'alert-danger');
        	}
        } else {
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('email_automation/templates');
    }    

    public function delete_template()
    {
    	$id = $this->MarketingEmailAutomationTemplate_model->delete(post('tid'));

		$this->activity_model->add("Email Automation Template #$id Deleted by User:".logged('name'));

		$this->session->set_flashdata('message', 'Template has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('email_automation/templates');
    }  

}



/* End of file Email_Automation.php */

/* Location: ./application/controllers/Email_Automation.php */