<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets_model extends MY_Model {

    function addWidgets($details)
    {
        if($this->db->insert_batch('widgets_users', $details)):
            return true;
        else:
            return false;
        endif;
    }
    
    function getWidgetsList($user_id)
    {
//        $query = "Select * FROM widgets WHERE NOT EXISTS(SELECT * FROM widgets_users WHERE widgets.w_id = widgets_users.wu_widget_id AND wu_user_id = $user_id)";
//        return $this->db->query($query)->result();
        return $this->db->get('widgets')->result();
    }
    
    function getWidgetListPerUser($user_id)
    {
        $this->db->join('widgets','widgets_users.wu_widget_id = widgets.w_id','left');
        $this->db->where('wu_user_id', $user_id);
        $this->db->order_by('wu_order', 'ASC');
        return $this->db->get('widgets_users')->result();
    }

}
