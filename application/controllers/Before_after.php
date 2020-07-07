<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Before_after extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->page_data['page']->title = 'Before/After';
        $this->page_data['page']->menu = 'before-after';


        add_css(array( 
            'assets/frontend/css/workorder/main.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
        ));
    }

    public function index() {
        $get = $this->input->get();

        $this->page_data['items'] = logged('company_id');
        $comp_id = logged('company_id');

        $comp = array(
            'company_id' => $comp_id
        );

        if (!empty($get['search'])) {
            $this->page_data['search'] = $get['search'];
            $this->page_data['jobs'] = $this->jobs_model->filterBy(['search' => $get['search']], $comp_id);
        }

        $this->load->view('before_after/main', $this->page_data);
    }

    public function addPhoto() {
       $this->page_data['items'] = logged('company_id');
       $this->load->view('before_after/add_photo', $this->page_data); 
    }
}

/* End of file Job.php */

/* Location: ./application/controllers/job.php */