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
        $this->load->model('accounting_recurring_transactions_model');
        $this->load->model('expenses_model');
        $this->load->model('accounting_single_time_activity_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_refund_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_delayed_credit_model');
        $this->load->model('accounting_delayed_charge_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('payment_records_model');
        $this->load->model('business_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('Clients_model');

        $this->page_data['page']->title = 'Customers';
        $this->page_data['page']->parent = 'Sales';

        add_css(array(
            // "assets/css/accounting/banking.css?v='rand()'",
            // "assets/css/accounting/accounting.css",
            // "assets/css/accounting/accounting.modal.css",
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
        add_footer_js(array(
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
        $this->page_data['customerTypes'] = $this->accounting_customers_model->get_customer_type_by_company_id(logged("company_id"));

        $this->page_data['openEstimates'] = $this->estimate_model->get_company_open_estimates(logged('company_id'));

        $unbilledCredits = $this->accounting_delayed_credit_model->get_unbilled_credits();
        $unbilledCharges = $this->accounting_delayed_charge_model->get_unbilled_charges();

        $paymentsFilter = [
            'start-date' => date("Y-m-d", strtotime("-30 days")),
            'company_id' => logged('company_id')
        ];
        $this->page_data['unbilledActivities'] = array_merge($unbilledCredits, $unbilledCharges);
        $this->page_data['overdueInvoices'] = $this->invoice_model->get_company_overdue_invoices(logged('company_id'));
        $this->page_data['openInvoices'] = $this->invoice_model->get_company_open_invoices(logged('company_id'));
        $this->page_data['payments'] = $this->payment_records_model->get_company_payments($paymentsFilter);

        if(!empty(get('transaction'))) {
            $this->page_data['transaction'] = get('transaction');

            switch(get('transaction')) {
                case 'estimates' :
                    $customers = $this->AcsProfile_model->get_customers_with_open_estimates(logged('company_id'));
                break;
                case 'unbilled-activity' :
                    $customers = $this->AcsProfile_model->get_customers_with_unbilled_activities(logged('company_id'));
                break;
                case 'overdue-invoices' :
                    $customers = $this->AcsProfile_model->get_customers_with_overdue_invoices(logged('company_id'));
                break;
                case 'open-invoices' :
                    $customers = $this->AcsProfile_model->get_customers_with_open_invoices(logged('company_id'));
                break;
                case 'payments' :
                    $customers = $this->AcsProfile_model->get_customers_with_payments($paymentsFilter);
                break;
            }

            $this->page_data['customers'] = $customers;
        }

        $search = get('search');
        if(!empty($search)) {
            $this->page_data['customers'] = array_filter($this->page_data['customers'], function($customer, $key) use ($search) {
                $name = $customer->last_name.', '.$customer->first_name;
                $email = $customer->email;
                $customer_type = $customer->customer_type;
                return (stripos($name . ' ' . $email . ' ' . $customer_type, $search) !== false);
            }, ARRAY_FILTER_USE_BOTH);

            $this->page_data['search'] = $search;
        }

        usort($this->page_data['customers'], function ($a, $b) {
            $nameA = $a->last_name.', '.$a->first_name;
            $nameB = $b->last_name.', '.$b->first_name;
            return strcasecmp($nameA, $nameB);
        });

        $get_company_settings = array(
            'where' => array(
                'company_id' => logged('company_id'),
                'setting_type' => 'import',
            ),
            'table' => 'customer_settings',
            'select' => '*',
        );
        $importSettings = $this->general->get_data_with_param($get_company_settings, false);
        $getImportFields = array(
            'table' => 'acs_import_fields',
            'select' => '*',
        );
        $this->page_data['importFieldsList'] = $this->general->get_data_with_param($getImportFields);

        $this->page_data['import_settings'] = $importSettings;

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
        $company = $this->business_model->getByCompanyId(logged('company_id'));
        $this->page_data['company'] = $company;
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
            if($filters['type'] !== 'unbilled-income') {
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
                    break;
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
            } else {
                $filters['start-date'] = date("Y-m-d", strtotime(str_replace('-', '/', get('date'))));
            }

            $this->page_data['date'] = get('date');
        }

        $get = $this->get_transactions($filters);

        $this->page_data['transactions'] = $get['transactions'];
        $this->page_data['headers'] = $get['headers'];
        $this->page_data['settingsCols'] = $get['settingsCols'];

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

        $headers = [
            'Date',
            'Type',
            'No.',
            'Customer',
            'Method',
            'Source',
            'Memo',
            'Due date',
            'Aging',
            'Balance',
            'Total',
            'Last Delivered',
            'Email',
            'Attachments',
            'Status',
            'P.O. Number',
            'Sales Rep',
        ];

        $settingsCols = [
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                <label for="chk_type" class="form-check-label">Type</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                <label for="chk_no" class="form-check-label">No.</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                <label for="chk_customer" class="form-check-label">Customer</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_method" class="form-check-input">
                <label for="chk_method" class="form-check-label">Method</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_source" class="form-check-input">
                <label for="chk_source" class="form-check-label">Source</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                <label for="chk_memo" class="form-check-label">Memo</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                <label for="chk_due_date" class="form-check-label">Due date</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_aging" class="form-check-input">
                <label for="chk_aging" class="form-check-label">Aging</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                <label for="chk_balance" class="form-check-label">Balance</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                <label for="chk_email" class="form-check-label">Email</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                <label for="chk_attachments" class="form-check-label">Attachments</label>
            </div>',
            '<div class="form-check">
                <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                <label for="chk_status" class="form-check-label">Status</label>
            </div>'
        ];

        switch($filters['type']) {
            default :
                $transactions = $this->get_invoices($transactions, $filters);
                $transactions = $this->get_credit_memos($transactions, $filters);
                $transactions = $this->get_sales_receipts($transactions, $filters);
                $transactions = $this->get_refund_receipts($transactions, $filters);
                $transactions = $this->get_delayed_credits($transactions, $filters);
                $transactions = $this->get_delayed_charges($transactions, $filters);
                $transactions = $this->get_estimates($transactions, $filters);
                $transactions = $this->get_payments($transactions, $filters);
                $transactions = $this->get_billable_expenses($transactions, $filters);
                $transactions = $this->get_time_charges($transactions, $filters);
            break;
            case 'all-plus-deposits' :
                $transactions = $this->get_invoices($transactions, $filters);
                $transactions = $this->get_credit_memos($transactions, $filters);
                $transactions = $this->get_sales_receipts($transactions, $filters);
                $transactions = $this->get_refund_receipts($transactions, $filters);
                $transactions = $this->get_delayed_credits($transactions, $filters);
                $transactions = $this->get_delayed_charges($transactions, $filters);
                $transactions = $this->get_estimates($transactions, $filters);
                $transactions = $this->get_payments($transactions, $filters);
                $transactions = $this->get_billable_expenses($transactions, $filters);
            break;
            case 'all-invoices' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Memo',
                    'Due date',
                    'Aging',
                    'Balance',
                    'Total',
                    'Last Delivered',
                    'Email',
                    'Attachments',
                    'Status',
                    'P.O. Number',
                    'Sales Rep',
                ];
        
                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                        <label for="chk_due_date" class="form-check-label">Due date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_aging" class="form-check-input">
                        <label for="chk_aging" class="form-check-label">Aging</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                        <label for="chk_balance" class="form-check-label">Balance</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                        <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                        <label for="chk_email" class="form-check-label">Email</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>'
                ];

                $transactions = $this->get_invoices($transactions, $filters);
            break;
            case 'open-invoices' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Memo',
                    'Due date',
                    'Aging',
                    'Balance',
                    'Total',
                    'Last Delivered',
                    'Email',
                    'Attachments',
                    'Status',
                    'P.O. Number',
                    'Sales Rep',
                ];
        
                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                        <label for="chk_due_date" class="form-check-label">Due date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_aging" class="form-check-input">
                        <label for="chk_aging" class="form-check-label">Aging</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                        <label for="chk_balance" class="form-check-label">Balance</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                        <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                        <label for="chk_email" class="form-check-label">Email</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>'
                ];

                $transactions = $this->get_invoices($transactions, $filters);
                $transactions = $this->get_credit_memos($transactions, $filters);
            break;
            case 'overdue-invoices' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Memo',
                    'Due date',
                    'Aging',
                    'Balance',
                    'Total',
                    'Last Delivered',
                    'Email',
                    'Attachments',
                    'Status',
                    'P.O. Number',
                    'Sales Rep',
                ];
        
                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                        <label for="chk_due_date" class="form-check-label">Due date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_aging" class="form-check-input">
                        <label for="chk_aging" class="form-check-label">Aging</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                        <label for="chk_balance" class="form-check-label">Balance</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                        <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                        <label for="chk_email" class="form-check-label">Email</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>'
                ];

                $transactions = $this->get_invoices($transactions, $filters);
            break;
            case 'open-estimates' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Memo',
                    'Expiration Date',
                    'Total',
                    'Last Delivered',
                    'Email',
                    'Accepted Date',
                    'Attachments',
                    'Status',
                    'P.O. Number',
                    'Sales Rep',
                ];

                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_expiration_date" class="form-check-input">
                        <label for="chk_expiration_date" class="form-check-label">Expiration Date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                        <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                        <label for="chk_email" class="form-check-label">Email</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_acccepted_date" class="form-check-input">
                        <label for="chk_acccepted_date" class="form-check-label">Accepted Date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                        <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                        <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                    </div>'
                ];

                $transactions = $this->get_estimates($transactions, $filters);
            break;
            case 'credit-memos' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Memo',
                    'Total',
                    'Last Delivered',
                    'Email',
                    'Attachments',
                    'Status',
                    'P.O. Number',
                    'Sales Rep',
                ];

                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                        <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                        <label for="chk_email" class="form-check-label">Email</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                        <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                        <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                    </div>'
                ];

                $transactions = $this->get_credit_memos($transactions, $filters);
            break;
            case 'unbilled-income' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Memo',
                    'Total',
                    'Attachments',
                    'Status'
                ];

                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>'
                ];

                $transactions = $this->get_unbilled_incomes($transactions, $filters);
            break;
            case 'recently-paid' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Method',
                    'Source',
                    'Memo',
                    'Due date',
                    'Aging',
                    'Balance',
                    'Total',
                    'Last Delivered',
                    'Email',
                    'Latest Payment',
                    'Attachments',
                    'Status',
                    'P.O. Number',
                    'Sales Rep',
                ];

                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_method" class="form-check-input">
                        <label for="chk_method" class="form-check-label">Method</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_source" class="form-check-input">
                        <label for="chk_source" class="form-check-label">Source</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                        <label for="chk_due_date" class="form-check-label">Due date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_aging" class="form-check-input">
                        <label for="chk_aging" class="form-check-label">Aging</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                        <label for="chk_balance" class="form-check-label">Balance</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_last_delivered" class="form-check-input">
                        <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_email" class="form-check-input">
                        <label for="chk_email" class="form-check-label">Email</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_latest_payment" class="form-check-input">
                        <label for="chk_latest_payment" class="form-check-label">Latest Payment</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>'
                ];

                $transactions = $this->get_recently_paid_invoices($transactions, $filters);
            break;
            case 'money-received' :
                $headers = [
                    'Date',
                    'Type',
                    'No.',
                    'Customer',
                    'Memo',
                    'Total',
                    'Attachments',
                    'Status',
                    'P.O. Number',
                    'Sales Rep',
                ];

                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_customer" class="form-check-input">
                        <label for="chk_customer" class="form-check-label">Customer</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                        <label for="chk_memo" class="form-check-label">Memo</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                        <label for="chk_status" class="form-check-label">Status</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                        <label for="chk_no" class="form-check-label">No.</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                        <label for="chk_attachments" class="form-check-label">Attachments</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                        <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                    </div>',
                ];

                $transactions = $this->get_payments($transactions, $filters);
            break;
            case 'recurring-templates' :
                $headers = [
                    'Date',
                    'Type',
                    'Txn Type',
                    'Interval',
                    'Previous Date',
                    'Next Date',
                    'Amount',
                    'P.O. Number',
                    'Sales Rep',
                ];

                $settingsCols = [
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_name" class="form-check-input">
                        <label for="chk_name" class="form-check-label">Name</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                        <label for="chk_type" class="form-check-label">Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_txn_type" class="form-check-input">
                        <label for="chk_txn_type" class="form-check-label">Txn Type</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_interval" class="form-check-input">
                        <label for="chk_interval" class="form-check-label">Interval</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_previous_date" class="form-check-input">
                        <label for="chk_previous_date" class="form-check-label">Previous Date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_next_date" class="form-check-input">
                        <label for="chk_next_date" class="form-check-label">Next Date</label>
                    </div>',
                    '<div class="form-check">
                        <input type="checkbox" checked="checked" name="col_chk" id="chk_amount" class="form-check-input">
                        <label for="chk_amount" class="form-check-label">Amount</label>
                    </div>',
                ];

                $transactions = $this->get_recurring_templates($transactions, $filters);
            break;
        }

        if(isset($filters['start-date']) && $filters['type'] !== 'unbilled-income') {
            $transactions = array_filter($transactions, function($v, $k) use ($filters) {
                return strtotime($v['date']) >= strtotime($filters['start-date']) && strtotime($v['date']) <= strtotime($filters['end-date']);
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($transactions, function($a, $b) {
            if($a['date'] === $b['date']) {
                return strtotime($b['date_created']) > strtotime($a['date_created']);
            }
            return strtotime($b['date']) > strtotime($a['date']);
        });

        return [
            'transactions' => $transactions,
            'headers' => $headers,
            'settingsCols' => $settingsCols
        ];
    }

    private function get_invoices($transactions, $filters = [])
    {
        $invoices = $this->invoice_model->getAllByCustomerId($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($invoices as $invoice)
        {
            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-invoice' href='/invoice/preview/$invoice->id?format=print' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-invoice' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-invoice' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item delete-invoice' href='#'>Delete</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-invoice' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            $flag = true;
            switch($filters['type']) {
                case 'open-invoices' :
                    if(in_array($invoice->INV_status, ['Draft', 'Declined', 'Paid'])) {
                        $flag = false;
                    }
                break;
                case 'overdue-invoices' :
                    if(in_array($invoice->INV_status, ['Draft', 'Declined', 'Paid'])) {
                        $flag = false;
                    } else {
                        if(strtotime($invoice->due_date) > strtotime(date("m/d/Y"))) {
                            $flag = false;
                        }
                    }
                break;
            }

            if($flag) {
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
                    'status' => $invoice->INV_status,
                    'po_number' => '',
                    'sales_rep' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($invoice->date_created)),
                    'manage' => $manageCol
                ];
            }
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
            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-credit-memo' href='/accounting/customers/print-transaction/credit-memo/$creditMemo->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-credit-memo' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-credit-memo' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-credit-memo' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

            if($filters['type'] === 'open-invoices' && floatval($creditMemo->balance) > 0 || $filters['type'] !== 'open-invoices') {
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
                    'status' => floatval($creditMemo->balance) > 0 ? 'Unapplied' : 'Applied',
                    'po_number' => '',
                    'sales_rep' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($creditMemo->created_at)),
                    'manage' => $manageCol
                ];
            }
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
            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-sales-receipt' href='/accounting/customers/print-transaction/sales-receipt/$salesReceipt->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-sales-receipt' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-sales-receipt' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item delete-sales-receipt' href='#'>Delete</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-sales-receipt' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

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
                'status' => 'Paid',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($salesReceipt->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_refund_receipts($transactions, $filters = [])
    {
        $refundReceipts = $this->accounting_refund_receipt_model->get_customer_refund_receipts($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($refundReceipts as $refundReceipt)
        {
            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-refund-receipt-check' href='#'>Print check</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-refund-receipt' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item print-refund-receipt' href='/accounting/customers/print-transaction/refund-receipt/$refundReceipt->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-refund-receipt' href='#'>View/Edit</a>
                    </li>
                </ul>
            </div>";

            $transactions[] = [
                'id' => $refundReceipt->id,
                'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                'type' => 'Refund',
                'no' => $refundReceipt->ref_no,
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $refundReceipt->message_refund_receipt,
                'due_date' => '',
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $refundReceipt->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $refundReceipt->email,
                'attachments' => '',
                'status' => 'Paid',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($refundReceipt->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_delayed_credits($transactions, $filters = [])
    {
        $delayedCredits = $this->accounting_delayed_credit_model->get_customer_delayed_credits($filters['customer_id'], logged('company_id'));
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($delayedCredits as $delayedCredit)
        {
            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-delayed-credit" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $delayedCredit->id,
                'date' => date("m/d/Y", strtotime($delayedCredit->delayed_credit_date)),
                'type' => 'Credit',
                'no' => $delayedCredit->ref_no,
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $delayedCredit->memo,
                'due_date' => date("m/d/Y", strtotime($delayedCredit->delayed_credit_date)),
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $delayedCredit->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => '',
                'attachments' => '',
                'status' => floatval($delayedCredit->remaining_balance) > 0 ? 'Open' : 'Closed',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($delayedCredit->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_delayed_charges($transactions, $filters = [])
    {
        $delayedCharges = $this->accounting_delayed_charge_model->get_customer_delayed_charges($filters['customer_id'], logged('company_id'));
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($delayedCharges as $delayedCharge)
        {
            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-delayed-charge" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $delayedCharge->id,
                'date' => date("m/d/Y", strtotime($delayedCharge->delayed_charge_date)),
                'type' => 'Charge',
                'no' => $delayedCharge->ref_no,
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $delayedCharge->memo,
                'due_date' => date("m/d/Y", strtotime($delayedCharge->delayed_charge_date)),
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $delayedCharge->total_amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => '',
                'attachments' => '',
                'status' => floatval($delayedCharge->remaining_balance) > 0 ? 'Open' : 'Closed',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($delayedCharge->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_estimates($transactions, $filters = [])
    {
        $estimates = $this->estimate_model->getAllEstimatesByCustomerId($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($estimates as $estimate)
        {
            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item create-invoice' href='#'>Create invoice</a>
                    </li>
                    <li>
                        <a class='dropdown-item print-estimate' href='/estimate/print/$estimate->id' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-estimate' href='#' acs-id='$estimate->customer_id' est-id='$estimate->id'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item update-estimate-status' href='#'>Update status</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-estimate' href='#'>View/Edit</a>
                    </li>
                </ul>
            </div>";

            $total1 = ((float)$estimate->option1_total) + ((float)$estimate->option2_total);
            $total2 = ((float)$estimate->bundle1_total) + ((float)$estimate->bundle2_total);

            if ($estimate->estimate_type == 'Option') {
                $grandTotal = $total1;
            } elseif ($estimate->estimate_type == 'Bundle') {
                $grandTotal = $total2;
            } else {
                $grandTotal = $estimate->grand_total;
            }

            $flag = true;
            if($filters['type'] === 'open-estimates') {
                if(in_array($estimate->status, ['Invoiced', 'Lost', 'Declined By Customer'])) {
                    $flag = false;
                }
            }

            if($flag) {
                $transactions[] = [
                    'id' => $estimate->id,
                    'date' => date("m/d/Y", strtotime($estimate->estimate_date)),
                    'type' => 'Estimate',
                    'no' => $estimate->estimate_number,
                    'customer' => $customerName,
                    'method' => '',
                    'source' => '',
                    'memo' => $estimate->customer_message,
                    'due_date' => date("m/d/Y", strtotime($estimate->expiry_date)),
                    'aging' => '',
                    'balance' => '0.00',
                    'total' => number_format(floatval(str_replace(',', '', $grandTotal)), 2, '.', ','),
                    'last_delivered' => '',
                    'email' => '',
                    'attachments' => '',
                    'status' => $estimate->status,
                    'po_number' => '',
                    'sales_rep' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($estimate->created_at)),
                    'manage' => $manageCol
                ];
            }
        }

        return $transactions;
    }

    private function get_payments($transactions, $filters = [])
    {
        $payments = $this->accounting_receive_payment_model->get_payments_by_customer_id($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($payments as $payment)
        {
            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item view-edit-payment" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            $transactions[] = [
                'id' => $payment->id,
                'date' => date("m/d/Y", strtotime($payment->payment_date)),
                'type' => 'Payment',
                'no' => $payment->ref_no,
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $payment->memo,
                'due_date' => date("m/d/Y", strtotime($payment->payment_date)),
                'aging' => '',
                'balance' => '0.00',
                'total' => '-'.number_format(floatval(str_replace(',', '', $payment->amount_received)), 2, '.', ','),
                'last_delivered' => '',
                'email' => $customer->email,
                'attachments' => '',
                'status' => 'Closed',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($payment->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_unbilled_incomes($transactions, $filters = [])
    {
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        $delayedCredits = $this->accounting_delayed_credit_model->get_customer_delayed_credits($filters['customer_id'], logged('company_id'));
        $delayedCharges = $this->accounting_delayed_charge_model->get_customer_delayed_charges($filters['customer_id'], logged('company_id'));
        $billableExpenses = $this->accounting_customers_model->get_customer_billable_expenses($filters['customer_id']);

        foreach($delayedCredits as $credit)
        {
            if($credit->status === '1' && strtotime($credit->delayed_credit_date) <= strtotime($filters['start-date'])) {
                $transactions[] = [
                    'id' => $credit->id,
                    'date' => date("m/d/Y", strtotime($credit->delayed_credit_date)),
                    'type' => 'Credit',
                    'no' => $credit->ref_no,
                    'customer' => $customerName,
                    'memo' => $credit->memo,
                    'total' => number_format(floatval(str_replace(',', '', $credit->total_amount)), 2, '.', ','),
                    'attachments' => '',
                    'status' => floatval($credit->remaining_balance) > 0 ? 'Open' : 'Closed'
                ];
            }
        }

        foreach($delayedCharges as $charge)
        {
            if($charge->status === '1' && strtotime($charge->delayed_charge_date) <= strtotime($filters['start-date'])) {
                $transactions[] = [
                    'id' => $charge->id,
                    'date' => date("m/d/Y", strtotime($charge->delayed_charge_date)),
                    'type' => 'Charge',
                    'no' => $charge->ref_no,
                    'customer' => $customerName,
                    'memo' => $charge->memo,
                    'total' => number_format(floatval(str_replace(',', '', $charge->total_amount)), 2, '.', ','),
                    'attachments' => '',
                    'status' => floatval($charge->remaining_balance) > 0 ? 'Open' : 'Closed'
                ];
            }
        }

        foreach($billableExpenses as $billableExpense)
        {
            switch($billableExpense->transaction_type) {
                case 'Expense' :
                    $expense = $this->vendors_model->get_expense_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($expense->payment_date));
                break;
                case 'Check' :
                    $check = $this->vendors_model->get_check_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($check->payment_date));
                break;
                case 'Bill' :
                    $bill = $this->vendors_model->get_bill_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($bill->bill_date));
                break;
                case 'Vendor Credit' :
                    $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($vendorCredit->payment_date));
                break;
                case 'Credit Card Credit' :
                    $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($ccCredit->payment_date));
                break;
            }

            $transactions[] = [
                'id' => $billableExpense->id,
                'date' => $date,
                'type' => 'Billable Expense Charge',
                'no' => '',
                'customer' => $customerName,
                'memo' => $billableExpense->description,
                'total' => number_format(floatval(str_replace(',', '', $billableExpense->amount)), 2, '.', ','),
                'attachments' => '',
                'status' => floatval($billableExpense->received) > 0 ? 'Closed' : 'Open'
            ];
        }

        return $transactions;
    }

    private function get_recently_paid_invoices($transactions, $filters = [])
    {
        $payments = $this->invoice_model->get_customer_payments($filters['customer_id'], logged('company_id'));
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($payments as $payment)
        {
            $invoice = $this->invoice_model->get_invoice_by_invoice_number($payment->invoice_number, logged('company_id'));

            $manageCol = "<div class='dropdown table-management'>
                <a href='#' class='dropdown-toggle' data-bs-toggle='dropdown'>
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                    <li>
                        <a class='dropdown-item print-invoice' href='/invoice/preview/$invoice->id?format=print' target='_blank'>Print</a>
                    </li>
                    <li>
                        <a class='dropdown-item send-invoice' href='#'>Send</a>
                    </li>
                    <li>
                        <a class='dropdown-item view-edit-invoice' href='#'>View/Edit</a>
                    </li>
                    <li>
                        <a class='dropdown-item copy-transaction' href='#'>Copy</a>
                    </li>
                    <li>
                        <a class='dropdown-item delete-invoice' href='#'>Delete</a>
                    </li>
                    <li>
                        <a class='dropdown-item void-invoice' href='#'>Void</a>
                    </li>
                </ul>
            </div>";

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
                'latest_payment' => date("m/d/Y", strtotime($payment->payment_date)),
                'attachments' => '',
                'status' => $invoice->INV_status,
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($invoice->date_created)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_billable_expenses($transactions, $filters = [])
    {
        $billableExpenses = $this->accounting_customers_model->get_customer_billable_expenses($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($billableExpenses as $billableExpense)
        {
            $manageCol = '<div class="dropdown table-management">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                    </li>
                    <li>
                        <a class="dropdown-item view-edit-billable-expense" href="#">View/Edit</a>
                    </li>
                </ul>
            </div>';

            switch($billableExpense->transaction_type) {
                case 'Expense' :
                    $expense = $this->vendors_model->get_expense_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($expense->payment_date));
                break;
                case 'Check' :
                    $check = $this->vendors_model->get_check_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($check->payment_date));
                break;
                case 'Bill' :
                    $bill = $this->vendors_model->get_bill_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($bill->bill_date));
                break;
                case 'Vendor Credit' :
                    $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($vendorCredit->payment_date));
                break;
                case 'Credit Card Credit' :
                    $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                    $date = date("m/d/Y", strtotime($ccCredit->payment_date));
                break;
            }

            $transactions[] = [
                'id' => $billableExpense->id,
                'date' => $date,
                'type' => 'Billable Expense Charge',
                'no' => '',
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => $billableExpense->description,
                'due_date' => $date,
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval(str_replace(',', '', $billableExpense->amount)), 2, '.', ','),
                'last_delivered' => '',
                'email' => '',
                'attachments' => '',
                'status' => floatval($billableExpense->received) > 0 ? 'Closed' : 'Open',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($billableExpense->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_time_charges($transactions, $filters = [])
    {
        $timeCharges = $this->accounting_single_time_activity_model->get_customer_time_charges($filters['customer_id']);
        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($timeCharges as $timeCharge)
        {
            if($timeCharge->status === '1') {
                $manageCol = '<div class="dropdown table-management">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                        </li>
                        <li>
                            <a class="dropdown-item view-edit-time-charge" href="#">View/Edit</a>
                        </li>
                    </ul>
                </div>';
            } else {
                $manageCol = '<div class="dropdown table-management">
                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item view-edit-billable-expense" href="#">View/Edit</a>
                        </li>
                    </ul>
                </div>';
            }

            $price = floatval(str_replace(',', '', $timeCharge->hourly_rate));

            $hours = substr($timeCharge->time, 0, -3);
            $time = explode(':', $hours);
            $hr = $time[0] + ($time[1] / 60);

            $total = $hr * $price;

            $transactions[] = [
                'id' => $timeCharge->id,
                'date' => date("m/d/Y", strtotime($timeCharge->date)),
                'type' => 'Time Charge',
                'no' => '',
                'customer' => $customerName,
                'method' => '',
                'source' => '',
                'memo' => '',
                'due_date' => date("m/d/Y", strtotime($timeCharge->date)),
                'aging' => '',
                'balance' => '0.00',
                'total' => number_format(floatval($total), 2, '.', ','),
                'last_delivered' => '',
                'email' => '',
                'attachments' => '',
                'status' => $timeCharge->status === '1' ? 'Open' : 'Closed',
                'po_number' => '',
                'sales_rep' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($timeCharge->created_at)),
                'manage' => $manageCol
            ];
        }

        return $transactions;
    }

    private function get_recurring_templates($transactions, $filters = [])
    {
        $invoices = $this->accounting_recurring_transactions_model->get_customer_recurring_invoices($filters['customer_id']);
        $creditMemos = $this->accounting_recurring_transactions_model->get_customer_recurring_credit_memos($filters['customer_id']);
        $salesReceipts = $this->accounting_recurring_transactions_model->get_customer_recurring_sales_receipt($filters['customer_id']);
        $refundReceipts = $this->accounting_recurring_transactions_model->get_customer_recurring_refund_receipt($filters['customer_id']);
        $delayedCredits = $this->accounting_recurring_transactions_model->get_customer_recurring_delayed_credit($filters['customer_id']);
        $delayedCharges = $this->accounting_recurring_transactions_model->get_customer_recurring_delayed_charge($filters['customer_id']);

        $customer = $this->accounting_customers_model->get_by_id($filters['customer_id']);
        $customerName = $customer->first_name . ' ' . $customer->last_name;

        foreach($invoices as $invoice)
        {
            $recurringData = $this->accounting_recurring_transactions_model->get_by_type_and_transaction_id('invoice', $invoice->id);

            $previous = !is_null($recurringData->previous_date) && $recurringData->previous_date !== '' ? date("m/d/Y", strtotime($recurringData->previous_date)) : null;
            $next = date("m/d/Y", strtotime($recurringData->next_date));

            switch ($recurringData->recurring_interval) {
                case 'daily' :
                    $interval = 'Every Day';

                    if(intval($every) > 1) {
                        $interval = "Every $every Days";
                    }
                break;
                case 'weekly' :
                    $interval = 'Every Week';

                    if(intval($every) > 1) {
                        $interval = "Every $every Weeks";
                    }
                break;
                case 'monthly' :
                    $interval = 'Every Month';

                    if(intval($every) > 1) {
                        $interval = "Every $every Months";
                    }
                break;
                case 'yearly' :
                    $interval = 'Every Year';
                break;
                default :
                    $interval = '';
                    $previous = '';
                    $next = '';
                break;
            }

            $total = number_format($invoice->grand_total, 2, '.', ',');

            $transactions[] = [
                'id' => $invoice->id,
                'recurring_id' => $recurringData->id,
                'name' => $customerName,
                'type' => ucfirst($recurringData->recurring_type),
                'txn_type' => 'Invoice',
                'interval' => $interval,
                'previous_date' => $previous,
                'next_date' => $recurringData->status === "2" ? "Paused" : $next,
                'amount' => $total,
                'po_number' => $invoice->po_number,
                'sales_rep' => '',
                'date' => date("m/d/Y", strtotime($recurringData->created_at))
            ];
        }

        foreach($creditMemos as $creditMemo)
        {
            $recurringData = $this->accounting_recurring_transactions_model->get_by_type_and_transaction_id('credit memo', $creditMemo->id);

            $previous = !is_null($recurringData->previous_date) && $recurringData->previous_date !== '' ? date("m/d/Y", strtotime($recurringData->previous_date)) : null;
            $next = date("m/d/Y", strtotime($recurringData->next_date));

            switch ($recurringData->recurring_interval) {
                case 'daily' :
                    $interval = 'Every Day';

                    if(intval($every) > 1) {
                        $interval = "Every $every Days";
                    }
                break;
                case 'weekly' :
                    $interval = 'Every Week';

                    if(intval($every) > 1) {
                        $interval = "Every $every Weeks";
                    }
                break;
                case 'monthly' :
                    $interval = 'Every Month';

                    if(intval($every) > 1) {
                        $interval = "Every $every Months";
                    }
                break;
                case 'yearly' :
                    $interval = 'Every Year';
                break;
                default :
                    $interval = '';
                    $previous = '';
                    $next = '';
                break;
            }

            $total = number_format($creditMemo->total_amount, 2, '.', ',');

            $transactions[] = [
                'id' => $creditMemo->id,
                'recurring_id' => $recurringData->id,
                'name' => $customerName,
                'type' => ucfirst($recurringData->recurring_type),
                'txn_type' => 'Credit Memo',
                'interval' => $interval,
                'previous_date' => $previous,
                'next_date' => $recurringData->status === "2" ? "Paused" : $next,
                'amount' => $total,
                'po_number' => $creditMemo->po_number,
                'sales_rep' => $creditMemo->sales_rep,
                'date' => date("m/d/Y", strtotime($recurringData->created_at))
            ];
        }

        foreach($salesReceipts as $salesReceipt)
        {
            $recurringData = $this->accounting_recurring_transactions_model->get_by_type_and_transaction_id('sales receipt', $salesReceipt->id);

            $previous = !is_null($recurringData->previous_date) && $recurringData->previous_date !== '' ? date("m/d/Y", strtotime($recurringData->previous_date)) : null;
            $next = date("m/d/Y", strtotime($recurringData->next_date));

            switch ($recurringData->recurring_interval) {
                case 'daily' :
                    $interval = 'Every Day';

                    if(intval($every) > 1) {
                        $interval = "Every $every Days";
                    }
                break;
                case 'weekly' :
                    $interval = 'Every Week';

                    if(intval($every) > 1) {
                        $interval = "Every $every Weeks";
                    }
                break;
                case 'monthly' :
                    $interval = 'Every Month';

                    if(intval($every) > 1) {
                        $interval = "Every $every Months";
                    }
                break;
                case 'yearly' :
                    $interval = 'Every Year';
                break;
                default :
                    $interval = '';
                    $previous = '';
                    $next = '';
                break;
            }

            $total = number_format($salesReceipt->total_amount, 2, '.', ',');

            $transactions[] = [
                'id' => $salesReceipt->id,
                'recurring_id' => $recurringData->id,
                'name' => $customerName,
                'type' => ucfirst($recurringData->recurring_type),
                'txn_type' => 'Sales Receipt',
                'interval' => $interval,
                'previous_date' => $previous,
                'next_date' => $recurringData->status === "2" ? "Paused" : $next,
                'amount' => $total,
                'po_number' => $salesReceipt->po_number,
                'sales_rep' => $salesReceipt->sales_rep,
                'date' => date("m/d/Y", strtotime($recurringData->created_at))
            ];
        }

        foreach($refundReceipts as $refundReceipt)
        {
            $recurringData = $this->accounting_recurring_transactions_model->get_by_type_and_transaction_id('refund', $refundReceipt->id);

            $previous = !is_null($recurringData->previous_date) && $recurringData->previous_date !== '' ? date("m/d/Y", strtotime($recurringData->previous_date)) : null;
            $next = date("m/d/Y", strtotime($recurringData->next_date));

            switch ($recurringData->recurring_interval) {
                case 'daily' :
                    $interval = 'Every Day';

                    if(intval($every) > 1) {
                        $interval = "Every $every Days";
                    }
                break;
                case 'weekly' :
                    $interval = 'Every Week';

                    if(intval($every) > 1) {
                        $interval = "Every $every Weeks";
                    }
                break;
                case 'monthly' :
                    $interval = 'Every Month';

                    if(intval($every) > 1) {
                        $interval = "Every $every Months";
                    }
                break;
                case 'yearly' :
                    $interval = 'Every Year';
                break;
                default :
                    $interval = '';
                    $previous = '';
                    $next = '';
                break;
            }

            $total = number_format($refundReceipt->total_amount, 2, '.', ',');

            $transactions[] = [
                'id' => $refundReceipt->id,
                'recurring_id' => $recurringData->id,
                'name' => $customerName,
                'type' => ucfirst($recurringData->recurring_type),
                'txn_type' => 'Refund',
                'interval' => $interval,
                'previous_date' => $previous,
                'next_date' => $recurringData->status === "2" ? "Paused" : $next,
                'amount' => $total,
                'po_number' => $refundReceipt->po_number,
                'sales_rep' => $refundReceipt->sales_rep,
                'date' => date("m/d/Y", strtotime($recurringData->created_at))
            ];
        }

        foreach($delayedCredits as $delayedCredit)
        {
            $recurringData = $this->accounting_recurring_transactions_model->get_by_type_and_transaction_id('npcredit', $delayedCredit->id);

            $previous = !is_null($recurringData->previous_date) && $recurringData->previous_date !== '' ? date("m/d/Y", strtotime($recurringData->previous_date)) : null;
            $next = date("m/d/Y", strtotime($recurringData->next_date));

            switch ($recurringData->recurring_interval) {
                case 'daily' :
                    $interval = 'Every Day';

                    if(intval($every) > 1) {
                        $interval = "Every $every Days";
                    }
                break;
                case 'weekly' :
                    $interval = 'Every Week';

                    if(intval($every) > 1) {
                        $interval = "Every $every Weeks";
                    }
                break;
                case 'monthly' :
                    $interval = 'Every Month';

                    if(intval($every) > 1) {
                        $interval = "Every $every Months";
                    }
                break;
                case 'yearly' :
                    $interval = 'Every Year';
                break;
                default :
                    $interval = '';
                    $previous = '';
                    $next = '';
                break;
            }

            $total = number_format($delayedCredit->total_amount, 2, '.', ',');

            $transactions[] = [
                'id' => $delayedCredit->id,
                'recurring_id' => $recurringData->id,
                'name' => $customerName,
                'type' => ucfirst($recurringData->recurring_type),
                'txn_type' => 'Credit',
                'interval' => $interval,
                'previous_date' => $previous,
                'next_date' => $recurringData->status === "2" ? "Paused" : $next,
                'amount' => $total,
                'po_number' => '',
                'sales_rep' => '',
                'date' => date("m/d/Y", strtotime($recurringData->created_at))
            ];
        }

        foreach($delayedCharges as $delayedCharge)
        {
            $recurringData = $this->accounting_recurring_transactions_model->get_by_type_and_transaction_id('npcharge', $delayedCharge->id);

            $previous = !is_null($recurringData->previous_date) && $recurringData->previous_date !== '' ? date("m/d/Y", strtotime($recurringData->previous_date)) : null;
            $next = date("m/d/Y", strtotime($recurringData->next_date));

            switch ($recurringData->recurring_interval) {
                case 'daily' :
                    $interval = 'Every Day';

                    if(intval($every) > 1) {
                        $interval = "Every $every Days";
                    }
                break;
                case 'weekly' :
                    $interval = 'Every Week';

                    if(intval($every) > 1) {
                        $interval = "Every $every Weeks";
                    }
                break;
                case 'monthly' :
                    $interval = 'Every Month';

                    if(intval($every) > 1) {
                        $interval = "Every $every Months";
                    }
                break;
                case 'yearly' :
                    $interval = 'Every Year';
                break;
                default :
                    $interval = '';
                    $previous = '';
                    $next = '';
                break;
            }

            $total = number_format($delayedCharge->total_amount, 2, '.', ',');

            $transactions[] = [
                'id' => $delayedCharge->id,
                'recurring_id' => $recurringData->id,
                'name' => $customerName,
                'type' => ucfirst($recurringData->recurring_type),
                'txn_type' => 'Charge',
                'interval' => $interval,
                'previous_date' => $previous,
                'next_date' => $recurringData->status === "2" ? "Paused" : $next,
                'amount' => $total,
                'po_number' => '',
                'sales_rep' => '',
                'date' => date("m/d/Y", strtotime($recurringData->created_at))
            ];
        }

        return $transactions;
    }

    public function export()
    {
        $user_id = logged('id');
        $items =  $this->customer_ad_model->getExportData();

        $getImportFields = array(
            'table' => 'acs_import_fields',
            'select' => '*',
        );
        $importFieldsList = $this->general->get_data_with_param($getImportFields);
        
        $getCompanyImportSettings= array(
            'where' => array(
                'company_id' => logged('company_id'),
                'setting_type' => 'export',
            ),
            'table' => 'customer_settings',
            'select' => '*',
        );
        $importFieldSettings = $this->general->get_data_with_param($getCompanyImportSettings, false);
        $fieldCompanyValues = explode(',', $importFieldSettings->value);

        $fields = array();
        $fieldNames = array();
        foreach($fieldCompanyValues as $field) {
            foreach($importFieldsList as $importSetting) {
                if($field == $importSetting->id) {
                    array_push($fields,$importSetting->field_description);
                    array_push($fieldNames,$importSetting->field_name);
                }
            }
        }
        $delimiter = ",";
        $time      = time();
        $filename  = "customers_list_".$time.".csv";
        $f = fopen('php://memory', 'w');
        fputcsv($f, $fields, $delimiter);

        if (!empty($items)) {
            foreach ($items as $item) {
                $csvData = array();
                foreach($fieldNames as $fieldName){
                    array_push($csvData, $item->$fieldName);
                }
                fputcsv($f, $csvData, $delimiter);
            }
        } else {
            $csvData = array('');
            fputcsv($f, $csvData, $delimiter);
        }

        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '";');
        fpassthru($f);
    }

    public function add_customer_type()
    {
        $insert = array(
            "title" => $this->input->post("customer_type_name"),
            "company_id" => logged("company_id")
        );
        $id = $this->accounting_customers_model->add_new_customer_type($insert);

        echo json_encode([
            'data' => $id,
            'success' => $id ? true : false
        ]);
    }

    public function update_customer_type($typeId)
    {
        $data = array(
            "title" => $this->input->post("customer_type_name"),
            "company_id" => logged("company_id")
        );
        $updated = $this->accounting_customers_model->update_customer_type($typeId, $data);

        echo json_encode([
            'data' => $typeId,
            'success' => $updated > 0 ? true : false
        ]);
    }

    public function delete_customer_type($typeId)
    {
        $deleted = $this->accounting_customers_model->delete_customer_type($typeId);

        echo json_encode([
            'data' => $typeId,
            'success' => $deleted > 0 ? true : false
        ]);
    }

    public function update_estimate_status($estimateId)
    {
        $post = $this->input->post();

        $estimateData = [
            'status' => $post['status'],
            'accepted_date' => date("Y-m-d", strtotime($post['accepted_date']))
        ];

        $update = $this->estimate_model->update($estimateId, $estimateData);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function export_transactions($customerId)
    {
        $this->load->library('PHPXLSXWriter');
        $post = $this->input->post();
        $customer = $this->accounting_customers_model->getCustomerDetails($customerId)[0];
        $order = $post['order'];
        $columnName = $post['column'];
        $type = $post['type'];
        $date = $post['date'];

        $filters = [
            'customer_id' => $customerId,
            'type' => $type,
            'order' => $order
        ];

        if($type !== 'unbilled-income') {
            switch ($date) {
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
                break;
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
        } else {
            $filters['start-date'] = str_replace('-', '/', $date);
        }

        $get = $this->get_transactions($filters);

        $tableHeaders = $get['headers'];
        $transactions = $get['transactions'];

        $excelHead .= "Type: ".ucfirst(str_replace('-', ' ', $type));
        $excelHead .= " · Status: All statuses";
        $excelHead .= " · Delivery method: Any";
        $excelHead .= " · Name: $customer->first_name $customer->last_name";
        $excelHead .= $type !== 'unbilled-income' ? " · Date: ".ucfirst(str_replace("-", " ", $post['date'])) : " · Date: All dates";

        $writer = new XLSXWriter();
        $writer->writeSheetRow('Sheet1', [$excelHead], ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);

        $headers = [];

        foreach($tableHeaders as $header) {
            if(in_array($header, $post['fields'])) {
                $headers[] = $header;
            }
        }

        $writer->markMergedCell('Sheet1', 0, 0, 0, count($headers) - 1);
        $writer->writeSheetRow('Sheet1', $headers, ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);

        foreach($transactions as $transaction) {
            $keys = array_keys($transaction);

            $item = [];
            foreach($tableHeaders as $tableHeader)
            {
                $tableHeader = str_replace('.', '', $tableHeader);
                $tableHeader = str_replace(' ', '_', $tableHeader);
                $tableHeader = strtolower($tableHeader);

                $item[] = $transaction[$tableHeader];
            }

            $writer->writeSheetRow('Sheet1', $item);
        }
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="sales.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }

    public function create_invoice($transactionType, $transactionId)
    {
        $this->page_data['linkedTransac'] = new stdClass();

        switch($transactionType) {
            case 'estimate' :
                $estimate = $this->estimate_model->getEstimate($transactionId);
                $customer = $this->accounting_customers_model->get_by_id($estimate->customer_id);
                $this->page_data['customer'] = $customer;

                switch($estimate->estimate_type) {
                    case 'Standard' :
                        $view = "standard_estimate_modal";
                        $items = $this->estimate_model->getItemlistByID($transactionId);

                        foreach($items as $key => $item) {
                            $items[$key]->cost = $item->costing;
                            $items[$key]->itemDetails = $this->items_model->getItemById($item->items_id)[0];
                            $items[$key]->locations = $this->items_model->getLocationByItemId($item->items_id);
                            $items[$key]->linked_transaction_type = 'estimate';
                            $items[$key]->linked_transaction_id = $transactionId;
                            $items[$key]->linked_transac = $estimate;
                        }

                        $this->page_data['items'] = $items;
                    break;
                    case 'Option' :
                        $view = "options_estimate_modal";
                        $itemsOption1 = $this->estimate_model->getItemlistByIDOption1($transactionId);
                        $estimate->grand_total = ((float)$estimate->option1_total) + ((float)$estimate->option2_total);
        
                        $items = [];
                        $index = 0;
                        foreach($itemsOption1 as $key => $item) {
                            $items[] = $item;
                            $items[$index]->cost = $item->costing;
                            $items[$index]->itemDetails = $this->items_model->getItemById($item->items_id)[0];
                            $items[$index]->locations = $this->items_model->getLocationByItemId($item->items_id);
                            $items[$index]->linked_transaction_type = 'estimate';
                            $items[$index]->linked_transaction_id = $transactionId;
                            $items[$index]->linked_transac = $estimate;
                            $index++;
                        }
        
                        $itemsOption2 = $this->estimate_model->getItemlistByIDOption2($transactionId);
        
                        foreach($itemsOption2 as $key => $item) {
                            $items[] = $item;
                            $items[$index]->cost = $item->costing;
                            $items[$index]->itemDetails = $this->items_model->getItemById($item->items_id)[0];
                            $items[$index]->locations = $this->items_model->getLocationByItemId($item->items_id);
                            $items[$index]->linked_transaction_type = 'estimate';
                            $items[$index]->linked_transaction_id = $transactionId;
                            $items[$index]->linked_transac = $estimate;
                            $index++;
                        }
        
                        $this->page_data['items'] = $items;
                    break;
                    case 'Bundle' :
                        $view = "bundle_estimate_modal";
                        $itemsBundle1 = $this->estimate_model->getItemlistByIDBundle1($transactionId);
                        $estimate->grand_total = ((float)$estimate->bundle1_total) + ((float)$estimate->bundle2_total);
        
                        $items = [];
                        $index = 0;
                        foreach($itemsBundle1 as $key => $item) {
                            $items[] = $item;
                            $items[$index]->cost = $item->costing;
                            $items[$index]->itemDetails = $this->items_model->getItemById($item->items_id)[0];
                            $items[$index]->locations = $this->items_model->getLocationByItemId($item->items_id);
                            $items[$index]->linked_transaction_type = 'estimate';
                            $items[$index]->linked_transaction_id = $transactionId;
                            $items[$index]->linked_transac = $estimate;
                            $index++;
                        }
        
                        $itemsBundle2 = $this->estimate_model->getItemlistByIDBundle2($transactionId);
        
                        foreach($itemsBundle2 as $key => $item) {
                            $items[] = $item;
                            $items[$index]->cost = $item->costing;
                            $items[$index]->itemDetails = $this->items_model->getItemById($item->items_id)[0];
                            $items[$index]->locations = $this->items_model->getLocationByItemId($item->items_id);
                            $items[$index]->linked_transaction_type = 'estimate';
                            $items[$index]->linked_transaction_id = $transactionId;
                            $items[$index]->linked_transac = $estimate;
                            $index++;
                        }

                        $this->page_data['items'] = $items;
                    break;
                }

                $this->page_data['linkedTransac']->type = 'Estimate';
                $this->page_data['linkedTransac']->transaction = $estimate;
            break;
            case 'credit' :
                $delayedCredit = $this->accounting_delayed_credit_model->getDelayedCreditDetails($transactionId);
                $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Delayed Credit', $transactionId);
                $customer = $this->accounting_customers_model->get_by_id($delayedCredit->customer_id);
                $this->page_data['customer'] = $customer;
                $this->page_data['linkedTransac']->type = 'Credit';
                $this->page_data['linkedTransac']->transaction = $delayedCredit;

                $creditItems = [];
                foreach($items as $key => $item) {
                    $creditItem = new stdClass();
                    $creditItem->items_id = $item->items_id;
                    $creditItem->location_id = $item->location_id;
                    $creditItem->qty = '-'.$item->quantity;
                    $creditItem->cost = $item->price;
                    $creditItem->discount = $item->discount;
                    $creditItem->tax = $item->tax;
                    $creditItem->total = '-'.$item->total;
                    if(!in_array($item->item_id, ['0', null, '']) && in_array($item->package_id, ['0', null, ''])) {
                        $creditItem->itemDetails = $this->items_model->getItemById($item->item_id)[0];
                        $creditItem->locations = $this->items_model->getLocationByItemId($item->item_id);
                    } else {
                        $creditItem->packageDetails = $this->items_model->get_package_by_id($item->package_id);
                        $creditItem->packageItems = json_decode($item->package_item_details);
                    }
                    $creditItem->linked_transaction_type = 'delayed_credit';
                    $creditItem->linked_transaction_id = $transactionId;
                    $creditItem->linked_transac = $delayedCredit;
                    $creditItems[] = $creditItem;
                }

                $this->page_data['items'] = $creditItems;
            break;
            case 'charge' :
                $delayedCharge = $this->accounting_delayed_charge_model->getDelayedChargeDetails($transactionId);
                $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Delayed Charge', $transactionId);
                $customer = $this->accounting_customers_model->get_by_id($delayedCharge->customer_id);
                $this->page_data['customer'] = $customer;
                $this->page_data['linkedTransac']->type = 'Charge';
                $this->page_data['linkedTransac']->transaction = $delayedCharge;

                $chargeItems = [];
                foreach($items as $key => $item) {
                    $chargeItem = new stdClass();
                    $chargeItem->items_id = $item->items_id;
                    $chargeItem->location_id = $item->location_id;
                    $chargeItem->qty = $item->quantity;
                    $chargeItem->cost = $item->price;
                    $chargeItem->discount = $item->discount;
                    $chargeItem->tax = $item->tax;
                    $chargeItem->total = $item->total;
                    if(!in_array($item->item_id, ['0', null, '']) && in_array($item->package_id, ['0', null, ''])) {
                        $chargeItem->itemDetails = $this->items_model->getItemById($item->item_id)[0];
                        $chargeItem->locations = $this->items_model->getLocationByItemId($item->item_id);
                    } else {
                        $chargeItem->packageDetails = $this->items_model->get_package_by_id($item->package_id);
                        $chargeItem->packageItems = json_decode($item->package_item_details);
                    }
                    $chargeItem->linked_transaction_type = 'delayed_charge';
                    $chargeItem->linked_transaction_id = $transactionId;
                    $chargeItem->linked_transac = $delayedCharge;
                    $chargeItems[] = $chargeItem;
                }

                $this->page_data['items'] = $chargeItems;
            break;
            case 'billable-expense-charge' :
                $billableExpense = $this->expenses_model->get_vendor_transaction_category_by_id($transactionId);
                switch($billableExpense->transaction_type) {
                    case 'Expense' :
                        $expense = $this->vendors_model->get_expense_by_id($billableExpense->transaction_id, logged('company_id'));
                        $billableExpense->date = date("m/d/Y", strtotime($expense->payment_date));
                    break;
                    case 'Check' :
                        $check = $this->vendors_model->get_check_by_id($billableExpense->transaction_id, logged('company_id'));
                        $billableExpense->date = date("m/d/Y", strtotime($check->payment_date));
                    break;
                    case 'Bill' :
                        $bill = $this->vendors_model->get_bill_by_id($billableExpense->transaction_id, logged('company_id'));
                        $billableExpense->date = date("m/d/Y", strtotime($bill->bill_date));
                    break;
                    case 'Vendor Credit' :
                        $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                        $billableExpense->date = date("m/d/Y", strtotime($vendorCredit->payment_date));
                    break;
                    case 'Credit Card Credit' :
                        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($billableExpense->transaction_id, logged('company_id'));
                        $billableExpense->date = date("m/d/Y", strtotime($ccCredit->payment_date));
                    break;
                }

                $items = [];
                $item = new stdClass();
                $item->qty = 1;
                $item->cost = $billableExpense->amount;
                $item->tax = $billableExpense->tax;
                $item->total = $billableExpense->amount;
                $item->linked_transaction_type = 'billable_expense';
                $item->linked_transaction_id = $transactionId;
                $item->linked_transac = $billableExpense;
                $item->itemDetails = new stdClass();
                $items[] = $item;

                if(floatval($billableExpense->markup_percentage) > 0.00) {
                    $amount = floatval($billableExpense->amount) / 100;

                    $item = new stdClass();
                    $item->qty = 1;
                    $item->cost = $amount;
                    $item->tax = 0;
                    $item->total = $amount;
                    $item->linked_transaction_type = 'billable_expense';
                    $item->linked_transaction_id = $transactionId;
                    $item->linked_transac = $billableExpense;
                    $item->itemDetails = new stdClass();
                    $items[] = $item;
                }

                $customer = $this->accounting_customers_model->get_by_id($billableExpense->customer_id);
                $this->page_data['customer'] = $customer;
                $this->page_data['linkedTransac']->type = 'Billexp Charge';
                $this->page_data['linkedTransac']->transaction = $billableExpense;
                $this->page_data['items'] = $items;
            break;
            case 'time-charge' :
                $timeCharge = $this->accounting_single_time_activity_model->get_by_id($transactionId);
                $price = floatval(str_replace(',', '', $timeCharge->hourly_rate));

                $hours = substr($timeCharge->time, 0, -3);
                $time = explode(':', $hours);
                $hr = $time[0] + ($time[1] / 60);

                $total = $hr * $price;

                $items = [];
                $item = new stdClass();
                $item->qty = $hr;
                $item->cost = $timeCharge->hourly_rate;
                $item->tax = $timeCharge->taxable;
                $item->total = $total;
                $item->linked_transaction_type = 'time_charge';
                $item->linked_transaction_id = $transactionId;
                $item->linked_transac = $timeCharge;
                $item->itemDetails = $this->items_model->getItemById($timeCharge->service_id)[0];
                $items[] = $item;

                $customer = $this->accounting_customers_model->get_by_id($timeCharge->customer_id);
                $this->page_data['customer'] = $customer;
                $this->page_data['linkedTransac']->type = 'Time Charge';
                $this->page_data['linkedTransac']->transaction = $timeCharge;
                $this->page_data['items'] = $items;
            break;
        }

        $invoiceSettings = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        $this->page_data['invoice_prefix'] = $invoiceSettings->invoice_num_prefix;
        $this->page_data['number'] = $this->invoice_model->get_last_invoice_number(logged('company_id'), $invoiceSettings->invoice_num_prefix);

        $this->load->view("v2/includes/accounting/modal_forms/invoice_modal", $this->page_data);
    }

    public function print_transaction($transactionType, $transactionId)
    {
        $this->load->helper('string');
        $this->load->library('pdf');

        $extension = '.pdf';

        switch($transactionType) {
            case 'sales-receipt' :
                $view = "accounting/modals/print_action/print_sales_receipt";

                do {
                    $randomString = random_string('alnum');
                    $fileName = 'print_sales_receipt_'.$randomString . '.' .$extension;
                    $exists = file_exists('./assets/pdf/'.$fileName);
                } while ($exists);
        
                $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($salesReceiptId);
                $receiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Sales Receipt', $salesReceiptId);
        
                foreach($receiptItems as $key => $receiptItem) {
                    $subtotal = floatval($receiptItem->price) * floatval($receiptItem->quantity);
                    $taxAmount = floatval($receiptItem->tax) * floatval($subtotal);
                    $taxAmount = floatval($taxAmount) / 100;
        
                    $receiptItems[$key]->item = $this->items_model->getItemById($receiptItem->item_id)[0];
                    $receiptItems[$key]->tax_amount = number_format(floatval($taxAmount), 2, '.', ',');
                }
        
                $pdfData = [
                    'salesReceipt' => $salesReceipt,
                    'receiptItems' => $receiptItems
                ];
            break;
            case 'refund-receipt' :
                $view = "accounting/modals/print_action/print_refund_receipt";

                do {
                    $randomString = random_string('alnum');
                    $fileName = 'print_refund_receipt_'.$randomString . '.' .$extension;
                    $exists = file_exists('./assets/pdf/'.$fileName);
                } while ($exists);

                $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($transactionId);
                $receiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Refund Receipt', $transactionId);
                $paymentMethod = $this->accounting_payment_methods_model->getById($refundReceipt->payment_method);

                foreach($receiptItems as $key => $receiptItem) {
                    $subtotal = floatval($receiptItem->price) * floatval($receiptItem->quantity);
                    $taxAmount = floatval($receiptItem->tax) * floatval($subtotal);
                    $taxAmount = floatval($taxAmount) / 100;
        
                    $receiptItems[$key]->item = $this->items_model->getItemById($receiptItem->item_id)[0];
                    $receiptItems[$key]->tax_amount = number_format(floatval($taxAmount), 2, '.', ',');
                }

                $fileName = 'Refund_Receipt_'.$refundReceipt->ref_no.'_from_'.str_replace(' ', '_', $company->business_name).'.pdf';

                $pdfData = [
                    'paymentMethod' => $paymentMethod,
                    'refundReceipt' => $refundReceipt,
                    'receiptItems' => $receiptItems
                ];
            break;
            case 'credit-memo' :
                $view = "accounting/modals/print_action/print_credit_memo";

                do {
                    $randomString = random_string('alnum');
                    $fileName = 'print_credit_memo_'.$randomString . '.' .$extension;
                    $exists = file_exists('./assets/pdf/'.$fileName);
                } while ($exists);

                $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($transactionId);
                $memoItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Credit Memo', $transactionId);

                foreach($memoItems as $key => $creditMemoItem) {
                    $subtotal = floatval($creditMemoItem->price) * floatval($creditMemoItem->quantity);
                    $taxAmount = floatval($creditMemoItem->tax) * floatval($subtotal);
                    $taxAmount = floatval($taxAmount) / 100;

                    $memoItems[$key]->item = $this->items_model->getItemById($creditMemoItem->item_id)[0];
                    $memoItems[$key]->tax_amount = number_format(floatval($taxAmount), 2, '.', ',');
                }

                $fileName = 'Credit_Memo_'.$creditMemo->ref_no.'_from_'.str_replace(' ', '_', $company->business_name).'.pdf';

                $pdfData = [
                    'creditMemo' => $creditMemo,
                    'memoItems' => $memoItems
                ];
            break;
        }

        $this->pdf->save_pdf($view, $pdfData, $fileName, 'portrait');

        $pdf = file_get_contents(base_url("/assets/pdf/$fileName"));

        if (file_exists(getcwd()."/assets/pdf/$fileName")) {
            unlink(getcwd()."/assets/pdf/$fileName");
        }
        // Header content type
        header("Content-type: application/pdf");
        header('Content-Disposition: inline; filename="print.pdf";');

        ob_clean();
        flush();
        echo $pdf;
        exit;
    }

    public function send_transaction($transactionType, $transactionId)
    {
        $this->load->library('pdf');
        $this->load->library('email');
        $post = $this->input->post();

        $company = $this->business_model->getByCompanyId(logged('company_id'));

        switch($transactionType) {
            case 'sales-receipt' :
                $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($transactionId);
                $receiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Sales Receipt', $transactionId);
                $fileName = 'Sales_Receipt_'.$salesReceipt->ref_no.'_from_'.str_replace(' ', '_', $company->business_name).'.pdf';

                foreach($receiptItems as $key => $receiptItem) {
                    $subtotal = floatval($receiptItem->price) * floatval($receiptItem->quantity);
                    $taxAmount = floatval($receiptItem->tax) * floatval($subtotal);
                    $taxAmount = floatval($taxAmount) / 100;
        
                    $receiptItems[$key]->item = $this->items_model->getItemById($receiptItem->item_id)[0];
                    $receiptItems[$key]->tax_amount = number_format(floatval($taxAmount), 2, '.', ',');
                }

                $view = "accounting/modals/print_action/print_sales_receipt";

                $pdfData = [
                    'salesReceipt' => $salesReceipt,
                    'receiptItems' => $receiptItems
                ];
            break;
            case 'refund-receipt' :
                $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($transactionId);
                $receiptItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Refund Receipt', $transactionId);
                $paymentMethod = $this->accounting_payment_methods_model->getById($refundReceipt->payment_method);

                foreach($receiptItems as $key => $receiptItem) {
                    $subtotal = floatval($receiptItem->price) * floatval($receiptItem->quantity);
                    $taxAmount = floatval($receiptItem->tax) * floatval($subtotal);
                    $taxAmount = floatval($taxAmount) / 100;
        
                    $receiptItems[$key]->item = $this->items_model->getItemById($receiptItem->item_id)[0];
                    $receiptItems[$key]->tax_amount = number_format(floatval($taxAmount), 2, '.', ',');
                }

                $fileName = 'Refund_Receipt_'.$refundReceipt->ref_no.'_from_'.str_replace(' ', '_', $company->business_name).'.pdf';
                $view = "accounting/modals/print_action/print_refund_receipt";

                $pdfData = [
                    'paymentMethod' => $paymentMethod,
                    'refundReceipt' => $refundReceipt,
                    'receiptItems' => $receiptItems
                ];
            break;
            case 'credit-memo' :
                $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($transactionId);
                $memoItems = $this->accounting_credit_memo_model->get_customer_transaction_items('Credit Memo', $transactionId);

                foreach($memoItems as $key => $creditMemoItem) {
                    $subtotal = floatval($creditMemoItem->price) * floatval($creditMemoItem->quantity);
                    $taxAmount = floatval($creditMemoItem->tax) * floatval($subtotal);
                    $taxAmount = floatval($taxAmount) / 100;

                    $memoItems[$key]->item = $this->items_model->getItemById($creditMemoItem->item_id)[0];
                    $memoItems[$key]->tax_amount = number_format(floatval($taxAmount), 2, '.', ',');
                }

                $fileName = 'Credit_Memo_'.$creditMemo->ref_no.'_from_'.str_replace(' ', '_', $company->business_name).'.pdf';
                $view = "accounting/modals/print_action/print_credit_memo";

                $pdfData = [
                    'creditMemo' => $creditMemo,
                    'memoItems' => $memoItems
                ];
            break;
            case 'invoice' :
                $invoice = $this->accounting_invoices_model->get_invoice_by_invoice_id($transactionId);
                $customer = $this->accounting_customers_model->getCustomerDetails($invoice->customer_id)[0];
                $invoiceItems = $this->invoice_model->get_invoice_items($explode[1]);
                $invoiceSettings = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

                $discount = floatval($invoice->grand_total) - floatval($invoice->sub_total);
                $discount += floatval($invoice->taxes);
                $discount += floatval($invoice->adjustment_value);

                $invoice->discount_total = $discount;

                foreach($invoiceItems as $key => $invoiceItem) {
                    $invoiceItems[$key]->item = $this->items_model->getItemById($invoiceItem->items_id)[0];

                    $taxAmount = floatval($invoiceItem->tax) * floatval($invoiceItem->total);
                    $taxAmount = floatval($taxAmount) / 100;
                    $invoiceItems[$key]->tax_amount = number_format(floatval($taxAmount), 2, '.', ',');
                }

                $fileName = 'Invoice_'.$invoice->invoice_number.'_from_'.str_replace(' ', '_', $company->business_name).'.pdf';
                $view = "accounting/modals/print_action/print_invoice";

                $pdfData = [
                    'invoice_prefix' => $invoiceSettings->invoice_num_prefix,
                    'invoice' => $invoice,
                    'invoiceItems' => $invoiceItems
                ];
            break;
            case 'estimate' :
                $this->load->helper('pdf_helper');

                $estimate = $this->estimate_model->getById($transactionId);
                $company_id = $estimate->company_id;
                $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
                $client   = $this->Clients_model->getById($company_id);
                $estimateItems = $this->estimate_model->getEstimatesItems($transactionId);
                $fileName = 'Estimate_'.$estimate->estimate_number.'_from_'.str_replace(' ', '_', $company->business_name).'.pdf';

                $html = '
                    <table style="padding-top:-40px;">
                        <tr>
                            <td>
                                <h5 style="font-size:12px;"><span class="fa fa-user-o"></span> From <br/><span>'.$client->business_name.'</span></h5>
                                <br />
                                <span class="">'.$client->business_address.'</span><br />
                                <span class="">EMAIL: '.$client->email_address.'</span><br />
                                <span class="">PHONE: '.$client->phone_number.'</span>
                                <br/><br /><br />
                                <h5 style="font-size:12px;"><span class="fa fa-user-o"></span> To <br/><span>'.$customer->first_name . ' ' .$customer->last_name.'</span></h5>
                                <br />
                                <span class="">'.$customer->mail_add. " " .$customer->city.'</span><br />
                                <span class="">EMAIL: '.$customer->email.'</span><br />
                                <span class="">PHONE: '.$customer->phone_w.'</span>
                            </td>
                            <td colspan=1></td>
                            <td style="text-align:right;">
                                <h5 style="font-size:20px;margin:0px;">ESTIMATE <br /><small style="font-size: 10px;">#'.$estimate->estimate_number.'</small></h5>
                                <br />
                                <table>
                                <tr>
                                    <td>Estimate Date :</td>
                                    <td>'.date("F d, Y", strtotime($estimate->estimate_date)).'</td>
                                </tr>
                                <tr>
                                    <td>Expire Due :</td>
                                    <td>'.date("F d, Y", strtotime($estimate->expiry_date)).'</td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <br /><br /><br />

                    <table style="width="100%;>
                    <thead>
                        <tr>
                            <th style="width:5%;"><b>#</b></th>
                            <th style="width:35%;"><b>Items</b></th>
                            <th style="width:12%;"><b>Item Type</b></th>
                            <th style="width:12%;text-align: right;"><b>Qty</b></th>
                            <th style="width:12%;text-align: right;"><b>Price</b></th>
                            <th style="width:12%;text-align: right;"><b>Discount</b></th>
                            <th style="width:12%;text-align: right;"><b>Total</b></th>
                        </tr>
                    </thead>
                    <tbody>';
                    $total_amount = 0;
                    $total_tax = 0;
                    $row = 1;
                    foreach ($estimateItems as $item) {
                        $html .= '<tr>
                            <td valign="top" style="width:5%;">'.$row.'</td>
                            <td valign="top" style="width:35%;">'.$item->title.'</td>
                            <td valign="top" style="width:12%;">'.$item->type.'</td>
                            <td valign="top" style="width:12%;text-align: right;">'.$item->qty.'</td>
                            <td valign="top" style="width:12%;text-align: right;">'.number_format($item->iCost, 2).'</td>
                            <td valign="top" style="width:12%;text-align: right;">'.number_format($item->discount, 2).'</td>
                            <td valign="top" style="width:12%;text-align: right;">'.number_format($item->iTotal, 2).'</td>
                        </tr>
                        ';
                        $row++;
                        $total_amount += $item->iTotal;
                    }

                    $html .= '
                    <tr><br><br>
                    <td colspan="6" style="text-align: right;"><b>Subtotal</b></td>
                    <td style="text-align: right;"><b>$'.number_format($estimate->sub_total, 2).'</b></td>
                    </tr>
                    <tr>
                    <td colspan="6" style="text-align: right;"><b>Taxes</b></td>
                    <td style="text-align: right;"><b>$'.number_format($estimate->tax1_total, 2).'</b></td>
                    </tr>
                    <tr>
                    <td colspan="6" style="text-align: right;"><b>'.$estimate->adjustment_name.'</b></td>
                    <td style="text-align: right;"><b>$'.number_format($estimate->adjustment_value, 2).'</b></td>
                    </tr>
                    <tr>
                    <td colspan="6" style="text-align: right;"><b>Grand Total</b></td>
                    <td style="text-align: right;"><b>$'.number_format($total_amount, 2).'</b></td>
                    </tr>
                </tbody>
                </table>
                <br /><br /><br />
                <p><b>Instructions</b><br /><br />'.$estimate->instructions.'</p>
                <p><b>Message</b><br /><br />'.$estimate->customer_message.'</p>
                <p><b>Terms</b><br /><Br />'.$estimate->terms_conditions.'</p>
                ';

                tcpdf();
                $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $title = "Estimates";
                $obj_pdf->SetTitle($title);
                $obj_pdf->setPrintHeader(false);
                $obj_pdf->setPrintFooter(false);
                $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $obj_pdf->SetDefaultMonospacedFont('helvetica');
                $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $obj_pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
                $obj_pdf->SetFont('helvetica', '', 9);
                $obj_pdf->setFontSubsetting(false);
                $obj_pdf->AddPage();
                ob_end_clean();
                $obj_pdf->writeHTML($html, true, false, true, false, '');
                $obj_pdf->Output(getcwd()."/assets/pdf/$fileName", 'F');
            break;
        }

        if($transactionType !== 'estimate') {
            $this->pdf->save_pdf($view, $pdfData, $fileName, 'portrait');
        }

        $this->email->clear(true);
        $this->email->from('nsmartrac@gmail.com');
        $this->email->to($post['email_to']);
        $this->email->subject($post['email_subject']);
        $this->email->message($post['email_message']);
        $this->email->attach(base_url("/assets/pdf/$fileName"));

        $this->email->send();

        unlink(getcwd()."/assets/pdf/$fileName");

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_multi_customers_status()
    {
        $is_success = 0;
        $prof_ids = $this->input->post('customer_prof_ids');
        if($prof_ids) {
            foreach($prof_ids as $prof_id)
            {
                $updated = $this->AcsProfile_model->update_customer_status($prof_id);   
            }
                         
        } else {
            echo json_encode([
                'success' => 0
            ]);
            exit;
        }

        echo json_encode([
            'success' => $updated > 0 ? 1 : 0
        ]);        
    }
}