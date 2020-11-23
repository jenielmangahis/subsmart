<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onboarding extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		//$this->checkLogin();
		$role_id = 1; //this is for nsmart admin user
		$this->isCheckLoginAndRole($role_id);

		$this->page_data['page_title'] = 'Onboarding';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');
	}

	public function index() {
		
		$this->load->view('onboarding/index', $this->page_data);
	}
}

/* End of file Onboarding.php */
/* Location: ./application/controllers/Onboarding.php */
