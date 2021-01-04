<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Users extends MY_Controller {



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
        $this->load->model('ServiceCategory_model');
        

	}

	public function businessprofile()
	{	
		$user = (object)$this->session->userdata('logged');		
		$profiledata = $this->business_model->getByWhere(array('id'=>$user->id));
		$this->page_data['profiledata'] = $profiledata[0];
		$this->load->view('business_profile/businessprofile', $this->page_data);
	}
	
	public function businessview()
	{	
		//ifPermissions('businessdetail');
		$user = (object)$this->session->userdata('logged');		
		$cid=logged('id');
		$profiledata = $this->business_model->getByUserId($cid);	
		$schedules   = unserialize($profiledata->working_days);
		
		$this->page_data['profiledata'] = $profiledata;
		$this->load->view('business_profile/business', $this->page_data);

	}
	public function businessdetail(){	
		//ifPermissions('businessdetail');
		
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByWhere(array('user_id'=>$cid));	
		//dd($profiledata);die;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : null;
		
		/* echo "<pre>"; print_r($this->page_data); die;  */
		
		$this->load->view('business_profile/businessdetail', $this->page_data);
	}

	public function services()
	{	
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
		$cid=logged('id');
		$this->load->view('business_profile/services', $this->page_data);

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

        		$this->session->set_flashdata('message', 'Type was successfully updated');
        		$this->session->set_flashdata('alert_class', 'alert-success');
	        }else{
	        	$this->session->set_flashdata('message', 'Please select a services');
	        	$this->session->set_flashdata('alert_class', 'alert-danger');
	        }

	        redirect('users/services');

        }else{
        	$this->session->set_flashdata('message', 'Cannot find data');
	        $this->session->set_flashdata('alert_class', 'alert-danger');

	        redirect('users/services');
        }
	}

	public function credentials(){	
		//ifPermissions('businessdetail');
		
		$user = (object)$this->session->userdata('logged');
		$cid  = logged('id');
		$profiledata = $this->business_model->getByUserId($cid);	
		$states = statesList();

		$this->page_data['states'] = $states;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = $profiledata;
		
		$this->load->view('business_profile/credentials', $this->page_data);
	}

	public function availability()
	{	
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
		$this->load->view('business_profile/availability', $this->page_data);

	}

	public function portfolio()
	{	
		//ifPermissions('businessdetail');
		$user = (object)$this->session->userdata('logged');		
		//print_r($user);die;
		$cid=logged('id');
		$this->load->view('business_profile/work_pictures', $this->page_data);

	}

	public function profilesetting()
	{	
		//ifPermissions('businessdetail');
		$user = (object)$this->session->userdata('logged');		
		//print_r($user);die;
		$cid=logged('id');
		$this->load->view('business_profile/profile_settings', $this->page_data);

	}

	public function socialMedia(){	
		//ifPermissions('businessdetail');
		
		$user = (object)$this->session->userdata('logged');
		$cid=logged('id');
		$profiledata = $this->business_model->getByWhere(array('id'=>$cid));	
		//dd($profiledata);die;
		$this->page_data['userid'] = $user->id;
		$this->page_data['profiledata'] = ($profiledata) ? $profiledata[0] : '';
		
		/* echo "<pre>"; print_r($this->page_data); die;  */
		
		$this->load->view('business_profile/social_media', $this->page_data);
	}

	public function saveBusinessNameImage() {
		$pdata=$_POST;
		$bid=$pdata['id'];
		
		if (!empty($_FILES['image']['name'])){

			$comp_id = logged('company_id');
			$target_dir = "./uploads/users/business_profile/$bid/";
			
			if(!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
			}
	
			$business_image = $this->moveUploadedFile($bid);

			$this->business_model->update($bid, ['business_image' => $business_image]);

		}else{
			copy(FCPATH.'uploads/users/default.png', 'uploads/users/business_profile/'.$user->id.'/default.png');
		}

		$this->business_model->update($bid, ['business_name' => $pdata['business_name'], 'business_desc' => $pdata['business_desc']]);

		redirect('users/businessview');
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
	
	public function savebusinessdetail() {
		
		$user  = (object)$this->session->userdata('logged');	
		$pdata = $this->input->post();
		$action = $pdata['btn-continue'];
		unset($pdata['btn-continue']);
		$bid = $pdata['id'];

		if($bid!=''){
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
				
			}else{
				$this->business_model->update($bid,$pdata);	
			}
			
			$imbid=$pdata['user_id'];
		}else{
			$pdata['user_id'] = $user->id;
			$imbid=$user->id;
			$bid = $this->business_model->create($pdata);
		}

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

		// $this->activity_model->add('New User $'.$id.' Created by User:'.logged('name'), logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'Business detail updated Successfully');	

		redirect('users/businessview');
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
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();

		$date_this_week = array(
            "Monday" => date("Y-m-d",strtotime('monday this week')),
            "Tuesday" => date("Y-m-d",strtotime('tuesday this week')),
            "Wednesday" => date("Y-m-d",strtotime('wednesday this week')),
            "Thursday" => date("Y-m-d",strtotime('thursday this week')),
            "Friday" => date("Y-m-d",strtotime('friday this week')),
            "Saturday" => date("Y-m-d",strtotime('saturday this week')),
            "Sunday" => date("Y-m-d",strtotime('sunday this week')),
        );
        $this->page_data['date_this_week'] = $date_this_week;
		
		$this->load->view('users/timesheet-employee', $this->page_data);
	}

	// added for tracking Timesheet of employees: Schedule View
	public function schedule()
	{	
		$this->load->model('timesheet_model');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		
		$this->load->view('users/timesheet-schedule', $this->page_data);
	}

	// added for tracking Timesheet of employees: List View
	public function list()
	{	
		$this->load->model('timesheet_model');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		
		$this->load->view('users/timesheet-list', $this->page_data);
	}

	// added for tracking Time Log of employees
	public function timelog()
	{	
		$this->load->model('timesheet_model');
		//ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        $this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
		

		$this->load->view('users/timelog', $this->page_data);
	}

	public function showTimeLogTable(){
	    $date = $this->input->get('date');
	    $users =  $this->users_model->getUsers();
	    $user_roles = $this->users_model->getRoles();
	    $ts_logs = $this->timesheet_model->getTimesheetLogs();
	    $attendance = $this->timesheet_model->getAttendanceByDay(date('Y-m-d',strtotime($date)));

	    $display = '';
        $emp_role = null;
        $clock_in = null;
        $clock_out = null;
        $shift_duration = null;
        $entry_type = null;
        foreach ($users as $user):
			$name = $user->FName." ".$user->LName;
			$id = strval($user->id);
            foreach ($user_roles as $role){
                if ($user->role == $role->id){
                    $emp_role = $role->title;
                }
            }
            foreach ($attendance as $attn){
                if ($attn->user_id == $user->id){
                    foreach ($ts_logs as $log){
                        if ($attn->id == $log->attendance_id){
                            $entry_type = $log->entry_type;
                            if ($log->action == 'Check in'){
                                $clock_in = date('h:i A',strtotime($log->date_created));
                            }
                            if ($log->action == 'Check out'){
                                $clock_out = date('h:i A',strtotime($log->date_created));
                            }
                        }
                    }
                    $difference = $attn->shift_duration;
                    $seconds = ($difference * 3600);
                    $hours = floor($difference);
                    $seconds -= $hours * 3600;
                    $minutes = floor($seconds / 60);
                    $shift_duration = $this->lz($hours).":".$this->lz($minutes);
                }
			}
	    $display .= '<tr>';
	    $display .= '<td class="center">'.$clock_in.'</td>';
	    $display .= '<td class="center">'.$clock_out.'</td>';
	    $display .= '<td class="center">'.$shift_duration.'</td>';
	    $display .= '<td>';
	    $display .= '<div class="employee-section emp-photo">';
	    $display .= '<img src="'.userProfileImage($user->id).'" alt="" class="employee-profile">';
	    $display .= '</div>';
	    $display .= '<div class="employee-section emp-details">';
	    $display .= '<span class="employee-name">'.$name.'</span><span class="employee-role">'.$emp_role.'</span>';
	    $display .= '</div>';
	    $display .= '</td>';
	    $display .= '<td class="center">'.$entry_type.'</td>';
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
    public function lz($num){
        return (strlen($num) < 2) ? "0{$num}" : $num;
    }

	// function to calculate total logged time of user: daily
	public function total_logged_day(){
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
		);
		$total_clockin = $this->timesheet_model->getTotalClockinDay($data);
	}

	// function to calculate total logged time of user: weekly
	public function total_logged_week(){
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
		);
		$total_clockin = $this->timesheet_model->getTotalClockinWeek($data);
	}

	// function to calculate total logged time of user: monthly
	public function total_logged_month(){
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

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
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
//		ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
			
		
		$this->load->view('users/tracklocation', $this->page_data);

	}
	
	public function index()

	{	

		//ifPermissions('users_list');
		$this->load->helper(array('form', 'url', 'hashids_helper'));

		$cid = logged('company_id');

		$eid = hashids_encrypt($cid, '', 15);

		$this->page_data['eid'] = $eid;

		$this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
		
		$role_id = logged('role');
		if( $role_id == 1 || $role_id == 2 ){
			$this->page_data['users'] = $this->users_model->getAllUsers();
		}else{
			$this->page_data['users'] = $this->users_model->getCompanyUsers($cid);
		}
		

		// echo '<pre>';print_r($this->page_data);die;

		$this->load->view('users/list', $this->page_data);

	}



	public function add()

	{

		//ifPermissions('users_add');

		$this->load->view('users/add', $this->page_data);

	}
	
	public function getRoles(){
	    $role_title = $this->input->get('search');
        $roles = $this->users_model->getRolesBySearch($role_title);
        $data = array();
        foreach ($roles as $role){
            $data[] = array(
                'id' => $role->id,
                'text' => $role->title,
                'selected' => true
            );
        }
        echo json_encode($data);

    }
    public function checkEmailExist(){
	    $email = $this->input->get('email');
	    $check = $this->db->get_where('users',array('email' => $email))->num_rows();

	    echo json_encode($check);
    }
    public function checkUsername(){
	    $username = $this->input->get('username');
	    $check = $this->db->get_where('users',array('username' => $username))->num_rows();
	    echo json_encode($check);
    }
    public function addNewEmployee(){
    	$this->load->model('IndustryType_model');

        $fname = $this->input->post('values[firstname]');
        $lname = $this->input->post('values[lastname]');
        $email = $this->input->post('values[email]');
        $username = $this->input->post('values[username]');
        $password = $this->input->post('values[password]');
        $address = $this->input->post('values[address]');
        $role = $this->input->post('values[role]');
        $status = $this->input->post('values[status]');
        $web_access = $this->input->post('values[web_access]');
        $app_access = $this->input->post('values[app_access]');
        $profile_img = $this->input->post('values[profile_photo]');
        $cid=logged('company_id');
        $add = array(
            'FName' => $fname,
            'LName' => $lname,
            'username' => $username,
            'email' => $email,
            'password' => hash("sha256",$password),
            'password_plain' => $password,
            'role' => $role,
            'status' => $status,
            'company_id' => $cid,
            'profile_img' => $profile_img,
            'address' => $address
        );
        $query = $this->users_model->addNewEmployee($add);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
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
    public function ajaxEditEmployee(){
	    $user_id = $this->input->post('user_id');
	    $get_user = $this->Users_model->getUser($user_id);
	    $get_role = $this->db->get_where('roles',array('id' => $get_user->role));

        $roles = $this->users_model->getRoles();

        $this->page_data['roles'] = $roles;
	    $this->page_data['user'] = $get_user;
	    $this->page_data['role'] = $get_role;
	    $this->load->view('users/modal_edit_form', $this->page_data);

	    echo $data;

    }

    private $user_path = './uploads/users/user-profile/';
    public function profilePhoto(){
        if (! empty($_FILES)){
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
                $query = $this->users_model->addProfilePhoto($data);
                $return = new stdClass();
                $return->photo = $uploadData['file_name'];
                $return->id = $query;
                echo json_encode($return);
            }
        }else{
            echo json_encode('error');
        }
    }

    public function removeProfilePhoto(){
        $file = $this->input->post('name');
        $index = $this->input->post('index');
        if ($file && file_exists($this->user_path. $file[$index])){
            unlink( $this->user_path. $file[$index]);
            $this->db->where('profile_image',$file[$index]);
            $this->db->delete('user_profile_photo');
            echo json_encode(1);
        }
    }
    public function removeTemporaryImg(){
        $file = $this->input->post('image');
        $image_id = $this->input->post('image_id');
        if ($file && file_exists($this->user_path. $file)){
            unlink( $this->user_path. $file);
            $this->db->where('id',$image_id);
            $this->db->delete('user_profile_photo');
            echo json_encode(1);
        }
    }

	public function save(){
		ifPermissions('users_add');
		postAllowed();
		$user = (object)$this->session->userdata('logged');	
		$cid=logged('company_id');		
		$id = $this->users_model->create([
			'role' => post('role'),
			'FName' => post('FName'),
			'LName' => post('LName'),
			'username' => post('username'),
			'email' => post('email'),
			
			'company_id' => $cid,
			
			'status' => (int) post('status'),
			'password_plain' =>  post('password'),
			'password' => hash( "sha256", post('password') ),			
			//'parent_id' => $user->id
		]);



		if (!empty($_FILES['image']['name'])) {

			$path = $_FILES['image']['name'];
			$ext  = pathinfo($path, PATHINFO_EXTENSION);
			$this->uploadlib->initialize([
				'file_name' => 'p_' . $id.'.'.$ext
			]);

			$image = $this->uploadlib->uploadImage('image', '/users/user-profile');

			if($image['status']){
				$this->users_model->update($id, ['profile_img' => 'p_' . $id, 'img_type' => $ext]);
			}else{
				copy(FCPATH.'uploads/users/default.png', 'uploads/users/user-profile/p_'.$id.'.'.$ext);
			}
		}else{
			copy(FCPATH.'uploads/users/default.png', 'uploads/users/user-profile/p_'.$id.'.'.$ext);
		}



		$this->activity_model->add('New User $'.$id.' Created by User:'.logged('FName'), logged('id'));
		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New User Created Successfully');	

		redirect('users');
	}



	public function view($id)

	{



		ifPermissions('users_view');



		$this->page_data['User'] = $this->users_model->getById($id);

		$this->page_data['User']->role = $this->roles_model->getByWhere([

			'id'=> $this->page_data['User']->role

		])[0];

		$this->page_data['User']->activity = $this->activity_model->getByWhere([

			'user'=> $id

		], [ 'order' => ['id', 'desc'] ]);

		$this->load->view('users/view', $this->page_data);



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
		$cid=logged('company_id');
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
		if(logged('id')!=$id)
			$data['status'] = post('status')==1;
		if(!empty($password)){
			$data['password_plain'] = $password;
			$data['password'] = hash( "sha256", $password );
		}

		$id = $this->users_model->update($id, $data);

		if (!empty($_FILES['image']['name'])) {

			$path = $_FILES['image']['name'];

			$ext = pathinfo($path, PATHINFO_EXTENSION);

			$this->uploadlib->initialize([

				'file_name' => 'p_' .$id.'.'.$ext

			]);
			$profile_image = 'p_' . $id;

			$image = $this->uploadlib->uploadImage('image', '/users/user-profile');



			if($image['status']){

				$this->users_model->update($id, ['profile_img' => $profile_image , 'img_type' => $ext]);

			}



		}



		$this->activity_model->add("User #$id Updated by User:".logged('FName'));



		$this->session->set_flashdata('alert-type', 'success');

		$this->session->set_flashdata('alert', 'Client Profile has been Updated Successfully');

		

		redirect('users');



	}



	public function check()

	{

		$email = !empty(get('email')) ? get('email') : false;

		$username = !empty(get('username')) ? get('username') : false;

		$notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;



		if($email)

			$exists = count($this->users_model->getByWhere([

					'email' => $email,

					'id !=' => $notId,

				])) > 0 ? true : false;



		if($username)

			$exists = count($this->users_model->getByWhere([

					'username' => $username,

					'id !=' => $notId,

				])) > 0 ? true : false;



		echo $exists ? 'false' : 'true';

	}



	public function delete($id)

	{



		ifPermissions('users_delete');



		if($id!==1 && $id!=logged($id)){ }else{

			redirect('/','refresh');

			return;

		}



		$id = $this->users_model->delete($id);



		$this->activity_model->add("User #$id Deleted by User:".logged('name'));



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
			/*'user_id' => $this->input->post('clockin_user_id'),
			'company_id' => $this->input->post('clockin_company_id'),
			'clock_in' => $this->input->post('current_time_in'),
			'session_key' => $this->input->post('clockin_sess'),
			'status' => $this->input->post('clockin_status')*/
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

	public function update_clockin($id){
		$this->load->model('timesheet_model');

		//$this->timesheet_model->updateClockin($id, ['clockin' => get('clockIn') == 'true' ? 1 : 0 ]);

		//echo 'done';

	}


	public function getClockIn(){
		$this->load->model('timesheet_model');
		$data = array(
			'user_id' => $this->input->post('clockin_user_id'),
			'session_key' => $this->input->post('clockin_sess'),
		);

		$this->timesheet_model->checkClockIn($data);
	}

	public function change_status($id)

	{

		$this->users_model->update($id, ['status' => get('status') == 'true' ? 1 : 0 ]);

		echo 'done';

	}


	public function ajax_user_dropdown() {

		$users = $this->users_model->getUsers();
		// print_r($users);

		echo $this->load->view('users/ajax_user_dropdown', array('users' => $users), true);
	}


	public function json_dropdown_user_list() {

		$users = $this->users_model->getUsers();
		// print_r($users);

		die(json_encode($users));
	}

	public function ajaxUpdateEmployee(){

    	$user_id = $this->input->post('values[user_id]');
        $fname = $this->input->post('values[firstname]');
        $lname = $this->input->post('values[lastname]');
        $email = $this->input->post('values[email]');
        $username = $this->input->post('values[username]');
        $password = $this->input->post('values[password]');
        $address = $this->input->post('values[address]');
        $role = $this->input->post('values[role]');
        $status = $this->input->post('values[status]');
        $web_access = $this->input->post('values[web_access]');
        $app_access = $this->input->post('values[app_access]');
        $profile_img = $this->input->post('values[profile_photo]');

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
            'address' => $address
        );

        $user = $this->Users_model->update($user_id,$data);

        echo json_encode(1);
    }

    public function ajaxUpdateEmployeePassword(){
    	$is_success = false;
    	$msg = "";

    	$new_password = $this->input->post('values[new_password]');
    	$re_password  = $this->input->post('values[re_password]');
    	$user_id = $this->input->post('values[change_password_user_id]');

    	if( $new_password != $re_password ){
    		$msg = "Password not same";
    	}else{
    		$data = array(
	            'password' => hash("sha256",$new_password),
	            'password_plain' => $new_password,
	        );

	        $user = $this->Users_model->update($user_id,$data);

	        $is_success = true;
    	}

    	$json_data = [
    		'is_success' => $is_success,
    		'msg' => $msg
    	];

    	echo json_encode($json_data);
    }
}



/* End of file Users.php */

/* Location: ./application/controllers/Users.php */