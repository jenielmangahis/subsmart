<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Serversidetable_model extends MY_Model {

    private $table;
    private $column_order;
    private $column_search;
    private $order;
    private $where;

    public function initializeTable($table, $column_order = array(), $column_search = array(), $order, $where = array()) 
    {
        $this->table = $table;
        $this->column_order = $column_order;
        $this->column_search = $column_search;
        $this->order = $order;
        $this->where = $where;
    }

    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function countAll()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData)
    {
        $this->db->from($this->table);

        if (!empty($this->where)) {
            foreach ($this->where as $key => $value) {
                if (is_array($value)) {
                    $this->db->where_in($key, $value);
                } else {
                    $this->db->where($key, $value);
                }
            }
        }

        $searchValue = trim($postData['search']['value'] ?? '');
        if ($searchValue !== '') {

            $keywords = preg_split('/\s+/', $searchValue);

            $this->db->group_start();

            foreach ($keywords as $word) {
                $this->db->group_start();

                $i = 0;
                foreach ($this->column_search as $item) {
                    if ($i === 0) {
                        $this->db->like($item, $word);
                    } else {
                        $this->db->or_like($item, $word);
                    }
                    $i++;
                }

                $this->db->group_end();
            }

            $this->db->group_end();
        }

        if (!empty($postData['columns'])) {
            foreach ($postData['columns'] as $colIndex => $col) {
                if (!empty($col['search']['value'])) {
                    $this->db->like($this->column_order[$colIndex], $col['search']['value']);
                }
            }
        }

        if (isset($postData['order'])) {
            $colIndex = $postData['order'][0]['column'];
            $dir = $postData['order'][0]['dir'];
            $this->db->order_by($this->column_order[$colIndex], $dir);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

}
