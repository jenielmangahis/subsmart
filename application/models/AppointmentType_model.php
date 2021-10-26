<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppointmentType_model extends MY_Model
{

    public $table = 'appointment_types';

    public function getAllByCompany($company_id, $load_default)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        if( $load_default ){
            $this->db->or_where('company_id', 0);    
        }
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByIdAndCompanyId($id, $company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);        

        $query = $this->db->get()->row();
        return $query;
    }
}

/* End of file AppointmentType_model.php */
/* Location: ./application/models/AppointmentType_model.php */
