<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsSolarInfoProposedModule_model extends MY_Model
{
    public $table = 'acs_solar_info_proposed_modules';

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByNameAndCompanyId($name, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('name', $name);
        $this->db->where('company_id', $cid);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByIdAndCompanyId($id, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $cid);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

}

/* End of file AcsSolarInfoLenderType_model.php */
/* Location: ./application/models/AcsSolarInfoLenderType_model.php */
