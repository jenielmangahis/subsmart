<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailBlastSendTo_model extends MY_Model
{

    public $table = 'email_blast_send_to';


    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompany($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByEmailBlastId($email_blast_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('email_blast_id', $email_blast_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteAllByEmailBlastId($email_blast_id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('email_blast_id' => $email_blast_id));
    }
}

/* End of file EmailBlastSendTo_model.php */
/* Location: ./application/models/EmailBlastSendTo_model.php */
