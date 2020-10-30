<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nsmart_AdminMgt extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$role_id = 1; //this is for nsmart admin user
		$this->isCheckLoginAndRole($role_id);

		$this->page_data['page_title'] = 'Nsmart Admin Management';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

        $this->load->model('Clients_model');
        $this->load->model('Users_model');	
	}

	public function subscribers() {

		$subscriptions   = $this->Clients_model->getAll();

		$this->page_data['subscriptions'] = $subscriptions;
		$this->load->view('admin_management/subscribers', $this->page_data);
	}

}

/* End of file Nsmart_AdminMgt.php */
/* Location: ./application/controllers/Nsmart_AdminMgt.php */
