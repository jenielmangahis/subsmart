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

	public function index(){
	$is_allowed = true;//$this->isAllowedModuleAccess(6);
        if( !$is_allowed ){
            $this->page_data['module'] = 'taskhub';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

		$this->page_data['tasks'] = getTasks();
		$this->page_data['status_selection'] = $this->taskhub_status_model->get();

		$this->load->view('workcalender/taskhub/list', $this->page_data);
	}

	public function entry($id = 0){

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
			$this->page_data['task'] = $this->taskhub_model->getById($taskid);

			$this->page_data['selected_participants'] = $this->db->query(
															'select a.*, concat(b.FName, " ", b.LName) as `name` from tasks_participants a '.
															'left join users b on b.id = a.user_id '.
															'where a.task_id = ' . $taskid
														)->result();
		}

		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('description', 'Description', 'trim|required');
		$this->form_validation->set_rules('estimated_date_complete', 'Estimated Date of Competion', 'trim|required');

		if($this->form_validation->run() == false){
			$this->load->view('workcalender/taskhub/entry', $this->page_data);
		} else {
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

				$data = array(
					'subject' => $this->input->post('subject'),
					'description' => $this->input->post('description'),
					'estimated_date_complete' => $this->input->post('estimated_date_complete'),
					'status_id' => $status
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
				}
			} else {
				$data = array(
					'subject' => $this->input->post('subject'),
					'description' => $this->input->post('description'),
					'created_by' => $uid,
					'date_created' => date('Y-m-d h:i:s'),
					'estimated_date_complete' => $this->input->post('estimated_date_complete'),
					'status_id' => 1,
					'company_id' => $company_id
				);

				$process_successful = $this->taskhub_model->trans_create($data);
				if($process_successful){
					$task = $this->db->query(
						'select task_id from tasks where created_by = ' . $uid . ' order by date_created DESC limit 1'
					)->row();

					$taskid = $task->task_id;
					$status = 1;
				}
			}

			if($process_successful){
				if($this->taskhub_participants_model->trans_delete(array(), array('task_id' => trim($taskid)))){
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

							array_push($data_participants, $data_participant);
						}

						$data_participant = array(
							'task_id' => trim($taskid),
							'user_id' => $assigned_to,
							'is_assigned' => 1
						);

						array_push($data_participants, $data_participant);

						$this->taskhub_participants_model->trans_create($data_participants, true);
					}
				}

				redirect('taskhub');
			} else {
				$this->page_data['error'] = 'Error creating task';
				$this->load->view('workcalender/taskhub/entry', $this->page_data);
			}
		}
	}

	public function view($id){
		$this->page_data['task'] = $this->db->query(
			'select '.

			'a.*, '.
			'b.status_text, '.
			'b.status_color, '.
			'concat(c.FName, " ", c.LName) as `created_by_name` '.

			'from tasks a '.
			'left join tasks_status b on b.status_id = a.status_id '.
			'left join users c on c.id = a.created_by '.

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

			'a.notes as `text`, '.
			'a.date_updated as `update_date`, '.
			'concat(b.FName, " ", b.LName) as `user`, '.

			'1 as `is_update` '.

			'from tasks_updates a '.
			'left join users b on b.id = a.performed_by '.
			'where a.task_id = '. $id . ' ' .
			'union all '.

			'select '.

			'a.comment as `text`, '.
			'a.comment_date as `update_date`, '.
			'concat(b.FName, " ", b.LName) as `user`, '.

			'0 as `is_update` '.

			'from comments a '.
			'left join users b on b.id = a.user_id '.
			'where a.relation_id = '. $id . ' ' .
			  'and a.type = "task" '.

			'order by `update_date` ASC '
		)->result();

		$sql = 'update tasks set view_count = view_count + 1 where task_id = ' . $id;

		$this->db->query($sql);

		$this->load->view('workcalender/taskhub/view', $this->page_data);
	}

	public function comment($id){
		$uid = logged('id');
		$company_id = logged('company_id');

		$comment = $_POST['comment'];

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
			$this->load->view('workcalender/taskhub/add_update', $this->page_data);
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

				$this->load->view('workcalender/taskhub/add_update', $this->page_data);
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

		if(isset($_POST['statusid'])){
			$status_id = $_POST['status'];
		}

		if(isset($_POST['fromdate'])){
			$from_date = $_POST['fromdate'];
		}

		if(isset($_POST['todate'])){
			$to_date = $_POST['todate'];
		}

		$result = getTasks(true, $keyword, $status_id, $from_date, $to_date);

		echo json_encode($result);
	}
}
?>
