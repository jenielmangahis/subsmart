<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends MY_Controller {
	public function __construct(){
		parent::__construct();
		//$this->checkLogin(1);
		$this->page_data['page']->title = 'nSmart - Pricing';
	}
	public function index(){
		$this->load->view('pricing', $this->page_data);
	}

	public function pricing2(){

		$this->load->model('NsmartPlan_model');
		$this->load->model('PlanHeadings_model');
		$this->load->model('NsmartFeature_model');
		$this->load->model('NsmartPlanModules_model');

		$nsPlans = $this->NsmartPlan_model->getAll();
		$aPlans  = array();

		foreach( $nsPlans as $p ){
			$planHeadings = $this->PlanHeadings_model->getAll();
			$aPlans[$p->nsmart_plans_id]['plan'] = [
				'plan_name' => $p->plan_name,
				'plan_description' => $p->plan_description,
				'plan_price' => $p->price
			];

			$features = array();
			foreach( $planHeadings as $ph ){
				$features[$ph->id] = ['plan_heading' => $ph->title];

				$planModules = $this->NsmartPlanModules_model->getAllByPlanHeadingId($ph->id);
				foreach($planModules as $pm){
					$features[$ph->id]['features'][] = [
						'feature_name' => $pm->feature_name,
						'feature_description' => $pm->feature_description
					]; 
				}
			}

			$aPlans[$p->nsmart_plans_id]['features'] = $features; 

		}

		$this->page_data['aPlans'] = $aPlans;
		$this->load->view('pricing2', $this->page_data);
	}
}
