<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EstimateItem_model extends MY_Model
{

    public $table = 'estimates_items';

    public function getAllByEstimateId($estimate_id)
    {

        $this->db->select('estimates_items.*,items.title,items.id,items.description');
        $this->db->from($this->table);
        $this->db->join('items', 'estimates_items.items_id = items.id');
        $this->db->where('estimates_id', $estimate_id);

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file EstimateItem_model.php */
/* Location: ./application/models/EstimateItem_model.php */
