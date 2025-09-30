<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_notification_model extends MY_Model
{
    public $table = 'user_notification';

    public function getAllByUserCompanyId($user_id, $cid)
    {        
        $this->db->select('user_notification.*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->result();
    }



}

/* End of file Invoice_model.php */
/* Location: ./application/models/invoice_model.php */
