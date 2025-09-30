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

    public function get_notifications($company_id, $user_id, $status = 1) //Note: 1=unread,0=read
    {
        $this->db->reset_query();
        
        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date, date_interval_create_from_date_string("2 days"));
        $date_2days_ago = date_format($date, "Y-m-d H:i:s");

        $and_query = "";
        $query = $this->db->query(
            "SELECT * from users as u JOIN user_notification ON u.id = user_notification.user_id 
            where user_notification.company_id = " . $company_id . " AND user_notification.status = " . $status . " 
            AND user_notification.user_id = " . $user_id . "
            and user_notification.date_created >= '" . $date_2days_ago . "' " . $and_query . " 
            order by user_notification.date_created Desc");

        return $query->result();
    }    



}

/* End of file Invoice_model.php */
/* Location: ./application/models/invoice_model.php */
