
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GoogleContactLogs_model extends MY_Model
{
    public $table = 'google_contacts_logs';

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

    public function getAllNotSync($filters=array(), $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);  
        $this->db->where('is_sync', 0);      

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

    public function getByCompanyIdAndObjectId($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('google_contacts_logs.*,acs_profile.first_name,acs_profile.last_name');
        $this->db->from($this->table);        
        $this->db->join('acs_profile', 'google_contacts_logs.object_id = acs_profile.prof_id', 'left');
        $this->db->where('google_contacts_logs.company_id', $company_id);
        if ( !empty($filters['search']) ){
            $this->db->group_start();
            foreach($filters['search'] as $f){                
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
            $this->db->group_end();
        }

        $this->db->order_by('google_contacts_logs.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file GoogleContactLogs_model.php */
/* Location: ./application/models/GoogleContactLogs_model.php */
