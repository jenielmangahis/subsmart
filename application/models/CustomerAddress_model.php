<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerAddress_model extends MY_Model
{
    public $table = 'customer_address';

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('customer_address.*, acs_profile.company_id, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_address.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('acs_profile.company_id', $company_id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByCustomerId($customer_id)
    {
        $this->db->select('customer_address.*, acs_profile.company_id, acs_profile.first_name, acs_profile.last_name');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_address.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_address.customer_id', $customer_id);
        $query = $this->db->get();

        return $query->result();
    }

    public function deleteAllByCustomerId($customer_id)
    {
        $this->db->delete($this->table, ['customer_id' => $customer_id]);
    }
}

/* End of file CustomerAddress_model.php */
/* Location: ./application/models/CustomerAddress_model.php */
