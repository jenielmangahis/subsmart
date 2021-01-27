<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_apps_model extends MY_Model {

	public $table = 'wizard_apps';
        
        
        function updateConfigData($configData, $func_id, $configName)
        {
            $this->db->where('id',$configData );
            return $this->db->update('wizard_'.$configName.'_config', array('appfunc_id' => $func_id));
        }
        
        function saveGmailSetup($details)
        {
            if($this->db->insert('wizard_gmail_config', $details)):
                return json_encode(array('status' => true, 'app_func_id' => $this->db->insert_id()));
            else:
                return json_encode(array('status' => false));
            endif;
        }
        

	function fetch_data($query)
	 {
	  $this->db->like('app_name', $query);
	  $query = $this->db->where('defaultdata', '1')->get('wizard_apps');
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
	 	// $q="SELECT * FROM wizard_apps where show_app = 1 and id= $id";
	 	// $prequery = $this->db->query($q);
		// if($prequery->num_rows() == 0)
		// {
		//  	$query="update wizard_apps set show_app = 1 where id = $id";
		// 	echo $this->db->query($query);
		// } 

		
		$query = $this->db->where('defaultdata', '1')->where('id', $id)->get('wizard_apps');
		if($query->num_rows() > 0)
		{
			foreach($query->result_array() as $row)
			{
				$qu = "INSERT INTO `wizard_apps` (`app_name`, `app_img`, `show_app`, `defaultdata`) VALUES ('".$row["app_name"]."', '".$row["app_img"]."', '1', '0')";
				echo $this->db->query($qu);
			}
		}
		
	 }

	 function del_app($id)
	 {
		 // $query="update wizard_apps set show_app = 0 where id = $id";
		$query = "delete from wizard_apps where id = $id";
		echo $this->db->query($query);
	 }

	 function getApps()
	 {
		$this->db->where('show_app','1');
		$this->db->where('defaultdata','0');
	 	$query = $this->db->get('wizard_apps');  
        return $query->result();
	 }


}
