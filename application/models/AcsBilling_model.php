<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsBilling_model extends MY_Model
{
    public $table = 'acs_billing';

    public function getBilling($gb)
    {
        $this->db->select('fk_prof_id');
        $this->db->from($this->table);
        $this->db->group_by($gb);

        $query = $this->db->get();
        return $query->result();
    }
}
?>