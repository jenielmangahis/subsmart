<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SmsBlast_model extends MY_Model
{
    public $table = 'sms_blast';

    public $stype_all_contacts    = 1;
    public $stype_contact_group   = 2;
    public $stype_certain_contact = 3;

    public $ctype_both = 1;
    public $ctype_residential = 2;
    public $ctype_commercial  = 3;
    public $ctype_na = 0;

    public $status_draft  = 0;
    public $status_active = 1;
    public $status_scheduled = 2;
    public $status_closed = 3;
   
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

    public function getAllByCompanyId($company_id, $filters=array(), $conditions=array())
    {

        $this->db->select('sms_blast.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'sms_blast.user_id = users.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('sms_blast.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'sms_blast.user_id = users.id', 'LEFT');

        $this->db->where('sms_blast.id', $id);

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
            $this->status_draft => 'Draft',
            $this->status_scheduled => 'Scheduled',
            $this->status_closed => 'Closed'
        ];

        return $options;
    }

    public function statusDraft(){
        return $this->status_draft;
    }

    public function statusScheduled(){
        return $this->status_scheduled;
    }

    public function statusClosed(){
        return $this->status_closed;
    }

    public function statusActive(){
        return $this->status_active;
    }

    public function sendingTypeAll(){
        return $this->stype_all_contacts;
    }

    public function customerTypeResidential(){
        return $this->ctype_residential;
    }

    public function updateSmsBlast($sms_blast_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $sms_blast_id);
        $this->db->update();
    }

    public function getServicePrice(){
        return 5;
    }

    public function getPricePerSms(){
        return 0.05;
    }

    public function sendToOptions(){
        $options = [
            $this->stype_all_contacts => 'All Contacts',
            $this->stype_certain_contact => 'Certain Contacts',
            $this->stype_contact_group => 'Contact Groups'
        ];

        return $options;
    }

    public function isPaid(){
        return 1;
    }

}

/* End of file SmsBlast_model.php */
/* Location: ./application/models/SmsBlast_model.php */
