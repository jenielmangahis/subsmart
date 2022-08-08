<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PlaidAccount_model extends MY_Model
{
    public $table = 'plaid_accounts';
   
    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like($filters['field'], $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file PlaidAccount_model.php */
/* Location: ./application/models/PlaidAccount_model.php */
