<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Before_after_model extends MY_Model
{
    public $table = 'before_after';
    
    public function getAllByCompanyId($company_id)
    {
        $this->db->select('before_after.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id,acs_profile.email');
        $this->db->from($this->table);
        $this->db->join('users', 'before_after.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'before_after.customer_id = acs_profile.prof_id', 'LEFT');        
        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return array
     */
    public function getAll()
    {

        $this->db->select('before_after.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id');
        $this->db->join('users', 'before_after.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'before_after.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function updateBeforeAfter($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update($this->table,$data);
    }

    /**
     * @return mixed
     */
    public function deleteBeforeAfter($id)
    {
        //$this->db->delete($this->table, array("group_number" => $id));
        $this->db->delete($this->table, array("id" => $id));
    }

    public function getById($id)
    {

        $this->db->select('before_after.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id');
        $this->db->join('users', 'before_after.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'before_after.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->from($this->table);
        $this->db->where('before_after.id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $cid)
    {

        $this->db->select('before_after.*, users.id AS uid, users.company_id,acs_profile.first_name,acs_profile.last_name,acs_profile.prof_id');
        $this->db->join('users', 'before_after.user_id = users.id', 'LEFT');
        $this->db->join('acs_profile', 'before_after.customer_id = acs_profile.prof_id', 'LEFT');
        $this->db->from($this->table);
        $this->db->where('before_after.id', $id);
        $this->db->where('before_after.company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file Before_after_model.php */
/* Location: ./application/models/Before_after_model.php */
