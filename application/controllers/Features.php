<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Features extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin(1);
		$this->page_data['page']->title = 'nSmart - Front End Features';
	}
	public function index(){
		$this->load->view('features', $this->page_data);
	}
}
