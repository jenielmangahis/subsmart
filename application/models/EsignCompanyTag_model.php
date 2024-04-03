<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EsignCompanyTag_model extends MY_Model {
    
    public $table = 'esign_company_tags';

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);                
        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getAllByTagSectionId($tsid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('esign_company_tag_section_id', $tsid);                
        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getAllNotDeletedByTagSectionId($tag_section_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('esign_company_tag_section_id', $tag_section_id);                
        $this->db->where('is_deleted', 0);                
        $this->db->order_by('id', 'DESC');

        return $this->db->get()->result();

    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);         
        $query = $this->db->get()->row();
        return $query;
    }

    public function getByTagName($tag_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('tag_name', $tag_name);         
        $query = $this->db->get()->row();
        return $query;
    }

    public function deleteAllByTagSectionId($tag_section_id)
    {
        $this->db->delete($this->table, array("esign_company_tag_section_id" => $tag_section_id));
    }
}
