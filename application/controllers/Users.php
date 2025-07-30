<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->checkLogin();

		add_css(array(
			"assets/css/timesheet.css",
		));

		add_footer_js(array(
			'assets/js/user.js'
		));

		$this->page_data['page']->title = 'Users Management';
		$this->page_data['page']->menu = 'users';

		add_css(array(
			"assets/plugins/dropzone/dist/dropzone.css",
			'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
			'assets/frontend/css/businessprofile/main.css',
			'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css'
		));

		// JS to add only Job module
		add_footer_js(array(
			"assets/plugins/dropzone/dist/dropzone.js",
			'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js'
		));

		$this->load->model('IndustryType_model');
		$this->load->model('Users_model');
		$this->load->model('Timesheet_model');
		$this->load->model('ServiceCategory_model');
		$this->load->model('PayScale_model');
		$this->load->model('Deductions_and_contribution_model');

		$this->load->model('General_model', 'general_model');
	}

	public function businessprofile()
	{
		$this->load->library('user_agent');
		$this->load->model('Business_model');
		$this->load->model('ServiceCategory_model');
		$this->load->model('DealsSteals_model');

		add_css(array(
			"assets/css/jquery.fancybox.css"
		));

		add_footer_js(array(
			"assets/js/jquery.fancybox.min.js"
		));

		$user    = (object)$this->session->userdata('logged');
		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);
		$selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($comp_id);

		$conditions[] = ['field' => 'deals_steals.status', 'value' => $this->DealsSteals_model->statusActive()];
		$dealsSteals = $this->DealsSteals_model->getAllByCompanyId($comp_id, array(), $conditions);

        $user_agent = $this->agent->agent_string();
        $ip_address = $this->input->ip_address();
        $this->Business_model->customerDeviceLookup("business_profile_visit", $ip_address, $user_agent);

		// var_dump($profiledata);

		// return;
		
		$this->page_data['dealsSteals'] = $dealsSteals;
		$this->page_data['profiledata'] = $profiledata;
		$this->page_data['selectedCategories'] = $selectedCategories;
		$this->load->view('pages/company_business_profile', $this->page_data);
	}

	public function businessview()
	{
		if(!checkRoleCanAccessModule('company-my-business', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'My Business';
        $this->page_data['page']->parent = 'Company';

		$this->load->model('DealsSteals_model');

		add_css(array(
			"assets/css/jquery.fancybox.css"
		));

		add_footer_js(array(
			"assets/js/jquery.fancybox.min.js"
		));

		//ifPermissions('businessdetail');
		$user = (object)$this->session->userdata('logged');
		$cid = logged('id');
		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);

		// var_dump($profiledata);

		// return;

		if ($profiledata->profile_slug == '') {
			$profile_slug = createSlug($profiledata->business_name, '-');
			$profile_slug = $profile_slug . "-0";
			$this->business_model->update($profiledata->id, ['profile_slug' => $profile_slug]);
		}

		$selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($comp_id);
		$schedules   = unserialize($profiledata->working_days);

		$conditions[] = ['field' => 'deals_steals.status', 'value' => $this->DealsSteals_model->statusActive()];
		$dealsSteals = $this->DealsSteals_model->getAllByCompanyId($comp_id, array(), $conditions);

		$this->page_data['selectedCategories'] = $selectedCategories;
		$this->page_data['profiledata'] = $profiledata;
		$this->page_data['dealsSteals'] = $dealsSteals;
		// $this->load->view('business_profile/business', $this->page_data);
		$this->load->view('v2/pages/business_profile/business', $this->page_data);
	}
	
	public function businessdetail()
	{
		if(!checkRoleCanAccessModule('company-my-business', 'write')){
			show403Error();
			return false;
		}

		add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'assets/js/profile/signature.js',
			'assets/js/jquery.signaturepad.js'
        ]);

        $this->page_data['page']->title = 'Business Details';
        $this->page_data['page']->parent = 'Company';

		//ifPermissions('businessdetail');
		$cid  = logged('id');
		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);
		$optionBusinessType = $this->business_model->optionBusinessTypes();
		//dd($profiledata);die;
		$this->page_data['userid'] = $cid;
		$this->page_data['profiledata'] = $profiledata;
		$this->page_data['optionBusinessType'] = $optionBusinessType;
		///$this->load->view('business_profile/businessdetail', $this->page_data);
		$this->load->view('v2/pages/business_profile/businessdetail', $this->page_data);
	}

	public function services()
	{
		if(!checkRoleCanAccessModule('company-my-services', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Services';
        $this->page_data['page']->parent = 'Company';

		$industryType = $this->IndustryType_model->getAll();
		$businessTypes = [
			'Building Contractors' => 'Building Contractors',
			'Financial Services' => 'Financial Services',
			'Technical Services' => 'Technical Services',
			'Health And Beauty' => 'Health And Beauty',
			'Transportation' => 'Transportation',
			'Organization / Cleaning' => 'Organization / Cleaning',
			'Entertainment Services' => 'Entertainment Services',
			'Design Services' => 'Design Services',
			'Other' => 'Other',
		];
		$company_id = logged('company_id');
		$selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($company_id);

		$this->page_data['industryType'] = $industryType;
		$this->page_data['businessTypes'] = $businessTypes;
		$this->page_data['selectedCategories'] = $selectedCategories;
		// $this->load->view('business_profile/services', $this->page_data);
		$this->load->view('v2/pages/business_profile/services', $this->page_data);
	}

	public function saveservices()
	{
		$is_success = 0;
		$msg = 'Cannot find data';
		
		$post = $this->input->post();

		$industryTemplate = $this->IndustryType_model->getById($post['type_id']);
		$categories = $post['categories'];

		if ($post['categories'] != '') {
			$company_id = logged('company_id');
			$ServiceCategory = $this->ServiceCategory_model->deleteCategoryByCompanyID($company_id);

			$categories = $post['categories'];
			foreach ($categories as $key => $category) {
				$data = [
					'company_id' => $company_id,
					'industry_type_id' => $key,
					'service_name' => $category,
					'date_created' => date("Y-m-d H:i:s"),
					'date_modified' => date("Y-m-d H:i:s")
				];
				$ServiceCategory = $this->ServiceCategory_model->create($data);
			}

			//Activity Logs
			$activity_name = 'My Business Services : Updated Business Services'; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}

		$return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
	}

	public function credentials()
	{
		if(!checkRoleCanAccessModule('company-my-credentials', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Credentials';
        $this->page_data['page']->parent = 'Company';
		//ifPermissions('businessdetail');

		$user = (object)$this->session->userdata('logged');
		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);
		$states = statesList();

		$this->page_data['states'] = $states;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata;
		$this->page_data['disable_clockjs'] = 1;
		// $this->load->view('business_profile/credentials', $this->page_data);
		$this->load->view('v2/pages/business_profile/credentials', $this->page_data);
	}

	public function availability()
	{
		if(!checkRoleCanAccessModule('company-my-availability', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Availability';
        $this->page_data['page']->parent = 'Company';

		$cid = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($cid);
		$workingDays = unserialize($profiledata->working_days);		

		$data_working_days = array();
		if (!empty($workingDays)) {
			foreach ($workingDays as $d) {
				$data_working_days[$d['day']] = ['time_from' => date("H:i:s",strtotime($d['time_from'])), 'time_to' => date("H:i:s", strtotime($d['time_to']))];
			}
		} else {
			$data_working_days['Monday']    = ['time_from' => '', 'time_to' => ''];
			$data_working_days['Tuesday']   = ['time_from' => '', 'time_to' => ''];
			$data_working_days['Wednesday'] = ['time_from' => '', 'time_to' => ''];
			$data_working_days['Thursday'] = ['time_from' => '', 'time_to' => ''];
			$data_working_days['Friday']   = ['time_from' => '', 'time_to' => ''];
			$data_working_days['Saturday'] = ['time_from' => '', 'time_to' => ''];
			$data_working_days['Sunday']   = ['time_from' => '', 'time_to' => ''];
		}
		
		$this->page_data['data_working_days'] = $data_working_days;
		$this->page_data['profiledata'] = $profiledata;
		// $this->load->view('business_profile/availability', $this->page_data);
		$this->load->view('v2/pages/business_profile/availability', $this->page_data);
	}

	public function portfolio()
	{
		if(!checkRoleCanAccessModule('company-my-portfolio', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Portfolio';
        $this->page_data['page']->parent = 'Company';

		add_css(array(
			"assets/css/jquery.fancybox.css"
		));

		add_footer_js(array(
			"assets/js/jquery.fancybox.min.js"
		));

		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);

		$this->page_data['profiledata'] = $profiledata;
		$this->load->view('v2/pages/business_profile/work_pictures', $this->page_data);
	}

	public function profilesetting()
	{
		if(!checkRoleCanAccessModule('company-settings', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Profile Settings';
        $this->page_data['page']->parent = 'Company';
		//ifPermissions('businessdetail');

		add_css(array(
			"assets/css/bootstrap-tagsinput.css"
		));

		// JS to add only Job module
		add_footer_js(array(
			"assets/js/bootstrap-tagsinput.js"
		));

		$user = (object)$this->session->userdata('logged');
		//print_r($user);die;
		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);

		$this->page_data['company_id']  = $comp_id;
		$this->page_data['profiledata'] = $profiledata;
		// $this->load->view('business_profile/profile_settings', $this->page_data);
		$this->load->view('v2/pages/business_profile/profile_settings', $this->page_data);
	}

	public function socialMedia()
	{
		if(!checkRoleCanAccessModule('company-settings', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Social Media';
        $this->page_data['page']->parent = 'Company';
		//ifPermissions('businessdetail');

		$user = (object)$this->session->userdata('logged');
		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);

		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata;
		// $this->load->view('business_profile/social_media', $this->page_data);
		$this->load->view('v2/pages/business_profile/social_media', $this->page_data);
	}

	public function saveBusinessNameImage()
	{
		$pdata = $_POST;
		$bid   = $pdata['id'];
		$comp_id = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($comp_id);

		if (!empty($_FILES['image']['name'])) {
			$target_dir = "./uploads/users/business_profile/$profiledata->id/";
		
			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}
		
			$target_file = $target_dir . basename($_FILES['image']['name']);
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
				//business_image = $target_file; 
				$business_image = basename($_FILES['image']['name']);
				$this->business_model->update($bid, ['business_image' => $business_image]);
			} else {
				log_message('error', 'File upload failed for ' . $_FILES['image']['name']);
			}
		} else {
			copy(FCPATH . 'uploads/users/default.png', 'uploads/users/business_profile/' . $bid . '/default.png');
		}
		
		$this->business_model->update($bid, ['business_name' => $pdata['business_name'], 'business_desc' => $pdata['business_desc']],);

		echo 1;
		//redirect('users/businessview');
	}

	public function moveUploadedFile($bid)
	{
		if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
			$tmp_name = $_FILES['image']['tmp_name'];
			$extension = strtolower(end(explode('.', $_FILES['image']['name'])));
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = basename($_FILES["image"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/users/business_profile/$bid/$name");

			return $name;
		}
	}

	public function savebusinessdetail()
	{

		$is_success  = 0;
		$msg = 'Cannot find data';

		$user  = (object)$this->session->userdata('logged');
		$cid   = logged('company_id');
		$pdata = $this->input->post();
		$action = $pdata['action'];
		unset($pdata['action']);
		unset($pdata['id']);

		$profiledata = $this->business_model->getByCompanyId($cid);
		
		if ($action == 'availability') {
			$schedules = array();
			foreach ($pdata['weekday'] as $value) {
				switch ($value) {
					case 'Monday':
						$schedules[] = [
							'day' => 'Monday',
							'time_from' => $pdata['monHoursFromAvail'],
							'time_to' => $pdata['monHoursToAvail']
						];
						break;
					case 'Tuesday':
						$schedules[] = [
							'day' => 'Tuesday',
							'time_from' => $pdata['tueHoursFromAvail'],
							'time_to' => $pdata['tueHoursToAvail']
						];
						break;
					case 'Wednesday':
						$schedules[] = [
							'day' => 'Wednesday',
							'time_from' => $pdata['wedHoursFromAvail'],
							'time_to' => $pdata['wedHoursToAvail']
						];
						break;
					case 'Thursday':
						$schedules[] = [
							'day' => 'Thursday',
							'time_from' => $pdata['thuHoursFromAvail'],
							'time_to' => $pdata['thuHoursToAvail']
						];
						break;
					case 'Friday':
						$schedules[] = [
							'day' => 'Friday',
							'time_from' => $pdata['friHoursFromAvail'],
							'time_to' => $pdata['friHoursToAvail']
						];
						break;
					case 'Saturday':
						$schedules[] = [
							'day' => 'Saturday',
							'time_from' => $pdata['satHoursFromAvail'],
							'time_to' => $pdata['satHoursToAvail']
						];
						break;
					case 'Sunday':
						$schedules[] = [
							'day' => 'Sunday',
							'time_from' => $pdata['sunHoursFromAvail'],
							'time_to' => $pdata['sunHoursToAvail']
						];
						break;
					default:
						break;
				}
			}
			
			$schedules = serialize($schedules);
			$data_availability = [
				'working_days' => $schedules,
				'start_time_of_day' => $pdata['timeoff_from'],
				'end_time_of_day' => $pdata['timeoff_to']
			];
			$this->business_model->updateByCompanyId($cid, $data_availability);

			//Activity Logs
			$activity_name = 'My Business Availability : Updated business availability'; 
			createActivityLog($activity_name);

		} elseif ($action == 'credentials') {

			$target_dir = "./uploads/users/business_profile/$profiledata->company_id/";

			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			$is_licensed = 0;
			if (isset($pdata['is_licensed'])) {
				$is_licensed = 1;
			}

			$is_bonded = 0;
			if (isset($pdata['is_bonded'])) {
				$is_bonded = 1;
			}

			$is_insured = 0;
			if (isset($pdata['is_insured'])) {
				$is_insured = 1;
			}

			$is_bbb = 0;
			if (isset($pdata['is_bbb'])) {
				$is_bbb = 1;
			}

			$license_image_name = $profiledata->license_image;
			if (isset($_FILES['license_image']) && $_FILES['license_image']['tmp_name'] != '') {
				$tmp_name = $_FILES['license_image']['tmp_name'];
				$extension = strtolower(end(explode('.', $_FILES['license_image']['name'])));
				$license_image_name = "license_" . time() . '_' . basename($_FILES["license_image"]["name"]);
				move_uploaded_file($tmp_name, "./uploads/users/business_profile/$profiledata->company_id/$license_image_name");
			}

			$insurance_image = $profiledata->insurance_image;
			if (isset($_FILES['license_image']) && $_FILES['insurance_image']['tmp_name'] != '') {
				$tmp_name = $_FILES['insurance_image']['tmp_name'];
				$extension = strtolower(end(explode('.', $_FILES['insurance_image']['name'])));
				$insurance_image = "insurance_" . time() . '_' . basename($_FILES["insurance_image"]["name"]);
				move_uploaded_file($tmp_name, "./uploads/users/business_profile/$profiledata->company_id/$insurance_image");
			}

			$bond_image_name = $profiledata->bond_image;
			if (isset($_FILES['bond_image']) && $_FILES['bond_image']['tmp_name'] != '') {
				$tmp_name = $_FILES['bond_image']['tmp_name'];
				$extension = strtolower(end(explode('.', $_FILES['bond_image']['name'])));
				$bond_image_name = "bond_" . time() . '_' . basename($_FILES["bond_image"]["name"]);
				move_uploaded_file($tmp_name, "./uploads/users/business_profile/$profiledata->company_id/$bond_image_name");
			}

			$data_availability = [
				'is_bonded' => $is_bonded,
				'is_licensed' => $is_licensed,
				'is_bbb_accredited' => $is_bbb,
				'is_business_insured' => $is_insured,
				'insured_amount' => $pdata['insured_amount'],
				'insurance_expiry_date' => date("Y-m-d",strtotime($pdata['insured_exp_date'])),
				'bond_amount' => $pdata['bonded_amount'],
				'bond_expiry_date' => date("Y-m-d",strtotime($pdata['bonded_exp_date'])),
				'license_class' => $pdata['license_class'],
				'license_number' => $pdata['license_number'],
				'license_state' => $pdata['license_state'],
				'license_expiry_date' => date("Y-m-d",strtotime($pdata['license_exp_date'])),
				'bbb_link' => $pdata['bbb_url'],
				'license_image' => $license_image_name,
				'bond_image' => $bond_image_name,
				'insurance_image'=> $insurance_image,
				'is_show_licensed' => $pdata['is_show_licensed'],
				'is_show_bonded' => $pdata['is_show_bonded'],
				'is_show_business_insured' => $pdata['is_show_business_insured'],
				'is_show_bbb_acredited' => $pdata['is_show_bbb_acredited'],
			];

			$this->business_model->updateByCompanyId($cid, $data_availability);

			//Activity Logs
			$activity_name = 'My Business Credentials : Updated business credentials';			
			createActivityLog($activity_name);

		} else {				
			$this->business_model->updateByCompanyId($cid, $pdata);

			//Activity Logs
			$activity_name = 'My Business Profile : Updated business profile';	
			createActivityLog($activity_name);
		}

		//$imbid = $pdata['user_id'];

		$is_success = 1;
		$msg = '';

		// if (!empty($_FILES['image']['name'])) {

		// 	$target_dir = "./uploads/users/business_profile/$bid/";

		// 	if (!file_exists($target_dir)) {
		// 		mkdir($target_dir, 0777, true);
		// 	}

		// 	$business_image = $this->moveUploadedFile($bid);

		// 	$this->business_model->update($bid, ['business_image' => $business_image]);
		// } else {
		// 	copy(FCPATH . 'uploads/users/default.png', 'uploads/users/business_profile/' . $user->id . '/default.png');
		// }

		// $this->activity_model->add('New User $'.$id.' Created by User:'.logged('name'), logged('id'));
		
		$json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
	}

	// added for tracking Timesheet of employees: Attendance View
	//	public function timesheet()
	//	{
	//		$this->load->model('timesheet_model');
	//		$this->load->model('users_model');
	//		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
	//		$this->page_data['users'] = $this->users_model->getUsers();
	//		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
	//		$this->page_data['user_roles'] = $this->users_model->getRoles();
	//
	//		// get total numbers of "In" employees
	//		$this->page_data['total_in'] = $this->timesheet_model->getTotalInEmployees();
	//		// get total numbers of "Out" employees
	//		$this->page_data['total_out'] = $this->timesheet_model->getTotalOutEmployees();
	//		// get total numbers of "Not Logged In Today" empl oyees
	//		$this->page_data['total_not_logged_in_today'] = $this->timesheet_model->getTotalNotLoggedInTodayEmployees();
	//		// get total numbers of "Not Logged In Today" employees
	//		$this->page_data['total_employees'] = $this->timesheet_model->getTotalEmployees();
	//
	//		$this->load->view('users/timesheet-admin', $this->page_data);
	//	}

	// added for tracking Timesheet of employees: Schedule View
	public function employee()
	{
		$this->load->model('timesheet_model');
		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();

		$date_this_week = array(
			"Monday" => date("Y-m-d", strtotime('monday this week')),
			"Tuesday" => date("Y-m-d", strtotime('tuesday this week')),
			"Wednesday" => date("Y-m-d", strtotime('wednesday this week')),
			"Thursday" => date("Y-m-d", strtotime('thursday this week')),
			"Friday" => date("Y-m-d", strtotime('friday this week')),
			"Saturday" => date("Y-m-d", strtotime('saturday this week')),
			"Sunday" => date("Y-m-d", strtotime('sunday this week')),
		);
		$this->page_data['date_this_week'] = $date_this_week;

		$this->load->view('users/timesheet-employee', $this->page_data);
	}

	// added for tracking Timesheet of employees: Schedule View
	public function schedule()
	{
		$this->load->model('timesheet_model');
		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();

		$this->load->view('users/timesheet-schedule', $this->page_data);
	}

	// added for tracking Timesheet of employees: List View
	public function list()
	{
		$this->load->model('timesheet_model');
		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();

		$this->load->view('users/timesheet-list', $this->page_data);
	}

	// added for tracking Time Log of employees
	public function timelog()
	{
		$this->load->model('timesheet_model');
		//ifPermissions('users_list');

		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());

		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['user_roles'] = $this->users_model->getRoles();
		$this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
		$this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();


		$this->load->view('users/timelog', $this->page_data);
	}

	public function showTimeLogTable()
	{
		$date = $this->input->get('date');
		$users =  $this->users_model->getUsers();
		$user_roles = $this->users_model->getRoles();
		$ts_logs = $this->timesheet_model->getTimesheetLogs();
		$attendance = $this->timesheet_model->getAttendanceByDay(date('Y-m-d', strtotime($date)));

		$display = '';
		$emp_role = null;
		$clock_in = null;
		$clock_out = null;
		$shift_duration = null;
		$entry_type = null;
		foreach ($users as $user) :
			$name = $user->FName . " " . $user->LName;
			$id = strval($user->id);
			foreach ($user_roles as $role) {
				if ($user->role == $role->id) {
					$emp_role = $role->title;
				}
			}
			foreach ($attendance as $attn) {
				if ($attn->user_id == $user->id) {
					foreach ($ts_logs as $log) {
						if ($attn->id == $log->attendance_id) {
							$entry_type = $log->entry_type;
							if ($log->action == 'Check in') {
								$clock_in = date('h:i A', strtotime($log->date_created));
							}
							if ($log->action == 'Check out') {
								$clock_out = date('h:i A', strtotime($log->date_created));
							}
						}
					}
					$difference = $attn->shift_duration;
					$seconds = ($difference * 3600);
					$hours = floor($difference);
					$seconds -= $hours * 3600;
					$minutes = floor($seconds / 60);
					$shift_duration = $this->lz($hours) . ":" . $this->lz($minutes);
				}
			}
			$display .= '<tr>';
			$display .= '<td class="center">' . $clock_in . '</td>';
			$display .= '<td class="center">' . $clock_out . '</td>';
			$display .= '<td class="center">' . $shift_duration . '</td>';
			$display .= '<td>';
			$display .= '<div class="employee-section emp-photo">';
			$display .= '<img src="' . userProfileImage($user->id) . '" alt="" class="employee-profile">';
			$display .= '</div>';
			$display .= '<div class="employee-section emp-details">';
			$display .= '<span class="employee-name">' . $name . '</span><span class="employee-role">' . $emp_role . '</span>';
			$display .= '</div>';
			$display .= '</td>';
			$display .= '<td class="center">' . $entry_type . '</td>';
			$display .= '<td class="center"></td>';
			$display .= '<td class="center">';
			$display .= '<a href="javascript:void (0)" title="View" data-toggle="tooltip" ><i class="btn-view fa fa-eye fa-lg"></i></a>';
			$display .= '</td>';
			$display .= '</tr>';
			$clock_in = null;
			$clock_out = null;
			$shift_duration = null;
			$entry_type = null;
		endforeach;

		echo json_encode($display);
	}
	public function lz($num)
	{
		return (strlen($num) < 2) ? "0{$num}" : $num;
	}

	// function to calculate total logged time of user: daily
	public function total_logged_day()
	{
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
		);
		$total_clockin = $this->timesheet_model->getTotalClockinDay($data);
	}

	// function to calculate total logged time of user: weekly
	public function total_logged_week()
	{
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
		);
		$total_clockin = $this->timesheet_model->getTotalClockinWeek($data);
	}

	// function to calculate total logged time of user: monthly
	public function total_logged_month()
	{
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
		);
		$total_clockin = $this->timesheet_model->getTotalClockinMonth($data);
	}

	// added for tracking Timesheet of employees
	public function timesheet_user()
	{
		$this->load->model('timesheet_model');
		//ifPermissions('users_list');

		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());

		$this->page_data['users'] = $this->users_model->getUsers();

		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();

		//$this->load->view('users/timesheet', $this->page_data);
		$this->load->view('users/timesheet-user', $this->page_data);
	}

	public function add_timesheet_entry()
	{
		//ifPermissions('users_add');
		$this->load->view('users/add_timesheet_entry', $this->page_data);
	}

	public function tracklocation()
	{
		if(!checkRoleCanAccessModule('user-track-location', 'read')){
			show403Error();
			return false;
		}

		$this->hasAccessModule(63);
		$this->load->model('Trac360_model');

		$cid           = logged('company_id');
		$companyUsers  = $this->users_model->getCompanyUsers($cid);
		$trac360People = $this->Trac360_model->get_current_user_location($cid);

		$geoDataFeatures = [];
		foreach($trac360People as $trac){
			if( $trac->last_tracked_location != '' && $trac->last_tracked_location_address != ''){
				$latLong = explode(",", $trac->last_tracked_location);
				$msg = "<div class='map-popup-container'>
					<span class='map-user'><i class='bx bxs-user-circle'></i> ". $trac->FName . ' ' . $trac->LName ."</span>
					<span class='map-date'><i class='bx bxs-calendar'></i> ". date("m/d/Y h:i A",strtotime($trac->last_tracked_location_date)) ."</span>
					<hr />
					<span class='map-address'><i class='bx bxs-map'></i> ". $trac->last_tracked_location_address ."</span>
				</div>";
				$geoDataFeatures[] = [
					'type' => 'Feature',
					'trac_id' => 'trac' . $trac->id,
					'properties' => [
						'message' => $msg,
						'iconSize' => [35, 35],
						'image' => userProfileImage($trac->user_id)
					],
					'geometry' => [
						'type' => 'Point',
						'coordinates' => [$latLong[1], $latLong[0]]
					]
				];
			}			
		}

		$this->page_data['page']->title = 'Employees Track Location';
        $this->page_data['page']->parent = 'Company';
		$this->page_data['trac360People'] = $trac360People;
		$this->page_data['geoDataFeatures'] = $geoDataFeatures;
		$this->page_data['companyUsers'] = $companyUsers;
		$this->page_data['enable_tracklocation'] = 1;
		$this->load->view('v2/pages/users/tracklocation', $this->page_data);
	}

	public function index()
	{	
		if(!checkRoleCanAccessModule('users', 'read')){
			show403Error();
			return false;
		}

		$this->page_data['page']->title = 'Employees';
        $this->page_data['page']->parent = 'Company';

		$this->hasAccessModule(63);
		//ifPermissions('users_list');
		$this->load->helper(array('form', 'url', 'hashids_helper'));

		$cid = logged('company_id');
		$eid = hashids_encrypt($cid, '', 15);
		$company = $this->Clients_model->getById($cid);
		$num_license = $company->number_of_license;

		$show_pass = 0;
		if( in_array($cid, exempted_company_ids()) ){
			$show_pass = 1;
		}		
		
		$this->page_data['eid'] = $eid;
		$this->page_data['num_license'] = $num_license;
		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
		$this->page_data['roles']  = $this->users_model->userRolesList();
		$this->page_data['show_pass'] = $show_pass;
		$this->page_data['users'] = $this->users_model->getCompanyUsers($cid,['is_archived' => 'No']);
		$this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);


		// echo '<pre>';print_r($this->page_data);die;

		// $this->load->view('users/list', $this->page_data);
		$this->load->view('v2/pages/users/list', $this->page_data);
	}



	public function add()

	{

		//ifPermissions('users_add');

		$this->load->view('users/add', $this->page_data);
	}

	public function getRoles()
	{
		$cid = logged('company_id');
		$role_title = $this->input->get('search');
		$roles = $this->users_model->getRolesBySearch($role_title, $cid);
		$data = array();
		foreach ($roles as $role) {
			$data[] = array(
				'id' => $role->id,
				'text' => $role->title,
				'selected' => true
			);
		}
		echo json_encode($data);
	}
	public function checkEmailExist()
	{
		$email = $this->input->get('email');
		$check = $this->db->get_where('users', array('email' => $email))->num_rows();

		echo json_encode($check);
	}
	public function checkUsername()
	{
		$username = $this->input->get('username');
		$check = $this->db->get_where('users', array('username' => $username))->num_rows();
		echo json_encode($check);
	}
	public function addNewEmployee()
	{
		$this->load->model('IndustryType_model');
		$this->load->model('Clients_model');

		$fname = $this->input->post('values[firstname]');
		$lname = $this->input->post('values[lastname]');
		$email = $this->input->post('values[email]');
		$username = $this->input->post('values[username]');
		$password = $this->input->post('values[password]');
		$address = $this->input->post('values[address]');

		$city  = $this->input->post('values[city]');
		$state  = $this->input->post('values[state]');
		$postal_code  = $this->input->post('values[postal_code]');

		$user_type = $this->input->post('values[user_type]');
		$role = $this->input->post('values[role]');
		$status = $this->input->post('values[status]');
		$profile_img = $this->input->post('[profile_photo]');
		$payscale_id = $this->input->post('values[empPayscale]');
		$emp_number  = $this->input->post('values[emp_number]');
		$cid = logged('company_id');

		$post       = $this->input->post();
		$app_access = 0;
		$web_access = 0;

		if (isset($post['values']['app_access'])) {
			$app_access = 1;
		}

		if (isset($post['values']['web_access'])) {
			$web_access = 1;
		}

		$company = $this->Clients_model->getById($cid);
		if ($company->number_of_license <= 0 && $company->id != 1) {
			echo json_encode(3);
		} else {
			$add = array(
				'FName' => $fname,
				'LName' => $lname,
				'username' => $username,
				'email' => $username,
				'password' => hash("sha256", $password),
				'password_plain' => $password,
				'role' => $role,
				'user_type' => $user_type,
				'status' => $status,
				'company_id' => $cid,
				'profile_img' => $profile_img,
				'address' => $address,
				'state' => $state,
				'city' => $city,
				'postal_code' => $postal_code,
				'payscale_id' => $payscale_id,
				'employee_number' => $emp_number,
				'has_web_access' => $web_access,
				'has_app_access' => $app_access
			);
			$last_id = $this->users_model->addNewEmployee($add);

			//Deduct num license
			$new_num_license = $company->number_of_license;
			$company_data = ['number_of_license' => $new_num_license];
			$this->Clients_model->updateClient($cid, $company_data);

			//Create timesheet record
			$this->load->model('TimesheetTeamMember_model');
			$this->TimesheetTeamMember_model->create([
				'user_id' => $last_id,
				'name' => $fname . ' ' . $lname,
				'email' => $username,
				'role' => 'Employee',
				'department_id' => 0,
				'department_role' => 'Member',
				'will_track_location' => 1,
				'status' => 1,
				'company_id' => $cid
			]);
			//End Timesheet		

			//Create Trac360 record
			$this->load->model('Trac360_model');
			$data = [
				'user_id' => $last_id,
				'name' => $fname . ' ' . $lname,
				'company_id' => $cid
			];
			$this->Trac360_model->add('trac360_people', $data);
			//End Trac360

			if ($last_id > 0 ){
	            echo json_encode(1);
	        }else{
	            echo json_encode(0);
	        }
        }
        
    }    

	public function addNewEmployeeV2(){		
		$this->load->helper('adt_portal_helper');
    	$this->load->model('IndustryType_model');
    	$this->load->model('Clients_model');
    	$this->load->model('UserPortalAccount_model');
		$this->load->model('EmployeeCommissionSetting_model');
    	//$this->load->model('AdtPortal_model');

		$post = $this->input->post();
		$cid  = logged('company_id');

		$profile_image = '';
		if( isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0 ){
			$target_dir = "./uploads/users/user-profile/";
			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			$tmp_name = $_FILES['userfile']['tmp_name'];
			$img_name = $company_id . '_' . time() . '_profile_image'; 				
			move_uploaded_file($tmp_name, "./uploads/users/user-profile/" . $img_name);
			$profile_image = $img_name;

			$data = array(
				'profile_image'=> $profile_image,
				'date_created' => time()
			);
			$img_id = $this->users_model->addProfilePhoto($data);
		}

        $app_access = 0;
        $web_access = 0;

        if( $this->input->post('app_access') ){
        	$app_access = 1;	
        }
        
        if( $this->input->post('web_access') ){
        	$web_access = 1;	
        }

        $company = $this->Clients_model->getById($cid);
        if( $company->number_of_license <= 0 && $company->id != 1 ){
        	echo json_encode(3);
        }else{
        	$is_with_error = false;
        	$create_portal_access = false;
        	$portal_error = 1;
        	/*if( $this->input->post('portal_username') != '' ){
        		if( $this->input->post('portal_password') != '' && ( $this->input->post('portal_password') == $this->input->post('portal_confirm_password') ) ){     
        			$adtUser = $this->AdtPortal_model->getByEmail($this->input->post('portal_username'));
        			$isAccountExists = $this->UserPortalAccount_model->getByUsername($this->input->post('portal_username'));
        			if( $isAccountExists ){
        				$is_with_error = true;
        				$portal_error  = 2;
        			}else{
        				if( $adtUser ){
	        				$pwCheck = password_verify($adtUser->password, $this->input->post('portal_password'));
	        				if( $pwCheck ){
	        					$is_with_error = false;  
	        					$create_portal_access = true;					
	        				}
	        			}else{
	        				$is_with_error = true;
	        			}        			
        			}	        			
        		}else{
        			$is_with_error = true;
        		}
        	}*/

        	if( $is_with_error ){
        		if( $portal_error == 1 ){
        			echo json_encode(4);
        		}else{
        			echo json_encode(5);
        		}       		
        	}else{
        		$add = array(
		            'FName' => $this->input->post('firstname'),
		            'LName' => $this->input->post('lastname'),
		            'username' => $this->input->post('email'),
		            'email' => $this->input->post('email'),
		            'password' => hash("sha256",$this->input->post('password')),
		            'password_plain' => $this->input->post('password'),
		            'role' => $this->input->post('role'),
		            'user_type' => $this->input->post('user_type'),
		            'status' => $this->input->post('status'),
		            'company_id' => $cid,
		            'profile_img' => $profile_image,
		            'address' => $this->input->post('address'),
		            'mobile' => $this->input->post('mobile'),
		            'phone' => $this->input->post('phone'),
		            'state' => $this->input->post('state'),
		            'city' => $this->input->post('city'),
		            'postal_code' => $this->input->post('postal_code'),
		            'payscale_id' => 0,
		            'employee_number' => $this->input->post('emp_number'),
		            'has_web_access' => $web_access,
		            'has_app_access' => $app_access,
					'is_archived' => 'No',
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s")
		        );
		        $last_id = $this->users_model->addNewEmployee($add);
				
		        if( $create_portal_access ){
		        	//Create portal access 
		        	$data_portal = [
		        		'user_id' => $last_id,
		        		'username' => trim($this->input->post('portal_username')),
		        		//'password' => hash("sha256",$this->input->post('portal_password')),
		        		'password_plain' => $this->input->post('portal_password'),
		        		'created' => date("Y-m-d H:i:s")
		        	];

		        	$this->UserPortalAccount_model->create($data_portal);
		        }

		        //Deduct num license
		        $new_num_license = $company->number_of_license - 1;
		        $company_data = ['number_of_license' => $new_num_license];
		        $this->Clients_model->updateClient($cid, $company_data);

		        //Create timesheet record
				$name = ucwords($this->input->post('firstname')) . ' ' . ucwords($this->input->post('lastname'));
				$this->load->model('TimesheetTeamMember_model');
				$this->TimesheetTeamMember_model->create([
					'user_id' => $last_id,
					'name' => $name,
					'email' => $this->input->post('email'),
					'role' => 'Employee',
					'department_id' => 0,
					'department_role' => 'Member',
					'will_track_location' => 1,
					'status' => 1,
					'company_id' => $cid
				]);
				//End Timesheet		

				//Create Trac360 record
				$this->load->model('Trac360_model');
				$data = [
					'user_id' => $last_id,
					'name' => $name,
					'company_id' => $cid
				];
				$this->Trac360_model->add('trac360_people', $data);
				//End Trac360

		        if ($last_id > 0 ){
					//Activity Logs
					$activity_name = 'Users : Created user ' . $name; 
					createActivityLog($activity_name);
		        }

				echo json_encode(1);
        	}
        }
        
    }   

	public function updatePayScaleData($user_id, $input){	
		$this->load->model('PayScale_model');

		$base_hourly  = 0;
		$base_weekly  = 0;
		$base_monthly = 0;
		$base_salary  = 0;
		$base_yearly  = 0;
		$compensation_base = 0;
		$compensation_rate = 0;
		$commission_id = 0;
		$commission_percentage = 0;
		$jobtypebase_amount = 0;

		$user = $this->Users_model->getUserByID($user_id);
		$payscale = $this->PayScale_model->getById($user->payscale_id);
		if( $payscale->pay_type == 'Hourly' ){
			$base_hourly = $input['salary_rate'];
		}elseif( $payscale->pay_type == 'Daily' ){
			$base_salary = $input['salary_rate'];
		}elseif( $payscale->pay_type == 'Weekly' ){
			$base_weekly = $input['salary_rate'];
		}elseif( $payscale->pay_type == 'Monthly' ){
			$base_monthly = $input['salary_rate'];
		}elseif( $payscale->pay_type == 'Yearly' ){
			$base_yearly = $input['salary_rate'];
		}

		$emp_payscale_data = [
			'base_hourly' => $base_hourly,
			'base_weekly' => $base_weekly,
			'base_monthly' => $base_monthly,
			'base_salary' => $base_salary,
			'base_yearly' => $base_yearly,
			'compensation_base' => $compensation_base,
			'compensation_rate' => $compensation_rate,
			'commission_id' => $commission_id,
			'commission_percentage' => $commission_percentage,
			'jobtypebase_amount' => $jobtypebase_amount
		];

		$this->Users_model->update($user->id, $emp_payscale_data);
	}

    public function getEmployeeData(){
	    $user_id = $this->input->get('user_id');
	    $get_data = $this->db->get_where('users',array('id'=>$user_id));
	    $get_role = $this->db->get_where('roles',array('id' => $get_data->row()->role));

		$info = new stdClass();
		$info->fname = $get_data->row()->FName;
		$info->lname = $get_data->row()->LName;
		$info->email = $get_data->row()->email;
		$info->username = $get_data->row()->username;
		$info->role_id = $get_data->row()->role;
		$info->role = $get_role->row()->title;
		$info->status = $get_data->row()->status;
		$info->profile_image = $get_data->row()->profile_img;

		echo json_encode($info);
	}

	public function ajax_edit_employee()
	{
		$this->load->model('CommissionSetting_model');
		$this->load->model('EmployeeCommissionSetting_model');

		$user_id = $this->input->post('user_id');
		$get_user = $this->Users_model->getUser($user_id);
		$get_role = $this->db->get_where('roles', array('id' => $get_user->role));		

		$cid   = logged('company_id');
		$userTypes = $this->users_model->getRoles($cid);

		$payscale = $this->PayScale_model->getById($get_user->payscale_id);
		$salary_rate = 0;
		$salary_type_label = '';
		if( $payscale->pay_type == 'Hourly' ){
			$salary_rate = $get_user->base_hourly;
			$salary_type_label = 'Hourly Rate';
		}elseif( $payscale->pay_type == 'Daily' ){
			$salary_rate = $get_user->base_salary;
			$salary_type_label = 'Daily Rate';
		}elseif( $payscale->pay_type == 'Weekly' ){
			$salary_rate = $get_user->base_weekly;
			$salary_type_label = 'Weekly Rate';
		}elseif( $payscale->pay_type == 'Monthly' ){
			$salary_rate = $get_user->base_monthly;
			$salary_type_label = 'Monthly Rate';
		}elseif( $payscale->pay_type == 'Yearly' ){
			$salary_rate = $get_user->base_yearly;
			$salary_type_label = 'Yearly Rate';
		}elseif( $payscale->pay_type == 'Commission Only' ){
			$salary_rate = 0;
			$salary_type_label = 'Commission Only';
		}

		$this->page_data['roles']  = $this->users_model->userRolesList();
		$this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($cid);
		$this->page_data['salary_rate'] = $salary_rate;
		$this->page_data['salary_type_label'] = $salary_type_label;
		$this->page_data['commissionSettings'] = $this->CommissionSetting_model->getAllByCompanyId($cid);
		$this->page_data['optionCommissionTypes'] = $this->CommissionSetting_model->optionCommissionTypes();       
		$this->page_data['employeeCommissionSettings'] = $this->EmployeeCommissionSetting_model->getAllByUserId($user_id);
		$this->page_data['totalSalary'] = $this->Users_model->getTOtalJobTypeBaseAmount($user_id);
		$this->page_data['commission'] = $this->Users_model->getTotalCommission($user_id);
        $this->page_data['userTypes'] = $userTypes;
	    $this->page_data['user'] = $get_user;
	    $this->page_data['role'] = $get_role;	    
	    // $this->load->view('users/modal_edit_form', $this->page_data);
	    $this->load->view('v2/pages/users/modal_edit_form', $this->page_data);
	}

	private $user_path = './uploads/users/user-profile/';
	public function profilePhoto()
	{
		if (!empty($_FILES)) {
			$config = array(
				'upload_path' => './uploads/users/user-profile/',
				'allowed_types' => '*',
				'overwrite' => TRUE,
				'max_size' => '20000',
				'max_height' => '0',
				'max_width' => '0',
				'encrypt_name' => true
			);
			$config = $this->uploadlib->initialize($config);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload("file")) {
				$uploadData = $this->upload->data();
				$data = array(
					'profile_image' => $uploadData['file_name'],
					'date_created' => time()
				);
				$query = $this->users_model->addProfilePhoto($data);
				$return = new stdClass();
				$return->photo = $uploadData['file_name'];
				$return->id = $query;
				echo json_encode($return);
			}
		} else {
			echo json_encode('error');
		}
	}

	public function removeProfilePhoto()
	{
		$file = $this->input->post('name');
		$index = $this->input->post('index');
		if ($file && file_exists($this->user_path . $file[$index])) {
			unlink($this->user_path . $file[$index]);
			$this->db->where('profile_image', $file[$index]);
			$this->db->delete('user_profile_photo');
			echo json_encode(1);
		}
	}
	public function removeTemporaryImg()
	{
		$file = $this->input->post('image');
		$image_id = $this->input->post('image_id');
		if ($file && file_exists($this->user_path . $file)) {
			unlink($this->user_path . $file);
			$this->db->where('id', $image_id);
			$this->db->delete('user_profile_photo');
			echo json_encode(1);
		}
	}

	public function save()
	{
		ifPermissions('users_add');
		postAllowed();
		$user = (object)$this->session->userdata('logged');
		$cid = logged('company_id');
		$id = $this->users_model->create([
			'role' => post('role'),
			'FName' => post('FName'),
			'LName' => post('LName'),
			'username' => post('username'),
			'email' => post('email'),

			'company_id' => $cid,

			'status' => (int) post('status'),
			'password_plain' =>  post('password'),
			'password' => hash("sha256", post('password')),
			//'parent_id' => $user->id
		]);

		if (!empty($_FILES['image']['name'])) {

			$path = $_FILES['image']['name'];
			$ext  = pathinfo($path, PATHINFO_EXTENSION);
			$this->uploadlib->initialize([
				'file_name' => 'p_' . $id . '.' . $ext
			]);

			$image = $this->uploadlib->uploadImage('image', '/users/user-profile');

			if ($image['status']) {
				$this->users_model->update($id, ['profile_img' => 'p_' . $id, 'img_type' => $ext]);
			} else {
				copy(FCPATH . 'uploads/users/default.png', 'uploads/users/user-profile/p_' . $id . '.' . $ext);
			}
		} else {
			copy(FCPATH . 'uploads/users/default.png', 'uploads/users/user-profile/p_' . $id . '.' . $ext);
		}



		$this->activity_model->add('New User $' . $id . ' Created by User:' . logged('FName'), logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New User Created Successfully');

		redirect('users');
	}

	public function view($id)
	{
		if(!checkRoleCanAccessModule('users', 'read')){
			show403Error();
			return false;
		}

		//ifPermissions('users_view');
		$user = $this->users_model->getById($id);		
		$this->page_data['User'] = $this->users_model->getById($id);		
		$this->page_data['User']->role = $this->roles_model->getByWhere([
			'id' => $this->page_data['User']->role
		])[0];		
		$this->page_data['User']->activity = $this->activity_model->getByWhere([
			'user_id' => $id
		], ['order' => ['id', 'desc']]);
		
		$this->page_data['page']->title = 'Employees';
        $this->page_data['page']->parent = 'Company';
		$this->page_data['commission_info'] = $this->users_model->getCommissionHistory($id);
		//this->page_data['hourly_pay_info'] = $this->users_model->getHourlyPayHistory($id);
		$this->page_data['hourly_pay_info'] = [];
		$this->page_data['current_user_id'] = logged('id');
		$this->load->view('v2/pages/users/view', $this->page_data);
	}

	public function edit($id)
	{
		// ifPermissions('users_edit');
		$this->page_data['User'] = $this->users_model->getById($id);
		$this->load->view('users/edit', $this->page_data);
	}

	public function update($id)
	{
		// ifPermissions('users_edit');
		postAllowed();
		$cid = logged('company_id');
		$data = [
			'role' => post('role'),
			'FName' => post('FName'),
			'LName' => post('LName'),
			'username' => post('username'),
			'email' => post('email'),
			'phone' => post('phone'),
			'company_id' => $cid,
			'address' => post('address'),
		];
		$password = post('password');
		if (logged('id') != $id)
			$data['status'] = post('status') == 1;
		if (!empty($password)) {
			$data['password_plain'] = $password;
			$data['password'] = hash("sha256", $password);
		}

		$id = $this->users_model->update($id, $data);

		if (!empty($_FILES['image']['name'])) {

			$path = $_FILES['image']['name'];

			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$this->uploadlib->initialize([

				'file_name' => 'p_' . $id . '.' . $ext

			]);
			$profile_image = 'p_' . $id;

			$image = $this->uploadlib->uploadImage('image', '/users/user-profile');



			if ($image['status']) {

				$this->users_model->update($id, ['profile_img' => $profile_image, 'img_type' => $ext]);
			}
		}



		$this->activity_model->add("User #$id Updated by User:" . logged('FName'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'Client Profile has been Updated Successfully');



		redirect('users');
	}

	public function check()

	{

		$email = !empty(get('email')) ? get('email') : false;

		$username = !empty(get('username')) ? get('username') : false;

		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;



		if ($email)

			$exists = count($this->users_model->getByWhere([

				'email' => $email,

				'id !=' => $notId,

			])) > 0 ? true : false;



		if ($username)

			$exists = count($this->users_model->getByWhere([

				'username' => $username,

				'id !=' => $notId,

			])) > 0 ? true : false;



		echo $exists ? 'false' : 'true';
	}



	public function delete($id)

	{



		ifPermissions('users_delete');



		if ($id !== 1 && $id != logged($id)) {
		} else {

			redirect('/', 'refresh');

			return;
		}



		$user = $this->users_model->delete($id);

		//Delete Timesheet 
		$this->load->model('TimesheetTeamMember_model');
		$this->TimesheetTeamMember_model->deleteByUserId($id);
		//Delete Tract360
		$this->load->model('Trac360_model');
		$this->Trac360_model->deleteUser('trac360_people', $id);



		$this->activity_model->add("User #$id Deleted by User:" . logged('name'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'User has been Deleted Successfully');



		redirect('users');
	}

	// timesheet 
	public function clock_in()
	{
		print_r($this->input->post());
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
			/*'user_id' => $this->input->post('clockin_user_id'),
			'company_id' => $this->input->post('clockin_company_id'),
			'clock_in' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);



		$this->timesheet_model->clockIn($data);
	}
	public function clock_out()
	{
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock Out',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
			/*'user_id' => $this->input->post('clockin_user_id'),
			'company_id' => $this->input->post('clockin_company_id'),
			'clock_out' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);

		$this->timesheet_model->clockOut($data);
	}


	// timesheet 
	public function lunch_in()
	{
		print_r($this->input->post());
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Lunch In',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
			/*'user_id' => $this->input->post('clockin_user_id'),
			'company_id' => $this->input->post('clockin_company_id'),
			'clock_in' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);
		$this->timesheet_model->clockIn($data);
	}


	public function lunch_out()
	{
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Lunch Out',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
			/*'user_id' => $this->input->post('clockin_user_id'),
			'company_id' => $this->input->post('clockin_company_id'),
			'clock_out' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);

		$this->timesheet_model->clockOut($data);
	}

	public function break_in()
	{
		print_r($this->input->post());
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Break In',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
			/*'user_id' => $this->input->post('clockin_user_id'),
			'company_id' => $this->input->post('clockin_company_id'),
			'clock_in' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
		);
		$this->timesheet_model->clockIn($data);
	}

	public function break_out()
	{
		print_r($this->input->post());
		$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Break Out',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Normal'
		);
		$this->timesheet_model->clockIn($data);
	}

	public function manual_clock_in()
	{
		$this->load->model('timesheet_model');
		//$data = $this->input->post();
		//dd($data);die;
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'entry_type' => $this->input->post('entry_type'),
			'timestamp' => $this->input->post('entry_date'),
			'clock_in_from' => $this->input->post('clock_in_from'),
			'clock_in_to' => $this->input->post('clock_in_to'),
			'break_from' => $this->input->post('break_from'),
			'break_to' => $this->input->post('break_to'),
			'job_code' => $this->input->post('job_code'),
			'notes' => $this->input->post('notes')
		);
		//dd($data);die;
		$this->timesheet_model->manualClockIn($data);

		/*$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Manual'
		);

		$this->timesheet_model->checkClockIn($data);*/

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New User Created Successfully');

		redirect('users/timesheet');
	}

	public function update_clockin($id)
	{
		$this->load->model('timesheet_model');

		//$this->timesheet_model->updateClockin($id, ['clockin' => get('clockIn') == 'true' ? 1 : 0 ]);

		//echo 'done';

	}


	public function getClockIn()
	{
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
			'session_key' => $this->input->post('clockin_sess'),
		);

		$this->timesheet_model->checkClockIn($data);
	}

	public function change_status($id)

	{

		$this->users_model->update($id, ['status' => get('status') == 'true' ? 1 : 0]);

		echo 'done';
	}


	public function ajax_user_dropdown()
	{

		$users = $this->users_model->getUsers();
		// print_r($users);

		echo $this->load->view('users/ajax_user_dropdown', array('users' => $users), true);
	}


	public function json_dropdown_user_list()
	{

		$users = $this->users_model->getUsers();
		// print_r($users);

		die(json_encode($users));
	}

	public function ajaxUpdateEmployeeProfilePhoto()
	{
		$post 		  = $this->input->post();
		$upload_photo = $this->profilePhoto();
		$upload_data  = json_decode($upload_photo);
		$company_id   = logged('company_id');

		if (!empty($_FILES['user_photo']['name'])) {
			$user = $this->Users_model->getUserByID($post['user_id_prof']);
			if( $user ){
				$target_dir = "./uploads/users/user-profile/";

				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}

				$tmp_name = $_FILES['user_photo']['tmp_name'];
				//$name = basename($_FILES["user_photo"]["name"]);
				$name = $company_id . '_' . time() . '_profile_image'; 				
				move_uploaded_file($tmp_name, "./uploads/users/user-profile/" . $name);
				$image_name = $name;

				$this->Users_model->update($post['user_id_prof'], array('profile_img' => $image_name));

				//Activity Logs
				$activity_name = 'Updated Profile Image for User ' . $user->FName . ' ' . $user->LName; 
				createActivityLog($activity_name);

				echo json_encode(1);
			}else{
				echo json_encode(0);
			}
		} else {
			echo json_encode(0);
		}
	}
	public function getData_for_clock_in_out_location()
	{
		$user_id = $this->input->post('user_id');

		$query = $this->Users_model->getData_of_Clock_In_Out_Lat_Long($user_id);

		$data = new stdClass();
		if ($query) {
			$data->cLocation = 1;
			$data->clock_in_latitude  = floatval($query->clock_in_latitude) ;
			$data->clock_in_longtitude = floatval($query->clock_in_longtitude);
			$data->clock_out_latitude = floatval($query->clock_out_latitude);
			$data->clock_out_longtitude = floatval($query->clock_out_longtitude);
			$data->clock_in_address = $query->clock_in_address;
			$data->clock_out_address = $query->clock_out_address;
			$data->clock_in_radius =  floatval($query->clock_in_radius);
			$data->clock_out_radius =  floatval($query->clock_out_radius);
			$data->allow_gps_clock_in = $query->allow_gps_clock_in;
			$data->allow_gps_clock_out = $query->allow_gps_clock_out;
		} else {
			$data->cLocation = 0;
		}
		echo json_encode($data);
	}

	public function saveClockInOp(){
		$user_id = $this->input->post('user_id');
		$data = [
			'user_id'   => $user_id,
			'allow_gps' => $this->input->post('data'),
			'company_id'=> logged('company_id')
		];

		$query = $this->Users_model->insertClock_In_Out_Lat_Long($user_id, $data);
		echo json_encode($query);
	}

	public function ajaxUpdateEmployee()
	{
		$this->load->model('EmployeeCommissionSetting_model');

		$is_success = 1;
		$msg = '';

		$post = $this->input->post();
		$company_id = logged('company_id');
		$user = $this->Users_model->getUserByID($post['user_id']);
		
		if( $user && $user->company_id == $company_id ){
			if( $post['firstname'] == '' || $post['lastname'] == '' ){
				$msg = 'Please enter employee name';
				$is_success = 0;
			}

			if( $post['emp_number'] == '' ){
				$msg = 'Please enter employee number';
				$is_success = 0;
			}

			if( $post['state'] == '' || $post['address'] == '' || $post['postal_code'] == '' ){
				$msg = 'Please complete employee address (state, address, zip code)';
				$is_success = 0;
			}

			if( $is_success == 1 ){
				$profile_image = $user->profile_img;

				if( isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0 ){
					$target_dir = "./uploads/users/user-profile/";
					if (!file_exists($target_dir)) {
						mkdir($target_dir, 0777, true);
					}

					$tmp_name = $_FILES['userfile']['tmp_name'];
					$img_name = $company_id . '_' . time() . '_profile_image'; 				
					move_uploaded_file($tmp_name, "./uploads/users/user-profile/" . $img_name);
					$profile_image = $img_name;

					$data = array(
						'profile_image'=> $profile_image,
						'date_created' => time()
					);
					$img_id = $this->users_model->addProfilePhoto($data);
				}

				$has_web_access = 0;
				if ($post['web_access'] == 'on') {
					$has_web_access = 1;
				}

				$has_app_access = 0;
				if ($post['app_access'] == 'on') {
					$has_app_access = 1;
				}		

				$mobile = '';
				if( $post['mobile'] != '' ){
					$mobile = formatPhoneNumber($post['mobile']);
				}
				$phone  = '';
				if( $post['phone'] != '' ){
					$phone = formatPhoneNumber($post['phone']);
				}

				$data = array(
					'FName' => $post['firstname'],
					'LName' => $post['lastname'],
					'role' => $post['role'],
					'status' => $post['status'],
					'profile_img' => $profile_image,
					'address' => $post['address'],
					'state' => $post['state'],
					'city' => $post['city'],
					'phone' => $phone,
					'mobile' => $mobile,
					'has_web_access' => $has_web_access,
					'has_app_access' => $has_app_access,
					'postal_code' => $post['postal_code'],
					'user_type' => $post['user_type'],
					'employee_number' => $post['emp_number'],
					'updated_at' => date("Y-m-d H:i:s")
				);

				$this->Users_model->update($user->id,$data);

				//Activity Logs
                $activity_name = 'Users : Updated user ' . $post['firstname'] . ' ' . $post['lastname']; 
                createActivityLog($activity_name);

				$msg  = '';
			}
		}else{
			$is_success = 0;
			$msg = 'Cannot find user data';
		}

		$json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

	}

	public function ajax_update_employee_commission(){
		$this->load->model('EmployeeCommission_model');

		$is_success = 0;
		$msg = 'Cannot find data';
		$total_commission  = 0;
		$commission_amount = 0;

		$post = $this->input->post();
		$employeeCommission = $this->EmployeeCommission_model->getById($post['cid']);
		if( $employeeCommission ){
			$user_id = $employeeCommission->user_id;
			if( $employeeCommission->is_paid == 1 ){
				$msg = 'Cannot update already processed commission';
			}else{
				$commission_data = ['commission_amount' => $post['amount']];
				$this->EmployeeCommission_model->update($employeeCommission->id, $commission_data);

				$employeeCommissions = $this->EmployeeCommission_model->getTotalEmployeeCommissionByUserId($user_id);
				$total_commission = number_format($employeeCommissions->total_commission,2,'.','');

				$is_success = 1;
				$msg = '';
				$commission_amount = number_format($post['amount'], 2,'.','');
			}
		}

		$json_data = ['is_success' => $is_success, 'total_commission' => $total_commission, 'commission_amount' => $commission_amount, 'msg' => $msg];
        echo json_encode($json_data);
	}

	public function ajaxUpdateEmployeeV2(){
		// Upload profile picture
		$config = array(
			'upload_path' => './uploads/users/user-profile/',
			'allowed_types' => '*',
			'overwrite' => TRUE,
			'max_size' => '20000',
			'max_height' => '0',
			'max_width' => '0',
			'encrypt_name' => true
		);
		$config = $this->uploadlib->initialize($config);
		$this->load->library('upload',$config);
		if ($this->upload->do_upload("file")){
			$uploadData = $this->upload->data();
		
			$data = array(
				'profile_image'=> $uploadData['file_name'],
				'date_created' => time()
			);
			$img_id = $this->users_model->addProfilePhoto($data);
		}

    	$user_id = $this->input->post('user_id');
        $fname = $this->input->post('firstname');
        $lname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $address = $this->input->post('address');

        $city  = $this->input->post('city');
        $state  = $this->input->post('state');
        $postal_code  = $this->input->post('postal_code');

        $role = $this->input->post('role');
        $status = $this->input->post('status');
        $web_access = $this->input->post('web_access');
        $app_access = $this->input->post('app_access');
        $profile_img = $uploadData['file_name'];
        $payscale_id = $this->input->post('empPayscale');
        $emp_number  = $this->input->post('emp_number');
        $user_type   = $this->input->post('user_type');
        $mobile      = $this->input->post('mobile');
        $phone       = $this->input->post('phone');
        
        $user = $this->Users_model->getUser($user_id);

        if( $profile_img == '' ){
        	$profile_img = $user->profile_img;
        }

        $data = array(
            'FName' => $fname,
            'LName' => $lname,
            'username' => $username,
            'email' => $email,
            'role' => $role,
            'status' => $status,            
            'profile_img' => $profile_img,
            'address' => $address,
            'state' => $state,
            'city' => $city,
            'postal_code' => $postal_code,
            'mobile' => $mobile,
            'phone' => $phone,
            'payscale_id' => $payscale_id,
            'user_type' => $user_type,
            'employee_number' => $emp_number
        );

        $user = $this->Users_model->update($user_id,$data);

        echo json_encode(1);
    }

	public function ajaxUpdateEmployeePassword()
	{
		$is_success = false;
		$msg = "";

		$new_password = $this->input->post('values[new_password]');
		$re_password  = $this->input->post('values[re_password]');
		$user_id = $this->input->post('values[change_password_user_id]');

		if ($new_password != $re_password) {
			$msg = "Password not same";
		} else {
			$data = array(
				'password' => hash("sha256", $new_password),
				'password_plain' => $new_password,
			);
			$user = $this->Users_model->update($user_id, $data);

			$is_success = true;
		}

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function ajaxUpdateEmployeePasswordV2(){
		$is_success = false;
		$msg = "";
	
		$new_password = $this->input->post('new_password');
		$re_password  = $this->input->post('re_password');
		$user_id = $this->input->post('change_password_user_id');
	
		if( $new_password != $re_password ){
			$msg = "Password not same";
		}else{
			$data = array(
				'password' => hash("sha256",$new_password),
				'password_plain' => $new_password,
			);
	
			$this->Users_model->update($user_id,$data);
			$user = $this->Users_model->getUser($user_id);

			//Activity Logs
			$activity_name = 'Changed Password for User ' . $user->FName . ' ' . $user->LName; 
			createActivityLog($activity_name);
	
			$is_success = true;
		}
	
		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];
	
		echo json_encode($json_data);
	}

	public function pay_scale()
	{	
		if(!checkRoleCanAccessModule('user-payscale', 'read')){
			show403Error();
			return false;
		}

		$this->page_data['page']->title = 'Pay Scale';
        $this->page_data['page']->parent = 'Company';
		
		$this->hasAccessModule(63);
		$company_id = logged('company_id');
		$role_id    = logged('role');
		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
		$this->page_data['optionPayType'] = $this->PayScale_model->optionPayType();
		$this->page_data['payscale'] = $this->PayScale_model->getAllByCompanyId($company_id);
		// $this->load->view('users/payscale/list', $this->page_data);
		$this->load->view('v2/pages/users/payscale/list', $this->page_data);
	}

	public function ajax_add_payscale()
	{
		$payscale_name = $this->input->post('payscale_name');
		$pay_type      = $this->input->post('pay_type');
		$company_id    = logged('company_id');
		$data = array(
			'payscale_name' => $payscale_name,
			'pay_type' => $pay_type,
			'company_id' => $company_id,
			'date_created' => date("Y-m-d H:i:s"),
			'date_updated' => date("Y-m-d H:i:s")
		);
		$query = $this->PayScale_model->create($data);

		$json_data = ['is_success' => true, 'msg' => ''];

		echo json_encode($json_data);
	}

	public function ajax_edit_payscale()
	{
		$pid = $this->input->post('pid');
		$payscale = $this->PayScale_model->getById($pid);

		$this->page_data['payscale'] = $payscale;
		$this->load->view('users/payscale/modal_edit_form', $this->page_data);
	}

	public function ajax_update_payscale()
	{
		$is_success = false;
		$msg = "";

		$company_id    = logged('company_id');
		$payscale_name = $this->input->post('payscale_name');
		$pay_type      = $this->input->post('pay_type');
		$pid = $this->input->post('pid');

		$payscale = $this->PayScale_model->getById($pid);
		if( $payscale->company_id > 0 && $payscale->company_id == $company_id ){
			$data = array(
				'payscale_name' => $payscale_name,
				'pay_type' => $pay_type,
				'date_updated' => date("Y-m-d H:i:s")
			);	
			$payscale = $this->PayScale_model->update($pid, $data);	
			$is_success = true;
		}else{
			$msg = 'Cannot find data';
		}

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function ajax_payscale_get_details(){
		$this->load->model('PayScale_model');

		$post = $this->input->post();
		$payscale = $this->PayScale_model->getById($post['psid']);
		$details = ['name' => $payscale->payscale_name, 'pay_type' => $payscale->pay_type];

		echo json_encode($details);
		
	}

	public function get_deductions_contribution(){
		$this->load->model('Deductions_and_contribution_model');

		$post = $this->input->post();
		$payscale = $this->PayScale_model->getById($post['psid']);
		$details = ['name' => $payscale->payscale_name, 'pay_type' => $payscale->pay_type];

		echo json_encode($details);
		
	}

	public function ajax_delete_payscale()
	{
		$is_success = false;
		$msg = "";

		$post = $this->input->post();
		$company_id = logged('company_id');
		$payscale   = $this->PayScale_model->getById($pid);
		if( $payscale->company_id > 0 && $payscale->company_id == $company_id){
			$id = $this->PayScale_model->deletePayScale($post['pid']);
			$is_success = true;
		}else{
			$msg = 'Cannot find data';
		}

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function add_work_pictures()
	{
		$this->load->view('business_profile/add_work_pictures', $this->page_data);
	}

	public function upload_work_pictures()
	{

		$comp_id = logged('company_id');
		if (!empty($_FILES['file']['name'])) {
			$target_dir = "./uploads/work_pictures/$comp_id/";

			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			$tmp_name = $_FILES['file']['tmp_name'];
			$extension = strtolower(end(explode('.', $_FILES['file']['name'])));
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = basename($_FILES["file"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/work_pictures/$comp_id/$name");

			$profiledata = $this->business_model->getByCompanyId($comp_id);
			$workImages  = unserialize($profiledata->work_images);
			$workImages[] = ['file' => $name, 'caption' => 'Work Picture'];
			$this->business_model->update($profiledata->id, ['work_images' => serialize($workImages)]);
		}
	}

	public function upload_work_picture_v2(){
		$comp_id = logged('company_id');

		if(!empty($_FILES['work_picture']['name'])){
			$target_dir = "./uploads/work_pictures/$comp_id/";

			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			$tmp_name = $_FILES['work_picture']['tmp_name'];
			$extension = strtolower(end(explode('.', $_FILES['work_picture']['name'])));
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = basename($_FILES["work_picture"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/work_pictures/$comp_id/$name");

			$profiledata = $this->business_model->getByCompanyId($comp_id);
			$workImages  = unserialize($profiledata->work_images);
			$workImages[] = ['file' => $name, 'caption' => 'Work Picture'];
			$this->business_model->update($profiledata->id, ['work_images' => serialize($workImages)]);

			//Activity Logs
            $activity_name = 'Uploaded New Portfolio Image'; 
            createActivityLog($activity_name);
		}
	}

	public function ajax_upload_portfolio_image()
	{
		$is_success = 0;
        $msg = 'Please select image';

        $company_id  = logged('company_id');
        $post = $this->input->post();
		$profiledata = $this->business_model->getByCompanyId($company_id);
		if(!empty($_FILES['work_picture']['name']) && $profiledata){
			$target_dir = "./uploads/work_pictures/$company_id/";

			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			$tmp_name = $_FILES['work_picture']['tmp_name'];
			$extension = strtolower(end(explode('.', $_FILES['work_picture']['name'])));
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = time() . '_' . basename($_FILES["work_picture"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/work_pictures/$company_id/$name");

			$workImages  = unserialize($profiledata->work_images);
			$workImages[] = ['file' => $name, 'caption' => $post['image_caption']];
			$this->business_model->update($profiledata->id, ['work_images' => serialize($workImages)]);

			$is_success = 1;
			$msg = '';

			//Activity Logs
            $activity_name = 'Business Portfolio : Uploaded image'; 
            createActivityLog($activity_name);
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_company_work_picture()
	{
		$post    = $this->input->post();
		$comp_id = logged('company_id');

		$is_success = true;
		$msg = '';

		$profiledata = $this->business_model->getByCompanyId($comp_id);
		$workImages  = unserialize($profiledata->work_images);
		unset($workImages[$post['image_key']]);
		$this->business_model->update($profiledata->id, ['work_images' => serialize($workImages)]);

		//Activity Logs
		$activity_name = 'Deleted Portfolio Image'; 
		createActivityLog($activity_name);

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function ajax_update_company_work_picture_caption()
	{
		$post    = $this->input->post();
		$comp_id = logged('company_id');

		$is_success = true;
		$msg = '';

		$profiledata = $this->business_model->getByCompanyId($comp_id);
		$workImages  = unserialize($profiledata->work_images);
		$workImages[$post['image_key']]['caption'] = $post['image_caption'];
		$this->business_model->update($profiledata->id, ['work_images' => serialize($workImages)]);

		//Activity Logs
		$activity_name = 'Set Portfolio Image Caption to ' . $post['image_caption']; 
		createActivityLog($activity_name);

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function update_profile_setting()
	{
		$is_success = 0;
		$msg = 'Cannot find data';

		$post = $this->input->post();
		$cid  = logged('company_id');

		$profiledata = $this->business_model->getByCompanyId($cid);
		if( $profiledata ){
			$image_name  = $profiledata->business_cover_photo;
			if (!empty($_FILES['cover_photo']['name'])) {
				$target_dir = "./uploads/company_cover_photo/$cid/";

				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}

				$tmp_name = $_FILES['cover_photo']['tmp_name'];
				$extension = strtolower(end(explode('.', $_FILES['cover_photo']['name'])));
				// basename() may prevent filesystem traversal attacks;
				// further validation/sanitation of the filename may be appropriate
				$name = basename($_FILES["cover_photo"]["name"]);
				move_uploaded_file($tmp_name, "./uploads/company_cover_photo/$cid/$name");
				$image_name = $name;
				//$this->business_model->update($profiledata->id, ['work_images' => serialize($workImages)]);
			}

			//$slug = createSlug($post['profile_slug'], '-');			

			$data = [
				//'profile_slug' => $slug,
				'business_tags' => $post['company_tags'],
				'business_cover_photo' => $image_name
			];

			$this->business_model->updateByCompanyId($cid, $data);

			//Activity Logs
			$activity_name = 'My Business Settings : Updated business profile Settings'; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
			
		}

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
		
	}

	public function update_social_media()
	{
		$is_success = 0;
		$msg = 'Cannot find data';

		$cid  = logged('company_id');
		$post = $this->input->post();

		if (!isset($post['is_show_links'])) {
			$post['is_show_links'] = 0;
		}

		$profiledata = $this->business_model->getByCompanyId($cid);
		if( $profiledata ){
			$this->business_model->updateByCompanyId($cid, $post);

			//Activity Logs
			$activity_name = 'My Business Social Media: Updated social media'; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}
		
		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function user_export()
	{
		$this->load->model('users_model');
		$this->load->model('roles_model');

		$role_id = logged('role');
		$cid     = logged('company_id');
		$users = $this->users_model->getCompanyUsers($cid);

		$delimiter = ",";
		$time      = time();
		$filename  = "users_list_" . $time . ".csv";

		$f = fopen('php://memory', 'w');

		$fields = array('Last Name', 'First Name', 'Role', 'Title', 'Email', 'Phone', 'Mobile', 'Address', 'City', 'State', 'Is Archived');
		fputcsv($f, $fields, $delimiter);

		if (!empty($users)) {
			foreach ($users as $u) {
				$csvData = array(
					$u->LName,
					$u->FName,
					getUserType($u->user_type),
					ucfirst($this->roles_model->getById($u->role)->title),
					$u->email,
					$u->phone,
					$u->mobile,
					$u->address,
					$u->city,
					$u->state,
					$u->is_archived
				);
				fputcsv($f, $csvData, $delimiter);
			}
		} else {
			$csvData = array('');
			fputcsv($f, $csvData, $delimiter);
		}

		fseek($f, 0);

		header('Content-Type: text/csv');
		header('Content-Disposition: attachment; filename="' . $filename . '";');

		fpassthru($f);
	}

	public function ajax_delete_user()
	{
		$is_success = false;
		$msg = "Cannot find user data";

		$post = $this->input->post();
		$id   = $post['eid'];
		$cid  = logged('company_id');

		$user = $this->Users_model->getUser($id);
		if( $user && $user->company_id == $cid ){
			$data = ['is_archived' => 'Yes', 'updated_at' => date("Y-m-d H:i:s")];
			$this->Users_model->update($user->id, $data);

			//Delete Timesheet 
			//$this->load->model('TimesheetTeamMember_model');
			//$this->TimesheetTeamMember_model->deleteByUserId($id);
			//Delete Tract360
			//$this->load->model('Trac360_model');
			//$this->Trac360_model->deleteUser('trac360_people', $id);

			//Activity Logs
			$activity_name = 'User : Deleted user ' . $user->FName . ' ' . $user->LName; 
			createActivityLog($activity_name);

			$is_success = true;
			$msg = '';
		}

		$json_data = [
			'is_success' => $is_success,
			'msg' => $msg
		];

		echo json_encode($json_data);
	}

	public function ajax_edit_profile()
	{
		$user_id  = $this->input->post('user_id');
		$cid      = logged('company_id');
		$get_user = $this->Users_model->getUser($user_id);
		$get_role = $this->db->get_where('roles', array('id' => $get_user->role));

		$this->page_data['user'] = $get_user;
		// $this->load->view('users/modal_edit_profile', $this->page_data);
		$this->load->view('v2/pages/users/modal_edit_profile', $this->page_data);
	}

	public function ajax_update_profile()
	{
		$is_success = 0;
        $msg = 'Cannot find data';

		$post = $this->input->post();
		$company_id = logged('company_id');
		$user_id    = logged('id');

		$user = $this->Users_model->getUserByID($user_id);
		if( $user && $user->company_id == $company_id ){
			$profile_img = $user->profile_img;
			if (!empty($_FILES['user_photo']['name'])) {
				$target_dir = "./uploads/users/user-profile/";

				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}

				$tmp_name = $_FILES['user_photo']['tmp_name'];
				//$name = basename($_FILES["user_photo"]["name"]);
				$name = $company_id . '_' . time() . '_profile_image'; 				
				move_uploaded_file($tmp_name, "./uploads/users/user-profile/" . $name);
				$profile_img = $name;

				$data = array(
					'profile_image'=> $profile_img,
					'date_created' => time()
				);
				$img_id = $this->users_model->addProfilePhoto($data);
			}

			$data = array(
				'FName' => $post['firstname'],
				'LName' => $post['lastname'],
				'address' => $post['address'],
				'state' => $post['state'],
				'city' => $post['city'],
				'postal_code' => $post['postal_code'],
				'employee_number' => $post['emp_number'],
				'phone' => $post['phone_number'],
				'mobile' => $post['mobile_number'],
				'profile_img' => $profile_img,
			);

			$user = $this->Users_model->update($user->id, $data);

			$is_success = 1;
			$msg = '';
		}

		$return = [
            'is_success' => $is_success,
            'msg' => $msg,
        ];

        echo json_encode($return);
	}

	public function ajax_update_user_signature()
	{
		$post = $this->input->post();
		$uid  = logged('id');

		if (!empty($post['user_approval_signature1aM_web'])) {

			$folderPath = "./uploads/Signatures/user/$uid/";

			if (!file_exists($folderPath)) {
				mkdir($folderPath, 0777, true);
			}

			$rand1  = rand(10, 10000000);
			$datasig            = $post['user_approval_signature1aM_web'];
			$image_parts        = explode(";base64,", $datasig);
			$image_type_aux     = explode("image/", $image_parts[0]);
			$image_type         = $image_type_aux[1];
			$image_base64       = base64_decode($image_parts[1]);
			$filename           = $rand1 . $wo_id . '_user' . '.' . $image_type;
			$file               = $folderPath . $filename;
			file_put_contents($file, $image_base64);

			$data = array('img_signature' => $filename);
			$user = $this->Users_model->update($uid, $data);
		}

		echo $filename;
	}

	public function ajax_admin_switch()
	{
		$is_valid = 0;
		$msg = 'Invalid account type';
		if (isAdminBypass()) {
			$uid  = adminLogged('id');
			$user = $this->Users_model->getUserByID($uid);
		} else {
			$uid  = logged('id');
			$user = $this->Users_model->getUserByID($uid);
		}

		$data = ['username' => $user->username, 'password' => $user->password_plain];
		$attempt = $this->users_model->admin_attempt($data);
		if ($attempt == 'valid') {
			$this->users_model->admin_login($user);

			$is_valid = 1;
			$msg = '';
		}

		$json_data = ['is_valid' => $is_valid, 'msg' => $msg];
		echo json_encode($json_data);
	}

	public function ajax_loggedin_adt_sales_portal()
	{
		$this->load->helper('adt_portal_helper');

		$this->load->model('UserPortalAccount_model');
		$this->load->model('AdtPortal_model');

		$is_valid = '';
		$msg = 'Invalid username / password';
		$portal_username = '';
		$token = '';

		$uid = logged('id');
		$userPortalAccount = $this->UserPortalAccount_model->getByUserId($uid);
		if( $userPortalAccount ){
			$adtPortalUser = $this->AdtPortal_model->getByEmail($userPortalAccount->username);
			if( $adtPortalUser ){
				$token = adtPortalGenerateToken($adtPortalUser->user_id);
				$adt_data = ['token' => $token];
				$this->AdtPortal_model->updateUserByUserId($adtPortalUser->user_id, $adt_data);

				$is_valid = 1;
				$portal_username = $adtPortalUser->portal_username;
	        	$token = $token;

			}

			//Use if curl server error is fixed
			/*$post = [
	            'portal_username' => $userPortalAccount->username,
	            'portal_password' => $userPortalAccount->password_plain,
	        ];

	        $url = 'https://portal.urpowerpro.com/api/v1/user/validate_login';
	        $ch = curl_init();        
	        curl_setopt($ch, CURLOPT_URL,$url);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        curl_setopt($ch, CURLOPT_POST, 1);            
	        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
	        
	        $response = curl_exec($ch);
	        $data     = json_decode($response);

	        if( $data->is_success == 1 ){
	        	$is_valid = 1;
	        	$portal_username = $data->portal_username;
	        	$token = $data->token;
	        }*/
		}

		$json = ['is_valid' => $is_valid, 'msg' => $msg, 'portal_username' => $portal_username, 'token' => $token];
		echo json_encode($json);
		exit;	
		
	}

	public function ajax_load_edit_adt_portal_login_details()
	{
		$this->load->model('UserPortalAccount_model');

		$uid = $this->input->post('uid');
		$userPortalAccess = $this->UserPortalAccount_model->getByUserId($uid);

		$this->page_data['uid'] = $uid;
        $this->page_data['userPortalAccess'] = $userPortalAccess;        
	    $this->load->view('v2/pages/users/ajax_load_edit_adt_portal_login_details', $this->page_data);
	}

	public function ajax_update_adt_portal_login_details()
	{
		$this->load->helper('adt_portal_helper');
		$this->load->model('UserPortalAccount_model');
		$this->load->model('AdtPortal_model');

		$is_success = 0;
		$msg = 'Password not match';

		$post = $this->input->post();
		if( $this->input->post('portal_password') != '' && ( $this->input->post('portal_password') != $this->input->post('portal_confirm_password') )){ 
			$msg = 'Password not match';
		}elseif( $this->input->post('portal_password') == '' ){
			$msg = 'Please enter password';
		}elseif( $this->input->post('portal_username') == '' ){
			$msg = 'Please enter username';
		}else{			

			$is_account_valid = false;

			//Non API Version
			$adtPortalUser = $this->AdtPortal_model->getByEmail($this->input->post('portal_username'));
			if( $adtPortalUser ){
				$pwCheck = password_verify($this->input->post('portal_password'), $adtPortalUser->password);
				if( $pwCheck ){
					$is_account_valid = true;
				}else{
					$msg = 'Login details not valid';
				}
			}else{
				$msg = 'Login details not valid';
			}

			if( $is_account_valid ){
				$userPortalAccess = $this->UserPortalAccount_model->getByUserId($post['uid']);
				if( $userPortalAccess ){
					$data_portal = [
						'username' => $post['portal_username'],
						'password_plain' => $post['portal_password']
					];

					$this->UserPortalAccount_model->update($userPortalAccess->id, $data_portal);
				}else{
					$data_portal = [
						'user_id' => $post['uid'],
						'username' => $post['portal_username'],
						'password_plain' => $post['portal_password']
					];

					$this->UserPortalAccount_model->create($data_portal);
				}

				$is_success = 1;
				$msg = '';
			}			
		}	

		$json = ['is_success' => $is_success, 'msg' => $msg];
		echo json_encode($json);			
	}

	public function updateBusinessDetailsInfo()
	{
		$pdata = $_POST;
		$bid   = $pdata['id'];
		$comp_id = logged('company_id');

		if (!empty($_FILES['image']['name'])) {
			$target_dir = "./uploads/users/business_profile/$bid/";
		
			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}
		
			$target_file = $target_dir . basename($_FILES['image']['name']);
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
				$business_image = basename($_FILES['image']['name']); 
				$this->business_model->update($bid, ['business_image' => $business_image]);
			} else {
				log_message('error', 'File upload failed for ' . $_FILES['image']['name']);
			}
		} else {
			copy(FCPATH . 'uploads/users/default.png', 'uploads/users/business_profile/' . $bid . '/default.png');
		}

		$pdata['EIN'] = str_replace("-","", $pdata['EIN']);
		$pdata['ssn'] = str_replace("-","", $pdata['ssn']);
		$this->business_model->update($bid, $pdata);

		//redirect('users/businessdetail');
	}

	public function ajax_update_business_details()
	{
		$this->load->model('Business_model');

		$is_success = 0;
		$msg = 'Cannot update data';

		$post = $this->input->post();
		$cid  = logged('company_id');
		$businessDetails = $this->Business_model->getByCompanyId($cid);

		if( $businessDetails ){			
			if (!empty($_FILES['image']['name'])) {
				$target_dir = "./uploads/users/business_profile/".$businessDetails->id."/";
				if (!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}
				$business_image = $this->moveUploadedFile($businessDetails->id);
				$this->business_model->update($businessDetails->id, ['business_image' => $business_image]);
			}

			unset($post['image']);
			$this->business_model->update($businessDetails->id, $post);

			//Activity Logs
			$activity_name = 'Updated business profile'; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg = '';
		}else{
			$msg = 'Cannot find data';
		} 

		$json_data = [
            'is_success' => $is_success,
            'msg' => $message
        ];

        echo json_encode($json_data);
	}

	public function getUserInfo() {
		$employee_id = $this->input->post('employee_id');
		$getInfo = $this->Users_model->getUser($employee_id);
		echo json_encode($getInfo);
	}

	public function ajax_add_commission_form(){
		$this->load->model('CommissionSetting_model');

		$comp_id = logged('company_id');
		$commissionSettings = $this->CommissionSetting_model->getAllByCompanyId($comp_id);

		$this->page_data['commissionSettings'] = $commissionSettings; 
		$this->page_data['optionCommissionTypes'] = $this->CommissionSetting_model->optionCommissionTypes();       
	    $this->load->view('v2/pages/users/ajax_add_commission_form', $this->page_data);
	}

	public function ajax_commission_list(){

		$this->load->model('EmployeeCommission_model');
		$this->load->model('Jobs_model');

		$post = $this->input->post();
		$employeeCommissions = $this->EmployeeCommission_model->getAllByUserId($post['eid']);

		$employee_commissions = array();
		foreach($employeeCommissions as $ec){
			if( $ec->object_type == 'job' ){
				$job_number = '---';				
				$job = $this->Jobs_model->get_specific_job($ec->object_id);
				if( $job ){
					$job_number = $job->job_number;
				}

				$employee_commissions['jobs'][] = [
					'commission_id' => $ec->id,
					'job_number' => $job_number,
					'job_id' => $ec->object_id,
					'commission_amount' => $ec->commission_amount,
					'commission_date' => $ec->commission_date,
					'is_paid' => $ec->is_paid
				];
 			}
		}

		$this->page_data['employee_commissions'] = $employee_commissions; 
	    $this->load->view('v2/pages/users/ajax_commission_list', $this->page_data);
	}

	public function ajax_get_employee_commission_status(){
		$this->load->model('EmployeeCommission_model');

		$is_paid  = 0;
		$msg = 'Cannot find data';

		$post = $this->input->post();
		$commission = $this->EmployeeCommission_model->getById($post['cid']);
		if( $commission ){
			$is_paid = $commission->is_paid;
			$msg = '';
		}

		$json_data = [
            'is_paid' => $is_paid,
            'msg' => $msg
        ];

        echo json_encode($json_data);
	}

	public function ajax_delete_employee_commission(){
		$this->load->model('EmployeeCommission_model');

		$is_success  = 0;
		$employee_id = 0;
		$msg = 'Cannot find data';

		$post = $this->input->post();
		$commission = $this->EmployeeCommission_model->getById($post['cid']);
		if( $commission && $commission->is_paid == 0 ){
			$employee_id = $commission->user_id;
			$is_success  = 1;
			$this->EmployeeCommission_model->delete($post['cid']);
		}else{
			$msg = 'Cannot delete already processed commission';
		}

		$json_data = [
			'employee_id' => $employee_id,
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
	}

	public function role_access_modules()
	{
		$this->load->model('Users_model');
		$this->load->model('CompanyRoleAccessModule_model');
		$this->load->model('Widgets_model');

		$cid = logged('company_id');

		$roles = $this->Users_model->userRolesList();		
		$modules = $this->CompanyRoleAccessModule_model->modules();
		$roleAccessModules = $this->CompanyRoleAccessModule_model->getAllRolesByCompanyId($cid);
		$existingRoles = $this->CompanyRoleAccessModule_model->getAllRolesByCompanyId($cid);
		foreach( $existingRoles as $r ){
			if( isset($roles[$r->role_id]) ){
				unset($roles[$r->role_id]);
			};
		}

		$widgets = $this->Widgets_model->getAll();

		$this->page_data['roles'] = $roles;
		$this->page_data['modules'] = $modules;
		$this->page_data['roleAccessModules'] = $roleAccessModules;
		$this->page_data['widgets'] = $widgets;
		$this->page_data['page']->title = 'Role Access Modules';
		$this->load->view('v2/pages/users/access_role_modules/index', $this->page_data);
	}

	public function ajax_save_role_access_module()
	{
		$this->load->model('CompanyRoleAccessModule_model');
		$this->load->model('CompanyRoleAccessWidget_model');

		$is_success  = 0;		
		$msg = 'Cannot find data';

		$post = $this->input->post();
		$cid  = logged('company_id');

		if( $post['access_type'] == 'access-all' ){
			$data = [
				'company_id' => $cid,
				'role_id' => $post['role'],
				'module' => 'access-all',
				'allow_write' => 1,
				 'allow_delete' => 1,
				'allow_read' => 1,
				'date_created' => date("Y-m-d H:i:s"),
				'date_modified' => date("Y-m-d H:i:s"),
			];

			$this->CompanyRoleAccessModule_model->create($data);

			$data = [
				'company_id' => $cid,
				'role_id' => $post['role'],
				'widget_id' => 0,
				'date_created' => date("Y-m-d H:i:s"),
			];

			$this->CompanyRoleAccessWidget_model->create($data);

			$is_success = 1;
			$msg = '';

		}else{
			if( $post['permission'] ){
				foreach( $post['permission'] as $module => $permission ){
					$data = [
						'company_id' => $cid,
						'role_id' => $post['role'],
						'module' => $module,
						'allow_write' => isset($permission['read']) ? 1 : 0,
						 'allow_delete' => isset($permission['delete']) ? 1 : 0,
						'allow_read' => isset($permission['read']) ? 1 : 0,
						'date_created' => date("Y-m-d H:i:s"),
						'date_modified' => date("Y-m-d H:i:s"),
					];
		
					$this->CompanyRoleAccessModule_model->create($data);
					
				}

				if( $post['roleWidgets'] ){
					foreach( $post['roleWidgets'] as $widget_id ){
						$data = [
							'role_id' => $post['role'],
							'widget_id' => $widget_id,
							'date_created' => date("Y-m-d H:i:s"),
						];
	
						$this->CompanyRoleAccessWidget_model->create($data);
					}
				}				

				$is_success = 1;
				$msg = '';
			}else{
				$msg = 'Please define at least 1 module permission.';
			}
		}

		$json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
	}

	public function ajax_edit_role_access_module()
	{
		$this->load->model('CompanyRoleAccessModule_model');
		$this->load->model('CompanyRoleAccessWidget_model');
		$this->load->model('Widgets_model');
		
		$post = $this->input->post();
		$cid  = logged('company_id');

		$roles = $this->Users_model->userRolesList();
		$modules = $this->CompanyRoleAccessModule_model->modules();		
		$roleAccessModule  = $this->CompanyRoleAccessModule_model->getAllByCompanyIdAndRoleId($cid, $post['rid']);
		$roleAccessWidgets = $this->CompanyRoleAccessWidget_model->getAllByCompanyIdAndRoleId($cid, $post['rid']);

		$groupRoleAccessModules = [];
		foreach($roleAccessModule as $rm){
			$groupRoleAccessModules[$rm->module] = $rm;	
		}

		$accessWidgets = [];
		foreach($roleAccessWidgets as $w){
			$accessWidgets[] = $w->widget_id;
		}

		$widgets = $this->Widgets_model->getAll();
		
		$this->page_data['roles'] = $roles;
		$this->page_data['modules'] = $modules;
		$this->page_data['rid'] = $post['rid'];
		$this->page_data['groupRoleAccessModules'] = $groupRoleAccessModules;
		$this->page_data['accessWidgets'] = $accessWidgets;
		$this->page_data['widgets'] = $widgets;
		$this->load->view('v2/pages/users/access_role_modules/ajax_edit_role_access_module', $this->page_data);
	}

	public function ajax_update_role_access_module()
	{
		$this->load->model('CompanyRoleAccessModule_model');
		$this->load->model('CompanyRoleAccessWidget_model');

		$is_success  = 1;		
		$msg = '';

		$post = $this->input->post();
		$cid  = logged('company_id');
		
		if( !$post['permission'] && $post['access_type'] != 'access-all' ){
			$is_success = 0;
			$msg = 'Please define at least 1 module permission.';
		}

		if( $post['role'] <= 0 ){
			$is_success = 0;
			$msg = 'Cannot save data';
		}

		if( $is_success == 1 ){
			$this->CompanyRoleAccessModule_model->deleteAllByCompanyIdAndRoleId($cid, $post['role']);

			if( $post['access_type'] == 'access-all' ){
				$data = [
					'company_id' => $cid,
					'role_id' => $post['role'],
					'module' => 'access-all',
					'allow_write' => 1,
					'allow_delete' => 1,
					'allow_read' => 1,
					'date_modified' => date("Y-m-d H:i:s"),
				];

				$this->CompanyRoleAccessModule_model->create($data);

				$data = [
					'company_id' => $cid,
					'role_id' => $post['role'],
					'widget_id' => 0,
					'date_created' => date("Y-m-d H:i:s"),
				];
	
				$this->CompanyRoleAccessWidget_model->create($data);

				$is_success = 1;
				$msg = '';

			}else{
				foreach( $post['permission'] as $module => $permission ){
					$data = [
						'company_id' => $cid,
						'role_id' => $post['role'],
						'module' => $module,
						'allow_write' => isset($permission['write']) ? 1 : 0,
						'allow_delete' => isset($permission['delete']) ? 1 : 0,
						'allow_read' => isset($permission['read']) ? 1 : 0,
						'date_modified' => date("Y-m-d H:i:s"),
					];
		
					$this->CompanyRoleAccessModule_model->create($data);
					
				}

				if( isset($post['roleWidgets']) ){
					foreach( $post['roleWidgets'] as $widget_id ){
						$data = [
							'company_id' => $cid,
							'role_id' => $post['role'],
							'widget_id' => $widget_id,
							'date_created' => date("Y-m-d H:i:s"),
						];

						$this->CompanyRoleAccessWidget_model->create($data);
					}
				}				

				$is_success = 1;
				$msg = '';
			}
		}			

		$json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
	}

	public function ajax_delete_role_access_module()
	{
		$this->load->model('CompanyRoleAccessModule_model');
		$this->load->model('CompanyRoleAccessWidget_model');

		$is_success  = 1;		
		$msg = '';

		$post = $this->input->post();
		$cid  = logged('company_id');

		$this->CompanyRoleAccessModule_model->deleteAllByCompanyIdAndRoleId($cid, $post['rid']);
		$this->CompanyRoleAccessWidget_model->deleteAllByCompanyIdAndRoleId($cid, $post['rid']);
		
		$json_data = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($json_data);
	}

    private function getGeneratedPDFUploadPath()
    {
        $filePath = FCPATH . (implode(DIRECTORY_SEPARATOR, ['uploads', 'irsw9']) . DIRECTORY_SEPARATOR);
        if (!file_exists($filePath)) {
            mkdir($filePath, 0777, true);
        }

        return $filePath;
    } 	

	public function download_company_w9_form()
	{
        error_reporting(0);
		
		$this->load->model('Business_model');

        require_once(APPPATH . 'libraries/tcpdf/tcpdf.php');
        require_once(APPPATH . 'libraries/tcpdf/tcpdi.php');
        
        $generatedPDF = '/uploads/irsw9/fw9_v1.4.pdf';

        $business_name1   = "---";
        $business_name2   = "---";
        $business_address = "---";
        $city_state_zip   = "---";

		$is_add_ssn = false;
		$is_add_ein = false;
		$is_add_business_type = false;
        
		$company_id = logged('company_id');
        $business_profile = $this->Business_model->getByCompanyId($company_id);

        if($business_profile){        

            $business_name1 = $business_profile->business_name;
            $business_name2 = $business_profile->business_name;
            $business_address = $business_profile->street;
            $city_state_zip = $business_profile->city . ", " . $business_profile->state . " " . $business_profile->postal_code;

			if($business_profile->ssn != null && $business_profile->ssn != "") {
				$is_add_ssn = true;
				//$ssn_data = $business_profile->ssn;
				$ssn_data = str_replace("-","", $business_profile->ssn);
			}

			if($business_profile->EIN != null && $business_profile->EIN != "") {
				$is_add_ein = true;
				//$ein_data = $business_profile->EIN;
				$ein_data = str_replace("-","", $business_profile->EIN);
			}

			if($business_profile->business_type != null && $business_profile->business_type != "") {
				$is_add_business_type = true;
				$business_type = $business_profile->business_type;
			}
        }

        if ($generatedPDF) {
            $generatedPDFPath = FCPATH . ltrim($generatedPDF, '/');

            $pageCount        = 0; 
            if (file_exists($generatedPDFPath)) {                
                $pdf       = new FPDI('P', 'px');
                $pageCount = $pdf->setSourceFile($generatedPDFPath);
                
                for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                    $pageIndex = $pdf->importPage($pageNo);
                    $pdf->AddPage();
                    $pdf->useTemplate($pageIndex, null, null, 0, 0, true);

					if( $pageNo == 1 ){
						$pdf->setY(115);
						$pdf->setX(100);
						$pdf->SetFont('Arial', '', 10);
						$pdf->SetFillColor(249,249,249);
						$pdf->Cell(300, 10, $business_name1, 0, 0, 'L', 0);   

						
						$pdf->setY(142);
						$pdf->setX(100);
						$pdf->SetFont('Arial', '', 10);
						$pdf->SetFillColor(249,249,249);
						$pdf->Cell(300, 10, $business_name2, 0, 0, 'L', 0); 


						$pdf->setY(285);
						$pdf->setX(100);
						$pdf->SetFont('Arial', '', 10);
						$pdf->SetFillColor(249,249,249);
						$pdf->Cell(300, 10, $business_address, 0, 0, 'L', 0); 

						
						$pdf->setY(310);
						$pdf->setX(100);
						$pdf->SetFont('Arial', '', 10);
						$pdf->SetFillColor(249,249,249);
						$pdf->Cell(300, 10, $city_state_zip, 0, 0, 'L', 0); 

						/**
						 * This is for checkbox - start
						 */
						if($is_add_business_type) {
							//This is for 'Individual/Sole Proprietor'
							if($business_type == "Individual / Sole Proprietor") {
								$pdf->SetFillColor(0, 0, 0);
								$pdf->Rect(73, 180, 8, 8, 'F');
							}

							//This is for 'C corporation'
							if($business_type == "C Corporation") {
								$pdf->SetFillColor(0, 0, 0);
								$pdf->Rect(180, 180, 8, 8, 'F');
							}
							
							//This is for 'S corporation'
							if($business_type == "S Corporation") {
								$pdf->SetFillColor(0, 0, 0);
								$pdf->Rect(251, 180, 8, 8, 'F');
							}

							//This is for 'Partnership'
							if($business_type == "Partnership") {
								$pdf->SetFillColor(0, 0, 0);
								$pdf->Rect(324, 180, 8, 8, 'F');
							}

							//This is for 'Trust Estate'
							if($business_type == "Trust / Estate") {
								$pdf->SetFillColor(0, 0, 0);
								$pdf->Rect(389, 180, 8, 8, 'F');
							}

							//This is for 'LLC. Enter the...'
							if($business_type == "LLC") {
								$pdf->SetFillColor(0, 0, 0);
								$pdf->Rect(73, 194, 8, 8, 'F');
							}

							//This is for 'Other'
							if($business_type == "Others") {
								$pdf->SetFillColor(0, 0, 0);
								$pdf->Rect(73, 230, 8, 8, 'F');
							}
						}
						/**
						 * This is for checkbox - end
						 */

						//SSN - Start
						if($is_add_ssn) {
							$pdf->setY(374);
							$pdf->setX(418);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[0]) ? $ssn_data[0] : '', 0, 0, 'L', 0); 

							$pdf->setY(374);
							$pdf->setX(432);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[1]) ? $ssn_data[1] : '', 0, 0, 'L', 0); 

							$pdf->setY(374);
							$pdf->setX(446);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[2]) ? $ssn_data[2] : '', 0, 0, 'L', 0); 

							$pdf->setY(374);
							$pdf->setX(475);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[3]) ? $ssn_data[3] : '', 0, 0, 'L', 0); 

							$pdf->setY(374);
							$pdf->setX(489);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[4]) ? $ssn_data[4] : '', 0, 0, 'L', 0); 

							$pdf->setY(374);
							$pdf->setX(519);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[5]) ? $ssn_data[5] : '', 0, 0, 'L', 0); 

							$pdf->setY(374);
							$pdf->setX(533);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[6]) ? $ssn_data[6] : '', 0, 0, 'L', 0); 

							$pdf->setY(374);
							$pdf->setX(547);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[7]) ? $ssn_data[7] : '', 0, 0, 'L', 0);

							$pdf->setY(374);
							$pdf->setX(562);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ssn_data[8]) ? $ssn_data[8] : '', 0, 0, 'L', 0);
						}
						//SSN - End

						//EIN - Start
						if($is_add_ein) {
							$pdf->setY(423);
							$pdf->setX(418);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[0]) ? $ein_data[0] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(432);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[1]) ? $ein_data[1] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(461);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[2]) ? $ein_data[2] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(475);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[3]) ? $ein_data[3] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(489);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[4]) ? $ein_data[4] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(503);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[5]) ? $ein_data[5] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(517);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[6]) ? $ein_data[6] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(531);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[7]) ? $ein_data[7] : '', 0, 0, 'L', 0);

							$pdf->setY(423);
							$pdf->setX(546);
							$pdf->SetFont('Arial', '', 12);
							$pdf->SetFillColor(249,249,249);
							$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, isset($ein_data[8]) ? $ein_data[8] : '', 0, 0, 'L', 0);							
						}
						//EIN - End

						//Signature
						if( $business_profile->img_signature != '' ){
							$signatureHeight = 30;
							$signatureImage  = base_url('uploads/Signatures/company/'.$company_id.'/'.$business_profile->img_signature);
							$pdf->setY(570);
							$pdf->setX(130);
							$pdf->Image($signatureImage, null, null, null,  $signatureHeight);
							
							$date = date("m/d/Y");
							$pdf->setY(585);
							$pdf->setX(400);
							$pdf->SetFont('Arial', '', 9);
							$pdf->SetFillColor(249,249,249);
							//$pdf->setFontStretching(130);
							$pdf->Cell(300, 10, $date, 0, 0, 'L', 0);		
						}
					}                
                }

                $uploadPath = $this->getGeneratedPDFUploadPath();

                $uploadFilePath = $uploadPath . 'generatedfW9.pdf';

                //Display in browser
                $pdf->Output('I');

                //$pdf->Output($uploadFilePath, 'F');
            }
        }   
        
        return $pdf->Output(null, 'S');
	}

	public function ajax_update_company_signature()
	{
		$this->load->model('Business_model');

		$post = $this->input->post();
		$cid  = logged('company_id');

		$business = $this->Business_model->getByCompanyId($cid);
		if (!empty($post['user_approval_signature1aM_web'])) {

			$folderPath = "./uploads/Signatures/company/$cid/";
			if (!file_exists($folderPath)) {
				mkdir($folderPath, 0777, true);
			}

			$rand1  = rand(10, 10000000);
			$datasig            = $post['user_approval_signature1aM_web'];
			$image_parts        = explode(";base64,", $datasig);
			$image_type_aux     = explode("image/", $image_parts[0]);
			$image_type         = $image_type_aux[1];
			$image_base64       = base64_decode($image_parts[1]);
			$filename           = $rand1 . $wo_id . '_user' . '.' . $image_type;
			$file               = $folderPath . $filename;
			file_put_contents($file, $image_base64);

			$data = ['img_signature' => $filename];
			$this->Business_model->update($business->id, $data);
		}

		echo $filename;
	}

	public function ajax_archive_selected_users()
    {
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['users'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archived' => 'Yes', 'updated_at' => date("Y-m-d H:i:s")];
            $this->Users_model->bulkUpdate($post['users'], $data, $filter);

			//Activity Logs
			$activity_name = 'Users : Archived ' . $total_updated . ' user(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

	public function ajax_change_status_selected_users()
    {
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['users'] ){                                    
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['status' => $post['status'], 'updated_at' => date("Y-m-d H:i:s")];
            $total_updated = $this->Users_model->bulkUpdate($post['users'], $data, $filter);

			//Activity Logs
			$activity_name = 'Users : ' . $total_updated . ' user(s) was changed status to ' . $post['status']; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

	public function ajax_archived_list()
	{
        $post = $this->input->post();
        $company_id = logged('company_id');

		$filters = ['is_archived' => 'Yes'];
        $users = $this->Users_model->getCompanyUsers($company_id,$filters);
        $this->page_data['users'] = $users;
        $this->load->view('v2/pages/users/ajax_archive_users', $this->page_data);
	}

	public function ajax_restore_selected_users()
	{
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['users'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['is_archived' => 'No', 'updated_at' => date("Y-m-d H:i:s")];
            $total_updated = $this->Users_model->bulkUpdate($post['users'], $data, $filter);

			//Activity Logs
			$activity_name = 'Users : Restored ' . $total_updated . ' user(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_restore_user()
	{
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $user = $this->Users_model->getUser($post['user_id']);
		if( $user && $user->company_id == $company_id ){
			$data     = ['is_archived' => 'No', 'updated_at' => date("Y-m-d H:i:s")];
			$this->Users_model->update($user->id, $data);

			//Activity Logs
			$name = $user->FName . ' ' . $user->LName;
			$activity_name = 'Users : Restored user ' . $name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_archived_user()
	{
		$this->load->model('Clients_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

		$user = $this->Users_model->getUser($post['user_id']);
        if( $user && $user->company_id == $company_id ){
			//Return credits
			if( !in_array($company_id, exempted_company_ids()) ){ 
				$client = $this->Clients_model->getById($company_id);
				$num_license = $client->number_of_license + 1;
				$data = ['number_of_license' => $num_license];
				$this->Clients_model->update($client->id, $data);		
			}

			$this->Users_model->delete($user->id);

			//Activity Logs
			$name = $user->FName . ' ' . $user->LName;
			$activity_name = 'Users : Permanently deleted user ' . $name; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_permanently_delete_selected_users()
	{
		$this->load->model('Clients_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['users'] ){

			$total_archived = count($post['users']);
			//Return credits
			if( !in_array($company_id, exempted_company_ids()) ){ 				
				if( $total_archived > 0 ){
					$client = $this->Clients_model->getById($company_id);
					$num_license = $client->number_of_license + $total_archived;
					$data = ['number_of_license' => $num_license];
					$this->Clients_model->update($client->id, $data);
				}			
			}

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
			$filters[] = ['field' => 'is_archived', 'value' => 'Yes'];
            $total_deleted = $this->Users_model->bulkDelete($post['users'], $filters);

			//Activity Logs
			$activity_name = 'Users : Permanently deleted ' .$total_deleted. ' user(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

	public function ajax_delete_all_archived_users()
	{
		$this->load->model('Clients_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

		$filters = ['is_archived' => 'Yes'];
        $users   = $this->Users_model->getCompanyUsers($company_id,$filters);
		$total_archived = count($users);
		//Return credits
		if( !in_array($company_id, exempted_company_ids()) ){ 
			if( $total_archived > 0 ){
				$client = $this->Clients_model->getById($company_id);
				$num_license = $client->number_of_license + $total_archived;
				$data = ['number_of_license' => $num_license];
				$this->Clients_model->update($client->id, $data);
			}			
		}		

        $filter[] = ['field' => 'company_id', 'value' => $company_id];
		$this->Users_model->deleteAllArchived($filter);

		//Activity Logs
		$activity_name = 'Users : Permanently deleted ' .$total_archived. ' user(s)'; 
		createActivityLog($activity_name);

		$is_success = 1;
		$msg    = '';

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}
}
/* End of file Users.php */
/* Location: ./application/controllers/Users.php */