<?php

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
    public function check_if_exist($elem = array(), $resutl=true){
        
    }

    public function get_data_with_param($params = array(),$result=TRUE)
    {

        if(array_key_exists("table",$params) && $params['table'] != NULL ){
            $this->db->from($params['table']);
        }else{
            return FALSE;
        }

        if(array_key_exists("select",$params) && $params['select'] != NULL ){
            $this->db->select($params['select']);
        }else{
            $this->db->select('*');
        }

        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                if( $val != '' ){
                    $this->db->where($key, $val);    
                }else{
                    if( $val == 0 ){
                        $this->db->where($key, $val);  
                    }else{
                        $this->db->where($key); 
                    }
                }
                
            }
        }

        if(array_key_exists("or_where", $params)){
            foreach($params['or_where'] as $key => $val){
                if( $val != '' ){
                    $this->db->or_where($key, $val);    
                }else{
                    if( $val == 0 ){
                        $this->db->or_where($key, $val);  
                    }else{
                        $this->db->or_where($key); 
                    }
                }
                
            }
        }
        if (array_key_exists("join", $params)) {
            if (is_array($params['join'][0])) {
                foreach ($params['join'] as $join) {
                    $this->db->join($join['table'], $join['statement'], $join['join_as']);
                }
            } else {
                $this->db->join($params['join']['table'], $params['join']['statement'], $params['join']['join_as']);
            }
        }

        if(array_key_exists("order",$params)){
            if(isset($params['order']['ordering'])){
                $this->db->order_by($params['order']['order_by'], $params['order']['ordering']);
            }else{
                $this->db->order_by($params['order']['order_by'], "DESC");
            }
        }

        if(array_key_exists("distinct",$params) && $params['distinct'] == true ){
            $this->db->distinct();
        }

        if(array_key_exists("limit", $params)){
            $this->db->limit($params['limit']);
        }
        
        if (array_key_exists("groupBy", $params)) {
            $this->db->group_by($params['groupBy']);
        }
    
       // $this->db->where('prof_id', $params['where']['prof_id']);
        $query = $this->db->get();
        if($result){
            return $query->result();
        } else{
            return $query->row();
        }
    }

    public function get_business_name($val){
        
    }

    public function get_column_sum($params = array())
    {

        if(array_key_exists("table",$params) && $params['table'] != NULL ){
            $this->db->from($params['table']);
        }else{
            return FALSE;
        }

        if(array_key_exists("select",$params) && $params['select'] != NULL ){
            $this->db->select($params['select']);
        }else{
            $this->db->select('*');
        }

        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        if(array_key_exists("group_by",$params) && $params['group_by'] != NULL ){
            $this->db->group_by($params['group_by']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function delete_($params = array()) {
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        // Execute delete.
        if ($this->db->delete($params['table']))
            return true;
        else
            return false;
    }

    public function update_with_key($input, $id,$table)
    {
        $update = $this->db->update($table, $input, array('id' => $id)) ? true : false;
        return $update;
    }

    public function update_with_key_field($input, $id, $table, $field)
    {
        if(empty($field)){
            return $this->db->update($table, $input, array('id' => $id)) ? true : false;
        }else{
            return  $this->db->update($table, $input, array($field => $id)) ? true : false;
        }
    }
    public function update_job_items($input, $where){
        $this->db->where('job_id', $where['job_id']);
        $this->db->where('items_id', $where['items_id']);
        $this->db->update('job_items', $input);
    }

    public function add_($input,$table)
    {
        if($this->db->insert($table,$input)){
            return true;
        }else{
            return false;
        }
    }

    public function add_return_id($input,$table)
    {
        
        $query = $this->db->insert($table,$input);
        if($query){
            $id = $this->db->insert_id();
            return $id;
        }else{
            return false;
        }
    }
}
