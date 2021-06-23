<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once 'application/services/InvoiceCustomer.php';

class Accounting extends MY_Controller
{
    private $upload_path = "./uploads/accounting/";
    private $expenses_path = "./uploads/accounting/expenses/";
    public function __construct()
    {
        parent::__construct();

        $this->checkLogin();
        $this->hasAccessModule(45);
        $this->load->model('vendors_model');
        $this->load->model('terms_model');
        $this->load->model('expenses_model');
        $this->load->model('rules_model');
        $this->load->model('receipt_model');
        $this->load->model('tags_model');
        $this->load->model('categories_model');
        $this->load->model('accounting_invoices_model');
        $this->load->model('accounting_receive_payment_model');
        $this->load->model('accounting_sales_receipt_model');
        $this->load->model('accounting_credit_memo_model');
        $this->load->model('accounting_delayed_charge_model');
        $this->load->model('accounting_sales_time_activity_model');
        $this->load->model('accounting_customers_model');
        $this->load->model('accounting_refund_receipt_model');
        $this->load->model('accounting_delayed_credit_model');
        $this->load->model('accounting_purchase_order_model');
        $this->load->model('accounting_credit_card_model');
        $this->load->model('estimate_model');
        $this->load->model('account_model');
        $this->load->model('accounting_attachments_model');
        $this->load->model('accounting_payment_methods_model');
        $this->load->model('accounting_expense_name_model');
        $this->load->model('accounting_terms_model');
        $this->load->model('accounting_recurring_transactions_model');
        $this->load->model('items_model');
        $this->load->model('Invoice_model', 'invoice_model');
        $this->load->model('Estimate_model', 'estimate_model');
        $this->load->model('Jobs_model', 'jobs_model');
        $this->load->model('Invoice_settings_model', 'invoice_settings_model');
        $this->load->model('AcsProfile_model', 'AcsProfile_model');
        $this->load->model('TaxRates_model');
        $this->load->model('Workorder_model', 'workorder_model');
        $this->load->model('General_model', 'general');
        $this->load->model('item_starting_value_adj_model', 'starting_value_model');
        $this->load->library('excel');
//        The "?v=rand()" is to remove browser caching. It needs to remove in the live website.
        add_css(array(
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
            "assets/js/accounting/accounting.js",
            "assets/js/accounting/modal-forms.js",
            "assets/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js"
        ));

        $this->page_data['menu_name'] =
            array(
                array("Dashboard",  array()),
                array("Banking",    array('Link Bank','Rules','Receipts','Tags')),
                array("Expenses",   array('Expenses','Vendors')),
                array("Sales",      array('Overview','All Sales','Estimates','Customers','Deposits','Work Order','Invoice','Jobs')),
                array("Payroll",    array('Overview','Employees','Contractors',"Workers' Comp",'Benifits')),
                array("Reports",    array()),
                array("Taxes",      array("Sales Tax","Payroll Tax")),
                array("Mileage",    array()),
                array("Accounting", array("Chart of Accounts","Reconcile"))
            );
        $this->page_data['menu_link'] =
            array(
                array('/accounting/banking',array()),
                array("",	array('/accounting/link_bank','/accounting/rules','/accounting/receipts','/accounting/tags')),
                array("",	array('/accounting/expenses','/accounting/vendors')),
                array("",	array('/accounting/sales-overview','/accounting/all-sales','/accounting/newEstimateList','/accounting/customers','/accounting/deposits','/accounting/listworkOrder','/accounting/invoices', '/accounting/jobs')),
                array("",	array('/accounting/payroll-overview','/accounting/employees','/accounting/contractors','/accounting/workers-comp','#')),
                array('/accounting/reports',array()),
                array("",   array('/accounting/salesTax','/accounting/payrollTax')),
                array('#',  array()),
                array("",   array('/accounting/chart-of-accounts','/accounting/reconcile')),
            );


        $this->page_data['menu_icon'] = array("fa-tachometer","fa-university","fa-credit-card","fa-money","fa-dollar","fa-bar-chart","fa-minus-circle","fa-file","fa-calculator");
        $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId(logged('company_id'));
        $this->page_data['invoices'] = $this->invoice_model->getAllData(logged('company_id'));
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['packages'] = $this->workorder_model->getPackagelist(logged('company_id'));
        $this->page_data['estimates'] = $this->estimate_model->getAllByCompany(logged('company_id'));
        $this->page_data['sales_receipts'] = $this->accounting_sales_receipt_model->getAllByCompany(logged('company_id'));
        $this->page_data['credit_memo'] = $this->accounting_credit_memo_model->getAllByCompany(logged('company_id'));
    }

    public function index()
    {
        redirect('/accounting/sales-overview', 'refresh');
    }
    public function banking()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['alert'] = 'accounting/alert_promt';
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->page_data['terms'] = $this->accounting_invoices_model->getPayTerms();
        $this->page_data['paymethods'] = $this->accounting_receive_payment_model->getpaymethod();

        //additional
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

        /*$this->page_data['vendors'] = $this->vendors_model->getVendors();
        $this->page_data['checks'] = $this->expenses_model->getCheck();
        $this->page_data['transactions'] = $this->expenses_model->getTransaction();
        $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
        $this->page_data['bills'] = $this->expenses_model->getBill();
        $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
        $this->page_data['expenses'] = $this->expenses_model->getExpense();
        $this->page_data['list_categories'] = $this->categories_model->getCategories();
        $this->page_data['attachments'] = $this->expenses_model->getAttachment();
        $this->page_data['items'] = $this->items_model->getItemlist();*/

        $this->load->view('accounting/dashboard', $this->page_data);
    }

    public function apply_for_capital()
    {
        $this->load->view('includes/header', $this->page_data);
        $this->load->view('accounting/apply_for_capital', $this->page_data);
    }

    // public function expenses()
    // {
    //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));
    //     $this->page_data['vendors'] = $this->vendors_model->getVendors();
    //     $this->page_data['checks'] = $this->expenses_model->getCheck();
    //     $this->page_data['transactions'] = $this->expenses_model->getTransaction();
    //     $this->page_data['categories'] = $this->expenses_model->getExpenseCategory();
    //     $this->page_data['bills'] = $this->expenses_model->getBill();
    //     $this->page_data['vendor_credits'] = $this->expenses_model->getVendorCredit();
    //     $this->page_data['expenses'] = $this->expenses_model->getExpense();
    //     $this->page_data['list_categories'] = $this->categories_model->getCategories();
    //     $this->page_data['attachments'] = $this->expenses_model->getAttachment();
    //     $this->load->view('accounting/expenses', $this->page_data);
    // }
    // public function vendors(){
    //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));
    //     $this->page_data['vendors'] = $this->vendors_model->getVendors();
    //     $this->load->view('accounting/vendors', $this->page_data);
    // }

    public function receivables()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/receivables', $this->page_data);
    }

    public function workers()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/workers', $this->page_data);
    }

    public function taxes()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/taxes', $this->page_data);
    }

    public function my_accountant()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/my_accountant', $this->page_data);
    }

    public function link_bank()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/banking', $this->page_data);
    }

    public function rules()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rules'] = $this->rules_model->getRules();
        $this->load->view('accounting/rules', $this->page_data);
    }

    public function receipts()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['receipts'] = $this->receipt_model->getReceipt();
        $this->load->view('accounting/receipts', $this->page_data);
    }

    public function salesoverview()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/sales_overview', $this->page_data);
    }
    public function allsales()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/all_sales', $this->page_data);
    }
    public function invoices()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $company_id = getLoggedCompanyID();
        $this->page_data['invoices'] = $this->invoice_model->getAllData($company_id);
        $this->page_data['page_title'] = "Invoices";
        // print_r($this->page_data);
        $this->load->view('accounting/invoices', $this->page_data);
    }
    public function customers()
    {
        add_css(array(
            'assets/css/accounting/customers.css',
        ));
        add_footer_js(array(
            "assets/js/accounting/sales/customers.js",
            "assets/js/accounting/sales/customer_includes/send_reminder.js",
            "assets/js/accounting/sales/customer_includes/receive_payment.js"
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['customers'] = $this->accounting_customers_model->getAllByCompany();
        $this->page_data['page_title'] = "Customers";
        $this->load->view('accounting/customers', $this->page_data);
    }
    public function deposits()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Deposits";
        $this->page_data['invoices'] = $this->accounting_invoices_model->getDataInvoices();
        $this->load->view('accounting/deposits', $this->page_data);
    }


    // private function uploadFile($files)
    // {
    //     $this->load->helper('string');
    //     $data = [];
    //     foreach($files['name'] as $key => $name) {
    //         $extension = end(explode('.', $name));

    //         do {
    //             $randomString = random_string('alnum');
    //             $fileNameToStore = $randomString . '.' .$extension;
    //             $exists = file_exists('./uploads/accounting/attachments/'.$fileNameToStore);
    //         } while ($exists);

    //         $fileType = explode('/', $files['type'][$key]);
    //         $uploadedName = str_replace('.'.$extension, '', $name);

    //         $data[] = [
    //             'company_id' => getLoggedCompanyID(),
    //             'type' => $fileType[0] === 'application' ? ucfirst($fileType[1]) : ucfirst($fileType[0]),
    //             'uploaded_name' => $uploadedName,
    //             'stored_name' => $fileNameToStore,
    //             'file_extension' => $extension,
    //             'size' => $files['size'][$key],
    //             'notes' => null,
    //             'status' => 1,
    //             'created_at' => date('Y-m-d h:i:s'),
    //             'updated_at' => date('Y-m-d h:i:s')
    //         ];

    //         move_uploaded_file($files['tmp_name'][$key], './uploads/accounting/attachments/'.$fileNameToStore);
    //     }

    //     $insert = $this->accounting_attachments_model->insertBatch($data);

    //     return $insert;
    // }
    public function jobs()
    {
        add_css(array(
            'assets/css/accounting/jobs.css',
        ));
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Jobs";
        // $this->page_data['jobs'] = $this->accounting_invoices_model->getDataInvoices();
        $this->page_data['jobs'] = $this->jobs_model->get_all_jobs();
        $this->load->view('accounting/jobs', $this->page_data);
    }

    public function invoice_edit($id)
    {
        $comp_id = logged('company_id');
        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) {
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        // $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();

        $this->page_data['invoice'] = $this->invoice_model->getinvoice($id);
        $this->page_data['items'] = $this->invoice_model->getItems($id);
        // print_r($this->page_data['invoice']);

        $this->load->view('accounting/invoice_edit', $this->page_data);
    }

    public function adjust_starting_value_form($item_id)
    {
        $accounts = $this->chart_of_accounts_model->select();
        $accountTypes = $this->account_model->getAccounts();

        $bankAccounts = [];
        foreach ($accountTypes as $accType) {
            $accName = strtolower($accType->account_name);

            foreach ($accounts as $account) {
                if ($account->account_id === $accType->id) {
                    $bankAccounts[$accType->account_name][] = [
                        'value' => $accName.'-'.$account->id,
                        'text' => $account->name,
                    ];
                }
            }
        }

        $item = $this->items_model->getItemById($item_id)[0];
        $itemAccDetails = $this->items_model->getItemAccountingDetails($item_id);
        $invAssetAcc = $this->chart_of_accounts_model->getById($itemAccDetails->inv_asset_acc_id);

        $this->page_data['accounts'] = $bankAccounts;
        $this->page_data['item'] = $item;
        $this->page_data['accountingDetails'] = $itemAccDetails;
        $this->page_data['invAssetAcc'] = $invAssetAcc;
        $this->page_data['locations'] = $this->items_model->getLocationByItemId($item_id);
        $this->load->view('accounting/modals/adjust_starting_value', $this->page_data);
    }
    public function adjust_starting_value($item_id)
    {
        $item = $this->items_model->getItemById($item_id)[0];
        $startValueAdjData = [
            'company_id' => logged('company_id'),
            'item_id' => $item_id,
            'ref_no' => $this->input->post('ref_no'),
            'location_id' => $this->input->post('location'),
            'initial_qty' => $this->input->post('initial_qty_on_hand'),
            'as_of_date' => date('Y-m-d', strtotime($this->input->post('as_of_date'))),
            'initial_cost' => $this->input->post('initial_cost'),
            'inv_adj_account' => $this->input->post('inv_adj_acc'),
            'memo' => $this->input->post('memo'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $itemData = [
            'initial_cost' => $startValueAdjData['initial_cost']
        ];

        $accDetails = [
            'as_of_date' => $startValueAdjData['as_of_date']
        ];

        $locationId = $startValueAdjData['location_id'];
        $locationAdjustments = $this->items_model->getItemQuantityAdjustments($item_id, $locationId);
        $locationDetails = [
            'initial_qty' => $startValueAdjData['initial_qty']
        ];
        $quantity = intval($startValueAdjData['initial_qty']);
        if (!empty($locationAdjustments)) {
            foreach ($locationAdjustments as $adj) {
                $quantity = $quantity + intval($adj->change_in_quantity);
            }
        }
        $locationDetails['qty'] = $quantity;

        // Update item initial cost in items
        $updateItem = $this->items_model->update($itemData, ['id' => $item_id, 'company_id' => logged('company_id')]);

        // Update item as of date in item_accounting_details table
        $updateAccDetails = $this->items_model->updateItemAccountingDetails($accDetails, $item_id);

        // Update initial quantity and quantity of item in items_has_storage_loc table
        $condition = ['id' => $locationId, 'item_id' => $item_id, 'company_id' => logged('company_id')];
        $updateLocation = $this->items_model->updateLocationDetails($locationDetails, $condition);

        // Insert starting value adjustment record
        $insert = $this->starting_value_model->create($startValueAdjData);

        if ($insert > 0) {
            $this->session->set_flashdata('success', "Item $item->title starting value successfully adjusted.");
        } else {
            $this->session->set_flashdata('error', "Please try again!");
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function audit_log()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Sales";
        $this->load->view('accounting/audit_log', $this->page_data);
    }
    public function payrolloverview()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/payroll_overview', $this->page_data);
    }
    // public function employees()
    // {
    //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));
    //     $this->page_data['page_title'] = "Sales Overview";
    //     $this->page_data['employees'] = $this->users_model->getAll();
    //     $this->load->view('accounting/employees', $this->page_data);
    // }
    // public function contractors()
    // {
    //     $this->page_data['users'] = $this->users_model->getUser(logged('id'));
    //     $this->page_data['page_title'] = "Sales Overview";
    //     $this->load->view('accounting/contractors', $this->page_data);
    // }
    public function workerscomp()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Sales Overview";
        $this->load->view('accounting/workers_comp', $this->page_data);
    }
    public function reports()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Reports";
        $this->load->view('accounting/reports', $this->page_data);
    }

    /* payscale */

    public function employeeinfo()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/employeeinfoReport', $this->page_data);
    }


    /*** Vendors ***/
    // public function addVendor()
    // {
    //     $id = logged('id');
    //     $filePath = "./uploads/accounting/vendors/".$id;
    //     $file_name = "";

    //     if (!file_exists($filePath)) {
    //         mkdir($filePath);
    //     }

    // 	$config['upload_path']  =  $filePath;
    //  $config['allowed_types']   = 'gif|jpg|png|jpeg|doc|docx|pdf|xlx|xls|csv';
    //  $config['max_size']        = '20000';
    // 	$config['upload_path']  =  $filePath;
    //     $config['allowed_types']   = 'gif|jpg|png|jpeg|doc|docx|pdf|xlx|xls|csv';
    //     $config['max_size']        = '20000';

    //     $this->load->library('upload', $config);

    //     if ($this->upload->do_upload('attachFiles'))
    //     {
    //         $image = $this->upload->data();
    //         $file_name = $image['file_name'];
    //     }

    //     $config = $this->uploadlib->initialize($config);
    //     $this->load->library('upload',$config);

    //     $new_data = array(
    //         'title' => $this->input->post('title'),
    //         'f_name' => $this->input->post('f_name'),
    //         'm_name' => $this->input->post('m_name'),
    //         'l_name' => $this->input->post('l_name'),
    //         'suffix' => $this->input->post('suffix'),
    //         'email' => $this->input->post('email'),
    //         'company' => $this->input->post('company'),
    //         'display_name' => $this->input->post('display_name'),
    //         'to_display' => $this->input->post('to_display'),
    //         'street' => $this->input->post('street'),
    //         'city' => $this->input->post('city'),
    //         'state' => $this->input->post('state'),
    //         'zip' => $this->input->post('zip'),
    //         'country' => $this->input->post('country'),
    //         'phone' => $this->input->post('phone'),
    //         'mobile' => $this->input->post('mobile'),
    //         'fax' => $this->input->post('fax'),
    //         'website' => $this->input->post('website'),
    //         'billing_rate' => $this->input->post('billing_rate'),
    //         'terms' => $this->input->post('terms'),
    //         'opening_balance' => $this->input->post('opening_balance'),
    //         'opening_balance_as_of_date' => $this->input->post('opening_balance_as_of_date'),
    //         'account_number' => $this->input->post('account_number'),
    //         'tax_id' => $this->input->post('business_number'),
    //         'default_expense_account' => $this->input->post('default_expense_amount'),
    //         'notes' => $this->input->post('notes'),
    //         'attachments' => $file_name,
    //         'status' => 1,
    //         'created_by' => logged('id'),
    //         'date_created' => date("Y-m-d H:i:s"),
    //         'date_modified' => date("Y-m-d H:i:s")
    //     );

    //     $addQuery = $this->vendors_model->createVendor($new_data);

    //     if($addQuery > 0){

    //         $new_id = $addQuery;
    //         $comp = mb_substr($this->input->post('company'), 0, 3);
    //         $vendor_id = strtolower($comp) . $new_id;

    //         $updateQuery = $this->vendors_model->updateVendor($new_id, array("vendor_id" => $vendor_id));

    //         if($updateQuery){
    //             echo json_encode($updateQuery);
    //         }
    //     }
    //     else{
    //         echo json_encode(0);
    //     }
    // }

    public function deleteVendor()
    {
        $id = $this->input->post('id');
        $this->vendors_model->delete($id);
    }

    public function allVendors()
    {
        echo json_encode($this->vendors_model->getVendors());
    }
    public function vendordetails($id)
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Vendor Details";

        $this->page_data['vendor_details'] = $this->vendors_model->getVendorDetails($id);
        $this->page_data['transaction_details'] = $this->vendors_model->getvendortransactions($id);
        $this->load->view('accounting/vendor_details', $this->page_data);
    }
    public function getvendortransactions($id = null)
    {
        $id = 1;
        $query = $this->vendors_model->getvendortransactions($id);
        print_r($query);
    }
    public function invalidVendor()
    {
        $id =  $this->input->post('id');
        $new_data = array(
            'status' => 0,
            'date_modified' => date("Y-m-d H:i:s")
        );

        $editQuery = $this->vendors_model->update($id, $new_data);

        if ($editQuery > 0) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function editVendor()
    {
        $id =  $this->input->post('id');
        $new_data = array(
            'title' => $this->input->post('title'),
            'f_name' => $this->input->post('f_name'),
            'm_name' => $this->input->post('m_name'),
            'l_name' => $this->input->post('l_name'),
            'suffix' => $this->input->post('suffix'),
            'email' => $this->input->post('email'),
            'company' => $this->input->post('company'),
            'display_name' => $this->input->post('display_name'),
            'to_display' => $this->input->post('to_display'),
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
            'opening_balance_as_of_date' => $this->input->post('opening_balance_as_of_date'),
            'account_number' => $this->input->post('account_number'),
            'tax_id' => $this->input->post('business_number'),
            'default_expense_account' => $this->input->post('default_expense_amount'),
            'notes' => $this->input->post('notes'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $editQuery = $this->vendors_model->updateVendorWithVendorID($id, $new_data);

        if ($editQuery) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function createBill()
    {
        $id = logged('id');
        $filePath = "uploads/accounting/vendors/bill/".$id;
        $file_name = "";

        if (!file_exists($filePath)) {
            mkdir($filePath);
        }

        $config['upload_path']  =  $filePath;
        $config['allowed_types']   = 'gif|jpg|png|jpeg|doc|docx|pdf|xlx|xls|csv';
        $config['max_size']        = '20000';
        $config['encrypt_name']    = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attachFiles')) {
            $image = $this->upload->data();
            $file_name = $image['file_name'];
        }

        $config = $this->uploadlib->initialize($config);
        $this->load->library('upload', $config);

        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'memo' => $this->input->post('memo'),
            'attachments' => $file_name,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->expense_model->create($new_data);

        if ($addQuery > 0) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function getVendorData($id)
    {
        $data = $this->vendors_model->getVendorDetails($id);
        echo json_encode($data);
    }

    public function addTerms()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Add Vendor";

        $new_data = array(
            'term_name' => $this->input->post('term_name'),
            'status' => 1,
            'created_by' => $this->input->post('created_by'),
            'date_created' => $this->input->post('date_created'),
            'date_modified' => $this->input->post('date_modified')
        );

        $addQuery = $this->terms_model->create($new_data);

        if ($addQuery > 0) {
            $new_id = $addQuery;
            $term_id = mb_substr($this->input->post('term_name'), 0, 3) . $new_id;
            $updateQuery = $this->terms_model->update($new_id, array("term_id" =>$term_id));

            if ($updateQuery > 0) {
                echo json_encode($updateQuery);
            }
        } else {
            echo json_encode(0);
        }
    }
    /*** Expenses ***/

    public function timeActivity()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'date' => $this->input->post('date'),
            'name' => $this->input->post('name'),
            'customer' => $this->input->post('customer'),
            'service' => $this->input->post('service'),
            'billable' => $this->input->post('billable'),
            'taxable' => $this->input->post('taxable'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'break' => $this->input->post('breakTime'),
            'time' => $this->input->post('time'),
            'description' => $this->input->post('description')
        );
        $query = $this->expenses_model->timeActivity($new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addBill()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        $transaction = array(
            'type' => 'Bill',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);


        $new_data = array(
            'transaction_id' => $fquery,
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'total_amount' => $this->input->post('total_amount'),
            'attachments' => 'testing 2',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );


        $query = $this->expenses_model->addBill($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '1';
                $data['ven_type_id'] = $query;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category'] = $aa[$f];
                $data2['description'] = $bb[$f];
                $data2['amount'] = $cc[$f];
                $data2['type'] = 'Bill';
                $data2['type_id'] = $query;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function addBillpay()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        // $product['id'] = "1";
        // $product['prod'] = $this->input->post('prod');
        // $product['desc'] = $this->input->post('desc');
        // $product['qty'] = $this->input->post('qty');
        // $product['rate'] = $this->input->post('rate');
        // $product['amount'] = $this->input->post('amount');
        // $product['tax'] = $this->input->post('tax');
        // $prod[] = $product;


        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'bal_due' => $this->input->post('bal_due'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname'),

            'attachments' => 'testing 2',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );


        $query = $this->expenses_model->addBill($new_data);

        $new_data2[] = array(
           'category' => 'testing 2',
           'description' => 1,
           'amount' => $user_id,
       );

        foreach ($new_data2 as $datas=>$data) {
            $category = $data['username'];
            $description = $data['description'];
            $amount = $data['amount'];
            $status = '1';
            $bill_id = $query;
            $date_created = date("Y-m-d H:i:s");
            $date_modified = date("Y-m-d H:i:s");

            $query = $this->expenses_model->addBillcategory($new_data);
        }


        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function getBillData()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $bills = $this->db->get_where('accounting_bill', array('id'=> $id));
        $vendors = $this->db->get_where('accounting_vendors', array('vendor_id' => $bills->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id'=>$id,'transaction_id' => $transaction_id));

        $data = new stdClass();
        $data->vendor_id = $vendors->row()->vendor_id;
        $data->bill_id = $bills->row()->id;
        $data->vendor_name = $vendors->row()->f_name.'&nbsp;'.$vendors->row()->l_name;
        $data->address = $bills->row()->mailing_address;
        $data->terms = $bills->row()->terms;
        $data->bill_date = $bills->row()->bill_date;
        $data->due_date = $bills->row()->due_date;
        $data->bill_number = $bills->row()->bill_number;
        $data->permit_number = $bills->row()->permit_number;
        $data->memo = $bills->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0)?true:false;
        echo json_encode($data);
    }

    public function editBillData()
    {
        $new_data = array(
            'bill_id' => $this->input->post('id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'terms' => $this->input->post('terms'),
            'bill_date' => $this->input->post('bill_date'),
            'due_date' => $this->input->post('due_date'),
            'bill_number' => $this->input->post('bill_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->editBillData($data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteBillData()
    {
        $id = $this->input->post('id');
        $query = $this->expenses_model->deleteBillData($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    /*** Attachment for Expense Transaction***/
    public function expensesTransactionAttachment()
    {
        if (! empty($_FILES)) {
            $config = array(
                'upload_path' => './uploads/accounting/expenses/',
                'allowed_types' => '*',
                'overwrite' => true,
                'max_size' => '20000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")) {
                $uploadData = $this->upload->data();
                $data = array('attachment'=> $uploadData['file_name']);
                $this->db->insert('accounting_expense_attachment', $data);
                echo json_encode($uploadData['file_name']);
            }
        }
    }

    public function removeTransactionAttachment()
    {
        $file = $this->input->post('name');
        $index = $this->input->post('index');
        if ($file && file_exists($this->expenses_path. $file[$index])) {
            unlink($this->expenses_path. $file[$index]);
            $this->db->where('attachment', $file[$index]);
            $this->db->delete('accounting_expense_attachment');
        }
    }

    public function displayListAttachment()
    {
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $attachments = $this->expenses_model->getAttachment();
        $display = '';
        foreach ($attachments as $attachment) {
            $tooltip = ($attachment->status == 0)?"tooltip":"";
            $cross_out = ($attachment->status == 0)?"cross-out":"";
            $exclamation = ($attachment->status == 0)?"fa-times fa-exclamation-triangle":"fa-times";
            $tipbox = ($attachment->status == 0)?"tooltiptext":"tooltiptext hide";
            $file = $attachment->attachment;
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            switch ($extension) {
                case "txt":
                    $file = "default-txt.png";
                    break;
                case "pdf":
                    $file = "default-pdf.png";
                    break;
                case "xls":
                    $file = "default-excel.png";
                    break;
                case "xlsb":
                    $file = "default-excel.png";
                    break;
                case "xlsm":
                    $file = "default-excel.png";
                    break;
                case "xlsx":
                    $file = "default-excel.png";
                    break;
                case "docx":
                    $file = "default-word.png";
                    break;
                case "doc":
                    $file = "default-word.png";
                    break;
                default:
                    $file = $attachment->attachment;
                    break;
            }
            if ($attachment->expenses_id == $id && $attachment->type == $type) {
                $display .= '<div class="file-name-section">';
                $display .= '<span class="previewAttachment '.$cross_out.'">'.$attachment->original_filename.'</span>';
                $display .= '<span class="previewAttachmentImage"><img src="/uploads/accounting/expenses/'.$file.'">.'.$extension.'</span>';
                $display .= '<a href="#" class="'.$tooltip.'" id="removeAttachment" data-id="'.$attachment->id.'" data-status="'.$attachment->status.'"><i class="fa '.$exclamation.'"></i></a>';
                $display .= '<span class="'.$tipbox.'">This file is temporarily removed.</br> You can retrieve it by clicking the </br>exclamation icon "<i class="fa fa-exclamation-triangle"></i>". </span>';
                $display .= '<input type="hidden" name="attachment_id" id="attachmentId" value="'.$attachment->id.'">';
                $display .= '</div>';
            }
        }
        echo json_encode($display);
    }

    public function removeTemporaryAttachment()
    {
        $id = $this->input->post('attach_id');
        $status = $this->input->post('status');

        $query = $this->db->get_where('accounting_expense_attachment', array('id'=>$id));
        if ($query->num_rows() == 1 && $status == 1) {
            $status = array(
                'status' => 0
            );
            $this->db->where('id', $id);
            $this->db->update('accounting_expense_attachment', $status);
            echo json_encode(0);
        } elseif ($query->num_rows() == 1 && $status == 0) {
            $status = array(
                'status' => 1
            );
            $this->db->where('id', $id);
            $this->db->update('accounting_expense_attachment', $status);
            echo json_encode(1);
        }
    }
    public function removePermanentlyAttachment()
    {
        $attachment_id = $this->input->post('attachment_id');
        for ($x = 0; $x < count($attachment_id);$x++) {
            $get_filename = $this->db->get_where('accounting_expense_attachment', array('id'=>$attachment_id[$x]));
            unlink($this->expenses_path. $get_filename->row()->attachment);
            $this->db->where('id', $attachment_id[$x]);
            $this->db->delete('accounting_expense_attachment');
        }
    }

    public function addingFileAttachment()
    {
        $transaction_id = $this->input->post('transaction_id');
        $transaction_from_id = $this->input->post('trans_from_id');
        $file_id = $this->input->post('file_id');
        $id = $this->input->post('expenses_id');
        $type = $this->input->post('type');
        $get_attachment_id = $this->db->get_where('accounting_expense_attachment', array('id'=>$file_id));
        $file_name = $get_attachment_id->row()->attachment;
        $original_fname = $this->input->post('original_fname');
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $encryption = md5(time()).'.'.$extension;
        copy('./uploads/accounting/expenses/'.$file_name, './uploads/accounting/expenses/'.$encryption);
        $data = array(
            'transaction_id' => $transaction_id,
            'expenses_id' => $id,
            'type' => $type,
            'original_filename' => $original_fname,
            'attachment' => $encryption,
            'date_created' => date('Y-m-d H:i:s'),
            'status' => 1
        );
        $this->db->insert('accounting_expense_attachment', $data);
        $new_attachment_id = $this->db->insert_id();

        $added = array(
            'attachment_id' => $new_attachment_id,
            'attachment_from_id' => $get_attachment_id->row()->id,
            'trans_from_id' => $transaction_from_id,
            'expenses_type' => $type,
            'expenses_id' => $id,
            'date_created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('accounting_existing_attachment', $added);
        echo json_encode($id);
    }

    public function deleteTemporaryAttachment()
    {
        $attachments = $this->expenses_model->getAttachment();
        $result = null;
        foreach ($attachments as $attachment) {
            if ($attachment->transaction_id == 0) {
                unlink($this->expenses_path.$attachment->attachment);
            }
        }
        $this->db->where('transaction_id', 0);
        $this->db->delete('accounting_expense_attachment');
        echo json_encode($result);
    }

    public function showExistingFile()
    {
        $expense_id = $this->input->get('expenses_id');
        $type = $this->input->get('type');
        $transaction_id = $this->input->get('transaction_id');
        $attachments = $this->expenses_model->getAttachmentById($transaction_id);
        $disabled = null;
        $display = '';
        foreach ($attachments as $attachment) {
            $added = $this->expenses_model->getAddedAttachment($attachment->id, $expense_id, $type);
            if ($added == true) {
                $status = 'Added';
                $disabled = 'isDisabled';
            } else {
                $status = 'Add';
                $disabled = null;
            }


            $preview = "";
            if ($type == 'Check') {
                $preview = "-check";
            } elseif ($type == 'Bill') {
                $preview = "-bill";
            } elseif ($type == 'Expense') {
                $preview = "-expense";
            } elseif ($type == 'Vendor Credit') {
                $preview = "-vc";
            }
            $file = $attachment->attachment;
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            switch ($extension) {
                    case "txt":
                        $file = "default-txt.png";
                        break;
                    case "pdf":
                        $file = "default-pdf.png";
                        break;
                    case "xls":
                        $file = "default-excel.png";
                        break;
                    case "xlsb":
                        $file = "default-excel.png";
                        break;
                    case "xlsm":
                        $file = "default-excel.png";
                        break;
                    case "xlsx":
                        $file = "default-excel.png";
                        break;
                    case "docx":
                        $file = "default-word.png";
                        break;
                    case "doc":
                        $file = "default-word.png";
                        break;
                    default:
                        $file = $attachment->attachment;
                        break;
                }
            $display .= '<div class="modal-existing-file-section">';
            $display .= '<span>'.$attachment->original_filename.'</span>';
            $display .= '<img src="/uploads/accounting/expenses/'.$file.'" alt="Existing File" style="width: 250px;height: 150px;margin-bottom: 10px">';
            $display .= '<input type="hidden" id="attachmentType" value="'.$type.'">';
            $display .= '<input type="hidden" id="attachmentTypePreview" value="'.$preview.'">';
            $display .= '<input type="hidden" id="attachmentTransId" value="'.$transaction_id.'">';
            $display .= '<input type="hidden" id="attachTransFromId" value="'.$attachment->transaction_id.'">';
            $display .= '<input type="hidden" id="attachmentExpensesId" value="'.$expense_id.'">';
            $display .= '<a href="#" class="'.$disabled.'" id="addingFileAttachment" data-id="'.$attachment->id.'" data-fname="'.$attachment->original_filename.'" >'.$status.'</a>';
            $display .= '</div>';
            $display .= '<hr>';
        }

        echo json_encode($display);
    }

    public function rowCategories()
    {
        $transaction_id = $this->input->get('transaction_id');
        $row = $this->input->get('row');
        $cat_class = $this->input->get('cat_class');
        $des_class = $this->input->get('des_class');
        $amount_class = $this->input->get('amount_class');
        $counter = $this->input->get('counter');
        $remove = $this->input->get('remove_id');
        $select = $this->input->get('select');
        $preview = $this->input->get('preview');
        $get_categories = $this->db->get_where('accounting_expense_category', array('transaction_id' => $transaction_id));
        $result = $get_categories->result();
        $categories = '';
        $category_list = $this->categories_model->getCategories();
        if ($get_categories->num_rows() >= 2) {
            foreach ($result as $cnt => $data) {
                $category = ($data->category_id != null)?$data->category_id:"";
                $description = ($data->description != null)?$data->description:"";
                $amount = ($data->amount!=null)?$data->amount:0;
                $cnt += 1;
                $categories .= '<tr id="'.$row.'">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="'.$data->id.'">';
                        $categories .= '<span id="category-preview'.$preview.'">'.$list->category_name.'</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<option value="'.$list->id.'" selected>'.$list->category_name.'</option>';
                    }
                }
//                foreach ($category_list as $list){
//                    if($list->id != $category){
//                        $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//                    }
//                }
                $categories .= '</select>';
                $categories .= ' </div>';
                $categories .= '</td>';
                $categories .= '<td><span id="description-preview'.$preview.'">'.$description.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value="'.$description.'"  ></div>';
                $categories .= '</td>';
                $categories .= '<td><span id="amount-preview'.$preview.'">'.$amount.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="'.$amount.'" ></div>';
                $categories .= '</td>';
                $categories .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
                $categories .= '</tr>';
            }
        } else {
            foreach ($result as $cnt => $data) {
                $category = ($data->category_id != null)?$data->category_id:"";
                $description = ($data->description != null)?$data->description:"";
                $amount = ($data->amount!=null)?$data->amount:0;
                $cnt += 1;
                $categories .= '<tr id="'.$row.'">';
                $categories .= '<td></td>';
                $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
                $categories .= '<td>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<input type="hidden" name="categories_id[]" class="categories_id" value="'.$data->id.'">';
                        $categories .= '<span id="category-preview'.$preview.'">'.$list->category_name.'</span>';
                    }
                }
                $categories .= '<div id="" style="display:none;">';
                $categories .= '<input type="hidden" id="prevent_process" value="true">';
                $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
                $categories .= '<option></option>';
                $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
                foreach ($category_list as $list) {
                    if ($list->id == $category) {
                        $categories .= '<option value="'.$list->id.'" selected>'.$list->category_name.'</option>';
                    }
                }
//                foreach ($category_list as $list){
//                    if($list->id != $category){
//                        $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//                    }
//                }
                $categories .= '</select>';
                $categories .= ' </div>';
                $categories .= '</td>';
                $categories .= '<td><span id="description-preview'.$preview.'">'.$description.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value="'.$description.'"  ></div>';
                $categories .= '</td>';
                $categories .= '<td><span id="amount-preview'.$preview.'">'.$amount.'</span>';
                $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="'.$amount.'" ></div>';
                $categories .= '</td>';
                $categories .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
                $categories .= '</tr>';
            }
            $description = "";
            $amount = 0;
            $cnt = 2;
            $categories .= '<tr id="'.$row.'">';
            $categories .= '<td></td>';
            $categories .= '<td><span id="'.$counter.'">'. $cnt .'</span></td>';
            $categories .= '<td>';
            $categories .= '<div id="" style="display:none;">';
            $categories .= '<input type="hidden" id="prevent_process" value="true">';
            $categories .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
            $categories .= '<option></option>';
//            $categories .= '<option value="0" id="add-expense-categories" disabled>&plus; Add Category</option>';
//            foreach ($category_list as $list){
//                $categories .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//            }
            $categories .= '</select>';
            $categories .= ' </div>';
            $categories .= '</td>';
            $categories .= '<td><span id="description-preview'.$preview.'">'.$description.'</span>';
            $categories .= '<div style="display: none"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value="'.$description.'"  ></div>';
            $categories .= '</td>';
            $categories .= '<td><span id="amount-preview'.$preview.'"></span>';
            $categories .= '<div style="display: none"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="'.$amount.'" ></div>';
            $categories .= '</td>';
            $categories .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
            $categories .= '</tr>';
        }

        echo json_encode($categories);
    }

    public function defaultCategoryRow()
    {
        $row = $this->input->get('row');
        $cat_class = $this->input->get('cat_class');
        $des_class = $this->input->get('des_class');
        $amount_class = $this->input->get('amount_class');
        $counter = $this->input->get('counter');
        $remove = $this->input->get('remove_id');
        $select = $this->input->get('select');
        $preview = $this->input->get('preview');
        $category_list = $this->categories_model->getCategories();
        $default = '';
        for ($x = 1;$x <= 2;$x++) {
            $default .= '<tr id="'.$row.'">';
            $default .= '<td></td>';
            $default .= '<td><span id="'.$counter.'">'.$x.'</span></td>';
            $default .= '<td>';
            $default .= '<span id="category-preview'.$preview.'"></span>';
            $default .= '<div id="" style="display:none;">';
            $default .= '<input type="hidden" id="prevent_process" value="true">';
            $default .= '<select name="category[]" id="category-id'.$preview.'" class="form-control '.$cat_class.' '.$select.'">';
            $default .= '<option></option>';
//            $default .= '<option value="0" disabled id="add-expense-categories">&plus; Add Category</option>';
//            foreach ($category_list as $list){
//                $default .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
//            }
            $default .= '</select>';
            $default .= '</div>';
            $default .= '</td>';
            $default .= '<td><span id="description-preview'.$preview.'"></span>';
            $default .= '<div style="display: none;"><input type="text" name="description[]" id="description-id'.$preview.'" class="form-control '.$des_class.'" value=""></div>';
            $default .= '</td>';
            $default .= '<td><span id="amount-preview'.$preview.'"></span>';
            $default .= '<div style="display: none;"><input type="text" name="amount[]" id="amount-id'.$preview.'" class="form-control '.$amount_class.'" value="0" ></div>';
            $default .= '</td>';
            $default .= '<td style="text-align: center"><a href="#" id="'.$remove.'"><i class="fa fa-trash"></i></a></td>';
            $default .= '</tr>';
        }
        echo json_encode($default);
    }

    public function getCheckData()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $query = $this->db->get_where('accounting_check', array(
            'id' => $id
        ));
        $vendors_detail = $this->db->get_where('accounting_vendors', array('vendor_id'=>$query->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id'=>$id,'transaction_id'=>$transaction_id));
        if ($query->row()->print_later == 1) {
            $print = true;
        } else {
            $print = false;
        }
        $std = new stdClass();
        $std->check_id = $id;
        $std->vendor_id = $query->row()->vendor_id;
        $std->vendor_name = $vendors_detail->row()->f_name.'&nbsp;'.$vendors_detail->row()->l_name;
        $std->bank_account = $query->row()->bank_id;
        $std->mailing = $query->row()->mailing_address;
        $std->payment_date = $query->row()->payment_date;
        $std->check_number = $query->row()->check_number;
        $std->print_later = $print;
        $std->permit_number = $query->row()->permit_number;
        $std->memo = $query->row()->memo;
        $std->check_category = ($check_category->num_rows() > 0)?true:false;

        echo json_encode($std);
    }
    // public function addCheck(){
    //     $new_data = array(
    //         'vendor_id' => $this->input->post('vendor_id'),
    //         'mailing_address' => $this->input->post('mailing_address'),
    //         'bank_id' => $this->input->post('bank_account'),
    //         'payment_date' => $this->input->post('payment_date'),
    //         'check_num' => $this->input->post('check_number'),
    //         'print_later' => $this->input->post('print_later'),
    //         'permit_number' => $this->input->post('permit_number'),
    //         'memo' => $this->input->post('memo'),
    //         'category' => $this->input->post('category'),
    //         'description' => $this->input->post('description'),
    //         'amount' => $this->input->post('amount'),
    //      'total' => $this->input->post('total'),
    // 		'total' => $this->input->post('total'),
    //         'file_name' => $this->input->post('filename'),
    //         'original_fname' => $this->input->post('original_fname')
    //     );
    //     $query = $this->expenses_model->addCheck($new_data);
    //     if ($query == true){
    //         echo json_encode(1);
    //     }else{
    //         echo json_encode(0);
    //     }
    // }

    public function editCheckData()
    {
        $update = array(
            'check_id' => $this->input->post('check_id'),
            'transaction_id' => $this->input->post('transaction_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'bank_id' => $this->input->post('bank_account'),
            'payment_date' => $this->input->post('payment_date'),
            'check_num' => $this->input->post('check_number'),
            'print_later' => $this->input->post('print_later'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category_id' => $this->input->post('category_id'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->editCheckData($update);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function deleteCheckData()
    {
        $id = $this->input->post('id');
        $this->expenses_model->deleteCheckData($id);
    }

    // public function addExpense(){
    //     $new_data = array(
    //         'vendor_id' => $this->input->post('vendor_id'),
    //         'payment_account' => $this->input->post('payment_account'),
    //         'payment_date' => $this->input->post('payment_date'),
    //         'payment_method' => $this->input->post('payment_method'),
    //         'ref_number' => $this->input->post('ref_number'),
    //         'permit_number' => $this->input->post('permit_number'),
    //         'memo' => $this->input->post('memo'),
    //         'category' => $this->input->post('category'),
    //         'description' => $this->input->post('description'),
    //         'amount' => $this->input->post('amount'),
    //         'total' => $this->input->post('total'),
    //         'file_name' => $this->input->post('filename'),
    //         'original_fname' => $this->input->post('original_fname')
    //     );
    //     $query = $this->expenses_model->addExpense($new_data);
    //     if ($query == true){
    //         echo json_encode(1);
    //     }else{
    //         echo json_encode(0);
    //     }
    // }
    public function getExpenseData()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_expense = $this->db->get_where('accounting_expense', array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors', array('vendor_id'=> $get_expense->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id'=>$id,'transaction_id' => $transaction_id));


        $data = new stdClass();
        $data->vendor_id = $get_expense->row()->vendor_id;
        $data->vendor_name = $vendors->row()->f_name.'&nbsp;'.$vendors->row()->l_name;
        $data->expense_id = $id;
        $data->payment_account = $get_expense->row()->payment_account;
        $data->payment_date = $get_expense->row()->payment_date;
        $data->payment_method = $get_expense->row()->payment_method;
        $data->ref_number = $get_expense->row()->ref_number;
        $data->permit_number = $get_expense->row()->permit_number;
        $data->memo = $get_expense->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0)?true:false;

        echo json_encode($data);
    }

    public function updateExpenseData()
    {
        $update = array(
            'transaction_id' => $this->input->post('transaction_id'),
            'expense_id' => $this->input->post('expense_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'payment_account' => $this->input->post('payment_account'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category_id' => $this->input->post('category_id'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->updateExpenseData($update);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteExpenseData()
    {
        $id = $this->input->post('id');
        $this->expenses_model->deleteExpenseData($id);
    }

    public function vendorCredit()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_number' => $this->input->post('ref_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->vendorCredit($new_data);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function getVendorCredit()
    {
        $id = $this->input->get('id');
        $transaction_id = $this->input->get('transaction_id');
        $get_vc = $this->db->get_where('accounting_vendor_credit', array('id'=>$id));
        $vendors = $this->db->get_where('accounting_vendors', array('vendor_id'=> $get_vc->row()->vendor_id));
        $check_category = $this->db->get_where('accounting_expense_category', array('expenses_id'=>$id,'transaction_id'=>$transaction_id));

        $data = new stdClass();
        $data->vc_id = $id;
        $data->vendor_id = $get_vc->row()->vendor_id;
        $data->vendor_name = $vendors->row()->display_name;
        $data->mailing_address = $get_vc->row()->mailing_address;
        $data->payment_date = $get_vc->row()->payment_date;
        $data->ref_number = $get_vc->row()->ref_number;
        $data->permit_number = $get_vc->row()->permit_number;
        $data->memo = $get_vc->row()->memo;
        $data->check_category = ($check_category->num_rows() > 0)?true:false;

        echo json_encode($data);
    }
    public function updateVendorCredit()
    {
        $update = array(
            'vc_id' => $this->input->post('vc_id'),
            'transaction_id' => $this->input->post('transaction_id'),
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_number' => $this->input->post('ref_number'),
            'permit_number' => $this->input->post('permit_number'),
            'memo' => $this->input->post('memo'),
            'category_id' => $this->input->post('category_id'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'amount' => $this->input->post('amount'),
            'total' => $this->input->post('total'),
            'file_name' => $this->input->post('filename'),
            'original_fname' => $this->input->post('original_fname')
        );
        $query = $this->expenses_model->updateVendorCredit($update);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteVendorCredit()
    {
        $id = $this->input->post('id');
        $this->expenses_model->deleteVendorCredit($id);
    }

    public function showExpenseTransactionsTable()
    {
        $vendors = $this->vendors_model->getVendors();
        $checks = $this->expenses_model->getCheck();
        $transactions = $this->expenses_model->getTransaction();
        $bills = $this->expenses_model->getBill();
        $vendor_credits = $this->expenses_model->getVendorCredit();
        $expenses = $this->expenses_model->getExpense();
        $list_categories = $this->categories_model->getCategories();
        $date = null;
        $type = null;
        $number = null;
        $vendors_name = null;
        $category = null;
        $description = null;
        $total = null;
        $category_id = null;
        $modal = null;
        $modal_id = null;
        $data_id = null;
        $delete = null;
        $category_list_id = null;
        $transaction_id = null;
        $show = '';
        foreach ($transactions as $transaction):
            if ($transaction->type == 'Check') {
                // Check
                foreach ($checks as $check) {
                    if ($transaction->id == $check->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = $check->check_number;
                        $modal_id = "editCheck";
                        $data_id = $check->id;
                        $transaction_id = $check->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $check->vendor_id) {
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $delete = 'deleteCheck';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $check->transaction_id));
                        $check_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $check_category_id) {
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            } elseif ($transaction->type == 'Bill') {
//                                            Bill
                foreach ($bills as $bill) {
                    if ($transaction->id == $bill->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editBill";
                        $transaction_id = $bill->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $bill->vendor_id) {
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $bill->id;
                                $delete = 'deleteBill';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $bill->transaction_id));
                        $bill_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $bill_category_id) {
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            } elseif ($transaction->type == 'Expense') {
//                                            Expense
                foreach ($expenses as $expense) {
                    if ($transaction->id == $expense->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $number = null;
                        $modal_id = "editExpense";
                        $transaction_id = $expense->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $expense->vendor_id) {
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $expense->id;
                                $delete = 'deleteExpense';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $expense->transaction_id));
                        $expense_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $expense_category_id) {
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            } elseif ($transaction->type == 'Vendor Credit') {
//                                            Vendor Credit
                foreach ($vendor_credits as $vendor_credit) {
                    if ($transaction->id == $vendor_credit->transaction_id) {
                        $date = date("m/d/y", strtotime($transaction->date_created));
                        $type = $transaction->type;
                        $payee = $vendor_credit->vendor_id;
                        $number = null;
                        $modal_id = "editVendorCredit";
                        $transaction_id = $vendor_credit->transaction_id;
                        foreach ($vendors as $vendor) {
                            if ($vendor->vendor_id == $vendor_credit->vendor_id) {
                                $vendors_name = $vendor->f_name." ".$vendor->l_name;
                                $data_id = $vendor_credit->id;
                                $delete = 'deleteVendorCredit';
                            }
                        }
                        $get_category = $this->db->get_where('accounting_expense_category', array('transaction_id' => $vendor_credit->transaction_id));
                        $vc_category_id = ($get_category->num_rows() != 0)?$get_category->row()->category_id:0;
                        foreach ($list_categories as $list) {
                            if ($list->id == $vc_category_id) {
                                $category_list_id = $list->id;
                                $category = $list->category_name;
                                $category_id = $get_category->row()->id;
                            }
                        }
                    }
                }
            }
        $show .= '<tr style="cursor: pointer;">';
        $show .= '<td><input type="checkbox"></td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$date.'</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$type.'</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$number.'</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$vendors_name.'</td>';
        $show .= '<td data-id="'.$data_id.'" data-transId="'.$transaction_id.'">';
        $show .= '<div style="display: inline-block;position: relative;width: 100%">';
        $show .= '<select name="category" id="expenseTransCategory" data-category="" data-id="'.$category_id.'" class="form-control select2-tbl-category">';
        $show .= '<option value="'.$category_list_id.'" selected>'.$category.'</option>';
        foreach ($list_categories as $list):
                if ($list->category_name == $category):
                    $show .= '<option value="'.$list->id.'">'.$list->category_name.'</option>';
        endif;
        endforeach;
        $show .= '</select>';
        $show .= '</div>';
        $show .= '<i class="fa fa-spinner fa-pulse" style="display: none;position: relative;"></i>';
        $show .= '</td>';
        $show .= '<td id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">'.$transaction->total.'</td>';
        $show .= '<td style="text-align: right;">';
        $show .= '<a href="#" id="'.$modal_id.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'" style="margin-right: 10px;color: #0077c5;font-weight: 600;">View/Edit</a>';
        $show .= '<div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">';
        $show .= '<span class="fa fa-caret-down" data-toggle="dropdown"></span>';
        $show .= '<ul class="dropdown-menu dropdown-menu-right">';
        $show .= '<li><a href="#" id="copy">Copy</a></li>';
        $show .= '<li id="'.$delete.'" data-id="'.$data_id.'" data-transId="'.$transaction_id.'">';
        $show .= '<a href="#" >Delete</a>';
        $show .= '</li>';
        $show .= '<li><a href="#">Void</a></li>';
        $show .= '</ul>';
        $show .= '</div>';
        $show .= '</td>';
        $show .= '</tr>';

        $date = null;
        $type = null;
        $number = null;
        $vendors_name = null;
        $category = null;
        $description = null;
        $total = null;
        $category_id = null;
        $modal = null;
        $modal_id = null;
        $data_id = null;
        $delete = null;
        $category_list_id = null;
        $transaction_id = null;
        endforeach;
        echo json_encode($show);
    }

    /***Get Update Add category ***/
    public function getExpensesCategories()
    {
        $transaction_id = $this->input->get('transaction_id');
        $search = $this->input->get('search');
        $categories_by_id = $this->categories_model->getCategoriesByTransactionId($transaction_id);
        $query = $this->categories_model->getCategories();
        $get_by_search = $this->categories_model->getCategoriesBySearch($search);
        $data = array();
        $data[] = array(
            'id' => 0,
            'text' => '+ Add category',
            'disabled' => true
        );
        if ($categories_by_id != null) {
            foreach ($query as $categories) {
                foreach ($categories_by_id as $category_by_id) {
                    if ($categories->id == $category_by_id->category_id) {
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type,
                            'selected' => true
                        );
                    }
                }
            }
            foreach ($query as $categories) {
                foreach ($categories_by_id as $category_by_id) {
                    if ($categories->id != $category_by_id->category_id) {
                        $data[] = array(
                            'id' => $categories->id,
                            'text' => $categories->category_name,
                            'subtext' => $categories->type
                        );
                    }
                }
            }
        } else {
            foreach ($get_by_search as $categories) {
                $data[] = array(
                    'id' => $categories->id,
                    'text' => $categories->category_name,
                    'subtext' => $categories->type
                );
            }
        }

        echo json_encode($data);
    }
    public function addCategories()
    {
        $new_data = array(
            'account_type' => $this->input->post('account_type'),
            'detail_type' => $this->input->post('detail_type'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'sub_account' => $this->input->post('sub_account'),
        );
        $query = $this->expenses_model->addCategories($new_data);
        if ($query == true) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function updateCategoryById()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $expenses_id = $this->input->post('expenses_id');
        $transaction_id = $this->input->post('transaction_id');
        if ($id == null) {
            $new_category = array(
                'transaction_id'=> $transaction_id,
                'expenses_id' => $expenses_id,
                'category_id' => $category
            );
            $this->db->insert('accounting_expense_category', $new_category);
        } else {
            $data = array(
                'category_id' => $category
            );
            $this->db->where('id', $id);
            $this->db->update('accounting_expense_category', $data);
        }

        echo json_encode(1);
    }

    public function payDown()
    {
        $new_data = array(
            'credit_card_id' => $this->input->post('credit_card_id'),
            'amount' => $this->input->post('amount'),
            'date_payment' => $this->input->post('date_payment'),
            'payment_account' => $this->input->post('payment_account'),
            'check_number' => $this->input->post('check_num'),
        );
        $query = $this->expenses_model->payDown($new_data);
        if ($query == true) {
            redirect('accounting/expenses');
        } else {
            redirect('accounting/expenses');
        }
    }

    /***Rules***/
    public function edit_rules()
    {
        $id = $this->input->get('id');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['rules'] = $this->rules_model->getRulesById($id);
        $this->page_data['conditions'] = $this->rules_model->getConditionById($id);
        $this->page_data['categories'] = $this->rules_model->getCategoryById($id);
        $this->load->view('accounting/rules/edit-rules', $this->page_data);
    }

    public function addRules()
    {
        $new_data = array(
            'rules_name' => $this->input->post('rules_name'),
            'apply' => $this->input->post('apply'),
            'banks' => $this->input->post('banks'),
            'include' => $this->input->post('include'),
            'transaction_type' => $this->input->post('trans_type'),
            'payee' => $this->input->post('payee'),
            'memo' => $this->input->post('memo'),
            'auto' => $this->input->post('auto')
        );
        $rules_id = $this->rules_model->addRules($new_data);
        if ($rules_id != null) {
            //Condition insertion
            $description = $this->input->post('description');
            $contain = $this->input->post('contain');
            $comment = $this->input->post('comment');
            $this->rules_model->addConditions($description, $contain, $comment, $rules_id);
            //Category Insertion
            $category = $this->input->post('category');
            $percentage = $this->input->post('percentage');
            $this->rules_model->addCategory($category, $percentage, $rules_id);

            $this->session->set_flashdata('rules_added', 'New rules added');
            redirect('accounting/rules');
        } else {
            $this->session->set_flashdata('rules_failed', 'Rules name already exist.');
            redirect('accounting/rules');
        }
    }

    public function editRules()
    {
        $update = array(
            'rules_id' => $this->input->post('rules_id'),
            'rules_name' => $this->input->post('rules_name'),
            'apply' => $this->input->post('apply'),
            'banks' => $this->input->post('banks'),
            'include' => $this->input->post('include'),
            'transaction_type' => $this->input->post('trans_type'),
            'payee' => $this->input->post('payee'),
            'memo' => $this->input->post('memo'),
            'auto' => $this->input->post('auto')
        );
        //Condition
        $con_id = $this->input->post('con_id');
        $description = $this->input->post('description');
        $contain = $this->input->post('contain');
        $comment = $this->input->post('comment');
        //Category
        $cat_id = $this->input->post('cat_id');
        $category = $this->input->post('category');
        $percentage = $this->input->post('percentage');

        $rules_id = $this->rules_model->editRules($update, $con_id, $description, $contain, $comment, $cat_id, $category, $percentage);
        if ($rules_id == true) {
            $this->session->set_flashdata('updated_rules', 'Rules has been updated.');
            redirect('accounting/rules');
        } else {
            $this->session->set_flashdata('update_rules_failed', 'Something is wrong in the process.');
            redirect('accounting/rules');
        }
    }

    public function deleteRulesData()
    {
        $id = $this->input->post('id');
        $this->rules_model->deleteRulesData($id);
        $rules = $this->rules_model->getRules();
        $output = '';
        foreach ($rules as $rule) {
            $output = '<tr>';
            $output .= '<td><input type="checkbox" value="'.$rule->id.'"></td>';
            $output .= '<td>'.$rule->rules_name.'</td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td></td>';
            $output .= '<td>'.($rule->auto)?"Auto":"".'</td>';
            $output .= '<td></td>';
            $output .= '<td>';
            $output .= '<a href="'.site_url().'accounting/edit_rules?id='.$rule->id.'" style="color: #0b97c4;">View/Edit</a>&nbsp;';
            $output .= '<div class="dropdown" style="display: inline-block;position: relative;cursor: pointer;">';
            $output .= '<span class="fa fa-chevron-down" data-toggle="dropdown"></span>';
            $output .= '<ul class="dropdown-menu dropdown-menu-right">';
            $output .= '<li><a href="#" id="deleteRules" data-id="'.$rule->id.'">Delete</a></li>';
            $output .= '</ul>';
            $output .= '</div>';
            $output .= '</td>';
            $output .= '</tr>';
        }
        echo $output;
    }

    /*** Receipt ***/
    public function uploadReceiptImage()
    {
        if (! empty($_FILES)) {
            $config = array(
                'upload_path' => './uploads/accounting/',
                'allowed_types' => 'gif|jpg|png|jpeg',
                'overwrite' => true,
                'max_size' => '5000',
                'max_height' => '0',
                'max_width' => '0',
                'encrypt_name' => true
            );
            $config = $this->uploadlib->initialize($config);
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file")) {
                $uploadData = $this->upload->data();
                $data2 = array('receipt_img' => $uploadData['file_name']);
                $this->db->insert('accounting_receipts', $data2);
                echo json_encode($uploadData['file_name']);
            } else {
                echo $this->upload->display_errors();
                ;
            }
        }
    }

    public function removeReceiptImage()
    {
        $file = $this->input->post('file');
        if ($file && file_exists($this->upload_path. $file)) {
            unlink($this->upload_path. $file);
            $this->db->where('receipt_img', $file);
            $this->db->delete('accounting_receipts');
        } else {
            echo $this->upload->display_errors();
        }
    }

    public function getReceiptData()
    {
        if (isset($_POST['id'])) {
            $query = $this->db->get_where('accounting_receipts', array('id'=>$_POST['id']));

            $data = new stdClass();
            $data->id = $_POST['id'];
            $data->receipt_img = $query->row()->receipt_img;
            $data->document_type = (empty($query->row()->document_type))?"null":$query->row()->document_type;
            $data->payee_id = ($query->row()->payee_id == 0)?"default":$query->row()->payee_id;
            $data->bank_account = (empty($query->row()->bank_account))?"default":$query->row()->bank_account;
            $data->transaction_date = $query->row()->transaction_date;
            $data->description = (empty($query->row()->description))?"":$query->row()->description;
            $data->category = (empty($query->row()->category))?"default":$query->row()->category;
            $data->total_amount = (empty($query->row()->total_amount))?"":$query->row()->total_amount;
            $data->memo = (empty($query->row()->memo))?"":$query->row()->memo;
            $data->ref_number = (empty($query->row()->ref_number))?"":$query->row()->ref_number;

            echo json_encode($data);
        }
    }

    public function updateReceipt()
    {
        $new_data = array(
            'receipt_id' => $this->input->post('receipt_id'),
            'document_type' => $this->input->post('document_type'),
            'payee_id' => $this->input->post('payee_id'),
            'bank_account' => $this->input->post('bank_account'),
            'transaction_date' => $this->input->post('transaction_date'),
            'category' => $this->input->post('category'),
            'description' => $this->input->post('description'),
            'total_amount' => $this->input->post('total_amount'),
            'memo' => $this->input->post('memo'),
            'ref_number' => $this->input->post('ref_number')
        );
        $update = $this->receipt_model->updateReceipt($new_data);
        if ($update == true) {
            $this->session->set_flashdata('receipt_updated', 'Receipt updated.');
            redirect('accounting/receipts');
        } else {
            $this->session->set_flashdata('receipt_updateFailed', 'Something is wrong in the process.');
            redirect('accounting/receipts');
        }
    }

    public function deleteReceiptData()
    {
        $id = $this->input->post('id');
        $this->receipt_model->deleteReceiptData($id);
    }

    public function lists()
    {
        $this->load->view('accounting/list', $this->page_data);
    }

    public function addInvoice()
    {
        if ($this->input->post('custocredit_card_paymentsmer_id') == 1) {
            $credit_card = 'Credit Card';
        } else {
            $credit_card = '0';
        }

        if ($this->input->post('bank_transfer') == 1) {
            $bank_transfer = 'Bank Transfer';
        } else {
            $bank_transfer = '0';
        }

        if ($this->input->post('instapay') == 1) {
            $instapay = 'Instapay';
        } else {
            $instapay = '0';
        }

        if ($this->input->post('check') == 1) {
            $check = 'Check';
        } else {
            $check = '0';
        }

        if ($this->input->post('cash') == 1) {
            $cash = 'Cash';
        } else {
            $cash = '0';
        }

        if ($this->input->post('deposit') == 1) {
            $deposit = 'Deposit';
        } else {
            $deposit = '0';
        }


        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),//

            'job_location' => $this->input->post('invoice_job_location'),//
            'job_name' => $this->input->post('job_name'),//

            'tags' => $this->input->post('tags'),//
            'invoice_type' => $this->input->post('invoice_type'),//
            'work_order_number' => $this->input->post('work_order_number'),//
            'purchase_order' => $this->input->post('purchase_order'),//
            'invoice_number' => $this->input->post('invoice_number'),//
            'date_issued' => $this->input->post('date_issued'),//

            'customer_email' => $this->input->post('customer_email'),//
            'online_payments' => $this->input->post('online_payments'),
            'billing_address' => $this->input->post('billing_address'),//
            'shipping_to_address' => $this->input->post('shipping_to_address'),//
            'ship_via' => $this->input->post('ship_via'),//
            'shipping_date' => $this->input->post('shipping_date'),//
            'tracking_number' => $this->input->post('tracking_number'),//
            'terms' => $this->input->post('terms'),//
            // 'invoice_date' => $this->input->post('invoice_date'),
            'due_date' => $this->input->post('due_date'),//
            'location_scale' => $this->input->post('location_scale'),//
            'message_to_customer' => $this->input->post('message_to_customer'),//
            'terms_and_conditions' => $this->input->post('terms_and_conditions'),//
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'test',
            'status' => $this->input->post('status'),//

            'deposit_request_type' => $this->input->post('deposit_request_type'),//
            'deposit_request' => $this->input->post('deposit_amount'),//
            // 'payment_schedule' => $this->input->post('payment_schedule'),
            'payment_methods' => $credit_card.','.$bank_transfer.','.$instapay.','.$check.','.$cash.','.$deposit,

            'sub_total' => $this->input->post('sub_total'),//
            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'),//


            'user_id' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->invoice_model->createInvoice($new_data);

        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'item' => $this->input->post('item'),
                'item_type' => $this->input->post('item_type'),
                // 'description' => $this->input->post('desc'),
                'qty' => $this->input->post('quantity'),
                // 'rate' => $this->input->post('rate'),
                'cost' => $this->input->post('price'),
                'discount' => $this->input->post('discount'),
                'tax' => $this->input->post('tax'),
                'total' => $this->input->post('total'),
                'type' => 'Accounting Invoice',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );

            $a = $this->input->post('item');
            $b = $this->input->post('item_type');
            $c = $this->input->post('quantity');
            $d = $this->input->post('price');
            $e = $this->input->post('discount');
            $f = $this->input->post('tax');
            $g = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['cost'] = $d[$i];
                $data['discount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['total'] = $g[$i];
                $data['type'] = 'Accounting Invoice';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                // $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            // redirect('accounting/banking');
            redirect('accounting/invoices');
        } else {
            echo json_encode(0);
        }
    }

    public function getCustomersAcc()
    {
        $this->page_data['customers'] = $this->accounting_invoices_model->getCustomers();
        $this->load->view('accounting/customer_invoice_modal', $this->page_data);
    }

    public function updateInvoice()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'customer_email' => $this->input->post('customer_email'),
            'online_payments' => $this->input->post('online_payments'),
            'billing_address' => $this->input->post('billing_address'),
            'terms' => $this->input->post('terms'),
            'invoice_date' => $this->input->post('invoice_date'),
            'due_date' => $this->input->post('due_date'),
            'location_scale' => $this->input->post('location_scale'),
            'products' => $this->input->post('products'),
            'description' => $this->input->post('description'),
            'qty' => $this->input->post('qty'),
            'rate' => $this->input->post('rate'),
            'amount' => $this->input->post('amount'),
            'tax' => $this->input->post('tax'),
            'message_on_invoice' => $this->input->post('message_on_invoice'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'attachments' => $this->input->post('file_name'),
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $updateQuery = $this->accounting_invoices_model->updateInvoice($this->input->post('id'), $new_data);

        if ($addQuery) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function deleteInvoice()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_invoices_model->deleteInvoice($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function addReceivePayment()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_no' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'amount' => $this->input->post('amount'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'testing',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_receive_payment_model->createReceivePayment($new_data);

        if ($addQuery > 0) {
            // echo json_encode($addQuery);
            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function savepaymethod()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();
        $new_data = array(
            'payment_method' => $this->input->post('new_pay_method'),
            'quick_name' => $this->input->post('new_pay_method'),
            'user_id' => $user_id,
            'company_id' => $company_id,
        );

        $addQuery = $this->accounting_receive_payment_model->savepaymentmethod($new_data);

        if ($addQuery > 0) {
            echo json_encode($addQuery);
        //$this->session->set_flashdata('Method added');
        } else {
            echo json_encode(0);
        }
    }

    public function updateReceivePayment()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'amount_received' => $this->input->post('amount_received'),
            'memo' => $this->input->post('memo'),
            'attachments' => $this->input->post('file_name'),
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $updateQuery = $this->accounting_receive_payment_model->updateReceivePayment($this->input->post('id'), $new_data);

        if ($updateQuery) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function deleteReceivePayment()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_receive_payment_model->deleteReceivePayment($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    //add estimate

    public function saveEstimate()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'billing_address' => $this->input->post('billing_address'),
            'est_date' => $this->input->post('est_date'),
            'ex_date' => $this->input->post('ex_date'),
            'ship_via' => $this->input->post('ship_via'),
            'ship_date' => $this->input->post('ship_date'),
            'tracking_no' => $this->input->post('tracking_no'),
            'ship_to' => $this->input->post('ship_to'),
            'tags' => $this->input->post('tags'),
            'attachments' => 'testing',
            'message_invoice' => $this->input->post('message_invoice'),
            'message_statement' => $this->input->post('message_statement'),
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);

        // if($addQuery > 0){
        //     // echo json_encode($addQuery);
        //     redirect('accounting/banking');
        // }
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'product_services' => $this->input->post('prod'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'rate' => $this->input->post('rate'),
                'amount' => $this->input->post('amount'),
                'tax' => $this->input->post('tax'),
                'type' => '1',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('prod');
            $b = $this->input->post('desc');
            $c = $this->input->post('qty');
            $d = $this->input->post('rate');
            $e = $this->input->post('amount');
            $f = $this->input->post('tax');

            $i = 0;
            foreach ($a as $row) {
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '2';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimate()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Standard',
            // 'ship_via' => $this->input->post('ship_via'),
            // 'ship_date' => $this->input->post('ship_date'),
            // 'tracking_no' => $this->input->post('tracking_no'),
            // 'ship_to' => $this->input->post('ship_to'),
            // 'tags' => $this->input->post('tags'),
            'attachments' => 'testing',
            // 'message_invoice' => $this->input->post('message_invoice'),
            // 'message_statement' => $this->input->post('message_statement'),
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            'estimate_type' => 'Standard',

            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            'sub_total' => $this->input->post('sub_total'),//
            'deposit_request' => $this->input->post('adjustment_name'),//
            'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('grand_total'),//

            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_input'),//

            'markup_type' => '$',//
            'markup_amount' => $this->input->post('markup_input_form'),//

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            // $new_data2 = array(
            //     'item_type' => $this->input->post('type'),
            //     'description' => $this->input->post('desc'),
            //     'qty' => $this->input->post('qty'),
            //     'location' => $this->input->post('location'),
            //     'cost' => $this->input->post('cost'),
            //     'discount' => $this->input->post('discount'),
            //     'tax' => $this->input->post('tax'),
            //     'type' => '1',
            //     'type_id' => $addQuery,
            //     'status' => '1',
            //     'created_at' => date("Y-m-d H:i:s"),
            //     'updated_at' => date("Y-m-d H:i:s")
            // );
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            // $c = $this->input->post('desc');
            $d = $this->input->post('quantity');
            // $e = $this->input->post('location');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                // $data['description'] = $c[$i];
                $data['qty'] = $d[$i];
                // $data['location'] = $e[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Standard Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['status'] = 'Standard';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimateOptions()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Options',
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            'estimate_type' => 'Bundle',
            'bundle1_message' => $this->input->post('bundle1_message'),
            'bundle2_message' => $this->input->post('bundle2_message'),
            'bundle1_total' => $this->input->post('bundle1_total'),
            'bundle2_total' => $this->input->post('bundle2_total'),
            'bundle_discount' => $this->input->post('bundle_discount'),


            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            'deposit_request' => '$',
            'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('supergrandtotal'),//

            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_input'),//

            'markup_type' => '$',//
            'markup_amount' => $this->input->post('markup_input_form'),//

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Options Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['estimate_type'] = 'Options';
                $data['bundle_option_type'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            $j = $this->input->post('items2');
            $k = $this->input->post('item_type2');
            $l = $this->input->post('quantity2');
            $m = $this->input->post('price2');
            $n = $this->input->post('discount2');
            $o = $this->input->post('tax2');
            $p = $this->input->post('total2');

            $z = 0;
            foreach ($j as $row2) {
                $data2['item'] = $j[$z];
                $data2['item_type'] = $k[$z];
                $data2['qty'] = $l[$z];
                $data2['cost'] = $m[$z];
                $data2['discount'] = $n[$z];
                $data2['tax'] = $o[$z];
                $data2['total'] = $p[$z];
                $data2['type'] = 'Options Estimate';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['estimate_type'] = 'Options';
                $data2['bundle_option_type'] = '2';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
                $z++;
            }

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }

    public function savenewestimateBundle()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'job_location' => $this->input->post('job_location'),
            'job_name' => $this->input->post('job_name'),
            'estimate_number' => $this->input->post('estimate_number'),
            // 'email' => $this->input->post('email'),
            // 'billing_address' => $this->input->post('billing_address'),
            'estimate_date' => $this->input->post('estimate_date'),
            'expiry_date' => $this->input->post('expiry_date'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'status' => $this->input->post('status'),
            'estimate_type' => 'Bundle',
            'attachments' => 'testing',
            'status' => $this->input->post('status'),
            'deposit_request' => $this->input->post('deposit_request'),
            'deposit_amount' => $this->input->post('deposit_amount'),
            'customer_message' => $this->input->post('customer_message'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'instructions' => $this->input->post('instructions'),

            'estimate_type' => 'Bundle',
            'bundle1_message' => $this->input->post('bundle1_message'),
            'bundle2_message' => $this->input->post('bundle2_message'),
            'bundle1_total' => $this->input->post('bundle1_total'),
            'bundle2_total' => $this->input->post('bundle2_total'),
            'bundle_discount' => $this->input->post('bundle_discount'),


            'user_id' => $user_id,
            'company_id' => $company_id,
            // 'created_by' => logged('id'),

            // 'sub_total' => $this->input->post('sub_total'),
            'deposit_request' => '$',
            'deposit_amount' => $this->input->post('adjustment_input'),//
            'grand_total' => $this->input->post('supergrandtotal'),//

            'adjustment_name' => $this->input->post('adjustment_name'),//
            'adjustment_value' => $this->input->post('adjustment_input'),//

            'markup_type' => '$',//
            'markup_amount' => $this->input->post('markup_input_form'),//

            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->estimate_model->save_estimate($new_data);
        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Bundle Estimate';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['estimate_type'] = 'Bundle';
                $data['bundle_option_type'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            $j = $this->input->post('items2');
            $k = $this->input->post('item_type2');
            $l = $this->input->post('quantity2');
            $m = $this->input->post('price2');
            $n = $this->input->post('discount2');
            $o = $this->input->post('tax2');
            $p = $this->input->post('total2');

            $z = 0;
            foreach ($j as $row2) {
                $data2['item'] = $j[$z];
                $data2['item_type'] = $k[$z];
                $data2['qty'] = $l[$z];
                $data2['cost'] = $m[$z];
                $data2['discount'] = $n[$z];
                $data2['tax'] = $o[$z];
                $data2['total'] = $p[$z];
                $data2['type'] = 'Bundle Estimate';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['estimate_type'] = 'Bundle';
                $data2['bundle_option_type'] = '2';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->additem_details($data2);
                $z++;
            }

            redirect('accounting/newEstimateList');
        } else {
            echo json_encode(0);
        }
    }

    public function addSalesReceipt()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'billing_address' => $this->input->post('billing_address'),
            'sales_receipt_date' => $this->input->post('sales_receipt_date'),
            'ship_via' => $this->input->post('ship_via'),
            'shipping_date' => $this->input->post('shipping_date'),
            'tracking_no' => $this->input->post('tracking_no'),
            'shipping_to' => $this->input->post('shipping_to'),
            'location_scale' => $this->input->post('location_scale'),
            // 'amount' => $this->input->post('total_amount'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'message' => $this->input->post('message'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'testing',
            // 'shipping' => $this->input->post('shipping'),
            'status' => 1,
            'created_by' => logged('id'),

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),

            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_sales_receipt_model->createSalesReceipts($new_data);

        if ($this->input->post('payment_method') == 'Cash') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'is_collected' => '1',
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Check') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'check_number' => $this->input->post('check_number'),
                'routing_number' => $this->input->post('routing_number'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Credit Card') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('credit_number'),
                'credit_expiry' => $this->input->post('credit_expiry'),
                'credit_cvc' => $this->input->post('credit_cvc'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Debit Card') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('debit_credit_number'),
                'credit_expiry' => $this->input->post('debit_credit_expiry'),
                'credit_cvc' => $this->input->post('debit_credit_cvc'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'ACH') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'routing_number' => $this->input->post('ach_routing_number'),
                'account_number' => $this->input->post('ach_account_number'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Venmo') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('account_credentials'),
                'account_note' => $this->input->post('account_note'),
                'confirmation' => $this->input->post('confirmation'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Paypal') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('paypal_account_credentials'),
                'account_note' => $this->input->post('paypal_account_note'),
                'confirmation' => $this->input->post('paypal_confirmation'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Square') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('square_account_credentials'),
                'account_note' => $this->input->post('square_account_note'),
                'confirmation' => $this->input->post('square_confirmation'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Warranty Work') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('warranty_account_credentials'),
                'account_note' => $this->input->post('warranty_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Home Owner Financing') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('home_account_credentials'),
                'account_note' => $this->input->post('home_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'e-Transfer') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('e_account_credentials'),
                'account_note' => $this->input->post('e_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Other Credit Card Professor') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('other_credit_number'),
                'credit_expiry' => $this->input->post('other_credit_expiry'),
                'credit_cvc' => $this->input->post('other_credit_cvc'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Other Payment Type') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('other_payment_account_credentials'),
                'account_note' => $this->input->post('other_payment_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        }

        // if($addQuery > 0){
        //     echo json_encode($addQuery);
        // }
        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Sales Receipt';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }

    public function updateSalesReceipt()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'sales_receipt_date' => $this->input->post('sales_receipt_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_scale' => $this->input->post('location_scale'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_number'),
            'deposit_to' => $this->input->post('deposit_to'),
            'products' => $this->input->post('products'),
            'description' => $this->input->post('description'),
            'qty' => $this->input->post('qty'),
            'rate' => $this->input->post('rate'),
            'amount' => $this->input->post('amount'),
            'tax' => $this->input->post('tax'),
            'message_displayed_on_sales_receipt' => $this->input->post('message_displayed_on_sales_receipt'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'attachments' => $this->input->post('file_name'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $updateQuery = $this->accounting_sales_receipt_model->updateSalesReceipt($this->input->post('id'), $new_data);

        if ($updateQuery > 0) {
            echo json_encode($updateQuery);
        } else {
            echo json_encode(0);
        }
    }
    public function deleteSalesReceipt()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_sales_receipt_model->deleteSalesReceipt($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addRefundReceipt()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'refund_receipt_date' => $this->input->post('receipt_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_sale' => $this->input->post('location_scale'),
            'payment_method' => $this->input->post('payment_method'),
            'refund_form' => $this->input->post('refund_form'),
            'tags' => $this->input->post('tags'),
            // 'total_amount' => $this->input->post('total_amount'),
            'message_refund' => $this->input->post('message_refund'),
            'message_statement' => $this->input->post('mess_statement'),
            // 'tax_rate' => $this->input->post('tax_rate'),
            'shipping' => $this->input->post('shipping'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'testing 2',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),
            
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_refund_receipt_model->createRefundReceipts($new_data);

        if ($this->input->post('payment_method') == 'Cash') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'is_collected' => '1',
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Check') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'check_number' => $this->input->post('check_number'),
                'routing_number' => $this->input->post('routing_number'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Credit Card') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('credit_number'),
                'credit_expiry' => $this->input->post('credit_expiry'),
                'credit_cvc' => $this->input->post('credit_cvc'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Debit Card') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('debit_credit_number'),
                'credit_expiry' => $this->input->post('debit_credit_expiry'),
                'credit_cvc' => $this->input->post('debit_credit_cvc'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'ACH') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'routing_number' => $this->input->post('ach_routing_number'),
                'account_number' => $this->input->post('ach_account_number'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Venmo') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('account_credentials'),
                'account_note' => $this->input->post('account_note'),
                'confirmation' => $this->input->post('confirmation'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Paypal') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('paypal_account_credentials'),
                'account_note' => $this->input->post('paypal_account_note'),
                'confirmation' => $this->input->post('paypal_confirmation'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Square') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('square_account_credentials'),
                'account_note' => $this->input->post('square_account_note'),
                'confirmation' => $this->input->post('square_confirmation'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Warranty Work') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('warranty_account_credentials'),
                'account_note' => $this->input->post('warranty_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Home Owner Financing') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('home_account_credentials'),
                'account_note' => $this->input->post('home_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'e-Transfer') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('e_account_credentials'),
                'account_note' => $this->input->post('e_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Other Credit Card Professor') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'credit_number' => $this->input->post('other_credit_number'),
                'credit_expiry' => $this->input->post('other_credit_expiry'),
                'credit_cvc' => $this->input->post('other_credit_cvc'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        } elseif ($this->input->post('payment_method') == 'Other Payment Type') {
            $payment_data = array(
            
                'payment_method' => $this->input->post('payment_method'),
                'amount' => $this->input->post('payment_amount'),
                'account_credentials' => $this->input->post('other_payment_account_credentials'),
                'account_note' => $this->input->post('other_payment_account_note'),
                'work_order_id' => $addQuery,
                'date_created' => date("Y-m-d H:i:s"),
                'date_updated' => date("Y-m-d H:i:s")
            );

            $pay = $this->accounting_sales_receipt_model->save_payment($payment_data);
        }

        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Refund Receipt';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }

    public function addDelayedCredit()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $product = json_encode($this->input->post('product'));


        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'delayed_credit_date' => $this->input->post('delayed_credit_date'),
            // 'products' => 'testing',
            'tags' => $this->input->post('tags'),
            'total_amount' => $this->input->post('grand_total_amount'),
            // 'sub_total' => $this->input->post('sub_total'),
            'memo' => $this->input->post('memo'),
            // 'grand_total' => $this->input->post('grand_total_amount'),
            'attachments' => 'testing 2',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_delayed_credit_model->createDelayedCredit($new_data);

        // if($addQuery > 0){
        //     redirect('accounting/banking');
        //     // echo json_encode($addQuery);
        // }
        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Delayed Credit';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }

    public function addCreditMemo()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        // $profile = json_encode($people);

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'credit_memo_date' => $this->input->post('credit_memo_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_scale' => $this->input->post('location_scale'),
            'message_credit_memo' => $this->input->post('message_displayed_on_credit_memo'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'attachments' => 'testing',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'grand_total' => $this->input->post('grand_total'),

            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_credit_memo_model->createCreditMemo($new_data);

        // if($addQuery > 0){
        //     redirect('accounting/banking');
        //     // echo json_encode($addQuery);
        // }

        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Credit Memo';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }

    public function updateCreditMemo()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'email' => $this->input->post('email'),
            'credit_memo_date' => $this->input->post('credit_memo_date'),
            'billing_address' => $this->input->post('billing_address'),
            'location_scale' => $this->input->post('location_scale'),
            'products' => $this->input->post('products'),
            'description' => $this->input->post('description'),
            'qty' => $this->input->post('qty'),
            'rate' => $this->input->post('rate'),
            'amount' => $this->input->post('amount'),
            'tax' => $this->input->post('tax'),
            'message_displayed_on_credit_memo' => $this->input->post('message_displayed_on_credit_memo'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            'tax_rate' => $this->input->post('tax_rate'),
            'see_the_math' => $this->input->post('see_the_math'),
            'attachments' => $this->input->post('file_name'),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $updateQuery = $this->accounting_credit_memo_model->updateCreditMemo($this->input->post('id'), $new_data);

        if ($updateQuery > 0) {
            echo json_encode($updateQuery);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteCreditMemo()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_credit_memo_model->deleteCreditMemo($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function addDelayedCharge()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $product = json_encode($this->input->post('phone'));

        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'delayed_credit_date' => $this->input->post('charge_date'),
            'tags' => $this->input->post('tags'),
            'total_amount' => $this->input->post('grand_total_amount'),
            'memo' => $this->input->post('memo'),
            'attachments' => 'testing',
            'status' => 1,
            'user_id' => $user_id,
            'company_id' => $company_id,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_delayed_charge_model->createDelayedCharge($new_data);

        // if($addQuery > 0){
        //     redirect('accounting/banking');
        //     // echo json_encode($addQuery);
        // }
        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Delayed Charge';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
            // print_r($file_put_contents);die;
        }
    }

    public function updateDelayedCharge()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'delayed_charge_date' => $this->input->post('delayed_charge_date'),
            'products' => $this->input->post('products'),
            'description' => $this->input->post('description'),
            'qty' => $this->input->post('qty'),
            'rate' => $this->input->post('rate'),
            'amount' => $this->input->post('amount'),
            'tax' => $this->input->post('tax'),
            'memo' => $this->input->post('memo'),
            'attachments' => $this->input->post('file_name'),
            'status' => 1,
            'created_by' => logged('id'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_delayed_charge_model->updateDelayedCharge($this->input->post('id'), $new_data);

        if ($addQuery > 0) {
            echo json_encode($addQuery);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteDelayedCharge()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_delayed_charge_model->deleteDelayedCharge($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function addSalesTimeActivity()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'date' => $this->input->post('date'),
            'name' => $this->input->post('name'),
            'customer' => $this->input->post('customer'),
            'service' => $this->input->post('service'),
            'billable' => $this->input->post('billable'),
            'taxable' => $this->input->post('taxable'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'break' => $this->input->post('breakTime'),
            'time' => $this->input->post('time'),
            'description' => $this->input->post('description')
        );
        $query = $this->accounting_sales_time_activity_model->createTimeActivity($new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function updateSalesTimeActivity()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'date' => $this->input->post('date'),
            'name' => $this->input->post('name'),
            'customer' => $this->input->post('customer'),
            'service' => $this->input->post('service'),
            'billable' => $this->input->post('billable'),
            'taxable' => $this->input->post('taxable'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'break' => $this->input->post('breakTime'),
            'time' => $this->input->post('time'),
            'description' => $this->input->post('description')
        );
        $query = $this->accounting_sales_time_activity_model->updateTimeActivity($this->input->post('id'), $new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    public function deleteSalesTimeActivity()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_sales_time_activity_model->deleteTimeActivity($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function addCustomersAccounting()
    {
        $new_data = array(
            'prof_id' => $this->input->post('prof_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'middle_name' => $this->input->post('middle_name'),
            'prefix' => $this->input->post('prefix'),
            'suffix' => $this->input->post('suffix'),
            'business_name' => $this->input->post('business_name'),
            'email' => $this->input->post('email'),
            'ssn' => $this->input->post('ssn'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'phone_h' => $this->input->post('phone_h'),
            'phone_w' => $this->input->post('phone_w'),
            'phone_m' => $this->input->post('phone_m'),
            'fax' => $this->input->post('fax'),
            'mail_add' => $this->input->post('mail_add'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'zip_code' => $this->input->post('zip_code'),
            'cross_street' => $this->input->post('cross_street'),
            'subdivision' => $this->input->post('subdivision'),
            'img_path' => $this->input->post('img_path'),
            'pay_history' => $this->input->post('pay_history')
        );
        $query = $this->accounting_customer_model->createCustomer($new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function updateCustomersAccounting()
    {
        $new_data = array(
            'prof_id' => $this->input->post('prof_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'middle_name' => $this->input->post('middle_name'),
            'prefix' => $this->input->post('prefix'),
            'suffix' => $this->input->post('suffix'),
            'business_name' => $this->input->post('business_name'),
            'email' => $this->input->post('email'),
            'ssn' => $this->input->post('ssn'),
            'date_of_birth' => $this->input->post('date_of_birth'),
            'phone_h' => $this->input->post('phone_h'),
            'phone_w' => $this->input->post('phone_w'),
            'phone_m' => $this->input->post('phone_m'),
            'fax' => $this->input->post('fax'),
            'mail_add' => $this->input->post('mail_add'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'zip_code' => $this->input->post('zip_code'),
            'cross_street' => $this->input->post('cross_street'),
            'subdivision' => $this->input->post('subdivision'),
            'img_path' => $this->input->post('img_path'),
            'pay_history' => $this->input->post('pay_history')
        );
        $query = $this->accounting_customer_model->updateCustomer($this->input->post('id'), $new_data);
        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function deleteCustomersAccounting()
    {
        $id = $this->input->post('id');
        $query = $this->accounting_customer_model->deleteCustomer($id);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }
    public function searchCustomersAccounting()
    {
        $id = $this->input->post('id');
        $searchCustomer = $this->input->post('word');
        $query = $this->accounting_customer_model->searchCustomer($id, $searchCustomer);

        if ($query) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    // Jan 2, 2021 Update
    public function modal_invoice()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->load->view('accounting/customer_invoice_modal', $this->page_data);
    }
    public function modal_estimate()
    {
        $this->load->view('accounting/customer_estimate_modal');
    }

    public function addpurchaseOrder()
    {
        $transaction = array(
            'type' => 'Puchase Order',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);

        $new_data = array(
            'transaction_id' => $fquery,
            'vendor_id' => $this->input->post('vendor_id'),
            'email' => $this->input->post('email'),
            // 'amount' => $this->input->post('amount'),
            'mailing_address' => $this->input->post('mailing_address'),
            'ship_to' => $this->input->post('ship_to'),
            'shipping_address' => $this->input->post('shipping_address'),
            // 'payment_date' => $this->input->post('payment_date'),
            'purchase_order_date' => $this->input->post('purchase_order_date'),
            'permit_num' => $this->input->post('permit_num'),
            'ship_via' => $this->input->post('ship_via'),
            'tags' => $this->input->post('tags'),
            'message' => $this->input->post('message'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'amount' => $this->input->post('total_amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $query = $this->accounting_purchase_order_model->createPurchase($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '1';
                $data['ven_type_id'] = $query;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category'] = $aa[$f];
                $data2['description'] = $bb[$f];
                $data2['amount'] = $cc[$f];
                $data2['type'] = 'Puchase Order';
                $data2['type_id'] = $query;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        // echo "yes";
        } else {
            echo json_encode(0);
        }
    }

    public function addvendorcredit()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mail_address' => $this->input->post('mail_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_no' => $this->input->post('ref_no'),
            'permit_no' => $this->input->post('permit_no'),
            'tags' => $this->input->post('tags'),
            'amount' => $this->input->post('amount'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'amount' => $this->input->post('amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_purchase_order_model->createPurchase($new_data);
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'amount' => $this->input->post('amount'),
                'ven_type' => '6',
                'ven_type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('category');
            $b = $this->input->post('description');
            $c = $this->input->post('amount');

            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '6';
                $data['ven_type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_purchase_order_model->createVendorDetails($data);
                $i++;
            }

            $aa = $this->input->post('prod');
            $bb = $this->input->post('desc');
            $cc = $this->input->post('qty');
            $dd = $this->input->post('rate');
            $ee = $this->input->post('amount');
            $ff = $this->input->post('tax');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['product_services'] = $aa[$i];
                $data2['description'] = $bb[$i];
                $data2['qty'] = $cc[$i];
                $data2['rate'] = $dd[$i];
                $data2['amount'] = $ee[$i];
                $data2['tax'] = $ff[$i];
                $data2['type'] = '1';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->createInvoiceProd($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function addvendorcreditcard()
    {
        $new_data = array(
            'vendor_id' => $this->input->post('vendor_id'),
            'mail_address' => $this->input->post('mail_address'),
            'payment_date' => $this->input->post('payment_date'),
            'ref_no' => $this->input->post('ref_no'),
            'permit_no' => $this->input->post('permit_no'),
            'tags' => $this->input->post('tags'),
            'amount' => $this->input->post('amount'),
            'memo' => $this->input->post('memo'),
            // 'attachments' => $this->input->post('file_name'),
            'amount' => $this->input->post('amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_purchase_order_model->createPurchase($new_data);
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'amount' => $this->input->post('amount'),
                'ven_type' => '7',
                'ven_type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $a = $this->input->post('category');
            $b = $this->input->post('description');
            $c = $this->input->post('amount');

            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '7';
                $data['ven_type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('prod');
            $bb = $this->input->post('desc');
            $cc = $this->input->post('qty');
            $dd = $this->input->post('rate');
            $ee = $this->input->post('amount');
            $ff = $this->input->post('tax');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['product_services'] = $aa[$i];
                $data2['description'] = $bb[$i];
                $data2['qty'] = $cc[$i];
                $data2['rate'] = $dd[$i];
                $data2['amount'] = $ee[$i];
                $data2['tax'] = $ff[$i];
                $data2['type'] = '1';
                $data2['type_id'] = $addQuery;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->accounting_invoices_model->createInvoiceProd($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    public function addcheck()
    {
        $transaction = array(
            'type' => 'Check',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);

        $new_data = array(
            'transaction_id' => $fquery,
            'vendor_id' => $this->input->post('vendor_id'),
            'mailing_address' => $this->input->post('mailing_address'),
            'bank_id' => $this->input->post('bank_id'),
            'payment_date' => $this->input->post('payment_date'),
            'check_number' => $this->input->post('check_num'),
            'print_later' => $this->input->post('print_later'),
            'permit_number' => $this->input->post('permit_num'),
            'memo' => $this->input->post('name'),
            'total_amount' => $this->input->post('total_amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")

        );

        $addQuery = $this->expenses_model->addCheck($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '1';
                $data['ven_type_id'] = $query;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category'] = $aa[$f];
                $data2['description'] = $bb[$f];
                $data2['amount'] = $cc[$f];
                $data2['type'] = 'Check';
                $data2['type_id'] = $query;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        // echo "yes";
        } else {
            echo json_encode(0);
        }
    }

    public function addExpense()
    {
        $transaction = array(
            'type' => 'Expense',
            'total' => $this->input->post('total_amount'),
            'date_created' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s")
        );
        $fquery = $this->expenses_model->addtransaction($transaction);

        $new_data = array(
            'transaction_id' => $fquery,
            'vendor_id' => $this->input->post('vendor_id'),
            'payment_account' => $this->input->post('payment_account'),
            'payment_date' => $this->input->post('payment_date'),
            'payment_method' => $this->input->post('payment_method'),
            'ref_number' => $this->input->post('ref_num'),
            'permit_number' => $this->input->post('permit_num'),
            'memo' => $this->input->post('memo'),
            'amount' => $this->input->post('total_amount'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );
        $query = $this->expenses_model->addExpense($new_data);

        if ($query > 0) {
            $i = 0;
            foreach ($a as $row) {
                $data['category'] = $a[$i];
                $data['description'] = $b[$i];
                $data['amount'] = $e[$i];
                $data['ven_type'] = '1';
                $data['ven_type_id'] = $query;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_credit_card_model->createCreditCardDetails($data);
                $i++;
            }

            $aa = $this->input->post('category');
            $bb = $this->input->post('description');
            $cc = $this->input->post('amount');

            $f = 0;
            foreach ($aa as $row2) {
                $data2['category'] = $aa[$f];
                $data2['description'] = $bb[$f];
                $data2['amount'] = $cc[$f];
                $data2['type'] = 'Expense';
                $data2['type_id'] = $query;
                $data2['status'] = '1';
                $data2['created_at'] = date("Y-m-d H:i:s");
                $data2['updated_at'] = date("Y-m-d H:i:s");
                $addQuery3 = $this->expenses_model->saveItems($data2);
                $f++;
            }

            redirect('accounting/banking');
        } else {
            echo json_encode(0);
        }
    }

    //
    public function addInvoiceNew()
    {
        $new_data = array(
            'customer_id' => $this->input->post('customer_id'),
            'customer_email' => $this->input->post('customer_email'),
            'online_payments' => $this->input->post('online_payments'),
            'billing_address' => $this->input->post('billing_address'),
            'shipping_to_address' => $this->input->post('shipping_to_address'),
            'ship_via' => $this->input->post('ship_via'),
            'shipping_date' => $this->input->post('shipping_date'),
            'tracking_number' => $this->input->post('tracking_number'),
            'terms' => $this->input->post('terms'),
            'invoice_date' => $this->input->post('invoice_date'),
            'due_date' => $this->input->post('due_date'),
            'location_scale' => $this->input->post('location_scale'),
            'message_on_invoice' => $this->input->post('message_on_invoice'),
            'message_on_statement' => $this->input->post('message_on_statement'),
            // 'attachments' => $this->input->post('file_name'),
            'attachments' => 'test',
            'status' => 1,
            'created_by' => logged('id'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->accounting_invoices_model->createInvoice($new_data);
        if ($addQuery > 0) {
            //echo json_encode($addQuery);
            $new_data2 = array(
                'product_services' => $this->input->post('prod'),
                'description' => $this->input->post('desc'),
                'qty' => $this->input->post('qty'),
                'rate' => $this->input->post('rate'),
                'amount' => $this->input->post('amount'),
                'tax' => $this->input->post('tax'),
                'type' => '1',
                'type_id' => $addQuery,
                'status' => '1',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            // $a['aa'] = $this->input->post('prod');
            // $b['bb'] = $this->input->post('desc');
            // $c['cc'] = $this->input->post('qty');
            $a = $this->input->post('prod');
            $b = $this->input->post('desc');
            $c = $this->input->post('qty');
            $d = $this->input->post('rate');
            $e = $this->input->post('amount');
            $f = $this->input->post('tax');

            $i = 0;
            foreach ($a as $row) {
                $data['product_services'] = $a[$i];
                $data['description'] = $b[$i];
                $data['qty'] = $c[$i];
                $data['rate'] = $d[$i];
                $data['amount'] = $e[$i];
                $data['tax'] = $f[$i];
                $data['type'] = '1';
                $data['type_id'] = $addQuery;
                $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->createInvoiceProd($data);
                $i++;
            }

            // redirect('accounting/banking');
            redirect('accounting/invoices');
        } else {
            echo json_encode(0);
        }
    }


    // New Forms
    public function addNewEstimate()
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();

        // print_r($this->page_data['number']);

        // $get_items = array(
        //     'where' => array(
        //         'items.company_id' => logged('company_id'),
        //         'is_active' => 1,
        //     ),
        //     'table' => 'items',
        //     'select' => 'items.id,title,price',
        // );
        // $this->page_data['items'] = $this->general->get_data_with_param($get_items);

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addnewEstimate', $this->page_data);
    }

    public function addNewEstimateOptions()
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 20210000001;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0000000;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addNewEstimateOptions', $this->page_data);
    }

    public function addNewEstimateBundle()
    {
        $this->load->model('AcsProfile_model');

        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();

        // $this->page_data['file_selection'] = $this->load->view('modals/file_vault_selection', array(), TRUE);
        $this->load->view('accounting/addNewEstimateBundle', $this->page_data);
    }

    public function addnewInvoice()
    {
        // $this->load->helper('url');
        // $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->page_data['items'] = $this->items_model->getItemlist();
        // $this->page_data['invoices'] = $this->accounting_invoices_model->getInvoices();
        // $this->page_data['page_title'] = "Invoices";
        // // print_r($this->page_data);
        // $this->load->view('accounting/addInvoice', $this->page_data);

        $user_id = logged('id');
        // $parent_id = $this->db->query("select parent_id from users where id=$user_id")->row();

        // if ($parent_id->parent_id == 1) { // ****** if user is company ******//
        $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
        // } else {
        //     $this->page_data['users'] = $this->users_model->getAllUsersByCompany($parent_id->parent_id, $user_id);
        // }

        $company_id = logged('company_id');
        $role = logged('role');
        // $this->page_data['workstatus'] = $this->Workstatus_model->getByWhere(['company_id'=>$company_id]);
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        }

        $setting = $this->invoice_settings_model->getAllByCompany(logged('company_id'));

        $terms = $this->accounting_terms_model->getCompanyTerms_a($company_id);
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


        $this->load->view('accounting/addInvoice', $this->page_data);
    }

    public function addnewcreditmemo()
    {
        $this->load->model('AcsProfile_model');
        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');

        $company_id = logged('company_id');
        $this->load->library('session');

        $users_data = $this->session->all_userdata();
        // foreach($users_data as $usersD){
        //     $userID = $usersD->id;
            
        // }

        // print_r($user_id);
        // $users = $this->users_model->getUserByID($user_id);
        // print_r($users);
        // echo $company_id;

        $role = logged('role');
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }
        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        // $this->page_data['number'] = $this->estimate_model->getlastInsert();
        $this->page_data['number'] = $this->workorder_model->getlastInsert();

        $termsCondi = $this->workorder_model->getTerms($company_id);
        if ($termsCondi) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if ($termsUse) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }

        // print_r($this->page_data['terms_conditions']);
        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $this->page_data['job_tags'] = $this->workorder_model->getjob_tagsById();
        $this->page_data['clients'] = $this->workorder_model->getclientsById();
        


        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Work Order";
        // print_r($this->page_data['customers']);
        $this->load->view('accounting/addCreditMemo', $this->page_data);
    }

    public function NewworkOrder()
    {
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "Work Order";

        $this->load->model('AcsProfile_model');
        $query_autoincrment = $this->db->query("SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_name = 'customer_groups'");
        $result_autoincrement = $query_autoincrment->result_array();

        if (count($result_autoincrement)) {
            if ($result_autoincrement[0]['AUTO_INCREMENT']) {
                $this->page_data['auto_increment_estimate_id'] = 1;
            } else {
                $this->page_data['auto_increment_estimate_id'] = $result_autoincrement[0]['AUTO_INCREMENT'];
            }
        } else {
            $this->page_data['auto_increment_estimate_id'] = 0;
        }

        $user_id = logged('id');

        $company_id = logged('company_id');
        $this->load->library('session');

        $users_data = $this->session->all_userdata();
        // foreach($users_data as $usersD){
        //     $userID = $usersD->id;
            
        // }

        // print_r($user_id);
        // $users = $this->users_model->getUserByID($user_id);
        // print_r($users);
        // echo $company_id;

        $role = logged('role');
        if ($role == 1 || $role == 2) {
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        // $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        } else {
            // $this->page_data['customers'] = $this->AcsProfile_model->getAll();
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }

        $type = $this->input->get('type');
        $this->page_data['type'] = $type;
        $this->page_data['items'] = $this->items_model->getItemlist();
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->page_data['number'] = $this->estimate_model->getlastInsert();

        $this->page_data['fields'] = $this->workorder_model->getCustomByID();
        $this->page_data['headers'] = $this->workorder_model->getheaderByID();
        $this->page_data['checklists'] = $this->workorder_model->getchecklistByUser($user_id);
        $this->page_data['job_types'] = $this->workorder_model->getjob_types();

        $termsCondi = $this->workorder_model->getTerms($company_id);
        if ($termsCondi) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
        }

        $termsUse = $this->workorder_model->getTermsUse($company_id);
        if ($termsUse) {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsDefault();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUsebyID();
        } else {
            // $this->page_data['terms_conditions'] = $this->workorder_model->getTermsbyID();
            $this->page_data['terms_uses'] = $this->workorder_model->getTermsUseDefault();
        }


        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // print_r($this->page_data);
        $this->load->view('accounting/NewworkOrder', $this->page_data);
    }

    public function listworkOrder()
    {
        // // $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // // $this->page_data['page_title'] = "Work Order List";
        // // print_r($this->page_data);
        // $is_allowed = $this->isAllowedModuleAccess(24);
        // if( !$is_allowed ){
        //     $this->page_data['module'] = 'workorder';
        //     echo $this->load->view('no_access_module', $this->page_data, true);
        //     die();
        // }

        // $is_allowed = $this->isAllowedModuleAccess(24);
        // if( !$is_allowed ){
        //     $this->page_data['module'] = 'workorder';
        //     echo $this->load->view('no_access_module', $this->page_data, true);
        //     die();
        // }

        // $role = logged('role');
        // $this->page_data['workorderStatusFilters'] = array ();
        // $this->page_data['workorders'] = array ();
        // // $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => logged('company_id')]);
        // if ($role == 2 || $role == 3) {
        //     $company_id = logged('company_id');

        //     if (!empty($tab_index)) {
        //         $this->page_data['tab_index'] = $tab_index;
        //         // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('status' => $tab_index), $company_id);
        //     } else {

        //         // search
        //         if (!empty(get('search'))) {

        //             $this->page_data['search'] = get('search');
        //             // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
        //         } elseif (!empty(get('order'))) {

        //             $this->page_data['search'] = get('search');
        //             // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

        //         } else {

        //             // $this->page_data['workorders'] = $this->workorder_model->getAllOrderByCompany($company_id);
        //         }
        //     }

        //     // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount($company_id);
        // }
        // if ($role == 4) {

        //     if (!empty($tab_index)) {

        //         $this->page_data['tab_index'] = $tab_index;
        //         // $this->page_data['workorders'] = $this->workorder_model->filterBy();

        //     } elseif (!empty(get('order'))) {

        //         $this->page_data['order'] = get('order');
        //         // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);

        //     } else {

        //         if (!empty(get('search'))) {

        //             $this->page_data['search'] = get('search');
        //             // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
        //         } else {
        //             // $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();
        //         }
        //     }

        //     // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount();
        // }

        // // unserialized the value

        // $statusFilter = array();
        // foreach ($this->page_data['workorders'] as $workorder) {

        //     if (is_serialized($workorder)) {

        //         $workorder = unserialize($workorder);
        //     }
        // }

        $is_allowed = $this->isAllowedModuleAccess(24);
        if (!$is_allowed) {
            $this->page_data['module'] = 'workorder';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }

        $role = logged('role');
        $this->page_data['workorderStatusFilters'] = array();
        $this->page_data['workorders'] = array();
        $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => logged('company_id')]);
        if ($role == 2 || $role == 3) {
            $company_id = logged('company_id');

            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
            // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('status' => $tab_index), $company_id);
            } else {

                // search
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } elseif (!empty(get('order'))) {
                    $this->page_data['search'] = get('search');
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);
                } else {

                    // $this->page_data['workorders'] = $this->workorder_model->getAllOrderByCompany($company_id);
                }
            }

            // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount($company_id);
        }
        if ($role == 4) {
            if (!empty($tab_index)) {
                $this->page_data['tab_index'] = $tab_index;
            // $this->page_data['workorders'] = $this->workorder_model->filterBy();
            } elseif (!empty(get('order'))) {
                $this->page_data['order'] = get('order');
            // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('order' => get('order')), $company_id);
            } else {
                if (!empty(get('search'))) {
                    $this->page_data['search'] = get('search');
                // $this->page_data['workorders'] = $this->workorder_model->filterBy(array('search' => get('search')), $company_id);
                } else {
                    // $this->page_data['workorders'] = $this->workorder_model->getAllByUserId();
                }
            }

            // $this->page_data['workorderStatusFilters'] = $this->workorder_model->getStatusWithCount();
        }

        $this->page_data['workorders'] = $this->workorder_model->getworkorderList();

        $company_id = logged('company_id');
        $this->page_data['company_work_order_used'] = $this->workorder_model->getcompany_work_order_used($company_id);

        // unserialized the value

        $statusFilter = array();
        foreach ($this->page_data['workorders'] as $workorder) {
            if (is_serialized($workorder)) {
                $workorder = unserialize($workorder);
            }
        }

        $this->load->view('accounting/work_order_list', $this->page_data);
    }

    public function newEstimateList($tab = '')
    {
        $is_allowed = $this->isAllowedModuleAccess(18);
        if (!$is_allowed) {
            $this->page_data['module'] = 'estimate';
            echo $this->load->view('no_access_module', $this->page_data, true);
            die();
        }
        $role = logged('role');
        if ($role == 2 || $role == 3 || $role == 1) {
            $this->page_data['jobs'] = $this->jobs_model->getByWhere([]);
        } else {
            $company_id = logged('company_id');
            $this->page_data['jobs'] = $this->jobs_model->getByWhere(['company_id' => $company_id]);
        }
        if (!empty($tab)) {
            $query_tab = $tab;
            if ($tab == 'declined%20by%20customer') {
                $query_tab = 'Declined By Customer';
            }
            $this->page_data['tab'] = $tab;
            $this->page_data['estimates'] = $this->estimate_model->filterBy(array('status' => lcfirst($query_tab)), $company_id, $role);
        } else {

            // search
            if (!empty(get('search'))) {
                $this->page_data['search'] = get('search');
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('search' => get('search')), $company_id, $role);
            } elseif (!empty(get('order'))) {
                $this->page_data['search'] = get('search');
                $this->page_data['estimates'] = $this->estimate_model->filterBy(array('order' => get('order')), $company_id, $role);
            } else {
                if ($role == 1 || $role == 2) {
                    $this->page_data['estimates'] = $this->estimate_model->getAllEstimates();
                } else {
                    $this->page_data['estimates'] = $this->estimate_model->getAllByCompany($company_id);
                }
            }
        }

        $this->page_data['role'] = $role;
        $this->page_data['estimateStatusFilters'] = $this->estimate_model->getStatusWithCount($company_id);

        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
        $client   = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        $this->page_data['client'] = $client;
        $this->page_data['estimate'] = $estimate;

        // $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        // $this->page_data['page_title'] = "Estimate Lists";
        // print_r($this->page_data);
        $this->load->view('accounting/estimatesList', $this->page_data);
    }

    public function savenewWorkOrder()
    {
        postAllowed();

        $post = $this->input->post();

//        echo '<pre>'; print_r($post); die;

        $user = (object)$this->session->userdata('logged');

        //
        if (is_array(post('item'))) {
            $items = post('item');
            $quantity = post('quantity');
            $price = post('price');
            $discount = post('discount');
            $type = post('item_type');
            $location = post('location');

            $itemArray = array();

            foreach (post('item') as $key => $val) {
                $itemArray[] = array(

                    'item' => $items[$key],
                    'item_type' => $type[$key],
                    'quantity' => $quantity[$key],
                    'location' => $location[$key],
                    'discount' => $discount[$key],
                    'price' => $price[$key]
                );
            }

            $additional_services = serialize($itemArray);
        } else {
            $additional_services = '';
        }

//        print_r(post('customer')); die;

        $eqpt_cost = array(

            'eqpt_cost' => post('eqpt_cost') ? post('eqpt_cost') : 0,
            'sales_tax' => post('sales_tax') ? post('sales_tax') : 0,
            'inst_cost' => post('inst_cost') ? post('inst_cost') : 0,
            'one_time' => post('one_time') ? post('one_time') : 0,
            'm_monitoring' => post('m_monitoring') ? post('m_monitoring') : 0
        );

        $company_id = logged('company_id');

        // create the workorder customer
        $this->load->model('Customer_model', 'customer_model');
        $customer_id = $this->customer_model->create([

            'customer_type' => post('customer')['customer_type'],
            'contact_name' => post('customer')['first_name'] . ' ' . post('customer')['last_name'],
            'contact_email' => post('customer')['email'],
            'mobile' => post('customer')['contact_mobile'],
            'phone' => serialize(post('customer')['contact_phone']),
            'notification_method' => serialize(post('customer')['notification_type']),
            'street_address' => post('customer')['monitored_location'],
            'suite_unit' => post('customer')['cross_street'],
            'city' => post('customer')['city'],
            'postal_code' => post('customer')['zip'],
            'state' => post('customer')['state'],
            'birthday' => date('Y-m-d', strtotime(post('customer')['contact_dob'])),
            'company_id' => $company_id
        ]);

//        print_r(serialize(post('post_service_summary'))); die;


        if ($customer_id) {
            $id = $this->workorder_model->create([

                'user_id' => $user->id,
                'company_id' => $company_id,
                'customer_id' => $customer_id,
                'customer' => serialize(post('customer')),
                'emergency_call_list' => serialize(post('emergency_call_list')),
                'plan_type' => post('plan_type'),
                'account_type' => serialize(post('account_type')),
                'panel_type' => serialize(post('panel_type')),
                'panel_communication' => post('panel_communication'),
                'panel_location' => post('panel_location'),
                'date_issued' => date('Y-m-d', strtotime(post('date_issued'))),
                'job_type_id' => post('job_type_id'),
                'status_id' => post('status_id'),
                'priority_id' => post('job_priority'),
                'ip_cameras' => serialize(post('ip_cameras')),
                'dvr_nvr' => serialize(post('dvr_nvr')),
                'doorlocks' => serialize(post('doorlocks')),
                'automation' => serialize(post('automation')),
                'pers' => serialize(post('pers')),
                'additional_services' => $additional_services,
                'total' => serialize($eqpt_cost),
                'billing_date' => date('Y-m-d', strtotime(post('billing_date'))),
                'payment_type' => post('payment_type'),
                'billing_freq' => post('billing_freq'),
                'card_info' => serialize(post('card')),
                'company_rep_approval' => post('company_representative_approval_signature'),
                'primary_account_holder' => post('primary_account_holder_signature'),
                'secondary_account_holder' => post('secondery_account_holder_signature'),
                'company_rep_name' => post('company_representative_printed_name'),
                'primary_account_holder_name' => post('primary_account_holder_name'),
                'secondary_account_holder_name' => post('secondery_account_holder_name'),
                'post_service_summary' => serialize(post('post_service_summary')),
            ]);

            $this->activity_model->add('New User $' . $user->id . ' Created by User:' . logged('name'), logged('id'));
            $this->session->set_flashdata('alert-type', 'success');
            $this->session->set_flashdata('alert', 'New Workorder Created Successfully');

            // redirect('workorder');
        }
    }

    public function savenewWorkordertwo()
    {
        $company_id  = getLoggedCompanyID();
        $user_id  = getLoggedUserID();

        $new_data = array(
            
            'workorder_number' => $this->input->post('workorder_number'),
            'customer_id' => $this->input->post('customer_id'),
            'security_number' => $this->input->post('security_number'),
            'birthdate' => $this->input->post('birthdate'),
            'phone_number' => $this->input->post('phone_number'),
            'mobile_number' => $this->input->post('mobile_number'),
            'email' => $this->input->post('email'),
            'job_location' => $this->input->post('job_location'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip_code' => $this->input->post('zip_code'),
            'cross_street' => $this->input->post('cross_street'),
            'password' => $this->input->post('password'),
            'offer_code' => $this->input->post('offer_code'),//
            'job_tag' => $this->input->post('job_tag'),
            'schedule_date_given' => $this->input->post('schedule_date_given'),
            'job_type' => $this->input->post('job_type'),
            'job_name' => $this->input->post('job_name'),
            'job_description' => $this->input->post('job_description'),
            'payment_method' => $this->input->post('payment_method'),
            'payment_amount' => $this->input->post('payment_amount'),
            'account_holder_name' => $this->input->post('account_holder_name'),
            'account_number' => $this->input->post('account_number'),
            'expiry' => $this->input->post('expiry'),
            'cvc' => $this->input->post('cvc'),
            'terms_conditions' => $this->input->post('terms_conditions'),
            'status' => $this->input->post('status'),
            'priority' => $this->input->post('priority'),
            'purchase_order_number' => $this->input->post('purchase_order_number'),
            'terms_of_use' => $this->input->post('terms_of_use'),
            'instructions' => $this->input->post('instructions'),

            //signature
            // 'company_representative_signature' => $this->input->post('company_representative_signature'),
            // 'company_representative_name' => $this->input->post('company_representative_name'),
            // 'primary_account_holder_signature' => $this->input->post('primary_account_holder_signature'),
            // 'primary_account_holder_name' => $this->input->post('primary_account_holder_name'),
            // 'secondary_account_holder_signature' => $this->input->post('secondary_account_holder_signature'),
            // 'secondary_account_holder_name' => $this->input->post('secondary_account_holder_name'),
            'company_representative_signature' => 'company_representative_signature',
            'company_representative_name' => 'company_representative_name',
            'primary_account_holder_signature' => 'primary_account_holder_signature',
            'primary_account_holder_name' => 'primary_account_holder_name',
            'secondary_account_holder_signature' => 'secondary_account_holder_signature',
            'secondary_account_holder_name' => 'secondary_account_holder_name',
            

            //attachment
            // 'attached_photo' => $this->input->post('attached_photo'),
            // 'document_links' => $this->input->post('document_links'),
            'attached_photo' => 'attached_photo',
            'document_links' => 'document_links',

            'subtotal' => $this->input->post('subtotal'),
            'taxes' => $this->input->post('taxes'),
            'adjustment_name' => $this->input->post('adjustment_name'),
            'adjustment_value' => $this->input->post('adjustment_value'),
            'voucher_value' => $this->input->post('voucher_value'),
            'grand_total' => $this->input->post('grand_total'),

            'user_id' => $user_id,
            'company_id' => $company_id,
            'date_created' => date("Y-m-d H:i:s"),
            'date_updated' => date("Y-m-d H:i:s")
        );

        $addQuery = $this->workorder_model->save_workorder($new_data);

        
        // $custom_data = array(
            
        //     'custom1_field' => $this->input->post('custom1_field'),
        //     'custom1_value' => $this->input->post('custom1_value'),
        //     'custom2_field' => $this->input->post('custom2_field'),
        //     'custom2_value' => $this->input->post('custom2_value'),
        //     'custom3_field' => $this->input->post('custom3_field'),
        //     'custom3_value' => $this->input->post('custom3_value'),
        //     'custom4_field' => $this->input->post('custom4_field'),
        //     'custom4_value' => $this->input->post('custom4_value'),
        //     'custom5_field' => $this->input->post('custom5_field'),
        //     'custom5_value' => $this->input->post('custom5_value'),
        //     'workorder_id' => $addQuery,
        // );

        // $custom_dataQuery = $this->workorder_model->save_custom_fields($custom_data);

        $name = $this->input->post('custom_field');
        $value = $this->input->post('custom_value');

        $c = 0;
        foreach ($name as $row2) {
            $dataa['name'] = $name[$c];
            $dataa['value'] = $value[$c];
            $dataa['form_id'] = $addQuery;
            $dataa['company_id'] = $company_id;
            $dataa['date_added'] = date("Y-m-d H:i:s");
            $addQuery2a = $this->workorder_model->additem_details($dataa);
            $c++;
        }


        if ($addQuery > 0) {
            $a = $this->input->post('items');
            $b = $this->input->post('item_type');
            $d = $this->input->post('quantity');
            $f = $this->input->post('price');
            $g = $this->input->post('discount');
            $h = $this->input->post('tax');
            $ii = $this->input->post('total');

            $i = 0;
            foreach ($a as $row) {
                $data['item'] = $a[$i];
                $data['item_type'] = $b[$i];
                $data['qty'] = $d[$i];
                $data['cost'] = $f[$i];
                $data['discount'] = $g[$i];
                $data['tax'] = $h[$i];
                $data['total'] = $ii[$i];
                $data['type'] = 'Work Order';
                $data['type_id'] = $addQuery;
                // $data['status'] = '1';
                $data['created_at'] = date("Y-m-d H:i:s");
                $data['updated_at'] = date("Y-m-d H:i:s");
                $addQuery2 = $this->accounting_invoices_model->additem_details($data);
                $i++;
            }

            //redirect('workorder');
            redirect('accounting/listworkOrder');
        } else {
            echo json_encode(0);
        }
    }

    public function tickets()
    {
        $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('tickets/list', $this->page_data);
    }

    public function addexpensename()
    {
        $data = [
            'category_name' => $this->input->post('name'),
            'display_name' => $this->input->post('credit_card'),
            'type' => $this->input->post('type'),
            'sub_account' => $this->input->post('sub_account'),
            'date_created' => date("Y-m-d H:i:s"),
            'status' => 1,
        ];

        $expense= $this->accounting_expense_name_model->getexpensename($data);

        $return = [
            'data' => $expense,
            'success' => $expense ? true : false,
            'message' => $expense ? 'Success!' : 'Error!'
        ];
    }

    public function salesTax()
    {
        $user_id = logged('id');
        $this->load->view('accounting/sales_tax', $this->page_data);
    }

    public function payrollTax()
    {
        $user_id = logged('id');
        $this->load->view('accounting/payrollTax', $this->page_data);
    }

    // public function sendmerchantEmail()
    // {
    //     $email = 'emploucelle@gmail.com';
    //     $data = array(
    //         'name' => '$name',
    //         'link' => '$code'
    //     );
    //     //Load email library
    //     $this->load->library('email');
    //     $config = array(
    //         'smtp_crypto' => 'ssl',
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'mail.nsmartrac.com',
    //         'smtp_port' => 465,
    //         'smtp_user' => 'no-reply@nsmartrac.com',
    //         'smtp_pass' => 'g0[05_rEa3?%',
    //         'mailtype'  => 'html',
    //         'charset'   => 'utf-8',
    //     );
    //     $this->email->initialize($config);
    //     $this->email->set_newline("\r\n");

    //     $this->email->from('no-reply@nsmartrac.com', 'nSmartrac');
    //     $this->email->to($email);
    //     $this->email->subject('nSmartrac invitation');
    //     $message = $this->load->view('users/invite_link_template', $data, TRUE);
    //     $this->email->message($message);
    //     //Send mail
    //     $this->email->send();
    //     return true;
    // }

    public function sendmerchantEmail($id=null)
    {
        $this->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'smtp.googlemail.com';
        $config['smtp_port']    = '587';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'smartrac.noreply@gmail.com';
        $config['smtp_pass']    = 'smartrac123';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';
        $config['validation'] = true;

        $this->email->initialize($config);

        $subject =  '
        <table></table>
        ';

        $email = $this->input->post('email');
        $header_message = "<html><head><title>".$subject."</title></head><body>";
        $footer_message = "</body></html>";
        $input_msg = $this->input->post('contact_reply');
        $msg = $header_message.$footer_message;

        $this->email->from('smartrac.noreply@gmail.com', 'NSMARTRAC');
        $this->email->to($email);
        $this->email->subject('NSMARTRAC - Merchant application');
        $this->email->message($subject);

        $this->email->send();

        // echo $this->email->print_debugger();
        echo "Successfully sent to your email";
    }

    public function estimateviewdetails($id)
    {
        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getByProfId($estimate->customer_id);
        $client   = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        $this->page_data['client'] = $client;
        $this->page_data['estimate'] = $estimate;
        // $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        $this->load->view('accounting/estimateviewdetails', $this->page_data);
    }

    public function estimateviewdetailsajax()
    {
        $id = $this->input->post('id');

        $this->load->model('AcsProfile_model');
        $this->load->model('EstimateItem_model');
        $this->load->model('Clients_model');

        $estimate = $this->estimate_model->getById($id);
        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getByProfIdajax($estimate->customer_id);
        $client   = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        $this->page_data['client'] = $client;
        $this->page_data['estimate'] = $estimate;
        // $user_id = logged('id');
        // $this->page_data['leads'] = $this->customer_ad_model->get_leads_data();
        // $this->load->view('accounting/estimateviewdetails',$this->page_data);
        echo json_encode($this->page_data);
    }

    public function addLocationajax()
    {
        $id = $this->input->post('id');

        $this->load->model('AcsProfile_model');
        $this->load->model('Clients_model');

        $company_id = logged('company_id');

        $customer = $this->AcsProfile_model->getdataAjax($id);
        //  $client   = $this->Clients_model->getById($company_id);

        $this->page_data['customer'] = $customer;
        // $this->page_data['client'] = $client;

        echo json_encode($this->page_data);
    }

    public function changeRebate()
    {
        $id = $this->input->post('id');
        $get_val = $this->input->post('get_val');

        $data = array(
            'id' => $id,
            'get_val' => $get_val
        );

        $this->items_model->changeRebate($data);

        echo json_encode(0);
    }

    public function findoffercode()
    {
        $offer_code = $this->input->post('offer_code');

        $company_id = logged('company_id');

        $offer = $this->items_model->getoffercode($offer_code);

        if (empty($offer)) {
            echo "empty";
        } else {
            $this->page_data['offer'] = $offer;
        }
        // $this->page_data['client'] = $client;

        echo json_encode($this->page_data);
    }

    public function updateEstimate($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role    = logged('role');

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->load->view('accounting/updateEstimate', $this->page_data);
    }

    public function updateEstimateOptions($id)
    {
        $this->load->model('AcsProfile_model');

        $company_id = logged('company_id');
        $user_id = logged('id');
        $role    = logged('role');

        if ($role == 1 || $role == 2) {
            $this->page_data['users'] = $this->users_model->getAllUsers();
            $this->page_data['customers'] = $this->AcsProfile_model->getAll();
        } else {
            $this->page_data['users'] = $this->users_model->getAllUsersByCompany($user_id);
            $this->page_data['customers'] = $this->AcsProfile_model->getAllByCompanyId($company_id);
        }


        $this->load->model('Customer_model', 'customer_model');

        $this->page_data['estimate'] = $this->estimate_model->getById($id);
        $this->page_data['estimate']->customer = $this->customer_model->getCustomer($this->page_data['estimate']->customer_id);
        $this->page_data['plans'] = $this->plans_model->getByWhere(['company_id' => $company_id]);
        $this->load->view('accounting/updateEstimateOptions', $this->page_data);
    }

    public function work_order_templates()
    {
        $company_id = logged('company_id');
        $user_id = logged('id');
        $this->page_data['users'] = $this->users_model->getUser(logged('id'));
        $this->page_data['page_title'] = "All Templates";
        $this->page_data['company_work_order_used'] = $this->workorder_model->getcompany_work_order_used($company_id);
        
        $this->load->view('accounting/work_order_templates', $this->page_data);
    }

    public function testSave()
    {
        //print_r($_POST);
        // $folderPath = './uploads/';
        // // $this->input->post('get_val');
        
        // $image_parts = explode(";base64,", $this->input->post('signature_image'));
        
        // $image_type_aux = explode("image/", $image_parts[0]);
        
        // $image_type = $image_type_aux[1];
        
        // $image_base64 = base64_decode($image_parts[1]);
        
        // $file = $folderPath . uniqid() . '.'.$image_type;
        
        // file_put_contents($file, $image_base64);
        // echo "1";

        // $config['remove_spaces']=TRUE;
        // $config['encrypt_name'] = TRUE; // for encrypting the name
        // $config['upload_path'] = './uploads/';
        // $config['allowed_types'] = 'jpg|png|gif';
        // $config['max_size']    = '78000';

        // //load upload class library
        // $this->load->library('upload', $config);

        // //$this->upload->do_upload('filename') will upload selected file to destiny folder
        // if (!$this->upload->do_upload('signature_image'))
        // {
        //     // case - failure
        //     $upload_error = array('error' => $this->upload->display_errors());
        //     print_r($upload_error);
        // }
        // else
        // {
        //     echo "1";
        // }
        $dataURL = $this->input->post('dataURL');
        $dataURL2 = $this->input->post('dataURL2');
        $dataURL3 = $this->input->post('dataURL3');

        echo $dataURL .'<br>'. $dataURL2 .'<br>'. $dataURL3;

        // $list = json_decode($pixels, true);

        // $image->importImagePixels(0, 0, $width, $height, "RGB", Imagick::PIXEL_CHAR, $pixels);
        // $image->setImageFormat('jpg');
        // $image->writeImage("image.jpg");


        // $data = $this->input->post('output-2a');
        // list($type, $data) = explode(';', $data);
        // list(, $data)      = explode(',', $data);
        // $data = base64_decode($data);

        // file_put_contents('./uploads/image.png', $data);
        // echo "1";
    }
    public function get_customer_search_result()
    {
        $value = $this->input->post("value");
        $search_results = $this->accounting_invoices_model->get_customer_search_result($value);
        $html="";
        foreach ($search_results as $customer) {
            $html.='<li>
                <a href="javascript:void(0)" class="">
                    '.$customer->name.'
                </a>
            </li>';
        }
        $data = new stdClass();
        $data->html = $html;
        echo json_encode($data);
    }
    public function get_info_customer_reminder()
    {
        $customer_id = $this->input->post("customer_id");
        $customer_info = $this->accounting_customers_model->get_customer_by_id($customer_id);
        $invoices = $this->accounting_invoices_model->get_payements_by_customer_id($customer_id);
        $data = new stdClass();
        $data->cutsomer_email = $customer_info->email;
        $data->name = $customer_info->first_name ." ".$customer_info->last_name ."";
        $data->invoice_count = count($invoices);
        $data->business_name = $customer_info->business_name;
        echo json_encode($data);
    }
    public function send_customer_reminder()
    {
        $customer_name = $this->input->post("customer_name");
        $customer_email = $this->input->post("customer_email");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");
        $server = MAIL_SERVER;
        $port = MAIL_PORT;
        $username = MAIL_USERNAME;
        $password = MAIL_PASSWORD;
        $from = MAIL_FROM;

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->getSMTPInstance()->Timelimit = 5;
        $mail->Host = $server;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'ssl';
        $mail->Timeout = 10; // seconds
        $mail->Port = $port;
        $mail->From = $from;
        $mail->FromName = 'nSmarTrac';
        $mail->Subject = $subject;

        //get job data

        $this->page_data['customer_name'] = $customer_name;
        $this->page_data['message'] = $message;
        $this->page_data['subject'] = $subject;
        
        $mail->IsHTML(true);
        $mail->AddEmbeddedImage(dirname(__DIR__, 2) . '/assets/dashboard/images/logo.png', 'logo_2u', 'logo.png');

        $mail->Body =  'Send Reminders';
        $content = $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data, true);
        $mail->MsgHTML($content);
        $mail->addAddress($customer_email);
        $data = new stdClass();
        $data->status = "success";
        
        if (!$mail->Send()) {
            $data->status = "error";
            $data->status = "Mailer Error: ".$mail->ErrorInfo;
            exit;
        }
        echo json_encode($data);
        // $this->load->view('accounting/customer_includes/send_reminder_email_layout', $this->page_data);
    }
    public function get_customer_info_for_receive_payment()
    {
        $customer_id = $this->input->post("customer_id");
        $invoices = $this->accounting_invoices_model->get_invoices_by_customer_id($customer_id);
        $receivable_payment = 0;
        $html='';
        $counter =0;
        foreach ($invoices as $inv) {
            $customer_id = $inv->customer_id;
            $total_amount_received =0;

            $payment_received = $this->accounting_invoices_model->get_payements_by_invoice($inv->invoice_number);
            foreach ($payment_received as $received) {
                $total_amount_received+=$received->amount;
            }
            if (($inv->grand_total-$total_amount_received) > 0) {
                $html.='<tr>
                    <td class="center" style="width: 0;"><input type="checkbox" class="inv_cb" name="inv_cb_'.$counter.'" checked>
                    </td>
                    <td>'.$inv->invoice_number.'</td>
                    <td>
                    '.$inv->due_date.'
                    </td>
                    <td class="text-right">'.number_format($inv->grand_total, 2).'</td>
                    <td class="text-right">
                    '.number_format($inv->grand_total-$total_amount_received, 2).'
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="text-right inv_grand_amount" name="inv_'.$counter.'" value="'.number_format($inv->grand_total-$total_amount_received, 2).'">
                        </div>
                    </td>
                </tr>';
                $counter++;
                $receivable_payment +=$inv->grand_total-$total_amount_received;
            }
        }
        $data = new stdClass();
        $data->html = $html;
        $data->receivable_payment = $receivable_payment;
        $data->display_receivable_payment = number_format($receivable_payment, 2);
        $data->inv_count = $counter;
        echo json_encode($data);
    }
    public function get_customer_filtered_info_for_receive_payment_modal()
    {
        $customer_id = $this->input->post("customer_id");
        $filter_date_from =$this->input->post("filter_date_from");
        $filter_date_to =$this->input->post("filter_date_to");
        $filter_overdue =$this->input->post("filter_overdue");

        $invoices = $this->accounting_invoices_model->get_filtered_invoices_by_customer_id($filter_date_from, $filter_date_to, $filter_overdue, $customer_id);

        $receivable_payment = 0;
        $html='';
        $counter =0;
        foreach ($invoices as $inv) {
            $customer_id = $inv->customer_id;
            $total_amount_received =0;

            $payment_received = $this->accounting_invoices_model->get_payements_by_invoice($inv->invoice_number);
            foreach ($payment_received as $received) {
                $total_amount_received+=$received->amount;
            }
            if (($inv->grand_total-$total_amount_received) > 0) {
                $html.='<tr>
                    <td class="center" style="width: 0;"><input type="checkbox" class="inv_cb" name="inv_cb_'.$counter.'" checked>
                    </td>
                    <td>'.$inv->invoice_number.'</td>
                    <td>
                    '.$inv->due_date.'
                    </td>
                    <td class="text-right">'.number_format($inv->grand_total, 2).'</td>
                    <td class="text-right">
                    '.number_format($inv->grand_total-$total_amount_received, 2).'
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="text" class="text-right inv_grand_amount" name="inv_'.$counter.'" value="'.number_format($inv->grand_total-$total_amount_received, 2).'">
                        </div>
                    </td>
                </tr>';
                $counter++;
                $receivable_payment +=$inv->grand_total-$total_amount_received;
            }
        }
        $data = new stdClass();
        $data->html = $html;
        $data->receivable_payment = $receivable_payment;
        $data->display_receivable_payment = number_format($receivable_payment, 2);
        $data->inv_count = $counter;
        echo json_encode($data);
    }
    public function save_receive_payment_from_modal()
    {
        var_dump($this->input->post());
    }
}
