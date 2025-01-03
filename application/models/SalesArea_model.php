<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesArea_model extends MY_Model
{
    public $table = 'ac_salesarea';

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
        $this->db->where('sa_id', $id);
        $this->db->where('fk_comp_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByNameAndCompanyId($name, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('sa_name', $name);
        $this->db->where('fk_comp_id', $cid);

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
        $this->db->where('fk_comp_id', $cid);

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

    public function createSalesArea($data)
    {
        $this->db->insert($this->table, $data);
	    $insert_id = $this->db->insert_id();
		return  $insert_id;
    }

    public function deleteSalesArea($id)
    {
        $this->db->where('sa_id', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }
}

/* End of file SalesArea_model.php */
/* Location: ./application/models/SalesArea_model.php */
