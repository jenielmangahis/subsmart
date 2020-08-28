<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $page_data;

	/**
	  * Extends by most of controllers not all controllers
	  */

	public function __construct()
	{

		parent::__construct();

		if( !empty($this->db->username) && !empty($this->db->hostname) && !empty($this->db->database) ){ }else{
			$this->users_model->logout();
			die('Database is not configured');
		}
		
		date_default_timezone_set( setting('timezone') );

		/* if(!is_logged()){
			redirect('login','refresh');
		} */

		$this->page_data['url'] = (object) [
			'assets' => assets_url()
		];

		$this->page_data['app'] = (object) [
			'site_title' => setting('company_name')
		];

		$this->page_data['page'] = (object) [
			'title' => 'Dashboard',
			'menu' => 'dashboard',
			'submenu' => '',
		];

		$company_id =  logged('company_id');
		if(!empty($company_id)){
			$company = getCompanyFolder();
		}
	}


	protected function checkLogin() {

		$user_id =  logged('id');

		/*if ( empty($user_id) ) {

			redirect('login');

			exit();
		}*/
	}
}

/* End of file My_Controller.php */
/* Location: ./application/core/My_Controller.php */