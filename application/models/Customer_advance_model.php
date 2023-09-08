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
        if($tablename == 'acs_office'){
            $input['time_entered'] = date("m/d/Y");
            if(array_key_exists('entered_by', $input)){
                if($input['entered_by'] == null){
                    $input['entered_by'] = getLoggedFullName(logged('id'));
                }
            }else{
                $input['entered_by'] = getLoggedFullName(logged('id'));
            }
        }
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

    public function getLeadSourceData()
    {
        $this->db->select('ls_name');
        $this->db->distinct('ls_name');
        $query = $this->db->get('ac_leadsource');
        return $query->result();
    }

    public function getAllSettingsSalesAreaByCompanyId($company_id)
    {
        $this->db->select('*');        
        $this->db->where('fk_comp_id', $company_id);
        $this->db->order_by('sa_id', 'DESC');
        $query = $this->db->get('ac_salesarea');
        return $query->result();
    }

    public function getAllSettingsLeadSourceByCompanyId($company_id)
    {
        $this->db->select('*');        
        $this->db->where('fk_company_id', $company_id);
        $this->db->order_by('ls_id', 'DESC');
        $query = $this->db->get('ac_leadsource');
        return $query->result();
    }

    public function getAllSettingsLeadTypesByCompanyId($company_id)
    {
        $this->db->select('*');        
        $this->db->where('company_id', $company_id);
        $this->db->order_by('lead_id', 'DESC');
        $query = $this->db->get('ac_leadtypes');
        return $query->result();
    }

    public function getAllSettingsRatePlansByCompanyId($company_id)
    {
        $this->db->select('*');        
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('ac_rateplan');
        return $query->result();
    }

    public function getAllSettingsActivationFeeByCompanyId($company_id)
    {
        $this->db->select('*');        
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('ac_activationfee');
        return $query->result();
    }

    public function get_data_by_id($fieldname,$fieldvalue,$tablename)
    {
        $this->db->select('*');
        $this->db->where($fieldname, $fieldvalue);
        $query = $this->db->get($tablename);
        return $query->row();
    }

    public function getTotalCommission($customer_id) {
        $this->db->select('SUM(commission) as totalCommission');
        $this->db->where('customer_id', $customer_id);
        $this->db->from("jobs");
        $query = $this->db->get();
        return $query->result()[0];
    }

    public function get_select_options($table=null, $key=null){
        if($table != null){
            $this->db->from($table);
        }
        if($key != null){
            $this->db->select('DISTINCT('.$key.')');
        }else{
            $this->db->select('*');
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function get_customer_item_details($id){
        $this->db->select('items.title,job_items.qty,items.type, jobs.job_number');
        $this->db->from("job_items");
        $this->db->join('jobs', 'jobs.id = job_items.job_id','left');
        $this->db->join('items', 'job_items.items_id = items.id','left');
        $this->db->where("jobs.customer_id", $id);
        $this->db->order_by('jobs.id', "DESC");
        // $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
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

    public function getByLeadId($lead_id)
    {
        $this->db->from("ac_leads");
        $this->db->select('ac_leads.*,users.FName,users.LName, business_profile.business_name, ac_leadtypes.lead_name AS lead_type');
        $this->db->join('users', 'users.id = ac_leads.fk_assign_id','left');
        $this->db->join('business_profile', 'business_profile.company_id = ac_leads.company_id','left');
        $this->db->join('ac_leadtypes', 'ac_leads.fk_lead_id = ac_leadtypes.lead_id','left');
        $this->db->where('ac_leads.leads_id', $lead_id);
        $query = $this->db->get($tablename);
        return $query->row();
    }

    public function get_all_leads_data($filters=array(), $search=array()){
        $this->db->from("ac_leads");
        $this->db->select('ac_leads.*,users.FName,users.LName, business_profile.business_name');
        $this->db->join('users', 'users.id = ac_leads.fk_assign_id','left');
        $this->db->join('business_profile', 'business_profile.company_id = ac_leads.company_id','left');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {                            
                $this->db->like('ac_leads.firstname', $filters['search'], 'both');
                $this->db->or_like('ac_leads.lastname', $filters['search'], 'both');
                $this->db->or_like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        if( !empty($search) ){
            $this->db->where($search['field'], $search['value']);
        }

        $this->db->order_by('ac_leads.leads_id', "DESC");
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

    public function getExportData()
    {
        $cid = logged('company_id');
        $this->db->from("acs_profile");
        $this->db->select('*');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');
        $this->db->order_by('prof_id', "DESC");
        $this->db->where("acs_profile.company_id", $cid);
        $this->db->group_by('acs_profile.prof_id'); 
        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomerLists($param = null, $start = 0, $length = 0, $record = 0)
    {
        $cid = logged('company_id');        
        $this->db->from("acs_profile");
        if($record != 0){
            $this->db->select('COUNT(acs_profile.prof_id) as count');
            $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
            $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
            $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
            $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');        
            $this->db->join('industry_type', 'acs_profile.industry_type_id = industry_type.id','left');
            if( $length > 0 ){            
                $this->db->limit($length, $start);    
            }
    
            $this->db->where("acs_profile.company_id", $cid);
            if( $param['search'] != '' ){
                $this->db->group_start();
                    $this->db->or_like('acs_profile.last_name', $param['search'], 'both');    
                    $this->db->or_like('acs_profile.first_name', $param['search'], 'both');    
                    $this->db->or_like('acs_profile.email', $param['search'], 'both'); 
                    $this->db->or_like('acs_profile.business_name', $param['search'], 'both'); 
                $this->db->group_end();   
            }  
            $query = $this->db->get();
            return $query->row()->count;

            // Outputs, 2
        }
        if($cid == 58){
            // $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
            // acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
            // acs_profile.business_name,acs_office.technician,acs_b.transaction_amount as total_amount,industry_type.name AS industry_type, acs_profile.industry_type_id,
            // acs_office.fk_sales_rep_office,acs_info_solar.proposed_solar,acs_info_solar.proposed_payment,acs_profile.company_id,acs_profile.adt_sales_project_id');
            $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
            acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
            acs_profile.business_name,acs_office.technician,acs_b.transaction_amount as total_amount,industry_type.name AS industry_type, acs_profile.industry_type_id,
            acs_office.fk_sales_rep_office,acs_info_solar.proposed_solar,acs_info_solar.proposed_payment,acs_profile.company_id');
            $this->db->join('acs_info_solar', 'acs_info_solar.fk_prof_id = acs_profile.prof_id','left');
        }else{
            // $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
            // acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
            // acs_profile.business_name,acs_office.technician,acs_b.transaction_amount as total_amount,industry_type.name AS industry_type, acs_profile.industry_type_id,acs_office.fk_sales_rep_office,acs_profile.company_id,acs_profile.adt_sales_project_id');
            $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
            acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
            acs_profile.business_name,acs_office.technician,acs_b.transaction_amount as total_amount,industry_type.name AS industry_type, acs_profile.industry_type_id,acs_office.fk_sales_rep_office,acs_profile.company_id');
        }

        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');        
        $this->db->join('industry_type', 'acs_profile.industry_type_id = industry_type.id','left');

        if( $length > 0 ){            
            $this->db->limit($length, $start);    
        }

        $this->db->where("acs_profile.company_id", $cid);
        if( $param['search'] != '' ){
            $this->db->group_start();
                $this->db->or_like('acs_profile.last_name', $param['search'], 'both');    
                $this->db->or_like('acs_profile.first_name', $param['search'], 'both');    
                $this->db->or_like('acs_profile.email', $param['search'], 'both'); 
                $this->db->or_like('acs_profile.business_name', $param['search'], 'both'); 
            $this->db->group_end();   
        }                
        $this->db->group_by('acs_profile.prof_id'); 
        $this->db->order_by('acs_profile.first_name', 'ASC');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_customer_data($search=null){
        $cid = logged('company_id');
        $this->db->from("acs_profile");
        //$this->db->where("fk_user_id", $user_id);

        if($cid == 58){
            $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
            acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
            acs_profile.business_name,acs_office.technician,acs_b.transaction_amount as total_amount,industry_type.name AS industry_type, acs_profile.industry_type_id,
            acs_office.fk_sales_rep_office,acs_info_solar.proposed_solar,acs_info_solar.proposed_payment');
        }else{
            $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
            acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
            acs_profile.business_name,acs_office.technician,acs_b.transaction_amount as total_amount,industry_type.name AS industry_type, acs_profile.industry_type_id,acs_office.fk_sales_rep_office');
        }
        
        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_subscriptions as acs_s', 'acs_s.customer_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','right');
        $this->db->join('acs_office as ao', 'ao.fk_prof_id = users.id','right');
        $this->db->join('industry_type', 'acs_profile.industry_type_id = industry_type.id','left');

        if($cid == 58){
            $this->db->join('acs_info_solar', 'acs_info_solar.fk_prof_id = acs_profile.prof_id','left');
        }
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
            //$this->db->limit(10);
        }
//$this->db->order_by('prof_id', "DESC");
        $this->db->limit($search['length'], $search['start']);
        $this->db->where("acs_profile.company_id", $cid);
        //$this->db->limit(20);
        $query = $this->db->get();
        return $query->result();
    }

    public function admin_get_customer_data($search=null){
        $this->db->from("acs_profile");
        //$this->db->where("fk_user_id", $user_id);
        $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m,acs_profile.status,acs_b.mmr,
        acs_alarm.system_type,acs_office.entered_by,acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
        acs_profile.business_name,acs_office.technician,acs_b.transaction_amount as total_amount,industry_type.name AS industry_type, acs_profile.industry_type_id, business_profile.business_name');
        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');
        $this->db->join('business_profile', 'business_profile.company_id = acs_profile.company_id','left');
        $this->db->join('acs_billing as acs_b', 'acs_b.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_subscriptions as acs_s', 'acs_s.customer_id = acs_profile.prof_id','left');
        $this->db->join('acs_alarm', 'acs_alarm.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office', 'acs_office.fk_prof_id = acs_profile.prof_id','left');
        $this->db->join('acs_office as ao', 'ao.fk_prof_id = users.id','left');
        $this->db->join('industry_type', 'acs_profile.industry_type_id = industry_type.id','left');

        if(!empty($search)){
            $this->db->like('acs_profile.first_name', $search['value'], 'both');
            $this->db->or_like('acs_profile.last_name', $search['value'], 'both');
            $this->db->or_like('acs_profile.email', $search['value'], 'both');
            $this->db->or_like('business_profile.business_name', $search['value'], 'both');
        }
        
        $this->db->order_by('prof_id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_company_customer_data($company_id, $search=null){
        $this->db->from("acs_profile");
        //$this->db->where("fk_user_id", $user_id);
        $this->db->select('users.id,acs_profile.prof_id,acs_profile.first_name,acs_profile.last_name,acs_profile.email,acs_profile.phone_m, acs_profile.industry_type_id');
        $this->db->join('users', 'users.id = acs_profile.fk_user_id','left');        

        if(!empty($search)){
            $this->db->group_start();
            $this->db->like('acs_profile.first_name', $search['value'], 'both');
            $this->db->or_like('acs_profile.last_name', $search['value'], 'both');
            $this->db->or_like('acs_profile.email', $search['value'], 'both');
            $this->db->or_like('acs_profile.phone_m', $search['value'], 'both');
            $this->db->group_end();
        }

        $this->db->where('acs_profile.company_id', $company_id);
        $this->db->order_by('prof_id', "DESC");
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

    public function get_all($limit = FALSE, $start = 0, $sort = 'ASC',$tablename,$orderBy,$search=array())
    {
        if( !empty($search) ){
            $this->db->like($search['field'], $search['value'], 'both');
        }

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
        $this->db->select('acs_billing.bill_id, acs_billing.fk_prof_id, acs_billing.is_with_error, acs_billing.error_type, acs_profile.company_id, acs_profile.prof_id, acs_billing.error_message, acs_billing.error_date, acs_profile.first_name, acs_profile.last_name');
        $this->db->from("acs_billing");
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
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

    public function get_all_subscription_by_company_id($company_id=0){        
        $this->db->select('acs_billing.*, acs_profile.first_name, acs_profile.last_name, acs_profile.company_id');
        $this->db->from("acs_billing");   
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id','left');     
        $this->db->where('acs_profile.company_id', $company_id);       
        $query = $this->db->get(); 
        return $query->result();
    }

    public function get_all_active_subscription_by_company_id($company_id=0){   
        $today = date("m/d/Y");     
        $this->db->select('acs_billing.*, acs_profile.first_name, acs_profile.last_name, acs_profile.company_id');
        $this->db->from("acs_billing");   
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id','left');     
        $this->db->where('acs_profile.company_id', $company_id);       
        $this->db->where('acs_billing.recurring_end_date >=', $today);       
        $query = $this->db->get(); 
        return $query->result();
    }

    public function get_all_completed_subscription_by_company_id($company_id=0){   
        $today = date("m/d/Y");     
        $this->db->select('acs_billing.*, acs_profile.first_name, acs_profile.last_name, acs_profile.company_id');
        $this->db->from("acs_billing");   
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id','left');     
        $this->db->where('acs_profile.company_id', $company_id);       
        $this->db->where('acs_billing.recurring_end_date <=', $today);       
        $query = $this->db->get(); 
        return $query->result();
    }

    public function get_all_billing_errors_by_company_id($company_id=0){   
        $today = date("m/d/Y");     
        $this->db->select('acs_billing.*, acs_profile.first_name, acs_profile.last_name, acs_profile.company_id');
        $this->db->from("acs_billing");   
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id','left');     
        $this->db->where('acs_profile.company_id', $company_id);       
        $this->db->where('acs_billing.is_with_error', 1);       
        $query = $this->db->get(); 
        return $query->result();
    }

    public function get_all_subscription_payments($customer_id=0){   
        $today = date("m/d/Y");     
        $this->db->select('acs_transaction_history.*, acs_profile.first_name, acs_profile.last_name, acs_profile.company_id');
        $this->db->from("acs_transaction_history");   
        $this->db->join('acs_profile', 'acs_transaction_history.customer_id = acs_profile.prof_id','left');     
        $this->db->where('acs_transaction_history.customer_id', $customer_id);  
        $query = $this->db->get(); 
        return $query->result();
    }

    public function get_row_count(){
        $this->db->select('*');
        $this->db->from('acs_profile');
        $query = $this->db->count_all_results();
        //$query = $this->db->get($this->table);
        return $query;
    }

    public function getCustomerActivityLogs($customer_id){
        $this->db->select('*');
        $this->db->from("customer_activity_logs");       
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id DESC');
        $query = $this->db->get(); 
        return $query->result();
    }

    public function getJobSalesTechCommission($customer_id) {
        $this->db->select('commission AS salesrep_commission, tech_commission_total AS techrep_commission');
        $this->db->from("jobs");       
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id DESC');
        $this->db->limit(1);
        $query = $this->db->get(); 
        return $query->result();
    }

    public function getJobSalesTechPaid($customer_id) {
        $this->db->select('employee_id, employee2_id, employee3_id, employee4_id, employee5_id, employee6_id, commission AS salesrep_commission, tech_commission_total as techrep_commission');
        $this->db->from("jobs");       
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id DESC');
        $this->db->limit(1);
        $query = $this->db->get(); 
        $jobResult = $query->result()[0];  
        // ============
        $totalSalesRepPaid = 0;
        $totalTechRepPaid = 0;

        $this->db->select('payscale.payscale_name AS payscale, users.base_hourly AS base_hourly, users.base_weekly AS base_weekly, users.base_monthly AS base_monthly');
        $this->db->from("users");
        $this->db->join('payscale', 'payscale.id = users.payscale_id', 'left');
        $this->db->where('users.id', $jobResult->employee_id);
        $query = $this->db->get(); 
        $userResult_1 = $query->result()[0];
        if ($userResult_1->payscale == "Base (Hourly Rate)") { $totalSalesRepPaid += $userResult_1->base_hourly; }
        if ($userResult_1->payscale == "Base (Weekly Rate)") { $totalSalesRepPaid += $userResult_1->base_weekly; }
        if ($userResult_1->payscale == "Base (Montly Rate)") { $totalSalesRepPaid += $userResult_1->base_monthly; }
        // =================
        $this->db->select('payscale.payscale_name AS payscale, users.base_hourly AS base_hourly, users.base_weekly AS base_weekly, users.base_monthly AS base_monthly');
        $this->db->from("users");
        $this->db->join('payscale', 'payscale.id = users.payscale_id', 'left');
        $this->db->where('users.id', $jobResult->employee2_id);
        $query = $this->db->get(); 
        $userResult_2 = $query->result()[0];
        if ($userResult_2->payscale == "Base (Hourly Rate)") { $totalTechRepPaid += $userResult_2->base_hourly; }
        if ($userResult_2->payscale == "Base (Weekly Rate)") { $totalTechRepPaid += $userResult_2->base_weekly; }
        if ($userResult_2->payscale == "Base (Montly Rate)") { $totalTechRepPaid += $userResult_2->base_monthly; }
        // =================
        $this->db->select('payscale.payscale_name AS payscale, users.base_hourly AS base_hourly, users.base_weekly AS base_weekly, users.base_monthly AS base_monthly');
        $this->db->from("users");
        $this->db->join('payscale', 'payscale.id = users.payscale_id', 'left');
        $this->db->where('users.id', $jobResult->employee3_id);
        $query = $this->db->get(); 
        $userResult_3 = $query->result()[0];
        if ($userResult_3->payscale == "Base (Hourly Rate)") { $totalTechRepPaid += $userResult_3->base_hourly; }
        if ($userResult_3->payscale == "Base (Weekly Rate)") { $totalTechRepPaid += $userResult_3->base_weekly; }
        if ($userResult_3->payscale == "Base (Montly Rate)") { $totalTechRepPaid += $userResult_3->base_monthly; }
        // =================
        $this->db->select('payscale.payscale_name AS payscale, users.base_hourly AS base_hourly, users.base_weekly AS base_weekly, users.base_monthly AS base_monthly');
        $this->db->from("users");
        $this->db->join('payscale', 'payscale.id = users.payscale_id', 'left');
        $this->db->where('users.id', $jobResult->employee4_id);
        $query = $this->db->get(); 
        $userResult_4 = $query->result()[0];
        if ($userResult_4->payscale == "Base (Hourly Rate)") { $totalTechRepPaid += $userResult_4->base_hourly; }
        if ($userResult_4->payscale == "Base (Weekly Rate)") { $totalTechRepPaid += $userResult_4->base_weekly; }
        if ($userResult_4->payscale == "Base (Montly Rate)") { $totalTechRepPaid += $userResult_4->base_monthly; }
        // =================
        $this->db->select('payscale.payscale_name AS payscale, users.base_hourly AS base_hourly, users.base_weekly AS base_weekly, users.base_monthly AS base_monthly');
        $this->db->from("users");
        $this->db->join('payscale', 'payscale.id = users.payscale_id', 'left');
        $this->db->where('users.id', $jobResult->employee5_id);
        $query = $this->db->get(); 
        $userResult_5 = $query->result()[0];
        if ($userResult_5->payscale == "Base (Hourly Rate)") { $totalTechRepPaid += $userResult_5->base_hourly; }
        if ($userResult_5->payscale == "Base (Weekly Rate)") { $totalTechRepPaid += $userResult_5->base_weekly; }
        if ($userResult_5->payscale == "Base (Montly Rate)") { $totalTechRepPaid += $userResult_5->base_monthly; }
        // =================
        $this->db->select('payscale.payscale_name AS payscale, users.base_hourly AS base_hourly, users.base_weekly AS base_weekly, users.base_monthly AS base_monthly');
        $this->db->from("users");
        $this->db->join('payscale', 'payscale.id = users.payscale_id', 'left');
        $this->db->where('users.id', $jobResult->employee6_id);
        $query = $this->db->get(); 
        $userResult_6 = $query->result()[0];
        if ($userResult_6->payscale == "Base (Hourly Rate)") { $totalTechRepPaid += $userResult_6->base_hourly; }
        if ($userResult_6->payscale == "Base (Weekly Rate)") { $totalTechRepPaid += $userResult_6->base_weekly; }
        if ($userResult_6->payscale == "Base (Montly Rate)") { $totalTechRepPaid += $userResult_6->base_monthly; }
        // =================
        $returnData = new stdClass();
        $returnData->salesrep_paid = $totalSalesRepPaid + $jobResult->salesrep_commission;
        $returnData->techrep_paid = $totalTechRepPaid + $jobResult->techrep_commission;
        return $returnData;    
    }
}