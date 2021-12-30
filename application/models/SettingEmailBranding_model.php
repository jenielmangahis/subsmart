<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingEmailBranding_model extends MY_Model
{

    public $table = 'setting_email_brandings';

    public function getAllByUserId($user_id, $filter = array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function findByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function findByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file SettingEmailBranding_model.php */
/* Location: ./application/models/SettingEmailBranding_model.php */
