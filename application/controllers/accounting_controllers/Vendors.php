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
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js",
            "assets/js/accounting/sales/customer_sales_receipt_modal.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js",
            "assets/js/accounting/sales/customer_includes/create_charge.js",
        ));

        $this->page_data['menu_name'] =
            array(
                // array("Dashboard",	array()),
                // array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Cash Flow",   array()),
                array("Expenses",   array('Expenses','Vendors')),
                array("Sales",      array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll",    array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",    array()),
                array("Taxes",      array("Sales Tax","Payroll Tax")),
                // array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                // array('/accounting/banking',array()),
                // array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array('/accounting/cashflowplanner',array()),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', '/accounting/jobs')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",   array('/accounting/salesTax','/accounting/payrollTax')),
                // array('#',  array()),
                array("",   array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");

        $this->page_data['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/expenses/vendors.js"
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

        $this->page_data['paidTransactions'] = count($billPayments) + count($expenses) + count($checks) + count($creditCardPayments);
        $this->page_data['purchaseOrders'] = count($openPurchaseOrders);
        $this->page_data['openBills'] = count($openBills);
        $this->page_data['overdueBills'] = count($overdueBills);
        $this->page_data['terms'] = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));
        $this->page_data['expenseAccs'] = $this->chart_of_accounts_model->get_expense_accounts();
        $this->page_data['otherExpenseAccs'] = $this->chart_of_accounts_model->get_other_expense_accounts();
        $this->page_data['cogsAccs'] = $this->chart_of_accounts_model->get_cogs_accounts();
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Vendors";
        $this->load->view('accounting/vendors/index', $this->page_data);
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
            'print_on_check_name' => $this->input->post('use_display_name') === "1" ? $this->input->post('use_display_name') : $this->input->post('print_on_check_name'),
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
            'attachments' => !is_null($this->input->post('attachments')) ? json_encode($this->input->post('attachments')) : null,
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->vendors_model->createVendor($new_data);

        if ($addQuery > 0) {
            $this->session->set_flashdata('success', "New vendor successfully added!");
        } else {
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect("accounting/vendors");
    }

    public function view($vendorId)
    {
        add_footer_js(array(
            "assets/js/accounting/expenses/view-vendor.js"
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
        $this->page_data['page_title'] = "Vendors";
        $this->load->view('accounting/vendors/view', $this->page_data);
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
                'status' => 0,
                'updated_at' => date("Y-m-d H:i:s")
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

    public function update($vendorId)
    {
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
            'opening_balance' => $this->input->post('opening_balance'),
            'opening_balance_as_of_date' => date("Y-m-d", strtotime($this->input->post('opening_balance_as_of_date'))),
            'account_number' => $this->input->post('account_number') !== "" ? $this->input->post('account_number') : null,
            'tax_id' => $this->input->post('tax_id'),
            'default_expense_account' => $this->input->post('default_expense_account'),
            'notes' => $this->input->post('notes'),
            'attachments' => $this->input->post('attachments') !== null ? json_encode($this->input->post('attachments')) : null,
            'updated_at' => date("Y-m-d H:i:s")
        );

        $update = $this->vendors_model->updateVendor($vendorId, $data);

        if ($update) {
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
            $vendor = $this->vendors_model->get_vendor_by_id($vendorId);

            if ($vendor->attachments !== null && $vendor->attachments !== "") {
                foreach (json_decode($vendor->attachments, true) as $attachment) {
                    array_unshift($insert, $attachment);
                }
            }

            $update = $this->vendors_model->updateVendor($vendorId, ['attachments' => json_encode($insert)]);

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
        $attachments = json_decode($vendor->attachments, true);
        $attachmentKey = array_search($attachmentId, $attachments);
        unset($attachments[$attachmentKey]);

        $attachments = count($attachments) > 0 ? json_encode($attachments) : null;

        $update = $this->vendors_model->updateVendor($vendorId, ['attachments' => $attachments]);

        $return = [
            'data' => $vendorId,
            'success' => $update
        ];

        echo json_encode($return);
    }

    private function uploadFile($files)
    {
        $this->load->helper('string');
        $data = [];
        foreach ($files['name'] as $key => $name) {
            $extension = end(explode('.', $name));

            do {
                $randomString = random_string('alnum');
                $fileNameToStore = $randomString . '.' .$extension;
                $exists = file_exists('./uploads/accounting/attachments/'.$fileNameToStore);
            } while ($exists);

            $fileType = explode('/', $files['type'][$key]);
            $uploadedName = str_replace('.'.$extension, '', $name);

            $data[] = [
                'company_id' => getLoggedCompanyID(),
                'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
                'uploaded_name' => $uploadedName,
                'stored_name' => $fileNameToStore,
                'file_extension' => $extension,
                'size' => $files['size'][$key],
                'notes' => null,
                'status' => 1,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s')
            ];

            move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$fileNameToStore);
        }

        $attachmentIds = [];
        foreach ($data as $attachment) {
            $attachmentIds[] = $this->accounting_attachments_model->create($attachment);
        }

        return $attachmentIds;
    }

    public function get_vendor_attachments($vendorId)
    {
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);
        $attachments = json_decode($vendor->attachments, true);
        
        $attached = [];
        if ($attachments !== null && count($attachments) > 0) {
            foreach ($attachments as $attachment) {
                $attached[] = $this->accounting_attachments_model->getById($attachment);
            }
        }

        echo json_encode($attached);
    }

    public function load_transactions($vendorId)
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $order = $post['order'][0]['dir'];
        $orderColumn = $post['order'][0]['column'];
        $columnName = $post['columns'][$orderColumn]['name'];
        $start = $post['start'];
        $limit = $post['length'];
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

        $data = $this->get_transactions($vendorId, $filters);

        usort($data, function ($a, $b) use ($order, $columnName) {
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

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    private function get_transactions($vendorId, $filters)
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
                if (!is_null($bill->attachments) && $bill->attachments !== "") {
                    $attachmentIds = json_decode($bill->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
                }

                $transactions[] = [
                    'id' => $bill->id,
                    'date' => date("m/d/Y", strtotime($bill->bill_date)),
                    'type' => 'Bill',
                    'number' => $bill->bill_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($bill->id, 'Bill'),
                    'memo' => $bill->memo,
                    'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                    'balance' => number_format(floatval($bill->remaining_balance), 2, '.', ','),
                    'total' => number_format(floatval($bill->total_amount), 2, '.', ','),
                    'status' => $bill->status === "2" ? "Paid" : "Open",
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($bill->created_at))
                ];
            }
        }

        if (isset($billPayments) && count($billPayments) > 0) {
            foreach ($billPayments as $payment) {
                if (!is_null($payment->attachments) && $payment->attachments !== "") {
                    $attachmentIds = json_decode($payment->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
                }

                $paymentAcc = $this->chart_of_accounts_model->getById($payment->payment_account_id);
                $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
                $paymentType = $paymentAccType->account_name === 'Bank' ? 'Check' : 'Credit Card';

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
                    'balance' => '0.00',
                    'total' => '-'.number_format(floatval($payment->total_amount), 2, '.', ','),
                    'status' => $payment->status === "4" ? 'Voided' : 'Applied',
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($payment->created_at))
                ];
            }
        }

        if (isset($checks) && count($checks) > 0) {
            foreach ($checks as $check) {
                if (!is_null($check->attachments) && $check->attachments !== "") {
                    $attachmentIds = json_decode($check->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
                }

                $transactions[] = [
                    'id' => $check->id,
                    'date' => date("m/d/Y", strtotime($check->payment_date)),
                    'type' => 'Check',
                    'number' => $check->check_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($check->id, 'Check'),
                    'memo' => $check->memo,
                    'due_date' => '',
                    'balance' => '0.00',
                    'total' => number_format(floatval($check->total_amount), 2, '.', ','),
                    'status' => $check->status === '4' ? 'Voided' : 'Paid',
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($check->created_at))
                ];
            }
        }

        if (isset($creditCardCredits) && count($creditCardCredits) > 0) {
            foreach ($creditCardCredits as $creditCardCredit) {
                if (!is_null($creditCardCredit->attachments) && $creditCardCredit->attachments !== "") {
                    $attachmentIds = json_decode($creditCardCredit->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
                }

                $transactions[] = [
                    'id' => $creditCardCredit->id,
                    'date' => date("m/d/Y", strtotime($creditCardCredit->payment_date)),
                    'type' => "Credit Card Credit",
                    'number' => $creditCardCredit->ref_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($creditCardCredit->id, 'Credit Card Credit'),
                    'memo' => $creditCardCredits->memo,
                    'due_date' => '',
                    'balance' => '0.00',
                    'total' => '-'.number_format(floatval($creditCardCredit->total_amount), 2, '.', ','),
                    'status' => '',
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($creditCardCredit->created_at))
                ];
            }
        }

        if (isset($creditCardPayments) && count($creditCardPayments) > 0) {
            foreach ($creditCardPayments as $cardPayment) {
                if (!is_null($cardPayment->attachments) && $cardPayment->attachments !== "") {
                    $attachmentIds = json_decode($cardPayment->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
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
                    'balance' => '0.00',
                    'total' => number_format(floatval($cardPayment->amount), 2, '.', ','),
                    'status' => '',
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($cardPayment->created_at))
                ];
            }
        }

        if (isset($expenses) && count($expenses) > 0) {
            foreach ($expenses as $expense) {
                if (!is_null($expense->attachments) && $expense->attachments !== "") {
                    $attachmentIds = json_decode($expense->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
                }

                $method = $this->accounting_payment_methods_model->getById($expense->payment_method_id);

                $transactions[] = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'type' => 'Expense',
                    'number' => $expense->ref_number,
                    'payee' => $vendor->display_name,
                    'method' => $method->name,
                    'source' => '',
                    'category' => $this->category_col($expense->id, 'Expense'),
                    'memo' => $expense->memo,
                    'due_date' => '',
                    'balance' => '0.00',
                    'total' => number_format(floatval($expense->total_amount), 2, '.', ','),
                    'status' => $expense->status === '4' ? 'Voided' : 'Paid',
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];
            }
        }

        if (isset($purchaseOrders) && count($purchaseOrders) > 0) {
            foreach ($purchaseOrders as $purchaseOrder) {
                if (!is_null($purchaseOrder->attachments) && $purchaseOrder->attachments !== "") {
                    $attachmentIds = json_decode($purchaseOrder->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
                }

                $transactions[] = [
                    'id' => $purchaseOrder->id,
                    'date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'type' => 'Purchase Order',
                    'number' => $purchaseOrder->purchase_order_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($purchaseOrder->id, 'Purchase Order'),
                    'memo' => $purchaseOrder->memo,
                    'due_date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'balance' => '0.00',
                    'total' => number_format(floatval($purchaseOrder->total_amount), 2, '.', ','),
                    'status' => $purchaseOrder->status === "1" ? "Open" : "Closed",
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($purchaseOrder->created_at))
                ];
            }
        }

        if (isset($vendorCredits) && count($vendorCredits) > 0) {
            foreach ($vendorCredits as $vendorCredit) {
                if (!is_null($vendorCredit->attachments) && $vendorCredit->attachments !== "") {
                    $attachmentIds = json_decode($vendorCredit->attachments, true);
                    $attachments = $this->accounting_attachments_model->get_attachments_by_ids($attachmentIds);
                } else {
                    $attachments = [];
                }

                $transactions[] = [
                    'id' => $vendorCredit->id,
                    'date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                    'type' => "Vendor Credit",
                    'number' => $vendorCredit->ref_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => $this->category_col($vendorCredit->id, 'Vendor Credit'),
                    'memo' => $vendorCredits->memo,
                    'due_date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                    'balance' => number_format(floatval($vendorCredit->remaining_balance), 2, '.', ','),
                    'total' => '-'.number_format(floatval($vendorCredit->total_amount), 2, '.', ','),
                    'status' => $vendorCredit->status === "1" ? "Unapplied" : "Applied",
                    'attachments' => $attachments,
                    'date_created' => date("m/d/Y H:i:s", strtotime($vendorCredit->created_at))
                ];
            }
        }

        return $transactions;
    }

    private function category_col($transactionId, $transactionType)
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

                    $category = '<select class="form-control" name="category[]">';

                    foreach ($accountTypes as $typeName) {
                        $accType = $this->account_model->getAccTypeByName($typeName);

                        $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

                        if (count($accounts) > 0) {
                            $category .= '<optgroup label="'.$typeName.'">';
                            foreach ($accounts as $account) {
                                $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                                if ($account->id === $expenseAcc) {
                                    $category .= '<option value="'.$account->id.'" selected>'.$account->name.'</option>';
                                } else {
                                    $category .= '<option value="'.$account->id.'">'.$account->name.'</option>';
                                }

                                if (count($childAccs) > 0) {
                                    $category .= '<optgroup label="&nbsp;&nbsp;&nbsp;Sub-account of '.$account->name.'">';

                                    foreach ($childAccs as $childAcc) {
                                        if ($childAcc->id === $expenseAcc) {
                                            $category .= '<option value="'.$childAcc->id.'" selected>&nbsp;&nbsp;&nbsp;'.$childAcc->name.'</option>';
                                        } else {
                                            $category .= '<option value="'.$childAcc->id.'">&nbsp;&nbsp;&nbsp;'.$childAcc->name.'</option>';
                                        }
                                    }

                                    $category .= '</optgroup>';
                                }
                            }
                            $category .= '</optgroup>';
                        }
                    }

                    $category .= '</select>';
                } else {
                    $itemId = $items[0]->item_id;
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($itemId);
                    $expenseAcc = $itemAccDetails->inv_asset_acc_id;
                    $category = $this->chart_of_accounts_model->getName($expenseAcc);
                }
            }
        }

        return $category;
    }

    public function update_transaction_category()
    {
        $post = $this->input->post();

        switch ($post['transaction_type']) {
            case 'bill':
                $category = $this->expenses_model->get_transaction_categories($post['transaction_id'], 'Bill');
                $category = $category[0];

                if ($category->expense_account_id !== $categoryId) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                    $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

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

                if ($category->expense_account_id !== $categoryId) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                    $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

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

                if ($category->expense_account_id !== $categoryId) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                    $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

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

                if ($category->expense_account_id !== $categoryId) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                    $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

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

                if ($category->expense_account_id !== $categoryId) {
                    $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                    $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    // revert
                    $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);
                }
            break;
        }

        $update = $this->vendors_model->update_transaction_category($post);

        echo json_encode([
            'data' => $update,
            'success' => $update ? true : false,
            'message' => $update ? "Successfully updated!" : "Unexpected Error"
        ]);
    }

    public function delete_transaction($transactionType, $transactionId)
    {
        switch ($transactionType) {
            case 'expense':
                $delete = $this->delete_expense($transactionId);
            break;
            case 'check':
                $delete = $this->delete_check($transactionId);
            break;
            case 'bill':
                $delete = $this->delete_bill($transactionId);
            break;
            case 'purchase-order':
                $delete = $this->delete_purchase_order($transactionId);
            break;
            case 'vendor-credit':
                $delete = $this->delete_vendor_credit($transactionId);
            break;
            case 'credit-card-payment':
                $delete = $this->delete_cc_payment($transactionId);
            break;
            case 'bill-payment':
                $delete = $this->delete_bill_payment($transactionId);
            break;
        }

        if ($delete) {
            $this->session->set_flashdata("success", "Transaction successfully deleted!");
        } else {
            $this->session->set_flashdata("error", "Unexpected error occured!");
        }
    }

    private function delete_expense($expenseId)
    {
        $expense = $this->vendors_model->get_expense_by_id($expenseId);

        $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
        $newBalance = floatval($paymentAcc->balance) - floatval($expense->total_amount);
        $newBalance = number_format($newBalance, 2, '.', ',');

        $paymentAccData = [
            'id' => $paymentAcc->id,
            'company_id' => logged('company_id'),
            'balance' => $newBalance
        ];

        $this->chart_of_accounts_model->updateBalance($paymentAccData);

        $categories = $this->expenses_model->get_transaction_categories($expenseId, 'Expense');
        $items = $this->expenses_model->get_transaction_items($expenseId, 'Expense');

        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $expenseAccData = [
                    'id' => $expenseAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($expenseAccData);
            }
        }

        if (count($items) > 0) {
            foreach ($items as $item) {
                $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);

                $newQty = intval($location->qty) - intval($item->quantity);

                $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);

                $itemAccDetails = $this->items_model->getItemAccountingDetails($item->item_id);

                if ($itemAccDetails) {
                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                    $newBalance = floatval($invAssetAcc->balance) - floatval($item->total);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                }
            }
        }

        $update = $this->vendors_model->update_expense($expenseId, ['status' => 0]);

        return $update;
    }

    private function delete_check($checkId)
    {
        $check = $this->vendors_model->get_check_by_id($checkId);

        $paymentAcc = $this->chart_of_accounts_model->getById($check->payment_account_id);
        $newBalance = floatval($paymentAcc->balance) + floatval($check->total_amount);
        $newBalance = number_format($newBalance, 2, '.', ',');

        $paymentAccData = [
            'id' => $paymentAcc->id,
            'company_id' => logged('company_id'),
            'balance' => $newBalance
        ];

        $this->chart_of_accounts_model->updateBalance($paymentAccData);

        $categories = $this->expenses_model->get_transaction_categories($checkId, 'Check');
        $items = $this->expenses_model->get_transaction_items($checkId, 'Check');

        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $expenseAccData = [
                    'id' => $expenseAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($expenseAccData);
            }
        }

        if (count($items) > 0) {
            foreach ($items as $item) {
                $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);

                $newQty = intval($location->qty) - intval($item->quantity);

                $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);

                $itemAccDetails = $this->items_model->getItemAccountingDetails($item->item_id);

                if ($itemAccDetails) {
                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                    $newBalance = floatval($invAssetAcc->balance) - floatval($item->total);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                }
            }
        }

        $update = $this->vendors_model->update_check($checkId, ['status' => 0]);

        return $update;
    }

    private function delete_bill($billId)
    {
        $categories = $this->expenses_model->get_transaction_categories($billId, 'Bill');
        $items = $this->expenses_model->get_transaction_items($billId, 'Bill');

        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $expenseAccData = [
                    'id' => $expenseAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($expenseAccData);
            }
        }

        if (count($items) > 0) {
            foreach ($items as $item) {
                $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);

                $newQty = intval($location->qty) - intval($item->quantity);

                $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);

                $itemAccDetails = $this->items_model->getItemAccountingDetails($item->item_id);

                if ($itemAccDetails) {
                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                    $newBalance = floatval($invAssetAcc->balance) - floatval($item->total);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                }
            }
        }

        $update = $this->vendors_model->update_bill($billId, ['status' => 0]);

        return $update;
    }

    private function delete_purchase_order($purchaseOrderId)
    {
        $items = $this->expenses_model->get_transaction_items($purchaseOrderId, 'Check');

        if (count($items) > 0) {
            foreach ($items as $item) {
                $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);

                $newQty = intval($location->qty) - intval($item->quantity);

                $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);
            }
        }

        $update = $this->vendors_model->update_purchase_order($purchaseOrderId, ['status' => 0]);

        return $update;
    }

    private function delete_vendor_credit($vendorCreditId)
    {
        $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($vendorCreditId);
        $vendor = $this->vendors_model->get_vendor_by_id($vendorCredit->vendor_id);

        if ($vendor->vendor_credits === null & $vendor->vendor_credits === "") {
            $vendorCredits = floatval($vendorCredit->total_amount);
        } else {
            $vendorCredits = floatval($vendor->vendor_credits) - floatval($vendorCredit->total_amount);
        }

        $vendorData = [
            'vendor_credits' => number_format($vendorCredits, 2, '.', ',')
        ];

        $this->vendors_model->updateVendor($vendor->id, $vendorData);

        $categories = $this->expenses_model->get_transaction_categories($vendorCreditId, 'Vendor Credit');
        $items = $this->expenses_model->get_transaction_items($vendorCreditId, 'Vendor Credit');

        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $expenseAccData = [
                    'id' => $expenseAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($expenseAccData);
            }
        }

        if (count($items) > 0) {
            foreach ($items as $item) {
                $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);

                $newQty = intval($location->qty) + intval($item->quantity);

                $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);

                $itemAccDetails = $this->items_model->getItemAccountingDetails($item->item_id);

                if ($itemAccDetails) {
                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                    $newBalance = floatval($invAssetAcc->balance) + floatval($item->total);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                }
            }
        }

        $update = $this->vendors_model->update_vendor_credit($vendorCreditId, ['status' => 0]);

        return $update;
    }

    private function delete_cc_payment($ccPaymentId)
    {
        $ccPayment = $this->vendors_model->get_credit_card_payment_by_id($ccPaymentId);

        $creditAcc = $this->chart_of_accounts_model->getById($ccPayment->credit_card_id);

        $creditAccBal = floatval($creditAcc->balance) + floatval($ccPayment->amount);
        $creditAccBal = number_format($creditAccBal, 2, '.', ',');

        $this->chart_of_accounts_model->updateBalance(['id' => $creditAcc->id, 'company_id' => logged('company_id'), 'balance' => $creditAccBal]);

        $bankAcc = $this->chart_of_accounts_model->getById($ccPayment->bank_account_id);

        $bankAccBal = floatval($bankAcc->balance) + floatval($ccPayment->amount);
        $bankAccBal = number_format($bankAccBal, 2, '.', ',');

        $this->chart_of_accounts_model->updateBalance(['id' => $bankAcc->id, 'company_id' => logged('company_id'), 'balance' => $bankAccBal]);


        $update = $this->vendors_model->update_credit_card_payment($ccPaymentId, ['status' => 0]);

        return $update;
    }

    private function delete_bill_payment($billPaymentId)
    {
        $billPayment = $this->vendors_model->get_bill_payment_by_id($billPaymentId);

        $billPaymentData = [
            'vendor_credits_applied' => null,
            'status' => 0,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_bill_payment($billPaymentId, $billPaymentData);

        if ($update) {
            $vCredits = !is_null($billPayment->vendor_credits_applied) ? json_decode($billPayment->vendor_credits_applied, true) : null;
            if (!is_null($vCredits)) {
                foreach ($vCredits as $vCreditId => $amount) {
                    $vCredit = $this->vendors_model->get_vendor_credit_by_id($vCreditId);
                    $vCreditData = [
                        'status' => 1,
                        'remaining_balance' => floatval($vCredit->remaining_balance) + floatval($amount),
                        'updated_at' => date("Y-m-d H:i:s")
                    ];

                    $this->vendors_model->update_vendor_credit($vCredit->id, $vCreditData);
                }
            }

            $paymentItems = $this->vendors_model->get_bill_payment_items($billPaymentId);
            foreach ($paymentItems as $paymentItem) {
                $bill = $this->expenses_model->get_bill_data($paymentItem->bill_id);

                $billData = [
                    'remaining_balance' => floatval($bill->remaining_balance) + floatval($paymentItem->total_amount),
                    'status' => 1,
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $this->expenses_model->update_bill_data($bill->id, $billData);
            }
    
            $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
    
            if ($paymentAccType->account_name === 'Credit Card') {
                $newBalance = floatval($paymentAcc->balance) - floatval($paymentTotal);
            } else {
                $newBalance = floatval($paymentAcc->balance) + floatval($paymentTotal);
            }
    
            $newBalance = number_format($newBalance, 2, '.', ',');
    
            $paymentAccData = [
                'id' => $paymentAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($paymentAccData);

            $this->vendors_model->delete_bill_payment_items($billPaymentId);
        }

        return $update;
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

    public function view_expense($expenseId)
    {
        $expense = $this->vendors_model->get_expense_by_id($expenseId);

        $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);

        $selectedBalance = $paymentAcc->balance;
        if (strpos($selectedBalance, '-') !== false) {
            $balance = str_replace('-', '', $selectedBalance);
            $selectedBalance = '-$'.number_format(floatval($balance), 2, '.', ',');
        } else {
            $selectedBalance = '$'.number_format(floatval($selectedBalance), 2, '.', ',');
        }

        $categories = $this->expenses_model->get_transaction_categories($expenseId, 'Expense');
        $items = $this->expenses_model->get_transaction_items($expenseId, 'Expense');

        $this->page_data['expense'] = $expense;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['balance'] = $selectedBalance;
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();

        $this->load->view('accounting/vendors/view_expense', $this->page_data);
    }

    public function get_transaction_attachments($transactionType, $transactionId)
    {
        switch ($transactionType) {
            case 'expense':
                $transaction = $this->vendors_model->get_expense_by_id($transactionId);
            break;
            case 'check':
                $transaction = $this->vendors_model->get_check_by_id($transactionId);
            break;
            case 'bill':
                $transaction = $this->vendors_model->get_bill_by_id($transactionId);
            break;
            case 'purchase-order':
                $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId);
            break;
            case 'vendor-credit':
                $transaction = $this->vendors_model->get_vendor_credit_by_id($transactionId);
            break;
            case 'credit-card-payment':
                $transaction = $this->vendors_model->get_credit_card_payment_by_id($transactionId);
            break;
            case 'credit-card-credit':
                $transaction = $this->vendors_model->get_credit_card_credit_by_id($transactionId);
            break;
            case 'bill-payment':
                $transaction = $this->vendors_model->get_bill_payment_by_id($transactionId);
            break;
        }

        $attachments = json_decode($transaction->attachments, true);

        $attached = [];
        if ($attachments !== null && count($attachments) > 0) {
            foreach ($attachments as $attachment) {
                $attached[] = $this->accounting_attachments_model->getById($attachment);
            }
        }

        echo json_encode($attached);
    }

    public function view_check($checkId)
    {
        $check = $this->vendors_model->get_check_by_id($checkId);

        $bankAcc = $this->chart_of_accounts_model->getById($check->bank_account_id);

        $selectedBalance = $bankAcc->balance;
        if (strpos($selectedBalance, '-') !== false) {
            $balance = str_replace('-', '', $selectedBalance);
            $selectedBalance = '-$'.number_format(floatval($balance), 2, '.', ',');
        } else {
            $selectedBalance = '$'.number_format(floatval($selectedBalance), 2, '.', ',');
        }

        $categories = $this->expenses_model->get_transaction_categories($checkId, 'Check');
        $items = $this->expenses_model->get_transaction_items($checkId, 'Check');

        $this->page_data['check'] = $check;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['balance'] = $selectedBalance;

        $this->load->view('accounting/vendors/view_check', $this->page_data);
    }

    public function view_bill($billId)
    {
        $bill = $this->vendors_model->get_bill_by_id($billId);
        $term = $this->accounting_terms_model->getById($bill->term_id);

        $billPayments = $this->vendors_model->get_bill_payments_by_bill_id($billId);

        $totalPayment = 0.00;
        foreach ($billPayments as $billPayment) {
            $paymentItems = $this->vendors_model->get_bill_payment_items($billPayment->id);

            foreach ($paymentItems as $paymentItem) {
                if ($paymentItem->bill_id === $billId) {
                    $totalPayment += floatval($paymentItem->total_amount);
                }
            }
        }

        $categories = $this->expenses_model->get_transaction_categories($billId, 'Bill');
        $items = $this->expenses_model->get_transaction_items($billId, 'Bill');

        $this->page_data['bill_payments'] = $billPayments;
        $this->page_data['total_payment'] = number_format(floatval($totalPayment), 2, '.', ',');
        $this->page_data['due_date'] = date("m/d/Y", strtotime($bill->due_date));
        $this->page_data['bill'] = $bill;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['term'] = $term;

        $this->load->view('accounting/vendors/view_bill', $this->page_data);
    }

    public function view_purchase_order($purchOrderId)
    {
        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($purchOrderId);

        $categories = $this->expenses_model->get_transaction_categories($purchOrderId, 'Purchase Order');
        $items = $this->expenses_model->get_transaction_items($purchOrderId, 'Purchase Order');

        $this->page_data['purchaseOrder'] = $purchaseOrder;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;

        $this->load->view('accounting/vendors/view_purchase_order', $this->page_data);
    }

    public function view_vendor_credit($vendorCreditId)
    {
        $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($vendorCreditId);

        $categories = $this->expenses_model->get_transaction_categories($vendorCreditId, 'Vendor Credit');
        $items = $this->expenses_model->get_transaction_items($vendorCreditId, 'Vendor Credit');

        $this->page_data['vendorCredit'] = $vendorCredit;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;

        $this->load->view('accounting/vendors/view_vendor_credit', $this->page_data);
    }

    public function view_cc_payment($ccPaymentId)
    {
        $ccPayment = $this->vendors_model->get_credit_card_payment_by_id($ccPaymentId);

        $this->page_data['ccPayment'] = $ccPayment;

        $this->load->view('accounting/vendors/view_credit_card_payment', $this->page_data);
    }

    public function view_cc_credit($ccCreditId)
    {
        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($ccCreditId);

        $creditCard = $this->chart_of_accounts_model->getById($ccCredit->bank_credit_account_id);

        $selectedBalance = $creditCard->balance;
        if (strpos($selectedBalance, '-') !== false) {
            $balance = str_replace('-', '', $selectedBalance);
            $selectedBalance = '-$'.number_format(floatval($balance), 2, '.', ',');
        } else {
            $selectedBalance = '$'.number_format(floatval($selectedBalance), 2, '.', ',');
        }

        $categories = $this->expenses_model->get_transaction_categories($ccCreditId, 'Credit Card Credit');
        $items = $this->expenses_model->get_transaction_items($ccCreditId, 'Credit Card Credit');

        $this->page_data['ccCredit'] = $ccCredit;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['balance'] = $selectedBalance;

        $this->load->view('accounting/vendors/view_credit_card_credit', $this->page_data);
    }

    public function view_bill_payment($billPaymentId, $vendorId)
    {
        $billPayment = $this->vendors_model->get_bill_payment_by_id($billPaymentId);
        $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);

        $selectedBalance = $paymentAcc->balance;
        if (strpos($selectedBalance, '-') !== false) {
            $balance = str_replace('-', '', $selectedBalance);
            $selectedBalance = '-$'.number_format(floatval($balance), 2, '.', ',');
        } else {
            $selectedBalance = '$'.number_format(floatval($selectedBalance), 2, '.', ',');
        }

        $this->page_data['billPayment'] = $this->vendors_model->get_bill_payment_by_id($billPaymentId);
        $this->page_data['vendor'] = $this->vendors_model->get_vendor_by_id($vendorId);
        $this->page_data['balance'] = $selectedBalance;

        $this->load->view('accounting/vendors/view_bill_payment', $this->page_data);
    }

    public function load_bill_payment_bills($vendorId, $billPaymentId)
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $start = $post['start'];
        $limit = $post['length'];
        $fromDate = $post['from'];
        $toDate = $post['to'];
        $search = $post['search'];

        $filters = [
            'from' => $fromDate !== "" ? date("Y-m-d", strtotime($fromDate)) : null,
            'to' => $toDate !== "" ? date("Y-m-d", strtotime($toDate)) : null,
            'overdue' => $post['overdue']
        ];

        $billPayment = $this->vendors_model->get_bill_payment_by_id($billPaymentId);
        $bills = $this->vendors_model->get_bill_payment_bills_by_vendor_id($billPaymentId, $vendorId, $filters);

        $filters = [
            'start-date' => $fromDate !== "" ? date("Y-m-d", strtotime($fromDate)) : null,
            'end-date' => $toDate !== "" ? date("Y-m-d", strtotime($toDate)) : null,
            'overdue' => $post['overdue']
        ];
        $openBills = $this->vendors_model->get_vendor_open_bills($billPayment->payee_id, $filters);

        $data = [];
        foreach ($bills as $bill) {
            $paymentData = $this->vendors_model->get_bill_payment_item_by_bill_id($billPaymentId, $bill->id);
            $description = '<a href="#" class="text-info" data-id="'.$bill->id.'">Bill ';
            $description .= $bill->bill_no !== "" && !is_null($bill->bill_no) ? '# '.$bill->bill_no.' ' : '';
            $description .= '</a>';
            $description .= '('.date("m/d/Y", strtotime($bill->bill_date)).')';

            if ($search !== "") {
                if (stripos($bill->bill_no, $search) !== false) {
                    $data[] = [
                        'id' => $bill->id,
                        'description' => $description,
                        'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                        'original_amount' => number_format(floatval($bill->total_amount), 2, '.', ','),
                        'open_balance' => number_format(floatval($bill->remaining_balance) + floatval($paymentData->total_amount), 2, '.', ','),
                        'payment' => number_format(floatval($paymentData->total_amount), 2, '.', ','),
                        'selected' => true
                    ];
                }
            } else {
                $data[] = [
                    'id' => $bill->id,
                    'description' => $description,
                    'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                    'original_amount' => number_format(floatval($bill->total_amount), 2, '.', ','),
                    'open_balance' => number_format(floatval($bill->remaining_balance) + floatval($paymentData->total_amount), 2, '.', ','),
                    'payment' => number_format(floatval($paymentData->total_amount), 2, '.', ','),
                    'selected' => true
                ];
            }
        }

        if (count($openBills) > 0) {
            foreach ($openBills as $bill) {
                $description = '<a href="#" class="text-info" data-id="'.$bill->id.'">Bill ';
                $description .= $bill->bill_no !== "" && !is_null($bill->bill_no) ? '# '.$bill->bill_no.' ' : '';
                $description .= '</a>';
                $description .= '('.date("m/d/Y", strtotime($bill->bill_date)).')';

                if ($search !== "") {
                    if (stripos($bill->bill_no, $search) !== false) {
                        $data[] = [
                            'id' => $bill->id,
                            'description' => $description,
                            'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                            'original_amount' => number_format(floatval($bill->total_amount), 2, '.', ','),
                            'open_balance' => number_format(floatval($bill->remaining_balance), 2, '.', ','),
                            'payment' => '',
                            'selected' => false
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $bill->id,
                        'description' => $description,
                        'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                        'original_amount' => number_format(floatval($bill->total_amount), 2, '.', ','),
                        'open_balance' => number_format(floatval($bill->remaining_balance), 2, '.', ','),
                        'payment' => '',
                        'selected' => false
                    ];
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($bills),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function load_bill_payment_credits($vendorId, $billPaymentId)
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $start = $post['start'];
        $limit = $post['length'];
        $fromDate = $post['from'];
        $toDate = $post['to'];
        $search = $post['search'];

        $filters = [
            'from' => $fromDate !== "" ? date("Y-m-d", strtotime($fromDate)) : null,
            'to' => $toDate !== "" ? date("Y-m-d", strtotime($toDate)) : null,
        ];

        $billPayment = $this->vendors_model->get_bill_payment_by_id($billPaymentId);
        $credits = json_decode($billPayment->vendor_credits_applied, true);
        $openCredits = $this->expenses_model->get_vendor_unapplied_vendor_credits($billPayment->payee_id);

        $data = [];
        foreach ($credits as $creditId => $creditAmount) {
            $credit = $this->vendors_model->get_vendor_credit_by_id($creditId);

            $description = '<a href="#" class="text-info" data-id="'.$credit->id.'">Vendor Credit ';
            $description .= $credit->ref_no !== "" && !is_null($credit->ref_no) ? '# '.$credit->ref_no.' ' : '';
            $description .= '</a>';
            $description .= '('.date("m/d/Y", strtotime($credit->payment_date)).')';

            if ($search !== "") {
                if (stripos($credit->ref_no, $search) !== false) {
                    $data[] = [
                        'id' => $credit->id,
                        'description' => $description,
                        'due_date' => date("m/d/Y", strtotime($credit->due_date)),
                        'original_amount' => number_format(floatval($credit->total_amount), 2, '.', ','),
                        'open_balance' => number_format(floatval($credit->remaining_balance) + floatval($creditAmount), 2, '.', ','),
                        'payment' => number_format(floatval($creditAmount), 2, '.', ','),
                        'selected' => true
                    ];
                }
            } else {
                $data[] = [
                    'id' => $credit->id,
                    'description' => $description,
                    'due_date' => date("m/d/Y", strtotime($credit->due_date)),
                    'original_amount' => number_format(floatval($credit->total_amount), 2, '.', ','),
                    'open_balance' => number_format(floatval($credit->remaining_balance) + floatval($creditAmount), 2, '.', ','),
                    'payment' => number_format(floatval($creditAmount), 2, '.', ','),
                    'selected' => true
                ];
            }
        }

        if (count($openCredits) > 0) {
            foreach ($openCredits as $credit) {
                $description = '<a href="#" class="text-info" data-id="'.$credit->id.'">Vendor Credit ';
                $description .= $credit->ref_no !== "" && !is_null($credit->ref_no) ? '# '.$credit->ref_no.' ' : '';
                $description .= '</a>';
                $description .= '('.date("m/d/Y", strtotime($credit->payment_date)).')';

                if (array_search($credit->id, array_column($data, 'id')) === false) {
                    if ($search !== "") {
                        if (stripos($credit->ref_no, $search) !== false) {
                            $data[] = [
                                'id' => $credit->id,
                                'description' => $description,
                                'due_date' => date("m/d/Y", strtotime($credit->due_date)),
                                'original_amount' => number_format(floatval($credit->total_amount), 2, '.', ','),
                                'open_balance' => number_format(floatval($credit->remaining_balance), 2, '.', ','),
                                'payment' => '',
                                'selected' => false
                            ];
                        }
                    } else {
                        $data[] = [
                            'id' => $credit->id,
                            'description' => $description,
                            'due_date' => date("m/d/Y", strtotime($credit->due_date)),
                            'original_amount' => number_format(floatval($credit->total_amount), 2, '.', ','),
                            'open_balance' => number_format(floatval($credit->remaining_balance), 2, '.', ','),
                            'payment' => '',
                            'selected' => false
                        ];
                    }
                }
            }
        }

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($credits),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function update_transaction($vendorId, $transactionType, $transactionId)
    {
        $data = $this->input->post();

        switch ($transactionType) {
            case 'expense':
                $return = $this->update_expense($transactionId, $data);
            break;
            case 'check':
                $return = $this->update_check($transactionId, $data);
            break;
            case 'bill':
                $return = $this->update_bill($transactionId, $data);
            break;
            case 'purchase-order':
                $return = $this->update_purchase_order($transactionId, $data);
            break;
            case 'vendor-credit':
                $return = $this->update_vendor_credit($transactionId, $data);
            break;
            case 'credit-card-credit':
                $return = $this->update_credit_card_credit($transactionId, $data);
            break;
            case 'bill-payment':
                $return = $this->update_bill_payment($transactionId, $data);
            break;
        }

        echo json_encode($return);
    }

    private function update_expense($expenseId, $data)
    {
        $expense = $this->vendors_model->get_expense_by_id($expenseId);
        $payee = explode('-', $data['payee']);
        $expenseData = [
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'payment_account_id' => $data['expense_payment_account'],
            'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
            'payment_method_id' => $data['payment_method'],
            'ref_no' => $data['ref_no'],
            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
            'memo' => $data['memo'],
            'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
            'total_amount' => $data['total_amount'],
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_expense($expenseId, $expenseData);

        if ($update) {
            if ($data['payment_account'] !== $expense->payment_account_id) {
                $newPaymentAcc = $this->chart_of_accounts_model->getById($data['payment_account']);
                $newBalance = floatval($newPaymentAcc->balance) + floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');
    
                $newPaymentAccData = [
                    'id' => $newPaymentAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($newPaymentAccData);
    
                $oldPaymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
                $revertBalance = floatval($oldPaymentAcc->balance) - floatval($expense->total_amount);
                $revertBalance = number_format($revertBalance, 2, '.', ',');
    
                $oldPaymentAccData = [
                    'id' => $newPaymentAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $revertBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($oldPaymentAccData);
            }
    
            if ($data['total_amount'] !== $expense->total_amount && $data['payment_account'] === $expense->payment_account_id) {
                $paymentAcc = $this->chart_of_accounts_model->getById($data['payment_account']);
                $newBalance = floatval($paymentAcc->balance) - floatval($expense->total_amount);
                $newBalance = $newBalance + floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');
    
                $paymentAccData = [
                    'id' => $paymentAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($paymentAccData);
            }
    
            $this->update_categories('Expense', $expenseId, $data);
            $this->update_items('Expense', $expenseId, $data);
        }

        return [
            'data' => $expenseId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];
    }

    private function update_check($checkId, $data)
    {
        $check = $this->vendors_model->get_check_by_id($checkId);
        $payee = explode('-', $data['payee']);

        $checkData = [
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'bank_account_id' => $data['bank_account'],
            'mailing_address' => nl2br($data['mailing_address']),
            'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
            'check_no' => isset($data['print_later']) ? null : $data['check_no'] === '' ? null : $data['check_no'],
            'to_print' => $data['print_later'],
            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
            'memo' => $data['memo'],
            'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
            'total_amount' => $data['total_amount'],
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_check($checkId, $checkData);

        if ($update) {
            if (!is_null($checkData['check_no']) && !is_null($check->check_no)) {
                $assignCheck = [
                    'check_no' => $checkData['check_no'],
                    'transaction_type' => 'check',
                    'transaction_id' => $checkId,
                    'payment_account_id' => $checkData['bank_account_id'],
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $this->accounting_assigned_checks_model->update_check_no($assignCheck);
            } elseif (is_null($check->check_no) && !is_null($checkData['check_no'])) {
                $assignCheck = [
                    'check_no' => $checkData['check_no'],
                    'transaction_type' => 'check',
                    'transaction_id' => $checkId,
                    'payment_account_id' => $checkData['bank_account_id'],
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $this->accounting_assigned_checks_model->assign_check_no($assignCheck);
            } elseif (!is_null($check->check_no) && is_null($checkData['check_no'])) {
                $assignCheck = [
                    'check_no' => $checkData['check_no'],
                    'transaction_type' => 'check',
                    'transaction_id' => $checkId,
                    'payment_account_id' => $checkData['bank_account_id']
                ];

                $this->accounting_assigned_checks_model->unassign_check_no($assignCheck);
            }

            if ($data['bank_account'] !== $check->bank_account_id) {
                $newBankAcc = $this->chart_of_accounts_model->getById($data['bank_account']);
                $newBalance = floatval($newBankAcc->balance) - floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');
    
                $newBankAccData = [
                    'id' => $newBankAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($newBankAccData);
    
                $oldBankAcc = $this->chart_of_accounts_model->getById($check->bank_account_id);
                $revertBalance = floatval($oldBankAcc->balance) + floatval($check->total_amount);
                $revertBalance = number_format($revertBalance, 2, '.', ',');
    
                $oldBankAccData = [
                    'id' => $newPaymentAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $revertBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($oldBankAccData);
            }
    
            if ($data['total_amount'] !== $check->total_amount && $data['bank_account'] === $check->bank_account_id) {
                $bankAcc = $this->chart_of_accounts_model->getById($data['bank_account']);
                $newBalance = floatval($bankAcc->balance) - floatval($check->total_amount);
                $newBalance = $newBalance + floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');
    
                $bankAccData = [
                    'id' => $bankAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($bankAccData);
            }
    
            $this->update_categories('Check', $checkId, $data);
            $this->update_items('Check', $checkId, $data);
        }

        return [
            'data' => $checkId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];
    }

    private function update_bill($billId, $data)
    {
        $billData = [
            'vendor_id' => $data['vendor_id'],
            'mailing_address' => $data['mailing_address'],
            'term_id' => $data['term_id'],
            'bill_date' => date("Y-m-d", strtotime($data['bill_date'])),
            'due_date' => date("Y-m-d", strtotime($data['due_date'])),
            'bill_no' => $data['bill_no'] !== "" ? $data['bill_no'] : null,
            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
            'memo' => $data['memo'],
            'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
            'remaining_balance' => $data['total_amount'],
            'total_amount' => $data['total_amount'],
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_bill($billId, $billData);

        if ($update) {
            $this->update_categories('Bill', $billId, $data);
            $this->update_items('Bill', $billId, $data);
        }

        return [
            'data' => $billId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];
    }

    private function update_purchase_order($purchaseOrderId, $data)
    {
        $purchOrder = [
            'vendor_id' => $data['vendor_id'],
            'email' => $data['email'],
            'permit_no' => $data['permit_number'] === "" ? null : $data['permit_number'],
            'mailing_address' => nl2br($data['mailing_address']),
            'customer_id' => $data['customer'],
            'shipping_address' => nl2br($data['shipping_address']),
            'purchase_order_date' => date("Y-m-d", strtotime($data['purchase_order_date'])),
            'ship_via' => $data['ship_via'],
            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
            'message_to_vendor' => $data['message_to_vendor'],
            'memo' => $data['memo'],
            'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
            'total_amount' => $data['total_amount'],
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_purchase_order($purchaseOrderId, $purchOrder);

        if ($update) {
            $this->update_categories('Purchase Order', $purchaseOrderId, $data);
            $this->update_items('Purchase Order', $purchaseOrderId, $data);
        }

        return [
            'data' => $purchaseOrderId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];
    }

    private function update_vendor_credit($vendorCreditId, $data)
    {
        $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($vendorCreditId);
        $vCredit = [
            'vendor_id' => $data['vendor_id'],
            'mailing_address' => $data['mailing_address'],
            'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
            'ref_no' => $data['ref_no'],
            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
            'memo' => $data['memo'],
            'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
            'total_amount' => $data['total_amount'],
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_vendor_credit($vendorCreditId, $vCredit);

        if ($update) {
            if ($data['vendor_id'] !== $vendorCredit->vendor_id) {
                $newVendor = $this->vendors_model->get_vendor_by_id($data['vendor_id']);

                if ($newVendor->vendor_credits === null & $newVendor->vendor_credits === "") {
                    $vendorCredits = floatval($data['total_amount']);
                } else {
                    $vendorCredits = floatval($data['total_amount']) + floatval($newVendor->vendor_credits);
                }

                $vendorData = [
                    'vendor_credits' => number_format($vendorCredits, 2, '.', ',')
                ];

                $this->vendors_model->updateVendor($newVendor->id, $vendorData);

                $oldVendor = $this->vendors_model->get_vendor_by_id($vendorCredit->vendor_id);

                if ($oldVendor->vendor_credits === null & $oldVendor->vendor_credits === "") {
                    $vendorCredits = floatval($data['total_amount']);
                } else {
                    $vendorCredits = floatval($oldVendor->vendor_credits) - floatval($vendorCredit->total_amount);
                }

                $vendorData = [
                    'vendor_credits' => number_format($vendorCredits, 2, '.', ',')
                ];

                $this->vendors_model->updateVendor($oldVendor->id, $vendorData);
            }

            if ($data['total_amount'] !== $vendorCredit->total_amount && $data['vendor_id'] === $vendorCredit->vendor_id) {
                $vendor = $this->vendors_model->get_vendor_by_id($data['vendor_id']);

                $vendorCredits = floatval($vendor->vendor_credits) - floatval($vendorCredit->total_amount);
                $vendorCredits = $vendorCredits + floatval($data['total_amount']);

                $vendorData = [
                    'vendor_credits' => number_format($vendorCredits, 2, '.', ',')
                ];

                $this->vendors_model->updateVendor($vendor->id, $vendorData);
            }

            $this->update_categories('Vendor Credit', $vendorCreditId, $data);
            $this->update_items('Vendor Credit', $vendorCreditId, $data);
        }

        return [
            'data' => $vendorCreditId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];
    }

    private function update_credit_card_credit($ccCreditId, $data)
    {
        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($ccCreditId);
        $payee = explode('-', $data['payee']);

        $creditData = [
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'bank_credit_account_id' => $data['bank_credit_account'],
            'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
            'ref_no' => $data['ref_no'] === "" ? null : $data['ref_no'],
            'tags' => $data['tags'] !== null ? json_encode($data['tags']) : null,
            'memo' => $data['memo'],
            'attachments' => $data['attachments'] !== null ? json_encode($data['attachments']) : null,
            'total_amount' => $data['total_amount'],
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_credit_card_credit($ccCreditId, $creditData);

        if ($update) {
            if ($data['bank_credit_account'] !== $ccCredit->bank_credit_account_id) {
                $newAcc = $this->chart_of_accounts_model->getById($data['bank_credit_account']);
                $newBalance = floatval($newAcc->balance) - floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');
    
                $newAccData = [
                    'id' => $newAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($newAccData);
    
                $oldAcc = $this->chart_of_accounts_model->getById($ccCredit->bank_credit_account_id);
                $revertBalance = floatval($oldAcc->balance) + floatval($ccCredit->total_amount);
                $revertBalance = number_format($revertBalance, 2, '.', ',');
    
                $oldAccData = [
                    'id' => $newPaymentAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $revertBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($oldAccData);
            }
    
            if ($data['total_amount'] !== $ccCredit->total_amount && $data['bank_credit_account'] === $ccCredit->bank_credit_account_id) {
                $bankAcc = $this->chart_of_accounts_model->getById($data['bank_credit_account']);
                $newBalance = floatval($bankAcc->balance) - floatval($ccCredit->total_amount);
                $newBalance = $newBalance + floatval($data['total_amount']);
                $newBalance = number_format($newBalance, 2, '.', ',');
    
                $bankAccData = [
                    'id' => $bankAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];
    
                $this->chart_of_accounts_model->updateBalance($bankAccData);
            }
    
            $this->update_categories('Credit Card Credit', $ccCreditId, $data);
            $this->update_items('Credit Card Credit', $ccCreditId, $data);
        }

        return [
            'data' => $ccCreditId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];
    }

    private function revert_bill_payment($billPaymentId)
    {
        $billPayment = $this->vendors_model->get_bill_payment_by_id($billPaymentId);
        $appliedCredits = json_decode($billPayment->vendor_credits_applied, true);
        $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);

        if(!is_null($appliedCredits)) {
            foreach ($appliedCredits as $creditId => $amount) {
                $amount = floatval($amount);
    
                $vCredit = $this->vendors_model->get_vendor_credit_by_id($creditId);
                $balance = floatval($vCredit->remaining_balance);
                $remainingBal = $balance + $amount;
    
                $vCreditData = [
                    'status' => 1,
                    'remaining_balance' => number_format($remainingBal, 2, '.', ','),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                $vendorData = [
                    'vendor_credits' => floatval($payee->vendor_credits) + $amount,
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                $this->vendors_model->update_vendor_credit($vCredit->id, $vCreditData);
                $this->vendors_model->updateVendor($payee->id, $vendorData);
            }
        }

        $paymentItems = $this->vendors_model->get_bill_payment_items($billPaymentId);

        foreach ($paymentItems as $paymentItem) {
            $bill = $this->expenses_model->get_bill_data($paymentItem->bill_id);

            $remainingBal = floatval($bill->remaining_balance) + floatval($paymentItem->total_amount);
            $billData = [
                'status' => 1,
                'remaining_balance' => number_format($remainingBal, 2, '.', ','),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $this->expenses_model->update_bill_data($bill->id, $billData);
        }

        $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
        $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

        if ($paymentAccType->account_name === 'Credit Card') {
            $newBalance = floatval($paymentAcc->balance) - floatval($billPayment->total_amount);
        } else {
            $newBalance = floatval($paymentAcc->balance) + floatval($billPayment->total_amount);
        }

        $paymentAccData = [
            'id' => $paymentAcc->id,
            'company_id' => logged('company_id'),
            'balance' => $newBalance
        ];

        $this->chart_of_accounts_model->updateBalance($paymentAccData);
    }

    public function update_bill_payment($billPaymentId, $data)
    {
        $this->revert_bill_payment($billPaymentId);
        if(!is_null($data['credits'])) {
            foreach ($data['credits'] as $key => $id) {
                $vCredit = $this->vendors_model->get_vendor_credit_by_id($id);
                $balance = floatval($vCredit->remaining_balance);
                $subtracted = floatval($data['credit_payment'][$key]);
                $remainingBal = $balance - $subtracted;
    
                $vCreditData = [
                    'status' => $remainingBal === 0.00 ? 2 : 1,
                    'remaining_balance' => $remainingBal,
                    'updated_at' => date("Y-m-d H:i:s")
                ];
    
                $this->vendors_model->update_vendor_credit($vCredit->id, $vCreditData);
            }

            $appliedVCredits = [];
            foreach ($data['credit_payment'] as $key => $amount) {
                $appliedVCredits[$data['credits'][$key]] = floatval($amount);
            }
        }

        $this->vendors_model->delete_bill_payment_items($billPaymentId);

        $billPayment = [
            'payment_account_id' => $data['payment_account'],
            'mailing_address' => nl2br($data['mailing_address']),
            'payment_date' => date("Y-m-d", strtotime($data['payment_date'])),
            'check_no' => is_null($data['print_later']) ? $data['ref_no'] : null,
            'to_print_check_no' => $data['print_later'],
            'total_amount' => $data['total_amount'],
            'vendor_credits_applied' => isset($appliedVCredits) && count($appliedVCredits) > 0 ? json_encode($appliedVCredits) : null,
            'status' => 1,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $update = $this->vendors_model->update_bill_payment($billPaymentId, $billPayment);

        if ($update) {
            $paymentAcc = $this->chart_of_accounts_model->getById($data['payment_account']);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

            if ($paymentAccType->account_name === 'Credit Card') {
                $newBalance = floatval($paymentAcc->balance) + floatval($data['total_amount']);
            } else {
                $newBalance = floatval($paymentAcc->balance) - floatval($data['total_amount']);
            }

            $newBalance = number_format($newBalance, 2, '.', ',');

            $paymentAccData = [
                'id' => $paymentAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($paymentAccData);

            $paymentItems = [];
            foreach ($data['bills'] as $index => $bill) {
                $paymentItems[] = [
                    'bill_payment_id' => $billPaymentId,
                    'bill_id' => $bill,
                    'credit_applied_amount' => null,
                    'payment_amount' => null,
                    'total_amount' => $data['bill_payment'][$index]
                ];

                $bill = $this->expenses_model->get_bill_data($bill);

                if (floatval($data['bill_payment'][$index]) === floatval($bill->remaining_balance)) {
                    $billData = [
                        'remaining_balance' => 0.00,
                        'status' => 2,
                        'updated_at' => date("Y-m-d H:i:s")
                    ];
                } else {
                    $remainingBal = floatval($bill->remaining_balance) - floatval($data['bill_payment'][$index]);
                    $billData = [
                        'remaining_balance' => number_format($remainingBal, 2, '.', ','),
                        'updated_at' => date("Y-m-d H:i:s")
                    ];
                }

                $this->expenses_model->update_bill_data($bill->id, $billData);
            }

            $this->expenses_model->insert_bill_payment_items($paymentItems);
        }

        return [
            'data' => $billPaymentId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];
    }

    private function update_categories($transactionType, $transactionId, $data)
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);

        if ($data['expense_account'] !== null) {
            foreach ($data['expense_account'] as $index => $value) {
                $categoryDetails = [
                    'expense_account_id' => $value,
                    'category' => $data['category'][$index],
                    'description' => $data['description'][$index],
                    'amount' => $data['category_amount'][$index],
                    'billable' => $data['category_billable'][$index],
                    'markup_percentage' => $data['category_markup'][$index],
                    'tax' => $data['category_tax'][$index],
                    'customer_id' => $data['category_customer'][$index],
                ];

                if (!is_null($categories[$index])) {
                    $this->vendors_model->update_transaction_category_details($categories[$index]->id, $categoryDetails);
                } else {
                    $categoryDetails['transaction_type'] = $transactionType;
                    $categoryDetails['transaction_id'] = $transactionId;

                    $details = [
                        $categoryDetails
                    ];

                    $this->expenses_model->insert_vendor_transaction_categories($details);
                }

                if ($value !== $categories[$index]->expense_account_id) {
                    $newCat = $this->chart_of_accounts_model->getById($value);
                    $oldCat = $this->chart_of_accounts_model->getById($categories[$index]->expense_account_id);

                    switch ($transactionType) {
                        case 'Expense':
                            $newBalance = floatval($newCat->balance) + floatval($data['category_amount'][$index]);
                            $revertBalance = floatval($oldCat->balance) - floatval($categories[$index]->amount);
                        break;
                        case 'Check':
                            $newBalance = floatval($newCat->balance) + floatval($data['category_amount'][$index]);
                            $revertBalance = floatval($oldCat->balance) - floatval($categories[$index]->amount);
                        break;
                        case 'Bill':
                            $newBalance = floatval($newCat->balance) + floatval($data['category_amount'][$index]);
                            $revertBalance = floatval($oldCat->balance) - floatval($categories[$index]->amount);
                        break;
                        case 'Vendor Credit':
                            $newBalance = floatval($newCat->balance) - floatval($data['category_amount'][$index]);
                            $revertBalance = floatval($oldCat->balance) + floatval($categories[$index]->amount);
                        break;
                        case 'Credit Card Credit':
                            $newBalance = floatval($newCat->balance) - floatval($data['category_amount'][$index]);
                            $revertBalance = floatval($oldCat->balance) + floatval($categories[$index]->amount);
                        break;
                    }
        
                    if ($transactionType !== 'Purchase Order') {
                        $newCatData = [
                            'id' => $newCat->id,
                            'company_id' => logged('company_id'),
                            'balance' => number_format($newBalance, 2, '.', ',')
                        ];

                        $oldCatData = [
                            'id' => $oldCat->id,
                            'company_id' => logged('company_id'),
                            'balance' => number_format($revertBalance, 2, '.', ',')
                        ];

                        $this->chart_of_accounts_model->updateBalance($newCatData);
                        $this->chart_of_accounts_model->updateBalance($oldCatData);
                    }
                }

                if ($data['category_amount'][$index] !== $categories[$index]->amount && $value === $categories[$index]->expense_account_id) {
                    $catAcc = $this->chart_of_accounts_model->getById($value);

                    switch ($transactionType) {
                        case 'Expense':
                            $newBalance = floatval($catAcc->balance) - floatval($categories[$index]->amount);
                            $newBalance = $newBalance + floatval($data['category_amount'][$index]);
                        break;
                        case 'Check':
                            $newBalance = floatval($catAcc->balance) - floatval($categories[$index]->amount);
                            $newBalance = $newBalance + floatval($data['category_amount'][$index]);
                        break;
                        case 'Bill':
                            $newBalance = floatval($catAcc->balance) - floatval($categories[$index]->amount);
                            $newBalance = $newBalance + floatval($data['category_amount'][$index]);
                        break;
                        case 'Vendor Credit':
                            $newBalance = floatval($catAcc->balance) + floatval($categories[$index]->amount);
                            $newBalance = $newBalance - floatval($data['category_amount'][$index]);
                        break;
                        case 'Credit Card Credit':
                            $newBalance = floatval($catAcc->balance) + floatval($categories[$index]->amount);
                            $newBalance = $newBalance - floatval($data['category_amount'][$index]);
                        break;
                    }
        
                    $catAccData = [
                        'id' => $catAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => number_format($newBalance, 2, '.', ',')
                    ];
        
                    $this->chart_of_accounts_model->updateBalance($catAccData);
                }
            }
        }

        if (count($categories) > 0) {
            foreach ($categories as $index => $category) {
                if ($data['expense_account'] === null || $data['expense_account'][$index] === null) {
                    $catAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                    switch ($transactionType) {
                        case 'Expense':
                            $revertBalance = floatval($catAcc->balance) - floatval($category->amount);
                        break;
                        case 'Check':
                            $revertBalance = floatval($catAcc->balance) - floatval($category->amount);
                        break;
                        case 'Bill':
                            $revertBalance = floatval($catAcc->balance) - floatval($category->amount);
                        break;
                        case 'Vendor Credit':
                            $revertBalance = floatval($catAcc->balance) + floatval($category->amount);
                        break;
                        case 'Credit Card Credit':
                            $revertBalance = floatval($catAcc->balance) + floatval($category->amount);
                        break;
                    }

                    $revertBalance = number_format($revertBalance, 2, '.', ',');

                    $catAccData = [
                        'id' => $catAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $revertBalance
                    ];
        
                    $this->chart_of_accounts_model->updateBalance($catAccData);

                    $this->vendors_model->delete_transaction_category($category->id, $transactionType);
                }
            }
        }
    }

    private function update_items($transactionType, $transactionId, $data)
    {
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        if ($data['item'] !== null) {
            foreach ($data['item'] as $index => $value) {
                $itemDetails = [
                    'item_id' => $value,
                    'location_id' => $data['location'][$index],
                    'quantity' => $data['quantity'][$index],
                    'rate' => $data['item_amount'][$index],
                    'discount' => $data['discount'][$index],
                    'tax' => $data['item_tax'][$index],
                    'total' => $data['item_total'][$index]
                ];

                if (!is_null($items[$index])) {
                    $this->vendors_model->update_transaction_item($items[$index]->id, $itemDetails);
                } else {
                    $itemDetails['transaction_type'] = $transactionType;
                    $itemDetails['transaction_id'] = $transactionId;

                    $details = [
                        $itemDetails
                    ];

                    $this->expenses_model->insert_vendor_transaction_items($details);
                }

                if ($items[$index]->location_id !== $data['location'][$index]) {
                    $newLoc = $this->items_model->getItemLocation($data['location'][$index], $value);
                    $oldLoc = $this->items_model->getItemLocation($categories[$index]->location_id, $categories[$index]->item_id);

                    switch ($transactionType) {
                        case 'Expense':
                            $newQty = intval($newLoc->qty) + intval($data['quantity'][$index]);
                            $oldQty = intval($oldLoc->qty) - intval($categories[$index]->quantity);
                        break;
                        case 'Check':
                            $newQty = intval($newLoc->qty) + intval($data['quantity'][$index]);
                            $oldQty = intval($oldLoc->qty) - intval($categories[$index]->quantity);
                        break;
                        case 'Bill':
                            $newQty = intval($newLoc->qty) + intval($data['quantity'][$index]);
                            $oldQty = intval($oldLoc->qty) - intval($categories[$index]->quantity);
                        break;
                        case 'Purchase Order':
                            $newItemDet = $this->items_model->getItemAccountingDetails($value);
                            $oldItemDet = $this->items_model->getItemAccountingDetails($items[$index]->item_id);

                            $newQty = intval($newItemDet->qty_po) + intval($data['quantity'][$index]);
                            $oldQty = intval($oldItemDet->qty_po) - intval($categories[$index]->quantity);

                            $this->items_model->updateItemAccountingDetails(['qty_po' => $newQty], $value);
                            $this->items_model->updateItemAccountingDetails(['qty_po' => $oldQty], $oldItemDet->id);
                        break;
                        case 'Vendor Credit':
                            $newQty = intval($newLoc->qty) - intval($data['quantity'][$index]);
                            $oldQty = intval($oldLoc->qty) + intval($categories[$index]->quantity);
                        break;
                        case 'Credit Card Credit':
                            $newQty = intval($newLoc->qty) - intval($data['quantity'][$index]);
                            $oldQty = intval($oldLoc->qty) + intval($categories[$index]->quantity);
                        break;
                    }

                    if ($transactionType !== 'Purchase Order') {
                        $this->items_model->updateLocationQty($data['location'][$index], $value, $newQty);
                        $this->items_model->updateLocationQty($categories[$index]->location_id, $categories[$index]->item_id, $oldQty);
                    }
                }

                if ($items[$index]->item_id !== $value) {
                    $newItem = $this->items_model->getItemAccountingDetails($value);
                    $oldItem = $this->items_model->getItemAccountingDetails($value);

                    $newInvAssetAcc = $this->chart_of_accounts_model->getById($newItem->inv_asset_acc_id);
                    $oldInvAssetAcc = $this->chart_of_accounts_model->getById($oldItem->inv_asset_acc_id);

                    $newBalance = floatval($newInvAssetAcc->balance);
                    $oldBalance = floatval($oldInvAssetAcc->balance);

                    switch ($transactionType) {
                        case 'Expense':
                            $newBalance = floatval($newInvAssetAcc->balance) + floatval($data['item_total'][$index]);
                            $oldBalance = floatval($oldInvAssetAcc->balance) - floatval($categories[$index]->total);
                        break;
                        case 'Check':
                            $newBalance = floatval($invAssetAcc->balance) + floatval($data['item_total'][$index]);
                            $oldBalance = floatval($oldInvAssetAcc->balance) - floatval($categories[$index]->total);
                        break;
                        case 'Bill':
                            $newBalance = floatval($invAssetAcc->balance) + floatval($data['item_total'][$index]);
                            $oldBalance = floatval($oldInvAssetAcc->balance) - floatval($categories[$index]->total);
                        break;
                        case 'Vendor Credit':
                            $newBalance = floatval($data['item_amount'][$index]) - 5.00;
                            $newBalance = floatval($invAssetAcc->balance) + $newBalance;
                            $oldBalance = floatval($categories[$index]->total) - 5.00;
                            $oldBalance = floatval($oldInvAssetAcc->balance) - $oldBalance;
                        break;
                        case 'Credit Card Credit':
                            $newBalance = floatval($data['item_amount'][$index]) - 5.00;
                            $newBalance = floatval($invAssetAcc->balance) + $newBalance;
                            $oldBalance = floatval($categories[$index]->total) - 5.00;
                            $oldBalance = floatval($oldInvAssetAcc->balance) - $oldBalance;
                        break;
                    }

                    $newInvAssetAccData = [
                        'id' => $newInvAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => number_format($newBalance, 2, '.', ',')
                    ];

                    $oldInvAssetAccData = [
                        'id' => $oldInvAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => number_format($oldBalance, 2, '.', ',')
                    ];

                    $this->chart_of_accounts_model->updateBalance($newInvAssetAccData);
                    $this->chart_of_accounts_model->updateBalance($oldInvAssetAccData);
                }

                if ($data['item_total'][$index] !== $items[$index]->total && $value === $items[$index]->item_id) {
                    $item = $this->items_model->getItemAccountingDetails($value);
                    $invAssetAcc = $this->chart_of_accounts_model->getById($item->inv_asset_acc_id);

                    $newBalance = floatval($invAssetAcc->balance);

                    switch ($transactionType) {
                        case 'Expense':
                            $newBalance = floatval($invAssetAcc->balance) - floatval($items[$index]->total);
                            $newBalance = $newBalance + floatval($data['item_total'][$index]);
                        break;
                        case 'Check':
                            $newBalance = floatval($invAssetAcc->balance) - floatval($items[$index]->total);
                            $newBalance = $newBalance + floatval($data['item_total'][$index]);
                        break;
                        case 'Bill':
                            $newBalance = floatval($invAssetAcc->balance) - floatval($items[$index]->total);
                            $newBalance = $newBalance + floatval($data['item_total'][$index]);
                        break;
                        case 'Vendor Credit':
                            $newBalance = floatval($invAssetAcc->balance) - floatval($items[$index]->total);
                            $totalAmount = floatval($data['item_amount'][$index]) - 5.00;
                            $newBalance = $newBalance + $totalAmount;
                        break;
                        case 'Credit Card Credit':
                            $newBalance = floatval($invAssetAcc->balance) - floatval($items[$index]->total);
                            $totalAmount = floatval($data['item_amount'][$index]) - 5.00;
                            $newBalance = $newBalance + $totalAmount;
                        break;
                    }

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => number_format($newBalance, 2, '.', ',')
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                }
            }
        }

        if (count($items) > 0) {
            foreach ($items as $index => $item) {
                if ($data['item'] === null || $data['item'][$index] === null) {
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($item->item_id);
                    $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);
                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

                    switch ($transactionType) {
                        case 'Expense':
                            $newQty = intval($location->qty) - intval($item->quantity);
                            $newBalance = floatval($invAssetAcc->balance) - floatval($item->total);
                        break;
                        case 'Check':
                            $newQty = intval($location->qty) - intval($item->quantity);
                            $newBalance = floatval($invAssetAcc->balance) - floatval($item->total);
                        break;
                        case 'Bill':
                            $newQty = intval($location->qty) - intval($item->quantity);
                            $newBalance = floatval($invAssetAcc->balance) - floatval($item->total);
                        break;
                        case 'Purchase Order':
                            $newQty = intval($itemAccDetails->qty_po) - intval($item->quantity);

                            $this->items_model->updateItemAccountingDetails(['qty_po' => $newQty], $item->item_id);
                        break;
                        case 'Vendor Credit':
                            $newQty = intval($location->qty) + intval($item->quantity);
                            $newBalance = floatval($item->total) - 5.00;
                            $newBalance = floatval($invAssetAcc->balance) - $newBalance;
                        break;
                        case 'Credit Card Credit':
                            $newQty = intval($location->qty) + intval($item->quantity);
                            $newBalance = floatval($item->total) - 5.00;
                            $newBalance = floatval($invAssetAcc->balance) - $newBalance;
                        break;
                    }

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => number_format($newBalance, 2, '.', ',')
                    ];

                    if ($transactionType !== 'Purchase Order') {
                        $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);
                        $this->chart_of_accounts_model->updateBalance($invAssetAccData);
                    }

                    $this->vendors_model->delete_transaction_item($item->id, $transactionType);
                }
            }
        }
    }

    public function copy_expense($expenseId)
    {
        $expense = $this->vendors_model->get_expense_by_id($expenseId);
        $paymentAccs = [];
        $paymentAccsType = $this->account_model->getAccTypeByName(['Bank', 'Credit Card', 'Other Current Assets']);

        foreach ($paymentAccsType as $accType) {
            $accounts = $this->chart_of_accounts_model->getByAccountType($accType->id, null, logged('company_id'));

            if (count($accounts) > 0) {
                foreach ($accounts as $account) {
                    $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                    $account->childAccs = $childAccs;

                    $paymentAccs[$accType->account_name][] = $account;

                    if ($account->id === $expense->payment_account_id) {
                        $selectedBalance = $account->balance;
                    }

                    foreach ($childAccs as $childAcc) {
                        if ($childAcc->id === $expense->payment_account_id) {
                            $selectedBalance = $childAcc->balance;
                        }
                    }
                }
            }
        }

        if (strpos($selectedBalance, '-') !== false) {
            $balance = str_replace('-', '', $selectedBalance);
            $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
        } else {
            $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
        }

        $categories = $this->expenses_model->get_transaction_categories($expenseId, 'Expense');
        $items = $this->expenses_model->get_transaction_items($expenseId, 'Expense');

        $this->page_data['expense'] = $expense;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['dropdown']['payment_methods'] = $this->accounting_payment_methods_model->getCompanyPaymentMethods();
        $this->page_data['balance'] = $selectedBalance;
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['payment_accounts'] = $paymentAccs;
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['is_copy'] = true;

        $this->load->view('accounting/vendors/view_expense', $this->page_data);
    }

    public function copy_check($checkId)
    {
        $check = $this->vendors_model->get_check_by_id($checkId);
        $bankAccsType = $this->account_model->getAccTypeByName('Bank');

        $bankAccs = [];
        $accounts = $this->chart_of_accounts_model->getByAccountType($bankAccsType->id, null, logged('company_id'));
        if (count($accounts) > 0) {
            foreach ($accounts as $account) {
                $childAccs = $this->chart_of_accounts_model->getChildAccounts($account->id);

                $account->childAccs = $childAccs;

                $bankAccs[] = $account;

                if ($account->id === $check->bank_account_id) {
                    $selectedBalance = $account->balance;
                }

                foreach ($childAccs as $childAcc) {
                    if ($childAcc->id === $check->bank_account_id) {
                        $selectedBalance = $childAcc->balance;
                    }
                }
            }
        }

        if (strpos($selectedBalance, '-') !== false) {
            $balance = str_replace('-', '', $selectedBalance);
            $selectedBalance = '-$'.number_format($balance, 2, '.', ',');
        } else {
            $selectedBalance = '$'.number_format($selectedBalance, 2, '.', ',');
        }

        $categories = $this->expenses_model->get_transaction_categories($checkId, 'Check');
        $items = $this->expenses_model->get_transaction_items($checkId, 'Check');

        $this->page_data['check'] = $check;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['dropdown']['payment_methods'] = $this->accounting_payment_methods_model->getCompanyPaymentMethods();
        $this->page_data['balance'] = $selectedBalance;
        $this->page_data['dropdown']['employees'] = $this->users_model->getCompanyUsers(logged('company_id'));
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['bank_accounts'] = $bankAccs;
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['is_copy'] = true;

        $this->load->view('accounting/vendors/view_check', $this->page_data);
    }

    public function copy_bill($billId)
    {
        $bill = $this->vendors_model->get_bill_by_id($billId);
        $terms = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));

        $selectedTerm = $terms[0];

        $billPayments = $this->vendors_model->get_bill_payments_by_bill_id($billId);

        $totalPayment = 0.00;
        foreach ($billPayments as $billPayment) {
            $paymentItems = $this->vendors_model->get_bill_payment_items($billPayment->id);

            foreach ($paymentItems as $paymentItem) {
                if ($paymentItem->bill_id === $billId) {
                    $totalPayment += floatval($paymentItem->total_amount);
                }
            }
        }

        $categories = $this->expenses_model->get_transaction_categories($billId, 'Bill');
        $items = $this->expenses_model->get_transaction_items($billId, 'Bill');

        $this->page_data['bill_payments'] = $billPayments;
        $this->page_data['total_payment'] = number_format(floatval($totalPayment), 2, '.', ',');
        $this->page_data['due_date'] = date("m/d/Y", strtotime($bill->due_date));
        $this->page_data['bill'] = $bill;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['dropdown']['terms'] = $terms;
        $this->page_data['is_copy'] = true;

        $this->load->view('accounting/vendors/view_bill', $this->page_data);
    }

    public function copy_purchase_order($purchOrderId)
    {
        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($purchOrderId);

        $categories = $this->expenses_model->get_transaction_categories($purchOrderId, 'Purchase Order');
        $items = $this->expenses_model->get_transaction_items($purchOrderId, 'Purchase Order');

        $this->page_data['purchaseOrder'] = $purchaseOrder;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['is_copy'] = true;

        $this->load->view('accounting/vendors/view_purchase_order', $this->page_data);
    }

    public function copy_vendor_credit($vendorCreditId)
    {
        $vendorCredit = $this->vendors_model->get_vendor_credit_by_id($vendorCreditId);

        $categories = $this->expenses_model->get_transaction_categories($vendorCreditId, 'Vendor Credit');
        $items = $this->expenses_model->get_transaction_items($vendorCreditId, 'Vendor Credit');

        $this->page_data['vendorCredit'] = $vendorCredit;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['is_copy'] = true;

        $this->load->view('accounting/vendors/view_vendor_credit', $this->page_data);
    }

    public function copy_to_bill($purchaseOrderId)
    {
        $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($purchaseOrderId);
        $terms = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));

        $selectedTerm = $terms[0];

        $billPayments = $this->vendors_model->get_bill_payments_by_bill_id($billId);

        $totalPayment = 0.00;
        foreach ($billPayments as $billPayment) {
            $paymentItems = $this->vendors_model->get_bill_payment_items($billPayment->id);

            foreach ($paymentItems as $paymentItem) {
                if ($paymentItem->bill_id === $billId) {
                    $totalPayment += floatval($paymentItem->total_amount);
                }
            }
        }

        $categories = $this->expenses_model->get_transaction_categories($purchaseOrderId, 'Purchase Order');
        $items = $this->expenses_model->get_transaction_items($purchaseOrderId, 'Purchase Order');

        $this->page_data['purchaseOrder'] = $purchaseOrder;
        $this->page_data['bill_payments'] = $billPayments;
        $this->page_data['total_payment'] = number_format(floatval($totalPayment), 2, '.', ',');
        $this->page_data['due_date'] = date("m/d/Y", strtotime($bill->due_date));
        // $this->page_data['bill'] = $bill;
        $this->page_data['categories'] = $categories;
        $this->page_data['items'] = $items;
        $this->page_data['dropdown']['categories'] = $this->get_category_accs();
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['dropdown']['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['dropdown']['vendors'] = $this->vendors_model->getAllByCompany();
        $this->page_data['dropdown']['items'] = $this->items_model->getItemsWithFilter(['type' => 'inventory', 'status' => [1]]);
        $this->page_data['dropdown']['terms'] = $terms;

        $this->load->view('accounting/modals/bill_modal', $this->page_data);
    }

    public function void_transaction($transactionType, $transactionId)
    {
        switch ($transactionType) {
            case 'expense':
                $return = $this->void_expense($transactionId);
            break;
            case 'check':
                $return = $this->void_check($transactionId);
            break;
            case 'credit-card-payment':
                $return = $this->void_cc_payment($transactionId);
            break;
            case 'bill-payment':
                $return = $this->void_bill_payment($transactionId);
            break;
        }

        echo json_encode($return);
    }

    private function void_expense($expenseId)
    {
        $expense = $this->vendors_model->get_expense_by_id($expenseId);

        $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
        $newBalance = floatval($paymentAcc->balance) - floatval($expense->total_amount);
        $newBalance = number_format($newBalance, 2, '.', ',');

        $paymentAccData = [
            'id' => $paymentAcc->id,
            'company_id' => logged('company_id'),
            'balance' => $newBalance
        ];

        $this->chart_of_accounts_model->updateBalance($paymentAccData);

        $data = [
            'memo' => 'Voided',
            'status' => 4,
            'total_amount' => 0.00,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $void = $this->vendors_model->update_expense($expenseId, $data);

        if ($void) {
            $this->void_categories('Expense', $expenseId);
            $this->void_items('Expense', $expenseId);
        }

        return [
            'data' => $expenseId,
            'success' => $void ? true : false,
            'message' => $void ? 'Transaction successfully voided!' : 'Unexpected error occurred.'
        ];
    }

    private function void_check($checkId)
    {
        $check = $this->vendors_model->get_check_by_id($checkId);

        $bankAcc = $this->chart_of_accounts_model->getById($check->bank_account_id);
        $newBalance = floatval($bankAcc->balance) + floatval($check->total_amount);
        $newBalance = number_format($newBalance, 2, '.', ',');

        $bankAccData = [
            'id' => $bankAcc->id,
            'company_id' => logged('company_id'),
            'balance' => $newBalance
        ];

        $this->chart_of_accounts_model->updateBalance($bankAccData);

        $data = [
            'memo' => 'Voided',
            'status' => 4,
            'total_amount' => 0.00,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $void = $this->vendors_model->update_check($checkId, $data);

        if ($void) {
            $this->void_categories('Check', $checkId);
            $this->void_items('Check', $checkId);
        }

        return [
            'data' => $checkId,
            'success' => $void ? true : false,
            'message' => $void ? 'Transaction successfully voided!' : 'Unexpected error occurred.'
        ];
    }

    private function void_cc_payment($ccPaymentId)
    {
        $ccPayment = $this->vendors_model->get_credit_card_payment_by_id($ccPaymentId);

        $creditAcc = $this->chart_of_accounts_model->getById($ccPayment->credit_card_id);

        $newBalance = floatval($creditAcc->balance) + floatval($ccPayment->amount);
        $newBalance = number_format($newBalance, 2, '.', ',');

        $this->chart_of_accounts_model->updateBalance(['id' => $creditAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);

        $bankAcc = $this->chart_of_accounts_model->getById($ccPayment->bank_account_id);

        $newBalance = floatval($bankAcc->balance) + floatval($ccPayment->amount);
        $newBalance = number_format($newBalance, 2, '.', ',');

        $this->chart_of_accounts_model->updateBalance(['id' => $bankAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);

        $data = [
            'memo' => 'Voided',
            'status' => 4,
            'amount' => 0.00,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $void = $this->vendors_model->update_credit_card_payment($ccPaymentId, $data);

        return [
            'data' => $ccPaymentId,
            'success' => $void ? true : false,
            'message' => $void ? 'Transaction successfully voided!' : 'Unexpected error occurred.'
        ];
    }

    private function void_bill_payment($billPaymentId)
    {
        $billPayment = $this->vendors_model->get_bill_payment_by_id($billPaymentId);

        $billPaymentData = [
            'total_amount' => 0.00,
            'memo' => 'Voided',
            'status' => 4,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $paymentAcc = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
        $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

        if ($paymentAccType->account_name === 'Credit Card') {
            $newBalance = floatval($paymentAcc->balance) - floatval($billPayment->total_amount);
        } else {
            $newBalance = floatval($paymentAcc->balance) + floatval($billPayment->total_amount);
        }

        $newBalance = number_format($newBalance, 2, '.', ',');

        $paymentAccData = [
            'id' => $paymentAcc->id,
            'company_id' => logged('company_id'),
            'balance' => $newBalance
        ];

        $this->chart_of_accounts_model->updateBalance($paymentAccData);

        $void = $this->vendors_model->update_bill_payment($billPaymentId, $billPaymentData);

        $vCredits = !is_null($billPayment->vendor_credits_applied) ? json_decode($billPayment->vendor_credits_applied, true) : null;
        if (!is_null($vCredits)) {
            foreach ($vCredits as $vCreditId => $amount) {
                $vCredit = $this->vendors_model->get_vendor_credit_by_id($vCreditId);
                $vCreditData = [
                    'status' => 1,
                    'remaining_balance' => floatval($vCredit->remaining_balance) + floatval($amount),
                    'updated_at' => date("Y-m-d H:i:s")
                ];

                $this->vendors_model->update_vendor_credit($vCredit->id, $vCreditData);
            }
        }

        $paymentItems = $this->vendors_model->get_bill_payment_items($billPaymentId);
        foreach ($paymentItems as $paymentItem) {
            $bill = $this->expenses_model->get_bill_data($paymentItem->bill_id);

            $billData = [
                'remaining_balance' => floatval($bill->remaining_balance) + floatval($paymentItem->total_amount),
                'status' => 1,
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $this->expenses_model->update_bill_data($bill->id, $billData);
        }

        $this->vendors_model->delete_bill_payment_items($billPaymentId);

        return [
            'data' => $billPaymentId,
            'success' => $void ? true : false,
            'message' => $void ? 'Transaction successfully voided!' : 'Unexpected error occurred.'
        ];
    }

    private function void_categories($transactionType, $transactionId)
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);

        if (count($categories) > 0) {
            foreach ($categories as $category) {
                $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $expenseAccData = [
                    'id' => $expenseAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($expenseAccData);

                $categoryDetails = [
                    'amount' => 0.00
                ];

                $this->vendors_model->update_transaction_category_details($category->id, $categoryDetails);
            }
        }
    }

    private function void_items($transactionType, $transactionId)
    {
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        if (count($items) > 0) {
            foreach ($items as $item) {
                $location = $this->items_model->getItemLocation($item->location_id, $item->item_id);
                $newQty = intval($location->qty) - intval($item->quantity);

                $this->items_model->updateLocationQty($item->location_id, $item->item_id, $newQty);

                $itemAccDetails = $this->items_model->getItemAccountingDetails($item->item_id);

                $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                $newBalance = floatval($invAssetAcc->balance) - floatval($item->total);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $invAssetAccData = [
                    'id' => $invAssetAcc->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($invAssetAccData);

                $itemDetails = [
                    'quantity' => 0,
                    'total' => 0.00
                ];

                $this->vendors_model->update_transaction_category_details($item->id, $itemDetails);
            }
        }
    }

    public function categorize_transactions($vendorId, $categoryId)
    {
        $post = $this->input->post();

        $categories = [];
        foreach ($post['transaction_id'] as $index => $transactionId) {
            switch ($post['transaction_type'][$index]) {
                case 'bill':
                    $transaction = $this->vendors_model->get_bill_by_id($transactionId);
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Bill');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'expense':
                    $transaction = $this->vendors_model->get_expense_by_id($transactionId);
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Expense');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'check':
                    $transaction = $this->vendors_model->get_check_by_id($transactionId);
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Check');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'purchase-order':
                    $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId);
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Purchase Order');
                    $category = $category[0];
                break;
                case 'vendor-credit':
                    $transaction = $this->vendors_model->get_vendor_credit_by_id($transactionId);
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Vendor Credit');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);
                    }
                break;
                case 'credit-card-credit':
                    $transaction = $this->vendors_model->get_credit_card_credit_by_id($transactionId);
                    $category = $this->expenses_model->get_transaction_categories($transactionId, 'Credit Card Credit');
                    $category = $category[0];

                    if ($category->expense_account_id !== $categoryId) {
                        $expenseAcc = $this->chart_of_accounts_model->getById($categoryId);
                        $newBalance = floatval($expenseAcc->balance) - floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

                        $expenseAccData = [
                            'id' => $expenseAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newBalance
                        ];

                        $this->chart_of_accounts_model->updateBalance($expenseAccData);

                        // revert
                        $expenseAcc = $this->chart_of_accounts_model->getById($category->expense_account_id);
                        $newBalance = floatval($expenseAcc->balance) + floatval($category->amount);
                        $newBalance = number_format($newBalance, 2, '.', ',');

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

    public function print_transaction($transactionType, $transactionId)
    {
        $this->load->library('pdf');
        $view = "accounting/modals/print_action/print_transactions";
        $fileName = 'print.pdf';

        $data = [];

        switch ($transactionType) {
            case 'expense':
                $transaction = $this->vendors_model->get_expense_by_id($transactionId);
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
                        $payee = $this->accounting_customers_model->get_customer_by_id($transaction->payee_id);
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
                $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId);
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
                    $transaction = $this->vendors_model->get_expense_by_id($transactionId);
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
                            $payee = $this->accounting_customers_model->get_customer_by_id($transaction->payee_id);
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
                    $transaction = $this->vendors_model->get_purchase_order_by_id($transactionId);
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
}
