<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VonageSms_model extends MY_Model
{    
    public $table = 'vonage_sms';


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
}

/* End of file VonageSms_model.php */
/* Location: ./application/models/VonageSms_model.php */
