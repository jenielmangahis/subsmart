<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Credit_Notes extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->page_data['page']->title = 'Credit Notes';
        $this->page_data['page']->menu = 'credit_notes';
        $this->load->model('CreditNote_model');

        $this->checkLogin();

        $user_id = getLoggedUserID();

        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
			"assets/css/accounting/sidebar.css",
        ));

        add_footer_js(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/estimate/estimate.js',
        ));
    }

    public function index($tab = '')
    {
        
        $status = $this->CreditNote_model->optionStatus();

        $this->page_data['status'] = $status;
        $this->load->view('credit_notes/list', $this->page_data);
    }

    public function add_new()
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $role = logged('role');
        if( $role == 1 || $role == 2 ){
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();    
        }
        
        $this->load->view('credit_notes/add', $this->page_data);
    }
}