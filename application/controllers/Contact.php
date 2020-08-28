<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin(1);
		$this->page_data['page']->title = 'nSmart - Contact';
	}
	public function index(){
		$this->load->view('contact', $this->page_data);
	}
}
