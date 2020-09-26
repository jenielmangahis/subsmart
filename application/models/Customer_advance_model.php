<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Customer_advance_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
    public function add($input,$tablename)
    {
        if ($this->db->insert($tablename, $input)) {
            return $this->db->insert_id();
            //return true;
        } else {
            return false;
        }
    }

    public function update_data($input,$tablename,$update_id)
    {
        $id = $input[$update_id];
        unset($input[$update_id]);
        if ($this->db->update($tablename, $input, array($update_id => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function if_exist($fieldname,$fieldvalue,$tablename){
        $this->db->where($fieldname, $fieldvalue);
        $query = $this->db->count_all_results($tablename);
        if($query > 0){
            return true;
        }else{
            return false;
        }
    }

    public function get_data_by_id($fieldname,$fieldvalue,$tablename)
    {
        $this->db->where($fieldname, $fieldvalue);
        $query = $this->db->get($tablename);
        return $query->row();
    }

    public function get_leads_data(){
        $this->db->from("ac_leads");
        $this->db->select('ac_leads.*,users.FName,users.LName');
        $this->db->join('users', 'users.id = ac_leads.fk_assign_id','left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_customer_data($user_id){
        $this->db->from("acs_profile");
        //$this->db->where("fk_user_id", $user_id);
        $this->db->select('acs_profile.*,acs_b.mmr,acs_alarm.system_type,users.FName,users.LName,acs_office.*');
        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_all($limit = FALSE, $start = 0, $sort = 'ASC',$tablename,$orderBy)
    {
        if(!empty($orderBy) || $orderBy!= null){
            $this->db->order_by($orderBy, $sort);
        }
        if ($query = $this->db->get($tablename, $limit, $start)) {
            return $query->result();
        } else {
             return false;
        }

    }

    public function delete($input)
    {
        $this->db->where($input['field_name'], $input['id']);
        if ($this->db->delete($input['tablename'])) {
            return true;
        } else {
            return false;
        }
    }
}