<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CommissionSetting_model extends MY_Model
{
    public $table = 'commission_settings';

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
        $this->db->or_where('company_id', 0);
        $this->db->order_by('id', 'DESC');

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

    public function optionCommissionTypes()
    {
        $options = [
            'percentage' => 'Percentage',
            'amount' => 'Fixed Amount'
        ];

        return $options;
    }

    public function commissionTypeAmount()
    {
        return 'amount';
    }

    public function commissionTypePercentage()
    {
        return 'percentage';
    }

    public function isJob()
    {
        return 'job';
    }
}

/* End of file CommissionSetting_model.php */
/* Location: ./application/models/CommissionSetting_model.php */
