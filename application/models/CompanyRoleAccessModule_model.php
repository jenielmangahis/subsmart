<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CompanyRoleAccessModule_model extends MY_Model
{
    public $table = 'company_role_access_modules';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('id', 'ASC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getById($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getAllByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllByCompanyIdAndRoleId($cid, $role_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('role_id', $role_id);
        $this->db->order_by('id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }

    public function getAllRolesByCompanyId($cid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->order_by('id', 'DESC');
        $this->db->group_by('role_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCompanyRoleModulePermission($cid, $rid, $module)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('role_id', $rid);
        $this->db->where('module', $module);
        $this->db->order_by('id', 'DESC');
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function isRoleHasAccessAll($cid, $rid)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $cid);
        $this->db->where('role_id', $rid);
        $this->db->where('module', 'access-all');
        $this->db->order_by('id', 'DESC');
        
        $query = $this->db->get()->row();
        return $query;
    }

    public function deleteAllByCompanyIdAndRoleId($cid, $rid)
    {
        $this->db->delete($this->table, ['company_id' => $cid, 'role_id' => $rid]);
    }
    
    public function modules()
    {
        $modules = [
            'dashboard' => 'Dashboard',
            'customers' => 'Customers',
            'leads' => 'Leads',
            'users' => 'Users',
            'user-timesheet' => 'Timesheet',
            'user-timesheet-settings' => 'Timesheet Settings', 
            'user-settings-attendance' => 'Attendance',
            'user-settings-time-logs' => 'Time Logs',           
            'user-settings-leave-requests' => 'Leave Requests', 
            'user-settings-overtime-requests' => 'Overtime Requests', 
            'user-track-location' => 'Employees Track Location',            
            'user-payscale' => 'Pay Scale',
            'timesheet-leave-types' => 'Leave Types',            
            'company-my-business' => 'My Business',
            'company-my-services' => 'My Business Services',
            'company-my-credentials' => 'My Business Credentials',
            'company-my-availability' => 'My Business Availability',
            'company-my-portfolio' => 'My Business Portfolio',
            'company-settings' => 'My Business Settings',
            'company-link-accounts' => 'My Business Link Accounts',
            'calendar-schedule' => 'Calendar Schedule',
            'calendar-settings' => 'Calendar Settings',
            'calendar-appointment-types' => 'Calendar Appointment Types',
            'taskhub' => 'Taskhub',
            'online-booking' => 'Online Booking',
            'lead-contact-form' => 'Lead Contact Form',
            'customer-groups' => 'Customer Groups',
            'customer-settings' => 'Customer Settings',  
            'events' => 'Events',
            'events-settings' => 'Events Settings',
            'jobs' => 'Jobs',
            'job-settings' => 'Job Settings', 
            'job-birds-eye-view' => 'Birds Eye View',
            'service-tickets' => 'Service Tickets',
            'service-ticket-settings' => 'Service Ticket Settings',
            'estimates' => 'Estimates',
            'estimate-settings' => 'Estimate Settings',
            'work-orders' => 'Work Orders',
            'work-order-settings' => 'Work Order Settings',
            'invoices' => 'Invoices',
            'invoice-settings' => 'Invoice Settings',
            'settings-email-templates' => 'Settings Email Templates',
            'settings-sms-templates' => 'Settings SMS Templates',
            'accounting-banking' => 'Accounting Banking',
            'accounting-link-bank' => 'Accounting Link Bank',
            'accounting-credit-notes' => 'Accounting Credit Notes',
            'accounting-estimates' => 'Accounting Estimates',
            'accounting-all-sales' => 'Accounting Sales',
            'api-connectors' => 'API Connectors',
            'esign' => 'eSign',
            'my-library' => 'My Library',
            'before-after-photos' => 'Before and After Photos',
            'accounting-sales-payroll-taxes' => 'Accounting Sales and Payroll Taxes',        
            'accounting-1099-filings' => 'Accounting 1099 Filings',
            'inventory' => 'Inventory',
            //'affiliate-partners' => 'Affiliates / Partners',
            'my-crm' => 'My CRM',
            'my-crm-account-summary' => 'MyCRM Account Summary',
            'monthly-membership' => 'Monthly Membership',
            'cards-on-file' => 'Card on File'
        ];  

        return $modules;
    }

}

/* End of file CompanyRoleAccessModule_model.php */
/* Location: ./application/models/CompanyRoleAccessModule_model.php */
