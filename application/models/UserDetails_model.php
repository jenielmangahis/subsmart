<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserDetails_model extends MY_Model{
    public $table = 'user_details';

    public function add($input)
    {
        if ($this->db->insert($this->table, $input)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function update($input, $id)
    {
        if ($this->db->update($this->table, $input, array('user_id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function check_if_exist($key)
    {
        $query = $this->db->get_where($this->table, array('user_id' => $key,'api_gc_enable' => 1), 1);
        if($query){
            return $query->row();
        }else{
            return false;
        }
    }


}