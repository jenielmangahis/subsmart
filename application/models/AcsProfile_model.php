<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsProfile_model extends MY_Model
{

    public $table = 'acs_profile';

    public function getAllByCompanyId($company_id, $conditions=array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }

        $this->db->order_by('first_name', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByProfId($prof_id, $conditions=array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                $this->db->where($c['field'], $c['value']);                
            }
        }
        
        $query = $this->db->get();
        return $query->row();
    }

    public function getByProfIdajax($prof_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getByProfile($prof_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function getAll($limit = 0)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('first_name', 'ASC');

        $query = $this->db->get();
        if( $limit > 0 ){
            $this->db->limit($limit);
        }
        return $query->result();
    }

    public function getdataAjax($prof_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prof_id', $prof_id);

        $query = $this->db->get();
        return $query->row();
    }

}

/* End of file AcsProfile_model.php */
/* Location: ./application/models/AcsProfile_model.php */
