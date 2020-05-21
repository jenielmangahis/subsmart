<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class More extends MY_Controller {



	public function __construct()
	{

		parent::__construct();
		$this->page_data['page']->title = 'More ';
		$this->page_data['page']->menu = 'more';

	}


	public function upgrades(){	
		
		$user = (object)$this->session->userdata('logged');
		$cid=logged('company_id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		
		/*$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata[0];*/
		
		$this->load->view('more/upgrades', $this->page_data);
	}
}



/* End of file More.php */

/* Location: ./application/controllers/More.php */