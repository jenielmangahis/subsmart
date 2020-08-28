<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FormBuilder extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_builder');
		
		
		$this->page_data['page']->title = 'Form Builder';
		$this->page_data['page']->menu = 'Builder';
		$this->load->model('FormsBuilder_model', 'formsbuilder_model');

		add_css(array(
			'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
			'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css',
			'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css',
			'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css'
		));

		add_footer_js(array(
			'https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js',
			'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
			'assets/js/formbuilder.js'
		));

		if(!isset($_GET['st'])){
			$this->checkLogin();
			$this->load->library('session');
			$user_id = getLoggedUserID();
		}
		// $this->checkLogin();
		// $this->load->library('session');
		// $user_id = getLoggedUserID();

		// concept
		$uid = $this->session->userdata('uid');

		if(empty($uid)){
				$this->page_data['uid'] = md5(time());
				$this->session->set_userdata(['uid' => $this->page_data['uid']]);
		}else{
			$uid = $this->session->userdata('uid');
			$this->page_data['uid'] = $uid;
		}
	}

	
	
	// VIEWS
	public function index(){	
		$this->page_data["forms"] = $this->formsbuilder_model->getForms();
		$this->load->view('form_builder/index.php', $this->page_data);
	}
	
	public function create(){
		$this->load->view('form_builder/create.php', $this->page_data);
	}
	
	public function edit($id){
		$this->page_data["form"] = $this->formsbuilder_model->getForms($id);
		$this->page_data["elements"] = $this->formsbuilder_model->getFormElements($id);
		$this->page_data["answers"] = $this->formsbuilder_model->getAnswers($id);
		if(empty($this->page_data["form"])){
			redirect('/formbuilder');
		}
		$this->load->view('form_builder/edit.php', $this->page_data);
	}
	
	public function view($form_id){
		$this->page_data["form"] = $this->formsbuilder_model->getForms($form_id);
		$this->page_data["elements"] = $this->formsbuilder_model->getFormElements($form_id);
		$this->load->view('form_builder/view.php', $this->page_data);
	}



	// METHODS 
	public function getForms($id = null){
		$data =  array(
			"status" => 1,
			"data" => $this->formsbuilder_model->getForms($id)
		);
		echo json_encode($data);
		exit;
	}

	public function addForm(){
		$query = $this->formsbuilder_model->addNewForm($this->input->post());
		$data =  array(
			"status" => 1,
			"id" => $query["id"]
		);
		echo json_encode($data);
		exit;
	}

	public function updateForm($form_id){
		$query = $this->formsbuilder_model->updateFormSettings($form_id, $this->input->post());
		$data = array(
			"status" => 1
		);
		echo json_encode($data);
		exit;
	}

	public function getFormElements($form_id = null, $element_id = null){
		
		$data =  array(
			"status" => 1,
			"data" => $this->formsbuilder_model->getFormElements($form_id, $element_id)
		);
		if(is_array($data['data'])){
			usort($data['data'], function($a, $b){
				return ($a->fe_order > $b->fe_order);
			});
		}
		echo json_encode($data);
		exit;
	}

	public function addFormElement(){
		$query = $this->formsbuilder_model->addFormElement($this->input->post());
		$data = array(
			"status" => 1
		);
		echo json_encode($data);
		exit;
	}

	public function updateFormElement($element_id){
		$query = $this->formsbuilder_model->updateFormElement($element_id, $this->input->post());
		$data = array(
			"status" => 1
		);
		echo json_encode($data);
		exit;
	}

	public function deleteFormElement($element_id){
		$this->formsbuilder_model->deleteFormElement($element_id);
		$this->formsbuilder_model->deleteAnswers("fa_element_id", $element_id);
		$data = array(
			"status" => 1
		);
		echo json_encode($data);
		exit;
	}

	public function submitForm($form_id){
		
		// var_dump($this->input->post());
		// var_dump($_FILES);

		$sid = rand(100000000,999999999);
		foreach($this->input->post() as $key => $answer){
			echo "<pre>";
			$data = array(
				"fa_form_id" => $form_id,
				"fa_element_id" => explode('-', $key)[1],
				"fa_value" => $answer,
				"fa_session_id" => $sid
			);
			$this->formsbuilder_model->submitAnswers($data);
		}
		redirect('form/'.$form_id);
		exit;
	}
	
	public function getAnswers($form_id){
		$data = array(
			"status" => 1,
			"data" => $this->formsbuilder_model->getAnswers($form_id)
		);
		echo json_encode($data);
		exit;
	}

}