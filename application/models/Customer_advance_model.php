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

    public function getASalesAreaById($id)
    {
        $this->db->select('*');        
        $this->db->where('sa_id', $id);        
        $query = $this->db->get('ac_salesarea');
        return $query->row();
    }

    public function getAllSettingsLeadSourceByCompanyId($company_id)
    {
        $this->db->select('*');        
        $this->db->where('fk_company_id', $company_id);
        $this->db->order_by('ls_id', 'DESC');
        $query = $this->db->get('ac_leadsource');
        return $query->result();
    }

    public function getAllSettingsCustomerStatusByCompanyId($company_id, $default_ids = array())
    {        
        $this->db->select('*');        
        $this->db->where('company_id', $company_id);
        if( $default_ids ){            
            $this->db->or_where_in('id', $default_ids);
        }
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get('acs_cust_status');
        return $query->result();
    }

    public function getAllSettingsCustomerGroupByCompanyId($company_id)
    {
        $this->db->select('*');        
        $this->db->where('company_id', $company_id);
        $this->db->or_where('company_id', 0);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('customer_groups');
        return $query->result();
    }

    public function getAllCustomerEmergencyContactsByCustomerId($customer_id)
    {
        $this->db->select('*');        
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get('contacts');
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

    public function getCustomerGroupById($id)
    {
        $this->db->select('*');        
        $this->db->where('id', $id);        
        $query = $this->db->get('customer_groups');
        return $query->row();
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

    public function get_leads_data_this_week() {
        $cid = logged('company_id');
        
        // Calculate the start and end dates of the current week
        $startOfWeek = date('Y-m-d', strtotime('last Sunday'));
        $endOfWeek = date('Y-m-d', strtotime('next Saturday'));
        
        $this->db->from("ac_leads");
        $this->db->select('ac_leads.*, users.FName, users.LName, ac_leadtypes.lead_name');
        $this->db->join('users', 'users.id = ac_leads.fk_sr_id', 'left');
        $this->db->join('ac_leadtypes', 'ac_leadtypes.lead_id = ac_leads.fk_lead_type_id', 'left');
        $this->db->order_by('id', "DESC");
        $this->db->where("ac_leads.company_id", $cid);
        $this->db->where("DATE(ac_leads.date_created) BETWEEN '$startOfWeek' AND '$endOfWeek'");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_leads_data(){
        $cid=logged('company_id');
        $this->db->from("ac_leads");
        $this->db->select('ac_leads.*,users.FName,users.LName,ac_leadtypes.lead_name');
        $this->db->join('users', 'users.id = ac_leads.fk_sr_id','left');
        $this->db->join('ac_leadtypes', 'ac_leadtypes.lead_id = ac_leads.fk_lead_type_id', 'left');
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
                    $this->db->or_like('acs_profile.last_name', $param['search']);    
                    $this->db->or_like('acs_profile.first_name', $param['search']);    
                    //$this->db->or_like('acs_profile.email', $param['search'], 'both'); 
                    $this->db->or_like('acs_profile.business_name', $param['search']); 
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
            acs_alarm.system_type,acs_office.entered_by, CONCAT(users.FName, " ", users.LName) AS entered_by2, acs_office.lead_source,acs_profile.city,acs_profile.state,users.LName,users.FName,acs_profile.customer_type,
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
        $returnData->salesrep_paid = floatval($totalSalesRepPaid) + floatval($jobResult->salesrep_commission);
        $returnData->techrep_paid = $totalTechRepPaid + $jobResult->techrep_commission;
        return $returnData;    
    }

    public function createLead($data)
    {
        $this->db->insert('ac_leads', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function getAllLeadsByCompanyId($company_id, $filters=array())
    {

        $this->db->select('*');
        $this->db->from('ac_leads');
        $this->db->where('company_id', $company_id);
        $this->db->where('firstname !=', '');
        $this->db->where('lastname !=', '');

        if ( !empty($filters) ) {
            if ( $filters['search'] != '' ) {
                $this->db->group_start();
                    $this->db->like('firstname', $filters['search'], 'both');
                    $this->db->or_like('lastname', $filters['search'], 'both');
                $this->db->group_end();
            }
        }

        $this->db->order_by('firstname', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getLeadByLeadId($lead_id)
    {
        $this->db->select('*');
        $this->db->from('ac_leads');
        $this->db->where('leads_id', $lead_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function customerDuplicateLookup($data) 
    {
        $this->db->select('acs_profile.prof_id,  acs_profile.first_name,  acs_profile.last_name,  acs_profile.customer_type,  COUNT(DISTINCT invoices.id) AS Invoices, COUNT(DISTINCT jobs.id) AS Jobs,  COUNT(DISTINCT estimates.id) AS Estimates, COUNT(DISTINCT events.id) AS events, COUNT(DISTINCT tickets.id) AS tickets, COUNT(DISTINCT payment_records.id) AS Payment');
        $this->db->from('acs_profile');
        $this->db->join('invoices', 'invoices.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('jobs', 'jobs.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('estimates', 'estimates.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('events', 'events.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('tickets', 'tickets.customer_id = acs_profile.prof_id', 'left');
        $this->db->join('payment_records', 'payment_records.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $data['company_id']);
        $this->db->like('acs_profile.first_name', $data['first_name'], 'both');
        $this->db->like('acs_profile.last_name', $data['last_name'], 'both');
        $this->db->where('acs_profile.activated', 1);
        $this->db->group_by('acs_profile.prof_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDuplicateListData($company_id, $customerData, $searchMode, $searchType, $businessNameSearch, $firstNameSearch, $lastNameSearch) 
    {
        if ($customerData == "customer_with_count") {
           if ($searchType == "Residential") {
                $this->db->select(' acs_profile.prof_id, acs_profile.company_id, acs_profile.customer_type, TRIM(acs_profile.business_name) AS business_name, TRIM(acs_profile.first_name) AS first_name, TRIM(acs_profile.last_name) AS last_name, COUNT(*) AS total ');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('acs_profile.first_name !=', '');
                $this->db->where('acs_profile.last_name !=', '');
                $this->db->group_by('TRIM(acs_profile.first_name), TRIM(acs_profile.last_name), TRIM(acs_profile.customer_type), TRIM(acs_profile.mail_add)');
                $this->db->having('COUNT(*) > 1');
                $this->db->order_by('TRIM(acs_profile.first_name), TRIM(acs_profile.last_name)');
                $query = $this->db->get();
           } else if ($searchType == "Commercial" || $searchType == "Business") {
                $this->db->select(' acs_profile.prof_id, acs_profile.company_id, acs_profile.customer_type, TRIM(acs_profile.business_name) AS business_name, TRIM(acs_profile.first_name) AS first_name, TRIM(acs_profile.last_name) AS last_name, COUNT(*) AS total ');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('acs_profile.business_name !=', '');
                $this->db->group_by('TRIM(acs_profile.business_name), TRIM(acs_profile.customer_type)');
                $this->db->having('COUNT(*) > 1');
                $this->db->order_by('TRIM(acs_profile.business_name)');
                $query = $this->db->get();
           }
           
        } else if ($customerData == "all_duplicated_customer") {
            $subquery = $this->db->select("CONCAT(acs_profile.first_name, ', ', acs_profile.last_name) AS full_name")
                ->from('acs_profile')
                ->group_by('acs_profile.first_name, acs_profile.last_name')
                ->having('COUNT(*) > 1')
                ->get_compiled_select();
            $this->db->select('acs_profile.prof_id, acs_profile.company_id,  acs_profile.status, acs_profile.customer_type, acs_profile.business_name, customer_groups.title, ac_salesarea.sa_name, acs_profile.first_name, acs_profile.middle_name, acs_profile.last_name, acs_profile.prefix, acs_profile.suffix, acs_profile.country, acs_profile.mail_add, acs_profile.city, acs_profile.county, acs_profile.state, acs_profile.zip_code, acs_profile.cross_street, acs_profile.subdivision, acs_profile.ssn, acs_profile.date_of_birth, acs_profile.email, acs_profile.phone_h, acs_profile.phone_m, CONCAT(mail_add, " ", city, ", ", state, " ", zip_code) AS address, COUNT(customer_activity_logs.logs) AS customer_logs');
            $this->db->from('acs_profile');
            $this->db->join('customer_activity_logs', 'customer_activity_logs.customer_id = acs_profile.prof_id', 'left');
            $this->db->join('customer_groups', 'customer_groups.id = acs_profile.customer_group_id', 'left');
            $this->db->join('ac_salesarea', 'ac_salesarea.sa_id = acs_profile.fk_sa_id', 'left');
            
            $this->db->where("EXISTS ($subquery)", NULL, FALSE);
            $this->db->group_start();
            $this->db->like('acs_profile.first_name', $search_string, 'both'); 
            $this->db->like('acs_profile.last_name', $search_string, 'both');
            $this->db->group_end();

            if ($searchMode == true) {
                if ($searchType == "Commercial" || $searchType == "Business") {
                    $this->db->like('acs_profile.business_name', $businessNameSearch, 'both');
                    $this->db->where('acs_profile.customer_type', "Commercial");
                } 
                else if ($searchType == "Residential") {
                    $this->db->like('acs_profile.first_name', $firstNameSearch, 'both');
                    $this->db->like('acs_profile.last_name', $lastNameSearch, 'both');
                    $this->db->where('acs_profile.customer_type', "Residential");
                }
            }

            $this->db->where('acs_profile.company_id', $company_id);
            $this->db->group_by('acs_profile.prof_id, acs_profile.company_id, acs_profile.customer_type, acs_profile.business_name, acs_profile.first_name, acs_profile.last_name');
            $this->db->order_by('acs_profile.first_name, acs_profile.last_name');
            $query = $this->db->get();

        }
        return $result = $query->result();
    }

    public function getTotalDuplicatedEntry($company_id) {
        // Residential Duplicates
        $this->db->select('COUNT(*) AS residential');
        $this->db->from("
            (SELECT COUNT(*) AS duplicate_count
            FROM acs_profile
            WHERE company_id = $company_id AND customer_type = 'Residential'
            GROUP BY first_name, last_name, mail_add
            HAVING COUNT(*) > 1) AS subquery
         ");
        $query = $this->db->get();
        $residential = $query->row()->residential;
    
        // Business Duplicates
        $this->db->select('COUNT(*) AS business');
        $this->db->from("
            (SELECT COUNT(*) AS duplicate_count
            FROM acs_profile
            WHERE company_id = $company_id AND (customer_type = 'Commercial' OR customer_type = 'Business')
            GROUP BY business_name
            HAVING COUNT(*) > 1) AS subquery
         ");
        $query = $this->db->get();
        $business = $query->row()->business;
    
        return $residential + $business;
    }

    public function mergeEntryUpdater($updateData, $entryID, $originFirstname, $originLastname, $originBusinessname) {
        $company_id = logged('company_id');
        $status = true; 
        
        // acs_profile merge process
        $this->db->where('company_id', $company_id);
        $this->db->where('prof_id', $entryID);
        $status &= $this->db->update('acs_profile', $updateData);
        
        // get entry ID of the duplicates
        $this->db->select('prof_id');
        $this->db->from('acs_profile');
        if ($updateData['customer_type'] == "Residential") {
            $this->db->like('first_name',  $originFirstname, 'both');
            $this->db->like('last_name', $originLastname, 'both');
        } else {
            $this->db->like('business_name',  $originBusinessname, 'both');
        }
        $this->db->where('prof_id !=', $entryID);
        $query = $this->db->get();
        $duplicateID = $query->result();
    
        // get all tables that have a column name of customer_id
        $this->db->select('TABLE_NAME');
        $this->db->from('INFORMATION_SCHEMA.COLUMNS');
        $this->db->where('COLUMN_NAME', 'customer_id');
        $this->db->where("TABLE_NAME IN (SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE')");
        $query = $this->db->get();
        $tableList = $query->result();
    
        foreach ($tableList as $tableLists) {
            foreach ($duplicateID as $duplicateIDs) {
                if ($tableLists->TABLE_NAME != "acs_papers") {
                    $this->db->where('customer_id', $duplicateIDs->prof_id);
                    $status &= $this->db->update($tableLists->TABLE_NAME, array("customer_id" => $entryID));
                }
            }
        }
    
        // acs_profile remove process
        $this->db->where('company_id', $company_id);
        $this->db->where('prof_id !=', $entryID);
        if ($updateData['customer_type'] == "Residential") {
            $this->db->like('first_name',  $originFirstname, 'both');
            $this->db->like('last_name', $originLastname, 'both');
        } else {
            $this->db->like('business_name',  $originBusinessname, 'both');
        }
        $status &= $this->db->delete('acs_profile');

        return $status; 
    }

    public function getAllRecentLeadsByCompanyId($company_id, $limit = 10)
    {
        $this->db->select('*');
        $this->db->from('ac_leads');
        $this->db->where('company_id', $company_id);        
        $this->db->order_by('leads_id', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomerAlarmData($prof_id)
    {
        $this->db->select('*');
        $this->db->from('acs_alarm');
        $this->db->where('fk_prof_id', $prof_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getCustomerOfficeData($prof_id)
    {
        $this->db->select('*');
        $this->db->from('acs_office');
        $this->db->where('fk_prof_id', $prof_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function convertLeadToCustomer($lead_id, $cid, $uid)
    {
        $is_converted = 0;
        $prof_id = 0;
        $msg     = 'Cannot convert to customer';

        $this->db->select('*');
        $this->db->from('ac_leads');
        $this->db->where('leads_id', $lead_id);
        
        $query = $this->db->get();
        $lead  = $query->row();
        if( $lead ){
            $customer_data = [
                'company_id' => $cid,
                'fk_user_id' => $uid,
                'industry_type_id' => 0,
                'status' => 'New',
                'customer_type' => 'Residential',
                'first_name' => $lead->firstname,
                'middle_name' => $lead->middlename,
                'last_name' => $lead->lastname,
                'suffix' => $lead->suffix,
                'mail_add' => $lead->address,
                'city' => $lead->city,
                'state' => $lead->state,
                'zip_code' => $lead->zip,
                'cross_street' => $lead->address,
                'country' => $lead->country,
                'ssn' => $lead->sss_num,
                'date_of_birth' => date("Y-m-d",strtotime($lead->date_of_birth)),
                'email' => $lead->email_add,
                'phone_h' => $lead->phone_home,
                'phone_m' => $lead->phone_cell,
                'county' => $lead->county
            ];

            $this->db->insert('acs_profile', $customer_data);
            $prof_id = $this->db->insert_id();
            
            if( $prof_id > 0 ){
                $lead_data = ['status' => 'Converted', 'prof_id' => $prof_id];
                $this->db->update('ac_leads', $lead_data, ['leads_id' => $lead_id]);

                $is_converted = 1;
                $msg = '';
            }
        }

        $return = ['is_converted' => $is_converted, 'msg' => $msg, 'prof_id' => $prof_id];

        return $return;
    }
}