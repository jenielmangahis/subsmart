<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerStatementClaim_model extends MY_Model
{
    public $table = 'customer_statement_of_claims';

    public function getAll()
    {
        $this->db->select('customer_statement_of_claims.*, acs_profile.company_id');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_statement_of_claims.customer_id = acs_profile.prof_id', 'left');
        $this->db->order_by('customer_statement_of_claims.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('customer_statement_of_claims.*, acs_profile.company_id');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_statement_of_claims.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_statement_of_claims.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCustomerId($customer_id)
    {
        $this->db->select('customer_statement_of_claims.*, acs_profile.company_id');
        $this->db->from($this->table);
        $this->db->join('acs_profile', 'customer_statement_of_claims.customer_id = acs_profile.prof_id', 'left');
        $this->db->where('customer_statement_of_claims.customer_id', $customer_id);

        $query = $this->db->get()->row();
        return $query;
    }

}

/* End of file CustomerStatementClaim_model.php */
/* Location: ./application/models/CustomerStatementClaim_model.php */
