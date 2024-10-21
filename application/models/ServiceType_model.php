<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ServiceType_model extends MY_Model
{
    public $table = 'service_type';

    public function getAllByCompanyId($cid, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getByServiceNameAndCompanyId($service_name, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('service_name', $service_name);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

}

/* End of file ServiceType_model.php */
/* Location: ./application/models/ServiceType_model.php */
