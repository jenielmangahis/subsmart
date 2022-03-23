<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreditBureau_model extends MY_Model
{

    public $table = 'credit_bureau';

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

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }
}

/* End of file CreditBureau_model.php */
/* Location: ./application/models/CreditBureau_model.php */
