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
        $this->load->model('accounting_terms_model');
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('General_model', 'general');
        
        $user_id = getLoggedUserID();
        add_css(array(
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
            'assets/frontend/css/workorder/main.css',
            //"assets/css/accounting/sidebar.css",
            'assets/css/accounting/sales.css'
        ));


        // JS to add only Customer module
        add_footer_js(array(
            'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js',
            //'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
            //'assets/frontend/js/workorder/main.js'
        ));
    }


    public function index($tab_index = 0)
    {        
        $this->hasAccessModule(24); 
        if(!checkRoleCanAccessModule('work-orders', 'read')){
			show403Error();
			return false;
		}
        
        $role = logged('role');
        
		$this->page_data['page']->title = 'Work Orders';
		$this->page_data['page']->parent = 'Sales';
        
        $company_id = logged('company_id');        

        $query = $this->input->get();        
        $workorder_status = 'all';
        if( isset($query['status']) ){
            $workorder_status = $query['status'];
        }

        $this->page_data['workorderStatusFilters'] = array ();
        $this->page_data['workorders'] = array ();
        $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => logged('company_id')]);
        if ($role == 2 || $role == 3) {
            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
            } else {

                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                } elseif (!empty(get('order'))) {
                    $this->page_data['search'] = get('search');
                }
            }
        }

        if ($role == 4) {
            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
            } elseif (!empty(get('order'))) {
                $this->page_data['order'] = get('order');
            } else {
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                } 
            }
        }

        $order = $this->input->get();
        $sort  = ['field' => 'id', 'order' => 'desc'];
        $sort_selected = 'Date Issued: Newest';
        if( isset($order['order']) ){
            switch ($order['order']) {
                case 'amount-asc':
                    $sort = ['field' => 'grand_total', 'order' => 'asc'];
                    $sort_selected = 'Amount : Lowest';
                    break;
                case 'amount-desc':
                    $sort = ['field' => 'grand_total', 'order' => 'desc'];
                    $sort_selected = 'Amount: Highest';
                    break;
                case 'date-issued-asc':
                    $sort = ['field' => 'date_created', 'order' => 'asc'];
                    $sort_selected = 'Date Issued: Oldest';
                    break;
                case 'date-issued-desc':
                    $sort = ['field' => 'date_created', 'order' => 'desc'];
                    $sort_selected = 'Date Issued: Newest';
                    break;
                case 'number-asc':
                    $sort = ['field' => 'work_order_number', 'order' => 'asc'];
                    $sort_selected = 'Work Order #: A to Z';
                    break;
                case 'number-desc':
                    $sort = ['field' => 'work_order_number', 'order' => 'desc'];
                    $sort_selected = 'Work Order #: Z to A';
                    break;
                case 'event-date-asc':
                    $sort = ['field' => 'date_issued', 'order' => 'asc'];
                    $sort_selected = 'Date Issued: Oldest';
                    break;
                case 'event-date-desc':
                    $sort = ['field' => 'date_issued', 'order' => 'desc'];
                    $sort_selected = 'Scheduled Date: Newest';
                    break;
                case 'priority-asc':
                    $sort = ['field' => 'priority', 'order' => 'asc'];
                    $sort_selected = 'Priority: A to Z';
                    break;
                case 'priority-desc':
                    $sort = ['field' => 'priority', 'order' => 'desc'];
                    $sort_selected = 'Priority: Z to A';
                    break;
                default:
                    $sort = ['field' => 'id', 'order' => 'desc'];
                    $sort_selected = 'Date Issued: Newest';
                    break;
            }
        }
        

        if (!empty(get('search'))) {
            $filter['status'] = $workorder_status;
            $filter['search'] = get('search');
            
            $org_id = array('58','31');
            if($company_id == 58 || $company_id == 31)
            {
                $workorder = $this->workorder_model->getFilterworkorderListMultiple($org_id, $filter); 
            }else{
                $workorder = $this->workorder_model->getFilterworkorderList($company_id, $filter); 
            }
        }else{
            $filter['status'] = $workorder_status;
            // $workorder = $this->workorder_model->getworkorderList($filter, $sort);    
            $org_id = array('58','31');
            if($company_id == 58 || $company_id == 31)
            {
                $workorder = $this->workorder_model->getworkorderListMultiple($org_id, $filter, $sort); 
            }else{
                $workorder = $this->workorder_model->getworkorderList($filter, $sort);  
            }
        }

        $totalWorkorders = $this->workorder_model->getFilterworkorderList($company_id, []); 
        $scheduledWorkorders = $this->workorder_model->getAllByCompanyIdAndStatus($company_id, 'Scheduled');
        $newWorkorders       = $this->workorder_model->getAllByCompanyIdAndStatus($company_id, 'New');
        
        $this->page_data['workorders'] = $workorder;
        $this->page_data['scheduledWorkorders'] = $scheduledWorkorders;
        $this->page_data['newWorkorders'] = $newWorkorders;
        $this->page_data['totalWorkorders'] = $totalWorkorders;

        $company_id = logged('company_id');
        $this->page_data['company_work_order_used'] = $this->workorder_model->getcompany_work_order_used($company_id);

        // unserialized the value

        $statusFilter = array();        
        foreach ($this->page_data['workorders'] as $workorder) {

            if (is_serialized($workorder)) {

                $workorder = unserialize($workorder);
            }
        }

        $this->page_data['tab_status'] = $workorder_status;
        $this->page_data['sort_selected'] = $sort_selected;
        $this->load->view('v2/pages/workorder/list', $this->page_data);
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
        $this->load->model('Invoice_model');
        $this->load->model('Invoice_items_model');

        if(!checkRoleCanAccessModule('work-orders', 'read')){
			show403Error();
			return false;
		}

        $company_id = logged('company_id');

        $this->page_data['workorder'] = $this->workorder_model->getById($id);

        $work =  $this->workorder_model->getById($id);

        if( $work && $work->company_id == $company_id ){
            add_footer_js('assets/js/esign/docusign/workorder.js');
            $WOitems = $this->workorder_model->getworkorderItems($id);
            $invoice = [];
            $invoiceItems = [];
            if( $work->invoice_id > 0 ){
                $invoice = $this->Invoice_model->getById($work->invoice_id);
                $invoiceItems = $this->Invoice_items_model->getAllByInvoiceId($work->invoice_id);
            }

            $this->page_data['invoice'] = $invoice;
            $this->page_data['invoiceItems'] = $invoiceItems;
            $this->page_data['company'] = $this->workorder_model->getCompanyCompanyId($work->company_id);
            $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
            $this->page_data['items'] = $this->workorder_model->getItems($id);
            $this->page_data['itemsA'] = $this->workorder_model->getItemsAlarm($id);
            $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);                        
            $this->page_data['workorder_items'] = $this->workorder_model->getworkorderItems($id);
            $this->page_data['workorder_agreement_items'] = $this->workorder_model->getAllWorkorderAgreementProductsByWorkorderId($id);
            $this->page_data['first'] = $this->workorder_model->getuserfirst($work->company_representative_name);
            $this->page_data['second'] = $this->workorder_model->getusersecond($work->primary_account_holder_name);
            $this->page_data['third'] = $this->workorder_model->getuserthird($work->secondary_account_holder_name);
            $this->page_data['lead'] = $this->workorder_model->getleadSource($work->lead_source_id);
            $this->page_data['contacts'] = $this->workorder_model->get_contacts($work->customer_id);
            $this->page_data['solars'] = $this->workorder_model->get_solar($id);
            $this->page_data['solar_files'] = $this->workorder_model->get_solar_files($id);
            $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();            
            $this->page_data['agreements'] = $this->workorder_model->get_agreements($id);
            $this->page_data['agree_items'] = $this->workorder_model->get_agree_items($id);
            $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
            $this->page_data['page']->title = 'Workorder';            
            $this->page_data['payment'] = $payments = $this->workorder_model->getpayment($id);

            $spt_query = array(
                'table' => 'ac_system_package_type',
                'order' => array(
                    'order_by' => 'id',
                ),
                'where' => array(
                    'company_id' => $company_id,
                ),
                'select' => '*',
            );
            $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);            
            $this->load->view('v2/pages/workorder/view', $this->page_data);
        }else{
            redirect('workorder');  
        }
    }

    public function printSolar($id)
    {
        $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $work =  $this->workorder_model->getById($id);
        
        $this->page_data['company'] = $this->workorder_model->getCompanyCompanyId($work->company_id);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['items'] = $this->workorder_model->getItems($id);

        $this->page_data['itemsA'] = $this->workorder_model->getItemsAlarm($id);
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        
        $WOitems = $this->workorder_model->getworkorderItems($id);
        $this->page_data['workorder_items'] = $WOitems;

        $this->page_data['first'] = $this->workorder_model->getuserfirst($work->company_representative_name);
        $this->page_data['second'] = $this->workorder_model->getusersecond($work->primary_account_holder_name);
        $this->page_data['third'] = $this->workorder_model->getuserthird($work->secondary_account_holder_name);

        $this->page_data['lead'] = $this->workorder_model->getleadSource($work->lead_source_id);
        $this->page_data['contacts'] = $this->workorder_model->get_contacts($work->customer_id);
        $this->page_data['solars'] = $this->workorder_model->get_solar($id);
        $this->page_data['solar_files'] = $this->workorder_model->get_solar_files($id);
        
        $this->page_data['agreements'] = $this->workorder_model->get_agreements($id);
        $this->page_data['agree_items'] = $this->workorder_model->get_agree_items($id);

        // add_footer_js('assets/js/esign/docusign/workorder.js');
        $this->load->view('workorder/printSolar', $this->page_data);
    }

    public function editWorkorderSolar($id)
    {
        $this->page_data['workorder'] = $wo = $this->workorder_model->getById($id);
        $work =  $this->workorder_model->getById($id);
        
        $this->page_data['company'] = $this->workorder_model->getCompanyCompanyId($work->company_id);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['items'] = $this->workorder_model->getItems($id);

        $this->page_data['itemsA'] = $this->workorder_model->getItemsAlarm($id);
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        
        $WOitems = $this->workorder_model->getworkorderItems($id);
        $this->page_data['workorder_items'] = $WOitems;

        $this->page_data['first'] = $this->workorder_model->getuserfirst($work->company_representative_name);
        $this->page_data['second'] = $this->workorder_model->getusersecond($work->primary_account_holder_name);
        $this->page_data['third'] = $this->workorder_model->getuserthird($work->secondary_account_holder_name);

        $this->page_data['lead'] = $this->workorder_model->getleadSource($work->lead_source_id);
        $this->page_data['contacts'] = $this->workorder_model->get_contacts($work->customer_id);
        $this->page_data['solars'] = $this->workorder_model->get_solar($id);
        $this->page_data['solar_files'] = $this->workorder_model->get_solar_files($id);
        
        $this->page_data['agreements'] = $this->workorder_model->get_agreements($id);
        $this->page_data['agree_items'] = $this->workorder_model->get_agree_items($id);
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        $this->page_data['payments'] = $this->workorder_model->get_payments_details($id);

        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($work->company_id);

        $spt_query = array(
            'table' => 'ac_system_package_type',
            'order' => array(
                'order_by' => 'id',
            ),
            'select' => '*',
        );

        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);

        $this->page_data['customers'] = $this->workorder_model->getByProfIdComp($work->customer_id);


        // add_footer_js('assets/js/esign/docusign/workorder.js');
        $this->load->view('workorder/editWorkorderSolar', $this->page_data);
    }

    public function edit($id)
    {
        $this->load->model('AcsProfile_model');
        $this->load->helper('functions');

        if(!checkRoleCanAccessModule('work-orders', 'write')){
            show403Error();
            return false;
        }

        add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
			'assets/js/jquery.signaturepad.js'
        ]);

        $company_id = logged('company_id');
        $user_id    = logged('id');
        $parent_id  = $this->db->query("select id from users where id=$user_id")->row();
        $workOrder  = $this->workorder_model->getById($id);
        $checkListsHeader = $this->workorder_model->getchecklistHeaderByCompanyId($company_id);
        $workorder_checklists = unserialize($workOrder->checklists);
        $selected_checklists  = array();
        $checklists = array();
        foreach( $checkListsHeader as $h ){
            $checklistItems = $this->workorder_model->getchecklistHeaderItems($h->id);
            $checklists[$h->id]['header'] = ['name' => $h->checklist_name, 'id' => $h->id];
            $checklists[$h->id]['items']  = $checklistItems;    
            if( !empty($workorder_checklists) ){
                if( in_array($h->id, $workorder_checklists) ){
                    $selected_checklists[$h->id] = ['id' => $h->id, 'name' => $h->checklist_name];
                }  
            
            }
        }        

        $customer = $this->AcsProfile_model->getByProfId($workOrder->customer_id);
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        $this->page_data['customer'] = $customer;
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['checklists'] = $checklists;
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['workorder'] = $workOrder;
        $this->page_data['selected_checklists'] = $selected_checklists;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['lead_source'] = $this->workorder_model->getLeadSourceByCompanyId($company_id);
        $this->page_data['payment'] = $this->workorder_model->getpayment($id);
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['fieldsName'] = $this->workorder_model->getCustomByID();
        $this->page_data['items_data'] = $this->workorder_model->getworkorderItems($id);
        $this->page_data['page']->title = 'Edit Work Order';
		$this->page_data['page']->parent = 'Sales';
        $this->load->view('v2/pages/workorder/edit', $this->page_data);
    }

    public function invoice_workorder($id)
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
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);

        $this->page_data['page_title'] = "Work Order";
        // print_r($this->page_data['lead_source']);

        $terms = $this->accounting_terms_model->getCompanyTerms_a($comp_id);

        $this->page_data['invoice'] = $this->invoice_model->getinvoice($id);

        $invoiceDet = $this->invoice_model->getinvoice($id);
        $cust =  $invoiceDet->customer_id;

        $this->page_data['custs'] = $this->AcsProfile_model->getByProfile($cust);

        $this->page_data['itemsInv'] = $this->invoice_model->getItems($id);
        $this->page_data['itemsDetails'] = $this->invoice_model->getInvoiceItems($id);
        $this->page_data['terms'] =  $terms;

        $this->load->view('workorder/invoice_workorder', $this->page_data);
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
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);

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

    public function editInstallation($id)
    {
        $this->load->model('Contacts_model');

        add_footer_js([
            'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
            'assets/js/jquery.signaturepad.js'
        ]);
        
        $company_id = logged('company_id');
        $user_id = logged('id');
        $parent_id = $this->db->query("select id from users where id=$user_id")->row();

        if ($parent_id->parent_id == 1) {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        }

        $workorder = $this->workorder_model->getworkorder($id);
        $spt_query = array(
            'table' => 'ac_system_package_type',
            'order' => array(
                'order_by' => 'id',
            ),
            'where' => array(
                'company_id' => $company_id,
            ),
            'select' => '*',
        );
        
        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);
        $this->page_data['lead_source'] = $this->workorder_model->getLeadSourceByCompanyId($company_id);
        
        $contacts = $this->Contacts_model->getAllByCustomerId($workorder->customer_id,3);

        $emergency_contact_a = [];
        $emergency_contact_b = [];
        $emergency_contact_c = [];
        $rows = 1;
        foreach( $contacts as $c ){
            if( $rows == 1 ){
                $emergency_contact_a = [
                    'firstname' => $c->first_name,
                    'lastname' => $c->last_name,
                    'relationship' => $c->relation,
                    'phone' => $c->phone
                ];
            }elseif( $rows == 2 ){
                $emergency_contact_b = [
                    'firstname' => $c->first_name,
                    'lastname' => $c->last_name,
                    'relationship' => $c->relation,
                    'phone' => $c->phone
                ];
            }elseif( $rows == 3 ){
                $emergency_contact_c = [
                    'firstname' => $c->first_name,
                    'lastname' => $c->last_name,
                    'relationship' => $c->relation,
                    'phone' => $c->phone
                ];
            }
            $rows++;
        }
        
        $this->page_data['emergency_contact_a'] = $emergency_contact_a;
        $this->page_data['emergency_contact_b'] = $emergency_contact_b;
        $this->page_data['emergency_contact_c'] = $emergency_contact_c;
        $this->page_data['optionRelations'] = $this->Contacts_model->optionRelations();

        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['workorder'] = $this->workorder_model->getById($id);
        $this->page_data['workorder'] = $workorder;
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['customer'] = $this->workorder_model->getcustomerCompanyId($id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();
        $this->page_data['items'] = $this->items_model->getItemlist();
        // $this->page_data['items_data'] = $this->items_model->getItemData($id);
        $this->page_data['items_data'] = $this->items_model->getItemDataAlarm($id); //Work Order Alarm
        $this->page_data['custom_fields'] = $this->workorder_model->getCustomFields($id);
        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['alarms'] = $this->workorder_model->getAlarms($id);
        $this->page_data['ids'] = $this->workorder_model->getlastInsertID();
        $this->page_data['payment'] = $this->workorder_model->getpayment($id);

        $this->page_data['cameras'] = $this->workorder_model->getenhanced_services_cameras($id);
        $this->page_data['doorlocks'] = $this->workorder_model->getenhanced_services_doorlocks($id);
        $this->page_data['dvr'] = $this->workorder_model->getenhanced_services_dvr($id);
        $this->page_data['automation'] = $this->workorder_model->getenhanced_services_automation($id);
        $this->page_data['pers'] = $this->workorder_model->getenhanced_services_pers($id);
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['agreeItem'] = $this->workorder_model->get_agree_items($id);
        $this->page_data['agreeDetails'] = $this->workorder_model->get_agree_details($id);
        $this->page_data['payments'] = $this->workorder_model->get_payments_details($id);
        $this->page_data['customers'] = $this->workorder_model->getCustByComp($company_id);
        // agreeItem
        
        $work = $this->workorder_model->getworkorder($id);

        $this->page_data['contacts'] = $this->workorder_model->get_contacts($work->customer_id);

        $this->load->view('workorder/editInstallation', $this->page_data);
    }

    public function sendWorkorderToAcs()
    {
        $id = $this->input->post('id');
        $wo_id = $this->input->post('wo_id');

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
        
        $message2 = $this->load->view('workorder/send_email_acs', $data, true);
        $filename = $workData->company_representative_signature;

        $customer_name = $this->input->post("customer_name");
        $customer_email = $this->input->post("customer_email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        $server   = MAIL_SERVER;
        $port     = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from     = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;
        
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        // $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
        
        $mail->MsgHTML($message2);
        
        $data = new stdClass();
        try {
            // $mail->addAddress($workData->email);
            $mail->addAddress('webtestcustomer@nsmartrac.com');
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

        echo json_encode($json_data);
    }

    public function sendWorkorderToAcs_old()
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

    public function sendWorkorderToCompany_old()
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

    public function sendWorkorderToCompany()
    {
        $id = $this->input->post('id');
        $wo_id = $this->input->post('wo_id');

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
        
        $message2 = $this->load->view('workorder/send_email_acs', $data, true);
        $filename = $workData->company_representative_signature;

        $customer_name = $this->input->post("customer_name");
        $customer_email = $this->input->post("customer_email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        $server   = MAIL_SERVER;
        $port     = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from     = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;
        
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        // $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
        
        $mail->MsgHTML($message2);
        
        $data = new stdClass();
        try {
            // $mail->addAddress($workData->email);
            $mail->addAddress('webtestcustomer@nsmartrac.com');
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Successfully sent to Company.');

        echo json_encode($json_data);
    }

    public function sendWorkorderToAcsAlarm()
    {
        $id = $this->input->post('id');
        $wo_id = $this->input->post('wo_id');

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

        $customer_name = $this->input->post("customer_name");
        $customer_email = $this->input->post("customer_email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");

        $server   = MAIL_SERVER;
        $port     = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from     = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;
        
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
        // $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
        
        $mail->MsgHTML($message2);
        
        $data = new stdClass();
        try {
            // $mail->addAddress($workData->email);
            $mail->addAddress('webtestcustomer@nsmartrac.com');
            $mail->Send();
            $data->status = "success";
        } catch (Exception $e) {
            $data->error = 'Mailer Error: ' . $mail->ErrorInfo;
            $data->status = "error";
        }

        $this->session->set_flashdata('alert-type', 'success');
        $this->session->set_flashdata('alert', 'Successfully sent to Customer.');

        echo json_encode($json_data);
    }


    public function sendWorkorderToAcsAlarm_old()
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

    public function sendLinkToEmail()
    {
        $test = $this->input->post('emails_list');
    //    var_dump('test'.$test);

        $arr = explode(',',$test);

        $message = $this->input->post('email_content'); 

        foreach($arr as $recipient)
        {
            //echo $recipient."<br>";
            // $recipient =  'emploucelle@gmail.com';

            include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';
            $server    = MAIL_SERVER;
            $port      = MAIL_PORT ;
            $username  = MAIL_USERNAME;
            $password  = MAIL_PASSWORD;
            $from      = MAIL_FROM;
            $subject   = 'nSmarTrac: Shared Link';
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
            $mail->Body    = $message;
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
            $this->session->set_flashdata('alert', 'Successfully Sent to Email.');

            echo json_encode($json_data);
            redirect($_SERVER['HTTP_REFERER']);
        }

        // redirect('workorder');
        //Email Sending
        // $recipient =  'emploucelle@gmail.com';
        // $message = 'test';
    
        

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
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;
        $company_id = $workData->company_id;

        $first = $this->workorder_model->getuserfirst($workData->company_representative_name);
        $second = $this->workorder_model->getusersecond($workData->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workData->secondary_account_holder_name);

        $lead = $this->workorder_model->getleadSource($workData->lead_source_id);

        $data = array(
            'workorder'                         => $workorder,
            'tags'                              => $workData->tags,
            'job_type'                          => $workData->job_type,
            'priority'                          => $workData->priority,
            'password'                          => $workData->password,
            'security_number'                   => $workData->security_number,
            'source_name'                       => $lead->ls_name,
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
            'amount'                            => $payment->amount > 0 ? $payment->amount : '0.00', //
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
            'business'                          => $business,

            'business_logo'                     => $business_logo,

            'first'                             => $first,
            'second'                            => $second,
            'third'                             => $third,
            'company_id'                        => $company_id,

            'header'                            => $workData->header,
            
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
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;

        $company_id = $workData->company_id;

        $first = $this->workorder_model->getuserfirst($workData->company_representative_name);
        $second = $this->workorder_model->getusersecond($workData->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workData->secondary_account_holder_name);

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
            'business_logo'                     => $business_logo,

            'first'                             => $first,
            'second'                            => $second,
            'third'                             => $third,

            'company_id'                        => $company_id,
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

    
    public function work_order_pdf_agreement($wo_id)
    {
        
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workorder = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workorder->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorderNo = $workorder->work_order_number;
        $c_id = $workorder->company_id;
        $p_id = $workorder->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrderAlarm($wo_id);
        $items = $this->workorder_model->get_agree_items($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;
        $agreements = $this->workorder_model->get_agreements($wo_id);

        $company_id = $workorder->company_id;

        $first = $this->workorder_model->getuserfirst($workorder->company_representative_name);
        $second = $this->workorder_model->getusersecond($workorder->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workorder->secondary_account_holder_name);
        $job_tag = $this->workorder_model->getjob_tag($workorder->job_tags);

        $data = array(
            'workorder'                         => $workorderNo,
            'company_representative_signature'  => $workorder->company_representative_signature,
            'company_representative_name'       => $workorder->company_representative_name,
            'primary_account_holder_signature'  => $workorder->primary_account_holder_signature,
            'primary_account_holder_name'       => $workorder->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workorder->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workorder->secondary_account_holder_name,

            'items'                             => $items,

            'total'                             => $workorder->grand_total,
            'subtotal'                          => $workorder->subtotal,
            'taxes'                             => $workorder->taxes,
            'otp_setup'                         => $workorder->otp_setup,
            'monthly_monitoring'                => $workorder->monthly_monitoring,
            'installation_cost'                 => $workorder->installation_cost,
            'email'                             => $workorder->email,

            'comments'                          => $workorder->comments,
            'terms_and_conditions'              => $workorder->terms_and_conditions,
            'header'                            => $workorder->header,

            'password'                          => $workorder->password,
            'security_number'                   => $workorder->security_number,

            'lead_source'                       => $workorder->ls_name,
            'account_type'                      => $workorder->account_type,
            'panel_communication'               => $workorder->panel_communication,
            'panel_type'                        => $workorder->panel_type,
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

            'template'                          => '3',
            'business_logo'                     => $business_logo,

            'first'                             => $first->FName.' '.$first->LName,
            'second'                            => $second,
            'third'                             => $third,

            'company_id'                        => $company_id,

            'firstname'                         => $agreements->firstname,
            'lastname'                          => $agreements->lastname,
            'businessname'                      => $agreements->businessname,
            'firstname_spouse'                  => $agreements->firstname_spouse,
            'lastname_spouse'                   => $agreements->lastname_spouse,
            'address'                           => $agreements->address,
            'city'                              => $agreements->city,
            'state'                             => $agreements->state,
            'county'                            => $agreements->county,
            'postcode'                          => $agreements->postcode,
            'first_ecn'                         => $agreements->first_ecn,
            'second_ecn'                        => $agreements->second_ecn,
            'third_ecn'                         => $agreements->third_ecn,
            'first_ecn_no'                      => $agreements->first_ecn_no,
            'second_ecn_no'                     => $agreements->second_ecn_no,
            'third_ecn_no'                      => $agreements->third_ecn_no,
            'installation_date'                 => $workorder->install_date,
            'intall_time'                       => $workorder->install_time,
            'sales_re_name'                     => $agreements->sales_re_name,
            'sale_rep_phone'                    => $agreements->sale_rep_phone,
            'team_leader'                       => $agreements->team_leader,
            'billing_date'                      => $agreements->billing_date,
            'job_tags'                          => $job_tag->name,
        );

        // dd($agreements);


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_installation";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template_agreement', $data, $filename, "portrait");
        // $this->pdf->render();


        // $this->pdf->stream("welcome.pdf");
    }

    public function work_order_pdf_solar($wo_id)
    {
        // $id = $this->input->post('id');
        // $wo_id = $this->input->post('wo_id');

        $workorder = $this->workorder_model->get_workorder_data($wo_id);
        // var_dump($workData);

        $source_id = $workorder->lead_source_id;
        // $sourcea = $this->workorder_model->get_source_data($source_id);
        
        $workorderNo = $workorder->work_order_number;
        $c_id = $workorder->company_id;
        $p_id = $workorder->customer_id;
        // $source = $source->ls_name;

        $cliets = $this->workorder_model->get_cliets_data($c_id);
        $customerData = $this->workorder_model->get_customerData_data($p_id);

        $customs = $this->workorder_model->get_custom_data($wo_id);
        // $items = $this->workorder_model->getitemsWorkOrderAlarm($wo_id);
        $items = $this->workorder_model->get_agree_items($wo_id);
        $payment = $this->workorder_model->getpayment($wo_id);
        $business = $this->workorder_model->getbusiness($c_id);
        $business_logo = $business->business_image;
        $agreements = $this->workorder_model->get_agreements($wo_id);

        $company_id = $workorder->company_id;

        $first = $this->workorder_model->getuserfirst($workorder->company_representative_name);
        $second = $this->workorder_model->getusersecond($workorder->primary_account_holder_name);
        $third = $this->workorder_model->getuserthird($workorder->secondary_account_holder_name);

        $solars = $this->workorder_model->get_solar($wo_id);
        $solar_files = $this->workorder_model->get_solar_files($wo_id);
        $job_tag = $this->workorder_model->getjob_tag($workorder_model->job_tags);

        $data = array(
            'workorder'                         => $workorderNo,
            'company_representative_signature'  => $workorder->company_representative_signature,
            'company_representative_name'       => $workorder->company_representative_name,
            'primary_account_holder_signature'  => $workorder->primary_account_holder_signature,
            'primary_account_holder_name'       => $workorder->primary_account_holder_name,
            'secondary_account_holder_signature'=> $workorder->secondary_account_holder_signature,
            'secondary_account_holder_name'     => $workorder->secondary_account_holder_name,

            'comments'                          => $workorder->comments,
            'header'                            => $workorder->header,

            'lead_source'                       => $workorder->ls_name,
            'panel_communication'               => $workorder->panel_communication,
            // 'source' => $source

            'template'                          => '3',
            'business_logo'                     => $business_logo,

            'first'                             => $first->FName.' '.$first->LName,
            'second'                            => $second,
            'third'                             => $third,

            'company_id'                        => $company_id,

            'tor'                               => $solars->tor,
            'sfoh'                              => $solars->sfoh,
            'aor'                               => $solars->aor,
            'spmp'                              => $solars->spmp,
            'hoa'                               => $solars->hoa,
            'hoa_text'                          => $solars->hoa_text,
            'estimated_bill'                    => $solars->estimated_bill,
            'ebis'                              => $solars->ebis,
            'hdygi'                             => $solars->hdygi,
            'hdygi_file'                        => $solars->hdygi_file,
            'eba_text'                          => $solars->eba_text,
            'es'                                => $solars->es,
            'options'                           => $solars->options,

            'firstname'                         => $customerData->first_name,
            'lastname'                          => $customerData->last_name,
            'address'                           => $customerData->mail_add,
            'city'                              => $customerData->city,
            'state'                             => $customerData->state,
            'county'                            => $customerData->county,
            'postcode'                          => $customerData->zip_code,
            'email'                             => $customerData->email,

            'solar_files'                       => $solar_files,
            'job_tags'                           => $job_tag->name,
        );

        // dd($agreements);


    // $message2 = $this->load->view('workorder/send_email_acs_alarm', $data, true);
    // $filename = $workData->company_representative_signature;
            
        $filename = "nSmarTrac_work_order_".$wo_id."_solar";
        // $this->load->library('pdf');
        // $this->pdf->load_view('workorder/send_email_acs_alarm', $data, $filename, "portrait");
        $this->load->library('pdf');


        $this->pdf->load_view('workorder/work_order_pdf_template_solar', $data, $filename, "portrait");
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
		$this->page_data['page']->title = 'Bird\'s Eye View';
        $this->page_data['page']->parent = 'Sales';
        $this->hasAccessModule(25); 

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
        $this->load->view('v2/pages/workorder/bird_eye_view', $this->page_data);
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
        if(!checkRoleCanAccessModule('work-order-settings', 'read')){
			show403Error();
			return false;
		}

		$this->page_data['page']->title = 'Workorder Settings';
		$this->page_data['page']->parent = 'Sales';

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
            $order_num_next    = str_pad($workorderSettings->work_order_num_next, 5, '0', STR_PAD_LEFT);
            $capture_signature = $workorderSettings->capture_customer_signature;
        }else{
            $lastInserted = $this->workorder_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next_num = $lastInserted->id + 1;
                $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
            }else{
                $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
            }
        }

        $this->page_data['prefix'] = $prefix;
        $this->page_data['order_num_next'] = $order_num_next;
        $this->page_data['capture_signature'] = $capture_signature;
        $this->page_data['page']->menu = 'settings';
        $this->page_data['clients'] = $this->workorder_model->getclientsById();

        $this->page_data['customFields']  = $this->workorder_model->getCustomFieldsByCompanyId($company_id);
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['terms'] = $this->workorder_model->getWOtermsByID();

        // dd($this->workorder_model->getWOtermsByID());

        $this->load->view('v2/pages/workorder/settings', $this->page_data);
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

    public function addTerms()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $header_data = array(
            
            'content' => $this->input->post('add_terms'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->save_terms($header_data);


        if($custom_dataQuery > 0){

           redirect('workorder/settings');
        }
        else{
            echo json_encode(0);
        }
    }

    public function addWOTermsCond()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $header_data = array(
            'content' => $this->input->post('add_terms_content'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->save_termsCond($header_data);


        if($custom_dataQuery > 0){

           redirect('workorder/settings');
        }
        else{
            echo json_encode(0);
        }
    }

    public function updateWOTermsCond()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $header_data = array(
            'id' => $this->input->post('wo_tc'),
            'content' => $this->input->post('update_terms_content'),
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $custom_dataQuery = $this->workorder_model->updateWOTermsCond($header_data);


        if($custom_dataQuery > 0){

           redirect('workorder/settings');
        }
        else{
            echo json_encode(0);
        }
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
        $termsCondition = $this->workorder_model->getWorkOrderSettingTermsConditionByCompanyId($company_id);
        if( $termsCondition ){            
            $id   =  $termsCondition->id;
            $data = array(        
                'id' => $id,        
                'content' => $this->input->post('content'),
                'company_id' => $company_id,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );
        }else{            
            $data = array(
                'id' => '',
                'content' => $this->input->post('content'),
                'company_id' => $company_id,                
                'date_updated' => date("Y-m-d H:i:s")
            );
        }

        $dataQuery = $this->workorder_model->update_tc($data);

        echo json_encode($dataQuery);
    }

    public function save_update_header(){
        $company_id  = getLoggedCompanyID();
        $settingHeader = $this->workorder_model->getWorkOrderSettingHeaderByCompanyId($company_id);
        if( $settingHeader ){            
            $id   =  $settingHeader->id;
            $data = array(        
                'id' => $id,        
                'content' => $this->input->post('content'),
                'company_id' => $company_id,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );
        }else{            
            $data = array(
                'id' => '',
                'content' => $this->input->post('content'),
                'company_id' => $company_id,                
                'date_updated' => date("Y-m-d H:i:s")
            );
        }

        $dataQuery = $this->workorder_model->update_setting_header($data);

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
        $this->load->helper('functions');
        
        if(!checkRoleCanAccessModule('work-order-settings', 'read')){
			show403Error();
			return false;
		}
        
        $this->page_data['page']->title = 'Priority';
        $this->page_data['page']->parent = 'Calendar';
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

        //Activity Logs
        $activity_name = 'Updated Workorder Settings'; 
        createActivityLog($activity_name);

        echo json_encode($json_data);
    }

    public function checklists()
    {   
        if(!checkRoleCanAccessModule('work-order-settings', 'read')){
            show403Error();
            return false;
        }

        $this->hasAccessModule(29); 
        $this->load->helper(array('hashids_helper'));
        $this->load->model('Checklist_model');

        $company_id = logged('company_id');
        $checklists = $this->Checklist_model->getAllByCompanyId($company_id);

        $this->page_data['page']->title = 'Workorder Checklist';
		$this->page_data['page']->parent = 'Sales';
        $this->page_data['checklists'] = $checklists;        
        $this->load->view('v2/pages/workorder/checklist/list', $this->page_data);
    }

    public function ajax_delete_selected_checklists()
    {
        $this->load->model('Checklist_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['checklists'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
            $total_deleted = $this->Checklist_model->bulkDelete($post['checklists'], $filters);

			//Activity Logs
			$activity_name = 'Checklists : Permanently deleted ' .$total_deleted. ' checklist(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function add_checklist()
    {
        $this->load->model('Checklist_model');

        if(!checkRoleCanAccessModule('work-order-settings', 'write')){
            show403Error();
            return false;
        }

        $checklistAttachType = $this->Checklist_model->getAttachType();

        $this->page_data['page']->title = 'Workorder Checklist';
		$this->page_data['page']->parent = 'Sales';
        $this->page_data['checklistAttachType'] = $checklistAttachType;        
        $this->load->view('v2/pages/workorder/checklist/add_checklist', $this->page_data);
    }

    public function create_checklist(){
        $this->load->model('Checklist_model');

        postAllowed();

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $user_id = logged('id');
        $company_id = logged('company_id');

        $data = [
            'company_id' => $company_id,
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

    public function edit_checklist($id)
    {
        $this->load->model('Checklist_model');
        $this->load->model('ChecklistItem_model');

        if(!checkRoleCanAccessModule('work-order-settings', 'write')){
            show403Error();
            return false;
        }

        $company_id = logged('company_id');
        $checklistAttachType = $this->Checklist_model->getAttachType();

        $checklist = $this->Checklist_model->getById($id);
        $checklistItems = $this->ChecklistItem_model->getAllByChecklistId($checklist->id);

        if( $checklist && $checklist->company_id == $company_id ){

            $this->page_data['page']->title = 'Workorder Checklist';
		    $this->page_data['page']->parent = 'Sales';
            $this->page_data['checkListItems'] = $checklistItems;
            $this->page_data['checklist'] = $checklist;
            $this->page_data['checklistAttachType'] = $checklistAttachType;
            $this->load->view('v2/pages/workorder/checklist/edit_checklist', $this->page_data);

        }else{            
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

    public function ajax_update_checklist_item()
    {
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

    public function update_checklist()
    {
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
        if(!checkRoleCanAccessModule('work-orders', 'write')){
			show403Error();
			return false;
		}

        $this->load->model('AcsProfile_model');
        $this->load->library('session');
        $this->load->helper('functions');

		add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
			'assets/js/jquery.signaturepad.js'
        ]);

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

        $type = $this->input->get('type');
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);

        $termsCondi = $this->workorder_model->getWOTerms($company_id);
        if($termsCondi){
            $this->page_data['terms_conditions'] = $this->workorder_model->getWOtermsByID();
        }else{
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if($termsUse){
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        }else{
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }

        $checkListsHeader = $this->workorder_model->getchecklistHeaderByCompanyId($company_id);

        $checklists = array();
        foreach( $checkListsHeader as $h ){
            $checklistItems = $this->workorder_model->getchecklistHeaderItems($h->id);
            $checklists[$h->id]['header'] = ['name' => $h->checklist_name, 'id' => $h->id];
            $checklists[$h->id]['items']  = $checklistItems;            
        }

        //Settings
        $this->load->model('WorkorderSettings_model');
        $workorderSettings = $this->WorkorderSettings_model->getByCompanyId($company_id);
        if( $workorderSettings ){
            $prefix = $workorderSettings->work_order_num_prefix;
            $next_num = $workorderSettings->work_order_num_next;
        }else{
            $prefix = 'WO-';
            $lastInserted = $this->workorder_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next_num = $lastInserted->id + 1;
            }else{
                $next_num = 1;
            }
        }

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;
        $this->page_data['fieldsName'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
        $this->page_data['checklists'] = $checklists;
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();
        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);
        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        $this->page_data['getSettings'] = $this->workorder_model->getSettings($company_id);
        $this->page_data['page']->title = 'New Work Order';
		$this->page_data['page']->parent = 'Sales';
        // $this->load->view('workorder/addNewworkOrder', $this->page_data);
        $this->load->view('v2/pages/workorder/addNewworkOrder', $this->page_data);
    }

    public function addSolarWorkorder()
    {
        add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
			'assets/js/jquery.signaturepad.js'
        ]);

        $this->page_data['page']->title = 'Solar Stimulus Data Control / 2022 - 2024';
		$this->page_data['page']->parent = 'Sales';

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
        // $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);

        // $termsCondi = $this->workorder_model->getTerms($company_id);
        // if($termsCondi){
        //     // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        //     $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        // }else{
        //     // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        //     $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        // }

        $termsCondi = $this->workorder_model->getWOTerms($company_id);
        if($termsCondi){
            $this->page_data['terms_conditions'] = $this->workorder_model->getWOtermsByID();
        }else{
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        // $this->workorder_model->getWOtermsByID();

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if($termsUse){
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        }else{
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }

        $checkListsHeader = $this->workorder_model->getchecklistHeaderByCompanyId($company_id);

        $checkLists = array();
        foreach( $checkListsHeader as $h ){
            $checklistItems = $this->workorder_model->getchecklistHeaderItems($h->id);
            $checklists[] = ['header' => $h, 'items' => $checklistItems];
        }

        //Settings
        $this->load->model('WorkorderSettings_model');
        $workorderSettings = $this->WorkorderSettings_model->getByCompanyId($company_id);
        if( $workorderSettings ){
            $prefix = $workorderSettings->work_order_num_prefix;
            $next_num = $workorderSettings->work_order_num_next;
        }else{
            $prefix = 'WO-';
            $lastInserted = $this->workorder_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next_num = $lastInserted->id + 1;
            }else{
                $next_num = 1;
            }
        }

        $spt_query = array(
            'table' => 'ac_system_package_type',
            'order' => array(
                'order_by' => 'id',
            ),
            'select' => '*',
        );
        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;

        // print_r($this->page_data['terms_conditions']);
        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderSolarByID();
        //$this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['checklists'] = $checklists;
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        
        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        $this->page_data['getSettings'] = $this->workorder_model->getSettings($company_id);
        $this->page_data['ids'] = $this->workorder_model->getlastInsertID();

        $org_id = array('58','31');
            if($company_id == 58 || $company_id == 31)
            {
                // $workorder = $this->workorder_model->getFilterworkorderListMultiple($org_id, $filter); 
                $this->page_data['number'] = $this->workorder_model->getlastInsertMultiple($org_id);
            }else{
                $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);
            }
        

        $this->page_data['page_title'] = "Work Order";
        // print_r($this->page_data['lead_source']);

        // $this->load->view('workorder/addSolarWorkorder', $this->page_data);
        $this->load->view('v2/pages/workorder/addSolarWorkorder', $this->page_data);
    }

    public function workorderInstallation()
    {
        if(!checkRoleCanAccessModule('work-orders', 'write')){
			show403Error();
			return false;
		}

        add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
			'assets/js/jquery.signaturepad.js'
        ]);

        $this->page_data['page']->title = 'Alarm System Work Order Agreement';
		$this->page_data['page']->parent = 'Sales';

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

        $user_id    = logged('id');
        $company_id = logged('company_id');
        $this->load->library('session');

        $users_data = $this->session->all_userdata();
        $role = logged('role');
        $type = $this->input->get('type');

        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);

        $termsCondi = $this->workorder_model->getWOTerms($company_id);
        if($termsCondi){
            $this->page_data['terms_conditions'] = $this->workorder_model->getWOtermsByIDAgree();
        }else{
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

        $checkListsHeader = $this->workorder_model->getchecklistHeaderByCompanyId($company_id);

        $checkLists = array();
        foreach( $checkListsHeader as $h ){
            $checklistItems = $this->workorder_model->getchecklistHeaderItems($h->id);
            $checklists[] = ['header' => $h, 'items' => $checklistItems];
        }

        //Settings
        $this->load->model('WorkorderSettings_model');
        $workorderSettings = $this->WorkorderSettings_model->getByCompanyId($company_id);
        if( $workorderSettings ){
            $prefix = $workorderSettings->work_order_num_prefix;
            $next_num = $workorderSettings->work_order_num_next;
        }else{
            $prefix = 'WO-';
            $lastInserted = $this->workorder_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next_num = $lastInserted->id + 1;
            }else{
                $next_num = 1;
            }
        }

        $spt_query = array(
            'table' => 'ac_system_package_type',
            'order' => array(
                'order_by' => 'id',
            ),
            'where' => array(
                'company_id' => $company_id,
            ),
            'select' => '*',
        );
        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;
        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderInstallationByID();
        $this->page_data['checklists'] = $checklists;
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();
        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        $this->page_data['getSettings'] = $this->workorder_model->getSettings($company_id);

        $org_id = array('58','31');
        // if($company_id == 58 || $company_id == 31)
        // {
        //     // $workorder = $this->workorder_model->getFilterworkorderListMultiple($org_id, $filter); 
        //     $this->page_data['number'] = $this->workorder_model->getlastInsertMultiple($org_id);
        // }else{
            $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);
        // }
        

        $this->page_data['ids'] = $this->workorder_model->getlastInsertID();
        $this->page_data['page_title'] = "Work Order";
        $this->page_data['checklists'] = [];
        // $this->load->view('workorder/addWorkorderInstallation', $this->page_data);
        $this->load->view('v2/pages/workorder/addWorkorderInstallation', $this->page_data);
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
        $this->load->model('WorkorderSettings_model');
        $this->load->model('AcsAccess_model');
        $this->load->model('Customer_advance_model');

        $is_success = 0;
        $msg = '';

        $company_id     = getLoggedCompanyID();        
        $user_id        = logged('id');
        $hasID          = bin2hex(random_bytes(18));

        //$post = $this->input->post();        
        if( $this->input->post('grand_total') <= 0 ){
            $msg = 'Please select / add an item.';
            $json_data = ['is_success' => $is_success, 'msg' => $msg];
            echo json_encode($json_data);
            exit;
        }

        //Generate Workorder Number
        $setting = $this->WorkorderSettings_model->getByCompanyId($company_id);
        if( $setting ){
            $next_num = $setting->work_order_num_next;
            $prefix   = $setting->work_order_num_prefix;
        }else{
            $lastInsert = $this->workorder_model->getLastInsertByCompanyId($company_id);
            if( $lastInsert ){
                $next_num = $lastInsert->id + 1;
            }else{
                $next_num = 1;
            }
            $prefix = 'WO-';            
        }

        $wo_id = str_pad($next_num, 7, "0", STR_PAD_LEFT);
        $wo_id  = $prefix . $wo_id;

        $signatureFolderPath = "./uploads/workorders/signatures/".$company_id."/";        
        if (!file_exists($signatureFolderPath)) {
            mkdir($signatureFolderPath, 0777, true);
        }

        if(!empty($this->input->post('company_representative_approval_signature1aM_web')))
        {
            $datasig            = $this->input->post('company_representative_approval_signature1aM_web');            
            $image_parts        = explode(";base64,", $datasig);
            $image_type_aux     = explode("image/", $image_parts[0]);
            $image_type         = $image_type_aux[1];
            $image_base64       = base64_decode($image_parts[1]);
            $file_save          = $wo_id.'_company'.'.'.$image_type;
            $file               = $signatureFolderPath . $file_save;            
            file_put_contents($file, $image_base64);
        }
        else
        {
            $file_save          = NULL;
        }

        if(!empty($this->input->post('primary_representative_approval_signature1aM_web')))
        {
            $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
            $image_parts2       = explode(";base64,", $datasig2);
            $image_type_aux2    = explode("image/", $image_parts2[0]);
            $image_type2        = $image_type_aux2[1];
            $image_base642      = base64_decode($image_parts2[1]);
            $file2_save         = $wo_id.'_primary'.'.'.$image_type2;
            $file2              = $signatureFolderPath . $file2_save;            
            file_put_contents($file2, $image_base642);
        }
        else
        {
            $file2_save          = NULL;
        }

        if(!empty($this->input->post('secondary_representative_approval_signature1aM_web')))
        {
            $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
            $image_parts3       = explode(";base64,", $datasig3);
            $image_type_aux3    = explode("image/", $image_parts3[0]);
            $image_type3        = $image_type_aux3[1];
            $image_base643      = base64_decode($image_parts3[1]);
            $file3_save         = $wo_id.'_secondary'.'.'.$image_type3;
            $file3              = $signatureFolderPath . $file3_save;            
            file_put_contents($file3, $image_base643);
        }
        else
        {
            $file3_save          = NULL;
        }

        $attachmentFolderPath = "./uploads/workorders/attachments/".$company_id."/";            
        if(!file_exists($attachmentFolderPath)) {
            mkdir($attachmentFolderPath, 0777, true);
        }

        if(isset($_FILES['attachment_photo']) && $_FILES['attachment_photo']['tmp_name'] != '') {
            $tmp_name  = $_FILES['attachment_photo']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['attachment_photo']['name'])));
            $attachment_photo = $wo_id."_photo_".basename($_FILES["attachment_photo"]["name"]);
            move_uploaded_file($tmp_name, $attachmentFolderPath.$attachment_photo);
        }

        $attachment_document = '';
        if(isset($_FILES['attachment_document']) && $_FILES['attachment_document']['tmp_name'] != '') {
            $target_dir = "./uploads/workorders/$user_id/";            
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['attachment_document']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['attachment_document']['name'])));
            $attachment_document = $wo_id."_document_" . basename($_FILES["attachment_document"]["name"]);
            move_uploaded_file($tmp_name, $attachmentFolderPath.$attachment_document);
        }

        $action = $this->input->post('action');
        //if($action == 'submit') {

            $dateIssued = date('Y-m-d', strtotime($this->input->post('schedule_date_given')));
            $post_checklists = $this->input->post('checklists');
            $selected_checklists = "";
            if( $post_checklists ){
                $selected_checklists = serialize($post_checklists);                
            }

            $new_data = array(
                'work_order_number'                     => $wo_id,
                'customer_id'                           => $this->input->post('customer_id'),
                'security_number'                       => $this->input->post('security_number'),
                'birthdate'                             => $this->input->post('birthdate'),
                'phone_number'                          => $this->input->post('phone_number'),
                'mobile_number'                         => $this->input->post('mobile_number'),
                'email'                                 => $this->input->post('email'),
                'checklists'                            => $selected_checklists,            
                'business_name'                         => $this->input->post('business_name'),
                // 'job_location'                          => $this->input->post('job_location') .', ' .$this->input->post('city') .', '. $this->input->post('state') .', '. $this->input->post('zip_code') .', '. $this->input->post('cross_street'),
                'job_location'                          => $this->input->post('job_location'),
                'city'                                  => $this->input->post('city'),
                'state'                                 => $this->input->post('state'),
                'zip_code'                              => $this->input->post('zip_code'),
                'cross_street'                          => $this->input->post('cross_street'),
                'password'                              => $this->input->post('password'),
                'offer_code'                            => $this->input->post('offer_code'),//
                'tags'                                  => $this->input->post('job_tag'),
                'date_issued'                           => $dateIssued,
                'job_type'                              => $this->input->post('job_type'),
                'job_name'                              => $this->input->post('job_name'),
                'job_description'                       => $this->input->post('job_description'),
                'payment_method'                        => $this->input->post('payment_method'),
                'payment_amount'                        => $this->input->post('payment_amount'),
                'lead_source_id'                        => $this->input->post('lead_source'),
                // 'hash_id'                               => $hasID,
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

                //'agent_id'                              => $this->input->post('agent_id'), //Added by Bryann Revina

                //signature
                'company_representative_signature'      => $file_save,
                'company_representative_name'           => $this->input->post('company_representative_printed_name'),
                'primary_account_holder_signature'      => $file2_save,
                'primary_account_holder_name'           => $this->input->post('primary_account_holder_name'),
                'secondary_account_holder_signature'    => $file3_save,
                'secondary_account_holder_name'         => $this->input->post('secondery_account_holder_name'),
                'company_representative_sign_date'      => date("Y-m-d"),
                'primary_account_holder_sign_date'      => date("Y-m-d"),
                'secondary_account_holder_sign_date'    => date("Y-m-d"),

                // 'company_representative_signature' => 'company_representative_signature',
                // 'company_representative_name' => 'company_representative_name',
                // 'primary_account_holder_signature' => 'primary_account_holder_signature',
                // 'primary_account_holder_name' => 'primary_account_holder_name',
                // 'secondary_account_holder_signature' => 'secondary_account_holder_signature',
                // 'secondary_account_holder_name' => 'secondary_account_holder_name',
                

                //attachment
                // 'attached_photo' => $this->input->post('attached_photo'),
                // 'document_links' => $this->input->post('document_links'),
                'attached_photo'                        => $attachment_photo,
                'document_links'                        => $attachment_document,

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
                'work_order_type_id'                    => '1',
                'industry_template_id'                  => '0'
            );

            $addQuery = $this->workorder_model->save_workorder($new_data);

            //Auto convert lead to customer
            if( $this->input->post('cust_lead') == 'Lead' ){
                //Check if lead is already converted
                $lead = $this->Customer_advance_model->getLeadByLeadId($this->input->post('customer_id'));
                if( $lead ){
                    if( $lead->prof_id > 0 ){
                        //Update workorder                        
                        $this->workorder_model->update($addQuery, ['customer_id' => $lead->prof_id]);
                    }else{
                        //Convert to customer and update workorder
                        $result = $this->Customer_advance_model->convertLeadToCustomer($this->input->post('customer_id'),$company_id, $user_id);
                        if( $result['is_converted'] == 1 ){
                            $this->workorder_model->update($addQuery, ['customer_id' => $result['prof_id']]);
                        }
                    }
                }
            }

            //Update workorder setting
            if( $setting ){
                $workorder_setting = ['work_order_num_next' => $next_num + 1];
                $this->WorkorderSettings_model->update($setting->id, $workorder_setting);
            }

            //SMS Notification        
            createCronAutoSmsNotification($company_id, $addQuery, 'workorder', $this->input->post('status'), $user_id, 0, $user_id);        

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
                    'account_number'            => $this->input->post('account_number'),
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

            //Auto update customer info
            $this->load->model('AcsProfile_model');
            $customer = $this->AcsProfile_model->getByProfId($this->input->post('customer_id'));
            if( $customer ){
                $phone_h = $customer->phone_h;
                if( $this->input->post('phone_number') != '' ){
                    $phone_h = $this->input->post('phone_number');
                }

                $phone_m = $customer->phone_m;
                if( $this->input->post('mobile_number') != '' ){
                    $phone_m = $this->input->post('mobile_number');
                }

                $ssn = $customer->ssn;
                if( $this->input->post('security_number') != '' ){
                    $ssn = $this->input->post('security_number');
                }

                $date_of_birth = date("Y-m-d", strtotime($customer->date_of_birth));
                if( $this->input->post('birthdate') != '' ){
                    $date_of_birth = $this->input->post('birthdate');
                }

                $email = $customer->email;
                if( $this->input->post('email') != '' ){
                    $email = $this->input->post('email');
                }

                $business_name = $customer->business_name;
                if( $this->input->post('business_name') != '' ){
                    $business_name = $this->input->post('business_name');
                }

                $cross_street = $customer->cross_street;
                if( $this->input->post('cross_street') != '' ){
                    $cross_street = $this->input->post('cross_street');
                }

                $city = $customer->city;
                if( $this->input->post('city') != '' ){
                    $city = $this->input->post('city');
                }

                $state = $customer->state;
                if( $this->input->post('state') != '' ){
                    $state = $this->input->post('state');
                }

                $zip_code = $customer->zip_code;
                if( $this->input->post('zip_code') != '' ){
                    $zip_code = $this->input->post('zip_code');
                }

                $customer_data = [
                    'phone_h' => $phone_h,
                    'phone_m' => $phone_m,
                    'ssn' => $ssn,
                    'date_of_birth' => $date_of_birth,
                    'email' => $email,
                    'business_name' => $business_name,
                    'cross_street' => $cross_street,
                    'city' => $city,
                    'state' => $state,
                    'zip_code' => $zip_code
                ];
                $this->AcsProfile_model->updateCustomerByProfId($customer->prof_id, $customer_data);

                $access_data = ['access_password' => $this->input->post('password')];
                $this->AcsAccess_model->updateByProfId($customer->prof_id, $access_data);

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
                $a          = $this->input->post('item_id');
                $packageID  = $this->input->post('packageID');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $h          = $this->input->post('tax');
                $discount   = $this->input->post('discount');
                $total      = $this->input->post('total');

                if( $a ){
                    $i = 0;
                    foreach($a as $row){
                        if ($a[$i] == 0) {
                            continue;
                        }

                        $data['items_id']       = $a[$i];
                        $data['package_id ']    = $packageID[$i];
                        $data['qty']            = $quantity[$i];
                        $data['cost']           = $price[$i];
                        $data['tax']            = $h[$i];
                        $data['discount']       = $discount[$i];
                        $data['total']          = $total[$i];
                        $data['work_order_id '] = $addQuery;
                        $addQuery2 = $this->workorder_model->add_work_order_details($data);
                        $i++;
                    }
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
                $is_success   = 1;
                $msg = '';
                
                // if (!is_null($this->input->get('json', TRUE))) {
                //     header('content-type: application/json');
                //     exit(json_encode(['id' => $addQuery]));
                // } else {
                //     redirect('workorder');
                // }
            }
        //}        
        
        // if($action == 'preview') {
        //     $dataaa = $this->input->post('workorder_number');
        //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        //     $this->load->library('pdf');
        //     $html = $this->load->view('workorder/preview', [], true);
        //     $this->pdf->createPDF($html, 'mypdf', false);
        //     exit(0);
        // }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function savenewInvoiceWorkorder(){
        $company_id     = getLoggedCompanyID();
        // $user_id        = getLoggedUserID();
        $user_id = logged('id');
        $hasID = bin2hex(random_bytes(18));

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
            $file_save          = 'uploads/Signatures/1/' . $wo_id . '_company' . '.'.$image_type;
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
            $file2_save         = 'uploads/Signatures/1/' . $wo_id . '_primary' . '.'.$image_type2;
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
            $file3_save         = 'uploads/Signatures/1/' . $wo_id . '_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else
        {
            $file3_save          = NULL;
        }


        $action = $this->input->post('action');
        if($action == 'submit') {

            $dateIssued = date('Y-m-d', strtotime($this->input->post('schedule_date_given')));

        $new_data = array(
            
            'work_order_number'                     => $this->input->post('workorder_number'),
            'customer_id'                           => $this->input->post('customer_id'),
            'security_number'                       => $this->input->post('security_number'),
            'invoice_number'                        => $this->input->post('invoice_number'),
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
            'date_issued'                           => $dateIssued,
            'job_type'                              => $this->input->post('job_type'),
            'job_name'                              => $this->input->post('job_name'),
            'job_description'                       => $this->input->post('job_description'),
            'payment_method'                        => $this->input->post('payment_method'),
            'payment_amount'                        => $this->input->post('payment_amount'),
            'lead_source_id'                        => $this->input->post('lead_source'),
            // 'hash_id'                               => $hasID,
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
            'work_order_type_id'                    => '1',
            'industry_template_id'                  => '0'
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
                $packageID  = $this->input->post('packageID');
                $quantity   = $this->input->post('quantity');
                $price      = $this->input->post('price');
                $h          = $this->input->post('tax');
                $discount   = $this->input->post('discount');
                $total      = $this->input->post('total');

                $i = 0;
                foreach($a as $row){
                    $data['items_id']       = $a[$i];
                    $data['package_id ']    = $packageID[$i];
                    $data['qty']            = $quantity[$i];
                    $data['cost']           = $price[$i];
                    $data['tax']            = $h[$i];
                    $data['discount']       = $discount[$i];
                    $data['total']          = $total[$i];
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

    public function createPackage()
    {
        $item               = $this->input->post('item');
        $type               = $this->input->post('type');
        $quantity           = $this->input->post('quantity');
        $price              = $this->input->post('price');
        $package_price      = $this->input->post('package_price');
        $package_name       = $this->input->post('package_name');
        $package_price_set  = $this->input->post('package_price_set');

        $company_id = logged('company_id');
        $user_id = logged('id');

        //     $checklist = $this->workorder_model->getchecklistdetailsajax($id);

            // $this->page_data['item'] = $item;
            // $this->page_data['checklists_items'] = $checklist;
            $datafirst = array(
                'name'          => $package_name,
                'package_type'  => '1',
                'total_price'   => $package_price,
                'amount_set'    => $package_price_set,
                'company_id'    => $company_id,
                'created_by'    => $user_id,
                'created_at'    => date("Y-m-d H:i:s"),
            );
    
            $dataQuery = $this->workorder_model->addPackage($datafirst);

            $i = 0;
                foreach($item as $row){
                    $data['item_id']            = $item[$i];
                    $data['package_id ']        = $dataQuery;
                    $data['package_type']       = '1';
                    $data['price']              = $price[$i];
                    $data['item_type']          = $type[$i];
                    $data['quantity']           = $quantity[$i];
                    // $data['created_by']         = $user_id;
                    // $data['company_id']         = $company_id;
                    // $data['created_at']         = date("Y-m-d H:i:s");
                    $addQuery2 = $this->workorder_model->addItemPackage($data);
                    
                    // echo json_encode($data);
                    $i++;
                }

                $details = $this->workorder_model->getPackageDetails($dataQuery);
                $pName = $this->workorder_model->getPackageName($dataQuery);

                $this->page_data['details'] = $details;
                $this->page_data['pName'] = $pName;
        
                // echo json_encode($this->page_data);
                echo json_encode($this->page_data);

    }

    public function getPackageItemsById()
    {
        // $packId = $this->input->post('packId');

        $items = $this->workorder_model->getPackageItemsById();
        $this->page_data['pItems'] = $items;

        echo json_encode($this->page_data);
    }

    public function getPackageById()
    {
        $items = $this->workorder_model->getPackageById();
        $this->page_data['pName'] = $items;

        echo json_encode($this->page_data);
    }

    public function addNewPackageToList()
    {        

        $dataQuery = $this->input->post('packId');

        $details = $this->workorder_model->getPackageDetails($dataQuery);
        $pName = $this->workorder_model->getPackageName($dataQuery);

        $this->page_data['details'] = $details;
        $this->page_data['pName'] = $pName;

        // echo json_encode($this->page_data);
        echo json_encode($this->page_data);
    }

    public function duplicate_workorder()
    {
        $this->load->model('WorkorderSettings_model');

        $is_success = 0;
        $msg = 'Cannot find data';
        $wid = 0;

        $company_id     = getLoggedCompanyID();
        $user_id        = logged('id');
        $wo_num         = $this->input->post('wo_num');

        $datas      = $this->workorder_model->getDataByWO($wo_num);        
        if( $datas && $datas->company_id == $company_id ){
            $clone_id   = $this->workorder_model->cloneData($datas);
            $clonedData = $this->workorder_model->getDataByWO($clone_id);
            $wid = $clonedData->id;

            //Generate Workorder Number
            $setting = $this->WorkorderSettings_model->getByCompanyId($company_id);
            if( $setting ){
                $next_num = $setting->work_order_num_next;
                $prefix   = $setting->work_order_num_prefix;
            }else{
                $lastInsert = $this->workorder_model->getLastInsertByCompanyId($company_id);
                if( $lastInsert ){
                    $next_num = $lastInsert->id + 1;
                }else{
                    $next_num = 1;
                }
                $prefix = 'WO-';            
            }

            $wo_id = str_pad($next_num, 7, "0", STR_PAD_LEFT);
            $work_order_number  = $prefix . $wo_id;
            $this->workorder_model->update($clonedData->id, ['work_order_number' => $work_order_number]);

            customerAuditLog($user_id, $datas->customer_id, $wo_num, 'Workorder', 'Cloned workorder #'.$datas->work_order_number);

            //Update workorder setting
            if( $setting ){
                $workorder_setting = ['work_order_num_next' => $next_num + 1];
                $this->WorkorderSettings_model->update($setting->id, $workorder_setting);
            }

            //Get Workorder items
            $workorderItems = $this->workorder_model->getworkorderItems($datas->id);
            foreach( $workorderItems as $i ){
                $data_items = [
                    'work_order_id' => $clonedData->id,
                    'items_id' => $i->items_id,
                    'package_id' => $i->package_id,
                    'qty' => $i->qty,
                    'cost' => $i->cost,
                    'tax' => $i->tax,
                    'discount' => $i->discount,
                    'total' => $i->total
                ];
                
                $this->workorder_model->add_work_order_details($data_items);
            }

            //Activity Logs
            $activity_name = 'Work Order : Created work order number ' . $work_order_number . ' - cloned from work order number : ' . $clonedData->work_order_number; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }            

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'wid' => $wid
        ];

        echo json_encode($return);
    }

    public function ajax_update_workorder(){
        $this->load->model('WorkorderSettings_model');

        $is_success = 0;
        $msg = '';

        $company_id     = getLoggedCompanyID();        
        $user_id        = logged('id');
        $hasID          = bin2hex(random_bytes(18));

        $workorder = $this->workorder_model->getById($this->input->post('wid'));
        if( empty($workorder) ){
            $msg = 'Cannot find workorder data.';
            $json_data = ['is_success' => $is_success, 'msg' => $msg];
            echo json_encode($json_data);
            exit;
        }

        if( $this->input->post('grand_total') <= 0 ){
            $msg = 'Please select / add an item.';
            $json_data = ['is_success' => $is_success, 'msg' => $msg];
            echo json_encode($json_data);
            exit;
        }        

        $signatureFolderPath = "./uploads/workorders/signatures/".$company_id."/";        
        if (!file_exists($signatureFolderPath)) {
            mkdir($signatureFolderPath, 0777, true);
        }

        $file_save = $workorder->company_representative_signature;
        if(!empty($this->input->post('company_representative_approval_signature1aM_web')))
        {
            $datasig            = $this->input->post('company_representative_approval_signature1aM_web');            
            $image_parts        = explode(";base64,", $datasig);
            $image_type_aux     = explode("image/", $image_parts[0]);
            $image_type         = $image_type_aux[1];
            $image_base64       = base64_decode($image_parts[1]);
            $file_save          = $wo_id.'_company'.'.'.$image_type;
            $file               = $signatureFolderPath . $file_save;            
            file_put_contents($file, $image_base64);
        }

        $file2_save = $workorder->primary_account_holder_signature;
        if(!empty($this->input->post('primary_representative_approval_signature1aM_web')))
        {
            $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
            $image_parts2       = explode(";base64,", $datasig2);
            $image_type_aux2    = explode("image/", $image_parts2[0]);
            $image_type2        = $image_type_aux2[1];
            $image_base642      = base64_decode($image_parts2[1]);
            $file2_save         = $wo_id.'_primary'.'.'.$image_type2;
            $file2              = $signatureFolderPath . $file2_save;            
            file_put_contents($file2, $image_base642);
        }

        $file3_save = $workorder->secondary_account_holder_signature;
        if(!empty($this->input->post('secondary_representative_approval_signature1aM_web')))
        {
            $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
            $image_parts3       = explode(";base64,", $datasig3);
            $image_type_aux3    = explode("image/", $image_parts3[0]);
            $image_type3        = $image_type_aux3[1];
            $image_base643      = base64_decode($image_parts3[1]);
            $file3_save         = $wo_id.'_secondary'.'.'.$image_type3;
            $file3              = $signatureFolderPath . $file3_save;            
            file_put_contents($file3, $image_base643);
        }

        $attachmentFolderPath = "./uploads/workorders/attachments/".$company_id."/";            
        if(!file_exists($attachmentFolderPath)) {
            mkdir($attachmentFolderPath, 0777, true);
        }

        $attachment_photo = $workorder->attachment_photo;
        if(isset($_FILES['attachment_photo']) && $_FILES['attachment_photo']['tmp_name'] != '') {
            $tmp_name  = $_FILES['attachment_photo']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['attachment_photo']['name'])));
            $attachment_photo = $workorder->work_order_number."_photo_".basename($_FILES["attachment_photo"]["name"]);
            move_uploaded_file($tmp_name, $attachmentFolderPath.$attachment_photo);
        }

        $attachment_document = $workorder->attachment_document;
        if(isset($_FILES['attachment_document']) && $_FILES['attachment_document']['tmp_name'] != '') {
            $target_dir = "./uploads/workorders/$user_id/";            
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['attachment_document']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['attachment_document']['name'])));
            $attachment_document = $workorder->work_order_number."_document_" . basename($_FILES["attachment_document"]["name"]);
            move_uploaded_file($tmp_name, $attachmentFolderPath.$attachment_document);
        }

        $dateIssued = date('Y-m-d', strtotime($this->input->post('schedule_date_given')));
        $post_checklists = $this->input->post('checklists');
        $selected_checklists = "";
        if( $post_checklists ){
            $selected_checklists = serialize($post_checklists);                
        }

        $workoder_data = array(
            'customer_id'                           => $this->input->post('customer_id'),
            'security_number'                       => $this->input->post('security_number'),
            'birthdate'                             => $this->input->post('birthdate'),
            'phone_number'                          => $this->input->post('phone_number'),
            'mobile_number'                         => $this->input->post('mobile_number'),
            'email'                                 => $this->input->post('email'),
            'checklists'                            => $selected_checklists,            
            'business_name'                         => $this->input->post('business_name'),
            'job_location'                          => $this->input->post('job_location'),
            'city'                                  => $this->input->post('city'),
            'state'                                 => $this->input->post('state'),
            'zip_code'                              => $this->input->post('zip_code'),
            'cross_street'                          => $this->input->post('cross_street'),
            'password'                              => $this->input->post('password'),
            'offer_code'                            => $this->input->post('offer_code'),//
            'tags'                                  => $this->input->post('job_tag'),
            'date_issued'                           => $dateIssued,
            'job_type'                              => $this->input->post('job_type'),
            'job_name'                              => $this->input->post('job_name'),
            'job_description'                       => $this->input->post('job_description'),
            'payment_method'                        => $this->input->post('payment_method'),
            'payment_amount'                        => $this->input->post('payment_amount'),
            'lead_source_id'                        => $this->input->post('lead_source'),
            'terms_and_conditions'                  => $this->input->post('terms_conditions'),
            'status'                                => $this->input->post('status'),
            'priority'                              => $this->input->post('priority'),
            'po_number'                             => $this->input->post('purchase_order_number'),
            'terms_of_use'                          => $this->input->post('terms_of_use'),
            'instructions'                          => $this->input->post('instructions'),
            'header'                                => $this->input->post('header'),
            'company_representative_signature'      => $file_save,
            'company_representative_name'           => $this->input->post('company_representative_printed_name'),
            'primary_account_holder_signature'      => $file2_save,
            'primary_account_holder_name'           => $this->input->post('primary_account_holder_name'),
            'secondary_account_holder_signature'    => $file3_save,
            'secondary_account_holder_name'         => $this->input->post('secondery_account_holder_name'),
            'company_representative_sign_date'      => date("Y-m-d"),
            'primary_account_holder_sign_date'      => date("Y-m-d"),
            'secondary_account_holder_sign_date'    => date("Y-m-d"),
            'attached_photo'                        => $attachment_photo,
            'document_links'                        => $attachment_document,
            'subtotal'                              => $this->input->post('subtotal'),
            'taxes'                                 => $this->input->post('taxes'), 
            'adjustment_name'                       => $this->input->post('adjustment_name'),
            'adjustment_value'                      => $this->input->post('adjustment_value'),
            'voucher_value'                         => $this->input->post('voucher_value'),
            'grand_total'                           => $this->input->post('grand_total'),
            'employee_id'                           => $user_id,
            'date_updated'                          => date("Y-m-d H:i:s")
        );

        $addQuery = $this->workorder_model->update($workorder->id, $workoder_data);

        //Activity Logs
        $activity_name = 'Updated Workorder Number : ' . $workorder->work_order_number; 
        createActivityLog($activity_name);
        
        //SMS Notification        
        createCronAutoSmsNotification($company_id, $addQuery, 'workorder', $this->input->post('status'), $user_id, 0, $user_id);        

        $cf_name = $this->input->post('custom_field');
        $cf_value = $this->input->post('custom_value');
        
        $this->workorder_model->delete_custom_fields($workorder->id);
        if( $cf_name ){
            foreach($cf_name as $key => $value){
                $custom_field_data = [
                    'name' => $value,
                    'value' => $cf_value[$key],
                    'work_order_id' => $workorder->id,
                    'company_id' => $company_id,
                    'date_added' => date("Y-m-d H:i:s")
                ];
                $this->workorder_model->additem_details($custom_field_data);
            }
        }

        //Auto update customer info
        $this->load->model('AcsProfile_model');
        $customer = $this->AcsProfile_model->getByProfId($this->input->post('customer_id'));
        if( $customer ){
            $phone_h = $customer->phone_h;
            if( $this->input->post('phone_number') != '' ){
                $phone_h = $this->input->post('phone_number');
            }

            $phone_m = $customer->phone_m;
            if( $this->input->post('phone_number') != '' ){
                $phone_m = $this->input->post('mobile_number');
            }

            $ssn = $customer->ssn;
            if( $this->input->post('security_number') != '' ){
                $ssn = $this->input->post('security_number');
            }

            $date_of_birth = date("Y-m-d", strtotime($customer->date_of_birth));
            if( $this->input->post('birthdate') != '' ){
                $date_of_birth = $this->input->post('birthdate');
            }

            $email = $customer->email;
            if( $this->input->post('email') != '' ){
                $email = $this->input->post('email');
            }

            $business_name = $customer->business_name;
            if( $this->input->post('business_name') != '' ){
                $business_name = $this->input->post('business_name');
            }

            $cross_street = $customer->cross_street;
            if( $this->input->post('cross_street') != '' ){
                $cross_street = $this->input->post('cross_street');
            }

            $city = $customer->city;
            if( $this->input->post('city') != '' ){
                $city = $this->input->post('city');
            }

            $state = $customer->state;
            if( $this->input->post('state') != '' ){
                $state = $this->input->post('state');
            }

            $zip_code = $customer->zip_code;
            if( $this->input->post('zip_code') != '' ){
                $zip_code = $this->input->post('zip_code');
            }

            $customer_data = [
                'phone_h' => $phone_h,
                'phone_m' => $phone_m,
                'ssn' => $ssn,
                'date_of_birth' => $date_of_birth,
                'email' => $email,
                'business_name' => $business_name,
                'cross_street' => $cross_street,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zip_code
            ];

            $this->AcsProfile_model->updateCustomerByProfId($customer->prof_id, $customer_data);

        }

        $items      = $this->input->post('itemid');
        $packageID  = $this->input->post('packageID');
        $quantity   = $this->input->post('quantity');
        $price      = $this->input->post('price');
        $tax        = $this->input->post('tax');
        $discount   = $this->input->post('discount');
        $total      = $this->input->post('total');

        $this->workorder_model->delete_items($workorder->id);
        if( $items ){
            foreach($items as $key => $value){
                $package_id = 0;
                if( isset($packageID[$key]) ){
                    $package_id = $packageID[$key];
                }
    
                $items = [
                    'items_id' => $value,      
                    'package_id' => $package_id,
                    'qty' => $quantity[$key],
                    'cost' => $price[$key],
                    'tax' => $tax[$key],
                    'discount' => $discount[$key],
                    'total' => $total[$key],
                    'work_order_id' => $workorder->id
                ];   
                $this->workorder_model->add_work_order_details($items);
            }
        }        

        $getname = $this->workorder_model->getname($user_id);

        $notif = array(
    
            'user_id'               => $user_id,
            'title'                 => 'Updated Work Order',
            'content'               => $getname->FName. ' has updated Work Order.'. $workorder->work_order_number,
            'date_created'          => date("Y-m-d H:i:s"),
            'status'                => '1',
            'company_id'            => $company_id
        );

        $notification = $this->workorder_model->save_notification($notif);

        $is_success   = 1;
        $msg = '';
        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function UpdateWorkorder(){
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $id = $this->input->post('wo_id');
        $wo_id = $this->input->post('workorder_number');
        $workorder = $this->workorder_model->getById($id);

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
            $file_save          = 'uploads/Signatures/1/'. $rand1 . $wo_id . '_company' . '.'.$image_type;
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
            $file2_save         = 'uploads/Signatures/1/'. $rand2 . $wo_id . '_primary' . '.'.$image_type2;
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
            $file3_save         = 'uploads/Signatures/1/'. $rand3 . $wo_id . '_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else{
            $three = $this->workorder_model->getById($id);
            $file3_save = $three->secondary_account_holder_signature;
        }
        

        // $action = $this->input->post('action');
        // if($action == 'submit') {

        $attachment_photo = $workorder->attachment_photo;
        if(isset($_FILES['attachment_photo']) && $_FILES['attachment_photo']['tmp_name'] != '') {
            $target_dir = "./uploads/workorders/$user_id/";            
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['attachment_photo']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['attachment_photo']['name'])));
            $attachment_photo = "photo_" . basename($_FILES["attachment_photo"]["name"]);
            move_uploaded_file($tmp_name, "./uploads/workorders/$user_id/$attachment_photo");
        }

        $attachment_document = $workorder->attachment_document;
        if(isset($_FILES['attachment_document']) && $_FILES['attachment_document']['tmp_name'] != '') {
            $target_dir = "./uploads/workorders/$user_id/";            
            if(!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $tmp_name = $_FILES['attachment_document']['tmp_name'];
            $extension = strtolower(end(explode('.',$_FILES['attachment_document']['name'])));
            $attachment_document = "document_" . basename($_FILES["attachment_document"]["name"]);
            move_uploaded_file($tmp_name, "./uploads/workorders/$user_id/$attachment_document");
        }

        $dateIssued = date('Y-m-d', strtotime($this->input->post('schedule_date_given')));
        $post_checklists = $this->input->post('checklists');
        $selected_checklists = "";
        if( $post_checklists ){
            $selected_checklists = serialize($post_checklists);                
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
            'checklists'            => $selected_checklists,
            'job_location'          => $this->input->post('job_location'),
            'city'                  => $this->input->post('city'),
            'state'                 => $this->input->post('state'),
            'zip_code'              => $this->input->post('zip_code'),
            'cross_street'          => $this->input->post('cross_street'),
            'password'              => $this->input->post('password'),
            'offer_code'            => $this->input->post('offer_code'),//
            'tags'                  => $this->input->post('job_tag'),
            'date_issued'           => $dateIssued,
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
            'attached_photo'        => $attachment_photo,
            'document_links'        => $attachment_document,

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

        //SMS Notification
        createCronAutoSmsNotification($company_id, $addQuery, 'workorder', $this->input->post('status'), $user_id, 0, $user_id);
        

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
                'account_number'    => $this->input->post('account_number'),
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
        // }
    
        // if($action == 'preview') {
        //     $dataaa = $this->input->post('workorder_number');
        //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        //     $this->load->library('pdf');
        //     $html = $this->load->view('workorder/preview', [], true);
        //     $this->pdf->createPDF($html, 'mypdf', false);
        //     exit(0);

        // }
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
            $file_save          = 'uploads/Signatures/1/'. $rand1 . $wo_id . '_alarm_company' . '.'.$image_type;
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
            $file2_save         = 'uploads/Signatures/1/'. $rand2 . $wo_id . '_alarm_primary' . '.'.$image_type2;
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
            $file3_save         = 'uploads/Signatures/1/'. $rand3 . $wo_id . '_alarm_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else{
            $three = $this->workorder_model->getById($id);
            $file3_save = $three->secondary_account_holder_signature;
        }
        
        $action = $this->input->post('action');
        if($action == 'Submit') {
            $dateIssued = date('Y-m-d', strtotime($this->input->post('schedule_date_given')));

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
            // 'company_id'                => $company_id,
        );

        $w_acs = $this->workorder_model->update_acs_alarm($acs);

        $custID = $this->input->post('acs_id');

        $deleteContacts =  $this->workorder_model->deleteContacts($custID);

        
        $ainame         = $this->input->post('1st_verification_name');
        $number_type    = $this->input->post('1st_number_type');
        $phonev         = $this->input->post('1st_number');
        $relation       = $this->input->post('1st_relation');

        // dd($ainame);

        $ai = 0;
        foreach($ainame as $row3){
            $datav['name']          = $ainame[$ai];
            $datav['phone_type']    = $number_type[$ai];
            $datav['phone']         = $phonev[$ai];
            $datav['relation']      = $relation[$ai];
            $datav['customer_id']   = $custID;
            $save_contactv          = $this->workorder_model->save_contact_new($datav);
            $ai++;
        }
        
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
            'date_issued'           => $dateIssued,
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

            'job_name'                              => $this->input->post('job_name'),
            'job_description'                       => $this->input->post('job_description'),
            'instructions'                          => $this->input->post('instructions'),

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

        $objWorkOrder = $this->workorder_model->getDataByWO($this->input->post('wo_id_alarm'));
        if( $objWorkOrder ){
            customerAuditLog(logged('id'), $objWorkOrder->customer_id, $objWorkOrder->id, 'Workorder', 'Updated workorder #'.$objWorkOrder->work_order_number);
        }        

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

        if (!is_null($this->input->get('json', TRUE))) {
            header('content-type: application/json');
            exit(json_encode(['id' => $addQuery]));
        } else {
            redirect('workorder');
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

    public function delete_workorder()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $id = $this->input->post('id');
        $cid = logged('company_id');

        $workOrder = $this->workorder_model->getDataByWO($id);
        if( $workOrder && $workOrder->company_id == $cid ){    
            $data = array(
                'id' => $id,
                'view_flag' => '1',
            );
            $this->workorder_model->deleteWorkorder($data);

            $is_success = 1;
            $msg = '';

            //Activity Logs            
            $activity_name = 'Workorders : Deleted workorder number ' . $workOrder->work_order_number; 
            createActivityLog($activity_name);

            customerAuditLog(logged('id'), $workOrder->customer_id, $workOrder->id, 'Workorder', 'Deleted work order #'.$workOrder->work_order_number);
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function delete_selected_workorders()
    {
        $is_success = false;

        $ids = $this->input->post('ids');

        foreach ($ids as $id) {
            $workOrder = $this->workorder_model->getDataByWO($id);
            
            if ($workOrder) {
                $data = array(
                    'id' => $id,
                    'view_flag' => '1',
                );

                $is_success = $this->workorder_model->deleteWorkorder($data);

                customerAuditLog(logged('id'), $workOrder->customer_id, $workOrder->id, 'Workorder', 'Deleted work order #' . $workOrder->work_order_number);
            }
        }

        echo json_encode($is_success);
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

        }elseif(empty($check))
        {
            $data = array(
                'work_order_template_id' => $template_id,
                'company_id' => $company_id,
            );
            $dataQuery = $this->workorder_model->addTemplate($data);

        }
        else{
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

        //Settings
        $this->load->model('WorkorderSettings_model');
        $workorderSettings = $this->WorkorderSettings_model->getByCompanyId($company_id);
        if( $workorderSettings ){
            $prefix = $workorderSettings->work_order_num_prefix;
            $next_num = $workorderSettings->work_order_num_next;
        }else{
            $prefix = 'WO-';
            $lastInserted = $this->workorder_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next_num = $lastInserted->id + 1;
            }else{
                $next_num = 1;
            }
        }

        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;


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
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        $this->page_data['getPackageItems'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        
        $this->load->view('workorder/NewworkOrderAlarm', $this->page_data);
    }

    public function NewworkOrderAlarmnew()
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

        //Settings
        $this->load->model('WorkorderSettings_model');
        $workorderSettings = $this->WorkorderSettings_model->getByCompanyId($company_id);
        if( $workorderSettings ){
            $prefix = $workorderSettings->work_order_num_prefix;
            $next_num = $workorderSettings->work_order_num_next;
        }else{
            $prefix = 'WO-';
            $lastInserted = $this->workorder_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next_num = $lastInserted->id + 1;
            }else{
                $next_num = 1;
            }
        }

        $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;


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
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        $this->page_data['getPackageItems'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        
        $this->load->view('workorder/NewworkOrderAlarmNew', $this->page_data);
    }

    public function savenewWorkorderAlarm()
    {

        
        // $test         = $this->input->post('1st_verification_name');
        // dd($test);

        $company_id  = getLoggedCompanyID();
        $user_id  = logged('id');
        $hasID = bin2hex(random_bytes(18));

        // $data = $this->input->post('output-1');
        $wo_id = $this->input->post('wo_id');

        $datasig            = $this->input->post('company_representative_approval_signature1aM_web');
        $folderPath         = "./uploads/Signatures/1/";
        $image_parts        = explode(";base64,", $datasig);
        $image_type_aux     = explode("image/", $image_parts[0]);
        $image_type         = $image_type_aux[1];
        $image_base64       = base64_decode($image_parts[1]);
        $file               = $folderPath . $wo_id . '_alarm_company' . '.'.$image_type;
        $file_save          = 'uploads/Signatures/1/' . $wo_id . '_alarm_company' . '.'.$image_type;
        file_put_contents($file, $image_base64);

        $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
        $folderPath2        = "./uploads/Signatures/1/";
        $image_parts2       = explode(";base64,", $datasig2);
        $image_type_aux2    = explode("image/", $image_parts2[0]);
        $image_type2        = $image_type_aux2[1];
        $image_base642      = base64_decode($image_parts2[1]);
        $file2              = $folderPath2 . $wo_id . '_alarm_primary' . '.'.$image_type2;
        $file2_save         = 'uploads/Signatures/1/' . $wo_id . '_alarm_primary' . '.'.$image_type2;
        file_put_contents($file2, $image_base642);

        $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
        $folderPath3        = "./uploads/Signatures/1/";
        $image_parts3       = explode(";base64,", $datasig3);
        $image_type_aux3    = explode("image/", $image_parts3[0]);
        $image_type3        = $image_type_aux3[1];
        $image_base643      = base64_decode($image_parts3[1]);
        $file3              = $folderPath3 . $wo_id . '_alarm_secondary' . '.'.$image_type3;
        $file3_save         = 'uploads/Signatures/1/' . $wo_id . '_alarm_secondary' . '.'.$image_type3;
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

        $dateIssued = date('Y-m-d', strtotime($this->input->post('date_issued')));

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
            // $first_verification_name    = $this->input->post('1st_verification_name');
            // $first_number               = $this->input->post('1st_number');
            // $first_number_type          = $this->input->post('1st_number_type');
            // $first_relation             = $this->input->post('1st_relation');//
            // $second_verification_name   = $this->input->post('2nd_verification_name');
            // $second_number              = $this->input->post('2nd_number');
            // $second_number_type         = $this->input->post('2nd_number_type');
            // $second_relation            = $this->input->post('2nd_relation');//
            // $third_verification_name    = $this->input->post('3rd_verification_name');
            // $third_number               = $this->input->post('3rd_number');
            // $third_number_type          = $this->input->post('3rd_number_type');
            // $third_relation             = $this->input->post('3rd_relation');//
            // $fourth_verification_name   = $this->input->post('4th_verification_name');
            // $fourth_number              = $this->input->post('4th_number');
            // $fourth_number_type         = $this->input->post('4th_number_type');
            // $fourth_relation            = $this->input->post('4th_relation');

            // if(!empty($first_verification_name)){
            //     $contact1 = array(
            //         'name'                     => $first_verification_name,
            //         'phone_type'               => $first_number,
            //         'phone'                    => $first_number_type,
            //         'relation'                 => $first_relation,
            //         'customer_id'              => $w_acs,
            //     );

            //     $contact = $this->workorder_model->save_contact($contact1);
            // }
            // if(!empty($second_verification_name)){
            //     $contact2 = array(
            //         'name'                     => $second_verification_name,
            //         'phone_type'               => $second_number,
            //         'phone'                    => $second_number_type,
            //         'relation'                 => $second_relation,
            //         'customer_id'              => $w_acs,
            //     );

            //     $contact = $this->workorder_model->save_contact($contact2);
            // }
            // if(!empty($third_verification_name)){
            //     $contact3 = array(
            //         'name'                     => $third_verification_name,
            //         'phone_type'               => $third_number,
            //         'phone'                    => $third_number_type,
            //         'relation'                 => $third_relation,
            //         'customer_id'              => $w_acs,
            //     );

            //     $contact = $this->workorder_model->save_contact($contact3);
            // }
            // if(!empty($fourth_verification_name)){
            //     $contact4 = array(
            //         'name'                     => $fourth_verification_name,
            //         'phone_type'               => $fourth_number,
            //         'phone'                    => $fourth_number_type,
            //         'relation'                 => $fourth_relation,
            //         'customer_id'              => $w_acs,
            //     );

            //     $contact = $this->workorder_model->save_contact($contact4);
            // }

            

        $ainame         = $this->input->post('1st_verification_name');
        $number_type    = $this->input->post('1st_number_type');
        $phonev         = $this->input->post('1st_number');
        $relation       = $this->input->post('1st_relation');

        // dd($ainame);

        $ai = 0;
        foreach($ainame as $row3){
            $datav['name']          = $ainame[$ai];
            $datav['phone_type']    = $number_type[$ai];
            $datav['phone']         = $phonev[$ai];
            $datav['relation']      = $relation[$ai];
            $datav['customer_id']   = $w_acs;
            $save_contactv          = $this->workorder_model->save_contact_new($datav);
            $ai++;
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
            'date_issued'                           => $dateIssued,
            'plan_type'                             => $this->input->post('plan_type'),
            'lead_source_id'                        => $this->input->post('lead_source'),

            //'agent_id'                              => $this->input->post('agent_id'),

            'job_name'                              => $this->input->post('job_name'),
            'job_description'                       => $this->input->post('job_description'),
            'instructions'                          => $this->input->post('instructions'),

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
            'work_order_type_id'                    => '2',
            'industry_template_id'                  => '1'
            
        );

        $addQuery = $this->workorder_model->save_workorder($new_data);
        //SMS Notification
        createCronAutoSmsNotification($company_id, $addQuery, 'workorder', $this->input->post('status'), $user_id, 0, $user_id);

        customerAuditLog(logged('id'), $w_acs, $addQuery, 'Workorder', 'Created workorder #'.$this->input->post('workorder_number'));

        

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
            $a          = $this->input->post('itemid');
            $packageID  = $this->input->post('packageID');
            $d          = $this->input->post('quantity');
            $f          = $this->input->post('price');
            $h          = $this->input->post('tax');
            $discount   = $this->input->post('discount');
            $total      = $this->input->post('total');

            $i = 0;
            foreach($a as $row){
                $data['items_id ']      = $a[$i];
                $data['package_id ']    = $packageID[$i];
                $data['work_order_id '] = $addQuery;
                $data['qty']            = $d[$i];
                $data['cost']           = $f[$i];
                $data['tax']            = $h[$i];
                $data['discount']       = $discount[$i];
                $data['total']          = $total[$i];
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


            //Updated workorder settings
            $this->load->model('WorkorderSettings_model', 'WorkorderSettings');
            $workorderSettings = $this->WorkorderSettings->getByCompanyId($company_id);
            $new_next_num = intval($workorderSettings->work_order_num_next) + 1;

            $data = ['work_order_num_next' => $new_next_num];
            $this->WorkorderSettings->updateByCompanyId($company_id,$data);


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

    private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/workorders/solar/';
        $config['allowed_types'] = 'gif|jpg|png|txt|pdf|doc|docx';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }

    public function download($name){
        if(!empty($name)){
            //load download helper
            $this->load->helper('download');
            
            //get file info from database
            $fileInfo = $this->workorder_model->getRows($name);
            
            //file path
            $file = './uploads/workorders/solar/'.$fileInfo->solar_image;
            
            //download file from directory
            force_download($file, NULL);
        }
    }

    public function savenewWorkorderSolar()
    {

        
        // $test         = $this->input->post('1st_verification_name');
        // dd($test);

        $company_id  = getLoggedCompanyID();
        $user_id  = logged('id');
        $hasID = bin2hex(random_bytes(18));

        // $data = $this->input->post('output-1');
        $wo_id = $this->input->post('wo_id');

        if(empty($this->input->post('company_representative_approval_signature1aM_web'))){
            $file_save = '';
        }else{
        $datasig            = $this->input->post('company_representative_approval_signature1aM_web');
        $folderPath         = "./uploads/Signatures/1/";
        $image_parts        = explode(";base64,", $datasig);
        $image_type_aux     = explode("image/", $image_parts[0]);
        $image_type         = $image_type_aux[1];
        $image_base64       = base64_decode($image_parts[1]);
        $file               = $folderPath . $wo_id . '_alarm_company' . '.'.$image_type;
        $file_save          = 'uploads/Signatures/1/' . $wo_id . '_alarm_company' . '.'.$image_type;
        file_put_contents($file, $image_base64);
        }

        if(empty($this->input->post('primary_representative_approval_signature1aM_web'))){
            $file2_save = '';
        }else{
        $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
        $folderPath2        = "./uploads/Signatures/1/";
        $image_parts2       = explode(";base64,", $datasig2);
        $image_type_aux2    = explode("image/", $image_parts2[0]);
        $image_type2        = $image_type_aux2[1];
        $image_base642      = base64_decode($image_parts2[1]);
        $file2              = $folderPath2 . $wo_id . '_alarm_primary' . '.'.$image_type2;
        $file2_save         = 'uploads/Signatures/1/' . $wo_id . '_alarm_primary' . '.'.$image_type2;
        file_put_contents($file2, $image_base642);
        }

        if(empty($this->input->post('secondary_representative_approval_signature1aM_web'))){
            $file3_save = '';
        }else{
        $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
        $folderPath3        = "./uploads/Signatures/1/";
        $image_parts3       = explode(";base64,", $datasig3);
        $image_type_aux3    = explode("image/", $image_parts3[0]);
        $image_type3        = $image_type_aux3[1];
        $image_base643      = base64_decode($image_parts3[1]);
        $file3              = $folderPath3 . $wo_id . '_alarm_secondary' . '.'.$image_type3;
        $file3_save         = 'uploads/Signatures/1/' . $wo_id . '_alarm_secondary' . '.'.$image_type3;
        file_put_contents($file3, $image_base643);
        }

        $options = implode(',', array_key_exists('options', $_POST) ? $_POST['options'] : []);
        // dd($service_name);



        $action = $this->input->post('action');
        if($action == 'submit') {

        $dateIssued = date('Y-m-d', strtotime($this->input->post('current_date')));

        $solarItemsACS = array(
            // 'fk_user_id'                => $user_id,
            // 'customer_type'             => $this->input->post('address'),
            // 'business_name'             => $this->input->post('business_name'), //new
            // 'install_type'              => $this->input->post('install_type'),
            'last_name'                 => $this->input->post('lastname'),
            'first_name'                => $this->input->post('firstname'),
            'phone_h'                   => $this->input->post('phone'), //new
            'phone_m'                   => $this->input->post('mobile'), //new
            'email'                     => $this->input->post('email'),
            'mail_add'                  => $this->input->post('address'), //new
            'city'                      => $this->input->post('city_form'), //new
            'country'                   => $this->input->post('country'), //new
            'zip_code'                  => $this->input->post('postcode_form'), //new
            'company_id'                => $company_id,
        );

        // $w_acs = $this->workorder_model->save_alarm($solarItemsACS);
        $w_acs = $this->input->post('customer_id');

        $solarItemsACS2 = array(
            'customer_id'               => $this->input->post('customer_id'),
            'last_name'                 => $this->input->post('lastname'),
            'first_name'                => $this->input->post('firstname'),
            'phone_h'                   => $this->input->post('phone'), //new
            'phone_m'                   => $this->input->post('mobile'), //new
            'email'                     => $this->input->post('email'),
            'mail_add'                  => $this->input->post('address'), //new
            'city'                      => $this->input->post('city_form'), //new
            'country'                   => $this->input->post('country'), //new
            'zip_code'                  => $this->input->post('postcode_form'), //new
            // 'ssn'                       => $this->input->post('ssn'), //new
        );

        $w_acs = $this->workorder_model->update_alarm($solarItemsACS2);
        $customer_id = $this->input->post('customer_id');

        $solarItemsOffice = array(
            'fk_prof_id'                => $customer_id,
            'lead_source'               => $this->input->post('lead_source'),
            'save_by'                   => $user_id,
            'fk_sales_rep_office'       => $user_id,
            // 'equipment_cost'            => $equip,
            // 'monthly_monitoring'        => $this->input->post('otps'),
            'sales_date'                => date("m/d/Y"),
        );

        $solarItemsOffices = $this->workorder_model->update_office($solarItemsOffice);


        $getItemsDetails = $this->workorder_model->getItemsDetails();
        $item_tax = $getItemsDetails->price * 0.075;

        $dateIssued = date('Y-m-d', strtotime($this->input->post('current_date'))); //current_date date_issued

        $new_data = array(
            'work_order_number'                     => $this->input->post('workorder_number'),
            'customer_id'                           => $this->input->post('customer_id'),
            'phone_number'                          => $this->input->post('phone'),
            'mobile_number'                         => $this->input->post('mobile'),
            'email'                                 => $this->input->post('email'),
            
            'business_name'                         => $this->input->post('business_name'),
            // 'employee_id' => '0',
            'job_location'                          => $this->input->post('address'),
            'city'                                  => $this->input->post('city_form'),
            'country'                               => $this->input->post('country'),
            'zip_code'                              => $this->input->post('postcode_form'),
            'comments'                              => $this->input->post('comments'),
            'payment_method'                        => $this->input->post('payment_method'),
            'payment_amount'                        => $this->input->post('payment_amount'),
            'header'                                => $this->input->post('header'),
            'date_issued'                           => $dateIssued,
            'lead_source_id'                        => $this->input->post('lead_source'),
            'panel_communication'                   => $this->input->post('system_type'),
            // 'hash_id'                               => $hasID,

             //signature
             'company_representative_signature'     => $file_save,
             'company_representative_name'          => $this->input->post('company_representative_printed_name'),
             'primary_account_holder_signature'     => $file2_save,
             'primary_account_holder_name'          => $this->input->post('primary_account_holder_name'),
             'secondary_account_holder_signature'   => $file3_save,
             'secondary_account_holder_name'        => $this->input->post('secondery_account_holder_name'),
             'grand_total'                          => $getItemsDetails->price + $item_tax,
             'taxes'                                => $item_tax,


            // 'roof_type'                 => $this->input->post('tor'),
            // 'house_area'                => $this->input->post('sfoh'),
            // 'roof_age'                 => $this->input->post('aor'),
            // 'solar_panel_mounting_prefs'                => $this->input->post('spmp'),
            // 'is_homeowner_assoc_member'                 => $this->input->post('hoa'),
            // 'hoa_text'            => $this->input->post('address'),
            // 'estimated_bill'      => $this->input->post('estimated_bill'),
            // 'ebis'                => $this->input->post('ebis'),
            // 'hdygi'               => $this->input->post('hdygi'),
            // 'hdygi_file'          => $this->input->post('hdygi_file'),
            // 'eba_text'            => $this->input->post('eba_text'),
            // 'es'                  => $this->input->post('es'),
            // 'options'             => $options,

            // 'company_representative_signature' => 'company_representative_signature',
            // 'company_representative_name' => 'company_representative_name',
            // 'primary_account_holder_signature' => 'primary_account_holder_signature',
            // 'primary_account_holder_name' => 'primary_account_holder_name',
            // 'secondary_account_holder_signature' => 'secondary_account_holder_signature',
            // 'secondary_account_holder_name' => 'secondary_account_holder_name',

            'status'                                => $this->input->post('status'), //Added Bryann Revina 
            //'agent_id'                              => $this->input->post('agent_id'), //Added Bryann Revina 
            
            'employee_id'                           => $user_id,
            'is_template'                           => '1',
            'company_id'                            => $company_id,
            'date_created'                          => date("Y-m-d H:i:s"),
            'date_updated'                          => date("Y-m-d H:i:s"),
            'work_order_type_id'                    => '3',
            'industry_template_id'                  => '2'
            
        );

        $addQuery = $this->workorder_model->save_workorder($new_data);

        $data = array(
            'work_order_id'         => $addQuery,
            'items_id'              => $getItemsDetails->id,
            'qty'                   => 1,
            'cost'                  => $getItemsDetails->price,
            'tax'                   => $item_tax,
            'discount'              => 0,
            'total'                 => $getItemsDetails->price + $item_tax,
        );
        $result_set = $this->workorder_model->add_workorder_solar_items($data);

        // dd($addQuery);

        //SMS Notification
        createCronAutoSmsNotification($company_id, $addQuery, 'workorder', $this->input->post('status'), $user_id, 0, $user_id);

        $solarItems = array(
            'tor'                 => $this->input->post('tor'),
            'sfoh'                => $this->input->post('sfoh'),
            'aor'                 => $this->input->post('aor'),
            'spmp'                => $this->input->post('spmp'),
            'hoa'                 => $this->input->post('hoa'),
            'hoa_text'            => $this->input->post('address'),
            'estimated_bill'      => $this->input->post('estimated_bill'),
            'ebis'                => $this->input->post('ebis'),
            'hdygi'               => $this->input->post('hdygi'),
            'hdygi_file'          => $this->input->post('hdygi_file'),
            'eba_text'            => $this->input->post('eba_text'),
            'es'                  => $this->input->post('es'),
            'options'             => $options,
            'company_id'          => $company_id,
            'work_order_id'       => $addQuery,
        );

        $solarItems = $this->workorder_model->save_solar_items($solarItems);

        
        $this->load->library('upload');
        $dataInfo = array();
        $files = $_FILES;
        $cpt = count($_FILES['hdygi_file']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['hdygi_file']['name']= $files['hdygi_file']['name'][$i];
            $_FILES['hdygi_file']['type']= $files['hdygi_file']['type'][$i];
            $_FILES['hdygi_file']['tmp_name']= $files['hdygi_file']['tmp_name'][$i];
            $_FILES['hdygi_file']['error']= $files['hdygi_file']['error'][$i];
            $_FILES['hdygi_file']['size']= $files['hdygi_file']['size'][$i];    

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload('hdygi_file');
            $dataInfo[] = $this->upload->data();
        }

        $data = array(
            // 'name' => $this->input->post('pd_name'),
            'solar_image' => $dataInfo[0]['file_name'],
            'solar_image1' => $dataInfo[1]['file_name'],
            'solar_image2' => $dataInfo[2]['file_name'],
            'solar_image3' => $dataInfo[3]['file_name'],
            'solar_image4' => $dataInfo[4]['file_name'],
            'work_order_id' => $addQuery,
            'solar_id' => $solarItems
        );
        $result_set = $this->workorder_model->insertSolarFiles($data);




        customerAuditLog(logged('id'), $w_acs, $addQuery, 'Workorder', 'Created workorder #'.$this->input->post('workorder_number'));


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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_dataa = array(
                'fk_prof_id'            => $customer_id,
                'card_fname'            => $this->input->post('firstname'),
                'card_lname'            => $this->input->post('lastname'),
                'card_address'          => $this->input->post('address'),
                'city'                  => $this->input->post('city_form'),
                'state'                 => $this->input->post('state_form'),
                'zip'                   => $this->input->post('postcode_form'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
                'bill_method'           => 'CASH',
            );

            $pay1 = $this->workorder_model->save_payment_billing($payment_dataa);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datab = array(
                'fk_prof_id'            => $customer_id,
                'card_fname'            => $this->input->post('firstname'),
                'card_lname'            => $this->input->post('lastname'),
                'card_address'          => $this->input->post('address'),
                'city'                  => $this->input->post('city_form'),
                'state'                 => $this->input->post('state_form'),
                'zip'                   => $this->input->post('postcode_form'),
                'bill_method'           => 'CHECK',
                'check_num'             => $this->input->post('check_number'),
                'routing_num'           => $this->input->post('routing_number'),
                'acct_num'              => $this->input->post('account_number'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay2 = $this->workorder_model->save_payment_billing($payment_datab);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datac = array(
                'fk_prof_id'            => $customer_id,
                'card_fname'            => $this->input->post('firstname'),
                'card_lname'            => $this->input->post('lastname'),
                'card_address'          => $this->input->post('address'),
                'city'                  => $this->input->post('city_form'),
                'state'                 => $this->input->post('state_form'),
                'zip'                   => $this->input->post('postcode_form'),
                'bill_method'           => 'Invoicing',
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay3 = $this->workorder_model->save_payment_billing($payment_datac);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datad = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'CC',
                'credit_card_num'           => $this->input->post('credit_number'),
                'credit_card_exp'           => $this->input->post('credit_expiry'),
                'credit_card_exp_mm_yyyy'   => $this->input->post('credit_cvc'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay4 = $this->workorder_model->save_payment_billing($payment_datad);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datae = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'DC',
                'credit_card_num'           => $this->input->post('debit_credit_number'),
                'credit_card_exp'           => $this->input->post('debit_credit_expiry'),
                'credit_card_exp_mm_yyyy'   => $this->input->post('debit_credit_cvc'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay5 = $this->workorder_model->save_payment_billing($payment_datae);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_dataf = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'ACH',
                'routing_num'               => $this->input->post('ach_routing_number'),
                'acct_num'                  => $this->input->post('ach_account_number'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay6 = $this->workorder_model->save_payment_billing($payment_dataf);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datag = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'VENMO',
                'account_credential'        => $this->input->post('account_credentials'),
                'account_note'              => $this->input->post('account_note'),
                'confirmation'              => $this->input->post('confirmation'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay7 = $this->workorder_model->save_payment_billing($payment_datag);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datah = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'PP',
                'account_credential'        => $this->input->post('paypal_account_credentials'),
                'account_note'              => $this->input->post('paypal_account_note'),
                'confirmation'              => $this->input->post('paypal_confirmation'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay8 = $this->workorder_model->save_payment_billing($payment_datah);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datai = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'SQ',
                'account_credential'        => $this->input->post('square_account_credentials'),
                'account_note'              => $this->input->post('square_account_note'),
                'confirmation'              => $this->input->post('square_confirmation'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay9 = $this->workorder_model->save_payment_billing($payment_datai);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_dataj = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'WW',
                'account_credential'        => $this->input->post('warranty_account_credentials'),
                'account_note'              => $this->input->post('warranty_account_note'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay10 = $this->workorder_model->save_payment_billing($payment_dataj);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datak = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'HOF',
                'account_credential'        => $this->input->post('home_account_credentials'),
                'account_note'              => $this->input->post('home_account_note'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay11 = $this->workorder_model->save_payment_billing($payment_datak);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datal = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'eT',
                'account_credential'        => $this->input->post('e_account_credentials'),
                'account_note'              => $this->input->post('e_account_note'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay12 = $this->workorder_model->save_payment_billing($payment_datal);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datam = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'OCCP',
                'credit_card_num'           => $this->input->post('other_credit_number'),
                'credit_card_exp'           => $this->input->post('other_credit_expiry'),
                'credit_card_exp_mm_yyyy'   => $this->input->post('other_credit_cvc'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay13 = $this->workorder_model->save_payment_billing($payment_datam);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datan = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'zip'                       => $this->input->post('postcode_form'),
                'bill_method'               => 'OPT',
                'account_credential'        => $this->input->post('other_payment_account_credentials'),
                'account_note'              => $this->input->post('other_payment_account_note'),
                'initial_dep'           => $this->input->post('payment_amount'),
                'bill_freq'             => 'Every 1 Month',
            );

            $pay14 = $this->workorder_model->save_payment_billing($payment_datan);
        }

        

        if($addQuery > 0){

            $notif = array(
            
                'user_id'               => $user_id,
                'title'                 => 'New Work Order',
                'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
                'date_created'          => date("Y-m-d H:i:s"),
                'status'                => '1',
                'company_id'            => getLoggedCompanyID()
            );

            $notification = $this->workorder_model->save_notification($notif);


            //Updated workorder settings
            $this->load->model('WorkorderSettings_model', 'WorkorderSettings');
            $workorderSettings = $this->WorkorderSettings->getByCompanyId($company_id);
            $new_next_num = intval($workorderSettings->work_order_num_next) + 1;

            $data = ['work_order_num_next' => $new_next_num];
            $this->WorkorderSettings->updateByCompanyId($company_id,$data);


            if (!is_null($this->input->get('json', TRUE))) {
                header('content-type: application/json');
                exit(json_encode(['id' => $addQuery]));
            } else {
                redirect('workorder');
            }
        }
        else{
            echo json_encode(0);
            print_r($file_put_contents);die;
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

    public function savenewWorkorderAgreement()
    {
        
        // $test         = $this->input->post('1st_verification_name');
        // dd($test);

        $company_id  = getLoggedCompanyID();
        $user_id  = logged('id');

        // $data = $this->input->post('output-1');
        $wo_id = $this->input->post('wo_id');
        $hasID = bin2hex(random_bytes(18));

        if(empty($this->input->post('company_representative_approval_signature1aM_web'))){
            $file_save = '';
        }else{
        $datasig            = $this->input->post('company_representative_approval_signature1aM_web');
        $folderPath         = "./uploads/Signatures/1/";
        $image_parts        = explode(";base64,", $datasig);
        $image_type_aux     = explode("image/", $image_parts[0]);
        $image_type         = $image_type_aux[1];
        $image_base64       = base64_decode($image_parts[1]);
        $file               = $folderPath . $wo_id . '_installation_company' . '.'.$image_type;
        $file_save          = 'uploads/Signatures/1/' . $wo_id . '_installation_company' . '.'.$image_type;
        file_put_contents($file, $image_base64);
        }

        if(empty($this->input->post('primary_representative_approval_signature1aM_web'))){
            $file2_save = '';
        }else{
        $datasig2           = $this->input->post('primary_representative_approval_signature1aM_web');
        $folderPath2        = "./uploads/Signatures/1/";
        $image_parts2       = explode(";base64,", $datasig2);
        $image_type_aux2    = explode("image/", $image_parts2[0]);
        $image_type2        = $image_type_aux2[1];
        $image_base642      = base64_decode($image_parts2[1]);
        $file2              = $folderPath2 . $wo_id . '_installation_primary' . '.'.$image_type2;
        $file2_save         = 'uploads/Signatures/1/' . $wo_id . '_installation_primary' . '.'.$image_type2;
        file_put_contents($file2, $image_base642);
        }

        if(empty($this->input->post('secondary_representative_approval_signature1aM_web'))){
            $file3_save = '';
        }else{
        $datasig3           = $this->input->post('secondary_representative_approval_signature1aM_web');
        $folderPath3        = "./uploads/Signatures/1/";
        $image_parts3       = explode(";base64,", $datasig3);
        $image_type_aux3    = explode("image/", $image_parts3[0]);
        $image_type3        = $image_type_aux3[1];
        $image_base643      = base64_decode($image_parts3[1]);
        $file3              = $folderPath3 . $wo_id . '_installation_secondary' . '.'.$image_type3;
        $file3_save         = 'uploads/Signatures/1/' . $wo_id . '_installation_secondary' . '.'.$image_type3;
        file_put_contents($file3, $image_base643);
        }

        $options = implode(',', array_key_exists('options', $_POST) ? $_POST['options'] : []);
        // dd($service_name);


        $customer_id = $this->input->post('customer_id');

        // dd($customer_id);
        ///
        if(empty($customer_id)) {

            $dateIssued = date('Y-m-d', strtotime($this->input->post('current_date')));

            $solarItemsACS = array(
                'last_name'                 => $this->input->post('lastname'),
                'first_name'                => $this->input->post('firstname'),
                'phone_h'                   => $this->input->post('phone'), //new
                'phone_m'                   => $this->input->post('mobile'), //new
                'email'                     => $this->input->post('email'),
                'mail_add'                  => $this->input->post('address'), //new
                'city'                      => $this->input->post('city_form'), //new
                'country'                   => $this->input->post('country'), //new
                'zip_code'                  => $this->input->post('postcode_form'), //new
                'company_id'                => $company_id,
            );

            $w_acs = $this->workorder_model->save_alarm($solarItemsACS);

            // $w_acs1a = $this->workorder_model->getLast();
            // $w_acs = $w_acs1a->prof_id;

            // echo $w_acs;

            $get_lead = $this->workorder_model->get_lead($this->input->post('lead_source'));

            $solarItemsOffice = array(
                'fk_prof_id'                => $w_acs,
                'lead_source'               => $get_lead->ls_name,
                'save_by'                   => $user_id,
                'equipment'                 => $this->input->post('equipmentCost'),
            );

            $solarItemsOffices = $this->workorder_model->save_office($solarItemsOffice);

            $alarmInfo = array(
                'fk_prof_id'                => $w_acs,
                'equipment_cost'            => $this->input->post('equipmentCost'),
                'monthly_monitoring'        => $this->input->post('otps'),
            );

            $alarmInfos = $this->workorder_model->save_office($alarmInfo);

            $alarmInfoData = array(
                'fk_prof_id'                => $w_acs,
                'equipment_cost'            => $this->input->post('equipmentCost'),
                'monthly_monitoring'        => $this->input->post('otps'),
                'panel_type'                => $this->input->post('panel_type'),
                'otps'                      => $this->input->post('otps'),
                // 'system_type'               => $this->input->post('otps'),
                // 'warranty_type'             => $this->input->post('otps'),
                // 'comm_type'                 => $this->input->post('otps'),
            );

            $alarmInfoDatas = $this->workorder_model->save_alarm_info($alarmInfoData);

            $contact = array(
                'name'                 => $this->input->post('first_ecn'),
                'phone'                => $this->input->post('first_ecn_no'),
                'customer_id'          => $w_acs,
                // 'third_ecn'                 => $this->input->post('third_ecn'),
                // 'first_ecn_no'              => $this->input->post('first_ecn_no'),
                // 'second_ecn_no'             => $this->input->post('second_ecn_no'),
                // 'third_ecn_no'              => $this->input->post('third_ecn_no'),
            );

            $contacts1 = $this->workorder_model->save_contact($contact);

            $contact1 = array(
                'name'                 => $this->input->post('second_ecn'),
                'phone'                => $this->input->post('second_ecn_no'),
                'customer_id'          => $w_acs,
            );

            $contacts1 = $this->workorder_model->save_contact($contact1);

            $contact2 = array(
                'name'                 => $this->input->post('third_ecn'),
                'phone'                => $this->input->post('third_ecn_no'),
                'customer_id'          => $w_acs,
            );

            $contacts2 = $this->workorder_model->save_contact($contact2);


            $new_data = array(
                'work_order_number'                     => $this->input->post('workorder_number'),
                'customer_id'                           => $w_acs,
                'business_name'                         => $this->input->post('business_name'),
                'phone_number'                          => $this->input->post('phone'),
                'mobile_number'                         => $this->input->post('mobile'),
                'email'                                 => $this->input->post('email'),
                // 'employee_id' => '0',
                'job_location'                          => $this->input->post('address'),
                'city'                                  => $this->input->post('city_form'),
                'state'                                 => $this->input->post('state_form'),
                'country'                               => $this->input->post('country'),
                'zip_code'                              => $this->input->post('postcode_form'),
                'comments'                              => $this->input->post('comments'),
                'payment_method'                        => $this->input->post('payment_method'),
                'payment_amount'                        => $this->input->post('payment_amount'),
                'header'                                => $this->input->post('header'),
                'date_issued'                           => $dateIssued,
                // 'installation_date'                     => $this->input->post('installation_date'), date_issued

                'lead_source_id'                        => $this->input->post('lead_source'),
                'panel_type'                            => $this->input->post('panel_type'),
                'panel_communication'                   => $this->input->post('communication_type'),
                'account_type'                          => $this->input->post('account_type'),

                'comments'                              => $this->input->post('notes'),
                'password'                              => $this->input->post('password'),
                'security_number'                       => $this->input->post('ssn'),

                'subtotal'                              => $this->input->post('equipmentCost'),
                'taxes'                                 => $this->input->post('salesTax'),
                'installation_cost'                     => $this->input->post('installationCost'),
                'otp_setup'                             => $this->input->post('otps'),
                'monthly_monitoring'                    => $this->input->post('monthlyMonitoring'),
                'grand_total'                           => $this->input->post('totalDue'),
                'terms_and_conditions'                  => $this->input->post('terms_conditions'),
                'job_tags'                              => $this->input->post('job_tags'),
                // 'hash_id'                               => $hasID,

                //signature
                'company_representative_signature'     => $file_save,
                'company_representative_name'          => $this->input->post('company_representative_printed_name'),
                'primary_account_holder_signature'     => $file2_save,
                'primary_account_holder_name'          => $this->input->post('primary_account_holder_name'),
                'secondary_account_holder_signature'   => $file3_save,
                'secondary_account_holder_name'        => $this->input->post('secondery_account_holder_name'),
                'date_issued'                          => date("Y-m-d"),

                
                'install_date'                          => $this->input->post('installation_date'),
                'install_time'                          => $this->input->post('intall_time'),

                // 'company_representative_signature' => 'company_representative_signature',
                // 'company_representative_name' => 'company_representative_name',
                // 'primary_account_holder_signature' => 'primary_account_holder_signature',
                // 'primary_account_holder_name' => 'primary_account_holder_name',
                // 'secondary_account_holder_signature' => 'secondary_account_holder_signature',
                // 'secondary_account_holder_name' => 'secondary_account_holder_name',
                'status'                                => 'New',
                'employee_id'                           => $user_id,
                'is_template'                           => '1',
                'company_id'                            => $company_id,
                'date_created'                          => date("Y-m-d H:i:s"),
                'date_updated'                          => date("Y-m-d H:i:s"),
                'work_order_type_id'                    => '4',
                'industry_template_id'                  => '3'
                
            );

            $addQuery = $this->workorder_model->save_workorder($new_data);

            $solarItems = array(
                'firstname'                 => $this->input->post('firstname'),
                'lastname'                  => $this->input->post('lastname'),
                'businessname'              => $this->input->post('businessname'),
                'firstname_spouse'          => $this->input->post('firstname_spouse'),
                'lastname_spouse'           => $this->input->post('lastname_spouse'),
                'address'                   => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'county'                    => $this->input->post('county'),
                'postcode'                  => $this->input->post('postcode_form'),
                'first_ecn'                 => $this->input->post('first_ecn'),
                'second_ecn'                => $this->input->post('second_ecn'),
                'third_ecn'                 => $this->input->post('third_ecn'),
                'first_ecn_no'              => $this->input->post('first_ecn_no'),
                'second_ecn_no'             => $this->input->post('second_ecn_no'),
                'third_ecn_no'              => $this->input->post('third_ecn_no'),
                // 'installation_date'         => $this->input->post('installation_date'),
                // 'intall_time'               => $this->input->post('intall_time'),
                'sales_re_name'             => $this->input->post('sales_re_name'),
                'sale_rep_phone'            => $this->input->post('sale_rep_phone'),
                'team_leader'               => $this->input->post('team_leader'),
                'billing_date'              => $this->input->post('billing_date'),
                'company_id'                => $company_id,
                'work_order_id'             => $addQuery,
            );

            $solarItems = $this->workorder_model->save_agreement_items($solarItems);

            
            $item       = $this->input->post("item");
            $qty        = $this->input->post("qty");
            $existing   = $this->input->post("existing");
            $location   = $this->input->post("location");
            $price      = $this->input->post("price");

            $toi_check = $this->input->post("toi_check");
            $zl_check  = $this->input->post("zl_check");
            $trans_check = $this->input->post("trans_check");

            $checkValue = $this->input->post("dataValue");

            if($toi_check)
            {
                $checkData = $toi_check;
            }
            elseif($zl_check)
            {
                $checkData = $zl_check;
            }
            elseif($trans_check)
            {
                $checkData = $trans_check;
            }
            // elseif(!empty($trans_check))
            // {
            //     $checkData = $trans_check;
            // }
            else
            {
                $checkData = '';
            }
            
            $i = 0;

            foreach($item as $row){
                $data['item']           = $item[$i];
                $data['qty']            = $qty[$i];
                $data['existing']       = $existing[$i];
                $data['location']       = $location[$i];
                $data['price']          = $price[$i];
                $data['check_data']     = $checkValue[$i];
                $data['work_order_id']  = $addQuery;

                $result_set = $this->workorder_model->add_workorder_agreement_items($data);
                $i++;
            }

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

                $payment_dataa = array(
                    'fk_prof_id'            => $w_acs,
                    'card_fname'            => $this->input->post('firstname'),
                    'card_lname'            => $this->input->post('lastname'),
                    'card_address'          => $this->input->post('address'),
                    'city'                  => $this->input->post('city_form'),
                    'state'                 => $this->input->post('state_form'),
                    'zip'                   => $this->input->post('postcode_form'),
                    'bill_method'           => 'CASH',
                );

                $pay1 = $this->workorder_model->save_payment_billing($payment_dataa);
            }
            elseif($this->input->post('payment_method') == 'Check'){
                $payment_data = array(
                
                    'payment_method'        => $this->input->post('payment_method'),
                    'amount'                => $this->input->post('payment_amount'),
                    'check_number'          => $this->input->post('check_number'),
                    'routing_number'        => $this->input->post('routing_number'),
                    'account_number'        => $this->input->post('account_number'),
                    'billing_date'          => $this->input->post('billing_date'),
                    'billing_frequency'     => $this->input->post('billing_frequency'),
                    'work_order_id'         => $addQuery,
                    'date_created'          => date("Y-m-d H:i:s"),
                    'date_updated'          => date("Y-m-d H:i:s")
                );

                $pay = $this->workorder_model->save_payment($payment_data);

                $payment_datab = array(
                    'fk_prof_id'            => $w_acs,
                    'card_fname'            => $this->input->post('firstname'),
                    'card_lname'            => $this->input->post('lastname'),
                    'card_address'          => $this->input->post('address'),
                    'city'                  => $this->input->post('city_form'),
                    'state'                 => $this->input->post('state_form'),
                    'zip'                   => $this->input->post('postcode_form'),
                    'bill_method'           => 'CHECK',
                    'check_num'             => $this->input->post('check_number'),
                    'routing_num'           => $this->input->post('routing_number'),
                    'acct_num'              => $this->input->post('account_number'),
                );

                $pay2 = $this->workorder_model->save_payment_billing($payment_datab);
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

                $payment_datac = array(
                    'fk_prof_id'            => $w_acs,
                    'card_fname'            => $this->input->post('firstname'),
                    'card_lname'            => $this->input->post('lastname'),
                    'card_address'          => $this->input->post('address'),
                    'city'                  => $this->input->post('city_form'),
                    'state'                 => $this->input->post('state_form'),
                    'zip'                   => $this->input->post('postcode_form'),
                    'bill_method'           => 'Invoicing',
                );

                $pay3 = $this->workorder_model->save_payment_billing($payment_datac);
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

                $payment_datad = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'CC',
                    'credit_card_num'           => $this->input->post('credit_number'),
                    'credit_card_exp'           => $this->input->post('credit_expiry'),
                    'credit_card_exp_mm_yyyy'   => $this->input->post('credit_cvc'),
                );

                $pay4 = $this->workorder_model->save_payment_billing($payment_datad);
                
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

                $payment_datae = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'DC',
                    'credit_card_num'           => $this->input->post('debit_credit_number'),
                    'credit_card_exp'           => $this->input->post('debit_credit_expiry'),
                    'credit_card_exp_mm_yyyy'   => $this->input->post('debit_credit_cvc'),
                );

                $pay5 = $this->workorder_model->save_payment_billing($payment_datae);
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

                $payment_dataf = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'ACH',
                    'routing_num'               => $this->input->post('ach_routing_number'),
                    'acct_num'                  => $this->input->post('ach_account_number'),
                );

                $pay6 = $this->workorder_model->save_payment_billing($payment_dataf);
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

                $payment_datag = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'VENMO',
                    'account_credential'        => $this->input->post('account_credentials'),
                    'account_note'              => $this->input->post('account_note'),
                    'confirmation'              => $this->input->post('confirmation'),
                );

                $pay7 = $this->workorder_model->save_payment_billing($payment_datag);
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

                $payment_datah = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'PP',
                    'account_credential'        => $this->input->post('paypal_account_credentials'),
                    'account_note'              => $this->input->post('paypal_account_note'),
                    'confirmation'              => $this->input->post('paypal_confirmation'),
                );

                $pay8 = $this->workorder_model->save_payment_billing($payment_datah);
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

                $payment_datai = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'SQ',
                    'account_credential'        => $this->input->post('square_account_credentials'),
                    'account_note'              => $this->input->post('square_account_note'),
                    'confirmation'              => $this->input->post('square_confirmation'),
                );

                $pay9 = $this->workorder_model->save_payment_billing($payment_datai);
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

                $payment_dataj = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'WW',
                    'account_credential'        => $this->input->post('warranty_account_credentials'),
                    'account_note'              => $this->input->post('warranty_account_note'),
                );

                $pay10 = $this->workorder_model->save_payment_billing($payment_dataj);
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

                $payment_datak = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'HOF',
                    'account_credential'        => $this->input->post('home_account_credentials'),
                    'account_note'              => $this->input->post('home_account_note'),
                );

                $pay11 = $this->workorder_model->save_payment_billing($payment_datak);
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

                $payment_datal = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'eT',
                    'account_credential'        => $this->input->post('e_account_credentials'),
                    'account_note'              => $this->input->post('e_account_note'),
                );

                $pay12 = $this->workorder_model->save_payment_billing($payment_datal);
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

                $payment_datam = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'OCCP',
                    'credit_card_num'           => $this->input->post('other_credit_number'),
                    'credit_card_exp'           => $this->input->post('other_credit_expiry'),
                    'credit_card_exp_mm_yyyy'   => $this->input->post('other_credit_cvc'),
                );

                $pay13 = $this->workorder_model->save_payment_billing($payment_datam);
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

                $payment_datan = array(
                    'fk_prof_id'                => $w_acs,
                    'card_fname'                => $this->input->post('firstname'),
                    'card_lname'                => $this->input->post('lastname'),
                    'card_address'              => $this->input->post('address'),
                    'city'                      => $this->input->post('city_form'),
                    'state'                     => $this->input->post('state_form'),
                    'zip'                       => $this->input->post('postcode_form'),
                    'bill_method'               => 'OPT',
                    'account_credential'        => $this->input->post('other_payment_account_credentials'),
                    'account_note'              => $this->input->post('other_payment_account_note'),
                );

                $pay14 = $this->workorder_model->save_payment_billing($payment_datan);
            }
            

            

            if($addQuery > 0){

                $notif = array(
                
                    'user_id'               => $user_id,
                    'title'                 => 'New Work Order',
                    'content'               => $getname->FName. ' has created new Work Order.'. $this->input->post('workorder_number'),
                    'date_created'          => date("Y-m-d H:i:s"),
                    'status'                => '1',
                    'company_id'            => getLoggedCompanyID()
                );

                $notification = $this->workorder_model->save_notification($notif);


                //Updated workorder settings
                $this->load->model('WorkorderSettings_model', 'WorkorderSettings');
                $workorderSettings = $this->WorkorderSettings->getByCompanyId($company_id);
                $new_next_num = intval($workorderSettings->work_order_num_next) + 1;

                $data = ['work_order_num_next' => $new_next_num];
                $this->WorkorderSettings->updateByCompanyId($company_id,$data);

                if (!is_null($this->input->get('json', TRUE))) {
                    header('content-type: application/json');
                    exit(json_encode(['id' => $addQuery]));
                } else {
                    redirect('workorder');
                }
            }
            else{
                echo json_encode(0);
                // print_r($file_put_contents);die;
            }

        }else{

            $totalDue = $this->input->post('totalDue');
            $monitor = $this->input->post('monthlyMonitoring');
            $equip = $totalDue - $monitor;

            $solarItemsACS = array(
                'customer_id'               => $this->input->post('customer_id'),
                'last_name'                 => $this->input->post('lastname'),
                'first_name'                => $this->input->post('firstname'),
                'phone_h'                   => $this->input->post('phone'), //new
                'phone_m'                   => $this->input->post('mobile'), //new
                'email'                     => $this->input->post('email'),
                'mail_add'                  => $this->input->post('address'), //new
                'city'                      => $this->input->post('city_form'), //new
                'country'                   => $this->input->post('country'), //new
                'zip_code'                  => $this->input->post('postcode_form'), //new
                'ssn'                       => $this->input->post('ssn'), //new
            );

            $w_acs = $this->workorder_model->update_alarm($solarItemsACS);

            // $w_acs1a = $this->workorder_model->getLast();
            // $w_acs = $w_acs1a->prof_id;

            // echo $w_acs;

            $solarItemsOffice = array(
                'fk_prof_id'                => $customer_id,
                'lead_source'               => $this->input->post('lead_source'),
                'save_by'                   => $user_id,
                'fk_sales_rep_office'       => $user_id,
                'equipment_cost'            => $equip,
                'monthly_monitoring'        => $this->input->post('otps'),
                'sales_date'                => date("m/d/Y"),
            );

            $solarItemsOffices = $this->workorder_model->update_office($solarItemsOffice);

            $alarmInfoData = array(
                'fk_prof_id'                => $customer_id,
                'equipment_cost'            => $this->input->post('equipmentCost'),
                'monthly_monitoring'        => $this->input->post('monthlyMonitoring'),
                'panel_type'                => $this->input->post('panel_type'),
                'otps'                      => $this->input->post('otps'),
                'system_type'               => $this->input->post('communication_type'),
                'monitor_comp'              => 'Stanley',
                'acct_type'                 => 'In-House',
                'equipment'                 => 'Installed',
                'passcode'                  => $this->input->post('password'),
                'comm_type'                 => $this->input->post('communication_type'),
            );

            $alarmInfoDatas = $this->workorder_model->update_alarm_adi($alarmInfoData);

            $notesInfoData = array(
                'fk_prof_id'                => $customer_id,
                'note'                      => $this->input->post('notes'),
            );

            $notesInfoDatas = $this->workorder_model->update_notes_adi($notesInfoData);
            

            $deleteContacts = $this->workorder_model->delete_contact($customer_id);

            $contact = array(
                'first_name'                    => $this->input->post('first_ecn_first'),
                'last_name'                     => $this->input->post('first_ecn_last'),
                'phone'                => $this->input->post('first_ecn_no'),
                'customer_id'          => $customer_id,
            );

            $contacts1 = $this->workorder_model->save_contact($contact);

            $contact1 = array(
                'first_name'                    => $this->input->post('second_ecn_first'),
                'last_name'                     => $this->input->post('second_ecn_last'),
                'phone'                => $this->input->post('second_ecn_no'),
                'customer_id'          => $customer_id,
            );

            $contacts1 = $this->workorder_model->save_contact($contact1);

            $contact2 = array(
                'first_name'                    => $this->input->post('third_ecn_first'),
                'last_name'                     => $this->input->post('third_ecn_last'),
                'phone'                => $this->input->post('third_ecn_no'),
                'customer_id'          => $customer_id,
            );

            $contacts2 = $this->workorder_model->save_contact($contact2);

            //Workorder settings
            $workorderSettings = $this->workorder_model->getWorkOrderSettingsByCompanyId($company_id);
            $workorder_setting_next_num = 0;
            if ($workorderSettings) {
                $prefix   = $workorderSettings->work_order_num_prefix;
                $workorder_setting_next_num = $workorderSettings->work_order_num_next + 1;
                $next_num = str_pad($workorder_setting_next_num, 5, '0', STR_PAD_LEFT);
            } else {
                $prefix = 'WO-';
                $lastId = $this->workorder_model->getlastInsert($comp_id);
                if ($lastId) {
                    $next_num = $lastId->id + 1;
                    $workorder_setting_next_num = $next_num;
                    $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
                } else {
                    $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
                    $workorder_setting_next_num = 1;
                }
            }

            $work_order_number = $prefix . $next_num;

            $new_data = array(
                'work_order_number'                     => $work_order_number,
                'customer_id'                           => $customer_id,
                'business_name'                         => $this->input->post('business_name'),
                'phone_number'                          => $this->input->post('phone'),
                'mobile_number'                         => $this->input->post('mobile'),
                'email'                                 => $this->input->post('email'),
                'job_location'                          => $this->input->post('address'),
                'city'                                  => $this->input->post('city_form'),
                'state'                                 => $this->input->post('state_form'),
                'country'                               => $this->input->post('country'),
                'zip_code'                              => $this->input->post('postcode_form'),
                'comments'                              => $this->input->post('comments'),
                'payment_method'                        => $this->input->post('payment_method'),
                'payment_amount'                        => $this->input->post('payment_amount'),
                'header'                                => $this->input->post('header'),
                'date_issued'                           => $dateIssued,

                'lead_source_id'                        => $this->input->post('lead_source'),
                'panel_type'                            => $this->input->post('panel_type'),
                'panel_communication'                   => $this->input->post('communication_type'),
                'account_type'                          => $this->input->post('account_type'),
                'comments'                              => $this->input->post('notes'),
                'password'                              => $this->input->post('password'),
                'security_number'                       => $this->input->post('ssn'),
                'subtotal'                              => $this->input->post('equipmentCost'),
                'taxes'                                 => $this->input->post('salesTax'),
                'installation_cost'                     => $this->input->post('installationCost'),
                'otp_setup'                             => $this->input->post('otps'),
                'monthly_monitoring'                    => $this->input->post('monthlyMonitoring'),
                'grand_total'                           => $this->input->post('totalDue'),
                'terms_and_conditions'                  => $this->input->post('terms_conditions'),
                'job_tags'                              => $this->input->post('job_tags'),

                //signature
                'company_representative_signature'     => $file_save,
                'company_representative_name'          => $this->input->post('company_representative_printed_name'),
                'primary_account_holder_signature'     => $file2_save,
                'primary_account_holder_name'          => $this->input->post('primary_account_holder_name'),
                'secondary_account_holder_signature'   => $file3_save,
                'secondary_account_holder_name'        => $this->input->post('secondery_account_holder_name'),
                'date_issued'                          => date("Y-m-d"),
                'install_date'                          => $this->input->post('installation_date'),
                'install_time'                          => $this->input->post('intall_time'),
                'status'                                => 'New',
                'employee_id'                           => $user_id,
                'is_template'                           => '1',
                'company_id'                            => $company_id,
                'date_created'                          => date("Y-m-d H:i:s"),
                'date_updated'                          => date("Y-m-d H:i:s"),
                'work_order_type_id'                    => '4',
                'industry_template_id'                  => '3'
                
            );

            $addQuery = $this->workorder_model->save_workorder($new_data);
            if( $addQuery > 0 ){
                if( $workorderSettings ){
                    //Update workorder setting
                    $workorder_settings_data = array(
                        'work_order_num_next' => $workorder_setting_next_num
                    );
                    $this->general->update_with_key($workorder_settings_data, $workorderSettings->id, 'work_order_settings');    
                }else{
                    $workorder_settings_data = array(
                        'job_num_prefix' => 'WO-',
                        'job_num_next' => $workorder_setting_next_num,
                        'company_id' => $company_id,
                    );
                    $this->general->add_($workorder_settings_data, 'work_order_settings');
                }                
            }

            $solarItems = array(
                'firstname'                 => $this->input->post('firstname'),
                'lastname'                  => $this->input->post('lastname'),
                'businessname'              => $this->input->post('businessname'),
                'firstname_spouse'          => $this->input->post('firstname_spouse'),
                'lastname_spouse'           => $this->input->post('lastname_spouse'),
                'address'                   => $this->input->post('address'),
                'city'                      => $this->input->post('city_form'),
                'state'                     => $this->input->post('state_form'),
                'county'                    => $this->input->post('county'),
                'postcode'                  => $this->input->post('postcode_form'),
                'first_ecn'                 => $this->input->post('first_ecn_first').' '.$this->input->post('first_ecn_last'),
                'second_ecn'                => $this->input->post('second_ecn_first').' '.$this->input->post('second_ecn_last'),
                'third_ecn'                 => $this->input->post('third_ecn_first').' '.$this->input->post('third_ecn_last'),
                'first_ecn_no'              => $this->input->post('first_ecn_no'),
                'second_ecn_no'             => $this->input->post('second_ecn_no'),
                'third_ecn_no'              => $this->input->post('third_ecn_no'),
                // 'installation_date'         => $this->input->post('installation_date'),
                // 'intall_time'               => $this->input->post('intall_time'),
                'sales_re_name'             => $this->input->post('sales_re_name'),
                'sale_rep_phone'            => $this->input->post('sale_rep_phone'),
                'team_leader'               => $this->input->post('team_leader'),
                'billing_date'              => $this->input->post('billing_date'),
                'company_id'                => $company_id,
                'work_order_id'             => $addQuery,
            );

            $solarItems = $this->workorder_model->save_agreement_items($solarItems);

            
            $item       = $this->input->post("item");
            $qty        = $this->input->post("qty");
            $existing   = $this->input->post("existing");
            $location   = $this->input->post("location");
            $price      = $this->input->post("price");

            $toi_check = $this->input->post("toi_check");
            $zl_check  = $this->input->post("zl_check");
            $trans_check = $this->input->post("trans_check");

            $checkValue = $this->input->post("dataValue");

            if($toi_check)
            {
                $checkData = $toi_check;
            }
            elseif($zl_check)
            {
                $checkData = $zl_check;
            }
            elseif($trans_check)
            {
                $checkData = $trans_check;
            }
            // elseif(!empty($trans_check))
            // {
            //     $checkData = $trans_check;
            // }
            else
            {
                $checkData = '';
            }
            
            $i = 0;

            foreach($item as $row){
                $data['item']           = $item[$i];
                $data['qty']            = $qty[$i];
                $data['existing']       = $existing[$i];
                $data['location']       = $location[$i];
                $data['price']          = $price[$i];
                $data['check_data']     = $checkValue[$i];
                $data['work_order_id']  = $addQuery;

                $result_set = $this->workorder_model->add_workorder_agreement_items($data);
                $i++;
            }

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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_dataa = array(
                        'fk_prof_id'            => $customer_id,
                        'card_fname'            => $this->input->post('firstname'),
                        'card_lname'            => $this->input->post('lastname'),
                        'card_address'          => $this->input->post('address'),
                        'city'                  => $this->input->post('city_form'),
                        'state'                 => $this->input->post('state_form'),
                        'zip'                   => $this->input->post('postcode_form'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                        'bill_method'           => 'CASH',
                    );
    
                    $pay1 = $this->workorder_model->save_payment_billing($payment_dataa);
                }
                elseif($this->input->post('payment_method') == 'Check'){
                    $payment_data = array(
                    
                        'payment_method'        => $this->input->post('payment_method'),
                        'amount'                => $this->input->post('payment_amount'),
                        'check_number'          => $this->input->post('check_number'),
                        'routing_number'        => $this->input->post('routing_number'),
                        'account_number'        => $this->input->post('account_number'),
                        'billing_date'          => $this->input->post('billing_date'),
                        'billing_frequency'     => $this->input->post('billing_frequency'),
                        'work_order_id'         => $addQuery,
                        'date_created'          => date("Y-m-d H:i:s"),
                        'date_updated'          => date("Y-m-d H:i:s")
                    );
    
                    $pay = $this->workorder_model->save_payment($payment_data);
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datab = array(
                        'fk_prof_id'            => $customer_id,
                        'card_fname'            => $this->input->post('firstname'),
                        'card_lname'            => $this->input->post('lastname'),
                        'card_address'          => $this->input->post('address'),
                        'city'                  => $this->input->post('city_form'),
                        'state'                 => $this->input->post('state_form'),
                        'zip'                   => $this->input->post('postcode_form'),
                        'bill_method'           => 'CHECK',
                        'check_num'             => $this->input->post('check_number'),
                        'routing_num'           => $this->input->post('routing_number'),
                        'acct_num'              => $this->input->post('account_number'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay2 = $this->workorder_model->save_payment_billing($payment_datab);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datac = array(
                        'fk_prof_id'            => $customer_id,
                        'card_fname'            => $this->input->post('firstname'),
                        'card_lname'            => $this->input->post('lastname'),
                        'card_address'          => $this->input->post('address'),
                        'city'                  => $this->input->post('city_form'),
                        'state'                 => $this->input->post('state_form'),
                        'zip'                   => $this->input->post('postcode_form'),
                        'bill_method'           => 'Invoicing',
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay3 = $this->workorder_model->save_payment_billing($payment_datac);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datad = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'CC',
                        'credit_card_num'           => $this->input->post('credit_number'),
                        'credit_card_exp'           => $this->input->post('credit_expiry'),
                        'credit_card_exp_mm_yyyy'   => $this->input->post('credit_cvc'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay4 = $this->workorder_model->save_payment_billing($payment_datad);
                    
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datae = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'DC',
                        'credit_card_num'           => $this->input->post('debit_credit_number'),
                        'credit_card_exp'           => $this->input->post('debit_credit_expiry'),
                        'credit_card_exp_mm_yyyy'   => $this->input->post('debit_credit_cvc'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay5 = $this->workorder_model->save_payment_billing($payment_datae);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_dataf = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'ACH',
                        'routing_num'               => $this->input->post('ach_routing_number'),
                        'acct_num'                  => $this->input->post('ach_account_number'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay6 = $this->workorder_model->save_payment_billing($payment_dataf);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datag = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'VENMO',
                        'account_credential'        => $this->input->post('account_credentials'),
                        'account_note'              => $this->input->post('account_note'),
                        'confirmation'              => $this->input->post('confirmation'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay7 = $this->workorder_model->save_payment_billing($payment_datag);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datah = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'PP',
                        'account_credential'        => $this->input->post('paypal_account_credentials'),
                        'account_note'              => $this->input->post('paypal_account_note'),
                        'confirmation'              => $this->input->post('paypal_confirmation'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay8 = $this->workorder_model->save_payment_billing($payment_datah);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datai = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'SQ',
                        'account_credential'        => $this->input->post('square_account_credentials'),
                        'account_note'              => $this->input->post('square_account_note'),
                        'confirmation'              => $this->input->post('square_confirmation'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay9 = $this->workorder_model->save_payment_billing($payment_datai);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_dataj = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'WW',
                        'account_credential'        => $this->input->post('warranty_account_credentials'),
                        'account_note'              => $this->input->post('warranty_account_note'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay10 = $this->workorder_model->save_payment_billing($payment_dataj);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datak = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'HOF',
                        'account_credential'        => $this->input->post('home_account_credentials'),
                        'account_note'              => $this->input->post('home_account_note'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay11 = $this->workorder_model->save_payment_billing($payment_datak);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datal = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'eT',
                        'account_credential'        => $this->input->post('e_account_credentials'),
                        'account_note'              => $this->input->post('e_account_note'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay12 = $this->workorder_model->save_payment_billing($payment_datal);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datam = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'OCCP',
                        'credit_card_num'           => $this->input->post('other_credit_number'),
                        'credit_card_exp'           => $this->input->post('other_credit_expiry'),
                        'credit_card_exp_mm_yyyy'   => $this->input->post('other_credit_cvc'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay13 = $this->workorder_model->save_payment_billing($payment_datam);
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
                    $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datan = array(
                        'fk_prof_id'                => $customer_id,
                        'card_fname'                => $this->input->post('firstname'),
                        'card_lname'                => $this->input->post('lastname'),
                        'card_address'              => $this->input->post('address'),
                        'city'                      => $this->input->post('city_form'),
                        'state'                     => $this->input->post('state_form'),
                        'zip'                       => $this->input->post('postcode_form'),
                        'bill_method'               => 'OPT',
                        'account_credential'        => $this->input->post('other_payment_account_credentials'),
                        'account_note'              => $this->input->post('other_payment_account_note'),
                        'equipment'             => $equip,
                        'initial_dep'           => $this->input->post('otps'),
                        'mmr'                   => $this->input->post('monthlyMonitoring'),
                        'recurring_start_date'  => $this->input->post('installation_date'),
                        'bill_freq'             => 'Every 1 Month',
                    );
    
                    $pay14 = $this->workorder_model->save_payment_billing($payment_datan);
                }

        }

        //SMS Notification        
        createCronAutoSmsNotification($company_id, $addQuery, 'workorder', 'New', $user_id, 0, $user_id);   

        customerAuditLog(logged('id'), $customer_id, $addQuery, 'Workorder', 'Created workorder #'.$this->input->post('workorder_number'));
        
        
        if($action == 'preview') {
            $dataaa = $this->input->post('workorder_number');
            $this->page_data['users'] = $this->users_model->getUser(logged('id'));

            $this->load->library('pdf');
            $html = $this->load->view('workorder/previewAlarm', [], true);
            $this->pdf->createPDF($html, 'mypdf', false);
            exit(0);
        }

        redirect('workorder');

    }

    public function sendEmailAdmin()
    {
            //         include APPPATH . 'libraries/PHPMailer/PHPMailerAutoload.php';

            //         $server    = MAIL_SERVER;
            //         $recipient = 'emploucelle@gmail.com';
            //         $port      = MAIL_PORT ;
            //         $username  = MAIL_USERNAME;
            //         $password  = MAIL_PASSWORD;
            //         $from      = MAIL_FROM;

            //         $mail = new PHPMailer;
            //         $mail->SMTPDebug = 4;                         
            //         $mail->isSMTP();                                     
            //         $mail->Host = $server; 
            //         $mail->SMTPAuth = true;  
                         
            //         $mail->Username   = $username; 
            //         $mail->Password   = $password;

            //         $mail->getSMTPInstance()->Timelimit = 5;
            //         $mail->SMTPSecure = 'ssl';   
            //         //$mail->SMTPSecure = "tls";                           
            //         $mail->Timeout    =   10; // set the timeout (seconds)
            //         $mail->Port = $port;

            //         $subject = "NsmarTrac : Workorder Agreement"; 
            //         $msg = "<p>Hi,</p>";
            //         $msg .= "<p>This is a test</p>";
            //         // $msg .= "<p>Click <a href='#'>Your Estimate</a> to view and approve estimate.</p><br />";
            //         // $msg .= "<p>Thank you <br /><br /> NsmarTrac Team</p>";

            //         $mail->From = $from;
            //         $mail->FromName = 'NsmarTrac';
            //         $mail->addAddress($recipient, $recipient);  
            //         $mail->isHTML(true);                          
            //         $mail->Subject = $subject;
            //         $mail->Body    = $msg;

            //         if(!$mail->Send()) {
            //             echo 'Message could not be sent.';
            //             echo 'Mailer Error: ' . $mail->ErrorInfo;
            //         } else {
            //             echo 'Message has been sent test';
            //         }

            // exit;

            // $date_to = date("Y-m-d", strtotime('saturday this week', strtotime(date('Y-m-d'))));
            // $subj_date_to = date("d", strtotime($date_to));
            // if (date("d", strtotime($date_from)) > date("d", strtotime($date_to))) {
            //     $subj_date_to = date("M d", strtotime($date_to));
            // }

            $receiver = 'emploucelle@gmail.com';

            $server = MAIL_SERVER;
            $port = MAIL_PORT;
            $username = MAIL_USERNAME;
            $password = MAIL_PASSWORD;
            $from = MAIL_FROM;
            $subject = "NsmarTrac : Workorder Agreement";
    
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->getSMTPInstance()->Timelimit = 5;
            $mail->Host = $server;
            $mail->SMTPAuth = true;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'ssl';
            $mail->Timeout = 10; // seconds
            $mail->Port = $port;
            $mail->From = $from;
            $mail->FromName = 'nSmarTrac';
            $mail->Subject = $subject;
    
            // $this->page_data['company_name'] = $company_name;
            // $this->page_data['date_from'] = $date_from;
            // $this->page_data['date_to'] = date("Y-m-d", strtotime('saturday this week', strtotime(date('Y-m-d'))));
            // $this->page_data['business_name'] = $business_name;
            // $this->page_data['FName'] = $FName;
            // $this->page_data['file_info'] = $file_info;
            // $this->page_data['file_link'] = base_url() . '/timesheet/timelogs/' . $filename;
            // $this->page_data['has_logo'] = false;
            // $this->page_data['est_wage_privacy'] = $est_wage_privacy;
            $mail->IsHTML(true);
            // $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');
            // $filePath = base_url() . '/uploads/users/business_profile/' . $logo_folder . '/' . $company_logo;
            // if (@getimagesize($filePath)) {
            //     $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/uploads/users/business_profile/' . $logo_folder . '/' . $company_logo, 'company_logo', $company_logo);
            //     $this->page_data['has_logo'] = true;
            // }
            $mail->Body =  'Test';
            $content =  "<p>Click <a href='#'>Your test</a> to view and approve test.</p><br />";
            $mail->MsgHTML($content);
            $mail->addAddress('emploucelle@gmail.com');
            // echo "pasok";
            $mail->addAddress($receiver);
            if (!$mail->Send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                exit;
            }
    }

    
    public function updateWorkorderAgreement()
    {
        $this->load->model('Customer_advance_model');
        $this->load->model('AcsProfile_model');

        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $id = $this->input->post('wo_id');
        $wo_id = $this->input->post('wo_id');

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
            $file               = $folderPath. $rand1 . $wo_id . '_installation_company' . '.'.$image_type;
            $file_save          = 'uploads/Signatures/1/'. $rand1 . $wo_id . '_installation_company' . '.'.$image_type;
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
            $file2              = $folderPath2. $rand2 . $wo_id . '_installation_primary' . '.'.$image_type2;
            $file2_save         = 'uploads/Signatures/1/'. $rand2 . $wo_id . '_installation_primary' . '.'.$image_type2;
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
            $file3              = $folderPath3. $rand3 . $wo_id . '_installation_secondary' . '.'.$image_type3;
            $file3_save         = 'uploads/Signatures/1/'. $rand3 . $wo_id . '_installation_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else{
            $three = $this->workorder_model->getById($id);
            $file3_save = $three->secondary_account_holder_signature;
        }
        
        // $action = $this->input->post('action');
        // if($action == 'Submit') {
            $dateIssued = date('Y-m-d', strtotime($this->input->post('schedule_date_given')));

        // $acs = array(
        //     'prof_id'                   => $this->input->post('acs_id'),
        //     'customer_type'             => $this->input->post('customer_type'),
        //     'business_name'             => $this->input->post('business_name'), //new
        //     'install_type'              => $this->input->post('install_type'),
        //     'last_name'                 => $this->input->post('last_name'),
        //     'first_name'                => $this->input->post('first_name'),
        //     'phone_h'                   => $this->input->post('phone_number'),
        //     'phone_m'                   => $this->input->post('mobile_number'), //new
        //     'date_of_birth'             => $this->input->post('dob'), //new
        //     'ssn'                       => $this->input->post('security_number'), //new
        //     's_last_name'               => $this->input->post('s_last_name'),
        //     'email'                     => $this->input->post('email'),
        //     's_first_name'              => $this->input->post('s_first_name'),
        //     's_mobile'                  => $this->input->post('s_mobile'),
        //     's_dob'                     => $this->input->post('s_dob'),
        //     's_ssn'                     => $this->input->post('s_ssn'),
        //     'notification_type'         => $this->input->post('notification_type'),

        //     'mail_add'                  => $this->input->post('monitored_location'), //new
        //     'city'                      => $this->input->post('city'), //new
        //     'state'                     => $this->input->post('state'), //new
        //     'zip_code'                  => $this->input->post('zip_code'), //new
        //     'cross_street'              => $this->input->post('cross_street'), //new
        // );

        // $w_acs = $this->workorder_model->update_acs_alarm($acs);


        $dateIssued = date('Y-m-d', strtotime($this->input->post('current_date')));

        $new_data = array(
            // 'work_order_number'                     => $this->input->post('workorder_number'),
            // 'customer_id'                           => $w_acs,
            'id'                                    => $id,
            'phone_number'                          => $this->input->post('phone'),
            'mobile_number'                         => $this->input->post('mobile'),
            'email'                                 => $this->input->post('email'),
            // 'employee_id' => '0',
            'job_location'                          => $this->input->post('address'),
            'city'                                  => $this->input->post('city'),
            'state'                                 => $this->input->post('state'),
            'country'                               => $this->input->post('country'),
            'zip_code'                              => $this->input->post('postcode'),
            // 'comments'                              => $this->input->post('comments'),
            'payment_method'                        => $this->input->post('payment_method'),
            'payment_amount'                        => $this->input->post('payment_amount'),
            // 'header'                                => $this->input->post('header'),
            'date_issued'                           => $dateIssued,

            'lead_source_id'                        => $this->input->post('lead_source'),
            'panel_type'                            => $this->input->post('panel_type'),
            'panel_communication'                   => $this->input->post('communication_type'),
            'account_type'                          => $this->input->post('account_type'),
            'job_tags'                              => $this->input->post('job_tags'),

            'comments'                              => $this->input->post('notes'),
            'password'                              => $this->input->post('password'),
            'security_number'                       => $this->input->post('ssn'),

            'status'                                => $this->input->post('status'), //Added by Bryann Revina
            //'agent_id'                              => $this->input->post('agent_id'), //Added by Bryann Revina

            'subtotal'                              => $this->input->post('equipmentCost'),
            'taxes'                                 => $this->input->post('salesTax'),
            'installation_cost'                     => $this->input->post('installationCost'),
            'otp_setup'                             => $this->input->post('otps'),
            'monthly_monitoring'                    => $this->input->post('monthlyMonitoring'),
            'grand_total'                           => $this->input->post('totalDue'),
            'terms_and_conditions'                  => $this->input->post('terms_conditions'),

            
            'install_date'                          => $this->input->post('installation_date'),
            'install_time'                          => $this->input->post('intall_time'),

             //signature
             'company_representative_signature'     => $file_save,
             'company_representative_name'          => $this->input->post('company_representative_printed_name'),
             'primary_account_holder_signature'     => $file2_save,
             'primary_account_holder_name'          => $this->input->post('primary_account_holder_name'),
             'secondary_account_holder_signature'   => $file3_save,
             'secondary_account_holder_name'        => $this->input->post('secondery_account_holder_name'),

            'date_updated'                          => date("Y-m-d H:i:s")
            
        );

        $addQuery = $this->workorder_model->update_workorder_installation($new_data);

        //SMS Notification   
        $smsWo = $this->workorder_model->getById($id);      
        createCronAutoSmsNotification($company_id, $smsWo->id, 'workorder', $this->input->post('status'), $smsWo->employee_id, 0, $smsWo->employee_id);        

        $objWorkOrder = $this->workorder_model->getDataByWO($this->input->post('wo_id'));
        if( $objWorkOrder ){
            customerAuditLog(logged('id'), $objWorkOrder->customer_id, $objWorkOrder->id, 'Workorder', 'Updated workorder #'.$objWorkOrder->work_order_number);
        }        

        $solarItemsACS = array(
            'customer_id'               => $this->input->post('customer_id'),
            'last_name'                 => $this->input->post('lastname'),
            'first_name'                => $this->input->post('firstname'),
            'phone_h'                   => $this->input->post('phone'), //new
            'phone_m'                   => $this->input->post('mobile'), //new
            'email'                     => $this->input->post('email'),
            'mail_add'                  => $this->input->post('address'), //new
            'city'                      => $this->input->post('city'), //new
            'country'                   => $this->input->post('country'), //new
            'zip_code'                  => $this->input->post('postcode'), //new
        );

        $w_acs = $this->workorder_model->update_alarm($solarItemsACS);

        $customer_id = $this->input->post('customer_id');

        // $w_acs1a = $this->workorder_model->getLast();
        // $w_acs = $w_acs1a->prof_id;

        // echo $w_acs;

        // $solarItemsOffice = array(
        //     'customer_id'               => $customer_id,
        //     'lead_source'               => $this->input->post('lead_source'),
        //     'save_by'                   => $user_id,
        //     'equipment_cost'            => $this->input->post('equipmentCost'),
        //     'monthly_monitoring'        => $this->input->post('otps'),
        // );

        // $solarItemsOffices = $this->workorder_model->update_office($solarItemsOffice);
        $solarItemsOffice = array(
            'fk_prof_id'                => $customer_id,
            'lead_source'               => $this->input->post('lead_source'),
            'save_by'                   => $user_id,
            'fk_sales_rep_office'       => $user_id,
            'equipment_cost'            => $equip,
            'monthly_monitoring'        => $this->input->post('otps'),
            'sales_date'                => date("m/d/Y"),
        );

        $solarItemsOffices = $this->workorder_model->update_office($solarItemsOffice);

        // $alarmInfoData = array(
        //     'customer_id'                => $customer_id,
        //     'equipment_cost'            => $this->input->post('equipmentCost'),
        //     'monthly_monitoring'        => $this->input->post('otps'),
        //     'panel_type'                => $this->input->post('panel_type'),
        // );

        // $alarmInfoDatas = $this->workorder_model->update_alarm_adi($alarmInfoData);

        //Update alarm info        
        $alarmInfoData = array(
            'fk_prof_id'                => $customer_id,
            'equipment_cost'            => $this->input->post('equipmentCost'),
            'monthly_monitoring'        => $this->input->post('monthlyMonitoring'),
            'panel_type'                => $this->input->post('panel_type'),
            'otps'                      => $this->input->post('otps'),
            'system_type'               => $this->input->post('communication_type'),
            'acct_type'                 => $this->input->post('account_type'),
            'passcode'                  => $this->input->post('password'),
            'comm_type'                 => $this->input->post('communication_type'),
        );

        $alarmInfoDatas = $this->workorder_model->update_alarm_adi_by_customer_id($customer_id, $alarmInfoData);
        

        $deleteContacts = $this->workorder_model->delete_contact($customer_id);

        if( $this->input->post('ec1_firstname') != '' ){
            $name = $this->input->post('ec1_firstname') . ' ' . $this->input->post('ec1_lastname');
            $contact = array(
                'first_name' => $this->input->post('ec1_firstname'), 
                'last_name' => $this->input->post('ec1_lastname'),
                'relation' => $this->input->post('ec1_relationship'),
                'name' => $name,
                'phone' => $this->input->post('ec1_phone'),
                'customer_id' => $customer_id,
            );
            $contacts1 = $this->workorder_model->save_contact($contact);
        }

        if( $this->input->post('ec2_firstname') != '' ){
            $name = $this->input->post('ec2_firstname') . ' ' . $this->input->post('ec2_lastname');
            $contact = array(
                'first_name' => $this->input->post('ec2_firstname'), 
                'last_name' => $this->input->post('ec2_lastname'),
                'relation' => $this->input->post('ec2_relationship'),
                'name' => $name,
                'phone' => $this->input->post('ec2_phone'),
                'customer_id' => $customer_id,
            );

            $contacts2 = $this->workorder_model->save_contact($contact);
        }

        if( $this->input->post('ec3_firstname') != '' ){
            $name = $this->input->post('ec3_firstname') . ' ' . $this->input->post('ec3_lastname');
            $contact = array(
                'first_name' => $this->input->post('ec3_firstname'), 
                'last_name' => $this->input->post('ec3_lastname'),
                'relation' => $this->input->post('ec3_relationship'),
                'name' => $name,
                'phone' => $this->input->post('ec3_phone'),
                'customer_id' => $customer_id,
            );

            $contacts3 = $this->workorder_model->save_contact($contact);
        }

        //Update customer info
        $customer = $this->AcsProfile_model->getByProfId($customer_id);
        if( $customer ){
            $data = [
                'ssn' => $this->input->post('ssn') 
            ];
            $this->AcsProfile_model->updateCustomerByProfId($customer_id, $data);
        }

        //Update office data
        $officeData = $this->Customer_advance_model->getCustomerOfficeData($customer_id);
        if( $officeData ){
            $update_office = [                
                'off_id' => $officeData->off_id,
                'lead_source' => $this->input->post('lead_source')
            ];
            $this->Customer_advance_model->update_data($update_office,'acs_office','off_id');
        }

        if($this->input->post('payment_method') == 'Cash'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'is_collected'      => '1',
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_cash($payment_data);
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
            $payment_dataa = array(
                'fk_prof_id'            => $customer_id,
                'card_fname'            => $this->input->post('firstname'),
                'card_lname'            => $this->input->post('lastname'),
                'card_address'          => $this->input->post('address'),
                'city'                  => $this->input->post('city'),
                'state'                 => $this->input->post('state'),
                'zip'                   => $this->input->post('postcode'),
                'bill_method'           => 'CASH',
            );

            $pay1 = $this->workorder_model->save_payment_billing($payment_dataa);
        }
        elseif($this->input->post('payment_method') == 'Check'){
            $payment_data = array(
            
                'payment_method'    => $this->input->post('payment_method'),
                'amount'            => $this->input->post('payment_amount'),
                'check_number'      => $this->input->post('check_number'),
                'routing_number'    => $this->input->post('routing_number'),
                'account_number'    => $this->input->post('account_number'),
                'work_order_id'     => $id,
                'date_updated'      => date("Y-m-d H:i:s")
            );

            $pay = $this->workorder_model->update_check($payment_data);
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
                    $payment_datab = array(
                        'fk_prof_id'            => $customer_id,
                        'card_fname'            => $this->input->post('firstname'),
                        'card_lname'            => $this->input->post('lastname'),
                        'card_address'          => $this->input->post('address'),
                        'city'                  => $this->input->post('city'),
                        'state'                 => $this->input->post('state'),
                        'zip'                   => $this->input->post('postcode'),
                        'bill_method'           => 'CHECK',
                        'check_num'             => $this->input->post('check_number'),
                        'routing_num'           => $this->input->post('routing_number'),
                        'acct_num'              => $this->input->post('account_number'),
                    );
    
                    $pay2 = $this->workorder_model->save_payment_billing($payment_datab);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);
    
            $payment_datad = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'CC',
                'credit_card_num'           => $this->input->post('credit_number'),
                'credit_card_exp'           => $this->input->post('credit_expiry'),
                'credit_card_exp_mm_yyyy'   => $this->input->post('credit_cvc'),
            );

            $pay4 = $this->workorder_model->save_payment_billing($payment_datad);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datae = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'DC',
                'credit_card_num'           => $this->input->post('debit_credit_number'),
                'credit_card_exp'           => $this->input->post('debit_credit_expiry'),
                'credit_card_exp_mm_yyyy'   => $this->input->post('debit_credit_cvc'),
            );

            $pay5 = $this->workorder_model->save_payment_billing($payment_datae);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_dataf = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'ACH',
                'routing_num'               => $this->input->post('ach_routing_number'),
                'acct_num'                  => $this->input->post('ach_account_number'),
            );

            $pay6 = $this->workorder_model->save_payment_billing($payment_dataf);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datag = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'VENMO',
                'account_credential'        => $this->input->post('account_credentials'),
                'account_note'              => $this->input->post('account_note'),
                'confirmation'              => $this->input->post('confirmation'),
            );

            $pay7 = $this->workorder_model->save_payment_billing($payment_datag);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datah = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'PP',
                'account_credential'        => $this->input->post('paypal_account_credentials'),
                'account_note'              => $this->input->post('paypal_account_note'),
                'confirmation'              => $this->input->post('paypal_confirmation'),
            );

            $pay8 = $this->workorder_model->save_payment_billing($payment_datah);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datai = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'SQ',
                'account_credential'        => $this->input->post('square_account_credentials'),
                'account_note'              => $this->input->post('square_account_note'),
                'confirmation'              => $this->input->post('square_confirmation'),
            );

            $pay9 = $this->workorder_model->save_payment_billing($payment_datai);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_dataj = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'WW',
                'account_credential'        => $this->input->post('warranty_account_credentials'),
                'account_note'              => $this->input->post('warranty_account_note'),
            );

            $pay10 = $this->workorder_model->save_payment_billing($payment_dataj);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datak = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'HOF',
                'account_credential'        => $this->input->post('home_account_credentials'),
                'account_note'              => $this->input->post('home_account_note'),
            );

            $pay11 = $this->workorder_model->save_payment_billing($payment_datak);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datal = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'eT',
                'account_credential'        => $this->input->post('e_account_credentials'),
                'account_note'              => $this->input->post('e_account_note'),
            );

            $pay12 = $this->workorder_model->save_payment_billing($payment_datal);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datam = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'OCCP',
                'credit_card_num'           => $this->input->post('other_credit_number'),
                'credit_card_exp'           => $this->input->post('other_credit_expiry'),
                'credit_card_exp_mm_yyyy'   => $this->input->post('other_credit_cvc'),
            );

            $pay13 = $this->workorder_model->save_payment_billing($payment_datam);
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
            $delete_payment_billing = $this->workorder_model->delete_payment_billing($customer_id);

            $payment_datan = array(
                'fk_prof_id'                => $customer_id,
                'card_fname'                => $this->input->post('firstname'),
                'card_lname'                => $this->input->post('lastname'),
                'card_address'              => $this->input->post('address'),
                'city'                      => $this->input->post('city'),
                'state'                     => $this->input->post('state'),
                'zip'                       => $this->input->post('postcode'),
                'bill_method'               => 'OPT',
                'account_credential'        => $this->input->post('other_payment_account_credentials'),
                'account_note'              => $this->input->post('other_payment_account_note'),
            );

            $pay14 = $this->workorder_model->save_payment_billing($payment_datan);
        }

        $installationItems = array(
            'firstname'                 => $this->input->post('firstname'),
            'lastname'                  => $this->input->post('lastname'),
            'businessname'              => $this->input->post('businessname'),
            'firstname_spouse'          => $this->input->post('firstname_spouse'),
            'lastname_spouse'           => $this->input->post('lastname_spouse'),
            'address'                   => $this->input->post('address'),
            'city'                      => $this->input->post('city'),
            'state'                     => $this->input->post('state'),
            'county'                    => $this->input->post('county'),
            'postcode'                  => $this->input->post('postcode'),
            'first_ecn'                 => $this->input->post('first_ecn'),
            'second_ecn'                => $this->input->post('second_ecn'),
            'third_ecn'                 => $this->input->post('third_ecn'),
            'first_ecn_no'              => $this->input->post('first_ecn_no'),
            'second_ecn_no'             => $this->input->post('second_ecn_no'),
            'third_ecn_no'              => $this->input->post('third_ecn_no'),
            // 'installation_date'         => $this->input->post('installation_date'),
            // 'intall_time'               => $this->input->post('intall_time'),
            'sales_re_name'             => $this->input->post('sales_re_name'),
            'sale_rep_phone'            => $this->input->post('sale_rep_phone'),
            'team_leader'               => $this->input->post('team_leader'),
            'billing_date'              => $this->input->post('billing_date'),
            'work_order_id'             => $id,
        );

        $insItems = $this->workorder_model->updateWorkorderAgreement($installationItems);
        

        $delete2 = $this->workorder_model->delete_items_installation($id);

        $item       = $this->input->post("item");
        $qty        = $this->input->post("qty");
        $location   = $this->input->post("location");
        $price      = $this->input->post("price");
        $existing   = $this->input->post("existing");

        $toi_check = $this->input->post("toi_check");
        $zl_check  = $this->input->post("zl_check");
        $trans_check = $this->input->post("trans_check");

        $checkValue = $this->input->post("dataValue");

        if($toi_check)
        {
            $checkData = $toi_check;
        }
        elseif($zl_check)
        {
            $checkData = $zl_check;
        }
        elseif($trans_check)
        {
            $checkData = $trans_check;
        }
        // elseif(!empty($trans_check))
        // {
        //     $checkData = $trans_check;
        // }
        else
        {
            $checkData = '';
        }
        
        $i = 0;

        foreach($item as $row){
            $data['item']           = $item[$i];
            $data['qty']            = $qty[$i];
            $data['existing']       = $existing[$i];
            $data['location']       = $location[$i];
            $data['price']          = $price[$i];
            $data['check_data']     = $checkValue[$i];
            $data['work_order_id']  = $id;

            $result_set = $this->workorder_model->add_workorder_agreement_items($data);
            $i++;
        }

        if (!is_null($this->input->get('json', TRUE))) {
            header('content-type: application/json');
            exit(json_encode(['id' => $addQuery]));
        } else {
            redirect('workorder');
        }

        // }
        
        //     if($action == 'preview') {
        //         $dataaa = $this->input->post('workorder_number');
        //         $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        //         $this->load->library('pdf');
        //         $html = $this->load->view('workorder/previewAlarm', [], true);
        //         $this->pdf->createPDF($html, 'mypdf', false);
        //         exit(0);

        //     }
    }

    public function updateWorkorderSolar()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $id = $this->input->post('wo_id');
        $wo_id = $this->input->post('wo_id');

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
            $file               = $folderPath. $rand1 . $wo_id . '_installation_company' . '.'.$image_type;
            $file_save          = 'uploads/Signatures/1/'. $rand1 . $wo_id . '_installation_company' . '.'.$image_type;
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
            $file2              = $folderPath2. $rand2 . $wo_id . '_installation_primary' . '.'.$image_type2;
            $file2_save         = 'uploads/Signatures/1/'. $rand2 . $wo_id . '_installation_primary' . '.'.$image_type2;
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
            $file3              = $folderPath3. $rand3 . $wo_id . '_installation_secondary' . '.'.$image_type3;
            $file3_save         = 'uploads/Signatures/1/'. $rand3 . $wo_id . '_installation_secondary' . '.'.$image_type3;
            file_put_contents($file3, $image_base643);
        }
        else{
            $three = $this->workorder_model->getById($id);
            $file3_save = $three->secondary_account_holder_signature;
        }
        
        // $action = $this->input->post('action');
        // if($action == 'Submit') {
            $dateIssued = date('Y-m-d', strtotime($this->input->post('schedule_date_given')));

        $acs = array(
            'prof_id'                   => $this->input->post('acs_id'),
            'last_name'                 => $this->input->post('lastname'),
            'first_name'                => $this->input->post('firstname'),
            'phone_h'                   => $this->input->post('phone'),
            'phone_m'                   => $this->input->post('mobile'),
            'email'                     => $this->input->post('email'),
            'country'                   => $this->input->post('country'),

            'mail_add'                  => $this->input->post('address'),
            'city'                      => $this->input->post('city'),
            'state'                     => $this->input->post('state'),
            'zip_code'                  => $this->input->post('postcode'),
        );

        $w_acs = $this->workorder_model->update_acs_solar($acs);


        $dateIssued = date('Y-m-d', strtotime($this->input->post('current_date')));

        $new_data = array(
            
            'id'                                    => $id,
            'phone_number'                          => $this->input->post('phone'),
            'mobile_number'                         => $this->input->post('mobile'),
            'email'                                 => $this->input->post('email'),
            
            'job_location'                          => $this->input->post('address'),
            'city'                                  => $this->input->post('city'),
            'state'                                 => $this->input->post('state'),
            'country'                               => $this->input->post('country'),
            'zip_code'                              => $this->input->post('postcode'),
            
            'payment_method'                        => $this->input->post('payment_method'),
            'payment_amount'                        => $this->input->post('payment_amount'),

            'status'                                => $this->input->post('status'), //Added Bryann Revina 08132022
            //'agent_id'                              => $this->input->post('agent_id'), //Added Bryann Revina 08152022

            'lead_source_id'                        => $this->input->post('lead_source'),
            'panel_communication'                   => $this->input->post('system_type'),

            'comments'                              => $this->input->post('comments'),

             //signature
             'company_representative_signature'     => $file_save,
             'company_representative_name'          => $this->input->post('company_representative_printed_name'),
             'primary_account_holder_signature'     => $file2_save,
             'primary_account_holder_name'          => $this->input->post('primary_account_holder_name'),
             'secondary_account_holder_signature'   => $file3_save,
             'secondary_account_holder_name'        => $this->input->post('secondery_account_holder_name'),

            'date_updated'                          => date("Y-m-d H:i:s")
            
        );

        $addQuery = $this->workorder_model->update_workorder_solar($new_data);

        //SMS Notification      
        $smsWo = $this->workorder_model->getById($id);          
        createCronAutoSmsNotification($company_id, $smsWo->id, 'workorder', $this->input->post('status'), $smsWo->employee_id, 0, $smsWo->employee_id);


        $objWorkOrder = $this->workorder_model->getDataByWO($this->input->post('wo_id'));
        if( $objWorkOrder ){
            customerAuditLog(logged('id'), $objWorkOrder->customer_id, $objWorkOrder->id, 'Workorder', 'Updated workorder #'.$objWorkOrder->work_order_number);
        }        
        

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

        
        if (!is_null($this->input->get('json', TRUE))) {
            header('content-type: application/json');
            exit(json_encode(['id' => $addQuery]));
        } else {
            redirect('workorder');
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

        $html .= '<div style="margin-top:12%;"><b>FROM:</b> <br>'.$company->first_name.' '.$company->last_name.'<br>Address: '.$company->business_address.'<br> Phone: '.$company->phone_number.'</div><br><br>';
        $html .= '<div><b>TO:</b> <br>'.$acs->first_name.' '.$acs->last_name.'<br>'.$acs->business_name.'<br>Address: '.$acs->mail_add.' '.$acs->city.' '.$acs->state.' '.$acs->country.' '.$acs->zip_code.' '.$acs->cross_street.' '.'<br>Email: '.$acs->email.'<br>Phone:'.$acs->phone_h.'<br> Mobile: '.$acs->phone_m.'</div><br><br>';

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

        // $html .= '<div><b>ACCEPTED PAYMENT METHODS:</b><hr>
        //         <ul>
        //             <li>Cash</li>
        //             <li>Check</li>
        //             <li>Credit Card</li>
        //             <li>Debit Card</li>
        //             <li>ACH</li>
        //             <li>Venmo</li>
        //             <li>Paypal</li>
        //             <li>Square</li>
        //             <li>Invoicing</li>
        //             <li>Warranty Work</li>
        //             <li>Home Owner Financing</li>
        //             <li>Home Owner Financing</li>
        //             <li>e-Transfer</li>
        //             <li>Other Credit Card Professor</li>
        //             <li>Other Payment Type</li>
        //         </ul> </div>
        //         ';
            
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

    public function ajax_load_count_summary()
    {
        $cid = logged('company_id');

        $count_all = $this->workorder_model->countAllByStatusAndCompanyId('all', $cid);
        $count_new = $this->workorder_model->countAllByStatusAndCompanyId('new', $cid);
        $count_scheduled = $this->workorder_model->countAllByStatusAndCompanyId('scheduled', $cid);
        $count_started   = $this->workorder_model->countAllByStatusAndCompanyId('started', $cid);
        $count_paused    = $this->workorder_model->countAllByStatusAndCompanyId('paused', $cid);
        $count_invoiced  = $this->workorder_model->countAllByStatusAndCompanyId('invoiced', $cid);
        $count_withdrawn = $this->workorder_model->countAllByStatusAndCompanyId('withdrawn', $cid);
        $count_closed    = $this->workorder_model->countAllByStatusAndCompanyId('closed', $cid);

        $json_data = [
            'count_all' => $count_all,
            'count_new' => $count_new,
            'count_scheduled' => $count_scheduled,
            'count_started' => $count_started,
            'count_paused' => $count_paused,
            'count_invoiced' => $count_invoiced,
            'count_withdrawn' => $count_withdrawn,
            'count_closed' => $count_closed
        ];

        echo json_encode($json_data);
    }

    public function ajax_delete_custom_field()
    {
        $is_deleted = 0;

        $post = $this->input->post();
        $this->workorder_model->delete_custom_fields_by_id($post['cfid']);
        
        $is_deleted = 1;

        $json = ['is_deleted' => $is_deleted];
        echo json_encode($json);
    }

    public function ajax_save_checklist()
    {
        $this->load->model('Checklist_model');
        $this->load->model('ChecklistItem_model');

        $is_success = 0;
        $msg = 'Cannot save data.';

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $user_id = logged('id');
        $company_id = logged('company_id'); 

        $isExists = $this->Checklist_model->getByNameAndCompanyId($post['checklist_name'], $company_id);
        if( $isExists ){
            $msg = 'Checklist name already exists.';
        }else{
            $data = [
                'company_id' => $company_id,
                'user_id' => $user_id,
                'checklist_name' => $post['checklist_name'],
                'attach_to_work_order' => $post['attach_to_work_order'],
                'date_created' => date("m-d-Y H:i:s"),
                'date_modified' => date("m-d-Y H:i:s")
            ];
    
            $cid = $this->Checklist_model->create($data);
    
            if( isset($post['checklistItems']) ){
                foreach( $post['checklistItems'] as $key => $item ){
                    $data = [
                        'checklist_id' => $cid,
                        'item_name' => $item
                    ];
    
                    $this->ChecklistItem_model->create($data);
                }    
            }

            //Activity Logs
            $activity_name = 'Checklists : Created checklist ' . $post['checklist_name']; 
            createActivityLog($activity_name);
    
            $is_success = 1;
            $msg = '';
        }
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_update_checklist()
    {
        $this->load->model('Checklist_model');
        $this->load->model('ChecklistItem_model');

        $is_success = 0;

        $user = $this->session->userdata('logged');
        $post = $this->input->post();
        $user_id = logged('id');

        $checklist = $this->Checklist_model->getById($post['cid']);
        
        if( $checklist ){
            $data = [
                'checklist_name' => $post['checklist_name'],
                'attach_to_work_order' => $post['attach_to_work_order'],
                'date_modified' => date("m-d-Y H:i:s")
            ];

            $this->Checklist_model->update($checklist->id, $data);

            $this->ChecklistItem_model->deleteAllByChecklistId($checklist->id);

            if( isset($post['checklistItems']) ){
                foreach( $post['checklistItems'] as $key => $item ){
                    $data = [
                        'checklist_id' => $checklist->id,
                        'item_name' => $item
                    ];

                    $this->ChecklistItem_model->create($data);
                }    
            }

            //Activity Logs
            $activity_name = 'Checklists : Updated checklist ' . $post['checklist_name']; 
            createActivityLog($activity_name);

            $is_success = 1;
        }
        
        $json_data  = ['is_success' => $is_success];

        echo json_encode($json_data);
    }

    public function delete_checklist()
    {
        $this->load->model('ChecklistItem_model');
        $this->load->model('Checklist_model');

        $post = $this->input->post();
        $checklist = $this->Checklist_model->getById($post['cid']);
        if( $checklist ){

            $this->ChecklistItem_model->deleteAllByChecklistId($checklist->id);
            $this->Checklist_model->deleteById($checklist->id);

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Checklist was successfully deleted');
        }else{
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot find data');
        }

        redirect('workorder/checklists');
    }

    public function delete_priority()
    {
        $this->load->model('PriorityList_model');
        $post = $this->input->post();

        if( $post['pid'] > 0 ){
            $this->PriorityList_model->delete($post['pid']);

            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'Data was successfully deleted');
        }else{
            $this->session->set_flashdata('alert-type', 'danger');
            $this->session->set_flashdata('alert', 'Cannot find data');
        }

        redirect('workorder/priority/');
    }

    public function ajax_delete_checklist()
    {
        $this->load->model('ChecklistItem_model');
        $this->load->model('Checklist_model');

        $is_success = 1;
        $msg = '';

        $post = $this->input->post();
        $company_id = logged('company_id');

        $checklist = $this->Checklist_model->getById($post['cid']);
        if( $checklist && $checklist->company_id == $company_id ){
            $this->ChecklistItem_model->deleteAllByChecklistId($checklist->id);
            $this->Checklist_model->deleteById($checklist->id);

            //Activity Logs
            $activity_name = 'Checklists : Deleted checklist ' . $checklist->checklist_name; 
            createActivityLog($activity_name);

        }else{
            $is_success = 0;
            $msg = 'Cannot find data';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_create_workorder_priority()
    {
        $this->load->model('PriorityList_model');

        $is_success = 0;
        $msg = 'Cannot save data';

        $post        = $this->input->post();
        $company_id  = logged('company_id');
        $user_id     = logged('id');

        $isExists = $this->PriorityList_model->getByTitleAndCompanyId($post['priority_name'], $company_id);
        if( !$isExists ){
            if( $post['priority_name'] != '' ){
                $data = [
                    'user_id' => $user_id,
                    'company_id' => $company_id,
                    'title' => $post['priority_name'],
                    'status' => 1,
                    'created_at' => date("Y-m-d H:i:s")
                ];
    
                $this->PriorityList_model->create($data);

                //Activity Logs
                $activity_name = 'Workorder Priority : Created workorder priority ' . $post['priority_name']; 
                createActivityLog($activity_name);
    
                $is_success = 1;    
                $msg = '';
            }    
        }else{
            $msg = 'Priority name already exists.';
        }
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_update_workorder_priority()
    {
        $this->load->model('PriorityList_model');

        $is_success = 0;
        $msg = 'Cannot save data';

        $post        = $this->input->post();
        $company_id  = logged('company_id');
        $user_id     = logged('id');
        
        $isExists = $this->PriorityList_model->getByTitleAndCompanyId($post['priority_name'], $company_id);
        if( $isExists && ( $isExists->id != $post['pid'] ) ){
            $msg = 'Priority name already exists.';
        }else{
            if( $post['priority_name'] != '' ){

                $priority = $this->PriorityList_model->getById($post['pid']);
                if( $priority ){
                    $data = [
                        'title' => $post['priority_name']
                    ];
    
                    $this->PriorityList_model->update($priority->id, $data);
                    
                    //Activity Logs
                    $activity_name = 'Workorder Priority : Updated workorder priority ' . $priority->title; 
                    createActivityLog($activity_name);

                    $is_success = 1;    
                    $msg = '';

                }else{
                    $msg = 'Cannot find data';
                }            
            }  
        }              
        
        $json_data  = ['is_success' => $is_success, 'msg' => $msg];

        echo json_encode($json_data);
    }

    public function ajax_delete_workorder_priority()
    {
        $this->load->model('PriorityList_model');

        $is_success = 0;
        $msg = 'Cannot find data';

        $company_id = logged('company_id');
        $post = $this->input->post();

        $priority = $this->PriorityList_model->getById($post['id']);
        if( $priority && $priority->company_id == $company_id ){
            $this->PriorityList_model->delete($priority->id);

            //Activity Logs
            $activity_name = 'Workorder Priority : Deleted ' . $priority->title; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }
        
        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function estimateConversionWorkorder($id)
    {        
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Customer_advance_model');
        $this->load->model('Clients_model');
        $this->load->model('Checklist_model');
        $this->load->model('AcsAccess_model');
        $this->load->helper('functions');

        if(!checkRoleCanAccessModule('work-orders', 'write')){
			show403Error();
			return false;
		}

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        add_footer_js([
			'https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js',
			'assets/js/jquery.signaturepad.js'
        ]);

        $this->page_data['page']->title = 'New Workorder';
		$this->page_data['page']->parent = 'Sales';

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

        $this->load->library('session');

        $users_data = $this->session->all_userdata();

        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        $this->page_data['items'] = $this->items_model->getAllItemWithLocation();
        $this->page_data['itemsLocation'] = $this->items_model->getLocationStorage();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['number'] = $this->workorder_model->getlastInsert($company_id);

        $termsCondi = $this->workorder_model->getWOTerms($company_id);
        if($termsCondi){
            $this->page_data['terms_conditions'] = $this->workorder_model->getWOtermsByID();
        }else{
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        // $this->workorder_model->getWOtermsByID();

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if($termsUse){
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        }else{
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }

        $checkListsHeader = $this->workorder_model->getchecklistHeaderByCompanyId($company_id);

        $checklists = array();
        foreach( $checkListsHeader as $h ){
            $checklistItems = $this->workorder_model->getchecklistHeaderItems($h->id);
            $checklists[] = ['header' => $h, 'items' => $checklistItems];
        }

        //Settings
        $this->load->model('WorkorderSettings_model');
        $workorderSettings = $this->WorkorderSettings_model->getByCompanyId($company_id);
        if( $workorderSettings ){
            $prefix = $workorderSettings->work_order_num_prefix;
            $next_num = $workorderSettings->work_order_num_next;
        }else{
            $prefix = 'WO-';
            $lastInserted = $this->workorder_model->getlastInsert($company_id);
            if( $lastInserted ){
                $next_num = $lastInserted->id + 1;
            }else{
                $next_num = 1;
            }
        }

        $this->page_data['prefix'] = $prefix;
        $this->page_data['next_num'] = $next_num;

        // print_r($this->page_data['terms_conditions']);
        $this->page_data['fieldsName'] = $this->workorder_model->getCustomByID();
        // dd($this->workorder_model->getclientsById());
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        //$this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['checklists'] = $checklists;
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        $this->page_data['lead_source'] = $this->workorder_model->getlead_source($company_id);
        
        $this->page_data['packages'] = $this->workorder_model->getPackagelist($company_id);

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['users_lists'] = $this->users_model->getAllUsersByCompanyID($company_id);
        $this->page_data['companyDet'] = $this->workorder_model->companyDet($company_id);

        $this->page_data['itemPackages'] = $this->workorder_model->getPackageDetailsByCompany($company_id);
        $this->page_data['getSettings'] = $this->workorder_model->getSettings($company_id);
        

        $this->page_data['page_title'] = "Work Order";

        if ($estimate) {
            $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
            $lead     = $this->Customer_advance_model->getLeadByLeadId($estimate->lead_id);
            $acsAccess = $this->AcsAccess_model->getByProfId($estimate->customer_id);
            // $client   = $this->Clients_model->get_company($company_id);
            $client   = $this->Clients_model->getCompanyCompanyId($company_id);

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

            $checkListsHeader = $this->workorder_model->getchecklistHeaderByCompanyId($company_id);
            $checklists = array();
            foreach( $checkListsHeader as $h ){
                $checklistItems = $this->workorder_model->getchecklistHeaderItems($h->id);
                $checklists[$h->id]['header'] = ['name' => $h->checklist_name, 'id' => $h->id];
                $checklists[$h->id]['items']  = $checklistItems;            
            }
            
            $this->page_data['checklists'] = $checklists;
            $this->page_data['acsAccess'] = $acsAccess;
            $this->page_data['customer'] = $customer;
            $this->page_data['lead'] = $lead;
            $this->page_data['client'] = $client;
            $this->page_data['estimate'] = $estimate;

            // $this->page_data['items_data'] = $this->estimate_model->getItems($id);
            $this->page_data['items_data'] = $this->estimate_model->getEstimatesItems($id);
            $this->page_data['items_dataOP1'] = $this->estimate_model->getItemlistByIDOption1($id);
            $this->page_data['items_dataOP2'] = $this->estimate_model->getItemlistByIDOption2($id);

            $this->page_data['items_dataBD1'] = $this->estimate_model->getItemlistByIDBundle1($id);
            $this->page_data['items_dataBD2'] = $this->estimate_model->getItemlistByIDBundle2($id);

            //$this->load->view('workorder/addWorkEstimate', $this->page_data);            
            $this->load->view('v2/pages/workorder/addWorkEstimate', $this->page_data);
        } else {
            $this->session->set_flashdata('message', 'Record not found.');
            $this->session->set_flashdata('alert_class', 'alert-danger');
            redirect('estimate');
        }
    }

    public function getTaxRate()
    {

        $company_id = logged('company_id');
        $get_settings  =  array(
            'where' => array(
                'company_id' => $company_id,
                'is_default' => 1,
            ),
            'table' => 'tax_rates',
            'select' => '*',
        );
        // $query = $this->workorder_model->getTaxRate($company_id);
        $query = $this->general->get_data_with_param($get_settings);

        // return $query;
        echo json_encode($query);
    }

    public function ajax_quick_view_details()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('JobTags_model');
        $this->load->model('workorder_model');

        $post    = $this->input->post();
        $comp_id = logged('company_id');        
        $wid     = $post['appointment_id'];


        $workorder = $this->workorder_model->getById($wid);
        $get_company_info = array(
            'where' => array(
                'company_id' => logged('company_id'),
            ),
            'table' => 'business_profile',
            'select' => 'id,business_phone,business_name,business_email,street,city,postal_code,state,business_image',
        );

        $tags = '---';
        if( $workorder->job_tags > 0 ){
            $jobTag = $this->JobTags_model->getById($workorder->job_tags);
            if( $jobTag ){
                $tags = $jobTag->name;
            }                    
        }

        $this->page_data['company_info'] = $this->general->get_data_with_param($get_company_info, false);
        $this->page_data['agree_items']  = $this->workorder_model->get_agree_items($wid);
        $this->page_data['customer']     = $this->AcsProfile_model->getByProfId($workorder->customer_id);
        $this->page_data['workorder']    = $workorder;
        $this->page_data['tags'] = $tags;
        $this->load->view('v2/pages/workorder/ajax_quick_view_details', $this->page_data);
    }

    public function redirect_edit($wid)
    {
        $this->load->model('workorder_model');

        $workorder = $this->workorder_model->getById($wid);
        if( $workorder->work_order_type_id == '2' ){
            redirect('workorder/editAlarm/' . $workorder->id);
        }elseif( $workorder->work_order_type_id == '3' ) {
            redirect('workorder/editWorkorderSolar/' . $workorder->id);
        }elseif( $workorder->work_order_type_id == '4' ){
            redirect('workorder/editInstallation/' . $workorder->id);
        }else{
            redirect('workorder/edit/' . $workorder->id);
        }
    }

    public function ajax_quick_delete_workorder()
    {
        $post = $this->input->post();
        $cid  = logged('company_id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $workOrder = $this->workorder_model->getDataByWO($post['schedule_id']);
        if( $workOrder ){
            $data = array(
                'id' => $post['schedule_id'],
                'view_flag' => '0',
            );

            $this->workorder_model->deleteWorkorder($data);
            customerAuditLog(logged('id'), $workOrder->customer_id, $workOrder->id, 'Workorder', 'Deleted work order #'.$workOrder->work_order_number);

            $is_success = 1;
            $msg = '';
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_save_custom_fields()
    {
        $this->load->model('CustomField_model');

        $post = $this->input->post();
        $cid  = logged('company_id');

        $is_success = 0;
        $msg = 'Please enter custom field name';

        if( $post['custom_field_name'] != '' ){
            $data = [
                'company_id' => $cid,
                'name' => $post['custom_field_name'],
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            ];

            $this->CustomField_model->create($data);

            $is_success = 1;
            $msg = '';
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_update_custom_fields()
    {
        $this->load->model('CustomField_model');

        $post = $this->input->post();
        $cid  = logged('company_id');

        $is_success = 0;
        $msg = 'Please enter custom field name';

        $workorderCustomField = $this->CustomField_model->getById($post['cfeid']);
        if( $workorderCustomField && $workorderCustomField->company_id == $cid ){
            if( $post['custom_field_name'] != '' ){
                $data = [
                    'name' => $post['custom_field_name'],
                    'date_updated' => date("Y-m-d H:i:s")
                ];
    
                $this->CustomField_model->update($workorderCustomField->id, $data);
    
                $is_success = 1;
                $msg = '';
            }
        }else{
            $msg = 'Cannot find data';
        }
        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_delete_custom_fields()
    {
        $this->load->model('CustomField_model');

        $post = $this->input->post();
        $cid  = logged('company_id');

        $is_success = 0;
        $msg = 'Cannot find data';

        $workorderCustomField = $this->CustomField_model->getById($post['cfeid']);
        if( $workorderCustomField && $workorderCustomField->company_id == $cid ){
            $this->CustomField_model->delete($workorderCustomField->id);

            $is_success = 1;
            $msg = '';
        }
        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_update_wo_terms_condition()
    {
        $post = $this->input->post();
        $cid  = logged('company_id');

        $is_success = 0;
        $msg = '';
        
        $woTermsCondition = $this->workorder_model->getWorkOrderSettingTermsConditionByCompanyId($cid);        
        if( !$woTermsCondition ){            
            $data = [
                'company_id' => $cid,
                'content' => $post['update_terms_content'],                
                'agreement' => 0,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")

            ];

            $result = $this->workorder_model->createWorkOrderTermsConditions($data);
        }else{
            $data = [                
                'content' => $post['update_terms_content'],                                                
                'date_updated' => date("Y-m-d H:i:s")
            ];
            $result = $this->workorder_model->updateWorkOrderTermsConditionByCompanyId($cid, $data);
        }

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_update_wo_header()
    {
        $post = $this->input->post();
        $cid  = logged('company_id');

        $is_success = 0;
        $msg = '';
        
        $woHeader = $this->workorder_model->getWorkOrderSettingHeaderByCompanyId($cid);        
        if( !$woHeader ){            
            $data = [
                'company_id' => $cid,
                'content' => $post['update_header_content'],   
                'solar' => 0,
                'installation' => 0,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")

            ];

            $result = $this->workorder_model->createWorkOrderHeader($data);
        }else{
            $data = [                
                'content' => $post['update_header_content'],                                                
                'date_updated' => date("Y-m-d H:i:s")
            ];
            $result = $this->workorder_model->updateWorkOrderHeaderCompanyId($cid, $data);
        }

        $is_success = 1;

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);

        exit;
    }

    public function ajax_get_offer_code()
    {
        $is_valid = false;        
        $cost = 0;
        $cid  = logged('company_id');

        $offer_code = $this->input->post('offer_code');
        $offerCode = $this->items_model->getCompanyOffercode($offer_code, $cid);
        if( $offerCode ){
            $is_valid = true;
            $cost     = $offerCode->cost;
        }

        $json_data = ['is_valid' => $is_valid, 'cost' => $cost];

        echo json_encode($json_data);
    }

    public function ajax_shareable_email()
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('Business_model');

        $post = $this->input->post();
        $is_success = 1;
        $msg = 'Cannot send email';

        if( $post['email_content'] == '' ){
            $msg = 'Please enter email content';
            $is_success = 0;
        }

        $workorder = $this->workorder_model->getById($post['wid']);
        $customer  = $this->AcsProfile_model->getByProfId($workorder->customer_id);
        if( $is_success == 1 ){            
            if( $customer && $customer->email != '' ){
                $company = $this->Business_model->getById($workorder->company_id);
                //Send Email
                $subject = $company->business_name.': Workorder #'.$workorder->work_order_number;
                $mail = email__getInstance();
                $mail->FromName = 'nSmarTrac';
                $mail->addAddress($customer->email, $customer->email);
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $post['email_content'];
                $sendEmail = $mail->Send();
                
                $is_success = 1;
                $msg = '';
            }else{
                $is_success = 0;
                $msg = 'Cannot find customer email';
            }
        }        

        $json_data = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($json_data);
    }

    public function ajax_convert_to_job()
    {        
        $this->load->helper(array('hashids_helper', 'google_calendar_helper'));
        $this->load->model('Jobs_model');
        $this->load->model('JobTags_model');
        $this->load->model('Items_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('General_model', 'general');
        $this->load->model('Customer_model');
        $this->load->model('JobType_model');

        $is_success = 1;
        $msg = 'Cannot send email';
        $job_id = 0;

        $cid  = logged('company_id');
        $uid  = logged('id');
        $user_logged_name = logged('FName') . ' ' . logged('LName');
        $post = $this->input->post();

        if ($post['total_amount'] <= 0) {
            $msg = 'Please select an item';
            $is_success = 0;
        }

        $customer = $this->AcsProfile_model->getByProfId($post['customer_id']);
        if( empty($customer) ){            
            $msg = 'Cannot find customer';
            $is_success = 0;
        }

        if( $is_success == 1 ){
            $job_settings = $this->Jobs_model->getJobSettingsByCompanyId($cid);
            $job_workorder_id = $post['wid'];
            if ($job_settings) {
                $prefix   = $job_settings->job_num_prefix;
                $next_num = str_pad($job_settings->job_num_next, 5, '0', STR_PAD_LEFT);
                $account_next_num = $job_settings->job_account_next_num;
            } else {
                $prefix = 'JOB-';
                $lastId = $this->Jobs_model->getlastInsert($cid);
                if ($lastId) {
                    $next_num = $lastId->id + 1;
                    $next_num = str_pad($next_num, 5, '0', STR_PAD_LEFT);
                    $account_next_num = $lastId->id + 1;
                } else {
                    $next_num = str_pad(1, 5, '0', STR_PAD_LEFT);
                    $account_next_num = 1;
                }
            }

            $job_number = $prefix . $next_num;   
            $job_account_number = $cid . '-' . $account_next_num;             

            $jobTag = $this->JobTags_model->getById($post['job_tag']);
            $job_location = $customer->mail_add;

            $attachmentFolderPath = "./uploads/jobs/attachment/";            
            if(!file_exists($attachmentFolderPath)) {
                mkdir($attachmentFolderPath, 0777, true);
            }
            
            if(isset($_FILES['filetoupload']) && $_FILES['filetoupload']['tmp_name'] != '') {
                $tmp_name   = $_FILES['attachment_photo']['tmp_name'];
                $extension  = strtolower(end(explode('.',$_FILES['filetoupload']['name'])));
                $attachment = $job_number."_attachment_".time().'.'.$extension;
                move_uploaded_file($tmp_name, $attachmentFolderPath.$attachment);
            }

            $jobType = $this->JobType_model->getById($post['job_type']);

            $jobs_data = array(
                'job_number' => $job_number,
                'estimate_id' => 0,
                'customer_id' => $post['customer_id'],
                'employee_id' => $post['employee_id'],
                'employee2_id' => $post['emp2_id'] > 0 ? $post['emp2_id'] : 0,
                'employee3_id' => $post['emp3_id'] > 0 ? $post['emp3_id'] : 0,
                'employee4_id' => $post['emp4_id'] > 0 ? $post['emp4_id'] : 0,
                'employee5_id' => $post['emp5_id'] > 0 ? $post['emp5_id'] : 0,
                'employee6_id' => $post['emp6_id'] > 0 ? $post['emp6_id'] : 0,
                'jobtypebase_amount' => 0,
                'job_name' => $job_number . ' - ' . $post['job_type'],
                'job_location' => $job_location,
                'job_account_number' => $job_account_number,
                'job_description' => $post['job_description'],
                'start_date' => date("Y-m-d",strtotime($post['start_date'])),
                'start_time' => $post['start_time'],
                'end_date' => date("Y-m-d",strtotime($post['end_date'])),
                'end_time' => $post['end_time'],
                'event_color' => $post['event_color'],
                'customer_reminder_notification' => $post['customer_reminder_notification'],
                'priority' => $post['priority'],
                'tags' => $jobTag->name,
                'status' => 'Scheduled',
                'message' => $post['message'],
                'company_id' => $cid,
                'date_created' => date('Y-m-d H:i:s'),
                'created_by' => $uid,
                'attachment' => $attachment,
                'tax_percentage' => $post['tax_percentage'],
                'tax_rate' => $post['tax'],
                'job_type' => $jobType->title,
                'date_issued' => date("Y-m-d",strtotime($post['start_date'])),
                'work_order_id' => $job_workorder_id,
                'timezone' => $post['timezone'],
                'commission' => 0,
                'tech_commission' => 0,
                'tech_commission_total' => 0,
                'fix_cost' => 0,
                'margin' => 0,
                'amount_collected' => 0,
                'gross_profit' => 0,       
                'program_setup' => $post['otps'],      
                'monthly_monitoring' => $post['monthly_monitoring'],
                'installation_cost' => $post['installation_cost'],
            );

            $job_id = $this->Jobs_model->createJob($jobs_data);
            if( $job_id > 0 ){
                //Create hash_id
                $job_hash_id = hashids_encrypt($job_id, '', 15);
                $this->Jobs_model->update($job_id, ['hash_id' => $job_hash_id]);

                //Update job settings
                $jobs_settings_data = array(
                    'job_num_next' => $job_settings->job_num_next + 1,
                    'job_account_next_num' => $account_next_num + 1
                );
                $this->general->update_with_key($jobs_settings_data, $job_settings->id, 'job_settings');
                
                //Google Calendar
                createSyncToCalendar($job_id, 'job', $cid);

                if (isset($post['item_id'])) {                    
                    $devices    = count($post['item_id']);
                    for ($xx = 0; $xx < $devices; $xx++) {
                        $job_items_data = array();
                        $job_items_data['job_id']     = $job_id;
                        $job_items_data['items_id']   = $post['item_id'][$xx];
                        $job_items_data['commission'] = $post['item_commission'][$xx];
                        $job_items_data['margin']     = $post['item_margin'][$xx];
                        $job_items_data['qty']        = $post['item_qty'][$xx];
                        $job_items_data['cost']       = $post['item_price'][$xx];
                        $job_items_data['tax']        = 0;
                        $job_items_data['total']      = $post['item_price'][$xx] * $post['item_qty'][$xx];
                        $job_items_data['location']   = 0;
                        $job_items_data['item_name']  = $post['item_name'][$xx];
                        $this->general->add_($job_items_data, 'job_items');
                        $this->items_model->recordItemTransaction($post['item_id'][$xx], $post['item_qty'][$xx], $post['location'][$xx], "deduct", $user_logged_name, "USER");
                        $this->items_model->recordItemTransaction($post['item_id'][$xx], $post['item_qty'][$xx], $post['location'][$xx], "deduct", $customer->first_name.' '.$customer->last_name, "CUSTOMER");
                    }
                }

                $payment_data = [
                    'amount' =>  $post['total_amount'],
                    'program_setup' => $post['otps'],
                    'monthly_monitoring' => $post['monthly_monitoring'],
                    'installation_cost' => $post['installation_cost'],
                    'equipment_cost' => $post['sub_total'],
                    'tax' => $post['tax'],
                    'deposit_collected' => 0,
                    'job_id' => $job_id,
                    'date_created' => date("Y-m-d h:i:s")
                ];
                $this->general->add_($payment_data, 'job_payments');

                //Update customer otp equipment cost and monthly monitoring fields
                if( in_array($cid, adi_company_ids()) ){
                    $data_acs_office = [
                        'monthly_monitoring' => $post['monthly_monitoring'],
                        'equipment_cost' => $post['sub_total']                     
                    ];

                    $this->general->update_with_key_field($data_acs_office, $post['customer_id'], 'acs_office', 'fk_prof_id');

                    $itemsOffice = array(
                        'fk_prof_id'                => $post['customer_id'],
                        'fk_sales_rep_office'       => $post['employee_id'],
                        'technician'                => $post['emp2_id'],
                    );
            
                    $solarItemsOffices = $this->workorder_model->update_office_job($itemsOffice);
            
                    $alarmInfoData = array(
                        'fk_prof_id'                => $post['customer_id'],
                        //'monitor_id'                => $post['JOB_ACCOUNT_NUMBER'],
                        'monitor_id'                => $job_account_number
                    );
            
                    $alarmInfoDatas = $this->workorder_model->update_alarm_adi_job($alarmInfoData);
                }

                $get_work_order_data = array(
                    'where' => array(
                        'id' => $post['wid']
                    ),
                    'table' => 'work_orders',
                    'select' => '*',
                );
                $workorder_data = $this->general->get_data_with_param($get_work_order_data, false);

                //Activity Logs
                $activity_name = 'Converted Workorder Number ' . $workorder_data->work_order_number . ' to Job Number ' . $job_number; 
                createActivityLog($activity_name);

                $check_exist = array(
                    'where' => array('fk_prof_id' => $post['customer_id']),
                    'table' => 'acs_alarm'
                );
                $is_exist = $this->general->get_data_with_param($check_exist);

                $customer_data = array();
                $customer_data['passcode'] = $workorder_data->password;
                $customer_data['panel_type'] = $workorder_data->panel_type;
                $customer_data['system_type'] = $workorder_data->plan_type;

                if( $post['monthly_monitoring'] > 0 ){
                    $customer_data['monthly_monitoring'] = $post['monthly_monitoring'];
                }

                if( $post['adjustment_otps'] ){
                    $customer_data['otps'] = $post['adjustment_otps'];
                } 

                if (empty($is_exist)) {
                    $customer_data['fk_prof_id'] = $post['customer_id'];
                    $this->general->add_($customer_data, 'acs_alarm');
                } else {
                    $this->general->update_with_key_field($customer_data, $post['customer_id'], 'acs_alarm', 'fk_prof_id');
                }

                //SMS Notification
                createCronAutoSmsNotification($cid, $job_id, 'job', 'Scheduled', $post['employee_id'], $post['employee_id'], 0);
                if ($posAt['emp2_id'] > 0) {
                    creaAteCronAutoSmsNotification($cid, $job_id, 'job', 'Scheduled', 0, $post['emp2_id'], 0);
                }
                if ($posAt['emp3_id'] > 0) {
                    creaAteCronAutoSmsNotification($cid, $job_id, 'job', 'Scheduled', 0, $post['emp3_id'], 0);
                }
                if ($post['emp4_id'] > 0) {
                    createCronAutoSmsNotification($cid, $job_id, 'job', 'Scheduled', 0, $post['emp4_id'], 0);
                }
                if ($post['emp5_id'] > 0) {
                    createCronAutoSmsNotification($cid, $job_id, 'job', 'Scheduled', 0, $post['emp5_id'], 0);
                }
                if ($post['emp6_id'] > 0) {
                    createCronAutoSmsNotification($cid, $job_id, 'job', 'Scheduled', 0, $post['emp6_id'], 0);
                }

                //Update workorder status to Converted
                $data_workorder = ['status' => 'Converted'];
                $this->workorder_model->update($job_workorder_id, $data_workorder);

                // Record Job save and Update to Customer Activities Module in Customer Dashboard
                $action = "$user_logged_name scheduled a job with you. <a href='#' onclick='window.open(`".base_url('job/new_job1/').$job_id."`, `_blank`, `location=yes,height=1080,width=1500,scrollbars=yes,status=yes`);'>$job_number</a>";

                $customerLogPayload = array(
                    'date' => date('m/d/Y')."<br>".date('h:i A'),
                    'customer_id' => $post['customer_id'],
                    'user_id' => $uid,
                    'logs' => "$action"
                );
                $customerLogsRecording = $this->Customer_model->recordActivityLogs($customerLogPayload);

                customerAuditLog($uid, $post['customer_id'], $job_id, 'Jobs', 'Added New Job #' . $job_number);

            }else{
                $is_success = 0;
                $msg = 'Cannot convert data';
            }
        }

        $json_data = ['is_success' => $is_success, 'msg' => $msg, 'job_id' => $job_id, 'is_update' => 0];
        echo json_encode($json_data);
    }

    public function status()
    {
        if(!checkRoleCanAccessModule('work-order-settings', 'read')){
			show403Error();
			return false;
		}
        
        add_footer_js(array(
            'assets/js/jquery.minicolors.js'
        ));

		$company_id = logged('company_id');		
        $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        $this->page_data['page']->title = 'Workorder Status';
        $this->page_data['page']->parent = 'Sales';
		$this->load->view('v2/pages/workstatus/list', $this->page_data);
    }

    public function ajax_archived_list()
    {
        $cid  = logged('company_id');
        $workorders = $this->workorder_model->getAllIsArchiveByCompanyId($cid);

        $this->page_data['workorders'] = $workorders;
        $this->load->view("v2/pages/workorder/ajax_archived_list", $this->page_data);
    }

    public function ajax_restore_archived()
    {
        if(!checkRoleCanAccessModule('work-orders', 'write')){
			show403Error();
			return false;
		}

        $is_success = 0;
        $msg = 'Cannot find workorder data';

        $company_id = logged('company_id');
        $post       = $this->input->post();

        $workorder = $this->workorder_model->getById($post['workorder_id']);
        if($workorder && $workorder->company_id == $company_id) {                        
            $this->workorder_model->restoreWorkorder($workorder->id);

            //Activity Logs
            $activity_name = 'Workorders : Restore Workorder Number ' . $workorder->work_order_number; 
            createActivityLog($activity_name);

            $is_success = 1;
            $msg = '';
        }

        $return = ['is_success' => $is_success, 'msg' => $msg];
        echo json_encode($return);
    }

    public function ajax_archive_selected_workorders()
    {
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['workorders'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['view_flag' => 1, 'date_updated' => date("Y-m-d H:i:s")];
            $total_updated = $this->workorder_model->bulkUpdate($post['workorders'], $data, $filter);

			//Activity Logs
			$activity_name = 'Workorders : Archived ' . $total_updated . ' workorder(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_change_status_selected_workorders()
    {
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['workorders'] ){                                    
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['status' => $post['status'], 'date_updated' => date("Y-m-d H:i:s")];
            $total_updated = $this->workorder_model->bulkUpdate($post['workorders'], $data, $filter);

			//Activity Logs
			$activity_name = 'Workorders : ' . $total_updated . ' workorder(s) was changed status to ' . $post['status']; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
    }

    public function ajax_restore_selected_workorders()
	{
        $is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['workorders'] ){
            $filter[] = ['field' => 'company_id', 'value' => $company_id];
            $data     = ['view_flag' => 0, 'date_updated' => date("Y-m-d H:i:s")];
            $total_updated = $this->workorder_model->bulkUpdate($post['workorders'], $data, $filter);

			//Activity Logs
			$activity_name = 'Workorders : Restored ' . $total_updated . ' workorder(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_permanently_delete_selected_workorders()
	{
		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        if( $post['workorders'] ){

            $filters[] = ['field' => 'company_id', 'value' => $company_id];
			$filters[] = ['field' => 'view_flag', 'value' => 1];
            $total_deleted = $this->workorder_model->bulkDelete($post['workorders'], $filters);

			//Activity Logs
			$activity_name = 'Workorders : Permanently deleted ' .$total_deleted. ' workorder(s)'; 
			createActivityLog($activity_name);

            $is_success = 1;
            $msg    = '';
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_delete_all_archived_workorders()
	{
		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

        $filter[] = ['field' => 'company_id', 'value' => $company_id];
		$total_archived = $this->workorder_model->deleteAllArchived($filter);

		//Activity Logs
		$activity_name = 'Workorders : Permanently deleted ' .$total_archived. ' workorder(s)'; 
		createActivityLog($activity_name);

		$is_success = 1;
		$msg    = '';

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}

    public function ajax_delete_archived_workorder()
	{
		$this->load->model('Clients_model');

		$is_success = 0;
        $msg    = 'Please select data';

        $company_id  = logged('company_id');
        $post = $this->input->post();

		$workorder = $this->workorder_model->getById($post['workorder_id']);
        if( $workorder && $workorder->company_id == $company_id ){
			$this->workorder_model->delete($workorder->id);

			//Activity Logs
			$activity_name = 'Workorders : Permanently deleted work order number ' . $workorder->work_order_number; 
			createActivityLog($activity_name);

			$is_success = 1;
			$msg    = '';
		}

        $return = [
            'is_success' => $is_success,
            'msg' => $msg
        ];

        echo json_encode($return);
	}
}
/* End of file Workorder.php */

/* Location: ./application/controllers/Workorder.php */

