<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		$this->page_data['page']->title = 'nSmartTrac - Terms and Condition';	
		$this->load->view('pages/terms_and_condition', $this->page_data);
	}

	public function terms_and_condition(){
		$this->page_data['page']->title = 'nSmartTrac - Terms and Condition';	
		$this->load->view('pages/terms_and_condition', $this->page_data);
	}

	public function privacy_policy(){
		$this->page_data['page']->title = 'nSmartTrac - Privacy Policy';	
		$this->load->view('pages/privacy_policy', $this->page_data);
	}

	public function anti_spam_policy(){
		$this->page_data['page']->title = 'nSmartTrac - Anti Spam Policy';	
		$this->load->view('pages/anti_spam_policy', $this->page_data);
	}

	public function find_pros(){
		$this->page_data['page']->title = 'nSmartTrac - Find Pros';	
		$this->load->view('pages/find_pros', $this->page_data);
	}

	public function find_pros_form(){
		$find_pro = $this->input->get('find_pro');
		
		$this->page_data['business'] = getIndustryBusiness();
		$this->page_data['find_pro'] = $find_pro;
		$this->page_data['page']->title = 'nSmartTrac - Find Pros';	
		$this->load->view('pages/find_pros_form', $this->page_data);
	}

	public function ajax_send_find_pros(){

		if($this->input->post()) {

			$find_pro = $this->input->post('find_pro');
			$location_type = $this->input->post('location_type');
			$location_street = $this->input->post('location_street');
			$location_zip = $this->input->post('location_zip');
			$recurring_cleaning = $this->input->post('recurring_cleaning');
			$name = $this->input->post('name');
			$contact_number = $this->input->post('contact_number');
			$email_address = $this->input->post('email_address');
			$address = $this->input->post('address');
			$brief_description = $this->input->post('brief_description');
			$admin_email       = 'admin@nsmartrac.com';

			$message = '';
			$message .= '<strong>Find Pro: </strong>' . $find_pro . '<br />';
			$message .= '<strong>Location Type: </strong>' . $location_type . '<br />';
			$message .= '<strong>Street: </strong>' . $location_street . '<br />';
			$message .= '<strong>Zip Code: </strong>' . $location_zip . '<br />';
			$message .= '<strong>Zip Code: </strong>' . $recurring_cleaning . '<br />';

			$message .= '<strong>Name: </strong>' . $name . '<br />';
			$message .= '<strong>Contact Number: </strong>' . $contact_number . '<br />';
			$message .= '<strong>Email: </strong>' . $email_address . '<br />';
			$message .= '<strong>Full Address: </strong>' . $address . '<br />';
			$message .= '<strong>Brieft Dscription of Project: </strong>' . $brief_description . '<br />';

			$survey_msg = 'This is a sample survey content';

	        $this->load->library('email');

			$config = array();
			
			/*$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'smtp.mailtrap.io';
			$config['smtp_user'] = 'd7c92e3b5e901d';
			$config['smtp_pass'] = '203aafda110ab7';
			$config['smtp_port'] = 2525;
			$config['mailtype']  = 'html';*/

			$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'mail.nsmartrac.com';
			$config['smtp_user'] = 'admin@nsmartrac.com';
			$config['smtp_pass'] = 'UqzD+td4Yb&S';
			$config['smtp_port'] = 25;
			$config['mailtype']  = 'html';

			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
			$this->email->from('noreply@nsmartrac.com');
			$this->email->to($admin_email);
			$this->email->subject('nSmarTrac : Find Pro');
			$this->email->message($message);
			if($this->email->send()){

				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('noreply@nsmartrac.com');
				$this->email->to($email_address);
				$this->email->subject('nSmarTrac : Survey');
				$this->email->message($survey_msg);
				$this->email->send();

				$response['is_success'] = 1;
			}else{
				$response['is_success'] = 0;
			}

		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}

}
