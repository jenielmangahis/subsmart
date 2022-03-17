<?php
defined('BASEPATH') or exit('No direct script access allowed');

class QuickNote_model extends MY_Model
{

    public $table = 'messages_quick_notes';

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

    public function getByIdAndCompanyId($id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file QuickNote_model.php */
/* Location: ./application/models/QuickNote_model.php */
