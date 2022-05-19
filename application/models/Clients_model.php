<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clients_model extends MY_Model
{
    public $table = 'clients';
   
    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('clients.*, nsmart_plans.plan_name, nsmart_plans.price, industry_type.name AS industry_type_name');
        $this->db->from($this->table);

        $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');

        //$this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('first_name', $filters['search'], 'both');
            }
        }



        //table "nsmart_plans" field nsmart_plans_id

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $user_id = logged('company_id');

        $this->db->select('clients.*, nsmart_plans.plan_name, nsmart_plans.price, industry_type.name AS industry_type_name');
        $this->db->from($this->table);

        $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');

        $this->db->where('clients.id', $id);

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

    
}

/* End of file Clients_model.php */
/* Location: ./application/models/Clients_model.php */
