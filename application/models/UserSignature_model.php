<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserSignature_model extends MY_Model
{
    public $table = 'user_signatures'; 

    public function getAll()
    {
        $this->db->select('user_signatures.*, users.FName, users.LName, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'user_signatures.user_id = users.id', 'left');
        $this->db->order_by('user_signatures.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('user_signatures.*, users.FName, users.LName, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'user_signatures.user_id = users.id', 'left');
        $this->db->where('users.company_id', $company_id);
        $this->db->order_by('user_signatures.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('user_signatures.*, users.FName, users.LName, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'user_signatures.user_id = users.id', 'left');
        $this->db->where('user_signatures.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file UserSignature_model.php */
/* Location: ./application/models/UserSignature_model.php */
