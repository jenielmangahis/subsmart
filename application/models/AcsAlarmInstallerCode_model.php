<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsAlarmInstallerCode_model extends MY_Model
{
    public $table = 'acs_alarm_installer_codes';
    
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

    public function getByCodeAndCompanyId($code, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('installer_code', $code);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file AcsAlarmInstallerCode_model.php */
/* Location: ./application/models/AcsAlarmInstallerCode_model.php */
