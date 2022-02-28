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
        $this->db->where('prof_id', $id);
        $this->db->update('acs_profile', $data);
        $customer =  $this->db->affected_rows();
        if ($customer > 0) {
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

    public function get_by_id($id)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('prof_id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function get_customer_by_id($id)
    {
        $this->db->reset_query();
        $query = $this->db->query("SELECT *,
        business_profile.id as business_id, business_profile.street as bus_street, business_profile.city as bus_city, business_profile.state as bus_state, 
        business_profile.postal_code as bus_postal_code,
        acs_profile.mail_add as acs_mail_add, acs_profile.city as acs_city, acs_profile.state as acs_state, acs_profile.zip_code as acs_zip_code, acs_profile.email as acs_email, acs_profile.phone_h as customer_phone_h, acs_profile.attachment as asc_attachment
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
    public function add_new_customer_type($data=array())
    {
        $this->db->insert('customer_types', $data);
        $insert_id = $this->db->insert_id();
        return  $insert_id;
    }
    public function get_customer_type_by_company_id($company_id="")
    {
        $this->db->where('company_id', $company_id);
        $this->db->order_by('title');
        $query = $this->db->get('customer_types');
        return $query->result();
    }
    public function delete_customer_type($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('customer_types');
        return $this->db->affected_rows();
    }
    public function update_customer_type($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('customer_types', $data);
        return $this->db->affected_rows();
    }

    public function add_customer_accounting_details($data)
    {
        $this->db->insert('customer_accounting_details', $data);
        return $this->db->insert_id();
    }
    public function get_customer_accounting_details($customer_id)
    {
        $customer = $this->db->get_where('customer_accounting_details', array('customer_id' => $customer_id));
        return $customer->result();
    }
    public function update_customer_accounting_details($customer_id, $data)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->update('customer_accounting_details', $data);
        $customer =  $this->db->affected_rows();
        if ($customer > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function get_customer_deposits($customer_id)
    {
        $query = $this->db->query("SELECT * FROM accounting_bank_deposit WHERE customer_id = ".$customer_id);
        return $query->result();
    }
    public function get_customer_estimates($customer_id, $status)
    {
        $query = $this->db->query("SELECT * FROM estimates WHERE customer_id = ".$customer_id." AND status = '".$status."'");
        return $query->result();
    }
    public function get_customer_credit_memo($customer_id)
    {
        $query = $this->db->query("SELECT * FROM accounting_credit_memo WHERE customer_id = ".$customer_id);
        return $query->result();
    }
    public function get_customer_statement($customer_id)
    {
        $query = $this->db->query("SELECT * FROM accounting_statements WHERE customer_id = ".$customer_id);
        return $query->result();
    }public function get_users_table_column_names()
	{   
        
		$query= $this->db->query("SELECT * from customers");
        return $query->list_fields();
	}
}
