<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plans_model extends MY_Model {
	public $table = 'plan_type';

	public function __construct(){
		parent::__construct();
	}

	public function getByIdAndCompanyId($id, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

	public function getByNameAndCompanyId($name, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('plan_name', $name);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

	public function deletePlan($id){
        $this->db->delete($this->table, array('id' => $id));
    } 
}



/* End of file Permissions_model.php */

/* Location: ./application/models/Permissions_model.php */