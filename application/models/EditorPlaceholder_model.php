<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditorPlaceholder_model extends MY_Model
{
    public $table = 'esign_editor_placeholders';

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $cid);

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

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->where('company_id', $cid);
        $this->db->from($this->table);
        
        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file EditorPlaceholder_model.php */
/* Location: ./application/models/EditorPlaceholder_model.php */
