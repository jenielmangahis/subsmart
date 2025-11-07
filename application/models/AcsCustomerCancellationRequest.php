<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AcsCustomerCancellationRequest extends MY_Model
{
    public $table = 'acs_customer_cancellation_requests';

    public function getAllByCustomerId($customer_id, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                if ($c['field'] != '' && $c['value'] != '') {
                    $this->db->where($c['field'], $c['value']);
                }
            }
        }

        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getByCustomerId($customer_id, $conditions = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('customer_id', $customer_id);

        if (!empty($conditions)) {
            foreach ($conditions as $c) {
                $this->db->where($c['field'], $c['value']);
            }
        }

        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->row();
    }
}

/* End of file AcsCustomerCancellationRequest.php */
/* Location: ./application/models/AcsCustomerCancellationRequest.php */
