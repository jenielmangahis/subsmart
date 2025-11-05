<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsNote_model extends MY_Model
{
    public $table = 'acs_notes';
    
    public function getAllByCustomerId($customer_id, $filters=[])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('fk_prof_id', $customer_id);

        if ( !empty($filters) ) {
            $this->db->group_start();
            foreach( $filters as $filter ){
                if( $filter['value'] != '' ){
                    $this->db->like($filter['field'], $filter['value'], 'both');  
                }                
            }
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file AcsNote_model.php */
/* Location: ./application/models/AcsNote_model.php */
