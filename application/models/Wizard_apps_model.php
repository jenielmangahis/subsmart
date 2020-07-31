<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_apps_model extends MY_Model {

	public $table = 'wizard_apps';

	function fetch_data($query)
	 {
	  $this->db->like('app_name', $query);
	  $query = $this->db->get('wizard_apps');
	  if($query->num_rows() > 0)
	  {
	   foreach($query->result_array() as $row)
	   {
	    $output[] = array(
	     'app_id'  => $row["id"],
	     'app_name'  => $row["app_name"],
	     'app_img'  => $row["app_img"]
	    );
	   }
	   echo json_encode($output);
	  }
	 }

	 function show_app($id)
	 {
	 	$q="SELECT * FROM wizard_apps where show_app = 1 and id= $id";
	 	$prequery = $this->db->query($q);
		if($prequery->num_rows() == 0)
		{
		 	$query="update wizard_apps set show_app = 1 where id = $id";
			echo $this->db->query($query);
		}
	 }

	 function del_app($id)
	 {
	 	$query="update wizard_apps set show_app = 0 where id = $id";
		echo $this->db->query($query);
	 }

	 function getApps()
	 {
	 	$this->db->where('show_app','1');
	 	$query = $this->db->get('wizard_apps');  
        return $query->result();
	 }


}
