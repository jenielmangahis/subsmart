<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StartupChecklist_model extends MY_Model
{

    public $table = 'startup_checklist';


    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file StartupChecklist_model.php */
/* Location: ./application/models/StartupChecklist_model.php */
