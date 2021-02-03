<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets_model extends MY_Model {

    function getWidgetsList()
    {
        return $this->db->get('widgets')->result();
    }
    
    function getWidgetListPerUser($user_id)
    {
        $this->db->join('widgets','widgets_users.wu_widget_id = widgets.w_id','left');
        $this->db->where('wu_user_id', $user_id);
        return $this->db->get('widgets_users')->result();
    }

}
