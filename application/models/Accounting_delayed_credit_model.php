<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_delayed_credit_model extends MY_Model {

	public $table = 'accounting_delayed_Credit';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getDelayedCredit(){
	    $query = $this->db->get('accounting_delayed_Credit');
	    return $query->result();
    }
	public function createDelayedCredit($data){
	    $query = $this->db->insert('accounting_delayed_Credit', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateDelayedCredit($id, $data){
	    $this->db->where('id', $id);
		$query = $this->db->update('accounting_delayed_Credit', $data);
		if($query){
			return true;
		}else{
			return false;
		}
    }
	public function deleteDelayedCredit($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_delayed_Credit');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getDelayedCreditDetails($id){
	    $query = $this->db->get_where('accounting_delayed_Credit', array('id' => $id));
	    return $query->result();
    }
}