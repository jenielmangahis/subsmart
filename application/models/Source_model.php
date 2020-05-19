<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Source_model extends MY_Model
{
    public $table = 'sources';

    public function getAll($filters)
    {

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {

            if ( !empty($filters['q']) ) {

                $this->db->like('source_name', $filters['q'], 'both');
            }
        }

        $this->db->order_by('source_name');

        $query = $this->db->get();
        return $query->result();
    }


    public function getSource($source_id) {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $source_id);

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file Source_model.php */
/* Location: ./application/models/Source_model.php */
