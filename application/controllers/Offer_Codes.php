<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offer_Codes extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		//$this->checkLogin();
		$role_id = 1; //this is for nsmart admin user
		$this->isCheckLoginAndRole($role_id);

		$this->page_data['page_title'] = 'Offer Code';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('OfferCodes_model');
	}

	public function index() {
		//$ip = getValidIpAddress();
		$offerCodes   = $this->OfferCodes_model->getAll();
		
		$this->page_data['offerCodes'] = $offerCodes;
		$this->load->view('offer_codes/index', $this->page_data);
	}

	public function add_new_offer() {
		
		$this->load->view('offer_codes/add_new_offer', $this->page_data);
	}

	public function create_offer_code() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( $post['offer_code'] != '' ){
        	if( $this->OfferCodes_model->getByOfferCodes($post['offer_code']) ){
        		$this->session->set_flashdata('message', 'Offer Code already exists');
        		$this->session->set_flashdata('alert_class', 'alert-danger');
        	}else{
        		$data = [
        			'offer_code' => $post['offer_code'],
        			'trial_days' => $post['trial_days'],
        			'status' => 0,
        			'date_created' => date("Y-m-d H:i:s")
        		];

        		$OfferCodes = $this->OfferCodes_model->create($data);

        		$this->session->set_flashdata('message', 'Add new Offer Code was successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');
        	}
        }else{
        	$this->session->set_flashdata('message', 'Please enter Offer Code');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('offer_codes/add_new_offer');
	}

	public function edit_offer($offer_id) {

		$offerCodes = $this->OfferCodes_model->getById($offer_id);

		if( $offerCodes ){
			$this->page_data['offerCodes'] = $offerCodes;
			$this->load->view('offer_codes/edit_offer', $this->page_data);
		}else{
			$this->session->set_flashdata('message', 'Cannot find data');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
        	redirect('offer_codes/index');
		}
	}

	public function update_edit_offer() {
		postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $offerCodes = $this->OfferCodes_model->getById($post['offer_id']);

        if( $offerCodes ){
        	if( $post['offer_id'] != '' ){
	        	$data = [
        			'offer_code' => $post['offer_code'],
        			'trial_days' => $post['trial_days'],
        			'status' => $post['status'],
        			'date_modified' => date("Y-m-d H:i:s")
        		];
        		$offerCodes = $this->OfferCodes_model->updateOfferCodes($post['offer_id'],$data);

        		$this->session->set_flashdata('message', 'Offer code was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please enter Offer code');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('offer_codes/edit_offer/'.$post['offer_id']);

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('offer_codes/index');
        }
	}

	public function delete_offer_code()
    {
    	$post = $this->input->post();

    	$id = $this->OfferCodes_model->deleteOfferCodes(post('offer_code_id'));

		$this->session->set_flashdata('message', 'Offer Code has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('offer_codes/index');
    }
}

/* End of file Offer_Codes.php */
/* Location: ./application/controllers/Offer_Codes.php */
