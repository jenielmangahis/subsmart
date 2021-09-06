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
		
		$this->setNewtimezone();

		//date_default_timezone_set( setting('timezone') );

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

		$company_id     = logged('company_id');
		$is_plan_active = isCompanyPlanActive();
		if(!empty($company_id)){
			$company = getCompanyFolder();
		}

		$method     = $this->router->fetch_method();
		$controller = $this->router->fetch_class();		
		$controller = strtolower($controller);
		$company_id = logged('company_id');

		if( $company_id != 1 ){
			/*if( $is_plan_active == 0 && $controller != 'mycrm' && $method != 'membership' ){			
				redirect('mycrm/renew_plan'); 
			}*/
			if( $is_plan_active == 0 && $controller != 'mycrm'){	
				if( $method != 'renew_plan' && $method != 'plan_select' && $method != '_renew_membership_plan' ){
					redirect('mycrm/renew_plan'); 	
				}
			}
		}		
	}

	public function gtMyIpGlobal(){
		return $ipaddress = $this->timesheet_model->gtMyIpGlobal();
	}
	
	public function setNewtimezone() {

		/*$user_id =  logged('id');

		$table = $this->users_model->table;
		$this->db->where('id', $user_id); 

		$userData = $this->db->get($table)->row();

		$utimezone = '';
		if($userData > 0){
			//$utimezone = $userData->user_time_zone ;	
		}
		if($utimezone == ""){

			$ipaddress = $this->timesheet_model->gtMyIpGlobal();
	        $get_location = json_decode(file_get_contents('http://ip-api.com/json/'.$ipaddress)); 
	        $lat = $get_location->lat;
	        $lng = $get_location->lon;
	        $utimezone = $get_location->timezone;
		}
		 
        //echo "->".$utimezone ;exit;
        date_default_timezone_set($utimezone);*/
		
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

	public function hasAccessModule($module_id){
		// check if customer is allowed to view this page
		$company_id = logged('company_id');
		//if( $company_id != 1 && $company_id != 31 ){
		if( $company_id != 1 ){			
			$ci = &get_instance();
	        $ci->load->library('session');

	        $allowed_modules = $ci->session->userdata('userAccessModules');
	        if( !in_array($module_id, $allowed_modules) ){
	            $this->session->set_flashdata('alert_class', 'alert-danger');
	            $this->session->set_flashdata('message', 'You have no access to this module');
	            redirect('mycrm/membership');
	        }

	        $deactivated_modules = $ci->session->userdata('deactivated_modules');
	        if( in_array($module_id, $deactivated_modules) ){
	            $this->session->set_flashdata('alert_class', 'alert-danger');
	            $this->session->set_flashdata('message', 'You have no access to this module');
	            redirect('mycrm/membership');
	        }
		}        
    }
}

/* End of file My_Controller.php */
/* Location: ./application/core/My_Controller.php */