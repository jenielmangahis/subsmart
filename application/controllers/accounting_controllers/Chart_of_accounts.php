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
        $this->load->model('accounting_account_transactions_model');

		$this->page_data['page']->title = 'Chart of Accounts';
        $this->page_data['page']->parent = 'Accounting';

        add_css(array(
            // "assets/css/accounting/banking.css?v=".rand(),
            // "assets/css/accounting/accounting.css",
            // "assets/css/accounting/accounting.modal.css?v=".rand(),
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
            0, 1
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
                        'bank_balance' => str_replace('$-', '-$', '$'.number_format(floatval($account->balance), 2, '.', ',')),
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
                    'bank_balance' => str_replace('$-', '-$', '$'.number_format(floatval($account->balance), 2, '.', ',')),
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
                            'bank_balance' => str_replace('$-', '-$', '$'.number_format(floatval($childAcc->balance), 2, '.', ',')),
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
                        'bank_balance' => str_replace('$-', '-$', '$'.number_format(floatval($childAcc->balance), 2, '.', ',')),
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

        $name       = $post['name'];
        $nameExists = $this->chart_of_accounts_model->get_by_name($name);
        if(!empty($nameExists)) {
            $name = $post['name'].'-'.count($nameExists);
        }

        $data = [
            'company_id' => logged('company_id'),
            'account_id' => $post['account_type'],
            'acc_detail_id' => $post['detail_type'],
            'name'          => $name,
            'description'   => $post['description'],
            'parent_acc_id' => $post['sub_account_type'],
            'time'          => isset($post['choose_time']) ? $post['choose_time'] : '',
            'balance'       => $post['balance'],
            'time_date'     => $date
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

        $registers = $this->get_transactions($id, $filters);

        $this->page_data['account'] = $account;
        $this->page_data['type'] = $type;
        // $this->load->view('accounting/chart_of_accounts/view_register', $this->page_data);
        $this->load->view('v2/pages/accounting/accounting/chart_of_accounts/view_register', $this->page_data);
    }

    private function get_ap_transactions($accountId, $filters = [])
    {
        $data = [];

        $data = $this->bill_registers($accountId, $data);
        $data = $this->check_registers($accountId, $data);
        $data = $this->expense_registers($accountId, $data);
        $data = $this->vendor_credit_registers($accountId, $data);
        // $data = $this->bill_payment_registers($accountId, $data);
        // $data = $this->bill_payment_registers($accountId, $data, true);

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
                // $data = $this->cc_expense_registers($accountId, $data);
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
                $data = $this->refund_registers($accountId, $data);
                $data = $this->sales_receipt_registers($accountId, $data);
                $data = $this->credit_memo_registers($accountId, $data);
                $data = $this->quantity_adjustment_registers($accountId, $data);
                $data = $this->expense_registers($accountId, $data);
                $data = $this->item_starting_value_registers($accountId, $data);
                $data = $this->credit_card_payment_registers($accountId, $data);
            break;
        }

        if(stripos($accountType->account_name, 'Asset') !== false || stripos($accountType->account_name, 'Liabilities') !== false) {
            $increaseKey = 'increase';
            $decreaseKey = 'decrease';
        } else if($accountType->account_name === 'Credit Card') {
            $increaseKey = 'charge';
            $decreaseKey = 'payment';
        } else {
            $increaseKey = 'deposit';
            $decreaseKey = 'payment';
        }

        // Filter
        $data = array_filter($data, function($reg, $key) use ($filters, $increaseKey, $decreaeseKey) {
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
                        $flag = floatval($reg[$increaseKey]) < $searchFloat || floatval($reg[$decreaeseKey]) < $searchFloat;
                    } else {
                        $flag = floatval($reg[$increaseKey]) > $searchFloat || floatval($reg[$decreaeseKey]) > $searchFloat;
                    }
                } else {
                    if(is_numeric($filters['search'])) {
                        if($reg[$increaseKey] !== '' && floatval($filters['search']) !== floatval($reg[$increaseKey])) {
                            $flag = false;
                        }

                        if($reg[$decreaeseKey] !== '' && floatval($filters['search']) !== floatval($reg[$decreaeseKey])) {
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

        usort($data, function($a, $b) {
            if(strtotime($a['date']) === strtotime($b['date'])) {
                return floatval($a['acc_transac_id']) < floatval($b['acc_transac_id']);
                // return strtotime($a['date_created']) < strtotime($b['date_created']);
            }
            return strtotime($a['date']) < strtotime($b['date']);
        });

        $accBalance = floatval($account->balance);
        foreach($data as $key => $reg) {
            $balance = number_format($accBalance, 2, '.', ',');
            $balance = '$'.$balance;
            $data[$key]['balance'] = str_replace('$-', '-$', $balance);

            $accBalance -= floatval(str_replace(',', '', $reg[$increaseKey]));
            $accBalance += floatval(str_replace(',', '', $reg[$decreaseKey]));
        }

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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Expense');

        foreach($transactions as $transaction) {
            $expense = $this->vendors_model->get_expense_by_id($transaction->transaction_id, logged('company_id'));
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

            if($paymentAccType->account_name === 'Credit Card') {
                $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
                $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
                $count = count($categories) + count($items);
                $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);
                $account = $this->account_col($expense->id, 'Expense');

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

                if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                    if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                        $child = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
                        $amount = $child->amount;
                    } else {
                        $child = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                        $amount = $child->total;
                    }
                } else {
                    $amount = $expense->total_amount;
                }

                if($accType !== 'A/R' && $accType !== 'A/P') {
                    $register = [
                        'id' => $expense->id,
                        'acc_transac_id' => $transaction->id,
                        'date' => date("m/d/Y", strtotime($expense->payment_date)),
                        'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                        'ref_no_disabled' => false,
                        'type' => 'CC Expense',
                        'payee_type' => $expense->payee_type,
                        'payee_id' => $expense->payee_id,
                        'payee' => $payeeName,
                        'payee_disabled' => false,
                        'memo' => $transaction->is_category === '1' ? $child->description : $expense->memo,
                        'reconcile_status' => '',
                        'banking_status' => '',
                        'attachments' => count($attachments) > 0 ? count($attachments) : '',
                        'tax' => '',
                        'balance' => '',
                        'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                    ];

                    if(isset($child)) {
                        $register['child_id'] = $child->id;
                        $register['account_id'] = $paymentAcc->id;
                        $register['account'] = $paymentAcc->name;
                        $register['account_disabled'] = true;
                        $register['account_field'] = '';
                    } else {
                        $register['account_id'] = $account['id'];
                        $register['account'] = $account['name'];
                        $register['account_disabled'] = $account['disabled'];
                        $register['account_field'] = $account['field_name'];
                    }

                    if(!isset($child)) {
                        switch($accType) {
                            case 'Credit Card' :
                                $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                                $register['payment'] = '';
                                $register['charge_disabled'] = $count > 1;
                                $register['payment_disabled'] = true;
                            break;
                            case 'Asset' :
                                $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                                $register['decrease'] = '';
                                $register['increase_disabled'] = $count > 1;
                                $register['decrease_disabled'] = true;
                            break;
                            case 'Liability' :
                                $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                                $register['decrease'] = '';
                                $register['increase_disabled'] = $count > 1;
                                $register['decrease_disabled'] = true;
                            break;
                            default :
                                $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                                $register['deposit'] = '';
                                $register['payment_disabled'] = $count > 1;
                                $register['deposit_disabled'] = true;
                            break;
                        }
                    } else {
                        switch($accType) {
                            case 'Credit Card' :
                                $register['charge'] = '';
                                $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                                $register['charge_disabled'] = true;
                                $register['payment_disabled'] = $count > 1;
                            break;
                            case 'Asset' :
                                $register['increase'] = '';
                                $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                                $register['increase_disabled'] = true;
                                $register['decrease_disabled'] = $count > 1;
                            break;
                            case 'Liability' :
                                $register['increase'] = '';
                                $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                                $register['increase_disabled'] = true;
                                $register['decrease_disabled'] = $count > 1;
                            break;
                            default :
                                $register['payment'] = '';
                                $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                                $register['payment_disabled'] = true;
                                $register['deposit_disabled'] = $count > 1;
                            break;
                        }
                    }
                } else {
                    $register = [
                        'id' => $expense->id,
                        'date' => date("m/d/Y", strtotime($expense->payment_date)),
                        'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                        'type' => 'Expense',
                        'memo' => $expense->memo,
                        'due_date' => date("m/d/Y", strtotime($expense->payment_date)),
                    ];

                    if($accType === 'A/R') {
                        $register['customer'] = $payeeName;
                        $register['open_balance'] = '-'.number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['charge_credit'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['payment'] = '';
                    } else {
                        $register['vendor'] = $payeeName;
                        $register['open_balance'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['billed'] = '';
                        $register['paid'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['account'] = $paymentAcc->name;
                    }
                }

                $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Check');

        foreach($transactions as $transaction) {
            $check = $this->vendors_model->get_check_by_id($transaction->transaction_id, logged('company_id'));
            $bankAcc = $this->chart_of_accounts_model->getById($check->bank_account_id);
            $categories = $this->expenses_model->get_transaction_categories($check->id, 'Check');
            $items = $this->expenses_model->get_transaction_items($check->id, 'Check');
            $count = count($categories) + count($items);
            $attachments = $this->accounting_attachments_model->get_attachments('Check', $check->id);
            $account = $this->account_col($check->id, 'Check');

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

            if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                    $child = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
                    $amount = $child->amount;
                } else {
                    $child = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                    $amount = $child->total;
                }
            } else {
                $amount = $check->total_amount;
            }

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $register = [
                    'id' => $check->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($check->payment_date)),
                    'ref_no' => $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no),
                    'ref_no_disabled' => $check->to_print === "1" || isset($child),
                    'type' => 'Check',
                    'payee_type' => $check->payee_type,
                    'payee_id' => $check->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'memo' => $transaction->is_category === '1' ? $child->description : $check->memo,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($check->created_at))
                ];

                if(isset($child)) {
                    $register['child_id'] = $child->id;
                    $register['account_id'] = $bankAcc->id;
                    $register['account'] = $bankAcc->name;
                    $register['account_disabled'] = true;
                    $register['account_field'] = '';
                } else {
                    $register['account_id'] = $account['id'];
                    $register['account'] = $account['name'];
                    $register['account_disabled'] = $account['disabled'];
                    $register['account_field'] = $account['field_name'];
                }

                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = $count > 1;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = $count > 1;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = $count > 1;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = $count > 1;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $check->id,
                    'date' => date("m/d/Y", strtotime($check->payment_date)),
                    'ref_no' => $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no),
                    'type' => 'Check',
                    'memo' => $check->memo,
                    'due_date' => date("m/d/Y", strtotime($check->payment_date)),
                ];

                if($accType === 'A/R') {
                    $register['customer'] = $payeeName;
                    $register['open_balance'] = '-'.number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['charge_credit'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['payment'] = '';
                } else {
                    $register['vendor'] = $payeeName;
                    $register['open_balance'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['billed'] = '';
                    $register['paid'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['account'] = $bankAcc->name;
                }
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Invoice');

        foreach($transactions as $transaction) {
            $invoice = $this->invoice_model->getinvoice($transaction->transaction_id);
            $payee = $this->accounting_customers_model->get_by_id($invoice->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Invoice', $invoice->id);

            $amount = $transaction->amount;

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                $register = [
                    'id' => $invoice->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                    'ref_no' => $check->to_print === "1" ? "To print" : ($check->check_no === null ? '' : $check->check_no),
                    'ref_no_disabled' => true,
                    'type' => 'Invoice',
                    'payee_type' => 'customer',
                    'payee_id' => $invoice->customer_id,
                    'payee' => $payeeName,
                    'payee_disabled' => true,
                    'account_id' => $arAcc->id,
                    'account' => $arAcc->name,
                    'account_disabled' => true,
                    'memo' => '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($invoice->date_created))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $invoice->id,
                    'date' => date("m/d/Y", strtotime($invoice->date_issued)),
                    'ref_no' => $invoice->invoice_number,
                    'type' => 'Invoice',
                    'customer' => $payeeName,
                    'memo' => '',
                    'due_date' => date('m/d/Y', strtotime($invoice->due_date)),
                    'charge_credit' => number_format(floatval($amount), 2, '.', ','),
                    'payment' => '',
                    'open_balance' => number_format(floatval(str_replace(',', '', $invoice->balance)), 2, '.', ',')
                ];
            }

            $data[] = $register;
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

            $register = [
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
                    $register['charge'] = '';
                    $register['payment'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $register['charge_disabled'] = true;
                    $register['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $register['increase'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $register['decrease'] = '';
                    $register['increase_disabled'] = true;
                    $register['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $register['increase'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $register['decrease'] = '';
                    $register['increase_disabled'] = true;
                    $register['decrease_disabled'] = true;
                break;
                default :
                    $register['payment'] = '';
                    $register['deposit'] = number_format(floatval($payment->amount_received), 2, '.', ',');
                    $register['payment_disabled'] = true;
                    $register['deposit_disabled'] = true;
                break;
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }

        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Journal');

        foreach($transactions as $transaction)
        {
            $journalEntry = $this->accounting_journal_entries_model->getById($transaction->transaction_id, logged('company_id'));
            $entries = $this->accounting_journal_entries_model->getEntries($journalEntry->id);

            foreach($entries as $entry) {
                if($entry->id === $transaction->child_id) {
                    $journalEntryItem = $entry;
                }
            }

            $payeeName = '';
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

            $amount = $transaction->amount;

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $register = [
                    'id' => $journalEntry->id,
                    'acc_transac_id' => $transaction->id,
                    'child_id' => $entry->id,
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
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = $count > 1;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = $count > 1;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $journalEntry->id,
                    'date' => date("m/d/Y", strtotime($journalEntry->journal_date)),
                    'ref_no' => $journalEntry->journal_no === null ? '' : $journalEntry->journal_no,
                    'type' => 'Journal',
                    'vendor' => $payeeName,
                    'account' => '-Split-',
                    'memo' => $journalEntryItem->description,
                    'due_date' => date("m/d/Y", strtotime($journalEntry->journal_date)),
                    'open_balance' => number_format(floatval($amount), 2, '.', ',')
                ];

                if($accType === 'A/R') {
                    if($transaction->type === 'increase') {
                        $register['charge_credit'] = number_format(floatval($amount), 2, '.', ',');
                        $register['payment'] = '';
                    } else {
                        $register['charge_credit'] = '';
                        $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                    }
                } else {
                    if($transaction->type === 'increase') {
                        $register['billed'] = number_format(floatval($amount), 2, '.', ',');
                        $register['paid'] = '';
                    } else {
                        $register['billed'] = '';
                        $register['paid'] = number_format(floatval($amount), 2, '.', ',');
                    }
                }
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }

        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Bill');

        foreach($transactions as $transaction)
        {
            $bill = $this->vendors_model->get_bill_by_id($transaction->transaction_id, logged('company_id'));
            $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
            $payeeName = $payee->display_name;
            $attachments = $this->accounting_attachments_model->get_attachments('Bill', $bill->id);
            $categories = $this->expenses_model->get_transaction_categories($bill->id, 'Bill');
            $items = $this->expenses_model->get_transaction_items($bill->id, 'Bill');
            $count = count($categories) + count($items);

            if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                    $child = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
                    $amount = $child->amount;
                } else {
                    $child = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                    $amount = $child->total;
                }
            } else {
                $amount = $bill->total_amount;
            }

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));

                $register = [
                    'id' => $bill->id,
                    'acc_transac_id' => $transaction->id,
                    'child_id' => $child->id,
                    'date' => date("m/d/Y", strtotime($bill->bill_date)),
                    'ref_no' => $bill->bill_no === null ? '' : $bill->bill_no,
                    'ref_no_disabled' => true,
                    'type' => 'Bill',
                    'payee_type' => 'vendor',
                    'payee_id' => $bill->vendor_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $apAcc->id,
                    'account' => $apAcc->name,
                    'account_disabled' => true,
                    'memo' => $transaction->is_category === '1' ? $child->description : '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($child->created_at))
                ];
    
                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = $count > 1;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = $count > 1;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = $count > 1;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = $count > 1;
                        }
                    break;
                }
            } else {
                $account = $this->account_col($bill->id, 'Bill');
                $billed = number_format(floatval(str_replace(',', '', $bill->total_amount)), 2, '.', ',');
                $billed = str_replace('$-', '-$', '$'.$billed);

                $register = [
                    'id' => $bill->id,
                    'date' => date("m/d/Y", strtotime($bill->bill_date)),
                    'ref_no' => $bill->bill_no === null ? '' : $bill->bill_no,
                    'type' => 'Bill',
                    'vendor' => $payeeName,
                    'account' => $account['name'],
                    'memo' => $bill->memo,
                    'due_date' => date('m/d/Y', strtotime($bill->due_date)),
                    'billed' => $billed,
                    'paid' => '',
                    'open_balance' => number_format(floatval(str_replace(',', '', $bill->remaining_balance)), 2, '.', ',')
                ];
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }

        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'CC Credit');

        foreach($transactions as $transaction)
        {
            $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($transaction->transaction_id, logged('company_id'));
            $attachments = $this->accounting_attachments_model->get_attachments('CC Credit', $ccCredit->id);
            $categories = $this->expenses_model->get_transaction_categories($ccCredit->id, 'Credit Card Credit');
            $items = $this->expenses_model->get_transaction_items($ccCredit->id, 'Credit Card Credit');
            $count = count($categories) + count($items);

            $ccAcc = $this->chart_of_accounts_model->getById($ccCredit->bank_credit_account_id);
            $account = $this->account_col($ccCredit->id, 'Credit Card Credit');

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

            if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                    $child = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
                } else {
                    $child = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                }
                $amount = $transaction->amount;
            } else {
                $amount = $ccCredit->total_amount;
            }

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $register = [
                    'id' => $ccCredit->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                    'ref_no' => $ccCredit->ref_no === null ? '' : $ccCredit->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'CC-Credit',
                    'payee_type' => $ccCredit->payee_type,
                    'payee_id' => $ccCredit->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $apAcc->id,
                    'account' => $apAcc->name,
                    'account_disabled' => true,
                    'memo' => $transaction->is_category === '1' ? $child->description : '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($child->created_at))
                ];

                if(isset($child)) {
                    $register['child_id'] = $child->id;
                    $register['account_id'] = $ccAcc->id;
                    $register['account'] = $ccAcc->name;
                    $register['account_disabled'] = true;
                    $register['account_field'] = '';
                } else {
                    $register['account_id'] = $account['id'];
                    $register['account'] = $account['name'];
                    $register['account_disabled'] = $account['disabled'];
                    $register['account_field'] = $account['field_name'];
                }
    
                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = $count > 1;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = $count > 1;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = $count > 1;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = $count > 1;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $ccCredit->id,
                    'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                    'ref_no' => $ccCredit->ref_no === null ? '' : $ccCredit->ref_no,
                    'type' => 'CC-Credit',
                    'memo' => $ccCredit->memo,
                    'due_date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                ];

                if($accType === 'A/R') {
                    $register['customer'] = $payeeName;
                    $register['open_balance'] = '-'.number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['charge_credit'] = '';
                    $register['payment'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                } else {
                    $register['vendor'] = $payeeName;
                    $register['open_balance'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['billed'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['paid'] = '';
                    $register['account'] = $ccAcc->name;
                }
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }

        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Vendor Credit');

        foreach($transactions as $transaction)
        {
            $vCredit = $this->vendors_model->get_vendor_credit_by_id($transaction->transaction_id, logged('company_id'));
            $payee = $this->vendors_model->get_vendor_by_id($vCredit->vendor_id);
            $payeeName = $payee->display_name;
            $attachments = $this->accounting_attachments_model->get_attachments('Vendor Credit', $vCredit->id);
            $categories = $this->expenses_model->get_transaction_categories($vCredit->id, 'Vendor Credit');
            $items = $this->expenses_model->get_transaction_items($vCredit->id, 'Vendor Credit');
            $count = count($categories) + count($items);

            if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                    $child = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
                } else {
                    $child = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                }
                $amount = $transaction->amount;
            } else {
                $amount = $vCredit->total_amount;
            }

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));

                $register = [
                    'id' => $vCredit->id,
                    'child_id' => $child->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                    'ref_no' => $vCredit->ref_no === null ? '' : $vCredit->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'Vendor Credit',
                    'payee_type' => 'vendor',
                    'payee_id' => $vCredit->vendor_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'account_id' => $apAcc->id,
                    'account' => $apAcc->name,
                    'account_disabled' => true,
                    'memo' => $transaction->is_category === '1' ? $child->description : '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($child->created_at))
                ];
    
                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = $count > 1;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = $count > 1;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = $count > 1;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = $count > 1;
                        }
                    break;
                }
            } else {
                $account = $this->account_col($vCredit->id, 'Vendor Credit');
                $billed = number_format(floatval(str_replace(',', '', $vCredit->total_amount)), 2, '.', ',');
                $billed = str_replace('$-', '-$', '$'.$billed);

                $register = [
                    'id' => $vCredit->id,
                    'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                    'ref_no' => $vCredit->ref_no === null ? '' : $vCredit->ref_no,
                    'type' => 'Vendor Credit',
                    'vendor' => $payeeName,
                    'account' => $account['name'],
                    'memo' => $vCredit->memo,
                    'due_date' => date('m/d/Y', strtotime($vCredit->payment_date)),
                    'billed' => '',
                    'paid' => $billed,
                    'open_balance' => number_format(floatval(str_replace(',', '', $vCredit->remaining_balance)), 2, '.', ',')
                ];
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Transfer');

        foreach($transactions as $transaction) {
            $transfer = $this->accounting_transfer_funds_model->getById($transaction->transaction_id, logged('company_id'));
            if($accountId === $transfer->transfer_from_account_id) {
                $account = $this->chart_of_accounts_model->getById($transfer->transfer_to_account_id);
            } else {
                $account = $this->chart_of_accounts_model->getById($transfer->transfer_from_account_id);
            }

            $attachments = $this->accounting_attachments_model->get_attachments('Transfer', $transfer->id);

            $amount = $transaction->amount;

            $register = [
                'id' => $transfer->id,
                'acc_transac_id' => $transaction->id,
                'date' => date("m/d/Y", strtotime($transfer->transfer_date)),
                'ref_no' => '',
                'ref_no_disabled' => true,
                'type' => 'Transfer',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'payee_disabled' => true,
                'account_id' => $account->id,
                'account' => $account->name,
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
                    if($transaction->type === 'increase') {
                        $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                        $register['charge'] = "";
                        $register['payment_disabled'] = true;
                        $register['charge_disabled'] = true;
                    } else {
                        $register['payment'] = "";
                        $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                        $register['payment_disabled'] = true;
                        $register['charge_disabled'] = true;
                    }
                break;
                case 'Asset' :
                    if($transaction->type === 'increase') {
                        $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                        $register['decrease'] = "";
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    } else {
                        $register['increase'] = "";
                        $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    }
                break;
                case 'Liability' :
                    if($transaction->type === 'increase') {
                        $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                        $register['decrease'] = "";
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    } else {
                        $register['increase'] = "";
                        $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    }
                break;
                default :
                    if($transaction->type === 'increase') {
                        $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                        $register['payment'] = "";
                        $register['deposit_disabled'] = true;
                        $register['payment_disabled'] = true;
                    } else {
                        $register['deposit'] = "";
                        $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                        $register['deposit_disabled'] = true;
                        $register['payment_disabled'] = true;
                    }
                break;
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Deposit');

        foreach($transactions as $transaction) {
            $deposit = $this->accounting_bank_deposit_model->getById($transaction->transaction_id, logged('company_id'));
            $account = $this->chart_of_accounts_model->getById($deposit->account_id);
            $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);

            $attachments = $this->accounting_attachments_model->get_attachments('Deposit', $deposit->id);

            $amount = $transaction->amount;

            if($transaction->is_category === '1') {
                $fund = $this->accounting_bank_deposit_model->get_fund($transaction->child_id);

                switch($fund->received_from_key) {
                    case 'vendor':
                        $payee = $this->vendors_model->get_vendor_by_id($fund->received_from_id);
                        $payeeName = $payee->display_name;
                    break;
                    case 'customer':
                        $payee = $this->accounting_customers_model->get_by_id($fund->received_from_id);
                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                    break;
                    case 'employee':
                        $payee = $this->users_model->getUser($fund->received_from_id);
                        $payeeName = $payee->FName . ' ' . $payee->LName;
                    break;
                }
            }

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $register = [
                    'id' => $deposit->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($deposit->date)),
                    'ref_no_disabled' => true,
                    'type' => 'Deposit',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($refundReceipt->created_at))
                ];

                if($transaction->is_category === '1') {
                    $register['ref_no'] = $fund->ref_no;
                    $register['memo'] = $fund->description;
                    $register['account_id'] = $deposit->account_id;
                    $register['account'] = $this->chart_of_accounts_model->getName($deposit->account_id);
                    $register['account_disabled'] = true;

                    $register['payee_type'] = $fund->received_from_key;
                    $register['payee_id'] = $fund->received_from_id;
                    $register['payee'] = $payeeName;
                    $register['payee_disabled'] = true;
                } else {
                    $register['ref_no'] = '';
                    $register['memo'] = $deposit->memo;

                    if(count($funds) > 1) {
                        $register['account_id'] = null;
                        $register['account'] = '-Split-';
                        $register['account_disabled'] = true;
                    } else {
                        $register['account_id'] = $funds[0]->received_from_account_id;
                        $register['account'] = $this->chart_of_accounts_model->getName($funds[0]->received_from_account_id);
                        $register['account_disabled'] = true;
                    }

                    $register['payee_type'] = '';
                    $register['payee_id'] = '';
                    $register['payee'] = '';
                    $register['payee_disabled'] = true;
                }

                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $deposit->id,
                    'date' => date("m/d/Y", strtotime($deposit->date)),
                    'ref_no' => $fund->ref_no,
                    'type' => 'Deposit',
                    'memo' => $fund->description,
                    'due_date' => date("m/d/Y", strtotime($deposit->date)),
                ];

                if($accType === 'A/R') {
                    $register['customer'] = $payeeName;
                    $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                    $register['charge_credit'] = '';
                    $register['open_balance'] = number_format(floatval($amount), 2, '.', ',');
                } else {
                    $register['vendor'] = $payeeName;
                    $register['account'] = $this->chart_of_accounts_model->getName($funds[0]->received_from_account_id);
                    $register['billed'] = number_format(floatval($amount), 2, '.', ',');
                    $register['paid'] = '';
                    $register['open_balance'] = '-'.number_format(floatval($amount), 2, '.', ',');
                }
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Expense');

        foreach($transactions as $transaction) {
            $expense = $this->vendors_model->get_expense_by_id($transaction->transaction_id, logged('company_id'));
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);

            if($paymentAccType->account_name !== 'Credit Card') {
                $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
                $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
                $count = count($categories) + count($items);
                $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);
                $account = $this->account_col($expense->id, 'Expense');

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

                if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                    if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                        $child = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
                        $amount = $child->amount;
                    } else {
                        $child = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                        $amount = $child->total;
                    }
                } else {
                    $amount = $expense->total_amount;
                }

                if($accType !== 'A/R' && $accType !== 'A/P') {
                    $register = [
                        'id' => $expense->id,
                        'acc_transac_id' => $transaction->id,
                        'date' => date("m/d/Y", strtotime($expense->payment_date)),
                        'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                        'ref_no_disabled' => false,
                        'type' => 'Expense',
                        'payee_type' => $expense->payee_type,
                        'payee_id' => $expense->payee_id,
                        'payee' => $payeeName,
                        'payee_disabled' => false,
                        'memo' => $transaction->is_category === '1' ? $child->description : $expense->memo,
                        'reconcile_status' => '',
                        'banking_status' => '',
                        'attachments' => count($attachments) > 0 ? count($attachments) : '',
                        'tax' => '',
                        'balance' => '',
                        'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                    ];

                    if(isset($child)) {
                        $register['child_id'] = $child->id;
                        $register['account_id'] = $paymentAcc->id;
                        $register['account'] = $paymentAcc->name;
                        $register['account_disabled'] = true;
                        $register['account_field'] = '';

                        switch($accType) {
                            case 'Credit Card' :
                                $register['charge'] = '';
                                $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                                $register['charge_disabled'] = true;
                                $register['payment_disabled'] = $count > 1;
                            break;
                            case 'Asset' :
                                $register['increase'] = '';
                                $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                                $register['increase_disabled'] = true;
                                $register['decrease_disabled'] = $count > 1;
                            break;
                            case 'Liability' :
                                $register['increase'] = '';
                                $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                                $register['increase_disabled'] = true;
                                $register['decrease_disabled'] = $count > 1;
                            break;
                            default :
                                $register['payment'] = '';
                                $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                                $register['payment_disabled'] = true;
                                $register['deposit_disabled'] = $count > 1;
                            break;
                        }
                    } else {
                        $register['account_id'] = $account['id'];
                        $register['account'] = $account['name'];
                        $register['account_disabled'] = $account['disabled'];
                        $register['account_field'] = $account['field_name'];

                        switch($accType) {
                            case 'Credit Card' :
                                $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                                $register['payment'] = '';
                                $register['charge_disabled'] = $count > 1;
                                $register['payment_disabled'] = true;
                            break;
                            case 'Asset' :
                                $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                                $register['decrease'] = '';
                                $register['increase_disabled'] = $count > 1;
                                $register['decrease_disabled'] = true;
                            break;
                            case 'Liability' :
                                $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                                $register['decrease'] = '';
                                $register['increase_disabled'] = $count > 1;
                                $register['decrease_disabled'] = true;
                            break;
                            default :
                                $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                                $register['deposit'] = '';
                                $register['payment_disabled'] = $count > 1;
                                $register['deposit_disabled'] = true;
                            break;
                        }
                    }
                } else {
                    $register = [
                        'id' => $expense->id,
                        'date' => date("m/d/Y", strtotime($expense->payment_date)),
                        'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                        'type' => 'Expense',
                        'memo' => $expense->memo,
                        'due_date' => date("m/d/Y", strtotime($expense->payment_date)),
                    ];

                    if($accType === 'A/R') {
                        $register['customer'] = $payeeName;
                        $register['open_balance'] = '-'.number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['charge_credit'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['payment'] = '';
                    } else {
                        $register['vendor'] = $payeeName;
                        $register['open_balance'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['billed'] = '';
                        $register['paid'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                        $register['account'] = $paymentAcc->name;
                    }
                }

                $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Sales Receipt');

        foreach($transactions as $transaction) {
            $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($transaction->transaction_id);
            $payee = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Sales Receipt', $salesReceipt->id);

            $amount = $transaction->amount;

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                $register = [
                    'id' => $salesReceipt->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($salesReceipt->sales_receipt_date)),
                    'ref_no' => $salesReceipt->ref_no,
                    'ref_no_disabled' => false,
                    'type' => 'Sales Receipt',
                    'payee_type' => 'customer',
                    'payee_id' => $salesReceipt->customer_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'memo' => $salesReceipt->message_sales_receipt,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($salesReceipt->created_at))
                ];

                if($transaction->is_item_category === '1') {
                    $register['account_id'] = $salesReceipt->deposit_to_account;
                    $register['account'] = $this->chart_of_accounts_model->getName($salesReceipt->deposit_to_account);
                    $register['account_disabled'] = true;
                } else {
                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Sales Receipt', $salesReceipt->id);
                    
                    if(count($items) > 1) {
                        $register['account_id'] = null;
                        $register['account'] = '-Split-';
                        $register['account_disabled'] = true;
                    } else {
                        $item = $this->items_model->getItemById($items[0]->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);

                        if($itemAccDetails->income_account_id === null) {
                            $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                        } else {
                            $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        }

                        $register['account_id'] = $account->id;
                        $register['account'] = $account->name;
                        $register['account_disabled'] = true;
                    }
                }

                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $refundReceipt->id,
                    'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                    'ref_no' => $refundReceipt->ref_no,
                    'type' => 'Sales Receipt',
                    'customer' => $payeeName,
                    'memo' => '',
                    'due_date' => '',
                    'charge_credit' => '',
                    'payment' => number_format(floatval($amount), 2, '.', ','),
                    'open_balance' => '0.00'
                ];
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Credit Memo');

        foreach($transactions as $transaction) {
            $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($transaction->transaction_id);
            $payee = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Credit Memo', $creditMemo->id);

            $amount = $transaction->amount;

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                $register = [
                    'id' => $creditMemo->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                    'ref_no' => $creditMemo->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'Credit Memo',
                    'payee_type' => 'customer',
                    'payee_id' => $creditMemo->customer_id,
                    'payee' => $payeeName,
                    'payee_disabled' => true,
                    'account_id' => $arAcc->id,
                    'account' => $arAcc->name,
                    'account_disabled' => true,
                    'memo' => '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($creditMemo->created_at))
                ];

                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $creditMemo->id,
                    'date' => date("m/d/Y", strtotime($creditMemo->credit_memo_date)),
                    'ref_no' => $creditMemo->ref_no,
                    'type' => 'Credit Memo',
                    'customer' => $payeeName,
                    'memo' => '',
                    'due_date' => '',
                    'charge_credit' => '',
                    'payment' => number_format(floatval($amount), 2, '.', ','),
                    'open_balance' => '-'.number_format(floatval(str_replace(',', '', $creditMemo->balance)), 2, '.', ',')
                ];
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Refund Receipt');

        foreach($transactions as $transaction) {
            $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($transaction->transaction_id);
            $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
            $payeeName = $payee->first_name . ' ' . $payee->last_name;

            $attachments = $this->accounting_attachments_model->get_attachments('Refund Receipt', $refundReceipt->id);

            $amount = $transaction->amount;

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $arAcc = $this->chart_of_accounts_model->get_accounts_receivable_account(logged('company_id'));

                $register = [
                    'id' => $refundReceipt->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                    'ref_no' => $refundReceipt->ref_no,
                    'ref_no_disabled' => true,
                    'type' => 'Refund',
                    'payee_type' => 'customer',
                    'payee_id' => $refundReceipt->customer_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'memo' => $refundReceipt->message_refund_receipt,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($refundReceipt->created_at))
                ];

                if($transaction->is_item_category === '1') {
                    $register['account_id'] = $refundReceipt->refund_from_account;
                    $register['account'] = $this->chart_of_accounts_model->getName($refundReceipt->refund_from_account);
                    $register['account_disabled'] = true;
                } else {
                    $items = $this->accounting_credit_memo_model->get_customer_transaction_items('Refund Receipt', $refundReceipt->id);

                    if(count($items) > 1) {
                        $register['account_id'] = null;
                        $register['account'] = '-Split-';
                        $register['account_disabled'] = true;
                    } else {
                        $item = $this->items_model->getItemById($items[0]->item_id)[0];
                        $itemAccDetails = $this->items_model->getItemAccountingDetails($items[0]->item_id);

                        if($itemAccDetails->income_account_id === null) {
                            $account = $this->chart_of_accounts_model->get_sales_of_product_income(logged('company_id'));
                        } else {
                            $account = $this->chart_of_accounts_model->getById($itemAccDetails->income_account_id);
                        }

                        $register['account_id'] = $account->id;
                        $register['account'] = $account->name;
                        $register['account_disabled'] = true;
                    }
                }

                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = true;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = true;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = true;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $refundReceipt->id,
                    'date' => date("m/d/Y", strtotime($refundReceipt->refund_receipt_date)),
                    'ref_no' => $refundReceipt->ref_no,
                    'type' => 'Refund',
                    'customer' => $payeeName,
                    'memo' => '',
                    'due_date' => '',
                    'charge_credit' => '',
                    'payment' => number_format(floatval($amount), 2, '.', ','),
                    'open_balance' => '0.00'
                ];
            }

            $data[] = $register;
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

            $register = [
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
                    $register['charge'] = number_format($payment, 2, '.', ',');
                    $register['payment'] = '';
                break;
                case 'Asset' :
                    $register['increase'] = number_format($payment, 2, '.', ',');
                    $register['decrease'] = '';
                break;
                case 'Liability' :
                    $register['increase'] = number_format($payment, 2, '.', ',');
                    $register['decrease'] = '';
                break;
                default :
                    $register['payment'] = number_format($payment, 2, '.', ',');
                    $register['deposit'] = '';
                break;
            }

            $data[] = $register;
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

            $register = [
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
                    $register['charge'] = number_format($payment, 2, '.', ',');
                    $register['payment'] = '';
                break;
                case 'Asset' :
                    $register['increase'] = number_format($payment, 2, '.', ',');
                    $register['decrease'] = '';
                break;
                case 'Liability' :
                    $register['increase'] = number_format($payment, 2, '.', ',');
                    $register['decrease'] = '';
                break;
                default :
                    $register['payment'] = number_format($payment, 2, '.', ',');
                    $register['deposit'] = '';
                break;
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Expense');

        foreach($transactions as $transaction) {
            $expense = $this->vendors_model->get_expense_by_id($transaction->transaction_id, logged('company_id'));
            $paymentAcc = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $paymentAccType = $this->account_model->getById($paymentAcc->account_id);
            $categories = $this->expenses_model->get_transaction_categories($expense->id, 'Expense');
            $items = $this->expenses_model->get_transaction_items($expense->id, 'Expense');
            $count = count($categories) + count($items);
            $attachments = $this->accounting_attachments_model->get_attachments('Expense', $expense->id);
            $account = $this->account_col($expense->id, 'Expense');

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

            if($transaction->is_category === '1' || $transaction->is_item_category === '1') {
                if($transaction->is_category === '1' && $transaction->is_item_category !== '1') {
                    $child = $this->expenses_model->get_vendor_transaction_category_by_id($transaction->child_id);
                    $amount = $child->amount;
                } else {
                    $child = $this->expenses_model->get_vendor_transaction_item_by_id($transaction->child_id);
                    $amount = $child->total;
                }
            } else {
                $amount = $expense->total_amount;
            }

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $register = [
                    'id' => $expense->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'ref_no_disabled' => false,
                    'type' => $paymentAccType->account_name === 'Credit Card' ? 'CC Expense' : 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'payee_disabled' => false,
                    'memo' => $transaction->is_category === '1' ? $child->description : $expense->memo,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];

                if(isset($child)) {
                    $register['child_id'] = $child->id;
                    $register['account_id'] = $paymentAcc->id;
                    $register['account'] = $paymentAcc->name;
                    $register['account_disabled'] = true;
                    $register['account_field'] = '';
                } else {
                    $register['account_id'] = $account['id'];
                    $register['account'] = $account['name'];
                    $register['account_disabled'] = $account['disabled'];
                    $register['account_field'] = $account['field_name'];
                }

                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = $count > 1;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = $count > 1;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = $count > 1;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = $count > 1;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $expense->id,
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'type' => $paymentAccType->account_name === 'Credit Card' ? 'CC Expense' : 'Expense',
                    'memo' => $expense->memo,
                    'due_date' => date("m/d/Y", strtotime($expense->payment_date)),
                ];

                if($accType === 'A/R') {
                    $register['customer'] = $payeeName;
                    $register['open_balance'] = '-'.number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['charge_credit'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['payment'] = '';
                } else {
                    $register['vendor'] = $payeeName;
                    $register['open_balance'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['billed'] = '';
                    $register['paid'] = number_format(floatval(str_replace(',', '', $amount)), 2, '.', ',');
                    $register['account'] = $paymentAcc->name;
                }
            }

            $data[] = $register;
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
            $register = [
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
                    $register['charge'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $register['payment'] = '';
                    $register['charge_disabled'] = true;
                    $register['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $register['increase'] = '';
                    $register['decrease'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $register['increase_disabled'] = true;
                    $register['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $register['increase'] = '';
                    $register['decrease'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $register['increase_disabled'] = true;
                    $register['decrease_disabled'] = true;
                break;
                default :
                    $register['payment'] = number_format(floatval($adjustment->total_amount), 2, '.', ',');
                    $register['deposit'] = '';
                    $register['payment_disabled'] = true;
                    $register['deposit_disabled'] = true;
                break;
            }

            $data[] = $register;
        }

        $adjustedItems = $this->chart_of_accounts_model->get_adjusted_starting_value_registers($accountId);

        foreach($adjustedItems as $adjusted) {
            $register = [
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
                    $register['charge'] = '';
                    $register['payment'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $register['charge_disabled'] = true;
                    $register['payment_disabled'] = true;
                break;
                case 'Asset' :
                    $register['increase'] = '';
                    $register['decrease'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $register['increase_disabled'] = true;
                    $register['decrease_disabled'] = true;
                break;
                case 'Liability' :
                    $register['increase'] = '';
                    $register['decrease'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $register['increase_disabled'] = true;
                    $register['decrease_disabled'] = true;
                break;
                default :
                    $register['payment'] = '';
                    $register['deposit'] = number_format(floatval($adjusted->total_amount), 2, '.', ',');
                    $register['payment_disabled'] = true;
                    $register['deposit_disabled'] = true;
                break;
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }
        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'CC Payment');

        foreach($transactions as $transaction) {
            $ccPayment = $this->accounting_pay_down_credit_card_model->get_by_id($transaction->transaction_id);
            $payee = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
            $payeeName = !is_null($payee) ? $payee->display_name : "";

            $account = $ccPayment->credit_card_id === $accountId ? $this->chart_of_accounts_model->getName($ccPayment->bank_account_id) : $this->chart_of_accounts_model->getName($ccPayment->credit_card_id);
            $account_id = $ccPayment->credit_card_id === $accountId ? $ccPayment->bank_account_id : $ccPayment->credit_card_id;
            $accountFieldName = $ccPayment->credit_card_id === $accountId ? 'bank-account' : 'credit-card-account';

            $attachments = $this->accounting_attachments_model->get_attachments('CC Payment', $ccPayment->id);

            $amount = $transaction->amount;

            $register = [
                'id' => $ccPayment->id,
                'acc_transac_id' => $transaction->id,
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
                    if($transaction->type === 'increase') {
                        $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                        $register['charge'] = "";
                        $register['payment_disabled'] = true;
                        $register['charge_disabled'] = true;
                    } else {
                        $register['payment'] = "";
                        $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                        $register['payment_disabled'] = true;
                        $register['charge_disabled'] = true;
                    }
                break;
                case 'Asset' :
                    if($transaction->type === 'increase') {
                        $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                        $register['decrease'] = "";
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    } else {
                        $register['increase'] = "";
                        $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    }
                break;
                case 'Liability' :
                    if($transaction->type === 'increase') {
                        $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                        $register['decrease'] = "";
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    } else {
                        $register['increase'] = "";
                        $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                        $register['increase_disabled'] = true;
                        $register['decrease_disabled'] = true;
                    }
                break;
                default :
                    if($transaction->type === 'increase') {
                        $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                        $register['payment'] = "";
                        $register['deposit_disabled'] = true;
                        $register['payment_disabled'] = true;
                    } else {
                        $register['deposit'] = "";
                        $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                        $register['deposit_disabled'] = true;
                        $register['payment_disabled'] = true;
                    }
                break;
            }

            $data[] = $register;
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
        } else if(stripos($accountType->account_name, 'A/R') !== false) {
            $accType = 'A/R';
        } else if(stripos($accountType->account_name, 'A/P') !== false) {
            $accType = 'A/P';
        } else {
            $accType = $accountType->account_name;
        }

        $transactions = $this->accounting_account_transactions_model->get_account_transactions_by_type($accountId, 'Bill Payment');

        foreach($transactions as $transaction)
        {
            $billPayment = $this->vendors_model->get_bill_payment_by_id($transaction->transaction_id);
            $account = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
            $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
            $account = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);

            $attachments = $this->accounting_attachments_model->get_attachments('Bill Payment', $billPayment->id);

            $amount = $transaction->amount;

            if($accType !== 'A/R' && $accType !== 'A/P') {
                $apAcc = $this->chart_of_accounts_model->get_accounts_payable_account(logged('company_id'));

                $register = [
                    'id' => $billPayment->id,
                    'acc_transac_id' => $transaction->id,
                    'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                    'ref_no' => $billPayment->to_print === "1" ? "To print" : ($billPayment->check_no === null ? '' : $billPayment->check_no),
                    'ref_no_disabled' => false,
                    'type' => 'Bill Payment',
                    'payee_type' => 'vendor',
                    'payee_id' => $billPayment->payee_id,
                    'payee' => $payee->display_name,
                    'payee_disabled' => true,
                    'account_id' => $apAcc->id,
                    'account' => $apAcc->name,
                    'account_disabled' => true,
                    'memo' => $billPayment->memo,
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => count($attachments) > 0 ? count($attachments) : '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($billPayment->created_at))
                ];
    
                switch($accType) {
                    case 'Credit Card' :
                        if($transaction->type === 'increase') {
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['charge'] = "";
                            $register['payment_disabled'] = $count > 1;
                            $register['charge_disabled'] = true;
                        } else {
                            $register['payment'] = "";
                            $register['charge'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment_disabled'] = true;
                            $register['charge_disabled'] = $count > 1;
                        }
                    break;
                    case 'Asset' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    case 'Liability' :
                        if($transaction->type === 'increase') {
                            $register['increase'] = number_format(floatval($amount), 2, '.', ',');
                            $register['decrease'] = "";
                            $register['increase_disabled'] = $count > 1;
                            $register['decrease_disabled'] = true;
                        } else {
                            $register['increase'] = "";
                            $register['decrease'] = number_format(floatval($amount), 2, '.', ',');
                            $register['increase_disabled'] = true;
                            $register['decrease_disabled'] = $count > 1;
                        }
                    break;
                    default :
                        if($transaction->type === 'increase') {
                            $register['deposit'] = number_format(floatval($amount), 2, '.', ',');
                            $register['payment'] = "";
                            $register['deposit_disabled'] = $count > 1;
                            $register['payment_disabled'] = true;
                        } else {
                            $register['deposit'] = "";
                            $register['payment'] = number_format(floatval($amount), 2, '.', ',');
                            $register['deposit_disabled'] = true;
                            $register['payment_disabled'] = $count > 1;
                        }
                    break;
                }
            } else {
                $register = [
                    'id' => $billPayment->id,
                    'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                    'ref_no' => $bill->bill_no === null ? '' : $bill->bill_no,
                    'type' => 'Bill Payment',
                    'vendor' => $payee->display_name,
                    'account' => $account->name,
                    'memo' => $billPayment->memo,
                    'due_date' => '',
                    'billed' => '',
                    'paid' => number_format(floatval($amount), 2, '.', ','),
                    'open_balance' => '0.00'
                ];
            }

            $data[] = $register;
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
                    $accountId = $categories[0]->expense_account_id;
                    $category['id'] = $categories[0]->expense_account_id;
                    $category['disabled'] = false;
                    $category['field_name'] = 'expense-account';
                } else {
                    $itemId = $items[0]->item_id;
                    $item = $this->items_model->getByID($itemId);
                    $itemAccDetails = $this->items_model->getItemAccountingDetails($itemId);
                    if($item->type === 'Product' || $item->type === 'product') {
                        $accountId = $itemAccDetails->inv_asset_acc_id;
                    } else {
                        $accountId = $itemAccDetails->expense_account_id;
                    }
                    $category['id'] = $accountId;
                    $category['disabled'] = true;
                    $category['field_name'] = '';
                }

                $category['name'] = $this->chart_of_accounts_model->getName($accountId);
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

    public function make_active_inactive()
    {
        $post = $this->input->post();
        if($post['status'] == 'make-inactive') {
            $this->chart_of_accounts_model->inactive($post['id']);
        } else {
            $this->chart_of_accounts_model->makeActive($post['id']);
        }
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

    public function import_accounts_data()
    {
        self::addJSONResponseHeader();
        $input = $this->input->post();

        if($input) {
            $accounts = json_decode($input['accounts'], true); //data CSV
            $mappingSelected = json_decode($input['mapHeaders'], true); //selected Headers
            $csvHeaders = json_decode($input['csvHeaders'], true); //CSV Headers

            $inserted = 0;
            foreach($accounts as $data)
            {
                $mapName = $data[$csvHeaders[$mappingSelected[0]]];
                $mapDetailType = $data[$csvHeaders[$mappingSelected[1]]];
                $mapType = $data[$csvHeaders[$mappingSelected[2]]];
                $type = $this->account_model->get_by_name($mapType);
                $detailType = $this->account_detail_model->get_by_name_and_type_id($mapDetailType, $type->id);

                $accountData = [
                    'company_id' => logged('company_id'),
                    'name' => $mapName,
                    'account_id' => $type->id,
                    'acc_detail_id' => $detailType->acc_detail_id,
                    'balance' => 0.00,
                    'active' => 1
                ];

                $insertId = $this->chart_of_accounts_model->saverecords($accountData);

                if($insertId) {
                    $inserted++;
                }
            }

            $data_arr = array("success" => TRUE, "message" => "Successfully imported ".$inserted." accounts!", "Mapping" => $mappingSelected, "CSV"=> $csvHeaders, "accounts" => $accounts);
        } else{
            $data_arr = array("success" => FALSE,"message" => 'Something goes wrong.');
        }

        die(json_encode($data_arr));
    }
}