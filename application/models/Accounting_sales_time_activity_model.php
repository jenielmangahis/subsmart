<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_sales_time_activity_model extends MY_Model {

	public $table = 'accounting_sales_time_activity';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getTimeActivitys(){
	    $query = $this->db->get('accounting_sales_time_activity');
	    return $query->result();
    }
	public function createTimeActivity($data){
	    $query = $this->db->insert('accounting_sales_time_activity', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateTimeActivity($id, $data){
	    $this->db->where('id', $id);
		$query = $this->db->update('accounting_sales_time_activity', $data);
		if($query){
			return true;
		}else{
			return false;
		}
    }
	public function deleteTimeActivity($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_sales_time_activity');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getTimeActivityDetails($id){
	    $query = $this->db->get_where('accounting_sales_time_activity', array('id' => $id));
	    return $query->result();
    }
}