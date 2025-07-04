<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->checkLogin();
		$this->hasAccessModule(7);

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

	public function index() 
	{
		if(!checkRoleCanAccessModule('online-booking', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Online Booking';
        $this->page_data['page']->parent = 'More';
        $this->page_data['page']->tab = "Dashboard";

		$user = $this->session->userdata('logged');
		$cid  = logged('company_id');
    	$eid  = hashids_encrypt($cid, '', 15);    	

		$total_category = $this->BookingCategory_model->countTotalByCompanyId($cid);
		$total_products = $this->BookingServiceItem_model->countTotalByCompanyId($cid);
		$total_timeslots = $this->BookingTimeSlot_model->countTotalByCompanyId($cid);
		$total_new_inquiry = $this->BookingInfo_model->countTotalNewByCompanyId($cid);

		$this->page_data['eid']   = $eid;
		$this->page_data['total_category']  = $total_category;
		$this->page_data['total_products']  = $total_products;
		$this->page_data['total_timeslots'] = $total_timeslots;
		$this->page_data['total_new_inquiry'] = $total_new_inquiry;
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		// $this->load->view('online_booking/index', $this->page_data);
		$this->load->view('v2/pages/online_booking/index', $this->page_data);
	}

	public function products() {
        $this->page_data['page']->title = 'Online Booking';
        $this->page_data['page']->parent = 'More';
        $this->page_data['page']->tab = "Products";

		$user_id = logged('id');
        $role_id = logged('role');
        
        $args = array('company_id' => logged('company_id'));
		$category = $this->BookingCategory_model->getByWhere($args);
		$service_items = $this->BookingServiceItem_model->getAllItemsGroupByCategoryArray();

		$this->page_data['category'] = $category;
		$this->page_data['service_items'] = $service_items;
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));

		// $this->load->view('online_booking/products', $this->page_data);
		$this->load->view('v2/pages/online_booking/products', $this->page_data);
	}

	public function time() 
	{
		if(!checkRoleCanAccessModule('online-booking', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Online Booking';
        $this->page_data['page']->parent = 'More';
        $this->page_data['page']->tab = "Time Slots";

        $cid = logged('company_id');
        $bookingTimeSlots = $this->BookingTimeSlot_model->findAllByCompanyId($cid);

        $this->page_data['bookingTimeSlots'] = $bookingTimeSlots;
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		// $this->load->view('online_booking/time', $this->page_data);
		$this->load->view('v2/pages/online_booking/time', $this->page_data);
	}

	public function form() 
	{
		if(!checkRoleCanAccessModule('online-booking', 'read')){
			show403Error();
			return false;
		}

		$company_id = logged('company_id');
		$default_form_fields  = $this->BookingForms_model->defaultFormFields();		
		$booking_forms 	      = $this->BookingForms_model->getAllByCompanyId($company_id);
		$booking_forms_custom = $this->BookingForms_model->getAllCustomByCompanyId($company_id);
		
        $this->page_data['page']->tab = "Booking Form";
		$this->page_data['booking_forms'] = $booking_forms;
		$this->page_data['default_form_fields'] = $default_form_fields;
		$this->page_data['booking_forms_custom'] = $booking_forms_custom;
        $this->page_data['page']->title = 'Online Booking';
		$this->load->view('v2/pages/online_booking/form', $this->page_data);
	}

	public function ajax_create_form_field()
	{
		$is_success = 0;
		$msg = 'Cannot save data.';

		$company_id = logged('company_id');
		$user_id    = logged('id');
		$post = $this->input->post();

		$isExists = $this->BookingForms_model->getByFieldName($post['field_name']);
		if( $isExists && $isExists->company_id == $company_id ){
			$msg = 'Field name ' . $post['field_name'] . ' already exits.';
		}else{
			$field_name = $this->BookingForms_model->createFieldName($post['field_name']);
			$lastSort   = $this->BookingForms_model->getLastSortNumberByCompanyId($company_id);
			$data = [
				'company_id' => $company_id, 
				'user_id' => $user_id,
				'field_name' => $field_name,
				'label' => $post['field_name'],
				'type' => 1,
				'is_required' => 0,
				'is_visible' => 1,
				'is_default' => 0,
				'sort' => $lastSort->sort + 1,
				'date_created' => date("Y-m-d H:i:s")
			];

			$this->BookingForms_model->create($data);

			//Activity Logs
			$activity_name = 'Online Booking : Created new form field ' . $post['field_name']; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
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
	        		'company_id' => logged('company_id'),
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

	public function coupons( $param = '' ) 
	{
		if(!checkRoleCanAccessModule('online-booking', 'read')){
			show403Error();
			return false;
		}

		$company_id = logged('company_id');
		$filters[] = [
			'field' => 'company_id', 'value' => $company_id
		];
		
		if( $param == 'active' ){
			$coupons = $this->BookingCoupon_model->getAllActive($filters);
		}elseif( $param == 'closed' ){
			$coupons = $this->BookingCoupon_model->getAllClosed($filters);
		}else{		
			$coupons = $this->BookingCoupon_model->getAllByCompanyId($company_id);
		}
				
		$total_active = $this->BookingCoupon_model->totalActive($filters);
		$total_closed = $this->BookingCoupon_model->totalClosed($filters);

		$this->page_data['page']->tab = "Coupons";
        $this->page_data['page']->title = 'Online Booking';
		$this->page_data['total_active'] = $total_active;
		$this->page_data['total_closed'] = $total_closed;
		$this->page_data['coupons'] = $coupons;
		$this->page_data['active_tab'] = $param;
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->load->view('v2/pages/online_booking/coupons', $this->page_data);
	}

	public function settings() 
	{

		if(!checkRoleCanAccessModule('online-booking', 'read')){
			show403Error();
			return false;
		}
        
		$user_id        = logged('id');
		$company_id     = logged('company_id');
		$bookingSetting = $this->BookingSetting_model->findByCompanyId($company_id);
		$employees      = $this->Users_model->findAllUsersByCompanyId($company_id);

		$aasignedUsers = array();
		$setting       = array();

		if( $bookingSetting ){
			$bookingScheduleAssignedUsers = $this->BookingScheduleAssignedUser_model->findAllByBookingSettingId($bookingSetting->id);
			$setting = array(
				'page_title' => $bookingSetting->page_title,
				'page_intro' => $bookingSetting->page_introduction,
				'page_instructions' => $bookingSetting->page_instruction,
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
				'page_instructions' => '',
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
		$this->page_data['setting']   = $setting;		
        $this->page_data['page']->tab = "Settings";
		$this->page_data['page']->title = 'Online Booking';
		$this->load->view('v2/pages/online_booking/settings', $this->page_data);
	}

	public function preview() 
	{
		if(!checkRoleCanAccessModule('online-booking', 'read')){
			show403Error();
			return false;
		}
		
		$user = $this->session->userdata('logged');
		$cid  = logged('company_id');
    	$eid  = hashids_encrypt($cid, '', 15);

    	$this->page_data['eid']   = $eid;
		$this->page_data['users'] = $this->users_model->getUser(logged('id'));
		$this->page_data['page']->title = 'Online Booking';
        $this->page_data['page']->tab = "Preview";
		$this->load->view('v2/pages/online_booking/preview', $this->page_data);
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
	        		'company_id' => logged('company_id'),
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

    	$id  = post('cid');
    	$cid = logged('company_id');
    	$coupon = $this->BookingCoupon_model->getByIdAndCompanyId($id, $cid);

    	$this->page_data['coupon'] = $coupon;
		$this->load->view('v2/pages/online_booking/ajax_edit_coupon', $this->page_data);
    }

    public function delete_coupon()
    {
    	$cid = logged('company_id');
    	$id  = $this->BookingCoupon_model->deleteCouponByIdAndCompanyId(post('cid'), $cid);

		$this->activity_model->add("Coupon #$id Deleted by User:".logged('name'));

		$this->session->set_flashdata('message', 'Coupon has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('more/addon/booking/coupons');
    }

    public function update_coupon()
    {
    	postAllowed();

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

        $user_id    = logged('id');
		$company_id = logged('company_id');
        $post = $this->input->post();

        if( !empty($post) ){
        	$this->load->model('BookingCategory_model');

        	$data = array(
        		'user_id' => $user_id,
        		'company_id' => $company_id,
        		'name' => post('category_name'),
        		'date_created' => date("Y-m-d H:i:s")
        	);
        	$bookingCoupon = $this->BookingCategory_model->create($data);

        	$this->session->set_flashdata('message', 'Add New Category Successful');
        	$this->session->set_flashdata('alert_class', 'alert-success');
        }

        redirect('more/addon/booking/products');
    }

	public function ajax_save_category()
    {
		$this->load->model('BookingCategory_model');

        $is_success = 1;
        $msg = '';

        $user_id    = logged('id');
		$company_id = logged('company_id');
        $post = $this->input->post();

        if( !empty($post) ){
			$isExists = $this->BookingCategory_model->getByNameAndCompanyId($post['category_name'], $company_id);
			if( $isExists ){
				$is_success = 0;
				$msg = 'Category name ' . $post['category_name'] . ' already exists.';
			}else{
				$data = array(
					'user_id' => $user_id,
					'company_id' => $company_id,
					'name' => $post['category_name'],
					'date_created' => date("Y-m-d H:i:s")
				);
				
				$this->BookingCategory_model->create($data);
	
				//Activity Logs
				$activity_name = 'Online Booking : Created category ' . $post['category_name']; 
				createActivityLog($activity_name);
			}
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_edit_category()
    {
    	$id = post('cat_id');
    	$category = $this->BookingCategory_model->getById($id);

    	$this->page_data['category'] = $category;
    	$this->page_data['category_id'] = $id;
		// $this->load->view('online_booking/ajax_edit_category', $this->page_data);
		$this->load->view('v2/pages/online_booking/ajax_edit_category', $this->page_data);
    }

    public function ajax_edit_service_item()
    {
    	$id = post('siid');
    	$service_item = $this->BookingServiceItem_model->getById($id);
    	$category = $this->BookingCategory_model->getAll();

    	$this->page_data['service_item'] = $service_item;
    	$this->page_data['category'] = $category;
    	$this->page_data['service_item_id'] = $id;
		// $this->load->view('online_booking/ajax_edit_service_item', $this->page_data);
		$this->load->view('v2/pages/online_booking/ajax_edit_service_item', $this->page_data);
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
	                'status' => post('status'),
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

	public function ajax_update_inquiry_details()
	{
		$is_success = 0;
		$msg = 'Cannot find data';

		$post = $this->input->post();
		$id   = $post['inquiry_id'];
		$company_id = logged('company_id');

		$bookingInquiry = $this->BookingInquiry_model->findById($id);
		if($bookingInquiry && $bookingInquiry->company_id == $company_id) {
			$this->BookingInquiry_model->update($bookingInquiry->id, array(
				'name' => $post['name'],
				'phone' => $post['phone'],
				'email' => $post['email'],
				'address' => $post['address'],
				'message' => $post['message'],
				'preferred_time_to_contact' => $post['preferred_time_to_contact'],
				'how_did_you_hear_about_us' => $post['how_did_you_hear_about_us'],
				'status' => $post['status']
			));
			
			//Activity Logs
			$activity_name = 'Online Booking : Updated inquiry details'; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}  

		$return = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($return);
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
        		'company_id' => logged('company_id'),
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

	public function ajax_save_service_item()
    {
		$this->load->model('BookingServiceItem_model');

		$is_success = 1;
        $msg = '';

        $user_id = logged('id');
		$company_id = logged('company_id');
        $post = $this->input->post();

		$product_image = '';
		if( isset($_FILES['product_image']) && $_FILES['product_image']['size'] > 0 ){

			$target_dir = './uploads/service_item/'.$company_id.'/';

			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			$config = array(
				'upload_path' => $target_dir,
				'allowed_types' => '*',
				'overwrite' => TRUE,
				'max_size' => '20000',
				'max_height' => '0',
				'max_width' => '0',
				'encrypt_name' => true
			);

			$this->load->library('upload',$config);
			$config = $this->uploadlib->initialize($config);
			if ($this->upload->do_upload("product_image")){
				$uploadData    = $this->upload->data();	
				$product_image = $uploadData['file_name'];
			}
		}

        if( !empty($post) ){
        	$data = array(
        		'company_id' => $company_id,
        		'user_id' => $user_id,
        		'category_id' => $post['category_id'],
        		'name' => $post['name'],
        		'description' => $post['description'],
        		'price' => $post['price'],
        		'price_unit' => $post['price_unit'],
        		'image' => $product_image,
        		'date_created' => date("Y-m-d H:i:s")
        	);
        	$bookingServiceItem = $this->BookingServiceItem_model->create($data);
        }

        $return = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($return);
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
    	$cid = logged('company_id');
    	$id  = $this->BookingServiceItem_model->deleteServiceItemByIdAndCompanyId(post('siid'), $cid);

		$this->activity_model->add("Service/Item #$id Deleted by User:".logged('name'));

		$this->session->set_flashdata('message', 'Service/Item has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('more/addon/booking/products');
    }

    public function ajax_save_setting()
    {
        $user_id    = logged('id');
		$company_id = logged('company_id');
        $post       = $this->input->post();

        $bookingSetting = $this->BookingSetting_model->findByCompanyId($company_id);
        if( $bookingSetting ){
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
        		//'auto_schedule_work_order' => post('convert_lead_to_work_order'),
				'auto_schedule_work_order' => 0,
        		'google_analytics_tracking_id' => post('google_analytics_tracking_id'),
        		'website_url' => post('google_analytics_origin'),
        		'widget_status' => post('status')
        	);

        	$this->BookingSetting_model->update($bookingSetting->id, $data);

        	$this->BookingScheduleAssignedUser_model->deleteAllBySettingId($bookingSetting->id);

        	// if( post('convert_lead_to_work_order') == 1 ){
        	// 	$assigned_batch_data = array();
	        // 	foreach( $post['lead_work_order_employees'] as $key => $user_id ){
	        // 		$assigned_batch_data[] = array(
	        // 			'booking_setting_id' => $bookingSetting->id,
	        // 			'user_id' => $user_id
	        // 		);
	        // 	}

	        // 	if( !empty($assigned_batch_data) ){
	        // 		$this->BookingScheduleAssignedUser_model->batchInsert($assigned_batch_data);
	        // 	}
        	// }

        }else{
        	$data = array(
        		'company_id' => $company_id,
        		'user_id' => $user_id,
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

        	$last_id = $this->BookingSetting_model->create($data);

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

		//Activity Logs
		$activity_name = 'Online Booking : Updated booking setting.'; 
		createActivityLog($activity_name);

        $json_data = array('is_success' => true);

        echo json_encode($json_data);
    }

    public function ajax_save_time_slot()
    {
        $user_id = logged('id');
		$company_id = logged('company_id');
        $post = $this->input->post();

        $this->BookingTimeSlot_model->deleteAllCompanyTimeSlots($company_id);

        foreach( $post['time'] as $t ){
        	if(!empty($t['days'])) {
	            $days = serialize($t['days']);
	            $data = array(
	            	'company_id' => $company_id,
	                'user_id' => $user_id,
	                'time_start' => $t['time_start'],
	                'time_end' => $t['time_end'],
	                'days' => $days,
	                'availability' => post('soonest_availability'),
	                'date_created' => date("Y-m-d H:i:s")
	            );
	            $bookingTimeSlots = $this->BookingTimeSlot_model->create($data);
        	}
        }

		//Activity Logs
		$activity_name = 'Online Booking : Updated booking time slot.'; 
		createActivityLog($activity_name);

        $json_data = array('is_success' => true);

        echo json_encode($json_data);
    }

    public function ajax_save_service_item_visible_status()
    {
        postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();
		$is_success = false;

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
		$is_success = false;
		$msg = 'Cannot find data';

		$company_id  = logged('company_id');
		$bookingSlot = $this->BookingTimeSlot_model->findById(post('tid'));
		if( $bookingSlot && $bookingSlot->company_id == $company_id ){
			$this->BookingTimeSlot_model->deleteTimeSlot(post('tid'));

			//Activity Logs
			$activity_name = 'Online Booking : Deleted time slot.'; 
			createActivityLog($activity_name);

			$this->activity_model->add("Time Slot #$id Deleted by User:".logged('name'));        
		}
        

        $json_data = array('is_success' => $is_success, 'msg' => $msg);
        echo json_encode($json_data);
    }

    public function inquiries()
    {
		if(!checkRoleCanAccessModule('online-booking', 'read')){
			show403Error();
			return false;
		}

    	$cid = logged('company_id');
    	$inquiries = $this->BookingInquiry_model->findAllByCompanyId($cid);

		$this->page_data['page']->title = 'Online Booking';
        $this->page_data['page']->tab = "Inquiry";
    	$this->page_data['inquiries'] = $inquiries;
		$this->load->view('v2/pages/online_booking/inquiries', $this->page_data);
    }

    public function ajax_get_inquiry_details()
    {
    	$inquiry_id = 0;
    	$work_order_summary = array();
    	$id = post('iid');
    	$inquiry = $this->BookingInquiry_model->findById($id);

    	if($inquiry) {
    		$inquiry_id = $inquiry->id;

    		$work_order_details = $this->BookingWorkOrder_model->getByBookingInfoId($inquiry_id);


    		foreach($work_order_details as $wod) {
    			$service_item_details = $this->BookingServiceItem_model->getById($wod->service_item_id);
    			if($service_item_details) {
    				$work_order_summary[$wod->id]['service_name'] = $service_item_details->name;
    				$work_order_summary[$wod->id]['service_description'] = $service_item_details->description;
    				$work_order_summary[$wod->id]['price'] = $service_item_details->price;
    				$work_order_summary[$wod->id]['unit'] = $service_item_details->price_unit;
    			} else {
    				$work_order_summary[$wod->id]['service_name'] = '';
    				$work_order_summary[$wod->id]['service_description'] = '';
    				$work_order_summary[$wod->id]['price'] = '';
    				$work_order_summary[$wod->id]['unit'] = '';
    			}

				$work_order_summary[$wod->id]['coupon_name'] = '';
				$work_order_summary[$wod->id]['coupon_type'] = '';
				$work_order_summary[$wod->id]['coupon_discount'] = '';
    			if($wod->coupon_id != null || $wod->coupon_id != 0) {
	    			$coupon_details = $this->BookingCoupon_model->getById($wod->coupon_id);
	    			if($coupon_details) {
	    				$work_order_summary[$wod->id]['coupon_name'] = $coupon_details->coupon_name;
	    				$work_order_summary[$wod->id]['coupon_type'] = $coupon_details->discount_from_total_type;
	    				$work_order_summary[$wod->id]['coupon_discount'] = $coupon_details->discount_from_total;
	    			}
    			}

    			$work_order_summary[$wod->id]['schedule_date'] = $wod->schedule_date;
    			$work_order_summary[$wod->id]['quantity_ordered'] = $wod->quantity_ordered;
    			$work_order_summary[$wod->id]['schedule_time_from'] = $wod->schedule_time_from;
    			$work_order_summary[$wod->id]['schedule_time_to'] = $wod->schedule_time_to;

    		}
    	}

    	$this->page_data['inquiry'] = $inquiry;
    	$this->page_data['work_order_summary'] = $work_order_summary;
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
		$id   = post('iid');
		$cid  = logged('company_id'); 
        $post = $this->input->post();
        $inquiry = $this->BookingInquiry_model->findByIdAndCompanyId($id, $cid);

        $this->page_data['inquiry'] = $inquiry;
        $this->page_data['inquiry_id'] = $id;
        $this->load->view('v2/pages/online_booking/ajax_inquiry_edit_details', $this->page_data);
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

		/*echo '<pre>';
		print_r($coupon);
		echo '</pre>';*/

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

    	/*$coupon_exist = $this->BookingCoupon_model->isCouponCodeExists($coupon_code);
    	if($coupon_exist){
    		$coupon = $this->BookingCoupon_model->getByCouponCode($coupon_code);
               $coupon_details = array(
					'coupon_name' => $coupon->coupon_name,
					'coupon_amount' => $coupon->discount_from_total,
					'coupon_code' => $coupon->coupon_code
				);

    		$cart_items['coupon'] = $coupon_details;
    	}*/

    	if(!empty($coupon_code) || $coupon_code != null) {
	    	$coupon_exist = $this->BookingCoupon_model->isCouponCodeExists($coupon_code);
	    	if($coupon_exist){
	    		$coupon = $this->BookingCoupon_model->getByCouponCode($coupon_code);

	                $coupon_details = array(
						'coupon_name' => $coupon->coupon_name,
						'coupon_amount' => $coupon->discount_from_total,
						'coupon_code' => $coupon->coupon_code,
						'type' => $coupon->discount_from_total_type,
						'id' => $coupon->id,
					);

	    		$cart_items['coupon'] = $coupon_details;
	    	}

	    	$this->session->set_userdata('coupon',$cart_items);

	    	$this->session->set_flashdata('message', 'Cart was successfully updated');
	        $this->session->set_flashdata('alert_class', 'alert-success');
    	}
    }

    public function ajax_delete_cart_item()
    {
    	$post = $this->input->post();
    	$cart_items = $this->session->userdata('cartItems');

    	$session_key = "pid_" . $post['pid'];
    	$session_key_id = $post['pid'];
    	unset($cart_items[$session_key]);
    	unset($cart_items['products'][$session_key_id]);

    	$this->session->set_userdata('cartItems',$cart_items);
    }

    public function ajax_delete_coupon()
    {
    	//$post = $this->input->post();
    	unset($_SESSION['coupon']);
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
    	$coupon_id  = null;
    	$custom_fields = array();
    	$post    = $this->input->post();
    	$user_id = hashids_decrypt($post['eid'], '', 15);
    	$user    = $this->Users_model->getUser($user_id);
    	$cart_items = $this->session->userdata('cartItems');
    	$coupon = $this->session->userdata('coupon');

    	$in_array = array(
    					'full_name', 'contact_number','email',
    					'address','message','preferred_time_to_contact',
    					'how_did_you_hear_about_us','eid'
    				);

    	foreach($post as $p_key => $p) {
			if (!in_array($p_key, $in_array)) {
			    $custom_fields[$p_key] = $p;
			}
    	}

    	if(isset($coupon)) {
    		$coupon_id = $coupon['coupon']['id'];
    	}

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
	    		'form_data' => serialize($custom_fields),
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
						'coupon_id' => $coupon_id,
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
    	$this->session->unset_userdata('coupon');
        redirect('booking/products/'.$post['eid']);
    }

    public function delete_inquiry()
    {
    	$cid = logged('company_id');
    	$iid = post('iid');
    	$id  = $this->BookingInquiry_model->deleteByIdAndCompanyId($iid, $cid);

		$this->activity_model->add("Online Inquiry #$iid Deleted by User:".logged('name'));

		$this->session->set_flashdata('message', 'Online Inquiry has been Deleted Successfully');
		$this->session->set_flashdata('alert_class', 'alert-success');

		redirect('more/addon/inquiries');
    }

    public function ajax_view_inquiry()
    {
		$id   = post('iid');
		$cid  = logged('company_id'); 
        $post = $this->input->post();
        $inquiry = $this->BookingInquiry_model->findByIdAndCompanyId($id, $cid);
        $bookingItems   = $this->BookingWorkOrder_model->getByBookingInfoId($id);
        
        $this->page_data['inquiry']    = $inquiry;
        $this->page_data['inquiry_id'] = $id;
        $this->page_data['bookingItems'] = $bookingItems;
        $this->load->view('v2/pages/online_booking/ajax_view_inquiry', $this->page_data);
    }

	public function ajax_create_coupon()
	{
		$is_success = 0;
		$msg = 'Cannot save data.';

		$company_id = logged('company_id');
		$user_id    = logged('id');
		$post 	    = $this->input->post();

		$isCouponNameExists = $this->BookingCoupon_model->getByName($post['name']);
		$isCouponCodeExists = $this->BookingCoupon_model->getByCouponCode($post['code']);
		if( $isCouponNameExists && $isCouponNameExists->company_id == $company_id ){
			$msg = 'Coupon name ' . $post['name'] . ' already exits.';
		}elseif( $isCouponCodeExists && $isCouponCodeExists->company_id == $company_id ){
			$msg = 'Coupon code ' . $post['code'] . ' already exits.';
		}else{
			$data = array(
				'user_id' => $user_id,
				'company_id' => $company_id,
				'coupon_name' => $post['name'],
				'coupon_code' => $post['code'],
				'discount_from_total' => $post['discount_type'] == 1 ? $post['discount_percent'] : $post['discount_amount'],
				'discount_from_total_type' => $post['discount_type'],
				'date_valid_from' => date("Y-m-d",strtotime($post['valid_from'])),
				'date_valid_to' => date("Y-m-d",strtotime($post['valid_to'])),
				'used_per_coupon' => $post['uses_max'],
				'status' => $post['status'],
				'date_created' => date("Y-m-d H:i:s")
			);
			$bookingCoupon = $this->BookingCoupon_model->create($data);

			//Activity Logs
			$activity_name = 'Online Booking : Created new coupon ' .$post['name']. '/' . $post['code']; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_update_coupon()
	{
		$is_success = 0;
		$msg = 'Cannot find data.';

		$company_id = logged('company_id');
		$user_id    = logged('id');
		$post 	    = $this->input->post();

		$isCouponNameExists = $this->BookingCoupon_model->getByName($post['name']);
		$isCouponCodeExists = $this->BookingCoupon_model->getByCouponCode($post['code']);
		$coupon 			= $this->BookingCoupon_model->getById($post['cid']);
		if( $isCouponNameExists && $isCouponNameExists->company_id == $company_id && $post['cid'] != $isCouponNameExists->id ){
			$msg = 'Coupon name ' . $post['name'] . ' already exits.';
		}elseif( $isCouponCodeExists && $isCouponCodeExists->company_id == $company_id && $post['cid'] != $isCouponCodeExists->id ){
			$msg = 'Coupon code ' . $post['code'] . ' already exits.';
		}else{
			if( $coupon ){
				$data = array(
					'user_id' => $user_id,
					'coupon_name' => $post['name'],
					'coupon_code' => $post['code'],
					'discount_from_total' => $post['discount_type'] == 1 ? $post['discount_percent'] : $post['discount_amount'],
					'discount_from_total_type' => $post['discount_type'],
					'date_valid_from' => date("Y-m-d",strtotime($post['valid_from'])),
					'date_valid_to' => date("Y-m-d",strtotime($post['valid_to'])),
					'used_per_coupon' => $post['uses_max'],
					'status' => $post['status'],
					'date_created' => date("Y-m-d H:i:s")
				);
				$bookingCoupon = $this->BookingCoupon_model->update($coupon->id, $data);
	
				//Activity Logs
				$activity_name = 'Online Booking : Updated coupon ' .$post['name']. '/' . $post['code']; 
				createActivityLog($activity_name);
	
				$is_success = 1;
				$msg = '';
			}
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_coupon_v2()
	{
		$is_success = 0;
		$msg = 'Cannot find data.';

		$company_id = logged('company_id');
		$post 	    = $this->input->post();
		
		$coupon = $this->BookingCoupon_model->getById($post['coupon_id']);
		if( $coupon && $coupon->company_id == $company_id ){
			$this->BookingCoupon_model->delete($coupon->id);

			//Activity Logs
			$activity_name = 'Online Booking : Deleted coupon ' .$coupon->coupon_name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_inquiry()
	{
		$is_success = 0;
		$msg = 'Cannot find data.';

		$company_id = logged('company_id');
		$post 	    = $this->input->post();

		$cid = logged('company_id');
    	$iid = post('iid');
		$bookingInquiry = $this->BookingInquiry_model->findById($iid);
		if( $bookingInquiry && $bookingInquiry->company_id == $cid ){
			$this->BookingInquiry_model->deleteByIdAndCompanyId($iid, $cid);

			$this->activity_model->add("Online Inquiry #$iid Deleted by User:".logged('name'));

			//Activity Logs
			$activity_name = 'Online Booking : Deleted inquiry dated ' . date("m/d/Y", strtotime($bookingInquiry->schedule_date)) . ' by ' . $bookingInquiry->name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

}

/* End of file Booking.php */
/* Location: ./application/controllers/Booking.php */
