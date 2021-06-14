<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanySubscriptionPayments_model extends MY_Model
{
    public $table = 'company_subscription_payments';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        
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

    public function getCompanyLastPayment($company_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getCompanyFirstPayment($company_id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function generateORNumber($id)
    {
        $issue_no = 'OR-' . date("Y") . '-SUB' . str_pad($id, 5,"0",STR_PAD_LEFT);
        return $issue_no; 
    }

}

/* End of file CompanySubscriptionPayments_model.php */
/* Location: ./application/models/CompanySubscriptionPayments_model.php */
