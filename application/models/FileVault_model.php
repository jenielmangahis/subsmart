<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FileVault_model extends MY_Model
{
    public $table = 'filevault_v2';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

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

    public function getByNameAndCompanyId($name, $cid)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('name', $name);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByParentIdAndCompanyId($pid, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('parent_id', $pid);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->result();
    }

    public function saveData($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();
     
        return  $last_id;
    }
}


/* End of file EventSettings_model.php */
/* Location: ./application/models/EventSettings_model.php */
