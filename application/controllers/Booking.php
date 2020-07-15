<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->page_data['page_title'] = 'Online Booking';
	}

	public function index() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/index', $this->page_data);
	}

	public function products() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/products', $this->page_data);
	}	

	public function time() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/time', $this->page_data);
	}

	public function form() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/form', $this->page_data);
	}

	public function coupons() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/coupons', $this->page_data);
	}

	public function settings() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/settings', $this->page_data);
	}
	
	public function preview() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/preview', $this->page_data);
	}

}

/* End of file Booking.php */
/* Location: ./application/controllers/Booking.php */