<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Industry_Modules extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page_title'] = 'Industry Modules';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('IndustryModules_model');
	}

	public function index() {
		$industryModules   = $this->IndustryModules_model->getAll();
		
		$this->page_data['industryModules'] = $industryModules;
		$this->load->view('industry_modules/index', $this->page_data);
	}

	public function add_new_module() {
		
		$this->load->view('industry_modules/add_new_module', $this->page_data);
	}

	public function create_module() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['name'] != '' ){
        	if( $this->IndustryModules_model->getByName($post['name']) ){
        		$this->session->set_flashdata('message', 'Module name already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'name' => $post['name'],
        			'description' => $post['description'],
        			'status' => 1,
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$industry_modules = $this->IndustryModules_model->create($data);

        		$this->session->set_flashdata('message', 'Add new modules was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter module name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('industry_modules/add_new_module');
	}

	public function edit_module($module_id) {

		$industryModules = $this->IndustryModules_model->getById($module_id);

		if( $industryModules ){
			$this->page_data['industryModules'] = $industryModules;
			$this->load->view('industry_modules/edit_module', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('industry_modules/index');
		}
	}

	public function update_module() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryModules = $this->IndustryModules_model->getById($post['module_id']);

        if( $industryModules ){
        	if( $post['name'] != '' ){
	        	$data = [
        			'name' => $post['name'],
        			'description' => $post['description'],
        			'status' => $post['status'],
        			'date_modified' => date("Y-m-d H:i:s")
        		];
        		$industryModulesUpdate = $this->IndustryModules_model->updateIndustryModules($post['module_id'],$data);

        		$this->session->set_flashdata('message', 'Module was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter module name');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('industry_modules/edit_module/'.$post['module_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('industry_modules/index');
        }
	}

	public function delete_module()
    {
    	$post = $this->input->post();

    	$id = $this->IndustryModules_model->deleteIndustryModules(post('mid'));

		$this->session->set_flashdata('message', 'Module has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('industry_modules/index');
    }
}

/* End of file Nsmart_Addons.php */
/* Location: ./application/controllers/Nsmart_Addons.php */
