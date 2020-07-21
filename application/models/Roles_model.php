<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends MY_Model {

	public $table = 'roles';

	public function __construct()
	{
		parent::__construct();
	}

	/**
     * @return mixed
     */
    public function getRoles()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
	}
	
	/**
     * @return mixed
     */
    public function getRolesById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("id", $id);
        $query = $this->db->get();

        return $query->row();
    }

}

/* End of file Roles_model.php */
/* Location: ./application/models/Roles_model.php */