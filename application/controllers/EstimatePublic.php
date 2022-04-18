<?php

defined('BASEPATH') or exit('No direct script access allowed');


class EstimatePublic extends MY_P_Controller
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
        $this->load->model('Jobs_model', 'jobs_model');
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

    public function view_public($id)
    {        
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $data = array(
            'id' => $id,
            'is_mail_open' => 1,
        );

        $estimate = $this->estimate_model->getById($id);
        // dd($estimate_mail);
        // $company_id = logged('company_id');

        if ($estimate) {
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $client   = $this->Clients_model->getByIdPub($estimate->company_id);
            $client_profile   = $this->Clients_model->getByIdPubClientProf($client->id);
            
            $estimate_mail = $this->estimate_model->mailIsOpen($data);
            
            $this->page_data['customer'] = $customer;
            $this->page_data['client'] = $client;
            $this->page_data['estimate'] = $estimate;
            $this->page_data['client_profile'] = $client_profile;

            // $this->page_data['items_data'] = $this->estimate_model->getItems($id);
            $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);
            $this->page_data['items_options'] = $this->estimate_model->getItemOption($id);
            // $this->page_data['items_dataOP2'] = $this->estimate_model->getItemlistByIDOption2($id);

            $this->page_data['items_dataBD1'] = $this->estimate_model->getItemlistByIDBundle1($id);
            $this->page_data['items_dataBD2'] = $this->estimate_model->getItemlistByIDBundle2($id);

            $this->load->view('estimate/publicview', $this->page_data);
        } else {
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('estimate');
        }
    }
}