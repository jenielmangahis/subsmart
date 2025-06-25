<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LeadType_model extends MY_Model
{
    public $table = 'ac_leadtypes';

    public function getAllByCompanyId($company_id, $sort = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('company_id', $company_id);
        
        if( $sort ){
            $this->db->order_by($sort['field'], $sort['order']);
        }else{
            $this->db->order_by('lead_id', 'DESC');
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

    public function getByIdAndCompanyId($id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('lead_id', $id);     
        $this->db->where('company_id', $company_id);  

        $query = $this->db->get();
        return $query->row();
    }  

    public function deleteById($id){
        $this->db->delete($this->table, array('lead_id' => $id));
    } 

}
/* End of file LeadType_model.php */
/* Location: ./application/models/LeadType_model.php */

