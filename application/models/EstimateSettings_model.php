<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EstimateSettings_model extends MY_Model
{

    public $table = 'estimate_settings';

    public function getAllByCompany($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllEstimateSettings()
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getEstimateSetting($estimate_setting_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $estimate_setting_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getEstimateSettingByCompanyId($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file EstimateSettings_model.php */
/* Location: ./application/models/EstimateSettings_model.php */
