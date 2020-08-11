<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_Counter extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->load->model('Event_model', 'event_model');
		$this->load->model('BookingInquiry_model');
	}

	public function calendar_notification_counter() {

		$uid  = logged('id');
		$role = logged('role');

		//Schedule Events
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id'); $company_id = 15;
            $events = $this->event_model->getAllByCompany($company_id);
        }
        if ($role == 4) {
            $events = $this->event_model->getAllByUserId();
        }

        $total_events = count($events);

        //Taskhub
        $tasks = $this->db->query(
			'select ' .
			'a.*, '.
			'b.status_text, '.
			'if(ISNULL(c.task_id),"no","yes") as `is_participant` '.
			'from tasks a '.
			'left join tasks_status b on b.status_id = a.status_id '.
			'left join('.
				'select '.

			  	'task_id, '.
			  	'user_id '.

				'from tasks_participants '.

			  	'where user_id = '. $uid . 
			') c on c.task_id = a.task_id '.
			'where a.created_by = ' . $uid . ' ' .
			   'or not ISNULL(c.task_id) '.

			'group by a.task_id '.
			'order by a.date_created DESC'
		)->result();
		$total_taskhub = count($tasks);

		//Online Booking
		$inquiries = $this->BookingInquiry_model->findAllByUserId($uid);
		$total_online_booking = count($inquiries);

		$json_data = ['total_events' => $total_events, 'total_taskhub' => $total_taskhub, 'total_online_booking' => $total_online_booking];

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
