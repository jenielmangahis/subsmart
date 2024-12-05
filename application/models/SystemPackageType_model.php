<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SystemPackageType_model extends MY_Model
{
    public $table = 'ac_system_package_type';

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

    public function getByNameAndCompanyId($name, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('name', $name);
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

    public function getAllByCompanyId($cid, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);

        if( !empty($conditions) ){
            $this->db->group_start();            
            foreach( $conditions as $c ){
                $this->db->or_like($c['field'], $c['value']);    
            }
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file SystemPackageType_model.php */
/* Location: ./application/models/SystemPackageType_model.php */
