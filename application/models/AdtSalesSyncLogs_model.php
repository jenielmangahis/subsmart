<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdtSalesSyncLogs_model extends MY_Model
{    
    public $table = 'adt_sales_sync_logs';


    public function getAll($filters=array())
    {
        $this->db->select('adt_sales_sync_logs.*, business_profile.business_name');
        $this->db->from($this->table);
        $this->db->join('business_profile', 'adt_sales_sync_logs.company_id = business_profile.company_id', 'left');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('business_profile.business_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('adt_sales_sync_logs.id', 'DESC');

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
}

/* End of file AdtSalesSyncLogs_model.php */
/* Location: ./application/models/AdtSalesSyncLogs_model.php */
