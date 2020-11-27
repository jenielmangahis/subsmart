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

		$this->page_data['page_title'] = 'Onboarding';

		$this->load->helper(array('form', 'url', 'hashids_helper'));
		$this->load->library('session');
	}

	public function business_info() {
		
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));	
		//dd($profiledata);die;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;

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

	        redirect('onboarding/industry_type');

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('onboarding/industry_type');
        }
	}

	public function company_size() {
		$this->load->view('onboarding/company_size', $this->page_data);	
	}

	public function add_ons() {
		
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('company_id');

		$NsmartUpgrades = $this->NsmartUpgrades_model->getAll();
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		$this->page_data['NsmartUpgrades'] = $NsmartUpgrades;
		
		$this->load->view('onboarding/add_ons', $this->page_data);
	}

	public function about(){
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));	
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;

		$this->load->view('onboarding/about', $this->page_data);
	}

	public function save_business_info(){
		$user   = (object)$this->session->userdata('logged');	
		$pdata  = $this->input->post();
		$action = $pdata['action'];
		$business = $this->business_model->getByUserId($user->id);
		unset($pdata['action']);
		if($business){
			$bid = $business->id;
			if( $action == 'availability' ){

				$schedules = array();

				foreach( $pdata['weekday'] as $value ){
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
								'time_from' => $pdata['thurHoursFromAvail'],
								'time_to' => $pdata['thurHoursToAvail']
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

				$this->business_model->update($bid,$data_availability);	

			}elseif( $action == 'credentials' ){
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

				$license_image_name = '';
				if(isset($_FILES['license_image']) && $_FILES['license_image']['tmp_name'] != '') {
					$tmp_name = $_FILES['license_image']['tmp_name'];
					$extension = strtolower(end(explode('.',$_FILES['license_image']['name'])));
					$license_image_name = "license_" . basename($_FILES["license_image"]["name"]);
					move_uploaded_file($tmp_name, "./uploads/users/business_profile/$bid/$license_image_name");
				}

				$bond_image_name = '';
				if(isset($_FILES['bond_image']) && $_FILES['bond_image']['tmp_name'] != '') {
					$tmp_name = $_FILES['bond_image']['tmp_name'];
					$extension = strtolower(end(explode('.',$_FILES['bond_image']['name'])));
					$bond_image_name = "bond_" . basename($_FILES["bond_image"]["name"]);
					move_uploaded_file($tmp_name, "./uploads/users/business_profile/$bid/$bond_image_name");
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
					'bond_image' => $bond_image_name
				];

				$this->business_model->update($bid,$data_availability);	
				redirect('onboarding/about');
				
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
}

/* End of file Onboarding.php */
/* Location: ./application/controllers/Onboarding.php */
