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
}

/* End of file JobType_model.php */
/* Location: ./application/models/JobType_model.php */
