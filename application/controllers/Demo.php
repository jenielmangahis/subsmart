<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends MY_Controller {
	public function __construct(){
		parent::__construct();
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

	public function time_schedule(){		
		$post = $this->input->post();
		$date = $post['date'];
		$date = date("Y-m-d", strtotime($date));

		$schedules = [
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

		$this->page_data['date'] = $date;
		$this->page_data['schedules'] =  $schedules;
		$this->load->view('demo/time_schedule', $this->page_data);
	}
}
