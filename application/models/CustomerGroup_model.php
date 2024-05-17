<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerGroup_model extends MY_Model
{
    public $table = 'customer_groups';


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

    public function getAllByCompany($company_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if (!empty($filter)) {

            if (isset($filter['q'])) {

                $this->db->like('name', $filter['q'], 'both');
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id", $id);
        $query = $this->db->get();
        
        return $query->row();
    }
}

/* End of file CustomerGroup_model.php */
/* Location: ./application/models/CustomerGroup_model.php */
