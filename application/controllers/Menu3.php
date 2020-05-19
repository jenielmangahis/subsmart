<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu3 extends MY_Controller {

	public function index()
	{
		$this->load->view('menu3', $this->page_data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */