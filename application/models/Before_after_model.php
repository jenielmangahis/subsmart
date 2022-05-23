<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Before_after_model extends MY_Model
{
    public $table = 'before_after';
  
    /**
     * @return mixed
     */
    public function updateBeforeAfter($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

    /**
     * @return mixed
     */
    public function deleteBeforeAfter($id)
    {
        $this->db->delete($this->table, array("group_number" => $id));
    }
}

/* End of file Before_after_model.php */
/* Location: ./application/models/Before_after_model.php */
