<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if(!is_logged()){
			redirect('login','refresh');
		}

	}

	public function index()
	{
		$this->load->model('CalendarSettings_model');

		if(is_logged()){
			$company_id = logged('company_id');
			$calendarSettings = $this->CalendarSettings_model->getByCompanyId($company_id);
            $default_timezone = '';
            if( $calendarSettings && $calendarSettings->timezone != '' ){
            	date_default_timezone_set($calendarSettings->timezone);                
            }

			$this->load->model('Activity_model', 'activity');
			$activity['activityName'] = "User Logout";
			$activity['activity'] = " User ".logged('username')." is logged out";
			$activity['user_id'] = logged('id');
			$activity['createdAt']   = date("Y-m-d H:i:s");
			$this->activity->addEsignActivity($activity);
		}

		$this->activity_model->add("User: ".getLoggedFullName(logged('id')).' Logged Out'); 

		$this->users_model->logout();

		redirect('login','refresh');

	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Admin/Logout.php */