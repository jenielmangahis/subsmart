<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmsBlastSetting_model extends MY_Model
{

    public $table = 'sms_blast_settings';


    public function getAll()
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');

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
}

/* End of file SmsBlastSetting_model.php */
/* Location: ./application/models/SmsBlastSetting_model.php */
