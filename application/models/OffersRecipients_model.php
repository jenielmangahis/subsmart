<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OffersRecipients_model extends MY_Model
{
    public $table = 'offers_recipients';
   

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateOffersRecipients($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function deleteOffersRecipients($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 
}

/* End of file OffersRecipients_model.php */
/* Location: ./application/models/OffersRecipients_model.php */
