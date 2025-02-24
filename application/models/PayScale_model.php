<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PayScale_model extends MY_Model
{
    public $table = 'payscale';

    public function getAll($filters=array())
    {
        $id = logged('id');
        $this->db->select('payscale.*, clients.business_name, clients.id AS uid');
        $this->db->join('clients', 'payscale.company_id = clients.id', 'LEFT');
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

    public function getPayScale($company_id)
    {
        $id = logged('id');
        //$default_ids = $this->defaultPayScaleIds();
        $this->db->select('*');
        $this->db->from($this->table);
        // $this->db->where('company_id', $company_id);
        // $this->db->or_where('company_id', 0);
        //$this->db->or_where_in('id', $default_ids);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id)
    {
        $id = logged('id');
        //$default_ids = $this->defaultPayScaleIds();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->or_where('company_id', 0);
        //$this->db->or_where_in('id', $default_ids);
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

    public function deletePayScale($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    }

    public function defaultPayScaleIds(){
        $default_ids = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];

        return $default_ids;
    }

    public function optionPayType(){
        $options = [
            'Hourly' => 'Hourly',
            'Daily' => 'Daily',
            'Weekly' => 'Weekly',
            'Monthly' => 'Monthly',
            'Yearly' => 'Yearly',
            'Commission Only' => 'Commission Only'
        ];

        return $options;
    }

    public function get_company_employees_using_payscale($payscaleId)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('payscale_id', $payscaleId);
        $query = $this->db->get('users');
        return $query->result();
    }
}

/* End of file PayScale_model.php */
/* Location: ./application/models/PayScale_model.php */
