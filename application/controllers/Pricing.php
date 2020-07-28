<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'nSmart - Pricing';
	}
	public function index(){
		$this->load->view('pricing', $this->page_data);
	}
}
