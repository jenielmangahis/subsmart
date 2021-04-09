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

        $this->page_data['Workorder'] = $this->workorder_model->getById($id);

        $this->page_data['Workorder']->role = $this->roles_model->getByWhere(['id' => $this->page_data['Workorder']->role])[0];

        $this->page_data['Workorder']->activity = $this->activity_model->getByWhere(['user' => $id], ['order' => ['id', 'desc']]);

        $this->load->view('workorder/view', $this->page_data);
    }


    public function edit($id)
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        foreach ($this->page_data['workorder'] as $key => $workorder) {

            if (is_serialized($workorder)) {

                $this->page_data['workorder']->$key = unserialize($workorder);
            }
        }

//         echo '<pre>'; print_r($this->page_data['workorder']); die;

        $this->load->view('workorder/edit', $this->page_data);
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
            $users    = $this->Users_model->getAll();
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
                                    'title' => $description_a,
                                    'lat' => $center_lat,
                                    'lng' => $center_lng,
                                    'title' => "<b>Start Point</b><br />" . $pointA,
                                    'description' => $description_a,
                                    'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                                ];
                                $locations[] = [
                                    'title' => $description_b,
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
                                    'title' => $description_a,
                                    'lat' => $center_lat,
                                    'lng' => $center_lng,
                                    'description' => $description_a,
                                    'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                                ];
                                $locations[] = [
                                    'title' => $description_b,
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
                                'title' => $description_a,
                                'lat' => $center_lat,
                                'lng' => $center_lng,
                                'description' => $description_a,
                                'marker' => 'https://staging.nsmartrac.com/uploads/icons/caretaker_48px.png'
                            ];
                            $locations[] = [
                                'title' => $description_b,
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
                                    'title' => $description_a,
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

    public function save_update_tc(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $id  =  $this->input->post('id');

        $data = array(
            'id' => $this->input->post('id'),
            'content' => $this->input->post('content'),
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
        $this->page_data['number'] = $this->workorder_model->getlastInsert();

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
        


        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Work Order";
        // print_r($this->page_data['customers']);

        add_footer_js('assets/js/esign/docusign/workorder.js');
        $this->load->view('workorder/addNewworkOrder', $this->page_data);
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
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            
            'workorder_number' => $this->input->post('workorder_number'),
            'customer_id' => $this->input->post('customer_id'),
            'security_number' => $this->input->post('security_number'),
            'birthdate' => $this->input->post('birthdate'),
            'phone_number' => $this->input->post('phone_number'),
            'mobile_number' => $this->input->post('mobile_number'),
            'email' => $this->input->post('email'),
            'job_location' => $this->input->post('job_location'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip_code' => $this->input->post('zip_code'),
            'cross_street' => $this->input->post('cross_street'),
            'password' => $this->input->post('password'),
            'offer_code' => $this->input->post('offer_code'),//
            'job_tag' => $this->input->post('job_tag'),
            'schedule_date_given' => $this->input->post('schedule_date_given'),
            'job_type' => $this->input->post('job_type'),
            'job_name' => $this->input->post('job_name'),
            'job_description' => $this->input->post('job_description'),
            'payment_method' => $this->input->post('payment_method'),
            'payment_amount' => $this->input->post('payment_amount'),
            'account_holder_name' => $this->input->post('account_holder_name'),
            'account_number' => $this->input->post('account_number'),
            'expiry' => $this->input->post('expiry'),
            'cvc' => $this->input->post('cvc'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'status' => $this->input->post('status'),
            'priority' => $this->input->post('priority'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'terms_of_use' => $this->input->post('terms_of_use'),
            'instructions' => $this->input->post('instructions'),

            //signature
            // 'company_representative_signature' => $this->input->post('company_representative_signature'),
            // 'company_representative_name' => $this->input->post('company_representative_name'),
            // 'primary_account_holder_signature' => $this->input->post('primary_account_holder_signature'),
            // 'primary_account_holder_name' => $this->input->post('primary_account_holder_name'),
            // 'secondary_account_holder_signature' => $this->input->post('secondary_account_holder_signature'),
            // 'secondary_account_holder_name' => $this->input->post('secondary_account_holder_name'),
            'company_representative_signature' => 'company_representative_signature',
            'company_representative_name' => 'company_representative_name',
            'primary_account_holder_signature' => 'primary_account_holder_signature',
            'primary_account_holder_name' => 'primary_account_holder_name',
            'secondary_account_holder_signature' => 'secondary_account_holder_signature',
            'secondary_account_holder_name' => 'secondary_account_holder_name',
            

            //attachment
            // 'attached_photo' => $this->input->post('attached_photo'),
            // 'document_links' => $this->input->post('document_links'),
            'attached_photo' => 'attached_photo',
            'document_links' => 'document_links',

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'), 
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'voucher_value' => $this->input->post('voucher_value'),
            'grand_total' => $this->input->post('grand_total'),

            'user_id' => $user_id,
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->workorder_model->save_workorder($new_data);

        
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
                $dataa['form_id'] = $addQuery;
                $dataa['company_id'] = $company_id;
                $dataa['date_added'] = date("Y-m-d H:i:s");
                $addQuery2a = $this->workorder_model->additem_details($dataa);
                $c++;
            }


        if($addQuery > 0){
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach($a as $row){
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Work Order';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

           redirect('workorder');
        }
        else{
            echo json_encode(0);
        }
    }
}



/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */
