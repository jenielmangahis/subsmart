<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onboarding extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		//$this->checkLogin();
		$role_id = 1; //this is for nsmart admin user
		$this->isCheckLoginAndRole($role_id);

		$this->load->model('IndustryType_model');
        $this->load->model('Users_model');
        $this->load->model('ServiceCategory_model');
        $this->load->model('NsmartUpgrades_model');
		$this->load->model('SubscriberNsmartUpgrade_model');
		$this->load->model('Clients_model');

		$this->page_data['page_title'] = 'Onboarding';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');
	}

	public function business_info() {
		
		$user = (object)$this->session->userdata('logged');
		$uid  = logged('id');
		$cid  = logged('company_id');
		$profiledata = $this->business_model->getByUserId($uid);
		$client      = $this->Clients_model->getById($cid);

		$business_name    = $client->business_name;
		$business_address = $client->business_address;

		if( $profiledata ){
			$business_name    = $profiledata->business_name;
			$business_address = $profiledata->address;
		}  

		$this->page_data['business_name'] = $business_name;
		$this->page_data['business_address'] = $business_address;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata : null;

		$this->load->view('onboarding/business_info', $this->page_data);
	}

	public function industry_type() {
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
		//ifPermissions('businessdetail');
		$user = $this->session->userdata('logged');
		$user_id = $user['id'];		
		$userdata = $this->Users_model->getUser($user_id);
		$company_id = $userdata->company_id;
	 	$selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($company_id);
	
		$this->page_data['industryType'] = $industryType;
		$this->page_data['businessTypes'] = $businessTypes;
		$this->page_data['selectedCategories'] = $selectedCategories;
		//print_r($user);die;
		$cid = logged('id');
		
		$this->load->view('onboarding/industry_type', $this->page_data);	
	}

	public function saveservices() {
		postAllowed();
        $user = $this->session->userdata('logged');
        $post = $this->input->post();

        $industryTemplate = $this->IndustryType_model->getById($post['type_id']);
        $user_id = $user['id'];	
	    $userdata = $this->Users_model->getUser($user_id);
        $categories = $post['categories'];
	     
        if( $userdata ){
        	if( $post['categories'] != '' ){
        	    $company_id = $userdata->company_id;
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

        		$this->session->set_flashdata('message', 'Service was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please select a services');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('onboarding/add_ons');

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('onboarding/industry_type');
        }
	}

	public function company_size() {
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');

		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		
		$this->load->view('onboarding/company_size', $this->page_data);	
	}

	public function add_ons() {
		
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');
		$NsmartUpgradedItems = $this->SubscriberNsmartUpgrade_model->getAllByClientId($cid);
		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		$this->page_data['NsmartUpgradedItems'] = $NsmartUpgradedItems;
		$this->load->view('onboarding/add_ons', $this->page_data);
	}

	public function booking_online_demo() {
		
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');

		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		
		$this->load->view('onboarding/booking_online_demo', $this->page_data);
	}

	public function about(){
		$user = (object)$this->session->userdata('logged');
		$uid  = logged('id');
		$cid  = logged('company_id');

		$profiledata = $this->business_model->getByWhere(array('user_id'=>$uid));	
		$client      = $this->Clients_model->getById($cid);

		$num_emp          = $client->number_of_employee;
		if( $profiledata ){
			$num_emp          = $profiledata->employee_count;
		}

		$this->page_data['num_emp'] = $num_emp;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;

		$this->load->view('onboarding/about', $this->page_data);
	}

	public function ajax_save_business_availability(){
		error_reporting(0);
		$is_success = true;
		$msg = '';

		$user   = (object)$this->session->userdata('logged');	
		$pdata  = $this->input->post();
		$action = $pdata['action'];
		$business = $this->business_model->getByUserId($user->id);
		unset($pdata['action']);

		$schedules = array();

		foreach( $pdata['weekday'] as $value ){
			switch ($value) {
				case 'Monday':
					if( $pdata['monHoursFromAvail'] != '' && $pdata['monHoursToAvail'] != '' ){
						$schedules[] = [
							'day' => 'Monday',
							'time_from' => $pdata['monHoursFromAvail'],
							'time_to' => $pdata['monHoursToAvail']
						];
					}else{
						$is_success = false;
						$msg = 'Please specify start and end time for Monday';
					}							
					break;
				case 'Tuesday':
					if( $pdata['tueHoursFromAvail'] != '' && $pdata['tueHoursToAvail'] != '' ){
						$schedules[] = [
							'day' => 'Tuesday',
							'time_from' => $pdata['tueHoursFromAvail'],
							'time_to' => $pdata['tueHoursToAvail']
						];
					}else{
						$is_success = false;
						$msg = 'Please specify start and end time for Tuesday';
					}
					break;
				case 'Wednesday':
					if( $pdata['wedHoursFromAvail'] != '' && $pdata['wedHoursToAvail'] != '' ){
						$schedules[] = [
							'day' => 'Wednesday',
							'time_from' => $pdata['wedHoursFromAvail'],
							'time_to' => $pdata['wedHoursToAvail']
						];
					}else{
						$is_success = false;
						$msg = 'Please specify start and end time for Wednesday';
					}
					break;
				case 'Thursday':
					if( $pdata['thuHoursFromAvail'] != '' && $pdata['thuHoursToAvail'] != '' ){
						$schedules[] = [
							'day' => 'Thursday',
							'time_from' => $pdata['thuHoursFromAvail'],
							'time_to' => $pdata['thuHoursToAvail']
						];
					}else{
						$is_success = false;
						$msg = 'Please specify start and end time for Thursday';
					}							
					break;
				case 'Friday':
					if( $pdata['friHoursFromAvail'] != '' && $pdata['friHoursToAvail'] != '' ){
						$schedules[] = [
							'day' => 'Friday',
							'time_from' => $pdata['friHoursFromAvail'],
							'time_to' => $pdata['friHoursToAvail']
						];		
					}else{
						$is_success = false;
						$msg = 'Please specify start and end time for Friday';
					}										
					break;
				case 'Saturday':
					if( $pdata['satHoursFromAvail'] != '' && $pdata['satHoursToAvail'] != '' ){
						$schedules[] = [
							'day' => 'Saturday',
							'time_from' => $pdata['satHoursFromAvail'],
							'time_to' => $pdata['satHoursToAvail']
						];
					}else{
						$is_success = false;
						$msg = 'Please specify start and end time for Saturday';
					}							
					break;
				case 'Sunday':
					if( $pdata['sunHoursFromAvail'] != '' && $pdata['sunHoursToAvail'] != '' ){
						$schedules[] = [
							'day' => 'Sunday',
							'time_from' => $pdata['sunHoursFromAvail'],
							'time_to' => $pdata['sunHoursToAvail']
						];
					}else{
						$is_success = false;
						$msg = 'Please specify start and end time for Sunday';
					}
					break;
				default:
					break;
			}
		}

		if( $is_success ){
			$schedules = serialize($schedules);
			$data_availability = [
				'working_days' => $schedules,
				'start_time_of_day' => $pdata['timeoff_from'],
				'end_time_of_day' => $pdata['timeoff_to']					
			];

			$this->business_model->update($business->id,$data_availability);	
		}

		$json_data = ['is_success' => $is_success, 'msg' => $msg];
		echo json_encode($json_data);
	}

	public function save_business_info(){
		$user   = (object)$this->session->userdata('logged');	
		$pdata  = $this->input->post();
		$action = $pdata['action'];
		$business = $this->business_model->getByUserId($user->id);
		unset($pdata['action']);
		if($business){
			$bid = $business->id;
			if( $action == 'credentials' ){
				$is_licensed = 0;
				if( isset($pdata['is_licensed']) ){
					$is_licensed = 1;
				}

				$is_bonded = 0;
				if( isset($pdata['is_bonded']) ){
					$is_bonded = 1;
				}

				$is_insured = 0;
				if( isset($pdata['is_insured']) ){
					$is_insured = 1;
				}

				$is_bbb = 0;
				if( isset($pdata['is_bbb']) ){
					$is_bbb = 1;
				}

				$license_image_name = $business->license_image;
				if(isset($_FILES['license_image']) && $_FILES['license_image']['tmp_name'] != '') {
					$tmp_name = $_FILES['license_image']['tmp_name'];
					$extension = strtolower(end(explode('.',$_FILES['license_image']['name'])));
					$license_image_name = "license_" . basename($_FILES["license_image"]["name"]);
					move_uploaded_file($tmp_name, "./uploads/users/business_profile/$bid/$license_image_name");
				}

				$bond_image_name = $business->bond_image;
				if(isset($_FILES['bond_image']) && $_FILES['bond_image']['tmp_name'] != '') {
					$tmp_name = $_FILES['bond_image']['tmp_name'];
					$extension = strtolower(end(explode('.',$_FILES['bond_image']['name'])));
					$bond_image_name = "bond_" . basename($_FILES["bond_image"]["name"]);
					move_uploaded_file($tmp_name, "./uploads/users/business_profile/$bid/$bond_image_name");
				}

				$insurance_image_name = $business->insurance_image;
				if(isset($_FILES['insurance_image']) && $_FILES['insurance_image']['tmp_name'] != '') {
					$tmp_name = $_FILES['insurance_image']['tmp_name'];
					$extension = strtolower(end(explode('.',$_FILES['insurance_image']['name'])));
					$insurance_image_name = "bond_" . basename($_FILES["insurance_image"]["name"]);
					move_uploaded_file($tmp_name, "./uploads/users/business_profile/$bid/$insurance_image_name");
				}

				$data_availability = [
					'is_bonded' => $is_bonded,
					'is_licensed' => $is_licensed,
					'is_bbb_accredited' => $is_bbb,
					'is_business_insured' => $is_insured,
					'insured_amount' => $pdata['insured_amount'],
					'insurance_expiry_date' => $pdata['insured_exp_date'],
					'bond_amount' => $pdata['bonded_amount'],
					'bond_expiry_date' => $pdata['bonded_exp_date'],
					'license_class' => $pdata['license_class'],
					'license_number' => $pdata['license_number'],
					'license_state' => $pdata['license_state'],
					'license_expiry_date' => $pdata['license_exp_date'],
					'bbb_link' => $pdata['bbb_url'],
					'license_image' => $license_image_name,
					'bond_image' => $bond_image_name,
					'insurance_image' => $insurance_image_name
				];

				$this->business_model->update($bid,$data_availability);	
				redirect('onboarding/booking_online_demo');
				
			}elseif( $action == 'about' ){
				$this->business_model->update($bid,$pdata);	
				redirect('onboarding/industry_type');
			}else{
				if (!empty($_FILES['image']['name'])){
					$target_dir = "./uploads/users/business_profile/$bid/";
					if(!file_exists($target_dir)) {
						mkdir($target_dir, 0777, true);
					}
					$business_image = $this->moveUploadedFile($bid);
					$this->business_model->update($bid, ['business_image' => $business_image]);
				}else{
					copy(FCPATH.'uploads/users/default.png', 'uploads/users/business_profile/'.$user->id.'/default.png');
				}
				$this->business_model->update($bid,$pdata);	
				redirect('onboarding/about');
			}
		}else{
			$this->business_model->update($bid,$pdata);	
			$pdata['user_id'] = $user->id;
			$imbid=$user->id;
			$bid = $this->business_model->create($pdata);

			if(!empty($_FILES['image']['name'])){
				$target_dir = "./uploads/users/business_profile/$bid/";
				if(!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}
				$business_image = $this->moveUploadedFile($bid);
				$this->business_model->update($bid, ['business_image' => $business_image]);
			}else{
				copy(FCPATH.'uploads/users/default.png', 'uploads/users/business_profile/'.$user->id.'/default.png');
			}

			redirect('onboarding/about');
		}

		/*$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Business detail updated Successfully');	*/
	}

	public function moveUploadedFile($bid) {
		if(isset($_FILES['image']) && $_FILES['image']['tmp_name'] != '') {
			$tmp_name = $_FILES['image']['tmp_name'];
			$extension = strtolower(end(explode('.',$_FILES['image']['name'])));
			// basename() may prevent filesystem traversal attacks;
			// further validation/sanitation of the filename may be appropriate
			$name = basename($_FILES["image"]["name"]);
			move_uploaded_file($tmp_name, "./uploads/users/business_profile/$bid/$name");

			return $name;
		}
	}

	public function availability() {
		
		//ifPermissions('businessdetail');
		$user = (object)$this->session->userdata('logged');	
		$cid = logged('id');
		$profiledata = $this->business_model->getByUserId($cid);

		$workingDays = unserialize($profiledata->working_days);
		
		$data_working_days = array();
		if( !empty($workingDays) ){
			foreach( $workingDays as $d ){
				$data_working_days[$d['day']] = ['time_from' => $d['time_from'], 'time_to' => $d['time_to']];
			}	
		}else{
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
		$this->load->view('onboarding/availability', $this->page_data);
	}

	public function ajax_load_plugin_details(){
		$post = $this->input->post();
		$plugin = $this->NsmartUpgrades_model->getById($post['aid']);

		$this->page_data['plugin'] = $plugin;
		$this->load->view('onboarding/ajax_load_plugin_details', $this->page_data);
	}

	public function add_plugin(){
		postAllowed();

		$post = $this->input->post();
		$user = $this->session->userdata('logged');
		$cid  = logged('company_id');

		if( $post['pid'] > 0 ){
			if( $post['action'] == 'add' ){
				$upgrade = $this->SubscriberNsmartUpgrade_model->getByClientIdAndNsmartUpgradeId($cid, $post['pid']);
				if( $upgrade ){
					$this->session->set_flashdata('message', 'Plugin already availed');
	        		$this->session->set_flashdata('alert_class', 'alert-danger');
				}else{
					$data = [
		    			'client_id' => $cid,
		    			'plan_upgrade_id' => $post['pid'],
		    			'date_created' => date("Y-m-d H:i:s"),
		    			'date_modified' => date("Y-m-d H:i:s")
		    		];

		    		$subscriberAddon = $this->SubscriberNsmartUpgrade_model->create($data);

		    		$this->session->set_flashdata('message', 'Plugin list was successfully updated');
		        	$this->session->set_flashdata('alert_class', 'alert-success');
				}
			}else{
				$this->SubscriberNsmartUpgrade_model->deleteClientPlanUpgradeId($cid, $post['pid']);
				$this->session->set_flashdata('message', 'Plugin list was successfully removed');
		        	$this->session->set_flashdata('alert_class', 'alert-success');
			}
		}else{
			$this->session->set_flashdata('message', 'Plugin not found');
        	$this->session->set_flashdata('alert_class', 'alert-danger');
		}

		redirect('onboarding/add_ons');
	}

	public function credentials(){
		add_footer_js(array(
            'assets/js/user.js'
        ));

		$user = (object)$this->session->userdata('logged');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByUserId($cid);	
		$states = statesList();

		$this->page_data['states'] = $states;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata;
		
		$this->load->view('onboarding/credentials', $this->page_data);
	}

	public function ajax_complete_onboarding(){
		$is_success = true;
		$msg = '';

		$comp_id = logged('company_id');
		$client  = $this->Clients_model->getById($comp_id);

		$data_client = ['is_startup' => 0];
		$this->Clients_model->update($client->id, $data_client);
		
		$json_data = ['is_success' => $is_success, 'msg' => $msg];
		echo json_encode($json_data);
	}

}

/* End of file Onboarding.php */
/* Location: ./application/controllers/Onboarding.php */
