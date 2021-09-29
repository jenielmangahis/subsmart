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
    }

    public function index()
    {
        add_footer_js(array(
            "assets/js/accounting/accounting/chart-of-accounts.js?v=".rand()
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

        $this->page_data['accountsDropdown'] = $accountsDropdown;
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/chart_of_accounts/index', $this->page_data);
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
            $childAccounts = $this->chart_of_accounts_model->getChildAccounts($account->id, $status);

            if($search !== "") {
                if(stripos($account->name, $search) !== false) {
                    $data[] = [
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
                $data[] = [
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

            if(end($data)['id'] == $account->id && !empty($childAccounts)) {
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

        if($columnName === 'nsmartrac_balance') {
            usort($data, function($a, $b) use ($order) {
                if($order === 'asc') {
                    return floatval($a['nsmartrac_balance']) > floatval($b['nsmartrac_balance']);
                } else {
                    return floatval($a['nsmartrac_balance']) < floatval($b['nsmartrac_balance']);
                }
            });
        }

        $result = [
            'draw' => $postData['draw'],
            'recordsTotal' => count($accounts),
            'recordsFiltered' => count($data),
            'data' => array_slice($data, $start, $limit)
        ];

        echo json_encode($result);
    }

    public function create()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/chart_of_accounts/add', $this->page_data);
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

        $data = [
            'company_id' => logged('company_id'),
            'account_id' => $post['account_type'],
            'acc_detail_id' => $post['detail_type'],
            'name' => $post['name'],
            'description' => $post['description'],
            'parent_acc_id' => $post['sub_account_type'],
            'time' => $post['choose_time'],
            'balance' => $post['balance'],
            'time_date' => $date
        ];

        $account = $this->chart_of_accounts_model->saverecords($data);
        $name = $data['name'];

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
        $this->load->view('accounting/modals/account_modal', $this->page_data);
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
            "assets/js/accounting/accounting/view-register.js?v=".rand()
        ));

        $this->page_data['account'] = $account;
        $this->page_data['type'] = $type;
        $this->load->view('accounting/chart_of_accounts/view_register', $this->page_data);
    }

    public function load_registers($accountId)
    {
        $account = $this->chart_of_accounts_model->getById($accountId);
        $post = json_decode(file_get_contents('php://input'), true);
        $column = $post['order'][0]['column'];
        $order = $post['order'][0]['dir'];
        $columnName = $post['columns'][$column]['name'];
        $start = $post['start'];
        $limit = $post['length'];
        $search = $post['columns'][0]['search']['value'];

        $data = [];

        switch($post['transaction_type']) {
            case 'cc-expense' :
                $data = $this->cc_expense_registers($accountId, $data);
            break;
            case 'check' :
                $data = $this->check_registers($accountId, $data);
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
                $data = $this->journal_registers($accountId, $data);
                $data = $this->bill_registers($accountId, $data);
                $data = $this->cc_credit_registers($accountId, $data);
                $data = $this->vendor_credit_registers($accountId, $data);
                $data = $this->bill_payment_registers($accountId, $data);
                $data = $this->transfer_registers($accountId, $data);
                $data = $this->deposit_registers($accountId, $data);
                $data = $this->quantity_adjustment_registers($accountId, $data);
                $data = $this->expense_registers($accountId, $data);
                $data = $this->item_starting_value_registers($accountId, $data);
                $data = $this->credit_card_payment_registers($accountId, $data);
            break;
        }

        // Filter
        $data = array_filter($data, function($reg, $key) use ($post, $search) {
            $flag = true;

            if($post['from_date'] !== "" && strtotime($reg['date']) < strtotime($post['from_date'])) {
                $flag = false;
            }

            if($post['to_date'] !== "" && strtotime($reg['date']) > strtotime($post['to_date'])) {
                $flag = false;
            }

            if($post['payee'] !== "all") {
                $payee = explode($post['payee']);

                if($reg['payee_type'] !== $payee[0] || $reg['payee_id'] !== $payee[1]) {
                    $flag = false;
                }
            }

            if($search !== "") {
                if(str_contains($search, '<') || str_contains($search, '>')) {
                    $searchString = str_replace('<', '', $search);
                    $searchString = str_replace('>', '', $search);

                    $searchFloat = floatval($searchString);

                    if(str_contains($search, '<')) {
                        $flag = floatval($reg['payment']) < $searchFloat || floatval($reg['deposit']) < $searchFloat;
                    } else {
                        $flag = floatval($reg['payment']) > $searchFloat || floatval($reg['deposit']) > $searchFloat;
                    }
                } else {
                    if(stripos($reg['ref_no'], $search) === false && stripos($reg['memo'], $search) === false && 
                    stripos(strval($reg['payment']), $search) === false && stripos(strval($reg['deposit']), $search) === false) {
                        $flag = false;
                    }
                }
            }

            return $flag;
        }, ARRAY_FILTER_USE_BOTH);

        $displayBalanceOn = [
            'date',
            'reconcile_status'
        ];

        if(in_array($columnName, $displayBalanceOn) && $post['transaction_type'] === 'all' && $post['reconcile_status'] === 'all' && $post['payee'] === 'all') {
            $registers = $data;

            usort($registers, function($a, $b) {
                if(strtotime($a['date']) === strtotime($b['date'])) {
                    return strtotime($a['date_created']) < strtotime($b['date_created']);
                }
                return strtotime($a['date']) < strtotime($b['date']);
            });

            $accBalance = floatval($account->balance);
            foreach($registers as $key => $reg) {
                $registers[$key]['balance'] = '$'.number_format($accBalance, 2, '.', ',');
                $accBalance -= floatval($reg['deposit']);
                $accBalance += floatval($reg['payment']);
            }

            $data = $registers;
        }

        usort($data, function($a, $b) use ($columnName, $order) {
            switch($columnName) {
                case 'date' :
                    if($order === 'asc') {
                        if(strtotime($a['date']) === strtotime($b['date'])) {
                            return strtotime($a['date_created']) > strtotime($b['date_created']);
                        }
                        return strtotime($a['date']) > strtotime($b['date']);
                    } else {
                        if(strtotime($a['date']) === strtotime($b['date'])) {
                            return strtotime($a['date_created']) < strtotime($b['date_created']);
                        }
                        return strtotime($a['date']) < strtotime($b['date']);
                    }
                break;
                case 'payment' :
                    if($order === 'asc') {
                        return $a['payment'] > $b['payment'];
                    } else {
                        return $a['payment'] < $b['payment'];
                    }
                break;
                case 'deposit' :
                    if($order === 'asc') {
                        return $a['deposit'] > $b['deposit'];
                    } else {
                        return $a['deposit'] < $b['deposit'];
                    }
                break;
                case 'ref_no' :
                    if($order === 'asc') {
                        if($a['ref_no'] === '' && $b['ref_no'] !== '') {
                            return false;
                        }
    
                        if($a['ref_no'] !== '' && $b['ref_no'] === '') {
                            return true;
                        }

                        if(intval($a['ref_no']) === 0 && intval($b['ref_no']) === 0) {
                            return strcmp($a['ref_no'], $b['ref_no']);
                        }

                        return intval($a['ref_no']) > intval($b['ref_no']);
                    } else {
                        if($a['ref_no'] === '' && $b['ref_no'] !== '') {
                            return true;
                        }
    
                        if($a['ref_no'] !== '' && $b['ref_no'] === '') {
                            return false;
                        }

                        if(intval($a['ref_no']) === 0 && intval($b['ref_no']) === 0) {
                            return strcmp($b['ref_no'], $a['ref_no']);
                        }

                        return intval($a['ref_no']) < intval($b['ref_no']);
                    }
                break;
                default :
                    if($order === 'asc') {
                        return strcmp($a[$columnName], $b[$columnName]);
                    } else {
                        return strcmp($b[$columnName], $a[$columnName]);
                    }
                break;
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

    private function cc_expense_registers($accountId, $data = [])
    {
        $expenses = $this->chart_of_accounts_model->get_expense_registers($accountId);

        foreach($expenses as $expense) {
            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);

            if($accountType->account_name === 'Credit Card') {
                $data[] = [
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'type' => 'CC Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'account' => $this->account_col($expense->id, 'Expense'),
                    'memo' => $expense->memo,
                    'payment' => number_format(floatval($expense->total_amount), 2, '.', ','),
                    'deposit' => '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];
            }
        }

        $expenseCategories = $this->chart_of_accounts_model->get_vendor_transaction_registers($accountId, 'Expense');

        foreach($expenseCategories as $expenseCategory) {
            $expense = $this->vendors_model->get_expense_by_id($expenseCategory->transaction_id);
            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            if($accountType->account_name === 'Credit Card') {
                $data[] = [
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'type' => 'CC Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'account' => $account->name,
                    'memo' => $expense->memo,
                    'payment' => '',
                    'deposit' => number_format(floatval($expenseCategory->amount), 2, '.', ','),
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];
            }
        }

        return $data;
    }

    private function check_registers($accountId, $data = [])
    {
        $checks = $this->chart_of_accounts_model->get_checks_registers($accountId);

        foreach($checks as $check) {
            switch($check->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($check->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($check->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $data[] = [
                'date' => date("m/d/Y", strtotime($check->payment_date)),
                'ref_no' => $check->to_print === "1" ? "To print" : $check->check_no === null ? '' : $check->check_no,
                'type' => 'Check',
                'payee_type' => $check->payee_type,
                'payee_id' => $check->payee_id,
                'payee' => $payeeName,
                'account' => $this->account_col($check->id, 'Check'),
                'memo' => $check->memo,
                'payment' => number_format(floatval($check->total_amount), 2, '.', ','),
                'deposit' => '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($check->created_at))
            ];
        }

        $checkCategories = $this->chart_of_accounts_model->get_vendor_transaction_registers($accountId, 'Check');

        foreach($checkCategories as $checkCategory) {
            $check = $this->vendors_model->get_check_by_id($checkCategory->transaction_id);

            switch($check->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($check->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($check->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $data[] = [
                'date' => date("m/d/Y", strtotime($check->payment_date)),
                'ref_no' => $check->to_print === "1" ? "To print" : $check->check_no === null ? '' : $check->check_no,
                'type' => 'Check',
                'payee_type' => $check->payee_type,
                'payee_id' => $check->payee_id,
                'payee' => $payeeName,
                'account' => $this->chart_of_accounts_model->getName($check->bank_account_id),
                'memo' => $check->memo,
                'payment' => '',
                'deposit' => number_format(floatval($checkCategory->amount), 2, '.', ','),
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($checkCategory->created_at))
            ];
        }

        return $data;
    }

    private function journal_registers($accountId, $data = [])
    {
        $this->load->model('accounting_journal_entries_model');
        $journalEntries = $this->chart_of_accounts_model->get_journal_entry_registers($accountId);

        foreach($journalEntries as $journalEntryItem) {
            $journalEntry = $this->accounting_journal_entries_model->getById($journalEntryItem->journal_entry_id);

            $data[] = [
                'date' => date("m/d/Y", strtotime($journalEntry->journal_date)),
                'ref_no' => $journalEntry->journal_no === null ? '' : $journalEntry->journal_no,
                'type' => 'Journal',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => '-Split-',
                'memo' => $journalEntry->memo,
                'payment' => $journalEntryItem->credit !== "0" ? number_format(floatval($journalEntryItem->credit), 2, '.', ',') : "",
                'deposit' => $journalEntryItem->debit !== "0" ? number_format(floatval($journalEntryItem->debit), 2, '.', ',') : "",
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($journalEntry->created_at))
            ];
        }

        return $data;
    }

    private function bill_registers($accountId, $data = [])
    {
        $billItems = $this->chart_of_accounts_model->get_vendor_transaction_registers($accountId, 'Bill');

        foreach($billItems as $billItem) {
            $bill = $this->vendors_model->get_bill_by_id($billItem->transaction_id);
            $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
            $payeeName = $payee->display_name;

            $data[] = [
                'date' => date("m/d/Y", strtotime($bill->bill_date)),
                'ref_no' => $bill->bill_no === null ? '' : $bill->bill_no,
                'type' => 'Bill',
                'payee_type' => 'vendor',
                'payee_id' => $bill->vendor_id,
                'payee' => $payeeName,
                'account' => 'Accounts Payable',
                'memo' => $bill->memo,
                'payment' => "",
                'deposit' => number_format(floatval($billItem->amount), 2, '.', ','),
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($billItem->created_at))
            ];
        }

        return $data;
    }

    private function cc_credit_registers($accountId, $data = [])
    {
        $ccCredits = $this->chart_of_accounts_model->get_credit_card_credit_registers($accountId);

        foreach($ccCredits as $ccCredit) {
            switch($ccCredit->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($ccCredit->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $data[] = [
                'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                'ref_no' => $ccCredit->ref_no === null ? '' : $ccCredit->ref_no,
                'type' => 'CC-Credit',
                'payee_type' => $ccCredit->payee_type,
                'payee_id' => $ccCredit->payee_id,
                'payee' => $payeeName,
                'account' => $this->account_col($ccCredit->id, 'Credit Card Credit'),
                'memo' => $ccCredit->memo,
                'payment' => number_format(floatval($ccCredit->total_amount), 2, '.', ','),
                'deposit' => '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($ccCredit->created_at))
            ];
        }

        $ccCreditCategories = $this->chart_of_accounts_model->get_vendor_transaction_registers($accountId, 'Credit Card Credit');

        foreach($ccCreditCategories as $ccCreditCategory) {
            $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($ccCreditCategory->transaction_id);

            switch($ccCredit->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($ccCredit->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($ccCredit->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $data[] = [
                'date' => date("m/d/Y", strtotime($ccCredit->payment_date)),
                'ref_no' => $ccCredit->ref_no === null ? '' : $ccCredit->ref_no,
                'type' => 'CC-Credit',
                'payee_type' => $ccCredit->payee_type,
                'payee_id' => $ccCredit->payee_id,
                'payee' => $payeeName,
                'account' => $this->chart_of_accounts_model->getName($ccCredit->bank_credit_account_id),
                'memo' => $ccCredit->memo,
                'payment' => number_format(floatval($ccCreditCategory->amount), 2, '.', ','),
                'deposit' => '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($ccCreditCategory->created_at))
            ];
        }

        return $data;
    }

    private function vendor_credit_registers($accountId, $data = [])
    {
        $vendorCredits = $this->chart_of_accounts_model->get_vendor_transaction_registers($accountId, 'Vendor Credit');

        foreach($vendorCredits as $vendorCredit) {
            $vCredit = $this->vendors_model->get_vendor_credit_by_id($vendorCredit->transaction_id);
            $payee = $this->vendors_model->get_vendor_by_id($vCredit->payee_id);
            $payeeName = $payee->display_name;

            $data[] = [
                'date' => date("m/d/Y", strtotime($vCredit->payment_date)),
                'ref_no' => $vCredit->ref_no === null ? '' : $vCredit->ref_no,
                'type' => 'Vendor Credit',
                'payee_type' => 'vendor',
                'payee_id' => $vendorCredit->payee_id,
                'payee' => $payeeName,
                'account' => 'Accounts Payable',
                'memo' => $vCredit->memo,
                'payment' => number_format(floatval($vendorCredit->amount), 2, '.', ','),
                'deposit' => '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($vendorCredit->created_at))
            ];
        }

        return $data;
    }

    private function transfer_registers($accountId, $data = [])
    {
        $transfers = $this->chart_of_accounts_model->get_transfer_registers($accountId);

        foreach($transfers as $transfer) {
            if($transfer->transfer_from_account_id === $accountId) {
                $account = $this->chart_of_accounts_model->getName($transfer->transfer_to_account_id);
            } else {
                $account = $this->chart_of_accounts_model->getName($transfer->transfer_from_account_id);
            }
            $data[] = [
                'date' => date("m/d/Y", strtotime($transfer->transfer_date)),
                'ref_no' => '',
                'type' => 'Transfer',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => $account,
                'memo' => $transfer->transfer_memo,
                'payment' => $transfer->transfer_from_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '',
                'deposit' => $transfer->transfer_to_account_id === $accountId ? number_format(floatval($transfer->transfer_amount), 2, '.', ',') : '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($transfer->created_at))
            ];
        }

        return $data;
    }

    private function deposit_registers($accountId, $data = [])
    {
        $this->load->model('accounting_bank_deposit_model');
        $deposits = $this->chart_of_accounts_model->get_deposit_registers($accountId);

        foreach($deposits as $deposit) {
            $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);

            if(count($funds) > 1 || $deposit->cash_back_amount !== "" && $deposit->cash_back_account_id !== "" && !is_null($deposit->cash_back_amount) && !is_null($deposit->cash_back_account_id)) { 
                $account = '-Split-';
            } else {
                $account = $this->chart_of_accounts_model->getName($funds[0]->received_from_account_id);
            }
            $data[] = [
                'date' => date("m/d/Y", strtotime($deposit->date)),
                'ref_no' => '',
                'type' => 'Deposit',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => $account,
                'memo' => $deposit->memo,
                'payment' => '',
                'deposit' => number_format(floatval($deposit->total_amount), 2, '.', ','),
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($deposit->created_at))
            ];
        }

        $depositFunds = $this->chart_of_accounts_model->get_deposit_payment_registers($accountId);

        foreach($depositFunds as $depFund) {
            $dep = $this->accounting_bank_deposit_model->getById($depFund->bank_deposit_id);

            $data[] = [
                'date' => date("m/d/Y", strtotime($dep->date)),
                'ref_no' => '',
                'type' => 'Deposit',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => $this->chart_of_accounts_model->getName($dep->account_id),
                'memo' => $dep->memo,
                'payment' => number_format(floatval($depFund->amount), 2, '.', ','),
                'deposit' => '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($depFund->created_at))
            ];
        }

        return $data;
    }

    private function cash_expense_registers($accountId, $data = [])
    {
        $expenses = $this->chart_of_accounts_model->get_expense_registers($accountId);

        foreach($expenses as $expense) {
            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);
            $detailType = $this->account_detail_model->getById($account->acc_detail_id);

            if($accountType->account_name === 'Bank' && $detailType->acc_detail_name === 'Cash on hand') {
                $data[] = [
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'account' => $this->account_col($expense->id, 'Expense'),
                    'memo' => $expense->memo,
                    'payment' => number_format(floatval($expense->total_amount), 2, '.', ','),
                    'deposit' => '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];
            }
        }

        $expenseCategories = $this->chart_of_accounts_model->get_vendor_transaction_registers($accountId, 'Expense');

        foreach($expenseCategories as $expenseCategory) {
            $expense = $this->vendors_model->get_expense_by_id($expenseCategory->transaction_id);
            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);
            $detailType = $this->account_detail_model->getById($account->acc_detail_id);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            if($accountType->account_name === 'Bank' && $detailType->acc_detail_name === 'Cash on hand') {
                $data[] = [
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'account' => $account->name,
                    'memo' => $expense->memo,
                    'payment' => '',
                    'deposit' => number_format(floatval($expenseCategory->amount), 2, '.', ','),
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];
            }
        }

        return $data;
    }

    private function quantity_adjustment_registers($accountId, $data = [])
    {
        $this->load->model('accounting_inventory_qty_adjustments_model');
        $this->load->model('item_starting_value_adj_model', 'starting_value_model');
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

            $data[] = [
                'date' => date("m/d/Y", strtotime($invQtyAdj->adjustment_date)),
                'ref_no' => $invQtyAdj->adjustment_no === null ? '' : $invQtyAdj->adjustment_no,
                'type' => 'Inventory Qty Adjust',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => $this->chart_of_accounts_model->getName($invQtyAdj->inventory_adjustment_account_id),
                'memo' => $invQtyAdj->memo,
                'payment' => number_format($payment, 2, '.', ','),
                'deposit' => '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($invQtyAdj->created_at))
            ];
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

            $data[] = [
                'date' => date("m/d/Y", strtotime($invQtyAdj->adjustment_date)),
                'ref_no' => $invQtyAdj->adjustment_no === null ? '' : $invQtyAdj->adjustment_no,
                'type' => 'Inventory Qty Adjust',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => $this->chart_of_accounts_model->getName($invQtyAdj->inventory_adjustment_account_id),
                'memo' => $invQtyAdj->memo,
                'payment' => number_format($payment, 2, '.', ','),
                'deposit' => '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($invQtyAdjItem->created_at))
            ];
        }

        return $data;
    }

    private function expense_registers($accountId, $data = [])
    {
        $expenses = $this->chart_of_accounts_model->get_expense_registers($accountId);

        foreach($expenses as $expense) {
            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);

            if($accountType->account_name !== 'Credit Card') {
                $data[] = [
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'account' => $this->account_col($expense->id, 'Expense'),
                    'memo' => $expense->memo,
                    'payment' => number_format(floatval($expense->total_amount), 2, '.', ','),
                    'deposit' => '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expense->created_at))
                ];
            }
        }

        $expenseCategories = $this->chart_of_accounts_model->get_vendor_transaction_registers($accountId, 'Expense');

        foreach($expenseCategories as $expenseCategory) {
            $expense = $this->vendors_model->get_expense_by_id($expenseCategory->transaction_id);
            $account = $this->chart_of_accounts_model->getById($expense->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);

            switch($expense->payee_type) {
                case 'vendor':
                    $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                    $payeeName = $payee->display_name;
                break;
                case 'customer':
                    $payee = $this->accounting_customers_model->get_customer_by_id($expense->payee_id);
                    $payeeName = $payee->first_name . ' ' . $payee->last_name;
                break;
                case 'employee':
                    $payee = $this->users_model->getUser($expense->payee_id);
                    $payeeName = $payee->FName . ' ' . $payee->LName;
                break;
            }

            if($accountType->account_name !== 'Credit Card') {
                $data[] = [
                    'date' => date("m/d/Y", strtotime($expense->payment_date)),
                    'ref_no' => $expense->ref_no === null ? '' : $expense->ref_no,
                    'type' => 'Expense',
                    'payee_type' => $expense->payee_type,
                    'payee_id' => $expense->payee_id,
                    'payee' => $payeeName,
                    'account' => $account->name,
                    'memo' => $expense->memo,
                    'payment' => '',
                    'deposit' => number_format(floatval($expenseCategory->amount), 2, '.', ','),
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($expenseCategory->created_at))
                ];
            }
        }

        return $data;
    }

    private function item_starting_value_registers($accountId, $data = [])
    {
        $adjustments = $this->chart_of_accounts_model->get_item_starting_value_registers($accountId);

        foreach($adjustments as $adjustment) {
            $itemAccDetails = $this->items_model->getItemAccountingDetails($adjustment->item_id);
            $invAssetAcc = $itemAccDetails->inv_asset_acc_id;

            $deposit = floatval($adjustment->initial_cost) * intval($adjustment->initial_qty);

            $data[] = [
                'date' => date("m/d/Y", strtotime($adjustment->as_of_date)),
                'ref_no' => $adjustment->ref_no === null ? '' : $adjustment->ref_no,
                'type' => 'Inventory Starting Value',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => $this->chart_of_accounts_model->getName($invAssetAcc),
                'memo' => $adjustment->memo,
                'payment' => '',
                'deposit' => number_format(floatval($deposit), 2, '.', ','),
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($adjustment->created_at))
            ];
        }

        $adjustedItems = $this->chart_of_accounts_model->get_adjusted_starting_value_registers($accountId);

        foreach($adjustedItems as $adjusted) {
            $itemAccDetails = $this->items_model->getItemAccountingDetails($adjusted->item_id);
            $invAssetAcc = $itemAccDetails->inv_asset_acc_id;

            $deposit = floatval($adjusted->initial_cost) * intval($adjusted->initial_qty);

            $data[] = [
                'date' => date("m/d/Y", strtotime($adjusted->as_of_date)),
                'ref_no' => $adjusted->ref_no === null ? '' : $adjusted->ref_no,
                'type' => 'Inventory Starting Value',
                'payee_type' => '',
                'payee_id' => '',
                'payee' => '',
                'account' => $this->chart_of_accounts_model->getName($invAssetAcc),
                'memo' => $adjusted->memo,
                'payment' => '',
                'deposit' => number_format(floatval($deposit), 2, '.', ','),
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($adjusted->created_at))
            ];
        }

        return $data;
    }

    private function credit_card_payment_registers($accountId, $data = [])
    {
        $ccPayments = $this->chart_of_accounts_model->get_credit_card_payment_registers($accountId);

        foreach($ccPayments as $ccPayment) {
            $payee = $this->vendors_model->get_vendor_by_id($ccPayment->payee_id);
            $payeeName = !is_null($payee) ? $payee->display_name : "";

            $account = $ccPayment->credit_card_id === $accountId ? $this->chart_of_accounts_model->getName($ccPayment->bank_account_id) : $this->chart_of_accounts_model->getName($ccPayment->credit_card_id);

            $data[] = [
                'date' => date("m/d/Y", strtotime($ccPayment->date)),
                'ref_no' => '',
                'type' => 'Credit Card Pmt',
                'payee_type' => 'vendor',
                'payee_id' => $ccPayment->payee_id,
                'payee' => $payeeName,
                'account' => $account,
                'memo' => $ccPayment->memo,
                'payment' => $ccPayment->bank_account_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '',
                'deposit' => $ccPayment->credit_card_id === $accountId ? number_format(floatval($ccPayment->amount), 2, '.', ',') : '',
                'reconcile_status' => '',
                'banking_status' => '',
                'attachments' => '',
                'tax' => '',
                'balance' => '',
                'date_created' => date("m/d/Y H:i:s", strtotime($ccPayment->created_at))
            ];
        }

        return $data;
    }

    private function bill_payment_registers($accountId, $data = [], $creditCard = false)
    {
        $billPayments = $this->chart_of_accounts_model->get_bill_payment_registers($accountId);

        foreach($billPayments as $billPayment) {
            $payee = $this->vendors_model->get_vendor_by_id($billPayment->payee_id);
            $account = $this->chart_of_accounts_model->getById($billPayment->payment_account_id);
            $accountType = $this->account_model->getById($account->account_id);

            if($creditCard === true && $accountType->account_name === 'Credit Card' || $creditCard === false) {
                $data[] = [
                    'date' => date("m/d/Y", strtotime($billPayment->payment_date)),
                    'ref_no' => $billPayment->to_print_check_no === "1" ? "To print" : $billPayment->check_no === null ? '' : $billPayment->check_no,
                    'type' => 'Bill Payment',
                    'payee_type' => 'vendor',
                    'payee_id' => $billPayment->payee_id,
                    'payee' => $payee->display_name,
                    'account' => 'Accounts Payable',
                    'memo' => $billPayment->memo,
                    'payment' => number_format(floatval($billPayment->total_amount), 2, '.', ','),
                    'deposit' => '',
                    'reconcile_status' => '',
                    'banking_status' => '',
                    'attachments' => '',
                    'tax' => '',
                    'balance' => '',
                    'date_created' => date("m/d/Y H:i:s", strtotime($billPayment->created_at))
                ];
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

                $category = $this->chart_of_accounts_model->getName($expenseAcc);
            }
        }

        return $category;
    }
}