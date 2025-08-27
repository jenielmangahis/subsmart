<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MYF_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->checkLogin(1);
		$this->page_data['page']->title = 'nSmart - Contact';
		$this->load->library('user_agent');
		$this->load->model('Business_model');
	}

	public function index(){		
		/*$user_agent = $this->agent->agent_string();
        $ip_address = $this->input->ip_address();
        $this->Business_model->customerDeviceLookup("business_contact_visit", $ip_address, $user_agent);*/
		$this->load->view('contact', $this->page_data);
	}

	public function support(){		
		$this->load->view('support', $this->page_data);
	}

	public function ajax_support_send_email(){
		$is_success = 0;
		$msg = 'Cannot send email';
		
		$post    = $this->input->post();

		if( !$post['contact_chk'] ){
			$subject = 'nSmartTrac : Inquiry';
	        //$to   = 'bryannrevina@nsmartrac.com';
	        $to   = 'websupport@nsmartrac.com';    
	        //$cc   = 'jpabanil@icloud.com';

			$body = $this->load->view('v2/emails/contact_us', $post, true);
			$mail = email__getInstance();
			$mail->FromName = 'nSmarTrac';
			$mail->addAddress($to, $to);
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->Send();  

			$is_success = 1;
			$msg = '';
		}

        $json = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json);
	}
}
