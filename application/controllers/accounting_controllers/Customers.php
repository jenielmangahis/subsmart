<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('accounting_attachments_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('vendors_model');
        $this->load->model('invoice_settings_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('Customer_advance_model', 'customer_ad_model');
        $this->load->model('General_model', 'general');
        $this->load->model('IndustryType_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');

        $this->page_data['page']->title = 'Customers';
        $this->page_data['page']->parent = 'Sales';

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css",
            "assets/css/accounting/accounting_includes/receive_payment.css",
            "assets/css/accounting/accounting_includes/customer_sales_receipt_modal.css",
            "assets/css/accounting/accounting_includes/create_charge.css",
            "assets/css/accounting/invoices_page.css",
            "assets/css/accounting/accounting_includes/send_reminder_by_batch_modal.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/js/accounting/modal-forms1.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js",
            "assets/js/accounting/sales/invoices_page.js",
            "assets/js/accounting/sales/customer_includes/send_reminder_by_batch_modal.js"
        ));

        $this->load->helper('functions');

		$this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow", array()),
                array("Expenses", array('Expenses', 'Vendors')),
                array("Sales", array('Overview', 'All Sales', 'Estimates', 'Customers', 'Deposits', 'Work Order', 'Invoice', 'Jobs', 'Products and services')),
                array("Payroll", array('Overview', 'Employees', 'Contractors', "Workers' Comp", 'Benifits')),
                array("Reports", array()),
                array("Taxes", array("Sales Tax", "Payroll Tax")),
                // array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts", "Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                // array('/accounting/banking',array()),
                // array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array('/accounting/cashflowplanner', array()),
                array("", array('/accounting/expenses', '/accounting/vendors')),
                array("", array('/accounting/sales-overview', '/accounting/all-sales', '/accounting/newEstimateList', '/accounting/customers', '/accounting/deposits', '/accounting/listworkOrder', '/accounting/invoices', '/accounting/jobs', '/accounting/products-and-services')),
                array("", array('/accounting/payroll-overview', '/accounting/employees', '/accounting/contractors', '/accounting/workers-comp', '#')),
                array('/accounting/reports', array()),
                array("", array('/accounting/salesTax', '/accounting/payrollTax')),
                // array('#',  array()),
                array("", array('/accounting/chart-of-accounts', '/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card", "fa-money", "fa-dollar", "fa-bar-chart", "fa-minus-circle", "fa-file", "fa-calculator");
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId(logged('company_id'));
        $this->page_data['invoices'] = $this->invoice_model->getAllData(logged('company_id'));
        $this->page_data['clients'] = $this->invoice_model->getclientsData(logged('company_id'));
        $this->page_data['invoices_sales'] = $this->invoice_model->getAllDataSales(logged('company_id'));
        $this->page_data['OpenInvoices'] = $this->invoice_model->getAllOpenInvoices(logged('company_id'));
        $this->page_data['InvOverdue'] = $this->invoice_model->InvOverdue(logged('company_id'));
        $this->page_data['getAllInvPaid'] = $this->invoice_model->getAllInvPaid(logged('company_id'));
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->workorder_model->getPackagelist(logged('company_id'));
        $this->page_data['estimates'] = $this->estimate_model->getAllByCompanynDraft(logged('company_id'));
        $this->page_data['sales_receipts'] = $this->accounting_sales_receipt_model->getAllByCompany(logged('company_id'));
        $this->page_data['credit_memo'] = $this->accounting_credit_memo_model->getAllByCompany(logged('company_id'));
        $this->page_data['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['statements'] = $this->accounting_statements_model->getAllComp(logged('company_id'));
        $this->page_data['rpayments'] = $this->accounting_receive_payment_model->getReceivePaymentsByComp(logged('company_id'));
        $this->page_data['checks'] = $this->vendors_model->get_check_by_comp(logged('company_id'));
        $this->page_data['payment_methods'] = $this->accounting_receive_payment_model->get_payment_methods(logged('company_id'));
        $this->page_data['deposits_to'] = $this->accounting_receive_payment_model->get_deposits_to(logged('company_id'));

        $this->page_data['invoicesItems'] = $this->invoice_model->getInvoicesItems(logged('company_id'));
    }

    public function index()
    {
        add_css(array(
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
            "assets/css/accounting/customers.css",
            "assets/css/accounting/accounting_includes/create_statement_modal.css",
            "assets/css/accounting/accounting_includes/time_activity.css",
            "assets/css/accounting/accounting_includes/create_invoice.css",
            "assets/css/accounting/accounting_includes/customer_types.css",
            "assets/css/accounting/accounting_includes/customer_single_modal.css",
            "assets/css/accounting/accounting_includes/new_customer.css",
        ));
        add_footer_js(array(
            "assets/js/accounting/sales/customers.js",
            "assets/js/accounting/sales/customer_includes/send_reminder.js",
            "assets/js/accounting/sales/customer_includes/create_statement_modal.js",
            "assets/js/accounting/sales/customer_includes/create_estimate.js",
            "assets/js/accounting/sales/customer_includes/time_activity.js",
            "assets/js/accounting/sales/customer_includes/create_invoice.js",
            "assets/js/accounting/sales/customer_includes/customer_types.js",
            "assets/js/accounting/sales/customer_includes/export_table.js",
            "assets/js/accounting/sales/customer_includes/customer_single_modal.js",
            "assets/js/accounting/sales/customer_includes/new_customer.js",
            'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js',
            'https://unpkg.com/dropzone@5/dist/min/dropzone.min.js',

            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/sales/customers/list.js"
        ));

        $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        $this->page_data['page_title'] = "Customers";
        $this->page_data['accounting_timesheet_settings'] = $this->accounting_customers_model->get_accounting_timesheet_settings(logged("company_id"));

        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        $terms = $this->accounting_terms_model->getCompanyTerms_a(logged('company_id'));
        $this->page_data['number'] = $this->invoice_model->getlastInsert();

        if (!empty($setting)) {
            foreach ($setting as $key => $value) {
                if (is_serialized($value)) {
                    $setting->{$key} = unserialize($value);
                }
            }
            $this->page_data['setting'] = $setting;
            $this->page_data['terms'] = $terms;
        }

        $get_customer_groups = array(
            'where' => array(
                    'company_id' => logged('company_id')
                ),
                'table' => 'customer_groups',
                'select' => '*',
            );

        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );

        $rate_plan_query = array(
            // 'where' => array(
            //     'id' => $user_id
            // ),
            'table' => 'ac_rateplan',
            'select' => 'id,amount',
        );

        $spt_query = array(
            'table' => 'ac_system_package_type',
            'select' => 'id,name',
        );

        $activation_fee_query = array(
            'table' => 'ac_activationfee',
            'select' => 'id,amount',
        );

        $spt_query = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'ac_system_package_type',
            'select' => '*',
        );
        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);


        if(logged('company_id') == 58){
            $solar_info_query = array(
                'table' => 'acs_solar_info_settings',
                'select' => '*',
            );
            $this->page_data['solar_info_settings'] = $this->general->get_data_with_param($solar_info_query);
        }
        
        $this->page_data['customerGroups'] = $this->general->get_data_with_param($get_customer_groups);
        $this->page_data['rate_plans'] = $this->general->get_data_with_param($rate_plan_query);
        $this->page_data['system_package_types'] = $this->general->get_data_with_param($spt_query);
        $this->page_data['activation_fees'] = $this->general->get_data_with_param($activation_fee_query);

        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_salesarea","sa_id");
        $this->page_data['employees'] = $this->customer_ad_model->get_all(FALSE,"","ASC","users","id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['technicians'] = $this->users_model->getUsersByRole([7]);
        $this->page_data['sales_reps'] = $this->users_model->getUsersByRole([8,28]);

        // fetch customer statuses
        $this->page_data['customer_status'] = $this->customer_ad_model->get_all(FALSE,"","","acs_cust_status","id");
        $this->page_data['company_id'] = logged('company_id'); // Company ID of the logged in USER

        $this->load->view('v2/pages/accounting/sales/customers/list', $this->page_data);
    }

    public function batch_select_customer_type()
    {
        $post = $this->input->post();

        $customerData = [];
        foreach($post['customers'] as $customerId)
        {
            $customerData[] = [
                'prof_id' => $customerId,
                'customer_type' => $post['customer_type']
            ];
        }

        $update = $this->accounting_customers_model->update_by_batch($customerData);

        return json_encode([
            'success' => $update ? true : false,
            'message' => $update ? 'Updated successfully!' : 'Update failed!' 
        ]);
    }

    public function view($customerId)
    {
        add_footer_js([
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/sales/customers/view.js"
        ]);
        $customer = $this->accounting_customers_model->getCustomerDetails($customerId)[0];

        $not = ['', null];
        $customerAddress = '';
        $customerAddress .= in_array($customer->mail_add, $not) ? "" : $customer->mail_add;
        if (!in_array($customer->city, $not)) {
            if ($customerAddress !== '') {
                $customerAddress .= ', ';
            }
            $customerAddress .= $customer->city;
        }

        if (!in_array($customer->state, $not)) {
            if ($customerAddress !== '') {
                $customerAddress .= ', ';
            }
            $customerAddress .= $customer->state;
        }

        if (!in_array($customer->zip_code, $not)) {
            if ($customerAddress !== '') {
                $customerAddress .= ' ';
            }
            $customerAddress .= $customer->zip_code;
        }

        if (!in_array($customer->country, $not)) {
            if ($customerAddress !== '') {
                $customerAddress .= ' ';
            }
            $customerAddress .= $customer->country;
        }

        $this->page_data['customer'] = $customer;
        $this->page_data['customerAddress'] = $customerAddress;

        if(isset($userid) || !empty($userid)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$userid,"acs_profile");
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_access");
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_office");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_billing");
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$userid,"acs_alarm");
            $this->page_data['panel_type'] = $this->customer_ad_model->get_select_options('acs_alarm','panel_type');

            $get_customer_notes = array(
                'where' => array(
                    'fk_prof_id' => $userid
                ),
                'table' => 'acs_notes',
                'select' => '*',
            );
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);
            //$this->page_data['device_info'] = $this->customer_ad_model->get_all_by_id('fk_prof_id',$userid,"acs_devices");
        
            $customer_contacts = array(
                'where' => array(
                    'customer_id' => $userid
                ),
                'table' => 'contacts',
                'select' => '*',
                'order' => array(
                    'order_by' => 'id',
                    'ordering' => 'asc'
                ),
            );
            $this->page_data['contacts'] = $this->general->get_data_with_param($customer_contacts);

            $customer_papers_query = array(
                'where' => array(
                    'customer_id' => $userid
                ),
                'table' => 'acs_papers',
                'select' => '*',
            );
            $this->page_data['papers'] = $this->general->get_data_with_param($customer_papers_query);
            if (count($this->page_data['papers'])) {
                $this->page_data['papers'] = $this->page_data['papers'][0];
            }
        }
        $get_customer_groups = array(
            'where' => array(
                    'company_id' => logged('company_id')
                ),
                'table' => 'customer_groups',
                'select' => '*',
            );

        $get_login_user = array(
            'where' => array(
                'id' => $user_id
            ),
            'table' => 'users',
            'select' => 'id,FName,LName',
        );

        $rate_plan_query = array(
            // 'where' => array(
            //     'id' => $user_id
            // ),
            'table' => 'ac_rateplan',
            'select' => 'id,amount',
        );

        $spt_query = array(
            'table' => 'ac_system_package_type',
            'select' => 'id,name',
        );

        $activation_fee_query = array(
            'table' => 'ac_activationfee',
            'select' => 'id,amount',
        );

        $spt_query = array(
            'where' => array(
                'company_id' => logged('company_id')
            ),
            'table' => 'ac_system_package_type',
            'select' => '*',
        );
        $this->page_data['system_package_type'] = $this->general->get_data_with_param($spt_query);


        if(logged('company_id') == 58){
            $solar_info_query = array(
                'table' => 'acs_solar_info_settings',
                'select' => '*',
            );
            $this->page_data['solar_info_settings'] = $this->general->get_data_with_param($solar_info_query);
        }
        
        $this->page_data['customerGroups'] = $this->general->get_data_with_param($get_customer_groups);
        $this->page_data['rate_plans'] = $this->general->get_data_with_param($rate_plan_query);
        $this->page_data['system_package_types'] = $this->general->get_data_with_param($spt_query);
        $this->page_data['activation_fees'] = $this->general->get_data_with_param($activation_fee_query);

        $this->page_data['logged_in_user'] = $this->general->get_data_with_param($get_login_user,FALSE);
        $this->page_data['sales_area'] = $this->customer_ad_model->get_all(FALSE,"","ASC","ac_salesarea","sa_id");
        $this->page_data['employees'] = $this->customer_ad_model->get_all(FALSE,"","ASC","users","id");
        $this->page_data['users'] = $this->users_model->getUsers();
        $this->page_data['technicians'] = $this->users_model->getUsersByRole([7]);
        $this->page_data['sales_reps'] = $this->users_model->getUsersByRole([8,28]);

        // fetch customer statuses
        $this->page_data['customer_status'] = $this->customer_ad_model->get_all(FALSE,"","","acs_cust_status","id");
        $this->page_data['industryTypes'] = $this->IndustryType_model->getAll(); 

        if (isset($this->page_data['profile_info']->fk_sa_id)) {
            foreach ($this->page_data['sales_area'] as $area) {
                if ($area->sa_id == $this->page_data['profile_info']->fk_sa_id) {
                    $this->page_data['profile_info']->fk_sa_text = $area->sa_name;
                }
            }
        }
        $this->page_data['company_id'] = logged('company_id'); // Company ID of the logged in USER

        $this->load->view('v2/pages/accounting/sales/customers/view', $this->page_data);
    }
}