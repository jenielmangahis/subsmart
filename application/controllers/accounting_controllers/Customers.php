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

            "assets/js/customer/lib/bday-picker.js",
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
            "assets/js/customer/lib/bday-picker.js",
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

        if(isset($customerId) || !empty($customerId)){
            $this->page_data['profile_info'] = $this->customer_ad_model->get_data_by_id('prof_id',$customerId,"acs_profile");
            $this->page_data['access_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$customerId,"acs_access");
            $this->page_data['office_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$customerId,"acs_office");
            $this->page_data['billing_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$customerId,"acs_billing");
            $this->page_data['alarm_info'] = $this->customer_ad_model->get_data_by_id('fk_prof_id',$customerId,"acs_alarm");
            $this->page_data['panel_type'] = $this->customer_ad_model->get_select_options('acs_alarm','panel_type');

            $get_customer_notes = array(
                'where' => array(
                    'fk_prof_id' => $customerId
                ),
                'table' => 'acs_notes',
                'select' => '*',
            );
            $this->page_data['customer_notes'] = $this->general->get_data_with_param($get_customer_notes);
            //$this->page_data['device_info'] = $this->customer_ad_model->get_all_by_id('fk_prof_id',$customerId,"acs_devices");
        
            $customer_contacts = array(
                'where' => array(
                    'customer_id' => $customerId
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
                    'customer_id' => $customerId
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

        $filters = [
            'customer_id' => $customerId
        ];

        if(!empty(get('type'))) {
            $filters['type'] = get('type');
            $this->page_data['type'] = get('type');
        }

        if(!empty(get('date'))) {
            switch (get('date')) {
                case 'today':
                    $filters['start-date'] = date("Y-m-d");
                    $filters['end-date'] = date("Y-m-d");
                break;
                case 'yesterday':
                    $filters['start-date'] = date("Y-m-d", strtotime(date("m/d/Y").' -1 day'));
                    $filters['end-date'] = date("Y-m-d", strtotime(date("m/d/Y").' -1 day'));
                break;
                case 'this-week':
                    $filters['start-date'] = date("Y-m-d", strtotime("this week -1 day"));
                    $filters['end-date'] = date("Y-m-d", strtotime("sunday -1 day"));
                break;
                case 'this-month':
                    $filters['start-date'] = date("Y-m-01");
                    $filters['end-date'] = date("Y-m-t");
                    // no break
                case 'this-quarter':
                    $quarters = [
                        1 => [
                            'start' => date("01/01/Y"),
                            'end' => date("03/t/Y")
                        ],
                        2 => [
                            'start' => date("04/01/Y"),
                            'end' => date("06/t/Y")
                        ],
                        3 => [
                            'start' => date("07/01/Y"),
                            'end' => date("09/t/Y")
                        ],
                        4 => [
                            'start' => date("10/01/Y"),
                            'end' => date("12/t/Y")
                        ]
                    ];
                    $month = date('n');
                    $quarter = ceil($month / 3);
                    
                    $filters['start-date'] = $quarters[$quarter]['start'];
                    $filters['end-date'] = $quarters[$quarter]['end'];
                break;
                case 'this-year':
                    $filters['start-date'] = date("Y-01-01");
                    $filters['end-date'] = date("Y-12-t");
                break;
                case 'last-week':
                    $filters['start-date'] = date("Y-m-d", strtotime("this week -1 week -1 day"));
                    $filters['end-date'] = date("Y-m-d", strtotime("sunday -1 week -1 day"));
                break;
                case 'last-month':
                    $filters['start-date'] = date("Y-m-01", strtotime(date("m/01/Y")." -1 month"));
                    $filters['end-date'] = date("Y-m-t", strtotime(date("m/01/Y")." -1 month"));
                break;
                case 'last-quarter':
                    $quarters = [
                        1 => [
                            'start' => date("01/01/Y"),
                            'end' => date("03/t/Y")
                        ],
                        2 => [
                            'start' => date("04/01/Y"),
                            'end' => date("06/t/Y")
                        ],
                        3 => [
                            'start' => date("07/01/Y"),
                            'end' => date("09/t/Y")
                        ],
                        4 => [
                            'start' => date("10/01/Y"),
                            'end' => date("12/t/Y")
                        ]
                    ];
                    $month = date('n');
                    $quarter = ceil($month / 3);
    
                    $filters['start-date'] = date("Y-m-d", strtotime($quarters[$quarter]['start']." -3 months"));
                    $filters['end-date'] = date("Y-m-t", strtotime($filters['start-date']." +2 months"));
                break;
                case 'last-year':
                    $filters['start-date'] = date("Y-01-01", strtotime(date("01/01/Y")." -1 year"));
                    $filters['end-date'] = date("Y-12-t", strtotime(date("12/t/Y")." -1 year"));
                break;
                case 'last-365-days':
                    $filters['start-date'] = date("Y-m-d", strtotime(date("m/d/Y")." -365 days"));
                    $filters['end-date'] = date("Y-m-d");
                break;
            }

            $this->page_data['date'] = get('date');
        }

        $this->page_data['transactions'] = $this->get_transactions($filters);

        $this->load->view('v2/pages/accounting/sales/customers/view', $this->page_data);
    }

    public function add()
    {
        $input = $this->input->post();

        $custom_fields_array = [];
        if (array_key_exists('custom_name', $input) && array_key_exists('custom_value', $input)) {
            foreach ($input['custom_name'] as $key => $name) {
                $cleanName = trim($name);
                $cleanValue = trim($input['custom_value'][$key]);

                if (!empty($cleanName) && !empty($cleanValue)) {
                    array_push($custom_fields_array, ['name' => $cleanName, 'value' => $cleanValue]);
                }
            }
        }

        $input_profile = array();
        $input_profile['fk_user_id'] = logged('id');
        $input_profile['fk_sa_id'] = $input['fk_sa_id'];
        $input_profile['company_id'] = logged('company_id');
        $input_profile['status'] = $input['status'];
        $input_profile['customer_type'] = $input['customer_type'];
        $input_profile['customer_group_id'] = $input['customer_group'];
        $input_profile['business_name'] = $input['business_name'];
        $input_profile['first_name'] = $input['first_name'];
        $input_profile['last_name'] = $input['last_name'];
        $input_profile['middle_name'] = $input['middle_name'];
        $input_profile['prefix'] = $input['prefix'];
        $input_profile['suffix'] = $input['suffix'];
        $input_profile['mail_add'] = $input['mail_add'];
        $input_profile['city'] = $input['city'];
        $input_profile['state'] = $input['state'];
        $input_profile['country'] = $input['country'];
        $input_profile['industry_type_id'] = $input['industry_type'];
        $input_profile['zip_code'] = $input['zip_code'];
        $input_profile['cross_street'] = $input['cross_street'];
        $input_profile['subdivision'] = $input['subdivision'];
        $input_profile['email'] = $input['email'];
        $input_profile['ssn'] = $input['ssn'];
        $input_profile['date_of_birth'] = $input['date_of_birth'];
        $input_profile['phone_h'] = $input['phone_h'];
        $input_profile['phone_m'] = $input['phone_m'];
        $input_profile['custom_fields'] = json_encode($custom_fields_array);
        $input_profile['is_sync'] = 0;
        if( $input['bill_method'] == 'CC' ){
            //Check cc if valid using converge
            $a_exp_date = explode("/", $input['credit_card_exp']);
            $exp_date   = $a_exp_date[0] . date("y",strtotime($a_exp_date[1] . "-01-01"));
            $data_cc = [
                'card_number' => $input['credit_card_num'],
                'exp_date' => $exp_date,
                'cvc' => $input['credit_card_exp_mm_yyyy'],
                'ssl_amount' => 0,
                'ssl_first_name' => $input['first_name'],
                'ssl_last_name' => $input['last_name'],
                'ssl_address' => $input['mail_add'] . ' ' . $input['city'] . ' ' . $input['state'],
                'ssl_zip' => $input['zip_code']
            ];
            $is_valid = $this->converge_check_cc_details_valid($data_cc);

            echo $is_valid;
            if( $is_valid['is_success'] == 1 ){
                $proceed = 1;
            }else{
                $proceed = 0;
            }
        }else{
            $proceed = 1;
        }   

        if( $proceed == 1 ){
            if(isset($input['customer_id'])){
                $customer = $this->customer_ad_model->get_customer_data_settings($input['customer_id']);
                if( $customer->adt_sales_project_id > 0 ){
                    $input_profile['is_sync'] = 0;
                }
                $this->general->update_with_key_field($input_profile, $input['customer_id'],'acs_profile','prof_id');
                $profile_id = $input['customer_id'];

                customerAuditLog(logged('id'), $profile_id, $profile_id, 'Customer', 'Updated customer ' .$input['first_name'].' '.$input['last_name']);

            }else{
                $profile_id = $this->general->add_return_id($input_profile, 'acs_profile');

                customerAuditLog(logged('id'), $profile_id, $profile_id, 'Customer', 'Created customer ' .$input['first_name'].' '.$input['last_name']);
            }


            $companyId = logged('company_id');
            $save_billing = $this->save_billing_information($input,$profile_id);
            $save_office = $this->save_office_information($input,$profile_id);
            $save_alarm = $this->save_alarm_information($input,$profile_id);
            $save_access = $this->save_access_information($input,$profile_id);
            $save_papers = $this->save_papers_information($input,$profile_id);
            $save_contacts = $this->save_contacts($input,$profile_id);

            if($companyId == 58){
                $this->save_solar_info($input,$profile_id);
            }
            

            if($save_billing == 0 || $save_office == 0 || $save_alarm == 0 || $save_access == 0 || $save_papers == 0){
                echo 'Error Occured on Saving Billing Information';
                $data_arr = array("success" => FALSE,"message" => 'Error on saving information');
            }else {
                if ($input['notes'] != "" && $input['notes'] != NULL && !empty($input['notes'])){
                    $this->save_notes($input,$profile_id);
                }
                //$this->generate_qr_image($profile_id);
                if(isset($input['customer_id'])){
                    $data_arr = array("success" => TRUE,"profile_id" => $input['customer_id']);
                }else{
                    $data_arr = array("success" => TRUE,"profile_id" => $profile_id);
                }
            }
        }

        die(json_encode($data_arr));
    }

    public function update($customerId)
    {
        $input = $this->input->post();
        $input['customer_id'] = $customerId;

        $custom_fields_array = [];
        if (array_key_exists('custom_name', $input) && array_key_exists('custom_value', $input)) {
            foreach ($input['custom_name'] as $key => $name) {
                $cleanName = trim($name);
                $cleanValue = trim($input['custom_value'][$key]);

                if (!empty($cleanName) && !empty($cleanValue)) {
                    array_push($custom_fields_array, ['name' => $cleanName, 'value' => $cleanValue]);
                }
            }
        }

        // customer profile info
        $input_profile = array();
        $input_profile['fk_user_id'] = logged('id');
        $input_profile['fk_sa_id'] = $input['fk_sa_id'];
        $input_profile['company_id'] = logged('company_id');
        $input_profile['status'] = $input['status'];
        $input_profile['customer_type'] = $input['customer_type'];
        $input_profile['customer_group_id'] = $input['customer_group'];
        $input_profile['business_name'] = $input['business_name'];
        $input_profile['first_name'] = $input['first_name'];
        $input_profile['last_name'] = $input['last_name'];
        $input_profile['middle_name'] = $input['middle_name'];
        $input_profile['prefix'] = $input['prefix'];
        $input_profile['suffix'] = $input['suffix'];
        $input_profile['mail_add'] = $input['mail_add'];
        $input_profile['city'] = $input['city'];
        $input_profile['state'] = $input['state'];
        $input_profile['country'] = $input['country'];
        $input_profile['industry_type_id'] = $input['industry_type'];
        $input_profile['zip_code'] = $input['zip_code'];
        $input_profile['cross_street'] = $input['cross_street'];
        $input_profile['subdivision'] = $input['subdivision'];
        $input_profile['email'] = $input['email'];
        $input_profile['ssn'] = $input['ssn'];
        $input_profile['date_of_birth'] = $input['date_of_birth'];
        $input_profile['phone_h'] = $input['phone_h'];
        $input_profile['phone_m'] = $input['phone_m'];
        $input_profile['custom_fields'] = json_encode($custom_fields_array);
        $input_profile['is_sync'] = 0;
        if( $input['bill_method'] == 'CC' ){
            //Check cc if valid using converge
            $a_exp_date = explode("/", $input['credit_card_exp']);
            $exp_date   = $a_exp_date[0] . date("y",strtotime($a_exp_date[1] . "-01-01"));
            $data_cc = [
                'card_number' => $input['credit_card_num'],
                'exp_date' => $exp_date,
                'cvc' => $input['credit_card_exp_mm_yyyy'],
                'ssl_amount' => 0,
                'ssl_first_name' => $input['first_name'],
                'ssl_last_name' => $input['last_name'],
                'ssl_address' => $input['mail_add'] . ' ' . $input['city'] . ' ' . $input['state'],
                'ssl_zip' => $input['zip_code']
            ];
            $is_valid = $this->converge_check_cc_details_valid($data_cc);

            echo $is_valid;
            if( $is_valid['is_success'] == 1 ){
                $proceed = 1;
            }else{
                $proceed = 0;
            }
        }else{
            $proceed = 1;
        }   

        if( $proceed == 1 ){
            if(isset($input['customer_id'])){
                $customer = $this->customer_ad_model->get_customer_data_settings($input['customer_id']);
                if( $customer->adt_sales_project_id > 0 ){
                    $input_profile['is_sync'] = 0;
                }
                $this->general->update_with_key_field($input_profile, $input['customer_id'],'acs_profile','prof_id');
                $profile_id = $input['customer_id'];

                customerAuditLog(logged('id'), $profile_id, $profile_id, 'Customer', 'Updated customer ' .$input['first_name'].' '.$input['last_name']);

            }else{
                $profile_id = $this->general->add_return_id($input_profile, 'acs_profile');

                customerAuditLog(logged('id'), $profile_id, $profile_id, 'Customer', 'Created customer ' .$input['first_name'].' '.$input['last_name']);
            }


            $companyId = logged('company_id');
            $save_billing = $this->save_billing_information($input,$profile_id);
            $save_office = $this->save_office_information($input,$profile_id);
            $save_alarm = $this->save_alarm_information($input,$profile_id);
            $save_access = $this->save_access_information($input,$profile_id);
            $save_papers = $this->save_papers_information($input,$profile_id);
            $save_contacts = $this->save_contacts($input,$profile_id);

            if($companyId == 58){
                $this->save_solar_info($input,$profile_id);
            }
            

            if($save_billing == 0 || $save_office == 0 || $save_alarm == 0 || $save_access == 0 || $save_papers == 0){
                echo 'Error Occured on Saving Billing Information';
                $data_arr = array("success" => FALSE,"message" => 'Error on saving information');
            }else {
                if ($input['notes'] != "" && $input['notes'] != NULL && !empty($input['notes'])){
                    $this->save_notes($input,$profile_id);
                }
                //$this->generate_qr_image($profile_id);
                if(isset($input['customer_id'])){
                    $data_arr = array("success" => TRUE,"profile_id" => $input['customer_id']);
                }else{
                    $data_arr = array("success" => TRUE,"profile_id" => $profile_id);
                }
            }
        }
        die(json_encode($data_arr));
    }

    private function save_billing_information($input,$id)
    {
        $input_billing = array();
        // billing data
        switch ($input['bill_freq']) {
            case 'One Time Only':
                $billing_frequency = 1;
                break;
            case 'Every 1 Month':
                $billing_frequency = 1;
                break;
            case 'Every 3 Months':
                $billing_frequency = 3;
                break;
            case 'Every 6 Months':
                $billing_frequency = 6;
                break;
            case 'Every 1 Year':
                $billing_frequency = 12;
                break;
            default:
                $billing_frequency = 0;
                break;
        }
        $input_billing['fk_prof_id'] = $id;
        $input_billing['card_fname'] = $input['card_fname'];
        $input_billing['card_lname'] = $input['card_lname'];
        $input_billing['card_address'] = $input['card_address'];
        $input_billing['city'] = $input['billing_city'];
        $input_billing['state'] = $input['billing_state'];
        $input_billing['zip'] = $input['billing_zip'];
        $input_billing['equipment'] = $input['equipment'];
        $input_billing['initial_dep'] = $input['initial_dep'];
        $input_billing['mmr'] = $input['mmr'];
        $input_billing['bill_freq'] = $input['bill_freq'];
        $input_billing['bill_day'] = $input['bill_day'];
        $input_billing['contract_term'] = $input['contract_term'];
        $input_billing['bill_start_date'] = $input['bill_start_date'];
        $input_billing['bill_end_date'] = $input['bill_end_date'];

        $input_billing['bill_method'] = $input['bill_method'];
        $input_billing['check_num'] = $input['check_num'];
        $input_billing['routing_num'] = $input['routing_num'];
        $input_billing['acct_num'] = $input['acct_num'];
        $input_billing['credit_card_num'] = $input['credit_card_num'];
        $input_billing['credit_card_exp'] = $input['credit_card_exp'];
        $input_billing['credit_card_exp_mm_yyyy'] = $input['credit_card_exp_mm_yyyy'];
        $input_billing['account_credential'] = $input['account_credential'];
        $input_billing['account_note'] = $input['account_note'];
        $input_billing['confirmation'] = $input['confirmation'];

        $input_billing['finance_amount'] = $input['finance_amount'];
        $input_billing['recurring_start_date'] = $input['recurring_start_date'];
        $input_billing['recurring_end_date'] = $input['recurring_end_date'];
        $input_billing['transaction_amount'] = $input['transaction_amount'];
        $input_billing['transaction_category'] = $input['transaction_category'];
        $input_billing['frequency'] = $input['frequency']; //Subscription
        $input_billing['billing_frequency'] = $billing_frequency; //Billing
        $input_billing['next_billing_date'] = date("n/j/Y",strtotime("+" . $billing_frequency . " months", strtotime($input['bill_start_date'])));
        $input_billing['next_subscription_billing_date'] = date("n/j/Y",strtotime("+" . $input['frequency'] . " months", strtotime($input['recurring_start_date'])));

        $check = array(
            'where' => array(
                'fk_prof_id' => $id
            ),
            'table' => 'acs_billing'
        );
        $exist = $this->general->get_data_with_param($check,FALSE);
        if($exist){
            return $this->general->update_with_key_field($input_billing, $input['customer_id'], 'acs_billing','fk_prof_id');
        }else{
            return $this->general->add_($input_billing, 'acs_billing');
        }
    }

    private function save_office_information($input,$id)
    {
        $input_office = array();

        // office data
        $input_office['fk_prof_id'] = $id;
        $input_office['welcome_sent'] = 0;
        $input_office['entered_by'] = $input['entered_by'];
        $input_office['time_entered'] = $input['time_entered'];
        $input_office['sales_date'] = $input['sales_date'];
        $input_office['credit_score'] = $input['credit_score'];
        $input_office['pay_history'] = $input['pay_history'];
        $input_office['fk_sales_rep_office'] = $input['fk_sales_rep_office'];
        $input_office['technician'] = $input['technician'];
        $input_office['install_date'] = $input['install_date'];
        $input_office['tech_arrive_time'] = $input['tech_arrive_time'];
        $input_office['tech_depart_time'] = $input['tech_depart_time'];
        $input_office['lead_source'] = $input['lead_source'];
        $input_office['verification'] = $input['verification'];
        $input_office['cancel_date'] = $input['cancel_date'];
        $input_office['cancel_reason'] = $input['cancel_reason'];
        $input_office['collect_date'] = $input['collect_date'];
        $input_office['collect_amount'] = $input['collect_amount'];
        $input_office['language'] = $input['language'];
        $input_office['pre_install_survey'] = $input['pre_install_survey'];
        $input_office['post_install_survey'] = $input['post_install_survey'];
        $input_office['monitoring_waived'] = $input['monitoring_waived'];

        if(isset($input['rebate_offer'])){
            $input_office['rebate_offer'] = $input['rebate_offer'];
        }else{
            $input_office['rebate_offer'] = 0;
        }

        $input_office['rebate_check1'] = $input['rebate_check1'];
        $input_office['rebate_check1_amt'] = $input['rebate_check1_amt'];
        $input_office['rebate_check2'] = $input['rebate_check2'];
        $input_office['rebate_check2_amt'] = $input['rebate_check2_amt'];
        $input_office['activation_fee'] = $input['activation_fee'];
        $input_office['way_of_pay'] = $input['way_of_pay'];

        if(isset($input['commision_scheme'])){
            $input_office['commision_scheme'] = $input['commision_scheme'][0];
        }else{
            $input_office['commision_scheme'] = 2;
        }

        $input_office['rep_comm'] = $input['rep_comm'];
        $input_office['rep_upfront_pay'] = $input['rep_upfront_pay'];
        $input_office['rep_tiered_bonus'] = $input['rep_tiered_bonus'];
        $input_office['rep_holdfund_bonus'] = $input['rep_holdfund_bonus'];
        $input_office['rep_deduction'] = $input['rep_deduction'];
        $input_office['tech_comm'] = $input['tech_comm'];
        $input_office['tech_upfront_pay'] = $input['tech_upfront_pay'];
        $input_office['tech_deduction'] = $input['tech_deduction'];
        $input_office['rep_charge_back'] = $input['rep_charge_back'];
        $input_office['rep_payroll_charge_back'] = $input['rep_payroll_charge_back'];

        if(isset($input['pso'])){
            $input_office['pso'] = $input['pso'][0];
        }else{
            $input_office['pso'] = 2;
        }

        $input_office['points_include'] = $input['points_include'];
        $input_office['price_per_point'] = $input['price_per_point'];
        $input_office['purchase_price'] = $input['purchase_price'];
        $input_office['purchase_multiple'] = $input['purchase_multiple'];
        $input_office['purchase_discount'] = $input['purchase_discount'];
        $input_office['equipment_cost'] = $input['equipment_cost'];
        $input_office['labor_cost'] = $input['labor_cost'];
        $input_office['job_profit'] = $input['job_profit'];
        $input_office['url'] = $input['url'];

        $check = array(
            'where' => array(
                'fk_prof_id' => $id
            ),
            'table' => 'acs_office'
        );
        $exist = $this->general->get_data_with_param($check,FALSE);
        if($exist){
            return $this->general->update_with_key_field($input_office, $input['customer_id'], 'acs_office','fk_prof_id');
        }else{
            return $this->general->add_($input_office, 'acs_office');
        }
    }

    private function save_alarm_information($input,$id)
    {
        $input_alarm = array();

        // alarm data
        $input_alarm['fk_prof_id'] = $id;
        $input_alarm['monitor_comp'] = $input['monitor_comp'];
        $input_alarm['monitor_id'] = $input['monitor_id'];
        //$input_alarm['install_date'] = $input['install_date'];
        $input_alarm['acct_type'] = $input['acct_type'];
        $input_alarm['online'] = $input['online'];
        $input_alarm['in_service'] = $input['in_service'];
        $input_alarm['equipment'] = $input['equipment'];
        $input_alarm['collections'] = $input['collections'];
        $input_alarm['credit_score_alarm'] = '';
        $input_alarm['passcode'] = $input['passcode'];
        $input_alarm['install_code'] = $input['install_code'];
        $input_alarm['mcn'] = $input['mcn'];
        $input_alarm['scn'] = $input['scn'];
        $input_alarm['panel_type'] = $input['panel_type'];
        $input_alarm['system_type'] = $input['system_type'];
        $input_alarm['warranty_type'] = $input['warranty_type'];
        $input_alarm['dealer'] = $input['dealer'];
        $input_alarm['alarm_login'] = $input['alarm_login'];
        $input_alarm['alarm_customer_id'] = $input['alarm_customer_id'];
        $input_alarm['alarm_cs_account'] = $input['alarm_cs_account'];
        $input_alarm['comm_type'] = $input['comm_type'];
        $input_alarm['account_cost'] = $input['account_cost'];
        $input_alarm['pass_thru_cost'] = $input['pass_thru_cost'];

        $check = array(
            'where' => array(
                'fk_prof_id' => $id
            ),
            'table' => 'acs_alarm'
        );
        $exist = $this->general->get_data_with_param($check,FALSE);
        if($exist){
            return $this->general->update_with_key_field($input_alarm, $input['customer_id'], 'acs_alarm','fk_prof_id');
        }else{
            return $this->general->add_($input_alarm, 'acs_alarm');
        }
    }

    private function save_access_information($input,$id)
    {
        $input_access = array();
        //access data
        $input_access['fk_prof_id'] = $id;
        if(isset($input['portal_status'])){
            $input_access['portal_status'] = $input['portal_status'];
        }else{
            $input_access['portal_status'] = 2;
        }

        $input_access['reset_password'] ='';
        $input_access['access_login'] = $input['access_login'];
        $input_access['access_password'] = $input['access_password'];
        $check = array(
            'where' => array(
                'fk_prof_id' => $id
            ),
            'table' => 'acs_access'
        );
        $exist = $this->general->get_data_with_param($check,FALSE);
        if($exist){
            return $this->general->update_with_key_field($input_access, $input['customer_id'], 'acs_access','fk_prof_id');
        }else{
            return $this->general->add_($input_access, 'acs_access');
        }
    }

    private function save_papers_information($input,$id)
    {
        $input_papers = array();
        $input_papers['customer_id'] = $id;
        $input_papers['rep_paper_date'] = $input['rep_paper_date'];
        $input_papers['tech_paper_date'] = $input['tech_paper_date'];
        $input_papers['scanned_date'] = $input['scanned_date'];
        $input_papers['paperwork'] = $input['paperwork'];
        $input_papers['submitted'] = $input['submitted'];
        $input_papers['funded'] = $input['funded'];
        $input_papers['charged_back'] = $input['charged_back'];
        $check = array(
            'where' => array(
                'customer_id' => $id
            ),
            'table' => 'acs_papers'
        );
        $exist = $this->general->get_data_with_param($check,FALSE);
        if($exist){
            return $this->general->update_with_key_field($input_papers, $input['customer_id'], 'acs_papers','customer_id');
        }else{
            return $this->general->add_($input_papers, 'acs_papers');
        }
    }

    private function save_notes($input,$id)
    {
        $input_notes = array();
            // notes data
            $input_notes['fk_prof_id'] = $id;
            $input_notes['note'] = $input['notes'];
            $input_notes['datetime'] = date("m-d-Y h:i A");
            $this->general->add_($input_notes, 'acs_notes');
    }

    private function save_contacts($postData, $customerId)
    {
        $payload = [];
        $saveToPayload = function ($customerNumber) use (&$payload, $postData, $customerId) {
            if (empty(trim($postData['contact_name' . $customerNumber]))) {
                return; // ignore empty contact with empty name
            }

            array_push($payload, [
                'name' => trim($postData['contact_name' . $customerNumber]),
                'relation' => $postData['contact_relationship' . $customerNumber],
                'phone' => $postData['contact_phone' . $customerNumber],
                'customer_id' => $customerId,
                'phone_type' => 'mobile',
            ]);
        };

        $saveToPayload(1);
        $saveToPayload(2);
        $saveToPayload(3);

        if (!empty($payload)) {
            $this->db->where('customer_id', $customerId);
            $this->db->delete('contacts');

            $this->db->insert_batch('contacts', $payload);
        }

        $this->db->where('customer_id', $customerId);
        $contacts = $this->db->get('contacts')->result();
        return $contacts;
    }

    private function save_solar_info($input,$id)
    {
        $solarInfo = array();
        $solarInfo['fk_prof_id'] = $id;
        $solarInfo['project_id'] = $input['project_id'];
        $solarInfo['lender_type'] = $input['lender_type'];
        $solarInfo['proposed_system_size'] = $input['proposed_system_size'];
        $solarInfo['proposed_modules'] = $input['proposed_modules'];
        $solarInfo['proposed_inverter'] = $input['proposed_inverter'];
        $solarInfo['proposed_offset'] = $input['proposed_offset'];
        $solarInfo['proposed_solar'] = $input['proposed_solar'];
        $solarInfo['proposed_utility'] = $input['proposed_utility'];
        $solarInfo['proposed_payment'] = $input['proposed_payment'];
        $solarInfo['annual_income'] = $input['annual_income'];
        $solarInfo['tree_estimate'] = $input['tree_estimate'];
        $solarInfo['roof_estimate'] = $input['roof_estimate'];
        $solarInfo['utility_account'] = $input['utility_account'];
        $solarInfo['utility_login'] = $input['utility_login'];
        $solarInfo['utility_pass'] = $input['utility_pass'];
        $solarInfo['meter_number'] = $input['meter_number'];
        $solarInfo['insurance_name'] = $input['insurance_name'];
        $solarInfo['insurance_number'] = $input['insurance_number'];
        $solarInfo['policy_number'] = $input['policy_number'];

        $check = array(
            'where' => array('fk_prof_id' => $id),
            'table' => 'acs_info_solar'
        );
        $exist = $this->general->get_data_with_param($check,FALSE);
        if($exist){
            return $this->general->update_with_key_field($solarInfo, $input['customer_id'], 'acs_info_solar','fk_prof_id');
        }else{
            return $this->general->add_($solarInfo, 'acs_info_solar');
        }
    }

    public function converge_check_cc_details_valid($data)
    {
        include APPPATH . 'libraries/Converge/src/Converge.php';

        $msg = '';
        $is_success = 0;

        $converge = new \wwwroth\Converge\Converge([
            'merchant_id' => CONVERGE_MERCHANTID,
            'user_id' => CONVERGE_MERCHANTUSERID,
            'pin' => CONVERGE_MERCHANTPIN,
            'demo' => false,
        ]);

        $verify = $converge->request('ccverify', [
            'ssl_card_number' => $data['card_number'],
            'ssl_exp_date' => $data['exp_date'],
            'ssl_cvv2cvc2' => $data['cvc'],
            'ssl_first_name' => $data['ssl_first_name'],
            'ssl_last_name' => $data['ssl_last_name'],
            'ssl_amount' => $data['ssl_amount'],
            'ssl_avs_address' => $data['ssl_address'],
            'ssl_avs_zip' => $data['ssl_zip'],
        ]);
        if( $verify['success'] == 1 ){
            if( $verify['ssl_result_message'] == 'DECLINED' ){
                $is_success = 0;
            }else{
                $is_success = 1;    
            }
            
        }else{
            $msg = $verify['errorMessage'];
        }
        
        $return = ['is_success' => $is_success, 'msg' => $msg];
        return $return;
    }

    private function get_transactions($filters = [])
    {
        $transactions = [];
        switch($filters['type']) {
            default :
                $transactions = $this->get_invoices($transactions, $filters);
                $transactions = $this->get_credit_memos($transactions, $filters);
                $transactions = $this->get_sales_receipts($transactions, $filters);
            break;
        }

        return $transactions;
    }

    private function get_invoices($transactions, $filters = [])
    {
        $invoices = $this->invoice_model->getAllByCustomerId($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($invoices as $invoice)
        {
            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item print-invoice" href="#">Print</a>
                    </li>
                    <li>
                        <a class="dropdown-item send-invoice" href="#">Send</a>
                    </li>
                    <li>
                        <a class="dropdown-item share-invoice-link" href="#">Share invoice link</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-invoice" href="#">View/Edit</a>
                    </li>
                    <li>
                        <a class="dropdown-item copy-invoice" href="#">Copy</a>
                    </li>
                    <li>
                        <a class="dropdown-item delete-invoice" href="#">Delete</a>
                    </li>
                    <li>
                        <a class="dropdown-item void-invoice" href="#">Void</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $invoice->id,
                'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                'type' => 'Invoice',
                'no' => $invoice->invoice_number,
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $invoice->message_on_invoice,
                'due_date' => date("m/d/Y", strtotime($invoice->due_date)),
                'aging' => '',
                'balance' => number_format(floatval(str_replace(',', '', $invoice->balance)), 2, '.', ','),
                'total' => number_format(floatval(str_replace(',', '', $invoice->grand_total)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $invoice->customer_email,
                'attachments' => '',
                'status' => '',
                'po_number' => '',
                'sales_rep' => '',
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_credit_memos($transactions, $filters = [])
    {
        $creditMemoFilt = [
            'company_id' => logged('company_id'),
            'customer_id' => $filters['customer_id']
        ];
        $creditMemos = $this->accounting_credit_memo_model->get_customer_credit_memos($creditMemoFilt);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($creditMemos as $creditMemo)
        {
            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item print-credit-memo" href="#">Print</a>
                    </li>
                    <li>
                        <a class="dropdown-item send-credit-memo" href="#">Send</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-credit-memo" href="#">View/Edit</a>
                    </li>
                    <li>
                        <a class="dropdown-item copy-credit-memo" href="#">Copy</a>
                    </li>
                    <li>
                        <a class="dropdown-item void-credit-memo" href="#">Void</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $creditMemo->id,
                'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                'type' => 'Credit Memo',
                'no' => $creditMemo->ref_no,
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $creditMemo->message_credit_memo,
                'due_date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                'aging' => '',
                'balance' => number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2, '.', ','),
                'total' => number_format(floatval(str_replace(',', '', $creditMemo->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $creditMemo->email,
                'attachments' => '',
                'status' => '',
                'po_number' => '',
                'sales_rep' => '',
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_sales_receipts($transactions, $filters = [])
    {
        $salesReceipts = $this->accounting_sales_receipt_model->getAllByCustomerId($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($salesReceipts as $salesReceipt)
        {
            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item print-sales-receipt" href="#">Print</a>
                    </li>
                    <li>
                        <a class="dropdown-item send-sales-receipt" href="#">Send</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-sales-receipt" href="#">View/Edit</a>
                    </li>
                    <li>
                        <a class="dropdown-item copy-sales-receipt" href="#">Copy</a>
                    </li>
                    <li>
                        <a class="dropdown-item delete-sales-receipt" href="#">Delete</a>
                    </li>
                    <li>
                        <a class="dropdown-item void-sales-receipt" href="#">Void</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $salesReceipt->id,
                'date' => date("m/d/Y", strtotime($salesReceipt->sales_receipt_date)),
                'type' => 'Sales Receipt',
                'no' => $salesReceipt->ref_no,
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $salesReceipt->message_sales_receipt,
                'due_date' => '',
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $salesReceipt->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $salesReceipt->email,
                'attachments' => '',
                'status' => '',
                'po_number' => '',
                'sales_rep' => '',
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }
}