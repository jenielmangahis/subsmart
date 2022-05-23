<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_model extends MY_Model {

	public $table = 'wizard';
	public $tableWorkspaces = 'wizard_workspace';
        
        function addApp($app_name, $app_icon)
        {
            $data = array(
                'app_name' => $app_name,
                'app_img' => $app_icon,
                'show_app' => 1,
                'defaultdata' => 1
            );
            
            $q = $this->db->where('app_name', $app_name)->get('wizard_apps');
            if($q->num_rows() > 1):
                return 0;
            else:
                if($this->db->insert('wizard_apps', $data)):
                    return 1;
                else:
                    return 2;
                endif;
            endif;
        }
        
        function getWizApps()
        {
            $this->db->order_by('app_name','ASC');
            return $this->db->where('defaultdata', '1')->get('wizard_apps')->result();
        }

	public function getAllCompanies() {
		$this->db->select('*');
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->result();
	}


	public function getAllIndustries() {
		$this->db->select('*');
		$this->db->from($this->tableWorkspaces);
		$query = $this->db->get();
		return $query->result();
	}

}
