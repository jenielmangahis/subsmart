<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NsmartFeature_model extends MY_Model
{
    public $table = 'nsmart_features';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function isFeatureNameExists($feature_name)
    {
        $is_exists = false;

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('feature_name', $feature_name);

        $query = $this->db->get()->row();
        if( $query ){
            $is_exists = true;
        }

        return $is_exists;
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();

        return  $last_id;
    }

    public function updateFeature($plan_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $plan_id);
        $this->db->update();
    }
}

/* End of file NsmartFeature_model.php */
/* Location: ./application/models/NsmartFeature_model.php */
