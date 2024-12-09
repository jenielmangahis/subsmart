<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Widgets_model extends MY_Model
{
    public function loadTechLeaderboard($comp_id)
    {
        $this->db->from('users');
        $this->db->select('users.id,users.FName,users.LName,count(*) as totalJobs');
        $this->db->where('users.company_id', $comp_id);
        $this->db->join('jobs', 'jobs.employee_id = users.id', 'right');
        $this->db->where('jobs.status', 'Completed');
        $this->db->group_by('jobs.employee_id');
        $this->db->order_by('totalJobs', 'DESC');

        return $this->db->get()->result();
    }

    public function getOverdueInvoices($comp_id)
    {
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id', 'right');
        $this->db->where('invoices.company_id', $comp_id);
        $this->db->where('due_date <', date('Y-m-d'));

        return $this->db->get('invoices')->result();
    }

    public function getCurrentCompanyOverdueInvoices()
    {
        $company_id = logged('company_id');
        $this->db->from('invoices');
        $this->db->select('
            invoices.id,
            invoices.invoice_number,
            invoices.due_date,
            invoices.status,
            acs_profile.email AS customer_email,
            acs_profile.first_name, 
            acs_profile.last_name,
            acs_profile.fk_user_id as user_id,
            invoices.grand_total,
            invoices.grand_total  as balance
        ');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-14 days')));
        $this->db->where('invoices.company_id', $company_id);
        $this->db->order_by("invoices.invoice_number DESC");
        $query = $this->db->get();
        return $results = $query->result();

      
    }

    public function getCurrentCompanyOverdueInvoices2()
    {
        $company_id = logged('company_id');
        $this->db->from('invoices');
        $this->db->select('
            invoices.id,
            invoices.invoice_number,
            invoices.due_date,
            invoices.status,
            acs_profile.email AS customer_email,
            acs_profile.first_name, 
            acs_profile.last_name,
            acs_profile.fk_user_id as user_id,
            invoices.grand_total,
            invoices.grand_total as balance
        ');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.status !=', "Paid");
        $this->db->where('invoices.status !=', "Draft");
        $this->db->where('invoices.status !=', "");
        $this->db->where('invoices.view_flag', 0);
        $this->db->where('invoices.due_date <', date('Y-m-d', strtotime('-14 days')));
        $this->db->where('invoices.company_id', $company_id);
        $this->db->order_by("invoices.invoice_number DESC");
        $query = $this->db->get();
        return $results = $query->result();

      
    }

    public function getNsmartSales(){
        $this->db->from('clients');
        $this->db->select('nsmart_plans.price AS price , nsmart_plans.discount AS discount, clients.plan_date_registered');
        $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');
        $query = $this->db->get();
        return $results = $query->result();
    }

    public function getNsmartSalesTotal(){
        $this->db->from('clients');
        $this->db->select('SUM(nsmart_plans.price - nsmart_plans.discount) AS total');
        $this->db->join('nsmart_plans', 'nsmart_plans.nsmart_plans_id = clients.nsmart_plan_id', 'left');
        $query = $this->db->get();
        return $results = $query->row();
    }

    public function getDemoSchedule(){
        

    }

    public function getTags()
    {
        $this->db->where('company_id', getLoggedCompanyID());

        return $this->db->get('job_tags')->result();
    }

    public function getTagsWithCount($company_id)
    {
        $this->db->select('job_tags.id, job_tags.name, job_tags.company_id');
        $this->db->select('(SELECT COUNT(*) 
                            FROM jobs 
                            WHERE jobs.tags = job_tags.name) AS total_job_tags');
        $this->db->from('job_tags');
        $this->db->where('job_tags.company_id', $company_id);
    
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getLeadSource($comp_id)
    {
        $this->db->select('fk_lead_id, COUNT(fk_lead_id) as leadSource, lead_name');
        $this->db->where('company_id', $comp_id);
        $this->db->join('ac_leadtypes', 'ac_leads.fk_lead_id = ac_leadtypes.lead_id', 'right');
        $this->db->group_by('fk_lead_id');

        return $this->db->get('ac_leads')->result();
    }

    public function changeOrder($id, $user_id, $isMain, $details)
    {
        $this->db->where('wu_user_id', $user_id);
        $this->db->where('wu_widget_id', $id);
        $this->db->where('wu_is_main', $isMain);

        return $this->db->update('widgets_users', $details);
    }

    public function addToMain($user_id, $id)
    {
        $this->db->where('wu_user_id', $user_id);
        $this->db->where('wu_widget_id', $id);
        $q = $this->db->get('widgets_users');
        if ($q->num_rows() > 0) {
            $isMain = $q->row()->wu_is_main;
            if ($isMain == 0) {
                $details = ['wu_is_main' => 1];

                $this->db->where('wu_user_id', $user_id);
                $this->db->where('wu_widget_id', $id);
                if ($this->db->update('widgets_users', $details)) {
                    return true;
                }
            } else {
                $details = ['wu_is_main' => 0];

                $this->db->where('wu_user_id', $user_id);
                $this->db->where('wu_widget_id', $id);
                if ($this->db->update('widgets_users', $details)) {
                    return true;
                }
            }
        } else {
            $details = ['wu_user_id' => $user_id, 'wu_widget_id' => $id, 'wu_is_main' => 1];

            if ($this->db->insert('widgets_users', $details)) {
                return true;
            }
        }
    }

    public function getWidgetByID($id)
    {
        $this->db->where('w_id', $id);

        return $this->db->get('widgets')->row();
    }

    public function removeWidget($id, $user_id)
    {
        $this->db->where('wu_company_id !=', 0);
        $this->db->where('wu_widget_id', $id);
        $isCompany = $this->db->get('widgets_users');
        if ($isCompany->num_rows() > 0) {
            $this->db->where('wu_company_id !=', 0);
            $this->db->where('wu_widget_id', $id);
            $this->db->where('wu_user_id', $user_id);

            $isCompany = $this->db->get('widgets_users');
            if ($isCompany->num_rows() > 0) {
                $details = [
                    'success' => true,
                    'message' => 'Successfully removed',
                ];
            } else {
                $details = [
                    'success' => false,
                    'message' => 'Sorry you cannot remove a widget set by the company',
                ];
            }
        } else {
            $this->db->where('wu_widget_id', $id);
            $this->db->where('wu_user_id', $user_id);
            if ($this->db->delete('widgets_users')) {
                $details = [
                    'success' => true,
                    'message' => 'Successfully removed',
                ];
            } else {
                $details = [
                    'success' => false,
                    'message' => 'Something went wrong',
                ];
            }
        }

        return json_encode($details);
    }

    public function removeCompanyWidget($id, $company_id)
    {
        $this->db->where('wu_widget_id', $id);
        $this->db->where('wu_company_id', $company_id);
        if ($this->db->delete('widgets_users')) {
            $details = [
                'success' => true,
                'message' => 'Successfully removed',
            ];
        } else {
            $details = [
                'success' => false,
                'message' => 'Cannot find widget',
            ];
        }

        return json_encode($details);
    }

    public function addWidgets($details)
    {
        if ($this->db->insert('widgets_users', $details)) {
            return true;
        } else {
            return false;
        }
    }

    public function getWidgetsList()
    {
        //        $query = "Select * FROM widgets WHERE NOT EXISTS(SELECT * FROM widgets_users WHERE widgets.w_id = widgets_users.wu_widget_id AND wu_user_id = $user_id)";
        //        return $this->db->query($query)->result();
        //   return $this->db->get('widgets')->result();

        $this->db->where('w_main =', 0);
        $query = $this->db->get('widgets');

        return $query->result();
    }



    public function getThumbnailsList($companyId)
    {
        $this->db->where('widgets.w_main !=', 0);
        $this->db->order_by('widgets.w_name', 'ASC');
        $query = $this->db->get('widgets');
    
        $widgets = $query->result();
    
        usort($widgets, function ($a, $b) {
            if ($a->w_sort == 1 && $b->w_sort != 1) {
                return -1;
            }
            if ($a->w_sort != 1 && $b->w_sort == 1) {
                return 1;
            }
            return strcmp($a->w_name, $b->w_name);
        });
    
        $filtered_widgets = array_filter($widgets, function ($widget) use ($companyId) {
            // Convert $companyId to string for proper comparison
            if (($widget->w_name === 'nSmart Sales' || $widget->w_name === 'Demo Schedules') && $companyId !== '1') {
                return false; 
            }
            return true; 
        });
    
        return $filtered_widgets;
    }
    


    public function getWidgetListPerUser($user_id)
    {
        $company_id = getLoggedCompanyID();

        $this->db->join('widgets', 'widgets_users.wu_widget_id = widgets.w_id', 'left');
        $this->db->where('wu_user_id', $user_id);
        $this->db->order_by('wu_order', 'ASC');
        $q1 = $this->db->get('widgets_users')->result();

        $this->db->join('widgets', 'widgets_users.wu_widget_id = widgets.w_id', 'left');
        $this->db->where('wu_company_id', $company_id);
        $this->db->order_by('wu_order', 'ASC');
        $q2 = $this->db->get('widgets_users')->result();

        $details = array_unique(array_merge($q2, $q1), SORT_REGULAR);

        return $details;
    }

    public function getWidgetsByCompanyId($company_id)
    {
        $this->db->join('widgets', 'widgets_users.wu_widget_id = widgets.w_id', 'left');
        $this->db->where('wu_company_id', $company_id);
        $this->db->order_by('wu_order', 'ASC');
        $this->db->group_by('widgets_users.wu_widget_id');
        $result = $this->db->get('widgets_users')->result();

        return $result;
    }

    public function updateListView($id, $val)
    {
        $this->db->where('w_id', $id);

        return $this->db->update('widgets', [
            'w_list_view' => $val,
        ]);
    }

    public function getWidgetByCompanyIdAndWidgetId($cid, $wid)
    {
        $this->db->select('*');
        $this->db->from('widgets_users');
        $this->db->where('wu_company_id', $cid);
        $this->db->where('wu_widget_id', $wid);

        $query = $this->db->get();
        return $query->row();
    }

    public function updateUserWidget($wid, $data)
    {
        $this->db->where('wu_id', $wid);
        return $this->db->update('widgets_users', $data);
    }
}
