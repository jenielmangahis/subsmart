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
        } else {
            return false;
        }
    }

    public function update_data($input,$tablename,$update_id)
    {
        if($update_id == "lead_id"){
            $id = $input['lead_id'];
            unset($input['lead_id']);
        }else if($update_id == "sa_id"){
            $id = $input['sa_id'];
            unset($input['sa_id']);
        }else if($update_id == "ams_id"){
            $id = $input['ams_id'];
            unset($input['ams_id']);
        }

        if ($this->db->update($tablename, $input, array($update_id => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function if_exist($fieldname,$fieldvalue,$tablename,$data=FALSE){
        $this->db->where($fieldname, $fieldvalue);
        if($query = $this->db->get($tablename)){
            if($data){
                return $query->row();
            }else{
                return true;
            }
        }else{
            return false;
        }
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