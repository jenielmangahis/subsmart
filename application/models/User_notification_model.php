<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_notification_model extends MY_Model
{
    public $table = 'user_notification';

    public function getAllByUserCompanyIdStatus($company_id, $user_id, $status = null)
    {        
        $limit = 100;

        $this->db->select('user_notification.*, users.FName, users.MName, users.LName, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'user_notification.user_id = users.id', 'left');
        $this->db->where('user_notification.user_id', $user_id);
        $this->db->where('user_notification.company_id', $company_id);

        if($status != null) {
            $this->db->where('user_notification.status', $status);
        }

        $this->db->order_by('user_notification.date_created', 'desc');

        if($limit > 0) {
            $this->db->limit($limit);
        }
        
        $query = $this->db->get();
        return $query->result();
    }    

    public function get_notifications($company_id, $user_id, $status = 1) //Note: 1=unread,0=read
    {
        $limit = 100;
        $this->db->reset_query();
        
        $date = date_create(date("Y-m-d H:i:s"));
        date_sub($date, date_interval_create_from_date_string("2 days"));
        $date_2days_ago = date_format($date, "Y-m-d H:i:s");

        $and_query = "";
        // $query = $this->db->query(
        //     "SELECT * from users as u JOIN user_notification ON u.id = user_notification.user_id 
        //     where user_notification.company_id = " . $company_id . " AND user_notification.status = " . $status . " 
        //     AND user_notification.date_created >= '" . $date_2days_ago . "' " . $and_query . " 
        //     order by user_notification.date_created Desc limit " . $limit);

        $query = $this->db->query(
            "SELECT * from users as u JOIN user_notification ON u.id = user_notification.user_id 
            where user_notification.company_id = " . $company_id . " AND user_notification.status = " . $status . "  
            order by user_notification.date_created Desc limit " . $limit);

        return $query->result();
    }        

    public function readAllByCompanyId($company_id = null) {
        $return = false;
        if($company_id != null) {
            $update = array(
                'status' => 0
            );
            $this->db->where('company_id', $company_id);
            $this->db->update('user_notification', $update);
            $return = true;
        }
        
        return $return;
    }

    public function readNotificationByIdEntityId($id, $entity_id) {
        $return = false;
        if($id != null) {
            $update = array(
                'status' => 0
            );
            $this->db->where('id', $id);

            if($entity_id != null) {
                $this->db->where('entity_id', $entity_id);
            }
            
            $this->db->update('user_notification', $update);
            $return = true;
        }

        return $return;        
    }

}

/* End of file Invoice_model.php */
/* Location: ./application/models/invoice_model.php */
