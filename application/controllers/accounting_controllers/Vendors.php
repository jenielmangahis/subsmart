<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendors extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');
        $this->load->model('account_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('chart_of_accounts_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('expenses_model');
        $this->load->model('items_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('tags_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('accounting_assigned_checks_model');

        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');

        $this->page_data['page']->title = 'Vendors';
        $this->page_data['page']->parent = 'Expenses';

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
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/expenses/vendors/list.js"
        ));

        $paymentsFilter = [
            'start-date' => date("Y-m-d", strtotime("-30 days")),
            'company_id' => logged('company_id')
        ];

        $openBills = $this->expenses_model->get_open_bills(['bill-date-start' => date("Y-m-d", strtotime("-365 days"))]);
        $overdueBills = $this->expenses_model->get_overdue_bills(['bill-date-start' => date("Y-m-d", strtotime("-365 days"))]);
        $openPurchaseOrders = $this->expenses_model->get_unbilled_purchase_orders(['start-date' => date("Y-m-d", strtotime("-365 days"))]);
        $billPayments = $this->expenses_model->get_company_bill_payment_items($paymentsFilter);
        $expenses = $this->expenses_model->get_company_expense_transactions($paymentsFilter);
        $checks = $this->expenses_model->get_company_check_transactions($paymentsFilter);
        $creditCardPayments = $this->expenses_model->get_company_cc_payment_transactions($paymentsFilter);

        $status = [
            1
        ];

        if (!empty(get('status') && get('status') === 'all') ) {
            array_push($status, 0);
        }

        if (empty(get('transaction'))) {
            $vendors = $this->vendors_model->getAllByCompany($status);
        } else {
            switch (get('transaction')) {
                case 'purchase-orders':
                    $vendors = $this->vendors_model->get_vendors_with_unbilled_po($status);
                break;
                case 'open-bills':
                    $vendors = $this->vendors_model->get_vendors_with_open_bills($status);
                break;
                case 'overdue-bills':
                    $vendors = $this->vendors_model->get_vendors_with_overdue_bills($status);
                break;
                case 'payments':
                    $vendors = $this->vendors_model->get_vendors_with_payments($status);
                break;
            }
        }

        $search = get('search');
        if(!empty($search)) {
            $vendors = array_filter($vendors, function($vendor, $key) use ($search) {
                return (stripos($vendor->display_name, $search) !== false);
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($vendors, function($a, $b) {
            return strcasecmp($a->display_name, $b->display_name);
        });

        if(!empty(get('search'))) {
            $this->page_data['search'] = get('search');
        }
        if(!empty(get('status'))) {
            $this->page_data['status'] = get('status');
        }
        if(!empty(get('transaction'))) {
            $this->page_data['transaction'] = get('transaction');
        }
        $this->page_data['paidTransactions'] = count($billPayments) + count($expenses) + count($checks) + count($creditCardPayments);
        $this->page_data['purchaseOrders'] = count($openPurchaseOrders);
        $this->page_data['openBills'] = count($openBills);
        $this->page_data['overdueBills'] = count($overdueBills);
        $this->page_data['terms'] = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));
        $this->page_data['expenseAccs'] = $this->chart_of_accounts_model->get_expense_accounts();
        $this->page_data['otherExpenseAccs'] = $this->chart_of_accounts_model->get_other_expense_accounts();
        $this->page_data['cogsAccs'] = $this->chart_of_accounts_model->get_cogs_accounts();
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['vendors'] = $vendors;
        $this->page_data['page_title'] = "Vendors";
        $this->load->view('v2/pages/accounting/expenses/vendors/list', $this->page_data);
    }

    public function load_vendors()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $search = $post['columns'][0]['search']['value'];
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];

        $status = [
            1
        ];

        if ($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        if (!isset($post['transaction'])) {
            $vendors = $this->vendors_model->getAllByCompany($status);
        } else {
            switch ($post['transaction']) {
                case 'purchase-orders':
                    $vendors = $this->vendors_model->get_vendors_with_unbilled_po($status);
                break;
                case 'open-bills':
                    $vendors = $this->vendors_model->get_vendors_with_open_bills($status);
                break;
                case 'overdue-bills':
                    $vendors = $this->vendors_model->get_vendors_with_overdue_bills($status);
                break;
                case 'payments':
                    $vendors = $this->vendors_model->get_vendors_with_payments($status);
                break;
            }
        }

        $data = [];

        foreach ($vendors as $vendor) {
            if (!is_null($vendor->attachments) && $vendor->attachments !== "") {
                $attachmentIds = json_decode($vendor->attachments, true);
                $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
            } else {
                $attachments = [];
            }

            if ($search !== "") {
                if (stripos($vendor->display_name, $search) !== false) {
                    $data[] = [
                        'id' => $vendor->id,
                        'name' => $vendor->display_name,
                        'company_name' => $vendor->company,
                        'address' => "$vendor->street<br>$vendor->city $vendor->state $vendor->zip",
                        'phone' => $vendor->phone,
                        'email' => $vendor->email,
                        'attachments' => $attachments,
                        'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',')
                    ];
                }
            } else {
                $data[] = [
                    'id' => $vendor->id,
                    'name' => $vendor->display_name,
                    'company_name' => $vendor->company,
                    'address' => "$vendor->street<br>$vendor->city $vendor->state $vendor->zip",
                    'phone' => $vendor->phone,
                    'email' => $vendor->email,
                    'attachments' => $attachments,
                    'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',')
                ];
            }
        }

        usort($data, function ($a, $b) use ($order, $columnName) {
            if ($order === 'asc') {
                return strcmp($a[$columnName], $b[$columnName]);
            } else {
                return strcmp($b[$columnName], $a[$columnName]);
            }
        });

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($vendors),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function add()
    {
        $new_data = array(
            'company_id' =>logged('company_id'),
            'title' => $this->input->post('title'),
            'f_name' => $this->input->post('f_name'),
            'm_name' => $this->input->post('m_name'),
            'l_name' => $this->input->post('l_name'),
            'suffix' => $this->input->post('suffix'),
            'email' => $this->input->post('email'),
            'company' => $this->input->post('company'),
            'display_name' => $this->input->post('display_name'),
            'to_display' => $this->input->post('use_display_name'),
            'print_on_check_name' => $this->input->post('use_display_name') === "1" ? $this->input->post('display_name') : $this->input->post('print_on_check_name'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'website' => $this->input->post('website'),
            'billing_rate' => $this->input->post('billing_rate'),
            'terms' => $this->input->post('terms'),
            'opening_balance' => $this->input->post('opening_balance'),
            'opening_balance_as_of_date' => date("Y-m-d", strtotime($this->input->post('opening_balance_as_of_date'))),
            'account_number' => $this->input->post('account_number'),
            'tax_id' => $this->input->post('tax_id'),
            'default_expense_account' => $this->input->post('default_expense_account'),
            'notes' => $this->input->post('notes'),
            'status' => 1,
            'created_by' => logged('id')
        );

        $addQuery = $this->vendors_model->createVendor($new_data);

        if ($addQuery > 0) {
            $attachments = $this->input->post('attachments');
            if (isset($attachments) && is_array($attachments)) {
                $order = 1;
                foreach ($attachments as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Vendor',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $vendorId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $this->session->set_flashdata('success', "New vendor successfully added!");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect("accounting/vendors");
    }

    public function view($vendorId)
    {
        add_footer_js(array(
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/expenses/vendors/view.js"
        ));

        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);

        $bills = $this->expenses_model->get_vendor_open_bills($vendorId);
        $credits = $this->expenses_model->get_vendor_unapplied_vendor_credits($vendorId);

        $openBal = 0.00;
        $overdueBal = 0.00;
        foreach ($bills as $bill) {
            $openBal += floatval($bill->remaining_balance);

            if (strtotime($bill->due_date) < strtotime(date("m/d/Y"))) {
                $overdueBal += floatval($bill->remaining_balance);
            }
        }

        foreach ($credits as $credit) {
            $openBal -= floatval($credit->remaining_balance);
        }

        $not = ['', null];
        $vendorAddress = '';
        $vendorAddress .= in_array($vendor->street, $not) ? "" : $vendor->street;
        if (!in_array($vendor->city, $not)) {
            if ($vendorAddress !== '') {
                $vendorAddress .= ', ';
            }
            $vendorAddress .= $vendor->city;
        }

        if (!in_array($vendor->state, $not)) {
            if ($vendorAddress !== '') {
                $vendorAddress .= ', ';
            }
            $vendorAddress .= $vendor->state;
        }

        if (!in_array($vendor->zip, $not)) {
            if ($vendorAddress !== '') {
                $vendorAddress .= ' ';
            }
            $vendorAddress .= $vendor->zip;
        }

        if (!in_array($vendor->country, $not)) {
            if ($vendorAddress !== '') {
                $vendorAddress .= ' ';
            }
            $vendorAddress .= $vendor->country;
        }

        $filters = [
            'type' => !empty(get('type')) ? get('type') : 'all',
            'order' => 'desc'
        ];

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
        }

        if(!empty(get('type'))) {
            $this->page_data['type'] = get('type');
        }
        if(!empty(get('date'))) {
            $this->page_data['date'] = get('date');
        }

        $attachments = $this->accounting_attachments_model->get_attachments('Vendor', $vendorId);
        $this->page_data['transactions'] = $this->get_transactions($vendorId, $filters);
        $this->page_data['openBalance'] = $openBal;
        $this->page_data['overdueBalance'] = $overdueBal;
        $this->page_data['vendorAddress'] = $vendorAddress;
        $this->page_data['terms'] = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));
        $this->page_data['expenseAccs'] = $this->chart_of_accounts_model->get_expense_accounts();
        $this->page_data['otherExpenseAccs'] = $this->chart_of_accounts_model->get_other_expense_accounts();
        $this->page_data['cogsAccs'] = $this->chart_of_accounts_model->get_cogs_accounts();
        $this->page_data['categoryAccs'] = $this->get_category_accs();
        $this->page_data['vendorDetails'] = $vendor;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['attachments'] = $attachments;
        $this->page_data['page_title'] = "Vendors";
        $this->load->view('v2/pages/accounting/expenses/vendors/view', $this->page_data);
    }

    public function make_inactive()
    {
        $vendors = $this->input->post('vendors');

        if (count($vendors) === 1) {
            $vendor = $this->vendors_model->get_vendor_by_id($vendors[0]);
        }

        $data = [];
        foreach ($vendors as $vendorId) {
            $data[] = [
                'id' => $vendorId,
                'status' => 0
            ];
        }

        $update = $this->vendors_model->update_multiple_vendor_by_id($data);

        if ($update) {
            if (count($vendors) === 1) {
                $this->session->set_flashdata('success', "<b>$vendor->display_name</b> has been successfully set to inactive!");
            } else {
                $this->session->set_flashdata('success', "$update vendor/s has been successfully set to inactive!");
            }
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }
    }

    public function delete_selected()
    {
        $msg = '';
        $is_success = 0;

        $vendors = $this->input->post('vendors');
        $total_deleted = 0;
        
        $data = [];
        foreach ($vendors as $vendorId) {
            $this->vendors_model->delete($vendorId);
            $total_deleted++;
        }

        if( $total_deleted > 0 ){
            $msg = '';
            $is_success = 1;
        }else{
            $msg = 'Vendor data not found';
        }

        $data = ['msg' => $msg, 'is_success' => $is_success, 'total_deleted' => $total_deleted];
		echo json_encode($data);
    }

    public function make_active()
    {
        $vendors = $this->input->post('vendors');

        if (count($vendors) === 1) {
            $vendor = $this->vendors_model->get_vendor_by_id($vendors[0]);
        }

        $data = [];
        foreach ($vendors as $vendorId) {
            $data[] = [
                'id' => $vendorId,
                'status' => 1
            ];
        }

        $update = $this->vendors_model->update_multiple_vendor_by_id($data);

        if ($update) {
            if (count($vendors) === 1) {
                $this->session->set_flashdata('success', "<b>$vendor->display_name</b> has been successfully set to active!");
            } else {
                $this->session->set_flashdata('success', "$update vendor/s has been successfully set to active!");
            }
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }
    }

    public function edit($vendorId)
    {
        $this->page_data['vendorDetails'] = $this->vendors_model->get_vendor_by_id($vendorId);
        $this->page_data['attachments'] = $this->accounting_attachments_model->get_attachments('Vendor', $vendorId);
        $this->load->view('v2/includes/accounting/modal_forms/vendor_modal', $this->page_data);
    }

    public function update($vendorId)
    {
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);
        $data = array(
            'title' => $this->input->post('title'),
            'f_name' => $this->input->post('f_name'),
            'm_name' => $this->input->post('m_name'),
            'l_name' => $this->input->post('l_name'),
            'suffix' => $this->input->post('suffix'),
            'email' => $this->input->post('email'),
            'company' => $this->input->post('company'),
            'display_name' => $this->input->post('display_name'),
            'to_display' => $this->input->post('use_display_name'),
            'print_on_check_name' => $this->input->post('use_display_name') === "1" ? $this->input->post('display_name') : $this->input->post('print_on_check_name'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'website' => $this->input->post('website'),
            'billing_rate' => $this->input->post('billing_rate') !== "" ? $this->input->post('billing_rate') : null,
            'terms' => $this->input->post('terms'),
            'account_number' => $this->input->post('account_number') !== "" ? $this->input->post('account_number') : null,
            'tax_id' => $this->input->post('tax_id'),
            'default_expense_account' => $this->input->post('default_expense_account'),
            'notes' => $this->input->post('notes'),
        );

        $update = $this->vendors_model->updateVendor($vendorId, $data);

        if ($update) {
            $attachments = $this->accounting_attachments_model->get_attachments('Vendor', $vendorId);
            $attached = $this->input->post('attachments');

            if(count($attachments) > 0) {
                foreach($attachments as $attachment) {
                    if(is_null($attached) || !in_array($attachment->id, $attached)) {
                        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Vendor', 'attachment_id' => $attachment->id, 'linked_id' => $vendorId]);
                        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);
                    }
                }
            }

            if (!is_null($attached) && is_array($attached)) {
                $order = 1;
                foreach ($attached as $attachmentId) {
                    $link = array_filter($attachments, function($v, $k) use ($attachmentId) {
                        return $v->id === $attachmentId;
                    }, ARRAY_FILTER_USE_BOTH);

                    if(count($link) > 0) {
                        $attachmentData = [
                            'type' => 'Vendor',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $vendorId,
                            'order_no' => $order
                        ];

                        $updateOrder = $this->accounting_attachments_model->update_order($attachmentData);
                    } else {
                        $linkAttachmentData = [
                            'type' => 'Vendor',
                            'attachment_id' => $attachmentId,
                            'linked_id' => $vendorId,
                            'order_no' => $order
                        ];
    
                        $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);
                    }

                    $order++;
                }
            }

            $this->session->set_flashdata('success', "Vendor updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect("accounting/vendors/view/$vendorId");
    }

    public function update_attachments($vendorId)
    {
        $files = $_FILES['file'];

        if (count($files['name']) > 0) {
            $insert = $this->uploadFile($files);

            $attachments = $this->accounting_attachments_model->get_attachments('Vendor', $vendorId);
            $order = count($attachments);
            foreach($insert as $attachmentId) {
                $linkAttachmentData = [
                    'type' => 'Vendor',
                    'attachment_id' => $attachmentId,
                    'linked_id' => $vendorId,
                    'order_no' => $order
                ];

                $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                $order++;
            }

            $return = new stdClass();
            $return->attachment_ids = $insert;
            echo json_encode($return);
        } else {
            echo json_encode('error');
        }
    }

    public function remove_attachment($vendorId)
    {
        $attachmentId = $this->input->post('attachment_id');
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);

        $attachmentLink = $this->accounting_attachments_model->get_attachment_link(['type' => 'Vendor', 'attachment_id' => $attachmentId, 'linked_id' => $vendorId]);
        $this->accounting_attachments_model->unlink_attachment($attachmentLink->id);

        $return = [
            'data' => $vendorId,
            'success' => $update
        ];

        echo json_encode($return);
    }

    private function uploadFile($files)
    {
        $this->load->helper('string');

        $company_id = getLoggedCompanyID();
        $target_dir = './uploads/accounting/attachments/'.$company_id.'/';

        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $data = [];
        foreach ($files['name'] as $key => $name) {
            $extension = end(explode('.', $name));

            do {
                $randomString = random_string('alnum');
                $fileNameToStore = $randomString . '.' .$extension;
                $exists = file_exists('./uploads/accounting/attachments/'.$company_id.'/'.$fileNameToStore);
            } while ($exists);

            $fileType = explode('/', $files['type'][$key]);
            $uploadedName = str_replace('.'.$extension, '', $name);

            $data[] = [
                'company_id' => $company_id,
                'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
                'uploaded_name' => $uploadedName,
                'stored_name' => $fileNameToStore,
                'file_extension' => $extension,
                'size' => $files['size'][$key],
                'notes' => null,
                'status' => 1
            ];

            move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$company_id.'/'.$fileNameToStore);
        }

        $attachmentIds = [];
        foreach ($data as $attachment) {
            $attachmentIds[] = $this->accounting_attachments_model->create($attachment);
        }

        return $attachmentIds;
    }

    // public function get_vendor_transactions($vendorId)
    // {
    //     $post = json_decode(file_get_contents('php://input'), true);
    //     $order = $post['order'][0]['dir'];
    //     $orderColumn = $post['order'][0]['column'];
    //     $columnName = $post['columns'][$orderColumn]['name'];
    //     $start = $post['start'];
    //     $limit = $post['length'];
    //     $type = $post['type'];
    //     $date = $post['date'];

    //     $filters = [
    //         'type' => $type,
    //         'order' => $order
    //     ];

    //     switch ($date) {
    //         case 'today':
    //             $filters['start-date'] = date("Y-m-d");
    //             $filters['end-date'] = date("Y-m-d");
    //         break;
    //         case 'yesterday':
    //             $filters['start-date'] = date("Y-m-d", strtotime(date("m/d/Y").' -1 day'));
    //             $filters['end-date'] = date("Y-m-d", strtotime(date("m/d/Y").' -1 day'));
    //         break;
    //         case 'this-week':
    //             $filters['start-date'] = date("Y-m-d", strtotime("this week -1 day"));
    //             $filters['end-date'] = date("Y-m-d", strtotime("sunday -1 day"));
    //         break;
    //         case 'this-month':
    //             $filters['start-date'] = date("Y-m-01");
    //             $filters['end-date'] = date("Y-m-t");
    //             // no break
    //         case 'this-quarter':
    //             $quarters = [
    //                 1 => [
    //                     'start' => date("01/01/Y"),
    //                     'end' => date("03/t/Y")
    //                 ],
    //                 2 => [
    //                     'start' => date("04/01/Y"),
    //                     'end' => date("06/t/Y")
    //                 ],
    //                 3 => [
    //                     'start' => date("07/01/Y"),
    //                     'end' => date("09/t/Y")
    //                 ],
    //                 4 => [
    //                     'start' => date("10/01/Y"),
    //                     'end' => date("12/t/Y")
    //                 ]
    //             ];
    //             $month = date('n');
    //             $quarter = ceil($month / 3);
                
    //             $filters['start-date'] = $quarters[$quarter]['start'];
    //             $filters['end-date'] = $quarters[$quarter]['end'];
    //         break;
    //         case 'this-year':
    //             $filters['start-date'] = date("Y-01-01");
    //             $filters['end-date'] = date("Y-12-t");
    //         break;
    //         case 'last-week':
    //             $filters['start-date'] = date("Y-m-d", strtotime("this week -1 week -1 day"));
    //             $filters['end-date'] = date("Y-m-d", strtotime("sunday -1 week -1 day"));
    //         break;
    //         case 'last-month':
    //             $filters['start-date'] = date("Y-m-01", strtotime(date("m/01/Y")." -1 month"));
    //             $filters['end-date'] = date("Y-m-t", strtotime(date("m/01/Y")." -1 month"));
    //         break;
    //         case 'last-quarter':
    //             $quarters = [
    //                 1 => [
    //                     'start' => date("01/01/Y"),
    //                     'end' => date("03/t/Y")
    //                 ],
    //                 2 => [
    //                     'start' => date("04/01/Y"),
    //                     'end' => date("06/t/Y")
    //                 ],
    //                 3 => [
    //                     'start' => date("07/01/Y"),
    //                     'end' => date("09/t/Y")
    //                 ],
    //                 4 => [
    //                     'start' => date("10/01/Y"),
    //                     'end' => date("12/t/Y")
    //                 ]
    //             ];
    //             $month = date('n');
    //             $quarter = ceil($month / 3);

    //             $filters['start-date'] = date("Y-m-d", strtotime($quarters[$quarter]['start']." -3 months"));
    //             $filters['end-date'] = date("Y-m-t", strtotime($filters['start-date']." +2 months"));
    //         break;
    //         case 'last-year':
    //             $filters['start-date'] = date("Y-01-01", strtotime(date("01/01/Y")." -1 year"));
    //             $filters['end-date'] = date("Y-12-t", strtotime(date("12/t/Y")." -1 year"));
    //         break;
    //         case 'last-365-days':
    //             $filters['start-date'] = date("Y-m-d", strtotime(date("m/d/Y")." -365 days"));
    //             $filters['end-date'] = date("Y-m-d");
    //         break;
    //     }

    //     $data = $this->get_transactions($vendorId, $filters);

    //     usort($data, function ($a, $b) use ($order, $columnName) {
    //         if ($columnName !== 'date') {
    //             if($a[$columnName] === $b[$columnName]) {
    //                 return strtotime($a['date_created']) > strtotime($b['date_created']);
    //             }
    //             if ($order === 'asc') {
    //                 return strcmp($a[$columnName], $b[$columnName]);
    //             } else {
    //                 return strcmp($b[$columnName], $a[$columnName]);
    //             }
    //         } else {
    //             if ($order === 'asc') {
    //                 if(strtotime($a[$columnName]) === strtotime($b[$columnName])) {
    //                     return strtotime($a['date_created']) > strtotime($b['date_created']);
    //                 }
    //                 return strtotime($a[$columnName]) > strtotime($b[$columnName]);
    //             } else {
    //                 if(strtotime($a[$columnName]) === strtotime($b[$columnName])) {
    //                     return strtotime($a['date_created']) < strtotime($b['date_created']);
    //                 }
    //                 return strtotime($a[$columnName]) < strtotime($b[$columnName]);
    //             }
    //         }
    //     });

    //     $result = [
    //         'draw' => $post['draw'],
    //         'recordsTotal' => count($data),
    //         'recordsFiltered' => count($data),
    //         'data' => array_slice($data, $start, $limit)
    //     ];

    //     echo json_encode($result);
    // }

    private function get_transactions($vendorId, $filters, $for = 'table')
    {
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);
        switch ($filters['type']) {
            case 'all-bills':
                $bills = $this->vendors_model->get_vendor_bill_transactions($vendorId, $filters);
            break;
            case 'open-bills':
                $bills = $this->vendors_model->get_vendor_open_bills($vendorId);
            break;
            case 'overdue-bills':
                $bills = $this->vendors_model->get_vendor_overdue_bills($vendorId);
            break;
            case 'expenses':
                $expenses = $this->vendors_model->get_vendor_expense_transactions($vendorId, $filters);
            break;
            case 'checks':
                $checks = $this->vendors_model->get_vendor_check_transactions($vendorId, $filters);
            break;
            case 'bill-payments':
                $billPayments = $this->vendors_model->get_vendor_bill_payments($vendorId, $filters);
            break;
            case 'recently-paid':
                $expenses = $this->vendors_model->get_vendor_expense_transactions($vendorId, $filters);
                $checks = $this->vendors_model->get_vendor_check_transactions($vendorId, $filters);
                $bills = $this->vendors_model->get_vendor_paid_bills($vendorId, $filters);
                $creditCardPayments = $this->vendors_model->get_vendor_credit_card_payments($vendorId, $filters);
            break;
            case 'purchase-orders':
                $purchaseOrders = $this->vendors_model->get_vendor_purchase_orders($vendorId, $filters);
            break;
            case 'vendor-credits':
                $vendorCredits = $this->vendors_model->get_vendor_credit_transactions($vendorId, $filters);
            break;
            default:
                $expenses = $this->vendors_model->get_vendor_expense_transactions($vendorId, $filters);
                $checks = $this->vendors_model->get_vendor_check_transactions($vendorId, $filters);
                $bills = $this->vendors_model->get_vendor_bill_transactions($vendorId, $filters);
                $creditCardPayments = $this->vendors_model->get_vendor_credit_card_payments($vendorId, $filters);
                $purchaseOrders = $this->vendors_model->get_vendor_purchase_orders($vendorId, $filters);
                $billPayments = $this->vendors_model->get_vendor_bill_payments($vendorId, $filters);
                $vendorCredits = $this->vendors_model->get_vendor_credit_transactions($vendorId, $filters);
                $creditCardCredits = $this->vendors_model->get_vendor_cc_credit_transactions($vendorId, $filters);
            break;
        }

        $transactions = [];
        if (isset($bills) && count($bills) > 0) {
            foreach ($bills as $bill) {
                $attachments = $this->accounting_attachments_model->get_attachments('Bill', $bill->id);

                if($for === 'table') {
                    $manageCol = '<div class="dropdown table-management">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">';
                    
                    if($bill->status !== "2") {
                        $manageCol .= '<li><a class="dropdown-item" href="#">Schedule payment</a></li>';
                        $manageCol .= '<li><a class="dropdown-item bill-mark-paid" data-id="'.$bill->id.'" href="javascript:void(0)">Mark as paid</a></li>';
                    }
                    $manageCol .= '<li>
                                <a class="dropdown-item view-edit-bill" href="#">View/Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item copy-transaction" href="#">Copy</a>
                            </li>
                            <li>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </li>
                        </ul>
                    </div>';
                }

                $transactions[] = [
                    'id' => $bill->id,
                    'date' => date("m/d/Y", strtotime($bill->bill_date)),
                    'type' => 'Bill',
                    'number' => $bill->bill_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($bill->id, 'Bill', $for),
                    'memo' => $bill->memo,
                    'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                    'balance' => str_replace('$-', '-$', '$'.number_format(floatval($bill->remaining_balance), 2, '.', ',')),
                    'total' => str_replace('$-', '-$', '$'.number_format(floatval($bill->total_amount), 2, '.', ',')),
                    'status' => $bill->status === "2" ? "Paid" : "Open",
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($bill->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        if (isset($billPayments) && count($billPayments) > 0) {
            foreach ($billPayments as $payment) {
                $attachments = $this->accounting_attachments_model->get_attachments('Bill Payment', $payment->id);

                $paymentAcc = $this->chart_of_accounts_model->getById($payment->payment_account_id);
                $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
                $paymentType = $paymentAccType->account_name === 'Bank' ? 'Check' : 'Credit Card';

                if($for === 'table') {
                    if($paymentType === 'Check') {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item view-edit-bill-payment" href="#">View/Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item delete-transaction" href="#">Delete</a>
                                </li>
                        ';

                        if($payment->status !== '4') {
                            $manageCol .= '<li>
                                <a class="dropdown-item void-transaction" href="#">Void</a>
                            </li>';
                        }

                        $manageCol .= '</ul>
                        </div>';
                    } else {
                        $manageCol = '<div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item view-edit-bill-payment" href="#">View/Edit</a>
                                </li>
                            </ul>
                        </div>
                        ';
                    }
                }

                $transactions[] = [
                    'id' => $payment->id,
                    'date' => date("m/d/Y", strtotime($payment->payment_date)),
                    'type' => "Bill Payment ($paymentType)",
                    'number' => $payment->check_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => '',
                    'due_date' => date("m/d/Y", strtotime($payment->payment_date)),
                    'balance' => '$'.number_format(floatval($payment->available_credits_amount), 2, '.', ','),
                    'total' => '-$'.number_format(floatval($payment->total_amount), 2, '.', ','),
                    'status' => $payment->status === "4" ? 'Voided' : 'Applied',
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($payment->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        if (isset($checks) && count($checks) > 0) {
            foreach ($checks as $check) {
                $attachments = $this->accounting_attachments_model->get_attachments('Check', $check->id);

                if($for === 'table') {
                    $manageCol = '<div class="dropdown table-management">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item print-check" href="#">Print check</a>
                            </li>
                            <li>
                                <a class="dropdown-item view-edit-check" href="#">View/Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item copy-transaction" href="#">Copy</a>
                            </li>
                            <li>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </li>
                    ';

                    if($check->status !== '4') {
                        $manageCol .= '<li>
                            <a class="dropdown-item void-transaction" href="#">Void</a>
                        </li>';
                    }

                    $manageCol .= '</ul>
                    </div>';
                }

                $transactions[] = [
                    'id' => $check->id,
                    'date' => date("m/d/Y", strtotime($check->payment_date)),
                    'type' => 'Check',
                    'number' => $check->check_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($check->id, 'Check', $for),
                    'memo' => $check->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => str_replace('$-', '-$', '$'.number_format(floatval($check->total_amount), 2, '.', ',')),
                    'status' => $check->status === '4' ? 'Voided' : 'Paid',
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($check->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        if (isset($creditCardCredits) && count($creditCardCredits) > 0) {
            foreach ($creditCardCredits as $creditCardCredit) {
                $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $creditCardCredit->id);

                if($for === 'table') {
                    $manageCol = '<div class="dropdown table-management">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item view-edit-cc-credit" href="#">View/Edit</a>
                            </li>
                        </ul>
                    </div>';
                }

                $transactions[] = [
                    'id' => $creditCardCredit->id,
                    'date' => date("m/d/Y", strtotime($creditCardCredit->payment_date)),
                    'type' => "Credit Card Credit",
                    'number' => $creditCardCredit->ref_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($creditCardCredit->id, 'Credit Card Credit', $for),
                    'memo' => $creditCardCredits->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '-$'.number_format(floatval($creditCardCredit->total_amount), 2, '.', ','),
                    'status' => '',
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($creditCardCredit->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        if (isset($creditCardPayments) && count($creditCardPayments) > 0) {
            foreach ($creditCardPayments as $cardPayment) {
                $attachments = $this->accounting_attachments_model->get_attachments('CC Payment', $cardPayment->id);

                if($for === 'table') {
                    $manageCol = '<div class="dropdown table-management">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item view-edit-cc-payment" href="#">View/Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </li>';

                    if($cardPayment->status !== '4') {
                        $manageCol .= '<li><a class="dropdown-item void-transaction" href="#">Void</a></li>';
                    }

                    $manageCol .= '</ul>
                    </div>';
                }

                $transactions[] = [
                    'id' => $cardPayment->id,
                    'date' => date("m/d/Y", strtotime($cardPayment->date)),
                    'type' => 'Credit Card Payment',
                    'number' => '',
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => $cardPayment->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => str_replace('$-', '-$', '$'.number_format(floatval($cardPayment->amount), 2, '.', ',')),
                    'status' => '',
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($cardPayment->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        if (isset($expenses) && count($expenses) > 0) {
            foreach ($expenses as $expense) {
                $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

                if($for === 'table') {
                    $manageCol = '<div class="dropdown table-management">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item view-edit-expense" href="#">View/Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/accounting/expenses/print-transaction/expense/'.$expense->id.'" target="_blank">Print</a>
                            </li>
                            <li>
                                <a class="dropdown-item copy-transaction" href="#">Copy</a>
                            </li>
                            <li>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </li>
                    ';

                    if($expense->status !== '4') {
                        $manageCol .= '<li>
                            <a class="dropdown-item void-transaction" href="#">Void</a>
                        </li>';
                    }

                    $manageCol .= '</ul>
                    </div>';
                }

                $method = $this->accounting_payment_methods_model->getById($expense->payment_method_id);

                $transactions[] = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'type' => 'Expense',
                    'number' => $expense->ref_no,
                    'payee' => $vendor->display_name,
                    'method' => $method->name,
                    'source' => '',
                    'category' => $this->category_col($expense->id, 'Expense', $for),
                    'memo' => $expense->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => str_replace('$-', '-$', '$'.number_format(floatval($expense->total_amount), 2, '.', ',')),
                    'status' => $expense->status === '4' ? 'Voided' : 'Paid',
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        if (isset($purchaseOrders) && count($purchaseOrders) > 0) {
            foreach ($purchaseOrders as $purchaseOrder) {
                $attachments = $this->accounting_attachments_model->get_attachments('Purchase Order', $purchaseOrder->id);

                if($for === 'table') {
                    $manageCol = '<div class="dropdown table-management">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">';

                        if($purchaseOrder->status === '1') {
                            $manageCol .= '<li>
                                <a class="dropdown-item" href="#">Send</a>
                            </li>
                            <li>
                                <a class="dropdown-item copy-to-bill" href="#">Copy to bill</a>
                            </li>';
                        }

                        $manageCol .= '<li>
                                <a class="dropdown-item" href="/accounting/expenses/print-transaction/purchase-order/'.$purchaseOrder->id.'" target="_blank">Print</a>
                            </li>
                            <li>
                                <a class="dropdown-item view-edit-purch-order" href="#">View/Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item copy-transaction" href="#">Copy</a>
                            </li>
                            <li>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </li>
                    ';

                    $manageCol .= '</ul>
                    </div>';
                }

                $transactions[] = [
                    'id' => $purchaseOrder->id,
                    'date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'type' => 'Purchase Order',
                    'number' => $purchaseOrder->purchase_order_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($purchaseOrder->id, 'Purchase Order', $for),
                    'memo' => $purchaseOrder->memo,
                    'due_date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'balance' => '$0.00',
                    'total' => str_replace('$-', '-$', '$'.number_format(floatval($purchaseOrder->total_amount), 2, '.', ',')),
                    'status' => $purchaseOrder->status === "1" ? "Open" : "Closed",
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($purchaseOrder->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        if (isset($vendorCredits) && count($vendorCredits) > 0) {
            foreach ($vendorCredits as $vendorCredit) {
                $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $vendorCredit->id);

                if($for === 'table') {
                    $manageCol = '<div class="dropdown table-management">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item view-edit-vendor-credit" href="#">View/Edit</a>
                            </li>
                            <li>
                                <a class="dropdown-item copy-transaction" href="#">Copy</a>
                            </li>
                            <li>
                                <a class="dropdown-item delete-transaction" href="#">Delete</a>
                            </li>
                        </ul>
                    </div>';
                }

                $transactions[] = [
                    'id' => $vendorCredit->id,
                    'date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                    'type' => "Vendor Credit",
                    'number' => $vendorCredit->ref_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($vendorCredit->id, 'Vendor Credit', $for),
                    'memo' => $vendorCredits->memo,
                    'due_date' => '',
                    'balance' => str_replace('$-', '-$', '$'.number_format(floatval($vendorCredit->remaining_balance), 2, '.', ',')),
                    'total' => '-$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ','),
                    'status' => $vendorCredit->status === "1" ? "Unapplied" : "Applied",
                    'attachments' => $for === 'table' ? $attachments : count($attachments),
                    'date_created' => date("m/d/Y H:i:s", strtotime($vendorCredit->created_at)),
                    'manage' => $for === 'table' ? $manageCol : ''
                ];
            }
        }

        usort($transactions, function($a, $b) {
            if(strtotime($a['date']) === strtotime($b['date'])) {
                return strtotime($a['date_created']) < strtotime($b['date_created']);
            }
            return strtotime($a['date']) < strtotime($b['date']);
        });

        return $transactions;
    }

    private function category_col($transactionId, $transactionType, $for = 'table')
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        $totalCount = count($categories) + count($items);

        if ($totalCount > 1) {
            $category = '-Split-';
        } else {
            if ($totalCount === 1) {
                if (count($categories) === 1 && count($items) === 0) {
                    $expenseAcc = $categories[0]->expense_account_id;
                } else {
                    $itemId = $items[0]->item_id;
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($itemId);
                    $expenseAcc = $itemAccDetails->inv_asset_acc_id;
                }

                if($for === 'table') {
                    $category = [
                        'id' => $expenseAcc,
                        'name' => $this->chart_of_accounts_model->getName($expenseAcc)
                    ];
                } else {
                    $category = $this->chart_of_accounts_model->getName($expenseAcc);
                }
            }
        }

        return $category;
    }

    private function get_category_accs()
    {
        $categoryAccs = [];
        $accountTypes = [
            'Expenses',
            'Bank',
            'Accounts receivable (A/R)',
            'Other Current Assets',
            'Fixed Assets',
            'Accounts payable (A/P)',
            'Credit Card',
            'Other Current Liabilities',
            'Long Term Liabilities',
            'Equity',
            'Income',
            'Cost of Goods Sold',
            'Other Income',
            'Other Expense'
        ];

        foreach ($accountTypes as $typeName) {
            $accType = $this->account_model->getAccTypeByName($typeName);

            $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

            if (count($accounts) > 0) {
                foreach ($accounts as $account) {
                    $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                    $account->childAccs = $childAccs;

                    $categoryAccs[$typeName][] = $account;
                }
            }
        }

        return $categoryAccs;
    }

    public function categorize_transactions($vendorId, $categoryId)
    {
        $post = $this->input->post();

        $categories = [];
        foreach ($post['transaction_id'] as $index => $transactionId) {
            switch ($post['transaction_type'][$index]) {
                case 'bill':
                    $transaction = $this->vendors_model->get_bill_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Bill');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'expense':
                    $transaction = $this->vendors_model->get_expense_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Expense');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'check':
                    $transaction = $this->vendors_model->get_check_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Check');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'purchase-order':
                    $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Purchase Order');
                    $category = $category[0];
                break;
                case 'vendor-credit':
                    $transaction = $this->vendors_model->get_vendor_credit_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Vendor Credit');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'credit-card-credit':
                    $transaction = $this->vendors_model->get_credit_card_credit_by_id($transactionId, logged('company_id'));
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Credit Card Credit');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                        if ($expenseAccType->account_name === 'Credit Card') {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                        } else {
                            $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                        }

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
            }

            $categories[] = [
                'id' => $category->id,
                'expense_account_id' => $categoryId
            ];
        }

        $update = $this->vendors_model->update_multiple_category_by_id($categories);
        $updatedCount = count($post['transaction_id']);
        $newCategory = $this->chart_of_accounts_model->getById($categoryId);

        $this->session->set_flashdata("success", "Category updated to $newCategory->name for $updatedCount transactions.");
    }

    public function update_transaction_category($vendorId)
    {
        $post = $this->input->post();

        switch ($post['transaction_type']) {
            case 'bill':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Bill');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'expense':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Expense');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'check':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Check');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'vendor-credit':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Vendor Credit');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
            case 'credit-card-credit':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Credit Card Credit');
                $category = $category[0];

                if ($category->expense_account_id !== $post['new_category']) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($post['new_category']);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) - floatval($category->amount);
                    } else {
                        $newBalance = floatval(str_replace(',', '', $expenseAcc->balance)) + floatval($category->amount);
                    }

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
        }

        $post['transaction_type'] = str_replace('-', ' ', $post['transaction_type']);
        $post['transaction_type'] = ucwords($post['transaction_type']);

        $update = $this->vendors_model->update_transaction_category($post);

        echo json_encode([
            'data' => $update,
            'success' => $update ? true : false,
            'message' => $update ? "Successfully updated!" : "Unexpected Error"
        ]);
    }

    public function print_transaction($transactionType, $transactionId)
    {
        $this->load->library('pdf');
        $view = "accounting/modals/print_action/print_transactions";
        $fileName = 'print.pdf';

        $data = [];

        switch ($transactionType) {
            case 'expense':
                $transaction = $this->vendors_model->get_expense_by_id($transactionId, logged('company_id'));
                $items = $this->expenses_model->get_transaction_items($transactionId, 'Expense');
                $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Expense');

                switch ($transaction->payee_type) {
                    case 'vendor':
                        $payee = $this->vendors_model->get_vendor_by_id($transaction->payee_id);
                        $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                        $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                        $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                        $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                        $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";

                        $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
                    break;
                    case 'customer':
                        $payee = $this->accounting_customers_model->get_by_id($transaction->payee_id);
                        $payeeName = $payee->first_name !== null && $payee->first_name !== ""  ? $payee->first_name : "";
                        $payeeName .= $payee->middle_name !== null && $payee->middle_name !== ""  ? " $payee->middle_name" : "";
                        $payeeName .= $payee->last_name !== null && $payee->last_name !== ""  ? " $payee->last_name" : "";
                        $payeeName .= $payee->suffix !== null && $payee->suffix !== ""  ? " $payee->suffix" : "";
                    break;
                    case 'employee':
                        $payee = $this->users_model->getUser($expense->payee_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }
            break;
            case 'purchase-order':
                $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId, logged('company_id'));
                $items = $this->expenses_model->get_transaction_items($transactionId, 'Purchase Order');
                $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Purchase Order');

                $payee = $this->vendors_model->get_vendor_by_id($transaction->vendor_id);
                $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";

                $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
            break;
        }
        
        $tableItems = [];

        foreach ($items as $item) {
            $itemDetails = $this->items_model->getItemById($item->item_id)[0];

            if ($transactionType === 'expense') {
                $tableItems[] = [
                    'name' => $itemDetails->title,
                    'description' => '',
                    'amount' => number_format(floatval($item->total), 2, '.', ',')
                ];
            } else {
                $tableItems[] = [
                    'activity' => $itemDetails->title,
                    'qty' => $item->quantity,
                    'rate' => number_format(floatval($item->rate), 2, '.', ','),
                    'amount' => number_format(floatval($item->total), 2, '.', ','),
                ];
            }
        }

        foreach ($categories as $category) {
            $categoryAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

            if ($transactionType === 'expense') {
                $tableItems[] = [
                    'name' => $categoryAcc->name,
                    'description' => $category->description,
                    'amount' => number_format(floatval($category->amount), 2, '.', ',')
                ];
            } else {
                $tableItems[] = [
                    'activity' => $categoryAcc->name,
                    'qty' => '',
                    'rate' => number_format(floatval(1), 2, '.', ','),
                    'amount' => number_format(floatval($category->amount), 2, '.', ','),
                ];
            }
        }

        usort($tableItems, function ($a, $b) use ($transactionType) {
            if ($transactionType === 'expense') {
                return strcmp($a['name'], $b['name']);
            } else {
                return strcmp($a['activity'], $b['activity']);
            }
        });

        $data[] = [
            'type' => $transactionType,
            'payee' => $payee,
            'payeeName' => $payeeName,
            'transaction' => $transaction,
            'table_items' => $tableItems
        ];

        $this->pdf->save_pdf($view, ['data' => $data], $fileName, 'portrait');

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

    public function print_multiple()
    {
        $this->load->library('pdf');
        $view = "accounting/modals/print_action/print_transactions";
        $fileName = 'print.pdf';
        $transactions = $this->input->post('transactions');

        $data = [];
        foreach ($transactions as $transaction) {
            $explode = explode('_', $transaction);
            $transactionType = $explode[0];
            $transactionId = $explode[1];

            switch ($transactionType) {
                case 'expense':
                    $transaction = $this->vendors_model->get_expense_by_id($transactionId, logged('company_id'));
                    $items = $this->expenses_model->get_transaction_items($transactionId, 'Expense');
                    $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Expense');
    
                    switch ($transaction->payee_type) {
                        case 'vendor':
                            $payee = $this->vendors_model->get_vendor_by_id($transaction->payee_id);
                            $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                            $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                            $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                            $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                            $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";
    
                            $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
                        break;
                        case 'customer':
                            $payee = $this->accounting_customers_model->get_by_id($transaction->payee_id);
                            $payeeName = $payee->first_name !== null && $payee->first_name !== ""  ? $payee->first_name : "";
                            $payeeName .= $payee->middle_name !== null && $payee->middle_name !== ""  ? " $payee->middle_name" : "";
                            $payeeName .= $payee->last_name !== null && $payee->last_name !== ""  ? " $payee->last_name" : "";
                            $payeeName .= $payee->suffix !== null && $payee->suffix !== ""  ? " $payee->suffix" : "";
                        break;
                        case 'employee':
                            $payee = $this->users_model->getUser($expense->payee_id);
                            $payeeName = $payee->FName . ' ' . $payee->LName;
                        break;
                    }
                break;
                case 'purchase-order':
                    $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId, logged('company_id'));
                    $items = $this->expenses_model->get_transaction_items($transactionId, 'Purchase Order');
                    $categories = $this->expenses_model->get_transaction_categories($transactionId, 'Purchase Order');
    
                    $payee = $this->vendors_model->get_vendor_by_id($transaction->vendor_id);
                    $payeeName = $payee->title !== null && $payee->title !== "" ? $payee->title : "";
                    $payeeName .= $payee->f_name !== null && $payee->f_name !== "" ? " $payee->f_name" : "";
                    $payeeName .= $payee->m_name !== null && $payee->m_name !== "" ? " $payee->m_name" : "";
                    $payeeName .= $payee->l_name !== null && $payee->l_name !== "" ? " $payee->l_name" : "";
                    $payeeName .= $payee->suffix !== null && $payee->suffix !== "" ? " $payee->suffix" : "";
    
                    $payeeName = $payeeName === "" ? $payee->display_name : $payeeName;
                break;
            }

            $tableItems = [];
            foreach ($items as $item) {
                $itemDetails = $this->items_model->getItemById($item->item_id)[0];

                if ($transactionType === 'expense') {
                    $tableItems[] = [
                        'name' => $itemDetails->title,
                        'description' => '',
                        'amount' => number_format(floatval($item->total), 2, '.', ',')
                    ];
                } else {
                    $tableItems[] = [
                        'activity' => $itemDetails->title,
                        'qty' => $item->quantity,
                        'rate' => number_format(floatval($item->rate), 2, '.', ','),
                        'amount' => number_format(floatval($item->total), 2, '.', ','),
                    ];
                }
            }

            foreach ($categories as $category) {
                $categoryAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);

                if ($transactionType === 'expense') {
                    $tableItems[] = [
                        'name' => $categoryAcc->name,
                        'description' => $category->description,
                        'amount' => number_format(floatval($category->amount), 2, '.', ',')
                    ];
                } else {
                    $tableItems[] = [
                        'activity' => '',
                        'qty' => '',
                        'rate' => number_format(floatval(1), 2, '.', ','),
                        'amount' => number_format(floatval($category->amount), 2, '.', ','),
                    ];
                }
            }

            usort($tableItems, function ($a, $b) use ($transactionType) {
                if ($transactionType === 'expense') {
                    return strcmp($a['name'], $b['name']);
                } else {
                    return strcmp($a['activity'], $b['activity']);
                }
            });

            $data[] = [
                'type' => $transactionType,
                'payee' => $payee,
                'payeeName' => $payeeName,
                'transaction' => $transaction,
                'table_items' => $tableItems
            ];
        }

        $this->pdf->save_pdf($view, ['data' => $data], $fileName, 'portrait');

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

    public function print_transactions($vendorId)
    {
        $post = $this->input->post();
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);
        $order = $post['order'];
        $columnName = $post['column'];
        $type = $post['type'];
        $date = $post['date'];

        $filters = [
            'type' => $type,
            'order' => $order
        ];

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

        $transactions = $this->get_transactions($vendorId, $filters, 'print');

        usort($transactions, function ($a, $b) use ($order, $columnName) {
            if ($columnName !== 'date') {
                if($a[$columnName] === $b[$columnName]) {
                    return strtotime($a['date_created']) > strtotime($b['date_created']);
                }
                if ($order === 'asc') {
                    return strcmp($a[$columnName], $b[$columnName]);
                } else {
                    return strcmp($b[$columnName], $a[$columnName]);
                }
            } else {
                if ($order === 'asc') {
                    if(strtotime($a[$columnName]) === strtotime($b[$columnName])) {
                        return strtotime($a['date_created']) > strtotime($b['date_created']);
                    }
                    return strtotime($a[$columnName]) > strtotime($b[$columnName]);
                } else {
                    if(strtotime($a[$columnName]) === strtotime($b[$columnName])) {
                        return strtotime($a['date_created']) < strtotime($b['date_created']);
                    }
                    return strtotime($a[$columnName]) < strtotime($b[$columnName]);
                }
            }
        });

        switch($post['type']) {
            case 'all' :
                $type = 'All transactions';
                $status = 'All statuses';
            break;
            case 'expenses' :
                $type = 'Expense';
            break;
            case 'all-bills' :
                $type = 'Bill';
                $status = 'All statuses';
            break;
            case 'open-bills' :
                $type = 'Bill';
                $status = 'Open';
            break;
            case 'overdue-bills' :
                $type = 'Bill';
                $status = 'Overdue';
            break;
            case 'bill-payments' :
                $type = 'Bill payments';
            break;
            case 'check' :
                $type = 'Check';
            break;
            case 'purchase-orders' :
                $type = 'Purchase order';
            break;
            case 'recently-paid' :
                $type = 'Recently paid';
            break;
            case 'vendor-credits' :
                $type = 'Vendor Credit';
            break;
        }

        $tableHtml = "<h3 style='text-align: center;'>";
        $tableHtml .= "Type: $type";
        $tableHtml .= isset($status) ? "· Status: $status" : "";
        $tableHtml .= "· Name: $vendor->display_name";
        $tableHtml .= $post['date'] !== 'custom' ? " · Date: ".ucfirst(str_replace("-", " ", $post['date'])) : " · Delivery method: ".ucfirst(str_replace("-", " ", $post['delivery_method']));
        $tableHtml .= "</h3>";

        $tableHtml .= "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Date</th>";
        $tableHtml .= $post['chk_type'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>" : "";
        $tableHtml .= $post['chk_number'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>No.</th>" : "";
        $tableHtml .= $post['chk_payee'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Payee</th>" : "";
        $tableHtml .= $post['chk_method'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Method</th>" : "";
        $tableHtml .= $post['chk_source'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Source</th>" : "";
        $tableHtml .= $post['chk_category'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Category</th>" : "";
        $tableHtml .= $post['chk_memo'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Memo</th>" : "";
        $tableHtml .= $post['chk_due_date'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Due date</th>" : "";
        $tableHtml .= $post['chk_balance'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Balance</th>" : "";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Total</th>";
        $tableHtml .= $post['chk_status'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Status</th>" : "";
        $tableHtml .= $post['chk_attachments'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Attachments</th>" : "";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";

        foreach($transactions as $transaction) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['date']."</td>";
            $tableHtml .= $post['chk_type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['type']."</td>" : "";
            $tableHtml .= $post['chk_number'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['number']."</td>" : "";
            $tableHtml .= $post['chk_payee'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['payee']."</td>" : "";
            $tableHtml .= $post['chk_method'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['method']."</td>" : "";
            $tableHtml .= $post['chk_source'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['source']."</td>" : "";
            $tableHtml .= $post['chk_category'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['category']."</td>" : "";
            $tableHtml .= $post['chk_memo'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['memo']."</td>" : "";
            $tableHtml .= $post['chk_due_date'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['due_date']."</td>" : "";
            $tableHtml .= $post['chk_balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['balance']."</td>" : "";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['total']."</td>";
            $tableHtml .= $post['chk_status'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['status']."</td>" : "";
            $tableHtml .= $post['chk_attachments'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$transaction['attachments']."</td>" : "";
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function export_transactions($vendorId)
    {
        $this->load->library('PHPXLSXWriter');
        $post = $this->input->post();
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);
        $order = $post['order'];
        $columnName = $post['column'];
        $type = $post['type'];
        $date = $post['date'];

        $filters = [
            'type' => $type,
            'order' => $order
        ];

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

        $transactions = $this->get_transactions($vendorId, $filters, 'print');

        switch($post['type']) {
            case 'all' :
                $type = 'All transactions';
                $status = 'All statuses';
            break;
            case 'expenses' :
                $type = 'Expense';
            break;
            case 'all-bills' :
                $type = 'Bill';
                $status = 'All statuses';
            break;
            case 'open-bills' :
                $type = 'Bill';
                $status = 'Open';
            break;
            case 'overdue-bills' :
                $type = 'Bill';
                $status = 'Overdue';
            break;
            case 'bill-payments' :
                $type = 'Bill payments';
            break;
            case 'check' :
                $type = 'Check';
            break;
            case 'purchase-orders' :
                $type = 'Purchase order';
            break;
            case 'recently-paid' :
                $type = 'Recently paid';
            break;
            case 'vendor-credits' :
                $type = 'Vendor Credit';
            break;
        }

        $excelHead .= "Type: $type";
        $excelHead .= isset($status) ? "· Status: $status" : "";
        $excelHead .= "· Name: $vendor->display_name";
        $excelHead .= $post['date'] !== 'custom' ? " · Date: ".ucfirst(str_replace("-", " ", $post['date'])) : " · Delivery method: ".ucfirst(str_replace("-", " ", $post['delivery_method']));

        $writer = new XLSXWriter();
        $writer->writeSheetRow('Sheet1', [$excelHead], ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);

        $headers = [];

        $headers[] = "Date";
        $fields[]  = "date";
        if(in_array('type', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Type";
            $fields[]  = "type";
        }
        if(in_array('number', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "No.";
            $fields[]  = "number";
        }
        if(in_array('payee', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Payee";
            $fields[]  = "payee";
        }
        if(in_array('method', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Method";
            $fields[]  = "method";
        }
        if(in_array('source', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Source";
            $fields[]  = "source";
        }
        if(in_array('category', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Category";
            $fields[]  = "category";
        }
        if(in_array('memo', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Memo";
            $fields[]  = "memo";
        }
        if(in_array('due_date', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Due date";
            $fields[]  = "due_date";
        }
        if(in_array('balance', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Balance";
            $fields[]  = "balance";
        }
        $headers[] = "Total";
        $fields[]  = "total";
        if(in_array('status', $post['fields']) || is_null($post['fields'])) {
            $headers[] = "Status";
            $fields[]  = "status";
        }
        // if(in_array('attachments', $post['fields']) || is_null($post['fields'])) {
        //     $headers[] = "Attachments";
        //     $fields[]  = "attachments";
        // }

        $writer->markMergedCell('Sheet1', 0, 0, 0, count($headers) - 1);
        $writer->writeSheetRow('Sheet1', $headers, ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);

        $transaction_data = [];
        foreach($transactions as $transaction) {
            $keys = array_keys($transaction);
            foreach($keys as $key) {
                if(!in_array($key, $fields) && !in_array($key, $post['fields'])) {
                    unset($transaction[$key]);
                }
            }
            $writer->writeSheetRow('Sheet1', $transaction);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="expenses.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }

    public function print()
    {
        $post = $this->input->post();
        $order = $post['order'];
        $columnName = $post['column'];
        $search = $post['search'];
        $fields = $post['fields'];

        $status = [
            1
        ];

        if ($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        if (!isset($post['transaction'])) {
            $vendors = $this->vendors_model->getAllByCompany($status);
        } else {
            switch ($post['transaction']) {
                case 'purchase-orders':
                    $vendors = $this->vendors_model->get_vendors_with_unbilled_po($status);
                break;
                case 'open-bills':
                    $vendors = $this->vendors_model->get_vendors_with_open_bills($status);
                break;
                case 'overdue-bills':
                    $vendors = $this->vendors_model->get_vendors_with_overdue_bills($status);
                break;
                case 'payments':
                    $vendors = $this->vendors_model->get_vendors_with_payments($status);
                break;
            }
        }

        $data = [];
        foreach($vendors as $vendor) {
            $attachments = $this->accounting_attachments_model->get_attachments('Vendor', $vendor->id);
            if ($search !== "") {
                if (stripos($vendor->display_name, $search) !== false) {
                    $data[] = [
                        'id' => $vendor->id,
                        'name' => $vendor->display_name,
                        'company_name' => $vendor->company,
                        'address' => "$vendor->street<br>$vendor->city $vendor->state $vendor->zip",
                        'phone' => $vendor->phone,
                        'email' => $vendor->email,
                        'attachments' => count($attachments),
                        'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',')
                    ];
                }
            } else {
                $data[] = [
                    'id' => $vendor->id,
                    'name' => $vendor->display_name,
                    'company_name' => $vendor->company,
                    'address' => "$vendor->street<br>$vendor->city $vendor->state $vendor->zip",
                    'phone' => $vendor->phone,
                    'email' => $vendor->email,
                    'attachments' => count($attachments),
                    'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',')
                ];
            }
        }
    
        usort($data, function ($a, $b) use ($order, $columnName) {
            if ($order === 'asc') {
                return strcmp($a[$columnName], $b[$columnName]);
            } else {
                return strcmp($b[$columnName], $a[$columnName]);
            }
        });

        $tableHtml .= "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Vendor</th>";
        $tableHtml .= in_array('address', $post['fields']) ? "<th style='border-bottom: 2px solid #BFBFBF'>Address</th>" : "";
        $tableHtml .= in_array('phone', $post['fields']) ? "<th style='border-bottom: 2px solid #BFBFBF'>Phone</th>" : "";
        $tableHtml .= in_array('email', $post['fields']) ? "<th style='border-bottom: 2px solid #BFBFBF'>Email</th>" : "";
        $tableHtml .= in_array('attachments', $post['fields']) ? "<th style='border-bottom: 2px solid #BFBFBF'>Attachments</th>" : "";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Open Balance</th>";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";

        foreach($data as $v) {
            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>";
            $tableHtml .= $v['name'];
            $tableHtml .= $v['company_name'] !== "" && !is_null($v['company_name']) ? "<p style='margin: 0'>".$v['company_name']."</p>" : "";
            $tableHtml .= "</td>";
            $tableHtml .= in_array('address', $post['fields']) ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$v['address']."</td>" : "";
            $tableHtml .= in_array('phone', $post['fields']) ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$v['phone']."</td>" : "";
            $tableHtml .= in_array('email', $post['fields']) ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$v['email']."</td>" : "";
            $tableHtml .= in_array('attachments', $post['fields']) ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$v['attachments']."</td>" : "";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$v['open_balance']."</td>";
            $tableHtml .= "</tr>";
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function export()
    {
        $this->load->library('PHPXLSXWriter');
        $post = $this->input->post();
        $order = $post['order'];
        $columnName = $post['column'];
        $search = $post['search'];

        $status = [
            1
        ];

        if ($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        if (!isset($post['transaction'])) {
            $vendors = $this->vendors_model->getAllByCompany($status);
        } else {
            switch ($post['transaction']) {
                case 'purchase-orders':
                    $vendors = $this->vendors_model->get_vendors_with_unbilled_po($status);
                break;
                case 'open-bills':
                    $vendors = $this->vendors_model->get_vendors_with_open_bills($status);
                break;
                case 'overdue-bills':
                    $vendors = $this->vendors_model->get_vendors_with_overdue_bills($status);
                break;
                case 'payments':
                    $vendors = $this->vendors_model->get_vendors_with_payments($status);
                break;
            }
        }

        $data = [];
        foreach($vendors as $vendor) {
            $attachments = $this->accounting_attachments_model->get_attachments('Vendor', $vendor->id);
            if ($search !== "") {
                if (stripos($vendor->display_name, $search) !== false) {
                    $data[] = [
                        'name' => $vendor->display_name,
                        'company_name' => $vendor->company,
                        'address' => "$vendor->street",
                        'city' => $vendor->city,
                        'state' => $vendor->state,
                        'country' => $vendor->country,
                        'zip' => $vendor->zip,
                        'phone' => $vendor->phone,
                        'email' => $vendor->email,
                        'attachments' => count($attachments),
                        'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ','),
                        'status' => $vendor->status
                    ];
                }
            } else {
                $data[] = [
                    'name' => $vendor->display_name,
                    'company_name' => $vendor->company,
                    'address' => "$vendor->street",
                    'city' => $vendor->city,
                    'state' => $vendor->state,
                    'country' => $vendor->country,
                    'zip' => $vendor->zip,
                    'phone' => $vendor->phone,
                    'email' => $vendor->email,
                    'attachments' => count($attachments),
                    'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ','),
                    'status' => $vendor->status
                ];
            }
        }
    
        usort($data, function ($a, $b) use ($order, $columnName) {
            if ($order === 'asc') {
                return strcasecmp($a[$columnName], $b[$columnName]);
            } else {
                return strcasecmp($b[$columnName], $a[$columnName]);
            }
        });

        $writer = new XLSXWriter();
        $headers = [
            "Vendor",
            "Company",
            "Address",
            "City",
            "State",
            "Country",
            "Zip",
            "Phone",
            "Email",
            "Attachments",
            "Open Balance"
        ];

        if(!isset($post['fields']) || !in_array('address', $post['fields'])) {
            unset($headers[2]);
        }
        if(!isset($post['fields']) || !in_array('attachments', $post['fields'])) {
            unset($headers[9]);
        }
        if(!isset($post['fields']) || !in_array('phone', $post['fields'])) {
            unset($headers[7]);
        }
        if(!isset($post['fields']) || !in_array('email', $post['fields'])) {
            unset($headers[8]);
        }

        $writer->writeSheetRow('Sheet1', $headers, ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);

        foreach($data as $v) {
            $name = $v['name'];
            $name .= $v['status'] === '0' ? ' (deleted)' : '';
            $v['name'] = $name;
            unset($v['status']);

            if(!isset($post['fields']) || !in_array('address', $post['fields'])) {
                unset($v['address']);
            }
            if(!isset($post['fields']) || !in_array('attachments', $post['fields'])) {
                unset($v['attachments']);
            }
            if(!isset($post['fields']) || !in_array('phone', $post['fields'])) {
                unset($v['phone']);
            }
            if(!isset($post['fields']) || !in_array('email', $post['fields'])) {
                unset($v['email']);
            }

            $writer->writeSheetRow('Sheet1', $v);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="vendors.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }

    public function addJSONResponseHeader()
    {
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type: application/json");
    }

    public function get_import_data()
    {
        self::addJSONResponseHeader();
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            $csv = array_map("str_getcsv", file($_FILES['file']['tmp_name'],FILE_SKIP_EMPTY_LINES));
            $csvHeader = array_shift($csv);

            $this->load->library('CSVReader');
            $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

            $customerArray = []; // initialize array for storing import data

            if (!empty($csvData)) {
                foreach ($csvData as $row) {
                    $customerElement = [];
                    for($x=0; $x<count($csvHeader); $x++){
                        $trimmedData = str_replace(")", "", str_replace("(", "", str_replace("Phone:","", str_replace("$","",$row[$csvHeader[$x]]))));
                        //$data = preg_replace('/\s+/', '', $trimmedData);
                        $customerElement[$csvHeader[$x]] = $trimmedData;
                        //echo $csvHeader[$x]. PHP_EOL;
                        //echo $row[$csvHeader[$x]]. PHP_EOL;
                    }
                    //print_r(json_encode($customerElement)) . PHP_EOL;
                    //echo 'fasdf' . PHP_EOL;
                    $customerArray[] = $customerElement;
                }
                $data_arr = array("success" => TRUE,"data" => $customerArray, "headers" => $csvHeader, "csvData" => $csvData);
            }else{
                $data_arr = array("success" => FALSE,"message" => 'Something is wrong with your CSV file.');
            }
        }else{
            //echo 'No upload' . PHP_EOL;
        }
        die(json_encode($data_arr));
    }

    public function import_vendors_data()
    {
        self::addJSONResponseHeader();
        $input = $this->input->post();

        if($input) {
            $vendors = json_decode($input['vendors'], true); //data CSV
            $mappingSelected = json_decode($input['mapHeaders'], true); //selected Headers
            $csvHeaders = json_decode($input['csvHeaders'], true); //CSV Headers

            $inserted = 0;
            foreach($vendors as $data)
            {
                $mapName = $data[$csvHeaders[$mappingSelected[0]]];
                $mapCompanyName = $data[$csvHeaders[$mappingSelected[1]]];
                $mapEmail = $data[$csvHeaders[$mappingSelected[2]]];
                $mapPhone = $data[$csvHeaders[$mappingSelected[3]]];
                $mapMobile = $data[$csvHeaders[$mappingSelected[4]]];
                $mapFax = $data[$csvHeaders[$mappingSelected[5]]];
                $mapWebsite = $data[$csvHeaders[$mappingSelected[6]]];
                $mapStreet = $data[$csvHeaders[$mappingSelected[7]]];
                $mapCity = $data[$csvHeaders[$mappingSelected[8]]];
                $mapState = $data[$csvHeaders[$mappingSelected[9]]];
                $mapZip = $data[$csvHeaders[$mappingSelected[10]]];
                $mapCountry = $data[$csvHeaders[$mappingSelected[11]]];
                $mapOpeningBalance = $data[$csvHeaders[$mappingSelected[12]]];
                $mapOpeningBalanceDate = $data[$csvHeaders[$mappingSelected[13]]];
                $mapTaxId = $data[$csvHeaders[$mappingSelected[14]]];

                $vendorData = [
                    'company_id' => logged('company_id'),
                    'display_name' => $mapName,
                    'company' => $mapCompanyName,
                    'email' => $mapEmail,
                    'phone' => $mapPhone,
                    'mobile' => $mapMobile,
                    'fax' => $mapFax,
                    'website' => $mapWebsite,
                    'street' => $mapStreet,
                    'city' => $mapCity,
                    'state' => $mapState,
                    'zip' => $mapZip,
                    'country' => $mapCountry,
                    'opening_balance' => $mapOpeningBalance,
                    'opening_balance_as_of_date' => $mapOpeningBalanceDate,
                    'tax_id' => $mapTaxId,
                    'status' => 1
                ];

                $insertId = $this->vendors_model->createVendor($vendorData);

                if($insertId) {
                    $inserted++;
                }
            }

            $data_arr = array("success" => TRUE, "message" => "Successfully imported ".$inserted." vendors!", "Mapping" => $mappingSelected, "CSV"=> $csvHeaders, "vendors" => $vendors);
        } else{
            $data_arr = array("success" => FALSE,"message" => 'Something goes wrong.');
        }

        die(json_encode($data_arr));
    }

    public function ajax_bill_mark_paid()
    {
        $is_success = 0;
        $msg = 'Cannot find data';

        $post = $this->input->post();
        $bill = $this->vendors_model->get_bill_by_id($post['bill_id']);
        if( $bill ){
            $data = ['status' => 2];
            $this->vendors_model->update_bill($post['bill_id'], $data);

            $is_success = 1;
            $msg = '';
        }

        $json_data = [
            'is_success' => $is_success, 
            'msg' => $msg
        ];

        echo json_encode($json_data);
    }

    public function ajax_save_vendor()
    {
        $is_success = 0;
        $msg = 'Cannot create data';
        $vendor_id = 0;
        $vendor_name = '';

        $new_data = array(
            'company_id' =>logged('company_id'),
            'title' => $this->input->post('title'),
            'f_name' => $this->input->post('f_name'),
            'm_name' => $this->input->post('m_name'),
            'l_name' => $this->input->post('l_name'),
            'suffix' => $this->input->post('suffix'),
            'email' => $this->input->post('email'),
            'company' => $this->input->post('company'),
            'display_name' => $this->input->post('display_name'),
            'to_display' => $this->input->post('use_display_name'),
            'print_on_check_name' => $this->input->post('use_display_name') === "1" ? $this->input->post('display_name') : $this->input->post('print_on_check_name'),
            'street' => $this->input->post('street'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'mobile' => $this->input->post('mobile'),
            'fax' => $this->input->post('fax'),
            'website' => $this->input->post('website'),
            'billing_rate' => $this->input->post('billing_rate'),
            'terms' => $this->input->post('terms'),
            'opening_balance' => $this->input->post('opening_balance'),
            'opening_balance_as_of_date' => date("Y-m-d", strtotime($this->input->post('opening_balance_as_of_date'))),
            'account_number' => $this->input->post('account_number'),
            'tax_id' => $this->input->post('tax_id'),
            'default_expense_account' => $this->input->post('default_expense_account'),
            'notes' => $this->input->post('notes'),
            'status' => 1,
            'created_by' => logged('id')
        );

        $addQuery = $this->vendors_model->createVendor($new_data);

        if ($addQuery > 0) {
            $attachments = $this->input->post('attachments');
            if (isset($attachments) && is_array($attachments)) {
                $order = 1;
                foreach ($attachments as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Vendor',
                        'attachment_id' => $attachmentId,
                        //'linked_id' => $vendorId,
                        'linked_id' => $addQuery,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $is_success = 1;
            $msg = '';

            $vendor_id = $addQuery;
            $vendor_name = $this->input->post('f_name') . ' ' . $this->input->post('l_name');
        }

        $return = [
            'is_success' => $is_success,
            'msg' => $msg,
            'vendor_id' => $vendor_id,
            'vendor_name' => $vendor_name
        ];

        echo json_encode($return);
    }
}
