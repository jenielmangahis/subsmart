<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->page_data['page']->title = 'Job Management';
        $this->page_data['page']->menu = 'job';
        $this->load->library('paypal_lib');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Invoice_model', 'invoice_model');


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

    public function index() {
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
        $this->page_data['invoices'] = $this->invoice_model->getByWhere(['company_id' => $comp_id]);
        
        if (empty($get['job_num'])) {
            $comp = array(
                'company_id' => $comp_id
            );
        } else { 
            $comp = array(
                'company_id' => $comp_id,
                'job_number' => $get['job_num']
            );
        }
        $this->page_data['job_settings'] = $this->db->get_where($this->jobs_model->table_job_settings, array('company_id' => $comp_id))->result();
        $this->page_data['items_categories'] = $this->db->get_where($this->items_model->table_categories, array('company_id' => $comp_id))->result();
        $job_num_query = $this->db->order_by("jobs_id", "desc")->get_where($this->jobs_model->table, $comp)->row();
        if ($job_num_query && empty($get['job_num'])) {
            $this->page_data['job_number'] = intval($this->db->order_by("jobs_id", "desc")->get_where($this->jobs_model->table, array('company_id' => $comp_id))->row()->job_number) + 1;
        } else {
           $this->page_data['job_other_info'] = (!empty($get['job_num'])) ? $this->jobs_model->getJobDetails($get['job_num']) : null;
           $this->page_data['job_number'] = (!empty($get['job_num'])) ? $get['job_num'] : 1000;
           $this->page_data['job_data'] = $job_num_query;
        }
        
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
            'priority' => $this->input->post('job_priority'),
            'status' => $this->input->post('job_status'),
            'created_by' => $this->input->post('createdBy'),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->db->insert($this->jobs_model->table, $data);
        $jobs_id = $this->db->insert_id();

        $address_data = array(
            'jobs_id' => $jobs_id,
            'address_id' => $this->input->post('job_location_id')
        );
        $this->db->insert($this->jobs_model->table_jobs_has_address, $address_data);

        $customers_data = array(
            'jobs_id' => $jobs_id,
            'id' => $this->input->post('job_customer_id')
        );
        $this->db->insert($this->jobs_model->table_jobs_has_customers, $customers_data);

        $this->saveCreditCard();

        $this->activity_model->add("New Job #$categories Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'New Job Created Successfully');

        redirect('job');
    }

    public function delete () {
        $get = $this->input->get();
        
        $this->jobs_model->deleteJob($get['id']);

        redirect('job');
    }

    public function updateJob() {
        postAllowed();
        $comp_id = logged('company_id');
        $id = $this->input->post('jobId');

        $data = array(
            'company_id' => $comp_id,
            'job_number' => $this->input->post('jobNumber'),
            'job_name' => $this->input->post('job_name'),
            'job_type' => $this->input->post('job_type'),
            'priority' => $this->input->post('job_priority'),
            'status' => $this->input->post('job_status'),
            'created_by' => $this->input->post('createdBy'),
            'created_date' => date('Y-m-d H:i:s')
        );
        $this->jobs_model->updateJob($id, $data);

        $this->activity_model->add("Updated Job #$categories Created by User: #" . logged('id'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Job Updated Successfully');

        redirect('job');
    }

    public function getCustomers() {

        $result = $this->jobs_model->getCustomers();

        echo json_encode($result);
    }
    
    public function getAddresses() {

        $result = $this->jobs_model->getAddresses();

        echo json_encode($result);
    }

    public function getItems() {
        $get = $this->input->get();

        $result = $this->jobs_model->getItems($get['index']);

        echo json_encode($result);
    }

    public function saveInvoice() {
        postAllowed();

        $comp_id = logged('company_id');
        $date_created = date_format(date_create($this->input->post('createdDate')),"Y-m-d H:i:s");

        $data = array(
            'company_id' => $comp_id,
            'customer_id' => $this->input->post('customer_id'),
            'created_date' => $date_created,
            'total_due' => $this->input->post('totalDue'),
            'balance' => $this->input->post('balance'),
            'due_date' => date('Y-m-d H:i:s'),
            'billing_type' => $this->input->post('billingType'),
            'job_id' => $this->input->post('jobId'),
            'created_by' => logged('id'),
            'status' => $this->input->post('status'),
            'invoice_number' => $this->input->post('invoiceNumber')
        );
        $this->db->insert($this->invoice_model->table, $data);
        echo json_encode($data);
    }

    public function buy($id){
        // Set variables for paypal form
        $returnURL = base_url().'paypal/success';
        $cancelURL = base_url().'paypal/cancel';
        $notifyURL = base_url().'paypal/ipn';
        
        // Get product data from the database
        $product = $this->invoice_model->getRows($id);
        
        // Get current user ID from the session
        $userID = logged('id');
        
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product['title']);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product['invoice_id']);
        $this->paypal_lib->add_field('amount',  $product['total_value']);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    public function saveCreditCard() {
        if ($this->input->post('billingExpDate') != '' && $this->input->post('cardNumber') != '') {
            $exp_date = explode("/",$this->input->post('billingExpDate'));
    
            $data = array(
                'card_number' => $this->input->post('cardNumber'),
                'exp_day' => $exp_date[1],
                'exp_yr' => $exp_date[0],
                'CVV' => $this->input->post('cvv'),
                'card_type' => $this->input->post('cardType'),
                'user_id' => logged('id'),
                'company_id' => logged('company_id'),
                'payment_method_id' => 0,
                'added' => date('Y-m-d H:i:s')
            );
    
            $this->db->insert($this->jobs_model->table_credit_cards, $data);
        }
    }
}

/* End of file Job.php */

/* Location: ./application/controllers/job.php */