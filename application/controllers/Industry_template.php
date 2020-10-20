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

	public function delete_template()
    {
    	$post = $this->input->post();

    	$id = $this->IndustryTemplate_model->deleteIndustryTemplate(post('tid'));

		$this->session->set_flashdata('message', 'Template has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('industry_template/index');
    }
}

/* End of file Nsmart_Addons.php */
/* Location: ./application/controllers/Nsmart_Addons.php */
