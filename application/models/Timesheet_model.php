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

}



/* End of file Timesheet_model.php */

/* Location: ./application/models/Timesheet_model.php */