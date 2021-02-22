<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends MY_Model
{
    public $table = 'jobs';
    public $table_job_settings = 'job_settings';
    public $table_jobs_has_address = 'jobs_has_address';
    public $table_jobs_has_customers = 'jobs_has_customers';
    public $table_jobs_has_employees = 'jobs_has_employees';
    public $table_credit_cards = 'credit_cards';
    public $table_estimates = 'estimates';
    public $table_employees = 'employees';
    public $table_customers = 'customers';
    public $table_address = 'address';
    /**
     * @return mixed
     */
    public function get_all_jobs()
    {
        $cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,LName,FName,acs_profile.first_name,acs_profile.last_name,job_tags.name');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id','left');
        $this->db->join('users', 'users.id = jobs.employee_id','left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags','left');
        $this->db->where("jobs.company_id", $cid);
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * @return mixed
     */
    public function get_specific_job($id)
    {
        $cid=logged('company_id');
        $this->db->from($this->table);
        $this->db->select('jobs.*,LName,FName,acs_profile.first_name,acs_profile.last_name,job_tags.name,job_url_links.link,ja.signature_link,ja.authorize_name,ja.datetime_signed,jpd.*');
        $this->db->join('acs_profile', 'acs_profile.prof_id = jobs.customer_id','left');
        $this->db->join('users', 'users.id = jobs.employee_id','left');
        $this->db->join('job_tags', 'job_tags.id = jobs.tags','left');
        $this->db->join('job_url_links', 'jobs.id = job_url_links.job_id','left');
        $this->db->join('jobs_approval as ja', 'jobs.id = ja.jobs_id','left');
        $this->db->join('jobs_pay_details as jpd', 'jobs.id = jpd.jobs_id','left');
        $this->db->where("jobs.id", $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * @return mixed
     */
    public function getJob($comp_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('company_id', $comp_id);
        $this->db->order_by('date_updated','DESC');
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getAddresses()
    {
        $this->db->select('*');
        $this->db->from('address');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getJobType()
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('job_settings');
        $this->db->order_by('job_settings_id', 'desc');
        $this->db->where('company_id', $comp_id);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function getCustomers()
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('customers');
        $this->db->where('customers.company_id', $comp_id);
        $this->db->join('users', 'users.id = customers.user_id');
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getItems($params)
    {
        $col = ($params != "material" && $params != "service" && $params != "Fees") ? 'item_categories_id' : 'type';
        $comp_id = logged('company_id');
        $array = array('company_id' => $comp_id, $col => $params);

        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($array);
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * @return mixed
     */
    public function getJobDetails($job_num)
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where('jobs.company_id', $comp_id);
        $this->db->where('jobs.job_number', $job_num);
        $this->db->join($this->table_jobs_has_customers, 'jobs.jobs_id = jobs_has_customers.jobs_id');
        $this->db->join($this->table_jobs_has_address, 'jobs.jobs_id = jobs_has_address.jobs_id');
        $query = $this->db->get();

        return $query->row();
    }

        /**
     * @return mixed
     */
    public function getJobInvoiceItems($job_id)
    {
        $comp_id = logged('company_id');
        $this->db->select('*');
        $this->db->from('invoice_has_items');
        $this->db->where('invoice_has_items.job_id', $job_id);
        $this->db->join('items', 'items.id = invoice_has_items.item_id');
        $query = $this->db->get();

        return $query->result_array();
    }
    
    /**
     * @return mixed
     */
    public function updateJob($id, $data)
    {
        $this->db->where('jobs_id',$id);
        $this->db->update('jobs',$data);
    }

    /**
     * @return mixed
     */
    public function deleteJob($id)
    {
        $this->db->delete('jobs', array("jobs_id" => $id));
        $this->db->delete($this->table_jobs_has_address, array("jobs_id" => $id));
        $this->db->delete($this->table_jobs_has_customers, array("jobs_id" => $id));
    }

    /**
     * @return mixed
     */
    public function deleteJobType($id)
    {
        $this->db->delete($this->table_job_settings, array("job_settings_id" => $id));
    }

    /**
     * @return mixed
     */
    public function deleteEstimate($id)
    {
        $this->db->delete($this->table_estimates, array("id" => $id));
    }

    /**
     * @return mixed
     */
    public function updateJobItemQty($id, $value, $type)
    {
        if($type == "add") {
            $newVal = intval($value) + 1;
        } else {
            $newVal = intval($value) - 1;
        }

        $data = array(
            "qty" => $newVal 
        );

        $this->db->where('ihi_id',$id);
        $this->db->update('invoice_has_items',$data);
    }

    /**
     * @return mixed
     */
    public function getJobSettingByName($name)
    {
        $this->db->select('*');
        $this->db->from($this->table_job_settings);
        $this->db->where('value', $name);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * @return mixed
     */
    public function updateJobType($id, $data)
    {
        $this->db->where('job_settings_id',$id);
        $this->db->update($this->table_job_settings, $data);
    }

    /**
     * @return mixed
     */
    public function getEstimateByJobId($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_estimates);
        $this->db->where('job_id', $job_id);
        $query = $this->db->get();

        return $query->result();
    }

    function getEstimateNumber($jobId, $jobNum) {
        $this->db->select("*");
        $this->db->from($this->table_estimates);
        $this->db->where('job_id', $jobId);
        $query = $this->db->get();
        $result = $query->num_rows();

        return $jobNum . "-" . ((intval($result) > 9) ? strval(intval($result) + 1) : "0" . strval(intval($result) + 1));
    }

    public function getAssignEmp($job_id)
    {
        $this->db->select('*');
        $this->db->from($this->table_jobs_has_employees);
        $this->db->where('jobs_id', $job_id);
        $this->db->join("employees", 'jobs_has_employees.employees_id = employees.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getAllUpcomingJobsByCompanyId($company_id = 0)
    {
        $this->db->select('jobs.id, jobs.job_number, jobs.job_name, jobs.job_description, jobs.job_type, jobs.start_date, jobs.end_date, jobs.company_id, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name');

        $this->db->from($this->table);
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');

        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +5 day'));
        
        $this->db->where('jobs.start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        $this->db->where('jobs.company_id', $company_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        //print_r($this->db->last_query());  exit;
        return $query->result();
    }

    public function getAllUpcomingJobs()
    {
        $this->db->select('jobs.id, jobs.job_number, jobs.job_name, jobs.job_description, jobs.job_type, jobs.start_date, jobs.end_date, jobs.company_id, jobs.status, jobs.priority, acs_profile.prof_id, acs_profile.first_name, acs_profile.last_name');

        $this->db->from($this->table);
        $this->db->join('acs_profile', 'jobs.customer_id = acs_profile.prof_id');

        $start_date = date('Y-m-d');
        $end_date   = date('Y-m-d', strtotime($start_date . ' +5 day'));
        
        $this->db->where('jobs.start_date BETWEEN "'. $start_date . '" and "'. $end_date .'"');
        $this->db->order_by('jobs.id', 'DESC');

        $query = $this->db->get();
        return $query->result();
    }
}

/* End of file JobType_model.php */
/* Location: ./application/models/JobType_model.php */
