<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DealsStealsSentMail_model extends MY_Model
{
    public $table = 'deals_steals_sent_mails';
   
    public function getAll($conditions = [], $filters= [], $order_by = [], $limit)
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('campaign_name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        if( $order_by ){
            $this->db->order_by($order_by['field'], $order_by['sort']);
        }else{
            $this->db->order_by('id', 'ASC');
        }

        if( $limit > 0 ){
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyId($company_id, $conditions=array())
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function batchInsert($data)
    {
        $this->db->insert_batch($this->table, $data); 
    }

}

/* End of file DealsStealsSentMail_model.php */
/* Location: ./application/models/DealsStealsSentMail_model.php */
