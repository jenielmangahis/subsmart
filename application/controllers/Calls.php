<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'controllers/Widgets.php';

class Calls extends Widgets {

    public function __construct() {
        parent::__construct();
        $this->checkLogin();
		$this->page_data['page']->title = 'Calls and Logs';
        $this->page_data['page']->parent = 'Dashboard';
    }

    public function index() 
    {
        $this->load->helper('sms_helper');
        
        $this->load->model('CompanyCallLogs_model');
        $this->load->model('Customer_advance_model');

        $cid   = logged('company_id');
        $search = '';

        if( get('search') != '' ){
            $search  = get('search');
            $search_param = ['value' => $search];
            $customers = $this->Customer_advance_model->get_company_customer_data($cid, $search_param);
        }else{            
            $customers = $this->Customer_advance_model->get_company_customer_data($cid);
        }

        //$calls = $this->CompanyCallLogs_model->getAllByCompanyId($cid);
        $this->page_data['enable_twilio_call'] = true;
        $this->page_data['search'] = $search;
        $this->page_data['customers'] = $customers;
        //$this->page_data['calls'] = $calls;
        $this->load->view('v2/pages/dashboard/calls.php', $this->page_data);
    }
}