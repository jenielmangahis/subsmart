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
}



/* End of file Items_model.php */

/* Location: ./application/models/Items_model.php */