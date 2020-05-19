<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Workzone_model extends MY_Model
{

    public $table = 'zones';


    public function getZones()
    {

        $user_id = getLoggedUserID();

        $this->db->select('*');
        $this->db->from('zones');
        $this->db->where('user_id', $user_id);

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        //echo $this->db->last_query();die;

        if ($query)
            return $query->result();

        return null;
    }


    public function getAll($conditions)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $conditions['user_id']);
        $this->db->where('company_id', $conditions['company_id']);
        $this->db->where('workorder_id', $conditions['workorder_id']);

        $query = $this->db->get();

        if ($query)
            return $query->result();


        return false;
    }
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
