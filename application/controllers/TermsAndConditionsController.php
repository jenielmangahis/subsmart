<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TermsAndConditionsController extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_builder');
		
		
		$this->page_data['page']->title = 'Terms and Conditions';
		// $this->page_data['page']->menu = 'Builder';
		$this->load->model('TermsAndConditions', 'TermsAndConditions');

		add_css(array(
			'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
			'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css',
			'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css',
			'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css',
			'assets/terms_and_conditions/css/kothing-editor.min.css',
			'assets/terms_and_conditions/css/main.css'
		));

		add_footer_js(array(
			'https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js',
			'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',
			'assets/terms_and_conditions/js/common.js',
			'assets/terms_and_conditions/js/katex.min.js',
			'assets/terms_and_conditions/js/kothing-editor.min.js',
			'assets/terms_and_conditions/js/main.js'
		));
    }
	
	public function getCompanyData() {
		$user = (object)$this->session->userdata('logged');		
		$cid=logged('id');
		$company = $this->business_model->getByWhere(array('id'=>$cid))[0];
		return $company;
	}

	public function getAll() {
		$company = $this->getCompanyData();
		$res = $this->TermsAndConditions->getAll($company->id);
		$this->output->set_status_header($res['code'])->set_content_type('application/json')->set_output(json_encode($res));
	}

	public function getOneByID($id) {
		$res = $this->TermsAndConditions->getOneByID($id);
		$this->output->set_status_header($res['code'])->set_content_type('application/json')->set_output(json_encode($res));
	}

	public function index(){
		$this->load->view('terms_and_conditions/index.php', $this->page_data);
	}

    public function view($id){
		$this->page_data['terms_and_conditions_id'] = $id;
		$this->load->view('terms_and_conditions/view.php', $this->page_data);
	}

	public function edit($id){
		$this->page_data['terms_and_conditions_id'] = $id;
		$this->load->view('terms_and_conditions/edit.php', $this->page_data);
	}
	
	public function create(){
		$this->load->view('terms_and_conditions/create.php', $this->page_data);
	}

	public function destroy($id) {
		$res = $this->TermsAndConditions->destroy($id);
		$this->output->set_status_header($res['code'])->set_content_type('application/json')->set_output(json_encode($res));
	}
	
	public function add() {
		$company = $this->getCompanyData();
		$req = $this->input->post();
		$req['company_id'] = $company->id;
		$res = $this->TermsAndConditions->add($req);
		$this->output->set_status_header($res['code'])->set_content_type('application/json')->set_output(json_encode($res));
	}

	public function update($id) {
		$req = $this->input->post();
		$res = $this->TermsAndConditions->update($id, $req);
		$this->output->set_status_header($res['code'])->set_content_type('application/json')->set_output(json_encode($res));
	}
    
}
