<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PriorityList_model extends MY_Model
{
    public $table = 'priority_list';


    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', getLoggedUserID());
        $query = $this->db->get();

        return $query->result();
    }
}

/* End of file PriorityList_model.php */
/* Location: ./application/models/PriorityList_model.php */
