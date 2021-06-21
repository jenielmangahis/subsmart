<?php

defined('BASEPATH') or exit('No direct script access allowed');

// add services
include_once 'application/services/JobType.php';
include_once 'application/services/Priority.php';

class Workorder extends MY_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->checkLogin();

        $this->page_data['page']->title = 'Workorder Management';

        $this->page_data['page']->menu = (!empty($this->uri->segment(2))) ? $this->uri->segment(2) : 'workorder';
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('Users_model', 'users_model');
        
        $user_id = getLoggedUserID();

        // add css and js file path so that they can be attached on this page dynamically
        // add_css and add_footer_js are the helper function defined in the helpers/basic_helper.php
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/frontend/css/workorder/main.css',
            "assets/css/accounting/sidebar.css",
            'assets/css/accounting/sales.css'
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            'assets/frontend/js/workorder/main.js'
        ));
    }


    public function index($tab_index = 0)
    {
        $is_allowed = $this->isAllowedModuleAccess(24);
        if( !$is_allowed ){
            $this->page_data['module'] = 'workorder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $role = logged('role');
        $this->page_data['workorderStatusFilters'] = array ();
        $this->page_data['workorders'] = array ();
        $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => logged('company_id')]);
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('status' => $tab_index), $company_id);
            } else {

                // search
                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('order'))) {

                    $this->page_data['search'] = get('search');
                    // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

                } else {

                    // $this->page_data['workorders'] = $this->workorder_model->getAllOrderByCompany($company_id);
                }
            }

            // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount($company_id);
        }
        if ($role == 4) {

            if (!empty($tab_index)) {

                $this->page_data['tab_index'] = $tab_index;
                // $this->page_data['workorders'] = $this->workorder_model->filterBy();

            } elseif (!empty(get('order'))) {

                $this->page_data['order'] = get('order');
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } else {
                    // $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();
                }
            }

            // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount();
        }

        $this->page_data['workorders'] = $this->workorder_model->getworkorderList();

        $company_id = logged('company_id');
        $this->page_data['company_work_order_used'] = $this->workorder_model->getcompany_work_order_used($company_id);

        // unserialized the value

        $statusFilter = array();
        foreach ($this->page_data['workorders'] as $workorder) {

            if (is_serialized($workorder)) {

                $workorder = unserialize($workorder);
            }
        }

//        print_r($this->page_data['workorders']); die;

        $this->load->view('workorder/list', $this->page_data);
    }

    public function add()
    {

        $is_allowed = $this->isAllowedModuleAccess(32);
        if( !$is_allowed ){
            $this->page_data['module'] = 'basic_work_order';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $get = $this->input->get();

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        // conversation request from estimate to workorder
        if (!empty($get['estimate_id'])) {

            $this->load->model('Estimate_model', 'estimate_model');
            $this->load->model('Customer_model', 'customer_model');

            $this->page_data['estimate'] = $this->estimate_model->getEstimate($get['estimate_id']);
            $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        }

        // customer to workorder
        // ~~ pending: need to add functionality on view ~~
        if (!empty($get['customer_id'])) {

            $this->load->model('Customer_model', 'customer_model');
            $this->page_data['customer']->customer = get_customer_by_id($get['customer_id']);
        }

        $company_id = logged('company_id');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        // $this->page_data['file_vault_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        // $this->load->view('workorder/add', $this->page_data);
        $this->load->view('workorder/add', $this->page_data);
    }

    public function alarm_demo()
    {

        $get = $this->input->get();

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        // conversation request from estimate to workorder
        if (!empty($get['estimate_id'])) {

            $this->load->model('Estimate_model', 'estimate_model');
            $this->load->model('Customer_model', 'customer_model');

            $this->page_data['estimate'] = $this->estimate_model->getEstimate($get['estimate_id']);
            $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        }

        // customer to workorder
        // ~~ pending: need to add functionality on view ~~
        if (!empty($get['customer_id'])) {

            $this->load->model('Customer_model', 'customer_model');
            $this->page_data['customer']->customer = get_customer_by_id($get['customer_id']);
        }

        $company_id = logged('company_id');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['file_vault_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        // $this->load->view('workorder/add', $this->page_data);
        $this->load->view('workorder/alarm-direct', $this->page_data);
    }

    public function alarm_demo_2()
    {

        $get = $this->input->get();

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        // conversation request from estimate to workorder
        if (!empty($get['estimate_id'])) {

            $this->load->model('Estimate_model', 'estimate_model');
            $this->load->model('Customer_model', 'customer_model');

            $this->page_data['estimate'] = $this->estimate_model->getEstimate($get['estimate_id']);
            $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        }

        // customer to workorder
        // ~~ pending: need to add functionality on view ~~
        if (!empty($get['customer_id'])) {

            $this->load->model('Customer_model', 'customer_model');
            $this->page_data['customer']->customer = get_customer_by_id($get['customer_id']);
        }

        $company_id = logged('company_id');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        $this->page_data['file_vault_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        // $this->load->view('workorder/add', $this->page_data);
        $this->load->view('workorder/alarm-direct-2', $this->page_data);
    }

    public function add2()
    {

        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) { // ****** if user is company ******//

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }

        $this->load->view('workorder/add2', $this->page_data);
    }

    public function addnew()
    {

        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) { // ****** if user is company ******//

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {

            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }

        $this->load->view('workorder/addnew', $this->page_data);
    }


    public function save()
    {

        postAllowed();

        $post = $this->input->post();

//        echo '<pre>'; print_r($post); die;

        $user = (object)$this->session->userdata('logged');

        //
        if (is_array(post('item'))) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            $itemArray = array();

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $additional_services = serialize($itemArray);
        } else {

            $additional_services = '';
        }

//        print_r(post('customer')); die;

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        $company_id = logged('company_id');

        // create the workorder customer
        $this->load->model('Customer_model', 'customer_model');
        $customer_id = $this->customer_model->create([

            'customer_type' => post('customer')['customer_type'],
            'contact_name' => post('customer')['first_name'] . ' ' . post('customer')['last_name'],
            'contact_email' => post('customer')['email'],
            'mobile' => post('customer')['contact_mobile'],
            'phone' => serialize(post('customer')['contact_phone']),
            'notification_method' => serialize(post('customer')['notification_type']),
            'street_address' => post('customer')['monitored_location'],
            'suite_unit' => post('customer')['cross_street'],
            'city' => post('customer')['city'],
            'postal_code' => post('customer')['zip'],
            'state' => post('customer')['state'],
            'birthday' => date('Y-m-d', strtotime(post('customer')['contact_dob'])),
            'company_id' => $company_id
        ]);

//        print_r(serialize(post('post_service_summary'))); die;


        if ($customer_id) {

            $id = $this->workorder_model->create([

                'user_id' => $user->id,
                'company_id' => $company_id,
                'customer_id' => $customer_id,
                'customer' => serialize(post('customer')),
                'emergency_call_list' => serialize(post('emergency_call_list')),
                'plan_type' => post('plan_type'),
                'account_type' => serialize(post('account_type')),
                'panel_type' => serialize(post('panel_type')),
                'panel_communication' => post('panel_communication'),
                'panel_location' => post('panel_location'),
                'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
                'job_type_id' => post('job_type_id'),
                'status_id' => post('status_id'),
                'priority_id' => post('job_priority'),
                'ip_cameras' => serialize(post('ip_cameras')),
                'dvr_nvr' => serialize(post('dvr_nvr')),
                'doorlocks' => serialize(post('doorlocks')),
                'automation' => serialize(post('automation')),
                'pers' => serialize(post('pers')),
                'additional_services' => $additional_services,
                'total' => serialize($eqpt_cost),
                'billing_date' => date('Y-m-d', strtotime(post('billing_date'))),
                'payment_type' => post('payment_type'),
                'billing_freq' => post('billing_freq'),
                'card_info' => serialize(post('card')),
                'company_rep_approval' => post('company_representative_approval_signature'),
                'primary_account_holder' => post('primary_account_holder_signature'),
                'secondary_account_holder' => post('secondery_account_holder_signature'),
                'company_rep_name' => post('company_representative_printed_name'),
                'primary_account_holder_name' => post('primary_account_holder_name'),
                'secondary_account_holder_name' => post('secondery_account_holder_name'),
                'post_service_summary' => serialize(post('post_service_summary')),
            ]);

            $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'New Workorder Created Successfully');

            redirect('workorder');
        }
    }


    public function update($id)
    {

        postAllowed();

        $post = $this->input->post();

//        echo '<pre>'; print_r($post); die;

        $user = (object)$this->session->userdata('logged');

        //
        if (is_array(post('item'))) {

            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            $itemArray = array();

            foreach (post('item') as $key => $val) {

                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $additional_services = serialize($itemArray);
        } else {

            $additional_services = '';
        }

//        print_r(post('customer')); die;

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        $company_id = logged('company_id');

        // create the workorder customer
        $workorder = $this->workorder_model->getById($id);
        $this->load->model('Customer_model', 'customer_model');
        $customer_id = $this->customer_model->update($workorder->customer_id, [

            'customer_type' => post('customer')['customer_type'],
            'contact_name' => post('customer')['first_name'] . ' ' . post('customer')['last_name'],
            'contact_email' => post('customer')['email'],
            'mobile' => post('customer')['contact_mobile'],
            'phone' => serialize(post('customer')['contact_phone']),
            'notification_method' => serialize(post('customer')['notification_type']),
            'street_address' => post('customer')['monitored_location'],
            'suite_unit' => post('customer')['cross_street'],
            'city' => post('customer')['city'],
            'postal_code' => post('customer')['zip'],
            'state' => post('customer')['state'],
            'birthday' => date('Y-m-d', strtotime(post('customer')['contact_dob'])),
            'company_id' => $company_id
        ]);


        $data = [
            'user_id' => $user->id,
            'company_id' => $company_id,
            'customer_id' => $customer_id,
            'customer' => serialize(post('customer')),
            'emergency_call_list' => serialize(post('emergency_call_list')),
            'plan_type' => post('plan_type'),
            'account_type' => serialize(post('account_type')),
            'panel_type' => serialize(post('panel_type')),
            'panel_communication' => post('panel_communication'),
            'panel_location' => post('panel_location'),
            'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
            'job_type_id' => post('job_type_id'),
            'status_id' => post('status_id'),
            'priority_id' => post('job_priority'),
            'ip_cameras' => serialize(post('ip_cameras')),
            'dvr_nvr' => serialize(post('dvr_nvr')),
            'doorlocks' => serialize(post('doorlocks')),
            'automation' => serialize(post('automation')),
            'pers' => serialize(post('pers')),
            'additional_services' => $additional_services,
            'total' => serialize($eqpt_cost),
            'billing_date' => date('Y-m-d', strtotime(post('billing_date'))),
            'payment_type' => post('payment_type'),
            'billing_freq' => post('billing_freq'),
            'card_info' => serialize(post('card')),
            'company_rep_approval' => (!empty(post('company_representative_approval_signature'))) ? post('company_representative_approval_signature') : $workorder->company_rep_approval,
            'primary_account_holder' => (!empty(post('primary_account_holder_signature'))) ? post('primary_account_holder_signature') : $workorder->primary_account_holder,
            'secondary_account_holder' => (!empty(post('secondery_account_holder_signature'))) ? post('secondery_account_holder_signature') : $workorder->secondary_account_holder,
            'company_rep_name' => post('company_representative_printed_name'),
            'primary_account_holder_name' => post('primary_account_holder_name'),
            'secondary_account_holder_name' => post('secondery_account_holder_name'),
            'post_service_summary' => serialize(post('post_service_summary')),
        ];

        $id = $this->workorder_model->update($id, $data);

        $this->activity_model->add("User #$user->id Updated by User:" . logged('name'));
        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Workorder has been Updated Successfully');

        redirect('workorder');
    }


    public function view($id)
    {

        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        
        $this->page_data['company'] = $this->workorder_model->getCompanyCompanyId($id);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['items'] = $this->workorder_model->getItems($id);

        $this->page_data['itemsA'] = $this->workorder_model->getItemsAlarm($id);
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        $this->page_data['workorder_items'] = $this->workorder_model->getworkorderItems($id);

        // $this->page_data['Workorder']->role = $this->roles_model->getByWhere(['id' => $this->page_data['Workorder']->role])[0];

        // $this->page_data['Workorder']->activity = $this->activity_model->getByWhere(['user' => $id], ['order' => ['id', 'desc']]);

        // print_r($this->page_data['items']);
        add_footer_js('assets/js/esign/docusign/workorder.js');
        $this->load->view('workorder/view', $this->page_data);
    }


    public function edit($id)
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $parent_id = $this->db->query("select id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();
        $this->page_data['items'] = $this->items_model->getItemlist();
        // $this->page_data['items_data'] = $this->items_model->getItemData($id);
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        $this->page_data['payment'] = $this->workorder_model->getpayment($id);

        $this->page_data['items_data'] = $this->workorder_model->getworkorderItems($id);

        foreach ($this->page_data['workorder'] as $key => $workorder) {

            if (is_serialized($workorder)) {

                $this->page_data['workorder']->$key = unserialize($workorder);
            }
        }

//         echo '<pre>'; print_r($this->page_data['workorder']); die;

        // print_r($this->page_data['customer']);
        $this->load->view('workorder/edit', $this->page_data);
    }

    public function editAlarm($id)
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $parent_id = $this->db->query("select id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $this->page_data['workorder'] = $this->workorder_model->getworkorder($id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();
        $this->page_data['items'] = $this->items_model->getItemlist();
        // $this->page_data['items_data'] = $this->items_model->getItemData($id);
        $this->page_data['items_data'] = $this->items_model->getItemDataAlarm($id); //Work Order Alarm
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        $this->page_data['alarms'] = $this->workorder_model->getAlarms($id);
        $this->page_data['ids'] = $this->workorder_model->getlastInsertID();
        $this->page_data['payment'] = $this->workorder_model->getpayment($id);

        $this->page_data['cameras'] = $this->workorder_model->getenhanced_services_cameras($id);
        $this->page_data['doorlocks'] = $this->workorder_model->getenhanced_services_doorlocks($id);
        $this->page_data['dvr'] = $this->workorder_model->getenhanced_services_dvr($id);
        $this->page_data['automation'] = $this->workorder_model->getenhanced_services_automation($id);
        $this->page_data['pers'] = $this->workorder_model->getenhanced_services_pers($id);

        $work = $this->workorder_model->getworkorder($id);

        $this->page_data['contacts'] = $this->workorder_model->get_contacts($work->customer_id);

        // foreach ($this->page_data['workorder'] as $key => $workorder) {

        //     if (is_serialized($workorder)) {

        //         $this->page_data['workorder']->$key = unserialize($workorder);
        //     }
        // }

        // echo '<pre>'; print_r($this->page_data['workorder']); die;

        // print_r($this->page_data['customer']);
        $this->load->view('workorder/editAlarm', $this->page_data);
    }

    public function sendWorkorderToAcs()
    {
        $id = $this->input->post('id');
        $wo_id = $this->input->post('wo_id');

        // $info = $this->customer_ad_model->get_data_by_id('prof_id',$id,"acs_profile");
        // $to = $info->email;
        // $this->load->library('email');
        // $config = array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'ssl://smtp.gmail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac2020',
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8'
        // );
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");
        // $this->email->from('no-reply@nsmartrac.com', 'nSmarTrac');
        // $this->email->to($to);
        // $this->email->subject('QR Details');
        // $this->email->message('This is customer QR.');
        // $this->email->attach($_SERVER['DOCUMENT_ROOT'] . '/assets/img/customer/qr/'.$id.'.png');
        
        // $to = 'emploucelle@gmail.com';

        // $data = array(
        //     'name' => '$name',
        //     'link' => '$code'
        // );
        // //Load email library
        // $this->load->library('email');
        // $config = array(
        //     'smtp_crypto' => 'ssl',
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'mail.nsmartrac.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac2020',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        // );
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");

        $workData = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workData->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorder = $workData->work_order_number;
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);
        $custom = $this->workorder_model->get_custom_data($wo_id);
        $items = $this->workorder_model->getworkorderItems($wo_id);

        $data = array(
            'workorder'             => $workorder,
            'tags'                  => $workData->tags,
            'job_type'              => $workData->job_type,
            'priority'              => $workData->priority,
            'password'              => $workData->password,
            'security_number'       => $workData->security_number,
            'source_name'           => $workData->lead_source_id,
            'company_representative_signature' => $workData->company_representative_signature,
            'company'               => $cliets->business_name,
            'business_address'      => $cliets->business_address,
            'phone_number'          => $cliets->phone_number,
            'acs_name'              => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'job_location'          => $workData->job_location,
            'job_location2'         => $workData->city.', '.$workData->state.', '.$workData->zip_code.', '.$workData->cross_street,
            'email'                 => $workData->email,
            'phone'                 => $workData->phone_number,
            'mobile'                => $workData->mobile_number,
            'terms_and_conditions'  => $workData->terms_and_conditions,
            'terms_of_use'          => $workData->terms_of_use,
            'job_description'       => $workData->job_description,
            'instructions'          => $workData->instructions,
            'date_issued'           => $workData->date_issued,
            'custom'                => $custom,
            'items'                 => $items,

            'total'                             => $workData->grand_total,
            'subtotal'                          => $workData->subtotal,
            'taxes'                             => $workData->taxes,
            'adjustment_name'                   => $workData->adjustment_name,
            'adjustment_value'                  => $workData->adjustment_value,
            'voucher_value'                     => $workData->voucher_value,
            'otp_setup'                         => $workData->otp_setup,
            'monthly_monitoring'                => $workData->monthly_monitoring,
            // 'source' => $source
        );

        // $recipient  = "emploucelle@gmail.com";
        $recipient  = $workData->email;
        // $message = "This is a test email";

        $message = "<p>This workorder agreement (the 'agreement') is made as of 05-07-2021, by and between ADI Smart Home, (the 'Company') and the ('Customer') as the address shown below (the 'Premise/Service') ";
        $message .= "<table>";
        $message .= "<tr><td></td><td><h2>WORK ORDER</h2> <br> ".$workData->work_order_number." </td></tr>";
        $message .= "</table>";
        $message .= "<hr>";
        $message .= "<table>";
        $message .= "<tr><td></td><td>Job Tags: </td><td>".$workData->tags."</td></tr>";
        $message .= "<tr><td></td><td>Date: </td><td>".date("Y-m-d")."</td></tr>";
        $message .= "<tr><td></td><td>Type: </td><td>".$workData->job_type."</td></tr>";
        $message .= "<tr><td></td><td>Priority: </td><td>".$workData->priority."</td></tr>";
        $message .= "<tr><td></td><td>Password: </td><td>".$workData->password."</td></tr>";
        $message .= "<tr><td></td><td>Security Number: </td><td>".$workData->security_number."</td></tr>";
        $message .= "<tr><td></td><td>Custom Field: </td><td></td></tr>";
        // $message .= "<tr><td></td><td>Source: </td><td>".$source->ls_name."</td></tr>";
        $message .= "</table>";
        $message .= "<br><h5>FROM:</h5>";
        $message .= "<hr>";
        $message .= "<table>";
            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>COMPANY INFORMATION</h5></td></tr>";
            $message .= "<tr><td>DBA NAME</td><td>".$post['dba_name']."</td></tr>";
            $message .= "<tr><td>LEGAL BUSINESS NAME</td><td>".$post['legal_business_name']."</td></tr>";
            $message .= "<tr><td>CONTANCT NAME</td><td>".$post['contact_name']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS TYPE</td><td>".$post['dba_address_type']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 1 (NO PO BOX)</td><td>".$post['dba_address_1']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 2</td><td>".$post['dba_address_2']."</td></tr>";
            $message .= "<tr><td>CITY</td><td>".$post['city']."</td></tr>";
            $message .= "<tr><td>STATE</td><td>".$post['state']."</td></tr>";
            $message .= "<tr><td>ZIP CODE</td><td>".$post['zip_code']."</td></tr>";
            $message .= "<tr><td>DBA PHONE NO.</td><td>".$post['dba_phone_no']."</td></tr>";
            $message .= "<tr><td>EMAIL ADDRESS</td><td>".$post['email_address']."</td></tr>";
            $message .= "<tr><td>MOBILE PHONE NO.</td><td>".$post['mobile_phone_no']."</td></tr>";
            $message .= "<tr><td>YEAR ESTABLISHED</td><td>".$post['years_established']."</td></tr>";
            $message .= "<tr><td>LENGTH OF CURRENT OWNERSHIP</td><td>".$post['length_ownership']."</td></tr>";
            $message .= "<tr><td>YEARS</td><td>".$post['ownership_years']."</td></tr>";
            $message .= "<tr><td>MONTHS</td><td>".$post['ownership_months']."</td></tr>";


        $message .= "</table>";
        $message .= "<br /><p>Confidentiality Statement</p>
    <p>This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake, and delete this e-mail from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing, or taking any action in reliance on the contents of this information is strictly prohibited.</p>";


    $message2 = $this->load->view('workorder/send_email_acs', $data, true);
    $filename = $workData->company_representative_signature;

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $subject   = 'nSmarTrac: Work Order Details';
            $mail = new PHPMailer;
            //$mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout    =   10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';

            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            // $email->attach("/home/yoursite/location-of-file.jpg", "inline");
            $mail->Subject = $subject;
            $mail->Body    = $message2;
            // $cid = $email->attachment_cid($filename);


            $json_data['is_success'] = 1;
            $json_data['error']      = '';

            if(!$mail->Send()) {
                /*echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;*/
                $json_data['is_success'] = 0;
                $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
            }

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

            echo json_encode($json_data);
        // return true;
        // echo "test";
    }

    public function sendWorkorderToCompany()
    {
        $id = $this->input->post('id');
        $wo_id = $this->input->post('wo_id');

        // $info = $this->customer_ad_model->get_data_by_id('prof_id',$id,"acs_profile");
        // $to = $info->email;
        // $this->load->library('email');
        // $config = array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'ssl://smtp.gmail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac2020',
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8'
        // );
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");
        // $this->email->from('no-reply@nsmartrac.com', 'nSmarTrac');
        // $this->email->to($to);
        // $this->email->subject('QR Details');
        // $this->email->message('This is customer QR.');
        // $this->email->attach($_SERVER['DOCUMENT_ROOT'] . '/assets/img/customer/qr/'.$id.'.png');
        
        // $to = 'emploucelle@gmail.com';

        // $data = array(
        //     'name' => '$name',
        //     'link' => '$code'
        // );
        // //Load email library
        // $this->load->library('email');
        // $config = array(
        //     'smtp_crypto' => 'ssl',
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'mail.nsmartrac.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac2020',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        // );
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");

        $workData = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workData->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorder = $workData->work_order_number;
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $data = array(
            'workorder'             => $workorder,
            'tags'                  => $workData->tags,
            'job_type'              => $workData->job_type,
            'priority'              => $workData->priority,
            'password'              => $workData->password,
            'security_number'       => $workData->security_number,
            'source_name'           => $workData->lead_source_id,
            'company_representative_signature' => $workData->company_representative_signature,
            'company'               => $cliets->business_name,
            'business_address'      => $cliets->business_address,
            'phone_number'          => $cliets->phone_number,
            'acs_name'              => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'job_location'          => $workData->job_location,
            'job_location2'         => $workData->city.', '.$workData->state.', '.$workData->zip_code.', '.$workData->cross_street,
            'email'                 => $workData->email,
            'phone'                 => $workData->phone_number,
            'mobile'                => $workData->mobile_number,
            'terms_and_conditions'  => $workData->terms_and_conditions,
            'terms_of_use'          => $workData->terms_of_use,
            'job_description'       => $workData->job_description,
            'instructions'          => $workData->instructions,
            'date_issued'           => $workData->date_issued,
            // 'source' => $source
        );

        // $recipient  = "emploucelle@gmail.com";
        $recipient  = $cliets->email_address;
        // $message = "This is a test email";

        $message = "<p>This workorder agreement (the 'agreement') is made as of 05-07-2021, by and between ADI Smart Home, (the 'Company') and the ('Customer') as the address shown below (the 'Premise/Service') ";
        $message .= "<table>";
        $message .= "<tr><td></td><td><h2>WORK ORDER</h2> <br> ".$workData->work_order_number." </td></tr>";
        $message .= "</table>";
        $message .= "<hr>";
        $message .= "<table>";
        $message .= "<tr><td></td><td>Job Tags: </td><td>".$workData->tags."</td></tr>";
        $message .= "<tr><td></td><td>Date: </td><td>".date("Y-m-d")."</td></tr>";
        $message .= "<tr><td></td><td>Type: </td><td>".$workData->job_type."</td></tr>";
        $message .= "<tr><td></td><td>Priority: </td><td>".$workData->priority."</td></tr>";
        $message .= "<tr><td></td><td>Password: </td><td>".$workData->password."</td></tr>";
        $message .= "<tr><td></td><td>Security Number: </td><td>".$workData->security_number."</td></tr>";
        $message .= "<tr><td></td><td>Custom Field: </td><td></td></tr>";
        // $message .= "<tr><td></td><td>Source: </td><td>".$source->ls_name."</td></tr>";
        $message .= "</table>";
        $message .= "<br><h5>FROM:</h5>";
        $message .= "<hr>";
        $message .= "<table>";
            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>COMPANY INFORMATION</h5></td></tr>";
            $message .= "<tr><td>DBA NAME</td><td>".$post['dba_name']."</td></tr>";
            $message .= "<tr><td>LEGAL BUSINESS NAME</td><td>".$post['legal_business_name']."</td></tr>";
            $message .= "<tr><td>CONTANCT NAME</td><td>".$post['contact_name']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS TYPE</td><td>".$post['dba_address_type']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 1 (NO PO BOX)</td><td>".$post['dba_address_1']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 2</td><td>".$post['dba_address_2']."</td></tr>";
            $message .= "<tr><td>CITY</td><td>".$post['city']."</td></tr>";
            $message .= "<tr><td>STATE</td><td>".$post['state']."</td></tr>";
            $message .= "<tr><td>ZIP CODE</td><td>".$post['zip_code']."</td></tr>";
            $message .= "<tr><td>DBA PHONE NO.</td><td>".$post['dba_phone_no']."</td></tr>";
            $message .= "<tr><td>EMAIL ADDRESS</td><td>".$post['email_address']."</td></tr>";
            $message .= "<tr><td>MOBILE PHONE NO.</td><td>".$post['mobile_phone_no']."</td></tr>";
            $message .= "<tr><td>YEAR ESTABLISHED</td><td>".$post['years_established']."</td></tr>";
            $message .= "<tr><td>LENGTH OF CURRENT OWNERSHIP</td><td>".$post['length_ownership']."</td></tr>";
            $message .= "<tr><td>YEARS</td><td>".$post['ownership_years']."</td></tr>";
            $message .= "<tr><td>MONTHS</td><td>".$post['ownership_months']."</td></tr>";


        $message .= "</table>";
        $message .= "<br /><p>Confidentiality Statement</p>
    <p>This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake, and delete this e-mail from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing, or taking any action in reliance on the contents of this information is strictly prohibited.</p>";


    $message2 = $this->load->view('workorder/send_email_acs', $data, true);
    $filename = $workData->company_representative_signature;

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $subject   = 'nSmarTrac: Work Order Details - Company Copy';
            $mail = new PHPMailer;
            //$mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout    =   10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';

            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            // $email->attach("/home/yoursite/location-of-file.jpg", "inline");
            $mail->Subject = $subject;
            $mail->Body    = $message2;
            // $cid = $email->attachment_cid($filename);


            $json_data['is_success'] = 1;
            $json_data['error']      = '';

            if(!$mail->Send()) {
                /*echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;*/
                $json_data['is_success'] = 0;
                $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
            }

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Successfully sent to Company.');

            echo json_encode($json_data);
        // return true;
        // echo "test";
    }

    public function sendWorkorderToAcsAlarm()
    {
        $id = $this->input->post('id');
        $wo_id = $this->input->post('wo_id');

        // $info = $this->customer_ad_model->get_data_by_id('prof_id',$id,"acs_profile");
        // $to = $info->email;
        // $this->load->library('email');
        // $config = array(
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'ssl://smtp.gmail.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac2020',
        //     'mailtype' => 'html',
        //     'charset' => 'utf-8'
        // );
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");
        // $this->email->from('no-reply@nsmartrac.com', 'nSmarTrac');
        // $this->email->to($to);
        // $this->email->subject('QR Details');
        // $this->email->message('This is customer QR.');
        // $this->email->attach($_SERVER['DOCUMENT_ROOT'] . '/assets/img/customer/qr/'.$id.'.png');
        
        // $to = 'emploucelle@gmail.com';

        // $data = array(
        //     'name' => '$name',
        //     'link' => '$code'
        // );
        // //Load email library
        // $this->load->library('email');
        // $config = array(
        //     'smtp_crypto' => 'ssl',
        //     'protocol' => 'smtp',
        //     'smtp_host' => 'mail.nsmartrac.com',
        //     'smtp_port' => 465,
        //     'smtp_user' => 'nsmartrac@gmail.com',
        //     'smtp_pass' => 'nSmarTrac2020',
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        // );
        // $this->email->initialize($config);
        // $this->email->set_newline("\r\n");

        $workData = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workData->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorder = $workData->work_order_number;
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $data = array(
            'workorder'                         => $workorder,
            'tags'                              => $workData->tags,
            'job_type'                          => $workData->job_type,
            'priority'                          => $workData->priority,
            'password'                          => $workData->password,
            'security_number'                   => $workData->security_number,
            'source_name'                       => $workData->lead_source_id,
            'company_representative_signature'  => $workData->company_representative_signature,
            'company'                           => $cliets->business_name,
            'business_address'                  => $cliets->business_address,
            'phone_number'                      => $cliets->phone_number,
            'acs_name'                          => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'job_location'                      => $workData->job_location,
            'job_location2'                     => $workData->city.', '.$workData->state.', '.$workData->zip_code.', '.$workData->cross_street,
            'email'                             => $workData->email,
            'phone'                             => $workData->phone_number,
            'mobile'                            => $workData->mobile_number,
            'terms_and_conditions'              => $workData->terms_and_conditions,
            'terms_of_use'                      => $workData->terms_of_use,
            'job_description'                   => $workData->job_description,
            'instructions'                      => $workData->instructions,
            'first_verification_name'           => $customerData->first_verification_name,
            'first_number'                      => $customerData->first_number,
            'first_relation'                    => $customerData->first_relation,
            'second_verification_name'          => $customerData->second_verification_name,
            'second_number'                     => $customerData->second_number,
            'second_relation'                   => $customerData->second_relation,
            'third_verification_name'           => $customerData->third_verification_name,
            'third_number'                      => $customerData->third_number,
            'third_relation'                    => $customerData->third_relation,
            'date_issued'                       => $workData->date_issued,
            // 'source' => $source
        );

        // $recipient  = "emploucelle@gmail.com";
        $recipient  = $workData->email;
        // $message = "This is a test email";

        $message = "<p>This workorder agreement (the 'agreement') is made as of 05-07-2021, by and between ADI Smart Home, (the 'Company') and the ('Customer') as the address shown below (the 'Premise/Service') ";
        $message .= "<table>";
        $message .= "<tr><td></td><td><h2>WORK ORDER</h2> <br> ".$workData->work_order_number." </td></tr>";
        $message .= "</table>";
        $message .= "<hr>";
        $message .= "<table>";
        $message .= "<tr><td></td><td>Job Tags: </td><td>".$workData->tags."</td></tr>";
        $message .= "<tr><td></td><td>Date: </td><td>".date("Y-m-d")."</td></tr>";
        $message .= "<tr><td></td><td>Type: </td><td>".$workData->job_type."</td></tr>";
        $message .= "<tr><td></td><td>Priority: </td><td>".$workData->priority."</td></tr>";
        $message .= "<tr><td></td><td>Password: </td><td>".$workData->password."</td></tr>";
        $message .= "<tr><td></td><td>Security Number: </td><td>".$workData->security_number."</td></tr>";
        $message .= "<tr><td></td><td>Custom Field: </td><td></td></tr>";
        // $message .= "<tr><td></td><td>Source: </td><td>".$source->ls_name."</td></tr>";
        $message .= "</table>";
        $message .= "<br><h5>FROM:</h5>";
        $message .= "<hr>";
        $message .= "<table>";
            $message .= "<tr><td colspan='2' style='background-color:#32243d;color:#ffffff;'><h5 style='margin:0px;padding:10px;font-size:15px;'>COMPANY INFORMATION</h5></td></tr>";
            $message .= "<tr><td>DBA NAME</td><td>".$post['dba_name']."</td></tr>";
            $message .= "<tr><td>LEGAL BUSINESS NAME</td><td>".$post['legal_business_name']."</td></tr>";
            $message .= "<tr><td>CONTANCT NAME</td><td>".$post['contact_name']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS TYPE</td><td>".$post['dba_address_type']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 1 (NO PO BOX)</td><td>".$post['dba_address_1']."</td></tr>";
            $message .= "<tr><td>DBA ADDRESS 2</td><td>".$post['dba_address_2']."</td></tr>";
            $message .= "<tr><td>CITY</td><td>".$post['city']."</td></tr>";
            $message .= "<tr><td>STATE</td><td>".$post['state']."</td></tr>";
            $message .= "<tr><td>ZIP CODE</td><td>".$post['zip_code']."</td></tr>";
            $message .= "<tr><td>DBA PHONE NO.</td><td>".$post['dba_phone_no']."</td></tr>";
            $message .= "<tr><td>EMAIL ADDRESS</td><td>".$post['email_address']."</td></tr>";
            $message .= "<tr><td>MOBILE PHONE NO.</td><td>".$post['mobile_phone_no']."</td></tr>";
            $message .= "<tr><td>YEAR ESTABLISHED</td><td>".$post['years_established']."</td></tr>";
            $message .= "<tr><td>LENGTH OF CURRENT OWNERSHIP</td><td>".$post['length_ownership']."</td></tr>";
            $message .= "<tr><td>YEARS</td><td>".$post['ownership_years']."</td></tr>";
            $message .= "<tr><td>MONTHS</td><td>".$post['ownership_months']."</td></tr>";


        $message .= "</table>";
        $message .= "<br /><p>Confidentiality Statement</p>
    <p>This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee, you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake, and delete this e-mail from your system. If you are not the intended recipient, you are notified that disclosing, copying, distributing, or taking any action in reliance on the contents of this information is strictly prohibited.</p>";


    $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    $filename = $workData->company_representative_signature;

        include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $subject   = 'nSmarTrac: Work Order Details - Admin';
            $mail = new PHPMailer;
            //$mail->SMTPDebug = 4;
            $mail->isSMTP();
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout    =   10; // set the timeout (seconds)
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'NsmarTrac';

            $mail->addAddress($recipient, $recipient);
            $mail->isHTML(true);
            // $email->attach("/home/yoursite/location-of-file.jpg", "inline");
            $mail->Subject = $subject;
            $mail->Body    = $message2;
            // $cid = $email->attachment_cid($filename);


            $json_data['is_success'] = 1;
            $json_data['error']      = '';

            if(!$mail->Send()) {
                /*echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;*/
                $json_data['is_success'] = 0;
                $json_data['error']      = 'Mailer Error: ' . $mail->ErrorInfo;
            }

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

            echo json_encode($json_data);
        // return true;
        // echo "test";
    }

    public function work_order_pdf($wo_id)
    {
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workData = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workData->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorder = $workData->work_order_number;
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrder($wo_id);
        $items = $this->workorder_model->getworkorderItems($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);

        $data = array(
            'workorder'                         => $workorder,
            'tags'                              => $workData->tags,
            'job_type'                          => $workData->job_type,
            'priority'                          => $workData->priority,
            'password'                          => $workData->password,
            'security_number'                   => $workData->security_number,
            'source_name'                       => $workData->lead_source_id,
            'company_representative_signature'  => $workData->company_representative_signature,
            'company_representative_name'       => $workData->company_representative_name,
            'primary_account_holder_signature'  => $workData->primary_account_holder_signature,
            'primary_account_holder_name'       => $workData->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,

            'company'                           => $cliets->business_name,
            'business_address'                  => $cliets->business_address,
            'phone_number'                      => $cliets->phone_number,
            'acs_name'                          => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'job_location'                      => $workData->job_location,
            'job_location2'                     => $workData->city.', '.$workData->state.', '.$workData->zip_code.', '.$workData->cross_street,
            'email'                             => $workData->email,
            'phone'                             => $workData->phone_number,
            'mobile'                            => $workData->mobile_number,
            'terms_and_conditions'              => $workData->terms_and_conditions,
            'terms_of_use'                      => $workData->terms_of_use,
            'job_description'                   => $workData->job_description,
            'instructions'                      => $workData->instructions,
            'first_verification_name'           => $customerData->first_verification_name,
            'first_number'                      => $customerData->first_number,
            'first_relation'                    => $customerData->first_relation,
            'second_verification_name'          => $customerData->second_verification_name,
            'second_number'                     => $customerData->second_number,
            'second_relation'                   => $customerData->second_relation,
            'third_verification_name'           => $customerData->third_verification_name,
            'third_number'                      => $customerData->third_number,
            'third_relation'                    => $customerData->third_relation,
            'date_issued'                       => $workData->date_issued,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,
            'business_name'                     => $customerData->business_name,

            'customs'                           => $customs,
            'items'                             => $items,

            'total'                             => $workData->grand_total,
            'subtotal'                          => $workData->subtotal,
            'taxes'                             => $workData->taxes,
            'adjustment_name'                   => $workData->adjustment_name,
            'adjustment_value'                  => $workData->adjustment_value,
            'voucher_value'                     => $workData->voucher_value,
            'otp_setup'                         => $workData->otp_setup,
            'monthly_monitoring'                => $workData->monthly_monitoring,

            'payment_method'                    => $payment->payment_method,
            'amount'                            => $payment->amount, //
            'check_number'                      => $payment->check_number,
            'routing_number'                    => $payment->routing_number,
            'account_number'                    => $payment->account_number,
            'credit_number'                     => $payment->credit_number,
            'credit_expiry'                     => $payment->credit_expiry,
            'credit_cvc'                        => $payment->credit_cvc,
            'account_credentials'               => $payment->account_credentials,
            'account_note'                      => $payment->account_note,
            'confirmation'                      => $payment->confirmation,
            'mail_address'                      => $payment->mail_address,
            'mail_locality'                     => $payment->mail_locality,
            'mail_state'                        => $payment->mail_state,
            'mail_postcode'                     => $payment->mail_postcode,
            'mail_cross_street'                 => $payment->mail_cross_street,
            'billing_date'                      => $payment->billing_date,
            'billing_frequency'                 => $payment->billing_frequency,

            'template'                          => '1',
            
            // 'source' => $source
        );


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_standard";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template', $data, $filename, "portrait");
        // $this->pdf->render();


        // $this->pdf->stream($filename);
    }

    public function work_order_pdf_alarm($wo_id)
    {
        
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workData = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workData->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorder = $workData->work_order_number;
        $c_id = $workData->company_id;
        $p_id = $workData->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrderAlarm($wo_id);
        $items = $this->workorder_model->getworkorderItems($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);

        $data = array(
            'workorder'                         => $workorder,
            'tags'                              => $workData->tags,
            'job_type'                          => $workData->job_type,
            'priority'                          => $workData->priority,
            'password'                          => $workData->password,
            'security_number'                   => $workData->security_number,
            'source_name'                       => $workData->lead_source_id,
            'company_representative_signature'  => $workData->company_representative_signature,
            'company_representative_name'       => $workData->company_representative_name,
            'primary_account_holder_signature'  => $workData->primary_account_holder_signature,
            'primary_account_holder_name'       => $workData->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,

            'company'                           => $cliets->business_name,
            'business_address'                  => $cliets->business_address,
            'phone_number'                      => $cliets->phone_number,
            'acs_name'                          => $customerData->first_name.' '.$customerData->middle_name.' '.$customerData->last_name,
            'job_location'                      => $workData->job_location,
            'job_location2'                     => $workData->city.', '.$workData->state.', '.$workData->zip_code.', '.$workData->cross_street,
            'email'                             => $workData->email,
            'phone'                             => $workData->phone_number,
            'mobile'                            => $workData->mobile_number,
            'terms_and_conditions'              => $workData->terms_and_conditions,
            'terms_of_use'                      => $workData->terms_of_use,
            'job_description'                   => $workData->job_description,
            'instructions'                      => $workData->instructions,
            'first_verification_name'           => $customerData->first_verification_name,
            'first_number'                      => $customerData->first_number,
            'first_relation'                    => $customerData->first_relation,
            'second_verification_name'          => $customerData->second_verification_name,
            'second_number'                     => $customerData->second_number,
            'second_relation'                   => $customerData->second_relation,
            'third_verification_name'           => $customerData->third_verification_name,
            'third_number'                      => $customerData->third_number,
            'third_relation'                    => $customerData->third_relation,
            'date_issued'                       => $workData->date_issued,
            'secondary_account_holder_signature'=> $workData->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workData->secondary_account_holder_name,
            'business_name'                     => $customerData->business_name,

            'customs'                           => $customs,
            'items'                             => $items,

            'total'                             => $workData->grand_total,
            'subtotal'                          => $workData->subtotal,
            'taxes'                             => $workData->taxes,
            'adjustment_name'                   => $workData->adjustment_name,
            'adjustment_value'                  => $workData->adjustment_value,
            'voucher_value'                     => $workData->voucher_value,
            'otp_setup'                         => $workData->otp_setup,
            'monthly_monitoring'                => $workData->monthly_monitoring,
            // 'source' => $source

            'payment_method'                    => $payment->payment_method,
            'amount'                            => $payment->amount, //
            'check_number'                      => $payment->check_number,
            'routing_number'                    => $payment->routing_number,
            'account_number'                    => $payment->account_number,
            'credit_number'                     => $payment->credit_number,
            'credit_expiry'                     => $payment->credit_expiry,
            'credit_cvc'                        => $payment->credit_cvc,
            'account_credentials'               => $payment->account_credentials,
            'account_note'                      => $payment->account_note,
            'confirmation'                      => $payment->confirmation,
            'mail_address'                      => $payment->mail_address,
            'mail_locality'                     => $payment->mail_locality,
            'mail_state'                        => $payment->mail_state,
            'mail_postcode'                     => $payment->mail_postcode,
            'mail_cross_street'                 => $payment->mail_cross_street,
            'billing_date'                      => $payment->billing_date,
            'billing_frequency'                 => $payment->billing_frequency,

            'template'                          => '2',
        );


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_alarm";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template', $data, $filename, "portrait");
        // $this->pdf->render();


        // $this->pdf->stream("welcome.pdf");
    }


    public function check()

    {

        $email = !empty(get('email')) ? get('email') : false;

        $username = !empty(get('username')) ? get('username') : false;

        $notId = !empty($this->input->get('notId')) ? $this->input->get('notId') : 0;


        if ($email)

            $exists = count($this->company_model->getByWhere([

                'email' => $email,

                'id !=' => $notId,

            ])) > 0 ? true : false;


        if ($username)

            $exists = count($this->company_model->getByWhere([

                'username' => $username,

                'id !=' => $notId,

            ])) > 0 ? true : false;


        echo $exists ? 'false' : 'true';
    }


    /**
     * @param $id
     */
    public function delete($id)

    {

        if ($id !== 1 && $id != logged($id)) {
        } else {

            redirect('/', 'refresh');

            return;
        }


        $id = $this->workorder_model->delete($id);


        $this->activity_model->add("User #$id Deleted by User:" . logged('name'));


        $this->session->set_flashdata('alert-type', 'success');

        $this->session->set_flashdata('alert', 'Workorder has been Deleted Successfully');


        redirect('workorder');
    }


    public function change_status($id)

    {

        $this->company_model->update($id, ['status' => get('status') == 'true' ? 1 : 0]);

        echo 'done';
    }


    public function employee_list_json()
    {
        $get = $this->input->get();

        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) { // ****** if user is company ******//
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id, 0, $get);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id, $get);
        }

        die(json_encode($this->page_data['users']));
    }


    /**
     *
     */
    public function map()
    {
        $this->load->model('Event_model');
        $this->load->model('Users_model');
        $this->load->model('Jobs_model');

        add_css(array(
            'assets/css/daterange/daterangepicker.css'
        ));

        add_footer_js(array(
            'https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js',
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&callback=initMap',
            //'https://maps.googleapis.com/maps/api/js?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&callback=initMap',
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js',
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js',
            'assets/js/daterange/daterangepicker.js'
        ));

        $is_allowed = $this->isAllowedModuleAccess(25);
        if( !$is_allowed ){
            $this->page_data['module'] = 'bird_eye_view';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $url      =  base_url(uri_string());
        $map_type = 'events';
        if(strpos($url, 'job/bird_eye_view') !== false) {
            $map_type = 'jobs';
        }

        $company_id   = logged('company_id');
        $companyUsers = $this->Users_model->getCompanyUsers($company_id);
        $this->page_data['map_type'] = $map_type;
        $this->page_data['job_status'] = $this->Jobs_model->getAllStatus();
        $this->page_data['companyUsers'] = $companyUsers;
        $this->load->view('workorder/bird-eye-view', $this->page_data);
    }

    /**
     *
     */
    public function ajax_load_map_routes()
    {
        set_time_limit (120);

        $this->load->model('Event_model');
        $this->load->model('Jobs_model');
        $this->load->model('Users_model');
        $this->load->model('EventType_model');
        $this->load->model('Clients_model');

        $user_id    = logged('id');
        $locations  = array();
        $markers    = array();
        $center_lat = '';
        $center_lng = '';
        $counter = 1;

        $post = $this->input->post();
        $date_range = ['date_from' => date("Y-m-d",strtotime($post['date_from'])), 'date_to' => date("Y-m-d",strtotime($post['date_to']))];
        if( $post['job_status'] != 'all' ){
            if( $post['map_type'] == 'events' ){
                $criteria = ['events.status' => $post['job_status']];
            }else{
                $criteria = ['jobs.status' => $post['job_status']];
            }
        }else{
            $criteria = array();
        }

        if( $post['user'] == 'all' ){
            $company_id  = logged('company_id');
            $users       = $this->Users_model->getCompanyUsers($company_id);
            $default_imp_img = base_url('uploads/users/default.png');
            foreach( $users as $user ){
                //Set Center Map
                $company = $this->Clients_model->getById($user->company_id);

                //$pointA   =  $user->address1 . ', ' . $user->city . ' ' . $user->state . ' ' . $user->postal_code;
                $pointA        = $company->business_address;
                $user_img      = userProfileImage($user->id);
                $description_a = "<div class='row'><div class='col-md-2'><img style='width: 40px;display:inline;margin-right:10px;' src='".$user_img."' alt='user' class='rounded-circle nav-user-img vertical-center'></div><div class='col-md-10'><b>".$user->FName. " " .$user->LName. "<br />".$company->business_name."</b><br /><small>".$pointA."</small></div></div>";
                $gdata    = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&address=".urlencode($pointA)."&sensor=false");
                if($gdata){
                    $json = json_decode($gdata, true);
                    if( isset($json['results'][0]['geometry']['location']['lat']) && $json['results'][0]['geometry']['location']['lat'] != '' ){
                        $center_lng = $json['results'][0]['geometry']['location']['lng'];
                        $center_lat = $json['results'][0]['geometry']['location']['lat'];
                    }
                }

                if( $post['map_type'] == 'events' ){
                    //Events
                    $events  = $this->Event_model->getAllUserEventsWithAddress($user->id, $date_range);
                    foreach($events as $e){
                        if( $e->event_address != '' ){
                            $marker = 'https://staging.nsmartrac.com/uploads/event_types/internet_48px.png';
                            if( $e->event_type_id > 0 ){
                                $eventType = $this->EventType_model->getById($e->event_type_id);
                                if( $eventType->is_marker_icon_default_list == 1 ){
                                    $marker = base_url('/uploads/icons/' . $eventType->icon_marker);
                                }else{
                                    $marker = base_url('/uploads/event_types/' . $eventType->company_id . "/" . $eventType->icon_marker);
                                }
                            }

                            $pointB = $e->event_address;
                            $gdata  = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&address=".urlencode($pointB)."&sensor=false");
                            $json   = json_decode($gdata, true);
                            if( isset($json['results'][0]['geometry']['location']['lat']) && $json['results'][0]['geometry']['location']['lat'] != '' ){
                                $description_b = "<table style='font-size:12px;'>
                                    <tr'>
                                        <td style='width:10%;'>
                                            <img style='width: 40px;display:inline;margin-right:10px;' src='".$user_img."' alt='user' class='rounded-circle nav-user-img vertical-center'>
                                        </td>
                                        <td>
                                            <i class='fa fa-calendar'></i> " . $e->start_time . " - " . $e->end_time . "<hr style='margin:7px 0px;' />
                                            <b>".$e->event_type. "</b><br /><small>".$pointB."</small>
                                        </td>
                                    </tr>
                                </table>";
                                $locations[] = [
                                    'title' => $pointA,
                                    'lat' => $center_lat,
                                    'lng' => $center_lng,
                                    'title' => "<b>Start Point</b><br />" . $pointA,
                                    'description' => $description_a,
                                    'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                                ];
                                $locations[] = [
                                    'title' => $pointB,
                                    'lat' => $json['results'][0]['geometry']['location']['lat'],
                                    'lng' => $json['results'][0]['geometry']['location']['lng'],
                                    'description' => $description_b,
                                    'marker' => $marker
                                ];
                            }
                        }
                        $counter++;
                    }
                }else{
                    //Jobs
                    $jobs    = $this->Jobs_model->getAllJobsByUserId($user->id,$date_range,$criteria);
                    foreach($jobs as $j){
                        //if( $j->job_location != '' ){
                            $pointB = $j->subdivision . ' ' . $j->city . ' ' . $j->state . ' ' . ' ' . $j->country . ' ' . $j->zip_code;

                            $description_b = "<table style='font-size:12px;'>
                                <tr'>
                                    <td style='width:10%;'>
                                        <img style='width: 40px;display:inline;margin-right:10px;' src='".$user_img."' alt='user' class='rounded-circle nav-user-img vertical-center'>
                                    </td>
                                    <td>
                                        <i class='fa fa-calendar'></i> " . $j->start_time . " - " . $j->end_time . "<hr style='margin:7px 0px;' />
                                        <i class='fa fa-user'></i>" .$j->first_name . ' ' . $j->last_name."<b />
                                        <b>".$j->job_number . " - " . $j->job_type. "</b><br /><small>".$pointB."</small>
                                    </td>
                                </tr>
                            </table>";

                            //$description_b = "<i class='fa fa-calendar'></i> " . $j->start_time . " - " . $j->end_time . "<br /><br />" . $j->job_number . " - " . $j->job_type . "<br /><small>" . $j->first_name . ' ' . $j->last_name . "</small><br /><small>" . $j->mail_add . " " . $j->cus_city . " " . $j->cus_state . "</small>";

                            $gdata  = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&address=".urlencode($pointB)."&sensor=false");
                            $json   = json_decode($gdata, true);
                            if( isset($json['results'][0]['geometry']['location']['lat']) && $json['results'][0]['geometry']['location']['lat'] != '' ){
                               $locations[] = [
                                    'title' => $pointA,
                                    'lat' => $center_lat,
                                    'lng' => $center_lng,
                                    'description' => $description_a,
                                    'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                                ];
                                $locations[] = [
                                    'title' => $pointB,
                                    'lat' => $json['results'][0]['geometry']['location']['lat'],
                                    'lng' => $json['results'][0]['geometry']['location']['lng'],
                                    'description' => $description_b,
                                    'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                                ];
                            }
                        //}

                        $counter++;
                    }
                }
            }
        }else{
            if( $post['user'] > 0 ){
                $user    = $this->Users_model->getUser($post['user']);
                $company = $this->Clients_model->getById($user->company_id);
            }else{
                $user    = $this->Users_model->getUser($user_id);
                $company = $this->Clients_model->getById($user->company_id);
            }

            //Set Center Map
            $pointA        = $company->business_address;
            $user_img      = userProfileImage($user->id);
            $description_a = "<div class='row'><div class='col-md-2'><img style='width: 40px;display:inline;margin-right:10px;' src='".$user_img."' alt='user' class='rounded-circle nav-user-img vertical-center'></div><div class='col-md-10'><b>".$user->FName. " " .$user->LName. "<br />".$company->business_name."</b><br /><small>".$pointA."</small></div></div>";
            $gdata   = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&address=".urlencode($pointA)."&sensor=false");
            if($gdata){
                $json = json_decode($gdata, true);
                $center_lng = $json['results'][0]['geometry']['location']['lng'];
                $center_lat = $json['results'][0]['geometry']['location']['lat'];
            }

            if( $post['map_type'] == 'events' ){
                $events  = $this->Event_model->getAllUserEventsWithAddress($user->id,$date_range);
                //Events
                foreach($events as $e){
                    if( $e->event_address != '' ){
                        $marker = 'https://staging.nsmartrac.com/uploads/event_types/internet_48px.png';
                        if( $e->event_type_id > 0 ){
                            $eventType = $this->EventType_model->getById($e->event_type_id);
                            if( $eventType->is_marker_icon_default_list == 1 ){
                                $marker = base_url('/uploads/icons/' . $eventType->icon_marker);
                            }else{
                                $marker = base_url('/uploads/event_types/' . $eventType->company_id . "/" . $eventType->icon_marker);
                            }

                        }

                        $pointB = $e->event_address;
                        $description_b = "<table style='font-size:12px;'>
                            <tr'>
                                <td style='width:10%;'>
                                    <img style='width: 40px;display:inline;margin-right:10px;' src='".$user_img."' alt='user' class='rounded-circle nav-user-img vertical-center'>
                                </td>
                                <td>
                                    <i class='fa fa-calendar'></i> " . $e->start_time . " - " . $e->end_time . "<hr style='margin:7px 0px;' />
                                    <b>".$e->event_type. "</b><br /><small>".$pointB."</small>
                                </td>
                            </tr>
                        </table>";

                        //$description_b = "<i class='fa fa-calendar'></i> " . $e->start_time . " - " . $e->end_time . "<br /><br />" . $e->event_type . "<br /><small>" . $pointB . "</small>";
                        $gdata  = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&address=".urlencode($pointB)."&sensor=false");
                        $json   = json_decode($gdata, true);
                        if( isset($json['results'][0]['geometry']['location']['lat']) && $json['results'][0]['geometry']['location']['lat'] != '' ){
                            $locations[] = [
                                'title' => $pointA,
                                'lat' => $center_lat,
                                'lng' => $center_lng,
                                'description' => $description_a,
                                'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                            ];
                            $locations[] = [
                                'title' => $description_b,
                                'lat' => $json['results'][0]['geometry']['location']['lat'],
                                'lng' => $json['results'][0]['geometry']['location']['lng'],
                                'description' => $pointB,
                                'marker' => $marker
                            ];
                        }
                    }
                    $counter++;
                }
            }else{
                //Jobs
                $jobs    = $this->Jobs_model->getAllJobsByUserId($user->id,$date_range,$criteria);
                $jobs_customer = array();
                $counter = end(array_keys($locations));
                foreach($jobs as $j){
                    if( $j->city != '' && $j->state != '' && $j->country != '' && $j->zip_code != '' ){
                        if( isset($jobs_customer[$j->prof_id]) ){
                            $index_b = $jobs_customer[$j->prof_id]['index_b'];
                            $description = $locations[$index_b]['description'];
                            $new_description = "<br /><b>". $j->job_number . " - " . $j->job_description . "</b>" . $description;
                            $locations[$index_b]['description'] = $new_description;
                        }else{
                            $pointB = $j->subdivision . ' ' . $j->city . ' ' . $j->state . ' ' . ' ' . $j->country . ' ' . $j->zip_code;
                            $gdata  = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyASLBI1gI3Kx9K__jLuwr9xuQaBkymC4Jo&address=".urlencode($pointB)."&sensor=false");
                            $json   = json_decode($gdata, true);
                            if( isset($json['results'][0]['geometry']['location']['lat']) && $json['results'][0]['geometry']['location']['lat'] != '' ){
                                $locations[$counter] = [
                                    'title' => $pointA,
                                    'lat' => $center_lat,
                                    'lng' => $center_lng,
                                    'description' => $description_a,
                                    'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                                ];
                                $locations[$counter+1] = [
                                    'title' => $pointB,
                                    'lat' => $json['results'][0]['geometry']['location']['lat'],
                                    'lng' => $json['results'][0]['geometry']['location']['lng'],
                                    'description' => "<b>" . $j->job_number . " - " . $j->job_description . "</b><br/ ><small>".$pointB."</small>",
                                    'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                                ];

                                $jobs_customer[$j->prof_id] = ['index_a' => $counter, 'index_b' => $counter + 1];

                                $counter++;
                            }
                        }
                    }
                }
            }
        }
        $this->page_data['center_lng'] = $center_lng;
        $this->page_data['center_lat'] = $center_lat;
        $this->page_data['locations'] = $locations;
        $this->load->view('workorder/ajax_load_map_routes', $this->page_data);
    }


    public function settings()
    {
        $is_allowed = $this->isAllowedModuleAccess(28);
        if( !$is_allowed ){
            $this->page_data['module'] = 'settings2';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $this->load->model('WorkorderSettings_model', 'WorkorderSettings');

        $company_id        = logged('company_id');
        $workorderSettings = $this->WorkorderSettings->getByCompanyId($company_id);

        //Default values
        $prefix = 'WO-';
        $order_num_next = str_pad(1, 5, '0', STR_PAD_LEFT);

        if( $workorderSettings ){
            //Load company settings
            $prefix = $workorderSettings->work_order_num_prefix;
            $order_num_next    = $workorderSettings->work_order_num_next;
            $capture_signature = $workorderSettings->capture_customer_signature;
        }

        $this->page_data['prefix'] = $prefix;
        $this->page_data['order_num_next'] = $order_num_next;
        $this->page_data['capture_signature'] = $capture_signature;
        $this->page_data['page']->menu = 'settings';
        $this->page_data['clients'] = $this->workorder_model->getclientsById();

        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();

        $this->load->view('workorder/settings', $this->page_data);
    }

    public function addheader()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $header_data = array(
            
            'content' => $this->input->post('add_header'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->save_header($header_data);


        if($custom_dataQuery > 0){

           redirect('workorder/settings');
        }
        else{
            echo json_encode(0);
        }
    }

    public function updateheader()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $header_data = array(
            
            'content' => $this->input->post('update_header'),
            // 'company_id' => $company_id,
            // 'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->update_header($header_data);


        // if($custom_dataQuery > 0){

           redirect('workorder/settings');
        // }
        // else{
        //     echo json_encode(0);
        // }
    }

    public function updatecustomField()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $custom_id  =  $this->input->post('custom_id');

        $header_data = array(
            'id' => $this->input->post('custom_id'),
            'name' => $this->input->post('custom_name'),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->update_custom_field($header_data);

           redirect('workorder/settings');
    }

    public function getchecklistdetailsajax()
    {
        $id = $this->input->post('id');
        $company_id = logged('company_id');

            $checklist = $this->workorder_model->getchecklistdetailsajax($id);

            $this->page_data['checklists'] = $checklist;
            // $this->page_data['checklists_items'] = $checklist;

        echo json_encode($this->page_data);
    }

    public function save_update_custom_name(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $custom_id  =  $this->input->post('custom_id');

        $header_data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->update_custom_field($header_data);

        echo json_encode($custom_dataQuery);
    }

    public function save_update_custom_name_edit(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $custom_id  =  $this->input->post('custom_id');

        $header_data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            // 'value' => $this->input->post('value'),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->update_custom_field_edit($header_data);

        echo json_encode($custom_dataQuery);
    }

    public function save_update_tc(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $id  =  $this->input->post('id');

        $data = array(
            'id' => $this->input->post('id'),
            'content' => $this->input->post('content'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $dataQuery = $this->workorder_model->update_tc($data);

        echo json_encode($dataQuery);
    }

    public function save_update_header(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $id  =  $this->input->post('id');

        $data = array(
            'id' => $this->input->post('id'),
            'content' => $this->input->post('content'),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $dataQuery = $this->workorder_model->update_header_f($data);

        echo json_encode($dataQuery);
    }

    public function save_update_tu()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $id  =  $this->input->post('id');

        $data = array(
            'id' => $this->input->post('id'),
            'content' => $this->input->post('content'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $dataQuery = $this->workorder_model->update_tu($data);

        echo json_encode($dataQuery);
    }

    public function getchecklistitemsajax()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $id  =  $this->input->post('cID');

        $checklistsItem = $this->workorder_model->checklistsitems($id);
        $this->page_data['citems'] = $checklistsItem;

        echo json_encode($this->page_data);
    }

    public function hoverDetails(){

    }


    /**
     * used a concept of Service here
     * If we need the Priority module on other controller, we have to write same code
     * like add, edit, delete route on that controller again. If we need a change, we have to do on all controller.
     * Also, it has multiple level of route, so put all together in one controller, code become hard to read.
     * So, to get rid of these issues, the service class every time whenever we need this module.
     *
     */
    public function job_type()
    {
        $is_allowed = $this->isAllowedModuleAccess(26);
        if( !$is_allowed ){
            $this->page_data['module'] = 'job_type_list';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        // pass the $this so that we can use it to load view, model, library or helper classes
        $jobType = new JobType($this);
    }


    public function priority()
    {
        $is_allowed = $this->isAllowedModuleAccess(27);
        if( !$is_allowed ){
            $this->page_data['module'] = 'priority_list';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        new Priority($this);
    }


    public function tab($index)
    {

        $this->index($index);
    }


    /**
     *
     */
    public function clone_ajax()
    {
        $post = $this->input->post();

        $workorder = $this->workorder_model->getById($post['workorder_id']);
        $workorder_data = array();

        if (!empty($workorder)) {

            foreach ($workorder as $key => $wo) {

                if ($key === 'id')
                    continue;

                $workorder_data[$key] = $wo;
            }

            // insert new
            $workorder_id = $this->workorder_model->create($workorder_data);

            if ($workorder_id) {

                die(
                json_encode(
                    array(
                        'status' => 200
                    )
                )
                );
            }
        }

        die(
        json_encode(
            array(
                'status' => 'error'
            )
        ));
    }

    public function print($tab_index = 0)
    {

        $role = logged('role');
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
                $this->page_data['workorders'] = $this->workorder_model->filterBy(array('status' => $tab_index), $company_id);
            } else {

                // search
                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('order'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

                } else {

                    $this->page_data['workorders'] = $this->workorder_model->getAllOrderByCompany($company_id);
                }
            }

            $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount($company_id);
        }
        if ($role == 4) {

            if (!empty($tab_index)) {

                $this->page_data['tab_index'] = $tab_index;
                $this->page_data['workorders'] = $this->workorder_model->filterBy();

            } elseif (!empty(get('order'))) {

                $this->page_data['order'] = get('order');
                $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

            } else {

                if (!empty(get('search'))) {

                    $this->page_data['search'] = get('search');
                    $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } else {
                    $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();
                }
            }

            $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount();
        }

        // unserialized the value

        $statusFilter = array();
        foreach ($this->page_data['workorders'] as $workorder) {

            if (is_serialized($workorder)) {

                $workorder = unserialize($workorder);
            }
        }

//        print_r($this->page_data['workorders']); die;

        $this->load->view('workorder/print/list', $this->page_data);
    }

    public function ajax_update_workoder_settings()
    {
        postAllowed();
        $post = $this->input->post();
        $hide_from_email = 0;
        if( isset($post['hide_from_email']) ){
            $hide_from_email = 1;
        }

        $json_data = [
                'is_success' => 0,
                'msg' => 'Cannot update settings'
        ];

        $this->load->model('WorkorderSettings_model', 'WorkorderSettings');

        $company_id        = logged('company_id');
        $workorderSettings = $this->WorkorderSettings->getByCompanyId($company_id);

        if( $workorderSettings ){
            $data = [
                'work_order_num_prefix' => $post['next_custom_number_prefix'],
                'work_order_num_next' => $post['next_custom_number_base'],
                'capture_customer_signature' => $hide_from_email,
            ];

            $workorderSettings = $this->WorkorderSettings->updateByCompanyId($company_id,$data);

            $json_data = [
                    'is_success' => 1,
                    'msg' => 'Settings saved.'
            ];

        }else{
            $data = [
                'work_order_num_prefix' => $post['next_custom_number_prefix'],
                'work_order_num_next' => $post['next_custom_number_base'],
                'capture_customer_signature' => $hide_from_email,
                'company_id' => $company_id
            ];

            $workorderSettings = $this->WorkorderSettings->create($data);

            $json_data = [
                    'is_success' => 1,
                    'msg' => 'Settings saved.'
            ];
        }

        echo json_encode($json_data);
    }

    public function checklists(){
        $this->load->helper(array('hashids_helper'));
        $this->load->model('Checklist_model');

        $checklists = $this->Checklist_model->getAllByUserId();

        $this->page_data['checklists'] = $checklists;
        $this->load->view('workorder/checklist/list', $this->page_data);
    }

    public function add_checklist(){
        $this->load->model('Checklist_model');
        $checklistAttachType = $this->Checklist_model->getAttachType();

        $this->page_data['checklistAttachType'] = $checklistAttachType;
        $this->load->view('workorder/checklist/add_checklist', $this->page_data);
    }

    public function create_checklist(){
        $this->load->model('Checklist_model');

        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $user_id = logged('id');

        $data = [
            'user_id' => $user_id,
            'checklist_name' => $post['checklist_name'],
            'attach_to_work_order' => $post['attach_to_work_order'],
            // 'date_created' => date("Y-m-d H:i:s"),
            // 'date_modified' => date("Y-m-d H:i:s")
            'date_created' => date("m-d-Y H:i:s"),
            'date_modified' => date("m-d-Y H:i:s")
        ];

        $cid = $this->Checklist_model->create($data);


        $this->session->set_flashdata('message', 'Checklist created. Now you can start adding the items.');
        $this->session->set_flashdata('alert_class', 'alert-success');

        redirect('workorder/edit_checklist/' . $cid);
    }

    public function edit_checklist($id){
        $this->load->model('Checklist_model');
        $this->load->model('ChecklistItem_model');

        $checklistAttachType = $this->Checklist_model->getAttachType();

        $checklist = $this->Checklist_model->getById($id);

        if( $checklist ){
            $this->page_data['checklist'] = $checklist;
            $this->page_data['checklistAttachType'] = $checklistAttachType;
            $this->load->view('workorder/checklist/edit_checklist', $this->page_data);

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');

            redirect('workorder/checklists');
        }
    }

    public function ajax_load_checklist_items(){
        $this->load->model('ChecklistItem_model');
        $this->load->helper(array('hashids_helper'));

        $post = $this->input->post();
        $checklistItems = $this->ChecklistItem_model->getAllByChecklistId($post['cid']);

        $this->page_data['checklistItems'] = $checklistItems;
        $this->load->view('workorder/checklist/_checklist_items', $this->page_data);
    }

    public function ajax_create_checklist_item(){
        $this->load->model('ChecklistItem_model');

        $post = $this->input->post();

        $data = [
            'checklist_id' => $post['cid'],
            'item_name' => $post['item_name'],
        ];

        $cid = $this->ChecklistItem_model->create($data);

        $json_data = ['is_success' => true];

        echo json_encode($json_data);

        exit;
    }

    public function ajax_delete_checklist_items(){
        $this->load->helper(array('hashids_helper'));
        $this->load->model('ChecklistItem_model');

        $post = $this->input->post();
        $id   = hashids_decrypt($post['eid'], '', 15);
        $this->ChecklistItem_model->deleteById($id);

        $json_data = ['is_success' => true];

        echo json_encode($json_data);

        exit;
    }

    public function ajax_update_checklist_item(){
        $this->load->helper(array('hashids_helper'));
        $this->load->model('ChecklistItem_model');

        $post = $this->input->post();
        $id   = hashids_decrypt($post['edit_cheklist_item'], '', 15);

        $this->ChecklistItem_model->update($id, array(
            'item_name' => $post['edit_item_name']
        ));

        $json_data = ['is_success' => true];

        echo json_encode($json_data);

        exit;
    }

    public function update_checklist(){
        $this->load->helper(array('hashids_helper'));
        $this->load->model('Checklist_model');

        $post = $this->input->post();
        $cid  = $post['cid'];
        $checklist = $this->Checklist_model->getById($cid);

        if( $checklist ){
            $this->Checklist_model->update($cid, array(
                'checklist_name' => $post['checklist_name'],
                'attach_to_work_order' => $post['attach_to_work_order'],
                'date_modified' => date("Y-m-d H:i:s")
            ));

            $this->session->set_flashdata('message', 'Checklist was successfully updated.');
            $this->session->set_flashdata('alert_class', 'alert-success');

        }else{
            $this->session->set_flashdata('message', 'Cannot find data');
            $this->session->set_flashdata('alert_class', 'alert-danger');
        }

        redirect('workorder/edit_checklist/'.$cid);

    }

    public function NewworkOrder()
    {
        $this->load->model('AcsProfile_model');
        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');

        $company_id = logged('company_id');
        $this->load->library('session');

        $users_data = $this->session->all_userdata();
        // foreach($users_data as $usersD){
        //     $userID = $usersD->id;
            
        // }

        // print_r($user_id);
        // $users = $this->users_model->getUserByID($user_id);
        // print_r($users);
        // echo $company_id;

        $role = logged('role');
        if( $role == 1 || $role == 2){
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);

        $termsCondi = $this->workorder_model->getTerms($company_id);
        if($termsCondi){
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        }else{
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if($termsUse){
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        }else{
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }

        // print_r($this->page_data['terms_conditions']);
        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        
        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);
        $this->page_data['page_title'] = "Work Order";
        // print_r($this->page_data['lead_source']);

        $this->load->view('workorder/addNewworkOrder', $this->page_data);
    }

    public function select_package()
    {
        $id = $this->input->post('idd');

            $items = $this->workorder_model->getitemsajax($id);

            $this->page_data['items'] = $items;
            // $this->page_data['checklists_items'] = $checklist;

        echo json_encode($this->page_data);
    }
    

    public function addcustomeField()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $custom_data = array(
            
            'name' => $this->input->post('custom_name'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->add_custom_fields($custom_data);

        if($custom_dataQuery > 0){

           redirect('workorder/settings');
        }
        else{
            echo json_encode(0);
        }

        
    } 

    public function savenewWorkorder(){
        $company_id     = getLoggedCompanyID();
        // $user_id        = getLoggedUserID();
        $user_id = logged('id');

        $wo_id          = $this->input->post('workorder_number');

        if(!empty($this->input->post('company_representative_approval_signature1aM_web')))
        {
            $datasig            = $this->input->post('company_representative_approval_signature1aM_web');
            $folderPath         = "./uploads/Signatures/1/";
            $image_parts        = explode(";base64,", $datasig);
            $image_type_aux     = explode("image/", $image_parts[0]);
            $image_type         = $image_type_aux[1];
            $image_base64       = base64_decode($image_parts[1]);
            $file               = $folderPath . $wo_id . '_company' . '.'.$image_type;
            $file_save          = '../../uploads/Signatures/1/' . $wo_id . '_company' . '.'.$image_type;
            file_put_contents($file, $image_base64);
        }
        else
        {
            $file_save          = NULL;
        }

        if(!empty($this->input->post('primary_representative_approval_signature1aM_web')))
        {
            $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
            $folderPath2        = "./uploads/Signatures/1/";
            $image_parts2       = explode(";base64,", $datasig2);
            $image_type_aux2    = explode("image/", $image_parts2[0]);
            $image_type2        = $image_type_aux2[1];
            $image_base642      = base64_decode($image_parts2[1]);
            $file2              = $folderPath2 . $wo_id . '_primary' . '.'.$image_type2;
            $file2_save         = '../../uploads/Signatures/1/' . $wo_id . '_primary' . '.'.$image_type2;
            file_put_contents($file2, $image_base642);
        }
        else
        {
            $file2_save          = NULL;
        }

        if(!empty($this->input->post('secondary_representative_approval_signature1aM_web')))
        {
            $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
            $folderPath3        = "./uploads/Signatures/1/";
            $image_parts3       = explode(";base64,", $datasig3);
            $image_type_aux3    = explode("image/", $image_parts3[0]);
            $image_type3        = $image_type_aux3[1];
            $image_base643      = base64_decode($image_parts3[1]);
            $file3              = $folderPath3 . $wo_id . '_secondary' . '.'.$image_type3;
            $file3_save         = '../../uploads/Signatures/1/' . $wo_id . '_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else
        {
            $file3_save          = NULL;
        }


        $action = $this->input->post('action');
        if($action == 'submit') {

        $new_data = array(
            
            'work_order_number'                     => $this->input->post('workorder_number'),
            'customer_id'                           => $this->input->post('customer_id'),
            'security_number'                       => $this->input->post('security_number'),
            'birthdate'                             => $this->input->post('birthdate'),
            'phone_number'                          => $this->input->post('phone_number'),
            'mobile_number'                         => $this->input->post('mobile_number'),
            'email'                                 => $this->input->post('email'),
            // 'job_location'                          => $this->input->post('job_location') .', ' .$this->input->post('city') .', '. $this->input->post('state') .', '. $this->input->post('zip_code') .', '. $this->input->post('cross_street'),
            'job_location'                          => $this->input->post('job_location'),
            'city'                                  => $this->input->post('city'),
            'state'                                 => $this->input->post('state'),
            'zip_code'                              => $this->input->post('zip_code'),
            'cross_street'                          => $this->input->post('cross_street'),
            'password'                              => $this->input->post('password'),
            'offer_code'                            => $this->input->post('offer_code'),//
            'tags'                                  => $this->input->post('job_tag'),
            'date_issued'                           => $this->input->post('schedule_date_given'),
            'job_type'                              => $this->input->post('job_type'),
            'job_name'                              => $this->input->post('job_name'),
            'job_description'                       => $this->input->post('job_description'),
            'payment_method'                        => $this->input->post('payment_method'),
            'payment_amount'                        => $this->input->post('payment_amount'),
            'lead_source_id'                        => $this->input->post('lead_source'),
            // 'account_holder_name' => $this->input->post('account_holder_name'),
            // 'account_number' => $this->input->post('account_number'),
            // 'expiry' => $this->input->post('expiry'),
            // 'cvc' => $this->input->post('cvc'),
            'terms_and_conditions'                  => $this->input->post('terms_conditions'),
            'status'                                => $this->input->post('status'),
            'priority'                              => $this->input->post('priority'),
            'po_number'                             => $this->input->post('purchase_order_number'),
            'terms_of_use'                          => $this->input->post('terms_of_use'),
            'instructions'                          => $this->input->post('instructions'),
            'header'                                => $this->input->post('header'),

            //signature
            'company_representative_signature'      => $file_save,
            'company_representative_name'           => $this->input->post('company_representative_printed_name'),
            'primary_account_holder_signature'      => $file2_save,
            'primary_account_holder_name'           => $this->input->post('primary_account_holder_name'),
            'secondary_account_holder_signature'    => $file3_save,
            'secondary_account_holder_name'         => $this->input->post('secondery_account_holder_name'),

            // 'company_representative_signature' => 'company_representative_signature',
            // 'company_representative_name' => 'company_representative_name',
            // 'primary_account_holder_signature' => 'primary_account_holder_signature',
            // 'primary_account_holder_name' => 'primary_account_holder_name',
            // 'secondary_account_holder_signature' => 'secondary_account_holder_signature',
            // 'secondary_account_holder_name' => 'secondary_account_holder_name',
            

            //attachment
            // 'attached_photo' => $this->input->post('attached_photo'),
            // 'document_links' => $this->input->post('document_links'),
            'attached_photo'                        => 'attached_photo',
            'document_links'                        => 'document_links',

            'subtotal'                              => $this->input->post('subtotal'),
            'taxes'                                 => $this->input->post('taxes'), 
            'adjustment_name'                       => $this->input->post('adjustment_name'),
            'adjustment_value'                      => $this->input->post('adjustment_value'),
            'voucher_value'                         => $this->input->post('voucher_value'),
            'grand_total'                           => $this->input->post('grand_total'),

            'employee_id'                           => $user_id,
            'is_template'                           => '1',
            'company_id'                            => $company_id,
            'date_created'                          => date("Y-m-d H:i:s"),
            'date_updated'                          => date("Y-m-d H:i:s"),
            'work_order_type_id'                    => '1'
        );

        // var_dump($new_data);

        $addQuery = $this->workorder_model->save_workorder($new_data);
        

        if($this->input->post('payment_method') == 'Cash'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'is_collected'              => '1',
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Check'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'check_number'              => $this->input->post('check_number'),
                'routing_number'            => $this->input->post('routing_number'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Credit Card'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'credit_number'             => $this->input->post('credit_number'),
                'credit_expiry'             => $this->input->post('credit_expiry'),
                'credit_cvc'                => $this->input->post('credit_cvc'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Debit Card'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'credit_number'             => $this->input->post('debit_credit_number'),
                'credit_expiry'             => $this->input->post('debit_credit_expiry'),
                'credit_cvc'                => $this->input->post('debit_credit_cvc'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'ACH'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'routing_number'            => $this->input->post('ach_routing_number'),
                'account_number'            => $this->input->post('ach_account_number'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Venmo'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('account_credentials'),
                'account_note'              => $this->input->post('account_note'),
                'confirmation'              => $this->input->post('confirmation'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Paypal'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('paypal_account_credentials'),
                'account_note'              => $this->input->post('paypal_account_note'),
                'confirmation'              => $this->input->post('paypal_confirmation'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Square'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('square_account_credentials'),
                'account_note'              => $this->input->post('square_account_note'),
                'confirmation'              => $this->input->post('square_confirmation'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Warranty Work'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('warranty_account_credentials'),
                'account_note'              => $this->input->post('warranty_account_note'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Home Owner Financing'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('home_account_credentials'),
                'account_note'              => $this->input->post('home_account_note'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'e-Transfer'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('e_account_credentials'),
                'account_note'              => $this->input->post('e_account_note'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Credit Card Professor'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'credit_number'             => $this->input->post('other_credit_number'),
                'credit_expiry'             => $this->input->post('other_credit_expiry'),
                'credit_cvc'                => $this->input->post('other_credit_cvc'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Payment Type'){
            $payment_data = array(
            
                'payment_method'            => $this->input->post('payment_method'),
                'amount'                    => $this->input->post('payment_amount'),
                'account_credentials'       => $this->input->post('other_payment_account_credentials'),
                'account_note'              => $this->input->post('other_payment_account_note'),
                'work_order_id'             => $addQuery,
                'date_created'              => date("Y-m-d H:i:s"),
                'date_updated'              => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        
        
        // $custom_data = array(
            
        //     'custom1_field' => $this->input->post('custom1_field'),
        //     'custom1_value' => $this->input->post('custom1_value'),
        //     'custom2_field' => $this->input->post('custom2_field'),
        //     'custom2_value' => $this->input->post('custom2_value'),
        //     'custom3_field' => $this->input->post('custom3_field'),
        //     'custom3_value' => $this->input->post('custom3_value'),
        //     'custom4_field' => $this->input->post('custom4_field'),
        //     'custom4_value' => $this->input->post('custom4_value'),
        //     'custom5_field' => $this->input->post('custom5_field'),
        //     'custom5_value' => $this->input->post('custom5_value'),
        //     'workorder_id' => $addQuery,
        // );

        // $custom_dataQuery = $this->workorder_model->save_custom_fields($custom_data);

        $name = $this->input->post('custom_field');
        $value = $this->input->post('custom_value');

        $c = 0;
            foreach($name as $row2){
                $dataa['name'] = $name[$c];
                $dataa['value'] = $value[$c];
                $dataa['work_order_id'] = $addQuery;
                $dataa['company_id'] = $company_id;
                $dataa['date_added'] = date("Y-m-d H:i:s");
                $addQuery2a = $this->workorder_model->additem_details($dataa);
                $c++;
            }


        // if($addQuery > 0){
        //     $a = $this->input->post('items');
        //     $b = $this->input->post('item_type');
        //     $d = $this->input->post('quantity');
        //     $f = $this->input->post('price');
        //     $g = $this->input->post('discount');
        //     $h = $this->input->post('tax');
        //     $ii = $this->input->post('total');

        //     $i = 0;
        //     foreach($a as $row){
        //         $data['item'] = $a[$i];
        //         $data['item_type'] = $b[$i];
        //         $data['qty'] = $d[$i];
        //         $data['cost'] = $f[$i];
        //         $data['discount'] = $g[$i];
        //         $data['tax'] = $h[$i];
        //         $data['total'] = $ii[$i];
        //         $data['type'] = 'Work Order';
        //         $data['type_id'] = $addQuery;
        //         // $data['status'] = '1';
        //         $data['created_at'] = date("Y-m-d H:i:s");
        //         $data['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //         $i++;
        //     }

            if($addQuery > 0){
                $a          = $this->input->post('itemid');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $h          = $this->input->post('tax');

                $i = 0;
                foreach($a as $row){
                    $data['items_id'] = $a[$i];
                    $data['qty'] = $quantity[$i];
                    $data['cost'] = $price[$i];
                    $data['tax'] = $h[$i];
                    $data['work_order_id '] = $addQuery;
                    $addQuery2 = $this->workorder_model->add_work_order_details($data);
                    $i++;
                }

                $getname = $this->workorder_model->getname($user_id);

                $notif = array(
            
                    'user_id'               => $user_id,
                    'title'                 => 'New Work Order',
                    'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
                    'date_created'          => date("Y-m-d H:i:s"),
                    'status'                => '1',
                    'company_id'            => getLoggedCompanyID()
                );
    
                $notification = $this->workorder_model->save_notification($notif);


            redirect('workorder');
            }
            else{
                echo json_encode(0);
            }
        }
        if($action == 'preview') {
            $dataaa = $this->input->post('workorder_number');
            $this->page_data['users'] = $this->users_model->getUser(logged('id'));

            $this->load->library('pdf');
            $html = $this->load->view('workorder/preview', [], true);
            $this->pdf->createPDF($html, 'mypdf', false);
            exit(0);
        }
    }

    public function duplicate_workorder()
    {
        $company_id     = getLoggedCompanyID();
        // $user_id        = getLoggedUserID();
        $user_id        = logged('id');
        $wo_num = $this->input->post('wo_num');

        $datas = $this->workorder_model->getDataByWO($wo_num);

        $number = $this->workorder_model->getlastInsert($company_id);
        foreach ($number as $num){
            $next = $num->work_order_number;
            $arr = explode("-", $next);
            $date_start = $arr[0];
            $nextNum = $arr[1];
        //    echo $number;
        }
       $val = $nextNum + 1;
       $work_order_number = 'WO-'.str_pad($val,7,"0",STR_PAD_LEFT);

        $new_data = array(
            
            'work_order_number'                     => $work_order_number,
            'customer_id'                           => $datas->customer_id,
            'security_number'                       => $datas->security_number,
            'birthdate'                             => $datas->birthdate,
            'phone_number'                          => $datas->phone_number,
            'mobile_number'                         => $datas->mobile_number,
            'email'                                 => $datas->email,
            'job_location'                          => $datas->job_location,
            'city'                                  => $datas->city,
            'state'                                 => $datas->state,
            'zip_code'                              => $datas->zip_code,
            'cross_street'                          => $datas->cross_street,
            'password'                              => $datas->password,
            'offer_code'                            => $datas->offer_code,//
            'tags'                                  => $datas->tags,
            'schedule_date_given'                   => $datas->schedule_date_given,
            'job_type'                              => $datas->job_type,
            'job_name'                              => $datas->job_name,
            'job_description'                       => $datas->job_description,
            'payment_method'                        => $datas->payment_method,
            'payment_amount'                        => $datas->payment_amount,
            'lead_source_id'                        => $datas->lead_source_id,
            'terms_and_conditions'                  => $datas->terms_and_conditions,
            'status'                                => $datas->status,
            'priority'                              => $datas->priority,
            'po_number'                             => $datas->po_number,
            'terms_of_use'                          => $datas->terms_of_use,
            'instructions'                          => $datas->instructions,
            'header'                                => $datas->header,

            //signature
            'company_representative_signature'      => $datas->company_representative_signature,
            'company_representative_name'           => $datas->company_representative_name,
            'primary_account_holder_signature'      => $datas->primary_account_holder_signature,
            'primary_account_holder_name'           => $datas->primary_account_holder_name,
            'secondary_account_holder_signature'    => $datas->secondary_account_holder_signature,
            'secondary_account_holder_name'         => $datas->secondary_account_holder_name,

            // 'company_representative_signature' => 'company_representative_signature',
            // 'company_representative_name' => 'company_representative_name',
            // 'primary_account_holder_signature' => 'primary_account_holder_signature',
            // 'primary_account_holder_name' => 'primary_account_holder_name',
            // 'secondary_account_holder_signature' => 'secondary_account_holder_signature',
            // 'secondary_account_holder_name' => 'secondary_account_holder_name',
            

            //attachment
            // 'attached_photo' => $this->input->post('attached_photo'),
            // 'document_links' => $this->input->post('document_links'),
            'attached_photo'                        => 'attached_photo',
            'document_links'                        => 'document_links',

            // 'subtotal'                              => $datas->password,
            // 'taxes'                                 => $datas->password,
            // 'adjustment_name'                       => $datas->password,
            // 'adjustment_value'                      => $this->input->post('adjustment_value'),
            // 'voucher_value'                         => $this->input->post('voucher_value'),
            // 'grand_total'                           => $this->input->post('grand_total'),

            'employee_id'                           => $user_id,
            'is_template'                           => $datas->is_template,
            'company_id'                            => $company_id,
            'date_created'                          => date("Y-m-d H:i:s"),
            'date_updated'                          => date("Y-m-d H:i:s"),
            'work_order_type_id'                    => $datas->work_order_type_id,
        );

        $addQuery = $this->workorder_model->save_workorder($new_data);

        // if($datas->is_template == 2)
        // {
        //     $payment_data = array(
        //                 'payment_method' => $this->input->post('payment_method'),
        //                 'amount' => $this->input->post('payment_amount'),
        //             );
        
        //     $pay = $this->workorder_model->save_payment($payment_data);
        // }
    }

    public function UpdateWorkorder(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $id = $this->input->post('wo_id');
        $wo_id = $this->input->post('workorder_number');

        if(!empty($this->input->post('company_representative_approval_signature1aM_web')))
        {
            $rand1  = rand(10,10000000);
            $datasig            = $this->input->post('company_representative_approval_signature1aM_web');
            $folderPath         = "./uploads/Signatures/1/";
            $image_parts        = explode(";base64,", $datasig);
            $image_type_aux     = explode("image/", $image_parts[0]);
            $image_type         = $image_type_aux[1];
            $image_base64       = base64_decode($image_parts[1]);
            $file               = $folderPath. $rand1 . $wo_id . '_company' . '.'.$image_type;
            $file_save          = '../../uploads/Signatures/1/'. $rand1 . $wo_id . '_company' . '.'.$image_type;
            file_put_contents($file, $image_base64);
        }
        else{
            $one = $this->workorder_model->getById($id);
            $file_save = $one->company_representative_signature;
        }

        if(!empty($this->input->post('primary_representative_approval_signature1aM_web')))
        {
            $rand2  = rand(10,10000000);
            $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
            $folderPath2        = "./uploads/Signatures/1/";
            $image_parts2       = explode(";base64,", $datasig2);
            $image_type_aux2    = explode("image/", $image_parts2[0]);
            $image_type2        = $image_type_aux2[1];
            $image_base642      = base64_decode($image_parts2[1]);
            $file2              = $folderPath2. $rand2 . $wo_id . '_primary' . '.'.$image_type2;
            $file2_save         = '../../uploads/Signatures/1/'. $rand2 . $wo_id . '_primary' . '.'.$image_type2;
            file_put_contents($file2, $image_base642);
        }
        else{
            $two = $this->workorder_model->getById($id);
            $file2_save = $two->primary_account_holder_signature;
        }

        if(!empty($this->input->post('secondary_representative_approval_signature1aM_web')))
        {
            $rand3  = rand(10,10000000);
            $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
            $folderPath3        = "./uploads/Signatures/1/";
            $image_parts3       = explode(";base64,", $datasig3);
            $image_type_aux3    = explode("image/", $image_parts3[0]);
            $image_type3        = $image_type_aux3[1];
            $image_base643      = base64_decode($image_parts3[1]);
            $file3              = $folderPath3. $rand3 . $wo_id . '_secondary' . '.'.$image_type3;
            $file3_save         = '../../uploads/Signatures/1/'. $rand3 . $wo_id . '_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else{
            $three = $this->workorder_model->getById($id);
            $file3_save = $three->secondary_account_holder_signature;
        }
        

        $update_data = array(
            'id'                    => $this->input->post('wo_id'),
            'work_order_number'     => $this->input->post('workorder_number'),
            'customer_id'           => $this->input->post('customer_id'),
            'security_number'       => $this->input->post('security_number'),
            'birthdate'             => $this->input->post('birthdate'),
            'phone_number'          => $this->input->post('phone_number'),
            'mobile_number'         => $this->input->post('mobile_number'),
            'email'                 => $this->input->post('email'),
            'job_location'          => $this->input->post('job_location'),
            'city'                  => $this->input->post('city'),
            'state'                 => $this->input->post('state'),
            'zip_code'              => $this->input->post('zip_code'),
            'cross_street'          => $this->input->post('cross_street'),
            'password'              => $this->input->post('password'),
            'offer_code'            => $this->input->post('offer_code'),//
            'tags'                  => $this->input->post('job_tag'),
            'date_issued'           => $this->input->post('schedule_date_given'),
            'job_type'              => $this->input->post('job_type'),
            'job_name'              => $this->input->post('job_name'),
            'job_description'       => $this->input->post('job_description'),
            'payment_method'        => $this->input->post('payment_method'),
            'payment_amount'        => $this->input->post('payment_amount'),
            'terms_and_conditions'  => $this->input->post('terms_conditions'),
            'status'                => $this->input->post('status'),
            'priority'              => $this->input->post('priority'),
            'po_number'             => $this->input->post('purchase_order_number'),
            'terms_of_use'          => $this->input->post('terms_of_use'),
            'instructions'          => $this->input->post('instructions'),
            'header'                => $this->input->post('header'),
            'lead_source_id'        => $this->input->post('lead_source'),

            //signature
            // 'company_representative_signature' => $this->input->post('company_representative_signature'),
            // 'company_representative_name' => $this->input->post('company_representative_name'),
            // 'primary_account_holder_signature' => $this->input->post('primary_account_holder_signature'),
            // 'primary_account_holder_name' => $this->input->post('primary_account_holder_name'),
            // 'secondary_account_holder_signature' => $this->input->post('secondary_account_holder_signature'),
            // 'secondary_account_holder_name' => $this->input->post('secondary_account_holder_name'),

            'company_representative_signature'      => $file_save,
            'company_representative_name'           => $this->input->post('company_representative_printed_name'),
            'primary_account_holder_signature'      => $file2_save,
            'primary_account_holder_name'           => $this->input->post('primary_account_holder_name'),
            'secondary_account_holder_signature'    => $file3_save,
            'secondary_account_holder_name'         => $this->input->post('secondery_account_holder_name'),
            

            //attachment
            // 'attached_photo' => $this->input->post('attached_photo'),
            // 'document_links' => $this->input->post('document_links'),
            'attached_photo'        => 'attached_photo',
            'document_links'        => 'document_links',

            'subtotal'              => $this->input->post('subtotal'),
            'taxes'                 => $this->input->post('taxes'), 
            'adjustment_name'       => $this->input->post('adjustment_name'),
            'adjustment_value'      => $this->input->post('adjustment_value'),
            'voucher_value'         => $this->input->post('voucher_value'),
            'grand_total'           => $this->input->post('grand_total'),

            // 'employee_id' => $user_id,
            // 'company_id' => $company_id,
            // 'date_created' => date("Y-m-d H:i:s"),
            'date_updated'          => date("Y-m-d H:i:s"),
            // 'work_order_type_id' => '1'
        );

        $addQuery = $this->workorder_model->update_workorder($update_data);
        

        if($this->input->post('payment_method') == 'Cash'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'is_collected'      => '1',
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_cash($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Check'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'check_number'      => $this->input->post('check_number'),
                'routing_number'    => $this->input->post('routing_number'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_check($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Credit Card'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'credit_number'     => $this->input->post('credit_number'),
                'credit_expiry'     => $this->input->post('credit_expiry'),
                'credit_cvc'        => $this->input->post('credit_cvc'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_creditCard($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Debit Card'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'credit_number'     => $this->input->post('debit_credit_number'),
                'credit_expiry'     => $this->input->post('debit_credit_expiry'),
                'credit_cvc'        => $this->input->post('debit_credit_cvc'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_debitCard($payment_data);
        }
        elseif($this->input->post('payment_method') == 'ACH'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'routing_number'    => $this->input->post('ach_routing_number'),
                'account_number'    => $this->input->post('ach_account_number'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_ACH($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Venmo'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('account_credentials'),
                'account_note'          => $this->input->post('account_note'),
                'confirmation'          => $this->input->post('confirmation'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Venmo($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Paypal'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('paypal_account_credentials'),
                'account_note'          => $this->input->post('paypal_account_note'),
                'confirmation'          => $this->input->post('paypal_confirmation'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Paypal($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Square'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('square_account_credentials'),
                'account_note'          => $this->input->post('square_account_note'),
                'confirmation'          => $this->input->post('square_confirmation'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Square($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Warranty Work'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('warranty_account_credentials'),
                'account_note'          => $this->input->post('warranty_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Warranty($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Home Owner Financing'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('home_account_credentials'),
                'account_note'          => $this->input->post('home_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Home($payment_data);
        }
        elseif($this->input->post('payment_method') == 'e-Transfer'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('e_account_credentials'),
                'account_note'          => $this->input->post('e_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Transfer($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Credit Card Professor'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'credit_number'         => $this->input->post('other_credit_number'),
                'credit_expiry'         => $this->input->post('other_credit_expiry'),
                'credit_cvc'            => $this->input->post('other_credit_cvc'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Professor($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Payment Type'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('other_payment_account_credentials'),
                'account_note'          => $this->input->post('other_payment_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Other($payment_data);
        }
        
        
        // $custom_data = array(
            
        //     'custom1_field' => $this->input->post('custom1_field'),
        //     'custom1_value' => $this->input->post('custom1_value'),
        //     'custom2_field' => $this->input->post('custom2_field'),
        //     'custom2_value' => $this->input->post('custom2_value'),
        //     'custom3_field' => $this->input->post('custom3_field'),
        //     'custom3_value' => $this->input->post('custom3_value'),
        //     'custom4_field' => $this->input->post('custom4_field'),
        //     'custom4_value' => $this->input->post('custom4_value'),
        //     'custom5_field' => $this->input->post('custom5_field'),
        //     'custom5_value' => $this->input->post('custom5_value'),
        //     'workorder_id' => $addQuery,
        // );

        // $custom_dataQuery = $this->workorder_model->save_custom_fields($custom_data);

        $delete = $this->workorder_model->delete_custom_fields($id);

        $name = $this->input->post('custom_field');
        $value = $this->input->post('custom_value');

        $c = 0;
            foreach($name as $row2){
                $dataa['name'] = $name[$c];
                $dataa['value'] = $value[$c];
                $dataa['work_order_id'] = $id;
                $dataa['company_id'] = $company_id;
                $dataa['date_added'] = date("Y-m-d H:i:s");
                $addQuery2a = $this->workorder_model->additem_details($dataa);
                $c++;
            }


        $delete2 = $this->workorder_model->delete_items($id);


        // if($addQuery > 0){
            // $a = $this->input->post('items');
            // $b = $this->input->post('item_type');
            // $d = $this->input->post('quantity');
            // $f = $this->input->post('price');
            // $g = $this->input->post('discount');
            // $h = $this->input->post('tax');
            // $ii = $this->input->post('total');

            // $i = 0;
            // foreach($a as $row){
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     $data['qty'] = $d[$i];
            //     $data['cost'] = $f[$i];
            //     $data['discount'] = $g[$i];
            //     $data['tax'] = $h[$i];
            //     $data['total'] = $ii[$i];
            //     $data['type'] = 'Work Order';
            //     $data['type_id'] = $id;
            //     // $data['status'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;
            // }
            // if($addQuery > 0){
                $a          = $this->input->post('itemid');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $h          = $this->input->post('tax');
    
                $i = 0;
                foreach($a as $row){
                    $data['items_id'] = $a[$i];
                    $data['qty'] = $quantity[$i];
                    $data['cost'] = $price[$i];
                    $data['tax'] = $h[$i];
                    $data['work_order_id '] = $id;
                    $addQuery2 = $this->workorder_model->add_work_order_details($data);
                    $i++;
                }
    
            //    redirect('workorder');
            // }

        //    redirect('workorder');
        // }
        // else{
        //     echo json_encode(0);
        // }

        redirect('workorder');
    }

    public function UpdateWorkorderAlarm(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $id = $this->input->post('wo_id_alarm');
        $wo_id = $this->input->post('wo_id_alarm');

        // var_dump($id);
        
        if(!empty($this->input->post('company_representative_approval_signature1aM_web')))
        {
            $rand1  = rand(10,10000000);
            $datasig            = $this->input->post('company_representative_approval_signature1aM_web');
            $folderPath         = "./uploads/Signatures/1/";
            $image_parts        = explode(";base64,", $datasig);
            $image_type_aux     = explode("image/", $image_parts[0]);
            $image_type         = $image_type_aux[1];
            $image_base64       = base64_decode($image_parts[1]);
            $file               = $folderPath. $rand1 . $wo_id . '_alarm_company' . '.'.$image_type;
            $file_save          = '../../uploads/Signatures/1/'. $rand1 . $wo_id . '_alarm_company' . '.'.$image_type;
            file_put_contents($file, $image_base64);
        }
        else{
            $one = $this->workorder_model->getById($id);
            $file_save = $one->company_representative_signature;
        }

        if(!empty($this->input->post('primary_representative_approval_signature1aM_web')))
        {
            $rand2  = rand(10,10000000);
            $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
            $folderPath2        = "./uploads/Signatures/1/";
            $image_parts2       = explode(";base64,", $datasig2);
            $image_type_aux2    = explode("image/", $image_parts2[0]);
            $image_type2        = $image_type_aux2[1];
            $image_base642      = base64_decode($image_parts2[1]);
            $file2              = $folderPath2. $rand2 . $wo_id . '_alarm_primary' . '.'.$image_type2;
            $file2_save         = '../../uploads/Signatures/1/'. $rand2 . $wo_id . '_alarm_primary' . '.'.$image_type2;
            file_put_contents($file2, $image_base642);
        }
        else{
            $two = $this->workorder_model->getById($id);
            $file2_save = $two->primary_account_holder_signature;
        }

        if(!empty($this->input->post('secondary_representative_approval_signature1aM_web')))
        {
            $rand3  = rand(10,10000000);
            $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
            $folderPath3        = "./uploads/Signatures/1/";
            $image_parts3       = explode(";base64,", $datasig3);
            $image_type_aux3    = explode("image/", $image_parts3[0]);
            $image_type3        = $image_type_aux3[1];
            $image_base643      = base64_decode($image_parts3[1]);
            $file3              = $folderPath3. $rand3 . $wo_id . '_alarm_secondary' . '.'.$image_type3;
            $file3_save         = '../../uploads/Signatures/1/'. $rand3 . $wo_id . '_alarm_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else{
            $three = $this->workorder_model->getById($id);
            $file3_save = $three->secondary_account_holder_signature;
        }

        $acs = array(
            'prof_id'                   => $this->input->post('acs_id'),
            'customer_type'             => $this->input->post('customer_type'),
            'business_name'             => $this->input->post('business_name'), //new
            'install_type'              => $this->input->post('install_type'),
            'last_name'                 => $this->input->post('last_name'),
            'first_name'                => $this->input->post('first_name'),
            'phone_h'                   => $this->input->post('phone_number'),
            'phone_m'                   => $this->input->post('mobile_number'), //new
            'date_of_birth'             => $this->input->post('dob'), //new
            'ssn'                       => $this->input->post('security_number'), //new
            's_last_name'               => $this->input->post('s_last_name'),
            'email'                     => $this->input->post('email'),
            's_first_name'              => $this->input->post('s_first_name'),
            's_mobile'                  => $this->input->post('s_mobile'),
            's_dob'                     => $this->input->post('s_dob'),
            's_ssn'                     => $this->input->post('s_ssn'),
            'notification_type'         => $this->input->post('notification_type'),
            'first_verification_name'   => $this->input->post('1st_verification_name'),
            'first_number'              => $this->input->post('1st_number'),
            'first_number_type'         => $this->input->post('1st_number_type'),
            'first_relation'            => $this->input->post('1st_relation'),
            'second_verification_name'  => $this->input->post('2nd_verification_name'),
            'second_number'             => $this->input->post('2nd_number'),
            'second_number_type'        => $this->input->post('2nd_number_type'),
            'second_relation'           => $this->input->post('2nd_relation'),
            'third_verification_name'   => $this->input->post('3rd_verification_name'),
            'third_number'              => $this->input->post('3rd_number'),
            'third_number_type'         => $this->input->post('3rd_number_type'),
            'third_relation'            => $this->input->post('3rd_relation'),
            'fourth_verification_name'  => $this->input->post('4th_verification_name'),
            'fourth_number'             => $this->input->post('4th_number'),
            'fourth_number_type'        => $this->input->post('4th_number_type'),
            'fourth_relation'           => $this->input->post('4th_relation'),

            'mail_add'                  => $this->input->post('monitored_location'), //new
            'city'                      => $this->input->post('city'), //new
            'state'                     => $this->input->post('state'), //new
            'zip_code'                  => $this->input->post('zip_code'), //new
            'cross_street'              => $this->input->post('cross_street'), //new
            // 'plan_type'                 => $this->input->post('plan_type'),
            // 'account_type'              => $this->input->post('account_type'),
            // 'panel_type'                => $this->input->post('panel_type'),
            // 'panel_location'            => $this->input->post('panel_location'),
            // 'panel_communication'       => $this->input->post('panel_communication'),
            // 'job_requested_date'        => $this->input->post('date_issued'),
            // 'initials'                  => $this->input->post('initials'),
            // 'work_order_id'             => $addQuery
            // 'company_id'                => $company_id,
        );

        $w_acs = $this->workorder_model->update_acs_alarm($acs);

        

        $update_data = array(
            'id'                    => $this->input->post('wo_id_alarm'),
            // 'work_order_number'     => $this->input->post('workorder_number'),
            // 'customer_id'           => $this->input->post('customer_id'),
            'security_number'       => $this->input->post('security_number'),
            'birthdate'             => $this->input->post('dob'),
            'phone_number'          => $this->input->post('phone_number'),
            'mobile_number'         => $this->input->post('mobile_number'),
            'email'                 => $this->input->post('email'),
            'job_location'          => $this->input->post('monitored_location'),
            'city'                  => $this->input->post('city'),
            'state'                 => $this->input->post('state'),
            'zip_code'              => $this->input->post('zip_code'),
            'cross_street'          => $this->input->post('cross_street'),
            'password'              => $this->input->post('password'),
            // 'offer_code'            => $this->input->post('offer_code'),
            'tags'                  => $this->input->post('job_tag'),
            'date_issued'           => $this->input->post('schedule_date_given'),
            'job_type'              => $this->input->post('job_type'),
            // 'job_name'              => $this->input->post('job_name'),
            // 'job_description'       => $this->input->post('job_description'),
            'payment_method'        => $this->input->post('payment_method'),
            'payment_amount'        => $this->input->post('payment_amount'),
            'terms_and_conditions'  => $this->input->post('terms_conditions'),
            'status'                => $this->input->post('status'),
            'priority'              => $this->input->post('priority'),
            // 'purchase_order_number' => $this->input->post('purchase_order_number'),
            'terms_of_use'          => $this->input->post('terms_of_use'),
            // 'instructions'          => $this->input->post('instructions'),
            'header'                => $this->input->post('header'),
            'lead_source_id'        => $this->input->post('lead_source'),

            //signature
            // 'company_representative_signature' => $this->input->post('company_representative_signature'),
            // 'company_representative_name' => $this->input->post('company_representative_name'),
            // 'primary_account_holder_signature' => $this->input->post('primary_account_holder_signature'),
            // 'primary_account_holder_name' => $this->input->post('primary_account_holder_name'),
            // 'secondary_account_holder_signature' => $this->input->post('secondary_account_holder_signature'),
            // 'secondary_account_holder_name' => $this->input->post('secondary_account_holder_name'),

            'company_representative_signature'      => $file_save,
            'company_representative_name'           => $this->input->post('company_representative_printed_name'),
            'primary_account_holder_signature'      => $file2_save,
            'primary_account_holder_name'           => $this->input->post('primary_account_holder_name'),
            'secondary_account_holder_signature'    => $file3_save,
            'secondary_account_holder_name'         => $this->input->post('secondery_account_holder_name'),
            

            //attachment
            // 'attached_photo' => $this->input->post('attached_photo'),
            // 'document_links' => $this->input->post('document_links'),
            'attached_photo'        => 'attached_photo',
            'document_links'        => 'document_links',

            'subtotal'              => $this->input->post('subtotal'),
            'taxes'                 => $this->input->post('taxes'), 
            'otp_setup'             => $this->input->post('otp_setup'),
            'monthly_monitoring'    => $this->input->post('monthly_monitoring'),
            // 'adjustment_name'       => $this->input->post('adjustment_name'),
            // 'adjustment_value'      => $this->input->post('adjustment_value'),
            // 'voucher_value'         => $this->input->post('voucher_value'),
            'grand_total'           => $this->input->post('grand_total'),

            'initials'              => $this->input->post('initials'),
            'plan_type'             => $this->input->post('plan_type'),
            'account_type'          => $this->input->post('account_type'),
            'panel_type'            => $this->input->post('panel_type'),
            'panel_location'        => $this->input->post('panel_location'),
            'panel_communication'   => $this->input->post('panel_communication'),
            
            'billing_date'                  => $this->input->post('billing_date'),
            'billing_frequency'             => $this->input->post('billing_frequency'),

            // 'employee_id' => $user_id,
            // 'company_id' => $company_id,
            // 'date_created' => date("Y-m-d H:i:s"),
            'date_updated'          => date("Y-m-d H:i:s"),
            // 'work_order_type_id' => '1'
        );

        $addQuery = $this->workorder_model->update_workorder_alarm($update_data);

        $cameras = array(
            'work_order_id'         => $this->input->post('wo_id_alarm'),
            'honeywell_wo'          => $this->input->post('honeywell_wo'),
            'honeywell_wi'          => $this->input->post('honeywell_wi'),
            'honeywell_doorbellcam' => $this->input->post('honeywell_doorbellcam'),
            'alarm_wo'              => $this->input->post('alarm_wo'),
            'alarm_wi'              => $this->input->post('alarm_wi'),
            'alarm_doorbellcam'     => $this->input->post('alarm_doorbellcam'),
            'other_wo'              => $this->input->post('other_wo'),
            'other_wi'              => $this->input->post('other_wi'),
            'other_doorbellcam'     => $this->input->post('other_doorbellcam'),
        );

        $enhanced_services_cameras = $this->workorder_model->update_cameras($cameras);

        $doorlocks = array(
            'work_order_id'         => $this->input->post('wo_id_alarm'),
            'deadbolt_brass'        => $this->input->post('deadbolt_brass'),
            'deadbolt_nickel'       => $this->input->post('deadbolt_nickel'),
            'deadbolt_bronze'       => $this->input->post('deadbolt_bronze'),
            'handle_brass'          => $this->input->post('handle_brass'),
            'handle_nickel'         => $this->input->post('handle_nickel'),
            'handle_bonze'          => $this->input->post('handle_bonze'),
        );

        $enhanced_services_doorlocks = $this->workorder_model->update_doorlocks($doorlocks);

        $dvr = array(
            'work_order_id'         => $this->input->post('wo_id_alarm'),
            'honeywell_4ch'         => $this->input->post('honeywell_4ch'),
            'honeywell_8ch'         => $this->input->post('honeywell_8ch'),
            'honeywell_16ch'        => $this->input->post('honeywell_16ch'),
            'alarm_4ch'             => $this->input->post('alarm_4ch'),
            'alarm_8ch'             => $this->input->post('alarm_8ch'),
            'alarm_16ch'            => $this->input->post('alarm_16ch'),
            'other_4ch'             => $this->input->post('other_4ch'),
            'other_8ch'             => $this->input->post('other_8ch'),
            'other_16ch'            => $this->input->post('other_16ch'),
        );

        $enhanced_services_dvr = $this->workorder_model->update_dvr($dvr);

        // $automation = array(
            
        //     'thermostats'           => $this->input->post('thermostats'),
        //     'lights_and_bulbs'      => $this->input->post('lights_and_bulbs'),
        //     'work_order_id'         => $addQuery,
        // );

        // if($addQuery > 0){
        //     $a = $this->input->post('items');
        //     $b = $this->input->post('item_type');
        //     $d = $this->input->post('quantity');
        //     $f = $this->input->post('price');
        //     $g = $this->input->post('discount');
        //     $h = $this->input->post('tax');
        //     $ii = $this->input->post('total');

        //     $i = 0;
        //     foreach($a as $row){
        //         $data['item'] = $a[$i];
        //         $data['item_type'] = $b[$i];
        //         $data['qty'] = $d[$i];
        //         $data['cost'] = $f[$i];
        //         $data['discount'] = $g[$i];
        //         $data['tax'] = $h[$i];
        //         $data['total'] = $ii[$i];
        //         $data['type'] = 'Work Order Alarm';
        //         $data['type_id'] = $addQuery;
        //         // $data['status'] = '1';
        //         $data['created_at'] = date("Y-m-d H:i:s");
        //         $data['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //         $i++;
        //     }

        //    redirect('workorder');
        // }

        //     $autoa = $this->input->post('thermostats');
        //     $autob = $this->input->post('lights_and_bulbs');

        //     $auto = 0;
        //     foreach($autoa as $row2){
        //         $dataa['thermostats'] = $autoa[$auto];
        //         $dataa['lights_and_bulbs'] = $autob[$auto];
        //         $dataa['work_order_id'] = $addQuery;
        //         $enhanced_services_automation = $this->workorder_model->save_automation($dataa);
        //         $auto++;
        //     }


        $pers = array(
            'work_order_id'         => $this->input->post('wo_id_alarm'),
            'fall_detection'        => $this->input->post('fall_detection'),
            'w_o_fall_protection'   => $this->input->post('w_o_fall_protection'),
        );

        $enhanced_services_pers = $this->workorder_model->update_pers($pers);
        

        if($this->input->post('payment_method') == 'Cash'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'is_collected'      => '1',
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_cash($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Check'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'check_number'      => $this->input->post('check_number'),
                'routing_number'    => $this->input->post('routing_number'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_check($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Credit Card'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'credit_number'     => $this->input->post('credit_number'),
                'credit_expiry'     => $this->input->post('credit_expiry'),
                'credit_cvc'        => $this->input->post('credit_cvc'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_creditCard($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Debit Card'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'credit_number'     => $this->input->post('debit_credit_number'),
                'credit_expiry'     => $this->input->post('debit_credit_expiry'),
                'credit_cvc'        => $this->input->post('debit_credit_cvc'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_debitCard($payment_data);
        }
        elseif($this->input->post('payment_method') == 'ACH'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'routing_number'    => $this->input->post('ach_routing_number'),
                'account_number'    => $this->input->post('ach_account_number'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_ACH($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Venmo'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('account_credentials'),
                'account_note'          => $this->input->post('account_note'),
                'confirmation'          => $this->input->post('confirmation'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Venmo($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Paypal'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('paypal_account_credentials'),
                'account_note'          => $this->input->post('paypal_account_note'),
                'confirmation'          => $this->input->post('paypal_confirmation'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Paypal($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Square'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('square_account_credentials'),
                'account_note'          => $this->input->post('square_account_note'),
                'confirmation'          => $this->input->post('square_confirmation'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Square($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Warranty Work'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('warranty_account_credentials'),
                'account_note'          => $this->input->post('warranty_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Warranty($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Home Owner Financing'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('home_account_credentials'),
                'account_note'          => $this->input->post('home_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Home($payment_data);
        }
        elseif($this->input->post('payment_method') == 'e-Transfer'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('e_account_credentials'),
                'account_note'          => $this->input->post('e_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Transfer($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Credit Card Professor'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'credit_number'         => $this->input->post('other_credit_number'),
                'credit_expiry'         => $this->input->post('other_credit_expiry'),
                'credit_cvc'            => $this->input->post('other_credit_cvc'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Professor($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Payment Type'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('other_payment_account_credentials'),
                'account_note'          => $this->input->post('other_payment_account_note'),
                'work_order_id'         => $id,
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_Other($payment_data);
        }
        
        
        // $custom_data = array(
            
        //     'custom1_field' => $this->input->post('custom1_field'),
        //     'custom1_value' => $this->input->post('custom1_value'),
        //     'custom2_field' => $this->input->post('custom2_field'),
        //     'custom2_value' => $this->input->post('custom2_value'),
        //     'custom3_field' => $this->input->post('custom3_field'),
        //     'custom3_value' => $this->input->post('custom3_value'),
        //     'custom4_field' => $this->input->post('custom4_field'),
        //     'custom4_value' => $this->input->post('custom4_value'),
        //     'custom5_field' => $this->input->post('custom5_field'),
        //     'custom5_value' => $this->input->post('custom5_value'),
        //     'workorder_id' => $addQuery,
        // );

        // $custom_dataQuery = $this->workorder_model->save_custom_fields($custom_data);

        // $delete = $this->workorder_model->delete_custom_fields($id);

        // $name = $this->input->post('custom_field');
        // $value = $this->input->post('custom_value');

        // $c = 0;
        //     foreach($name as $row2){
        //         $dataa['name'] = $name[$c];
        //         $dataa['value'] = $value[$c];
        //         $dataa['work_order_id'] = $id;
        //         $dataa['company_id'] = $company_id;
        //         $dataa['date_added'] = date("Y-m-d H:i:s");
        //         $addQuery2a = $this->workorder_model->additem_details($dataa);
        //         $c++;
        //     }


        $delete2 = $this->workorder_model->delete_items_alarm($id);


        // if($delete2 > 0){
            // $a = $this->input->post('items');
            // $b = $this->input->post('item_type');
            // $d = $this->input->post('quantity');
            // $f = $this->input->post('price');
            // $g = $this->input->post('discount');
            // $h = $this->input->post('tax');
            // $ii = $this->input->post('total');

            // $i = 0;
            // foreach($a as $row){
            //     $data['item'] = $a[$i];
            //     $data['item_type'] = $b[$i];
            //     $data['qty'] = $d[$i];
            //     $data['cost'] = $f[$i];
            //     $data['discount'] = $g[$i];
            //     $data['tax'] = $h[$i];
            //     $data['total'] = $ii[$i];
            //     $data['type'] = 'Work Order Alarm';
            //     $data['type_id'] = $id;
            //     // $data['status'] = '1';
            //     $data['created_at'] = date("Y-m-d H:i:s");
            //     $data['updated_at'] = date("Y-m-d H:i:s");
            //     $addQuery2 = $this->accounting_invoices_model->additem_details($data);
            //     $i++;
            // }

            $a = $this->input->post('itemid');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');

            $i = 0;
            foreach($a as $row){
                $data['items_id '] = $a[$i];
                $data['work_order_id '] = $id;
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $addQuery2 = $this->workorder_model->add_work_order_details($data);
                $i++;
            }

        //    redirect('workorder');
        // }
        // else{
        //     echo json_encode(0);
        // }

        redirect('workorder');
    }

    public function delete_workorder()
    {
        $id = $this->input->post('id');

        $data = array(
            'id' => $id,
            'view_flag' => '1',
        );

        $delete = $this->workorder_model->deleteWorkorder($data);

        echo json_encode($delete);
    }

    public function work_order_templates()
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Templates";
        $this->page_data['company_work_order_used'] = $this->workorder_model->getcompany_work_order_used($company_id);
        
        $this->load->view('workorder/work_order_templates', $this->page_data);
    }

    public function changeTemplate()
    {
        $company_id = logged('company_id');
        $user_id = logged('id');

        $template_id  =  $this->input->post('template');

        $check = $this->workorder_model->checktemplateId($company_id);

        if(empty($check))
        {
            $data = array(
                'work_order_template_id' => $template_id,
                'company_id' => $company_id,
            );
            $dataQuery = $this->workorder_model->addTemplate($data);

        }else{
            $data2 = array(
                'work_order_template_id' => $template_id,
                'company_id' => $company_id,
            );
            $dataQuery = $this->workorder_model->updateTemplate($data2);

        }


        echo json_encode($dataQuery);
    }

    public function NewworkOrderAlarm()
    {
        // $company_id = logged('company_id');
        // $user_id = logged('id');
        $this->load->model('AcsProfile_model');
        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if(count( $result_autoincrement )) {
            if($result_autoincrement[0]['AUTO_INCREMENT'])
            {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {

                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');

        $company_id = logged('company_id');

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Alarm Templates";

        $this->load->library('session');

        $users_data = $this->session->all_userdata();
        // foreach($users_data as $usersD){
        //     $userID = $usersD->id;
            
        // }

        // print_r($user_id);
        // $users = $this->users_model->getUserByID($user_id);
        // print_r($users);
        // echo $company_id;

        $role = logged('role');
        if( $role == 1 || $role == 2){
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }else{
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);
        $this->page_data['ids'] = $this->workorder_model->getlastInsertID();

        $termsCondi = $this->workorder_model->getTerms($company_id);
        if($termsCondi){
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        }else{
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if($termsUse){
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        }else{
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }

        // print_r($this->page_data['terms_conditions']);
        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();

        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        
        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);
        
        $this->load->view('workorder/NewworkOrderAlarm', $this->page_data);
    }

    public function savenewWorkorderAlarm()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = logged('id');

        // $data = $this->input->post('output-1');
        $wo_id = $this->input->post('wo_id');

        $datasig            = $this->input->post('company_representative_approval_signature1aM_web');
        $folderPath         = "./uploads/Signatures/1/";
        $image_parts        = explode(";base64,", $datasig);
        $image_type_aux     = explode("image/", $image_parts[0]);
        $image_type         = $image_type_aux[1];
        $image_base64       = base64_decode($image_parts[1]);
        $file               = $folderPath . $wo_id . '_alarm_company' . '.'.$image_type;
        $file_save          = '../../uploads/Signatures/1/' . $wo_id . '_alarm_company' . '.'.$image_type;
        file_put_contents($file, $image_base64);

        $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
        $folderPath2        = "./uploads/Signatures/1/";
        $image_parts2       = explode(";base64,", $datasig2);
        $image_type_aux2    = explode("image/", $image_parts2[0]);
        $image_type2        = $image_type_aux2[1];
        $image_base642      = base64_decode($image_parts2[1]);
        $file2              = $folderPath2 . $wo_id . '_alarm_primary' . '.'.$image_type2;
        $file2_save         = '../../uploads/Signatures/1/' . $wo_id . '_alarm_primary' . '.'.$image_type2;
        file_put_contents($file2, $image_base642);

        $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
        $folderPath3        = "./uploads/Signatures/1/";
        $image_parts3       = explode(";base64,", $datasig3);
        $image_type_aux3    = explode("image/", $image_parts3[0]);
        $image_type3        = $image_type_aux3[1];
        $image_base643      = base64_decode($image_parts3[1]);
        $file3              = $folderPath3 . $wo_id . '_alarm_secondary' . '.'.$image_type3;
        $file3_save         = '../../uploads/Signatures/1/' . $wo_id . '_alarm_secondary' . '.'.$image_type3;
        file_put_contents($file3, $image_base643);

        ///////////////////////////////////////////////////////////////////////////////////////////
        // $datasig = $this->input->post('company_representative_approval_signature1aM_web');
        // $folderPath = "./uploads/Signatures/1/";
        // $image_parts = explode(";base64,", $datasig);
        // $image_type_aux = explode("image/", $image_parts[0]);
        // $image_type = $image_type_aux[1];
        // $image_base64 = base64_decode($image_parts[1]);
        // $file = $folderPath . $wo_id . '_company' . '.'.$image_type;
        // $file_save = '../../uploads/Signatures/1/' . $wo_id . '_company' . '.'.$image_type;
        // file_put_contents($file, $image_base64);
        //
        // $datasig2 = $this->input->post('primary_representative_approval_signature1aM_web');
        // $folderPath2 = "./uploads/Signatures/1/";
        // $image_parts2 = explode(";base64,", $datasig2);
        // $image_type_aux2 = explode("image/", $image_parts2[0]);
        // $image_type2 = $image_type_aux2[1];
        // $image_base642 = base64_decode($image_parts2[1]);
        // $file2 = $folderPath2 . $wo_id . '_primary' . '.'.$image_type2;
        // $file2_save = '../../uploads/Signatures/1/' . $wo_id . '_primary' . '.'.$image_type2;
        // file_put_contents($file2, $image_base642);
        //
        // $datasig3 = $this->input->post('secondary_representative_approval_signature1aM_web');
        // $folderPath3 = "./uploads/Signatures/1/";
        // $image_parts3 = explode(";base64,", $datasig3);
        // $image_type_aux3 = explode("image/", $image_parts3[0]);
        // $image_type3 = $image_type_aux3[1];
        // $image_base643 = base64_decode($image_parts3[1]);
        // $file3 = $folderPath3 . $wo_id . '_secondary' . '.'.$image_type3;
        // $file3_save = '../../uploads/Signatures/1/' . $wo_id . '_secondary' . '.'.$image_type3;
        // file_put_contents($file3, $image_base643);
        /////////////////////////////////////////////////////////////////////////////////////////////

    $action = $this->input->post('action');
    if($action == 'submit') {

        $acs = array(
            'fk_user_id'                => $user_id,
            'customer_type'             => $this->input->post('customer_type'),
            'business_name'             => $this->input->post('business_name'), //new
            'install_type'              => $this->input->post('install_type'),
            'last_name'                 => $this->input->post('last_name'),
            'first_name'                => $this->input->post('first_name'),
            'phone_m'                   => $this->input->post('mobile_number'), //new
            'date_of_birth'             => $this->input->post('dob'), //new
            'ssn'                       => $this->input->post('security_number'), //new
            's_last_name'               => $this->input->post('s_last_name'),
            's_first_name'              => $this->input->post('s_first_name'),
            's_mobile'                  => $this->input->post('s_mobile'),
            's_dob'                     => $this->input->post('s_dob'),
            's_ssn'                     => $this->input->post('s_ssn'),
            'notification_type'         => $this->input->post('notification_type'),
            // 'first_verification_name'   => $this->input->post('1st_verification_name'),
            // 'first_number'              => $this->input->post('1st_number'),
            // 'first_number_type'         => $this->input->post('1st_number_type'),
            // 'first_relation'            => $this->input->post('1st_relation'),
            // 'second_verification_name'  => $this->input->post('2nd_verification_name'),
            // 'second_number'             => $this->input->post('2nd_number'),
            // 'second_number_type'        => $this->input->post('2nd_number_type'),
            // 'second_relation'           => $this->input->post('2nd_relation'),
            // 'third_verification_name'   => $this->input->post('3rd_verification_name'),
            // 'third_number'              => $this->input->post('3rd_number'),
            // 'third_number_type'         => $this->input->post('3rd_number_type'),
            // 'third_relation'            => $this->input->post('3rd_relation'),
            // 'fourth_verification_name'  => $this->input->post('4th_verification_name'),
            // 'fourth_number'             => $this->input->post('4th_number'),
            // 'fourth_number_type'        => $this->input->post('4th_number_type'),
            // 'fourth_relation'           => $this->input->post('4th_relation'),

            'mail_add'                  => $this->input->post('monitored_location'), //new
            'city'                      => $this->input->post('city'), //new
            'state'                     => $this->input->post('state'), //new
            'zip_code'                  => $this->input->post('zip_code'), //new
            'cross_street'              => $this->input->post('cross_street'), //new
            // 'plan_type'                 => $this->input->post('plan_type'),
            // 'account_type'              => $this->input->post('account_type'),
            // 'panel_type'                => $this->input->post('panel_type'),
            // 'panel_location'            => $this->input->post('panel_location'),
            // 'panel_communication'       => $this->input->post('panel_communication'),
            // 'job_requested_date'        => $this->input->post('date_issued'),
            // 'initials'                  => $this->input->post('initials'),
            // 'work_order_id'             => $addQuery
            'company_id'                => $company_id,
        );

        $w_acs = $this->workorder_model->save_alarm($acs);

        // $contacts = array(
        //     'notification_type'         => $this->input->post('notification_type'),
        //     'first_verification_name'   => $this->input->post('1st_verification_name'),
        //     'first_number'              => $this->input->post('1st_number'),
        //     'first_number_type'         => $this->input->post('1st_number_type'),
        //     'first_relation'            => $this->input->post('1st_relation'),
        //     'second_verification_name'  => $this->input->post('2nd_verification_name'),
        //     'second_number'             => $this->input->post('2nd_number'),
        //     'second_number_type'        => $this->input->post('2nd_number_type'),
        //     'second_relation'           => $this->input->post('2nd_relation'),
        //     'third_verification_name'   => $this->input->post('3rd_verification_name'),
        //     'third_number'              => $this->input->post('3rd_number'),
        //     'third_number_type'         => $this->input->post('3rd_number_type'),
        //     'third_relation'            => $this->input->post('3rd_relation'),
        //     'fourth_verification_name'  => $this->input->post('4th_verification_name'),
        //     'fourth_number'             => $this->input->post('4th_number'),
        //     'fourth_number_type'        => $this->input->post('4th_number_type'),
        //     'fourth_relation'           => $this->input->post('4th_relation'),
        // );

            // $notification_type          = $this->input->post('notification_type');
            $first_verification_name    = $this->input->post('1st_verification_name');
            $first_number               = $this->input->post('1st_number');
            $first_number_type          = $this->input->post('1st_number_type');
            $first_relation             = $this->input->post('1st_relation');//
            $second_verification_name   = $this->input->post('2nd_verification_name');
            $second_number              = $this->input->post('2nd_number');
            $second_number_type         = $this->input->post('2nd_number_type');
            $second_relation            = $this->input->post('2nd_relation');//
            $third_verification_name    = $this->input->post('3rd_verification_name');
            $third_number               = $this->input->post('3rd_number');
            $third_number_type          = $this->input->post('3rd_number_type');
            $third_relation             = $this->input->post('3rd_relation');//
            $fourth_verification_name   = $this->input->post('4th_verification_name');
            $fourth_number              = $this->input->post('4th_number');
            $fourth_number_type         = $this->input->post('4th_number_type');
            $fourth_relation            = $this->input->post('4th_relation');

            if(!empty($first_verification_name)){
                $contact1 = array(
                    'name'                     => $first_verification_name,
                    'phone_type'               => $first_number,
                    'phone'                    => $first_number_type,
                    'relation'                 => $first_relation,
                    'customer_id'              => $w_acs,
                );

                $contact = $this->workorder_model->save_contact($contact1);
            }
            if(!empty($second_verification_name)){
                $contact2 = array(
                    'name'                     => $second_verification_name,
                    'phone_type'               => $second_number,
                    'phone'                    => $second_number_type,
                    'relation'                 => $second_relation,
                    'customer_id'              => $w_acs,
                );

                $contact = $this->workorder_model->save_contact($contact2);
            }
            if(!empty($third_verification_name)){
                $contact3 = array(
                    'name'                     => $third_verification_name,
                    'phone_type'               => $third_number,
                    'phone'                    => $third_number_type,
                    'relation'                 => $third_relation,
                    'customer_id'              => $w_acs,
                );

                $contact = $this->workorder_model->save_contact($contact3);
            }
            if(!empty($fourth_verification_name)){
                $contact4 = array(
                    'name'                     => $fourth_verification_name,
                    'phone_type'               => $fourth_number,
                    'phone'                    => $fourth_number_type,
                    'relation'                 => $fourth_relation,
                    'customer_id'              => $w_acs,
                );

                $contact = $this->workorder_model->save_contact($contact4);
            }
        

        $new_data = array(
            'work_order_number'                     => $this->input->post('workorder_number'),
            'customer_id'                           => $w_acs,
            'security_number'                       => $this->input->post('security_number'),
            'mobile_number'                         => $this->input->post('mobile_number'),
            'email'                                 => $this->input->post('email'),
            // 'employee_id' => '0',
            'job_location'                          => $this->input->post('monitored_location'),
            // 'job_location'                          => $this->input->post('monitored_location') .', ' .$this->input->post('city') .', '. $this->input->post('state') .', '. $this->input->post('zip_code') .', '. $this->input->post('cross_street'),
            'city'                                  => $this->input->post('city'),
            'state'                                 => $this->input->post('state'),
            'zip_code'                              => $this->input->post('zip_code'),
            'cross_street'                          => $this->input->post('cross_street'),
            'password'                              => $this->input->post('password'),
            'tags'                                  => $this->input->post('job_tag'),
            'job_type'                              => $this->input->post('job_type'),
            'payment_method'                        => $this->input->post('payment_method'),
            'payment_amount'                        => $this->input->post('payment_amount'),
            'terms_and_conditions'                  => $this->input->post('terms_conditions'),
            'status'                                => $this->input->post('status'),
            'priority'                              => $this->input->post('priority'),
            'terms_of_use'                          => $this->input->post('terms_of_use'),
            'header'                                => $this->input->post('header'),
            'date_issued'                           => $this->input->post('date_issued'),
            'plan_type'                             => $this->input->post('plan_type'),
            'lead_source_id'                        => $this->input->post('lead_source'),

             //signature
             'company_representative_signature'     => $file_save,
             'company_representative_name'          => $this->input->post('company_representative_printed_name'),
             'primary_account_holder_signature'     => $file2_save,
             'primary_account_holder_name'          => $this->input->post('primary_account_holder_name'),
             'secondary_account_holder_signature'   => $file3_save,
             'secondary_account_holder_name'        => $this->input->post('secondery_account_holder_name'),

            // 'company_representative_signature' => 'company_representative_signature',
            // 'company_representative_name' => 'company_representative_name',
            // 'primary_account_holder_signature' => 'primary_account_holder_signature',
            // 'primary_account_holder_name' => 'primary_account_holder_name',
            // 'secondary_account_holder_signature' => 'secondary_account_holder_signature',
            // 'secondary_account_holder_name' => 'secondary_account_holder_name',

            'account_type'              => $this->input->post('account_type'),
            'panel_type'                => $this->input->post('panel_type'),
            'panel_location'            => $this->input->post('panel_location'),
            'panel_communication'       => $this->input->post('panel_communication'),
            // 'job_requested_date'        => $this->input->post('date_issued'),
            'initials'                  => $this->input->post('initials'),

            'billing_date'                  => $this->input->post('billing_date'),
            'billing_frequency'             => $this->input->post('billing_frequency'),
            

            'subtotal'                              => $this->input->post('subtotal'),
            'taxes'                                 => $this->input->post('taxes'),
            'otp_setup'                             => $this->input->post('otp_setup'),
            'monthly_monitoring'                    => $this->input->post('monthly_monitoring'),
            'grand_total'                           => $this->input->post('grand_total_text'),

            'employee_id'                           => $user_id,
            'is_template'                           => '1',
            'company_id'                            => $company_id,
            'date_created'                          => date("Y-m-d H:i:s"),
            'date_updated'                          => date("Y-m-d H:i:s"),
            'work_order_type_id'                    => '2'
            
        );

        $addQuery = $this->workorder_model->save_workorder($new_data);

        

        $cameras = array(
            
            'honeywell_wo'          => $this->input->post('honeywell_wo'),
            'honeywell_wi'          => $this->input->post('honeywell_wi'),
            'honeywell_doorbellcam' => $this->input->post('honeywell_doorbellcam'),
            'alarm_wo'              => $this->input->post('alarm_wo'),
            'alarm_wi'              => $this->input->post('alarm_wi'),
            'alarm_doorbellcam'     => $this->input->post('alarm_doorbellcam'),
            'other_wo'              => $this->input->post('other_wo'),
            'other_wi'              => $this->input->post('other_wi'),
            'other_doorbellcam'     => $this->input->post('other_doorbellcam'),
            'work_order_id'         => $addQuery,
        );

        $enhanced_services_cameras = $this->workorder_model->save_cameras($cameras);

        $doorlocks = array(
            
            'deadbolt_brass'        => $this->input->post('deadbolt_brass'),
            'deadbolt_nickel'       => $this->input->post('deadbolt_nickel'),
            'deadbolt_bronze'       => $this->input->post('deadbolt_bronze'),
            'handle_brass'          => $this->input->post('handle_brass'),
            'handle_nickel'         => $this->input->post('handle_nickel'),
            'handle_bonze'          => $this->input->post('handle_bonze'),
            'work_order_id'         => $addQuery,
        );

        $enhanced_services_doorlocks = $this->workorder_model->save_doorlocks($doorlocks);

        $dvr = array(
            
            'honeywell_4ch'         => $this->input->post('honeywell_4ch'),
            'honeywell_8ch'         => $this->input->post('honeywell_8ch'),
            'honeywell_16ch'        => $this->input->post('honeywell_16ch'),
            'alarm_4ch'             => $this->input->post('alarm_4ch'),
            'alarm_8ch'             => $this->input->post('alarm_8ch'),
            'alarm_16ch'            => $this->input->post('alarm_16ch'),
            'other_4ch'             => $this->input->post('other_4ch'),
            'other_8ch'             => $this->input->post('other_8ch'),
            'other_16ch'            => $this->input->post('other_16ch'),
            'work_order_id'         => $addQuery,
        );

        $enhanced_services_dvr = $this->workorder_model->save_dvr($dvr);

        // $automation = array(
            
        //     'thermostats'           => $this->input->post('thermostats'),
        //     'lights_and_bulbs'      => $this->input->post('lights_and_bulbs'),
        //     'work_order_id'         => $addQuery,
        // );

        // if($addQuery > 0){
        //     $a = $this->input->post('items');
        //     $b = $this->input->post('item_type');
        //     $d = $this->input->post('quantity');
        //     $f = $this->input->post('price');
        //     $g = $this->input->post('discount');
        //     $h = $this->input->post('tax');
        //     $ii = $this->input->post('total');

        //     $i = 0;
        //     foreach($a as $row){
        //         $data['item'] = $a[$i];
        //         $data['item_type'] = $b[$i];
        //         $data['qty'] = $d[$i];
        //         $data['cost'] = $f[$i];
        //         $data['discount'] = $g[$i];
        //         $data['tax'] = $h[$i];
        //         $data['total'] = $ii[$i];
        //         $data['type'] = 'Work Order Alarm';
        //         $data['type_id'] = $addQuery;
        //         // $data['status'] = '1';
        //         $data['created_at'] = date("Y-m-d H:i:s");
        //         $data['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //         $i++;
        //     }

        //    redirect('workorder');
        // }

        // if($addQuery > 0){

            $autoa = $this->input->post('thermostats');
            $autob = $this->input->post('lights_and_bulbs');

            $auto = 0;
            foreach($autoa as $row2){
                $dataa['thermostats'] = $autoa[$auto];
                $dataa['lights_and_bulbs'] = $autob[$auto];
                $dataa['work_order_id'] = $addQuery;
                $enhanced_services_automation = $this->workorder_model->save_automation($dataa);
                $auto++;
            }
        // }

        // $enhanced_services_automation = $this->workorder_model->save_automation($automation);

        $pers = array(
            
            'fall_detection'        => $this->input->post('fall_detection'),
            'w_o_fall_protection'   => $this->input->post('w_o_fall_protection'),
            'work_order_id'         => $addQuery,
        );

        $enhanced_services_pers = $this->workorder_model->save_pers($pers);

        

        if($this->input->post('payment_method') == 'Cash'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'is_collected'          => '1',
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Check'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'check_number'          => $this->input->post('check_number'),
                'routing_number'        => $this->input->post('routing_number'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        //added apr 26, 2021
        elseif($this->input->post('payment_method') == 'Invoicing'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'mail_address'          => $this->input->post('mail_address'),
                'mail_locality'         => $this->input->post('mail_locality'),
                'mail_state'            => $this->input->post('mail_state'),
                'mail_postcode'         => $this->input->post('mail_postcode'),
                'mail_cross_street'     => $this->input->post('mail_cross_street'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        //end added
        elseif($this->input->post('payment_method') == 'Credit Card'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'credit_number'         => $this->input->post('credit_number'),
                'credit_expiry'         => $this->input->post('credit_expiry'),
                'credit_cvc'            => $this->input->post('credit_cvc'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Debit Card'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'credit_number'         => $this->input->post('debit_credit_number'),
                'credit_expiry'         => $this->input->post('debit_credit_expiry'),
                'credit_cvc'            => $this->input->post('debit_credit_cvc'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'ACH'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'routing_number'        => $this->input->post('ach_routing_number'),
                'account_number'        => $this->input->post('ach_account_number'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Venmo'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('account_credentials'),
                'account_note'          => $this->input->post('account_note'),
                'confirmation'          => $this->input->post('confirmation'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Paypal'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('paypal_account_credentials'),
                'account_note'          => $this->input->post('paypal_account_note'),
                'confirmation'          => $this->input->post('paypal_confirmation'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Square'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('square_account_credentials'),
                'account_note'          => $this->input->post('square_account_note'),
                'confirmation'          => $this->input->post('square_confirmation'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Warranty Work'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('warranty_account_credentials'),
                'account_note'          => $this->input->post('warranty_account_note'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Home Owner Financing'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('home_account_credentials'),
                'account_note'          => $this->input->post('home_account_note'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'e-Transfer'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('e_account_credentials'),
                'account_note'          => $this->input->post('e_account_note'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Credit Card Professor'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'credit_number'         => $this->input->post('other_credit_number'),
                'credit_expiry'         => $this->input->post('other_credit_expiry'),
                'credit_cvc'            => $this->input->post('other_credit_cvc'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }
        elseif($this->input->post('payment_method') == 'Other Payment Type'){
            $payment_data = array(
            
                'payment_method'        => $this->input->post('payment_method'),
                'amount'                => $this->input->post('payment_amount'),
                'account_credentials'   => $this->input->post('other_payment_account_credentials'),
                'account_note'          => $this->input->post('other_payment_account_note'),
                'billing_date'          => $this->input->post('billing_date'),
                'billing_frequency'     => $this->input->post('billing_frequency'),
                'work_order_id'         => $addQuery,
                'date_created'          => date("Y-m-d H:i:s"),
                'date_updated'          => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->save_payment($payment_data);
        }

        // $name = $this->input->post('custom_field');
        // $value = $this->input->post('custom_value');

        // $c = 0;
        //     foreach($name as $row2){
        //         $dataa['name'] = $name[$c];
        //         $dataa['value'] = $value[$c];
        //         $dataa['form_id'] = $addQuery;
        //         $dataa['company_id'] = $company_id;
        //         $dataa['date_added'] = date("Y-m-d H:i:s");
        //         $addQuery2a = $this->workorder_model->additem_details($dataa);
        //         $c++;
        //     }


        // if($addQuery > 0){
        //     $a = $this->input->post('items');
        //     $b = $this->input->post('item_type');
        //     $d = $this->input->post('quantity');
        //     $f = $this->input->post('price');
        //     $g = $this->input->post('discount');
        //     $h = $this->input->post('tax');
        //     $ii = $this->input->post('total');

        //     $i = 0;
        //     foreach($a as $row){
        //         $data['item'] = $a[$i];
        //         $data['item_type'] = $b[$i];
        //         $data['qty'] = $d[$i];
        //         $data['cost'] = $f[$i];
        //         $data['discount'] = $g[$i];
        //         $data['tax'] = $h[$i];
        //         $data['total'] = $ii[$i];
        //         $data['type'] = 'Work Order Alarm';
        //         $data['type_id'] = $addQuery;
        //         // $data['status'] = '1';
        //         $data['created_at'] = date("Y-m-d H:i:s");
        //         $data['updated_at'] = date("Y-m-d H:i:s");
        //         $addQuery2 = $this->accounting_invoices_model->additem_details($data);
        //         $i++;
        //     }

        //    redirect('workorder');
        // }
        if($addQuery > 0){
            $a = $this->input->post('itemid');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $h = $this->input->post('tax');
            $discount = $this->input->post('discount');
            $total = $this->input->post('total');

            $i = 0;
            foreach($a as $row){
                $data['items_id '] = $a[$i];
                $data['work_order_id '] = $addQuery;
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['tax'] = $h[$i];
                $data['discount'] = $discount[$i];
                $data['total'] = $total[$i];
                $addQuery2 = $this->workorder_model->add_work_order_details($data);
                $i++;
            }

            $notif = array(
            
                'user_id'               => $user_id,
                'title'                 => 'New Work Order',
                'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
                'date_created'          => date("Y-m-d H:i:s"),
                'status'                => '1',
                'company_id'            => getLoggedCompanyID()
            );

            $notification = $this->workorder_model->save_notification($notif);


           redirect('workorder');
        }
        else{
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }
    
    if($action == 'preview') {
        $dataaa = $this->input->post('workorder_number');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        $this->load->library('pdf');
        $html = $this->load->view('workorder/previewAlarm', [], true);
        $this->pdf->createPDF($html, 'mypdf', false);
        exit(0);
    }
    
    }

    public function preview($id)
    {
        // $filename = "nSmarTrac_work_order";
        // $data = "test";
        $data = $this->workorder_model->getById($id);
        $acs = $this->workorder_model->get_customerData_data($data->customer_id);
        $company = $this->workorder_model->getcompany_data($acs->company_id);
        $items = $this->workorder_model->getworkorderItems($data->id);
        $payment = $this->workorder_model->getpayment($data->id);
        
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/work_order_pdf_template', $data, $filename, "portrait");
        $this->load->library('pdf');
        // $this->pdf->load_html_file($data->company_representative_signature);
        $html = $data;
        $html .= '<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.1/build/pure-min.css">';
        $html .= '<div style="font-family: Gill Sans, sans-serif; font-size: 11px;">';
        $html .= "<p>".$data->header."</p>";
        $html .= '<div style="float:right;"><b>WORK ORDER</b> <br>#'.$data->work_order_number.'<br>
                                Job Tags: '.$data->tags.' <br>
                                Date Issued: '.$data->date_issued.' <br>
                                Priority: '.$data->priority.' <br>
                                Password: '.$data->password.' <br>
                                Security Number: '.$data->security_number.' <br>
                                Source: '.$data->source_name.' <br></div>';

        $html .= '<div style="margin-top:12%;"><b>FROM:</b><hr> <br>'.$company->first_name.' '.$company->last_name.'<br>Address: '.$company->business_address.'<br> Phone: '.$company->phone_number.'</div><br><br>';
        $html .= '<div><b>TO:</b><hr> <br>'.$acs->first_name.' '.$acs->last_name.'<br>'.$acs->business_name.'<br>Address: '.$acs->mail_add.' '.$acs->city.' '.$acs->state.' '.$acs->country.' '.$acs->zip_code.' '.$acs->cross_street.' '.'<br>Email: '.$acs->email.'<br>Phone:'.$acs->phone_h.'<br> Mobile: '.$acs->phone_m.'</div><br><br>';

        $html .= '<div><b>ADDITIONAL:</b><hr> <br>'.$data->instructions.'</div><br><br>';
        $html .= '<div><b>TERMS & CONDITIONS:</b><hr> <br>'.$data->terms_and_conditions.'</div><br><br>';

        $html .= '<div><b>JOB DETAILS:</b><hr> <br>
                    <table class="pure-table" style="border-collapse: collapse !important;">
                        <tr style="background-color: #E9DDFF !important;">
                            <th>Items</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th>Tax</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                            <td data-column=""> </td>
                        </tr>';

                    foreach($items as $item){
         $html .=
                        '<tr>
                            <td data-column="">'.$item->title.'</td>
                            <td data-column="">'.$item->qty.'</td>
                            <td data-column="">'.$item->costing.'</td>
                            <td data-column="">0</td>
                            <td data-column="">'.$item->tax.'</td>
                            <td data-column="">'.$item->total.'</td>
                        </tr>';
                     } 
        $html .='

                        <tr style="background-color: #F7F4FF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Subtotal</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->subtotal.'</td>
                        </tr>
                        
                        <tr style="background-color: #E9DDFF !important;">
                            <td colspan="5" style="background-color: #F8F8F8 !important;">Taxes</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->taxes.'</td>
                        </tr>';

                        if(empty($data->adjustment_value)){  } else{ 

        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><?php echo $adjustment_name; ?></td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->adjustment_value.'</td>
                        </tr>';

                        }if(empty($data->voucher_value)){  } else{
        $html .='        <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Voucher</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->voucher_value.'</td>
                        </tr>';

                        }if(empty($data->otp_setup)){ } else{
        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">One Time Program and Setup</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->otp_setup.'</td>
                        </tr>';

                        }if(empty($data->monthly_monitoring)){ } else{ 
        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5">Monthly Monitoring</td>
                            <td style="background-color: #F8F8F8 !important;">'.$data->monthly_monitoring.'</td>
                        </tr>';
                        }

        $html .='       <tr style="background-color: #F3F3F3 !important;">
                            <td style="background-color: #F8F8F8 !important;" colspan="5"><b>Grand Total</b></td>
                            <td style="background-color: #F8F8F8 !important;"><b>'.$data->grand_total.'</b></td>
                        </tr>
        </table>
        </div><br><br>';

        $html .= '<div><b>TERMS OF USE:</b><hr> <br>'.$data->terms_of_use.'</div><br><br>';
        $html .= '<div><b>JOB DESCRIPTION:</b><hr> <br>'.$data->job_description.'</div><br><br>';
        $html .= '<div><b>INSTRUCTIONS:</b><hr> <br>'.$data->instructions.'</div><br><br>';

        $html .= '<div><b>ACCEPTED PAYMENT METHODS:</b><hr>
                <ul>
                    <li>Cash</li>
                    <li>Check</li>
                    <li>Credit Card</li>
                    <li>Debit Card</li>
                    <li>ACH</li>
                    <li>Venmo</li>
                    <li>Paypal</li>
                    <li>Square</li>
                    <li>Invoicing</li>
                    <li>Warranty Work</li>
                    <li>Home Owner Financing</li>
                    <li>Home Owner Financing</li>
                    <li>e-Transfer</li>
                    <li>Other Credit Card Professor</li>
                    <li>Other Payment Type</li>
                </ul> </div>
                ';
            
        $html .= '<div><b>PAYMENT DETAILS:</b><hr> <br>Amount: '.$data->payment_amount.'<br>Payment Method: '.$data->payment_method.'</div><br><br>';
                    
                    if($data->payment_method ==  'Check')
                    {
        $html .=    'Check Number: '. $payment->check_number.
                    '<br>Rounting Number: '. $payment->routing_number.
                    '<br>Account Number: '. $payment->account_number.'';
                    }
                    elseif($data->payment_method ==  'Credit Card')
                    {
        $html .=    'Credit Number: '. $payment->credit_number.
                    '<br>Credit Expiry: '. $payment->credit_expiry.
                    '<br>CVC: '. $payment->credit_cvc.'';
                    }
                    elseif($data->payment_method ==  'Debit Card')
                    {
        $html .=    'Credit Number: '. $payment->credit_number.
                    '<br> Credit Expiry: '. $payment->credit_expiry.
                    '<br> CVC: '. $payment->credit_cvc.'';
                    }
                    elseif($data->payment_method ==  'ACH')
                    {
        $html .=    'Routing Number: '. $routing_number.
                    '<br> Account Number: '. $account_number.'';
                    }
                    elseif($data->payment_method ==  'Venmo')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.
                    '<br> Confirmation: '. $confirmation.'';
                    }
                    elseif($data->payment_method ==  'Paypal')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.
                    '<br> Confirmation: '. $confirmation.'';
                    }
                    elseif($data->payment_method ==  'Square')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.
                    '<br> Confirmation: '. $confirmation.'';
                    }
                    elseif($data->payment_method ==  'Invoicing')
                    {
        $html .=    'Address: '. $mail_address.' '. $mail_locality.' '. $mail_state.' '. $mail_postcode.' '. $mail_cross_street.'';
                    }
                    elseif($data->payment_method ==  'Warranty Work')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
                    elseif($data->payment_method ==  'Home Owner Financing')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
                    elseif($data->payment_method ==  'e-Transfer')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
                    elseif($data->payment_method ==  'Other Credit Card Professor')
                    {
        $html .=    'Credit Number: '. $credit_number.
                    '<br> Credit Expiry: '. $credit_expiry.
                    '<br> CVC: '. $credit_cvc.'';
                    }
                    elseif($data->payment_method ==  'Other Payment Type')
                    {
        $html .=    'Account Credential: '. $account_credentials.
                    '<br> Account Note: '. $account_note.'';
                    }
        $html .= '';

        $html .= '<div><b>ASSIGNED TO:</b><hr> <br>'.$data->instructions.'</div><br><br>';
        
        $html .= '<table>
                    <tr>
                        <td align="center">';
                            if(empty($data->company_representative_signature)){ } else{ 
        $html .=            '<img src="'.$data->company_representative_signature.'" style="width:30%;height:80px;"><br>
                            '.$data->company_representative_name.'';
                            }
        $html .=    '</td>
                        <td align="center">';
                            if(empty($data->primary_account_holder_signature)){ } else{ 
        $html .=             '<img src="'.$data->primary_account_holder_signature.'" style="width:30%;height:80px;"><br>
                            '.$data->primary_account_holder_name.'';
                             }
        $html .=        '</td>
                        <td align="center">';
                            if(empty($data->secondary_account_holder_signature)){ } else{ 
        $html .=        '<img src="'.$data->secondary_account_holder_signature.'" style="width:30%;height:80px;"><br>
                            '.$data->secondary_account_holder_name.'';
                            }
        $html .=        '</td>
                    </tr>
                </table>';

        $html .= '</div>';

        $this->pdf->createPDF($html, 'mypdf', false);
        exit(0);
    }
}



/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */
