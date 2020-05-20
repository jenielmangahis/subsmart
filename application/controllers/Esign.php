<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esign extends MY_Controller {

	public function index()
	{
		$this->load->view('esign/esign', $this->page_data);
	}


    public function blank() {

	    $get = $this->input->get();
        $this->page_data['page_name'] = $get['page'];
        $this->load->view('blank', $this->page_data);
    }

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */