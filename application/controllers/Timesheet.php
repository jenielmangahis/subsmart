<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Timesheet extends MY_Controller {



	public function __construct()


	{

		parent::__construct();
		$this->checkLogin();
		add_css(array(
            "assets/css/timesheet.css",
        ));

		$this->page_data['page']->title = 'Timesheet Management';

		$this->page_data['page']->menu = 'users';

        add_css(array(
            "assets/plugins/dropzone/dist/dropzone.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.js",
            "assets/js/accounting/sweetalert2@9.js",
        ));

	}

	// added for tracking Timesheet of employees: Single Employee View
	public function timesheet_user()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		
		$this->load->view('users/timesheet-user', $this->page_data);
	}

	// added for tracking Timesheet of employees: Attendance View / Admin View
	public function timesheet()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();

		// get total numbers of "In" employees
		$this->page_data['total_in'] = $this->timesheet_model->getTotalInEmployees();
		// get total numbers of "Out" employees
		$this->page_data['total_out'] = $this->timesheet_model->getTotalOutEmployees();
		// get total numbers of "Not Logged In Today" employees
		$this->page_data['total_not_logged_in_today'] = $this->timesheet_model->getTotalNotLoggedInTodayEmployees();
		// get total numbers of "Not Logged In Today" employees
		$this->page_data['total_employees'] = $this->timesheet_model->getTotalEmployees();
		
		$this->load->view('users/timesheet-admin', $this->page_data);
	}

	// added for tracking Timesheet of employees: Schedule View
	public function employee()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
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
		$this->load->model('users_model');
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
		
		$this->load->view('users/timesheet-schedule', $this->page_data);
	}

	// added for tracking Timesheet of employees: List View
	public function list()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
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
		
		$this->load->view('users/timesheet-list', $this->page_data);
	}

	// added for tracking Timesheet of employees: List View
	public function settings()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
        $this->page_data['timesheet_settings'] = $this->timesheet_model->getTimeSheetSettings();
        $this->page_data['timesheet_day'] = $this->timesheet_model->getTimeSheetDay();
		$date_this_week = array(
            "Monday" => date("M d",strtotime('monday this week')),
            "Tuesday" => date("M d",strtotime('tuesday this week')),
            "Wednesday" => date("M d",strtotime('wednesday this week')),
            "Thursday" => date("M d",strtotime('thursday this week')),
            "Friday" => date("M d",strtotime('friday this week')),
            "Saturday" => date("M d",strtotime('saturday this week')),
            "Sunday" => date("M d",strtotime('sunday this week')),
        );
        $this->page_data['date_this_week'] = $date_this_week;
		
		$this->load->view('users/timesheet-settings', $this->page_data);
	}

	// added for tracking Time Log of employees
	public function timelog()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
		//ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
		
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		
		//$this->load->view('users/timesheet', $this->page_data);
		//$this->load->view('users/timesheet-admin', $this->page_data);
		$this->load->view('users/timelog', $this->page_data);
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

	

	public function add_timesheet_entry()
	{
		//ifPermissions('users_add');
		$this->load->view('users/add_timesheet_entry', $this->page_data);
	}

	public function tracklocation()
	{	
		ifPermissions('users_list');

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
			
		
		$this->load->view('users/tracklocation', $this->page_data);

	}
	
	public function index()

	{	
		$this->load->model('users_model');
		//ifPermissions('users_list');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();

		// echo '<pre>';print_r($this->page_data);die;

		$this->load->view('users/timesheet-admin', $this->page_data);
	}



	public function add()

	{

		//ifPermissions('users_add');

		$this->load->view('users/add', $this->page_data);

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
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$this->uploadlib->initialize([
				'file_name' => $id.'.'.$ext
			]);

			$image = $this->uploadlib->uploadImage('image', '/users');

			if($image['status']){
				$this->users_model->update($id, ['profile_img' => $ext]);
			}else{
				copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');
			}
		}else{
			copy(FCPATH.'uploads/users/default.png', 'uploads/users/'.$id.'.png');
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



		ifPermissions('users_edit');



		$this->page_data['User'] = $this->users_model->getById($id);

		$this->load->view('users/edit', $this->page_data);



	}





	public function update($id)

	{



		ifPermissions('users_edit');

		

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

				'file_name' => $id.'.'.$ext

			]);

			$image = $this->uploadlib->uploadImage('image', '/users');



			if($image['status']){

				$this->users_model->update($id, ['img_type' => $ext]);

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
		date_default_timezone_set('US/Central');
		$this->load->model('timesheet_model');
		/*print_r($this->input->post('clock_in_from'));
		echo "<br />";
		print_r($this->input->post('clock_in_to'));
		$t1 = str_replace(':', ',', $this->input->post('clock_in_from'));
		$t2 = str_replace(':', ',', $this->input->post('clock_in_to'));
		echo $t1; echo $t2;
		die;*/
		/*$data = $this->input->post();
		$date = $this->input->post('entry_date');
		$time = $this->input->post('clock_in_from');
		$clockin_datetime = */
		$d1 = str_replace('/', ',', $this->input->post('entry_date'));
		$t1 = str_replace(':', ',', $this->input->post('clock_in_from'));
		$date1 = $t1.',0,'.$d1;
		$fulldate1 = explode(',',$date1);
		$h1 = $fulldate1[0];
		$i1 = $fulldate1[1];
		$s1 = $fulldate1[2];
		$m1 = $fulldate1[3];
		$d1 = $fulldate1[4];
		$y1 = $fulldate1[5];
		$clockin_datetime = date("Y-m-d h:i:s",mktime($h1,$i1,$s1,$m1,$d1,$y1));
		$d2 = str_replace('/', ',', $this->input->post('entry_date'));
		$t2 = str_replace(':', ',', $this->input->post('clock_in_to'));
		$date2 = $t2.',0,'.$d2;
		$fulldate2 = explode(',',$date2);
		$h2 = $fulldate2[0];
		$i2 = $fulldate2[1];
		$s2 = $fulldate2[2];
		$m2 = $fulldate2[3];
		$d2 = $fulldate2[4];
		$y2 = $fulldate2[5];
		$clockout_datetime = date("Y-m-d h:i:s",mktime($h2,$i2,$s2,$m2,$d2,$y2));
		//dd($clockin_datetime);echo "<br />";
		//dd($clockout_datetime);
		//die;

		// for Clock In
		$data_clockin = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'entry_type' => 'Manual Entry',
			//'timestamp' => $this->input->post('entry_date'),
			'timestamp' => $clockin_datetime,
			'job_code' => $this->input->post('job_code'),
			'notes' => $this->input->post('notes')
		);
		//dd($data);die;
		$this->timesheet_model->manualClockIn($data_clockin);

		// for Clock In
		$data_clockout = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock Out',
			'entry_type' => 'Manual Entry',
			//'timestamp' => $this->input->post('entry_date'),
			'timestamp' => $clockout_datetime,
			'job_code' => $this->input->post('job_code'),
			'notes' => $this->input->post('notes')
		);
		//dd($data);die;
		$this->timesheet_model->manualClockIn($data_clockout);

		/*$this->load->model('timesheet_model');
		$data = array(
			'employees_id' => $this->input->post('clockin_user_id'),
			'action' => 'Clock In',
			'timestamp' => $this->input->post('current_time_in'),
			'entry_type' => 'Manual'
		);

		$this->timesheet_model->checkClockIn($data);*/

		$this->session->set_flashdata('alert-type', 'success');
		$this->session->set_flashdata('alert', 'New Time Log Added Successfully');	

		redirect('users/timelog');

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

	public function addingProjects(){
        $project = $this->input->post('project');
        $query = $this->timesheet_model->addingProjects($project);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function updateDuration(){
	    $day_id = $this->input->post('day_id');
	    $project_id = $this->input->post('project_id');
	    $duration = $this->input->post('duration');
	    $day = $this->input->post('day');
	    $date = $this->input->post('date');
	    $data = array(
	        'day_id' => $day_id,
	        'project_id' => $project_id,
            'duration' => $duration,
            'day' => $day,
            'date' => $date
        );
	    $query = $this->timesheet_model->updateDuration($data);
	    if ($query == true){
	        echo json_encode(1);
        }else{
	        echo json_encode(0);
        }
    }

    public function updateTotalWeekDuration(){
	    $project_id = $this->input->post('id');
	    $total = $this->input->post('total');
	    $update = array(
	      'project_id' => $project_id,
          'total' => $total
        );
	    $query = $this->timesheet_model->updateTotalWeekDuration($update);
	    if ($query == true){
	        echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function addingTotalInDay(){
	    $id = $this->input->post('id');
	    $day = $this->input->post('day');
        $date = $this->input->post('day_date');
        $total = $this->input->post('total');
        $update = array('date'=>$date,'total_duration'=>$total,'day'=>$day);
        $this->timesheet_model->addingTotalInDay($update,$id);
    }

    public function updateTotalDuration(){
	    $week = $this->input->post('week');
	    $date = $this->input->post('date');
	    $total = $this->input->post('total');
	    $update = array('date'=>$date,'total_duration'=>$total);
	    $this->timesheet_model->updateTotalDuration($update,$week);
    }

    public function updateProjectName(){
	    $id = $this->input->post('id');
	    $name = $this->input->post('name');
	    $query = $this->timesheet_model->updateProjectName($id,$name);
	    if ($query == true){
	        echo json_encode($name);
        }else{
            echo json_encode(0);
        }
    }

    public function deleteProjectData(){
	    $id = $this->input->post('id');
	    //Deleting in timesheet_settings table
	    $this->db->where('id',$id);
	    $this->db->delete('timesheet_settings');
	    //Deleting in ts_settings_day table
        $this->db->where('ts_settings_id',$id);
        $this->db->delete('ts_settings_day');
    }

    public function showTimesheetSettings(){
	    $week = $this->input->get('week');
        $timesheet_id = null;
        $monday = null;
        $tuesday = null;
        $wednesday = null;
        $thursday = null;
        $friday = null;
        $saturday = null;
        $sunday = null;
        $day_id_mon = null;
        $day_id_tue = null;
        $day_id_wed = null;
        $day_id_thu = null;
        $day_id_fri = null;
        $day_id_sat = null;
        $day_id_sun = null;
        $timesheet_duration_w = "00:00";
        $date_this_week = array(
            "Monday" => date("M d",strtotime('monday '.$week)),
            "Tuesday" => date("M d",strtotime('tuesday '.$week)),
            "Wednesday" => date("M d",strtotime('wednesday '.$week)),
            "Thursday" => date("M d",strtotime('thursday '.$week)),
            "Friday" => date("M d",strtotime('friday '.$week)),
            "Saturday" => date("M d",strtotime('saturday '.$week)),
            "Sunday" => date("M d",strtotime('sunday '.$week)),
        );
        $date_week_check = array(
            0 => date("Y-m-d",strtotime('monday '.$week)),
            1 => date("Y-m-d",strtotime('tuesday '.$week)),
            2 => date("Y-m-d",strtotime('wednesday '.$week)),
            3 => date("Y-m-d",strtotime('thursday '.$week)),
            4 => date("Y-m-d",strtotime('friday '.$week)),
            5 => date("Y-m-d",strtotime('saturday '.$week)),
            6 => date("Y-m-d",strtotime('sunday '.$week)),
        );
        $timesheet_settings = $this->timesheet_model->getTimeSheetDayByWeek($date_week_check);

	    $display = '';
	    $display .= '<thead>';
            $display .= '<tr>';
                $display .= '<th>Projects</th>';
                $display .= '<th>Mon<br>'.$date_this_week['Monday'].'</th>';
                $display .= '<th>Tue<br>'.$date_this_week['Tuesday'].'</th>';
                $display .= '<th>Wed<br>'.$date_this_week['Wednesday'].'</th>';
                $display .= '<th>Thu<br>'.$date_this_week['Thursday'].'</th>';
                $display .= '<th>Fri<br>'.$date_this_week['Friday'].'</th>';
                $display .= '<th>Sat<br>'.$date_this_week['Saturday'].'</th>';
                $display .= '<th>Sun<br>'.$date_this_week['Sunday'].'</th>';
                $display .= '<th>Total</th>';
                $display .= '<th></th>';
            $display .= '</tr>';
	    $display .= '</thead>';
	    $display .= '<tbody id="tsSettingsTblTbody">';
	    foreach ($timesheet_settings as $setting):
            $timesheet_id = $setting->id;
            $timesheet_duration_w = (!empty($setting->total_duration_w))?$setting->total_duration_w:"00:00";
            $timesheet_day = $this->timesheet_model->getTimeSheetDayById($timesheet_id);
            foreach ($timesheet_day as $days){
                    if ($days->day == "Monday"){
                        $day_id_mon = $days->id;
                        $monday = $days->duration;
                    }elseif ($days->day == "Tuesday"){
                        $day_id_tue = $days->id;
                        $tuesday = $days->duration;
                    }elseif ($days->day == "Wednesday"){
                        $day_id_wed = $days->id;
                        $wednesday = $days->duration;
                    }elseif ($days->day == "Thursday"){
                        $day_id_thu = $days->id;
                        $thursday = $days->duration;
                    }elseif ($days->day == "Friday"){
                        $day_id_fri = $days->id;
                        $friday = $days->duration;
                    }elseif ($days->day == "Saturday"){
                        $day_id_sat = $days->id;
                        $saturday = $days->duration;
                    }elseif ($days->day == "Sunday"){
                        $day_id_sun = $days->id;
                        $sunday = $days->duration;
                    }
            }
            $display .= '<tr data-id="'.$timesheet_id.'" id="tsSettingsRow">';
                $display .= '<td><i class="fa fa-circle ts-status"></i><span class="ts-project-name" id="showEditPen">'.ucfirst($setting->projects).'</span><a href="#" id="editProjectName" data-id="'.$setting->id.'" data-name="'.ucfirst($setting->projects).'"><i class="fa fa-pencil-alt"></i></a></td>';
                $display .= '<td><input type="text" name="monday" id="tsMonday" data-date="'.$date_week_check[0].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_mon.'" value="'.$monday.'" placeholder="HH:MM"></td>';
                $display .= '<td><input type="text" name="tuesday" id="tsTuesday" data-date="'.$date_week_check[1].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_tue.'" value="'.$tuesday.'" placeholder="HH:MM"></td>';
                $display .= '<td><input type="text" name="wednesday" id="tsWednesday" data-date="'.$date_week_check[2].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_wed.'" value="'.$wednesday.'" placeholder="HH:MM"></td>';
                $display .= '<td><input type="text" name="thursday" id="tsThursday" data-date="'.$date_week_check[3].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_thu.'" value="'.$thursday.'" placeholder="HH:MM"></td>';
                $display .= '<td><input type="text" name="friday" id="tsFriday" data-date="'.$date_week_check[4].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_fri.'" value="'.$friday.'" placeholder="HH:MM"></td>';
                $display .= '<td><input type="text" name="saturday" id="tsSaturday" data-date="'.$date_week_check[5].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_sat.'" value="'.$saturday.'" placeholder="HH:MM"></td>';
                $display .= '<td><input type="text" name="sunday" id="tsSunday" data-date="'.$date_week_check[6].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_sun.'" value="'.$sunday.'" placeholder="HH:MM"></td>';
                $display .= '<td><span class="totalWeek" id="totalWeekDuration'.$timesheet_id.'">'.$timesheet_duration_w.'</span></td>';
                $display .= '<td><a href="#" id="removeProject" data-id="'.$setting->id.'" data-name="'.ucfirst($setting->projects).'"><i class="fa fa-times fa-lg"></i></a></td>';
            $display .= '</tr>';
            $timesheet_id = null;
            $timesheet_duration_w = "00:00";
            $monday = null;
            $tuesday = null;
            $wednesday = null;
            $thursday = null;
            $friday = null;
            $saturday = null;
            $sunday = null;
            $day_id_mon = null;
            $day_id_tue = null;
            $day_id_wed = null;
            $day_id_thu = null;
            $day_id_fri = null;
            $day_id_sat = null;
        endforeach;
        $day_id_sun = null;
            if ($week != 'last week'):
            $display .= '<tr>';
                $display .= '<td><a href="#" id="addProject" style="color: #0b97c4;font-weight: bold"><i class="fa fa-plus"></i>&nbsp;Project</a></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><span style="color: #92969d;">00:00</span></td>';
                $display .= '<td><a href="#"><i class="fa fa-times fa-lg" disabled></i></a></td>';
            $display .= '</tr>';
            endif;
	    $display .= '</tbody>';
        $duration_mon = '00:00';
        $duration_tue = '00:00';
        $duration_wed = '00:00';
        $duration_thu = '00:00';
        $duration_fri = '00:00';
        $duration_sat = '00:00';
        $duration_sun = '00:00';
        $data_id_mon = null;
        $data_id_tue = null;
        $data_id_wed = null;
        $data_id_thu = null;
        $data_id_fri = null;
        $data_id_sat = null;
        $data_id_sun = null;
        $ts_total_duration_day = $this->timesheet_model->getTimeSheetTotalInDay($date_week_check);
	    foreach ($ts_total_duration_day as $total_duration){
	        if ($total_duration->day == 'monday'){
	            $duration_mon = $total_duration->total_duration;
                $data_id_mon = $total_duration->id;
            }elseif ($total_duration->day == 'tuesday'){
                $duration_tue = $total_duration->total_duration;
                $data_id_tue = $total_duration->id;
            }elseif ($total_duration->day == 'wednesday'){
                $duration_wed = $total_duration->total_duration;
                $data_id_wed = $total_duration->id;
            }elseif ($total_duration->day == 'thursday'){
                $duration_thu = $total_duration->total_duration;
                $data_id_thu = $total_duration->id;
            }elseif ($total_duration->day == 'friday'){
                $duration_fri = $total_duration->total_duration;
                $data_id_fri = $total_duration->id;
            }elseif ($total_duration->day == 'saturday'){
                $duration_sat = $total_duration->total_duration;
                $data_id_sat = $total_duration->id;
            }elseif ($total_duration->day == 'sunday'){
                $duration_sun = $total_duration->total_duration;
                $data_id_sun = $total_duration->id;
            }
        }
        $ts_total_duration_week = $this->timesheet_model->getTotalWeekDuration($date_week_check);
	    $total_week_duration = (!empty($ts_total_duration_week[0]->total_duration))?$ts_total_duration_week[0]->total_duration:"00:00";
	    $display .= '<tfoot>';
            $display .= '<tr>';
                $display .= '<th>Total</th>';
                $display .= '<th><span id="totalMonday" data-id="'.$data_id_mon.'">'.$duration_mon.'</span></th>';
                $display .= '<th><span id="totalTuesday" data-id="'.$data_id_tue.'">'.$duration_tue.'</span></th>';
                $display .= '<th><span id="totalWednesday" data-id="'.$data_id_wed.'">'.$duration_wed.'</span></th>';
                $display .= '<th><span id="totalThursday" data-id="'.$data_id_thu.'">'.$duration_thu.'</span></th>';
                $display .= '<th><span id="totalFriday" data-id="'.$data_id_fri.'">'.$duration_fri.'</span></th>';
                $display .= '<th><span id="totalSaturday" data-id="'.$data_id_sat.'">'.$duration_sat.'</span></th>';
                $display .= '<th><span id="totalSunday" data-id="'.$data_id_sun.'">'.$duration_sun.'</span></th>';
                $display .= '<th><span id="totalWeekDuration">'.$total_week_duration.'</span></th>';
                $display .= '<th></th>';
            $display .= '</tr>';
	    $display .= '</tfoot>';
	    echo json_encode($display);
    }
    public function getEmployees(){
	    $name = $this->input->get('search');
	    $users = $this->users_model->getUsersByName($name);
        $data = array();
        $data[] = array(
            'id' =>   'teammates',
            'text' => 'Teammates',
        );
	    foreach ($users as $employee){
	        $role = '';
	        if ($employee->role == 6){
                $role = 'IT';
            }elseif ($employee->role == 3){
                $role = 'Admin';
            }elseif ($employee->role == 1){
                $role = 'Owner';
            }
            $data[] = array(
                'id' =>   $employee->id,
                'text' => $employee->FName." ".$employee->LName,
                'subtext' => $role
            );
        }

        echo json_encode($data);


    }
}



/* End of file Users.php */

/* Location: ./application/controllers/Users.php */