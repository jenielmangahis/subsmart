<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsAlarmMonitoringCompany_model extends MY_Model
{
    public $table = 'acs_alarm_monitoring_companies';
    
    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
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
        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByNameAndCompanyId($name, $cid)
    {
        $name = trim($name);
        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('name', $name);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getCompanyDefaultValue($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('is_default', 'Yes');

        $query = $this->db->get();
        return $query->row();
    }

    public function resetDefaultByCompanyId($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->update($this->table, ['is_default' => 'No']);
        return $this->db->affected_rows();
    }

    public function bulkDelete($ids = [], $filters = [])
    {
        if( count($ids) > 0 ){
            $this->db->where_in('id', $ids);

            if( $filters ){
                foreach( $filters as $filter ){
                    $this->db->where($filter['field'], $filter['value']);
                }
            }

            $this->db->delete($this->table);
        }        

        return $this->db->affected_rows();
    }
}

/* End of file AcsAlarmMonitoringCompany_model.php */
/* Location: ./application/models/AcsAlarmMonitoringCompany_model.php */
