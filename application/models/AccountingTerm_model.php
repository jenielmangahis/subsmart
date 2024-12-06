<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingTerm_model extends MY_Model
{
    public $table = 'accounting_terms';


    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filter = array())
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

    public function getByNameAndCompanyId($name, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("name", $name);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        
        return $query->row();
    }
}

/* End of file AccountingTerm_model.php */
/* Location: ./application/models/AccountingTerm_model.php */
