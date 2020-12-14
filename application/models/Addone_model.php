<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addone_model extends MY_Model {

	public function uploadfile($filename,$filepath,$fileexe,$filedate)
	{
		$query="insert into addone_uploadfiles values('','$filename','$filepath','$fileexe','$filedate')";
		echo $this->db->query($query);	
	}

	public function getUploads($params = array())
	{
		$this->db->select('*');
        $this->db->from('addone_uploadfiles');
        if(array_key_exists('id',$params) && !empty($params['id'])){
            $this->db->where('id',$params['id']);
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->row_array():FALSE;
        }else{
            //set start and limit
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit'],$params['start']);
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $this->db->limit($params['limit']);
            }
            //get records
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }
        //return fetched data
        return $result;
	}
}
?>