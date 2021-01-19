<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->page_data['page']->title = 'Job Management';
        $this->page_data['page']->menu = 'job';
        $this->load->library('paypal_lib');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('Roles_model', 'roles_model');

        add_css(array( 
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css',
            'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
			"assets/css/accounting/sidebar.css",
        ));

        // JS to add only Job module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js',
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
            'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
            'assets/frontend/js/job_creation/main.js'
        ));
    }

    public function index() {

        $is_allowed = true; //$this->isAllowedModuleAccess(15);
        if( !$is_allowed ){
            $this->page_data['module'] = 'job';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }


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
        $comp_id = logged('company_id');

        $this->page_data['items'] = $this->items_model->get();
        $this->page_data['emp_roles'] = $this->roles_model->getRoles();
        $this->page_data['employees'] = $this->db->get_where($this->jobs_model->table_employees, array('company_id' => $comp_id))->result();
        $this->page_data['customers'] = $this->db->get_where($this->jobs_model->table_customers, array('company_id' => $comp_id))->result();
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
            if (!empty($get['job_num'])) {
                $job_id = $this->db->get_where($this->jobs_model->table, array('job_number' => $get['job_num']))->row()->jobs_id;
                $this->page_data['jobItems'] = $this->jobs_model->getJobInvoiceItems($job_id);
                //$this->page_data['estimates'] = $this->jobs_model->getEstimateByJobId($job_id);
                //$this->page_data['invoices'] = $this->invoice_model->getByWhere(['job_id' => $job_id]);
                $this->page_data['assignEmployees'] = $this->jobs_model->getAssignEmp($job_id);
            }
            
           $this->page_data['job_other_info'] = (!empty($get['job_num'])) ? $this->jobs_model->getJobDetails($get['job_num']) : null;
           $this->page_data['job_number'] = (!empty($get['job_num'])) ? $get['job_num'] : 1000;
           $this->page_data['job_data'] = $job_num_query;
        }
        
        $this->load->view('job/job', $this->page_data);
    }

    public function settings() {
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

        $this->load->view('job/job_settings/prefix', $this->page_data);
    }

    public function job_types() {
        $this->page_data['jobtypes'] = $this->jobs_model->getJobType();
        $this->load->view('job/job_settings/job_type', $this->page_data);
    }

    public function saveJobType() {
        postAllowed();
        $comp_id = logged('company_id');

        $data = array(
            'company_id' => $comp_id,
            'setting_type' => "job_type",
            'value' => $this->input->post('settingType'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        if ($this->input->post('type') == "update") {
            $this->jobs_model->updateJobType($this->input->post('id'), $data);
        } else {
            $is_exist = count($this->jobs_model->getJobSettingByName($this->input->post('settingType')));
            
            if(!$is_exist) {
                $this->db->insert($this->jobs_model->table_job_settings, $data);
                $job_type_id = $this->db->insert_id();
            }
        }

        
        $arr = $this->jobs_model->getJobType();

        echo json_encode($arr);
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
            'description' => $this->input->post('job_description'),
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

        public function deleteJobType() {
        $get = $this->input->get();
        
        $this->jobs_model->deleteJobType($get['id']);

        redirect('job/job_types');
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
            'description' => $this->input->post('job_description'),
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
        $invoice_number = $this->invoice_model->getInvoiceNumber($this->input->post('jobId'), $this->input->post('jobNumber'));

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
            'invoice_number' => $invoice_number
        );
        $this->db->insert($this->invoice_model->table, $data);
        echo json_encode($data);
    }

    public function saveInvoiceItems() {
        postAllowed();
        $comp_id = logged('company_id');

        $data = array(
            'company_id' => $comp_id,
            'job_id' => $this->input->post('job_id'),
            'item_id' => $this->input->post('item_id'),
            'qty' => 1,
            'locations' => '',
            'total_value' => $this->input->post('total_value'),
            'discount' => 0,
            'discount_type' => ""
        );
        $this->db->insert($this->invoice_model->table_item, $data);
        $result = $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'));

        echo json_encode($result);
    }

    public function updateJobItemQty() {
        postAllowed();

        $id = $this->input->post('id');
        $type = $this->input->post('type');
        $qty = $this->input->post('qty');

        $this->jobs_model->updateJobItemQty($id, $qty, $type);
        $result = $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'));

        echo json_encode($result);
    }

    public function buy($id) {
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

    public function sendEstimateEmail() {
        postAllowed();
        $from_email = $this->input->post('from_email');
        $company = $this->input->post('company');
        $to_email = $this->input->post('email');

        //Load email library
        $this->load->library('email');
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'nsmartrac@gmail.com',
            'smtp_pass' => 'nSmarTrac2020',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($from_email, $company);
        $this->email->to($to_email);
        $this->email->subject('Review Estimate');
        $data = array(
            'customer' => getLoggedFullName($this->input->post('customer_id')),
            "items" => $this->jobs_model->getJobInvoiceItems($this->input->post('job_id'))
        );
        $message = $this->load->view('email_campaigns/estimate.php',$data,TRUE);
        $this->email->message($message);
        //Send mail

        if($this->email->send())
            echo json_encode("Congratulation Email Send Successfully.");
        else
            echo json_encode($this->email->send());
    }

    public function saveEstimate() {
        postAllowed();
        $estimate_number = $this->jobs_model->getEstimateNumber($this->input->post('job_id'), $this->input->post('jobNumber'));


        $data = array(
            'estimate_date' => date("Y-m-d", strtotime($this->input->post('estimate_date'))),
            'expiry_date' => date("Y-m-d", strtotime($this->input->post('expiry_date'))),
            'description' => $this->input->post('description'),
            'employee_id' => $this->input->post('employee_id'),
            'status' => $this->input->post('status'),
            'job_id' => $this->input->post('job_id'),
            'estimate_value' => $this->input->post('estimate_value'),
            'deposit_request' => $this->input->post('deposit_request'),
            'estimate_number' => $estimate_number
        );

        $this->db->insert($this->jobs_model->table_estimates, $data);

        echo json_encode($data);
    }

    public function deleteJobForm() {
        $get = $this->input->get();

        switch ($get['type']) {
            case "estimate":
                $this->jobs_model->deleteEstimate($get['id']);
            break;

            case "work_order":
                $this->jobs_model->deleteWorkOrder($get['id']);
            break;

            case "invoice":
                $this->invoice_model->deleteInvoice($get['id']);
            break;
        }

        redirect('job/new_job?job_num=' . $get['job_num']);
    }
    
    function deleteMultiple() {
        postAllowed();
        $ids = explode(",",$this->input->post('ids'));
        
        foreach($ids as $id) {
            $this->jobs_model->deleteJob($id);
        }

        echo json_encode(true);
    }

    function getEmpByRole() {
        postAllowed();
        $id = $this->input->post('id');
        $result = $this->db->get_where($this->jobs_model->table_employees, array('role_id' => $id))->result_array();

        echo json_encode($result);
    }

    function getCustomerLocations() {
        postAllowed();
        $id = $this->input->post('id');
        $result = $this->db->get_where($this->jobs_model->table_address, array('user_id' => $id))->result_array();

        echo json_encode($result);
    }

    function saveAssignEmp() {
        postAllowed();
        $id = $this->input->post('role_id');
        $role = $this->page_data['emp_roles'] = $this->roles_model->getRolesById($this->input->post('role_id'));

        $data = array(
            'jobs_id' => $this->input->post('job_id'),
            'employees_id' => $this->input->post('emp_id'),
            'emp_role' => $role->title
        );

        $this->db->insert($this->jobs_model->table_jobs_has_employees, $data);
        $data = $this->jobs_model->getAssignEmp($this->input->post('job_id'));

        echo json_encode($data);
    }

    function saveNewCustomerLocation() {
        postAllowed();

        $data = array(
            'user_id' => $this->input->post('user_id'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'postal_code' => $this->input->post('postal_code')
        );

        $this->db->insert($this->jobs_model->table_address, $data);
        $data = $this->db->get_where($this->jobs_model->table_address, array('user_id' => $this->input->post('user_id')))->result_array();

        echo json_encode($data);
    }

    function details($id){
        $this->load->model('Estimate_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Customer_model');

        $estimate = $this->Estimate_model->getEstimate($id);

        if( $estimate ){
            $customer      = $this->Customer_model->getCustomer($estimate->customer_id);
            $estimateItems = $this->EstimateItem_model->getAllByEstimateId($estimate->id);

            $this->page_data['estimate'] = $estimate;
            $this->page_data['customer'] = $customer;
            $this->page_data['estimateItems'] = $estimateItems;
            $this->load->view('job/details', $this->page_data);

        }else{
           redirect('dashboard'); 
        }
    }
}

/* End of file Job.php */

/* Location: ./application/controllers/job.php */