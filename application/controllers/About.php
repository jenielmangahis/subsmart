<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MYF_Controller {
	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart - Front End About Us';
	}
	public function index(){
		$this->load->view('about', $this->page_data);
	}
}
