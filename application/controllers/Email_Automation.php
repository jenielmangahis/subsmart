<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_Automation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();

		$this->page_data['page']->title = 'Email Automation';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	
		/*
		 * Table Structure : marketing_email_automation
		 *  - id : (primary)
		 *  - rule_event : (varchar - 255) (es. estimate_followup, invoice_paid etc.)
		 *  - rule_notify_at : (varchar - 255) (es. N1D, N2D etc.)
		 *  - rule_notify_op : (tinyint) (es. 0=after event, 1=before event)
		 *  - name : (varchar - 255)
		 *  - customer_type_service : (tinyint) (value 0=Residential and Commercial 1=Residential Customer 2=Commercial Customer)
		 *  - email_automation_template_id : (int) (from table marketing_email_automation_template) 
		 *  - is_active : (tinyint) (0=inactive,1=active)
		 *  - date_created
		 *  - date_modified
		 *
		 * Table Structure : marketing_email_automation_template
		 *  - id : (primary)
		 *  - name
		 *  - email_subject
		 *  - email_body	 
		 *  - date_created	 
		 *  - date_modified
		 *	 
		*/

		$this->load->view('email_automation/index', $this->page_data);

	}
}



/* End of file Email_Automation.php */

/* Location: ./application/controllers/Email_Automation.php */