<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PriorityList_model extends MY_Model
{
    public $table = 'priority_list';


    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', getLoggedUserID());
        $query = $this->db->get();

        return $query->result();
    }

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByTitleAndCompanyId($title, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('title', $title);
        $this->db->where('company_id', $cid);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file PriorityList_model.php */
/* Location: ./application/models/PriorityList_model.php */
