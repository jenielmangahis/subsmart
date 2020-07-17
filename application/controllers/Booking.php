<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

	public function __construct() {
		parent::__construct();

		$this->page_data['page_title'] = 'Online Booking';

		$this->load->model('BookingCategory_model');
		$this->load->model('BookingServiceItem_model');
		$this->load->model('BookingCoupon_model');
		$this->load->model('BookingSetting_model');
	}

	public function index() {
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/index', $this->page_data);
	}

	public function products() {

		$category = $this->BookingCategory_model->getAll();
		$service_items = $this->BookingServiceItem_model->getAllItemsGroupByCategoryArray();

		$this->page_data['category'] = $category;
		$this->page_data['service_items'] = $service_items;
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

        	if( $this->BookingCoupon_model->isCouponCodeExists(post('code')) ){
        		$this->session->set_flashdata('message', 'Coupon code already taken');
        		$this->session->set_flashdata('alert_class', 'alert-danger');     
        	}else{
        		if( post('discount_amount') !== null ){
	        		$discount_amount = post('discount_amount');
	        	}else{
	        		$discount_amount = post('discount_percent');
	        	}

	        	$data = array(
	        		'user_id' => $user['id'],
	        		'coupon_name' => post('name'),
	        		'coupon_code' => post('code'),
	        		'discount_from_total' => $discount_amount,
	        		'discount_from_total_type' => post('discount_type'),
	        		'date_valid_from' => date("Y-m-d",strtotime(post('valid_from'))),
	        		'date_valid_to' => date("Y-m-d",strtotime(post('valid_to'))),
	        		'used_per_coupon' => post('uses_max'),
	        		'status' => post('status'),
	        		'date_created' => date("Y-m-d H:i:s")
	        	);
	        	$bookingCoupon = $this->BookingCoupon_model->create($data);

	        	$this->session->set_flashdata('message', 'Add New Coupon Successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');     
        	}        	
        }     

        redirect('more/addon/booking/coupons');

    }

    public function ajax_edit_coupon()
    {

    	$id = post('cid');
    	$coupon = $this->BookingCoupon_model->getById($id);
    	
    	$this->page_data['coupon'] = $coupon;
		$this->load->view('online_booking/ajax_edit_coupon', $this->page_data);
    }

    public function delete_coupon()
    {
    	$id = $this->BookingCoupon_model->deleteUserCoupon(post('cid'));

		$this->activity_model->add("Coupon #$id Deleted by User:".logged('name'));
		
		$this->session->set_flashdata('message', 'Coupon has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('more/addon/booking/coupons');
    }

    public function update_coupon()
    {
    	postAllowed();

    	echo "<pre>";
    	$post = $this->input->post();

    	$coupon = $this->BookingCoupon_model->getById(post('cid'));
    	if( $coupon ){
    		if( post('discount_amount') !== null ){
        		$discount_amount = post('discount_amount');
        	}else{
        		$discount_amount = post('discount_percent');
        	}

    		$this->BookingCoupon_model->update($coupon->id, array(
    			'coupon_name' => post('name'),
        		'coupon_code' => post('code'),
        		'discount_from_total' => $discount_amount,
        		'discount_from_total_type' => post('discount_type'),
        		'date_valid_from' => date("Y-m-d",strtotime(post('valid_from'))),
        		'date_valid_to' => date("Y-m-d",strtotime(post('valid_to'))),
        		'used_per_coupon' => post('uses_max'),
        		'status' => post('status'),        		
    		));

    		$this->session->set_flashdata('message', 'Coupon was successfully updated');
        	$this->session->set_flashdata('alert_class', 'alert-success');     

    	}else{
    		$this->session->set_flashdata('message', 'Coupon not found');
			$this->session->set_flashdata('alert_class', 'alert-danger');
    	}

    	redirect('more/addon/booking/coupons');
    }

    public function save_category()
    {
        postAllowed();

        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        if( !empty($post) ){
        	$this->load->model('BookingCategory_model');

        	$data = array(
        		'user_id' => $user['id'],
        		'name' => post('category_name'),
        		'date_created' => date("Y-m-d H:i:s")
        	);
        	$bookingCoupon = $this->BookingCategory_model->create($data);

        	$this->session->set_flashdata('message', 'Add New Category Successful');
        	$this->session->set_flashdata('alert_class', 'alert-success');       	
        }

        redirect('more/addon/booking/products');    	
    }

    public function ajax_edit_category()
    {
    	$id = post('cat_id');
    	$category = $this->BookingCategory_model->getById($id);
    	
    	$this->page_data['category'] = $category;
    	$this->page_data['category_id'] = $id;
		$this->load->view('online_booking/ajax_edit_category', $this->page_data);
    }  
    
    public function ajax_edit_service_item()
    {
    	$id = post('siid');
    	$service_item = $this->BookingServiceItem_model->getById($id);
    	$category = $this->BookingCategory_model->getAll();
    	
    	$this->page_data['service_item'] = $service_item;
    	$this->page_data['category'] = $category;
    	$this->page_data['service_item_id'] = $id;
		$this->load->view('online_booking/ajax_edit_service_item', $this->page_data);
    }

    public function update_category()
    {
    	postAllowed();
        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        if( !empty($post) ) {
        	$this->load->model('BookingCategory_model');

        	echo '<pre>';
        	print_r($post);
        	echo '</pre>';
        }    	
    }  

    public function save_service_item()
    {
        postAllowed();

        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        if( !empty($post) ){
        	$this->load->model('BookingServiceItem_model');

        	$data = array(
        		'user_id' => $user['id'],
        		'category_id' => post('category_id'),
        		'name' => post('name'),
        		'description' => post('description'),
        		'price' => post('price'),
        		'price_unit' => post('price_unit'),
        		'image' => 'na',
        		'date_created' => date("Y-m-d H:i:s")
        	);
        	$bookingServiceItem = $this->BookingServiceItem_model->create($data);

        	$this->session->set_flashdata('message', 'Add New Service/Item Successful');
        	$this->session->set_flashdata('alert_class', 'alert-success');       	
        }

        redirect('more/addon/booking/products');    	
    }   

    public function delete_service_item()
    {
    	$id = $this->BookingServiceItem_model->deleteServiceItem(post('siid'));

		$this->activity_model->add("Coupon #$id Deleted by User:".logged('name'));
		
		$this->session->set_flashdata('message', 'Service/Item has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('more/addon/booking/products');
    }

    public function ajax_save_setting()
    {
    	postAllowed();

        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        /*$userSetting = $this->BookingSetting_model->findByUserId($user['id']);
        if( $userSetting ){
        	$data = array(        		
        		'page_title' => post('page_title'),
        		'page_instruction' => post('page_intro'),
        		'product_listing_mode' => post('product_list_mode'),
        		'appointment_per_time_slot' => post('time_slot_bookings'),
        		'minimum_price_for_entier_booking' => post('cart_total_min'),
        		'minimum_price_alert' => post('cart_total_min_alert'),
        		'notification_email' => post('notify_email'),
        		'notification_app' => post('notify_push'),
        		'accept_blocked_time' => post('event_blocked_check'),
        		'accept_booking_overlap_calendar_event' => post('event_all_check')
        		'auto_schedule_work_order' => post('convert_lead_to_work_order'),
        		'google_analytics_tracking_id' => post('google_analytics_tracking_id'),
        		'website_url' => post('google_analytics_origin'),
        		'widget_status' => post('status')
        	);

        	$this->BookingCoupon_model->update($userSetting->id, $data);

        }else{
        	$data = array(
        		'user_id' => $user['id'],
        		'page_title' => post('page_title'),
        		'page_instruction' => post('page_intro'),
        		'product_listing_mode' => post('product_list_mode'),
        		'appointment_per_time_slot' => post('time_slot_bookings'),
        		'minimum_price_for_entier_booking' => post('cart_total_min'),
        		'minimum_price_alert' => post('cart_total_min_alert'),
        		'notification_email' => post('notify_email'),
        		'notification_app' => post('notify_push'),
        		'accept_blocked_time' => post('event_blocked_check'),
        		'accept_booking_overlap_calendar_event' => post('event_all_check')
        		'auto_schedule_work_order' => post('convert_lead_to_work_order'),
        		'google_analytics_tracking_id' => post('google_analytics_tracking_id'),
        		'website_url' => post('google_analytics_origin'),
        		'widget_status' => post('status')
        	);

        	$bookingSetting = $this->BookingSetting_model->create($data);
        }*/

        $json_data = array('is_success' => true);

        echo json_encode($json_data);
    }

}

/* End of file Booking.php */
/* Location: ./application/controllers/Booking.php */