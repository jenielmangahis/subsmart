<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Find_Pro extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'nSmart - Front End Find Pro';
	}
	public function index(){
		$this->load->view('find_pro', $this->page_data);
	}
}
