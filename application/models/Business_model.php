<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Business_model extends MY_Model
{
    public $table = 'business_profile';
    public function __construct()
    {
        parent::__construct();
    }

    public function getByUserId($id)
    {
        $user_id = logged('id');

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('user_id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getById($id)
    {

        $this->db->select('*');
        $this->db->from($this->table);

        $this->db->where('id', $id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyId($company_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByProfileSlug($profile_slug)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('profile_slug', $profile_slug);

        $query = $this->db->get()->row();
        return $query;
    }

    // Balance Sheet Summary 4
    public function update_clients_name($business_name, $clientId)
    {
        $data = [
            'business_name' => strtoupper($business_name)
        ];

        $this->db->where('id', $clientId); 
        return $this->db->update('clients', $data);
    }

    // Balance Sheet 5
    public function update_business_name($business_name)
    {
        $data = [
            'business_name' => strtoupper($business_name)
        ];

        $this->db->where('company_id', logged('company_id'));
        return $this->db->update('business_profile', $data);
    }

    public function getBySlug($slug)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('profile_slug', $slug);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyProfileImage($company_id)
    {
        $this->db->select('id,company_id,business_image');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function getByCompanyCoverPhoto($company_id)
    {
        $this->db->select('id,company_id,business_cover_photo');
        $this->db->from($this->table);
        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    // Use this method for updating data using is_updated field.
    public function getAllIsNotUpdated($limit = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('is_updated', 0);

        if( $limit > 0 ){
            $this->db->limit($limit);
        }        

        $query = $this->db->get();
        return $query->result();
    }

    public function getAll()
    {
        $this->db->select('business_profile.*');
        $this->db->join('clients', 'business_profile.company_id = clients.id', 'left');
        $this->db->join('industry_type', 'clients.industry_type_id = industry_type.id', 'left');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result();
    }

    public function deleteByCompanyId($company_id)
    {
        $this->db->delete($this->table, array('company_id' => $company_id));
    }

    public function getByCompanyFieldsByCompanyId($company_id, $fields)
    {
        $fields = implode(",", $fields);
        $this->db->select($fields);
        $this->db->from($this->table);

        $this->db->where('company_id', $company_id);

        $query = $this->db->get()->row();
        return $query;
    }

    public function updateByCompanyId($cid, $data)
    {
        $this->db->from($this->table);
        $this->db->set($data);
        $this->db->where('company_id', $cid);
        $this->db->update();
    }

    public function getAnalyticsData($category)
    {
        $company_id = logged('company_id');
        switch ($category) {
            case 'business_profile':
                $this->db->select('*');
                $this->db->from('business_profile');
                $this->db->where('business_profile.company_id', $company_id);
                $query = $this->db->get();
                return $query->row();
                break;
            case 'total_invoices':
                $this->db->select('SUM(invoices.grand_total) AS total_invoices');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $query = $this->db->get();
                return $query->row()->total_invoices;
                break;
            case 'total_estimates':
                $this->db->select('SUM(estimates.grand_total) AS total_estimates');
                $this->db->from('estimates');
                $this->db->where('estimates.company_id', $company_id);
                $query = $this->db->get();
                return $query->row()->total_estimates;
                break;
            case 'total_customers':
                $this->db->select('COUNT(acs_profile.prof_id) AS total_customers');
                $this->db->from('acs_profile');
                $this->db->where('acs_profile.company_id', $company_id);
                $this->db->where('acs_profile.activated', 1);
                $query = $this->db->get();
                return $query->row()->total_customers;
                break;
            case 'total_active_deals':
                $this->db->select('COUNT(invoices.id) AS total_active_deals');
                $this->db->from('invoices');
                $this->db->where('invoices.company_id', $company_id);
                $this->db->where('invoices.status !=', "Paid");
                $query = $this->db->get();
                return $query->row()->total_active_deals;
                break;
            case 'business_view_count':
                // How many times your business has been viewed by customers
                $this->db->select('COUNT(visit_analytics_info.id) AS business_view_count');
                $this->db->from('visit_analytics_info');
                $this->db->where('visit_analytics_info.company_id', $company_id);
                $this->db->where('visit_analytics_info.category', "business_profile_visit");
                $query = $this->db->get();
                return $query->row()->business_view_count;
                break;
            case 'business_contact_view_count':
                // How many times customers have seen your contact details
                $this->db->select('COUNT(visit_analytics_info.id) AS business_contact_view_count');
                $this->db->from('visit_analytics_info');
                $this->db->where('visit_analytics_info.company_id', $company_id);
                $this->db->where('visit_analytics_info.category', "business_contact_visit");
                $query = $this->db->get();
                return $query->row()->business_view_count;
                break;
            case 'total_job_posted_count':
                // All jobs posted in your coverage areas, that are requesting business services you are offering
                $this->db->select('COUNT(jobs.id) AS total_job_posted_count');
                $this->db->from('jobs');
                $this->db->where('jobs.company_id', $company_id);
                $this->db->where('jobs.status !=', "Draft");
                $query = $this->db->get();
                return $query->row()->total_job_posted_count;
                break;
            case 'total_job_leads_count':
                // The total number of job leads, you have been invited to estimate
                $this->db->select('COUNT(ac_leads.leads_id) AS total_job_leads_count');
                $this->db->from('ac_leads');
                $this->db->where('ac_leads.company_id', $company_id);
                $query = $this->db->get();
                return $query->row()->total_job_leads_count;
                break;
        }
    }

    public function customerDeviceLookup($category, $ip_address, $user_agent)
    {
        $company_id = logged('company_id');
        $unique_id = md5($ip_address . $user_agent);
        $current_month_start = date('Y-m-01 00:00:00');

        $this->db->where('company_id', $company_id);
        $this->db->where('unique_id', $unique_id);
        $this->db->where('category', $category);
        $this->db->where('created_at >=', $current_month_start); 
        $query = $this->db->get('visit_analytics_info');

        if ($query->num_rows() > 0) {
            return 'exist';
        } else {
            $data = [
                'company_id' => $company_id,
                'unique_id' => $unique_id,
                'category' => $category,
                'ip_address' => $ip_address,
                'user_agent' => $user_agent,
            ];

            $this->db->insert('visit_analytics_info', $data);
            return 'recorded';
        }
    }

    public function optionBusinessTypes()
    {
        $options = [
            'Individual / Sole Proprietor' => 'Individual / Sole Proprietor', 
            'C Corporation' =>'C Corporation',
            'S Corporation' => 'S Corporation',
            'Partnership' => 'Partnership',
            'Trust / Estate' => 'Trust / Estate'
        ];

        return $options;
    }

}

/* End of file Business_model.php */

/* Location: ./application/models/Business_model.php */