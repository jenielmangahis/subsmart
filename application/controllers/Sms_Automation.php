<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Sms_Automation extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		
		$this->page_data['page']->title = 'SMS Automation';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	

		$this->load->view('sms_automation/index', $this->page_data);

	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */