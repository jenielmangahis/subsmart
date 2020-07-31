<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_suboptions_model extends MY_Model {

	public $table = 'wizard_suboptions';

	public function getSubOptions($id) {
		$this->db->where('sub_app_id',$id);
		$this->db->where('show_option','1');
	 	$query = $this->db->get('wizard_suboptions');  
        $res= $query->result();
        $op="";
        foreach ($res as $row) {
        	$op=$op.'<li><a href="#">'.$row->option_name.'<span>'.$row->option_comment.'</span></a></li>';
        }
        echo $op;
	}


}
