<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Benchmark extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page']->menu = 'benchmark';
		$this->page_data['module'] = 'benchmark';		
	}

	public function cron_customer_subscription(){		
		echo "Test Cron for Auto Generate Invoice for Customer Subscription";

		$this->load->model('AcsCustomerSubscriptionBilling_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_settings_model');
		$this->load->model('Customer_advance_model', 'customer_ad_model');
		

        $activeSubscriptions = $this->customer_ad_model->get_all_active_subscriptions();	
		
		echo '<pre>';
		print_r($activeSubscriptions);
		echo '</pre>';


	}

}
?>
