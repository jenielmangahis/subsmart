<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CustomerDisputeItem_model extends MY_Model
{

    public $table = 'customer_dispute_items';

    public $other_info_status_positive = 'Positive';
    public $other_info_status_negative = 'Negative';
    public $other_info_status_repaired = 'Repaired';
    public $other_info_status_deleted  = 'Deleted';
    public $other_info_status_in_dispute  = 'In Dispute';

    public function getAll()
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCustomerDisputeId($customer_dispute_id)
    {

        $this->db->select('customer_dispute_items.*, credit_bureau.name AS cb_name, credit_bureau.logo AS cb_logo');
        $this->db->from($this->table);
        $this->db->join('credit_bureau', 'customer_dispute_items.credit_bureau_id = credit_bureau.id');
        $this->db->where('customer_dispute_items.customer_dispute_id', $customer_dispute_id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id); 

        $query = $this->db->get();
        return $query->row();
    }

    public function deleteById($id){
        $this->db->delete($this->table, array('id' => $id));
    }

    public function deleteByCustomerDisputeId($customer_dispute_id){
        $this->db->delete($this->table, array('customer_dispute_id' => $customer_dispute_id));
    }

    public function optionOtherInfoStatus( $status = '' ){        
        $options = [
            $this->other_info_status_positive => ['value' => $this->other_info_status_positive, 'icon' => 'fa-check-circle-o'],
            $this->other_info_status_negative => ['value' => $this->other_info_status_negative, 'icon' => 'fa-times-circle-o'],
            $this->other_info_status_repaired => ['value' => $this->other_info_status_repaired, 'icon' => 'fa-check-circle-o'],
            $this->other_info_status_deleted  => ['value' => $this->other_info_status_deleted, 'icon' => 'fa-times-circle-o'],
            $this->other_info_status_in_dispute  => ['value' => $this->other_info_status_in_dispute, 'icon' => 'fa-clock-o'],
        ];

        if( $status != '' ){
            if( isset($options[$status]) ){
                return $options[$status]['icon'];
            }else{
                return '';
            }
        }else{
            return $options;
        }

        return $options;
    }
}

/* End of file CustomerDisputeItem_model.php */
/* Location: ./application/models/CustomerDisputeItem_model.php */
