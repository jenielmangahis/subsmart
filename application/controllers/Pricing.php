<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pricing extends MY_Controller {
	public function __construct(){
		parent::__construct();
		//$this->checkLogin(1);

		$this->load->model('NsmartAddons_model');
		$this->page_data['page']->title = 'nSmart - Pricing';
	}

	public function index(){

		$get_all_active_addons = $this->NsmartAddons_model->getAllActive();

		$active_addons_by_price_group = array();
		foreach($get_all_active_addons as $addon) {
			$active_addons_by_price_group[$addon->price][] = $addon;
		}

		$this->page_data['active_addons_by_price_group'] = $active_addons_by_price_group;
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
