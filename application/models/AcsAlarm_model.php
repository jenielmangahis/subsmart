<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsAlarm_model extends MY_Model
{
    public $table = 'acs_alarm';
    
    public function getAllByCompanyId($company_id)
    {
        $this->db->select('acs_alarm.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_alarm.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_alarm_zones.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {

        $this->db->select('acs_alarm.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_alarm.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_alarm.alarm_id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByCustmerId($customer_id)
    {

        $this->db->select('acs_alarm.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_alarm.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_alarm.fk_prof_id', $customer_id);
        $this->db->order_by('acs_alarm.alarm_id', 'desc');

        $query = $this->db->get();
        return $query->row();
    }

    public function getAllByCustomerId($customer_id)
    {
        $this->db->select('acs_alarm.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_alarm.fk_prof_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_alarm.customer_id', $customer_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdAndCompanyId($id, $cid)
    {

        $this->db->select('acs_alarm.*, acs_profile.first_name, acs_profile.last_name');
        $this->db->join('acs_profile', 'acs_alarm.customer_id = acs_profile.prof_id', 'left');
        $this->db->from($this->table);
        $this->db->where('acs_alarm.id', $id);
        $this->db->where('acs_profile.company_id', $cid);

        $query = $this->db->get();
        return $query->row();
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

    public function updateByAlarmId($alarm_id, $data) {
        $this->db->where('alarm_id', $alarm_id);
        $this->db->update($this->table, $data);

        return $this->db->affected_rows() > 0;
    }
}

/* End of file AcsAlarm_model.php */
/* Location: ./application/models/AcsAlarm_model.php */
