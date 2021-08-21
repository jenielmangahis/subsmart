<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Customer_advance_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function getModulesList()
    {
        return $this->db->get('ac_modules')->result();
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
        $this->db->select('*');
        $this->db->where($fieldname, $fieldvalue);
        $query = $this->db->get($tablename);
        return $query->row();
    }

    public function get_leads_data(){
        $cid=logged('company_id');
        $this->db->from("ac_leads");
        $this->db->select('ac_leads.*,users.FName,users.LName');
        $this->db->join('users', 'users.id = ac_leads.fk_assign_id','left');
        $this->db->order_by('id', "DESC");
        $this->db->where("ac_leads.company_id", $cid);
        $query = $this->db->get();
        return $query->result();
    }
    public function check_customer($search){
        $this->db->from("acs_profile");
        $this->db->select('prof_id');
        $this->db->where('first_name', $search['first_name']);
        $this->db->where('last_name', $search['last_name']);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_customer_data_settings($id){
        $cid=logged('company_id');
        $this->db->from("acs_profile");
        //$this->db->where("fk_user_id", $user_id);
        $this->db->select('acs_profile.*,acs_b.*,acs_alarm.*,acs_office.*,acs_profile.city,acs_profile.state,users.LName,users.FName');
        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office as ao', 'ao.fk_prof_id = users.id','left');
        $this->db->where("acs_profile.prof_id", $id);
        //$this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_customer_data($search=null){
        $cid=logged('company_id');
        $this->db->from("acs_profile");
        //$this->db->where("fk_user_id", $user_id);
        $this->db->select('acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
        acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_s.total_amount');
        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_subscriptions as acs_s', 'acs_s.customer_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office as ao', 'ao.fk_prof_id = users.id','left');

        if(!empty($search)){
            if($search['monitoring_id'] != ""){
                $this->db->where('acs_alarm.monitor_id LIKE', '%' . $search['monitoring_id'] . '%');
            }
            if($search['firstname'] != ""){
                $this->db->where('acs_profile.first_name LIKE', '%' . $search['firstname'] . '%');
            }
            if($search['lastname'] != ""){
                $this->db->where('acs_profile.last_name LIKE', '%' . $search['lastname'] . '%');
            }
            if($search['email'] !=  ""){
                $this->db->where('acs_profile.email LIKE', '%' . $search['email'] . '%');
            }
            if($search['phone'] != ""){
                $this->db->or_where('acs_profile.phone_h LIKE', '%' . $search['phone'] . '%');
            }
            if($search['sales_date'] != ""){
                $this->db->where('acs_office.sales_date LIKE', '%' . $search['sales_date'] . '%');
            }
            if($search['company_name'] != ""){
                $this->db->where('acs_alarm.monitor_comp LIKE', '%' . $search['company_name'] . '%');
            }
            if($search['panel_type'] != ""){
                $this->db->where('acs_alarm.panel_type LIKE', '%' . $search['panel_type'] . '%');
            }
            if($search['acct_type'] != ""){
                $this->db->where('acs_alarm.acct_type LIKE', '%' . $search['acct_type'] . '%');
            }
            if($search['status'] != ""){
                $this->db->where('acs_profile.status LIKE', '%' . $search['status'] . '%');
            }
            if($search['address'] != ""){
                $this->db->where('acs_profile.mail_add LIKE', '%' . $search['address'] . '%');
            }
            if($search['city'] != ""){
                $this->db->or_where('acs_profile.city LIKE', '%' . $search['city'] . '%');
            }
            if($search['state'] != ""){
                $this->db->where('acs_profile.state LIKE', '%' . $search['state'] . '%');
            }
            if($search['zip'] != ""){
                $this->db->where('acs_profile.zip_code LIKE', '%' . $search['zip'] . '%');
            }
            if($search['routing_number'] != ""){
                $this->db->where('acs_b.routing_num LIKE', '%' . $search['routing_number'] . '%');
            }
            if($search['company'] != ""){
                $this->db->where('acs_alarm.monitor_comp LIKE', '%' . $search['company'] . '%');
            }
            if($search['monitor_company'] != ""){
                $this->db->where('acs_alarm.monitor_comp LIKE', '%' . $search['monitor_company'] . '%');
            }
            if($search['credit_score'] != ""){
                $this->db->where('acs_office.credit_score LIKE', '%' . $search['credit_score'] . '%');
            }
            if($search['contract_term'] != ""){
                $this->db->where('acs_b.contract_term LIKE', '%' . $search['contract_term'] . '%');
            }
        }else{
            $this->db->limit(10);
            $this->db->order_by('prof_id', "DESC");
        }
        $this->db->where("acs_profile.company_id", $cid);
        //$this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_customer_details($id=null){
        $this->db->from("acs_profile");
        $this->db->select('acs_profile.city,acs_profile.state,users.LName,users.FName');
        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office as ao', 'ao.fk_prof_id = users.id','left');
        $this->db->where("acs_profile.prof_id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_all_by_id($fieldname,$fieldvalue,$tablename){
        $this->db->from($tablename);
        $this->db->where($fieldname, $fieldvalue);
        if($query = $this->db->get()){
            return $query->result();
        }else{
            return false;
        }
    }

    public function check_if_user_exist($params = array(),$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }
        return $result;
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

    public function get_customer_billing_errors($company_id)
    {        
        $this->db->select('acs_billing.bill_id, acs_billing.fk_prof_id, acs_billing.is_with_error, acs_billing.error_type, acs_profile.company_id, acs_profile.prof_id, acs_billing.error_message, acs_billing.error_date');
        $this->db->from("acs_billing");
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id','left');
        $this->db->where("acs_billing.is_with_error", 1);
        $this->db->where("acs_profile.company_id", $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_billing_error($billing_id=0){        
        $this->db->select('*');
        $this->db->from("acs_billing");        
        $this->db->where("bill_id", $billing_id);
        $this->db->where("is_with_error", 1);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_company_billing_error($company_id = 0, $billing_id = 0){        
        $this->db->select('*');
        $this->db->from("acs_billing");        
        $this->db->where("bill_id", $billing_id);
        $this->db->where("is_with_error", 1);
        $query = $this->db->get();
        return $query->row();
    }
}