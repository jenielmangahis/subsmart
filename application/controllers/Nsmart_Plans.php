<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nsmart_Plans extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$role_id = 1; //this is for nsmart admin user
		//$this->isCheckLoginAndRole($role_id);

		$this->page_data['page_title'] = 'Nsmart Plans';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('NsmartPlan_model');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
	}

	public function index() {

		//$user = $this->session->userdata('logged');

		$is_allowed = $this->isAllowedModuleAccess(80);
        if( !$is_allowed ){
            $this->page_data['module'] = 'plan_builder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

		$nSmartPlans   = $this->NsmartPlan_model->getAll();
		$option_status = $this->NsmartPlan_model->getPlanStatus();
		$option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

		$this->page_data['option_status'] = $option_status;
		$this->page_data['option_discount_types'] = $option_discount_types;
		$this->page_data['nSmartPlans'] = $nSmartPlans;
		$this->load->view('nsmart_plans/index', $this->page_data);
	}

	public function add_new_plan() {
		$option_status = $this->NsmartPlan_model->getPlanStatus();
		$option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

		$this->page_data['option_status'] = $option_status;
		$this->page_data['option_discount_types'] = $option_discount_types;
		$this->load->view('nsmart_plans/add_new_plan', $this->page_data);
	}

	public function create_plan() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['plan_name'] != '' ){
        	if( $this->NsmartPlan_model->isPlanNameExists($post['plan_name']) ){
        		$this->session->set_flashdata('message', 'Plan name already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'plan_name' => $post['plan_name'],
        			'plan_description' => $post['plan_description'],
        			'price' => $post['plan_price'],
        			'discount' => $post['plan_discount'],
        			'discount_type' => $post['plan_discount_type'],
        			'status' => $post['plan_status'],
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$nsPlan = $this->NsmartPlan_model->create($data);

        		$this->session->set_flashdata('message', 'Add new plan was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter plan name');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('nsmart_plans/add_new_plan');
	}

	public function edit_plan($plan_id) {

		$nSmartPlan = $this->NsmartPlan_model->getById($plan_id);

		if( $nSmartPlan ){
			$option_status = $this->NsmartPlan_model->getPlanStatus();
			$option_discount_types = $this->NsmartPlan_model->getDiscountTypes();

			$this->page_data['nSmartPlan'] = $nSmartPlan;
			$this->page_data['option_status'] = $option_status;
			$this->page_data['option_discount_types'] = $option_discount_types;
			$this->load->view('nsmart_plans/edit_plan', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('nsmart_plans/index');
		}
	}

	public function update_plan() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $nSmartPlan = $this->NsmartPlan_model->getById($post['plan_id']);

        if( $nSmartPlan ){
        	if( $post['plan_name'] != '' ){
	        	$data = [
        			'plan_name' => $post['plan_name'],
        			'plan_description' => $post['plan_description'],
        			'price' => $post['plan_price'],
        			'discount' => $post['plan_discount'],
        			'discount_type' => $post['plan_discount_type'],
        			'status' => $post['plan_status'],
        			'date_updated' => date("Y-m-d H:i:s")
        		];
        		$nsPlan = $this->NsmartPlan_model->updatePlan($post['plan_id'],$data);

        		$this->session->set_flashdata('message', 'Plan was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter plan name');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('nsmart_plans/edit_plan/'.$post['plan_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('nsmart_plans/index');
        }
	}

	public function delete_plan()
    {
    	$id = $this->NsmartPlan_model->deletePlan(post('pid'));

		$this->session->set_flashdata('message', 'Plan has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('nsmart_plans/index');
    }
}

/* End of file Nsmart_Plan_Builder.php */
/* Location: ./application/controllers/Nsmart_Plan_Builder.php */
