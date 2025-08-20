<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_logs extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->checkLogin();
		$this->page_data['page']->title = 'Activity Logs';
		$this->page_data['page']->menu = 'activity_logs';
	}
        
	public function getActivityLogs()
	{
		$user_id = logged('id');
		
		$this->page_data['activity_logs'] = $this->activity_model->getActivityLogs($user_id);
		
		$this->load->view('widgets/activity_details', $this->page_data);
		
	}

	public function getV2ActivityLogs()
	{
		$company_id = logged('company_id');
		
		$activity_logs = $this->activity_model->getActivityLogs($company_id, 20);

		$this->page_data['activity_logs'] = $activity_logs;
		$this->load->view('v2/widgets/activity_details', $this->page_data);
	}

	public function index()
	{		
		$cid = logged('company_id');   
		$activityLogs = $this->activity_model->getActivityLogs($cid); 
		
		$this->page_data['activityLogs'] = $activityLogs;
		$this->page_data['page']->title  = 'Activity Logs';
		$this->load->view('v2/pages/activity_logs/list', $this->page_data);

	}

	public function view($id)
	{
		//ifPermissions('activity_log_view');
		$this->page_data['activity'] = $this->activity_model->getById($id);
		$this->load->view('activity_logs/view', $this->page_data);

	}

	public function exportData()
	{
		$cid     = logged('company_id');
		$activityLogs = $this->activity_model->getActivityLogs($cid); 

		$delimiter = ",";
		$time      = time();
		$filename  = "activity_logs_" . $time . ".csv";

		$f = fopen('php://memory', 'w');

		$fields = array('Name', 'Activity', 'Date');
		fputcsv($f, $fields, $delimiter);

		if (!empty($activityLogs)) {
			foreach ($activityLogs as $log) {
				$name = $log->first_name . ' ' . $log->last_name;
				$csvData = array(
					$name,
					$log->activity_name,
					date("m/d/Y h:i:s A",strtotime($log->created_at))
				);
				fputcsv($f, $csvData, $delimiter);
			}
		} else {
			$csvData = array('');
			fputcsv($f, $csvData, $delimiter);
		}

		fseek($f, 0);

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');

		fpassthru($f);
	}

}

/* End of file Activity_logs.php */
/* Location: ./application/controllers/Activity_logs.php */