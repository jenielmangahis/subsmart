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

    public function addConditions($description,$contain,$comment){
        for($x = 0; $x < count($description);$x++){
            $data[] = [
                'description' => $description[$x],
                'contain'  => $contain[$x],
                'comment' => $comment[$x]
            ];
        }
        $this->db->insert_batch('accounting_rules_conditions',$data);
        return true;
    }

    public function addCategory($category,$percentage){
        for($x = 0; $x < count($category);$x++){
            $data[] = [
                'category' => $category[$x],
                'percentage'  => $percentage[$x],
            ];
        }
        $this->db->insert_batch('accounting_rules_category',$data);
        return true;
    }

    public function getRules(){
        $qry = $this->db->get('accounting_rules');
        return $qry->result();
    }
    public function getRulesById($id){
        $qry = $this->db->get_where('accounting_rules',array('id'=>$id));
        return $qry->result();
    }
    public function getConditionById($id){
        $qry = $this->db->get_where('accounting_rules_conditions',array('rules_id'=>$id));
        return $qry->result();
    }
    public function getCategoryById($id){
        $qry = $this->db->get_where('accounting_rules_category',array('rules_id'=> $id));
        return $qry->result();
    }

    public function editRules($update,$con_id,$description,$contain,$comment,$cat_id,$category,$percentage){
        $qry = $this->db->get_where('accounting_rules_conditions',array('id'=>$update['rules_id']));
        if ($qry->num_rows() == 1){
            $data = array(
                'rules_name' => $update['rules_name'],
                'apply_type' => $update['apply'],
                'banks' => $update['banks'],
                'include' => $update['include'],
                'transaction_type' => $update['transaction_type'],
                'payee' => $update['payee'],
                'memo' => $update['memo'],
                'auto' => $update['auto']
            );
            $this->db->where('id',$update['rules_id']);
            $this->db->update('accounting_rules',$data);
            $this->updateConditions($con_id,$description,$contain,$comment,$update['rules_id']);
            $this->updateCategories($cat_id,$category,$percentage,$update['rules_id']);
            return true;
        }else{
            return false;
        }
    }
    public function updateConditions($con_id,$description,$contain,$comment,$rules_id){
        for($x = 0; $x < count($description);$x++){
//            $data[] = [
//                'id'=> $con_id[$x],
//                'description' => $description[$x],
//                'contain'  => $contain[$x],
//                'comment' => $comment[$x]
//            ];
            if ($con_id[$x] == null){
                $insert = array(
                    'rules_id' => $rules_id,
                    'description' => $description[$x],
                    'contain'  => $contain[$x],
                    'comment' => $comment[$x]
                );
                $query = $this->db->get_where('accounting_rules_conditions',array('rules_id'=>$rules_id,'description' => $description[$x],'contain'  => $contain[$x], 'comment' => $comment[$x]));
                if ($query->num_rows() == 0){
                    $this->db->insert('accounting_rules_conditions',$insert);
                }
            }else{
                $update = array(
                    'description' => $description[$x],
                    'contain'  => $contain[$x],
                    'comment' => $comment[$x]
                );
                $this->db->where('id',$con_id[$x]);
                $this->db->update('accounting_rules_conditions',$update);
            }

        }
        return true;
    }
    public function updateCategories($cat_id,$category,$percentage,$rules_id){
        for($x = 0; $x < count($category);$x++){
//            $data[] = [
//                'id'=> $cat_id[$x],
//                'category' => $category[$x],
//                'percentage'  => $percentage[$x],
//            ];
            if ($cat_id[$x] == null){
                $insert = array(
                    'rules_id' => $rules_id,
                    'category' => $category[$x],
                    'percentage'  => $percentage[$x],
                );
                $query = $this->db->get_where('accounting_rules_category',array('rules_id'=>$rules_id,'category' => $category[$x],'percentage'  => $percentage[$x]));
                if ($query->num_rows() == 0){
                    $this->db->insert('accounting_rules_category',$insert);
                }
            }else{
                $update = array(
                    'category' => $category[$x],
                    'percentage' => $percentage[$x]
                );
                $this->db->where('id',$cat_id[$x]);
                $this->db->update('accounting_rules_category',$update);
            }
        }
        return true;
    }

    public function deleteRulesData($id){
        $this->db->where('id',$id);
        $this->db->delete('accounting_rules');
        //        Delete Conditions
        $this->db->where('rules_id',$id);
        $this->db->delete('accounting_rules_conditions');
        //        Delete Categories
        $this->db->where('rules_id',$id);
        $this->db->delete('accounting_rules_category');
    }

    public function deleteMultiRulesData($id) {
        $this->db->where('id',$id);
        $this->db->delete('accounting_rules');

        //Delete Categories
        $this->db->where('rules_id',$id);
        $this->db->delete('accounting_rules_category');        
    }
}