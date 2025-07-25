<?php

defined('BASEPATH') or exit('No direct script access allowed');

define("FIREBASE_API_KEY", "AAAAGdnNhSA:APA91bERYT0vPfk5mH7M_UYgIDTdLDLgEsTUDue9WJRbsqhpTXOPwsamzXoUB0BmaFJxoXX5p2RzSy_cvI96uolp0_iZV2FuQgUjusGbVDVtshbBzGLTZYhIiSqt5lbsuXV9lNsnaLOk");

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Timesheet extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->hasAccessModule(77);
        $this->page_data['page']->title = 'Timesheet Management';

        $this->page_data['page']->menu = 'users';
        add_css(array(
            "assets/css/timesheet.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/plugins/country-picker-flags/build/css/countrySelect.css",
            "assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css",
            //            "https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css"
            //    "https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css",
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/plugins/jQuery-Mask-Plugin-master/dist/jquery.mask.js",
            "assets/plugins/country-picker-flags/build/js/countrySelect.js",
            "assets/plugins/timezone-picker/dist/timezones.full.js",
            "assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"

            //            "https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js",
            //            "https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js",
        ));
    }



    public function tester()
    {
        $file = fopen(APPPATH . '../timesheet/timelogs/' . 'tesaasasat.csv', 'wb');

        // set the column headers
        fputcsv($file, array('Column 1', 'Column 2', 'Column 3', 'Column 4', 'Column 5'));

        // Sample data. This can be fetched from mysql too
        $data = array(
            array('Data 11', 'Data 12', 'Data 13', 'Data 14', 'Data 15'),
            array('Data 21', 'Data 22', 'Data 23', 'Data 24', 'Data 25'),
            array('Data 31', 'Data 32', 'Data 33', 'Data 34', 'Data 35'),
            array('Data 41', 'Data 42', 'Data 43', 'Data 44', 'Data 45'),
            array('Data 51', 'Data 52', 'Data 53', 'Data 54', 'Data 55')
        );

        // output each row of the data
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
    }

    public function employee()
    {
        if(!checkRoleCanAccessModule('user-timesheet', 'read')){
			show403Error();
			return false;
		}

        $this->page_data['page']->title = 'Employees Timesheet';
        $this->page_data['page']->parent = 'timesheet';

        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

        $this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        //        $this->page_data['no_logged_in'] = $this->timesheet_model->getTotalUsersLoggedIn();
        //        $this->page_data['in_now'] = $this->timesheet_model->getInNow();
        //        $this->page_data['out_now'] = $this->timesheet_model->getOutNow();
        $this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
        $this->page_data['week_duration'] = $this->timesheet_model->getLastWeekTotalDuration();
        $date_this_week = array(
            "Monday" => date("M d,y", strtotime('monday this week')),
            "Tuesday" => date("M d,y", strtotime('tuesday this week')),
            "Wednesday" => date("M d,y", strtotime('wednesday this week')),
            "Thursday" => date("M d,y", strtotime('thursday this week')),
            "Friday" => date("M d,y", strtotime('friday this week')),
            "Saturday" => date("M d,y", strtotime('saturday this week')),
            "Sunday" => date("M d,y", strtotime('sunday this week')),
        );
        $this->page_data['date_this_week'] = $date_this_week;        
        $this->load->view('v2/pages/users/timesheet_employee', $this->page_data);
    }


    public function schedule()
    {
        add_css(array(
            "assets/css/timesheet/timesheet_schedule.css"
        ));
        add_footer_js(array(
            "assets/js/timesheet/timesheet_schedule.js",

        ));
        $this->page_data['page']->title = 'Time Schedule';
        $this->page_data['page']->parent = 'timesheet';

        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

        $this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        //    $this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
        $date_this_week = array(
            "Monday" => date("M d", strtotime('monday this week')),
            "Tuesday" => date("M d", strtotime('tuesday this week')),
            "Wednesday" => date("M d", strtotime('wednesday this week')),
            "Thursday" => date("M d", strtotime('thursday this week')),
            "Friday" => date("M d", strtotime('friday this week')),
            "Saturday" => date("M d", strtotime('saturday this week')),
            "Sunday" => date("M d", strtotime('sunday this week'))
        );
        $this->page_data['date_this_week'] = $date_this_week;

        $this->load->view('v2/pages/users/timesheet_schedule', $this->page_data);
    }

    public function list()
    {
        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

        //        $this->page_data['timesheet_users'] = $this->timesheet_model->getClockIns();
        $this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        $this->page_data['ts_logs'] = $this->timesheet_model->getTimesheetLogs();
        //        $this->page_data['in_now'] = $this->timesheet_model->getInNowData();
        $date_this_week = array(
            "Monday" => date("M d,y", strtotime('monday this week')),
            "Tuesday" => date("M d,y", strtotime('tuesday this week')),
            "Wednesday" => date("M d,y", strtotime('wednesday this week')),
            "Thursday" => date("M d,y", strtotime('thursday this week')),
            "Friday" => date("M d,y", strtotime('friday this week')),
            "Saturday" => date("M d,y", strtotime('saturday this week')),
            "Sunday" => date("M d,y", strtotime('sunday this week'))
        );
        $this->page_data['date_this_week'] = $date_this_week;

        $this->load->view('users/timesheet-list', $this->page_data);
    }

    public function requests()
    {
        add_css(array(
            "assets/css/timesheet/timesheet_employee_requests.css"
        ));

        add_footer_js(array(
            "assets/js/timesheet/timesheet_employee_requests.js",
            "assets/js/timesheet/timesheet_requests.js"

        ));
        $this->page_data['page']->title = 'Requests';
        $this->page_data['page']->parent = 'timesheet';

        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

        //    $this->page_data['users1']= $this->users_model->getById(getLoggedUserID());
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
        if ($this->uri->segment(3) != null) {
            $dept_id = $this->uri->segment(3);
            $this->page_data['dept_id'] = $this->timesheet_model->getDepartmentById($dept_id);
        }

        $date_this_week = array(
            "Monday" => date("M d", strtotime('monday this week')),
            "Tuesday" => date("M d", strtotime('tuesday this week')),
            "Wednesday" => date("M d", strtotime('wednesday this week')),
            "Thursday" => date("M d", strtotime('thursday this week')),
            "Friday" => date("M d", strtotime('friday this week')),
            "Saturday" => date("M d", strtotime('saturday this week')),
            "Sunday" => date("M d", strtotime('sunday this week'))
        );
        $this->page_data['date_this_week'] = $date_this_week;

        $this->load->view('v2/pages/users/timesheet_requests', $this->page_data);
    }

    // added for tracking Time Log of employees
    public function timelog()
    {
        if(!checkRoleCanAccessModule('user-settings', 'read')){
			show403Error();
			return false;
		}

        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        //ifPermissions('users_list');
        $user_id = logged('id');
        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);

        $this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());

        $this->page_data['users'] = $this->users_model->getUsers();


        $this->load->view('users/timelog', $this->page_data);
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


    public function tracklocation()
    {
        //    ifPermissions('users_list');

        //    $this->page_data['users1']= $this->users_model->getById(getLoggedUserID());

        //    $this->page_data['users'] = $this->users_model->getUsers();


        $this->load->view('users/tracklocation', $this->page_data);
    }


    public function insert_cOut_cIn_Location()
    {
        $data = $this->input->post();
        $cIn_cOut_exist = $this->timesheet_model->get_cOut_cIn_Location(logged('company_id'));

        if ($cIn_cOut_exist) {
            $update = $this->timesheet_model->update_cOut_cIn_Location($data);
            $this->timesheet_model->insert_logs_for_cIn_cOut(logged('company_id'), logged('id'));
        } else {
            $insert = $this->timesheet_model->insert_cOut_cIn_Location($data);
            $this->timesheet_model->insert_logs_for_cIn_cOut(logged('company_id'), logged('id'));
        }

        $query = $this->timesheet_model->get_user_according_cIncOut_logs();

        $query2 = $this->timesheet_model->get_logs_cOut_cIn_location(logged('company_id'));
        foreach ($query2 as $q) {
            $last_update = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($q->date_created, "UTC", $this->session->userdata('usertimezone'))));
        }

        $cOutIn = new stdClass();
        $cOutIn->name = $query;
        $cOutIn->last_update = $last_update;

        echo json_encode($cOutIn);
    }

    public function getData()
    {
        $query = $this->timesheet_model->getData(logged('company_id'));
        $query2 = $this->timesheet_model->getLastResClockInPayDateLogs_allow(logged('company_id'));
        $query4 = $this->timesheet_model->getLastResClockInPayDateLogs_payday(logged('company_id'));
        $query5 = $this->timesheet_model->getLastResClockInPayDateLogs_gps(logged('company_id'));
        $query3 = $this->timesheet_model->getUsersAccordingToLogs();
        $query6 = $this->timesheet_model->get_user_according_cIncOut_logs();
        $user_payday = $this->timesheet_model->getUsersAccordingToLogs_payday();
        $user_allow = $this->timesheet_model->getUsersAccordingToLogs_allow();


        $query6 = $this->timesheet_model->get_logs_cOut_cIn_location(logged('company_id'));
        foreach ($query as $q) {
            $last_update_for_auto_view = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($q->date_updated, "UTC", $this->session->userdata('usertimezone'))));
        }
        foreach ($query6 as $q) {
            $last_update4 = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($q->date_created, "UTC", $this->session->userdata('usertimezone'))));
        }
        foreach ($query2 as $res) {
            $last_update = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($res->date_created, "UTC", $this->session->userdata('usertimezone'))));
        }
        foreach ($query4 as $res2) {
            $last_update2 = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($res2->date_created, "UTC", $this->session->userdata('usertimezone'))));
        }
        foreach ($query5 as $res3) {
            $last_update3 = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($res3->date_created, "UTC", $this->session->userdata('usertimezone'))));
        }


        $data = new stdClass();
        $data->result = $query;
        $data->payday_dateUpdated = $last_update_for_auto_view;
        $data->recent = $query2;
        $data->user   = $query3;
        $data->recent2 = $query4;
        $data->users2 = $query5;
        $data->user_payday = $user_payday;
        $data->last_update   = $last_update;
        $data->last_update2  = $last_update2;
        $data->last_update3  = $last_update3;
        $data->last_update4  = $last_update4;
        $data->user_allow = $user_allow;
        echo json_encode($data);
    }
    public function getResClockInPayDate()
    {
        $query = $this->timesheet_model->getResClockInPayDate(logged('company_id'));
        // var_dump($query);
        return $query;
    }



    public function insertResClockInPayDate_allow()
    {
        $data = $this->input->post();

        $query = $this->getResClockInPayDate(logged("company_id"));

        if ($query != null) {
            $this->timesheet_model->updateResClockInPayDate_allow($data);
            $date_created = $this->timesheet_model->insertResClockInPayDateLogs_allow();
        } else {
            $this->timesheet_model->insertResClockInPayDate_allow($data);
            $date_created = $this->timesheet_model->insertResClockInPayDateLogs_allow();
        }

        $query2 = $this->timesheet_model->getLastResClockInPayDateLogs_allow(logged('company_id'));
        $query3 = $this->timesheet_model->getUsersAccordingToLogs();
        foreach ($query2 as $res) {
            $last_update = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($date_created, "UTC", $this->session->userdata('usertimezone'))));
        }

        $data = new stdClass();
        $data->recent = $query2;
        $data->user   = $query3;
        $data->last_update   = $last_update;

        echo json_encode($data);
    }

    public function insertResClockInPayDate_gps()
    {
        $data = $this->input->post();

        $query = $this->getResClockInPayDate();


        if ($query != null) {
            $this->timesheet_model->updateResClockInPayDate_gps($data);
            $date_created = $this->timesheet_model->insertResClockInPayDateLogs_gps();
        } else {
            $this->timesheet_model->insertResClockInPayDate_gps($data);
            $date_created = $this->timesheet_model->insertResClockInPayDateLogs_gps();
        }

        $query2 = $this->timesheet_model->getLastResClockInPayDateLogs_allow(logged('company_id'));
        $query3 = $this->timesheet_model->getUsersAccordingToLogs();
        foreach ($query2 as $res) {
            $last_update = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($date_created, "UTC", $this->session->userdata('usertimezone'))));
        }

        $data = new stdClass();
        $data->recent = $query2;
        $data->user   = $query3;
        $data->last_update   = $last_update;

        echo json_encode($data);
    }

    public function insertResClockInPayDate()
    {
        $data = $this->input->post();

        $query = $this->getResClockInPayDate();

        if ($query != null) {
            $this->timesheet_model->updateResClockInPayDate($data);
            $date_created = $this->timesheet_model->insertResClockInPayDateLogs_paydate();
        } else {
            $this->timesheet_model->insertResClockInPayDate_paydate($data);
            $date_created = $this->timesheet_model->insertResClockInPayDateLogs_paydate();
        }

        $query2 = $this->timesheet_model->getLastResClockInPayDateLogs_payday(logged('company_id'));
        $query3 = $this->timesheet_model->getUsersAccordingToLogs();
        foreach ($query2 as $res) {
            $last_update = date("M d, Y h:i A", strtotime($this->datetime_zone_converter($date_created, "UTC", $this->session->userdata('usertimezone'))));
        }

        $data = new stdClass();
        $data->recent = $query2;
        $data->user   = $query3;
        $data->last_update   = $last_update;

        echo json_encode($data);
    }



    public function index()
    {
        // $user_id = logged('id');
        // $this->load->model('users_model');
        // //ifPermissions('users_list');
        // $this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());

        // $this->page_data['users'] = $this->users_model->getUsers();
        // $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        // $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);


        // $this->load->view('users/timesheet-admin', $this->page_data);
        $this->attendance();
    }

    public function notif_user_acknowledge()
    {
        $this->timesheet_model->notif_user_acknowledge();
        echo json_encode("success");
    }
    public function showEmployeeTable()
    {
        date_default_timezone_set('UTC');
        $week = $this->input->get('week');
        $week_convert = date('Y-m-d', strtotime($week));

        $start_date = $week_convert;        
        $end_date   = date("Y-m-d", strtotime("+7 day", strtotime($start_date)));

        $date_this_week = array(
            "Monday" => date("M d", strtotime('monday this week', strtotime($week_convert))),
            "Tuesday" => date("M d", strtotime('tuesday this week', strtotime($week_convert))),
            "Wednesday" => date("M d", strtotime('wednesday this week', strtotime($week_convert))),
            "Thursday" => date("M d", strtotime('thursday this week', strtotime($week_convert))),
            "Friday" => date("M d", strtotime('friday this week', strtotime($week_convert))),
            "Saturday" => date("M d", strtotime('saturday this week', strtotime($week_convert))),
            "Sunday" => date("M d", strtotime('sunday this week', strtotime($week_convert))),
        );
        $week_check = array(
            0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
            1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
            2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
            3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
            4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
            5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
            6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
        );
        $display = '';

        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();
        // $ts_logs = $this->timesheet_model->getTSByDate($week_check);
        $date_range = ['from' => $start_date, 'to' => $end_date];
        $attendance = $this->timesheet_model->employeeAttendance($date_range);
        $week_duration = $this->timesheet_model->getLastWeekTotalDuration();

        $name = null;
        $role = null;
        $bg_color = '#f71111bf';
        $status = '';
        $mon_duration = null;
        $tue_duration = null;
        $wed_duration = null;
        $thu_duration = null;
        $fri_duration = null;
        $sat_duration = null;
        $sun_duration = null;
        $shift_duration = number_format(0, 2);

        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<th>Employee</th>';
        $display .= '<th><span class="tbl-status">Current</span><span class="tbl-status">Status</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Mon</span><span class="tbl-date">' . $date_this_week['Monday'] . '</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Tue</span><span class="tbl-date">' . $date_this_week['Tuesday'] . '</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Wed</span><span class="tbl-date">' . $date_this_week['Wednesday'] . '</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Thu</span><span class="tbl-date">' . $date_this_week['Thursday'] . '</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Fri</span><span class="tbl-date">' . $date_this_week['Friday'] . '</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Sat</span><span class="tbl-date">' . $date_this_week['Saturday'] . '</span></th>';
        $display .= '<th class="day"><span class="tbl-day">Sun</span><span class="tbl-date">' . $date_this_week['Sunday'] . '</span></th>';
        $display .= '<th>Total</th>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody>';

        foreach ($users as $user) :
            $name = $user->FName . " " . $user->LName;
            foreach ($user_roles as $roles) {
                if ($roles->id == $user->role) {
                    $role = $roles->title;
                }
            }

            $leaves = $this->timesheet_model->gethis_leaveType($user->id, date('Y-m-d'), "approved");
            foreach ($leaves as $row) {
                $status = $row->name;
                $bg_color = 'background-color: #90A4AE;
                    padding-left: 10px;
                    padding-right: 10px;
                    border-radius: 10px;
                    font-size: 12px;
                    font-weight: bold;
                    color: white;';
            }
            if ($status === "") {
                $current_status = $this->timesheet_model->getUser_current_status($user->id, date('Y-m-d'));

                foreach ($current_status as $log) {
                    if ($log->action == 'Check in') {
                        $bg_color = 'background-color: #51B448;
                        padding-left: 10px;
                        padding-right: 10px;
                        border-radius: 10px;
                        font-size: 12px;
                        font-weight: bold;
                        color: white;';
                        $status = 'In';
                    } elseif ($log->action == 'Check out') {
                        $status = 'Out';
                        $bg_color = 'background-color: #f71111bf;
                        padding-left: 10px;
                        padding-right: 10px;
                        border-radius: 10px;
                        font-size: 12px;
                        font-weight: bold;
                        color: white;';
                    } elseif ($log->action == 'Break in') {
                        $status = 'On Lunch';
                        $bg_color = 'background-color: #FF9800;
                        padding-left: 10px;
                        padding-right: 10px;
                        border-radius: 10px;
                        font-size: 12px;
                        font-weight: bold;
                        color: white;';
                    } elseif ($log->action == 'Break out') {
                        $status = 'In';
                        $bg_color = 'background-color: #51B448;
                        padding-left: 10px;
                        padding-right: 10px;
                        border-radius: 10px;
                        font-size: 12px;
                        font-weight: bold;
                        color: white;';
                    }
                }
            }


            $mon_duration = 0;
            $tue_duration = 0;
            $wed_duration = 0;
            $thu_duration = 0;
            $fri_duration = 0;
            $sat_duration = 0;
            $sun_duration = 0;
            $shift_duration = 0;
            $total_shift_duration = 0;
            $date_checked = [];

            foreach ($attendance as $attn) {
                if ($attn->user_id == $user->id && $attn->shift_duration > 0) {
                    // for ($x = 0; $x < count($week_check); $x++) {
                    //     if ($week_check[$x] == date('Y-m-d', strtotime($attn->date_created))) {
                    //         $base_duration = 8.0;
                    //         $shift_duration = $attn->shift_duration;

                    //         if ($shift_duration > 7.60 && $shift_duration < $base_duration) {
                    //             $shift_duration = 7.60;
                    //         }
                    //         //$duration = $base_duration - $attn->shift_duration;
                    //         $duration = $attn->shift_duration;
                    //     }
                    // }
                    switch (date('Y-m-d', strtotime($attn->date_created))) {
                        case ($week_check[0]):
                            $base_duration = 8.0;
                            $shift_durations = $attn->shift_duration;

                            // if ($shift_durations > 7.60 && $shift_durations < $base_duration) {
                            //     $shift_durations = 7.60;
                            // }

                            // $time_duration = $shift_durations == 0.0 ? $base_duration : $base_duration - $shift_durations;
                            // $mon_duration = $time_duration;                            
                            if( $mon_duration == 0 ){
                                $mon_duration = $shift_durations;
                                $total_shift_duration += $shift_durations;
                            }
                            
                            break;
                        case ($week_check[1]):
                            $base_duration = 8.0;
                            $shift_durations = $attn->shift_duration;

                            // if ($shift_durations > 7.60 && $shift_durations < $base_duration) {
                            //     $shift_durations = 7.60;
                            // }

                            //$time_duration = $shift_durations == 0.0 ? $base_duration : $base_duration - $shift_durations;
                            //$tue_duration  = $time_duration;                            
                            if( $tue_duration == 0 ){
                                $tue_duration = $shift_durations;    
                                $total_shift_duration += $shift_durations;
                            }

                            break;
                        case ($week_check[2]):
                            $base_duration = 8.0;
                            $shift_durations = $attn->shift_duration;

                            // if ($shift_durations > 7.60 && $shift_durations < $base_duration) {
                            //     $shift_durations = 7.60;
                            // }

                            // $time_duration = $shift_durations == 0.0 ? $base_duration : $base_duration - $shift_durations;
                            // $wed_duration = $time_duration;
                            
                            if( $wed_duration == 0 ){                                
                                $wed_duration = $shift_durations;
                                $total_shift_duration += $shift_durations;
                            }
                            
                            break;
                        case ($week_check[3]):
                            $base_duration = 8.0;
                            $shift_durations = $attn->shift_duration;

                            // if ($shift_durations > 7.60 && $shift_durations < $base_duration) {
                            //     $shift_durations = 7.60;
                            // }

                            // $time_duration = $shift_durations == 0.0 ? $base_duration : $base_duration - $shift_durations;
                            // $thu_duration = $time_duration;                            
                            if( $thu_duration == 0 ){
                                $thu_duration = $shift_durations;
                                $total_shift_duration += $shift_durations;
                            }

                            break;
                        case ($week_check[4]):
                            $base_duration = 8.0;
                            $shift_durations = $attn->shift_duration;

                            // if ($shift_durations > 7.60 && $shift_durations < $base_duration) {
                            //     $shift_durations = 7.60;
                            // }

                            // $time_duration = $shift_durations == 0.0 ? $base_duration : $base_duration - $shift_durations;
                            // $fri_duration = $time_duration;                            
                            if( $fri_duration == 0 ){          
                                $fri_duration = $shift_durations;                      
                                $total_shift_duration += $shift_durations;
                            }

                            break;
                        case ($week_check[5]):
                            $base_duration = 8.0;
                            $shift_durations = $attn->shift_duration;

                            // if ($shift_durations > 7.60 && $shift_durations < $base_duration) {
                            //     $shift_durations = 7.60;
                            // }

                            // $time_duration = $shift_durations == 0.0 ? $base_duration : $base_duration - $shift_durations;
                            // $sat_duration = $time_duration;                            
                            if( $sat_duration == 0 ){          
                                $sat_duration = $shift_durations;                      
                                $total_shift_duration += $shift_durations;
                            }

                            break;
                        case ($week_check[6]):
                            $base_duration = 8.0; // 8 hours
                            $shift_durations = $attn->shift_duration;

                            // if ($shift_durations > 7.60 && $shift_durations < $base_duration) {
                            //     $shift_durations = 7.60;
                            // }

                            // $time_duration = $shift_durations == 0.0 ? $base_duration : $base_duration - $shift_durations;
                            // $sun_duration = $time_duration;                            
                            if( $sun_duration == 0 ){                                
                                $sun_duration = $shift_durations;
                                $total_shift_duration += $shift_durations;
                            }

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
            $image = userProfilePicture($user->id);
            if ($image == urlUpload('users/default.png') || $image == NULL ) {
                $initials = getLoggedNameInitials($user->id);
                $display .= '<td>
                                <div style="display: table; height: 40px;">
                                    <div style="display: table-cell; vertical-align: middle;">
                                        <div class="profile-img" style="background-color: #6a4a86; border-radius: 50%; width: 40px; height: 40px; text-align: center; line-height: 40px;">
                                            <span style="color: #fff; font-size: 18px;">' . $initials . '</span>
                                        </div>
                                    </div>
                                    <div style="display: table-cell; vertical-align: middle; padding-left: 10px;">
                                        <span class="tbl-emp-name" style="display: block; font-size: 16px; line-height: 1.2;">' . $name . '</span>
                                        <span class="tbl-emp-role" style="display: block; font-size: 14px; color: #888; margin-top: 2px;">' . $role . '</span>
                                    </div>
                                </div>
                             </td>';
            } else {
                $display .= '<td>
                                <div style="display: table; height: 40px;">
                                    <div style="display: table-cell; vertical-align: middle;">
                                        <div class="profile-img" style="background-image: url(\'' . $image . '\'); background-size: cover; background-position: center; border-radius: 50%; width: 40px; height: 40px;">
                                        </div>
                                    </div>
                                    <div style="display: table-cell; vertical-align: middle; padding-left: 10px;">
                                        <span class="tbl-emp-name" style="display: block; font-size: 16px; line-height: 1.2;">' . $name . '</span>
                                        <span class="tbl-emp-role" style="display: block; font-size: 14px; color: #888; margin-top: 2px;">' . $role . '</span>
                                    </div>
                                </div>
                             </td>';
            }

            // $display .= '<td class="center" style="background-color:' . $bg_color . '"><span class="tbl-emp-status">' . $status . '</span></td>';
            $display .= '<td class="center" ><span class="tbl-emp-status" style="' . $bg_color . '">' . $status . '</span></td>';
            $display .= '<td class="center">' . number_format($mon_duration,2,".","") . '</td>';
            $display .= '<td class="center">' . number_format($tue_duration,2,".","") . '</td>';
            $display .= '<td class="center">' . number_format($wed_duration,2,".","") . '</td>';
            $display .= '<td class="center">' . number_format($thu_duration,2,".","") . '</td>';
            $display .= '<td class="center">' . number_format($fri_duration,2,".","") . '</td>';
            $display .= '<td class="center">' . number_format($sat_duration,2,".","") . '</td>';
            $display .= '<td class="center">' . number_format($sun_duration,2,".","") . '</td>';
            $display .= '<td class="center">' . number_format($total_shift_duration,2,".","") . '</td>';
            $display .= '</tr>';
            $name = null;
            $role = null;
            $bg_color = '#f71111bf';
            $status = '';
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

    public function showListTable()
    {
        $week = $this->input->get('week');
        $week_convert = date('Y-m-d', strtotime($week));
        $date_this_week = array(
            "Monday" => date("M d", strtotime('monday this week', strtotime($week_convert))),
            "Tuesday" => date("M d", strtotime('tuesday this week', strtotime($week_convert))),
            "Wednesday" => date("M d", strtotime('wednesday this week', strtotime($week_convert))),
            "Thursday" => date("M d", strtotime('thursday this week', strtotime($week_convert))),
            "Friday" => date("M d", strtotime('friday this week', strtotime($week_convert))),
            "Saturday" => date("M d", strtotime('saturday this week', strtotime($week_convert))),
            "Sunday" => date("M d", strtotime('sunday this week', strtotime($week_convert))),
        );
        $week_check = array(
            0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
            1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
            2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
            3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
            4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
            5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
            6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
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
        $display .= '<th class="day"><span class="thead-day">Mon</span><span class="thead-date">' . $date_this_week['Monday'] . '</span></th>';
        $display .= '<th class="day"><span class="thead-day">Tue</span><span class="thead-date">' . $date_this_week['Tuesday'] . '</span></th>';
        $display .= '<th class="day"><span class="thead-day">Wed</span><span class="thead-date">' . $date_this_week['Wednesday'] . '</span></th>';
        $display .= '<th class="day"><span class="thead-day">Thu</span><span class="thead-date">' . $date_this_week['Thursday'] . '</span></th>';
        $display .= '<th class="day"><span class="thead-day">Fri</span><span class="thead-date">' . $date_this_week['Friday'] . '</span></th>';
        $display .= '<th class="day"><span class="thead-day">Sat</span><span class="thead-date">' . $date_this_week['Saturday'] . '</span></th>';
        $display .= '<th class="day"><span class="thead-day">Sun</span><span class="thead-date">' . $date_this_week['Sunday'] . '</span></th>';
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
        foreach ($users as $user) :
            $user_id = $user->id;
            $user_photo = userProfileImage($user->id);
            $name = $user->FName . " " . $user->LName;
            foreach ($user_roles as $roles) {
                if ($roles->id == $user->role) {
                    $role = $roles->title;
                }
            }

            foreach ($attendance as $attn) {
                if ($attn->user_id == $user_id) {
                    $attn_id = $attn->id;
                    $attn_user = $attn->user_id;
                    foreach ($ts_logs as $log) {
                        if ($attn_id == $log->attendance_id) {
                            switch (date('Y-m-d', strtotime($log->date_created))) {
                                case ($week_check[0]):
                                    if ($log->action == 'Check in') {
                                        $mon_logtime = date('h:i A', strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $mon_status = '#ffc859';
                                        } else {
                                            $mon_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Break in') {
                                        $mon_logtime = date('h:i A', strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $mon_status = '#ffc859';
                                        } else {
                                            $mon_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Break out') {
                                        $mon_logtime = date('h:i A', strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $mon_status = '#ffc859';
                                        } else {
                                            $mon_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Check out') {
                                        $mon_logtime = date('h:i A', strtotime($log->date_created));
                                        $mon_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $mon_status = '#ffc859';
                                        } else {
                                            $mon_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[1]):
                                    if ($log->action == 'Check in') {
                                        $tue_logtime = date('h:i A', strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $tue_status = '#ffc859';
                                        } else {
                                            $tue_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Break in') {
                                        $tue_logtime = date('h:i A', strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $tue_status = '#ffc859';
                                        } else {
                                            $tue_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Break out') {
                                        $tue_logtime = date('h:i A', strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $tue_status = '#ffc859';
                                        } else {
                                            $tue_status = '#ffffff';
                                        }
                                    } elseif ($log->action == 'Check out') {
                                        $tue_logtime = date('h:i A', strtotime($log->date_created));
                                        $tue_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $tue_status = '#ffc859';
                                        } else {
                                            $tue_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[2]):
                                    if ($log->action == 'Check in') {
                                        $wed_logtime = date('h:i A', strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $wed_status = '#ffc859';
                                        } else {
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in') {
                                        $wed_logtime = date('h:i A', strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $wed_status = '#ffc859';
                                        } else {
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out') {
                                        $wed_logtime = date('h:i A', strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $wed_status = '#ffc859';
                                        } else {
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out') {
                                        $wed_logtime = date('h:i A', strtotime($log->date_created));
                                        $wed_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $wed_status = '#ffc859';
                                        } else {
                                            $wed_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[3]):
                                    if ($log->action == 'Check in') {
                                        $thu_logtime = date('h:i A', strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $thu_status = '#ffc859';
                                        } else {
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in') {
                                        $thu_logtime = date('h:i A', strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $thu_status = '#ffc859';
                                        } else {
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out') {
                                        $thu_logtime = date('h:i A', strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $thu_status = '#ffc859';
                                        } else {
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out') {
                                        $thu_logtime = date('h:i A', strtotime($log->date_created));
                                        $thu_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $thu_status = '#ffc859';
                                        } else {
                                            $thu_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[4]):
                                    if ($log->action == 'Check in') {
                                        $fri_logtime = date('h:i A', strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $fri_status = '#ffc859';
                                        } else {
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in') {
                                        $fri_logtime = date('h:i A', strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $fri_status = '#ffc859';
                                        } else {
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out') {
                                        $fri_logtime = date('h:i A', strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $fri_status = '#ffc859';
                                        } else {
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out') {
                                        $fri_logtime = date('h:i A', strtotime($log->date_created));
                                        $fri_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $fri_status = '#ffc859';
                                        } else {
                                            $fri_status = '#ffffff';
                                        }
                                    }
                                    break;

                                case ($week_check[5]):
                                    if ($log->action == 'Check in') {
                                        $sat_logtime = date('h:i A', strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sat_status = '#ffc859';
                                        } else {
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in') {
                                        $sat_logtime = date('h:i A', strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sat_status = '#ffc859';
                                        } else {
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out') {
                                        $sat_logtime = date('h:i A', strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sat_status = '#ffc859';
                                        } else {
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out') {
                                        $sat_logtime = date('h:i A', strtotime($log->date_created));
                                        $sat_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sat_status = '#ffc859';
                                        } else {
                                            $sat_status = '#ffffff';
                                        }
                                    }
                                    break;
                                case ($week_check[6]):
                                    if ($log->action == 'Check in') {
                                        $sun_logtime = date('h:i A', strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sun_status = '#ffc859';
                                        } else {
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break in') {
                                        $sun_logtime = date('h:i A', strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sun_status = '#ffc859';
                                        } else {
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Break out') {
                                        $sun_logtime = date('h:i A', strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sun_status = '#ffc859';
                                        } else {
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    if ($log->action == 'Check out') {
                                        $sun_logtime = date('h:i A', strtotime($log->date_created));
                                        $sun_id = $log->id;
                                        if ($log->entry_type == 'Manual') {
                                            $sun_status = '#ffc859';
                                        } else {
                                            $sun_status = '#ffffff';
                                        }
                                    }
                                    break;
                            }
                            // Check current status
                            if ($attn->status == 1 && $log->action == 'Check in') {
                                $status = 'In';
                            } elseif ($attn->status == 1 && $log->action == 'Break in') {
                                $status = 'On Break';
                            } elseif ($attn->status == 1 && $log->action == 'Break out') {
                                $status = 'Back to work';
                            } elseif ($attn->status == 0 && $log->action == 'Check out') {
                                $status = 'Out';
                            }
                        }
                    }
                }
            }

            //Check if there is a missing entry
            if ($mon_logtime == null && $week_check[0] < date('Y-m-d') && $attn_user == $user_id) {
                $mon_status = '#f71111bf';
            }
            if ($tue_logtime == null && $week_check[1] < date('Y-m-d') && $attn_user == $user_id) {
                $tue_status = '#f71111bf';
            }
            if ($wed_logtime == null && $week_check[2] < date('Y-m-d') && $attn_user == $user_id) {
                $wed_status = '#f71111bf';
            }
            if ($thu_logtime == null && $week_check[3] < date('Y-m-d') && $attn_user == $user_id) {
                $thu_status = '#f71111bf';
            }
            if ($fri_logtime == null && $week_check[4] < date('Y-m-d') && $attn_user == $user_id) {
                $fri_status = '#f71111bf';
            }
            if ($sat_logtime == null && $week_check[5] < date('Y-m-d') && $attn_user == $user_id) {
                $sat_status = '#f71111bf';
            }
            if ($sun_logtime == null && $week_check[6] < date('Y-m-d') && $attn_user == $user_id) {
                $sun_status = '#f71111bf';
            }

            $display .= '<tr>';
            $display .= '<td class="center"><input type="radio" name="selected" data-photo="' . $user_photo . '" data-attn="' . $attn_id . '" data-name="' . $name . '" value="' . $user_id . '"></td>';
            $display .= '<td><span class="list-emp-name">' . $name . '</span><span class="list-emp-role">' . $role . '</span></td>';
            $display .= '<td class="center"><span class="list-emp-status">' . $status . '</span></td>';
            $display .= '<td class="center" style="background: ' . $mon_status . '" data-id="' . $mon_id . '">' . $mon_logtime . '</td>';
            $display .= '<td class="center" style="background: ' . $tue_status . '" data-id="' . $tue_id . '">' . $tue_logtime . '</td>';
            $display .= '<td class="center" style="background: ' . $wed_status . '" data-id="' . $wed_id . '">' . $wed_logtime . '</td>';
            $display .= '<td class="center" style="background: ' . $thu_status . '" data-id="' . $thu_id . '">' . $thu_logtime . '</td>';
            $display .= '<td class="center" style="background: ' . $fri_status . '" data-id="' . $fri_id . '">' . $fri_logtime . '</td>';
            $display .= '<td class="center" style="background: ' . $sat_status . '" data-id="' . $sat_id . '">' . $sat_logtime . '</td>';
            $display .= '<td class="center" style="background: ' . $sun_status . '" data-id="' . $sun_id . '">' . $sun_logtime . '</td>';
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
    public function getWeekOf()
    {
        $week = $this->input->get('week_of');
        $dayLog_id = $this->input->get('day_id');
        $week_convert = date('Y-m-d', strtotime($week));
        $date_this_week = array(
            "Monday" => date("M d", strtotime('monday this week', strtotime($week_convert))),
            "Tuesday" => date("M d", strtotime('tuesday this week', strtotime($week_convert))),
            "Wednesday" => date("M d", strtotime('wednesday this week', strtotime($week_convert))),
            "Thursday" => date("M d", strtotime('thursday this week', strtotime($week_convert))),
            "Friday" => date("M d", strtotime('friday this week', strtotime($week_convert))),
            "Saturday" => date("M d", strtotime('saturday this week', strtotime($week_convert))),
            "Sunday" => date("M d", strtotime('sunday this week', strtotime($week_convert))),
        );
        $week_check = array(
            0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
            1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
            2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
            3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
            4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
            5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
            6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
        );
        $mon_logtime = null;
        $tue_logtime = null;
        $wed_logtime = null;
        $thu_logtime = null;
        $fri_logtime = null;
        $sat_logtime = null;
        $sun_logtime = null;
        $get_logs = $this->db->get('timesheet_logs')->result();
        foreach ($get_logs as $logs) {
            if ($logs->id == $dayLog_id[0]) {
                $mon_logtime = date('h:i A', $logs->time);
            } elseif ($logs->id == $dayLog_id[1]) {
                $tue_logtime = date('h:i A', $logs->time);
            } elseif ($logs->id == $dayLog_id[2]) {
                $wed_logtime = date('h:i A', $logs->time);
            } elseif ($logs->id == $dayLog_id[3]) {
                $thu_logtime = date('h:i A', $logs->time);
            } elseif ($logs->id == $dayLog_id[4]) {
                $fri_logtime = date('h:i A', $logs->time);
            } elseif ($logs->id == $dayLog_id[5]) {
                $sat_logtime = date('h:i A', $logs->time);
            } elseif ($logs->id == $dayLog_id[6]) {
                $sun_logtime = date('h:i A', $logs->time);
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
    public function adjustEntry()
    {
        $table = 'timesheet_logs';
        $date = $this->input->post('date');
        //      $attn_id = $this->input->post('attn_id');
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
        for ($x = 0; $x < count($day_id); $x++) {
            if ($day_id[$x] != null) {
                $update = array(
                    'time' => strtotime($date[$x] . " " . $logs_array[$x])
                );
                $this->db->where('id', $day_id[$x]);
                $this->db->update($table, $update);
            }
        }
        echo json_encode(1);
    }
    public function notificationOld()
    {
        add_css(array(
            "assets/css/timesheet/timesheet_notification_list.css"
        ));

        add_footer_js(array(
            "assets/js/timesheet/timesheet_notification_list.js"

        ));

        $this->page_data['page']->title = 'Notification';
        $this->page_data['page']->parent = 'timesheet';

        $this->load->model('timesheet_model');
        $this->page_data['newforyou'] = $this->timesheet_model->getNewForyouNotifications();
        // var_dump($this->page_data['allnotification']);
        $this->load->view('v2/pages/users/timesheet_notification_list', $this->page_data);
    }

    public function notification()
    {
        $this->load->model('Activity_model');

        $uid = logged('id');
        $cid = logged('company_id');
        $user_type = logged('user_type');

        if ($user_type == 7) {
            $activityLogs = $this->Activity_model->getActivityLogs($cid);
        } else {
            $activityLogs = $this->Activity_model->getActivityLogsByUserId($user_id);
        }

        $this->page_data['page']->title  = 'Notification';
        $this->page_data['page']->parent = 'timesheet';
        $this->page_data['activityLogs'] = $activityLogs;
        $this->load->view('v2/pages/users/timesheet_notification_list', $this->page_data);
    }

    public function getseennotifications()
    {
        $seenednotifications = $this->timesheet_model->getseennotifications();
        $html = "";
        date_default_timezone_set($this->session->userdata('usertimezone'));

        foreach ($seenednotifications as $row) {
            $image = base_url() . '/uploads/users/user-profile/' . $row->profile_img;
            if (!@getimagesize($image)) {
                $image = base_url('uploads/users/default.png');
            }
            $html = $html . "
            <div class='toast fade show' id='notif" . $row->id . "' role='alert' aria-live='assertive' aria-atomic='true' style='margin-left: auto; margin-right: auto; opacity: 0.7;box-shadow: none;'>
                <div class='toast-header'>
                    <img src='" . $image . "' class='rounded mr-2' alt='...'>
                    <strong class='mr-auto'>" . $row->FName . " " . $row->LName . "</strong>
                    <small class='text-muted'>" . date('M d h:i A', strtotime($row->date_created)) . "</small>
                    <button name='button' type='button' class='ml-2 mb-1 close delete-prev-notif' data-dismiss='toast' aria-label='Close' data-notif-id='" . $row->id . "' data-user-id='" . $row->user_id . "'>
                       <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='toast-body'>
                    " . $row->content . "
                </div>
            </div>
            ";
        }
        $ssss = array(
            'html' => $html,
            'count_of_prev_notiv' => count($seenednotifications)
        );
        $data = new stdClass();

        $data->html = $html;
        $data->count_of_prev_notiv = count($seenednotifications);
        echo json_encode($data);
    }
    public function attendance()
    {
        if(!checkRoleCanAccessModule('user-settings-attendance', 'read')){
			show403Error();
			return false;
		}

        $this->load->model('LeaveRequest_model');

        $this->page_data['page']->title = 'Attendance';
        $this->page_data['page']->parent = 'Company';

        $session = $this->session->userdata('logged');
        if ($session == null || $session == "") {
            $_SESSION['usertimezone'] = json_decode(get_cookie('logged'))->usertimezone;
            $_SESSION['offset_zone'] = json_decode(get_cookie('logged'))->offset_zone;
            $array = [

                'login' => true,

                // saving encrypted userid and password as token in session

                'login_token' => get_cookie('login_token'),
                'logged' => [
                    'id' => json_decode(get_cookie('logged'))->id,
                    'time' => json_decode(get_cookie('logged'))->time,
                    'role' => json_decode(get_cookie('logged'))->role,
                    'company_id' => json_decode(get_cookie('logged'))->company_id
                ]

            ];

            $this->session->set_userdata($array);
        }
        date_default_timezone_set('UTC');
        $this->load->model('timesheet_model');
        $this->load->model('users_model');
        $user_id = logged('id');
        $cid  = logged('company_id');
        $date = date("Y-m-d");
        $leaveRequests = $this->LeaveRequest_model->getAllLeaveByCompanyIdAndDate($cid, $date);

        $this->page_data['notification'] = $this->timesheet_model->getNotification($user_id);
        $this->page_data['notify_count'] = $this->timesheet_model->getNotificationCount($user_id);
        $this->page_data['leaveRequests'] = $leaveRequests;
        $this->page_data['users1'] = $this->users_model->getById(getLoggedUserID());
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['user_roles'] = $this->users_model->getRoles();
        $this->page_data['total_users'] = $this->users_model->getTotalUsers();
        $this->page_data['no_logged_in'] = $this->timesheet_model->getNotLoggedInEmployees(date('Y-m-d'));
        $this->page_data['in_now'] = $this->timesheet_model->getInNow();
        $this->page_data['clockout_now'] = $this->timesheet_model->getOutNow();
        $this->page_data['logs'] = $this->timesheet_model->getTimesheetLogs();
        $this->page_data['on_lunch'] = $this->timesheet_model->get_on_lunch(date('Y-m-d'), logged('company_id'));
        $this->page_data['manual_checkins'] = $this->timesheet_model->get_manual_checkins(date('Y-m-d'), logged('company_id'));
        //        $this->page_data['week_duration'] = $this->timesheet_model->getWeekTotalDuration();
        $this->page_data['attendance'] = $this->timesheet_model->getEmployeeAttendance();
        $this->page_data['schedules'] = $this->timesheet_model->getTimeSheetSettings();
        $this->page_data['tasks'] = $this->timesheet_model->getTimeSheetDay();
        //Employee's attendance
        $this->page_data['emp_attendance'] = $this->timesheet_model->getUserAttendance();
        // $this->page_data['emp_logs'] = $this->timesheet_model->getUserLogs();
        //PTO
        $this->page_data['pto'] = $this->timesheet_model->getPTO();
        $this->page_data['on_leave'] = $this->timesheet_model->getLeaveList(date('Y-m-d'), "approved");
        $this->page_data['on_unapprovedleave'] = $this->timesheet_model->getLeaveList(date('Y-m-d'), "unapproved");
        $this->page_data['on_pendingleave'] = $this->timesheet_model->getLeaveList(date('Y-m-d'), "pending");
        $this->page_data['on_pendingleave'] = $this->timesheet_model->getLeaveList(date('Y-m-d'), "pending");
        $this->page_data['paydate'] = $this->timesheet_model->getData(logged('company_id'));
        // var_dump($this->page_data['out_now']);
        // $this->load->view('users/timesheet_attendance', $this->page_data);
        $this->load->view('v2/pages/users/timesheet_attendance', $this->page_data);
    }

    public function inNow()
    {
        date_default_timezone_set('UTC');
        $this->db->or_where('DATE(date_created)', date('Y-m-d'));
        //      $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        $query = $this->db->get_where('timesheet_attendance', array('status' => 1));
        echo json_encode($query->num_rows());
    }
    public function outNow()
    {
        // $total_user = $this->users_model->getTotalUsers();
        echo json_encode($this->timesheet_model->getOutNow());
    }
    public function loggedInToday()
    {
        $total_users = $this->users_model->getTotalUsers();
        $this->db->or_where('DATE(date_created)', date('Y-m-d'));
        $this->db->or_where('DATE(date_created)', date('Y-m-d', strtotime('yesterday')));
        $query =  $this->db->get('timesheet_attendance');
        $logged_in = $query->num_rows();
        echo json_encode($total_users - $logged_in);
    }

    public function checkingInEmployee()
    {
        $user_id = $this->input->post('id');
        $this->clockInEmployee_manual($user_id, "Manual");
    }

    public function checkingOutEmployee()
    {
        $user_id = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $attn_id = $this->input->post('attn_id');
        //        $week_id = $this->input->post('week_id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        //$current_status = $this->timesheet_model->checkingOutEmployee($user_id, $attn_id, "Manual", $approved_by, $company_id);
        $current_status = $this->timesheet_model->checkingOutEmployee($user_id, $attn_id, $entry, $approved_by, $company_id);

        // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
        // $getTimeZone = json_decode($ipInfo);
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $data = new stdClass();

        $data->lunch_out = date('h:i A');
        $pusher_content_notification = "Has been Manually Clocked out today at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');

        date_default_timezone_set('UTC');
        $clock_out_notify = array(
            'user_id' => $user_id,
            'title' => 'Clock Out',
            'content' => $pusher_content_notification,
            'date_created' => date('Y-m-d H:i:s'),
            'status' => 1,
            'company_id' => getLoggedCompanyID()
        );
        $this->db->insert('user_notification', $clock_out_notify);


        date_default_timezone_set($this->session->userdata('usertimezone'));

        $this->db->select('FName,LName,profile_img,device_token,device_type');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $querys = $this->db->get();
        $getUserDetail = $querys->row();

        $data->current_status = $current_status;
        $data->FName = $getUserDetail->FName;
        $data->LName = $getUserDetail->LName;

        $data->user_id = $user_id;

        $content_notification = $getUserDetail->FName . " " . $getUserDetail->LName . " has been Manually Clocked out today at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');


        $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
        if (!@getimagesize($image)) {
            $image = base_url('uploads/users/default.png');
        }

        $html = '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
            data-id="" class="dropdown-item notify-item active"
            style="background-color:#e6e3e3">
            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
            <p class="notify-details" style="margin-left: 50px;">' . $data->FName . " " . $data->LName . '<span class="text-muted">' . $pusher_content_notification . '</span></p>
            </a>';

        $data->html = $html;
        $data->content_notification = $pusher_content_notification;
        $data->profile_img = $image;
        $data->notif_action_made = '';

        $data->token = $getUserDetail->device_token;
        $data->body = $content_notification;
        $data->device_type = $getUserDetail->device_type;
        $data->company_id = $company_id;
        $data->title = "Time Clock Alert";



        // if ($data->current_status == "on_lunch") {
        // } elseif ($data->current_status == "not_lunch") {
        //     echo json_encode($data);
        // } else {
        //     echo json_encode(0);
        // }
        echo json_encode($data);
        $data->device_type = "";
        $data->token = "";
        $this->pusher_notification($data);
        // echo json_encode($attn_id);
    }


    public function breakIn()
    {
        $user_id = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->breakIn($user_id, $entry, $approved_by, $company_id);

        date_default_timezone_set($this->session->userdata('usertimezone'));

        $this->db->select('FName,LName,profile_img,device_token,device_type');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $querys = $this->db->get();
        $getUserDetail = $querys->row();

        $data = new stdClass();

        $data->FName = $getUserDetail->FName;
        $data->LName = $getUserDetail->LName;

        $data->user_id = $user_id;

        $content_notification = $getUserDetail->FName . " " . $getUserDetail->LName . " has Manually Break In today in at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
        $pusher_content_notification = "Has been Manually Break In today in at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');


        $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
        if (!@getimagesize($image)) {
            $image = base_url('uploads/users/default.png');
        }

        $html = '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
            data-id="" class="dropdown-item notify-item active"
            style="background-color:#e6e3e3">
            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
            <p class="notify-details" style="margin-left: 50px;">' . $data->FName . " " . $data->LName . '<span class="text-muted">' . $pusher_content_notification . '</span></p>
            </a>';

        $data->html = $html;
        $data->content_notification = $pusher_content_notification;
        $data->profile_img = $image;
        $data->notif_action_made = 'Lunchin';

        // for the app notification
        $data->token = $getUserDetail->device_token;
        $data->body = $content_notification;
        $data->device_type = $getUserDetail->device_type;
        $data->company_id = $company_id;
        $data->title = "Time Clock Alert";

        if ($query != null) {
            $data->time = date('h:i A', $query);
            echo json_encode($data);
        } else {
            echo json_encode(0);
        }

        $data->device_type = "";
        $data->token = "";
        $this->pusher_notification($data);
    }
    public function breakOut()
    {
        date_default_timezone_set('UTC');
        $user_id = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $entry = $this->input->post('entry');
        $approved_by = $this->input->post('approved_by');
        $query = $this->timesheet_model->breakOut($user_id, $entry, $approved_by, $company_id);


        date_default_timezone_set($this->session->userdata('usertimezone'));

        $this->db->select('FName,LName,profile_img,device_token,device_type');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $querys = $this->db->get();
        $getUserDetail = $querys->row();

        $data = new stdClass();

        $data->FName = $getUserDetail->FName;
        $data->LName = $getUserDetail->LName;

        $data->user_id = $user_id;

        $content_notification = $getUserDetail->FName . " " . $getUserDetail->LName . " has Manually auxed back on the clock today in at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
        $pusher_content_notification = "Has Manually auxed back on the clock today in at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');


        $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
        if (!@getimagesize($image)) {
            $image = base_url('uploads/users/default.png');
        }

        $html = '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
            data-id="" class="dropdown-item notify-item active"
            style="background-color:#e6e3e3">
            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
            <p class="notify-details" style="margin-left: 50px;">' . $data->FName . " " . $data->LName . '<span class="text-muted">' . $pusher_content_notification . '</span></p>
            </a>';

        $data->html = $html;
        $data->content_notification = $pusher_content_notification;
        $data->profile_img = $image;
        $data->notif_action_made = 'Lunchout';

        // for the app notification
        $data->token = $getUserDetail->device_token;
        $data->body = $content_notification;
        $data->device_type = $getUserDetail->device_type;
        $data->company_id = $company_id;
        $data->title = "Time Clock Alert";

        if ($query != null) {
            $data->time = date('h:i A', $query);
            echo json_encode($data);
        } else {
            echo json_encode(0);
        }
        $data->device_type = "";
        $data->token = "";
        $this->pusher_notification($data);
    }
    public function realTime()
    {
        // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
        // $getTimeZone = json_decode($ipInfo);
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $hours = date('h:');
        $minutes = date('i ');
        $meridies = date('A');
        echo json_encode($hours . $minutes . $meridies);
    }

    public function addingProjects()
    {
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
            'start_date' => date('Y-m-d', strtotime($start_date)),
            'start_time' => date('H:i', strtotime($start_time)),
            'end_time' => date('H:i', strtotime($end_time)),
            'user_id' => $user_id,
            'timezone' => $timezone,
            'notes' => strip_tags($notes),
            'duration' => $duration,
            'day' => date('l', strtotime($start_date)),
            'week' => $week,
            'twd_id' => null,

        );
        $query = $this->timesheet_model->addingProjects($data);

        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function getTimesheetData()
    {
        $timesheet_id = $this->input->get('timesheet_id');
        $day_id = $this->input->get('day_id');
        $ts_query = $this->db->get_where('timesheet_schedule', array('id' => $timesheet_id));
        if ($day_id != null) {
            $ts_day = $this->db->get_where('ts_schedule_day', array('id' => $day_id));
        }
        $users = $this->db->get_where('users', array('id' => $ts_query->row()->user_id));
        $employee_name = ($ts_query->row()->user_id != 0) ? $users->row()->FName . " " . $users->row()->LName : "Teammates";

        $data = new stdClass();
        $data->project_name = $ts_query->row()->project_name;
        $data->team_member = $employee_name;
        $data->timezone = $ts_query->row()->timezone;
        $data->notes = $ts_query->row()->notes;
        $data->start_time = (!empty($day_id)) ? date('h:i A', strtotime($ts_day->row()->start_time)) : null;
        $data->end_time = (!empty($day_id)) ? date('h:i A', strtotime($ts_day->row()->end_time)) : null;
        $data->total_duration = (!empty($day_id)) ? $ts_day->row()->duration : 0;

        echo json_encode($data);
    }

    public function updateSchedule()
    {
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
            'start_date' => date('Y-m-d', strtotime($start_date)),
            'start_time' => date('H:i', strtotime($start_time)),
            'end_time' => date('H:i', strtotime($end_time)),
            'duration' => $duration,
            'day' => $day,
            'twd_id' => $twd_id,
            'day_id' => $day_id,
            'week' => $week
        );
        $query = $this->timesheet_model->perDaySchedule($timesheet_id, $data);

        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function updateTotalWeekDuration()
    {
        $project_id = $this->input->post('id');
        $total = $this->input->post('total');
        $update = array(
            'project_id' => $project_id,
            'total' => $total
        );
        $query = $this->timesheet_model->updateTotalWeekDuration($update);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    //    public function addingTotalInDay(){
    //      $id = $this->input->post('id');
    //      $day = $this->input->post('day');
    //        $date = $this->input->post('day_date');
    //        $total = $this->input->post('total');
    //        $user_id = $this->input->post('user_id');
    //        $update = array('date'=>$date,'total_duration'=>$total,'day'=>$day,'users_id'=>$user_id);
    //        $this->timesheet_model->addingTotalInDay($update,$id);
    //    }

    //    public function updateTotalDuration(){
    //      $week = $this->input->post('week');
    //      $date = $this->input->post('date');
    //      $total = $this->input->post('total');
    //      $user_id = $this->input->post('user_id');
    //      $twd_id = $this->input->post('twd_id');
    //      $update = array('date'=>$date,'total_duration'=>$total);
    //      $this->timesheet_model->updateTotalDuration($update,$week,$twd_id,$user_id);
    //    }

    public function getProjectData()
    {
        $id = $this->input->get('id');
        $project = $this->db->get_where('timesheet_schedule', array('id' => $id))->result();

        $data = new stdClass();
        $data->name = $project[0]->project_name;
        $data->user_id = $project[0]->user_id;
        $data->timezone = $project[0]->timezone;;
        $data->notes = $project[0]->notes;

        echo json_encode($data);
    }

    public function updateTSProject()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('values[project]');
        $notes = $this->input->post('values[notes]');
        $timezone = $this->input->post('timezone');
        $update = array(
            'project_name' => $name,
            'timezone' => $timezone,
            'notes' => strip_tags($notes)
        );
        $query = $this->timesheet_model->updateTSProject($id, $update);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteProjectData()
    {
        $id = $this->input->post('id');
        //Deleting in timesheet_settings table
        $this->db->where('id', $id);
        $this->db->delete('timesheet_schedule');
        //Deleting in ts_settings_day table
        $this->db->where('schedule_id', $id);
        $this->db->delete('ts_schedule_day');
    }

    public function showTimesheetSettings()
    {
        $user_id = $this->input->get('user');
        $week = $this->input->get('week');
        $week_convert = date('Y-m-d', strtotime($week));
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
        $wednesday_sched = 'No data';
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
            "Monday" => date("M d", strtotime('monday this week', strtotime($week_convert))),
            "Tuesday" => date("M d", strtotime('tuesday this week', strtotime($week_convert))),
            "Wednesday" => date("M d", strtotime('wednesday this week', strtotime($week_convert))),
            "Thursday" => date("M d", strtotime('thursday this week', strtotime($week_convert))),
            "Friday" => date("M d", strtotime('friday this week', strtotime($week_convert))),
            "Saturday" => date("M d", strtotime('saturday this week', strtotime($week_convert))),
            "Sunday" => date("M d", strtotime('sunday this week', strtotime($week_convert))),
        );
        $date_week_check = array(
            0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
            1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
            2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
            3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
            4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
            5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
            6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
        );
        $timesheet_settings = $this->timesheet_model->getTimeSheetByWeek($date_week_check);
        $timesheet_by_user = $this->timesheet_model->getTimeSheetByUser($user_id);
        $selected_user = (!empty($timesheet_by_user)) ? $timesheet_by_user[0]->user_id : null;

        $display = '';
        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<th>Projects</th>';
        $display .= '<th>Mon<br>' . $date_this_week['Monday'] . '</th>';
        $display .= '<th>Tue<br>' . $date_this_week['Tuesday'] . '</th>';
        $display .= '<th>Wed<br>' . $date_this_week['Wednesday'] . '</th>';
        $display .= '<th>Thu<br>' . $date_this_week['Thursday'] . '</th>';
        $display .= '<th>Fri<br>' . $date_this_week['Friday'] . '</th>';
        $display .= '<th>Sat<br>' . $date_this_week['Saturday'] . '</th>';
        $display .= '<th>Sun<br>' . $date_this_week['Sunday'] . '</th>';
        $display .= '<th>Total</th>';
        $display .= '<th></th>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody id="tsSettingsTblTbody">';
        foreach ($timesheet_settings as $setting) :
            if ($user_id == $setting->user_id) :
                $timesheet_id = $setting->id;
                $timesheet_duration_w = (!empty($setting->total_duration_w)) ? $setting->total_duration_w : "00h";
                $timesheet_day = $this->timesheet_model->getTimeSheetDayById($timesheet_id);
                foreach ($timesheet_day as $days) {
                    if ($days->day == "Monday") {
                        $day_id_mon = $days->id;
                        $monday_sched = date('ga', strtotime($days->start_time)) . "-" . date('ga', strtotime($days->end_time));
                        $monday = $days->duration . "h";;
                    } elseif ($days->day == "Tuesday") {
                        $day_id_tue = $days->id;
                        $tuesday_sched = date('ga', strtotime($days->start_time)) . "-" . date('ga', strtotime($days->end_time));
                        $tuesday = $days->duration . "h";;
                    } elseif ($days->day == "Wednesday") {
                        $day_id_wed = $days->id;
                        $wednesday_sched = date('ga', strtotime($days->start_time)) . "-" . date('ga', strtotime($days->end_time));
                        $wednesday = $days->duration . "h";
                    } elseif ($days->day == "Thursday") {
                        $day_id_thu = $days->id;
                        $thursday_sched = date('ga', strtotime($days->start_time)) . "-" . date('ga', strtotime($days->end_time));
                        $thursday = $days->duration . "h";;
                    } elseif ($days->day == "Friday") {
                        $day_id_fri = $days->id;
                        $friday_sched = date('ga', strtotime($days->start_time)) . "-" . date('ga', strtotime($days->end_time));
                        $friday = $days->duration . "h";;
                    } elseif ($days->day == "Saturday") {
                        $day_id_sat = $days->id;
                        $saturday_sched = date('ga', strtotime($days->start_time)) . "-" . date('ga', strtotime($days->end_time));
                        $saturday = $days->duration . "h";;
                    } elseif ($days->day == "Sunday") {
                        $day_id_sun = $days->id;
                        $sunday_sched = date('ga', strtotime($days->start_time)) . "-" . date('ga', strtotime($days->end_time));
                        $sunday = $days->duration . "h";
                    }
                }

                $display .= '<tr data-id="' . $timesheet_id . '" id="tsSettingsRow">';
                $display .= '<td style="min-width: 100px"><i class="fa fa-circle ts-status"></i><span class="ts-project-name" id="showEditPen">' . ucfirst($setting->project_name) . '</span><a href="#" id="showProjectData" data-toggle="tooltip" title="" data-original-title="test" data-id="' . $setting->id . '" data-name="' . ucfirst($setting->project_name) . '"><i class="fa fa-pencil-alt"></i></a></td>';
                $display .= '<td><input type="text" name="monday" data-day="Monday" id="tsMonday" data-date="' . $date_week_check[0] . '" class="form-control ts-duration ts-duration' . $timesheet_id . '" data-id="' . $day_id_mon . '" data-user="' . $user_id . '" value="' . $monday . '" readonly><span class="duration-tip">' . $monday_sched . '</span></td>';
                $display .= '<td><input type="text" name="tuesday" data-day="Tuesday" id="tsTuesday" data-date="' . $date_week_check[1] . '" class="form-control ts-duration ts-duration' . $timesheet_id . '" data-id="' . $day_id_tue . '" data-user="' . $user_id . '" value="' . $tuesday . '" readonly><span class="duration-tip">' . $tuesday_sched . '</span></td>';
                $display .= '<td><input type="text" name="wednesday" data-day="Wednesday" id="tsWednesday" data-date="' . $date_week_check[2] . '" class="form-control ts-duration ts-duration' . $timesheet_id . '" data-id="' . $day_id_wed . '" data-user="' . $user_id . '" value="' . $wednesday . '" readonly><span class="duration-tip">' . $wednesday_sched . '</span></td>';
                $display .= '<td><input type="text" name="thursday" data-day="Thursday" id="tsThursday" data-date="' . $date_week_check[3] . '" class="form-control ts-duration ts-duration' . $timesheet_id . '" data-id="' . $day_id_thu . '" data-user="' . $user_id . '" value="' . $thursday . '" readonly><span class="duration-tip">' . $thursday_sched . '</span></td>';
                $display .= '<td><input type="text" name="friday" data-day="Friday" id="tsFriday" data-date="' . $date_week_check[4] . '" class="form-control ts-duration ts-duration' . $timesheet_id . '" data-id="' . $day_id_fri . '" data-user="' . $user_id . '" value="' . $friday . '" readonly><span class="duration-tip">' . $friday_sched . '</span></td>';
                $display .= '<td><input type="text" name="saturday" data-day="Saturday" id="tsSaturday" data-date="' . $date_week_check[5] . '" class="form-control ts-duration ts-duration' . $timesheet_id . '" data-id="' . $day_id_sat . '" data-user="' . $user_id . '" value="' . $saturday . '" readonly><span class="duration-tip">' . $saturday_sched . '</span></td>';
                $display .= '<td><input type="text" name="sunday" data-day="Sunday" id="tsSunday" data-date="' . $date_week_check[6] . '" class="form-control ts-duration ts-duration' . $timesheet_id . '" data-id="' . $day_id_sun . '" data-user="' . $user_id . '" value="' . $sunday . '" readonly><span class="duration-tip">' . $sunday_sched . '</span></td>';
                $display .= '<td><span class="totalWeek" id="totalWeekDuration' . $timesheet_id . '">' . $timesheet_duration_w . 'h</span></td>';
                $display .= '<td><a href="#" id="removeProject" data-id="' . $setting->id . '" data-name="' . ucfirst($setting->project_name) . '"><i class="fa fa-times fa-lg"></i></a></td>';
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
                $wednesday_sched = 'No data';
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
        if (($week != 'last week') && ($week != 'next week')) :
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
    public function savedPTO()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $query = $this->timesheet_model->savedPTO($id, $type);
        echo json_encode(1);
    }
    public function removePTO()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('timesheet_pto');
        echo json_encode(1);
    }

    public function getPTOList()
    {
        $name = $this->input->get('search');
        $pto = $this->timesheet_model->getPTOByName($name);
        $data = array();
        foreach ($pto as $list) {
            $data[] = array(
                'id' =>   $list->id,
                'text' => $list->name
            );
        }
        echo json_encode($data);
    }
    //Employee requesting for leave
    public function employeeRequestLeave()
    {
        $pto = $this->input->post('values[pto]');
        $date = $this->input->post('array');
        $query = $this->timesheet_model->employeeRequestLeave($pto, $date);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    //Approving leave request
    public function approveRequest()
    {
        $id = $this->input->post('id');
        $query = $this->db->get_where('timesheet_leave', array('id' => $id));
        if ($query->num_rows() == 1) {
            $update = array('status' => 1);
            $this->db->where('id', $id);
            $this->db->update('timesheet_leave', $update);
            $insert = array(
                "approver_user_id" => logged('id'),
                "leave_id" => $id,
                "action" => "approved"
            );
            $this->db->insert('timesheet_leave_approver', $insert);
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    //Deny leave request
    public function denyRequest()
    {
        $id = $this->input->post('id');
        $query = $this->db->get_where('timesheet_leave', array('id' => $id));
        if ($query->num_rows() == 1) {
            $update = array('status' => 2);
            $this->db->where('id', $id);
            $this->db->update('timesheet_leave', $update);
            $insert = array(
                "approver_user_id" => logged('id'),
                "leave_id" => $id,
                "action" => "denied"
            );
            $this->db->insert('timesheet_leave_approver', $insert);
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function getEmployees()
    {
        $name = $this->input->get('search');
        $users = $this->users_model->getUsersByName($name);
        $roles = $this->users_model->getRoles();
        $data = array();
        foreach ($users as $employee) {
            $users_role = '';
            foreach ($roles as $role) {
                if ($role->id == $employee->role) {
                    $users_role = $role->title;
                }
            }
            $data[] = array(
                'id' =>   $employee->id,
                'text' => $employee->FName . " " . $employee->LName,
                'subtext' => $users_role
            );
        }
        echo json_encode($data);
    }
    //    public function serverTime(){
    //      $duration = '60 minute';
    //      $query = $this->db->get_where('user_break',array('user_id'=>logged('id'),'date'=>date('Y-m-d')));
    //      if ($query->num_rows() == 1){
    //            $result = $query->result();
    //            $remaining_time = explode(":",$result[0]->duration);
    //            $duration = $remaining_time[0].' minute '.$remaining_time[1].' second';
    //        }
    //
    //      $date_time = date('M d, Y H:i:s');
    //        $end_time = date('  M d, Y H:i:s', strtotime($duration));
    //      $data = new stdClass();
    //      $data->date_time = $date_time;
    //      $data->end_time = $end_time;
    //      echo json_encode($data);
    //    }

    public function clockInEmployee_manual($user_id, $entry_type)
    {
        // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
        // $getTimeZone = json_decode($ipInfo);
        $user_timezone = $this->session->userdata('usertimezone');
        date_default_timezone_set($user_timezone);
        // date_default_timezone_set($getTimeZone->geoplugin_timezone);
        // $clock_in = time();
        // date_default_timezone_set('UTC');
        $clock_in = date('Y-m-d H:i:s');
        $employee_address = $this->employeeAddress();
        $employeeLongnameAddress = $this->employeeLongNameAddress();
        // echo $clock_in;
        $attendance = array(
            'user_id' => $user_id,
            'status' => 1,
            'overtime_status' => 0,
            'date_created' => $clock_in
        );
        $this->db->insert('timesheet_attendance', $attendance);
        $attn_id = $this->db->insert_id();
        $check_attendance = $this->db->get_where('timesheet_attendance', array('id' => $attn_id));
        
        if ($entry_type == "Manual") {
            $content_notification = 'Manually clocked In ' . " at " . date('M d, Y h:i A') . " " . $this->session->userdata('offset_zone');
            $approved_by = logged('id');
        } else {
            $content_notification = "Clocked In in " . $employeeLongnameAddress . " at " . date('M d, Y h:i A') . " " . $this->session->userdata('offset_zone');
            $approved_by = 0;
        }


        if ($check_attendance->num_rows() == 1) {
            // insert to user_notification
            $clock_in_notify = array(
                'user_id' => $user_id,
                'title' => 'Clock In',
                'content' => $content_notification,
                'status' => 1,
                'date_created' => $clock_in,
                'company_id' => getLoggedCompanyID()

            );
            $this->db->insert('user_notification', $clock_in_notify);

            // insert to timesheet_logs

            $logs_insert = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check in',
                'user_location' => $this->timesheet_model->employeeCoordinates(),
                'user_location_address' => $employee_address,
                'entry_type' => $entry_type,
                'company_id' => getLoggedCompanyID(),
                'approved_by' => $approved_by,
                'date_created' => $clock_in
            );
            $this->db->insert('timesheet_logs', $logs_insert);
            $timesheet_logs_id = $this->db->insert_id();
        }



        if ($this->db->affected_rows() != 1) {
            echo json_encode(0);
        } else {
            $this->db->select('FName,LName,profile_img,device_token,device_type');
            $this->db->from('users');
            $this->db->where('id', $user_id);
            $query = $this->db->get();
            $getUserDetail = $query->row();

            $data = new stdClass();
            date_default_timezone_set($this->session->userdata('usertimezone'));

            $data->clock_in_time =  date('h:i A', time());
            $data->clock_out_time = 'Pending...';
            $data->attendance_id = $attn_id;
            $data->FName = $getUserDetail->FName;
            $data->LName = $getUserDetail->LName;
            $data->body = $getUserDetail->FName . " " . $getUserDetail->LName . " has Clocked In today in " . $employeeLongnameAddress . " at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
            $data->device_type =  $getUserDetail->device_type;
            $data->company_id = getLoggedCompanyID();
            $data->user_id = $user_id;
            $data->token = $getUserDetail->device_token;
            $data->title = "Time Clock Alert";
            $data->timesheet_logs_id = $timesheet_logs_id;



            $this->db->select('id');
            $this->db->from('user_notification');
            $this->db->where('user_id', $user_id);
            $this->db->where('date_created', $clock_in);
            $query = $this->db->get();
            $notify = $query->row();

            $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
            if (!@getimagesize($image)) {
                $image = base_url('uploads/users/default.png');
            }

            $html = '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
            data-id="' . $notify->id . '" class="dropdown-item notify-item active"
            style="background-color:#e6e3e3">
            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
            <p class="notify-details" style="margin-left: 50px;">' . $data->FName . " " . $data->LName . '<span class="text-muted">' . $content_notification . '</span></p>
            </a>';

            $data->html = $html;
            $data->content_notification = $content_notification;
            $data->profile_img = $image;
            $data->send_sms = false;
            if (logged("company_id") == 1) {
                $data->send_sms = true;
            }
            if ($entry_type == "Manual") {
                echo json_encode($data);
            } else {
                echo json_encode($data);
            }

            $data->device_type = "";
            $data->token = "";
            $this->pusher_notification($data);
        }
    }

    public function pusher_notification($data)
    {
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'f3c73bc6ff54c5404cc8',
            '20b5e1eb05dc73068e61',
            '1168724',
            $options
        );
        $pusher->trigger('nsmarttrac', 'my-event', $data);
    }

    public function getShiftSchedule()
    {
        $query = $this->timesheet_model->getShiftSchedule();
        $query2 = $this->timesheet_model->getData(logged('company_id'));
        $data = new stdClass();
        $data->attend = $query;
        $data->attend_count = count($query);
        $data->resClock = $query2;

        echo json_encode($data);
    }

    public function clockInEmployee()
    {
        $this->clockInEmployee_manual(logged('id'), "Normal");
    }
    public function app_notification()
    {
        //User App notification
        $body = $this->input->post('body');
        $title = $this->input->post('title');
        $device_type = $this->input->post('device_type');
        $token = $this->input->post('token');
        $under_company_id = $this->input->post('company_id');
        $data = "body:" . $body . " title:" . $title . " Device:" . $device_type . " Company ID:" . $under_company_id . "User Token:" . $token;
        $ios_tokens = array();
        $android_tokens = array();
        $ios_token_ctr = 0;
        $android_token_ctr = 0;

        // ////Admin App notification

        // $data=$under_company_id;
        $company_admins = $this->timesheet_model->get_company_users($under_company_id);
        foreach ($company_admins as $admin) {
            $device_type = $admin->device_type;
            if ($device_type == "Android") {
                $data = $data . " Admin_device : android";
                $android_tokens[] = $admin->device_token;
                $android_token_ctr++;
            } elseif ($device_type == "iOS") {
                $data = $data . " Admin_device : iOS";
                $ios_tokens[] = $admin->device_token;
                $ios_token_ctr++;
            }
        }

        if ($android_token_ctr > 0) {
            $this->send_android_push($android_tokens, $title, $body);
            $data = $data . " send_android_push";
        }
        if ($ios_token_ctr > 0) {
            $this->send_ios_push($ios_tokens, $title, $body);
            $data = $data . " send_ios_push";
        }
        $return = array(
            "data" => $data,
            "ios_token" => $ios_tokens,
            "android_token" => $android_tokens,
            "ios_token_array" => count($ios_tokens),
            "ios_token_ctr" => $ios_token_ctr,
            "ios_token_ctr" => $android_token_ctr,
        );
        echo json_encode($return);
    }

    public function clockOut_validation()
    {
        $attn_id = $this->input->post('attn_id');
        $logs = $this->timesheet_model->getattendance_logs($attn_id);
        $count_lunchin = 0;
        $count_lunchout = 0;
        foreach ($logs as $log) {
            if ($log->action == "Break in") {
                $count_lunchin++;
            } elseif ($log->action == "Break out") {
                $count_lunchout++;
            }
        }
        $onLunch = false;
        $noLunch = false;
        $doneLunch = false;
        if ($count_lunchin > 0 && $count_lunchout < 1) {
            $onLunch = true;
        }
        if ($count_lunchout > 0) {
            $doneLunch = true;
        }
        if ($count_lunchin == 0) {
            $noLunch = true;
        }
        $data = array(
            'onLunch' =>   $onLunch,
            'noLunch' => $noLunch,
            'doneLunch' => $doneLunch
        );

        echo json_encode($data);
    }
    public function getClockInOutNotification()
    {
        $qry = $this->db->query("SELECT * FROM (SELECT count(DISTINCT user_id) as ClockIn FROM
        `user_notification` WHERE title != 'Clock Out' AND Date(date_created)=CURRENT_DATE() ) as t1 INNER
        JOIN (SELECT count(DISTINCT user_id) as ClockOut FROM `user_notification` WHERE title = 'Clock Out'
        and Date(date_created)=CURRENT_DATE()) as a")->result_array();
        echo json_encode($qry);
    }


    public function removeNotification()
    {
        $this->load->model('timesheet_model');
        $id = $this->input->post('notificationid');

        $this->db->set('status', 0);
        $this->db->where_in('id', $id);
        $this->db->update('user_notification');
        return ($this->db->affected_rows() > 0) ? true : false;
    }


    public function getNotificationTbl()
    {
        $this->load->model('timesheet_model');
        $notification = $this->timesheet_model->getTSNotification();

        $table = '';

        $i = 0;
        foreach ($notification as $cnt => $notify) {
            if ($notify->title == 'Clock In') {
                $color = 'green';
            } else {
                $color = 'red';
            }

            $table .= '<tr>
                    <td class="tbl-id-number">' . ++$i . '</td>
                    <td>
                        <center>
                            <span class="tbl-employee-name">' . $notify->FName . '</span>
                            <span class="tbl-employee-name">' . $notify->LName . '</span>
                        </center>
                    </td>
                    <td>
                        <center>
                            <i class="fa fa-circle" aria-hidden="true" style="color:' . $color . '"></i>
                            &nbsp;' . $notify->content . '
                        </center>
                    </td>
                    <td class="tbl-status">
                        <center>
                            <a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
                            data-id="' . $notify->id . '" title="" data-toggle="tooltip"
                            data-original-title="Notification Not Viewed ">
                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                            </a>
                        </center>
                    </td>
                </tr>';
        }

        echo $table;
    }

    public function getNotificationsAll()
    {
        $userid = logged('id');
        $badgeCount = $this->input->post('badgeCount');
        $notification = $this->timesheet_model->get_unreadNotification($badgeCount, "");
        $html = '';
        date_default_timezone_set($this->session->userdata('usertimezone'));
        if ($notification != null) {
            $notifyCount = count($notification);
            foreach ($notification as $notify) {
                if ($notify->status == 1) {
                    $bg = '#e6e3e3';
                } else {
                    $bg = '#f8f9fa';
                }

                $userprofile = userProfileImage($userid);
                $image = base_url() . '/uploads/users/user-profile/' . $notify->profile_img;
                if (!@getimagesize($image)) {
                    $image = base_url('uploads/users/default.png');
                }
                $date_created = date('m-d-Y h:i A', strtotime($notify->date_created));

                if ($notify->title == 'New Work Order') {
                    $html .= '<a href="' . site_url() . 'workorder" id="notificationDP"
                            data-id=' . $notify->id . '" class="dropdown-item notify-item active"
                            style="background-color:' . $bg . '">
                            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
                            <p class="notify-details" style="margin-left: 50px;">' . $notify->FName . " " . $notify->LName . '<span class="text-muted">' . $notify->content . '</span></p>
                            </a>';
                } elseif ($notify->title == 'New Estimates') {
                    $html .= '<a href="' . site_url() . 'estimate" id="notificationDP"
                    data-id=' . $notify->id . '" class="dropdown-item notify-item active"
                    style="background-color:' . $bg . '">
                    <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
                    <p class="notify-details" style="margin-left: 50px;">' . $notify->FName . " " . $notify->LName . '<span class="text-muted">' . $notify->content . '</span></p>
                    </a>';
                } else {
                    $html .= '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
                            data-id=' . $notify->id . '" class="dropdown-item notify-item active"
                            style="background-color:' . $bg . '">
                            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
                            <p class="notify-details" style="margin-left: 50px;">' . $notify->FName . " " . $notify->LName . '<span class="text-muted">' . $notify->content . '</span></p>
                            </a>';
                }
            }
        }

        $notificationListArray = array(
            'notifyCount' => $notifyCount,
            'badgeCount' => $this->timesheet_model->get_unreadNotification($notifyCount, "counter"),
            'autoNotifications' => $html,
        );
        echo json_encode($notificationListArray);
    }

    public function getV2NotificationsAll()
    {
        $userid = logged('id');
        $badgeCount = $this->input->post('badgeCount');
        $notification = $this->timesheet_model->get_unreadNotification($badgeCount, "");
        $html = '';
        date_default_timezone_set($this->session->userdata('usertimezone'));
        if ($notification != null) {
            $notifyCount = count($notification);
            foreach ($notification as $notify) {
                $seen = '';
                if ($notify->status == 1) {
                    $seen = 'read';
                }

                $image = userProfilePicture($notify->user_id);
                $date_created = date('m-d-Y h:i A', strtotime($notify->date_created));

                if ($notify->title == 'New Work Order') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("workorder") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                } elseif ($notify->title == 'New Estimates') {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("estimates") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                } else {
                    $html .= '<div class="list-item" onclick="location.href=\'' . site_url("timesheet/attendance") . '\'" data-id="' . $notify->id . '">
                                <div class="nsm-notification-item">';

                    if (is_null($image)) :
                        $html .= '<div class="nsm-profile"><span>' . ucwords($notify->FName[0]) . ucwords($notify->LName[0]) . '</span></div>';
                    else :
                        $html .= '<div class="nsm-profile" style="background-image: url(' . $image . ');"></div>';
                    endif;

                    $html .= '<div class="nsm-notification-content ' . $seen . '">
                                        <span class="content-title fw-bold mb-1">' . $notify->FName . " " . $notify->LName . '</span>
                                        <span class="content-subtitle">' . $notify->content . '</span>
                                    </div>
                                </div>
                            </div>';
                }
            }
        }

        $notificationListArray = array(
            'notifyCount' => $notifyCount,
            'badgeCount' => $this->timesheet_model->get_unreadNotification($notifyCount, "counter"),
            'autoNotifications' => $html,
        );
        echo json_encode($notificationListArray);
    }

    public function getCount_NotificationsAll()
    {
        $userid = logged('id');
        $notifycount = $this->input->post('notifycount');
        $notifycounts = $this->timesheet_model->get_unreadNotification($notifycount, "notifCount");

        $notificationListArray = array(
            'notifyCount' => $notifycounts,
            'badgeCount' => $this->timesheet_model->get_unreadNotification($notifycount, "counter")

        );
        echo json_encode($notificationListArray);
    }


    public function statusChecker($attn_id, $date)
    {
        $last_log = "";
        $current_status = $this->timesheet_model->is_BreakIn($attn_id, $date);
        foreach ($current_status as $row) {
            $last_log = $row->action;
        }
        return $last_log;
    }
    public function clockOutEmployee()
    {
        // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
        // $getTimeZone = json_decode($ipInfo);
        $user_timezone = $this->session->userdata('usertimezone');
        date_default_timezone_set($user_timezone);
        //date_default_timezone_set('UTC');

        $_SESSION['autoclockout_timer_closed'] = false;        
        $attn_id = $this->input->post('attn_id');
        $entry_type = $this->input->post('auto');
        if ($entry_type == "") {
            $entry_type = "Normal";
        }
        // $current_status = statusChecker($attn_id,date('Y-m-d'));
        // if($lastcurrent_status == "Break in"){

        // }
        $execute = true;
        $user_location_address = "";
        $usercoords = "";
        if ($entry_type == "Auto") {
            $attendance = $this->timesheet_model->get_attendance_for_clockout($attn_id);
            if ($attendance->overtime_status == 1) {
                $execute = false;
            } elseif ($attendance->status == 0) {
                $execute = false;
            }
        }
        $clock_out = date('Y-m-d H:i:s');

        $employeeLongnameAddress = $this->employeeLongNameAddress();
        $user_id = logged('id');
        $check_attn = $this->db->get_where('timesheet_attendance', array('id' => $attn_id, 'user_id' => $user_id));
        // var_dump($check_attn->num_rows());
        if ($check_attn->num_rows() == 1 && $execute) {
            date_default_timezone_set($this->session->userdata('usertimezone'));
            if ($entry_type == "Auto") {
                $content_notification = "Has been auto clocked out at " . date('M d, Y h:i A') . " " . $this->session->userdata('offset_zone');
            } else {
                $content_notification = "Clocked Out in " . $employeeLongnameAddress . " at " . date('M d, Y h:i A') . " " . $this->session->userdata('offset_zone');
            }
            $clock_out_notify = array(
                'user_id' => $user_id,
                'title' => 'Clock Out',
                'content' => $content_notification,
                'date_created' => $clock_out,
                'status' => 1,
                'company_id' => getLoggedCompanyID()
            );
            $this->db->insert('user_notification', $clock_out_notify);
            //date_default_timezone_set('UTC');

            $out = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check out',
                'user_location' => $this->timesheet_model->employeeCoordinates(),
                'user_location_address' => $this->employeeAddress(),
                'entry_type' => $entry_type,
                'company_id' => getLoggedCompanyID(),
                'date_created' => $clock_out
            );
            $this->db->insert('timesheet_logs', $out);
            $timesheet_logs_id = $this->db->insert_id();

            $hours_worked = $this->timesheet_model->calculateShiftDuration_and_overtime($attn_id);
            $shift_duration = round($hours_worked[0], 2);
            $update = array(
                'shift_duration' => $shift_duration,
                //                'break_duration' => $break_duration,
                'overtime' => round($hours_worked[1], 2),
                //                'date_out' => date('Y-m-d'),
                'status' => 0,
                'date_created' => $clock_out
            );
            $this->db->where('id', $attn_id);
            $this->db->update('timesheet_attendance', $update);

            $update = array(
                'status' => 0
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('timesheet_attendance', $update);



            $affected_row = $this->db->affected_rows();

            $this->db->select('FName,LName,profile_img,device_type,device_token');
            $this->db->from('users');
            $this->db->where('id', $user_id);
            $query = $this->db->get();
            $getUserDetail = $query->row();

            //date_default_timezone_set($this->session->userdata('usertimezone'));

            $data = new stdClass();
            $data->clock_out_time = date('h:i A');
            $data->attendance_id = $attn_id;
            $data->shift_duration = gmdate('H:i', floor(($shift_duration + $hours_worked[1]) * 3600));
            $data->FName = $getUserDetail->FName;
            $data->LName = $getUserDetail->LName;
            $data->profile_img = $getUserDetail->profile_img;
            if ($entry_type == "Auto") {
                $data->body = $getUserDetail->FName . " " . $getUserDetail->LName . " has been Auto clocked out at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
            } else {
                $data->body = $getUserDetail->FName . " " . $getUserDetail->LName . " has Clocked Out today in " . $employeeLongnameAddress . " at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
            }

            $data->device_type =  $getUserDetail->device_type;
            $data->company_id = logged('company_id');
            $data->token = $getUserDetail->device_token;
            $data->title = "Time Clock Alert";
            $data->timesheet_logs_id = $timesheet_logs_id;

            $this->db->select('id');
            $this->db->from('user_notification');
            $this->db->where('user_id', $user_id);
            $this->db->where('date_created', $clock_out);
            $query = $this->db->get();
            $notify = $query->row();

            $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
            if (!@getimagesize($image)) {
                $image = base_url('uploads/users/default.png');
            }

            $html = '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP"
            data-id="' . $notify->id . '" class="dropdown-item notify-item active"
            style="background-color:#e6e3e3">
            <img style="width:40px;height:40px;border-radius: 20px;margin-bottom:-40px" class="profile-user-img img-responsive img-circle" src="' . $image . '" alt="User profile picture" />
            <p class="notify-details" style="margin-left: 50px;">' . $data->FName . " " . $data->LName . '<span class="text-muted">' . $content_notification . '</span></p>
            </a>';
            $data->user_id = $user_id;
            $data->html = $html;
            $data->content_notification = $content_notification;
            $data->profile_img = $image;
            $data->device_type = "";
            $data->token = "";
            $data->send_sms = false;
            if (logged("company_id") == 1) {
                $data->send_sms = true;
            }
            $this->pusher_notification($data);
            echo json_encode($data);
        }
    }

    public function lunchInEmployee()
    {
        //      $end_break = $this->input->post('end_of_break');
        $attn_id = $this->input->post('attn_id');
        date_default_timezone_set($this->session->userdata('usertimezone'));
        //date_default_timezone_set('UTC');
        $lunch_in = time();
        $timestamp = 0;
        $latest_in = 0;
        $user_id = logged('id');
        $employee_address = $this->employeeAddress();
        $employeeLongnameAddress = $this->employeeLongNameAddress();
        $lunch = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break in',
            'user_location' => $this->timesheet_model->employeeCoordinates(),
            'user_location_address' => $employee_address,
            'entry_type' => 'Normal',
            'company_id' => getLoggedCompanyID()
        );
        $this->db->insert('timesheet_logs', $lunch);
        $timesheet_logs_id = $this->db->insert_id();

        $break_duration = $this->db->get_where('timesheet_attendance', array('id' => $attn_id));
        if ($break_duration->num_rows() == 1) {
            if ($break_duration->row()->break_duration > 0) {
                $timestamp = $lunch_in - ($break_duration->row()->break_duration * 60);
                $latest_in = $lunch_in;
            } else {
                $timestamp = $lunch_in;
            }
        }

        // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
        // $getTimeZone = json_decode($ipInfo);
        $user_timezone = $this->session->userdata('usertimezone');
        //date_default_timezone_set($this->session->userdata('usertimezone'));


        $data = new stdClass();
        $data->lunch_in =  date('h:i A', time());
        $data->timestamp = $timestamp;
        $data->latest_in = $latest_in;

        $this->db->select('FName,LName,profile_img,device_type,device_token');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $getUserDetail = $query->row();

        $data->attendance_id = $attn_id;
        $data->FName = $getUserDetail->FName;
        $data->LName = $getUserDetail->LName;
        $data->profile_img = $getUserDetail->profile_img;
        $data->body = $data->body = $getUserDetail->FName . " " . $getUserDetail->LName . " is taking a Break today in " . $employeeLongnameAddress . " at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
        $data->device_type =  $getUserDetail->device_type;
        $data->company_id = getLoggedCompanyID();
        $data->token = $getUserDetail->device_token;
        $data->title = "Time Clock Alert";
        $data->timesheet_logs_id = $timesheet_logs_id;

        $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
        if (!@getimagesize($image)) {
            $image = base_url('uploads/users/default.png');
        }

        $data->user_id = $user_id;
        $data->content_notification = "Is taking a Break in " . $employeeLongnameAddress . " at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
        $data->profile_img = $image;
        $data->notif_action_made = "Lunchin";
        echo json_encode($data);
        $data->device_type = "";
        $data->token = "";
        $this->pusher_notification($data);
    }

    public function lunchOutEmployee()
    {
        $attn_id = $this->input->post('attn_id');
        $pause_time = $this->input->post('pause_time');
        //date_default_timezone_set('UTC');
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $lunch_out = time();
        $user_id = logged('id');
        //        $check = $this->db->get_where('timesheet_logs',array('attendance_id'=>$attn_id,'action'=>'Break out'));
        //        if ($check->num_rows() == 0){
        $employee_address = $this->employeeAddress();
        $employeeLongnameAddress = $this->employeeLongNameAddress();
        $lunch = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break out',
            'user_location' => $this->timesheet_model->employeeCoordinates(),
            'user_location_address' => $employee_address,
            'entry_type' => 'Normal',
            'company_id' => getLoggedCompanyID()
        );
        $this->db->insert('timesheet_logs', $lunch);
        $timesheet_logs_id = $this->db->insert_id();

        $update = array(
            'break_duration' => round($this->timesheet_model->calculateBreakDuration($attn_id), 2)
        );
        $this->db->where('id', $attn_id);
        $this->db->update('timesheet_attendance', $update);

        // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
        // $getTimeZone = json_decode($ipInfo);
        $user_timezone = $this->session->userdata('usertimezone');
        //date_default_timezone_set($this->session->userdata('usertimezone'));

        $data = new stdClass();
        $data->lunch_time =  date('h:i A', time());

        $this->db->select('FName,LName,profile_img,device_type,device_token');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        $getUserDetail = $query->row();

        $data->attendance_id = $attn_id;
        $data->FName = $getUserDetail->FName;
        $data->LName = $getUserDetail->LName;
        $data->profile_img = $getUserDetail->profile_img;
        $data->body = $data->body = $getUserDetail->FName . " " . $getUserDetail->LName . " is On the Clock again today in " . $employeeLongnameAddress . " at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
        $data->device_type =  $getUserDetail->device_type;
        $data->company_id = getLoggedCompanyID();
        $data->token = $getUserDetail->device_token;
        $data->title = "Time Clock Alert";
        $data->timesheet_logs_id = $timesheet_logs_id;

        $image = base_url() . '/uploads/users/user-profile/' . $getUserDetail->profile_img;
        if (!@getimagesize($image)) {
            $image = base_url('uploads/users/default.png');
        }

        $data->user_id = $user_id;
        $data->html = "";
        $data->content_notification = "Is on the Clock again today in " . $employeeLongnameAddress . " at " . date('h:i A', time()) . " " . $this->session->userdata('offset_zone');
        $data->profile_img = $image;
        $data->notif_action_made = "Lunchout";
        echo json_encode($data);
        $data->device_type = "";
        $data->token = "";
        $this->pusher_notification($data);
    }

    private function employeeAddress()
    {
        $ipaddress = $this->gtMyIpGlobal();
        $get_location = json_decode(file_get_contents('http://ip-api.com/json/' . $ipaddress));
        $lat = $get_location->lat;
        $lng = $get_location->lon;
        return $get_location->city . " " . $get_location->zip . ", " . $get_location->country;
        // $g_map = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&sensor=true&key='.GOOGLE_MAP_API_KEY);
        // $output = json_decode($g_map);
        // $status = $output->status;
        // $address = ($status == "OK") ? $output->results[1]->formatted_address : 'Address not found';
        // return $address;

        // $address = ($status == "OK") ? $output->results[1]->address_components : 'Address not found';
        // $longname = "";
        // foreach ($address as $row) {
        //     $longname = $row->long_name;
        //     break;
        // }
    }
    private function employeeLongNameAddress()
    {
        $ipaddress = $this->gtMyIpGlobal();
        $get_location = json_decode(file_get_contents('http://ip-api.com/json/' . $ipaddress));
        $lat = $get_location->lat;
        $lng = $get_location->lon;
        // $g_map = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&sensor=true&key='.GOOGLE_MAP_API_KEY);
        // $output = json_decode($g_map);
        // $status = $output->status;

        // if ($status == "OK") {
        //     $address = $output->results[1]->address_components;
        //     $longname = "";
        //     foreach ($address as $row) {
        //         $longname = $row->long_name;
        //         break;
        //     }
        //     return $longname;
        // } else {
        //     return 'Address not found';
        // }
        return $get_location->city;
    }
    public function overtimeApproval()
    {
        $status = $this->input->post('status');
        $attn_id = $this->input->post('attn_id');
        $attendance = $this->db->get_where('timesheet_attendance', array('id' => $attn_id));
        if ($attendance->num_rows() == 1) {
            $update = array('overtime_status' => $status);
            $this->db->where('id', $attn_id);
            $this->db->update('timesheet_attendance', $update);
            echo json_encode(1);
        }
    }

    public function notifyStartSchedule()
    {
        $ts_settings = getEmpTSsettings();
        $schedule = getEmpSched();
        $time = 0;
        $tz = null;
        foreach ($ts_settings as $setting) {
            foreach ($schedule as $item) {
                if ($setting->id == $item->schedule_id) {
                    $tz = $setting->timezone;
                    $time = ltrim(date('hA', strtotime($item->start_time)), 0);
                }
            }
        }
        $user_id = logged('id');
        $qry = $this->db->get_where('user_notification', array('user_id' => $user_id, 'title' => 'Your shift will start soon.', 'date_created' => date('Y-m-d h:i:s')));
        if ($qry->num_rows() == 0) {
            $data_notify = array(
                'user_id' => $user_id,
                'title' => 'Your shift will begin soon.',
                'content' => 'Shift start at ' . $time . " (" . $tz . ")",
                'date_created' => date('Y-m-d h:i:s'),
                'status' => 1,
                'company_id' => getLoggedCompanyID()
            );
            $this->db->insert('user_notification', $data_notify);
        }
        echo json_encode($this->notificationBell());
    }

    public function notifyEndSchedule()
    {
        $ts_settings = getEmpTSsettings();
        $schedule = getEmpSched();
        $time = 0;
        $tz = null;
        foreach ($ts_settings as $setting) {
            foreach ($schedule as $item) {
                if ($setting->id == $item->schedule_id) {
                    $tz = $setting->timezone;
                    $time = ltrim(date('hA', strtotime($item->end_time)), 0);
                }
            }
        }
        $user_id = logged('id');
        $qry = $this->db->get_where('user_notification', array('user_id' => $user_id, 'title' => 'Your shift will end soon.', 'date_created' => date('Y-m-d h:i:s')));
        if ($qry->num_rows() == 0) {
            $data_notify = array(
                'user_id' => $user_id,
                'title' => 'Your shift will end soon.',
                'content' => 'Shift end at ' . $time . " (" . $tz . ")",
                'date_created' => date('Y-m-d h:i:s'),
                'status' => 1,
                'company_id' => getLoggedCompanyID()
            );
            $this->db->insert('user_notification', $data_notify);
        }
        echo json_encode($this->notificationBell());
    }

    public function notificationBell()
    {
        $notification = '';
        $notify = $this->db->order_by('id', "desc")->limit(1)->get('user_notification')->result();
        foreach ($notify as $value) {
            if ($value->status == 1) {
                $bg = '#e6e3e3';
            } else {
                $bg = '#f8f9fa';
            }
            $notification .= '<a href="' . site_url() . 'timesheet/attendance" id="notificationDP" data-id="' . $value->id . '" class="dropdown-item notify-item active" style="background-color: ' . $bg . '">';
            $notification .= '<div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>';
            $notification .= '<p class="notify-details">' . $value->title . '<span class="text-muted">' . $value->content . '</span></p>';
            $notification .= '</a>';
        }
        return $notification;
    }
    public function servere_timezone()
    {
        // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
        // $getTimeZone = json_decode($ipInfo);
        $UserTimeZone = new DateTimeZone($this->session->userdata('usertimezone'));
        var_dump($UserTimeZone);
        $utz = "";

        echo $utz;
        // echo date('Y-m-d H:i:sP');
        $date =  new DateTime('2021-02-28 17:23:26+01:00');
        // $date->setTimezone(new DateTimeZone($UserTimeZone)); // +04
        // echo $date->format('Y-m-d H:i:sP');
        // echo date('Y-m-d H:i:sP')."=::::";
        // echo date_format($date, 'Y-m-d H:i:sP');
        date_default_timezone_set('UTC');
        $date =  date('Y-m-d H:i:s');
        $datetime = new DateTime($date);
        // echo "UTC: ".$datetime->format('Y-m-d H:i:s') . "<br>";
        $ManilaZone = new DateTimeZone('Asia/Manila');
        $datetime->setTimezone($ManilaZone);
        // echo "Asia/Manila".$datetime->format('Y-m-d H:i:s');
        // var_dump(timezone_identifiers_list());
        // echo  "server_timezone: ".date_default_timezone_get ();
    }

    public function subtract_dates()
    {
        echo logged("role") . "::::";

        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date, date_interval_create_from_date_string("2 days"));
        echo date_format($date, "Y-m-d H:i:s");
    }
    public function worked_hourschecker()
    {
        //date_default_timezone_set('UTC');
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $user_id = logged('id');
        $user_logs = $this->timesheet_model->getAllLogsToday($user_id, date('Y-m-d'));
        // var_dump($user_logs);
        $count_of_checkins = 0;
        $check_in = "";
        $total_hours = 0;
        foreach ($user_logs as $row) {
            if ($row->action == "Check in") {
                $count_of_checkins++;
                if ($count_of_checkins == 1) {
                    $check_in = $row->date_created;
                }
            } elseif ($row->action == "Check out" && $count_of_checkins > 0) {
                $start = new DateTime($check_in);
                $end = new DateTime($row->date_created);
                $interval = $start->diff($end);
                $total_hours = $total_hours + $interval->format("%H");
            }
        }
        if ($count_of_checkins % 2 != 0) {
            $start = new DateTime($check_in);
            $end =  new DateTime(date('Y-m-d H:i:s'));
            $interval = $start->diff($end);
            $total_hours = $total_hours + $interval->format("%H");
        }
        if ($total_hours >= 8) {
            $action = true;
        } else {
            $action = false;
        }

        $data = array(
            'user_id' => $user_id,
            'action' => $action,
            'total_hours' => $total_hours,
            'count_of_checkins' => $count_of_checkins
        );
        echo json_encode($data);
    }

    public function readNotification()
    {
        $id = $this->input->post('id');
        $query = $this->db->get_where('user_notification', array('id' => $id));
        if ($query->num_rows() == 1) {
            $readed = array('status' => 0);
            $this->db->where('id', $id);
            $this->db->update('user_notification', $readed);
        }
    }

    //Invite link entry
    public function inviteLinkEntry()
    {
        $email = $this->input->post('values[email]');
        $name = $this->input->post('values[name]');
        $role = $this->input->post('values[role]');
        $query = $this->timesheet_model->inviteLinkEntry($email, $name, $role);
        if ($query != null) {
            if ($this->sendEmailInviteLink($email, $name, $query) == true) {
                echo json_encode(1);
            }
        } else {
            echo json_encode(0);
        }
    }
    public function sendEmailInviteLink($email, $name, $code)
    {
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

        $this->email->from('no-reply@nsmartrac.com', 'nSmartrac');
        $this->email->to($email);
        $this->email->subject('nSmartrac invitation');
        $message = $this->load->view('users/invite_link_template', $data, true);
        $this->email->message($message);
        //Send mail
        $this->email->send();
        return true;
    }

    //Department
    //    Adding department
    public function addDepartment()
    {
        $dept = $this->input->post('dept');
        $query = $this->timesheet_model->addDepartment($dept);
        if ($query == 1) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    //Deleting department
    public function removeDepartment()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('timesheet_departments');
        echo json_encode(1);
    }
    //Show department update page
    public function showDeptUpdate()
    {
        $dept_id = $this->input->get('dept_id');
        $query = $this->db->get_where('timesheet_departments', array('id' => $dept_id));
        $output = '<div class="department-edit-view">
                    <div class="dept-header">
                        <a href="javascript:void(0)" id="deptBckBtn"><i class="fas fa-arrow-left fa-lg" style="margin-right: 10px;color: #a2a2a2;"></i></a> <h3>' . $query->row()->name . '</h3> <a href="javascript:void(0)" title="Edit" data-toggle="tooltip" id="deptEditName"><i class="fas fa-pencil-alt"></i></a>
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
    public function workweekOvertimeSettings()
    {
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
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    //Break Preference
    public function breakPreference()
    {
        $break_rule = $this->input->post('values[break_rule]');
        $type = $this->input->post('values[type]');
        if ($break_rule == 'Manual') {
            $length = null;
        } else {
            $length = $this->input->post('values[length]');
        }
        $data = array(
            'break_rule' => $break_rule,
            'type' => $type,
            'length' => $length
        );
        $query = $this->timesheet_model->breakPreference($data);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    //    Email Report for Timesheet test page
    public function email()
    {
        $page = array(
            'last_week' => $this->timesheet_model->getLastWeekTotalDuration()
        );
        $this->load->view('users/email_template', $page);
    }
    //Invite link email for test page
    public function invite()
    {
        $data = array('name' => 'Tommy Nguyen', 'link' => sha1(rand()));
        $this->load->view('users/invite_link_template', $data);
    }

    // send push to android
    public function send_android_push($registrationIds, $body, $title)
    {
        $notification = array(
            'body'     => $body,
            'title'    => $title,
            'sound'     => 'default'
        );

        $fields = array(
            'registration_ids'    => $registrationIds,
            'data'                => $notification
        );


        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );


        //send curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $response = curl_exec($ch);
        curl_close($ch);
    }


    public function send_ios_push($registrationIds, $title, $body)
    {
        $notification = array(
            'title'     => $title,
            'body'      => $body,
            'sound'     => 'default',
            'badge'     => '1'
        );

        // registration_ids for multipale tokens array
        $payload = array(
            'registration_ids' => $registrationIds,
            'notification'     => $notification,
            'priority'            => 'high'
        );
        $json = json_encode($payload);


        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/fcm/send");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
    }



    ////LOU Pinton's code
    public function delete_notification()
    {
        $notif_id = $this->input->post("notif_id");
        $user_id = $this->input->post("user_id");

        $this->timesheet_model->delete_notification($notif_id, $user_id);

        echo json_encode("success");
    }
    public function delete_read_all_notif()
    {
        $user_id = logged('id');
        $action = $this->input->post("action");

        $this->timesheet_model->delete_read_all_notif($action, $user_id);

        echo json_encode("success");
    }
    public function shift_duration_checker()
    {
        $attn_id = $this->input->post("attn_id");
        $shift_duration_and_overtime = $this->timesheet_model->calculateShiftDuration_and_overtime($attn_id);
        $data = new stdClass();
        $data->shift_duration = $shift_duration_and_overtime[0];
        $data->overtime = $shift_duration_and_overtime[1];
        $overtime_status = $this->db->get_where("timesheet_attendance", array('id' => $attn_id, 'status' => 1))->num_rows();
        if ($overtime_status > 0) {
            $overtime_status = $this->db->get_where("timesheet_attendance", array('id' => $attn_id, 'overtime_status' => 1))->num_rows();
            if ($overtime_status > 0) {
                $data->not_overtime_notice = false;
            } else {
                $data->not_overtime_notice = true;
            }
        } else {
            $data->not_overtime_notice = false;
        }
        if ($this->session->userdata('autoclockout_timer_closed') === "") {
            $data->autoclockout_timer_closed = false;
        } else {
            $data->autoclockout_timer_closed = $this->session->userdata('autoclockout_timer_closed');
        }

        echo json_encode($data);
    }
    public function showScheduleTable()
    {
        $user_id = logged('id');
        $company_id = logged('company_id');

        $week = strtotime($this->input->get('week'));
        // date_default_timezone_set('UTC');
        $week_convert = date('Y-m-d', $week);
        $date_this_week = array(
            "Monday" => date("M d", strtotime('monday this week', strtotime($week_convert))),
            "Tuesday" => date("M d", strtotime('tuesday this week', strtotime($week_convert))),
            "Wednesday" => date("M d", strtotime('wednesday this week', strtotime($week_convert))),
            "Thursday" => date("M d", strtotime('thursday this week', strtotime($week_convert))),
            "Friday" => date("M d", strtotime('friday this week', strtotime($week_convert))),
            "Saturday" => date("M d", strtotime('saturday this week', strtotime($week_convert))),
            "Sunday" => date("M d", strtotime('sunday this week', strtotime($week_convert))),
        );



        $date_this_check = array(
            0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
            1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
            2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
            3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
            4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
            5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
            6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
            7 => date("Y-m-d", strtotime('monday next week', strtotime($week_convert))),
        );

        $users = $this->users_model->getUsers();
        $user_roles = $this->users_model->getRoles();

        $display = '';
        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<td>Employee</td>';
        // $display .= '<td>Action</td>';
        // $display .= '<td class="day"><span class="week-day">Mon</span><span class="week-date">' . $date_this_week['Monday'] . '</span></td>';
        // $display .= '<td class="day"><span class="week-day">Tue</span><span class="week-date">' . $date_this_week['Tuesday'] . '</span></td>';
        // $display .= '<td class="day"><span class="week-day">Wed</span><span class="week-date">' . $date_this_week['Wednesday'] . '</span></td>';
        // $display .= '<td class="day"><span class="week-day">Thu</span><span class="week-date">' . $date_this_week['Thursday'] . '</span></td>';
        // $display .= '<td class="day"><span class="week-day">Fri</span><span class="week-date">' . $date_this_week['Friday'] . '</span></td>';
        // $display .= '<td class="day"><span class="week-day">Sat</span><span class="week-date">' . $date_this_week['Saturday'] . '</span></td>';
        // $display .= '<td class="day"><span class="week-day">Sun</span><span class="week-date">' . $date_this_week['Sunday'] . '</span></td>';
        $display .= '<td class="day"><span class="week-date">' . $date_this_week['Monday'] . '- Mon</span><span>Shift Start - Shift End</span></td>';
        $display .= '<td class="day"><span class="week-date">' . $date_this_week['Tuesday'] . '- Tue</span><span>Shift Start - Shift End</span></td>';
        $display .= '<td class="day"><span class="week-date">' . $date_this_week['Wednesday'] . '- Wed</span><span>Shift Start - Shift End</span></td>';
        $display .= '<td class="day"><span class="week-date">' . $date_this_week['Thursday'] . '- Thu</span><span>Shift Start - Shift End</span></td>';
        $display .= '<td class="day"><span class="week-date">' . $date_this_week['Friday'] . '- Fri</span><span>Shift Start - Shift End</span></td>';
        $display .= '<td class="day"><span class="week-date">' . $date_this_week['Saturday'] . '- Sat</span><span>Shift Start - Shift End</span></td>';
        $display .= '<td class="day"><span class="week-date">' . $date_this_week['Sunday'] . '- Sun</span><span>Shift Start - Shift End</span></td>';
        $display .= '<td>Total Hours</td>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody>';
        foreach ($users as $user) {
            $display .= '<tr>';
            foreach ($user_roles as $role) {
                if ($user->role == $role->id) {
                    $role_title = $role->title;
                }
            }
            $status = "";
            if ($user->status == 1) {
                $status = "Full Time";
            }
            $employee_schedules = $this->timesheet_model->get_employee_shift_schedule($user->id, $date_this_check);
            if (count($employee_schedules) > 0) {
                $image = userProfilePicture($user->id);
                if ($image == urlUpload('users/default.png') || $image == NULL ) {
                    $initials = getLoggedNameInitials($user->id);
                    $display .= '<td>
                                    <div style="display: table; height: 40px;">
                                        <div style="display: table-cell; vertical-align: middle;">
                                            <div class="profile-img" style="background-color: #6a4a86; border-radius: 50%; width: 40px; height: 40px; text-align: center; line-height: 40px;">
                                                <span style="color: #fff; font-size: 18px;">' . $initials . '</span>
                                            </div>
                                        </div>
                                        <div style="display: block;width:121px; vertical-align: middle;margin-left:13px;">
                                            <span class="employee-name" style="display: block; font-size: 16px; line-height: 1.2;">' . $user->FName . ' ' . $user->LName . '</span>
                                            <span class="sub-text" style="display: block; font-size: 14px; color: #888; margin-top: 2px;"><i class="bx bxs-user-circle"></i> ' . $role_title . '</span>
                                        </div>
                                    </div>
                                 </td>';
                } else {
                    $display .= '<td>
                                    <div style="display: table; height: 40px;">
                                        <div style="display: table-cell; vertical-align: middle;">
                                            <div class="profile-img" style="background-image: url(\'' . $image . '\'); background-size: cover; background-position: center; border-radius: 50%; width: 40px; height: 40px;">
                                            </div>
                                        </div>
                                        <div style="display: block;width:121px; vertical-align: middle;margin-left:13px;">
                                            <span class="employee-name" style="display: block; font-size: 16px; line-height: 1.2;">' . $user->FName . ' ' . $user->LName . '</span>
                                            <span class="sub-text" style="display: block; font-size: 14px; color: #888; margin-top: 2px;"><i class="bx bxs-user-circle"></i> ' . $role_title . '</span>
                                        </div>
                                    </div>
                                 </td>';
                }

                // $display .= '<td><span class="employee-name">' . $user->FName . " " . $user->LName . '</span><span class="sub-text">' . $role_title . ' | ' . $status . '</span></td>';
                // $display .= '<td><a class="group-copy-btn" title="Copy" data-id="' . $user->id . '"><i class="fa fa-clone" aria-hidden="true"></i></a>';
                // $display .= '<a  class="group-paste-btn" title="Paste"><i class="fa fa-clipboard" aria-hidden="true"></i></a></div>';
                // $display .= '<label class="copy-alert group"  id="copy_all_' . $user->id . '" style="display:none;">Copied!</label></td>';

                $mon = '';
                $tue = '';
                $wed =  '';
                $thur =  '';
                $fri =  '';
                $sat =  '';
                $sun =  '';
                $duration = 0;
                // $tester = "";
                foreach ($employee_schedules as $schedule) {
                    date_default_timezone_set('UTC');
                    $the_date_start = strtotime($schedule->shift_start);
                    $the_date_end = strtotime($schedule->shift_end);
                    date_default_timezone_set($this->session->userdata('usertimezone'));
                    $shift_start_date = date('Y-m-d', $the_date_start);
                    $shift_start = date('H:i', $the_date_start);
                    $shift_end_date = date('Y-m-d', $the_date_end);
                    $shift_end = date('H:i', $the_date_end);

                    // $tester .=  "Original: " . $schedule->shift_start . " <br>" . $this->session->userdata('usertimezone') . " Converted: " . $shift_start_date . "  :  " . $shift_start . "<br>";
                    if ($date_this_check[0] == $shift_start_date) {
                        $mon = $this->shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user->id, 1, "Tuesday");
                        $duration += $schedule->duration;
                    } elseif ($date_this_check[1] == $shift_start_date) {
                        $tue = $this->shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user->id, 2, "Wednesday");
                        $duration += $schedule->duration;
                    } elseif ($date_this_check[2] == $shift_start_date) {
                        $wed = $this->shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user->id, 3, "Thursday");
                        $duration += $schedule->duration;
                    } elseif ($date_this_check[3] == $shift_start_date) {
                        $thur = $this->shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user->id, 4, "Friday");
                        $duration += $schedule->duration;
                    } elseif ($date_this_check[4] == $shift_start_date) {
                        $fri = $this->shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user->id, 5, "Saturday");
                        $duration += $schedule->duration;
                    } elseif ($date_this_check[5] == $shift_start_date) {
                        $sat = $this->shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user->id, 6, "Sunday");
                        $duration += $schedule->duration;
                    } elseif ($date_this_check[6] == $shift_start_date) {
                        $sun = $this->shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user->id, 7, "Monday");
                        $duration += $schedule->duration;
                    }
                }
                if ($mon == '') {
                    $mon = $this->shift_schedule_td_setter($date_this_check[0], "", $date_this_check[0], "", $user->id, 1, "blank");
                }
                if ($tue == '') {
                    $tue = $this->shift_schedule_td_setter($date_this_check[1], "", $date_this_check[1], "", $user->id, 2, "blank");
                }
                if ($wed == '') {
                    $wed = $this->shift_schedule_td_setter($date_this_check[2], "", $date_this_check[2], "", $user->id, 3, "blank");
                }
                if ($thur == '') {
                    $thur = $this->shift_schedule_td_setter($date_this_check[3], "", $date_this_check[3], "", $user->id, 4, "blank");
                }
                if ($fri == '') {
                    $fri = $this->shift_schedule_td_setter($date_this_check[4], "", $date_this_check[4], "", $user->id, 5, "blank");
                }
                if ($sat == '') {
                    $sat = $this->shift_schedule_td_setter($date_this_check[5], "", $date_this_check[5], "", $user->id, 6, "blank");
                }
                if ($sun == '') {
                    $sun = $this->shift_schedule_td_setter($date_this_check[6], "", $date_this_check[6], "", $user->id, 7, "blank");
                }
                $display .= $mon . $tue . $wed . $thur . $fri . $sat . $sun;
                $display .= '<td class="center"><label class="total-hours" id="duration' . $user->id . '"><i class="bx bxs-time"></i> ' . round($duration, 2) . ' hrs</label></td>';
            } else {
                $image = userProfilePicture($user->id);
                if (is_null($image)) {
                    $initials = getLoggedNameInitials($user->id);
                    $display .= '<td>
                                    <div style="display: table; height: 40px;">
                                        <div style="display: table-cell; vertical-align: middle;">
                                            <div class="profile-img" style="background-color: #6a4a86; border-radius: 50%; width: 40px; height: 40px; text-align: center; line-height: 40px;">
                                                <span style="color: #fff; font-size: 18px;">' . $initials . '</span>
                                            </div>
                                        </div>
                                        <div style="display: block;width:121px; vertical-align: middle;margin-left:13px;">
                                            <span class="employee-name" style="display: block; font-size: 16px; line-height: 1.2;">' . $user->FName . ' ' . $user->LName . '</span>
                                            <span class="sub-text" style="display: block; font-size: 14px; color: #888; margin-top: 2px;"><i class="bx bxs-user-circle"></i> ' . $role_title . '</span>
                                        </div>
                                    </div>
                                 </td>';
                } else {
                    $display .= '<td>
                                    <div style="display: table; height: 40px;">
                                        <div style="display: table-cell; vertical-align: middle;">
                                            <div class="profile-img" style="background-image: url(\'' . $image . '\'); background-size: cover; background-position: center; border-radius: 50%; width: 40px; height: 40px;">
                                            </div>
                                        </div>
                                        <div style="display: block;width:121px; vertical-align: middle;margin-left:13px;">
                                            <span class="employee-name" style="display: block; font-size: 16px; line-height: 1.2;">' . $user->FName . ' ' . $user->LName . '</span>
                                            <span class="sub-text" style="display: block; font-size: 14px; color: #888; margin-top: 2px;"><i class="bx bxs-user-circle"></i> ' . $role_title . '</span>
                                        </div>
                                    </div>
                                 </td>';
                }

                // $display .= '<td><span class="employee-name">' . $user->FName . " " . $user->LName . '</span><span class="sub-text">' . $role_title . ' | ' . $status . '</span></td>';
                // $display .= '<td><a class="group-copy-btn" style="display:none;" title="Copy" data-id="' . $user->id . '"><i class="fa fa-clone" aria-hidden="true"></i></a>';
                // $display .= '<a  class="group-paste-btn" title="Paste"><i class="fa fa-clipboard" aria-hidden="true"></i></a></div>';
                // $display .= '<label class="copy-alert"  id="copy_all_' . $user->id . '" style="display:none;">Copied!</label></td>';
                for ($i = 0; $i < 7; $i++) {
                    $display .= '<td class="center">';
                    $display .= '<input type="time" data-date="' . $date_this_check[$i] . '" data-id="' . $user->id . '" data-column="' . ($i + 1) . '" class="shift-start-input blank popover-info-start" value="">';
                    $display .= '';
                    $display .= '<input type="time" data-date="' . $date_this_check[$i] . '" data-id="' . $user->id . '" data-column="' . ($i + 1) . '" class="shift-end-input blank popover-info-end" value="">';
                    //$display .= '<label class="shift-end-day-indecator" style="display:none;"></label>';
                    $display .= '<div class="row-action-buttons"><a class="nsm-button copy-btn" href="javascript:void(0);" data-column= "' . ($i + 1) . '" data-id="' . $user->id . '"><i class="bx bx-copy-alt"></i></a>';
                    $display .= '<a  class="nsm-button paste-btn" href="javascript:void(0);"><i class="bx bx-paste"></i></a></div>';
                    //$display .= '<label class="copy-alert"  id="copy_id_' . $user->id . '_' . ($i + 1) . '" style="display:none;">Copied!</label>';
                    $display .= '</td>';
                }
                $display .= '<td class="center"><label class="total-hours" id="duration' . $user->id . '"><i class="bx bxs-time"></i> 0 hr</label></td>';
            }
            $display .= '</tr>';
        }
        $display .= '</tbody>';

        echo json_encode($display);
    }
    public function shift_schedule_td_setter($shift_start_date, $shift_start, $shift_end_date, $shift_end, $user_id, $column, $cross_over_day)
    {
        $input_style = "";
        if ($cross_over_day == "blank") {
            $input_style = "blank";
            $copy_dive_style = "padding-top:10px;";
            $copy_style = "display:none";
        }
        $display = '<td class="center">';
        $display .= '<input type="time" data-date="' . $shift_start_date . '" data-id="' . $user_id . '" data-column="' . $column . '" class="shift-start-input popover-info-start' . $input_style . '" value="' . $shift_start . '">';
        //$display .= '<p><i class="fa fa-arrow-down" aria-hidden="true"></i></p>';
        $display .= '<input type="time" data-date="' . $shift_start_date . '" data-id="' . $user_id . '" data-column="' . $column . '" class="shift-end-input popover-info-end' . $input_style . '" value="' . $shift_end . '">';
        // if ($shift_start_date != $shift_end_date) {
        //     $display .= '<label class="shift-end-day-indecator">' . $cross_over_day . '</label>';
        // } else {
        //     $display .= '<label class="shift-end-day-indecator" style="display:none;"></label>';
        //     $copy_dive_style .= "padding-top:10px;";
        // }
        $display .= '<div class="row-action-buttons"><a class="nsm-button copy-btn" href="javascript:void(0);" data-column= "' . ($column) . '" data-id="' . $user_id . '"><i class="bx bx-copy-alt"></i></a>';
        $display .= '<a class="nsm-button paste-btn" href="javascript:void(0);"><i class="bx bx-paste"></i></a></div>';
        //$display .= '<label class="copy-alert"  id="copy_id_' . $user_id . '_' . ($column) . '" style="display:none;">Copied!</label>';
        $display .= '</td>';
        return $display;
    }
    public function set_schedule()
    {


        // date_default_timezone_set($this->session->userdata('usertimezone'));
        $week_schedule = $this->input->post("week_schedule");
        $week = date('Y-m-d', strtotime($week_schedule));
        $the_date = strtotime($week);
        // date_default_timezone_set("UTC");
        $week_convert = date("Y-m-d", $the_date);

        $date_this_check = array(
            0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
            1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
            2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
            3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
            4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
            5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
            6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
        );

        $new_shift_starts = $this->input->post("new_shift_starts");
        $new_shift_start_ids = $this->input->post("new_shift_start_ids");
        $new_shift_start_dates = $this->input->post("new_shift_start_dates");
        $new_shift_starts_columns = $this->input->post("new_shift_starts_columns");
        $new_shift_starts_ctr = $this->input->post("new_shift_starts_ctr");

        $new_shift_ends = $this->input->post("new_shift_ends");
        $new_shift_end_ids = $this->input->post("new_shift_end_ids");
        $new_shift_end_dates = $this->input->post("new_shift_end_dates");
        $new_shift_ends_columns = $this->input->post("new_shift_ends_columns");
        $new_shift_ends_ctr = $this->input->post("new_shift_ends_ctr");


        $new_schedules = array();
        $all_employee_schedules = $this->timesheet_model->get_all_employee_shift_schedule($date_this_check);

        for ($a = 0; $a < $new_shift_starts_ctr; $a++) {
            $shift_date = $new_shift_start_dates[$a];
            $shift_start = $new_shift_start_dates[$a] . " " . $new_shift_starts[$a];
            $user_id = $new_shift_start_ids[$a];
            $column = $new_shift_starts_columns[$a];
            $found_shift_end = false;
            $shift_end = "";
            for ($x = 0; $x < $new_shift_ends_ctr; $x++) {
                if ($new_shift_end_ids[$x] == $user_id && $new_shift_ends_columns[$x] == $column) {
                    $found_shift_end = true;
                    $shift_end = $new_shift_end_dates[$x] . " " . $new_shift_ends[$x];
                    break;
                }
            }

            date_default_timezone_set($this->session->userdata('usertimezone'));
            $the_date = strtotime($shift_start);
            date_default_timezone_set("UTC");
            $shift_start = date("Y-m-d H:i:s", $the_date);
            $shift_date = date("Y-m-d", $the_date);
            if ($found_shift_end) {
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $the_date = strtotime($shift_end);
                date_default_timezone_set("UTC");
                $shift_end = date("Y-m-d H:i:s", $the_date);
            }
            $sched_exist = false;
            foreach ($all_employee_schedules as $schedule) {
                if ($schedule->shift_date == $shift_date && $schedule->user_id == $user_id) {
                    if ($found_shift_end) {
                        $existing_schedule = array(
                            'shift_start' => $shift_start,
                            'shift_end' => $shift_end,
                            'duration' => $this->get_differenct_of_dates($shift_start, $shift_end)
                        );
                    } else {
                        $existing_schedule = array(
                            'shift_start' => $shift_start,
                            'duration' => 8
                        );
                    }
                    $sched_exist = true;
                    break;
                }
            }
            if ($sched_exist) {
                $this->timesheet_model->update_existing_schedule($existing_schedule, $shift_date, $user_id);
            } else {
                if ($found_shift_end) {
                    $new_schedules[] = array(
                        'shift_date' => $shift_date,
                        'shift_start' => $shift_start,
                        'shift_end' => $shift_end,
                        'user_id' => $user_id,
                        'duration' => $this->get_differenct_of_dates($shift_start, $shift_end)
                    );
                } else {
                    $new_schedules[] = array(
                        'shift_date' => $shift_date,
                        'shift_start' => $shift_start,
                        'user_id' => $user_id,
                        'duration' => 8
                    );
                }
            }
        }
        if (count($new_schedules) > 0) {
            $this->timesheet_model->add_new_shift_shedules($new_schedules);
        }
        $delet_shift_dates = $this->input->post("delete_shift_dates");
        $delete_shift_dates_user_ids = $this->input->post("delete_shift_dates_user_ids");
        $delete_these_shift_dates_on_db = "";
        if ($delet_shift_dates != "") {
            for ($i = 0; $i < count($delet_shift_dates); $i++) {
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $the_date = strtotime($delet_shift_dates[$i] . " 00:00:00");
                date_default_timezone_set("UTC");
                $shift_date = date("Y-m-d", $the_date);
                if ($delete_these_shift_dates_on_db != "") {
                    $delete_these_shift_dates_on_db .= " or ";
                }
                if ($delete_shift_dates_user_ids[$i] != "") {
                    $delete_these_shift_dates_on_db .= "(shift_date ='" . $shift_date . "' AND user_id =" . $delete_shift_dates_user_ids[$i] . ")";
                }
            }
            $this->timesheet_model->delete_shift_schedule($delete_these_shift_dates_on_db);
        }

        $data = new stdClass();
        $data->all_employee_schedules = $date_this_check;
        echo json_encode($data);
    }
    public function get_differenct_of_dates($date_start, $date_end, $late_checker = false)
    {
        $start = new DateTime($date_start);
        $end =  new DateTime($date_end);
        $interval = $start->diff($end);

        $difference = ($interval->days * 24 * 60) * 60;
        $difference += ($interval->h * 60) * 60;
        $difference += ($interval->i) * 60;
        $difference += $interval->s;
        if ($late_checker) {
            if ($date_start > $date_end) {
                return 0;
            } else {
                return ($difference / 60) / 60;
            }
        } else {
            return ($difference / 60) / 60;
        }
    }
    public function autoclockout_timer_closed()
    {
        $_SESSION['autoclockout_timer_closed'] = true;
        echo json_encode("session set");
    }
    public function attendance_logs()
    {
        if(!checkRoleCanAccessModule('user-settings-time-logs', 'read')){
			show403Error();
			return false;
		}

        add_css(array(
            "assets/css/timesheet/timesheet_attendance_logs.css"
        ));

        add_footer_js(array(
            "assets/js/timesheet/timesheet_attendance_logs.js"

        ));

        $this->page_data['page']->title = 'Attendance Logs';
        $this->page_data['page']->parent = 'timesheet';

        $this->load->model('timesheet_model');
        $this->page_data['newforyou'] = $this->timesheet_model->getNewForyouNotifications();

        // var_dump($this->page_data['allnotification']);
        $this->load->view('v2/pages/users/timesheet_attendance_logs', $this->page_data);
    }

    public function show_attendance_logs_table()
    {
        $date_from = $this->input->post("date_from");
        $date_to = $this->input->post("date_to");
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_from . " 00:00:00");
        date_default_timezone_set("UTC");
        $date_from = date("Y-m-d", $the_date);


        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_to . " 24:59:00");
        date_default_timezone_set("UTC");
        $date_to = date("Y-m-d H:i:s", $the_date);
        $company_id = logged('company_id');
        $attendances = $this->timesheet_model->get_all_attendance($date_from, $date_to, $company_id);
        $display = '';

        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<td style="width: 200px;">Employee</td>';
        $display .= '<td>Shift Date</td>';
        $display .= '<td>Clock In</td>';
        $display .= '<td>Clock Out</td>';
        $display .= '<td>Break in</td>';
        $display .= '<td>Break out</td>';
        $display .= '<td>Expected Shift Duration</td>';
        $display .= '<td>Expected Break Duration</td>';
        $display .= '<td>Expected Work Hours</td>';
        $display .= '<td>Worked Hours</td>';
        $display .= '<td>Break Duration</td>';
        $display .= '<td>Late in minutes</td>';
        $display .= '<td>Overtime</td>';
        $display .= '<td>OT Status</td>';
        $display .= '<td>Payable Hours</td>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody class="employee-tbody">';
        foreach ($attendances as $attendance) {
            $shift_date = $attendance->date_created;
            date_default_timezone_set("UTC");
            $the_date = strtotime($shift_date);
            date_default_timezone_set($this->session->userdata('usertimezone'));
            $shift_date = date("m/d/Y", $the_date);

            $display .= '<tr role="row" class="odd">';
            $display .= '<td>';
            $display .= '<span class="employee-name">' . $attendance->FName . ' ' .   $attendance->LName . '</span><span class="employee-role">' . $attendance->title . '</span>';
            $display .= '</td>';
            $display .= '<td class="center"><label class="time-log gray">' . $shift_date . '</td>';


            date_default_timezone_set("UTC");
            $shift_schedules = $this->timesheet_model->get_schedule_in_shift_date(date("Y-m-d", strtotime($attendance->date_created)), $attendance->user_id);
            $shift_start = '';
            $shift_end = '';
            $expected_hours = '';
            $expected_break = '';
            $expected_work_hours = '';
            foreach ($shift_schedules as $sched) {
                $olddate_start = $sched->shift_start;
                $olddate_end = $sched->shift_end;
                date_default_timezone_set("UTC");
                $the_date1 = strtotime($olddate_start);
                $the_date2 = strtotime($olddate_end);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate_start = date("m/d/Y h:i A", $the_date1);
                $newdate_end = date("m/d/Y h:i A", $the_date2);
                $shift_start = $newdate_start;
                $shift_end = $newdate_end;
                $expected_hours = $sched->duration;
                $expected_break = 0;
                if ($expected_hours > 4) {
                    $expected_break = 30;
                }
                if ($expected_hours > 6) {
                    $expected_break += 15;
                }
                if ($expected_hours >= 8) {
                    $expected_break = 60;
                }
                $expected_work_hours = round((($expected_hours * 60) - $expected_break) / 60, 2);
            }

           



            $auxes = $this->timesheet_model->get_logs_of_attendance($attendance->id);
            $checkin = '';
            $checkout = '';
            $breakin = '';
            $breakout = '';

            foreach ($auxes as $aux) {
                $olddate = $aux->date_created;
                date_default_timezone_set("UTC");
                $the_date = strtotime($olddate);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate = date("h:i A", $the_date);
                if ($aux->action == "Check in") {
                    $checkin = $newdate;
                } elseif ($aux->action == "Check out") {
                    $checkout = $newdate;
                } elseif ($aux->action == "Break in") {
                    $breakin = $newdate;
                } elseif ($aux->action == "Break out") {
                    $breakout = $newdate;
                }
            }

            $display .= '<td class="center"><label class="time-log gray">' . $checkin . '</label></td>';
            $display .= '<td class="center"><label class="time-log gray">' . $checkout . '</label></td>';
            $display .= '<td class="center"><label class="time-log gray">' . $breakin . '</label></td>';
            $display .= '<td class="center"><label class="time-log gray">' . $breakout . '</label></td>';
            $display .= '<td class="center">' . $expected_hours . '</td>';
            $display .= '<td class="center">' . $expected_break . '</td>';
            $display .= '<td class="center">' . $expected_work_hours . '</td>';
            $display .= '<td class="center num_only time-log">' . ($attendance->shift_duration + $attendance->overtime) . '</td>';
            $display .= '<td class="center num_only time-log">' . $attendance->break_duration . '</td>';
            $minutes_late = "";
            if ($shift_start != '') {
                $minutes_late = $this->get_differenct_of_dates($shift_start, $checkin) * 60;
            }
            $display .= '<td class="center num_only time-log">' . round($minutes_late, 2) . '</td>';
            $overtime = 0;
            if ($expected_hours != '') {
                if ($expected_work_hours < ($attendance->shift_duration + $attendance->overtime)) {
                    $overtime = round(($attendance->shift_duration + $attendance->overtime) - $expected_work_hours, 2);
                } elseif ($attendance->shift_duration == 0) {
                    $overtime = 0;
                } else {
                    $overtime = $expected_work_hours;
                }
            } else {
                $overtime = $attendance->overtime;
            }
            $display .= '<td class="center num_only time-log">' . $overtime . '</td>';
            if ($attendance->overtime_status == 1) {
                $ot_status = "Pending";
            } elseif ($attendance->overtime_status == 0) {
                $ot_status = "Denied";
            } else {
                $ot_status = "Approved";
            }
            $display .= '<td class="center num_only"><label class="time-log ">' . $ot_status . '</td>';
            $payable_hours = $attendance->shift_duration;
            if ($expected_hours != '') {
                if ($payable_hours > $expected_work_hours) {
                    $payable_hours = $expected_work_hours;
                }
            }
            if ($ot_status === "Approved") {
                $payable_hours = $payable_hours + $attendance->overtime;
            }
            $display .= '<td class="center num_only time-log">' . $payable_hours . '</td>';
            $display .= '</tr>';
        }
        $display .= '</tbody>';
        $display .= '<tfoot>';
        $display .= '<tr>';
        $display .= '<td colspan="9" style="text-align: right;">Total :</td>';
        $display .= '<td class="center num_only"></td>';
        $display .= '<td class="center num_only"></td>';
        $display .= '<td class="center num_only"></td>';
        $display .= '<td class="center num_only"></td>';
        $display .= '<td class="center num_only"></td>';
        $display .= '<td class="center num_only"></td>';
        $display .= '</tr>';
        $display .= '</tfoot>';
        echo json_encode($display);
    }

    public function get_spicific_attendance_log()
    {
        $shift_date = $this->input->post("shift_date");
        $att_id = $this->input->post("att_id");
        $user_id = $this->input->post("user_id");
        $shift_schedules = $this->timesheet_model->get_schedule_in_shift_date($shift_date, $user_id);
        $shift_start = '';
        $shift_end = '';
        $expected_hours = '';
        $expected_break = '';
        $expected_work_hours = '';
        foreach ($shift_schedules as $sched) {
            $olddate_start = $sched->shift_start;
            $olddate_end = $sched->shift_end;
            date_default_timezone_set("UTC");
            $the_date1 = strtotime($olddate_start);
            $the_date2 = strtotime($olddate_end);
            date_default_timezone_set($this->session->userdata('usertimezone'));
            $newdate_start = date("m/d/Y h:i A", $the_date1);
            $newdate_end = date("m/d/Y h:i A", $the_date2);
            $shift_start = $newdate_start;
            $shift_end = $newdate_end;
            $expected_hours = $sched->duration;
            $shift_schedule_id = $sched->id;
            $expected_hours = $sched->duration;
            $expected_break = 0;
            if ($expected_hours > 4) {
                $expected_break = 30;
            }
            if ($expected_hours > 6) {
                $expected_break += 15;
            }
            if ($expected_hours >= 8) {
                $expected_break = 60;
            }
            $expected_work_hours = round((($expected_hours * 60) - $expected_break) / 60, 2);
        }


        $auxes = $this->timesheet_model->get_logs_of_attendance($att_id);
        $checkin_date = '';
        $checkout_date = '';
        $checkin_time = '';
        $checkout_time = '';
        $breakin_time = '';
        $breakout_time = '';
        $breakin_date = '';
        $breakout_date = '';
        foreach ($auxes as $aux) {
            $olddate = $aux->date_created;
            date_default_timezone_set("UTC");
            $the_date = strtotime($olddate);
            date_default_timezone_set($this->session->userdata('usertimezone'));
            $newdate = date("m/d/Y h:i A", $the_date);
            if ($aux->action == "Check in") {
                $checkin_date = date("Y-m-d", strtotime($newdate));
                $checkin_time = date("H:i", strtotime($newdate));
            } elseif ($aux->action == "Check out") {
                $checkout_date = date("Y-m-d", strtotime($newdate));
                $checkout_time = date("H:i", strtotime($newdate));
            } elseif ($aux->action == "Break in") {
                $breakin_date = date("Y-m-d", strtotime($newdate));
                $breakin_time = date("H:i", strtotime($newdate));
            } elseif ($aux->action == "Break out") {
                $breakout_date = date("Y-m-d", strtotime($newdate));
                $breakout_time = date("H:i", strtotime($newdate));
            }
        }


        date_default_timezone_set('UTC');
        $attendances = $this->timesheet_model->get_especitif_attendance($att_id);
        $ot_status = '';
        $clock_status = 0;
        foreach ($attendances as $attendance) {
            $clock_status = $attendance->status;
            $shift_durations = $attendance->shift_duration + $attendance->overtime;
            $break_duration = $attendance->break_duration;
            $overtime = $attendance->overtime;
            $attendance_note = $attendance->notes;
            if ($attendance->overtime_status == 1) {
                $ot_status = "Pending";
            } elseif ($attendance->overtime_status == 0) {
                $ot_status = "Denied";
            } else {
                $ot_status = "Approved";
            }

            $payable_hours = $attendance->shift_duration;
            if ($expected_hours != '') {
                if ($payable_hours > $expected_work_hours) {
                    $payable_hours = $expected_work_hours;
                }
            }
            if ($ot_status === "Approved") {
                $payable_hours = $payable_hours + $attendance->overtime;
            }
        }

        $minutes_late = "";
        if ($shift_start != '') {
            $minutes_late = round($this->get_differenct_of_dates($shift_start, $checkin_date . " " . $checkin_time) * 60, 2);
        }

        $footprints = $this->timesheet_model->get_attendance_logs_editor_footprint($att_id, 'attendance_log_update');
        $footprint_text = "";
        if (count($footprints) > 0) {
            foreach ($footprints as $editor) {
                $date = $this->datetime_zone_converter($editor->date_created, "UTC", $this->session->userdata("usertimezone"));
                $footprint_text = "Edited by " . $editor->FName . " " . $editor->LName . " last " . date("m-d-Y h:i A", strtotime($date));
            }
        }
        $data = new stdClass();
        $data->shift_date = $shift_date;
        $data->att_id = $att_id;
        $data->user_id = $user_id;
        $data->shift_start = $shift_start;
        $data->shift_end = $shift_end;
        $data->shift_schedule_id = $shift_schedule_id;
        $data->expected_hours = $expected_hours;
        $data->checkin_date = $checkin_date;
        $data->checkout_date = $checkout_date;
        $data->breakin_date = $breakin_date;
        $data->breakout_date = $breakout_date;
        $data->checkin_time = $checkin_time;
        $data->checkout_time = $checkout_time;
        $data->breakin_time = $breakin_time;
        $data->breakout_time = $breakout_time;
        $data->shift_durations = round($shift_durations, 2);
        $data->break_duration = $break_duration;
        $data->overtime = $overtime;
        $data->attendance_note = $attendance_note;
        $data->minutes_late = round($minutes_late, 2);
        $data->payable_hours = $payable_hours;
        $data->ot_status = $ot_status;
        $data->expected_break = $expected_break;
        $data->expected_work_hours = $expected_work_hours;
        $data->clock_status = $clock_status;
        $data->footprint_text = $footprint_text;
        echo json_encode($data);
    }
    public function get_differenct_of_dates_ajax()
    {
        $from_date = $this->input->post("from_date");
        if ($this->input->post("transaction") == "") {
            $to_date = $this->input->post("to_date");
        } else {
            $to_date = date("Y-m-d H:i:s");
        }
        $data = new stdClass();
        $data->difference = $this->get_differenct_of_dates($from_date, $to_date);
        $data->autoclockout_timer_closed = $this->session->userdata('autoclockout_timer_closed');
    }


    public function datetime_zone_converter($olddate, $from_timezone, $to_timezone)
    {
        date_default_timezone_set($from_timezone);
        $the_date = strtotime($olddate);
        date_default_timezone_set($to_timezone);
        $newdate = date("Y-m-d H:i:s", $the_date);
        return $newdate;
    }
    public function attendance_logs_update()
    {
        $form_timesheet_attendance_id = $this->input->post('form_timesheet_attendance_id');
        $form_user_id = $this->input->post('form_user_id');
        $form_timesheet_shift_schedule_id = $this->input->post('form_timesheet_shift_schedule_id');
        $form_shift_start = $this->input->post('form_shift_start');
        $form_shift_end = $this->input->post('form_shift_end');
        $form_clockin_date = $this->input->post('form_clockin_date');
        $form_clockin_time = $this->input->post('form_clockin_time');
        $form_clockout_date = $this->input->post('form_clockout_date');
        $form_clockout_time = $this->input->post('form_clockout_time');
        $form_breakin_date = $this->input->post('form_breakin_date');
        $form_breakin_time = $this->input->post('form_breakin_time');
        $form_breakout_date = $this->input->post('form_breakout_date');
        $form_breakout_time = $this->input->post('form_breakout_time');
        $form_expected_hours = $this->input->post('form_expected_hours');
        $form_worked_hours = $this->input->post('form_worked_hours');
        $form_break_duration = $this->input->post('form_break_duration');
        $form_over_time = $this->input->post('form_over_time');
        $form_attendance_notes = $this->input->post('form_attendance_notes');

        $update = array(
            "shift_duration" => $form_worked_hours - $form_over_time,
            "break_duration" => $form_break_duration,
            "overtime" => $form_over_time,
            "notes" => $form_attendance_notes
        );
        $where = array(
            array(
                "id",
                $form_timesheet_attendance_id
            )
        );
        $this->timesheet_model->attendance_logs_update($update, $where, "timesheet_attendance");

        if ($form_clockin_date != "") {
            $date_created = $this->datetime_zone_converter($form_clockin_date . " " . $form_clockin_time, $this->session->userdata('usertimezone'), "UTC");
            $this->timesheet_model->attendance_logs_update_timesheet_logs($form_timesheet_attendance_id, $date_created, 'Check in', $form_user_id);
        }
        if ($form_clockout_date != "") {
            $date_created = $this->datetime_zone_converter($form_clockout_date . " " . $form_clockout_time, $this->session->userdata('usertimezone'), "UTC");
            $this->timesheet_model->attendance_logs_update_timesheet_logs($form_timesheet_attendance_id, $date_created, 'Check out', $form_user_id);
        }
        if ($form_breakin_date != "") {
            $date_created = $this->datetime_zone_converter($form_breakin_date . " " . $form_breakin_time, $this->session->userdata('usertimezone'), "UTC");
            $this->timesheet_model->attendance_logs_update_timesheet_logs($form_timesheet_attendance_id, $date_created, 'Break in', $form_user_id);
        }
        if ($form_breakout_date != "") {
            $date_created = $this->datetime_zone_converter($form_breakout_date . " " . $form_breakout_time, $this->session->userdata('usertimezone'), "UTC");
            $this->timesheet_model->attendance_logs_update_timesheet_logs($form_timesheet_attendance_id, $date_created, 'Break out', $form_user_id);
        }
        $this->timesheet_model->attendance_logs_update_footprint_setter($form_timesheet_attendance_id, getLoggedUserID(), "attendance_log_update");
        echo json_encode(0);
    }
    public function get_shift_duration()
    {
        $data   = [];
        $att_id = $this->input->post("attn_id");
        if( $att_id > 0 ){
            $shifts = $this->timesheet_model->calculateShiftDuration_and_overtime($att_id);
            $overtime_status = $this->timesheet_model->get_attendance_overtime_status($att_id);

            $lunch_auxes = $this->timesheet_model->get_lunch_auxes($att_id);
            $lunch_in = "";
            $lunch_out = date('Y-m-d H:i:s');

            foreach ($lunch_auxes as $aux) {
                if ($aux->action == "Break in") {
                    $lunch_in = $aux->date_created;
                }
                if ($aux->action == "Break out") {
                    $lunch_out = $aux->date_created;
                }
            }
            $lunch_duration = $this->get_differenct_of_dates($lunch_in, $lunch_out);
            $data = new stdClass();
            $data->difference = $shifts[0] + $shifts[1];
            if ($overtime_status == 1) {
                $_SESSION['autoclockout_timer_closed'] = true;
                $data->autoclockout_timer_closed = $this->session->userdata('autoclockout_timer_closed');
            }
            $data->over_lunch = false;
            if ($lunch_duration > 4 && $lunch_in != "") {
                $data->over_lunch = true;
            }
            $data->overtime_status = $overtime_status;
            $data->lunch_duration = $lunch_duration;
            $data->lunch_in = $lunch_in;
            $data->lunch_out = $lunch_out;            
        }        

        echo json_encode($data);
    }

    public function download_attendance_sheet_logs_to_excel()
    {
        $date_from = $this->input->post("date_from");
        $date_to = $this->input->post("date_to");
        // file name
        $filename = $date_from . " to " . $date_to . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        // get data



        // file creation



        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_from . " 00:00:00");
        date_default_timezone_set("UTC");
        $date_from = date("Y-m-d", $the_date);


        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_to . " 24:59:00");
        date_default_timezone_set("UTC");
        $date_to = date("Y-m-d H:i:s", $the_date);
        $company_id = logged('company_id');
        $attendances = $this->timesheet_model->get_all_attendance($date_from, $date_to, $company_id);

        $file = fopen('php://output', 'w');
        $header = array(
            "Employee",
            "Title",
            "Shift Date",
            "Shift Start",
            "Shift End",
            "Clock In",
            "Clock Out",
            "Break in",
            "Break out",
            "Expected Shift Duration",
            "Expected Break Duration",
            "Expected Work Hours",
            "Worked Hours",
            "Break Duration",
            "Late in minutes",
            "Overtime",
            "OT Status",
            "Payable Hours",
            "Notes"
        );
        fputcsv($file, $header);
        foreach ($attendances as $attendance) {
            $data = array();
            $shift_date = $attendance->date_created;
            date_default_timezone_set("UTC");
            $the_date = strtotime($shift_date);
            date_default_timezone_set($this->session->userdata('usertimezone'));
            $shift_date = date("m/d/Y", $the_date);

            $data[] = $attendance->FName . ' ' .   $attendance->LName;
            $data[] = $attendance->title;
            $data[] = $shift_date;

            date_default_timezone_set("UTC");
            $shift_schedules = $this->timesheet_model->get_schedule_in_shift_date(date("Y-m-d", strtotime($attendance->date_created)), $attendance->user_id);
            $shift_start = '';
            $shift_end = '';
            $expected_hours = '';
            $expected_break = '';
            $expected_work_hours = '';
            foreach ($shift_schedules as $sched) {
                $olddate_start = $sched->shift_start;
                $olddate_end = $sched->shift_end;
                date_default_timezone_set("UTC");
                $the_date1 = strtotime($olddate_start);
                $the_date2 = strtotime($olddate_end);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate_start = date("m/d/Y h:i A", $the_date1);
                $newdate_end = date("m/d/Y h:i A", $the_date2);
                $shift_start = $newdate_start;
                $shift_end = $newdate_end;
                $expected_hours = $sched->duration;
                $expected_break = 0;
                if ($expected_hours > 4) {
                    $expected_break = 30;
                }
                if ($expected_hours > 6) {
                    $expected_break += 15;
                }
                if ($expected_hours >= 8) {
                    $expected_break = 60;
                }
                $expected_work_hours = round((($expected_hours * 60) - $expected_break) / 60, 2);
            }

            $data[] = $shift_start;
            $data[] = $shift_end;



            $auxes = $this->timesheet_model->get_logs_of_attendance($attendance->id);
            $checkin = '';
            $checkout = '';
            $breakin = '';
            $breakout = '';

            foreach ($auxes as $aux) {
                $olddate = $aux->date_created;
                date_default_timezone_set("UTC");
                $the_date = strtotime($olddate);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate = date("m/d/Y h:i A", $the_date);
                if ($aux->action == "Check in") {
                    $checkin = $newdate;
                } elseif ($aux->action == "Check out") {
                    $checkout = $newdate;
                } elseif ($aux->action == "Break in") {
                    $breakin = $newdate;
                } elseif ($aux->action == "Break out") {
                    $breakout = $newdate;
                }
            }
            $data[] = $checkin;
            $data[] = $checkout;
            $data[] = $breakin;
            $data[] = $breakout;
            $data[] = $expected_hours;
            $data[] = $expected_break;
            $data[] = $expected_work_hours;
            $data[] =  ($attendance->shift_duration + $attendance->overtime);

            $data[] = $attendance->break_duration;

            $minutes_late = "";
            if ($shift_start != '') {
                $minutes_late = $this->get_differenct_of_dates($shift_start, $checkin) * 60;
            }
            $data[] = round($minutes_late, 2);
            $overtime = 0;
            if ($expected_hours != '') {
                if ($expected_work_hours < ($attendance->shift_duration + $attendance->overtime)) {
                    $overtime = round(($attendance->shift_duration + $attendance->overtime) - $expected_work_hours, 2);
                } elseif ($attendance->shift_duration == 0) {
                    $overtime = 0;
                } else {
                    $overtime = $expected_work_hours;
                }
            } else {
                $overtime = $attendance->overtime;
            }
            $data[] = $overtime;
            if ($attendance->overtime_status == 1) {
                $ot_status = "Pending";
            } elseif ($attendance->overtime_status == 0) {
                $ot_status = "Denied";
            } else {
                $ot_status = "Approved";
            }
            $data[] = $ot_status;
            $payable_hours = $attendance->shift_duration;
            if ($expected_hours != '') {
                if ($payable_hours > $expected_work_hours) {
                    $payable_hours = $expected_work_hours;
                }
            }
            if ($ot_status === "Approved") {
                $payable_hours = $payable_hours + $attendance->overtime;
            }

            $data[] = $payable_hours;
            $data[] = $attendance->notes;
            fputcsv($file, $data);
        }
        fclose($file);
        exit;
    }
    public function show_OT_Requests()
    {
        $ot_requests = $this->timesheet_model->getPendingOTs(logged('company_id'));
        $display = "<thead>";
        $display .= "<tr>";
        $display .= "<th>Employee</th>";
        $display .= "<th>Shift Date</th>";
        $display .= "<th>Clock in</th>";
        $display .= "<th>Clock out</th>";
        $display .= "<th>Shift Duration</th>";
        $display .= "<th>Overtime</th>";
        $display .= "<th>Status</th>";
        $display .= "<th>Approver</th>";
        $display .= "<th>Action</th>";
        $display .= "</tr>";
        $display .= "</thead>";
        $display .= "<tbody>";

        foreach ($ot_requests as $request) {
            $shift_date_usertimezone = $this->datetime_zone_converter($request->date_created, "UTC", $this->session->userdata('usertimezone'));
            $clock_out_usertimezone = $this->datetime_zone_converter($request->clockout_time, "UTC", $this->session->userdata('usertimezone'));
            $display .= "<tr>";
            $display .= "<td>" . $request->FName . " " . $request->LName . "</td>";

            $display .= "<td>" . date("m-d-Y", strtotime($shift_date_usertimezone)) . "</td>";
            $display .= "<td>" . date("m-d-Y h:i A", strtotime($shift_date_usertimezone)) . "</td>";
            $display .= "<td>" . date("m-d-Y h:i A", strtotime($clock_out_usertimezone)) . "</td>";
            $display .= "<td style='text-align:center;'>" . ($request->shift_duration + $request->overtime) . "</td>";
            $display .= "<td style='text-align:center;'>" .  $request->overtime . "</td>";
            $overtime_status = "Pending";
            if ($request->overtime_status == 2) {
                $overtime_status = "Approved";
            }
            $display .= "<td style='text-align:center;'>" .  $overtime_status . "</td>";

            $approver = "";
            $approvers = $this->timesheet_model->get_ot_approver($request->id);
            foreach ($approvers as $editor) {
                $approver = $editor->FName . " " . $editor->LName;
            }
            $display .= "<td style='text-align:center;'>" .  $approver . "</td>";
            $display .= '<td style="text-align:center;">';

            if ($request->overtime_status == 1) {
                $display .= '<a href="#" title="" data-name="' . $request->FName . " " . $request->LName . '" data-user-id="' . $request->user_id . '" data-attn-id="' . $request->id . '" data-toggle="tooltip" class="approve-ot-request btn btn-primary btn-sm" data-original-title="Approve"><i class="fa fa-thumbs-up fa-lg"></i> Approve</a>';
                $display .= '<a  href="#" title="" data-name="' . $request->FName . " " . $request->LName . '" data-user-id="' . $request->user_id . '" data-attn-id="' . $request->id . '" data-toggle="tooltip" class="deny-ot-request btn btn-warning btn-sm" data-original-title="Deny"><i class="fa fa-thumbs-down fa-lg"></i> Deny</a>';
            } else {
                $display .= '<a  href="#" title="" data-name="' . $request->FName . " " . $request->LName . '" data-user-id="' . $request->user_id . '" data-attn-id="' . $request->id . '" data-toggle="tooltip" class="deny-ot-request btn btn-danger btn-sm" data-original-title="Deny"><i class="fa fa-times fa-lg"></i> Deny</a>';
            }

            $display .= '</td>';

            $display .= "</tr>";
        }
        $display .= "</tbody>";
        echo json_encode($display);
    }
    public function approve_deny_ot_request()
    {
        $attn_id = $this->input->post("attendance_id");
        $user_id = $this->input->post("user_id");
        $action = $this->input->post("action");
        $this->timesheet_model->approve_deny_ot_request($attn_id, $user_id, $action);
        echo json_encode(0);
    }
    public function show_my_attendance_logs()
    {
        // $date_from = $this->input->post("date_from");
        // $date_to = $this->input->post("date_to");
        // date_default_timezone_set($this->session->userdata('usertimezone'));
        // $the_date = strtotime($date_from . " 00:00:00");
        // date_default_timezone_set("UTC");
        // $date_from = date("Y-m-d", $the_date);
        $date_from = $this->datetime_zone_converter($this->input->post("date_from") . " 00:00:00", $this->session->userdata('usertimezone'), "UTC");

        // date_default_timezone_set($this->session->userdata('usertimezone'));
        // $the_date = strtotime($date_to . " 24:59:00");
        // date_default_timezone_set("UTC");
        // $date_to = date("Y-m-d H:i:s", $the_date);
        $date_to = $this->datetime_zone_converter($this->input->post("date_to") . " 23:59:59", $this->session->userdata('usertimezone'), "UTC");
        $user_id = logged('id');
        $attendances = $this->timesheet_model->get_my_attendance($date_from, $date_to, $user_id);
        $display = '';

        // $display .= '<thead>';
        // $display .= '<tr>';
        // $display .= '<th>Shift Date</th>';
        // $display .= '<th>Shift Start</th>';
        // $display .= '<th>Shift End</th>';
        // $display .= '<th>Expected Work Hours</th>';
        // $display .= '<th>Clock in</th>';
        // $display .= '<th>Clock out</th>';
        // $display .= '<th>Worked Hours</th>';
        // $display .= '<th>Break Duration (minutes)</th>';
        // $display .= '<th>Late (minutes)</th>';
        // $display .= '<th>Overtime</th>';
        // $display .= '<th>OT Status</th>';
        // $display .= '<th>Action</th>';
        // $display .= '</tr>';
        // $display .= '</thead>';
        // $display .= '<tbody>';
        foreach ($attendances as $attendance) {
            $shift_date = date("m/d/Y", strtotime($this->datetime_zone_converter($attendance->date_created, "UTC", $this->session->userdata('usertimezone'))));

            // $display .= '<tr role="row" class="odd">';
            // $display .= '<td class="center">' . $shift_date . '</td>';

            $display .= '<tr>';
            $display .= '<td class="nsm-text-primary">' . $shift_date . '</td>';

            date_default_timezone_set("UTC");
            $shift_schedules = $this->timesheet_model->get_schedule_in_shift_date(date("Y-m-d", strtotime($attendance->date_created)), $attendance->user_id);
            $shift_start = '';
            $shift_end = '';
            $expected_hours = '';
            $expected_break = '';
            $expected_work_hours = '';
            foreach ($shift_schedules as $sched) {
                $olddate_start = $sched->shift_start;
                $olddate_end = $sched->shift_end;
                date_default_timezone_set("UTC");
                $the_date1 = strtotime($olddate_start);
                $the_date2 = strtotime($olddate_end);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate_start = date("m/d/Y h:i A", $the_date1);
                $newdate_end = date("m/d/Y h:i A", $the_date2);
                $shift_start = $newdate_start;
                $shift_end = $newdate_end;
                $expected_hours = $sched->duration;
                $expected_break = 0;
                if ($expected_hours > 4) {
                    $expected_break = 30;
                }
                if ($expected_hours > 6) {
                    $expected_break += 15;
                }
                if ($expected_hours >= 8) {
                    $expected_break = 60;
                }

                $expected_work_hours = round((($expected_hours * 60) - $expected_break) / 60, 2);
            }

            // $display .= '<td class="center">' . $shift_start . '</td>';
            // $display .= '<td class="center">' . $shift_end . '</td>';

            $display .= '<td>' . $shift_start . '</td>';
            $display .= '<td>' . $shift_end . '</td>';

            $auxes = $this->timesheet_model->get_logs_of_attendance($attendance->id);
            $checkin = '';
            $checkout = '';
            $breakin = '';
            $breakout = '';

            foreach ($auxes as $aux) {
                $olddate = $aux->date_created;
                date_default_timezone_set("UTC");
                $the_date = strtotime($olddate);
                date_default_timezone_set($this->session->userdata('usertimezone'));
                $newdate = date("m/d/Y h:i A", $the_date);
                if ($aux->action == "Check in") {
                    $checkin = $newdate;
                } elseif ($aux->action == "Check out") {
                    $checkout = $newdate;
                } elseif ($aux->action == "Break in") {
                    $breakin = $newdate;
                } elseif ($aux->action == "Break out") {
                    $breakout = $newdate;
                }
            }

            // $display .= '<td class="center">' . $expected_work_hours . '</td>';
            // $display .= '<td class="center">' . $checkin . '</td>';
            // $display .= '<td class="center">' . $checkout . '</td>';
            // $display .= '<td class="center num_only time-log">' . ($attendance->shift_duration + $attendance->overtime) . '</td>';

            $display .= '<td>' . $expected_work_hours . '</td>';
            $display .= '<td>' . $checkin . '</td>';
            $display .= '<td>' . $checkout . '</td>';
            $display .= '<td>' . ($attendance->shift_duration + $attendance->overtime) . '</td>';

            $minutes_late = "";
            if ($shift_start != '') {
                $minutes_late = $this->get_differenct_of_dates($shift_start, $checkin, true) * 60;
            }
            // $display .= '<td class="center num_only time-log">' . $attendance->break_duration . '</td>';
            // $display .= '<td class="center num_only time-log">' . round($minutes_late, 2) . '</td>';

            $display .= '<td>' . $attendance->break_duration . '</td>';
            $display .= '<td>' . round($minutes_late, 2) . '</td>';

            $overtime = 0;
            if ($expected_hours != '') {
                if ($expected_work_hours < ($attendance->shift_duration + $attendance->overtime)) {
                    $overtime = round(($attendance->shift_duration + $attendance->overtime) - $expected_work_hours, 2);
                } elseif ($attendance->shift_duration == 0) {
                    $overtime = 0;
                } else {
                    $overtime = 0;
                }
            } else {
                $overtime = $attendance->overtime;
            }
            // $display .= '<td class="center num_only time-log">' . $overtime . '</td>';
            $display .= '<td>' . $overtime . '</td>';
            if ($attendance->overtime_status == 1) {
                $ot_status = "Pending";
                $ot_badge = '<span class="nsm-badge text-capitalize">Pending</span>';
            } elseif ($attendance->overtime_status == 0) {
                $ot_status = "Denied";
                $ot_badge = '<span class="nsm-badge error text-capitalize">Pending</span>';
            } else {
                $ot_status = "Approved";
                $ot_badge = '<span class="nsm-badge success text-capitalize">Pending</span>';
            }
            // $display .= '<td class="center num_only">' . $ot_status . '</td>';
            $display .= '<td>' . $ot_badge . '</td>';
            $payable_hours = $attendance->shift_duration;
            if ($expected_hours != '') {
                if ($payable_hours > $expected_work_hours) {
                    $payable_hours = $expected_work_hours;
                }
            }
            if ($ot_status === "Approved") {
                $payable_hours = $payable_hours + $attendance->overtime;
            }
            // $display .= '<td class="center num_only time-log"><center>';
            // if ($checkout != "") {
            //     $display .= '<a title="" data-shift-date="' . $shift_date . '" data-name="' . $attendance->FName . " " . $attendance->LName . '" data-user-id="' . $attendance->user_id . '" data-att-id="' . $attendance->id . '" data-toggle="tooltip" class="adjust-my-attendance-request btn btn-primary btn-sm" data-original-title="Approve"><i class="fa fa-adjust fa-lg"></i> Request Adjustment</a>';
            //     if ($overtime > 0 && $attendance->overtime_status == 0) {
            //         $display .= '<a title="" data-shift-date="' . $shift_date . '" data-user-id="' . $attendance->user_id . '" data-attn-id="' . $attendance->id . '" data-toggle="tooltip" class="request-my-ot btn btn-warning btn-sm" data-original-title="Deny"><i class="fa fa-clock-o fa-lg"></i> Request OT Approval</a>';
            //     }
            // }
            // $display .= '</center></td>';

            $display .= '<td class="text-end">';
            if ($checkout != "") {
                $display .= '<a role="button" href="javascript:void(0);" class="nsm-button btn-sm primary btn-request-adjustment" data-shift-date="' . $shift_date . '" data-name="' . $attendance->FName . " " . $attendance->LName . '" data-user-id="' . $attendance->user_id . '" data-att-id="' . $attendance->id . '">Request Adjustment</a>';
                if ($overtime > 0 && $attendance->overtime_status == 0) {
                    $display .= '<a role="button" href="javascript:void(0);" class="nsm-button btn-sm btn-ot-approval" data-shift-date="' . $shift_date . '" data-user-id="' . $attendance->user_id . '" data-attn-id="' . $attendance->id . '">Request OT Approval</a>';
                }
            }
            $display .= '</td>';

            $display .= '</tr>';
        }
        // $display .= '</tbody>';

        if ($display == "") {
            $display .= '<tr>';
            $display .= '<td colspan="11"><div class="nsm-empty"><span>No results found.</span></div></td>';
            $display .= '</tr>';
        }

        echo json_encode($display);
    }
    public function request_my_ot()
    {
        $attn_id = $this->input->post("attendance_id");
        $user_id = $this->input->post("user_id");
        $this->timesheet_model->attendance_logs_update_footprint_setter($attn_id, $user_id, "employee_ot_requested");
        $this->timesheet_model->employee_ot_requested($attn_id);
        echo json_encode(0);
    }
    public function timezonesetter()
    {
        $date_before = date('Y-m-d h:i:s A');
        $usertimezone = $this->input->post("usertimezone");
        date_default_timezone_set($usertimezone);
        $date_after = date('Y-m-d h:i:s A');
        $_SESSION['usertimezone'] = $usertimezone;
        $_SESSION['offset_zone'] = $this->input->post("offset_zone");;
        $display = array(
            "usertimezone" => $usertimezone,
            "newphptimezone" => date_default_timezone_get(),
            "date_before" => $date_before,
            "date_after" => $date_after,
            "session_timezone" => $this->session->userdata('usertimezone'),
            "offset_zone" => $this->session->userdata('offset_zone')

        );
        echo json_encode($display);
    }
    public function submit_attendance_correction_request()
    {
        $user_id = $this->input->post('user_id');
        $att_id = $this->input->post('att_id');
        $form_clockin_date = $this->input->post('form_clockin_date');
        $form_clockin_time = $this->input->post('form_clockin_time');
        $form_clockout_date = $this->input->post('form_clockout_date');
        $form_clockout_time = $this->input->post('form_clockout_time');
        $form_breakin_date = $this->input->post('form_breakin_date');
        $form_breakin_time = $this->input->post('form_breakin_time');
        $form_breakout_date = $this->input->post('form_breakout_date');
        $form_breakout_time = $this->input->post('form_breakout_time');

        if ($form_breakin_date == "" || $form_breakin_time) {
            $break_start = "0000-00-00 00:00:00";
            $break_end = "0000-00-00 00:00:00";
        } else {
            $break_start = $this->datetime_zone_converter($form_breakin_date . " " . $form_breakin_time, $this->session->userdata('usertimezone'), "UTC");
            $break_end = $this->datetime_zone_converter($form_breakout_date . " " . $form_breakout_time, $this->session->userdata('usertimezone'), "UTC");
        }
        if ($this->timesheet_model->check_adjusment_exist($att_id)) {
            $update = array(
                'status' => 'pending',
                'clock_in' => $this->datetime_zone_converter($form_clockin_date . " " . $form_clockin_time, $this->session->userdata('usertimezone'), "UTC"),
                'clock_out' => $this->datetime_zone_converter($form_clockout_date . " " . $form_clockout_time, $this->session->userdata('usertimezone'), "UTC"),
                'break_in' => $break_start,
                'break_out' => $break_end,
                'date_status_changed' => date('Y-m-d H:i:s'),
                'date_created' => date('Y-m-d H:i:s')
            );
            $this->timesheet_model->update_attendance_correction($update, $att_id);
        } else {
            $insert = array(
                'user_id' => $user_id,
                'attendance_id' => $att_id,
                'status' => 'pending',
                'clock_in' => $this->datetime_zone_converter($form_clockin_date . " " . $form_clockin_time, $this->session->userdata('usertimezone'), "UTC"),
                'clock_out' => $this->datetime_zone_converter($form_clockout_date . " " . $form_clockout_time, $this->session->userdata('usertimezone'), "UTC"),
                'break_in' => $this->datetime_zone_converter($form_breakin_date . " " . $form_breakin_time, $this->session->userdata('usertimezone'), "UTC"),
                'break_out' => $this->datetime_zone_converter($form_breakout_date . " " . $form_breakout_time, $this->session->userdata('usertimezone'), "UTC"),
                'date_status_changed' => date('Y-m-d H:i:s'),
                'date_created' => date('Y-m-d H:i:s')
            );
            $this->timesheet_model->submit_attendance_correction($insert);
        }
        echo json_encode(0);
    }
    public function show_my_correction_requests()
    {
        $date_from = $this->input->post("date_from");
        $date_to = $this->input->post("date_to");
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_from . " 00:00:00");
        date_default_timezone_set("UTC");
        $date_from = date("Y-m-d", $the_date);


        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_to . " 24:59:00");
        date_default_timezone_set("UTC");
        $date_to = date("Y-m-d H:i:s", $the_date);
        $user_id = logged('id');
        $requests = $this->timesheet_model->get_my_correction_requests($date_from, $date_to, $user_id);
        // $display = '<thead>';
        // $display .= '<tr role="row">';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift Date</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Login</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Worked Hours</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Request <br>Status</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">Action</th>';
        // $display .= '</tr>';
        // $display .= '</thead>';
        // $display = '<tbody>';
        $display = '';
        foreach ($requests as $request) {
            // $display .= '<tr role="row" class="odd">';
            // $display .= '<td><label class="gray">' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '</label></td>';
            // $display .= '<td>';
            // $display .= '<center>';
            // $display .= '<label class="gray"><strong>Clock in: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            // $display .= '<label class="gray"><strong>Clock out: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->clock_out, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            // $display .= '</center>';
            // $display .= '</td>';
            // $display .= '<td>';
            // $display .= '<center>';
            // if ($request->break_in  != "0000-00-00 00:00:00") {
            //     $display .= '<label class="gray"><strong>Break in: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->break_in, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            //     $display .= '<label class="gray"><strong>Break out: </strong>' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->break_out, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            // }
            // $display .= '</center>';
            // $display .= '</td>';
            // $display .= '<td style="text-align:center;">' . round($this->get_differenct_of_dates($request->clock_in, $request->clock_out) - $this->get_differenct_of_dates($request->break_in, $request->break_out), 2) . '</td>';
            // $display .= '<td style="text-align:center;">' . round($this->get_differenct_of_dates($request->break_in, $request->break_out), 2) . '</td>';

            // $display .= '<td style="text-align:center;"><strong>' . $request->status . '</strong><br>';
            // $display .= '<label class="gray">' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->date_status_changed, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            // $display .= '</td>';

            // $display .= '<td style="text-align:center;">';
            // if ($request->status == "pending") {
            //     $display .= '<a title="" data-shift-date="' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '" data-timesheet-attendance-correction-id="' . $request->id . '" data-user-id="' . $request->user_id . '"  data-attn-id="' . $request->attendance_id . '" data-toggle="tooltip" class="cancel_my_correction_reqiest btn btn-danger btn-sm" data-original-title="Cancel Request"><i class="fa fa-times fa-lg"></i> Cancel</a>';
            // }
            // $display .= '</td>';
            // $display .= '</tr>';

            $display .= '<tr>';
            $display .= '<td class="nsm-text-primary">' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '</td>';
            $display .= '<td>';
            $display .= '<label class="d-block fw-bold">Clock in: ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            $display .= '<label class="content-subtitle d-block">Clock out: ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->clock_out, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            $display .= '</td>';
            $display .= '<td>';
            if ($request->break_in  != "0000-00-00 00:00:00") {
                $display .= '<label class="d-block fw-bold">Break in: ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->break_in, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
                $display .= '<label class="content-subtitle d-block">Break out: ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->break_out, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            }
            $display .= '</td>';
            $display .= '<td>' . round($this->get_differenct_of_dates($request->clock_in, $request->clock_out) - $this->get_differenct_of_dates($request->break_in, $request->break_out), 2) . '</td>';
            $display .= '<td>' . round($this->get_differenct_of_dates($request->break_in, $request->break_out), 2) . '</td>';
            $display .= '<td>';

            if ($request->status == 'approved') {
                $display .= '<span class="nsm-badge success d-block text-capitalize">' . $request->status . '</span>';
            } else {
                $display .= '<span class="nsm-badge d-block text-capitalize">' . $request->status . '</span>';
            }

            $display .= '<label class="content-subtitle d-block mt-1">' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->date_status_changed, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            $display .= '</td>';
            $display .= '<td>';
            if ($request->status == "pending") {
                $display .= '<a role="button" href="javascript:void(0);" class="nsm-button btn-sm error btn-cancel-correction" data-shift-date="' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '" data-timesheet-attendance-correction-id="' . $request->id . '" data-user-id="' . $request->user_id . '"  data-attn-id="' . $request->attendance_id . '">Cancel</a>';
            }
            $display .= '</td>';
            $display .= '</tr>';
        }

        if ($display == "") {
            $display .= '<tr>';
            $display .= '<td colspan="7"><div class="nsm-empty"><span>No results found.</span></div></td>';
            $display .= '</tr>';
        }

        // $display .= '</tbody>';
        echo json_encode($display);
    }

    public function cancel_my_correction_request()
    {
        $request_id = $this->input->post('request_id');
        $att_id = $this->input->post('att_id');
        $user_id = $this->input->post('user_id');
        $update = array(
            'status' => 'canceled',
            'date_status_changed' => date('Y-m-d H:i:s'),
        );
        $this->timesheet_model->update_correction_request($update, $att_id);

        echo json_encode(0);
    }
    public function show_my_leave_requests()
    {
        $date_from = $this->datetime_zone_converter($this->input->post("date_from"), $this->session->userdata('usertimezone'), "UTC");
        $date_to = $this->datetime_zone_converter($this->input->post("date_to") . " 23:59:59", $this->session->userdata('usertimezone'), "UTC");
        $leave_requests = $this->timesheet_model->get_my_leave_requests(logged('id'), $date_from, $date_to);

        $display = "";
        $hide_action = false;
        foreach ($leave_requests as $request) {
            $date_requested = date('m-d-Y', strtotime($this->datetime_zone_converter($request->date_created, "UTC", $this->session->userdata('usertimezone'))));
            // $display .= '<tr role="row" class="odd">';
            // $display .= '<td>
            // <label class="gray">' . $date_requested . '</label>
            // </td>';
            // $display .= '<td>
            //     <label class="gray center"><strong>' . $request->name . '' . '</strong></label>';
            // $leave_dates = $this->timesheet_model->get_leavedates($request->id);
            // foreach ($leave_dates as $leave_date) {
            //     $display .= '<label class="gray center">' . date('m-d-Y', strtotime($this->datetime_zone_converter($leave_date->date_time, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            // }

            // $display .= '</td>';
            // $display .= '<td style="text-align:center;">';
            // $action = true;
            // if ($request->status == 0) {
            //     $display .= '<label class="gray">Pending</label>';
            //     $hide_action = true;
            // } elseif ($request->status == 1) {
            //     $display .= '<label class="gray">Approved</label>';
            //     $action = false;
            // } elseif ($request->status == 3) {
            //     $display .= '<label class="gray">Canceled</label>';
            //     $action = false;
            // } else {
            //     $display .= '<label class="gray">Denied</label>';
            //     $action = false;
            // }

            // $display .= '</td>';
            // $display .= '<td class="leave_request_action_td" style="text-align:center;">';
            // if ($action) {
            //     $display .= '<a title="" data-date-filed="' . $date_requested . '" data-leave-type="' . $request->name . '"data-user-id="' . $request->user_id . '" data-leave-id="' . $request->id . '" data-toggle="tooltip" class="cancel_my_leave_request btn btn-danger btn-sm" data-original-title="Cancel Request"><i class="fa fa-times fa-lg"></i> Cancel</a>';
            // }
            // $display .= '</td>';
            // $display .= '</tr>';

            $display .= '<tr>';
            $display .= '<td class="nsm-text-primary">';
            $display .= '<label class="d-block fw-bold">' . $request->name . '</label>';

            $leave_dates = $this->timesheet_model->get_leavedates($request->id);
            foreach ($leave_dates as $leave_date) {
                $display .= '<label class="content-subtitle fst-italic me-1">' . date('m-d-Y', strtotime($this->datetime_zone_converter($leave_date->date_time, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            }
            $display .= '</td>';
            $display .= '<td>' . $date_requested . '</td>';

            $display .= '<td>';
            $action = true;
            if ($request->status == 0) {
                $display .= '<span class="nsm-badge">Pending</span>';
                $hide_action = true;
            } elseif ($request->status == 1) {
                $display .= '<span class="nsm-badge success">Approved</span>';
                $action = false;
            } elseif ($request->status == 3) {
                $display .= '<span class="nsm-badge error">Canceled</span>';
                $action = false;
            } else {
                $display .= '<span class="nsm-badge secondary">Denied</span>';
                $action = false;
            }
            $display .= '</td>';
            $display .= '<td class="text-end">';
            if ($action) {
                $display .= '<a role="button" href="javascript:void(0);" class="nsm-button btn-sm error btn-cancel-leave" data-date-filed="' . $date_requested . '" data-leave-type="' . $request->name . '" data-user-id="' . $request->user_id . '" data-leave-id="' . $request->id . '">Cancel</a>';
            }
            $display .= '</td>';
            $display .= '</tr>';
        }
        if ($display == "") {
            $display .= '<tr>';
            $display .= '<td colspan="4"><div class="nsm-empty"><span>No results found.</span></div></td>';
            $display .= '</tr>';
        }
        $data = new stdClass();
        $data->display = $display;
        $data->hide_action = $hide_action;
        echo json_encode($data);
    }
    public function cancel_my_leave_request()
    {
        $leave_id = $this->input->post('leave_id');
        $update = array(
            'status' => 3,
        );
        $this->timesheet_model->update_my_leave_request($update, $leave_id);
        echo json_encode(0);
    }
    public function show_my_attendance_remarks()
    {


        $data = $this->timesheet_model->getData(logged('company_id'));

        $week = $this->input->post("week");
        $user_id = logged("id");
        $week_convert = date('Y-m-d', strtotime($week));
        $date_this_week =  array(
            "Monday" => '',
            "Tuesday" => '',
            "Wednesday" => '',
            "Thursday" => '',
            "Friday" => '',
            "Saturday" => '',
            "Sunday" => '',
        );
        if (count($data) > 0) {
            $pay_day = "";
            foreach ($data as $result) {
                $pay_day = $result->pay_date;
            }
            $pay_date_this_week = date('Y-m-d', strtotime($pay_day . ' this week', strtotime($week_convert)));

            $start_date_view = $pay_date_this_week;
            $end_date_view = date('Y-m-d', strtotime($pay_date_this_week . ' + 6 days'));
            if ($week_convert < $pay_date_this_week) {
                $start_date_view = date('Y-m-d', strtotime($pay_date_this_week . ' - 7 days'));
                $end_date_view = date('Y-m-d', strtotime($pay_date_this_week . ' - 1 days'));
            }


            $week_check = array();
            $week_dates = array();

            $display = "";

            $display_tbody = '<tbody>';
            $display_tbody .= '<tr role="row">';
            $display_tbody .= '</tr>';
            $display_tbody .= '</tbody>';

            $display .= '<thead>';
            $display .= '<tr role="row">';
            $week_ctr = 0;
            for ($ctr = $start_date_view; $ctr <=  $end_date_view;) {
                $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">' . strtoupper(date('D', strtotime($ctr)))  . '<br>' . date('M d', strtotime($ctr)) . '</th>';
                $week_dates[$week_ctr] = $week_check[$week_ctr] =  date('Y-m-d', strtotime($ctr));
                $week_ctr++;
                $ctr = date('Y-m-d', strtotime($ctr . ' + 1 day'));
            }
            $week_check[$week_ctr] = date('Y-m-d', strtotime($ctr));
            $display .= '</tr>';
            $display .= '</thead>' . $display_tbody;
        } else {
            $date_this_week = array(
                "Monday" => date("M d", strtotime('monday this week', strtotime($week_convert))),
                "Tuesday" => date("M d", strtotime('tuesday this week', strtotime($week_convert))),
                "Wednesday" => date("M d", strtotime('wednesday this week', strtotime($week_convert))),
                "Thursday" => date("M d", strtotime('thursday this week', strtotime($week_convert))),
                "Friday" => date("M d", strtotime('friday this week', strtotime($week_convert))),
                "Saturday" => date("M d", strtotime('saturday this week', strtotime($week_convert))),
                "Sunday" => date("M d", strtotime('sunday this week', strtotime($week_convert))),
            );
            $week_check = array(
                0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
                1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
                2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
                3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
                4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
                5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
                6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
                7 => date("Y-m-d", strtotime('monday next week', strtotime($week_convert))),
            );
            $week_dates = array(
                0 => date("Y-m-d", strtotime('monday this week', strtotime($week_convert))),
                1 => date("Y-m-d", strtotime('tuesday this week', strtotime($week_convert))),
                2 => date("Y-m-d", strtotime('wednesday this week', strtotime($week_convert))),
                3 => date("Y-m-d", strtotime('thursday this week', strtotime($week_convert))),
                4 => date("Y-m-d", strtotime('friday this week', strtotime($week_convert))),
                5 => date("Y-m-d", strtotime('saturday this week', strtotime($week_convert))),
                6 => date("Y-m-d", strtotime('sunday this week', strtotime($week_convert))),
            );

            $display = "";
            $display .= '<thead>';
            $display .= '<tr role="row">';


            $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Monday<br>' . $date_this_week['Monday'] . '</th>';
            $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Tuesday<br>' . $date_this_week['Tuesday'] . '</th>';
            $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Wednesday<br>' . $date_this_week['Wednesday'] . '</th>';
            $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Thursday<br>' . $date_this_week['Thursday'] . '</th>';
            $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Friday<br>' . $date_this_week['Friday'] . '</th>';
            $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Saturday<br>' . $date_this_week['Saturday'] . '</th>';
            $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Sunday<br>' . $date_this_week['Sunday'] . '</th>';
            $display .= '</tr>';
            $display .= '</thead>';
        }


        $remarks = array();
        $shift_dates = array();
        $dates_founds = array();
        $remarks_ctr = 0;
        for ($i = 0; $i < count($week_check); $i++) {
            $shift_date = date('Y-m-d', strtotime($this->datetime_zone_converter($week_check[$i], $this->session->userdata('usertimezone'), "UTC")));

            $shift_date_user_time = $this->datetime_zone_converter($shift_date, "UTC", $this->session->userdata('usertimezone'));
            $shift_dates[] =  $shift_date_user_time . " shift date";
            $my_attendances = $this->timesheet_model->get_my_date_attendance($shift_date, $user_id);
            $my_schedules = $this->timesheet_model->get_my_schedule($shift_date, $user_id);
            $checkin_time = "";
            $shift_start = "";
            $shift_dates[] = $my_attendances;
            foreach ($my_attendances as $attn) {
                $checkin_time = $attn->checkin_time;

                foreach ($my_schedules as $sched) {
                    $shift_start = $sched->shift_start;
                }
                $minutes_late = 0;
                if ($shift_start != '') {
                    $minutes_late = $this->get_differenct_of_dates($shift_start, $checkin_time, true) * 60;
                }
                $date_user = date('Y-m-d', strtotime($this->datetime_zone_converter($checkin_time, "UTC", $this->session->userdata('usertimezone'))));
                $date_found = false;
                $ctr_found = 0;
                for ($x = 0; $x < count($dates_founds); $x++) {
                    if ($dates_founds[$x] == $date_user) {
                        $ctr_found = $x;
                        $date_found = true;
                        break;
                    }
                }
                $found = false;
                for ($x = 0; $x < count($week_dates); $x++) {
                    if ($date_user == $week_dates[$x]) {
                        $found = true;
                        break;
                    }
                }
                if ($found) {
                    if (!$date_found) {
                        $dates_founds[] = $date_user;
                        if (intval($minutes_late) > 0) {
                            $remarks[] = '<label style="font-size:12px; color:red;">L</label> ';
                        } else {
                            $remarks[] = 'P ';
                        }
                        $remarks_ctr++;
                    } else {
                        if (intval($minutes_late) > 0) {
                            $remarks[$ctr_found] = '<label style="font-size:12px; color:red;">L</label> ';
                        } else {
                            $remarks[$ctr_found] = 'P ';
                        }
                        $remarks_ctr++;
                    }
                } else {
                    $shift_dates[] = $date_user . " date_user_not_found";
                    for ($x = 0; $x < count($week_dates); $x++) {
                        if ($shift_date == $week_dates[$x]) {
                            $found = true;
                            break;
                        }
                    }
                    if ($found) {
                        $date_found = false;
                        $ctr_found = 0;
                        for ($x = 0; $x < count($dates_founds); $x++) {
                            if ($dates_founds[$x] == $shift_date) {
                                $ctr_found = $x;
                                $date_found = true;
                                break;
                            }
                        }
                        if (!$date_found) {
                            $dates_founds[] = $shift_date;
                            $remarks[] = '<label style="font-size:12px; color:red;">A</label> ';
                            $remarks_ctr++;
                        } else {
                            $remarks[$ctr_found] = '<label style="font-size:12px; color:red;">A</label> ';
                            $remarks_ctr++;
                        }
                    }
                }
            }
            if (count($my_attendances) == 0) {
                $found = false;
                $user_shift = date('Y-m-d', strtotime($shift_date_user_time));

                for ($x = 0; $x < count($week_dates); $x++) {
                    $shift_dates[] = $user_shift . " == " . $week_dates[$x];
                    if ($user_shift == $week_dates[$x]) {
                        $found = true;
                        break;
                    }
                }
                if ($found) {
                    $found_ctr = 0;
                    $found_date = false;
                    for ($x = 0; $x < count($dates_founds); $x++) {
                        if ($dates_founds[$x] == $user_shift) {
                            $found_ctr = $x;
                            $found_date = true;
                            break;
                        }
                    }
                    if ($found_date) {
                        $remarks[$found_ctr] = $remarks[$found_ctr];
                    } else {
                        if ($shift_date < date('Y-m-d')) {
                            $dates_founds[] = $user_shift;
                            $remarks[] = '<label style="font-size:12px; color:red;">A</label> ';
                            $remarks_ctr++;
                        } else {
                            $remarks[] = ' ';
                            $remarks_ctr++;
                        }
                    }
                }
            }
        }
        // $display = "";
        // $display .= '<thead>';
        // $display .= '<tr role="row">';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;"> Monday<br>' . $date_this_week['Monday'] . '</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Tuesday<br>' . $date_this_week['Tuesday'] . '</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Wednesday<br>' . $date_this_week['Wednesday'] . '</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Thursday<br>' . $date_this_week['Thursday'] . '</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Friday<br>' . $date_this_week['Friday'] . '</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Saturday<br>' . $date_this_week['Saturday'] . '</th>';
        // $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Sunday<br>' . $date_this_week['Sunday'] . '</th>';
        // $display .= '</tr>';
        // $display .= '</thead>';
        // $display .= '<tbody>';
        // $display .= '<tr role="row">';
        // if ($remarks_ctr > 0) {
        //     for ($i = 0; $i < count($remarks); $i++) {
        //         $display .= '<td class="center">' . $remarks[$i] . '</td>';
        //     }
        // } else {
        //     $display .= '<td class="center" colspan="7"> No data Available</td>';
        // }
        // $display .= '</tr>';
        // $display .= '</tbody>';

        $display = '<thead>';
        $display .= '<tr>';
        $display .= '<td data-name="Monday ' . $date_this_week['Monday'] . '" class="text-center">Monday <br>' . $date_this_week['Monday'] . '</td>';
        $display .= '<td data-name="Tuesday ' . $date_this_week['Tuesday'] . '" class="text-center">Tuesday <br>' . $date_this_week['Tuesday'] . '</td>';
        $display .= '<td data-name="Wednesday ' . $date_this_week['Wednesday'] . '" class="text-center">Wednesday <br>' . $date_this_week['Wednesday'] . '</td>';
        $display .= '<td data-name="Thursday ' . $date_this_week['Thursday'] . '" class="text-center">Thursday <br>' . $date_this_week['Thursday'] . '</td>';
        $display .= '<td data-name="Friday ' . $date_this_week['Friday'] . '" class="text-center">Friday <br>' . $date_this_week['Friday'] . '</td>';
        $display .= '<td data-name="Saturday ' . $date_this_week['Saturday'] . '" class="text-center">Saturday <br>' . $date_this_week['Saturday'] . '</td>';
        $display .= '<td data-name="Sunday ' . $date_this_week['Sunday'] . '" class="text-center">Sunday <br>' . $date_this_week['Sunday'] . '</td>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody>';
        $display .= '<tr>';
        if ($remarks_ctr > 0) {
            for ($i = 0; $i < count($remarks); $i++) {
                $display .= '<td class="text-center fw-bold">' . $remarks[$i] . '</td>';
            }
        } else {
            $display .= '<td class="text-center" colspan="7">';
            $display .= '<div class="nsm-empty">';
            $display .= '<span>No results found.</span>';
            $display .= '</div>';
            $display .= '</td>';
        }
        $display .= '</tr>';
        $display .= '</tbody>';

        $data = new stdClass();
        $data->display = $display;
        $data->shift_dates = $shift_dates;
        echo json_encode($data);
    }
    public function my_schedule()
    {
        $this->page_data['page']->title = 'Shift Schedule';
        $this->page_data['page']->parent = 'Company';

        add_css(array(
            "assets/css/timesheet/calendar/main.css",
            "assets/css/timesheet/timesheet_my_schedule.css"
        ));

        add_footer_js(array(
            "assets/js/timesheet/calendar/main.js",
            "assets/js/timesheet/timesheet_my_schedule.js",
        ));
        $this->load->view('v2/pages/users/timesheet_my_schedule', $this->page_data);
        // $this->load->view('v2/pages/users/timesheet_my_schedule', $this->page_data);
    }
    public function get_my_schedules()
    {
        $text_mont_year = $this->input->post("text_mont_year");
        if ($text_mont_year  == "") {
            $text_mont_year = date("Y-m-d");
        }
        $initial_date = date('Y-m-d', strtotime($text_mont_year));
        $last_date_prev_month = date("Y-m-d", strtotime('last day of previous month', strtotime($initial_date)));
        $last_date_2_months = date("Y-m-d", strtotime('last day of previous month', strtotime($last_date_prev_month)));
        $last_date_3_months = date("Y-m-d", strtotime('last day of previous month', strtotime($last_date_2_months)));
        $first_date_next_month = date("Y-m-d", strtotime('last day of next month', strtotime($initial_date)));
        if (date('Y-m', strtotime($initial_date)) == date('Y-m')) {
            $initial_date = date('Y-m-d', strtotime($this->datetime_zone_converter(date('Y-m-d'), "UTC", $this->session->userdata('usertimezone'))));
        }
        $schedules_pst = $this->timesheet_model->get_my_schedules_for_calendar($last_date_3_months, $first_date_next_month, logged('id'));
        $schedules_calendar =  array();
        foreach ($schedules_pst as $sched) {
            $shift_start = date("G:i A", strtotime($this->datetime_zone_converter($sched->shift_start, "UTC", $this->session->userdata('usertimezone'))));
            $shift_end   = date("G:i A", strtotime($this->datetime_zone_converter($sched->shift_end, "UTC", $this->session->userdata('usertimezone'))));
            $schedules_calendar[] = array("title" => "<i class='bx bx-calendar'></i> Shift Start : " . $shift_start, "start" => $this->datetime_zone_converter($sched->shift_start, "UTC", $this->session->userdata('usertimezone')));
            $schedules_calendar[] = array("title" => "<i class='bx bx-calendar'></i> Shift End : " . $shift_end, "start" => $this->datetime_zone_converter($sched->shift_end, "UTC", $this->session->userdata('usertimezone')));
        }
        $data = new stdClass();
        $data->initial_date = $initial_date;
        $data->last_date_prev_month = $last_date_prev_month;
        $data->first_date_next_month = $first_date_next_month;
        $data->schedules_calendar = $schedules_calendar;
        echo json_encode($data);
    }
    public function show_all_correction_requests()
    {
        $date_from = $this->input->post("date_from");
        $date_to = $this->input->post("date_to");
        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_from . " 00:00:00");
        date_default_timezone_set("UTC");
        $date_from = date("Y-m-d", $the_date);


        date_default_timezone_set($this->session->userdata('usertimezone'));
        $the_date = strtotime($date_to . " 24:59:00");
        date_default_timezone_set("UTC");
        $date_to = date("Y-m-d H:i:s", $the_date);
        $company_id = logged('company_id');
        $requests = $this->timesheet_model->get_all_correction_requests($date_from, $date_to, $company_id);
        $display = '<thead>';
        $display .= '<tr role="row">';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Employee Name</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift Date</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift Schedule</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Login</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Worked Hours</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break Duration</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Request <br>Status</th>';
        $display .= '<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 100px;">Action</th>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody>';
        foreach ($requests as $request) {
            $shift_date = date('Y-m-d', strtotime($request->clock_in));
            $display .= '<tr role="row" class="odd">';
            $display .= '<td class="center">' . $request->FName . ' ' . $request->LName . '</td>';
            $display .= '<td><label class="gray">' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '</label></td>';

            $shift_schedule = $this->timesheet_model->get_my_schedule($shift_date, $request->user_id);
            $display .= '<td>';
            $display .= '<center>';
            foreach ($shift_schedule as $sched) {
                $display .= '<label class="gray"><strong>Shift Start: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($sched->shift_start, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
                $display .= '<label class="gray"><strong>Shift End: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($sched->shift_end, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
                break;
            }
            $display .= '</center>';
            $display .= '</td>';
            $display .= '<td>';
            $display .= '<center>';
            $display .= '<label class="gray"><strong>Clock in: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->clock_in, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            $display .= '<label class="gray"><strong>Clock out: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->clock_out, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            $display .= '</center>';
            $display .= '</td>';
            $display .= '<td>';
            $display .= '<center>';
            if ($request->break_in  != "0000-00-00 00:00:00") {
                $display .= '<label class="gray"><strong>Break in: </strong> ' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->break_in, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
                $display .= '<label class="gray"><strong>Break out: </strong>' . date('m-d-Y h:i A', strtotime($this->datetime_zone_converter($request->break_out, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            }
            $display .= '</center>';
            $display .= '</td>';
            $display .= '<td style="text-align:center;">' . round($this->get_differenct_of_dates($request->clock_in, $request->clock_out) - $this->get_differenct_of_dates($request->break_in, $request->break_out), 2) . '</td>';
            $display .= '<td style="text-align:center;">' . round($this->get_differenct_of_dates($request->break_in, $request->break_out), 2) . '</td>';

            $approvers = $this->timesheet_model->get_attendance_logs_editor_footprint($request->attendance_id, 'attendance_correction_' . $request->status);
            $approved_by = "";
            foreach ($approvers as $approver) {
                $approved_by = '<br>by: ' . $approver->FName . ' ' . $approver->LName;
            }
            $display .= '<td style="text-align:center;"><strong>' . $request->status . '</strong>';
            $display .= '<br><label class="gray">' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->date_status_changed, "UTC", $this->session->userdata('usertimezone')))) . '</label>';
            $display .= $approved_by . '</td>';

            $display .= '<td style="text-align:center;">';
            if ($request->status == "pending") {
                $display .= '<a title="" data-employee-name="'  . $request->FName . ' ' . $request->LName . '" data-timesheet-attendance-correction-id="' . $request->id . '" data-user-id="' . $request->user_id . '"  data-attn-id="' . $request->attendance_id . '" data-toggle="tooltip" class="approve_correction_reqiest btn btn-success btn-sm" data-original-title="Approve Request"><i class="fa fa-thumbs-up fa-lg"></i> Approve</a>';
                $display .= '<a title="" data-employee-name="'  . $request->FName . ' ' . $request->LName . '" data-timesheet-attendance-correction-id="' . $request->id . '" data-user-id="' . $request->user_id . '"  data-attn-id="' . $request->attendance_id . '" data-toggle="tooltip" class="deny_correction_reqiest btn btn-danger btn-sm" data-original-title="Deny Request"><i class="fa fa-thumbs-down fa-lg"></i> Deny</a>';
            }
            $display .= '</td>';
            $display .= '</tr>';
        }

        $display .= '</tbody>';
        echo json_encode($display);
    }
    public function deny_correction_request()
    {
        $request_id = $this->input->post('request_id');
        $att_id = $this->input->post('att_id');
        $user_id = $this->input->post('user_id');
        $update = array(
            'status' => 'denied',
            'date_status_changed' => date('Y-m-d H:i:s'),
        );
        $this->timesheet_model->update_correction_request($update, $att_id);
        $insert = array("user_id" => logged('id'), "attendance_id" => $att_id, 'action' => 'attendance_correction_denied');
        $this->db->insert("timesheet_logs_editor", $insert);
        echo json_encode(0);
    }
    public function approve_correction_reqiest()
    {
        $request_id = $this->input->post('request_id');
        $att_id = $this->input->post('att_id');
        $user_id = $this->input->post('user_id');
        $update = array(
            'status' => 'approved',
            'date_status_changed' => date('Y-m-d H:i:s'),
        );
        $this->timesheet_model->update_correction_request($update, $att_id);

        $request_selected = $this->timesheet_model->get_correction_reqiest($request_id);
        foreach ($request_selected as $request) {
            $clock_in = $request->clock_in;
            $clock_out = $request->clock_out;
            $break_in = $request->break_in;
            $break_out = $request->break_out;
        }
        $total_shift_duration = $this->get_differenct_of_dates($clock_in, $clock_out);

        $break_duration = $this->get_differenct_of_dates($break_in, $break_out);
        $shift_duration = $total_shift_duration - $break_duration;
        $overtime = 0;
        if ($shift_duration > 8) {
            $overtime = $shift_duration - 8;
        }

        $this->timesheet_model->correction_reqiest_approved($clock_in, $clock_out, $break_in, $break_out, $att_id, $shift_duration, $break_duration, $overtime);
        $insert = array("user_id" => logged('id'), "attendance_id" => $att_id, 'action' => 'attendance_correction_approved');
        $this->db->insert("timesheet_logs_editor", $insert);
        echo json_encode(0);
    }
    public function show_all_leave_requests()
    {
        $date_from = $this->datetime_zone_converter($this->input->post("date_from"), $this->session->userdata('usertimezone'), "UTC");
        $date_to = $this->datetime_zone_converter($this->input->post("date_to") . " 23:59:59", $this->session->userdata('usertimezone'), "UTC");
        $leave_requests = $this->timesheet_model->get_all_leave_requests(logged('company_id'), $date_from, $date_to);

        $display = "";
        $display .= '<thead>';
        $display .= '<tr>';
        $display .= '<th>Employee</th>';
        $display .= '<th>Type</th>';
        $display .= '<th>Date filed</th>';
        $display .= '<th>Leave date</th>';
        $display .= '<th>Status</th>';
        $display .= '<th>Action</th>';
        $display .= '</tr>';
        $display .= '</thead>';
        $display .= '<tbody id="pto-table-list-body">';
        $hide_action = false;
        foreach ($leave_requests as $request) {
            $date_requested = date('m-d-Y', strtotime($this->datetime_zone_converter($request->date_created, "UTC", $this->session->userdata('usertimezone'))));
            $display .= '<tr role="row" class="odd">';
            $display .= '<td class="center">' . $request->FName . ' ' . $request->LName . '</td>';
            $display .= '<td class="center">
            <strong>' . $request->name . '</strong>
            </td>';
            $display .= '<td><center>
            <label class="gray">' . date('m-d-Y', strtotime($this->datetime_zone_converter($request->date_created, "UTC", $this->session->userdata('usertimezone'))))  . '</label>
            </center></td>';
            $display .= '<td><center>';
            $leave_dates = $this->timesheet_model->get_leavedates($request->id);
            foreach ($leave_dates as $leave_date) {
                $display .= '<label class="gray center">' . date('m-d-Y', strtotime($this->datetime_zone_converter($leave_date->date_time, "UTC", $this->session->userdata('usertimezone')))) . '</label><br>';
            }

            $display .= '</center></td>';
            $display .= '<td style="text-align:center;">';
            $action = true;
            if ($request->status == 0) {
                $display .= '<label class="gray">Pending</label>';
            } elseif ($request->status == 1) {
                $display .= '<label class="gray">Approved</label>';
                $approver = $this->timesheet_model->get_leave_approver($request->id, "approved");
                $display .= '<br>by: ' . $approver->FName . ' ' . $approver->LName;
                $action = false;
            } elseif ($request->status == 3) {
                $display .= '<label class="gray">Canceled</label>';
                $action = false;
            } else {
                $display .= '<label class="gray">Denied</label>';
                $approver = $this->timesheet_model->get_leave_approver($request->id, "denied");
                $display .= '<br>by: ' . $approver->FName . ' ' . $approver->LName;
                $action = false;
            }

            $display .= '</td>';
            $display .= '<td style="text-align:center;">';
            if ($action) {
                $display .= '<a href="javascript:void (0)" data-id="' . $request->id . '>" title="Approve" data-toggle="tooltip" id="approveRequest" style="display: inline;"><i class="fa fa-thumbs-up fa-lg"></i></a>';
            }
            $display .= '<a href="javascript:void (0)" data-id="' . $request->id . '" title="Deny" data-toggle="tooltip" id="denyRequest" style="margin-left: 12px"><i class="fa fa-times fa-lg"></i></a>';

            $display .= '</td>';
            $display .= '</tr>';
        }
        if (count($leave_requests) == 0) {
            $display .= '<tr role="row" class="odd">';
            $display .= '<td colspan="6" class="center">No request submitted.</td>';
            $display .= '</tr>';
        }
        $display .= '</tbody>';
        $data = new stdClass();
        $data->display = $display;
        echo json_encode($data);
    }
    public function settings()
    {
        if(!checkRoleCanAccessModule('user-timesheet-settings', 'read')){
			show403Error();
			return false;
		}

        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            "assets/css/timesheet/timesheet_settings.css"
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'assets/js/v2/bootstrap-datetimepicker.v2.min.js',
            "assets/js/timesheet/timesheet_settings.js"

        ));
        $this->page_data['page']->title = 'Timesheet Settings';
        $this->page_data['page']->parent = 'Timesheet';

        $this->load->model('timesheet_model');
        $cid = logged("company_id");
        $default_email = logged('email');
        $default_time  = $this->timesheet_model->defaultTimeSendTimesheetReport();
        $report_privacy = $this->timesheet_model->get_timesheet_report_privacy($cid);
        $timesheetSettings = $this->timesheet_model->getSettingsByCompanyId($cid);

        $this->page_data['timesheetSettings'] = $timesheetSettings;
        $this->page_data['report_privacy'] = $report_privacy;
        $this->page_data['default_email']  = $default_email;
        $this->page_data['default_time']  = $default_time;
        $this->page_data['report_settings'] = $this->timesheet_model->get_saved_timezone(logged("id"));
        $this->page_data['report_privacy_updated'] = $this->datetime_zone_converter($report_privacy->datetime_updated, "UTC", $this->session->userdata("usertimezone"));
        $this->load->view('v2/pages/users/timesheet_settings', $this->page_data);
    }

    public function get_saved_timezone()
    {
        $current_saved = $this->timesheet_model->get_saved_timezone(logged('id'));
        $current_tz = $this->input->post(
            'usertimezone'
        );
        $data = new stdClass();
        $data->hasSet = false;
        if (count($current_saved) > 0) {
            $data->hasSet = true;
            foreach ($current_saved as $saved_tz) {
                $data->timezone_id = $saved_tz->timezone_id;
                $data->timezone_display_name = $saved_tz->timezone_id;
                $data->timezone_id_of_tz = $saved_tz->id_of_timezone;
                $data->subscribed = $saved_tz->subscribed;
                $data->sched_day = explode(",", $saved_tz->schedule_day);
                $data->sched_time = date('H:i:s', strtotime($this->datetime_zone_converter(date('Y-m-d') . " " . $saved_tz->schedule_time, 'UTC', $saved_tz->id_of_timezone)));;
                $data->report_series = $saved_tz->report_series;
                $data->email_report = $saved_tz->email_report;
            }
        } else {
            $tz_id = $this->timesheet_model->get_tz_id($current_tz);
            foreach ($tz_id as $tz) {
                $data->timezone_id = $tz->id;
                $data->timezone_display_name = $tz->timezone_id;
                $data->timezone_id_of_tz = $tz->id_of_timezone;
            }
            $user_details = $this->timesheet_model->get_user_details(logged('id'));
            $data->email = $user_details->email;
        }
        // $est_wage_privacy
        echo json_encode($data);
    }
    public function save_timezone_changes()
    {
        $timezone_id = $this->input->post("tz_display_name");
        $user_id = logged('id');
        $subscribe = $this->input->post("subscribe") . "";
        $report_series = $this->input->post("report_series");
        $sched_day = $this->input->post("sched_day");
        $tz_id_of_tz = $this->input->post("tz_id_of_tz");
        $email_report = $this->input->post("email_report");
        $sched_time = date('H:i:s', strtotime($this->datetime_zone_converter(date('Y-m-d') . " " . $this->input->post("sched_time"), $tz_id_of_tz, 'UTC')));
        if ($subscribe == "true") {
            $sub_val = 1;
        } else {
            $sub_val = 0;
        }
        $this->timesheet_model->save_timezone_changes($timezone_id, $user_id, $sub_val, $report_series, $sched_day, $sched_time, $email_report);

        $est_wage_privacy = $this->input->post("est_wage_privacy") . "";
        $company_id = logged('company_id');
        $date_time_now = date("Y-m-d H:i:s");
        $est_wage_private = 0;
        if ($est_wage_privacy == "true") {
            $est_wage_private = 1;
        }

        $this->timesheet_model->save_est_wage_privacy($est_wage_private, $company_id, $date_time_now, $user_id);

        echo json_encode("saved");
    }
    public function get_next_report()
    {
        $timezone = $this->input->post("timezone");
        $sunday_nextweek = date("Y-m-d", strtotime('sunday next week', strtotime(date('Y-m-d'))));
        $date_converted = $this->datetime_zone_converter($sunday_nextweek, "UTC", $timezone);
        $next_report_date = date('M d D h:i A', strtotime($date_converted));
        echo json_encode($next_report_date);
    }
    public function timesheet_save_current_geo_location()
    {
        $table_id = $this->input->post("table_id");
        $table_name = $this->input->post("table_name");
        $lat = $this->input->post("lat");
        $lng = $this->input->post("lng");
        $formatted_address = $this->input->post("formatted_address");
        $update = array(
            "user_location" => $lat . "," . $lng,
            "user_location_address" => $formatted_address,
        );
        $this->timesheet_model->save_current_geo_location($table_name, $table_id, $update);
        echo json_encode("saved");
    }

    public function leave_requests()
    {
        $this->load->model('LeaveRequest_model');
        $this->load->model('LeaveType_model');
        $this->load->model('EmployeeLeaveCredit_model');

        if(!checkRoleCanAccessModule('user-settings-leave-requests', 'read')){
			show403Error();
			return false;
		}

        $cid = logged('company_id');
        $uid = logged('id');
        $conditions[] = ['field' => 'timesheet_leave.is_archived', 'value' => 0];
        if (logged('user_type') == 7) {
            $leaveRequests = $this->LeaveRequest_model->getAllByCompanyId($cid, $conditions);
        } else {
            $leaveRequests = $this->LeaveRequest_model->getAllByUserId($uid, $conditions);
        }

        $leaveTypes    = $this->LeaveType_model->getAllByCompanyId($cid, []);

        //Leave Credits  
        $employeeLeaveCredits = [];
        $leaveTypes = $this->LeaveType_model->getAllByCompanyId($cid, []);
        foreach ($leaveTypes as $l) {
            $leaveCredits = $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($uid, $l->id);

            $credits = 0;
            if ($leaveCredits) {
                $credits = $leaveCredits->leave_credits;
            }

            $employeeLeaveCredits[$l->id] = ['leave_type' => $l->name, 'leave_credits' => $credits];
        }

        $this->page_data['page']->title   = 'Leave Requests';
        $this->page_data['employeeLeaveCredits'] = $employeeLeaveCredits;
        $this->page_data['leaveRequests'] = $leaveRequests;
        $this->page_data['leaveTypes']    = $leaveTypes;
        $this->load->view('v2/pages/users/leave_requests', $this->page_data);
    }

    public function ajax_create_leave_request()
    {
        $this->load->model('LeaveRequest_model');
        $this->load->model('LeaveType_model');
        $this->load->model('EmployeeLeaveCredit_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        if ($post['leave_type'] == '') {
            $is_success = 0;
            $msg = 'Please select leave type';
        }

        if ($post['request_date_from'] == '' || $post['request_date_to'] == '') {
            $is_success = 0;
            $msg = 'Please specify leave date';
        }

        if ($post['request_reason'] == '') {
            $is_success = 0;
            $msg = 'Please specify leave request reason';
        }

        $leaveCredits = $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($uid, $post['leave_type']);
        if (!$leaveCredits || ($leaveCredits->leave_credits == 0)) {
            $is_success = 0;
            $msg = 'No available leave credits';
        }

        $date_from = $post['request_date_from'] . ' 00:00:00';
        $date_to   = $post['request_date_to'] . ' 23:59:59';

        $time1 = new \DateTime($date_from);
        $time2 = new \DateTime($date_to);
        $diff = $time1->diff($time2);
        $days_diff = $diff->d;
        $hrs_diff  = $diff->h;

        if ($leaveCredits && ($leaveCredits->leave_credits < $days_diff)) {
            $is_success = 0;
            $msg = 'Insufficient leave credits. You only have ' . $leaveCredits->leave_credits . ' ' . $leaveCredits->leave_type . ' credits';
        }

        if ($is_success == 1) {
            $data = [
                'user_id' => $uid,
                'pto_id' => $post['leave_type'],
                'date_from' => $post['request_date_from'],
                'date_to' => $post['request_date_to'],
                'reason' => $post['request_reason'],
                'total_hours' => $hrs_diff,
                'status' => $this->LeaveRequest_model->requestStatusPending(),
                'is_archived' => 0,
                'date_created' => date("Y-m-d H:i:s"),
            ];

            $this->LeaveRequest_model->create($data);

            //Deduct leave credits
            $new_balance = $leaveCredits->leave_credits - $days_diff;
            $data = ['leave_credits' => $new_balance];
            $this->EmployeeLeaveCredit_model->update($leaveCredits->id, $data);

            //Activity Logs
            $leaveType = $this->LeaveType_model->getById($post['leave_type']);
            $activity_name = 'Leave Request : Created leave request';
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_edit_leave_request()
    {
        $this->load->model('LeaveRequest_model');
        $this->load->model('LeaveType_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $leaveRequest = $this->LeaveRequest_model->getByIdAndCompanyId($post['rid'], $cid);
        $leaveTypes   = $this->LeaveType_model->getAllByCompanyId($cid, $conditions);

        if ($leaveRequest->status == $this->LeaveRequest_model->requestStatusPending()) {
            $is_valid = 1;
            $err_msg  = '';
        } else {
            $is_valid = 0;
            if ($leaveRequest->status == $this->LeaveRequest_model->requestStatusApproved()) {
                $err_msg = '<div class="alert alert-danger" role="alert">Cannot edit leave request. Leave request is already approved.</div>';
            } else {
                $err_msg = '<div class="alert alert-danger" role="alert">Cannot edit leave request. Leave request is already disapproved.</div>';
            }
        }

        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['err_msg']  = $err_msg;
        $this->page_data['leaveRequest'] = $leaveRequest;
        $this->page_data['leaveTypes']    = $leaveTypes;
        $this->load->view('v2/pages/users/ajax_edit_leave_request', $this->page_data);
    }

    public function ajax_update_leave_request()
    {
        $this->load->model('LeaveRequest_model');
        $this->load->model('LeaveType_model');
        $this->load->model('EmployeeLeaveCredit_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        if ($post['leave_type'] == '') {
            $is_success = 0;
            $msg = 'Please select leave type';
        }

        if ($post['request_date_from'] == '' || $post['request_date_to'] == '') {
            $is_success = 0;
            $msg = 'Please specify leave date';
        }

        if ($post['request_reason'] == '') {
            $is_success = 0;
            $msg = 'Please specify leave request reason';
        }

        $date_from = $post['request_date_from'] . ' 00:00:00';
        $date_to   = $post['request_date_to'] . ' 23:59:59';

        $time1 = new \DateTime($date_from);
        $time2 = new \DateTime($date_to);
        $diff = $time1->diff($time2);
        $days_diff = $diff->d;
        $hrs_diff  = $diff->h;

        $leaveRequest = $this->LeaveRequest_model->getByIdAndCompanyId($post['rid'], $cid);

        if ($leaveRequest->status != $this->LeaveRequest_model->requestStatusPending()) {
            $status = $leaveRequest->status == $this->LeaveRequest_model->requestStatusApproved() ? 'approved' : 'disapproved';

            $is_success = 0;
            $msg = 'Leave request is lock from editing. Status is already ' . $status;
        }

        $leaveCredits = $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($uid, $post['leave_type']);
        if (!$leaveCredits || ($leaveCredits->leave_credits == 0)) {
            $is_success = 0;
            $msg = 'No available leave credits';
        }

        if ($leaveCredits && ($leaveCredits->leave_credits < $days_diff)) {
            $is_success = 0;
            $msg = 'Insufficient leave credits. You only have ' . $leaveCredits->leave_credits . ' ' . $leaveCredits->leave_type . ' credits';
        }

        if ($is_success == 1 && $leaveRequest) {
            //Return leave credits
            $date_from_a = $leaveRequest->date_from . ' 00:00:00';
            $date_to_a   = $leaveRequest->date_to . ' 23:59:59';
            $time1_a = new \DateTime($date_from_a);
            $time2_a = new \DateTime($date_to_a);
            $diff = $time1_a->diff($time2_a);
            $days_diff_a = $diff->d;
            $hrs_diff_a  = $diff->h;
            $prevLeaveCredits = $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($uid, $leaveRequest->pto_id);
            if ($prevLeaveCredits) {
                $new_balance = $prevLeaveCredits->leave_credits + $days_diff_a;
                $new_data = ['leave_credits' => $new_balance];
                $this->EmployeeLeaveCredit_model->update($prevLeaveCredits->id, $new_data);
            }

            $data = [
                'pto_id' => $post['leave_type'],
                'date_from' => $post['request_date_from'],
                'date_to' => $post['request_date_to'],
                'reason' => $post['request_reason'],
                'total_hours' => $hrs_diff,
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $this->LeaveRequest_model->update($leaveRequest->id, $data);

            //Deduct leave credits
            $new_balance = $leaveCredits->leave_credits - $days_diff;
            $data = ['leave_credits' => $new_balance];
            $this->EmployeeLeaveCredit_model->update($leaveCredits->id, $data);

            //Activity Logs
            $leaveType = $this->LeaveType_model->getById($post['leave_type']);
            $activity_name = 'Leave Request : Updated leave request';
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_leave_request()
    {
        $this->load->model('LeaveRequest_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();
        $leaveRequest = $this->LeaveRequest_model->getByIdAndCompanyId($post['rid'], $cid);
        if ($leaveRequest) {
            $data = ['is_archived' => 1];
            $this->LeaveRequest_model->update($leaveRequest->id, $data);

            $msg = '';
            $is_success = 1;

            //Activity Logs
            $activity_name = 'Leave Request : Deleted ' . $leaveRequest->employee . ' leave request ' . $leaveRequest->leave_type;
            createActivityLog($activity_name);
            // if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusPending() ){
            //     $this->LeaveRequest_model->delete($leaveRequest->id);

            //     $msg = '';
            //     $is_success = 1;

            //     //Activity Logs
            //     $activity_name = 'Leave Request : Deleted leave request'; 
            //     createActivityLog($activity_name);

            // }else{
            //     if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusApproved() ){
            //         $msg = 'Cannot delete leave request. Status is already approved';
            //     }
            // }
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_approve_leave_request()
    {
        $this->load->model('LeaveRequest_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid   = logged('company_id');
        $uid   = logged('id');
        $utype = logged('user_type');
        $post  = $this->input->post();

        if ($utype == 7) {
            $leaveRequest = $this->LeaveRequest_model->getByIdAndCompanyId($post['rid'], $cid);
            if ($leaveRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->LeaveRequest_model->requestStatusApproved(),
                    'disapproved_reason' => '',
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                $this->LeaveRequest_model->update($leaveRequest->id, $data);

                $msg = '';
                $is_success = 1;

                //Activity Logs
                $activity_name = 'Leave Request : Approved ' . $leaveRequest->employee . ' leave request ' . $leaveRequest->leave_type;
                createActivityLog($activity_name);

                // if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusPending() ){
                //     $data = [
                //         'approver_id' => $uid,
                //         'status' => $this->LeaveRequest_model->requestStatusApproved(),
                //         'date_updated' => date("Y-m-d H:i:s")
                //     ];

                //     $this->LeaveRequest_model->update($leaveRequest->id, $data);

                //     $msg = '';
                //     $is_success = 1;

                //     //Activity Logs
                //     $activity_name = 'Leave Request : Updated leave request status to approved'; 
                //     createActivityLog($activity_name);

                // }else{
                //     if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusApproved() ){
                //         $msg = 'Cannot update leave request. Status is already approved';
                //     }

                //     if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusDisApproved() ){
                //         $msg = 'Cannot update leave request. Status is already disapproved';
                //     }
                // }
            }
        } else {
            $msg = 'Only admin can approve request.';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_disapprove_leave_request()
    {
        $this->load->model('LeaveRequest_model');
        $this->load->model('EmployeeLeaveCredit_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid   = logged('company_id');
        $uid   = logged('id');
        $utype = logged('user_type');
        $post  = $this->input->post();

        if ($utype == 7) {
            $leaveRequest = $this->LeaveRequest_model->getByIdAndCompanyId($post['rid'], $cid);
            if ($leaveRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->LeaveRequest_model->requestStatusDisApproved(),
                    'disapproved_reason' => $post['disapprove_reason'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                $this->LeaveRequest_model->update($leaveRequest->id, $data);

                //Return leave credits            
                $leaveCredits = $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($uid, $leaveRequest->pto_id);
                if ($leaveCredits) {
                    $date_from_a = $leaveRequest->date_from . ' 00:00:00';
                    $date_to_a   = $leaveRequest->date_to . ' 23:59:59';
                    $time1_a = new \DateTime($date_from_a);
                    $time2_a = new \DateTime($date_to_a);
                    $diff = $time1_a->diff($time2_a);
                    $days_diff_a = $diff->d;
                    $hrs_diff_a  = $diff->h;

                    $new_balance = $leaveCredits->leave_credits + $days_diff_a;
                    $data = ['leave_credits' => $new_balance];
                    $this->EmployeeLeaveCredit_model->update($leaveCredits->id, $data);
                }

                $msg = '';
                $is_success = 1;

                //Activity Logs
                $activity_name = 'Leave Request : Disapproved ' . $leaveRequest->employee . ' leave request ' . $leaveRequest->leave_type;
                createActivityLog($activity_name);

                // if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusPending() ){
                //     $data = [
                //         'approver_id' => $uid,
                //         'status' => $this->LeaveRequest_model->requestStatusDisApproved(),
                //         'disapproved_reason' => $post['disapprove_reason'],
                //         'date_updated' => date("Y-m-d H:i:s")
                //     ];

                //     $this->LeaveRequest_model->update($leaveRequest->id, $data);

                //     $msg = '';
                //     $is_success = 1;

                //     //Activity Logs
                //     $activity_name = 'Leave Request : Updated leave request status to disapproved'; 
                //     createActivityLog($activity_name);

                // }else{
                //     if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusApproved() ){
                //         $msg = 'Cannot update leave request. Status is already approved';
                //     }

                //     if( $leaveRequest->status == $this->LeaveRequest_model->requestStatusDisApproved() ){
                //         $msg = 'Cannot update leave request. Status is already disapproved';
                //     }
                // }
            }
        } else {
            $msg = 'Only admin can approve request.';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_selected_leave_request()
    {
        $this->load->model('LeaveRequest_model');

        $is_success = 0;
        $msg = 'Nothing to delete';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $total_deleted = 0;
        $errors = [];
        foreach ($post['row_selected'] as $rid) {
            $leaveRequest =  $this->LeaveRequest_model->getByIdAndCompanyId($rid, $cid);
            if ($leaveRequest) {
                $data = ['is_archived' => 1];
                $this->LeaveRequest_model->update($leaveRequest->id, $data);
                //$this->LeaveRequest_model->delete($leaveRequest->id);

                //Activity Logs                
                $activity_name = 'Leave Request : Deleted ' . $leaveRequest->employee . ' leave request ' . $leaveRequest->leave_type;
                createActivityLog($activity_name);

                $total_deleted++;
            }
        }

        if ($total_deleted > 0) {
            $is_success = 1;
            $msg = 'Selected leave requests was successfully deleted';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_approve_selected_leave_request()
    {
        $this->load->model('LeaveRequest_model');

        $is_success = 0;
        $msg = 'Nothing to update';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $total_updated = 0;
        $errors = [];
        foreach ($post['row_selected'] as $rid) {
            $leaveRequest =  $this->LeaveRequest_model->getByIdAndCompanyId($rid, $cid);
            if ($leaveRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->LeaveRequest_model->requestStatusApproved(),
                    'disapproved_reason' => '',
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $this->LeaveRequest_model->update($leaveRequest->id, $data);

                //Activity Logs
                $activity_name = 'Leave Request : Approved ' . $leaveRequest->employee . ' leave request ' . $leaveRequest->leave_type;
                createActivityLog($activity_name);

                $total_updated++;
            }
        }

        if ($total_updated > 0) {
            $is_success = 1;
            $msg = 'Selected leave requests was successfully updated';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_disapprove_selected_leave_request()
    {
        $this->load->model('LeaveRequest_model');
        $this->load->model('EmployeeLeaveCredit_model');

        $is_success = 0;
        $msg = 'Nothing to update';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $total_updated = 0;
        $errors = [];
        foreach ($post['row_selected'] as $rid) {
            $leaveRequest =  $this->LeaveRequest_model->getByIdAndCompanyId($rid, $cid);
            if ($leaveRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->LeaveRequest_model->requestStatusDisApproved(),
                    'disapproved_reason' => $post['disapprove_reason'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $this->LeaveRequest_model->update($leaveRequest->id, $data);

                //Return leave credits            
                $leaveCredits = $this->EmployeeLeaveCredit_model->getByUserIdAndPtoId($uid, $leaveRequest->pto_id);
                if ($leaveCredits) {
                    $date_from_a = $leaveRequest->date_from . ' 00:00:00';
                    $date_to_a   = $leaveRequest->date_to . ' 23:59:59';
                    $time1_a = new \DateTime($date_from_a);
                    $time2_a = new \DateTime($date_to_a);
                    $diff = $time1_a->diff($time2_a);
                    $days_diff_a = $diff->d;
                    $hrs_diff_a  = $diff->h;

                    $new_balance = $leaveCredits->leave_credits + $days_diff_a;
                    $data = ['leave_credits' => $new_balance];
                    $this->EmployeeLeaveCredit_model->update($leaveCredits->id, $data);
                }

                //Activity Logs
                $activity_name = 'Leave Request : Disapproved ' . $leaveRequest->employee . ' leave request ' . $leaveRequest->leave_type;
                createActivityLog($activity_name);

                $total_updated++;
            }
        }

        if ($total_updated > 0) {
            $is_success = 1;
            $msg = 'Selected leave requests was successfully updated';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_view_leave_request()
    {
        $this->load->model('LeaveRequest_model');
        $this->load->model('LeaveType_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $leaveRequest = $this->LeaveRequest_model->getByIdAndCompanyId($post['rid'], $cid);

        if ($leaveRequest) {
            $is_valid = 1;
            $err_msg  = '';
        } else {
            $err_msg = '<div class="alert alert-danger" role="alert">Cannot find data.</div>';
        }

        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['err_msg']  = $err_msg;
        $this->page_data['leaveRequest'] = $leaveRequest;
        $this->load->view('v2/pages/users/ajax_view_leave_request', $this->page_data);
    }

    public function overtime_requests()
    {
        if(!checkRoleCanAccessModule('user-settings-overtime-requests', 'read')){
			show403Error();
			return false;
		}

        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css'
        ));

        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'assets/js/v2/bootstrap-datetimepicker.v2.min.js',
        ));

        $this->load->model('OvertimeRequest_model');

        $cid = logged('company_id');
        $uid = logged('id');
        $conditions[] = ['field' => 'is_archived', 'value' => 0];
        if (logged('user_type') == 7) {
            $overtimeRequests = $this->OvertimeRequest_model->getAllByCompanyId($cid, $conditions);
        } else {
            $overtimeRequests = $this->OvertimeRequest_model->getAllByUserId($uid, $conditions);
        }

        $this->page_data['page']->title   = 'Overtime Requests';
        $this->page_data['overtimeRequests'] = $overtimeRequests;
        $this->load->view('v2/pages/users/overtime_requests', $this->page_data);
    }

    public function ajax_create_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        if ($post['request_date_from'] == '' || $post['request_date_to'] == '') {
            $is_success = 0;
            $msg = 'Please specify overtime date and time';
        }

        if ($post['request_time_from'] == '' || $post['request_time_to'] == '') {
            $is_success = 0;
            $msg = 'Please specify overtime date and time';
        }

        if ($post['request_reason'] == '') {
            $is_success = 0;
            $msg = 'Please specify overtime request reason';
        }

        if ($is_success == 1) {
            $date_from = $post['request_date_from'] . ' ' . $post['request_time_from'];
            $date_to   = $post['request_date_to'] . ' ' . $post['request_time_to'];

            $time1 = new \DateTime($date_from);
            $time2 = new \DateTime($date_to);
            $diff = $time1->diff($time2);
            $hrs_diff  = $diff->h;

            $data = [
                'user_id' => $uid,
                'approver_id' => 0,
                'date_from' => $post['request_date_from'],
                'time_from' => $post['request_time_from'],
                'date_to' => $post['request_date_to'],
                'time_to' => $post['request_time_to'],
                'total_hrs' => $hrs_diff,
                'reason' => $post['request_reason'],
                'disapproved_reason' => '',
                'status' => $this->OvertimeRequest_model->requestStatusPending(),
                'is_archived' => 0,
                'date_created' => date("Y-m-d H:i:s"),
            ];

            $this->OvertimeRequest_model->create($data);

            //Activity Logs            
            $activity_name = 'Overtime Request : Created overtime request';
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_edit_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $post = $this->input->post();
        $cid  = logged('company_id');
        $overtimeRequest = $this->OvertimeRequest_model->getByIdAndCompanyId($post['rid'], $cid);

        if ($overtimeRequest->status == $this->OvertimeRequest_model->requestStatusPending()) {
            $is_valid = 1;
            $err_msg  = '';
        } else {
            $is_valid = 0;
            if ($overtimeRequest->status == $this->OvertimeRequest_model->requestStatusApproved()) {
                $err_msg = '<div class="alert alert-danger" role="alert">Cannot edit overtime request. Overtime request is already approved.</div>';
            } else {
                $err_msg = '<div class="alert alert-danger" role="alert">Cannot edit overtime request. Overtime request is already disapproved.</div>';
            }
        }

        $this->page_data['is_valid'] = $is_valid;
        $this->page_data['err_msg']  = $err_msg;
        $this->page_data['overtimeRequest'] = $overtimeRequest;
        $this->load->view('v2/pages/users/ajax_edit_overtime_request', $this->page_data);
    }

    public function ajax_update_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $is_success = 1;
        $msg = '';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        if ($post['request_date_from'] == '' || $post['request_date_to'] == '') {
            $is_success = 0;
            $msg = 'Please specify overtime date and time';
        }

        if ($post['request_time_from'] == '' || $post['request_time_to'] == '') {
            $is_success = 0;
            $msg = 'Please specify overtime date and time';
        }

        if ($post['request_reason'] == '') {
            $is_success = 0;
            $msg = 'Please specify overtime request reason';
        }

        $overtimeRequest = $this->OvertimeRequest_model->getByIdAndCompanyId($post['rid'], $cid);

        if ($is_success == 1 && $overtimeRequest) {
            $date_from = $post['request_date_from'] . ' ' . $post['request_time_from'];
            $date_to   = $post['request_date_to'] . ' ' . $post['request_time_to'];

            $time1 = new \DateTime($date_from);
            $time2 = new \DateTime($date_to);
            $diff = $time1->diff($time2);
            $hrs_diff  = $diff->h;

            $data = [
                'date_from' => $post['request_date_from'],
                'time_from' => $post['request_time_from'],
                'date_to' => $post['request_date_to'],
                'time_to' => $post['request_time_to'],
                'total_hrs' => $hrs_diff,
                'reason' => $post['request_reason'],
                'disapproved_reason' => '',
                'date_updated' => date("Y-m-d H:i:s"),
            ];

            $this->OvertimeRequest_model->update($overtimeRequest->id, $data);

            //Activity Logs
            $activity_name = 'Overtime Request : Updated overtime request';
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid  = logged('company_id');
        $post = $this->input->post();
        $overtimeRequest = $this->OvertimeRequest_model->getByIdAndCompanyId($post['rid'], $cid);
        if ($overtimeRequest) {
            $data = ['is_archived' => 1];
            $this->OvertimeRequest_model->update($overtimeRequest->id, $data);

            $msg = '';
            $is_success = 1;

            //Activity Logs
            $activity_name = 'Overtime Request : Deleted overtime request';
            createActivityLog($activity_name);
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_approve_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');
        $this->load->model('Timesheet_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid   = logged('company_id');
        $uid   = logged('id');
        $utype = logged('user_type');
        $post  = $this->input->post();

        if ($utype == 7) {
            $overtimeRequest = $this->OvertimeRequest_model->getByIdAndCompanyId($post['rid'], $cid);
            if ($overtimeRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->OvertimeRequest_model->requestStatusApproved(),
                    'disapproved_reason' => '',
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                //$this->OvertimeRequest_model->update($overtimeRequest->id, $data);

                //Add overtime in timesheet
                $date_from = $overtimeRequest->date_from;
                $date_to   = $overtimeRequest->date_to;
                $timesheet = $this->Timesheet_model->get_employee_attendance_with_date_range($overtimeRequest->user_id, $date_from, $date_to);
                if ($timesheet) {
                    $data = [
                        'overtime' => $overtimeRequest->total_hrs,
                        'overtime_status' => 2,
                    ];

                    $this->Timesheet_model->updateTimesheetAttendance($timesheet[0]->id, $data);
                }

                $msg = '';
                $is_success = 1;

                //Activity Logs
                $activity_name = 'Overtime Request : Approved ' . $overtimeRequest->employee . ' overtime request';
                createActivityLog($activity_name);
            }
        } else {
            $msg = 'Only admin can approve request.';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_disapprove_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $cid   = logged('company_id');
        $uid   = logged('id');
        $utype = logged('user_type');
        $post  = $this->input->post();

        if ($utype == 7) {
            $overtimeRequest = $this->OvertimeRequest_model->getByIdAndCompanyId($post['rid'], $cid);
            if ($overtimeRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->OvertimeRequest_model->requestStatusDisApproved(),
                    'disapproved_reason' => $post['disapprove_reason'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];

                $this->OvertimeRequest_model->update($overtimeRequest->id, $data);

                $msg = '';
                $is_success = 1;

                //Activity Logs
                $activity_name = 'Overtime Request : Disapproved ' . $overtimeRequest->employee . ' overtime request';
                createActivityLog($activity_name);
            }
        } else {
            $msg = 'Only admin can approve request.';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_delete_selected_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $is_success = 0;
        $msg = 'Nothing to delete';

        $cid  = logged('company_id');
        $post = $this->input->post();

        $total_deleted = 0;
        $errors = [];
        foreach ($post['row_selected'] as $rid) {
            $overtimeRequest =  $this->OvertimeRequest_model->getByIdAndCompanyId($rid, $cid);
            if ($overtimeRequest) {
                $data = ['is_archived' => 1];
                $this->OvertimeRequest_model->update($overtimeRequest->id, $data);

                //Activity Logs                
                $activity_name = 'Overtime Request : Deleted ' . $overtimeRequest->employee . ' overtime request';
                createActivityLog($activity_name);

                $total_deleted++;
            }
        }

        if ($total_deleted > 0) {
            $is_success = 1;
            $msg = 'Selected overtime requests was successfully deleted';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_approve_selected_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $is_success = 0;
        $msg = 'Nothing to update';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $total_updated = 0;
        $errors = [];
        foreach ($post['row_selected'] as $rid) {
            $overtimeRequest =  $this->OvertimeRequest_model->getByIdAndCompanyId($rid, $cid);
            if ($overtimeRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->OvertimeRequest_model->requestStatusApproved(),
                    'disapproved_reason' => '',
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $this->OvertimeRequest_model->update($overtimeRequest->id, $data);

                //Activity Logs
                $activity_name = 'Overtime Request : Approved ' . $overtimeRequest->employee . ' overtime request';
                createActivityLog($activity_name);

                $total_updated++;
            }
        }

        if ($total_updated > 0) {
            $is_success = 1;
            $msg = 'Selected overtime requests was successfully updated';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_disapprove_selected_overtime_request()
    {
        $this->load->model('OvertimeRequest_model');

        $is_success = 0;
        $msg = 'Nothing to update';

        $cid  = logged('company_id');
        $uid  = logged('id');
        $post = $this->input->post();

        $total_updated = 0;
        $errors = [];
        foreach ($post['row_selected'] as $rid) {
            $overtimeRequest =  $this->OvertimeRequest_model->getByIdAndCompanyId($rid, $cid);
            if ($overtimeRequest) {
                $data = [
                    'approver_id' => $uid,
                    'status' => $this->OvertimeRequest_model->requestStatusDisApproved(),
                    'disapproved_reason' => $post['disapprove_reason'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];
                $this->OvertimeRequest_model->update($overtimeRequest->id, $data);

                //Activity Logs
                $activity_name = 'Overtime Request : Disapproved ' . $overtimeRequest->employee . ' overtime request';
                createActivityLog($activity_name);

                $total_updated++;
            }
        }

        if ($total_updated > 0) {
            $is_success = 1;
            $msg = 'Selected overtime requests was successfully updated';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_update_settings()
    {
        $is_success = 0;
        $msg = 'Cannot find data';


        $post = $this->input->post();
        $cid = logged('company_id');

        $is_allow_email_report = isset($post['subcribe_weekly_report']) ? 1 : 0;
        $with_estimated_wages  = isset($post['est_wage_privacy']) ? 1 : 0;

        $settings = $this->timesheet_model->getSettingsByCompanyId($cid);
        if ($settings) {
            $data = [
                'workweek_start_day' => $post['week_start'],
                'allow_email_report' => $is_allow_email_report,
                'allow_email_timesheet_report_type' => $post['receive_timesheet_report'],
                'allow_email_timesheet_report_days' => json_encode($post['schedDay']),
                'send_time_timesheet_report' => $post['calendar_day_starts_on'],
                'timesheet_report_with_estimated_wages' => $with_estimated_wages,
                'timesheet_report_timezone' => $post['timesheet_report_timezone'],
                'timesheet_report_recipient_email' => $post['email_report'],
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $this->timesheet_model->updateTimesheetSettingsByCompanyId($cid, $data);

            //Activity Logs
            $activity_name = 'Timesheet Settings : Updated company timesheet settings';
            createActivityLog($activity_name);
        } else {
            $data = [
                'company_id' => $cid,
                'date_created' => date("Y-m-d H:i:s"),
                'status' => 1,
                'allow_departments' => 1,
                'regular_hours_per_week' => '40h',
                'regular_hours_per_day' => '8h',
                'overtime' => 'Weekly Overtime',
                'payroll_workweek_start_day' => 'Monday',
                'payroll_schedule' => 'Weekly',
                'allow_manual_entries' => 1,
                'roles' => '',
                'allow_fixed_timezone' => 0,
                'allow_use_decimal_hours' => 0,
                'round_clock_inout_times' => 0,
                'round_increment' => 0,
                'break_rule' => 'Manual',
                'break_length' => '30m',
                'break_type' => 'Unpaid',
                'require_job_code' => 0,
                'allow_location_tracking' => 0,
                'allow_user_specific' => 0,
                'allow_clock_in_restrictions' => 1,
                'workweek_start_day' => $post['week_start'],
                'allow_email_report' => $is_allow_email_report,
                'allow_email_timesheet_report_type' => $post['receive_timesheet_report'],
                'allow_email_timesheet_report_days' => json_encode($post['schedDay']),
                'send_time_timesheet_report' => $post['calendar_day_starts_on'],
                'timesheet_report_with_estimated_wages' => $with_estimated_wages,
                'timesheet_report_timezone' => $post['timesheet_report_timezone'],
                'timesheet_report_recipient_email' => $post['email_report'],
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $this->timesheet_model->createTimesheetSettings($data);

            //Activity Logs
            $activity_name = 'Timesheet Settings : Created company timesheet settings';
            createActivityLog($activity_name);
        }

        $is_success = 1;
        $msg = '';


        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }
}



/* End of file Timesheet.php */

/* Location: ./application/controllers/Timesheet.php */
