<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onboarding extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		//$this->checkLogin();
		$role_id = 1; //this is for nsmart admin user
		$this->isCheckLoginAndRole($role_id);

		$this->load->model('IndustryType_model');
        $this->load->model('Users_model');
        $this->load->model('ServiceCategory_model');

		$this->page_data['page_title'] = 'Onboarding';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');
	}

	public function business_info() {
		
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));	
		//dd($profiledata);die;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
		
		$this->load->view('onboarding/business_info', $this->page_data);
	}

	public function industry_type() {
		$industryType = $this->IndustryType_model->getAll();
		$businessTypes = [ 
		  'Building Contractors' => 'Building Contractors',
		  'Financial Services' => 'Financial Services',
		  'Technical Services' => 'Technical Services',
		  'Health And Beauty' => 'Health And Beauty',
		  'Transportation' => 'Transportation',
		  'Organization / Cleaning' => 'Organization / Cleaning',
		  'Entertainment Services' => 'Entertainment Services',
		  'Design Services' => 'Design Services',
		  'Other' => 'Other',
        ];
		//ifPermissions('businessdetail');
		$user = $this->session->userdata('logged');
		$user_id = $user['id'];		
		$userdata = $this->Users_model->getUser($user_id);
		$company_id = $userdata->company_id;
	 	$selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($company_id);
	
		$this->page_data['industryType'] = $industryType;
		$this->page_data['businessTypes'] = $businessTypes;
		$this->page_data['selectedCategories'] = $selectedCategories;
		//print_r($user);die;
		$cid = logged('id');
		
		$this->load->view('onboarding/industry_type', $this->page_data);	
	}
}

/* End of file Onboarding.php */
/* Location: ./application/controllers/Onboarding.php */
