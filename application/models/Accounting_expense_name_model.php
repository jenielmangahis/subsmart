<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounting_expense_name_model extends MY_Model {

	public $table = 'accounting_list_category';
	
	public function __construct()
	{
		parent::__construct();
	}

	public function getexpensename(){
	    $query = $this->db->get('accounting_list_category');
	    return $query->result();
    }
	public function createexpensename($data){
	    $query = $this->db->insert('accounting_list_category', $data);
	    $insert_id = $this->db->insert_id();

		return  $insert_id;
    }
	public function updateexpensename($id, $data){
	    $this->db->where('id', $id);
		$query = $this->db->update('accounting_list_category', $data);
		if($query){
			return true;
		}else{
			return false;
		}
    }
	public function deleteexpensename($id){
		$this->db->where('id',$id);
        $query = $this->db->delete('accounting_list_category');
        if ($query){
            return true;
        }else{
            return false;
        }
    }
	public function getexpensenameDetails($id){
	    $query = $this->db->get_where('accounting_list_category', array('id' => $id));
	    return $query->result();
    }
}