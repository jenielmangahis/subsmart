<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerSource_model extends MY_Model
{
    public $table = 'customer_sources';


    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', getLoggedUserID());
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllCustomerSource()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
    }
}

/* End of file CustomerSource_model.php */
/* Location: ./application/models/CustomerSource_model.php */
