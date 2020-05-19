<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Workstatus_model extends MY_Model
{
	public $table = 'work_status';
	public function __construct()
	{
		parent::__construct();
	}


	public function getWorkStatus($work_status)
	{
		$this->db->select('*');
        $this->db->from($this->table);

		if (is_numeric($work_status))
			$this->db->where('id', $work_status);
		else
			$this->db->where('title', $work_status);

		$result = $this->db->get()->row();

		if (!empty($result)) {

			return $result->color;
		}

		return false;
	}


    public function filter($filters = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if (!empty($filters)) {

            foreach ($filters as $key=>$filter) {

                $this->db->where($key, $filter);
            }
        }

        return $this->db->get()->result();
    }
}



/* End of file Permissions_model.php */

/* Location: ./application/models/Permissions_model.php */
