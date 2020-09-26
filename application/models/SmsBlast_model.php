<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmsBlast_model extends MY_Model
{
    public $table = 'sms_blast';

    public $stype_all_contacts    = 0;
    public $stype_contact_group   = 1;
    public $stype_certain_contact = 2;

    public $ctype_both = 1;
    public $ctype_residential = 2;
    public $ctype_commercial  = 3;
    public $ctype_na = 0;

    public $status_draft  = 0;
    public $status_active = 1;
   
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

    

    public function getById($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    
    public function deleteSmsBlast($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function statusOptions(){
        $options = [
            $this->status_active => 'Active',
            $this->status_draft => 'Draft'
        ];

        return $options;
    }

    public function statusDraft(){
        return $this->status_draft;
    }

    public function sendingTypeAll(){
        return $this->stype_all_contacts;
    }

    public function customerTypeResidential(){
        return $this->ctype_residential;
    }

}

/* End of file SmsBlast_model.php */
/* Location: ./application/models/SmsBlast_model.php */
