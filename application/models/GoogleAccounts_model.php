<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GoogleAccounts_model extends MY_Model
{
    public $table = 'google_accounts';
    public $status_active = 1;
    public $status_closed = 0;

    public function getAll()
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
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

    public function getByAuthUser()
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);

        $query = $this->db->get()->row();
        return $query;
    }   

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }    

    public function deleteByUserId($user_id){

        $this->db->delete($this->table, array('user_id' => $user_id));

    }

    public function deleteByCompanyId($company_id){

        $this->db->delete($this->table, array('company_id' => $company_id));

    }

    public function getDefaultAutoSyncCalendarName(){
        $calendar_name = 'NsmarTrac';
        return $calendar_name;
    }
}

/* End of file GoogleAccounts_model.php */
/* Location: ./application/models/GoogleAccounts_model.php */
