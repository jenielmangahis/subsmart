<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_delayed_charge_model extends MY_Model {

	public $table = 'accounting_delayed_charge';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getDelayedCharges(){
	    $query = $this->db->get('accounting_delayed_charge');
	    return $query->result();
    }
	public function createDelayedCharge($data){
	    $query = $this->db->insert('accounting_delayed_charge', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateDelayedCharge($id, $data){
	    $this->db->where('id', $id);
		$query = $this->db->update('accounting_delayed_charge', $data);
		if($query){
			return true;
		}else{
			return false;
		}
    }
	public function deleteDelayedCharge($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_delayed_charge');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getDelayedChargeDetails($id){
	    $query = $this->db->get_where('accounting_delayed_charge', array('id' => $id));
	    return $query->result();
    }
	public function delete_delayed_charge_items($delayed_charge_id)
	{
		$this->db->delete('item_details', array('type_id' => $delayed_charge_id,'type'=>'Delayed Charge'));
	}
}