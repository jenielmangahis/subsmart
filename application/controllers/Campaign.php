<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Campaign extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'Campaign 360';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	
        $this->page_data['page']->title = 'Campaign 360';
        $this->page_data['page']->parent = 'Marketing';

		$this->load->view('v2/pages/campaign/index', $this->page_data);

	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */