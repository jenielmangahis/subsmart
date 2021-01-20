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

	protected function checkLogin($is_front = '') {
		$user_id =  logged('id');		
		if( $is_front == 1 ){
			return true;
		}else{
			if ( empty($user_id) ) {

				redirect('login');

				exit();
			}
		}
	}

	protected function isCheckLoginAndRole($user_role_id = '') {
		$role_id =  logged('role');
		$user_id =  logged('id');		

		if ( empty($user_id) ) {
			redirect('login');
			exit();
		} else {
			if($role_id != $user_role_id) {
				//redirect('page/no_access');
				//exit();
			}
		}
	}

	protected function isAllowedModuleAccess($module_id = 0){
		$this->load->helper(array('user_helper'));

		$role_id    = logged('role');
		$is_allowed = true;
		if( $role_id != 1 && $role_id != 2 ){
			//$is_allowed = validateUserAccessModule($module_id); //Activate to validate
			$is_allowed = true;

			/*if( !$is_allowed ){
				$this->session->set_flashdata('alert_class', 'danger');
        		$this->session->set_flashdata('message', 'No access to module');

        		redirect('dashboard');
			}*/
		}

		return $is_allowed;
	}
}

/* End of file My_Controller.php */
/* Location: ./application/core/My_Controller.php */