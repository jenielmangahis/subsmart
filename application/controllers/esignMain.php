<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class esignMain extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

	public function index()
	{
		$is_allowed = $this->isAllowedModuleAccess(49);
        if( !$is_allowed ){
            $this->page_data['module'] = 'eSign_main';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('esignMain/esignMain', $this->page_data);
	}

	public function blank() {
		$get = $this->input->get();
		$this->page_data['page_name'] = $get['page'];
		$this->load->view('blank', $this->page_data);
	}
}