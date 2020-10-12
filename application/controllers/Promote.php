<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promote extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'Create Deal';
		$this->page_data['page']->menu = false;

		add_css(array(
            'assets/css/accounting/sales.css',
        ));
	}

	public function deals()
	{
		$this->page_data['activeTab'] = 'sdf';
		$this->load->view('promote/deals', $this->page_data);
	}

}

/* End of file Promote.php */
/* Location: ./application/controllers/Promote.php */