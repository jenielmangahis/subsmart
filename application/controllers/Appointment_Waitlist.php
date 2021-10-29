<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment_Waitlist extends MY_Controller {

	public function __construct()
	{

		parent::__construct();
		$this->checkLogin();
		$this->hasAccessModule(4); 

		$this->load->model('AppointmentWaitList_model');
		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->page_data['page']->title = 'Appointment Wait list(varname)';
		$this->page_data['page']->menu = 'schedule';
	}
}



/* End of file Appointment_Waitlist.php */

/* Location: ./application/controllers/Appointment_Waitlist.php */
