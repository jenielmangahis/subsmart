<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contacts_model extends MY_Model
{
    public $table = 'contacts';
   
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

    public function getAllByCompanyId($company_id)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCustomerId($customer_id, $limit = 0)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        $this->db->order_by('id', 'ASC');
        
        if( $limit > 0 ){
            $this->db->limit($limit);
        }

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

    public function delete($id){
        $user_id = logged('id');
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function optionRelations(){
        $relationships = [
            "Mother",
            "Father",
            "Daughter",
            "Son",
            "Sister",
            "Spouse",
            "Brother",
            "Aunt",
            "Uncle",
            "Niece",
            "Nephew",
            "Cousin",
            "Grandmother",
            "Grandfather",
            "Granddaughter",
            "Grandson",
            "Stepsister",
            "Stepbrother",
            "Stepmother",
            "Stepfather",
            "Stepdaughter",
            "Stepson",
            "Sister-in-law",
            "Brother-in-law",
            "Mother-in-law",
            "Father-in-law",
            "Daughter-in-law",
            "Son-in-law",
            "Coworker",
          ];

          return $relationships;
    }
}

/* End of file Contacts_model.php */
/* Location: ./application/models/Contacts_model.php */
