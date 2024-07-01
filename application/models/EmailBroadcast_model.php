<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailBroadcast_model extends MY_Model
{
    public $table = 'email_broadcasts';

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

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

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($cid, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);

        if( !empty($conditions) ){
            $this->db->group_start();            
            foreach( $conditions as $c ){
                $this->db->or_like($c['field'], $c['value']);    
            }
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->result();
    }
    
    public function getAllOngoingBroadcast($conditions = [], $limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status', self::isOngoing());

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                if( $c['field'] == 'send_date' ){
                    $this->db->where($c['field']. ' <=', $c['value']);                
                }else{
                    $this->db->where($c['field'], $c['value']);                
                }
            }
        }

        if( $limit > 0 ){
            $this->db->limit($limit);  
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function saveData($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }    

    public function optionStatus()
    {
        $options = ['Draft', 'Ongoing'];
        return $options;
    }
    
    public function isDraft()
    {
        return 'Draft';
    }

    public function isOngoing()
    {
        return 'Ongoing';
    }

    public function isCompleted()
    {
        return 'Completed';
    }
    
}

/* End of file EmailBroadcast_model.php */
/* Location: ./application/models/EmailBroadcast_model.php */
