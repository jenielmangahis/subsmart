<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiries extends MY_Controller {

	public function index()
	{
		$this->page_data['inquiries'] = array();
		$this->load->view('inquiry/inquiries', $this->page_data);
	}
}

/* End of file Inquiries.php */
/* Location: ./application/controllers/Inquiries.php */