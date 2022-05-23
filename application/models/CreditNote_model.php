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

        $this->db->select('credit_notes.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id');
        $this->db->from($this->table);
        $this->db->join('users', 'credit_notes.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'credit_notes.customer_id = acs_profile.prof_id', 'LEFT');        
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyIdAndStatus($company_id, $status = 0)
    {

        $this->db->select('credit_notes.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id');
        $this->db->from($this->table);
        $this->db->join('users', 'credit_notes.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'credit_notes.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->where('credit_notes.status', $status);
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAll()
    {

        $this->db->select('credit_notes.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id');
        $this->db->join('users', 'credit_notes.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'credit_notes.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByStatus($status = 0)
    {

        $this->db->select('credit_notes.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id');
        $this->db->join('users', 'credit_notes.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'credit_notes.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->from($this->table);
        if( $status > 0 ){
            $this->db->where('credit_notes.status', $status);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function countAllByStatus($status)
    {

        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('status', $status);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function countAllByStatusAndCompanyId($status, $company_id)
    {

        $this->db->select('credit_notes.id, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'credit_notes.user_id = users.id', 'LEFT');
        $this->db->where('credit_notes.status', $status);
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getById($id)
    {

        $this->db->select('credit_notes.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'credit_notes.user_id = users.id', 'LEFT');
        $this->db->where('credit_notes.id', $id);

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

    public function isDraft()
    {
        return $this->status_draft;
    }

    public function saveCreditNote($post_data)
    {
        $this->db->insert($this->table, $post_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function isClosed()
    {
        return $this->status_closed;
    }

    public function deleteCreditNote($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file CreditNote_model.php */
/* Location: ./application/models/CreditNote_model.php */
