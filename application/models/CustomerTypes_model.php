<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerTypes_model extends MY_Model
{
    public $table = 'customer_types';


    /**
     * @return mixed
     */
    public function getAll()
    {
        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();

        return $query->result();
    }
}

/* End of file CustomerSource_model.php */
/* Location: ./application/models/CustomerSource_model.php */
