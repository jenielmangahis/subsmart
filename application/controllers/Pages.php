<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		$this->page_data['page']->title = 'nSmart - Terms and Condition';	
		$this->load->view('pages/terms_and_condition', $this->page_data);
	}

	public function terms_and_condition(){
		$this->page_data['page']->title = 'nSmart - Terms and Condition';	
		$this->load->view('pages/terms_and_condition', $this->page_data);
	}
}
