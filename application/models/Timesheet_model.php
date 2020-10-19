<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Timesheet_model extends MY_Model {
    public $table = 'time_record';
    private $db_table = 'timesheet_logs';
    private $attn_tbl = 'timesheet_attendance';
    private $tbl_ts_settings = 'timesheet_settings';

//    public function clockIn($data)
//    {
//        $this->db->insert($this->table, $data);
//    }
    public function getNotifyCount(){
        $user_id = $this->session->userdata('logged')['id'];
        $qry = $this->db->get_where('user_notification',array('user_id'=>$user_id,'status'=>1))->num_rows();
        return $qry;
    }

    public function getTSNotification(){
        $user_id = $this->session->userdata('logged')['id'];
        $this->db->order_by('id',"desc");
        $qry = $this->db->get_where('user_notification',array('user_id'=>$user_id))->result();
        return $qry;
    }
    public function getClockInSession(){
        $this->db->or_where('date_in',date('Y-m-d'));
        $this->db->or_where('date_in',date('Y-m-d',strtotime('yesterday')));
        $qry = $this->db->get($this->attn_tbl)->result();
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
        $this->db->or_where('date_in',date('Y-m-d'));
        $this->db->or_where('date_in',date('Y-m-d',strtotime('yesterday')));
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

    public function getWeekTotalDuration(){
        $qry = $this->db->get('ts_weekly_total_shift');
        return $qry->result();
    }
    public function attendance($user_id,$status,$attn_id,$shift,$break,$week_ID,$flag,$overtime){
        if ($flag == 0){
            $week_id = $this->totalHoursShift($user_id,$week_ID);
        }
        $qry = $this->db->get_where($this->attn_tbl,array('user_id' => $user_id,'shift_duration' => 0));
        if ($qry->num_rows() == 0 && $status == 1){
            $data = array(
                'week_id' => $week_id,
                'user_id' =>  $user_id,
                'date_in' => date('Y-m-d'),
                'date_out' => date('Y-m-d'),
                'status' => $status
            );
            $this->db->insert($this->attn_tbl,$data);
            return $this->db->insert_id();
        }elseif($qry->num_rows() == 1 && $status == 0){
            $update = array(
                'status' => $status,
                'date_out' => date('Y-m-d'),
                'shift_duration' => $shift,
                'break_duration' => $break,
                'overtime' => $overtime
            );
            $this->db->where('id',$attn_id);
            $this->db->update($this->attn_tbl,$update);
            $this->totalHoursShift($user_id,$week_ID);
        }
    }

    public function checkInEmployee($user_id,$entry,$approved_by){
        $attn_id = $this->attendance($user_id,1,0,null,null,0,0,0);
        $qry = $this->db->get_where($this->db_table,array('attendance_id'=>$attn_id,'action' => 'Check in'));
        if ($qry->num_rows() == 0){
            $data = array(
                'attendance_id'=> $attn_id,
                'user_id' => $user_id,
                'action' => 'Check in',
                'date' => date('Y-m-d'),
                'time' => time(),
                'entry_type' => $entry,
                'approved_by' => $approved_by,
                'status' => 1,
            );
            $this->db->insert($this->db_table,$data);
            return $attn_id;
        }else{
            return false;
        }
    }
    public function checkingOutEmployee($user_id,$week_ID,$attn_id,$entry,$approved_by){
        $qry = $this->db->get_where($this->db_table,array('attendance_id'=> $attn_id,'action' => 'Check in'));
        if ($qry->num_rows() == 1){
            $data = array(
                'attendance_id' => $attn_id,
                'user_id' => $user_id,
                'action' => 'Check out',
                'date' => date('Y-m-d'),
                'time' => time(),
                'entry_type' => $entry,
                'approved_by' => $approved_by,
                'status' => 1,
            );
            $this->db->insert($this->db_table,$data);
            $shift = $this->calculateShiftDuration($attn_id);
            $break = $this->calculateBreakDuration($attn_id);
            $overtime = $this->calculateOvertime($user_id,$attn_id);
            $this->updateWeeklyReport($week_ID);
            $this->attendance($user_id,0,$attn_id,$shift,$break,$week_ID,1,$overtime);
            return true;
        }else{
            return false;
        }
    }
    public function updateWeeklyReport($week_ID){
        $weekly_duration = 0;
        $weekly_break = 0;
        $weekly_overtime = 0;
        $get_weekly = $this->db->get_where('timesheet_attendance',array('week_id'=>$week_ID))->result();
        foreach ($get_weekly as $total){
            $weekly_duration += $total->shift_duration;
            $weekly_break += $total->break_duration;
            $weekly_overtime += $total->overtime;
        }
        $weekly_update = array(
            'total_shift' => $weekly_duration,
            'total_break' => $weekly_break,
            'total_overtime' => $weekly_overtime
        );
        $this->db->where('id',$week_ID);
        $this->db->update('ts_weekly_total_shift',$weekly_update);
    }
    public function calculateShiftDuration($attn_id){
        $qry = $this->db->get_where($this->db_table,array('attendance_id' => $attn_id))->result();
        $start_time = 0;
        $end_time = 0;
        foreach ($qry as $time){
            if ($time->action == 'Check in'){
                $start_time = $time->time;
            }elseif($time->action == 'Check out'){
                $end_time = $time->time;
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
                $start_time = $time->time;
            }elseif($time->action == 'Break out'){
                $end_time = $time->time;
            }
        }
        $diff = ($end_time - $start_time)/3600;
        if ($diff > 0){
            $result = round($diff,2);
        }else{
            $result = null;
        }
        return $result;
    }

    public function calculateOvertime($user_id,$attn_id){
        $shift = $this->calculateShiftDuration($attn_id);
        $query = $this->db->get_where('ts_settings_day',array('user_id'=>$user_id,'start_date'=>date('Y-m-d')));
        if ($query->num_rows() == 1){
            $sched = $query->row()->duration;
            if ($shift >= $sched){
                $overtime = $shift - $sched;
            }else{
                $overtime = 0;
            }
        }else{
            $overtime = $shift - 8;
        }
        return round($overtime,2);
    }
    private function totalHoursShift($user_id,$week_ID){
        $total_shift = 0;
        if ($week_ID != 0){
            $qry = $this->db->get_where($this->attn_tbl,array('week_id'=>$week_ID))->result();
            foreach ($qry as $shift){
                $total_shift += $shift->shift_duration;
            }
        }

        //Inserting or Updating weekly total shift
        $tbl_total_shift = $this->db->get_where('ts_weekly_total_shift',array('user_id'=>$user_id,'week_of'=>date("Y-m-d",strtotime('monday this week'))));
        if ($tbl_total_shift->num_rows() == 0){
            $insert = array(
                'user_id' => $user_id,
                'week_of' => (date('D',strtotime('tomorrow')) == "Mon")?date("Y-m-d",strtotime('monday next week')):date("Y-m-d",strtotime('monday this week')),
                'total_shift' => $total_shift
            );
            $this->db->insert('ts_weekly_total_shift',$insert);
            return $this->db->insert_id();
        }else{
            if ($week_ID != 0){
                $update = array(
                    'total_shift' => $total_shift
                );
                $this->db->where('id',$week_ID);
                $this->db->update('ts_weekly_total_shift',$update);
            }
            return $tbl_total_shift->row()->id;
        }
    }
    public function breakIn($user_id,$entry,$approved_by,$end_break){
        //Get timesheet_attendance id
        $attn_id = $this->db->get_where($this->attn_tbl,array('user_id'=>$user_id,'status' => 1))->row()->id;
        $data = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break in',
            'date' => date('Y-m-d'),
            'time' => time(),
            'entry_type' => $entry,
            'approved_by' => $approved_by,
            'status' => 1
        );
        $this->db->insert($this->db_table,$data);
        //Update timesheet_attendance expected end break
        $update = array('expected_endbreak'=>$end_break);
        $this->db->where('id',$attn_id);
        $this->db->update('timesheet_attendance',$update);
        return true;
    }

    public function breakOut($user_id,$entry,$approved_by){
        $attn_id = $this->db->get_where($this->attn_tbl,array('user_id'=>$user_id,'status' => 1))->row()->id;
        $data = array(
            'attendance_id' => $attn_id,
            'user_id' => $user_id,
            'action' => 'Break out',
            'date' => date('Y-m-d'),
            'time' => time(),
            'entry_type' => $entry,
            'approved_by' => $approved_by,
            'status' => 1
        );
        $this->db->insert($this->db_table,$data);
        return true;
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
            $this->db->or_where('date',date('Y-m-d',strtotime('yesterday')));
        for ($x = 0; $x < count($date_this_week);$x++){
            $this->db->or_where('date',$date_this_week[$x]);
        }
        $qry = $this->db->get('timesheet_logs');
        return $qry->result();
    }

    /**
     * @return mixed
     */
    public function clockOut($data)
    {
        $this->db->insert($this->table, $data);
    }


    /**
     * @return mixed
     */
    public function manualClockIn($data)
    {
        //dd($data);die;
        $this->db->insert($this->table, $data);
    }


    /**
     * @return mixed
     */
    public function getClockIn($data)
    {
        $user_id = $data['user_id'];
        //$sql = "SELECT * FROM timesheet WHERE id = ? LIMIT 1";
        //$query = $db->query($sql, [$user_id]);


        $todaysDate = date("Y-m-d"); # or any other date

        $this->db->select('*');
        //$this->db->distinct();
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->like('timestamp', $todaysDate);
        //$this->db->where('action', "Clock In");
        $this->db->order_by('timestamp', 'ASC');
        $this->db->limit(2);
        $query = $this->db->get();
        // $this->db->select('*');
        // $this->db->from($this->table);
        // $this->db->where('employees_id', $user_id);
        // $this->db->where('action', 'Clock In');
        // $this->db->order_by('timestamp', 'DESC');
        // $this->db->limit(1);
        // $query = $this->db->get();

        return $query->result();

        // dd($query->result());die;
        
    }
    /**
     * @return mixed
     */
    public function getClockInTimelog($data)
    {
        $user_id = $data['user_id'];
        //$sql = "SELECT * FROM timesheet WHERE id = ? LIMIT 1";
        //$query = $db->query($sql, [$user_id]);


        $todaysDate = date("Y-m-d"); # or any other date

        $this->db->select('*');
        //$this->db->distinct();
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->like('timestamp', $todaysDate);
        //$this->db->where('action', "Clock In");
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(2);
        $query = $this->db->get();
        // $this->db->select('*');
        // $this->db->from($this->table);
        // $this->db->where('employees_id', $user_id);
        // $this->db->where('action', 'Clock In');
        // $this->db->order_by('timestamp', 'DESC');
        // $this->db->limit(1);
        // $query = $this->db->get();

        return $query->result();

        // dd($query->result());die;
        
    }
    /**
     * @return mixed
     */
    public function getClockInToday($data)
    {
        $user_id = $data['user_id'];
        //$sql = "SELECT * FROM timesheet WHERE id = ? LIMIT 1";
        //$query = $db->query($sql, [$user_id]);


        $todaysDate = date("Y-m-d"); # or any other date

        $this->db->select('*');
        //$this->db->distinct();
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        //$this->db->like('timestamp', $todaysDate);
        //$this->db->where('action', "Clock In");
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        // $this->db->select('*');
        // $this->db->from($this->table);
        // $this->db->where('employees_id', $user_id);
        // $this->db->where('action', 'Clock In');
        // $this->db->order_by('timestamp', 'DESC');
        // $this->db->limit(1);
        // $query = $this->db->get();

        return $query->result();

        // dd($query->result());die;
        
    }

    /**
     * @return mixed
     */
    public function getClockOut($data)
    {
        $user_id = $data['user_id'];
        //$sql = "SELECT * FROM timesheet WHERE id = ? LIMIT 1";
        //$query = $db->query($sql, [$user_id]);

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->where('action', "Clock Out");
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

       /*$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $user_id);
        $this->db->order_by('clock_in', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();*/
        

        return $query->result();
        
    }

    /**
     * @return mixed
     */
    public function getClockIns()
    {

        /*$parent_id = getLoggedUserID();
        $cid=logged('comp_id');
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $parent_id);
        $this->db->or_where('id', $parent_id);
        $this->db->or_where('company_id',$cid );
        // $this->db->where('role !=', 1);
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result();*/

        // edited using the new column names
        $parent_id = getLoggedUserID();
        $cid=logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $parent_id);
        $this->db->or_where('company_id',$cid );
        // $this->db->where('role !=', 1);
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result();

    }

    /**
     * @return mixed
     */
    public function getClockOuts($id)
    {
        $parent_id = getLoggedUserID();
        $cid=logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $parent_id);
        $this->db->or_where('id', $parent_id);
        $this->db->or_where('company_id',$cid );
        // $this->db->where('role !=', 1);
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result();
    }

    
    /**
     * @return mixed
     */
    public function updateClockin($id)
    {
        $parent_id = getLoggedUserID();
        $cid=logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $parent_id);
        $this->db->or_where('id', $parent_id);
        $this->db->or_where('company_id',$cid );
        // $this->db->where('role !=', 1);
        $query = $this->db->get();
        // echo $this->db->last_query(); die;
        return $query->result();
    }    

    /**
     * @return mixed
     */
    public function getLastClockin($data)
    {
        $user_id = $data['user_id'];

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->where('action', "Clock In");
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

       /*$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $user_id);
        $this->db->order_by('clock_in', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();*/
        

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getLastClockout($data)
    {
        $user_id = $data['user_id'];

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->where('action', "Clock Out");
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();

       /*$this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $user_id);
        $this->db->order_by('clock_in', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();*/
        

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getTotalClockinDay($data){
        $user_id = $data['user_id'];
        $date = $data['date'];

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->where('action', "Clock In");
        $this->db->like('timestamp', $date);
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query_clockin = $this->db->get();
        $query_clockin = $query_clockin->result();

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->where('action', "Clock Out");
        $this->db->like('timestamp', $date);
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query_clockout = $this->db->get();
        $query_clockout = $query_clockout->result();

        if( !empty($query_clockin) && !empty($query_clockout)){
            // Convert each date to its equivalent timestamp
            $clockin_date = strtotime($query_clockin[0]->timestamp);
            $clockout_date = strtotime($query_clockout[0]->timestamp);
            // Divide the timestamp by (60*60) to get the number of hours.
            //As the difference between two dates might be negative, we use absolute function, abs(), to get the value only. Then, we divided it by 60*60 to get the hours.
            $totalhours = abs($clockout_date - $clockin_date)/(60*60);
        }
        else{
            $totalhours = 0;
        }

        
        //print_r($totalhours);
        return $totalhours;
    }

    /**
     * @return mixed
     */
    public function getTotalClockinWeek($data){
        $user_id = $data['user_id'];

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->where('action', "Clock In");
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getTotalClockinMonth($data){
        $user_id = $data['user_id'];

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('employees_id', $user_id);
        $this->db->where('action', "Clock In");
        $this->db->order_by('timestamp', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getTotalInEmployees(){
        $todaysDate = date("Y-m-d"); # or any other date

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('timestamp', $todaysDate);
        $this->db->where('action', "Clock In");
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * @return mixed
     */
    public function getTotalOutEmployees(){
        $todaysDate = date("Y-m-d"); # or any other date

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('timestamp', $todaysDate);
        $this->db->where('action', "Clock Out");
        $query = $this->db->get();

        return $query->num_rows();
    }
    /**
     * @return mixed
     */
    public function getTotalNotLoggedInTodayEmployees(){
        //$this->load->model('users_model');
        $todaysDate = date("Y-m-d"); # or any other date

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('timestamp', $todaysDate);
        $this->db->where('action', "Clock In");
        $query = $this->db->get();
        $loggedintoday = $query->num_rows();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id !=', 1);
        $query = $this->db->get();
        $totalemployees = $query->num_rows();

        $totalnotloggedintoday = $totalemployees - $loggedintoday;
        return $totalnotloggedintoday;
    }

    /**
     * @return mixed
     */
    public function getTotalEmployees(){
        //$this->load->model('users_model');
        //$todaysDate = date("Y-m-d"); # or any other date

        $this->db->select('*');
        $this->db->from('users');
        /*$this->db->where('id !=', 1);*/
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTotalUsersLoggedIn(){
        $total_users = $this->users_model->getTotalUsers();
        $this->db->or_where('date_in',date('Y-m-d'));
        $this->db->or_where('date_in',date('Y-m-d',strtotime('yesterday')));
        $this->db->where('status',1);
        $query =  $this->db->get('timesheet_attendance');
        $logged_in = $query->num_rows();
        return $total_users - $logged_in;
    }
    public function getInNow(){
//        $this->db->or_where('date_in',date('Y-m-d'));
//        $this->db->or_where('date_in',date('Y-m-d',strtotime('yesterday')));
        $this->db->where('status',1);
        $query = $this->db->get('timesheet_attendance');
        return $query->num_rows();
    }
    public function getOutNow(){
        $query = $this->db->get_where('timesheet_attendance',array('status' => 0,'date_out'=>date('Y-m-d')))->num_rows();
        return $query;
    }
    public function getAttendanceByDay($day){
        $this->db->or_where('date_in',$day);
        $this->db->or_where('date_in',date('Y-m-d',strtotime('yesterday')));
        $query = $this->db->get('timesheet_attendance')->result();
        return $query;
    }
//    public function getInNowData(){
//        $query = $this->db->get_where($this->db_table,array('action'=>'Check in'));
//        return $query->result();
//    }

    public function getTimeSheetSettings(){
        $qry = $this->db->get('timesheet_settings');
        return $qry->result();
    }
    public function getTimeSheetDay(){
        $qry = $this->db->get('ts_settings_day');
        return $qry->result();
    }
    public function getTimeSheetByWeek($week){
        for ($x = 0;$x < count($week);$x++){
            $this->db->or_where('date_created',$week[$x]);
        }
        $qry = $this->db->get('timesheet_settings');
        return $qry->result();
    }
    public function getTimeSheetByUser($users_id){
        $this->db->where('user_id',$users_id);
        $qry = $this->db->get('timesheet_settings');
        return $qry->result();
    }
    public function getTimeSheetDayById($timesheet_id){
        $qry = $this->db->get_where('ts_settings_day',array('ts_settings_id'=>$timesheet_id));
        return $qry->result();
    }
    public function getTimeSheetTotalInDay($week){
        for ($x = 0;$x < count($week);$x++){
            $this->db->or_where('date',$week[$x]);
        }
        $qry = $this->db->get('ts_settings_total_day');
        return $qry->result();
    }
    public function getTotalWeekDuration($week){
        for ($x = 0;$x < count($week);$x++){
            $this->db->or_where('date',$week[$x]);
        }
        $qry = $this->db->get('ts_total_week_duration');
        return $qry->result();
    }

    public function addingProjects($data){
        $week_convert = date('Y-m-d',strtotime($data['week']));
        $qry = $this->db->get_where($this->tbl_ts_settings,array('project_name' => $data['project'],'user_id' => $data['user_id']));
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'project_name' => $data['project'],
                'location' => $data['location'],
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
        $query = $this->db->get_where('ts_settings_day',array('ts_settings_id'=>$ts_id))->result();
        foreach ($query as $durations){
            $total += $durations->duration;
        }
        $ts_settings = array('total_duration_w'=>$total);
        $this->db->where('id',$ts_id);
        $this->db->update('timesheet_settings',$ts_settings);
    }
    public function perDaySchedule($ts_id,$data){
        $qry = $this->db->get_where('ts_settings_day',array('ts_settings_id'=>$ts_id,'start_date' => $data['start_date']));
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'ts_settings_id' => $ts_id,
                'start_date' => $data['start_date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'day' => $data['day'],
                'duration' => intval($data['duration'])
            );
            $this->db->insert('ts_settings_day',$insert);
            $this->recalculateWeekDuration($ts_id);
        }else{
            $update = array(
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'duration' => $data['duration']
            );
            $array_check = array('ts_settings_id' => $ts_id,'start_date' => $data['start_date']);
            $this->db->where($array_check);
            $this->db->update('ts_settings_day',$update);
            $this->recalculateWeekDuration($ts_id);

        }
        $this->totalDurationPerDay($data);
        $this->totalWeekDuration($data);
        return true;
    }

    public function totalDurationPerDay($data){
//        $this->db->where('user_id', $data['user_id']);
//        $this->db->where('day',$data['day']);
//        if (!empty($data['day_id'])){
//            $this->db->or_where('id',$data['day_id']);
//        }
        $qry = $this->db->get_where('ts_settings_total_day',array('user_id'=>$data['user_id'],'date'=>$data['start_date']));
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'day' => $data['day'],
                'total_duration' => intval($data['duration']),
                'date' => $data['start_date']
            );
            $this->db->insert('ts_settings_total_day',$insert);
        }else{
            $day_duration = $this->db->get_where('ts_settings_day',array('user_id'=>$data['user_id'],'start_date'=>$data['start_date']))->result();
            $recalculate = 0;
                foreach ($day_duration as $duration){
                    $recalculate += $duration->duration;
                }
            $update = array('total_duration'=>$recalculate);
            $array_check = array('user_id'=>$data['user_id'],'date'=>$data['start_date']);
            $this->db->where($array_check);
            $this->db->update('ts_settings_total_day',$update);
        }

    }
    public function totalWeekDuration($data){
//        if (!empty($data['twd_id'])){
//            $this->db->where('id',$data['twd_id']);
//        }else{
//
//        }
//        if (!empty($data['week'])){
            $week_convert = date('Y-m-d',strtotime($data['week']));
//            $date_week_check = array(
//                0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
//                1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
//                2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
//                3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
//                4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
//                5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
//                6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
//            );
//            for ($x = 0;$x < count($date_week_check);$x++){
//                $this->db->or_where('date',$date_week_check[$x]);
//            }
//        }
        $this->db->where('date',date("Y-m-d",strtotime('monday this week',strtotime($week_convert))));
        $this->db->where('user_id',$data['user_id']);
        $qry = $this->db->get('ts_total_week_duration');
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'total_duration' => intval($data['duration']),
                'date' => date("Y-m-d",strtotime('monday this week',strtotime($week_convert)))
            );
            $this->db->insert('ts_total_week_duration',$insert);
        }else{
            $week_convert = date('Y-m-d',strtotime($data['week']));
            $this->db->where('user_id',$data['user_id']);
            $this->db->where('date_created',date("Y-m-d",strtotime('monday this week',strtotime($week_convert))));
//            $date_week_check = array(
//                0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
//                1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
//                2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
//                3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
//                4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
//                5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
//                6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
//            );
//            for ($x = 0;$x < count($date_week_check);$x++){
//                $this->db->or_where('date_created',$date_week_check[$x]);
//            }
            $qry = $this->db->get('timesheet_settings')->result();
            $total = 0;
            foreach ($qry as $durations){
                $total += $durations->total_duration_w;
            }
            $update = array('total_duration'=>$total);
            $this->db->where('user_id',$data['user_id']);
            $week_convert = date('Y-m-d',strtotime($data['week']));
            $this->db->where('date',date("Y-m-d",strtotime('monday this week',strtotime($week_convert))));
//            $date_week_check = array(
//                0 => date("Y-m-d",strtotime('monday this week',strtotime($week_convert))),
//                1 => date("Y-m-d",strtotime('tuesday this week',strtotime($week_convert))),
//                2 => date("Y-m-d",strtotime('wednesday this week',strtotime($week_convert))),
//                3 => date("Y-m-d",strtotime('thursday this week',strtotime($week_convert))),
//                4 => date("Y-m-d",strtotime('friday this week',strtotime($week_convert))),
//                5 => date("Y-m-d",strtotime('saturday this week',strtotime($week_convert))),
//                6 => date("Y-m-d",strtotime('sunday this week',strtotime($week_convert))),
//            );
//            for ($x = 0;$x < count($date_week_check);$x++){
//                $this->db->or_where('date',$date_week_check[$x]);
//            }
            $this->db->update('ts_total_week_duration',$update);
        }
        return true;
    }

    public function updateTSProject($id,$update){
        $qry = $this->db->get_where('timesheet_settings',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $this->db->where('id',$id);
            $this->db->update('timesheet_settings',$update);
            return true;
        }else{
            return false;
        }
    }

    public function updateDuration($data){
        $qry = $this->db->get_where('ts_settings_day',array('id'=>$data['day_id']));

    }

    public function updateTotalWeekDuration($update){
        $qry = $this->db->get_where('timesheet_settings',array('id'=>$update['project_id']));
        if ($qry->num_rows() == 1){
            $data = array(
              'total_duration_w' => $update['total']
            );
            $this->db->where('id',$update['project_id']);
            $this->db->update('timesheet_settings',$data);
            return true;
        }else{
            return false;
        }
    }

    public function addingTotalInDay($update,$id){
        $qry = $this->db->get_where('ts_settings_total_day',array('id'=> $id));
        if ($qry->num_rows() == 0){
            $this->db->insert('ts_settings_total_day',$update);
        }else{
            $this->db->where('id',$id);
            $this->db->update('ts_settings_total_day',$update);
        }
    }

    public function updateTotalDuration($update,$week,$twd_id,$user_id){
//        $date_week_check = array(
//            0 => date("Y-m-d",strtotime('monday '.$week)),
//            1 => date("Y-m-d",strtotime('tuesday '.$week)),
//            2 => date("Y-m-d",strtotime('wednesday '.$week)),
//            3 => date("Y-m-d",strtotime('thursday '.$week)),
//            4 => date("Y-m-d",strtotime('friday '.$week)),
//            5 => date("Y-m-d",strtotime('saturday '.$week)),
//            6 => date("Y-m-d",strtotime('sunday '.$week)),
//        );
//        for ($x = 0;$x < count($date_week_check);$x++){
//            $this->db->or_where('date',$date_week_check[$x]);
//        }
//        $this->db->where('users_id',$user_id);
        $this->db->where('id',$twd_id);
        $query = $this->db->get('ts_total_week_duration');
        if ($query->num_rows() == 0){
            $data = array(
                'users_id' => $user_id,
                'date' => $update['date'],
                'total_duration' => $update['total_duration']
            );
            $this->db->insert('ts_total_week_duration',$data);
        }else{
            $this->db->where('id',$twd_id);
            $this->db->update('ts_total_week_duration',$update);
        }
    }
    


}



/* End of file Timesheet_model.php */

/* Location: ./application/models/Timesheet_model.php */