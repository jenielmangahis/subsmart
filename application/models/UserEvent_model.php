<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserEvent_model extends MY_Model
{

    public $table = 'user_events';


    public function getByEventId($event_id) {

        $this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('event_id', $event_id);

		$query = $this->db->get();			
		return $query->result();
    }
}
