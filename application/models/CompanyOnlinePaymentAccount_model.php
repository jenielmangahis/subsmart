<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyOnlinePaymentAccount_model extends MY_Model
{
    public $table = 'company_online_payment_accounts';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

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

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateCompanyAccount($company_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('company_id', $company_id);
        $this->db->update();
    }

}

/* End of file CompanyOnlinePaymentAccount_model.php */
/* Location: ./application/models/CompanyOnlinePaymentAccount_model.php */
