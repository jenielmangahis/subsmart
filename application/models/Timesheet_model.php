<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Timesheet_model extends MY_Model {
    public $table = 'time_record';
    private $db_table = 'timesheet_logs';
    private $attn_tbl = 'timesheet_attendance';
    private $tbl_ts_settings = 'timesheet_schedule';

    public function getNotifyCount(){

        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('user_notification',array('user_id'=>$user_id,'status'=>1))->num_rows();
        return $qry;
    }
    public function getTSNotification(){
		$user_id = $this->session->userdata('logged')['id'];
        $this->db->select('n.*,u.FName,u.LName');
        $this->db->from('user_notification n');
        $this->db->join('users u', 'n.user_id = u.id', 'left');
        $this->db->where('n.status =', 1);
        $this->db->order_by('n.id',"desc");
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;

    }
    
    public function getattendance_logs($attn_id){
        $this->db->select('*');
        $this->db->from('timesheet_logs');
        $this->db->where('attendance_id', $attn_id);
        $query = $this->db->get();
        $qry = $query->result();
        return $qry;
    }
    public function getClockInSession(){
//        $this->db->or_where('date_in',date('Y-m-d'));
//        $this->db->or_where('date_in',date('Y-m-d',strtotime('yesterday')));
        $qry = $this->db->get_where($this->attn_tbl,array('status'=>1))->result();
        return $qry;
    }
    public function getNotification($user_id){
        $qry = $this->db->get_where('user_notification',array('user_id' => $user_id))->result();
        return $qry;
    }
    public function getNotificationCount($user_id){
        $qry = $this->db->get_where('user_notification',array('user_id' => $user_id,'status' => 1))->num_rows();
        return $qry;
    }
    public function getEmployeeAttendance(){
        $this->db->or_where('DATE(date_created)',date('Y-m-d'));
        $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        $qry = $this->db->get($this->attn_tbl);
        return $qry->result();
    }
    public function employeeAttendance(){
        $qry = $this->db->get($this->attn_tbl)->result();
        return $qry;
    }
    //Employee's End
    public function getUserAttendance(){
        $user_id = $this->session->userdata('logged')['id'];
        $this->db->order_by('id',"desc")->limit(1);
        $query = $this->db->get_where($this->attn_tbl,array('user_id' => $user_id));
        return $query->result();
    }
    public function getUserLogs(){
        $user_id = $this->session->userdata('logged')['id'];
        $query = $this->db->get_where($this->db_table,array('user_id' => $user_id));
        return $query->result();
    }

    public function getLastWeekTotalDuration(){
//        $qry = $this->db->get('ts_weekly_total_shift');
//        return $qry->result();
        $week_check = array(
            0 => date("Y-m-d",strtotime('monday last week')),
            1 => date("Y-m-d",strtotime('tuesday last week')),
            2 => date("Y-m-d",strtotime('wednesday last week')),
            3 => date("Y-m-d",strtotime('thursday last week')),
            4 => date("Y-m-d",strtotime('friday last week')),
            5 => date("Y-m-d",strtotime('saturday last week')),
            6 => date("Y-m-d",strtotime('sunday last week')),
        );
        for ($x = 0;$x < count($week_check);$x++){
            $this->db->or_where('DATE(date_created)',$week_check[$x]);
        }
        $qry = $this->db->get('timesheet_attendance');
        return $qry->result();
    }
    public function attendance($user_id,$status,$attn_id,$shift,$break,$overtime){
        $qry = $this->db->get_where('timesheet_attendance',array('user_id' => $user_id,'shift_duration' => 0));
        if ($qry->num_rows() == 0 && $status == 1){
            $data = array(
                'user_id' =>  $user_id,
                'status' => 1,
                'date_created' => date('Y-m-d H:i:s')
            );
            $this->db->insert('timesheet_attendance',$data);
            return $this->db->insert_id();
        }else{
            $update = array(
                'status' => 0,
                'shift_duration' => $shift,
                'break_duration' => $break,
                'overtime' => $overtime
            );
            $this->db->where('id',$attn_id);
            $this->db->update('timesheet_attendance',$update);
            return true;
        }
    }

    public function checkInEmployee($user_id,$entry,$approved_by,$company_id){
        $attn_id = $this->attendance($user_id,1,0,null,null,null);
        $qry = $this->db->get_where($this->db_table,array('attendance_id'=>$attn_id,'action' => 'Check in'));
        if ($qry->num_rows() == 0){
            $data = array(
                'attendance_id'=> $attn_id,
                'user_id' => $user_id,
                'action' => 'Check in',
                'user_location' => $this->employeeCoordinates(),
                'user_location_address' => $this->employeeAddress(),
                'date_created' => date('Y-m-d H:i:s'),
                'entry_type' => $entry,
                'approved_by' => $approved_by,
                'company_id' => $company_id
            );
            $this->db->insert($this->db_table,$data);
            return $attn_id;
        }else{
            return false;
        }
    }
    public function checkingOutEmployee($user_id,$attn_id,$entry,$approved_by,$company_id){
        $qry = $this->db->get_where($this->db_table,array('attendance_id'=> $attn_id,'action' => 'Check in'));
        if ($qry->num_rows() == 1){
            $data = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check out',
                'user_location' => $this->employeeCoordinates(),
                'user_location_address' => $this->employeeAddress(),
                'date_created' => date('Y-m-d H:i:s'),
                'entry_type' => $entry,
                'approved_by' => $approved_by,
                'company_id' => $company_id
            );
            $this->db->insert($this->db_table,$data);
            $shift = $this->calculateShiftDuration($attn_id);
            $break = $this->calculateBreakDuration($attn_id);
            $overtime = $this->calculateOvertime($user_id,$attn_id);

            $attendance = $this->attendance($user_id,0,$attn_id,$shift,$break,$overtime);
            if ($attendance == true){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function calculateShiftDuration($attn_id){
        $qry = $this->db->get_where($this->db_table,array('attendance_id' => $attn_id))->result();
        $start_time = 0;
        $end_time = 0;
        foreach ($qry as $time){
            if ($time->action == 'Check in'){
                $start_time = strtotime($time->date_created);
            }elseif($time->action == 'Check out'){
                $end_time = strtotime($time->date_created);
            }
        }
        $diff = ($end_time - $start_time)/3600;
        return round($diff,2);
    }
    public function calculateBreakDuration($attn_id){
        $qry = $this->db->get_where($this->db_table,array('attendance_id' => $attn_id))->result();
        $start_time = 0;
        $end_time = 0;
        foreach ($qry as $time){
            if ($time->action == 'Break in'){
                $start_time = strtotime($time->date_created);
            }elseif($time->action == 'Break out'){
                $end_time = strtotime($time->date_created);
            }
        }
        $diff = ($end_time - $start_time)/3600;
        if ($diff > 0){
            $result = round($diff,2);
        }else{
            $result = 0;
        }
        return $result;
    }

    public function calculateOvertime($user_id,$attn_id){
        $shift = $this->calculateShiftDuration($attn_id);
        $query = $this->db->get_where('ts_schedule_day',array('user_id'=>$user_id,'start_date'=>date('Y-m-d')));
        $hired_type = $this->db->get_where('users',array('id'=>$user_id));
        $min_duration = 0;
        $overtime = 0;
        if ($hired_type->row()->status == 1){
            $min_duration = 8;
        }else{
            $min_duration = 4;
        }
        if ($query->num_rows() == 1){
            $sched = $query->row()->duration;
            $overtime = $shift - $sched;
        }else{
            $overtime = $shift - $min_duration;
        }
        return round($overtime,2);
    }

    public function breakIn($user_id,$entry,$approved_by,$company_id){
        //Get timesheet_attendance id
        date_default_timezone_set('UTC');
        $attn_id = $this->db->get_where($this->attn_tbl,array('user_id'=>$user_id,'status' => 1))->row()->id;
        
        $time = time();
        $data = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break in',
            'user_location' => $this->employeeCoordinates(),
            'user_location_address' => $this->employeeAddress(),
            'date_created' => date('Y-m-d H:i:s',$time),
            'entry_type' => $entry,
            'approved_by' => $approved_by,
            'company_id' => $company_id
        );
        $this->db->insert($this->db_table,$data);
        return $time;
    }

    public function breakOut($user_id,$entry,$approved_by,$company_id){
        $attn_id = $this->db->get_where($this->attn_tbl,array('user_id'=>$user_id,'status' => 1))->row()->id;
        date_default_timezone_set('UTC');
        $time = time();
        $data = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break out',
            'user_location' => $this->employeeCoordinates(),
            'user_location_address' => $this->employeeAddress(),
            'date_created' => date('Y-m-d H:i:s',$time),
            'entry_type' => $entry,
            'approved_by' => $approved_by,
            'company_id' => $company_id
        );
        $this->db->insert("timesheet_logs",$data);
        //Update break duration
        $break = $this->updateBreakDuration($attn_id);
        if ($break == true){
            return $time;
        }else{
            return 0;
        }

    }
    public function gtMyIpGlobal(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])){
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else if(isset($_SERVER['HTTP_X_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        }
        else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        }
        else if(isset($_SERVER['HTTP_FORWARDED'])){
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        }
        else if(isset($_SERVER['REMOTE_ADDR'])){
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        }
        else{
            $ipaddress = 'UNKNOWN';
        }

        $whitelist = array(
            '127.0.0.1', // IPv4 address
            '::1' // IPv6 address
        );
        if (in_array($ipaddress, $whitelist)) {
            return "";
        }else
        {
            return $ipaddress;
        }

    }
    public function employeeCoordinates(){
        $ipaddress = $this->gtMyIpGlobal();
        $get_location = json_decode(file_get_contents('http://ip-api.com/json/'.$ipaddress));
        return $get_location->lat.",".$get_location->lon; //to get coordinates
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

    public function updateBreakDuration($attn_id){
        $query = $this->db->get_where($this->attn_tbl,array('id' => $attn_id));
        $this->db->order_by('date_created','DESC')->limit(1);
        $break_in = $this->db->get_where($this->db_table,array('attendance_id'=>$attn_id,'action'=>'Break in'));
        $this->db->order_by('date_created','DESC')->limit(1);
        $break_out = $this->db->get_where($this->db_table,array('attendance_id'=>$attn_id,'action'=>'Break out'));
        $total_time = strtotime($break_out->row()->date_created) - strtotime($break_in->row()->date_created);
        $hours      = floor($total_time /3600);
        $minutes    = intval(($total_time/60) % 60);
        $seconds    = intval($total_time % 60);
        $break_diff = "$hours".":".$minutes.":".$seconds.":";
        $timeArr = explode(':', $break_diff);
        $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
        if ($query->num_rows() == 1){
            $this->db->set('break_duration', 'break_duration+'.$decTime, FALSE);
            $this->db->where('id',$attn_id)->update($this->attn_tbl);
            return true;
        }else{
            return false;
        }
    }

    public function getTSLogsByUser(){
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where($this->db_table,array('user_id' => $user_id,'status'=>1))->result();
        return $qry;
    }
    public function getTimesheetLogs(){
        $qry = $this->db->get('timesheet_logs');
        return $qry->result();
    }
    public function getTSByDate($date_this_week){
//            $this->db->like('date_created',date('Y-m-d',strtotime('yesterday')));
        for ($x = 0; $x < count($date_this_week);$x++){
            $this->db->or_like('date_created',$date_this_week[$x]);
        }
        $qry = $this->db->get('timesheet_logs');
        return $qry->result();
    }
    public function getUser_current_status($user_id,$date){
        $this->db->select('*');
        $this->db->from('timesheet_logs');
        $this->db->where('user_id',$user_id);
        $this->db->like('date_created',$date);
        $this->db->order_by('id', "DESC")->limit(1);
        $qry = $this->db->get();
        return $qry->result();
    }
    


    public function getTotalUsersLoggedIn(){

        $total_users = $this->users_model->getTotalUsers();
        date_default_timezone_set('UTC');
        $company_id=logged('company_id');
        $this->db->select('*');
        $this->db->from("users");
        $this->db->join("timesheet_attendance", 'users.id = timesheet_attendance.user_id');
        $this->db->where("users.company_id",$company_id);
        $this->db->where("timesheet_attendance.status",1);
        $this->db->like("timesheet_attendance.date_created",date('Y-m-d'));
        $query = $this->db->get();
        // $this->db->or_where('DATE(date_created)',date('Y-m-d'));
        // $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        // $this->db->where('status',1);
        // $query =  $this->db->get('timesheet_attendance');
        // var_dump( $query->result());
        $logged_in = $query->num_rows();
        return $total_users - $logged_in;
    }
    public function getInNow(){
        $this->db->or_where('DATE(date_created)',date('Y-m-d'));
//        $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        $this->db->where('status',1);
        $query = $this->db->get('timesheet_attendance');
        return $query->num_rows();
    }
    public function getOutNow(){
        $total_user = $this->users_model->getTotalUsers();
        $this->db->or_where('DATE(date_created)',date('Y-m-d'));
        $query = $this->db->get_where('timesheet_attendance',array('status' => 0))->num_rows();
        return $query;
    }
 
    public function getAttendanceByDay($day){
        $this->db->or_where('DATE(date_created)',$day);
        $this->db->or_where('DATE(date_created)',date('Y-m-d',strtotime('yesterday')));
        $query = $this->db->get('timesheet_attendance')->result();
        return $query;
    }
    public function getTimeSettingsByUser(){
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('timesheet_schedule',array('user_id'=>$user_id));
        return $qry->result();
    }
    public function getTimesheetDayByUser(){
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('ts_schedule_day',array('user_id'=>$user_id));
        return $qry->result();
    }

    public function getTimeSheetSettings(){
        $qry = $this->db->get('timesheet_schedule');
        return $qry->result();
    }
    public function getTimeSheetDay(){
        $qry = $this->db->get('ts_schedule_day');
        return $qry->result();
    }
    public function getTimeSheetByWeek($week){
        for ($x = 0;$x < count($week);$x++){
            $this->db->or_where('date_created',$week[$x]);
        }
        $qry = $this->db->get('timesheet_schedule');
        return $qry->result();
    }
    public function getTimeSheetByUser($users_id){
        $this->db->where('user_id',$users_id);
        $qry = $this->db->get('timesheet_schedule');
        return $qry->result();
    }
    public function getTimeSheetDayById($timesheet_id){
        $qry = $this->db->get_where('ts_schedule_day',array('schedule_id'=>$timesheet_id));
        return $qry->result();
    }

    public function addingProjects($data){
        $week_convert = date('Y-m-d',strtotime($data['week']));
        $qry = $this->db->get_where($this->tbl_ts_settings,array('project_name' => $data['project'],'user_id' => $data['user_id']));
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'project_name' => $data['project'],
                'timezone' => $data['timezone'],
                'notes' => $data['notes'],
                'total_duration_w' => intval($data['duration']),
                'date_created' => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
                'status' => 1
            );
            $this->db->insert($this->tbl_ts_settings,$insert);
            $ts_id = $this->db->insert_id();
            $this->perDaySchedule($ts_id,$data);
            return true;
        }else{
            return false;
        }
    }
    //Updating timesheet settings total duration
    public function recalculateWeekDuration($ts_id){
        $total = 0;
        $query = $this->db->get_where('ts_schedule_day',array('schedule_id'=>$ts_id))->result();
        foreach ($query as $durations){
            $total += $durations->duration;
        }
        $ts_settings = array('total_duration_w'=>$total);
        $this->db->where('id',$ts_id);
        $this->db->update('timesheet_schedule',$ts_settings);
    }
    public function perDaySchedule($ts_id,$data){
        $qry = $this->db->get_where('ts_schedule_day',array('schedule_id'=>$ts_id,'start_date' => $data['start_date']));
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'schedule_id' => $ts_id,
                'start_date' => $data['start_date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'day' => $data['day'],
                'duration' => intval($data['duration'])
            );
            $this->db->insert('ts_schedule_day',$insert);
            $this->recalculateWeekDuration($ts_id);
        }else{
            $update = array(
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'duration' => $data['duration']
            );
            $array_check = array('schedule_id' => $ts_id,'start_date' => $data['start_date']);
            $this->db->where($array_check);
            $this->db->update('ts_schedule_day',$update);
            $this->recalculateWeekDuration($ts_id);

        }
        return true;
    }
    public function updateTSProject($id,$update){
        $qry = $this->db->get_where('timesheet_schedule',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->update('timesheet_schedule',$update);
            return true;
        }else{
            return false;
        }
    }
    public function updateTotalWeekDuration($update){
        $qry = $this->db->get_where('timesheet_schedule',array('id'=>$update['project_id']));
        if ($qry->num_rows() == 1){
            $data = array(
              'total_duration_w' => $update['total']
            );
            $this->db->where('id',$update['project_id']);
            $this->db->update('timesheet_schedule',$data);
            return true;
        }else{
            return false;
        }
    }
    //Get PTO Type
    public function getPTO(){
        $qry = $this->db->get('timesheet_pto');
        return $qry->result();
    }
    public function getPTOByName($name){
        $this->db->like('name',$name);
        $query = $this->db->get('timesheet_pto');
        return $query->result();
    }

    //Adding PTO type
    public function savedPTO($id,$type){
        for ($x = 0;$x < count($type);$x++){
            if ($type[$x] != null){
                $update = array(
                    'name' => $type[$x]
                );
                $find = array('id'=>$id[$x]);
                $check = $this->db->where($find);
                if ($check == true && $id[$x] > 0){
                    $this->db->update('timesheet_pto',$update);

                }else{
                    $qry = $this->db->get_where('timesheet_pto',array('name'=>$type[$x]));
                    if ($qry->num_rows() == 0){
                        $insert = array(
                            'name' => $type[$x],
                            'company_id' => getLoggedCompanyID()
                        );
                        $this->db->insert('timesheet_pto',$insert);
                    }

                }
            }

        }
    }
    //Employee requesting leave
    public function employeeRequestLeave($pto,$date){
        $user_id = $this->session->userdata('logged')['id'];
        $query = $this->db->get_where('timesheet_leave',array('user_id' => $user_id));
        if ($query->num_rows() == 0){
            $insert = array(
                'pto_id' => $pto,
                'user_id' => $user_id,
                'status' => 0
            );
            $this->db->insert('timesheet_leave',$insert);
            $leave_id = $this->db->insert_id();
            //Inserting the dates
            for ($x = 0;$x < count($date);$x++){
                $data[] = array(
                    'leave_id' => $leave_id,
                    'date' => date('Y-m-d',strtotime($date[$x]))
                );
            }
            $this->db->insert_batch('timesheet_leave_date',$data);
            $return = true;
        }else{
            $return = false;
        }
        return $return;
    }

    //Get leave request
    public function getLeaveRequest(){
        $this->db->order_by("date_created", "desc");
        $qry = $this->db->get('timesheet_leave');
        return $qry->result();
    }
    //Get leave date
    public function getLeaveDate(){
        $this->db->order_by("date", "desc");
        $qry = $this->db->get('timesheet_leave_date');
        return $qry->result();
    }

    //Invite link
    public function inviteLinkEntry($email,$name,$role){
        $user_id = $this->session->userdata('logged')['id'];
        $query = $this->db->get_where('timesheet_team_members',array('email'=>$email));
        if ($query->num_rows() == 0){
            $data = array(
                'user_id' => $user_id,
                'role' => $role,
                'name' => $name,
                'email' => $email,
                'status' => 0
            );
            $this->db->insert('timesheet_team_members',$data);
        }
        //Inserting invitation code.
        $random = sha1(rand());
        $insert = array(
            'email' => $email,
            'invitation_code' => $random,
            'status' => 1,
            'date_created' => date('Y-m-d h:i:s')
        );
        $this->db->insert('timesheet_invite_link',$insert);
        return $random;
    }
    //Department
    public function getDepartment(){
        $qry = $this->db->get('timesheet_departments');
        return $qry->result();
    }
    public function getDepartmentById($id){
        $return = null;
        if ($id != 0 || $id != null){
            $qry = $this->db->get_where('timesheet_departments',array('id'=>$id));
            if ($qry->num_rows() == 1){
                $return = $qry->result();
            }else{
                $return = 0;
            }
        }else{
            $return = 0;
        }
        return $return;
    }
    //Adding department
    public function addDepartment($dept){
        $user_id = $this->session->userdata('logged')['id'];
        $return = 1;
        for ($x = 0;$x < count($dept);$x++){
            $query = $this->db->get_where('timesheet_departments',array('name'=>$dept[$x]));
            if ($query->num_rows() == 0){
                $insert = array(
                    'name' => $dept[$x],
                    'user_id' => $user_id
                );
                $this->db->insert('timesheet_departments',$insert);
                $return = 1;
            }else{
                $return = 0;
            }
        }
        return $return;
    }
    //Workweek and Overtime settings
    public function workweekOvertimeSettings($data){
        $qry = $this->db->get_where('timesheet_settings',array('company_id'=>getLoggedCompanyID()));
        if ($qry->num_rows() == 0){
            $insert = array(
                'company_id' => getLoggedCompanyID(),
                'workweek_start_day' => $data['start_day'],
                'regular_hours_per_week' => $data['hours_week'],
                'regular_hours_per_day' => $data['hours_day'],
                'overtime' => $data['overtime']
            );
            $this->db->insert('timesheet_settings',$insert);
            return true;
        }elseif($qry->num_rows() == 1){
            $update = array(
                'workweek_start_day' => $data['start_day'],
                'regular_hours_per_week' => $data['hours_week'],
                'regular_hours_per_day' => $data['hours_day'],
                'overtime' => $data['overtime']
            );
            $this->db->where('company_id',getLoggedCompanyID());
            $this->db->update('timesheet_settings',$update);
            return true;
        }else{
            return false;
        }
    }
    //Break Preference
    public function breakPreference($data){
        $qry = $this->db->get_where('timesheet_settings',array('company_id'=>getLoggedCompanyID()));
        if ($qry->num_rows() == 0){
            $insert = array(
                'company_id' => getLoggedCompanyID(),
                'break_rule' => $data['break_rule'],
                'break_length' => $data['length'],
                'break_type' => $data['type']
            );
            $this->db->insert('timesheet_settings',$insert);
            return true;
        }elseif($qry->num_rows() == 1){
            $update = array(
                'break_rule' => $data['break_rule'],
                'break_length' => $data['length'],
                'break_type' => $data['type']
            );
            $this->db->where('company_id',getLoggedCompanyID());
            $this->db->update('timesheet_settings',$update);
            return true;
        }else{
            return false;
        }
    }
    public function get_attendance($user_id, $date){
        $this->db->select('*');
        $this->db->from('timesheet_attendance');
        $this->db->where("user_id",$user_id);
        $this->db->like('date_created',$date);
        $query = $this->db->get();
        return  $query-result();
    }

    public function getLeaveList($date,$status_request){
        if($status_request==="pending"){
            $status=0; 
        }elseif($status_request==="approved"){
            $status=1;
        }else{
            $status=2; //unapproved
        }
        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('timesheet_leave');
        $this->db->join('timesheet_leave_date', 'timesheet_leave_date.leave_id = timesheet_leave.id');
        $this->db->join('users', 'users.id = timesheet_leave.user_id');
        $this->db->where("timesheet_leave_date.date",$date);
        $this->db->where("timesheet_leave.status",$status);
        $this->db->where("users.company_id",$company_id);
        $query = $this->db->get();
        return $query->result();
    }
    ////Lou pinton's code starts here
    public function gethis_leaveType($user_id,$date,$status_request){
        if($status_request==="pending"){
            $status=0; 
        }elseif($status_request==="approved"){
            $status=1;
        }else{
            $status=2; //unapproved
        }
        $this->db->select('*');
        $this->db->from('timesheet_leave');
        $this->db->join('timesheet_leave_date', 'timesheet_leave_date.leave_id = timesheet_leave.id');
        $this->db->join('timesheet_pto', 'timesheet_pto.id = timesheet_leave.pto_id');
        $this->db->where("timesheet_leave.user_id",$user_id);
        $this->db->where("timesheet_leave_date.date",$date);
        $this->db->where("timesheet_leave.status",$status);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAllLogsToday($user_id,$date){
        $this->db->select('*');
        $this->db->from('timesheet_logs');
        $this->db->where("user_id",$user_id);
        $this->db->like("date_created",$date);
        $query = $this->db->get();
        return $query->result();
    }

}



/* End of file Timesheet_model.php */

/* Location: ./application/models/Timesheet_model.php */
