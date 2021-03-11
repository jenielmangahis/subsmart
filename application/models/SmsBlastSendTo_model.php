<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmsBlastSendTo_model extends MY_Model
{

    public $table = 'sms_blast_send_to';


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

    public function getAllByCompany($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllBySmsBlastId($sms_blast_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('sms_blast_id', $sms_blast_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteAllBySmsBlastId($sms_blast_id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('sms_blast_id' => $sms_blast_id));
    }
}

/* End of file SmsBlastSendTo_model.php */
/* Location: ./application/models/SmsBlastSendTo_model.php */
