<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerAddress_model extends MY_Model
{
    public $table = 'customer_address';


    /**
     * @return mixed
     */
    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', getLoggedUserID());
        $query = $this->db->get();

        return $query->result();
    }


    public function getByModelAndType($customer_id,$model,$type)
    {
        return $this->db->get_where($this->table, [ 'customer_id' => $customer_id, 'module' => $model, 'type' => $type ])->result_array();

    }
}

/* End of file CustomerSource_model.php */
/* Location: ./application/models/CustomerSource_model.php */
