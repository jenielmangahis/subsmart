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
		if(is_logged()){
			$this->load->model('Activity_model', 'activity');
			$activity['activityName'] = "User Logout";
			$activity['activity'] = " User ".logged('username')." is logged out";
			$activity['user_id'] = logged('id');
			$this->activity->addEsignActivity($activity);
		}

		$this->activity_model->add("User: ".getLoggedFullName(logged('id')).' Logged Out'); 

		$this->users_model->logout();

		redirect('login','refresh');

	}

}

/* End of file Logout.php */
/* Location: ./application/controllers/Admin/Logout.php */