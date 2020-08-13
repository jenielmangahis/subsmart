<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_Headings extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page_title'] = 'Plan Headings';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('PlanHeadings_model');
	}

	public function index() {

		//$user = $this->session->userdata('logged');

		$planHeadings   = $this->PlanHeadings_model->getAll();

		$this->page_data['planHeadings'] = $planHeadings;
		$this->load->view('plan_headings/index', $this->page_data);
	}

	public function add_new_headings() {
		$this->load->view('plan_headings/add_new_headings', $this->page_data);
	}

	public function create_plan_headings() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['plan_heading_name'] != '' ){
        	if( $this->PlanHeadings_model->isTitle($post['plan_heading_name']) ){
        		$this->session->set_flashdata('message', 'Title already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'title' => $post['plan_heading_name'],
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$planHeading = $this->PlanHeadings_model->create($data);

        		$this->session->set_flashdata('message', 'Add new plan heading was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter title');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('plan_headings/add_new_headings');
	}

	public function edit_plan_headings( $id ) {
		$planHeading = $this->PlanHeadings_model->getById($id);

		if( $planHeading ){
			$this->page_data['planHeading'] = $planHeading;
			$this->load->view('plan_headings/edit_headings', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('plan_headings/index');
		}
	}

	public function update_plan_headings() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $planHeading = $this->PlanHeadings_model->getById($post['plan_heading_id']);

        if( $planHeading ){
        	if( $post['plan_heading_name'] != '' ){
	        	$data = [
        			'title' => $post['plan_heading_name'],
        			'date_updated' => date("Y-m-d H:i:s")
        		];
        		$nsPlan = $this->PlanHeadings_model->update($post['plan_heading_id'],$data);

        		$this->session->set_flashdata('message', 'Plan heading was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter title');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('plan_headings/edit_plan_headings/'.$post['plan_heading_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('plan_headings/index');
        }
	}

	public function delete_plan_heading() {
		$id = $this->PlanHeadings_model->delete(post('phid'));

		$this->session->set_flashdata('message', 'Plan heading has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('plan_headings/index');
	}
}

/* End of file Plan_Headings.php */
/* Location: ./application/controllers/Plan_Headings.php */
