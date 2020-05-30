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
		$this->load->view('esignMain/esignMain', $this->page_data);
	}

    public function blank() {
	    $get = $this->input->get();
        $this->page_data['page_name'] = $get['page'];
        $this->load->view('blank', $this->page_data);
    }
}