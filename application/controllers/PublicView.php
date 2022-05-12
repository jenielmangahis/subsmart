<?php

defined('BASEPATH') or exit('No direct script access allowed');


class PublicView extends MY_P_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->hasAccessModule(19); 
        // $this->page_data['page']->title = 'My Estimates';
        // $this->page_data['page']->menu = 'estimates';
		$this->page_data['page']->title = 'Estimates';
        $this->page_data['page']->parent = 'Sales';
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('Customer_model', 'customer_model');
        $this->load->model('items_model');
        $this->load->model('accounting_invoices_model');
        
        // $this->checkLogin();

        // $user_id = getLoggedUserID();

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

    public function employee_ibiz($id)
    {        
        // echo $id; 
        $uIbiz = $this->customer_model->getuserIbiz($id);
        $this->page_data['uIbiz'] = $uIbiz;
        // foreach($uIbiz as $ub)
        // {
        //     $ubID = $ub->user_id;
        // }
        $this->page_data['userIbiz'] = $this->customer_model->getuserIB($id);
        $this->page_data['ibizDetailsAdd'] = $this->customer_model->getibizDetailsAdd($id);
        $this->page_data['ibizDetailsPh'] = $this->customer_model->getibizDetailsPh($id);
        $this->page_data['ibizDetailsEmail'] = $this->customer_model->ibizDetailsEmail($id);
        // dd($uIbiz->user_id);

        $this->load->view('customer/customer_ibiz', $this->page_data);
    }

    public function update_email()
    {
        $emailID = $this->input->post('emailID');

        $update_data = array(
            'id'          => $this->input->post('emailID'),
            'value'       => $this->input->post('valueEml'),
        );

        $addQuery = $this->customer_model->update_ibiz_details($update_data);
        
        // echo $emailID;
        echo json_encode($addQuery);
    }

    public function update_phone()
    {

        $update_data = array(
            'id'          => $this->input->post('phoneID'),
            'value'       => $this->input->post('valuePh'),
        );

        $addQuery = $this->customer_model->update_ibiz_details($update_data);
        
        echo json_encode($addQuery);
    }

    public function update_address()
    {

        $update_data = array(
            'id'          => $this->input->post('addressID'),
            'value'       => $this->input->post('valueAdd'),
        );

        $addQuery = $this->customer_model->update_ibiz_details($update_data);
        
        echo json_encode($addQuery);
    }
}