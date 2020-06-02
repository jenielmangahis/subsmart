<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends MY_Model
{
    public $table = 'items';
    public $table_categories = 'item_categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function filterBy($filters = array(), $company_id = 0)
    {

        $this->db->select('*');
        $this->db->from($this->table);

        if (!empty($filters)) {

            if (isset($filters['search'])) {
                $this->db->group_start();
                $this->db->or_like('title', $filters['search']);
                $this->db->or_like('price', $filters['search']);
                $this->db->or_like('discount', $filters['search']);
                $this->db->group_end();
            }
        }

        $query = $this->db->get();
        return $query->result();
    }
}



/* End of file Items_model.php */

/* Location: ./application/models/Items_model.php */