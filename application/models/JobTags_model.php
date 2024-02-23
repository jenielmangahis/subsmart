<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobTags_model extends MY_Model
{
    public $table = 'job_tags';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByNameAndCompanyId($name, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->where('name', $name);

        $query = $this->db->get()->row();
        return $query;
    }

    public function createJobTag($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file JobTags_model.php */
/* Location: ./application/models/JobTags_model.php */
