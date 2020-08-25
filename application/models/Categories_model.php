<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategories(){
        $qry = $this->db->get('accounting_list_category');
        return $qry->result();
    }

    public function getCategoriesById($id){
        $qry = $this->db->get_where('accounting_list_category',array('id'=>$id));
        return $qry->result();
    }

    public function getCategoriesByTransactionId($transaction_id){
        $qry = $this->db->get_where('accounting_expense_category',array('transaction_id'=>$transaction_id));
        return $qry->result();
    }
    public function getCategoriesBySearch($search){
        $this->db->like('category_name',$search);
        $qry = $this->db->get('accounting_list_category');
        return $qry->result();
    }
}