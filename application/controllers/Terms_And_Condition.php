<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_And_Condition extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart - Terms and Condition';
	}
	public function index(){
		$this->load->view('terms_and_condition', $this->page_data);
	}
}
