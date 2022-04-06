<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends MY_Model {


	public function __construct(){
		parent::__construct();
	}

	public function add($data){
		$this->db->insert('survey', $data);
		$insert_id = $this->db->insert_id();

		$this->db->select('*');
		$this->db->where('id', $insert_id);
		$query = $this->db->get('survey');
		return $query->row();
	}

	public function delete($id){
		$this->db->where('id', $id);
		return $this->db->delete('survey');
	}

	public function list(){
		$this->db->select('*');
		$query = $this->db->get('survey');
		return $query->result();
	}

	public function view($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('survey');

		return $query->row();
	}

	public function update($id, $data){
		// $this->db->select('*');
		$this->db->set($data);
		$this->db->where('id', $id);
		$this->db->update('survey', $data);
	}

	public function addQuestion($id, $tid){

		$this->db->select('*');
		$this->db->where('id', $tid);
		$query = $this->db->get('survey_template_questions');
		$template = $query->row();
			$data = array(
		'survey_id' => $id,
		'question' => $template->question,
		'template_id' => $tid
		);
		
		$this->db->insert('survey_questions', $data);
		$insert_id = $this->db->insert_id();

			$data_option = array(
				'survey_template_choice' => $template->answer,
				'survey_template_id' => $insert_id,
			);
			$this->db->insert('survey_template_answer', $data_option);
			$tinsert_id = $this->db->insert_id();

			if($tid == 4){
				$test = '<div class="input-group input-content mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input name="choices_label_'.$tinsert_id.'" type="text" class="form-control"  value="">
					</div>';
			}elseif($tid == 3) {
				$test = '<div class="input-group input-content mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input name="options" type="radio" aria-label="Radio button for following text input">
							</div>
						</div>
						<input name="choices_label_'.$tinsert_id.'" type="text" class="form-control">
					</div>';
			}elseif($tid == 15) {
				$test = '<div class="form-group input-content">
						<input type="text" class="form-control" name="choices_label_'.$tinsert_id.'" value="" placeholder="Enter your answer">
				</div>';
			}else{
				$test = '';
			}

			$data = array(
				'id'=> $insert_id,
				'tid' => $tid,
				'data' => $template->answer,
				'test' => $test,
				'question' => $template->question,
				'template_title' => $template->type
			);
		return $data;
	}

	// new
	public function addAndUpdateQuestion($id, $tid){
		$this->db->select('*');
		$this->db->where('id', $tid);
		$query = $this->db->get('survey_template_questions');
		$template = $query->row();
			$data = array(
		'survey_id' => $id,
		'question' => $this->input->post('question'),
		'order' => $this->input->post('order'),
		'template_id' => $tid,
		'required' => $this->input->post('required'),
		'description' => $this->input->post('description'),
		'description_label' => $this->input->post('description_label')
		);
		
		$this->db->insert('survey_questions', $data);
		$insert_id = $this->db->insert_id();

		$data = array(
			'id'=> $insert_id,
			'tid' => $tid,
			'data' => $template->answer,
			'question' => $template->question,
			'template_title' => $template->type
		);
		return $data;
	}

	// new
	public function addAndUpdateQuestionChoices($choices){
		foreach($choices as $choice){
			$data_option = array(
				'survey_template_choice' => $template->answer,
				'survey_template_id' => $insert_id,
			);
			$this->db->insert('survey_template_answer', $data_option);
			$tinsert_id = $this->db->insert_id();

			if($tid == 4){
				$test = '<div class="input-group input-content mb-3">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" aria-label="Checkbox for following text input">
							</div>
						</div>
						<input name="choices_label_'.$tinsert_id.'" type="text" class="form-control"  value="">
					</div>';
			}elseif($tid == 3) {
				$test = '<div class="input-group input-content mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
							<input name="options" type="radio" aria-label="Radio button for following text input">
							</div>
						</div>
						<input name="choices_label_'.$tinsert_id.'" type="text" class="form-control">
					</div>';
			}elseif($tid == 15) {
				$test = '<div class="form-group input-content">
						<input type="text" class="form-control" name="choices_label_'.$tinsert_id.'" value="" placeholder="Enter your answer">
				</div>';
			}else{
				$test = '';
			}
		}
		return;
	}

	public function saveTemplateQuestionChoices($id, $choices){
		foreach($choices as $choice){
			$data_option = array(
				"survey_template_id" => $id,
				"choices_label" => $choice
			);
			$this->db->insert('survey_template_answer', $data_option);
		}
		return;
	}

	public function getQuestions($id){
		$this->db->select('*');
		$this->db->where('survey_id', $id);
		$this->db->order_by('order', 'ASC');
		$query = $this->db->get('survey_questions');

			$check = array_map( function($data){
				$this->db->select('*');
				$this->db->where('survey_template_id', $data->id);
				$query = $this->db->get('survey_template_answer');
				$data->questions = $query->result();

				$this->db->select('*');
				$this->db->where('id', $data->template_id);
				$template = $this->db->get('survey_template_questions');
				$data->template_title = $template->row()->type;
				$data->template_icon = $template->row()->icon;
				$data->template_color = $template->row()->color;
				
				$this->db->select('*');
				$this->db->where('question_id', $data->id);
				$survey_answer = $this->db->get('survey_answer');
				$data->survey_answer = $survey_answer->result();
				if($data->template_id == 3){
					foreach ($data->questions as $key => $value) {
						$token = array_map(function($data){
							$test = '<div class="input-group input-content mb-2">
							<div class="input-group-prepend">
							<div class="input-group-text">
							<input name="options" type="radio" aria-label="Radio button for following text input">
							</div>
							</div>
							<input name="choices_label_'.$data->id.'" type="text" class="form-control" value="'.$data->choices_label.'">
						</div>';
							$data->questions = "";
							$data->survey_template_choice = $test;
							return $data;
						},$data->questions);

					}
				}elseif($data->template_id == 4){
					$token = array_map(function($data){
						$test = '<div class="input-group input-content mb-3">
							<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" aria-label="Checkbox for following text input">
							</div>
							</div>
							<input name="choices_label_'.$data->id.'" type="text" class="form-control"  value="'.$data->choices_label.'">
						</div>';
						$data->questions = "";
						$data->survey_template_choice = $test;
						return $data;
					},$data->questions);
			}elseif($data->template_id == 15){
					$token = array_map(function($data){
						$test = '<div class="form-group">
								<input name="choices_label_'.$data->id.'" type="text" class="form-control"  value="'.$data->choices_label.'">
							</div>';
						$data->questions = "";
						$data->survey_template_choice = $test;
						return $data;
					},$data->questions);
				}
				return $data;
			}, $query->result());
			
		return $check;
	}
	public function getQuestionsPreview($id){
		$this->db->select('*');
		$this->db->where('survey_id', $id);
		$this->db->order_by('order', 'ASC');
		$query = $this->db->get('survey_questions');

			$check = array_map( function($data){
				
				$this->db->select('*');
				$this->db->where('survey_template_id', $data->id);
				$query = $this->db->get('survey_template_answer');
				$data->questions = $query->result();
				$this->db->select('*');
				$this->db->where('id', $data->template_id);
				$template = $this->db->get('survey_template_questions');
				

				$data->template_title = $template->row()->type;
				if($data->template_id == 3){
					foreach ($data->questions as $key => $value) {
						$token = array_map(function($data){
						$test = '<div class="form-check input-content">
						<input name="answer[]" value="'. $data->choices_label .'" class="form-check-input" type="radio" id="gridRadios'. $data->id .'">
						<label class="form-check-label" for="gridRadios'. $data->id .'">
							'.$data->choices_label.'
						</label>
						</div>';
							$data->questions = "";
							$data->survey_template_choice = $test;
							return $data;
						},$data->questions);

					}
				}elseif($data->template_id == 15){
					$token = array_map(function($data){
						$test = '<option value="'.$data->choices_label.'">'.$data->choices_label.'</option>';
						$data->questions = "";
						$data->survey_template_choice = $test;
						return $data;
					},$data->questions);

				}elseif($data->template_id == 4){
					$token = array_map(function($data){
							$test = '<div class="form-check input-content">
							<input name="answer[]" value="'. $data->choices_label .'" class="form-check-input" type="checkbox" id="gridCheck'. $data->id .'">
							<label class="form-check-label" for="gridCheck'.  $data->id  .'">
							'.$data->choices_label.'
							</label>
						</div>';
						$data->questions = "";
						$data->survey_template_choice = $test;
						return $data;
					},$data->questions);
				}
				return $data;
			}, $query->result());

		return $check;
	}

	public function saveAnswer($post, $files, $id){
		$this->load->helper('file');
		$this->load->library('upload');
		foreach ($post as $key => $value) {
			
				if($key == 'timer'){
					$this->db->select('*');
					$this->db->where('id', $id);
					$result_time = $this->db->get('survey');
					$count = $result_time->row()->count + 1;
					$time = (int)$value + (int)$result_time->row()->count_timer;
					$timer = array(
						'count_timer' => $time,
						'count' => $count
					);
					$this->db->where('id', $id);
					$this->db->update('survey', $timer);
				}else{
					if(isset(explode('-', $key)[1])){
						$question_id = explode('-', $key)[1];
						$datas = array(
							'answer' => $value,
							'survey_id' => $id,
							'question_id' => (int)$question_id,
							'session_id' => $post["session"]
						);
						$this->db->insert('survey_answer',$datas);
					}
				}
		}
		if($files){
			foreach ($files as $key => $value) {
				$question_id = explode('-', $key)[1];
				$path = 'uploads/survey';
			$config = [
				'upload_path' 		=> $path,
				'allowed_types' 	=> '*',
				'overwrite' 		=> false
			];
			$test = $this->upload->initialize($config);
			if ( ! $this->upload->do_upload('answer-'.$question_id.'') ){

				}else{
				$upload_data = $this->upload->data();
			}
			$datas = array(
				'answer' => $value['name'],
				'survey_id' => $id,
				'question_id' => $question_id
			);
				$this->db->insert('survey_answer',$datas);
			}
		}
		return TRUE;
	}

	public function addQuestionImage($id, $data){
		$this->db->where('id', $id);
		$this->db->update('survey_questions', $data);
		return TRUE;
	}
	
	public function updateQuestion($id, $data, $all_data){
			$this->db->select('*');
			$this->db->where('id', $all_data['survey_id']);
			$survey = $this->db->get('survey_questions');

			if($survey->row()->template_id == 4 || $survey->row()->template_id == 3  || $survey->row()->template_id == 15){
				$this->db->select('*');
				$this->db->where('survey_template_id', $all_data['survey_id']);
				$templates = $this->db->get('survey_template_answer');
				foreach ($templates->result() as $template) {
					$ids = $template->id;
					$datas = array(
						'choices_label' => $_POST['choices_label_'.$ids.'']
					);
					$this->db->where('id', $ids);
					$this->db->update('survey_template_answer', $datas);
				}
			}

		$this->db->where('id', $id);
		return $this->db->update('survey_questions', $data);
	}

	public function getTemplateQuestions(){
		$this->db->select('*');
		$query = $this->db->get('survey_template_questions');
		return $query->result();
	}

	public function deleteQuestion($id, $condition = null){
		if($condition == null){
			$this->db->where('id', $id);
		}else{
			switch($condition){
				case 'survey':
					$this->db->where('survey_id', $id);
					break;
				default:
					break;
			}
		}
		return $this->db->delete('survey_questions');
	}

	public function addQuestionChoice($id, $tid){
		$this->db->where('id', $tid);
		$query1 = $this->db->get('survey_template_questions');
		
		$update_data = array(
			'survey_template_id' => $id
		);
		

		$query = $this->db->insert('survey_template_answer', $update_data);
		$insert_id = $this->db->insert_id();
		if($tid == 4){
			$test = '<div class="d-flex w-100 justify-content-between choice-container q-choice-container-'.$insert_id.'" style="margin:10px 0px; height:44px;">
			<div class="input-group mb-3">
					<div class="input-group-prepend">
						<div class="input-group-text">
							<input type="checkbox" aria-label="Checkbox for following text input">
						</div>
					</div>
					<input name="choices_label_'.$insert_id.'" type="text" class="form-control"  value="">					
				</div><button id="btn-delete-option" data-id="'.$insert_id.'" class="btn btn-outline-danger btn-delete-choice" type="button" name="button"><i class="fa fa-trash"></i></button></div>';
		}elseif($tid == 15){
			$test = '
			<div class="d-flex w-100 justify-content-between choice-container q-choice-container-'.$insert_id.'" style="margin:10px 0px; height:44px;">
			<div class="form-group">
					<input name="choices_label_'.$insert_id.'" type="text" class="form-control" value="">					
				 </div><button id="btn-delete-option" data-id="'.$insert_id.'" class="btn btn-outline-danger btn-delete-choice" type="button" name="button"><i class="fa fa-trash"></i></button></div>';
		}else {
			$test = '<div class="d-flex w-100 justify-content-between choice-container q-choice-container-'.$insert_id.'" style="margin:10px 0px; height:44px;">
			<div class="input-group mb-2">
					 <div class="input-group-prepend">
						<div class="input-group-text">
						<input name="options" type="radio" aria-label="Radio button for following text input">
						</div>
					</div>
					<input name="choices_label_'.$insert_id.'" type="text" class="form-control">
				</div><button id="btn-delete-option" data-id="'.$insert_id.'" class="btn btn-outline-danger btn-delete-choice" type="button" name="button"><i class="fa fa-trash"></i></button></div>';
		}

		return $test;
	}

	public function orderUpdate($data){
		if( $data ){
			foreach($data as $key => $id){
				$data = array(
					'order' => $key
				);
				$this->db->where('id', $id);
				$this->db->update('survey_questions', $data);
			}
		}		
		return TRUE;
	}

	public function addQuestionSettings($data, $id){
		$this->db->where('id', $id);
		return $this->db->update('survey_questions', $data);
	}

	public function getThemes($id = null){
		$this->db->select("*");		

		if($id !== null){
			
			$this->db->where('sth_rec_no', $id);
			return $this->db->get('survey_themes')->row();
			exit;
		}else{	
			return $this->db->get('survey_themes')->result(); 
		}
	}

	public function getThemesByCompanyIdAndIsDefault($company_id){
		$this->db->select("*");		
		$this->db->where('company_id', $company_id);
		$this->db->or_where('company_id', 0);
		return $this->db->get('survey_themes')->row();
	}

	public function addTheme($data){
		$this->db->insert('survey_themes', $data);
		$insert_id = $this->db->insert_id();

		$this->db->select('*');
		$this->db->where('id', $insert_id);
		$query = $this->db->get('survey');
		return $query->row();
	}

	public function updateTheme($id, $data){
		$this->db->where('sth_rec_no', $id);
		return $this->db->update('survey_themes', $data);
	}

	public function getWorkspaces($id = null){
		$this->db->select('*');
		if($id !== null){
			$this->db->where('id', $id);
		}

		
		$query = $this->db->get('survey_workspaces');
		foreach($query->result() as $q){
			
			$this->db->select('*');
			$this->db->where('workspace_id',$q->id);
			$query2 = $this->db->get('survey');
			$q->surveys = $query2->result();

			foreach($q->surveys as $q2){
				$q2->survey_theme = $this->getThemes($q2->theme_id);
			}
		}
		return $query->result();
	}

	public function getWorkspacesByCompanyId($company_id){
		$this->db->select('*');
		$this->db->where('company_id', $company_id);
		$query = $this->db->get('survey_workspaces');
		foreach($query->result() as $q){
			
			$this->db->select('*');
			$this->db->where('workspace_id',$q->id);
			$query2 = $this->db->get('survey');
			$q->surveys = $query2->result();

			foreach($q->surveys as $q2){
				$q2->survey_theme = $this->getThemes($q2->theme_id);
			}
		}
		return $query->result();
	}

	public function addWorkspace($data){
		$this->db->insert('survey_workspaces', $data);
		return $this->db->insert_id();
	}

	public function deleteWorkspace($id){
		return $this->db->delete('survey_workspaces', array('id'=>$id));
	}

	public function deleteSurveyTemplateAnswer($id){
		return $this->db->delete('survey_template_answer', array('id'=>$id));
	}

	public function editWorkspace($id, $data){
		$workspaceChange = array(
			"name" => $data["name"]
		);
		$this->db->where('id', $id);
		return $this->db->update('survey_workspaces', $workspaceChange);
	}

	// logic jumps
	public function getSurveyLogics($survey_id){
		$this->db->select('*');
		$this->db->where('sl_survey_id', $survey_id);
		$query = $this->db->get('survey_logic');
		return $query->result();
		
	}

	public function addToSurveyLogic($data){
		$this->db->insert('survey_logic', $data);
		return $this->db->insert_id();
	}
	



}
