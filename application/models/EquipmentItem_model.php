<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EquipmentItem_model extends MY_Model
{
    public $table = 'equipment_items';

    /**
     * @param $equipment_id
     * @param array $filters
     * @return mixed
     */
    public function getAll($equipment_id, $filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }


    /**
     * @param $equipment_id
     */
    public function countItems($equipment_id) {

        $this->db->where('equipment_id', $equipment_id);
        $query = $this->db->get($this->table);

        return $query->num_rows();
    }
}

/* End of file EquipmentItem_model.php */
/* Location: ./application/models/EquipmentItem_model.php */
