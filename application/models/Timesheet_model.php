<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Timesheet_model extends MY_Model {



    public $table = 'time_record';

    /**
     * @return mixed
     */
    public function clockIn($data)
    {
        $this->db->insert($this->table, $data);
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

    public function getTimeSheetSettings(){
        $qry = $this->db->get('timesheet_settings');
        return $qry->result();
    }
    public function getTimeSheetDay(){
        $qry = $this->db->get('ts_settings_day');
        return $qry->result();
    }
    public function getTimeSheetDayByWeek($week){
        for ($x = 0;$x < count($week);$x++){
            $this->db->or_where('date_created',$week[$x]);
        }
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

    public function addingProjects($project){
        $qry = $this->db->get_where('timesheet_settings',array('projects' => $project));
        if ($qry->num_rows() == 0){
            $data = array(
                'projects' => $project,
                'date_created' => date('Y-m-d h:i:s'),
                'status' => 1
            );
            $this->db->insert('timesheet_settings',$data);
            return true;
        }else{
            return false;
        }
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
        if ($qry->num_rows() == 1){
            $update = array(
                'duration' => $data['duration'],
            );
            $this->db->where('id',$data['day_id']);
            $this->db->update('ts_settings_day',$update);
        }else{
            $new = array(
                'ts_settings_id' => $data['project_id'],
                'day' => $data['day'],
                'duration' => $data['duration'],
                'date' => $data['date']
            );
            $this->db->insert('ts_settings_day',$new);
        }
        return true;
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
        $qry = $this->db->get_where('ts_settings_total_day',array('date'=> $update['date']));
        if ($qry->num_rows() == 0){
            $this->db->insert('ts_settings_total_day',$update);
        }else{
            $this->db->where('id',$id);
            $this->db->update('ts_settings_total_day',$update);
        }
    }

    public function updateTotalDuration($update,$week){
        $date_week_check = array(
            0 => date("Y-m-d",strtotime('monday '.$week)),
            1 => date("Y-m-d",strtotime('tuesday '.$week)),
            2 => date("Y-m-d",strtotime('wednesday '.$week)),
            3 => date("Y-m-d",strtotime('thursday '.$week)),
            4 => date("Y-m-d",strtotime('friday '.$week)),
            5 => date("Y-m-d",strtotime('saturday '.$week)),
            6 => date("Y-m-d",strtotime('sunday '.$week)),
        );
        for ($x = 0;$x < count($date_week_check);$x++){
            $this->db->or_where('date',$date_week_check[$x]);
        }
        $query = $this->db->get('ts_total_week_duration');
        if ($query->num_rows() == 0){
            $this->db->insert('ts_total_week_duration',$update);
        }else{
            for ($x = 0;$x < count($date_week_check);$x++){
                $this->db->or_where('date',$date_week_check[$x]);
            }
            $this->db->update('ts_total_week_duration',$update);
        }
    }
    


}



/* End of file Timesheet_model.php */

/* Location: ./application/models/Timesheet_model.php */