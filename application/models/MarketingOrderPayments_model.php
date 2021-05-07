<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MarketingOrderPayments_model extends MY_Model
{
    public $table = 'marketing_order_payments';

    public function getAll($filters=array())
    {
        $id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('title', $filters['search'], 'both');
            }
        }

        $this->db->where('user_id', $id);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }  

    public function getAllByCompanyId($company_id, $filters=array(), $conditions=array())
    {

        $this->db->select('marketing_order_payments.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'marketing_order_payments.user_id = users.id', 'LEFT');

        if ( !empty($filters) ) {
            if ( !empty($filters['search']) ) {
                $this->db->like('name', $filters['search'], 'both');
            }
        }

        if( !empty($conditions) ){
            foreach( $conditions as $key => $value ){
                $this->db->where($value['field'], $value['value']);                
            }
        }

        $this->db->where('users.company_id', $company_id);

        $query = $this->db->get();
        return $query->result();
    }  

    public function getByUserId($user_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query;
    }

    public function deleteById($id)
    {
        $this->db->delete($this->table, array('id' => $id));
    }


    public function getById($id)
    {
        $this->db->select('marketing_order_payments.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'marketing_order_payments.user_id = users.id', 'LEFT');

        $this->db->where('marketing_order_payments.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    public function getByOrderNumber($order_number)
    {
        $this->db->select('marketing_order_payments.*, users.id AS uid, users.company_id');
        $this->db->from($this->table);
        $this->db->join('users', 'marketing_order_payments.user_id = users.id', 'LEFT');

        $this->db->where('marketing_order_payments.order_number', $order_number);
        $query = $this->db->get()->row();
        return $query;
    }

    public function updateOrderPayment($id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update();
    }

    public function generateORNumber($id)
    {
        $issue_no = 'OR-' . date("Y") . '-' . str_pad($id, 5,"0",STR_PAD_LEFT);
        return $issue_no; 
    }

    public function paymentMethodCC()
    {
        return 'Credit Card';
    }

    public function statusCompleted()
    {
        return 'Completed';
    }
}

/* End of file MarketingOrderPayments_model.php */
/* Location: ./application/models/MarketingOrderPayments_model.php */
