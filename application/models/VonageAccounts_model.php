<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VonageAccounts_model extends MY_Model
{
    public $table = 'vonage_accounts';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);        

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('vn_from_number', $filters['search'], 'both');
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

    public function getByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        
        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file TwilioAccounts_model.php */
/* Location: ./application/models/TwilioAccounts_model.php */
