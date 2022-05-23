<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreditNoteSettings_model extends MY_Model
{

    public $table = 'credit_note_settings';


    public function getAllByCompanyId($company_id)
    {

        $this->db->select('credit_note_settings.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'credit_note_settings.user_id = users.id', 'LEFT');
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAll()
    {

        $this->db->select('credit_note_settings.*, users.id AS uid, users.company_id');        
        $this->db->from($this->table);
        $this->db->join('users', 'credit_note_settings.user_id = users.id', 'LEFT');
        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {

        $this->db->select('credit_note_settings.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
         $this->db->join('users', 'credit_note_settings.user_id = users.id', 'LEFT');
        $this->db->where('credit_note_settings.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByCompanyId($company_id)
    {

        $this->db->select('credit_note_settings.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
         $this->db->join('users', 'credit_note_settings.user_id = users.id', 'LEFT');
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function saveCreditNoteSetting($post_data)
    {
        $this->db->insert($this->table, $post_data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
}

/* End of file CreditNoteSettings_model.php */
/* Location: ./application/models/CreditNoteSettings_model.php */
