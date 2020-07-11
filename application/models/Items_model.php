<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends MY_Model
{
    public $table = 'items';
    public $table_categories = 'item_categories';
    public $table_invoice = 'invoice_has_items';

    public function __construct()
    {
        parent::__construct();
    }

    public function filterBy($filters = array(), $company_id, $type)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('type', $type);

        if (!empty($filters)) {

            if (isset($filters['category'])) {
                $this->db->group_start();
                $this->db->where('item_categories_id', $filters['category']);
                $this->db->group_end();
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    function getRows($params = array()) {
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('id', 'desc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }

    public function insert($data = array()) {
        if(!empty($data)){     

            $insert = $this->db->insert($this->table, $data);
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }

    public function update($data, $condition = array()) {
        if(!empty($data)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, $condition);
            
            // Return the status
            return $update?true:false;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function delete($id)
    {
        $this->db->delete($this->table, array("id" => $id));
    }
    
}



/* End of file Items_model.php */

/* Location: ./application/models/Items_model.php */