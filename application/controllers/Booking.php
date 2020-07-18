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
        $this->load->model('BookingTimeSlot_model');
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
        $user = $this->session->userdata('logged');  

        $bookingTimeSlots = $this->BookingTimeSlot_model->findAllByUserId($user['id']);

        $this->page_data['bookingTimeSlots'] = $bookingTimeSlots;
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
		$user = $this->session->userdata('logged');  
		$setting = array();

		$bookingSetting = $this->BookingSetting_model->findByUserId($user['id']);

		if( $bookingSetting ){
			$setting = array(
				'page_title' => $bookingSetting->page_title,
				'page_intro' => $bookingSetting->page_introduction,
				'product_list_mode' => $bookingSetting->product_listing_mode,
				'time_slot_bookings' => $bookingSetting->appointment_per_time_slot,
				'cart_total_min' => $bookingSetting->minimum_price_for_entier_booking,
				'cart_total_min_alert' => $bookingSetting->minimum_price_alert,
				'notify_email' => $bookingSetting->notification_email,
				'notify_push' => $bookingSetting->notification_app,
				'event_blocked_check' => $bookingSetting->accept_blocked_time,
				'event_all_check' => $bookingSetting->accept_booking_overlap_calendar_event,
				'convert_lead_to_work_order' => $bookingSetting->auto_schedule_work_order,
				'google_analytics_tracking_id' => $bookingSetting->google_analytics_tracking_id,
				'google_analytics_origin' => $bookingSetting->website_url,
				'status' => $bookingSetting->widget_status
			);
		}else{
			$setting = array(
				'page_title' => '',
				'page_intro' => '',
				'product_list_mode' => 'grid',
				'time_slot_bookings' => 0,
				'cart_total_min' => 1,
				'cart_total_min_alert' => 1,
				'notify_email' => 1,
				'notify_push' => 1,
				'event_blocked_check' => 0,
				'event_all_check' => 0,
				'convert_lead_to_work_order' => 0,
				'google_analytics_tracking_id' => '',
				'google_analytics_origin' => '',
				'status' => 1
			);
		}

		$this->page_data['setting'] = $setting;
		$this->page_data['users']   = $this->users_model->getUser(logged('id'));
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
        	$category_id = $post['category_id'];
        	$cat = $this->BookingCategory_model->getById($category_id);

        	if($cat) {
	            $this->BookingCategory_model->update($cat->id, array(
	                'name' => post('category_name'),        
	            ));

	            $this->session->set_flashdata('message', 'Category was successfully updated');
	            $this->session->set_flashdata('alert_class', 'alert-success'); 
        	} else {
	            $this->session->set_flashdata('message', 'Coupon not found');
	            $this->session->set_flashdata('alert_class', 'alert-danger');
        	}
        } else {
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');        	
        }   

        redirect('more/addon/booking/products'); 	
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

    public function update_service_item()
    {
    	postAllowed();
        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        if( !empty($post) ) {
        	$service_item_id = $post['service_item_id'];
        	$siid = $this->BookingServiceItem_model->getById($service_item_id);

        	if($siid) {
	            $this->BookingServiceItem_model->update($siid->id, array(
	            	'category_id' => post('category_id'),   
	                'name' => post('name'),   
	                'description' => post('description'),   
	                'price' => post('price'),   
	                'price_unit' => post('price_unit'),   
	            ));

	            $this->session->set_flashdata('message', 'Service/Item was successfully updated');
	            $this->session->set_flashdata('alert_class', 'alert-success'); 
        	} else {
	            $this->session->set_flashdata('message', 'Service/Item not found');
	            $this->session->set_flashdata('alert_class', 'alert-danger');
        	}
        } else {
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');        	
        }   

        redirect('more/addon/booking/products'); 	
    }      

    public function delete_category()
    {
    	$id = $this->BookingCategory_model->deleteCategory(post('cat_id'));

		$this->activity_model->add("Category #$id Deleted by User:".logged('name'));
		
		$this->session->set_flashdata('message', 'Booking Category has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('more/addon/booking/products');
    }    

    public function delete_service_item()
    {
    	$id = $this->BookingServiceItem_model->deleteServiceItem(post('siid'));

		$this->activity_model->add("Service/Item #$id Deleted by User:".logged('name'));
		
		$this->session->set_flashdata('message', 'Service/Item has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('more/addon/booking/products');
    }

    public function ajax_save_setting()
    {
    	postAllowed();

        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        $userSetting = $this->BookingSetting_model->findByUserId($user['id']);
        if( $userSetting ){
        	$data = array(        		
        		'page_title' => post('page_title'),
        		'page_introduction' => post('page_intro'),
        		'product_listing_mode' => post('product_list_mode'),
        		'appointment_per_time_slot' => post('time_slot_bookings'),
        		'minimum_price_for_entier_booking' => post('cart_total_min'),
        		'minimum_price_alert' => post('cart_total_min_alert'),
        		'notification_email' => post('notify_email'),
        		'notification_app' => post('notify_push'),
        		'accept_blocked_time' => post('event_blocked_check'),
        		'accept_booking_overlap_calendar_event' => post('event_all_check'),
        		'auto_schedule_work_order' => post('convert_lead_to_work_order'),
        		'google_analytics_tracking_id' => post('google_analytics_tracking_id'),
        		'website_url' => post('google_analytics_origin'),
        		'widget_status' => post('status')
        	);

        	$this->BookingSetting_model->update($userSetting->id, $data);

        }else{
        	$data = array(
        		'user_id' => $user['id'],
        		'page_title' => post('page_title'),
        		'page_introduction' => post('page_intro'),
        		'product_listing_mode' => post('product_list_mode'),
        		'appointment_per_time_slot' => post('time_slot_bookings'),
        		'minimum_price_for_entier_booking' => post('cart_total_min'),
        		'minimum_price_alert' => post('cart_total_min_alert'),
        		'notification_email' => post('notify_email'),
        		'notification_app' => post('notify_push'),
        		'accept_blocked_time' => post('event_blocked_check'),
        		'accept_booking_overlap_calendar_event' => post('event_all_check'),
        		'auto_schedule_work_order' => post('convert_lead_to_work_order'),
        		'google_analytics_tracking_id' => post('google_analytics_tracking_id'),
        		'website_url' => post('google_analytics_origin'),
        		'widget_status' => post('status')
        	);

        	$bookingSetting = $this->BookingSetting_model->create($data);
        }

        $json_data = array('is_success' => true);

        echo json_encode($json_data);
    }

    public function ajax_save_time_slot()
    {
        postAllowed();
        $user = $this->session->userdata('logged');        
        $post = $this->input->post();

        $this->BookingTimeSlot_model->deleteAllUserTimeSlots($user['id']);

        foreach( $post['time'] as $t ){
            $days = serialize($t['days']);
            $data = array(
                'user_id' => $user['id'],
                'time_start' => $t['time_start'],
                'time_end' => $t['time_end'],
                'days' => $days,
                'availability' => post('soonest_availability'),                
                'date_created' => date("Y-m-d H:i:s")
            );
            $bookingTimeSlots = $this->BookingTimeSlot_model->create($data);
        }
        
        $json_data = array('is_success' => true);

        echo json_encode($json_data);
    }

    public function delete_time_slot()
    {
        $id = $this->BookingTimeSlot_model->deleteUserTimeSlot(post('tid'));

        $this->activity_model->add("Time Slot #$id Deleted by User:".logged('name'));
        
        $this->session->set_flashdata('message', 'Time slot has been Deleted Successfully');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('more/addon/booking/time');
    }

}

/* End of file Booking.php */
/* Location: ./application/controllers/Booking.php */