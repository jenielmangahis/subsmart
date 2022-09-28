<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AcsProfile_model extends MY_Model
{

    public $table = 'acs_profile';
    public $table2 = 'acs_billing';

    public function getAllByCompanyId($company_id, $conditions=array(), $filters=array())
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        if( !empty($conditions) ){
            foreach( $conditions as $c ){
                if( $c['field'] != '' && $c['value'] != '' ){
                    $this->db->where($c['field'], $c['value']);    
                }
                
            }
        }

        if ( !empty($filters) ) {
            if ( $filters['search'] != '' ) {
                $this->db->like('first_name', $filters['search'], 'both');
                $this->db->or_like('last_name', $filters['search'], 'both');
            }
        }

        $this->db->order_by('first_name', 'ASC');

        $query = $this->db->get();
        // $query = $query1->result();
        // $data = array();
        // foreach($query as $q){
        //     $data [] = array(
        //         "id" => $q->prof_id,
        //         "name" => $q->first_name
        //     );
        // }
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

    public function getProfile($prof_id=null, $col=null, $cust=null, $stat = null, $type = null)
    {
            if($col != null){
                $selectedColumns = str_replace("acs_billing.", "", $col );
                array_push($selectedColumns, 'prof_id');
                $this->db->select($selectedColumns);
            }else{
                $this->db->select('*');
            }

            $this->db->from($this->table);

            if($cust != null){
                $this->db->where_in('prof_id', $cust);
            }

            if($prof_id != null){
                $this->db->order_by($prof_id, 'DESC');
            }
            
            $query = $this->db->get();
            
            //  if($query && $prof_id != null ){
            //      $res = $query->result();
            //      $idArray = Array();
            //      foreach($res as $resId):
            //          if(in_array($resId->prof_id, $prof_id)){
            //             array_push($idArray, $resId->prof_id);
            //          }
            //      endforeach;
            //      if($col != null){
            //      return $this->test($idArray, $col);
            //      }else{
            //         return $this->test($idArray, null);
            //      }
                 
            // }else{
                return $query->result();
             //}
    //     elseif($prof_id != null && $col == null && ($cust == null && $stat == null)){
    //         $this->db->select('*');
    //         $this->db->from($this->table);
    //         $this->db->where_in('prof_id', $prof_id);
    
    //         $query = $this->db->get();
    //         return $query->result();

    //     }elseif($prof_id == null && $col != null && ($cust == null && $stat == null)){
    //         $this->db->select($col);
    //         $this->db->from($this->table);

    //         $query = $this->db->get();
    //         return $query->result();

    //     }elseif($prof_id == null && $col == null && $cust != null){
    //         $this->db->select('*');
    //         $this->db->from($this->table);
    //         $this->db->where_in('prof_id', $cust);

    //         $query = $this->db->get();
    //         return $query->result();

    //     }elseif($prof_id == null && $col != null && ($cust != null || $stat != null)){
    //              $this->db->select($col);
    //              $this->db->from($this->table);
    //              if($stat != null && $cust == null){
    //                 $this->db->where_in('status', $stat);
    //             }elseif(empty($stat) && !empty($cust)){
    //                 $this->db->where_in('prof_id', $cust);
    //             }
    //             $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');
    //              $fl = $this->db->get();
    //              return $fl->result();

    //      }elseif($prof_id != null && $col != null && $cust == null){
    //         $this->db->select($col);
    //         $this->db->from($this->table);
    //         $this->db->where_in('acs_profile.prof_id', $prof_id);
    //         $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');
    
    //         $fl = $this->db->get();
    //         return $fl->result();

    // }
    //      else{
    //         $this->db->select('*');
    //         $this->db->from($this->table);

    //         $query = $this->db->get();
    //         return $query->result();
    //     }
    }

    public function test($idArray, $col)
    {
        if(!empty($col)){
            $this->db->select($col);
            $this->db->from($this->table);
            $this->db->where_in('acs_profile.prof_id', $idArray);
            $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');
    
            $fl = $this->db->get();
            return $fl->result();
        }else{
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where_in('acs_profile.prof_id', $idArray);
            $this->db->join('acs_billing', 'acs_profile.prof_id = acs_billing.fk_prof_id');
    
            $fl = $this->db->get();
            return $fl->result();
           //return $message;
        }
    }
// Return acs_profile group by
    public function getProfileGb($prof_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where_in('prof_id', $prof_id);

        $query = $this->db->get();
        return $query->result();
    }
// Return acs_profile fields
    

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

    public function getCustomer(){
        $this->db->select('DISTINCT(last_name), first_name, prof_id');
        $this->db->from($this->table);
        $this->db->group_by('last_name');

        $query = $this->db->get();
        return $query->result();
    }
    public function getCustomerType(){
        $this->db->select('DISTINCT(customer_type)');
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }
    public function getStatus(){
        $this->db->select('DISTINCT(status)');
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }
    public function getByAdtSalesProjectId($adt_project_id)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('adt_sales_project_id', $adt_project_id);
        
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getCustomerMMR($id){
        $this->db->select('acs_billing.mmr, acs_profile.prof_id, acs_billing.bill_start_date');
        $this->db->from('acs_billing');
        $this->db->join('acs_profile', 'acs_billing.fk_prof_id = acs_profile.prof_id');
        $this->db->where('acs_profile.company_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getInstalledDate($id, $table){
        $this->db->select('install_date');
        $this->db->from($table);
        $this->db->where('fk_prof_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function updateByAdtSalesProjectId($adt_sales_project_id, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('adt_sales_project_id', $adt_sales_project_id);
        $this->db->update();
    }

    public function getAllByIsSync($is_sync = 0, $conditions = array(), $limit = 0)
    {

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_sync', $is_sync);
        $this->db->order_by('first_name', 'ASC');

        if( !empty($conditions) ){
            foreach($conditions as $c){
                $this->db->where($c['field'], $c['value']);
            }
        }

        $query = $this->db->get();
        if( $limit > 0 ){
            $this->db->limit($limit);
        }
        return $query->result();
    }
}

/* End of file AcsProfile_model.php */
/* Location: ./application/models/AcsProfile_model.php */
