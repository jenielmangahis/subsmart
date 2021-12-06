<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreditNoteSettings_model extends MY_Model
{

    public $table = 'credit_note_settings';


    public function getAllByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('company_id', $company_id);

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

    public function getById($id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

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
