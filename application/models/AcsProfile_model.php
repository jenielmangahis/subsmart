<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsProfile_model extends MY_Model
{

    public $table = 'acs_profile';

    public function getAllByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getByProfId($prof_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file AcsProfile_model.php */
/* Location: ./application/models/AcsProfile_model.php */
