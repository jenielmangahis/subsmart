<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailLogs_model extends MY_Model
{
    public $table = 'email_logs';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file EmailLogs_model.php */
/* Location: ./application/models/EmailLogs_model.php */
