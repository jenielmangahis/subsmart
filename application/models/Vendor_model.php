<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vendor_model extends MY_Model
{
    public $table = 'vendor';


    public function getAllByCompanyId($company_id)
    {        
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {

        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('vendor_id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('vendor_id', $id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function updateVendor($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('vendor_id', $id);
        $this->db->update();
    }

    public function deleteByVendorId($vendor_id){
        $this->db->delete($this->table, array('vendor_id' => $vendor_id));
    } 
}



/* End of file Vendor_model.php */

/* Location: ./application/models/Vendor_model.php */
