<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends MY_Model
{
    public $table = 'jobs';


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
