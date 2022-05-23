<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 1/11/2021
 * Time: 7:27 PM
 */

class General_model extends MY_Model {

    public function get_all_with_keys($params = array(),$tablename,$result=TRUE){
        $this->db->select('*');
        $this->db->from($tablename);

        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        $query = $this->db->get();
        if($result){
            return $query->result();
        }else{
            return $query->row();
        }
    }

    public function update_with_key($input, $id,$table)
    {
        //$input['date_modified'] = date('Y-m-d H:i:s');;
        if ($this->db->update($table, $input, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function update_with_key_field($input, $id,$table,$field)
    {
        //$input['date_modified'] = date('Y-m-d H:i:s');;
        if ($this->db->update($table, $input, array($field => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function add_($input,$table)
    {
        if($this->db->insert($table,$input)){
            return true;
        }else{
            return false;
        }
    }
}