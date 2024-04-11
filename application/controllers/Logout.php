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
		$this->load->model('Activity_model', 'activity');

		if(is_logged()){
			$company_id = logged('company_id');
			$calendarSettings = $this->CalendarSettings_model->getByCompanyId($company_id);
            $default_timezone = '';
            if( $calendarSettings && $calendarSettings->timezone != '' ){
            	date_default_timezone_set($calendarSettings->timezone);                
            }
			
			// $activity['activityName'] = "User Logout";
			// $activity['activity']     = "Logged out";
			// $activity['user_id'] = logged('id');
			// $activity['createdAt']   = date("Y-m-d H:i:s");
			// $this->activity->addEsignActivity($activity);
			$this->activity_model->add('Logged Out'); 
		}		

		$this->users_model->logout();
		$this->session->unset_userdata('multi_account_parent_company_id');
	    $this->session->unset_userdata('multi_account_parent_user_id');

		redirect('login','refresh');

	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Admin/Logout.php */