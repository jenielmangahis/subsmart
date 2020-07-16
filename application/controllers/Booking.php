<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->page_data['page_title'] = 'Online Booking';

		$this->load->model('BookingCoupon_model');
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

	public function coupons( $param = '' ) {
		if( $param == '' ){
			$param = 'active';			
		}

		if( $param == 'active' ){
			$coupons = $this->BookingCoupon_model->getAllActive();
		}else{
			$coupons = $this->BookingCoupon_model->getAllClosed();
		}

		$total_active = $this->BookingCoupon_model->totalActive();
		$total_closed = $this->BookingCoupon_model->totalClosed();

		$this->page_data['total_active'] = $total_active;
		$this->page_data['total_closed'] = $total_closed;
		$this->page_data['coupons'] = $coupons;
		$this->page_data['active_tab'] = $param;
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

	public function save_coupon()
    {
        postAllowed();

        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        if( !empty($post) ){
        	$this->load->model('BookingCoupon_model');

        	$data = array(
        		'user_id' => $user['id'],
        		'coupon_name' => post('name'),
        		'coupon_code' => post('code'),
        		'discount_from_total' => 0,
        		'discount_from_total_type' => post('discount_type'),
        		'date_valid_from' => date("Y-m-d",strtotime(post('valid_from'))),
        		'date_valid_to' => date("Y-m-d",strtotime(post('valid_to'))),
        		'used_per_coupon' => post('uses_max'),
        		'status' => $this->BookingCoupon_model->isActive(),
        		'date_created' => date("Y-m-d H:i:s")
        	);
        	$bookingCoupon = $this->BookingCoupon_model->create($data);
        }

        redirect('more/addon/booking/coupons');

    }

}

/* End of file Booking.php */
/* Location: ./application/controllers/Booking.php */