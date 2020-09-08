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
    public function attendance($user_id,$status){
        $qry = $this->db->get_where($this->attn_tbl,array('user_id' => $user_id,'date' => date('Y-m-d')));
        if ($qry->num_rows() == 0 && $status == 1){
            $data = array(
                'user_id' =>  $user_id,
                'date' => date('Y-m-d'),
                'status' => $status
            );
            $this->db->insert($this->attn_tbl,$data);
        }elseif($qry->num_rows() == 1 && $status == 0){
            $update = array(
                'status' => $status
            );
            $check = array('user_id'=>$user_id,'date' => date('Y-m-d'));
            $this->db->where($check);
            $this->db->update($this->attn_tbl,$update);
        }
    }

    public function checkInEmployee($user_id){
        $this->attendance($user_id,1);
        $qry = $this->db->get_where($this->db_table,array('user_id'=>$user_id,'action'=>'Check in','date'=>date('Y-m-d')));
        if ($qry->num_rows() == 0){
            $data = array(
                'user_id' => $user_id,
                'action' => 'Check in',
                'date' => date('Y-m-d'),
                'time' => date('H:i'),
                'entry_type' => 'Normal',
                'status' => 1,
            );
            $this->db->insert($this->db_table,$data);
            return true;
        }else{
            return false;
        }
    }
    public function checkingOutEmployee($user_id){
        $this->attendance($user_id,0);
        $qry = $this->db->get_where($this->db_table,array('user_id'=> $user_id,'action'=>'Check in','date'=>date('Y-m-d')));
        if ($qry->num_rows() == 1){
            $data = array(
                'user_id' => $user_id,
                'action' => 'Check out',
                'date' => date('Y-m-d'),
                'time' => date('H:i'),
                'entry_type' => 'Normal',
                'status' => 1,
            );
            $this->db->insert($this->db_table,$data);
            return true;
        }else{
            return false;
        }
    }
    public function breakIn($user_id){
        $data = array(
            'user_id' => $user_id,
            'action' => 'Break in',
            'date' => date('Y-m-d'),
            'time' => date('H:i'),
            'entry_type' => 'Normal',
            'status' => 1
        );
        $this->db->insert($this->db_table,$data);
        return true;
    }

    public function breakOut($user_id){
        $data = array(
            'user_id' => $user_id,
            'action' => 'Break out',
            'date' => date('Y-m-d'),
            'time' => date('H:i'),
            'entry_type' => 'Normal',
            'status' => 1
        );
        $this->db->insert($this->db_table,$data);
        return true;
    }

    public function getTimesheetLogs(){
        $query = $this->db->get_where($this->db_table,array('date'=>date('Y-m-d')));
        return $query->result();
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
        $query =  $this->db->get_where('timesheet_attendance',array('date'=>date('Y-m-d')));
        $logged_in = $query->num_rows();
        return $total_users - $logged_in;
    }
    public function getInNow(){
        $query = $this->db->get_where('timesheet_attendance',array('status' => 1,'date'=>date('Y-m-d')));
        return $query->num_rows();
    }
    public function getOutNow(){
        $query = $this->db->get_where('timesheet_attendance',array('status' => 0,'date'=>date('Y-m-d')));
        return $query->num_rows();
    }

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
        $qry = $this->db->get_where($this->tbl_ts_settings,array('project_name' => $data['project'],'user_id' => $data['user_id']));
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'project_name' => $data['project'],
                'location' => $data['location'],
                'notes' => $data['notes'],
                'total_duration_w' => intval($data['duration']),
                'date_created' => date('Y-m-d'),
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
    public function recalculateDuration($ts_id){
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
                'ts_settings_id' => $ts_id,
                'start_date' => $data['start_date'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'day' => $data['day'],
                'duration' => intval($data['duration'])
            );
            $this->db->insert('ts_settings_day',$insert);
            $this->recalculateDuration($ts_id);
        }else{
            $update = array(
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'duration' => $data['duration']
            );
            $array_check = array('ts_settings_id' => $ts_id,'start_date' => $data['start_date']);
            $this->db->where($array_check);
            $this->db->update('ts_settings_day',$update);
            $this->recalculateDuration($ts_id);
        }
        $this->totalDurationPerDay($data);
        $this->totalWeekDuration($data);
        return true;
    }
    public function totalDurationPerDay($data){
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('day',$data['day']);
        if (!empty($data['day_id'])){
            $this->db->or_where('id',$data['day_id']);
        }
        $qry = $this->db->get('ts_settings_total_day');
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'day' => $data['day'],
                'total_duration' => intval($data['duration']),
                'date' => $data['start_date']
            );
            $this->db->insert('ts_settings_total_day',$insert);
        }else{
            $update = array('total_duration'=>$data['duration']);
            $this->db->where('date',$data['start_date']);
            $this->db->update('ts_settings_total_day',$update);
        }
        return true;
    }
    public function totalWeekDuration($data){
        $this->db->where('user_id',$data['user_id']);
        if (!empty($data['week'])){
            $date_week_check = array(
                0 => date("Y-m-d",strtotime('monday '.$data['week'])),
                1 => date("Y-m-d",strtotime('tuesday '.$data['week'])),
                2 => date("Y-m-d",strtotime('wednesday '.$data['week'])),
                3 => date("Y-m-d",strtotime('thursday '.$data['week'])),
                4 => date("Y-m-d",strtotime('friday '.$data['week'])),
                5 => date("Y-m-d",strtotime('saturday '.$data['week'])),
                6 => date("Y-m-d",strtotime('sunday '.$data['week'])),
            );
            for ($x = 0;$x < count($date_week_check);$x++){
                $this->db->or_where('date',$date_week_check[$x]);
            }
        }

        if (!empty($data['twd_id'])){
            $this->db->or_where('id',$data['twd_id']);
        }
        $qry = $this->db->get('ts_total_week_duration');
        if ($qry->num_rows() == 0){
            $insert = array(
                'user_id' => $data['user_id'],
                'total_duration' => intval($data['duration']),
                'date' => $data['start_date']
            );
            $this->db->insert('ts_total_week_duration',$insert);
        }else{
            for ($x = 0;$x < count($date_week_check);$x++){
                $this->db->or_where('date_created',$date_week_check[$x]);
            }
            $qry = $this->db->get('timesheet_settings')->result();
            $total = 0;
            foreach ($qry as $durations){
                $total += $durations->total_duration_w;
            }
            $update = array('total_duration'=>$total);
            $this->db->where('id',$data['twd_id']);
            $this->db->update('ts_total_week_duration',$update);
        }
        return true;
    }

    public function updateProjectName($id,$name){
        $qry = $this->db->get_where('timesheet_settings',array('id'=>$id));
        if ($qry->num_rows() == 1){
            $rename = array('projects'=>$name);
            $this->db->where('id',$id);
            $this->db->update('timesheet_settings',$rename);
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