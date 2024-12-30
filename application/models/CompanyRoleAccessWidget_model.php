<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyRoleAccessWidget_model extends MY_Model
{
    public $table = 'company_role_access_widgets';

    public function getAll($filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('offer_code', $filters['search'], 'both');
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

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyIdAndRoleId($cid, $role_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('role_id', $role_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllRolesByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'DESC');
        $this->db->group_by('role_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function isRoleHasAccessAll($cid, $rid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('role_id', $rid);
        $this->db->where('widget_id', '0');
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getCompanyByRoleIdAndWidgetId($cid, $rid, $wid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('role_id', $rid);
        $this->db->where('widget_id', $wid);

        $query = $this->db->get()->row();
        return $query;
    }

    public function deleteAllByCompanyIdAndRoleId($cid, $rid)
    {
        $this->db->delete($this->table, ['company_id' => $cid, 'role_id' => $rid]);
    }
}

/* End of file CompanyRoleAccessWidget_model.php */
/* Location: ./application/models/CompanyRoleAccessWidget_model.php */
