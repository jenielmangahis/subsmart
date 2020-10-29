<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'nSmart';
	}

	public function workorder(){
		$this->load->view('pages/workorder', $this->page_data);
	}

	public function view($title){
		$this->page_data['pname'] = $title;
		$this->load->view('pages/view', $this->page_data);
	}

	public function no_access(){
		$this->load->view('pages/no_access', $this->page_data);
	}
}