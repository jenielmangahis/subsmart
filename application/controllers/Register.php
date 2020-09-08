<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('NsmartPlan_model');
        $this->load->model('Clients_model');
		/* Load Paypal Library */
		$this->load->library('paypal_lib');

		$this->page_data['page']->title = 'nSmart - Registration';
	}

	public function index(){
		// $this->load->model('NsmartPlan_model');
  //       $this->load->model('Clients_model');
        $get_data = $this->input->get();  

        $payment_status = "";
        if($get_data && isset($get_data['status'])) {
            $payment_status = $get_data['status'];
        }

		$ns_plans = $this->NsmartPlan_model->getAll();

        $this->page_data['payment_status'] = $payment_status;
		$this->page_data['ns_plans'] = $ns_plans;
		$this->page_data['business'] = getIndustryBusiness();
		$this->page_data['roles']    = getRegistrationRoles();
		$this->load->view('registration', $this->page_data);
	}

    function subscribe(){

        postAllowed();
        $post = $this->input->post();  

        // Set variables for paypal form
        /*$returnURL = base_url().'subscribe/success';
        $cancelURL = base_url().'subscribe/cancel';
        $notifyURL = base_url().'subscribe/ipn';*/

        $data = [
            'first_name' => $post['firstname'],
            'last_name' => $post['lastname'],
            'email_address' => $post['email'],
            'phone_number' => $post['phone'],
            'business_name' => $post['business_name'],
            'business_address' => $post['business_address'],
            'number_of_employee' => $post['number_of_employee'],
            'industry' => $post['industry'],
            'password' => $post['password'],
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        ];

        $client = $this->Clients_model->create($data);




        $returnURL = base_url().'registration?status=success';
        $cancelURL = base_url().'registration?status=cancel';
        $notifyURL = base_url().'registration/ipn';
        
        // Get subscription data
        $subscription_id    = $post['plan_id'];
        $subscription_name  = $post['plan_name'];
        $subscription_price = $post['plan_price'];

        // Add custom data such as item/subscription id etc.
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