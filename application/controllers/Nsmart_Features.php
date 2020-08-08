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
		$this->load->model('NsmartPlan_model');
	}

	public function index() {

		$nSmartPlans   = $this->NsmartPlan_model->getAll();
		$option_status = $this->NsmartPlan_model->getPlanStatus();
		$option_discount_types = $this->NsmartPlan_model->getDiscountTypes();
		
		$this->page_data['option_status'] = $option_status;
		$this->page_data['option_discount_types'] = $option_discount_types;
		$this->page_data['nSmartPlans'] = $nSmartPlans;
		$this->load->view('nsmart_features/index', $this->page_data);

	}

	public function add_new_feature() {

		$planHeadings   = $this->PlanHeadings_model->getAll();
		$plans   = $this->NsmartPlan_model->getAll();

		$this->page_data['planHeadings'] = $planHeadings;
		$this->page_data['plans'] = $plans;
		$this->load->view('nsmart_features/add_new_feature', $this->page_data);
	}	


}

/* End of file Nsmart_Features.php */
/* Location: ./application/controllers/Nsmart_Plan_Builder.php */
