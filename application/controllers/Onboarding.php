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

		$cid  = logged('company_id');
		$client      = $this->Clients_model->getById($cid);
		if( $client->is_startup == 0 ){
			redirect('dashboard');
		}

		$this->page_data['page_title'] = 'Onboarding';
		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');
	}

	public function business_info() {
		
		$user = (object)$this->session->userdata('logged');
		$uid  = logged('id');
		$cid  = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($cid);
		$client      = $this->Clients_model->getById($cid);

		$business_name    = $client->business_name;
		$business_address = $client->business_address;
		$zip_code         = $client->zip_code;
		$city   		  = $client->city;
		$state            = $client->state;
		$business_phone   = $client->phone_number;
		$business_email   = $client->email_address;

		if( $profiledata ){
			$business_name    = $profiledata->business_name;
			$business_address = $profiledata->address;
		}  

		$this->page_data['business_name'] = $business_name;
		$this->page_data['zip_code'] = $zip_code;
		$this->page_data['city']	 = $city;
		$this->page_data['state']    = $state;
		$this->page_data['business_phone'] = $business_phone;
		$this->page_data['business_address'] = $business_address;
		$this->page_data['business_email'] = $business_email;
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

        $cid =logged('company_id');
        $client      = $this->Clients_model->getById($cid);
        $industryTypeId = $client->industry_type_id;
		//ifPermissions('businessdetail');
		$user = $this->session->userdata('logged');
		$user_id = $user['id'];		
		$userdata = $this->Users_model->getUser($user_id);
		$company_id = $userdata->company_id;
	 	$selectedCategories = $this->ServiceCategory_model->getAllCategoriesByCompanyID($company_id);
	
		$this->page_data['industryType'] = $industryType;
		$this->page_data['industryTypeId'] = $industryTypeId;
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
		        foreach ($categories[0] as $key => $category) {
		        	$industry_type_name  = $this->IndustryType_model->getById($category);
		        	$industry_name = $industry_type_name->name;
		           	$data = [
	        			'company_id' => $company_id,
	        			'industry_type_id' => $category,
	        			'service_name' => $industry_name,
	        			'date_created' => date("Y-m-d H:i:s"),
	        			'date_modified' => date("Y-m-d H:i:s")
	        		];
	        		$ServiceCategory = $this->ServiceCategory_model->create($data);

	        		$data2 = [
	        			'industry_type_id' => $category
	        		];
		            $this->Clients_model->updateClient($company_id, $data2);
		        }

        		$this->session->set_flashdata('message', 'Service was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please select a services');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('onboarding/availability');

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('onboarding/industry_type');
        }
	}

	public function company_size() {
		$cid  = logged('company_id');
		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		
		$this->load->view('onboarding/company_size', $this->page_data);	
	}

	public function add_ons() {
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
		$profiledata = $this->business_model->getByCompanyId($cid);	
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		
		$this->load->view('onboarding/booking_online_demo', $this->page_data);
	}

	public function about(){
		$user_id = logged('id');
		$cid     = logged('company_id');

		$profiledata = $this->business_model->getByWhere(array('company_id'=>$cid));	
		$client      = $this->Clients_model->getById($cid);
		$num_emp     = $client->number_of_employee;
		$optionBusinessType = $this->business_model->optionBusinessTypes();
		if( $profiledata ){
			if( $profiledata[0]->employee_count != '' ){
				$num_emp = $profiledata[0]->employee_count;
			}			
		}
		
		$this->page_data['num_emp'] = $num_emp;
		$this->page_data['userid']  = $user_id;
		$this->page_data['optionBusinessType'] = $optionBusinessType;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
		$this->load->view('onboarding/about', $this->page_data);
	}

	public function ajax_save_business_availability(){
		error_reporting(0);
		$is_success = true;
		$msg = '';

		$user   = (object)$this->session->userdata('logged');
		$cid    = logged('company_id');	
		$pdata  = $this->input->post();
		$action = $pdata['action'];
		$business = $this->business_model->getByCompanyId($cid);
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
		$cid    = logged('company_id');
		$business = $this->business_model->getByCompanyId($cid);
		unset($pdata['action']);
		if( $cid > 0 ){
			if($business){
				$bid = $business->id;
				$target_dir = "./uploads/users/business_profile/$bid/";
				if(!file_exists($target_dir)) {
					mkdir($target_dir, 0777, true);
				}
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
						'insurance_expiry_date' => date("Y-m-d",strtotime(str_replace("-","/",$pdata['insured_exp_date']))),
						'bond_amount' => $pdata['bonded_amount'],
						'bond_expiry_date' => date("Y-m-d",strtotime(str_replace("-","/",$pdata['bonded_exp_date']))),
						'license_class' => $pdata['license_class'],
						'license_number' => $pdata['license_number'],
						'license_state' => $pdata['license_state'],
						'license_expiry_date' => date("Y-m-d",strtotime(str_replace("-","/",$pdata['license_exp_date']))),
						'bbb_link' => $pdata['bbb_url'],
						'license_image' => $license_image_name,
						'bond_image' => $bond_image_name,
						'insurance_image' => $insurance_image_name
					];

					$this->business_model->update($bid,$data_availability);	
					//redirect('onboarding/booking_online_demo');
					$this->ajax_complete_onboarding();
					redirect('dashboard');
					
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
						copy(FCPATH.'uploads/users/default.png', 'uploads/users/business_profile/'.$bid.'/default.png');
					}

					$pdata['profile_slug'] = createSlug($pdata['business_name'], '-');	
					$this->business_model->update($bid,$pdata);	
					return redirect('onboarding/about');
				}
			}else{				
				$pdata['user_id'] = $user->id;
				$pdata['company_id'] = $cid;
				$pdata['profile_slug'] = createSlug($pdata['business_name'], '-');	
				$imbid = $user->id;
				$bid   = $this->business_model->create($pdata);

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
		}else{
			redirect('/');
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
		$cid  = logged('company_id');
		$client      = $this->Clients_model->getById($cid);
		$profiledata = $this->business_model->getByCompanyId($cid);
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

		$user_id = logged('id');
		$cid     = logged('company_id');
		$profiledata = $this->business_model->getByCompanyId($cid);	
		$client      = $this->Clients_model->getById($cid);
		$states = statesList();

		$this->page_data['states'] = $states;
		$this->page_data['userid'] = $user_id;
		$this->page_data['profiledata'] = $profiledata;
		
		$this->load->view('onboarding/credentials', $this->page_data);
	}

	public function ajax_complete_onboarding(){
		$this->load->model('CustomerStatus_model');
		$this->load->model('CustomerSettings_model');

		$is_success = true;
		$msg = '';

		$comp_id = logged('company_id');
		$client  = $this->Clients_model->getById($comp_id);

		$data_client = ['is_startup' => 0];
		$this->Clients_model->update($client->id, $data_client);
		
		//Create default customer status
		$customer_status[] = [
			'company_id' => $comp_id,
			'name' => 'Active',
			'date_created' => date("Y-m-d H:i:d")
		];
		$customer_status[] = [
			'company_id' => $comp_id,
			'name' => 'Inactive',
			'date_created' => date("Y-m-d H:i:d")
		];
		$customer_status[] = [
			'company_id' => $comp_id,
			'name' => 'Collection',
			'date_created' => date("Y-m-d H:i:d")
		];
		$this->CustomerStatus_model->batchInsert($customer_status);

		//Create default import settings
		$import_settings['setting_type'] = 'import';
		$import_settings['value'] = '1,2,5,6,7,8,9,10,12,13,14,15,16,61';
		$import_settings['status'] = 1;
		$import_settings['company_id'] = $comp_id;
		$import_settings['created_at'] = date("Y-m-d H:i:s");
		$this->CustomerSettings_model->create($import_settings);
		
		$json_data = ['is_success' => $is_success, 'msg' => $msg];
		echo json_encode($json_data);
	}

}

/* End of file Onboarding.php */
/* Location: ./application/controllers/Onboarding.php */
