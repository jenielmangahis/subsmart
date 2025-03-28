<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserDocfile_model extends MY_Model
{
    public $table = 'user_docfile';

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');

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

    public function getByTicketId($ticket_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('ticket_id', $ticket_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByJobId($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('job_id', $job_id);

        $query = $this->db->get()->row();
        return $query;
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

    public function getByCustomerIdAndCompanyId($customer_id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByCompanyIdAndFieldName($cid, $field_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('field_name', $field_name);

        $query = $this->db->get()->row();
        return $query;
    }

}

/* End of file UserDocfile_model.php */
/* Location: ./application/models/UserDocfile_model.php */
