<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Voicemail_Campaigns extends MY_Controller {



	public function __construct()
	{
		parent::__construct();

		$this->page_data['page']->title = 'Voicemail Blast';

		$this->page_data['page']->menu = '';	

	}

	public function index()
	{	

		$this->load->view('voicemail_campaigns/index', $this->page_data);

	}
}



/* End of file Comapny.php */

/* Location: ./application/controllers/Users.php */