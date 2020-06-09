<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Builder_model extends MY_Model {
	public $table_jobs = 'jobs';
	public $table_jobs_has_custom_forms = 'jobs_has_custom_forms';
	public $table_jobs_row_entry = 'jobs_row_entry';
	public $table_custom_forms = 'custom_forms';
	public $table_form_responses = 'form_responses';
    public $table_form_responses_rows = 'form_responses_rows';
	public $table_options = 'options';
	public $table_questions = 'questions';

	public function __construct(){
		parent::__construct();
	}

	public function get_jobs() {

        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from($this->table_jobs);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_forms($id = 0) {

        if( $id  == 0 )
        {
            $company_id = logged('company_id');
            $this->db->select('*');
            $this->db->from($this->table_custom_forms);
            $this->db->where('company_id', $company_id);
            $query = $this->db->get();
            return $query->result();
        } else {
            $company_id = logged('company_id');
            $this->db->select('*');
            $this->db->from($this->table_custom_forms);
            $this->db->where('company_id', $company_id);
            $query=$this->db->get();
            $row=$query->row();
            return $row;
        }
    }

    public function get_forms_questions($id) {

        $company_id = logged('company_id');
        $this->db->select('*');
        $this->db->from($this->table_questions);
        $this->db->order_by("question_order", "asc");
        $this->db->where('company_id', $company_id);
        $this->db->where('forms_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_forms_questions_options($id) {

        $this->db->select('*');
        $this->db->from($this->table_options);
        $this->db->order_by("option_order", "asc");
        $this->db->where('question_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_jobs_forms() {

        $company_id = logged('company_id');
        $this->db->select(['custom_forms.*' , 'jobs.job_name' , 'jobs.job_type']);
	    $this->db->from('custom_forms');
    	$this->db->join('jobs_has_custom_forms', 'custom_forms.forms_id = jobs_has_custom_forms.forms_id', 'inner');
    	$this->db->join('jobs', 'jobs_has_custom_forms.jobs_id = jobs.jobs_id', 'inner');
        $this->db->where('custom_forms.company_id', $company_id);
        $this->db->where('jobs.company_id', $company_id);
        $query = $this->db->get();
        return $query->result();
    }

    // public function get_jobs_forms() {

    //     $this->db->select(['custom_forms.*','jobs.name','jobs.name','jobs.slug']);
	   //  $this->db->from('custom_forms');
    // 	$this->db->join('jobs_has_custom_forms', 'custom_forms.id = jobs_has_custom_forms.forms_id', 'inner');
    // 	$this->db->join('jobs', 'jobs_has_custom_forms.jobs_id = jobs.id', 'inner');

    //     $query = $this->db->get();

    //     return $query->result();
    // }

}

/* End of file Permissions_model.php */
/* Location: ./application/models/Permissions_model.php */