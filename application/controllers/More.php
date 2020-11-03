<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class More extends MY_Controller {



	public function __construct()
	{

		parent::__construct();
		$this->checkLogin();
		$this->page_data['page']->title = 'More ';
		$this->page_data['page']->menu = 'more';
		$this->load->model('NsmartUpgrades_model');
	}


	public function upgrades(){	
		
		$user = (object)$this->session->userdata('logged');
		$cid=logged('company_id');

		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		/*$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata[0];*/
		
		$this->load->view('more/upgrades', $this->page_data);
	}

	public function addons(){	
		
		$user = (object)$this->session->userdata('logged');
		$cid=logged('company_id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		
		/*$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata[0];*/
		
		$this->load->view('more/addons', $this->page_data);
	}
}



/* End of file More.php */

/* Location: ./application/controllers/More.php */