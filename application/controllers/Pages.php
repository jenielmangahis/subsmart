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
		echo "<pre>";
		print_r($this->input->post());
		exit;

		$config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'xxx@gmail.com', // change it to yours
		  'smtp_pass' => 'xxx', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);

		$message = '';
        $this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('xxx@gmail.com');
		$this->email->to('xxx@gmail.com');
		$this->email->subject('nSmartTrac : Find Pros');
		$this->email->message($message);
		if($this->email->send()){
			$response['is_success'] = 1;
		}else{
			$response['is_success'] = 0;
		}

		header('Content-Type: application/json');
		echo json_encode($response);
	}
}
