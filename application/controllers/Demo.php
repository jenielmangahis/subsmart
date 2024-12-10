<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends MYF_Controller  {
	public function __construct(){
		parent::__construct();
        //$this->checkLogin(1);
		$this->load->model('Demo_model');
		$this->page_data['page']->title = 'nSmart - Demo';
	}
	public function index(){
		$this->load->view('demo/index', $this->page_data);
	}

	public function get_events(){
		$events = [
			["title" => "Sample Events A", "start" => "2020-05-24", "end" => "2020-05-26"],
			["title" => "Sample Events B", "start" => "2020-05-28"],
		];
    	header('Content-Type: application/json');
    	die(json_encode($events));
	}

	public function list(){
		$this->page_data['page']->title = 'nSmart - Demo Schedule List';

		$list = $this->Demo_model->getlist();
		$this->page_data['demoList'] = $list;
		$this->load->view('demo/list', $this->page_data);
	}

	public function time_schedule()
	{
		$post = $this->input->post();
		$date = isset($post['date']) ? $post['date'] : date('Y-m-d');
		$date = date("Y-m-d", strtotime($date)); // Ensure valid date format
	
		$schedules_12hr = [
			"10:00 AM",
			"11:00 AM",
			"12:00 PM",
			"01:00 PM",
			"02:00 PM",
			"03:00 PM",
			"04:00 PM",
			"05:00 PM",
			"06:00 PM",
			"07:00 PM"
		];
	
		$schedules_24hr = array_map(function($time) {
			return date("H:i:s", strtotime($time));
		}, $schedules_12hr);
	
		$this->page_data['date'] = $date;
		$this->page_data['schedules_12hr'] = $schedules_12hr; // For display
		$this->page_data['schedules_24hr'] = $schedules_24hr; // For saving to DB
		$output = $this->load->view('demo/time_schedule', $this->page_data, TRUE);
		
	    $this->output->set_content_type('application/json')
        ->set_output(json_encode([
            'output' => $output,
            'data' => $this->page_data
        ]));

	}
	
	public function save_demo()
	{
		$this->load->library('form_validation');

		// Validation rules
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
		$this->form_validation->set_rules('key_features', 'Key Features', 'required');

		if ($this->form_validation->run() === FALSE) {
			echo json_encode([
				'success' => false,
				'message' => validation_errors()
			]);
			return;
		}
		$company_id = logged('company_id');

		// Collect form data
		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'guest_emails' => $this->input->post('guest_emails'),
			'phone_number' => $this->input->post('phone_number'),
			'text_reminder' => $this->input->post('text_reminder'),
			'key_features' => $this->input->post('key_features'),
			'company_id' => $company_id,
			'demo_time' => $this->input->post('demo_time'),
			'demo_date' => $this->input->post('demo_date'),
		];

		$insert_id = $this->db->insert('demo_schedule', $data);


		if ($insert_id) {
			echo json_encode(['success' => true]);
		} else {
			echo json_encode([
				'success' => false,
				'message' => 'Failed to save event. Please try again.'
			]);
		}
	}

}
