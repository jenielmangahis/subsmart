<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feeds_model extends MY_Model {

	public $table = 'feed';
        private $bulletin = 'news';
	
	public function __construct()
	{
		parent::__construct();
    }
    
    function saveNewsLetter($details)
    {
        if($this->db->insert($this->bulletin, $details)):
            return true;
        else:
            return false;
        endif;
    }
    
    function saveFeeds($details)
    {
        if($this->db->insert($this->table, $details)):
            return true;
        else:
            return false;
        endif;
    }

    function getByCompanyId() {
        $comp_id = logged('company_id');

        $this->db->select("*");
        $this->db->where('sender_id', $comp_id);
        $res = $this->db->get($this->table)->result();
        
        return $res;
    }

    public function getAllNewsLetterByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->bulletin);        
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', "DESC");
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getNewsById($id)
    {
        $this->db->from($this->bulletin);
        $this->db->select('*');
        $this->db->where("id", $id);
        
        $query = $this->db->get();
        return $query->row();
    }
}