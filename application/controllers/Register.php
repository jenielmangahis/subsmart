<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct(){
		parent::__construct();

		/* Load Paypal Library */
		$this->load->library('paypal_lib');

		$this->page_data['page']->title = 'nSmart - Registration';
	}

	public function index(){
		$this->load->model('NsmartPlan_model');

		$ns_plans = $this->NsmartPlan_model->getAll();

		$this->page_data['ns_plans'] = $ns_plans;
		$this->page_data['business'] = getIndustryBusiness();
		$this->page_data['roles']    = getRegistrationRoles();
		$this->load->view('registration', $this->page_data);
	}

    function subscribe(){

        postAllowed();
        $post = $this->input->post();  

        // Set variables for paypal form
        $returnURL = base_url().'subscribe/success';
        $cancelURL = base_url().'subscribe/cancel';
        $notifyURL = base_url().'subscribe/ipn';
        
        // Get subscription data
        $subscription_id    = 1;
        $subscription_name  = "Essential";
        $subscription_price = 5;
        
        // Get current user ID from the session
        $userID = 123456;
        
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $subscription_name);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $subscription_id);
        $this->paypal_lib->add_field('amount',  $subscription_price);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    function success(){
    	echo 'paypal success here';
    }

    function cancel(){
    	echo 'paypal cancel here';
    }

    function ipn(){
    	echo 'paypal notify url here';
    }

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */