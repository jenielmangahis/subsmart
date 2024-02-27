<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Widgets_model extends MY_Model {
    
    function loadTechLeaderboard($comp_id)
    {
        $this->db->from('users');
        $this->db->select('users.id,users.FName,users.LName,count(*) as totalJobs');
        $this->db->where('users.company_id', $comp_id);
        $this->db->join('jobs', 'jobs.employee_id = users.id','right');
        $this->db->where('jobs.status', 'Completed');
        $this->db->group_by('jobs.employee_id');
        $this->db->order_by('totalJobs', 'DESC');
        return $this->db->get()->result();

    }
    
    function getOverdueInvoices($comp_id)
    {
        $this->db->join('acs_profile', 'invoices.customer_id = acs_profile.prof_id','right');
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
            invoices.grand_total - COALESCE(SUM(accounting_receive_payment_invoices.payment_amount), 0) as balance
        ');
        $this->db->join('accounting_receive_payment_invoices', 'accounting_receive_payment_invoices.invoice_id = invoices.id', 'left');
        $this->db->join('acs_profile', 'acs_profile.prof_id = invoices.customer_id', 'left');
        $this->db->where('invoices.company_id', $company_id);
        $this->db->where('invoices.grand_total >', 0);
        $this->db->where_in('invoices.status', ['Submitted', 'Partially Paid', 'Due', 'Overdue', 'Approved', 'Schedule']);
        $this->db->where('invoices.due_date !=', null);
        $this->db->where("STR_TO_DATE(invoices.due_date, '%Y-%m-%d') < CURRENT_DATE()");
        $this->db->group_by('invoices.id');
        $this->db->order_by("STR_TO_DATE(invoices.due_date, '%Y-%m-%d') ASC");
        $query = $this->db->get();
        $results = $query->result();

        return array_filter($results, function($result) {
            return $result->balance > 0;
        });
    }

    function getTags()
    {
        $this->db->where('company_id' , getLoggedCompanyID());
        return $this->db->get('job_tags')->result();
    }

    function rawGetTagsWithCount($company_id)
    {
        $sql = 'SELECT job_tags.id, job_tags.name, job_tags.company_id, (SELECT COUNT(*) FROM jobs WHERE DATE_FORMAT(jobs.date_issued, "%Y") = DATE_FORMAT(CURDATE(), "%Y") AND jobs.tags = job_tags.name) AS total_job_tags FROM job_tags WHERE job_tags.company_id = '.$company_id.' ';
        $query = $this->db->query($sql);
        return $query->result();
    }
    
    function getLeadSource($comp_id)
    {
         $this->db->select('fk_lead_id, COUNT(fk_lead_id) as leadSource, lead_name');
         $this->db->where('company_id', $comp_id);
         $this->db->join('ac_leadtypes', 'ac_leads.fk_lead_id = ac_leadtypes.lead_id','right');
         $this->db->group_by('fk_lead_id');
         return $this->db->get('ac_leads')->result();
    }
    
    function changeOrder($id, $user_id, $isMain, $details)
    {
        $this->db->where('wu_user_id', $user_id);
        $this->db->where('wu_widget_id', $id);
        $this->db->where('wu_is_main', $isMain);
        return $this->db->update('widgets_users', $details);
        
    }
    
    function addToMain($user_id, $id)
    {
        $this->db->where('wu_user_id', $user_id);
        $this->db->where('wu_widget_id', $id);
        $q = $this->db->get('widgets_users');
        if($q->num_rows() > 0):
            $isMain = $q->row()->wu_is_main;
            if($isMain==0):
                $details = array('wu_is_main' => 1);
                
                $this->db->where('wu_user_id', $user_id);
                $this->db->where('wu_widget_id', $id);
                if($this->db->update('widgets_users', $details)):
                    return true;
                endif;
            else:
                $details = array('wu_is_main' => 0);
                
                $this->db->where('wu_user_id', $user_id);
                $this->db->where('wu_widget_id', $id);
                if($this->db->update('widgets_users', $details)):
                    return true;
                endif;
            endif;
        else:
            $details = array('wu_user_id'=> $user_id, 'wu_widget_id'=> $id, 'wu_is_main' => 1);
                
            if($this->db->insert('widgets_users', $details)):
                return true;
            endif;
            
        endif;
    }
    
    function getWidgetByID($id)
    {
        $this->db->where('w_id', $id);
        return $this->db->get('widgets')->row();
    }
    
    function removeWidget($id, $user_id)
    {
        $this->db->where('wu_company_id !=', 0);
        $this->db->where('wu_widget_id', $id);
        $isCompany = $this->db->get('widgets_users');
        if($isCompany->num_rows() > 0):
            
            $this->db->where('wu_company_id !=', 0);
            $this->db->where('wu_widget_id', $id);
            $this->db->where('wu_user_id', $user_id);
            
            $isCompany = $this->db->get('widgets_users');
            if($isCompany->num_rows() > 0):
                $details = array(
                    'success' => true,
                    'message' => 'Successfully removed'
                );
            else:
                $details = array(
                    'success' => false,
                    'message' => 'Sorry you cannot remove a widget set by the company'
                );
            endif;
            
        else:
            $this->db->where('wu_widget_id', $id);
            $this->db->where('wu_user_id', $user_id);
            if($this->db->delete('widgets_users')):
                $details = array(
                    'success' => true,
                    'message' => 'Successfully removed'
                );
            else:
                $details = array(
                    'success' => false,
                    'message' => 'Something went wrong'
                );
            endif;
        endif;
        
        return json_encode($details);
    }

    function addWidgets($details)
    {
        if($this->db->insert('widgets_users', $details)):
            return true;
        else:
            return false;
        endif;
    }
    
    function getWidgetsList($user_id)
    {
//        $query = "Select * FROM widgets WHERE NOT EXISTS(SELECT * FROM widgets_users WHERE widgets.w_id = widgets_users.wu_widget_id AND wu_user_id = $user_id)";
//        return $this->db->query($query)->result();
        return $this->db->get('widgets')->result();
    }
    
    function getWidgetListPerUser($user_id)
    {
        $company_id = getLoggedCompanyID();
        
        $this->db->join('widgets','widgets_users.wu_widget_id = widgets.w_id','left');
        $this->db->where('wu_user_id', $user_id);
        $this->db->order_by('wu_order', 'ASC');
        $q1 = $this->db->get('widgets_users')->result();
        
        $this->db->join('widgets','widgets_users.wu_widget_id = widgets.w_id','left');
        $this->db->where('wu_company_id', $company_id);
        $this->db->order_by('wu_order', 'ASC');
        $q2 = $this->db->get('widgets_users')->result();
        
        $details =  array_unique(array_merge($q2, $q1), SORT_REGULAR);
        
        return $details;
        
    }

    function getWidgetsByCompanyId($company_id)
    {
        $this->db->join('widgets','widgets_users.wu_widget_id = widgets.w_id','left');
        $this->db->where('wu_company_id', $company_id);
        $this->db->order_by('wu_order', 'ASC');
        $this->db->group_by('widgets_users.wu_widget_id'); 
        $result = $this->db->get('widgets_users')->result();
        return $result;
        
    }

}
