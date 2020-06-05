<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Builder extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->checkLogin();
		$this->page_data['page']->title = 'Builder';
		$this->page_data['page']->menu = 'roles';
		$this->load->model('Builder_model', 'builder_model');
	}

	public function index($id = '')
	{
		$this->page_data['jobs'] = $this->builder_model->get_jobs();
		$this->page_data['forms'] = $this->builder_model->get_forms();
		
		if($this->input->get('form_id') > 0)
		{
			$this->page_data['selected_form_id'] = $this->input->get('form_id');
		}
		// $this->page_data['custom_forms'] = $this->builder_model->get_jobs_forms(1);
		// $this->page_data['jobs'] = $this->builder_model->get_form_groups(1);

		// echo "<pre>";
		// print_r($this->page_data);

		$this->load->view('builder/add', $this->page_data);
	}

	function formdetail($id) {


		$formdetail = $this->builder_model->get_forms($id);
		$questions = $this->builder_model->get_forms_questions($id);
		$formdetail->questions = $questions;
		foreach ($formdetail->questions as $key => $value) {
			if($value->parameter != '') {
				$formdetail->questions[$key]->parameter = json_decode($value->parameter);
			}

			if($value->q_type == 'selection')
			{
				$formdetail->questions[$key]->options = $this->builder_model->get_forms_questions_options($value->Questions_id);
			}
		}
		die(json_encode($formdetail));
	}

	function saveform() {

		$form_id = '0';
		if($this->input->post('form_id') == "new")
		{
			$data = array(
				'form_title'=> $this->input->post('form_title'),
				'created'=> date('Y-m-d H:i:s'),
				'created_by'=> logged('id'),
				'company_id'=> logged('company_id'),
			);
			$this->db->insert( $this->builder_model->table_custom_forms, $data);
			$form_id = $this->db->insert_id();
		} else {
			$form_id = $this->input->post('form_id');
			$data = array(
				'form_title'=> $this->input->post('form_title')
			);
			$this->db->where('forms_id', $this->input->post('form_id'));
			$this->db->update( $this->builder_model->table_custom_forms, $data);
		}

		$questions = $this->input->post('questions');

		if(!empty($questions)) {

			foreach($questions as $key => $value)
			{
				if($value['q_type'] == 'group') {

					$data = array (
						'question'=> $value['question'],
						'q_type'=> $value['q_type'],
						'description'=> $value['description'],
						'forms_id'=> $form_id,
						'question_order'=> $value['question_order'],
						'parent_question'=> ((isset($value['parent_question']) && $value['parent_question'] !='' && $value['parent_question'] > 0)?$value['parent_question']:'null'),
						'parameter'=> (isset($value['parameter']))?json_encode($value['parameter']):"",
						'conditions'=> $value['conditions'],
						'style'=> $value['style'],
						'company_id'=> logged('company_id'),
					);
					$parentQuestionId = 0;
					if($value['Questions_id'] > 0) {
						$this->db->where('Questions_id', $value['Questions_id']);
						$this->db->update( $this->builder_model->table_questions, $data);
						$parentQuestionId = $value['Questions_id'];
					} else {
						$this->db->insert( $this->builder_model->table_questions, $data);
						$parentQuestionId = $this->db->insert_id();
					}
					if(isset($value['questions']))
					{
						foreach($value['questions'] as $keySubQuestions => $valueSubQuestions)
						{
							$data = array (
								'question'=> $valueSubQuestions['question'],
								'q_type'=> $valueSubQuestions['q_type'],
								'description'=> $valueSubQuestions['description'],
								'forms_id'=> $form_id,
								'question_order'=> $valueSubQuestions['question_order'],
								'parent_question'=> $parentQuestionId,
								'parameter'=> (isset($valueSubQuestions['parameter']))?json_encode($valueSubQuestions['parameter']):'',
								'conditions'=> $valueSubQuestions['conditions'],
								'style'=> $valueSubQuestions['style'],
								'company_id'=> logged('company_id'),
							);
							$lastQuestionId = 0;
							if($valueSubQuestions['Questions_id'] > 0)
							{
								$this->db->where('Questions_id', $valueSubQuestions['Questions_id']);
								$this->db->update( $this->builder_model->table_questions, $data);
								$lastQuestionId = $valueSubQuestions['Questions_id'];
							} else {
								$this->db->insert( $this->builder_model->table_questions, $data);
								$lastQuestionId = $this->db->insert_id();
							}

							if(isset($valueSubQuestions['options']))
							{	
								
								foreach($valueSubQuestions['options'] as $keySubQuestionsOptions => $valueSubQuestionsOptions)
								{
									
									$dataOptions = array (
										'options_id'=> $valueSubQuestionsOptions['options_id'],
										'question_id'=> $lastQuestionId,
										'options'=> $valueSubQuestionsOptions['options'],
										'option_value'=> $valueSubQuestionsOptions['option_value'],
										'option_order'=> $valueSubQuestionsOptions['option_order'],
										'create_date'=> date('Y-m-d'),
									);
									if($valueSubQuestionsOptions['options_id'] > 0)
									{
										$this->db->where('options_id', $valueSubQuestionsOptions['options_id']);
										$this->db->update( $this->builder_model->table_options,$dataOptions);
									} else {
										$this->db->insert( $this->builder_model->table_options,$dataOptions);
									}
								}
							}

							if(isset($valueSubQuestions['deletedOptions']) && $valueSubQuestions['deletedOptions'] !='')
							{
								$deletedOptions = explode(",",$valueSubQuestions['deletedOptions']);
								if (!empty($deletedOptions)) {
									$this->db->where_in('options_id', $deletedOptions);
		        					$this->db->delete($this->builder_model->table_options);
		    					}
							}
						}
					}



				} else if($value['q_type'] == 'reperator') {

					$data = array (
						'question'=> $value['question'],
						'q_type'=> $value['q_type'],
						'description'=> $value['description'],
						'forms_id'=> $form_id,
						'question_order'=> $value['question_order'],
						'parent_question'=> ((isset($value['parent_question']) && $value['parent_question'] !='' && $value['parent_question'] > 0)?$value['parent_question']:'null'),
						'parameter'=> (isset($value['parameter']))?json_encode($value['parameter']):"",
						'conditions'=> $value['conditions'],
						'style'=> $value['style'],
						'company_id'=> logged('company_id'),
					);
					$parentQuestionId = 0;
					if($value['Questions_id'] > 0) {
						$this->db->where('Questions_id', $value['Questions_id']);
						$this->db->update( $this->builder_model->table_questions, $data);
						$parentQuestionId = $value['Questions_id'];
					} else {
						$this->db->insert( $this->builder_model->table_questions, $data);
						$parentQuestionId = $this->db->insert_id();
					}
					if(isset($value['questions']))
					{
						foreach($value['questions'] as $keySubQuestions => $valueSubQuestions)
						{
							$data = array (
								'question'=> $valueSubQuestions['question'],
								'q_type'=> $valueSubQuestions['q_type'],
								'description'=> $valueSubQuestions['description'],
								'forms_id'=> $form_id,
								'question_order'=> $valueSubQuestions['question_order'],
								'parent_question'=> $parentQuestionId,
								'parameter'=> (isset($valueSubQuestions['parameter']))?json_encode($valueSubQuestions['parameter']):'',
								'conditions'=> $valueSubQuestions['conditions'],
								'style'=> $valueSubQuestions['style'],
								'company_id'=> logged('company_id'),
							);
							$lastQuestionId = 0;
							if($valueSubQuestions['Questions_id'] > 0)
							{
								$this->db->where('Questions_id', $valueSubQuestions['Questions_id']);
								$this->db->update( $this->builder_model->table_questions, $data);
								$lastQuestionId = $valueSubQuestions['Questions_id'];
							} else {
								$this->db->insert( $this->builder_model->table_questions, $data);
								$lastQuestionId = $this->db->insert_id();
							}

							if(isset($valueSubQuestions['options']))
							{	
								
								foreach($valueSubQuestions['options'] as $keySubQuestionsOptions => $valueSubQuestionsOptions)
								{
									
									$dataOptions = array (
										'options_id'=> $valueSubQuestionsOptions['options_id'],
										'question_id'=> $lastQuestionId,
										'options'=> $valueSubQuestionsOptions['options'],
										'option_value'=> $valueSubQuestionsOptions['option_value'],
										'option_order'=> $valueSubQuestionsOptions['option_order'],
										'create_date'=> date('Y-m-d'),
									);
									if($valueSubQuestionsOptions['options_id'] > 0)
									{
										$this->db->where('options_id', $valueSubQuestionsOptions['options_id']);
										$this->db->update( $this->builder_model->table_options,$dataOptions);
									} else {
										$this->db->insert( $this->builder_model->table_options,$dataOptions);
									}
								}
							}

							if(isset($valueSubQuestions['deletedOptions']) && $valueSubQuestions['deletedOptions'] !='')
							{
								$deletedOptions = explode(",",$valueSubQuestions['deletedOptions']);
								if (!empty($deletedOptions)) {
									$this->db->where_in('options_id', $deletedOptions);
		        					$this->db->delete($this->builder_model->table_options);
		    					}
							}
						}
					}



				} else {

					$data = array (
						'question'=> $value['question'],
						'q_type'=> $value['q_type'],
						'description'=> $value['description'],
						'forms_id'=> $form_id,
						'question_order'=> $value['question_order'],
						'parent_question'=> ((isset($value['parent_question']) && $value['parent_question'] !='' && $value['parent_question'] > 0)?$value['parent_question']:'null'),
						'parameter'=> isset($value['parameter'])?json_encode($value['parameter']):'',
						'conditions'=> $value['conditions'],
						'style'=> $value['style'],
						'company_id'=> logged('company_id'),
					);
					$lastQuestionId = 0;
					if($value['Questions_id'] > 0)
					{
						$this->db->where('Questions_id', $value['Questions_id']);
						$this->db->update( $this->builder_model->table_questions, $data);
						$lastQuestionId = $value['Questions_id'];
					} else {
						$this->db->insert( $this->builder_model->table_questions, $data);
						$lastQuestionId = $this->db->insert_id();
					}

					if(isset($value['options']))
					{	

						foreach($value['options'] as $keySubQuestionsOptions => $valueSubQuestionsOptions)
						{

							$dataOptions = array (
								'options_id'=> $valueSubQuestionsOptions['options_id'],
								'question_id'=> $lastQuestionId,
								'options'=> $valueSubQuestionsOptions['options'],
								'option_value'=> $valueSubQuestionsOptions['option_value'],
								'option_order'=> $valueSubQuestionsOptions['option_order'],
								'create_date'=> date('Y-m-d'),
							);
							if($valueSubQuestionsOptions['options_id'] > 0)
							{
								$this->db->where('options_id', $valueSubQuestionsOptions['options_id']);
								$this->db->update( $this->builder_model->table_options,$dataOptions);
							} else {
								$this->db->insert( $this->builder_model->table_options,$dataOptions);
							}
						}
					}

					if(isset($value['deletedOptions']) && $value['deletedOptions'] !='')
					{
						$deletedOptions = explode(",",$value['deletedOptions']);
						if (!empty($deletedOptions)) {
							$this->db->where_in('options_id', $deletedOptions);
        					$this->db->delete($this->builder_model->table_options);
    					}
					}

				}
			}

		}

		die(json_encode(array("form_id"=>$form_id)));

	}

	public function add()
	{
		ifPermissions('roles_add');
		$this->load->view('roles/add', $this->page_data);
	}

	public function saveFormResponse() {

		if($this->input->post('form_id')) {

			$questions = $this->input->post('question');

			if( isset ( $questions ) && !empty ( $questions ) ) {

				if(count($questions) > 0)
				{
					$data = array (
						'form_id' 		=> $this->input->post('form_id'),
						'job_id' 		=> $this->input->post('job_id'),
						'user_id' 		=> logged('id'),
						'company_id' 	=> logged('company_id'),
					);
					$this->db->insert( $this->builder_model->table_form_responses_rows, $data);
					$form_responses_rows_id = $this->db->insert_id();
				}

				foreach($questions as $key => $value) {

					$temp_value = (is_array($value)==true)?implode(",",$value):$value;

					$data = array (
						'key' 			=> $key,
						'value' 		=> $temp_value,
						'response_time' => date('Y-m-d H:i:s'),
						'user_id' 		=> logged('id'),
						'company_id' 	=> logged('company_id'),
						'job_id' 		=> $this->input->post('job_id'),
						'row_id' 		=> $form_responses_rows_id
					);

					$this->db->insert( $this->builder_model->table_form_responses, $data);
				} 

			}


		}

		redirect('builder/demo/'.$this->input->post('form_id'));

	}

	public function demo($id) {
		$formdetail = $this->builder_model->get_forms($id);

		$company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from($this->builder_model->table_questions);
        $this->db->order_by("question_order", "asc");
        $this->db->where('company_id', $company_id);
        $this->db->where('parent_question', 0);
        $this->db->where('forms_id', $id);
        $query = $this->db->get();
        $questions =  $query->result();
        

		$formdetail->questions = $questions;
		foreach ($formdetail->questions as $key => $value) {
			if($value->parameter != '') {
				$formdetail->questions[$key]->parameter = json_decode($value->parameter);
			}

			if($value->q_type == 'selection')
			{
				$formdetail->questions[$key]->options = $this->builder_model->get_forms_questions_options($value->Questions_id);
			} elseif ($value->q_type == 'group') {
		        $this->db->select('*');
		        $this->db->from($this->builder_model->table_questions);
		        $this->db->order_by("question_order", "asc");
		        $this->db->where('company_id', $company_id);
		        $this->db->where('parent_question', $value->Questions_id);
		        $this->db->where('forms_id', $id);
		        $query = $this->db->get();
		        $formdetail->questions[$key]->questions = $query->result();

		        foreach ($formdetail->questions[$key]->questions as $keySubQuestions => $valueSubQuestions) {
		        	if($valueSubQuestions->parameter != '') {
						$formdetail->questions[$key]->questions[$keySubQuestions]->parameter = json_decode($valueSubQuestions->parameter);
					}

					if($valueSubQuestions->q_type == 'selection')
					{
						$formdetail->questions[$key]->questions[$keySubQuestions]->options = $this->builder_model->get_forms_questions_options($valueSubQuestions->Questions_id);
					}
		        }
			} elseif ($value->q_type == 'reperator') {
		        $this->db->select('*');
		        $this->db->from($this->builder_model->table_questions);
		        $this->db->order_by("question_order", "asc");
		        $this->db->where('company_id', $company_id);
		        $this->db->where('parent_question', $value->Questions_id);
		        $this->db->where('forms_id', $id);
		        $query = $this->db->get();
		        $formdetail->questions[$key]->questions = $query->result();

		        foreach ($formdetail->questions[$key]->questions as $keySubQuestions => $valueSubQuestions) {
		        	if($valueSubQuestions->parameter != '') {
						$formdetail->questions[$key]->questions[$keySubQuestions]->parameter = json_decode($valueSubQuestions->parameter);
					}

					if($valueSubQuestions->q_type == 'selection')
					{
						$formdetail->questions[$key]->questions[$keySubQuestions]->options = $this->builder_model->get_forms_questions_options($valueSubQuestions->Questions_id);
					}
		        }
			}
		}	

		$this->page_data['formdetail'] = $formdetail; 
		$this->load->view('builder/demo', $this->page_data);
		// $this->load->view('roles/add', $this->page_data);
	}

}

/* End of file Roles.php */
/* Location: ./application/controllers/Roles.php */