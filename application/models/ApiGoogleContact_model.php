<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiGoogleContact_model extends MY_Model {

    public $table = 'api_tool_gc';

    public function __construct()
    {
        parent::__construct();
    }

    public function add($input)
    {
        if ($this->db->insert($this->table, $input)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function check_if_exist($key)
    {
        $query = $this->db->get_where($this->table, array('contact_email' => $key), 1);
        if($query){
            return $query->row();
        }else{
            return false;
        }
    }

    public function get_all()
    {
        $this->db->order_by('id','DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

}

/* End of file Activity_model.php */
/* Location: ./application/models/Activity_model.php */