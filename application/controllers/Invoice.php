<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

	public function index()
	{
		$this->load->view('invoice', $this->page_data);
	}
}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */