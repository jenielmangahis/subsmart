<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends MY_Model {

	public $table = 'roles';

	public function __construct()
	{
		parent::__construct();
	}

	/**
     * @return mixed
     */
    public function getRoles()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
	}
	
	/**
     * @return mixed
     */
    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id", $id);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * @return mixed
     */
    public function getByTitleAndCompanyId($title, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("title", $title);
        $this->db->group_start();
            $this->db->or_where("company_id", $company_id);
            //$this->db->or_where("company_id", 0);
        $this->db->group_end();
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * @return mixed
     */
    public function getRolesByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
	}

    /**
     * @return mixed
     */
    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
	}

    public function bulkDelete($ids = [], $filters = [])
    {
        if( count($ids) > 0 ){
            $this->db->where_in('id', $ids);

            if( $filters ){
                foreach( $filters as $filter ){
                    $this->db->where($filter['field'], $filter['value']);
                }
            }

            $this->db->delete($this->table);
        }        

        return $this->db->affected_rows();
    }

}

/* End of file Roles_model.php */
/* Location: ./application/models/Roles_model.php */