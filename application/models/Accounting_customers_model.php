<?php

use oasis\names\specification\ubl\schema\xsd\CommonBasicComponents_2\CompanyID;

defined('BASEPATH') or exit('No direct script access allowed');

class Accounting_customers_model extends MY_Model
{
    public $table = 'acs_profile';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getCustomers()
    {
        $customer = $this->db->get('acs_profile');
        return $customer->result();
    }
    public function createCustomer($data)
    {
        $customer = $this->db->insert('acs_profile', $data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }
    public function updateCustomer($id, $data)
    {
        $this->db->where('id', $id);
        $customer = $this->db->update('acs_profile', $data);
        if ($customer) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteCustomer($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('acs_profile');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getCustomerDetails($id)
    {
        $customer = $this->db->get_where('acs_profile', array('prof_id' => $id));
        return $customer->result();
    }
    public function getAllByCompany()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->order_by('first_name', 'asc');
        $this->db->order_by('last_name', 'asc');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function getCompanyCustomersWithBalance()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->order_by('last_name', 'asc');
        $this->db->order_by('first_name', 'asc');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_customer_by_id($id)
    {
        $this->db->reset_query();
        $query = $this->db->query("SELECT *,
        business_profile.id as business_id, business_profile.street as bus_street, business_profile.city as bus_city, business_profile.state as bus_state, 
        business_profile.postal_code as bus_postal_code,
        acs_profile.mail_add as acs_mail_add, acs_profile.city as acs_city, acs_profile.state as acs_state, acs_profile.zip_code as acs_zip_code
        FROM acs_profile JOIN business_profile ON acs_profile.company_id = business_profile.company_id WHERE acs_profile.prof_id = ".$id);
        return $query->row();
    }
    public function getAllVendorsByCompany($company_id=0)
    {
        if ($company_id == 0) {
            $company_id = logged("company_id");
        }
        $this->db->where('company_id', logged('company_id'));
        $this->db->order_by('vendor_name', 'asc');
        $query = $this->db->get("vendor");
        return $query->result();
    }
    public function add_time_activity($data)
    {
        $this->db->insert('accounting_single_time_activity', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function update_time_activity($data, $time_activity_id)
    {
        $this->db->where('id', $time_activity_id);
        $res = $this->db->update('accounting_single_time_activity', $data);
        if ($res) {
            return true;
        } else {
            return false;
        }
    }
    public function get_accounting_timesheet_settings($company_id)
    {
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('accounting_timesheet_settings');
        return $query->row();
    }
    public function update_accounting_timesheet_settings($data)
    {
        if ($this->get_accounting_timesheet_settings(logged("company_id"))>0) {
            $this->db->where('company_id', logged("company_id"));
            $this->db->update('accounting_timesheet_settings', $data);
        } else {
            $data["company_id"] = logged("company_id");
            $this->db->insert('accounting_timesheet_settings', $data);
        }
    }
    public function make_customer_inactive($customer_id)
    {
        $this->db->where('company_id', logged("company_id"));
        $this->db->where('prof_id', $customer_id);
        $this->db->update('acs_profile', array("activated"=>0));
    }
}
