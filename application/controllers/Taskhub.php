<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taskhub extends MY_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model(array('taskhub_model','taskhub_updates_model','taskhub_status_model','taskhub_participants_model','taskhub_comments_model'));
		
		$this->page_data['page']->menu = 'taskhub';
	}

	public function index(){
		$uid = logged('id');

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
			   'or a.assigned_to = ' . $uid . ' ' .
			   'or a.assigned_by = ' . $uid . ' ' .
			   'or not ISNULL(c.task_id) '.

			'group by a.task_id '.
			'order by a.date_created DESC, a.time_created DESC'
		)->result();

		$this->page_data['tasks'] = $tasks;

		$this->load->view('workcalender/taskhub/list', $this->page_data);
	}

	public function entry($id = 0){

		$uid = logged('id');
		$company_id = logged('company_id');

		$users_selection = $this->db->query(
			'select id, concat(FName, " ", LName) as `name` from users'
		);

		if($users_selection->num_rows() > 0){
			$this->page_data['users_selection'] = $users_selection->result();
		}

		$participants_add_filter = '';
		$taskid = trim($this->input->post('taskid'));
		if(($id > 0) || ($taskid > 0)){
			if($id > 0){
				$taskid = $id;
			}
			$this->page_data['task'] = $this->taskhub_model->getById($taskid);
			if($this->page_data['task']->created_by != $uid){
				$participants_add_filter = ' and user_id <> ' . $this->page_data['task']->created_by;
			}

			$this->page_data['status_selection'] = $this->taskhub_status_model->get();
			$this->page_data['selected_participants'] = $this->db->query(
															'select a.*, concat(b.FName, " ", b.LName) as `name` from tasks_participants a '.
															'left join users b on b.id = a.user_id '.
															'where a.task_id = ' . $taskid
														)->result();
		}

		$this->page_data['participants'] = $this->db->query('select id, concat(FName, " ", LName) as `name` from users where id <> ' . $uid . $participants_add_filter)->result();

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
				$status = $this->input->post('status');
				if(empty($status)){
					$status = 1;
				}

				$data = array(
					'subject' => $this->input->post('subject'),
					'description' => $this->input->post('description'),
					'assigned_to' => $assigned_to,
					'assigned_by' => $uid,
					'estimated_date_complete' => $this->input->post('estimated_date_complete'),
					'status_id' => $status
				);

				$process_successful = $this->taskhub_model->trans_update($data, array('task_id' => trim($taskid)));
			} else {
				$data = array(
					'subject' => $this->input->post('subject'),
					'description' => $this->input->post('description'),
					'created_by' => $uid,
					'date_created' => date('Y-m-d'),
					'time_created' => date('h:m:s'),
					'assigned_to' => $assigned_to,
					'assigned_by' => $uid,
					'estimated_date_complete' => $this->input->post('estimated_date_complete'),
					'status_id' => 1,
					'company_id' => $company_id
				);

				$process_successful = $this->taskhub_model->trans_create($data);
				if($process_successful){
					$task = $this->db->query(
						'select task_id from tasks where created_by = ' . $uid . ' and date_created = "' . date('Y-m-d') . '" order by time_created DESC limit 1'
					)->row();

					$taskid = $task->id;
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
								'user_id' => $participant
							);	

							array_push($data_participants, $data_participant);
						}

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
			'concat(c.FName, " ", c.LName) as `created_by_name`, '.
			'concat(d.FName, " ", d.LName) as `assigned_to_name` '.

			'from tasks a '.
			'left join tasks_status b on b.id = a.status '.
			'left join users c on c.id = a.created_by '.
			'left join users d on d.id = a.assigned_to '.

			'where a.id = '. $id
		)->row();

		$this->page_data['participants'] = $this->db->query(
			'select '.

			'a.*, '.
			'concat(b.FName, " ", b.LName) as `participant_name` '.

			'from tasks_participants a '.
			'left join users b on b.id = a.uid '.

			'where a.task_id = ' . $id
		)->result();

		$this->page_data['updates_and_comments'] = $this->db->query(
			'select '.

			'a.status_id, '.
			'a.assigned_to, '.
			'a.assigned_by, '.
			'a.last_updated_by, '.

			'b.status_text as `status`, '.
			'c.`username` as `assigned_to_name`, '.
			'd.`username` as `assigned_by_name`, '.
			'e.`username` as `last_updated_by_name`, '.

			'"" as `comment`, '.

			'a.date_updated as `update_date`, '.

			'1 as `is_update` '.

			'from tasks_updates a '.
			'left join tasks_status b on b.id = a.status_id '.
			'left join users c on c.id = a.assigned_to '.
			'left join users d on d.id = a.assigned_by '.
			'left join users e on e.id = a.last_updated_by '.
			'where a.task_id = '. $id . ' ' .
			'union all '.
			'select '.

			'0 as `status_id`, '.
			'0 as `assigned_to`, '.
			'0 as `assigned_by`, '.

			'a.uid as `last_updated_by`, '.

			'"" as `status`, '.
			'"" as `assigned_to_name`, '.
			'"" as `assigned_by_name`, '.

			'b.`username` as `last_updated_by_name`, '.

			'a.`comment`, '.
			'a.comment_date as `update_date`, '.

			'0 as `is_update` '.

			'from tasks_comments a '.
			'left join users b on b.id = a.uid '.
			'where a.task_id = '. $id . ' ' .
			'order by `update_date` ASC '	
		)->result();

		$this->load->view('workcalender/taskhub/view', $this->page_data);	
	}

	public function comment($id){

		$uid = logged('id');
		$comment = $_POST['comment'];

		$data = array(
			'task_id' => $id,
			'uid' => $uid,
			'comment' => $comment,
			'comment_date' => date('Y-m-d h:m:s')
		);

		if($this->taskhub_comments_model->trans_create($data)){
			$data['error'] = "";
			$data['username'] = logged('username');
			$comment_date = date_create($data['comment_date']);
			$data['comment_date'] = date_format($comment_date, 'F d, Y h:i:s');

		} else {
			$data = array('error' => "Error in creating comment");
		}

		echo json_encode($data);

	}
}

?>