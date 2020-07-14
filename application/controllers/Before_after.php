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
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
            'assets/frontend/css/workorder/main.css',
            'assets/css/beforeafter.css',
        ));

        // JS to add only Job module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/beforeafter/main.js'
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