<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JobSettings_model extends MY_Model
{

    public $table = 'jobs_settings';

    public function getAllByCompany($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllJobSettings()
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getJobSetting($job_setting_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $job_setting_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getJobSettingByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file JobSettings_model.php */
/* Location: ./application/models/JobSettings_model.php */
