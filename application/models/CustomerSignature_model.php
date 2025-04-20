<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerSignature_model extends MY_Model
{
    public $table = 'customer_signature'; 

    public function getAll()
    {
        $this->db->select('customer_signature.*, acs_profile.first_name, acs_profile.last_name, acs_profile.phone_m, acs_profile.email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_signature.customer_id = acs_profile.prof_id', 'left');
        $this->db->order_by('customer_signature.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('customer_signature.*, acs_profile.first_name, acs_profile.last_name, acs_profile.phone_m, acs_profile.email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_signature.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_signature.company_id', $company_id);
        $this->db->order_by('customer_signature.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('customer_signature.*, acs_profile.first_name, acs_profile.last_name, acs_profile.phone_m, acs_profile.email');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_signature.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_signature.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCustomerId($customer_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file CustomerSignature_model.php */
/* Location: ./application/models/CustomerSignature_model.php */
