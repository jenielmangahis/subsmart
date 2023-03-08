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

    public function getPaymentRecordACS($id){
        $this->db->select('*');
        $this->db->from('payment_records');
        $this->db->where('payment_records.company_id', $id);
        $this->db->join('acs_profile', 'payment_records.customer_id = acs_profile.prof_id');
        // $this->db->group_by('acs_profile.prof_id');

        $query = $this->db->get();
        return $query->result();
    }
}