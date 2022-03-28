<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class My_Inquires extends MY_Controller {



	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'My Inquiries';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	
        $this->page_data['page']->title = 'My Inquiry List';
        $this->page_data['page']->parent = 'Marketing';

		$this->load->view('v2/pages/my_inquires/index', $this->page_data);

	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */