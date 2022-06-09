<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RingCentralSmsLogs_model extends MY_Model
{
    public $table = 'ring_central_sms_logs';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);        

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('from_number', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanySmsId($company_sms_id, $filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);        

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('from_number', $filters['search'], 'both');
            }
        }

        $this->db->where('company_sms_id', $company_sms_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file RingCentralSmsLogs_model.php */
/* Location: ./application/models/RingCentralSmsLogs_model.php */
