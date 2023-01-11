<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_model extends MY_Model
{
    public $table = 'clients';
    public $solar_industry_id = 28;
   
    public function getAll($filters=array())
    {
        $this->db->select('clients.*, nsmart_plans.plan_name, nsmart_plans.price, industry_type.name AS industry_type_name, business_profile.business_name as bp_business_name,business_profile.id as bp_id,business_profile.contact_name as bp_contact_name, business_profile.business_phone as bp_business_phone');
        $this->db->from($this->table);

        $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'right');
        $this->db->join('business_profile', 'business_profile.company_id = clients.id', 'left');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('business_profile.business_name', $filters['search'], 'both');
                $this->db->or_like('industry_type.name', $filters['search'], 'both');
            }
        }

        //table "nsmart_plans" field nsmart_plans_id

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByStatus($status)
    {
        $this->db->select('clients.*, nsmart_plans.plan_name, nsmart_plans.price, industry_type.name AS industry_type_name, business_profile.business_name as bp_business_name,business_profile.id as bp_id,business_profile.contact_name as bp_contact_name, business_profile.business_phone as bp_business_phone');
        $this->db->from($this->table);

        $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'right');
        $this->db->join('business_profile', 'business_profile.company_id = clients.id', 'left');
        $this->db->where('clients.is_plan_active', $status);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_company($id)
    {

        $where = array(
            'id' => $id,
        );

        $this->db->select('*');
        $this->db->from('clients');
		$this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getCompanyCompanyId($id)
    {
        // $this->db->select('company_id');
		// $this->db->from('work_orders');
		// $this->db->where('id', $id);
        // $query = $this->db->get();
        // $comp = $query->row();
        // // foreach($query as $q){
        //     $company = $q->company_id;
        // // }

        // $this->db->select('*');
        // $this->db->select('*','business_profile.company_id','business_profile.street as b_street','business_profile.city as b_city','business_profile.postal_code as b_postal_code','business_profile.state as b_state','business_profile.license_state as b_license_state','business_profile.office_phone as b_office_phone');
		// $this->db->from('clients');
        // $this->db->join('business_profile', 'clients.id  = business_profile.company_id');
		// $this->db->where('clients.id', $id);
        // $query2 = $this->db->get();
        // return $query2->row();
        $this->db->select('*');
		$this->db->from('business_profile');
		$this->db->where('company_id', $id);
        $query2 = $this->db->get();
        return $query2->row();
    }

    public function getById($id)
    {
        //$user_id = logged('company_id');

        $this->db->select('clients.*, nsmart_plans.plan_name, nsmart_plans.price, industry_type.name AS industry_type_name');
        $this->db->from($this->table);

        $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');

        $this->db->where('clients.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByIdPub($id)
    {
        // $user_id = logged('company_id');

        $this->db->select('*');
        $this->db->from($this->table);

        // $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        // $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByIdPubClientProf($id)
    {
        $this->db->select('*');
        $this->db->from('business_profile');
        $this->db->where('id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function getByEmail($email)
    {
        $user_email = $email;

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('email_address', $user_email);

        $query = $this->db->get()->row();

        return $query;
    }

    public function getByBusinessName($business_name)
    {
        $b_name = $business_name;

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('business_name', $b_name);

        $query = $this->db->get()->row();

        return $query;
    }

    public function getByIPAddress($ip_address)
    {
        $ip_address = $ip_address;

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('ip_address', $ip_address);

        $query = $this->db->get()->row();

        return $query;
    }

    public function updateClient($client_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $client_id);
        $this->db->update();
    }
    
    public function deleteClient($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function getAllByPlanDateExpiration($date, $fields = ''){
        if( $fields != '' ){
            $this->db->select($fields);
        }else{
            $this->db->select('*');
        }
        
        $this->db->where('plan_date_expiration', $date);
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllExpiredSubscription($date, $fields = ''){
        if( $fields != '' ){
            $this->db->select($fields);
        }else{
            $this->db->select('*');
        }
        
        $this->db->where('plan_date_expiration <=', $date);
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    public function deactivateExpiredUnpaidSubscription(){
        $date = date("Y-m-d");

        $this->db->from($this->table);
        $this->db->set(['is_plan_active' => 0]);
        $this->db->where('is_auto_renew', 0);
        $this->db->where('next_billing_date <=', $date);
        $this->db->update();
    }

    public function solarIndustryId(){
        return $this->solar_industry_id;
    }
}

/* End of file Clients_model.php */
/* Location: ./application/models/Clients_model.php */
