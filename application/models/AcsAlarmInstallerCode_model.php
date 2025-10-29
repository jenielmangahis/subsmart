<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsAlarmInstallerCode_model extends MY_Model
{
    public $table = 'acs_alarm_installer_codes';
    
    public function getAllByCompanyId($company_id, $filters=[])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if ( !empty($filters) ) {
            $this->db->group_start();
            foreach( $filters as $filter ){
                if( $filter['value'] != '' ){
                    $this->db->like($filter['field'], $filter['value'], 'both');  
                }                
            }
            $this->db->group_end();
        }

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

    public function getCompanyDefaultValue($company_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $this->db->where('is_default', 'Yes');

        $query = $this->db->get();
        return $query->row();
    }

    public function getByIdAndCompanyId($id, $cid)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $cid);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByCodeAndCompanyId($code, $cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('installer_code', $code);
        $this->db->where('company_id', $cid);

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

/* End of file AcsAlarmInstallerCode_model.php */
/* Location: ./application/models/AcsAlarmInstallerCode_model.php */
