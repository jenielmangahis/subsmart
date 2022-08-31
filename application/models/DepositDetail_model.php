<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DepositDetail_model extends MY_Model {

    public $table = 'payment_records';    
	
    public function getPaymentRecord($id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $id);

        $query = $this->db->get();
        return $query->result();
    }
}