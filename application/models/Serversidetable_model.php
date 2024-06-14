<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serversidetable_model extends MY_Model {

    private $table;
    private $column_order;
    private $column_search;
    private $order;
    private $where; // Added $where property

    public function initializeTable($table, $column_order = array(), $column_search = array(), $order, $where = array()) 
    {
        $this->table = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
        $this->where = $where; // Set $where property
    }

    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for a server-side processing request
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData)
    {
        $this->db->from($this->table);

        // Apply the where condition if it is set
        if (!empty($this->where)) {
            $this->db->where($this->where);
        }
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable sends POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }

        // Apply column-specific search
        foreach ($postData['columns'] as $colIndex => $col) {
            if (!empty($col['search']['value'])) {
                $this->db->like($this->column_order[$colIndex], $col['search']['value']);
            }
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}
