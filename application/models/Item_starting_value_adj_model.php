<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item_starting_value_adj_model extends MY_Model
{
    public $table = 'accounting_item_starting_value_adjustment';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_by_item_id($item_id)
    {
        $this->db->where('item_id', $item_id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update($this->table, $data);
        return $query ? true : false;
    }

    public function get_by_id($id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}

/* End of file Item_starting_value_adj_model.php */

/* Location: ./application/models/Item_starting_value_adj_model.php */