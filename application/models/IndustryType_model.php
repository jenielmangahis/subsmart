<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndustryType_model extends MY_Model
{
    public $table = 'industry_type';
    public $status_active   = 1;
    public $status_inactive = 0;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }

            if( !empty($filters['limit_perpage']) && !empty($filters['offset']) ){
                $this->db->limit($filters['limit_perpage'], $filters['offset']);
            }
        }


        $this->db->order_by('business_type_name', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllActive($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->where('status', 1);

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByName($name)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('name', $name);

        $query = $this->db->get()->row();
        return $query;
    }

  
    public function updateIndustryType($industryType_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $industryType_id);
        $this->db->update();
    }

    public function deleteIndustryType($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function isActive()
    {
        return $this->status_active;
    }

    public function isInactive()
    {
        return $this->status_inactive;
    }

    public function countAllRecords()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $total_records = $this->db->count_all_results();

        return $total_records;
    }

}

/* End of file IndustryType_model.php */
/* Location: ./application/models/IndustryType_model.php */
