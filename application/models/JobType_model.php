<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobType_model extends MY_Model
{
    public $table = 'job_types';


    /**
     * @return mixed
     */
    public function getJobTypes()
    {
        $this->db->select('*');
        $this->db->from('job_types');
        $this->db->where('user_id', getLoggedUserID());
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllJobTypes()
    {
        $this->db->select('*');
        $this->db->from('job_types');
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllCompanyJobTypes($company_id)
    {
        $this->db->select('*');
        $this->db->from('job_types');
        $this->db->where('company_id', $company_id);
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

    public function getByTitleAndCompanyId($title, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('title', $title);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateJobTypeById($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function createJobType($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
}

/* End of file JobType_model.php */
/* Location: ./application/models/JobType_model.php */
