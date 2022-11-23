<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ColorSettings_model extends MY_Model
{
    public $table = 'color_settings';
    public $status_active   = 1;
    public $status_inactive = 0;
    public $discount_percent = 1;
    public $discount_amount   = 0;

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

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

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

    public function getByCompanyIdAndColorName($company_id, $color_name)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);
        $this->db->like('color_name', $color_name, 'both'); 

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateColorSettingById($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function deleteColorById($id){
        $this->db->delete($this->table, array('id' => $id));
    } 

    public function deleteAllByCompanyId($company_id){
        $this->db->delete($this->table, array('company_id' => $company_id));
    } 

}

/* End of file ColorSettings_model.php */
/* Location: ./application/models/ColorSettings_model.php */
