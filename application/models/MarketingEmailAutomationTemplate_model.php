<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MarketingEmailAutomationTemplate_model extends MY_Model
{
    public $table = 'email_automation_template';
    public $is_active = 1;

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }  

    public function getAllByCompanyId($company_id, $filters=array())
    {

        $this->db->select('email_automation_template.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'email_automation_template.user_id = users.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }  

    public function getByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query;
    }

    public function getById($id)
    {
        $this->db->select('email_automation_template.*, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'email_automation_template.user_id = users.id', 'LEFT');

        $this->db->where('email_automation_template.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        $last_id = $this->db->insert_id();

        return  $last_id;
    }

    public function delete($id)
    {
        $user_id = logged('id');
        $this->db->delete($this->table, array('user_id' => $user_id, 'id' => $id));
    } 

    public function isActive()
    {
        return $this->is_active;
    } 

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }    

}

/* End of file BookingCoupon_model.php */
/* Location: ./application/models/BookingCoupon_model.php */
