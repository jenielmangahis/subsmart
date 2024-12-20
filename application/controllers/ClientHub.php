<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientHub extends MYF_Controller {
	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart - Customer Portal';
	}
	public function index(){
		$this->load->view('v2/pages/customer/client_hub/index', $this->page_data);
	}
}
