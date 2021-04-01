<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wizard_model extends MY_Model {

	public $table = 'wizard';
	public $tableWorkspaces = 'wizard_workspace';
        
        function saveCreatedWiz($details,$company_id,$wizTrigger,$wizAction)
        {
            $this->db->where('wa_company_id', $company_id);
            $this->db->where('wa_trigger_app_id', $wizTrigger);
            $this->db->where('wa_action_app_id', $wizAction);
            $qCheck = $this->db->get('wizard_automate');
            if($qCheck->num_rows()==0):
                if($this->db->insert('wizard_automate', $details)):
                    return json_encode(array('status' => true, 'msg' => 'WiZ Successfully Created', 'id' => $this->db->insert_id()));
                else:
                    return json_encode(array('status' => false, 'msg' => 'Sorry Something went wrong'));
                endif;
            else:
                return json_encode(array('status' => false, 'msg' => 'Sorry, this WiZ sequence is already created'));
            endif;
        }
        
        function deleteApp($id)
        {
            $this->db->where('id', $id);
            if($this->db->delete('wizard_apps')):
                return TRUE;
            else:
                return FALSE;
            endif;
        }
        
        function deleteAppFunc($id)
        {
            $this->db->where('wiz_app_func_id', $id);
            if($this->db->delete('wizard_app_function')):
                return TRUE;
            else:
                return FALSE;
            endif;
        }
        
        function fetchAppFunc($fnId)
        {
            $this->db->join('wizard_apps','wizard_app_function.wiz_app_id = wizard_apps.id', 'left');
            return $this->db->where('wiz_app_id', $fnId)->get('wizard_app_function')->result();
        }


        function addAppFunc($fn_nice, $fn_name, $fn_desc, $fn_id)
        {
            $data = array(
                'wiz_app_id' => $fn_id,
                'wiz_app_nice_name' => $fn_nice,
                'wiz_app_function' => $fn_name,
                'wiz_func_desc' => $fn_desc
            );
            
            $this->db->where('wiz_app_id', $fn_id);
            $this->db->where('wiz_app_function', $fn_name);
            
            $q = $this->db->get('wizard_app_function');
            if($q->num_rows() == 0):
                if($this->db->insert('wizard_app_function', $data)):
                    return 1;
                else:
                    return 0;
                endif;
            else:
                return 2;
            endif;
        }
        
        
        function addApp($app_name, $app_icon)
        {
            $data = array(
                'app_name' => $app_name,
                'app_img' => $app_icon,
                'show_app' => 1,
                'defaultdata' => 1
            );
            
            $q = $this->db->where('app_name', $app_name)->get('wizard_apps');
            if($q->num_rows() == 0):
                if($this->db->insert('wizard_apps', $data)):
                    return 1;
                else:
                    return 0;
                endif;
            else:
                return 2;
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

    public function getCompanyWorkSpaceById($company_id, $id)
    {

        $this->db->select('*');
        $this->db->from($this->tableWorkspaces);
        $this->db->where('company_id', $company_id);
        $this->db->where('id', $id);

        $query = $this->db->get();
        return $query->row();
    }

}
