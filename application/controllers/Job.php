<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->page_data['page']->title = 'Job Management';
        $this->page_data['page']->menu = 'job';
        $this->load->model('Jobs_model', 'jobs_model');

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'assets/frontend/css/invoice/main.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'assets/frontend/js/invoice/add.js',
            'assets/frontend/js/inventory/main.js',
            'assets/js/invoice.js'
        ));
    }

    public function index()
    {
        $get = $this->input->get();

        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');

        $comp = array(
            'company_id' => $comp_id
        );
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, $comp)->result();

        if (!empty($get['search'])) {
            $this->page_data['search'] = $get['search'];
            $this->page_data['jobs'] = $this->jobs_model->filterBy(['search' => $get['search']], $comp_id);
        } else {
            $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => $comp_id]);
        }

        $this->load->view('job/list', $this->page_data);
    }

    public function new_job() {
        $get = $this->input->get();

        $this->page_data['items'] = $this->items_model->get();
        $comp_id = logged('company_id');

        $comp = array(
            'company_id' => $comp_id
        );
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, $comp)->result();
        $this->load->view('job/job', $this->page_data);
    }

    public function saveJob() {
        postAllowed();
        $comp_id = logged('company_id');

        $data = array(
            'company_id' => $comp_id,
            'job_number' => $this->input->post('jobNumber'),
            'job_name' => $this->input->post('job_name'),
            'job_type' => $this->input->post('job_type'),
            'created_by' => $this->input->post('createdBy'),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->jobs_model->table, $data);

        $this->activity_model->add("New Job #$categories Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Job Created Successfully');

        redirect('job');
    }
}



/* End of file Job.php */

/* Location: ./application/controllers/job.php */