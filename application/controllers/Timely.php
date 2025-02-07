<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Timely extends MY_Controller
{
    private $technicians = [];

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title  = 'Timely';
        $this->page_data['page']->parent = 'Timely';

        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('Users_model', 'users_model');

        $company_id = logged('company_id');
    }

    public function index()
    {
         add_css(array(
            'assets/css/bootstrap-multiselect.min.css',
        ));

        add_footer_js(array(
            'assets/js/bootstrap-multiselect.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.js',
        ));
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->load->view('v2/pages/timely/list', $this->page_data);
    }

}
