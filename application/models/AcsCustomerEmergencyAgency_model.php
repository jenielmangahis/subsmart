<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsCustomerEmergencyAgency_model extends MY_Model
{
    public $table = 'acs_customer_emergency_agencies';
    
    public function getAllByCompanyId($company_id)
    {
        $this->db->select('acs_customer_emergency_agencies.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_customer_emergency_agencies.customer_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_profile.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {

        $this->db->select('acs_customer_emergency_agencies.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_customer_emergency_agencies.customer_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_customer_emergency_agencies.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByCustomerId($customer_id)
    {
        $this->db->select('acs_customer_emergency_agencies.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_customer_emergency_agencies.customer_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_customer_emergency_agencies.customer_id', $customer_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdAndCompanyId($id, $cid)
    {

        $this->db->select('acs_customer_emergency_agencies.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_customer_emergency_agencies.customer_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_customer_emergency_agencies.id', $id);
        $this->db->where('acs_profile.company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function bulkDelete($ids = [], $filters = [])
    {
        if( count($ids) > 0 ){
            $this->db->where_in('id', $ids);

            if( $filters ){
                foreach( $filters as $filter ){
                    $this->db->where($filter['field'], $filter['value']);
                }
            }

            $this->db->delete($this->table);
        }        

        return $this->db->affected_rows();
    }
}

/* End of file AcsCustomerEmergencyAgency_model.php */
/* Location: ./application/models/AcsCustomerEmergencyAgency_model.php */
