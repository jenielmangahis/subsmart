<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chart_of_accounts extends MY_Controller {
	
	public function __construct()
    {
		parent::__construct();
        $this->checkLogin();
        $this->load->model('chart_of_accounts_model');
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
            "assets/js/accounting/accounting/chart-of-accounts.js"
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
            $childAccounts = $this->chart_of_accounts_model->getChildAccounts($account->id);

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
        $data = [
            'company_id' => logged('company_id'),
            'account_id' => $this->input->post('account_type'),
            'acc_detail_id' => $this->input->post('detail_type'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'parent_acc_id' => $this->input->post('sub_account_type'),
            'time' => $this->input->post('choose_time'),
            'balance' => $this->input->post('balance'),
            'time_date' => $this->input->post('time_date')
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
        $accountTypes = $this->account_model->getAccounts();
        $accountsDropdown = [];
        foreach($accountTypes as $type)
        {
            foreach($this->chart_of_accounts_model->getByAccountType($type->id, null, logged('company_id')) as $account)
            {
                if($account->id !== $id) {
                    $childAccounts = $this->chart_of_accounts_model->getChildAccounts($account->id, $id);
                    $accountsDropdown[$type->account_name][] = [
                        'id' => $account->id,
                        'name' => $account->name,
                        'child_accounts' => $childAccounts
                    ];
                }
            }
        }
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['chart_of_accounts'] = $this->chart_of_accounts_model->getById($id);
        $this->page_data['accountsDropdown'] = $accountsDropdown;
        $this->page_data['detail_type'] = $this->account_detail_model->getById($this->page_data['chart_of_accounts']->acc_detail_id);
        $this->load->view('accounting/chart_of_accounts/edit', $this->page_data);
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
            'time' => $this->input->post('choose_time'),
            'balance' => $this->input->post('balance'),
            'time_date' => $this->input->post('time') === 'Other' ? $this->input->post('time_date') : null
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
}