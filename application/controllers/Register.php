<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart - Registration';
	}
	public function index(){
		$this->load->view('registration', $this->page_data);
	}
}
