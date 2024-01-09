<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TaxRates_model extends MY_Model
{
    public $table = 'tax_rates';
    public $status_active   = 1;
    public $status_inactive = 0;
    public $discount_percent = 1;
    public $discount_amount   = 0;

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

    public function create($data)
    {
        $vendor = $this->db->insert('tax_rates', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
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

    public function resetDefaultTaxRateByCompanyId($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->update($this->table, ['is_default' => 0]);
    }
}

/* End of file TaxRates_model.php */
/* Location: ./application/models/TaxRates_model.php */
