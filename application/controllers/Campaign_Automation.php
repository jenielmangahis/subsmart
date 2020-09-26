<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Campaign_Automation extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();

		$this->page_data['page']->title = 'Campaign Automation';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	

		$this->load->view('campaign_automation/index', $this->page_data);

	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */