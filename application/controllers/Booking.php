<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();

		$this->page_data['page_title'] = 'Online Booking';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');

		$this->load->model('BookingCategory_model');
		$this->load->model('BookingForms_model');
		$this->load->model('BookingServiceItem_model');
		$this->load->model('BookingCoupon_model');
		$this->load->model('BookingSetting_model');
        $this->load->model('BookingTimeSlot_model');
        $this->load->model('Users_model');
        $this->load->model('BookingScheduleAssignedUser_model');
        $this->load->model('BookingInquiry_model');
        $this->load->model('BookingInfo_model');
        $this->load->model('BookingWorkOrder_model');
	}

	public function index() {

		$user = $this->session->userdata('logged');
    	$eid = hashids_encrypt($user['id'], '', 15);

		$total_category = $this->BookingCategory_model->countTotal();
		$total_products = $this->BookingServiceItem_model->countTotal();
		$total_timeslots = $this->BookingTimeSlot_model->countTotal();

		$this->page_data['eid']   = $eid;
		$this->page_data['total_category']  = $total_category;
		$this->page_data['total_products']  = $total_products;
		$this->page_data['total_timeslots'] = $total_timeslots;
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

		$default_form_fields = array(
			'Full Name' => 'full_name',
			'Contact Number' => 'contact_number',
			'Email' => 'email',
			'Address' => 'address',
			'Message' => 'message',
			'Preferred Time To Contact' => 'preferred_time_to_contact',
			'How Did You Hear About Us' => 'how_did_you_hear_about_us',
		);

		$user = $this->session->userdata('logged');
		$booking_forms = $this->BookingForms_model->getAll();
		$booking_forms_custom = $this->BookingForms_model->getAllCustom();

		if($booking_forms){
			$this->page_data['booking_forms'] = $booking_forms;
		}

		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['default_form_fields'] = $default_form_fields;
		$this->page_data['booking_forms_custom'] = $booking_forms_custom;
		$this->load->view('online_booking/form', $this->page_data);
	}

	public function save_form()
    {
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $default_form_fields = array(
			'Full Name' => 'full_name',
			'Contact Number' => 'contact_number',
			'Email' => 'email',
			'Address' => 'address',
			'Message' => 'message',
			'Preferred Time To Contact' => 'preferred_time_to_contact',
			'How Did You Hear About Us' => 'how_did_you_hear_about_us',
		);

 		if(isset($post['is_visible'])){
        	$is_visible = $post['is_visible'];
    	}


        if(isset($post['is_required'])){
       		$is_required = $post['is_required'];
        }
        $field_names = $post['is_field'];
        $sort = 1;


        foreach ($field_names as $key => $value) {
        	if (in_array($key, $default_form_fields)) {
			    $default_field = 1;
			}else{
				$default_field = 0;
			}

			if(!isset($is_required[''.$key.''][0])){
				$is_required_value = 0;
			}else{
				$is_required_value = 1;
			}

			if(!isset($is_visible[''.$key.''][0])){
				$is_visible_value = 0;
			}else{
				$is_visible_value = 1;
			}

			$post_data[''.$sort.'']['field_name'] =  $key;
			$post_data[''.$sort.'']['label'] = str_replace("_"," ", ucfirst($key));
			$post_data[''.$sort.'']['type'] = 1;
			$post_data[''.$sort.'']['is_required'] = $is_required_value;
			$post_data[''.$sort.'']['is_visible'] = $is_visible_value;
			$post_data[''.$sort.'']['is_default'] = $default_field;
			$post_data[''.$sort.'']['sort'] = $sort;

		  $sort++;
        }


        if( !empty($post) ){

        	$this->BookingForms_model->deleteByUserId($user['id']);

        	foreach ($post_data as $key => $value) {
	        	$data = array(
	        		'user_id' => $user['id'],
	        		'field_name' => $value['field_name'],
	        		'label' => $value['label'],
	        		'type' => $value['type'],
	        		'is_required' => $value['is_required'],
	        		'is_visible' => $value['is_visible'],
	        		'is_default' => $value['is_default'],
	        		'sort' => $value['sort'],
	        		'date_created' => date("Y-m-d H:i:s")
	        	);
	        	$bookingForm = $this->BookingForms_model->create($data);
	        }

	        	$this->session->set_flashdata('message', 'Form Updated Successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');

        }

        redirect('more/addon/booking/form');

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
		$bookingSetting = $this->BookingSetting_model->findByUserId($user['id']);

		$user 	   = $this->Users_model->getUser($user['id']);
		$employees = $this->Users_model->findAllUsersByCompanyId($user->company_id);

		$aasignedUsers = array();
		$setting       = array();

		if( $bookingSetting ){

			$bookingScheduleAssignedUsers = $this->BookingScheduleAssignedUser_model->findAllByBookingSettingId($bookingSetting->id);

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

			foreach( $bookingScheduleAssignedUsers as $b ){
				$aasignedUsers[] = $b->user_id;
			}

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

		$this->page_data['aasignedUsers'] = $aasignedUsers;
		$this->page_data['employees'] = $employees;
		$this->page_data['setting'] = $setting;
		$this->page_data['users']   = $this->users_model->getUser(logged('id'));
		$this->load->view('online_booking/settings', $this->page_data);
	}

	public function preview() {
		$user = $this->session->userdata('logged');
    	$eid = hashids_encrypt($user['id'], '', 15);

    	$this->page_data['eid']   = $eid;
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

    public function update_inquiry_status()
    {
    	postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ) {
        	$id = $post['inquiry_id'];
        	$stat = $this->BookingInquiry_model->getById($id);

        	if($stat) {
	            $this->BookingInquiry_model->update($stat->id, array(
	                'name' => post('status'),
	            ));

	            $this->session->set_flashdata('message', 'Status was successfully updated');
	            $this->session->set_flashdata('alert_class', 'alert-success');
        	} else {
	            $this->session->set_flashdata('message', 'Inquiry not found');
	            $this->session->set_flashdata('alert_class', 'alert-danger');
        	}
        } else {
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('more/addon/inquiries');
    }

    public function update_inquiry_details()
    {
    	postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ) {
        	$id = $post['inquiry_id'];
        	$stat = $this->BookingInquiry_model->getById($id);

        	if($stat) {
	            $this->BookingInquiry_model->update($stat->id, array(
	                'name' => post('name'),
	                'phone' => post('phone'),
	                'email' => post('email'),
	                'address' => post('address'),
	                'message' => post('message'),
	                'preferred_time_to_contact' => post('preferred_time_to_contact'),
	                'how_did_you_hear_about_us' => post('how_did_you_hear_about_us'),
	                'status' => post('status')
	            ));

	            $this->session->set_flashdata('message', 'Inquiry info was successfully updated');
	            $this->session->set_flashdata('alert_class', 'alert-success');
        	} else {
	            $this->session->set_flashdata('message', 'Inquiry not found');
	            $this->session->set_flashdata('alert_class', 'alert-danger');
        	}
        } else {
            $this->session->set_flashdata('message', 'Post value is empty');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('more/addon/inquiries');
    }    

    public function save_service_item()
    {
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

		$config['upload_path'] = './uploads/service_item/';
		$config['allowed_types'] = 'gif|jpeg|jpg|png';
		$config['max_size']	  = '100';
		$config['max_width']  = '1024';
		$config['max_height'] = '768';
		$config['remove_spaces'] = TRUE;

		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload('product-image')) {
			$product_image = '';
			//$error = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
			$product_image = $data['upload_data']['file_name'];
		}

        if( !empty($post) ){
        	$this->load->model('BookingServiceItem_model');

        	$data = array(
        		'user_id' => $user['id'],
        		'category_id' => post('category_id'),
        		'name' => post('name'),
        		'description' => post('description'),
        		'price' => post('price'),
        		'price_unit' => post('price_unit'),
        		'image' => $product_image,
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

		$config['upload_path'] = './uploads/service_item/';
		$config['allowed_types'] = 'gif|jpeg|jpg|png';
		$config['max_size']	  = '100';
		$config['max_width']  = '1024';
		$config['max_height'] = '768';
		$config['remove_spaces'] = TRUE;

		$this->load->library('upload', $config);
		if ( !$this->upload->do_upload('product-image')) {
			$product_image = '';
		} else {
			$data = array('upload_data' => $this->upload->data());
			$product_image = $data['upload_data']['file_name'];
		}

        if( !empty($post) ) {
        	$service_item_id = $post['service_item_id'];
        	$siid = $this->BookingServiceItem_model->getById($service_item_id);

        	if($product_image != '') {
        		$to_update = array(
	            	'category_id' => post('category_id'),
	                'name' => post('name'),
	                'description' => post('description'),
	                'price' => post('price'),
	                'price_unit' => post('price_unit'),
	                'image' => $product_image
	            );
        	} else {
        		$to_update = array(
	            	'category_id' => post('category_id'),
	                'name' => post('name'),
	                'description' => post('description'),
	                'price' => post('price'),
	                'price_unit' => post('price_unit')
	            );
        	}

        	if($siid) {
	            $this->BookingServiceItem_model->update($siid->id, $to_update);

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
    	$category_id = $this->BookingServiceItem_model->deleteServiceItemViaCategory(post('cat_id'));

		$this->activity_model->add("Category #$id Deleted by User:".logged('name'));

		/* Delete Service/items associated with category */
		$this->activity_model->add("Service/Item #$category_id Deleted by User:".logged('name'));

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
        		'page_instruction' => post('page_intro'),
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

        	$this->BookingScheduleAssignedUser_model->deleteAllBySettingId($userSetting->id);

        	if( post('convert_lead_to_work_order') == 1 ){
        		$assigned_batch_data = array();
	        	foreach( $post['lead_work_order_employees'] as $key => $user_id ){
	        		$assigned_batch_data[] = array(
	        			'booking_setting_id' => $userSetting->id,
	        			'user_id' => $user_id
	        		);
	        	}

	        	if( !empty($assigned_batch_data) ){
	        		$this->BookingScheduleAssignedUser_model->batchInsert($assigned_batch_data);
	        	}
        	}


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
        		'accept_booking_overlap_calendar_event' => post('event_all_check'),
        		'auto_schedule_work_order' => post('convert_lead_to_work_order'),
        		'google_analytics_tracking_id' => post('google_analytics_tracking_id'),
        		'website_url' => post('google_analytics_origin'),
        		'widget_status' => post('status')
        	);

        	$last_id = $this->BookingSetting_model->createSetting($data);

        	if( post('convert_lead_to_work_order') == 1 ){
        		$assigned_batch_data = array();
	        	foreach( $post['lead_work_order_employees'] as $key => $user_id ){
	        		$assigned_batch_data[] = array(
	        			'booking_setting_id' => $last_id,
	        			'user_id' => $user_id
	        		);
	        	}

	        	if( !empty($assigned_batch_data) ){
	        		$this->BookingScheduleAssignedUser_model->batchInsert($assigned_batch_data);
	        	}
        	}
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
        	if(!empty($t['days'])) {
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
        }

        $json_data = array('is_success' => true);

        echo json_encode($json_data);
    }

    public function ajax_save_service_item_visible_status()
    {
        postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        if( !empty($post) ) {
        	$service_item_id = $post['service_item_id'];
        	$is_visible = $post['is_visible'];
        	$siid = $this->BookingServiceItem_model->getById($service_item_id);

    		$to_update = array(
                'is_visible' => $is_visible
            );

        	if($siid) {
	            $this->BookingServiceItem_model->update($siid->id, $to_update);
	            $is_success = true;
        	} else {
	            $is_success = false;
        	}
        }

        $json_data = array('is_success' => $is_success);

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

    public function inquiries()
    {
    	$user      = $this->session->userdata('logged');
    	$inquiries = $this->BookingInquiry_model->findAllByUserId($user['id']);

    	$this->page_data['inquiries'] = $inquiries;
		$this->load->view('online_booking/inquiries', $this->page_data);
    }

    public function ajax_get_inquiry_details()
    {
    	$id = post('iid');
    	$inquiry = $this->BookingInquiry_model->findById($id);

    	$this->page_data['inquiry'] = $inquiry;
		$this->load->view('online_booking/ajax_get_inquiry_details', $this->page_data);
    }

    public function ajax_change_inquiry_status()
    {
    	$id = post('iid');
    	$inquiry = $this->BookingInquiry_model->findById($id);

    	$this->page_data['inquiry'] = $inquiry;
    	$this->page_data['inquiry_id'] = $id;
		$this->load->view('online_booking/ajax_change_inquiry_status', $this->page_data);
    }

    public function ajax_inquiry_edit_details()
    {
		$id = post('iid');
        $post = $this->input->post();    
        $inquiry = $this->BookingInquiry_model->findById($id);

        $this->page_data['inquiry'] = $inquiry;
        $this->page_data['inquiry_id'] = $id;
        $this->load->view('online_booking/ajax_inquiry_edit_details', $this->page_data);	
    }    

    public function front_items($eid)
	{
		$user_id = hashids_decrypt($eid, '', 15);
		$user = $this->session->userdata('logged');
		$userProfile = $this->Users_model->getUser($user_id);
		$categories  = $this->BookingCategory_model->getAllCategories();
		$booking_settings = $this->BookingSetting_model->findByUserId($user_id);

		$uri_segment_method_name = $this->uri->segment(2);

		$products = array();

		$post = $this->input->post();
		$search_query = '';
		$filters      = array();

		if( isset($post['search']) && $post['search'] !== '' ){
			$filters['search'] = $post['search'];
			$search_query      = $post['search'];
		}
		foreach( $categories as $c ){
			$products[$c->id]['products'] = $this->BookingServiceItem_model->getAllUserProductsByCategoryId($user_id, $c->id, $filters);
			$products[$c->id]['category'] = $c; 
		}

		if( $this->input->get('style') != '' ){
			$view = 'grid_items';
		}else{
			$view = 'front_items';
		}

		$coupon = $this->session->userdata('coupon');
		$cart_items = $this->session->userdata('cartItems');
		$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);

		$this->page_data['uri_segment_method_name'] = $uri_segment_method_name;
		$this->page_data['booking_settings'] = $booking_settings;
		$this->page_data['search_query'] = $search_query;
		$this->page_data['cart_data']    = $cart_data;
		$this->page_data['coupon']    = $coupon;
		$this->page_data['userProfile']  = $userProfile;
		$this->page_data['products']     = $products;
		$this->page_data['eid'] = $eid;

		$this->load->view('online_booking/' . $view, $this->page_data);
	}

	public function front_schedule($eid)
	{	
		$user_id = hashids_decrypt($eid, '', 15);
		$user = $this->session->userdata('logged');
		$userProfile = $this->Users_model->getUser($user_id);
		$booking_settings = $this->BookingSetting_model->findByUserId($user_id);		

		$coupon = $this->session->userdata('coupon');
		$cart_items = $this->session->userdata('cartItems');
		$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);
		$uri_segment_method_name = $this->uri->segment(2);

		$is_cont_to_booking_form = false;
		if(!empty($cart_items['schedule_data'])) {
			$is_cont_to_booking_form = true;
		}

		$this->page_data['is_cont_to_booking_form'] = $is_cont_to_booking_form;
		$this->page_data['uri_segment_method_name'] = $uri_segment_method_name;
		$this->page_data['booking_settings'] = $booking_settings;
		$this->page_data['week_start_date'] = date("Y-m-d");
		$this->page_data['cart_data']    = $cart_data;
		$this->page_data['coupon']    = $coupon;
		$this->page_data['userProfile']  = $userProfile;
		$this->page_data['eid'] = $eid;

		$this->load->view('online_booking/front_schedule', $this->page_data);
	}

    public function front_booking_form($eid)
	{	
		$user_id = hashids_decrypt($eid, '', 15);
		$user    = $this->session->userdata('logged');
		$userProfile = $this->Users_model->getUser($user_id);
		$booking_settings = $this->BookingSetting_model->findByUserId($user_id);

		$coupon = $this->session->userdata('coupon');
		$forms = $this->BookingForms_model->getAllByUserId($user_id);
		$cart_items = $this->session->userdata('cartItems');
		$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);
		$uri_segment_method_name = $this->uri->segment(2);

		$this->page_data['forms'] = $forms;
		$this->page_data['uri_segment_method_name'] = $uri_segment_method_name;
		$this->page_data['booking_settings'] = $booking_settings;
		$this->page_data['cart_data']        = $cart_data;
		$this->page_data['coupon']    = $coupon;
		$this->page_data['booking_schedule'] = $cart_items['schedule_data'];
		$this->page_data['userProfile']      = $userProfile;
		$this->page_data['eid'] = $eid;

		$this->load->view('online_booking/front_booking_form', $this->page_data);
	}	

	public function save_booking_inquiry()
    {
        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $default_form_fields = array(
			'Full Name' => 'full_name',
			'Contact Number' => 'contact_number',
			'Email' => 'email',
			'Addess' => 'address',
			'Messarge' => 'message',
			'Preferred Time To Contact' => 'preferred_time_to_contact',
			'How Did You Hear About Us' => 'how_did_you_hear_about_us',
		);

 		if(isset($post['is_visible'])){
        	$is_visible = $post['is_visible'];
    	}


        if(isset($post['is_required'])){
       		$is_required = $post['is_required'];
        }
        $field_names = $post['is_field'];
        $sort = 1;


        foreach ($field_names as $key => $value) {
        	if (in_array($key, $default_form_fields)) {
			    $default_field = 1;
			}else{
				$default_field = 0;
			}

			if(!isset($is_required[''.$key.''][0])){
				$is_required_value = 0;
			}else{
				$is_required_value = 1;
			}

			if(!isset($is_visible[''.$key.''][0])){
				$is_visible_value = 0;
			}else{
				$is_visible_value = 1;
			}

			$post_data[''.$sort.'']['field_name'] =  $key;
			$post_data[''.$sort.'']['label'] = str_replace("_"," ", ucfirst($key));
			$post_data[''.$sort.'']['type'] = 1;
			$post_data[''.$sort.'']['is_required'] = $is_required_value;
			$post_data[''.$sort.'']['is_visible'] = $is_visible_value;
			$post_data[''.$sort.'']['is_default'] = $default_field;
			$post_data[''.$sort.'']['sort'] = $sort;

		  $sort++;
        }


        if( !empty($post) ){

        	$this->BookingForms_model->deleteByUserId($user['id']);

        	foreach ($post_data as $key => $value) {
	        	$data = array(
	        		'user_id' => $user['id'],
	        		'field_name' => $value['field_name'],
	        		'label' => $value['label'],
	        		'type' => $value['type'],
	        		'is_required' => $value['is_required'],
	        		'is_visible' => $value['is_visible'],
	        		'is_default' => $value['is_default'],
	        		'sort' => $value['sort'],
	        		'date_created' => date("Y-m-d H:i:s")
	        	);
	        	$bookingCoupon = $this->BookingForms_model->create($data);
	        }

	        	$this->session->set_flashdata('message', 'Form Updated Successful');
        		$this->session->set_flashdata('alert_class', 'alert-success');

        }

        redirect('more/addon/booking/form');

    }

	public function ajax_get_product_details()
    {
    	$id = post('pid');
    	$product = $this->BookingServiceItem_model->getById($id);

    	$this->page_data['product'] = $product;
		$this->load->view('online_booking/ajax_get_product_details', $this->page_data);
    }

    /*Test encrypt*/
    public function generateProductUrl()
    {
    	$cart_items = $this->session->userdata('cartItems');
    	echo "<pre>";    	
    	print_r($cart_items);
    	exit;
    	$user = $this->session->userdata('logged');
    	$encrypted = hashids_encrypt($user['id'], '', 15);
    	$decrypted = hashids_decrypt($user['id'], '', 15);
    	echo $decrypted;exit;
    	echo "booking/products/" . $encrypted;
    	//echo "<br />" . $decrypted;
    	exit;
    }

    public function ajax_update_cart_item()
    {
    	$post       = $this->input->post();
    	$cart_items = $this->session->userdata('cartItems');
    	$key        = $post['pid'];
    	if( !empty($cart_items) ){
    		if( isset($cart_items['products'][$key]) ){
    			$new_qty = $post['qty'] + $cart_items['products'][$key];
    			$cart_items['products'][$key] = $new_qty;
    		}else{
    			$cart_items['products'][$key] = $post['qty'];
    		}
    	}else{
    		$cart_items['products'][$key] = $post['qty'];
    	}

    	$this->session->set_userdata('cartItems',$cart_items);    	

    	$this->session->set_flashdata('message', 'Cart was successfully updated');
        $this->session->set_flashdata('alert_class', 'alert-success');
    }

    public function ajax_update_cart_coupon()
    {
    	$post       = $this->input->post();
    	$coupon_code     = $post['coupon_code'];
    	$coupon_exist = $this->BookingCoupon_model->isCouponCodeExists($coupon_code);
    	if($coupon_exist){
    		$coupon = $this->BookingCoupon_model->getByCouponCode($coupon_code);
               $coupon_details = array(
					'coupon_name' => $coupon->coupon_name,
					'coupon_amount' => $coupon->discount_from_total,
					'coupon_code' => $coupon->coupon_code
				);

    		$cart_items['coupon'] = $coupon_details;
    	}

    	$this->session->set_userdata('coupon',$cart_items);    	

    	$this->session->set_flashdata('message', 'Cart was successfully updated');
        $this->session->set_flashdata('alert_class', 'alert-success');
    }

    public function ajax_delete_cart_item()
    {
    	$post = $this->input->post();
    	$cart_items = $this->session->userdata('cartItems');
    	$session_key = "pid_" . $post['pid'];
    	unset($cart_items[$session_key]);

    	$this->session->set_userdata('cartItems',$cart_items);    	

    }

    public function ajax_load_week_schedule()
    {
    	$post = $this->input->post();
    	$user_id    = hashids_decrypt($post['eid'], '', 15);
    	$start_date = $post['week_start_date'];
    	$end_date   = date("Y-m-d", strtotime($start_date . " +7 days"));

    	$start      = new \DateTime($start_date);
        $end        = new \DateTime($end_date);
        $interval   = \DateInterval::createFromDateString('1 day');
        $period     = new \DatePeriod($start, $interval, $end);

		$cart_items = $this->session->userdata('cartItems');  

        $schedules = $this->BookingTimeSlot_model->findAllByUserId($user_id);

        $week_schedules = array();

        foreach ($period as $dt) { 
            $date = $dt->format("Y-m-d"); 
            $week_schedules[$date] = array(); 

            foreach( $schedules as $s ){
            	$day = $dt->format("D");
            	$days = unserialize($s->days);
            	if( in_array($day, $days) ){
            		$week_schedules[$date][] = ['id' => $s->id, 'time_start' => $s->time_start, 'time_end' => $s->time_end]; 
            	}
            }
        }     

        $prev_date = date("Y-m-d", strtotime($start_date . " -7 days"));
        $next_date = date("Y-m-d", strtotime($start_date . " +7 days"));

        $selected_sched = array();
        if(!empty($cart_items['schedule_data'])) {
        	$selected_sched = $cart_items['schedule_data'];
        }

        $this->page_data['selected_sched'] = $selected_sched;
        $this->page_data['eid'] = $post['eid'];
        $this->page_data['prev_date'] = $prev_date;
        $this->page_data['next_date'] = $next_date;
        $this->page_data['week_schedules'] = $week_schedules;
		$this->load->view('online_booking/ajax_load_week_schedule', $this->page_data);
    }

    public function ajax_user_set_schedule()
    {
    	$post = $this->input->post();
    	$cart_items = $this->session->userdata('cartItems');
    	$cart_items['schedule_data'] = $post;

    	$this->session->set_userdata('cartItems',$cart_items);    	
    }

    public function save_product_booking()
    {
    	$post    = $this->input->post();
    	$user_id = hashids_decrypt($post['eid'], '', 15);
    	$user    = $this->Users_model->getUser($user_id);

    	if( $user ){
    		$data_booking_info = [
	    		'user_id' => $user->id,
	    		'name' => $post['full_name'],
	    		'phone' => $post['contact_number'],
	    		'email' => $post['email'],
	    		'address' => $post['address'],
	    		'message' => $post['message'],
	    		'preferred_time_to_contact' => $post['preferred_time_to_contact'],
	    		'how_did_you_hear_about_us' => $post['how_did_you_hear_about_us'],
	    		'form_data' => '',
	    		'status' => 1,
	    		'date_created' => date("Y-m-d H:i:s")
	    	];

	    	$booking_info_id = $this->BookingInfo_model->save($data_booking_info);

	    	if( $booking_info_id > 0 ){
	    		$cart_items = $this->session->userdata('cartItems');
				$cart_data  = $this->BookingServiceItem_model->getUserCartSummary($cart_items);
				foreach( $cart_items['products'] as $pid =>  $qty ){
					$data_booking_work_orders = [
						'booking_info_id' => $booking_info_id,
						'service_item_id' => $pid,
						'quantity_ordered' => $qty,
						'schedule_date' => $cart_items['schedule_data']['date'],
						'schedule_time_from' => $cart_items['schedule_data']['time_start'],
						'schedule_time_to' => $cart_items['schedule_data']['time_end'],
						'date_created' => date("Y-m-d H:i:s")
					];

					$this->BookingWorkOrder_model->create($data_booking_work_orders);
				}

				$this->session->set_flashdata('message', 'Your product booking has been saved.');
        		$this->session->set_flashdata('alert_class', 'alert-info');	

	    	}else{
	    		$this->session->set_flashdata('message', 'Canot save data. Please try again later.');
        		$this->session->set_flashdata('alert_class', 'alert-danger');	
	    	}

    	}else{
    		$this->session->set_flashdata('message', 'Merchant not found');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
    	}

    	$this->session->unset_userdata('cartItems');

        redirect('booking/products/'.$post['eid']);
    }

}

/* End of file Booking.php */
/* Location: ./application/controllers/Booking.php */
