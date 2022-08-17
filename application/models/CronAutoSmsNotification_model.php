<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CronAutoSmsNotification_model extends MY_Model
{    
    public $table = 'cron_auto_sms_notification';


    public function getAll($filter=array(), $limit = 0)
    {
        $this->db->select('cron_auto_sms_notification.*, company_auto_sms_settings.company_id, company_auto_sms_settings.module_name, company_auto_sms_settings.module_status, business_profile.business_name');
        $this->db->from($this->table);
        $this->db->join('company_auto_sms_settings', 'cron_auto_sms_notification.company_auto_sms_id = company_auto_sms_settings.id', 'left');
        $this->db->join('business_profile', 'company_auto_sms_settings.company_id = business_profile.company_id', 'left');

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
        $this->db->select('cron_auto_sms_notification.*, company_auto_sms_settings.company_id, company_auto_sms_settings.module_name, company_auto_sms_settings.module_status, business_profile.business_name');
        $this->db->from($this->table);
        $this->db->join('company_auto_sms_settings', 'cron_auto_sms_notification.company_auto_sms_id = company_auto_sms_settings.id', 'left');
        $this->db->join('business_profile', 'company_auto_sms_settings.company_id = business_profile.company_id', 'left');
        $this->db->where('cron_auto_sms_notification.id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByObjectId($obj_id, $filter = array())
    {
        $this->db->select('*');
        $this->db->from($this->table);        
        $this->db->where('obj_id', $obj_id);
        if( !empty($filter) ){
            foreach($filter as $value){                
                $this->db->where($value['field'], $value['value']);
            }
        }

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file CronAutoSmsNotification_model.php */
/* Location: ./application/models/CronAutoSmsNotification_model.php */
