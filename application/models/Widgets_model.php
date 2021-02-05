<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets_model extends MY_Model {
    
    function getWidgetByID($id)
    {
        $this->db->where('w_id', $id);
        return $this->db->get('widgets')->row();
    }
    
    function removeWidget($id, $user_id)
    {
        $this->db->where('wu_widget_id', $id);
        $this->db->where('wu_user_id', $user_id);
        if($this->db->delete('widgets_users')):
            return true;
        else:
            return false;
        endif;
    }

    function addWidgets($details)
    {
        if($this->db->insert('widgets_users', $details)):
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
        $company_id = getLoggedCompanyID();
        $this->db->join('widgets','widgets_users.wu_widget_id = widgets.w_id','left');
        $this->db->where('wu_user_id', $user_id);
        $this->db->order_by('wu_order', 'ASC');
        $q1 = $this->db->get('widgets_users')->result();
        
        $this->db->join('widgets','widgets_users.wu_widget_id = widgets.w_id','left');
        $this->db->where('wu_company_id', $company_id);
        $this->db->order_by('wu_order', 'ASC');
        $q2 = $this->db->get('widgets_users')->result();
        
        $details =  array_unique(array_merge($q1,$q2), SORT_REGULAR);
        
        return $details;
        
    }

}
