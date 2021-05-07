<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DealsSteals_model extends MY_Model
{
    public $table = 'deals_steals';

    public $is_active = 1;
    public $is_inactive = 0;

    public $status_draft  = 0;
    public $status_active = 1;
    public $status_scheduled = 2;
    public $status_ended = 3;

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

    public function getAllByCompanyId($company_id, $filters=array(), $conditions=array())
    {

        $this->db->select('deals_steals.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'deals_steals.user_id = users.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $field => $value ){
                $this->db->where($field, $value);                
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

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }


    public function getById($id)
    {
        $this->db->select('deals_steals.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'deals_steals.user_id = users.id', 'LEFT');

        $this->db->where('deals_steals.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function isActive(){
        return $this->is_active;
    }

    public function isInactive(){
        return $this->is_inactive;
    }

    public function optionsIsActive(){
        $option = [
            $this->is_active => 'Active',
            $this->is_inactive => 'Inactive',
        ];

        return $option;
    }

    public function updateDealsSteals($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function dealStealPrice()
    {
        return 10;
    }

    public function statusDraft(){
        return $this->status_draft;
    }

    public function statusScheduled(){
        return $this->status_scheduled;
    }

    public function statusEnded(){
        return $this->status_ended;
    }

    public function statusActive(){
        return $this->status_active;
    }

    public function statusOptions(){
        $options = [
            $this->status_active => 'Active',
            $this->status_draft => 'Draft',
            $this->status_scheduled => 'Scheduled',
            $this->status_ended => 'Ended'
        ];

        return $options;
    }

}

/* End of file DealsSteals_model.php */
/* Location: ./application/models/DealsSteals_model.php */
