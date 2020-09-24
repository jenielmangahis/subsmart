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
//            "https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.js",
//            "assets/js/accounting/sweetalert2@9.js",
//            "https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js",
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
        $this->page_data['user_roles'] = $this->users_model->getRoles();
//        $this->page_data['no_logged_in'] = $this->timesheet_model->getTotalUsersLoggedIn();
//        $this->page_data['in_now'] = $this->timesheet_model->getInNow();
//        $this->page_data['out_now'] = $this->timesheet_model->getOutNow();
        $this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
        $this->page_data['week_duration'] = $this->timesheet_model->getWeekTotalDuration();
		$date_this_week = array(
            "Monday" => date("M d,y",strtotime('monday this week')),
            "Tuesday" => date("M d,y",strtotime('tuesday this week')),
            "Wednesday" => date("M d,y",strtotime('wednesday this week')),
            "Thursday" => date("M d,y",strtotime('thursday this week')),
            "Friday" => date("M d,y",strtotime('friday this week')),
            "Saturday" => date("M d,y",strtotime('saturday this week')),
            "Sunday" => date("M d,y",strtotime('sunday this week')),
        );
        $this->page_data['date_this_week'] = $date_this_week;
		
		$this->load->view('users/timesheet-employee', $this->page_data);
	}


	public function schedule()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		$date_this_week = array(
            "Monday" => date("M d,y",strtotime('monday this week')),
            "Tuesday" => date("M d,y",strtotime('tuesday this week')),
            "Wednesday" => date("M d,y",strtotime('wednesday this week')),
            "Thursday" => date("M d,y",strtotime('thursday this week')),
            "Friday" => date("M d,y",strtotime('friday this week')),
            "Saturday" => date("M d,y",strtotime('saturday this week')),
            "Sunday" => date("M d,y",strtotime('sunday this week'))
        );
        $this->page_data['date_this_week'] = $date_this_week;
		
		$this->load->view('users/timesheet-schedule', $this->page_data);
	}

	public function list()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
        $this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        $this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
//        $this->page_data['in_now'] = $this->timesheet_model->getInNowData();
		$date_this_week = array(
            "Monday" => date("M d,y",strtotime('monday this week')),
            "Tuesday" => date("M d,y",strtotime('tuesday this week')),
            "Wednesday" => date("M d,y",strtotime('wednesday this week')),
            "Thursday" => date("M d,y",strtotime('thursday this week')),
            "Friday" => date("M d,y",strtotime('friday this week')),
            "Saturday" => date("M d,y",strtotime('saturday this week')),
            "Sunday" => date("M d,y",strtotime('sunday this week'))
        );
        $this->page_data['date_this_week'] = $date_this_week;
		
		$this->load->view('users/timesheet-list', $this->page_data);
	}

	public function settings()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
        $this->page_data['timesheet_settings'] = $this->timesheet_model->getTimeSheetSettings();
        $this->page_data['timesheet_day'] = $this->timesheet_model->getTimeSheetDay();
        $this->page_data['user_logged'] = $this->checkLogin();

		$date_this_week = array(
            "Monday" => date("M d",strtotime('monday this week')),
            "Tuesday" => date("M d",strtotime('tuesday this week')),
            "Wednesday" => date("M d",strtotime('wednesday this week')),
            "Thursday" => date("M d",strtotime('thursday this week')),
            "Friday" => date("M d",strtotime('friday this week')),
            "Saturday" => date("M d",strtotime('saturday this week')),
            "Sunday" => date("M d",strtotime('sunday this week'))
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

	public function showEmployeeTable(){
	    $week = $this->input->get('week');
	    $week_convert = date('Y-m-d',strtotime($week));
        $date_this_week = array(
            "Monday" => date("M d,y",strtotime('monday this week',strtotime($week_convert))),
            "Tuesday" => date("M d,y",strtotime('tuesday this week',strtotime($week_convert))),
            "Wednesday" => date("M d,y",strtotime('wednesday this week',strtotime($week_convert))),
            "Thursday" => date("M d,y",strtotime('thursday this week',strtotime($week_convert))),
            "Friday" => date("M d,y",strtotime('friday this week',strtotime($week_convert))),
            "Saturday" => date("M d,y",strtotime('saturday this week',strtotime($week_convert))),
            "Sunday" => date("M d,y",strtotime('sunday this week',strtotime($week_convert))),
        );
        $week_check = array(
            0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
            1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
            2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
            3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
            4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
            5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
            6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
        );
        $display = '';

        $users = $this->users_model->getUsers();
        $user_roles= $this->users_model->getRoles();
        $ts_logs = $this->timesheet_model->getTSByDate($week_check);
        $attendance = $this->timesheet_model->employeeAttendance();
        $week_duration = $this->timesheet_model->getWeekTotalDuration();

        $name = null;
        $role = null;
        $bg_color = '#f71111bf';
        $status = 'LOA';
        $mon_duration = null;
        $tue_duration = null;
        $wed_duration = null;
        $thu_duration = null;
        $fri_duration = null;
        $sat_duration = null;
        $sun_duration = null;
        $shift_duration = '0.00';

        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<th>Employee</th>';
        $display .= '<th><span class="tbl-status">Current</span><span class="tbl-status">Status</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Mon</span><span class="tbl-date">'.$date_this_week['Monday'].'</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Tue</span><span class="tbl-date">'.$date_this_week['Tuesday'].'</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Wed</span><span class="tbl-date">'.$date_this_week['Wednesday'].'</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Thu</span><span class="tbl-date">'.$date_this_week['Thursday'].'</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Fri</span><span class="tbl-date">'.$date_this_week['Friday'].'</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Sat</span><span class="tbl-date">'.$date_this_week['Saturday'].'</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Sun</span><span class="tbl-date">'.$date_this_week['Sunday'].'</span></th>';
        $display .= '<th>Total</th>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody>';

        foreach ($users as $user):
            $name = $user->FName." ".$user->LName;
            foreach ($user_roles as $roles){
                if ($roles->id == $user->role){
                    $role = $roles->title;
                }
            }
            foreach ($ts_logs as $log){
                    if ($log->action == 'Check in' && $log->user_id == $user->id){
                        $bg_color = 'greenyellow';
                        $status = 'In';
                    }elseif($log->action == 'Check out' && $log->user_id == $user->id){
                        $status = 'Out';
                        $bg_color = '#f71111bf';
                    }elseif ($log->action == 'Break in' && $log->user_id == $user->id){
                        $status = 'On Lunch';
                        $bg_color = '#ffc859';
                    }elseif ($log->action == 'Break out' && $log->user_id == $user->id) {
                        $status = 'In';
                        $bg_color = 'greenyellow';
                    }


            }
            foreach ($attendance as $attn){
                if ($attn->user_id == $user->id && $attn->shift_duration > 0){
                    switch ($attn->date_out){
                        case ($week_check[0]):
                            $mon_duration = $attn->shift_duration;
                            break;
                        case ($week_check[1]):
                            $tue_duration = $attn->shift_duration;
                            break;
                        case ($week_check[2]):
                            $wed_duration = $attn->shift_duration;
                            break;
                        case ($week_check[3]):
                            $thu_duration = $attn->shift_duration;
                            break;
                        case ($week_check[4]):
                            $fri_duration = $attn->shift_duration;
                            break;
                        case ($week_check[5]):
                            $sat_duration = $attn->shift_duration;
                            break;
                        case ($week_check[6]):
                            $sun_duration = $attn->shift_duration;
                            break;
                    }
                }
            }
            foreach ($week_duration as $week){
                if ($user->id == $week->user_id && $week->week_of == $week_check[0]){
                    $shift_duration = $week->total_shift;
                }
            }
        $display .= '<tr>';
        $display .= '<td><span class="tbl-emp-name">'.$name.'</span><span class="tbl-emp-role">'.$role.'</span></td>';
        $display .= '<td class="center" style="background-color:'.$bg_color.'"><span class="tbl-emp-status">'.$status.'</span></td>';
        $display .= '<td class="center">'.$mon_duration.'</td>';
        $display .= '<td class="center">'.$tue_duration.'</td>';
        $display .= '<td class="center">'.$wed_duration.'</td>';
        $display .= '<td class="center">'.$thu_duration.'</td>';
        $display .= '<td class="center">'.$fri_duration.'</td>';
        $display .= '<td class="center">'.$sat_duration.'</td>';
        $display .= '<td class="center">'.$sun_duration.'</td>';
        $display .= '<td class="center">'.$shift_duration.'</td>';
        $display .= '</tr>';
            $name = null;
            $role = null;
            $bg_color = '#f71111bf';
            $status = 'LOA';
            $mon_duration = null;
            $tue_duration = null;
            $wed_duration = null;
            $thu_duration = null;
            $fri_duration = null;
            $sat_duration = null;
            $sun_duration = null;
            $shift_duration = '0.00';
        endforeach;
        $display .= '</tbody>';

        echo json_encode($display);
    }

	public function showScheduleTable(){
	    $week = $this->input->get('week');
	    $week_convert = date('Y-m-d',strtotime($week));
        $date_this_week = array(
            "Monday" => date("M d,y",strtotime('monday this week',strtotime($week_convert))),
            "Tuesday" => date("M d,y",strtotime('tuesday this week',strtotime($week_convert))),
            "Wednesday" => date("M d,y",strtotime('wednesday this week',strtotime($week_convert))),
            "Thursday" => date("M d,y",strtotime('thursday this week',strtotime($week_convert))),
            "Friday" => date("M d,y",strtotime('friday this week',strtotime($week_convert))),
            "Saturday" => date("M d,y",strtotime('saturday this week',strtotime($week_convert))),
            "Sunday" => date("M d,y",strtotime('sunday this week',strtotime($week_convert))),
        );
        $date_this_check = array(
            0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
            1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
            2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
            3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
            4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
            5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
            6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
        );
        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();

	    $display = '';
	    $display .= '<thead>';
	    $display .= '<tr>';
	    $display .= '<td>Dept</td>';
	    $display .= '<td>Employee</td>';
	    $display .= '<td>Status</td>';
	    $display .= '<td class="day"><span class="week-day">Mon</span><span class="week-date">'.$date_this_week['Monday'].'</span></td>';
	    $display .= '<td class="day"><span class="week-day">Tue</span><span class="week-date">'.$date_this_week['Tuesday'].'</span></td>';
	    $display .= '<td class="day"><span class="week-day">Wed</span><span class="week-date">'.$date_this_week['Wednesday'].'</span></td>';
	    $display .= '<td class="day"><span class="week-day">Thu</span><span class="week-date">'.$date_this_week['Thursday'].'</span></td>';
	    $display .= '<td class="day"><span class="week-day">Fri</span><span class="week-date">'.$date_this_week['Friday'].'</span></td>';
	    $display .= '<td class="day"><span class="week-day">Sat</span><span class="week-date">'.$date_this_week['Saturday'].'</span></td>';
	    $display .= '<td class="day"><span class="week-day">Sun</span><span class="week-date">'.$date_this_week['Sunday'].'</span></td>';
	    $display .= '<td>Hours</td>';
	    $display .= '</tr>';
	    $display .= '</thead>';
	    $display .= '<tbody>';
            $roles = null;
            $name = null;
            $status = null;
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
            $total_hours = null;
	        foreach ($users as $user):
                $timesheet_settings = $this->timesheet_model->getTimeSheetByWeek($date_this_check);
	            $total_week_hours = $this->timesheet_model->getTotalWeekDuration($date_this_check);
                foreach ($timesheet_settings as $ts_settings_data){
                    if ($ts_settings_data->user_id == $user->id){
                        $timesheet_id = $ts_settings_data->id;
                        $total_hours = $total_week_hours[0]->total_duration."h";
                        $timesheet_day = $this->timesheet_model->getTimeSheetDayById($timesheet_id);
                    foreach ($timesheet_day as $days){
                            if ($days->day == "Monday"){
                                $day_id_mon = $days->id;
                                $monday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Tuesday"){
                                $day_id_tue = $days->id;
                                $tuesday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Wednesday"){
                                $day_id_wed = $days->id;
                                $wednesday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Thursday"){
                                $day_id_thu = $days->id;
                                $thursday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Friday"){
                                $day_id_fri = $days->id;
                                $friday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Saturday"){
                                $day_id_sat = $days->id;
                                $saturday =date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Sunday"){
                                $day_id_sun = $days->id;
                                $sunday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }
                        }
                    }
                }
                $name = $user->FName." ".$user->LName;
                foreach ($user_roles as $role){
                    if ($user->role == $role->id){
                        $roles = $role->title;
                    }
                }

                switch ($user->status) {
                    case 1:
                        $status = 'Fulltime';
                        break;
                    default:
                        $status = null;
                }
	    $display .= '<tr>';
	    $display .= '<td class="center">'.$roles.'</td>';
	    $display .= '<td><span class="employee-name">'.$name.'</span><span class="sub-text">'.$roles.'</span></td>';
	    $display .= '<td class="center">'.$status.'</td>';
	    $display .= '<td class="center">'.$monday.'</td>';
	    $display .= '<td class="center">'.$tuesday.'</td>';
	    $display .= '<td class="center">'.$wednesday.'</td>';
	    $display .= '<td class="center">'.$thursday.'</td>';
	    $display .= '<td class="center">'.$friday.'</td>';
	    $display .= '<td class="center">'.$saturday.'</td>';
	    $display .= '<td class="center">'.$sunday.'</td>';
	    $display .= '<td class="center">'.$total_hours.'</td>';
	    $display .= '</tr>';
                $roles = null;
                $name = null;
                $status = null;
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
                $total_hours = null;
	        endforeach;
	    $display .= '</tbody>';

	    echo json_encode($display);
    }

    public function showListTable(){
        $week = $this->input->get('week');
        $week_convert = date('Y-m-d',strtotime($week));
        $date_this_week = array(
            "Monday" => date("M d,y",strtotime('monday this week',strtotime($week_convert))),
            "Tuesday" => date("M d,y",strtotime('tuesday this week',strtotime($week_convert))),
            "Wednesday" => date("M d,y",strtotime('wednesday this week',strtotime($week_convert))),
            "Thursday" => date("M d,y",strtotime('thursday this week',strtotime($week_convert))),
            "Friday" => date("M d,y",strtotime('friday this week',strtotime($week_convert))),
            "Saturday" => date("M d,y",strtotime('saturday this week',strtotime($week_convert))),
            "Sunday" => date("M d,y",strtotime('sunday this week',strtotime($week_convert))),
        );
        $week_check = array(
            0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
            1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
            2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
            3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
            4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
            5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
            6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
        );
	    $display = '';
        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();
        $ts_logs = $this->timesheet_model->getTSByDate($week_check);
        $week_duration = $this->timesheet_model->getWeekTotalDuration();
        $attendance = $this->timesheet_model->employeeAttendance();
        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<th></th>';
        $display .= '<th>Employee</th>';
        $display .= '<th>Current Status</th>';
        $display .= '<th class="day"><span class="thead-day">Mon</span><span class="thead-date">'.$date_this_week['Monday'].'</span></th>';
        $display .= '<th class="day"><span class="thead-day">Tue</span><span class="thead-date">'.$date_this_week['Tuesday'].'</span></th>';
        $display .= '<th class="day"><span class="thead-day">Wed</span><span class="thead-date">'.$date_this_week['Wednesday'].'</span></th>';
        $display .= '<th class="day"><span class="thead-day">Thu</span><span class="thead-date">'.$date_this_week['Thursday'].'</span></th>';
        $display .= '<th class="day"><span class="thead-day">Fri</span><span class="thead-date">'.$date_this_week['Friday'].'</span></th>';
        $display .= '<th class="day"><span class="thead-day">Sat</span><span class="thead-date">'.$date_this_week['Saturday'].'</span></th>';
        $display .= '<th class="day"><span class="thead-day">Sun</span><span class="thead-date">'.$date_this_week['Sunday'].'</span></th>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody>';
        $name = null;
        $role = null;
        $status = null;
        $mon_logtime = null;
        $tue_logtime = null;
        $wed_logtime = null;
        $thu_logtime = null;
        $fri_logtime = null;
        $sat_logtime = null;
        $sun_logtime = null;
        $week_id = 0;
        $attn_id = 0;
        $mon_status = null;
        $tue_status = null;
        $wed_status = null;
        $thu_status = null;
        $fri_status = null;
        $sat_status = null;
        $sun_status = null;
        $mon_id = null;
        $tue_id = null;
        $wed_id = null;
        $thu_id = null;
        $fri_id = null;
        $sat_id = null;
        $sun_id = null;
        foreach ($users as $user):
            $user_id = $user->id;
            $name = $user->FName." ".$user->LName;
            foreach ($user_roles as $roles){
                if ($roles->id == $user->role){
                    $role = $roles->title;
                }
            }
            foreach ($ts_logs as $log){
                if ($log->action == 'Check in' && $log->user_id == $user->id){
                    $status = 'In';
                    switch ($log->date){
                        case ($week_check[0]):
                            $mon_logtime = date('h:i A',$log->time);
                            $mon_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $mon_status = '#ffc859';
                            }
                            break;
                        case ($week_check[1]):
                            $tue_logtime = date('h:i A',$log->time);
                            $tue_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $tue_status = '#ffc859';
                            }
                            break;
                        case ($week_check[2]):
                            $wed_logtime = date('h:i A',$log->time);
                            $wed_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $wed_status = '#ffc859';
                            }
                            break;
                        case ($week_check[3]):
                            $thu_logtime = date('h:i A',$log->time);
                            $thu_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $thu_status = '#ffc859';
                            }
                            break;
                        case ($week_check[4]):
                            $fri_logtime = date('h:i A',$log->time);
                            $fri_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $fri_status = '#ffc859';
                            }
                            break;
                        case ($week_check[5]):
                            $sat_logtime = date('h:i A',$log->time);
                            $sat_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sat_status = '#ffc859';
                            }
                            break;
                        case ($week_check[6]):
                            $sun_logtime = date('h:i A',$log->time);
                            $sun_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sun_status = '#ffc859';
                            }
                            break;
                    }
                }elseif($log->action == 'Check out' && $log->user_id == $user->id){
                    $status = 'Out';
                    switch ($log->date){
                        case ($week_check[0]):
                            $mon_logtime = date('h:i A',$log->time);
                            $mon_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $mon_status = '#ffc859';
                            }
                            break;
                        case ($week_check[1]):
                            $tue_logtime = date('h:i A',$log->time);
                            $tue_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $tue_status = '#ffc859';
                            }
                            break;
                        case ($week_check[2]):
                            $wed_logtime = date('h:i A',$log->time);
                            $wed_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $wed_status = '#ffc859';
                            }
                            break;
                        case ($week_check[3]):
                            $thu_logtime = date('h:i A',$log->time);
                            $thu_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $thu_status = '#ffc859';
                            }
                            break;
                        case ($week_check[4]):
                            $fri_logtime = date('h:i A',$log->time);
                            if ($log->entry_type == 'Manual'){
                                $fri_status = '#ffc859';
                            }
                            break;
                        case ($week_check[5]):
                            $sat_logtime = date('h:i A',$log->time);
                            $sat_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sat_status = '#ffc859';
                            }
                            break;
                        case ($week_check[6]):
                            $sun_logtime = date('h:i A',$log->time);
                            $sun_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sun_status = '#ffc859';
                            }
                            break;
                    }
                }elseif ($log->action == 'Break in' && $log->user_id == $user->id){
                    $status = 'On Lunch';
                    switch ($log->date){
                        case ($week_check[0]):
                            $mon_logtime = date('h:i A',$log->time);
                            $mon_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $mon_status = '#ffc859';
                            }
                            break;
                        case ($week_check[1]):
                            $tue_logtime = date('h:i A',$log->time);
                            $tue_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $tue_status = '#ffc859';
                            }
                            break;
                        case ($week_check[2]):
                            $wed_logtime = date('h:i A',$log->time);
                            $wed_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $wed_status = '#ffc859';
                            }
                            break;
                        case ($week_check[3]):
                            $thu_logtime = date('h:i A',$log->time);
                            $thu_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $thu_status = '#ffc859';
                            }
                            break;
                        case ($week_check[4]):
                            $fri_logtime = date('h:i A',$log->time);
                            $fri_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $fri_status = '#ffc859';
                            }
                            break;
                        case ($week_check[5]):
                            $sat_logtime = date('h:i A',$log->time);
                            $sat_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sat_status = '#ffc859';
                            }
                            break;
                        case ($week_check[6]):
                            $sun_logtime = date('h:i A',$log->time);
                            $sun_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sun_status = '#ffc859';
                            }
                            break;
                    }

                }elseif ($log->action == 'Break out' && $log->user_id == $user->id) {
                    $status = 'In';
                    switch ($log->date){
                        case ($week_check[0]):
                            $mon_logtime = date('h:i A',$log->time);
                            $mon_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $mon_status = '#ffc859';
                            }
                            break;
                        case ($week_check[1]):
                            $tue_logtime = date('h:i A',$log->time);
                            $tue_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $tue_status = '#ffc859';
                            }
                            break;
                        case ($week_check[2]):
                            $wed_logtime = date('h:i A',$log->time);
                            $wed_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $wed_status = '#ffc859';
                            }
                            break;
                        case ($week_check[3]):
                            $thu_logtime = date('h:i A',$log->time);
                            $thu_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $thu_status = '#ffc859';
                            }
                            break;
                        case ($week_check[4]):
                            $fri_logtime = date('h:i A',$log->time);
                            $fri_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $fri_status = '#ffc859';
                            }
                            break;
                        case ($week_check[5]):
                            $sat_logtime = date('h:i A',$log->time);
                            $sat_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sat_status = '#ffc859';
                            }
                            break;
                        case ($week_check[6]):
                            $sun_logtime = date('h:i A',$log->time);
                            $sun_id = $log->id;
                            if ($log->entry_type == 'Manual'){
                                $sun_status = '#ffc859';
                            }
                            break;
                    }
                }
                if ($mon_logtime == null && $log->user_id == $user_id){
                    if ($week_check[0] < date('Y-m-d')){
                        $mon_status = '#f71111bf';
                    }
                }
                if ($tue_logtime == null && $log->user_id == $user_id){
                    if ($week_check[1] < date('Y-m-d')){
                        $tue_status = '#f71111bf';
                    }
                }
                if ($wed_logtime == null && $log->user_id == $user_id){
                    if ($week_check[2] < date('Y-m-d')){
                        $wed_status = '#f71111bf';
                    }
                }
                if ($thu_logtime == null && $log->user_id == $user_id){
                    if ($week_check[3] < date('Y-m-d')){
                        $thu_status = '#f71111bf';
                    }
                }
                if ($fri_logtime == null && $log->user_id == $user_id){
                    if ($week_check[4] < date('Y-m-d')){
                        $fri_status = '#f71111bf';
                    }
                }
                if ($sat_logtime == null && $log->user_id == $user_id){
                    if ($week_check[5] < date('Y-m-d')){
                        $sat_status = '#f71111bf';
                    }
                }
                if ($sun_logtime == null && $log->user_id == $user_id){
                    if ($week_check[6] < date('Y-m-d')){
                        $sun_status = '#f71111bf';
                    }
                }

            }
            foreach ($week_duration as $week){
                if ($week->user_id == $user_id){
                    $week_id = $week->id;
                }
            }
            foreach ($attendance as $attn){
                if ($attn->user_id == $user_id){
                    $attn_id = $attn->id;
                }
            }

        $display .= '<tr>';
        $display .= '<td class="center"><input type="radio" name="selected" data-week="'.$week_id.'" data-attn="'.$attn_id.'" data-name="'.$name.'" value="'.$user_id.'"></td>';
        $display .= '<td><span class="list-emp-name">'.$name.'</span><span class="list-emp-role">'.$role.'</span></td>';
        $display .= '<td class="center"><span class="list-emp-status">'.$status.'</span></td>';
        $display .= '<td class="center" style="background: '.$mon_status.'" data-id="'.$mon_id.'">'.$mon_logtime.'</td>';
        $display .= '<td class="center" style="background: '.$tue_status.'" data-id="'.$tue_id.'">'.$tue_logtime.'</td>';
        $display .= '<td class="center" style="background: '.$wed_status.'" data-id="'.$wed_id.'">'.$wed_logtime.'</td>';
        $display .= '<td class="center" style="background: '.$thu_status.'" data-id="'.$thu_id.'">'.$thu_logtime.'</td>';
        $display .= '<td class="center" style="background: '.$fri_status.'" data-id="'.$fri_id.'">'.$fri_logtime.'</td>';
        $display .= '<td class="center" style="background: '.$sat_status.'" data-id="'.$sat_id.'">'.$sat_logtime.'</td>';
        $display .= '<td class="center" style="background: '.$sun_status.'" data-id="'.$sun_id.'">'.$sun_logtime.'</td>';
        $display .= '</tr>';
            $name = null;
            $role = null;
            $status = null;
            $mon_logtime = null;
            $tue_logtime = null;
            $wed_logtime = null;
            $thu_logtime = null;
            $fri_logtime = null;
            $sat_logtime = null;
            $sun_logtime = null;
            $week_id = 0;
            $attn_id = 0;
            $mon_status = null;
            $tue_status = null;
            $wed_status = null;
            $thu_status = null;
            $fri_status = null;
            $sat_status = null;
            $sun_status = null;
            $mon_id = null;
            $tue_id = null;
            $wed_id = null;
            $thu_id = null;
            $fri_id = null;
            $sat_id = null;
            $sun_id = null;
            $missing = null;
        endforeach;
        $display .= '</tbody>';

        echo json_encode($display);

    }
    public function getWeekOf(){
	    $week = $this->input->get('week_of');
	    $dayLog_id = $this->input->get('day_id');
        $week_convert = date('Y-m-d',strtotime($week));
        $date_this_week = array(
            "Monday" => date("M d",strtotime('monday this week',strtotime($week_convert))),
            "Tuesday" => date("M d",strtotime('tuesday this week',strtotime($week_convert))),
            "Wednesday" => date("M d",strtotime('wednesday this week',strtotime($week_convert))),
            "Thursday" => date("M d",strtotime('thursday this week',strtotime($week_convert))),
            "Friday" => date("M d",strtotime('friday this week',strtotime($week_convert))),
            "Saturday" => date("M d",strtotime('saturday this week',strtotime($week_convert))),
            "Sunday" => date("M d",strtotime('sunday this week',strtotime($week_convert))),
        );
        $week_check = array(
            0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
            1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
            2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
            3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
            4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
            5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
            6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
        );
        $mon_logtime = null;
        $tue_logtime = null;
        $wed_logtime = null;
        $thu_logtime = null;
        $fri_logtime = null;
        $sat_logtime = null;
        $sun_logtime = null;
        $get_logs = $this->db->get('timesheet_logs')->result();
        foreach ($get_logs as $logs){
            if ($logs->id == $dayLog_id[0]){
                $mon_logtime = date('h:i A',$logs->time);
            }elseif ($logs->id == $dayLog_id[1]){
                $tue_logtime = date('h:i A',$logs->time);
            }elseif ($logs->id == $dayLog_id[2]){
                $wed_logtime = date('h:i A',$logs->time);
            }elseif ($logs->id == $dayLog_id[3]){
                $thu_logtime = date('h:i A',$logs->time);
            }elseif ($logs->id == $dayLog_id[4]){
                $fri_logtime = date('h:i A',$logs->time);
            }elseif ($logs->id == $dayLog_id[5]){
                $sat_logtime = date('h:i A',$logs->time);
            }elseif ($logs->id == $dayLog_id[6]){
                $sun_logtime = date('h:i A',$logs->time);
            }
        }

        $data = new stdClass();
        $data->monday = $date_this_week['Monday'];
        $data->tuesday = $date_this_week['Tuesday'];
        $data->wednesday = $date_this_week['Wednesday'];
        $data->thursday = $date_this_week['Thursday'];
        $data->friday = $date_this_week['Friday'];
        $data->saturday = $date_this_week['Saturday'];
        $data->sunday = $date_this_week['Sunday'];
        $data->input_mon = $week_check[0];
        $data->input_tue = $week_check[1];
        $data->input_wed = $week_check[2];
        $data->input_thu = $week_check[3];
        $data->input_fri = $week_check[4];
        $data->input_sat = $week_check[5];
        $data->input_sun = $week_check[6];
        $data->mon_logtime = $mon_logtime;
        $data->tue_logtime = $tue_logtime;
        $data->wed_logtime = $wed_logtime;
        $data->thu_logtime = $thu_logtime;
        $data->fri_logtime = $fri_logtime;
        $data->sat_logtime = $sat_logtime;
        $data->sun_logtime = $sun_logtime;

        echo json_encode($data);
    }
    public function adjustEntry(){
	    $table = 'timesheet_logs';
	    $date = $this->input->post('date');
//	    $attn_id = $this->input->post('attn_id');
	    $user_id = $this->input->post('values[user_id]');
        $monday_log = $this->input->post('values[monday]');
        $tuesday_log = $this->input->post('values[tuesday]');
        $wednesday_log = $this->input->post('values[wednesday]');
        $thursday_log = $this->input->post('values[thursday]');
        $friday_log = $this->input->post('values[friday]');
        $saturday_log = $this->input->post('values[saturday]');
        $sunday_log = $this->input->post('values[sunday]');
        $day_id = $this->input->post('day_id');
        $logs_array = array(
            0 => $monday_log,
            1 => $tuesday_log,
            2 => $wednesday_log,
            3 => $thursday_log,
            4 => $friday_log,
            5 => $saturday_log,
            6 => $sunday_log
        );
        for ($x = 0;$x < count($day_id);$x++){
            if ($day_id[$x] != null){
                $update = array(
                    'time' => strtotime($date[$x]." ".$logs_array[$x])
                );
                $this->db->where('id',$day_id[$x]);
                $this->db->update($table,$update);
            }
        }
        echo json_encode(1);
    }
	public function attendance(){
        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        $this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
        $this->page_data['users'] = $this->users_model->getUsers();
//        $this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        $this->page_data['total_users'] = $this->users_model->getTotalUsers();
        $this->page_data['no_logged_in'] = $this->timesheet_model->getTotalUsersLoggedIn();
        $this->page_data['in_now'] = $this->timesheet_model->getInNow();
        $this->page_data['out_now'] = $this->timesheet_model->getOutNow();
        $this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
        $this->page_data['week_duration'] = $this->timesheet_model->getWeekTotalDuration();
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
        $this->page_data['schedule'] = $this->timesheet_model->getTimeSheetSettings();
        $this->page_data['tasks'] = $this->timesheet_model->getTimeSheetDay();

        $this->load->view('users/timesheet_attendance', $this->page_data);
    }

    public function inNow(){
	    $query = $this->db->get_where('timesheet_attendance',array('status' => 1,'date_in'=>date('Y-m-d')));
	    echo json_encode($query->num_rows());
    }
    public function outNow(){
        $query = $this->db->get_where('timesheet_attendance',array('status' => 0,'date_out'=>date('Y-m-d')));
        echo json_encode($query->num_rows());
    }
    public function loggedInToday(){
        $total_users = $this->users_model->getTotalUsers();
        $query =  $this->db->get_where('timesheet_attendance',array('date_in'=>date('Y-m-d')));
        $logged_in = $query->num_rows();
        echo json_encode($total_users - $logged_in);
    }

    public function checkingInEmployee(){
        $user_id = $this->input->post('id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->checkInEmployee($user_id,$entry,$approved_by);
        if ($query != 0){
            echo json_encode($query);
        }elseif($query == false){
            echo json_encode(false);
        }
    }

    public function checkingOutEmployee(){
        $user_id = $this->input->post('id');
        $attn_id = $this->input->post('attn_id');
        $week_id = $this->input->post('week_id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->checkingOutEmployee($user_id,$week_id,$attn_id,$entry,$approved_by);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function breakIn(){
        $user_id = $this->input->post('id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->breakIn($user_id,$entry,$approved_by);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    public function breakOut(){
        $user_id = $this->input->post('id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->breakOut($user_id,$entry,$approved_by);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function realTime(){
	    $hours = date('h:');
	    $minutes = date('i ');
	    $meridies = date('A');
	    echo json_encode($hours.$minutes.$meridies);
    }



	// timesheet 
//	public function clock_in()
//	{
//		print_r($this->input->post());
//		$this->load->model('timesheet_model');
//		$data = array(
//			'employees_id' => $this->input->post('clockin_user_id'),
//			'action' => 'Clock In',
//			'timestamp' => $this->input->post('current_time_in'),
//			'entry_type' => 'Normal'
//			/*'user_id' => $this->input->post('clockin_user_id'),
//			'company_id' => $this->input->post('clockin_company_id'),
//			'clock_in' => $this->input->post('current_time_in'),
//			'session_key' => $this->input->post('clockin_sess'),
//			'status' => $this->input->post('clockin_status')*/
//		);
//
//
//
//		$this->timesheet_model->clockIn($data);
//
//	}
//	public function clock_out()
//	{
//		$this->load->model('timesheet_model');
//		$data = array(
//			'employees_id' => $this->input->post('clockin_user_id'),
//			'action' => 'Clock Out',
//			'timestamp' => $this->input->post('current_time_in'),
//			'entry_type' => 'Normal'
//			/*'user_id' => $this->input->post('clockin_user_id'),
//			'company_id' => $this->input->post('clockin_company_id'),
//			'clock_out' => $this->input->post('current_time_in'),
//			'session_key' => $this->input->post('clockin_sess'),
//			'status' => $this->input->post('clockin_status')*/
//		);
//
//		$this->timesheet_model->clockOut($data);
//
//	}


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
	    $project = $this->input->post('values[project]');
	    $start_date = $this->input->post('values[start_date]');
	    $start_time = $this->input->post('values[start_time]');
	    $end_time = $this->input->post('values[end_time]');
	    $user_id = $this->input->post('values[team_member]');
	    $location = $this->input->post('values[location]');
	    $notes = $this->input->post('values[notes]');
	    $duration = $this->input->post('duration');
        $week = $this->input->post('values[week]');

	    $data = array(
	        'project' => $project,
            'start_date' => date('Y-m-d',strtotime($start_date)),
            'start_time' => date('H:i',strtotime($start_time)),
            'end_time' => date('H:i',strtotime($end_time)),
            'user_id' => $user_id,
            'location' => $location,
            'notes' => $notes,
            'duration' => $duration,
            'day' => date('l',strtotime($start_date)),
            'week' => $week,
            'twd_id' => null,

        );
        $query = $this->timesheet_model->addingProjects($data);

        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function getTimesheetData(){
	    $timesheet_id = $this->input->get('timesheet_id');
	    $day_id = $this->input->get('day_id');
	    $ts_query = $this->db->get_where('timesheet_settings',array('id'=>$timesheet_id));
	    if ($day_id != null){
            $ts_day = $this->db->get_where('ts_settings_day',array('id'=>$day_id));
        }
        $users = $this->db->get_where('users',array('id'=> $ts_query->row()->user_id));
	    $employee_name = ($ts_query->row()->user_id != 0)?$users->row()->FName." ".$users->row()->LName:"Teammates";

        $data = new stdClass();
	    $data->project_name = $ts_query->row()->project_name;
	    $data->team_member = $employee_name;
	    $data->location = $ts_query->row()->location;
	    $data->notes = $ts_query->row()->notes;
	    $data->start_time = (!empty($day_id))?date('h:i A',strtotime($ts_day->row()->start_time)):null;
	    $data->end_time = (!empty($day_id))?date('h:i A',strtotime($ts_day->row()->end_time)):null;
	    $data->total_duration = (!empty($day_id))?$ts_day->row()->duration:0;

	    echo json_encode($data);
    }

    public function updateSchedule(){
	    $timesheet_id = $this->input->post('values[timesheet_id]');
	    $user_id = $this->input->post('values[user_id]');
        $start_date = $this->input->post('date');
        $start_time = $this->input->post('values[start_time]');
        $end_time = $this->input->post('values[end_time]');
        $duration = $this->input->post('duration');
        $day = $this->input->post('values[day]');
        $twd_id = $this->input->post('values[total_week_duration]');
        $day_id = $this->input->post('values[day_id]');
        $week = $this->input->post('values[week]');
        $data = array(
            'user_id' => $user_id,
            'start_date' => date('Y-m-d',strtotime($start_date)),
            'start_time' => date('H:i',strtotime($start_time)),
            'end_time' => date('H:i',strtotime($end_time)),
            'duration' => $duration,
            'day' => $day,
            'twd_id' => $twd_id,
            'day_id' => $day_id,
            'week' => $week
        );
        $query = $this->timesheet_model->perDaySchedule($timesheet_id,$data);

	    if ($query == true){
	        echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

//    public function updateDuration(){
//	    $day_id = $this->input->post('day_id');
//	    $project_id = $this->input->post('project_id');
//	    $duration = $this->input->post('duration');
//	    $day = $this->input->post('day');
//	    $date = $this->input->post('date');
//	    $data = array(
//	        'day_id' => $day_id,
//	        'project_id' => $project_id,
//            'duration' => $duration,
//            'day' => $day,
//            'date' => $date
//        );
//	    $query = $this->timesheet_model->updateDuration($data);
//	    if ($query == true){
//	        echo json_encode(1);
//        }else{
//	        echo json_encode(0);
//        }
//    }

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
        $user_id = $this->input->post('user_id');
        $update = array('date'=>$date,'total_duration'=>$total,'day'=>$day,'users_id'=>$user_id);
        $this->timesheet_model->addingTotalInDay($update,$id);
    }

    public function updateTotalDuration(){
	    $week = $this->input->post('week');
	    $date = $this->input->post('date');
	    $total = $this->input->post('total');
	    $user_id = $this->input->post('user_id');
	    $twd_id = $this->input->post('twd_id');
	    $update = array('date'=>$date,'total_duration'=>$total);
	    $this->timesheet_model->updateTotalDuration($update,$week,$twd_id,$user_id);
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
	    $user_id = $this->input->get('user');
	    $week = $this->input->get('week');
        $week_convert = date('Y-m-d',strtotime($week));
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
        $date_this_week = array(
            "Monday" => date("M d,y",strtotime('monday this week',strtotime($week_convert))),
            "Tuesday" => date("M d,y",strtotime('tuesday this week',strtotime($week_convert))),
            "Wednesday" => date("M d,y",strtotime('wednesday this week',strtotime($week_convert))),
            "Thursday" => date("M d,y",strtotime('thursday this week',strtotime($week_convert))),
            "Friday" => date("M d,y",strtotime('friday this week',strtotime($week_convert))),
            "Saturday" => date("M d,y",strtotime('saturday this week',strtotime($week_convert))),
            "Sunday" => date("M d,y",strtotime('sunday this week',strtotime($week_convert))),
        );
        $date_week_check = array(
            0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
            1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
            2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
            3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
            4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
            5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
            6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
        );
        $timesheet_settings = $this->timesheet_model->getTimeSheetByWeek($date_week_check);
        $timesheet_by_user = $this->timesheet_model->getTimeSheetByUser($user_id);
        $selected_user = (!empty($timesheet_by_user))?$timesheet_by_user[0]->user_id:null;

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
                if ($user_id == $setting->user_id):
            $timesheet_id = $setting->id;
            $timesheet_duration_w = (!empty($setting->total_duration_w))?$setting->total_duration_w:"00h";
            $timesheet_day = $this->timesheet_model->getTimeSheetDayById($timesheet_id);
            foreach ($timesheet_day as $days){
                    if ($days->day == "Monday"){
                        $day_id_mon = $days->id;
                        $monday = date('ha',strtotime($days->start_time))."-".date('ha',strtotime($days->end_time));
                    }elseif ($days->day == "Tuesday"){
                        $day_id_tue = $days->id;
                        $tuesday = date('ha',strtotime($days->start_time))."-".date('ha',strtotime($days->end_time));
                    }elseif ($days->day == "Wednesday"){
                        $day_id_wed = $days->id;
                        $wednesday = date('ha',strtotime($days->start_time))."-".date('ha',strtotime($days->end_time));
                    }elseif ($days->day == "Thursday"){
                        $day_id_thu = $days->id;
                        $thursday = date('ha',strtotime($days->start_time))."-".date('ha',strtotime($days->end_time));
                    }elseif ($days->day == "Friday"){
                        $day_id_fri = $days->id;
                        $friday = date('ha',strtotime($days->start_time))."-".date('ha',strtotime($days->end_time));
                    }elseif ($days->day == "Saturday"){
                        $day_id_sat = $days->id;
                        $saturday =date('ha',strtotime($days->start_time))."-".date('ha',strtotime($days->end_time));
                    }elseif ($days->day == "Sunday"){
                        $day_id_sun = $days->id;
                        $sunday = date('ha',strtotime($days->start_time))."-".date('ha',strtotime($days->end_time));
                    }
            }

            $display .= '<tr data-id="'.$timesheet_id.'" id="tsSettingsRow">';
                $display .= '<td><i class="fa fa-circle ts-status"></i><span class="ts-project-name" id="showEditPen">'.ucfirst($setting->project_name).'</span><a href="#" id="editProjectName" data-id="'.$setting->id.'" data-name="'.ucfirst($setting->project_name).'"><i class="fa fa-pencil-alt"></i></a></td>';
                $display .= '<td><input type="text" name="monday" data-day="Monday" id="tsMonday" data-date="'.$date_week_check[0].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_mon.'" data-user="'.$user_id.'" value="'.$monday.'" readonly></td>';
                $display .= '<td><input type="text" name="tuesday" data-day="Tuesday" id="tsTuesday" data-date="'.$date_week_check[1].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_tue.'" data-user="'.$user_id.'" value="'.$tuesday.'" readonly></td>';
                $display .= '<td><input type="text" name="wednesday" data-day="Wednesday" id="tsWednesday" data-date="'.$date_week_check[2].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_wed.'" data-user="'.$user_id.'" value="'.$wednesday.'" readonly></td>';
                $display .= '<td><input type="text" name="thursday" data-day="Thursday" id="tsThursday" data-date="'.$date_week_check[3].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_thu.'" data-user="'.$user_id.'" value="'.$thursday.'" readonly></td>';
                $display .= '<td><input type="text" name="friday" data-day="Friday" id="tsFriday" data-date="'.$date_week_check[4].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_fri.'" data-user="'.$user_id.'" value="'.$friday.'" readonly></td>';
                $display .= '<td><input type="text" name="saturday" data-day="Saturday" id="tsSaturday" data-date="'.$date_week_check[5].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_sat.'" data-user="'.$user_id.'" value="'.$saturday.'" readonly></td>';
                $display .= '<td><input type="text" name="sunday" data-day="Sunday" id="tsSunday" data-date="'.$date_week_check[6].'" class="form-control ts-duration ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_sun.'" data-user="'.$user_id.'" value="'.$sunday.'" readonly></td>';
                $display .= '<td><span class="totalWeek" id="totalWeekDuration'.$timesheet_id.'">'.$timesheet_duration_w.'h</span></td>';
                $display .= '<td><a href="#" id="removeProject" data-id="'.$setting->id.'" data-name="'.ucfirst($setting->project_name).'"><i class="fa fa-times fa-lg"></i></a></td>';
            $display .= '</tr>';
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
                endif;
        endforeach;
            if (($week != 'last week') && ($week != 'next week')):
            $display .= '<tr>';
                $display .= '<td><a href="#" id="addProject" style="color: #0b97c4;font-weight: bold"><i class="fa fa-plus"></i>&nbsp;Project</a></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly></td>';
                $display .= '<td><span style="color: #92969d;">0h</span></td>';
                $display .= '<td><a href="#"><i class="fa fa-times fa-lg" disabled></i></a></td>';
            $display .= '</tr>';
            endif;
	    $display .= '</tbody>';
        $duration_mon = '0';
        $duration_tue = '0';
        $duration_wed = '0';
        $duration_thu = '0';
        $duration_fri = '0';
        $duration_sat = '0';
        $duration_sun = '0';
        $data_id_mon = null;
        $data_id_tue = null;
        $data_id_wed = null;
        $data_id_thu = null;
        $data_id_fri = null;
        $data_id_sat = null;
        $data_id_sun = null;
        $ts_total_duration_day = $this->timesheet_model->getTimeSheetTotalInDay($date_week_check);
	    foreach ($ts_total_duration_day as $total_duration){
            if ($user_id == $total_duration->user_id):
	        if ($total_duration->day == 'Monday'){
	            $duration_mon = $total_duration->total_duration;
                $data_id_mon = $total_duration->id;
            }elseif ($total_duration->day == 'Tuesday'){
                $duration_tue = $total_duration->total_duration;
                $data_id_tue = $total_duration->id;
            }elseif ($total_duration->day == 'Wednesday'){
                $duration_wed = $total_duration->total_duration;
                $data_id_wed = $total_duration->id;
            }elseif ($total_duration->day == 'Thursday'){
                $duration_thu = $total_duration->total_duration;
                $data_id_thu = $total_duration->id;
            }elseif ($total_duration->day == 'Friday'){
                $duration_fri = $total_duration->total_duration;
                $data_id_fri = $total_duration->id;
            }elseif ($total_duration->day == 'Saturday'){
                $duration_sat = $total_duration->total_duration;
                $data_id_sat = $total_duration->id;
            }elseif ($total_duration->day == 'Sunday'){
                $duration_sun = $total_duration->total_duration;
                $data_id_sun = $total_duration->id;
            }
            endif;
        }
        $total_week_duration = "0";
        $ts_total_duration_week_id = null;
        $ts_total_duration_week = $this->timesheet_model->getTotalWeekDuration($date_week_check);
	    foreach ($ts_total_duration_week as $total_duration){
            if ($user_id == $total_duration->user_id){
                $total_week_duration = $total_duration->total_duration;
                $ts_total_duration_week_id = $total_duration->id;
            }
        }

	    $display .= '<tfoot>';
            $display .= '<tr>';
                $display .= '<th>Total</th>';
                $display .= '<th><span id="totalMonday" data-id="'.$data_id_mon.'">'.$duration_mon.'h</span></th>';
                $display .= '<th><span id="totalTuesday" data-id="'.$data_id_tue.'">'.$duration_tue.'h</span></th>';
                $display .= '<th><span id="totalWednesday" data-id="'.$data_id_wed.'">'.$duration_wed.'h</span></th>';
                $display .= '<th><span id="totalThursday" data-id="'.$data_id_thu.'">'.$duration_thu.'h</span></th>';
                $display .= '<th><span id="totalFriday" data-id="'.$data_id_fri.'">'.$duration_fri.'h</span></th>';
                $display .= '<th><span id="totalSaturday" data-id="'.$data_id_sat.'">'.$duration_sat.'h</span></th>';
                $display .= '<th><span id="totalSunday" data-id="'.$data_id_sun.'">'.$duration_sun.'h</span></th>';
                $display .= '<th><span id="totalWeekDuration-'.$user_id.'" data-id="'.$ts_total_duration_week_id.'">'.$total_week_duration.'h</span></th>';
                $display .= '<th></th>';
            $display .= '</tr>';
	    $display .= '</tfoot>';
	    echo json_encode($display);
    }
    public function getEmployees(){
	    $name = $this->input->get('search');
	    $users = $this->users_model->getUsersByName($name);
	    $roles = $this->users_model->getRoles();
        $data = array();
        $data[] = array(
            'id' =>   '0',
            'text' => 'Teammates',
            'subtext' => 'Default'
        );
	    foreach ($users as $employee){
	        $users_role = '';
	        foreach ($roles as $role){
	            if ($role->id == $employee->role){
                    $users_role = $role->title;
                }
            }
            $data[] = array(
                'id' =>   $employee->id,
                'text' => $employee->FName." ".$employee->LName,
                'subtext' => $users_role
            );
        }

        echo json_encode($data);


    }
    public function serverTime(){
	    $duration = '60 minute';
	    $query = $this->db->get_where('user_break',array('user_id'=>$this->session->userdata('logged')['id'],'date'=>date('Y-m-d')));
	    if ($query->num_rows() == 1){
            $result = $query->result();
            $remaining_time = explode(":",$result[0]->duration);
            $duration = $remaining_time[0].' minute '.$remaining_time[1].' second';
        }

	    $date_time = date('M d, Y H:i:s');
        $end_time = date('M d, Y H:i:s', strtotime($duration));
	    $data = new stdClass();
	    $data->date_time = $date_time;
	    $data->end_time = $end_time;
	    echo json_encode($data);
    }
    public function clockInEmployee(){
	    $clock_in = time();
	    $user_id = $this->session->userdata('logged')['id'];
        $check_week = $this->db->get_where('ts_weekly_total_shift',array('user_id' => $user_id,'week_of'=>date('Y-m-d',strtotime('monday this week'))));
        if ($check_week->num_rows() == 1){
            $week_id = $check_week->row()->id;
        }else{
            $week_insert = array(
                'user_id' => $user_id,
                'week_of' => date('Y-m-d',strtotime('monday this week')),
                'total_shift' => 0
            );
            $this->db->insert('ts_weekly_total_shift',$week_insert);
            $week_id = $this->db->insert_id();
        }
        $attendance = array(
            'week_id' => $week_id,
            'user_id' => $user_id,
            'date_in' => date('Y-m-d'),
            'date_out' => date('Y-m-d'),
            'status' => 1
        );
        $this->db->insert('timesheet_attendance',$attendance);
        $attn_id = $this->db->insert_id();

        $logs_insert = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Check in',
            'date' => date('Y-m-d'),
            'time' => $clock_in,
            'entry_type' => 'Normal',
            'status' => 1
        );
        $this->db->insert('timesheet_logs',$logs_insert);
        if($this->db->affected_rows() != 1){
            echo json_encode(0);
        }else{
            $session = array(
                'clock-btn' => 'clockOut',
                'active' => 'clock-active',
                'clock-in-time' => date('h:i A',$clock_in),
                'clock-out-time' => 'Pending...',
                'attn-id' => $attn_id,
                'lunch-in' => true,
                'lunch-active' => false
            );
            $this->session->set_userdata($session);
            $data = new stdClass();
            $data->clock_in_time = date('h:i A',$clock_in);
            $data->clock_out_time = 'Pending...';
            $data->attendance_id = $attn_id;
            echo json_encode($data);
        }

    }

    public function clockOutEmployee(){
        $attn_id = $this->input->post('attn_id');
        $clock_out = time();
        $user_id = $this->session->userdata('logged')['id'];
        $check_attn = $this->db->get_where('timesheet_attendance',array('id' => $attn_id,'user_id' => $user_id));
        if ($check_attn->num_rows() == 1){
            $out = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check out',
                'date' => date('Y-m-d'),
                'time' => $clock_out,
                'entry_type' => 'Normal',
                'status' => 1
            );
            $this->db->insert('timesheet_logs',$out);
            $shift_duration = $this->timesheet_model->calculateShiftDuration($attn_id);
            $break_duration = $this->timesheet_model->calculateBreakDuration($attn_id);
            $update = array(
                'shift_duration' => $shift_duration,
                'break_duration' => $break_duration,
                'date_out' => date('Y-m-d'),
                'status' => 0
            );
            $this->db->where('id',$attn_id);
            $this->db->update('timesheet_attendance',$update);
            if($this->db->affected_rows() != 1){
                echo json_encode(0);
            }else{
                $unset = array('active','lunch-active');
                $this->session->unset_userdata($unset);
                $session = array(
                    'clock-btn' => 'preventLogIn',
                    'clock-out-time' => date('h:i A',$clock_out),
                    'attn-id' => $attn_id,
                    'shift_duration' => $shift_duration
                );
                $this->session->set_userdata($session);
                $data = new stdClass();
                $data->clock_out_time = date('h:i A',$clock_out);
                $data->attendance_id = $attn_id;
                $data->shift_duration = $shift_duration;
                echo json_encode($data);
            }

        }
    }

    public function lunchInEmployee(){
	    $end_break = $this->input->post('end_of_break');
        $attn_id = $this->input->post('attn_id');
        $lunch_in = time();
        $user_id = $this->session->userdata('logged')['id'];
        $lunch = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break in',
            'date' => date('Y-m-d'),
            'time' => $lunch_in,
            'entry_type' => 'Normal',
            'status' => 1
        );
        $this->db->insert('timesheet_logs',$lunch);
        $lunch_sess = array(
            'active' => 'clock-break',
            'lunch_in_time' => date('h:i A',$lunch_in),
            'lunch-active' => true,
            'end_break' => $end_break
        );
        $this->session->set_userdata($lunch_sess);
        $data = new stdClass();
        $data->lunch_in_time = date('h:i A',$lunch_in);
        $data->end_break = $end_break;
        echo json_encode($data);
    }

    public function lunchOutEmployee(){
        $attn_id = $this->input->post('attn_id');
        $remaining_time = $this->input->post('remaining_time');
        $lunch_out = time();
        $user_id = $this->session->userdata('logged')['id'];
        $lunch = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break out',
            'date' => date('Y-m-d'),
            'time' => $lunch_out,
            'entry_type' => 'Normal',
            'status' => 1
        );
        $this->db->insert('timesheet_logs',$lunch);

        $lunch_sess = array(
                'active' => 'clock-active',
                'remaining_time' => $remaining_time,
                'lunch-active' => false
        );
        $this->session->set_userdata($lunch_sess);
        $lunch_unset = array('lunch_in_time','end_break');
        $this->session->unset_userdata($lunch_unset);
        $data = new stdClass();
        $data->lunch_out_time = date('h:i A',$lunch_out);
        $data->remaining = $remaining_time;
        echo json_encode($data);
    }

    public function startBreak(){
        $end_time = $this->input->post('break_time');
        $today = date('Y-m-d');
        $user_id =  $this->session->userdata('logged')['id'];
        $query = $this->db->get_where('user_break',array('date'=>$today,'user_id'=>$user_id));
        if ($query->num_rows() == 0){
            $data = array(
              'date' => $today,
              'user_id' => $user_id,
              'break_end_time' => date('Y-m-d H:i:s',strtotime($end_time)),
              'duration' => '60:00',
              'status' => 1
            );
            $this->db->insert('user_break',$data);
            $break_id = $this->db->insert_id();
            $break_end = $this->db->get_where('user_break',array('id' => $break_id));
            $break_data = $break_end->result();
            $break_session = array(
                'break' => date('M d, Y H:i:s',strtotime($break_data[0]->break_end_time)),
                'on_break' => 'clock-break',
                'timer_icon' => 'style="color:red;" ',
                'active' => 1
            );
            $this->session->set_userdata($break_session);

        }
        echo json_encode($this->session->userdata('break'));
    }

    public function stopBreak(){
        $unset = array('break','on_break','timer_icon');
        $this->session->unset_userdata($unset);
	    $remaining_min = $this->input->post('minutes');
	    $remaining_sec = $this->input->post('seconds');
	    $user_id =  $this->session->userdata('logged')['id'];
        $duration = $remaining_min.' minute'.$remaining_min.' second';
	    $check = array(
	        'user_id' => $user_id,
            'date' => date('Y-m-d')
        );
	    $update = array(
	        'break_end_time' => date('Y-m-d H:i:s', strtotime($duration)),
	        'duration' => $remaining_min.":".$remaining_sec,
            'status' => 2
        );
	    $this->db->where($check);
	    $this->db->update('user_break',$update);
        $break_session = array(
            'remaining_time' => $remaining_min.":".$remaining_sec
        );
        $this->session->set_userdata($break_session);
        echo json_encode($this->session->userdata('remaining_time'));


    }
}



/* End of file Users.php */

/* Location: ./application/controllers/Users.php */