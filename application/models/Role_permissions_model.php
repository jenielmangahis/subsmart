<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_permissions_model extends MY_Model {

	public $table = 'role_permissions';

	public function __construct()
	{
		parent::__construct();
	}

	public function getByPermissionCode($role, $code)
	{
		//print_r($role);print_r($code);die;

		// temporary - this should be edited such that this should be a join query for roles, role_permissions and permissions tables
		// gets where role exists
		return ($query = $this->db->get_where($this->table, ['role_id' => $role], 1)) && $query->num_rows() > 0 ? $query->row() : null;

	}

}

/* End of file Role_permissions_model.php */
/* Location: ./application/models/Role_permissions_model.php */