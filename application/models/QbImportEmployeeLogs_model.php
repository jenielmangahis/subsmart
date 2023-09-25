
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class QbImportEmployeeLogs_model extends MY_Model
{
    public $table = 'qb_import_employee_logs';

    public function getAll($filters=array(), $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);        

        if ( !empty($filters['search']) ){
            $this->db->group_start();
            foreach($filters['search'] as $f){                
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
            $this->db->group_end();
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
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

    public function getByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $user_id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('qb_import_employee_logs.*, users.FName AS employee_first_name, users.LName AS employee_last_name');
        $this->db->from($this->table);        
        $this->db->join('users', 'qb_import_employee_logs.user_id  = users.id', 'left');
        $this->db->where('qb_import_employee_logs.company_id', $company_id);
        
        if ( !empty($filters['search']) ){
            $this->db->group_start();
            foreach($filters['search'] as $f){                
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
            $this->db->group_end();
        }

        $this->db->order_by('qb_import_employee_logs.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllNotSync($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('is_sync', 0);
        $this->db->where('is_with_error', 0);
        
        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file QbImportEmployeeLogs_model.php */
/* Location: ./application/models/QbImportEmployeeLogs_model.php */
