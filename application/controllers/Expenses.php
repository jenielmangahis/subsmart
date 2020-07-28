<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

	public function index()
	{
		$this->page_data['expenses'] = array();
		$this->load->view('expenses', $this->page_data);
	}
}

/* End of file Expenses.php */
/* Location: ./application/controllers/Expenses.php */