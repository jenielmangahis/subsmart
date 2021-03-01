<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Icons_model extends MY_Model
{

    public $table = 'icons';

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
}

/* End of file Icons_model.php */
/* Location: ./application/models/Icons_model.php */
