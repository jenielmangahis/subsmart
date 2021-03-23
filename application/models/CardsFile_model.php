<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CardsFile_model extends MY_Model
{
    public $table = 'cards_file';

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

        $this->db->select('*');
        $this->db->from($this->table);
        
        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('card_owner_name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->where('company_id', $company_id);

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

    
    public function deleteCard($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function updateCardsFile($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function companyResetAllprimaryCard($company_id)
    {
        $this->db->from($this->table);
        $this->db->set(['is_primary' => 0]);
        $this->db->where('company_id', $company_id);
        $this->db->update();
    }
}

/* End of file CardsFile_model.php */
/* Location: ./application/models/CardsFile_model.php */
