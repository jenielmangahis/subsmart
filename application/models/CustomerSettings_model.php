<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerSettings_model extends MY_Model
{    
    public $table = 'customer_settings';

    public $setting_type_adt_sync = 'adt_sales_sync';

    public function getAll($filter=array(), $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if( !empty($filter) ){
            foreach($filter as $value){                
                $this->db->where($value['field'], $value['value']);
            }
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }
        $this->db->order_by('id', 'DESC');

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

    public function getByCompanyId($company_id, $filters = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if( !empty($filter) ){
            foreach($filters as $filter){
                $this->db->where($filter['field'], $filter['value']);
            }
        }

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateByCustomerSettingId($customer_settings_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('customer_settings_id', $customer_settings_id);
        $this->db->update();
    }

    public function getAllEnabledAdtSyncSetting($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('setting_type', $this->setting_type_adt_sync);
        $this->db->where('value', 1);
        $this->db->where('status', 1);

        if( $limit > 0 ){
            $this->db->limit($limit);
        }
        
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function settingAdtSalesSync()
    {
        return $this->setting_type_adt_sync;
    }
}

/* End of file CustomerSettings_model.php */
/* Location: ./application/models/CustomerSettings_model.php */
