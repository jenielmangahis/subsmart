<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreditNote_model extends MY_Model
{

    public $table = 'credit_notes';

    public $status_open    = 1;
    public $status_closed  = 2;
    public $status_expired = 3;
    public $status_draft   = 4;


    public function getAllByCompanyId($company_id)
    {

        $this->db->select('credit_notes.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'credit_notes.user_id = users.id', 'LEFT');
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);

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

    public function optionStatus()
    {
        $status = [
            $this->status_open => 'Open',
            $this->status_closed => 'Closed',
            $this->status_expired => 'Expired',
            $this->status_draft => 'Draft'
        ];

        return $status;
    }
}

/* End of file CreditNote_model.php */
/* Location: ./application/models/CreditNote_model.php */
