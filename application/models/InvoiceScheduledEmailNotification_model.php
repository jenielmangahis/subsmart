<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InvoiceScheduledEmailNotification_model extends MY_Model
{
    public $table = 'invoice_scheduled_email_notifications';

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotSent($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_sent', 0);
        $this->db->where('is_with_error', 0);
        $this->db->order_by('id', 'ASC');

        if( $limit > 0 ){
            $this->db->limit($limit);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllTodayNotSent($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_sent', 0);
        $this->db->where('is_with_error', 0);
        $this->db->where('send_date', date("Y-m-d"));
        $this->db->order_by('id', 'ASC');

        if( $limit > 0 ){
            $this->db->limit($limit);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {        

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file InvoiceScheduledEmailNotification_model.php */
/* Location: ./application/models/InvoiceScheduledEmailNotification_model.php */
