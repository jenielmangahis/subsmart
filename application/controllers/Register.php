<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->page_data['page']->title = 'nSmart - Registration';
	}
	public function index(){
		$this->load->model('NsmartPlan_model');

		$ns_plans = $this->NsmartPlan_model->getAll();

		$this->page_data['ns_plans'] = $ns_plans;
		$this->page_data['business'] = getIndustryBusiness();
		$this->page_data['roles']    = getRegistrationRoles();
		$this->load->view('registration', $this->page_data);
	}
}
