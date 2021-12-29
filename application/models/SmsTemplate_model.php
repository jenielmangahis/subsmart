<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmsTemplate_model extends MY_Model
{
    public $table = 'settings_sms_template';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

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

    public function getByIdAndCompanyId($id, $company_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function optionTemplateTypes()
    {
        $options = [
            1 => 'Invoice',
            2 => 'Estimate',
            3 => 'Schedule',
            4 => 'Review',
            5 => 'Notes'
        ];

        return $options;
    }

    public function optionDetails()
    {
        $options = [
            1 => 'Default Template',
            2 => 'Custom Template'
        ];

        return $options;
    }
}

/* End of file SmsTemplate_model.php */
/* Location: ./application/models/SmsTemplate_model.php */
