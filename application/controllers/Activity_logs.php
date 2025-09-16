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

		$sort_by  = 'Newest First';
		$order_by = ['field' => 'created_at', 'sort' => 'DESC'];
		if( get('sort') ){
			if( get('sort') == 'date_desc' ){
				$sort_by  = 'Newest First';
				$order_by = ['field' => 'created_at', 'sort' => 'DESC'];
			}else{
				$sort_by   = 'Oldest First';
				$order_by = ['field' => 'created_at', 'sort' => 'ASC'];
			}
		}

		$activityLogs = $this->activity_model->getActivityLogs($cid, $order_by); 
		
		$this->page_data['sort_by'] = $sort_by;
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

		$fields = array('Name', 'Activity', 'Is Archived', 'Date');
		fputcsv($f, $fields, $delimiter);

		if (!empty($activityLogs)) {
			foreach ($activityLogs as $log) {
				$name = $log->first_name . ' ' . $log->last_name;
				$csvData = array(
					$name,
					$log->activity_name,
					$log->is_archived,
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

	public function ajax_archive_selected_activity_logs()
    {
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['logs'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archived' => 'Yes', 'updated_at' => date("Y-m-d H:i:s")];
            $total_updated = $this->activity_model->bulkUpdate($post['logs'], $data, $filter);

			//Activity Logs
			$activity_name = 'Activity Logs : Archived ' . $total_updated . ' activity logs'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

	public function ajax_archived_list()
	{
        $company_id = logged('company_id');
        $logs       = $this->activity_model->getAllArchivedActivityLogs($company_id,[]);
        $this->page_data['logs'] = $logs;
        $this->load->view('v2/pages/activity_logs/ajax_archived_logs', $this->page_data);
	}

	public function ajax_restore_selected_logs()
	{
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['logs'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archived' => 'No', 'updated_at' => date("Y-m-d H:i:s")];
            $total_updated = $this->activity_model->bulkUpdate($post['logs'], $data, $filter);

			//Activity Logs
			$activity_name = 'Activity Logs : Restored ' . $total_updated . ' activity logs'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_permanently_delete_selected_logs()
	{
		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['logs'] ){
			
            $filters[] = ['field' => 'company_id', 'value' => $company_id];
			$filters[] = ['field' => 'is_archived', 'value' => 'Yes'];
            $total_deleted = $this->activity_model->bulkDelete($post['logs'], $filters);

			//Activity Logs
			$activity_name = 'Activity Logs : Permanently deleted ' .$total_deleted. ' activity logs'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_all_archived_logs()
	{
		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();
		
        $filter[] = ['field' => 'company_id', 'value' => $company_id];
		$total_archived = $this->activity_model->deleteAllArchived($filter);

		//Activity Logs
		$activity_name = 'Activity Logs : Permanently deleted ' .$total_archived. ' activity logs'; 
		createActivityLog($activity_name);

		$is_success = 1;
		$msg    = '';

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_restore_log()
	{
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $log = $this->activity_model->getById($post['log_id']);
		if( $log && $log->company_id == $company_id ){
			$data     = ['is_archived' => 'No', 'updated_at' => date("Y-m-d H:i:s")];
			$this->activity_model->update($user->id, $data);

			//Activity Logs
			$name = $log->first_name . ' ' . $log->last_name;
			$activity_name = 'Activity Logs : Restored activity log of ' . $name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_archived_log()
	{
		$this->load->model('Clients_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

		$log = $this->activity_model->getById($post['log_id']);
		if( $log && $log->company_id == $company_id ){
			$this->activity_model->delete($user->id);

			//Activity Logs
			$name = $log->first_name . ' ' . $log->last_name;
			$activity_name = 'Activity Logs : Permanently deleted activity log of ' . $name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}
}

/* End of file Activity_logs.php */
/* Location: ./application/controllers/Activity_logs.php */