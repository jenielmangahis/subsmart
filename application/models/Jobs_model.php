<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends MY_Model
{
    public $table = 'jobs';
    public $table_job_settings = 'job_settings';
    public $table_jobs_has_address = 'jobs_has_address';
    public $table_jobs_has_customers = 'jobs_has_customers';


    /**
     * @return mixed
     */
    public function getJob()
    {
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where('company_id', getLoggedCompanyID());
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getAddresses()
    {
        $this->db->select('*');
        $this->db->from('address');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getCustomers()
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('customers.company_id', $comp_id);
        $this->db->join('users', 'users.id = customers.user_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getItems($params, $id)
    {
        $col = ($params == "material") ? 'item_categories_id' : 'type';
        $comp_id = logged('company_id');
        $array = array('company_id' => $comp_id, $col => $id);

        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($array);
        $query = $this->db->get();

        return $query->result_array();
    }

        /**
     * @return mixed
     */
    public function getJobDetails()
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where('jobs.company_id', $comp_id);
        $this->db->join('users', 'users.id = customers.user_id');
        $query = $this->db->get();

        return $query->result_array();
    }
}

/* End of file JobType_model.php */
/* Location: ./application/models/JobType_model.php */
