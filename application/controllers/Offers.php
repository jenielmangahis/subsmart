<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Offers extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();

		$this->page_data['page']->title = 'Email Automation';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	

		$this->load->view('offers/index', $this->page_data);

	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */