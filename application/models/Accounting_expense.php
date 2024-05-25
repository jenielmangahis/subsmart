<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_expense extends MY_Model {

    public $table = 'accounting_expense';    

    public function getAll($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_updated', 0);

        if( $limit > 0 ){
            $this->db->limit($limit);
        } 

        $this->db->order_by('id', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }
	
}