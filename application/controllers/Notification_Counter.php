<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_Counter extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->load->model('Event_model', 'event_model');
		$this->load->model('BookingInquiry_model');
		$this->load->model('Taskhub_model');
	}

	public function ajax_calendar_notification_counter() {
		$this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Estimate_model');
        $this->load->model('Tickets_model');
        $this->load->model('Appointment_model');
        $this->load->model('EventTags_model');
        $this->load->model('Job_tags_model');
		$this->load->model('Customer_model');
		$company_id = logged('company_id');

		//Calendar
        $upcomingJobs   = $this->Jobs_model->getAllUpcomingJobsByCompanyId($company_id);
        $upcomingEvents = $this->Event_model->getAllUpComingEventsByCompanyId($company_id);
        $upcomingServiceTickets = $this->Tickets_model->get_upcoming_tickets_by_company_id($company_id);
        $scheduledEstimates = $this->Estimate_model->getAllPendingEstimatesByCompanyId($company_id);    
        $upcomingAppointments = $this->Appointment_model->getAllUpcomingAppointmentsByCompany($company_id);                 
        $total_calendar_schedule = count($upcomingJobs) + count($upcomingEvents) + count($upcomingServiceTickets) + count($scheduledEstimates) + count($upcomingAppointments); 
        $total_company = $this->Customer_model->count_customer_type('Commercial');
		$total_person = $this->Customer_model->count_customer_type('Residential');
		
        //Taskhub
        $tasks = $this->Taskhub_model->getAllNotCompletedTasksByCompanyId($company_id);
		$total_taskhub = count($tasks);

		//Online Booking
		/*$inquiries = $this->BookingInquiry_model->findAllByCompanyIdAndStatus($company_id, 1);
		$total_online_booking = count($inquiries);*/
		$total_online_booking = 0;

		$json_data = [
		'total_calendar_schedule' => $total_calendar_schedule,
		'total_taskhub' => $total_taskhub, 
		'total_online_booking' => $total_online_booking,
	    'total_company' => $total_company,
		'total_person' => $total_person,
	];

		echo json_encode($json_data);
		exit;

	}

	public function add_new_feature() {

		$planHeadings   = $this->PlanHeadings_model->getAll();
		$plans   = $this->NsmartPlan_model->getAll();

		$this->page_data['planHeadings'] = $planHeadings;
		$this->page_data['plans'] = $plans;
		$this->load->view('nsmart_features/add_new_feature', $this->page_data);
	}	

	public function create_feature() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['feature_name'] != '' ){
        	$data_feature = [
        		'feature_name' => $post['feature_name'],
        		'feature_description' => $post['feature_description'],
        		'plan_heading_id' => $post['feature_heading'],
        		'date_created' => date("Y-m-d H:i:s")
        	];

        	$nsmart_feature_id = $this->NsmartFeature_model->save($data_feature);
        	if( $nsmart_feature_id > 0 ){
        		foreach( $post['plans'] as $id => $value ){
        			$data_plan_modules = [
        				'nsmart_plans_id' => $id,
        				'nsmart_feature_id' => $nsmart_feature_id,
        				'plan_heading_id' => $post['feature_heading']
        			];

        			$nsPlanFeature = $this->NsmartPlanModules_model->create($data_plan_modules);
        		}

        		$this->session->set_flashdata('message', 'Add new plan feature was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');

        	}else{
        		$this->session->set_flashdata('message', 'Cannot save feature.');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}

        }else{
        	$this->session->set_flashdata('message', 'Please enter feature name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('nsmart_features/add_new_feature');
	}
}

/* End of file Nsmart_Features.php */
/* Location: ./application/controllers/Nsmart_Features.php */
