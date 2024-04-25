<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taskhub extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin();
		$this->load->model(array('taskhub_model','taskhub_updates_model','taskhub_status_model','taskhub_participants_model'));

		$this->page_data['page']->menu = 'taskhub';
		$this->page_data['module'] = 'calendar';		
	}
        
        function loadWidgetContents()
        {
            $company_id = logged('company_id');
            $data['tasks'] = $this->taskhub_model->getTask($company_id);
            $this->load->view('widgets/task_hub_details', $data);
                    
        }

		function loadV2WidgetContents()
        {
            $company_id = logged('company_id');
            $data['tasks'] = $this->taskhub_model->getOngoingTasksByCompanyId($company_id);
            $this->load->view('v2/widgets/task_hub_details', $data);
                    
        }

	public function index(){
        $this->page_data['page']->title = 'Task Hub';
        $this->page_data['page']->parent = 'Calendar';

		$this->hasAccessModule(6); 
		$cid = logged('company_id');
		$selected_customer_id = 0;

		if( $this->input->get('status') && $this->input->get('cus_id') ){
			$selected_customer_id = $this->input->get('cus_id');
			$this->page_data['tasks'] = $this->taskhub_model->getAllTasksByCustomerIdAndStatusId($this->input->get('cus_id'), $this->input->get('status'));
		}else{
			if($this->input->get('status') != 0) {
				$this->page_data['tasks'] = $this->taskhub_model->getAllByCompanyIdAndStatus($cid, $this->input->get('status'));	
			} else {
				$this->page_data['tasks'] = $this->taskhub_model->getAllByCompanyId($cid);	
			}
		}

		$this->page_data['status'] = $this->input->get('status');

		$total_task_new = $this->taskhub_model->getAllTasksByCompanyIdAndStatusId($cid, 1);
		$task_ongoing   = $this->taskhub_model->getAllTasksByCompanyIdAndStatusId($cid, 2);

		$task_onhold   = $this->taskhub_model->getAllTasksByCompanyIdAndStatusId($cid, 3);
		$task_resumed  = $this->taskhub_model->getAllTasksByCompanyIdAndStatusId($cid, 4);
		$task_for_evaluation = $this->taskhub_model->getAllTasksByCompanyIdAndStatusId($cid, 5);

		$task_completed  = $this->taskhub_model->getAllTasksByCompanyIdAndStatusId($cid, 6);
		
		$this->page_data['total_task_new']       = count($total_task_new);
		$this->page_data['total_task_ongoing']   = count($task_ongoing);
		$this->page_data['total_task_hold']      = count($task_onhold);
		$this->page_data['total_task_resumed']   = count($task_resumed);
		$this->page_data['total_task_for_evaluation'] = count($task_for_evaluation);
		$this->page_data['total_task_completed'] = count($task_completed);

		$this->page_data['selected_customer_id'] = $selected_customer_id;
		$this->page_data['status_selection']     = $this->taskhub_status_model->get();
		// $this->load->view('workcalender/taskhub/list', $this->page_data);
		$this->load->view('v2/pages/workcalender/taskhub/list', $this->page_data);
	}

	public function create(){
        $this->page_data['page']->title  = 'Task';
        $this->page_data['page']->parent = 'Calendar';
		$this->page_data['taskhub_tab_subtitle'] = 'Create New Task';

		$this->hasAccessModule(6);
		$uid = logged('id');
		$company_id = logged('company_id');

		$users_selection = $this->db->query(
			'select '.'a.id, '.'concat(a.FName, " ", a.LName) as `name` '.'from users a '
			.'where a.id <> ' . $uid . ' ' .'and a.company_id = ' . $company_id
		);

		if($users_selection->num_rows() > 0){
			$this->page_data['users_selection'] = $users_selection->result();
		}

		$taskid = trim($this->input->post('taskid'));
		$this->page_data['status_selection'] = $this->taskhub_status_model->get();
		if(($id > 0) || ($taskid > 0)){
			if($id > 0){
				$taskid = $id;
			}
			$task = $this->taskhub_model->getById($taskid);
			$this->page_data['taskHub'] = $task;

			$this->page_data['selected_participants'] = $this->db->query(
				'select a.*, concat(b.FName, " ", b.LName) as `name` from tasks_participants a '.
				'left join users b on b.id = a.user_id '.
				'where a.task_id = ' . $taskid
			)->result();
		}

		$customer = '';
		if( $this->input->get('cus_id') ){
			$this->load->model('AcsProfile_model');			
			$customer = $this->AcsProfile_model->getByProfId($this->input->get('cus_id'));
		}

		$this->page_data['customer'] = $customer;
		
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('estimated_date_complete', 'Estimated Date of Competion', 'trim|required');

		if($this->form_validation->run() == false){			
			$this->page_data['optionPriority'] = $this->taskhub_model->optionPriority();
			$this->load->view('v2/pages/workcalender/taskhub/create', $this->page_data);
		} else {

			if($this->input->post('description') == ''){
				$this->page_data['optionPriority'] = $this->taskhub_model->optionPriority();
				$this->page_data['error'] = 'Please specify task description';
				$this->load->view('v2/pages/workcalender/taskhub/create', $this->page_data);
			}else{
				$assigned_to = $this->input->post('assigned_to');
				if($assigned_to == ''){
					$assigned_to = $uid;
				}

				$process_successful = false;

				if($taskid > 0){
					$task = $this->page_data['task'];

					$update_text = '';
					if(trim($task->subject) != trim($this->input->post('subject'))){
						$update_text = 'Modified:' . "\n".
									   '- Subject' . "\n";
					}

					if(trim($task->description) != trim($this->input->post('description'))){
						if(!empty($update_text)){
							$update_text .= '- Description' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Description' . "\n";
						}
					}

					if($task->estimated_date_complete != $this->input->post('estimated_date_complete')){
						if(!empty($update_text)){
							$update_text .= '- Estimated Date of Completion' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Estimated Date of Completion' . "\n";
						}
					}

					$status = $this->input->post('status');
					if(empty($status)){
						$status = 1;
					}

					if($task->status_id != $status){
						if(!empty($update_text)){
							$update_text .= '- Status' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Status' . "\n";
						}
					}

					$assigned_to_old = $assigned_to;
					$selected_participants = $this->page_data['selected_participants'];
					foreach ($selected_participants as $key => $value) {
						if($value->is_assigned == 1){
							$assigned_to_old = $value->user_id;
							break;
						}
					}

					if($assigned_to != $assigned_to_old){
						if(!empty($update_text)){
							$update_text .= '- Assignee' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Assignee' . "\n";
						}
					}
					
					$prof_id = 0;
					if( $this->input->post('customer_id') > 0 ){
						$prof_id = $this->input->post('customer_id');
					}
					
					$data = array(
						'subject' => $this->input->post('subject'),
						'description' => $this->input->post('description'),
						'prof_id' => $prof_id,
						'estimated_date_complete' => date("Y-m-d",strtotime($this->input->post('estimated_date_complete'))),
						'status_id' => $status,
						'priority' => $this->input->post('priority')
					);

					$process_successful = $this->taskhub_model->trans_update($data, array('task_id' => trim($taskid)));
					if(($process_successful) && (!empty($update_text))){
						$data = array(
							'task_id' => trim($taskid),
							'notes' => $update_text,
							'date_updated' => date('Y-m-d h:i:s'),
							'performed_by' => $uid
						);

						$this->taskhub_updates_model->trans_create($data);

						customerAuditLog(logged('id'), $this->input->post('customer_id'), $taskid, 'Taskhub', 'Updated task '.$this->input->post('subject'));
					}
				} else {
					$prof_id = 0;
					if( $this->input->post('customer_id') > 0 ){
						$prof_id = $this->input->post('customer_id');
					}

					$data = array(
						'subject' => $this->input->post('subject'),
						'prof_id' => $prof_id,
						'description' => $this->input->post('description'),
						'created_by' => $uid,
						'date_created' => date('Y-m-d h:i:s'),
						'estimated_date_complete' => date("Y-m-d",strtotime($this->input->post('estimated_date_complete'))),
						'status_id' => $this->input->post('status'),
						'company_id' => $company_id,
						'priority' => $this->input->post('priority')
					);

					$last_id = $this->taskhub_model->saveTask($data);
					if( $last_id > 0 ){
						$process_successful = 1;
						customerAuditLog(logged('id'), $this->input->post('customer_id'), $last_id, 'Taskhub', 'Created task '.$this->input->post('subject'));
					}

					if($process_successful){
						$task = $this->db->query(
							'select task_id from tasks where created_by = ' . $uid . ' order by date_created DESC limit 1'
						)->row();

						$taskid = $task->task_id;
						$status = 1;
					}
				}

				if($process_successful){
					$this->taskhub_participants_model->deleteAllByTaskId(trim($taskid));			
					$data_participants = array();
					$participants = $this->input->post('participants');
					if((!empty($participants)) && ($participants != '')){
						$participants = explode(',', $participants);
						foreach ($participants as $participant) {
							$data_participant = array(
								'task_id' => trim($taskid),
								'user_id' => $participant,
								'is_assigned' => 0
							);

							$this->taskhub_participants_model->create($data_participant);
						}						
					}

					//SMS Notification
					$taskStatus = $this->taskhub_status_model->getById($this->input->post('status'));
            		createCronAutoSmsNotification($company_id, $taskid, 'taskhub', $taskStatus->status_text, $uid, $assigned_to);

					$data_assigned = [
		                'task_id' => $taskid,
		                'user_id' => $assigned_to,
		                'is_assigned' => 1
		            ];

		            $this->taskhub_participants_model->create($data_assigned);

					//Activity Logs
					$activity_name = 'Created New Task ' . $this->input->post('subject'); 
					createActivityLog($activity_name);
				} else {
					$this->page_data['error'] = 'Error creating task';
					$this->load->view('v2/pages/workcalender/taskhub/create', $this->page_data);
				}
			}
		}
	}

	public function edit($id = 0){
        $this->page_data['page']->title  = 'Task';
        $this->page_data['page']->parent = 'Calendar';
		$this->page_data['taskhub_tab_subtitle'] = 'Edit Task';

		$this->hasAccessModule(6);
		$uid = logged('id');
		$company_id = logged('company_id');

		$users_selection = $this->db->query(
			'select '.'a.id, '.'concat(a.FName, " ", a.LName) as `name` '.'from users a '
			.'where a.id <> ' . $uid . ' ' .'and a.company_id = ' . $company_id
		);

		if($users_selection->num_rows() > 0){
			$this->page_data['users_selection'] = $users_selection->result();
		}

		$taskid = trim($this->input->post('taskid'));
		$this->page_data['status_selection'] = $this->taskhub_status_model->get();
		if(($id > 0) || ($taskid > 0)){
			if($id > 0){
				$taskid = $id;
			}
			$task = $this->taskhub_model->getById($taskid);
			$this->page_data['taskHub'] = $task;

			$this->page_data['selected_participants'] = $this->db->query(
				'select a.*, concat(b.FName, " ", b.LName) as `name` from tasks_participants a '.
				'left join users b on b.id = a.user_id '.
				'where a.task_id = ' . $taskid
			)->result();
		}

		$customer = '';
		if( $this->input->get('cus_id') ){
			$this->load->model('AcsProfile_model');			
			$customer = $this->AcsProfile_model->getByProfId($this->input->get('cus_id'));
		}

		$this->page_data['customer'] = $customer;
		
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('estimated_date_complete', 'Estimated Date of Competion', 'trim|required');

		if($this->form_validation->run() == false){			
			$this->page_data['optionPriority'] = $this->taskhub_model->optionPriority();
			$this->load->view('v2/pages/workcalender/taskhub/edit', $this->page_data);
		} else {

			if($this->input->post('description') == ''){
				$this->page_data['optionPriority'] = $this->taskhub_model->optionPriority();
				$this->page_data['error'] = 'Please specify task description';
				$this->load->view('v2/pages/workcalender/taskhub/edit', $this->page_data);
			}else{
				$assigned_to = $this->input->post('assigned_to');
				if($assigned_to == ''){
					$assigned_to = $uid;
				}

				$process_successful = false;

				if($taskid > 0){
					$task = $this->page_data['task'];

					$update_text = '';
					if(trim($task->subject) != trim($this->input->post('subject'))){
						$update_text = 'Modified:' . "\n".
									   '- Subject' . "\n";
					}

					if(trim($task->description) != trim($this->input->post('description'))){
						if(!empty($update_text)){
							$update_text .= '- Description' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Description' . "\n";
						}
					}

					if($task->estimated_date_complete != $this->input->post('estimated_date_complete')){
						if(!empty($update_text)){
							$update_text .= '- Estimated Date of Completion' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Estimated Date of Completion' . "\n";
						}
					}

					$status = $this->input->post('status');
					if(empty($status)){
						$status = 1;
					}

					if($task->status_id != $status){
						if(!empty($update_text)){
							$update_text .= '- Status' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Status' . "\n";
						}
					}

					$assigned_to_old = $assigned_to;
					$selected_participants = $this->page_data['selected_participants'];
					foreach ($selected_participants as $key => $value) {
						if($value->is_assigned == 1){
							$assigned_to_old = $value->user_id;
							break;
						}
					}

					if($assigned_to != $assigned_to_old){
						if(!empty($update_text)){
							$update_text .= '- Assignee' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Assignee' . "\n";
						}
					}
					
					$prof_id = 0;
					if( $this->input->post('customer_id') > 0 ){
						$prof_id = $this->input->post('customer_id');
					}
					
					$data = array(
						'subject' => $this->input->post('subject'),
						'description' => $this->input->post('description'),
						'prof_id' => $prof_id,
						'estimated_date_complete' => date("Y-m-d",strtotime($this->input->post('estimated_date_complete'))),
						'status_id' => $status,
						'priority' => $this->input->post('priority')
					);

					$process_successful = $this->taskhub_model->trans_update($data, array('task_id' => trim($taskid)));
					if(($process_successful) && (!empty($update_text))){
						$data = array(
							'task_id' => trim($taskid),
							'notes' => $update_text,
							'date_updated' => date('Y-m-d h:i:s'),
							'performed_by' => $uid
						);

						$this->taskhub_updates_model->trans_create($data);

						customerAuditLog(logged('id'), $this->input->post('customer_id'), $taskid, 'Taskhub', 'Updated task '.$this->input->post('subject'));
					}
				} else {
					$prof_id = 0;
					if( $this->input->post('customer_id') > 0 ){
						$prof_id = $this->input->post('customer_id');
					}

					$data = array(
						'subject' => $this->input->post('subject'),
						'prof_id' => $prof_id,
						'description' => $this->input->post('description'),
						'created_by' => $uid,
						'date_created' => date('Y-m-d h:i:s'),
						'estimated_date_complete' => date("Y-m-d",strtotime($this->input->post('estimated_date_complete'))),
						'status_id' => $this->input->post('status'),
						'company_id' => $company_id,
						'priority' => $this->input->post('priority')
					);

					$last_id = $this->taskhub_model->saveTask($data);
					if( $last_id > 0 ){
						$process_successful = 1;
						customerAuditLog(logged('id'), $this->input->post('customer_id'), $last_id, 'Taskhub', 'Created task '.$this->input->post('subject'));
					}

					if($process_successful){
						$task = $this->db->query(
							'select task_id from tasks where created_by = ' . $uid . ' order by date_created DESC limit 1'
						)->row();

						$taskid = $task->task_id;
						$status = 1;
					}
				}

				if($process_successful){
					$this->taskhub_participants_model->deleteAllByTaskId(trim($taskid));			
					$data_participants = array();
					$participants = $this->input->post('participants');
					if((!empty($participants)) && ($participants != '')){
						$participants = explode(',', $participants);
						foreach ($participants as $participant) {
							$data_participant = array(
								'task_id' => trim($taskid),
								'user_id' => $participant,
								'is_assigned' => 0
							);

							$this->taskhub_participants_model->create($data_participant);
						}						
					}

					//SMS Notification
					$taskStatus = $this->taskhub_status_model->getById($this->input->post('status'));
            		createCronAutoSmsNotification($company_id, $taskid, 'taskhub', $taskStatus->status_text, $uid, $assigned_to);

					$data_assigned = [
		                'task_id' => $taskid,
		                'user_id' => $assigned_to,
		                'is_assigned' => 1
		            ];

		            $this->taskhub_participants_model->create($data_assigned);

					//Activity Logs
					$activity_name = 'Created New Task ' . $this->input->post('subject'); 
					createActivityLog($activity_name);
				} else {
					$this->page_data['error'] = 'Error creating task';
					$this->load->view('v2/pages/workcalender/taskhub/edit', $this->page_data);
				}
			}
		}
	}	

	public function entry($id = 0){
        $this->page_data['page']->title = 'Task';
        $this->page_data['page']->parent = 'Calendar';

		$this->hasAccessModule(6);
		$uid = logged('id');
		$company_id = logged('company_id');

		$users_selection = $this->db->query(
			'select '.

			'a.id, '.
			'concat(a.FName, " ", a.LName) as `name` '.

			'from users a '.

			'where a.id <> ' . $uid . ' ' .
			  'and a.company_id = ' . $company_id
		);

		if($users_selection->num_rows() > 0){
			$this->page_data['users_selection'] = $users_selection->result();
		}

		$taskid = trim($this->input->post('taskid'));
		$this->page_data['status_selection'] = $this->taskhub_status_model->get();
		if(($id > 0) || ($taskid > 0)){
			if($id > 0){
				$taskid = $id;
			}
			$task = $this->taskhub_model->getById($taskid);
			$this->page_data['taskHub'] = $task;

			$this->page_data['selected_participants'] = $this->db->query(
				'select a.*, concat(b.FName, " ", b.LName) as `name` from tasks_participants a '.
				'left join users b on b.id = a.user_id '.
				'where a.task_id = ' . $taskid
			)->result();
		}

		$customer = '';
		if( $this->input->get('cus_id') ){
			$this->load->model('AcsProfile_model');			
			$customer = $this->AcsProfile_model->getByProfId($this->input->get('cus_id'));
		}

		$this->page_data['customer'] = $customer;
		
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		//$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('estimated_date_complete', 'Estimated Date of Competion', 'trim|required');

		if($this->form_validation->run() == false){			
			$this->page_data['optionPriority'] = $this->taskhub_model->optionPriority();
			// $this->load->view('workcalender/taskhub/entry', $this->page_data);
			$this->load->view('v2/pages/workcalender/taskhub/entry', $this->page_data);
		} else {

			IF( $this->input->post('description') == '' ){
				$this->page_data['optionPriority'] = $this->taskhub_model->optionPriority();
				$this->page_data['error'] = 'Please specify task description';
				// $this->load->view('workcalender/taskhub/entry', $this->page_data);
				$this->load->view('v2/pages/workcalender/taskhub/entry', $this->page_data);
			}else{
				$assigned_to = $this->input->post('assigned_to');
				if($assigned_to == ''){
					$assigned_to = $uid;
				}

				$process_successful = false;

				if($taskid > 0){
					$task = $this->page_data['task'];

					$update_text = '';
					if(trim($task->subject) != trim($this->input->post('subject'))){
						$update_text = 'Modified:' . "\n".
									   '- Subject' . "\n";
					}

					if(trim($task->description) != trim($this->input->post('description'))){
						if(!empty($update_text)){
							$update_text .= '- Description' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Description' . "\n";
						}
					}

					if($task->estimated_date_complete != $this->input->post('estimated_date_complete')){
						if(!empty($update_text)){
							$update_text .= '- Estimated Date of Completion' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Estimated Date of Completion' . "\n";
						}
					}

					$status = $this->input->post('status');
					if(empty($status)){
						$status = 1;
					}

					if($task->status_id != $status){
						if(!empty($update_text)){
							$update_text .= '- Status' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Status' . "\n";
						}
					}

					$assigned_to_old = $assigned_to;
					$selected_participants = $this->page_data['selected_participants'];
					foreach ($selected_participants as $key => $value) {
						if($value->is_assigned == 1){
							$assigned_to_old = $value->user_id;
							break;
						}
					}


					if($assigned_to != $assigned_to_old){
						if(!empty($update_text)){
							$update_text .= '- Assignee' . "\n";
						} else {
							$update_text = 'Modified:' . "\n".
									       '- Assignee' . "\n";
						}
					}
					
					$prof_id = 0;
					if( $this->input->post('customer_id') > 0 ){
						$prof_id = $this->input->post('customer_id');
					}
					
					$data = array(
						'subject' => $this->input->post('subject'),
						'description' => $this->input->post('description'),
						'prof_id' => $prof_id,
						'estimated_date_complete' => date("Y-m-d",strtotime($this->input->post('estimated_date_complete'))),
						'status_id' => $status,
						'priority' => $this->input->post('priority')
					);

					$process_successful = $this->taskhub_model->trans_update($data, array('task_id' => trim($taskid)));
					if(($process_successful) && (!empty($update_text))){
						$data = array(
							'task_id' => trim($taskid),
							'notes' => $update_text,
							'date_updated' => date('Y-m-d h:i:s'),
							'performed_by' => $uid
						);

						$this->taskhub_updates_model->trans_create($data);

						customerAuditLog(logged('id'), $this->input->post('customer_id'), $taskid, 'Taskhub', 'Updated task '.$this->input->post('subject'));
					}
				} else {
					$prof_id = 0;
					if( $this->input->post('customer_id') > 0 ){
						$prof_id = $this->input->post('customer_id');
					}

					$data = array(
						'subject' => $this->input->post('subject'),
						'prof_id' => $prof_id,
						'description' => $this->input->post('description'),
						'created_by' => $uid,
						'date_created' => date('Y-m-d h:i:s'),
						'estimated_date_complete' => date("Y-m-d",strtotime($this->input->post('estimated_date_complete'))),
						'status_id' => $this->input->post('status'),
						'company_id' => $company_id,
						'priority' => $this->input->post('priority')
					);

					$last_id = $this->taskhub_model->saveTask($data);
					if( $last_id > 0 ){
						$process_successful = 1;
						customerAuditLog(logged('id'), $this->input->post('customer_id'), $last_id, 'Taskhub', 'Created task '.$this->input->post('subject'));
					}

					if($process_successful){
						$task = $this->db->query(
							'select task_id from tasks where created_by = ' . $uid . ' order by date_created DESC limit 1'
						)->row();

						$taskid = $task->task_id;
						$status = 1;
					}
				}

				if($process_successful){
					$this->taskhub_participants_model->deleteAllByTaskId(trim($taskid));
					//$this->taskhub_participants_model->trans_delete(array(), array('task_id' => trim($taskid)))				
					$data_participants = array();
					$participants = $this->input->post('participants');
					if((!empty($participants)) && ($participants != '')){
						$participants = explode(',', $participants);
						foreach ($participants as $participant) {
							$data_participant = array(
								'task_id' => trim($taskid),
								'user_id' => $participant,
								'is_assigned' => 0
							);

							$this->taskhub_participants_model->create($data_participant);
						}						
					}

					//SMS Notification
					$taskStatus = $this->taskhub_status_model->getById($this->input->post('status'));
            		createCronAutoSmsNotification($company_id, $taskid, 'taskhub', $taskStatus->status_text, $uid, $assigned_to);

					$data_assigned = [
		                'task_id' => $taskid,
		                'user_id' => $assigned_to,
		                'is_assigned' => 1
		            ];

		            $this->taskhub_participants_model->create($data_assigned);

					//Activity Logs
					$activity_name = 'Created New Task ' . $this->input->post('subject'); 
					createActivityLog($activity_name);

					//redirect('taskhub');

				} else {
					$this->page_data['error'] = 'Error creating task';
					// $this->load->view('workcalender/taskhub/entry', $this->page_data);
					$this->load->view('v2/pages/workcalender/taskhub/entry', $this->page_data);
				}
			}
		}
	}
	
	public function ajax_save_taskhub_task()
	{
		$this->load->model('Taskhub_model');
        $this->load->model('Taskhub_participants_model');
        $this->load->model('Taskhub_status_model');   

        $cid = logged('company_id');
        $uid = logged('id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();  

        if( $post['subject'] != '' ){
            $taskStatus = $this->Taskhub_status_model->getById($post['status']);

            $prof_id = 0;
            if( $post['customer_id'] > 0 ){
            	$prof_id = $post['customer_id'];
            }
            
            $task_data = [
                'prof_id' => $prof_id,
                'subject' => $post['subject'],
                'description' => $post['description'],
                'created_by' => $uid,
                'date_created' => date('Y-m-d h:i:s'),
                'estimated_date_complete' => date('Y-m-d', strtotime($post['estimated_date_complete'])),
                'actual_date_complete' => '',
                'task_color' => $taskStatus->status_color,
                'status_id' => $taskStatus->status_id,
                'priority' => $post['priority'],
                'company_id' => $cid,
                'view_count' => 0
            ];

            $taskId = $this->Taskhub_model->create($task_data);

			$assigned_to = $this->input->post('assigned_to');
			if($assigned_to == ''){
				$assigned_to = $uid;
			}			

            $data_participant = [
                'task_id' => $taskId,
                'user_id' => $assigned_to,
                'is_assigned' => 1
            ];

            $this->Taskhub_participants_model->create($data_participant);

            $is_success = 1;
            $msg = '';

        }else{
            $msg = 'Please enter subject';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);  
	}	

	public function view($id){
		$company_id = logged('company_id');

		$this->page_data['taskHub'] = $task = $this->db->query(
			'select '.
			'a.*, '.
			'CONCAT(cus.first_name, " ", cus.last_name)AS customer_name, '.
			'b.status_text, '.
			'b.status_color, '.
			'concat(c.FName, " ", c.LName) as `created_by_name` '.
			'from tasks a '.
			'left join tasks_status b on b.status_id = a.status_id '.
			'left join users c on c.id = a.created_by '.
			'left join acs_profile cus on a.prof_id = cus.prof_id '.
			'where a.task_id = '. $id
		)->row();

		$this->page_data['participants'] = $this->db->query(
			'select '.

			'a.*, '.
			'concat(b.FName, " ", b.LName) as `participant_name` '.

			'from tasks_participants a '.
			'left join users b on b.id = a.user_id '.

			'where a.task_id = ' . $id
		)->result();

		$this->page_data['updates_and_comments'] = $this->db->query(			
			'select '.

			'a.comment as `text`, '.
			'a.comment_date as `update_date`, '.
			'concat(b.FName, " ", b.LName) as `user`, '.

			'0 as `is_update` '.

			'from comments a '.
			'left join users b on b.id = a.user_id '.
			'where a.relation_id = '. $id . ' ' .
			  'and a.type = "task" '.
			  'and a.company_id = '. $company_id . ' ' .
			'order by `update_date` ASC '
		)->result();

		$sql = 'update tasks set view_count = view_count + 1 where task_id = ' . $id;

		$this->db->query($sql);

		$this->page_data['page']->title = 'Task Hub';		
		$this->load->view('v2/pages/workcalender/taskhub/view', $this->page_data);
	}

	public function comment($id){
		$this->load->model('Settings_model');		
		$uid = logged('id');
		$company_id = logged('company_id');
		
        $settings = $this->Settings_model->getByWhere(['key' => DB_SETTINGS_TABLE_KEY_SCHEDULE, 'company_id' => $company_id]);
		$comment = $_POST['comment'];

		$a_settings = unserialize($settings[0]->value);
		if( $a_settings['calendar_timezone'] ){
			date_default_timezone_set($a_settings['calendar_timezone']); 
		}

		$data = array(
			'type' => 'task',
			'user_id' => $uid,
			'comment' => $comment,
			'comment_date' => date('Y-m-d h:i:s'),
			'company_id' => $company_id,
			'relation_id' => $id
		);

		if($this->comments_model->trans_create($data)){
			$user = logged();

			$commenter = $user->FName . ' ' . $user->LName;
			$comment_date = date_create($data['comment_date']);

			$data['error'] = '';
			$data['commenter'] = $commenter;
			$data['comment_date'] = date_format($comment_date, 'F d, Y h:i:s');

		} else {
			$data = array('error' => "Error in creating comment");
		}

		echo json_encode($data);

	}

	public function addupdate($id){
		$uid = logged('id');

		$this->page_data['task'] = $this->taskhub_model->getById($id);

		$this->form_validation->set_rules('notes', 'Notes', 'trim|required');
		if($this->form_validation->run() == false){
			$this->load->view('v2/pages/workcalender/taskhub/add_update', $this->page_data);
		} else {
			$data = array(
				'task_id' => $id,
				'notes' => $this->input->post('notes'),
				'date_updated' => date('Y-m-d h:i:s'),
				'performed_by' => $uid
			);

			if($this->taskhub_updates_model->trans_create($data)){
				redirect('taskhub/view/' . $id);
			} else {
				$this->page_data['error'] = 'Error in creating task update';

				$this->load->view('v2/pages/workcalender/taskhub/add_update', $this->page_data);
			}
		}
	}

	public function getTasksWithFilters(){
		$keyword = "";
		$status_id = "";
		$from_date = "";
		$to_date = "";

		if(isset($_POST['keyword'])){
			$keyword = $_POST['keyword'];
		}

		if(isset($_POST['status'])){
			$status_id = $_POST['status'];
		}

		if($_POST['fromdate'] != ''){
			$from_date = $_POST['fromdate'] . ' 00:00:00';
		}

		if($_POST['todate'] != ''){
			$to_date = $_POST['todate'] . ' 23:59:59';
		}

		$date_range = array();
		if( $from_date != '' && $to_date != '' ){
			$date_range = ['from' => $from_date, 'to' => $to_date];
		}

		$cid = logged('company_id');
		$result = $this->taskhub_model->getCompanyTasksWithFilter($cid,$keyword, $status_id, $date_range);
		//$result = getTasks(true, $keyword, $status_id, $from_date, $to_date);

		echo json_encode($result);
	}

	public function ajax_load_company_list()
	{
		$this->load->model('Taskhub_model');
        $this->load->model('Business_model');
        $this->load->model('Taskhub_status_model');       

        $cid = logged('company_id');
        $tasksHub = $this->Taskhub_model->getAllByCompanyId($cid);

        $this->page_data['taskStatus'] = $this->Taskhub_status_model->get();
        $this->page_data['tasksHub'] = $tasksHub;                
        $this->load->view('workcalender/taskhub/ajax_load_company_list', $this->page_data);
	}

	public function ajax_add_new_task()
	{
		$this->load->model('Taskhub_status_model');

        $this->page_data['optionPriority'] = $this->taskhub_model->optionPriority();
        $this->page_data['taskStatus'] = $this->Taskhub_status_model->get();
        $this->load->view('workcalender/taskhub/ajax_add_new_task', $this->page_data);
	}

	public function ajax_save_task()
	{
		$this->load->model('Taskhub_model');
        $this->load->model('Taskhub_participants_model');
        $this->load->model('Taskhub_status_model');   

        $cid = logged('company_id');
        $uid = logged('id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();  

        if( $post['subject'] != '' ){
            $taskStatus = $this->Taskhub_status_model->getById($post['status']);

            $prof_id = 0;
            if( $post['customer_id'] > 0 ){
            	$prof_id = $post['customer_id'];
            }
            
            $task_data = [
                'prof_id' => $prof_id,
                'subject' => $post['subject'],
                'description' => $post['description'],
                'created_by' => $uid,
                'date_created' => date('Y-m-d h:i:s'),
                'estimated_date_complete' => date('Y-m-d', strtotime($post['estimated_date_complete'])),
                'actual_date_complete' => '',
                'task_color' => $taskStatus->status_color,
                'status_id' => $taskStatus->status_id,
                'priority' => $post['priority'],
                'company_id' => $cid,
                'view_count' => 0
            ];

            $taskId = $this->Taskhub_model->create($task_data);

            $data_participant = [
                'task_id' => $taskId,
                'user_id' => $post['user_id'],
                'is_assigned' => 1
            ];

            $this->Taskhub_participants_model->create($data_participant);

            $is_success = 1;
            $msg = '';

        }else{
            $msg = 'Please enter subject';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);  
	}

	public function ajax_complete_task()
	{
		$this->load->model('Taskhub_model');
        $this->load->model('Taskhub_status_model');   

        $cid = logged('company_id');
        $uid = logged('id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();  
        $taskHub = $this->Taskhub_model->getById($post['tsid']);

        if( $taskHub && $taskHub->company_id == $cid ){
        	if( $taskHub->status_id == 6 ){
        		$msg = 'Task is already completed!';
        	}else{
        		$data = ['status_id' => 6];
	        	$this->Taskhub_model->updateByTaskId($taskHub->task_id, $data);

				//Activity Logs
				$activity_name = 'Completed Task ' . $taskHub->subject; 
				createActivityLog($activity_name);

	        	//SMS Notification
	        	$taskStatus   = $this->taskhub_status_model->getById(6);
	        	$taskAssigned = $this->taskhub_participants_model->getIsAssignedByTaskId($taskHub->task_id);
	        	if( $taskAssigned ){
	        		createCronAutoSmsNotification($cid, $taskHub->task_id, 'taskhub', $taskStatus->status_text, $taskHub->created_by, $taskAssigned->user_id);
	        	}else{
	        		createCronAutoSmsNotification($cid, $taskHub->task_id, 'taskhub', $taskStatus->status_text, $taskHub->created_by);
	        	}

	        	$msg ='';
	        	$is_success = 1;
        	}        	
        }
 
		$json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);  
	}

	public function ajax_company_complete_all_tasks()
	{
		$this->load->model('Taskhub_model');
        $this->load->model('Taskhub_status_model');   

        $cid = logged('company_id');
        $uid = logged('id');

        $is_success = 0;
        $msg = '';

        $post = $this->input->post();          
        if( $post['selected_customer_id'] > 0 ){
        	$uncompletedTasks = $this->Taskhub_model->getAllNotCompletedTasksByCustomerId($post['selected_customer_id']);
	        if( count($uncompletedTasks) > 0 ){
	        	$this->Taskhub_model->completeAllTasksByProfId($post['selected_customer_id']);

				//Activity Logs
				$activity_name = 'Updated all Tasks to Completed'; 
				createActivityLog($activity_name);

	        	$is_success = 1;
	        	$msg = '';
	        }else{
	        	$msg = 'All tasks are already completed. No task to update.';
	        }
        }else{
        	$uncompletedTasks = $this->Taskhub_model->getAllNotCompletedTasksByCompanyId($cid);
	        if( count($uncompletedTasks) > 0 ){
	        	$this->Taskhub_model->completeAllTasksByCompanyId($cid);

	        	$is_success = 1;
	        	$msg = '';
	        }else{
	        	$msg = 'All tasks are already completed. No task to update.';
	        }	
        }

		$json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);  
	}

	public function ajax_complete_selected_tasks()
	{
		$this->load->model('Taskhub_model');
        $this->load->model('Taskhub_status_model');   

        $cid = logged('company_id');
        $uid = logged('id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();          
        if( $post['taskId'] ){
        	$tasks = $this->Taskhub_model->getAllByTaskIds($post['taskId']);			
	        if( $tasks ){
				$task_ids = implode(",", $post['taskId']);
	        	$this->Taskhub_model->completeAllTasksByTaskId($post['taskId']);

				//Activity Logs
				$activity_name = 'Updated selected tasks id ' . $task_ids . ' to Completed'; 
				createActivityLog($activity_name);

	        	$is_success = 1;
	        	$msg = '';
	        }
        }
 
		$json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);  
	}

	public function ajax_ongoing_selected_tasks()
	{
		$this->load->model('Taskhub_model');
        $this->load->model('Taskhub_status_model');   

        $cid = logged('company_id');
        $uid = logged('id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();          
        if( $post['taskId'] ){
        	$tasks = $this->Taskhub_model->getAllByTaskIds($post['taskId']);			
	        if( $tasks ){
				$task_ids = implode(",", $post['taskId']);
	        	$this->Taskhub_model->onGoingAllTasksByTaskId($post['taskId']);

				//Activity Logs
				$activity_name = 'Updated selected tasks id ' . $task_ids . ' to Ongoing'; 
				createActivityLog($activity_name);

	        	$is_success = 1;
	        	$msg = '';
	        }
        }
 
		$json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);		
	}

	public function ajax_delete_task()
	{
		$this->load->model('Taskhub_model');

        $cid = logged('company_id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();  
        $taskHub = $this->Taskhub_model->getById($post['tsid']);

        if( $taskHub && $taskHub->company_id == $cid ){
			$this->Taskhub_model->deleteByTaskId($taskHub->id);

			//Activity Logs
			$activity_name = 'Deleted Task ' . $taskHub->subject; 
			createActivityLog($activity_name);

        	$msg ='';
	        $is_success = 1;   	
        }
 
		$json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);  
	}

	public function ajax_delete_selected_tasks()
	{
		$this->load->model('Taskhub_model'); 

        $cid = logged('company_id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $post_data = $this->input->post();		

		if(!empty($post_data) && isset($post_data['taskId'])) {
			foreach($post_data['taskId'] as $id) {
				$taskHub = $this->Taskhub_model->getById($id);
				if( $taskHub && $taskHub->company_id == $cid ){			
					$this->Taskhub_model->deleteByTaskId($taskHub->task_id);
	
					//Activity Logs
					$activity_name = 'Deleted Task ' . $taskHub->subject; 
					createActivityLog($activity_name);
		
					$msg = 'Delete tasks successful.';
					$is_success = 1;   	
				}
			}

			$json_data = ['is_success' => 1, 'msg' => $msg];
			echo json_encode($json_data);  			
		} else {
			$json_data = ['is_success' => 0, 'msg' => 'No selected task'];
			echo json_encode($json_data);  			

		}


	}
}
?>
