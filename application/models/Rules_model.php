<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addRules($new_data){
        $qry = $this->db->get_where('accounting_rules',array(
            'rules_name'=> $new_data['rules_name']
        ));
        if ($new_data['auto'] == null){
            $new_data['auto'] = 0;
        }
        if ($qry->num_rows() == 0){
            $data = array(
              'rules_name' => $new_data['rules_name'],
              'apply_type' => $new_data['apply'],
              'banks' => $new_data['banks'],
              'include' => $new_data['include'],
              'transaction_type' => $new_data['transaction_type'],
              'payee' => $new_data['payee'],
              'memo' => $new_data['memo'],
              'auto' => $new_data['auto'],
            );
            $this->db->insert('accounting_rules',$data);
            $get_id = $this->db->get_where('accounting_rules',array('rules_name'=> $new_data['rules_name']));
            return $get_id->row()->id;
        }else{
            return null;
        }
    }

    public function addConditions($description,$contain,$comment,$rules_id){
        for($x = 0; $x < count($description);$x++){
            $data[] = [
                'rules_id' => $rules_id,
                'description' => $description[$x],
                'contain'  => $contain[$x],
                'comment' => $comment[$x]
            ];
        }
        $this->db->insert_batch('accounting_conditions',$data);
        return true;
    }

    public function addCategory($category,$percentage,$rules_id){
        for($x = 0; $x < count($category);$x++){
            $data[] = [
                'rules_id' => $rules_id,
                'category' => $category[$x],
                'percentage'  => $percentage[$x],
            ];
        }
        $this->db->insert_batch('accounting_category',$data);
        return true;
    }

    public function getRules(){
        $qry = $this->db->get('accounting_rules');
        return $qry->result();
    }
}