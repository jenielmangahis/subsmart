<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Demo_model extends MY_Model
{
    public $table = 'demo_schedule';

    public function getlist(){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('created_at','desc');

        $query = $this->db->get();
        return $query->result();
    }


}
  
