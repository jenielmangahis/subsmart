<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ItemCategory_model extends MY_Model
{
    public $table = 'item_categories';


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
        $this->db->where('item_categories_id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('item_categories_id', $id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function updateItemCategory($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('item_categories_id', $id);
        $this->db->update();
    }

    public function deleteByItemCategoryId($item_categories_id){
        $this->db->delete($this->table, array('item_categories_id' => $item_categories_id));
    } 
}



/* End of file Vendor_model.php */

/* Location: ./application/models/Vendor_model.php */
