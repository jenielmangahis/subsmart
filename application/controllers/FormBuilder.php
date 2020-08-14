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
		if(empty($this->page_data["form"])){
			redirect('/formbuilder');
		}
		$this->load->view('form_builder/edit.php', $this->page_data);
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

	
}