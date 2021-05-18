<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('vendors_model');
        $this->load->model('account_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('chart_of_accounts_model');
        $this->load->model('accounting_terms_model');

        add_css(array(
            "assets/css/accounting/banking.css?v='rand()'",
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css",
            "assets/css/accounting/sidebar.css",
            "assets/css/accounting/sales.css",
            "assets/plugins/dropzone/dist/dropzone.css",
            "assets/css/accounting/accounting-modal-forms.css",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css"
        ));

        add_footer_js(array(
            "assets/plugins/dropzone/dist/dropzone.js",
            "assets/js/accounting/sweetalert2@9.js",
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js"
        ));

		$this->page_data['menu_name'] =
            array(
                array("Dashboard",	array()),
                array("Banking", 	array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses", 	array('Expenses','Vendors')),
                array("Sales", 		array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll", 	array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",	array()),
                array("Taxes",		array("Sales Tax","Payroll Tax")),
                array("Mileage",	array()),
                array("Accounting",	array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/banking',array()),
                array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', 'credit_notes')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",	array('/accounting/salesTax','/accounting/payrollTax')),
                array('#',	array()),
                array("",	array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );
        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/expenses/vendors.js"
        ));

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

        if($postData['inactive'] === '1' || $postData['inactive'] === 1) {
            array_push($status, 0);
        }

        $vendors = $this->vendors_model->getAllByCompany($status);

        $data = [];

        foreach($vendors as $vendor) {
            if($search !== "") {
                if(stripos($vendor->display_name, $search) !== false) {
                    $data[] = [
                        'id' => $vendor->id,
                        'name' => $vendor->display_name,
                        'company_name' => $vendor->company,
                        'address' => "$vendor->street<br>$vendor->city $vendor->state $vendor->zip",
                        'phone' => $vendor->phone,
                        'email' => $vendor->email,
                        'attachments' => '',
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
                    'attachments' => '',
                    'open_balance' => '$'.number_format(floatval($vendor->opening_balance), 2, '.', ',')
                ];
            }
        }

        usort($data, function($a, $b) use ($order, $columnName) {
            if($order === 'asc') {
                return strcmp($a[$columnName], $b[$columnName]);
            } else {
                return strcmp($b[$columnName], $a[$columnName]);
            }
        });

        $result = [
            'draw' => $postData['draw'],
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
            'attachments' => json_encode($this->input->post('attachments')),
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->vendors_model->createVendor($new_data);

        if($addQuery > 0) {
            $this->session->set_flashdata('success', "New vendor successfully added!");
        } else{
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

        $this->page_data['terms'] = $this->accounting_terms_model->getActiveCompanyTerms(logged('company_id'));
        $this->page_data['expenseAccs'] = $this->chart_of_accounts_model->get_expense_accounts();
        $this->page_data['otherExpenseAccs'] = $this->chart_of_accounts_model->get_other_expense_accounts();
        $this->page_data['cogsAccs'] = $this->chart_of_accounts_model->get_cogs_accounts();
        $this->page_data['vendor'] = $vendor;
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Vendors";
        $this->load->view('accounting/vendors/view', $this->page_data);
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

        if($update) {
            $this->session->set_flashdata('success', "Vendor updated successfully!");
        } else{
            $this->session->set_flashdata('error', "Unexpected error, please try again!");
        }

        redirect("accounting/vendors/view/$vendorId");
    }

    public function update_attachments($vendorId)
    {
        $files = $_FILES['file'];

        if(count($files['name']) > 0) {
            $insert = $this->uploadFile($files);
            $vendor = $this->vendors_model->get_vendor_by_id($vendorId);

            if($vendor->attachments !== null || $vendor->attachments !== "") {
                foreach(json_decode($vendor->attachments, true) as $attachment) {
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

        $update = $this->vendors_model->updateVendor($vendorId, ['attachments' => json_encode($attachments)]);

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
        foreach($files['name'] as $key => $name)
        {
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
        foreach($data as $attachment) {
            $attachmentIds[] = $this->accounting_attachments_model->create($attachment);
        }

        return $attachmentIds;
    }

    public function get_vendor_attachments($vendorId)
    {
        $vendor = $this->vendors_model->get_vendor_by_id($vendorId);
        $attachments = json_decode($vendor->attachments, true);
        
        $attached = [];
        if($attachments !== null && count($attachments) > 0) {
            foreach($attachments as $attachment) {
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
        $inactive = $post['inactive'];

        $filters = [
            'type' => $type
        ];

        if($inactive) {
            $filters['status'] = [
                0,
                1
            ];
        }

        switch($date) {
            case 'today' :
                $filters['start-date'] = date("Y-m-d");
                $filters['end-date'] = date("Y-m-d");
            break;
            case 'yesterday' :
                $filters['start-date'] = date("Y-m-d", strtotime(date("m/d/Y").' -1 day'));
                $filters['end-date'] = date("Y-m-d", strtotime(date("m/d/Y").' -1 day'));
            break;
            case 'this-week' :
                $filters['start-date'] = date("Y-m-d", strtotime("this week -1 day"));
                $filters['end-date'] = date("Y-m-d", strtotime("sunday -1 day"));
            break;
            case 'this-month' :
                $filters['start-date'] = date("Y-m-01");
                $filters['end-date'] = date("Y-m-t");
            case 'this-quarter' :
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
            case 'this-year' :
                $filters['start-date'] = date("Y-01-01");
                $filters['end-date'] = date("Y-12-t");
            break;
            case 'last-week' :
                $filters['start-date'] = date("Y-m-d", strtotime("this week -1 week -1 day"));
                $filters['end-date'] = date("Y-m-d", strtotime("sunday -1 week -1 day"));
            break;
            case 'last-month' :
                $filters['start-date'] = date("Y-m-01", strtotime(date("m/01/Y")." -1 month"));
                $filters['end-date'] = date("Y-m-t", strtotime(date("m/01/Y")." -1 month"));
            break;
            case 'last-quarter' :
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
            case 'last-year' :
                $filters['start-date'] = date("Y-01-01", strtotime(date("01/01/Y")." -1 year"));
                $filters['end-date'] = date("Y-12-t", strtotime(date("12/t/Y")." -1 year"));
            break;
            case 'last-365-days' :
                $filters['start-date'] = date("Y-m-d", strtotime(date("m/d/Y")." -365 days"));
                $filters['end-date'] = date("Y-m-d");
            break;
        }

        $data = $this->get_transactions($vendorId, $filters);

        usort($data, function($a, $b) use ($order, $columnName) {
            if($columnName !== 'date') {
                if($order === 'asc') {
                    return strcmp($a[$columnName], $b[$columnName]);
                } else {
                    return strcmp($b[$columnName], $a[$columnName]);
                }
            } else {
                if($order === 'asc') {
                    return strtotime($a[$columnName]) > strtotime($b[$columnname]);
                } else {
                    return strtotime($a[$columnName]) < strtotime($b[$columnname]);
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
        switch($filters['type']) {
            case 'all-bills' :
                $bills = $this->vendors_model->get_vendor_bill_transactions($vendorId, $filters);
            break;
            case 'open-bills' :
                $bills = $this->vendors_model->get_vendor_open_bills($vendorId);
            break;
            case 'overdue-bills' :
                $bills = $this->vendors_model->get_vendor_overdue_bills($vendorId);
            break;
            case 'expenses' :
                $expenses = $this->vendors_model->get_vendor_expense_transactions($vendorId, $filters);
            break;
            case 'checks' :
                $checks = $this->vendors_model->get_vendor_check_transactions($vendorId, $filters);
            break;
            case 'bill-payments' :
                $billPayments = $this->vendors_model->get_vendor_bill_payments($vendorId, $filters);
            break;
            case 'recently-paid' :
                $expenses = $this->vendors_model->get_vendor_expense_transactions($vendorId, $filters);
                $checks = $this->vendors_model->get_vendor_check_transactions($vendorId, $filters);
                $bills = $this->vendors_model->get_vendor_paid_bills($vendorId, $filters);
                $creditCardPayments = $this->vendors_model->get_vendor_credit_card_payments($vendorId, $filters);
            break;
            case 'purchase-orders' :
                $purchaseOrders = $this->vendors_model->get_vendor_purchase_orders($vendorId, $filters);
            break;
            case 'vendor-credits' :
                $vendorCredits = $this->vendors_model->get_vendor_credit_transactions($vendorId, $filters);
            break;
            default :
                $expenses = $this->vendors_model->get_vendor_expense_transactions($vendorId, $filters);
                $checks = $this->vendors_model->get_vendor_check_transactions($vendorId, $filters);
                $bills = $this->vendors_model->get_vendor_bill_transactions($vendorId, $filters);
                $creditCardPayments = $this->vendors_model->get_vendor_credit_card_payments($vendorId, $filters);
                $purchaseOrders = $this->vendors_model->get_vendor_purchase_orders($vendorId, $filters);
                $billPayments = $this->vendors_model->get_vendor_bill_payments($vendorId, $filters);
                $vendorCredits = $this->vendors_model->get_vendor_credit_transactions($vendorId, $filters);
            break;
        }

        $transactions = [];
        if(isset($expenses) && count($expenses) > 0) {
            foreach($expenses as $expense) {
                $transactions[] = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'type' => 'Expense',
                    'number' => $expense->ref_number,
                    'payee' => $vendor->display_name,
                    'method' => $expense->payment_method,
                    'source' => '',
                    'category' => '',
                    'memo' => $expense->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($expense->amount), 2, '.', ','),
                    'status' => 'Paid',
                    'attachments' => ''
                ];
            }
        }

        if(isset($checks) && count($checks) > 0) {
            foreach($checks as $check) {
                $transactions[] = [
                    'id' => $check->id,
                    'date' => date("m/d/Y", strtotime($check->payment_date)),
                    'type' => 'Check',
                    'number' => $check->check_number,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => $check->memo,
                    'due_date' => '',
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($check->total_amount), 2, '.', ','),
                    'status' => 'Paid',
                    'attachments' => ''
                ];
            }
        }

        if(isset($bills) && count($bills) > 0) {
            foreach($bills as $bill) {
                $transactions[] = [
                    'id' => $bill->id,
                    'date' => date("m/d/Y", strtotime($bill->bill_date)),
                    'type' => 'Bill',
                    'number' => $bill->bill_number,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => $bill->memo,
                    'due_date' => date("m/d/Y", strtotime($bill->due_date)),
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($bill->total_amount), 2, '.', ','),
                    'status' => $bill->status === "2" ? "Paid" : "Open",
                    'attachments' => ''
                ];
            }
        }

        if(isset($creditCardPayments) && count($creditCardPayments) > 0) {
            foreach($creditCardPayments as $cardPayment) {
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
                    'total' => '$'.number_format(floatval($cardPayment->amount), 2, '.', ','),
                    'status' => '',
                    'attachments' => ''
                ];
            }
        }

        if(isset($purchaseOrders) && count($purchaseOrders) > 0) {
            foreach($purchaseOrders as $purchaseOrder) {
                $transactions[] = [
                    'id' => $purchaseOrder->id,
                    'date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'type' => 'Purchase Order',
                    'number' => $purchaseOrder->permit_num,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => $purchaseOrder->memo,
                    'due_date' => date("m/d/Y", strtotime($purchaseOrder->purchase_order_date)),
                    'balance' => '$0.00',
                    'total' => '$'.number_format(floatval($purchaseOrder->amount), 2, '.', ','),
                    'status' => $purchaseOrder->status === "1" ? "Open" : "Closed",
                    'attachments' => ''
                ];
            }
        }

        if(isset($billPayments) && count($billPayments) > 0) {
            foreach($billPayments as $payment) {
                $paymentAcc = $this->chart_of_accounts_model->getById($payment->payment_account_id);
                $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
                $paymentType = $paymentAccType->account_name === 'Bank' ? 'Check' : 'Credit Card';

                $transactions[] = [
                    'id' => $payment->id,
                    'date' => date("m/d/Y", strtotime($payment->payment_date)),
                    'type' => "Bill Payment ($paymentType)",
                    'number' => $payment->starting_check_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => '',
                    'due_date' => date("m/d/Y", strtotime($payment->payment_date)),
                    'balance' => '$0.00',
                    'total' => '-$'.number_format(floatval($payment->total_amount), 2, '.', ','),
                    'status' => 'Applied',
                    'attachments' => ''
                ];
            }
        }

        if(isset($vendorCredits) && count($vendorCredits) > 0) {
            foreach($vendorCredits as $vendorCredit) {
                $transactions[] = [
                    'id' => $vendorCredit->id,
                    'date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                    'type' => "Vendor Credit",
                    'number' => $vendorCredit->ref_no,
                    'payee' => $vendor->display_name,
                    'method' => '',
                    'source' => '',
                    'category' => '',
                    'memo' => $vendorCredits->memo,
                    'due_date' => date("m/d/Y", strtotime($vendorCredit->payment_date)),
                    'balance' => '$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ','),
                    'total' => '-$'.number_format(floatval($vendorCredit->total_amount), 2, '.', ','),
                    'status' => $vendorCredit->status === "1" ? "Unapplied" : "Applied",
                    'attachments' => ''
                ];
            }
        }

        return $transactions;
    }
}