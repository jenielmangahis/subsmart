<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->hasAccessModule(45);
        $this->load->model('chart_of_accounts_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('vendors_model');
        $this->load->model('expenses_model');
        $this->load->model('categories_model');
        $this->load->model('items_model');
        $this->load->model('accounting_journal_entries_model');
        $this->load->model('accounting_transfer_funds_model');
        $this->load->model('accounting_bank_deposit_model');
        $this->load->model('accounting_inventory_qty_adjustments_model');
        $this->load->model('item_starting_value_adj_model', 'starting_value_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('accounting_pay_down_credit_card_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('AcsProfile_model');
        $this->load->model('invoice_model');
        $this->load->model('workorder_model');
        $this->load->model('estimate_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_statements_model');
        $this->load->model('accounting_refund_receipt_model');

		$this->page_data['page']->title = 'Chart of Accounts';
        $this->page_data['page']->parent = 'Accounting';

        add_css(array(
            "assets/css/accounting/banking.css?v=".rand(),
            "assets/css/accounting/accounting.css",
            "assets/css/accounting/accounting.modal.css?v=".rand(),
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
            "assets/js/v2/accounting/accounting/chart_of_accounts/list.js?v=".rand()
            // "assets/js/accounting/accounting/chart-of-accounts.js?v=".rand()
        ));

        $accountTypes = $this->account_model->getAccounts();
        $accountsDropdown = [];
        foreach($accountTypes as $type)
        {
            foreach($this->chart_of_accounts_model->getByAccountType($type->id, null, logged('company_id')) as $account)
            {
                $childAccounts = $this->chart_of_accounts_model->getChildAccounts($account->id);
                $accountsDropdown[$type->account_name][] = [
                    'id' => $account->id,
                    'name' => $account->name,
                    'child_accounts' => $childAccounts
                ];
            }
        }

        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['terms'] = $this->accounting_invoices_model->getPayTerms();
        $this->page_data['paymethods'] = $this->accounting_receive_payment_model->getpaymethod();
        $this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->page_data['checks'] = $this->expenses_model->getCheck();
        $this->page_data['transactions'] = $this->expenses_model->getTransaction();
        $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
        $this->page_data['bills'] = $this->expenses_model->getBill();
        $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
        $this->page_data['expenses'] = $this->expenses_model->getExpense();
        $this->page_data['list_categories'] = $this->categories_model->getCategories();
        $this->page_data['attachments'] = $this->expenses_model->getAttachment();
        $this->page_data['items'] = $this->items_model->getItemlist();

        $status = [
            1
        ];

        if(get('status') === 'all') {
            array_push($status, 0);
        }

        $accounts = $this->chart_of_accounts_model->getFilteredAccounts($status);

        $data = [];
        foreach($accounts as $index => $account) {
            $childAccounts = $this->chart_of_accounts_model->getChildAccounts($account->id, $status);

            if(!empty(get('search'))) {
                if(stripos($account->name, get('search')) !== false) {
                    $data[] = [
                        'id' => $account->id,
                        'name' => $account->active === "1" ? $account->name : "$account->name (deleted)",
                        'type' => $this->account_model->getName($account->account_id),
                        'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                        'nsmartrac_balance' => str_replace('$-', '-$', '$'.number_format(floatval($account->balance), 2, '.', ',')),
                        'bank_balance' => '$0.00',
                        'status' => $account->active
                    ];
                }
            } else {
                $data[] = [
                    'id' => $account->id,
                    'name' => $account->active === "1" ? $account->name : "$account->name (deleted)",
                    'type' => $this->account_model->getName($account->account_id),
                    'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                    'nsmartrac_balance' => str_replace('$-', '-$', '$'.number_format(floatval($account->balance), 2, '.', ',')),
                    'bank_balance' => '$0.00',
                    'status' => $account->active
                ];
            }

            foreach($childAccounts as $childAcc) {
                if(!empty(get('search'))) {
                    if(stripos($childAcc->name, get('search')) !== false) {
                        $data[] = [
                            'id' => $childAcc->id,
                            'name' => $childAcc->active === "1" ? "&emsp;$childAcc->name" : "&emsp;$childAcc->name (deleted)",
                            'type' => $this->account_model->getName($childAcc->account_id),
                            'detail_type' => $this->account_detail_model->getName($childAcc->acc_detail_id),
                            'nsmartrac_balance' => str_replace('$-', '-$', '$'.number_format(floatval($childAcc->balance), 2, '.', ',')),
                            'bank_balance' => '$0.00',
                            'status' => $childAcc->active
                        ];
                    }
                } else {
                    $data[] = [
                        'id' => $childAcc->id,
                        'name' => $childAcc->active === "1" ? "&emsp;$childAcc->name" : "&emsp;$childAcc->name (deleted)",
                        'type' => $this->account_model->getName($childAcc->account_id),
                        'detail_type' => $this->account_detail_model->getName($childAcc->acc_detail_id),
                        'nsmartrac_balance' => str_replace('$-', '-$', '$'.number_format(floatval($childAcc->balance), 2, '.', ',')),
                        'bank_balance' => '$0.00',
                        'status' => $childAcc->active
                    ];
                }
            }
        }

        if(!empty(get('search'))) {
            $this->page_data['search'] = get('search');
        }
        if(!empty(get('status'))) {
            $this->page_data['status'] = get('status');
        }
        $this->page_data['accounts'] = $data;
        $this->page_data['accountsDropdown'] = $accountsDropdown;
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));

        $accountType = $this->account_model->getAccTypeByName('Bank');
        $this->page_data['accountType'] = $accountType;
        $this->page_data['detailType'] = $this->account_detail_model->getDetailTypesById($accountType->id)[0];
        $this->load->view('v2/pages/accounting/accounting/chart_of_accounts/list', $this->page_data);
    }

    public function get_detail_type($id)
    {
        $detailType = $this->account_detail_model->getById($id);

        echo json_encode($detailType);
    }

    public function load_chart_of_accounts()
    {
        $postData = json_decode(file_get_contents('php://input'), true);
        $search = $postData['columns'][0]['search']['value'];
        $column = $postData['order'][0]['column'];
        $order = $postData['order'][0]['dir'];
        $columnName = $postData['columns'][$column]['name'];
        $start = $postData['start'];
        $limit = $postData['length'];

        $status = [
            1
        ];

        if($postData['inactive'] === '1' || $postData['inactive'] === 1) {
            array_push($status, 0);
        }

        $accounts = $this->chart_of_accounts_model->getFilteredAccounts($status, $order, $columnName);

        $data = [];

        foreach($accounts as $account)
        {
            if($columnName !== 'nsmartrac_balance') {
                $childAccounts = $this->chart_of_accounts_model->getChildAccounts($account->id, $status);
            }

            if($search !== "") {
                if(stripos($account->name, $search) !== false) {
                    $acc = [
                        'id' => $account->id,
                        'name' => $account->name,
                        'type' => $this->account_model->getName($account->account_id),
                        'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                        'nsmartrac_balance' => $account->balance,
                        'bank_balance' => '',
                        'status' => $account->active,
                        'is_sub_acc' => false
                    ];
                }
            } else {
                $acc = [
                    'id' => $account->id,
                    'name' => $account->name,
                    'type' => $this->account_model->getName($account->account_id),
                    'detail_type' => $this->account_detail_model->getName($account->acc_detail_id),
                    'nsmartrac_balance' => $account->balance,
                    'bank_balance' => '',
                    'status' => $account->active,
                    'is_sub_acc' => false
                ];
            }

            if($columnName === 'nsmartrac_balance') {
                if($account->parent_acc_id !== '' && $account->parent_acc_id !== null && $account->parent_acc_id !== "0") {
                    $acc['parent_acc'] = $this->chart_of_accounts_model->getName($account->parent_acc_id);
                }
            }

            if(!is_null($acc)) {
                $data[] = $acc;
            }

            if(end($data)['id'] == $account->id && !empty($childAccounts) && $columnName !== 'nsmartrac_balance') {
                usort($childAccounts, function($a, $b) use ($order) {
                    if($order === 'asc') {
                        return strcmp($a->name, $b->name);
                    } else {
                        return strcmp($b->name, $a->name);
                    }
                });
                foreach($childAccounts as $subAcc) {
                    if($search !== "") {
                        if(stripos($subAcc->name, $search) !== false) {
                            $data[] = [
                                'id' => $subAcc->id,
                                'name' => $subAcc->name,
                                'type' => $this->account_model->getName($subAcc->account_id),
                                'detail_type' => $this->account_detail_model->getName($subAcc->acc_detail_id),
                                'nsmartrac_balance' => $subAcc->balance,
                                'bank_balance' => '',
                                'status' => $subAcc->active,
                                'is_sub_acc' => true
                            ];
                        }
                    } else {
                        $data[] = [
                            'id' => $subAcc->id,
                            'name' => $subAcc->name,
                            'type' => $this->account_model->getName($subAcc->account_id),
                            'detail_type' => $this->account_detail_model->getName($subAcc->acc_detail_id),
                            'nsmartrac_balance' => $subAcc->balance,
                            'bank_balance' => '',
                            'status' => $subAcc->active,
                            'is_sub_acc' => true
                        ];
                    }
                }
            }
        }

        usort($data, function($a, $b) use ($order, $columnName) {
            switch($columnName) {
                case 'nsmartrac_balance' :
                    if($a['is_sub_acc'] !== true && $b['is_sub_acc'] !== true) {
                        if($order === 'asc') {
                            return floatval($a['nsmartrac_balance']) > floatval($b['nsmartrac_balance']);
                        } else {
                            return floatval($a['nsmartrac_balance']) < floatval($b['nsmartrac_balance']);
                        }
                    }
                break;
                case 'type' :
                    if($a['is_sub_acc'] !== true && $b['is_sub_acc'] !== true) {
                        if($order === 'asc') {
                            return strcmp($a['type'], $b['type']);
                        } else {
                            return strcmp($b['type'], $a['type']);
                        }
                    }
                break;
                case 'name' :
                    if($a['is_sub_acc'] !== true && $b['is_sub_acc'] !== true) {
                        if($order === 'asc') {
                            return strcmp($a['name'], $b['name']);
                        } else {
                            return strcmp($b['name'], $a['name']);
                        }
                    }
                break;
            }
        });

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($accounts),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function fetch_acc_detail()
    {
        if($this->input->post('account_id'))
        {
            foreach($this->account_detail_model->getDetailTypesById($this->input->post('account_id')) as $row) {
                echo "<option value='".$row->acc_detail_id."'>".$row->acc_detail_name."</option>";
            }
        }
    }

    public function add()
    {
        $post = $this->input->post();
        switch($post['choose_time']) {
            case 'beginning-of-year' :
                $date = date("01-01-Y");
            break;
            case 'beginning-of-month' :
                $date = date("m-01-Y");
            break;
            case 'today' :
                $date = date("m-d-Y");
            break;
            case 'other' :
                $date = date("m-d-Y", strtotime($post['time_date']));
            break;
        }

        $name = $post['name'];

        do {
            $nameExists = $this->chart_of_accounts_model->get_by_name($name);

            if(!empty($nameExists)) {
                $name = $post['name'].'-'.count($nameExists);
            }
        } while(!empty($nameExists));

        $data = [
            'company_id' => logged('company_id'),
            'account_id' => $post['account_type'],
            'acc_detail_id' => $post['detail_type'],
            'name' => $name,
            'description' => $post['description'],
            'parent_acc_id' => $post['sub_account_type'],
            'time' => $post['choose_time'],
            'balance' => $post['balance'],
            'time_date' => $date
        ];

        $account = $this->chart_of_accounts_model->saverecords($data);

        if($account > 0) {
            $this->session->set_flashdata('success', "$name created successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect("accounting/chart-of-accounts");
    }

    public function edit($id)
    {
        $account = $this->chart_of_accounts_model->getById($id);

        if(!in_array($account->parent_acc_id, ['', null, 0])) {
            $this->page_data['parentAcc'] = $this->chart_of_accounts_model->getById($account->parent_acc_id);
        }
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['account'] = $account;
        $this->page_data['accountType'] = $this->account_model->getById($account->account_id);
        $this->page_data['detailType'] = $this->account_detail_model->getById($account->acc_detail_id);
        $this->load->view('v2/includes/accounting/modal_forms/account_modal', $this->page_data);
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'company_id' => logged('company_id'),
            'account_id' => $this->input->post('account_type'),
            'acc_detail_id' => $this->input->post('detail_type'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'parent_acc_id' => $this->input->post('sub_account_type'),
        ];

        $accountUpdate = $this->chart_of_accounts_model->updaterecords($data);
        $name = $data['name'];

        if($accountUpdate) {
            $this->session->set_flashdata('success', "$name updated successfully!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
        redirect("accounting/chart-of-accounts");
    }

    public function inactive($id)
    {
        $name = $this->chart_of_accounts_model->getById($id)->name;
        $inactive = $this->chart_of_accounts_model->inactive($id);

        if($inactive) {
            $this->session->set_flashdata('success', "$name is now inactive!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function make_account_active($id)
    {
        $name = $this->chart_of_accounts_model->getById($id)->name;
        $active =  $this->chart_of_accounts_model->makeActive($id);

        if($active) {
            $this->session->set_flashdata('success', "$name is now active!");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }
    }

    public function import()
    {
        $this->page_data['page_title'] = "Import";
        if(isset($_FILES["file"]["name"]))
        {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=1; $row<=$highestRow; $row++)
                {
                    $account_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $acc_detail_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $name = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $description = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $sub_acc_id = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $time = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $balance = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $time_date = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $data[] = array(
                        'account_id'   => $account_id,
                        'acc_detail_id'    => $acc_detail_id,
                        'name'  => $name,
                        'description'   => $description,
                        'sub_acc_id'  => $sub_acc_id,
                        'time'  => $time,
                        'balance'  => $balance,
                        'time_date'  => $time_date
                    );
                }
            }
            $this->chart_of_accounts_model->insert($data);
            echo 'Data Imported successfully';
        }
    }

    public function get_account_type($id)
    {
        $account = $this->chart_of_accounts_model->getById($id);
        $accountType = $this->account_model->getById($account->account_id);

        echo json_encode($accountType);
    }

    public function get_all_account_types()
    {
        echo json_encode($this->account_model->getAccounts());
    }

    public function print_table()
    {
        $post = $this->input->post();
        $search = $post['search'];

        $status = [
            1
        ];

        if($post['inactive'] === '1' || $post['inactive'] === 1) {
            array_push($status, 0);
        }

        $accounts = $this->chart_of_accounts_model->getFilteredAccounts($status);

        if($search !== "") {
            $accounts = array_filter($accounts, function($account, $key) use ($search) {
                return stripos($account->name, $search) !== false;
            }, ARRAY_FILTER_USE_BOTH);
        }

        usort($accounts, function($a, $b) use ($post) {
            switch($post['column']) {
                case 'name' :
                    if($post['order'] === 'asc') {
                        return strcmp($a->name, $b->name);
                    } else {
                        return strcmp($b->name, $a->name);
                    }
                break;
                case 'nsmartrac_balance' :
                    if($post['order'] === 'asc') {
                        return floatval($a->balance) > floatval($b->balance);
                    } else {
                        return floatval($a->balance) < floatval($b->balance);
                    }
                break;
                default :
                    $aType = $this->account_model->getName($a->account_id);
                    $bType = $this->account_model->getName($b->account_id);

                    if($post['order'] === 'asc') {
                        return strcmp($aType, $bType);
                    } else {
                        return strcmp($bType, $aType);
                    }
                break;
            }
        });

        $tableHtml = "<table width='100%'>";
        $tableHtml .= "<thead>";
        $tableHtml .= "<tr style='text-align: left;'>";
        $tableHtml .= "<th style='border-bottom: 2px solid #BFBFBF'>Name</th>";
        $tableHtml .= $post['type'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>" : "";
        $tableHtml .= $post['detail_type'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Detail Type</th>" : "";
        $tableHtml .= $post['nsmart_balance'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Balance</th>" : "";
        $tableHtml .= $post['balance'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Bank Balance</th>" : "";
        $tableHtml .= "</tr>";
        $tableHtml .= "</thead>";
        $tableHtml .= "<tbody>";

        foreach($accounts as $account) {
            $type = $this->account_model->getName($account->account_id);
            $detailType = $this->account_detail_model->getName($account->acc_detail_id);
            $balance = number_format(floatval($account->balance), 2, '.', ',');

            if ($account->active === "0") {
                $name = "$account->name (deleted)";
            } else {
                $name = $account->name;
            }

            $tableHtml .= "<tr>";
            $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>$name</td>";
            $tableHtml .= $post['type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>$type</td>" : "";
            $tableHtml .= $post['detail_type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>$detailType</td>" : "";
            $tableHtml .= $post['nsmart_balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5; text-align: right;'>$balance</td>" : "";
            $tableHtml .= $post['balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5; text-align: right;'></td>" : "";
            $tableHtml .= "</tr>";

            $childAccounts = $this->chart_of_accounts_model->getChildAccounts($account->id, $status);

            foreach($childAccounts as $subAcc) {
                $subAccType = $this->account_model->getName($subAcc->account_id);
                $subAccDetailType = $this->account_detail_model->getName($subAcc->acc_detail_id);
                $subAccBalance = number_format(floatval($subAcc->balance), 2, '.', ',');

                if ($subAcc->active === "0") {
                    $subAccName = "$subAcc->name (deleted)";
                } else {
                    $subAccName = $subAcc->name;
                }

                if($search !== "") {
                    if(stripos($subAcc->name, $search) !== false) {
                        $tableHtml .= "<tr>";
                        $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$subAccName</td>";
                        $tableHtml .= $post['type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>$subAccType</td>" : "";
                        $tableHtml .= $post['detail_type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>$subAccDetailType</td>" : "";
                        $tableHtml .= $post['nsmart_balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5; text-align: right;'>$subAccBalance</td>" : "";
                        $tableHtml .= $post['balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5; text-align: right;'></td>" : "";
                        $tableHtml .= "</tr>";
                    }
                } else {
                    $tableHtml .= "<tr>";
                    $tableHtml .= "<td style='border-bottom: 1px dotted #D5CDB5'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$subAccName</td>";
                    $tableHtml .= $post['type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>$subAccType</td>" : "";
                    $tableHtml .= $post['detail_type'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>$subAccDetailType</td>" : "";
                    $tableHtml .= $post['nsmart_balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5; text-align: right;'>$subAccBalance</td>" : "";
                    $tableHtml .= $post['balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5; text-align: right;'></td>" : "";
                    $tableHtml .= "</tr>";
                }
            }
        }

        $tableHtml .= "</tbody>";
        $tableHtml .= "</table>";

        echo $tableHtml;
    }

    public function update_account_names()
    {
        $post = $this->input->post();

        $flag = true;
        foreach($post['account_name'] as $id => $name) {
            $data = [
                'id' => $id,
                'company_id' => logged('company_id'),
                'name' => $name,
            ];
    
            $accountUpdate = $this->chart_of_accounts_model->updaterecords($data);

            if(!$accountUpdate) {
                $flag = false;
            }
        }

        echo json_encode($flag);
    }

    public function view_register($id)
    {
        $account = $this->chart_of_accounts_model->getById($id);
        $accountType = $this->account_model->getById($account->account_id);
        $type = $accountType->account_name;
        if(stripos($type, 'Assets')) {
            $type = 'Asset';
        } else if(stripos($type, 'A/R')) {
            $type = 'A/R';
        } else if(stripos($type, 'A/P')) {
            $type = 'A/P';
        } else if(stripos($type, 'Liabilities')) {
            $type = 'Liability';
        } else if(stripos($type, 'Equity')) {
            $type = 'Equity';
        }

        add_footer_js(array(
            "assets/js/v2/printThis.js",
            "assets/js/v2/accounting/accounting/chart_of_accounts/view-register.js?v=".rand()
            // "assets/js/accounting/accounting/view-register.js?v=".rand()
        ));

        $filters = [];
        if(!empty(get('search'))) {
            $filters['search'] = get('search');
            $this->page_data['search'] = get('search');
        }

        if(!empty(get('reconcile-status'))) {
            $this->page_data['reconcile_status'] = get('reconcile-status');
        }

        if(!empty(get('transaction-type'))) {
            $filters['type'] = get('transaction-type');
            $this->page_data['transaction_type'] = get('transaction-type');
        }

        if(!empty(get('payee'))) {
            $filters['type'] = get('payee');
            $this->page_data['payee'] = get('payee');
        }

        if(!empty(get('date'))) {
            $filters['date'] = get('date');
            $filters['from_date'] = get('from');
            $filters['to_date'] = get('to');

            $this->page_data['date'] = get('date');
            $this->page_data['from'] = get('from');
            $this->page_data['to'] = get('to');
        }

        $this->page_data['single_line'] = get('single-line');

        if($type !== 'A/R' && $type !== 'A/P') {
            $registers = $this->get_transactions($id, $filters);
        } else {
            if($type === 'A/R') {
                $registers = $this->get_ar_transactions($id, $filters);
            } else {
                $registers = $this->get_ap_transactions($id, $filters);
            }
        }

        $this->page_data['account'] = $account;
        $this->page_data['type'] = $type;
        // $this->load->view('accounting/chart_of_accounts/view_register', $this->page_data);
        $this->load->view('v2/pages/accounting/accounting/chart_of_accounts/view_register', $this->page_data);
    }

    private function get_ar_transactions($accountId, $filters = [])
    {
        $data = [];

        // $data = $this->invoice_registers($accountId, $data);
        // $data = $this->credit_memo_registers($accountId, $data);

        return $data;
    }

    private function get_ap_transactions($accountId, $filters = [])
    {
        $data = [];

        // $data = $this->bill_registers($accountId, $data);
        // $data = $this->bill_payment_registers($accountId, $data);
        // $data = $this->bill_payment_registers($accountId, $data, true);
        // $data = $this->vendor_credit_registers($accountId, $data);

        return $data;
    }

    private function get_transactions($accountId, $filters = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);
        $data = [];

        switch($filters['type']) {
            case 'cc-expense' :
                $data = $this->cc_expense_registers($accountId, $data);
            break;
            case 'check' :
                $data = $this->check_registers($accountId, $data);
            break;
            case 'invoice' :
                $data = $this->invoice_registers($accountId, $data);
            break;
            case 'receive-payment' :
                $data = $this->receive_payment_registers($accountId, $data);
            break;
            case 'journal-entry' :
                $data = $this->journal_registers($accountId, $data);
            break;
            case 'bill' :
                $data = $this->bill_registers($accountId, $data);
            break;
            case 'cc-credit' :
                $data = $this->cc_credit_registers($accountId, $data);
            break;
            case 'vendor-credit' :
                $data = $this->vendor_credit_registers($accountId, $data);
            break;
            case 'bill-payment' :
                $data = $this->bill_payment_registers($accountId, $data);
            break;
            case 'cc-bill-payment' :
                $data = $this->bill_payment_registers($accountId, $data, true);
            break;
            case 'transfer' :
                $data = $this->transfer_registers($accountId, $data);
            break;
            case 'deposit' :
                $data = $this->deposit_registers($accountId, $data);
            break;
            case 'cash-expense' :
                $data = $this->cash_expense_registers($accountId, $data);
            break;
            case 'sales-receipt' :
                $data = $this->sales_receipt_registers($accountId, $data);
            break;
            case 'credit-memo' :
                $data = $this->credit_memo_registers($accountId, $data);
            break;
            case 'refund' :
                $data = $this->refund_registers($accountId, $data);
            break;
            case 'inv-qty-adjustment' :
                $data = $this->quantity_adjustment_registers($accountId, $data);
            break;
            case 'expense' :
                $data = $this->expense_registers($accountId, $data);
            break;
            case 'inv-starting-value' :
                $data = $this->item_starting_value_registers($accountId, $data);
            break;
            case 'cc-payment' :
                $data = $this->credit_card_payment_registers($accountId, $data);
            break;
            default : 
                $data = $this->cc_expense_registers($accountId, $data);
                $data = $this->check_registers($accountId, $data);
                $data = $this->invoice_registers($accountId, $data);
                $data = $this->receive_payment_registers($accountId, $data);
                $data = $this->journal_registers($accountId, $data);
                $data = $this->bill_registers($accountId, $data);
                $data = $this->cc_credit_registers($accountId, $data);
                $data = $this->vendor_credit_registers($accountId, $data);
                $data = $this->bill_payment_registers($accountId, $data);
                $data = $this->transfer_registers($accountId, $data);
                $data = $this->deposit_registers($accountId, $data);
                $data = $this->sales_receipt_registers($accountId, $data);
                $data = $this->credit_memo_registers($accountId, $data);
                $data = $this->quantity_adjustment_registers($accountId, $data);
                $data = $this->expense_registers($accountId, $data);
                $data = $this->item_starting_value_registers($accountId, $data);
                $data = $this->credit_card_payment_registers($accountId, $data);
            break;
        }

        if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $depKey = 'increase';
            $paymentKey = 'decrease';
        } else if($accountType->account_name === 'Credit Card') {
            $depKey = 'charge';
            $paymentKey = 'payment';
        } else {
            $depKey = 'deposit';
            $paymentKey = 'payment';
        }

        // Filter
        $data = array_filter($data, function($reg, $key) use ($filters, $paymentKey, $depKey) {
            $flag = true;

            if(!empty($filters['from_date']) && strtotime($reg['date']) < strtotime($filters['from_date'])) {
                $flag = false;
            }

            if(!empty($filters['to_date']) && strtotime($reg['date']) > strtotime($filters['to_date'])) {
                $flag = false;
            }

            if(!empty($filters['payee']) && $filters['payee'] !== "all") {
                $payee = explode('-', $filters['payee']);

                if($reg['payee_type'] !== $payee[0] || $reg['payee_id'] !== $payee[1]) {
                    $flag = false;
                }
            }

            if(isset($filters['search']) && $filters['search'] !== "") {
                if(stripos($filters['search'], '<') !== false || stripos($filters['search'], '>') !== false) {
                    $searchString = str_replace('<', '', $filters['search']);
                    $searchString = str_replace('>', '', $filters['search']);

                    $searchFloat = floatval($searchString);

                    if(stripos($filters['search'], '<') !== false) {
                        $flag = floatval($reg[$paymentKey]) < $searchFloat || floatval($reg[$depKey]) < $searchFloat;
                    } else {
                        $flag = floatval($reg[$paymentKey]) > $searchFloat || floatval($reg[$depKey]) > $searchFloat;
                    }
                } else {
                    if(is_numeric($filters['search'])) {
                        if($reg[$paymentKey] !== '' && floatval($filters['search']) !== floatval($reg[$paymentKey])) {
                            $flag = false;
                        }

                        if($reg[$depKey] !== '' && floatval($filters['search']) !== floatval($reg[$depKey])) {
                            $flag = false;
                        }
                    } else {
                        if(stripos($reg['ref_no'], $filters['search']) === false && stripos($reg['memo'], $filters['search']) === false) {
                            $flag = false;
                        }
                    }
                }
            }

            return $flag;
        }, ARRAY_FILTER_USE_BOTH);

        $registers = $data;

        usort($registers, function($a, $b) {
            if(strtotime($a['date']) === strtotime($b['date'])) {
                return strtotime($a['date_created']) < strtotime($b['date_created']);
            }
            return strtotime($a['date']) < strtotime($b['date']);
        });

        $accBalance = floatval($account->balance);
        foreach($registers as $key => $reg) {
            $balance = number_format($accBalance, 2, '.', ',');
            $balance = '$'.$balance;
            $registers[$key]['balance'] = str_replace('$-', '-$', $balance);

            $accBalance -= floatval($reg[$depKey]);
            $accBalance += floatval($reg[$paymentKey]);
        }

        $data = $registers;

        usort($data, function($a, $b) {
            if(strtotime($a['date']) === strtotime($b['date'])) {
                return strtotime($a['date_created']) > strtotime($b['date_created']);
            }
            return strtotime($a['date']) > strtotime($b['date']);
        });

        if($filters['single_line'] === 0) {
            $registers = $data;

            $data = [];
            foreach($registers as $register) {
                $disPayKey = $paymentKey.'_disabled';
                $disDepKey = $depKey.'_disabled';

                $data[] = [
                    'id' => $register['id'],
                    'date' => $register['date'],
                    'ref_no_type' => $register['ref_no'],
                    'ref_no_disabled' => $register['ref_no_disabled'],
                    'payee_type' => $register['payee_type'],
                    'payee_id' => $register['payee_id'],
                    'payee_account' => $register['payee'],
                    'payee_disabled' => $register['payee_disabled'],
                    'memo' => $register['memo'],
                    $paymentKey => $register[$paymentKey],
                    $depKey => $register[$depKey],
                    $disPayKey => $register[$paymentKey],
                    $disDepKey => $register[$disDepKey],
                    'reconcile_banking_status' => $register['reconcile_status'],
                    'attachments' => $register['atttachments'],
                    'tax' => $register['tax'],
                    'balance' => $register['balance'],
                ];

                $data[] = [
                    'id' => $register['id'],
                    'date' => '',
                    'ref_no_type' => $register['type'],
                    'account_id' => $register['account_id'],
                    'payee_account' => $register['account'],
                    'account_disabled' => $register['account_disabled'],
                    'memo' => '',
                    $paymentKey => '',
                    $depKey => '',
                    'reconcile_banking_status' => $register['banking_status'],
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                ];
            }
        }

        return $data;
    }

    private function get_registers($accountId, $filters = [])
    {
        $search = $filters['search'];

        $sort = [
            'column' => $columnName,
            'order' => $order
        ];

        $post['search'] = $search;

        $data = $this->get_transactions($accountId, $post, $sort);

        $result = [
            'draw' => $post['draw'],
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ];

        echo json_encode($result);
    }

    private function cc_expense_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $expenses = $this->chart_of_accounts_model->get_expense_registers($accountId);

        foreach($expenses as $expense) {
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);
            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

            $account = $this->account_col($expense->id, 'Expense');
            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            if($paymentAccType->account_name === 'Credit Card') {
                $transaction = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => false,
                    'type' => 'CC Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $account['id'],
                    'account' => $account['name'],
                    'account_disabled' => $account['disabled'],
                    'account_field' => $account['field_name'],
                    'memo' => $expense->memo,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['payment'] = '';
                        $transaction['charge_disabled'] = $count > 1;
                        $transaction['payment_disabled'] = true;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    default :
                        $transaction['payment'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['deposit'] = '';
                        $transaction['payment_disabled'] = $count > 1;
                        $transaction['deposit_disabled'] = true;
                    break;
                }

                $data[] = $transaction;
            }
        }

        $expenseCategories = $this->chart_of_accounts_model->get_vendor_transaction_category_registers($accountId, 'Expense');
        foreach($expenseCategories as $expenseCategory) {
            $expense = $this->vendors_model->get_expense_by_id($expenseCategory->transaction_id, logged('company_id'));
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            if($paymentAccType->account_name === 'Credit Card') {
                $transaction = [
                    'id' => $expense->id,
                    'child_id' => $expenseCategory->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'CC Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $paymentAcc->id,
                    'account' => $paymentAcc->name,
                    'account_disabled' => true,
                    'account_field' => '',
                    'memo' => $expenseCategory->description,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = '';
                        $transaction['payment'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['charge_disabled'] = true;
                        $transaction['payment_disabled'] = $count > 1;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = '';
                        $transaction['decrease'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = $count > 1;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = '';
                        $transaction['decrease'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = $count > 1;
                    break;
                    default :
                        $transaction['payment'] = '';
                        $transaction['deposit'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['payment_disabled'] = true;
                        $transaction['deposit_disabled'] = $count > 1;
                    break;
                }

                $data[] = $transaction;
            }
        }

        $expenseItems = $this->chart_of_accounts_model->get_vendor_transaction_item_registers($accountId, 'Expense');
        foreach($expenseItems as $expenseItem) {
            $expense = $this->vendors_model->get_expense_by_id($expenseItem->transaction_id, logged('company_id'));
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            if($paymentAccType->account_name === 'Credit Card') {
                $transaction = [
                    'id' => $expense->id,
                    'child_id' => $expenseItem->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'CC Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $paymentAcc->id,
                    'account' => $paymentAcc->name,
                    'account_disabled' => true,
                    'account_field' => '',
                    'memo' => $expenseItem->description,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseItem->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = '';
                        $transaction['payment'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['charge_disabled'] = true;
                        $transaction['payment_disabled'] = $count > 1;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    default :
                        $transaction['payment'] = '';
                        $transaction['deposit'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['payment_disabled'] = true;
                        $transaction['deposit_disabled'] = $count > 1;
                    break;
                }

                $data[] = $transaction;
            }
        }

        return $data;
    }

    private function check_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $checks = $this->chart_of_accounts_model->get_checks_registers($accountId);

        foreach($checks as $check) {
            switch($check->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($check->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $account = $this->account_col($check->id, 'Check');
            $attachments = $this->accounting_attachments_model->get_attachments('Check', $check->id);

            $transaction = [
                'id' => $check->id,
                'date' => date("m/d/Y", strtotime($check->payment_date)),
                'ref_no' => $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no),
                'ref_no_disabled' => $check->to_print === "1",
                'type' => 'Check',
                'payee_type' => $check->payee_type,
                'payee_id' => $check->payee_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => $account['id'],
                'account' => $account['name'],
                'account_disabled' => $account['disabled'],
                'account_field' => $account['field_name'],
                'memo' => $check->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($check->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($check->total_amount), 2, '.', ',');
                    $transaction['payment'] = '';
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($check->total_amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($check->total_amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                break;
                default :
                    $transaction['payment'] = number_format(floatval($check->total_amount), 2, '.', ',');
                    $transaction['deposit'] = '';
                break;
            }

            $data[] = $transaction;
        }

        $checkCategories = $this->chart_of_accounts_model->get_vendor_transaction_category_registers($accountId, 'Check');

        foreach($checkCategories as $checkCategory) {
            $check = $this->vendors_model->get_check_by_id($checkCategory->transaction_id, logged('company_id'));
            $categories = $this->expenses_model->get_transaction_categories($check->id, 'Check');
            $items = $this->expenses_model->get_transaction_items($check->id, 'Check');
            $count = count($categories) + count($items);

            switch($check->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($check->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Check', $check->id);

            $transaction = [
                'id' => $check->id,
                'child_id' => $checkCategory->id,
                'date' => date("m/d/Y", strtotime($check->payment_date)),
                'ref_no' => $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no),
                'ref_no_disabled' => true,
                'type' => 'Check',
                'payee_type' => $check->payee_type,
                'payee_id' => $check->payee_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => $check->bank_account_id,
                'account' => $this->chart_of_accounts_model->getName($check->bank_account_id),
                'account_disabled' => true,
                'memo' => $checkCategory->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($checkCategory->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($checkCategory->amount), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = $count > 1;
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($checkCategory->amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($checkCategory->amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($checkCategory->amount), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = $count > 1;
                break;
            }

            $data[] = $transaction;
        }

        $checkItems = $this->chart_of_accounts_model->get_vendor_transaction_item_registers($accountId, 'Check');
        foreach($checkItems as $checkItem) {
            $check = $this->vendors_model->get_check_by_id($checkItem->transaction_id, logged('company_id'));
            $categories = $this->expenses_model->get_transaction_categories($check->id, 'Check');
            $items = $this->expenses_model->get_transaction_items($check->id, 'Check');
            $count = count($categories) + count($items);

            switch($check->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($check->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Check', $check->id);

            $transaction = [
                'id' => $check->id,
                'child_id' => $checkItem->id,
                'date' => date("m/d/Y", strtotime($check->payment_date)),
                'ref_no' => $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no),
                'ref_no_disabled' => true,
                'type' => 'Check',
                'payee_type' => $check->payee_type,
                'payee_id' => $check->payee_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => $check->bank_account_id,
                'account' => $this->chart_of_accounts_model->getName($check->bank_account_id),
                'account_disabled' => true,
                'memo' => $checkItem->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($checkItem->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($checkItem->total), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = $count > 1;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($checkItem->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($checkItem->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($checkItem->total), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = $count > 1;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function invoice_registers($accountId, $data)
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }

        $invoiceItems = $this->chart_of_accounts_model->get_invoice_item_registers($accountId);

        foreach($invoiceItems as $item) {
            $invoice = $this->invoice_model->getinvoice($item->invoice_id);
            $payee = $this->accounting_customers_model->get_by_id($invoice->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Invoice', $invoice->id);

            $transaction = [
                'id' => $invoice->id,
                'child_id' => $item->id,
                'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Invoice',
                'payee_type' => 'customer',
                'payee_id' => $invoice->customer_id,
                'payee' => $payeeName,
                'payee_disabled' => true,
                'account_id' => '',
                'account' => 'Accounts Receivable',
                'account_disabled' => true,
                'account_field' => '',
                'memo' => $item->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($invoice->date_created))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function receive_payment_registers($accountId, $data)
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $payments = $this->chart_of_accounts_model->get_receive_payment_registers($accountId);

        foreach($payments as $payment) {
            $payee = $this->accounting_customers_model->get_by_id($payment->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Receive Payment', $payment->id);

            $transaction = [
                'id' => $payment->id,
                'date' => date("m/d/Y", strtotime($payment->payment_date)),
                'ref_no' => $payment->ref_no,
                'ref_no_disabled' => false,
                'type' => 'Payment',
                'payee_type' => 'customer',
                'payee_id' => $payment->customer_id,
                'payee' => $payeeName,
                'payee_disabled' => true,
                'account_id' => '',
                'account' => 'Accounts Receivable',
                'account_disabled' => true,
                'account_field' => '',
                'memo' => $payment->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($payment->date_created))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function journal_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $journalEntries = $this->chart_of_accounts_model->get_journal_entry_registers($accountId);

        foreach($journalEntries as $journalEntryItem) {
            $journalEntry = $this->accounting_journal_entries_model->getById($journalEntryItem->journal_entry_id, logged('company_id'));
            $entries = $this->accounting_journal_entries_model->getEntries($journalEntry->id);

            switch($journalEntryItem->name_key) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($journalEntryItem->name_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($journalEntryItem->name_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($journalEntryItem->name_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Journal', $journalEntry->id);

            $transaction = [
                'id' => $journalEntry->id,
                'child_id' => $journalEntryItem->id,
                'date' => date("m/d/Y", strtotime($journalEntry->journal_date)),
                'ref_no' => $journalEntry->journal_no === null ? '' : $journalEntry->journal_no,
                'ref_no_disabled' => false,
                'type' => 'Journal',
                'payee_type' => $journalEntryItem->name_key,
                'payee_id' => $journalEntryItem->name_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account' => '-Split-',
                'account_disabled' => true,
                'memo' => $journalEntryItem->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($journalEntry->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = $journalEntryItem->credit !== "0" ? number_format(floatval($journalEntryItem->credit), 2, '.', ',') : "";
                    $transaction['payment'] = $journalEntryItem->debit !== "0" ? number_format(floatval($journalEntryItem->debit), 2, '.', ',') : "";
                    $transaction['charge_disabled'] = count($entries) > 2 || $journalEntryItem->credit === "0";
                    $transaction['payment_disabled'] = count($entries) > 2 || $journalEntryItem->debit === "0";
                break;
                case 'Asset' :
                    $transaction['increase'] = $journalEntryItem->credit !== "0" ? number_format(floatval($journalEntryItem->credit), 2, '.', ',') : "";
                    $transaction['decrease'] = $journalEntryItem->debit !== "0" ? number_format(floatval($journalEntryItem->debit), 2, '.', ',') : "";
                    $transaction['increase_disabled'] = count($entries) > 2 || $journalEntryItem->credit === "0";
                    $transaction['decrease_disabled'] = count($entries) > 2 || $journalEntryItem->debit === "0";
                break;
                case 'Liability' :
                    $transaction['increase'] = $journalEntryItem->credit !== "0" ? number_format(floatval($journalEntryItem->credit), 2, '.', ',') : "";
                    $transaction['decrease'] = $journalEntryItem->debit !== "0" ? number_format(floatval($journalEntryItem->debit), 2, '.', ',') : "";
                    $transaction['increase_disabled'] = count($entries) > 2 || $journalEntryItem->credit === "0";
                    $transaction['decrease_disabled'] = count($entries) > 2 || $journalEntryItem->debit === "0";
                break;
                default :
                    $transaction['payment'] = $journalEntryItem->credit !== "0" ? number_format(floatval($journalEntryItem->credit), 2, '.', ',') : "";
                    $transaction['deposit'] = $journalEntryItem->debit !== "0" ? number_format(floatval($journalEntryItem->debit), 2, '.', ',') : "";
                    $transaction['payment_disabled'] = count($entries) > 2 || $journalEntryItem->credit === "0";
                    $transaction['deposit_disabled'] = count($entries) > 2 || $journalEntryItem->debit === "0";
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function bill_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $billCategories = $this->chart_of_accounts_model->get_vendor_transaction_category_registers($accountId, 'Bill');

        foreach($billCategories as $billCategory) {
            $bill = $this->vendors_model->get_bill_by_id($billCategory->transaction_id, logged('company_id'));
            $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
            $payeeName = $payee->display_name;
            $categories = $this->expenses_model->get_transaction_categories($bill->id, 'Bill');
            $items = $this->expenses_model->get_transaction_items($bill->id, 'Bill');
            $count = count($categories) + count($items);

            $attachments = $this->accounting_attachments_model->get_attachments('Bill', $bill->id);

            $transaction = [
                'id' => $bill->id,
                'child_id' => $billCategory->id,
                'date' => date("m/d/Y", strtotime($bill->bill_date)),
                'ref_no' => $bill->bill_no === null ? '' : $bill->bill_no,
                'ref_no_disabled' => true,
                'type' => 'Bill',
                'payee_type' => 'vendor',
                'payee_id' => $bill->vendor_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => '',
                'account' => 'Accounts Payable',
                'account_disabled' => true,
                'memo' => $billCategory->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($billCategory->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = "";
                    $transaction['payment'] = number_format(floatval($billCategory->amount), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = $count > 1;
                break;
                case 'Asset' :
                    $transaction['increase'] = "";
                    $transaction['decrease'] = number_format(floatval($billCategory->amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                case 'Liability' :
                    $transaction['increase'] = "";
                    $transaction['decrease'] = number_format(floatval($billCategory->amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                default :
                    $transaction['payment'] = "";
                    $transaction['deposit'] = number_format(floatval($billCategory->amount), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = $count > 1;
                break;
            }

            $data[] = $transaction;
        }

        $billItems = $this->chart_of_accounts_model->get_vendor_transaction_item_registers($accountId, 'Bill');
        foreach($billItems as $billItem) {
            $bill = $this->vendors_model->get_bill_by_id($billItem->transaction_id, logged('company_id'));
            $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
            $payeeName = $payee->display_name;
            $categories = $this->expenses_model->get_transaction_categories($bill->id, 'Bill');
            $items = $this->expenses_model->get_transaction_items($bill->id, 'Bill');
            $count = count($categories) + count($items);

            $attachments = $this->accounting_attachments_model->get_attachments('Bill', $bill->id);

            $transaction = [
                'id' => $bill->id,
                'child_id' => $billItem->id,
                'date' => date("m/d/Y", strtotime($bill->bill_date)),
                'ref_no' => $bill->bill_no === null ? '' : $bill->bill_no,
                'ref_no_disabled' => true,
                'type' => 'Bill',
                'payee_type' => 'vendor',
                'payee_id' => $bill->vendor_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => '',
                'account' => 'Accounts Payable',
                'account_disabled' => true,
                'memo' => $billItem->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($billItem->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($billItem->total), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = $count > 1;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($billItem->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($billItem->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($billItem->total), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = $count > 1;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function cc_credit_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $ccCredits = $this->chart_of_accounts_model->get_credit_card_credit_registers($accountId);

        foreach($ccCredits as $ccCredit) {
            switch($ccCredit->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $account = $this->account_col($ccCredit->id, 'Credit Card Credit');

            $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $ccCredit->id);

            $transaction = [
                'id' => $ccCredit->id,
                'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                'ref_no' => $ccCredit->ref_no === null ? '' : $ccCredit->ref_no,
                'ref_no_disabled' => false,
                'type' => 'CC-Credit',
                'payee_type' => $ccCredit->payee_type,
                'payee_id' => $ccCredit->payee_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => $account['id'],
                'account' => $account['name'],
                'account_disabled' => $account['disabled'],
                'memo' => $ccCredit->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($ccCredit->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = $count > 1;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = $count > 1;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        $ccCreditCategories = $this->chart_of_accounts_model->get_vendor_transaction_category_registers($accountId, 'Credit Card Credit');

        foreach($ccCreditCategories as $ccCreditCategory) {
            $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($ccCreditCategory->transaction_id, logged('company_id'));
            $categories = $this->expenses_model->get_transaction_categories($ccCredit->id, 'Credit Card Credit');
            $items = $this->expenses_model->get_transaction_items($ccCredit->id, 'Credit Card Credit');
            $count = count($categories) + count($items);

            switch($ccCredit->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $ccCredit->id);

            $transaction = [
                'id' => $ccCredit->id,
                'child_id' => $ccCreditCategory->id,
                'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                'ref_no' => $ccCredit->ref_no === null ? '' : $ccCredit->ref_no,
                'ref_no_disabled' => true,
                'type' => 'CC-Credit',
                'payee_type' => $ccCredit->payee_type,
                'payee_id' => $ccCredit->payee_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => $ccCredit->bank_credit_account_id,
                'account' => $this->chart_of_accounts_model->getName($ccCredit->bank_credit_account_id),
                'account_disabled' => true,
                'memo' => $ccCreditCategory->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($ccCreditCategory->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = $count > 1;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($ccCredit->total_amount), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = $count > 1;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        $ccCreditItems = $this->chart_of_accounts_model->get_vendor_transaction_item_registers($accountId, 'Credit Card Credit');
        foreach($ccCreditItems as $ccCreditItem) {
            $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($ccCreditItem->transaction_id, logged('company_id'));
            $categories = $this->expenses_model->get_transaction_categories($ccCredit->id, 'Credit Card Credit');
            $items = $this->expenses_model->get_transaction_items($ccCredit->id, 'Credit Card Credit');
            $count = count($categories) + count($items);

            switch($ccCredit->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $ccCredit->id);

            $transaction = [
                'id' => $ccCredit->id,
                'child_id' => $ccCreditItem->id,
                'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                'ref_no' => $ccCredit->ref_no === null ? '' : $ccCredit->ref_no,
                'ref_no_disabled' => true,
                'type' => 'CC-Credit',
                'payee_type' => $ccCredit->payee_type,
                'payee_id' => $ccCredit->payee_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => $ccCredit->bank_credit_account_id,
                'account' => $this->chart_of_accounts_model->getName($ccCredit->bank_credit_account_id),
                'account_disabled' => true,
                'memo' => $ccCreditItem->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($ccCreditItem->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($ccCreditItem->total), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = $count > 1;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($ccCreditItem->total), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($ccCreditItem->total), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($ccCreditItem->total), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = $count > 1;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function vendor_credit_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $vCreditCategories = $this->chart_of_accounts_model->get_vendor_transaction_category_registers($accountId, 'Vendor Credit');

        foreach($vCreditCategories as $vCreditCategory) {
            $vCredit = $this->vendors_model->get_vendor_credit_by_id($vCreditCategory->transaction_id, logged('company_id'));
            $payee = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
            $payeeName = $payee->display_name;
            $categories = $this->expenses_model->get_transaction_categories($vCredit->id, 'Vendor Credit');
            $items = $this->expenses_model->get_transaction_items($vCredit->id, 'Vendor Credit');
            $count = count($categories) + count($items);

            $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $vCredit->id);

            $transaction = [
                'id' => $vCredit->id,
                'child_id' => $vCreditCategory->id,
                'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                'ref_no' => $vCredit->ref_no === null ? '' : $vCredit->ref_no,
                'ref_no_disabled' => true,
                'type' => 'Vendor Credit',
                'payee_type' => 'vendor',
                'payee_id' => $vCredit->vendor_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => '',
                'account' => 'Accounts Payable',
                'account_disabled' => true,
                'memo' => $vCreditCategory->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($vCreditCategory->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($vCreditCategory->amount), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = $count > 1;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($vCreditCategory->amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($vCreditCategory->amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($vCreditCategory->amount), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = $count > 1;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        $vCreditItems = $this->chart_of_accounts_model->get_vendor_transaction_item_registers($accountId, 'Vendor Credit');
        foreach($vCreditItems as $vCreditItem) {
            $vCredit = $this->vendors_model->get_vendor_credit_by_id($vCreditItem->transaction_id, logged('company_id'));
            $payee = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
            $payeeName = $payee->display_name;
            $categories = $this->expenses_model->get_transaction_categories($vCredit->id, 'Vendor Credit');
            $items = $this->expenses_model->get_transaction_items($vCredit->id, 'Vendor Credit');
            $count = count($categories) + count($items);

            $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $vCredit->id);

            $transaction = [
                'id' => $vCredit->id,
                'child_id' => $vCreditItem->id,
                'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                'ref_no' => $vCredit->ref_no === null ? '' : $vCredit->ref_no,
                'ref_no_disabled' => true,
                'type' => 'Vendor Credit',
                'payee_type' => 'vendor',
                'payee_id' => $vCredit->vendor_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => '',
                'account' => 'Accounts Payable',
                'account_disabled' => true,
                'memo' => $vCreditItem->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($vCreditItem->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($vCreditItem->total), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = $count > 1;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($vCreditItem->total), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($vCreditItem->total), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = $count > 1;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($vCreditItem->total), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = $count > 1;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function transfer_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $transfers = $this->chart_of_accounts_model->get_transfer_registers($accountId);

        foreach($transfers as $transfer) {
            if($transfer->transfer_from_account_id === $accountId) {
                $transferAcc = $this->chart_of_accounts_model->getName($transfer->transfer_to_account_id);
                $account_id = $transfer->transfer_to_account_id;
            } else {
                $transferAcc = $this->chart_of_accounts_model->getName($transfer->transfer_from_account_id);
                $account_id = $transfer->transfer_from_account_id;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Transfer', $transfer->id);

            $transaction = [
                'id' => $transfer->id,
                'date' => date("m/d/Y", strtotime($transfer->transfer_date)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Transfer',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'payee_disabled' => true,
                'account_id' => $account_id,
                'account' => $transferAcc,
                'account_disabled' => false,
                'memo' => $transfer->transfer_memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($transfer->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = $transfer->transfer_from_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                    $transaction['payment'] = $transfer->transfer_to_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                break;
                case 'Asset' :
                    $transaction['increase'] = $transfer->transfer_from_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                    $transaction['decrease'] = $transfer->transfer_to_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                break;
                case 'Liability' :
                    $transaction['increase'] = $transfer->transfer_from_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                    $transaction['decrease'] = $transfer->transfer_to_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                break;
                default :
                    $transaction['payment'] = $transfer->transfer_from_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                    $transaction['deposit'] = $transfer->transfer_to_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '';
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function deposit_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $deposits = $this->chart_of_accounts_model->get_deposit_registers($accountId);

        foreach($deposits as $deposit) {
            $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);

            if($accountId === $deposit->cash_back_account_id) {
                $account = $this->chart_of_accounts_model->getName($deposit->account_id);
                $accountDisabled = true;
                $accountFieldName = '';
                $account_id = $deposit->account_id;
            } else if(count($funds) > 1 || $deposit->cash_back_amount !== "" && $deposit->cash_back_account_id !== "" && !is_null($deposit->cash_back_amount) && !is_null($deposit->cash_back_account_id)) { 
                $account = '-Split-';
                $accountFieldName = '';
                $accountDisabled = true;
                $account_id = null;
            } else {
                $account = $this->chart_of_accounts_model->getName($funds[0]->received_from_account_id);
                $account_id = $funds[0]->received_from_account_id;
                $accountFieldName = 'funds-account';
                $accountDisabled = false;
            }
            $attachments = $this->accounting_attachments_model->get_attachments('Deposit', $deposit->id);

            $transaction = [
                'id' => $deposit->id,
                'date' => date("m/d/Y", strtotime($deposit->date)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Deposit',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'payee_disabled' => true,
                'account_id' => $account_id,
                'account' => $account,
                'account_field' => $accountFieldName,
                'account_disabled' => $accountDisabled,
                'memo' => $deposit->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($deposit->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($deposit->total_amount), 2, '.', ',');

                    if($accountId === $deposit->cash_back_account_id) {
                        $transaction['payment'] = number_format(floatval($deposit->cash_back_amount), 2, '.', ',');
                    }
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($deposit->total_amount), 2, '.', ',');

                    if($accountId === $deposit->cash_back_account_id) {
                        $transaction['decrease'] = number_format(floatval($deposit->cash_back_amount), 2, '.', ',');
                    }
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($deposit->total_amount), 2, '.', ',');

                    if($accountId === $deposit->cash_back_account_id) {
                        $transaction['decrease'] = number_format(floatval($deposit->cash_back_amount), 2, '.', ',');
                    }
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($deposit->total_amount), 2, '.', ',');

                    if($accountId === $deposit->cash_back_account_id) {
                        $transaction['deposit'] = number_format(floatval($deposit->cash_back_amount), 2, '.', ',');
                    }
                break;
            }

            $data[] = $transaction;
        }

        $depositFunds = $this->chart_of_accounts_model->get_deposit_payment_registers($accountId);

        foreach($depositFunds as $depFund) {
            $dep = $this->accounting_bank_deposit_model->getById($depFund->bank_deposit_id, logged('company_id'));
            $depFunds = $this->accounting_bank_deposit_model->getFunds($dep->id);

            $attachments = $this->accounting_attachments_model->get_attachments('Deposit', $dep->id);

            $transaction = [
                'id' => $dep->id,
                'child_id' => $depFund->id,
                'date' => date("m/d/Y", strtotime($dep->date)),
                'ref_no' => $depFund->ref_no,
                'ref_no_disabled' => false,
                'type' => 'Deposit',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'payee_disabled' => true,
                'account_id' => $dep->account_id,
                'account' => $this->chart_of_accounts_model->getName($dep->account_id),
                'account_field' => '',
                'account_disabled' => true,
                'memo' => $dep->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($depFund->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($depFund->amount), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = count($depFunds) > 1 || floatval($dep->cash_back_amount) > 0.00;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($depFund->amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = count($depFunds) > 1 || floatval($dep->cash_back_amount) > 0.00;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($depFund->amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = count($depFunds) > 1 || floatval($dep->cash_back_amount) > 0.00;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($depFund->amount), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = count($depFunds) > 1 || floatval($dep->cash_back_amount) > 0.00;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function cash_expense_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $expenses = $this->chart_of_accounts_model->get_expense_registers($accountId);

        foreach($expenses as $expense) {
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);
            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccountType = $this->account_model->getById($paymentAcc->account_id);
            $detailType = $this->account_detail_model->getById($paymentAcc->acc_detail_id);

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            $account = $this->account_col($expense->id, 'Expense');

            if($paymentAccountType->account_name === 'Bank' && $detailType->acc_detail_name === 'Cash on hand') {
                $transaction = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => false,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $account['id'],
                    'account' => $account['name'],
                    'account_disabled' => $account['disabled'],
                    'account_field' => $account['field_name'],
                    'memo' => $expense->memo,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['payment'] = '';
                        $transaction['charge_disabled'] = $count > 1;
                        $transaction['payment_disabled'] = true;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    default :
                        $transaction['payment'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['deposit'] = '';
                        $transaction['payment_disabled'] = $count > 1;
                        $transaction['deposit_disabled'] = true;
                    break;
                }
    
                $data[] = $transaction;
            }
        }

        $expenseCategories = $this->chart_of_accounts_model->get_vendor_transaction_category_registers($accountId, 'Expense');

        foreach($expenseCategories as $expenseCategory) {
            $expense = $this->vendors_model->get_expense_by_id($expenseCategory->transaction_id, logged('company_id'));
            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);
            $detailType = $this->account_detail_model->getById($account->acc_detail_id);
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            if($accountType->account_name === 'Bank' && $detailType->acc_detail_name === 'Cash on hand') {
                $transaction = [
                    'id' => $expense->id,
                    'child_id' => $expenseCategory->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $account->id,
                    'account' => $account->name,
                    'account_disabled' => true,
                    'account_field' => '',
                    'memo' => $expenseCategory->description,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = '';
                        $transaction['payment'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['charge_disabled'] = true;
                        $transaction['payment_disabled'] = $count > 1;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = '';
                        $transaction['decrease'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = $count > 1;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = '';
                        $transaction['decrease'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = $count > 1;
                    break;
                    default :
                        $transaction['payment'] = '';
                        $transaction['deposit'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['payment_disabled'] = true;
                        $transaction['deposit_disabled'] = $count > 1;
                    break;
                }
    
                $data[] = $transaction;
            }
        }

        $expenseItems = $this->chart_of_accounts_model->get_vendor_transaction_item_registers($accountId, 'Expense');
        foreach($expenseItems as $expenseItem) {
            $expense = $this->vendors_model->get_expense_by_id($expenseItem->transaction_id, logged('company_id'));
            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);
            $detailType = $this->account_detail_model->getById($account->acc_detail_id);
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            if($accountType->account_name === 'Bank' && $detailType->acc_detail_name === 'Cash on hand') {
                $transaction = [
                    'id' => $expense->id,
                    'child_id' => $expenseItem->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $account->id,
                    'account' => $account->name,
                    'account_disabled' => true,
                    'account_field' => '',
                    'memo' => $expenseItem->description,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = '';
                        $transaction['payment'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['charge_disabled'] = true;
                        $transaction['payment_disabled'] = $count > 1;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    default :
                        $transaction['payment'] = '';
                        $transaction['deposit'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['payment_disabled'] = true;
                        $transaction['deposit_disabled'] = $count > 1;
                    break;
                }

                $data[] = $transaction;
            }
        }

        return $data;
    }

    private function sales_receipt_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }

        $salesReceipts = $this->chart_of_accounts_model->get_sales_receipt_registers($accountId);

        foreach($salesReceipts as $salesReceipt) {
            $payee = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Sales Receipt', $salesReceipt->id);

            $transaction = [
                'id' => $salesReceipt->id,
                'date' => date("m/d/Y", strtotime($salesReceipt->sales_receipt_date)),
                'ref_no' => $salesReceipt->ref_number,
                'ref_no_disabled' => false,
                'type' => 'Sales Receipt',
                'payee_type' => 'customer',
                'payee_id' => $salesReceipt->customer_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => '',
                'account' => '',
                'account_disabled' => true,
                'account_field' => '',
                'memo' => $salesReceipt->message,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($salesReceipt->date_created))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($salesReceipt->amount), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($salesReceipt->amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($salesReceipt->amount), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($salesReceipt->amount), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function credit_memo_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }

        $creditMemoItems = $this->chart_of_accounts_model->get_credit_memo_registers($accountId);

        foreach($creditMemoItems as $item) {
            $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($item->type_id);
            $payee = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Credit Memo', $creditMemo->id);

            $transaction = [
                'id' => $creditMemo->id,
                'child_id' => $item->id,
                'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Credit Memo',
                'payee_type' => 'customer',
                'payee_id' => $creditMemo->customer_id,
                'payee' => $payeeName,
                'payee_disabled' => true,
                'account_id' => '',
                'account' => 'Accounts Receivable',
                'account_disabled' => true,
                'account_field' => '',
                'memo' => $item->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($item->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function refund_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }

        $refundReceipts = $this->chart_of_accounts_model->get_refund_from_registers($accountId);

        foreach($refundReceipts as $refundReceipt) {
            $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Refund Receipt', $refundReceipt->id);

            $transaction = [
                'id' => $refundReceipt->id,
                'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Refund',
                'payee_type' => 'customer',
                'payee_id' => $refundReceipt->customer_id,
                'payee' => $payeeName,
                'payee_disabled' => false,
                'account_id' => $refundReceipt->refund_form,
                'account' => $this->chart_of_accounts_model->getName($refundReceipt->refund_form),
                'account_disabled' => true,
                'memo' => $refundReceipt->message_statement,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($refundReceipt->date_created))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($refundReceipt->total_amount), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($refundReceipt->total_amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($refundReceipt->total_amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($refundReceipt->total_amount), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        $refundReceiptItems = $this->chart_of_accounts_model->get_refund_item_registers($accountId);

        foreach($refundReceiptItems as $item) {
            $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails($item->type_id)[0];
            $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Refund Receipt', $refundReceipt->id);

            $transaction = [
                'id' => $refundReceipt->id,
                'child_id' => $item->id,
                'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Refund',
                'payee_type' => 'customer',
                'payee_id' => $refundReceipt->customer_id,
                'payee' => $payeeName,
                'payee_disabled' => true,
                'account_id' => $refundReceipt->refund_form,
                'account' => $this->chart_of_accounts_model->getById($refundReceipt->refund_form),
                'account_disabled' => true,
                'account_field' => '',
                'memo' => $item->description,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($item->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = $count > 1;
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['decrease'] = '';
                    $transaction['increase_disabled'] = $count > 1;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($item->total), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = $count > 1;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function quantity_adjustment_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $invQtyAdjs = $this->chart_of_accounts_model->get_qty_adjustments_registers($accountId);

        foreach($invQtyAdjs as $invQtyAdj) {
            $adjustedItems = $this->accounting_inventory_qty_adjustments_model->get_adjusted_products($invQtyAdj->id);

            $payment = 0.00;
            foreach($adjustedItems as $adjustedItem) {
                $startingValAdj = $this->starting_value_model->get_by_item_id($adjustedItem->product_id);

                if(!is_null($startingValAdj)) {
                    $payment += floatval($adjustedItem->change_in_quantity) * floatval($startingValAdj->initial_cost);
                } else {
                    $item = $this->items_model->getItemById($adjustedItem->product_id)[0];
                    $payment += floatval($adjustedItem->change_in_quantity) *  floatval($item->cost);
                }
            }

            $transaction = [
                'id' => $invQtyAdj->id,
                'date' => date("m/d/Y", strtotime($invQtyAdj->adjustment_date)),
                'ref_no' => $invQtyAdj->adjustment_no === null ? '' : $invQtyAdj->adjustment_no,
                'ref_no_disabled' => true,
                'type' => 'Inventory Qty Adjust',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'payee_disabled' => true,
                'account_id' => $invQtyAdj->inventory_adjustment_account_id,
                'account' => $this->chart_of_accounts_model->getName($invQtyAdj->inventory_adjustment_account_id),
                'account_disabled' => true,
                'memo' => $invQtyAdj->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($invQtyAdj->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format($payment, 2, '.', ',');
                    $transaction['payment'] = '';
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format($payment, 2, '.', ',');
                    $transaction['decrease'] = '';
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format($payment, 2, '.', ',');
                    $transaction['decrease'] = '';
                break;
                default :
                    $transaction['payment'] = number_format($payment, 2, '.', ',');
                    $transaction['deposit'] = '';
                break;
            }

            $data[] = $transaction;
        }

        $invQtyAdjItems = $this->chart_of_accounts_model->get_qty_adjustment_item_registers($accountId);

        foreach($invQtyAdjItems as $invQtyAdjItem) {
            $invQtyAdj = $this->accounting_inventory_qty_adjustments_model->get_by_id($invQtyAdjItem->adjustment_id);

            $startingValAdj = $this->starting_value_model->get_by_item_id($invQtyAdjItem->product_id);

            if(!is_null($startingValAdj)) {
                $payment = floatval($invQtyAdjItem->change_in_quantity) * floatval($startingValAdj->initial_cost);
            } else {
                $item = $this->items_model->getItemById($invQtyAdjItem->product_id)[0];
                $payment = floatval($invQtyAdjItem->change_in_quantity) *  floatval($item->cost);
            }

            $transaction = [
                'id' => $invQtyAdj->id,
                'date' => date("m/d/Y", strtotime($invQtyAdj->adjustment_date)),
                'ref_no' => $invQtyAdj->adjustment_no === null ? '' : $invQtyAdj->adjustment_no,
                'type' => 'Inventory Qty Adjust',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account_id' => $invQtyAdj->inventory_adjustment_account_id,
                'account' => $this->chart_of_accounts_model->getName($invQtyAdj->inventory_adjustment_account_id),
                'memo' => $invQtyAdj->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($invQtyAdjItem->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format($payment, 2, '.', ',');
                    $transaction['payment'] = '';
                break;
                case 'Asset' :
                    $transaction['increase'] = number_format($payment, 2, '.', ',');
                    $transaction['decrease'] = '';
                break;
                case 'Liability' :
                    $transaction['increase'] = number_format($payment, 2, '.', ',');
                    $transaction['decrease'] = '';
                break;
                default :
                    $transaction['payment'] = number_format($payment, 2, '.', ',');
                    $transaction['deposit'] = '';
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function expense_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $expenses = $this->chart_of_accounts_model->get_expense_registers($accountId);

        foreach($expenses as $expense) {
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);
            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            $account = $this->account_col($expense->id, 'Expense');

            if($paymentAccType->account_name !== 'Credit Card') {
                $transaction = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => false,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $account['id'],
                    'account' => $account['name'],
                    'account_field' => $account['field_name'],
                    'account_disabled' => $account['disabled'],
                    'memo' => $expense->memo,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['payment'] = '';
                        $transaction['charge_disabled'] = $count > 1;
                        $transaction['payment_disabled'] = true;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    default :
                        $transaction['payment'] = number_format(floatval($expense->total_amount), 2, '.', ',');
                        $transaction['deposit'] = '';
                        $transaction['payment_disabled'] = $count > 1;
                        $transaction['deposit_disabled'] = true;
                    break;
                }
    
                $data[] = $transaction;
            }
        }

        $expenseCategories = $this->chart_of_accounts_model->get_vendor_transaction_category_registers($accountId, 'Expense');

        foreach($expenseCategories as $expenseCategory) {
            $expense = $this->vendors_model->get_expense_by_id($expenseCategory->transaction_id, logged('company_id'));
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            if($paymentAccType->account_name !== 'Credit Card') {
                $transaction = [
                    'id' => $expense->id,
                    'child_id' => $expenseCategory->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $paymentAcc->id,
                    'account' => $paymentAcc->name,
                    'account_disabled' => true,
                    'account_field' => '',
                    'memo' => $expenseCategory->description,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = '';
                        $transaction['payment'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['charge_disabled'] = true;
                        $transaction['payment_disabled'] = $count > 1;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = '';
                        $transaction['decrease'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = $count > 1;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = '';
                        $transaction['decrease'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = $count > 1;
                    break;
                    default :
                        $transaction['payment'] = '';
                        $transaction['deposit'] = number_format(floatval($expenseCategory->amount), 2, '.', ',');
                        $transaction['payment_disabled'] = true;
                        $transaction['deposit_disabled'] = $count > 1;
                    break;
                }

                $data[] = $transaction;
            }
        }

        $expenseItems = $this->chart_of_accounts_model->get_vendor_transaction_item_registers($accountId, 'Expense');
        foreach($expenseItems as $expenseItem) {
            $expense = $this->vendors_model->get_expense_by_id($expenseItem->transaction_id, logged('company_id'));
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);

            if($paymentAccType->account_name !== 'Credit Card') {
                $transaction = [
                    'id' => $expense->id,
                    'child_id' => $expenseItem->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $account->id,
                    'account' => $account->name,
                    'account_disabled' => true,
                    'account_field' => '',
                    'memo' => $expenseItem->description,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = '';
                        $transaction['payment'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['charge_disabled'] = true;
                        $transaction['payment_disabled'] = $count > 1;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = $count > 1;
                        $transaction['decrease_disabled'] = true;
                    break;
                    default :
                        $transaction['payment'] = '';
                        $transaction['deposit'] = number_format(floatval($expenseItem->total), 2, '.', ',');
                        $transaction['payment_disabled'] = true;
                        $transaction['deposit_disabled'] = $count > 1;
                    break;
                }

                $data[] = $transaction;
            }
        }

        return $data;
    }

    private function item_starting_value_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $adjustments = $this->chart_of_accounts_model->get_adjustment_acc_starting_value_registers($accountId);

        foreach($adjustments as $adjustment) {
            $transaction = [
                'id' => $adjustment->id,
                'date' => date("m/d/Y", strtotime($adjustment->as_of_date)),
                'ref_no' => $adjustment->ref_no === null ? '' : $adjustment->ref_no,
                'ref_no_disabled' => false,
                'type' => 'Inventory Starting Value',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'payee_disabled' => true,
                'account_id' => $adjustment->inv_asset_account,
                'account' => $this->chart_of_accounts_model->getName($adjustment->inv_asset_account),
                'account_disabled' => false,
                'account_field' => 'inventory-asset-account',
                'memo' => $adjustment->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($adjustment->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $transaction['payment'] = '';
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $transaction['deposit'] = '';
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        $adjustedItems = $this->chart_of_accounts_model->get_adjusted_starting_value_registers($accountId);

        foreach($adjustedItems as $adjusted) {
            $transaction = [
                'id' => $adjusted->id,
                'date' => date("m/d/Y", strtotime($adjusted->as_of_date)),
                'ref_no' => $adjusted->ref_no === null ? '' : $adjusted->ref_no,
                'ref_no_disabled' => false,
                'type' => 'Inventory Starting Value',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'payee_disabled' => true,
                'account_id' => $adjusted->inv_adj_account,
                'account' => $this->chart_of_accounts_model->getName($adjusted->inv_adj_account),
                'account_disabled' => false,
                'account_field' => 'inventory-adj-account',
                'memo' => $adjusted->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($adjusted->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = '';
                    $transaction['payment'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $transaction['charge_disabled'] = true;
                    $transaction['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $transaction['increase'] = '';
                    $transaction['decrease'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $transaction['increase_disabled'] = true;
                    $transaction['decrease_disabled'] = true;
                break;
                default :
                    $transaction['payment'] = '';
                    $transaction['deposit'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $transaction['payment_disabled'] = true;
                    $transaction['deposit_disabled'] = true;
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function credit_card_payment_registers($accountId, $data = [])
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $ccPayments = $this->chart_of_accounts_model->get_credit_card_payment_registers($accountId);

        foreach($ccPayments as $ccPayment) {
            $payee = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
            $payeeName = !is_null($payee) ? $payee->display_name : "";

            $account = $ccPayment->credit_card_id === $accountId ? $this->chart_of_accounts_model->getName($ccPayment->bank_account_id) : $this->chart_of_accounts_model->getName($ccPayment->credit_card_id);
            $account_id = $ccPayment->credit_card_id === $accountId ? $ccPayment->bank_account_id : $ccPayment->credit_card_id;
            $accountFieldName = $ccPayment->credit_card_id === $accountId ? 'bank-account' : 'credit-card-account';

            $attachments = $this->accounting_attachments_model->get_attachments('CC Payment', $ccPayment->id);

            $transaction = [
                'id' => $ccPayment->id,
                'date' => date("m/d/Y", strtotime($ccPayment->date)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Credit Card Pmt',
                'payee_type' => 'vendor',
                'payee_id' => $ccPayment->payee_id,
                'payee' => $payeeName,
                'payee_disabled' => true,
                'account_id' => $account_id,
                'account' => $account,
                'account_disabled' => false,
                'account_field' => $accountFieldName,
                'memo' => $ccPayment->memo,
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => count($attachments) > 0 ? count($attachments) : '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($ccPayment->created_at))
            ];

            switch($accType) {
                case 'Credit Card' :
                    $transaction['charge'] = $ccPayment->bank_account_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                    $transaction['payment'] = $ccPayment->credit_card_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                break;
                case 'Asset' :
                    $transaction['increase'] = $ccPayment->bank_account_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                    $transaction['decrease'] = $ccPayment->credit_card_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                break;
                case 'Liability' :
                    $transaction['increase'] = $ccPayment->bank_account_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                    $transaction['decrease'] = $ccPayment->credit_card_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                break;
                default :
                    $transaction['payment'] = $ccPayment->bank_account_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                    $transaction['deposit'] = $ccPayment->credit_card_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '';
                break;
            }

            $data[] = $transaction;
        }

        return $data;
    }

    private function bill_payment_registers($accountId, $data = [], $creditCard = false)
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else {
            $accType = $accountType->account_name;
        }
        $billPayments = $this->chart_of_accounts_model->get_bill_payment_registers($accountId);

        foreach($billPayments as $billPayment) {
            $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
            $account = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);

            $attachments = $this->accounting_attachments_model->get_attachments('Bill Payment', $billPayment->id);

            if($creditCard === true && $accountType->account_name === 'Credit Card' || $creditCard === false) {
                $transaction = [
                    'id' => $billPayment->id,
                    'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                    'ref_no' => $billPayment->to_print_check_no === "1" ? "To print" : ($billPayment->check_no === null ? '' : $billPayment->check_no),
                    'ref_no_disabled' => false,
                    'type' => 'Bill Payment',
                    'payee_type' => 'vendor',
                    'payee_id' => $billPayment->payee_id,
                    'payee' => $payee->display_name,
                    'payee_disabled' => true,
                    'account_id' => '',
                    'account' => 'Accounts Payable',
                    'account_disabled' => true,
                    'memo' => $billPayment->memo,
                    'payment' => number_format(floatval($billPayment->total_amount), 2, '.', ','),
                    'deposit' => '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($billPayment->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        $transaction['charge'] = number_format(floatval($billPayment->total_amount), 2, '.', ',');
                        $transaction['payment'] = '';
                        $transaction['charge_disabled'] = true;
                        $transaction['payment_disabled'] = true;
                    break;
                    case 'Asset' :
                        $transaction['increase'] = number_format(floatval($billPayment->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = true;
                    break;
                    case 'Liability' :
                        $transaction['increase'] = number_format(floatval($billPayment->total_amount), 2, '.', ',');
                        $transaction['decrease'] = '';
                        $transaction['increase_disabled'] = true;
                        $transaction['decrease_disabled'] = true;
                    break;
                    default :
                        $transaction['payment'] = number_format(floatval($billPayment->total_amount), 2, '.', ',');
                        $transaction['deposit'] = '';
                        $transaction['payment_disabled'] = true;
                        $transaction['deposit_disabled'] = true;
                    break;
                }
    
                $data[] = $transaction;
            }
        }

        return $data;
    }

    private function account_col($transactionId, $transactionType)
    {
        $categories = $this->expenses_model->get_transaction_categories($transactionId, $transactionType);
        $items = $this->expenses_model->get_transaction_items($transactionId, $transactionType);

        $totalCount = count($categories) + count($items);

        if ($totalCount > 1) {
            $category = [
                'id' => null,
                'name' => '-Split-',
                'disabled' => true,
                'field_name' => ''
            ];
        } else {
            if ($totalCount === 1) {
                $category = [];
                if (count($categories) === 1 && count($items) === 0) {
                    $expenseAcc = $categories[0]->expense_account_id;
                    $category['id'] = $categories[0]->expense_account_id;
                    $category['disabled'] = false;
                    $category['field_name'] = 'expense-account';
                } else {
                    $itemId = $items[0]->item_id;
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($itemId);
                    $expenseAcc = $itemAccDetails->inv_asset_acc_id;
                    $category['id'] = $itemAccDetails->inv_asset_acc_id;
                    $category['disabled'] = true;
                    $category['field_name'] = '';
                }

                $category['name'] = $this->chart_of_accounts_model->getName($expenseAcc);
            }
        }

        return $category;
    }

    public function print_transactions($accountId)
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);
        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }

        $balance = '$'.number_format(floatval($account->balance), 2, '.', ',');
        $balance = str_replace('$-', '-$', $balance);
        $post = $this->input->post();
        $sort = [
            'column' => $post['column'],
            'order' => $post['order']
        ];

        $data = $this->get_transactions($accountId, $post, $sort);

        $html = "<h3 style='text-align: center'>$account->name Ending Balance: $balance</h3>";
        $html .= "<table width='100%'>";
        $html .= "<thead>";
        $html .= "<tr style='text-align: left;'>";

        if($accType === 'A/R' || $accType === 'A/P') {

        } else {
            switch($accType) {
                case 'Credit Card' :
                    $paymentKey = 'Charge';
                    $depositKey = 'Payment';
                break;
                case 'Asset' :
                    $paymentKey = 'Increase';
                    $depositKey = 'Decrease';
                break;
                case 'Liability' :
                    $paymentKey = 'Increase';
                    $depositKey = 'Decrease';
                break;
                default :
                    $paymentKey = 'Payment';
                    $depositKey = 'Deposit';
                break;
            }

            $html .= "<th style='border-bottom: 2px solid #BFBFBF'>Date</th>";
            $html .= "<th style='border-bottom: 2px solid #BFBFBF'>Ref No.</th>";
            $html .= $post['show_in_one_line'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>" : "";
            $html .= "<th style='border-bottom: 2px solid #BFBFBF'>Payee</th>";
            $html .= $post['show_in_one_line'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Account</th>" : "";
            $html .= $post['chk_memo'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Memo</th>" : "";
            $html .= "<th style='border-bottom: 2px solid #BFBFBF'>$paymentKey</th>";
            $html .= "<th style='border-bottom: 2px solid #BFBFBF'>$depositKey</th>";
            $html .= $post['chk_reconcile_status'] === "1" || $post['chk_reconcile_banking_status'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Stat</th>" : "";
            $html .= $post['chk_banking_status'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Auto</th>" : "";
            $html .= $post['chk_attachments'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Attachments</th>" : "";
            $html .= $post['chk_tax'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Tax</th>" : "";
            $html .= $post['chk_running_balance'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Balance</th>" : "";

            if($post['show_in_one_line'] === "0") {
                $html .= "<tr style='text-align: left;'>";
                $html .= "<th style='border-bottom: 2px solid #BFBFBF'></th>";
                $html .= "<th style='border-bottom: 2px solid #BFBFBF'>Type</th>";
                $html .= "<th style='border-bottom: 2px solid #BFBFBF'>Account</th>";
                $html .= $post['chk_memo'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'></th>" : "";
                $html .= "<th style='border-bottom: 2px solid #BFBFBF'></th>";
                $html .= "<th style='border-bottom: 2px solid #BFBFBF'></th>";
                $html .= $post['chk_reconcile_banking_status'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'>Auto</th>" : "";
                $html .= $post['chk_attachments'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'></th>" : "";
                $html .= $post['chk_tax'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'></th>" : "";
                $html .= $post['chk_running_balance'] === "1" ? "<th style='border-bottom: 2px solid #BFBFBF'></th>" : "";
                $html .= "</tr>";
            }
        }
        $html .= "</tr>";
        $html .= "</thead>";
        $html .= "<tbody>";
        foreach($data as $register) {
            $html .= "<tr>";
            $html .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['date']."</td>";
            $html .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['ref_no']."</td>";
            $html .= $post['show_in_one_line'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['type']."</td>" : "";
            $html .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['payee']."</td>";
            $html .= $post['show_in_one_line'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['account']."</td>" : "";
            $html .= $post['chk_memo'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['memo']."</td>" : "";

            if($accType === 'A/R' || $accType === 'A/P') {

            } else {
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$register[strtolower($paymentKey)]."</td>";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$register[strtolower($depositKey)]."</td>";
            }
            $html .= $post['chk_reconcile_status'] === "1" || $post['chk_reconcile_banking_status'] ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['reconcile_status']."</td>" : "";
            $html .= $post['chk_banking_status'] === "1" && $post['show_in_one_line'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['banking_status']."</td>" : "";
            $html .= $post['chk_attachments'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['attachments']."</td>" : "";
            $html .= $post['chk_tax'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['tax']."</td>" : "";
            $balance = $register['balance'] !== null && $register['balance'] !== '' ? $register['balance'] : 'n/a';
            $html .= $post['chk_running_balance'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'>$balance</td>" : "";
            $html .= "</tr>";

            if($post['show_in_one_line'] === "0") {
                $html .= "<tr>";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'></td>";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['type']."</td>";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'>".$register['account']."</td>";
                $html .= $post['chk_memo'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'></td>" : "";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'></td>";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'></td>";
                $html .= $post['chk_reconcile_banking_status'] === "1" ? "<td style='border-bottom: 1px dotted #D5CDB5'></td>" : "";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'></td>";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'></td>";
                $html .= "<td style='border-bottom: 1px dotted #D5CDB5'></td>";
                $html .= "</tr>";
            }
        }
        $html .= "</tbody>";
        $html .= "</table>";

        echo $html;
    }

    public function export_transactions($accountId)
    {
        $this->load->library('PHPXLSXWriter');
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);
        if(stripos($accountType->account_name, 'Asset') !== false) {
            $accType = 'Asset';
        } else if(stripos($accountType->account_name, 'Liabilities') !== false) {
            $accType = 'Liability';
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }

        $balance = '$'.number_format(floatval($account->balance), 2, '.', ',');
        $balance = str_replace('$-', '-$', $balance);
        $post = $this->input->post();
        $sort = [
            'column' => $post['column'],
            'order' => $post['order']
        ];

        $data = $this->get_transactions($accountId, $post, $sort);

        $writer = new XLSXWriter();
        $topHeader = [
            "$account->name · Ending Balance: $balance"
        ];
        $writer->writeSheetRow('Sheet1', $topHeader, ['halign' => 'center', 'valign' => 'center', 'font-style' => 'bold']);

        switch($accType) {
            case 'Credit Card' :
                $paymentKey = 'Charge';
                $depositKey = 'Payment';
            break;
            case 'Asset' :
                $paymentKey = 'Increase';
                $depositKey = 'Decrease';
            break;
            case 'Liability' :
                $paymentKey = 'Increase';
                $depositKey = 'Decrease';
            break;
            default :
                $paymentKey = 'Payment';
                $depositKey = 'Deposit';
            break;
        }

        $header = [
            'Date',
            'Ref No.',
            'Type',
            'Payee',
            'Account',
            'Memo',
            $paymentKey,
            $depositKey,
            'Reconciliation Status',
            'Added in Banking',
            'Attachments',
            'Tax',
            'Balance'
        ];

        if($post['show_in_one_line'] === "0") {
            unset($header[2]);
            unset($header[4]);
            unset($header[9]);
            $header[] = 'Type';
            $header[] = 'Account';

            if($post['chk_reconcile_banking_status'] === "1") {
                $header[] = 'Added in Banking';
            }
        }

        if($post['chk_memo'] === "0") {
            unset($header[5]);
            unset($topHeader[5]);
        }

        if($post['chk_reconcile_status'] === "0" || $post['chk_reconcile_banking_status'] === "0") {
            unset($header[8]);
            unset($topHeader[8]);
        }

        if($post['chk_banking_status'] === "0" || $post['chk_reconcile_banking_status'] === "0") {
            unset($header[9]);
            unset($topHeader[9]);
        }

        if($post['chk_attachments'] === "0") {
            unset($header[10]);
            unset($topHeader[10]);
        }

        if($post['chk_tax'] === "0") {
            unset($header[11]);
            unset($topHeader[1]);
        }

        if($post['chk_running_balance'] === "0") {
            unset($header[12]);
            unset($topHeader[12]);
        }

        $writer->markMergedCell('Sheet1', 0, 0, 0, count($header) - 1);
        $writer->writeSheetRow('Sheet1', $header, ['font-style' => 'bold', 'border' => 'bottom', 'halign' => 'center', 'valign' => 'center']);

        foreach($data as $register) {
            $entry = [
                $register['date'],
                $register['ref_no'],
                $register['type'],
                $register['payee'],
                $register['account'],
                $register['memo'],
                $register[strtolower($paymentKey)],
                $register[strtolower($depositKey)],
                $register['reconcile_status'],
                $register['banking_status'],
                $register['attachments'],
                $register['tax'],
                $register['balance']
            ];

            if($post['show_in_one_line'] === "0") {
                unset($entry[2]);
                unset($entry[4]);
            }

            if($post['chk_memo'] === "0") {
                unset($entry[5]);
            }
    
            if($post['chk_reconcile_status'] === "0" || $post['chk_reconcile_banking_status'] === "0") {
                unset($entry[8]);
            }
    
            if($post['chk_banking_status'] === "0" || $post['show_in_one_line'] === "0") {
                unset($entry[9]);
            }
    
            if($post['chk_attachments'] === "0") {
                unset($entry[10]);
            }
    
            if($post['chk_tax'] === "0") {
                unset($entry[11]);
            }
    
            if($post['chk_running_balance'] === "0") {
                unset($entry[12]);
            }

            if($post['show_in_one_line'] === "0") {
                $entry[] = $register['type'];
                $entry[] = $register['account'];

                if($post['chk_reconcile_banking_status'] === "1") {
                    $entry[] = $register['banking_status'];
                }
            }

            $writer->writeSheetRow('Sheet1', $entry);
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Register.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->writeToStdOut();
    }

    public function save_transaction($accountId, $transactionId)
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $post = $this->input->post();

        switch($post['type']) {
            case 'Credit Card Pmt' :
                $return = $this->save_cc_payment($accountId, $transactionId, $post);
            break;
            case 'Inventory Starting Value' :
                $return = $this->save_inventory_starting_value($accountId, $transactionId, $post);
            break;
            case 'Journal' :
                $return = $this->save_journal($accountId, $transactionId, $post);
            break;
            case 'Transfer' :
                $return = $this->save_transfer($accountId, $transactionId, $post);
            break;
            case 'Deposit' :
                $return = $this->save_deposit($accountId, $transactionId, $post);
            break;
            case 'CC-Credit' :
                $return = $this->save_cc_credit($accountId, $transactionId, $post);
            break;
            case 'Vendor Credit' :
                $return = $this->save_vendor_credit($accountId, $transactionId, $post);
            break;
            case 'Bill Payment' :
                $return = $this->save_bill_payment($accountId, $transactionId, $post);
            break;
            case 'Bill' :
                $return = $this->save_bill($accountId, $transactionId, $post);
            break;
            case 'Check' :
                $return = $this->save_check($accountId, $transactionId, $post);
            break;
            case 'Expense' :
                $return = $this->save_expense($accountId, $transactionId, $post);
            break;
            case 'CC Expense' :
                $return = $this->save_expense($accountId, $transactionId, $post);
            break;
        }

        echo json_encode($return);
    }

    private function save_cc_payment($accountId, $paymentId, $data)
    {
        $payment = $this->accounting_pay_down_credit_card_model->get_by_id($paymentId);
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $updateData = [
            'credit_card_id' => $data['credit_card_account'] !== null ? $data['credit_card_account'] : $payment->credit_card_id,
            'amount' => $amount,
            'date' => date('Y-m-d', strtotime($data['date'])),
            'bank_account_id' => $data['bank_account'] !== null ? $data['bank_account'] : $payment->bank_account_id,
            'memo' => $data['memo']
        ];

        $update = $this->accounting_pay_down_credit_card_model->update($paymentId, $updateData);

        if ($update) {
            // REVERT OLD
            $oldCreditAcc = $this->chart_of_accounts_model->getById($payment->credit_card_id);

            $newBalance = floatval($oldCreditAcc->balance) + floatval($payment->amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $this->chart_of_accounts_model->updateBalance(['id' => $oldCreditAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);

            $oldBank = $this->chart_of_accounts_model->getById($payment->bank_account_id);

            $newBalance = floatval($oldBank->balance) + floatval($payment->amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $this->chart_of_accounts_model->updateBalance(['id' => $oldBank->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);

            // NEW
            $creditAcc = $this->chart_of_accounts_model->getById($updateData['credit_card_id']);

            $newBalance = floatval($creditAcc->balance) - floatval($updateData['amount']);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $this->chart_of_accounts_model->updateBalance(['id' => $creditAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);

            $bankAcc = $this->chart_of_accounts_model->getById($updateData['bank_account_id']);

            $newBalance = floatval($bankAcc->balance) - floatval($updateData['amount']);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $this->chart_of_accounts_model->updateBalance(['id' => $bankAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);
        }

        $return = [
            'data' => $paymentId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];

        return $return;
    }

    private function save_transfer($accountId, $transferId, $data)
    {
        $transfer = $this->accounting_transfer_funds_model->getById($transferId, logged('company_id'));
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $transferData = [
            'transfer_from_account_id' => $accountId === $transfer->transfer_to_account_id ? $data['transfer_account'] : $transfer->transfer_from_account_id,
            'transfer_to_account_id' => $accountId === $transfer->transfer_from_account_id ? $data['transfer_account'] : $transfer->transfer_to_account_id,
            'transfer_amount' => $amount,
            'transfer_date' => date('Y-m-d', strtotime($data['date'])),
            'transfer_memo' => $data['memo']
        ];

        $update = $this->accounting_transfer_funds_model->update($transferId, $transferData);

        if ($update) {
            $attachments = $this->accounting_attachments_model->get_attachments('Transfer', $transferId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Transfer',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $transferId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            // REVERT OLD
            $oldTransferFrom = $this->chart_of_accounts_model->getById($transfer->transfer_from_account_id);
            $oldTransferTo = $this->chart_of_accounts_model->getById($transfer->transfer_to_account_id);

            $oldTransferFromBal = $oldTransferFrom->account_id !== "7" ? floatval($oldTransferFrom->balance) + floatval($transfer->transfer_amount) : floatval($oldTransferFrom->balance) - floatval($transfer->transfer_amount);
            $oldTransferToBal = $oldTransferTo->account_id !== "7" ? floatval($oldTransferTo->balance) - floatval($transfer->transfer_amount) : floatval($oldTransferTo->balance) + floatval($transfer->transfer_amount);

            $oldTransferFromBal = number_format($oldTransferFromBal, 2, '.', ',');
            $oldTransferToBal = number_format($oldTransferToBal, 2, '.', ',');

            $oldTransferFromData = [
                'id' => $oldTransferFrom->id,
                'company_id' => logged('company_id'),
                'balance' => $oldTransferFromBal
            ];
            $oldTransferToData = [
                'id' => $oldTransferTo->id,
                'company_id' => logged('company_id'),
                'balance' => $oldTransferToBal
            ];

            $this->chart_of_accounts_model->updateBalance($oldTransferFromData);
            $this->chart_of_accounts_model->updateBalance($oldTransferToData);

            // NEW
            $transferFromAcc = $this->chart_of_accounts_model->getById($transferData['transfer_from_account_id']);
            $transferToAcc = $this->chart_of_accounts_model->getById($transferData['transfer_to_account_id']);

            $transferFromBal = $transferFromAcc->account_id !== "7" ? floatval($transferFromAcc->balance) - floatval($transferData['transfer_amount']) : floatval($transferFromAcc->balance) + floatval($transferData['transfer_amount']);
            $transferToBal = $transferToAcc->account_id !== "7" ? floatval($transferToAcc->balance) + floatval($transferData['transfer_amount']) : floatval($transferToAcc->balance) - floatval($transferData['transfer_amount']);

            $transferFromBal = number_format($transferFromBal, 2, '.', ',');
            $transferToBal = number_format($transferToBal, 2, '.', ',');

            $transferFromAccData = [
                'id' => $transferFromAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $transferFromBal
            ];
            $transferToAccData = [
                'id' => $transferToAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $transferToBal
            ];

            $this->chart_of_accounts_model->updateBalance($transferFromAccData);
            $this->chart_of_accounts_model->updateBalance($transferToAccData);
        }

        $return['data'] = $transferId;
        $return['success'] = $update ? true : false;
        $return['message'] = $update ? 'Update Successful!' : 'An unexpected error occured';

        return $return;
    }

    private function save_journal($accountId, $journalId, $data)
    {
        $journalData = [
            'journal_no' => $data['ref_no'] === '' ? null : $data['ref_no'],
            'journal_date' => date('Y-m-d', strtotime($data['date']))
        ];

        $update = $this->accounting_journal_entries_model->update($journalId, $journalData);

        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $payee = explode('-', $data['payee']);

        if ($update) {
            $attachments = $this->accounting_attachments_model->get_attachments('Journal', $journalId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Journal',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $journalId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $journal = $this->accounting_journal_entries_model->getById($journalId, logged('company_id'));

            $entries = $this->accounting_journal_entries_model->getEntries($journalId);
            foreach($entries as $entry) {
                $entryAccount = $this->chart_of_accounts_model->getById($entry->account_id);

                if($entryAccount->account_id !== "7") {
                    // REVERT PREVIOUS UPDATE
                    $newBalance = floatval($entryAccount->balance) + floatval($entry->credit);
                    $newBalance = $newBalance - floatval($entry->debit);

                    // NEW UPDATE
                    $newBalance -= $entry->credit === "0" ? 0.00 : floatval($amount);
                    $newBalance += $entry->debit === "0" ? 0.00 : floatval($amount);
                } else {
                    // REVERT PREVIOUS UPDATE
                    $newBalance = floatval($entryAccount->balance) - floatval($entry->credit);
                    $newBalance = $newBalance + floatval($entry->debit);

                    // NEW UPDATE
                    $newBalance += $entry->credit === "0" ? 0.00 : floatval($amount);
                    $newBalance -= $entry->debit === "0" ? 0.00 : floatval($amount);
                }

                $newBalance = number_format($newBalance, 2, '.', ',');

                $accountData = [
                    'id' => $entryAccount->id,
                    'company_id' => logged('company_id'),
                    'balance' => $newBalance
                ];

                $this->chart_of_accounts_model->updateBalance($accountData);

                $entryData = [
                    'debit' => $entry->debit === "0" ? $entry->debit : $amount,
                    'credit' => $entry->credit === "0" ? $entry->credit : $amount,
                    'description' => $data['child_id'] === $entry->id ? $data['memo'] : $entry->description,
                    'name_key' => $data['child_id'] === $entry->id ? $payee[0] : $entry->name_key,
                    'name_id' => $data['child_id'] === $entry->id ? $payee[1] : $entry->name_id
                ];

                $this->accounting_journal_entries_model->update_entry($entry->id, $journalId, $entryData);
            }
        }

        $return = [
            'data' => $journalId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured'
        ];

        return $return;
    }

    private function save_deposit($accountId, $depositId, $data)
    {
        $deposit = $this->accounting_bank_deposit_model->getById($depositId, logged('company_id'));
        $funds = $this->accounting_bank_deposit_model->getFunds($depositId);
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        if($accountId === $deposit->account_id && count($funds) === 1 && in_array($deposit->cash_back_amount, ['0', '', null])) {
            $total = number_format(floatval($amount), 2, '.', ',');
        } else if(count($funds) === 1 && $accountId === $funds[0]->received_from_account_id && in_array($deposit->cash_back_amount, ['0', '', null])) {
            $total = number_format(floatval($amount), 2, '.', ',');
        } else {
            $total = number_format(floatval($deposit->total_amount), 2, '.', ',');
        }

        $depositData = [
            'date' => date('Y-m-d', strtotime($data['date'])),
            'total_amount' => $total,
            'memo' => $accountId === $deposit->account_id ? $data['memo'] : $deposit->memo,
            'cash_back_memo' => $accountId === $deposit->cash_back_account_id ? $data['cash_back_memo'] : $deposit->cash_back_memo,
        ];

        $update = $this->accounting_bank_deposit_model->update($depositId, $depositData);

        if ($update) {
            // NEW ATTACHMENTS
            $attachments = $this->accounting_attachments_model->get_attachments('Deposit', $depositId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Deposit',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $depositId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            if(count($funds) === 1 && in_array($deposit->cash_back_amount, ['0', '', null])) {
                if($accountId === $deposit->account_id || $accountId === $funds[0]->received_from_account_id) {
                    $depositAcc = $this->chart_of_accounts_model->getById($deposit->account_id);
                    $newBalance = floatval($depositAcc->balance) - floatval($deposit->total_amount);
                    $newBalance = $newBalance + $total;
                    $newBalance = number_format($newBalance, 2, '.', ',');
                    $depositAccData = [
                        'id' => $depositAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];
                    $this->chart_of_accounts_model->updateBalance($depositAccData);

                    if($accountId === $deposit->account_id) {
                        $fundAcc = $this->chart_of_accounts_model->getById($funds[0]->received_from_account_id);
                        $fundAccBalance = $fundAcc->account_id !== "7" ? floatval($fundAcc->balance) + floatval($funds[0]->amount) : floatval($fundAcc->balance) - floatval($funds[0]->amount);
                        $fundAccBalance = number_format($fundAccBalance, 2, '.', ',');
                        $fundAccData = [
                            'id' => $fundAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $fundAccBalance
                        ];
                        $this->chart_of_accounts_model->updateBalance($fundAccData);

                        $newFundAcc = $this->chart_of_accounts_model->getById($data['funds_account']);
                        $newFundAccBal = $newFundAcc->account_id !== "7" ? floatval($newFundAcc->balance) - $total : floatval($newFundAcc->balance) + $total;
                        $newFundAccBal = number_format($newFundAccBal, 2, '.', ',');
                        $newFundAccData = [
                            'id' => $newFundAcc->id,
                            'company_id' => logged('company_id'),
                            'balance' => $newFundAccBal
                        ];
                        $this->chart_of_accounts_model->updateBalance($newFundAccData);
                    }

                    $fundData = [
                        'received_from_account_id' => $accountId === $deposit->account_id ? $data['funds_account'] : $funds[0]->received_from_account_id,
                        'amount' => $total,
                        'description' => $accountId === $funds[0]->received_from_account_id ? $data['memo'] : $funds[0]->description,
                        'ref_no' => $accountId === $funds[0]->received_from_account_id ? $data['ref_no'] : $funds[0]->ref_no
                    ];

                    $this->accounting_bank_deposit_model->update_fund($funds[0]->id, $depositId, $fundData);
                }
            }
        }

        $return = [
            'data' => $depositId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    private function save_expense($accountId, $expenseId, $data)
    {
        $expense = $this->vendors_model->get_expense_by_id($expenseId, logged('company_id'));
        $categories = $this->expenses_model->get_transaction_categories($expenseId, 'Expense');
        $items = $this->expenses_model->get_transaction_items($expenseId, 'Expense');
        $totalCount = count($categories) + count($items);

        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $payee = explode('-', $data['payee']);

        $expenseData = [
            'payment_date' => date('Y-m-d', strtotime($data['date'])),
            'ref_no' => $accountId === $expense->payment_account_id ? ($data['ref_no'] === '' ? null : $data['ref_no']) : $expense->ref_no,
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'memo' => $accountId === $expense->payment_account_id ? $data['memo'] : $expense->memo,
            'total_amount' => $totalCount === 1 ? number_format(floatval($amount), 2, '.', ',') : number_format(floatval($expense->total_amount), 2, '.', ',')
        ];

        $update = $this->vendors_model->update_expense($expenseId, $expenseData);

        if($update) {
            // NEW ATTACHMENTS
            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expenseId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Expense',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $expenseId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccBal = $paymentAcc->account_id !== "7" ? floatval($paymentAcc->balance) + floatval($expense->total_amount) : floatval($paymentAcc->balance) - floatval($expense->total_amount);
            $paymentAccBal = $paymentAcc->account_id !== "7" ? $paymentAccBal - floatval($expenseData['total_amount']) : $paymentAccBal + floatval($expenseData['total_amount']);
            $paymentAccBal = number_format($paymentAccBal, 2, '.', ',');
            $paymentAccData = [
                'id' => $paymentAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $paymentAccBal
            ];
            $this->chart_of_accounts_model->updateBalance($paymentAccData);

            if($totalCount === 1) {
                if(count($categories) === 1 && count($items) === 0) {
                    $oldCatAcc = $this->chart_of_accounts_model->getById($categories[0]->expense_account_id);
                    $oldCatAccType = $this->account_model->getById($oldCatAcc->account_id);

                    if ($oldCatAccType->account_name === 'Credit Card') {
                        $oldCatAccBal = floatval($oldCatAcc->balance) + floatval($categories[0]->amount);
                    } else {
                        $oldCatAccBal = floatval($oldCatAcc->balance) - floatval($categories[0]->amount);
                    }
                    $oldCatAccBal = number_format($oldCatAccBal, 2, '.', ',');

                    $oldCatAccData = [
                        'id' => $oldCatAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $oldCatAccBal
                    ];

                    $this->chart_of_accounts_model->updateBalance($oldCatAccData);

                    if($accountId === $expense->payment_account_id) {
                        $expenseAccId = $data['expense_account'];
                    } else {
                        $expenseAccId = $categories[0]->expense_account_id;
                    }
                    $expenseAcc = $this->chart_of_accounts_model->getById($expenseAccId);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) - floatval($amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) + floatval($amount);
                    }
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    $categoryData = [
                        'expense_account_id' => $accountId === $expense->payment_account_id ? $data['expense_account'] : $categories[0]->expense_account_id,
                        'description' => $accountId === $categories[0]->expense_account_id ? $data['memo'] : $categories[0]->description,
                        'amount' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_category_details($categories[0]->id, $categoryData);
                } else if(count($categories) === 0 && count($items) === 1) {
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);

                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                    $newBalance = floatval($invAssetAcc->balance) - floatval($items[0]->total);
                    $newBalance = $newBalance + floatval($amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);

                    $itemData = [
                        'total' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_item($items[0]->id, $itemData);
                }
            }
        }

        $return = [
            'data' => $expenseId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    private function save_check($accountId, $checkId, $data)
    {
        $check = $this->vendors_model->get_check_by_id($checkId, logged('company_id'));
        $categories = $this->expenses_model->get_transaction_categories($checkId, 'Check');
        $items = $this->expenses_model->get_transaction_items($checkId, 'Check');
        $totalCount = count($categories) + count($items);

        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $payee = explode('-', $data['payee']);

        $checkData = [
            'payment_date' => date('Y-m-d', strtotime($data['date'])),
            'check_no' => $accountId === $check->bank_account_id && $check->to_print !== "1" ? ($data['ref_no'] === '' ? null : $data['ref_no']) : $check->check_no,
            'to_print' => $accountId === $check->bank_account_id && $data['ref_no'] !== 'To print' && $check->to_print !== "1" ? null : $check->to_print,
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'memo' => $accountId === $check->bank_account_id ? $data['memo'] : $check->memo,
            'total_amount' => $totalCount === 1 ? number_format(floatval($amount), 2, '.', ',') : number_format(floatval($check->total_amount), 2, '.', ',')
        ];

        $update = $this->vendors_model->update_check($checkId, $checkData);

        if($update) {
            // NEW ATTACHMENTS
            $attachments = $this->accounting_attachments_model->get_attachments('Check', $checkId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Check',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $checkId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            $account = $this->chart_of_accounts_model->getById($check->bank_account_id);
            $accountBal = floatval($account->balance) + floatval($check->total_amount);
            $accountBal = $accountBal - floatval($checkData['total_amount']);
            $accountBal = number_format($accountBal, 2, '.', ',');
            $accountData = [
                'id' => $account->id,
                'company_id' => logged('company_id'),
                'balance' => $accountBal
            ];
            $this->chart_of_accounts_model->updateBalance($accountData);

            if($totalCount === 1) {
                if(count($categories) === 1 && count($items) === 0) {
                    $oldCatAcc = $this->chart_of_accounts_model->getById($categories[0]->expense_account_id);
                    $oldCatAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($oldCatAccType->account_name === 'Credit Card') {
                        $oldCatAccBal = floatval($oldCatAcc->balance) + floatval($categories[0]->amount);
                    } else {
                        $oldCatAccBal = floatval($oldCatAcc->balance) - floatval($categories[0]->amount);
                    }
                    $oldCatAccBal = number_format($oldCatAccBal, 2, '.', ',');

                    $oldCatAccData = [
                        'id' => $oldCatAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $oldCatAccBal
                    ];

                    $this->chart_of_accounts_model->updateBalance($oldCatAccData);

                    if($accountId === $expense->payment_account_id) {
                        $expenseAccId = $data['expense_account'];
                    } else {
                        $expenseAccId = $categories[0]->expense_account_id;
                    }
                    $expenseAcc = $this->chart_of_accounts_model->getById($expenseAccId);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) - floatval($amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) + floatval($amount);
                    }
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    $categoryData = [
                        'expense_account_id' => $accountId === $check->bank_account_id ? $data['expense_account'] : $categories[0]->expense_account_id,
                        'description' => $accountId === $categories[0]->expense_account_id ? $data['memo'] : $categories[0]->description,
                        'amount' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_category_details($categories[0]->id, $categoryData);
                } else {
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);

                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                    $newBalance = floatval($invAssetAcc->balance) - floatval($items[0]->total);
                    $newBalance = floatval($invAssetAcc->balance) + floatval($amount);
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);

                    $itemData = [
                        'total' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_item($items[0]->id, $itemData);
                }
            }
        }

        $return = [
            'data' => $checkId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    private function save_bill($accountId, $billId, $data)
    {
        $bill = $this->vendors_model->get_bill_by_id($billId, logged('company_id'));
        $categories = $this->expenses_model->get_transaction_categories($billId, 'Bill');
        $items = $this->expenses_model->get_transaction_items($billId, 'Bill');
        $totalCount = count($categories) + count($items);

        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $billData = [
            'vendor_id' => $data['payee'],
            'total_amount' => $totalCount === 1 ? number_format(floatval($amount), 2, '.', ',') : number_format(floatval($bill->total_amount), 2, '.', ',')
        ];

        $update = $this->vendors_model->update_bill($billId, $billData);

        if($update) {
            // NEW ATTACHMENTS
            $attachments = $this->accounting_attachments_model->get_attachments('Bill', $billId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Bill',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $billId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            if($totalCount === 1) {
                if(count($categories) === 1 && count($items) === 0) {
                    $categoryData = [
                        'description' => $data['memo'],
                        'amount' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_category_details($data['child_id'], $categoryData);

                    if ($accountType->account_name === 'Credit Card') {
                        $newBalance = floatval($account->balance) + floatval($categories[0]->amount);
                        $newBalance = $newBalance - floatval($amount);
                    } else {
                        $newBalance = floatval($account->balance) - floatval($categories[0]->amount);
                        $newBalance = $newBalance + floatval($amount);
                    }
                } else if(count($categories) === 0 && count($items) === 1) {
                    $itemData = [
                        'total' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_item($data['child_id'], $itemData);

                    $newBalance = floatval($account->balance) - floatval($items[0]->total);
                    $newBalance = $newBalance + floatval($amount);
                }

                $accountData = [
                    'id' => $account->id,
                    'company_id' => logged('company_id'),
                    'balance' => number_format($newBalance, 2, '.', ',')
                ];
    
                $this->chart_of_accounts_model->updateBalance($accountData);
            }
        }

        $return = [
            'data' => $billId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    private function save_vendor_credit($accountId, $vCreditId, $data)
    {
        $vCredit = $this->vendors_model->get_vendor_credit_by_id($vCreditId, logged('company_id'));
        $categories = $this->expenses_model->get_transaction_categories($vCreditId, 'Vendor Credit');
        $items = $this->expenses_model->get_transaction_items($vCreditId, 'Vendor Credit');
        $totalCount = count($categories) + count($items);

        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $vCreditData = [
            'vendor_id' => $data['payee'],
            'total_amount' => $totalCount === 1 ? number_format(floatval($amount), 2, '.', ',') : number_format(floatval($vCredit->total_amount), 2, '.', ',')
        ];

        $update = $this->vendors_model->update_vendor_credit($vCreditId, $vCreditData);

        if($update) {
            // NEW ATTACHMENTS
            $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $vCreditId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Vendor Credit',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $vCreditId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            if($totalCount === 1) {
                if(count($categories) === 1 && count($items) === 0) {
                    $categoryData = [
                        'description' => $data['memo'],
                        'amount' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_category_details($data['child_id'], $categoryData);

                    if ($accountType->account_name === 'Credit Card') {
                        $newBalance = floatval($account->balance) - floatval($categories[0]->amount);
                        $newBalance = $newBalance + floatval($amount);
                    } else {
                        $newBalance = floatval($account->balance) + floatval($categories[0]->amount);
                        $newBalance = $newBalance - floatval($amount);
                    }

                    $accountData = [
                        'id' => $account->id,
                        'company_id' => logged('company_id'),
                        'balance' => number_format($newBalance, 2, '.', ',')
                    ];
        
                    $this->chart_of_accounts_model->updateBalance($accountData);
                }
            }
        }

        $return = [
            'data' => $vCreditId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    private function save_cc_credit($accountId, $ccCreditId, $data)
    {
        $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($ccCreditId, logged('company_id'));
        $categories = $this->expenses_model->get_transaction_categories($ccCreditId, 'Credit Card Credit');
        $items = $this->expenses_model->get_transaction_items($ccCreditId, 'Credit Card Credit');
        $totalCount = count($categories) + count($items);

        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $payee = explode('-', $data['payee']);

        $ccCreditData = [
            'payment_date' => date('Y-m-d', strtotime($data['date'])),
            'ref_no' => $accountId === $ccCredit->bank_credit_account_id && !isset($data['child_id']) ? ($data['ref_no'] === '' ? null : $data['ref_no']) : $ccCredit->ref_no,
            'payee_type' => $payee[0],
            'payee_id' => $payee[1],
            'memo' => $accountId === $ccCredit->bank_credit_account_id && !isset($data['child_id']) ? $data['memo'] : $ccCredit->memo,
            'total_amount' => $totalCount === 1 ? number_format(floatval($amount), 2, '.', ',') : number_format(floatval($ccCredit->total_amount), 2, '.', ',')
        ];

        $update = $this->vendors_model->update_credit_card_credit($ccCreditId, $ccCreditData);

        if($update) {
            // NEW ATTACHMENTS
            $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $ccCreditId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'CC Credit',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $ccCreditId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }

            if($totalCount === 1) {
                $creditAcc = $this->chart_of_accounts_model->getById($ccCredit->bank_credit_account_id);

                $newBalance = floatval($creditAcc->balance) + floatval($ccCredit->total_amount);
                $newBalance = $newBalance - floatval($amount);
                $newBalance = number_format($newBalance, 2, '.', ',');

                $this->chart_of_accounts_model->updateBalance(['id' => $creditAcc->id, 'company_id' => logged('company_id'), 'balance' => $newBalance]);

                if(count($categories) === 1 && count($items) === 0) {
                    // OLD CATEGORY ACCOUNT
                    $oldCatAcc = $this->chart_of_accounts_model->getById($categories[0]->expense_account_id);
                    $oldCatAccType = $this->account_model->getById($oldCatAcc->account_id);

                    if ($oldCatAccType->account_name === 'Credit Card') {
                        $oldCatAccBal = floatval($oldCatAcc->balance) - floatval($categories[0]->amount);
                    } else {
                        $oldCatAccBal = floatval($oldCatAcc->balance) + floatval($categories[0]->amount);
                    }
                    $oldCatAccBal = number_format($oldCatAccBal, 2, '.', ',');

                    $oldCatAccData = [
                        'id' => $oldCatAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $oldCatAccBal
                    ];

                    $this->chart_of_accounts_model->updateBalance($oldCatAccData);

                    // NEW CATEGORY ACCOUNT
                    if($accountId === $ccCredit->bank_credit_account_id && !isset($data['child_id'])) {
                        $expenseAccId = $data['expense_account'];
                    } else {
                        $expenseAccId = $categories[0]->expense_account_id;
                    }
                    $expenseAcc = $this->chart_of_accounts_model->getById($expenseAccId);
                    $expenseAccType = $this->account_model->getById($expenseAcc->account_id);

                    if ($expenseAccType->account_name === 'Credit Card') {
                        $newBalance = floatval($expenseAcc->balance) + floatval($amount);
                    } else {
                        $newBalance = floatval($expenseAcc->balance) - floatval($amount);
                    }
                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $expenseAccData = [
                        'id' => $expenseAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($expenseAccData);

                    $categoryData = [
                        'expense_account_id' => $accountId === $ccCredit->bank_credit_account_id && !isset($data['child_id']) ? $data['expense_account'] : $categories[0]->expense_account_id,
                        'description' => isset($data['child_id']) ? $data['memo'] : $categories[0]->description,
                        'amount' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_category_details($categories[0]->id, $categoryData);
                } else if(count($categories) === 0 && count($items) === 1) {
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);

                    $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);
                    $newBalance = floatval($items[0]->total) - floatval($items[0]->quantity);
                    $newBalance = floatval($invAssetAcc->balance) - $newBalance;
                    $newBalance = $newBalance + floatval($items[0]->total);

                    $newBalance = $newBalance + (floatval($amount) - floatval($items[0]->quantity));
                    $newBalance = floatval($invAssetAcc->balance) - floatval($amount);

                    $newBalance = number_format($newBalance, 2, '.', ',');

                    $invAssetAccData = [
                        'id' => $invAssetAcc->id,
                        'company_id' => logged('company_id'),
                        'balance' => $newBalance
                    ];

                    $this->chart_of_accounts_model->updateBalance($invAssetAccData);

                    $itemData = [
                        'total' => number_format(floatval($amount), 2, '.', ',')
                    ];

                    $this->vendors_model->update_transaction_item($items[0]->id, $itemData);
                }
            }
        }

        $return = [
            'data' => $ccCreditId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    private function save_bill_payment($accountId, $billPaymentId, $data)
    {
        $billPayment = $this->vendors_model->get_bill_payment_by_id($billPaymentId);
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $billPaymentData = [
            'payment_date' => date('Y-m-d', strtotime($data['date'])),
            'check_no' => $data['ref_no'] === '' ? null : $data['ref_no'],
            'memo' => $data['memo'],
        ];

        $update = $this->vendors_model->update_bill_payment($billPaymentId, $billPaymentData);

        if($update) {
            // NEW ATTACHMENTS
            $attachments = $this->accounting_attachments_model->get_attachments('Bill Payment', $billPaymentId);
            if (isset($data['attachments']) && is_array($data['attachments'])) {
                $order = count($attachments) + 1;
                foreach ($data['attachments'] as $attachmentId) {
                    $linkAttachmentData = [
                        'type' => 'Bill Payment',
                        'attachment_id' => $attachmentId,
                        'linked_id' => $billPaymentId,
                        'order_no' => $order
                    ];

                    $linkedId = $this->accounting_attachments_model->link_attachment($linkAttachmentData);

                    $order++;
                }
            }
        }

        $return = [
            'data' => $billPaymentId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    private function save_inventory_starting_value($accountId, $adjustmentId, $data)
    {
        $adjustment = $this->starting_value_model->get_by_id($adjustmentId);
        $account = $this->chart_of_accounts_model->getById($accountId);
        $accountType = $this->account_model->getById($account->account_id);

        if($accountType->account_name === 'Credit Card') {
            $amount = $data['charge'] === '' ? $data['payment'] : $data['charge'];
        } else if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $amount = $data['decrease'] === '' ? $data['increase'] : $data['decrease'];
        } else {
            $amount = $data['payment'] === '' ? $data['deposit'] : $data['payment'];
        }

        $adjustmentData = [
            'as_of_date' => date('Y-m-d', strtotime($data['date'])),
            'ref_no' => $data['ref_no'] === '' ? null : $data['ref_no'],
            'memo' => $data['memo'],
            'inv_adj_account' => !isset($data['inventory_adj_account']) ? $adjustment->inv_adj_account : $data['inventory_adj_account'],
            'inv_asset_account' => !isset($data['inventory_asset_account']) ? $adjustment->inv_asset_account : $data['inventory_asset_account']
        ];

        $update = $this->starting_value_model->update($adjustmentId, $adjustmentData);

        if($update) {
            // REVERT PREVIOUS ADJUSTMENT
            $adjustmentAcc = $this->chart_of_accounts_model->getById($adjustment->inv_adj_account);
            $newBalance = floatval($adjustmentAcc->balance) + floatval($adjustment->total_amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $adjustmentAccData = [
                'id' => $adjustmentAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($adjustmentAccData);

            $invAssetAcc = $this->chart_of_accounts_model->getById($adjustment->inv_asset_account);
            $newBalance = floatval($invAssetAcc->balance) - floatval($adjustment->total_amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $invAssetAccData = [
                'id' => $invAssetAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($invAssetAccData);

            // UPDATED ADJUSTMENT
            $adjustmentAcc = $this->chart_of_accounts_model->getById($adjustmentData['inv_adj_account']);
            $newBalance = floatval($adjustmentAcc->balance) - floatval($adjustment->total_amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $adjustmentAccData = [
                'id' => $adjustmentAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($adjustmentAccData);

            $invAssetAcc = $this->chart_of_accounts_model->getById($adjustmentData['inv_asset_account']);
            $newBalance = floatval($invAssetAcc->balance) + floatval($adjustment->total_amount);
            $newBalance = number_format($newBalance, 2, '.', ',');

            $invAssetAccData = [
                'id' => $invAssetAcc->id,
                'company_id' => logged('company_id'),
                'balance' => $newBalance
            ];

            $this->chart_of_accounts_model->updateBalance($invAssetAccData);
        }
        
        $return = [
            'data' => $adjustmentId,
            'success' => $update ? true : false,
            'message' => $update ? 'Update Successful!' : 'An unexpected error occured!'
        ];

        return $return;
    }

    public function add_attachment()
    {
        $files = $_FILES['files'];

        if(count($files['name']) > 0) {
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
                $id = $this->accounting_attachments_model->create($attachment);
                $attachmentIds[] = [
                    'id' => $id,
                    'name' => $attachment['uploaded_name'].'.'.$attachment['file_extension']
                ];
            }

            echo json_encode($attachmentIds);
        } else {
            echo json_encode('error');
        }
    }

    public function inactive_batch()
    {
        $ids = $this->input->post('ids');

        foreach($ids as $id) {
            $this->chart_of_accounts_model->inactive($id);
        }
    }
}