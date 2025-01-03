<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lead_model extends MY_Model
{
    public $table = 'ac_leads';

    public function getAll($filters= [])
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            foreach($filters as $f){
                $this->db->where($f['field_name'], $f['field_value']);
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $filters = [])
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if ( !empty($filters) ) {
            foreach($filters as $f){
                $this->db->where($f['field_name'], $f['field_value']);
            }
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }
}
/* End of file Lead_model.php */
/* Location: ./application/models/Lead_model.php */

