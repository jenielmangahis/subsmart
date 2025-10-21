<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsCustomerDocument_model extends MY_Model
{
    public $table = 'acs_customer_documents';

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllByCustomerId($customer_id, $sort = [], $filters = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        
        if( $filters ){
            foreach( $filters as $filter ){
                $this->db->where($filter['field'], $filter['value']);
            }
        }
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('id', 'DESC');
        }

        return $this->db->get()->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);        

        $query = $this->db->get();
        return $query->row();
    } 
    
    public function getAllByCustomerIdAndDocumentType($customer_id, $document_type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);        
        $this->db->where('document_type', $document_type);        

        return $this->db->get()->result();
    } 
}
/* End of file AcsCustomerDocument_model.php */
/* Location: ./application/models/AcsCustomerDocument_model.php */
