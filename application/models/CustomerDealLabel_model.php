<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDealLabel_model extends MY_Model
{
    public $table = 'customer_deal_labels';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if ( !empty($filters) ) {
            //$this->db->group_start();
            foreach( $filters as $filter ){
                if( is_array($filter['value']) ){
                    $this->db->where_in($filter['field'], $filter['value']);
                }else{
                    if( $filter['value'] != '' ){
                        $this->db->where($filter['field'], $filter['value']);
                    }   
                }
                
            }
            //$this->db->group_end();
        }

        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->row();
    } 
    
    public function getByName($name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('name', $name);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->row();
    } 

    public function create($data)
    {
        $this->db->insert($this->table, $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
}
