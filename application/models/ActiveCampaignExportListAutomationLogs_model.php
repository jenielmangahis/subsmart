
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ActiveCampaignExportListAutomationLogs_model extends MY_Model
{
    public $table = 'active_campaign_export_list_automation_logs';
    public $type_automation = 'automation';
    public $type_list = 'list';

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

    public function getAllByCompanyId($company_id, $filters=array())
    {
        $this->db->select('*, acs_profile.first_name AS customer_firstname, acs_profile.last_name AS customer_lastname');
        $this->db->from($this->table);        
        $this->db->join('acs_profile', 'active_campaign_export_list_automation_logs.customer_id  = acs_profile.prof_id', 'left');     
        $this->db->where('active_campaign_export_list_automation_logs.company_id', $company_id); 

        if ( !empty($filters['search']) ){
            $this->db->group_start();
            foreach($filters['search'] as $f){                
                $this->db->or_like($f['field'], $f['value'], 'both');            
            } 
            $this->db->group_end();
        }

        $this->db->order_by('active_campaign_export_list_automation_logs.id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getListByCustomerIdAndObjectId($customer_id, $object_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        $this->db->where('object_id', $object_id);
        $this->db->where('type', $this->type_list);
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function getAutomationByCustomerIdAndObjectId($customer_id, $object_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);
        $this->db->where('object_id', $object_id);
        $this->db->where('type', $this->type_automation);
        
        $query = $this->db->get()->row();
        return $query;
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

    public function typeAutomation()
    {
        return $this->type_automation;
    }

    public function typeList()
    {
        return $this->type_list;
    }
}

/* End of file ActiveCampaignExportListAutomationLogs_model.php */
/* Location: ./application/models/ActiveCampaignExportListAutomationLogs_model.php */
