<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Timesheet extends MY_Controller {



	public function __construct()


	{

		parent::__construct();
		$this->checkLogin();

		$this->page_data['page']->title = 'Timesheet Management';

		$this->page_data['page']->menu = 'users';
        
        add_css(array(
            "assets/css/timesheet.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/plugins/country-picker-flags/build/css/countrySelect.css",
            "assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
//            "https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"
//            "https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.js",
            "assets/plugins/country-picker-flags/build/js/countrySelect.js",
            "assets/plugins/timezone-picker/dist/timezones.full.js",
            "assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js",
//            "https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js",
//            "https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js",
        ));

	}

	// added for tracking Timesheet of employees: Single Employee View
//	public function timesheet_user()
//	{
//		$this->load->model('timesheet_model');
//		$this->load->model('users_model');
//		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
//		$this->page_data['users'] = $this->users_model->getUsers();
//		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
//
//		$this->load->view('users/timesheet-user', $this->page_data);
//	}

	// added for tracking Timesheet of employees: Attendance View / Admin View
//	public function timesheet()
//	{
//		$this->load->model('timesheet_model');
//		$this->load->model('users_model');
//		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
//		$this->page_data['users'] = $this->users_model->getUsers();
////		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
//
//		// get total numbers of "In" employees
//		$this->page_data['total_in'] = $this->timesheet_model->getTotalInEmployees();
//		// get total numbers of "Out" employees
//		$this->page_data['total_out'] = $this->timesheet_model->getTotalOutEmployees();
//		// get total numbers of "Not Logged In Today" employees
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
		$this->load->model('users_model');
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
//        $this->page_data['no_logged_in'] = $this->timesheet_model->getTotalUsersLoggedIn();
//        $this->page_data['in_now'] = $this->timesheet_model->getInNow();
//        $this->page_data['out_now'] = $this->timesheet_model->getOutNow();
        $this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
        $this->page_data['week_duration'] = $this->timesheet_model->getLastWeekTotalDuration();
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
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
//		$this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
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
		
		$this->load->view('users/timesheet-schedule', $this->page_data);
	}

	public function list()
	{	
		$this->load->model('timesheet_model');
		$this->load->model('users_model');
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

//        $this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
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
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

//		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		$this->page_data['users'] = $this->users_model->getUsers();
		$this->page_data['roles'] = $this->users_model->getRoles();
        $this->page_data['timesheet_settings'] = $this->timesheet_model->getTimeSheetSettings();
        $this->page_data['timesheet_day'] = $this->timesheet_model->getTimeSheetDay();
        $this->page_data['pto'] = $this->timesheet_model->getPTO();
        $this->page_data['leave_request'] = $this->timesheet_model->getLeaveRequest();
        $this->page_data['leave_date'] = $this->timesheet_model->getLeaveDate();
//        $this->page_data['user_logged'] = $this->checkLogin();
        //Department
        $this->page_data['department'] = $this->timesheet_model->getDepartment();
        if ($this->uri->segment(3) != null){
            $dept_id = $this->uri->segment(3);
            $this->page_data['dept_id'] = $this->timesheet_model->getDepartmentById($dept_id);
        }

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
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();


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


	public function tracklocation()
	{	
//		ifPermissions('users_list');

//		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
//		$this->page_data['users'] = $this->users_model->getUsers();
			
		
		$this->load->view('users/tracklocation', $this->page_data);

	}
	
	public function index()

	{
        $user_id = logged('id');
		$this->load->model('users_model');
		//ifPermissions('users_list');
		$this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
		
		$this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);


		$this->load->view('users/timesheet-admin', $this->page_data);
	}


	public function showEmployeeTable(){
	    $week = $this->input->get('week');
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
        $display = '';

        $users = $this->users_model->getUsers();
        $user_roles= $this->users_model->getRoles();
        $ts_logs = $this->timesheet_model->getTSByDate($week_check);
        $attendance = $this->timesheet_model->employeeAttendance();
        $week_duration = $this->timesheet_model->getLastWeekTotalDuration();

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
        $shift_duration = number_format(0,2);

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
                    for ($x = 0; $x < count($week_check);$x++){
                        if ($week_check[$x] == date('Y-m-d',strtotime($attn->date_created))){
                            $shift_duration += $attn->shift_duration;
                        }
                    }
                    switch (date('Y-m-d',strtotime($attn->date_created))){
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
//            foreach ($week_duration as $week){
//                if ($user->id == $week->user_id && $week->week_of == $week_check[0]){
//                    $shift_duration = $week->total_shift;
//                }
//            }
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
            "Monday" => date("M d",strtotime('monday this week',strtotime($week_convert))),
            "Tuesday" => date("M d",strtotime('tuesday this week',strtotime($week_convert))),
            "Wednesday" => date("M d",strtotime('wednesday this week',strtotime($week_convert))),
            "Thursday" => date("M d",strtotime('thursday this week',strtotime($week_convert))),
            "Friday" => date("M d",strtotime('friday this week',strtotime($week_convert))),
            "Saturday" => date("M d",strtotime('saturday this week',strtotime($week_convert))),
            "Sunday" => date("M d",strtotime('sunday this week',strtotime($week_convert))),
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
            $mon_total = 0;
            $tue_total = 0;
            $wed_total = 0;
            $thu_total = 0;
            $fri_total = 0;
            $sat_total = 0;
            $sun_total = 0;
            $total_hours = 0;
	        foreach ($users as $user):
                $timesheet_settings = $this->timesheet_model->getTimeSheetByWeek($date_this_check);
//	            $get_total_w_hours = $this->timesheet_model->getTotalWeekDuration($date_this_check);
                foreach ($timesheet_settings as $ts_settings_data){
                    if ($ts_settings_data->user_id == $user->id){
                        $timesheet_id = $ts_settings_data->id;
                        //Get total week hours
//                        foreach ($get_total_w_hours as $total_week_hours){
//                            if($total_week_hours->user_id == $user->id){
//                                $total_hours = $total_week_hours->total_duration."h";
//                            }
//                        }

                        $timesheet_day = $this->timesheet_model->getTimeSheetDayById($timesheet_id);
                    foreach ($timesheet_day as $days){
                            if ($days->day == "Monday"){
                                $mon_total = $days->duration;
                                $monday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Tuesday"){
                                $tue_total = $days->duration;
                                $tuesday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Wednesday"){
                                $wed_total = $days->duration;
                                $wednesday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Thursday"){
                                $thu_total = $days->duration;
                                $thursday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Friday"){
                                $fri_total = $days->duration;
                                $friday = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Saturday"){
                                $sat_total = $days->duration;
                                $saturday =date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                            }elseif ($days->day == "Sunday"){
                                $sun_total = $days->duration;
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
                //Calculating total duration for the week
            $total_hours = $mon_total + $tue_total + $wed_total + $thu_total + $fri_total + $sat_total + $sun_total;
            if ($total_hours == 0){
                $total_hours = null;
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
                $mon_total = 0;
                $tue_total = 0;
                $wed_total = 0;
                $thu_total = 0;
                $fri_total = 0;
                $sat_total = 0;
                $sun_total = 0;
                $total_hours = null;
	        endforeach;
	    $display .= '</tbody>';

	    echo json_encode($display);
    }

    public function showListTable(){
        $week = $this->input->get('week');
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
	    $display = '';
        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();
        $ts_logs = $this->timesheet_model->getTSByDate($week_check);
//        $week_duration = $this->timesheet_model->getWeekTotalDuration();
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
        $attn_id = 0;
        $mon_status = '#ffffff';
        $tue_status = '#ffffff';
        $wed_status = '#ffffff';
        $thu_status = '#ffffff';
        $fri_status = '#ffffff';
        $sat_status = '#ffffff';
        $sun_status = '#ffffff';
        $mon_id = null;
        $tue_id = null;
        $wed_id = null;
        $thu_id = null;
        $fri_id = null;
        $sat_id = null;
        $sun_id = null;
        $attn_user = 0;
        foreach ($users as $user):
            $user_id = $user->id;
            $user_photo = userProfileImage($user->id);
            $name = $user->FName." ".$user->LName;
            foreach ($user_roles as $roles){
                if ($roles->id == $user->role){
                    $role = $roles->title;
                }
            }

            foreach ($attendance as $attn){
                if ($attn->user_id == $user_id){
                    $attn_id = $attn->id;
                    $attn_user = $attn->user_id;
                    foreach ($ts_logs as $log){
                        if ($attn_id == $log->attendance_id){
                            switch (date('Y-m-d',strtotime($log->date_created))){
                                case ($week_check[0]):
                                    if ($log->action == 'Check in'){
                                        $mon_logtime = date('h:i A',strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $mon_status = '#ffc859';
                                        }else{
                                            $mon_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Break in'){
                                        $mon_logtime = date('h:i A',strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $mon_status = '#ffc859';
                                        }else{
                                            $mon_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Break out'){
                                        $mon_logtime = date('h:i A',strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $mon_status = '#ffc859';
                                        }else{
                                            $mon_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Check out'){
                                        $mon_logtime = date('h:i A',strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $mon_status = '#ffc859';
                                        }else{
                                            $mon_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[1]):
                                    if ($log->action == 'Check in'){
                                        $tue_logtime = date('h:i A',strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $tue_status = '#ffc859';
                                        }else{
                                            $tue_status = '#ffffff';
                                        }
                                    }elseif ($log->action == 'Break in'){
                                        $tue_logtime = date('h:i A',strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $tue_status = '#ffc859';
                                        }else{
                                            $tue_status = '#ffffff';
                                        }
                                    }elseif ($log->action == 'Break out'){
                                        $tue_logtime = date('h:i A',strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $tue_status = '#ffc859';
                                        }else{
                                            $tue_status = '#ffffff';
                                        }
                                    }elseif ($log->action == 'Check out'){
                                        $tue_logtime = date('h:i A',strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $tue_status = '#ffc859';
                                        }else{
                                            $tue_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[2]):
                                    if ($log->action == 'Check in'){
                                        $wed_logtime = date('h:i A',strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $wed_status = '#ffc859';
                                        }else{
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in'){
                                        $wed_logtime = date('h:i A',strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $wed_status = '#ffc859';
                                        }else{
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out'){
                                        $wed_logtime = date('h:i A',strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $wed_status = '#ffc859';
                                        }else{
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out'){
                                        $wed_logtime = date('h:i A',strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $wed_status = '#ffc859';
                                        }else{
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[3]):
                                    if ($log->action == 'Check in'){
                                        $thu_logtime = date('h:i A',strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $thu_status = '#ffc859';
                                        }else{
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in'){
                                        $thu_logtime = date('h:i A',strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $thu_status = '#ffc859';
                                        }else{
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out'){
                                        $thu_logtime = date('h:i A',strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $thu_status = '#ffc859';
                                        }else{
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out'){
                                        $thu_logtime = date('h:i A',strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $thu_status = '#ffc859';
                                        }else{
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[4]):
                                    if ($log->action == 'Check in'){
                                        $fri_logtime = date('h:i A',strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $fri_status = '#ffc859';
                                        }else{
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in'){
                                        $fri_logtime = date('h:i A',strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $fri_status = '#ffc859';
                                        }else{
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out'){
                                        $fri_logtime = date('h:i A',strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $fri_status = '#ffc859';
                                        }else{
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out'){
                                        $fri_logtime = date('h:i A',strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $fri_status = '#ffc859';
                                        }else{
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    break;

                                case ($week_check[5]):
                                    if ($log->action == 'Check in'){
                                        $sat_logtime = date('h:i A',strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sat_status = '#ffc859';
                                        }else{
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in'){
                                        $sat_logtime = date('h:i A',strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sat_status = '#ffc859';
                                        }else{
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out'){
                                        $sat_logtime = date('h:i A',strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sat_status = '#ffc859';
                                        }else{
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out'){
                                        $sat_logtime = date('h:i A',strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sat_status = '#ffc859';
                                        }else{
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[6]):
                                    if ($log->action == 'Check in'){
                                        $sun_logtime = date('h:i A',strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sun_status = '#ffc859';
                                        }else{
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in'){
                                        $sun_logtime = date('h:i A',strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sun_status = '#ffc859';
                                        }else{
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out'){
                                        $sun_logtime = date('h:i A',strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sun_status = '#ffc859';
                                        }else{
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out'){
                                        $sun_logtime = date('h:i A',strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual'){
                                            $sun_status = '#ffc859';
                                        }else{
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    break;
                            }
                            // Check current status
                            if ($attn->status == 1 && $log->action == 'Check in'){
                                $status = 'In';
                            }elseif ($attn->status == 1 && $log->action == 'Break in'){
                                $status = 'On Break';
                            }elseif ($attn->status == 1 && $log->action == 'Break out'){
                                $status = 'Back to work';
                            }elseif($attn->status == 0 && $log->action == 'Check out'){
                                $status = 'Out';
                            }
                        }
                    }
                }
            }

            //Check if there is a missing entry
            if ($mon_logtime == null && $week_check[0] < date('Y-m-d') && $attn_user == $user_id){
                $mon_status = '#f71111bf';
            }
            if ($tue_logtime == null && $week_check[1] < date('Y-m-d') && $attn_user == $user_id){
                $tue_status = '#f71111bf';
            }
            if ($wed_logtime == null && $week_check[2] < date('Y-m-d') && $attn_user == $user_id){
                $wed_status = '#f71111bf';
            }
            if ($thu_logtime == null && $week_check[3] < date('Y-m-d') && $attn_user == $user_id){
                $thu_status = '#f71111bf';
            }
            if ($fri_logtime == null && $week_check[4] < date('Y-m-d') && $attn_user == $user_id){
                $fri_status = '#f71111bf';
            }
            if ($sat_logtime == null && $week_check[5] < date('Y-m-d') && $attn_user == $user_id){
                $sat_status = '#f71111bf';
            }
            if ($sun_logtime == null && $week_check[6] < date('Y-m-d') && $attn_user == $user_id){
                $sun_status = '#f71111bf';
            }

        $display .= '<tr>';
        $display .= '<td class="center"><input type="radio" name="selected" data-photo="'.$user_photo.'" data-attn="'.$attn_id.'" data-name="'.$name.'" value="'.$user_id.'"></td>';
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
            $mon_status = '#ffffff';
            $tue_status = '#ffffff';
            $wed_status = '#ffffff';
            $thu_status = '#ffffff';
            $fri_status = '#ffffff';
            $sat_status = '#ffffff';
            $sun_status = '#ffffff';
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
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

        $this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        $this->page_data['total_users'] = $this->users_model->getTotalUsers();
        $this->page_data['no_logged_in'] = $this->timesheet_model->getTotalUsersLoggedIn();
        $this->page_data['in_now'] = $this->timesheet_model->getInNow();
        $this->page_data['out_now'] = $this->timesheet_model->getOutNow();
        $this->page_data['logs'] = $this->timesheet_model->getTimesheetLogs();
//        $this->page_data['week_duration'] = $this->timesheet_model->getWeekTotalDuration();
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
        $this->page_data['schedules'] = $this->timesheet_model->getTimeSheetSettings();
        $this->page_data['tasks'] = $this->timesheet_model->getTimeSheetDay();
        //Employee's attendance
        $this->page_data['emp_attendance'] = $this->timesheet_model->getUserAttendance();
        $this->page_data['emp_logs'] = $this->timesheet_model->getUserLogs();
        //PTO
        $this->page_data['pto'] = $this->timesheet_model->getPTO();

        $this->load->view('users/timesheet_attendance', $this->page_data);
    }

    public function inNow(){
	    $this->db->or_where('DATE(date_created)',date('Y-m-d'));
//	    $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
	    $query = $this->db->get_where('timesheet_attendance',array('status' => 1));
	    echo json_encode($query->num_rows());
    }
    public function outNow(){
        $total_user = $this->users_model->getTotalUsers();
        $query = $this->db->get_where('timesheet_attendance',array('status' => 0,'DATE(date_created)'=>date('Y-m-d')));
        echo json_encode($total_user - $query->num_rows());
    }
    public function loggedInToday(){
        $total_users = $this->users_model->getTotalUsers();
        $this->db->or_where('DATE(date_created)',date('Y-m-d'));
        $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        $query =  $this->db->get('timesheet_attendance');
        $logged_in = $query->num_rows();
        echo json_encode($total_users - $logged_in);
    }

    public function checkingInEmployee(){
        $user_id = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $entry = $this->input->post('entry');
        $approved_by = logged('id');
        $query = $this->timesheet_model->checkInEmployee($user_id,$entry,$approved_by,$company_id);
        if ($query != 0){
            echo json_encode($query);
        }elseif($query == false){
            echo json_encode(false);
        }
    }

    public function checkingOutEmployee(){
        $user_id = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $attn_id = $this->input->post('attn_id');
//        $week_id = $this->input->post('week_id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->checkingOutEmployee($user_id,$attn_id,$entry,$approved_by,$company_id);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function breakIn(){
        $user_id = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->breakIn($user_id,$entry,$approved_by,$company_id);
        if ($query != null){
            echo json_encode(date('h:i A',$query));
        }else{
            echo json_encode(0);
        }
    }
    public function breakOut(){
        $user_id = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->breakOut($user_id,$entry,$approved_by,$company_id);
        if ($query != 0){
            echo json_encode(date('h:i A',$query));
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

	public function addingProjects(){
	    $project = $this->input->post('values[project]');
	    $start_date = $this->input->post('values[start_date]');
	    $start_time = $this->input->post('values[start_time]');
	    $end_time = $this->input->post('values[end_time]');
	    $user_id = $this->input->post('values[team_member]');
	    $timezone = $this->input->post('timezone');
	    $notes = $this->input->post('values[notes]');
	    $duration = $this->input->post('duration');
        $week = $this->input->post('values[week]');

	    $data = array(
	        'project' => $project,
            'start_date' => date('Y-m-d',strtotime($start_date)),
            'start_time' => date('H:i',strtotime($start_time)),
            'end_time' => date('H:i',strtotime($end_time)),
            'user_id' => $user_id,
            'timezone' => $timezone,
            'notes' => strip_tags($notes),
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
	    $ts_query = $this->db->get_where('timesheet_schedule',array('id'=>$timesheet_id));
	    if ($day_id != null){
            $ts_day = $this->db->get_where('ts_schedule_day',array('id'=>$day_id));
        }
        $users = $this->db->get_where('users',array('id'=> $ts_query->row()->user_id));
	    $employee_name = ($ts_query->row()->user_id != 0)?$users->row()->FName." ".$users->row()->LName:"Teammates";

        $data = new stdClass();
	    $data->project_name = $ts_query->row()->project_name;
	    $data->team_member = $employee_name;
	    $data->timezone = $ts_query->row()->timezone;
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

//    public function addingTotalInDay(){
//	    $id = $this->input->post('id');
//	    $day = $this->input->post('day');
//        $date = $this->input->post('day_date');
//        $total = $this->input->post('total');
//        $user_id = $this->input->post('user_id');
//        $update = array('date'=>$date,'total_duration'=>$total,'day'=>$day,'users_id'=>$user_id);
//        $this->timesheet_model->addingTotalInDay($update,$id);
//    }

//    public function updateTotalDuration(){
//	    $week = $this->input->post('week');
//	    $date = $this->input->post('date');
//	    $total = $this->input->post('total');
//	    $user_id = $this->input->post('user_id');
//	    $twd_id = $this->input->post('twd_id');
//	    $update = array('date'=>$date,'total_duration'=>$total);
//	    $this->timesheet_model->updateTotalDuration($update,$week,$twd_id,$user_id);
//    }

    public function getProjectData(){
	    $id = $this->input->get('id');
	    $project = $this->db->get_where('timesheet_schedule',array('id'=>$id))->result();

	    $data = new stdClass();
	    $data->name = $project[0]->project_name;
	    $data->user_id = $project[0]->user_id;
	    $data->timezone = $project[0]->timezone;;
	    $data->notes = $project[0]->notes;

	    echo json_encode($data);
    }

    public function updateTSProject(){
	    $id = $this->input->post('id');
	    $name = $this->input->post('values[project]');
        $notes = $this->input->post('values[notes]');
        $timezone = $this->input->post('timezone');
        $update = array(
            'project_name' => $name,
            'timezone' => $timezone,
            'notes' => strip_tags($notes)
        );
	    $query = $this->timesheet_model->updateTSProject($id,$update);
	    if ($query == true){
	        echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function deleteProjectData(){
	    $id = $this->input->post('id');
	    //Deleting in timesheet_settings table
	    $this->db->where('id',$id);
	    $this->db->delete('timesheet_schedule');
	    //Deleting in ts_settings_day table
        $this->db->where('schedule_id',$id);
        $this->db->delete('ts_schedule_day');
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
        $monday_sched = 'No data';
        $tuesday_sched = 'No data';
        $wednesday_sched ='No data';
        $thursday_sched = 'No data';
        $friday_sched = 'No data';
        $saturday_sched = 'No data';
        $sunday_sched = 'No data';
        $day_id_mon = null;
        $day_id_tue = null;
        $day_id_wed = null;
        $day_id_thu = null;
        $day_id_fri = null;
        $day_id_sat = null;
        $day_id_sun = null;
        $date_this_week = array(
            "Monday" => date("M d",strtotime('monday this week',strtotime($week_convert))),
            "Tuesday" => date("M d",strtotime('tuesday this week',strtotime($week_convert))),
            "Wednesday" => date("M d",strtotime('wednesday this week',strtotime($week_convert))),
            "Thursday" => date("M d",strtotime('thursday this week',strtotime($week_convert))),
            "Friday" => date("M d",strtotime('friday this week',strtotime($week_convert))),
            "Saturday" => date("M d",strtotime('saturday this week',strtotime($week_convert))),
            "Sunday" => date("M d",strtotime('sunday this week',strtotime($week_convert))),
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
                    $monday_sched = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                    $monday = $days->duration."h";;
                }elseif ($days->day == "Tuesday"){
                    $day_id_tue = $days->id;
                    $tuesday_sched = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                    $tuesday = $days->duration."h";;
                }elseif ($days->day == "Wednesday"){
                    $day_id_wed = $days->id;
                    $wednesday_sched = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                    $wednesday = $days->duration."h";
                }elseif ($days->day == "Thursday"){
                    $day_id_thu = $days->id;
                    $thursday_sched = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                    $thursday = $days->duration."h";;
                }elseif ($days->day == "Friday"){
                    $day_id_fri = $days->id;
                    $friday_sched = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                    $friday = $days->duration."h";;
                }elseif ($days->day == "Saturday"){
                    $day_id_sat = $days->id;
                    $saturday_sched =date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                    $saturday = $days->duration."h";;
                }elseif ($days->day == "Sunday"){
                    $day_id_sun = $days->id;
                    $sunday_sched = date('ga',strtotime($days->start_time))."-".date('ga',strtotime($days->end_time));
                    $sunday = $days->duration."h";
                }
            }

            $display .= '<tr data-id="'.$timesheet_id.'" id="tsSettingsRow">';
                $display .= '<td style="min-width: 100px"><i class="fa fa-circle ts-status"></i><span class="ts-project-name" id="showEditPen">'.ucfirst($setting->project_name).'</span><a href="#" id="showProjectData" data-toggle="tooltip" title="" data-original-title="test" data-id="'.$setting->id.'" data-name="'.ucfirst($setting->project_name).'"><i class="fa fa-pencil-alt"></i></a></td>';
                $display .= '<td><input type="text" name="monday" data-day="Monday" id="tsMonday" data-date="'.$date_week_check[0].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_mon.'" data-user="'.$user_id.'" value="'.$monday.'" readonly><span class="duration-tip">'.$monday_sched.'</span></td>';
                $display .= '<td><input type="text" name="tuesday" data-day="Tuesday" id="tsTuesday" data-date="'.$date_week_check[1].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_tue.'" data-user="'.$user_id.'" value="'.$tuesday.'" readonly><span class="duration-tip">'.$tuesday_sched.'</span></td>';
                $display .= '<td><input type="text" name="wednesday" data-day="Wednesday" id="tsWednesday" data-date="'.$date_week_check[2].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_wed.'" data-user="'.$user_id.'" value="'.$wednesday.'" readonly><span class="duration-tip">'.$wednesday_sched.'</span></td>';
                $display .= '<td><input type="text" name="thursday" data-day="Thursday" id="tsThursday" data-date="'.$date_week_check[3].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_thu.'" data-user="'.$user_id.'" value="'.$thursday.'" readonly><span class="duration-tip">'.$thursday_sched.'</span></td>';
                $display .= '<td><input type="text" name="friday" data-day="Friday" id="tsFriday" data-date="'.$date_week_check[4].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_fri.'" data-user="'.$user_id.'" value="'.$friday.'" readonly><span class="duration-tip">'.$friday_sched.'</span></td>';
                $display .= '<td><input type="text" name="saturday" data-day="Saturday" id="tsSaturday" data-date="'.$date_week_check[5].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_sat.'" data-user="'.$user_id.'" value="'.$saturday.'" readonly><span class="duration-tip">'.$saturday_sched.'</span></td>';
                $display .= '<td><input type="text" name="sunday" data-day="Sunday" id="tsSunday" data-date="'.$date_week_check[6].'" class="form-control ts-duration ts-duration'.$timesheet_id.'" data-id="'.$day_id_sun.'" data-user="'.$user_id.'" value="'.$sunday.'" readonly><span class="duration-tip">'.$sunday_sched.'</span></td>';
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
            $monday_sched = 'No data';
            $tuesday_sched = 'No data';
            $wednesday_sched ='No data';
            $thursday_sched = 'No data';
            $friday_sched = 'No data';
            $saturday_sched = 'No data';
            $sunday_sched = 'No data';
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
                $display .= '<td><input type="text" class="form-control ts-duration" readonly disabled></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly disabled></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly disabled></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly disabled></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly disabled></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly disabled></td>';
                $display .= '<td><input type="text" class="form-control ts-duration" readonly disabled></td>';
                $display .= '<td><span style="color: #92969d;">0h</span></td>';
                $display .= '<td><a href="#"><i class="fa fa-times fa-lg" disabled></i></a></td>';
            $display .= '</tr>';
            endif;
	    $display .= '</tbody>';
	    $display .= '<tfoot>';
            $display .= '<tr>';
                $display .= '<th>Total</th>';
                $display .= '<th><span id="totalMonday"></span></th>';
                $display .= '<th><span id="totalTuesday"></span></th>';
                $display .= '<th><span id="totalWednesday"></span></th>';
                $display .= '<th><span id="totalThursday"></span></th>';
                $display .= '<th><span id="totalFriday"></span></th>';
                $display .= '<th><span id="totalSaturday"></span></th>';
                $display .= '<th><span id="totalSunday"></span></th>';
                $display .= '<th><span id="totalWeekDuration"></span></th>';
                $display .= '<th></th>';
            $display .= '</tr>';
	    $display .= '</tfoot>';
	    echo json_encode($display);
    }
    public function savedPTO(){
	    $id = $this->input->post('id');
	    $type = $this->input->post('type');
	    $query = $this->timesheet_model->savedPTO($id,$type);
	    echo json_encode(1);
    }
    public function removePTO(){
	    $id = $this->input->post('id');
	    $this->db->where('id',$id);
	    $this->db->delete('timesheet_pto');
	    echo json_encode(1);
    }

    public function getPTOList(){
        $name = $this->input->get('search');
        $pto = $this->timesheet_model->getPTOByName($name);
        $data = array();
        foreach ($pto as $list){
            $data[] = array(
                'id' =>   $list->id,
                'text' => $list->name
            );
        }
        echo json_encode($data);
    }
    //Employee requesting for leave
    public function employeeRequestLeave(){
        $pto = $this->input->post('values[pto]');
        $date = $this->input->post('array');
        $query = $this->timesheet_model->employeeRequestLeave($pto,$date);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    //Approving leave request
    public function approveRequest(){
	    $id = $this->input->post('id');
	    $query = $this->db->get_where('timesheet_leave',array('id'=>$id));
	    if ($query->num_rows() == 1){
	        $update = array('status' => 1);
	        $this->db->where('id',$id);
	        $this->db->update('timesheet_leave',$update);
	        echo json_encode($id);
        }else{
            echo json_encode(0);
        }
    }
    //Deny leave request
    public function denyRequest(){
        $id = $this->input->post('id');
        $query = $this->db->get_where('timesheet_leave',array('id'=>$id));
        if ($query->num_rows() == 1){
            $update = array('status' => 2);
            $this->db->where('id',$id);
            $this->db->update('timesheet_leave',$update);
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function getEmployees(){
	    $name = $this->input->get('search');
	    $users = $this->users_model->getUsersByName($name);
	    $roles = $this->users_model->getRoles();
        $data = array();
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
//    public function serverTime(){
//	    $duration = '60 minute';
//	    $query = $this->db->get_where('user_break',array('user_id'=>$this->session->userdata('logged')['id'],'date'=>date('Y-m-d')));
//	    if ($query->num_rows() == 1){
//            $result = $query->result();
//            $remaining_time = explode(":",$result[0]->duration);
//            $duration = $remaining_time[0].' minute '.$remaining_time[1].' second';
//        }
//
//	    $date_time = date('M d, Y H:i:s');
//        $end_time = date('M d, Y H:i:s', strtotime($duration));
//	    $data = new stdClass();
//	    $data->date_time = $date_time;
//	    $data->end_time = $end_time;
//	    echo json_encode($data);
//    }
    public function clockInEmployee(){


	    $clock_in = time();
	    $user_id = $this->session->userdata('logged')['id'];

        $attendance = array(
            'user_id' => $user_id,
//            'date_in' => date('Y-m-d'),
//            'date_out' => date('Y-m-d'),
            'status' => 1
        );
        $this->db->insert('timesheet_attendance',$attendance);
        $attn_id = $this->db->insert_id();
        $check_attendance = $this->db->get_where('timesheet_attendance',array('id'=>$attn_id));
        if ($check_attendance->num_rows() == 1){
            $logs_insert = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check in',
                'user_location' => $this->timesheet_model->employeeCoordinates(),
                'user_location_address' => $this->employeeAddress(),
                'date_created' => date('Y-m-d H:i:s',$clock_in),
                'entry_type' => 'Normal',
                'company_id' => getLoggedCompanyID()
            );
            $this->db->insert('timesheet_logs',$logs_insert);
        }

        if($this->db->affected_rows() != 1){
            echo json_encode(0);
        }else{
            $data = new stdClass();
            $data->clock_in_time = date('h:i A',$clock_in);
            $data->clock_out_time = 'Pending...';
            $data->attendance_id = $attn_id;
            echo json_encode($data);
        }

    }
    


    public function clockOutEmployee(){
        $attn_id = $this->input->post('attn_id');
        $clock_out = 0;
        $sched_clockOut = $this->input->post('time');
        if ($sched_clockOut == 0 || $sched_clockOut == null){
            $clock_out = time();
        }else{
            $clock_out = ($sched_clockOut / 1000);
        }

        $user_id = $this->session->userdata('logged')['id'];
        $check_attn = $this->db->get_where('timesheet_attendance',array('id' => $attn_id,'user_id' => $user_id));
        if ($check_attn->num_rows() == 1){
            $out = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check out',
                'user_location' => $this->timesheet_model->employeeCoordinates(),
                'user_location_address' => $this->employeeAddress(),
                'date_created' => date('Y-m-d H:i:s',$clock_out),
                'entry_type' => 'Normal',
                'company_id' => getLoggedCompanyID()
            );
            $this->db->insert('timesheet_logs',$out);
            $shift_duration = $this->timesheet_model->calculateShiftDuration($attn_id);
//            $break_duration = $this->timesheet_model->calculateBreakDuration($attn_id);
            $overtime = $this->timesheet_model->calculateOvertime($user_id,$attn_id);
            $update = array(
                'shift_duration' => $shift_duration,
//                'break_duration' => $break_duration,
                'overtime' => $overtime,
//                'date_out' => date('Y-m-d'),
                'status' => 0
            );
            $this->db->where('id',$attn_id);
            $this->db->update('timesheet_attendance',$update);
            $affected_row = $this->db->affected_rows();

            if($affected_row != 1){
                echo json_encode(0);
            }else{
                $data = new stdClass();
                $data->clock_out_time = date('h:i A',$clock_out);
                $data->attendance_id = $attn_id;
                $data->shift_duration = $shift_duration;
                echo json_encode($data);
            }

        }
    }

    public function lunchInEmployee(){
//	    $end_break = $this->input->post('end_of_break');
        $attn_id = $this->input->post('attn_id');
        $lunch_in = time();
        $timestamp = 0;
        $latest_in = 0;
        $user_id = $this->session->userdata('logged')['id'];
        $lunch = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break in',
            'user_location' => $this->timesheet_model->employeeCoordinates(),
            'user_location_address' => $this->employeeAddress(),
            'date_created' => date('Y-m-d H:i:s',$lunch_in),
            'entry_type' => 'Normal',
            'company_id' => getLoggedCompanyID()
        );
        $this->db->insert('timesheet_logs',$lunch);
        $break_duration = $this->db->get_where('timesheet_attendance',array('id'=>$attn_id));
        if ($break_duration->num_rows() == 1){
            if ($break_duration->row()->break_duration > 0){
                $timestamp = $lunch_in - ($break_duration->row()->break_duration * 60);
                $latest_in = $lunch_in;
            }else{
                $timestamp = $lunch_in;
            }
        }

        $data = new stdClass();
        $data->lunch_in = date('h:i A',$lunch_in);
        $data->timestamp = $timestamp;
        $data->latest_in = $latest_in;
        echo json_encode($data);
    }

    public function lunchOutEmployee(){
        $attn_id = $this->input->post('attn_id');
        $pause_time = $this->input->post('pause_time');
        $lunch_out = time();
        $user_id = $this->session->userdata('logged')['id'];
//        $check = $this->db->get_where('timesheet_logs',array('attendance_id'=>$attn_id,'action'=>'Break out'));
//        if ($check->num_rows() == 0){
            $lunch = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Break out',
                'user_location' => $this->timesheet_model->employeeCoordinates(),
                'user_location_address' => $this->employeeAddress(),
                'date_created' => date('Y-m-d H:i:s',$lunch_out),
                'entry_type' => 'Normal',
                'company_id' => getLoggedCompanyID()
            );
            $this->db->insert('timesheet_logs',$lunch);
//        }
        //Update break duration
        $update = $this->db->get_where('timesheet_attendance',array('id'=>$attn_id));
        if ($update->num_rows() == 1){
            $timeArr = explode(':', $pause_time);
            $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
            $this->db->set('break_duration', 'break_duration+'.$decTime, FALSE);
            $this->db->where('id',$attn_id)->update('timesheet_attendance');
        }

        $data = new stdClass();
        $data->lunch_time = date('h:i A',$lunch_out);

        echo json_encode($data);
    }

    private function employeeAddress(){

        $ipaddress = $this->gtMyIpGlobal();

        $get_location = json_decode(file_get_contents('http://ip-api.com/json/'.$ipaddress));
        $lat = $get_location->lat;
        $lng = $get_location->lon;
        $g_map = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=true&key=AIzaSyBK803I2sEIkUtnUPJqmyClYQy5OVV7-E4');
        $output = json_decode($g_map);
        $status = $output->status;
        $address = ($status=="OK")?$output->results[1]->formatted_address:'Address not found';
        return $address;
    }

    public function overtimeApproval(){
	    $status = $this->input->post('status');
	    $attn_id = $this->input->post('attn_id');
        $attendance = $this->db->get_where('timesheet_attendance',array('id'=>$attn_id));
        if ($attendance->num_rows() == 1){
            $update=array('overtime_status'=>$status);
            $this->db->where('id',$attn_id);
            $this->db->update('timesheet_attendance',$update);
            echo json_encode(1);
        }

    }

    public function notifyStartSchedule(){
        $ts_settings = getEmpTSsettings();
        $schedule = getEmpSched();
        $time = 0;
        $tz = null;
        foreach ($ts_settings as $setting){
            foreach ($schedule as $item){
                if ($setting->id == $item->schedule_id){
                    $tz = $setting->timezone;
                    $time= ltrim(date('hA',strtotime($item->start_time)), 0);
                }
            }
        }
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('user_notification',array('user_id' => $user_id,'title' => 'Your shift will start soon.','date_created' => date('Y-m-d h:i:s')));
        if ($qry->num_rows() == 0){
            $data_notify = array(
                'user_id' => $user_id,
                'title' => 'Your shift will begin soon.',
                'content' => 'Shift start at '.$time." (".$tz.")",
                'date_created' => date('Y-m-d h:i:s'),
                'status' => 1
            );
            $this->db->insert('user_notification',$data_notify);
        }
        echo json_encode($this->notificationBell());
    }

    public function notifyEndSchedule(){
        $ts_settings = getEmpTSsettings();
        $schedule = getEmpSched();
        $time = 0;
        $tz = null;
        foreach ($ts_settings as $setting){
            foreach ($schedule as $item){
                if ($setting->id == $item->schedule_id){
                    $tz = $setting->timezone;
                    $time= ltrim(date('hA',strtotime($item->end_time)), 0);
                }
            }
        }
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('user_notification',array('user_id' => $user_id,'title' => 'Your shift will end soon.','date_created' => date('Y-m-d h:i:s')));
        if ($qry->num_rows() == 0){
            $data_notify = array(
                'user_id' => $user_id,
                'title' => 'Your shift will end soon.',
                'content' => 'Shift end at '.$time." (".$tz.")",
                'date_created' => date('Y-m-d h:i:s'),
                'status' => 1
            );
            $this->db->insert('user_notification',$data_notify);
        }
        echo json_encode($this->notificationBell());
    }

    public function notificationBell(){
        $notification = '';
        $notify = $this->db->order_by('id',"desc")->limit(1)->get('user_notification')->result();
        foreach ($notify as $value){
            if ($value->status == 1){
                $bg = '#e6e3e3';
            }else{
                $bg = '#f8f9fa';
            }
            $notification .= '<a href="'.site_url().'timesheet/attendance" id="notificationDP" data-id="'.$value->id.'" class="dropdown-item notify-item active" style="background-color: '.$bg.'">';
            $notification .= '<div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>';
            $notification .= '<p class="notify-details">'.$value->title.'<span class="text-muted">'.$value->content.'</span></p>';
            $notification .= '</a>';
        }
        return $notification;
    }

    public function readNotification(){
	    $id = $this->input->post('id');
	    $query = $this->db->get_where('user_notification',array('id'=>$id));
	    if ($query->num_rows() == 1){
	        $readed = array('status' => 0);
	        $this->db->where('id',$id);
	        $this->db->update('user_notification',$readed);
        }
    }

    //Invite link entry
    public function inviteLinkEntry(){
        $email = $this->input->post('values[email]');
        $name = $this->input->post('values[name]');
        $role = $this->input->post('values[role]');
        $query = $this->timesheet_model->inviteLinkEntry($email,$name,$role);
        if ($query != null){
            if ($this->sendEmailInviteLink($email,$name,$query) == true){
                echo json_encode(1);
            }
        }else{
            echo json_encode(0);
        }

    }
    public function sendEmailInviteLink($email,$name,$code){
        $data = array(
            'name' => $name,
            'link' => $code
        );
        //Load email library
        $this->load->library('email');
        $config = array(
            'smtp_crypto' => 'ssl',
            'protocol' => 'smtp',
            'smtp_host' => 'mail.nsmartrac.com',
            'smtp_port' => 465,
            'smtp_user' => 'no-reply@nsmartrac.com',
            'smtp_pass' => 'g0[05_rEa3?%',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('no-reply@nsmartrac.com','nSmartrac');
        $this->email->to($email);
        $this->email->subject('nSmartrac invitation');
        $message = $this->load->view('users/invite_link_template',$data,TRUE);
        $this->email->message($message);
        //Send mail
        $this->email->send();
        return true;
    }

    //Department
//    Adding department
    public function addDepartment(){
	    $dept = $this->input->post('dept');
	    $query = $this->timesheet_model->addDepartment($dept);
	    if ($query == 1){
	        echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    //Deleting department
    public function removeDepartment(){
	    $id = $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->delete('timesheet_departments');
        echo json_encode(1);
    }
    //Show department update page
    public function showDeptUpdate(){
	    $dept_id = $this->input->get('dept_id');
	    $query = $this->db->get_where('timesheet_departments',array('id' => $dept_id));
        $output = '<div class="department-edit-view">
                    <div class="dept-header">
                        <a href="javascript:void(0)" id="deptBckBtn"><i class="fas fa-arrow-left fa-lg" style="margin-right: 10px;color: #a2a2a2;"></i></a> <h3>'.$query->row()->name.'</h3> <a href="javascript:void(0)" title="Edit" data-toggle="tooltip" id="deptEditName"><i class="fas fa-pencil-alt"></i></a>
                    </div>
                    <div class="dept-sub-header">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="sub-header-title">Name</span>
                            </div>
                            <div class="col-md-6">
                                <span class="sub-header-title">Role</span>
                            </div>
                        </div>
                    </div>
                    <div class="dept-role-title">
                        <h6>Managers</h6>
                    </div>
                    <div class="dept-role-add">
                        <a href="javascript:void(0)">
                            <i class="fas fa-plus fa-lg"></i> <span class="dept-add-btn">Add Managers</span>
                        </a>
                    </div>
                    <div class="dept-role-title">
                        <h6>Members</h6>
                    </div>
                    <div class="dept-role-add">
                        <a href="javascript:void(0)" id="deptAddMembers">
                            <i class="fas fa-plus fa-lg"></i> <span class="dept-add-btn">Add Members</span>
                        </a>
                    </div>
                </div>';


        echo json_encode($output);
    }
    //Workweek and Overtime settings
    public function workweekOvertimeSettings(){
        $start_day = $this->input->post('values[start_day]');
        $hours_week = $this->input->post('values[hours_week]');
        $hours_day = $this->input->post('values[hours_day]');
        $overtime = $this->input->post('values[overtime]');
        $data = array(
            'start_day' => $start_day,
            'hours_week' => $hours_week,
            'hours_day' => $hours_day,
            'overtime' => $overtime
        );
        $query = $this->timesheet_model->workweekOvertimeSettings($data);
        if ($query == true){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }
    //Break Preference
    public function breakPreference(){
	    $break_rule = $this->input->post('values[break_rule]');
	    $type = $this->input->post('values[type]');
	    if ($break_rule == 'Manual'){
	        $length = null;
        }else{
            $length = $this->input->post('values[length]');
        }
	    $data = array(
	        'break_rule' => $break_rule,
            'type' => $type,
            'length' => $length
        );
	    $query = $this->timesheet_model->breakPreference($data);
	    if ($query == true){
	        echo json_encode(1);
        }else{
	        echo json_encode(0);
        }
    }

//    Email Report for Timesheet test page
    public function email(){
	    $page = array(
	        'last_week' => $this->timesheet_model->getLastWeekTotalDuration()
        );
        $this->load->view('users/email_template',$page);
    }
    //Invite link email for test page
    public function invite(){
	    $data = array('name'=>'Tommy Nguyen','link'=>sha1(rand()));
        $this->load->view('users/invite_link_template',$data);
    }

    

}



/* End of file Users.php */

/* Location: ./application/controllers/Users.php */