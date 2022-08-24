<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PlaidBankAccount_model extends MY_Model
{    
    public $table = 'plaid_bank_accounts';


    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters['search']) ){
            foreach($filters['search'] as $f){
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('company_id', $company_id);

        if ( !empty($filters['search']) ){
            foreach($filters['search'] as $f){
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllBySubType($subtype, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('subtype', $subtype);

        if ( !empty($filters['search']) ){
            foreach($filters['search'] as $f){
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
        }

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

    public function getByAccountId($account_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('account_id', $account_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByAccountNameAndSubType($account_name, $subtype, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('account_name', $account_name);
        $this->db->where('subtype', $subtype);

        if ( !empty($filters['search']) ){
            foreach($filters['search'] as $f){
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
        }

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file PlaidBankAccount_model.php */
/* Location: ./application/models/PlaidBankAccount_model.php */
