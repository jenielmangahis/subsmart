<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompanyMenuSetting_model extends MY_Model {

	public $table = 'company_menu_settings';
	
	public function __construct()
	{
		parent::__construct();
    }

    public function getAllByCompanyId($cid, $order_by = [])
    {        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("company_id", $cid);

        if( $order_by ){
            $this->db->order_by($order_by['field'],$order_by['order']);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllEnabledByCompanyId($cid, $order_by = [])
    {        
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where("company_id", $cid);
        $this->db->where("is_enabled", 1);

        if( $order_by ){
            $this->db->order_by($order_by['field'],$order_by['order']);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteAllByCompanyId($cid)
    {
        $this->db->delete($this->table, array('company_id' => $cid));
    }

    public function optionMenus()
    {
        $menus = [
            'Dashboard',
            'Calendar',
            'Sales',
            'My Customers',
            'Accounting',
            'Payroll',
            'Taxes',
            'Files Vault',
            'Photo Gallery',
            'Marketing',
            'Toolbox',
            'Company',
            'Settings',
            'University'
        ];

        return $menus;
    }
}