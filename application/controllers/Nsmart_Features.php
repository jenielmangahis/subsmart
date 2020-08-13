<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nsmart_Features extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page_title'] = 'Nsmart Features';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('NsmartPlan_model');
		$this->load->model('PlanHeadings_model');
		$this->load->model('NsmartFeature_model');
		$this->load->model('NsmartPlanModules_model');
	}

	public function index() {

		$planHeadings = $this->PlanHeadings_model->getAll();
		$data_features = array();
		foreach( $planHeadings as $ph ){
			$modules = $this->NsmartPlanModules_model->getAllByPlanHeadingId($ph->id);
			foreach( $modules as $m ){
				$data_features[$ph->title][$m->nsmart_feature_id]['feature_name'] = $m->feature_name; 
				$data_features[$ph->title][$m->nsmart_feature_id]['feature_id'] = $m->nsmart_feature_id;  
				$data_features[$ph->title][$m->nsmart_feature_id]['plans'][] = $m->plan_name;
			}
		}

		$this->page_data['data_features'] = $data_features;
		$this->load->view('nsmart_features/index', $this->page_data);

	}

	public function add_new_feature() {

		$planHeadings   = $this->PlanHeadings_model->getAll();
		$plans   = $this->NsmartPlan_model->getAll();

		$this->page_data['planHeadings'] = $planHeadings;
		$this->page_data['plans'] = $plans;
		$this->load->view('nsmart_features/add_new_feature', $this->page_data);
	}	

	public function create_feature() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['feature_name'] != '' ){
        	$data_feature = [
        		'feature_name' => $post['feature_name'],
        		'feature_description' => $post['feature_description'],
        		'plan_heading_id' => $post['feature_heading'],
        		'date_created' => date("Y-m-d H:i:s")
        	];

        	$nsmart_feature_id = $this->NsmartFeature_model->save($data_feature);
        	if( $nsmart_feature_id > 0 ){
        		foreach( $post['plans'] as $id => $value ){
        			$data_plan_modules = [
        				'nsmart_plans_id' => $id,
        				'nsmart_feature_id' => $nsmart_feature_id,
        				'plan_heading_id' => $post['feature_heading']
        			];

        			$nsPlanFeature = $this->NsmartPlanModules_model->create($data_plan_modules);
        		}

        		$this->session->set_flashdata('message', 'Add new plan feature was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');

        	}else{
        		$this->session->set_flashdata('message', 'Cannot save feature.');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}

        }else{
        	$this->session->set_flashdata('message', 'Please enter feature name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('nsmart_features/add_new_feature');
	}
}

/* End of file Nsmart_Features.php */
/* Location: ./application/controllers/Nsmart_Features.php */
