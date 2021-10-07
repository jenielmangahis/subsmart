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
		$user_id = logged('id');
		
		$activity_logs = $this->activity_model->getActivityLogs($user_id, 5);

		foreach($activity_logs as $activity_log):
			$activity_log->first_name = $this->users_model->getUser($activity_log->user_id)->FName;
			$activity_log->last_name = $this->users_model->getUser($activity_log->user_id)->LName;
			$activity_log->email = $this->users_model->getUser($activity_log->user_id)->email;
		endforeach;
		$this->page_data['activity_logs'] = $activity_logs;
		$this->load->view('v2/widgets/activity_details', $this->page_data);
	}

	public function index()
	{
		ifPermissions('activity_log_list');
		$ip = !empty(get('ip')) ? urldecode(get('ip')) : false;
		$user = !empty(get('user')) ? urldecode(get('user')) : false;

		$arg = [];

		if($ip)
			$arg['ip_address'] = $ip;

		if($user)
			$arg['user'] = $user;

		$this->page_data['activity_logs'] = $this->activity_model->getByWhere($arg, [
			'order' => [ 'id', 'desc' ]
		]);
		$this->page_data['filter_ip'] = $ip;
		$this->page_data['filter_user'] = $user;
		$this->load->view('activity_logs/list', $this->page_data);

	}

	public function view($id)
	{
		ifPermissions('activity_log_view');
		$this->page_data['activity'] = $this->activity_model->getById($id);
		$this->load->view('activity_logs/view', $this->page_data);

	}

}

/* End of file Activity_logs.php */
/* Location: ./application/controllers/Activity_logs.php */