<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends MY_Controller {

	// public function __construct()
 //    {
 //        parent::__construct();
 //        $this->checkLogin();
 //    }

	/*public function index()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/business_tools', $this->page_data);
	}*/

	public function api_connectors()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/api_connectors', $this->page_data);
	}

	public function business_tools()
	{
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('tools/business_tools', $this->page_data);
	}
}