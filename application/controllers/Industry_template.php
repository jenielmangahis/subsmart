<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry_Template extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page_title'] = 'Industry Template';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('IndustryTemplate_model');
		$this->load->model('IndustryModules_model');
		$this->load->model('IndustryTemplateModules_model');
		
	}

	public function index() {
		$industryTemplate   = $this->IndustryTemplate_model->getAll();
		
		$this->page_data['industryTemplate'] = $industryTemplate;
		$this->load->view('industry_template/index', $this->page_data);
	}

	public function add_new_template() {
		
		$this->load->view('industry_template/add_new_template', $this->page_data);
	}

	public function create_template() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['name'] != '' ){
        	if( $this->IndustryTemplate_model->getByName($post['name']) ){
        		$this->session->set_flashdata('message', 'Template name already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'name' => $post['name'],
        			'status' => 1,
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$industry_template = $this->IndustryTemplate_model->create($data);

        		$this->session->set_flashdata('message', 'Add new template was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter module name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('industry_template/add_new_template');
	}

	public function edit_template($template_id) {

		$industryTemplate = $this->IndustryTemplate_model->getById($template_id);

		if( $industryTemplate ){
			$this->page_data['industryTemplate'] = $industryTemplate;
			$this->load->view('industry_template/edit_template', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('industry_modules/index');
		}
	}

	public function update_template() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryTemplate = $this->IndustryTemplate_model->getById($post['template_id']);

        if( $industryTemplate ){
        	if( $post['name'] != '' ){
	        	$data = [
        			'name' => $post['name'],
        			'status' => $post['status'],
        			'date_modified' => date("Y-m-d H:i:s")
        		];
        		$industryTemplateUpdate = $this->IndustryTemplate_model->updateIndustryTemplate($post['template_id'],$data);

        		$this->session->set_flashdata('message', 'Template was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter module name');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('industry_template/edit_template/'.$post['template_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('industry_template/index');
        }
	}

	public function assign_template_modules($template_id) {

		$industryTemplate = $this->IndustryTemplate_model->getById($template_id);
		$industryModules = $this->IndustryModules_model->getAll();
		$industryTemplateModules = $this->IndustryTemplateModules_model->getAllByTemplateId($template_id);
		// echo "<pre>";
		// print_r($industryModules);
		// echo "</pre>";
		// exit();

		if( $industryTemplate ){
			$this->page_data['industryTemplate'] = $industryTemplate;
			$this->page_data['industryModules'] = $industryModules;
			$this->page_data['industryTemplateModules']  = $industryTemplateModules;
			$this->load->view('industry_template/assign_template_modules', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('industry_modules/index');
		}
	}

	public function update_template_modules() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryTemplate = $this->IndustryTemplate_model->getById($post['template_id']);

        if( $industryTemplate ){
        	if( $post['name'] != '' ){

        		if(is_array($post['modules'])){
        			$this->IndustryTemplateModules_model->deleteIndustryTemplateModulesByTemplateId($post['template_id']);
        			foreach ($post['modules'] as $key => $module_id) {
	        			$data = [
		        			'industry_template_id' => $post['template_id'],
		        			'industry_module_id ' => $module_id,
		        			'status' => 1, 	 
		        			'date_created' => date("Y-m-d H:i:s"),
		        			'date_modified' => date("Y-m-d H:i:s")
		        		];
		        		$industryTemplateModules = $this->IndustryTemplateModules_model->create($data);
		        	}	
        		}
	        	

        		$this->session->set_flashdata('message', 'Template Modules was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter module name');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('industry_template/assign_template_modules/'.$post['template_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('industry_template/index');
        }
	}

	public function delete_template()
    {
    	$post = $this->input->post();

    	$id = $this->IndustryTemplate_model->deleteIndustryTemplate(post('tid'));

		$this->session->set_flashdata('message', 'Template has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('industry_template/index');
    }
}

/* End of file Industry_Template.php */
/* Location: ./application/controllers/Industry_Template.php */
